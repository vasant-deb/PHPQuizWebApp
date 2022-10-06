/* Source: src/mt-includes/widgets/pagination/src/frontend/directive.js*/
angular.module('website.widgets').directive('motoWebsitePagination', [
    'website.library.PaginatorClass',
    function(PaginatorClass) {

        return {
            restrict: 'A',
            replace: true,
            templateUrl: function($element, $attrs) {
                if (angular.isString($attrs.templateUrl) && $attrs.templateUrl.length > 5) {
                    return $attrs.templateUrl;
                }

                return '@websiteWidgets/pagination/template.ng.html';
            },
            //@TODO : add mode 'pagination' as array with ngModel
            //require: '?ngModel',
            scope: {
                //            Pagination: '=pagination',
                Paginator: '=paginator'
            },
            link: function($scope, $element, $attrs) {
                var unWatch = angular.noop;

                if (!$scope.Paginator) {
                    return false;
                    /**
                     * @type {PaginatorClass}
                     */
                    $scope.Paginator = new PaginatorClass();
                    unWatch = $scope.$watch('Pagination', function(newValue, oldValue) {
                        $scope.Paginator.setData(newValue);
                    });
                }
                if (!($scope.Paginator instanceof PaginatorClass)) {
                    //@TODO : maybe need trow error
                    $scope.Paginator = null;

                    return false;
                }

                $scope.$on('$destroy', function() {
                    if (unWatch) {
                        unWatch();
                        unWatch = null;
                    }
                });
            }
        };
    }
]);