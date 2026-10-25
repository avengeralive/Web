<?php namespace lib;
	if (!in_array('tech', $RoleGroup) && !in_array('tech', $RoleUser)) die();
	
	$Settings = CPanel::getSettings();
	$Antispam = CPanel::antispam();
	
	$Sms = CPanel::getSms();
?>
<!-- 
if (result[b].name == 'auth_type') {
						var check = ( result[b].value == 'true' ) ? 'checked' : '';
						$('#list').append('<div id="s' + result[b].id + '"><strong>' + result[b].comment + '</strong><span><input type="checkbox" class="ios8" id="c'+ result[b].id +'" '+ check +'><label for="c'+ result[b].id +'"></label></span></div>');
						$('#s' + result[b].id + ' #c'+ result[b].id ).change(function() {
							var on = $(this).is(':checked');
							var id = $(this).attr('id').substr(1);
							save(id, on);
							return false;
						});
					}
 -->
<style>
#list[feed] > div > span select,
#list3[feed] > div > span select,
#list3[feed] > div > span textarea,
#list3 .buffer input[type="text"] {
    font-size: 13px;
    padding: 5px;
    margin-top: -7px;
    max-width: 500px;
    min-width: 120px;
    border: 1px solid transparent;
    background: transparent;
    font-family: arial;
}
#list[feed] > div > span select,
#list3[feed] > div > span select,
#list3[feed] > div > span textarea,
#list3[feed] > div > span input[type="text"],
#list[feed] > div > span input[type="text"] {
    margin-left: -50px;min-width: 500px;
}
#list3 > div[user] span span,
#list > div[user] span span {
    width: 130px;
}
#list3 > div{display: table;
    width: 100%;}
#list3 > div > span:last-of-type {
    float: right;
}
#list3 > div > span:first-of-type {
    width: 70%;
    color: #444;
}
#list3 > div strong {
    text-transform: uppercase;
    font-weight: normal;
}
#list3 > div > span:first-of-type:last-of-type,
#list > div > span:first-of-type:last-of-type {display: flex;
    justify-content: space-around;}
#list3 > div [class^="icon-"]:before, 
#list3 > div [class*=" icon-"]:before,
#list > div [class^="icon-"]:before, 
#list > div [class*=" icon-"]:before {
    font-size: 29px;
    float: left;
    margin: -8px 10px 0 0;
    color: #b7b7b7;
}
#list3 > div.active i,
#list > div.active i {    display: block;
    color: white;
    float: none;
    font-style: normal;
    font-size: 14px;
    text-align: center;
    width: 130px;
    line-height: 20px;
    font-weight: normal;}
#list3 > div.active i:before,
#list > div.active i:before {    display: inline-block;
    vertical-align: bottom;
    font-size: 20px;
    color: white;
    margin: 0 5px;
    float: none;}
#list3 > div i[empty],
#list > div i[empty] {
    width: 40px;
}
#list3 > div.active,
#list > div.active {background:#3f76ac;color:white;}
</style>

<div id="top">
	<h1>Настройки
<ul class="nav nav-tabs" style="float: right;font-size: 14px;font-weight: normal;">
  <li class="active"><a data-toggle="tab" href="#container-1">Общие</a></li>
  <li><a data-toggle="tab" href="#container-2">Антиспам</a></li>
</ul>
    	<i>Для изменения, выберите нужную категорию</i>
   </h1>
</div>

<div class="tab-content" id="list2" style="padding-top: 6px;">
	<div id="container-1" class="tab-pane fade in active">
		<div feed id="list">	
			<div class="active">
				<strong>Название</strong>
				<span>
					<i class="icon-star-1">Значение</i><i empty=""></i><i empty=""></i><i empty=""></i><i empty=""></i><i empty=""></i><i></i>
				</span>
			</div>	
			<?php 
			foreach ($Settings as $key => $value) {
				if (in_array($JSCat['userType'], ['1'])) {
					if (!in_array($key, ['8','11','13'])) { //если не селекты
						if (!in_array($key, ['6','9'])) {//если не чекбоксы
							echo '<div settings id="s'. $key .'">
								<strong>'. $value['comment'] .'</strong>
								<span class="buffer"><input type="text" value="'. $value['value'] .'" /><span class="input-buffer"></span><btn>Сохранить</btn></span>
							</div>';
						} else {
							$check = ( $value['value'] == 'true' ) ? 'checked="checked"' : '';
							echo '<div settings id="s'. $key .'">
								<span><input type="checkbox" class="ios8" id="cf'. $key .'" '. $check .'><label for="cf'. $key .'"><strong>'. $value['comment'] .'</strong></label></span>
								<span></span>
							</div>';
						}
					} else {
						if ($key != '13') {
							$options = '<option value="0">Не использовать</option>';
							foreach ($Sms as $k => $v) {
								$value0 = ($value['value'] == $k) ? ' selected="selected"' : '';
								$options .= '<option value="'. $k .'" '. $value0 .'>'. $v['comment'] .'</option>';
							}
						} else {
							$value0 = ($value['value'] == '0') ? ' selected="selected"' : '';
							$value1 = ($value['value'] == '1') ? ' selected="selected"' : '';
							$value2 = ($value['value'] == '2') ? ' selected="selected"' : '';
							$options = '<option value="0" '. $value0 .'>Не выбрано</option>
								<option value="1" '. $value1 .'>Предиктивный набор</option>
								<option value="2" '. $value2 .'>Актив</option>';
						}
						echo '<div settings id="s'. $key .'">
							<strong>'. $value['comment'] .'</strong>
							<span class="buffer"><select>'. $options .'</select><span class="input-buffer"></span><btn>Сохранить</btn></span>
						</div>';
					}
				}
			} ?>
		</div>
	</div>
	<div id="container-2" class="tab-pane fade">
		<div feed id="list3" style="border: 0;">	
			<div class="active">
				<strong>Название</strong>
				<span>
					<i class="icon-star-1">Значение</i><i empty=""></i><i empty=""></i><i empty=""></i><i empty=""></i><i empty=""></i><i></i>
				</span>
			</div>
			<?php 
			foreach ($Antispam as $key => $value) {
				if (in_array($JSCat['userType'], ['1'])) {
					switch ($key) {
						case '1':
							$value0 = ($value['value'] == '0') ? ' selected="selected"' : '';
							$value1 = ($value['value'] == '1') ? ' selected="selected"' : '';
							$value2 = ($value['value'] == '2') ? ' selected="selected"' : '';
							echo '<div settings id="a'. $key .'"><strong>'. $value['comment'] .'</strong>
							<span class="buffer"><select>
								<option value="0" '. $value0 .'>Не использовать</option>
								<option value="1" '. $value1 .'>Выводить ошибку при срабатывании фильтра</option>
								<option value="2" '. $value2 .'>Имитировать успешное оформление заказа</option>
							</select><span class="input-buffer"></span><btn>Сохранить</btn></span>
							</div>';
						break;
						case '2':
						case '4':
							$placeholder = ($key == '2') ? 'По одному на строку. Можно указывать маску, например: 192.168.2.155, 192.168.3.*' : 'Список слов или словосочетаний (по одному на строку)';
							echo '<div settings id="a'. $key .'"><strong>'. $value['comment'] .'</strong><span class="buffer">
							<textarea placeholder="'. $placeholder .'">'. $value['value'] .'</textarea>
							<span class="input-buffer"></span><btn>Сохранить</btn></span>
							</div>';
						break;
						case '5':
							$value0 = ($value['value'] == '0') ? ' selected="selected"' : '';
							$value1 = ($value['value'] == '1') ? ' selected="selected"' : '';
							$value2 = ($value['value'] == '2') ? ' selected="selected"' : '';
							echo '<div settings id="a'. $key .'"><strong>'. $value['comment'] .'</strong>
							<span class="buffer"><select>
								<option value="0" '. $value0 .'>Не использовать</option>
								<option value="1" '. $value1 .'>Запретить только выбранные страны</option>
								<option value="2" '. $value2 .'>Запретить все страны, кроме выбранных</option>
							</select><span class="input-buffer"></span><btn>Сохранить</btn></span>
							</div>';
						break;
						case '3':
						case '6':
						case '7':
						case '8':
							$placeholder = ($key == '7' || $key == '8') ? 'Установите 0 для снятия ограничений' : false;
							$placeholder = (!$placeholder && $key == '3') ? '0' : 'RU';
							echo '<div settings id="a'. $key .'"><strong>'. $value['comment'] .'</strong><span class="buffer">
								<input type="text" placeholder="'. $placeholder .'" value="'. $value['value'] .'" /><span class="input-buffer"></span><btn>Сохранить</btn></span>
							</div>';
						break;
					}
				} 
			}?>
		</div>
	</div>
</div>








<script>

		$('[settings][id^="s"]').click(function() {
			var el = $(this).attr('id');
			rename(el, 'dbsettingSave')
		});
		$('[settings][id^="a"]').click(function() {
			var el = $(this).attr('id');
			rename(el, 'antispamSave')
		});
		$('[id^="s"] [id^="cf"]').change(function() {
			var on = $(this).is(':checked');
			var id = $(this).attr('id').substr(2);
			save(id, on, 'dbsettingSave');
			return false;
		});

	function getcity() {
			var json = {func:'CPanel', domain:JSCat.domain, token:JSCat.token};
			json["action"] = "city_list";
			json["action2"] = "get"; 
			$.post("/json/", json, function(cityarr) {
				if (typeof cityarr !== 'object') cityarr = JSON.parse(cityarr);
				for (var b in cityarr) {
					$('#citys').append('<option city="' + cityarr[b].id + '" zoom="' + cityarr[b].zoom + '" coords="' + cityarr[b].coords + '">' + cityarr[b].name + '</option>');
				}
				$("#citys option[city=" + JSON.parse(JSCat.city).city + "]").attr('selected', 'true');
				$("#citys").change(seosave.bind(this));
				$("#save").click(seosave.bind(this));
				getraions();
			});
		}
		
	function seosave() {
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
	       
				var json = {func:'CPanel', domain:JSCat.domain, token:JSCat.token};
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
		}
		
	function ogsave() {
			var ogdescription = $("#ogdescription").val();
			var ogtitle = $("#ogtitle").val();
			
			ogdescription = ogdescription.length > 300 ? ogdescription.substring(0, 297) + "..." : ogdescription;
			ogtitle = ogtitle.length > 65 ? ogtitle.substring(0, 62) + "..." : ogtitle;
				
			var json = {func:'CPanel', domain:JSCat.domain, token:JSCat.token};
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
		}
		
		
	function addraion() {
			var param = ['add', $('#raions').val()];
			var json = {func:'CPanel', domain:JSCat.domain, token:JSCat.token};
			json["action"] 	= "raions_setting";
			json["param"] 	= param;
			json["city"] = $('#citys option:selected').attr('city');
			$.post("/json/", json, function() {
				getraions()
			});
		}
		
	function remove(id) {
			var param = ['remove', id];
			confirm({
				text: "Вы уверены?",
				ok: function() {
					var json = {func:'CPanel', domain:JSCat.domain, token:JSCat.token};
					json["action"] = "raions_setting";
					json["param"] = param;
					$.post("/json/", json, function(){
        				getraions()
        	 		});
				}
			});
		}
		
	function getraions() {
		$('#raions').val('');
			$(".checks i").remove();
			$(".checks").append('<i radios="add">+</i>');
			$('#list2 i[radios="add"]').click(addraion.bind(this));
			var json = {func:'CPanel', domain:JSCat.domain, token:JSCat.token};
			json["action"] 	= "raions_setting";
			json["city"] = $('#citys option:selected').attr('city');
			$.post("/json/", json, function(result) {
				if (result != '') {
					if (typeof result !== 'object') result = JSON.parse(result);
					for (var b in result) {
						$(".checks").append('<i id="check' + result[b].id + '">' + result[b].name + '<i data="'+ result[b].id +'">×</i></i>');					
						$('[data="'+ result[b].id +'"]').click(remove.bind(this, result[b].id))
	    			}
	    		}
	    	});
	    }
		
	function getFace(result) {
    		var json = {func:'CPanel', domain:JSCat.domain, token:JSCat.token};
			json["action"] = 'getFace';
			json["param"] = 'get';
			$.post("/json/", json, function(face) {
				if (typeof face !== 'object') face = JSON.parse(face);

				for (var b in face) {
					var key = Object.keys(face[b]);
					switch (b) {
						case 'color':
							$('#list').append('<div><strong>' + key + '</strong><span><input type="color" id="'+ b +'" value="'+ face[b][key] +'"></span></div>');
							var source = document.querySelector('#' + b),
							picker = new CP(source);
							source.onclick = function(e) {
        						e.preventDefault();
    						}
    						picker.on("stop", function(color) {
        						this.source.value = '#' + color;
        						update('color', '#' + color);
        						return false;
    						});
						break;
					}
				}
			});
		}
		
	function change(name, param) {
			switch (name) {
				case 'animate':
				case 'mobile':
				case 'view':
					param = $('#' + name).is(":checked");
				break;
			}
			update(name, param);
			return false;
		}
		
	function update(name, param) {
			var json = {func:'CPanel', domain:JSCat.domain, token:JSCat.token};
			json["action"] = 'getFace';
			json["param"] = 'update';
			json["name"] = [name, param];
			$.post("/json/", json, function() {});
		}
	
	function props(prop, board) {
			var json = {func:'CPanel', domain:JSCat.domain, token:JSCat.token};
			json["action"] 	= "category_change";
			json["board"] 	= board;
			$('#' + board + prop).is(":checked") ? json["value"] = prop : json["remove"] = prop;
			$.post("/json/", json, function(a) {});
		}
		
	function rename(el, action = false) {
			var id = $('#'+ el).attr('id').substr(1);
			var input = ($('#'+ el +' input[type="text"]').length) ? $('#'+ el +' input[type="text"]') : $('#'+ el +' textarea');
			input = (input.length) ? input : $('#'+ el +' select');
			    input.css("border-color", "#d2d2d2");
			var buffer = $('#'+ el +' .input-buffer');
			var btn = $('#'+ el +' btn');
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
				save(id, value, action);
				return false;
			});
			return false;
		}
		
	function save(id, value, action) {
			var param = [id, value];
			var json = {func:'CPanel', domain:JSCat.domain, token:JSCat.token};
			json["action"] = action;
			json["param"] 	= param;
			$.post("/json/", json, function() {});
		}
		
				

</script>




