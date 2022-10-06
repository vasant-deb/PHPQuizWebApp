/* Source: src/mt-includes/js/src/moto_link/MotoLinkActionService.js*/
angular.module('website').service('website.MotoLinkActionService', [
    '$window',
    'website.MotoPopupService',
    function($window, MotoPopupService) {
        this.execute = function(actionLink) {
            if (!angular.isObject(actionLink)) {
                return;
            }
            switch (actionLink.action) {
                case 'popup':
                    if (angular.isNumber(actionLink.id)) {
                        MotoPopupService.openPopup(actionLink.id);
                    }
                    break;
                case 'lightbox':
                    if (angular.isString(actionLink.url)) {
                        $.magnificPopup.open({
                            items: {
                                tClose: '',
                                tLoading: '',
                                src: actionLink.url,
                                type: 'image'
                            }
                        });
                    }
                    break;
                default:
                    if (angular.isString(actionLink.url)) {
                        try {
                            $window.open(actionLink.url, actionLink.target);
                        } catch (err) {}
                    }
                    break;
            }
        };
    }
]);