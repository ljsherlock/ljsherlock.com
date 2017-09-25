
// declaring strict mode

"use strict";

// Loads specific modules for App.

define([ "Util", 'Config', 'Utils/Events' ], function( Util, appConfig, Events )
{
	var	App = {

		/*-- Functions called when a new instance is created --*/

		loadingScreen : document.querySelector('#loadingScreen'),
		overlayLoading : document.querySelector('#overlayLoading'),

		ajaxScreen : document.querySelector('#ajaxScreen'),
		overlayAjax : document.querySelector('#overlayAjax'),

		overlayMenu : document.querySelector('#overlayMenu'),

		main : document.querySelector('main'),

		mainDirection : '',

		overlayAjaxDirection : '',

		ajaxScreenDirection : '',

		html : document.querySelector('html'),

		header : document.querySelector('header'),

		init : function(callback)
		{
			this.ajaxLinks();

			var main = document.querySelector('main');

			document.querySelector('#hamburger').addEventListener('click', function(e)
			{
				var el = e.currentTarget;
				App.hamburger(el);
				App.showMenu('.nav--primary');

				var header = document.querySelector('header');
				var headerModifier = 'header--fade-in';
				if (header.classList.contains(headerModifier)) {
					header.classList.remove(headerModifier);
				} else {
					header.classList.add(headerModifier);
				}
				//
				// App.overlayMenu.classList.remove('overlay--fade');
				// void App.overlayMenu.offsetWidth;
				//
				// if (App.overlayMenuDirection == 'normal')
				// {
				// 	App.overlayMenu.style.animationDirection = 'reverse';
				// 	App.overlayMenu.style.animationDuration = '.75s';
				// 	App.overlayMenuDirection = 'reverse';
				// } else
				// {
				// 	App.overlayMenu.style.animationDirection = '';
				//
				// 	App.overlayMenuDirection = 'normal';
				// }
				// App.overlayMenu.classList.add('overlay--fade');

			});

			//Binds
			// Events.bindOne(ajaxScreen, 'animationend', function() {
			// 	Util.addRemoveModifier(this, 'animation', 'remove');
			// });
			// Events.bindOne(overlayLoading, 'animationend', function() {
			// 	Util.addRemoveModifier(this, 'animation', 'remove');
			// });
			// Events.bindOne(main, 'animationend', function() {
			// 	Util.addRemoveModifier(this, 'animation', 'remove');
			// });
			// Events.bindOne(html, 'animationend', function() {
			// 	Util.addRemoveModifier(this, 'animation', 'remove');
			// });
			// Events.bindOne(header, 'animationend', function() {
			// 	Util.addRemoveModifier(this, 'animation', 'remove');
			// });

			// Page load for first time
			setTimeout(function()
			{
				// Close loading screen.
				App.loadingScreen.classList.add('loading-screen--animation-hide');
				App.overlayLoading.classList.add('overlay--animation-hide');
				// HTML
				App.html.classList.add('html--animation-loaded');
				// Main
				App.main.classList.add('main--fade');
				// Header
				App.header.classList.add('header--animation-loaded');

			}, 250);


		},

		ajaxLinks : function()
		{
			require( ['Utils/Ajax'], function( Ajax )
			{
				Ajax.internalLinkBefore = function() {


					var hamburger = document.querySelector('.hamburger');
					if (hamburger.classList.contains('hamburger--active')) {
						App.hamburger(hamburger);
						App.showMenu('.nav--primary');

						var header = document.querySelector('header');
						var headerModifier = 'header--fade-in';
						if (header.classList.contains(headerModifier)) {
							header.classList.remove(headerModifier);
						} else {
							header.classList.add(headerModifier);
						}
					}

					// create new internal links from new HTML
					App.ajaxLinks();

					// Start loading animation
					// App.loadingScreen.classList.add('loading-screen--animation-show');
					// App.overlayLoading.classList.add('overlay--animation-show');
					App.toggleAjaxLoadingScreen();
				}

				Ajax.getPageCallback = function(response)
				{
					var main = document.querySelector('main');
					main.innerHTML = response;
					window.scroll(0, 0);
					Ajax.internalLinks();

					setTimeout(function()
					{
						// Finish Loading animation
						App.toggleAjaxLoadingScreen();

						// Ajax Main
						App.main.classList.add('main--ajax');
						App.main.classList.remove('main--fade');
						void App.main.offsetWidth;
						App.main.classList.add('main--fade');
					}, 750);

				};

				Ajax.internalLinks();
			});
		},

		toggleAjaxLoadingScreen: function()
		{
			// Ajax Overlay
			App.overlayAjax.classList.remove('overlay--fade');
			void App.overlayAjax.offsetWidth;

			if (App.overlayAjaxDirection == 'normal')
			{
				App.overlayAjax.style.animationDirection = 'reverse';
				App.overlayAjax.style.animationDuration = '.75s';
				App.overlayAjaxDirection = 'reverse';
			} else
			{
				App.overlayAjax.style.animationDirection = '';

				App.overlayAjaxDirection = 'normal';
			}
			App.overlayAjax.classList.add('overlay--fade');

			// Ajax Screen
			App.ajaxScreen.classList.remove('loading-screen--fade');
			void App.ajaxScreen.offsetWidth;

			if (App.ajaxScreenDirection == 'normal')
			{
				App.ajaxScreen.style.animationDirection = 'reverse';
				App.ajaxScreenDirection = 'reverse';
			} else
			{
				App.ajaxScreen.style.animationDirection = '';
				App.ajaxScreenDirection = 'normal';
			}
			App.ajaxScreen.classList.add('loading-screen--fade');
		},

		// loadingScreen: function()
		// {
		// 	// Page load for first time
		// 	setTimeout(function()
		// 	{
		// 		// Util.getModifier(loadingScreen, '--animation');
		//
		//
		// 		// close the loading icon
		// 		var loadingScreen = document.querySelector('#loadingScreen');
		// 		loadingScreen.classList.add('loading-screen--animation-inactive');
		// 		Events.bindOne(el, 'animationend', function() {
		// 	  		Util.addRemoveModifier(loadingScreen, 'animation-inactive', 'remove');
		// 	  	});
		//
		// 		loadingScreen = document.querySelector('#loadingScreen');
		//
		//
		// 		document.querySelector('main').classList.add('main--animation-show');
		// 		document.querySelector('html').classList.add('html--animation-loaded');
		// 		document.querySelector('header').classList.add('header--animation-loaded');
		//
		// 	}, 750);
		//
		// 	// Start loading animation
		// 	var overlayLoading = document.querySelector('#overlayLoading'),
		// 	loadingScreen = document.querySelector('#loadingScreen');
		//
		// 	// remove animation modifier??
		// 	Util.addRemoveModifier(overlayLoading, 'animation-inactive', 'remove');
		// 	overlayLoading.classList.add('overlay--animation-active');
		//
		// 	// add loading screen modifier
		// 	Util.addRemoveModifier(loadingScreen, 'animation', 'remove');
		// 	loadingScreen.classList.add('loading-screen--animation-active');
		//
		// 	// show page content
		// 	Util.addRemoveModifier(document.querySelector('main'), 'animation', 'remove');
		// 	document.querySelector('main').classList.remove('main--animation-show');
		//
		//
		// 	// Finish Loading animation
		// 	// Loading Screen
		// 	var loadingScreen = document.querySelector('.loading-screen');
		// 	Util.addRemoveModifier(loadingScreen, 'animation', 'remove');
		// 	loadingScreen.classList.add('loading-screen--animation-inactive');
		//
		// 	// Loading Overlay
		// 	Util.addRemoveModifier(document.querySelector('.overlay'), 'animation', 'remove');
		// 	document.querySelector('.overlay').classList.add('overlay--animation-inactive');
		//
		// 	// Content Show/Hide
		// 	Util.addRemoveModifier(document.querySelector('main'), 'animation', 'remove');
		// 	document.querySelector('main').classList.add('main--animation-show');
		// },

		hamburger : function(el, force)
		{
			var m = 'hamburger--active';

			if( el.classList.contains(m) || force == 'remove' )
			{
				el.classList.remove(m);
				document.body.style.overfow = 'auto';
			} else {
				el.classList.add(m);
				document.body.style.overfow = 'hidden';
			}

			// if(typeof callback === 'function')
			// {
			// 	this.callback();
			// }
		},

		showMenu: function(menuSelector)
		{
			var nav = document.querySelector(menuSelector);
			var m = 'nav--full-screen-show';

			if( nav.length != 0 )
			{
				if( nav.classList.contains(m) )
				{
					nav.classList.remove(m);
				} else {
					nav.classList.add(m);
				}
			}
		}
    }

	return App;
});
