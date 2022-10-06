/* Source: src/mt-includes/js/src/core/widgets/WidgetCollectionClass.js*/
angular.module('website.core.widgets').service('website.WidgetCollectionClass', [
    function() {

        /**
         * Return sorted items by callback
         *
         * @param {Array} items
         * @param {Function} callback
         * @param {int} offset
         * @param {int} max
         * @returns {Array}
         */
        function getItems(items, callback, offset, max) {
            var i;
            var len = items.length;
            var result = [];

            for (i = offset; i < len; i++) {
                if (callback(items[i])) {
                    result.push(items[i]);
                }
                if (max > -1 && result.length === max) {
                    break;
                }
            }

            return result;
        }

        /**
         * Check is widget
         *
         * @param {Object} target
         * @returns {boolean}
         */
        function isWidget(target) {
            return !!(target && angular.isDefined(target.id) && angular.isDefined(target.$scope) && target.$element && angular.isFunction(target.setParent));
        }

        /**
         * @param {Array} items
         * @constructor
         */
        function WidgetCollectionClass(items) {
            this._items = [];
            this._index = {
                byId: {}
            };

            this.pushItems(items);
        }

        /**
         * Widgets list
         *
         * @type {ContentWidgetClass[]}
         * @private
         */
        WidgetCollectionClass.prototype._items = [];

        /**
         * List index
         *
         * @type {Object}
         * @private
         */
        WidgetCollectionClass.prototype._index = {};

        /**
         * Return all children widgets
         *
         * @returns {ContentWidgetClass[]}
         */
        WidgetCollectionClass.prototype.all = function() {
            return this._items;
        };

        /**
         * Push new child widget to collection
         *
         * @param {ContentWidgetClass} widget
         * @returns {boolean}
         */
        WidgetCollectionClass.prototype.push = function(widget) {
            if (!isWidget(widget)) {
                return false;
            }
            if (this.getById(widget.id)) {
                return false;
            }
            this._items.push(widget);
            this._index.byId[widget.id] = widget;

            return true;
        };

        /**
         * Push items to end of collection
         *
         * @param {Array|WidgetCollectionClass} items
         * @returns {boolean}
         */
        WidgetCollectionClass.prototype.pushItems = function(items) {
            if (items instanceof WidgetCollectionClass) {
                items = items.all();
            }
            if (!angular.isArray(items)) {
                return false;
            }
            angular.forEach(items, this.push.bind(this));

            return true;
        };

        /**
         * Get widget by id
         *
         * @param {string} id
         * @returns {ContentWidgetClass|null}
         */
        WidgetCollectionClass.prototype.getById = function(id) {
            return this._index.byId[id] || null;
        };

        /**
         * Get widget by index
         *
         * @param {int} index
         * @returns {ContentWidgetClass|null}
         */
        WidgetCollectionClass.prototype.getByIndex = function(index) {
            return this._items[index] || null;
        };

        /**
         * Check is collection are empty
         *
         * @returns {boolean}
         */
        WidgetCollectionClass.prototype.isEmpty = function() {
            return this._items.length < 1;
        };

        /**
         * Return count of children widgets
         *
         * @returns {int}
         */
        WidgetCollectionClass.prototype.count = function() {
            return this._items.length;
        };

        /**
         * Return first child widget
         *
         * @returns {ContentWidgetClass|null}
         */
        WidgetCollectionClass.prototype.first = function(callback, defaultValue) {
            var result;

            if (angular.isFunction(callback)) {
                result = getItems(this._items, callback, 0, 1)[0];
            } else {
                result = this.getByIndex(0);
            }

            if (angular.isUndefined(defaultValue)) {
                defaultValue = null;
            }

            return result || defaultValue;
        };

        /**
         * Return last child widget
         *
         * @returns {ContentWidgetClass|null}
         */
        WidgetCollectionClass.prototype.last = function() {
            return this.getByIndex(this.count() - 1);
        };

        /**
         * Remove widget by id
         *
         * @param {string} id
         * @returns {boolean}
         */
        WidgetCollectionClass.prototype.removeById = function(id) {
            var widget;
            var index;

            if (this._index.byId[id]) {
                widget = this._index.byId[id];
                delete this._index.byId[id];
                index = this._items.indexOf(widget);
                if (index >= 0) {
                    this._items.splice(index, 1);
                }
            }

            return true;
        };

        /**
         * Return a new collection with filtered items by callback
         *
         * @param {Function} callback
         * @returns {WidgetCollectionClass|boolean}
         */
        WidgetCollectionClass.prototype.filter = function(callback) {
            if (!angular.isFunction(callback)) {
                return false;
            }

            return new WidgetCollectionClass(this._items.filter(callback));
        };

        /**
         * Return a new collection with filtered by some item property value
         *
         * @param {string} property
         * @param {string} value
         * @returns {WidgetCollectionClass|boolean}
         */
        WidgetCollectionClass.prototype.where = function(property, value) {
            return this.filter(function(item) {
                return (item[property] === value);
            });
        };

        /**
         * Return a first item from collection where property will equal to value
         *
         * @param {string} property
         * @param {*} value
         * @returns {ContentWidgetClass|null}
         */
        WidgetCollectionClass.prototype.firstWhere = function(property, value) {
            return getItems(this._items, function(item) {
                return item[property] === value;
            }, 0, 1)[0] || null;
        };

        return WidgetCollectionClass;
    }
]);