/* Source: src/mt-includes/widgets/countdown/frontend.js*/
angular.module('website.widget.countdown', ['timer', 'website.core.humanize_duration'])
    .directive('motoWidgetCountdown', ['$window', function($window) {

        function timeByTimezone(time, timezone) {
            var year;
            var month;
            var day;
            var hours;
            var minutes;
            var seconds;
            var milliseconds;
            var localDate;
            var dateByTimezone;
            var timeByTimezone;

            localDate = new Date();
            localDate.setTime(time);
            milliseconds = localDate.getMilliseconds();
            seconds = localDate.getSeconds();
            minutes = localDate.getMinutes();
            hours = localDate.getHours();
            day = localDate.getDate();
            month = localDate.getMonth();
            year = localDate.getFullYear();
            dateByTimezone = new Date();
            dateByTimezone.setUTCFullYear(year);
            dateByTimezone.setUTCDate(1);
            dateByTimezone.setUTCMonth(month || 0);
            dateByTimezone.setUTCDate(day || 1);
            dateByTimezone.setUTCHours(hours || 0);
            dateByTimezone.setUTCMinutes((minutes || 0) - (Math.abs(timezone) < 30 ? timezone * 60 : timezone));
            dateByTimezone.setUTCSeconds(seconds || 0);
            dateByTimezone.setUTCMilliseconds(milliseconds || 0);
            timeByTimezone = dateByTimezone.getTime();

            return timeByTimezone;
        }

        return {
            restrict: 'C',
            scope: true,
            compile: function($element, $attrs) {
                var timerElement = $element.children('timer');
                var amountElements = $element.find('.countdown-item-amount');
                var amountElement;
                var amountElementNgBindAttr;
                var time = parseFloat($attrs.time);
                var nowTime = new Date().getTime();
                var i;

                function onExpiryHandler() {
                    if ($attrs.onExpiry === 'hide') {
                        $element.slideUp();
                    } else if ($attrs.onExpiry === 'redirect' && $attrs.redirectUrl) {
                        $window.location.href = $attrs.redirectUrl;
                    }
                }

                for (i = 0; i < amountElements.length; i++) {
                    amountElement = angular.element(amountElements[i]);
                    amountElementNgBindAttr = amountElement.attr('data-ng-bind');
                    if (i === 0) {
                        timerElement.attr('max-time-unit', '\'' + amountElementNgBindAttr.slice(0, -1) + '\'');
                    }
                    if (['hours', 'minutes', 'seconds'].indexOf(amountElementNgBindAttr) >= 0) {
                        amountElement.attr('data-ng-bind', amountElementNgBindAttr[0] + amountElementNgBindAttr);
                    }
                }

                return {
                    pre: function($scope) {
                        if ($attrs.type === 'event') {
                            $scope.countdownTime = (timeByTimezone(time, parseFloat($attrs.timezone)) - nowTime) / 1000;
                        } else {
                            $scope.countdownTime = time / 1000;
                        }
                        if (!$scope.countdownTime || isNaN($scope.countdownTime) || $scope.countdownTime < 0) {
                            $scope.countdownTime = 0;
                        }
                        $attrs.onExpiry && $attrs.onExpiry !== 'stop' && $scope.$on('timer-stopped', onExpiryHandler);
                    }
                };
            }
        };
    }]);