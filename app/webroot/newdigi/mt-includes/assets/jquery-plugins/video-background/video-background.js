/* Source: src/mt-includes/assets/jquery-plugins/video-background/video-background.js*/
(function($) {
    var FILL_BY_HEIGHT_CLASSNAME = 'moto-background-video_fill-by-height';
    var $elements = [];

    function checkAspectRatios($element) {
        var $videoElement = $element.find('video');
        var aspectRatioContainer;
        var aspectRatioVideo;

        function checkAndUpdateDOM() {
            $videoElement.removeClass(FILL_BY_HEIGHT_CLASSNAME);

            aspectRatioContainer = $element.outerWidth() / $element.outerHeight();
            aspectRatioVideo = $videoElement.outerWidth() / $videoElement.outerHeight();
            if (aspectRatioContainer <= aspectRatioVideo) {
                $videoElement.addClass(FILL_BY_HEIGHT_CLASSNAME);
            }
        }

        if ($videoElement[0].readyState && $videoElement[0].readyState > 0) {
            checkAndUpdateDOM();
        } else {
            $videoElement.on('loadedmetadata', checkAndUpdateDOM);
        }
    };

    $(window).on('resize', function() {
        $elements.forEach(checkAspectRatios);
    });

    $.fn.motoVideoBackground = function() {
        var $element = this;
        var isElementExistsAlready = false;

        $elements.forEach(function(element) {
            if ($element.is(element)) {
                isElementExistsAlready = true;
            }
        });

        if (!isElementExistsAlready) {
            $elements.push($element);
        }

        checkAspectRatios($element);
    };
})(jQuery);