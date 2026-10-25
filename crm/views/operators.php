<?php namespace lib;
	if (!in_array('operators', $RoleGroup) || !in_array('operators', $RoleUser)) die();
	
	$Users = Roles::getUsers($JSCat['token']);
	$statuses = [];
	$Result = JBase::get_Data('list8', '*', ['status' => 1]);
	if ($Result) {
		while($stat = $Result->fetch_assoc()) {
			$statuses[$stat['id']] = $stat;
		}
	}
	//настройки операторов
	$ops = [];
	$OPER = JBase::get_Data('operators', '*');
	if ($OPER) {
		while($op = $OPER->fetch_assoc()) {
			$ops = $op;
		}
	}
	
	//формируем select с 
	$options = '<option value="0">Не использовать</option>';
	foreach ($statuses as $k => $v) {
		$options .= '<option value="'. $k .'">'. $v['name'] .'</option>';
	}
	
	$statusj = [];
	foreach ($statuses as $k => $v) {
		$statusj[$k] = $v['name'];
	}
	
	$statusjson = json_encode($statusj, JSON_UNESCAPED_UNICODE);

	$operator_denyManyOrders 				= ($ops['operator_denyManyOrders'] == 1) ? ['checked="checked"', 1]: ['', 0];
	$operator_allow_showDoubleIp 			= ($ops['operator_allow_showDoubleIp'] == 1) ? ['checked="checked"', 1]: ['', 0];
	$operator_allow_showOrderStatus 		= ($ops['operator_allow_showOrderStatus'] == 1) ? ['checked="checked"', 1]: ['', 0];
	$operator_goods_hideIfNoReserve 		= ($ops['operator_goods_hideIfNoReserve'] == 1) ? ['checked="checked"', 1]: ['', 0];
	$operator_showNewOrdersCount 			= ($ops['operator_showNewOrdersCount'] == 1) ? ['checked="checked"', 1]: ['', 0];
	$operator_showIpInHistory 				= ($ops['operator_showIpInHistory'] == 1) ? ['checked="checked"', 1]: ['', 0];
	$callMode_on 								= ($ops['callMode_on'] == 1) ? ['checked="checked"', 1]: ['', 0];
	
// 	$operator_double 							= $ops['operator_double'];
// 	$operator_cancel 							= $ops['operator_cancel'];
// 	$operator_nocall 							= $ops['operator_nocall'];
// 	$operator_recall 							= $ops['operator_recall'];
// 	$operator_spam 							= $ops['operator_spam'];
// 	$operator_dop1_select 					= $ops['operator_dop1_select'];
// 	$operator_dop2_select 					= $ops['operator_dop2_select'];
// 	$operator_dop1 							= $ops['operator_dop1'];
// 	$operator_dop2 							= $ops['operator_dop2'];

?>


<div id="top">
	<h1>Операторы
		<i class="pull-right">
			<input type="submit" class="btn btn-primary" id="add0" value="Добавить оператора">
			<input class="btn btn-primary add" item="0" list="33" type="submit" value="Добавить скрипт">
		</i>
    	<i>Управление сотрудниками</i>
   </h1>
</div>
<div id="contents-add"></div>

<ul class="nav nav-tabs">
	<li class="active"><a data-toggle="tab" href="#container-1">Операторы</a></li>
	<?php 
		if (in_array('tech', $RoleGroup) && in_array('tech', $RoleUser)) 
			echo '<li><a data-toggle="tab" href="#container-2">Настройки для операторов</a></li>';
	?>
	<li><a data-toggle="tab" href="#container-3">Скрипты для операторов</a></li>
</ul>
<div class="tab-content" id="list2" style="padding-top: 6px;">
	<div id="container-1" class="tab-pane fade in active">
		<div feed id="list">	
			<div class="active">
		<strong>Имя пользователя</strong>
		<span style="display: block;">
			<i class="icon-star-1">Тип</i><i empty=""></i><i empty=""></i><i empty=""></i><i empty=""></i><i empty=""></i><i></i>
		</span>
	</div>	
			<?php for ($i = 0; $i < count($Users); $i++) {
				if (in_array($Users[$i]['usertype'], ['2','3'])) {
			
					$name = ($Users[$i]['name']) ?: $Users[$i]['email'];
					echo '
						<div user id="u'. $Users[$i]['id'] .'" roles="'. $Users[$i]['roles'] .'" ids="'. $Users[$i]['id'] .'">
							<strong><i class="icon-user-4"></i>'. $name .'</strong>
							<span>
								<span empty="">'. $Users[$i]['job'] .'</span><i empty=""></i><i empty=""></i><i empty=""></i><i empty=""></i><i empty=""></i><i class="icon-switch-5" item="'. $Users[$i]['id'] .'"></i>
							</span>
						</div>';
					}
				} ?>
		</div>
	</div>
	<div id="container-2" class="tab-pane fade">
		<div feed id="list3" style="border:0">
			<div><input class="ios8" id="operator_denyManyOrders" <?= $operator_denyManyOrders[0] ?> type="checkbox" value="<?= $operator_denyManyOrders[1] ?>"><label title for="operator_denyManyOrders"><strong> Запрещать оператору открывать одновременно несколько заказов</strong></label><span></span></div>   
			<div><input class="ios8" id="operator_allow_showDoubleIp" <?= $operator_allow_showDoubleIp[0] ?> type="checkbox" value="<?= $operator_allow_showDoubleIp[1] ?>"><label title for="operator_allow_showDoubleIp"><strong> Показывать операторам дубли по ip в карточке заказа</strong></label><span></span></div>   
			<div><input class="ios8" id="operator_allow_showOrderStatus" <?= $operator_allow_showOrderStatus[0] ?> type="checkbox" value="<?= $operator_allow_showOrderStatus[1] ?>"><label title for="operator_allow_showOrderStatus"><strong> Показывать операторам статусы дублей заказов в карточке заказа</strong></label><span></span></div>   
			<div><input class="ios8" id="operator_goods_hideIfNoReserve" <?= $operator_goods_hideIfNoReserve[0] ?> type="checkbox" value="<?= $operator_goods_hideIfNoReserve[1] ?>"><label title for="operator_goods_hideIfNoReserve"><strong> Скрывать товар в карточке заказа, если его остаток меньше либо равен нулю</strong></label><span></span></div>   
			<div><input class="ios8" id="operator_showNewOrdersCount" <?= $operator_showNewOrdersCount[0] ?> type="checkbox" value="<?= $operator_showNewOrdersCount[1] ?>"><label title for="operator_showNewOrdersCount"><strong> Показывать счетчик заказов и уведомлять операторов</strong></label><span></span></div>   
			<div><input class="ios8" id="operator_showIpInHistory" <?= $operator_showIpInHistory[0] ?> type="checkbox" value="<?= $operator_showIpInHistory[1] ?>"><label title for="operator_showIpInHistory"><strong> Показывать оператору IP-адрес в истории изменений</strong></label><span></span></div>   
			<div style="background: var(--color);color: white;"><font>Режим прозвона</font></div>
			<div><input class="ios8" id="callMode_on" <?= $callMode_on[0] ?> type="checkbox" value="<?= $callMode_on[1] ?>"><label title for="callMode_on"><strong> Включить отображение скрипта</strong></label><span></span></div>   
			<div><strong><i class="icon-switch-1"></i>Кнопка Подтвердить</strong><span><select id="operator_1apply"><?= $options ?></select></span></div>
			<div><strong><i class="icon-switch-1"></i>Кнопка Повторное подтверждение</strong><span><select id="operator_2apply"><?= $options ?></select></span></div>
			<div><strong><i class="icon-switch-1"></i>Кнопка Перезвонить</strong><span><select id="operator_recall"><?= $options ?></select></span></div>
			<div><strong><i class="icon-switch-1"></i>Кнопка Недозвон</strong><span><select id="operator_nocall"><?= $options ?></select></span></div>
			<div><strong><i class="icon-switch-1"></i>Кнопка В отмену</strong><span><select id="operator_cancel"><?= $options ?></select></span></div>
			<div><strong><i class="icon-switch-1"></i>Кнопка Дубль</strong><span><select id="operator_double"><?= $options ?></select></span></div>
			<div><strong><i class="icon-switch-1"></i>Кнопка Спам</strong><span><select id="operator_spam"><?= $options ?></select></span></div>
			<div><strong><i class="icon-switch-1"></i>Кнопка Фрод</strong><span><select id="operator_fraud"><?= $options ?></select></span></div>
			<div><strong><i class="icon-switch-1"></i>Кнопка ОКК</strong><span><select id="operator_okk"><?= $options ?></select></span></div>
			<div><strong>Доп кнопка 1 (название)</strong><span><input id="operator_dop1" type="text" placeholder="Доп кнопка 1"></span><span></span></div>
			<div><strong><i class="icon-switch-1"></i>Доп кнопка 1 (кнопка)</strong><span><select id="operator_dop1_select"><?= $options ?></select></span></div>
			<div><strong>Доп кнопка 2 (название)</strong><span><input type="text" id="operator_dop2" placeholder="Доп кнопка 2"></span><span></span></div>
			<div><strong><i class="icon-switch-1"></i>Доп кнопка 2 (кнопка)</strong><span><select id="operator_dop2_select"><?= $options ?></select></span></div>
		</div>
	</div>
	<div id="container-3" class="tab-pane fade">
		<div searcher="" class="call crmls" list="33" status="all" user="all" count="50" pagination="true" template="10"></div>
		<div paginator></div>
	</div>
</div>








<script>
	
	var ops = <?= json_encode($ops, JSON_UNESCAPED_UNICODE) ?>;
	for (var prop in ops) {
		switch (prop) {
			//checkbox
			case 'operator_denyManyOrders':
			case 'operator_allow_showDoubleIp':
			case 'operator_allow_showOrderStatus':
			case 'operator_goods_hideIfNoReserve':
			case 'operator_showNewOrdersCount':
			case 'operator_showIpInHistory':
			case 'callMode_on':
				var s = 'check';
				if (ops[prop] == 1) $('#'+ prop +' option[value="'+ ops[prop] +'"]').prop('selected', true)
				$('#'+ prop).val(ops[prop])
			break;
			//select
			case 'operator_1apply':
			case 'operator_2apply':
			case 'operator_cancel':
			case 'operator_nocall':
			case 'operator_recall':
			case 'operator_double':
			case 'operator_fraud':
			case 'operator_spam':
			case 'operator_okk':
			case 'operator_dop1_select':
			case 'operator_dop2_select':
				var s = 'select';
				$('#'+ prop +' option[value="'+ ops[prop] +'"]').prop('selected', true)
				$('#'+ prop).val(ops[prop])
			break;
			//input
			case 'operator_dop1':
			case 'operator_dop2':
				var s = 'input';
				$('#'+ prop).val(ops[prop])
			break;
		}
		$('#'+ prop).change(function() {
			var id = $(this).attr('id')
			if ($('#'+ id).attr('type') == 'checkbox') {
				var val = ($('#'+ id).is(':checked')) ? 1 : 0;
			} else var val = $('#'+ id).val()
			saver(id, val)
		})
		
	}
			
	function saver(id, value) {
		var param = [id, value];
		var json = {func:'CPanel', domain:JSCat.domain, token:JSCat.token};
		json["action"] = 'operatorSave';
		json["param"] 	= param;
		$.post("/json/", json, function() {});
	}
		
		
	$('#add0').click(add0.bind(this));
	
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

		forms += '<div class="inline"><details><summary>Разрешенные действия</summary><div style="padding-left:15px">';
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
		forms += '</div></details>';
		
		forms += '<details><summary>Статусы</summary><div style="padding-left:15px">';
		forms += '<label><input type="radio" data-value="1" name="stt"> Доступны все статусы кроме выбранных</label>';
		forms += '<label><input type="radio" data-value="0" name="stt"> Доступны только выбранные статусы</label><div class="roll">';
	
			var sts = <?= $statusjson;?>;
			var stu = (data.statuses.length > 0) ? data.statuses.split('_') : [];
			for (a in sts) {
				forms += '<label><input type="checkbox" value="'+ a +'" '+ ((stu.includes(a)) ? 'checked="checked"' : '') +'> '+ sts[a] +'</label>';
			}
		forms += '</div></div></details>';
		forms += '<button id="save">Сохранить</button><button id="back">Отмена</button></div></div>';
		
		

		return forms;
	}
		
	function form2() {
		    
		var forms = '<div class="baseh" id="baseh"><h3>Добавить оператора</h3><div class="frmmar"></div>';
		forms += '<div class="inline"><span>Логин:</span><textarea style="margin:0" id="username" value=""></textarea><br>';
		forms += '<span>E-mail:</span><input type="text" id="email" value=""><br>';
		forms += '<span>Телефон:</span><input type="text" id="phone" value=""><br>';
		forms += '<span>ФИО:</span><input type="text" id="name" value=""><br>';
		forms += '<span>Тип пользователя:</span><select id="usertype"><option value="2">Approve</option><option value="3">Дожим</option></select><br>';
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
		$('#contents-add').empty().append(form2());
		$('#save').show().off().click(save.bind(this, 0));
		$('#back').show().off().click(back.bind(this));
		$('#phone').mask("+7 (999) 999-99-99");
	}
	function back() {
		$('#baseh').remove()
	}
	function save(id) {
		if (id == '0') { 
			if ((!$('#username').val()) || (!$('#password').val())) 
				return alert('Поля "Логин" и "Пароль" обязательны для заполнения')
		}
			
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
		
		//Разрешенные действия
		$('.inline input[type="checkbox"][name]').each(function() {
			var item = $(this)
			json[item.attr('name')] = $('[name="'+ item.attr('name') +'"]').is(':checked')
		});
		
		//Разрешенные статусы
		var st0 = [];
		$('.roll [type="checkbox"]').each(function() {
			var item = $(this)
			if (item.prop('checked')) st0.push(item.val())
		})
		json["statin"] 	= $('[name="stt"]:checked').attr('data-value')
		json["statuses"] 	= st0.join('_')
		
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
		console.log(data)
		console.log(data.statin)
		//$('#back').show().off().click(back.bind(this, 0));
		//if (data['error']) return $('#list').empty().append('<div>'+ data.error +'</div>');
			
		$('#baseh').remove();	
		$('div[ids="'+ param[1] +'"]').append(form(data));	
		$('#usertype [value="'+ data.usertype +'"]').attr("selected","selected");	
		$('#status [value="'+ data.status +'"]').attr("selected","selected");
		$('#save').click(save.bind(this, data.id));	
		$('#back').off().click(back.bind(this));
		$('#phone').mask("+7 (999) 999-99-99");
		$('[name="stt"][data-value="'+ data.statin +'"]').prop('checked', true)
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
			9: 'Аналитик',
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