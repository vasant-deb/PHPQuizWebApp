/* Source: src/mt-includes/js/src/core/humanize_duration/services/HumanizeDuration.js*/
angular.module('website.core.humanize_duration')
    .provider('motoHumanizeDuration', [function() {
        var self = this,
            unitMeasures = {
                y: 31557600000,
                mo: 2629800000,
                w: 604800000,
                d: 86400000,
                h: 3600000,
                m: 60000,
                s: 1000,
                ms: 1
            },
            customUnits = {
                years: 'y',
                months: 'mo',
                weeks: 'w',
                days: 'd',
                hours: 'h',
                minutes: 'm',
                seconds: 's',
                milliseconds: 'ms'
            };

        /**
         * Convert amount of time units to humanized text
         *
         * @example
         * var ruMinutes = motoHumanizeDuration.humanize(1, 'minutes', 'ru'); // ruMinutes is equal to 'минута'
         *
         * @param amount
         * @param unit
         * @param language
         * @returns {string}
         */
        this.humanize = function(amount, unit, language) {
            var spacer = '>',
                humanizeString;

            if (!language || humanizeDuration.getSupportedLanguages().indexOf(language) < 0) {
                language = 'en';
            }
            if (customUnits[unit]) {
                unit = customUnits[unit];
            }
            humanizeString = humanizeDuration(amount * unitMeasures[unit], {
                spacer: spacer,
                language: language,
                units: [unit],
                round: true
            });
            return humanizeString.substr(humanizeString.indexOf(spacer) + spacer.length);
        };

        this.$get = [function() {
            return self;
        }];
    }]);