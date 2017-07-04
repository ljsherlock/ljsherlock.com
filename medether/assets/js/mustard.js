/**
 *
 *  @name Cut the Mustard
 *
 *  @desc Here we test if the browser is HTML5 or Non HTML5
 *
 *  If the browser is HTML5 it cuts the mustard, a
 *  cookie is set and the browser is reloaded.
 *
 *  Depending on the above, true or false is returned
 *  onload to our app.js
 *
 *  @required
 */

// declaring strict mode
"use strict";

(function(global) {

    var Mustard = {

        init: function() {

            // Check cookies are enabled, because we need them.
            if (navigator.cookieEnabled)
            {
                // Already tested, continue.
                if( this.has_cookie('cuts-the-mustard') )
                {
                    return true;
                }

                // Check if cuts the mustard
                // Set cookie, halt and reload.
                if( this.cuts_the_mustard() )
                {
                    this.set_cookie('cuts-the-mustard', true);
                    this.halt_reload();
                    // no return value here. When the browser is reloaded
                    // with the cookie it will meet the above condition.
                }

                // Does not cut the mustard, continue with false indicator
                return false;

            } else {
                // Cookies disabled, continue with false indicator
                return false;
            }
        },

        cuts_the_mustard: function()
        {
            if( 'querySelector' in document
        		&& 'localStorage' in window
        		&& 'addEventListener' in window
        		&& Util.supportSVG() == true )
        	{
                return true;
            } else {
                return false;
            }
        },

        set_cookie: function(key, value)
        {
            var d = new Date();
			d.setTime(d.getTime() + (10*24*60*60*1000));
			var cookieDate = d.toUTCString();
			document.cookie = key + '=' + encodeURI(value) + "; expires=" + cookieDate + "; path=/";
        },

        has_cookie: function(key)
        {
            if( Util.getCookie(key) )
            {
                return true;
            }
        },

        halt_reload: function() {
            // Halt the browser from loading/doing anything else.
            window.stop();

            // Reload the page, because the cookie will now be
            // set and the server can use it.
            location.reload(true);
        }
    };
    global.Mustard = Mustard;
})(this);
