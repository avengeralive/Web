<?php namespace lib;
	if (!defined('VOCU_FWK')) die();
	if (!in_array('goods', $RoleUser) && !in_array('goods', $RoleGroup)) die();	
?>

<div id="top">
	<h1>Товары
		<i class="radios little" style="float: right;">
	  		<label id="add" list="22" item="0" class="add" action="addf">Добавить</label>
		</i>
    	<i>Товары по категориям</i>
   </h1>
</div>
<div id="contents-add"></div>
<div id="sorter">
	<input data-sorter="text" type="text" data-sort="like" placeholder="Поиск по тексту"/>
	<select data-sorter="price">
		<option data-sort="new">Новые</option>
		<option data-sort="bot">Дешевле</option>
		<option data-sort="top">Дороже</option>
	</select>
</div>
<div id="list2">
	<div searcher class="call crmls" list="22" status="1" user="all" count="25" pagination="true" template="10" order_by="id"></div>
	<div paginator></div>
</div>

<button id="tocsv">Выгрузить список товаров</button>






<script>

localStorage.removeItem('order_by');
localStorage.removeItem('price');
function objects(params) {
	$.extend(this.options, params);
}

	objects.prototype = {
		start: function() {
					
			$('#tocsv').click(objects.tocsv.bind(this));
// 			$('[cabinet="cats"]').change(objects.ads.bind(this));
// 			$('.radios [name]').change(function() {
// 				$('.radios label').removeClass('active').find('[radios]:checked').parent().addClass('active');
// 				var status = $(this).attr('radios');
// 				localStorage.setItem('users', status);
// 				objects.ads();
// 			});
// 			setTimeout(() => {$('.radios [name]:first').click()}, 500);
// 	    	return false;
		},
		tocsv: function() {			
			var json = {func:'CPanel', domain:JSCat.domain, token:JSCat.token};
			json["action"] = "tocsv";
			$.post("/json/", json, function(result) {
				if (typeof result !== 'object') result = JSON.parse(result);
				objects.csv(result);
    		});
		},
		
		
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
 
$(function() {
	objects = new objects();
	objects.start();
});

</script>