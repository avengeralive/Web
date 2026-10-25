<?php namespace lib;
	if (!in_array('admin', $RoleUser) && !in_array('admin', $RoleGroup)) die();	
?>

<div id="top">
	<h1>Справочники
		<i class="radios little" style="float: right;"><label id="add">Создать справочник</label>
		</i>
		<i>Многоцелевой шаблон, предназначенный для редактирования справочников. Не изменяйте содержимое, это нарушит работу CRM</i>
   </h1>
</div>
<div id="cat"></div>
<div id="list"></div>
<div id="detail"></div>

<script>

function apanel(params) {
	$.extend(this.options, params);
}

apanel.prototype = {
    build: '1.0',
    cfg: {
        url: {
            querypanel: 	'CPanel',
            querymail: 		'CEmail',
            querymenu: 		'menuAdm',
            querystat: 		'CStat',
            queryuser: 		'CUser'
        },
        selectors:	{
        	siteeditor:		'siteeditor',
        	analytics:		'analytics',
        	seo:			'seo',
        	face:			'face',
        	dbsettings:		'dbsettings',
        	users:			'users',
        	casheclear:		'casheclear',
        	gallery:		'gallery',
        	modules:		'modules',
        	menus:			'menus',
        	crumbs:			'crumbs',
        	category:		'category',
        	catalogue:		'catalogue',
        	feed:			'feed',
        	importxml:		'importxml',
        	emails:			'emails',
        	license:		'license',
        	
        	close:			'.close'
		}
    },
	catalogue: {
		start:	function() {
		   $("#add").click(apanel.catalogue.action.add.bind(this));
			$('#list, #cat').empty();
			$('#import_xml, #import, h2[m], #list2').remove();
			var json = {func:apanel.cfg.url.querypanel, domain:JSCat.domain, token:JSCat.token};
			json["action"] 	= "listBase2";
			$.post("/json/", json, function(result) {
				if (typeof result !== 'object') result = JSON.parse(result);
				for (list in result) {
					if (result[list] != 'false') {
						$("#list").append('<div class="list"><span><a href="#cat' + result[list].domain_id + '" id="cat' + result[list].domain_id + '">' + result[list].title + '</a></span><span>' + result[list].domain_id + '</span></div>');
						$("#cat" + result[list].domain_id).click(apanel.catalogue.setting.bind(this, result[list]))
					}
				}	            
			});
		},
		action:	 {
			onoff:	function(id) {
    			var checked = ($("#on" + id).prop('checked')) ? '1' : '0';
				var json = {func:apanel.cfg.url.querypanel, domain:JSCat.domain, token:JSCat.token};
				json["action"] 	= "offBase";
				json["param"] 	= [id, checked];
				$.post("/json/", json, function(){});
			},
			add: function() {
				var json = {func:apanel.cfg.url.querypanel, domain:JSCat.domain, token:JSCat.token};
				json["action"] 	= "newBase";
				$.post("/json/", json, function() {
					alert('Новый каталог добавлен')
	            });
	        },
	        remove: function(id) {
				confirm({
					text: "Удалить раздел?",
					ok: function() {
						var json = {func:apanel.cfg.url.querypanel, domain:JSCat.domain, token:JSCat.token};
						json["action"] 			= "deleteBase";
						json["value"] 			= id;
						$.post("/json/", json, function(){
	    			        apanel.catalogue.start();
						});
					}
				});
			},
			rename: function(list, title) {
				var param = [list.domain_id, title];
				var json = {func:apanel.cfg.url.querypanel, domain:JSCat.domain, token:JSCat.token};
				json["action"] 	= "titleBase";
				json["param"] 	= param;
				$.post("/json/", json, function() {});
			},
			moderation: function(id) {
				var moder = $('#moderation option:selected').attr('value');
				var json = {func:apanel.cfg.url.querypanel, domain:JSCat.domain, token:JSCat.token};
				json["action"] 		= "moderMode";
				json["param"] 		= [id, moder];
				$.post("/json/", json, function() {});
			},
// 			position: function(id) {
// 				var pos = $('#position option:selected').attr('value');
// 				var json = {func:apanel.cfg.url.querypanel, domain:JSCat.domain, token:JSCat.token};
// 				json["action"] 		= "selectPosition";
// 				json["param"] 		= [id, pos];
// 				$.post("/json/", json, function() {});
// 			},
			savetemplate: function(id, html, code) {
				var json = {func:apanel.cfg.url.querypanel, domain:JSCat.domain, token:JSCat.token};
				json["action"] 		= "savelisttemplate";
				json["template"] 	= html;
				json["html"] 		= code.getValue();
				json["list"] 		= id;
				$.post("/json/", json, function() {
					alert("Выполнено")
				});
			},
			changenotify: function(list) {
				var show = ($("#notify_admin").is(':checked')) ?  'inline' : 'none';
	    		$(".notify_mail").css('display', show);
	    			
	    		//данные для отправки на сервер
	    		admin = $("#notify_admin").is(':checked') ? 1 : 0;
	    		owner = $("#notify_owner").is(':checked') ? 1 : 0;
	    		maily = $("#notify_mail").val();
	    	
	    		//отправка на сервер
				var json = {func:apanel.cfg.url.querymail, domain:JSCat.domain, token:JSCat.token};
        		json["action"] 	= 'list_notify';
        		json["param"] 	= [list.domain_id, owner, admin, maily];
				$.post("/json/", json, function(a) {});
			},
			getnotify: function(list) {
    			var mail = list.email.split("_");
    			if (mail[0] != "0") $("#notify_owner").prop("checked", true);
    			if (mail[1] != '0') {
    				$("#notify_admin").prop("checked", true);
    				//получение списка email
					var json = {func:apanel.cfg.url.querymail, domain:JSCat.domain, token:JSCat.token};
        			json["action"] 	= 'mail_list';
					$.post("/json/", json, function(a) {
						if (typeof a !== 'object') a = JSON.parse(a);
	        			$('.baseinform').append('<br><span class="notify_mail">Шаблон e-mail </span><select class="notify_mail" id="notify_mail"></select>');
	        	   		for (var b in a) {
            			    $('#notify_mail').append('<option value="' + a[b].domain_id + '">' + a[b].name + '</option>');
        			    }
    					$("#notify_mail").val(mail[2]);
    					$('#notify_mail').change(apanel.catalogue.action.changenotify.bind(this, list));
					});
    			}
			},
			savefield: function(field, list) {
				var json = {func:apanel.cfg.url.querypanel, domain:JSCat.domain, token:JSCat.token};
				json["action"] = "saveField";
				json["idbase"] = list.domain_id;
				json["param"] = $('#examples').val();
				json["id"] = field.id;
				json["caption"] = $('#caption').val();
				json["type_field"] = $('[name="typer"]:checked').val();
				json["required"] = $('#required').prop("checked");
				json["operator"] = $('#operator').prop("checked");
				json["show"] = $('#show').prop("checked");
				json["searchtext"] = $('#searchtext').prop("checked");
				$.post("/json/", json, function(result) {
					$('#call_edit').hide();
					apanel.catalogue.listfield(list);
					alert("Выполнено")
				});
			},
			removefield: function(field, list) {
				confirm({
					text: "Удалить: " + field.caption + " ?",
					ok: function() {
						var json = {func:apanel.cfg.url.querypanel, domain:JSCat.domain, token:JSCat.token};
						json["action"] 			= "deleteField";
						json["namedelfield"] 	= field.name_field;
						json["idbase"] 			= list.domain_id;
						$.post("/json/", json, function(){
	        		        $('#call_edit').hide();
	        		    	apanel.catalogue.listfield(list);
						});
					}
				});
			},
			addfield: function(list) {
				var json = {func:apanel.cfg.url.querypanel, domain:JSCat.domain, token:JSCat.token};
				json["action"] 			= "addField";
				json["type"] 			= "text";
				json["list"] 			= list.domain_id;
				$.post("/json/", json, function(){
					apanel.catalogue.listfield(list);
				});
			},
			changetemplate: function(list) {
				var html = 'html' + $('#changetemplate').val();
				var Area = document.createElement("textarea");
				Area.className = 'Editor';
				Area.value = list[html];
				$('#list').empty().append(Area);
				var code = CodeMirror.fromTextArea(Area, {
					lineNumbers: true,
					matchBrackets: true,
					styleActiveLine: true,
					mode : "xml"
				});
				
				//сохранить html
				$('.CodeMirror, .CodeMirror-gutters').css({'height':'100%'});
				$('.radios [radios="save"]').off().click(apanel.catalogue.action.savetemplate.bind(this, list.domain_id, html, code));
			}
		},
		fieldsetting: function(field, list) {
			$('#call_edit').show();
			
			var typer = ['text', 'textarea', 'textint', 'checkbox', 'radiobtn', 'fotoalbum', 'select', 'youtube', 'yandex', 'selectmenu', 'some', 'table'];
			
			$('#list_edit').empty().append('<label>Название</label><input id="caption" value="' + field.caption + '" type="text">\
						<textarea id="examples" placeholder="Дополнительные параметры">' + field.param + '</textarea>\
        				<label>Тип поля</label><div class="inputeditor"></div>\
						<label>ID поля: ' + field.name_field + '</label><br>\
						<label><input id="show" type="checkbox"> Разрешить доступ</label>\
						<label><input id="operator" type="checkbox"> Разрешить редактирование</label>\
						<label><input id="required" type="checkbox"> Обязательное поле</label>\
						<label><input id="searchtext" type="checkbox"> Текстовый поиск</label><br>\
						<button id="savefield">Сохранить</button><button id="removefield">Удалить</button><button onclick="$(\'#call_edit\').hide()">Отмена</button>');			

			for (name in typer) {
				$('.inputeditor').append('<label><input type="radio" name="typer" value="'+ typer[name] +'">'+ typer[name] +'</label>');
				if (typer[name] == field.type_field) $('[value="'+ typer[name] +'"]').prop('checked', true);
			}
				
			$('#required').prop('checked', (field.required == '1'));
			$('#searchtext').prop('checked', (field.searchtext == '1'));
			$('#operator').prop('checked', (field.operator == '1'));
			$('#show').prop('checked', (field.show == '1'));
			
			$('#savefield').click(apanel.catalogue.action.savefield.bind(this, field, list));
			$('#removefield').click(apanel.catalogue.action.removefield.bind(this, field, list));
		},
		setting: function(list) {
    		$("#baseh").remove();
    		$(".list").removeClass('baseh');

    		var baseh = '<div id="baseh">';
    		baseh += '		<div class="top"><div id="dbname">';
    		baseh += '			<input class="ios8" id="on' + list.domain_id + '" value="1" checked="' + list.published + '" type="checkbox" /><label for="on' + list.domain_id + '"></label>';
    		baseh += '			<input type="text" value="' + list.title + '" /><span class="input-buffer"></span><btn>Сохранить</btn></div>';
    		baseh += '		</div><div class="linkbase">';
    		baseh += '			<li id="html' + list.domain_id + '">HTML разметка</li>';
    		baseh += '			<li>Модерация <select id="moderation"></select></li>';
    		//baseh += '			<li>Позиция в шаблоне <select id="position"></select></li>';
    		baseh += '			<!--li id="remove' + list.domain_id + '">Удалить каталог</li-->';
    		baseh += '		</div><div class="baseinform"><span>E-mail оповещения</span>';
    		baseh += '			<label><input id="notify_owner" type="checkbox">Оповещать автора при добавлении новой записи</label>';
    		baseh += '			<label><input id="notify_admin" type="checkbox">Оповещать администратора о новых записях в каталоге</label>';
    		baseh += '		</div></div>';
    		
    		$('#cat' + list.domain_id).parent().parent().addClass('baseh').append(baseh);
    		$("#html" + list.domain_id).click(apanel.catalogue.html.bind(this, list));
    		$("#remove" + list.domain_id).click(apanel.catalogue.action.remove.bind(this, list.domain_id));
    		$('#on' + list.domain_id).change(apanel.catalogue.action.onoff.bind(this, list.domain_id));
    		$('#notify_owner, #notify_admin').change(apanel.catalogue.action.changenotify.bind(this, list));
    		apanel.catalogue.action.getnotify(list);
			
			var moder = {
// 				1: 'Подтверждение Email',
// 				2: 'Подтверждение телефона',
// 				3: 'Капча',
				4: 'Вручную',
				5: 'Без модерации'
			}
			for (key in moder) {
				$('#moderation').append('<option value="' + key + '">' + moder[key] + '</option>');
				$("#moderation option[value=" + list.moderation + "]").attr('selected', 'true');
				$('#moderation').change(apanel.catalogue.action.moderation.bind(this, list.domain_id));
			}
			
// 			var json = {func:apanel.cfg.url.querypanel, domain:JSCat.domain, token:JSCat.token};
// 			json["action"] = "Get_Position";
// 			$.post("/json/", json, function(poslist) {
// 				if (typeof poslist !== 'object') poslist = JSON.parse(poslist);
// 				for (key in poslist)
// 					$('#position').append('<option value="' + poslist[key] + '">' + poslist[key] + '</option>');
// 				
// 				$("#position option[value=" + list.position + "]").attr('selected', 'true');
// 				$('#position').change(apanel.catalogue.action.position.bind(this, list.domain_id));
// 			});
	
    		$('#dbname input[type="text"]').on('input', function() {
				var item = $(this);
			    $('.input-buffer').text(item.val());
			    item.width($('.input-buffer').width()).css("border-color", "#d2d2d2");
        		$('#dbname btn').css("opacity", "1");
			});
    		$("#dbname btn").click(function() {
				var title = $('#dbname input[type="text"]').val();
				if (title != '') {
					$('#dbname input[type="text"]').css("border-color", "transparent");
					$('#dbname btn').css('opacity', '0');
					apanel.catalogue.action.rename(list, title);
				} else alert('Введите название')
			});
		},
		listfield: function(list) {
		
			$('#list_field, #list_func, #list_attr').empty();
			//список функций каталога
// 			var call_func = {
// 				useronline: 'Автор онлайн',
// 				dataspost: 'Дата подачи',
// 				datashow: 'Дата модерации',
// 				wrong: 'Жалоба',
// 				favorite: 'Избранное',
// 				username: 'Имя пользователя',
// 				similar: 'Похожие объявления',
// 				noob: 'Номер объявления',
// 				viewfunc: 'Статистика просмотров',
// 				current: 'Текущий пункт меню',
// 				phone: 'Телефон пользователя',
// 				moder: 'Модерация'
// 			}
// 			for (a in call_func)
// 				$('#list_func').append('<span class="funcname"><span>'+ call_func[a] +'</span><span>'+ a +'</span></span>');
			
			//список атрибутов каталога
// 			var call_attr = {
// 				'class="openp"': 'Открыть подробную карточку (popup)',
// 				'class="openb"': 'Открыть подробную карточку (target blank)',
// 				'class="openr"': 'Открыть подробную карточку (reload page)',
// 				'class="closep"': 'Закрыть подробную карточку (popup)',
// 				'class="closeform"': '"Отмена" в форме добавления',
// 				'class="save"': '"Сохранить" в форме добавления',
// 				'list="" class="add owner"': '"Редактировать" карточку',
// 				'list="" class="delete owner"': '"Удалить" карточку',
// 				'action="done" (произвольное имя)': 'Выполнение функции при добавлении'
// 			}		
// 			for (a in call_attr)
// 				$('#list_attr').append('<span class="funcname"><span>'+ call_attr[a] +'</span><span>'+ a +'</span></span>');
				
			//список полей каталога
			var json = {func:apanel.cfg.url.querypanel, domain:JSCat.domain, token:JSCat.token};
			json["action"] 			= "fieldList";
			json["list_id"] 		= list.domain_id;
			$.post("/json/", json, function(result) {
				if (typeof result !== 'object') result = JSON.parse(result);
				for (field in result) {
					//$('#list_field').prepend('<span class="funcname"><span>' + result.caption[i] + '</span><span>' + result.name_field[i] + '</span></span>');
	 				$('#list_field').prepend('<span class="funcname"><span>' + result[field].caption + '</span>\
						<span>' + result[field].name_field + '<i class="param' + result[field].name_field + '"></i></span></span>');					
					$('.param' + result[field].name_field).click(apanel.catalogue.fieldsetting.bind(this, result[field], list));
				}
				$('#list_field').prepend('<span id="addfield">Добавить поле</span>');
				$('#addfield').click(apanel.catalogue.action.addfield.bind(this, list));
			});
		},
		html: function(list) {
			
			var line = '<div class="line">';
				line += '	<span>' + list.title + ': </span><select id="changetemplate"></select>';
				line += '	<span id="call_edit" style="display:none">Настройки поля<span id="list_edit"></span></span>';
				//line += '	<span id="call_attr">Атрибуты<span id="list_attr"></span></span>';
				//line += '	<span id="call_func">Функции<span id="list_func"></span></span>';
				line += '	<span id="call_field">Поля ввода<span id="list_field"></span></span>';
				line += '</div>';
			
    		var menu = {'save':'Сохранить','close':'Закрыть'}
    		$('#cat').empty().append(apanel.radiosgen(menu, 'radios')).append(line);
	
			//списки полей и функций
			apanel.catalogue.listfield(list);
			$('.radios [radios="close"]').click(apanel.catalogue.start.bind(this));			

			//меню шаблонов
			var template = {
// 				2: 'Карточка превью',
// 				1: 'Подробная карточка',
				3: 'Форма поиска',
				4: 'CRM таблица',
// 				5: 'Форма добавления',
// 				6: 'Мои объявления',
				7: 'CRM подробная',
				9: 'CRM форма',
				10: 'CRM карточка'
			}
			for (a in template) {
				$('#changetemplate').append('<option value="'+ a +'">'+ template[a] +'</option>');
			}
			$('#changetemplate').change(apanel.catalogue.action.changetemplate.bind(this, list));
			apanel.catalogue.action.changetemplate(list);
		}
	},
	optiongen: function(arr) {
		var text = '';
		for (a in arr)
			text += '<option value="'+ a +'">'+ arr[a] +'</option>';
		return text;
	},
	getarea: function (html, mode) {
		var Area = document.createElement("textarea");
		Area.value = html;
		$('#list').empty().append(Area);
		return CodeMirror.fromTextArea(Area, {
			lineNumbers: true,
			matchBrackets: true,
			styleActiveLine: true,
			mode : mode
		});
	},
	radiosgen: function(arr, name) {
		var text = '<span class="'+ name +' little">';
		for (a in arr)
			text += '<label><input type="radio" name="'+ name +'" radios="'+ a +'">'+ arr[a] +'</label>';
			text += '</span>';
		return text;
	},
	getusertype: function() {
		return {
			1: 'Администратор',
			2: 'Пользователь',
			//3: 'Модератор',
			//4: 'Компания',
			5: 'Гость'
		}
	}
}

$(function() {
	apanel = new apanel();
	apanel.catalogue.start()
});









</script>







<!-- 
{{id}} 				 										- возвращает номер заказа пользователя
{{status}} 			 										- текущий статус заказа
{{date}} 			 										- дата заказа в формате: 15.05.2019
{{time}} 			 										- время заказа в формате: 16:51
{{datetime}} 		 										- дата и время в формате: 2019-05-15 16:51:54
{{lastUpdate}} 	 										- статус изменен в формате: 2019-05-15 16:51:54
{{lastModify}} 		 									- последние изменение в формате: 2019-05-15 16:51:54
{{approvedAt}} 	 										- дата и время апрува в формате: 2019-05-15 16:51:54, либо NULL, если не указана дата
{{shippedAt}}  		 									- дата и время отправки в формате: 2019-05-15 16:51:54, либо NULL, если не указана дата
{{canceledAt}}  	 										- дата и время отмены в формате: 2019-05-15 16:51:54, либо NULL, если не указана дата
{{buyoutAt}}  			 	 								- дата и время выкупа в формате: 2019-05-15 16:51:54, либо NULL, если не указана дата
{{refundedAt}}  		 									- дата и время возврата в формате: 2019-05-15 16:51:54, либо NULL, если не указана дата
{{price}}  				 	 								- цена товара
{{total}}  				 	 								- сумма заказа
{{goods_names}}  			 	 							- наименование товаров через запятую
{{russianpostTrack}}  	 								- номер отправления Почты России
{{russianpostTrackingIndex}}  						- индекс почтового отделения последнего статуса отслеживания
{{russianpostOfficeAddress}}  						- адрес почтового отделения
{{russianpostOfficePhone}}  		 					- телефон почтового отделения
{{russianpostWorkTimeToday}}  		 				- режим работы почтового отделения сегодня
{{russianpostWorkTimeTomorrow}}  	 				- режим работы почтового отделения завтра
{{key_1="@"}}  				 				 			- переводит клиента на оператора при звонке робота
{{key_2="текст"}}  				 				 		- текст, который клиент услышит после нажатия клавиши 2
{{audio="http://files.lvcdn.ru/example.mp3"}}  	- тег для вставки аудиозаписи
{{repeat}}  				 				 				- повторить голосовое сообщение еще раз, если нажата клавиша *
{{autoPredictive}}  				 				 		- автоматическое соединение с оператором
{{domain}}  				 				 				- домен, на котором пользователь совершил заказ
{{utm_source}}  				 				 			- метка utm_source
{{utm_medium}}  				 				 			- метка utm_medium
{{utm_campaign}}  				 				 		- метка utm_campaign
{{utm_content}}  				 				 			- метка utm_content
{{utm_term}}  				 				 				- метка utm_term
{{fio}}  				 				 					- возвращает значение поля «Ф.И.О». 
{{postIndex}}
{{region}}
{{city}}
{{address}}
{{phone}}
{{quantity}}
{{comment}}
{{additional1}}
{{additional2}}
{{additional11}}
{{additional14}}
 -->