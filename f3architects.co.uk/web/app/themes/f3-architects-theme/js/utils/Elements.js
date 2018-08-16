/**
* @module Elements
*
* @desc DOM related functions
*/

define(function () {
    return {

				/**
				* @module getParentByClass
				*
				* @desc Get parent element by Classname
				*
				* @param elem (node)
				* @param lookingFor (String) query
				*
				* @return elem (node)
				*/
        getParentByClass: function (elem, lookingFor) {
            while (elem = elem.parentNode) {
                if (typeof(elem.classList) != "undefined" && elem.classList != '') {
                    if (elem.classList.contains(lookingFor)) {
                        return elem;
                    }
                }
            }
        },

				/**
				* @module getParentByTag
				*
				* @desc Get parent element by Tag
				*
				* @param elem (node)
				* @param lookingFor (String) query
				*
				* @return elem (node)
				*/
        getParentByTag: function (elem, lookingFor) {
            lookingFor = lookingFor.toUpperCase();
            while (elem = elem.parentNode) if (elem.tagName === lookingFor) return elem;
        },

				/**
				* @method forEach
				*
				* @desc for loop to run through DOM nodes
				*/
				forEach: function (array, callback, scope) {
					for (var i = 0; i < array.length; i++) {
						callback.call(scope, i, array[i]); // passes back stuff we need
					}
				},

				/**
				* @method each
				*
				* @desc Loop through Obj or Array and run callback
				*
				* @param obj {Object/Array}
				* @param callback {function}
				*/
				each: function (obj, callback) {
						var length = obj.length,
						isObj = (length === undefined) || this.isFunction(obj);
						if (isObj) {
								for(var name in obj) {
										if(callback.call(obj[name], obj[name], name) === false ) {
												break;
										}
								}
						} else {
								for(var i = 0, value = obj[0];
										i < length && callback.call(obj[i], value, i) !== false;
										value = obj[++i] ) {}
							}
							return obj;
				},

				/**
				* @module addRemoveModifier
				*
				* @desc add or remove the modifier from the BEM class
				*
				* @param el (String) query
				* @param modifier (node)
				* @param action (String) add/remove
				*/
				addRemoveModifier: function (el, modifier, action) {
						var regex = new RegExp( '--' +modifier+'.*' );
						var classes = '';

						[].forEach.call(el.className.split(' '), function(c, index, array) {
								if (regex.test(c)) {
										if(action == 'add') {
												el.classList.add(c);
										}
										if(action == 'remove') {
												el.classList.remove(c);
										}
								}
						});
						return classes;
				},

				/**
				* @module makeListFromSelect
				*
				* @desc Get parent element by Tag
				*
				* @param select (String) query
				*/
				makeListFromSelect : function ( select ) {
						//array of list items with value and title
						[].forEach.call(document.querySelectorAll(select), function(el, index, array) {
								el.classList.add('custom-select__list--hidden');

								var i, e, v, t;
								var items = [];
								var obj = {};
								var ul = '<ul class="custom-select__list custom-select__list--'+index+'">';
								var options = el.getElementsByTagName('option');

								for (i = 1; i < options.length; ++i) {
										obj = {};
										e = options[i];
										v = e.getAttribute('value');
										t = e.text;
										obj['text'] = t;

										var id = Util.generate_id(10);
										options[i].setAttribute('id', id);
										//create list items
										var listItem = '<li class="custom-select__item" id="'+id+'">'+obj['text']+'</li>';

										ul += listItem;
								}
								ul += '</ul>';
								el.insertAdjacentHTML('afterend', ul);
						});
				},
    }
});
