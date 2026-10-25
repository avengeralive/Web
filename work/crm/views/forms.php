<?php namespace lib;
	if (!defined('VOCU_FWK')) die();
	if (!in_array('admin', $RoleGroup) && !in_array('admin', $RoleUser)) die();
?>

<div id="top">
	<h1>Конструктор Форм
		<i class="radios little" style="float: right;">
			<label><input type="radio" name="radios" radios="29">Шаблоны</label>
			<label><input type="radio" name="radios" radios="27">Вопросы</label>
			<label><input type="radio" name="radios" radios="28">Ответы</label>
			<label id="addmod" item="0" class="add" action="addf">Добавить</label>
		</i>
    	<i>Опросы для генерации заявок</i>
   </h1>
</div>




<script>

	$('.little.radios label').click(function() {
		$('.radios.radios label').removeClass('active').find('[radios]:checked').parent().addClass('active');
		var list = $('label.active input').attr('radios');
		var sorter = '<div id="list2"><div id="contents-add"></div>';
			sorter += '	<div id="sorter">';
			sorter += '		<input data-sorter="text" type="text" data-sort="like" placeholder="Поиск по тексту"/><div id="search_content" list="'+ list +'"></div>';
			sorter += '</div>';
			sorter += '<div searcher class="call crmls" list="'+ list +'" user="0" count="25" pagination="true" template="10"></div>';
			sorter += '<div paginator></div></div>';
		$('#list2').remove();
		$('#top').after(sorter);
		$('#addmod').attr('list', list);
		//renderer.process.search();
	});
	
</script>













