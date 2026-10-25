<?php namespace lib;
	if (!in_array('tech', $RoleUser) && !in_array('tech', $RoleGroup)) die();	
	
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

		
$statuses = [];
$Result = JBase::get_Data('list8', '*', ['status' => 1]);
if ($Result) {
	while($stat = $Result->fetch_assoc()) {
		$statuses[$stat['id']] = $stat;
	}
}
$Result->free();

//echo json_encode(Dadata::postal_office(123100),JSON_UNESCAPED_UNICODE);

$countall = 9990; //все проекты
?>

<style>
	div#charts {
    width: 100%;
    height: 70vh;
}div#charts .gm-style div[style*='background-image: url('] {
    background: url(https://1v1-crm.ru/cdn/lib/markerclusterer.svg) no-repeat center 0 / 50px!important;
    line-height: 40px!important;
    font-size: 13px!important;
    font-weight: normal!important;}
</style>
<div id="top">
	<h1>Статистика по географии
		<i class="radios little" style="float: right;">
<!-- 
			<label class="active"><input type="radio" name="radios" radios="general">Карта</label>
			<label><input type="radio" name="radios" radios="sales">График</label>
 -->
		</i>
		<i>Статистика и воронка продаж</i>
   </h1>
</div>

	<div id="container0" class="tab-pane fade in active"><span  list="all" status="all"><i><?=$countall?></i>Все проекты</span>
	<?php 
		for ($a = 0; $a < count($statuses); $a++) {
			if (isset($statuses[$a])) {
				$count = (isset($statuses[$a]['count']) && (int)$statuses[$a]['count'] > 0) ? '<i>'. $statuses[$a]['count'] .'</i> ' : '';
				echo '<span  list="'. $statuses[$a]['statusgroup'] .'" status="'. $a .'">'. $count .''. $statuses[$a]['name'] .'</span>';
			}
		}
	?>
	</div>
<br><div id="charts"></div><br>
<div class="alert alert-info">
  <p>Распределение заказов на карте решает 2 задачи:</p>
  <ul>
    <li>определение наиболее эффективных регионов для контекстной рекламы</li>
    <li>определение регионов с минимальной долей выкупа товаров</li>
  </ul>
  <p>
    Расположение заказов на карте определяется по почтовому индексу. Имейте в виду, что маркер, указывающий на почтовое отделение может быть неточным. Данные
    обновляются раз в час
  </p>
</div>

<script type="text/javascript" src="/js/chart.js"></script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDRoiO9DJcckcBqQqOcC-fvQVLUcSzKfWs"></script>
<script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>

<script>
	var map;
	function initialize() {     
	var myLatlng = new google.maps.LatLng(61.965, 81.267);
	var myOptions = {
		zoom: 3,
		center: myLatlng,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	}
	map = new google.maps.Map(document.getElementById("charts"), myOptions); 
// 	return map;
	}
	


	function statistic(list, status) {
		var geocoder = new google.maps.Geocoder;
		//статистика каталогов
		var json = {func:'CStat', domain:JSCat.domain, token:JSCat.token};
		json["action"] 		= "statistic";
		json["req"] 		= "geo";
		json["status"] 		= status;
		json["list"] 			= list;
		$.post("/json/", json, function(a){
			console.log(JSON.parse(a));
			var items = JSON.parse(a);
			
			var res = items.map(function(item,i) {
				
  				if (item.coords == '0'){
  					console.log(item.postIndex);
  					
					geocoder.geocode({
					'address': item.postIndex
					}, function(results, status) {
					console.log(results );
					
					if (status == 'ZERO_RESULTS'){
						console.log(status);
						var json = {func:'CStat', domain:JSCat.domain, token:JSCat.token};
							json["action"] 		= "statistic";
							json["req"] 		= "addcords";
							json["postIndex"] 			= item.postIndex;
							json["coords"] 			= null;
							$.post("/json/", json, function(a){
								console.log(a);
							});
					}
					if (status === google.maps.GeocoderStatus.OK) {
						
						item.coords = results[0].geometry.location.lat().toFixed(3)+','+results[0].geometry.location.lng().toFixed(3);
						item.address = results[0].formatted_address;
						console.log(results[0].geometry.location.lat().toFixed(3)+','+results[0].geometry.location.lng().toFixed(3));
						var json = {func:'CStat', domain:JSCat.domain, token:JSCat.token};
							json["action"] 		= "statistic";
							json["req"] 		= "addcords";
							json["address"] 		= item.address;
							json["postIndex"] 			= item.postIndex;
							json["coords"] 			= item.coords;
							$.post("/json/", json, function(a){
								console.log(a);
							});
						}
					});
  				}
  				return item;
			});
// 			setTimeout(initialize, 1000);
			var markers = []; 
			initialize();
// 			res.forEach(function(el) {
			for (j=0;j<res.length;j++){
// 					console.log(map);
  					var latlng = res[j].coords.split(',');
  					
  					for (i = 0; i < res[j].count; i++) {  
  						console.log(latlng);
  						marker = new google.maps.Marker({
        					position: new google.maps.LatLng(latlng[0], latlng[1]),
        					map:map
      					});
      					markers.push(marker);
      				}
			}
			//console.log(markers);
			var markerCluster = new MarkerClusterer(map, markers);
     		 	
// 			setTimeout(function() {
//  					console.log(res)
// 				}, 1000);
			
				//console.log(position);
				
		});
	}			

	function timeConverter(UNIX_timestamp) {
		var a = new Date(UNIX_timestamp * 1000);
		var months = ['Января', 'Февраля', 'Марта', 'Апреля', 'Мая', 'Июня', 'Июля', 'Августа', 'Сентября', 'Октября', 'Ноября', 'Декабря'];
		var year = a.getFullYear();
		var month = months[a.getMonth()];
		var date = a.getDate();
		var hour = a.getHours();
		var min = (a.getMinutes() < 10 ? '0' : '') + a.getMinutes();
		var sec = a.getSeconds();
		var time = date + ' ' + month + ' ' + hour + ':' + min;
		return time;
	}
	
	function radiosgen(arr, name) {
		var text = '<span class="'+ name +' little">';
		for (a in arr)
			text += '<label><input type="radio" name="'+ name +'" radios="'+ a +'">'+ arr[a] +'</label>';
			text += '</span>';
		return text;
	}
	
	function analytics() {
		//$('div[id^="container"] [status][list]').click(statistic.bind(this));
		
		$('div[id^="container"] [status][list]').click(function() {
			var list = $(this).attr('list')
			var status = $(this).attr('status')
			statistic(list, status);
		})
		$('div[id^="container"] [status][list]:first').click();
		return false;
	}
function getRandomColor() {
    var letters = '0123456789ABCDEF'.split('');
    var color = '#';
    for (var i = 0; i < 6; i++ ) {
        color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
}
	
	analytics();
</script>

