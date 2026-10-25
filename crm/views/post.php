<?php namespace lib;
	if (!defined('VOCU_FWK')) die();
	if (!in_array('admin', $RoleUser) && !in_array('admin', $RoleGroup)) die();	
?>

<div content><div id="list"></div></div>


<script>


	function start() {
			var json = {func:'CPanel', domain:JSCat.domain, token:JSCat.token};
			json["action"] 	= "universal";
			json["typefunc"] 	= "list";
			json["typemod"] 	= "email";
			$.post("/json/", json, function(result) {
				if (typeof result !== 'object') result = JSON.parse(result);
				$('#cabinet [content]').empty().append('<br><div id="list"></div>');
				for (var b in result) {
					$('#list').append('<div id="mail' + result[b].id + '"><span>' + result[b].name + '</span><span>' + result[b].domain_id + '</span></div>');
					$('#mail' + result[b].id).click(edit.bind(this, result[b]));
				}
			});
  		}
  	function edit(mail) {
  								
    		var menu = {'save':'Сохранить','close':'Закрыть','view':'Предпросмотр'}
  			var line = '<div class="line"><span>' + mail.name + '</span></div><div id="list"></div>';
    		$('#cabinet [content]').empty().append(radiosgen(menu, 'radios')).append(line);
 			
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
			$('.radios [radios="close"]').click(start.bind(this));
			$('.radios [radios="view"]').click(view.bind(this, mail, code));
 			$('.radios [radios="save"]').off().click(save.bind(this, mail, code));	
		}
	function save(mail, code) {				
			var json = {func:'CPanel', domain:JSCat.domain, token:JSCat.token};
			json["action"] 	= "universal";
			json["typefunc"] 	= "save";
			json["typemod"] 	= "email";
			json["id"] 	= mail.id;
			json["html"] 	= code.getValue();
			$.post("/json/", json, function() {
				start()
			});
		}
	function view(mail, code) {
			mail.html = code.getValue();
    		var menu = {'return':'Вернуться в редактор'}
  			var line = '<div class="line"><span>' + mail.name + ' (Предварительный просмотр)</span></div><div id="list"></div>';
    		$('#cabinet [content]').empty().append(radiosgen(menu, 'radios')).append(line);
			
			$('#list').append('<iframe style="width:100%;height:100%;border:0;" id="test"></iframe>');
			$('#test').contents().find('html').html(mail.html);
			$('.radios [radios="return"]').click(edit.bind(this, mail));		 	
		}
	function radiosgen(arr, name) {
		var text = '<span class="'+ name +' little">';
		for (a in arr)
			text += '<label><input type="radio" name="'+ name +'" radios="'+ a +'">'+ arr[a] +'</label>';
			text += '</span>';
		return text;
	} 
	
	start();
</script>