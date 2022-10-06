/* Source: src/mt-includes/js/src/core/analytics/GoogleAnalytics/init.js*/
angular.module('website.core.analytics.google', ['website.core.analytics']).provider('MotoGoogleAnalyticsService', [
    'MotoWebsiteAnalyticsProvider',
    function(MotoWebsiteAnalyticsProvider) {
        var AbstractClass = MotoWebsiteAnalyticsProvider.getAbstractTrackingService();
        var debug = false;

        this.$get = [
            '$q',
            function($q) {

                function getTracker() {
                    return window['ga'];
                }

                /**
                 * @extends AbstractTrackingServiceClass
                 * @constructor
                 */
                function GoogleAnalyticsService() {
                    AbstractClass.apply(this, arguments);
                }

                GoogleAnalyticsService.prototype = Object.create(AbstractClass.prototype);
                GoogleAnalyticsService.prototype.constructor = GoogleAnalyticsService;

                /** @inheritdoc */
                GoogleAnalyticsService.prototype.getName = function() {
                    return 'GoogleAnalytics';
                };

                /** @inheritdoc */
                GoogleAnalyticsService.prototype.fireEvent = function(name, params, force) {
                    var deferred = $q.defer();
                    var tracker = getTracker();
                    var data = {};

                    if (!tracker) {
                        debug && console.warn('Tracker not found');

                        return false;
                    }
                    if (!angular.isString(name) || name.length < 1) {
                        debug && console.warn('Bad name', name);

                        return false;
                    }
                    if (!angular.isObject(params)) {
                        debug && console.warn('Bad params', params);

                        return false;
                    }
                    if (angular.isUndefined(params['category']) || !angular.isString(params['category']) || params['category'].length < 1) {
                        debug && console.warn('Bad params.category', params['category']);

                        return false;
                    }
                    data.eventCategory = params['category'];

                    data.eventAction = name;
                    if (angular.isString(params['action']) && params['action'].length > 1) {
                        data.eventAction = params['action'];
                    }

                    if (angular.isString(params['label']) && params['label'].length > 0) {
                        data.eventLabel = params['label'];
                    }
                    if (angular.isNumber(params['value'])) {
                        data.eventValue = params['value'];
                    }

                    if (force) {
                        data.transport = 'beacon';
                    }
                    data.hitCallback = function() {
                        debug && console.log('data.hitCallback()');
                        deferred.resolve(true);
                    };
                    debug && console.log('Send event', angular.copy(data));
                    tracker('send', 'event', data);

                    return deferred.promise;
                };

                return new GoogleAnalyticsService();
            }
        ];

        return this;
    }
]);