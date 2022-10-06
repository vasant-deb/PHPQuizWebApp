/* Source: src/mt-includes/widgets/actions/src/frontend/scroll_to_anchor.frontend.js*/
angular.module('website.widget.actions.scroll_to', []).directive('motoWidgetActionsScrollTo', [
    function() {
        return {
            restrict: 'C',
            scope: true,
            link: function($scope, $element, $attrs) {
                var anchor = $attrs.anchor;
                var time = parseFloat($attrs.time) * 1000;

                if (angular.isDefined(anchor)) {
                    $element.on('click', function() {
                        var $anchor = $('a[name=' + anchor + ']');

                        if ($anchor.length) {
                            $('html, body').animate({
                                scrollTop: $anchor.offset().top
                            }, time);
                        }
                    });
                }
            }
        };
    }
]);