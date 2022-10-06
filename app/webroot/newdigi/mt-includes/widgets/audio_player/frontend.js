/* Source: src/mt-includes/widgets/audio_player/frontend.js*/
angular.module('website.widget.audio_player', ['website.core']).directive('motoWidgetAudioPlayer', [
    'website.MediaService',
    '$q',
    'website.Entertainment',
    function(mediaService, $q, Entertainment) {
        return {
            restrict: 'AC',
            link: function($scope, $element, $attrs) {
                var buttons = $element.find('.moto-media-player-container').data('buttons');
                var canplayBound = false;
                var playPrevented = true;
                var entertainmentEnv = {
                    $scope: $scope,
                    $element: $element
                };
                var widgetAutoplayProperties = $scope.$eval($attrs.autoplaySettings);
                var autoplay;
                var motoMediaItem;
                var mediaElementInstance;
                var audioElement;
                var sourceElement;

                if (angular.isObject(widgetAutoplayProperties)) {
                    autoplay = {
                        enabled: true,
                        allowed: Entertainment.isEnabledPlaying($element),
                        forced: widgetAutoplayProperties.forced,
                        startOn: widgetAutoplayProperties.onlyWhenVisible ? 'onFirstVisible' : 'default'
                    };
                }

                audioElement = $element.find('audio');
                sourceElement = $element.find('source');

                motoMediaItem = mediaService.registerItem({
                    node: $element,
                    scope: $scope,
                    ready: false,
                    autoplay: autoplay,
                    pause: function() {
                        canplayBound = false;
                        audioElement.off('canplay');
                        playPrevented = true;
                        mediaElementInstance.pause();
                    },
                    play: function() {
                        playPrevented = false;

                        function play() {
                            $q.when(mediaElementInstance.domNode.play())
                                .then(function() {
                                    if (playPrevented) {
                                        mediaElementInstance.domNode.pause();
                                    } else {
                                        mediaElementInstance.domNode.play();
                                    }
                                })
                                .catch(function() {
                                    playPrevented = true;
                                    mediaService.autoplayFailed();
                                });
                        }

                        if (mediaElementInstance.readyState === 4) {
                            play();
                        } else {
                            canplayBound = true;
                            audioElement.one('canplay', function() {
                                canplayBound = false;
                                play();
                            });
                        }
                    },
                    isPlaying: function() {
                        return !mediaElementInstance.paused || (!playPrevented && canplayBound);
                    }
                });

                audioElement.mediaelementplayer({
                    classPrefix: 'mejs-',
                    setDimensions: false,
                    alwaysShowControls: true,
                    motoTrackName: sourceElement.attr('track-name') || '',
                    loop: audioElement.attr('loop'),
                    timeAndDurationSeparator: '<span>/</span>',
                    startVolume: 1,
                    playText: '',
                    pauseText: '',
                    stopText: '',
                    features: [
                        'playpause',
                        buttons.stop ? 'stop' : '',
                        'progress',
                        'current',
                        'duration',
                        'mototrackname',
                        'volume',
                        buttons.loop ? 'motoloop' : '',
                        'motoskin',
                        buttons.download ? 'motodownload' : ''
                    ],
                    plugins: [],
                    duration: sourceElement.attr('track-length'),
                    success: function(mediaElement, originalNode, instance) {
                        mediaElementInstance = instance;
                        mediaService.itemReady(motoMediaItem);
                    }
                });

                Entertainment.$onLetsDanceEvent(entertainmentEnv, function() {
                    motoMediaItem.autoplay.allowed = Entertainment.isEnabledPlaying($element);
                    mediaService.checkAndAutoplayItem(motoMediaItem);
                });
                Entertainment.$onLetsStopEvent(entertainmentEnv, function() {
                    motoMediaItem.autoplay.allowed = false;
                    motoMediaItem.pause();
                });
            }
        };
    }
]);