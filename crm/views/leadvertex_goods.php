<?php namespace lib;
	if (!defined('VOCU_FWK')) die();
	if (!in_array('tech', $RoleUser) && !in_array('tech', $RoleGroup)) die();	
?>

<div id="top">
	<h1>Товары		
		<i class="pull-right">
			<input class="btn btn-primary add" item="0" list="51" type="submit" value="Добавить товар">
			<input class="btn btn-primary doublecheck" type="submit" value="Проверка на дубли">
		</i>
		<i>Товары</i>
   </h1>
</div>
<input class="search_goods" type="text" style="height:30px;width:255px;" placeholder="Поиск"><br>
<div id="contents-add"></div>
<div id="list2">
	<div searcher="" class="call crmls" list="51" status="all" user="all" count="50" pagination="true" template="10"></div>
</div>
<div paginator></div>
<div id="detail"></div>

<script>
$('input.search_goods').keyup(function(){
	clearAllTimers();
	setTimeout(search, 3000);
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
								var searchLV = this;
								var offset = '0';
								var pagination 		= $calls_root.attr('pagination'); //пагинация
								var region 				= $calls_root.attr('region') || '0';
								var my_list_id 		= $calls_root.attr('list') || '0';
								var user_id 			= $calls_root.attr('user') || '';
								var order_by 			= 'leadvertex';
								var status 				= $calls_root.attr('status') || 'all';
								var item_id 			= $calls_root.attr('item') || false;
								var count 				= $calls_root.attr('count'); //количество карточек на странице
								var search = '';
								if ( localStorage.search ) search += localStorage.search;
								renderer.get.query({
									func: 'CEditCat',
									action: 'listing',
									post: {
										method: 'get',
										offset: offset,
										region: region,
										pagination: pagination,
										list_id: my_list_id,
										text: '',
										search: search,
										searchLV: searchLV,
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


function search(){
	var Value = $('input.search_goods').val();
	  var renderer = new renderer_cl();
	  $('[paginator]').empty();
	  renderer.draw.onReady(renderer.cfg.selectors.calls, function() {
				$(renderer.cfg.selectors.calls).map(function() {
					var $calls_root = $(this).empty();
					$calls_root.data('processed', true);
					if(!localStorage.price) localStorage.setItem('price','new');
					if(!localStorage.usertype) localStorage.setItem('usertype','all');
					if (typeof($calls_root.attr('user')) != 'undefined') {
						var offset = '0';
						var pagination 		= $calls_root.attr('pagination'); //пагинация
						var region 				= $calls_root.attr('region') || '0';
						var my_list_id 		= $calls_root.attr('list') || '0';
						var user_id 			= $calls_root.attr('user') || '';
						var order_by 			= $calls_root.attr('order_by') || '';
						var status 				= $calls_root.attr('status') || 'all';
						var item_id 			= $calls_root.attr('item') || false;
						var count 				= $calls_root.attr('count'); //количество карточек на странице
						var search = '';
						var searchLV = Value;
						if ( localStorage.search ) search += localStorage.search;
						if(Value !== ''){
							renderer.get.query({
							func: 'CEditCat',
							action: 'listing',
							post: {
								method: 'get',
								offset: offset,
								region: region,
								pagination: pagination,
								list_id: my_list_id,
								text: '',
								search: search,
								searchLV: searchLV,
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
						}else{
							renderer.get.query({
							func: 'CEditCat',
							action: 'listing',
							post: {
								method: 'get',
								offset: offset,
								region: region,
								pagination: pagination,
								list_id: my_list_id,
								text: '',
								search: search,
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
					}
				});
			});
}
var clearAllTimers = function(){
  var lastID = 0;
  return function(){
    var currentID = setTimeout(function(){}, 1);
    for(var id = currentID; id > lastID; id--){
      clearTimeout(id);
    };
    lastID = currentID;
  };
}();

</script>