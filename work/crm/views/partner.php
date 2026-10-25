<?php namespace lib;
	if (!in_array('partner', $RoleUser) && !in_array('partner', $RoleGroup)) die();	



$css = [];
$scss = '';
$Result = JBase::get_Data('colors', ['name','hash'], ['on' => 1]);
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

$sms = [];
$Result = JBase::get_Data('list5', ['id','name'], ['status' => 1]);
if ($Result) {
	while($smss = $Result->fetch_assoc()) {
		$sms[$smss['id']] = $smss['name'];
	}
}
	
$containers = [];
$Result = JBase::get_Data('list9', '*', ['status' => 1]);
if ($Result) {
	while($cont = $Result->fetch_assoc()) {
		$containers[$cont['id']] = $cont['name'];
	}
}
		
$statuses = [];
$Result = JBase::get_Data('list8', '*', ['status' => 1]);
if ($Result) {
	while($stat = $Result->fetch_assoc()) {
		$statuses[$stat['id']] = $stat;
	}
}

$operators = [];
$Result = JBase::get_Data('my_users', '*', ['status' => 1]);
if ($Result) {
	while($stat = $Result->fetch_assoc()) {
		$statuses[$stat['id']] = $stat;
	}
}

$tabs = '';
$divs = '';
$keys = array_keys($statuses);
$cont = array_keys($containers);
//echo json_encode(array_keys($containers),JSON_UNESCAPED_UNICODE);
		
?>


<div id="contents-add" style="position: absolute;width: 100%;z-index: 999;max-width: calc(100vw - 30px);top: -20px;"></div>

<ul class="nav nav-tabs">
  <li class="active"><a data-toggle="tab" href="#container-0">Все статусы</a></li>
  <li><a data-toggle="tab" href="#container0">Без контейнера</a></li>
  <?php 
		for ($i = 1; $i < count($containers) + 1; $i++) {
			$tabs .= '<li><a data-toggle="tab" href="#container'. $i .'">'. $containers[$i] .'</a></li>';
		}
		echo $tabs;
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
			if (isset($statuses[$a]['container'])) {
				$count = ((int)$statuses[$a]['count'] > 0) ? '<i>'. $statuses[$a]['count'] .'</i> ' : '';
				echo '<span class="orders" list="'. $statuses[$a]['statusgroup'] .'" status="'. $a .'">'. $count .''. $statuses[$a]['name'] .'</span>';
			}
		}
	?>
	</div>
	<div id="container0" class="tab-pane fade">
	<?php 
		for ($a = 0; $a < count($statuses); $a++) {
			if ($statuses[$a]['container'] == '0') {
				$count = ((int)$statuses[$a]['count'] > 0) ? '<i>'. $statuses[$a]['count'] .'</i> ' : '';
				echo '<span  list="'. $statuses[$a]['statusgroup'] .'" status="'. $a .'">'. $count .''. $statuses[$a]['name'] .'</span>';
			}
		}
	?>
	</div>
	<?php 
		foreach ($cont as $i) {
			$divs .= '<div id="container'. $i .'" class="tab-pane fade">';
			for ($a = 0; $a < count($statuses); $a++) {
				$count = ((int)$statuses[$a]['count'] > 0) ? '<i>'. $statuses[$a]['count'] .'</i> ' : '';
				if (in_array($statuses[$a]['container'], $cont) && $statuses[$a]['container'] == $i)
				$divs .= '<span list="'. $statuses[$a]['statusgroup'] .'" status="'. $a .'">'. $count .''. $statuses[$a]['name'] .'</span>';
			}
			$divs .= '</div>';
		}
		echo $divs;
	?>
	<div id="container-1" class="tab-pane fade"><div id="search_content" list="17"></div></div>
	<div id="container-2" class="tab-pane fade">
		<span status data-change="downloadRussianpostTracks">Массовая загрузка штрихкодов Почты России</span>
		<span status data-change="deleteRussianpostTracks">Массовое удаление штрихкодов Почты России</span>
		<span status data-change="checkOrdersForParcelOnline">Проверка заказов для отправки Посылкой Онлайн</span>
		<span status data-change="checkOrdersForCourierOnline">Проверка заказов для отправки Курьером Онлайн</span>
		<span status data-change="checkOrdersForGroundDelivery">Проверка заказов для отправки наземным способом Почты России</span>
		<span status data-change="changeStatusByTrackRU">Массовая смена статуса по трек-номеру Почты России</span>
		<span status data-change="changeStatusByPersonalID">Массовая смена статуса по ID</span>
		<span status data-change="liveInform">LiveInform</span>
		<div id="params"></div>
	</div>
</div>

<div class="flexpaginator">
	<select data-count="0" data-select="statuses" style="border:0">
	<option>Изменить статус</option>
	<optgroup label="Статусы">
	<?php 
		for ($a = 0; $a < count($statuses); $a++) {
			if (isset($statuses[$a]['container']))
			echo '<option list="'. $statuses[$a]['statusgroup'] .'" status="'. $a .'">'. $statuses[$a]['name'] .'</option>';
		}
	?>	
	</optgroup>
</select>
	<select data-count="0" data-select="sms">
	<option>Отправить SMS</option>
	<optgroup label="Шаблоны SMS">
	<?php 
		foreach ($sms as $key => $value) {
			echo '<option status="'. $key .'">'. $value .'</option>';
		}
	?>	
	</optgroup>
</select>
	<select data-count="0" data-select="blanks">
	<option>Печать бланков</option>
	<optgroup label="Персональные бланки">
		<option data-change="1">Обычная</option>
		<option data-change="2">Посылка нестандартная</option>
		<option data-change="3">Посылка Онлайн</option>
		<option data-change="4">Обычная+наложка фк</option>
	</optgroup>
</select>
	<select data-count="0" data-select="api">
	<option>Выгрузка</option>
	<optgroup label="Текстовые форматы">
		<option data-change="csv">CSV</option>
	</optgroup>
	<optgroup label="Онлайн-сервис «Отправка»">
		<option data-change="russianPostParcel">Посылка «Нестандартная» в статус «К сдаче» (c попаданием в партию)</option>
		<option data-change="russianPostParcelToNewStatus">Посылка «Нестандартная» в статус «Новые» (без попадания в партию)</option>
		<option data-change="russianPostOnlineParcel">Посылка «Онлайн» в статус «К сдаче» (c попаданием в партию)</option>
		<option data-change="russianPostOnlineParcelToNewStatus">Посылка «Онлайн» в статус «Новые» (без попадания в партию)</option>
	</optgroup>
</select>
</div>
<div class="tablecontainer">
<table class="requesttable" searcher cellpadding="10" cellspacing="0" border="0" style="width:100%">
	<thead id="table_content" list="17"></thead>
	<tbody class="call" user="all" pagination="true" list="17" status="1" count="5" template="10" order_by="name"></tbody>
</table>
</div>
<div id="list2">
	<div paginator></div>
</div>

<script>

	localStorage.setItem('ex_count', $('.orders[list=17][status=1] i').text());
// 	var myTimer = setInterval(function() {
// 		var json = {func:'CEditCat', domain:JSCat.domain, token:JSCat.token};
// 		json["action"] = "newOrder";
// 		json["ex_count"] = localStorage.ex_count;
// 		$.post("/json/", json, function(res) {						
// 										
// 			var res = parseInt(res);
// 			var exx = parseInt(localStorage.ex_count);
// 
// 			if (res > exx) {
// 				$('span[list="17"][status=1] i, .absolute').remove();				
// 				$('span[list="17"][status="1"]').prepend('<i>'+ res +'</i><a class="absolute" href="/partner"></a>');
// 				localStorage.setItem('ex_count', res);
// 				playSound(1)//on
// 			}
// 		});
// 	}, 5000);
	
	$('.tab-content [list][status]').click(function() {
		var item = $(this);
		$('tbody.call').attr({'list': item.attr('list'), 'status': item.attr('status')});
		$('thead#table_content, #search_content').attr({'list': item.attr('list')});
		$('tbody.call').remove().clone().appendTo('.requesttable');
		localStorage.removeItem('search');
		setTimeout(() => {renderer.process.calls()}, 100)
	});
	
	$('div#container-2 span').click(function() {
		var item = $(this).attr('data-change');
		$('#params').empty().append('<button class="btn btn-primary" id="go">Продолжить</button>');
		switch (item) {
			case 'downloadRussianpostTracks':
				$('#params').attr('data-selected', item).append('<h3>Массовая загрузка трек-номеров Почты России</h3>\
				<textarea id="area" placeholder="Добавьте в список трек-номера по одному на строку"></textarea>\
					<p>Количество заказов без трек-номеров: <i>0</i></p><p>Добавлено трек-номеров: <i>0</i></p>');
			break;
			case 'deleteRussianpostTracks':
				$('#params').attr('data-selected', item).append('<h3>Массовое удаление треков «Почты России»</h3><span class="label">Выберите статус</span><select id="statuses"></select>');
			break;
			case 'checkOrdersForParcelOnline':
				$('#params').attr('data-selected', item).append('<h3>Проверка заказов для отправки Посылкой Онлайн</h3><span class="label">Выберите статус</span><select id="statuses"></select>');
			break;
			case 'checkOrdersForCourierOnline':
				$('#params').attr('data-selected', item).append('<h3>Проверка заказов для отправки Курьером Онлайн</h3><span class="label">Выберите статус</span><select id="statuses"></select>');
			break;
			case 'checkOrdersForGroundDelivery':
				$('#params').attr('data-selected', item).append('<h3>Проверка заказов для отправки наземным способом Почтой России</h3><span class="label">Переместить в этот статус заказы запрещенные к пересылке наземным способом</span><select id="statuses"></select>');
				$('#params').attr('data-selected', item).append('<span class="label">Выберите доп. поле, в которое вписать информацию о возможном способе пересылки (Прямой авиа, Авиа, Наземная)</span><select id="fields"></select>');
			break;
			case 'changeStatusByTrackRU':
				$('#params').attr('data-selected', item).append('<h3>Массовая смена статуса по трек-номеру Почты России</h3><textarea id="area" placeholder="Добавьте в список трек-номера по одному на строку"></textarea>\
					<span class="label">В какой статус необходимо переместить заказы</span><select id="statuses"></select><p>Добавлено трек-номеров: <i>0</i></p>');
			break;
			case 'changeStatusByPersonalID':
				$('#params').attr('data-selected', item).append('<h3>Массовая смена статуса по ID заказа</h3><textarea id="area" placeholder="Добавьте в список трек-номера по одному на строку"></textarea>\
					<span class="label">В какой статус необходимо переместить заказы</span><select id="statuses"></select><p>Добавлено трек-номеров: <i>0</i></p>');
				$('#go').unbind().click(function() {	
					confirm({
						text: "Вы уверены, что хотите произвести выгрузку «"+ item.text() +"»?",
						ok: function() {
							var json = {func:'CPanel', domain:JSCat.domain, token:JSCat.token};
							//json["action"] 	= "mass";
							json["list"] 		= $('tbody.call').attr('list');
							json["ids"] 		= $ids;
							json["tolist"] 	= item.attr('list');
							json["tostatus"] 	= item.attr('status');
							$.post("/json/", json, function(){
								//location.reload()
							});
						}
					});
				})
			break;
			case 'liveInform':
				$('#params').attr('data-selected', item).append('<h3>liveInform</h3><input type="radio" name="radios" value="Касса"> Касса<br><input type="radio" name="radios" value="Пим"> Пим<br><input type="file" id="file" class="none">');		
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
			
			$('#statuses').append('<?php 
			for ($a = 0; $a < count($statuses); $a++) {
				if (isset($statuses[$a]['container']))
				echo '<option list="'. $statuses[$a]['statusgroup'] .'" status="'. $a .'">'. $statuses[$a]['name'] .'</option>';
			}
		?>');
	});
			
			
	$('#params #go').click(function() {	
		var selected = $('#params').attr('data-selected');
		var item = $('span[data-change="'+ selected +'"]');
				
		confirm({
			text: "Вы уверены, что хотите произвести выгрузку «"+ item.text() +"»?",
			ok: function() {
				var json = {func:'CPanel', domain:JSCat.domain, token:JSCat.token};
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
	
	
	
	$('select[data-select="api"]').change(function() {
		var item = $(this).find('option:selected');
		var $ids = [];
		$('tr.request.whitesmoke').each(function(){
		    var id = $(this).find('[label="ids"] .ids').text();
		    $ids.push(id);
		});	
		confirm({
			text: "Вы выбрали "+ item.text() +". Продолжить?",
			ok: function() {
				var json = {func:'CPanel', domain:JSCat.domain, token:JSCat.token};
				json["action"] 	= "russianPostParcel";
				json["list"] 		= $('tbody.call').attr('list');
				json["ids"] 		= $ids;
				json["param"] 		= is;
				$.post("/json/", json, function(result) {
					var is = $('[data-select="api"] option:selected').attr('data-change');
					switch (is) {
						case 'api':
							objects.csv(result);
						break;
						case 'russianPostParcel':
						case 'russianPostParcelToNewStatus':
						case 'russianPostOnlineParcel':
						case 'russianPostOnlineParcelToNewStatus':
						break;
					}
					//location.reload()
				});
			},
			cancel: function() {
				 $('select[data-select="api"]').find('option:first').prop('selected',true);
			}
		});
	});
	$('select[data-select="sms"]').change(function() {
		var item = $(this).find('option:selected');
		var $ids = [];
		$('tr.request.whitesmoke').each(function(){
		    var id = $(this).find('[label="ids"] .ids').text();
		    $ids.push(id);
		});	
		confirm({
			text: "Вы уверены, что хотите отправить смс с шаблоном «"+ item.text() +"»?",
			ok: function() {
				var json = {func:'SMS', domain:JSCat.domain, token:JSCat.token};
				json["action"] 	= "send";
				json["list"] 		= $('tbody.call').attr('list');
				json["ids"] 		= $ids;
				json["tolist"] 	= item.attr('list');
				json["tostatus"] 	= item.attr('status');
				$.post("/json/", json, function(){
					////location.reload()
				});
			},
			cancel: function() {
				 $('select[data-select="sms"]').find('option:first').prop('selected',true);
			}
		});
	});
	$('select[data-select="blanks"]').change(function() {
		var item = $(this).find('option:selected');	
		var count = $(this).attr('data-count');	
		confirm({
			text: "Вы уверены, что хотите произвести выгрузку «"+ item.text() +"»?",
			ok: function() {
				var json = {func:'CPanel', domain:JSCat.domain, token:JSCat.token};
				json["action"] 	= "blanks";
				json["list"] 		= $('tbody.call').attr('list');
				json["ids"] 		= $ids;
				json["param"] 	= $('[data-select="blanks"] option:selected').attr('data-change');
				$.post("/json/", json, function(){
					//location.reload()
				});
			},
			cancel: function() {
				 $('select[data-select="blanks"]').find('option:first').prop('selected',true);
			}
		});
	});
	$('select[data-select="statuses"]').change(function() {	
		var item = $(this).find('option:selected');
		confirm({
			text: "Вы уверены, что хотите изменить статус заказов на «"+ item.text() +"»?",
			ok: function() {
				var json = {func:'CPanel', domain:JSCat.domain, token:JSCat.token};
				json["action"] 	= "statusChange";
				json["list"] 		= $('tbody.call').attr('list');
				json["ids"] 		= $ids;
				json["tolist"] 	= item.attr('list');
				json["tostatus"] 	= item.attr('status');
				$.post("/json/", json, function(a) {
					location.reload()
				});
			},
			cancel: function() {
				 $('select[data-select="statuses"]').find('option:first').prop('selected',true);
			}
		});
	});
	
	function whitesmoke() {
		$ids = [];
		$(this).parent().toggleClass('whitesmoke');
		$('tr.request.whitesmoke').each(function(){
	   	var id = $(this).find('[label="ids"] .ids').text();
	    	$ids.push(id);
		});
		var count = $ids.length;
		
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
			$(this).find('option:first').text(f +': (0)');
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