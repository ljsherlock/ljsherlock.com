/**
* @module Ajax
*
* @desc Ajax related functions
*/

define(['utils/util'], function( Util ) {

    var Ajax = {

				/**
				* @module put
				*
				* @desc Ajax call with success and failure callbacks
				*
				* @param url (String)
				* @param json (JSON)
				* @param success (Function)
				* @param fail (Function)
				*/
		    put: function( url, json, success, fail ) {

		        var xhr = new XMLHttpRequest(),
		        str = Object.keys(json).map(function(key) {
		            return encodeURIComponent(key) + '=' + encodeURIComponent(json[key]);
		        }).join('&');

		        xhr.open('PUT', url + '?' + str );
		        xhr.setRequestHeader("Content-Type", "application/json");

		        if( json != '' ) {
		            var json_string = JSON.stringify( json );
		            xhr.send(json_string);
		        }

            xhr.onload = function() {
                if (xhr.status === 200) {
                    if( typeof success === 'function' ) {
                        success(xhr.responseText);
                    } else {
                        return xhr.responseText;
                    }
                } else if (xhr.status !== 200) {
                    if( typeof fail === 'function' ) {
                        fail();
                    } else {
                        alert('Request failed.  Returned status of ' + xhr.status);
                    }
                }
            };
            return xhr;
        },

				/**
				* @module internalLinkBefore
				*
				* @desc callback placeholder for the internal links function
				*/
        internalLinkBefore : function() {
						return false;
				 },

				 /**
				 * @module internalLinks
				 *
				 * @desc Add the event listener to every anchor tag we wish to fetch
				 * with Ajax. See .links
				 */
        internalLinks : function() {
            var main = document.querySelector('main'),
            site_url = top.location.host.toString()
            links = document.querySelectorAll("a");

            [].forEach.call(links, function(el) {
                var href = el.getAttribute('href');
                if( href !== null && href.match(site_url) && !href.match('mailto:') ){
                    if ( !el.classList.contains('internal_link') ) {
                        el.classList.add('internal_link');
                        el.addEventListener('click', function(e) {
                            e.preventDefault();

                            var target_url = el.getAttribute('href');
                            var current_url = window.location;

                            if ( target_url != current_url ) {
                                if(  Ajax.getPage(target_url) != false ) {
                                    history.pushState(null, null, target_url);
                                }
                            }
                            e.stopPropagation();
                        });
                    }
                }
            });
        },


				/**
				* @module getPageCallback
				*
				* @desc callback placeholder for the getPage method
				*
				*/
        getPageCallback: function() { },

				/**
				* @module getPage
				*
				* @desc return the result of a URL
				*
				* @param url (String)
				*/
        getPage : function (url) {
            Ajax.internalLinkBefore();

            var json_string = JSON.stringify({
                ajax: true
            });
            var xhr = new XMLHttpRequest();

            xhr.open('POST', url );
            xhr.setRequestHeader("Content-Type", "application/json");
            xhr.send(json_string);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    var response = xhr.responseText;
                    document.title = response.match(/<h1[^>]*>([^<]+)<\/h1>/)[1] + "\u2014" + location.host;
                    Ajax.getPageCallback(response);
                } else if (xhr.status !== 200) {
                    return false;
                }
            };
        },

				/**
				* @module links
				*
				* @desc return the result of a URL
				*
				* @param url (String)
				*/
				links : function (documentMainStr, before, after) {
						var documentMain = document.querySelector(documentMainStr),
						site_url = 'http://' + top.location.host.toString(),
						internal_links = document.querySelectorAll("a[href^='" + site_url +"']");

						// Add call to the links so that we only target internal links.
						internal_links.classList.add('internal_links');

						[].forEach.call(internal_links, function(el) {
								el.classList.add('internal_link');
								el.addEventListener('click', function(event) {
										event.preventDefault();

										// Callback before
										before();

										var url = el.getAttribute('href'),
										json_string = JSON.stringify({ ajax: true }),
										xhr = new XMLHttpRequest();

										// Open the url from the link
										// Send ajax true property so the template does not return the
										// whole HTML.
										xhr.open('PUT', url );
										xhr.setRequestHeader("Content-Type", "application/json");
										xhr.send(json_string);
										xhr.onload = function() {
												if (xhr.status === 200) {
														var response = xhr.responseText;
														documentMain.innerHTML = response;

														after();
												}
												else if (xhr.status !== 200)
												{
														alert('Request failed.  Returned status of ' + xhr.status);
												}
										};

								});
						});
				},

				/**
				*	@method Not sure if required or useful
				*/
				search_keydown_ajax : function () {
					var action = 'fps_search_ajax',
					searchForm = document.querySelector('#search__form'),
					searchEl = document.querySelector('#search--site');


					Events.preventForm(document.querySelector('#search__form'));

					// keypress event
					searchForm.querySelector('.search__field').addEventListener('keydown', function (event) {
							var zhege = event.target,
							searchTerm = zhege.value;

							zhege.setAttribute('autocomplete', 'off');

							if(searchTerm.length > 2) {
								Ajax.put(ajax_url + '?action=' +action, {
										action: action,
										term: searchTerm
								}, function() {
									var response = xhr.responseText,
									search__results = searchEl.querySelector('#search__results'),
									results__portable = searchEl.querySelector('#search__results--portable');
								});
							}
					});
			},

    };

    return Ajax;
});

// get_images : function(key, retina, callback)
// {
// 		//ajax to get all imagems
// 		var data = {};
// 		data.action = 'get_images';
// 		data.global_hero = document.querySelector('[global_hero]').getAttribute('global_hero');
// 		data.id = document.querySelector('[page-id]').getAttribute('page-id');
// 		data.parent_id = document.querySelector('[parent-id]').getAttribute('parent-id');
// 		data.image_key = key;
// 		data.retina = retina;
//
// 		$.ajax(
// 		{
// 				url: ajax_url,
// 				data: data,
// 				context: document.body,
// 				dataType: 'json',
// 				success: function(response)
// 				{
// 						if (typeof callback === 'function')
// 						{
// 								callback(response);
// 						}
// 						else
// 						{
// 								console.log("Failed to find ajax function " + callback);
// 						}
// 				},
// 				error: function(jqXHR, textStatus, errorThrown)
// 				{
// 						console.log(jqXHR, textStatus + errorThrown);
// 				}
// 		});
// },
