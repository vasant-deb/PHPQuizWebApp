/* Source: src/mt-includes/widgets/menu/frontend.js*/
angular.module('website.widget.menu', [])
    .directive('motoWidgetMenu', function() {
        var $window = $(window);
        var menus = [];
        var previousCheckingWindowSize;

        function _isWindowBig() {
            return (window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth) >= 768;
        }

        previousCheckingWindowSize = _isWindowBig();

        /**
         * Reset menu to default state
         *
         * @BugFix : MOTOCMS-5286
         *
         * @param {Object} menu Wigdet menu helper
         * @param {jQuery} menu.$element Menu element
         * @param {jQuery} menu.$toggleButton Hamburger element of menu
         * @private
         */
        function _resetMenu(menu) {
            // reset sub menus status
            menu.$element.find('.moto-widget-menu-item-has-submenu_opened').removeClass('moto-widget-menu-item-has-submenu_opened');
            // reset display to 'unset', need because $().toggle() force style
            menu.$element.find('.moto-widget-menu-sublist').css('display', '');
            // reset hamburger button status
            // check this on template with only hamb
            menu.$element.removeClass('moto-widget-menu-mobile-open');
        }

        function _onResizeWindow() {
            var i;
            var len;
            var isWindowBig = _isWindowBig();

            if (previousCheckingWindowSize === isWindowBig) {
                // breakpoint not changed
                return;
            }

            previousCheckingWindowSize = isWindowBig;
            if (!isWindowBig) {
                return;
            }

            for (i = 0, len = menus.length; i < len; i++) {
                try {
                    _resetMenu(menus[i]);
                } catch (e) {

                }
            }
        }

        $window.on('resize', _onResizeWindow);

        return {
            restrict: 'C',
            priority: 450,
            link: function($scope, $element) {
                var toggleButton = $element.find('.moto-widget-menu-toggle-btn');
                var itemsWithSubmenus = $element.find('.moto-widget-menu-item-has-submenu');
                var submenus = itemsWithSubmenus.find('.moto-widget-menu-sublist');
                var submenuArrows = $element.find('.moto-widget-menu-link-arrow');

                menus.push({
                    $element: $element,
                    $toggleButton: toggleButton
                });

                // toggle menu button functionality for mobile version
                toggleButton.on('click', function(e) {
                    e.preventDefault();
                    $element.toggleClass('moto-widget-menu-mobile-open');
                    if ($element.hasClass('moto-widget-menu-mobile-open')) {
                        if (submenuArrows.is(':visible')) {
                            submenus.hide();
                        }
                    }
                });

                // handle submenu arrows click events for mobile version
                if (itemsWithSubmenus.length) {
                    submenuArrows.on('click', function(e) {
                        if (toggleButton.is(':hidden')) {
                            return;
                        }
                        e.preventDefault();
                        $(this).closest('.moto-widget-menu-item-has-submenu').toggleClass('moto-widget-menu-item-has-submenu_opened').find('> .moto-widget-menu-sublist').toggle();
                    });
                }
            }
        };
    });