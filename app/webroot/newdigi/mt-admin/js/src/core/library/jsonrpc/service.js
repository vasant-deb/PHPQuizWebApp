/* Source: src/mt-admin/js/src/core/library/jsonrpc/service.js*/

(function() {
    'use strict';

    /**
     * @ngdoc overview
     * @name core.library.jsonrpc
     * @description
     * **JsonRPC module**
     * ---
     * JsonRPC module which includes **jsonrpc** service for sending requests and receiving answers to/from the server API.
     *
     * @requires angularFileUpload
     *
     * @TODO : Http Service Interceptor rejecting; on Http reject result onReject recieve http request, not service
     * @TODO : add Interceptors for BatchRequest
     */
    angular.module('core.library.jsonrpc', ['ngFileUpload', 'core.library.config'])
        /**
         * @ngdoc service
         * @name core.library.jsonrpc.jsonrpc
         * @description
         * **JsonRPC service**
         * ---
         * Provides and configures the jsonrpc service for sending requests and receiving answers to/from the server API.
         *
         * Uses JsonRPC request/response standards (for more information just check [official docs](http://www.jsonrpc.org/specification)).
         *
         */
        .provider('jsonrpc', ['coreLibraryConfigProvider', function(coreLibraryConfig) {
            var self = this;
            var VERBOSE = false;
            var globalInterceptors = [];
            var defaults = {};
            var requestId = 0;

            this.defaults = defaults;

            function isDevelopment() {
                return coreLibraryConfig.isDevelopment();
            }

            /**
             * Sort array by property
             *
             * @param {Array} array
             * @param {string} property
             * @returns {Array}
             */
            function sortArrayByProperty(array, property) {
                return array.sort(function compare(a, b) {
                    if (a[property] < b[property]) {
                        return -1;
                    }
                    if (a[property] > b[property]) {
                        return 1;
                    }

                    return 0;
                });
            }

            /**
             * Add new Service interceptor for global Service interceptors list
             *
             * @param {function|string|array|object} interceptor
             * @param {object} options
             * @param {number} options.priority
             * @param {function|string|string[]} options.methods
             * @returns {boolean}
             * @private
             */
            function _addInterceptor(interceptor, options) {
                var item = {
                    injected: false
                };

                if (!angular.isString(interceptor) && !angular.isFunction(interceptor) && !angular.isArray(interceptor) && !angular.isObject(interceptor)) {
                    VERBOSE && console.error('Not valid interceptor', typeof interceptor, interceptor);

                    return false;
                }

                if (!angular.isObject(options)) {
                    options = {};
                }

                item.interceptor = interceptor;
                item.priority = angular.isNumber(options.priority) ? options.priority : 100;
                item.methods = angular.isDefined(options.methods) ? options.methods : '*.*';

                if (angular.isString(item.methods)) {
                    item.methods = [item.methods];
                }

                globalInterceptors.push(item);

                return true;
            }

            /**
             * Add new interceptor for global Service interceptors list on config step
             *
             * @param {function|string|array|object} interceptor
             * @param {object} options
             * @param {number} options.priority
             * @param {function|string|string[]} options.methods
             * @returns {boolean}
             * @public
             */
            self.addInterceptor = function(interceptor, options) {
                return _addInterceptor(interceptor, options);
            };

            /**
             * Return id for json rpc request
             *
             * @wtf id must be a string
             * @returns {string}
             */
            function getRequestId() {
                return (requestId++) + '';
            }

            // defaults
            defaults.basePath = '/rpc';

            // provider.$get
            this.$get = ['$http', '$q', '$injector', 'Upload', function($http, $q, $injector, Upload) {

                globalInterceptors = sortArrayByProperty(globalInterceptors, 'priority');

                function _getInterceptors(method) {
                    var parts = method.split('.');
                    var serviceMethod = parts.pop();
                    var serviceName = parts.join('.');
                    var resultInterceptors = [];
                    var matcher;
                    var matched;
                    var interceptor;
                    var injected;
                    var i;
                    var len = globalInterceptors.length;

                    for (i = 0; i < len; i++) {
                        matched = false;
                        matcher = globalInterceptors[i].methods;
                        if (angular.isFunction(matcher)) {
                            matched = matcher({
                                service: serviceName,
                                method: serviceMethod
                            });
                        } else {
                            matched |= (matcher.indexOf('*') > -1);
                            matched |= (matcher.indexOf('*.*') > -1);
                            matched |= (matcher.indexOf(serviceName + '.*') > -1);
                            matched |= (matcher.indexOf('*.' + serviceMethod) > -1);
                            matched |= (matcher.indexOf(serviceName + '.' + serviceMethod) > -1);
                        }

                        if (!matched) {
                            continue;
                        }

                        injected = globalInterceptors[i].injected;
                        interceptor = globalInterceptors[i].interceptor;

                        if (!injected) {
                            // 'convert' global interceptor from 'config' to 'run' - live up
                            if (angular.isString(interceptor)) {
                                interceptor = $injector.get(interceptor);
                            } else if (!angular.isObject(interceptor)) {
                                interceptor = $injector.invoke(interceptor);
                            }
                            globalInterceptors[i].injected = true;
                            globalInterceptors[i].interceptor = interceptor;
                        }

                        resultInterceptors.push(interceptor);
                    }

                    return resultInterceptors;
                }

                /**
                 * 'Connect' interceptors to promise
                 *
                 * @param {Promise} promise
                 * @param {Array} interceptors
                 * @param {string} type
                 * @returns {Promise}
                 */
                function connectInterceptorsToPromise(promise, interceptors, type) {
                    var i;
                    var len;

                    if (type === 'request') {
                        for (i = interceptors.length - 1; i >= 0; i--) {
                            if (interceptors[i].request || interceptors[i].requestError) {
                                promise = promise.then(interceptors[i].request, interceptors[i].requestError);
                            }
                        }
                    }
                    if (type === 'response') {
                        for (i = 0, len = interceptors.length; i < len; i++) {
                            if (interceptors[i].response || interceptors[i].responseError) {
                                promise = promise.then(interceptors[i].response, interceptors[i].responseError);
                            }
                        }
                    }

                    return promise;
                }

                /**
                 * Makes a JSON-RPC request to `method` with `data`.
                 *
                 * @param {Object} options Call options.
                 * @param {string} options.method
                 * @param {string} [options.path]
                 * @param {Object} [options.data]
                 * @param {angular.$http.Config} config HTTP config.
                 * @param {*} files
                 * @returns {IPromise<T>}
                 */
                function jsonrpc(options, config, files) {
                    var id = getRequestId();
                    var httpConfig;
                    var httpPromise;
                    var payload = {
                        jsonrpc: '2.0',
                        method: options.method,
                        id: id
                    };
                    var deferred = $q.defer();
                    var promise = deferred.promise;
                    var progress;
                    var url;
                    var transforms = [];
                    var configTransforms;

                    config = config || {};

                    if (defaults.BeforeRequest) {
                        defaults.BeforeRequest(payload, options, config);
                    }

                    if (angular.isDefined(options.data)) {
                        payload.params = options.data;
                    }
                    // Transformers to extract the response data.
                    // TODO(arunjit): Use response interceptors when the API is stable.

                    angular.forEach($http.defaults.transformResponse, function(t) {
                        transforms.push(t);
                    });
                    transforms.push(function(data) {
                        return (data && data.id === id) ? data : null;
                    });

                    httpConfig = config.httpConfig || {};
                    configTransforms = httpConfig.transformResponse;

                    if (angular.isArray(configTransforms)) {
                        [].push.apply(transforms, configTransforms);
                    } else if (angular.isFunction(configTransforms)) {
                        transforms.push(configTransforms);
                    }

                    httpConfig.transformResponse = transforms;
                    // TODO(arunjit): Use $q to resolve the result.

                    function successResponseSolo(response) {
                        var data = response.data;

                        if (data === null) {
                            if (defaults.ErrorRequest) {
                                defaults.ErrorRequest(promise, null);
                            }
                            deferred.reject(null);
                        } else if (data && data.hasOwnProperty('error')) {
                            if (defaults.ErrorRequest) {
                                defaults.ErrorRequest(promise, data.error);
                            }
                            deferred.reject(data.error);
                        } else if (data && data.hasOwnProperty('result')) {
                            if (defaults.SuccessRequest) {
                                defaults.SuccessRequest(promise, data.result);
                            }
                            deferred.resolve(data.result);
                        } else {
                            if (defaults.ErrorRequest) {
                                defaults.ErrorRequest(promise, data);
                            }
                            deferred.reject(data);
                        }

                        return response;
                    }

                    // network error
                    function errorResponseSolo(response) {
                        if (defaults.ErrorRequest) {
                            defaults.ErrorRequest(promise, response.data);
                        }
                        deferred.reject({
                            code: response.status,
                            message: 'COMMON.MESSAGES.LOAD_DATA_FROM_SERVER_ERROR',
                            type: 'NETWORK',
                            httpError: response
                        });

                        return response;
                    }

                    url = options.path || defaults.basePath;

                    httpConfig.headers = httpConfig.headers || {};
                    httpConfig.headers['X-Requested-With'] = httpConfig.headers['X-Requested-With'] || 'XMLHttpRequest';
                    httpConfig.method = 'POST';
                    httpConfig.url = url;
                    httpConfig.data = payload;

                    if (files) {
                        httpConfig.file = files;
                    }

                    httpPromise = $q.when(httpConfig);

                    httpPromise = httpPromise.then(function(httpRequest) {
                        var deferred = $q.defer();

                        if (files) {
                            if (options.progress) {
                                progress = options.progress;
                                delete options.progress;
                            }
                            httpPromise = Upload.upload(httpRequest)
                                .progress(function(evt) {
                                    if (progress instanceof Function) {
                                        progress.call(progress, evt);
                                    }
                                });
                        } else {
                            httpPromise = $http(httpRequest);
                        }

                        httpPromise.then(deferred.resolve, deferred.reject);

                        return deferred.promise;
                    });
                    // @TODO : on reject add  httpPromise = connectInterceptorsToPromise(httpPromise, httpInterceptors, 'response');

                    httpPromise = httpPromise.then(successResponseSolo, errorResponseSolo);

                    return deferred.promise;
                }

                /**
                 * Shorthand for making a request.
                 *
                 * @param {string|null} path The call path.
                 * @param {string} method The method to call.
                 * @param {?*} data The data for the call.
                 * @param {angular.$http.Config} config HTTP config.
                 * @returns {IPromise.<T>}
                 */
                jsonrpc.request = function(path, method, data, config) {
                    if (arguments.length < 4) {
                        config = data;
                        data = method;
                        method = path;
                        path = null;
                    }

                    return jsonrpc({
                        path: path,
                        method: method,
                        data: data
                    }, config);
                };

                /**
                 * Set base api url
                 *
                 * @param {string} path
                 * @returns {core.library.jsonrpc}
                 */
                jsonrpc.setBasePath = function(path) {
                    return self.setBasePath(path);
                };

                /**
                 * Return base api url
                 *
                 * @returns {string}
                 */
                jsonrpc.getBasePath = function() {
                    return self.getBasePath();
                };

                /**
                 * Return id for json rpc request
                 *
                 * @returns {string}
                 */
                jsonrpc.getRequestId = function() {
                    return getRequestId();
                };

                /**
                 * Register start function for all JSON-RPC calls
                 *
                 * @param {function} fn
                 * @returns {core.library.jsonrpc}
                 */
                jsonrpc.setBeforeRequest = function(fn) {
                    return self.setBeforeRequest(fn);
                };

                /**
                 * Register success end function for all JSON-RPC calls
                 *
                 * @param {function} fn
                 * @returns {core.library.jsonrpc}
                 */
                jsonrpc.setEndSuccessRequest = function(fn) {
                    return self.setEndSuccessRequest(fn);
                };

                /**
                 * Register error end function for all JSON-RPC calls
                 *
                 * @param {function} fn
                 * @returns {core.library.jsonrpc}
                 */
                jsonrpc.setEndErrorRequest = function(fn) {
                    return self.setEndErrorRequest(fn);
                };

                /**
                 * Helper to create services.
                 *
                 * Usage:
                 *     module.service('locationService', function(jsonrpc) {
                 *       var service = jsonrpc.newService('locationsvc');
                 *       this.get = service.createMethod('Get');
                 *     });
                 *     ...
                 *     module.controller(..., function(locationService) {
                 *       locationService.get({max: 10}).success(function(d) {...});
                 *       // GET /rpc
                 *       // {"method": "locationsvc.Get", "params": {"max": 10}, ...}
                 *     });
                 *
                 * @param {string} name The name of the service. This is the prefix used for
                 *     all methods created through this service.
                 * @param {string} path Optional path for this service.
                 * @constructor
                 */
                function Service(name, path) {
                    this.serviceName = name;
                    this.path = path;
                }

                /**
                 * Transform success api response
                 *
                 * @param {Object} response
                 * @param {Object} request
                 * @returns {Object}
                 * @private
                 */
                function _transformResponse(response, request) {
                    var config = request.config;
                    var constructor;

                    if (angular.isObject(response) && angular.isDefined(response.data)) {
                        response = response.data;
                    }

                    if (config.transformResponse) {
                        if (angular.isString(config.transformResponse)) {
                            constructor = $injector.get(config.transformResponse);
                            if (!(response instanceof constructor)) {
                                response = new constructor(response, request);
                            }
                        } else {
                            response = $injector.invoke(config.transformResponse, null, {
                                response: response,
                                request: request
                            });
                        }
                    }

                    return response;
                }

                /**
                 * Creates a new service method.
                 *
                 * @param {string} name Method name.
                 * @param {angular.$http.Config=} config HTTP config.
                 * @returns {function} An implementation for the service method.
                 */
                Service.prototype.createMethod = function(name, config) {
                    var path = this.path;
                    var method = this.serviceName + '.' + name;
                    var handler = function(data) {
                        var serviceInterceptors = _getInterceptors(method);
                        var request = {
                            path: path,
                            method: method,
                            params: data,
                            config: null
                        };
                        var allowInterceptors = !!serviceInterceptors.length;
                        var rpcPromise;

                        config = config || {};

                        request.config = angular.copy(config);
                        request.config.httpConfig = request.config.httpConfig || {};

                        // using 'request' object with 'path', 'method', 'params' (data), 'config'
                        rpcPromise = $q.when(request);

                        if (allowInterceptors) {
                            rpcPromise = connectInterceptorsToPromise(rpcPromise, serviceInterceptors, 'request');
                        }

                        rpcPromise = rpcPromise.then(
                            function(request) {
                                var deferred = $q.defer();

                                rpcPromise = jsonrpc.request(request.path, request.method, request.params, request.config);

                                if (allowInterceptors) {
                                    rpcPromise = rpcPromise.then(
                                        function(data) {
                                            // transform 'data' to 'response' with data & config (request)
                                            return $q.resolve({
                                                data: data,
                                                request: request
                                            });
                                        },
                                        function(error) {
                                            // transform 'error' to 'response' with error & config (request)
                                            return $q.reject({
                                                error: error,
                                                request: request
                                            });
                                        }
                                    );

                                    rpcPromise = connectInterceptorsToPromise(rpcPromise, serviceInterceptors, 'response');
                                }

                                rpcPromise = rpcPromise.then(
                                    function(response) {
                                        // transform 'response' to 'data'
                                        return $q.resolve(_transformResponse(response, request));
                                    },
                                    function(response) {
                                        // transform 'response' to 'error'
                                        return $q.reject(response.error ? response.error : response);
                                    }
                                );

                                rpcPromise.then(deferred.resolve, deferred.reject);

                                return deferred.promise;
                            },
                            function(response) {
                                return $q.reject(response);
                            }
                        );

                        // fallback
                        rpcPromise.success = function(fn) {
                            if (isDevelopment()) {
                                console.warn('Some code call deprecated method "success" on ', method);
                            }
                            rpcPromise.then(fn);

                            return this;
                        };
                        rpcPromise.error = function(fn) {
                            if (isDevelopment()) {
                                console.warn('Some code call deprecated method "error" on ', method);
                            }
                            rpcPromise.then(null, fn);

                            return this;
                        };
                        rpcPromise.stopPropagation = function() {
                            if (isDevelopment()) {
                                console.warn('Some code call deprecated method "stopPropagation" on ', method);
                            }
                        };

                        return rpcPromise;
                    };

                    handler.__jsonRpcMethod = method;

                    return handler;
                };

                /**
                 * Create new service upload method
                 *
                 * @param {string} name
                 * @param {object} config
                 * @returns {Function}
                 */
                Service.prototype.createUploadMethod = function(name, config) {
                    var path = this.path;
                    var method = this.serviceName + '.' + name;

                    return function(file, data, progress) {
                        var rpcPromise;

                        if (!file) {
                            throw 'Property file not found';
                        }
                        rpcPromise = jsonrpc({
                            path: path,
                            method: method,
                            data: data,
                            progress: progress
                        }, config, file);

                        /**
                         * @deprecated fallback, use then function
                         * @param {function} callback
                         * @returns {rpcPromise}
                         */
                        rpcPromise.success = function(callback) {
                            if (isDevelopment()) {
                                console.warn('Some code call deprecated method "success" on ', method);
                            }
                            rpcPromise.then(callback);

                            return this;
                        };

                        /**
                         * @deprecated fallback, use then function
                         * @param {function} callback
                         * @returns {rpcPromise}
                         */
                        rpcPromise.error = function(callback) {
                            if (isDevelopment()) {
                                console.warn('Some code call deprecated method "error" on ', method);
                            }
                            rpcPromise.then(null, callback);

                            return this;
                        };

                        return rpcPromise;
                    };
                };

                /**
                 * Creates a new Service with the given `name` and optional `path`.
                 *
                 * @param {string} name
                 * @param {string} path
                 * @returns {Service}
                 */
                jsonrpc.newService = function(name, path) {
                    return new Service(name, path);
                };

                jsonrpc.createBatch = function() {
                    //@TODO: add options for json configuration
                    function BatchRequest() {

                    }

                    //@TODO: locking batch is doRequest already run
                    BatchRequest.prototype = {
                        _requests: [],
                        _callbacks: {},

                        /**
                         * @TODO: add return promise for each request
                         *
                         * @param {string} method
                         * @param {Object} [params]
                         * @returns {*}
                         */
                        add: function(method, params) {
                            var id = getRequestId();
                            var request = {
                                jsonrpc: '2.0',
                                id: id
                            };
                            var deferred = $q.defer();
                            var stopPropagation = false;
                            var promise = deferred.promise;
                            var callbacks = {
                                success: function() {},
                                error: function() {}
                            };

                            if (angular.isFunction(method)) {
                                method = method.__jsonRpcMethod;
                            }
                            //@TODO: decide what return or maybe throw error
                            if (!method) {
                                return false;
                            }
                            request.method = method;
                            if (angular.isDefined(params)) {
                                request.params = params;
                            }

                            promise.success = function(fn) {
                                callbacks.success = fn;

                                return this;
                            };
                            promise.error = function(fn) {
                                callbacks.error = fn;

                                return this;
                            };
                            promise.then(
                                function() {
                                    if (!stopPropagation) {
                                        callbacks.success.apply(null, arguments);
                                    }
                                },
                                function() {
                                    if (!stopPropagation) {
                                        callbacks.error.apply(null, arguments);
                                    }
                                }
                            );
                            promise.stopPropagation = function() {
                                stopPropagation = true;
                            };

                            this._requests.push(request);
                            this._callbacks[request.id] = deferred;

                            return promise;
                        },
                        isEmpty: function() {
                            return !this._requests.length;
                        },
                        doRequest: function() {
                            var self = this;
                            var deferred = $q.defer();
                            var promise = deferred.promise;
                            var stopPropagation = false;
                            var callbacks = {
                                success: function() {},
                                error: function() {}
                            };
                            var httpRequest = {
                                method: 'POST',
                                url: defaults.basePath,
                                headers: {
                                    'X-Requested-With': 'XMLHttpRequest'
                                },
                                data: this._requests
                            };

                            promise.success = function(fn) {
                                callbacks.success = fn;

                                return this;
                            };
                            promise.error = function(fn) {
                                callbacks.error = fn;

                                return this;
                            };
                            promise.then(
                                function() {
                                    if (!stopPropagation) {
                                        callbacks.success.apply(null, arguments);
                                    }
                                },
                                function() {
                                    if (!stopPropagation) {
                                        callbacks.error.apply(null, arguments);
                                    }
                                }
                            );
                            promise.stopPropagation = function() {
                                stopPropagation = true;
                            };

                            if (this.isEmpty()) {
                                deferred.resolve();

                                return promise;
                            }

                            function processResponse(response) {
                                var deferred = self._callbacks[response.id];

                                if (!deferred) {
                                    //console.log('cat find deferred for response ', response);
                                    return false;
                                }
                                if (response === null) {
                                    deferred.reject(null);
                                } else if (response && response.hasOwnProperty('error')) {
                                    deferred.reject(response.error);
                                } else if (response && response.hasOwnProperty('result')) {
                                    deferred.resolve(response.result);
                                } else {
                                    deferred.reject(response);
                                }

                                return true;
                            }

                            /**
                             * Http handler
                             *
                             * @param {Array} responses
                             * @param {int} code
                             * @param {function} headers
                             * @param {Object} requests
                             */
                            function successResponseBatch(responses, code, headers, requests) {
                                var i;
                                var len;

                                // need process each data
                                for (i = 0, len = responses.length; i < len; i++) {
                                    processResponse(responses[i], code, headers, requests);
                                }
                                deferred.resolve(responses);
                            }

                            //@TODO: maybe if global error => reject all deferreds?
                            function errorResponseBatch(responses) {
                                var i;
                                var len;

                                for (i = 0, len = responses.length; i < len; i++) {
                                    processResponse(responses[i]);
                                }
                                deferred.reject(responses);
                            }

                            /**
                             * Clear all request from stack
                             */
                            function finallyHandler() {
                                self._requests = [];
                                self._callbacks = {};
                            }

                            $http(httpRequest)
                                .success(successResponseBatch)
                                .error(errorResponseBatch)
                                .finally(finallyHandler);

                            return promise;
                        }
                    };

                    return new BatchRequest();
                };

                return jsonrpc;
            }];

            /**
             * Set the base path for all JSON-RPC calls to |path|.
             *
             * @param {string} path
             * @returns {core.library.jsonrpc}
             */
            self.setBasePath = function(path) {
                this.defaults.basePath = path;

                return this;
            };

            /**
             * Return base path
             *
             * @returns {string}
             */
            self.getBasePath = function() {
                return this.defaults.basePath;
            };

            /**
             * Register start function for all JSON-RPC calls
             *
             * @param {function} fn
             * @returns {core.library.jsonrpc}
             */
            self.setBeforeRequest = function(fn) {
                this.defaults.BeforeRequest = fn;

                return this;
            };

            /**
             * Register success end function for all JSON-RPC calls
             *
             * @param {function} fn
             * @returns {core.library.jsonrpc}
             */
            self.setEndSuccessRequest = function(fn) {
                this.defaults.SuccessRequest = fn;

                return this;
            };

            /**
             * Register error end function for all JSON-RPC calls
             *
             * @param {function} fn
             * @returns {core.library.jsonrpc}
             */
            self.setEndErrorRequest = function(fn) {
                this.defaults.ErrorRequest = fn;

                return this;
            };

        }]);
})();