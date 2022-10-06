/* Source: src/mt-includes/widgets/moto_callback/src/frontend/moto_callback.jquery.plugin.js*/
(function($) {
    $.fn.motoCallback = function() {
        var $element = this;
        var $openButton = $element.find('.moto-widget-callback__open-button');
        var $closeButton = $element.find('.moto-widget-callback__close-button');
        var $moreDetailsButton = $element.find('.moto-widget-callback__more-details-button');
        var $moreDetails = $element.find('.moto-widget-callback__more-details-wrapper');
        var $callbackBody = $element.find('.moto-widget-callback__body');
        var ANIMATION_DURATION = 400;

        function openCallback() {
            if ($element.hasClass('moto-widget-callback_opened') || $element.hasClass('moto-widget-callback_opening') || $element.hasClass('moto-widget-callback_closing')) {
                return;
            }

            $element.removeClass('moto-widget-callback_closed');
            $element.addClass('moto-widget-callback_opening');

            // firstly we have to set normal width and only then show content and hide button
            $callbackBody.animate({
                width: 280
            }, ANIMATION_DURATION / 2, function() {
                $openButton.slideUp(ANIMATION_DURATION / 2);
                $callbackBody.slideDown(ANIMATION_DURATION / 2, function() {
                    $element.removeClass('moto-widget-callback_opening');
                    $element.addClass('moto-widget-callback_opened');
                });
            });
        }

        function closeCallback() {
            if ($element.hasClass('moto-widget-callback_closed') || $element.hasClass('moto-widget-callback_opening') || $element.hasClass('moto-widget-callback_closing')) {
                return;
            }

            $element.removeClass('moto-widget-callback_opened');
            $element.addClass('moto-widget-callback_closing');
            $openButton.slideDown(ANIMATION_DURATION);
            $callbackBody.slideUp(ANIMATION_DURATION, function() {
                $element.removeClass('moto-widget-callback_closing');
                $element.addClass('moto-widget-callback_closed');
            });
        }

        function toggleModeDetails() {
            if ($callbackBody.hasClass('moto-widget-callback__body_more-details-opened')) {
                $moreDetails.slideUp(ANIMATION_DURATION);
                $callbackBody.removeClass('moto-widget-callback__body_more-details-opened');
            } else {
                $moreDetails.slideDown(ANIMATION_DURATION);
                $callbackBody.addClass('moto-widget-callback__body_more-details-opened');
            }
        }

        $openButton.on('click', openCallback);
        $closeButton.on('click', closeCallback);
        $moreDetailsButton.on('click', toggleModeDetails);
    };
}(jQuery));