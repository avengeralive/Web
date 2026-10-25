<?php namespace lib;
	if (!defined('VOCU_FWK')) die();
	if (!in_array('admin', $RoleGroup) && !in_array('admin', $RoleUser)) die();
?>

<div id="top">
	<h1>Сотрудники
		<i class="radios little" style="float: right;">
    		<label id="add">Добавить</label>
			<label id="save" style="display:none">Сохранить</label>
			<label id="back" style="display:none">Назад</label>
		</i>
    	<i>Управление пользователями</i>
   </h1>
</div>


<div id="list"></div>

<script>
	function get() {
		$('#list').empty();
		$('#save,#back').hide();
		$('#add').show().unbind().click(add.bind(this));	
		var json = {func:'CUser', domain:JSCat.domain, token:JSCat.token};
		json["action"] 	= 'getUsers';
		$.post("/json/", json, function(result) {
			if ( typeof result !== 'object' ) result = JSON.parse(result);
			for (a in result) {
				if ( result[a].email != '1@1.ru')
					$('#list').append('<div id="u'+ result[a].id +'"><span>'+ result[a].name +'</span><span>'+ result[a].email +'</span><span>'+ result[a].id +'</span></div>');
				$('#u' + result[a].id).click(find.bind(this, ['id', result[a].id]));
			}		
		});
	}
	function form(data) {
		
		var usertype = getusertype();
		delete usertype[5];
		    
		var forms = '<div class="baseh">Параметры<div id="baseh">';
		forms += '<div class="inline"><span>Логин:</span><input type="text" id="username" value="'+ data.username +'"><br>';
		forms += '<span>E-mail:</span><input type="text" id="email" value="'+ data.email +'"><br>';
		forms += '<span>Телефон:</span><input type="text" id="phone" value="'+ data.phone +'"><br>';
		forms += '<span>ФИО:</span><input type="text" id="name" value="'+ data.name +'"><br>';
		forms += '<span>Тип пользователя:</span><select id ="usertype">'+ optiongen(usertype) +'</select><br>';
		forms += '<span>Пароль:</span><input type="text" id="password" placeholder="Новый пароль"><br>';
		forms += '<span>Статус:</span><select id="status"><option value="1">Активен</option><option value="0">Заблокирован</option></select></div>';
		
		forms += '<div class="inline" style="pointer-events:none;opacity:.8"><span>ID пользователя:</span><input type="text" value="'+ data.id +'"><br>';
		forms += '<span>Дата регистрации:</span><input type="text" value="'+ ((data.registerDate != '0') ? timeConverterWithYear(data.registerDate) : '') +'"><br>';
		forms += '<span>IP посл. авторизации:</span><input type="text" value="'+ data.ipauth +'"><br>';
		forms += '<span>Браузер:</span><input type="text" value="'+ data.browser +'"><br>';
		forms += '<span>Тип устройства:</span><input type="text" value="'+ data.system +', '+ data.device +'">';
		forms += '</div></div></div>';
		return forms;
	}
	function add() {
		$('#list').empty().append(form({username:'', email:'', phone:'', name:''}));
		$('#save').show().off().click(save.bind(this, 0));
		$('#back').show().off().click(back.bind(this, 0));
		$('#phone').mask("+7 (999) 999-99-99");
		$('#add').hide();
	}
	function back() {
		get();
	}
	function save(id) {
		if (id == '0')
			if ((!$('#email').val()) || (!$('#username').val()) || (!$('#name').val()) || (!$('#password').val()) || (!$('#phone').val())) 
				return alert('Все поля обязательны для заполнения')
			
		var json = {func:'CUser', domain:JSCat.domain, token:JSCat.token};
		json["action"] 		= "saveUserAdmin";
		json["id"] 			= id;
		json["name"] 		= $('#name').val();
		json["phone"] 		= $('#phone').val();
		json["email"] 		= $('#email').val();
		json["status"] 		= $('#status option:selected').attr('value');
		json["usertype"] 	= $('#usertype option:selected').attr('value');
		json["username"] 	= $('#username').val();
		json["password"] 	= $('#password').val();
		$.post("/json/", json, function() {
			alert('Выполнено')
			get();
		});
	}
	
	function find(param) {
		if (typeof param[1] !== 'undefined' && param[1].length > 0) {
			var json = {func:'CUser', domain:JSCat.domain, token:JSCat.token};
			json["action"] 	= 'findUser';
			json["param"] 	= param;
			$.post("/json/", json, function(result) {
				if (typeof d !== 'object') result = JSON.parse(result);
			detail(result);
			});
		} else alert('Не указаны параметры поиска')
	}
	function detail(data) {
		$('#back').show().off().click(back.bind(this, 0));
		if (data['error']) return $('#list').empty().append('<div>'+ data.error +'</div>');
		
		var construct = '<div><span>ID пользователя:</span><span>'+ data.id +'</span></div>';
		construct += '<div><span>Дата регистрации:</span><span>'+ ((data.registerDate != '0') ? timeConverterWithYear(data.registerDate) : '') +'</span></div>';
		construct += '<div><span>IP последней авторизации:</span><span>'+ data.ipauth +'</span></div>';
		construct += '<div><span>Браузер:</span><span>'+ data.browser +'</span><span>'+ data.system +', '+ data.device +'</span></div>';
    			
		$('#list').empty().append(form(data));	
		$('#usertype [value="'+ data.usertype +'"]').attr("selected","selected");	
		$('#status [value="'+ data.status +'"]').attr("selected","selected");
		$('#save').show().off().click(save.bind(this, data.id));	
		$('#phone').mask("+7 (999) 999-99-99");
	}	
	function timeConverterWithYear(UNIX_timestamp) {
      var a = new Date(UNIX_timestamp * 1000);
      var months = ['Января', 'Февраля', 'Марта', 'Апреля', 'Мая', 'Июня', 'Июля', 'Августа', 'Сентября', 'Октября', 'Ноября', 'Декабря'];
		var year = a.getFullYear();
		var month = months[a.getMonth()];
		var date = a.getDate();
		var time = date + ' ' + month + ' ' + year;
		return time;
	}
	function getusertype() {
		return {
			1: 'Администратор',
			2: 'Approve',
			3: 'Дожим',
			4: 'Руководитель',
			5: 'Гость',
			6: 'Менеджер',
			7: 'Финансист'
		}
	}
 
	function optiongen(arr) {
		var text = '';
		for (a in arr)
			text += '<option value="'+ a +'">'+ arr[a] +'</option>';
		return text;
	}
	get();
</script>