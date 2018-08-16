define(['utils/util', 'utils/Device', 'utils/Events', 'utils/Elements', 'lib/scrollReveal', 'utils/Ajax', 'utils/Video'],
function (Util, Device, Events, Elements, scrollReveal, Ajax, Video) {

	'use strict';

	function App () {
			// This first guard ensures that the callee has invoked our Class' constructor function
			// with the `new` keyword - failure to do this will result in the `this` keyword referring
			// to the callee's scope (typically the window global) which will result in the following fields
			// (name and _age) leaking into the global namespace and not being set on this object.
			if (!(this instanceof App)) {
					throw new TypeError("App constructor cannot be called as a function.");
			}

			this.html = document.querySelector('html');
			this.header = document.querySelector('header');
			this.main = document.querySelector('main');

			this.loadingScreen = document.querySelector('#loadingScreen');
			this.overlayLoading = document.querySelector('#overlayLoading');
			this.ajaxScreen = document.querySelector('#ajaxScreen');
			this.overlayAjax = document.querySelector('#overlayAjax');
			this.overlayMenu = document.querySelector('#overlayMenu');

			this.mainDirection = '';
			this.overlayAjaxDirection = '';
			this.ajaxScreenDirection = '';
	}

	/**
	* @method toggleOverlappingElements
	*
	* @param {NodeList} onTopNodeList (Query Selector)
	* @param {NodeList} belowNodeList (Query Selector)
	*/
	// change the colour of the hamburger and logo when it overlaps the green blocks.
	// window.addEventListener('scroll', function () {
	// 		toggleOverlappingElements(this,
	// 			document.querySelectorAll('.symbol--icon-logo, .hamburger .hamburger__layer'),
	// 			document.querySelectorAll('.block--green, article.type-work, article.type-staff, .btn--f3')
	// 		);
	// });
	function toggleOverlappingElements (App, onTopNodeList, belowNodeList) {
			Elements.forEach(onTopNodeList, function (index, value) {
					Elements.forEach(belowNodeList, function (indexI, valueI) {
						var belowRect = valueI.getBoundingClientRect(),
							onTopRect = value.getBoundingClientRect();

						// Check it if the elments on top are overlapping the element below.
						if (belowRect.top <= onTopRect.top + onTopRect.height && belowRect.top + belowRect.height > onTopRect.top) {
									value.classList.add('element--overlap');
									valueI.classList.add('element--overlaped-' + index);
						} else {
							if (valueI.classList.contains('element--overlaped-' + index)) {
											valueI.classList.remove('element--overlaped-' + index);
											value.classList.remove('element--overlap');
							}
							return false;
						}
					}, value);
			}, belowNodeList);
	};

	function hamburger (el, force) {
		var m = 'hamburger--active';

		if (el.classList.contains(m) || force == 'remove') {
				el.classList.remove(m);
				document.body.style.overflow = 'auto';
		} else {
				el.classList.add(m);
				document.body.style.overflow = 'hidden';
		}
	};

	function toggleMobileMenu (menuSelector) {
        [].forEach.call(document.querySelectorAll(menuSelector), function(el) {
            var m = 'nav--mobile';
                if (el.length !== 0) {
                    if (el.classList.contains(m)) {
                                el.classList.remove(m);
                    } else {
                                el.classList.add(m);
                    }
                }
        });
	};

	function Events () {
			Video.playPauseVideo(document.querySelector('#project-video'));
			[].forEach.call(document.querySelectorAll('.project-video'), function(el) {
					Video.playPauseVideo(el);
			});

			[].forEach.call(document.querySelectorAll('.nav--linked .menu-item-has-children'), function(el) {
					el.addEventListener('click', function(event) {
							event.preventDefault();

							// get children id
							var target = event.currentTarget;
							var navId = target.getAttribute('children-id');

							// hide main nav
							target.parentNode.classList.add('nav--hide');

							// show children
							document.getElementById(navId).classList.remove('nav--hide');
					});
			});

			[].forEach.call(document.querySelectorAll('.nav--primary .nav__close'), function(el) {
					el.addEventListener('click',  function(event) {
							event.preventDefault();

							// hide children
							var target = event.currentTarget;
							target.parentNode.classList.add('.nav--hide');

							// hide main nav
							target.parentNode.classList.add('nav--hide');

							// show parents
							target.parentNode.parentNode.querySelector('.nav--linked').classList.remove('nav--hide');
					});
			});

			var loadMore = document.querySelector('#loadMore');

			if (loadMore !== null) {
				var offset = loadMore.getAttribute('data-offset'),
				total = loadMore.getAttribute('data-total');

				if (parseInt(total) < parseInt(offset)) {
								loadMore.setAttribute('data-more', 0);
								loadMore.classList.add('state');
								loadMore.classList.add('state--hide');
				}

				loadMore.addEventListener('click', function (event) {
					// get all the attrs
					var target = event.currentTarget,
						more = target.getAttribute('data-more'),
						post_type = target.getAttribute('data-post-type'),
						posts_per_page = target.getAttribute('data-posts-per-page'),
						taxonomy = target.getAttribute('data-taxonomy'),
						category = target.getAttribute('data-category'),
						tag = target.getAttribute('data-tag'),
						term = target.getAttribute('data-term');

						target.classList.add('state--hide');

						// creat the JSON obj
						var json_string = {
							action: 'load_more',
							offset: offset,
							total: total,
							post_type: post_type,
							posts_per_page: posts_per_page,
							taxonomy: taxonomy,
							category: category,
							tag: tag,
							term: term
						};

						if (more == 1) {
								Ajax.put(window.ajax_url, json_string, function (response) {
									// append HTML to DOM
									var archive = document.querySelector('.archive');
									archive.innerHTML += response;

									// update the button data
									offset = parseInt(offset) + parseInt(posts_per_page);
										target.setAttribute('data-offset', offset);
										target.classList.remove('state--hide');
										if (total < offset) {
												target.setAttribute('data-more', 0);
												target.classList.add('state');
												target.classList.add('state--hide');
										}
								});
						}
				});
			}

			document.querySelector('#hamburger').addEventListener('click', function(e) {
				// toggle hamburger icon
					hamburger(e.currentTarget);

					// Toggle mobile menu.
					toggleMobileMenu('.nav--primary');

					// Toggle header
					var header = document.querySelector('header');
					var headerModifier = 'header--fade-in';
					if (header.classList.contains(headerModifier)) {
							header.classList.remove(headerModifier);
							header.querySelector('.symbol--icon-logo').classList.remove('icon--negative');
					} else {
							header.classList.add(headerModifier);
							header.querySelector('.symbol--icon-logo').classList.add('icon--negative');
					}
			});

			// Work terms hover
			[].forEach.call(document.querySelectorAll('a.taxonomy--type'), function(el) {
					el.addEventListener('mouseover',  function(event) {
							event.preventDefault();

							var target = event.currentTarget;

							// update the term description
							var workDescription = document.getElementById('workDescription');
							var description = archiveWorkTerms[target.getAttribute('slug')].description;	
							workDescription.innerHTML = description;
					});
			});
	};

	function scrollRevealFrontpage () {
		var device = Device.detect();
        var container = document.querySelector('.gallery');

        if(container !== null) {
            window.addEventListener('resize', function() {
                if (device.isMobile == false && window.innerWidth <= 770) {
                    container.classList.remove('gallery--animate');
                    if(container.hasAttribute('style')) {
                        container.removeAttribute('style');
                    }
                    [].forEach.call(document.querySelectorAll('.gallery > *'), function (el, index, array) {
                            el.classList.remove('gallery__item--show');
                            if(el.hasAttribute('style')) {
                                el.removeAttribute('style');
                            }
                    });
                }
            });

            if (device.isMobile == false && window.innerWidth >= 770) {
					var elemHeight = 0;
					container.classList.add('gallery--animate');

					[].forEach.call(document.querySelectorAll('.gallery > *'), function (el) {
						var height = el.offsetTop + el.clientHeight;
						if (height > elemHeight) {
							elemHeight = height;
							container.style.height = elemHeight + 'px';
						}
					});

					var config = {
						viewFactor: 0.15,
						distance: '0px',
						origin: 'right',
						easing: 'ease-in',
						delay: 250,
						duration: 750,
						scale: 1,
						mobile: false,
						beforeReveal: function(a) {
							// a.style.visible = '0';
							a.style.transform = '';
              a.classList.add('gallery__item--show');
							// var x = transformX[ a.getAttribute('data-number') ] + 'px';
							// a.style.opacity = 1;
						}
					};

					window.sr = scrollReveal();
					setTimeout(function () {
              sr.reveal('.gallery > *', config);
					}, 2250);
			} else {
				config = {
					viewFactor: 0.15,
					distance: '50vw',
					origin: 'right',
					easing: 'ease-out',
					duration: 500,
					scale: 1
				};

				window.sr = scrollReveal();
                sr.reveal('.gallery > *', config);
			}

        }
	};

	App.prototype = {

		constructor: App,

		doAnimations: function () {
			this.html.classList.add('html--animation-loaded');
			this.main.classList.add('main--fade');
			this.header.classList.add('header--animation-loaded');
		},

		start: function () {
				setTimeout(this.doAnimations(), 250);
				Events();
				scrollRevealFrontpage();
		}

	};

	return App;
});


// function ajaxLinks () {
//
// 	require(['utils/Ajax'], function (Ajax) {
//
// 			Ajax.internalLinkBefore = function () {
// 					var hamburger = document.querySelector('.hamburger');
// 					if (hamburger.classList.contains('hamburger--active')) {
// 							this.hamburger(hamburger);
// 							this.toggleMobileMenu('.nav--primary');
// 							var header = document.querySelector('header');
// 							var headerModifier = 'header--fade-in';
// 							if (header.classList.contains(headerModifier)) {
// 									header.classList.remove(headerModifier);
// 							} else {
// 									header.classList.add(headerModifier);
// 							}
// 					}
// 					ajaxLinks();
// 					this.toggleAjaxLoadingScreen();
// 		 };
//
// 			Ajax.getPageCallback = function (response) {
// 				var main = document.querySelector('main');
// 				main.innerHTML = response;
// 						window.scroll(0, 0);
// 						Ajax.internalLinks();
//
// 						setTimeout(function() {
// 								// Finish Loading animation
// 								this.toggleAjaxLoadingScreen();
//
// 								// Ajax Main
// 								this.main.classList.add('main--ajax');
// 								this.main.classList.remove('main--fade');
// 								// void this.main.offsetWidth;
// 								this.main.classList.add('main--fade');
// 						}, 750);
// 			};
//
// 			window.onpopstate = function (event) {
// 					Ajax.getPage(document.location);
// 			};
//
// 			Ajax.internalLinks();
// 	});
// };
