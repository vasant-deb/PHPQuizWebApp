/* Source: src/mt-includes/widgets/tabs/src/frontend/moto_tabs.jquery.plugin.js*/
(function($) {
    var ITEMS_SELECTOR = '>.moto-widget-tabs__wrapper>.moto-widget-tabs__items-wrapper>.moto-widget-tabs__item';
    var ITEMS_DESKTOP_HEADER_SELECTOR = '>.moto-widget-tabs__wrapper>.moto-widget-tabs__headers-wrapper>.moto-widget-tabs__header';
    var ITEMS_MOBILE_HEADER_SELECTOR = ITEMS_SELECTOR + '>.moto-widget-tabs__header';
    var ITEMS_HEADERS_SELECTOR = ITEMS_DESKTOP_HEADER_SELECTOR + ',' + ITEMS_MOBILE_HEADER_SELECTOR;
    var HEADER_OPENED_CLASS = 'moto-widget-tabs__header_opened';
    var ITEMS_DESKTOP_OPENED_HEADER_SELECTOR = ITEMS_DESKTOP_HEADER_SELECTOR + '.' + HEADER_OPENED_CLASS;
    var _$window = $(window);

    function isMobileDevice() {
        return (window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth) < 1040;
    }

    /**
     * @typedef {Object} ItemData - Data about tab.
     * @property {String} id - Tabs's widget id.
     * @property {jQuery} $root - Root node (.moto-widget) of the tab.
     * @property {jQuery} $desktopHeader - Header's for desktop node of the tab.
     * @property {jQuery} $mobileHeader - Header's for mobile node of the tab.
     * @property {jQuery} $contentWrapper - Content wrapper node of the tab.
     */

    /**
     * Get itemData by item's id.
     *
     * @param {String} id - Item's id for getting data.
     * @param {jQuery} $element - Tabs widget's root (.moto-widget) node.
     * @returns {ItemData} - Data about tab.
     */
    function getItemDataById(id, $element) {
        var tabData = {};

        tabData.id = id;
        tabData.$root = $element.find('#' + id);
        tabData.$desktopHeader = $element.find(ITEMS_DESKTOP_HEADER_SELECTOR + '[data-tab="' + id + '"]');
        tabData.$mobileHeader = tabData.$root.find('>.moto-widget-tabs__header');
        tabData.$contentWrapper = tabData.$root.find('>.moto-widget-tabs__content-wrapper');

        return tabData;
    }

    /**
     * Find in tabs widget's root (.moto-widget) node opened item and return it's id.
     *
     * @param {jQuery} $element - Tabs widget's root (.moto-widget) node.
     * @returns {String} - Opened item's id.
     */
    function getOpenedItemId($element) {
        return $element.find(ITEMS_DESKTOP_OPENED_HEADER_SELECTOR).data('tab');
    }

    /**
     * Add opened classes for item's headers and show item's content.
     *
     * @param {ItemData} itemData - Item to open.
     * @param {function} [callback] - function to call when item will be opened
     */
    function openItem(itemData, callback) {
        itemData.$contentWrapper.show();
        itemData.$desktopHeader.addClass(HEADER_OPENED_CLASS);
        itemData.$mobileHeader.addClass(HEADER_OPENED_CLASS);
        if (isMobileDevice()) {
            $('html, body').animate({
                scrollTop: itemData.$mobileHeader.offset().top
            }, 400);
        }
        callback && callback(itemData);
    }

    /**
     * Remove opened classes for item's headers and hide item's content.
     *
     * @param {ItemData} itemData - Item to close.
     * @param {function} [callback] - function to call when item will be closed
     */
    function closeItem(itemData, callback) {
        itemData.$contentWrapper.hide();
        itemData.$desktopHeader.removeClass(HEADER_OPENED_CLASS);
        itemData.$mobileHeader.removeClass(HEADER_OPENED_CLASS);
        callback && callback(itemData);
    }

    $.fn.motoTabs = function(options) {
        var $element = this;
        var openedItemId = getOpenedItemId($element);

        if (typeof options !== 'object') {
            options = {};
        }

        $element.find(ITEMS_SELECTOR + ':not(#' + openedItemId + ')').each(function() {
            options.onClosed && options.onClosed({
                id: $(this).attr('id')
            });
        });
        options.onOpened && options.onOpened({
            id: openedItemId
        });

        $element.off('click', ITEMS_HEADERS_SELECTOR);
        $element.on('click', ITEMS_HEADERS_SELECTOR, function(event) {
            var $target = $(event.currentTarget);
            var clickedItemId = $target.data('tab');
            var openedItem;

            if (clickedItemId === openedItemId) {
                return;
            }

            openedItem = getItemDataById(openedItemId, $element);
            closeItem(openedItem, options.onClosed);

            openedItemId = clickedItemId;

            // now we have new opened item
            openedItem = getItemDataById(openedItemId, $element);
            openItem(openedItem, options.onOpened);
            _$window.resize();
        });
    };
})(jQuery);