/* Source: src/mt-includes/js/src/rendering/render_service.js*/
angular.module('website.backend.RenderService').service('Website.Backend.RenderService', [
    'jsonrpc',
    function(jsonrpc) {
        var service = jsonrpc.newService('Website.RenderService');

        this.render = service.createMethod('render');
    }
]);