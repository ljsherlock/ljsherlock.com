/**
*
*	@desc Project-specific class of properties and methods.
*
*	@name App
*
*	@requires mustard.js, utility.js
*/

// declaring strict mode
"use strict";

// methods called in order of importance
// methods ordered by name

var App = {

	/**
	* @desc Mustard Boolean
	* @type String
	*/
	mustardCookie: false,

	/**
	* before content scales
	* @type Number
	*/
	wrapWidth: 1200,


	/*-- Functions called when a new instance is created --*/
	init : function() {

		this.mustardCookie = Util.getCookie('cuts-the-mustard');

		if( this.mustardCookie )
		{
			this.page_setup();
		}
			else
		{
			var html = document.getElementsByTagName('html');
		   	html[0].setAttribute('class', 'no-js');
		}
	},

	/**
	*	@name page_setup
	* 	@desc Functions to run when the page is loaded.
	*
	*/
	page_setup : function()
	{
		/*---------------------------------------------------
		*	Data
		-----------------------------------------------------*/
		/*---------------------------------------------------
		*	Media
		-----------------------------------------------------*/

		/*---------------------------------------------------
		*	Layout
		-----------------------------------------------------*/
			this.menu_tile_height(true);
			window.onresize = function() {
				App.menu_tile_height();
			}
		/*---------------------------------------------------
		*	Cont.widthent
		-----------------------------------------------------*/
		/*---------------------------------------------------
		*	Interface
		-----------------------------------------------------*/
			// this.ajax_links();
			this.header();
			this.customSelect();
			this.menu();


			this.hamburger( function() {
				App.elTransformArg = App.elTransformArgBefore;
				var menu_sub_item = document.querySelectorAll( '.nav__sub-item' );
				App.menu_close(menu_sub_item);

				[].forEach.call(menu_sub_item, function(el)
				{
					var nav__check = el.parentNode.parentNode.querySelector('.nav__check');
					if( nav__check.checked = true )
					{
						nav__check.checked = false;
					}
				});
			});
	},

	/* [ A ] */

	/* [ B ] */

		/**
		* @name button_click
		* @function Default action for buttons: Add classes for button status
		*/

		button_click : function(button, overlay)
		{
			[].forEach.call(document.querySelectorAll(button), function(el)
			{
				el.addEventListener('click', function(event)
				{
					event.preventDefault();

					var zhege = event.currentTarget;
					var selected = document.querySelectorAll('.btn--active');
					var event_overlay = zhege.parentNode.parentNode.querySelector(overlay);

					// Status: Inactive
					if(zhege.classList.contains('btn--active')) {
						zhege.classList.remove('btn--active');
						zhege.classList.add('btn--inactive');
						if(event_overlay !== null) {
							event_overlay.classList.remove('events-overlay--visible');
						}

					// Status: Active
					} else {
						zhege.classList.remove('btn--inactive');
						zhege.classList.add('btn--active');
						if(event_overlay !== null) {
							event_overlay.classList.add('events-overlay--visible');
						}
					}

					//
					if(selected !== null && selected.length > 0) {
						[].forEach.call(selected, function(el) {
							el.classList.remove('btn--active');
							el.classList.add('btn--inactive');
						});
					}
				});
			});
		},

	/* [ C ] */

		customSelect : function() {

			Util.make_list_from_select('.custom-select select');

			this.button_click('.custom-select__button', '.custom-select__event');

			[].forEach.call(document.querySelectorAll('.custom-select__event'), function(el)
			{
				el.addEventListener('click', function(event)
				{
					var zhege = event.currentTarget;
					zhege.classList.remove('events-overlay--visible');
					zhege.parentNode.querySelector('.custom-select__button').classList.remove('btn--active');
					zhege.parentNode.querySelector('.custom-select__button').classList.add('btn--inactive');
				});
			});

			// event listener for the event overlay. Uses the delegate function to add event before element added to DOM.
			Util.delegate(document, "click", ".custom-select__event", function(event)
			{
				var selected = document.querySelectorAll('.btn--active');
				var zhege = event.target;
				zhege.classList.remove('events-overlay--visible');

				if(selected !== null && selected.length > 0)
				{
					[].forEach.call(selected, function(el)
					{
						el.classList.remove('btn--active');
					});
				}
			});

			// Click event for the list of options created.
			// Custom Select only
			[].forEach.call(document.querySelectorAll('.custom-select__item'), function(el)
			{
			  el.addEventListener('click', function(event)
			  {
				  var zhege = event.currentTarget;
				  var selected = zhege.parentNode.querySelector('.custom-select__item--selected');
				  var event_overlay = document

				  // add class selected
				  zhege.classList.add('custom-select__item--selected');
				  document.getElementById(zhege.getAttribute('id')).setAttribute('selected', 'selected');

				  var term = document.getElementById(zhege.getAttribute('id')).getAttribute('value');
				  var form = zhege.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode.querySelector('.member-search');
				//   var action = form.getAttribute('data-action');
				//   form.setAttribute('action', action + term);

				  // close
				  zhege.parentNode.parentNode.querySelector('.custom-select__button').classList.remove('btn--active');
				  zhege.parentNode.parentNode.querySelector('.custom-select .btn__text').innerHTML = zhege.innerHTML;

				  // close the event overlay
				  zhege.parentNode.parentNode.querySelector('.custom-select__event').classList.remove('events-overlay--visible');

				  // remove class selected from others
				  if(selected !== null)
				  {
					  selected.classList.remove('custom-select__item--selected');
					  document.getElementById(selected.getAttribute('id')).removeAttribute('selected');
				  }
			  });
		  });
		},

	/* [ D ] */

	/* [ E ] */

	/* [ F ] */

	/* [ G ] */

	/* [ H ] */

	hamburger : function(callback_checked)
	{
		var checkbox = document.querySelector('.hamburger__check');

		checkbox.addEventListener('click', function(event) {
			if( checkbox.checked ) {
				document.querySelector('html').style.overflow = 'auto';
			} else {
				document.querySelector('html').style.overflow = 'hidden';
				callback_checked();
			}
		});
	},

	header : function()
	{
		Util.addLoadEvent(function()
		{
			var html = document.querySelector('html')
			html.classList.add('restrict');
			var header = document.querySelector('.header');
			if( header.classList.contains('header--start') )
			{
				setTimeout(function() {
					header.classList.remove('header--start');
					header.classList.remove('header--regular');
					header.classList.add('header--finish');

					var featurePage = document.querySelectorAll('.featured-page');


					Util.each(featurePage, function(el) {
						if (el.classList.contains('featured-page--first'))
						{
							el.style.height = (Util.y - 400) + 'px';
						} else {
							el.style.height = (Util.y - 400) / 2 + 'px';
						}
						setTimeout(function() {
							el.classList.add('featured-page--show');
						},250);

					});
					html.classList.remove('restrict');

				}, 2750);
			}
		});
	},

	menu_tile_height : function(init)
	{
		// get height of document
		var height = window.innerHeight;

		// get number of tiles
		var nav__list = document.querySelector( '.nav__list' );
		var nav__block = document.querySelectorAll( '.nav__block' );
		var nav__sub_item = document.querySelectorAll( '.nav__sub-item' );
		var count = nav__block.length;

		// divide height by the number of tiles
		var tile_height = height / count;

		App.elTransformArgBefore = {
			trX: '-' + tile_height,
			trY: 0,
			rot: 0,   // the rotation 'counter' for the element 'el'
			sca: 0,   // the scale 'counter' for the element 'el'
			skx: 0,   // the skewX 'counter' for the element 'el'
			sky: 0    // the skewY 'counter' for the element 'el'
		};

		App.elTransformArgAfter = {
			trX: 0,
			trY: 0,
			rot: 0,   // the rotation 'counter' for the element 'el'
			sca: 0,   // the scale 'counter' for the element 'el'
			skx: 0,   // the skewX 'counter' for the element 'el'
			sky: 0    // the skewY 'counter' for the element 'el'
		};

		nav__list.style.width = tile_height + 'px';

		// set w and h for all tiles
		[].forEach.call(nav__block, function(el)
		{
			el.style.height = tile_height + 'px';
			el.style.width = tile_height + 'px';
		});


		// set transform based on the hieght
		this.menu_tile_transform( tile_height, nav__sub_item );

		// when i set this i don't want to override the current state. So I need to check for checked.
	},

	menu_open: function(height, nav__sub_item)
	{
		[].forEach.call(nav__sub_item, function(el)
		{
			// var target = event.currentTarget;
			if(el.parentNode.parentNode.querySelector('.nav__check').checked == false) {
				Util.setTransform( el, App.elTransformArgBefore );
			}
		});
	},

	menu_close: function(els)
	{
		[].forEach.call(els, function(el)
		{
			Util.setTransform( el, App.elTransformArg );
		});
	},

	menu_children_event: function(height, nav__sub_item)
	{
		[].forEach.call(Util.d.querySelectorAll('.nav__btn--has-children'), function(el) {
			el.addEventListener('click', function(event)
			{
				var nav__sub_items = event.currentTarget.parentNode.querySelectorAll('.nav__list .nav__sub-item');

				if( event.currentTarget.parentNode.parentNode.querySelector('.nav__check').checked )
				{
					App.elTransformArg = App.elTransformArgBefore;
				} else {
					App.elTransformArg = App.elTransformArgAfter;
				}

			App.menu_close(nav__sub_item );
			});
		});
	},

	menu_tile_transform: function( height, nav__sub_item )
	{
		var elTransformArg = '';

		this.menu_open(height, nav__sub_item);
		this.menu_children_event(height, nav__sub_item);

	},

	/* [ I ] */

	/* [ J ] */

	/* [ K ] */

	/* [ L ] */

	/* [ M ] */


		menu : function()
		{
			document.querySelector('.menu__overlay').addEventListener('click', function(event)
			{
				var hamburger__check = document.querySelector('.hamburger__check');

				if( hamburger__check.checked ) {
					hamburger__check.checked = false;
					App.elTransformArg = App.elTransformArgBefore;
					var menu_sub_item = document.querySelectorAll( '.nav__sub-item' );
					App.menu_close(menu_sub_item);

					[].forEach.call(menu_sub_item, function(el)
					{
						var nav__check = el.parentNode.parentNode.querySelector('.nav__check');
						if( nav__check.checked = true )
						{
							nav__check.checked = false;
						}
					});
				}

			});

		}

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

if( Util.getCookie('cuts-the-mustard') ) {
	// relinquish jQuery's control of the $ variable
	var $ = jQuery.noConflict();
}

/*---------------------------------------------*\
*    INITIALIZE APP
/*---------------------------------------------*/

var cuts_the_mustard = Mustard.init();

if( cuts_the_mustard == true )
{
	// Ready?
	document.addEventListener("DOMContentLoaded", function()
	{
		// Go!
		App.init();
	});
}
