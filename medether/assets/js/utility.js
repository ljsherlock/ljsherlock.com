/**
 *
 *
 *  @name Utiliy
 *
 *  @desc Utility functions used by all other methods
 *
 *  @required 0
 */

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

            /**
    		* @name Button State
    		*
    		* @desc	Add the "active" or "inactive" class to .btn elemnts
    		*
    		*/
    		btn_state : function(overlay)
    		{
    			[].forEach.call(document.querySelectorAll('.btn--inactive'), function(el)
    			{
    				el.addEventListener('click', function(e)
    				{
    					e.preventDefault();
                        //
    					var zhege = event.currentTarget;
    					var selected = document.querySelectorAll('.btn--active');
    					var event_overlay = zhege.parentNode.parentNode.querySelector(overlay);

    					// Inactive
    					if(zhege.classList.contains('btn--active')) {
    						zhege.classList.remove('btn--active');
    						zhege.classList.add('btn--inactive');
    						if(event_overlay !== null) {
    							event_overlay.classList.remove('events-overlay--visible');
    						}
                        //
    					// Active
    					} else {
    						zhege.classList.remove('btn--inactive');
    						zhege.classList.add('btn--active');
    						if(event_overlay !== null) {
    							event_overlay.classList.add('events-overlay--visible');
    						}
    					}
                        //
    					if(selected !== null && selected.length > 0) {
    						[].forEach.call(selected, function(el) {
    							el.classList.remove('btn--active');
    							el.classList.add('btn--inactive');
    						});
    					}
    				});
    			});
    		},

            background_video : function(video)
            {
                var backstretch = document.querySelector('.backstretch');
                var el = document.querySelector(video);
                var actualRatio = el.videoWidth/el.videoHeight;
                var targetRatio = backstretch.offsetWidth/backstretch.offsetHeight;
                var adjustmentRatio = targetRatio/actualRatio;
                var scale = actualRatio < targetRatio ? targetRatio / actualRatio : actualRatio / targetRatio;
                el.setAttribute('style', '-webkit-transform: scale(' + scale  + ');');

                document.querySelector('.video--background').classList.add('video--loaded');
                document.querySelector('.video--background').classList.remove('video--loading');

                var video_btn = document.querySelector('.video__btn--loading')
                video_btn.classList.remove('video__btn--loading');
                video_btn.classList.add('video__btn--loaded');

                var slideshow_content = document.querySelector('.slideshow__content--loading');

                slideshow_content.classList.add('slideshow__content--loaded');

                setTimeout(function() {
                    el.play();
                }, 500);

                // as long as the <video> has width and height set to 100% and
                // your container div has css overflow:hidden just pass it the
                // video tag.
            },


            getComputedStyle: function( prop )
            {
                return Util.w.getComputedStyle( Util.g )[prop];
            },

        /* [ C ] */

            /**
            *   @name Select
            *   @desc Takes a select element and creates a javascript
            *   dropdown interface
            */
            select : function() {

                Util.make_list_from_select('.custom-select select');

                Util.button_click('.custom-select__button', '.custom-select__event');

                [].forEach.call(document.querySelectorAll('.custom-select__event'), function(el)
                {
                    el.addEventListener('click', function(event)
                    {
                        var zhege = event.currentTarget;
                        zhege.classList.remove('events-overlay--visible');
                        zhege.parentNode.querySelector('.custom-select__button').classList.remove('btn--active');
                        zhege.parentNode.querySelector('.custom-select__button').classList.add('btn--inactive');
                    });
                });

                // event listener for the event overlay. Uses the delegate function to add event before element added to DOM.
                Util.delegate(document, "click", ".custom-select__event", function(event)
                {
                    var selected = document.querySelectorAll('.btn--active');
                    var zhege = event.target;
                    zhege.classList.remove('events-overlay--visible');

                    if(selected !== null && selected.length > 0)
                    {
                        [].forEach.call(selected, function(el)
                        {
                            el.classList.remove('btn--active');
                        });
                    }
                });

                // Click event for the list of options created.
                // Custom Select only
                [].forEach.call(document.querySelectorAll('.custom-select__item'), function(el)
                {
                  el.addEventListener('click', function(event)
                  {
                      var zhege = event.currentTarget;
                      var selected = zhege.parentNode.querySelector('.custom-select__item--selected');
                      var event_overlay = document

                      // add class selected
                      zhege.classList.add('custom-select__item--selected');
                      document.getElementById(zhege.getAttribute('id')).setAttribute('selected', 'selected');

                      var term = document.getElementById(zhege.getAttribute('id')).getAttribute('value');
                      var form = zhege.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode.querySelector('.member-search');
                      var action = form.getAttribute('data-action');
                      form.setAttribute('action', action + term);

                      // close
                      zhege.parentNode.parentNode.querySelector('.custom-select__button').classList.remove('btn--active');
                      zhege.parentNode.parentNode.querySelector('.custom-select span').innerHTML = zhege.innerHTML;

                      // close the event overlay
                      zhege.parentNode.parentNode.querySelector('.custom-select__event').classList.remove('events-overlay--visible');

                      // remove class selected from others
                      if(selected !== null)
                      {
                          selected.classList.remove('custom-select__item--selected');
                          document.getElementById(selected.getAttribute('id')).removeAttribute('selected');
                      }
                  });
              });
            },

        /* [ D ] */

            delegate : function(el, evt, sel, handler)
            {
                el.addEventListener(evt, function(event) {
                    var t = event.target;
                    while (t && t !== this) {
                        if (t.matches(sel))
                        {
                            handler.call(t, event);
                        }
                        t = t.parentNode;
                    }
                });
            },

            delete_cookie : function( name )
            {
              document.cookie = name + '=; expires=Thu, 01 Jan 1970 00:00:01 GMT;';
            },

            detect_ie : function()
            {
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
        	detect_device: function ()
            {

        	  var browserString = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i;

        	  //if user on mobile or small browser width
        	  if (/Android|webOS|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) || window.innerWidth <= App.mobileWidthMax) {
        			App.isMobile = true;
        			App.isTablet = Core.isDesktop = false;
        	  }
        	  else if(/Android|webOS|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) || window.innerWidth <= Core.tabletWidthMax){
        			Core.isTablet = true;
        			Core.isMobile = Core.isDesktop  = false;
        	  }
        	  else{
        			Core.isTablet = Core.isMobile = false;
        			Core.isDesktop = true;
        	  }
        	},

        /* [ E ] */

            each: function(obj, callback)
            {
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

        /* [ F ] */

            fitToWindow : function(e)
            {
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


        /* [ G ] */

            get_images : function(key, retina, callback)
            {
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

            getCookie: function(name)
            {
              var value = "; " + document.cookie;
              var parts = value.split("; " + name + "=");
              if (parts.length == 2) return parts.pop().split(";").shift();
            },

            generate_id: function(length)
            {
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

        /* [ H ] */

        /* [ I ] */

            isRetinaDevice: function()
            {
                if (('devicePixelRatio' in window && window.devicePixelRatio >= 1.5) ||
                ('matchMedia' in window && window.matchMedia("(-webkit-min-device-pixel-ratio: 1.5), (min--moz-device-pixel-ratio: 1.5), (-o-min-device-pixel-ratio: 3/2), (min-resolution: 1.5dppx)").matches)) {
                    return this.retinaDevice = true;
                } else {
                    return this.retinaDevice = false;
                }
            },

            isArray: function(obj)
            {
                return Object.prototype.toString.call(obj) === '[object Array]';
            },

            isFunction: function(obj)
            {
                return Object.prototype.toString.call(obj) === '[object Function]';
            },

        /* [ J ] */

        /* [ K ] */

        /* [ L ] */

        /* [ M ] */

            make_list_from_select : function( select )
            {
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

            makeArray: function(arrayLike)
            {
                if(arrayLike.length != null) {
                    return Array.prototype.slice.call(arrayLike, 0)
                            .filter(function(ele) { return ele !== undefined; });
                }
                return [];
            },

        /* [ N ] */

        /* [ O ] */

        /* [ P ] */

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

            /**
            *   @name Supports SVG
            */
            supportSVG : function() {
                return !!(document.createElementNS && document.createElementNS('http://www.w3.org/2000/svg','svg').createSVGRect);
            },

            /**
            *   @name Scale Size
            *   @param selector @type Str
            *   @desc uses the width of the element to set the hieght to keep
            *   the size in scale.
            */
            scale_size : function(selector) {
                var w=window,
                d=document,
                e=d.documentElement,
                g=d.getElementsByTagName('body')[0],
                x=w.innerWidth,
                y=w.innerHeight;

                if(x < App.wrapWidth) {
                    [].forEach.call(document.querySelectorAll(selector), function(el) {
                        el.style.height = window.getComputedStyle(el).width;
                    });
                }
            },

        /* [ T ] */

            setTransform: function(element, elTransformArg) {
                var transfromString = (elTransformArg.trX) ? "TranslateX(" + elTransformArg.trX + "px) " : '';
                transfromString += (elTransformArg.trY) ? "TranslateY(" + elTransformArg.trY + "px) " : '',
                transfromString += (elTransformArg.rot) ? "rotate(" + elTransformArg.rot + "deg ) scale(" : '',
                transfromString += (elTransformArg.sca) ? elTransformArg.sca + ")" : '',
                transfromString += (elTransformArg.skx) ? "skewX(" + elTransformArg.skx + "deg ) skewY(" : '',
                transfromString += (elTransformArg.sky) ? elTransformArg.sky + "deg )" : '';
                transfromString = (transfromString);

                // now attach that variable to each prefixed style
                element.style.webkitTransform = transfromString;
                element.style.MozTransform = transfromString;
                element.style.msTransform = transfromString;
                element.style.OTransform = transfromString;
                element.style.transform = transfromString;
            },

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

        /* [ W ] */

        /* [ X ] */

        /* [ Y ] */

        /* [ Z ] */

    };
    global.Util = Util;
})(this);
