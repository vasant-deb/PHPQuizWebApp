/* Source: src/mt-includes/widgets/carousel/frontend.js*/
angular.module('website.widget.carousel', []).directive('motoCarouselOptions', [
    '$timeout',
    'website.Entertainment',
    function($timeout, Entertainment) {
        function getCarouselSettings(properties) {
            if (properties.itemsCount < 2) {
                properties.showPaginationDots = false;
            }

            return {
                mode: 'horizontal',
                auto: false,
                pause: properties.slideshowDelay * 1000,
                controls: properties.showNextPrev,
                pager: properties.showPaginationDots,
                slideWidth: properties.slideWidth,
                minSlides: properties.minSlides,
                maxSlides: properties.maxSlides,
                moveSlides: properties.moveSlides,
                slideMargin: properties.margins,
                stopAutoOnClick: true,
                shrinkItems: true
            };
        }

        /**
         * Patch toggle controls directions
         *
         * @param {jQuery} [$element]
         * @returns {boolean}
         */
        function toggleControls($element) {
            var $wrapper;
            var $controls;

            if (!angular.isElement($element)) {
                $element = this;
            }

            if (!angular.isElement($element)) {
                return false;
            }

            try {
                $wrapper = $element.parent().parent();
                $controls = $($wrapper.find('> .bx-controls')[0]);
                if ($controls.find('.bx-pager > .bx-pager-item').length > 1) {
                    $controls.find('.bx-controls-direction > a').removeClass('disabled');
                } else {
                    $controls.find('.bx-controls-direction > a').addClass('disabled');
                }
            } catch (e) {}

            return true;
        }

        return {
            restrict: 'A',
            priority: 450,
            link: function($scope, $element, $attrs) {
                var entertainmentEnv = {
                    $scope: $scope,
                    $element: $element
                };
                var properties = $scope.$eval($attrs.motoCarouselOptions);
                var settings = getCarouselSettings(properties);
                var instance;

                settings.onSliderLoad = function() {
                    $element.closest('.moto-widget-carousel').removeClass('moto-widget-carousel-loader');
                };
                if (settings.controls && settings.pager) {
                    settings.onSliderResize = toggleControls.bind($element);
                }

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