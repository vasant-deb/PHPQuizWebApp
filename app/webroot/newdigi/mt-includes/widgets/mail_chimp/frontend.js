/* Source: src/mt-includes/widgets/mail_chimp/frontend.js*/
angular.module('website.widget.mail_chimp', ['core.library.jsonrpc'])
    .service('website.widget.MailChimpService', [
        'jsonrpc',
        function(jsonrpc) {
            var service = jsonrpc.newService('Widget.MailChimp');

            this.subscribe = service.createMethod('subscribe');
        }
    ])
    .controller('widget.MailChimp.Controller', [
        '$scope',
        '$element',
        'website.widget.MailChimpService',
        'website.MotoLinkActionService',
        'website.BrowserTabClosingConfirmation',
        function($scope, $element, WidgetService, MotoLinkActionService, BrowserTabClosingConfirmation) {
            var inputs = $element.find('input');
            var emailExp = /^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*(\.[a-zA-Z0-9-]+)$/;
            var widgetId;
            var len = inputs.length;
            var input;
            var name;
            var i;
            var requiredCheckbox;

            $scope.listId = '';
            $scope.message = {};
            $scope.emailSent = false;
            $scope.showSuccessMessage = false;
            $scope.triedToSend = false;
            $scope.emailError = false;
            $scope.isSubscribed = false;

            if (len) {
                for (i = 0; i < len; i++) {
                    input = angular.element(inputs[i]);
                    name = input.attr('name');

                    if (!name) {
                        continue;
                    }

                    $scope.message[name] = $scope.message[name] || input.attr('value') || '';
                }
            }

            $scope.validateEmailOnBlur = function() {
                var valid;

                $scope.subscribeForm.email.$pristine = false;

                if ($scope.subscribeForm.email.$viewValue != '') {
                    valid = emailExp.test($scope.subscribeForm.email.$viewValue);
                    if (valid) {
                        $scope.subscribeForm.email.emailInvalid = false;
                        $scope.subscribeForm.email.$setValidity('pattern', true);
                    } else {
                        $scope.subscribeForm.email.emailInvalid = true;
                        $scope.subscribeForm.email.$setValidity('pattern', false);
                    }
                } else {
                    $scope.subscribeForm.email.emailInvalid = false;
                }
            };

            $scope.validateRequiredOnBlur = function(fieldName) {
                $scope.subscribeForm[fieldName].$pristine = false;
                if ($scope.subscribeForm[fieldName].$viewValue == '') {
                    $scope.subscribeForm[fieldName].$invalid = true;
                    $scope.subscribeForm.$valid = false;
                } else {
                    $scope.subscribeForm[fieldName].$invalid = false;
                }
            };

            $scope.validate = function(fieldName) {
                if (fieldName == 'email') {
                    $scope.validateEmailOnBlur();
                    $scope.validateRequiredOnBlur(fieldName);
                } else {
                    $scope.validateRequiredOnBlur(fieldName);
                }
            };

            $scope.validateCheckbox = function() {
                if (!requiredCheckbox) {
                    return;
                }
                $scope.subscribeForm.checkbox.$pristine = false;
                if (!$scope.subscribeForm.checkbox.$viewValue) {
                    $scope.subscribeForm.checkbox.$invalid = true;
                    $scope.subscribeForm.checkbox.$setValidity('required', false);
                    $scope.subscribeForm.$valid = false;
                } else {
                    $scope.subscribeForm.checkbox.$invalid = false;
                    $scope.subscribeForm.checkbox.$setValidity('required', true);
                }
            };

            $scope.checkboxChanged = function() {
                $scope.subscribeForm.checkbox.$invalid && $scope.validateCheckbox();
            };

            $scope.requiredCheckbox = function() {
                requiredCheckbox = true;
            };

            function resetForm() {
                angular.forEach($scope.message, function(value, key) {
                    $scope.message[key] = '';
                });

                $scope.subscribeForm.$setPristine();
                $scope.subscribeForm.$setUntouched();
            }

            function onSuccessCallback() {
                $scope.emailSent = true;
                $scope.triedToSend = false;
                $scope.sending = false;

                if ($scope.resetAfterSubmission) {
                    resetForm();
                }

                BrowserTabClosingConfirmation.disable(widgetId);

                if (angular.isObject($scope.actionAfterSubmission) && $scope.actionAfterSubmission.action !== 'none') {
                    MotoLinkActionService.execute($scope.actionAfterSubmission);
                } else {
                    $scope.showSuccessMessage = true;
                }
            }

            function onErrorCallback(error) {
                $scope.emailError = true;
                $scope.sending = false;

                BrowserTabClosingConfirmation.disable(widgetId);

                //TODO: bad way of checking subscribing
                if (error.data && error.data.errors && error.data.errors.detail) {
                    $scope.isSubscribed = error.data.errors.detail.match(/is already a list member/g);
                }
            }

            $scope.submit = function() {
                if ($scope.sending) {
                    return;
                }
                $scope.emailSent = false;
                $scope.showSuccessMessage = false;
                $scope.triedToSend = true;
                $scope.sending = true;
                $scope.emailError = false;
                $scope.isSubscribed = false;

                if (typeof $scope.subscribeForm.$error.required == 'object') {
                    $scope.subscribeForm.$error.required.forEach(function(elem) {
                        elem.$dirty = true;
                        elem.$pristine = false;
                        elem.$setTouched();
                    });
                    $scope.subscribeForm.$valid = false;
                } else {
                    $scope.subscribeForm.$valid = true;
                }

                $scope.validate('email');
                $scope.validateCheckbox();
                if ($scope.subscribeForm && $scope.subscribeForm.$valid && !$scope.subscribeForm.emailInvalid) {
                    widgetId = 'widget.MailChimp_' + new Date().getTime();

                    BrowserTabClosingConfirmation.enable(widgetId);
                    $scope.message.list_id = $scope.listId || '';
                    WidgetService.subscribe({
                            request: $scope.message
                        })
                        .success(onSuccessCallback)
                        .error(onErrorCallback);
                } else {
                    $scope.sending = false;
                }
            };

        }
    ]);