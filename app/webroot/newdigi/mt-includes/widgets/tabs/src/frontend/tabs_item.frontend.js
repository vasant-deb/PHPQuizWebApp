/* Source: src/mt-includes/widgets/tabs/src/frontend/tabs_item.frontend.js*/
angular.module('website.widget.tabs').directive('motoWidgetTabsItem', [
    'website.WidgetsRepository',
    function(WidgetsRepository) {
        return {
            restrict: 'C',
            scope: true,
            compile: function($element) {
                var thisWidget = WidgetsRepository.registry($element);

                return {
                    pre: function($scope) {
                        thisWidget.setScope($scope);
                    }
                };
            }
        };
    }
]);