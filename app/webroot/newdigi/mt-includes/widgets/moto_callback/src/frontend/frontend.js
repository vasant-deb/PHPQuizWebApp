/* Source: src/mt-includes/widgets/moto_callback/src/frontend/frontend.js*/
angular.module('website.widget.MotoCallback', []).directive('motoWidgetCallback', [
    function() {
        return {
            restrict: 'A',
            link: function($scope, $element) {
                $element.motoCallback();
            }
        };
    }
]);