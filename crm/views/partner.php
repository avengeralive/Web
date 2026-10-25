<?php namespace lib;
	if (!in_array('partner', $RoleUser) && !in_array('partner', $RoleGroup)) die();	

$css = [];
$scss = '';
$Result = JBase::Get_Data('colors', ['name','hash'], ['on' => 1]);
if ($Result) {
	while($ret = $Result->fetch_assoc()) {
		$css[$ret['name']] = $ret['hash'];
	}
	 
	echo '<style>:root {';	
		foreach ($css as $key => $value) {
			$scss .= '--'. $key .': '. $value .';';
		}
		echo $scss;
	echo '}
	/*
		--color1 Ошибка/Спам/Дубль
		--color2 Возврат
		--color3 Отменен
		--color4 Обработка
		--color5 Принят
		--color6 Отправлен
		--color7 Оплачен
	*/</style>';
}

$trackthepackage = [];
$Result = JBase::Get_Data('list50', '*', ['status'=>1]);
if ($Result) {
	while($track = $Result->fetch_assoc()) {
		$trackthepackage[$track['id']] = $track['name'];
	}
}
$Result->free();

$sms = [];
$Result = JBase::Get_Data('list5', ['id','name'], ['status' => 1]);
if ($Result) {
	while($smss = $Result->fetch_assoc()) {
		$sms[$smss['id']] = $smss['name'];
	}
}
$Result->free();

$parcel = [];
$Result = JBase::Get_Data('list23', ['id', 'firstname'], ['status' => 1]);
if ($Result) {
	while($par = $Result->fetch_assoc()) {
		$parcel[$par['id']] = $par;
	}
}
$Result->free();

$list11 = [];
$Result = JBase::Get_Data('list11', ['id'], ['status' => 1]);
if ($Result) {
	while($par = $Result->fetch_assoc()) {
		$list11[] = $par;
	}
}
$Result->free();
	
$containers = [];
$Result = JBase::Get_Data('list9', '*', ['status' => 1]);
if ($Result) {
	while($cont = $Result->fetch_assoc()) {
		$containers[$cont['id']] = $cont['name'];
	}
}
$Result->free();
		
$statuses = [];
$Result = JBase::Get_Data('list8', '*', ['status' => 1], 'premium');
if ($Result) {
	while($stat = $Result->fetch_assoc()) {
		//$statuses[$stat['premium']] = $stat;
		$statuses[] = $stat;
	}
	//var_dump($statuses);
}
$stats = [];
foreach ($statuses as $id => $value) {
	$stats[$value['id']] = $value['statusgroup'];
}


$operators = [];
$Result = JBase::Get_Data('my_users', '*', ['status' => 1]);
if ($Result) {
	while($stat = $Result->fetch_assoc()) {
		$operators[$stat['id']] = $stat;
	}
}
$Result->free();

$tabs = '';
$divs = '';
//$keys = array_keys($statuses);
$cont = array_keys($containers);
//echo json_encode(array_keys($containers),JSON_UNESCAPED_UNICODE);
		
?>

<div id="contents-add" style="position: absolute;width: 100%;z-index: 999;max-width: calc(100vw - 30px);top: -20px;"></div>

<ul class="nav nav-tabs">
  <li class="active"><a data-toggle="tab" href="#container-0">Все статусы</a></li>
  <li><a data-toggle="tab" href="#container0">Без контейнера</a></li>
  <?php 
		include "lib/console.log.php";
		if ((int)$JSCat['co'] === 1) { //Показывать оператору контейнеры для статусов
			foreach ($containers as $key => $value) {
				$tabs .= '<li><a data-toggle="tab" href="#container'. $key .'">'. $value .'</a></li>';
			}
			// for ($i = 1; $i < count($containers) + 1; $i++) {
			// 	$tabs .= '<li><a data-toggle="tab" href="#container'. $i .'">'. $containers[$i] .'</a></li>';
			// }

			echo $tabs;
		}

	?>

<!-- 
  <li style="float:right"><a class="add" item="0" list="17">Создать заказ</a></li>
 -->
 
  <li style="float:right"><a data-toggle="tab" href="#container-1">Поиск</a></li>
  <li style="float:right"><a data-toggle="tab" href="#container-2">Еще</a></li>
</ul>
<div class="tab-content">
	<div id="container-0" class="tab-pane fade in active">
	<?php 
		for ($a = 0; $a < count($statuses); $a++) {
			if (isset($statuses[$a]) && isset($statuses[$a]['container'])) {
				$count = (isset($statuses[$a]['count']) && (int)$statuses[$a]['count'] > 0) ? '<i>'. $statuses[$a]['count'] .'</i> ' : '';
				echo '<a href="/partner?'. $statuses[$a]['id'] .'" class="orders" list="'. $statuses[$a]['statusgroup'] .'" status="'. $statuses[$a]['id'] .'">'. $count .''. $statuses[$a]['name'] .'</a>';
			}
		}
	?>
	</div>
	<div id="container0" class="tab-pane fade">
	<?php 
		for ($a = 0; $a < count($statuses); $a++) {
			if (isset($statuses[$a]) && isset($statuses[$a]['container']) && $statuses[$a]['container'] == '0') {
				$count = (isset($statuses[$a]['count']) && (int)$statuses[$a]['count'] > 0) ? '<i>'. $statuses[$a]['count'] .'</i> ' : '';
				echo '<a href="/partner?'. $statuses[$a]['id'] .'" list="'. $statuses[$a]['statusgroup'] .'" status="'. $statuses[$a]['id'] .'">'. $count .''. $statuses[$a]['name'] .'</a>';
			}
		}
	?>
	</div>
	<?php 
		foreach ($cont as $i) {
			$divs .= '<div id="container'. $i .'" class="tab-pane fade">';
			for ($a = 0; $a < count($statuses); $a++) {
				$count = (isset($statuses[$a]['count']) && (int)$statuses[$a]['count'] > 0) ? '<i>'. $statuses[$a]['count'] .'</i> ' : '';
				if (isset($statuses[$a]) && isset($statuses[$a]['container']) && in_array($statuses[$a]['container'], $cont) && $statuses[$a]['container'] == $i)
				$divs .= '<a href="/partner?'. $statuses[$a]['id'] .'" list="'. $statuses[$a]['statusgroup'] .'" status="'. $statuses[$a]['id'] .'">'. $count .''. $statuses[$a]['name'] .'</a>';
			}
			$divs .= '</div>';
		}
		echo $divs;
	?>
	<div id="container-1" class="tab-pane fade"><div id="search_content"></div></div>
	<div id="container-2" class="tab-pane fade">
<!-- 
		<span status data-change="downloadRussianpostTracks">Массовая загрузка штрихкодов Почты России</span>
		<span status data-change="deleteRussianpostTracks">Массовое удаление штрихкодов Почты России</span>
 -->
		<span status data-change="addCustomData">Массовая загрузка произвольных данных</span>
		<span status data-change="deleteCustomData">Массовое удаление данных</span>
<!-- 
		<span status data-change="changeStatusByTrackRU">Массовая смена статуса по трек-номеру Почты России</span>
		<span status data-change="changeStatusByPersonalID">Массовая смена статуса по ID</span>
 -->
<!-- 
		<span status data-change="liveInform">LiveInform</span>
 -->
		<div id="params"></div>
	</div>
</div>

<div class="flexpaginator">
	<input data-sorter="text" type="text" data-sort="like" placeholder="Поиск">
	 <?php if (in_array('tech', $RoleGroup) || in_array('allstatus', $RoleGroup)) { ?>
		<select data-count="0" data-select="statuses" style="border:0">
		<option>Изменить статус</option>
		<optgroup label="Статусы">
	<?php 
		for ($a = 0; $a < count($statuses); $a++) {
			if (isset($statuses[$a]['container']))
			echo '<option list="'. $statuses[$a]['statusgroup'] .'" status="'. $statuses[$a]['id'] .'">'. $statuses[$a]['name'] .'</option>';
		}
	?>	
	</optgroup>
</select>
<?php } ?>
	<select data-count="0" data-select="sms">
	<option>Отправить SMS</option>
	<optgroup label="Шаблоны SMS">
	<?php 
		foreach ($sms as $key => $value) {
			echo '<option sms="'. $key .'">'. $value .'</option>';
		}
	?>	
	</optgroup>
</select>
	<select data-count="0" data-select="blanks">
	<option>Печать бланков</option>
	<?php 
		foreach ($parcel as $key => $value) {
			echo '<optgroup label="Аккаунт #'. $value['firstname'] .'">
				<option data-change="1" account="'. $value['id'] .'">Посылка Онлайн</option>
				<option data-change="2" account="'. $value['id'] .'">Посылка нестандартная</option>
				<option data-change="3" account="'. $value['id'] .'">Обычная+наложка фк</option>
				<option data-change="6" account="'. $value['id'] .'">Посылка Курьер "Онлайн"</option>
			</optgroup>';
		}
	?>	
</select>
	<select data-count="0" data-select="api">
	<option>Выгрузка</option>
	<?php 
		foreach ($parcel as $key => $value) {
			echo '<optgroup label="Онлайн-сервис «Отправка» Аккаунт #'. $value['firstname'] .'">
				<option account="'. $value['id'] .'" data-change="russianPostParcel">Посылка «Нестандартная» в статус «К сдаче» (c попаданием в партию)</option>
				<option account="'. $value['id'] .'" data-change="russianPostParcelToNewStatus">Посылка «Нестандартная» в статус «Новые» (без попадания в партию)</option>
				<option account="'. $value['id'] .'" data-change="russianPostOnlineParcel">Посылка «Онлайн» в статус «К сдаче» (c попаданием в партию)</option>
				<option account="'. $value['id'] .'" data-change="russianPostOnlineParcelToNewStatus">Посылка «Онлайн» в статус «Новые» (без попадания в партию)</option>
				<option account="'. $value['id'] .'" data-change="russianPostOnlineCourier">Посылка Курьер "Онлайн" в статус «К сдаче» (c попаданием в партию)</option>
				<option account="'. $value['id'] .'" data-change="russianPostOnlineCourierToNewStatus">Посылка Курьер "Онлайн" в статус «Новые» (без попадания в партию)</option>
			</optgroup>';
		}
	?>	
	<optgroup label="Текстовые форматы">
		<option data-change="csv">CSV</option>
	</optgroup>
</select>
<?php if(($_SERVER['REQUEST_URI'] === '/partner?47' || $_SERVER['REQUEST_URI'] === '/partner?87') && in_array('tech', $RoleGroup)){?>
<select data-count="0" data-select="trackthepackage">
	<option>Отследить посылку РФ</option>
	<optgroup label="Выберите аккаунт для выгрузки">
	<?php 
		foreach ($trackthepackage as $key => $value) {
			echo '<option data-change="1" account="'. $key .'">'.$value.'</option>';
		}
	?>	
	</optgroup>
</select>
	<?php } ?>
</div>
<?php if(in_array('tech', $RoleGroup) || in_array('allstatus', $RoleGroup)) { ?>
	<div>
		<input type="button" class="select_all" value="Выбрать лист">
	</div>
	<?php } ?>
<div class="tablecontainer">
<table class="requesttable" searcher cellpadding="10" cellspacing="0" border="0" style="width:100%">
</table>
</div>
<div id="list2">
	<div paginator></div>
</div>
<script src="/js/search.js"></script>
<script>
	var searchstat 	= "<?php if(in_array('searchstat', $RoleGroup)) echo 1 ?>";
	var admin 		= "<?php if(in_array('admin', $RoleGroup)) echo 1 ?>";
	var manager 	= "<?php if(in_array('manager', $RoleGroup)) echo 1 ?>";
	var supervisor 	= "<?php if(in_array('supervisor', $RoleGroup)) echo 1 ?>";

	//url вида ?1
	var st = 1;
	var li = 17;
	var status = (parseInt(window.location.search.substr(1).split('&')[0]) == window.location.search.substr(1).split('&')[0]) ? window.location.search.substr(1).split('&')[0] : 1;
	var stats = <?=json_encode($stats)?>;
	if (status != 1) {
		st = status;
		$.ajax({
			url: '/json/',
			data: {
				func: 'CEditCat',
				action: 'getAllIDS',
				status: st
			},
			method: 'POST',
			dataType: 'json',
			success: function(data) {
				$("#list2").attr('allids', data.join(','));
			}
		});
		li = stats[status];
	}
	$('.requesttable').append('<thead id="table_content" list="'+ li +'"></thead>\
		<tbody class="call" user="all" pagination="true" list="'+ li +'" status="'+ st +'" count="30" template="10" order_by="ids"></tbody>')
	$('#search_content').attr('list', li)
	
	try {
		var ids = 0;
		var vars = window.location.search.substring(1).split('&');
		for (var i = 0; i < vars.length; i++) {
			var pair = vars[i].split('=');
			if (decodeURIComponent(pair[0]) == 'ids') {
				ids = decodeURIComponent(pair[1]);
			}
		}
		if (ids != 0) {
			setTimeout(() => {
				$('[data-sort="like"][data-sorter="text"]').val(ids)
				$('[data-sort="like"][data-sorter="text"]').change()
			}, 2000)
		}
	} catch(e) {

	}
	//новые заказы
	localStorage.setItem('ex_count', $('.orders[list=17][status=1] i').text());
	var myTimer = setInterval(function() {
		var i = 0;
		var openedCards = JSCat.operatorSetting.operator_opencard;
		$('.absolute').addClass('totop')
		var json = {func:'CEditCat', domain:JSCat.domain, token:JSCat.token};
		json["action"] = "newOrder";
		json["open_card"] = $('.frm.frm2 .ids').text();
		json["open_cards"] = openedCards;
		json["open_card_user"] = JSCat.user;
		json["ex_count"] = localStorage.ex_count;
		$.post("/json/", json, function(obj) {		
			if (typeof obj != 'object') obj = JSON.parse(obj);			
			var res = parseInt(obj['count'])
			if (res > parseInt(localStorage.ex_count)) {
				$('a[list="17"][status="1"] i, .absolute').remove()
				$('a[list="17"][status="1"]').prepend('<i>'+ res +'</i><a class="absolute" href="/partner?1"></a>')
				localStorage.setItem('ex_count', res)
				$('.absolute').removeClass('totop')	
				//if	(i == 0) playSound(1)//on
				i++;
			}
			$('.ids').parent().parent().parent().removeClass('opened');
			obj['cards'].forEach(function(element){
				var el =	element.split('_');
				if(el != ''){
					var arrs = el[1].match(/.{1,7}/g);
				}else{
					var arrs = el;
				}
				
				if (arrs.length == 1) {
					$('.ids[ids="'+el[1]+'"]').parent().parent().parent().addClass('opened');
					if (typeof(JSCat.operators[el[0]]) != 'undefined') $('.ids[ids="'+el[1]+'"]').parent().parent().parent().find('span.operatorName i').text(JSCat.operators[el[0]].name);
				} else {
					for (a in arrs) {
						$('.ids[ids="'+ arrs[a] +'"]').parent().parent().parent().addClass('opened');
						$('.ids[ids="'+ arrs[a] +'"]').parent().parent().parent().find('span.operatorName i').text(JSCat.operators[el[0]].name);
					}
				}
			})
			
// 			for (a in obj.arr) {
// 				$('[ids="'+ obj.arr[a] +'"]').parent().css({'background':'var(--color2)','color':'white'})
// 			}
		});
	}, 5000);

	$('div#container-2 span').click(function() {
		
		var statuses = '<?php for ($a = 0; $a < count($statuses); $a++) {
			if (isset($statuses[$a]['container']))
			echo '<option list="'. $statuses[$a]['statusgroup'] .'" status="'. $statuses[$a]['id'] .'">'. $statuses[$a]['name'] .'</option>';
		}?>';
		var item = $(this).attr('data-change');
		$('#params').empty().append('<button class="btn btn-primary" id="go">Продолжить</button>');
		switch (item) {
// 			case 'downloadRussianpostTracks':
// 				$('#params').attr('data-selected', item).append('<h3>Массовая загрузка трек-номеров Почты России</h3>\
// 				<textarea id="area" placeholder="Добавьте в список трек-номера по одному на строку"></textarea>\
// 					<div style="float:right"><p>Количество заказов без трек-номеров: <i>0</i></p><p>Добавлено трек-номеров: <i>0</i></p></div>');
// 			break;
			case 'deleteRussianpostTracks':
				$('#params').attr('data-selected', item).append('<h3>Массовое удаление треков «Почты России»</h3><span class="label">Выберите статус</span><select id="statuses">'+ statuses +'</select>');
			break;
			case 'deleteCustomData':
				$('#params').attr('data-selected', item).append('<h3>Массовое удаление данных</h3>\
					<select id="select"><option status="1">Доп.поле 1</option>\
						<option status="2">Доп.поле 2</option>\
						<option status="3">Доп.поле 3</option>\
						<option status="4">Доп.поле 4</option>\
						<option status="5">Доп.поле 5</option>\
						<option status="6">Доп.поле 6</option>\
						<option status="7">Доп.поле 7</option>\
						<option status="8">Доп.поле 8</option>\
						<option status="9">Доп.поле 9</option>\
						<option status="10">Доп.поле 10</option>\
					</select>\
				<div class="alert alert-danger"><p>Внимание! Данная процедура удалит данные у всех заказов, в выбранном поле!</p></div>');
			break;

			case 'addCustomData':
				$('#params').attr('data-selected', item).append('<h3>Массовая загрузка произвольных данных</h3>\
				<input type="text" id="area" placeholder="Не указано">\
					<label><input checked="checked" type="radio" name="radio1" value="one"> Записывать новые значения только в пустые поля</label><br><label><input type="radio" name="radio1" value="all"> Перезаписать все поля</label><hr>\
					<!--label><input checked="checked" type="radio" name="radio2" value="one"> Применить отдельное значение для каждого заказа в статусе</label><br><label><input type="radio" name="radio2" value="all"> Применить одно значение для всех заказов в статусе</label><br><br-->\
					<label>Выберите поле для загрузки данных</label><br>\
					<select id="select" style="max-width: 300px;"><option status="1">Доп.поле 1</option>\
						<option status="2">Доп.поле 2</option>\
						<option status="3">Доп.поле 3</option>\
						<option status="4">Доп.поле 4</option>\
						<option status="5">Доп.поле 5</option>\
						<option status="6">Доп.поле 6</option>\
						<option status="7">Доп.поле 7</option>\
						<option status="8">Доп.поле 8</option>\
						<option status="9">Доп.поле 9</option>\
						<option status="10">Доп.поле 10</option>\
					</select>\
					<p>Добавлено данных: <i>0</i></p>');
			break;
// 			case 'checkOrdersForGroundDelivery':
// 				$('#params').attr('data-selected', item).append('<h3>Проверка заказов для отправки<br>наземным способом Почтой России</h3><span class="label">Переместить в этот статус заказы запрещенные к пересылке наземным способом</span><select id="statuses">'+ statuses +'</select>');
// 				$('#params').attr('data-selected', item).append('<span class="label">Выберите доп. поле, в которое вписать информацию о возможном способе пересылки (Прямой авиа, Авиа, Наземная)</span><select id="fields"></select>');
// 			break;
// 			case 'changeStatusByTrackRU':
// 				$('#params').attr('data-selected', item).append('<h3>Массовая смена статуса по<br>трек-номеру Почты России</h3><textarea id="area" placeholder="Добавьте в список трек-номера по одному на строку"></textarea>\
// 					<span class="label">В какой статус необходимо переместить заказы</span><select id="statuses">'+ statuses +'</select><p>Добавлено трек-номеров: <i>0</i></p>');
// 			break;
// 			case 'changeStatusByPersonalID':
// 				$('#params').attr('data-selected', item).append('<h3>Массовая смена статуса по<br>ID заказа</h3><textarea id="area" placeholder="Добавьте в список трек-номера по одному на строку"></textarea>\
// 					<span class="label">В какой статус необходимо переместить заказы</span><select id="statuses">'+ statuses +'</select><p>Добавлено трек-номеров: <i>0</i></p>');
// 			break;
			case 'liveInform':
				$('#params').attr('data-selected', item).append('<h3>liveInform</h3><label><input checked="checked" type="radio" name="radios" value="Касса"> Касса</label><br><label><input type="radio" name="radios" value="Пим"> Пим</label><br><input type="file" id="file" class="none">');		
				$('#go').click(() => {$('#file').click()});	
				$('#file').change(() => {add()});
				function add() {
					var $input = $('#file');
					var a = false;
					$('#params textarea').remove();
					$('#params').append('<textarea></textarea>')
					for (var i = 0; i < $input.prop('files').length; i++) {
						var xmlhttp = new XMLHttpRequest();
						var form = new FormData();
						link = '/json/';
						form.append('token', JSCat.token);
						form.append('domain', JSCat.domain);
						form.append('func', 'CEditCat');
						form.append('action', 'addLiveInform');
						form.append('radios', $('[name="radios"]:checked').attr('radios'));
						form.append('file', $input.prop('files')[i]);
						xmlhttp.onreadystatechange = function() {
        					if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            				//console.log(xmlhttp.responseText);
            				var data = xmlhttp.responseText;
            				if (typeof data !== 'object') data = JSON.parse(data);
            				for(a in data) $('#params textarea').val(write(a, data))
            				//for(a in data) $('#params textarea').append('<div><span>'+ a +'</span><span>'+ data[a] +'</span><span>Выполнено</span></div>')
        					}
    					}
    				}
    				//.join('\n');
					xmlhttp.open('POST',link,'1');
					xmlhttp.send(form);
				}
				function write(a, data) {
					var tval = $('#params textarea').val();
					tval = tval +'\n'+ a +': Выполнено';
					return tval;
				}
				break;
			}
			Array.prototype.in_array = function(p_val) {
				for(var i = 0, l = this.length; i < l; i++)	{
					if(this[i] == p_val) {
						return true;
					}
				}
				return false;
			}

			if (['downloadRussianpostTracks','deleteRussianpostTracks','deleteCustomData',
				'addCustomData','changeStatusByTrackRU','changeStatusByPersonalID'].in_array(item)) {
				$('#go').unbind().click(function() {	
					confirm({
						text: "Вы уверены, что хотите произвести выгрузку «"+ $('#params h3').text() +"»?",
						ok: function() {
							var json = {func:'CEditCat', domain:JSCat.domain, token:JSCat.token};
							if ($('tr.request.whitesmoke').length == 0) {
								$ids = $("#list2").attr('allids').split(',');
							}
							json["action"] 	= item;
							json["area"] 		= $('#area').val()
							json["radio1"] 	= $('input[name="radio1"]:checked').val()
							json["radio2"] 	= $('input[name="radio2"]').val()
							json["status"] 	= window.location.search.substr(1) //
							json["select"] 	= $('#select option:selected').attr('status')
							$.post("/json/", json, function(a) {
								//location.reload()
								$('#params p i').val(a)
								alert('Выполнено')
							});
						}
					});
				})
			}
	});
			
	
	$('#params #go').click(function() {	
		var selected = $('#params').attr('data-selected');
		var item = $('span[data-change="'+ selected +'"]');
		confirm({
			text: "Вы уверены, что хотите произвести выгрузку «"+ item.text() +"»?",
			ok: function() {
				var json = {func:'CPanel', domain:JSCat.domain, token:JSCat.token};
				if ($('tr.request.whitesmoke').length == 0) {
					$ids = $("#list2").attr('allids').split(',');
				}
				json["action"] 	= "mass";
				json["list"] 		= $('tbody.call').attr('list');
				json["ids"] 		= $ids;
				json["tolist"] 	= item.attr('list');
				json["tostatus"] 	= item.attr('status');
				$.post("/json/", json, function(){
					////location.reload()
				});
			},
			cancel: function() {
				 $('select[data-select="mass"]').find('option:first').prop('selected',true);
			}
		});
	});
	
	
	if (JSCat.bl == '1') { //Разрешить оператору Экспорт/выгрузка заказов
		$('select[data-select="api"]').change(function() {
			var item = $(this).find('option:selected');
			var $ids = [];
			$('tr.request.whitesmoke').each(function(){
			    var id = $(this).find('[label="ids"] .ids').text();
			    $ids.push(id);
			});	
			if ($('tr.request.whitesmoke').length == 0) {
				$ids = $("#list2").attr('allids').split(',');
			}
			confirm({
				text: "Вы выбрали "+ item.text() +". Продолжить?",
				ok: function() {
					var json = {func:'RussianPosts', domain:JSCat.domain, token:JSCat.token};
					json["action"] 	= "russianPostParcel";
					json["list"] 		= $('tbody.call').attr('list');
					json["ids"] 		= $ids;
					json["param"] 		= item.attr('data-change');
					json["account"] 	= item.attr('account');
					$.post("/json/", json, function(result) {
						var is = item.attr('data-change');
						switch (is) {
							case 'api':
								objects.csv(result);
							break;
							case 'russianPostParcel':
							case 'russianPostParcelToNewStatus':
							case 'russianPostOnlineParcel':
							case 'russianPostOnlineParcelToNewStatus':
							case 'russianPostOnlineCourier':
							case 'russianPostOnlineCourierToNewStatus':
							break;
						}
						location.reload()
					});
				},
				cancel: function() {
					 $('select[data-select="api"]').find('option:first').prop('selected',true);
				}
			});
		});
	
	} else {
		$('select[data-select="api"]').empty() //Разрешить оператору Экспорт/выгрузка заказов
	}
	
	//sms
	$('select[data-select="sms"]').change(function() {
		var item = $(this).find('option:selected');
		var $ids = [];
		$('tr.request.whitesmoke').each(function(){
		    var id = $(this).find('[label="ids"] .ids').text();
		    $ids.push(id);
		});	
		if ($('tr.request.whitesmoke').length == 0) {
			$ids = $("#list2").attr('allids').split(',');
		}
		confirm({
			text: "Вы уверены, что хотите отправить смс с шаблоном «"+ item.text() +"»?",
			ok: function() {
				var json = {func:'SMS', domain:JSCat.domain, token:JSCat.token};		
				json["action"] 	= "send";
				json["list"] 		= $('tbody.call').attr('list');
				json["ids"] 		= $ids;
				json["id"] 			= item.attr('sms');
				$.post("/json/", json, function() {
					location.reload()
				});
			},
			cancel: function() {
				 $('select[data-select="sms"]').find('option:first').prop('selected',true);
			}
		});
	});
	
	//Разрешить оператору печать почтовых бланков
	if (JSCat.bl == '1') { 
		$('select[data-select="blanks"]').change(function() {
			var item = $(this).find('option:selected');	
			var count = $(this).attr('data-count');	
			if ($('tr.request.whitesmoke').length == 0) {
				$ids = $("#list2").attr('allids').split(',');
			}
			if (item.attr('data-change') > 0) confirm({
				text: "Вы уверены, что хотите произвести выгрузку «"+ item.text() +"»?",
				ok: function() {
					var json = {func:'RussianPosts', domain:JSCat.domain, token:JSCat.token};
					json["action"] 	= "blanks";
					json["list"] 		= $('tbody.call').attr('list')
					json["ids"] 		= $ids;
					json["status"] 	= window.location.search.substr(1) //
					json["param"]		= item.attr('data-change')
					json["account"]	= item.attr('account')
					$.post("/json/", json, function(a) {
						if (a.length > 0) {
							var element = document.createElement('a')
							element.setAttribute('href', a)
							element.setAttribute('target', '_blank')
							element.style.display = 'none';
							document.body.appendChild(element)
							element.click()
							document.body.removeChild(element)
						}
						//location.reload()
					});
				},
				cancel: function() {
					 $('select[data-select="blanks"]').find('option:first').prop('selected',true);
				}
			});
		});
	} else {
		$('select[data-select="blanks"]').empty() //Разрешить оператору печать почтовых бланков
	}
	$('select[data-select="statuses"]').change(function() {	
		var item = $(this).find('option:selected');
		confirm({
			text: "Вы уверены, что хотите изменить статус заказов на «"+ item.text() +"»?",
			ok: function() {
				var json = {func:'CPanel', domain:JSCat.domain, token:JSCat.token};
				if ($('tr.request.whitesmoke').length == 0) {
					$ids = $("#list2").attr('allids').split(',');
				}
				json["action"] 	= "statusChange";
				json["list"] 		= $('tbody.call').attr('list');
				json["ids"] 		= $ids;
				json["tolist"] 	= item.attr('list');
				json["tostatus"] 	= item.attr('status');
				
				$.post("/json/", json, function(a) {
					//location.reload()
				});
			},
			cancel: function() {
				 $('select[data-select="statuses"]').find('option:first').prop('selected',true);
			}
		});
	});
	
	if (JSCat.bl == '1') { 
		$('select[data-select="trackthepackage"]').change(function() {	
			var item = $(this).find('option:selected');
			var count = $(this).attr('data-count');	
			if ($('tr.request.whitesmoke').length == 0) {
					$ids = $("#list2").attr('allids').split(',');
				}
			if (item.attr('data-change') > 0) confirm({
				text: "Вы уверены, что хотите произвести выгрузку в «"+ item.text() +"»?",
				ok: function() {
					var json = {func:'TrackThePackage', domain:JSCat.domain, token:JSCat.token};
					json["action"] 	= "start";
					json["list"] 		= $('tbody.call').attr('list')
					json["ids"] 		= $ids;
					json["status"] 	= window.location.search.substr(1) //
					json["param"]		= item.attr('data-change')
					json["account"]	= item.attr('account')
					$.post("/json/", json, function(a) {
						
						//location.reload()
					});
				},
				cancel: function() {
					//  $('select[data-select="blanks"]').find('option:first').prop('selected',true);
				}
			});
		});
	}

	if (JSCat.bl == '1') {
		$ids = []; 
		$('input[class="select_all"]').click(function() {
			var $id = [];
			var f = $(this).find('option:first').text();

			var ids = $('span[ids]').each(function(indx,element){
				return $(this).val();
			});
			var $count = ids.length;
			for (let index = 0; index < ids.length; index++) {
				$id[$id.length] = String(ids[index].innerText);
				$ids.push(ids[index].innerText);
			}
			$id = '"'+$id.join('","')+'"';
			$('select[data-select]').each(function() {
				$('tr[class="request"]').toggleClass("whitesmoke");
				$('tr[class="request opened"]').toggleClass("whitesmoke");
				var f = $(this).find('option:first').text();
				f = f.split(':')[0];
				$(this).find('option:first').text(f +': ('+ $count + ')');
				$(this).attr('data-count', $count);
				$(this).attr('data-array', '['+$id+']');
			});
		});
	}

	function whitesmoke() {
		$ids = [];
		$(this).parent().toggleClass('whitesmoke');
		$('tr.request.whitesmoke').each(function(){
	   	var id = $(this).find('[label="ids"] .ids').text();
	    	$ids.push(id);
		});
		var count = ($ids.length) ? $ids.length : localStorage.countall;
		
		$('select[data-select]').each(function() {
			var f = $(this).find('option:first').text();
			f = f.split(':')[0];
			$(this).find('option:first').text(f +': ('+ count + ')');
			$(this).attr('data-count', count);
			$(this).attr('data-array', JSON.stringify($ids));
		});
		$('thead#table_content th:first-of-type').unbind().click(whitesmokeOff.bind(this))
	}
	function whitesmokeOff() {
		$('.whitesmoke').removeClass('whitesmoke');
		$('select[data-select]').each(function() {
			var f = $(this).find('option:first').text();
			f = f.split(':')[0];
			$(this).find('option:first').text(f +': '+ localStorage.countall);
			$(this).attr('data-count', 0);
			$(this).attr('data-array', '');
		});
		$ids = [];
		$count = 0;
	}
	var $ids = [];
	var $count = 0;
	
	//waitForElement('tr.request td[label]', function() {}, 500);
	//setInterval(() => {}, 100)
	
	setInterval(() => {
		$('tr.request td[label]').click(whitesmoke.bind(this))
	}, 1000)

	$('#compare').change(update.bind(this, 'compare'));
	$('#premium').change(update.bind(this, 'premium'));	
	function update(id) {
		var json = {func:'CXML', domain:JSCat.domain, token:JSCat.token};
		json["action"] = id;
		json["status"] = $('#'+ id).is(":checked");
		$.post("/json/", json, function() {
			//location.reload()
		});
	}	
	$('[href="/partner'+ window.location.search +'"]').addClass('active');
	

</script>

<script>
// 	setTimeout(function(){
// 		renderer.socketio()
// 	}, 1000)
</script>
<script>

localStorage.removeItem('price');
function objects(params) {
	$.extend(this.options, params);
}

	objects.prototype = {
		
		objectToCSVRow: function(dataObject) {			
			var dataArray = new Array;
			for (var o in dataObject) {
				var innerValue = dataObject[o]===null?'':dataObject[o].toString();
				var result = innerValue.replace(/"/g, '""');
				result = '"' + result + '"';
				dataArray.push(result);
			}
			return dataArray.join(' ') + '\r\n';
		},
		csv: function(arrayOfObjects) {
			if (!arrayOfObjects.length) {
				return;
			}
			var csvContent = "data:text/csv;charset=utf-8,";
			// headers
			csvContent += objects.objectToCSVRow(Object.keys(arrayOfObjects[0]));
			arrayOfObjects.forEach(function(item){
				csvContent += objects.objectToCSVRow(item);
			}); 
			var encodedUri = encodeURI(csvContent);
			var link = document.createElement("a");
			link.setAttribute("href", encodedUri);
			link.setAttribute("download", "goods.csv");
			document.body.appendChild(link); // Required for FF
			link.click();
			document.body.removeChild(link); 	
		}
// 		ads: function() {
// 			if (JSCat.category != null) {
// 				$('#contents-add, #search_content').empty();
// 				$('#list2').empty().append('<div searcher class="call crmls" list="22" status="1" user="all" count="25" pagination="true" template="10"></div><div paginator></div>');
// 				renderer.process.calls();
// 				return false;
// 				return false;
// 			}
// 		}
}
 
// $(function() {
// 	objects = new objects();
// 	objects.start();
// });

</script>
