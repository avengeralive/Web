<?php namespace lib;
	if (!defined('VOCU_FWK')) die();
	if (!in_array('admin', $RoleGroup) && !in_array('admin', $RoleUser)) die();
?>

<div id="top">
	<h1>Модерация
		<i class="radios little" style="float: right;">
			<select cabinet="cats"></select>
	  		<label class="active"><input type="radio" name="radios" radios="status1">Активные</label>
	  		<label><input type="radio" name="radios" radios="status0">На модерации</label>
<!-- 
	  		<label><input type="radio" name="radios" radios="status3">Завершенные</label>
 -->
	  		<label><input type="radio" name="radios" radios="status2">Архив</label>
	  		<label id="add" list="1" item="0" class="add" action="addf"><b>+</b>Добавить</label>
		</i>
    	<i>Товары по категориям</i>
   </h1>
</div>
<div id="contents-add"></div>
<!-- 
<div style="min-height: 211px;
    background: white;
    border: 1px #e4e4e4 solid;
    border-bottom: 0;">
	<div id="search_content"></div>
</div>
 --><div id="sorter">
	<input data-sorter="text" type="text" data-sort="like" placeholder="Поиск по тексту"/>
	<select data-sorter="price">
		<option data-sort="new">Новые</option>
		<option data-sort="bot">Дешевле</option>
		<option data-sort="top">Дороже</option>
	</select>
	<select data-sorter="users" cabinet="users"><optgroup label="Пользователи"><option users="all">Все пользователи</option></optgroup></select>
</div>
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
	    	objects.action.getcategory();
	    	objects.action.getusers();
	    	return false;
		},
		action: {
			getcategory: function() {
				if (JSCat.category != null) {
					var category = JSCat.category.split('_');
        			var json = {func:'CPanel', domain:JSCat.domain, token:JSCat.token};
					json["action"] = "get_category";
					$.post("/json/", json, function(catalogue) {
						if ( typeof catalogue !== 'object' ) catalogue = JSON.parse(catalogue);
						for (var prop in catalogue) {
							$('[cabinet="cats"]').append('<option cats="' + prop + '">' + catalogue[prop] + '</option>');
						}
						$('.radios [name]:first').click();
					});	
					return false;
    			} else alert('Категории не указаны. Обратитесь к администратору');
			},
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