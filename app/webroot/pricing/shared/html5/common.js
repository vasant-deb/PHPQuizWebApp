/*
 * jQuery scrollintoview() plugin and :scrollable selector filter
 *
 * Version 1.8 (14 Jul 2011)
 * Requires jQuery 1.4 or newer
 *
 * Copyright (c) 2011 Robert Koritnik
 * Licensed under the terms of the MIT license
 * http://www.opensource.org/licenses/mit-license.php
 */
(function(f) {
    var c = {
        vertical: {
            x: false,
            y: true
        },
        horizontal: {
            x: true,
            y: false
        },
        both: {
            x: true,
            y: true
        },
        x: {
            x: true,
            y: false
        },
        y: {
            x: false,
            y: true
        }
    };
    var b = {
        duration: "fast",
        direction: "both"
    };
    var e = /^(?:html)$/i;
    var g = function(k, j) {
        j = j || (document.defaultView && document.defaultView.getComputedStyle ? document.defaultView.getComputedStyle(k, null) : k.currentStyle);
        var i = document.defaultView && document.defaultView.getComputedStyle ? true : false;
        var h = {
            top: (parseFloat(i ? j.borderTopWidth : f.css(k, "borderTopWidth")) || 0),
            left: (parseFloat(i ? j.borderLeftWidth : f.css(k, "borderLeftWidth")) || 0),
            bottom: (parseFloat(i ? j.borderBottomWidth : f.css(k, "borderBottomWidth")) || 0),
            right: (parseFloat(i ? j.borderRightWidth : f.css(k, "borderRightWidth")) || 0)
        };
        return {
            top: h.top,
            left: h.left,
            bottom: h.bottom,
            right: h.right,
            vertical: h.top + h.bottom,
            horizontal: h.left + h.right
        }
    };
    var d = function(h) {
        var j = f(window);
        var i = e.test(h[0].nodeName);
        return {
            border: i ? {
                top: 0,
                left: 0,
                bottom: 0,
                right: 0
            } : g(h[0]),
            scroll: {
                top: (i ? j : h).scrollTop(),
                left: (i ? j : h).scrollLeft()
            },
            scrollbar: {
                right: i ? 0 : h.innerWidth() - h[0].clientWidth,
                bottom: i ? 0 : h.innerHeight() - h[0].clientHeight
            },
            rect: (function() {
                var k = h[0].getBoundingClientRect();
                return {
                    top: i ? 0 : k.top,
                    left: i ? 0 : k.left,
                    bottom: i ? h[0].clientHeight : k.bottom,
                    right: i ? h[0].clientWidth : k.right
                }
            })()
        }
    };
    f.fn.extend({
        scrollintoview: function(j) {
            j = f.extend({}, b, j);
            j.direction = c[typeof(j.direction) === "string" && j.direction.toLowerCase()] || c.both;
            var n = "";
            if (j.direction.x === true) {
                n = "horizontal"
            }
            if (j.direction.y === true) {
                n = n ? "both" : "vertical"
            }
            var l = this.eq(0);
            var i = l.closest(":scrollable(" + n + ")");
            if (i.length > 0) {
                i = i.eq(0);
                var m = {
                    e: d(l),
                    s: d(i)
                };
                var h = {
                    top: m.e.rect.top - (m.s.rect.top + m.s.border.top),
                    bottom: m.s.rect.bottom - m.s.border.bottom - m.s.scrollbar.bottom - m.e.rect.bottom,
                    left: m.e.rect.left - (m.s.rect.left + m.s.border.left),
                    right: m.s.rect.right - m.s.border.right - m.s.scrollbar.right - m.e.rect.right
                };
                var k = {};
                if (j.direction.y === true) {
                    if (h.top < 0) {
                        k.scrollTop = m.s.scroll.top + h.top
                    } else {
                        if (h.top > 0 && h.bottom < 0) {
                            k.scrollTop = m.s.scroll.top + Math.min(h.top, -h.bottom)
                        }
                    }
                }
                if (j.direction.x === true) {
                    if (h.left < 0) {
                        k.scrollLeft = m.s.scroll.left + h.left
                    } else {
                        if (h.left > 0 && h.right < 0) {
                            k.scrollLeft = m.s.scroll.left + Math.min(h.left, -h.right)
                        }
                    }
                }
                if (!f.isEmptyObject(k)) {
                    if (e.test(i[0].nodeName)) {
                        i = f("html,body")
                    }
                    i.animate(k, j.duration).eq(0).queue(function(o) {
                        f.isFunction(j.complete) && j.complete.call(i[0]);
                        o()
                    })
                } else {
                    f.isFunction(j.complete) && j.complete.call(i[0])
                }
            }
            return this
        }
    });
    var a = {
        auto: true,
        scroll: true,
        visible: false,
        hidden: false
    };
    f.extend(f.expr[":"], {
        scrollable: function(k, i, n, h) {
            var m = c[typeof(n[3]) === "string" && n[3].toLowerCase()] || c.both;
            var l = (document.defaultView && document.defaultView.getComputedStyle ? document.defaultView.getComputedStyle(k, null) : k.currentStyle);
            var o = {
                x: a[l.overflowX.toLowerCase()] || false,
                y: a[l.overflowY.toLowerCase()] || false,
                isRoot: e.test(k.nodeName)
            };
            if (!o.x && !o.y && !o.isRoot) {
                return false
            }
            var j = {
                height: {
                    scroll: k.scrollHeight,
                    client: k.clientHeight
                },
                width: {
                    scroll: k.scrollWidth,
                    client: k.clientWidth
                },
                scrollableX: function() {
                    return (o.x || o.isRoot) && this.width.scroll > this.width.client
                },
                scrollableY: function() {
                    return (o.y || o.isRoot) && this.height.scroll > this.height.client
                }
            };
            return m.y && j.scrollableY() || m.x && j.scrollableX()
        }
    })
})(jQuery);


if (!Function.prototype.bind) {
    Function.prototype.bind = function(oThis) {
        if (typeof this !== 'function')
            throw new TypeError('Function.prototype.bind - what is trying to be bound is not callable');
        var aArgs = Array.prototype.slice.call(arguments, 1),
            fToBind = this,
            fNOP = function() {},
            fBound = function() {
                return fToBind.apply(this instanceof fNOP && oThis ? this : oThis,
                    aArgs.concat(Array.prototype.slice.call(arguments)));
            };
        fNOP.prototype = this.prototype;
        fBound.prototype = new fNOP();
        return fBound;
    };
}

(function() {
    if (!self.CB5) self.CB5 = {};
    var util = {};
    CB5.config = {};
    CB5.util = util;
    CB5.plugin = {};
    CB5.emailReg = /^[a-z0-9!#$%&'*+\/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+\/=?^_`{|}~-]+)*@(?:[a-zöäëß0-9](?:[a-zöäëß0-9-]*[a-zöäëß0-9])?\.)+(?:[a-z]{2}|aero|asia|biz|cat|com|coop|edu|gov|info|int|jobs|mil|mobi|museum|name|net|org|pro|tel|travel|xxx)$/i;

    CB5.isTouch = /iPad|iPhone|iPod|Android/.test(navigator.userAgent);
    CB5.isIOS = /iPad|iPhone|iPod/.test(navigator.userAgent);

    CB5.vendorCss = function(o, prop, value) {
        o[prop] = value;
        prop = prop.charAt(0).toUpperCase() + prop.substr(1);
        o['Webkit' + prop] = o['Moz' + prop] = o['ms' + prop] = o['O' + prop] = value;
        return o;
    };
    CB5.scrollTop = function() {
        return Math.max($('body').scrollTop(), $('html').scrollTop());
    };


    CB5.getRealPath = function(path) {
        var map = {
            user: 'files',
            shared: 'shared/html5',
            resource: CB5.config.rootUrl + 'action/resource',
            thumb: CB5.config.rootUrl + 'action/thumb',
            search: CB5.config.rootUrl + 'action/search',
            topbanner: CB5.config.rootUrl + 'action/topbanner',
            library: 'lib/browse'
        };
        var a = path.split('://');
        return (a[0] in map) ? map[a[0]] + '/' + a[1] : path;
    };


    var Class = function() {};
    Class.extend = function(config) {
        var proto = new this();
        for (var name in config)
            proto[name] = config[name];
        var Cls = config.init;
        Cls.prototype = proto;
        Cls.extend = this.extend;

        proto.constructor = Cls;
        proto.super = this.prototype;
        return Cls;
    };
    util.Class = Class;


    var loadScriptMap = {};
    util.loadScript = function(url, callback) {

        if (url instanceof Array) {
            var cnt = url.length;
            url.forEach(function(u) {
                util.loadScript(u, function() {
                    cnt--;
                    if (cnt == 0) callback();
                });
            });
            return;
        }

        if (loadScriptMap[url]) {
            if (loadScriptMap[url] == 'loaded') callback();
            else loadScriptMap[url].push(callback);
            return;
        }

        var script = document.createElement('script');
        loadScriptMap[url] = [callback];
        script.type = 'text/javascript';
        if (callback) script.addEventListener('load', function() {
            loadScriptMap[url].forEach(function(cb) {
                cb();
            });
            loadScriptMap[url] = 'loaded';
        });
        script.src = url;
        document.body.appendChild(script);
    };
    CB5.loadScript = util.loadScript;



    util.noiseFill = function(color, color2, intensity, opacity) {

        var n = parseInt('0x' + color);
        var argb = {
            a: (0xFF000000 & n) >>> 24,
            r: (0xFF0000 & n) >>> 16,
            g: (0xFF00 & n) >>> 8,
            b: 0xFF & n
        };

        var size = 50;
        var canvas = document.createElement('canvas');
        canvas.width = canvas.height = size;

        var ctx = canvas.getContext('2d');
        ctx.fillStyle = util.Color.toRgba(color, true);
        ctx.fillRect(0, 0, size, size);
        var imgData = ctx.getImageData(0, 0, size, size),
            numPixels = Math.round(intensity * Math.pow(size, 2));

        n = parseInt('0x' + color2);
        var noiseArgb = {
            a: (0xFF000000 & n) >>> 24,
            r: (0xFF0000 & n) >>> 16,
            g: (0xFF00 & n) >>> 8,
            b: 0xFF & n
        };

        // Add color to random pixels in the canvas
        while (numPixels--) { // Read about the double bitwise NOT trick here: goo.gl/6DPpt
            var x = ~~(Math.random() * canvas.width),
                y = ~~(Math.random() * canvas.height),
                index = (x + y * imgData.width) * 4;

            var op = Math.random() * opacity * noiseArgb.a / 255;
            imgData.data[index] = ~~(argb.r * (1 - op) + noiseArgb.r * op); //R
            imgData.data[index + 1] = ~~(argb.g * (1 - op) + noiseArgb.g * op); //G
            imgData.data[index + 2] = ~~(argb.b * (1 - op) + noiseArgb.b * op); //B
        }

        ctx.putImageData(imgData, 0, 0);
        return canvas.toDataURL('image/png');
    };


    util.round4 = function(n) {
        return Math.round(n * 10000) / 10000;
    };

    // -----------------------------------------------------------------------
    // Drawing on canvas
    // -----------------------------------------------------------------------
    util.Drawing = {

        drawStar: function(g, x, y, points,
            innerRadiusX,
            innerRadiusY,
            outerRadiusX,
            outerRadiusY,
            angle) {
            var count = Math.abs(points);

            if (count > 2) {
                var step = (Math.PI * 2) / points;
                var halfStep = step / 2;

                var startAngle = (angle / 180) * Math.PI;
                g.moveTo(x + (Math.cos(startAngle) * outerRadiusX), y - (Math.sin(startAngle) * outerRadiusY));

                var dx;
                var dy;

                // draw lines
                for (var n = 1; n <= count; n++) {
                    dx = x + Math.cos(startAngle + (step * n) - halfStep) * innerRadiusX;
                    dy = y - Math.sin(startAngle + (step * n) - halfStep) * innerRadiusY;
                    g.lineTo(dx, dy);
                    dx = x + Math.cos(startAngle + (step * n)) * outerRadiusX;
                    dy = y - Math.sin(startAngle + (step * n)) * outerRadiusY;
                    g.lineTo(dx, dy);
                }
            }
        }, //end drawStar

        drawBurst: function(g, x, y, sides, innerRadiusX, innerRadiusY, outerRadiusX, outerRadiusY, angle) {
            if (sides < 3) return;

            var step = (Math.PI * 2) / sides;
            var halfStep = step / 2;
            var qtrStep = step / 4;
            var start = (angle / 180) * Math.PI;
            g.moveTo(x + (Math.cos(start) * outerRadiusX), y - (Math.sin(start) * outerRadiusY));

            var cx;
            var cy;
            var dx;
            var dy;

            for (var n = 1; n <= sides; n++) {
                cx = x + Math.cos(start + (step * n) - (qtrStep * 3)) * (innerRadiusX / Math.cos(qtrStep));
                cy = y - Math.sin(start + (step * n) - (qtrStep * 3)) * (innerRadiusY / Math.cos(qtrStep));
                dx = x + Math.cos(start + (step * n) - halfStep) * innerRadiusX;
                dy = y - Math.sin(start + (step * n) - halfStep) * innerRadiusY;
                g.curveTo(cx, cy, dx, dy);
                cx = x + Math.cos(start + (step * n) - qtrStep) * (innerRadiusX / Math.cos(qtrStep));
                cy = y - Math.sin(start + (step * n) - qtrStep) * (innerRadiusY / Math.cos(qtrStep));
                dx = x + Math.cos(start + (step * n)) * outerRadiusX;
                dy = y - Math.sin(start + (step * n)) * outerRadiusY;
                g.curveTo(cx, cy, dx, dy);
            }
        }, //end draw burst

        drawArc: function(g, x, y, radiusX, radiusY, arc, startAngle) {
            g.moveTo(x, y);
            if (Math.abs(arc) > 360)
                arc = 360;
            var segs = Math.ceil(Math.abs(arc) / 45);

            var segAngle = arc / segs;

            var theta = -(segAngle / 180) * Math.PI;
            var angle = -(startAngle / 180) * Math.PI;
            var ax = x - Math.cos(angle) * radiusX;
            var ay = y - Math.sin(angle) * radiusY;
            if (segs > 0) {
                var angleMid;
                var bx;
                var by;
                var cx;
                var cy;
                for (var i = 0; i < segs; i++) {
                    angle += theta;
                    angleMid = angle - (theta / 2);
                    bx = ax + Math.cos(angle) * radiusX;
                    by = ay + Math.sin(angle) * radiusY;
                    cx = ax + Math.cos(angleMid) * (radiusX / Math.cos(theta / 2));
                    cy = ay + Math.sin(angleMid) * (radiusY / Math.cos(theta / 2));
                    g.curveTo(cx, cy, bx, by);
                }
            }
            //return new Point(bx, by);
        }, //end drawArc

        drawWedge: function(g, x, y, startAngle, arc, radiusX, radiusY) {
            g.moveTo(x, y);
            if (arguments.length == 6) radiusY = radiusX;
            var segAngle, theta, angle, angleMid, segs, ax, ay, bx, by, cx, cy;
            if (Math.abs(arc) > 360) arc = 360;
            segs = Math.ceil(Math.abs(arc) / 45);
            segAngle = arc / segs;
            theta = -(segAngle / 180) * Math.PI;
            angle = -(startAngle / 180) * Math.PI;
            if (segs > 0) {
                ax = x + Math.cos(startAngle / 180 * Math.PI) * radiusX;
                ay = y + Math.sin(-startAngle / 180 * Math.PI) * radiusY;
                g.lineTo(ax, ay);
                for (var i = 0; i < segs; i++) {
                    angle += theta;
                    angleMid = angle - (theta / 2);
                    bx = x + Math.cos(angle) * radiusX;
                    by = y + Math.sin(angle) * radiusY;
                    cx = x + Math.cos(angleMid) * (radiusX / Math.cos(theta / 2));
                    cy = y + Math.sin(angleMid) * (radiusY / Math.cos(theta / 2));
                    g.curveTo(cx, cy, bx, by);
                }
                // close the wedge by drawing a line to the center
                g.lineTo(x, y);
            }
        }, //end drawWedge

        drawPoly: function(g, x, y, sides, radiusX, radiusY, angle) {
            var count = Math.abs(sides);
            if (count > 2) {
                var step, startAngle, dx, dy;
                step = (Math.PI * 2) / sides;
                startAngle = (angle / 180) * Math.PI;
                g.moveTo(x + (Math.cos(startAngle) * radiusX), y - (Math.sin(startAngle) * radiusY));
                for (var n = 1; n <= count; n++) {
                    dx = x + Math.cos(startAngle + (step * n)) * radiusX;
                    dy = y - Math.sin(startAngle + (step * n)) * radiusY;
                    g.lineTo(dx, dy);
                }
            }
        }, //end drawPoly

        drawGear: function(g, x, y, sides,
            innerRadiusX,
            innerRadiusY,
            outerRadiusX,
            outerRadiusY,
            angle,
            holeSides,
            holeRadiusX,
            holeRadiusY) {
            sides = Math.round(sides);
            holeSides = Math.round(holeSides);
            if (sides > 2) {
                // init vars
                var step;
                var qtrStep;
                var startAngle;
                var dx;
                var dy;

                step = (Math.PI * 2) / sides;
                qtrStep = step / 4;

                startAngle = (angle / 180) * Math.PI;
                g.moveTo(x + (Math.cos(startAngle) * outerRadiusX), y - (Math.sin(startAngle) * outerRadiusY));

                // draw lines
                for (var n = 1; n <= sides; n++) {
                    dx = x + Math.cos(startAngle + (step * n) - (qtrStep * 3)) * innerRadiusX;
                    dy = y - Math.sin(startAngle + (step * n) - (qtrStep * 3)) * innerRadiusY;
                    g.lineTo(dx, dy);
                    dx = x + Math.cos(startAngle + (step * n) - (qtrStep * 2)) * innerRadiusX;
                    dy = y - Math.sin(startAngle + (step * n) - (qtrStep * 2)) * innerRadiusY;
                    g.lineTo(dx, dy);
                    dx = x + Math.cos(startAngle + (step * n) - qtrStep) * outerRadiusX;
                    dy = y - Math.sin(startAngle + (step * n) - qtrStep) * outerRadiusY;
                    g.lineTo(dx, dy);
                    dx = x + Math.cos(startAngle + (step * n)) * outerRadiusX;
                    dy = y - Math.sin(startAngle + (step * n)) * outerRadiusY;
                    g.lineTo(dx, dy);
                }

                if (holeSides > 2) {
                    if (!holeRadiusX)
                        holeRadiusX = innerRadiusX / 3;

                    if (!holeRadiusY)
                        holeRadiusY = innerRadiusY / 3;

                    step = (Math.PI * 2) / holeSides;
                    g.moveTo(x + (Math.cos(startAngle) * holeRadiusX), y - (Math.sin(startAngle) * holeRadiusY));
                    for (var m = holeSides; m >= 1; m--) {
                        dx = x + Math.cos(startAngle + (step * m)) * holeRadiusX;
                        dy = y - Math.sin(startAngle + (step * m)) * holeRadiusY;
                        g.lineTo(dx, dy);
                    }
                }
            }
        }, //end drawGear

        drawDonut: function(g, x, y,
            innerRadiusX,
            innerRadiusY,
            outerRadiusX,
            outerRadiusY) {
            g.ctx.arc(x, y, outerRadiusX, 0, 2 * Math.PI);
            g.ctx.arc(x, y, innerRadiusX, 0, 2 * Math.PI, 1);

        }, //end drawDonut
        drawMask: function(g, type, ox, oy, osx, osy, ix, iy, isx, isy) {
            shapes = type.split('-');
            g.drawShape(shapes[0], ox, oy, osx, osy, false);
            g.drawShape(shapes[1], ix, iy, isx, isy, true);
        } //end drawFrame

    };

    // -----------------------------------------------------------------------
    // Color functions
    // -----------------------------------------------------------------------
    (function() {

        var Color = CB5.Color = util.Color = {};

        /*private*/
        function any2rgb(c) {
            if (/^rgba/.test(c)) {
                var a = c.substr(5).substr(0, c.length - 6).split(',');
                return [Number(a[0]), Number(a[1]), Number(a[2]), Number(a[3])];
            }
            if (/^rgb\(/.test(c)) {
                var a = c.slice(4, -1).split(',');
                return [Number(a[0]), Number(a[1]), Number(a[2]), 1];
            }
            return any2rgb(Color.toRgba(c));
        }
        Color.toArray = function(c) {
            return any2rgb(c);
        };
        Color.toRgba = function(ahex, pad0es) {
            if (!ahex) return ('rgba(0,0,0,0)');
            if (typeof ahex == 'number')
                ahex = ('00000000' + ahex.toString(16)).slice(-8);
            if (ahex.slice(0, 3) == 'rgb') return Color.toRgba(Color.toAHEX(ahex));
            if (ahex.charAt(0) == '#') ahex = ahex.substr(1);
            if (pad0es && ahex.length < 8) ahex = ('00000000' + ahex).substr(-8);
            if (ahex.length == 6) ahex = 'ff' + ahex;
            if (ahex.length != 8) return ('rgba(0,0,0,0)');
            return 'rgba(' +
                parseInt('0x' + ahex.substr(2, 2)) + ',' +
                parseInt('0x' + ahex.substr(4, 2)) + ',' +
                parseInt('0x' + ahex.substr(6, 2)) + ',' +
                Math.round(parseInt('0x' + ahex.substr(0, 2)) / 2.55) / 100 + ')';
        };
        Color.toAHEX = function(any) {
            var a = any2rgb(any);
            return hex2(a[3] * 255) + hex2(a[0]) + hex2(a[1]) + hex2(a[2]);
        };
        Color.mixColors = mixColors;

        function mixColors(c1, c2, p, outFormat) {
            var v1 = any2rgb(c1);
            var v2 = any2rgb(c2);
            var v3 = [v1[0] * p + v2[0] * (1 - p), v1[1] * p + v2[1] * (1 - p), v1[2] * p + v2[2] * (1 - p), v1[3] * p + v2[3] * (1 - p)];
            if (outFormat == 'uhex')
                return hex2(v3[3] * 255) + hex2(v3[0]) + hex2(v3[1]) + hex2(v3[2]);
            return 'rgba(' + Math.round(v3[0]) + ',' + Math.round(v3[1]) + ',' + Math.round(v3[2]) + ',' + v3[3] + ')';
        }

        function hex2(v) {
            return ('00' + Math.round(v).toString(16)).substr(-2);
        }

        Color.pad0 = function(color) {
            return ('00000000' + color).substr(-8);
        };
        Color.getAlpha = function(rgba) {
            return parseFloat(rgba.substr(rgba.lastIndexOf(',') + 1));
        };
    })();



})();





(function() {
    // -----------------------------------------------------------------------
    // PACKAGE GEOM
    // -----------------------------------------------------------------------
    var debug = self.console ? console[console.debug ? 'debug' : 'log'].bind(console) : $.noop;

    var geom = {};
    var Class = CB5.util.Class;
    CB5.util.geom = geom;

    /** @class */
    geom.Point = Class.extend({
        x: 0,
        y: 0,
        /** @constructs */
        init: function(x, y) {
            if (arguments.length == 0) return;
            this.x = Number(x);
            this.y = Number(y);
        },
        /**
         * @returns {geom.Point}
         */
        clone: function() {
            return new geom.Point(this.x, this.y);
        },
        put: function(x, y) {
            this.x = x;
            this.y = y;
        },
        /**
         * @param {geom.Point} p
         * @returns {geom.Point} new Point
         */
        subtract: function(p) {
            this.x -= p.x;
            this.y -= p.y;
            return this;
        },
        add: function(p) {
            this.x += p.x;
            this.y += p.y;
            return this;
        },
        scale: function(c) {
            this.x *= c;
            this.y *= c;
            return this;
        },
        size: function() {
            return Math.sqrt(this.x * this.x + this.y * this.y);
        },
        limit: function(minX, minY, maxX, maxY) {
            this.x = Math.max(minX, Math.min(maxX, this.x));
            this.y = Math.max(minY, Math.min(maxY, this.y));
            return this;
        },
        toString: function() {
            return '(' + this.x + ',' + this.y + ')';
        }
    });

    /** @class */
    geom.Matrix = Class.extend({
        a: 1,
        b: 0,
        c: 0,
        d: 1,
        tx: 0,
        ty: 0,
        /** @constructs
         * @param {String=} data
         */
        init: function(data) {
            if (arguments.length == 0) return;
            if (arguments.length > 3) {
                this.a = Number(arguments[0]);
                this.b = Number(arguments[1]);
                this.c = Number(arguments[2]);
                this.d = Number(arguments[3]);
                if (arguments[4]) this.tx = Number(arguments[4]);
                if (arguments[5]) this.ty = Number(arguments[5]);
                return;
            }
            var a = data.split(',');
            this.a = Number(a[0]);
            this.b = Number(a[1]);
            this.c = Number(a[2]);
            this.d = Number(a[3]);
            this.tx = Number(a[4]);
            this.ty = Number(a[5]);
        },

        /** @returns geom.Matrix */
        invert: function() {
            var det = this.a * this.d - this.b * this.c;
            var tx = this.tx,
                a = this.a;
            this.tx = (this.c * this.ty - this.d * tx) / det;
            this.ty = (this.b * tx - this.a * this.ty) / det;

            this.a = this.d / det;
            this.b = -this.b / det;
            this.c = -this.c / det;
            this.d = a / det;
            return this;
        },

        /** @param {geom.Point} p
         *  @returns geom.Point */
        transformPoint: function(p) {
            var x = p.x,
                y = p.y;
            p.x = this.a * x + this.c * y + this.tx;
            p.y = this.b * x + this.d * y + this.ty;
            return p;
        },

        /**
         * @return {geom.Matrix}
         */
        normalize: function() {
            var len = Math.sqrt(this.a * this.a + this.b * this.b);
            this.a /= len;
            this.b /= len;
            len = Math.sqrt(this.c * this.c + this.d * this.d);
            this.c /= len;
            this.d /= len;
            return this;
        },

        isUnit: function() {
            return this.a == 1 && this.b == 0 && this.c == 0 && this.d == 1;
        },

        round4: function() {
            this.a = Math.round(this.a * 10000) / 10000;
            this.b = Math.round(this.b * 10000) / 10000;
            this.c = Math.round(this.c * 10000) / 10000;
            this.d = Math.round(this.d * 10000) / 10000;
            this.tx = Math.round(this.tx * 10000) / 10000;
            this.ty = Math.round(this.ty * 10000) / 10000;
            return this;
        },

        /**
         * @param {geom.Matrix} m
         * @return {geom.Matrix}
         */
        concat: function(m) {
            var a = this.a,
                b = this.b,
                c = this.c,
                d = this.d,
                tx = this.tx;
            this.a = m.a * a + m.c * b;
            this.b = m.b * a + m.d * b;
            this.c = m.a * c + m.c * d;
            this.d = m.b * c + m.d * d;
            this.tx = m.tx + m.c * this.ty + m.a * tx;
            this.ty = m.ty + m.d * this.ty + m.b * tx;
            return this;
        },

        /**
         * Applies delta matrix in place
         * @param {geom.Matrix} delta
         * @param {geom.Matrix} space
         * @returns {geom.Matrix}
         */
        applyDelta: function(delta, space) {
            return this.concat(space.clone().invert()).concat(delta).concat(space);
        },

        scale: function(sx, sy, noTranslate) {
            if (arguments.length == 0) {
                return new geom.Point(
                    Math.sqrt(this.a * this.a + this.b * this.b),
                    Math.sqrt(this.c * this.c + this.d * this.d));
            }
            if (arguments.length == 1) sy = sx;
            this.a *= sx;
            this.b *= sy;
            this.c *= sx;
            this.d *= sy;
            if (!noTranslate) {
                this.tx *= sx;
                this.ty *= sy;
            }
            return this;
        },

        rotate: function(rad) {
            var m = new geom.Matrix();
            m.a = Math.cos(rad);
            m.c = -Math.sin(rad);
            m.b = Math.sin(rad);
            m.d = Math.cos(rad);
            this.concat(m);
            return this;
        },

        /** @returns geom.Matrix */
        translate: function(tx, ty) {
            this.tx += Number(tx);
            this.ty += Number(ty);
            return this;
        },

        put: function(tx, ty) {
            this.tx = tx;
            this.ty = ty;
            return this;
        },

        pos: function() {
            return new geom.Point(this.tx, this.ty);
        },

        /** @param {Number=} d */
        getWidth: function(d) {
            if (d == null) d = 100;
            return Math.sqrt(this.a * this.a + this.b * this.b) * d;
        },

        /** @param {Number=} d */
        getHeight: function(d) {
            if (d == null) d = 100;
            return Math.sqrt(this.c * this.c + this.d * this.d) * d;
        },

        setHeight: function(h) {
            var delta = new geom.Matrix();
            delta.d = h / this.getHeight();
            return this.copy(delta.concat(this));
        },

        setWidth: function(w) {
            var delta = new geom.Matrix();
            delta.a = w / this.getWidth();
            return this.copy(delta.concat(this));
        },

        /**
         * @return {geom.Matrix}
         */
        clone: function() {
            return new geom.Matrix(this.serialize());
        },

        copy: function(m) {
            this.a = m.a;
            this.b = m.b;
            this.c = m.c;
            this.d = m.d;
            this.tx = m.tx;
            this.ty = m.ty;
            return this;
        },

        serialize: function() {
            this.a = Math.round(this.a * 1e10) / 1e10;
            this.b = Math.round(this.b * 1e10) / 1e10;
            this.c = Math.round(this.c * 1e10) / 1e10;
            this.d = Math.round(this.d * 1e10) / 1e10;
            this.tx = Math.round(this.tx * 1e10) / 1e10;
            this.ty = Math.round(this.ty * 1e10) / 1e10;
            return [this.a, this.b, this.c, this.d, this.tx, this.ty].join(',');
        },

        toString: function() {
            return '[' + this.serialize() + ']';
        },

        equals: function(m) {
            return Math.abs(m.a - this.a) < 1e-4 &&
                Math.abs(m.b - this.b) < 1e-4 &&
                Math.abs(m.c - this.c) < 1e-4 &&
                Math.abs(m.d - this.d) < 1e-4 &&
                Math.abs(m.tx - this.tx) < 1e-4 &&
                Math.abs(m.ty - this.ty) < 1e-4;
        }


    });

    geom.Rectangle = Class.extend({
        left: 0,
        top: 0,
        right: 0,
        bottom: 0,
        /** @constructs */
        init: function(left, top, right, bottom) {
            if (arguments.length == 0) return;
            if (arguments.length == 1) {
                var rect = left;
                this.left = rect.left;
                this.top = rect.top;
                this.right = rect.right;
                this.bottom = rect.bottom;
                return;
            }
            this.left = Math.min(left, right);
            this.top = Math.min(top, bottom);
            this.right = Math.max(left, right);
            this.bottom = Math.max(top, bottom);
        },
        clone: function() {
            return new geom.Rectangle(this.left, this.top, this.right, this.bottom);
        },
        scale: function(p) {
            this.left *= p.x;
            this.top *= p.y;
            this.right *= p.x;
            this.bottom *= p.y;
            return this;
        },
        width: function() {
            return this.right - this.left;
        },
        height: function() {
            return this.bottom - this.top;
        },
        /** contains rectangle or point */
        contains: function(r) {
            if ('bottom' in r)
                return this.left < r.left && this.top < r.top && this.right > r.right && this.bottom > r.bottom;
            return r.x > this.left && r.y > this.top && r.x < this.right && r.y < this.bottom;
        },
        restrict: function(r) {
            if (this.left < r.left) this.left = r.left;
            if (this.top < r.top) this.top = r.top;
            if (this.left > r.right - 1) this.left = r.right - 1;
            if (this.top > r.bottom - 1) this.top = r.bottom - 1;
            if (this.bottom > r.bottom) this.bottom = r.bottom;
            if (this.right > r.right) this.right = r.right;
            if (this.bottom < r.top + 1) this.bottom = r.top + 1;
            if (this.right < r.left + 1) this.right = r.left + 1;
        },
        extend: function(rect) {
            this.left > rect.left && (this.left = rect.left);
            this.top > rect.top && (this.top = rect.top);
            this.right < rect.right && (this.right = rect.right);
            this.bottom < rect.bottom && (this.bottom = rect.bottom);
        },
        extendP: function(p) {
            this.left > p.x && (this.left = p.x);
            this.top > p.y && (this.top = p.y);
            this.right < p.x && (this.right = p.x);
            this.bottom < p.y && (this.bottom = p.y);
        },
        translate: function(dx, dy) {
            this.left += dx;
            this.top += dy;
            this.right += dx;
            this.bottom += dy;
        },
        css: function() {
            return {
                left: this.left,
                top: this.top,
                width: this.right - this.left,
                height: this.bottom - this.top
            };
        },
        toString: function() {
            return '[geom.Rectangle ' + [this.left, this.top, this.right, this.bottom] + ']';
        }
    });

    var util = CB5.util;
    $.fn.matrix = function(m) {
        if (arguments.length == 0) {
            var sm = this.css('transform');
            if (sm && sm.indexOf('matrix') == 0) {
                sm = sm.substring(sm.indexOf('(') + 1, sm.indexOf(')'));
                m = new geom.Matrix(sm);
            } else
                m = new geom.Matrix();
            var top = parseFloat(this.css('top'));
            if (!isNaN(top)) {
                m.ty += top;
                m.tx += parseFloat(this.css('left'));
            }
            return m;
        }

        m = m.clone().round4();

        this.css('transform-origin', '0px 0px');
        if (m.isUnit()) {
            this.css({
                top: m.ty,
                left: m.tx
            });
            this.css('transform', '');
        } else {
            var str = 'matrix(' + m.a + ',' + m.b + ',' + m.c + ',' + m.d + ',' + m.tx + ',' + m.ty + ')';
            this.css({
                top: '',
                left: ''
            });
            this.css({
                transform: str
            });
        }
    };

    /** @returns {geom.Point} */
    util.getEventPosition = function(evt) {
        if (evt.originalEvent) evt = evt.originalEvent;
        var t = evt.changedTouches || evt.touches;
        t = t ? t[0] : evt;
        var zoom = document.body.style.zoom ? parseFloat(document.body.style.zoom) : 1;
        return new geom.Point(t.pageX / zoom, t.pageY / zoom);
    };

    /**
     * $.parseParams - parse query string paramaters into an object.
     */
    (function() {
        var re = /([^&=]+)=?([^&]*)/g;
        var decodeRE = /\+/g; // Regex for replacing addition symbol with a space
        var decode = function(str) {
            return decodeURIComponent(str.replace(decodeRE, " "));
        };
        util.parseParams = function(query) {
            var params = {},
                e;
            while (e = re.exec(query)) {
                var k = decode(e[1]),
                    v = decode(e[2]);
                if (k.substring(k.length - 2) === '[]') {
                    k = k.substring(0, k.length - 2);
                    (params[k] || (params[k] = [])).push(v);
                } else params[k] = v;
            }
            return params;
        };
    })();


    $.fn.cbDraggable = function(opts) {
        var $me = this,
            y0, y;
        opts = $.extend({
            dir: 'y', //or x
            max: 10000,
            min: -10000,
            drag: $.noop,
            stop: $.noop,
            cancel: null,
            linkMul: 1,
            id: '',
            preventDefault: true
        }, opts);

        var css = opts.dir == 'y' ? 'top' : 'left';
        var moved = false;

        var p0;
        var lastY = 0;

        $me.on('mousedown touchstart', function(e) {
            opts.preventDefault && e.preventDefault();
            if (opts.cancel && $(e.target).is(opts.cancel)) return;
            p0 = util.getEventPosition(e);
            y0 = parseInt($me.css(css)) - p0[opts.dir];
            $(self).on('mousemove.cb-drag touchmove.cb-drag', move).on('mouseup.cb-drag touchend.cb-drag', up);
            $me.addClass('dragging');
            moved = false;
        });

        var dy = 0; //parseInt(self.getComputedStyle($me[0]).marginTop);

        function move(e) {
            opts.preventDefault && e.preventDefault();
            var p = util.getEventPosition(e);
            y = Math.max(Math.min(y0 + p[opts.dir], opts.max - dy), opts.min - dy);
            $me.attr('data-drag-dir', y > lastY ? '1' : '0');
            lastY = y;
            $me.css(css, y + 'px');
            $me.find('> .drag-value').text(y * opts.linkMul);
            //return false in drag to cancel drag
            var ret = opts.drag(y + dy, p.subtract(p0));
            moved = true;
            if (ret === false) up();
        }

        function up(e) {
            $(self).off('.cb-drag');
            $me.removeClass('dragging');
            if (e && !moved && opts.click) opts.click();
            if (!e || !moved) return;
            opts.stop(y + dy, opts.id);
        }
    };


    function noiseFill(color, color2, intensity, opacity) {

        var n = parseInt('0x' + color);
        var argb = {
            a: (0xFF000000 & n) >>> 24,
            r: (0xFF0000 & n) >>> 16,
            g: (0xFF00 & n) >>> 8,
            b: 0xFF & n
        };

        var size = 50;
        var canvas = document.createElement('canvas');
        canvas.width = canvas.height = size;

        var ctx = canvas.getContext('2d');
        ctx.fillStyle = util.Color.toRgba(color, true);
        ctx.fillRect(0, 0, size, size);
        var imgData = ctx.getImageData(0, 0, size, size),
            numPixels = Math.round(intensity * Math.pow(size, 2)) //, maxAlpha = 255 * opacity;

        var n = parseInt('0x' + color2);
        var noiseArgb = {
            a: (0xFF000000 & n) >>> 24,
            r: (0xFF0000 & n) >>> 16,
            g: (0xFF00 & n) >>> 8,
            b: 0xFF & n
        };

        // Add color to random pixels in the canvas
        while (numPixels--) { // Read about the double bitwise NOT trick here: goo.gl/6DPpt
            var x = ~~(Math.random() * canvas.width),
                y = ~~(Math.random() * canvas.height),
                index = (x + y * imgData.width) * 4;

            var op = Math.random() * opacity * noiseArgb.a / 255;
            imgData.data[index] = ~~(argb.r * (1 - op) + noiseArgb.r * op); //R
            imgData.data[index + 1] = ~~(argb.g * (1 - op) + noiseArgb.g * op); //G
            imgData.data[index + 2] = ~~(argb.b * (1 - op) + noiseArgb.b * op); //B
        }

        ctx.putImageData(imgData, 0, 0);
        return canvas.toDataURL('image/png');
    }


    util.fillStyleCss = function(style) {
        var css = [];

        function gradStops() {
            var aStops = [];
            var colors = [];
            var ratios = style.ratios;
            var aColors = style.colors;
            for (var i = 0; i < aColors.length; i++) {
                var color = util.Color.toRgba(aColors[i], true);
                colors.push(color);
                var pos = Math.round(ratios[i] / 255 * 100 * 10000) / 10000;
                aStops.push(color + ' ' + pos + '%');
            }
            return aStops.join(',');
        }

        if (style.type == 'solid')
            css.push({
                background: util.Color.toRgba(style.color, true)
            });
        else if (style.type == 'linear') {
            var rot = Number(style.rotation);
            var angle = -Math.round(rot / Math.PI * 180);
            var stdAngle = 90 - angle;
            css.push({
                background: 'linear-gradient(' + stdAngle + 'deg, ' + gradStops() + ')'
            });
        } else if (style.type == 'bitmap') {
            var repeat = style.repeat == 'fill' ? 'no-repeat' : style.repeat;
            var align = style.align ? style.align : 'center top';
            var color = style.solid ? util.Color.toRgba(style.solid, true) : '';
            css.push({
                background: color + ' url(' + CB5.getRealPath(style.src) + ') ' + align + ' ' + repeat
            });
            css.push({
                'background-size': style.repeat == 'fill' ? 'cover' : 'auto'
            });
        } else if (style.type == 'radial') {
            var pos = (Number(style.translatex) + .5) * 100 + '% ' + (Number(style.translatey) + .5) * 100 + '%';
            var stops = gradStops();
            css.push({
                background: 'radial-gradient(ellipse farthest-side at ' + pos + ',' + stops + ')'
            });
            css.push({
                background: '-moz-radial-gradient(' + pos + ',ellipse farthest-side,' + stops + ')'
            });
            css.push({
                background: '-webkit-radial-gradient(' + pos + ',ellipse farthest-side,' + stops + ')'
            });
        } else if (style.type == 'none') {
            css.push({
                background: 'none'
            });
        } else if (style.type == 'noise') {
            css.push({
                background: 'url(' + noiseFill(style.color, style.color2, style.intensity, style.opacity) + ')'
            });
        } else
            debug('unimplemented fill:', style);
        return css;
    };


    $.fn.fillStyle = function(style) {
        util.fillStyleCss(style).forEach(this.css, this);
        return this;
    };

    util.lineStyleCss = function(data) {
        if (!data) return [];
        var a = (typeof data == 'string') ? data.split(',') : data;
        var lineWidth = a[1];
        var lineColor = a[0];
        return [{
            border: 'solid ' + util.Color.toRgba(lineColor, true) + ' ' + Math.round(lineWidth) + 'px'
        }];
    };

    util.cssFromList = function(list) {
        return list.map(function(css) {
            return Object.keys(css).map(function(name) {
                return '\t' + name.replace(/([a-z])([A-Z])/g, '$1-$2').toLowerCase() + ': ' + css[name] + ';';
            }).join('\n');
        }).join('\n');
    };

    $.fn.lineStyle = function(data) {
        util.lineStyleCss(data).forEach(this.css, this);
        return this;
    };

    util.filterCss = function(filter, isText) {
        if (!filter) return [];
        return filter.map(function(param) {

            if (param.type == 'dropShadow') {
                //debug(print_r($data,1));
                var ds = param.distance;
                var dx = Math.round(ds * Math.cos(param.angle / 180 * Math.PI));
                var dy = Math.round(ds * Math.sin(param.angle / 180 * Math.PI));
                var blur = param.blur;

                var hex = Number(param.color).toString(16);
                if (param.strength) {
                    if (isText) param.strength *= 0.6;
                    hex = ('000000' + hex).slice(-6);
                    hex = Math.round(param.strength * 255).toString(16) + hex;
                }
                var colorCss = util.Color.toRgba(hex);

                var shadow = dx + 'px ' + dy + 'px ' + blur + 'px ' + colorCss;
                if (isText) return {
                    textShadow: shadow
                };
                return {
                    '-moz-box-shadow': shadow,
                    '-webkit-box-shadow': shadow,
                    boxShadow: shadow
                };
            }

            if (param.type == 'glow') {
                var blur = param.x;
                var spread = param.x;
                var strength = param.strength / 2;
                var color = util.Color.toRgba(Number(param.color).toString(16));
                var a = color.slice(5, -1).split(',');
                a[3] = strength;
                color = 'rgba(' + a.join(',') + ')';

                var shadow = '0px 0px ' + blur + 'px ' + spread + 'px ' + color;
                return {
                    '-moz-box-shadow': shadow,
                    '-webkit-box-shadow': shadow,
                    boxShadow: shadow
                };
            }
            debug('unknown filter: ' + param.type);
            return {};
        });
    };

    util.drawMenuButton = function($cnv) {
        var sz = $cnv.width();
        var m = sz / 4;
        var l = (sz - 2 * m) / 5;
        var ctx = $cnv[0].getContext('2d');
        ctx.fillStyle = '#ffffff';
        ctx.rect(m, m, sz - 2 * m, l);
        ctx.rect(m, m + 2 * l, sz - 2 * m, l);
        ctx.rect(m, m + 4 * l, sz - 2 * m, l);
        ctx.fill();
    };

    /* HTML building */
    var html = {
        img: function(src) {
            return $('<img/>').attr('src', src);
        },
        div: function(clazz) {
            return clazz ? $('<div/>').addClass(clazz) : $('<div/>');
        },
        span: function(clazz) {
            return clazz ? $('<span/>').addClass(clazz) : $('<span/>');
        },
        table: function() {
            return $('<table/>');
        },
        tr: function() {
            return $('<tr/>');
        },
        th: function() {
            return $('<th/>');
        },
        td: function() {
            return $('<td/>');
        },
        a: function() {
            return $('<a/>');
        },
        input: function(type) {
            return $('<input/>').attr('type', type ? type : 'text');
        },
        mark: function() {
            return html.div().css({
                background: 'red',
                width: 10,
                height: 10,
                position: 'absolute'
            });
        },
        vcenter: function($content) {
            return html.table().height('100%').width('100%')
                .append(html.td().css('vertical-align', 'middle').append($content));
        },
        colorIcon: function() {
            return $('<div class="color-icon"><div></div></div>')
        },
        option: function(text, value) {
            var ret = $('<option/>').text(text);
            if (arguments.length == 2) ret.val(value);
            return ret;
        },
        loading: function() {
            return html.div('loading').css('display', 'inline-block')
        },
        iframe: function(src) {
            return $('<iframe/>').attr('src', src);
        }
    };
    util.html = html;

    util.buildMobileNavBar = function(mobiNav, mobiFooter, navHeight, template, colors, titleCss, navCss) {
        var $titleBar = mobiNav.find('> .titleBar');
        $titleBar.attr('class').split(/\s+/).forEach(function(cls) {
            if (cls.substr(0, 8) == 'template') $titleBar.removeClass(cls);
        });
        $titleBar.css({
            height: navHeight
        }).find('.titleH').css(titleCss);
        $titleBar.addClass(template);
        var $paneTogg = mobiNav.find('> canvas').attr({
            width: navHeight,
            height: navHeight
        }).addClass('naviPaneTogg');

        mobiNav.css({
            'background-color': util.Color.toRgba(colors.navigationBackground)
            //color: util.Color.toRgba(colors.navigationText)
        }).find('.item,a').css(navCss);

        mobiFooter.css({
            padding: 10,
            'text-align': 'center',
            'background-color': util.Color.toRgba(colors.navigationBackground)
        });

        mobiFooter.find('a').css({
            //color: util.Color.toRgba(colors.navigationText),
            'text-decoration': 'none'
        }).css(navCss);


        util.drawMenuButton($paneTogg);
    };

    util.wrapElement = function($el) {
        if (!$el.parent().is('.cb-effects')) {
            $el.wrap($('<div class="cb-effects"/>'));
            $el.parent().css('visibility', $el.css('visibility'));
            $el.css('visibility', '');
        }
    };

    util.pickFile = function(hnd, multiple, images) {
        var $file = $('<input type="file">');
        if (images) $file.attr('accept', 'image/png, image/x-png, image/gif, image/jpeg');
        if (multiple) $file.attr('multiple', true);
        $file.on('change', function() {
            if (this.files.length == 0) return;
            hnd(multiple ? this.files : this.files[0]);
        });
        $file.trigger('click');
    }
})();

//LINK ACTIONS
(function() {

    //hide elements that will be shown by links
    $(function() {
        var prefix = 'javascript:CB5.action_showhide(';
        $('a[href]').each(function() {
            var href = $(this).attr('href');
            if (href.slice(0, prefix.length) === prefix) {
                var ids = JSON.parse(href.slice(prefix.length, -1)).show;
                ids.forEach(function(id) {
                    getEl(id).css({
                        visibility: 'hidden'
                    });
                });
            }
        });
    });

    //Element Show/Hide
    CB5.action_showhide = function(o) {
        o.hide.forEach(function(id) {
            getEl(id).animate({
                opacity: 0
            });
        });
        o.show.forEach(function(id) {
            getEl(id).css({
                visibility: 'visible',
                opacity: 0
            }).animate({
                opacity: 1
            });
        });
    }

    function getEl(id, b) {
        var $el = $('#' + id);
        if ($el.parent().is('.cb-effects'))
            $el = $el.parent();
        return $el;
    }


    //Show mobile
    CB5.action_mobile = function() {
        top.location = '?full=0&mobile=1';
    };
    //submit form
    CB5.action_submit = function() {
        $('.cb-form').last().submit();
    };

    CB5.action_scroll = function(id) {
        $('#' + id + ',#m_' + id).scrollintoview();
        history.pushState(null, '', '#' + id);
    }

})();

//Image effects: reflection, ...
(function() {
    var util = CB5.util;

    //Effects, now with Pixastic
    util.Filter = {
        'do': function(canvas, action, options) {
            if (action == 'blur' && typeof blurCanvas != 'undefined') {
                blurCanvas(canvas, options.amount);
                return;
            }

            options.resultCanvas = canvas;
            options.leaveDOM = true;
            if (typeof Pixastic != 'undefined')
                Pixastic.process(canvas, action, options);
        }
    };

    CB5.ImageEffects = {
        //TODO separate reflection from filters
        render: function($img, matrix, filterData, reflectionData) {
            var $cnv;
            var filters = [];
            if (filterData) {
                filterData.split(',').forEach(function(str) {
                    var p = util.parseParams(str);
                    if (p.type == 'dropShadow' || p.type == 'glow') return;
                    filters.push(p);
                }, this);
            }

            if (!filters.length && !reflectionData) return;
            $img.wrap('<div class="cb-effects"/>');

            if (reflectionData) {
                var p = util.parseParams(reflectionData);
                $cnv = $('<canvas style="position:absolute"/>');
                var b = $img[0].getBoundingClientRect();
                var m = matrix.clone();
                m.ty += b.height + b.height * p.y / 100;
                $cnv.matrix(m);

                $img.before($cnv);
                this._reflection($img[0], $cnv, p);
            }
            if (filters.length) {
                $cnv = $('<canvas style="position:absolute"/>')
                    .attr({
                        width: $img[0].naturalWidth,
                        height: $img[0].naturalHeight
                    });
                $cnv.matrix(matrix);
                $img.before($cnv);
                $img.css({
                    opacity: 0
                });

                filters.forEach(function(p) {
                    if (!this.hasOwnProperty('_' + p.type)) {
                        sb.debug('no such filter: ' + p.type, $img[0]);
                        return;
                    }
                    this['_' + p.type]($img, $cnv, p);
                }, this);
            }
        },

        addTint: function($img, matrix, tintData, elId) {
            if (!tintData) return;
            var $cnv = $('<canvas style="position:absolute;z-index: 100"/>').addClass('cbel cb-tint');
            if (elId) {
                $('.colorTint-' + elId).remove();
                $cnv.addClass('colorTint-' + elId);
            }
            var m = matrix.clone();
            $img.before($cnv);
            $cnv.matrix(m);
            var w = $img[0].naturalWidth,
                h = $img[0].naturalHeight;
            $cnv.attr({
                width: w,
                height: h
            });
            var ctx = $cnv[0].getContext('2d');
            ctx.fillStyle = '' + tintData;
            ctx.fillRect(0, 0, w, h);
        },

        _blur: function($img, $cnv, p) {
            var ctx = $cnv[0].getContext('2d');
            ctx.drawImage($img[0], 0, 0);
            util.Filter.do($cnv[0], 'blur', {
                amount: p.x
            });
        },

        _sharpen: function($img, $cnv, p) {
            var ctx = $cnv[0].getContext('2d');
            ctx.drawImage($img[0], 0, 0);
            util.Filter.do($cnv[0], 'sharpen', {
                amount: p.multiply / 100
            });
        },

        _colorMatrix: function($img, $cnv, p) {
            var ctx = $cnv[0].getContext('2d');
            ctx.drawImage($img[0], 0, 0);
            if (p.hue != 0 || p.saturation != 0)
                util.Filter.do($cnv[0], 'hsl', {
                    hue: p.hue,
                    saturation: p.saturation
                });
            if (p.contrast != 0 || p.brightness != 0)
                util.Filter.do($cnv[0], 'brightness', {
                    brightness: p.brightness,
                    contrast: p.contrast / 100
                })
        },

        _emboss: function($img, $cnv, p) {
            var ctx = $cnv[0].getContext('2d');
            ctx.drawImage($img[0], 0, 0);
            util.Filter.do($cnv[0], 'emboss', {
                strength: p.multiply / 100 * 2,
                blend: true,
                greyLevel: 0
            })
        },

        _reflection: function(img, $cnv, p) {

            var w = img.naturalWidth,
                h = img.naturalHeight;
            $cnv.attr({
                width: w,
                height: h
            });

            //sb.debug(p)
            var ctx = $cnv[0].getContext('2d');

            var g = ctx.createLinearGradient(0, 0, 0, h);
            [
                [0, 1],
                [0.2, 0.3],
                [0.3, 0.2],
                [1, 0]
            ].forEach(function(a) {
                //var alpha = Math.pow(a[1],1-Math.pow(p.strength,4));
                var alpha = a[1] * p.strength + Math.pow(p.strength, 6);
                //sb.debug(alpha, a[1]*p.strength, Math.pow(p.strength,6))
                g.addColorStop(a[0], 'rgba(0,0,0,' + alpha + ')');
            });
            ctx.fillStyle = g;
            ctx.fillRect(0, 0, w, h);

            ctx.globalCompositeOperation = 'source-in';
            ctx.save();
            ctx.transform(1, 0, 0, -1, 0, h);
            ctx.drawImage(img, 0, 0);
            ctx.restore();

            //blurCanvas($reflection[0], p.blur);
            util.Filter.do($cnv[0], 'blur', {
                amount: p.blur
            });
        }
    };

    $.fn.isInViewport = function() {
        var el = this[0],
            s = false;
        if (!el) return;
        if (this.css('display') == 'none') {
            this.css({
                display: 'block',
                visibility: 'hidden'
            });
            s = true;
        }
        var rect = el.getBoundingClientRect();
        if (s) this.css({
            display: 'none',
            visibility: 'visible'
        });
        return rect.top < $(window).height() && rect.left < $(window).width();
    }
})();