/* Source: src/mt-includes/widgets/accordion/src/frontend/accordion_item.frontend.js*/
angular.module('website.widget.accordion').directive('motoWidgetAccordionItem', [
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