/* Source: src/mt-includes/js/src/moto_website_directives/body.js*/
angular.module('website').directive('body', [
    '$rootScope',
    'website.Entertainment',
    'website.WidgetsRepository',
    function($rootScope, Entertainment, WidgetsRepository) {
        return {
            restrict: 'E',
            compile: function($element) {
                var thisWidget = WidgetsRepository.registry({
                    id: 'body',
                    name: '@body',
                    $scope: $rootScope,
                    $element: $element
                });

                // start dom compile and collect widgets
                WidgetsRepository.setDefaultParent(thisWidget);

                return {
                    post: function() {
                        // widgets collected
                        WidgetsRepository.setDefaultParent(null);
                        Entertainment.letsDance(thisWidget);
                    }
                };
            }
        };
    }
]);