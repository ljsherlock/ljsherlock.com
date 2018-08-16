/**
* @class The entry-point for the app
*
* @desc Here we check if the browser is smart or not and if it supports required
*	features. If the browser is not smart, we provide the most basic experience and
* no JS is loaded. If the browser is smart, but does not support all features,
* a polyfills collection is loaded.
*/

require(['utils/util', 'lib/mustard', 'utils/Events', 'App', 'Core'], function (Util, Mustard, Events, App, Core) {
    'use strict';

    var smartBrowser = Mustard.cuts_the_mustard();
		var html = document.getElementsByTagName('html');
		var i;

    if (smartBrowser === true) {
				Events.domReady(function () {
					var allFeatures = 'matches' in Element.prototype && 'classList' in Element.prototype && Util.supportSVG();

					if (allFeatures === true) {
							var theCore = new Core();
							theCore.start();

							var myApp = new App();
							myApp.start();
					} else {
						require(['lib/polyfills'], function () {
							var App = new App();
						});
					}
				});
    } else {
        for (i = 0; i < html.length; i += 1) {
            html[i].setAttribute('class', 'does-not-cut-the-mustard');
        }
    }
});
