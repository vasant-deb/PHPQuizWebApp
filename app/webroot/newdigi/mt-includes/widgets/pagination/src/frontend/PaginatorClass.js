/* Source: src/mt-includes/widgets/pagination/src/frontend/PaginatorClass.js*/
angular.module('website.widgets').service('website.library.PaginatorClass', [
    function() {

        function PageItemClass(value) {
            this.value = value;
            this.number = null;

            if (angular.isObject(value) && angular.isDefined(value['number'])) {
                this.number = value.number;
            }
        }

        PageItemClass.prototype = {
            value: null,
            number: null,
            getLink: function() {
                return this.value && this.value.link;
            }
        };

        /**
         * @param {*} item
         * @returns {PageItemClass}
         */
        function transformItem(item) {
            if (item instanceof PageItemClass) {
                return item;
            }

            return new PageItemClass(item);
        }

        /**
         * @param {Array} items
         * @returns {PageItemClass[]}
         */
        function transformItems(items) {
            var result = [];
            var i;
            var len;

            for (i = 0, len = items.length; i < len; i++) {
                result.push(transformItem(items[i]));
            }

            return result;
        }

        function PaginatorClass() {
            this._events = {};
            this.reset();
        }

        PaginatorClass.prototype = {
            pageRange: 5,
            pageCount: 0,
            currentNumber: 1,
            firstNumber: null,
            previousNumber: null,
            nextNumber: null,
            lastNumber: null,
            /**
             * @type {PageItemClass[]}
             */
            pages: [],
            pagesInRange: [],

            _events: {},

            /**
             * @param {string} name
             * @param {Function} callback
             * @returns {boolean}
             */
            $on: function(name, callback) {
                if (!angular.isString(name) || !angular.isFunction(callback)) {
                    return false;
                }

                this._events[name] = this._events[name] || [];
                this._events[name].push(callback);

                return true;
            },

            $trigger: function(name, data) {
                var i;
                var len;
                var event = {
                    name: name
                };

                if (!this._events[name]) {
                    return false;
                }
                for (i = 0, len = this._events[name].length; i < len; i++) {
                    this._events[name][i](event, data);
                }
            },

            /**
             * Reset paginator data
             */
            reset: function() {
                this.pageRange = 5;
                this.pageCount = 0;
                this.first = null;
                this.firstNumber = 0;
                this.previous = null;
                this.previousNumber = null;
                this.current = null;
                this.currentNumber = 0;
                this.next = null;
                this.nextNumber = null;
                this.last = null;
                this.lastNumber = null;
                this.pages = [];
                this.pagesInRange = [];
            },

            /**
             * @param {int} range
             */
            setPageRange: function(range) {
                range = parseInt(range);

                if (isNaN(range) || range < 1) {
                    return false;
                }

                this.pageRange = range;
                this.updatePagesInRange();

                return true;
            },

            updatePagesInRange: function() {
                var i;
                var maxIndex = Math.min(this.pageCount, this.pages.length);
                var firstIndex = Math.round(this.currentNumber - this.pageRange / 2) - 1;

                if (maxIndex - firstIndex < this.pageRange) {
                    firstIndex = firstIndex - (this.pageRange - (maxIndex - firstIndex));
                }

                if (firstIndex < 0) {
                    firstIndex = 0;
                }

                this.pagesInRange.length = 0;

                for (i = firstIndex; i < maxIndex; i++) {
                    this.pagesInRange.push(this.pages[i]);
                    if (this.pagesInRange.length >= this.pageRange) {
                        break;
                    }
                }

            },

            /**
             * @returns {boolean}
             */
            isDataExists: function() {
                return !!this.pages.length;
            },

            /**
             * @TODO : rename method
             *
             * @param {Object} data
             * @param {int} data.current
             * @param {Array} data.pages
             */
            setData: function(data) {
                this.reset();
                if (angular.isArray(data) || !angular.isObject(data)) {
                    return false;
                }
                this.pages = transformItems(data.pages);
                this.pageCount = data.pages.length;

                this.firstNumber = 1;
                this.first = this.getFirstPage() || new PageItemClass();
                this.last = this.getLastPage() || new PageItemClass();
                this.lastNumber = this.last.number;

                this.setCurrentPageNumber(data.current);

                return true;
            },

            /**
             * Return page by number
             *
             * @param {int} number
             * @returns {PageItemClass|null}
             */
            getPageByNumber: function(number) {
                return this.pages[number - 1];
            },

            /**
             * @returns {PageItemClass|undefined}
             */
            getFirstPage: function() {
                return this.pages[0];
            },

            /**
             * @returns {PageItemClass|undefined}
             */
            getPreviousPage: function() {
                return this.getPageByNumber(this.currentNumber - 1);
            },

            /**
             * @returns {PageItemClass|undefined}
             */
            getCurrentPage: function() {
                return this.getPageByNumber(this.currentNumber);
            },

            /**
             * @returns {PageItemClass|undefined}
             */
            getNextPage: function() {
                return this.getPageByNumber(this.currentNumber + 1);
            },

            /**
             * @returns {PageItemClass|undefined}
             */
            getLastPage: function() {
                return this.pages[this.pages.length - 1];
            },

            setCurrentPageNumber: function(number) {
                number = parseInt(number);

                if (isNaN(number)) {
                    return false;
                }

                this.currentNumber = number;
                if (number > 1) {
                    this.previousNumber = number - 1;
                }
                if (number < this.pages.length) {
                    this.nextNumber = number + 1;
                }

                this.previous = this.getPreviousPage() || new PageItemClass();
                this.current = this.getCurrentPage() || new PageItemClass();
                this.next = this.getNextPage() || new PageItemClass();
                this.updatePagesInRange();

                return true;
            },

            selectPage: function(page) {

                if (angular.isNumber(page)) {
                    page = this.getPageByNumber(page);
                }

                if (page instanceof PageItemClass) {
                    this.$trigger('selected', page.value);
                }
            }
        };

        return PaginatorClass;
    }
]);