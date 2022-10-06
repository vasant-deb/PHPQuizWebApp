/* Source: src/mt-includes/js/src/core/animation/MotoAnimation.js*/
/* globals WOW */
/**
 * @TODO : force start animation if object not visible by view port
 * @TODO : clean 'this.all & this.boxes' for allow repeating animation
 *      or fill this.boxes by element
 */
angular.module('website.core.animation').provider('website.MotoAnimation', [
    function() {
        var provider = this;
        var instance;
        var debug = false;
        var isWOW130 = null;
        var _options = {
            disabledClass: 'moto-entertainment__animation_disabled',
            ignoreVisibilityClass: 'moto-entertainment__animation_ignore-visibility'
        };

        /**
         * Set options for Animation service
         *
         * @param {Object} options
         * @returns {boolean}
         */
        provider.setOptions = function(options) {
            if (angular.isObject(options)) {
                angular.extend(_options, options);

                return true;
            }

            return false;
        };

        /**
         * Find elements by selector with add self element if them has selector
         *
         * @param {jQuery} $element
         * @param {string} selector
         * @returns {jQuery}
         */
        function findElements($element, selector) {
            var elements;

            elements = $element.find('.' + selector);
            if ($element.hasClass(selector)) {
                elements.push($element.get(0));
            }

            return elements;
        }

        /**
         * @constructor
         * @extends WOW
         */
        function WOWExtended() {
            WOW.apply(this, arguments);
            isWOW130 = angular.isDefined(this.config['resetAnimation']);

            debug && console.info('MotoAnimation : WOW engine is : ', isWOW130 ? '1.3.0' : '1.1.2');
        }

        WOWExtended.prototype = Object.create(WOW.prototype);
        WOWExtended.prototype.constructor = WOWExtended;

        /**
         * Flag for WOW engine started
         *
         * @type {boolean}
         * @private
         */
        WOWExtended.prototype._inited = false;

        /**
         * Enable debug mode
         *
         * @TODO : remove
         * @param mode
         * @dev
         */
        WOWExtended.prototype.debugMode = function(mode) {
            debug = mode;
        };

        /**
         * Dump to console current list of founded elements
         *
         * @TODO : remove
         * @dev
         */
        WOWExtended.prototype.dump = function() {
            console.info('DUMP');
            console.log('   this.all', this.all.length, this.all);
            console.log('   this.boxes', this.boxes.length, this.boxes);
        };

        /**
         * Force checking is need start animation elements on next tick
         *
         * @TODO : rename
         */
        WOWExtended.prototype.pingPong = function() {
            debug && console.log('MotoAnimation : PingPong');
            this.scrollHandler();
        };

        /**
         * Found all elements with animation and force pushing them to list
         *
         * @TODO : rename
         * @param {jQuery} $element
         * @returns {boolean}
         */
        WOWExtended.prototype.forceSyncElements = function($element) {
            var elements;

            if (!this._inited) {
                debug && console.warn('MotoAnimation : WOW engine not started');

                return false;
            }

            elements = findElements($element, this.config.boxClass);
            debug && console.log('MotoAnimation : forceSync, found', elements.length);

            if (!elements.length) {
                return true;
            }
            elements.each(function(index, box) {
                if (this.boxes.indexOf(box) < 0) {
                    this.boxes.push(box);
                    this.applyStyle(box, true);
                }
            }.bind(this));

            return true;
        };

        /**
         * Find all animated elements and reset styles for stops current animation
         *
         * @param {jQuery} $element
         * @returns {boolean}
         * @constructor
         */
        WOWExtended.prototype.RENAMEResetStyle = function($element) {
            var elements;

            if (!this._inited) {
                debug && console.warn('MotoAnimation : WOW engine not started');

                return false;
            }

            elements = findElements($element, this.config.boxClass);
            debug && console.log('MotoAnimation : RENAMEResetStyle, found', elements.length);

            if (!elements.length) {
                return true;
            }

            elements.each(function(index, element) {
                this.applyStyle(element, true);
            }.bind(this));

            return true;
        };

        /**
         * Disable animation on element and children nodes
         *
         * @param element
         */
        WOWExtended.prototype.disableByElement = function(element) {
            debug && console.log('MotoAnimation : disableByElement', element);
            $(element).addClass(_options.disabledClass);
        };

        /**
         * Remove disabling animation on element and children nodes
         *
         * @param element
         */
        WOWExtended.prototype.enableByElement = function(element) {
            debug && console.log('MotoAnimation : enableByElement', element);
            $(element).removeClass(_options.disabledClass);
        };

        /**
         * Check is element are visible on browser
         *
         * @param {HTMLElement} element
         * @returns {boolean}
         */
        WOWExtended.prototype.isVisible = function(element) {
            var $element = $(element);

            try {
                if ($element.hasClass(_options.disabledClass) || $element.closest('.' + _options.disabledClass).length) {
                    return false;
                }
                if ($element.hasClass(_options.ignoreVisibilityClass) || $element.closest('.' + _options.ignoreVisibilityClass).length) {
                    return true;
                }
                if ($element.closest('.moto-popup_content').length) {
                    return true;
                }
            } catch (e) {}

            return WOW.prototype.isVisible.call(this, element);
        };

        /**
         * Init website animation
         *
         * @param {boolean} force
         * @returns {boolean}
         */
        WOWExtended.prototype.init = function(force) {
            var result;

            if (force) {
                debug && console.log('MotoAnimation : init WOW');

                result = WOW.prototype.init.call(this);
                this._inited = true;

                debug && console.log('MotoAnimation : WOW started');

                return result;
            }

            return false;
        };

        instance = new WOWExtended({
            boxClass: 'wow',
            animateClass: 'animated',
            offset: 0,
            mobile: true,
            live: true,
            callback: null
        });

        // same logic as was on init.js
        $(document).ready(function() {
            instance.init(true);
        });

        this.$get = [
            function() {
                return instance;
            }
        ];

        return provider;
    }
]);