/* Source: src/mt-includes/js/src/core/entertainment/MotoEntertainment.js*/
angular.module('website.core.entertainment').provider('website.Entertainment', [
    'website.MotoAnimationProvider',
    function(MotoAnimationProvider) {
        var provider = this;
        var CSS_CLASSES = {
            animationDisabled: 'moto-entertainment__animation_disabled',
            animationIgnoring: 'moto-entertainment__animation_ignore-visibility',
            videoDisabled: 'moto-entertainment__video_disabled', //@deprecated?
            playingDisabled: 'moto-entertainment__playing_disabled'
        };
        var ENTERTAINMENT_LETS_DANCE_EVENT = 'LetsDance';
        var ENTERTAINMENT_LETS_REST_EVENT = 'LetsRest';
        var ENTERTAINMENT_LETS_STOP_EVENT = 'LetsStop';

        /**
         * Check is target are scope
         *
         * @param {Object} target
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
            return !!(target && angular.isDefined(target.id) && target.$scope && target.$element);
        }

        this.$get = [
            'website.MotoAnimation',
            function(MotoAnimation) {

                function EntertainmentService() {

                }

                /**
                 * Return css classes for marking element some feature
                 *
                 * @param {string|string[]}name
                 * @returns {string|null}
                 */
                EntertainmentService.prototype.getCssClass = function(name) {
                    var result = null;

                    if (angular.isString(name)) {
                        result = CSS_CLASSES[name] || result;
                    } else if (angular.isArray(name)) {
                        result = '';
                        angular.forEach(CSS_CLASSES, function(value, key) {
                            if (name.indexOf(key) > -1) {
                                result += value + ' ';
                            }
                        });

                        result = result.trim();
                    }

                    return result;
                };

                /**
                 * Check is disabled playing
                 *
                 * @param {jQuery} $element
                 * @returns {boolean}
                 */
                EntertainmentService.prototype.isDisabledPlaying = function($element) {
                    return !this.isEnabledPlaying($element);
                };

                /**
                 * Check is enabled playing
                 *
                 * @param {jQuery} $element
                 * @returns {boolean}
                 */
                EntertainmentService.prototype.isEnabledPlaying = function($element) {
                    return !($element.hasClass(CSS_CLASSES.playingDisabled) || $element.closest('.' + CSS_CLASSES.playingDisabled).length);
                };

                /**
                 * Enable playing on widget or element
                 *
                 * @param {ContentWidgetClass|jQuery} target
                 * @returns {boolean}
                 */
                EntertainmentService.prototype.enablePlaying = function(target) {
                    if (isWidget(target)) {
                        target = target.$element;
                    }
                    if (!target || !target.removeClass) {
                        return false;
                    }
                    target.removeClass(CSS_CLASSES.playingDisabled);

                    return true;
                };

                /**
                 * Disable playing on widget or element
                 *
                 * @param {ContentWidgetClass|jQuery} target
                 * @returns {boolean}
                 */
                EntertainmentService.prototype.disablePlaying = function(target) {
                    if (isWidget(target)) {
                        target = target.$element;
                    }
                    if (!target || !target.addClass) {
                        return false;
                    }
                    target.addClass(CSS_CLASSES.playingDisabled);

                    return true;
                };

                /**
                 * Allow start animation on widgets
                 *
                 * @param {ContentWidgetClass} target
                 */
                EntertainmentService.prototype.letsStartAnimation = function(target) {
                    MotoAnimation.forceSyncElements(target.$content);
                    MotoAnimation.enableByElement(target.$content);
                    MotoAnimation.pingPong();
                };

                /**
                 * Block starting animation on widgets
                 *
                 * @param {ContentWidgetClass} target
                 */
                EntertainmentService.prototype.letsBlockAnimation = function(target) {
                    MotoAnimation.disableByElement(target.$content);
                };

                /**
                 * Stops animation on widgets
                 *
                 * @param {ContentWidgetClass} target
                 */
                EntertainmentService.prototype.letsStopAnimation = function(target) {
                    this.letsBlockAnimation(target);
                    MotoAnimation.RENAMEResetStyle(target.$content);
                };

                /**
                 * Start playing video
                 *
                 * @param {ContentWidgetClass} target
                 */
                EntertainmentService.prototype.letsDance = function(target) {
                    this.enablePlaying(target);
                    if (isWidget(target)) {
                        target = target.$scope;
                    }
                    if (isScope(target)) {
                        target.$broadcast(ENTERTAINMENT_LETS_DANCE_EVENT);
                    }
                };

                /**
                 * Pause played video
                 *
                 * @param {ContentWidgetClass} target
                 */
                EntertainmentService.prototype.letsRestDancing = function(target) {
                    this.disablePlaying(target);
                    if (isWidget(target)) {
                        target = target.$scope;
                    }
                    if (isScope(target)) {
                        target.$broadcast(ENTERTAINMENT_LETS_REST_EVENT);
                    }
                };

                /**
                 * Stops played video
                 *
                 * @param {ContentWidgetClass} target
                 */
                EntertainmentService.prototype.letsStopDancing = function(target) {
                    this.disablePlaying(target);
                    if (isWidget(target)) {
                        target = target.$scope;
                    }
                    if (isScope(target)) {
                        target.$broadcast(ENTERTAINMENT_LETS_STOP_EVENT);
                    }
                };

                /**
                 * Bind target listening start video/audio event
                 *
                 * @param {Object} target
                 * @param {Object} target.$scope
                 * @param {jQuery} target.$element
                 * @param {function} callback
                 * @returns {function}
                 */
                EntertainmentService.prototype.$onLetsDanceEvent = function(target, callback) {
                    return target.$scope.$on(ENTERTAINMENT_LETS_DANCE_EVENT, callback);
                };

                /**
                 * Bind target listening pause video/audio event
                 *
                 * @param {Object} target
                 * @param {Object} target.$scope
                 * @param {jQuery} target.$element
                 * @param {function} callback
                 * @returns {function}
                 */
                EntertainmentService.prototype.$onLetsRestEvent = function(target, callback) {
                    return target.$scope.$on(ENTERTAINMENT_LETS_REST_EVENT, callback);
                };

                /**
                 * Bind target listening stop video/audio event
                 *
                 * @param {Object} target
                 * @param {Object} target.$scope
                 * @param {jQuery} target.$element
                 * @param {function} callback
                 * @returns {function}
                 */
                EntertainmentService.prototype.$onLetsStopEvent = function(target, callback) {
                    return target.$scope.$on(ENTERTAINMENT_LETS_STOP_EVENT, callback);
                };

                return new EntertainmentService();
            }
        ];

        return provider;
    }
]);