<?php namespace lib;
	if (!defined('VOCU_FWK')) die();
	if (!in_array('tech', $RoleUser) && !in_array('tech', $RoleGroup)) die();	
?>

<div id="top">
	<h1>Модуль «Почта России»
		<i class="radios little" style="float: right;">
		<select cabinet="cats">
			 <optgroup label="Формы">
				<option cats="24">Почта России Форма 7А</option>
				<option cats="25">Почта России Форма 7Б</option>
				<option cats="26">Почта России Форма 7П</option>
		   	<option cats="27">Почта России Форма 112</option>
		   	<option cats="28">Почта России Форма 117</option>
		    </optgroup><optgroup label="Списки">
		   	<option cats="31">Почта России Список ф.103 (реестр ПО)</option>
		    </optgroup><optgroup label="Файлы">
		   	<option cats="32">Почта России Файлы *.txt и *.ini (для реестра ПО)</option>
		   	<option cats="29">Почта России Бланк отчета</option>
		   	<option cats="30">Почта России Бланк заявления - указания</option>
		   </optgroup><optgroup label="Онлайн-сервис Отправка">
		   	<option cats="11">Типы отправлений</option>
				<option cats="23">Аккаунты</option>
			</optgroup>
			
		</select>
	  		<label class="active"><input type="radio" name="radios" radios="status1">Активные</label>
	  		<label><input type="radio" name="radios" radios="status2">Архив</label>
	  		<label id="add" list="24" item="0" class="add" action="addf"><b>+</b>Добавить</label>
		</i>
    	<i>Модуль «Почта России»</i>
   </h1>
</div>
<div id="contents-add"></div>

<div id="list2"></div>
<div id="detail"></div>




<script>

localStorage.removeItem('users');
localStorage.removeItem('price');
function objects(params) {
	$.extend(this.options, params);
}

	objects.prototype = {
		start: function() {
					
			$('[cabinet="cats"]').change(objects.ads.bind(this));
			$('.radios [name]').change(function() {
				$('.radios label').removeClass('active').find('[radios]:checked').parent().addClass('active');
				objects.ads();
			});
			setTimeout(() => {$('[cabinet="cats"] [cats="24"]').prop('selected',true).change()}, 1e3)
	    	return false;
		},
		ads: function() {
			if (JSCat.category != null) {
				var list = $('[cabinet="cats"] option:selected').attr('cats');
				var user = $('[cabinet="users"] option:selected').attr('users');
				var status = $('[radios]:checked').attr('radios');
				
				$('#contents-add, #search_content').empty();
				$('#add').removeAttr('list').attr('list', list);
				$('#search_content').removeAttr('list').attr('list', list);
				$('#list2').empty().append('<div searcher class="call crmls" list="'+ list +'" status="'+ user +'" user="'+ status +'" count="15" pagination="true" template="10"></div><div paginator></div>');
				renderer.process.search();
				return false;
			}
		}
	}
$(function() {
	objects = new objects();
	objects.start();
});

</script>

