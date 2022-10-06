(function() {

    var debug = self.console ? console[console.debug ? 'debug' : 'log'].bind(console) : $.noop;

    var DrawingLib = CB5.util.Drawing;
    var Color = CB5.util.Color;
    var render = CB5.render = {
        uniq: {}
    };

    function mkDiv() {
        return $('<div/>');
    }

    function mkLoading() {
        return $('<img src="' + CB5.getRealPath('shared://loading.gif') + '"/>');
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

    var transform = CB5.transform = function(o, value) {
        o.WebkitTransform = o.MozTransform = o.msTransform = o.OTransform = o.transform = value;
        return o;
    };

    // JSONP
    function getJson(path, callback) {
        $.ajax(CB5.getRealPath(path), {
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
                img.src = CB5.getRealPath(prefix + encodeURIComponent(data[i].relSrc || data[i].src));
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
            },
            drawShape: function(type, xc, yc, xs, ys, anticlockwise) {
                if (type == 'rect') {
                    if (!anticlockwise)
                        ctx.rect(xc - xs / 2, yc - ys / 2, xs, ys);
                    else {
                        ctx.moveTo(xc - xs / 2, yc - ys / 2);
                        ctx.lineTo(xc - xs / 2, yc + ys / 2);
                        ctx.lineTo(xc + xs / 2, yc + ys / 2);
                        ctx.lineTo(xc + xs / 2, yc - ys / 2);
                    }
                } else if (type == 'ellipse') {
                    ctx.ellipse(xc, yc, xs / 2, ys / 2, 0, 0, 2 * Math.PI, anticlockwise);
                }
            }
        };
        return g;
    }


    //-------------------------------------------------------------------------------------
    //				AUTOSHAPE
    //-------------------------------------------------------------------------------------
    /**
     *
     * @param id
     * @param type
     * @param line
     * @param [fill]
     * @param [props]
     */
    render.autoShape = function(id, type, line, fill, props) {
        if (arguments.length < 4) {
            var data = arguments[1];
            var $el = arguments[2];
            type = data.type;
            line = data.lineStyle;
            fill = data.fillStyle;
            props = data.propertyList;
        }


        var canvas = $el ? $el[0] : document.getElementById(id);
        var g = canvas2Graphics(canvas);
        if (!g) return;
        //console.debug(line + '=' + Color.toRgba(lineA[0]));
        //shadow
        /*g.ctx.shadowColor = 'rgba(0,0,0,.1)';
         g.ctx.shadowOffsetX = g.ctx.shadowOffsetY = 3;
         g.ctx.shadowBlur = 5;*/


        getFillStyle(fill, g.ctx,
            function(pattern) {
                draw(type, line, pattern, props);
            }
        );

        function getFillStyle(fill, ctx, callback) {
            if (typeof fill === 'object') {

                if (fill.type == 'solid') {
                    return callback(Color.toRgba(fill.color, true));
                }
                if (fill.type == 'bitmap' || fill.type == 'noise') {
                    var img = new Image();
                    if (fill.type == 'bitmap')
                        img.src = fill.imgSrc;
                    else
                        img.src = CB5.noiseFill(fill.color, fill.color2, fill.intensity, fill.opacity);
                    $(img).load(function() {
                        callback(ctx.createPattern(img, 'repeat'));
                    });
                    return;
                }
                if (fill.type == 'linear' || fill.type == 'radial') {
                    var w = canvas.width / 2;
                    var h = canvas.height / 2;

                    if (fill.type == 'radial')
                        var center = {
                            x: fill.translatex * w,
                            y: fill.translatey * h
                        };

                    var grad = fill.type == 'linear' ?
                        g.ctx.createLinearGradient(
                            w + Math.cos(fill.rotation - 180) * w, h + Math.sin(fill.rotation - 180) * h,
                            w + Math.cos(fill.rotation) * w, h + Math.sin(fill.rotation) * h) :
                        g.ctx.createRadialGradient(w + center.x, h + center.y, 0, w + center.x, h + center.y, w);

                    fill.colors.forEach(function(color, i) {
                        grad.addColorStop(fill.ratios[i] / 255, Color.toRgba(color, true));
                    });
                    return callback(grad);
                }
            }
            callback(Color.toRgba(fill));
        }

        function draw(type, line, pattern, props) {
            var a = line.split(',');
            var lineWidth = a[1];
            var lineColor = a[0];


            //line, fill
            g.ctx.lineWidth = lineWidth;
            g.ctx.strokeStyle = Color.toRgba(lineColor);
            g.ctx.fillStyle = pattern;
            g.ctx.beginPath();
            var w = canvas.width;
            var h = canvas.height;
            var w2 = w / 2;
            var h2 = h / 2;
            if (type == 'poly')
                DrawingLib.drawPoly(g, w2, h2, props.sides, w2, h2, props.angle);
            else if (type == 'circle')
                DrawingLib.drawArc(g, w - lineWidth / 2, h2, w2 - lineWidth / 2, h2 - lineWidth / 2, 360, 0);
            else if (type == 'star')
                DrawingLib.drawStar(g, w2, h2, props.corners, props.innerRadius / 100 * w2, props.innerRadius / 100 * h2, w2, h2, props.angle);
            else if (type == 'wedge')
                DrawingLib.drawWedge(g, w2 - lineWidth / 2, h2 - lineWidth / 2, props.startAngle, props.arc, w2 - lineWidth / 1, h2 - lineWidth / 2);
            else if (type == 'gear')
                DrawingLib.drawGear(g, w2, Math.round(h / 2), props.sides,
                    props.innerRadius / 100 * w2,
                    props.innerRadius / 100 * h2,
                    w2, h2,
                    props.angle, props.holeSides,
                    props.holeRadius / 100 * w2,
                    props.holeRadius / 100 * h2);
            else if (type == 'donut') {
                DrawingLib.drawDonut(g, w2, h2,
                    props.innerRadius / 100 * w2,
                    props.innerRadius / 100 * h2,
                    props.outerRadius / 100 * w2,
                    props.outerRadius / 100 * h2);
            } else if (type == 'mask')
                DrawingLib.drawMask(
                    g,
                    props.type,
                    props.outerCenterX / 100 * w,
                    props.outerCenterY / 100 * h,
                    props.outerSizeX / 100 * w,
                    props.outerSizeY / 100 * h,
                    props.innerCenterX / 100 * w,
                    props.innerCenterY / 100 * h,
                    props.innerSizeX / 100 * w,
                    props.innerSizeY / 100 * h
                );
            else { //freeShape
                var path = type;
                if (path.length == 0) return;
                g.ctx.moveTo(path[0].x, path[0].y);
                for (var i = 1; i < path.length; i++) {
                    var p = path[i];
                    if (p.c)
                        g.ctx.quadraticCurveTo(p.c.x, p.c.y, p.x, p.y);
                    else
                        g.ctx.lineTo(p.x, p.y);
                }
            }
            g.ctx.closePath();
            g.ctx.fill();
            if (lineWidth > 0)
                g.ctx.stroke();

        }
    };
    render.freeShape = render.autoShape;

    //-------------------------------------------------------------------------------------
    //					NAVIGATION
    //-------------------------------------------------------------------------------------
    render.navigation = function(id, src, level, colorList, textFormat) {
        var el = $('#' + id);
        var W = el.width();
        var H = el.height();
        el.css({
            whiteSpace: 'nowrap'
        });

        el.find('.hidden').remove();

        //function dmp(el) {debug(el[0].tagName +':'+el.attr('class'));}
        //if we are linked to a level higher than 0, we remove all the levels and reinsert from the required level
        if (level > 0 && !$.data(el[0], 'levelLink')) {

            $.data(el[0], 'leveLink', true);

            //selected node
            var sel = el.find('.' + CB5.config.pid);
            if (!sel.length) {
                el.hide();
                return;
            }
            var ch = sel.parent().children('.level');
            //one level below, if exists
            if (ch.length) sel = ch;
            //lookup the linked level
            for (; sel[0] != el[0]; sel = sel.parent()) {
                if (sel.hasClass('level' + level)) break;
            }
            el.children().remove();
            var nn = sel.children();
            //first child is duplicate of parent node, remove it and the separator
            if (level == 1) sel.find('span:lt(2)').remove(); //nn.eq(0).remove();
            //set level1 class to the next level
            var levelNext = 'level' + (Number(level) + 1);
            nn.find('.' + levelNext).removeClass(levelNext).addClass('level1');
            //repeat centerpage in each popup
            nn.each(function() {
                var c = $(this).clone();
                c.find('.level').remove();
                $(this).children('.level').prepend(c, '<span class="separator">');
            });
            el.append(sel.children());
        }

        if (!el.children().length) return;


        function moreBtn(sz, color) {
            var cnv = $('<canvas>').attr({
                    width: sz,
                    height: sz
                })
                .css({
                    position: 'absolute',
                    top: 0,
                    cursor: 'pointer'
                });
            var ctx = cnv[0].getContext('2d');
            ctx.fillStyle = color;
            ctx.beginPath();
            /*var y2 = sz/6*3, r = sz / 12, p2 = 2*Math.PI;
             ctx.arc(sz/4, y2, r, 0, p2);
             ctx.arc(sz/4*2, y2, r, 0, p2);
             ctx.arc(sz/4*3, y2, r, 0, p2);*/
            ctx.moveTo(2 / 5 * sz, 1 / 3 * sz);
            ctx.lineTo(3 / 5 * sz, 1 / 2 * sz);
            ctx.lineTo(2 / 5 * sz, 2 / 3 * sz);
            ctx.lineTo(2 / 5 * sz, 1 / 3 * sz);
            ctx.fill();
            return cnv;
        }

        //decode TextFormat
        var tf = {};
        if (typeof textFormat == 'string') {
            var a = textFormat.split(',');
            for (var i = 0; i < a.length; i++) {
                var a1 = a[i].split(':');
                tf[a1[0]] = a1[1];
            }

            tfCss = {
                fontFamily: 'Arial,sans-serif',
                fontSize: tf.size + 'px',
                textDecoration: tf.underline ? 'underline' : 'none',
                textAlign: tf.align,
                fontStyle: tf.italic ? 'italic' : '',
                fontWeight: tf.bold ? 'bold' : ''
            };
        } else {
            tfCss = textFormat;
            tf.size = parseInt(textFormat['font-size']) + 3;
        }

        var colors = convertColors(colorList);

        el.find('.' + CB5.config.pid).addClass('selected');
        var list = el.children('.item').children('a');
        var len = list.length;
        el.find('a').css({
            whiteSpace: 'nowrap'
        });

        //NavigationHMenu
        if (src.indexOf('NavigationHMenu') === 0) {
            el.css({
                whiteSpace: 'nowrap'
            });
            var bottom = src.indexOf('Bottom') !== -1;
            var rounded = src.indexOf('Rounded') !== -1;
            var borderColor = '';
            if (rounded) borderColor = colors.splice(6, 1);

            el.css({
                background: colors[0]
            });
            //button width
            var bW = Math.round((W - (len - 1) * 2) / len);
            var css = {
                display: 'inline-block',
                minWidth: bW,
                height: el.height(),
                background: colors[1],
                color: colors[4],
                padding: '1px 4px',
                paddingTop: (el.height() - tf.size - 2) / 2,
                verticalAlign: 'top'
            };
            CB5.borderBox(css);
            $.extend(css, tfCss);
            list.css(css);

            list.each(function() {
                var a = $(this);
                if (a.parent().children('.level').length) {
                    var ch = rounded ? '○' : '▼';
                    a.prepend('<span style="font-family:Arial">' + ch + ' </span>');
                }
            });

            if (rounded) {
                list.css({
                    border: 'solid black 1px',
                    borderColor: borderColor,
                    borderRadius: '6px'
                });
                el.find('.separator').css({
                    display: 'inline-block',
                    width: 2
                });
            } else {
                el.find('.separator').addClass('cb-hsep');
            }



            var crtSubOpen = false;
            el.children('.item').children('a').click(function() {

                if ($(this).parent().children('.level').length > 0) {
                    var o = $(this).parent().children('.level');
                    if (crtSubOpen && crtSubOpen.get(0) != o.get(0))
                        crtSubOpen.slideUp('fast');
                    o.slideToggle(CB5.ipadFix);
                    crtSubOpen = o;
                    return false;
                }
            });
            $('body').click(function(e) {
                if (!$.contains(el.get(0), e.target) && crtSubOpen)
                    crtSubOpen.slideUp('fast');
            });

            delete css.width;
            css.marginTop = 2;
            css.background = colors[7];
            css.color = colors[10];
            css.height = '';
            css.paddingTop = '';
            el.find('.level1 a').css(css);

            //sublevels
            el.find('.level').css({
                display: 'block',
                paddingLeft: 20
            });
            //only hide the first sublevel, all other deep are displayed
            //they are positioned below items in the first level
            el.find('.level1').css({
                display: 'none',
                position: 'absolute',
                top: el.height() + 2,
                left: 0
            });
            if (bottom) el.find('.level1').css({
                top: '',
                bottom: el.height() + 2
            });
            el.find('.level .item').css({
                position: 'relative',
                display: 'block'
            });
            el.children('.item').css({
                display: 'inline-block'
            });
            el.find('.level .separator').remove();
            el.find('.item').css({
                position: 'relative'
            });

            el.find('.level1').css({
                background: colors[6],
                padding: 4,
                borderRadius: 4
            });

            //selected
            el.find('.selected').css({
                color: colors[5],
                backgroundColor: colors[2]
            });

            //more button+menu
            //el.css('outline','dotted red 1px')
            var menu = $('<div>');
            var sep = null;
            var last = el.children().last();
            while (W + 2 < last.position().left + last.width()) {
                //debug(W+2 - last.position().left - last.width());
                menu.prepend(last);
                sep = el.children().last().remove(); //remove separator
                last = el.children().last();
            }
            if (menu.children().length) {
                el.append(sep);
                var btn = moreBtn(el.height(), colors[4]);
                el.append(btn);
                menu.css({
                    position: 'absolute',
                    top: H + 5,
                    right: 5,
                    background: colors[6],
                    borderRadius: 4,
                    display: 'none'
                });
                menu.children().css({
                    display: 'block'
                });
                menu.children().children('a').css({
                    width: '100%'
                });
                el.append(menu);
                btn.css({
                    background: colors[1]
                });
                btn.click(function() {
                    menu.slideToggle('fast');
                });
            } else {
                //last button fills the rounding error
                list.last().css({
                    minWidth: W - (len - 1) * (bW + 2)
                });
            }



        } //end NavigationHMenu
        //---------------------------------------------------------------------
        else if (src === 'NavigationVMenu.swf' || src === 'NavigationVMenuBottom.swf') {
            var css = {
                display: 'block',
                color: colors[4],
                background: colors[1],
                padding: '2px 4px 0 4px'
            };
            $.extend(css, tfCss);
            css.lineHeight = (Number(tf.size) + 2) + 'px';
            var list = el.find('a');
            list.css(css);
            list.each(function() {
                var a = $(this);
                if (a.parent().children('.level').length) {
                    a.prepend('<span style="font-family:Arial;float:right">►</span>');
                }
            });

            el.find('.separator').addClass('cb-vsep');
            el.find('.selected').css({
                color: colors[5],
                backgroundColor: colors[2]
            });

            //$('head').append('<style>#'+id+' a:hover{background:'+colors[3]+'}</style>');

            var crtSubOpen = false;
            el.children('.item').children('a').click(function() {

                if ($(this).parent().children('.level').length > 0) {
                    var o = $(this).parent().children('.level');
                    if (crtSubOpen && crtSubOpen.get(0) != o.get(0))
                        crtSubOpen.hide('fast');
                    o.toggle('fast');
                    crtSubOpen = o;
                    return false;
                }
            });
            $('body').click(function(e) {
                if (!$.contains(el.get(0), e.target) && crtSubOpen)
                    crtSubOpen.hide('fast');
            });

            //sublevels
            //only hide the first sublevel, all other deep are displayed
            //they are positioned below items in the first level
            el.find('.level').css({
                display: 'block',
                paddingLeft: 10
            });
            el.find('.level1').css({
                display: 'none',
                position: 'absolute',
                top: -4,
                left: W + 2
            });
            el.find('.level a').css({
                marginBottom: 2
            });
            el.find('.level .separator').remove();
            el.children('.item').css({
                position: 'relative',
                display: 'block'
            });
            el.find('.level1').css({
                background: colors[6],
                padding: 4,
                borderRadius: 4
            });

            el.find('.level1 a').css({
                color: colors[10],
                background: colors[7]
            });
            //selected
            el.find('.level1 .selected').css({
                color: colors[11],
                backgroundColor: colors[8]
            });

            if (src === 'NavigationVMenuBottom.swf')
                el.append($('<div>').append(el.children()).css({
                    position: 'absolute',
                    bottom: 0,
                    width: '100%'
                }));
        } //end NavigationVMenu
        else if (src.indexOf('NavigationV1') === 0) {
            //var bottom = src.indexOf('Bottom') !== -1;
            el.css({
                background: colors[0]
            });
            var css = {
                display: 'block',
                color: colors[4],
                background: colors[1],
                padding: '2px 4px'
            };
            $.extend(css, tfCss);

            el.find('a').css(css);

            el.find('.separator').addClass('cb-vsep');
            el.find('.selected').css({
                color: colors[5],
                backgroundColor: colors[2]
            });

            el.find('.level1').remove();

            if (src === 'NavigationV1Bottom.swf')
                el.append($('<div>').append(el.children()).css({
                    position: 'absolute',
                    bottom: 0,
                    width: '100%'
                }));
            else
                el.css('height', '');
        } //end NavigationV1Top
        else if (src === 'NavigationTabsMid.swf' || src === 'NavigationTabsMidFlat.swf') {
            var flat = src === 'NavigationTabsMidFlat.swf';

            el.css({
                background: colors[0]
            });

            var css = {
                display: 'inline-block',
                height: el.height(),
                color: colors[flat ? 2 : 3],
                padding: '1px 25px',
                paddingTop: (el.height() - tf.size - 2) / 2,
                verticalAlign: 'top'
            };
            CB5.borderBox(css);
            $.extend(css, tfCss);
            list.css(css);

            el.find('.separator').css({
                display: 'inline-block',
                width: '2px',
                height: el.height(),
                verticalAlign: 'top'
            }).addClass('cb-hsep');

            el.find('.level1').remove();
            el.find('.item').css({
                position: 'relative'
            });

            //selected
            var sel = el.find('.selected');
            sel.parent().css({
                display: 'inline-block',
                overflow: 'hidden',
                height: el.height()
            });
            sel.css({
                color: colors[4],
                position: 'relative',
                zIndex: 1
            });
            var tab = mkDiv();
            tab.css(CB5.borderBox({
                position: 'absolute',
                top: 5,
                bottom: -7,
                left: 8,
                right: 8,
                zIndex: 0,
                background: colors[1],
                borderRadius: 7,
                boxShadow: '0px 0px 10px rgba(0,0,0,.2)'
            }));
            sel.parent().prepend(tab);
            if (!flat) {
                gradient(el, colors[0], Color.mixColors('#000000', colors[0], .3));
                gradient(tab, colors[1], Color.mixColors('#000000', colors[1], .3));
            }


            //more button+menu
            var menu = $('<div>');
            var sep = null;
            var last = el.children().last();
            while (W - H < last.position().left + last.width()) {
                menu.prepend(last);
                menu.prepend(sep = el.children().last()); //also remove separator
                last = el.children().last();
            }
            if (menu.children().length) {
                var btn = moreBtn(el.height(), colors[flat ? 2 : 3]);
                el.append(sep, btn);
                menu.css({
                    position: 'absolute',
                    top: el.height() + 3,
                    right: 3,
                    display: 'none'
                });
                var o = {};
                o.WebkitBoxShadow = o.MozBoxShadow = o.boxShadow = '0 2px 6px rgba(0,0,0,.3)';
                menu.css(o);
                gradient(menu, colors[0], Color.mixColors('#000000', colors[0], .3));
                el.append(menu);
                btn.click(function() {
                    menu.slideToggle('fast');
                });
            }


        } //end NavigationTabsMid, NavigationTabsMidFlat
        //-----------------------------------------------------------------
        else if (src.indexOf('NavigationH1') == 0) {
            var textonly = src.indexOf('TextOnly.swf') !== -1;
            if (!textonly) el.css({
                background: colors[0]
            });
            //button width
            var bW = Math.round((el.width() - (len - 1) * 2) / len);
            var css = {
                display: 'inline-block',
                minWidth: bW,
                height: el.height(),
                background: textonly ? '' : colors[1],
                color: textonly ? colors[0] : colors[4],
                padding: '1px 3px',
                paddingTop: (el.height() - tf.size - 2) / 2,
                verticalAlign: 'top'
            };
            CB5.borderBox(css);
            $.extend(css, tfCss);
            list.css(css);

            var wSum = 0;
            list.each(function() {
                //padding=6, spacer=2
                wSum += $(this).width() + 6 + 2;
            });
            wSum -= 2;


            el.find('.separator').css(CB5.borderBox({
                display: 'inline-block',
                width: '2px',
                height: el.height(),
                verticalAlign: 'top'
            })).addClass('cb-hsep');

            el.find('.level1').remove();

            //selected
            el.find('.selected').css({
                color: textonly ? colors[1] : colors[5],
                backgroundColor: textonly ? '' : colors[2]
            });

            //more button+menu
            //el.css('outline', 'dotted red 1px')
            var menu = $('<div>');
            var sep = null;
            var last = el.children().last();
            while (W + 2 < last.position().left + last.width()) {
                menu.prepend(last);
                sep = el.children().last().remove(); //remove separator
                last = el.children().last();
            }
            if (menu.children().length) {
                el.append(sep);
                var btn = moreBtn(el.height(), colors[4]);
                el.append(btn);
                var bg = colors[6];
                if (!bg) {
                    bg = 'rgba(0,0,0,.5)';
                    menu.find('a').css({
                        color: 'white',
                        background: bg
                    });
                }
                menu.css({
                    position: 'absolute',
                    top: H + 5,
                    right: 5,
                    background: bg,
                    borderRadius: 4,
                    display: 'none'
                });
                menu.children().css({
                    display: 'block'
                });
                menu.children().children('a').css({
                    width: '100%'
                });
                el.append(menu);
                btn.css({
                    background: colors[1]
                });
                btn.click(function() {
                    menu.slideToggle('fast');
                });
            } else {
                //last button fills the rounding error
                list.last().css({
                    minWidth: bW + W - wSum
                });
            }

        } //end NavigationH1...
        else
            debug(src);
        //render.navigation(id, 'NavigationHMenu.swf', colorList, textFormat);
    };


    //-------------------------------------------------------------------------------------
    //					TEXT BUTTON
    //-------------------------------------------------------------------------------------
    render.textButton = function(id, skin, $el) {
        //sb.debug(skin);
        var img = new Image;
        img.src = CB5.getRealPath('shared://button/' + skin + '.png');

        var el = $el ? $el : $('#' + id);
        var cnv = el.find('canvas').get(0);
        if (!cnv || !cnv.getContext) return;
        var ctx = cnv.getContext('2d');

        img.onload = function() {
            el.find('> div').css({
                padding: '8px 0px',
                textShadow: 'rgba(0,0,0,.1) 1px 1px 2px'
            });
            var w1 = img.width,
                h1 = img.height;
            var w2 = ctx.canvas.width,
                h2 = ctx.canvas.height;
            var dx1 = 10,
                dy1 = 10;
            var dx2 = 10,
                dy2 = 10;
            //9-slices
            ctx.drawImage(img, 0, 0, dx1, dx2, 0, 0, dx1, dx2);
            ctx.drawImage(img, dx1, 0, w1 - dx1 - dx2, dy1, dx1, 0, w2 - dx1 - dx2, dy1);
            ctx.drawImage(img, w1 - dx2, 0, dx2, dy1, w2 - dx2, 0, dx2, dy1);
            ctx.drawImage(img, 0, dy1, dx2, h1 - dy1 - dy2, 0, dy1, dx1, h2 - dy1 - dy2);
            ctx.drawImage(img, dx1, dy1, w1 - dx1 - dx2, h1 - dy1 - dy2, dx1, dy1, w2 - dx1 - dx2, h2 - dy1 - dy2);
            ctx.drawImage(img, w1 - dx2, dy2, dx2, h1 - dy1 - dy2, w2 - dx2, dy2, dx2, h2 - dy1 - dy2);
            ctx.drawImage(img, 0, h1 - dy2, dx1, dy2, 0, h2 - dy2, dx1, dy2);
            ctx.drawImage(img, dx1, h1 - dy2, w1 - dx1 - dx2, dy2, dx1, h2 - dy2, w2 - dx1 - dx2, dy2);
            ctx.drawImage(img, w1 - dx2, h1 - dy2, dx2, dy2, w2 - dx2, h2 - dy2, dx2, dy2);
            el.mouseover(function() {
                $(cnv).clearQueue().animate({
                    opacity: .7
                }, 'fast');
            }).mouseout(function() {
                $(cnv).clearQueue().animate({
                    opacity: 1
                }, 'fast');
            });
        };
    };
    //-------------------------------------------------------------------------------------
    //					GALLERY
    //-------------------------------------------------------------------------------------
    //render.gallery = function(id, skin, colorList, basepath) {
    render.gallery = function(id, data, $el) {
        var skin = data.pluginSrc;
        var colorList = data.colorList;
        var basepath = data.basepath;


        var el = $el ? $el : $('#' + id);
        var colors = colorList.split(',');
        var copyFrom = el.attr('data-copyFrom');
        if (!copyFrom) copyFrom = 'null';
        for (var i = 0; i < colors.length; i++) colors[i] = Color.pad0(colors[i]);

        if (/\.swf$/.test(skin)) skin = skin.substr(0, skin.length - 4);

        if (!basepath) basepath = CB5.getRealPath('user://') + '/';

        //load list
        function loadList(ready) {
            getJson('resource://gallery/' + id + '/' + copyFrom + '/json?t=' + (new Date).getTime(), function(data) {
                //display pictures from a different user/base location
                data.forEach(function(item) {
                    if (item.src.indexOf('user://') == 0) {
                        item.relSrc = item.src;
                        item.src = basepath + item.src.substr(7);
                    }
                });
                ready(data);
            });
        }

        //loadList($.noop);

        // >>> Mobile <<< touch skin
        if (skin === 'Mobile') {
            var crtIndex = 0;
            var div2 = $('<div>').addClass('animate-left').css({
                'white-space': 'nowrap',
                overflow: 'hidden',
                position: 'absolute',
                left: 0
            }).text('Loading...');
            el.css({
                overflow: 'hidden',
                position: 'relative'
            }).append(div2);

            loadList(function(data) {
                //preload images
                var count = data.length;
                data.forEach(function(item) {
                    item.img = new Image();
                    item.img.src = CB5.getRealPath(item.src);
                    item.img.onload = function() {
                        count--;
                        if (count == 0) drawGallery(data);
                    }
                });
            });

            function drawGallery(data) {
                var minDraggable;
                div2.empty();
                minDraggable = 0;

                var sorted = data.concat();
                sorted.sort(function(a, b) {
                    return a.img.naturalWidth / a.img.naturalHeight > b.img.naturalWidth / b.img.naturalHeight ? -1 : 1;
                });
                var maxW = sorted[0].img.naturalWidth,
                    maxH = sorted[0].img.naturalHeight;

                var chosenW = $el.width(),
                    chosenH = maxH * chosenW / maxW;
                data.forEach(function(item) {
                    var img = $(item.img).attr({
                        'data-label': item.label
                    }).css({
                        height: chosenH,
                        width: 'auto',
                        marginRight: 2,
                        display: 'inline-block'
                    });
                    div2.append(img);
                });
                div2.children().each(function() {
                    minDraggable += $(this).width();
                });
                $el.css({
                    height: chosenH
                });
                div2.cbDraggable({
                    dir: 'x',
                    min: -minDraggable + chosenW / 2,
                    max: chosenW / 2,
                    preventDefault: false,
                    stop: function() {
                        crtIndex += div2.attr('data-drag-dir') == '1' ? -1 : 1;
                        crtIndex = Math.max(0, Math.min(div2.children().length - 1, crtIndex));
                        var winW = $el.width();
                        var $img = div2.children().eq(crtIndex);
                        var pos = $img[0].offsetLeft + $img.width() / 2 - winW / 2;
                        div2.css({
                            left: -pos
                        });
                    }
                });
            }
            // >>> GalleryAccordion <<<
        } else if (skin === 'GalleryAccordion') {
            el.css({
                width: '',
                whiteSpace: 'nowrap'
            });
            var h = el.height();
            loadList(function(data) {
                for (var i = 0; i < data.length; i++) {
                    var color = Color.mixColors(colors[2].substr(2), colors[1].substr(2), i / data.length);
                    createPage(data[i], color, i == 0);
                }
            });

            var crtHide = null;

            function createPage(o, color, first) {

                var div = $('<div/>');
                div.css({
                    position: 'relative',
                    display: 'inline-block',
                    overflow: 'hidden',
                    width: 30,
                    height: h,
                    marginRight: 1
                });

                var img = new Image;
                //img.height = h;
                img.onload = function() {
                    if (first) setTimeout(click, 150);
                    ld.remove();
                    var r = img.width / img.height;
                    img.height = h;
                    img.width = h * r;
                };
                img.src = CB5.getRealPath(o.src);
                div.append(img);

                var hnd = $('<div/>');

                hnd.css({
                    background: color,
                    position: 'absolute',
                    top: 0,
                    left: 0,
                    width: 30,
                    height: h,
                    cursor: 'pointer'
                });
                var lbl = $('<div/>');
                lbl.css({
                    'transform': 'rotate(-90deg)',
                    'transform-origin': '0 0',
                    '-ms-transform': 'rotate(-90deg)',
                    '-ms-transform-origin': '0 0',
                    '-moz-transform': 'rotate(-90deg)',
                    '-moz-transform-origin': '0 0',
                    '-webkit-transform': 'rotate(-90deg)',
                    '-webkit-transform-origin': '0 0',
                    width: h,
                    marginTop: h,
                    fontFamily: 'sans-serif',
                    fontSize: '14px',
                    color: '#fff',
                    padding: '6px 15px',
                    textShadow: '0 0 2px rgba(0,0,0,.4)'
                });
                lbl.text(o.label);
                hnd.append(lbl);
                var lbl2 = lbl.clone();
                lbl2.css({
                    position: 'absolute',
                    top: 0
                });
                div.append(lbl2);
                div.append(hnd);

                var ld = mkLoading().css({
                    position: 'absolute',
                    top: 7,
                    left: 7
                });
                div.append(ld);

                el.append(div);

                function hide() {
                    div.animate({
                        width: 30
                    });
                    hnd.animate({
                        opacity: 1
                    });
                }

                function show() {
                    div.animate({
                        width: img.width
                    });
                    hnd.animate({
                        opacity: 0
                    });
                }

                function click() {
                    if (crtHide) crtHide();
                    crtHide = hide;
                    show();
                }
                hnd.click(click);
            }
        } //end GalleryAccordion
        // >>> GallerySlideshow <<<
        else if (skin === 'GallerySlideshow') {
            var data = null;
            var crt = 0;
            var img;
            loadList(function(ret) {
                data = ret;
                if (data.length)
                    preload(true);
            });

            function preload(first) {
                if (img) img.onload = img.onerror = null;
                img = new Image;
                img.onload = function() {
                    img.onload = null;
                    if (first) showNext();
                    else setTimeout(showNext, 5000);
                };
                img.onerror = function() {
                    showNext();
                };
                img.src = CB5.getRealPath(data[crt].src);
            }

            function showNext() {
                if (img.width / img.height > (el.width() - 24) / (el.height() - 38)) {
                    img.width = el.width() - 24;
                    img.style.height = 'auto';
                } else {
                    img.height = el.height() - 38;
                    img.style.width = 'auto';
                }
                var tbl = $('<table/>');
                tbl.css({
                    position: 'absolute',
                    top: 0,
                    width: '100%',
                    height: '100%',
                    opacity: 0
                });
                var td = $('<td valign="middle" align="center"/>');
                tbl.append(td);
                var div = $('<div/>');
                var color1 = Color.toRgba(colors[1]);
                div.css({
                    lineHeight: 0,
                    position: 'relative',
                    display: 'inline-block',
                    background: color1,
                    padding: '20px 5px 5px 5px'
                });
                var lbl = $('<div/>');
                lbl.css({
                    position: 'absolute',
                    top: 0,
                    left: 0,
                    padding: '2px 6px',
                    fontWeight: 'bold',
                    lineHeight: '16px',
                    fontSize: '13px',
                    fontFamily: 'sans-serif',
                    color: Color.toRgba(colors[0])
                });
                var lbl2 = $('<div/>');
                lbl2.css({
                    position: 'absolute',
                    top: 0,
                    right: 0,
                    padding: '2px 6px',
                    fontWeight: 'bold',
                    lineHeight: '16px',
                    fontSize: '13px',
                    fontFamily: 'sans-serif',
                    color: Color.toRgba(colors[0])
                });
                lbl2.text((crt + 1) + '/' + data.length);
                lbl.text(data[crt].label);
                div.append(lbl2);
                div.append(lbl);
                div.append(img);
                td.append(div);
                var old = el.find('table');
                old.animate({
                    opacity: 0
                }, 2000, function() {
                    old.remove();
                });
                el.append(tbl);
                tbl.animate({
                    opacity: 1
                }, 2000);
                crt++;
                if (crt === data.length) {
                    crt = 0;
                    loadList(function(ret) {
                        data = ret;
                        preload(false);
                    });
                } else {
                    preload(false);
                }
            }
        } //end GallerySlideshow
        // >>> GalleryTiles <<<
        else if (skin === 'GalleryTiles') {
            var h = el.height();
            var cols = Math.floor((el.width() - 28 - 32) / 110);
            var rows = Math.floor(h / 110);
            var crtPage = 0;
            var perPage = cols * rows;
            var maxPage = 0;
            var dir = true;

            function arrow(name, d, left) {
                var ar = $(new Image);
                ar.attr('src', CB5.getRealPath('shared://arrow-' + name + '.png'));
                ar.css({
                    position: 'absolute',
                    left: left,
                    top: (h - 80) / 2,
                    marginRight: 3,
                    cursor: 'pointer'
                });
                el.append(ar);
                ar.click(function() {
                    if ((crtPage == 0 && d == -1) || (crtPage == maxPage && d == 1)) return;
                    dir = d == 1;
                    crtPage += d;
                    showPage();
                });
            }
            arrow('back', -1, 0);

            var div = $('<div/>');
            div.css({
                position: 'absolute',
                top: 0,
                left: 28,
                width: 110 * cols,
                height: h
            });
            el.append(div);
            var data = null;
            loadList(function(ret) {
                data = ret;
                maxPage = Math.ceil(data.length / perPage) - 1;
                loadMulti(data, showPage, 'thumb://?s=100&u=' + CB5.config.uid + '&p=', 'th');
            });
            arrow('forward', 1, 28 + cols * 111);

            function showPage() {
                var color = Color.toRgba(colors[colors.length - 1]);
                div.empty();
                var k = 0;
                for (var i = crtPage * perPage; i < (crtPage + 1) * perPage && i < data.length; i++) {
                    var th = $('<div/>');
                    th.css({
                        position: 'absolute',
                        display: 'block',
                        width: 108,
                        height: 108,
                        margin: '0 2px 2px 0',
                        cursor: 'pointer',
                        top: 0,
                        left: dir ? cols * 110 : -110,
                        opacity: 0,
                        borderRadius: 5,
                        background: color
                    });
                    var img = data[i].th;
                    th.append($(img).css({
                        position: 'absolute',
                        left: (108 - img.width) / 2,
                        top: (108 - img.height) / 2
                    }));
                    th.delay(k * 100).animate({
                        top: Math.floor(k / cols) * 110,
                        left: (k % cols) * 110,
                        opacity: 1
                    }, {
                        duration: 300
                    });
                    (function(i) {
                        th.click(function() {
                            setTimeout(function() {
                                showPopup(this, data, i);
                            }, 10);
                        });
                    })(i);
                    div.append(th);
                    k++;
                }
            }

        } //end GalleryTiles
        //GalleryBook GallerySimple
        else if (skin === 'GalleryBook' || skin === 'GallerySimple' || skin === 'GalleryCylinder' || skin === 'GalleryFlower') {
            CB5.loadScript(CB5.getRealPath('shared://plugin/' + skin + '.c.js'), function() {
                CB5.plugin[skin](id, convertColors(colorList), loadList);
            });
        } else
            debug(skin + ' not implemented');

    }; //render.gallery

    //Gallery Popup
    var showPopup = CB5.galleryPopup = function(el, data, i) {
        var w = $(window).width();
        var h = $(window).height();
        var bg = mkDiv().css({
            position: 'absolute',
            top: 0,
            left: 0,
            right: 0,
            bottom: 0,
            background: '#000',
            opacity: .4,
            zIndex: 1000
        });
        //fix bg width on iPad&co
        var ww = $('#index').width() + parseInt($('#index').css('marginLeft')) + parseInt($('#index').css('marginRight'));
        $('body').append(bg);
        if (ww > bg.width()) {
            bg.width(ww);
        }

        sizeBg();
        var isTouch = CB5.isTouch;

        //div
        var div = mkDiv().css({
            position: 'absolute',
            top: CB5.scrollTop() + 30,
            left: 0,
            zIndex: 1001,
            width: '100%'
        });
        //frame
        var frame = mkDiv().css({
            position: 'relative',
            width: 250,
            height: 250,
            borderRadius: 3,
            margin: '0 auto',
            padding: '7px 7px 30px 7px',
            background: '#fff'
        });
        if (!isTouch) frame.addClass('hovermaster');
        var ld = mkLoading().css({
            position: 'absolute',
            left: (frame.width() + 2 * 7 - 16) / 2,
            top: (frame.height() + 7 * 2 - 16) / 2
        });
        frame.append(ld);
        //buttons
        var clickEvent = isTouch ? 'touchstart' : 'click';
        var btn1 = mkA('').css({
            position: 'absolute',
            top: 0,
            left: 0,
            width: '50%',
            height: '100%',
            outline: 'none',
            background: 'url("' + CB5.getRealPath('shared://arrow-left.png') + '") no-repeat 0 50%'
        }).addClass('hoverslave');
        btn1.bind(clickEvent, function() {
            next(-1);
        });
        frame.append(btn1);
        var btn2 = mkA('').css({
            position: 'absolute',
            top: 0,
            right: 0,
            width: '50%',
            height: '100%',
            outline: 'none',
            background: 'url("' + CB5.getRealPath('shared://arrow-right.png') + '") no-repeat 100% 50%'
        }).addClass('hoverslave');
        btn2.bind(clickEvent, function() {
            next(1);
        });
        frame.append(btn2);
        updateButtons();
        var cBtn = mkA('| X').css({
            position: 'absolute',
            right: 3,
            bottom: 3,
            padding: 5,
            fontWeight: 'bold',
            fontFamily: 'sans-serif',
            fontSize: '14px',
            textDecoration: 'none',
            color: '#666'
        });
        cBtn.bind(clickEvent, close);
        frame.append(cBtn);
        //label
        var lbl = mkDiv().css({
            position: 'absolute',
            left: 7,
            bottom: 7,
            fontWeight: 'bold',
            color: '#666',
            fontFamily: 'sans-serif',
            fontSize: '13px',
            display: 'none'
        });
        lbl.text(data[i].label);
        frame.append(lbl);
        //image
        var img = mkImage(CB5.getRealPath(data[i].src)).css({
            display: 'none'
        });

        function imgLoad() {
            if (img.width() / img.height() > w / h) {
                if (img.width() > w - 100) img.css({
                    width: w - 100,
                    height: 'auto'
                });
            } else {
                if (img.height() > h - 100) img.css({
                    width: 'auto',
                    height: h - 100
                });
            }

            ld.hide();
            img.css({
                display: 'none',
                opacity: 0
            });
            var dur = (Math.abs(frame.width() - img.width()) + Math.abs(frame.height() - img.height())) / 2;
            frame.animate({
                width: img.width(),
                height: img.height()
            }, dur, null, function() {
                img.css({
                    display: 'block',
                    opacity: 0
                });
                img.animate({
                    opacity: 1
                }, 'fast');
                lbl.slideDown('fast');
            });
        }
        img.load(imgLoad);
        div.append(frame);
        frame.append(img);
        $('body').append(div);

        function updateButtons() {
            btn1.css({
                display: i == 0 ? 'none' : ''
            });
            btn2.css({
                display: i == data.length - 1 ? 'none' : ''
            });
        }

        function close() {
            bg.animate({
                opacity: 0
            }, function() {
                bg.remove();
            });
            div.remove();
        }

        function sizeBg() {
            bg.height(Math.max($(self).height(), $('body')[0].scrollHeight));
        }

        function next(d) {
            img.remove();
            i += d;
            updateButtons();
            ld.show();
            lbl.hide();
            lbl.text(data[i].label);
            img = mkImage(CB5.getRealPath(data[i].src)).css({
                display: 'none'
            });
            img.load(imgLoad);
            frame.append(img);
            ld.css({
                left: (frame.width() + 2 * 7 - 16) / 2,
                top: (frame.height() + 7 * 2 - 16) / 2
            });
        }

        $(window).resize(sizeBg);
        setTimeout(function() {
            $('body').bind(clickEvent, function(e) {
                if (!$.contains(frame.get(0), e.target)) close();
            });
        }, 20);

        $('body').keyup(function(e) {
            if (e.keyCode == 27) close();
        });
    }; //end show popup

    //-------------------------------------------------------------------------------------
    //					HTML ELEMENT
    //-------------------------------------------------------------------------------------
    //render.htmlContent = function(id, content, names, params) {
    render.htmlContent = function(id, data, $el) {
        var content = data.content,
            names = data.configNames,
            params = data.configValues;
        if (!content) content = '';

        function loadScript(url) {
            var po = document.createElement("script");
            po.type = "text/javascript";
            po.async = true;
            po.src = url;
            var s = document.getElementsByTagName("script")[0];
            s.parentNode.insertBefore(po, s);
        }


        var el = $el ? $el : $('#' + id);
        var hPadding = data.hPadding ? Number(data.hPadding) : 0;
        names = names ? names.split(',') : [];
        params = params ? params.split('||') : [];
        var url = encodeURIComponent(document.location);
        names = ['width', 'height', 'pageid', 'URL', 'fbapid'].concat(names);
        params = [el.width() - hPadding, el.height(), CB5.config.pid, url, '126226044067291'].concat(params);
        for (var i = 0; i < names.length; i++)
            content = content.replace(new RegExp('\\{\\$' + names[i] + '\\}', 'g'), params[i]);

        var isGplus = content.indexOf('<div class="g-plus"') == 0;
        var iframe = !/^\s*<iframe.*iframe>\s*$/.test(content) && !isGplus;
        if (isGplus) {
            loadScript('https://apis.google.com/js/plusone.js');
            window.___gcfg = {
                lang: 'en'
            };
        }


        if (iframe) {
            var frm = $('<iframe/>').css({
                border: 0,
                width: '100%',
                height: '100%'
            });
            el.append(frm);
            var d = frm.get(0).contentWindow.document;
            d.open();
            d.write('<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">' +
                '<html><head></head><body style="margin:0">' + content + '</body></html>');
            setTimeout(function() {
                d.close();
            }, 2000);
        } else {
            el.html(content);
        }

        if (isGplus && self.gapi) gapi.plus.go();

        if (/Android|iPhone|iPod|iPad/.test(navigator.userAgent))
            el.children('iframe').parent().css({
                'overflow': 'auto',
                '-webkit-overflow-scrolling': 'touch'
            });
    };
    //-------------------------------------------------------------------------------------
    //					SEARCH
    //-------------------------------------------------------------------------------------
    //render.search = function(id, colorList, searchTxt, searchingTxt, resultTxt) {
    render.search = function(id, data, $el) {
        var colorList = data.colorList,
            searchTxt = data.searchTxt,
            searchingTxt = data.searchingTxt,
            resultTxt = data.resultTxt;

        var magnIcon = 'data:image/png;base64,' +
            'iVBORw0KGgoAAAANSUhEUgAAABUAAAAVCAIAAAAmdTLBAAAAAXNSR0IArs4c6QAAAAZiS0dEAP8A/wD/' +
            'oL2nkwAAAAlwSFlzAAALEwAACxMBAJqcGAAAAAd0SU1FB9sCDg4PKeGGy7YAAAKTSURBVDjLhVQ9aypB' +
            'FJ3ZWZSkiMGPoFitpgiJlUtIYSxSCQEJaKOCjf/AxsImpZDCJikstPUHBJIgIaUIAYuAChoEYVdUDCT4' +
            'xaq7M6+YvHFVJKdYdu89586du2cGYozBOiCEAABCCMaY4zj6qWkahJDjOEII48iyzG2LCSGEEAghQghC' +
            'OJ/PCSEIISqmSgZeL2NPAMByuSyXy7VabTqd8jwvCMLl5eXR0dHmevr+mX42m93f37+/v0MIHQ7HaDSa' +
            'TCZ2uz2RSIiiyPiyLAOMMcaY9kxfFEXJZDLBYPDh4aHb7dLIy8tLLBaLRCKfn5/kPyRJWukxxqqqEkIe' +
            'Hx8DgUChUCDrqFar4XD49vZWr+f0zSOEMMa1Ws1kMt3c3NA4pQIAvF6vz+f7+Pjo9/tMtTn/r6+vXq/n' +
            'cDhMJhMV09KapgEAnE6nwWD4+fnZnD/jUepisaBzpRNl7OVyuVgs9L+Q2xi+zWYTBKHZbMqyzOpijBFC' +
            'qqpWKhVFUSwWy0pP16RU2uTx8fF4PM7lcrPZjGY5jgMA5PP5SqVydXVltVpX/bP2IIQ8z3c6naenp729' +
            'vbe3t36/f319fXZ29v39/fz8/Pr66na74/H4mn+YWwEAnU4nnU7X6/WDg4PT09N2uz0ej/f391VVVRRF' +
            'FMVUKuVyufT+4Zm40Wik0+lWq2U0GkOhUDKZHA6HpVJJkqTDw8Pz83NRFNlOVyOk5imXy36/3+12ezye' +
            'u7s7shvMrL/+I4SUSqWLiwtBEDweTzabpTlN0/AWqJ6V+NUXi0Wz2XxyclIsFmmCGvlPSJLEAwCi0ehg' +
            'MLBYLNFolG4PIcQcpb8wNs747/nV+2lbptczDrt/eH095gW9Z3dF1vyzK/0n/gEaKjrHVOERxgAAAABJ' +
            'RU5ErkJggg==';

        var colors = convertColors(colorList);
        var el = $el ? $el : $('#' + id);
        el.css({
            background: colors[0],
            whiteSpace: 'nowrap'
        });
        var margin = (el.height() - 24) / 2;

        var btn = $('<a href="javascript:void(0)"></a>');
        btn.text(searchTxt);
        btn.css({
            display: 'inline-block',
            fontWeight: 'bold',
            fontFamily: 'Arial,sans-serif',
            fontSize: '12px',
            textDecoration: 'none',
            background: colors[1],
            color: '#fff',
            border: 'solid rgba(255,255,255,.6) 1px',
            padding: '4px 9px',
            height: 15,
            verticalAlign: 'bottom'
        });
        gradient(btn, Color.mixColors('rgba(255,255,255,255)', colors[1], .4), colors[1]);
        el.prepend(btn);

        var field = $('<input type="search">');
        field.css(CB5.borderBox({
            background: '#fff url(' + magnIcon + ') no-repeat 3px 50%',
            border: 'solid #ccc 1px',
            padding: '2px 2px 2px 26px',
            height: 25,
            marginTop: margin,
            marginLeft: margin,
            width: el.width() - btn.width() - margin * 3 - 20
        }));
        el.prepend(field);
        setTimeout(function() {
            field.css('width', el.width() - btn.width() - margin * 3 - 20);
        }, 10);

        btn.click(onClick);
        field.keydown(function(e) {
            if (e.which != 13) return;
            onClick();
        });

        function onClick() {
            //SEARCH POPUP
            var w = $(window).width();
            var h = $(window).height();
            var bg = mkDiv().css({
                position: 'absolute',
                top: 0,
                left: 0,
                bottom: 0,
                right: 0,
                background: '#000',
                opacity: .4,
                zIndex: 1000
            });
            $('body').append(bg);
            sizeBg();
            //div
            var div = mkDiv().css({
                position: 'absolute',
                top: CB5.scrollTop() + 30,
                left: 0,
                zIndex: 1001,
                width: '100%'
            });
            //frame
            var frame = mkDiv().css({
                position: 'relative',
                width: 650,
                height: h - 200,
                borderRadius: 3,
                margin: '0 auto',
                padding: '30px 7px 7px 7px',
                background: '#fff',
                boxShadow: '5px 5px 5px rgba(0,0,0,.3)'
            }).addClass('hovermaster');
            var ld = mkLoading().css({
                position: 'absolute',
                left: (frame.width() + 2 * 7 - 16) / 2,
                top: (frame.height() + 7 * 2 - 16) / 2
            });
            frame.append(ld);
            //buttons
            var cBtn = mkA('X').css({
                position: 'absolute',
                right: 7,
                top: 7,
                fontWeight: 'bold',
                fontFamily: 'sans-serif',
                fontSize: '14px',
                textDecoration: 'none',
                color: '#666'
            });
            cBtn.click(close);
            frame.append(cBtn);
            div.append(frame);
            $('body').append(div);

            function close() {
                bg.animate({
                    opacity: 0
                }, function() {
                    bg.remove();
                });
                div.remove();
            }

            function sizeBg() {
                bg.height($('body')[0].scrollHeight);
            }

            $(window).resize(sizeBg);
            setTimeout(function() {
                $('body').click(function(e) {
                    if (!$.contains(frame.get(0), e.target)) close();
                });
            }, 10);
            $('body').keyup(function(e) {
                if (e.keyCode == 27) close();
            });

            getJson('search://?userID=' + CB5.config.uid + '&q=' + encodeURIComponent(field.val()), function(data) {
                //debug(data);
                ld.remove();
                var cont = mkDiv().css({
                    overflow: 'auto',
                    fontFamily: 'Arial, sans-serif',
                    fontSize: '12',
                    height: div.height() - 37
                });
                for (var i = 0; i < data.length; i++) {
                    var title = mkA('').html(data[i].title.toUpperCase()).css({
                        display: 'block',
                        margin: '0px 0 5px 0',
                        fontSize: 16,
                        fontWeight: 'bold',
                        textDecoration: 'underline',
                        color: '#0000aa'
                    });


                    //shop/s1k-84b43o16vy-rvyi6/product/prod-3-3
                    //shop/s1k-84b43o16vy-rvyi6/categories/categ-2-3/1
                    var parts = data[i].URI.split('/');
                    var url = parts[0] + '.html';
                    if (parts[2] == 'product')
                        url += '?id_product=' + parts[3].substr(parts[3].lastIndexOf('-') + 1);
                    if (parts[2] == 'categories')
                        url += '?id_category=' + parts[3].substr(parts[3].lastIndexOf('-') + 1);

                    title.attr('href', url);
                    cont.append(title);
                    if (data[i].description != '') {
                        var desc = mkDiv().css({
                            color: '#666',
                            marginBottom: 5
                        }).html(data[i].description);
                        cont.append(desc);
                    }
                    var txt = mkDiv().css({
                        marginBottom: 20
                    });
                    txt.html(data[i].text);
                    cont.append(txt);
                }
                frame.append(cont);
            });
        }
    }; //end search


    //-------------------------------------------------------------------------------------
    //					Google Map (yMap)
    //-------------------------------------------------------------------------------------
    //var yMapCounter = 0;
    var mapInits = [];
    var mapLoaded = false;
    //render.yMap = function (id, lat, lon, zoom) {
    render.yMap = function(id, data, $el) {
        var el = $el ? $el : $('#' + id);
        var latlon = data.latlon.split(',');
        var lat = latlon[0];
        var lon = latlon[1];
        var zoom = data.zoom;
        mapInits.push(function() {
            var latlng = new google.maps.LatLng(Number(lat), Number(lon));
            var map = new google.maps.Map(el[0], {
                zoom: Number(zoom),
                center: latlng,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            });
            new google.maps.Marker({
                position: latlng,
                map: map,
                title: ''
            });
        });

        if (mapLoaded) {
            self.mapInit();
            return;
        }

        if (self.mapInit) return;
        self.mapInit = function() {
            for (var i = 0; i < mapInits.length; i++)
                mapInits[i]();
            mapInits.length = 0;
            mapLoaded = true;
        };
        CB5.loadScript('https://maps.googleapis.com/maps/api/js?callback=mapInit&key=AIzaSyAy80ozoeua5hkBPkYkvZu0gaqQRIFp2h0');
    }; //end yMap


    //-------------------------------------------------------------------------------------
    //					Poll
    //-------------------------------------------------------------------------------------
    //render.poll = function (id, type, colors, labels, ids, questionTxt, resultsLbl, voteLbl) {
    render.poll = function(id, data, $el) {
        var type = data.pluginSrc,
            labels = data.optionLabels.split('&').map(decodeURIComponent),
            ids = data.optionUIDs.split(','),
            questionTxt = data.questionTxt,
            resultsLbl = data.resultsLbl,
            voteLbl = data.voteLbl;

        var colors = data.colorList.split(',').map(Color.toRgba).reverse();

        //debug(arguments);
        var el = $el ? $el : $('#' + id);

        el.css({
            background: colors[0],
            color: colors[1]
        });
        var box = mkDiv().css({
            margin: 10,
            padding: 10,
            border: 'solid 1px ' + colors[4]
        });
        el.append(box);
        el.height('auto');
        var ld = mkLoading().css({
            margin: '30px 0'
        });

        showVote();
        el.height(el.height());
        box.height(box.height());

        function showResults() {
            box.empty();
            box.append(mkDiv().text(questionTxt));
            box.append(ld);
            getJson('resource://poll/' + id + '/null/json?ids=' + ids, function(ret) {
                var values = {},
                    total = 0;
                for (var i = 0; i < ret.length; i++) {
                    values[ret[i].voteUID] = Number(ret[i].voteCount);
                    total += Number(ret[i].voteCount);
                }

                ld.remove();
                var opts = mkDiv().css({
                    margin: '15px 0 15px 0',
                    lineHeight: '12px'
                });
                for (var i = 0; i < labels.length; i++) {
                    var val = values[ids[i]] ? values[ids[i]] : 0;
                    var percent = total > 0 ? Math.round(val / total * 100) + '%' : '0%';
                    var rect = mkDiv().css({
                        height: 12,
                        border: 'solid #ccc 1px',
                        position: 'relative'
                    });
                    var bar = mkDiv().css({
                        position: 'absolute',
                        top: 0,
                        background: colors[2],
                        width: '0',
                        height: '100%',
                        zIndex: 0
                    });
                    rect.append(bar, mkDiv().css({
                        position: 'absolute',
                        right: 1,
                        fontSize: '10px',
                        zIndex: 1
                    }).text(percent));
                    bar.animate({
                        width: (val / total * 100) + '%'
                    });
                    opts.append(
                        mkDiv().css({
                            fontSize: '11px'
                        }).text(labels[i]),
                        rect,
                        $('<br>')
                    );
                }
                box.append(opts);
                box.append(mkDiv().css({
                    'float': 'right'
                }).text('Total votes: ' + total));
                var btn = mkA('back');
                btn.click(showVote);
                box.append('< ', btn);
            });
        }

        function showVote() {
            box.empty();
            box.append(mkDiv().text(questionTxt));

            var opts = mkDiv().css({
                margin: '15px 0 15px 0',
                lineHeight: '36px'
            });
            for (var i = 0; i < labels.length; i++) {
                var aid = id + '|' + ids[i];
                opts.append(
                    $('<input type="radio"/>').attr({
                        name: id,
                        id: aid
                    }),
                    $('<label/>').css({
                        fontSize: '12px'
                    }).attr({
                        'for': aid
                    }).text(labels[i]),
                    $('<br>')
                );
            }
            box.append(opts);

            var btn = $('<input type="button">').css({
                minWidth: 75
            }).val(voteLbl);
            box.append(btn);
            var key = 'cbvoted-' + id;
            if (localStorage[key] && (new Date(Number(localStorage[key]) + 1000 * 60 * 60 * 24)) > new Date) {
                btn.attr('disabled', 'disabled');
            } else {
                delete localStorage[key];
                btn.click(function() {
                    var uid = el.find('input:checked').attr('id');
                    if (!uid) return;
                    uid = uid.split('|')[1];
                    box.empty();
                    box.append(mkDiv().text(questionTxt));
                    box.append(ld);
                    getJson('resource://poll/' + id + '/null/vote?voteUID=' + uid + '&t=' + (new Date().getTime()), function(ret) {
                        localStorage[key] = new Date().getTime();
                        showResults();
                    });
                });
            }

            var btn2 = $('<input type="button">').css({
                marginLeft: 10,
                minWidth: 75
            }).val(resultsLbl);
            btn2.click(showResults);
            box.append(btn2);
        }
    };
    //-------------------------------------------------------------------------------------
    //					Mobile Poll
    //-------------------------------------------------------------------------------------
    //render.poll = function (id, type, colors, labels, ids, questionTxt, resultsLbl, voteLbl) {
    render.mobilePoll = function(id, data, $el) {
        var type = data.pluginSrc,
            labels = data.optionLabels.split('&').map(decodeURIComponent),
            ids = data.optionUIDs.split(','),
            questionTxt = data.questionTxt,
            resultsLbl = data.resultsLbl,
            voteLbl = data.voteLbl;

        var colors = data.colorList.split(',').map(Color.toRgba).reverse();

        //debug(arguments);
        var el = $el ? $el : $('#' + id);

        el.css({
            background: colors[0],
            color: colors[1]
        });
        var box = mkDiv();
        el.append(box);
        //el.height('auto');
        var ld = mkLoading().css({
            margin: '30px 0'
        });

        showVote();
        el.height(el.height());
        box.height(box.height());

        function showResults() {
            box.empty();
            box.append(mkDiv().text(questionTxt));
            box.append(ld);
            getJson('resource://poll/' + id + '/null/json?ids=' + ids, function(ret) {
                var values = {},
                    total = 0;
                for (var i = 0; i < ret.length; i++) {
                    values[ret[i].voteUID] = Number(ret[i].voteCount);
                    total += Number(ret[i].voteCount);
                }

                ld.remove();
                var opts = mkDiv().css({
                    margin: '15px 0 15px 0',
                    lineHeight: '12px'
                });
                for (var i = 0; i < labels.length; i++) {
                    var val = values[ids[i]] ? values[ids[i]] : 0;
                    var percent = total > 0 ? Math.round(val / total * 100) + '%' : '0%';
                    var rect = mkDiv().css({
                        border: 'solid #ccc 1px',
                        position: 'relative',
                        display: 'inline-block',
                        height: 30,
                        background: '#E9EDF0',
                        'vertical-align': 'middle'
                    }).width(box.width() - 50);
                    var bar = mkDiv().css({
                        position: 'absolute',
                        top: 0,
                        background: colors[2],
                        width: '0',
                        height: '100%',
                        zIndex: 0
                    });
                    rect.append(bar);
                    bar.animate({
                        width: (val / total * 100) + '%'
                    });
                    opts.append(
                        mkDiv().css({
                            fontSize: '11px'
                        }).text(labels[i]),
                        mkDiv().append($('<span></span>').css({
                            display: 'inline-block',
                            height: '100%',
                            width: 0,
                            'vertical-align': 'middle'
                        }), rect, mkDiv().css({
                            display: 'inline-block',
                            display: 'inline-block',
                            'margin-left': 10
                        }).text(percent).width(20)),
                        $('<br>')
                    );
                }
                box.append(opts);
                box.append(mkDiv().css({
                    'float': 'right'
                }).text('Total votes: ').append($('<span></span>').css({
                    'font-weight': 'bold'
                }).text(total)));
                var btn = $('<input type="button" value="Back">');
                btn.click(showVote);
                box.append(btn);
            });
            el.height(el.height());
        }

        function showVote() {
            box.empty().css({
                padding: 15
            });
            box.append(mkDiv().text(questionTxt), mkDiv().css({
                width: '100%',
                height: 2,
                background: '#AAACB1',
                margin: '10px 0'
            }));

            var opts = mkDiv().css({
                margin: '15px 0 15px 0',
                lineHeight: '36px'
            });
            for (var i = 0; i < labels.length; i++) {
                var aid = id + '|' + ids[i];
                opts.append(
                    $('<input type="radio"/>').attr({
                        name: id,
                        id: aid
                    }),
                    $('<label/>').css({
                        fontSize: '12px'
                    }).attr({
                        'for': aid
                    }).text(labels[i]),
                    $('<br>')
                );
            }
            box.append(opts);

            var btn = $('<input type="button">').css({
                minWidth: 75
            }).val(voteLbl);
            box.append(btn);
            var key = 'cbvoted-' + id;
            if (localStorage[key] && (new Date(Number(localStorage[key]) + 1000 * 60 * 60 * 24)) > new Date) {
                btn.attr('disabled', 'disabled');
            } else {
                delete localStorage[key];
                btn.click(function() {
                    var uid = el.find('input:checked').attr('id');
                    if (!uid) return;
                    uid = uid.split('|')[1];
                    box.empty();
                    box.append(mkDiv().text(questionTxt));
                    box.append(ld);
                    getJson('resource://poll/' + id + '/null/vote?voteUID=' + uid + '&t=' + (new Date().getTime()), function(ret) {
                        localStorage[key] = new Date().getTime();
                        showResults();
                    });
                });
            }

            var btn2 = $('<input type="button">').css({
                marginLeft: 10,
                minWidth: 75
            }).val(resultsLbl);
            btn2.click(showResults);
            box.append(btn2);
        }
    };

    //-------------------------------------------------------------------------------------
    //					Counter
    //-------------------------------------------------------------------------------------
    //render.counter = function (id, w, h, skin, digits) {
    render.counter = function(id, data, $el) {
        var m = new CB5.util.geom.Matrix(data.matrix);
        var w = m.getWidth(),
            h = m.getHeight(),
            skin = data.skinSrc.toLowerCase(),
            digits = data.digits;

        var szMap = {
            'counter1': {
                w: 196,
                h: 40
            },
            'counter3': {
                w: 100,
                h: 20
            },
            'counter4': {
                w: 100,
                h: 20
            },
            'counter5': {
                w: 196,
                h: 40
            }
        };
        var el = $el ? $el : $('#' + id);
        el.css({
            width: '',
            height: ''
        });
        var img = new Image;
        var sz = szMap[skin];
        var width = sz.w * w / 100 / 10 * digits;
        var height = sz.h * h / 100;
        el.attr({
            width: width,
            height: height
        });
        img.src = CB5.getRealPath('shared://counter/' + skin + '.png');
        img.onload = function() {
            var ctx = el.get(0).getContext('2d');
            var sw = img.width / 10;
            var sh = img.height;
            var dw = width / digits;
            var dh = height;

            getJson('resource://counter/' + id + '/null/json?builder=' + (typeof sb != "undefined") + '&t=' + (new Date().getTime()), function(ret) {
                var cnt = String(ret.all);
                while (cnt.length < digits) cnt = '0' + cnt;
                for (var i = 0; i < digits; i++)
                    addDigit(cnt.charAt(i), i);
            });

            function addDigit(v, pos) {
                ctx.drawImage(img, v * sw, 0, sw, sh, pos * dw, 0, dw, dh);
            }
        };
    };
    //-------------------------------------------------------------------------------------
    //					Mobile Guestbook
    //-------------------------------------------------------------------------------------

    render.mobileGuestbook = function(id, data, $el) {

        var crtId = 0;
        var direction = 'forward';
        var $entry = $('<div/>').addClass('entry');
        var cw = $el.width() - 40;

        $entry.append(
            $('<div/>').addClass('entry-user').css({
                color: '#38354A',
                display: 'inline-block',
                marginBottom: '5px'
            }),
            $('<div/>').addClass('entry-number').css({
                color: '#9EA6B0',
                display: 'inline-block',
                float: 'right'
            }),
            $('<div/>').addClass('entry-date').css({
                color: '#ABB2BB',
                height: 24,
                paddingLeft: 30,
                paddingTop: 4,
                marginBottom: '5px'
            }),
            $('<div/>').addClass('entry-message').css({
                color: '#ABB2BB',
                width: $,
                overflow: 'hidden'
            })
        ).css({
            width: cw,
            marginRight: 5
        });

        $loadingScreen = $('<div/>').addClass('cb-mobile cb-loadingScreen').css({
            position: 'absolute',
            top: 0,
            left: 0,
            right: 0,
            bottom: 20,
            visibility: 'hidden'
        });

        function getEntry() {
            $prev.css('visibility', 'visible');
            $next.css('visibility', 'visible');
            $entry.css({
                visibility: 'hidden'
            });
            $loadingScreen.css({
                visibility: 'visible'
            });
            CB5.getJson('resource://guestbook/' + id + '/null/json?crtID=' + crtId + '&pageDirection=' + direction +
                '&pageEntries=1&t=' + (new Date().getTime()),
                function(ret) {
                    $tiltle.text('Messages (' + ret.count + ')');
                    if (ret.lst.length > 0) {
                        entry = ret.lst[0];
                        $entry.find('.entry-user').text(entry.name);
                        $entry.find('.entry-number').text(entry.crt).append($('<span/>').text('/' + ret.count).css({
                            color: '#ABB2BB'
                        }));
                        $entry.find('.entry-date').text(entry.created ? entry.created : 'a long time ago');
                        $entry.find('.entry-message').text(entry.message);
                        crtId = entry.ID;
                        $entryHolder.css({
                            height: $entry.height() + 40
                        });
                    }
                    $loadingScreen.css({
                        visibility: 'hidden'
                    });
                    $entry.css({
                        visibility: 'visible'
                    });
                });

        }

        var $entryHolder = $('<div/>').css({
            'min-height': 106,
            padding: 10
        });
        $entryHolder.append($entry);
        var $tiltle = $('<div/>').addClass('cb-mobile cb-guestbook-title');

        var $prev = $('<div/>').addClass('cb-mobile cb-sign-guestbook gb_control').attr({
            direction: 'forward'
        }).css({
            position: 'absolute',
            bottom: 5,
            left: 15
        }).text('previous');

        var $next = $('<div/>').addClass('cb-mobile cb-sign-guestbook gb_control').attr({
            direction: 'backward'
        }).css({
            position: 'absolute',
            bottom: 5,
            right: 15,
            padding: '10px 25px'
        }).text('next');

        var $signBtn = $('<div/>').addClass('cb-mobile cb-sign-guestbook').text('Sign Guestbook').css({
            marginBottom: 15
        });

        $el.append($signBtn, $tiltle, $entryHolder, $prev, $next).css({
            position: 'relative',
            padding: 10
        });

        getEntry(id, 0, 'forward');

        $el.find('.gb_control').click(function(e) {
            var src = $(e.target);
            direction = src.attr('direction');
            getEntry(id, $el.find('.entry').attr('dataId'), direction);
        });
        $signBtn.click(function(e) {
            var src = CB5.getRealPath('resource://guestbook/' + id + '/null/jaddm');
            var domain = location.hostname;
            var pos = domain.lastIndexOf('.cabanova.');
            if (pos != -1)
                domain = domain.slice(0, pos);
            src += '?domain=' + domain;
            $iframe = $('<iframe src="' + src + '" frameborder="0" scrolling="no">').css({
                width: '100%',
                height: '100%'
            });
            $prev.css('visibility', 'hidden');
            $next.css('visibility', 'hidden');
            $entryHolder.empty().append($iframe).css({
                height: 370
            });
            $tiltle.text('Write Your Message');
        });

        //make sure we have only one event
        self['mobi-guestbook-hnd-' + id] = function(evt) {
            //console.debug(evt);
            if (evt.data == 'mobi-guestbook-cancel') {
                $entryHolder.empty().append($entry);
                getEntry();
                return;
            }
            if (evt.data != 'mobi-guestbook-' + id) return;
            crtId = 0;
            $entryHolder.empty().append($entry);
            getEntry();
        };
        self.addEventListener('message', self['mobi-guestbook-hnd-' + id]);

    };

    //-------------------------------------------------------------------------------------
    //					Guestbook
    //-------------------------------------------------------------------------------------
    //render.guestbook = function (id, colorList, signLbl, formPostLbl, btnCancelLbl) {
    render.guestbook = function(id, data, $el) {
        var colorList = data.colorList,
            signLbl = data.signLbl;

        var img = 'data:image/png;base64,' +
            'iVBORw0KGgoAAAANSUhEUgAAABkAAAAmCAYAAAAxxTAbAAAABHNCSVQICAgIfAhkiAAAAhdJREFUSIm1' +
            '1D1yozAYBuD3U6XOHME3cI7AFu6AyQ1MbpB0VLagootvYHKCnbXp3HCDkJOsU5kKbbGYkYX4EeN8My7E' +
            'SHr088oEizqdTisAe87583q9/p46jtkAUsoCgFtVVXE+nxdTx5INQESO8rnknLtTdjSK9ABW0CAyAkyG' +
            'eu9kACi09tPYHRmRPM83AEodIKLQ9/1fUspMh67Xa9mkr1Od48rzfGOYBEQUep73cWsfj8cDEYVqHynl' +
            'hYhc3/e/epGpgC3UIraADUQ2QJIkq7qu95zz5yiK2jSNQWQCpJQXAGEQBH80oADgoImtBr0T0asJYiaA' +
            'iNwBAGhim6ZpG9sgCN703RCRI6Us7iJsujQDcKsO5HnehwlqEUvACmIzgIstxExAHMebuq5LA5BxzpcA' +
            'SgNUJknSvngVYibAFGcAmRDiJYqib865a4CWdV0XJujuxY8B6oc0TRdVVRUAnrS+F8aYu91uuy/eBrCF' +
            'mCWwALC7NQaOzlGPjgaAvRDiTQNuq84AtPjYjkgIIfXZiSjc7Xbqn6IKtLtUIQAQQhwAhB1oJoBmsoOG' +
            'vDS4Ws4dYgFYQS1iAegvfhRiPcAK/xOjAxmAJbppCgH8bhbWheI43mgDVgD+ApDaT13tAsCnoc+nCjXY' +
            '3S6nAtbQXGAWNAewgvqA9wnAZMgE6GGYWoce6GHAEPRQoA96OGCCfgTQoR8DWugfegT7w+kKKnQAAAAA' +
            'SUVORK5CYII=';

        var el = $el ? $el : $('#' + id);
        var args = arguments;
        var colors = colorList.split(',').map(Color.toRgba).reverse();

        var btn = $('<input type="button">').css({
            marginLeft: 7
        }).val(signLbl);
        //make sure we have only one event
        self['guestbook-hnd-' + id] = function(evt) {
            //debug(evt.data);
            if (evt.data != 'guestbook-' + id) return;
            el.empty();
            render.guestbook.apply(null, args);
        };
        self.addEventListener('message', self['guestbook-hnd-' + id]);

        btn.click(function() {
            el.empty();
            var src = CB5.getRealPath('resource://guestbook/' + id + '/null/jadd');
            var domain = location.hostname;
            var pos = domain.lastIndexOf('.cabanova.');
            if (pos != -1)
                domain = domain.slice(0, pos);
            src += '?domain=' + encodeURI(domain);
            el.append($('<iframe src="' + src + '" frameborder="0" scrolling="no">').css({
                position: 'absolute',
                top: 0,
                left: 0,
                width: '100%',
                height: '100%'
            }));
        });

        el.append(btn);

        var slOut = mkDiv().css({
            position: 'absolute',
            top: 29,
            left: 0,
            bottom: 0,
            right: 32,
            overflow: 'hidden'
        });
        var slider = mkDiv().css({
            position: 'absolute',
            top: 0,
            width: '100%'
        });
        el.append(slOut.append(slider));

        el.append(mkImage(img).css({
            position: 'absolute',
            top: 35,
            right: 5,
            cursor: 'pointer'
        }).click(scroll).addClass('up'));
        el.append(mkImage(img).css(transform({
            position: 'absolute',
            bottom: 5,
            right: 5,
            cursor: 'pointer'
        }, 'scaleY(-1)')).click(scroll));

        var index = 0;

        function scroll() {
            var dir = $(this).hasClass('up');
            if ((dir && index <= 0) || (!dir && index > slider.children().length - 2)) return;
            if (dir) index--;
            slider.animate({
                top: (dir ? '+' : '-') + '=' + (slider.children().eq(index).height() + 21)
            });
            if (!dir) index++;
        }
        var monthMap = {
            'Jan': 1,
            'Feb': 2,
            'Mar': 3,
            'Apr': 4,
            'May': 5,
            'Jun': 6,
            'Jul': 7,
            'Aug': 8,
            'Sep': 9,
            'Oct': 10,
            'Nov': 11,
            'Dec': 12
        };

        getJson('resource://guestbook/' + id + '/null/json?crtID=0&pageEntries=1000&t=' + (new Date().getTime()), function(ret) {
            //console.debug(ret);
            var lst = ret.lst.sort(function(x, y) {
                return parseInt(x.crt) > parseInt(y.crt) ? -1 : 1;
            });
            for (var i = 0; i < lst.length; i++) {
                var o = lst[i];
                var txt = mkDiv().css({
                    color: colors[2]
                });
                o.message.split('\r').forEach(function(line) {
                    txt.append(mkDiv().text(line));
                });

                slider.append(mkDiv().css({
                    background: colors[0],
                    margin: '0 7px 7px 7px',
                    padding: 7,
                    boxShadow: '3px 3px 3px rgba(0,0,0,.2)'
                }).append(
                    mkDiv().css({
                        border: 'solid 1px ' + colors[3],
                        padding: 8
                    }).append(
                        mkDiv().css({
                            color: colors[2],
                            'float': 'right'
                        }).text(o.crt + '/' + ret.count),
                        mkDiv().css({
                            color: colors[2]
                        }).text(o.created),
                        mkDiv().css({
                            margin: '5px 0',
                            color: colors[1],
                            fontWeight: 'bold'
                        }).text(o.name),
                        txt
                    )));
            }
        });
    };

    render.shareThis = function(id, shareTxt, moreTxt, $el) {
        var el = $el ? $el : $('#' + id);
        el.css({
            display: 'table'
        });
        var div = mkDiv().css({
            display: 'table-cell',
            verticalAlign: 'middle',
            fontWeight: 'bold',
            color: '#333'
        });
        div.append(shareTxt + ':');

        var data = [{
                name: 'Google+',
                offset: 2,
                width: 800,
                height: 400,
                src: 'https://plus.google.com/share?url=__URL__'
            },
            {
                name: 'Facebook',
                offset: 3,
                width: 670,
                height: 350,
                src: 'https://www.facebook.com/sharer.php?u=__URL__'
            },
            {
                name: 'Delicious',
                offset: 5,
                width: 750,
                height: 500,
                src: 'https://delicious.com/save?v=5&amp;noui&amp;jump=close&amp;url=__URL__'
            },
            {
                name: 'Twitter',
                offset: 0,
                width: 600,
                height: 400,
                src: 'https://twitter.com/share?original_referer=__URL__'
            },
            {
                name: 'MySpace',
                offset: 11,
                width: 600,
                height: 400,
                src: 'https://www.myspace.com/Modules/PostTo/Pages/?u=__URL__'
            },
            {
                name: 'Google Bookmarks',
                offset: 1,
                width: 800,
                height: 600,
                src: 'https://www.google.com/bookmarks/mark?op=add&bkmk=__URL__'
            },
            {
                name: 'Formspring.me',
                offset: 7,
                width: 600,
                height: 400,
                src: 'https://www.formspring.me/share?url=__URL__'
            },
            {
                name: 'Digg',
                offset: 8,
                width: 1024,
                height: 400,
                src: 'https://digg.com/submit?url=__URL__'
            },
            {
                name: 'StumbleUpon',
                offset: 9,
                width: 800,
                height: 500,
                src: 'https://www.stumbleupon.com/submit?url=__URL__'
            },
            {
                name: 'Blogger',
                offset: 10,
                width: 800,
                height: 600,
                src: 'https://www.blogger.com/blog_this.pyra?t=&u=__URL__?sms_ss=blogger&n=__URL__'
            },
            {
                name: 'LinkedIn',
                offset: 12,
                width: 550,
                height: 380,
                src: 'https://www.linkedin.com/shareArticle?mini=true&url=__URL__'
            }
        ];

        function addThumb(div, index, useText) {
            var o = data[index];
            var url = CB5.getRealPath('shared://../topbanner/icons-social.png');
            var sp = $('<span/>').css({
                display: 'inline-block',
                background: 'url(' + url + ') no-repeat',
                width: 16,
                height: 16,
                verticalAlign: 'top',
                marginLeft: 6,
                backgroundPosition: '0 -' + (o.offset * 16) + 'px',
                cursor: 'pointer'
            });
            sp.click(function() {
                if (o.sx) {
                    eval(o.onClick)();
                    return;
                }

                var sx = typeof window.screenX != 'undefined' ? window.screenX : window.screenLeft;
                var sy = typeof window.screenY != 'undefined' ? window.screenY : window.screenTop;
                var ow = typeof window.outerWidth != 'undefined' ? window.outerWidth : document.documentElement.clientWidth;
                var oh = typeof window.outerHeight != 'undefined' ? window.outerHeight : (document.documentElement.clientHeight - 22);
                sx = (sx < 0) ? window.screen.width + sx : sx;

                var _w = Math.min(o.width, window.screen.width);
                var _h = Math.min(o.height, window.screen.height);

                var _left = parseInt(sx + ((ow - _w) / 2), 10);
                var _top = parseInt(sy + ((oh - _h) / 2.5), 10);

                var url = o.src.replace(/__URL__/g, encodeURIComponent(window.location.href));

                window.open(url, null,
                    'width=' + _w + ',height=' + _h + ',' +
                    'toolbar=no,directories=no,status=no,menubar=no,resizable=no,' +
                    'top=' + _top + ',left=' + _left
                );
            });
            div.append(sp);
            if (useText)
                sp.css({
                    width: 140,
                    padding: '0 0 0 18px'
                }).text(o.name);
        }

        addThumb(div, 1);
        addThumb(div, 3);
        addThumb(div, 0);
        var btn = $('<span/>').css({
            display: 'inline-block',
            height: 16,
            borderRadius: 3,
            background: '#EA7A58',
            marginLeft: 6,
            color: '#fff',
            cursor: 'pointer',
            padding: '0 3px'
        }).text('+ ' + moreTxt);

        var popup = null;
        btn.click(function() {
            if (!popup) {
                popup = mkDiv().css({
                    position: 'absolute',
                    top: parseFloat(el.css('top')) + el.height(),
                    width: 800,
                    height: 100,
                    display: 'none',
                    zIndex: 2000
                });
                var o = {
                    width: 650,
                    height: '100%',
                    margin: '0 auto',
                    background: '#fefefe',
                    lineHeight: '20px',
                    padding: '6px 6px 0 0',
                    border: 'solid 2px #ccc',
                    fontSize: '13px',
                    fontFamily: 'sans-serif',
                    color: '#333'
                };
                o.WebkitBoxShadow = o.MozBoxShadow = o.boxShadow = '0 2px 6px rgba(0,0,0,.3)';
                var div2 = mkDiv().css(o);
                var xBtn = mkImage(CB5.getRealPath('shared://../topbanner/icon-close.png')).
                css({
                    'float': 'right',
                    cursor: 'pointer'
                });
                xBtn.click(function() {
                    popup.detach();
                });
                popup.append(div2.append(xBtn));
                for (var i = 0; i < data.length; i++) {
                    addThumb(div2, i, true);
                }
            }
            popup.hide();
            el.parent().append(popup);
            popup.slideDown();
        });
        div.append(btn);
        el.append(div);
    };
    //render.soundPlugin = function (id, src, skin, autoplay, loop, volume, colors) {
    render.soundPlugin = function(id, data) {
        var src = CB5.getRealPath(data.src),
            skin = data.pluginSrc.slice(0, -4),
            autoplay = data.propertyList.autoPlay,
            loop = data.propertyList.loop,
            volume = parseInt(data.propertyList.volume),
            colors = data.colorList.split(',');
        if (colors.length > 2)
            colors = [colors[2], colors[3]];
        colors = colors.join(',');
        CB5.loadScript(CB5.getRealPath('shared://plugin/SoundPlugin.c.js'), function() {
            //console.log(src, skin, autoplay, loop, volume, colors);
            CB5.plugin.SoundPlugin(id, src, skin, autoplay, loop, volume, colors);
        });
    };

    render.navigation2 = function(id, data) {
        var skin = /([^\/]+)\.swf/.exec(data.pluginSrc)[1];
        if (skin == 'Navigation') skin = 'Navigation2';
        CB5.fontsLoaded(function() {
            CB5.loadScript(CB5.getRealPath('shared://plugin/' + skin + '.c.js'), function() {
                CB5.plugin.Navigation2(id, data);
            });
        });
    };

    render.banner = function(id) {
        //
    };

    render.glossary = function(id, data, $el) {
        if ($el) {
            var isMobile = true;
            var el = $el;
            var map = data.map;
            var formats = data.formats;
        } else {
            var isMobile = false;
            var el = $('#' + id);
            var map = data.map == "" ? {} : JSON.parse(data.map);
            var formats = JSON.parse(data.formats);
        }

        var magnIcon = 'data:image/png;base64,' +
            'iVBORw0KGgoAAAANSUhEUgAAABUAAAAVCAIAAAAmdTLBAAAAAXNSR0IArs4c6QAAAAZiS0dEAP8A/wD/' +
            'oL2nkwAAAAlwSFlzAAALEwAACxMBAJqcGAAAAAd0SU1FB9sCDg4PKeGGy7YAAAKTSURBVDjLhVQ9aypB' +
            'FJ3ZWZSkiMGPoFitpgiJlUtIYSxSCQEJaKOCjf/AxsImpZDCJikstPUHBJIgIaUIAYuAChoEYVdUDCT4' +
            'xaq7M6+YvHFVJKdYdu89586du2cGYozBOiCEAABCCMaY4zj6qWkahJDjOEII48iyzG2LCSGEEAghQghC' +
            'OJ/PCSEIISqmSgZeL2NPAMByuSyXy7VabTqd8jwvCMLl5eXR0dHmevr+mX42m93f37+/v0MIHQ7HaDSa' +
            'TCZ2uz2RSIiiyPiyLAOMMcaY9kxfFEXJZDLBYPDh4aHb7dLIy8tLLBaLRCKfn5/kPyRJWukxxqqqEkIe' +
            'Hx8DgUChUCDrqFar4XD49vZWr+f0zSOEMMa1Ws1kMt3c3NA4pQIAvF6vz+f7+Pjo9/tMtTn/r6+vXq/n' +
            'cDhMJhMV09KapgEAnE6nwWD4+fnZnD/jUepisaBzpRNl7OVyuVgs9L+Q2xi+zWYTBKHZbMqyzOpijBFC' +
            'qqpWKhVFUSwWy0pP16RU2uTx8fF4PM7lcrPZjGY5jgMA5PP5SqVydXVltVpX/bP2IIQ8z3c6naenp729' +
            'vbe3t36/f319fXZ29v39/fz8/Pr66na74/H4mn+YWwEAnU4nnU7X6/WDg4PT09N2uz0ej/f391VVVRRF' +
            'FMVUKuVyufT+4Zm40Wik0+lWq2U0GkOhUDKZHA6HpVJJkqTDw8Pz83NRFNlOVyOk5imXy36/3+12ezye' +
            'u7s7shvMrL/+I4SUSqWLiwtBEDweTzabpTlN0/AWqJ6V+NUXi0Wz2XxyclIsFmmCGvlPSJLEAwCi0ehg' +
            'MLBYLNFolG4PIcQcpb8wNs747/nV+2lbptczDrt/eH095gW9Z3dF1vyzK/0n/gEaKjrHVOERxgAAAABJ' +
            'RU5ErkJggg==';

        var spacing = data.spacing ? data.spacing : 3;
        var wWidth = data.wWidth ? data.wWidth : Math.floor(el.width() / 5);
        wWidth = Math.floor(el.width() / 5);
        [showSearch, searchPosition, searchPlaceholder] = data.showSearch.split(',');
        [borderWidth, borderColor] = data.cellBorder.split(',');
        var cellBorderCss = 'solid ' + borderWidth + 'px #' + borderColor.substr(2);
        var cellPaddings = data.padding.split(',').join('px ') + 'px';

        var page = 1;

        var textCss = {};

        $.each(['wordsFormat', 'explanationsFormat', 'navigationFormat', 'paginationFormat'], function(index, key) {
            var props = {}
            var a = formats[key].split(',');
            for (var i = 0; i < a.length; i++) {
                [name, property] = a[i].split(':');
                props[name] = property;
            }
            textCss[key] = {
                fontFamily: props.font + ',Arial,sans-serif',
                fontSize: props.size + 'px',
                textDecoration: props.underline ? 'underline' : 'none',
                textAlign: props.align,
                fontStyle: props.italic ? 'italic' : '',
                fontWeight: props.bold ? 'bold' : '',
                color: Color.toRgba(props.color)
            }
        });

        var nav = $('<div/>').css({
            width: '100%',
            padding: 0,
            marginBottom: 20,
            overflow: 'hidden'
        });
        var nav2 = $('<div/>').css({
            width: '100%',
            padding: 0,
            marginBottom: 20,
            overflow: 'auto',
            paddingBottom: '10p',
            display: isMobile ? 'block' : 'table'
        }).css(textCss.navigationFormat).addClass('hideScrollbar');

        nav.append(nav2);

        var toolBox = $('<div/>');

        var search = $('<input/>').attr({
            type: 'search',
            placeholder: searchPlaceholder
        }).css({
            margin: '0px 10px',
            padding: '2px 2px 2px 26px',
            'box-sizing': 'border-box',
            background: '#fff url(' + magnIcon + ') no-repeat 3px 50%',
            marginRight: 15

        }).on('input', '', function() {
            show("all", $(this).val());
        });

        var definitionCount = $('<select/>').append(
                $('<option/>').text("20 definitii pe pagina").val("20")).append(
                $('<option/>').text("10 definitii pe pagina").val("10")).append(
                $('<option/>').text("5 definitii pe pagina").val("5"))
            .on('change', '', function() {
                page = 1;
                showGlossaryPage();
            }).css({
                border: '1px solid #ccc',
                padding: '8px 4px'
            })
        toolBox.append(definitionCount).append(search);

        var pagination = $('<div/>').append($('<ul/>').css({
            display: 'table',
            width: isMobile ? '80%' : '100%'
        }).css(textCss.paginationFormat));

        function selectLetter() {
            search.val('');
            nav2.children().removeClass('selected');
            $(this).addClass('selected');
            showGlossaryPage();
        }

        function selectPage() {
            var selected = $(this);
            page = selected.attr('data-page');
            if (!page || page == 'first') page = 1;
            else if (page == 'last') {

            } else
                page = parseInt(page);
            //page = Math.min(Math.max(1, page), pagination.find('li').length - 4);
            pagination.find('li').removeClass('selected');
            selected.addClass('selected');
            showGlossaryPage();
        }

        nav2.append($('<span/>')
            .attr('data-letter', 'all')
            .text("All")
            .css({
                display: isMobile ? 'inline' : 'table-cell',
                margin: '0px 5px',
                'text-align': 'center',
                cursor: 'pointer'
            })
            .click(selectLetter));

        for (var i = 97; i <= 122; i++) {
            var letter = String.fromCharCode(i);
            var li = $('<span/>')
                .attr('data-letter', letter)
                .text(letter)
                .css({
                    display: isMobile ? 'inline' : 'table-cell',
                    margin: '0px 5px',
                    'text-align': 'center',
                    cursor: 'pointer'
                });
            if (map[letter])
                li.click(selectLetter);
            nav2.append(li);

        }
        if (showSearch == 'true') {
            if (searchPosition == 'before')
                el.append(toolBox).append(nav);
            else
                el.append(nav).append(toolBox);
        } else
            el.append(nav);

        search.width(Math.min(300, toolBox.width() - definitionCount.width() - 35));

        var table = $('<table/>').css({
            display: 'table',
            marginTop: 20,
            tableLayout: 'fixed',
            width: el.width(),
            'border-collapse': 'collapse',
            'border-spacing': spacing + 'px'
        });
        el.append(table).append(pagination);

        function sortWords(obj, search) {
            list = [];
            $.each(obj, function(k, v) {
                if (!search || k.toLowerCase().indexOf(search.toLowerCase()) != -1)
                    list.push([k, v]);
            });
            list.sort();
            return list;
        }

        function refreshTable(list) {
            for (var i = 0; i < list.length; i++) {
                tr = $('<tr/>');
                div1 = $('<td/>').css(textCss.wordsFormat).text(list[i][0]).css({
                    width: wWidth,
                    verticalAlign: 'middle',
                    padding: cellPaddings,
                    border: cellBorderCss,
                    wordWrap: 'break-word'
                });
                div2 = $('<td/>').css(textCss.explanationsFormat).text(list[i][1]).css({
                    padding: cellPaddings,
                    border: cellBorderCss
                });
                tr.append(div1).append(div2);
                table.append(tr);
            }
            CB5.updatePageHeight();
        }

        function refreshTable2(list) {
            for (var i = 0; i < list.length; i++) {
                tr = $('<tr/>');
                div1 = $('<div/>').css(textCss.wordsFormat).text(list[i][0]).css({
                    textAlign: 'center',
                    verticalAlign: 'middle',
                    wordWrap: 'break-word'
                }).click(function() {
                    table.find('.slideExplanation').slideUp();
                    var next = $(this).next();
                    if (next.hasClass('visible')) {
                        next.removeClass('visible')
                    } else {
                        table.find('.visible').removeClass('visible');
                        next.slideDown().addClass('visible');
                    }
                });
                div2 = $('<div/>').css(textCss.explanationsFormat).text(list[i][1]).css({
                    marginTop: 30,
                    display: 'none'
                }).addClass('slideExplanation').click(function() {
                    $(this).removeClass('visible').slideUp();
                });
                table.append($('<tr/>').append($('<td/>').css({
                    padding: cellPaddings,
                    border: cellBorderCss,
                }).append(div1).append(div2)));
            }
            CB5.updatePageHeight();
        }

        function drawPagination(listLength, count) {
            var liCss = {
                cursor: 'pointer',
                display: 'table-cell',
                textAlign: 'center'
            };
            var ul = pagination.find('ul').empty();
            ul.append($('<li/>').css(liCss).attr('data-page', 'first').click(selectPage).text("<<"));
            //ul.append($('<li/>').css(liCss).attr('data-page','prev').click(selectPage).text("<"));
            for (var i = Math.max(page - 2, 1); i <= Math.min(Math.ceil(listLength / count), page + 2); i++) {
                ul.append(
                    $('<li/>').text(i).css(liCss).attr({
                        'data-page': i
                    }).click(selectPage)
                )
            }
            //ul.append($('<li/>').css(liCss).attr('data-page','next').click(selectPage).text(">"));
            ul.append($('<li/>').css(liCss).attr('data-page', Math.ceil(listLength / count)).click(selectPage).text(">>"));
            ul.find('li[data-page="' + page + '"]').addClass('selected');
        }

        function show(letter) {
            var searchFor = search.val();
            table.empty();
            var count = definitionCount.val();
            var list = [];
            if (letter.toLowerCase() == 'all') {
                var aux = {};
                for (var i = 97; i <= 122; i++) {
                    var l = String.fromCharCode(i);
                    if (!map[l]) continue;
                    aux = $.extend(aux, map[l]);
                }
                list = aux;
            } else {
                list = map[letter];
            }
            list = sortWords(list, searchFor);
            drawPagination(list.length, count);
            list = list.slice(count * (page - 1), count * page);
            isMobile ? refreshTable2(list) : refreshTable(list);
        }

        function showGlossaryPage() {
            letter = nav2.find('.selected').attr('data-letter');
            show(letter);
        }

        nav2.children().eq(0).trigger('click');
        setTimeout(CB5.updatePageHeight, 1000);
    };

    render.quiz = function(id, data, $el) {
        if (!$el) {
            var el = $('#' + id);
            var texts = JSON.parse(data.texts);
            var formats = JSON.parse(data.formats);
            var buttonFormat = JSON.parse(data.buttonFormat);
        } else {
            var el = $el;
            var texts = data.texts;
            var formats = data.formats;
            var buttonFormat = data.buttonFormat;
        }
        var pool = JSON.parse(data.questions);
        var noQuestions = parseInt(data.noQuestions);
        var questions = [];
        var result = 0;
        var textsCss = {};

        /* styles */

        $.each(formats, function(k, v) {
            var aux1 = v.split(',')
            var aux2 = {}
            $.each(aux1, function(index, pair) {
                [name, value] = pair.split(':');
                aux2[name] = value;
            })
            textsCss[k] = {
                fontFamily: aux2.font + ',Arial,sans-serif',
                fontSize: aux2.size + 'px',
                textDecoration: aux2.underline ? 'underline' : 'none',
                textAlign: aux2.align,
                fontStyle: aux2.italic ? 'italic' : '',
                fontWeight: aux2.bold ? 'bold' : '',
                color: Color.toRgba(aux2.color)
            }
        });

        var buttonExtraCss = {
            marginTop: 10,
            'background-color': Color.toRgba(buttonFormat.backgroundColor),
            borderStyle: buttonFormat.borderStyle,
            borderColor: Color.toRgba(buttonFormat.borderColor),
            borderWidth: buttonFormat.borderWidth + 'px'
        };

        /* end styles */

        for (var i = 0; i < noQuestions; i++) {
            index = Math.floor(Math.random() * pool.length);
            var aux = pool.splice([index], 1);
            questions.push(aux[0]);
        }

        function showResults() {
            el.empty().append($('<div/>').text(texts.resultText.replace('$number', result / 2).replace('$total', noQuestions)).css(textsCss.resultFormat));
        }

        function submitAnswer() {
            var qid = parseInt(el.attr('data-qid'));
            var question = questions[qid];
            var aid = el.find('input[type="radio"][name="question' + qid + '"]:checked').val();
            var mHolder = el.find('.questionMessage').empty();
            if (!aid) {
                mHolder.append(
                    $('<div/>').css(textsCss.explanationFormat).text(texts.notAnswered)
                );
            } else {
                el.find('input[type="radio"]').attr('disabled', 'true');
                var isCorrect = question.correct == aid;
                if (isCorrect) result++;
                mHolder.append(
                        $('<div/>').css(isCorrect ? textsCss.correctFormat : textsCss.incorrectFormat).text(isCorrect ? texts.correctText : texts.incorrectText))
                    .append(
                        $('<div/>').css(textsCss.explanationFormat).text(question.e)
                    ).slideDown();
                var button = el.find('button');
                if (qid < noQuestions - 1) {
                    button.text(texts.buttonNext).click(function() {
                        mHolder.slideUp();
                        showQuestion(qid + 1);
                    })
                } else {
                    button.text(texts.buttonResults).click(showResults)
                }

            }

        }

        function showQuestion(index) {
            el.empty().attr('data-qid', index);
            var question = questions[index];
            var countHolder = $('<div/>').text(texts.countingText.replace('$number', index + 1).replace('$total', noQuestions)).css(textsCss.countingFormat).css({
                marginBottom: 10
            });
            var qHolder = $('<div/>').text(question.q).css(textsCss.questionFormat).css({
                marginBottom: 15
            });
            var aHolder = $('<div/>');
            var mHolder = $('<div/>').addClass('questionMessage');
            var submitB = $('<button/>').text(texts.buttonSubmit).click(function(e) {
                e.preventDefault();
                submitAnswer();
            }).css(textsCss.buttonFormat).css(buttonExtraCss);
            $.each(question.answers, function(k, v) {
                var label = $('<label/>').append(
                    $('<input/>').attr({
                        type: 'radio',
                        name: 'question' + index,
                        value: v.id
                    }).css({
                        margin: '0px 5px'
                    })
                ).attr('data-aid', v.id).css(textsCss.answerFormat)
                label.html(label.html() + v.text);
                aHolder.append(label).append($('<br/>'));
            });
            el.append(countHolder).append(qHolder).append(aHolder).append(mHolder).append(submitB);
            setTimeout(CB5.updatePageHeight, 1000);
        }

        showQuestion(0)
        setTimeout(CB5.updatePageHeight, 1000);
    };

    render.cookieConsentBanner = function(id, data) {
        var el = $('#' + id);
        if (data.linkPage == "active") {
            var parent = el.parent();
            parent.before(el);
            parent.remove();
        }
        el.css({
            position: 'fixed',
            width: '100%',
            padding: 15,
            backgroundColor: '#4b4b4b',
            zIndex: 10000,
            left: 0
        });
        el.css(data.position, '0');
        textContainer = mkDiv();
        textContainer.text(data.infoText).css({
            fontFamily: 'Open Sans',
            fontSize: 16,
            color: '#fff',
            display: 'inline-block',
            padding: 5
        });

        if (data.linkPage == "active") {
            li = $('<a></a>');
            li.attr("href", data.link[1]);
            li.attr("target", data.link[0]);
            li.text(data.linkText);
            li.css({
                fontFamily: 'Open Sans',
                fontSize: 16,
                color: '#50b6e9',
                marginLeft: 10
            });
            textContainer.append(li);
        }

        button = mkDiv();
        button.css({
            background: '#e76049',
            fontFamily: 'Open Sans',
            fontSize: 16,
            color: '#fff',
            display: 'inline-block',
            float: 'right',
            padding: '5px 7px',
            cursor: 'pointer'
        }).text(data.buttonText);
        button.click(function(e) {
            e.stopPropagation();
            var d = new Date();
            d.setTime(d.getTime() + 30 * 24 * 60 * 60 * 1000);
            var expires = d.toUTCString();
            document.cookie = "__cookieConsent;" + expires;
            el.hide();
        });
        var cookies = document.cookie.split(';');
        var show = true;
        for (i = 0; i < cookies.length; i++) {
            if (cookies[i].indexOf("__cookieConsent") != -1)
                show = false;
        }
        el.append(textContainer, button);
        if (!show) el.remove();
    };

    var statesData = [];
    render.states = function(id, list, name, isPopup) {
        statesData.push({
            switchName: name,
            isPopoup: parseInt(isPopup),
            list: list
        });
    };
    var popElements;
    self.setPageState = function(states, sw) {
        function removePop() {
            popElements.forEach(function(id) {
                $('#' + id).hide();
            });
            popElements = null;
        }
        var changed = [];
        if (!sw) {
            if (typeof states == 'string') states = [states];
            for (var i = 0; i < states.length; i++) {
                var state = states[i];
                self.getPageStatesData().forEach(function(list) {
                    var names = list.list.map(function(item) {
                        return item.name;
                    });
                    if (names.indexOf(state) == -1) return;
                    list.list.forEach(function(item) {
                        if (!item.show) return;
                        item.show.forEach(function(id) {
                            var n = document.getElementById(id);
                            if (!n) return;
                            n.style.display = item.name == state ? 'block' : 'none';
                            changed.push(id);
                        });
                    });
                });
            }
        } else {
            var switchList = self.getPageStatesData().filter(function(item) {
                return item.switchName == sw;
            });
            var theSwitch = switchList[0];
            theSwitch.list.forEach(function(item) {
                if (!item.show) return;
                item.show.forEach(function(id) {
                    var n = document.getElementById(id);
                    if (!n) return;
                    n.style.display = item.name == states ? 'block' : 'none';
                    changed.push(id);
                });
            });
            if (theSwitch.isPopoup == 1) {
                if (popElements) {
                    removePop();
                    return;
                }
                popElements = changed;
                popElements.forEach(function(id) {
                    $('#' + id).css('z-index', 1000);
                });

            }
        }
        CB5.updatePageHeight();
        return changed;
    };


    self.setPageStatePopup = function(state, sw) {
        if (popElements) {
            removePop();
            return;
        }
        popElements = setPageState(state, sw);
        popElements.forEach(function(id) {
            $('#' + id).css('z-index', 1000);
        });

        setTimeout(function() {
            $(window).on('click.cbnv_lang', function(e) {
                $(window).off('.cbnv_lang');
                popElements && removePop();
            });
        }, 1);

        function removePop() {
            popElements.forEach(function(id) {
                $('#' + id).hide();
            });
            popElements = null;
        }
    };

    self.getPageStatesData = function() {
        return statesData;
    }

})();