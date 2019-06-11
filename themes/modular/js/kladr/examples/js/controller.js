$(function () {
	var $city = $('[name="city"]');

	$city.kladr({
		type: $.kladr.type.city
	});

	$('[name="city_id"]').change(function () {
		var id = $(this).val();

		// Устанавливаем значение поля ввода по id
		$city.kladr('controller').setValueById(id);
	});
});