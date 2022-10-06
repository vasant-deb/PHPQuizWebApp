/* Source: src/mt-includes/widgets/actions/src/frontend/open_popup.frontend.js*/
angular.module('website.widget.actions.open_popup', []).directive('motoWidgetActionsOpenPopup', [
    '$timeout',
    'website.MotoPopupService',
    'motoBeforeInViewport',
    function($timeout, MotoPopupService, motoBeforeInViewport) {
        return {
            restrict: 'C',
            scope: true,
            link: function($scope, $element, $attrs) {
                var widgetProperties = $scope.$eval($attrs.actionsOpenPopupOptions);
                var popupCallback;

                if (!widgetProperties.popupId || !MotoPopupService.shouldPopupBeOpened(widgetProperties.actionId, widgetProperties.recurrenceCondition, widgetProperties.recurrenceOptions)) {
                    return;
                }

                function recurrenceOpenPopupCallback() {
                    MotoPopupService.updateDataInStorage(widgetProperties.actionId, widgetProperties.recurrenceCondition);
                }

                function openPopup() {
                    MotoPopupService.pleaseOpenPopup(widgetProperties.popupId, popupCallback);
                }

                if (widgetProperties.recurrenceCondition !== 'always') {
                    popupCallback = recurrenceOpenPopupCallback;
                }

                if (widgetProperties.triggerType === 'timer') {
                    $timeout(openPopup, widgetProperties.delayTime);
                } else if (widgetProperties.triggerType === 'placement') {
                    motoBeforeInViewport.startWatching({
                        element: $element,
                        onEnter: openPopup
                    });
                }
            }
        };
    }
]);