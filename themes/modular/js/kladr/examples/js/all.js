$(function () {
	// Simple example
	(function () {
		var $container = $(document.getElementById('simple'));

		$container
			.find('[name="city"]')
			.kladr({
				type: $.kladr.type.city
			});
	})();

	// One string example
	(function () {
		var $container = $(document.getElementById('one_string'));

		var $address = $container.find('[name="address"]'),
			$parent = $container.find('[name="parent"]');

		$address.kladr({
			oneString: true,
			change: function (obj) {
				log(obj);
			}
		});

		$parent.change(function () {
			changeParent($(this).val());
		});

		changeParent($container.find('[name="parent"]:checked').val());

		function changeParent(value) {
			var parentType = null,
				parentId = null;

			switch (value) {
				case 'moscow':
					parentType = $.kladr.type.region;
					parentId = '7700000000000';
					break;

				case 'petersburg':
					parentType = $.kladr.type.region;
					parentId = '7800000000000';
					break;
			}

			$address.kladr({
				parentType: parentType,
				parentId: parentId
			});
		}

		function log(obj) {
			var $log, i;

			$container.find('.js-log li').hide();

			for (i in obj) {
				$log = $container.find('[data-prop="' + i + '"]');

				if ($log.length) {
					$log.find('.value').text(obj[i]);
					$log.show();
				}
			}
		}
	})();

	// Type code example
	(function () {
		var $container = $(document.getElementById('type_code'));

		var $city = $container.find('[name="city"]'),
			$typeCode = $container.find('[name="typecode"]');

		$city.kladr({
			type: $.kladr.type.city
		});

		$typeCode.change(function () {
			changeTypeCode($(this).val());
		});

		changeTypeCode($container.find('[name="typecode"]:checked').val());

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
	})();

	// Form example
	(function () {
		var $container = $(document.getElementById('form'));

		var $zip = $container.find('[name="zip"]'),
			$region = $container.find('[name="region"]'),
			$district = $container.find('[name="district"]'),
			$city = $container.find('[name="city"]'),
			$street = $container.find('[name="street"]'),
			$building = $container.find('[name="building"]');

		var $tooltip = $container.find('.tooltip');

		$()
			.add($region)
			.add($district)
			.add($city)
			.add($street)
			.add($building)
			.kladr({
				parentInput: $container.find('.js-form-address'),
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
		$zip.kladrZip($container);

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
	})();

	// Form with map example
	(function () {
		var $container = $(document.getElementById('form_with_map'));

		var $region = $container.find('[name="region"]'),
			$district = $container.find('[name="district"]'),
			$city = $container.find('[name="city"]'),
			$street = $container.find('[name="street"]'),
			$building = $container.find('[name="building"]');

		var map = null,
			map_created = false;

		$()
			.add($region)
			.add($district)
			.add($city)
			.add($street)
			.add($building)
			.kladr({
				parentInput: $container.find('.js-form-address'),
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

		$street.kladr({
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
							if (parent.name && parent.contentType == 'city') {
								if (label) label += '<small>, </small>';
								label += '<small>' + parent.typeShort + '. ' + parent.name + '</small>';
							}
						}
					}

					return label;
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
			var address = $.kladr.getAddress($container.find('.js-form-address'));

			$container.find('#address').text(address);
		}

		function log(obj) {
			var $log, i;

			$container.find('.js-log li').hide();

			for (i in obj) {
				$log = $container.find('[data-prop="' + i + '"]');

				if ($log.length) {
					$log.find('.value').text(obj[i]);
					$log.show();
				}
			}
		}
	})();
});
