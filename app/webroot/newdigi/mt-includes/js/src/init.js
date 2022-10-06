/* Source: src/mt-includes/js/src/init.js*/
// frontend application module
angular.module('website', [
        'core.library.config',
        'core.library.jsonrpc',
        'website.core',
        'website.widgets',
        'website.plugins',
        'website.moto_link',
        'moto.validation',
        'ngStorage',
        'ipCookie'
    ])
    .config([
        '$compileProvider',
        '$httpProvider',
        '$localStorageProvider',
        function($compileProvider, $httpProvider, $localStorageProvider) {
            $compileProvider.debugInfoEnabled(false);
            $httpProvider.useApplyAsync(true);
            $localStorageProvider.setDeserializer(function(value) {
                try {
                    if (angular.isString(value) && value.length && (value[0] === '{' || value[0] === '[')) {
                        return angular.fromJson(value);
                    }

                    return value;
                } catch (e) {
                    return null;
                }
            });
            $localStorageProvider.setKeyPrefix('mf_');
        }
    ])
    .value('currentFrontendSession', {})
    .run([
        'jsonrpc',
        'website.MotoStorageService',
        'website.MotoPopupService',
        'currentFrontendSession',
        'MotoScrollbarWatcherService',
        function(jsonrpc, MotoStorageService, MotoPopupService, currentFrontendSession, MotoScrollbarWatcherService) {
            //@TODO: add website address
            if (window.websiteConfig && window.websiteConfig.apiUrl) {
                jsonrpc.setBasePath(websiteConfig.apiUrl);
            } else {
                jsonrpc.setBasePath('/api.php');
            }

            if (!MotoStorageService.getCookie('session-started')) {
                MotoStorageService.setCookie('session-started', Date.now());
                currentFrontendSession.isNew = true;
            }
            MotoPopupService.init();
            MotoScrollbarWatcherService.addWatcher(function() {
                // we must use original events here (not synthetic)
                var resizeEvent = window.document.createEvent('UIEvents');

                resizeEvent.initUIEvent('resize', true, false, window, 0);
                window.dispatchEvent(resizeEvent);
            }, angular.element('html')[0]);
        }
    ]);

// frontend widgets logic
angular.module('website.widgets', [
    'website.widgets.templates',
    'website.widget.contact_form',
    'website.widget.mail_chimp',
    'website.widget.auth_form',
    'website.widget.slider',
    'website.widget.grid_gallery',
    'website.widget.carousel',
    'website.widget.disqus',
    'website.widget.facebook_page_plugin',
    'website.widget.twitter',
    'website.widget.pinterest',
    'website.widget.menu',
    'website.widget.audio_player',
    'website.widget.video_player',
    'website.widget.social_buttons',
    'website.widget.countdown',
    'website.widget.accordion',
    'website.widget.tabs',
    'website.widget.actions',
    'website.widget.instagram.post',
    'website.widget.google_map_pro',
    'website.widget.google_recaptcha',
    'website.widget.integrations',
    'website.widget.MotoCallback',
    'website.widget.content_slider',
    'website.widget.google_search',
    'website.widget.tile_gallery'
]);
try {
    angular.module('website.plugins');
} catch (e) {
    angular.module('website.plugins', []);
}
try {
    angular.module('website.widgets.templates');
} catch (e) {
    angular.module('website.widgets.templates', []);
}
angular.module('website.core', [
    'website.core.settings',
    'website.core.dependency',
    'website.core.analytics.google',
    'website.core.form',
    'website.core.humanize_duration'
]);

// init website settings
angular.module('website.core').config([
    'motoWebsiteSettingsServiceProvider',
    'MotoWebsiteAnalyticsProvider',
    function(WebsiteSettingsServiceProvider, MotoWebsiteAnalyticsProvider) {
        if (window.websiteConfig && angular.isObject(window.websiteConfig)) {
            WebsiteSettingsServiceProvider.set(window.websiteConfig);
        }
        MotoWebsiteAnalyticsProvider.registerTrackingService('MotoGoogleAnalyticsService');
    }
]);

// if not preview mode init WOW and stellar
if (!$('body').hasClass('moto-preview')) {
    $(document).ready(function() {
        // hopefully temporary solution for disabling parallax on mobile devices and tablets
        function isWindowSizeOkForParallax() {
            return (window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth) >= 1040;
        }

        function initParallax() {
            $(window).stellar({
                horizontalScrolling: false,
                verticalScrolling: true,
                responsive: true
            });
        }

        function reInitParallax() {
            if (!isWindowSizeOkForParallax()) {
                $(window).stellar('destroy');
                $('.moto-parallax').css('background-position', '');

                return;
            }

            // Disable reinit in IE and Edge because of performance issues (we should fix the library)
            if (window.navigator.userAgent.indexOf('Trident/') === -1 && window.navigator.userAgent.indexOf('Edge/') === -1) {
                // call destroy only if user browser is not Edge or Internet Explorer
                $(window).stellar('destroy');
            }

            initParallax();
        }

        if (isWindowSizeOkForParallax()) {
            initParallax();
        }

        // hopefully temporary solution for fix parallax issue with image lazyloading
        $(document).on('lazybeforeunveil', '.lazyload', function(e) {
            $(e.target).one('load', reInitParallax);
        });

        $(window).on('resize', reInitParallax);

        // enable lazysizes preload after load functionality if lazy loading was disabled
        if (window.websiteConfig && window.websiteConfig.lazy_loading && !window.websiteConfig.lazy_loading.enabled) {
            window.lazySizesConfig.preloadAfterLoad = true;
        }
    });
}