
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
			var els = document.querySelectorAll('.blog-archive__checkbox'),
			component = document.querySelector('.blog-archive__results'),
			responseLocation = document.querySelector('.blog-archive__results .articles');

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

				require(['Utils/Elements'], function(Elements)
				{
					// Clear the filters
		            var clearFilters = document.querySelectorAll('.blog-archive__clear-filters');
		            [].forEach.call( clearFilters, function(el)
		            {
		                Util.addEventHandler(el, 'click', function()
		                {
	                        var parent = Elements.getParentByClass(el, 'accordion__content'),
	                        inputs = parent.querySelectorAll('input[type="checkbox"]');

							[].forEach.call(inputs, function(el)
							{
								el.checked = false;
							})
		                });
		            });
				});

			} else {

				// Ajax form for desktop and tablet only.
				require(['../../_app/_pages/blog-archive/blog-archive'], function(blogArchive)
				{
					blogArchive.setFormEvents(els, component, responseLocation );

					// clear the keyword
					var clearKeyword = document.querySelector('.blog-archive__clear-all-filters');
					Util.addEventHandler(clearKeyword, 'click', function(el)
					{
						var inputs = document.querySelectorAll('.blog-archive input[type="checkbox"]');

						[].forEach.call(inputs, function(el)
						{
							el.checked = false;
						});
						blogArchive.getPosts(component, responseLocation);
					});
				});
			}



			// Clear the keyword mobile
			// __This could be a module__
			require(['Utils/Elements'], function(Elements)
			{
				var clearKeyword = document.querySelector('.blog-archive__clear-keyword');
				Util.addEventHandler(clearKeyword, 'click', function(el)
				{
					var parent = Elements.getParentByClass(clearKeyword, 'blog-archive__field');
					parent.querySelector('.blog-archive__keyword').value = '';
					require(['../../_app/_pages/blog-archive/blog-archive'], function(blogArchive)
					{
						blogArchive.getPosts(component, responseLocation);
					});
				});
			});
		},
    }
});
