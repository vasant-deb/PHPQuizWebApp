/* Source: src/mt-includes/js/src/core/DependencyService.js*/
angular.module('website.core.dependency')
    .provider('motoDependencyService', ['motoWebsiteSettingsServiceProvider', function(WebsiteSettingsService) {
        var self = this,
            $rootScope = null,
            service = {},
            $head = angular.element('head').get(0),
            $body = angular.element('body').get(0),
            items = {};

        function createQueryParams(params) {
            var parts = [];
            for (var i in params) {
                if (params[i].length > 0) {
                    parts.push(i + '=' + params[i]);
                }
            }

            return parts.join('&');
        }

        function getHeadElement() {
            return $head;
        }

        function getBodyElement() {
            return $body;
        }

        items = {
            disqus: {
                name: 'disqus',
                urlTemplate: '//{{shortname}}.disqus.com/embed.js',
                params: {},
                setParams: function(values) {
                    for (var i in values) {
                        if (values.hasOwnProperty(i)) {
                            this.setParam(i, values[i]);
                        }
                    }

                    return this;
                },
                getParams: function() {
                    return this.params;
                },
                setParam: function(name, value) {
                    this.params[name] = value;
                    if (value != '') {
                        window['disqus_' + name] = value;
                    }

                    return this;
                },
                getParam: function(name, def) {
                    if (!angular.isUndefined(this.params[name])) {
                        return this.params[name];
                    }
                    if (!angular.isUndefined(window['disqus_' + name])) {
                        return window['disqus_' + name];
                    }

                    return def;
                },
                getUrl: function() {
                    return this.urlTemplate
                        .replace(/\{\{shortname\}\}/gi, this.getParam('shortname'));
                },
                preInject: angular.noop,
                postInject: angular.noop,
                require: function() {
                    service.require(this.name);

                    return this;
                }
            },
            facebook: {
                name: 'facebook',
                scriptId: 'facebook-jssdk',
                urlTemplate: '//connect.facebook.net/{{language}}/sdk.js#{{params}}',
                language: 'en_US',
                getLanguage: function() {
                    return this.language;
                },
                setLanguage: function(language) {
                    return this.language = language;
                },
                getUrl: function() {
                    return this.urlTemplate
                        .replace(/\{\{language\}\}/gi, this.getLanguage())
                        .replace(/\{\{params\}\}/gi, createQueryParams(this.getParams()));
                },
                params: {
                    version: 'v2.8',
                    xfbml: '1',
                    appId: ''
                },
                setParams: function(values) {
                    for (var i in values) {
                        if (values.hasOwnProperty(i)) {
                            this.setParam(i, values[i]);
                        }
                    }

                    return this;
                },
                getParams: function() {
                    return this.params;
                },
                setParam: function(name, value) {
                    this.params[name] = value;

                    return this;
                },
                getParam: function(name, def) {
                    if (!angular.isUndefined(this.params[name])) {
                        return this.params[name];
                    }

                    return def;
                },
                preInject: function(instance) {
                    var fbRoot = document.getElementById('fb-root');
                    if (!fbRoot) {
                        fbRoot = document.createElement('div');
                        fbRoot.id = 'fb-root';
                        getBodyElement().appendChild(fbRoot);
                    }
                },
                postInject: angular.noop,
                require: function() {
                    service.require(this.name);

                    return this;
                }
            },
            twitter: {
                name: 'twitter',
                scriptId: 'twitter-wjs',
                url: '//platform.twitter.com/widgets.js',
                getUrl: function() {
                    return this.url;
                },
                params: {},
                setParams: function(values) {
                    for (var i in values) {
                        if (values.hasOwnProperty(i)) {
                            this.setParam(i, values[i]);
                        }
                    }

                    return this;
                },
                getParams: function() {
                    return this.params;
                },
                setParam: function(name, value) {
                    this.params[name] = value;

                    return this;
                },
                getParam: function(name, def) {
                    if (!angular.isUndefined(this.params[name])) {
                        return this.params[name];
                    }

                    return def;
                },
                preInject: angular.noop,
                postInject: angular.noop,
                require: function() {
                    service.require(this.name);

                    return this;
                }
            },
            pinterest: {
                name: 'pinterest',
                scriptUrl: "//assets.pinterest.com/js/pinit.js",
                getUrl: function() {
                    return this.scriptUrl;
                },
                preInject: angular.noop,
                postInject: angular.noop,
                require: function() {
                    service.require(this.name);

                    return this;
                }
            },
            linkedin: {
                name: 'linkedin',
                scriptUrl: '//platform.linkedin.com/in.js',
                getUrl: function() {
                    return this.scriptUrl;
                },
                preInject: function(instance) {
                    var preferredLocale = WebsiteSettingsService.get('preferredLocale', 'en_US');
                    var innerText = instance.innerText;

                    window._DependencyServiceOnLinkedInLoad = function() {
                        if ($rootScope) {
                            $rootScope.$emit('motoDependencyService.linkedin.loaded');
                        }
                        window._DependencyServiceOnLinkedInLoad = function() {};
                    };
                    innerText += ' onLoad: _DependencyServiceOnLinkedInLoad\n';
                    if (preferredLocale) {
                        innerText += ' lang: ' + preferredLocale;
                    }
                    instance.textContent = innerText;
                },
                postInject: angular.noop,
                require: function() {
                    service.require(this.name);

                    return this;
                }
            },
            'instagram_post': {
                name: 'instagram_post',
                scriptUrl: 'https://www.instagram.com/embed.js',
                getUrl: function() {
                    return this.scriptUrl;
                },
                preInject: angular.noop,
                postInject: angular.noop,
                require: function() {
                    service.require(this.name);

                    return this;
                }
            },
            'airbnb_embed': {
                name: 'airbnb_embed',
                scriptUrl: '//airbnb.com/embeddable/airbnb_jssdk',
                getUrl: function() {
                    return this.scriptUrl;
                },
                preInject: angular.noop,
                postInject: angular.noop,
                require: function() {
                    service.require(this.name);

                    return this;
                }
            }
        };

        function require(name) {
            if (angular.isArray(name)) {
                angular.forEach(name, function(value) {
                    require(value);
                });

                return;
            }

            try {
                if (!items[name]) {
                    return false;
                }
                var item = items[name],
                    id = item.scriptId || 'connector_' + name,
                    instance = document.getElementById(id);
                if (instance) {
                    return;
                }
                instance = document.createElement('script');
                //@TODO : add attributes
                instance.id = id;
                instance.src = item.getUrl();
                instance.type = 'text/javascript';
                item.preInject(instance);
                getHeadElement().appendChild(instance);
                item.postInject(instance);

            } catch (e) {
                return false;
            }

            return true;
        }

        function getItem(name) {
            return items[name];
        }

        this.require = require;
        service.require = require;

        this.get = getItem;
        service.get = getItem;

        this.$get = [
            '$rootScope',
            function(_rootScope) {
                $rootScope = _rootScope;

                return service;
            }
        ];
    }]);