<?php namespace lib;
	if (!in_array('admin', $RoleUser) && !in_array('admin', $RoleGroup)) die();

// select b.webmasterId from (select referrer, webmasterId from list20 union all select referrer, webmasterId from list15) as b group by webmasterId;
// select a.referrer from (select referrer, webmasterId from list20 union all select referrer, webmasterId from list15) as a group by referrer;

//все пользователи
// $referrers = [];
// $ref = JBase::Query('select a.referrer from (select referrer, webmasterId from list18 group by referrer union all select referrer, webmasterId from list19 group by referrer union all select referrer, webmasterId from list20 group by referrer union all select referrer, webmasterId from list15 group by referrer) as a group by referrer');
// if ($ref) {
// 	while($rf = $ref->fetch_assoc()) {
// 		$referrers[] = $rf;
// 	}
// }
// 
// //все команды
// $commands = [];
// $comm = JBase::Query('select b.webmasterId from (select referrer, webmasterId from list19 group by webmasterId union all select referrer, webmasterId from list18 group by webmasterId union all select referrer, webmasterId from list20 group by webmasterId union all select referrer, webmasterId from list15 group by webmasterId) as b group by webmasterId');
// if ($comm) {
// 	while($com = $comm->fetch_assoc()) {
// 		$commands[] = $com;
// 	}
// }
	


	//оттенки 
	$css = [];
	$colors = JBase::get_Data('colors', ['alias','name','hash'], ['on' => 1]);
	if ($colors) {
		while($csss = $colors->fetch_assoc()) {
			$css[$csss['name']] = [$csss['alias'] => $csss['hash']];
		}
		
		echo '<style>:root {';	
			$scss = '';
			foreach ($css as $key => $value) {
				$scss .= '--'. $key .': '. array_values($value)[0] .';';
			}
			echo $scss;
		echo '}
		/*
			--color1 40%
			--color2 50%
			--color3 60%
			--color4 70%
			--color5 80%
			--color6 90%
			--color7 100%
		*/</style>';
	}
	


	//echo json_encode($css);

	//пользователи
	$users = [];
	$my_users = JBase::get_Data('my_users', ['id','name'], ['status'=>'1']);
	if ($my_users) {
		while($user = $my_users->fetch_assoc()) {
			$users[$user['id']] = $user['name'];
		}
	}
	
	//Категории товаров
	$list21 = [];
	$list21s = JBase::get_Data('list21', ['id','name'], ['status'=>'1']);
	if ($list21s) {
		while($list = $list21s->fetch_assoc()) {
			$list21[$list['id']] = $list['name'];
		}
	}
	
	//Товары
	$list22 = [];
	$list22s = JBase::get_Data('list22', ['id','name'], ['status'=>'1']);
	if ($list22s) {
		while($list = $list22s->fetch_assoc()) {
			$list22[$list['id']] = $list['name'];
		}
	}
	//вебмастеры
	$listT = [];
	
	$listTs = JBase::Query("select distinct webmasterId, referrer FROM ( select webmasterId, referrer from list18 AS apr where webmasterId <> '' AND referrer <> '' UNION ALL select webmasterId, referrer from list19 AS sent where webmasterId <> '' AND referrer <> '' UNION ALL select webmasterId, referrer from list15 AS back where webmasterId <> '' AND referrer <> '' UNION ALL select webmasterId, referrer from list20 AS paid where webmasterId <> '' AND referrer <> '' ) as T");
	if ($listTs) {
		while($list = $listTs->fetch_assoc()) {
			$list['referrer'] = str_replace('http://','',$list['referrer']);
			$listT[$list['referrer']] = $list['webmasterId'];
		}
	}
	$listT['referrer_not_specified'] = 'def';
	$list21[0] = 'Без категории';
	
	$list39 = [];
// 	$list39s = JBase::get_Data('list39', ['id','name','command'], ['status'=>'1']);
// 	if ($list39s) {
// 		while($list = $list39s->fetch_assoc()) {
// 			$list39['id'][$list['id']] = $list['name'];
// 			$list39[$list['id']] = $list['command'];
// 		}
// 	}
// 	$list39['id']['webmasterId_not_specified'] = 'Отсутствует';
// 	$list39['command']['webmasterId_not_specified'] = 'def';
	
	//команды вебмастеров
	$list38 = [];
	$list38s = JBase::get_Data('list38', ['id','name'], ['status'=>'1']);
	if ($list38s) {
		while($list = $list38s->fetch_assoc()) {
			$list38[$list['id']]  = $list['name'];
			
		}
	}
	$list38['def']  = 'No_team';
	//$list38[18] = 'apilid';
	
	
	
	
// 		$api = [
// 			'tel-2' => '1234567',//6000//710k
// 			'tel' => '1234567',//24000//720k
// 			'topsale' => '1234567',//40100//750k
// 			'cpa-sale' => '12345678910',//30900//800k
// 			'fb-2' => '413439610',//15000//900k
// 			'fb' => '413439610',//35030//850k
// 			'cpa-crm2' => '123654789',//4000//920k
// 			'cpa-crm' => '12345678910',//4000//930k-
// 			'boris1' => '0dd4f3cfa6f5d5c25f6386b6a189494a',//5000//700k ++ 	referrer/webmasterId
// 			'krossi' => '1234567',//25600//600k
// 			'fun-2' => '9SUx2s5hqwXZdSEvAbOj',//119100//200к
// 			'fun' => '12345678910'//166010//400k
// 		];
		
		
		
?>
<style>
[page="instat"] #list {
    text-align: left;
    display: flex;
    width: 100%;
    justify-content: space-between;
}
[page="instat"] #list > div {
    flex: 1;
    margin-left: -1px;
    min-height: 34px;
    padding: 7px;
}
#cabinet .little label.active {
    outline: none;
}

#cabinet .little label {
    flex: 1;
    white-space: nowrap;
    outline: 1px #ffffff solid;
    outline-offset: -7px;
    cursor: pointer;
    transition: .3s;
}
#cabinet #top h1 i {
    display: flex;
    justify-content: space-between;
}

div#tabs {display: flex;height: 40px;justify-content: space-between;margin-bottom: 25px;}
div#tabs label {margin: 0!important;}
table#chart6 td, table#chart6 th {padding: 6px;
    border-bottom: 1px #e2e0e0 solid;}
div#tabs [type="date"] {padding: 0 10px;}
select#useGroup {
    padding: 10px;
    font-size: 14px;
    font-family: arial;}
table#chart6 td, table#chart6 th {padding: 5px;
    box-shadow: 1px 1px 0 #e2e0e0;
    border-left: 1px #e2e0e0 solid;
    max-width: 400px;
    overflow: hidden;
    text-overflow: ellipsis;}
    tr.hddn {
    position: absolute;
    left: -10000px;
}
tr.tr1 td.lb:before {
    background: #f28385;
}
[page="instat"] [type="color"] {
    float: right;
}
tr.tr2 td.lb:before {
    background: #83bd7f;
}

tr.tr3 td.lb:before {
    background: #faf2cc;
}
button#button {
    background: #648ab0;
    color: white;
}
 td.lb:before {
    content: "";
    width: 5px;
    height: 5px;
    background: #868686;
    display: inline-block;
    border-radius: 10px;
    margin: 0 5px 0 -3px;
    vertical-align: middle;
}
tr.tr0 td.lb {padding-left: 10px!important;}
tr.tr1 td.lb {padding-left: 35px!important;}
tr.tr2 td.lb {padding-left: 60px!important;}
tr.tr3 td.lb {padding-left: 85px!important;}
tr.tr0 {background: #fbfbfb;}
tr.tr1 {background: #f1f1f1;}
tr.tr2 {background: #e6e6e6;}
tr.tr3 {background: #d2d2d2;}
i[time] {
    font-size: 9px;
    display: block;
    line-height: 6px;
    font-style: normal;
    color: #777;
}
select#select {
    font-size: 14px;
    font-weight: normal;
    padding: 0 20px;
    height: 38px;
    vertical-align: top;
    color: #616161;
}

i.radios.little {
    filter: brightness(0.93);
}

#cabinet .little label:hover {
    outline-offset: 10px;
    outline-color: rgba(255, 255, 255, 0);
}
</style>

<div id="top">
	<h1>Статистика по пользователям 
		<i>Статистика и воронка продаж</i>
    <br>
<!-- 
    <i class="radios little">
			<label class="period active"><input type="radio" name="radios" r-type = "d"radios="30">За последние 30 дней</label>
			<label class="period"><input type="radio" name="radios"  r-type = "d"radios="60">За последние 60 дней</label>
			<label class="period"><input type="radio" name="radios"  r-type = "w"radios="0">Текущая неделя</label>
			<label class="period"><input type="radio" name="radios" r-type = "w"radios="1">-1 неделя</label>
			<label class="period"><input type="radio" name="radios" r-type = "w"radios="2">-2 неделя</label>
			<label class="period"><input type="radio" name="radios" r-type = "w"radios="3">-3 неделя</label>
			<label class="period"><input type="radio" name="radios" r-type = "w"radios="4">-4 неделя</label>
			<label class="period"><input type="radio" name="radios" r-type = "w"radios="5">-5 неделя</label>
			<label class="period"><input type="radio" name="radios" r-type = "w"radios="6">-6 неделя</label>
			<label class="period"><input type="radio" name="radios" r-type = "w"radios="7">-7 неделя</label>
		</i><hr style="margin: 0px;">
 -->
    <i class="proj little"><select id="select"></select>
			<label class="proj active"><input type="radio" name="proj" in="710000" out="720000" proj="tel">tel-2</label>
			<label class="proj"><input type="radio" name="proj" in="720000" out="750000" proj="tel">tel</label>
			<label class="proj"><input type="radio" name="proj" proj="topsale">topsale</label>
			<label class="proj"><input type="radio" name="proj" proj="cpa-sale">cpa-sale</label>
			<label class="proj"><input type="radio" name="proj" proj="fb-2">fb-2</label>
			<label class="proj"><input type="radio" name="proj" proj="fb">fb</label>
			<label class="proj"><input type="radio" name="proj" proj="cpa-crm2">cpa-crm2</label>
			<label class="proj"><input type="radio" name="proj" proj="cpa-crm">cpa-crm</label>
			<label class="proj"><input type="radio" name="proj" proj="boris1">boris1</label>
			<label class="proj"><input type="radio" name="proj" proj="krossi">krossi</label>
			<label class="proj"><input type="radio" name="proj" in="200000" out="400000" proj="fun">fun-2</label>
			<label class="proj"><input type="radio" name="proj" in="400000" out="600000" proj="fun">fun</label>
			<button id="button">Показать результаты</button>
		</i>
   </h1>
</div>

<!-- 
<div id="tabs" class="little">
	<span style="padding:9px">Период: </span>
	<input in type="date"/>
	<input out type="date"/>
	<button id="back" style="height:38px;margin-top:1px">Показать</button>
	<span style="flex:2"></span>
	<label class="active"><input type="radio" name="filter" filter="table">Таблица</label>
	<label><input type="radio" name="filter" filter="graph">График</label>
</div>
 -->
<div id="charts"></div>
<div id="list"></div>
<!-- 
<script type="text/javascript" src="/js/chart.js"></script>
 -->
 

<script>
	var colors = {
		"color1": "40%",
		"color2": "50%",
		"color3": "60%",
		"color4": "70%",
		"color5": "80%",
		"color6": "90%",
		"color7": "100%"
	}
			
	setTimeout(() => {
		var face = <?php echo json_encode($css); ?>;
		for (var b in face) {
			var key = Object.keys(face[b]);
			$('#list').append('<div><strong>' + colors[b] + '</strong><span><input type="color" id="'+ b +'" value="'+ face[b][key] +'"></span></div>');
			$('#' + b).click(get_source.bind(this, b, $('#' + b)[0])).click();
		}
		function update(name, param) {
			var json = {func:'CPanel', domain:JSCat.domain, token:JSCat.token};
			json["action"] = 'colors';
			json["params"] = [name, param];
			$.post("/json/", json, function() {});
		}
		function get_source(b, source) {
			var picker = new CP(source);
			source.onclick = function(e) {
				e.preventDefault();
			}
			picker.on("stop", function(color) {
				this.source.value = '#' + color;
				update(b, '#' + color);
				return false;
			});
		}
	}, 2000);
</script>
<script type="text/javascript" src="/js/colorpicker.js"></script>
<script>


	
function apanel(params) {
	$.extend(this.options, params);
}

apanel.prototype = {
   build: '1.0',
   cfg: {
		url: {
			querystat: 		'CStat'
		},
		selectors:	{
			analyticsutm:		'analyticsutm',
			table:				'table',
			graph:				'graph'
		}
	},
	builder:   function() {
		console.log('build')
		var menu = {
			analyticsutm: 'По меткам'
		}
		$('.proj .proj').unbind().change(function() {
			var item = $(this);
			$('.proj.little').find('label.active').removeClass('active');
			item.addClass('active');
		});
		var today = new Date()
		$('[type="date"][out]').val(new Date().toISOString().substr(0, 10))
		apanel.actions();
	},	
	template: {
        analyticsutm:		['Аналитика','Детальная статистика и воронка продаж']
	},				
	actions:   function() {
    	apanel.analyticsutm.start()
	},
	analyticsutm: {
		start:   function() {
			$('#tabs').hide()
			$('#charts').empty().append('<div class="charts"><table id="chart6" border="0" style="width: 100%;"></table></div>')
				
			apanel.analyticsutm.thead()
			apanel.analyticsutm.calend()	
			apanel.analyticsutm.thead()		
		},
		calend:   function() {
			
			$('#select')
				.append('<option value="60" r_type="d">За последние 60 дней</option><option value="30" r_type="d">За последние 30 дней</option><option value="0" r_type="w">Текущая неделя</option>')
				.val('0')
				//.change(() => {apanel.analyticsutm.select()})
				//.change()
				
			$('#button')
				.click(() => {apanel.analyticsutm.select()})
				.click()
				
			

			var d = new Date(), b = [], 
			weekday = ['Вс','Пн','Вт','Ср','Чт','Пт','Сб'], 
			months = ['Янв','Фев','Мар','Апр','Май','Июн','Июл','Авг','Сен','Окт','Ноя','Дек'],
			weeknow = apanel.analyticsutm.getWeekNumber(new Date())[1];
				
			for (var i = 1, l = new Date(d.getFullYear(), d.getMonth(), 0).getDate(); i < l; i++) {
				var d = new Date(d.getFullYear(),  d.getMonth() - 1, i)
				b.push(i +"."+ weekday[d.getDay()])
			}
			
			var d = new Date()
			for (var i = weeknow; i > 0; i--) {
				var w = new Date(Date.UTC(d.getFullYear(), d.getMonth(), d.getDate()))
				d = new Date(Date.UTC(d.getFullYear(), d.getMonth(), d.getDate() - 7))
				var w = new Date(Date.UTC(d.getFullYear(), d.getMonth(), d.getDate() + 7))
				var m = months[w.getMonth()];
				
				b.push(i +"."+ m)
				console.log(i +"."+ weeknow)
				
				$('#select').append('<option value="'+ parseInt(weeknow - i) +'" r_type="w" day="'+ d.getDate() +'" month="'+ d.getMonth() +'" year="'+ d.getFullYear() +'">С '+ d.getDate() +' '+ months[d.getMonth()] +' по '+ w.getDate() +' '+ m +'</option>')
			}
		},
		getWeekNumber: function(d) {
			d = new Date(Date.UTC(d.getFullYear(), d.getMonth(), d.getDate()));
			d.setUTCDate(d.getUTCDate() + 4 - (d.getUTCDay()||7));
			var yearStart = new Date(Date.UTC(d.getUTCFullYear(),0,1));
			var weekNo = Math.ceil(( ( (d - yearStart) / 86400000) + 1)/7);
			return [d.getUTCFullYear(), weekNo];
		},
		table: function(a) {
		
			var colors = {
				"40": 'var(--color1)',
				"50": 'var(--color2)',
				"60": 'var(--color3)',
				"70": 'var(--color4)',
				"80": 'var(--color5)',
				"90": 'var(--color6)',
				"100": 'var(--color7)'
			}
			
			
			
			$( '#chart6').empty()
			apanel.analyticsutm.thead()
			var refs = <?=json_encode($referrers, JSON_UNESCAPED_UNICODE)?>; //
			var usrs = <?=json_encode($users, JSON_UNESCAPED_UNICODE)?>; //
			var catg = <?=json_encode($list21, JSON_UNESCAPED_UNICODE)?>; //
			var good = <?=json_encode($list22, JSON_UNESCAPED_UNICODE)?>; //
			var web = <?=json_encode($listT, JSON_UNESCAPED_UNICODE)?>; //
			var webteam = <?=json_encode($list38, JSON_UNESCAPED_UNICODE)?>; //
			
			if (a) {
				var allcount = [];
				var timed = '<i time>За все время</i>';
				var tmp= 0;
				var tmpp = 0;
				//категории товаров
				for (var b in a) {
					
					
					//14 - Ошибка/Спам/Дубль
					//15 - Возврат
					//16 - Отменен
					//17 - Обработка
					//18 - Принят
					//19 - Отправлен
					//20 - Оплачен
								
					if ( a[b].label != null) {
					
						tmp = ((typeof a[b].list20_count !== 'undefined' )? parseInt(a[b].list20_count) : 0);
						tmpp = ((typeof a[b].list15_count !== 'undefined' )? parseInt(a[b].list15_count) : 0);
						tmpp += ((typeof a[b].list19_count !== 'undefined' )? parseInt(a[b].list19_count) : 0); //отправлен
						tmpp += ((typeof a[b].list18_count !== 'undefined' )? parseInt(a[b].list18_count) : 0); //принят
						tmpp += tmp;
						//console.log(Math.floor((tmp / tmpp) * 100).toFixed(0))
						console.log()
						
						var hex = colors[((Math.round(((tmp / tmpp) * 100) / 10) * 10)< 40? 40: (Math.round(((tmp / tmpp) * 100) / 10)*10))];
						$("#chart6").append('<tbody  item="'+ a[b].label +'" source="first">\
							<tr class="tr0 " item="'+ a[b].label +'" source="first">\
								<td><i item="1" source="'+ a[b].label +'">+</i></td>\
								<td class="lb">'+ catg[a[b].label] +'</td>\
								<td class="'+a[b].label+'prc" style="background:'+ hex +'"><b>'+ ((tmp > 0 || tmpp > 0) ? Math.floor((tmp / tmpp) * 100).toFixed(0) : 0) +'%</b></td>\
								<td class="'+a[b].label+'apr"><b>'+ tmpp +'</b></td>\
								<td class="'+a[b].label+'vcp"><b>'+ tmp +'</b></td>\
								<td>'+ timed +'</td>\
							</tr>')
							
						for (var c in a[b]) {
							
							

							if (( c !='label') && (!c.includes('_count'))) {
							if ($('[item="'+ a[b][c].label+'"][source="'+ a[b].label +'"]').length == 0) {
							
								tmp = ((typeof a[b][c].list20_count !== 'undefined' )? parseInt(a[b][c].list20_count) : 0);
								tmpp = ((typeof a[b][c].list15_count !== 'undefined' )? parseInt(a[b][c].list15_count) : 0);
// 								отправлен
								tmpp += ((typeof a[b][c].list19_count !== 'undefined' )? parseInt(a[b][c].list19_count) : 0);
// 								принят
								tmpp += ((typeof a[b][c].list18_count !== 'undefined' )? parseInt(a[b][c].list18_count) : 0);
								tmpp +=tmp;
								//var hex = (0xff000000 + Math.floor((tmp / tmpp) * 100).toFixed(0).toString(16).toUpperCase());
								var hex = colors[((Math.round(((tmp / tmpp) * 100) / 10) * 10)< 40? 40: (Math.round(((tmp / tmpp) * 100) / 10)*10))];
												
								$('tbody[item="'+ a[b].label +'"][source="first"]').append('<tr class="tr1 hddn" item="'+ a[b][c].label+'" source="'+a[b].label+'">\
										<td><i item="2" source="'+a[b].label+a[b][c].label +'">+</i></td>\
										<td class="lb">'+ good[a[b][c].label] +'</td>\
										<td class="'+a[b].label+'-'+a[b][c].label+'prc" style="background:'+ hex +'"><b>'+ ((tmp > 0 || tmpp > 0) ? Math.floor((tmp / tmpp) * 100).toFixed(0) : 0) +'%</b></td>\
										<td class="'+a[b].label+'-'+a[b][c].label+'apr"><b>'+tmpp+'</b></td>\
										<td class="'+a[b].label+'-'+a[b][c].label+'vcp"><b>'+ tmp +'</b></td>\
										<td>'+ timed +'</td>\
									</tr>')
								}
								
								for (var d in a[b][c]) {
								
								
									
									if (( d !='label') && (!d.includes('_count'))) {
										
										//Количество апрувов
										//Количество выкупов
										//Процент выкупа
										//Обновлено
										
										if ($('[item="'+webteam[web[a[b][c][d].label]]+'"][source="'+a[b].label+a[b][c].label +'"]').length == 0) {
 
// console.log(web[a[b][c][d].label])
// console.log(a[b][c][d].label)
// console.log( webteam[web[a[b][c][d].label]])
// 											var floor = (Math.floor((c20 / (c20 + c15)) * 100).toFixed(0))
// 											var hex = (0xffb9b900 + Math.round(floor - 65)).toString(16).toUpperCase()
												$('.tr1[item="'+ a[b][c].label +'"][source="'+ a[b].label +'"]').after('<tr class="tr2 hddn" item="'+webteam[web[a[b][c][d].label]]+'" source="'+a[b].label+a[b][c].label +'">\
													<td><i item="3"  source="'+a[b].label+a[b][c].label + webteam[web[a[b][c][d].label]]+'">+</i></td>\
													<td class="lb">'+ webteam[web[a[b][c][d].label]] +'</td>\
													<td class="'+a[b].label+'-'+a[b][c].label+'-'+webteam[web[a[b][c][d].label]]+'prc"><b>0</b></td>\
													<td class="'+a[b].label+'-'+a[b][c].label+'-'+webteam[web[a[b][c][d].label]]+'tmpp"><b>0</b></td>\
													<td class="'+a[b].label+'-'+a[b][c].label+'-'+webteam[web[a[b][c][d].label]]+'tmp">0</td>\
													<td>'+ timed +'</td>\
												</tr>')
										}
								
										
										if ($('[item="'+a[b].label+'-'+ a[b][c][d].label+'"][source="'+a[b].label+a[b][c].label + webteam[web[a[b][c][d].label]] +'"]').length == 0) {
// 											if ($('[item="'+a[b].label+'-'+ a[b][c][d].label+'"][source="'+a[b].label+a[b][c].label +'"]').length == 0) {
											// var tmpprc = 0;
// 											var tmpapr = 0;
// 											
// 											tmpprc = parseInt($('.'+a[b].label+'-'+webteam[web['command'][a[b][c][d].label]]+'vcp').text());
// 											console.log(tmpprc);
// 											tmpprc +=  ((typeof a[b][c][d].list20_count !== 'undefined' )? parseInt(a[b][c][d].list20_count) : 0);
// 											console.log(tmpprc);
// 											
// 											$('.'+a[b].label+'-'+a[b].label+'-'+webteam[web['command'][a[b][c][d].label]]+'vcp').text(tmpprc);
// 
// 											tmpapr = parseInt($('.'+a[b].label+'-'+webteam[web['command'][a[b][c][d].label]]+'apr').text());
// 											tmpapr += tmpprc;
// 											tmpapr +=  ((typeof a[b][c][d].list15_count !== 'undefined')? parseInt(a[b][c][d].list15_count) : 0);
											
											//отправлен
											//tmpapr += ((typeof a[b][c][d].list19_count !== 'undefined' )? parseInt(a[b][d].list19_count) : 0);
											//принят
											//tmpapr += ((typeof a[b][c][d].list18_count !== 'undefined' )? parseInt(a[b][d].list18_count) : 0);
											
// 											$('.'+a[b].label+'-'+webteam[web['command'][a[b][c][d].label]]+'apr').text(tmpapr);
											
											
// 											$('.'+a[b].label+'-'+webteam[web['command'][a[b][c][d].label]]+'prc').text(((tmpprc > 0 || tmpapr > 0) ? Math.floor((tmpprc / tmpapr) * 100).toFixed(0) : 0) +'%');
											tmp = ((typeof a[b][c][d].list20_count !== 'undefined' )? parseInt(a[b][c][d].list20_count) : 0);
											tmpp = ((typeof a[b][c][d].list15_count !== 'undefined' )? parseInt(a[b][c][d].list15_count) : 0);
// 											отправлен
											tmpp += ((typeof a[b][c][d].list19_count !== 'undefined' )? parseInt(a[b][c][d].list19_count) : 0);
// 											принят
											tmpp += ((typeof a[b][c][d].list18_count !== 'undefined' )? parseInt(a[b][c][d].list18_count) : 0);
											tmpp +=tmp;
											//var hex = (0xffb9b900 + Math.floor((tmp / tmpp) * 100).toFixed(0).toString(16).toUpperCase());
											var hex = colors[((Math.round(((tmp / tmpp) * 100) / 10) * 10)< 40? 40: (Math.round(((tmp / tmpp) * 100) / 10)*10))];
											
											$('.tr2[item="'+webteam[web[a[b][c][d].label]]+'"][source="'+a[b].label+a[b][c].label +'"]').after('<tr class="tr3 hddn" item="'+ a[b][c][d].label+'" source="'+a[b].label+a[b][c].label + webteam[web[a[b][c][d].label]] +'">\
													<td><i item="4"  source="'+a[b].label+a[b][c].label + a[b][c][d].label +'">-</i></td>\
													<td class="lb">'+ a[b][c][d].label +'</td>\
													<td  style="background:'+ hex +'"><b>'+ ((tmp > 0 || tmpp > 0) ? Math.floor((tmp / tmpp) * 100).toFixed(0) : 0)  +'%</b></td>\
													<td><b>'+ tmpp +'</b></td>\
													<td><b>'+ tmp +'</b></td>\
													<td>'+ timed +'</td>\
												</tr>')
											
											allcount[''+a[b].label+'-'+a[b][c].label+'-'+webteam[web[a[b][c][d].label]]] =((typeof allcount[''+a[b].label+'-'+a[b][c].label+'-'+webteam[web[a[b][c][d].label]]] !== 'undefined' )? allcount[''+a[b].label+'-'+a[b][c].label+'-'+webteam[web[a[b][c][d].label]]] : []);
											allcount[''+a[b].label+'-'+a[b][c].label+'-'+webteam[web[a[b][c][d].label]]][0] =((typeof allcount[''+a[b].label+'-'+a[b][c].label+'-'+webteam[web[a[b][c][d].label]]][0] !== 'undefined' )? allcount[''+a[b].label+'-'+a[b][c].label+'-'+webteam[web[a[b][c][d].label]]][0] : 0);
											allcount[''+a[b].label+'-'+a[b][c].label+'-'+webteam[web[a[b][c][d].label]]][1] =((typeof allcount[''+a[b].label+'-'+a[b][c].label+'-'+webteam[web[a[b][c][d].label]]][1] !== 'undefined' )? allcount[''+a[b].label+'-'+a[b][c].label+'-'+webteam[web[a[b][c][d].label]]][1] : 0);
											
											allcount[''+a[b].label+'-'+a[b][c].label+'-'+webteam[web[a[b][c][d].label]]][1] += tmpp;
											allcount[''+a[b].label+'-'+a[b][c].label+'-'+webteam[web[a[b][c][d].label]]][0] += tmp;
											
										}
									}
								}
							}
						}
					}
				}
				for (a in allcount) {
					$('.'+ a +'tmpp').text(allcount[a][1]);
					$('.'+ a +'tmp').text(allcount[a][0]);
					$('.'+ a +'prc').text(((allcount[a][0] > 0 ||allcount[a][1] > 0) ? Math.floor((allcount[a][0] / allcount[a][1]) * 100).toFixed(0) : 0)  +'%').css('background',colors[((Math.round(((allcount[a][0] / allcount[a][1]) * 100) / 10) * 10) < 40) ? 40 : (Math.round(((allcount[a][0] / allcount[a][1]) * 100) / 10)*10)]);
					 //console.log(Math.round(((allcount[a][0] / allcount[a][1]) * 100) / 10)*10)
					
				}
				//свернуть/развернуть
				$('.tr0 i[source],.tr1 i[source],.tr2 i[source]').click(function() {
					var s = $(this).attr('source')
					var i = $(this).attr('item')
					var el = $(this).parent().parent();
					var elt = el.parent().attr('item');
					
					
						//console.log(s +'-'+i)
					if ($('#charts tr[source="'+ s +'"]').hasClass('hddn')) {
						$('#charts tr[source="'+ s +'"]').removeClass('hddn')
						$(this).css('transform','rotate(45deg)')
					} else {
						if (el.hasClass('tr0')){
							$('tbody[item = "'+elt+'"] tr1').addClass('hddn')
							$('tbody[item = "'+elt+'"] tr2').addClass('hddn')
							$('tbody[item = "'+elt+'"] tr3').addClass('hddn')
							$('.tr0 i[source],.tr1 i[source],.tr2 i[source]').css('transform','rotate(0deg)')
						}
						else
						if (el.hasClass('tr1')){
							$('tbody[item = "'+elt+'"] tr2').addClass('hddn')
							$('tbody[item = "'+elt+'"] tr3').addClass('hddn')
							$('.tr1 i[source],.tr2 i[source]').css('transform','rotate(0deg)')
						}else
						if (el.hasClass('tr2')){
							$('tbody[item = "'+elt+'"] tr3').addClass('hddn')
							$(this).css('transform','rotate(0deg)')
						}
						$('#charts tr[source^="'+ s +'"]').addClass('hddn')
						
					}
				})
				
			} else {
				$("#chart6").append('<tr role="row">\
					<td colspan="9" align="center" style="padding: 100px;">Недостаточно данных для построения отчета</td>\
				</tr>\</div>');
			}
			apanel.analyticsutm.thead()
		},
		thead: function() {
			
			$('#chart6').append('<thead style="font-size: 12px">\
				<tr role="row">\
					<th style="text-align: center;width: 40px; text-align: center;"></th>\
					<th style="vertical-align: middle; width:50%">Название</th>\
							<th>Процент выкупа</th>\
							<th>Количество апрувов</th>\
							<th>Количество выкупов</th>\
					<th>Обновлено</th>\
				</tr>\
			</thead>')				
		},
		select:   function() {
			$("#chart6").append('<tr role="row">\
					<td colspan="9" align="center" style="padding: 100px;">Загружаем заказы...</td>\
				</tr>\</div>')
			//статистика по конверсиям
			//in="400000" out="600000" proj="fun"
			console.log('sel');
			var json 		= {func:'CStat', domain:JSCat.domain, token:JSCat.token};
			json["action"] = "statusers";
			json["req"] 	= "utmstat";
			json["period"] = $('#select option:selected').attr('value');
			json["r_type"] = $('#select option:selected').attr('r_type');
			json["proj"] 	= $('.proj.active input').attr('proj');
			json["in"] 		= $('.proj.active input').attr('in');
			json["out"] 	= $('.proj.active input').attr('out');
			$.post("/json/", json, function(result) {
				if (typeof result !== 'object') result = JSON.parse(result)	
				console.log(result);
				apanel.analyticsutm.table(result)
				
				if (result == []) $("#chart6").append('<tr role="row">\
					<td colspan="9" align="center" style="padding: 100px;">Недостаточно данных для построения отчета</td>\
				</tr>\</div>')
				
			});
		}
	},
	optiongen: function(arr) {
		var text = '';
		for (a in arr)
			text += '<option value="'+ a +'">'+ arr[a] +'</option>';
		return text;
	},
	radiosgen: function(arr, name) {
		var text = '<span class="'+ name +' little">';
		for (a in arr)
			text += '<label><input type="radio" name="'+ name +'" radios="'+ a +'">'+ arr[a] +'</label>';
			text += '</span>';
		return text;
	},
	getRandomColor: function() {
		var letters = '0123456789ABCDEF'.split('');
		var color = '#';
		for (var i = 0; i < 6; i++ ) {
			color += letters[Math.floor(Math.random() * 16)];
		}
		return color;
	}
}

$(function() {
	apanel = new apanel();
	apanel.builder();
	
	
	
});






</script>






