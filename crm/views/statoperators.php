<?php namespace lib;
	if (!in_array('tech', $RoleUser) && !in_array('tech', $RoleGroup)) die();	
?>
<style>

#cabinet .chart div > span {
    width: auto;
}	
	div#tabs {display: flex;height: 40px;justify-content: space-between;margin-bottom: 25px;}
	div#tabs label {margin: 0!important;}
	table#chart6 td, table#chart6 th {padding: 6px;}
	div#tabs [type="date"] {padding: 0 10px;}select#useGroup {
    padding: 10px;
    font-size: 14px;
    font-family: arial;
    margin-right: 1px;
}
</style>

<div id="top">
	<h1>Статистика по операторам
		<i class="radios little" style="float: right;">
			<label class="active"><input type="radio" name="radios" radios="operators">По операторам</label>
			<label><input type="radio" name="radios" radios="general">По пользователям</label>
		</i>
		<i>Статистика и воронка продаж</i>
   </h1>
</div>

<div id="tabs" class="little">
	<span style="padding:9px">Период: </span>
	<select id="useGroup">
		<option value="cpa-sale">cpa-sale</option>
		<option value="krossi">krossi</option>
		<option value="tel">tel</option>
		<option value="tel-2">tel-2</option>
		<option value="topsale">topsale</option>
		<option value="Boris1">Boris1</option>
		<option value="cpa-crm">cpa-crm</option>
		<option value="cpa-crm2">cpa-crm2</option>
		<option value="export">export</option>
		<option value="fb">fb</option>
		<option value="fb-2">fb-2</option>
		<option value="fun">fun</option>
		<option value="fun-2">fun-2</option>
		<option value="kz-main">kz-main</option>
		<option value="low-price">low-price</option>
		<option value="lt">lt</option>
		<option value="msk-1">msk-1</option>
	</select><select id="operatorGroup" style="width: 330px"><option value="0">Все операторы</option></select>
	<input in type="date"/>
	<input out type="date"/>
	<button id="back" style="height:38px;margin-top:1px">Показать</button>
	<span style="flex:2"></span>
</div>
<div id="charts"></div>
<script type="text/javascript" src="/js/chart.js"></script>







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
			statoperators:		'statoperators',
			operators:			'operators',
			general:				'general',
			table:				'table',
			graph:				'graph'
		}
	},
	builder:   function() {
		var menu = {
			statoperators: 'Личная по меткам'
		}
		
		$('#top label, #tabs label').click(function() {
			var item = $(this);
			item.parent().parent().find('label.active').removeClass('active');
			item.addClass('active');
		});
		var today = new Date()
		$('[type="date"][out]').val(new Date().toISOString().substr(0, 10))
		apanel.actions();
	},	
	template: {
        statoperators: ['Аналитика','Детальная статистика и воронка продаж']
	},				
	actions:   function() {
    	$('[radios="' + apanel.cfg.selectors.operators +'"]').click(apanel.statoperators.start.bind(this))
    	$('[radios="' + apanel.cfg.selectors.general +'"]').click(apanel.analyticsall.start.bind(this))
    	$('#back').click(apanel.back.start.bind(this))
    	apanel.statoperators.start()
	},
	back: {
		start:   function() {
			console.log('back')
			apanel.back.query()
		},
		query: function() {
			//статистика по конверсиям
			var json = {func:'CStat', domain:JSCat.domain, token:JSCat.token};
			json.action = 'back';
			json.one = Math.round(+ new Date($('[type="date"][in]').val()) / 1000)
			json.two = Math.round(+ new Date($('[type="date"][out]').val()) / 1000)
			$.post("/json/", json, function(a) {
				if (typeof a !== 'object') a = JSON.parse(a)
				apanel.statoperators.table(a)
			});
		}
	},
	statoperators: {
		start: function() {
			$('#tabs').show()
			console.log('statoperators')
			$( '#charts').empty().append('<div class="charts"><table id="chart6" border="0" style="width: 100%;"></table></div>')
			var ops = JSCat.operators;
			for (op in ops) $('#operatorGroup').append('<option value="'+ ops[op].id +'">'+ ops[op].name +'</option>')
			
			$('#useGroup').val('cpa-sale').change(apanel.statoperators.select.bind(this))
			$('#operatorGroup').val('0').change(apanel.statoperators.select.bind(this))
			apanel.statoperators.select()
		},
		table: function(a) {
			$( '#chart6').empty()
			apanel.statoperators.thead()
			if (a) {
				for (var b in a) {
					if (a[b].count != '0') $("#chart6").append('<tr role="row">\
						<td>'+ a[b].operator +'</td>\
						<td>'+ a[b].leads +'</td>\
						<td>'+ a[b].approve1 +'</td>\
						<td>'+ a[b].approve2 +'</td>\
						<td>'+ a[b].middleUp +'</td>\
						<td>'+ a[b].checkrate+'</td>\
						<td>'+ a[b].summUp +'</td>\
						<td>'+ a[b].buyout +'</td>\
						<td>'+ a[b].middleBuyout +'</td>\
						<td>'+ a[b].summBuyout +'</td>\
						<td>'+ a[b].cancel +'</td>\
						<td>'+ a[b].calls +'</td>\
						<td>'+ a[b].timeCalls +'</td>\
						<td>'+ a[b].middleCalls +'</td>\
					</tr>\</div>');
				}
			} else {
				$("#chart6").append('<tr role="row">\
					<td colspan="20" align="center" style="padding: 100px;">Нет данных</td>\
				</tr>\</div>');
			}
			apanel.statoperators.thead()
		},
		thead: function() {//Выкуплено на сумму	Отмены	Совершено звонков	Длительность звонков	Ср. время обработки заказа
			$('#chart6').append('<thead style="font-size: 12px">\
				<tr role="row">\
					<th style="vertical-align: middle;">Оператор</th>\
					<th style="text-align: center;color: #3e3e3e;background: #DFF0D8;">Обработано лидов</th>\
					<th style="text-align: center;color: #3e3e3e;background: #dcdcdc;">Апрув 1</th>\
					<th style="text-align: center;color: #3e3e3e;background: #f28485;">Апрув 2</th>\
					<th style="text-align: center;color: #3e3e3e;background: #f2bebe;">Ср. чек (Принято)</th>\
					<th style="text-align: center;color: #3e3e3e;background: #F2DEDE;">Коэфф. роста чека</th>\
					<th style="text-align: center;color: #3e3e3e;background: #FAF2CC;">Принято на сумму</th>\
					<th style="text-align: center;color: #3e3e3e;background: #DFF0D8;">Выкуп</th>\
					<th style="text-align: center;color: #3e3e3e;background: #dcdcdc;">Ср. чек (Выкуп)</th>\
					<th style="text-align: center;color: #3e3e3e;background: #f28485;">Выкуплено на сумму</th>\
					<th style="text-align: center;color: #3e3e3e;background: #f2bebe;">Отмены</th>\
					<th style="text-align: center;color: #3e3e3e;background: #F2DEDE;">Совершено звонков</th>\
					<th style="text-align: center;color: #3e3e3e;background: #FAF2CC;">Длительность звонков</th>\
					<th style="text-align: center;color: #3e3e3e;background: #DFF0D8;">Ср. время обработки заказа</th>\
				</tr>\
			</thead>')				
		},
		select: function() {
			//статистика по конверсиям
			var json = {func:'CStat', domain:JSCat.domain, token:JSCat.token};
			json["action"] = "statoperators";
			$.post("/json/", json, function(a) {
				//if (typeof a !== 'object') a = JSON.parse(a)
				apanel.statoperators.table(a)
			});
		}
	},
	analyticsall: {
		start:   function() {
			$('#charts, #tabs').hide()
			$( '#charts').empty().append('<div class="charts"><div id="chart3"></div><div id="chart4" class="chart"></div><div id="chart5" class="chart"></div></div>')
			//последние 10 зарегистрированных
			var json = {func:'CStat', domain:JSCat.domain, token:JSCat.token};
			json["action"] 		= "call_ten_registr";
			$.post("/json/", json, function(a){
				if (typeof a !== 'object') a = JSON.parse(a);
				$('#chart5').append('<h3>Последние зарегистрированные</h3>');
				for (var b in a) {
					var randomColor = "#" + Math.random().toString(16).slice(2, 8);
						$("#chart5").append('<div><span><u style="background:' + randomColor + '"></u>' + a[b].username + '</span><span>' + a[b].name + '</span>\
											<span>' + apanel.timeConverter(a[b].registerDate) + '</span></div>');
				}
			});
			//последние 10 авторизованных
			var json = {func:'CStat', domain:JSCat.domain, token:JSCat.token};
			json["action"] 		= "call_ten_authorize";
			$.post("/json/", json, function(a){
				if (typeof a !== 'object') a = JSON.parse(a);
				$('#chart4').append('<h3>Последние авторизованные</h3>');
				for (var b in a) {
					var time = a[b].time;
					time = apanel.timeConverter(time);
					var randomColor = "#" + Math.random().toString(16).slice(2, 8);
						$("#chart4").append('<div><span><u style="background:' + randomColor + '"></u>' + a[b].name + '</span><span>' + a[b].username + '</span><span>' + time + '</span></div>');
				}
			});
			//количество пользователей по группам
			var json = {func:'CStat', domain:JSCat.domain, token:JSCat.token};
			json["action"] 		= "call_count";
			$.post("/json/", json, function(result) {
				if (typeof result !== 'object') result = JSON.parse(result);
	
				var users = '<div><strong>'+ (Math.floor(result.one)) + ((Math.floor(result.today) > 0) ? '<span style ="color: green;" >+ ' + result.today + '</span>' : '') +'</strong><span>Администратор</span></div>';
				if (Math.floor(result.two) > 0) users += '<div><strong>'+ result.two +'</strong><span>Approve</span></div>';
				if (Math.floor(result.three) > 0) users+=	'<div><strong>'+ result.three +'</strong><span>Дожим</span></div>';
				if (Math.floor(result.four) > 0) users+=	'<div><strong>'+ result.four +'</strong><span>Руководитель</span></div>';
				if (Math.floor(result.six) > 0) users+=	'<div><strong>'+ result.six +'</strong><span>Менеджер</span></div>';
				if (Math.floor(result.seven) > 0) users+=	'<div><strong>'+ result.seven +'</strong><span>Финансист</span></div>';
				if (Math.floor(result.eight) > 0) users+=	'<div><strong>'+ result.eight +'</strong><span>Технический специалист</span></div>';
				
				$('#chart3').append(users);
			});
			setTimeout(() => {$('#charts').fadeIn()}, 500)

		},
		query: function() {
			//статистика по конверсиям
			var json = {func:'CStat', domain:JSCat.domain, token:JSCat.token};
			json.action = 'analyticsall';
			json.one = Math.round(+new Date($('[type="date"][in]').val()) / 1000)
			json.two = Math.round(+new Date($('[type="date"][out]').val()) / 1000)
			$.post("/json/", json, function(a) {
				if (typeof a !== 'object') a = JSON.parse(a)
				return a
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
	},
	timeConverter: function(UNIX_timestamp) {
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
}

$(function() {
	apanel = new apanel();
	apanel.builder()
});


</script>









