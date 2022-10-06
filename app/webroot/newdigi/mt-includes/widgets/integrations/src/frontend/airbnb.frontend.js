/* Source: src/mt-includes/widgets/integrations/src/frontend/airbnb.frontend.js*/
/**
 * Directive motoWidgetIntegrationsAirbnb
 */

angular.module('website.widget.integrations.airbnb', []).directive('motoWidgetIntegrationsAirbnb', [
    'motoDependencyService',
    function(DependencyService) {
        return {
            restrict: 'AC',
            link: function() {
                try {
                    window.AirbnbAPI.bootstrap();
                } catch (e) {
                    DependencyService.require('airbnb_embed');
                }
            }
        };
    }
]);