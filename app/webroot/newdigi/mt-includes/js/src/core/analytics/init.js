/* Source: src/mt-includes/js/src/core/analytics/init.js*/
/**
 * @example
 * MotoWebsiteAnalytics.fireEvent('testAction', {category: 'testCategory'}).then(function(response) {
 *     console.log('fireEvent done', response);
 * });
 */
angular.module('website.core.analytics', [
    'ng'
]).provider('MotoWebsiteAnalytics', [
    function() {
        var provider = this;
        var _options = {
            maxTimeout: 1500
        };
        var trackingServices = [];
        var debug = false;

        /**
         * @class AbstractTrackingServiceClass
         * @constructor
         */
        function AbstractTrackingServiceClass() {

        }

        AbstractTrackingServiceClass.prototype = {};

        /**
         * Return service name
         *
         * @returns {string}
         */
        AbstractTrackingServiceClass.prototype.getName = function() {
            console.warn('Method "getName" not implemented', this);

            return '';
        };

        /**
         * Fire event to tracking system
         *
         * @returns {Promise|*}
         */
        AbstractTrackingServiceClass.prototype.fireEvent = function() {
            console.warn('Method "fireEvent" not implemented', this);

            return null;
        };

        /**
         * Return abstract tracking service class
         *
         * @returns {AbstractTrackingServiceClass}
         */
        provider.getAbstractTrackingService = function() {
            return AbstractTrackingServiceClass;
        };

        /**
         * Register tracking system on 'config' level
         *
         * @param {string|array|function|object} service
         * @returns {boolean}
         */
        provider.registerTrackingService = function(service) {
            if (trackingServices.indexOf(service) > -1) {
                return false;
            }

            trackingServices.push(service);

            return true;
        };

        /**
         * Set option value without dot notation
         *
         * @param {string} name
         * @param {*} value
         * @returns {boolean}
         */
        provider.setOption = function(name, value) {
            if (!angular.isString(name)) {
                return false;
            }
            _options[name] = value;

            return true;
        };

        /**
         * Get option value without dot notation
         *
         * @param {string} name
         * @param {*} defaultValue
         * @returns {*}
         */
        provider.getOption = function(name, defaultValue) {
            if (angular.isUndefined(_options[name])) {
                return defaultValue || null;
            }

            return _options[name];
        };

        provider.$get = [
            '$injector',
            '$q',
            '$timeout',
            function($injector, $q, $timeout) {
                /**
                 * @type {WebsiteAnalyticsService}
                 */
                var websiteService;
                var i;
                var len;
                var service;
                var serviceInstance = null;

                /**
                 * @class WebsiteAnalyticsService
                 * @constructor
                 */
                function WebsiteAnalyticsService() {
                    this._services = {};
                }

                WebsiteAnalyticsService.prototype = {};

                /**
                 * Internal tracking system
                 *
                 * @type {object}
                 * @private
                 */
                WebsiteAnalyticsService.prototype._services = {};

                /**
                 * Add new tracker service
                 *
                 * @param {AbstractTrackingServiceClass} service
                 * @param {string} [name]
                 * @returns {boolean}
                 */
                WebsiteAnalyticsService.prototype.addTrackingService = function(service, name) {

                    if (!(serviceInstance instanceof AbstractTrackingServiceClass)) {
                        console.warn('Tracking service must be instance of AbstractTrackingServiceClass');
                        console.log('Service : ', service);
                        console.log('Name : ', name);

                        return false;
                    }

                    if (!angular.isString(name)) {
                        name = service.getName();
                    }
                    if (!angular.isString(name)) {
                        console.warn('Tracking service name must be a string');

                        return false;
                    }

                    name = name.trim();
                    if (name.length < 1) {
                        console.warn('Tracking service name is empty');

                        return false;
                    }

                    if (this.hasService(name)) {
                        console.warn('Tracking service "' + name + '" already registered');

                        return false;
                    }

                    this._services[name] = service;

                    return true;
                };

                /**
                 * Return tracking service by name
                 * @param {string} name
                 * @returns {AbstractTrackingServiceClass|null}
                 */
                WebsiteAnalyticsService.prototype.getService = function(name) {
                    return this._services[name] || null;
                };

                /**
                 * Check is tracking service already registered
                 *
                 * @param {string} name
                 * @returns {boolean}
                 */
                WebsiteAnalyticsService.prototype.hasService = function(name) {
                    return angular.isDefined(this._services[name]);
                };

                /**
                 * Fire event to tracking service
                 *
                 * @param {string|object} name
                 * @param {object} params
                 * @param {string} params.category
                 * @param {string} params.action
                 * @param {string} [params.label]
                 * @param {int} [params.value]
                 * @param {boolean} force Try to send by 'beacon' transport
                 * @returns {IPromise<T>}
                 */
                WebsiteAnalyticsService.prototype.fireEvent = function(name, params, force) {
                    var timer;
                    var serviceName;
                    var deferred = $q.defer();
                    var queue = {};
                    var resolved = false;
                    var now = new Date();

                    if (angular.isObject(name)) {
                        force = params;
                        params = name;
                        name = params.action;
                    }

                    for (serviceName in this._services) {
                        if (!this._services.hasOwnProperty(serviceName)) {
                            continue;
                        }
                        try {
                            queue[serviceName] = this._services[serviceName].fireEvent(name, angular.copy(params), force);
                        } catch (e) {
                            console.warn('Cant fire event by service', serviceName);
                            console.error(e);
                        }
                    }

                    function resolveQueue(response) {
                        debug && console.log('RESOLVED after', new Date() - now, response);
                        if (timer) {
                            $timeout.cancel(timer);
                        }
                        if (!resolved) {
                            resolved = true;
                            deferred.resolve(true);
                        }
                    }

                    $q.all(queue).then(
                        resolveQueue,
                        function() {
                            if (!resolved) {
                                resolved = true;
                                deferred.reject(false);
                            }
                        }
                    );

                    // create timer for force resolve promises queue
                    timer = $timeout(function() {
                        resolveQueue('TIMER');
                    }, provider.getOption('maxTimeout', 1000));

                    return deferred.promise;
                };

                // live up & register tracking services
                websiteService = new WebsiteAnalyticsService();
                for (i = 0, len = trackingServices.length; i < len; i++) {
                    serviceInstance = null;
                    service = trackingServices[i];
                    try {
                        // use string for autoload by .service or .factory
                        if (angular.isString(service)) {
                            if ($injector.has(service)) {
                                serviceInstance = $injector.get(service);
                                // for factory
                                if (angular.isFunction(serviceInstance)) {
                                    serviceInstance = new serviceInstance();
                                }
                            } else {
                                console.warn('Service or Factory "', service, '" not found');
                            }
                            // using array notation for injector
                        } else if (angular.isArray(service)) {
                            serviceInstance = $injector.invoke(service);
                        } else if (angular.isFunction(service)) {
                            serviceInstance = new service();
                        } else if (angular.isObject(service)) {
                            serviceInstance = service;
                        }
                    } catch (e) {
                        console.warn('Cant register tracking service by', service);
                        console.error(e);
                        continue;
                    }

                    websiteService.addTrackingService(serviceInstance);
                }

                return websiteService;
            }
        ];

        return provider;
    }
]);