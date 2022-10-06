/* Source: src/mt-includes/js/src/moto_website_directives/moto_truncate_string.js*/
angular.module('website')
    .filter('motoTruncateString', function() {
        return function(input, length, textEnd) {
            textEnd = textEnd || '...';
            if (isNaN(length) || length < (textEnd.length + 1)) {
                length = 10;
            }
            if (input.length > length) {
                input = input.substr(0, length - textEnd.length) + textEnd;
            }

            return input;
        };
    });