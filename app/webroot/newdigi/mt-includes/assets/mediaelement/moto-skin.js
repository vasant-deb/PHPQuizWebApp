/* Source: src/mt-includes/assets/mediaelement/moto-skin.js*/
(function($) {
    $.extend(MediaElementPlayer.prototype, {

        buildmototrackname: function(player, controls) {
            var trackNameElement;

            trackNameElement = $('<div class="mejs-moto-track-name">' + player.options.motoTrackName + '</div>');
            trackNameElement.attr('title', trackNameElement.text());
            trackNameElement.appendTo($(controls).find('.mejs-time-rail'));
        },

        buildmotoloop: function(player, controls) {
            var loopElement;

            loopElement = $('<div class="mejs-button mejs-moto-loop-button' + ((player.options.loop) ? ' mejs-button_active' : '') + '"><button></button></div>')
                .appendTo(controls)
                .click(function() {
                    player.options.loop = !player.options.loop;
                    loopElement.toggleClass('mejs-button_active');
                });
        },

        buildmotoskin: function(player, controls, layers, media) {
            var stopElement;
            var playpauseElement;
            var $controls;
            var volumeButtonElement;
            var $playerContainer;
            var $volumeControls;

            function toggleVolumeControls(containerSize) {
                // 350px is the smallest width when controls look good
                if (containerSize < 350) {
                    $volumeControls.hide();
                } else {
                    $volumeControls.show();
                }
            }

            $playerContainer = $(player.container);
            $controls = $(controls);
            $volumeControls = $controls.find('.mejs-volume-button');
            stopElement = $controls.find('.mejs-stop');
            playpauseElement = $controls.find('.mejs-playpause-button');
            stopElement.on('click', function() {
                stopElement.toggleClass('mejs-button_active');
            });
            playpauseElement.on('click', function() {
                stopElement.removeClass('mejs-button_active');
            });
            $controls.find('.mejs-volume-button').append($controls.find('.mejs-horizontal-volume-slider'));
            $controls.find('.mejs-time-rail').append($controls.find('.mejs-time'));
            volumeButtonElement = $controls.find('.mejs-volume-button button').attr('title', '');
            $controls.append($('<div class="mejs-button mejs-moto-last-hidden-button"></div>'));

            toggleVolumeControls($playerContainer.innerWidth());

            $(window).on('resize', function() {
                toggleVolumeControls($playerContainer.innerWidth());
            });

            function animationEndHandler() {
                var count = 2;
                var intervalID;

                player.setPlayerSize();
                player.setControlsSize();
                intervalID = setInterval(function() {
                    count--;
                    player.setPlayerSize();
                    player.setControlsSize();
                    if (count <= 0) {
                        clearInterval(intervalID);
                    }
                }, 500);
            }

            function hideMuteTitleText() {
                var count = 2;
                var intervalID;

                volumeButtonElement.attr('title', '');
                intervalID = setInterval(function() {
                    count--;
                    volumeButtonElement.attr('title', '');
                    if (count <= 0) {
                        clearInterval(intervalID);
                    }
                }, 500);
            }

            $controls.closest('.moto-widget-audio_player').on('animationend', animationEndHandler);
            volumeButtonElement.on('mousemove', hideMuteTitleText);
            media.addEventListener('volumechange', hideMuteTitleText);
        },

        // Copied from 2.22 version of mediaelement.js plugin
        buildstop: function(player, controls, layers, media) {
            var t = this;

            $('<div class="mejs-button mejs-stop-button mejs-stop">' +
                    '<button type="button" aria-controls="' + t.id + '" title="' + t.options.stopText + '" aria-label="' + t.options.stopText + '"></button>' +
                    '</div>')
                .appendTo(controls)
                .click(function() {
                    if (!media.paused) {
                        media.pause();
                    }
                    if (media.currentTime > 0) {
                        media.setCurrentTime(0);
                        media.pause();
                    }
                });
        },

        buildmotodownload: function(player, controls) {
            function getUrl() {
                var mp4Element = $(player.domNode).find('source[type="video/mp4"]');

                if (mp4Element.length) {
                    return mp4Element.attr('src');
                } else {
                    return player.getSrc();
                }
            }

            $('<div class="mejs-button mejs-moto-download-button"><a href="' + getUrl() + '" download></a></div>').appendTo(controls);
        }
    });
})($);