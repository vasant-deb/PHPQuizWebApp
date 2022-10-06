/* Source: src/mt-includes/widgets/contact_form/frontend.js*/
angular.module('website.widget.contact_form', ['core.library.jsonrpc', 'ngFileUpload'])
    .service('widget.ContactForm.Service', [
        'jsonrpc',
        function(jsonrpc) {
            var service = jsonrpc.newService('Widget.ContactForm');

            this.sendMessage = service.createMethod('sendMessage');
            this.getApiPath = jsonrpc.getBasePath;
        }
    ])
    // @ATTENTION : this directive will start on widgets 'contact_form', 'mail_chimp', 'auth_form'
    .directive('motoWidgetContactForm', [
        '$timeout',
        function($timeout) {
            return {
                restrict: 'C',
                scope: true,
                compile: function($element) {

                    return {
                        pre: function($scope) {

                            //prevent binding if parents not has specific css class
                            if ($element.closest('.moto-widget_interactive').length < 1) {
                                return;
                            }

                            function onInteraction() {
                                $scope.$emit('UserInteraction', 'StartInteraction');
                            }

                            // wrapper for IE on focus/blur window
                            function onInteractionTimeOuted() {
                                $timeout(onInteraction);
                            }

                            $element.on('click', onInteraction);
                            $element.on('focus', 'input, select, textarea, button, a', onInteractionTimeOuted);

                            $scope.$on('$destroy', function() {
                                $element.off('click', onInteraction);
                                $element.off('focus', onInteractionTimeOuted);
                            });
                        }
                    };
                }
            };
        }
    ])
    .controller('widget.ContactForm.Controller', [
        '$scope',
        '$element',
        'widget.ContactForm.Service',
        'Upload',
        'website.MotoLinkActionService',
        'website.BrowserTabClosingConfirmation',
        function($scope, $element, WidgetService, Upload, MotoLinkActionService, BrowserTabClosingConfirmation) {
            var inputs = $element.find('input, textarea');
            var emailExp = /^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*(\.[a-zA-Z0-9-]+)$/;
            var widgetId;
            var input;
            var name;
            var requiredCheckbox;
            var i;
            var len;

            $scope.message = {};
            $scope.placeholder = {};
            $scope.hash = '';
            $scope.attachments = [];
            $scope.attachment = {};

            if (inputs.length) {
                for (i = 0, len = inputs.length; i < len; i++) {
                    input = angular.element(inputs[i]);
                    name = input.attr('name');

                    if (!name) {
                        continue;
                    }

                    $scope.message[name] = $scope.message[name] || '';
                    if (name === 'checkbox') {
                        $scope.placeholder[name] = $element.find('.moto-widget-contact_form-checkbox-text').text() || name;
                    } else {
                        $scope.placeholder[name] = input.attr('placeholder') || name;
                    }
                }
            }

            $scope.validateEmailOnBlur = function() {
                var valid;

                $scope.contactForm.email.$pristine = false;

                if ($scope.contactForm.email.$viewValue !== '') {
                    valid = emailExp.test($scope.contactForm.email.$viewValue);
                    if (valid) {
                        $scope.contactForm.email.emailInvalid = false;
                        $scope.contactForm.email.$setValidity('pattern', true);
                    } else {
                        $scope.contactForm.email.emailInvalid = true;
                        $scope.contactForm.email.$setValidity('pattern', false);
                    }
                } else {
                    $scope.contactForm.email.emailInvalid = false;
                }
            };

            $scope.validate = function(fieldName) {
                if (fieldName === 'email') {
                    $scope.validateEmailOnBlur();
                }
            };

            $scope.validateCheckbox = function() {
                if (!requiredCheckbox) {
                    return;
                }
                $scope.contactForm.checkbox.$pristine = false;
                if (!$scope.contactForm.checkbox.$viewValue) {
                    $scope.contactForm.checkbox.$invalid = true;
                    $scope.contactForm.checkbox.$setValidity('required', false);
                    $scope.contactForm.$valid = false;
                } else {
                    $scope.contactForm.checkbox.$invalid = false;
                    $scope.contactForm.checkbox.$setValidity('required', true);
                }
            };

            $scope.checkboxChanged = function() {
                $scope.contactForm.checkbox.$invalid && $scope.validateCheckbox();
            };

            $scope.requiredCheckbox = function() {
                requiredCheckbox = true;
            };

            $scope.errors = [];
            $scope.emailSent = false;
            $scope.showSuccessMessage = false;
            $scope.triedToSend = false;

            function onErrorCallback() {
                $scope.emailError = true;
                $scope.sending = false;

                BrowserTabClosingConfirmation.disable(widgetId);
            }

            function resetForm() {
                angular.forEach($scope.message, function(value, key) {
                    $scope.message[key] = '';
                });

                $scope.contactForm.$setPristine();
                $scope.contactForm.$setUntouched();
            }

            function onSuccessCallback(data) {
                if (data.error) {
                    return onErrorCallback(data.error);
                }
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

            $scope.submit = function() {
                if ($scope.sending) {
                    return;
                }
                $scope.emailSent = false;
                $scope.showSuccessMessage = false;
                $scope.triedToSend = true;
                $scope.errors = [];
                $scope.sending = true;
                $scope.emailError = false;

                if (typeof $scope.contactForm.$error.required === 'object') {
                    $scope.contactForm.$error.required.forEach(function(elem) {
                        elem.$dirty = true;
                        elem.$pristine = false;
                        elem.$setTouched();
                    });
                    $scope.contactForm.$valid = false;
                } else {
                    $scope.contactForm.$valid = true;
                }

                if ($scope.contactForm.email) {
                    $scope.validate('email');
                }
                if ($scope.contactForm.checkbox) {
                    $scope.validateCheckbox();
                }
                if ($scope.contactForm && $scope.contactForm.$valid) {
                    widgetId = 'widget.ContactForm_' + new Date().getTime();
                    BrowserTabClosingConfirmation.enable(widgetId);
                    if ($scope.attachment && $scope.attachment.name) {
                        $scope.message._attachments = $scope.attachment.name ? 1 : 0;
                        Upload
                            .upload({
                                method: 'POST',
                                url: WidgetService.getApiPath(),
                                file: $scope.attachment,
                                data: {
                                    jsonrpc: '2.0',
                                    id: 1,
                                    method: 'Widget.ContactForm.sendMessage',
                                    params: {
                                        message: $scope.message,
                                        placeholder: $scope.placeholder,
                                        hash: $scope.hash
                                    }
                                },
                                headers: {
                                    'X-Requested-With': 'XMLHttpRequest'
                                }
                            })
                            .success(onSuccessCallback)
                            .error(onErrorCallback);
                    } else {
                        WidgetService.sendMessage({
                                message: $scope.message,
                                placeholder: $scope.placeholder,
                                hash: $scope.hash
                            })
                            .success(onSuccessCallback)
                            .error(onErrorCallback);
                    }
                } else {
                    $scope.sending = false;
                }
            };
        }
    ]);