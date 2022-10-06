/* Source: src/mt-includes/js/src/moto_scrollbar_watcher/MotoScrollbarWatcherService.js*/
angular.module('website').service('MotoScrollbarWatcherService', [
    'MotoIntervalService',
    function(MotoIntervalService) {
        var watcherInstance = angular.noop;
        var watchers = [];

        function processWatcher(item) {
            var currentScrollbarState;

            if (!angular.isObject(item)) {
                return false;
            }

            currentScrollbarState = item.node.clientHeight < item.node.scrollHeight;

            if (item.scrollbarState !== null && currentScrollbarState !== item.scrollbarState) {
                item.callbackFn();
            }

            item.scrollbarState = currentScrollbarState;

            return true;
        }

        function processWatchers() {
            watchers.forEach(processWatcher);
        }

        this.addWatcher = function(callbackFn, node) {
            var callbackObject;

            if (!angular.isFunction(callbackFn) || !(node instanceof Element)) return angular.noop;

            callbackObject = {
                callbackFn: callbackFn,
                node: node,
                scrollbarState: null
            };

            watchers.push(callbackObject);

            // start watching only if it is the first callbackFn
            if (watchers.length === 1) {
                this.startWatch();
            }

            return function() {
                watchers[watchers.indexOf(callbackObject)] = null;
            };
        };

        this.startWatch = function() {
            watcherInstance = MotoIntervalService.registerCallback(processWatchers);
        };

        this.stopWatch = watcherInstance;
    }
]);