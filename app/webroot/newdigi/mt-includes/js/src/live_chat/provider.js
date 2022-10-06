/* Source: src/mt-includes/js/src/live_chat/provider.js*/
angular.module('website.LiveChat').provider('websiteLiveChat', [
    'website.LiveChat.settings',
    function(settings) {
        var provider;
        var APIProviders = {};
        var LiveChatApi;

        if (!angular.isObject(settings)) {
            settings = {
                provider: 'none'
            };
        }

        function AbstractConnectorClass(provider, options) {
            this._provider = provider;
            this._options = options;
        }

        AbstractConnectorClass.prototype = {};
        /**
         * @type {LiveChatProviderClass}
         * @private
         */
        AbstractConnectorClass.prototype._provider = null;
        AbstractConnectorClass.prototype._options = {};
        AbstractConnectorClass.prototype._booted = false;
        AbstractConnectorClass.prototype._booting = false;
        AbstractConnectorClass.prototype.boot = function() {
            console.warn('Method "boot" not implemented');

            return false;
        };
        AbstractConnectorClass.prototype.isReady = function() {
            return this._booted;
        };

        function LiveChatProviderClass() {

        }

        LiveChatProviderClass.prototype = {};

        /**
         * Boot Live Chat
         *
         * @returns {boolean}
         */
        LiveChatProviderClass.prototype.boot = function() {
            var constructor;

            if (!this.isEnabled()) {
                return false;
            }
            if (!this.isRegisteredProvider(this.getProviderName())) {
                return false;
            }
            if (LiveChatApi) {
                return false;
            }

            constructor = this.getApiProviderConstructor(this.getProviderName());
            if (!constructor) {
                return false;
            }
            LiveChatApi = new constructor(this, settings.options);
            LiveChatApi.boot();

            return true;
        };

        /**
         * Return current Live Chat system name
         * @returns {string}
         */
        LiveChatProviderClass.prototype.getProviderName = function() {
            return settings.provider;
        };

        /**
         * Check is enabled any Live Chat system
         *
         * @returns {boolean}
         */
        LiveChatProviderClass.prototype.isEnabled = function() {
            return (settings.provider !== 'none');
        };

        /**
         * Register Live Chat system
         *
         * @param {string} name
         * @param {Function} constructor
         * @returns {boolean}
         */
        LiveChatProviderClass.prototype.registerApiConnector = function(name, constructor) {
            if (!angular.isString(name) || (name.trim().length < 1)) {
                console.warn('LiveChatProvider : cant register provider, invalid name', name);

                return false;
            }

            if (!angular.isFunction(constructor)) {
                console.warn('LiveChatProvider : cant register provider constructor', constructor);

                return false;
            }

            if (!(constructor.prototype instanceof AbstractConnectorClass)) {
                console.warn('LiveChatProvider : invalid constructor', constructor);

                return false;
            }

            name = name.trim();

            APIProviders[name] = {
                name: name,
                constructor: constructor
            };

            return true;
        };

        /**
         * @param {string} name
         * @returns {boolean}
         */
        LiveChatProviderClass.prototype.isRegisteredProvider = function(name) {
            return !!APIProviders[name];
        };

        /**
         * @param {string} name
         * @returns {AbstractConnectorClass|null}
         */
        LiveChatProviderClass.prototype.getApiProviderConstructor = function(name) {
            if (!this.isRegisteredProvider(name)) {
                console.warn('LiveChatProvider : provider "', name, '" not exists');

                return null;
            }

            return APIProviders[name].constructor;
        };

        /**
         * @returns {AbstractConnectorClass|null}
         */
        LiveChatProviderClass.prototype.getApiProvider = function() {
            return LiveChatApi;
        };

        LiveChatProviderClass.prototype.$get = [
            function() {
                return provider;
            }
        ];

        provider = new LiveChatProviderClass();

        function LiveChatIncConnectorClass() {
            AbstractConnectorClass.apply(this, arguments);
        }

        LiveChatIncConnectorClass.prototype = Object.create(AbstractConnectorClass.prototype);
        LiveChatIncConnectorClass.prototype.constructor = LiveChatIncConnectorClass;

        /**
         * {@inheritdoc}
         */
        LiveChatIncConnectorClass.prototype.boot = function() {
            if (this._booted || this._booting) {
                return false;
            }

            this._booting = true;
            window.__lc = window.__lc || {};
            window.LC_API = window.LC_API || {};
            // window.LC_API.on_before_load = this.onBeforeLoadHandler.bind(this);
            window.LC_API.on_after_load = this._onAfterLoadHandler.bind(this);

            // force hide live chat, need for remove blinking chat
            if (this.isShowOnlyAgentsAreAvailable()) {
                this._getTempStyleNode().html('#chat-widget-container {display:none !important}');
            }

            if (!window.__lc.license) {
                window.__lc.license = this._options.licenceNumber;
                if (window.__lc.license)
                    (function() {
                        var lc = document.createElement('script');
                        lc.type = 'text/javascript';
                        lc.async = true;
                        lc.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'cdn.livechatinc.com/tracking.js';
                        var s = document.getElementsByTagName('script')[0];
                        s.parentNode.insertBefore(lc, s);
                    })();
            }

            return true;
        };

        /**
         * Callback handler for 'on_before_load'
         * @private
         */
        LiveChatIncConnectorClass.prototype._onBeforeLoadHandler = function() {
            // window.LC_API.agents_are_available return not actuality information
        };

        /**
         * Callback handler for 'on_after_load'
         * @private
         */
        LiveChatIncConnectorClass.prototype._onAfterLoadHandler = function() {
            var API = window.LC_API;
            var styleNode = this._getTempStyleNode();

            if (!API) {
                console.error('LiveChatInc : cant retrieve access to API [LC_API]');

                return false;
            }
            try {
                this._booted = true;
                this._booting = false;

                if (this.isShowOnlyAgentsAreAvailable() && !API.agents_are_available()) {
                    API.hide_chat_window();
                }
            } catch (e) {
                console.error(e);
            }

            // LiveChat api working with setTimeout with 200ms
            setTimeout(function() {
                styleNode.remove();
            }, 250);

            this._bindAPIListeners();
        };

        /**
         * Bind API listeners
         *
         * @returns {boolean}
         * @private
         */
        LiveChatIncConnectorClass.prototype._bindAPIListeners = function() {
            var API = window.LC_API;
            var i;
            var len;
            var methods = [
                'on_chat_started',
                'on_chat_window_opened',
                'on_chat_window_minimized',
                'on_chat_window_hidden',
                'on_chat_state_changed',
                'on_chat_started',
                'on_chat_ended',
                'on_message',
                'on_ticket_created',
                'on_prechat_survey_submitted',
                'on_postchat_survey_submitted',
                'on_rating_submitted',
                'on_rating_comment_submitted'
            ];

            if (!API) {
                console.error('LiveChatInc : cant retrieve access to API [LC_API]');

                return false;
            }

            // connecting to API
            for (i = 0, len = methods.length; i < len; i++) {
                API[methods[i]] = this._createAPICallback(methods[i]);
            }

            return true;
        };

        /**
         * Return API callback wrapper function
         *
         * @param {string} name
         * @returns {Function}
         * @private
         */
        LiveChatIncConnectorClass.prototype._createAPICallback = function(name) {
            var self = this;

            return function() {
                self._onAPICallback(name, Array.prototype.slice.call(arguments));
            };
        };

        /**
         * Main API callback listener
         *
         * @param {string} event
         * @param {array} data
         * @private
         */
        LiveChatIncConnectorClass.prototype._onAPICallback = function(event, data) {

        };

        /**
         * Return temporary style node
         *
         * @returns {jQuery}
         * @private
         */
        LiveChatIncConnectorClass.prototype._getTempStyleNode = function() {
            var id = 'motoLiveChatTempStyle';
            var node = null;

            node = document.getElementById(id);
            if (!node) {
                node = document.createElement('style');
                node.setAttribute('id', id);
                document.body.appendChild(node);
            }

            return $('#' + id);
        };

        /**
         * Check is showing chat only is agents are available
         *
         * @returns {boolean}
         */
        LiveChatIncConnectorClass.prototype.isShowOnlyAgentsAreAvailable = function() {
            return angular.isDefined(this._options['showOnlyAgentsAreAvailable']) && this._options.showOnlyAgentsAreAvailable;
        };

        provider.registerApiConnector('LiveChatInc', LiveChatIncConnectorClass);

        provider.boot();

        return provider;
    }
]);