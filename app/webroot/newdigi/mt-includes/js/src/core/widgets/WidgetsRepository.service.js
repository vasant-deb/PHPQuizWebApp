/* Source: src/mt-includes/js/src/core/widgets/WidgetsRepository.service.js*/
angular.module('website.core.widgets').service('website.WidgetsRepository', [
    'website.ContentWidgetClass',
    'website.WidgetCollectionClass',
    function(ContentWidgetClass, WidgetCollectionClass) {
        var debug = false;
        var defaultParent;

        /**
         * Check is target are scope
         *
         * @param target
         * @returns {boolean}
         */
        function isScope(target) {
            return !!(target && target.$evalAsync && target.$watch);
        }

        /**
         * Check is widget
         *
         * @param {Object} target
         * @returns {boolean}
         */
        function isWidget(target) {
            return target instanceof ContentWidgetClass;
        }

        function WidgetsRepository() {
            this._collection = new WidgetCollectionClass();
        }

        /**
         * @type {WidgetCollectionClass}
         * @private
         */
        WidgetsRepository.prototype._collection = null;

        /**
         * Set default parent widget
         *
         * @param {ContentWidgetClass|null} target
         * @returns {boolean}
         */
        WidgetsRepository.prototype.setDefaultParent = function(target) {
            if (target && target instanceof ContentWidgetClass || target === null) {
                debug && console.log('WidgetsRepository : setDefaultParent as ', target);
                defaultParent = target;

                return true;
            }

            return false;
        };

        /**
         * Return default parent widget
         *
         * @returns {ContentWidgetClass|null}
         */
        WidgetsRepository.prototype.getDefaultParent = function() {
            return defaultParent;
        };

        /**
         * Forget about widget, removed from repository
         *
         * @param {ContentWidgetClass|string} target
         * @returns {boolean}
         */
        WidgetsRepository.prototype.forget = function(target) {
            /**
             * @type {ContentWidgetClass}
             */
            var widget;
            var children;

            if (target instanceof ContentWidgetClass) {
                widget = target;
            } else if (angular.isString(target)) {
                widget = this._collection.getById(target);
            }

            if (!widget) {
                return false;
            }

            children = widget.children.all();
            if (children.length) {
                children.forEach(this.forget.bind(this));
            }
            this._collection.removeById(widget.id);
        };

        /**
         * Register widget
         *
         * @param {ContentWidgetClass|Object} widget
         * @returns {ContentWidgetClass|boolean}
         */
        WidgetsRepository.prototype.registry = function(widget) {
            var parentId;
            var parent;

            if (!angular.isObject(widget)) {
                debug && console.warn('WidgetsRepository : Cant registry widget - is not object');

                return false;
            }
            if (!(widget instanceof ContentWidgetClass)) {
                widget = new ContentWidgetClass(widget);
            }

            if (!isWidget(widget)) {
                return false;
            }
            // POPUP!
            if (this.isExists(widget.id)) {
                debug && console.log('WidgetsRepository : Try to forget widget #' + widget.id);
                this.forget(widget.id);
            }
            if (this.isExists(widget.id)) {
                debug && console.warn('Widget with #' + widget.id + 'already registered', widget);

                return false;
            }

            if (!this._collection.push(widget)) {
                debug && console.warn('Cant push widget to collection', widget);

                return false;
            }
            parentId = widget.$element.attr('data-parent-id');

            parent = this._collection.getById(parentId);
            if (parent) {
                widget.setParent(parent);
            } else if (defaultParent) {
                widget.setParent(defaultParent);
            }

            parent = widget.getParent();
            if (parent) {
                parent.addChild(widget);
            }

            return widget;
        };

        /**
         * Check is exists widget on list
         *
         * @param {string} id
         * @returns {boolean}
         */
        WidgetsRepository.prototype.isExists = function(id) {
            return !!this._collection.getById(id);
        };

        /**
         * Return a new collection with filtered items by callback
         *
         * @param {Function} callback
         * @returns {WidgetCollectionClass|boolean}
         */
        WidgetsRepository.prototype.filter = function(callback) {
            return this._collection.filter(callback);
        };

        /**
         * Return a new collection with filtered by some item property value
         *
         * @param {string} property
         * @param {string} value
         * @returns {WidgetCollectionClass|boolean}
         */
        WidgetsRepository.prototype.where = function(property, value) {
            return this._collection.where(property, value);
        };

        /**
         * Return a first item from collection where property will equal to value
         *
         * @param {string} property
         * @param {*} value
         * @returns {ContentWidgetClass|null}
         */
        WidgetsRepository.prototype.firstWhere = function(property, value) {
            return this._collection.firstWhere(property, value);
        };

        return new WidgetsRepository();
    }
]);