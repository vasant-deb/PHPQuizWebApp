/* Source: src/mt-includes/widgets/video_player/frontend.js*/
angular.module('website.widget.video_player', ['website.core', 'website.core.media'])

    // @ATTENTION : this directive will start on widgets 'video_player', 'audio_player'
    .directive('motoMediaPlayer', [
        function() {
            return {
                restrict: 'AC',
                scope: true,
                compile: function($element) {
                    return {
                        pre: function($scope) {
                            //prevent binding if parents not has specific css class
                            if ($element.closest('.moto-widget_interactive').length < 1) {
                                return;
                            }

                            function onInteraction() {
                                $scope.$emit('UserInteraction', 'StartInteraction');
                            }

                            $element.on('click', onInteraction);
                            $scope.$on('$destroy', function() {
                                $element.off('click', onInteraction);
                            });
                        }
                    };
                }
            };
        }
    ])

    .directive('motoWidgetVideoPlayer', [
        'website.MediaService',
        '$q',
        'website.Entertainment',
        function(mediaService, $q, Entertainment) {
            return {
                restrict: 'AC',
                link: function($scope, $element, $attrs) {
                    var canplayBound = false;
                    var playPrevented = true;
                    var entertainmentEnv = {
                        $scope: $scope,
                        $element: $element
                    };
                    var widgetAutoplayProperties = $scope.$eval($attrs.autoplaySettings);
                    var autoplay;
                    var motoMediaItem;
                    var videoElement;
                    var mediaElementInstance;
                    var buttons = $element.find('.moto-media-player-container').data('buttons');

                    if (angular.isObject(widgetAutoplayProperties)) {
                        autoplay = {
                            enabled: true,
                            allowed: Entertainment.isEnabledPlaying($element),
                            forced: widgetAutoplayProperties.forced,
                            startOn: widgetAutoplayProperties.onlyWhenVisible ? 'onFirstVisible' : 'default'
                        };
                    }

                    videoElement = $element.find('video');
                    videoElement.on('loadeddata', function() {
                        mediaElementInstance.options.alwaysShowControls = false;
                    });

                    motoMediaItem = mediaService.registerItem({
                        node: $element,
                        scope: $scope,
                        ready: false,
                        autoplay: autoplay,
                        pause: function() {
                            canplayBound = false;
                            videoElement.off('canplay');
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
                                videoElement.one('canplay', function() {

                                    canplayBound = false;
                                    play();
                                });
                            }
                        },
                        isPlaying: function() {
                            return !mediaElementInstance.paused || (!playPrevented && canplayBound);
                        }
                    });

                    videoElement.mediaelementplayer({
                        classPrefix: 'mejs-',
                        motoTrackName: videoElement.attr('title') || '',
                        timeAndDurationSeparator: '<span>/</span>',
                        startVolume: 1,
                        playText: '',
                        pauseText: '',
                        alwaysShowControls: true,
                        fullscreenText: '',
                        allyVolumeControlText: '',
                        videoVolume: 'horizontal',
                        features: [
                            'playpause',
                            'progress',
                            'current',
                            'duration',
                            'mototrackname',
                            'volume',
                            'fullscreen',
                            buttons.download ? 'motodownload' : '',
                            'motoskin'
                        ],
                        plugins: [],
                        duration: videoElement.attr('duration'),
                        success: function(mediaElement, originalNode, instance) {
                            mediaElementInstance = instance;
                            mediaService.itemReady(motoMediaItem);
                        }
                    });
                    Entertainment.$onLetsDanceEvent(entertainmentEnv, function() {
                        if (mediaElementInstance) {
                            mediaElementInstance.globalResizeCallback();
                        }
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