/* Source: src/mt-includes/widgets/content_slider/src/frontend/slider.frontend.js*/
angular.module('website.widget.content_slider').directive('motoContentSlider', [
    'website.ContentWidgetClass',
    'website.ElementHeightWatcherClass',
    'website.WidgetsRepository',
    'MotoIntervalService',
    function(ContentWidgetClass, ElementHeightWatcherClass, WidgetsRepository, MotoIntervalService) {
        var debug = false;
        var resizeEvent = window.document.createEvent('UIEvents');

        resizeEvent.initUIEvent('resize', true, false, window, 0);

        function updateWindow() {
            setTimeout(window.dispatchEvent.bind(null, resizeEvent), 50);
        }

        // @TODO : add allowing set custom handlers

        return {
            restrict: 'A',
            scope: true,
            compile: function($element) {
                /**
                 * @type {ContentWidgetClass}
                 */
                var thisWidget = new ContentWidgetClass($element);
                /**
                 * @type {ElementHeightWatcherClass}
                 */
                var HeightWatcher = new ElementHeightWatcherClass({
                    $element: $element.find('#' + thisWidget.id + '__loader'),
                    watchSelector: '#' + thisWidget.id + '__content > .moto-widget'
                });
                var slides = $element.find('.moto-widget-content_slider__item');
                var heightWatcherInstance;
                var heightWatcherThrottleCounter = 0;

                HeightWatcher.show();
                WidgetsRepository.registry(thisWidget);

                function checkSliderItemsHeight() {
                    var widgetHeight;
                    var currentSlideHeight;

                    if (heightWatcherThrottleCounter < 5) {
                        heightWatcherThrottleCounter++;

                        return;
                    }

                    heightWatcherThrottleCounter = 0;
                    widgetHeight = $element.innerHeight();
                    currentSlideHeight = slides.eq(this.getCurrentSlide()).find('.moto-widget__content-wrapper>.moto-widget__content>.moto-cell').innerHeight();

                    if (currentSlideHeight !== widgetHeight) {
                        this.redrawSlider();
                    }
                }

                /// context for 'this' equal on compile(), pre(), post()
                debug && console.log('SLIDER : COMPILE()');

                return {
                    pre: function($scope) {
                        debug && console.log('SLIDER : PRE()');

                        thisWidget.setScope($scope);
                    },
                    post: function($scope, $element, $attrs) {
                        var instance;
                        var SliderPreferences;
                        var SliderOptions;
                        var defaultPreferences = {
                            startAnimation: 'onArriving'
                        };
                        var defaultOptions = {
                            auto: false,
                            pause: 10000,
                            controls: false,
                            pager: false,
                            stopAutoOnClick: true,
                            preloadImages: 'all'
                        };
                        var handlers = {
                            /**
                             * @context bxSlider instance
                             * @param index
                             */
                            onSliderLoad: function(index) {
                                var slide = thisWidget.getChild(index);

                                if (HeightWatcher) {
                                    HeightWatcher.destroy();
                                    HeightWatcher = null;
                                }
                                debug && console.warn('onSliderLoad()', index);

                                thisWidget.$element.removeClass('moto-widget__state_loading');
                                this.redrawSlider();

                                heightWatcherInstance = MotoIntervalService.registerCallback(checkSliderItemsHeight.bind(this));

                                if (!slide) {
                                    debug && console.warn('SLIDER : cant find slide by index', index);

                                    return;
                                }
                                slide.onVisibleImmediately(SliderPreferences);
                                updateWindow();
                            },
                            onSliderResize: function(index) {
                                var slider = thisWidget.getChild(index);

                                debug && console.warn('onSliderResize()', index);

                                if (slider) {
                                    slider.onResizing();
                                }
                            },
                            onSlideBefore: function(element, oldIndex, newIndex) {
                                var prevSlide = thisWidget.getChild(oldIndex);
                                var newSlide = thisWidget.getChild(newIndex);

                                debug && console.warn('onSlideBefore()', oldIndex, newIndex, element.attr('id'));

                                if (prevSlide) {
                                    debug && console.log('SLIDER : old slide : onVanishing()');
                                    prevSlide.onVanishing();
                                } else {
                                    debug && console.warn('SLIDER : cant find slide', oldIndex);
                                }

                                if (newSlide) {
                                    debug && console.log('SLIDER : new slide : onArriving()');
                                    newSlide.onArriving(SliderPreferences);
                                } else {
                                    debug && console.warn('SLIDER : cant find slide', newIndex);
                                }
                                updateWindow();
                            },
                            onSlideAfter: function(element, oldIndex, newIndex) {
                                var prevSlide = thisWidget.getChild(oldIndex);
                                var newSlide = thisWidget.getChild(newIndex);

                                debug && console.warn('onSlideAfter()', oldIndex, newIndex, element.attr('id'));

                                if (prevSlide) {
                                    debug && console.log('SLIDER : old slide : onVanished()');
                                    prevSlide.onVanished();
                                } else {
                                    debug && console.warn('SLIDER : cant find slide', oldIndex);
                                }

                                if (newSlide) {
                                    debug && console.log('SLIDER : new slide : onArrived()');
                                    newSlide.onArrived(SliderPreferences);
                                } else {
                                    debug && console.warn('SLIDER : cant find slide', newIndex);
                                }
                            },
                            onSlideNext: function(element, oldIndex, newIndex) {
                                debug && console.warn('onSlideNext()', oldIndex, newIndex);
                            },
                            onSlidePrev: function(element, oldIndex, newIndex) {
                                debug && console.warn('onSlidePrev()', oldIndex, newIndex);
                            }
                        };

                        debug && console.log('SLIDER : POST()');

                        $scope.params = $scope.$eval($attrs.motoContentSlider);

                        if (!angular.isObject($scope.params)) {
                            $scope.params = {};
                        }
                        if (!angular.isObject($scope.params.options)) {
                            $scope.params.options = {};
                        }
                        if (!angular.isObject($scope.params.preferences)) {
                            $scope.params.preferences = {};
                        }

                        SliderPreferences = angular.copy(defaultPreferences);
                        angular.extend(SliderPreferences, $scope.params.preferences);
                        SliderOptions = angular.copy(defaultOptions);
                        angular.extend(SliderOptions, $scope.params.options);
                        // hide controls and pager when there is just one (or zero) slide
                        if (thisWidget.$content.find('>.moto-widget-content_slider__item').length <= 1) {
                            SliderOptions.controls = false;
                            SliderOptions.pager = false;
                        }
                        angular.extend(SliderOptions, handlers);

                        debug && console.log('SLIDER : Preferences', SliderPreferences);

                        $scope.$on('UserInteraction', function(event, action) {
                            debug && console.log('SLIDER [UserInteraction] : ', action);
                            if (action === 'StartInteraction') {
                                if (instance) {
                                    debug && console.log('   => stop SlideShow');
                                    instance.stopAuto();
                                } else {
                                    debug && console.log('  => update options');
                                    SliderOptions.auto = false;
                                }
                            }
                        });

                        debug && console.log('SLIDER : Start bxSlider with options ', SliderOptions);
                        instance = thisWidget.$content.bxSlider(SliderOptions);

                        $scope.$on('$destroy', function() {
                            if (instance) {
                                instance.destroySlider();
                            }
                            if (HeightWatcher) {
                                HeightWatcher.destroy();
                                HeightWatcher = null;
                            }
                            heightWatcherInstance();
                            WidgetsRepository.forget(thisWidget);
                        });
                    }
                };
            }
        };
    }
]);