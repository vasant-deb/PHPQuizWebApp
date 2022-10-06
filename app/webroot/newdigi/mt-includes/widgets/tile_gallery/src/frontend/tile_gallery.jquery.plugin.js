/* Source: src/mt-includes/widgets/tile_gallery/src/frontend/tile_gallery.jquery.plugin.js*/
(function($) {
    $.fn.tileGallery = function() {
        var THROTTLE_DELAY = 250;
        var gallery = {
            columns: [],
            margins: 0
        };
        var $element = this;
        var $items = $element.children('.moto-widget-tile-gallery__item-wrapper');
        var notLoadedImages = 0;
        var blockThrottle = false;
        var wasBlockedThrottle = false;
        var justifyHeight = angular.isDefined($element.data('tileGalleryJustifyHeight'));

        /**
         * @typedef {Object} GalleryInstance
         * @property {number} margins
         * @property {object[]} columns
         * @property {jQuery[]} columns.items
         * @property {number} columns.heightWithPadding
         * @property {number} columns.height
         */

        /**
         * Get height of highest column
         *
         * @returns {number} - height
         */
        function getMaxHeight() {
            return gallery.columns.reduce(function(currentMax, column) {
                return (column.heightWithPadding > currentMax) ? column.heightWithPadding : currentMax;
            }, 0);
        }

        function resetItemHandler(item) {
            item.css('margin-bottom', '')
                .find('.moto-widget-tile-gallery__item-image').css('width', '');
        }
        /**
         * Reset all changes for gallery elements before new building
         */
        function resetChanges() {
            $element.parent().css('height', '');
            gallery.columns.forEach(function(column) {
                column.items.forEach(resetItemHandler);
            });
        }

        /**
         * Get height without borders
         *
         * @param {jQuery} item - element
         * @returns {number} - height
         */
        function getItemInnerHeight(item) {
            return item.children().innerHeight();
        }

        function addNewColumn(item) {
            gallery.columns.push({
                items: [item],
                heightWithPadding: item.innerHeight(),
                height: getItemInnerHeight(item)
            });
        }

        function addItemInLastColumn(item) {
            gallery.columns[gallery.columns.length - 1].items.push(item);
            gallery.columns[gallery.columns.length - 1].heightWithPadding += item.innerHeight();
            gallery.columns[gallery.columns.length - 1].height += getItemInnerHeight(item);
        }

        /**
         * Create virtual structure of gallery
         */
        function updateVirtualStructure() {
            var $prevItem = $($items[0]);
            var $currentItem;
            var i;

            gallery.margins = parseInt($prevItem.css('padding-bottom'));
            gallery.columns = [{
                items: [$prevItem],
                heightWithPadding: $prevItem.innerHeight(),
                height: getItemInnerHeight($prevItem)
            }];

            for (i = 1; i < $items.length; i++) {
                $currentItem = $($items[i]);
                // left offset of current item is grater then previous => new column
                if ($currentItem.position().left > $prevItem.position().left) {
                    addNewColumn($currentItem);
                } else {
                    addItemInLastColumn($currentItem);
                }
                $prevItem = $currentItem;
            }
        }

        function fixOuterHeight() {
            $element.parent().css('height', getMaxHeight() - gallery.margins + 'px');
        }

        function resizeItemHandler(item) {
            item.find('.moto-widget-tile-gallery__item-image').css('width', this.newWidth + '%');
        }

        /**
         * Justify all columns by height
         */
        function makeFlatFooter() {
            var maxHeight = getMaxHeight();
            var newHeight;
            var newWidth;

            gallery.columns.forEach(function(column) {
                newHeight = maxHeight - (column.heightWithPadding - column.height);
                newWidth = ((newHeight / column.height) * 100).toFixed(1);
                column.items.forEach(resizeItemHandler, {
                    newWidth: newWidth
                });
            });
        }

        /**
         * Main entry point of gallery
         */
        function fixGallery() {
            resetChanges();
            updateVirtualStructure();
            if (justifyHeight) {
                makeFlatFooter();
                updateVirtualStructure();
            }
            fixOuterHeight();
        }

        /**
         * Calls for every resize tick
         */
        function throttledFixGallery() {
            if (blockThrottle) {
                wasBlockedThrottle = true;

                return;
            }
            fixGallery();
            blockThrottle = true;
            wasBlockedThrottle = false;
            setTimeout(function() {
                blockThrottle = false;
                if (wasBlockedThrottle) {
                    throttledFixGallery();
                }
            }, THROTTLE_DELAY);
        }

        // bootstrap gallery
        function imageLoaded() {
            if (!--notLoadedImages) {
                throttledFixGallery();
            }
        }
        $element.find('.moto-widget-tile-gallery__item-image').each(function(index, element) {
            if (!element.complete || element.naturalHeight === 0) {
                notLoadedImages++;
                $(element).on('load', imageLoaded);
            }
        });
        if (!notLoadedImages) {
            throttledFixGallery();
        }

        // bind only on website, on preview updated by widget
        if (!$('body').hasClass('moto-preview-mode_content') || $('body').hasClass('moto-preview-mode_design')) {
            $(window).on('resize', throttledFixGallery);
        }
    };
}(jQuery));