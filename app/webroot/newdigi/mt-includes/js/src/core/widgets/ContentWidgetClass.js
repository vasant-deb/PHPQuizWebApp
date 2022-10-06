/* Source: src/mt-includes/js/src/core/widgets/ContentWidgetClass.js*/
angular.module('website.core.widgets').service('website.ContentWidgetClass', [
    'website.MotoAnimation',
    'website.Entertainment',
    'website.WidgetCollectionClass',
    'motoBeforeInViewport',
    function(MotoAnimation, Entertainment, WidgetCollectionClass, motoBeforeInViewport) {

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
         *
         * @TODO : add options for widget is need repeating animation
         *
         * @param {jQuery} source
         * @constructor
         */
        function ContentWidgetClass(source) {
            var $element;

            if (angular.isElement(source)) {
                $element = source;
            } else if (!angular.isElement(source) && angular.isObject(source)) {
                this.id = source.id;
                this.name = source.name;
                $element = source.$element;
                this.setScope(source.$scope);
            }

            if (angular.isElement($element)) {
                this.setElement($element);
            }
            this.children = new WidgetCollectionClass();
        }

        /**
         * @type {boolean}
         * @private
         */
        ContentWidgetClass.prototype._debug = false;

        /**
         * @type {string}
         */
        ContentWidgetClass.prototype.id = null;

        /**
         * @type {string}
         */
        ContentWidgetClass.prototype.name = null;

        /**
         * @type {jQuery}
         */
        ContentWidgetClass.prototype.$element = null;

        /**
         * @type {Object}
         */
        ContentWidgetClass.prototype.$scope = null;

        /**
         * @type {jQuery}
         */
        ContentWidgetClass.prototype.$content = null;

        /**
         * @type {WidgetCollectionClass}
         */
        ContentWidgetClass.prototype.children = null;

        /**
         * @type {ContentWidgetClass}
         * @private
         */
        ContentWidgetClass.prototype._parent = null;

        /**
         * Set parent widget to this widget
         *
         * @param {ContentWidgetClass} parent
         * @returns {boolean}
         */
        ContentWidgetClass.prototype.setParent = function(parent) {
            // widget parent can't be a changed
            if (this._parent) {
                return (this._parent === parent);
            }

            if (parent instanceof ContentWidgetClass) {
                this._parent = parent;

                return true;
            }

            return false;
        };

        /**
         * Return parent widget
         *
         * @returns {ContentWidgetClass}
         */
        ContentWidgetClass.prototype.getParent = function() {
            return this._parent;
        };

        /**
         * Add new child widget to collection
         *
         * @param {ContentWidgetClass} widget
         * @returns {boolean}
         */
        ContentWidgetClass.prototype.addChild = function(widget) {
            if (this.children.push(widget)) {
                widget.setParent(this);

                return true;
            }

            return false;
        };

        /**
         * Return child widget by id or index
         *
         * @param {string|int} uid
         * @returns {ContentWidgetClass|null}
         */
        ContentWidgetClass.prototype.getChild = function(uid) {
            return this.children.getById(uid) || this.children.getByIndex(uid);
        };

        /**
         * Connect DOM Node for widget
         *
         * @param {jQuery} $element
         * @returns {boolean}
         */
        ContentWidgetClass.prototype.setElement = function($element) {
            // widget dom element can't be a changed
            if (this.$element) {
                return (this.$element === $element);
            }

            if (!angular.isElement($element)) {
                return false;
            }

            this.$element = $element;
            this.id = $element.attr('id') || this.id;
            this.name = $element.attr('data-widget') || this.name;
            this.$content = $element.find('#' + this.id + '__content') || this.$element;

            return true;
        };

        /**
         * Connect Scope for widget
         *
         * @param $scope
         * @returns {boolean}
         */
        ContentWidgetClass.prototype.setScope = function($scope) {
            // widget scope can't be a changed
            if (this.$scope) {
                return (this.$scope === $scope);
            }

            if (!isScope($scope)) {
                return false;
            }

            this.$scope = $scope;

            return true;
        };

        /**
         * Return widget scope
         *
         * @returns {null|*}
         */
        ContentWidgetClass.prototype.getScope = function() {
            return this.$scope;
        };

        /**
         * Handler for widget already visible on start view page
         *
         * @param {Object} preferences
         */
        ContentWidgetClass.prototype.onVisibleImmediately = function(preferences) {
            this._debug && console.warn(this.name, 'onVisibleImmediately #', this.id, preferences);
            this.onArriving(preferences);
            this.onArrived(preferences);
        };

        /**
         * Handler calling when widget will be visible on page content, not view port
         *
         * @param {Object} preferences
         */
        ContentWidgetClass.prototype.onArriving = function(preferences) {
            this._debug && console.warn(this.name, 'onArriving #', this.id, preferences);
            if (preferences.startAnimation === 'onArriving') {
                Entertainment.letsStartAnimation(this);
            }
            Entertainment.letsDance(this);
            motoBeforeInViewport.elementIsVisible(this.$element);
        };

        /**
         * Handler calling when widget is visible on page content, not view port
         *
         * @param {Object} preferences
         */
        ContentWidgetClass.prototype.onArrived = function(preferences) {
            this._debug && console.warn(this.name, 'onArrived #', this.id, preferences);
            if (preferences.startAnimation === 'onArrived') {
                Entertainment.letsStartAnimation(this);
            }
        };

        /**
         * Handler calling when widget will be hide on page content
         *
         * @param {Object} preferences
         */
        ContentWidgetClass.prototype.onVanishing = function(preferences) {
            this._debug && console.warn(this.name, 'onVanishing #', this.id, preferences);
            Entertainment.letsStopAnimation(this);
            Entertainment.letsStopDancing(this);
            motoBeforeInViewport.elementIsInvisible(this.$element);
        };

        /**
         * Handler calling when widget is hidden on page content
         *
         * @param {Object} preferences
         */
        ContentWidgetClass.prototype.onVanished = function(preferences) {
            this._debug && console.warn(this.name, 'onVanished #', this.id, preferences);
        };

        /**
         * Handler
         *
         * @param {Object} preferences
         */
        ContentWidgetClass.prototype.onResizing = function(preferences) {
            this._debug && console.warn(this.name, 'onResizing #', this.id, preferences);
        };

        return ContentWidgetClass;
    }
]);