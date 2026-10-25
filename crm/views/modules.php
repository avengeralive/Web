<?php namespace lib;
	if (!defined('VOCU_FWK')) die();
	if (!in_array('admin', $RoleUser) && !in_array('admin', $RoleGroup)) die();	
?>

<div id="top">
	<h1>Модули
		<i class="radios little" style="float: right;">
			<select cabinet="cats">
				<option type="mod_cssjs_editor">Материалы</option>
				<option type="mod_menu">Меню</option>
				<option type="mod_double_menu">Дублирующие меню</option>
				<option type="mod_str_navigation">Строка навигации</option>
			</select>
	  		<label id="addmod">+</label>
		</i>
    	<i>Структура и разметка основных страниц</i>
   </h1>
</div>

<div class="line"></div>
<div id="list"><div>Нет данных</div></div>





<script>

	$('[cabinet="cats"]').change(get.bind(this));
		
	function get() {
		var type = $('[cabinet="cats"] option:selected').attr('type');
		
	   $('.line').hide();
    	$('#list').empty().append('<div>Нет данных</div>');
		$('#addmod').unbind().text('Добавить модуль').click(action.add.bind(this, type));
		//получаем информацию о всех модулях одного типа
		var json = {func:'CPanel', domain:JSCat.domain, token:JSCat.token};
		json["action"] = "lists";
		json["type"] = type;
		$.post("/json/", json, function(result) {
			if (typeof result !== 'object') result = JSON.parse(result);
			if (!result['error']) {
				$('#list').empty();
				for (key in result) {
					if ( result[key].setting != '' && result[key].name == 'mod_cssjs_editor' ) {
						$('#list').append('<div id="m'+ key +'"><span>'+ result[key].title +'</span><span>'+ result[key].position +'</span><span>'+ key +'</span><i>js</i></div>');
					} else {
						$('#list').append('<div id="m'+ key +'"><span>'+ result[key].title +'</span><span>'+ result[key].position +'</span><span>'+ key +'</span></div>');
					}
					$('#m'+ key).click(edit.bind(this, result[key]));								
				}
			} 
		});
	}
	
	function edit(module) {
  			
  			var params = {
    			mod_menu:'Пункты меню',
    			mod_double_menu:'Параметры',
    			mod_banks:'Редактор скриптов',
    			mod_users:'Редактор скриптов',
    			mod_cssjs_editor:'Редактор скриптов',
    			mod_str_navigation:'Редактор скриптов'
    		}
  			
			var line = '<span id="title">';
				line += '	<input type="text" value="' + module.title + '" />';
				line += '	<span class="input-buffer"></span><btn>Сохранить</btn></span>';
				line += '	<span id="setting">Публикация</span>';
				line += '	<span id="params">' + params[module.name] + '</span>';
				line += '	<span id="save">Сохранить</span>';
				line += '	<span id="close">Закрыть</span>';
				line += '	<span id="remove">Удалить</span>';
				
    		$('.line').show().empty().append(line);
			if (module.name == 'mod_cssjs_editor') var code = getarea(module.html, 'xml');
			if (module.name == 'mod_double_menu') var code = getarea(module.html, 'xml');
			if (module.name == 'mod_menu') var code = getarea(module.html, 'xml');
			
			$('.CodeMirror, .CodeMirror-gutters').css({'height':'calc(100vh - 210px)'});
			$('#close').click(get.bind(this, module.name));
			$('#remove').click(action.remove.bind(this, module));
			$('#setting').click(publics.bind(this, module));
			$('#save').off().click(action.save.bind(this, module, code));
 			
			if (module.name == 'mod_menu') {
				$('#params').click(action.menuonoff.bind(this, module));
			} else $('#params').click(sparams.bind(this, module, params[module.name]));
			


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
					action.rename(module, title);
				} else alert('Введите название')
			});
		
		}
		
	function sparams(module, caption) {

		var line = '<span><b>'+ caption +': ' + module.title + '</b></span>';
		line += '<span id="return">Назад</span>';
		line += '<span id="save">Сохранить</span>';
		$('.line').show().empty().append(line);
   		
		var code = getarea(module.setting, 'javascript');
		$('.CodeMirror, .CodeMirror-gutters').css({'height':'calc(100vh - 210px)'});
		$('#return').click(edit.bind(this, module));	
		$('#save').click(action.savejs.bind(this, module, code));		
	}
		
	function publics(module) {
	
		var line = '<span><b>Настройки публикации: ' + module.title + '</b></span>';
		line += '<span id="return">Назад</span>';
		line += '<span id="save">Сохранить</span>';
		$('.line').show().empty().append(line);
		
			//Настройки публикации
			$('#list').empty().append('<div><div id="group"><b>Группы пользователей: </b></div></div>\
										<div><div id="listp"><b>Позиция в шаблоне: </b><br><br></div></div>\
										<div><div id="listm"><b>Список разделов: </b></div></div>\
										<div id="listmenu"></div>');
									
			$('#save').click(action.savesetting.bind(this, module));
			$('#return').click(edit.bind(this, module));
			
			if (module.name == 'mod_str_navigation') $('.radios [radios="return"]').off().click(get.bind(this, module.name));
			
			//На главной/На всех
			var json = {func:'CMenuAdm', domain:JSCat.domain, token:JSCat.token};
			json["action"] = "amenu";
			json["param"] = "list";
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
					$('#m' + menuid).click(action.getmenu.bind(this, module, menuid));
				}
								
				$('#inhome').click(action.change.bind(this, module, 'home'));
				$('#inall').click(action.change.bind(this, module, 'all'));
			

				for (user in getusertype()) {
					var cl = 'no_selected';
					for (var i = 0; i < module.access_usertype.length; i++) {
						if (module.access_usertype[i] == user)
							var cl = 'selected';
					}
					$('#group').append('<span id="g' + user + '" class="' + cl + '">' + getusertype()[user] + '</span>');
					$('#g' + user).click(action.changeuser.bind(this, module, user));
				}
					
				var json = {func:'CPanel', domain:JSCat.domain, token:JSCat.token};
				json["action"] 		= "pos_setting";
				$.post("/json/", json, function(result) {
					if (typeof result !== 'object') result = JSON.parse(result);
		    		var cl = "no_selected";
					for (var i = 0; i < result.pos.name.length; i++) {
		    		    if (result.pos.name[i] == module.position) {
		    		    	cl = "selected";
		    		    } else cl = "no_selected";
		    		    $("#listp").append('<span id="p' + result.pos.id[i] + '" class="' + cl + '">' + result.pos.name[i] + "</span>");
		    		    $("#p" + result.pos.id[i]).click(action.changepos.bind(this, module, result.pos.id[i]));
		    	    }
				});
			});
		}

function action(params) {
	$.extend(this.options, params);
}

action.prototype = {
			add: function(type) {
				var json = {func:'CPanel', domain:JSCat.domain, token:JSCat.token};
				json["action"] 		= "addmod";
				json["typemod"] 	= type;
				$.post("/json/", json, function() {
					alert('Модуль добавлен')
 					get();
				});
			},
			remove: function(module) {
				confirm({
					text: "Удалить модуль: " + module.title + " ?",
					ok: function() {
						var json = {func:'CPanel', domain:JSCat.domain, token:JSCat.token};
						json["action"] 		= "dell";
						json["id"] 			= module.domain_id;
						$.post("/json/", json, function() {
 							get();
						});
					}
				});
			},
			save: function(module, code) {
				var param = [module.domain_id, module.name]
				var json = {func:'CPanel', domain:JSCat.domain, token:JSCat.token};
				json["action"] 		= "saveArticle";
				json["param"] 		= param;
				json["editor"] 		= code.getValue();
				$.post("/json/", json, function() {
 					get();
				});
			},
			savesetting:   function(module) {
				var json = {func:'CPanel', domain:JSCat.domain, token:JSCat.token};
				json["action"] 		= "savesetting";
				json["module"] 		= module;
				$.post("/json/", json, function() {
 					get();
				});
			},
			rename: function(module, title) {
				var param = [module.domain_id, title];
				var json = {func:'CPanel', domain:JSCat.domain, token:JSCat.token};
				json["action"] 	= "titleModule";
				json["param"] 	= param;
				$.post("/json/", json, function() {});
			},
			savejs: function(module, code) {
				var json = {func:'CPanel', domain:JSCat.domain, token:JSCat.token};
				json["action"] 		= "savejs";
				json["id"] 			= module.domain_id;
				json["editor"] 		= code.getValue();
				$.post("/json/", json, function(){
 					get();
				});
			},
			getmenu: function (module, menuid) {
				var json = {func:'CMenuAdm', domain:JSCat.domain, token:JSCat.token};
				json["action"] 		= "amenu";
				json["param"] 		= "parents";
				json["parent"] 		= menuid;
				$.post("/json/", json, function(result) {
					if (typeof result !== 'object') result = JSON.parse(result);
					showListMenu(module, menuid, result)
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
				var json = {func:'CMenuAdm', domain:JSCat.domain, token:JSCat.token};
				json["action"] 		= "amenu";
				json["param"] 		= "onoff";
				json["id"] 			= module.domain_id;
				$.post("/json/", json, function(result) {
					if (typeof result !== 'object') result = JSON.parse(result);
					$('#list').empty().append('<span id="menuids"></span>');
						
					for (menuid in result) {
						$('#menuids').append('<span on="' + result[menuid].published + '" id="menuitem_' + menuid + '">' + result[menuid].title + '</span>');
						$('#menuitem_' + menuid).click(action.changeoff.bind(this, menuid));
					}
				});
			},
			changeoff: function (menuid) {
				var on = $('#menuitem_' + menuid).attr('on');
 				if (on == '0') { on = '1', $('#menuitem_' + menuid).attr('on','1') }
 				else { on = '0', $('#menuitem_' + menuid).attr('on','0') }
	
				var json = {func:'CMenuAdm', domain:JSCat.domain, token:JSCat.token};
				json["action"] 		= "amenu";
				json["param"] 		= "onoff";
				json["onoff"] 		= on;
				json["id"] 			= menuid;
				$.post("/json/", json, function() {});
			}
		}	

	
	function showListMenu(param, idmenu, menu) {
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
	}
	
	function getarea(html, mode) {
		var Area = document.createElement("textarea");
		Area.value = html;
		$('#list').empty().append(Area);
		return CodeMirror.fromTextArea(Area, {
			lineNumbers: true,
			matchBrackets: true,
			styleActiveLine: true,
			mode : mode
		});
	}
	
	
	function getusertype() {
		return {
			1: 'Администратор',
			2: 'Пользователь',
			//3: 'Модератор',
			//4: 'Компания',
			5: 'Гость'
		}
	}
		
	

$(function() {
	action = new action();
	get();
});
</script>



