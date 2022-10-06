Topbanner = {
    buttonAction: function(action) {
        if (action == 'next')
            document.location = Topbanner.getActionUrl() + 'next/0';
        else
            getApp().topbarWindow(action);
    },

    /*
    getActionUrl: function()
    {
    	return 'http://sitebuilder.cabanova.com/action/topbanner/';
    },
    */

    getTranslation: function(key) {
        return TBDictionary[key];
    },

    getElem: function(id) {
        return document.getElementById(id);
    },

    showVoteResult: function(result) {
        if (result == 'ok') {
            getApp().topbarWindow('vote');
        } else if (result == 'error') {
            getApp().topbarWindow('duplicatevote');
        }
    },

    //template object is now available (in main flash app) and we are able to access config
    onBuilderReady: function(vars) {
        var el = document.getElementById('topBanner');
        el.style.display = 'block';
        el.innerHTML = TBWidget.render(vars);

        //TBWidget.setAction(Topbanner.getActionUrl() + getApp().getConfig('userid')); 
    },

    render: function() {
        //document.write('<div id="topBanner" style="height:28px;display:none"></div>');
    }

};




SWFEmbed = {
    isIE: navigator.appName.indexOf("Microsoft") != -1,

    getCode: function(id, src, width, height, params, vars) {
        //params.FLASHVARS = vars.url;
        //alert("bv "+this._buildVars(vars);
        //alert("get code "+src);		

        /*
		 * 
<object type="application/x-shockwave-flash" id="index" data="shared/starter.swf" width="100%" height="100%" style="visibility: visible; height: 898px; "><param name="allowFullScreen" value="true"><param name="bgcolor" value="FFFFFF"><param name="flashvars" value="startClass=ro.cabanova.template.TemplatePublish&amp;lib=shared/publish_lib,shared/commonSkins,shared/buttons,shared/videoLib&amp;tplTop=50&amp;preloader=shared/preloader.swf&amp;startPage=f3-5j0x4sawt9mo-uwnpq&amp;alignMode=T"></object>
		 */



        if (this.isIE) return (
            '<object id="' + id + '" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="' + width + '" height="' + height + '">' +
            this._buildVars(vars) +
            '<param name="movie" value="' + src + '" />' + this._buildParams(params) +
            '</object>'
        );

        return (
            '<object flashvars="url=aaa" id="' + id + '" type="application/x-shockwave-flash" data="' + src + '" width="' + width + '" height="' + height + '"' +
            ' ' + this._buildParams(params) + '>' + this._buildVars(vars) +
            '</object>'
        );
    },

    _buildParams: function(params) {
        result = '';
        for (var param in params)
            result += !this.isIE ?
            '<param name="' + param + '" value="' + params[param] + '" />' :
            param + '="' + params[param] + '" ';
        return result;
    },

    _buildVars: function(vars) {
        var str = '';
        for (var key in vars) str += key + '=' + vars[key] + '&';
        str = str.substr(0, str.length - 1);
        //flashVars="FlashParameters=FireFox,Safari,Chrome"
        return '<param name="flashvars" value="' + str + '">';
    }

};

TBWidget = {

    id: 'TBWidgetMovie',

    render: function(vars) {
        return SWFEmbed.getCode(TBWidget.id, 'shared/topbanner/TBWidget.swf', '100%', '100%', {
            quality: 'best',
            bgcolor: '#344388'
        }, vars);
    },

    app: function() {
        return getApp(TBWidget.id);
    },

    setAction: function(url) {
        //alert("set action "+TBWidget.id);
        //getApp('index').setWidgetAction(url);
        //alert(TBWidget.app().setWidgetAction);
        TBWidget.app().setWidgetAction(url);
    }
};

ShareThis = {

    //this is model used by flash to show widgets on the topbar
    getModel: function() {
        return [{
                name: 'Facebook',
                offset: 3,
                width: 670,
                height: 350,
                src: 'http://www.facebook.com/sharer.php?u=__URL__'
            },
            {
                name: 'Twitter',
                offset: 0,
                width: 600,
                height: 400,
                src: 'http://twitter.com/share?original_referer=__URL__'
            },
            {
                name: 'Google+',
                offset: 2,
                width: 800,
                height: 400,
                src: 'https://plus.google.com/share?url=__URL__'
            }
            //{name: 'Print', offset: 109, src: 'print'}
        ];
    },

    //this is model for popup window with more widgets, used in topbarwindow
    getMoreModel: function() {
        return [{
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
                src: 'http://www.facebook.com/sharer.php?u=__URL__'
            },
            {
                name: 'Delicious',
                offset: 5,
                width: 750,
                height: 500,
                src: 'http://delicious.com/save?v=5&amp;noui&amp;jump=close&amp;url=__URL__'
            },
            {
                name: 'Twitter',
                offset: 0,
                width: 600,
                height: 400,
                src: 'http://twitter.com/share?original_referer=__URL__'
            },
            {
                name: 'MySpace',
                offset: 11,
                width: 600,
                height: 400,
                src: 'http://www.myspace.com/Modules/PostTo/Pages/?u=__URL__'
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
                src: 'http://www.formspring.me/share?url=__URL__'
            },
            {
                name: 'Digg',
                offset: 8,
                width: 1024,
                height: 400,
                src: 'http://digg.com/submit?url=__URL__'
            },
            {
                name: 'StumbleUpon',
                offset: 9,
                width: 800,
                height: 500,
                src: 'http://www.stumbleupon.com/submit?url=__URL__'
            },
            {
                name: 'Blogger',
                offset: 10,
                width: 800,
                height: 600,
                src: 'http://www.blogger.com/blog_this.pyra?t=&u=__URL__?sms_ss=blogger&n=__URL__'
            },
            {
                name: 'LinkedIn',
                offset: 12,
                width: 550,
                height: 380,
                src: 'http://www.linkedin.com/shareArticle?mini=true&url=__URL__'
            }
            //{name: 'Favorites', offset: 4, onClick: 'ShareThis.addBookmark', disabled: /Chrom/g.test(window.navigator.userAgent.toString())}
        ];
    },

    share: function(obj) {
        if (obj.onClick) {
            eval(obj.onClick)();
            return;
        }

        var sx = typeof window.screenX != 'undefined' ? window.screenX : window.screenLeft;
        var sy = typeof window.screenY != 'undefined' ? window.screenY : window.screenTop;
        var ow = typeof window.outerWidth != 'undefined' ? window.outerWidth : document.documentElement.clientWidth;
        var oh = typeof window.outerHeight != 'undefined' ? window.outerHeight : (document.documentElement.clientHeight - 22);
        sx = (sx < 0) ? window.screen.width + sx : sx;

        var _w = Math.min(obj.width, window.screen.width);
        var _h = Math.min(obj.height, window.screen.height);

        var _left = parseInt(sx + ((ow - _w) / 2), 10);
        var _top = parseInt(sy + ((oh - _h) / 2.5), 10);

        var url = obj.src.replace(/__URL__/g, encodeURIComponent(window.location.href));

        window.open(url, null,
            'width=' + _w + ',height=' + _h + ',' +
            'toolbar=no,directories=no,status=no,menubar=no,resizable=no,' +
            'top=' + _top + ',left=' + _left
        );

    },

    addBookmark: function() {
        var _href = window.location.href;
        if (document.all)
            window.external.AddFavorite(_href, _href);
        else if (window.sidebar)
            window.sidebar.addPanel(_href, _href, '');
    },

    more: function() {
        ShareThis.close();

        var _width = 400;
        var _height = 400;

        ShareThis.popup = document.createElement('div');
        ShareThis.popup.style.background = 'white';
        ShareThis.popup.style.padding = '10px';
        ShareThis.popup.style.border = '2px solid #5160A5';
        ShareThis.popup.style.borderTop = 'none';
        CB.$('page').appendChild(ShareThis.popup);

        var m = ShareThis.getMoreModel();
        for (var i = 0; i < m.length; i++) {
            var item = m[i];
            ShareThis.popup.innerHTML += '<div><a href="#" ' +
                'onclick="ShareThis.close(); ShareThis.shareByIndex(' + i + ');">' +
                item.name + '</a></div>';
        }

        ShareThis.popup.innerHTML = '<a href="#" onclick="ShareThis.close();" style="display: block; float: right;">' +
            '<img src="shared/topbanner/icon-close.png" alt="Close" border="0"/></a>' + ShareThis.popup.innerHTML;

        CB.geom(ShareThis.popup, (f_clientWidth() - _width) / 2, 0, _width, _height);
    },

    popup: null,

    close: function() {
        if (ShareThis.popup) CB.$('page').removeChild(ShareThis.popup);
        ShareThis.popup = null;
    }

};
//document.getElementById('topBannerContainer').innerHTML = TBWidget.render();