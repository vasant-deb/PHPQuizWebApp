/* Source: src/mt-includes/js/src/browser_tab_closing_confirmation/service.js*/
angular.module('website').service('website.BrowserTabClosingConfirmation', [
    function() {
        var usedByWidgets = [];

        function beforeUnloadHandler() {
            return '';
        }

        this.enable = function(item) {
            if (!angular.isString(item)) {
                return;
            }

            usedByWidgets.push(item);

            if (usedByWidgets.length === 1) {
                angular.element(window).on('beforeunload', beforeUnloadHandler);
            }
        };

        this.disable = function(item) {
            if (!angular.isString(item)) {
                return;
            }

            var itemIndex = usedByWidgets.indexOf(item);

            if (itemIndex === -1) {
                return;
            }

            usedByWidgets.splice(itemIndex, 1);

            if (usedByWidgets.length === 0) {
                angular.element(window).off('beforeunload', beforeUnloadHandler);
            }
        }
    }
]);