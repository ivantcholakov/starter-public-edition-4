(function ($, window) {
	$.kladr = {};

	(function () {
		var protocol = window.location.protocol == 'https:' ? 'https:' : 'http:';

		/**
		 * URL сервиса
		 *
		 * @type {string}
		 */
		$.kladr.url = protocol + '//kladr-api.ru/api.php';
	})();

	/**
	 * Перечисление типов объектов
	 *
	 * @type {{region: string, district: string, city: string, street: string, building: string}}
	 */
	$.kladr.type = {
		region:   'region',   // Область
		district: 'district', // Район
		city:     'city',     // Город
		street:   'street',   // Улица
		building: 'building'  // Строение
	};

	/**
	 * Перечисление типов населённых пунктов
	 *
	 * @type {{city: number, settlement: number, village: number}}
	 */
	$.kladr.typeCode = {
		city:       1, // Город
		settlement: 2, // Посёлок
		village:    4  // Деревня
	};

	/**
	 * Проверяет корректность запроса
	 *
	 * @param {{}} query Запрос
	 * @returns {boolean}
	 */
	$.kladr.validate = function (query) {
		var type = $.kladr.type;

		switch (query.type) {
			case type.region:
			case type.district:
			case type.city:
				if (query.parentType && !query.parentId) {
					error('parentId undefined');
					return false;
				}
				break;
			case type.street:
				
				if (query.parentType != type.city && query.parentType != type.street) {
					error('parentType must equal "city" or "street"');
					return false;
				}
				if (!query.parentId) {
					error('parentId undefined');
					return false;
				}
				break;
			case type.building:
				if (!query.zip) {
					if (!~$.inArray(query.parentType, [type.street, type.city])) {
						error('parentType must equal "street" or "city"');
						return false;
					}
					if (!query.parentId) {
						error('parentId undefined');
						return false;
					}
				}
				break;
			default:
				if (!query.oneString) {
					error('type incorrect');
					return false;
				}
				break;
		}

		if (query.oneString && query.parentType && !query.parentId) {
			error('parentId undefined');
			return false;
		}

		if (query.typeCode && (query.type != type.city)) {
			error('type must equal "city"');
			return false;
		}

		if (query.limit < 1) {
			error('limit must greater than 0');
			return false;
		}

		return true;
	};

	/**
	 * Отправляет запрос к сервису
	 *
	 * @param {{}} query Запрос
	 * @param {Function} callback Функция, которой будет передан массив полученных объектов
	 */
	$.kladr.api = function (query, callback) {
		if (!callback) {
			error('Callback undefined');
			return;
		}

		if (!$.kladr.validate(query)) {
			callback([]);
			return;
		}

		var timeout = setTimeout(function () {
			callback([]);
			timeout = null;
		}, 3000);

        $.ajax({
            url: $.kladr.url + '?callback=?',
            type: 'get',
            data: toApiFormat(query),
            dataType: 'jsonp'
        }).done(function (data) {
            if (timeout) {
                callback(data.result || []);
                clearTimeout(timeout);
            }
        });
	};

	/**
	 * Проверяет существование объекта, соответствующего запросу
	 *
	 * @param {{}} query Запрос
	 * @param {Function} callback Функция, которой будет передан объект, если он существует, или
	 * false если не существует.
	 */
	$.kladr.check = function (query, callback) {
		if (!callback) {
			error('Callback undefined');
			return;
		}

		query.withParents = false;
		query.limit = 1;

		$.kladr.api(query, function (objs) {
			objs && objs.length
				? callback(objs[0])
				: callback(false);
		});
	};

	/**
	 * Преобразует запрос из формата принятого в плагине в формат сервиса
	 *
	 * @param {{}} query Запрос в формате плагина
	 * @returns {{}} Запрос в формате сервиса
	 */
	function toApiFormat(query) {
		var params = {},
			fields = {
				type:        'contentType',
				name:        'query',
				withParents: 'withParent'
			};

		if (query.parentType && query.parentId) {
			params[query.parentType + 'Id'] = query.parentId;
		}

		for (var key in query) {
			if (hasOwn(query, key) && query[key]) {
				params[hasOwn(fields, key) ? fields[key] : key] = query[key];
			}
		}

		return params;
	}

	/**
	 * Проверяет принадлежит ли объекту свойство
	 *
	 * @param {{}} obj Объект
	 * @param {string} property Свойство
	 * @returns {boolean}
	 */
	function hasOwn(obj, property) {
		return obj.hasOwnProperty(property);
	}

	/**
	 * Выводит ошибку на консоль
	 *
	 * @param {string} error Текст ошибки
	 */
	function error(error) {
		var console = window.console;

		console && console.error && console.error(error);
	}
})(jQuery, window);