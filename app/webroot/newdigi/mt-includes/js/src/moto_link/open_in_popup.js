/* Source: src/mt-includes/js/src/moto_link/open_in_popup.js*/
angular.module('website.moto_link').run([
    'website.MotoPopupService',
    function(MotoPopupService) {
        var $body = $('body');

        function openInPopup(event) {
            var $element = $(event.currentTarget);
            var id = $element.attr('data-popup-id');
            var action = $element.data('action');

            id = parseInt(id);
            if ((action === 'popup') && (!(id > 0))) {
                return false;
            }

            if (action !== 'popup') {
                return;
            }

            event.preventDefault();

            MotoPopupService.openPopup(id);
        }

        $body.on('click', '.moto-link', openInPopup);
    }
]);