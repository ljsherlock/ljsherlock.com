/**
 *---------- MAIN ---------------------
 *
 * This is entry point for JS
 *
 * Here we test the browser first with mustuard.js
 * and secondly with a project-specific
 * browserSupportsAllFeatures() function
 *
 * If the browser cuts the mustard and supports all features
 * we call main(), which intializes our core and app classes.
 *
 * If the browser cuts the mustard, but does not support all
 * features, we load the polyfills bundle and then call main()
 *
 * Should the browser does not cut the mustard or support all
 * features, then the core experience is provided only
 */


"use strict";

var Initialize =
{
    init: function()
    {
        // get Mustard function and check it's defined.
        var cuts_the_mustard = Mustard.init();
        if( cuts_the_mustard == true )
        {
            // Fetch the Mustard cookie
            this.mustardCookie = Util.getCookie('FPS_cuts-the-mustard');

            // Check if Mustard cookie is set
    		if( this.mustardCookie )
    		{
                if( Util.browserSupportsAllFeatures() == true )
                {
                    Initialize.main();
                }
                    else
                {
                    // Load polyfills and run all JS as callback.
                    Util.loadScript( localized.js + '/polyfills/polyfills.js', function()
                    {
                        Initialize.main();
                    });
                }
    		}
             else
            {
    			var html = document.getElementsByTagName('html');
                html.setAttribute('class', 'does-not-cut-the-mustard');

                // No JS.
                // Basic version.
                // How to implement simplified version of complex design?
                // Start off with the basic. A basic menu etc,then progressively enhance through AMD
    		}
        }
    },
    main: function()
    {
        document.querySelector('body').classList.remove('uncut-mustard');
        document.querySelector('body').classList.add('cut-mustard');

        if (/comp|inter|loaded/.test(document.readyState))
        {
            // In case DOMContentLoaded was already fired, the document readyState will be one of "complete" or "interactive" or (nonstandard) "loaded".
            // The regexp above looks for all three states. A more readable regexp would be /complete|interactive|loaded/
            Core.init();
            App.init();
        }
            else
        {
            // In case DOMContentLoaded was not yet fired, use it to run the "start" function when document is read for it.
            document.addEventListener('DOMContentLoaded', function()
            {
                Core.init();
                App.init();
            }, false);
        }
    }
};

Initialize.init();
