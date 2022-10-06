/* Source: src/mt-includes/widgets/google_search/src/frontend/directive.js*/
angular.module('website.widget.google_search.directive', []).directive('motoWidgetGoogleSearchResultContent', [
    'widget.GoogleSearch.Service',
    'website.library.PaginatorClass',
    function(service, PaginatorClass) {
        return {
            restrict: 'C',
            scope: true,
            controller: ['$scope', '$attrs', function($scope, $attrs) {
                try {
                    $scope.settings = JSON.parse($attrs.settings);
                } catch (e) {}

                $scope.error = !$attrs.token || !$scope.settings || !$scope.settings.searchQuery;

                if ($scope.error) {
                    return;
                }

                $scope.Loading = false;

                function onError(error) {
                    $scope.error = true;
                    $scope.Paginator.reset();
                    $scope.resultItems = null;
                }

                $scope.doSearch = function(token) {
                    $scope.Loading = true;
                    service.doSearch({
                            token: token
                        })
                        .then(
                            function(response) {
                                $scope.resultItems = response.results.items;
                                //@TODO : review
                                if ($scope.Paginator.isDataExists()) {
                                    $scope.Paginator.setCurrentPageNumber(response.results.pagination.current);
                                } else {
                                    $scope.Paginator.setData(response.results.pagination);
                                }
                            },
                            onError
                        )
                        .catch(onError)
                        .finally(function() {
                            $scope.Loading = false;
                        });
                };

                /**
                 * @type {PaginatorClass}
                 */
                $scope.Paginator = new PaginatorClass();

                $scope.Paginator.$on('selected', function(event, page) {
                    $scope.doSearch(page.token);
                });

                $scope.doSearch($attrs.token);
            }]
        };
    }
]);