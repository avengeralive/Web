<?php 
namespace lib;
	//if (!in_array('card', $RoleUser) && !in_array('card', $RoleGroup)) die();	
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
<!--<script type="text/javascript" src="/js/pbx.js"></script>-->

<div id="contents-add" style="position: absolute;width: 100%;z-index: 999;max-width: calc(100vw - 30px);top: -20px;"></div>

<script>
	var admin = "<?php if(in_array('searchstat', $RoleGroup)) echo 1 ?>";

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
		console.log('no search')
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
				 
				var arrs = el[1].match(/.{1,7}/g);
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

	function closePostIndex(data, value){
		var preload = $('#main_preload');
		var index = $('.postIndex');
		$.ajax({
        type: 'post',
        url: '/json/',
        data: {
            func: 'CPanel',
			action: 'Get_Data',
			postIndex: data
    	},
        beforeSend : function(){ 
            preload.show();
            preload.css({"display":"flex"})
        },
        complete : function(){ preload.hide() },
        success: function(data){
			if(data > 0){
				index.val(value);
				alert("Данное отделение почты не работает");
			}
		}
		});
	}
</script>