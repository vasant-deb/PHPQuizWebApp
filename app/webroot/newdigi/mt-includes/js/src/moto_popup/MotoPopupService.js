/* Source: src/mt-includes/js/src/moto_popup/MotoPopupService.js*/
angular.module('website').service('website.MotoPopupService', [
    '$rootScope',
    '$timeout',
    '$q',
    '$compile',
    'website.MotoStorageService',
    'Website.Backend.RenderService',
    'currentFrontendSession',
    'website.Entertainment',
    'MotoScrollbarWatcherService',
    function($rootScope, $timeout, $q, $compile, MotoStorageService, RenderService, currentFrontendSession, Entertainment, MotoScrollbarWatcherService) {
        var $scope;
        var queueCheckTimeout = 500;
        var popupQueue = [];

        // Update popup width
        function updatePopupWidth(width) {
            $('.mfp-content').css('width', width);
        }

        function addToQueue(popupId, openCallback) {
            popupQueue.push({
                id: popupId,
                callback: openCallback
            });
        }

        function getNextInQueue() {
            return popupQueue.shift();
        }

        function isAnyPopupOpened() {
            return angular.isObject($.magnificPopup.instance.currItem);
        }

        function openPopup(popupId, openCallback) {
            var ERROR_MESSAGE_CONTENT = window.websiteConfig && window.websiteConfig.popup_preferences && window.websiteConfig.popup_preferences.loading_error_message || '';
            var ERROR_MESSAGE_CLASS = 'moto-popup__content_error';
            var promise;
            var ignoreClosingPopup = false;
            var debug = false;
            var popupIsOpened = isAnyPopupOpened();

            openCallback = angular.isFunction(openCallback) ? openCallback : angular.noop;

            function popupIsClosed() {
                popupIsOpened = false;
                if ($scope) {
                    $scope.$destroy();
                }
                if (promise) {
                    promise = $q.reject(promise, 'rejecting');
                }
            }

            if (popupIsOpened) {
                $.magnificPopup.close();
                popupIsClosed();
            }

            popupIsOpened = true;
            $.magnificPopup.open({
                items: {
                    src: '<div id="moto-popup-content"></div>',
                    type: 'inline'
                },
                showCloseBtn: false,
                closeOnBgClick: false,
                mainClass: 'moto-popup',
                callbacks: {
                    open: function() {
                        $.magnificPopup.instance.updateStatus('loading');
                    },
                    close: function() {
                        // @ATTENTION : if we forcing
                        if (!ignoreClosingPopup) {
                            popupIsClosed();
                        }
                    }
                }
            });

            promise = RenderService.render({
                id: popupId
            }).then(
                function(response) {
                    var $content;
                    var scrollWatcher;

                    if (promise.$$state.status === 2) {
                        debug && console.log(popupId, ':   user reject opening popup');

                        return;
                    }

                    if (!popupIsOpened) {
                        debug && console.log(popupId, ':   Popup is closed => return');

                        return;
                    }

                    $content = $(response.content);

                    // @ATTENTION : need close previous magnificPopup, because next 'open()' not using new 'callbacks'
                    ignoreClosingPopup = true;
                    $.magnificPopup.close();
                    ignoreClosingPopup = false;

                    $.magnificPopup.open({
                        items: {
                            src: $content,
                            type: 'inline'
                        },
                        mainClass: 'moto-popup',
                        closeOnBgClick: false,
                        callbacks: {
                            open: function() {
                                updatePopupWidth(response.properties.width);
                                $scope = $rootScope.$new();
                                $content = $compile($content)($scope);
                                // @TODO : try to create 'widget' and set them as default widget, then forget them when popup is closing
                                Entertainment.letsDance({
                                    id: popupId,
                                    name: '@popup',
                                    $scope: $scope,
                                    $element: $content
                                });
                                scrollWatcher = MotoScrollbarWatcherService.addWatcher(function() {
                                    // we must use original events here (not synthetic)
                                    var resizeEvent = window.document.createEvent('UIEvents');

                                    resizeEvent.initUIEvent('resize', true, false, window, 0);
                                    window.dispatchEvent(resizeEvent);
                                }, $content[0]);
                                openCallback();
                            },
                            close: function() {
                                scrollWatcher();
                                popupIsClosed();
                            }
                        }
                    });

                    popupIsOpened = true;
                },
                function(error) {
                    debug && console.warn('Server return error', error);
                    if (!popupIsOpened) {
                        return;
                    }
                    popupIsOpened = true;
                    $.magnificPopup.instance.updateStatus('ready');
                    // 'error' not remove 'loading'
                    updatePopupWidth('1200px');
                    $('#moto-popup-content').addClass(ERROR_MESSAGE_CLASS).html(ERROR_MESSAGE_CONTENT);
                }
            );
        }

        function pleaseOpenPopup(popupId, openCallback) {
            isAnyPopupOpened() ?
                addToQueue(popupId, openCallback) :
                openPopup(popupId, openCallback);
        }

        function checkQueue() {
            var nextPopup;

            if (isAnyPopupOpened() || popupQueue.length === 0) {
                return;
            }
            nextPopup = getNextInQueue();
            openPopup(nextPopup.id, nextPopup.callback);
        }

        function updateDataInStorage(id, type) {
            var storageKeyName = 'popups-storage';
            var storageObject;

            if (type === 'session') {
                storageKeyName = 'popups-session';
            }

            storageObject = MotoStorageService.getLocalStorageItem(storageKeyName, {});
            if (storageObject[id]) {
                storageObject[id].shows++;
            } else {
                storageObject[id] = {
                    shows: 1
                };
            }
            storageObject[id].timestamp = Date.now();
            MotoStorageService.setLocalStorageItem(storageKeyName, storageObject);
        }

        function shouldPopupBeOpened(id, type, options) {
            var storageObject;

            if (type === 'always') {
                return true;
            }

            if (type === 'session') {
                storageObject = MotoStorageService.getLocalStorageItem('popups-session', {});
                if (storageObject[id]) {
                    return false;
                }

                return true;
            }

            storageObject = MotoStorageService.getLocalStorageItem('popups-storage', {});

            if (type === 'amount') {
                if (storageObject[id] && storageObject[id].shows >= options.shows) {
                    return false;
                }
            }

            if (type === 'overtime') {
                if (storageObject[id] && (Date.now() - storageObject[id].timestamp) < options.overtime * 1000) {
                    return false;
                }
            }

            return true;
        }

        function init() {
            var popupCloseFn = $.magnificPopup.proto._close;

            $.magnificPopup.proto._close = function() {
                var result = popupCloseFn.apply(this, arguments);

                $timeout(checkQueue, queueCheckTimeout);

                return result;
            };
            if (currentFrontendSession.isNew) {
                MotoStorageService.removeLocalStorageItem('popups-session');
            }
        }

        this.init = init;
        this.pleaseOpenPopup = pleaseOpenPopup;
        this.openPopup = openPopup;
        this.updateDataInStorage = updateDataInStorage;
        this.shouldPopupBeOpened = shouldPopupBeOpened;
    }
]);