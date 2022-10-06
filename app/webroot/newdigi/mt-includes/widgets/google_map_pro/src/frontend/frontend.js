/* Source: src/mt-includes/widgets/google_map_pro/src/frontend/frontend.js*/
angular.module('website.widget.google_map_pro', []).directive('motoWidgetGoogleMapProWrapper', [
    function() {
        return {
            restrict: 'C',
            link: function($scope, $element, $attrs) {
                $element.motoGoogleMap(JSON.parse($attrs.mapProperties)).then(
                    function(instance) {
                        instance.addMarker(JSON.parse($attrs.mapMarkers));
                    }
                );
            }
        };
    }
]);