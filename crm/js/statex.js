/**
 * Вызывает скрипт, передаёт ему параметры через JSON
 *
 * @param {*} json Все параметры, которые надо передать вызываемому скрипту
 * @param {*} successFunction  Функция, которая вызывается при успешном выполнении
 * @param {*} params Параметры, передаваемые successFunction
 */
function getJsonResult(json, successFunction, params) {
	$('#loading').css('display', 'block');
	let tDate = Date.now();
	$.post("/json/?" + tDate, json, function (jsonResult) {
		if (typeof jsonResult !== 'object') {
			try {
				jsonResult = JSON.parse(jsonResult);
			} catch (e) {
				if (typeof e.error != 'undefined' && typeof jsonResult != 'string') {
					console.error("error parsing JSON!");
					console.log("jsonResult is: ", jsonResult);
					console.log(e.error);
				}
			}
		}
		$('#loading').css('display', 'none');
		// JSON request successfull, calling successFunction
		successFunction(jsonResult, params);
	});
}

function apanel(params) {
	$.extend(this.options, params);
}

apanel.prototype = {
	build: '1.0',
	cfg: {
		url: {
			querystat: 'CStatEx'
		},
		selectors: {
			statex_current: 'statex_current',
			statex_cache: 'statex_cache',
			statex_prepare: 'statex_prepare',
			statex_csv: 'statex_csv',
			statex_bprice: 'statex_bprice',
			statex_config: 'statex_config',
		},
		curDate: '',
	},

	/**
	 * выводит сообщение над таблицей
	 *
	 * @param message array или string
	*/
	showMessage: function (message) {
		let sMessage = "";
		if (typeof message == "string") {
			sMessage = "<h5 class='statex_message'>" + message + "</h5>";
		} else {
			for(let m in message) {
				sMessage += "<h5 class='statex_message'>" + message[m] + "</h5>"
			}

		}
		$("#statex_zoom").html(sMessage);
	},

	/**
	 * возвращает разницу между датой input и нужным числом лет, месяцев, дней
	 *
	 * @param input string
	 * @param days int
	 * @param months int
	 * @param years int
	 */
	deltaDate: function (input, days, months, years) {
		var date = new Date(input);
		date.setDate(date.getDate() + days);
		date.setMonth(date.getMonth() + months);
		date.setFullYear(date.getFullYear() + years);
		return date;
	},

	/**
	 * возвращает читаемую дату в формате "Январь 2020", которая выводится на экран
	 * @param date Date
	*/
	getDateText: function (date) {
		let months = ["Январь", "Февраль", "Март", "Апрель", "Май", "Июнь", "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь"];
		return months[date.getMonth()] + " " + date.getFullYear();
	},

	/**
	 * возвращает дату в формате "2020-01", которая передаётся между функциями
	 *  @param date Date
	 */
	getDateValue: function (date) {
		let month = date.getMonth() + 1;
		if (month < 10) month = "0" + month;
		return date.getFullYear() + "-" + month;
	},

	/**
	 * возвращает количество дней в месяце
	 * @param month string
	 * @param year string
	 * */
	daysInMonth: function (month, year) {
		return new Date(year, month, 0).getDate();
  },

	builder: function () {

		$('#top label, #tabs label').click(function () {
			var item = $(this);
			item.parent().parent().find('label.active').removeClass('active');
			item.addClass('active');
		});

		//создание кнопок выбора даты
		let today = new Date();
		let curdate = "";
		let newdate = "";
		curdate = apanel.getDateValue(today) + "-01";

		for (let i = 0; i < 5; i++) {
			newdate = apanel.deltaDate(curdate, 0, -1 * i, 0);
			$('#datetabs').append($('<button>', {
				value: apanel.getDateValue(newdate),
				text: apanel.getDateText(newdate),
				class: "datetab",
				onclick: "apanel.dateTabClick(event, this, '" + apanel.getDateValue(newdate) + "')",
			}));
		};

		//установить выбранную дату в текущий месяц - 1
		// $("#datetabs button")[1].click();

		apanel.actions();
	},

	//обработка клика на кнопке выбора даты
	dateTabClick: function (e, src, dateValue) {
		apanel.setDateRange(dateValue);

		$("#datetabs button").attr('class', 'datetab');
		$(src).attr('class', 'datetab-active');
		apanel.statex_current.queryCategories(e.shiftKey); //если нажат shift, перегружаем кеш
	},

	//устанавливает выбранную пользователем дату
	setDateRange: function (dateValue) {
		apanel.cfg.curDate = dateValue;
	},

	//возвращает выбранную пользователем дату
	getDateRange: function () {
		return apanel.cfg.curDate;
	},

	actions: function () {
		$('[radios="' + apanel.cfg.selectors.statex_current + '"]').click(apanel.statex_current.start.bind(this));
		$('[radios="' + apanel.cfg.selectors.statex_cache + '"]').click(apanel.statex_cache.start.bind(this));
		$('[radios="' + apanel.cfg.selectors.statex_prepare + '"]').click(apanel.statex_prepare.start.bind(this));
		$('[radios="' + apanel.cfg.selectors.statex_csv + '"]').click(apanel.statex_csv.start.bind(this));
		$('[radios="' + apanel.cfg.selectors.statex_bprice + '"]').click(apanel.statex_bprice.start.bind(this));
		$('[radios="' + apanel.cfg.selectors.statex_config + '"]').click(apanel.statex_config.start.bind(this));

		if(JSCat.Group.indexOf('seniormanager') != -1){
			apanel.statex_bprice.start();
		}else{
			apanel.statex_current.start();
		}

	},

	// Настройки модуля
	statex_config: {
		aGroups: [],
		aOptions: [],

		start: function () {
			console.log('statex_config');
			$('#tabs').hide();
			$('#charts').empty().append(
				'<div class="statex_viewport">\
					<table id = "statex_maintable" class= "categories-table" ></table>\
				</div>\
				<div id="statex_zoom"></div>');

			$('#statex_maintable').empty();
			$("#statex_zoom").empty();
			$('#statex_maintable').append("<h3>Идёт загрузка настроек...</h3>");
			apanel.statex_config.load();
		},

		//загрузка настроек
		load: function () {
			var json = {
				func: 'CStatEx',
				domain: JSCat.domain,
				token: JSCat.token,
				action: "getConfig",
			};
			console.log('statex_config: loading..');
			getJsonResult(json, function (qResult) {
						apanel.statex_config.parse(qResult);
						apanel.statex_config.table(qResult);
					}
				);
		},

		//сохранение настроек
		save: function () {
			var json = {
				func: 'CStatEx',
				domain: JSCat.domain,
				token: JSCat.token,
				action: "addOptions",
				par: {
					"options": apanel.statex_config.collectSettings(),
				},
			};
			console.log('statex_config: saving..');
			//reload results
			getJsonResult(json, apanel.statex_config.load);
		},


		collectSettings: function () {
			let arrSettings = [];

			for (let el in this.aGroups) {
				console.log(this.aGroups[el]);
				arrSettings.push({
					group_key: this.aGroups[el].group_key,
					group_name: this.aGroups[el].group_name,
				});
			}

			let cSettings = $('input[data-id]');
			cSettings.each(
				function (idx) {
					let aGroupKey = $(this).attr('data-group-key');
					let aGroupName = $(this).attr('data-group-name');
					// let aGroupId = $(this).attr('data-group-id') || 0;
					let aKey = $(this).attr('data-key');
					let aName = $(this).attr('data-name');
					let aValue = $(this).val();

					// if (typeof arrSettings[aGroupId] == 'undefined') arrSettings[aGroupId]={ name: aGroupName, value : aGroupKey };
					// if (typeof arrSettings[aGroupId][aKey] == 'undefined') arrSettings[aGroupId][aKey]=[];
					arrSettings.push({
						name: aName,
						key: aKey,
						value: aValue,
						group_key: aGroupKey,
						group_name: aGroupName,
					});
					// arrSettings[aOption][aKey]['value']=aValue;
				}
			);



			// console.log('settings:', arrSettings);
			return arrSettings;
		},

		//сброс настроек
		reinit: function () {
			var json = {
				func: 'CStatEx',
				domain: JSCat.domain,
				token: JSCat.token,
				action: "initConfig",
			};
			console.log('statex_config: resetting..');
			//reload results
			getJsonResult(json, apanel.statex_config.load);
		},

		parse: function (queryResult) {
			this.aGroups = [];
			this.aOptions = [];

			for (let a in queryResult) {
				aResult = queryResult[a];

				if (aResult['group_name'] != "") {
					//добавляем группу
					this.aGroups[aResult['group_key']] = {
						id: aResult['id'],
						name: aResult['group_name'],
						group_key: aResult['group_key'],
						group_name: aResult['group_name'],
					};
				} else {
					//добавляем опцию

					//если не указана группа, закидываем в "Разное"
					if (aResult['group_key'] == "") {
						this.aGroups["__misc"] = { id: 0, name: "Разное" };
						aResult['group_key'] = "__misc";
					}

					if (typeof this.aGroups[aResult['group_key']] == 'undefined') aResult['group_key'] = "__misc";
					if (typeof this.aOptions[aResult['group_key']] == 'undefined') this.aOptions[aResult['group_key']] = [];
					this.aOptions[aResult['group_key']][aResult['id']] = {
						id: aResult['id'],
						key: aResult['key'],
						name: aResult['name'],
						value: aResult['value'],
						group_key: aResult['group_key'],
						group_name: aResult['group_name'],
					}
				}
			}

		},

		//вывод настроек
		table: function (queryResult) {
			$('#statex_maintable').empty();

			$("#statex_maintable").append($('<button>', {
				text: "+ Добавить",
				class: "btn-success",
				"data-toggle": 'modal',
				"data-target": '#statex_modal',
				onclick: "apanel.statex_config.addOption()",
			}));

			$("#statex_maintable").append($('<button>', {
					text: "+ Добавить группу",
					class: "btn-success",
					"data-toggle": 'modal',
					"data-target": '#statex_modal',
					onclick: "apanel.statex_config.addOptionGroup()",
				})
			);

			$("#statex_maintable").append($('<button>', {
				text: ">> Тест бота",
				class: "btn-warning",
				onclick: "apanel.statex_config.sendTest()",
			})
		);

			let sModal = '\
				<div class="modal fade" id="statex_modal">\
				<div class="modal-dialog">\
					<div class="modal-content">\
						<div class="modal-header">\
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>\
						<h4 class="modal-title"></h4>\
						</div>\
						<div class="modal-body">\
						</div>\
						<div class="modal-footer">\
						<button type="button" class="btn btn-primary" data-dismiss="modal">Сохранить</button>\
						<button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>\
						</div>\
					</div><!-- /.modal-content -->\
				</div><!-- /.modal-dialog -->\
				</div><!-- /.modal -->\
			';
			$("#statex_maintable").append(sModal);


			if (queryResult) {
				if (typeof queryResult['message'] != 'undefined') {
					apanel.showMessage(queryResult['message']);
					delete queryResult['message'];
				}

				$("#statex_maintable").append(
					'<tr role="row">\
						<th class="th2">Настройка</th>\
						<th class="th2">Ключ</th>\
						<th class="th2" colspan=2>Значение</th>\
					</tr>'
				);

				for (let aG in this.aGroups) {
					aGroup = this.aGroups[aG];
					$("#statex_maintable").append(
						'<tr role="row">\
						<th colspan=4>' +
								aGroup.name +
						'</th>\
						</tr>'
					);

					for (let aO in this.aOptions[aG]) {
						aOption = this.aOptions[aG][aO];
						$("#statex_maintable").append(
						'<tr role="row">\
							<td>' + aOption.name + '</td>\
							<td>' + aOption.key + '</td>\
							<td><input type="text" data-id="' + aOption.id +
						'" data-group-key="' + aOption.group_key +
						'" data-group-name="' + aOption.group_name +
						'" data-key="' + aOption.key +
						'" data-name="' + aOption.name +
						'" value="' + aOption.value +
						'"></td>\
							<td><button onClick="apanel.statex_config.doDeleteOption(\'' + aOption.id + '\');");" class="btn-warning">X</button></td>\
						</tr>'
						);
					}
				}

				$("#statex_maintable").append($('<button>', {
					value: "save",
					text: "Сохранить",
					class: "btn-success",
					onclick: "apanel.statex_config.save()",
				}));

				$("#statex_maintable").append($('<button>', {
					value: "reset",
					text: "Установить настройки по умолчанию",
					class: "btn-warning",
					onclick: "apanel.statex_config.reinit()",
				}));

				$(window).trigger('resize');

			} else {
				$("#statex_maintable").append(
					'<tr role="row">\
						<td class="empty-data">Нет настроек</td>\
					</tr>'
				);
			}

		},

		addOption: function () {
			let sGroups = "";
			for (a in this.aGroups) {
				sGroups += "<option value='"+a+"'>" + this.aGroups[a].name + "</option>";
			}

			let sForm = "\
				<div id='formAddOption'>\
			<label>Название: <input type='text' id='name'></label><br>\
			<label>Ключ: <input type='text' id='key'></label><br>\
			<label>Значение: <input type='text' id='value'></label><br>\
			<label>Группа: <select id='group_key'>"+sGroups+"</select></label><br>\
				</div>\
			";
			$("#statex_modal .btn-primary").bind('click', apanel.statex_config.doAddOption);
			$("#statex_modal .modal-title").html('<h4>Добавить настройку</h4>');
			$("#statex_modal .modal-body").html(sForm);
		},

		doAddOption: function () {
			var json = {
				func: 'CStatEx',
				domain: JSCat.domain,
				token: JSCat.token,
				action: "addOption",
				par: {
					"option": {
						name: $("#formAddOption #name").val(),
						key: $("#formAddOption #key").val(),
						value: $("#formAddOption #value").val(),
						group_key: $("#formAddOption #group_key").val(),
					},
				},
			};
			console.log('statex_config: adding option..');
			//reload results
			getJsonResult(json, apanel.statex_config.load);
		},

		doAddOptionGroup: function () {
			var json = {
				func: 'CStatEx',
				domain: JSCat.domain,
				token: JSCat.token,
				action: "addOptionGroup",
				par: {
					"option": {
						name: $("#formAddOptionGroup #name").val(),
						key: $("#formAddOptionGroup #key").val(),
					},
				},
			};
			console.log('statex_config: adding option group..');
			//reload results
			getJsonResult(json, apanel.statex_config.load);
		},

		sendTest: function () {
			var json = {
				func: 'CStatEx',
				domain: JSCat.domain,
				token: JSCat.token,
				action: "sendReport",
			};
			console.log('statex_config: sending report..');
			getJsonResult(json, ($res) => { console.log($res)});

		},

		doDeleteOption: function (key) {
			var json = {
				func: 'CStatEx',
				domain: JSCat.domain,
				token: JSCat.token,
				action: "deleteOption",
				par: {
					"option": {
						key: key,
					},
				},
			};
			console.log('statex_config: deleting option (' + key + ')..');
			//reload results
			getJsonResult(json, apanel.statex_config.load);
		},


		addOptionGroup: function () {
			let sForm = "\
				<div id='formAddOptionGroup'>\
			<label>Название: <input type='text' id='name'></label><br>\
			<label>Ключ: <input type='text' id='key'></label><br>\
				</div>\
			";
			$("#statex_modal .btn-primary").bind('click', apanel.statex_config.doAddOptionGroup);
			$("#statex_modal .modal-title").html('<h4>Добавить группу настройек</h4>');
			$("#statex_modal .modal-body").html(sForm);
		},

	},

	// Подготовка таблиц, парсинг БД
	statex_cache: {
		start: function () {
			console.log('statex_cache');

			$('#tabs').hide();
			$('#charts').empty().append(
				'<div class="statex_viewport">\
					<table id = "statex_maintable" class= "categories-table" ></table>\
				</div>\
				<div id="statex_zoom"></div>');
			$('#statex_maintable').empty();

			apanel.statex_cache.table();
		},

		clear: function (daterange) {
			//сбор и подгтовка данных из всех таблиц
			var json = {
				func: 'CStatEx',
				domain: JSCat.domain,
				token: JSCat.token,
				action: "clearCache",
				par: daterange,
			};
			console.log('statex_cache: clearing '+daterange+' ..');
			getJsonResult(json, (queryResult) => {
				$('#statex_maintable').append("<h3>Кеш сброшен</h3>");
			});
		},

		warmup: function (daterange) {
			//сбор и подгтовка данных из всех таблиц
			var json = {
				func: 'CStatEx',
				domain: JSCat.domain,
				token: JSCat.token,
				action: "warmupCache",
				par: daterange,
			};
			let tDate = new Date();
			console.log('statex_cache: warming up ' + daterange + '.. ' + tDate.toLocaleString());

			getJsonResult(json, (queryResult) => {
				apanel.statex_cache.table();
				$('#statex_maintable').append("<h3>Кеш прогрет</h3>" + queryResult);
				let cDate = new Date();
				console.log('statex_cache: warmed up! ' + cDate.toLocaleString());
			});

		},

		table: function () {
			$('#statex_maintable').empty();
			$('#statex_maintable').append("<div id='cache-con'></div>");
			$('#cache-con').append("<button onClick=\"apanel.statex_cache.clear('*');\">Сбросить весь кеш</button><br><br>");
			$('#cache-con').append($('<button>', {
				text: "Прогреть кеш за последние 2 месяца",
				class: "btn-success",
				onclick: "apanel.statex_cache.warmup('')",
			}));

			$('#cache-con').append("<br><br>");
			//создание кнопок выбора даты
			let today = new Date();
			let curdate = "";
			let newdate = "";
			curdate = apanel.getDateValue(today) + "-01";

			for (let i = 0; i < 5; i++) {
				newdate = apanel.deltaDate(curdate, 0, -1 * i, 0);
				$('#cache-con').append($('<button>', {
					text: "Прогреть кеш за " + apanel.getDateText(newdate),
					class: "btn-success",
					onclick: "apanel.statex_cache.warmup('" + apanel.getDateValue(newdate) + "')",
				}));
				$('#cache-con').append($('<button>', {
					text: "Сбросить кеш за " + apanel.getDateText(newdate),
					class: "btn-warning",
					onclick: "apanel.statex_cache.clear('" + apanel.getDateValue(newdate) + "')",
				}));


				$('#cache-con').append("<br>");
			};
		},
	},

	/**
	 * Цены лидов
	 */
	statex_bprice: {
		edit: {
			category: 0,
			date: '',
		},

		start: function () {
			console.log('statex_bprice');

			$('#tabs').hide();
			$('#charts').empty().append(
				'<div class="statex_viewport_wide" id="statex-viewport">\
				<h2>Цены закупа по категориям</h2>\
				<div id="bprice"></div>\
				</div>\
		');
			// $('#statex_maintable').empty();
			let sModal = '\
				<div class="modal fade" id="statex_modal">\
				<div class="modal-dialog">\
					<div class="modal-content">\
						<div class="modal-header">\
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>\
						<h4 class="modal-title"></h4>\
						</div>\
						<div class="modal-body">\
						<div id="formEditBprice">\
						<label>Цена: <input type="text" id="bprice-edit"></label><br>\
							</div>\
						</div>\
						<div class="modal-footer">\
						<button type="button" class="btn btn-primary" data-dismiss="modal">Сохранить</button>\
						<button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>\
						</div>\
					</div><!-- /.modal-content -->\
				</div><!-- /.modal-dialog -->\
				</div><!-- /.modal -->\
			';
			$("#statex-viewport").append(sModal);

			apanel.statex_bprice.table();
			apanel.statex_bprice.getCatList();
		},

		getCatList: function () {
			//сбор и подгтовка данных из всех таблиц
			var json = {
				func: 'CStatEx',
				domain: JSCat.domain,
				token: JSCat.token,
				action: "getBPriceCatList",
				par: $('#bprice-date').val(),
			};

			console.log('statex_bprice: receiving categories');

			getJsonResult(json, (queryResult) => {
				apanel.statex_bprice.showCatList(queryResult);
			});

		},

		showCatList: function (queryResult) {
			console.log('statex_bprice: received', queryResult );

			$('#bprice-heads').empty().append('<tr>\
					<th>Категории:</th>\
				</tr>');

			let categoryCount = 0;
			for(let nCat in queryResult) {
				if (queryResult[nCat]['id'] != '0') {
					$('#bprice-heads').append('<tr>\
				<td><b>'+ queryResult[nCat]['name'] + '</b></td>\
				</tr>');
				}

				categoryCount++;

			};

			//дни по горизонтали, категрии по вертикали

			let dayrows = [];
			let date = $('#bprice-date').val();
			let aDate = date.split('-');
			let daycount = apanel.daysInMonth(aDate[1],aDate[0]);

			function findBDate(qr, dt, i) {
				let ret = false;

				if (typeof qr['bprice'] != 'undefined') {

					for (let k = 0; k < qr['bprice'].length; k++) {
						if (qr['bprice'][k][1] == dt) {
							ret = qr['bprice'][k][0];
							break;
						}
					}
				}

				return ret;
			}

			function findPrevBDate(qr, dt,i, day) {
				let ret = false;
				let dDate = new Date(dt);

				if (typeof qr['bprice'] != 'undefined' ) {
					for (let k = 0; k < qr['bprice'].length; k++) {

						if (qr['bprice'][k][1] != '0') {

							let qDate = new Date(qr['bprice'][k][1]);

							if (qDate.getTime() < dDate.getTime()) {
								ret = qr['bprice'][k][0];
								break;
							}
						}

						if ((i == 9)) {
							console.log("bprice ("+i+","+day+ "):", qr['bprice'], "date:", dt, "k:", k, "ret:", ret);
						}
					}
				}

				return ret;
			}

			for (let i = 0; i < categoryCount; i++) {
				// console.log(i, queryResult[i]);
				// if (i>0 && typeof queryResult[i]['bprice'] != 'undefined' && queryResult[i]['bprice'] != null) {
				// 	console.log(queryResult[i]['bprice'][1]);
				// }
				dayrows[i] = "";
				let lastval = findBDate(queryResult[i], "0", i);;

				for (let day = 1; day <= daycount; day++) {
					let daynum = (day < 10) ? "0" + day : day;

					if (i == 0) {
						//zero row of queryResult holds default values, so we use i=0 for headings
						dayrows[i] = dayrows[i] + "<th class='bprice' id='td" + date + "-" + daynum + ":" + "0" +"'>" + day + "</th>";
					} else {
						let price = "";
						let sclass = " auto";
						let dt = date + "-" + daynum;
						price = findBDate(queryResult[i], dt, i);
						if (price) {
							lastval = price;
							sclass = "";
						} else {
							price = findBDate(queryResult[i], dt, i);
							if (!price) {
								price = lastval;
							}

							sclass = " auto";
						}
						dayrows[i] = dayrows[i] + "<td class='bprice "+sclass+"' id='td" + date + "-" + daynum + ":" + queryResult[i]['id'] +"'>" + price + "</td>";
					}
				}
			}



			$('#bprice-vals').empty().append('<tr>\
					' + dayrows.join('</tr><tr>') +
				'\
				</tr>');

			$('td.bprice').on('click', (e) => {
				let aDay = $(e.target)[0].id.split(":");
				console.log('clicked', aDay);
				apanel.statex_bprice.edit.element = $(e.target)[0];
				apanel.statex_bprice.edit.date = aDay[0].substr(2);
				apanel.statex_bprice.edit.category = aDay[1];

				$("#statex_modal .btn-primary").on('click', apanel.statex_bprice.setBPrice);
				$("#statex_modal").on('keypress', (e) => {
					if (e.which == 13) {
						$("#statex_modal").modal('hide');
						apanel.statex_bprice.setBPrice();
					}
				});
				$("#statex_modal .modal-title").html("<h4>Цена на "+ aDay[0].substr(2) +" </h4>");
				$("#statex_modal").modal();
				$("#statex_modal").on('shown.bs.modal', function () {
					$('#bprice-edit').focus();
					})

				// console.log($(e.target)[0].id);
			});
		},

		setBPrice: function () {
			let date = apanel.statex_bprice.edit.date;
			let category = apanel.statex_bprice.edit.category;
			let price = Math.round($('#bprice-edit').val());
			$(apanel.statex_bprice.edit.element).html(price);
			$(apanel.statex_bprice.edit.element).removeClass('auto');
			let rightrow = $(apanel.statex_bprice.edit.element).nextAll();
			for (const key in rightrow) {
				if (key == 'length') {
					break;
				}

				// console.log($(rightrow[key]).hasClass('auto'));
				if (!$(rightrow[key]).hasClass('auto')) {
					break;
				} else {
					$(rightrow[key]).html(price);
					$(rightrow[key]).addClass('auto');
				}
			}

			var json = {
				func: 'CStatEx',
				domain: JSCat.domain,
				token: JSCat.token,
				action: "setBPrice",
				par: {
					date: date,
					category_id: category,
					price: price,
				},
			};

			getJsonResult(json, (queryResult) => {
				console.log("saved", queryResult);
			 });

			console.log("saving price ...", date, category, price);
		},


		doDateChange: function () {
			apanel.statex_bprice.getCatList();
		},

		doPrevMonth: function () {
			let cur = $('#bprice-date').prop('selectedIndex');
			if (cur < $('#bprice-date option').length - 1) {
				$('#bprice-date').prop('selectedIndex', cur + 1);
				apanel.statex_bprice.doDateChange();
			}
		},

		doNextMonth: function () {
			let cur = $('#bprice-date').prop('selectedIndex');
			if (cur > 0) {
				$('#bprice-date').prop('selectedIndex', cur - 1);
				apanel.statex_bprice.doDateChange();
			}
		},

		table: function () {
			console.log('Building a table..');
			// $('#statex-viewport').empty();
			// $('#statex-viewport').append("");

			//создание кнопок выбора даты
			//кнопки месяц вперёд-назад
			$('#bprice').append("<i class='fa fa-arrow-circle-left datenav' onClick='apanel.statex_bprice.doPrevMonth();'></i>");

			let today = new Date();
			let curdate = "";
			let newdate = "";
			curdate = apanel.getDateValue(today) + "-01";

			$('#bprice').append("<label> Диапазон: <select id='bprice-date' onChange='apanel.statex_bprice.doDateChange();'></select></label>");

			for (let i = 0; i < 5; i++) {
				newdate = apanel.deltaDate(curdate, 0, -1 * i, 0);
				$('#bprice-date').append($('<option>', {
					text: apanel.getDateText(newdate),
					value: apanel.getDateValue(newdate),
				}));

			};

			$('#bprice').append("<i class='fa fa-arrow-circle-right datenav' onClick='apanel.statex_bprice.doNextMonth();'></i>");


			$('#bprice').append("<div id='bprice-table'>\
						<div id='bprice-headings'><table id='bprice-heads'>\
						</table></div>\
						<div id='bprice-values'><table id='bprice-vals'>\
						</table></div>\
				</div>");

		},
	},

	/**
	 * Выгрузка таблицы в CSV
	 */
	statex_csv: {
		start: function () {
			console.log('statex_csv');

			$('#tabs').hide();
			$('#charts').empty().append(
				'<div class="statex_viewport">\
					<table id = "statex_maintable" class= "categories-table" ></table>\
				</div>\
				<div id="statex_zoom"></div>');

			$('#statex_maintable').empty();

			apanel.statex_csv.table();
		},

		getCatList: function (daterange) {
			//сбор и подгтовка данных из всех таблиц
			var json = {
				func: 'CStatEx',
				domain: JSCat.domain,
				token: JSCat.token,
				action: "getCatList",
				par: daterange,
			};

			console.log('statex_csv: receiving categories for ' + daterange );

			getJsonResult(json, (queryResult) => {
				$('#csv-cat').html('');

				$('#csv-cat').append($('<option>', {
					text: "Все категории",
					value: 0,
					selected: "selected",
				}));

				let cnt = 0;
				for(let id in queryResult) {
					$('#csv-cat').append($('<option>', {
						text: queryResult[id],
						value: id,
					}));
					cnt++;
				};

				$('#csv-cat').attr('size', cnt + 1);
			});

		},

		getCsv: function () {
			let daystart = $('#csv-daystart').val()+"";
			if (daystart < 10) daystart = "0" + daystart;

			let dayend = $('#csv-dayend').val()+"";
			if (dayend < 10) dayend = "0" + dayend;

			var json = {
				func: 'CStatEx',
				domain: JSCat.domain,
				token: JSCat.token,
				action: "getCsv",
				par: {
					date_range: $('#csv-date').val(),
					day_start: daystart,
					day_end: dayend,
					category_ids: $('#csv-cat').val().join(),
					show_upsell: $('#csv-upsell').prop('checked') ? "1" : "0",
					show_summary: $('#csv-summary').prop('checked') ? "1" : "0",
					show_onlysummary: $('#csv-onlysummary').prop('checked') ? "1" : "0",
					show_statuses: $('#csv-status').val().join(),
				}
			};

			console.log('statex_csv: downloading CSV for ' +
				$('#csv-date').val() + ' from ' + $('#csv-daystart').val() + ' to ' + $('#csv-dayend').val() + ' and categories [' + $('#csv-cat').val().join() + ']') +
				'with status [' + $('#csv-status').val().join()+']'+'and summary'+$('#csv-summary').prop('checked') ;

			getJsonResult(json, (queryResult) => {
				console.log('statex_csv: received CSV ', queryResult);
				$("body").append("<iframe src='" + queryResult['url']+ "' style='display: none;' ></iframe>");
				apanel.showMessage("Всего записей:<br>"+queryResult['count']);
			});

		},

		setMonthDays: function () {
			$('#csv-daystart').val("1");

			let fullDate = $('#csv-date').val() + "-01";
			let newdate = new Date(fullDate);

			$('#csv-dayend').val(apanel.daysInMonth(newdate.getMonth()+1, newdate.getFullYear()));
		},

		doDateChange: function () {
			apanel.statex_csv.setMonthDays();
			apanel.statex_csv.getCatList($('#csv-date').val());
		},

		table: function () {
			$('#statex_maintable').empty();
			$('#statex_maintable').append("<div id='csv-con'><h2>Выгрузка CSV</h2></div>");

			$('#csv-con').append("<br><br>");
			//создание кнопок выбора даты
			let today = new Date();
			let curdate = "";
			let newdate = "";
			curdate = apanel.getDateValue(today) + "-01";

			$('#csv-con').append("<label> Диапазон: <select id='csv-date' onChange='apanel.statex_csv.doDateChange();'></select></label>");

			for (let i = 0; i < 5; i++) {
				newdate = apanel.deltaDate(curdate, 0, -1 * i, 0);
				$('#csv-date').append($('<option>', {
					text: apanel.getDateText(newdate),
					value: apanel.getDateValue(newdate),
				}));

				// if (i == 0) obj.attr('selected', 'selected');
			};

			$('#csv-con').append(" <label>c <input id='csv-daystart' placeholder='от' style='width: 30px;'></input></label>");
			$('#csv-con').append(" <label>по <input id='csv-dayend' placeholder='до' style='width: 30px;'></input></label><br>");


			$('#csv-con').append(" <table class='noborder'>\
						<tr valign='top'>\
							<td>\
								<label> Категории:<br>\
									<select id='csv-cat' multiple='multiple'></select>\
								</label>\
							</td>\
							<td>\
								<label> Статусы:<br>\
									<select id='csv-status' onChange='apanel.statex_csv.doStatusChange();' multiple='multiple' size='4'>\
											<option value='sent' selected>Отправленные</option>\
											<option value='paid' selected>Оплаченные</option>\
											<option value='returned' selected>Возвраты</option>\
											<option value='processed'>Обработанные</option>\
											<option value='accepted'>Принятые</option>\
											<option value='special'>Доставки и гарантии</option>\
									</select>\
								</label>\
							</td>\
							<td>\
								Разное:<br>\
								<label> Выводить апселы: <input type='checkbox' id='csv-upsell' value='1'></label><br>\
								<label> Выводить итоги по категориям: <input type='checkbox' id='csv-summary' value='1'></label><br>\
								<label> Выводить только итоги: <input type='checkbox' id='csv-onlysummary' value='1'></label><br>\
							</td>\
						</tr>\
						</table>");

			apanel.statex_csv.doDateChange();

			$('#csv-con').append(" <br>");

			$('#csv-con').append($('<button>', {
				text: "Скачать CSV",
				class: "btn-success",
				onclick: "apanel.statex_csv.getCsv();",
			}));
		},
	},

	// Подготовка таблиц, парсинг БД
	statex_prepare: {
		start: function () {
			console.log('statex_prepare');

			$('#tabs').hide();
			$('#charts').empty().append(
				'<div class="statex_viewport">\
					<table id = "statex_maintable" class= "categories-table" ></table>\
				</div>\
				<div id="statex_zoom"></div>');
			$('#statex_maintable').empty();

			$("#statex_maintable").append($('<button>', {
				text: "Запустить импорт данных",
				class: "btn-warning",
				onclick: "apanel.statex_prepare.doPrepare()",
			}));

		},

		doPrepare: function() {
			$('#statex_maintable').append("<h3>Идёт обработка данных...</h3>");
			apanel.statex_prepare.query();
		},

		query: function () {
			//сбор и подгтовка данных из всех таблиц
			var json = {
				func: 'CStatEx',
				domain: JSCat.domain,
				token: JSCat.token,
				action: "prepare",
			};
			console.log('statex_prepare: querying..');
			getJsonResult(json, apanel.statex_prepare.table);
		},

		table: function (queryResult) {
			$('#statex_maintable').empty();

			if (queryResult) {

				$("#statex_maintable").append(
					'<tr role="row">\
					<th>Таблица</th>\
					<th>Импортировано записей</th>\
					<th>Результат импорта</th>\
					<th>Ошибки импорта</th>\
				</tr>');

				for (let b in queryResult) {
					$("#statex_maintable").append(
						'<tr role="row">\
					<td>' + queryResult[b][0] + '</td>\
					<td>' + queryResult[b][1] + '</td>\
					<td>' + queryResult[b][2] + '</td>\
					<td>' + queryResult[b][3] + '</td>\
				</tr>');
				}

			} else {
				$("#statex_maintable").append('<tr role="row">\
				<td class="empty-data">Нет данных</td>\
			</tr>');
			}

		},
	},

	// Вывод статистики
	statex_current: {
		//инициализирует вывод таблицы категорий
		start: function () {
			console.log('statex_current');
			$('#tabs').show();
			$('#charts').empty().append(
				'<div class="statex_viewport">\
					<table id = "statex_maintable" class= "categories-table" ></table>\
				</div>\
				<div id="statex_zoom"></div>');

			//рабочая дата = текущий месяц
			$("#datetabs button")[0].click();
			// var queryResult =
			// apanel.statex_current.queryCategories();
		},

		//Запрашивает и выводит всех продавцов данного товара
		querySellers: function (skipCache, nGoodId) {
			//полная статистика
			var json = {
				func: 'CStatEx',
				domain: JSCat.domain,
				token: JSCat.token,
				action: "listSellers",
				par: {
					"date_range": apanel.getDateRange(),
					"good_id": nGoodId,
					"skip_cache": (skipCache) ? 1 : 0,
				},
			};

			console.log('statex_current: querying sellers for good [' + nGoodId + ']..(use cache: %s)', !skipCache);
			getJsonResult(json, apanel.statex_current.tableSellers, nGoodId);

			// apanel.statex_current.tableSellers(nGoodId, parsedJsonResult);
		},


		// выводит таблицу с продавцами данного товара
		tableSellers: function (queryResult, nGoodId) {
			let sResult = '';

			if (queryResult) {
				// sResult = sResult + apanel.statex_current.thGoods();
				if (typeof queryResult['message'] != 'undefined') {
					apanel.showMessage(queryResult['message']);
					delete queryResult.message;
				}

				for (let b in queryResult) {
					let row = queryResult[b];

					let aWeeks = apanel.statex_current.subtableWeeks(row);

					let sWeeksTotal = aWeeks['total'];
					let sWeeksPaid = aWeeks['total_paid'];
					let sWeeksRatio = aWeeks['ratio'];

					sResult = sResult + (
						'<tr role="row" class="sellers-table" id="sellers' + row['good_id'] + "_" + row['webmaster_id'] + '">\
					<td class="wmid">webmaster <b>' + row['webmaster_id'] + '</b> </td>\
						<td>' + row['avg_cheque'] +
						'</td>\
						<td>' +
						'<table class="statex_subcount">' +
						sWeeksPaid +
						sWeeksTotal +
						sWeeksRatio +
						'</table>' +
						'</td>\
							<td class="statex_rating" style="background-color:' + row['pr_color'] + '">' + row['profit'] + '</td>\
							<td class="statex_byday" onClick="apanel.statex_current.querySellersByDay(event, ' + row['good_id'] + ', \'' + row['webmaster_id'] + '\');" id="byday_sellers_' + row['webmaster_id'] + '"  title="Веб по дням">\
							<i class="fa fa-search"></i>\
							</td>\
				</tr>\
				');
				}


			} else {
				sResult = sResult + ('<tr role="row">\
				<td class="empty-data" colspan=4>Нет данных для товара (' + nGoodId + ')</td>\
				</tr>');
			}

			sResult = sResult + '';


			if ($('#byday_details_goods' + nGoodId).length > 0) {
				$('#byday_details_goods' + nGoodId).after(sResult);
			} else
				$('#goods' + nGoodId).after(sResult);
		},


		//Запрашивает и выводит все товары в даной категории

		queryGoods: function (skipCache, nCategoryId) {
			var json = {
				func: 'CStatEx',
				domain: JSCat.domain,
				token: JSCat.token,
				action: "listGoods",
				par: {
					"category_id": nCategoryId,
					"date_range": apanel.getDateRange(),
					"skip_cache": (skipCache) ? 1 : 0,
				},
			};


			console.log('statex_current: querying goods in category [' + nCategoryId + '].. (use cache: %s)', !skipCache);
			getJsonResult(json, apanel.statex_current.tableGoods, nCategoryId);
			// apanel.statex_current.tableGoods(parsedJsonResult, nCategoryId);
		},


		//выводит все товары в даной категории
		tableGoods: function (queryResult, nCategoryId) {
			let sResult = '<tbody id="cat' + nCategoryId + '">';

			if (queryResult) {

				if (typeof queryResult['message'] != 'undefined') {
					apanel.showMessage(queryResult['message']);
					delete queryResult.message;
				}

				for (let b in queryResult) {
					let row = queryResult[b];
					// сonsole.log(queryResult);

					let aWeeks = apanel.statex_current.subtableWeeks(row);

					let sWeeksTotal = aWeeks['total'];
					let sWeeksPaid = aWeeks['total_paid'];
					let sWeeksRatio = aWeeks['ratio'];

					sResult = sResult + (
						'<tr role="row" class="goods-table" id="goods' + row['id'] +
						'" onClick="apanel.statex_current.showGoods(event, ' + row['id'] + ')" title="Показать вебов для этого товара">\
					<td class="goodid"><i class="fa fa-plus fap" id="icon-g' + row['id'] + '"></i><a href="#goods:' +
						row['id'] + '">' + row['name'] + '</a></td>\
					<td>' + row['avg_cheque'] + '</td>\
					<td style="background-color:' + row['color'] + '">' +
						'<table class="statex_subcount">' +
						sWeeksPaid +
						sWeeksTotal +
						sWeeksRatio +
						'</table>' +
						'</td>\
						<td class="statex_rating" style="background-color:' + row['pr_color'] + '">' + row['profit'] + '</td>\
						<td class="statex_byday" onClick="apanel.statex_current.queryGoodsByDay(event, ' + nCategoryId + "," + row['id'] + ');" id="byday_goods_' + row['id'] + '"  title="Товар по дням">\
						<i class="fa fa-search"></i>\
							</td>\
				</tr>'
					);
					//
				}


			} else {
				sResult = sResult + ('<tr role="row">\
					<td class="empty-data" colspan=4>Нет данных в категории (' + nCategoryId + ')</td>\
				</tr>');

			}

			sResult = sResult + '</tbody>';

			if ($('#byday_details_cat' + nCategoryId).length > 0) {
				$('#byday_details_cat' + nCategoryId).after(sResult);
			} else
				$('#category' + nCategoryId).after(sResult);
		},



		/**
		 * запрашивает и выводит список категорий
		 * @param skipCache bool -  если true, то грузим результаты по-новой, не из кеша
		 * */

		queryCategories: function (skipCache) {
				var json = {
					func: 'CStatEx',
					domain: JSCat.domain,
					token: JSCat.token,
					action: "listCategories",
					par: {
						"date_range": apanel.getDateRange(),
						"skip_cache": (skipCache) ? 1 : 0,
					},
				};
			console.log('statex_current: querying categories.. (use cache: %s)', !skipCache);

			getJsonResult(json, apanel.statex_current.tableCategories);
		},

		queryCategoryByDay: function (event, nCategoryId) {
			skipCache = event.shiftKey;
			var json = {
				func: 'CStatEx',
				domain: JSCat.domain,
				token: JSCat.token,
				action: "listCategoryByDay",
				par: {
					"date_range": apanel.getDateRange(),
					"category_id": nCategoryId,
					"skip_cache": (skipCache) ? 1 : 0,
				}
			};
			console.log('statex_current: querying category [%f] by day.. (use cache: %s)', nCategoryId, !skipCache);

			let aParams = {
				"id": nCategoryId,
				"show": "cat",
				"showPF": 1,
			};
			getJsonResult(json, apanel.statex_current.showByDayTable, aParams);
		},

		queryGoodsByDay: function (event, nCategoryId, nGoodId) {
			skipCache = event.shiftKey;
			var json = {
				func: 'CStatEx',
				domain: JSCat.domain,
				token: JSCat.token,
				action: "listGoodsByDay",
				par: {
					"date_range": apanel.getDateRange(),
					"category_id": nCategoryId,
					"good_id": nGoodId,
					"skip_cache": (skipCache) ? 1 : 0,
				}
			};
			console.log('statex_current: querying good [%f] in category [%f] by day.. (use cache: %s)', nGoodId, nCategoryId, !skipCache);

			let aParams = {
				"id": nGoodId,
				"show": "goods",
				"showPF": 1,
			};
			getJsonResult(json, apanel.statex_current.showByDayTable, aParams);
		},

		querySellersByDay: function (event, nGoodId, nWmId) {
			skipCache = event.shiftKey;
			var json = {
				func: 'CStatEx',
				domain: JSCat.domain,
				token: JSCat.token,
				action: "listSellersByDay",
				par: {
					"date_range": apanel.getDateRange(),
					"good_id": nGoodId,
					"wm_id": nWmId,
					"skip_cache": (skipCache) ? 1 : 0,
				}
			};
			console.log('statex_current: querying seller [%f] of good [%f] by day.. (use cache: %s)', nWmId, nGoodId, !skipCache);

			let aParams = {
				"id": nGoodId + "_" + nWmId,
				"show": "sellers",
				"showPF": 1,
			};
			getJsonResult(json, apanel.statex_current.showByDayTable, aParams);
		},


		/**
		Возвращает объект с таблицми с значениями по неделям
		Всё содержимое таблиц - ряды, ячейки, кроме внешнего <table...> </table>
		*/
		subtableWeeks: function (queryRow) {
			let nWeekCount = parseInt(queryRow['week_count']);

			let sWeeksTotal = "<th class='th2'>" + queryRow['total'] + "</th>";
			let sWeeksPaid = "<th class='th2'>" + queryRow['total_paid'] + "</th>";
			let sWeeksRatio = "<th class='th2'>" + queryRow['ratio'] + "%</th>";

			for (let c = 1; c <= nWeekCount; c++) {
				let sWeek = (typeof queryRow['week_total' + c] == 'undefined') ? 0 : queryRow['week_total' + c];
				sWeeksTotal += (sWeek > 0) ? "<td class='td1'>" + sWeek + "</td>" :
					"<td class='td0'>" + sWeek + "</td>";

				let sPaid = (typeof queryRow['week_paid' + c] == 'undefined') ? 0 : queryRow['week_paid' + c];
				sWeeksPaid += (sPaid > 0) ? "<td class='td1'>" + sPaid + "</td>" :
					"<td class='td0'>" + sPaid + "</td>";

				let sRatio = (sWeek > 0) ? sPaid / sWeek : 0;
				sRatio = Math.round(sRatio * 100);
				sWeeksRatio += (sRatio > 0) ? "<th class='th1' style='background-color: " + queryRow['week_color' + c] + ";' title='" + queryRow['week_profit' + c]+"'>" + sRatio + "%</th>" :
					"<th class='th1' style='background-color: " + queryRow['week_color' + c] + ";' title='" + queryRow['week_profit' + c]+"'>" + sRatio + "%</th>";
			}

			sWeeksPaid = "<tr><th class='th0'>В</th>" + sWeeksPaid + "</tr>";
			sWeeksTotal = "<tr><th class='th0'>О</th>" + sWeeksTotal + "</tr>";
			sWeeksRatio = "<tr><th class='th0'>%</th>" + sWeeksRatio + "</tr>";

			let aResult = {
				'total': sWeeksTotal,
				'total_paid': sWeeksPaid,
				'ratio': sWeeksRatio
			};

			return aResult;
		},



		//выводит список категорий
		tableCategories: function (queryResult) {
			$('#statex_maintable').empty();


			//queryResult[0]['id'] == "0" означает, что у нас нет продаж вообще
			if (queryResult && (queryResult[0]['id'] != "0")) {
				if (typeof queryResult['message'] != 'undefined') {
					apanel.showMessage(queryResult['message']);
					delete queryResult.message;
				}

				$("#statex_maintable").append(
					'<tr role="row">\
					<th>Категория</th>\
					<th style="width: 160px;">Средний чек</th>\
					<th style="width: 360px; text-align: center;">Выкупы / Отправки / Процент выкупа</th>\
					<th style="width: 60px;">Рейтинг</th>\
					<td style="width: 20px;" class="invis"></td>\
				</tr>'); //'+queryResult[0]['week_count']+'

				for (let b in queryResult) {
					// if (b == "message") continue;
					let row = queryResult[b];
					let nCategoryId = row['id'];

					let aWeeks = apanel.statex_current.subtableWeeks(row);

					let sWeeksTotal = aWeeks['total'];
					let sWeeksPaid = aWeeks['total_paid'];
					let sWeeksRatio = aWeeks['ratio'];

					if (b != "summary") {
						$("#statex_maintable").append(
							'<tr role="row" class="foldrow" id="category' + nCategoryId +
							'"  onClick="apanel.statex_current.showCategory(event, ' + nCategoryId + ')" title="Показать товары этой категории">' +
							'<td><i class="fa fa-plus fap" id="icon' + nCategoryId + '"></i><b><a href="#cat:' + nCategoryId + '"' + '>' +
							row['category_name'] + '</a></b></td>\
							<td>' + row['avg_cheque'] + '</td>\
							<td class="statex_rating">\
								<table class="statex_subcount">' +
							sWeeksPaid +
							sWeeksTotal +
							sWeeksRatio +
							'</table>\
							</td>' +
							'<td class="statex_rating" style="background-color:' + row['pr_color'] + '">' + row['profit'] + '</td>' +
							'<td class="statex_byday" onClick="apanel.statex_current.queryCategoryByDay(event, ' + nCategoryId + ')" id="byday_cat_' + nCategoryId + '" title="Категория по дням">\
							<i class="fa fa-search"></i>\
							</td>' +

							'</tr>'
						);
					} else {
						let aWeeks = apanel.statex_current.subtableWeeks(row);

						let sWeeksTotal = aWeeks['total'];
						let sWeeksPaid = aWeeks['total_paid'];
						let sWeeksRatio = aWeeks['ratio'];

						$("#statex_maintable").append(
							'<tr role="row" id="category0">\
								<th>ИТОГО:</th>\
								<th style="width: 160px;">' + row['avg_cheque'] + '</th>\
								<th style="width: 360px; text-align: center;" class="statex_rating" style="background-color:' + row['color'] + '">' +
							'<table class="statex_subcount">' +
							sWeeksPaid +
							sWeeksTotal +
							sWeeksRatio +
							'</table>\
								</th>\
								<th class="statex_rating" style="background-color:' + row['pr_color'] + '">' + row['profit'] + '</th>\
								<td class="statex_byday" onClick="apanel.statex_current.queryCategoryByDay(event, 0)" id="byday_cat_0">\
								<i class="fa fa-search"></i>\
								</td>\
							</tr>'
						);
					}
				}

			} else {
				$("#statex_maintable").append('<tr role="row">\
					<th class="empty-data">Нет данных</th>\
				</tr>\
				<tr role="row">\
					<td class="empty-data">Выберите другой период</td>\
				</tr>');
			}

			// $("#statex_zoom").empty();

		},

		/**
		 * выводит информацию по дням в горизонтальном виде
		 * @param queryResult
		 * @param aParams.id
		 * @param aParams.show
		 */
		tableByDayH: function (queryResult, aParams) {
			// console.log(queryResult);
			let nId = aParams.id;
			let show = aParams.show;
			let showPF = aParams.showPF;

			let exClass = "";
			if (show == "goods") {
				exClass = "l2";
			} else if (show == "sellers") {
				exClass = "l3";
			} else {
				exClass = "l1";
			}

			let sDayTable = [];
			let nMaxDays = parseInt(queryResult['max_days']);
			let daysPerRow = (nMaxDays > 30) ? 16 : 15;

			for (let b in queryResult) {
				let row = queryResult[b];
				// console.log(row);
				if (typeof row['day_num'] != 'undefined') {
					row['day_num'] = parseInt(row['day_num']);
					let sRatio = Math.round(row['ratio']) + "%";
					let sPlanFact = "";
					if (showPF == 1) {
						if (row["planfact"] == "1") {
							sPlanFact = '<i class="fa fa-arrow-up sx-green"></i>';
							sPlanFact += "(" + row['plan'] + ")";
							sPlanFact = "<br><nowrap>" + sPlanFact + "</nowrap>";
						} else if (row["planfact"] == "0"){
							sPlanFact = '<i class="fa fa-arrow-down sx-red"></i>';
							sPlanFact += "(" + row['plan'] + ")";
							sPlanFact = "<br><nowrap>" + sPlanFact + "</nowrap>";
						} else {
							sPlanFact = '<br><i class="fa fa-clock-o sx-grey"></i>';
						}


						// sPlanFact += "<br><nowrap>" + row["pfdebug"] + "</nowrap>";
					}

					sDayTable[row['day_num']] = "<td class='td1'>" + row['total_paid'] + sPlanFact + "</td>" +
						"<td class='td1'>" + row['total'] + "</td>" +
						"<td style='background-color:" + row["pr_color"] + "' title='"+ row["profit"]+ "'>" + sRatio + "</td>";
				}
			}

			let sResult = "";
			let sTD = "";
			let sTH = "";
			let nDay = 0;

			for (let i = 0; i < nMaxDays; i++) {
				nDay = i + 1;

				if (typeof sDayTable[nDay] != 'undefined') {
					sTH += "<th colspan=3 class="+exClass+">" + nDay + "</th>\n";
					sTD += sDayTable[nDay] + "\n";
				} else {
					sTH += "<th colspan=3 class="+exClass+">" + nDay + "</th>\n";
					sTD += "<td colspan=3>&nbsp;</td>\n";
				}

				if (nDay % daysPerRow == 0) {
					sResult += "<tr>" + sTH + "</tr>\n" +
						"<tr>" + sTD + "</tr>\n";

					sTD = "";
					sTH = "";
				}

			}

			if (sTH != "") {
				sResult += "<tr>" + sTH + "</tr>\n" +
					"<tr>" + sTD + "</tr>\n";
			}

			sResult = "\
							<tr id='byday_details_" + show + nId + "'>\
							<td colspan=4 class='byday_" + exClass +"'>\
								<table class='statex_byday'>" + sResult + "</table>\
							</td>\
							<td class='invis'></td>\
							</tr>\n";

			// console.log(sResult);
			if (show == "cat") {
				showTarget = '#category' + nId;
			} else if (show == "goods") {
				showTarget = '#goods' + nId;
			} else if (show == "sellers") {
				showTarget = '#sellers' + nId;
			} else {
				console.error("Unknown target: %s", showTarget);
			}

			$(sResult).insertAfter($(showTarget));

			return;
		},




		//подсвечивает текущую выбранную категорию
		showCategory: function (e, nCategoryId) {
			//если нажата кнопка с id byday_xxxx - событие отработает она сама
			sCallerId = $(event.toElement).attr('id');
			if (sCallerId && sCallerId.substr(0, 5) == "byday") {
				return;
			}
			if (e.shiftKey) {
				$('#cat' + nCategoryId).remove();
			}

			//если эту категорию ещё не выводили - грузим список товаров в ней
			if (!$('#cat' + nCategoryId).length) {
				apanel.statex_current.queryGoods(e.shiftKey, nCategoryId);
				$('#icon' + nCategoryId).attr("class", "fa fa-minus fap");
				// $('#category' + nCategoryId).css("background-color", "#e0e9f6");
				$('#category' + nCategoryId).addClass('unfolded');

			} else {
				// если уже выводили - прячем, если показана
				if ($('#cat' + nCategoryId).css('display') != 'none') {
					$('#icon' + nCategoryId).attr("class", "fa fa-plus fap");
					// $('#category' + nCategoryId).css("background-color", "");
					$('#category' + nCategoryId).removeClass('unfolded');
					$('#cat' + nCategoryId).hide('fast');
					// если уже выводили - показываем, если спрятана
				} else {
					// $('#icon' + nCategoryId).attr("class", "fa fa-minus fap");
					$('#icon' + nCategoryId).attr("class", "fa fa-minus fap");
					// $('#category' + nCategoryId).css("background-color", "#e0e9f6");
					$('#category' + nCategoryId).addClass('unfolded');
					$('#cat' + nCategoryId).show('fast');
				}
			}
		},

		//подсвечивает текущий выбранный товар
		showGoods: function (e, nGoodId) {
			//если нажата кнопка с id byday_xxxx - событие отработает она сама
			sCallerId = $(event.toElement).attr('id');
			if (sCallerId && sCallerId.substr(0, 5) == "byday") {
				return;
			}
			let sellersRow = $('[id^="sellers' + nGoodId + '"]');
			let sellersDet = $('[id^="byday_details_sellers' + nGoodId + '"]');

			if (e.shiftKey) {
				$(sellersRow).remove();
			}


			if (!sellersRow.length) {
				apanel.statex_current.querySellers(e.shiftKey, nGoodId);
				$('#icon-g' + nGoodId).attr("class", "fa fa-minus fap");
			} else {
				$('#icon-g' + nGoodId).attr("class", "fa fa-plus fap");

				// если уже выводили - прячем, если показана
				if ($(sellersRow[0]).css('display') != 'none') {
					$('#icon-g' + nGoodId).attr("class", "fa fa-plus fap");
					$(sellersRow).hide('fast');
					$(sellersDet).hide('fast');
					// если уже выводили - показываем, если спрятана
				} else {
					$('#icon-g' + nGoodId).attr("class", "fa fa-minus fap");
					$(sellersRow).show('fast');
					$(sellersDet).show('fast');
				}
			}
		},

		/**
		* выводит информацию по дням для выбранного элемента
	   *
		* @param qResult - массив с данными
		* @param aParams.id - id элемента, после которого отображать табличку
		* @param aParams.show - тип элемента (cat, sellers, goods), после которого отображать табличку
	   */
		showByDayTable: function (qResult, aParams) {
			nId = aParams.id;
			show = aParams.show;

			if (typeof qResult['message'] != 'undefined') {
				apanel.showMessage(qResult['message']);
				delete qResult.message;
			}

			//если эту категорию ещё не выводили - грузим список товаров в ней;
			if (!$('#byday_details_' + show + nId).length) {
				apanel.statex_current.tableByDayH(qResult, aParams);
				$('#byday_' + show + "_" + nId).css('cursor','zoom-out');
			} else {
				// если уже выводили - прячем, если показана
				if ($('#byday_details_' + show + nId).css('display') != 'none') {
					$('#byday_details_' + show + nId).hide('fast');
					$('#byday_' + show + "_" + nId).css('cursor','zoom-in');
					// если уже выводили - показываем, если спрятана
				} else {
					$('#byday_details_' + show + nId).show('fast');
					$('#byday_' + show + "_" + nId).css('cursor','zoom-out');
				}
			}
		},
	},
}

$(function () {
	apanel = new apanel();
	apanel.builder();
	$(window).scroll(function () {
		let st = $(window).scrollTop();
		if (st > 0) {
			$("#statex_zoom").css("margin-top", $(window).scrollTop() - 20).animate({
				"margin-top": $(window).scrollTop() - 130
			}, 100);
		} else {
			$("#statex_zoom").css("margin-top", 0);
		}
	});


	//исправляет глобальный стиль из crm.css
	$("<style type='text/css'> #cabinet table { border-collapse: separate !important;} </style>").appendTo("head");
});