/* Source: src/mt-includes/js/src/core/utils/ElementHeightWatcherClass.js*/
angular.module('website.core.utils').service('website.ElementHeightWatcherClass', [
    function() {

        /**
         * Simple class for auto change min height of elements by max height other elements
         *
         * @param {Object} params
         * @param {jQuery} params.$element
         * @param {string} params.watchSelector
         * @param {int} [params.delay]
         * @constructor
         */
        function ElementHeightWatcherClass(params) {
            if (!angular.isObject(params)) {
                throw new Error('Invalid params');
            }
            if (!angular.isElement(params.$element)) {
                throw new Error('$element is not Element');
            }
            if (!angular.isString(params.watchSelector) || params.watchSelector === '') {
                throw new Error('watchSelector is empty');
            }
            this._options = angular.copy(this._options);
            angular.extend(this._options, params);
            this.$element = $(params.$element);
            this._onResizeHandler = this.update.bind(this);
            $(window).on('resize', this._onResizeHandler);
            this._timer = setInterval(this.update.bind(this), this._options.delay);
        }

        ElementHeightWatcherClass.prototype._options = {
            delay: 250
        };
        ElementHeightWatcherClass.prototype.$element = null;
        ElementHeightWatcherClass.prototype._onResizeHandler = null;
        ElementHeightWatcherClass.prototype._timer = null;
        ElementHeightWatcherClass.prototype._visible = false;

        /**
         * Return max height of watching elements
         *
         * @param {string} selector
         * @returns {number}
         * @private
         */
        ElementHeightWatcherClass.prototype._getMaxHeight = function(selector) {
            var nodes;
            var maxHeight = 0;

            nodes = $(selector);
            angular.forEach(nodes, function(node) {
                maxHeight = Math.max($(node).outerHeight(), maxHeight);
            });

            return maxHeight;
        };

        /**
         * Update min height
         *
         * @returns {boolean}
         */
        ElementHeightWatcherClass.prototype.update = function() {
            if (this._visible) {
                this.$element.css('min-height', this._getMaxHeight(this._options.watchSelector) + 'px');

                return true;
            }

            return false;
        };

        /**
         * Show element
         */
        ElementHeightWatcherClass.prototype.show = function() {
            this.$element.show();
            this._visible = true;
            this.update();
        };

        /**
         * Hide element
         */
        ElementHeightWatcherClass.prototype.hide = function() {
            this.$element.hide();
            this._visible = false;
        };

        ElementHeightWatcherClass.prototype.disconnect = function() {
            this.$element = null;
            this.calcSizeFunction = angular.noop;
            $(window).off('resize', this._onResizeHandler);
            clearInterval(this._timer);
        };

        /**
         * Destroy element and disconnect watchers
         */
        ElementHeightWatcherClass.prototype.destroy = function() {
            this.$element.remove();
            this.disconnect();
        };

        return ElementHeightWatcherClass;
    }
]);