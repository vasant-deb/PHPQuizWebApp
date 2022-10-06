/* Source: src/mt-includes/js/src/moto_link/moto_link.js*/
angular.module('website.moto_link').run([
    '$timeout',
    function($timeout) {
        function openInLightBox(event) {
            var $element = $(event.currentTarget);

            if (!$element.closest('[data-moto-lightbox-caption]').length && $element.closest('[data-moto-init-lightbox-gallery]').length) {
                return;
            }

            event.preventDefault();

            // this is a 'hack' because popup handler will call next
            // maybe need create own handler processor with priority for any click action handlers
            $timeout(function() {
                $.magnificPopup.close();
                $.magnificPopup.open({
                    items: {
                        tClose: '',
                        tLoading: '',
                        src: $element.attr('href'),
                        title: $element.attr('title') || '',
                        type: 'image'
                    }
                });
            });
        }

        $('body').on('click', '.moto-link[data-action=lightbox]', openInLightBox);
    }
]);