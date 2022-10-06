/* Source: src/mt-includes/js/src/core/DependencyDirective.js*/
angular.module('website.core.dependency')
    .directive('motoDependencyRequire', ['motoDependencyService', function(DependencyService) {

        return {
            restrict: 'A',
            link: function($scope, $element, $attrs) {
                var required = $attrs.motoDependencyRequire,
                    value = required;
                try {
                    value = $scope.$eval(value);
                    if (angular.isUndefined(value)) {
                        value = required;
                    }
                } catch (e) {
                    value = required;
                }
                if (angular.isFunction(value)) {
                    value = value();
                }

                DependencyService.require(value);

            }
        };

    }]);