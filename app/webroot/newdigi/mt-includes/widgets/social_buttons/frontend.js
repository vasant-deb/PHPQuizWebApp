/* Source: src/mt-includes/widgets/social_buttons/frontend.js*/
angular.module('website.widget.social_buttons', ['website.core'])
    .directive('motoWidgetSocialButtons', [
        '$rootScope',
        function($rootScope) {
            return {
                restrict: 'AC',
                link: function($scope, $element) {
                    // @TODO : optimize on multiply widget
                    function onLinkedInLoaded() {
                        var $li;

                        try {
                            $li = $element.find('li.social-button[data-name="linkedIn_share"]');
                            // @TODO : find all li with data-provider="linkedin" end recreate widgets
                            if ($li.length) {
                                $li = angular.element($li.get(0));
                                // @TODO : need get attributes, remove 'src' if exists & not get content
                                $li.html($li.html().replace('<span', '<script').replace('</span>', '</script>'));
                                IN.parse();
                            }
                        } catch (e) {}
                    }

                    // @TODO : scan widgets & subscribe if only widget has linkedin widgets
                    if (window.IN && angular.isFunction(window.IN.parse)) {
                        onLinkedInLoaded();
                    } else {
                        $rootScope.$on('motoDependencyService.linkedin.loaded', onLinkedInLoaded);
                    }
                }
            };
        }
    ]);