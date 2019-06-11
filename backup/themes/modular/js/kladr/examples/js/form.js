$(function () {
	var $zip = $('[name="zip"]'),
		$region = $('[name="region"]'),
		$district = $('[name="district"]'),
		$city = $('[name="city"]'),
		$street = $('[name="street"]'),
		$building = $('[name="building"]');

	var $tooltip = $('.tooltip');

	$.kladr.setDefault({
		parentInput: '.js-form-address',
		verify: true,
		select: function (obj) {
			setLabel($(this), obj.type);
			$tooltip.hide();
		},
		check: function (obj) {
			var $input = $(this);

			if (obj) {
				setLabel($input, obj.type);
				$tooltip.hide();
			}
			else {
				showError($input, 'Введено неверно');
			}
		},
		checkBefore: function () {
			var $input = $(this);

			if (!$.trim($input.val())) {
				$tooltip.hide();
				return false;
			}
		}
	});

	$region.kladr('type', $.kladr.type.region);
	$district.kladr('type', $.kladr.type.district);
	$city.kladr('type', $.kladr.type.city);
	$street.kladr('type', $.kladr.type.street);
	$building.kladr('type', $.kladr.type.building);

	// Отключаем проверку введённых данных для строений
	$building.kladr('verify', false);

	// Подключаем плагин для почтового индекса
	$zip.kladrZip();

	function setLabel($input, text) {
		text = text.charAt(0).toUpperCase() + text.substr(1).toLowerCase();
		$input.parent().find('label').text(text);
	}

	function showError($input, message) {
		$tooltip.find('span').text(message);

		var inputOffset = $input.offset(),
			inputWidth = $input.outerWidth(),
			inputHeight = $input.outerHeight();

		var tooltipHeight = $tooltip.outerHeight();

		$tooltip.css({
			left: (inputOffset.left + inputWidth + 10) + 'px',
			top: (inputOffset.top + (inputHeight - tooltipHeight) / 2 - 1) + 'px'
		});

		$tooltip.show();
	}
});