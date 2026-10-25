<?php namespace lib;
if (!defined('VOCU_FWK')) die();
if (!in_array('admin', $RoleGroup) && !in_array('admin', $RoleUser)) die();

$Roles = Roles::getAll($JSCat['token']);
$Users = Roles::getUsers($JSCat['token']); 
		
?>

<style>
#list > div > span:first-of-type:last-of-type {display: flex;
    justify-content: space-around;}
#list > div [class^="icon-"]:before, 
#list > div [class*=" icon-"]:before {
    font-size: 29px;
    float: left;
    margin: -8px 10px 0 0;
    color: #b7b7b7;
}
#list > div.active i {display: block;
    color: white;
    float: none;
    font-style: normal;
    font-size: 12px;
    text-align: center;
    width: 130px;
    line-height: 20px;
    font-weight: normal;}
#list > div.active i:before {
    display: block;
    float: none;
    font-size: 20px;
    color: white;
    margin: -8px 0 0;
}
#list > div i[empty] {
    width: 40px;
}
#list > div.active {background:#3f76ac;color:white;}
</style>
<div id="top">
	<h1>Роли
		<i class="pull-right">
			<input type="submit" class="btn btn-primary" id="add0" value="Добавить">
		</i>
    	<i>Управление доступом</i>
   </h1>
</div>
<div id="container0"></div>
									
<div feed id="list">	
	<div class="active"><strong>Тип пользователя</strong><span>
		<label><i class="icon-list-1">Заказы</i></label>
		<label><i class="icon-list-1">Операторы</i></label>
		<label><i class="icon-list-1">Статистика</i></label>
		<label><i class="icon-cloud">Товары</i></label>
		<label><i class="icon-calendar-3">Настройки</i></label>
		<label><i class="icon-star-1">Робот</i></label>
		<i></i></span></div>
	<?php for ($i = 0; $i < count($Roles); $i++) {
		if ($Roles[$i]['id'] != '5') {
			$compare1 = (in_array('partner', explode("_", $Roles[$i]['roles']))) ? 'checked="checked"' : '';
			$compare2 = (in_array('operators', explode("_", $Roles[$i]['roles']))) ? 'checked="checked"' : '';
			$compare3 = (in_array('stat', explode("_", $Roles[$i]['roles']))) ? 'checked="checked"' : '';
			$compare4 = (in_array('goods', explode("_", $Roles[$i]['roles']))) ? 'checked="checked"' : '';
			$compare5 = (in_array('config', explode("_", $Roles[$i]['roles']))) ? 'checked="checked"' : '';
			$compare6 = (in_array('robot', explode("_", $Roles[$i]['roles']))) ? 'checked="checked"' : '';
			$value = 1;
			
			echo '<div role id="t'. $Roles[$i]['id'] .'" roles="'. $Roles[$i]['roles'] .'"><strong><i class="icon-user-3"></i>'. $Roles[$i]['name'] .'</strong><span>';
			
			if ($Roles[$i]['id'] != '1') echo '
				<input class="ios8" id="t0'. $Roles[$i]['id'] .'" '. $compare1 .' type="checkbox" cat="partner"><label title="" for="t0'. $Roles[$i]['id'] .'"></label>
				<input class="ios8" id="t1'. $Roles[$i]['id'] .'" '. $compare2 .' type="checkbox" cat="operators"><label title="" for="t1'. $Roles[$i]['id'] .'"></label>
				<input class="ios8" id="t2'. $Roles[$i]['id'] .'" '. $compare3 .' type="checkbox" cat="stat"><label title="" for="t2'. $Roles[$i]['id'] .'"></label>
				<input class="ios8" id="t3'. $Roles[$i]['id'] .'" '. $compare4 .' type="checkbox" cat="goods"><label title="" for="t3'. $Roles[$i]['id'] .'"></label>
				<input class="ios8" id="t4'. $Roles[$i]['id'] .'" '. $compare5 .' type="checkbox" cat="config"><label title="" for="t4'. $Roles[$i]['id'] .'"></label>
				<input class="ios8" id="t5'. $Roles[$i]['id'] .'" '. $compare6 .' type="checkbox" cat="robot"><label title="" for="t5'. $Roles[$i]['id'] .'"></label>
				<label style="width:40px;"></label>';
				
			echo '</span></div>';
		}
	} ?>
	<br><div class="active"><strong>Имя пользователя</strong><span>
		<label><i class="icon-list-1">Заказы</i></label>
		<label><i class="icon-list-1">Операторы</i></label>
		<label><i class="icon-list-1">Статистика</i></label>
		<label><i class="icon-cloud">Товары</i></label>
		<label><i class="icon-calendar-3">Настройки</i></label>
		<label><i class="icon-star-1">Робот</i></label>
		<i></i></span></div>
	<?php for ($i = 0; $i < count($Users); $i++) {
		if ('1' == '1') {
			//$Users[$i]['status']
			$compare1 = (in_array('partner', explode("_", $Users[$i]['roles']))) ? 'checked="checked"' : '';
			$compare2 = (in_array('operators', explode("_", $Users[$i]['roles']))) ? 'checked="checked"' : '';
			$compare3 = (in_array('stat', explode("_", $Users[$i]['roles']))) ? 'checked="checked"' : '';
			$compare4 = (in_array('goods', explode("_", $Users[$i]['roles']))) ? 'checked="checked"' : '';
			$compare5 = (in_array('config', explode("_", $Users[$i]['roles']))) ? 'checked="checked"' : '';
			$compare6 = (in_array('robot', explode("_", $Users[$i]['roles']))) ? 'checked="checked"' : '';
			$name = ($Users[$i]['name']) ?: $Users[$i]['email'];
			
			echo '<div user id="u'. $Users[$i]['id'] .'" roles="'. $Users[$i]['roles'] .'" ids="'. $Users[$i]['id'] .'"><strong><i class="icon-user-4"></i>'. $name .'</strong><span>';
			if ($Users[$i]['id'] == '17') echo '<i empty=""></i><i empty=""></i><i empty=""></i><i empty=""></i><i empty=""></i><i empty=""></i>';
			
			if ($Users[$i]['id'] != '17') echo '
				<input class="ios8" id="u0'. $Users[$i]['id'] .'" '. $compare1 .' type="checkbox" cat="partner"><label title="" for="u0'. $Users[$i]['id'] .'"></label>
				<input class="ios8" id="u1'. $Users[$i]['id'] .'" '. $compare2 .' type="checkbox" cat="operators"><label title="" for="u1'. $Users[$i]['id'] .'"></label>
				<input class="ios8" id="u2'. $Users[$i]['id'] .'" '. $compare3 .' type="checkbox" cat="stat"><label title="" for="u2'. $Users[$i]['id'] .'"></label>
				<input class="ios8" id="u3'. $Users[$i]['id'] .'" '. $compare4 .' type="checkbox" cat="goods"><label title="" for="u3'. $Users[$i]['id'] .'"></label>
				<input class="ios8" id="u4'. $Users[$i]['id'] .'" '. $compare5 .' type="checkbox" cat="config"><label title="" for="u4'. $Users[$i]['id'] .'"></label>
				<input class="ios8" id="u5'. $Users[$i]['id'] .'" '. $compare6 .' type="checkbox" cat="robot"><label title="" for="u5'. $Users[$i]['id'] .'"></label>';
				
			echo '<i class="icon-switch-5" item="'. $Users[$i]['id'] .'"></i></span></div>';
		}
	} ?>
</div>

<script>
	
	$('#add0').click(add0.bind(this));
// 	var roles = ['partner','operators','stat','goods','config','robot'];
// 	var data = $('div[role]').attr('roles');
// 	data = data.split('_');
// 	
// 	for (var prop in roles) {
// 		var cat = ($.inArray(prop, data)
// 		console.log(prop)
// 	}
	$('div[user] .icon-switch-5').each(function() {
		var ids = $(this).attr('item');
		//if ($(this).is(":checked")) 
		$(this).click(find.bind(this, ['id', ids]));
	});
	$('div[user] .ios8').each(function() {
		$(this).change(update.bind(this, 'user', $(this).parent().parent().attr('id')));
	});
	$('div[role] .ios8').each(function() {
		$(this).change(update.bind(this, 'role', $(this).parent().parent().attr('id')));
	});
		
	function update(role, ids) {
		var data = [];
		$('#'+ ids +' .ios8').each(function() {
			if ($(this).is(":checked")) data.push($(this).attr('cat'));
		});
		var datan = data.filter((v, i, a) => a.indexOf(v) === i);
		
		var json = {func:'Roles', domain:JSCat.domain, token:JSCat.token};
		json["action"] = 'role';
		json["data"] = datan.join('_');
		json["role"] = role;
		json["id"] = ids;
		$.post("/json/", json, function() {});
	}	
		
		
	function form2() {
		    
		var usertype = getusertype();
		//var role = labelgen(data.roles.split("_"));
		delete usertype[5];
		
		var forms = '<div class="baseh" id="baseh"><h3>Добавить пользователя</h3><div class="frmmar"></div>';
		forms += '<div class="inline"><span>Логин:</span><input type="text" style="margin:0" id="username" value=""><br>';
		forms += '<span>E-mail:</span><input type="text" id="email" value=""><br>';
		forms += '<span>Телефон:</span><input type="text" id="phone" value=""><br>';
		forms += '<span>ФИО:</span><input type="text" id="name" value=""><br>';
		forms += '<span>Тип пользователя:</span><select id="usertype">'+ optiongen(usertype) +'</select><br>';
		forms += '<span>Пароль:</span><input type="text" id="password" placeholder="Новый пароль"><br>';
		forms += '<span>Статус:</span><select id="status" style="position: relative;"><option value="1">Активен</option><option value="0">Заблокирован</option></select><br>';
		forms += '</div>';

		forms += '<div class="inline">';
		forms += '<label><input type="checkbox" name="ex"> Экспорт/выгрузка заказов</label>';
		forms += '<label><input type="checkbox" name="bl"> Печать почтовых бланков</label>';
		forms += '<label><input type="checkbox" name="tr"> Массовое присвоение трек-номеров</label>';
		forms += '<label><input type="checkbox" name="ch"> Массовая смена статусов (>20)</label>';
		forms += '<label><input type="checkbox" name="st"> Разрешить оператору просматривать статистику</label>';
		forms += '<label><input type="checkbox" name="go"> Разрешить оператору просматривать товары и остатки на складе</label>';
		forms += '<label><input type="checkbox" name="ar"> Разрешить оператору редактировать остатки на складе</label>';
		forms += '<label><input type="checkbox" name="co"> Показывать оператору контейнеры для статусов</label>';
		forms += '<label><input type="checkbox" name="te"> Показывать оператору номер телефона</label>';
		forms += '<label><input type="checkbox" name="mp"> Разрешить оператору прослушивать записи разговоров</label>';
		forms += '<label><input type="checkbox" name="se"> Разрешить оператору управлять настройками режима прозвона</label>';
		forms += '<label><input type="checkbox" name="li"> Разрешить оператору просматривать список заказов в проекте</label>';
		forms += '<label><input type="checkbox" name="hi"> Разрешить оператору просматривать историю изменений заказа</label>';
		forms += '<button id="save">Сохранить</button><button id="back">Отмена</button></div></div>';
		return forms;
	}
	function add0() {
		$('#baseh').remove();
		$('#container0').empty().append(form2());
		$('#save').show().off().click(save.bind(this, 0));
		$('#back').show().off().click(back.bind(this));
		$('#phone').mask("+7 (999) 999-99-99");
	}
	function back() {
		$('#baseh').remove()
	}
	function form(data) {
		
		var usertype = getusertype();
		//var role = labelgen(data.roles.split("_"));
		delete usertype[5];
		    
		var forms = '<div class="baseh" id="baseh">';
		forms += '<div class="inline"><span>Логин:</span><input type="text" id="username" value="'+ data.username +'"><br>';
		forms += '<span>E-mail:</span><input type="text" id="email" value="'+ data.email +'"><br>';
		forms += '<span>Телефон:</span><input type="text" id="phone" value="'+ data.phone +'"><br>';
		forms += '<span>ФИО:</span><input type="text" id="name" value="'+ data.name +'"><br>';
		forms += '<span>Тип пользователя:</span><select id ="usertype">'+ optiongen(usertype) +'</select><br>';
		forms += '<span>Пароль:</span><input type="text" id="password" placeholder="Новый пароль"><br>';
		forms += '<span>Статус:</span><select id="status" style="position: relative;"><option value="1">Активен</option><option value="0">Заблокирован</option></select><br>';

		forms += '<span>ID пользователя:</span><input style="border:0" type="text" value="'+ data.id +'"><br>';
		forms += '<span>Дата регистрации:</span><input style="border:0" type="text" value="'+ ((data.registerDate != '0') ? timeConverterWithYear(data.registerDate) : '') +'"><br>';
		forms += '<span>IP посл. авторизации:</span><input style="border:0" type="text" value="'+ data.ipauth +'"><br>';
		forms += '<span>Браузер:</span><input style="border:0" type="text" value="'+ data.browser +'"><br>';
		forms += '<span>Тип устройства:</span><input style="border:0" type="text" value="'+ data.system +', '+ data.device +'">';
		forms += '</div>';

		forms += '<div class="inline">';
		data.ex = (data.ex == '1') ? 'checked="checked"' : ''; forms += '<label><input type="checkbox" name="ex" '+ data.ex +'> Экспорт/выгрузка заказов</label>';
		data.bl = (data.bl == '1') ? 'checked="checked"' : ''; forms += '<label><input type="checkbox" name="bl" '+ data.bl +'> Печать почтовых бланков</label>';
		data.tr = (data.tr == '1') ? 'checked="checked"' : ''; forms += '<label><input type="checkbox" name="tr" '+ data.tr +'> Массовое присвоение трек-номеров</label>';
		data.ch = (data.ch == '1') ? 'checked="checked"' : ''; forms += '<label><input type="checkbox" name="ch" '+ data.ch +'> Массовая смена статусов (>20)</label>';
		data.st = (data.st == '1') ? 'checked="checked"' : ''; forms += '<label><input type="checkbox" name="st" '+ data.st +'> Разрешить оператору просматривать статистику</label>';
		data.go = (data.go == '1') ? 'checked="checked"' : ''; forms += '<label><input type="checkbox" name="go" '+ data.go +'> Разрешить оператору просматривать товары и остатки на складе</label>';
		data.ar = (data.ar == '1') ? 'checked="checked"' : ''; forms += '<label><input type="checkbox" name="ar" '+ data.ar +'> Разрешить оператору редактировать остатки на складе</label>';
		data.co = (data.co == '1') ? 'checked="checked"' : ''; forms += '<label><input type="checkbox" name="co" '+ data.co +'> Показывать оператору контейнеры для статусов</label>';
		data.te = (data.te == '1') ? 'checked="checked"' : ''; forms += '<label><input type="checkbox" name="te" '+ data.te +'> Показывать оператору номер телефона</label>';
		data.mp = (data.mp == '1') ? 'checked="checked"' : ''; forms += '<label><input type="checkbox" name="mp" '+ data.mp +'> Разрешить оператору прослушивать записи разговоров</label>';
		data.se = (data.se == '1') ? 'checked="checked"' : ''; forms += '<label><input type="checkbox" name="se" '+ data.se +'> Разрешить оператору управлять настройками режима прозвона</label>';
		data.li = (data.li == '1') ? 'checked="checked"' : ''; forms += '<label><input type="checkbox" name="li" '+ data.li +'> Разрешить оператору просматривать список заказов в проекте</label>';
		data.hi = (data.hi == '1') ? 'checked="checked"' : ''; forms += '<label><input type="checkbox" name="hi" '+ data.hi +'> Разрешить оператору просматривать историю изменений заказа</label>';
		forms += '<button id="save">Сохранить</button></div></div>';
		return forms;
	}
	function add() {
		$('#list').empty().append(form({username:'', email:'', phone:'', name:''}));
		$('#save').show().off().click(save.bind(this, 0));
		$('#back').show().off().click(back.bind(this, 0));
		$('#phone').mask("+7 (999) 999-99-99");
		$('#add').hide();
	}
	function save(id) {
		console.log(id)
		//if (id == '0')
			// if ((!$('#email').val()) || (!$('#username').val()) || (!$('#name').val()) || (!$('#password').val()) || (!$('#phone').val())) 
// 				return alert('Все поля обязательны для заполнения')
			
		var json = {func:'CUser', domain:JSCat.domain, token:JSCat.token};
		json["action"] 	= "saveUserAdmin";
		json["id"] 			= id;
		json["name"] 		= $('#name').val();
		json["phone"] 		= $('#phone').val();
		json["email"] 		= $('#email').val();
		json["job"] 		= $('#usertype option:selected').text();
		json["status"] 	= $('#status option:selected').attr('value');
		json["usertype"] 	= $('#usertype option:selected').attr('value');
		json["username"] 	= $('#username').val();
		json["password"] 	= $('#password').val();
		$('.inline input[type="checkbox"][name]').each(function() {
			var item = $(this);
			json[item.attr('name')] = $('[name="'+ item.attr('name') +'"]').is(':checked');
		});
		$.post("/json/", json, function() {
			//alert('Выполнено')
			location.reload()
		});
	}
	
	function find(param) {
		if (typeof param[1] !== 'undefined' && param[1].length > 0) {
			var json = {func:'CUser', domain:JSCat.domain, token:JSCat.token};
			json["action"] 	= 'findUser';
			json["param"] 	= param;
			$.post("/json/", json, function(result) {
				if (typeof d !== 'object') result = JSON.parse(result);
					detail(result, param);
			});
		} else alert('Не указаны параметры поиска')
	}
	
	function detail(data, param) {
		//$('#back').show().off().click(back.bind(this, 0));
		if (data['error']) return $('#list').empty().append('<div>'+ data.error +'</div>');
			
		$('#baseh').remove();	
		$('div[ids="'+ param[1] +'"]').append(form(data));	
		$('#usertype [value="'+ data.usertype +'"]').attr("selected","selected");	
		$('#status [value="'+ data.status +'"]').attr("selected","selected");
		$('#save').click(save.bind(this, data.id));	
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
			7: 'Финансист',
			8: 'Технический специалист',
			9: 'Аналитика',
			10: 'Старший Менеджер',
			11: 'Почта'
		}
	}
 
	function optiongen(arr) {
		var text = '';
		for (a in arr)
			text += '<option value="'+ a +'">'+ arr[a] +'</option>';
		return text;
	}
	function labelgen(arr) {
		var text = '';
		for (a in arr)
			text += '<label><input type="checkbox" value="'+ data.browser +'">Экспорт/выгрузка заказов</label>';
		return text;
	}
</script>