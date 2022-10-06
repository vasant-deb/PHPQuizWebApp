/* Source: src/mt-includes/widgets/disqus/frontend.js*/
angular.module('website.widget.disqus', ['website.core'])
    .directive('motoWidgetDisqus', ['motoDependencyService', function(DependencyService) {
        var exists = false;

        return {
            restrict: 'AC',
            link: function($scope, $element, $attrs) {
                var params;

                try {
                    // remove element if already exists - disqus can not work with multiple widgets
                    if (exists) {
                        return $element.remove();
                    }
                    exists = true;
                    params = $attrs.params || {};
                    if (angular.isString(params)) {
                        params = angular.fromJson(params);
                    }
                    params.url = $attrs.url;
                    window['disqus_config'] = function() {
                        this.language = params.language;
                    };
                    if (params.use_identifier) {
                        delete params.url;
                    } else {
                        delete params.identifier;
                    }
                    delete params.use_identifier;
                    if (params && params.shortname && params.shortname != '') {
                        DependencyService.get('disqus')
                            // before injecting SDK we need to set params object
                            .setParams(params)
                            // after configuration we inject SDK
                            .require();
                    }
                } catch (ignored) {}
            }
        };
    }]);