/* Source: src/mt-includes/js/src/core/media/MotoMedia.js*/
/**
 * Service for manipulation with media items (video|audio)
 */
/**
 * @typedef {Object} MotoMediaItem
 * @property {jQuery} node - jQuery node of item
 * @property {Function} pause - method for pause media
 * @property {Function} play - method for start media
 * @property {Function} isPlaying - method for checking if media is playing
 * @property {boolean} ready = indicate that item is ready for playing
 * @property {boolean} isAllowedAutoplay = indicate that autoplay is allowed for widget
 * @property {Object} [scope] (not required) - angular scope of element (not required)
 * @property {autoplay} [autoplay] (not required) - autoplay settings of item, if not exist, media will not be played automatically
 */
/**
 * @typedef {{enabled: boolean, allowed: boolean, forced: boolean, startOn: string}} autoplay
 */

angular.module('website.core.media').service('website.MediaService', [
    'motoBeforeInViewport',
    function(motoBeforeInViewport) {
        var _items = [];
        var service = this;
        var autoplayFailed = false;

        function isScope(target) {
            return !!(target && target.$evalAsync && target.$watch);
        }

        function fallbackIsPlaying() {
            return false;
        }

        /**
         * Register new item in service
         *
         * @param {MotoMediaItem} item - item for registration
         * @returns {MotoMediaItem|{false}} - registered item
         */
        this.registerItem = function(item) {
            if (!angular.isObject(item)) {
                return false;
            }

            item.autoplay = angular.isObject(item.autoplay) ? item.autoplay : {
                enabled: false
            };
            item.autoplay.allowed = angular.isDefined(item.autoplay.allowed) ? item.autoplay.allowed : true;
            item.isPlaying = angular.isFunction(item.isPlaying) ? item.isPlaying : fallbackIsPlaying;
            item.pause = angular.isFunction(item.pause) ? item.pause : angular.noop;
            item.ready = !!item.ready;

            if (isScope(item.scope)) {
                item.scope.$on('$destroy', function() {
                    _items.splice(_items.indexOf(item), 1);
                });
            }

            _items.push(item);

            if (item.ready) {
                this.itemReady(item);
            }

            return item;
        };

        /**
         * Mark item as ready.
         * When all items will be ready, will be called runAutoplayProcedure.
         *
         * @param {MotoMediaItem} item - item for marking as ready
         */
        this.itemReady = function(item) {
            item.ready = true;
            if (this.areAllItemsReady()) {
                this.runAutoplayProcedure();
            }
        };

        /**
         * Check if all items are ready
         *
         * @returns {boolean} - result
         */
        this.areAllItemsReady = function() {
            return !_items.some(function(item) {
                return !item.ready;
            });
        };

        /**
         * Check if autoplay should be run and run if should.
         * Checking on forcing and startOn
         *
         * @param {MotoMediaItem} item - moto media item
         */
        this.checkAndAutoplayItem = function(item) {
            function autoplayItem() {
                if (!item.autoplay.allowed) {
                    return;
                }
                if (item.autoplay.forced) {
                    service.pauseAll();
                    item.play();
                } else if (!service.isAnyPlaying()) {
                    item.play();
                }
            }
            if (item.autoplay.enabled) {
                if (item.autoplay.startOn === 'onFirstVisible') {
                    motoBeforeInViewport.startWatching({
                        element: item.node,
                        onEnter: function() {
                            autoplayItem();
                        }
                    });
                } else {
                    autoplayItem();
                }
            }
        };

        /**
         * Return if any item is playing
         *
         * @returns {boolean} - true if playing
         */
        this.isAnyPlaying = function() {
            return _items.some(function(item) {
                return item.isPlaying();
            });
        };

        /**
         * Pause all items
         */
        this.pauseAll = function() {
            _items.forEach(function(item) {
                item.pause();
            });
        };

        /**
         * Bind event for body on click to restart autoplay.
         * Should be called when autoplay failed.
         */
        this.autoplayFailed = function() {
            if (autoplayFailed) {
                return;
            }

            function clickHandler() {
                if (service.areAllItemsReady()) {
                    autoplayFailed = false;
                    $('body').off('click', clickHandler);
                    service.runAutoplayProcedure();
                }
            }

            autoplayFailed = true;
            $('body').on('click', clickHandler);
        };

        /**
         * Run autoplay for all items with all rules
         */
        this.runAutoplayProcedure = function() {
            _items.forEach(function(item) {
                service.checkAndAutoplayItem(item);
            });
        };
    }
]);