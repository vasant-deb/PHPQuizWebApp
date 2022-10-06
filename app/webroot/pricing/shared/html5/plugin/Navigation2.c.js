CB5.plugin.Navigation2 = function(t, i) {
    function e(t) {
        if (self.console && console.debug) console.debug(t)
    }
    CanvasRenderingContext2D.prototype.roundRect = function(t, i, e, o, r) {
        if (e < 0 || o < 0 || r < 0) return;
        if (e < 2 * r) r = e / 2;
        if (o < 2 * r) r = o / 2;
        this.beginPath();
        if (r > 0) {
            this.moveTo(t + r, i);
            this.arcTo(t + e, i, t + e, i + o, r)
        } else this.moveTo(t + e, i);
        this.lineTo(t + e, i + o - r);
        if (r > 0) this.arcTo(t + e, i + o, t, i + o, r);
        this.lineTo(t + r, i + o);
        if (r > 0) this.arcTo(t, i + o, t, i, r);
        this.lineTo(t, i + r);
        if (r > 0) this.arcTo(t, i, t + e, i, r);
        this.closePath()
    };
    var o = $("#" + t);
    var r = {};
    for (var s in i) {
        if (s.indexOf("Color") != -1) r[s] = CB5.Color.toRgba(CB5.Color.pad0(Number(i[s]).toString(16)))
    }

    function h(t) {
        var i = {};
        var e = t.split(",");
        for (var o = 0; o < e.length; o++) {
            var r = e[o].split(":");
            i[r[0]] = r[1]
        }
        var s = {
            fontFamily: i.font,
            fontSize: i.size + "px",
            textAlign: i.align
        };
        if (i.bold) s.fontWeight = "bold";
        if (i.italic) s.fontStyle = "italic";
        if (i.underline) s.textDecoration = "underline";
        return s
    }
    var n = h(i.mTextFormat);
    var a = h(i.sTextFormat);
    var l = {};
    var f = {
        children: []
    };

    function d(t, i) {
        i.children(".item").each(function() {
            var i = $(this);
            var e = i.children("a");
            var o = e.attr("class");
            if (o == t.id) return;
            var r = {
                name: e.text(),
                children: [],
                id: o,
                url: e.attr("href"),
                target: e.attr("target"),
                parent: t,
                hidden: i.hasClass("hidden"),
                navHidden: i.hasClass("navHidden")
            };
            l[o] = r;
            t.children.push(r);
            d(r, i.children(".level"))
        })
    }
    if (self.siteData && siteData.structure) {
        f = siteData.structure.getNavTree();
        l = f.idMap
    } else {
        d(f, o)
    }
    var g = l[CB5.config.pid];
    if (g) {
        g.current = true;
        var c = [];
        for (var v = g; v.parent; v = v.parent) {
            v.selected = true;
            c.unshift(v)
        }
        if (g.navHidden) return
    }
    if (i.level > 0) {
        f = c[i.level - 1];
        if (!f) return;
        delete f.parent
    }

    function u(t) {
        return $.grep(t.children, function(t) {
            return !t.hidden
        })
    }

    function p(t) {
        for (var i = 0; i < t.children.length; i++)
            if (!t.children[i].hidden) return true;
        return false
    }

    function C(t, e, o, r, s, h) {
        var n = this;
        this.node = t;
        this.dir = h ? "right" : "down";
        this.el = $("<div>").css({
            display: "block",
            position: "absolute",
            textDecoration: "none"
        });
        var a = $("<div/>");
        this.link = $("<a>").attr("href", t.url).css({
            position: "absolute",
            top: 0,
            left: 0,
            right: 0,
            bottom: 0,
            background: "rgba(0,0,0,0)"
        }).text(" ");
        if (t.target) this.link.attr("target", t.target);
        this.type = o;
        this.rounding = r;
        this.margin = s;
        this.txt = $("<div>").css({
            padding: "0 2px",
            position: "absolute",
            top: 0,
            left: 0,
            whiteSpace: "nowrap"
        }).text(t.name);
        this.txt.css(e);
        if (i.highlightPath == "no" && t.selected) this.txt.css("font-weight", "bold");
        if (i.underlineHover) this.el.addClass("uHover");
        this.canvas = $("<canvas>").attr({
            width: 1,
            height: 1
        }).css({
            position: "absolute",
            top: 0,
            left: 0
        });
        this.el.append(this.canvas, this.txt, a, this.link);
        this.x = this.y = this.width = this.height = 0;
        this.hPadding = this.vPad = 0;
        var l = i[i.mDirection == "vertical" ? "sVDir" : "sDirection"];
        if (p(t) && l != "none" && !i.hideArrows) {
            this.arrow = $("<canvas>").attr({
                width: 1,
                height: 1
            }).css({
                position: "absolute"
            });
            this.el.append(this.arrow)
        }
        this.setColors = function(t, i, e, o, r) {
            this.shading = r;
            this.txtColor = t;
            this.txtOverColor = i;
            this.bgColor = e;
            this.bgOverColor = o;
            this.txt.css({
                color: this.txtColor
            });
            if (this.arrow) this.arrow.css({
                right: 0
            })
        };
        this.setWidth = function(t) {
            this.width = t;
            this.commit()
        };
        this.setHeight = function(t) {
            this.height = t;
            this.commit()
        };
        this.commit = function() {
            this.el.css({
                left: this.x,
                top: this.y,
                width: this.width,
                height: this.height
            });
            var t;
            var o = this.txt.width() + 2;
            if (this.arrow) {
                if (e.textAlign == "center") t = Math.min((this.width - o) / 2, this.width - o - this.height - this.hPadding);
                else if (e.textAlign == "left") t = this.hPadding;
                else t = this.width - o - this.height - this.hPadding
            } else {
                if (e.textAlign == "center") t = (this.width - o) / 2;
                else if (e.textAlign == "left") t = this.hPadding;
                else t = this.width - o - this.hPadding
            }
            this.txt.css("left", t);
            if (this.type == "tabUp") this.txt.css("top", (this.height - this.txt.height() + this.margin) / 2);
            else if (this.type == "tabDown") this.txt.css("top", (this.height - this.txt.height() - this.margin) / 2);
            else {
                this.txt.css("top", (this.height - this.txt.height()) / 2)
            }
            if (this.indent) this.txt.css("padding-left", this.indent);
            this.drawBg();
            this.width = Math.max(this.width, o + 2 * this.hPadding + (this.arrow ? this.height : 0));
            this.height = Number(this.height);
            this.drawArrow();
            if (i.buttonIcon) {
                var r = $("<img/>").attr("src", "data:image/png;base64," + i.buttonIcon).css({
                    verticalAlign: "top"
                });
                a.css({
                    position: "absolute",
                    top: 10,
                    left: this.indent - 2
                });
                a.empty().append(r)
            }
        };
        this.drawBg = function() {
            this.txt.css({
                color: this.txtColor
            });
            var t = this.height;
            var e = this.width;
            if (this.type == "tabUp" || this.type == "tabDown") t += this.margin;
            if (this.type == "tabDown") this.canvas.css({
                top: -this.margin
            });
            if (this.type == "tabLeft" || this.type == "tabRight") e += this.margin;
            if (this.type == "tabLeft") this.canvas.css({
                left: -this.margin
            });
            this.canvas.attr({
                height: t,
                width: e
            });
            var o = this.canvas[0].getContext("2d");
            o.clearRect(-this.width, -this.height, 2 * this.width, 2 * this.height);
            if (this.shading == 2) {
                var r = o.createLinearGradient(0, 0, 0, this.height);
                r.addColorStop(0, CB5.Color.mixColors(this.bgColor, "#ffffffff", .85));
                r.addColorStop(1, CB5.Color.mixColors(this.bgColor, "#ff000000", .85));
                o.fillStyle = r
            } else if (this.shading == 3) {
                var r = o.createLinearGradient(0, 0, 0, this.height);
                r.addColorStop(0, this.bgColor);
                r.addColorStop(.5, CB5.Color.mixColors(this.bgColor, "#ffffffff", .8));
                r.addColorStop(.5, this.bgColor);
                r.addColorStop(1, CB5.Color.mixColors(this.bgColor, "#ffffffff", .8));
                o.fillStyle = r
            } else if (this.shading == 4) {
                var r = o.createLinearGradient(0, 0, 0, this.height);
                r.addColorStop(0, CB5.Color.mixColors(this.bgColor, "#ffffffff", .7));
                r.addColorStop(.5, CB5.Color.mixColors(this.bgColor, "#ffffffff", .9));
                r.addColorStop(.5, this.bgColor);
                r.addColorStop(1, CB5.Color.mixColors(this.bgColor, "#ff000000", .7));
                o.fillStyle = r
            } else if (this.shading == 5) {
                var r = o.createLinearGradient(0, 0, 0, this.height);
                r.addColorStop(0, this.bgColor);
                r.addColorStop(.5, this.bgColor);
                r.addColorStop(.5, CB5.Color.mixColors(this.bgColor, "#ff000000", .9));
                r.addColorStop(1, CB5.Color.mixColors(this.bgColor, "#ff000000", .7));
                o.fillStyle = r
            } else if (this.shading == 6) {
                var r = o.createLinearGradient(0, 0, 0, this.height);
                r.addColorStop(0, CB5.Color.mixColors(this.bgColor, "#ff000000", .75));
                r.addColorStop(.25, this.bgColor);
                r.addColorStop(.75, this.bgColor);
                r.addColorStop(1, CB5.Color.mixColors(this.bgColor, "#ff000000", .75));
                o.fillStyle = r
            } else if (this.shading == 7) {
                var r = o.createLinearGradient(0, 0, 0, this.height);
                r.addColorStop(0, CB5.Color.mixColors(this.bgColor, "#ffffffff", .7));
                r.addColorStop(1, this.bgColor);
                o.fillStyle = r
            } else o.fillStyle = this.bgColor;
            var s = this.height * this.rounding / 100;
            if (this.type == "rect") o.roundRect(0, 0, e, t, s / 2);
            else if (this.type == "tabUp") o.roundRect(0, 0, e, t * 2, s);
            else if (this.type == "tabDown") o.roundRect(0, -t, e, t * 2, s);
            else if (this.type == "tabRight") o.roundRect(0, 0, e * 2, t, s);
            else if (this.type == "tabLeft") o.roundRect(-e, 0, e * 2, t, s);
            o.fill();
            if (i.borderBottom) {
                o.fillStyle = i.borderBottom;
                o.fillRect(0, t - 1, e, 1)
            }
        };
        this.drawArrow = function() {
            if (!this.arrow) return;
            var t = this.arrow[0].getContext("2d");
            var i = this.height;
            if (this.type == "tabDown") this.arrow.css({
                top: -this.margin / 2
            });
            if (this.type == "tabUp") this.arrow.css({
                top: +this.margin / 2
            });
            this.arrow.attr({
                height: this.height,
                width: i
            });
            if (this.dir == "down") {
                var e = (this.height - 14) / 2;
                var o = Math.round((i - 8) / 2);
                t.fillStyle = this.txtColor;
                t.fillRect(0, 3, 1, i - 6);
                t.beginPath();
                t.moveTo(e, o);
                t.lineTo(e + 14, o);
                t.lineTo(e + 7, o + 8);
                t.lineTo(e, o)
            } else if (this.dir == "up") {
                var e = (this.height - 14) / 2;
                var o = Math.round((i - 8) / 2);
                t.fillStyle = this.txtColor;
                t.fillRect(0, 3, 1, i - 6);
                t.beginPath();
                t.moveTo(e, o + 8);
                t.lineTo(e + 7, o);
                t.lineTo(e + 14, o + 8);
                t.lineTo(e, o + 8)
            } else {
                var e = (this.height - 3) / 2;
                var o = (this.height - 12) / 2;
                t.fill();
                t.fillStyle = this.txtColor;
                t.fillRect(0, 0, 1, this.height);
                t.beginPath();
                t.moveTo(e, o);
                t.lineTo(e + 7, o + 6);
                t.lineTo(e, o + 12);
                t.lineTo(e, o)
            }
            t.closePath();
            t.fill()
        };
        this.toggArrow = function(t) {
            this.dir = t ? "up" : "down";
            this.drawArrow()
        };
        var n = this;
        this.hover = function(t) {
            if (!/iPad|iPhone|iPod/.test(navigator.userAgent)) {
                var i = 0;
                this.el.hover(function() {
                    clearTimeout(i);
                    i = setTimeout(e, 200)
                }, function() {
                    clearTimeout(i)
                });

                function e() {
                    if (!n.el.is("html *")) return;
                    t.apply(n)
                }
            }
            if (this.arrow) {
                this.arrow.on("touchstart", function() {
                    t.apply(n);
                    return false
                })
            }
        };
        this.arrowClick = function(t) {
            if (!this.arrow) return;
            this.arrow.click(function() {
                t.apply(n)
            })
        };

        function f() {
            var t = n.txtColor;
            n.txtColor = n.txtOverColor;
            n.txtOverColor = t;
            t = n.bgColor;
            n.bgColor = n.bgOverColor;
            n.bgOverColor = t;
            n.txt.css({
                color: this.txtColor
            });
            n.drawArrow();
            n.drawBg()
        }
        this.el.hover(f, f)
    }

    function m(t, e, s, h, n) {
        if (!e) e = 0;
        if (!n) n = 0;
        this.node = t;
        this.x = this.y = 0;
        var l = {
            position: "absolute",
            width: 100,
            height: 100,
            background: r.sBgColor
        };
        this.el = $("<div>").css(l);
        o.append(this.el);
        var f = Number(i.sMargin);
        var d = Number(i.sSpacing);
        var g = e;
        var c = parseInt(a.fontSize) + f + 2 + Number(i.sVPadding);
        var v = [];
        var w = null;
        this.parent = null;
        var b = this;
        this.closeSubnav = function() {
            if (!w) return;
            w.closing = true;
            if (s) w.el.remove();
            else w.el.slideUp("fast", function() {
                $(this).remove()
            });
            w.closeSubnav();
            this.subnav = w = null;
            this.arrange()
        };
        this.move = function(t, i) {
            this.el.css({
                left: t,
                top: i
            });
            this.x = t;
            this.y = i
        };
        this.arrange = function() {
            var t = 0;
            for (var i = 0; i < v.length; i++) {
                var e = v[i];
                e.setWidth(g);
                e.y = f + (c + d) * i + t;
                e.x = f;
                e.commit();
                if (s && w && w.node == e.node) t = w.height - d
            }
            this.width = g + 2 * f;
            this.height = (c + d) * v.length - d + 2 * f + t;
            this.el.css({
                width: this.width,
                height: this.height
            });
            if (s) {
                if (this.parent) this.parent.arrange();
                else J()
            }
        };
        var x = u(t);
        for (var S = 0; S < x.length; S++) {
            var y = new C(x[S], a, "rect", i.sRounding, f, !s);
            this.el.append(y.el);
            var B = i.highlightPath == "no" ? y.node.current : y.node.selected;
            var D = i.shadeSelected ? B ? i.sShading : 1 : i.sShading;
            y.setColors(B ? r.sTxtSelColor : r.sTxtUpColor, r.sTxtOverColor, B ? r.sSelColor : r.sUpColor, r.sOverColor, D);
            y.indent = n;
            y.hPadding = T;
            y.setHeight(c);
            g = Math.max(g, y.width);
            v.push(y);
            if (s) {
                y.arrowClick(function() {
                    R(this)
                })
            } else {
                y.hover(P)
            }
        }

        function P() {
            var t = this;
            if (b.closing) return;
            if (w && w.node == t.node) return;
            b.closeSubnav();
            if (!p(t.node)) return;
            b.subnav = w = new m(t.node, 0, false, h);
            w.parent = b;
            var i = h == "up" ? t.y + t.height - w.height + f : t.y - f;
            w.move(b.x + t.x + t.width + f, b.y + i);
            if (!CB5.isIOS) w.el.hide().slideDown("fast")
        }

        function R(t) {
            for (var o = 0; o < v.length; o++) v[o].toggArrow(false);
            if (w) {
                var r = w.node;
                b.closeSubnav();
                if (r == t.node) return
            }
            b.subnav = w = new m(t.node, e - (A ? 0 : 10), true, false, n + A);
            w.parent = b;
            w.move(b.x + (i.sVAlign == "up" || A ? 0 : 10), b.y + t.y + c);
            if (!CB5.isIOS) w.el.hide().slideDown("fast");
            b.arrange();
            t.toggArrow(true)
        }
        this.arrange();
        this.openSelected = function() {
            for (var t = 0; t < v.length; t++) {
                if (v[t].node.selected && p(v[t].node)) R(v[t])
            }
            if (w) w.openSelected()
        }
    }
    if (!p(f)) return;
    o.css({
        background: r.mBgColor
    });
    var w = o.width();
    var b = o.height();
    var x = null;
    var S = 0;

    function y() {
        if (!x) return;
        x.closing = true;
        x.el.slideUp("fast", function() {
            $(this).remove()
        });
        x.closeSubnav();
        x = null
    }
    if (i.mDirection == "horizontal" || i.sVDir == "pop") {
        o.hover(function() {
            clearTimeout(S)
        }, function() {
            S = setTimeout(y, 500)
        })
    }
    var T = Number(i.textPadding);
    var B = Number(i.margin);
    var D = Number(i.spacing);
    var P = u(f);
    var A = Number(i.inlineIndent);
    var R = P.length;
    if (i.mDirection == "horizontal") {
        var O = i.sDirection;
        var M = 0;
        var N = i.widthType;
        var U = [];
        for (var V = 0; V < R; V++) {
            var k = P[V];
            var I = new C(k, n, i.mBtnType, i.mRounding, B);
            I.setColors(k.selected ? r.mTxtSelColor : r.mTxtUpColor, r.mTxtOverColor, k.selected ? r.mSelColor : r.mUpColor, r.mOverColor, i.mShading);
            I.hPadding = T;
            o.append(I.el);
            I.setHeight(b - 2 * B);
            M = Math.max(M, I.width);
            U.push(I);
            I.hover(function() {
                if (O == "none") return;
                if (x && x.node == this.node) return;
                y();
                if (!p(this.node)) return;
                x = new m(this.node, i.sAlign == "fill" ? this.width : 0, false, O);
                var t = Number(i.sMargin);
                var e = i.sAlign == "right" ? this.width - x.width + t : i.sAlign == "center" ? (this.width - x.width) / 2 : -t;
                var o = O == "up" ? this.y - x.height - B : this.y + this.height + B;
                x.move(this.x + e, o);
                if (!CB5.isIOS) x.el.hide().slideDown("fast")
            })
        }
        M = Math.floor(M);
        if (N == "split") {
            var L = D * (R - 1);
            for (var V = 0; V < R; V++) L += U[V].width;
            var H = (w - L) / R;
            if (H > 0) {
                for (var V = 0; V < R; V++) U[V].setWidth(U[V].width + H)
            }
        } else if (N != "min") {
            for (var V = 0; V < R; V++) U[V].setWidth(M)
        }
        var L = D * (R - 1);
        for (var V = 0; V < R; V++) L += U[V].width;
        var W = B;
        if (i.align == "right") W = w - L - B;
        if (i.align == "center") W = (w - L) / 2;
        var I = null;
        for (var V = 0; V < R; V++) {
            I = U[V];
            I.x = W;
            I.y = B;
            W += I.width + D;
            I.commit()
        }
        if (N == "split" && Math.abs(w - L) < 15) {
            var z = U[R - 1];
            z.setWidth(w - L + z.width - 2 * B)
        }
        if (I && i.align != "center") o.css({
            width: I.x + I.width + B
        });
        setTimeout(function() {
            for (var t = 0; t < R; t++) U[t].commit()
        }, 200)
    } else {
        var G = i.mVAlign;
        var M = w - 2 * B;
        var U = [];
        var F = parseInt(n.fontSize) + B + 2 + Number(i.vTextPadding);
        if (G == "split") F = Math.max(F, (b - 2 * B + D) / R - D);
        var j = i.mBtnType;
        if (j == "tabDown") j = "tabRight";
        if (j == "tabUp") j = "tabLeft";
        for (var V = 0; V < R; V++) {
            var k = P[V];
            var I = new C(k, n, j, i.mRounding, B, i.sVDir != "inline");
            I.indent = A;
            var q = i.highlightPath == "no" ? k.current : k.selected;
            var E = i.shadeSelected ? q ? i.mShading : 1 : i.mShading;
            I.setColors(q ? r.mTxtSelColor : r.mTxtUpColor, r.mTxtOverColor, q ? r.mSelColor : r.mUpColor, r.mOverColor, E);
            I.hPadding = T;
            o.append(I.el);
            I.setHeight(F);
            M = Math.max(M, I.width);
            U.push(I);
            if (i.sVDir == "pop") {
                I.hover(function() {
                    if (x && x.node == this.node) return;
                    y();
                    if (!p(this.node)) return;
                    x = new m(this.node, 0, false, i.sVAlign);
                    x.move(this.x + this.width + B, this.y);
                    if (!CB5.isIOS) x.el.hide().slideDown("fast")
                })
            } else if (i.sVDir == "inline") {
                I.arrowClick(function() {
                    K(this)
                })
            }
        }

        function J() {
            var t = Q;
            for (var i = 0; i < R; i++) {
                var e = U[i];
                e.x = B;
                e.y = t;
                t += Math.ceil(F + D);
                if (x && x.node == e.node) t += x.height - D;
                e.commit()
            }
            o.css("height", t + B)
        }

        function K(t) {
            for (var e = 0; e < R; e++) U[e].toggArrow(false);
            if (x) {
                var o = x.node;
                x.closeSubnav();
                x.el.remove();
                x = null;
                J();
                if (o == t.node) return
            }
            if (!p(t.node)) return;
            var r = Number(i.sMargin);
            x = new m(t.node, t.width - (A ? 0 : 10), true, i.sVAlign, A * 2);
            var s = i.sVAlign == "up" || A ? 0 : 10;
            x.move(B - r + s, t.y + t.height);
            if (!CB5.isIOS) x.el.hide().slideDown("fast");
            J();
            t.toggArrow(true)
        }
        var Q = G == "bottom" ? b - (F + D) * R + D - B : B;
        for (var V = 0; V < R; V++) {
            var I = U[V];
            I.setWidth(M);
            I.x = B;
            I.y = Q + (F + D) * V;
            I.commit()
        }
        o.css({
            width: M + 2 * B
        });
        J();
        if (i.sVDir == "inline") {
            for (var V = 0; V < R; V++) {
                if (U[V].node.selected && p(U[V].node)) K(U[V])
            }
            if (x) x.openSelected()
        }
        if (i.outline) {
            var c = i.outline.split(",");
            if (c[0]) o.css({
                borderTop: "solid 1px " + c[0]
            });
            if (c[1]) o.css({
                borderRight: "solid 1px " + c[1]
            })
        }
        if (i.bottom != null) {
            o.height("auto");
            o.css("bottom", i.bottom)
        }
    }
    if (!(i.mDirection == "vertical" && i.sVDir == "inline") && CB5.isIOS) {
        $("body").css("cursor", "pointer").bind("mousedown", function() {
            if (x) y()
        })
    }
};