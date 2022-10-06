/* Source: src/mt-includes/widgets/twitter/frontend.js*/
angular.module('website.widget.twitter', ['website.core', 'website.widget.twitter.time_line']);
angular.module('website.widget.twitter.time_line', ['ng'])
    .directive('motoWidgetTwitterTimeLine', ['motoDependencyService', function(DependencyService) {
        return {
            restrict: 'AC',
            link: function() {
                try {
                    DependencyService.require('twitter');
                } catch (e) {}
            }
        };
    }]);