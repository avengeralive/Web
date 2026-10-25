<?php namespace lib;
	if (!defined('VOCU_FWK')) die();
	if (!in_array('goods', $RoleUser) && !in_array('goods', $RoleGroup)) die();	
?>

<div id="top">
	<h1>Товары
		<i class="radios little" style="float: right;">
			<input class="btn btn-primary doublecheck" item="0" list="22" type="submit" value="Проверка на дубли">
			<input class="btn btn-primary add" item="0" list="22" type="submit" value="Добавить товар">
			<input class="btn btn-primary add" item="0" list="21" type="submit" value="Добавить категорию">
		</i>
    	<i>Товары по категориям</i>
   </h1>
</div>
<div id="contents-add"></div>


<ul class="nav nav-tabs">
	<li class="active"><a data-toggle="tab" href="#container-1" aria-expanded="true">Товары</a></li>
<!-- 
	<li><a data-toggle="tab" href="#container-2">Категории</a></li>
 -->
</ul>

<div class="tab-content" id="list2" style="padding-top: 6px;">	
<!-- 
	<div id="container-2" class="tab-pane fade">
		<div class="call crmls" list="21" status="all" user="all" count="50" pagination="true" template="10"></div>
		<div paginator></div>
	</div>
 -->
	<div id="container-1" class="tab-pane fade in active">
		<div id="sorter">
			<input data-sorter="text" type="text" data-sort="like" placeholder="Поиск по тексту"/>
			<select data-sorter="price">
				<option data-sort="new">Новые</option>
				<option data-sort="bot">Дешевле</option>
				<option data-sort="top">Дороже</option>
			</select>
		</div>
		<div searcher="" class="call crmls" list="22" status="all" user="all" count="50" pagination="true" template="10"></div>
		<div paginator></div>
	</div>
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
		ads: function() {
			if (JSCat.category != null) {
				$('#contents-add, #search_content').empty();
				$('#list2').empty().append('<div searcher class="call crmls" list="22" status="1" user="all" count="25" pagination="true" template="10"></div><div paginator></div>');
				renderer.process.calls();
				return false;
				return false;
			}
		}
}
 
$(function() {
	objects = new objects();
	objects.start();
});

$("input.doublecheck").on("click", function(){
	$('[paginator]').empty();
	// console.log('Hello');
			renderer.draw.onReady(renderer.cfg.selectors.calls, function() {
				$(renderer.cfg.selectors.calls).map(function() {
					var $calls_root = $(this).empty();
					$calls_root.data('processed', true);
					if(!localStorage.price) localStorage.setItem('price','new');
					if(!localStorage.usertype) localStorage.setItem('usertype','all');
					if (typeof($calls_root.attr('user')) != 'undefined') {

						var my_list_id 		= $calls_root.attr('list') || '0';
						var user_id 			= $calls_root.attr('user') || '';
						if ( localStorage.search ) search += localStorage.search;
						renderer.get.query({
							func: 'CEditCat',
							action: 'doubleCheck',
							post: {
								list: my_list_id	
							},
							callback: function() {
								var search_goods = this;
								var offset = '0';
								// var pagination 		= $calls_root.attr('pagination'); //пагинация
								// var pagination 			= false;
								var region 				= $calls_root.attr('region') || '0';
								var my_list_id 			= $calls_root.attr('list') || '0';
								var user_id 			= $calls_root.attr('user') || '';
								var order_by 			= 'goods';
								var status 				= $calls_root.attr('status') || 'all';
								var item_id 			= $calls_root.attr('item') || false;
								// var count 				= $calls_root.attr('count'); //количество карточек на странице
								var count 				= 1000;
								var search = '';
								if ( localStorage.search ) search += localStorage.search;
								renderer.get.query({
									func: 'CEditCat',
									action: 'listing',
									post: {
										method: 'get',
										offset: offset,
										region: region,
										// pagination: pagination,
										list_id: my_list_id,
										text: '',
										search: search,
										search_goods: search_goods,
										order_by: order_by,
										page: window.location.search.substr(1).split('&')[0],
										status: status,
										raions: localStorage.raions,
										price: localStorage.price,
										usertype: localStorage.usertype,
										user_id: user_id,
										item_id: item_id,
										count: count
									},
									callback: function() {
										var json = this;
										if (json.status == 'good') {
											renderer.get.listIfUndefined({
												list_id: my_list_id
											}, function(list) {
												renderer.process.showCardsList(json, list, $calls_root);
												localStorage.setItem('countall', json.count)
											});
										}
									}
								});
							}
						});
					}
				});
			});
});
</script>
