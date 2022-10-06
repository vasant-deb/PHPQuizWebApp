/* Source: src/mt-includes/widgets/instagram/frontend.js*/
angular.module('website.widget.instagram.post', ['website.core']).directive('motoWidgetInstagramPost', [
    'motoDependencyService',
    function(DependencyService) {
        return {
            restrict: 'C',
            link: function() {
                try {
                    DependencyService.require('instagram_post');
                } catch (e) {}
            }
        };
    }
]);