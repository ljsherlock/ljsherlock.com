/**
*	@desc Core javascript class that holds required properties and methods.
*	@name Core
*	@requires mustard.js, utility.js
*/

// declaring strict mode
"use strict";

// methods called in order of importance
// methods ordered by name

var Core = {

	/**
	 *	@desc Cut the mustard
	 *	@type Boolean
	 */
	mustardCookie: false,

	/**
	 *	@name Retina Device
	 *	@type Boolean
	 */
	retinaDevice: false,

	/**
	*	@desc Device Type Properties.
	* 	@type Boolean
	*/
	isDesktop: false,
	isTablet: false,
	isMobile: false,


	/*-- Functions called when a new instance is created --*/
	init : function() {

		this.mustardCookie = Util.getCookie('cuts-the-mustard');

		if( this.mustardCookie )
		{

			this.page_setup();

		} else {

			var html = document.getElementsByTagName('html');
		   	html[0].setAttribute('class', 'no-js');

		}
	},

	page_setup : function()
	{
		/*---------------------------------------------------
		*	Data
		-----------------------------------------------------*/
			Util.detect_device();
			Util.btn_state();
		/*---------------------------------------------------
		*	Media
		-----------------------------------------------------*/
		/*---------------------------------------------------
		*	Layout
		-----------------------------------------------------*/
		/*---------------------------------------------------
		*	Content
		-----------------------------------------------------*/
		/*---------------------------------------------------
		*	Interface
		-----------------------------------------------------*/
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

							fpsApp.page_setup();
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
    /* [ C ] */
    /* [ D ] */
    /* [ E ] */
    /* [ F ] */
    /* [ G ] */
    /* [ H ] */
    /* [ I ] */
    /* [ J ] */
    /* [ K ] */
    /* [ L ] */
    /* [ M ] */
    /* [ N ] */
    /* [ O ] */
    /* [ P ] */
    /* [ Q ] */
    /* [ R ] */
    /* [ S ] */
    /* [ T ] */
    /* [ U ] */
    /* [ V ] */
    /* [ W ] */
    /* [ X ] */
    /* [ Y ] */
    /* [ Z ] */



};

if( Util.getCookie('mustard') ) {
	// relinquish jQuery's control of the $ variable
	var $ = jQuery.noConflict();
}

 /*---------------------------------------------*\
 *    INITIALIZE APP
 /*---------------------------------------------*/

var cuts_the_mustard = Mustard.init();

if( cuts_the_mustard == true )
{
	// cut the mustard
	document.querySelector('body').classList.remove('uncut-mustard');
	document.querySelector('body').classList.add('cut-mustard');

	// DOM Loaded
	document.addEventListener("DOMContentLoaded", function()
	{
		Core.init();
	});

	// Add overlay Animation.
	// Util.addLoadEvent(function()
	// {
	// 	document.querySelector('.overlay--loading').classList.add('loading-bar--loaded-signal');
	// 	setTimeout(function() {
	// 		document.querySelector('.overlay--loading').classList.add('overlay--loading-close');
	// 	}, 750);
	// });

}
