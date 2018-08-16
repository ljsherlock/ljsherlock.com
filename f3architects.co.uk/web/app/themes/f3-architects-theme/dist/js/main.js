"use strict";define("utils/util",[],function(){window,document,document.documentElement,document.getElementsByTagName("body")[0],window.innerWidth,window.innerHeight;return{isArray:function(e){return"[object Array]"===Object.prototype.toString.call(e)},isFunction:function(e){return"[object Function]"===Object.prototype.toString.call(e)},makeArray:function(e){return null!=e.length?Array.prototype.slice.call(e,0).filter(function(e){return void 0!==e}):[]},set_cookie:function(e,t){var n=new Date;n.setTime(n.getTime()+864e6);var i=n.toUTCString();document.cookie=e+"="+encodeURI(t)+"; expires="+i+"; path=/"},hasCookie:function(e){if(this.getCookie(e))return!0},getCookie:function(e){if(this.hasCookie(e)){var t="; "+document.cookie,n=t.split("; "+e+"=");if(2==n.length)return n.pop().split(";").shift()}return!1},delete_cookie:function(e){return this.hasCookie(e)&&(document.cookie=e+"=; expires=Thu, 01 Jan 1970 00:00:01 GMT;"),!1},supportSVG:function(){return!(!document.createElementNS||!document.createElementNS("http://www.w3.org/2000/svg","svg").createSVGRect)},generate_id:function(e){var t="0123456789ABCDEFGHIJKLMNOPQRSTUVWXTZabcdefghiklmnopqrstuvwxyz".split(""),n="";e||(e=Math.floor(Math.random()*t.length));for(var i=0;i<e;i++)n+=t[Math.floor(Math.random()*t.length)];return n},fitToWindow:function(e){var t=this.d.querySelector(e),n=this.w.innerHeight;t&&(t.style.height=n+"px")},fullscreen:function(e){this.fitToWindow(e),window.onresize=function(){this.fitToWindow(e)}},dekstop_nav__hide:function(){function e(){var e=$(window).scrollTop();Math.abs(n-e)<=i||(0==e?($("header").removeClass("header--hide-it"),$("header").removeClass("header--fixed"),$("header").find(".nav__menu").addClass("flex-row__flex-col--center").removeClass("flex-row__flex-col--centered")):e>n&&e>0?($("header").addClass("header--hide-it").removeClass("header--fixed"),$("header").find(".nav__menu").addClass("flex-row__flex-col--centered").removeClass("flex-row__flex-col--center")):e+$(window).height()<o?$("header").removeClass("header--hide-it"):($("header").removeClass("header--hide-it"),$("header").addClass("header--fixed")),n=e)}var t,n=0,i=5,o=$("header nav#mainMenu").outerHeight();$(window).scroll(function(e){t=!0}),setInterval(function(){t&&(e(),t=!1)},250)},loadScript:function(e,t){var n=document.createElement("script");n.src=e,n.onload=function(){t()},n.onerror=function(){t(new Error("Failed to load script "+e))},document.head.appendChild(n)},param:function(e){var t="";for(var n in e)e.hasOwnProperty(n)&&(t.length>0&&(t+="&"),t+=encodeURI(n+"="+e[n]));return t},perf:function(){var e=function(e){window.onload=function(){window.performance=window.performance||window.mozPerformance||window.msPerformance||window.webkitPerformance||{};var t,n=window.performance.timing,i=(new Date).getTime();if(n){e=e||1e3;var o=n.navigationStart,r=document.createElement("div");r.setAttribute("id","results"),t=i-o,r.innerHTML=i-o+"ms",r.className+=t>e?" overBudget":" underBudget",document.body.appendChild(r)}}};window.perfBar=e},debouncer:function(e,t,n){var i;return function(){var o=this,r=arguments,a=function(){i=null,n||e.apply(o,r)},s=n&&!i;clearTimeout(i),i=setTimeout(a,t),s&&e.apply(o,r)}},getScrollXY:function(){var e=0,t=0;return"number"==typeof window.pageYOffset?(t=window.pageYOffset,e=window.pageXOffset):document.body&&(document.body.scrollLeft||document.body.scrollTop)?(t=document.body.scrollTop,e=document.body.scrollLeft):document.documentElement&&(document.documentElement.scrollLeft||document.documentElement.scrollTop)&&(t=document.documentElement.scrollTop,e=document.documentElement.scrollLeft),[e,t]},getDocHeight:function(){var e=document;return Math.max(e.body.scrollHeight,e.documentElement.scrollHeight,e.body.offsetHeight,e.documentElement.offsetHeight,e.body.clientHeight,e.documentElement.clientHeight)},affixFileName:function(e,t){return e.substring(0,e.lastIndexOf("."))+t+e.substring(e.lastIndexOf("."))}}}),define("lib/mustard",["utils/util"],function(e){return{init:function(){return!!navigator.cookieEnabled&&(!!e.has_cookie("cuts-the-mustard")||(this.cuts_the_mustard()&&(e.set_cookie("cuts-the-mustard",!0),this.halt_reload()),!1))},cuts_the_mustard:function(){return"querySelector"in document&&"localStorage"in window&&"addEventListener"in window},halt_reload:function(){window.stop(),location.reload(!0)}}}),define("utils/Events",["utils/util"],function(e){var t={actionAfterTyping:function(n,i){var o;return e.addEventHandler(n,"keyup",function(){clearTimeout(o),o=setTimeout(function(){t.actionAfterTypingCallback(function(){i()})},1500)}),o},actionAfterTypingCallback:function(e){e()},bindOneNeedsPrefixes:{animationend:!0},bindOneprefixes:["webkit","moz","ms","o"],bindOne:function(e,n,i,o){n.trim().split(/\s+/).forEach(function(n){function r(){a&&t.bindOneprefixes.forEach(function(e){this.removeEventListener(e+n,r,o)},this),this.removeEventListener(n,r,o),i.call(this,event)}var a=t.bindOneNeedsPrefixes[n.toLowerCase()];a&&t.bindOneprefixes.forEach(function(t){e.addEventListener(t+n,r,o)}),e.addEventListener(n,r,o)})},delegate:function(e,t,n,i){e.addEventListener(t,function(e){for(var t=e.target;t&&t!==this;)"function"==typeof t.matches?t.matches(n)&&i.call(t,e):t.matchesSelector(n)&&i.call(t,e),t=t.parentNode})},domReady:function(e){/comp|inter|loaded/.test(document.readyState)?e():document.addEventListener("DOMContentLoaded",function(){e()},!1)},preventForm:function(e){e.addEventListener("submit",function(e){e.preventDefault()})},addLoadEvent:function(e){var t=window.onload;"function"!=typeof window.onload?window.onload=e:window.onload=function(){t&&t(),e()}},addEventHandler:function(e,t,n){e.addEventListener?e.addEventListener(t,n,!1):e.attachEvent&&e.attachEvent("on"+t,n)},onChange:function(t){e.addEventHandler(t,"change",function(){callback()})}};return t}),define("lib/appConfig",[],function(){return{mobileWidthMax:500,tabletWidthMax:800,wrapWidth:1200}}),define("utils/Device",["utils/util","lib/appConfig"],function(e,t){return{detect:function(){return/Android|webOS|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)||window.innerWidth<=t.mobileWidthMax?{isMobile:!0,isTablet:!1,isDesktop:!1}:/Android|webOS|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)||window.innerWidth<=t.tabletWidthMax?{isTablet:!0,isMobile:!1,isDesktop:!1}:{isTablet:!1,isMobile:!1,isDesktop:!0}},isRetina:function(){return!!("devicePixelRatio"in window&&window.devicePixelRatio>=1.5||"matchMedia"in window&&window.matchMedia("(-webkit-min-device-pixel-ratio: 1.5), (min--moz-device-pixel-ratio: 1.5), (-o-min-device-pixel-ratio: 3/2), (min-resolution: 1.5dppx)").matches)},detectIE:function(){var e=window.navigator.userAgent,t=e.indexOf("MSIE ");if(t>0)return parseInt(e.substring(t+5,e.indexOf(".",t)),10);if(e.indexOf("Trident/")>0){var n=e.indexOf("rv:");return parseInt(e.substring(n+3,e.indexOf(".",n)),10)}var i=e.indexOf("Edge/");return i>0&&parseInt(e.substring(i+5,e.indexOf(".",i)),10)}}}),define("utils/Elements",[],function(){return{getParentByClass:function(e,t){for(;e=e.parentNode;)if(void 0!==e.classList&&""!=e.classList&&e.classList.contains(t))return e},getParentByTag:function(e,t){for(t=t.toUpperCase();e=e.parentNode;)if(e.tagName===t)return e},forEach:function(e,t,n){for(var i=0;i<e.length;i++)t.call(n,i,e[i])},each:function(e,t){var n=e.length;if(void 0===n||this.isFunction(e)){for(var i in e)if(!1===t.call(e[i],e[i],i))break}else for(var o=0,r=e[0];o<n&&!1!==t.call(e[o],r,o);r=e[++o]);return e},addRemoveModifier:function(e,t,n){var i=new RegExp("--"+t+".*");return[].forEach.call(e.className.split(" "),function(t,o,r){i.test(t)&&("add"==n&&e.classList.add(t),"remove"==n&&e.classList.remove(t))}),""},makeListFromSelect:function(e){[].forEach.call(document.querySelectorAll(e),function(e,t,n){e.classList.add("custom-select__list--hidden");var i,o,r,a={},s='<ul class="custom-select__list custom-select__list--'+t+'">',l=e.getElementsByTagName("option");for(i=1;i<l.length;++i){a={},o=l[i],o.getAttribute("value"),r=o.text,a.text=r;var c=Util.generate_id(10);l[i].setAttribute("id",c);s+='<li class="custom-select__item" id="'+c+'">'+a.text+"</li>"}s+="</ul>",e.insertAdjacentHTML("afterend",s)})}}}),function(){function e(n){return void 0===this||Object.getPrototypeOf(this)!==e.prototype?new e(n):(S=this,S.version="3.3.6",S.tools=new L,S.isSupported()?(S.tools.extend(S.defaults,n||{}),S.defaults.container=t(S.defaults),S.store={elements:{},containers:[]},S.sequences={},S.history=[],S.uid=0,S.initialized=!1):"undefined"!=typeof console&&null!==console&&console.log("ScrollReveal is not supported in this browser."),S)}function t(e){if(e&&e.container){if("string"==typeof e.container)return window.document.documentElement.querySelector(e.container);if(S.tools.isNode(e.container))return e.container;console.log('ScrollReveal: invalid container "'+e.container+'" provided.'),console.log("ScrollReveal: falling back to default container.")}return S.defaults.container}function n(e,t){return"string"==typeof e?Array.prototype.slice.call(t.querySelectorAll(e)):S.tools.isNode(e)?[e]:S.tools.isNodeList(e)?Array.prototype.slice.call(e):[]}function i(){return++S.uid}function o(e,t,n){t.container&&(t.container=n),e.config?e.config=S.tools.extendClone(e.config,t):e.config=S.tools.extendClone(S.defaults,t),"top"===e.config.origin||"bottom"===e.config.origin?e.config.axis="Y":e.config.axis="X"}function r(e){var t=window.getComputedStyle(e.domEl);e.styles||(e.styles={transition:{},transform:{},computed:{}},e.styles.inline=e.domEl.getAttribute("style")||"",e.styles.inline+="; visibility: visible; ",e.styles.computed.opacity=t.opacity,t.transition&&"all 0s ease 0s"!==t.transition?e.styles.computed.transition=t.transition+", ":e.styles.computed.transition=""),e.styles.transition.instant=a(e,0),e.styles.transition.delayed=a(e,e.config.delay),e.styles.transform.initial=" -webkit-transform:",e.styles.transform.target=" -webkit-transform:",s(e),e.styles.transform.initial+="transform:",e.styles.transform.target+="transform:",s(e)}function a(e,t){var n=e.config;return"-webkit-transition: "+e.styles.computed.transition+"-webkit-transform "+n.duration/1e3+"s "+n.easing+" "+t/1e3+"s, opacity "+n.duration/1e3+"s "+n.easing+" "+t/1e3+"s; transition: "+e.styles.computed.transition+"transform "+n.duration/1e3+"s "+n.easing+" "+t/1e3+"s, opacity "+n.duration/1e3+"s "+n.easing+" "+t/1e3+"s; "}function s(e){var t,n=e.config,i=e.styles.transform;t="top"===n.origin||"left"===n.origin?/^-/.test(n.distance)?n.distance.substr(1):"-"+n.distance:n.distance,parseInt(n.distance)&&(i.initial+=" translate"+n.axis+"("+t+")",i.target+=" translate"+n.axis+"(0)"),n.scale&&(i.initial+=" scale("+n.scale+")",i.target+=" scale(1)"),n.rotate.x&&(i.initial+=" rotateX("+n.rotate.x+"deg)",i.target+=" rotateX(0)"),n.rotate.y&&(i.initial+=" rotateY("+n.rotate.y+"deg)",i.target+=" rotateY(0)"),n.rotate.z&&(i.initial+=" rotateZ("+n.rotate.z+"deg)",i.target+=" rotateZ(0)"),i.initial+="; opacity: "+n.opacity+";",i.target+="; opacity: "+e.styles.computed.opacity+";"}function l(e){var t=e.config.container;t&&-1===S.store.containers.indexOf(t)&&S.store.containers.push(e.config.container),S.store.elements[e.id]=e}function c(e,t,n){var i={target:e,config:t,interval:n};S.history.push(i)}function d(){if(S.isSupported()){m();for(var e=0;e<S.store.containers.length;e++)S.store.containers[e].addEventListener("scroll",u),S.store.containers[e].addEventListener("resize",u);S.initialized||(window.addEventListener("scroll",u),window.addEventListener("resize",u),S.initialized=!0)}return S}function u(){A(m)}function f(){var e,t,n,i;S.tools.forOwn(S.sequences,function(o){i=S.sequences[o],e=!1;for(var r=0;r<i.elemIds.length;r++)n=i.elemIds[r],t=S.store.elements[n],x(t)&&!e&&(e=!0);i.active=e})}function m(){var e,t;f(),S.tools.forOwn(S.store.elements,function(n){t=S.store.elements[n],e=y(t),h(t)?(t.config.beforeReveal(t.domEl),e?t.domEl.setAttribute("style",t.styles.inline+t.styles.transform.target+t.styles.transition.delayed):t.domEl.setAttribute("style",t.styles.inline+t.styles.transform.target+t.styles.transition.instant),v("reveal",t,e),t.revealing=!0,t.seen=!0,t.sequence&&p(t,e)):g(t)&&(t.config.beforeReset(t.domEl),t.domEl.setAttribute("style",t.styles.inline+t.styles.transform.initial+t.styles.transition.instant),v("reset",t),t.revealing=!1)})}function p(e,t){var n=0,i=0,o=S.sequences[e.sequence.id];o.blocked=!0,t&&"onload"===e.config.useDelay&&(i=e.config.delay),e.sequence.timer&&(n=Math.abs(e.sequence.timer.started-new Date),window.clearTimeout(e.sequence.timer)),e.sequence.timer={started:new Date},e.sequence.timer.clock=window.setTimeout(function(){o.blocked=!1,e.sequence.timer=null,u()},Math.abs(o.interval)+i-n)}function v(e,t,n){var i=0,o=0,r="after";switch(e){case"reveal":o=t.config.duration,n&&(o+=t.config.delay),r+="Reveal";break;case"reset":o=t.config.duration,r+="Reset"}t.timer&&(i=Math.abs(t.timer.started-new Date),window.clearTimeout(t.timer.clock)),t.timer={started:new Date},t.timer.clock=window.setTimeout(function(){t.config[r](t.domEl),t.timer=null},o-i)}function h(e){if(e.sequence){var t=S.sequences[e.sequence.id];return t.active&&!t.blocked&&!e.revealing&&!e.disabled}return x(e)&&!e.revealing&&!e.disabled}function y(e){var t=e.config.useDelay;return"always"===t||"onload"===t&&!S.initialized||"once"===t&&!e.seen}function g(e){if(e.sequence){return!S.sequences[e.sequence.id].active&&e.config.reset&&e.revealing&&!e.disabled}return!x(e)&&e.config.reset&&e.revealing&&!e.disabled}function w(e){return{width:e.clientWidth,height:e.clientHeight}}function b(e){if(e&&e!==window.document.documentElement){var t=E(e);return{x:e.scrollLeft+t.left,y:e.scrollTop+t.top}}return{x:window.pageXOffset,y:window.pageYOffset}}function E(e){var t=0,n=0,i=e.offsetHeight,o=e.offsetWidth;do{isNaN(e.offsetTop)||(t+=e.offsetTop),isNaN(e.offsetLeft)||(n+=e.offsetLeft),e=e.offsetParent}while(e);return{top:t,left:n,height:i,width:o}}function x(e){var t=E(e.domEl),n=w(e.config.container),i=b(e.config.container),o=e.config.viewFactor,r=t.height,a=t.width,s=t.top,l=t.left,c=s+r,d=l+a;return function(){var t=s+r*o,u=l+a*o,f=c-r*o,m=d-a*o,p=i.y+e.config.viewOffset.top,v=i.x+e.config.viewOffset.left,h=i.y-e.config.viewOffset.bottom+n.height,y=i.x-e.config.viewOffset.right+n.width;return t<h&&f>p&&u<y&&m>v}()||function(){return"fixed"===window.getComputedStyle(e.domEl).position}()}function L(){}var S,A;e.prototype.defaults={origin:"bottom",distance:"20px",duration:500,delay:0,rotate:{x:0,y:0,z:0},opacity:0,scale:.9,easing:"cubic-bezier(0.6, 0.2, 0.1, 1)",container:window.document.documentElement,mobile:!0,reset:!1,useDelay:"always",viewFactor:.2,viewOffset:{top:0,right:0,bottom:0,left:0},beforeReveal:function(e){},beforeReset:function(e){},afterReveal:function(e){},afterReset:function(e){}},e.prototype.isSupported=function(){var e=document.documentElement.style;return"WebkitTransition"in e&&"WebkitTransform"in e||"transition"in e&&"transform"in e},e.prototype.reveal=function(e,a,s,u){var f,m,p,v,h,y;if(void 0!==a&&"number"==typeof a?(s=a,a={}):void 0!==a&&null!==a||(a={}),f=t(a),m=n(e,f),!m.length)return console.log('ScrollReveal: reveal on "'+e+'" failed, no elements found.'),S;s&&"number"==typeof s&&(y=i(),h=S.sequences[y]={id:y,interval:s,elemIds:[],active:!1});for(var g=0;g<m.length;g++)v=m[g].getAttribute("data-sr-id"),v?p=S.store.elements[v]:(p={id:i(),domEl:m[g],seen:!1,revealing:!1},p.domEl.setAttribute("data-sr-id",p.id)),h&&(p.sequence={id:h.id,index:h.elemIds.length},h.elemIds.push(p.id)),o(p,a,f),r(p),l(p),S.tools.isMobile()&&!p.config.mobile||!S.isSupported()?(p.domEl.setAttribute("style",p.styles.inline),p.disabled=!0):p.revealing||p.domEl.setAttribute("style",p.styles.inline+p.styles.transform.initial);return!u&&S.isSupported()&&(c(e,a,s),S.initTimeout&&window.clearTimeout(S.initTimeout),S.initTimeout=window.setTimeout(d,0)),S},e.prototype.sync=function(){if(S.history.length&&S.isSupported()){for(var e=0;e<S.history.length;e++){var t=S.history[e];S.reveal(t.target,t.config,t.interval,!0)}d()}else console.log("ScrollReveal: sync failed, no reveals found.");return S},L.prototype.isObject=function(e){return null!==e&&"object"==typeof e&&e.constructor===Object},L.prototype.isNode=function(e){return"object"==typeof window.Node?e instanceof window.Node:e&&"object"==typeof e&&"number"==typeof e.nodeType&&"string"==typeof e.nodeName},L.prototype.isNodeList=function(e){var t=Object.prototype.toString.call(e),n=/^\[object (HTMLCollection|NodeList|Object)\]$/;return"object"==typeof window.NodeList?e instanceof window.NodeList:e&&"object"==typeof e&&n.test(t)&&"number"==typeof e.length&&(0===e.length||this.isNode(e[0]))},L.prototype.forOwn=function(e,t){if(!this.isObject(e))throw new TypeError('Expected "object", but received "'+typeof e+'".');for(var n in e)e.hasOwnProperty(n)&&t(n)},L.prototype.extend=function(e,t){return this.forOwn(t,function(n){this.isObject(t[n])?(e[n]&&this.isObject(e[n])||(e[n]={}),this.extend(e[n],t[n])):e[n]=t[n]}.bind(this)),e},L.prototype.extendClone=function(e,t){return this.extend(this.extend({},e),t)},L.prototype.isMobile=function(){return/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)},A=window.requestAnimationFrame||window.webkitRequestAnimationFrame||window.mozRequestAnimationFrame||function(e){window.setTimeout(e,1e3/60)},"function"==typeof define&&"object"==typeof define.amd&&define.amd?define("lib/scrollReveal",[],function(){return e}):"undefined"!=typeof module&&module.exports?module.exports=e:window.ScrollReveal=e}(),define("utils/Ajax",["utils/util"],function(e){var t={put:function(e,t,n,i){var o=new XMLHttpRequest,r=Object.keys(t).map(function(e){return encodeURIComponent(e)+"="+encodeURIComponent(t[e])}).join("&");if(o.open("PUT",e+"?"+r),o.setRequestHeader("Content-Type","application/json"),""!=t){var a=JSON.stringify(t);o.send(a)}return o.onload=function(){if(200===o.status){if("function"!=typeof n)return o.responseText;n(o.responseText)}else 200!==o.status&&("function"==typeof i?i():alert("Request failed.  Returned status of "+o.status))},o},internalLinkBefore:function(){return!1},internalLinks:function(){var e=(document.querySelector("main"),top.location.host.toString());links=document.querySelectorAll("a"),[].forEach.call(links,function(n){var i=n.getAttribute("href");null!==i&&i.match(e)&&!i.match("mailto:")&&(n.classList.contains("internal_link")||(n.classList.add("internal_link"),n.addEventListener("click",function(e){e.preventDefault();var i=n.getAttribute("href");i!=window.location&&0!=t.getPage(i)&&history.pushState(null,null,i),e.stopPropagation()})))})},getPageCallback:function(){},getPage:function(e){t.internalLinkBefore();var n=JSON.stringify({ajax:!0}),i=new XMLHttpRequest;i.open("POST",e),i.setRequestHeader("Content-Type","application/json"),i.send(n),i.onload=function(){if(200===i.status){var e=i.responseText;document.title=e.match(/<h1[^>]*>([^<]+)<\/h1>/)[1]+"—"+location.host,t.getPageCallback(e)}else if(200!==i.status)return!1}},links:function(e,t,n){var i=document.querySelector(e),o="http://"+top.location.host.toString(),r=document.querySelectorAll("a[href^='"+o+"']");r.classList.add("internal_links"),[].forEach.call(r,function(e){e.classList.add("internal_link"),e.addEventListener("click",function(o){o.preventDefault(),t();var r=e.getAttribute("href"),a=JSON.stringify({ajax:!0}),s=new XMLHttpRequest;s.open("PUT",r),s.setRequestHeader("Content-Type","application/json"),s.send(a),s.onload=function(){if(200===s.status){var e=s.responseText;i.innerHTML=e,n()}else 200!==s.status&&alert("Request failed.  Returned status of "+s.status)}})})},search_keydown_ajax:function(){var e=document.querySelector("#search__form"),n=document.querySelector("#search--site");Events.preventForm(document.querySelector("#search__form")),e.querySelector(".search__field").addEventListener("keydown",function(e){var i=e.target,o=i.value;i.setAttribute("autocomplete","off"),o.length>2&&t.put(ajax_url+"?action=fps_search_ajax",{action:"fps_search_ajax",term:o},function(){xhr.responseText,n.querySelector("#search__results"),n.querySelector("#search__results--portable")})})}};return t}),define("utils/Video",[],function(){return{playPauseVideo:function(e){if(e){var t=e.querySelector("video"),n=e.querySelector(".video__playpause");t&&n&&(t.removeAttribute("controls"),n.addEventListener("click",function(){t.paused?(t.play(),n.classList.add("video__playpause--playing")):(t.pause(),n.classList.remove("video__playpause--playing"))},!1))}}}}),define("App",["utils/util","utils/Device","utils/Events","utils/Elements","lib/scrollReveal","utils/Ajax","utils/Video"],function(e,t,n,i,o,r,a){function s(){if(!(this instanceof s))throw new TypeError("App constructor cannot be called as a function.");this.html=document.querySelector("html"),this.header=document.querySelector("header"),this.main=document.querySelector("main"),this.loadingScreen=document.querySelector("#loadingScreen"),this.overlayLoading=document.querySelector("#overlayLoading"),this.ajaxScreen=document.querySelector("#ajaxScreen"),this.overlayAjax=document.querySelector("#overlayAjax"),this.overlayMenu=document.querySelector("#overlayMenu"),this.mainDirection="",this.overlayAjaxDirection="",this.ajaxScreenDirection=""}function l(e,t){var n="hamburger--active";e.classList.contains(n)||"remove"==t?(e.classList.remove(n),document.body.style.overflow="auto"):(e.classList.add(n),document.body.style.overflow="hidden")}function c(e){[].forEach.call(document.querySelectorAll(e),function(e){var t="nav--mobile";0!==e.length&&(e.classList.contains(t)?e.classList.remove(t):e.classList.add(t))})}function n(){a.playPauseVideo(document.querySelector("#project-video")),[].forEach.call(document.querySelectorAll(".project-video"),function(e){a.playPauseVideo(e)}),[].forEach.call(document.querySelectorAll(".nav--linked .menu-item-has-children"),function(e){e.addEventListener("click",function(e){e.preventDefault();var t=e.currentTarget,n=t.getAttribute("children-id");t.parentNode.classList.add("nav--hide"),document.getElementById(n).classList.remove("nav--hide")})}),[].forEach.call(document.querySelectorAll(".nav--primary .nav__close"),function(e){e.addEventListener("click",function(e){e.preventDefault();var t=e.currentTarget;t.parentNode.classList.add(".nav--hide"),t.parentNode.classList.add("nav--hide"),t.parentNode.parentNode.querySelector(".nav--linked").classList.remove("nav--hide")})});var e=document.querySelector("#loadMore");if(null!==e){var t=e.getAttribute("data-offset"),n=e.getAttribute("data-total");parseInt(n)<parseInt(t)&&(e.setAttribute("data-more",0),e.classList.add("state"),e.classList.add("state--hide")),e.addEventListener("click",function(e){var i=e.currentTarget,o=i.getAttribute("data-more"),a=i.getAttribute("data-post-type"),s=i.getAttribute("data-posts-per-page"),l=i.getAttribute("data-taxonomy"),c=i.getAttribute("data-category"),d=i.getAttribute("data-tag"),u=i.getAttribute("data-term");i.classList.add("state--hide");var f={action:"load_more",offset:t,total:n,post_type:a,posts_per_page:s,taxonomy:l,category:c,tag:d,term:u};1==o&&r.put(window.ajax_url,f,function(e){document.querySelector(".archive").innerHTML+=e,t=parseInt(t)+parseInt(s),i.setAttribute("data-offset",t),i.classList.remove("state--hide"),n<t&&(i.setAttribute("data-more",0),i.classList.add("state"),i.classList.add("state--hide"))})})}document.querySelector("#hamburger").addEventListener("click",function(e){l(e.currentTarget),c(".nav--primary");var t=document.querySelector("header");t.classList.contains("header--fade-in")?(t.classList.remove("header--fade-in"),t.querySelector(".symbol--icon-logo").classList.remove("icon--negative")):(t.classList.add("header--fade-in"),t.querySelector(".symbol--icon-logo").classList.add("icon--negative"))}),[].forEach.call(document.querySelectorAll("a.taxonomy--type"),function(e){e.addEventListener("mouseover",function(e){e.preventDefault();var t=e.currentTarget,n=document.getElementById("workDescription"),i=archiveWorkTerms[t.getAttribute("slug")].description;n.innerHTML=i})})}function d(){var e=t.detect(),n=document.querySelector(".gallery");if(null!==n)if(window.addEventListener("resize",function(){0==e.isMobile&&window.innerWidth<=770&&(n.classList.remove("gallery--animate"),n.hasAttribute("style")&&n.removeAttribute("style"),[].forEach.call(document.querySelectorAll(".gallery > *"),function(e,t,n){e.classList.remove("gallery__item--show"),e.hasAttribute("style")&&e.removeAttribute("style")}))}),0==e.isMobile&&window.innerWidth>=770){var i=0;n.classList.add("gallery--animate"),[].forEach.call(document.querySelectorAll(".gallery > *"),function(e){var t=e.offsetTop+e.clientHeight;t>i&&(i=t,n.style.height=i+"px")});var r={viewFactor:.15,distance:"0px",origin:"right",easing:"ease-in",delay:250,duration:750,scale:1,mobile:!1,beforeReveal:function(e){e.style.transform="",e.classList.add("gallery__item--show")}};window.sr=o(),setTimeout(function(){sr.reveal(".gallery > *",r)},2250)}else r={viewFactor:.15,distance:"50vw",origin:"right",easing:"ease-out",duration:500,scale:1},window.sr=o(),sr.reveal(".gallery > *",r)}return s.prototype={constructor:s,doAnimations:function(){this.html.classList.add("html--animation-loaded"),this.main.classList.add("main--fade"),this.header.classList.add("header--animation-loaded")},start:function(){setTimeout(this.doAnimations(),250),n(),d()}},s}),define("Core",["utils/util","utils/Device"],function(e,t){function n(){if(!(this instanceof n))throw new TypeError("Core constructor cannot be called as a function.")}return n.prototype={constructor:n,start:function(){this.device=t.detect(),console.log(this.device)}},n}),require(["utils/util","lib/mustard","utils/Events","App","Core"],function(e,t,n,i,o){var r,a=t.cuts_the_mustard(),s=document.getElementsByTagName("html");if(!0===a)n.domReady(function(){!0===("matches"in Element.prototype&&"classList"in Element.prototype&&e.supportSVG())?((new o).start(),(new i).start()):require(["lib/polyfills"],function(){var e=new e})});else for(r=0;r<s.length;r+=1)s[r].setAttribute("class","does-not-cut-the-mustard")}),define("/Users/admin/www/f3architects.co.uk/site/web/app/themes/f3-architects-theme/js/main.js",function(){});