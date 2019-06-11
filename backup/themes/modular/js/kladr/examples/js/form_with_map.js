$(function () {
	var $region = $('[name="region"]'),
		$district = $('[name="district"]'),
		$city = $('[name="city"]'),
		$street = $('[name="street"]'),
		$building = $('[name="building"]');

	var map = null,
		map_created = false;

	$.kladr.setDefault({
		parentInput: '.js-form-address',
		verify: true,
		labelFormat: function (obj, query) {
			var label = '';

			var name = obj.name.toLowerCase();
			query = query.name.toLowerCase();

			var start = name.indexOf(query);
			start = start > 0 ? start : 0;

			if (obj.typeShort) {
				label += obj.typeShort + '. ';
			}

			if (query.length < obj.name.length) {
				label += obj.name.substr(0, start);
				label += '<strong>' + obj.name.substr(start, query.length) + '</strong>';
				label += obj.name.substr(start + query.length, obj.name.length - query.length - start);
			} else {
				label += '<strong>' + obj.name + '</strong>';
			}

			if (obj.parents) {
				for (var k = obj.parents.length - 1; k > -1; k--) {
					var parent = obj.parents[k];
					if (parent.name) {
						if (label) label += '<small>, </small>';
						label += '<small>' + parent.name + ' ' + parent.typeShort + '.</small>';
					}
				}
			}

			return label;
		},
		change: function (obj) {
			if (obj) {
				setLabel($(this), obj.type);
			}

			log(obj);
			addressUpdate();
			mapUpdate();
		},
		checkBefore: function () {
			var $input = $(this);

			if (!$.trim($input.val())) {
				log(null);
				addressUpdate();
				mapUpdate();
				return false;
			}
		}
	});

	$region.kladr('type', $.kladr.type.region);
	$district.kladr('type', $.kladr.type.district);
	$city.kladr('type', $.kladr.type.city);
	$street.kladr('type', $.kladr.type.street);
	$building.kladr('type', $.kladr.type.building);

	// Включаем получение родительских объектов для населённых пунктов
	$city.kladr('withParents', true);
	$street.kladr('withParents', true);

	// Отключаем проверку введённых данных для строений
	$building.kladr('verify', false);

	ymaps.ready(function () {
		if (map_created) return;
		map_created = true;

		map = new ymaps.Map('map', {
			center: [55.76, 37.64],
			zoom: 12,
			controls: []
		});

		map.controls.add('zoomControl', {
			position: {
				right: 10,
				top: 10
			}
		});
	});

	function setLabel($input, text) {
		text = text.charAt(0).toUpperCase() + text.substr(1).toLowerCase();
		$input.parent().find('label').text(text);
	}

	function mapUpdate() {
		var zoom = 4;

		var address = $.kladr.getAddress('.js-form-address', function (objs) {
			var result = '';

			$.each(objs, function (i, obj) {
				var name = '',
					type = '';

				if ($.type(obj) === 'object') {
					name = obj.name;
					type = ' ' + obj.type;

					switch (obj.contentType) {
						case $.kladr.type.region:
							zoom = 4;
							break;

						case $.kladr.type.district:
							zoom = 7;
							break;

						case $.kladr.type.city:
							zoom = 10;
							break;

						case $.kladr.type.street:
							zoom = 13;
							break;

						case $.kladr.type.building:
							zoom = 16;
							break;
					}
				}
				else {
					name = obj;
				}

				if (result) result += ', ';
				result += type + name;
			});

			return result;
		});

		if (address && map_created) {
			var geocode = ymaps.geocode(address);
			geocode.then(function (res) {
				map.geoObjects.each(function (geoObject) {
					map.geoObjects.remove(geoObject);
				});

				var position = res.geoObjects.get(0).geometry.getCoordinates(),
					placemark = new ymaps.Placemark(position, {}, {});

				map.geoObjects.add(placemark);
				map.setCenter(position, zoom);
			});
		}
	}

	function addressUpdate() {
		var address = $.kladr.getAddress('.js-form-address');

		$('#address').text(address);
	}

	function log(obj) {
		var $log, i;

		$('.js-log li').hide();

		for (i in obj) {
			$log = $('#' + i);

			if ($log.length) {
				$log.find('.value').text(obj[i]);
				$log.show();
			}
		}
	}
});