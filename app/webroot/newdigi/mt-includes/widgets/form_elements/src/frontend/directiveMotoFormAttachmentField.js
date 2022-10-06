/* Source: src/mt-includes/widgets/form_elements/src/frontend/directiveMotoFormAttachmentField.js*/
angular.module('website.core.form').directive('motoFormAttachmentField', [
    function() {
        return {
            restrict: 'A',
            scope: true,
            link: function($scope) {
                $scope.removeAttachedFile = function(file) {
                    $scope.$broadcast('MotoForm::removeAttachedFile', file);
                };
            }
        };
    }
]);