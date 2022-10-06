/* Source: src/mt-includes/js/src/back_to_top_button/BackToTopButtonDirective.js*/
/**
 * <moto-back-to-top-button></moto-back-to-top-button>
 */
angular.module('website')
    .directive('motoBackToTopButton', ['$window', function($window) {
        var settings = window.websiteConfig && window.websiteConfig.back_to_top_button || {};

        settings.enabled = settings.type !== 'none';
        settings.topOffset = parseInt(settings.topOffset) || 300;
        settings.animationTime = parseInt(settings.animationTime) || 500;
        settings.cssVisibleClass = 'moto-back-to-top-button_visible';
        settings.cssAnimationClass = 'animated';

        return {
            restrict: 'EA',
            link: function($scope, $element) {
                var _window = angular.element($window);
                var isVisible = null;
                var temp = null;

                // Go to page top
                $scope.toTop = function() {
                    try {
                        $('body,html').animate({
                            scrollTop: 0
                        }, settings.animationTime);
                    } catch (e) {}
                };

                // Callback handler for window scroll
                function onScroll() {
                    $element.removeAttr('style');
                    try {
                        temp = (_window.scrollTop() > settings.topOffset);
                        //ng-class is slowly => using temp var and css animation
                        if (temp !== isVisible) {
                            isVisible = temp;
                            if (isVisible) {
                                $element.addClass(settings.cssVisibleClass);
                                $element.addClass(settings.cssAnimationClass);
                            } else {
                                $element.removeClass(settings.cssVisibleClass);
                                $element.addClass(settings.cssAnimationClass);
                            }
                        }
                    } catch (e) {}
                }

                if (settings.enabled) {
                    _window.scroll(onScroll);
                }

            }
        };
    }]);