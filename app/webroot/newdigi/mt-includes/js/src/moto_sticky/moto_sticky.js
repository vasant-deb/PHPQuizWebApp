/* Source: src/mt-includes/js/src/moto_sticky/moto_sticky.js*/
/**
 * @module website
 *
 * MotoSticky directive
 */

/**
 * Object with data about sticky element.
 *
 * @typedef {Object} StickyObject
 * @property {Object} $scope
 * @property {Object} $element
 * @property {Object} $attrs
 * @property {Object} $pseudoElement
 * @property {StickyObjectOptions} options
 * @property {Boolean} isAttached
 */

/**
 * Object with options of sticky element.
 *
 * @typedef {Object} StickyObjectOptions
 * @property {Boolean} hidden
 * @property {Number} offset
 * @property {String} mode
 * @property {String} direction
 */

angular.module('website').directive('motoSticky', [
    '$window',
    '$timeout',
    function($window, $timeout) {
        var _window = angular.element($window);
        var POPUP_TOP_MARGIN = 50;
        var settings = {
            interval: 32,
            attachedClass: 'moto-sticky__attached',
            bootstrappedClass: 'moto-sticky__bootstrapped',
            pseudoElementClass: 'moto-sticky-pseudo-element'
        };
        var defaultOptions = {
            hidden: false,
            offset: 0,
            mode: 'dynamic',
            direction: 'top'
        };
        var objects = [];
        var needCheck = true;
        var needCheckOnResize = true;
        var $timer;

        function isDebug() {
            return window.motoDebug || false;
        }

        /**
         * Check if element should be attached and return result.
         *
         * @param {StickyObject} object - sticky object.
         * @returns {Boolean} - true if element should be attached.
         */
        function isNeedAttache(object) {
            var elementTopMargin;
            var viewportHeight;
            var $element;
            var result;
            var offset;
            var rect;

            if (object.options.mode === 'static') {
                return true;
            }

            $element = (object.isAttached || object.options.hidden ? object.$pseudoElement : object.$element);
            rect = $element.get(0).getBoundingClientRect();
            result = false;
            offset = object.options.offset;
            elementTopMargin = parseInt($element.css('marginTop')) || 0;

            if (object.options.mode === 'smallHeight') {
                viewportHeight = Math.max(document.documentElement.clientHeight, window.innerHeight || 0);

                return ((rect.top + $element.outerHeight()) < viewportHeight);
            }

            if (0 && rect.top === rect.bottom && rect.bottom === 0 && object.$element.width() === 0 && object.$element.outerHeight() === 0) {
                console.log('ZEEEROOO.element', object.$element);
                console.log('ZEEEROOO.rect', rect);
                console.log('ZEEEROOO.width', object.$element.width());
                console.log('ZEEEROOO.height', object.$element.height());
            }

            if (object.options.direction === 'top') {
                result = (rect.top - elementTopMargin <= offset);
            }

            return result;
        }

        /**
         * Synchronize object and pseudo element dimensions.
         *
         * @param {StickyObject} object - object to Synchronize.
         */
        function syncPseudoElement(object) {
            var elementWidth = 0;

            try {
                object.$pseudoElement.show();
                if (!needCheckOnResize) {
                    object.$element.innerWidth(object.$pseudoElement.innerWidth());
                }
                if (!object.options.hidden) {
                    object.$pseudoElement.height(object.$element.outerHeight(true));
                }

                if (needCheckOnResize) {
                    object.$pseudoElement.hide();
                    object.$element
                        .removeClass(settings.attachedClass)
                        .removeClass(settings.attachedClass + '_' + object.options.direction)
                        .css('width', '')
                        .css('marginTop', '');

                    elementWidth = object.$element.innerWidth();
                    object.$pseudoElement.show();
                    object.$element.innerWidth(elementWidth);
                    object.$pseudoElement.innerWidth(elementWidth);

                    object.$element
                        .addClass(settings.attachedClass)
                        .addClass(settings.attachedClass + '_' + object.options.direction);
                }
            } catch (Error) {
                isDebug() && console.info('motoSticky : ERROR on syncPseudoElement', Error);
            }
        }

        /**
         * Attach object to top.
         *
         * @param {StickyObject} object - object to attach.
         * @returns {Boolean} - now always return true.
         */
        function attachObject(object) {
            if (!object.isAttached) {
                object.$element
                    .show()
                    .addClass(settings.attachedClass)
                    .addClass(settings.attachedClass + '_' + object.options.direction);
                object.isAttached = true;
            }
            syncPseudoElement(object);

            return true;
        }

        /**
         * UnAttach object from top.
         *
         * @param {StickyObject} object - object to UnAttach.
         * @returns {Boolean} - return true if object is not attached.
         */
        function unAttachObject(object) {
            object.$pseudoElement.width(object.$element.innerWidth());

            if (!object.isAttached) {
                return true;
            }

            object.$element.css('width', '');
            object.isAttached = false;
            object.$element
                .removeClass(settings.attachedClass)
                .removeClass(settings.attachedClass + '_' + object.options.direction);
            if (object.options.hidden) {
                object.$pseudoElement.height(0);
                object.$element.hide();
            } else {
                object.$pseudoElement.hide();
            }
        }

        /**
         * Check if object should be attached.
         * If should be, will be attached. In other case unattached.
         *
         * @param {StickyObject} object - object for checking.
         */
        function checkObject(object) {
            try {
                if (isNeedAttache(object)) {
                    attachObject(object);
                } else {
                    unAttachObject(object);
                }
            } catch (Error) {
                isDebug() && console.info('motoSticky : ERROR on checkObject', Error);
            }
        }

        /**
         * Check all objects.
         * Recursive function, always calling itself with $timeout.
         *
         * @param {Boolean} skipTimer - if passed true, new timeout would not be created.
         */
        function checkObjects(skipTimer) {
            var len;
            var i;

            try {
                if (!skipTimer) {
                    if ($timer) {
                        $timeout.cancel($timer);
                    }
                    $timer = $timeout(checkObjects, settings.interval);
                }

                if (!needCheck || objects.length < 1) {
                    return;
                }
                needCheck = false;

                for (i = 0, len = objects.length; i < len; i++) {
                    checkObject(objects[i]);
                }

                needCheckOnResize = false;
            } catch (Error) {
                isDebug() && console.info('motoSticky : ERROR on checkObjects', Error);
            }
        }

        /**
         * Create pseudo element for sticky element, if not yet created.
         *
         * @param {StickyObject} object - object to create.
         */
        function initPseudoElement(object) {
            if (object.$pseudoElement) {
                return;
            }
            object.$pseudoElement = angular.element('<div class="' + settings.pseudoElementClass + '"></div>');
            object.$pseudoElement.insertAfter(object.$element);
            if (object.options.hidden) {
                object.$pseudoElement.height(0);
            } else {
                object.$pseudoElement.hide();
                object.$pseudoElement.height(object.$element.outerHeight(true));
                object.$pseudoElement.width(object.$element.innerWidth());
            }
        }

        /**
         * Function adds 'load' event listeners to lazy load elements inside our sticky container.
         * because we should synchronize our pseudoElement after loading all the content.
         *
         * @param {StickyObject} object - Sticky object.
         */
        function addLazyElementsLoadListeners(object) {
            object.$element
                .find('.lazyload')
                .each(function(i, lazyElement) {
                    $(lazyElement).one('load', function() {
                        checkObject(object);
                    });
                });
        }

        /**
         * Handler on scroll/resize window events.
         *
         * @param {Object} event - jQuery event.
         */
        function onWindowChange(event) {
            if (event.type === 'resize') {
                needCheckOnResize = true;
            }
            needCheck = true;
        }

        /**
         * Handler on scroll popup event.
         */
        function onPopupChange() {
            needCheckOnResize = true;
            needCheck = true;
        }

        /**
         * Bind listeners on scroll and resize for popup content.
         * On scope destroying listeners will be unbounded.
         * If in popup more than one sticky element, redundant listeners will be prevented.
         *
         * @param {Object} $scope - Angular scope.
         * @param {Object} $popup - jQuery element popup content (.moto-popup_content)
         */
        function bindEventsForPopup($scope, $popup) {
            if (!$popup.hasClass('moto-sticky__handlers-attached')) {
                $popup
                    .addClass('moto-sticky__handlers-attached')
                    .on('scroll', onPopupChange)
                    .on('lazybeforeunveil', '.lazyload', function(event) {
                        $(event.target).one('load', onPopupChange);
                    });

                $scope.$on('$destroy', function() {
                    $popup.off('scroll');
                });
            }
        }

        /**
         * Create new object and add to global list of objects.
         * Entry point for directive.
         *
         * @param {Object} $scope - angular scope.
         * @param {Object} $element - jQuery element.
         * @param {Object} $attrs - angular $attrs object.
         * @returns {Undefined} - nothing useful.
         */
        function addObject($scope, $element, $attrs) {
            var $popup = $element.parents('.moto-popup_content');
            var inPopup = !!$popup.length;
            var object;
            var options;

            try {
                if ($element.parent().closest('.' + settings.bootstrappedClass).length > 0) {
                    return isDebug() && console.log('motoSticky : DETECTED PARENTS');
                }
                options = $scope.$eval($attrs.motoSticky);

                if (inPopup) {
                    options.offset = POPUP_TOP_MARGIN;
                    bindEventsForPopup($scope, $popup);
                }

                object = {
                    $scope: $scope,
                    $element: $element,
                    $attrs: $attrs,
                    options: angular.extend({}, defaultOptions, options),
                    isAttached: false
                };

                addLazyElementsLoadListeners(object);
                initPseudoElement(object);
                checkObject(object);

                objects.push(object);

            } catch (Error) {
                isDebug() && console.info('motoSticky : ERROR on addObject', Error);
            }
        }

        checkObjects();

        _window
            .scroll(onWindowChange)
            .resize(onWindowChange);

        return {
            restrict: 'A',
            compile: function($element) {
                $element.addClass(settings.bootstrappedClass);

                return addObject;
            }

        };
    }
]);