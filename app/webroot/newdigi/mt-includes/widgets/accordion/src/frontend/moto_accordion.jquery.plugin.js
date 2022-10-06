/* Source: src/mt-includes/widgets/accordion/src/frontend/moto_accordion.jquery.plugin.js*/
(function($) {
    var ITEM_OPENED_CLASS = 'moto-widget-accordion__item_open';
    var ITEM_COLLAPSING_CLASS = 'moto-widget-accordion__item_collapsing';
    var ITEM_COLLAPSING_TIME = 400;
    var _$window = $(window);

    /**
     * @typedef {Object} AccordionItem
     * @property {jQuery} $node - accordion item node (.moto-widget-accordion__item)
     * @property {ContentWidgetClass} widget - accordion website widget instance
     * @property {Boolean} opened - item opened status
     * @property {jQuery} $wrapperNode - accordion wrapper node (.moto-widget-accordion__content-wrapper)
     */

    /**
     * Close one item.
     *
     * @param {AccordionItem} item - item for closing
     * @param {function} [callback] - function to call when item will be closed
     */
    function closeItem(item, callback) {
        item.opened = false;
        item.$wrapperNode
            .slideUp({
                duration: ITEM_COLLAPSING_TIME,
                start: function() {
                    item.$node
                        .addClass(ITEM_COLLAPSING_CLASS)
                        .removeClass(ITEM_OPENED_CLASS);
                },
                complete: function() {
                    item.$node.removeClass(ITEM_COLLAPSING_CLASS);
                    callback && callback(item);
                }
            });
    }

    /**
     * Open one item.
     *
     * @param {AccordionItem} item - item for opening
     * @param {function} [callback] - function to call when item will be opened
     */
    function openItem(item, callback) {
        item.opened = true;
        item.$wrapperNode
            .slideDown({
                duration: ITEM_COLLAPSING_TIME,
                start: function() {
                    item.$node
                        .addClass(ITEM_COLLAPSING_CLASS)
                        .addClass(ITEM_OPENED_CLASS);
                },
                complete: function() {
                    item.$node.removeClass(ITEM_COLLAPSING_CLASS);
                    callback && callback(item);
                }
            });
        _$window.resize();
    }

    /**
     * Toggle item state.
     *
     * @param {AccordionItem} item - item for toggling
     * @param {function} [openedCallback] - function to call when item will be opened
     * @param {function} [closedCallback] - function to call when item will be closed
     */
    function toggleItem(item, openedCallback, closedCallback) {
        item.opened ? closeItem(item, closedCallback) : openItem(item, openedCallback);
    }

    /**
     * Close all opened items
     *
     * @param {Object} items - object with items
     * @param {function} [callback] - function to call when item will be closed
     */
    function closeOpenedItems(items, callback) {
        var id;

        for (id in items) {
            if (!items.hasOwnProperty(id)) {
                continue;
            }
            if (items[id].opened) {
                closeItem(items[id], callback);
            }
        }
    }

    function getVirtualStructure(childrenElements, options) {
        var result = {};
        var currentId;
        var $currentElement;
        var i;

        // create items object for current accordion
        for (i = 0; i < childrenElements.length; i++) {
            $currentElement = $(childrenElements[i]);
            currentId = $currentElement.attr('id') || $currentElement.attr('data-widget-id');
            result[currentId] = {
                id: currentId,
                $node: $currentElement,
                opened: $currentElement.hasClass(ITEM_OPENED_CLASS),
                $wrapperNode: $currentElement.children('.moto-widget-accordion__content-wrapper')
            };
            if (result[currentId].opened) {
                options.onOpened && options.onOpened(result[currentId]);
            } else {
                options.onClosed && options.onClosed(result[currentId]);
            }
        }

        return result;
    }

    $.fn.motoAccordion = function(options) {
        var $element = this;
        var closeOthers = typeof $element.attr('data-close-others') !== 'undefined';
        var items;

        if (typeof options !== 'object') {
            options = {};
        }

        items = getVirtualStructure($element.find('>.moto-widget-accordion__wrapper>.moto-widget-accordion__item'), options);

        $element.off('click', '>.moto-widget-accordion__wrapper>.moto-widget-accordion__item>.moto-widget-accordion__header');
        $element.on('click', '>.moto-widget-accordion__wrapper>.moto-widget-accordion__item>.moto-widget-accordion__header', function(event) {
            var itemId = $(event.currentTarget).attr('data-widget-id');
            var item = items[itemId];

            if (item.opened || !closeOthers) {
                toggleItem(item, options.onOpened, options.onClosed);
            } else {
                closeOpenedItems(items, options.onClosed);
                openItem(item, options.onOpened);
            }
        });
    };
})(jQuery);