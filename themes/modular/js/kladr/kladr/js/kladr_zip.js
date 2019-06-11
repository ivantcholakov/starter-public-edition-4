(function ($) {
	$.fn.kladrZip = function (selector) {
		this.keydown(function (e) {
			var key = e.charCode || e.keyCode || 0,
				allow = (
					key == 8 ||
					key == 9 ||
					key == 13 ||
					key == 46 ||
					key == 110 ||
					key == 190 ||
					(key >= 35 && key <= 40) ||
					(key >= 96 && key <= 105)
				);

			if ($(this).val().length >= 6) {
				return allow;
			}

			return (allow || (key >= 48 && key <= 57));
		});

		this.keyup(function () {
			var $this = $(this),
				zip = $this.val();

			if (!zip) {
				error(false);
				return;
			}

			$.kladr.api({
				type: $.kladr.type.building,
				zip: zip,
				withParents: true,
				limit: 1
			}, function (objs) {
				var obj = objs.length && objs[0];
				objs = [];

				if (obj) {
					error(false);

					if (obj.parents) {
						objs = objs.concat(obj.parents);
					}

					objs.push(obj);
					$.kladr.setValues(objs, selector);
				}
				else {
					error(true);
				}
			});

			function error(er) {
				er ? $this.addClass('kladr-error') : $this.removeClass('kladr-error');
			}
		});

		return this;
	};
})(jQuery);