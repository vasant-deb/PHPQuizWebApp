/* Source: src/mt-includes/js/src/core/utils/init.js*/
angular.module('website.core.utils', []).provider('MotoUtils', [
    function() {
        var provider = this;

        /**
         * Return value of target object using "dot" notation.
         *
         * @param {Object} target Target object
         * @param {String|Number} path Key path of a value
         * @param {*} defaultValue Default value if key not exists
         * @returns {*} Return value of defaultValue if key not exists
         * @private
         */
        provider.getValue = function(target, path, defaultValue) {
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
        };

        provider.$get = function() {
            return provider;
        };

        return provider;
    }
]);