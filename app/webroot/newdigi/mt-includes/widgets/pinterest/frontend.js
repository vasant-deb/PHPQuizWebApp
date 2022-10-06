/* Source: src/mt-includes/widgets/pinterest/frontend.js*/
angular.module('website.widget.pinterest', ['website.core'])
    .directive('motoWidgetPinterest', ['motoDependencyService', function(DependencyService) {
        return {
            restrict: 'AC',
            link: function() {
                try {
                    DependencyService.get('pinterest')
                        .require();
                } catch (e) {}
            }
        };
    }]);