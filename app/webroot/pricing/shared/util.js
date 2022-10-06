var CB = {
    tplWidth: 800,
    bottomMargin: 20,
    $: function(id) {
        return document.getElementById(id);
    },
    createEl: function(tag, id) {
        var el = document.createElement(tag);
        if (id != null) el.id = id;
        return el;
    },
    geom: function(el, left, top, width, height) {
        var s = el.style;
        s.position = 'absolute';
        s.left = left + 'px';
        s.top = top + 'px';
        if (!width) return;
        s.width = width + 'px';
        s.height = height + 'px';
    },
    isIE: function() {
        return navigator.userAgent.indexOf('MSIE') != -1;
    },
    ieVersion: function() {
        var a = /MSIE ([0-9]+)/.exec(navigator.userAgent);
        if (!a) return -1;
        return parseFloat(a[1]);
    },
    noHTML5: function() {
        return (typeof Object.defineProperty != 'function') || (CB.isIE() && CB.ieVersion() < 9);
    },

    banner: null,
    bannerSrc: null,
    bannerLink: null,

    doBannerTid: 0,
    doBanner: function(src, link) {
        if (src) CB.bannerSrc = src;
        if (link) CB.bannerLink = link;
        clearTimeout(CB.doBannerTid);
        CB.doBannerTid = setTimeout(CB._doBanner, 2000);
    },
    _doBanner: function() {
        var src = CB.bannerSrc;
        if (!src) return;
        if (!CB.banner)
            CB.banner = document.createElement('iframe');
        CB.banner.frameBorder = '0';
        CB.banner.scrolling = 'no';
        CB.geomBanner();

        CB.$('flashOuter').appendChild(CB.banner);
        CB.banner.src = src;
        $(CB.banner).css('opacity', 0).animate({
            opacity: 1
        }, 'slow');
    },
    cancelBanner: function() {
        clearTimeout(CB.doBannerTid);
        if (CB.banner) CB.$('flashOuter').removeChild(CB.banner);
    },

    geomBanner: function() {
        if (!CB.banner) return;
        CB.geom(CB.banner, (f_clientWidth() - CB.tplWidth) / 2 + CB.tplWidth, 5, 160, 600);
    },

    showMobile: function() {
        /*var el = CB.createEl('iframe', 'mobile');
        el.style.height = '100%';
        el.style.marginLeft = 'auto';
        el.style.marginRight = 'auto';
        el.style.width = '340px';
        el.src = './xhtml';
        el.frameBorder = '0';
        document.body.appendChild(el);*/
        document.body.innerHTML =
            '<iframe style="height:100%; width:340px; float:left" frameborder="0" src="./xhtml"></iframe>' +
            '<div style="margin:10px; float:left;"><a class="icn-close" href="javascript:document.location.reload()"></a></div>';
        document.body.style.background = '#EBE6E8';
    },
    siteSettings: {
        detection: {
            desktop: 'flash',
            desktopNoFlash: 'html5',
            tablet: 'html5',
            smartphone: 'html5'
        }
    },

    showFlash: function() {

        CB.flashStarted = true;

        if (self.CB5 && CB5.config.tplWidth)
            CB.tplWidth = parseInt(CB5.config.tplWidth);

        $('video').each(function() {
            try {
                this.pause();
            } catch (e) {}
            try {
                this.stop();
            } catch (e) {}
        });


        var flashvars = new Object;
        flashvars.startClass = "ro.cabanova.template.TemplatePublish";
        flashvars.lib = "shared/publish_lib,shared/commonSkins,shared/buttons,shared/videoLib";
        flashvars.tplTop = "50";
        flashvars.preloader = "shared/preloader.swf";
        flashvars.startPage = CB5.config.pid;
        flashvars.buildID = CB5.config.bid;
        flashvars.alignMode = "T";

        var params = new Object;
        params.allowFullScreen = "true";
        params.bgcolor = "FFFFFF";
        params.wmode = 'opaque';

        var attribs = new Object;
        attribs.id = 'index';

        if (!CB.$('flashOuter')) {
            jQuery('#index').wrap('<div id="flashOuter" style="position:relative; height:100%"></div>');
            jQuery('#index').empty();
        }

        var h = $('html').height();
        swfobject.embedSWF("shared/starter.swf", "index", "100%", h, "9.0.0", "expressInstall.swf", flashvars, params, attribs);
        $('#site-loading').remove();
    },
    getDevice: function() {
        var ua = navigator.userAgent;
        if (/iPad|Android 3|PlayBook/.test(ua) || (/Android/.test(ua) && !/mobile/i.test(ua)))
            return 'tablet';
        else if (/iPod|iPhone|Android|SymbianOS|BlackBerry|NetFront|Jasmine|Dolfin/i.test(ua))
            return 'smartphone';
        else if (swfobject.hasFlashPlayerVersion('9.0.0'))
            return 'desktop';
        else
            return 'desktopNoFlash';
    },
    detectRedirect: function() {
        if (/(&|\?)html5=1/.test(self.location.search)) {
            if (CB.noHTML5()) CB.askForFlash();
            else CB5.renderPage();
            return;
        }
        if (/(&|\?)flash=1/.test(self.location.search)) {
            CB.showFlash();
            return;
        }

        var device = CB.getDevice();


        var version = CB.siteSettings.detection[device];

        if (version == 'flash') {
            if (window.location.hostname.match(/[üöäßșțăâî]/)) {
                //flash player triggers a false security error if hostname is utf-8
                self.location = 'http://sitebuilder.cabanova.com/action/fallback?d=' + self.location.host;
                return;
            }
            CB.showFlash();
        } else if (version == 'html5') {
            if (CB.noHTML5()) {
                if (device == 'desktop') CB.showFlash(); //fallback to flash when available
                else CB.askForFlash();
            } else CB5.renderPage();
        } else { //xhtml
            var a = document.location.pathname.split('/'),
                file = a.pop();
            a.push(version, file);
            document.location.replace(a.join('/'));
        }
    },
    askForFlash: function() {
        if (typeof noFlashMsg == 'undefined') noFlashMsg = 'You need Flash Player to see this website.<br>You can also see an HTML5 version of this site using a modern web browser.';
        noFlashMsg = noFlashMsg.replace('Flash Player', '<a target="_blank" href="http://get.adobe.com/flashplayer">Flash Player</a>');
        $('<div class="askFlash">' + noFlashMsg + '</div>').appendTo('#site-loading');
    }
};

//in IE<9 hide HTML5
if (CB.noHTML5())
    jQuery('<style>#page {display: none}</style>').appendTo($('head'));

//Detect mobile device, switch to HTML5
var s = 'script';
document.write('<' + s + ' type="text/java' + s + '" src="site-settings.js?t=' + (new Date().getTime()) + '"></' + s + '>');

function detectRedirect() {}


function resizeSWF(height) {
    CB.$('flashOuter').style.height = '';
    if (resizeSWF.lastH != null && height != resizeSWF.lastH) {
        getApp().style.height = (Math.max(height + CB.bottomMargin, f_clientHeight())) + 'px';
        //scrollToTop();
    }
}

resizeSWF.lastH = -1;

function startNewPage() {
    scrollToTop();
    HtmlContent.clear();
}

function scrollToTop() {
    if (window.scrollTo) window.scrollTo(0, 0);
    if (document.body) document.body.scrollTop = 0;
    else document.documentElement.scrollTop = 0;
}

function getApp(id) {
    if (typeof id == 'undefined')
        id = 'index';

    var isIE = navigator.appName.indexOf("Microsoft") != -1;
    return (isIE) ? window[id] : document[id];
}

function secureDownload(actionUrl, name, id) {
    var data = {
        fileName: name,
        pageID: CB5.config.pid,
        userID: id,
        plain: CB5.submittedPassword ? 1 : 0,
        password: CB5.submittedPassword ? CB5.submittedPassword : 'public'
    };
    if (top.CryptoJS && CryptoJS.MD5) {
        data.password = String(CryptoJS.MD5(data.password));
        data.password = data.password.split('').reverse().join('');
        data.plain = 0;
    }
    SecureDownload.post(actionUrl, data);
}

window.onresize = function() {
    if (!getApp()) return;

    getApp().setScreenHeight(f_clientHeight());
    if (parseFloat(getApp().style.height) < f_clientHeight())
        getApp().style.height = f_clientHeight() + "px";
    fixBackground();
    CB.geomBanner();
    HtmlContent.fixPos();
};


var _gaq = _gaq || [];
var GA = {
    freeID: /*gaid for free websites*/ 'UA-237597-18',
    paidID: /*gaid for paid websites*/ 'UA-237597-23',
    userID: null,
    typeLoaded: false,
    isPaid: false,
    start: function() {
        //_gaq.push(['cab._setAccount', GA.id]);
        _gaq.push(['cab._setDomainName', 'none']);
        //_gaq.push(['cab._trackPageview']);

        var ga = document.createElement('script');
        ga.type = 'text/javascript';
        ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/u/ga.js';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(ga, s);
    },
    trackPage: function(page) {
        CB.doBanner();

        if (top.location.protocol == 'https:') return;

        if (!CB5) GA.typeLoaded = true;
        if (!GA.typeLoaded) {
            var url = CB5.config.rootUrl + 'action/banner/?is-paid=1&uid=' + CB5.config.uid;
            CB5.getJson(url, function(data) {
                GA.typeLoaded = true;
                GA.isPaid = data.isPaid;
                GA.trackPage(page);
            });
            return;
        }

        //don't track draft
        if (document.location.pathname.indexOf('/draft/') == 0) return;
        _gaq.push(['cab._setAccount', GA.isPaid ? GA.paidID : GA.freeID]);

        if (page) {
            pageURL = '/' + page + '.html';
            var a = document.location.host.split('.');
            a.reverse();
            a.push(page + '.html');
            docPath = a.join('/');
        } else {
            //currently used in HTML5 version
            docPath = pageURL = document.URL;
        }

        _gaq.push(['cab._anonymizeIp']);
        _gaq.push(['cab._trackPageview', pageURL]);
        if (GA.userID) {
            //_gaq.push(['usr._setDomainName', (GA.userID == 'UA-237597-12') ? '.cabanova.com' : 'none']);
            //_gaq.push(['usr._setAllowHash', false]);
            _gaq.push(['usr._setDomainName', (GA.userID == 'UA-237597-12') ? 'cabanova.com' : 'none']);
            _gaq.push(['usr._anonymizeIp']);
            _gaq.push(['usr._trackPageview', docPath]);
        }
        //_gaq.push(['cab._trackEvent', 'navigate', 'default', page]);
    },
    setUser: function(id) {
        if (id) {
            GA.userID = id;
            _gaq.push(['usr._setAccount', GA.userID]);
            //_gaq.push(['usr._setDomainName', (id == 'UA-237597-12') ? '.cabanova.com' : 'none']);
        }
    },

    trackEvent: function(category, action, label) {
        _gaq.push(['cab._trackEvent', category, action, label]);
    }
};

window.onload = function() {
    fixBackground();
    GA.start();
};


function fixBackground() {
    /*if (!getApp()) return;
    var el = CB.$('index');
    if (!el) return;
    var pos=cumulativeOffset(el);
    var ox = pos[0] - 200;
    var oy = pos[1] - 200;
    document.body.style.backgroundPosition = ox+'px '+oy+'px';*/
}


function f_clientHeight() {
    return f_filterResults(
        window.innerHeight ? window.innerHeight : 0,
        document.documentElement ? document.documentElement.clientHeight : 0,
        document.body ? document.body.clientHeight : 0
    );
}

function f_clientWidth() {
    return f_filterResults(
        window.innerWidth ? window.innerWidth : 0,
        document.documentElement ? document.documentElement.clientWidth : 0,
        document.body ? document.body.clientWidth : 0
    );
}

function f_scrollTop() {
    return f_filterResults(
        window.pageYOffset ? window.pageYOffset : 0,
        document.documentElement ? document.documentElement.scrollTop : 0,
        document.body ? document.body.scrollTop : 0
    );
}

function f_filterResults(n_win, n_docel, n_body) {
    var n_result = n_win ? n_win : 0;
    if (n_docel && (!n_result || (n_result > n_docel)))
        n_result = n_docel;
    return n_body && (!n_result || (n_result > n_body)) ? n_body : n_result;
}

function getBrowserInfo() {
    var o = cumulativeOffset(CB.$('flashOuter'));
    return {
        clientHeight: f_clientHeight(),
        scrollBarPos: Math.max(f_scrollTop() - o[1], 0)
    };
}

function getLocation() {
    return window.location.href;
}

function setLocation(value) {
    window.location.href = value;
}

function cumulativeOffset(element) {
    var valueT = 0,
        valueL = 0;
    do {
        valueT += element.offsetTop || 0;
        valueL += element.offsetLeft || 0;
        element = element.offsetParent;
    } while (element);
    return [valueL, valueT];
}

var HtmlContent = {
    data: {},
    holder: null,
    fbApid: '126226044067291',

    loadScript: function(url) {
        var po = document.createElement("script");
        po.type = "text/javascript";
        po.async = true;
        po.src = url;
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(po, s);
    },

    create: function(id, left, top, w, h, content) {

        var url = encodeURIComponent(document.location);
        content = content.replace('{$URL}', url).replace('{$fbapid}', HtmlContent.fbApid);
        var isGplus = content.indexOf('<div class="g-plus"') == 0;
        var isBanner = content.indexOf('<img class="banner"') == 0;
        if (isBanner) {
            CB.cancelBanner();
            content = '<a href="' + CB.bannerLink + '">' + content + '</a>';
            //count banner display
            HtmlContent.bimg = new Image;
            var code = CB.bannerLink.substring(CB.bannerLink.lastIndexOf('/') + 1, CB.bannerLink.indexOf('?'));
            HtmlContent.bimg.src = CB5.config.rootUrl + 'action/banner?count=1&code=' + code;
        }
        var iframe = !/^\s*<iframe.*iframe>\s*$/.test(content) && !(isGplus || isBanner);
        if (isGplus) {
            HtmlContent.loadScript('http://apis.google.com/js/plusone.js');
            window.___gcfg = {
                lang: 'en'
            };
        }

        var el = CB.createEl(iframe ? 'iframe' : 'div', id);
        el.frameBorder = '0';
        el.allowTransparency = '1';

        CB.geom(el, HtmlContent.getLeft() + left, top, w, h);
        CB.$('flashOuter').appendChild(el);


        if (iframe) {
            content = content.replace(/<form\s+/i, '<form target="_top" ');
            el.setAttribute('target', '_top');
            var d = el.contentWindow.document;
            d.open();
            d.write('<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">' +
                '<html><head></head><body style="margin:0">' + content + '</body></html>');
            setTimeout('document.getElementById("' + id + '").contentWindow.document.close()', 2000);
        } else
            el.innerHTML = content;

        if (isGplus && self.gapi)
            gapi.plus.go();

        HtmlContent.data[id] = {
            el: el,
            left: left,
            top: top,
            w: w,
            h: h
        };
    },

    clear: function() {
        var a = [];
        for (var id in HtmlContent.data) {
            a.push(HtmlContent.data[id].el);
        }
        // delay removal to prevent flash player crash if html widget has swfs
        setTimeout(function() {
            HtmlContent.clearDelayed(a);
        }, 100);
        //CB.$('index').parentNode.removeChild(HtmlContent.data[id].el);
        HtmlContent.data = {};
    },

    clearDelayed: function(arr) {
        for (var i = 0; i < arr.length; i++)
            CB.$('index').parentNode.removeChild(arr[i]);
    },

    hideAll: function(value) {
        for (var id in HtmlContent.data)
            HtmlContent.data[id].el.style.display = value ? 'none' : 'block';
    },

    fixPos: function() {
        for (var id in HtmlContent.data) {
            var model = HtmlContent.data[id];
            CB.geom(model.el, HtmlContent.getLeft() + model.left, model.top, model.w, model.h);
        }
    },

    resizeAndRepos: function(id, left, top, w, h) {
        var model = HtmlContent.data[id];
        model.left = left;
        model.top = top;
        model.w = w;
        model.h = h;
        CB.geom(model.el, HtmlContent.getLeft() + left, top, w, h);
    },

    getLeft: function() {
        return Math.max((f_clientWidth() - CB.tplWidth) / 2, 30);
    }
};

var SecureDownload = {

    post: function(actionUrl, data) {
        var frm = document.createElement('form');
        frm.setAttribute('method', 'post');
        frm.setAttribute('action', decodeURIComponent(actionUrl));
        frm.setAttribute('style', 'padding:0; margin:0;');
        //frm.setAttribute('target', '_blank');
        document.body.appendChild(frm);

        for (var key in data) {
            var inp = document.createElement('input');
            inp.setAttribute('type', 'hidden');
            inp.setAttribute('name', key);
            inp.setAttribute('value', data[key]);
            frm.appendChild(inp);
        }

        frm.submit();
        document.body.removeChild(frm);
    }
};

//window.setInterval('getBrowserInfo()', 500);

function toggleFullScreen() {
    var d = document,
        de = d.documentElement;
    if (!d.fullscreenElement && // alternative standard method
        !d.mozFullScreenElement && !d.webkitFullscreenElement) { // current working methods
        if (de.requestFullscreen) {
            de.requestFullscreen();
        } else if (de.mozRequestFullScreen) {
            de.mozRequestFullScreen();
        } else if (de.webkitRequestFullscreen) {
            de.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
        }
    } else {
        if (d.cancelFullScreen) {
            d.cancelFullScreen();
        } else if (d.mozCancelFullScreen) {
            d.mozCancelFullScreen();
        } else if (d.webkitCancelFullScreen) {
            d.webkitCancelFullScreen();
        }
    }
}

function getDynamicStructure() {
    return CB5.dynamicStructure;
}