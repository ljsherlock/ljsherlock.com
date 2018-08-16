/**
* @module Device
*
* @desc Device related methods
*/

define(['utils/util', 'lib/appConfig'], function( Util, appConfig )
{
    return {

				/**
				* @method detectDevice
				*
 				* @desc Detect device type by user agent or browser window width
				*
				* @returns {boolean}
				*/
				detect: function () {
						var browserString = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i;

						//if user on mobile or small browser width
						if (/Android|webOS|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) || window.innerWidth <= appConfig.mobileWidthMax) {
							return {
										isMobile: true,
										isTablet: false,
										isDesktop: false
								}
						}
						else if(/Android|webOS|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) || window.innerWidth <= appConfig.tabletWidthMax){
								return {
										isTablet : true,
										isMobile : false,
										isDesktop : false
								}
						} else {
								return {
										isTablet : false,
										isMobile : false,
										isDesktop : true
								}
						}
				},

				/**
				* @method isRetinaDevice
				*
 				* @desc Detect retina device
				*
				* @returns {boolean}
				*/
				isRetina: function () {
						if (('devicePixelRatio' in window && window.devicePixelRatio >= 1.5) ||
								('matchMedia' in window && window.matchMedia("(-webkit-min-device-pixel-ratio: 1.5), (min--moz-device-pixel-ratio: 1.5), (-o-min-device-pixel-ratio: 3/2), (min-resolution: 1.5dppx)").matches)) {
								return true;
						} else {
								return false;
						}
				},

				detectIE : function () {
					var ua = window.navigator.userAgent;

					// Test values; Uncomment to check result …

					// IE 10
					// ua = 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.2; Trident/6.0)';

					// IE 11
					// ua = 'Mozilla/5.0 (Windows NT 6.3; Trident/7.0; rv:11.0) like Gecko';

					// Edge 12 (Spartan)
					// ua = 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.71 Safari/537.36 Edge/12.0';

					// Edge 13
					// ua = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2486.0 Safari/537.36 Edge/13.10586';

					var msie = ua.indexOf('MSIE ');
					if (msie > 0) {
						// IE 10 or older => return version number
						return parseInt(ua.substring(msie + 5, ua.indexOf('.', msie)), 10);
					}

					var trident = ua.indexOf('Trident/');
					if (trident > 0) {
						// IE 11 => return version number
						var rv = ua.indexOf('rv:');
						return parseInt(ua.substring(rv + 3, ua.indexOf('.', rv)), 10);
					}

					var edge = ua.indexOf('Edge/');
					if (edge > 0) {
						// Edge (IE 12+) => return version number
						return parseInt(ua.substring(edge + 5, ua.indexOf('.', edge)), 10);
					}

					// other browser
					return false;
			},
		}
});
