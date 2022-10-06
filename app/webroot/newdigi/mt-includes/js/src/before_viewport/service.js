/* Source: src/mt-includes/js/src/before_viewport/service.js*/
/**
 * Service motoBeforeInViewport
 *
 * Features:
 *     - visibilityMode:
 *          'part' - (default) element is visible if at least one pixel in viewport
 *          'full' - element is visible if at all pixels in viewport. ATTENTION: in this mode element can be never visible if it`s very high or viewport is small
 *     - watchAlways - flag which tell that watcher shouldn't be removed when element got in viewport
 *     - onEnter/onLeave - angularjs expressions or functions, which will be executed when element leave/enter in viewport
 *
 */

angular.module('website')
    .service('motoBeforeInViewport', [
        function() {
            /**
             * @typedef {Object} WatchingItem
             * @property {jQuery} element - $element will be watched
             * @property {String} visibilityMode - mode which will be used to check if element is visible
             * @property {Boolean} watchAlways - flag which tell that watcher shouldn't be removed when element got in viewport
             * @property {Boolean} wasInViewport - flag which tell if was element visible in previous scroll tick
             * @property {Object} $scope - angular scope object
             * @property {String|Function} onEnter - angularjs expression or function, which will be executed when element get in viewport
             * @property {String|Function} onLeave - angularjs expression or function, which will be executed when element leave from viewport
             */
            /**
             * Array of object that hold information about all current watched elements
             * @type {WatchingItem[]}
             */
            var watchingItems = [];
            var $windowObject = $(window);
            var debug = false;
            var blockThrottle = false;
            var wasBlockedThrottle = false;
            var THROTTLE_DELAY = 100;
            var INVISIBLE_CONTENT_CLASS = 'moto-before-in-viewport_content-invisible';
            var WIDGET_LOADING_CLASS = 'moto-widget__state_loading';

            /**
             * Check if element is visible in viewport. Can work in several modes.
             *
             * @param  {WatchingItem} item - checking item
             * @returns {Boolean} - true if visible
             */
            function isElementInViewport(item) {
                var viewportTop = $windowObject.scrollTop();
                var viewportBottom = viewportTop + $windowObject.height();
                var elementTop = item.element.offset().top;
                var elementBottom = elementTop + item.element.outerHeight();

                if (item.element.closest('.' + INVISIBLE_CONTENT_CLASS + ', .' + WIDGET_LOADING_CLASS).length > 0) {
                    return false;
                }

                if (!item.element.filter(':visible').length) {
                    return false;
                }

                if (item.visibilityMode === 'part') {
                    return !((elementBottom < viewportTop) || (elementTop > viewportBottom));
                } else if (item.visibilityMode === 'full') {
                    return (elementTop >= viewportTop) && (elementBottom <= viewportBottom);
                }

                debug && console.error('motoBeforeInViewport : unexpected visibilityMode', item.visibilityMode);

                return true;
            }

            /**
             * Calls when item get in viewport
             *
             * @param {WatchingItem} item - item shown
             * @returns {Boolean} - return true if element was removed from watching list
             */
            function itemGotInViewport(item) {
                debug && console.log('motoBeforeInViewport: item get in viewport', item);

                item.element.removeClass('moto-before-in-viewport');
                item.element.addClass('moto-after-in-viewport');

                if (angular.isString(item.onEnter)) {
                    item.$scope.$eval(item.onEnter);
                } else if (angular.isFunction(item.onEnter)) {
                    item.onEnter();
                }

                if (!item.watchAlways) {
                    stopWatching(item);

                    return true;
                } else {
                    item.wasInViewport = true;

                    return false;
                }
            }

            /**
             * Calls for every scroll tick
             */
            function scrollHandler() {
                if (blockThrottle) {
                    wasBlockedThrottle = true;

                    return;
                }
                checkElements();
                blockThrottle = true;
                wasBlockedThrottle = false;
                setTimeout(function() {
                    blockThrottle = false;
                    if (wasBlockedThrottle) {
                        scrollHandler();
                    }
                }, THROTTLE_DELAY);
            }

            /**
             * Remove item from list and remove watcher if this was the last item
             *
             * @param {WatchingItem} item - item to remove
             */
            function stopWatching(item) {
                var itemIndex = watchingItems.indexOf(item);

                if (itemIndex === -1) {
                    return;
                }

                watchingItems.splice(itemIndex, 1);

                debug && console.log('motoBeforeInViewport: removed', watchingItems);

                if (watchingItems.length === 0) {
                    debug && console.info('motoBeforeInViewport: last element removed, unbind scroll handler');
                    $windowObject
                        .off('resize', scrollHandler)
                        .off('scroll', scrollHandler);
                }
            }

            /**
             * Calls when item leave viewport
             *
             * @param {WatchingItem} item - item leaved
             */
            function itemLeaveFromViewport(item) {
                debug && console.log('motoBeforeInViewport: item leave frome viewport', item);

                item.element.removeClass('moto-after-in-viewport');
                item.element.addClass('moto-before-in-viewport');
                item.wasInViewport = false;

                if (angular.isString(item.onLeave)) {
                    item.$scope.$eval(item.onLeave);
                } else if (angular.isFunction(item.onLeave)) {
                    item.onLeave();
                }
            }

            /**
             * Check all elements in watching list
             */
            function checkElements() {
                var i;

                for (i = 0; i < watchingItems.length; i++) {
                    if (isElementInViewport(watchingItems[i])) {
                        if (!watchingItems[i].wasInViewport) {
                            if (itemGotInViewport(watchingItems[i])) {
                                i--;
                            }
                        }
                    } else {
                        if (watchingItems[i].wasInViewport) {
                            itemLeaveFromViewport(watchingItems[i]);
                        }
                    }
                }
            }

            /**
             * Add item in list and add watcher if this was the first item
             *
             * @param {WatchingItem} item - item to remove
             */
            function startWatching(item) {
                if (!angular.isObject(item.element)) {
                    return;
                }

                item.visibilityMode = item.visibilityMode || 'part';
                item.watchAlways = item.watchAlways || false;

                item.wasInViewport = isElementInViewport(item);
                if (item.wasInViewport) {
                    itemGotInViewport(item);

                    if (!item.watchAlways) {
                        return;
                    }
                }

                watchingItems.push(item);

                debug && console.log('motoBeforeInViewport: added', watchingItems);

                if (watchingItems.length === 1) {
                    debug && console.info('motoBeforeInViewport: first element added, bind scroll handler');
                    $windowObject
                        .on('resize', scrollHandler)
                        .on('scroll', scrollHandler);
                }
            }

            function elementIsVisible($element) {
                $element.removeClass(INVISIBLE_CONTENT_CLASS);
                scrollHandler();
            }

            function elementIsInvisible($element) {
                $element.addClass(INVISIBLE_CONTENT_CLASS);
                scrollHandler();
            }

            this.startWatching = startWatching;
            this.stopWatching = stopWatching;
            this.elementIsVisible = elementIsVisible;
            this.elementIsInvisible = elementIsInvisible;
        }
    ]);