/* ------------------------------------------------
  Project:   Loptus - Digital Marketing Agency Responsive HTML5 Template
  Author:    ThemeHt
------------------------------------------------ */
/* ------------------------
    Table of Contents

  1. Predefined Variables
  2. Preloader  
  3. FullScreen
  4. Slit Slider
  5. Counter
  3. Owl carousel
  7. Audioplayer
  9. Magnific Popup
  10. Isotope
  11. Scroll to top
  12. Banner Section
  13. Fixed Header
  14. Side Menu
  15. Text Color, Background Color And Image
  16. Accordian
  17. Contact Form
  18. Masonry
  19. Countdown
  20. Mouse Parallax
  21. insideText
  22. Wow Animation
  23. HT Window load and functions
  

------------------------ */

"use strict";

/*------------------------------------
  HT Predefined Variables
--------------------------------------*/
var $window = $(window),
    $document = $(document),
    $body = $('body'),
    $counter = $('.counter'),
    $fullScreen = $('.fullscreen-banner') || $('.section-fullscreen'),
    $halfScreen = $('.halfscreen-banner'),
    searchActive = false;

//Check if function exists
$.fn.exists = function() {
    return this.length > 0;
};


/*------------------------------------
  HT PreLoader
--------------------------------------*/
function preloader() {
    $("#load").fadeOut();
    $('#ht-preloader').delay(0).fadeOut('slow');
};


/*------------------------------------
  HT FullScreen
--------------------------------------*/
function fullScreen() {
    if ($fullScreen.exists()) {
        $fullScreen.each(function() {
            var $elem = $(this),
                elemHeight = $window.height();
            if ($window.width() < 768) $elem.css('height', elemHeight / 1);
            else $elem.css('height', elemHeight);
        });
    }
    if ($halfScreen.exists()) {
        $halfScreen.each(function() {
            var $elem = $(this),
                elemHeight = $window.height();
            $elem.css('height', elemHeight / 2);
        });
    }
};


/*------------------------------------
  HT Counter
--------------------------------------*/
function counter() {
    if ($counter.exists()) {
        $counter.each(function() {
            var $elem = $(this);
            $elem.appear(function() {
                $elem.find('.count-number').countTo();
            });
        });
    }
};


/*------------------------------------
  HT Owl Carousel
--------------------------------------*/
function owlcarousel() {
    $('.owl-carousel').each(function() {
        var $carousel = $(this);
        $carousel.owlCarousel({
            items: $carousel.data("items"),
            slideBy: $carousel.data("slideby"),
            center: $carousel.data("center"),
            loop: true,
            margin: $carousel.data("margin"),
            dots: $carousel.data("dots"),
            nav: $carousel.data("nav"),
            autoplay: $carousel.data("autoplay"),
            autoplayTimeout: $carousel.data("autoplay-timeout"),
            navText: ['<span class="fas fa-long-arrow-alt-left"><span>', '<span class="fas fa-long-arrow-alt-right"></span>'],
            responsive: {
                0: {
                    items: $carousel.data('xs-items') ? $carousel.data('xs-items') : 1
                },
                576: {
                    items: $carousel.data('sm-items')
                },
                768: {
                    items: $carousel.data('md-items')
                },
                1024: {
                    items: $carousel.data('lg-items')
                },
                1200: {
                    items: $carousel.data("items")
                }
            },
        });
    });
};


/*------------------------------------
  HT Audio Player
--------------------------------------*/
function lightgallery() {
    $('audio').audioPlayer();
};


/*------------------------------------
  HT Magnific Popup
--------------------------------------*/
function magnificpopup() {
    $('.popup-gallery').magnificPopup({
        delegate: 'a.popup-img',
        type: 'image',
        tLoading: 'Loading image #%curr%...',
        mainClass: 'mfp-img-mobile',
        gallery: {
            enabled: true,
            navigateByImgClick: true,
            preload: [0, 1] // Will preload 0 - before current, and 1 after the current image
        },
        image: {
            tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
            titleSrc: function(item) {
                return item.el.attr('title') + '<small>by Marsel Van Oosten</small>';
            }
        }
    });
    if ($(".popup-youtube, .popup-vimeo, .popup-gmaps").exists()) {
        $('.popup-youtube, .popup-vimeo, .popup-gmaps').magnificPopup({
            disableOn: 700,
            type: 'iframe',
            mainClass: 'mfp-fade',
            removalDelay: 160,
            preloader: false,
            fixedContentPos: false
        });
    }

};


/*------------------------------------
  HT Isotope
--------------------------------------*/
function isotope() {
    // init Isotope
    var $grid = $('.grid').isotope({
        itemSelector: '.grid-item',
        layoutMode: 'fitRows',
    });

    // filter functions
    var filterFns = {
        // show if number is greater than 50
        numberGreaterThan50: function() {
            var number = $(this).find('.number').text();
            return parseInt(number, 10) > 50;
        },
        // show if name ends with -ium
        ium: function() {
            var name = $(this).find('.name').text();
            return name.match(/ium$/);
        }
    };

    // bind filter button click
    $('.portfolio-filter').on('click', 'button', function() {
        var filterValue = $(this).attr('data-filter');
        // use filterFn if matches value
        filterValue = filterFns[filterValue] || filterValue;
        $grid.isotope({
            filter: filterValue
        });
    });


    // change is-checked class on buttons
    $('.portfolio-filter').each(function(i, buttonGroup) {
        var $buttonGroup = $(buttonGroup);
        $buttonGroup.on('click', 'button', function() {
            $buttonGroup.find('.is-checked').removeClass('is-checked');
            $(this).addClass('is-checked');
        });
    });
};


/*------------------------------------
  HT Scroll to top
--------------------------------------*/
function scrolltop() {
    var pxShow = 300,
        goTopButton = $(".scroll-top")
    // Show or hide the button
    if ($(window).scrollTop() >= pxShow) goTopButton.addClass('scroll-visible');
    $(window).on('scroll', function() {
        if ($(window).scrollTop() >= pxShow) {
            if (!goTopButton.hasClass('scroll-visible')) goTopButton.addClass('scroll-visible')
        } else {
            goTopButton.removeClass('scroll-visible')
        }
    });
    $('.smoothscroll').on('click', function(e) {
        $('body,html').animate({
            scrollTop: 0
        }, 1000);
        return false;
    });
};



/*------------------------------------
  HT Banner Section
--------------------------------------*/
function headerheight() {
    $('.fullscreen-banner .align-center, .nav-arrows span').each(function() {
        var headerHeight = $('.header').height();
        // headerHeight+=15; // maybe add an offset too?
        $(this).css('padding-top', headerHeight + 'px');
    });
};


/*------------------------------------
  HT Fixed Header
--------------------------------------*/
function fxheader() {
    $(window).on('scroll', function() {
        if ($(window).scrollTop() >= 100) {
            $('#header-wrap').addClass('fixed-header');
        } else {
            $('#header-wrap').removeClass('fixed-header');
        }
    });
};

/*------------------------------------
  HT Side Menu
--------------------------------------*/
function sidenav() {
    $('.ht-nav-toggle').on('click', function(event) {
        event.preventDefault();
        var $this = $(this);
        if ($('body').hasClass('menu-show')) {
            $('body').removeClass('menu-show');
            $('#ht-main-nav > .ht-nav-toggle').removeClass('show');
        } else {
            $('body').addClass('menu-show');
            setTimeout(function() {
                $('#ht-main-nav > .ht-nav-toggle').addClass('show');
            }, 900);
        }
    })
};

/*------------------------------------------
  HT Text Color, Background Color And Image
---------------------------------------------*/
function databgcolor() {
    $('[data-bg-color]').each(function(index, el) {
        $(el).css('background-color', $(el).data('bg-color'));
    });
    $('[data-text-color]').each(function(index, el) {
        $(el).css('color', $(el).data('text-color'));
    });
    $('[data-bg-img]').each(function() {
        $(this).css('background-image', 'url(' + $(this).data("bg-img") + ')');
    });
};


/*------------------------------------
  HT Accordian
--------------------------------------*/
function accordian() {
    $(".card").on("show.bs.collapse hide.bs.collapse", function(e) {
        if (e.type == 'show') {
            $(this).addClass('active');
        } else {
            $(this).removeClass('active');
        }
    });
    $('.accordion .card-header a').prepend('<span></span>');
};


/*------------------------------------
  HT Contact Form
--------------------------------------*/
function contactform() {
    $('#contact-form').validator();

    // when the form is submitted
    $('#contact-form').on('submit', function(e) {

        // if the validator does not prevent form submit
        if (!e.isDefaultPrevented()) {
            var url = "php/contact.php";

            // POST values in the background the the script URL
            $.ajax({
                type: "POST",
                url: url,
                data: $(this).serialize(),
                success: function(data) {
                    // data = JSON object that contact.php returns

                    // we recieve the type of the message: success x danger and apply it to the 
                    var messageAlert = 'alert-' + data.type;
                    var messageText = data.message;

                    // let's compose Bootstrap alert box HTML
                    var alertBox = '<div class="alert ' + messageAlert + ' alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' + messageText + '</div>';

                    // If we have messageAlert and messageText
                    if (messageAlert && messageText) {
                        // inject the alert to .messages div in our form
                        $('#contact-form').find('.messages').html(alertBox);
                        // empty the form
                        $('#contact-form')[0].reset();
                    }
                }
            });
            return false;
        }
    })
};


/*------------------------------------
  HT Masonry
--------------------------------------*/
function masonry() {
    var $masonry = $('.masonry'),
        $itemElement = '.masonry-brick',
        $filters = $('.portfolio-filter');
    if ($masonry.exists()) {
        $masonry.isotope({
            resizable: true,
            itemSelector: $itemElement,
        });

        // bind filter button click
        $filters.on('click', 'button', function() {
            var filterValue = $(this).attr('data-filter');
            $masonry.isotope({
                filter: filterValue
            });
        });
    }
};


/*------------------------------------
  HT Search
--------------------------------------*/
function search() {
    if ($('.search-form').length) {
        var searchForm = $('.search-form');
        var searchInput = $('.search-input');
        var searchButton = $('.search-button');

        searchButton.on('click', function(event) {
            event.stopPropagation();

            if (!searchActive) {
                searchForm.addClass('active');
                searchActive = true;
                searchInput.focus();

                $(document).one('click', function closeForm(e) {
                    if ($(e.target).hasClass('search-input')) {
                        $(document).one('click', closeForm);
                    } else {
                        searchForm.removeClass('active');
                        searchActive = false;
                    }
                });
            } else {
                searchForm.removeClass('active');
                searchActive = false;
            }
        });
    }
};


/*------------------------------------
  HT Countdown
--------------------------------------*/
function countdown() {
    $('.countdown').each(function() {
        var $this = $(this),
            finalDate = $(this).data('countdown');
        $this.countdown(finalDate, function(event) {
            $(this).html(event.strftime('<li><span>%-D</span><p>Days</p></li>' + '<li><span>%-H</span><p>Hours</p></li>' + '<li><span>%-M</span><p>Minutes</p></li>' + '<li><span>%S</span><p>Seconds</p></li>'));
        });
    });
};


/*------------------------------------
  HT Mouse Parallax
--------------------------------------*/
function mouse() {
    $(document).mousemove(function(e) {
        $('.mouse-parallax').parallax(-30, e);
    });
};


/*------------------------------------
  HT insideText
--------------------------------------*/
function insideText() {
    var e, i = $(window).height(),
        n = i / 2;
    $(document).scroll(function() {
        e = $(window).scrollTop(), $(".insideText").each(function() {
            var i = $(this),
                o = i.parent("section"),
                s = o.offset().top;
            i.css({
                top: -(s - e) + n + "px"
            })
        }), $(".bg-text").each(function() {
            var e = $(this),
                i = $(window).height() / 2,
                n = e.parent("div"),
                o = $(window).scrollTop(),
                s = n.offset().top;
            $(this).css({
                top: -(s - o) + i + "px"
            })
        })
    })
};

/*------------------------------------
  HT Wow Animation
--------------------------------------*/
function wowanimation() {
    var wow = new WOW({
        boxClass: 'wow',
        animateClass: 'animated',
        offset: 0,
        mobile: false,
        live: true
    });
    wow.init();
}


/*------------------------------------
  HT Window load and functions
--------------------------------------*/
$(document).ready(function() {
    owlcarousel(),
        fullScreen(),
        counter(),
        lightgallery(),
        magnificpopup(),
        scrolltop(),
        headerheight()
    fxheader(),
        sidenav(),
        databgcolor(),
        accordian(),
        contactform(),
        search(),
        countdown(),
        mouse(),
        insideText();
});


$window.resize(function() {
    fullScreen();
});


$(window).on('load', function() {
    preloader(),
        isotope(),
        masonry(),
        wowanimation();
});