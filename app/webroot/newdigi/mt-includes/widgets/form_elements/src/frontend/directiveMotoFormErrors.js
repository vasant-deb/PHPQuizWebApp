/* Source: src/mt-includes/widgets/form_elements/src/frontend/directiveMotoFormErrors.js*/
angular.module('website.core.form').directive('motoFormErrors', [
    function() {
        var DEFAULT_MESSAGES = {
            minlength: 'The field lengths should be more than [[ MIN_LENGTH ]] characters',
            maxlength: 'The field lengths should not exceed [[ MAX_LENGTH ]] characters',
            min: 'The value should be more than [[ MIN_VALUE ]]',
            max: 'The value should not exceed [[ MAX_VALUE ]]',
            email: 'Please enter a valid email',
            url: 'Please enter a valid URL',
            number: 'Please enter a valid number',
            tel: 'Please enter a valid phone number', //ng: unknown validator
            pattern: 'Please enter a valid [[ PATTERN ]]',
            required: 'The field is required',
            date: 'Please enter a valid date in format YYYY-MM-DD',
            maxFileSize: 'The file size should not exceed [[ MAX_SIZE ]]',
            fileExtension: 'This file extension is not supported'
        };
        var associationMap = {
            minlength: 'MIN_LENGTH',
            maxlength: 'MAX_LENGTH',
            min: 'MIN_VALUE',
            max: 'MAX_VALUE',
            maxFileSize: 'MAX_SIZE'
        };

        return {
            restrict: 'A',
            templateUrl: '@websiteWidgets/form_elements/moto_form_errors.ng.html',
            scope: {
                $FORM: '=form',
                fieldName: '@',
                fieldType: '@',
                // @TODO : try to get rules values from input
                rules: '='
            },
            link: function($scope) {
                var messages = null;
                var name;

                if (!$scope.$FORM) {
                    return false;
                }

                if (angular.isFunction($scope.$FORM.getValidationMessages)) {
                    messages = angular.copy($scope.$FORM.getValidationMessages());
                }

                if (angular.isObject(messages) && !angular.isArray(messages)) {
                    for (name in DEFAULT_MESSAGES) {
                        if (!DEFAULT_MESSAGES.hasOwnProperty(name)) {
                            continue;
                        }
                        if (angular.isString(messages[name])) {
                            messages[name] = messages[name].trim();
                            if (messages[name].length > 0) {
                                continue;
                            }
                        }
                        messages[name] = DEFAULT_MESSAGES[name];
                    }
                } else {
                    messages = angular.copy(DEFAULT_MESSAGES);
                }

                if (angular.isObject($scope.rules) && !angular.isArray($scope.rules)) {
                    for (name in $scope.rules) {
                        if (!$scope.rules.hasOwnProperty(name) || !associationMap[name] || !messages[name]) {
                            continue;
                        }

                        messages[name] = messages[name].replace('[[ ' + associationMap[name] + ' ]]', $scope.rules[name]);
                    }
                }

                $scope.messages = messages;
            }
        };
    }
]);