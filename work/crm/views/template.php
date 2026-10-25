<?php namespace lib;
	if (!defined('VOCU_FWK')) die();
	if (!in_array('admin', $RoleGroup) && !in_array('admin', $RoleUser)) die();
?>

<div id="top">
	<h1>Шаблон и позиции
    	<i class="radios little" style="float: right;">
    		<label id="save">Сохранить разметку</label>
    		<label id="casheclear">Удалить кэш</label>
    	</i>
    	<i>Редактор первичной разметки</i>
   </h1>
</div>

<div class="checks"></div>
<div id="list" style="height:calc(100vh - 230px)"></div>


<script>
	function start() {

			gethtml();
			getposition();
			
			
			$('#casheclear').unbind().click(clearcache.bind(this));	
		}
	function clearcache() {
			confirm({
				text:   "Это критический процесс, который запустит генерацию стилей, скриптов и модулей меню. В течении минуты сайт может работать некорректно. Вы уверены?",
				ok: function() {
					var json = {func:'CPanel', domain:JSCat.domain, token:JSCat.token};
					json["action"] 		= "jsoncasheclear";
					$.post("/json/", json, function(){
        				alert("Задача завершена. Удалите кэш в браузере и перезагрузите главную страницу сайта")
        	 		});
				}
			});
		}
	function remove(id) {
			var param = ['remove', id];
			confirm({
				text:   "Позиции удалять не рекомендуется, это нарушит работоспособность сайта. Вы уверены?",
				ok: function() {
					var json = {func:'CPanel', domain:JSCat.domain, token:JSCat.token};
					json["action"] = "pos_setting";
					json["param"] = param;
					$.post("/json/", json, function(){
        				start()
        	 		});
				}
			});
		}
	function addposition() {
			$('[radios="addposition"]').click(add.bind(this));
		}
	function add() {
			var param = ['add', $('#position').val()];
			var json = {func:'CPanel', domain:JSCat.domain, token:JSCat.token};
			json["action"] 	= "pos_setting";
			json["param"] 	= param;
			$.post("/json/", json, function() {
				start()
			});
		}

	function gethtml() {
			var json = {func:'CPanel', domain:JSCat.domain, token:JSCat.token};
			json["action"] 	= "html";
			$.post("/json/", json, function(result) {
				if (typeof result !== 'object') result = JSON.parse(result);
				var code = getarea(result.html, 'xml');
				$('.CodeMirror, .CodeMirror-gutters').css({'height':'100%'});
				$('#save').click(savehtml.bind(this, code));
			});
		}
	function getposition() {
			var json = {func:'CPanel', domain:JSCat.domain, token:JSCat.token};
			json["action"] 	= "pos_setting";
			$.post("/json/", json, function(result) {
				if (typeof result !== 'object') result = JSON.parse(result);
				$(".checks").empty().append('<i radios="addposition"><input type="text" placeholder="Введите название" id="position"><i radios="add">+</i></i>');
				for (var b in result.pos.id) {
					$(".checks").append('<i id="check' + b + '">' + result.pos.name[b] + '<i data="'+ result.pos.id[b] +'">×</i></i>');					
					$('[data="'+ result.pos.id[b] +'"]').click(remove.bind(this, result.pos.id[b]))
	    		}
				$('[radios="add"]').click(addposition.bind(this));
	    	});
	    }
	function savehtml(code) {
			var json = {func:'CPanel', domain:JSCat.domain, token:JSCat.token};
			json["action"] 	= "htmlSave";
			json["html"] 	= code.getValue();
			$.post("/json/", json, function(result) {
				alert('Выполнено')
			});
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
		
		start();
</script>

