/* Source: src/mt-includes/widgets/integrations/src/frontend/acuity_scheduling.frontend.js*/
angular.module('website.widget.integrations.acuity_scheduling', []).directive('motoAcuitySchedulingButton', [
    function() {
        return {
            restrict: 'A',
            scope: true,
            link: function($scope) {
                $scope.openAcuitySchedulingPopup = function(url) {
                    var content =
                        '<div class="moto-popup_content" style="background: white;">' +
                        '<iframe src="' + url + '" width="100%" height="800" frameBorder="0"></iframe>' +
                        '<script src="https://d3gxy7nm8y4yjr.cloudfront.net/js/embed.js" type="text/javascript"></script>' +
                        '</div>';

                    $.magnificPopup.close();
                    $.magnificPopup.open({
                        items: {
                            src: $(content),
                            type: 'inline'
                        },
                        mainClass: 'moto-popup',
                        closeOnBgClick: false,
                        callbacks: {
                            open: function() {
                                $('.mfp-content').css('width', '900px');
                            }
                        }
                    });
                };
            }
        };
    }
]);