// declaring strict mode
"use strict";

 define( function () {
    var w = window,
    d = document,
    e = document.documentElement,
    g = document.getElementsByTagName('body')[0],
    x = window.innerWidth,
    y = window.innerHeight;

    return {

				/**
				* @method isArray
				*
				* @return {Bolean}
				*/
        isArray: function(obj) {
            return Object.prototype.toString.call(obj) === '[object Array]';
        },

				/**
				* @method isFunction
				*
				* @return {Bolean}
				*/
        isFunction: function (obj) {
            return Object.prototype.toString.call(obj) === '[object Function]';
        },

				/**
				* @method makeArray
				*
				* @desc Make Array from String
				*
				* @param {String} arrayLike
				* @return {Array}
				*/
        makeArray: function (arrayLike) {
            if(arrayLike.length != null) {
                return Array.prototype.slice.call(arrayLike, 0).filter( function (ele) {
									return ele !== undefined;
								});
            }
            return [];
        },

				set_cookie: function(key, value)
				{
					 var d = new Date();
					 d.setTime(d.getTime() + (10*24*60*60*1000));
					 var cookieDate = d.toUTCString();
					 document.cookie = key + '=' + encodeURI(value) + "; expires=" + cookieDate + "; path=/";
				},

				hasCookie: function(key)
				{
						if( this.getCookie(key) )
						{
								return true;
						}
				},

				/**
				* @method getCookie
				*
				* @desc Fetch the cookie by name
				*
				* @param {String} name
				* @return {Array}
				*/
				getCookie: function (name) {
					if(this.hasCookie(name)) {
						var value = "; " + document.cookie;
						var parts = value.split("; " + name + "=");
						if (parts.length == 2) return parts.pop().split(";").shift();
					}
					return false;
				},

				/**
				* @method deleteCookie
				*
				* @desc Delete the cookie by name
				*
				* @param {String} name
				*/
        delete_cookie : function ( name ) {
					if(this.hasCookie(name)) {
						document.cookie = name + '=; expires=Thu, 01 Jan 1970 00:00:01 GMT;';
					}
					return false;
        },

				supportSVG : function () {
						return !!(document.createElementNS && document.createElementNS('http://www.w3.org/2000/svg','svg').createSVGRect);
				},

				generate_id: function (length) {
						var chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXTZabcdefghiklmnopqrstuvwxyz'.split(''),
						str = '';

						if (! length) {
							length = Math.floor(Math.random() * chars.length);
						}
						for (var i = 0; i < length; i++) {
							str += chars[Math.floor(Math.random() * chars.length)];
						}

						return str;
				},

        fitToWindow : function (e) {
            var el = this.d.querySelector(e);
            var h = this.w.innerHeight;
            if ( !el ) return;
            el.style.height = h + 'px';
        },

        fullscreen : function (e) {
            this.fitToWindow(e);
            window.onresize = function() {
                this.fitToWindow(e);
            }
        },

        dekstop_nav__hide : function () {
    		// We need to position the header above the window before we make it fixed so that
    		// it can transition down

		    		var didScroll;
		    		var lastScrollTop = 0;
		    		var delta = 5;
		    		var navbarHeight = $('header nav#mainMenu').outerHeight();

		    		$(window).scroll(function(event)
		    		{
		    			 didScroll = true;
		    		});

		    		setInterval(function()
		    		{
		    			 if (didScroll) {
		    				  hasScrolled();
		    				  didScroll = false;
		    			 }
		    		}, 250);

		    		function hasScrolled()
		    		{
		    			 var st = $(window).scrollTop();
		    			 // Make surce they scroll more than delta
		    			 if(Math.abs(lastScrollTop - st) <= delta)
		    				  return;

		    			 // If they scrolled down and are past the navbar, add hide class
		    			 // This is necessary so you never see what is "behind" the navbar.
		    			 if(st == 0) {
		    				$('header').removeClass('header--hide-it');
		    				$('header').removeClass('header--fixed');
		    				$('header').find('.nav__menu').addClass('flex-row__flex-col--center').removeClass('flex-row__flex-col--centered');

		    			// Scroll Down. So hide for better UX (reading)
		    			 } else if (st > lastScrollTop && st > 0){
		    				  $('header').addClass('header--hide-it').removeClass('header--fixed');
		    				  $('header').find('.nav__menu').addClass('flex-row__flex-col--centered').removeClass('flex-row__flex-col--center');

		    	  		// Scroll Up. So show the menu.
		    			// If we're above the navbar, show full,
		    			// otherwise diet.
		    			 } else {
		    				  if(st + $(window).height() < navbarHeight) {
		    						$('header').removeClass('header--hide-it');
		    				  } else {
		    					  $('header').removeClass('header--hide-it');
		    					  $('header').addClass('header--fixed');
		    				  }
		    			 }
		    			 lastScrollTop = st;
		    		}
    		},

	      loadScript: function (src, done) {
	          var js = document.createElement('script');
	          js.src = src;
	          js.onload = function() {
	              done();
	          };
	          js.onerror = function() {
	              done(new Error('Failed to load script ' + src));
	          };
	          document.head.appendChild(js);
	      },


	      param : function(object)
	      {
	          var encodedString = '';
	          for (var prop in object) {
	              if (object.hasOwnProperty(prop)) {
	                  if (encodedString.length > 0) {
	                      encodedString += '&';
	                  }
	                  encodedString += encodeURI(prop + '=' + object[prop]);
	              }
	          }
	          return encodedString;
	      },

	      perf : function()
	      {
	          var perfBar = function(budget) {

	              window.onload = function() {
	                  window.performance = window.performance || window.mozPerformance || window.msPerformance || window.webkitPerformance || {};


	                  var timing = window.performance.timing,
	                  now = new Date().getTime(),
	                  output, loadTime;

	                  if (!timing) {
	                      //fail silently
	                      return;
	                  }
	                  budget = budget ? budget : 1000;
	                  var start = timing.navigationStart;

	                  var results = document.createElement('div');
	                  results.setAttribute('id', 'results');
	                  loadTime = now - start;
	                  results.innerHTML = (now - start) + "ms";
	                  if (loadTime > budget) {
	                      results.className += ' overBudget';
	                  } else {
	                      results.className += ' underBudget';
	                  }
	                  document.body.appendChild(results);
	              }

	          };
	          window.perfBar = perfBar;

	      },

          debouncer: function(a,b,c){var d;return function(){var e=this,f=arguments,g=function(){d=null,c||a.apply(e,f)},h=c&&!d;clearTimeout(d),d=setTimeout(g,b),h&&a.apply(e,f)}},

          getScrollXY: function(){var a=0,b=0;return"number"==typeof window.pageYOffset?(b=window.pageYOffset,a=window.pageXOffset):document.body&&(document.body.scrollLeft||document.body.scrollTop)?(b=document.body.scrollTop,a=document.body.scrollLeft):document.documentElement&&(document.documentElement.scrollLeft||document.documentElement.scrollTop)&&(b=document.documentElement.scrollTop,a=document.documentElement.scrollLeft),[a,b]},

          getDocHeight: function(){var a=document;return Math.max(a.body.scrollHeight,a.documentElement.scrollHeight,a.body.offsetHeight,a.documentElement.offsetHeight,a.body.clientHeight,a.documentElement.clientHeight)},

          affixFileName : function(s, affix) {
        		return s.substring(0, s.lastIndexOf(".")) + affix + s.substring(s.lastIndexOf("."));
        	}

    };
});
