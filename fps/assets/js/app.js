// declaring strict mode
"use strict";

// methods called in order of importance
// methods ordered by name

(function(global) {

	var App = {

		/**
		 * max mobile width
		 * @type Number
		 */
		mobileWidthMax: 500,

		/**
		 * max tablet width
		 * @type Number
		 */
		tabletWidthMax: 800,

		/**
		* mustard cut proof
		* @type String
		*/
		mustardCookie: false,

		/**
		* before content scales
		* @type Number
		*/
		wrapWidth: 1200,

		browserFeatures: 'matches' in Element.prototype && 'classList' in Element.prototype && Util.supportSVG(),


		/*-- Functions called when a new instance is created --*/
		init : function()
		{
			console.log('app init');
			Util.detect_device();
			// global methods
			this.hamburger();
			this.drop_down();
			this.page_setup();
		},

		page_setup : function()
		{

			/*---------------------------------------------------
			*	Media
			-----------------------------------------------------*/
				Util.video('video');

				Util.get_images('banner', Util.isRetinaDevice(), function(p)
				{
					App.slides_init(p);
				});

				if(App.isMobile == false)
				{
					Util.fullscreen('.slideshow--adjust');
					Util.addLoadEvent(function()
					{
						Util.background_video('#homeBackgroundVideo video');
						Util.slideshowCaptionLoop();
					});
					window.addEventListener("resize", function()
					{
						Util.background_video('#homeBackgroundVideo video');
					});
				}
			/*---------------------------------------------------
			*	Layout
			-----------------------------------------------------*/
				this.tile_height();
				window.addEventListener("resize", function(){
					App.tile_height();
				});
			/*---------------------------------------------------
			*	Content
			-----------------------------------------------------*/
			/*---------------------------------------------------
			*	Interface
			-----------------------------------------------------*/
				// this.ajax_links();
				this.customSelect();
				this.accordion();
				this.calendar_navigation();
				this.reveal_audit();
				this.search('#search');
				this.search('#docs_search');

		},

		/* [ A ] */

		ajax_links : function()
		{
			var main = document.querySelector('.main'),
			site_url = 'http://' + top.location.host.toString();
			var internal_links = document.querySelectorAll("a[href^='" + site_url +"']");

			// internal_links.classList.add('internal_links');

			[].forEach.call(internal_links, function(el)
			{
				el.classList.add('internal_link');

				el.addEventListener('click', function(event)
				{
					event.preventDefault();

					document.querySelector('.hamburger-button__checkbox').checked = false;
					document.querySelector('html').style.overflow = 'auto';

					window.onload = function() {
						document.querySelector('.overlay--loading').classList.add('loading-bar--loaded-signal');
						setTimeout(function() {
							document.querySelector('.overlay--loading').classList.add('overlay--loading-close');
						}, 750);
					};

					var url = el.getAttribute('href');

					// remove .main content
					// show Animations
					// insert ajax content in .main

					// AJAX

					var json_string = JSON.stringify({
						ajax: true
					});

					var xhr = new XMLHttpRequest();
					xhr.open('PUT', url );
					xhr.setRequestHeader("Content-Type", "application/json");
					xhr.send(json_string);
					xhr.onload = function()
					{
						if (xhr.status === 200)
						{
							var content = document.querySelector('.main');
							var response = xhr.responseText;

							content.innerHTML = response;

							App.page_setup();
							// Run page init.
						}
						else if (xhr.status !== 200)
						{
							alert('Request failed.  Returned status of ' + xhr.status);
						}
					};

				});
			});

		},

		/* [ B ] */

		/**
		* @name button_click
		* @function Default action for buttons: Add classes for button status
		*/

		button_click : function(button, overlay)
		{
			[].forEach.call(document.querySelectorAll(button), function(el)
			{
				el.addEventListener('click', function(event)
				{
					event.preventDefault();

					var zhege = this;
					var selected = document.querySelectorAll('.btn--active');
					var event_overlay = zhege.parentNode.parentNode.querySelector(overlay);

					// Status: Inactive
					if(zhege.classList.contains('btn--active')) {
						zhege.classList.remove('btn--active');
						zhege.classList.add('btn--inactive');
						if(event_overlay !== null) {
							event_overlay.classList.remove('events-overlay--visible');
						}

					// Status: Active
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

		/* [ C ] */

		calendar_navigation: function()
		{
			var action = 'get_calendar';
			var next_prev = document.querySelector('#calendar_next, #calendar_prev');

			this.button_click('.calendar__btn');

			Util.delegate(document, "click", "#calendar_next, #calendar_prev", function(event)
			{
				event.preventDefault();
				var events = document.querySelector('.events');
				events.classList.remove('events--navigated');
				events.classList.add('events--navigate');

				//get month and year
				var href = this.getAttribute('href').split('/');
				var m = href[2];
				var y = href[3];
				var ajax = true;

				var json_string = JSON.stringify({
					action: action, m: m, y: y, ajax: ajax
				});

				var xhr = new XMLHttpRequest();
				xhr.open('PUT', '/events/' + m +'/' + y );
				xhr.setRequestHeader("Content-Type", "application/json");
				xhr.send(json_string);
				xhr.onload = function()
				{
					if (xhr.status === 200)
					{
						var content = document.querySelector('.main');
						var response = xhr.responseText;

						content.innerHTML = response;
						App.page_setup();
					}
					else if (xhr.status !== 200)
					{
						alert('Request failed.  Returned status of ' + xhr.status);
					}
				};
			});
		},

		accordion: function()
		{
			// this.button_click('.accordion__button', '.accordion__event');

			[].forEach.call(document.querySelectorAll('.accordion__button'), function(el)
			{
				el.addEventListener('click', function(event)
				{
					var zhege = this;

					if(zhege.classList.contains('btn--active'))
					{
						zhege.classList.remove('events-overlay--visible');
						zhege.parentNode.querySelector('.accordion__button').classList.remove('btn--active');
						zhege.parentNode.querySelector('.accordion__button').classList.add('btn--inactive');
					} else {
						zhege.classList.remove('events-overlay--visible');
						zhege.parentNode.querySelector('.accordion__button').classList.add('btn--active');
						zhege.parentNode.querySelector('.accordion__button').classList.remove('btn--inactive');
					}

				});
			});
		},

		customSelect : function() {

			Util.make_list_from_select('.custom-select select');

			this.button_click('.custom-select__button', '.custom-select__event');

			[].forEach.call(document.querySelectorAll('.custom-select__event'), function(el)
			{
				el.addEventListener('click', function(event)
				{
					var zhege = this;
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
				  var zhege = this;
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

		// custom_select__filter: function()
		// {
		//
		// }

		/* [ D ] */

		drop_down : function()
		{

			//App.drop_down_click('.drop-down .drop-down__button.drop-down__button--has-children', '.drop-down__event');

			// Same as button click but with a check for a parent to not close it.

			// event listener for the event overlay. Uses the delegate function to add event before element added to DOM.
			Util.delegate(document, "click", ".drop-down__event", function(event) {
				var selected = document.querySelectorAll('.btn--active');
				var zhege = this;
				zhege.classList.remove('events-overlay--visible');

				if(selected !== null && selected.length > 0) {
					[].forEach.call(selected, function(el) {
						el.classList.remove('btn--active');
					});
				}
			});

			// untick all the checkboxes.
			[].forEach.call(document.querySelectorAll('.nav__label'), function(el) {
				el.addEventListener('click', function(e)
				{
					var zhege = this;
					var selected = zhege.parentNode.parentNode.querySelectorAll('.nav__check');

					if(selected !== null && selected.length > 0) {
						[].forEach.call(selected, function(el) {
							if(el !== zhege.parentNode.querySelector('.nav__check')) {
								el.checked = false;
							}
						});
					}
				});
			});

		},

		drop_down_click : function(button, overlay) {
			[].forEach.call(document.querySelectorAll(button), function(el) {
				el.addEventListener('click', function(event) {
					event.preventDefault();

					var zhege = this;
					var selected = document.querySelectorAll('.btn--active');
					var event_overlay = document.querySelector(overlay);

					// Clicked is active
					if(zhege.classList.contains('btn--active')) {
						zhege.classList.remove('btn--active');
						zhege.classList.add('btn--inactive');
						if(event_overlay !== null) {
							event_overlay.classList.remove('events-overlay--visible');
						}
					} else {
					// Clicked is Inactive
						zhege.classList.remove('btn--inactive');
						zhege.classList.add('btn--active');
						if(event_overlay !== null) {
							event_overlay.classList.add('events-overlay--visible');
						}
					}

					if(selected !== null && selected.length > 0) {
						[].forEach.call(selected, function(el) {
							if(el !== zhege.parentNode.parentNode.parentNode.querySelector('.drop-down__button--has-children')) {
								el.classList.remove('btn--active');
								el.classList.add('btn--inactive');
							}
						});
					}
				});
			});
		},

		/* [ E ] */
		/* [ F ] */

		/* [ G ] */

		/* [ H ] */

		hamburger : function()
		{
			var checkbox = document.querySelector('.hamburger-button__checkbox');

			document.querySelector('.btn--hamburger').addEventListener('click', function(event) {
				if( checkbox.checked ) {
					document.querySelector('html').style.overflow = 'auto';
				} else {
					document.querySelector('html').style.overflow = 'hidden';
				}
			});

			// this.button_click('.btn--hamburger');
			//
			// [].forEach.call(document.querySelectorAll('.btn--hamburger, #hamburger-net'), function(el)
			// {
			// 	el.addEventListener('click', function(event) {
			// 		event.preventDefault();
			//
			// 		var net = document.getElementById("hamburger-net");
			// 		var hamburger = document.getElementById("hamburger");
			// 		var root = document.querySelectorAll('body');
			//
			//
			// 		if( hamburger.classList.contains('hamburger--active') )
			// 		{
			// 			// rootclassList.add('menu-active');
			// 			//$('#naBackground').removeClass('active');
			// 			// nav.classList.remove('navigation--open');
			// 			// net.classList.remove('hamburger-net--open');
			// 			hamburger.classList.remove('hamburger--active');
			//
			// 			// specific actions for inactive
			// 			document.querySelector('.header').classList.remove('header--nav-open');
			// 			document.querySelector('.nav').classList.remove('nav--open');
			// 		}
			// 		 else
			// 		{
			// 			// root.classList.add('menu-active');
			// 			// nav.classList.add('navigation--open');
			// 			// net.classList.add('hamburger-net--open');
			// 			hamburger.classList.add('hamburger--active');
			//
			// 			// specific actions for active
			// 			document.querySelector('.header').classList.add('header--nav-open');
			// 			document.querySelector('.nav').classList.add('nav--open');
			// 		}
			// 	});
			// });
		},

		/* [ I ] */
		/* [ J ] */
		/* [ K ] */
		/* [ L ] */
		/* [ M ] */
		/* [ N ] */

		/* [ O ] */

		/* [ P ] */

			// page_data : function()
			// {
			// 	var global
			// 	post_type
			// 	page-id
			// 	parent-id
			// }

		/* [ Q ] */
		/* [ R ] */

		reveal_audit : function()
		{
			// TILES
			if( App.isMobile == false )
			{
				window.sr = ScrollReveal();
				sr.reveal('.audit--1', { duration: 750, delay : 500, afterReveal:
				  function(domEl) {
					  domEl.classList.add('audit--animate');
				  }
				}, 250);
				sr.reveal('.audit--2', { duration: 750, delay : 500, afterReveal:
				  function(domEl) {
					  domEl.classList.add('audit--animate');
				  }
				}, 250);
				sr.reveal('.audit--3', { duration: 750, delay : 500, afterReveal:
				  function(domEl) {
					  domEl.classList.add('audit--animate');
				  }
				}, 250);
				sr.reveal('.audit--4', { duration: 750, delay : 500, afterReveal:
				  function(domEl) {
					  domEl.classList.add('audit--animate');
				  }
				}, 250);
				sr.reveal('.audit--5', { duration: 750, delay : 500, afterReveal:
				  function(domEl) {
					  domEl.classList.add('audit--animate');
				  }
				}, 250);
			}
		},

		/* [ S ] */

		search : function(el)
		{
			var search = document.querySelector(el);
			if(search) {
				search.addEventListener('click', function(event) {
					var zhege = this.parentNode.parentNode.parentNode;

					zhege.classList.add('search--show');
					zhege.querySelector('.search__field').focus();

					if( zhege.querySelector('.search__results li') && window.innerWidth > 1399 )
					{
						zhege.querySelector('.search__results .search__field').focus();
						zhege.querySelector('.search__results').classList.add('search__results--active');
					}
						else if ( zhege.querySelector('.search__results li') )
					{
						zhege.querySelector('.search__results .search__field').focus();
						zhege.querySelector('.search__results--portable').classList.add('search__results--active');
					}

					zhege.querySelector('.search__field').addEventListener('blur', function()
					{
						zhege.classList.remove('search--show');
						if( zhege.querySelector('.search__results li')) {
							zhege.querySelector('.search__results').classList.remove('search__results--active');
						}
					});
				}, false);
			}
		},

		slides_init : function(slides) {

			var backstretch = $('.backstretch');

			$('.slideshow__img').remove();
			backstretch.backstretch(slides, {duration: 10000});

			$('.slideshow__next, .counter__arrow-r').on('click', function() {
				backstretch.data('backstretch').next();
			});

			$('.counter__arrow-l').on('click', function() {
				backstretch.data('backstretch').prev();
				App.slides_prev(backstretch.data("backstretch").index);
			});

			backstretch.on('backstretch.show', function (e, instance, index) {
				// slideshowfunction.resize_stretch(e, instance, index);
				App.slides_next(index);
			});

			backstretch.on('backstretch.before', function (e, instance, index) {
				var element = document.querySelector(".backstretch img");
				var container = document.querySelector(".slideshow.backstretch");
			    var clone = element.cloneNode(true);
				clone.setAttribute('class', 'backstretch__slider');
				container.appendChild(clone);
				var slider = document.querySelector(".backstretch__slider");
				slider.setAttribute('class', 'backstretch__slider--slide');
	    	});

			backstretch.on('backstretch.before', function (e, instance, index) {
				var element = document.querySelector(".backstretch__slider--slide");
				setTimeout(function() {
					element.parentNode.removeChild(element);
				},1000);
			});
		},

		slides_next : function (i)
		{
			// add and remove class from current and next
			// the index is important here
			// we'll use it to determin what content to slide in/out.
			// 01234  5
			var i = i + 1;
			var hide = i - 1;
			var items = $('.slideshow__item').length;

			if( i == 1) {
				hide = items;
			}

			$('.slideshow__item:nth-child('+(hide)+')').removeClass('slideshow__item--active');
			$('.slideshow__item:nth-child('+i+')').addClass('slideshow__item--active');
		},

		slides_prev : function (i)
		{
			var hide = i + 2;
			var items = $('.slideshow__item').length;

			if( i == items - 1 ) {
				hide = 1;
			}

			$('.slideshow__item:nth-child('+(hide)+')').removeClass('slideshow__item--active');
			$('.slideshow__item:nth-child('+i+')').addClass('slideshow__item--active');
		},

		/* [ T ] */

		tile_height : function() {
			var w=window,
			d=document,
			e=d.documentElement,
			g=d.getElementsByTagName('body')[0],
			x=w.innerWidth,
			y=w.innerHeight;

			if(x < App.wrapWidth) {
				[].forEach.call(document.querySelectorAll('.tile--position-papers'), function(el) {
					el.style.height = window.getComputedStyle(el).width;
				});
			}
		},

		/* [ U ] */
		/* [ V ] */

		video : function() {
			var video = document.querySelector("#video video"),
			playpause = document.getElementById("playpause");

			if(video != null)
			{
				video.removeAttribute("controls");
				playpause.addEventListener('click',function(){
					if (video.paused) {
						video.play();
						playpause.classList.add("playing");
					} else {
						video.pause();
						playpause.classList.remove("playing");
					}
				},false);
			}
		},

		/* [ W ] */

		/* [ X ] */

		/* [ Y ] */

		/* [ Z ] */

	};

	global.App = App;

})(this);

if( Util.getCookie('FPS_cuts-the-mustard') ) {
	// relinquish jQuery's control of the $ variable
	var $ = jQuery.noConflict();
}

	/**
	 *---------- INITIALIZE APPLICATION ---------------------
	 *
	 */

	// if (navigator.cookieEnabled) {
	// 	if('querySelector' in document
	// 			&& 'localStorage' in window
	// 			&& 'addEventListener' in window
	// 		&& Util.supportSVG() == true )
	// 	{
	// 		document.addEventListener("DOMContentLoaded", function()
	// 		{
	// 			// Handler for .ready() called.
	// 			App.init();
	// 		});
	//
	// 		if( !Util.getCookie('mustard') ) {
	// 			var d = new Date();
	// 			d.setTime(d.getTime() + (10*24*60*60*1000));
	// 			var expires = "expires="+ d.toUTCString();
	// 			document.cookie = 'mustard' + "=" + true + "; " + expires;
	//
	// 			// Halt the browser from loading/doing anything else.
	// 			window.stop();
	//
	// 			// Reload the page, because the cookie will now be
	// 			// set and the server can use it.
	// 			location.reload(true);
	// 		} else {
	// 			console.log("Your browser cuts the mustard!");
	// 		}
	// 	} else {
	// 		App.init();
	// 	}
	// }
