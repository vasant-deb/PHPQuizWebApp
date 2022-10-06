/* Source: src/mt-includes/widgets/form_elements/src/frontend/directiveMotoFormAttachmentButton.js*/
angular.module('website.core.form').directive('motoFormAttachmentButton', [
    '$timeout',
    function($timeout) {

        /**
         * Update model validation value
         *
         * @param {Object} model
         * @param {Function} model.$setValidity
         * @param {Array|Object|string} errors
         * @param {boolean} state
         * @returns {boolean}
         */
        function updateModelValidity(model, errors, state) {
            var i;
            var len;

            if (angular.isUndefined(errors) || angular.isUndefined(state)) {
                return false;
            }

            state = !!state;

            //collect error names
            if (angular.isObject(errors)) {
                errors = Object.keys(errors);
            }
            if (!angular.isArray(errors)) {
                errors = [errors];
            }

            for (i = 0, len = errors.length; i < len; i++) {
                model.$setValidity(errors[i], state);
            }

            return true;
        }

        /**
         * Update model validation, transform error by each file to model error
         *
         * @param {Object} model
         * @param {Array} model.$modelValue
         * @param {Object|string} model.$error
         * @param {Function} model.$setValidity
         * @returns {boolean}
         */
        function checkModelValidations(model) {
            var i;
            var len;
            var files = model.$modelValue;

            if (files instanceof File) {
                files = [files];
            }
            if (!angular.isArray(files) || files.length < 1) {
                return false;
            }

            for (i = 0, len = files.length; i < len; i++) {
                updateModelValidity(model, files[i].$error, false);
            }

            return true;
        }

        /**
         * Check model for 'required' validation
         *
         * @param {Object} model
         * @param {null|File|File[]} model.$modelValue
         * @param {Function} model.$setValidity
         */
        function checkRequired(model) {
            if (!model.$modelValue || angular.isArray(model.$modelValue) && model.$modelValue.length < 1) {
                model.$setValidity('required', false);
            }
        }

        /**
         * Parser function to convert 'null' to undefined
         * Fix for repeat select file and cancel them, backend not understand 'null' value for file
         * On sending request to server undefined values will ignoring
         *
         * @param {*} value
         * @returns {*}
         */
        function updateValueFromNullToUndefined(value) {
            if (value === null) {
                value = undefined;
            }

            return value;
        }

        return {
            restrict: 'A',
            require: '?ngModel',
            link: function($scope, $element, $attrs, ngModel) {

                /**
                 * Validate model
                 */
                function checkValidations() {
                    updateModelValidity(ngModel, ngModel.$error, true);
                    checkModelValidations(ngModel);
                    if ($attrs.required) {
                        checkRequired(ngModel);
                    }
                    // fix for FF
                    ngModel.$setTouched();
                }

                /**
                 * Call 'checkValidations' function no next apply
                 *
                 * @param {*} value
                 * @returns {*}
                 */
                function checkValidationsWrapper(value) {
                    // timeout is need because value is array and angular validator remove error required for empty array
                    $timeout(checkValidations);

                    return value;
                }

                /**
                 * Handler for remove attached file
                 *
                 * @param {Object} $event
                 * @param {File} file
                 */
                function onRemoveAttachedFile($event, file) {
                    var index;

                    // ngModel.$modelValue and $attrs.$$ngfPrevValidFiles it is same array

                    if (!(file instanceof File)) {
                        return false;
                    }

                    // remove file for single mode
                    if (ngModel.$modelValue === file) {
                        ngModel.$setViewValue(undefined);
                    }

                    if (angular.isArray($attrs.$$ngfPrevValidFiles)) {
                        index = $attrs.$$ngfPrevValidFiles.indexOf(file);
                        if (index > -1) {
                            $attrs.$$ngfPrevValidFiles.splice(index, 1);
                        }
                    }
                    if (angular.isArray($attrs.$$ngfPrevInvalidFiles)) {
                        index = $attrs.$$ngfPrevInvalidFiles.indexOf(file);
                        if (index > -1) {
                            $attrs.$$ngfPrevInvalidFiles.splice(index, 1);
                        }
                    }

                    checkValidationsWrapper();
                }

                $scope.$on('MotoForm::removeAttachedFile', onRemoveAttachedFile);

                ngModel.$parsers.push(checkValidationsWrapper);
                ngModel.$parsers.push(updateValueFromNullToUndefined);
            }
        };
    }
]);