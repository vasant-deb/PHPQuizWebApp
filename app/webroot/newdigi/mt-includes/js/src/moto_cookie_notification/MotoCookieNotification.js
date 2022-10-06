/* Source: src/mt-includes/js/src/moto_cookie_notification/MotoCookieNotification.js*/
angular.module('website')
    .directive('motoCookieNotification', [
        'website.MotoStorageService',
        function(MotoStorageService) {
            return {
                restrict: 'C',
                link: function($scope, $element) {
                    var contentHash = $element.attr('data-content-hash');

                    if (MotoStorageService.getCookie('cookie-notification-applied') !== contentHash) {
                        $element.addClass('moto-cookie-notification_visible');
                    }
                    $scope.closeNotification = function(daysToExpire) {
                        var options = (daysToExpire) ? {
                            expires: daysToExpire
                        } : null;

                        $element.fadeOut();
                        MotoStorageService.setCookie('cookie-notification-applied', contentHash, options);
                    };
                }
            };
        }
    ]);