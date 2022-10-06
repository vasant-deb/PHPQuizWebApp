/* Source: src/mt-includes/js/src/moto_validation/MotoClearValidationOnChange.js*/
angular.module('moto.validation')
    .directive('motoClearValidationOnChange', function() {
        return {
            restrict: 'A',
            require: '?ngModel',
            link: function($scope, $element, $attrs, ngModel) {
                var rules, i, len;

                function setValidity(value) {
                    for (i = 0, len = rules.length; i < len; i++) {
                        ngModel.$setValidity(rules[i], true);
                    }
                    return value;
                }

                rules = $scope.$eval($attrs.motoClearValidationOnChange);
                if (!rules && $attrs.motoClearValidationOnChange) {
                    rules = $attrs.motoClearValidationOnChange;
                }
                if (rules && !angular.isArray(rules)) {
                    rules = [rules];
                }
                ngModel.$parsers.push(setValidity);
            }
        };
    });