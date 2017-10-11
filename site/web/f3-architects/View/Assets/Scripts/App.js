/* global window */

// declaring strict mode
"use strict";

// Loads specific modules for App.
define([ "Util", 'Config', 'Utils/Events', 'Lib/scrollReveal' ], function( Util, appConfig, Events, scrollReveal )
{
	var	App = {

		/*-- Functions called when a new instance is created --*/

		html : document.querySelector('html'),
		header : document.querySelector('header'),

		init : function(callback)
		{

			// var	transformX = {
			// 	1: 0,
			// 	2: -398,
			// 	3: -235,
			// 	4: -800,
			// 	5: 0,
			// 	6: -626,
			// 	7: 0,
			// 	8: -455,
			// 	9: -150,
			// 	10: -680,
			// 	11: -50,
			// 	12: -626,
			// 	13: 0,
			// 	15: 0,
			// 	16: -241,
			// 	17: -854,
			// };

			var device = Util.detectDevice();

			console.log(window.innerWidth);

			window.onresize = function()
			{
				if( device.isMobile == false && window.innerWidth <= 770 )
				{
					var container = document.querySelector('.gallery');
					container.classList.remove('gallery--animate');
					container.removeAttrbute('style');
					[].forEach.call(document.querySelectorAll('.gallery > *'), function(el, index, array) {
						el.classList.remove('gallery__image--show');
						el.removeAttrbute('style');
					});
				}
			}

			if( device.isMobile == false && window.innerWidth >= 770 )
			{
				var container = document.querySelector('.gallery');

				container.classList.add('gallery--animate');

				var lastElem = document.querySelector('.gallery > *:last-child');
				var top = lastElem.offsetTop;
				var height = lastElem.clientHeight;
				container.style.height = top + height +'px';

				var config = {
					viewFactor : 0.15,
					distance   : "0px",
					origin: 'right',
					easing: 'ease',
					delay: 250,
					duration: 750,
					scale: 1,
					mobile: false,
					beforeReveal: function(a) {
						// a.style.visible = '0';
						a.style.transform = '';
						a.classList.add("gallery__image--show");
						// var x = transformX[ a.getAttribute('data-number') ] + 'px';
						// a.style.opacity = 1;

					}
				};

				window.sr = scrollReveal();
				sr.reveal(".gallery > *, .header__contact", config);

			   sr.reveal(".header__contact", {
				   origin: 'right',
				   distance: '50%',
				   scale: 1
			   });

			   sr.reveal(".copy__logo, .copy__content", {
				   distance: '0',
				   scale: 1,
				   delay: 500
			   });

			}
		},
    }

	return App;
});
