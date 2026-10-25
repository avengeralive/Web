<?php namespace lib;
	if (!in_array('tech', $RoleUser) && !in_array('tech', $RoleGroup)) die();	
?>


<style>
	div#top label {margin: 0!important;}
	table#chart6 td, table#chart6 th {padding: 6px;}
	div#top [type="date"] {padding: 0 10px;
    font-size: 14px;
    font-family: arial;}select#useGroup {
    padding: 10px;
    font-size: 14px;
    font-family: arial;
}
</style>
<div id="top">
	<h1>Статистика по выкупаемости
		<i class="radios little" style="float: right;">
			<font style="padding:9px">Период: </font>
			<input in type="date"/>
			<input out type="date"/>
			<button id="back" style="height:38px;margin-top:1px">Показать</button>
		</i>
		<i>Статистика и воронка продаж</i>
   </h1>
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
			analyticsutm:		'analyticsutm',
			table:				'table',
			graph:				'graph'
		}
	},
	builder:   function() {
		var menu = {
			analyticsall: 'Общая по датам', 
			analyticsmy: 'Личная по датам', 
			analyticsutm: 'Личная по меткам'
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
        analyticsutm:		['Аналитика','Детальная статистика и воронка продаж']
	},				
	actions:   function() {
    	$('#back').click(apanel.back.start.bind(this))
    	apanel.analyticsutm.start()
	},
	back: {
		start:   function() {
			console.log('back')
			var a = apanel.back.query()
			apanel.analyticsutm.table(a)
		},
		query: function() {
			//статистика по конверсиям
			var json = {func:'CStat', domain:JSCat.domain, token:JSCat.token};
			json.action = 'period';
			json.one = Math.round(+new Date($('[type="date"][in]').val()) / 1000)
			json.two = Math.round(+new Date($('[type="date"][out]').val()) / 1000)
			$.post("/json/", json, function(a) {
				if (typeof a !== 'object') a = JSON.parse(a)
				return a
			});
		}
	},
	analyticsutm: {
		start:   function() {
			console.log('analyticsutm')
			$( '#charts').empty().append('<div class="charts">Группировка <select name="useGroup" id="useGroup">\
						<option value="0">Не группировать</option>\
						<option value="price">Группировать по цене</option>\
						<option value="webmaster">Группировать по вебмастерам</option>\
					</select><table id="chart6" border="0" style="width: 100%;"></table></div>')
			var a = apanel.analyticsutm.select()
			apanel.analyticsutm.table(a)
			$('#useGroup').val('0').change(apanel.analyticsutm.select.bind(this))
		},
		table: function(a) {
			$( '#chart6').empty()
			apanel.analyticsutm.thead()
			if (a) {
				for (var b in a) {
					if (a[b].count != '0') $("#chart6").append('<tr role="row">\
						<td>'+ a[b].time +'</td>\
						<td>'+ a[b].send +'</td>\
						<td>'+ a[b].pay +'</td>\
						<td>'+ a[b].middle +'</td>\
						<td>'+ a[b].ret +'</td>\
						<td>'+ a[b].delivery +'</td>\
						<td>'+ a[b].payall +'</td>\
						<td>'+ a[b].paypercent +'</td>\
					</tr>\</div>');
				}
			} else {
				$("#chart6").append('<tr role="row">\
					<td colspan="20" align="center" style="padding: 100px;">Нет данных</td>\
				</tr>\</div>');
			}
			apanel.analyticsutm.thead()
		},
		thead: function() {
			$('#chart6').append('<thead style="font-size: 12px">\
				<tr role="row">\
					<th style="vertical-align: middle; width: 280px">Дата</th>\
					<th style="vertical-align: middle; width: 66px;">Отправлено</th>\
					<th style="text-align: center;color: #3e3e3e;background: #dcdcdc;">Выкуплено</th>\
					<th style="text-align: center;color: #3e3e3e;background: #f28485;">Средний чек (выкуплено)</th>\
					<th style="text-align: center;color: #3e3e3e;background: #f2bebe;">Возврат</th>\
					<th style="text-align: center;color: #3e3e3e;background: #F2DEDE;">В доставке</th>\
					<th style="text-align: center;color: #3e3e3e;background: #FAF2CC;">Выкуплено на сумму</th>\
					<th style="text-align: center;color: #3e3e3e;background: #DFF0D8;">Общий процент выкупа</th>\
				</tr>\
			</thead>')				
		},
		select:   function() {
			//статистика по конверсиям
			var json = {func:'CStat', domain:JSCat.domain, token:JSCat.token};
			json["action"] = "analyticsutm";
			$.post("/json/", json, function(a) {
				//if (typeof a !== 'object') a = JSON.parse(a)
				return a
			});
		}
	},
	analyticsall: {
		start:   function() {
			console.log('analyticsall')
			var a = apanel.analyticsall.query()
			apanel.analyticsutm.table(a)
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
	}
}

$(function() {
	apanel = new apanel();
	apanel.builder()
});


</script>






