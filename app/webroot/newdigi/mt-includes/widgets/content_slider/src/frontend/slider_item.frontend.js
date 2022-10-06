/* Source: src/mt-includes/widgets/content_slider/src/frontend/slider_item.frontend.js*/
angular.module('website.widget.content_slider').directive('motoWidgetContentSliderItem', [
    'website.ContentWidgetClass',
    'website.WidgetsRepository',
    function(ContentWidgetClass, WidgetsRepository) {
        var debug = false;

        return {
            restrict: 'C',
            scope: true,
            compile: function($element) {
                var thisWidget = new ContentWidgetClass($element);

                WidgetsRepository.registry(thisWidget);
                debug && console.log('SLIDER.ITEM : COMPILE()');

                return {
                    pre: function($scope) {
                        debug && console.log('SLIDER.ITEM : PRE()');
                        thisWidget.setScope($scope);
                    }
                };
            }
        };
    }
]);