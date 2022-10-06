/* Source: src/mt-includes/js/src/moto_storage/MotoStorageService.js*/
angular.module('website').service('website.MotoStorageService', [
    '$localStorage',
    'ipCookie',
    function($localStorage, ipCookie) {
        var prefix = window.websiteConfig.addressHash + '_';

        function getLocalStorageItem(key, defaultValue) {
            defaultValue = defaultValue || false;

            return $localStorage[prefix + key] || defaultValue;
        }

        function setLocalStorageItem(key, value) {
            return $localStorage[prefix + key] = value;
        }

        function removeLocalStorageItem(key) {
            delete $localStorage[prefix + key];
        }

        function getCookie(name) {
            return ipCookie(prefix + name);
        }

        function setCookie(name, value, params) {
            return ipCookie(prefix + name, value, params);
        }

        function removeCookie(name) {
            return ipCookie.remove(prefix + name);
        }

        this.getLocalStorageItem = getLocalStorageItem;
        this.setLocalStorageItem = setLocalStorageItem;
        this.removeLocalStorageItem = removeLocalStorageItem;

        this.getCookie = getCookie;
        this.setCookie = setCookie;
        this.removeCookie = removeCookie;
    }
]);