/* Source: src/mt-includes/js/src/core/init.js*/
angular.module('website.core.settings', ['ng']);
angular.module('website.core.dependency', [
    'website.core.settings',
    'website.core.utils',
    'website.LiveChat',
    'website.core.animation',
    'website.core.entertainment',
    'website.core.media',
    'website.core.widgets',
    'website.core.analytics'
]);