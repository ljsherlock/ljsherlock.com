
// methods called in order of importance
// methods ordered by name
define(['utils/util', 'utils/Device'], function (Util, Device) {

		// declaring strict mode
		"use strict";

		function Core () {
			if (!(this instanceof Core)) {
					throw new TypeError("Core constructor cannot be called as a function.");
			}
		}

		Core.prototype = {

			constructor: Core,

			start: function () {
					this.device = Device.detect();
					console.log(this.device);
			}

		};

		return Core;
});
