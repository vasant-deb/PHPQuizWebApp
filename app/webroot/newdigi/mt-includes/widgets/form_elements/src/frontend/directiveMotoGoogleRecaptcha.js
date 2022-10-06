/* Source: src/mt-includes/widgets/form_elements/src/frontend/directiveMotoGoogleRecaptcha.js*/
angular.module('website.widget.google_recaptcha', ['vcRecaptcha'])
    .directive('motoWidgetFormElementsRecaptcha', [
        'vcRecaptchaService',
        function(vcRecaptchaService) {
            return {
                restrict: 'C',
                scope: true,
                link: function($scope, $element, $attrs) {
                    $scope.setWidgetId = function(widgetId) {
                        $scope.widgetId = widgetId;
                    };
                    $scope.$on('MotoForm::submitSuccess', function() {
                        vcRecaptchaService.reload($scope.widgetId);
                        $scope.$FORM[$attrs.fieldName].$invalid = false;
                        $scope.$FORM[$attrs.fieldName].$touched = false;
                    });
                }
            };
        }
    ]);