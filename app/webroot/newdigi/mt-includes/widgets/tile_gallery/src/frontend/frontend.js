/* Source: src/mt-includes/widgets/tile_gallery/src/frontend/frontend.js*/
angular.module('website.widget.tile_gallery', []).directive('motoWidgetTileGalleryItemsWrapper', [
    function() {
        return {
            restrict: 'C',
            link: function($scope, $element) {
                $element.tileGallery();
            }
        };
    }
]);