/* Source: src/mt-includes/js/src/moto_link/initLightboxGalleryDirective.js*/
/**
 * Directive for automation initializing our lightbox gallery.
 *
 * For correct working with caption you have to mark two nodes:
 *     [data-moto-lightbox-item] - node that wrap every item in gallery
 *     [data-moto-lightbox-caption] - node that contain caption of item
 */

angular.module('website.moto_link')
    .directive('motoInitLightboxGallery', function() {
        var DEFAULT_PROPERTIES = {
            itemRootSelector: '[data-moto-lightbox-item]',
            itemLinkSelector: '[data-moto-lightbox-link]',
            itemCaptionSelector: '[data-moto-lightbox-caption]'
        };

        return {
            restrict: 'A',
            link: function($scope, $element, $attrs) {
                $element.magnificPopup({
                    delegate: 'a[data-action=lightbox]' + DEFAULT_PROPERTIES.itemLinkSelector,
                    type: 'image',
                    tClose: '',
                    tLoading: '',
                    mainClass: angular.isDefined($attrs.tileGalleryShowCounter) ? '' : 'moto-lightbox_hidden-counter',
                    gallery: {
                        enabled: true,
                        preload: [5, 10],
                        tPrev: '',
                        tNext: '',
                        tCounter: '%curr% / %total%'
                    },
                    image: {
                        titleSrc: function(item) {
                            return angular.element(item.el.context)
                                .closest(DEFAULT_PROPERTIES.itemRootSelector)
                                .find(DEFAULT_PROPERTIES.itemCaptionSelector)
                                .html() || '';
                        }
                    },
                    zoom: {
                        enabled: true,
                        duration: 400,
                        easing: 'ease-in-out'
                    }
                });
            }
        };
    });