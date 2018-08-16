/**
 * @class Mustard
 *
 * @desc Here we test the browser first with mustuard.js
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

 define(['utils/util'], function(Util) {
     var Mustard = {
         init: function() {
             // Check cookies are enabled, because we need them.
             if (navigator.cookieEnabled)
             {
                 // Already tested, continue.
                 if( Util.has_cookie('cuts-the-mustard') )
                 {
                     return true;
                 }

                 // Check if cuts the mustard
                 // Set cookie, halt and reload.
                 if( this.cuts_the_mustard() )
                 {
                     Util.set_cookie('cuts-the-mustard', true);
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
         		&& 'addEventListener' in window)
         	{
                 return true;
             } else {
                 return false;
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

     return Mustard;
});
