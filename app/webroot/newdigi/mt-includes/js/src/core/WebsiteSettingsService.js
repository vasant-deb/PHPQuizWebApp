/* Source: src/mt-includes/js/src/core/WebsiteSettingsService.js*/
angular.module('website.core.settings')
    .provider('motoWebsiteSettingsService', [function(undefined) {
        var self = this,
            _options = {};

        this.get = function(key, def) {
            if (key === undefined) {
                return _options;
            }

            return (_options[key] !== undefined ? _options[key] : (def || null));
        };

        this.set = function(key, value) {

            if (angular.isObject(key)) {
                for (var i in key) {
                    if (key.hasOwnProperty(i)) {
                        self.set(i, key[i]);
                    }
                }
                return;
            }

            _options[key] = value;

            return self;
        };

        this.$get = [function() {
            return self;
        }];
    }]);