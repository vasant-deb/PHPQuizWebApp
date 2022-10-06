/* Source: src/mt-includes/widgets/google_map_pro/src/common/google_map.jquery.plugin.js*/
(function($) {
    var GOOGLE_MAP_API_LOAD_STATUS = 'NOT_LOADED';
    var API_KEY = '';
    var _googleMapLoadedCallback = 'googleMapLoadedCallback_' + Date.now();
    var queue = [];

    if (typeof google !== 'undefined' && typeof google.maps !== 'undefined') {
        GOOGLE_MAP_API_LOAD_STATUS = 'LOADED';
    }

    function resolveQueue(error) {
        var q;

        while (queue.length) {
            q = queue.shift();

            if (error) {
                q.deferred.reject(error);
            } else {
                q.deferred.resolve(q.instance());
            }
        }
    }

    window[_googleMapLoadedCallback] = function() {
        resolveQueue();
        delete window[_googleMapLoadedCallback];
        GOOGLE_MAP_API_LOAD_STATUS = 'LOADED';
    };

    function checkAndInjectGoogleMapSDK() {
        var $scriptElement;

        if (GOOGLE_MAP_API_LOAD_STATUS === 'LOADED') {
            return resolveQueue();
        }

        if (GOOGLE_MAP_API_LOAD_STATUS === 'LOADING') {
            return false;
        }

        GOOGLE_MAP_API_LOAD_STATUS = 'LOADING';
        $scriptElement = document.createElement('script');
        $scriptElement.type = 'text/javascript';
        $scriptElement.src = 'https://maps.googleapis.com/maps/api/js?key=' + API_KEY + '&callback=' + _googleMapLoadedCallback;
        $scriptElement.defer = true;
        $scriptElement.onerror = function() {
            resolveQueue('Google Map SDK not loaded!');
        };

        document.body.appendChild($scriptElement);
    }

    /**
     * Update url for some resource
     *
     * @param {string} url
     * @param {string} [type]
     * @returns {string}
     */
    function resourceUrlResolveHandler(url) {
        return url;
    }

    function sanitizeMarker(marker) {
        if (!angular.isObject(marker)) {
            return marker;
        }

        if (marker.icon) {
            marker.icon = resourceUrlResolveHandler(marker.icon, 'marker.icon');
        }

        return marker;
    }

    $.fn.motoGoogleMap = function(options) {
        var deferred = $.Deferred();
        var mapDomElement = this[0];
        var _mapInstance;
        var MAP_STYLE_LIST = {
            'standard': [],
            'silver': [{
                'elementType': 'geometry',
                'stylers': [{
                    'color': '#f5f5f5'
                }]
            }, {
                'elementType': 'labels.icon',
                'stylers': [{
                    'visibility': 'off'
                }]
            }, {
                'elementType': 'labels.text.fill',
                'stylers': [{
                    'color': '#616161'
                }]
            }, {
                'elementType': 'labels.text.stroke',
                'stylers': [{
                    'color': '#f5f5f5'
                }]
            }, {
                'featureType': 'administrative.land_parcel',
                'elementType': 'labels.text.fill',
                'stylers': [{
                    'color': '#bdbdbd'
                }]
            }, {
                'featureType': 'poi',
                'elementType': 'geometry',
                'stylers': [{
                    'color': '#eeeeee'
                }]
            }, {
                'featureType': 'poi',
                'elementType': 'labels.text.fill',
                'stylers': [{
                    'color': '#757575'
                }]
            }, {
                'featureType': 'poi.park',
                'elementType': 'geometry',
                'stylers': [{
                    'color': '#e5e5e5'
                }]
            }, {
                'featureType': 'poi.park',
                'elementType': 'labels.text.fill',
                'stylers': [{
                    'color': '#9e9e9e'
                }]
            }, {
                'featureType': 'road',
                'elementType': 'geometry',
                'stylers': [{
                    'color': '#ffffff'
                }]
            }, {
                'featureType': 'road.arterial',
                'elementType': 'labels.text.fill',
                'stylers': [{
                    'color': '#757575'
                }]
            }, {
                'featureType': 'road.highway',
                'elementType': 'geometry',
                'stylers': [{
                    'color': '#dadada'
                }]
            }, {
                'featureType': 'road.highway',
                'elementType': 'labels.text.fill',
                'stylers': [{
                    'color': '#616161'
                }]
            }, {
                'featureType': 'road.local',
                'elementType': 'labels.text.fill',
                'stylers': [{
                    'color': '#9e9e9e'
                }]
            }, {
                'featureType': 'transit.line',
                'elementType': 'geometry',
                'stylers': [{
                    'color': '#e5e5e5'
                }]
            }, {
                'featureType': 'transit.station',
                'elementType': 'geometry',
                'stylers': [{
                    'color': '#eeeeee'
                }]
            }, {
                'featureType': 'water',
                'elementType': 'geometry',
                'stylers': [{
                    'color': '#c9c9c9'
                }]
            }, {
                'featureType': 'water',
                'elementType': 'labels.text.fill',
                'stylers': [{
                    'color': '#9e9e9e'
                }]
            }],
            'retro': [{
                'elementType': 'geometry',
                'stylers': [{
                    'color': '#ebe3cd'
                }]
            }, {
                'elementType': 'labels.text.fill',
                'stylers': [{
                    'color': '#523735'
                }]
            }, {
                'elementType': 'labels.text.stroke',
                'stylers': [{
                    'color': '#f5f1e6'
                }]
            }, {
                'featureType': 'administrative',
                'elementType': 'geometry.stroke',
                'stylers': [{
                    'color': '#c9b2a6'
                }]
            }, {
                'featureType': 'administrative.land_parcel',
                'elementType': 'geometry.stroke',
                'stylers': [{
                    'color': '#dcd2be'
                }]
            }, {
                'featureType': 'administrative.land_parcel',
                'elementType': 'labels.text.fill',
                'stylers': [{
                    'color': '#ae9e90'
                }]
            }, {
                'featureType': 'landscape.natural',
                'elementType': 'geometry',
                'stylers': [{
                    'color': '#dfd2ae'
                }]
            }, {
                'featureType': 'poi',
                'elementType': 'geometry',
                'stylers': [{
                    'color': '#dfd2ae'
                }]
            }, {
                'featureType': 'poi',
                'elementType': 'labels.text.fill',
                'stylers': [{
                    'color': '#93817c'
                }]
            }, {
                'featureType': 'poi.park',
                'elementType': 'geometry.fill',
                'stylers': [{
                    'color': '#a5b076'
                }]
            }, {
                'featureType': 'poi.park',
                'elementType': 'labels.text.fill',
                'stylers': [{
                    'color': '#447530'
                }]
            }, {
                'featureType': 'road',
                'elementType': 'geometry',
                'stylers': [{
                    'color': '#f5f1e6'
                }]
            }, {
                'featureType': 'road.arterial',
                'elementType': 'geometry',
                'stylers': [{
                    'color': '#fdfcf8'
                }]
            }, {
                'featureType': 'road.highway',
                'elementType': 'geometry',
                'stylers': [{
                    'color': '#f8c967'
                }]
            }, {
                'featureType': 'road.highway',
                'elementType': 'geometry.stroke',
                'stylers': [{
                    'color': '#e9bc62'
                }]
            }, {
                'featureType': 'road.highway.controlled_access',
                'elementType': 'geometry',
                'stylers': [{
                    'color': '#e98d58'
                }]
            }, {
                'featureType': 'road.highway.controlled_access',
                'elementType': 'geometry.stroke',
                'stylers': [{
                    'color': '#db8555'
                }]
            }, {
                'featureType': 'road.local',
                'elementType': 'labels.text.fill',
                'stylers': [{
                    'color': '#806b63'
                }]
            }, {
                'featureType': 'transit.line',
                'elementType': 'geometry',
                'stylers': [{
                    'color': '#dfd2ae'
                }]
            }, {
                'featureType': 'transit.line',
                'elementType': 'labels.text.fill',
                'stylers': [{
                    'color': '#8f7d77'
                }]
            }, {
                'featureType': 'transit.line',
                'elementType': 'labels.text.stroke',
                'stylers': [{
                    'color': '#ebe3cd'
                }]
            }, {
                'featureType': 'transit.station',
                'elementType': 'geometry',
                'stylers': [{
                    'color': '#dfd2ae'
                }]
            }, {
                'featureType': 'water',
                'elementType': 'geometry.fill',
                'stylers': [{
                    'color': '#b9d3c2'
                }]
            }, {
                'featureType': 'water',
                'elementType': 'labels.text.fill',
                'stylers': [{
                    'color': '#92998d'
                }]
            }],
            'dark': [{
                'elementType': 'geometry',
                'stylers': [{
                    'color': '#212121'
                }]
            }, {
                'elementType': 'labels.icon',
                'stylers': [{
                    'visibility': 'off'
                }]
            }, {
                'elementType': 'labels.text.fill',
                'stylers': [{
                    'color': '#757575'
                }]
            }, {
                'elementType': 'labels.text.stroke',
                'stylers': [{
                    'color': '#212121'
                }]
            }, {
                'featureType': 'administrative',
                'elementType': 'geometry',
                'stylers': [{
                    'color': '#757575'
                }]
            }, {
                'featureType': 'administrative.country',
                'elementType': 'labels.text.fill',
                'stylers': [{
                    'color': '#9e9e9e'
                }]
            }, {
                'featureType': 'administrative.land_parcel',
                'stylers': [{
                    'visibility': 'off'
                }]
            }, {
                'featureType': 'administrative.locality',
                'elementType': 'labels.text.fill',
                'stylers': [{
                    'color': '#bdbdbd'
                }]
            }, {
                'featureType': 'poi',
                'elementType': 'labels.text.fill',
                'stylers': [{
                    'color': '#757575'
                }]
            }, {
                'featureType': 'poi.park',
                'elementType': 'geometry',
                'stylers': [{
                    'color': '#181818'
                }]
            }, {
                'featureType': 'poi.park',
                'elementType': 'labels.text.fill',
                'stylers': [{
                    'color': '#616161'
                }]
            }, {
                'featureType': 'poi.park',
                'elementType': 'labels.text.stroke',
                'stylers': [{
                    'color': '#1b1b1b'
                }]
            }, {
                'featureType': 'road',
                'elementType': 'geometry.fill',
                'stylers': [{
                    'color': '#2c2c2c'
                }]
            }, {
                'featureType': 'road',
                'elementType': 'labels.text.fill',
                'stylers': [{
                    'color': '#8a8a8a'
                }]
            }, {
                'featureType': 'road.arterial',
                'elementType': 'geometry',
                'stylers': [{
                    'color': '#373737'
                }]
            }, {
                'featureType': 'road.highway',
                'elementType': 'geometry',
                'stylers': [{
                    'color': '#3c3c3c'
                }]
            }, {
                'featureType': 'road.highway.controlled_access',
                'elementType': 'geometry',
                'stylers': [{
                    'color': '#4e4e4e'
                }]
            }, {
                'featureType': 'road.local',
                'elementType': 'labels.text.fill',
                'stylers': [{
                    'color': '#616161'
                }]
            }, {
                'featureType': 'transit',
                'elementType': 'labels.text.fill',
                'stylers': [{
                    'color': '#757575'
                }]
            }, {
                'featureType': 'water',
                'elementType': 'geometry',
                'stylers': [{
                    'color': '#000000'
                }]
            }, {
                'featureType': 'water',
                'elementType': 'labels.text.fill',
                'stylers': [{
                    'color': '#3d3d3d'
                }]
            }],
            'night': [{
                'elementType': 'geometry',
                'stylers': [{
                    'color': '#242f3e'
                }]
            }, {
                'elementType': 'labels.text.stroke',
                'stylers': [{
                    'color': '#242f3e'
                }]
            }, {
                'elementType': 'labels.text.fill',
                'stylers': [{
                    'color': '#746855'
                }]
            }, {
                'featureType': 'administrative.locality',
                'elementType': 'labels.text.fill',
                'stylers': [{
                    'color': '#d59563'
                }]
            }, {
                'featureType': 'poi',
                'elementType': 'labels.text.fill',
                'stylers': [{
                    'color': '#d59563'
                }]
            }, {
                'featureType': 'poi.park',
                'elementType': 'geometry',
                'stylers': [{
                    'color': '#263c3f'
                }]
            }, {
                'featureType': 'poi.park',
                'elementType': 'labels.text.fill',
                'stylers': [{
                    'color': '#6b9a76'
                }]
            }, {
                'featureType': 'road',
                'elementType': 'geometry',
                'stylers': [{
                    'color': '#38414e'
                }]
            }, {
                'featureType': 'road',
                'elementType': 'geometry.stroke',
                'stylers': [{
                    'color': '#212a37'
                }]
            }, {
                'featureType': 'road',
                'elementType': 'labels.text.fill',
                'stylers': [{
                    'color': '#9ca5b3'
                }]
            }, {
                'featureType': 'road.highway',
                'elementType': 'geometry',
                'stylers': [{
                    'color': '#746855'
                }]
            }, {
                'featureType': 'road.highway',
                'elementType': 'geometry.stroke',
                'stylers': [{
                    'color': '#1f2835'
                }]
            }, {
                'featureType': 'road.highway',
                'elementType': 'labels.text.fill',
                'stylers': [{
                    'color': '#f3d19c'
                }]
            }, {
                'featureType': 'transit',
                'elementType': 'geometry',
                'stylers': [{
                    'color': '#2f3948'
                }]
            }, {
                'featureType': 'transit.station',
                'elementType': 'labels.text.fill',
                'stylers': [{
                    'color': '#d59563'
                }]
            }, {
                'featureType': 'water',
                'elementType': 'geometry',
                'stylers': [{
                    'color': '#17263c'
                }]
            }, {
                'featureType': 'water',
                'elementType': 'labels.text.fill',
                'stylers': [{
                    'color': '#515c6d'
                }]
            }, {
                'featureType': 'water',
                'elementType': 'labels.text.stroke',
                'stylers': [{
                    'color': '#17263c'
                }]
            }],
            'aubergine': [{
                'elementType': 'geometry',
                'stylers': [{
                    'color': '#1d2c4d'
                }]
            }, {
                'elementType': 'labels.text.fill',
                'stylers': [{
                    'color': '#8ec3b9'
                }]
            }, {
                'elementType': 'labels.text.stroke',
                'stylers': [{
                    'color': '#1a3646'
                }]
            }, {
                'featureType': 'administrative.country',
                'elementType': 'geometry.stroke',
                'stylers': [{
                    'color': '#4b6878'
                }]
            }, {
                'featureType': 'administrative.land_parcel',
                'elementType': 'labels.text.fill',
                'stylers': [{
                    'color': '#64779e'
                }]
            }, {
                'featureType': 'administrative.province',
                'elementType': 'geometry.stroke',
                'stylers': [{
                    'color': '#4b6878'
                }]
            }, {
                'featureType': 'landscape.man_made',
                'elementType': 'geometry.stroke',
                'stylers': [{
                    'color': '#334e87'
                }]
            }, {
                'featureType': 'landscape.natural',
                'elementType': 'geometry',
                'stylers': [{
                    'color': '#023e58'
                }]
            }, {
                'featureType': 'poi',
                'elementType': 'geometry',
                'stylers': [{
                    'color': '#283d6a'
                }]
            }, {
                'featureType': 'poi',
                'elementType': 'labels.text.fill',
                'stylers': [{
                    'color': '#6f9ba5'
                }]
            }, {
                'featureType': 'poi',
                'elementType': 'labels.text.stroke',
                'stylers': [{
                    'color': '#1d2c4d'
                }]
            }, {
                'featureType': 'poi.park',
                'elementType': 'geometry.fill',
                'stylers': [{
                    'color': '#023e58'
                }]
            }, {
                'featureType': 'poi.park',
                'elementType': 'labels.text.fill',
                'stylers': [{
                    'color': '#3C7680'
                }]
            }, {
                'featureType': 'road',
                'elementType': 'geometry',
                'stylers': [{
                    'color': '#304a7d'
                }]
            }, {
                'featureType': 'road',
                'elementType': 'labels.text.fill',
                'stylers': [{
                    'color': '#98a5be'
                }]
            }, {
                'featureType': 'road',
                'elementType': 'labels.text.stroke',
                'stylers': [{
                    'color': '#1d2c4d'
                }]
            }, {
                'featureType': 'road.highway',
                'elementType': 'geometry',
                'stylers': [{
                    'color': '#2c6675'
                }]
            }, {
                'featureType': 'road.highway',
                'elementType': 'geometry.stroke',
                'stylers': [{
                    'color': '#255763'
                }]
            }, {
                'featureType': 'road.highway',
                'elementType': 'labels.text.fill',
                'stylers': [{
                    'color': '#b0d5ce'
                }]
            }, {
                'featureType': 'road.highway',
                'elementType': 'labels.text.stroke',
                'stylers': [{
                    'color': '#023e58'
                }]
            }, {
                'featureType': 'transit',
                'elementType': 'labels.text.fill',
                'stylers': [{
                    'color': '#98a5be'
                }]
            }, {
                'featureType': 'transit',
                'elementType': 'labels.text.stroke',
                'stylers': [{
                    'color': '#1d2c4d'
                }]
            }, {
                'featureType': 'transit.line',
                'elementType': 'geometry.fill',
                'stylers': [{
                    'color': '#283d6a'
                }]
            }, {
                'featureType': 'transit.station',
                'elementType': 'geometry',
                'stylers': [{
                    'color': '#3a4762'
                }]
            }, {
                'featureType': 'water',
                'elementType': 'geometry',
                'stylers': [{
                    'color': '#0e1626'
                }]
            }, {
                'featureType': 'water',
                'elementType': 'labels.text.fill',
                'stylers': [{
                    'color': '#4e6d70'
                }]
            }]
        };

        function createInstance() {
            options.styles = MAP_STYLE_LIST[options.theme];
            _mapInstance = new google.maps.Map(mapDomElement, options);

            return {
                getMap: function() {
                    return _mapInstance;
                },
                setZoom: function(zoom) {
                    _mapInstance.setZoom(zoom);
                },
                getZoom: function() {
                    return _mapInstance.getZoom();
                },
                setCenter: function(center) {
                    return _mapInstance.setCenter(center);
                },
                getCenter: function() {
                    return {
                        lat: _mapInstance.getCenter().lat(),
                        lng: _mapInstance.getCenter().lng()
                    };
                },
                /**
                 * @type {MarkerCollection}
                 */
                _markers: new MarkerCollection(_mapInstance),
                addMarker: function(options) {
                    this._markers.add(options);
                },
                deleteMarker: function(marker) {
                    this._markers.delete(marker);
                },
                showOnlyMarker: function(marker) {
                    this._markers.showOnly(marker);
                },
                updateMarker: function(marker) {
                    this._markers.update(marker);
                },
                clearAllMarkers: function() {
                    this._markers.clearAll();
                }
            };
        }

        function MarkerCollection(map) {
            this.items = [];
            this.map = map;
            this.withInfowWindow = true;
        }

        MarkerCollection.prototype.add = function(marker) {
            var markerIndex;
            var markerData;

            if (Array.isArray(marker)) {
                angular.forEach(marker, this.add.bind(this));

                return this;
            }

            markerData = $.extend(true, {}, marker);

            if (!(marker instanceof google.maps.Marker)) {
                marker = new google.maps.Marker(marker);
            }
            sanitizeMarker(marker);
            marker.setMap(this.map);

            this.items.push(marker);
            if (this.withInfowWindow) {
                this.setInfoWindow(marker);
            } else {
                google.maps.event.addListener(marker, 'click', function() {
                    markerIndex = this.items.indexOf(marker);
                    $(document).trigger('motoGoogleMap:markerClick', [markerData, markerIndex]);
                }.bind(this));

                google.maps.event.addListener(marker, 'dragend', function() {
                    $(document).trigger('motoGoogleMap:markerDragend', marker.getPosition());
                }.bind(this));
            }

            return this;
        };

        MarkerCollection.prototype.update = function(data) {
            var name;
            var currentMarker = this.getByUid(data.uid);

            if (!angular.isObject(data)) {
                return false;
            }

            data = angular.copy(data);
            sanitizeMarker(data);

            for (name in data) {
                if (!data.hasOwnProperty(name)) {
                    continue;
                }
                if (name[0] === '_' || name[0] === '$' || typeof data[name] === 'function') {
                    continue;
                }
                try {
                    if (name === 'position') {
                        currentMarker.setPosition(data[name]);
                    } else {
                        currentMarker.set(name, data[name]);
                    }
                } catch (e) {
                    console.warn('UpdateMarker : error on set property value ', name, data[name]);
                }
            }

            return true;
        };

        MarkerCollection.prototype.delete = function(marker) {
            var index;

            marker = this.getByUid(marker.uid);
            if (!marker) {
                return;
            }
            marker.setMap(null);

            index = this.items.indexOf(marker);
            if (index > -1) {
                this.items.splice(index, 1);
            }
        };

        MarkerCollection.prototype.clearAll = function() {
            this.items.forEach(function(marker) {
                marker.setMap(null);
            });

            this.items = [];
        };

        MarkerCollection.prototype.getItems = function() {
            return this.items;
        };

        MarkerCollection.prototype.showOnly = function(marker) {
            var i;
            var len;

            for (i = 0, len = this.items.length; i < len; i++) {
                if (this.items[i].get('uid') !== marker.uid) {
                    this.items[i].setVisible(false);
                } else {
                    this.items[i].setDraggable(true);
                }
            }
        };

        MarkerCollection.prototype.setInfoWindow = function(marker) {
            var infoWindow;

            if (marker.caption && marker.caption.length) {
                infoWindow = new google.maps.InfoWindow();
                infoWindow.setContent('<div class="moto-widget-text">' + marker.caption + '</div>');
                if (marker.showInfoByDefault) {
                    infoWindow.open(this.map, marker);
                }
                marker.addListener('click', function() {
                    infoWindow.open(this.map, marker);
                }.bind(this));
            }
        };

        MarkerCollection.prototype.getByUid = function(uid) {
            var i;
            var len;

            for (i = 0, len = this.items.length; i < len; i++) {
                if (this.items[i].get('uid') === uid) {
                    return this.items[i];
                }
            }

            return null;
        };

        queue.push({
            deferred: deferred,
            instance: createInstance
        });

        checkAndInjectGoogleMapSDK();

        return deferred.promise();
    };

    /**
     * Set function for resolve resource url
     *
     * @param {function} handler
     * @returns {boolean}
     */
    $.fn.motoGoogleMap.setUrlResolveHandler = function(handler) {
        if (!angular.isFunction(handler)) {
            return false;
        }
        resourceUrlResolveHandler = handler;

        return true;
    };
    $.fn.motoGoogleMap.isSdkInjected = function() {
        return GOOGLE_MAP_API_LOAD_STATUS !== 'NOT_LOADED' && GOOGLE_MAP_API_LOAD_STATUS !== 'LOADING';
    };
    $.fn.motoGoogleMap.isSdkReady = function() {
        return GOOGLE_MAP_API_LOAD_STATUS === 'LOADED';
    };
    $.fn.motoGoogleMap.setApiKey = function(value) {
        if (typeof value !== 'string') {
            throw new Error('[motoGoogleMap.setApiKey] Bad argument: ApiKey must be a string, got ' + typeof value);
        }
        if ($.fn.motoGoogleMap.isSdkInjected()) {
            return false;
        }
        API_KEY = value;

        return true;
    };
}(jQuery));