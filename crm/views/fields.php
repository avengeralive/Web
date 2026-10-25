<?php namespace lib;
	if (!defined('VOCU_FWK')) die();
	if (!in_array('tech', $RoleGroup) && !in_array('tech', $RoleUser)) die();
?>

<style>
.table > thead:first-child > tr:first-child > th {
    font-size: 13px;
}
</style>
<div id="top">
	<h1>Конструктор полей
		<!--i class="radios little" style="float: right;"><label id="addfield">Добавить</label></i-->
		<i>Конструктор полей</i>
   </h1>
</div>

<div id="cat"></div>
<div id="list"></div>

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
			$('#list').empty();
			
			//список полей каталога
			var json = {func:apanel.cfg.url.querypanel, domain:JSCat.domain, token:JSCat.token};
			json["action"] 			= "fieldList";
			json["list_id"] 		= '17';
			$.post("/json/", json, function(result) {
				if (typeof result !== 'object') result = JSON.parse(result);
				for (field in result) {
					//$('#list_field').prepend('<span class="funcname"><span>' + result.caption[i] + '</span><span>' + result.name_field[i] + '</span></span>');
					
	 				$('#list').append('<div field="' + result[field].name_field + '"><span>' + result[field].caption + '</span><span>' + result[field].name_field + '</span><a class="param' + result[field].name_field + '">Редактировать</a></div>');
					$('.param' + result[field].name_field).click(apanel.catalogue.fieldsetting.bind(this, result[field], list));
				}
				$('#addfield').click(apanel.catalogue.action.addfield.bind(this, list));
			});
		},
		action:	 {
			onoff:	function(id) {
    			var checked = ($("#on" + id).prop('checked')) ? '1' : '0';
				var json = {func:apanel.cfg.url.querypanel, domain:JSCat.domain, token:JSCat.token};
				//json["action"] 	= "offBase";
				json["param"] 	= [id, checked];
				$.post("/json/", json, function(){});
			},
			savefield: function(field, list) {
				var json = {func:apanel.cfg.url.querypanel, domain:JSCat.domain, token:JSCat.token};
				json["action"] = "saveField";
				json["idbase"] = list.domain_id;
				json["param"] = $('#examples').val();
				json["id"] = field.id;
				json["caption"] = $('#caption').val();
				json["type_field"] = $('[name="typer"]:checked').val();
				json["show"] = $('#show').prop("checked");
				json["operator"] = $('#operator').prop("checked");
				json["required"] = $('#required').prop("checked");
				json["searchtext"] = $('#searchtext').prop("checked");
				$.post("/json/", json, function(result) {
					$('#field_edit').remove();
					apanel.catalogue.start(list);
					//setTimeout(() => {location.reload()}, 500)
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
	        		        $('#field_edit').remove();
	        		    	apanel.catalogue.start(list);
						});
					}
				});
			},
			addfield: function(list) {
				var json = {func:apanel.cfg.url.querypanel, domain:JSCat.domain, token:JSCat.token};
				json["action"] 			= "addField";
				json["type"] 			= "text";
				json["list"] 			= 17;
				$.post("/json/", json, function(){
					apanel.catalogue.start(list);
				});
			}
		},
		fieldsetting: function(field, list) {
			$('#field_edit').remove();
			$('#list div[field="'+ field.name_field +'"]').append('<table id="field_edit"></table>');
			//var typer = ['text', 'textarea', 'textint', 'checkbox', 'radiobtn', 'fotoalbum', 'select', 'youtube', 'yandex', 'selectmenu', 'file', 'table'];
			var typer = ['text', 'textarea', 'textint', 'checkbox', 'radiobtn', 'select'];
			
			$('#field_edit').append('<tr><td>\
						<label>Название</label><input id="caption" value="' + field.caption + '" type="text">\
						<textarea id="examples" placeholder="Дополнительные параметры">' + field.param + '</textarea></td><td>\
        				<div class="inputeditor"></div><br>\
						<label>ID поля: ' + field.name_field + '</label>\
						<button id="savefield">Сохранить</button><button id="removefield">Удалить</button><button onclick="$(\'#field_edit\').remove()">Отмена</button>\
						</td><td><label><input id="show" type="checkbox"> Доступно Оператору</label>\
						<label><input id="operator" type="checkbox"> Может ли Оператор изменять значение</label>\
						<label><input id="required" type="checkbox"> Обязательное поле</label>\
						<label><input id="searchtext" type="checkbox"> Текстовый поиск</label>\
						</td></tr>');			

			for (name in typer) {
				$('.inputeditor').append('<label><input type="radio" name="typer" value="'+ typer[name] +'">'+ typer[name] +'</label>');
				if (typer[name] == field.type_field) $('[value="'+ typer[name] +'"]').prop('checked', true);
			}
				
			$('#searchtext').prop('checked', (field.searchtext == '1'));
			$('#required').prop('checked', (field.required == '1'));
			$('#operator').prop('checked', (field.operator == '1'));
			$('#show').prop('checked', (field.show == '1'));
			
			$('#savefield').click(apanel.catalogue.action.savefield.bind(this, field, list));
			$('#removefield').click(apanel.catalogue.action.removefield.bind(this, field, list));
		}
	},
	optiongen: function(arr) {
		var text = '';
		for (a in arr)
			text += '<option value="'+ a +'">'+ arr[a] +'</option>';
		return text;
	},
	radiosgen: function(arr, name) {
		var text = '<span class="'+ name +' little">';
		for (a in arr)
			text += '<label><input type="radio" name="'+ name +'" radios="'+ a +'">'+ arr[a] +'</label>';
			text += '</span>';
		return text;
	}
}

$(function() {
	apanel = new apanel();
	apanel.catalogue.start()
});









</script>
