/* Source: src/mt-includes/js/src/before_viewport/directive.js*/
/**
 * Directive motoBeforeInViewport
 *
 * All elements with class 'moto-before-in-viewport' will be watched by directive.
 * As soon as they will be visible in viewport this class will be removed.
 *
 * Directive can work in several modes:
 *     'part' - (default) element is visible if at least one pixel in viewport
 *     'full' - element is visible if at all pixels in viewport. ATTENTION: in this mode element can be never visible if it`s very high or viewport is small
 * To set mode use attribute 'moto-before-in-viewport-mode'.
 *
 * @example
 *
 * <div class="moto-widget moto-widget-any moto-before-in-viewport"></div>
 * <div class="moto-widget moto-widget-any moto-before-in-viewport" moto-before-in-viewport-on-enter="openPopup()"></div>
 * <div class="moto-widget moto-widget-any moto-before-in-viewport" moto-before-in-viewport-watch-always="1" moto-before-in-viewport-on-leave="stop()" moto-before-in-viewport-on-enter="play()"></div>
 * <div class="moto-widget moto-widget-any moto-before-in-viewport" moto-before-in-viewport-watch-always="1"></div>
 * <div class="moto-widget moto-widget-any moto-before-in-viewport" moto-before-in-viewport-mode="full"></div>
 * <div class="moto-widget moto-widget-any moto-before-in-viewport" moto-before-in-viewport-mode="part"></div>
 */

angular.module('website')
    .directive('motoBeforeInViewport', [
        'motoBeforeInViewport',
        function(motoBeforeInViewport) {
            return {
                restrict: 'C',
                link: function($scope, $element, $attrs) {
                    var newItem = {};

                    newItem.element = $element;
                    newItem.$scope = $scope;
                    newItem.onEnter = $attrs.motoBeforeInViewportOnEnter;
                    newItem.onLeave = $attrs.motoBeforeInViewportOnLeave;
                    newItem.visibilityMode = $attrs.motoBeforeInViewportMode;
                    newItem.watchAlways = angular.isDefined($attrs.motoBeforeInViewportWatchAlways) ? $attrs.motoBeforeInViewportWatchAlways : $element.closest('.moto-widget_interactive').length > 0;

                    motoBeforeInViewport.startWatching(newItem);
                }
            };
        }
    ]);