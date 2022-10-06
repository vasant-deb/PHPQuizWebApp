/* Source: src/mt-includes/widgets/tabs/src/frontend/tabs.frontend.js*/
angular.module('website.widget.tabs').directive('motoWidgetTabs', [
    'website.WidgetsRepository',
    'website.Entertainment',
    function(WidgetsRepository, Entertainment) {
        return {
            restrict: 'C',
            scope: true,
            compile: function($element) {
                var thisWidget = WidgetsRepository.registry($element);

                return {
                    pre: function($scope) {
                        thisWidget.setScope($scope);
                    },
                    post: function() {
                        $element.motoTabs({
                            onOpened: function(item) {
                                var widget = thisWidget.getChild(item.id);

                                Entertainment.letsDance(widget);
                                Entertainment.letsStartAnimation(widget);
                            },
                            onClosed: function(item) {
                                Entertainment.letsStopDancing(thisWidget.getChild(item.id));
                            }
                        });
                    }
                };
            }
        };
    }
]);