var CB5;
if (typeof CB5 == 'undefined') CB5 = {};

(function() {

    //default texts for old sites
    $(function() {
        if (!CB5.config.texts) CB5.config.texts = {
            pwdtext: 'A password is required to view this page!',
            password: 'Password',
            cancel: 'Cancel'
        };

        try {
            //init localStorage
            if (typeof(sessionStorage) != 'undefined')
                CB5.session = sessionStorage;
            else
                CB5.session = {};

            if (CB5.session.password)
                CB5.submittedPassword = CB5.session.password;
        } catch (e) {
            CB5.session = {};
        }
    });

    //fix old links
    $(function() {
        if (!('structureMap' in CB5.config)) return;
        $('a').each(function() {
            var me = $(this);
            var id = me.attr('data-linkref');
            if (!id) return;
            if (!(id in CB5.config.structureMap)) return;
            var url = CB5.config.structureMap[id] + '.html';
            if (url == me.attr('href')) return;
            me.attr('href', url);
        });
    });

    //form check ping, multipart for file upload
    function initForm() {

        var frm = $('#cb-form');
        if (!frm.length)
            frm = $('form.cb-form');
        if (!frm.length) return;

        frm.each(function() {
            var frm = $(this);
            if (frm.data('cb-frm-inited')) return;
            frm.data('cb-frm-inited', true);

            //cuid is the real userID in dynamic pages
            var uid = CB5.config.cuid ? CB5.config.cuid : CB5.config.uid;
            CB5.getJson(frm[0].action + '?u=' + uid + '&cb_ping_js=' + $.now(), function(ret) {
                frm.append($('<input>').attr({
                    type: 'hidden',
                    name: '__cb-token__',
                    value: ret.token
                }));
                frm.append($('<input>').attr({
                    type: 'hidden',
                    name: '__uid__',
                    value: uid
                }));
                frm.append($('<input>').attr({
                    type: 'hidden',
                    name: '__pid__',
                    value: CB5.config.pid
                }));
                frm.append($('<input>').attr({
                    type: 'hidden',
                    name: '__attempts__',
                    value: ret.attempts
                }));
            });
            _initForm(frm);
        });
    }

    function _initForm(frm) {
        //debug('each');
        if (frm.find('input[type=file]').length)
            frm.attr('enctype', 'multipart/form-data');

        //validation
        frm.submit(function() {
            var err = false;

            function mark(el) {
                el.addClass('cb-formerror');
                el.focus(resetErr);
                el.change(resetErr);
                err = true;
            }
            //validate email
            frm.find('input[type=email]').each(function() {
                var el = $(this);
                if (CB5.emailReg.test(el.val())) return;
                mark(el);
            });
            //validate number
            frm.find('input[type=number]').each(function() {
                var el = $(this);
                if (/^[\d,\.]+$/.test(el.val())) return;
                mark(el);
            });
            //validate notempty
            frm.find('input[type=text][required],textarea[required]').each(function() {
                var el = $(this);
                if (el.val() != '') return;
                mark(el);
            });

            frm.find('input[type=radio]').each(function() {
                var el = $(this);
                if (frm.find('input[type=radio][name="' + el.attr('name') + '"]:checked').length > 0) return;
                mark(el);
            });

            frm.find('input[type=checkbox][required]').each(function() {
                var el = $(this);
                if (el.is(':checked')) return;
                mark(el);
            });

            if (frm.find('input[type=hidden][name=__poll__]').length > 0) {
                var attempts = parseInt(frm.find('input[type=hidden][name=__attempts__]').eq(0).val());
                var maxAttemtps = parseInt(frm.find('input[type=hidden][name=__poll__]').eq(0).val());
                if (attempts >= maxAttemtps) {
                    err = true;
                    alert("You have already submitted this form for the maximum number of times. No more");
                }
            }

            return !err;
        });

        function resetErr() {
            $(this).removeClass('cb-formerror');
            $('.cb-form input[type=radio][name="' + $(this).attr('name') + '"]').removeClass('cb-formerror');
        }
    }

    $(initForm);

    //download links
    function doLinks() {
        var key = 'files/secure-downloads/';
        $('a[href]').each(function() {
            var href = $(this).attr('href');
            if ((href.indexOf('files/downloads/') == 0 || href.indexOf(key) == 0) && $(this).attr('target') == '_self') {
                if (href.indexOf('files/downloads/') == 0)
                    $(this).attr('download', href.substr(16));
                else
                    $(this).attr('download', href.substr(key.length));
            }

        })
    }

    //firefox proof javascript action links
    function doLinksFF() {
        var key = 'javascript:setPageState';
        $('a[href]').each(function() {
            var href = $(this).attr('href');
            if (href.indexOf(key) == 0) {
                $(this).attr('href', 'javascript:void(0)').attr('onClick', decodeURI(href.substr("javascript:".length)));
            }
        });
    }

    CB5.fonts = {};
    CB5.cbFonts = {};
    var getRealPath = CB5.getRealPath;

    CB5.addFont = function(name, skipExt, isCb) {
        if (!name || name == '&quot' || name.toLowerCase() == 'arial') return
        if (isCb) CB5.cbFonts[name] = true;
        name += ((skipExt || isCb || name.slice(0, 6) === 'cbusr-') ? '' : '::latin,latin-ext');
        CB5.fonts[name] = true;
    };

    CB5.submittedPassword = false;

    var elements = [];
    var render = CB5.render;
    CB5.addElement = function(params) {
        elements.push(params);
    };

    CB5.ipadFix = function() {
        //ugly fix for dissapearing menu on iPad - force re-render
        if (CB5.isIOS) {
            $('#page .cbel').css({
                opacity: .9999
            });
            setTimeout(function() {
                $('#page .cbel').css({
                    opacity: ''
                });
            }, 1);
        }
    };

    if (typeof Object.defineProperty != 'function') return;
    if (typeof Element == 'undefined') return;

    if (!document.createElement('span').dataset) {
        Object.defineProperty(Element.prototype, 'dataset', {
            get: function() {
                if (this.__dataset) return this.__dataset;
                var set = this.__dataset = {};
                for (var attr in this.attributes) {
                    if (this.attributes.hasOwnProperty(attr) && this.attributes[attr].name && /^data-[a-z_\-\d]*$/i.test(this.attributes[attr].name)) {
                        var name = this.attributes[attr].name.substr(5);
                        name = name.replace(/\-[a-z]/g, function(a, b, c) {
                            return a.substr(1).toUpperCase();
                        });
                        set[name] = this.attributes[attr].value;
                    }
                }
                return set;
            }
        });
    }


    function mkDiv() {
        return $('<div/>');
    }

    function mkLoading() {
        return $('<img src="' + getRealPath('shared://loading.gif') + '"/>');
    }

    function mkImage(src) {
        var img = new Image;
        img.src = src;
        return $(img);
    }

    function mkA(label) {
        return $('<a href="javascript:void(0)"></a>').text(label);
    }

    function gradient(el, c1, c2) {
        el.css({
            backgroundImage: '-webkit-gradient(linear, left top, left bottom, from(' + c1 + '), to(' + c2 + '))'
        }); //chrome 10+
        el.css({
            backgroundImage: '-webkit-linear-gradient(top, ' + c1 + ', ' + c2 + ')'
        }); //android
        el.css({
            backgroundImage: '-moz-linear-gradient(top, ' + c1 + ', ' + c2 + ')'
        });
    }

    //-----------------------------------------------------
    // JSONP
    //-----------------------------------------------------
    function getJson(path, callback) {
        $.ajax(getRealPath(path), {
            jsonp: 'cbjp',
            crossDomain: true,
            dataType: 'jsonp',
            success: callback
        });
    }
    CB5.getJson = getJson;


    function loadMulti(data, callback, prefix, dest) {
        var cnt = data.length;
        for (var i = 0; i < data.length; i++) {
            (function(i) {
                var img = new Image;
                data[i][dest] = img;
                img.onload = function() {
                    cnt--;
                    if (cnt == 0) callback();
                };
                img.src = getRealPath(prefix + encodeURIComponent(data[i].relSrc || data[i].src));
            })(i);
        }
    }
    CB5.loadMulti = loadMulti;

    CB5.borderBox = function(css) {
        $.extend(css, {
            WebkitBoxSizing: 'border-box',
            boxSizing: 'border-box',
            MozBoxSizing: 'border-box'
        });
        return css;
    };

    var bannerDone = false;

    function doBanner() {
        if (bannerDone) return;
        bannerDone = true;

        var bnr = $('.cbel.cb-banner');
        var url = CB5.config.rootUrl + 'action/banner/?uid=' + CB5.config.uid;
        if (top.location.protocol == 'https:') return;
        if (bnr.length) url += '&nb=1';
        CB5.getJson(url, function(data) {
            if (data.bannerLink)
                bnr.wrap('<a href="' + data.bannerLink + '"/>');
            if (data.banner) {
                $('#topBanner').slideDown('fast');
                /*we have user banner(s), switch off skyscraper banner*/
                //if (!bnr.length) self.bannerURL = data.banner;
                CB5.loadScript('shared/topbanner/topbanner5.js');
            }
        });
    }

    var fontsLoadedCallbacks = [];
    CB5.fontsLoaded = function(callback) {
        fontsLoadedCallbacks.push(callback);
    };

    function loadFonts() {
        if (!self.WebFont) return; //only newly published pages use WebFont loading
        var cnt = 0;
        for (var name in CB5.fonts) {
            if (!CB5.fonts.hasOwnProperty(name)) continue;
            cnt++;
            var conf = {
                fontinactive: done,
                fontactive: done
            };
            if (name.slice(0, 6) === 'cbusr-')
                conf.custom = {
                    families: [name],
                    urls: [CB5.fontURL + CB5.config.uid + '/' + name.replace(/ /g, '_') + '.css']
                };
            else if (CB5.cbFonts[name]) {
                conf.custom = {
                    families: [name],
                    urls: [CB5.fontURL + name.replace(/ /g, '_') + '.css']
                };
            } else {
                conf.google = {
                    families: [name]
                };
            }
            WebFont.load(conf);
        }
        if (cnt == 0) done();

        function done(font, style) {
            setTimeout(done2, 20);
            //debug('font loaded '+font);
        }

        function done2(font, style) {
            cnt--;
            if (cnt > 0) return;
            //debug('all fonts loaded');

            //notify fonts loaded
            for (var i = 0; i < fontsLoadedCallbacks.length; i++)
                fontsLoadedCallbacks[i]();

            //adjust word-spacing on each line until it fits in the box
            $('.cb-text2>span').each(function() {
                var line = $(this);
                if (line.hasClass('justify')) return;
                var sp = 0;
                while (true) {
                    var sum = 0;
                    sp++;
                    if (sp > 5) return;
                    line.children().each(function() {
                        sum += $(this).width();
                    });
                    if (line.width() < sum) {
                        line.css('wordSpacing', -sp);
                        //debug('adjust: ' + (line.width() - sum) + ' >> ' + sp);
                    } else return;
                }
            });
            //auto-adjust for justify
            $('.cb-text2>span.justify').each(function() {
                var line = $(this);
                var sp = 0;
                while (true) {
                    sp++;
                    if (sp > 5) return;
                    if (line[0].scrollHeight - 5 > line.height())
                        line.css('wordSpacing', -sp);
                    else return;
                }
            });
        }
    }

    //hide navigation before rendering page
    $(function() {
        $('.cb-navigation').hide();
    });

    CB5.renderPage = function() {
        if (CB5.encrypted)
            doPasswordPage();

        doBanner();
        loadFonts();
        doLinks();
        doLinksFF();

        /*//fix empty encrypted nav - copy content from the nav in template
         var navContent = null;
         $('.cb-navigation2').each(function () {
         if ($(this).html().indexOf('<!--#include') == 0)
         $(this).html(navContent);
         else
         navContent = $(this).html();
         });*/

        $('#site-loading').remove();
        $('.cb-navigation').show();

        if (!GA.userID && CB.siteSettings.analyticsID) GA.setUser(CB.siteSettings.analyticsID);
        //alert(_gaq);

        //fix empty li
        $('.cb-text2 li').each(function() {
            var first = $(this).find('span:eq(0)');
            if (first.text() == '') {
                $(this).css('margin-top', first.height());
                first.remove();
            }
            if (/^[\n\r]*$/.test($(this).text())) $(this).css('list-style-type', 'none');
        });

        //delete empty links
        $('.cb-text2 a').each(function() {
            if ($(this).text() == '') $(this).remove();
        });


        //justified text trick
        $('.cb-text .justify').append($('<div>').css({
            display: 'inline-block',
            width: '100%'
        }));
        $('.cb-text2').each(function() {
            $(this).find('.justify:last div').remove();
        });

        for (var i = 0; i < elements.length; i++) {
            //prevent duplicate render
            var id = elements[i][1];
            if (render.uniq[id]) continue;
            render.uniq[id] = true;
            //debug('render ' + elements[i][0]);
            try {
                render[elements[i][0]].apply(null, elements[i].slice(1));
            } catch (e) {
                debug('error rendering element: ' + elements[i][0]);
                debug(e.message, e.stack);
            }
        }

        $('[data-extra]').each(function() {
            var data = JSON.parse($(this).attr('data-extra'));
            //(id, skin, colorList, basepath) {
            render[data.elementType](this.id, data);
        });


        updatePageHeight();

        $('.cbel').each(function() {
            $(this).load(function() {
                //debug('loaded ' + $(this).attr('id') + ' w=' + $(this).height());
                updatePageHeight();
            });
        });

        //Transitions
        (function() {
            $('.cbel[data-transition^=none]').removeAttr('data-transition');
            var names = [];
            if ($('.cb-text[data-transition]').length) names.push('TransitionsText.c.js');
            if ($('.cb-image[data-transition]').length) names.push('TransitionsImage.c.js');
            if ($('.cbel[data-transition]').not('.cb-image,.cb-text').length)
                names.push('TransitionsOther.js');
            if (names.length) {
                $('.cbel[data-transition]').css({
                    visibility: 'hidden'
                });
                var cnt = 2;

                function check() {
                    cnt--;
                    if (cnt > 0) return;
                    //we can start the transitions now
                    $('.cbel[data-transition]').each(function() {
                        var $el = $(this),
                            plugin;
                        if ($el.is('.cb-image')) plugin = CB5.plugin.TransitionsImage;
                        else if ($el.is('.cb-text')) plugin = CB5.plugin.TransitionsText;
                        else plugin = CB5.plugin.TransitionsOther;
                        plugin.runWhen($el);
                    });
                }
                $(window).load(check);
                CB5.loadScript(names.map(function(name) {
                    return getRealPath('shared://plugin/' + name);
                }), check);
            }
        })();


        //Image Frames
        (function() {
            var list = $('.cb-image[data-frame]');
            if (!list.length) return;
            $(function() {
                CB5.loadScript(getRealPath('shared://plugin/ImageFrame.js'), function() {
                    list.each(function(e) {
                        var frameData = $.parseJSON(($(list[e]).attr('data-frame')));
                        var frame = {
                            type: frameData.type
                        };
                        frameData.type == 'BitmapFrame' ? frame.skin = frameData.skin : frame.colors = frameData.colors;
                        frame.sizes = {};
                        if (frameData.type == 'BitmapFrame' || frameData.type == 'RectFrame' || frameData.type == 'Polaroid')
                            frame.sizes[frameData.data[0][0]] = frameData.data[1];
                        else
                            frameData.data.forEach(function(v) {
                                frame.sizes[v[0][0]] = v[1];
                            });
                        if (navigator.userAgent.indexOf('Safari') != -1 && navigator.userAgent.indexOf('Chrome') == -1) {
                            list[e].onload = function() {
                                CB5.plugin.ImageFrame.render($(this).attr('id'), frame, frameData.matrix);
                            };
                        } else
                            CB5.plugin.ImageFrame.render($(list[e]).attr('id'), frame, frameData.matrix);
                    });
                });
            });
        })();

        (function() {
            $('.cb-image[data-reflection]').each(function() {
                var $el = $(this);
                CB5.ImageEffects.render($el, $el.matrix(),
                    $el.attr('data-filter'), $el.attr('data-reflection'));
            });
        })();

        (function() {
            $('.cb-image[data-tint]').each(function() {
                var $el = $(this);
                CB5.ImageEffects.addTint($el, $el.matrix(), CB5.Color.toRgba($el.attr('data-tint')));
            })
        })();

        //noise fills
        $('[data-noise-fill]').each(function() {
            var fill = JSON.parse($(this).attr('data-noise-fill'));
            $(this).css({
                background: 'url(' + CB5.util.noiseFill(fill.color, fill.color2, fill.intensity, fill.opacity) + ')'
            });
        });

        GA.trackPage(false);
    };

    var transform = CB5.transform = function(o, value) {
        o.WebkitTransform = o.MozTransform = o.msTransform = o.OTransform = o.transform = value;
        return o;
    };



    function debug(msg) {
        if (self.console && console.debug) console.debug(msg);
    }

    CB5.updatePageHeight = updatePageHeight;

    function updatePageHeight() {
        //compute page height
        var tplHeight = CB5.config.tplHeight;
        var pHeight = 0;
        if (CB5.config.pageHeight)
            pHeight = Number(CB5.config.pageHeight);
        else {
            $('.cbel').each(function() {
                if ($(this).attr('data-behaviour')) return;
                pHeight = Math.max(elBottom(this), pHeight);
            });

            pHeight += Number(CB5.config.tplMarginBottom);
            pHeight = Math.max(pHeight, Number(tplHeight));
        }

        $('#page').height(pHeight);
        $('body,html').css('height', 'auto');
        $('.cbel.cb-behaviour').removeClass('cb-behaviour');

        //apply behaviour
        $('[data-behaviour]').each(function() {
            var el = $(this);
            // data-behaviour="type:ini"
            if (!el.get(0).dataset) return;
            var a = el.get(0).dataset.behaviour.split(':');
            //if (a[0] == '')
            if (a[0] == 'vertical-stretch') {
                var w = el.width();
                if (!w) return;
                var h = pHeight - tplHeight + Number(a[1]);
                if (el[0].tagName != 'IMG')
                    el.height(h);
                else {
                    var ds = el[0].dataset;
                    if (ds.matrix && ds.origsize) {
                        var ma = ds.matrix.split(',');
                        var mo = ds.origsize.split(',');
                        ma[4] = ma[5] = 0;
                        ma[3] = h / mo[1];
                        el.css(CB5.vendorCss({}, 'transform', 'matrix(' + ma + ')'));
                    }
                }
            } else if (a[0] == 'stick-to-bottom')
                //el.main.y = Number(el.getData('behaviourIni')) + height - template.tplHeight;
                el.css('top', Math.round(Number(a[1]) + Number(pHeight) - Number(tplHeight)));
        });
    }

    function elBottom(elem) {
        if (!elem || (elem.dataset && elem.dataset.behaviour) || $(elem).is('.cb-backgroundBar')) return 0;
        var doc = elem.ownerDocument,
            body = doc.body,
            docElem = doc.documentElement;
        var clientTop = docElem.clientTop || body.clientTop || 0;
        var y = elem.getBoundingClientRect().bottom + (self.pageYOffset || jQuery.support.boxModel && docElem.scrollTop || body.scrollTop) - clientTop;
        return y;
    }



    function convertColors(colorList) {
        var colors = colorList.split(',');
        colors.reverse();
        for (var i = 0; i < colors.length; i++)
            colors[i] = Color.toRgba(('00000000' + colors[i]).substr(-8));
        return colors;
    }

    function canvas2Graphics(canvas) {
        if (!canvas.getContext) return null;
        var ctx = canvas.getContext('2d');
        var g = {
            ctx: ctx,
            clear: function() {
                ctx.clearRect(0, 0, canvas.width, canvas.height);
            },
            moveTo: function(x, y) {
                ctx.moveTo(x, y);
            },
            lineTo: function(x, y) {
                ctx.lineTo(x, y);
            },
            curveTo: function(cx, cy, x, y) {
                ctx.quadraticCurveTo(cx, cy, x, y);
            }
        };
        return g;
    }



    //-------------------------------------------------------------------------------------
    //				PASSWORD PAGES
    //-------------------------------------------------------------------------------------
    function doPasswordPage() {
        if (CB5.encrypted) {

            if (CB5.session.password) {
                var dec = Aes.Ctr.decrypt(CB5.encrypted, CB5.session.password, 128);
                if (dec.indexOf('cb-encrypt') === 0) {
                    $('#page').html($('#page').html() + dec.substr(10));
                    CB5.encrypted = false;
                    CB5.renderPage();
                    initForm();
                    return;
                }
            }

            var div = mkDiv().css({
                margin: '200px auto',
                background: 'white',
                borderRadius: 5,
                padding: 30,
                width: 400,
                textAlign: 'center',
                fontFamily: 'Arial, sans-serif',
                boxShadow: '5px 5px 5px rgba(0,0,0,.3)'
            });
            var frame = mkDiv().css({
                display: 'inline-block',
                textAlign: 'left'
            });
            div.append(frame);
            var inp, btn, btn2;
            frame.append(
                mkDiv().css({
                    fontWeight: 'bold',
                    marginBottom: 20
                }).text(CB5.config.texts.pwdtext),
                mkDiv().text(CB5.config.texts.password + ':'),
                inp = $('<input type="password">').css({
                    width: 200
                }),
                btn = $('<input type="button" value="OK">'),
                btn2 = $('<input type="button">').val(CB5.config.texts.cancel)
            );

            $('body').append(mkDiv().css({
                position: 'absolute',
                top: 0,
                width: '100%',
                zIndex: 2000
            }).append(div));
            inp.focus();
            inp.focus(function() {
                inp.removeClass('error');
            });

            function click() {
                var dec = Aes.Ctr.decrypt(CB5.encrypted, inp.val(), 128);
                if (dec.indexOf('cb-encrypt') === 0) {
                    div.parent().remove();
                    elements = []; //no duplicate rendering
                    $('#page').html($('#page').html() + dec.substr(10));
                    CB5.encrypted = false;
                    CB5.renderPage();
                    CB5.submittedPassword = inp.val();
                    initForm();
                    CB5.session.password = inp.val();
                    return;
                }
                inp.addClass('error');
            };
            btn.click(click);
            btn2.click(function() {
                div.parent().remove();
            });
            inp.keyup(function(e) {
                if (e.keyCode == 13) click();
            });
        }
    }

    CB5.replaceTexts = function(strings) {
        for (var name in strings) {
            var vName = '{$' + name + '}';

            function recTextNodes(node) {
                if (node.nodeType == 3) {
                    if (!node.nodeValue) return;
                    node.nodeValue = node.nodeValue.replace(vName, strings[name]);
                    return;
                }
                for (var i = 0, len = node.childNodes.length; i < len; ++i) {
                    recTextNodes(node.childNodes[i]);
                }
            }
            $('.cbel').each(function() {
                recTextNodes(this);
            });
        }
        $('.h5-text.delayed').removeClass('delayed');
    };

    $(function() {
        $('body').prepend($('.cbel.cb-backgroundBar'));
    });


    $(function() {
        var $code = $('.cb-externalCode');
        if (!$code.length) return;
        var tid, iid;
        $code.on('mousedown', function() {
            clearTimeout(tid);
            clearInterval(iid);
            iid = setInterval(updatePageHeight, 20);
            tid = setTimeout(function() {
                clearTimeout(iid);
            }, 1000);
        });
        for (var i = 0; i < 7; i++)
            setTimeout(updatePageHeight, 300 * i);
    });

})();

$(function() {
    var found = true;
    $('a[href]').each(function() {
        if (!found && /javascript:secureDownload/.test($(this).attr('href')))
            found = true;
    });
    if (!found) return;
    var s = document.createElement('script');
    s.defer = true;
    s.src = 'shared/html5/md5.js';
    document.head.appendChild(s);
});

if ('undefined' === typeof(CB)) $(CB5.renderPage);

$(function() {
    $('[data-fixed=1]').each(function() {
        var o = $(this).offset();
        $(this).css({
            left: o.left,
            top: o.top,
            position: 'fixed',
            zIndex: 1001
        });
    });
});