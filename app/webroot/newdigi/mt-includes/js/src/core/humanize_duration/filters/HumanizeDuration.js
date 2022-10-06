/* Source: src/mt-includes/js/src/core/humanize_duration/filters/HumanizeDuration.js*/
angular.module('website.core.humanize_duration')
    /**
     * @example
     * {{ "99" | humanizeDuration:"hours":"uk" }}
     */
    .filter('humanizeDuration', ['motoHumanizeDuration', function(motoHumanizeDuration) {
        return function(amount, unit, language) {
            return motoHumanizeDuration.humanize(amount, unit, language);
        };
    }]);