<?php namespace lib;
	if (!defined('VOCU_FWK')) die();
	//if (in_array('roles', $RoleUser) || in_array('roles', $RoleGroup)) die();	
?>
<div id="top">
	<h1>Новости и Отзывы
		<i class="radios little" style="float: right;">
			<select cabinet="cats">
				<option cats="19">Новости</option>
				<option cats="20">Статьи</option>
				<option cats="24">Блог руководителя</option>
				<option cats="18">Отзывы</option>
			</select>
	  		<label class="active"><input type="radio" checked="checked" name="radios" radios="status1">На сайте</label>
	  		<label><input type="radio" name="radios" radios="status2">Архив</label>
	  		<label id="add" list="17" item="0" class="add" action="addf"><b>+</b>Добавить</label>
		</i>
    	<i>Расскажите своей аудитории о вашей деятельности</i>
   </h1>
</div>
<div id="contents-add"></div>
<div id="sorter">
	<input data-sorter="text" type="text" data-sort="like" placeholder="Поиск по тексту"/>
	<select data-sorter="users" cabinet="users"><optgroup label="Пользователи"><option users="all">Все пользователи</option></optgroup></select>
</div>
<div id="list2"></div>
<div id="detail"></div>





<script>

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
	    	objects.action.getusers();
			setTimeout(function(){$('[cabinet="cats"]').change()}, 500); //костыль
	    	return false;
		},
		action: {
			getusers: function() {
				if (JSCat.userType == '1') {
	        		var json = {func:'CPanel', domain:JSCat.domain, token:JSCat.token};
					json["action"] = "get_users";
					$.post("/json/", json, function(catalogue) {
						if (typeof catalogue !== 'object' ) catalogue = JSON.parse(catalogue);
						for (var prop in catalogue) {
							if (catalogue[prop] != '00') {
								var name; if (catalogue[prop] == '') {
									name = 'Без имени';
								} else name = catalogue[prop];
								$('[cabinet="users"]').append('<option users="' + prop + '">' + name + ' (' + prop + ')</option>');
							}
						}
					});
					//пользователи change
					$('[cabinet="users"]').change(function() {
						objects.ads();
					});	
				} else {
					$('[cabinet="users"] optgroup').empty().append('<option users="' + JSCat.user + '">' + JSCat.userName + ' (' + JSCat.user + ')</option>');
				}
			}
		},
		ads: function() {
			if (JSCat.category != null) {
				var list = $('[cabinet="cats"] option:selected').attr('cats');
				var user = $('[cabinet="users"] option:selected').attr('users');
				var status = $('[radios]:checked').attr('radios');
				
				$('#contents-add, #search_content').empty();
				$('#add').removeAttr('list').attr('list', list);
				$('#list2').empty().append('<div searcher class="call crmls" list="'+ list +'" status="'+ status +'" user="'+ user +'" count="25" pagination="true" template="10"></div><div paginator></div>');
				return false;
			}
		}
	}
$(function() {
	objects = new objects();
	objects.start();
});



</script>

