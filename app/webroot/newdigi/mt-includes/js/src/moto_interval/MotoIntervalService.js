/* Source: src/mt-includes/js/src/moto_interval/MotoIntervalService.js*/
angular.module('website').service('MotoIntervalService', [
    '$interval',
    function($interval) {
        var interval = null;
        var intervalTimer = 100;
        var callbacks = [];

        function processCallback(callback) {
            callback && callback();
        }

        function processCallbacks() {
            callbacks.forEach(processCallback);
        }

        this.registerCallback = function(callbackFn) {
            if (!angular.isFunction(callbackFn) || (callbacks.indexOf(callbackFn) > -1)) return angular.noop;

            callbacks.push(callbackFn);

            return function() {
                callbacks[callbacks.indexOf(callbackFn)] = null;
            };
        };

        this.start = function() {
            interval = $interval(processCallbacks, intervalTimer);
        };

        this.stop = function() {
            $interval.cancel(interval);
        };

        this.start();
    }
]);