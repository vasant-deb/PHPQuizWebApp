/* Source: src/mt-includes/widgets/slider/frontend.js*/
angular.module('website.widget.slider', []).directive('motoSliderOptions', [
    '$timeout',
    'website.Entertainment',
    function($timeout, Entertainment) {
        function getSliderSettings(properties) {
            if (properties.itemsCount < 2) {
                properties.showPaginationDots = false;
            }

            return {
                mode: properties.slideshowAnimationType,
                auto: false,
                pause: properties.slideshowDelay * 1000,
                controls: properties.showNextPrev,
                pager: properties.showPaginationDots,
                captions: properties.showSlideCaptions,
                stopAutoOnClick: true
            };
        }

        return {
            restrict: 'A',
            priority: 450,
            link: function($scope, $element, $attrs) {
                var entertainmentEnv = {
                    $scope: $scope,
                    $element: $element
                };
                var properties = $scope.$eval($attrs.motoSliderOptions);
                var settings = getSliderSettings(properties);
                var instance;

                settings.onSliderLoad = function() {
                    $element.closest('.moto-widget-slider').removeClass('moto-widget-slider-loader');
                };
                instance = $element.bxSlider(settings);
                $scope.$on('$destroy', instance.destroySlider);

                Entertainment.$onLetsDanceEvent(entertainmentEnv, function() {
                    instance.redrawSlider();
                    if (Entertainment.isDisabledPlaying($element)) {
                        return;
                    }
                    if (properties.slideshowEnabled) {
                        instance.startAuto();
                    }
                    $timeout(instance.redrawSlider);
                });
                Entertainment.$onLetsStopEvent(entertainmentEnv, function() {
                    instance.stopAuto();
                });

            }
        };
    }
]);