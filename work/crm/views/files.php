<?php namespace lib;
	if (!defined('VOCU_FWK')) die();
	if (!in_array('admin', $RoleGroup) && !in_array('admin', $RoleUser)) die();
?>

<div id="top">
	<h1>Диспетчер файлов
		<i class="radios little" style="float: right;">
			<label id="addmod">Добавить альбом</label>
			<input type="file" multiple="" id="files" enctype="multipart/form-data" style="display:none"></span>
		</i>
    	<i>Изображения и документы</i>
   </h1>
</div>

<div class="line"></div>
<div id="list"></div>







<script>

	function start(album) {
	    $('.line').hide();
			$('#addmod').click(save.bind(this));
    
			var json = {func:'CGalery', domain:JSCat.domain, token:JSCat.token};
			json["action"] 		= "gets";
			$.post("/json/", json, function(result) {
				if (typeof result !== 'object') result = JSON.parse(result);
				$('#list').empty();
           		for (var key in result) {
    	        	$('#list').append('<div id="a'+ result[key].id +'"><strong id="album' + result[key].id + '">'+ result[key].name + '</strong></div>');
					$('#a' + result[key].id).click(get.bind(this, result[key]));	
				}
				if (typeof album != 'undefined') $('#a' + album.id).click();
		    });
		}
	function remove(id, name, album) {
			confirm({
				text:   "Вы уверены?",
				ok:     function() {
					var json = {func:'CGalery', domain:JSCat.domain, token:JSCat.token};
					json["action"] 		= "remove_item";
					json["table"] 		= name;
					json["id"] 			= id;
					$.post("/json/", json, function() {
						start(album);
    				});
   				 }
   			});
		}
	function save() {
			var param = ['new', 'new'];
			var json = {func:'CGalery', domain:JSCat.domain, token:JSCat.token};
			json["action"] = "album";
			json["param"] = param;
			$.post("/json/", json, function(result) {
				alert('Альбом добавлен')
				start();
    		});
		}
	function add(album) {
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
				start(album);
			}	
		}
	function get(album) {
			var json = {func:'CGalery', domain:JSCat.domain, token:JSCat.token};
			json["action"] = "gets";
			json["id"] = album.id;
			$.post("/json/", json, function(result) {
				if (typeof result !== 'object') result = JSON.parse(result);
				
			var line = '<span id="title">';
				line += '	<input type="text" value="' + album.name + '" />';
				line += '	<span class="input-buffer"></span><btn>Сохранить</btn></span>';
				line += '	<span id="addimg">Добавить изображение</span>';
				line += '	<span id="return">Назад</span>';
				
    		$('.line').show().empty().append(line);
					
    			$('#list').empty().append('<div class="img_view"></div>');
				$('#addimg').click(files.bind(this, album.id));
				$('#return').click(start.bind(this));
    		
    		
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
					rename(album.id, title);
				} else alert('Введите название')
			});
			
	        	function files(id) {
					$('#files').unbind().click().change(add.bind(this, album));
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
					$('[data-id="' + result[key].id + '"]').click(remove.bind(this, result[key].id, 'photo', album))
				
           		}  
    		});
		}
		
	function rename(id, title) {
				var param = [id, title];
				var json = {func:'CPanel', domain:JSCat.domain, token:JSCat.token};
				json["action"] 	= "albumName";
				json["param"] 	= param;
				$.post("/json/", json, function() {});
			}
			
start();
</script>



