/* Source: src/mt-includes/js/src/moto_background_video/motoBackgroundVideoDirective.js*/
angular.module('website').directive('motoBackgroundVideo', [
    'website.Entertainment',
    function(Entertainment) {
        var debug = false;

        return {
            restrict: 'A',
            scope: true,
            link: function($scope, $element) {
                var videoElement = $element.find('video');
                var instance = videoElement.get(0);
                var env = {
                    $scope: $scope,
                    $element: $element
                };

                if (!instance) {
                    return;
                }

                $element.motoVideoBackground();
                videoElement.attr('playsinline', '');

                Entertainment.$onLetsDanceEvent(env, function($event) {
                    debug && console.log('bgVideo : event', $event.name, $event.defaultPrevented);
                    // update video view
                    $element.motoVideoBackground();
                    if (!instance.paused || Entertainment.isDisabledPlaying($element)) {
                        return;
                    }
                    try {
                        instance.play()
                            .then(
                                function() {
                                    debug && console.log('bgVideo : Playing');
                                },
                                function(error) {
                                    debug && console.warn('bgVideo : Ooops', error);
                                }
                            )
                            .catch(function(error) {
                                debug && console.warn('bgVideo : Playing error: ', error);
                            });
                    } catch (error) {
                        console.error(error);
                    }
                });

                Entertainment.$onLetsRestEvent(env, function($event) {
                    debug && console.log('bgVideo : event', $event.name, $event.defaultPrevented);
                    if (instance.paused) {
                        return;
                    }
                    instance.pause();
                });

                Entertainment.$onLetsStopEvent(env, function($event) {
                    debug && console.log('bgVideo : event', $event.name, $event.defaultPrevented);
                    if (instance.paused) {
                        return;
                    }
                    instance.pause();
                    instance.currentTime = 0;
                });
            }
        };
    }
]);