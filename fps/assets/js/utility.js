// declaring strict mode
"use strict";

(function(global) {
    var Util = {

        w : window,

        d : document,

        e : document.documentElement,

        g : document.getElementsByTagName('body')[0],

        x : window.innerWidth,

        y : window.innerHeight,

        isArray: function(obj) {
            return Object.prototype.toString.call(obj) === '[object Array]';
        },

        isFunction: function(obj) {
            return Object.prototype.toString.call(obj) === '[object Function]';
        },

        each: function(obj, callback) {
            var length = obj.length,
                isObj = (length === undefined) || this.isFunction(obj);
            if (isObj) {
                for(var name in obj) {
                    if(callback.call(obj[name], obj[name], name) === false ) {
                        break;
                    }
                }
            }
            else {
                for(var i = 0, value = obj[0];
                    i < length && callback.call(obj[i], value, i) !== false;
                    value = obj[++i] ) {}
            }
            return obj;
        },

        makeArray: function(arrayLike) {
            if(arrayLike.length != null) {
                return Array.prototype.slice.call(arrayLike, 0)
                        .filter(function(ele) { return ele !== undefined; });
            }
            return [];
        },

        fitToWindow : function(e) {
            var el = this.d.querySelector(e);
            var h = this.w.innerHeight;
            if ( !el ) return;
            el.style.height = h + 'px';
        },

        fullscreen : function(e)
        {
            this.fitToWindow(e);
            window.onresize = function() {
                Util.fitToWindow(e);
            }
        },

        delegate : function(el, evt, sel, handler)
        {
            el.addEventListener(evt, function(event) {
                var t = event.target;
                while (t && t !== this) {
                    if( typeof t.matches === 'function' )
                    {
                        if (t.matches(sel))
                        {
                            handler.call(t, event);
                        }
                    } else {
                        if (t.matchesSelector(sel))
                        {
                            handler.call(t, event);
                        }
                    }

                    t = t.parentNode;
                }
            });
        },

        getCookie: function(name) {
          var value = "; " + document.cookie;
          var parts = value.split("; " + name + "=");
          if (parts.length == 2) return parts.pop().split(";").shift();
        },

        delete_cookie : function( name ) {
          document.cookie = name + '=; expires=Thu, 01 Jan 1970 00:00:01 GMT;';
        },

        supportSVG : function() {
            return !!(document.createElementNS && document.createElementNS('http://www.w3.org/2000/svg','svg').createSVGRect);
        },

        generate_id: function(length) {
             var chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXTZabcdefghiklmnopqrstuvwxyz'.split('');

             if (! length) {
                  length = Math.floor(Math.random() * chars.length);
             }

             var str = '';
             for (var i = 0; i < length; i++) {
                  str += chars[Math.floor(Math.random() * chars.length)];
             }
             return str;
        },

        detect_ie : function() {
    		  var ua = window.navigator.userAgent;

    		  // Test values; Uncomment to check result …

    		  // IE 10
    		  // ua = 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.2; Trident/6.0)';

    		  // IE 11
    		  // ua = 'Mozilla/5.0 (Windows NT 6.3; Trident/7.0; rv:11.0) like Gecko';

    		  // Edge 12 (Spartan)
    		  // ua = 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.71 Safari/537.36 Edge/12.0';

    		  // Edge 13
    		  // ua = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2486.0 Safari/537.36 Edge/13.10586';

    		  var msie = ua.indexOf('MSIE ');
    		  if (msie > 0) {
    		    // IE 10 or older => return version number
    		    return parseInt(ua.substring(msie + 5, ua.indexOf('.', msie)), 10);
    		  }

    		  var trident = ua.indexOf('Trident/');
    		  if (trident > 0) {
    		    // IE 11 => return version number
    		    var rv = ua.indexOf('rv:');
    		    return parseInt(ua.substring(rv + 3, ua.indexOf('.', rv)), 10);
    		  }

    		  var edge = ua.indexOf('Edge/');
    		  if (edge > 0) {
    		    // Edge (IE 12+) => return version number
    		    return parseInt(ua.substring(edge + 5, ua.indexOf('.', edge)), 10);
    		  }

    		  // other browser
    		  return false;
    	},

        /**
    	* Detect device type by user agent or browser window width
    	*
    	* @returns {bool} true|false
    	*/
    	detect_device: function () {

    	  var browserString = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i;

    	  //if user on mobile or small browser width
    	  if (/Android|webOS|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) || window.innerWidth <= App.mobileWidthMax) {
    			App.isMobile = true;
    			App.isTablet = App.isDesktop = false;
    	  }
    	  else if(/Android|webOS|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) || window.innerWidth <= App.tabletWidthMax){
    			App.isTablet = true;
    			App.isMobile = App.isDesktop  = false;
    	  }
    	  else{
    			App.isTablet = App.isMobile = false;
    			App.isDesktop = true;
    	  }
    	},

        dekstop_nav__hide : function() {

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

        make_list_from_select : function( select ) {
            //array of list items with value and title
            [].forEach.call(document.querySelectorAll(select), function(el, index, array) {
                el.classList.add('custom-select__list--hidden');

                var i, e, v, t;
                var items = [];
                var obj = {};
                var ul = '<ul class="custom-select__list custom-select__list--'+index+'">';
                var options = el.getElementsByTagName('option');

                for (i = 1; i < options.length; ++i) {
                    obj = {};
                    e = options[i];
                    v = e.getAttribute('value');
                    t = e.text;
                    obj['text'] = t;

                    var id = Util.generate_id(10);
                    options[i].setAttribute('id', id);
                    //create list items
                    var listItem = '<li class="custom-select__item" id="'+id+'">'+obj['text']+'</li>';

                    ul += listItem;
                }
                ul += '</ul>';
                el.insertAdjacentHTML('afterend', ul);
            });
        },

        /* [ A ] */

            addLoadEvent: function(func)
            {
                var oldonload = window.onload;
                if (typeof window.onload != 'function') {
                    window.onload = func;
                } else {
                window.onload = function() {
                    if (oldonload) {
                        oldonload();
                    }
                        func();
                    }
                }
            },


        /* [ B ] */

            browserSupportsAllFeatures : function()
            {
                return App.browserFeatures;
            },

        /* [ C ] */
        /* [ D ] */
        /* [ E ] */
        /* [ F ] */
        /* [ G ] */

            get_images : function(key, retina, callback) {

                //ajax to get all imagems
                var data = {};
                data.action = 'get_images';
                data.global_hero = document.querySelector('[global_hero]').getAttribute('global_hero');
                data.id = document.querySelector('[page-id]').getAttribute('page-id');
                data.parent_id = document.querySelector('[parent-id]').getAttribute('parent-id');
                data.image_key = key;
                data.retina = retina;

                $.ajax(
                {
                    url: ajax_url,
                    data: data,
                    context: document.body,
                    dataType: 'json',
                    success: function(response)
                    {
                        if (typeof callback === 'function')
                        {
                            callback(response);
                        }
                        else
                        {
                            console.log("Failed to find ajax function " + callback);
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown)
                    {
                        console.log(jqXHR, textStatus + errorThrown);
                    }
                });
            },

        /* [ H ] */
        /* [ I ] */

            isRetinaDevice: function() {
                if (('devicePixelRatio' in window && window.devicePixelRatio >= 1.5) ||
                    ('matchMedia' in window && window.matchMedia("(-webkit-min-device-pixel-ratio: 1.5), (min--moz-device-pixel-ratio: 1.5), (-o-min-device-pixel-ratio: 3/2), (min-resolution: 1.5dppx)").matches)) {
                        return this.retinaDevice = true;
                    } else {
                        return this.retinaDevice = false;
                    }
            },

        /* [ J ] */
        /* [ K ] */
        /* [ L ] */

            loadScript: function (src, done)
            {
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

        /* [ M ] */
        /* [ N ] */
        /* [ O ] */
        /* [ P ] */

            param : function(object) {
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

            preventForm : function(formEl)
            {
                document.querySelector(formEl).addEventListener("submit", function(e){
                    e.preventDefault();    //stop form from submitting
                });
            },

        /* [ Q ] */
        /* [ R ] */

            replaceImage: function(response, el)
            {
                el.setAttribute('style', 'background-image: url('+ response +') center;' );
            },

        /* [ S ] */

            /**
        	 * is user on mobile
        	 * @function checks for media device and gets the retina image
        	 */
            serveRetinaDevice: function()
            {


                    if (('devicePixelRatio' in window && window.devicePixelRatio >= 1.5) ||
                        ('matchMedia' in window && window.matchMedia("(-webkit-min-device-pixel-ratio: 1.5), (min--moz-device-pixel-ratio: 1.5), (-o-min-device-pixel-ratio: 3/2), (min-resolution: 1.5dppx)").matches))
                    if(true)
                    {
            			[].forEach.call(document.querySelectorAll('.backstretch img'), function(el)
            			{
                            console.log('hi');
                            Util.get_images('banner', true,
                            function(p) {
                                el.setAttribute('style', 'background-image: url('+ p +') center;' );
                            });
            			});
                    } else {
                        console.log('Not retina');
                    }

            },

            search_keydown_ajax : function()
        	{
        	    var action = 'fps_search_ajax',
        	    searchForm = document.querySelector('#search__form'),
        	    searchEl = document.querySelector('#search--site');

        	    //prevent submit
        	    //Util.preventForm('#search__form');

        	    // keypress event
        	    searchForm.querySelector('.search__field').addEventListener('keydown', function(event)
        	    {
        	        var zhege = event.target,
        	        searchTerm = zhege.value;

        	        zhege.setAttribute('autocomplete', 'off');

        	        if(searchTerm.length > 2)
        	        {
        	            // JSON
        	            var xhr = new XMLHttpRequest();

        	            xhr.open('PUT', ajax_url + '?action=' +action);
        	            xhr.setRequestHeader('Content-Type', 'application/json');
        	            xhr.onload = function() {
        	                if (xhr.status === 200) {
        	                    var response = xhr.responseText,
        	                    search__results = searchEl.querySelector('#search__results'),
        	                    results__portable = searchEl.querySelector('#search__results--portable');
        	                    // if( $(window).width() > 1350) {
        	                    // } else {
        	                    // }
        						search__results.classList.add('search__results--active');
        						search__results.innerHTML = response;
        	                }
        	                else if (xhr.status !== 200) {
        	                    alert('Request failed.  Returned status of ' + xhr.status);
        	                }
        	            };
        	            xhr.send(JSON.stringify({
        	                action: action,
        	                term: searchTerm
        	            }));
        	        }
        	    });
        	},

            sub_menu_hover : function()
        	{

        		// mouseenter button
        		[].forEach.call(document.querySelectorAll('.nav--sub-menu .nav__link'), function(el)
        		{
        			el.addEventListener('mouseenter', function(event)
        			{
        				var event_overlay = document.querySelector('.events-overlay');
        				var zhege = event.currentTarget;
        				var selected = document.querySelectorAll('.nav__link--active');
        				var parent = zhege.parentNode;

        				if(parent.classList.contains('nav__sub-item')) {
        					// no action for now
        					zhege.parentNode.parentNode.parentNode.querySelector('.nav__link').classList.add('nav__link--active');
        					event_overlay.classList.add('events-overlay--visible');
        					parent = null;
        				} else {
        					zhege.classList.add('nav__link--active');
        					event_overlay.classList.add('events-overlay--visible');
        				}

        				if(parent !== null && selected !== null && selected.length > 0) {
        					[].forEach.call(selected, function(el)
        					{
        						// loops through all active elements
        						if ( el !== zhege ) {
        							el.classList.remove('nav__link--active');
        						}
        					});
        				}
        				// var parent = zhege.parentNode.parentNode.parentNode.querySelector('.nav__sub-list');
        				// var parent_link = (parent != null) ? parent.parentNode.parentNode.querySelector('.nav__link--active') : '';
        			});
        		});

        		// mouseout button
        		[].forEach.call(document.querySelectorAll('.nav__item > .nav__link'), function(el) {
        			el.addEventListener('mouseout', function() {
        				var zhege = event.currentTarget;
        				var selected = document.querySelectorAll('.btn--active');
        				var event_overlay = document.querySelector('.events-overlay');

        				zhege.classList.remove('nav__link--active');
        				event_overlay.classList.remove('events-overlay--visible');
        				// mouse left button, so close

        			});
        		});
        		// mouseenter list

        		// mouseout list
        		[].forEach.call(document.querySelectorAll('.nav__sub-list'), function(el) {
        			el.addEventListener('mouseout', function() {
        				var zhege = event.currentTarget;
        				var selected = document.querySelectorAll('.btn--active');
        				var event_overlay = document.querySelector('.events-overlay');

        				zhege.parentNode.querySelector('.nav__link').classList.remove('nav__link--active');
        				event_overlay.classList.remove('events-overlay--visible');

        			});
        		});

        	},

        /* [ T ] */
        /* [ U ] */
        /* [ V ] */

            video : function(id) {
                var video = document.getElementById(id);
                if ( !video )	return;
                var video__player = video.querySelector('video');
                var playpause = video.querySelector(".video__playpause");

                if ( !video__player || !playpause )	return;

                video__player.removeAttribute("controls");
                playpause.addEventListener('click',function(){
                    if (video__player.paused) {
                        video__player.play();
                        playpause.classList.add("video__playpause--playing");
                    } else {
                        video__player.pause();
                        playpause.classList.remove("video__playpause--playing");
                    }
                },false);
            },

            background_video : function(video)
            {
                var backstretch = document.querySelector('.backstretch');
                var el = document.querySelector(video);
                if (el) {
                    var actualRatio = el.videoWidth/el.videoHeight;
                    var targetRatio = backstretch.offsetWidth/backstretch.offsetHeight;
                    var adjustmentRatio = targetRatio/actualRatio;
                    var scale = actualRatio < targetRatio ? targetRatio / actualRatio : actualRatio / targetRatio;
                    el.setAttribute('style', '-webkit-transform: scale(' + scale  + ');');

                    document.querySelector('.video--background').classList.add('video--active');
                    document.querySelector('.video--background').classList.remove('video--inactive');

                    var video_btn = document.querySelector('.video__playpause');
                    video_btn.classList.remove('video__btn--loading');
                    video_btn.classList.add('video__btn--loaded');

                    setInterval( function(slideshow__item) {
                        slideshow__item
                    }, 3000)

                    setTimeout(function() {
                        el.play();
                    }, 500);

                    // as long as the <video> has width and height set to 100% and
                    // your container div has css overflow:hidden just pass it the
                    // video tag.
                }
            },

            slideshowCaptionLoop: function()
            {
                [].forEach.call(document.querySelectorAll('.slideshow__item'), function(el, index, array)
                {
                    el.querySelector('.slideshow__content').classList.remove('slideshow__content--off-screen');
                    el.querySelector('.slideshow__content').classList.remove('slideshow__content--active');
                    el.querySelector('.slideshow__content').classList.add('slideshow__content--inactive');

                    if( index == 0 )
                    {
                        el.querySelector('.slideshow__content').classList.add('slideshow__content--active');
                    }
                    else
                    {
                        setTimeout(function()
                        {
                            array[index - 1].querySelector('.slideshow__content').classList.add('slideshow__content--off-screen');
                            //array[index - 1].querySelector('.slideshow__content').classList.remove('slideshow__content--active');
                            el.querySelector('.slideshow__content').classList.add('slideshow__content--active');
                            //el.querySelector('.slideshow__content').classList.remove('slideshow__content--inactive');

                            if( index == (array.length - 1) )
                            {
                                setTimeout(function()
                                {
                                    el.querySelector('.slideshow__content').classList.add('slideshow__content--off-screen')
                                    setTimeout(function()
                                    {
                                        Util.slideshowCaptionLoop();
                                    }, 5000);
                                }, 5000);
                            }

                        }, (index + 1) * 5000);

                    }
                });
            }

        /* [ W ] */
        /* [ X ] */
        /* [ Y ] */
        /* [ Z ] */

        // template : function() {
        // },

    };
    global.Util = Util;
})(this);
