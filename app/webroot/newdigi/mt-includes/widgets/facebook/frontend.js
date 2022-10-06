/* Source: src/mt-includes/widgets/facebook/frontend.js*/
/**
 * @TODO : create module website.widget.facebook and angular.module('website.widget.facebook_page_plugin', ['website.widget.facebook'])
 */

angular.module('website.widget.facebook_page_plugin', ['website.core'])
    .config([
        'motoWebsiteSettingsServiceProvider',
        'motoDependencyServiceProvider',
        function(WebsiteSettingsServiceProvider, DependencyServiceProvider) {
            var dependency;

            try {
                dependency = DependencyServiceProvider.get('facebook');
                dependency.setLanguage(WebsiteSettingsServiceProvider.get('preferredLocale', 'en_US'));
            } catch (e) {}
        }
    ])
    .directive('motoWidgetFacebookPagePlugin', [
        'motoDependencyService',
        function(DependencyService) {
            return {
                restrict: 'AC',
                link: function() {
                    try {
                        DependencyService.require('facebook');
                    } catch (e) {}
                }
            };
        }
    ]);