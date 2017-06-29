
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

		init : function()
		{
			// Accordion for mobile only.
			if( Util.detectDevice().isMobile == true )
			{
				require(['../../_components/_molecules/accordion/accordion'], function(accordion)
				{
					var accordionMobile = document.querySelectorAll('.accordion--mobile');

					[].forEach.call(accordionMobile, function(el, index, array)
					{
						el.classList.remove('accordion--mobile');
						el.classList.add('accordion');
					});

					accordion.init();
				});

			} else {
				// Ajax form for desktop and tablet only.
				require(['../../_app/_pages/blog-archive/blog-archive'], function(blogArchive)
				{
					var els = document.querySelectorAll('.blog-archive__checkbox'),
					component = document.querySelector('.blog-archive__results'),
					responseLocation = document.querySelector('.blog-archive__results .articles');

					blogArchive.form(els, component, responseLocation );
				});

			}
		},
    }
});
