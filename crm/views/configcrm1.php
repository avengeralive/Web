<?php namespace lib;
	if ((!in_array('stat', $RoleGroup) && !in_array('stat', $RoleUser)) || (!in_array('tech', $RoleGroup) && !in_array('tech', $RoleUser)) ) die();
	
	
	
// 	
// Пример записи данных
// 
// $list = array (
// 	array('aaa', 'bbb', 'ccc', 'dddd'),
// 	array('123', '456', '789'),
// 	array('"aaa"', '"bbb"')
// );
// $fp = fopen('file.csv', 'w');
// foreach ($list as $fields) {
// 	fputcsv($fp, $fields, ';', '"');
// }
// fclose($fp);
// 
// 
// Пример чтения данных
// 
// if (($fp = fopen("file.csv", "r")) !== FALSE) {
// 	while (($data = fgetcsv($fp, 0, ";")) !== FALSE) {
// 		$list[] = $data;
// 	}
// 	fclose($fp);
// 	print_r($list);
// }
// 

?>


<div id="top">
	<h1>Массовая загрузка из файла
		<i class="radios little" style="float: right;">
			<label style="font-size: 28px;min-width: 40px;" class="dell active"><input type="radio" name="radios" radios=";">;</label>
			<label style="font-size: 28px;min-width: 40px;" class="dell"><input type="radio" name="radios" radios=",">,</label>
			<label style="font-size: 28px;min-width: 40px;" class="dell"><input type="radio" name="radios" radios="_">_</label>
	  		<button class="btn-primary" id="go">Выберите CSV-файл</button>
	  		<button class="btn-primary" id="save">Продолжить</button>
	  		<input type="file" id="file" class="none"/>
		</i>
    	<i>Задайте соответствие полей формы и колонок</i>
   </h1>
</div>
<div class="alert alert-info">
	<p><span class="label label-info">Важно</span> При импорте товаров, содержимое поля "Цены" (не "Цена"!) должно задаваться в формате <code>{"1":"1200","2":"2400"}</code>,<br>где <b>1</b> - Количество товара, <b>1500</b> - итоговая стоимость товара при покупке данного количества</p>
	<p><span class="label label-info">Важно</span> При импорте заказов, содержимое поля "Товары" должно задаваться в формате <code>{"eccofb": {"goodID": "33576","name": "Кеды Ecco","quantity": "1","price": "3990"}, ...}</code>,<br>где <b>eccofb</b> - Alias товара, <b>goodID</b> - ID товара, <b>name</b> - Название товара, <b>quantity</b> - Количество товара в заказе, <b>price</b> - Сумма товара в заказе</p>
	<p><span class="label label-info">Ограничения</span> За один раз можно загрузить не более 10 000 заказов. Данные, превышающие этот объем будут проигнорированы</p>
</div>


<ul class="nav nav-tabs">
	<li class="active"><a data-toggle="tab" href="#tovar">Товары</a></li>
	<li><a data-toggle="tab" href="#zakaz">Заказы</a></li>
</ul>
<div class="tab-content">
	<div id="zakaz"  class="tab-pane fade">
		<div class="frm2 " list="17" style="column-count: 4;-moz-column-count: 4;-webkit-column-count: 4;"></div>
	</div>
	<div id="tovar" class="tab-pane fade in active">
		<div class="frm2" list="22" style="column-count: 4;-moz-column-count: 4;-webkit-column-count: 4;"></div>
	</div>
</div>

<script>
	$('input[type=file]').on('change', function() {
		waitAlert();
		var file = this.files[0], fr;						//FileReader (Создаётся для каждого файла)
		if (/text.csv/.test(file.type)) {				//Если в файле - csv
			fr = new FileReader();							//узнаём информацию о нём
			var res =  fr.readAsText(file);				//считываем его в строку base64
			fr.onload = function (e) {						//как только файл загружен
				var csv = e.target.result;
// 				var headers = csv.split(/\r\n|\n/);
				csv = csv.replace(/'/g, "&#039;");
				//csv =  csv.replace(/"([^"]+)"/g, '');
// 				let size = headers[0].split(';').length;
				lines = CSVToArray(csv, $('.dell.active input').attr('radios'));
				lines[0].forEach(function(item, i) {
					$('.frm2 select.w150[data-id]').append( '<option data-values="'+ item +'" value="'+ i +'" =>'+ item +'</option>');
				});
				$('#save').click(addFromCsv.bind(this, lines));	
				setTimeout(waitAlert, 3000);
			}
		} else { //Если файл не csv
			waitAlert();
			alert('Файл не csv: '+ file.type);
		}
	});	
	$('#go').click(() => {$('#file').click()});
	$('.radios [name]').change(function() {
		$('.radios label').removeClass('active').find('[radios]:checked').parent().addClass('active');
	});
	$('.frm2').append( '<input type="text" class="w150" disabled="disabled" value="id"/><select data-id="id" id="ID" class="w150" ><option data-values="0" value=-1>- Не выбрано -</option></select>');
	var json = {func:'CPanel', domain:JSCat.domain, token:JSCat.token};
	json["action"] = "fieldList";
	json["list_id"] = '22';
	$.post("/json/", json, function(ret) {			
		ret = JSON.parse(ret);
		$.each(ret,(i,item) => {
			$('#tovar .frm2').append( '<input type="text" class="w150" disabled="disabled" value="'+item.caption+'"/><select data-id="'+item.caption+'" id="'+item.name_field+'" class="w150" ><option data-values="0" value=-1>- Не выбрано -</option></select>');
		});
	});
	var json = {func:'CPanel', domain:JSCat.domain, token:JSCat.token};
	json["action"] = "fieldList";
	json["list_id"] = '17';
	$.post("/json/", json, function(ret) {
		ret = JSON.parse(ret);
		$.each(ret,(i,item) => {
 			$('#zakaz .frm2').append( '<input type="text" class="w150" disabled="disabled" value="'+item.caption+'"/><select data-id="'+item.caption+'" id="'+item.name_field+'" class="w150" ><option data-values="0" value=-1>- Не выбрано -</option></select>');
		});
	});
						
	function waitAlert() {
		if ($('#black').length) {
			 $('#black').remove();
		} else {
			$('body').append('<div id="black" style="width:100%; position:absolute; top:-60px; height:100vh; background: #00000078; z-index:10000;"><div class="black-content" style="padding:40px;margin:200px auto;text-align:center;width:340px;background:white;"><span>Подождите, выполняется обработка csv файла</span></div></div>');
		}
	}					
	
	function addFromCsv(lines) {
		var select_value = {};
		$("#"+ $('.active').last().attr("id") +" select").map(function(i, el) {
			select_value[$(el).attr("id")] = $(el).val();
		}).get();
		var a = lines.splice(0,1);
		let size = 10; //размер подмассива
		let subarray = []; //массив в который будет выведен результат.
		for (let i = 0; i <Math.ceil(lines.length/size); i++){
			subarray[i] = lines.slice((i*size), (i*size) + size);
		}
				 
		$('body').append('<div id="addfromcsv" data-all="'+subarray.length+'" data-cur="'+(subarray.length -1)+'" style="display:block!important"class="modal"><div class="modal-header"><h5 class="modal-title">Добавление из csv файла</h5></button></div><div class="modal_content"><span class="num">0%</span><div class="status-bar"><div></div></div></div></div>');
		for (j=0;j<subarray.length;j++){
			setTimeout(add2, 300*j, subarray[j],select_value); 
		}	
	}
	
	function add2(data, select_value) {
		var list;
		switch ($('.active').last().attr("id")) {
			case 'tovar':
				list = 'tovar';
			break;
			case 'zakaz':
				list = $("#"+$('.active').last().attr("id")+" #status").val();
			break;
		}
		var json = {func:'CEditCat', domain:JSCat.domain, token:JSCat.token};
		json["action"] = "addInExcel";
		json["list_id"] = list;
		json["select_value"] = select_value;
		json["data"] = data;				
		$.post("/json/", json, function(res) {
			var all = $('#addfromcsv').attr('data-all');
			var cur = $('#addfromcsv').attr('data-cur');
			var left = 	Math.ceil(cur/all*100);
			$('#addfromcsv').attr('data-cur',(cur-1));
			$('.num').text((100 - left)+'%');
			if (res) $(".status-bar > div").css("left", '-'+left+"%");
			if (cur == 0) {
				$(".status-bar").remove();
				$('.modal_content').append('<button class="closebtn">Готово</button>');
				$('.closebtn').click(function() {			
					$('.modal').remove();
				});
			}
		});							
	}	
							
	function CSVToArray( strData, strDelimiter ) {
		strDelimiter = (strDelimiter || ",");
		var objPattern = new RegExp((
				"(\\" + strDelimiter + "|\\r?\\n|\\r|^)" +
				"(?:\"([^\"]*(?:\"\"[^\"]*)*)\"|" +
				"([^\"\\" + strDelimiter + "\\r\\n]*))"
			), "gi");
		var arrData = [[]];
		var arrMatches = null;
		while (arrMatches = objPattern.exec( strData )) {
			var strMatchedDelimiter = arrMatches[ 1 ];
			if (strMatchedDelimiter.length && strMatchedDelimiter !== strDelimiter) {
				arrData.push( [] );
			}
			var strMatchedValue;
			if (arrMatches[2]) {
				strMatchedValue = arrMatches[ 2 ].replace(
					new RegExp( "\"\"", "g" ), "\""
				);
			} else {
				strMatchedValue = arrMatches[ 3 ];
			}
			arrData[ arrData.length - 1 ].push( strMatchedValue );
		}
		return( arrData );
	}

</script>