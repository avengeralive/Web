function amenu(params) {
	$.extend(this.options, params);
}

amenu.prototype = {
    build: '1.0',
    cfg: {
        url: {
            querymenu: 		'CMenuAdm',
            querycss: 		'CCSS'
        },
        selectors:	{
        	nameitem:		'nameitem',
        	additem:		'madd',
        	removeitem:		'mdel',
        	jseditor:		'mjs',
        	csseditor:		'mcss',
        	seoeditor:		'mseo',
        	savedialog:		'save_dialog',
        	closedialog:	'close',
        	inneritem:		'mselect_two',
        	innermenu:		'mselect_one',
        	totop:			'vverh',
        	tobottom:		'vniz',
        	ordering:		'ordering',
        	addpm:			'addpm',
        	
        	close:			'.close'
		}
    },
    tpl:	{
    	editor:		'<div class="fullscreen"><div class="popupmax"><div class="popupheader"><span class="form_full"></span><span class="close"></span></div><div class="popupcontent"></div><div class="ilist"><div class="add_css">Добавить</div><div class="ilist_div"></div></div></div></div>',
    	start:		'<div class="fullscreen"><div class="dialog"><p>Наcтройки пункта меню</p><input type="text" placeholder="Название" autofocus=""><div class="context3"><span class="ordering"><span id="vverh"></span><span id="ordering">-10</span><span id="vniz"></span></span><span id="madd">Добавить пункт</span><span id="mdel">Удалить пункт</span><span id="mjs">Редактор JS</span><span id="mcss">Редактор CSS</span><span id="mseo">SEO Наcтройки</span></div><div class="context2" id="context229115"><span style="float: right;">class: m29115</span><select class="mselect_one"></select><select class="mselect_two"></select></div><span class="save_dialog">Cохранить</span><span class="close"></span></div></div>',
    	addmenu:	'<div class="fullscreen"><div class="dialog"><p>Введите название</p><textarea autofocus="" placeholder="Название пункта меню, по одному в столбик"></textarea><span class="save_dialog">Добавить</span><span class="close"></span></div></div>',
    	seo:		'<div class="fullscreen"><div class="dialog"><p>SEO наcтройки</p><input caption type="text" placeholder="Title"><input description type="text" placeholder="Description"><input keywords type="text" placeholder="Keywords"><input cpu type="text" placeholder="Semantic_URL"><span id="save_seo" class="save_dialog">Cохранить</span><span class="close"></span></div></div>'
    },
	getinfo:   function() {
		//получаем инфо о всех модулях меню на странице + их позиции
		var menuarray = $(document.body).find('[id^=pos] > [class^=menu]');
		for (i = 0; i < menuarray.length; i++){
			var menu = menuarray[i].className.split('menu')[1];
			var pos = menuarray[i].offsetParent.id.split('pos')[1];
			//$('[id="pos' + pos + '"] > [class="menu' + menu + '"]').append('<span class="addpm"></span>');
			$('[id="pos' + pos + '"] > [class="menu' + menu + '"] .addpm').click(function(){
				amenu.destruct.form.bind(this);
				$(document.body).append(amenu.tpl.addmenu);
				$(amenu.cfg.selectors.close).click(amenu.destruct.form.bind(this));
				$('.save_dialog').click(function(){
					var json = {func:amenu.cfg.url.querymenu, domain:JSCat.domain, token:JSCat.token};
					json["action"] 		= "amenu";
					json["param"] 		= "add";
					json["name"] 		= $('.dialog textarea').val();
					json["item"] 		= '0';
					json["menu"] 		= menu;
					$.post("/json/", json, function(){
						location.reload()
					});
				});
			});
			amenu.builder();
			return false;
		}
	},
	builder:   function() {
		$( '[id^="pos"] > [class^="menu"] a' ).each(function(){
			var $item = $(this);
			//клик правой кнопкой
			$item.contextmenu(function() {
				var json = {func:amenu.cfg.url.querymenu, domain:JSCat.domain, token:JSCat.token};
				json["action"] 		= "amenu";
				json["param"] 		= "get";
				json["item"] 		= $item.attr('class').substring(1);
				$.post("/json/", json, function(param){
					param = JSON.parse(param);
					var start = '<div class="fullscreen">';
					start += '<div class="dialog">';
					start += '<p>Наcтройки пункта меню</p>';
					start += '<input id="' + amenu.cfg.selectors.nameitem + '" type="text" placeholder="Название" value="' + param.title + '" autofocus="">';
					start += '<div class="context3">';
					start += 	'<span class="ordering">';
					start += 		'<span id="' + amenu.cfg.selectors.totop + '"></span>';
					start += 		'<span id="' + amenu.cfg.selectors.ordering + '">' + param.ordering + '</span>';
					start += 		'<span id="' + amenu.cfg.selectors.tobottom + '"></span>';
					start += 	'</span>';
					start += 	'<span id="' + amenu.cfg.selectors.additem + '">Добавить пункт</span>';
					start += 	'<span id="' + amenu.cfg.selectors.removeitem + '">Удалить пункт</span>';
					start += 	'<span id="' + amenu.cfg.selectors.jseditor + '">Редактор JS</span>';
					start += 	'<span id="' + amenu.cfg.selectors.csseditor + '">Редактор CSS</span>';
					start += 	'<span id="' + amenu.cfg.selectors.seoeditor + '">SEO Наcтройки</span>';
					start += '</div>';
					start += '<div class="context2" id="context2'+ param.id +'">';
					start += 	'<span style="float: right;">class: m'+ param.id +'</span>';
					start += 	'<select class="' + amenu.cfg.selectors.inneritem + '"></select>';
					start += 	'<select class="' + amenu.cfg.selectors.innermenu + '"></select>';
					start += '</div>';
					start += 	'<span class="' + amenu.cfg.selectors.savedialog + '">Cохранить</span>';
					start += 	'<span class="' + amenu.cfg.selectors.closedialog + '"></span>';
					start += '</div>';
					start += '</div>';
					
					$(document.body).append(start);
					localStorage.setItem('ordering', param.ordering);
					amenu.actions(param);
					amenu.getmenus(param, null);
				});
				return false;
			});
		});
	},
	actions:   function(param) {
		$( '.dialog' ).find('.' +amenu.cfg.selectors.closedialog).click(function() {
			amenu.destruct.form();
			return false;
		});
		$( '.dialog' ).find('#' +amenu.cfg.selectors.additem).click(function() {
			//console.log(param)
			amenu.destruct.form.bind(this);
			$(document.body).append(amenu.tpl.addmenu);
			$(amenu.cfg.selectors.close).click(amenu.destruct.form.bind(this));
			$('.save_dialog').click(function(){
				var json = {func:amenu.cfg.url.querymenu, domain:JSCat.domain, token:JSCat.token};
				json["action"] 		= "amenu";
				json["param"] 		= "add";
				json["name"] 		= $('.dialog textarea').val();
				json["item"] 		= '0';
				json["menu"] 		= param.id_menu;
				$.post("/json/", json, function(){
					location.reload();
				});
			});
			return false;
		});
		$( '.dialog' ).find('#' +amenu.cfg.selectors.removeitem).click(function() {
			confirm({
				text: 'Удалить '+ param.title +'?',
				ok: function() {
					var json = {func:amenu.cfg.url.querymenu, domain:JSCat.domain, token:JSCat.token};
					json["action"] 		= "amenu";
					json["param"] 		= "del";
					json["item"] 		= param.id;
					$.post("/json/", json, function(a){
						location.reload()
					});
				}
				//cancel: function() {}
			});
			return false;
		});
		$( '.dialog' ).find('#' +amenu.cfg.selectors.jseditor).click(function() {
			amenu.editor('js', param);
			return false;
		});
		$( '.dialog' ).find('#' +amenu.cfg.selectors.csseditor).click(function() {
			amenu.editor('css', param);
			return false;
		});
		$( '.dialog' ).find('#' +amenu.cfg.selectors.seoeditor).click(function() {
			amenu.destruct.form.bind(this);
			$(document.body).append(amenu.tpl.seo);
			$('[placeholder="Semantic_URL"]').val(param.cpu);
			$('[placeholder="Description"]').val(param.description);
			$('[placeholder="Keywords"]').val(param.keywords);
			$('[placeholder="Title"]').val(param.caption);
			$(amenu.cfg.selectors.close).click(amenu.destruct.form.bind(this));
			$('#save_seo').click(function() {
				var json = {func:amenu.cfg.url.querymenu, domain:JSCat.domain, token:JSCat.token};
				json["action"] 		= "amenu";
				json["param"] 		= "seo"; 
				json["caption"] 		= $('[placeholder="Title"]').val();
				json["keys"] 		= $('[placeholder="Keywords"]').val();
				json["desc"] 		= $('[placeholder="Description"]').val();
				json["cpu"] 		= $('[placeholder="Semantic_URL"]').val();
				json["item"] 		= param.id;
				$.post("/json/", json, function(){
					location.reload()
				});
			});
		});
		$( '.dialog' ).find('.' +amenu.cfg.selectors.savedialog).click(function() { //save
			amenu.savedialog(param.id);
			return false;
		});
		$( '.dialog' ).find('#' +amenu.cfg.selectors.totop).click(function() { //top
			localStorage.ordering = parseInt(localStorage.ordering) - 1;
			$('#ordering').text(localStorage.ordering);
			return false;
		});
		$( '.dialog' ).find('#' +amenu.cfg.selectors.tobottom).click(function() { //bottom
			localStorage.ordering = parseInt(localStorage.ordering) + 1;
			$('#ordering').text(localStorage.ordering);
			return false;
		});
		$( '.dialog' ).find('.' +amenu.cfg.selectors.innermenu).change(function() {
			$( '.' +amenu.cfg.selectors.innermenu + ' option:selected' ).each(function() {
				var menu = $( this ).attr( 'menu' );
				var json = {func:amenu.cfg.url.querymenu, domain:JSCat.domain, token:JSCat.token};
				json["action"] 		= "amenu";
				json["param"] 		= "innermenu"; 
				json["menu"] 		= menu;
				json["item"] 		= param.id;
				$.post("/json/", json, function(){
					amenu.getmenus(param, menu);
				});
			});
			return false;
		});	
		$( '.dialog' ).find('.' +amenu.cfg.selectors.inneritem).change(function() {
			$( '.' +amenu.cfg.selectors.inneritem + ' option:selected' ).each(function() {
				var json = {func:amenu.cfg.url.querymenu, domain:JSCat.domain, token:JSCat.token};
				json["action"] 		= "amenu";
				json["param"] 		= "inneritem"; 
				json["new"] 		= $( this ).attr( 'new' );
				json["item"] 		= param.id;
				$.post("/json/", json, function(){
					//amenu.getmenus(param);
				});
			});
			return false;
		});	
	},
	getmenus:   function(param, menu) {
		if (menu == null) menu = param.id_menu;
		//парсим названия модулей меню
		var json = {func:amenu.cfg.url.querymenu, domain:JSCat.domain, token:JSCat.token};
		json["action"] 		= "amenu";
		json["param"] 		= "list";
		$.post("/json/", json, function(result) {

			if (typeof result !== 'object') result = JSON.parse(result);
			$( '.' +amenu.cfg.selectors.innermenu ).empty().append('<optgroup label="Модуль меню, где опубликован пункт"></optgroup>');
			for (menuid in result) {
				$( '.' +amenu.cfg.selectors.innermenu + ' optgroup').append('<option menu="' + menuid + '">' + result[menuid] + '</option>');
			}
			$( '.' +amenu.cfg.selectors.innermenu + ' option[menu="' + menu + '"]' ).prop("selected", true);
			
			//запрос всех пунктов текущего модуля
			var json = {func:amenu.cfg.url.querymenu, domain:JSCat.domain, token:JSCat.token};
			json["action"] 		= "amenu";
			json["param"] 		= "allinmodule"; 
			json["menu"] 		= $( '.' +amenu.cfg.selectors.innermenu + ' option:selected' ).attr( 'menu' );
			$.post("/json/", json, function(result) {
				
				if (typeof result !== 'object') result = JSON.parse(result);
				$( '.' +amenu.cfg.selectors.inneritem ).empty().append('<optgroup label="Уровень вложенности"><option new="0">Верхний уровень</option></optgroup>');
				for (itemid in result) {
					if (itemid != param.id)
					$( '.' +amenu.cfg.selectors.inneritem + ' optgroup').append('<option new="' + itemid + '">' + result[itemid] + '</option>');
				}
				$( '.' +amenu.cfg.selectors.inneritem + ' option[new="' + param.id_parent + '"]' ).prop("selected", true);

			});
		});
	},
	savedialog:   function(id) {
		var json = {func:amenu.cfg.url.querymenu, domain:JSCat.domain, token:JSCat.token};
		json["action"] 		= "amenu";
		json["param"] 		= "savedialog";
		json["nameitem"] 	= $('#' + amenu.cfg.selectors.nameitem).val();
		json["ordering"] 	= localStorage.ordering;
		json["id"] 			= id;
		$.post("/json/", json, function() {
			location.reload()
		});
	},
	editor:   function(cssjs, param) {
		amenu.destruct.form.bind(this);
		$(document.body).append(amenu.tpl.editor);
		$(amenu.cfg.selectors.close).click(amenu.destruct.form.bind(this));
		$('.form_full').click(function(){
			$('.popupmax').toggleClass('popupfull');
		});
		if (cssjs == 'js') var hashes = param.js_editor;
		if (cssjs == 'css') var hashes = param.css_editor;
		$( '.popupheader' ).append(param.title);
		$( '.add_css' ).click(amenu.cssjs.add.bind(this, cssjs, param));
		
		//передаем массив хэшей - ждем массив хэш-название
		if (hashes.length > 5) {
			var json = {func:amenu.cfg.url.querymenu, domain:JSCat.domain, token:JSCat.token};
			json["action"] 		= "amenu";
			json["param"] 		= "array";
			json["hashes"] 		= hashes;
			json["cssjs"] 		= cssjs;
			$.post("/json/", json, function(arr) {
				if (typeof arr !== 'object' ) arr = JSON.parse(arr);
				for (key in arr) {
					$('.ilist_div').append('<div class="iline" hash="'+ key +'">'+ arr[key] +'</div>');
					$('.iline[hash="'+ key +'"]').click(amenu.cssjs.get.bind(this, key, cssjs, param));
				}
			});
		}
		return false;
	},
	cssjs:   {
		get: function(hash, cssjs, param) {
			$('.iline').removeClass('active');
			$('.iline[hash="'+ hash +'"]').addClass('active');
			//запрашиваем содержимое по хэшу
			var json = {func:amenu.cfg.url.querymenu, domain:JSCat.domain, token:JSCat.token};
			json["action"] 		= "amenu";
			json["param"] 		= "hash";
			json["hash"] 		= hash;
			json["cssjs"] 		= cssjs;
			$.post("/json/", json, function(arr) {
				amenu.cssjs.publicsetting(cssjs, arr, param)
			});
			return false;
		},
		buttons: function(cssjs, code, hash, param) {
			//кнопки сохранить/удалить по хешу
			$('.ilist_bottom').find('.isave').click(function() {
				var home = $('.ichecks[selector="home"]').hasClass("on") ? "true":"false";
				var all = $('.ichecks[selector="all"]').hasClass("on") ? "true":"false";
				var th = $('.ichecks[selector="this"]').hasClass("on") ? "true":"false";
				var name = $('.iinput').val();
				var json = {func:amenu.cfg.url.querymenu, domain:JSCat.domain, token:JSCat.token};
				json["action"] 		= "amenu";
				json["param"] 		= "hsave";
				json["editor"] 		= code.getValue();
				json["name"] 		= name;
				json["cssjs"] 		= cssjs;
				json["hash"] 		= hash;
				json["home"] 		= home;
				json["all"] 		= all;
				json["this"] 		= th;
				json["id"] 			= param.id;
				$.post("/json/", json, function() {
					//при сохранении, шапка окна подсвечивается/моргает
					function morg(){
						$('.popupheader').css({"background":"#507299","transition":"1s"});
					}
					$('.popupheader').css({"background":"#5c86b5"});
					setTimeout(morg, 1e3);
				});
			});
			$('.ilist_bottom').find('.idel').click(function() {
				confirm({
					text: 'Вы уверены?',
					ok: function() {
						var json = {func:amenu.cfg.url.querymenu, domain:JSCat.domain, token:JSCat.token};
						json["action"] 		= "amenu";
						json["param"] 		= "hdel";
						json["cssjs"] 		= cssjs;
						json["hash"] 		= hash;
						json["id"] 			= param.id;
						$.post("/json/", json, function(){
							$('.ilist_bottom, .iline[hash="'+ hash +'"]').remove();
							$('.popupcontent').empty();
						});
					}
					//cancel: function() {}
				});
				return false;
			});
		},
		add: function(cssjs, param) {
			//кнопка добавить хеш
			var hash = (new Date().getTime()).toString(36);
			var json = {func:amenu.cfg.url.querymenu, domain:JSCat.domain, token:JSCat.token};
			json["action"] 		= "amenu";
			json["param"] 		= "hadd";
			json["hash"] 		= hash;
			json["cssjs"] 		= cssjs;
			json["id"] 			= param.id;
			$.post("/json/", json, function(arr) {
				$( '.ilist_bottom' ).remove();
				amenu.cssjs.publicsetting(cssjs, arr, param)
			});
		},
		publicsetting: function(cssjs, arr, param) {
			//настройки публикации хеша
			if (typeof arr !== 'object') arr = JSON.parse(arr);
			if ( arr.home == 'true' ) 	var ho = 'on';	
			if ( arr.all == 'true' ) var al = 'on';
			if ( arr.this == 'true' ) var th = 'on';
			
			var bottom = '<div class="ilist_bottom">';
			bottom += 		'<div class="ichecks '+al+'" selector="all">На всех</div>';
			bottom += 		'<div class="ichecks '+ho+'" selector="home">На главной</div>';
			bottom += 		'<div class="ichecks '+th+'" selector="this">На этой</div>';
			bottom += 		'<input class="iinput" type="text">';
			bottom += 		'<div class="isave">Cохранить</div>';
			bottom += 		'<div class="idel">Удалить</div>';
			bottom += 	'</div>';
			
			$( '.ilist_bottom' ).remove();
			$( '.ilist_div' ).after(bottom);
			$( '.iinput' ).val(arr.name);
			
			$( '.ilist_bottom .ichecks[selector]' ).click(function() {
				$(this).toggleClass('on')
			});
			$( '.ilist_bottom .ichecks[selector="all"]' ).click(function() {
				$( '.ilist_bottom .ichecks[selector="this"]' ).removeClass('on')
			});
			$( '.ilist_bottom .ichecks[selector="this"]' ).click(function() {
				$( '.ilist_bottom .ichecks[selector="all"]' ).removeClass('on')
			});
			
			//определяем подсветку синтаксиса
			if (cssjs == 'js') var mode = 'javascript';
			if (cssjs == 'css') var mode = 'css';
			//вызываем редактор
			var Editor = document.createElement("textarea");
			Editor.className = 'Editor';
			Editor.value = arr.css;
			$('.popupcontent').append(Editor);
			$('.CodeMirror').remove();
			var code = CodeMirror.fromTextArea(Editor, {
				lineNumbers: true,
				matchBrackets: true,
				styleActiveLine: true,
				mode : mode
			});
			//инициируем в конце
			amenu.cssjs.buttons(cssjs, code, arr.hash, param);
		}
	},
	destruct:   {
		form:   function() {
			$( '.fullscreen' ).remove();
			localStorage.removeItem('ordering');
			return false;
		}
	}
}

$(function() {
	amenu = new amenu();
	amenu.getinfo();
});
