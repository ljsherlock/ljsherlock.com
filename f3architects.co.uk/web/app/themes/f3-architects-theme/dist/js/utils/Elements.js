define("/Users/admin/www/f3architects.co.uk/site/web/app/themes/f3-architects-theme/js/utils/Elements.js",[],function(){return{getParentByClass:function(t,e){for(;t=t.parentNode;)if(void 0!==t.classList&&""!=t.classList&&t.classList.contains(e))return t},getParentByTag:function(t,e){for(e=e.toUpperCase();t=t.parentNode;)if(t.tagName===e)return t},forEach:function(t,e,s){for(var a=0;a<t.length;a++)e.call(s,a,t[a])},each:function(t,e){var s=t.length;if(void 0===s||this.isFunction(t)){for(var a in t)if(!1===e.call(t[a],t[a],a))break}else for(var i=0,n=t[0];i<s&&!1!==e.call(t[i],n,i);n=t[++i]);return t},addRemoveModifier:function(t,e,s){var a=new RegExp("--"+e+".*");return[].forEach.call(t.className.split(" "),function(e,i,n){a.test(e)&&("add"==s&&t.classList.add(e),"remove"==s&&t.classList.remove(e))}),""},makeListFromSelect:function(t){[].forEach.call(document.querySelectorAll(t),function(t,e,s){t.classList.add("custom-select__list--hidden");var a,i,n,c={},r='<ul class="custom-select__list custom-select__list--'+e+'">',l=t.getElementsByTagName("option");for(a=1;a<l.length;++a){c={},i=l[a],i.getAttribute("value"),n=i.text,c.text=n;var o=Util.generate_id(10);l[a].setAttribute("id",o);r+='<li class="custom-select__item" id="'+o+'">'+c.text+"</li>"}r+="</ul>",t.insertAdjacentHTML("afterend",r)})}}});