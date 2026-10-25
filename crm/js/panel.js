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
	builder:   function() {
		var menu = {
			analytics: 'Аналитика', 
			dbsettings: 'Настройки сайта', 
			siteeditor: 'Шаблон и позиции', 
			seo: 'Продвижение', 
			users: 'Пользователи', 
			modules: 'Модули', 
			catalogue: 'Каталог', 
			emails: 'Почта', 
			license: 'Лицензия'
		}
		
		$( 'ul[menu]' ).empty().append(cabinet.menugen(menu));
		$( '#cabinet ul[menu] a' ).click(function() {
			var item = $(this);
			item.parent().parent().find('a.active').removeClass('active');
			item.addClass('active');
		});
		
		apanel.actions();
		$( 'ul[menu] li:first a' ).click();
	},	
	template: {
		face:				['Оформление','Внешний вид сайта и цветовая схема'],
		social:				['Социальные сети','Данный модуль обеспечивает автопостинг объявлений в ваши группы в социальных сетях'],
		general:			['Основные настройки','Динамические данные собраны в одном месте для удобного управления сайтом'],
		gallery:			['Фотогалерея','Модуль для работы с изображениями'],
		importxml:			['XML загрузка','Поддерживаемые форматы фидов для загрузки - CIAN XML v.2. Обращаем Ваше внимание, что загрузка объявлений на сайт предусматривает единовременную обработку до 1000 объектов недвижимости'],
		catalogue:			['Каталог','Многоцелевой шаблон, предназначенный для редактирования разделов недвижимости. Не изменяйте содержимое, это нарушит работу сайта. Восстановление работоспособности оплачивается отдельно!'],
		category:			['Категории недвижимости','Отметьте те виды деятельности, которыми занимается именно Ваше агентство. Данные каталоги будут задействованы автоматически'],
        analytics:			['Аналитика','Детальная статистика и воронка продаж'],
		users:				['Пользователи','Управление данными пользователей, смена логина и пароля, просмотр статистики'],
		mod_menu: 			['Список модулей меню','Вложенность пунктов меню регулируется прямо на сайте. Чтобы получить доступ ко всем параметрам модуля, кликните на сайте правой кнопкой мыши по нужному пункту меню'],
		mod_str_navigation: ['Строка навигации','Существенно улучшает юзабилити сайта. Посетителю наглядно видно, где он находится и как ему попасть на интересующий его другой раздел ресурса'],
		mod_double_menu: 	['Список дублирующих меню','Поскольку некоторые сайты бывают довольно масштабными, иногда неплохо было бы дублировать меню или какую-либо его часть. Для этих задач существует данный модуль'],
		mod_cssjs_editor: 	['Материалы','Данный модуль предназначен для отображения статической информации, которая содержится на интернет-ресурсе, будь то новости, статьи или заметки, а так же видео с YouTube'],
		emails:				['Управление рассылками','Модуль управления e-mail оповещениями. Содержит в себе конструктор писем, который поможет улучшить маркетинговую коммуникацию с потенциальным клиентом'],
		siteeditor:			['Шаблон и позиции','Здесь формируется первичная логика, необходимая для отображения данных. Не удаляйте содержимое редактора, это нарушит работоспособность сайта'],
		seo:				['SEO Настройки','Данные настройки оказывают прямое влияния на поисковую оптимизацию сайта'],
		links:				['Полезные ссылки','Здесь собраны основные инструменты для мониторинга и продвижения сайта'],
		og:					['Настройки Open Graph','Open Graph делает ссылки в социальных сетях проще для восприятия'],
		lic:				['Лицензия','Информация о лицензии, сроке действия, лимиты и ограничения'],
		score:				['Счета', 'Чтобы счет при оплате закрылся автоматически, после оплаты в Яндекс Кассе нужно нажать "Назад в магазин". Если вы упустили этот момент, напишите нам.'],
		company:			['Ваша компания','Перед подачей заявки на выставление счета по безналичной оплате, убедитесь в правильности заполненных данных о Вашей компании']
	},				
	actions:   function(param) {
    	$('[cabinet="' + apanel.cfg.selectors.seo +'"]').click(apanel.seo.start.bind(this));
    	$('[cabinet="' + apanel.cfg.selectors.users +'"]').click(apanel.users.start.bind(this));
    	$('[cabinet="' + apanel.cfg.selectors.emails +'"]').click(apanel.emails.start.bind(this));
    	$('[cabinet="' + apanel.cfg.selectors.license +'"]').click(apanel.license.start.bind(this));
    	$('[cabinet="' + apanel.cfg.selectors.modules +'"]').click(apanel.modules.start.bind(this, "mod_cssjs_editor"));
    	$('[cabinet="' + apanel.cfg.selectors.catalogue +'"]').click(apanel.catalogue.start.bind(this));
    	$('[cabinet="' + apanel.cfg.selectors.analytics +'"]').click(apanel.analytics.bind(this));
    	$('[cabinet="' + apanel.cfg.selectors.dbsettings +'"]').click(apanel.dbsettings.start.bind(this));
    	$('[cabinet="' + apanel.cfg.selectors.siteeditor +'"]').click(apanel.siteeditor.start.bind(this));
	},
	modules:   {
		start: function(type) {
			$( '[cabinet="'+ cabinet.cfg.selectors.ti +'"]').text(apanel.template[type][0]).append('<span>'+ apanel.template[type][1] +'</span>');
		
    		var menu = {
    			mod_cssjs_editor:'Материалы',
    			mod_menu:'Меню',
    			gallery:'Фотогалерея',
    			mod_double_menu:'Дублирующие меню',
    			mod_str_navigation:'Строка навигации'
    		}
    		$( '#' + cabinet.cfg.selectors.cabinet + ' [content]').empty().append(cabinet.radiosgen(menu, 'radios')).append('<div id="list"><div>Нет данных</div></div>');
    		$('.radios').append('<button id="addmod">Добавить модуль</button><input type="file" multiple id="files" enctype="multipart/form-data" style="display:none">');							
			
			$('.radios [radios="'+ type +'"]').parent().addClass('active');
			$('#addmod').unbind().text('Добавить модуль').click(apanel.modules.action.add.bind(this, type));
			$('.radios [name]').change(function() {
				var radios = $(this).attr('radios');
				if ($('[radios="'+ radios +'"]:checked').length) apanel.modules.start(radios);
				return false;
			});
			
			apanel.modules.get(type);
		},
		get: function(type) {
			if (type != 'gallery') {
				//получаем информацию о всех модулях одного типа
				var json = {func:apanel.cfg.url.querypanel, domain:JSCat.domain, token:JSCat.token};
				json["action"] 		= "lists";
				json["type"] 		= type;
				$.post("/json/", json, function(result){
					if (typeof result !== 'object') result = JSON.parse(result);
					if ( !result['error'] ) {
						$('#list').empty();
						for (key in result) {
							if ( result[key].setting != '' && result[key].name == 'mod_cssjs_editor' ) {
								$('#list').append('<div id="m'+ key +'"><span>'+ result[key].title +'</span><span>'+ result[key].position +'</span><span>'+ key +'</span><i>js</i></div>');
							} else {
								$('#list').append('<div id="m'+ key +'"><span>'+ result[key].title +'</span><span>'+ result[key].position +'</span><span>'+ key +'</span></div>');
							}
							$('#m'+ key).click(apanel.modules.edit.bind(this, result[key]));								
						}
					} 
				});
			} else {
				apanel.gallery.start();
			}
		},
		edit: function(module) {
  			
    		var menu = {'save':'Сохранить','close':'Закрыть','remove':'Удалить'}
  			var params = {
    			mod_menu:'Пункты меню',
    			mod_double_menu:'Параметры',
    			mod_cssjs_editor:'Редактор скриптов',
    			mod_str_navigation:'Редактор скриптов'
    		}
  			
			var line = '<div class="line">';
				line += '	<span id="title"><input type="text" value="' + module.title + '" /><span class="input-buffer"></span><btn>Сохранить</btn></span>';
				line += '	<span id="setting">Публикация</span>';
				line += '	<span id="params">' + params[module.name] + '</span>';
				line += '</div><div id="list"></div>';
				
    		$( '#' + cabinet.cfg.selectors.cabinet + ' [content]').empty().append(cabinet.radiosgen(menu, 'radios')).append(line);
			if (module.name == 'mod_cssjs_editor') var code = apanel.getarea(module.html, 'xml');
			if (module.name == 'mod_double_menu') var code = apanel.getarea(module.html, 'xml');
			
			$('.CodeMirror, .CodeMirror-gutters').css({'height':'100%'});
			$('.radios [radios="close"]').click(apanel.modules.start.bind(this, module.name));
			$('.radios [radios="remove"]').click(apanel.modules.action.remove.bind(this, module));
			$('#setting').click(apanel.modules.publics.bind(this, module));
			
 			
			if (module.name == 'mod_menu') {
				$('#params').click(apanel.modules.action.menuonoff.bind(this, module));
			} else $('#params').click(apanel.modules.params.bind(this, module, params[module.name]));
			
			if (module.name != 'mod_cssjs_editor') {
				$('.radios [radios="save"]').parent().hide();
				$('#list').empty().append('<div class="nocontent">У данного типа модуля редактор отсутствует. Но есть настройки публикации :)</div>')
			} else $('.radios [radios="save"]').off().click(apanel.modules.action.save.bind(this, module, code));

			$('#title input[type="text"]').on('input', function() {
				var item = $(this);
			    $('.input-buffer').text(item.val());
			    item.width($('.input-buffer').width()).css("border-color", "#d2d2d2");
        		$('#title btn').css("opacity", "1");
			});
			
    		$("#title btn").click(function() {
				var title = $('#title input[type="text"]').val();
				if (title != '') {
					$('#title input[type="text"]').css("border-color", "transparent");
					$('#title btn').css('opacity', '0');
					apanel.modules.action.rename(module, title);
				} else alert('Введите название')
			});
		
		},
		params: function(module, caption) {
    		var menu = {'return':'Назад','save':'Сохранить'}
  			var line = '<div class="line"><span>'+ caption +': ' + module.title + '</span></div><div id="list"></div>';
    		$( '#' + cabinet.cfg.selectors.cabinet + ' [content]').empty().append(cabinet.radiosgen(menu, 'radios')).append(line);
			
			var code = apanel.getarea(module.setting, 'javascript');
			$('.CodeMirror, .CodeMirror-gutters').css({'height':'100%'});
			$('.radios [radios="return"]').click(apanel.modules.edit.bind(this, module));	
			$('.radios [radios="save"]').click(apanel.modules.action.savejs.bind(this, module, code));	
		
		},
		publics: function(module) {
    	
	    	var menu = {'return':'Назад','save':'Сохранить'}
	  		var line = '<div class="line"><span>Настройки публикации: ' + module.title + '</span></div><div id="list"></div>';
	    	$( '#' + cabinet.cfg.selectors.cabinet + ' [content]').empty().append(cabinet.radiosgen(menu, 'radios')).append(line);
			
			//Настройки публикации
			$('#list').empty().append('<div><div id="group"><b>Группы пользователей: </b></div></div>\
										<div><div id="listp"><b>Позиция в шаблоне: </b><br><br></div></div>\
										<div><div id="listm"><b>Список разделов: </b></div></div>\
										<div id="listmenu"></div>');
									
			$('.radios [radios="save"]').click(apanel.modules.action.savesetting.bind(this, module));
			$('.radios [radios="return"]').click(apanel.modules.edit.bind(this, module));
			
			if (module.name == 'mod_str_navigation') $('.radios [radios="return"]').off().click(apanel.modules.start.bind(this, module.name));
			
			//На главной/На всех
			var json = {func:apanel.cfg.url.querymenu, domain:JSCat.domain, token:JSCat.token};
			json["action"] 		= "amenu";
			json["param"] 		= "list";
			$.post("/json/", json, function(result) {
				if (typeof result !== 'object') result = JSON.parse(result);
				
				//На главной
				for (var home = "no_selected", i = 0; i < module.page_list.length; i++)
		    		if ("home" == module.page_list[i]) 
		    		var home = "selected";
		    	//На всех
				for (var all = "no_selected", i = 0; i < module.page_list.length; i++)
		    		if ("all" == module.page_list[i]) 
		    		var all = "selected";
		    		
				$('#listm').append('<span class="' + home + '" id="inhome">На главной</span>\
									<span class="' + all + '" id="inall">На всех</span><br><br>\
									<b>Модули меню: </b>');
	
				for (menuid in result) {
					$('#listm').append('<span id="m' + menuid + '">' + result[menuid] + '</span>');
					$('#m' + menuid).click(apanel.modules.action.getmenu.bind(this, module, menuid));
				}
								
				$('#inhome').click(apanel.modules.action.change.bind(this, module, 'home'));
				$('#inall').click(apanel.modules.action.change.bind(this, module, 'all'));
			

				for (user in apanel.getusertype()) {
					var cl = 'no_selected';
					for (var i = 0; i < module.access_usertype.length; i++) {
						if (module.access_usertype[i] == user)
							var cl = 'selected';
					}
					$('#group').append('<span id="g' + user + '" class="' + cl + '">' + apanel.getusertype()[user] + '</span>');
					$('#g' + user).click(apanel.modules.action.changeuser.bind(this, module, user));
				}
					
				var json = {func:apanel.cfg.url.querypanel, domain:JSCat.domain, token:JSCat.token};
				json["action"] 		= "pos_setting";
				$.post("/json/", json, function(result) {
					if (typeof result !== 'object') result = JSON.parse(result);
		    		var cl = "no_selected";
					for (var i = 0; i < result.pos.name.length; i++) {
		    		    if (result.pos.name[i] == module.position) {
		    		    	cl = "selected";
		    		    } else cl = "no_selected";
		    		    $("#listp").append('<span id="p' + result.pos.id[i] + '" class="' + cl + '">' + result.pos.name[i] + "</span>");
		    		    $("#p" + result.pos.id[i]).click(apanel.modules.action.changepos.bind(this, module, result.pos.id[i]));
		    	    }
				});
			});
		},
		action: {
			add: function(type) {
				var json = {func:apanel.cfg.url.querypanel, domain:JSCat.domain, token:JSCat.token};
				json["action"] 		= "addmod";
				json["typemod"] 	= type;
				$.post("/json/", json, function() {
					alert('Модуль добавлен')
 					apanel.modules.get(type);
				});
			},
			remove: function(module) {
				confirm({
					text: "Удалить модуль: " + module.title + " ?",
					ok: function() {
						var json = {func:apanel.cfg.url.querypanel, domain:JSCat.domain, token:JSCat.token};
						json["action"] 		= "dell";
						json["id"] 			= module.domain_id;
						$.post("/json/", json, function() {
 							apanel.modules.start(module.name);
						});
					}
				});
			},
			save: function(module, code) {
				var param = [module.domain_id, module.name]
				var json = {func:apanel.cfg.url.querypanel, domain:JSCat.domain, token:JSCat.token};
				json["action"] 		= "saveArticle";
				json["param"] 		= param;
				json["editor"] 		= code.getValue();
				$.post("/json/", json, function() {
 					apanel.modules.start(module.name);
				});
			},
			savesetting:   function(module) {
				var json = {func:apanel.cfg.url.querypanel, domain:JSCat.domain, token:JSCat.token};
				json["action"] 		= "savesetting";
				json["module"] 		= module;
				$.post("/json/", json, function() {
 					apanel.modules.start(module.name);
				});
			},
			rename: function(module, title) {
				var param = [module.domain_id, title];
				var json = {func:apanel.cfg.url.querypanel, domain:JSCat.domain, token:JSCat.token};
				json["action"] 	= "titleModule";
				json["param"] 	= param;
				$.post("/json/", json, function() {});
			},
			savejs: function(module, code) {
				var json = {func:apanel.cfg.url.querypanel, domain:JSCat.domain, token:JSCat.token};
				json["action"] 		= "savejs";
				json["id"] 			= module.domain_id;
				json["editor"] 		= code.getValue();
				$.post("/json/", json, function(){
 					apanel.modules.start(module.name);
				});
			},
			getmenu: function (module, menuid) {
				var json = {func:apanel.cfg.url.querymenu, domain:JSCat.domain, token:JSCat.token};
				json["action"] 		= "amenu";
				json["param"] 		= "parents";
				json["parent"] 		= menuid;
				$.post("/json/", json, function(result) {
					if (typeof result !== 'object') result = JSON.parse(result);
					apanel.showListMenu(module, menuid, result)
				});
			},
			change: function (module, page) {
			    var pagesarr = module.page_list;
    	    	if ( $('#in' + page).attr("class") == "selected" ) {
    	        	$('#in' + page).attr("class", "no_selected");
    	        	//Найти и удалить элемент из массива 
    	        	var i = pagesarr.indexOf(page);
    	        	if(i != -1) pagesarr.splice(i, 1);
    	        	pagesarr = [...new Set(pagesarr)];
    	        } else {
    	        	//write new item
					$('#in' + page).attr("class", "selected");
					pagesarr.push(page);
    	        	pagesarr = [...new Set(pagesarr)];
    	        }
			},
			changeuser: function (module, user) {
				if ($('#g' + user).attr('class') == 'selected') {
					$('#g' + user).attr('class', 'no_selected');
					module.access_usertype.splice(module.access_usertype.indexOf(user), 1);
				} else {
					$('#g' + user).attr('class', 'selected');
					module.access_usertype[module.access_usertype.length] = user;
				}
			},
			changepos: function (module, posid) {
				$('#listp .selected').attr('class', 'no_selected');
				$('#p' + posid).attr('class', 'selected');
				module.position = $('#listp .selected').text();				
			},
			menuonoff:   function(module) {
				var json = {func:apanel.cfg.url.querymenu, domain:JSCat.domain, token:JSCat.token};
				json["action"] 		= "amenu";
				json["param"] 		= "onoff";
				json["id"] 			= module.domain_id;
				$.post("/json/", json, function(result) {
					if (typeof result !== 'object') result = JSON.parse(result);
					$('#list').empty().append('<span id="menuids"></span>');
						
					for (menuid in result) {
						$('#menuids').append('<span on="' + result[menuid].published + '" id="menuitem_' + menuid + '">' + result[menuid].title + '</span>');
						$('#menuitem_' + menuid).click(apanel.modules.action.changeoff.bind(this, menuid));
					}
				});
			},
			changeoff: function (menuid) {
				var on = $('#menuitem_' + menuid).attr('on');
 				if (on == '0') { on = '1', $('#menuitem_' + menuid).attr('on','1') }
 				else { on = '0', $('#menuitem_' + menuid).attr('on','0') }
	
				var json = {func:apanel.cfg.url.querymenu, domain:JSCat.domain, token:JSCat.token};
				json["action"] 		= "amenu";
				json["param"] 		= "onoff";
				json["onoff"] 		= on;
				json["id"] 			= menuid;
				$.post("/json/", json, function() {});
			}
		}	
	},
	gallery: {
		start: function(album) {
			$('#addmod').unbind().text('Добавить альбом').click(apanel.gallery.save.bind(this));
    
			var json = {func:'CGalery', domain:JSCat.domain, token:JSCat.token};
			json["action"] 		= "gets";
			$.post("/json/", json, function(result) {
				if (typeof result !== 'object') result = JSON.parse(result);
				$('#list').empty();
           		for (var key in result) {
    	        	$('#list').append('<div id="a'+ result[key].id +'"><strong id="album' + result[key].id + '">'+ result[key].name + '</strong></div>');
					$('#a' + result[key].id).click(apanel.gallery.get.bind(this, result[key]));	
				}
				if (typeof album != 'undefined') $('#a' + album.id).click();
		    });
		},
		remove: function(id, name, album) {
			confirm({
				text:   "Вы уверены?",
				ok:     function() {
					var json = {func:'CGalery', domain:JSCat.domain, token:JSCat.token};
					json["action"] 		= "remove_item";
					json["table"] 		= name;
					json["id"] 			= id;
					$.post("/json/", json, function() {
						apanel.gallery.start(album);
    				});
   				 }
   			});
		},
		save: function() {
			var param = ['new', 'new'];
			var json = {func:'CGalery', domain:JSCat.domain, token:JSCat.token};
			json["action"] = "album";
			json["param"] = param;
			$.post("/json/", json, function(result) {
				alert('Альбом добавлен')
				apanel.gallery.start();
    		});
		},
		add: function(album) {
			var $input = $('#files');
			var a = false;
			for (var i = 0; i < $input.prop('files').length; i++) {
				var xmlhttp = new XMLHttpRequest();
   				var form = new FormData(this);
   				link = '/json/';
				form.append('Web', JSCat.domain);
				form.append('page', JSCat.page);
				form.append('func', 'CGalery');
				form.append('action', 'load_img');
				form.append('id', album.id);
				form.append('img', $input.prop('files')[i]);
				xmlhttp.open('POST',link,'1');
				xmlhttp.send(form);
				apanel.gallery.start(album);
			}	
		},
		get: function(album) {
			var json = {func:'CGalery', domain:JSCat.domain, token:JSCat.token};
			json["action"] = "gets";
			json["id"] = album.id;
			$.post("/json/", json, function(result) {
				if (typeof result !== 'object') result = JSON.parse(result);
				
				var line = '<div class="line">';
					line += '	<span id="title"><input type="text" value="' + album.name + '" /><span class="input-buffer"></span><btn>Сохранить</btn></span>';
					line += '	<span id="addimg">Добавить изображение</span>';
					line += '</div>';
					
				$('.line').remove();
    			$('#list').empty().append('<div class="img_view"></div>').before(line);
				$('#addimg').click(files.bind(this, album.id));
    			
	        	function files(id) {
					$('#files').unbind().click().change(apanel.gallery.add.bind(this, album));
				}
           		
           		for (var key in result) {
           			var format = result[key].name.split('.');
           			//проверка на формат
           			if ((format[1] == 'png')||(format[1] == 'jpeg')||(format[1] == 'jpg')||(format[1] == 'gif')||(format[1] == 'svg')) {
           				format[0] = JSCat.cdn +'/file/'+ result[key].name;
           			} else {
           				format[0] = "/cdn/lib/"+ format[1] +".png";
           			}
           			$('.img_view').append('<div><img src="'+ format[0] +'"><i class="close" data-id="' + result[key].id + '"></i></div>');
					$('[data-id="' + result[key].id + '"]').click(apanel.gallery.remove.bind(this, result[key].id, 'photo', album))
				
           		}  
    		});
		}
	},
	statistic:   function() {

		//последние 10 зарегистрированных
		var json = {func:apanel.cfg.url.querystat, domain:JSCat.domain, token:JSCat.token};
		json["action"] 		= "call_ten_registr";
		$.post("/json/", json, function(a){
			if (typeof a !== 'object') a = JSON.parse(a);
			$('#chart5').append('<h3>Последние зарегистрированные</h3>');
			for (var b in a) {
				var randomColor = "#" + Math.random().toString(16).slice(2, 8);
				if (a[b].username != 'mail@mail.ru')
					$("#chart5").append('<div><span><u style="background:' + randomColor + '"></u>' + a[b].username + '</span><span>' + a[b].name + '</span>\
										<span>' + cabinet.timeConverter(a[b].registerDate) + '</span></div>');
			}
		});
		//последние 10 авторизованных
		var json = {func:apanel.cfg.url.querystat, domain:JSCat.domain, token:JSCat.token};
		json["action"] 		= "call_ten_authorize";
		$.post("/json/", json, function(a){
			if (typeof a !== 'object') a = JSON.parse(a);
			$('#chart4').append('<h3>Последние авторизованные</h3>');
			for (var b in a) {
				var time = a[b].time;
				time = cabinet.timeConverter(time);
				var randomColor = "#" + Math.random().toString(16).slice(2, 8);
				if (a[b].username != 'mail@mail.ru')
					$("#chart4").append('<div><span><u style="background:' + randomColor + '"></u>' + a[b].name + '</span><span>' + a[b].username + '</span><span>' + time + '</span></div>');
			}
		});
		//количество пользователей по группам
		var json = {func:apanel.cfg.url.querystat, domain:JSCat.domain, token:JSCat.token};
		json["action"] 		= "call_count";
		$.post("/json/", json, function(result) {
			if (typeof result !== 'object') result = JSON.parse(result);

			var users = '<div><strong>'+ (Math.floor(result.admin) - 1) + ((Math.floor(result.today) > 0) ? '<span style ="color: green;" >+ ' + result.today + '</span>' : '') +'</strong><span>Администратор</span></div>';
			if (Math.floor(result.user) > 0) users += '<div><strong>'+ result.user +'</strong><span>Пользователь</span></div>';
			if (Math.floor(result.moder) > 0) users+=	'<div><strong>'+ result.moder +'</strong><span>Модератор</span></div>';
			if (Math.floor(result.company) > 0) users+=	'<div><strong>'+ result.company +'</strong><span>Компания</span></div>';
			
			$('#chart3').append(users);
		});
		//узнаем размер папки на сервере
		var json = {func:apanel.cfg.url.querystat, domain:JSCat.domain, token:JSCat.token};
		json["action"] 		= "what_size";
		$.post("/json/", json, function(a){
			if (typeof a !== 'object') a = JSON.parse(a);
			var k = 500;
			$("#chart2").append('<canvas id="myChart2" style="height:80px; width:720px"></canvas>')
			var cty = document.getElementById("myChart2").getContext('2d');
			var myChart = new Chart(cty, {
    			type: 'horizontalBar',
    			data: {
        			datasets: [{
            			label: 'Памяти занято ('+a[1]+')',
           				data: [(a[0]/k)*100],	
           				backgroundColor: [
           					'rgba(63, 96, 132, 1)'
           				], 
           				borderColor : [
           					'rgb(255,255,255)'
           				],     					
           				borderWidth: 2
        			}]
    			},
    			options: {
    			 	tooltips:{
    			 		enabled: false
    			 	},
    			 	layout: {
           				 padding: {
                			right: 10
            			}
        			},
        			title: {
            			display: true,
           			 	text: 'Статистика использования дискового пространства, %. Памяти занято '+a[0]+' '+a[1]
        			},
        			legend: {
            			display: false
            		},
            		scales: {
            			xAxes: [{
            				display: true,
                			ticks: {
                    			beginAtZero:true,
                    			max: 100
                			}
            			}]
        			}
    			}
			});
		});
		//статистика каталогов
		var json = {func:apanel.cfg.url.querystat, domain:JSCat.domain, token:JSCat.token};
		json["action"] 		= "catalogue_stat";
		$.post("/json/", json, function(a){
			if (typeof a !== 'object') a = JSON.parse(a);
			$('#chart6').append('<h3>Статистика карточек каталогов</h3>');
			$('#chart6').append('<div><span>ID</span><b>Название</b>\
										<span>Всего</span>\
										<span>В работе</span>\
										<span>Неактивных</span>\
										<span>Последнее</span></div>');
			for (var b in a) {
				(a[b].today == 0)?(a[b].today = ""):(a[b].today = '<i style ="color: green;" > + ' + a[b].today + '</i>');
				if (!a[b].last) a[b].last = '-';
				var randomColor = "#" + Math.random().toString(16).slice(2, 8);
				if (a[b].count != '0')
					$("#chart6").append('<div><u style="background:' + randomColor + '"></u>\
											<span>' + a[b].id + '</span>\
											<b>' + a[b].title + '</b>\
											<span>' + a[b].count + '</span>\
											<span>' + a[b].active + '</span>\
											<span>' + a[b].moder + '</span>\
											<span>' + a[b].last + a[b].today + ' </span></div>');
			}
		});			
	},
	showListMenu:   function(param, idmenu, menu) {
		//строим меню для публикации модулей
        function recurseMenu() {
            var s = '<ul>';
            for (var x in menu) {
                if (menu[x].id_parent == '0') {
                	if (menu[x].cpu != '') var iflist = param.page_list.indexOf(menu[x].cpu);
                	else var iflist = param.page_list.indexOf(menu[x].id);
                	if (iflist != -1) var selected = 'selected'; else var selected = 'no_selected';
                    s += '<li><a on="'+ menu[x].published +'" item="'+ menu[x].id +'" cpu="'+ menu[x].cpu +'" class="'+ selected +'">' + menu[x].title + '</a>';
					//2 level
					for (var y in menu) {
            		    if (menu[y].id_parent == menu[x].id) {
           		     		s += '<ul><li><a on="'+ menu[y].published +'" item="'+ menu[y].id +'" cpu="'+ menu[y].cpu +'" class="'+ selected +'">' + menu[y].title + '</a></li></ul>';
          		  		} 
            		}
                    s + '</li>';
                } 
            }
            return s + '</ul>';
        }
    	$("#listmenu").show().empty().append(recurseMenu());
    	$("#listmenu a[on]").each(function(){
    		var item = $(this).attr('item');
    		var $item = $('#listmenu a[on][item="'+ item +'"]');
    		$item.click(clicktoitem.bind(this, item, $item, param));
    	});
    	//выбор пунктов меню для публикации модулей	
    	function clicktoitem(item, selected, param) {
    	    if ( selected.attr("class") == "selected" ) {
    	       	selected.attr("class", "no_selected");
    	       	//Найти и удалить элемент из массива 
    	       	if (menu[item].cpu != '') var i = param.page_list.indexOf(menu[item].cpu); //if cpu
    	       	else var i = param.page_list.indexOf(menu[item].id); //if id
    	       	if(i != -1) param.page_list.splice(i, 1);
    	       	param.page_list = [...new Set(param.page_list)];
    	    } else {
    	    	//write new item
				selected.attr("class", "selected");
				if (menu[item].cpu != '') param.page_list.push(menu[item].cpu); //if cpu
				else param.page_list.push(menu[item].id); //if id
   	        	param.page_list = [...new Set(param.page_list)];
   	        }
   	    }
		return false;
	},
	seo: {
		start: function() {
			$( '[cabinet="'+ cabinet.cfg.selectors.ti +'"]').text(apanel.template.seo[0]).append('<span>'+ apanel.template.seo[1] +'</span>');

	    	var option = {
	    		seo: 'Общие настройки', 
	    		og: 'Open Graph',
	    		links: 'Полезные ссылки'
	    	}
	    	
			$( '#' + cabinet.cfg.selectors.cabinet + ' [content]').empty().append(cabinet.radiosgen(option, 'radios')).append('<div id="list2"></div>');
			$('.radios').append('<button id="add">Сохранить изменения</button>');
						
			$('.radios [name]').change(function() {
				$('.radios label').removeClass('active').find('[radios]:checked').parent().addClass('active');
				var radios = $(this).attr('radios');
				if ($('[radios="'+ radios +'"]:checked').length) {
					$( '[cabinet="'+ cabinet.cfg.selectors.ti +'"]').text(apanel.template[radios][0]).append('<span>'+ apanel.template[radios][1] +'</span>');

					apanel.seo[radios]();
				}
			});
			$('.radios [radios="seo"]').click();
				
		},
		seo: function() {
						
			var json = {func:apanel.cfg.url.querypanel, domain:JSCat.domain, token:JSCat.token};
			json["action"] 	= "seo";
			json["action2"] = "get"; 
			$.post("/json/", json, function(result) {
				if (typeof result !== 'object') result = JSON.parse(result);
				$( '#list2').empty().append('<div class="inputcontent">\
					<label>Выбор города (обеспечит центрирование карты при поиске объектов)<select id="citys"></select></label>\
					<div class="checks" style="margin-top:-10px"><label>Районы города (добавляйте районы своего города для более точного поиска объектов)</label><br>\
					<input style="max-width:300px" type="text" placeholder="Введите название" id="raions"><button id="addraion">Добавить район</button></div>\
					<label>Заголовок главной страницы (title) <input value="' + result.title + '" type="text" placeholder="Title" id="seot"></label>\
					<label>Описание главной страницы (description)<input value="' + result.description + '" type="text" placeholder="Description" id="seod"></label>\
					<label>Ключевые слова главной страницы (keywords)<textarea placeholder="KeyWords" id="seok">' + result.keywords + '</textarea></label>\
					<label>Google-site-verification <input value="' + result.google + '" type="text" placeholder="Только содержимое атрибута content (вида 5c596b3638097005)" id="seog"></label>\
					<label>Yandex-verification<input value="' + result.yandex + '" type="text" placeholder="Только содержимое атрибута content (вида 5c596b3638097005)" id="seoy"></label>\
					<label>Ссылка на favicon <input value="' + result.favicon + '" type="text" placeholder="Изображение размером 32x32" id="seof"></label>\
					<label>Идентификатор отслеживания Google Analytics <input value="' + result.analytics + '" type="text" placeholder="UA-122044684-1" id="seoa"></label>\
					<label>Номер счетчика Яндекс.Метрики (вида 44405000) <input value="' + result.metrika + '" type="text" placeholder="Только цифры" id="seom"></label>');
				
				$('#list2 #addraion').click(apanel.seo.addraion.bind(this));
				$("#citys").change(apanel.seo.getraions.bind(this));
				$("#add").unbind().show().click(apanel.seo.seosave.bind(this));
				apanel.seo.getcity(result.city);
			});
		},
		getcity: function(result) {
			var json = {func:apanel.cfg.url.querypanel, domain:JSCat.domain, token:JSCat.token};
			json["action"] 	= "city_list";
			json["action2"] = "get"; 
			$.post("/json/", json, function(cityarr) {
				if (typeof cityarr !== 'object') cityarr = JSON.parse(cityarr);
				for (var b in cityarr) {
					$('#citys').append('<option city="' + cityarr[b].id + '" zoom="' + cityarr[b].zoom + '" coords="' + cityarr[b].coords + '">' + cityarr[b].name + '</option>');
				}
				$("#citys option[city=" + JSON.parse(result).city + "]").attr('selected', 'true');
				apanel.seo.getraions();
			});
		},
		seosave: function() {
		
				var arr = [];
				var element = $('#citys option:selected');
				$(element[0].attributes).each(function() {
					arr.push(this.name+':'+this.value);
				});
				arr.push('name:' + $("#citys option:selected").val());
								
				var arrs = arr.reduce(function(prev, curr) {
					prev[curr.split(':')[0]] = curr.split(':')[1];
					return prev;
				}, {});
				arrs = JSON.stringify(arrs).replace(/\[|\]/g, '');
	       
				var json = {func:apanel.cfg.url.querypanel, domain:JSCat.domain, token:JSCat.token};
				json["action"] 			= "seo";
				json["action2"] 		= "seosave";
				json["title"] 			= $("#seot").val();
				json["keywords"] 		= $("#seok").val();
				json["description"] 	= $("#seod").val();
				json["metrika"] 		= $("#seom").val();
				json["google"] 			= $("#seog").val();
				json["yandex"] 			= $("#seoy").val();
				json["favicon"] 		= $("#seof").val();
				json["analytics"] 		= $("#seoa").val();
				json["city"] 			= arrs;
				$.post("/json/", json, function() {
					alert('Выполнено')
				});
		},
		ogsave: function() {
			var ogdescription = $("#ogdescription").val();
			var ogtitle = $("#ogtitle").val();
			
			ogdescription = ogdescription.length > 300 ? ogdescription.substring(0, 297) + "..." : ogdescription;
			ogtitle = ogtitle.length > 65 ? ogtitle.substring(0, 62) + "..." : ogtitle;
				
			var json = {func:apanel.cfg.url.querypanel, domain:JSCat.domain, token:JSCat.token};
			json["action"] 			= "seo";
			json["action2"] 		= "ogsave";
			json["ogtitle"] 		= ogtitle;
			json["ogdescription"] 	= ogdescription;
			json["ogsite_name"] 	= $("#ogsite_name").val();
			json["ogimage"] 		= $("#ogimage").val();
			json["ogurl"] 			= $("#ogurl").val();
			$.post("/json/", json, function() {
				alert('Выполнено')
			});
		},
		links: function() {
			$( '#list2').empty().append('<div id="list" feed>\
				<div><span>Яндекс.Метрика<img src="/cdn/lib/y.png"></span><span><a href="https://metrika.yandex.ru/list?" target="_blank">Подключить</a></span></div>\
				<div><span>Яндекс.Вебмастер<img src="/cdn/lib/y.png"></span><span><a href="https://webmaster.yandex.ru" target="_blank">Подключить</a></span></div>\
				<div><span>Яндекс.Справочник<img src="/cdn/lib/y.png"></span><span><a href="https://yandex.ru/sprav/add" target="_blank">Добавить сайт</a></span></div>\
				<div><span>Яндекс.Конструктор карт<img src="/cdn/lib/y.png"></span><span><a href="https://yandex.ru/map-constructor" target="_blank">Добавить карту</a></span></div>\
				<div><span>Google Analytics<img src="/cdn/lib/g.png"></span><span><a href="https://www.google.com/analytics/" target="_blank">Подключить</a></span></div>\
				<div><span>Google Webmasters Tools<img src="/cdn/lib/g.png"></span><span><a href="https://google.com/webmasters/tools" target="_blank">Подключить</a></span></div>\
				<div><span>Google Business<img src="/cdn/lib/g.png"></span><span><a href="https://business.google.com/create" target="_blank">Добавить сайт</a></span></div>\
			</div>');
			$("#add").hide();		
		},
		addraion: function() {
			var param = ['add', $('#raions').val()];
			var json = {func:apanel.cfg.url.querypanel, domain:JSCat.domain, token:JSCat.token};
			json["action"] 	= "raions_setting";
			json["param"] 	= param;
			json["city"] = $('#citys option:selected').attr('city');
			$.post("/json/", json, function() {
				apanel.seo["seo"]();
			});
		},
		remove: function(id) {
			var param = ['remove', id];
			confirm({
				text: "Вы уверены?",
				ok: function() {
					var json = {func:apanel.cfg.url.querypanel, domain:JSCat.domain, token:JSCat.token};
					json["action"] = "raions_setting";
					json["param"] = param;
					$.post("/json/", json, function(){
        				apanel.seo["seo"]();
        	 		});
				}
			});
		},
		getraions: function() {
			$(".checks i").remove();
			var json = {func:apanel.cfg.url.querypanel, domain:JSCat.domain, token:JSCat.token};
			json["action"] 	= "raions_setting";
			json["city"] = $('#citys option:selected').attr('city');
			$.post("/json/", json, function(result) {
				if (result != null) {
					if (typeof result !== 'object') result = JSON.parse(result);
					for (var b in result.raion.id) {
						$(".checks").append('<i id="check' + b + '">' + result.raion.name[b] + '<i data="'+ result.raion.id[b] +'">×</i></i>');					
						$('[data="'+ result.raion.id[b] +'"]').click(apanel.seo.remove.bind(this, result.raion.id[b]))
	    			}
	    		} 
	    	});
	    },
		og: function() {
			var json = {func:apanel.cfg.url.querypanel, domain:JSCat.domain, token:JSCat.token};
			json["action"] 	= "seo";
			json["action2"] = "get"; 
			$.post("/json/", json, function(result) {
				if (typeof result !== 'object') result = JSON.parse(result);
				$( '#list2').empty().append('<div class="inputcontent">\
					<label>Open Graph:title. Заголовок страницы <input value="' + result.ogtitle + '" type="text" placeholder="Для него есть ограничение в 65 символов. Напишите что-то длиннее – текст будет обрезан." id="ogtitle"></label>\
					<label>Open Graph:description. Краткое описание <input value="' + result.ogdescription + '" type="text" placeholder="Краткое описание страницы длиной не более 300 символов." id="ogdescription"></label>\
					<label>Open Graph:image. URL изображения <input value="' + result.ogimage + '" type="text" placeholder="URL изображения, характеризующего страницу" id="ogimage"></label>\
					<label>Open Graph:url. Адрес сайта <input value="' + result.ogurl + '" type="text" placeholder="https://example.com" id="ogurl"></label>\
					<label>Open Graph:site_name. Название сайта <input value="' + result.ogsite_name + '" type="text" placeholder="Название сайта" id="ogsite_name"></label></div>');
									

 		
				$("#add").unbind().show().click(apanel.seo.ogsave.bind(this));
			});
		}
	},
	siteeditor: {
		start: function() {
			$( '[cabinet="'+ cabinet.cfg.selectors.ti +'"]').text(apanel.template.siteeditor[0]).append('<span>'+ apanel.template.siteeditor[1] +'</span>');
	    	var option = {
	    		addposition: 'Добавить', 
	    		add: 'Добавить позицию'
	    	}
	    	
			$( '#' + cabinet.cfg.selectors.cabinet + ' [content]').empty().append(cabinet.radiosgen(option, 'radios')).append('<div id="list" style="height:350px"></div><div class="checks"></div>');
			$('.radios').append('<span><input type="text" placeholder="Введите название" id="position"></span>\
						<button id="save">Сохранить разметку</button><button id="'+ apanel.cfg.selectors.casheclear +'">Удалить кэш</button>');
			$('.radios').prepend('<span style="float: left;"><label id="svname">Сохранить имя</label><input type="text" placeholder="до 10 символов" id="template">.otys.ru</span>');
				
			apanel.siteeditor.gethtml();
			apanel.siteeditor.getposition();
			apanel.siteeditor.gettemplatename();
			
			
			$('#'+ apanel.cfg.selectors.casheclear).click(apanel.siteeditor.clearcache.bind(this));	
			$('.radios [radios="add"]').click(apanel.siteeditor.addposition.bind(this));
			$('.radios [radios="addposition"], #position').parent().hide();
			$('#svname').click(apanel.siteeditor.templatenameSave.bind(this));	
		},
		clearcache: function() {
			confirm({
				text:   "Это критический процесс, который запустит генерацию стилей, скриптов и модулей меню. В течении минуты сайт может работать некорректно. Вы уверены?",
				ok: function() {
					var json = {func:apanel.cfg.url.querypanel, domain:JSCat.domain, token:JSCat.token};
					json["action"] 		= "jsoncasheclear";
					$.post("/json/", json, function(){
        				alert("Задача завершена. Удалите кэш в браузере и перезагрузите главную страницу сайта")
        	 		});
				}
			});
		},
		remove: function(id) {
			var param = ['remove', id];
			confirm({
				text:   "Позиции удалять не рекомендуется, это нарушит работоспособность сайта. Вы уверены?",
				ok: function() {
					var json = {func:apanel.cfg.url.querypanel, domain:JSCat.domain, token:JSCat.token};
					json["action"] = "pos_setting";
					json["param"] = param;
					$.post("/json/", json, function(){
        				apanel.siteeditor.start()
        	 		});
				}
			});
		},
		addposition: function() {
			$('.radios [radios="addposition"], #position').parent().show().addClass('left');
			$('.radios [radios="add"]').parent().hide();
			$('.radios [radios="addposition"]').click(apanel.siteeditor.add.bind(this));
		},
		add: function() {
			var param = ['add', $('#position').val()];
			var json = {func:apanel.cfg.url.querypanel, domain:JSCat.domain, token:JSCat.token};
			json["action"] 	= "pos_setting";
			json["param"] 	= param;
			$.post("/json/", json, function() {
				apanel.siteeditor.start()
			});
		},
		gettemplatename: function() {
			var json = {func:apanel.cfg.url.querypanel, domain:JSCat.domain, token:JSCat.token};
			json["action"] 	= "templatename";
			$.post("/json/", json, function(result) {
				if (typeof result !== 'object') result = JSON.parse(result);
				$('#template').val(result.templatename);
			});
		},
		templatenameSave: function() {
			var json = {func:apanel.cfg.url.querypanel, domain:JSCat.domain, token:JSCat.token};
			json["action"] 	= "templatenameSave";
			json["templatename"] 	= $('#template').val();
			$.post("/json/", json, function(result) {
				if (typeof result !== 'object') result = JSON.parse(result);
				alert(result.response)
			});
		},
		gethtml: function() {
			var json = {func:apanel.cfg.url.querypanel, domain:JSCat.domain, token:JSCat.token};
			json["action"] 	= "html";
			$.post("/json/", json, function(result) {
				if (typeof result !== 'object') result = JSON.parse(result);
				var code = apanel.getarea(result.html, 'xml');
				$('.CodeMirror, .CodeMirror-gutters').css({'height':'100%'});
				$('#save').click(apanel.siteeditor.savehtml.bind(this, code));
			});
		},
		getposition: function() {
			var json = {func:apanel.cfg.url.querypanel, domain:JSCat.domain, token:JSCat.token};
			json["action"] 	= "pos_setting";
			$.post("/json/", json, function(result) {
				if (typeof result !== 'object') result = JSON.parse(result);
				for (var b in result.pos.id) {
					$(".checks").append('<i id="check' + b + '">' + result.pos.name[b] + '<i data="'+ result.pos.id[b] +'">×</i></i>');					
					$('[data="'+ result.pos.id[b] +'"]').click(apanel.siteeditor.remove.bind(this, result.pos.id[b]))
	    		}
	    	});
	    },
	    savehtml: function(code) {
			var json = {func:apanel.cfg.url.querypanel, domain:JSCat.domain, token:JSCat.token};
			json["action"] 	= "htmlSave";
			json["html"] 	= code.getValue();
			$.post("/json/", json, function(result) {
				alert('Выполнено')
			});
		}
	},
	dbsettings: {
		start: function() {
			var json = {func:apanel.cfg.url.querypanel, domain:JSCat.domain, token:JSCat.token};
			json["action"] 	= "getSettings";
			$.post("/json/", json, function(result) {
				if (typeof result !== 'object') result = JSON.parse(result);
				
				var menu = {
					general: 'Динамические настройки',
					face: 'Внешний вид',
					social: 'Социальные сети',
					category: 'Категории'
				}
    			
    			$( '#' + cabinet.cfg.selectors.cabinet + ' [content]').empty().append(cabinet.radiosgen(menu, 'radios'));
			
				$('.radios [name]').change(function() {
					$('.radios label').removeClass('active').find('[radios]:checked').parent().addClass('active');
					var radios = $(this).attr('radios');
					if ($('[radios="'+ radios +'"]:checked').length) {
	    				$( '[cabinet="'+ cabinet.cfg.selectors.ti +'"]').text(apanel.template[radios][0]).append('<span>'+ apanel.template[radios][1] +'</span>');
						apanel.dbsettings[radios](result);
					}
				});
				$('.radios [radios="general"]').click();
			});
		},
		general: function(result) {
			$( '#list, #list2, .feedcontent' ).remove();
			$( '.radios' ).after('<div id="list"></div>');
					
			for (var b in result) {
				if (result[b].name != 'auth_type' && result[b].name != 'compare_feeds' && result[b].name != 'feedpremium') {
					$('#list').append('<div id="s' + result[b].id + '"><strong>' + result[b].comment + '</strong><span class="buffer"><input type="text" value="' + result[b].value + '" /><span class="input-buffer"></span><btn>Сохранить</btn></span></div>');
					$('#s' + result[b].id).click(apanel.dbsettings.rename.bind(this, result[b].id));
				} else if (result[b].name != 'auth_type') {
					var check = ( result[b].value == 'true' ) ? 'checked' : '';
					$('#list').append('<div id="s' + result[b].id + '"><strong>' + result[b].comment + '</strong><span><input type="checkbox" class="ios8" id="c'+ result[b].id +'" '+ check +'><label for="c'+ result[b].id +'"></label></span></div>');
					$('#s' + result[b].id + ' #c'+ result[b].id ).change(function() {
						var on = $(this).is(':checked');
						var id = $(this).attr('id').substr(1);
						apanel.dbsettings.save(id, on);
						return false;
					});
				}
			}
			return false;
		},
		face: function(result) {
			$( '#list, #list2, .feedcontent' ).remove();
			$( '.radios' ).after('<div id="list" class="aflex"></div>');
				
			for (var b in result) {
				if (result[b].name == 'auth_type') {
					var check = ( result[b].value == 'true' ) ? 'checked' : '';
					$('#list').append('<div id="s' + result[b].id + '"><strong>' + result[b].comment + '</strong><span><input type="checkbox" class="ios8" id="c'+ result[b].id +'" '+ check +'><label for="c'+ result[b].id +'"></label></span></div>');
					$('#s' + result[b].id + ' #c'+ result[b].id ).change(function() {
						var on = $(this).is(':checked');
						var id = $(this).attr('id').substr(1);
						apanel.dbsettings.save(id, on);
						return false;
					});
				}
			}
			apanel.dbsettings.getFace(result);
			return false;
		},
		addBg: function(name, b) {
			var $input = $('#' + name);
			var a = false;
			for (var i = 0; i < $input.prop('files').length; i++) {
				var xmlhttp = new XMLHttpRequest();
   			var form = new FormData(this);
   			link = '/json/';
				form.append('func', 'CGalery');
				form.append('action', 'load_img');
				form.append('img', $input.prop('files')[i]);
				xmlhttp.open('POST',link,'1');
				xmlhttp.send(form);
				xmlhttp.onreadystatechange = function() {
					if (xmlhttp.readyState == 4) {
						if (xmlhttp.status == 200) {
							if ( xmlhttp.response == false || !JSON.parse(xmlhttp.response)) {
								alert('Превышен размер изображения, или неверный формат!');
								return false;
							} else {
								var url = '/cdn/'+ JSCat.domain +'/file/'+ JSON.parse(xmlhttp.response);
								apanel.dbsettings.change(b, url);
							}
						}
					}
				}
			}	
		},
		ingallery: function(b) {
			var json = {func:'CGalery', domain:JSCat.domain, token:JSCat.token};
			json["action"] = "ingallery";
			json["type"] = b;
			$.post("/json/", json, function(result) {
				if (typeof result !== 'object') result = JSON.parse(result);
				$('#'+ b +'container').addClass('open').empty();
           	for (var key in result) {
        	  		var url = '/cdn/moscow.otys.ru/file/' + result[key].name;
           		$('#'+ b +'container').append('<div data-id="'+ result[key].id +'"><img src="'+ url +'"></div>');
					$('[data-id="'+ result[key].id +'"]').click(apanel.dbsettings.change.bind(this, b, url));
				}	
		   });
		},
		getFace: function(result) {
    		var json = {func:apanel.cfg.url.querypanel, domain:JSCat.domain, token:JSCat.token};
			json["action"] = 'getFace';
			json["param"] = 'get';
			$.post("/json/", json, function(face) {
				if (typeof face !== 'object') face = JSON.parse(face);
				function files(name, b) {
					$('#' + name).unbind().click().change(apanel.dbsettings.addBg.bind(this, name, b));
				}

				JSON.sort = function(o) {
					if (Array.isArray(o)) {
						return o.sort().map(JSON.sort);
					} else if (Object.prototype.toString.call(o) === '[object Object]') {
						return Object.keys(o).sort().reduce(function(a, k) {
							a[k] = JSON.sort(o[k]);
							return a;
						}, {});
					}
					return o;
				}
				face = JSON.sort(face);
				
				var a = '';			
				for (var b in face) {
					var key = Object.keys(face[b]);
					switch (b) {
						case 'bg':
							var val = (face[b][key]) ? face[b][key].match(/\((.*)\)/)[1] : '/cdn/lib/nophoto.png';
							$('#list').append('<div class="mt10"><strong>' + key + '</strong><br><div id="'+ b +'">\
									<span><img id="newbg" src="'+ val +'"></span>\
									<div><button id="ingallerybg">Выбрать из галереи</button><button id="incomputerbg">Загрузить с компьютера</button>\
									<i>Рекомендуемый размер изображения - 1920*1080 пикселей</i><input type="file" id="files2" enctype="multipart/form-data" style="display:none"></div>\
								</div></div><div id="bgcontainer" class="img_view"></div>');
							$('#incomputerbg').click(files.bind(this, 'files2', b));
							$('#ingallerybg').toggleClass('open').click(apanel.dbsettings.ingallery.bind(this, b));
						break;
						case 'bglogo':
							var val = (face[b][key]) ? face[b][key] : '/cdn/moscow.otys.ru/file/homes.svg';
							$('#list').append('<div class="mt10"><strong>' + key + '</strong><br><div id="'+ b +'">\
									<span><img id="newbglogo" src="'+ val +'"></span>\
									<div><button id="ingallerybglogo">Выбрать из галереи</button><button id="incomputerlogo">Загрузить с компьютера</button>\
									<i>Не загружайте слишком большое изображение в качестве логотипа - это может затруднить работу сайта</i><input type="file" id="files1" enctype="multipart/form-data" style="display:none"></div>\
								</div></div><div id="bglogocontainer" class="img_view"></div>');
							$('#incomputerlogo').click(files.bind(this, 'files1', b));
							$('#ingallerybglogo').toggleClass('open').click(apanel.dbsettings.ingallery.bind(this, b));
						break;
						case 'animate':
						case 'mobile':
						case 'view':
							a = (face[b][key].match(/\d+/)[0] == 1) ? 'checked' : '';
							$('#list').append('<div><strong>' + key + '</strong><span><input type="checkbox" class="ios8" id="'+ b +'" '+ a +'><label for="'+ b +'"></label></span></div>');
							$('#'+ b).change(apanel.dbsettings.change.bind(this, b, '1'));
						break;
						case 'font':
							$('#list').append('<div><strong>' + key + '</strong><span><select id="'+ b +'">\
									<option value="arial">Arial</option>\
									<option value="tahoma">Tahoma</option>\
									<option value="verdana">Verdana</option>\
									<option value="times">Times New Roman</option>\
								</select></div>');
							$('#' + b).val(face[b][key]);
							$('#'+ b).change(apanel.dbsettings.update.bind(this, 'font', $('#' + b).val()));
						break;
						case 'color':
							$('#list').append('<div><strong>' + key + '</strong><span><input type="color" id="'+ b +'" value="'+ face[b][key] +'"></span></div>');
							var source = document.querySelector('#' + b),
							picker = new CP(source);
							source.onclick = function(e) {
        						e.preventDefault();
    						}
    						picker.on("stop", function(color) {
        						this.source.value = '#' + color;
        						apanel.dbsettings.update('color', '#' + color);
        						return false;
    						});
						break;
						case 'deg':
							var val = Math.round(parseInt(face[b][key].match(/\d+/)[0]) / 360 * 100);
							setInterval(function(){
								if (!$('#newbglogo').hasClass('hue')) {
									$('#newbglogo[src*="/cdn/moscow.otys.ru/"], #bglogocontainer').css('filter', 'hue-rotate('+ face['deg']['Цвет иконок'] +')');
									$('#newbglogo').addClass('hue');
								}
							}, 100);
							$('#list').append('<div><strong>' + key + '</strong><span id="'+ b +'" value="'+ val +'"></span></div>');
							$('#deg').slider({
        						value: val,
        						change: function(e, ui) {
        							apanel.dbsettings.change('deg', Math.round(ui.value * 360 / 100) +'deg');
        						}
      					});
						break;
					}
				}
			});
		},
		change: function(name, param) {
			switch (name) {
				case 'animate':
				case 'mobile':
				case 'view':
					param = $('#' + name).is(":checked");
				break;
				case 'font':
					param = $('#font option:selected').attr('value');
				break;
				case 'deg':
        			$('#newbglogo[src*="/cdn/moscow.otys.ru/"], #bglogocontainer').css('filter', 'hue-rotate('+ param +')');
				break;
				case 'bglogo':
					confirm({
						text: 'Изменить логотип?',
						ok: function() {
							$('#new' + name).attr('src', param);
						}
					})
				break;
				case 'bg':
					confirm({
						text: 'Изменить фон?',
						ok: function() {
							$('#new' + name).attr('src', param);
							apanel.dbsettings.update('bg', 'url('+ param +')no-repeat center / cover');
							return false;
						}
					})
				break;
			}
			apanel.dbsettings.update(name, param);
			return false;
		},
		update: function(name, param) {
			var json = {func:apanel.cfg.url.querypanel, domain:JSCat.domain, token:JSCat.token};
			json["action"] = 'getFace';
			json["param"] = 'update';
			json["name"] = [name, param];
			$.post("/json/", json, function() {});
		},
		category: function() {
							
			$( '#list, #list2, .feedcontent' ).remove();
			$( '.radios' ).after('<div id="list" feed></div>');
					
			var json = {func:apanel.cfg.url.querypanel, domain:JSCat.domain, token:JSCat.token};
			json["action"] 	= "category_call";
			$.post("/json/", json, function(a) {
				if (typeof a !== 'object') a = JSON.parse(a);
				for (var prop in a.catalogue) {
					var cat = ($.inArray(prop, a.category) != '-1') ? ['1', 'checked="checked"'] : ['0', ''];
					var n1 = ($.inArray(prop, a.categoryn1) != '-1') ? ['1', 'checked="checked"'] : ['0', ''];
					var cian = ($.inArray(prop, a.categorycian) != '-1') ? ['1', 'checked="checked"'] : ['0', ''];
					var avito = ($.inArray(prop, a.categoryavito) != '-1') ? ['1', 'checked="checked"'] : ['0', ''];
					var yandex = ($.inArray(prop, a.categoryyandex) != '-1') ? ['1', 'checked="checked"'] : ['0', ''];
					var domclick = ($.inArray(prop, a.categorydomclick) != '-1') ? ['1', 'checked="checked"'] : ['0', ''];
					$('#list').append('<div>\
						<input class="ios8" id="cat' + prop + '" '+ cat[1] +' value="'+ cat[0] +'" type="checkbox" /><label title="" for="cat' + prop + '"></label><strong>' + a.catalogue[prop] + '</strong><span>\
						<input class="ios8" id="cian' + prop + '" '+ cian[1] +' value="'+ cian[0] +'" type="checkbox" /><label title="cian.ru" for="cian' + prop + '"></label>\
						<input class="ios8" id="avito' + prop + '" '+ avito[1] +' value="'+ avito[0] +'" type="checkbox" /><label title="avito.ru" for="avito' + prop + '"></label>\
						<input class="ios8" id="yandex' + prop + '" '+ yandex[1] +' value="'+ yandex[0] +'" type="checkbox" /><label title="realty.yandex.ru" for="yandex' + prop + '"></label>\
						<input class="ios8" id="domclick' + prop + '" '+ domclick[1] +' value="'+ domclick[0] +'" type="checkbox" /><label title="domclick.ru" for="domclick' + prop + '"></label>\
						<input class="ios8" id="n1' + prop + '" '+ n1[1] +' value="'+ n1[0] +'" type="checkbox" /><label title="n1.ru" for="n1' + prop + '"></label>\
					</span></div>');
					$('#cat' + prop).change(apanel.dbsettings.prop.bind(this, prop, 'cat'));
					$('#n1' + prop).change(apanel.dbsettings.prop.bind(this, prop, 'n1'));
					$('#cian' + prop).change(apanel.dbsettings.prop.bind(this, prop, 'cian'));
					$('#avito' + prop).change(apanel.dbsettings.prop.bind(this, prop, 'avito'));
					$('#yandex' + prop).change(apanel.dbsettings.prop.bind(this, prop, 'yandex'));
					$('#domclick' + prop).change(apanel.dbsettings.prop.bind(this, prop, 'domclick'));
				}
			});
		},
		prop: function(prop, board) {
			var json = {func:apanel.cfg.url.querypanel, domain:JSCat.domain, token:JSCat.token};
			json["action"] 	= "category_change";
			json["board"] 	= board;
			$('#' + board + prop).is(":checked") ? json["value"] = prop : json["remove"] = prop;
			$.post("/json/", json, function(a) {});
		},
		social: function(result) {
			$( '#list, #list2' ).remove();
			$( '.radios' ).after('<div id="list" feed>\
    			<div vk><span><img src="/cdn/lib/v.png"><a target="_blank">Не указаны настройки</a></span><span><a href="https://otys.ru/docs#doc122" target="_blank">Инструкция</a></span></div>\
    			<div ok><span><img src="/cdn/lib/o.png"><a href="https://ok.ru/vitrine/myuploaded" target="_blank">Подключить</a></span><span><a href="https://otys.ru/docs#doc122" target="_blank">Инструкция</a></span></div>\
    			<div fb><span><img src="/cdn/lib/f.png"><a>В разработке</a></span><span><a>Инструкция</a></span></div>\
    			<div in><span><img src="/cdn/lib/i.png"><a>В разработке</a></span><span><a>Инструкция</a></span></div>\
    		</div>');
    	
			if ( result.OKGroup_id.value != '' && 
				 result.OKPublic_Key.value != '' && 
				 result.OKSecret_Key.value != '' && 
				 result.OKAccess_token.value != '' && 
				 result.OKApplication_ID.value != '' && 
				 result.OKSecret_session_key.value != '' ) $('div[ok] span:first-of-type a').removeAttr('href').text('Подключено');
				
			if ( result.VKAT.value != '' && 
				 result.VKOauthID.value != '' && 
				 result.VKOauthServiceKey.value != '' && 
				 result.VKOauthProtectedKey.value != '' && 
				 ( result.VK_my_id.value != '' || result.VK_group_id.value != '' )) {
					$('div[vk] span:first-of-type a').removeAttr('href').text('Подключено');
			} else if ( result.VKOauthID.value != '' ) {
				 $('div[vk] span:first-of-type a').attr('href','https://oauth.vk.com/authorize?client_id='+ result.VKOauthID.value +'&scope=wall,offline,photos,groups&redirect_uri=https://oauth.vk.com/blank.html&display=page&response_type=token');
			} else $('div[vk] span:first-of-type a').text('Не указаны настройки');
			
		},
		rename: function(id) {
			var input = $('#s'+ id +' input[type="text"]');
			    input.css("border-color", "#d2d2d2");
			var buffer = $('#s'+ id +' .input-buffer');
			var btn = $('#s'+ id +' btn');
			input.focus();
			input.on('input', function() {
				var item = $(this);
			    buffer.text(item.val());
			    item.width(buffer.width()).css("border-color", "#d2d2d2");
        		btn.css("opacity", "1");
			});
    		btn.click(function() {
				var value = input.val();
				input.css("border-color", "transparent");
				btn.css('opacity', '0');
				apanel.dbsettings.save(id, value);
				return false;
			});
			return false;
		},
		save: function(id, value, name) {
			var param = [id, value];
			var json = {func:apanel.cfg.url.querypanel, domain:JSCat.domain, token:JSCat.token};
			json["action"] 	= "dbsettingSave";
			json["param"] 	= param;
			//if (name) json["name"] 	= name;
			$.post("/json/", json, function() {});
		}
	},
	emails: {
		start: function() {
			$( '[cabinet="'+ cabinet.cfg.selectors.ti +'"]').text(apanel.template.emails[0]).append('<span>'+ apanel.template.emails[1] +'</span>');
			var json = {func:apanel.cfg.url.querypanel, domain:JSCat.domain, token:JSCat.token};
			json["action"] 	= "universal";
			json["typefunc"] 	= "list";
			json["typemod"] 	= "email";
			$.post("/json/", json, function(result) {
				if (typeof result !== 'object') result = JSON.parse(result);
				$( '#' + cabinet.cfg.selectors.cabinet + ' [content]').empty().append('<br><div id="list"></div>');
				for (var b in result) {
					$('#list').append('<div id="mail' + result[b].id + '"><span>' + result[b].name + '</span><span>' + result[b].domain_id + '</span></div>');
					$('#mail' + result[b].id).click(apanel.emails.edit.bind(this, result[b]));
				}
			});
  		},
  		edit: function(mail) {
  								
    		var menu = {'save':'Сохранить','close':'Закрыть','view':'Предпросмотр'}
  			var line = '<div class="line"><span>' + mail.name + '</span></div><div id="list"></div>';
    		$( '#' + cabinet.cfg.selectors.cabinet + ' [content]').empty().append(cabinet.radiosgen(menu, 'radios')).append(line);
 			
			var Area = document.createElement("textarea");
			Area.className = 'Editor';
			Area.value = mail.html;
			$('#list').empty().append(Area);
			var code = CodeMirror.fromTextArea(Area, {
				lineNumbers: true,
				matchBrackets: true,
				styleActiveLine: true,
				mode : "xml"
			});
				
			//сохранить html
			$('.CodeMirror, .CodeMirror-gutters').css({'height':'100%'});
			$('.radios [radios="close"]').click(apanel.emails.start.bind(this));
			$('.radios [radios="view"]').click(apanel.emails.view.bind(this, mail, code));
 			$('.radios [radios="save"]').off().click(apanel.emails.save.bind(this, mail, code));	
		},
		save: function(mail, code) {				
			var json = {func:apanel.cfg.url.querypanel, domain:JSCat.domain, token:JSCat.token};
			json["action"] 	= "universal";
			json["typefunc"] 	= "save";
			json["typemod"] 	= "email";
			json["id"] 	= mail.id;
			json["html"] 	= code.getValue();
			$.post("/json/", json, function() {
				apanel.emails.start()
			});
		},
		view:  function(mail, code) {
			mail.html = code.getValue();
    		var menu = {'return':'Вернуться в редактор'}
  			var line = '<div class="line"><span>' + mail.name + ' (Предварительный просмотр)</span></div><div id="list"></div>';
    		$( '#' + cabinet.cfg.selectors.cabinet + ' [content]').empty().append(cabinet.radiosgen(menu, 'radios')).append(line);
			
			$('#list').append('<iframe style="width:100%;height:100%;border:0;" id="test"></iframe>');
			$('#test').contents().find('html').html(mail.html);
			$('.radios [radios="return"]').click(apanel.emails.edit.bind(this, mail));		 	
		} 
	},
	analytics:   function() {
		$( '[cabinet="'+ cabinet.cfg.selectors.ti +'"]').text(apanel.template.analytics[0]).append('<span>'+ apanel.template.analytics[1] +'</span>');
		var menu = {'general':'Основные','sales':'Сделки','objects':'Объекты','buys':'Клиенты','timer':'Задачи'}
    	$( '#' + cabinet.cfg.selectors.cabinet + ' [content]').empty().append(cabinet.radiosgen(menu, 'radios')).append('<div id="charts">');
		
		$('.radios [name]').change(function() {
			$('.little label').removeClass('active').find('[radios]:checked').parent().addClass('active');
			var radios = $(this).attr('radios');
			if ($('[radios="general"]:checked').length) {
				$( '#' + cabinet.cfg.selectors.cabinet + ' [content] #charts').empty().append('<div class="charts">\
					<div id="chart6"></div>\
					<div id="chart4" class="chart"></div>\
					<div id="chart5" class="chart"></div>\
					<div id="chart3"></div>\
					<div id="chart2"></div></div>');
				apanel.statistic();
			}
			var time = {'year':'Год','quarter':'Квартал','mounth':'Месяц'}

			if ($('[radios="sales"]:checked').length) {
				$( '#charts' ).empty().append('<div class="chart">'+ cabinet.radiosgen(time, 'sales1') +'<div id="sales1"><h3>Выручка</h3></div></div>');
				$( '#charts' ).append('<div class="chart">'+ cabinet.radiosgen(time, 'sales2') +'<div id="sales2"><h3>Количество сделок</h3></div></div>');
				$( '#charts' ).append('<div class="chart">'+ cabinet.radiosgen(time, 'sales3') +'<div id="sales3"><h3>Источники сделок</h3></div></div>');
				$( '#charts' ).append('<div class="chart">'+ cabinet.radiosgen(time, 'sales4') +'<div id="sales4"><h3>Воронка продаж</h3></div></div>');
				$( '#charts' ).append('<div class="chart">'+ cabinet.radiosgen(time, 'sales5') +'<div id="sales5"><h3>Лучшие сотрудники</h3></div></div>');
				$( '#charts .chart div' ).append( '<p>Недостаточно результатов для построения графика</p>' );
				$('.chart [radios]:first-of-type').click();
				$('.little label').removeClass('active').find('[radios]:checked').parent().addClass('active');
			}
			if ($('[radios="objects"]:checked').length) {
				$( '#charts' ).empty().append('<div class="chart">'+ cabinet.radiosgen(time, 'objects1') +'<div id="objects1"><h3>Количество новых объектов</h3></div></div>');
				$( '#charts' ).append('<div class="chart">'+ cabinet.radiosgen(time, 'objects2') +'<div id="objects2"><h3>Статусы</h3></div></div>');
				$( '#charts' ).append('<div class="chart">'+ cabinet.radiosgen(time, 'objects3') +'<div id="objects3"><h3>Типы недвижимости</h3></div></div>');
				$( '#charts' ).append('<div class="chart">'+ cabinet.radiosgen(time, 'objects4') +'<div id="objects4"><h3>Источники</h3></div></div>');
				$( '#charts' ).append('<div class="chart">'+ cabinet.radiosgen(time, 'objects5') +'<div id="objects5"><h3>Этапы</h3></div></div>');
				$( '#charts .chart div' ).append( '<p>Недостаточно результатов для построения графика</p>' );
				$('.chart [radios]:first-of-type').click();
				$('.little label').removeClass('active').find('[radios]:checked').parent().addClass('active');
			}
			if ($('[radios="buys"]:checked').length) {
				$( '#charts' ).empty().append('<div class="chart">'+ cabinet.radiosgen(time, 'buys1') +'<div id="buys1"><h3>Количество новых покупателей</h3></div></div>');
				$( '#charts' ).append('<div class="chart">'+ cabinet.radiosgen(time, 'buys2') +'<div id="buys2"><h3>Статусы</h3></div></div>');
				$( '#charts' ).append('<div class="chart">'+ cabinet.radiosgen(time, 'buys3') +'<div id="buys3"><h3>Типы недвижимости</h3></div></div>');
				$( '#charts' ).append('<div class="chart">'+ cabinet.radiosgen(time, 'buys4') +'<div id="buys4"><h3>Источники</h3></div></div>');
				$( '#charts' ).append('<div class="chart">'+ cabinet.radiosgen(time, 'buys5') +'<div id="buys5"><h3>Этапы</h3></div></div>');
				$( '#charts .chart div' ).append( '<p>Недостаточно результатов для построения графика</p>' );
				$('.chart [radios]:first-of-type').click();
				$('.little label').removeClass('active').find('[radios]:checked').parent().addClass('active');
			}
			if ($('[radios="timer"]:checked').length) {
				$( '#charts' ).empty().append('<div class="chart">'+ cabinet.radiosgen(time, 'timer1') +'<div id="timer1"><h3>Статусы: Выполненая/Активная</h3></div></div>');
				$( '#charts' ).append('<div class="chart">'+ cabinet.radiosgen(time, 'timer2') +'<div id="timer2"><h3>Типы задач: Встреча/Звонок/Показ</h3></div></div>');
				$( '#charts .chart div' ).append( '<p>Недостаточно результатов для построения графика</p>' );
				$('.chart [radios]:first-of-type').click();
				$('.little label').removeClass('active').find('[radios]:checked').parent().addClass('active');
			}
		});
		$('.radios [radios="general"]').click();
		return false;
	},
	users: {
		start: function() {
			$( '[cabinet="'+ cabinet.cfg.selectors.ti +'"]').text(apanel.template.users[0]).append('<span>'+ apanel.template.users[1] +'</span>');
	
	    	var option = {
	    		name: 'Имя пользователя', 
	    		username: 'Логин',
	    		phone: 'Телефон',
	    		id: 'ID пользователя'
	    	}
	    	
			$( '#' + cabinet.cfg.selectors.cabinet + ' [content]').empty().append(cabinet.radiosgen(option, 'radios')).append('<div id="list"></div>');
			$('.radios').append('<button id="add">Добавить</button><button id="save" style="display:none">Сохранить</button>\
									<button id="back" style="display:none">Назад</button><button id="find">Поиск</button>');
			$('.radios').prepend('<input type="text" placeholder="Параметры поиска" id="searchparam">');
			
			$('.radios [name]').change(function() {
				$('.radios label').removeClass('active').find('[radios]:checked').parent().addClass('active');
			});
			$('.radios [name]:first').click();
			
			$('#find').click(apanel.users.find.bind(this, [0]));
	    	$('#add').click(apanel.users.add.bind(this));	
	    	apanel.users.get();
		},
		get: function() {
			var json = {func:'CUser', domain:JSCat.domain, token:JSCat.token};
			json["action"] 	= 'getUsers';
			$.post("/json/", json, function(result) {
				if ( typeof result !== 'object' ) result = JSON.parse(result);
				for (a in result) {
					if ( result[a].email != 'mail@mail.ru')
						$('#list').append('<div id="u'+ result[a].id +'"><span>'+ result[a].name +'</span><span>'+ result[a].email +'</span><span>'+ result[a].id +'</span></div>');
					$('#u' + result[a].id).click(apanel.users.find.bind(this, ['id', result[a].id]));
				}		
			});
		},
		form: function(data) {
		
		    var usertype = apanel.getusertype();
		    delete usertype[5];
		    
    		var forms = '<div class="baseh">Параметры<div id="baseh">';
    		forms += '<div class="inline"><span>Логин:</span><input type="text" id="username" value="'+ data.username +'"><br>';
    	    forms += '<span>E-mail:</span><input type="text" id="email" value="'+ data.email +'"><br>';
    		forms += '<span>Телефон:</span><input type="text" id="phone" value="'+ data.phone +'"><br>';
    		forms += '<span>ФИО:</span><input type="text" id="name" value="'+ data.name +'"></div>';
    	    forms += '<div class="inline"><span>Тип пользователя:</span><select id ="usertype">'+ apanel.optiongen(usertype) +'</select><br>';
    		forms += '<span>Пароль:</span><input type="text" id="password" placeholder="Новый пароль"><br>';
    		forms += '<span>Статус:</span><select id="status"><option value="1">Активен</option><option value="0">Заблокирован</option></select>';
    	    forms += '</div></div></div>';
    	    return forms;
		},
		add: function() {
			$('#list').empty().append(apanel.users.form({username:'', email:'', phone:'', name:''}));
			$('#save').show().off().click(apanel.users.save.bind(this, 0));
			$('#back').show().off().click(apanel.users.back.bind(this, 0));
    	    $('#phone').mask("+7 (999) 999-99-99");
    	    $('.radios > *').hide();
    	    $('#back, #save').show();
		},
		back: function() {
	    	apanel.users.start();
		},
		save: function(id) {
			if (id == '0')
				if ((!$('#email').val()) || (!$('#username').val()) || (!$('#name').val()) || (!$('#password').val()) || (!$('#phone').val())) 
					return alert('Все поля обязательны для заполнения')
			var json = {func:apanel.cfg.url.queryuser, domain:JSCat.domain, token:JSCat.token};
			json["action"] 		= "saveUserAdmin";
			json["id"] 			= id;
			json["name"] 		= $('#name').val();
			json["phone"] 		= $('#phone').val();
			json["email"] 		= $('#email').val();
			json["status"] 		= $('#status option:selected').attr('value');
			json["usertype"] 	= $('#usertype option:selected').attr('value');
			json["username"] 	= $('#username').val();
			json["password"] 	= $('#password').val();
			$.post("/json/", json, function() {
				alert('Выполнено')
				apanel.users.start();
    	    });
		},
		find: function(param) {
			if (!param[1]) param = [$("[radios]:checked").attr('radios'), $('#searchparam').val()];
			if (typeof param[1] !== 'undefined' && param[1].length > 0) {
				var json = {func:'CUser', domain:JSCat.domain, token:JSCat.token};
				json["action"] 	= 'findUser';
				json["param"] 	= param;
				$.post("/json/", json, function(result) {
					if (typeof d !== 'object') result = JSON.parse(result);
    				apanel.users.detail(result);
				});
			} else alert('Не указаны параметры поиска')
		},
		detail: function(data) {
			if (data['error']) return $('#list').empty().append('<div>'+ data.error +'</div>');
    		
    		var construct = '<div><span>ID пользователя:</span><span>'+ data.id +'</span></div>';
    		construct += '<div><span>Дата регистрации:</span><span>'+ ((data.registerDate != '0') ? cabinet.timeConverterWithYear(data.registerDate) : '') +'</span></div>';
    		construct += '<div><span>IP последней авторизации:</span><span>'+ data.ipauth +'</span></div>';
    		construct += '<div><span>Браузер:</span><span>'+ data.browser +'</span><span>'+ data.system +', '+ data.device +'</span></div>';
    	    		
    		$('#list').empty().append(construct).append(apanel.users.form(data));	
    		$('#usertype [value="'+ data.usertype +'"]').attr("selected","selected");	
    		$('#status [value="'+ data.status +'"]').attr("selected","selected");
    		$('#save').show().off().click(apanel.users.save.bind(this, data.id));	
    	    $('#phone').mask("+7 (999) 999-99-99");
		}
	},
	catalogue: {
		start:	function() {

    		//var menu = {'add':'Создать каталог','catalogue':'Каталог','importxml':'XML загрузка'}
    		var menu = {'catalogue':'Каталог','importxml':'XML загрузка'}
    		$( '#' + cabinet.cfg.selectors.cabinet + ' [content]').empty().append(cabinet.radiosgen(menu, 'radios')).append('<div id="list"></div>');
		    //$("#add").click(apanel.catalogue.action.add.bind(this));
			
			$('.radios [name]').change(function() {
				$('.radios label').removeClass('active').find('[radios]:checked').parent().addClass('active');
				if ($('[radios="catalogue"]:checked').length) {
					$( '[cabinet="'+ cabinet.cfg.selectors.ti +'"]').text(apanel.template.catalogue[0]).append('<span>'+ apanel.template.catalogue[1] +'</span>');

					
					$('#list').empty();
					
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
				}
				if ($('[radios="importxml"]:checked').length) {
					$( '[cabinet="'+ cabinet.cfg.selectors.ti +'"]').text(apanel.template.importxml[0]).append('<span>'+ apanel.template.importxml[1] +'</span>');

					
					$('#list').empty().append('<div>Нет данных</div>');
					$('.radios').append('<input type="text" id="import" placeholder="Укажите ссылку на XML файл"><label id="import_xml">Импорт</label>');
    				$('#import_xml').click(apanel.catalogue.action.importxml.bind(this)); 
				}
			});
			$('.radios [radios="catalogue"]').click();
		},
		action:	 {
			importxml:	function() {
				if ($('#import').val().length && JSCat.userType == '1') {
					$('#import_xml').unbind().text('Ожидайте');
					
					function checkPendingRequest() {
            			if ($.active > 0) {
            			    window.setTimeout(checkPendingRequest, 1000);
            			    $('h2[m]').remove();
            			    $('#list').empty().before('<h2 m>Загрузка XML фида. Пожалуйста, не закрывайте это окно...</h2>').prepend('<div><img src="/cdn/lib/loading.gif" style="width:45px;margin:-13px auto;display:block"></div>');
            			} else {
            				$('#import_xml').unbind().text('Загрузка завершена');
            				$('#import').remove();
            			}
        			}
        			window.setTimeout(checkPendingRequest, 1000);
        
    				var json = {func:'CXML', domain:JSCat.domain, token:JSCat.token, user:JSCat.user};
					json["action"] = "setXML";
					json["url"] = $('#import').val();
					$.post("/json/", json, function(result) {
				    	if (typeof result !== 'object') result = JSON.parse(result);
				    	if (typeof result !== 'object') {
				    		alert(result);
				    		return false;
				    	}
						$('h2[m]').remove();
						$('#list').empty().before('<h2 m>Результаты импорта</h2>');
						for (var c in result.counts)
							$('#list').prepend('<div>' + c + '<span>' + result.counts[c] + '</span></div>');
					});
				} else {
					alert('Укажите ссылку на XML файл')
					return false;
				}
			},
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
			position: function(id) {
				var pos = $('#position option:selected').attr('value');
				var json = {func:apanel.cfg.url.querypanel, domain:JSCat.domain, token:JSCat.token};
				json["action"] 		= "selectPosition";
				json["param"] 		= [id, pos];
				$.post("/json/", json, function() {});
			},
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
			
			var typer = ['text', 'textarea', 'price', 'checkbox', 'radiobtn', 'fotoalbum', 'select', 'youtube', 'yandex', 'selectmenu', 'file', 'table'];
			
			$('#list_edit').empty().append('<label>Название</label><input id="caption" value="' + field.caption + '" type="text">\
						<textarea id="examples" placeholder="Дополнительные параметры">' + field.param + '</textarea>\
        				<label>Тип поля</label><div class="inputeditor"></div>\
						<label>ID поля: ' + field.name_field + '</label><br>\
						<label><input id="required" type="checkbox">Обязательное поле</label>\
						<label><input id="searchtext" type="checkbox">Текстовый поиск</label><br>\
						<button id="savefield">Сохранить</button><button id="removefield">Удалить</button><button onclick="$(\'#call_edit\').hide()">Отмена</button>');			

			for (name in typer) {
				$('.inputeditor').append('<label><input type="radio" name="typer" value="'+ typer[name] +'">'+ typer[name] +'</label>');
				if (typer[name] == field.type_field) $('[value="'+ typer[name] +'"]').prop('checked', true);
			}
				
			$('#required').prop('checked', (field.required == '1'));
			$('#searchtext').prop('checked', (field.searchtext == '1'));
			
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
    		baseh += '			<li>Позиция в шаблоне <select id="position"></select></li>';
    		baseh += '			<!--li id="remove' + list.domain_id + '">Удалить раздел</li-->';
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
				1: 'Подтверждение Email',
				2: 'Подтверждение телефона',
				3: 'Капча',
				4: 'Вручную',
				5: 'Без модерации'
			}
			for (key in moder) {
				$('#moderation').append('<option value="' + key + '">' + moder[key] + '</option>');
				$("#moderation option[value=" + list.moderation + "]").attr('selected', 'true');
				$('#moderation').change(apanel.catalogue.action.moderation.bind(this, list.domain_id));
			}
			
			var json = {func:apanel.cfg.url.querypanel, domain:JSCat.domain, token:JSCat.token};
			json["action"] = "Get_Position";
			$.post("/json/", json, function(poslist) {
				if (typeof poslist !== 'object') poslist = JSON.parse(poslist);
				for (key in poslist)
					$('#position').append('<option value="' + poslist[key] + '">' + poslist[key] + '</option>');
				
				$("#position option[value=" + list.position + "]").attr('selected', 'true');
				$('#position').change(apanel.catalogue.action.position.bind(this, list.domain_id));
			});
	
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
			var call_func = {
				useronline: 'Автор онлайн',
				dataspost: 'Дата подачи',
				datashow: 'Дата модерации',
				wrong: 'Жалоба',
				favorite: 'Избранное',
				username: 'Имя пользователя',
				similar: 'Похожие объявления',
				noob: 'Номер объявления',
				viewfunc: 'Статистика просмотров',
				current: 'Текущий пункт меню',
				phone: 'Телефон пользователя',
				moder: 'Модерация'
			}
			for (a in call_func)
				$('#list_func').append('<span class="funcname"><span>'+ call_func[a] +'</span><span>'+ a +'</span></span>');
			
			//список атрибутов каталога
			var call_attr = {
				'class="openp"': 'Открыть подробную карточку (popup)',
				'class="openb"': 'Открыть подробную карточку (target blank)',
				'class="openr"': 'Открыть подробную карточку (reload page)',
				'class="closep"': 'Закрыть подробную карточку (popup)',
				'class="closeform"': '"Отмена" в форме добавления',
				'class="save"': '"Сохранить" в форме добавления',
				'list="" class="add owner"': '"Редактировать" карточку',
				'list="" class="delete owner"': '"Удалить" карточку',
				'action="done" (произвольное имя)': 'Выполнение функции при добавлении'
			}		
			for (a in call_attr)
				$('#list_attr').append('<span class="funcname"><span>'+ call_attr[a] +'</span><span>'+ a +'</span></span>');
				
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
					//$('.param' + result[field].name_field).click(apanel.catalogue.fieldsetting.bind(this, result[field], list));
				}
				//$('#list_field').prepend('<span id="addfield">Добавить поле</span>');
				//$('#addfield').click(apanel.catalogue.action.addfield.bind(this, list));
			});
		},
		html: function(list) {
			
			var line = '<div class="line">';
				line += '	<span>' + list.title + ': </span><select id="changetemplate"></select>';
				line += '	<span id="call_edit" style="display:none">Настройки поля<span id="list_edit"></span></span>';
				line += '	<span id="call_attr">Атрибуты<span id="list_attr"></span></span>';
				line += '	<span id="call_func">Функции<span id="list_func"></span></span>';
				line += '	<span id="call_field">Поля ввода<span id="list_field"></span></span>';
				line += '</div><div id="list"></div>';
			
    		var menu = {'save':'Сохранить','close':'Закрыть'}
    		$( '#' + cabinet.cfg.selectors.cabinet + ' [content]').empty().append(cabinet.radiosgen(menu, 'radios')).append(line);
	
			//списки полей и функций
			apanel.catalogue.listfield(list);
			$('.radios [radios="close"]').click(apanel.catalogue.start.bind(this));			

			//меню шаблонов
			var template = {
				2: 'Карточка превью',
				1: 'Подробная карточка',
				3: 'Форма поиска',
				4: 'Карточка в админке',
				5: 'Форма добавления',
				6: 'Мои объявления',
				7: 'CRM подробная',
				8: 'Парсер превью',
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
	license: {
		start: function() {

	    	var option = {
	    		lic: 'Лицензия', 
	    		company: 'Компания',
	    		score: 'Счета'
	    	}
	    	
			$( '#' + cabinet.cfg.selectors.cabinet + ' [content]').empty().append(cabinet.radiosgen(option, 'radios')).append('<div id="list"></div><div id="list2"></div>');
			$('.radios').append('<button id="add"></button>');
						
			$('.radios [name]').change(function() {
				$('.radios label').removeClass('active').find('[radios]:checked').parent().addClass('active');
				var radios = $(this).attr('radios');
				if ($('[radios="'+ radios +'"]:checked').length) {
					$( '[cabinet="'+ cabinet.cfg.selectors.ti +'"]').text(apanel.template[radios][0]).append('<span>'+ apanel.template[radios][1] +'</span>');

					$('#add, #list, #list2, #scoretype').empty().hide();
					apanel.license[radios]();
				}
			});
			$('.radios [radios="lic"]').click();
				
		},
		lic: function() {
			var json = {func:apanel.cfg.url.querypanel, domain:JSCat.domain, token:JSCat.token};
			json["action"] 	= "company";
			json["action2"] = "lic"; 
			$.post("/json/", json, function(result) {
				if (typeof result !== 'object') result = JSON.parse(result);
				
				$('#add, #list, #list2, #scoretype').empty().hide();
    			$('#list').show().append('\
    					<div><span>Лицензионный ключ</span><strong>'+ result.license +'</strong></div>\
    					<div><span>Срок окончания</span><strong>'+ cabinet.timeConverterWithYear(Math.round(result.licensetime) + 31536000 ) +'</strong></div>\
    					<div><span>Дисковое пространство</span><strong>5Gb</strong></div>\
    					<div><span>Тариф</span><strong>Gold</strong></div>\
    					<div><span>Сервер обновлений</span><strong>general.otys.ru</strong></div>\
    					<div><span>Количество сайтов</span><strong>1</strong></div>\
    					<div><span>Домен</span><strong>'+ JSCat.domain +'</strong></div>\
    					<div><span>Лимит пользователей</span><strong>Безлимит</strong></div>');
		
			});
		},
		company: function() {
			var json = {func:apanel.cfg.url.querypanel, domain:JSCat.domain, token:JSCat.token};
			json["action"] 	= "company";
			json["action2"] = "get"; 
			$.post("/json/", json, function(result) {
				if (typeof result !== 'object') result = JSON.parse(result);
				$('#add, #list, #list2, #scoretype').empty().hide();
				$('#add').show().text('Сохранить изменения').unbind().click(apanel.license.save.bind(this));
				
				$('#list2').show().append('<div class="inputcontent">\
						<label>Коммерческое имя организации<input value="' + result.commercialname + '" type="text" placeholder="Пример: Агентство недвижимости Триумф" id="commercialname"></label>\
						<label>Основная специализация<input value="' + result.specialization + '" type="text" placeholder="Пример: Аренда коммерческой недвижимости" id="specialization"></label>\
						<label>Телефон<input value="' + result.phone + '" type="text" placeholder="+7 (123) 456-78-90" id="phone1"></label>\
						<label>E-mail<input value="' + result.mail + '" type="text" placeholder="admin@mail.ru" id="mail1"></label>\
						<label>Юридическое имя организации<input value="' + result.lawname + '" type="text" placeholder="ИП Иванов И.И." id="lawname"></label>\
						<label>Юридический адрес организации<input value="' + result.lawaddress + '" type="text" placeholder="Россия, Москва, улица Знаменка, 14/1, офис 123" id="lawaddress"></label>\
						<label>ФИО директора<input value="' + result.director + '" type="text" placeholder="Иванов И.И." id="director"></label>\
						<label>Контактное лицо и телефон для связи<input value="' + result.contactname + '" type="text" placeholder="Иванов Иван Иванович 8 (123) 456-78-90" id="contactname"></label></div>');
						$("#phone1").mask("+7 (999) 999-99-99");
			});
		},
		save: function() {
			var json = {func:apanel.cfg.url.querypanel, domain:JSCat.domain, token:JSCat.token};
			json["action"] 				= "company";
			json["action2"] 			= "set";
			json["mail1"] 				= $("#mail1").val();
			json["phone1"] 				= $("#phone1").val();
			json["lawname"] 			= $("#lawname").val();
			json["director"] 			= $("#director").val();
			json["lawaddress"] 			= $("#lawaddress").val();
			json["contactname"] 		= $("#contactname").val();
			json["commercialname"] 		= $("#commercialname").val();
			json["specialization"] 		= $("#specialization").val();
			$.post("/json/", json, function() {
				alert('Выполнено')
			});
		},
		score_add: function() {
			if ($('#scoretype option:selected').attr('value') != 'defaults') {
				var json = {func:apanel.cfg.url.querypanel, domain:JSCat.domain, token:JSCat.token};
				json["action"] 	= "toPays";
				json["typefunc"] = "add"; 
				json["name"] = '5000';  
				json["status"] = $('#scoretype option:selected').attr('value'); 
				$.post("/json/", json, function(result) { 
					alert('Счет сформирован и ожидает оплаты')
					setTimeout(function(){
						apanel.license.score();
					}, 1000)
				});
			} else alert('Выберите услугу')
    	},
		score_pay: function(id, name) {
			var json = {func:'CPay', domain:JSCat.domain, token:JSCat.token};
			json["action"] 	= "postPay";
			json["mail"] = JSCat.userMail; 
			json["domain"] = JSCat.domain;
			json["name"] = name; 
			json["id"] = id; 
			$.post("/json/", json, function(result) {
				$('#score' + id).append('<form id="payform" accept-charset="utf-8" method="post" action="https://otys.ru/views/modulbank.php">'+ result +'</form>');
				//$('#submits' + id).click();
				document.getElementById('payform').submit();
			});
		},
		score: function() {
					
			var scoretype = {
				defaults: 'Выберите услугу',
				hosting: 'Хостинг (1 год - 5000 рублей)',
				programmist: 'Программист (1 месяц - 5000 рублей)',
				seo: 'Поисковая оптимизация (1 месяц - 5000 рублей)',
				designer: 'Услуги дизайнера (1 месяц - 5000 рублей)',
				social: 'Социальные сети (1 месяц - 5000 рублей)',
				changetemplate: 'Смена шаблона (5000 рублей)',
				quiz: 'Услуги контекстной рекламы (5000 рублей)'
			}
			
			$('#scoretype').remove();
			$('.radios').append('<select style="width: 350px;" id ="scoretype">'+ apanel.optiongen(scoretype) +'</select>');
			var json = {func:apanel.cfg.url.querypanel, domain:JSCat.domain, token:JSCat.token};
			json["action"] 	= "toPays";
			json["typefunc"] = "list"; 
			$.post("/json/", json, function(scores) {
				if (typeof scores !== 'object') scores = JSON.parse(scores);
				$('#add').show().text('Создать счет').unbind().click(apanel.license.score_add.bind(this));
				
				$('#list2, #list').empty().show();
    		    if (scores == '') { 
    				$('#list').append("<div>Нет счетов для оплаты</div>");
        		} else {	    	    				
					for (var b in scores) {
						if (scores[b].payed == '0') {
							$('#list').append('<div id="score' + scores[b].id + '"><span>' + cabinet.timeConverter(scores[b].time) + ' - ' + scoretype[scores[b].status] +'</span>\
											<span>' + scores[b].name + '</span><span id="pay' + scores[b].id +'">Оплатить</span></div>');
							$('#pay' + scores[b].id).unbind().click(apanel.license.score_pay.bind(this, scores[b].id, scoretype[scores[b].status]));
						} else {
							$('#list').append('<div id="score' + scores[b].id + '"><span>' + cabinet.timeConverter(scores[b].time) + ' - ' + scoretype[scores[b].status] +'</span>\
											<span>' + scores[b].name + '</span><span>Оплачен</span></div>');
						}
					}
				}
			});
		}
	},
	digtotext: function(dig) {
	    this.words = {
    	    m3:[['тысяча','тысячи','тысяч'], ['миллион','миллиона','миллионов'], ['миллиард', 'миллиарда', 'миллиардов']],
    	    m2:['сто','двести','триста','четыреста','пятьсот','шестьсот','семьсот','восемьсот','девятьсот'],
    	    m1:['десять','двадцать','тридцать','сорок','пятьдесят','шестьдесят','семьдесят','восемдесят','девяносто'],
    	    m0:['один','два','три','четыре','пять','шесть','семь','восемь','девять','десять'],
    	    f0:['одна','две'],
    	    l0:['десять', 'одиннадцать','двенадцать','тринадцать','четырнадцать','пятнадцать','шестнадцать','семнадцать','восемнадцать','девятнадцать']
    	};
    	this.dim = function(dig, power, words) {
    	    var result = '';
    	    var pow = Math.floor(dig/Math.pow(10, power)) % Math.pow(10,3);
    	    if(!pow) return result;
    	    var n2 =  Math.floor(pow/100);
    	    var n1 =  Math.floor(pow%Math.pow(10,2)/10);
    	    var n0 =  Math.floor(pow%10);
    	    var s1 = (n1 > 0)?' ':'';
    	    var s0 = (n0 > 0)?' ':'';
    	    var get_n = function(){
    	        switch(power){
    	            case 0:
    	            case 6: 
    	            case 9: 
    	                result +=s0+words.m0[n0-1];
    	            break;
    	            case 3:
    	                if(n0 < 3){
    	                    result +=s0+words.f0[n0-1];
    	                }else{
    	                    result +=s0+words.m0[n0-1];
    	                }
    	            break;
    	        }
    	    };
    	    if(n2 > 0){
    	        result += words.m2[n2-1];
    	    }
    	    if(n1 > 0){
    	        if(n1 > 1){
    	            result +=s1+words.m1[n1-1];
    	            if(n0 > 0) get_n();
    	        }
    	        else{
    	            result +=s1+words.l0[n0]; 
    	        }            
    	    }else{
    	        if(n0 > 0) get_n();
    	    }        
    	    if(power){            
    	        var d = (power-3)/3;
    	        if((d == 0) && (n0+n1*10 >= 11 && n0+n1*10 <= 14)){
    	            result +=' '+words.m3[0][2];
    	        }else if(n0 == 1){
    	            result +=' '+words.m3[d][0];
    	        }
    	        else if((n0 >= 2) && (n0 <= 4)){
    	            result +=' '+words.m3[d][1];
    	        }
    	        else if((n0 == 0) || (n0 >= 5 && n0 <= 9)){
    	            result +=' '+words.m3[d][2];
    	        }
    	    }
    	    return result;
    	}       
    	this.result = '';
    	for(var i = 9 ; i > -1; i-=3){
    	    this.result += this.dim(dig, i, this.words) + ' ';
    	}
    	return this.result.replace(/[s]{2,}/ig,' ').trim();
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
	cabinet.prototype.change()
});




