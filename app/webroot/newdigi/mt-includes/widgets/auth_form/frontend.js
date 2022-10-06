/* Source: src/mt-includes/widgets/auth_form/frontend.js*/
angular.module('website.widget.auth_form', ['core.library.jsonrpc'])
    .service('widget.AuthForm.Service', [
        'jsonrpc',
        function(jsonrpc) {
            var service = jsonrpc.newService('AuthService');

            this.loginToPageByPassword = service.createMethod('loginToPageByPassword');
        }
    ])
    .directive('motoWidgetAuthForm', [
        'widget.AuthForm.Service',
        '$window',
        function(AuthFormService, $window) {
            return {
                restrict: 'C',
                scope: true,
                link: function($scope, $element, $attrs) {
                    $scope.request = {
                        password: '',
                        pageId: $attrs.destinationPageId
                    };
                    $scope.submit = function() {
                        if (!$scope.request.pageId) {
                            return;
                        }
                        $scope.authForm.password.$setTouched();
                        if ($scope.authForm.$valid) {
                            AuthFormService.loginToPageByPassword($scope.request)
                                .then(
                                    function() {
                                        $window.location.reload();
                                    },
                                    function(response) {
                                        if (response && response.code == '403') {
                                            $scope.authForm.password.$setValidity('passwordInvalid', false);
                                        } else {
                                            $scope.authForm.password.$setValidity('couldNotSend', false);
                                        }
                                    }
                                );
                        }
                    };
                }
            };
        }
    ]);