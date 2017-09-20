
// declaring strict mode

"use strict";

// Loads specific modules for App.

define([ "Util", 'Config' ], function( Util, appConfig )
{
	return {

		/*-- Functions called when a new instance is created --*/

		// Organising what is loaded on each page.
		// Global

		// Specific per page after that. Core isn't required unless
		// you notice there are things you are always using

		init : function(callback)
		{
			this.ajaxLinks();

			callback();
		},

		ajaxLinks : function()
		{
			require( ['Utils/Ajax'], function( Ajax )
			{
				Ajax.internalLinkBefore = function() {
					document.querySelector('html').classList.add('page--show-content');
		            setTimeout(function()
		            {
		                document.querySelector('html').classList.remove('page--loading-close');
		            }, 750);
				}

				Ajax.getPageCallback = function(response)
				{
					var main = document.querySelector('main');
					main.innerHTML = response;

					setTimeout(function()
					{
						Ajax.internalLinks();
						window.scroll(0, 0);
						//document.querySelector('.overlay--loading').classList.add('overlay--loading-close');
						document.querySelector('html').classList.add('page--loading-close');
						document.querySelector('html').classList.add('page--show-content');
					}, 750);

				};


				Ajax.internalLinks();


			});
		}
    }
});
