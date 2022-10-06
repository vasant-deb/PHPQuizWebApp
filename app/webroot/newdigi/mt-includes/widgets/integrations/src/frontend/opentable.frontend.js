/* Source: src/mt-includes/widgets/integrations/src/frontend/opentable.frontend.js*/
/**
 * Directive motoWidgetIntegrationsOpentableLoader
 *
 * Created for loading Opentable scripts in series, not parallel.
 */

angular.module('website.widget.integrations.opentable', []).directive('motoWidgetIntegrationsOpentableLoader', [
    function() {
        var _order = [];
        var loading = false;

        function resolveNext() {
            var currentItem;
            var scriptNode;

            if (!_order.length || loading) {
                return;
            }

            loading = true;
            currentItem = _order.shift();
            scriptNode = document.createElement('script');
            scriptNode.src = currentItem.src;
            scriptNode.addEventListener('load', loaded);
            currentItem.$element[0].appendChild(scriptNode);
        }

        function loaded() {
            loading = false;
            resolveNext();
        }

        return {
            restrict: 'C',
            scope: true,
            link: function($scope, $element, $attrs) {
                _order.push({
                    src: $attrs.src,
                    $element: $element
                });

                resolveNext();
            }
        };
    }
]);