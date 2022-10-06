/* Source: src/mt-includes/widgets/grid_gallery/frontend.js*/
angular.module('website.widget.grid_gallery', [])
    .directive('motoGridGalleryOptions', function() {
        return {
            restrict: 'A',
            priority: 450,
            link: function($scope, $element, $attrs) {
                var options = $scope.$eval($attrs.motoGridGalleryOptions);

                $element.justifiedGallery({
                    rowHeight: options.rowHeight,
                    maxRowHeight: (options.fixedHeight) ? options.rowHeight : 0,
                    margins: options.margins,
                    lastRow: options.lastRow,
                    captions: options.showCaptions,
                    cssAnimation: true
                });

                if (options.enableLightbox) {
                    $element.magnificPopup({
                        delegate: 'a',
                        type: 'image',
                        tClose: '',
                        tLoading: '',
                        mainClass: options.showCounter ? '' : 'moto-lightbox_hidden-counter',
                        gallery: {
                            enabled: true,
                            preload: [5, 10],
                            tPrev: '',
                            tNext: '',
                            tCounter: '%curr% / %total%'
                        },
                        image: {
                            titleSrc: function(item) {
                                return angular.element('.caption', item.el.context).html() || '';
                            }
                        },
                        zoom: {
                            enabled: true,
                            duration: 400,
                            easing: 'ease-in-out'
                        }
                    });
                }
            }
        };
    });