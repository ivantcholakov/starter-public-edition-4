$(function () {
	var $city = $('[name="city"]'),
		$typeCode = $('[name="typecode"]');

	$city.kladr({
		type: $.kladr.type.city
	});

	$typeCode.change(function () {
		changeTypeCode($(this).val());
	});

	changeTypeCode($('[name="typecode"]:checked').val());

	function changeTypeCode(value) {
		var typeCode = null;

		switch (value) {
			case 'city':
				typeCode = $.kladr.typeCode.city;
				break;

			case 'settlement':
				typeCode = $.kladr.typeCode.city + $.kladr.typeCode.settlement;
				break;

			case 'all':
				typeCode = $.kladr.typeCode.city + $.kladr.typeCode.settlement + $.kladr.typeCode.village;
				break;
		}

		$city.kladr('typeCode', typeCode);
	}
});