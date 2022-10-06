/* Source: src/mt-includes/widgets/google_search/src/frontend/service.js*/
angular.module('website.widget.google_search.service', [])
    .service('widget.GoogleSearch.Service', [
        'jsonrpc',
        function(jsonrpc) {
            var service = jsonrpc.newService('Widget.GoogleSearch');

            this.doSearch = service.createMethod('doSearch');
            this.getApiPath = jsonrpc.getBasePath;
        }
    ]);