(function ($, window, document, undefined) {

	/**
	 * Список значений параметров плагина по умолчанию
	 *
	 * @type {{token: null, key: null, type: null, typeCode: null, parentType: null, parentId: null, limit: number, oneString: boolean, withParents: boolean, parentInput: null, verify: boolean, spinner: boolean, open: null, close: null, send: null, receive: null, select: null, check: null, change: null, openBefore: null, closeBefore: null, sendBefore: null, selectBefore: null, checkBefore: null, source: Function, labelFormat: Function, valueFormat: Function, showSpinner: Function, hideSpinner: Function}}
	 */
	var defaultOptions = {

		token: null,        // Токен для доступа к сервису
		key: null,          // Ключ для доступа к сервису
		type: null,         // Тип подставляемых объектов
		typeCode: null,     // Тип подставляемых населённых пунктов
		parentType: null,   // Тип родительского объекта
		parentId: null,     // Идентификатор родительского объекта
		limit: 10,          // Количество отображаемых в выпадающем списке объектов
		oneString: false,   // Включить ввод адреса одной строкой
		withParents: false, // Получить объекты вместе с родительскими
		noResultText: null, // Текст для показа в выпадающем списке в случае отсутствия результатов поиска
		checkEmptyRespone: false, // Текст для показа в выпадающем списке в случае отсутствия результатов поиска
		strict: null,  // Включает строгий режим поиска для городов. Если не указан district, то поиск по домам у которых нет district

		parentInput: null, // Селектор для поиска родительских полей ввода
		verify: false,     // Проверять введённые данные
		spinner: true,     // Отображать ajax-крутилку

		open: null,    // Открыт выпадающий список объектов
		close: null,   // Закрыт выпадающий список объектов
		send: null,    // Отправлен запрос к сервису
		receive: null, // Получен ответ от сервиса
		select: null,  // Выбран объект в выпадающем списке
		check: null,   // Проверен введённый пользователем объект
		change: null,  // Изменился объект в поле ввода

		openBefore: null,   // Вызывается перед открытием выпадающего списка
		closeBefore: null,  // Вызывается перед закрытием выпадающего списка
		sendBefore: null,   // Вызывается перед отправкой запроса сервису
		selectBefore: null, // Вызывается перед выбором объекта в списке
		checkBefore: null,  // Вызывается перед проверкой введённого пользователем объекта

		/**
		 * Отправляет запрос сервису
		 *
		 * @param {{}} query
		 * @param {Function} callback
		 */
		source: function (query, callback) {
			$.kladr.api(query, callback);
		},

		/**
		 * Форматирует подписи для объектов в списке
		 *
		 * @param {{}} obj Объект КЛАДР
		 * @param {{}} query Запрос, по которому получен объект
		 * @returns {string}
		 */
		labelFormat: function (obj, query) {
			var objs;

			if (query.oneString) {
				if (obj.parents) {
					objs = [].concat(obj.parents);
					objs.push(obj);

					return $.kladr.buildAddress(objs);
				}

				return (obj.typeShort ? obj.typeShort + '. ' : '') + obj.name;
			}

			var label = '',
				name,
				objName,
				queryName,
				start;

			if (obj.typeShort) {
				label += obj.typeShort + '. ';
			}

			name = obj.name;
			objName = name.toLowerCase();
			queryName = query.name.toLowerCase();
			start = objName.indexOf(queryName);
			start = ~start ? start : 0;

			if (queryName.length < objName.length) {
				label += name.substr(0, start);
				label += '<strong>';
				label += name.substr(start, queryName.length);
				label += '</strong>';
				label += name.substr(start + queryName.length);
			} else {
				label += '<strong>' + name + '</strong>';
			}

			return label;
		},

		/**
		 * Форматирует подставляемое в поле ввода значение
		 *
		 * @param {{}} obj Объект КЛАДР
		 * @param {{}} query Запрос, по которому получен объект
		 * @returns {string}
		 */
		valueFormat: function (obj, query) {
			var objs;

			if (query.oneString) {
				if (obj.parents) {
					objs = [].concat(obj.parents);
					objs.push(obj);

					return $.kladr.buildAddress(objs);
				}

				return (obj.typeShort ? obj.typeShort + '. ' : '') + obj.name;
			}

			return obj.name;
		},

		/**
		 * Выводит ajax-крутилку
		 *
		 * @param {{}} $spinner jQuery объект ajax-крутилки
		 */
		showSpinner: function ($spinner) {
			var top = -0.2,
				spinnerInterval = setInterval(function () {
					if (!$spinner.is(':visible')) {
						clearInterval(spinnerInterval);
						spinnerInterval = null;
						return;
					}

					$spinner.css('background-position', '0% ' + top + '%');

					top += 5.555556;

					if (top > 95) {
						top = -0.2;
					}
				}, 30);

			$spinner.show();
		},

		/**
		 * Скрывает ajax-крутилку
		 *
		 * @param {{}} $spinner jQuery объект ajax-крутилки
		 */
		hideSpinner: function ($spinner) {
			$spinner.hide();
		}
	};

	/**
	 * Параметры только для чтения
	 *
	 * @type {{current: null, controller: null}}
	 */
	var readOnlyParams = {
		current: null,   // Текущий, выбранный объект КЛАДР
		controller: null // Контроллер для управления плагином
	};

	/**
	 * Коды отслеживаемых плагином клавиш
	 *
	 * @type {{up: number, down: number, enter: number}}
	 */
	var keys = {
		up: 38,
		down: 40,
		enter: 13
	};

	$.kladr = $.extend($.kladr, {

		/**
		 * Устанавливает значения по умолчанию для параметров плагина
		 *
		 * @param {{}|string} param1
		 * @param {*} param2
		 */
		setDefault: function (param1, param2) {
			var params = readParams(param1, param2);

			if (params.obj) {
				for (var i in params.obj) {
					if (hasOwn(defaultOptions, i)) {
						defaultOptions[i] = params.obj[i];
					}
				}
			}
			else if (params.str && !params.isGet && hasOwn(defaultOptions, params.str[0])) {
				defaultOptions[params.str[0]] = params.str[1];
			}
		},

		/**
		 * Возвращает значение по умолчанию для параметра плагина
		 *
		 * @param {string} param
		 * @returns {*}
		 */
		getDefault: function (param) {
			if (hasOwn(defaultOptions, param)) {
				return defaultOptions[param];
			}
		},

		/**
		 * Возращает jQuery коллекцию полей ввода,
		 * к которым был подключен плагин
		 *
		 * @param {*} selector Селектор, DOM элемент или jQuery объект, ограничивающий поиск полей ввода
		 * @returns {{}} jQuery коллекция полей ввода
		 */
		getInputs: function (selector) {
			var $source = $(selector || document.body),
				inputSelector = '[data-kladr-type]';

			return $source
				.filter(inputSelector)
				.add($source.find(inputSelector));
		},

		/**
		 * Устанавливает значения для полей, к которым
		 * был подключен плагин
		 *
		 * @param {{}|[]} values Список значений
		 * @param {*} selector Селектор, ограничивающий поиск полей ввода
		 */
		setValues: function (values, selector) {
			var changeEvent = 'kladr_change.setvalues',
				types = $.kladr.type,
				filtered = {},
				sorted = {},
				$inputs, t;

			if (!~$.inArray($.type(values), ['object', 'array'])) {
				return;
			}

			$.each(values, function (key, value) {
				if (!value) {
					return;
				}

				var type = value.contentType || value.type || key;

				if (hasOwn(types, type)) {
					filtered[type] = value;
				}
			});

			for (t in types) {
				if (hasOwn(types, t) && filtered[t]) {
					sorted[t] = filtered[t];
				}
			}

			$inputs = $.kladr.getInputs(selector);

			(function set() {
				var $input, type, value;

				for (type in sorted) {
					if (hasOwn(sorted, type)) {
						value = sorted[type];
						delete sorted[type];
						break;
					}
				}

				if (!type) {
					return;
				}

				$input = $inputs.filter('[data-kladr-type="' + type + '"]');

				if (!$input.length) {
					set();
					return;
				}

				$input
					.on(changeEvent, function () {
						$input.off(changeEvent);
						set();
					})
					.kladr('controller')
					.setValue(value);
			})();
		},

		/**
		 * Возвращает собранную на основании полей ввода строку адреса
		 *
		 * @param {*} selector Селектор, ограничивающий поиск полей ввода
		 * @param {Function} build Функция, строящая строку адреса из списка объектов КЛАДР
		 * @returns {string}
		 */
		getAddress: function (selector, build) {
			var $inputs = $.kladr.getInputs(selector),
				types = $.kladr.type,
				filtered = {},
				sorted = {},
				t;

			$inputs.each(function () {
				var $this = $(this),
					obj, objs, i;

				if ($this.attr('data-kladr-id')) {
					obj = $this.kladr('current');

					if ($this.attr('data-kladr-one-string') && obj.parents) {
						objs = [].concat(obj.parents);
						objs.push(obj);

						for (i = 0; i < objs.length; i++) {
							filtered[objs[i].contentType] = objs[i];
						}
					}
					else {
						filtered[$this.attr('data-kladr-type')] = obj;
					}
				}
				else {
					filtered[$this.attr('data-kladr-type')] = $this.val();
				}
			});

			for (t in types) {
				if (hasOwn(types, t) && filtered[t]) {
					sorted[t] = filtered[t];
				}
			}

			return (build || $.kladr.buildAddress)(sorted);
		},

		/**
		 * Строит строку адреса на основании списка объектов КЛАДР
		 *
		 * @param {{}|[]} objs Список объектов КЛАДР
		 * @returns {string}
		 */
		buildAddress: function (objs) {
			var lastIds = [],
				address = '',
				zip = '';

			$.each(objs, function (i, obj) {
				var name = '',
					type = '',
					j;

				if ($.type(obj) === 'object') {
					for (j = 0; j < lastIds.length; j++) {
						if (lastIds[j] == obj.id) {
							return;
						}
					}

					lastIds.push(obj.id);

					name = obj.name;
					type = obj.typeShort + '. ';
					zip = obj.zip || zip;
				}
				else {
					name = obj;
				}

				if (address) address += ', ';
				address += type + name;
			});

			address = (zip ? zip + ', ' : '') + address;

			return address;
		}
	});

	$.fn.kladr = function (param1, param2) {
		var params = readParams(param1, param2),
			result = null;

		this.each(function () {
			var res = kladr($(this), params);

			if (params.isGet) {
				result = res;
				return false;
			}
		});

		if (params.isGet) {
			return result;
		}

		return this;
	};

	/**
	 * Подключает плагин к полю ввода
	 *
	 * @param {{}} $input jQuery объект поля ввода
	 * @param {{}} params Объект параметров
	 * @returns {*}
	 */
	function kladr($input, params) {

		/**
		 * Хранилище параметров плагина
		 *
		 * @type {{}}
		 */
		var options = (function () {
			var dataKey = 'kladr-data',
				data = $input.data(dataKey);

			if (!data) {
				data = $.extend({}, defaultOptions, readOnlyParams);
				$input.data(dataKey, data);
			}

			return {

				/**
				 * Устанавливает значение публичному параметру плагина
				 *
				 * @param {{}} params
				 */
				set: function (params) {
					if (params.obj) {
						for (var i in params.obj) {
							if (hasOwn(params.obj, i) && hasOwn(defaultOptions, i)) {
								data[i] = params.obj[i];
							}
						}
					}
					else if (params.str && !params.isGet && hasOwn(defaultOptions, params.str[0])) {
						data[params.str[0]] = params.str[1];
					}

					$input.data(dataKey, data);
				},

				/**
				 * Возвращает значение публичного параметра плагина
				 *
				 * @param {string} param
				 * @returns {*}
				 */
				get: function (param) {
					if (hasOwn(defaultOptions, param) || hasOwn(readOnlyParams, param)) {
						return data[param];
					}
				},

				/**
				 * Устанавливает значение параметра плагина
				 *
				 * @param {string} param
				 * @param {*} value
				 * @private
				 */
				_set: function (param, value) {
					data[param] = value;
					$input.data(dataKey, data);
				},

				/**
				 * Возвращает значение параметра плагина
				 *
				 * @param {string} param
				 * @returns {*}
				 * @private
				 */
				_get: function (param) {
					if (hasOwn(data, param)) {
						return data[param];
					}
				}
			};
		})();

		/**
		 * Инициализирует плагин
		 *
		 * @param {{}} params Объект параметров
		 * @param {Function} callback Функция, выполняемая после инициализации
		 * @returns {*}
		 */
		function init(params, callback) {
			if (params.isGet) {
				return options.get(params.str[0]);
			}

			options.set(params);
			callback();
		}

		return init(params, function () {
			var $ac = null, // jQuery объект выпадающего списка
				$spinner = null, // jQuery объект ajax-крутилки
				successSearch = false, // Состояние последнего запроса
				eventNamespace = '.kladr', // Пространство имён событий, на которые подписывается плагин
				triggerChangeFlag = 'kladrInputChange'; // Флаг, включающий эмуляцию события change для поля ввода

			create(function () {
				var isActive = false,   // Поле ввода активно
					canCheck = true,    // Поле ввода можно проверить
					lastChangeVal = ''; // Значение поля ввода при последнем событии change

				$input
					.attr('data-kladr-type', get('type') || '')
					.attr('data-kladr-one-string', get('oneString') || null)
					.on('keyup' + eventNamespace, open)
					.on('keydown' + eventNamespace, keySelect)
					.on('blur' + eventNamespace, function () {
						if (!isActive && $input.data(triggerChangeFlag) && (lastChangeVal != $input.val())) {
							$input.change();
						}
					})
					.on('blur' + eventNamespace + ' change' + eventNamespace, function (event) {
						if (isActive) return;

						if (event.type == 'change') {
							lastChangeVal = $input.val();
						}

						if (canCheck) {
							canCheck = false;
							check();
						}
						if(!successSearch && defaultOptions.checkEmptyRespone) { // Если запрос был неуспешных, т.е. не вернулись данные с сервера, то очищаем input  c вводом
							$input.val('');
						}
						close();
						return false;
					})
					.on('focus' + eventNamespace, function () {
						canCheck = true;
					});

				$ac
					.on('touchstart' + eventNamespace + ' mousedown' + eventNamespace, 'li, a', function (event) {
						event.preventDefault();

						isActive = true;
						mouseSelect(this);
						isActive = false;
					});

				$(window)
					.on('resize' + eventNamespace, position);
			});

			/**
			 * Создаёт DOM элементы плагина
			 *
			 * @param {Function} callback
			 */
			function create(callback) {
				var $container = $(document.getElementById('kladr_autocomplete'));

				if (!$container.length) {
					$container = $('<div id="kladr_autocomplete"></div>').appendTo(document.body);
				}

				var guid = get('guid');

				if (guid) {
					$ac = $container.find('.autocomplete' + guid);
					$spinner = $container.find('.spinner' + guid);

					$(window).off(eventNamespace);
					$input.off(eventNamespace);
					$ac.off(eventNamespace);
				}
				else {
					guid = getGuid();
					set('guid', guid);

					$input.attr('autocomplete', 'off');

					$ac = $('<ul class="autocomplete' + guid + ' autocomplete" style="display: none;"></ul>')
						.appendTo($container);

					$spinner = $('<div class="spinner' + guid + ' spinner" style="display: none;"></div>')
						.appendTo($container);

					createController();

					position();
					checkAutoFill();
				}

				callback();
			}

			/**
			 * Заполняет выпадающий список
			 *
			 * @param {[]} objs Массив объектов КЛАДР
			 * @param {{}} query Объект запроса к сервису
			 */
			function render(objs, query) {
				var obj, value, label, $a;

				$ac.empty();

				for (var i = 0; i < objs.length; i++) {
					obj = objs[i];
					value = get('valueFormat')(obj, query);
					label = get('labelFormat')(obj, query);

					$a = $('<a data-val="' + value + '">' + label + '</a>');
					$a.data('kladr-object', obj);

					$('<li></li>')
						.append($a)
						.appendTo($ac);
				}
			}

			/**
			 * Заполняет выпадающий список сообщением о пустом запросе
			 *
			 */
			function renderEmpty() {
				var obj, value, label, $a;
				$ac.empty();
				value = '';
				label = defaultOptions.noResultText;
				if(label == null || label == '')
					return;
				$a = $('<a data-val="' + value + '">' + label + '</a>');
				$a.data('kladr-object', {});

				$('<li></li>')
					.append($a)
					.appendTo($ac);
			}



			/**
			 * Позиционирует выпадающий список на странице
			 */
			function position() {
				var inputOffset = $input.offset(),
					inputWidth = $input.outerWidth(),
					inputHeight = $input.outerHeight();

				if (!inputOffset) {
					return;
				}

				if ((position.top == inputOffset.top)
					&& (position.left == inputOffset.left)
					&& (position.width == inputWidth)
					&& (position.height == inputHeight)) {
					return;
				}

				position.top = inputOffset.top;
				position.left = inputOffset.left;
				position.width = inputWidth;
				position.height = inputHeight;

				$ac.css({
					top: inputOffset.top + inputHeight + 'px',
					left: inputOffset.left
				});

				var differ = $ac.outerWidth() - $ac.width();
				$ac.width(inputWidth - differ);

				var spinnerWidth = $spinner.width(),
					spinnerHeight = $spinner.height();

				$spinner.css({
					top: inputOffset.top + (inputHeight - spinnerHeight) / 2 - 1,
					left: inputOffset.left + inputWidth - spinnerWidth - 2
				});
			}

			/**
			 * Открывает выпадающий список
			 *
			 * @param {{}} event jQuery объект события
			 */
			function open(event) {
				// return on control keys
				if ((event.which > 8) && (event.which < 46)) {
					return;
				}

				$input.data(triggerChangeFlag, false);

				if (!trigger('open_before')) {
					close();
					return;
				}

				setCurrent(null);

				var name = $input.val();

				if (!$.trim(name)) {
					error(false);
					close();
					return;
				}

				var query = getQuery(name);

				if (!trigger('send_before', query)) {
					close();
					return;
				}

				showSpinner();
				trigger('send');

				get('source')(query, function (objs) {
					trigger('receive', objs);

					if (!$input.is(':focus')) {
						hideSpinner();
						close();
						return;
					}

					if (!$.trim($input.val()) || !objs.length) {
						hideSpinner();
						setCurrent(null);
						renderEmpty();
						position();
						$ac.slideDown(50);
						trigger('open');
						successSearch = false;
						return;
					}
					successSearch = true;
					render(objs, query);
					position();
					hideSpinner();

					$ac.slideDown(50);
					trigger('open');
				});
			}

			/**
			 * Закрывает выпадающий список
			 */
			function close() {
				if (!trigger('close_before')) {
					return;
				}

				$ac.empty().hide();
				trigger('close');
			}

			/**
			 * Осуществляет активацию и выбор элемента выпадающего списка с клавиатуры
			 *
			 * @param {{}} event jQuery объект события
 			 */
			function keySelect(event) {
				var $active = $ac.find('li.active');

				switch (event.which) {
					case keys.up:
						if ($active.length) {
							$active.removeClass('active');
							if ($active.prev().length) $active = $active.prev();
						} else {
							$active = $ac.find('li').last();
						}

						(function () {
							var acScroll = $ac.scrollTop(),
								acOffset = $ac.offset(),
								activeHeight = $active.outerHeight(),
								activeOffset = $active.offset();

							if ((activeOffset.top - acOffset.top) < 0) {
								$ac.scrollTop(acScroll - activeHeight);
							}
						})();

						$active.addClass('active');
						select();
						break;

					case keys.down:
						if ($active.length) {
							$active.removeClass('active');
							if ($active.next().length) $active = $active.next();
						} else {
							$active = $ac.find('li').first();
						}

						if($active.length){
                                                    (function () {
							var acScroll = $ac.scrollTop(),
								acHeight = $ac.height(),
								acOffset = $ac.offset(),
								activeHeight = $active.outerHeight(),
								activeOffset = $active.offset();

							if ((activeOffset.top - acOffset.top + activeHeight) > acHeight) {
								$ac.scrollTop(acScroll + activeHeight);
							}
						    })();
                                                }

						$active.addClass('active');
						select();
						break;

					case keys.enter:
						close();
						break;
				}
			}

			/**
			 * Осуществляет активацию и выбор элемента выпадающего списка мышью
			 *
			 * @param {{}} element DOM элемент, который необходимо выбрать
			 */
			function mouseSelect(element) {
				var $li = $(element);

				if ($li.is('a')) {
					$li = $li.parents('li');
				}

				$li.addClass('active');

				select();
				close();
			}

			/**
			 * Осуществляет выбор активного элемента выпадающего списка
			 */
			function select() {
				if (!trigger('select_before')) {
					return;
				}

				var $a = $ac.find('.active a');
				if (!$a.length) {
					return;
				}

				$input
					.val($a.attr('data-val'))
					.data(triggerChangeFlag, true);

				error(false);
				setCurrent($a.data('kladr-object'));
				trigger('select', get('current'));
			}

			/**
			 * Проверяет введённое пользователем значение в поле ввода
			 */
			function check() {
				if (!get('verify')) {
					return;
				}

				if (!trigger('check_before')) {
					return;
				}

				var name = $.trim($input.val());

				if (!name) {
					ret(null, false);
					return;
				}

				if (get('current')) {
					error(false);
					return;
				}

				var query = getQuery(name);

				query.withParents = false;
				query.limit = 10;

				if (!trigger('send_before', query)) {
					ret(null, false);
					trigger('check', null);
					return;
				}

				showSpinner();
				trigger('send');

				get('source')(query, function (objs) {
					trigger('receive');

					if (!$.trim($input.val())) {
						ret2(null, false);
						return;
					}

					var nameLowerCase = query.name.toLowerCase(),
						valueLowerCase = null,
						obj = null;

					for (var i = 0; i < objs.length; i++) {
						valueLowerCase = objs[i].name.toLowerCase();

						if (nameLowerCase == valueLowerCase) {
							obj = objs[i];
							break;
						}
					}

					if (obj) {
						$input.val(get('valueFormat')(obj, query));
					}

					ret2(obj, !obj);
					trigger('check', obj);

					function ret2(obj, er) {
						hideSpinner();
						ret(obj, er);
					}
				});

				function ret(obj, er) {
					error(er);
					setCurrent(obj);
				}
			}

			/**
			 * Создаёт контроллер плагина
			 */
			function createController() {
				var controller = {

					/**
					 * Устанавливает значение в поле ввода
					 *
					 * @param {*} value
					 * @returns {{}} Контроллер плагина
					 */
					setValue: function (value) {
						if ($.type(value) === 'object') {
							return controller.setValueByObject(value);
						}

						if ($.type(value) === 'number') {
							return controller.setValueById(value);
						}

						if ($.type(value) === 'string') {
							return controller.setValueByName(value);
						}

						if (!value) {
							return controller.clear();
						}

						return controller;
					},

					/**
					 * Устанавливает значение в поле ввода по названию
					 *
					 * @param {string} name Название объекта КЛАДР
					 * @returns {{}} Контроллер плагина
					 */
					setValueByName: function (name) {
						name = $.trim(name + '');

						if (name) {
							var query = getQuery('');

							query.name = fixName(name);
							query.withParents = false;
							query.limit = 10;

							if (!trigger('send_before', query)) {
								changeValue(null, query);
								return controller;
							}

							lock();
							trigger('send');

							get('source')(query, function (objs) {
								trigger('receive');

								var nameLowerCase = query.name.toLowerCase(),
									valueLowerCase = null,
									obj = null;

								for (var i = 0; i < objs.length; i++) {
									valueLowerCase = objs[i].name.toLowerCase();

									if (nameLowerCase == valueLowerCase) {
										obj = objs[i];
										break;
									}
								}

								changeValue(obj, query);
							});
						}

						return controller;
					},

					/**
					 * Устанавливает значение в поле ввода по идентификатору
					 *
					 * @param {number} id Идентификатор объекта КЛАДР
					 * @returns {{}} Контроллер плагина
					 */
					setValueById: function (id) {
						var query = getQuery('');

						query.parentType = query.type;
						query.parentId = id;
						query.limit = 1;

						lock();

						$.kladr.api(query, function (objs) {
							objs.length
								? changeValue(objs[0], query)
								: changeValue(null, query);
						});

						return controller;
					},

					/**
					 * Устанавливает объект КЛАДР как значение поля ввода
					 *
					 * @param {{}} obj Объект КЛАДР
					 * @returns {{}} Контроллер плагина
					 */
					setValueByObject: function (obj) {
						changeValue(obj, getQuery(''));
						return controller;
					},

					/**
					 * Очищает поле ввода
					 *
					 * @returns {{}} Контроллер плагина
					 */
					clear: function () {
						changeValue(null, null);
						return controller;
					}
				};

				var lockAttr = 'data-kladr-autofill-lock';

				/**
				 * Блокирует поле ввода для изменения функцией checkAutoFill
				 */
				function lock() {
					$input.attr(lockAttr, true);
				}

				/**
				 * Изменяет значение поля ввода
				 *
				 * @param {{}} obj Объект КЛАДР
				 * @param {{}} query Объект запроса к сервису
				 */
				function changeValue(obj, query) {
					obj ? $input.val(get('valueFormat')(obj, query)) : error(true);
					setCurrent(obj);
					$input.removeAttr(lockAttr);
				}

				set('controller', controller);
			}

			/**
			 * Проверяет автоматически установленное при автозаполнении браузером значение
			 */
			function checkAutoFill() {
				var count = 0;

				(function test() {
					if (++count > 5 || isFilled()) {
						return;
					}

					setTimeout(test, 100);
				})();

				function isFilled() {
					var name = $input.val();

					if (name) {
						var query = getQuery(name),
							queryType = query.type,
							queryParentType = query.parentType,
							type = $.kladr.type,
							parentFilled = true,
							setByName = get('controller').setValueByName,
							lock;

						// Костыль для полей ввода улиц
						if (queryType == type.street && queryParentType != type.city) {
							parentFilled = false;
						}

						// Костыль для полей ввода строений
						if (queryType == type.building && !~$.inArray(queryParentType, [type.street, type.city])) {
							parentFilled = false;
						}

						lock = $input.attr('data-kladr-autofill-lock');

						lock && get('current') && parentFilled && setByName(name);
						return !!get('current');
					}

					return false;
				}
			}

			/**
			 * Инициализирует событие плагина
			 *
			 * @param {string} event Имя события
			 * @param {{}} obj Объект передаваемый в событие
			 * @returns {boolean} Выполнить действие идущее после события
			 */
			function trigger(event, obj) {
				if (!event) {
					return true;
				}

				var eventProp = event.replace(/_([a-z])/ig, function (all, letter) {
					return letter.toUpperCase();
				});

				$input.trigger('kladr_' + event, obj);

				if ($.type(get(eventProp)) === 'function') {
					return get(eventProp).call($input.get(0), obj) !== false;
				}

				return true;
			}

			/**
			 * Отображает ajax-крутилку
			 */
			function showSpinner() {
				if (get('spinner')) {
					get('showSpinner')($spinner);
				}
			}

			/**
			 * Скрывает ajax-крутилку
			 */
			function hideSpinner() {
				if (get('spinner')) {
					get('hideSpinner')($spinner);
				}
			}

			/**
			 * Генерирует запрос к сервису
			 *
			 * @param {string} name Введённое в поле ввода пользователем значение
			 * @returns {{}}
			 */
			function getQuery(name) {
				var query = {},
					fields = [
						'token',
						'key',
						'type',
						'typeCode',
						'parentType',
						'parentId',
						'oneString',
						'withParents',
						'limit',
						'strict'
					],
					i;

				for (i = 0; i < fields.length; i++) {
					query[fields[i]] = get(fields[i]);
				}

				query.name = fixName(name);

				var parentInput = get('parentInput'),
					parent;

				if (parentInput) {
					parent = getParent(parentInput, query.type);

					if (parent) {
						query.parentType = parent.type;
						query.parentId = parent.id;
					}
				}

				// Костыль для поиска одной строкой
				if (query.oneString) {
					query.withParents = true;
				}

				return query;
			}

			/**
			 * Возвращает тип и идентификатор ближайшего родительского объекта
			 * среди заполненных пользователем полей ввода на странице
			 *
			 * @param {*} selector Селектор для ограничения поиска полей ввода
			 * @param {string} type Тип объектов в текущем поле ввода
			 * @returns {{}}
			 */
			function getParent(selector, type) {
				var $inputs = $.kladr.getInputs(selector),
					types = $.kladr.type,
					parents = {},
					parent = null,
					t;

				$inputs.each(function () {
					var $this = $(this),
						id;

					if (id = $this.attr('data-kladr-id')) {
						parents[$this.attr('data-kladr-type')] = id;
					}
				});

				for (t in types) {
					if (t == type) {
						return parent;
					}

					if (hasOwn(types, t) && parents[t]) {
						parent = {
							type: t,
							id: parents[t]
						}
					}
				}

				return parent;
			}

			/**
			 * Отображает ошибку при некорректном вводе
			 *
			 * @param {string} name Введённое пользователем значение
			 * @returns {string}
			 */
			function fixName(name) {
				var noCorrect = 'abcdefghijklmnopqrstuvwxyz',
					testName = name.toLowerCase();

				for (var i = 0; i < testName.length; i++) {
					if (~noCorrect.indexOf(testName[i])) {
						error(true);
						return name;
					}
				}

				error(false);
				return name;
			}

			/**
			 * Устанавливает текущий объект КЛАДР
			 *
			 * @param {{}} obj
			 */
			function setCurrent(obj) {
				var curr = get('current');

				if ((curr && curr.id) === (obj && obj.id)) {
					return;
				}

				set('current', obj);

				if (obj && obj.id) {
					$input.attr('data-kladr-id', obj.id);
				} else {
					$input.removeAttr('data-kladr-id');
				}

				if (get('oneString')) {
					if (obj && obj.contentType) {
						$input.attr('data-kladr-type', obj.contentType);
					}
				}

				trigger('change', obj);
			}

			/**
			 * Управляет выводом ошибки в поле ввода
			 *
			 * @param {boolean} error Если true, то вывести ошибку. Если false, то снять.
			 */
			function error(error) {
				error
					? $input.addClass('kladr-error')
					: $input.removeClass('kladr-error');
			}

			/**
			 * Возвращает значение параметра плагина
			 *
			 * @param {string} param
			 * @returns {*}
			 */
			function get(param) {
				return options._get(param);
			}

			/**
			 * Устанавливает значение параметра плагина
			 *
			 * @param {string} param
			 * @param {*} value
			 */
			function set(param, value) {
				options._set(param, value);
			}
		});
	}

	/**
	 * Считывает значение параметров в объект
	 * более удобного для использования формата
	 *
	 * @param {string|{}} param1
	 * @param {*} param2
	 * @returns {{obj: boolean|{}, str: boolean|{}, isGet: boolean}}
	 */
	function readParams(param1, param2) {
		var params = {
			obj: false,
			str: false,
			isGet: false
		};

		if ($.type(param1) === 'object') {
			params.obj = param1;
			return params;
		}

		if ($.type(param1) === 'string') {
			params.str = [param1, param2];
			params.isGet = (param2 === undefined);
		}

		return params;
	}

	/**
	 * Возвращает глобальный уникальный идентификатор
	 *
	 * @returns {number}
	 */
	function getGuid() {
		return getGuid.guid
			? ++getGuid.guid
			: getGuid.guid = 1;
	}

	/**
	 * Проверяет принадлежит ли свойство объекту
	 *
	 * @param {{}} obj
	 * @param {string} property
	 * @returns {boolean}
	 */
	function hasOwn(obj, property) {
		return obj.hasOwnProperty(property);
	}
})(jQuery, window, document);
