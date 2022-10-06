/* Source: src/mt-admin/js/src/core/library/config/service.js*/

(function() {
    'use strict';
    /**
     * @ngdoc overview
     * @name core.library.config
     * @description
     * **Library Config module**
     * ---
     * Configuration module for application and other modules. Allows to get needed config property from server by using coreLibraryConfig service.
     *
     * @TODO : deprecated function, after complete update all code
     * @TODO : add auto tests
     */
    try {
        angular.module('application.config.value');
    } catch (e) {
        angular.module('application.config.value', ['ng'])
            .constant('application.config.value', null);
    }

    angular.module('core.library.config', ['application.config.value'])
        /**
         * @ngdoc service
         * @name core.library.config.coreLibraryConfig
         * @description
         * **Config service**
         * ---
         * Configuration Service for application and modules which allows to get needed config property from server by providing key_name
         *
         * @example
         * <pre>
         *     coreLibraryConfig.key('key_name');
         * </pre>
         *
         */
        .provider('coreLibraryConfig', ['application.config.value', function(config) {
            var provider = this;
            var cfg = {};
            var _isDevelopment = false;
            var _isTesting = false;
            var _isProduction = true;
            var _stage = 'production';
            var _startAtDate = new Date();
            var _startAtTime = _startAtDate.getTime();
            var _isDemoMode = false;
            var temp;

            if (angular.isObject(config)) {
                cfg = config;
            } else {
                // @TODO : remove after cancel using 'app.config'
                cfg = app.config || cfg;
            }

            if (angular.isDefined(cfg['env']) && ['development', 'testing'].indexOf(cfg['env']) !== -1) {
                _stage = cfg['env'];
            }

            _isDevelopment = (_stage === 'development');
            _isTesting = (_stage === 'testing');
            _isProduction = (_stage === 'production');

            if (angular.isDefined(cfg.isDemoMode)) {
                _isDemoMode = cfg.isDemoMode;
            }

            /**
             * Get or update configuration value
             *
             * @param {String} path
             * @param value
             * @return {Object} configuration value
             * @deprecated
             */
            function keyFromDeep(path, value) {
                var keys = [];
                var objectProperty = null;
                var i;
                var len;

                if (path && angular.isString(path)) {
                    objectProperty = cfg;
                    keys = path.split('.');
                    len = value ? keys.length - 1 : keys.length;
                }

                for (i = 0; i < len; i++) {
                    if (keys[i] && objectProperty.hasOwnProperty(keys[i])) {
                        objectProperty = objectProperty[keys[i]];
                    } else {
                        objectProperty = null;
                        break;
                    }
                }

                if (value && objectProperty && objectProperty.hasOwnProperty(keys[i])) {
                    objectProperty = objectProperty[keys[i]] = angular.copy(value);
                }

                return objectProperty;
            }

            /**
             * Return value of target object using "dot" notation.
             *
             * @param {Object} target Target object
             * @param {String|Number} path Key path of a value
             * @param {*} defaultValue Default value if key not exists
             * @returns {*} Return value of defaultValue if key not exists
             * @private
             */
            function _getData(target, path, defaultValue) {
                var i;
                var value;
                var len;
                var keys;

                if (angular.isNumber(path)) {
                    if (isNaN(path)) {
                        return defaultValue;
                    }
                    path += '';
                }

                if (!angular.isString(path) || path.length < 1) {
                    return defaultValue;
                }

                // for source['a.b']
                if (angular.isDefined(target[path])) {
                    return target[path];
                }

                keys = path.split('.');

                try {
                    value = target;
                    for (i = 0, len = keys.length; i < len; i++) {
                        if (angular.isDefined(value)) {
                            value = value[keys[i]];
                        }
                    }
                    if (angular.isDefined(value)) {
                        return value;
                    }
                } catch (ignored) {}

                return defaultValue;
            }

            /**
             * Check is exists key in target object using "dot" notation
             *
             * @param {Object} target Target object
             * @param {String|Number} path Key path for search
             * @returns {Boolean} Return true if exists value
             * @private
             */
            function _existsKeyOnObject(target, path) {
                var i;
                var len;
                var keys;

                if (angular.isNumber(path)) {
                    if (isNaN(path)) {
                        return false;
                    }
                    path += '';
                }

                if (!angular.isString(path) || path.length < 1) {
                    return false;
                }

                // for source['a.b']
                if (angular.isDefined(target[path])) {
                    return true;
                }

                keys = path.split('.');

                for (i = 0, len = keys.length; i < len; i++) {
                    if (angular.isUndefined(target[keys[i]])) {
                        return false;
                    }
                    target = target[keys[i]];
                }

                return true;
            }

            /**
             * Set an item value to object using "dot" notation
             *
             * @param {Object} target Target object
             * @param {String|Number} path Path to value
             * @param {*} value New value
             * @returns {Boolean} Return false if path is undefined or empty
             * @private
             */
            function _updateObject(target, path, value) {
                var i;
                var len;
                var keys;
                var key;

                if (angular.isNumber(path)) {
                    if (isNaN(path)) {
                        return false;
                    }
                    path += '';
                }

                if (!angular.isString(path) || path.length < 1) {
                    return false;
                }

                if (angular.isDefined(target[path])) {
                    target[path] = value;

                    return true;
                }

                keys = path.split('.');

                try {
                    for (i = 0, len = keys.length; i < len; i++) {
                        key = keys[i];
                        // detect last level
                        if (i === len - 1) {
                            break;
                        }
                        if (angular.isUndefined(target[key])) {
                            target[key] = {};
                        } else if (!angular.isObject(target[key]) || angular.isArray(target[key])) {
                            // strict mode
                            return false;
                        }
                        target = target[key];
                    }

                    target[key] = value;
                } catch (e) {
                    console.error(e);
                }

                return true;
            }

            /**
             * Extend an item value by object using "dot" notation
             *
             * @param {Object} target Target object
             * @param {String|Number} path Path to value
             * @param {*} value Part of value
             * @returns {Boolean} Return false if path is undefined or empty
             * @private
             */
            function _extendObject(target, path, value) {
                var i;
                var len;
                var keys;
                var key;

                if (angular.isNumber(path)) {
                    if (isNaN(path)) {
                        return false;
                    }
                    path += '';
                }

                if (!angular.isString(path) || path.length < 1) {
                    return false;
                }

                if (angular.isDefined(target[path])) {
                    angular.extend(target[path], value);

                    return true;
                }

                keys = path.split('.');

                try {
                    for (i = 0, len = keys.length; i < len; i++) {
                        key = keys[i];
                        // detect last level
                        if (i === len - 1) {
                            break;
                        }
                        if (angular.isUndefined(target[key])) {
                            target[key] = {};
                        } else if (!angular.isObject(target[key]) || angular.isArray(target[key])) {
                            // strict mode
                            return false;
                        }
                        target = target[key];
                    }

                    angular.extend(target[key], value);
                } catch (e) {
                    console.error(e);
                }

                return true;
            }

            // patcher
            temp = _getData(cfg, 'settings.website.features');
            if (angular.isString(temp)) {
                temp = angular.fromJson(temp);
                if (angular.isObject(temp)) {
                    cfg.settings.website.features = temp;
                }
            }
            temp = _getData(cfg, '__features__');
            if (angular.isString(temp)) {
                temp = angular.fromJson(temp);
                if (angular.isObject(temp)) {
                    cfg['__features__'] = temp;
                }
            }

            /**
             * Check is development stage
             *
             * @returns {Boolean} Return true if development stage enabled
             */
            this.isDevelopment = function() {
                return _isDevelopment;
            };

            /**
             * Check is testing stage
             *
             * @returns {Boolean} Return true if testing stage enabled
             */
            this.isTesting = function() {
                return _isTesting;
            };

            /**
             * Check is production stage
             *
             * @returns {Boolean} Return true if production stage enabled
             */
            this.isProduction = function() {
                return _isProduction;
            };

            /**
             * Check is demo mode enabled
             *
             * @returns {Boolean} Return true if demo mode enabled
             */
            this.isDemoMode = function() {
                return _isDemoMode;
            };

            /**
             * Return current stage
             *
             * @returns {String} Return stage name
             */
            this.getStage = function() {
                return _stage;
            };

            /**
             * Return copy of config value using "dot" notation
             *
             * @param {String|Number} key Config key
             * @param {*} defaultValue Default value if key not exists
             * @returns {*} Return config value of defaultValue if key not exists
             */
            this.get = function(key, defaultValue) {
                var value;

                value = _getData(cfg, key, defaultValue);

                if (value) {
                    value = angular.copy(value);
                }

                return value;
            };

            /**
             * Check is exists key in config using "dot" notation
             *
             * @param {String|Number} key Key for search
             * @returns {Boolean} Return true if value was set
             */
            this.exists = function(key) {
                return _existsKeyOnObject(cfg, key);
            };

            /**
             * Set copy of value to config using "dot" notation
             *
             * @param {String|Number} key Config key
             * @param {*} value New value
             * @returns {Boolean} Return false if path is empty or value can't be copy
             */
            this.update = function(key, value) {
                try {
                    value = angular.copy(value);
                } catch (e) {
                    return false;
                }

                // @TODO : remove after cancel using 'app.config'
                if (app && app.config) {
                    _updateObject(app.config, key, value);
                }

                return _updateObject(cfg, key, value);
            };

            /**
             * Extend settings value by copy of value to config using "dot" notation
             *
             * @param {String|Number} key Config key
             * @param {*} value Patch value
             * @returns {Boolean} Return false if path is empty or value can't be copy
             */
            this.extend = function(key, value) {
                try {
                    value = angular.copy(value);
                } catch (e) {
                    return false;
                }

                // @TODO : remove after cancel using 'app.config'
                if (app && app.config) {
                    _extendObject(app.config, key, value);
                }

                return _extendObject(cfg, key, value);
            };

            /**
             * Return current system build
             *
             * @returns {Number} If build not set, return script start time
             */
            this.getBuild = function() {
                return parseInt(_getData(cfg, 'settings.system.build', _startAtTime));
            };

            /**
             * Return current system version
             *
             * @returns {String} Return '3.1.6' when version is not exists
             */
            this.getVersion = function() {
                return _getData(cfg, 'settings.system.version', '3.1.6');
            };

            /**
             * Get configuration value
             *
             * @param {String} key  key
             * @return {String} configuration value
             * @deprecated
             */
            this.key = function(key) {
                if (cfg.hasOwnProperty(key)) {
                    return cfg[key];
                }

                return null;
            };

            /**
             * Get deep configuration value by path
             *
             * @param {String} path
             * @param {*} defaultValue Default value
             * @return {Object} configuration value
             * @deprecated
             */
            this.keyPath = function(path, defaultValue) {
                var keyValue;

                keyValue = keyFromDeep(path);

                return (keyValue ? keyValue : angular.isDefined(defaultValue) ? defaultValue : null);
            };

            /**
             * Set deep configuration value by path
             *
             * @param {String} key
             * @param {Object} value
             * @deprecated
             */
            this.setValueByPath = function(key, value) {
                return !!(angular.isDefined(value) && keyFromDeep(key, value));
            };

            this.$get = [function() {

                return {
                    isDevelopment: provider.isDevelopment,
                    isTesting: provider.isTesting,
                    isProduction: provider.isProduction,
                    isDemoMode: provider.isDemoMode,
                    getStage: provider.getStage,
                    get: provider.get,
                    exists: provider.exists,
                    update: provider.update,
                    extend: provider.extend,
                    getBuild: provider.getBuild,
                    getVersion: provider.getVersion,

                    // deprecated
                    key: provider.key,
                    keyPath: provider.keyPath,
                    setValueByPath: provider.setValueByPath
                };
            }];

        }]);
})();