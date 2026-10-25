<?php namespace lib;
	if (!in_array('tech', $RoleUser) && !in_array('tech', $RoleGroup)) die();




//почти готово
//echo json_encode($start, JSON_UNESCAPED_UNICODE);
?>
<style>
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
    border-left: 1px #e2e0e0 solid;}
tr.hddn {
    position: absolute;
    left: -10000px;
}/* 
td.lb {
    background: #cacaca;
}
 */
tr.tr1 td.lb:before {
    background: #f28385;
}

tr.tr2 td.lb:before {
    background: #83bd7f;
}

tr.tr3 td.lb:before {
    background: #faf2cc;
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

</style>

<div id="top">
	<h1>Статистика по конверсиям
		<i class="radios little" style="float: right;">
			<label class="active"><input type="radio" name="radios" radios="analyticsall">Общая по датам</label>
			<label><input type="radio" name="radios" radios="analyticsmy">Личная по датам</label>
			<label><input type="radio" name="radios" radios="analyticsutm">Личная по меткам</label>
		</i>
		<i>Статистика и воронка продаж</i>
   </h1>
</div>

<div id="tabs" class="little">
	<span style="padding:9px">Период: </span>
	<input in type="date"/>
	<input out type="date"/>
	<button id="back" style="height:38px;margin-top:1px">Показать</button>
	<span style="flex:2"></span>
	<label class="active"><input type="radio" name="filter" filter="table">Таблица</label>
	<label><input type="radio" name="filter" filter="graph">График</label>
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
			analyticsall:		'analyticsall',
			analyticsmy:		'analyticsmy',
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
        analyticsall:		['Аналитика','Детальная статистика и воронка продаж'],
        analyticsmy:			['Аналитика','Детальная статистика и воронка продаж'],
        analyticsutm:		['Аналитика','Детальная статистика и воронка продаж']
	},				
	actions:   function() {
    	$('[radios="' + apanel.cfg.selectors.analyticsall +'"]').click(apanel.analyticsall.start.bind(this))
    	$('[radios="' + apanel.cfg.selectors.analyticsmy +'"]').click(apanel.analyticsmy.start.bind(this))
    	$('[radios="' + apanel.cfg.selectors.analyticsutm +'"]').click(apanel.analyticsutm.start.bind(this))
    	$('[filter="' + apanel.cfg.selectors.table +'"]').click(apanel.analyticsall.start.bind(this))
    	$('[filter="' + apanel.cfg.selectors.graph +'"]').click(apanel.graph.start.bind(this))
    	$('#back').click(apanel.back.start.bind(this))
    	apanel.analyticsall.start()
	},
	graph: {
		start:   function() {
			$( '#charts').empty().append('<div class="charts">\
					<div id="chart1"></div>\
					<div id="chart2"></div>\
					<div id="chart3"></div>\
					<div id="chart4"></div></div>')
			console.log('graph')
			//графики
			var time = {'year':'Год','quarter':'Квартал','mounth':'Месяц'}
			if ($('[filter="graph"]:checked').length) {
				$( '#charts' ).empty().append('<div class="chart"><div id="objects1"><h3>По сделкам'+ apanel.radiosgen(time, 'objects1') +'</h3><div></div></div></div>');
				$( '#charts' ).append('<div class="chart"><div id="objects2"><h3>По статусам'+ apanel.radiosgen(time, 'objects2') +'</h3><div></div></div></div>');
				$( '#charts' ).append('<div class="chart"><div id="objects4"><h3>По источникам'+ apanel.radiosgen(time, 'objects4') +'</h3><div></div></div></div>');
				$( '#charts' ).append('<div class="chart"><div id="objects3"><h3>По товарам<span class="objects3 little"><label><input type="radio" name="objects3" radios="mounth">Месяц</label></span></h3><div></div></div></div>');
				$( '.chart h3 + div' ).append( '<p>Выберите период для отображения статистики</p>' );
				$('#top .little label').removeClass('active').find('[radios]:checked').parent().addClass('active');				
				$('.chart .little [name]').each(function() {
					var chart = $(this).parent().parent().parent().parent().attr('id');
					var radios = $(this).attr('radios');
					$(this).unbind().change(apanel.objects.bind(this, radios, chart));
				});
			}
		}, 
		start1:   function() {

		}, 
		start2:   function() {

		}
	},
	back: {
		start:   function() {
			console.log('back')
			var a = apanel.back.query()
			apanel.analyticsall.table(a)
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
			$('#tabs').hide()
			console.log('analyticsutm')
			$( '#charts').empty().append('<div class="charts">Показать заказы <select name="useGroup" id="useGroup">\
						<option value="all">Все</option>\
						<option value="spam">Все, кроме спама</option>\
						<option value="approve">Только принятые</option>\
						<option value="cancel">Только отмененные</option>\
					</select><table id="chart6" border="0" style="width: 100%;"></table></div>')
			var a = apanel.analyticsutm.select()
			
			$('#useGroup').val('all').change(apanel.analyticsutm.select.bind(this))
		},
		table: function(a) {
			$( '#chart6').empty()
			apanel.analyticsutm.thead()
			if (a) {
				//console.log(a);
				// for (var b in a) {
				
				for (var b in a) {
							
					var allcount = 0;
					for (var c in a[b]) {
						if (( c !='label')&&(c.includes('_count'))) allcount += a[b][c];
					}
					
					var ab1 = (a[b].list19_count) ? a[b].list19_count : '0';
					var ab2 = (a[b][c].list19_count > 0) ? Math.floor(a[b].list19_count / allcount * 100).toFixed(2) : 0;
					var ab3 = (a[b][c].list19_count > 0) ? Math.floor(100 - (a[b].list19_count / allcount * 100)).toFixed(2) : 0;//?
					var ab4 = (a[b].list20_count) ? a[b].list20_count : '0';
					var ab5 = Math.floor(allcount / 10000 * 100).toFixed(2);
						
					$("#chart6").append('<tbody  item="'+ a[b].label +'" source="first">\
						<tr class="tr0 " item="'+ a[b].label +'" source="first">\
						<td><i item="1" source="'+ a[b].label +'">+</i></td>\
						<td class="lb">'+ a[b].label +'</td>\
						<td><b>10000</b></td>\
						<td><b></b>'+allcount+'</td>\
						<td><b>'+ ab1 +'</b></td>\
						<td><b>'+ ab2 +'%</b></td>\
						<td><b>'+ ab3 +'%</b></td>\
						<td><b>'+ ab4 +'</b></td>\
						<td><b>'+ ab5 +'%</b></td>\
						<td><b>0</b></td>\
					</tr>')
							
					for (var c in a[b]) {
					
						allcount = 0;
						for (var d in a[b][c]) {
							if (( d !='label')&&(d.includes('_count'))) allcount += a[b][c][d];
						}
						
						if (( c !='label')&&(!c.includes('_count'))) {
						
							var abc1 = (a[b][c].list19_count) ? a[b][c].list19_count : '0';
							var abc2 = (a[b][c].list19_count > 0) ? Math.floor(a[b][c].list19_count / allcount * 100).toFixed(2) : 0;
							var abc3 = (a[b][c].list19_count > 0) ? Math.floor(100 - a[b][c].list19_count / allcount * 100).toFixed(2) : 0;
							var abc4 = (a[b][c].list20_count) ? a[b][c].list20_count : '0';
							var abc5 = Math.floor(allcount / 10000 * 100).toFixed(2);
						
							if ($('[item="'+ a[b][c].label+'"][source="'+ a[b].label +'"]').length == 0) {
								$('tbody[item="'+ a[b].label +'"][source="first"]').append('<tr class="tr1 hddn" item="'+ a[b][c].label +'" source="'+ a[b].label +'">\
									<td><i item="2" source="'+ a[b].label+a[b][c].label +'">+</i></td>\
									<td class="lb">'+ a[b][c].label +'</td>\
									<td><b>10000</b></td>\
									<td><b></b>'+ allcount +'</td>\
									<td><b>'+ abc1 +'</b></td>\
									<td><b>'+ abc2 +'%</b></td>\
									<td><b>'+ abc3 +'%</b></td>\
									<td><b>'+ abc4 +'</b></td>\
									<td><b>'+ abc5 +'%</b></td>\
									<td><b>0</b></td>\
								</tr>')
								
								for (var d in a[b][c]) {
								
									allcount = 0;
									for (var e in a[b][c][d]) {
										if (( e !='label')&&(e.includes('_count'))) allcount += a[b][c][d][e];
									}

									if (( d !='label')&&(!d.includes('_count'))) {
									
										var abcd1 = (a[b][c][d].list19_count) ? a[b][c][d].list19_count : '0';
										var abcd2 = (a[b][c][d].list19_count > 0) ? Math.floor(a[b][c][d].list19_count / allcount * 100).toFixed(2) : 0;
										var abcd3 = (a[b][c][d].list19_count > 0) ? Math.floor(100 - a[b][c][d].list19_count / allcount * 100).toFixed(2) : 0;
										var abcd4 = (a[b][c][d].list20_count) ? a[b][c][d].list20_count : '0';
										var abcd5 = Math.floor(allcount / 10000 * 100);
							
										if ($('[item="'+ a[b][c][d].label+'"][source="'+a[b].label+a[b][c].label +'"]').length == 0) {
											$('.tr1[item="'+ a[b][c].label +'"][source="'+ a[b].label +'"]').after('<tr class="tr2 hddn" item="'+ a[b][c][d].label+'" source="'+a[b].label+a[b][c].label +'">\
												<td><i item="3"  source="'+a[b].label+a[b][c].label + a[b][c][d].label +'">+</i></td>\
												<td class="lb">'+ a[b][c][d].label +'</td>\
												<td><b>10000</b></td>\
												<td><b></b>'+allcount+'</td>\
												<td><b>'+ abcd1 +'</b></td>\
												<td><b>'+ abcd2 +'%</b></td>\
												<td><b>'+ abcd3 +'%</b></td>\
												<td><b>'+ abcd4 +'</b></td>\
												<td><b>'+ abcd5 +'%</b></td>\
												<td><b>0</b></td>\
											</tr>')
																													
											for (var e in a[b][c][d]) {
												if (( e !='label')&&(!e.includes('_count'))) {
									
													allcount = 0;
													for (var f in a[b][c][d][e]) {
														if ( f !='label') allcount += a[b][c][d][e][f];
													}
													
													var abcde1 = (a[b][c][d][e].list19_count) ? a[b][c][d][e].list19_count : 0;
													var abcde2 = (a[b][c][d][e].list19_count > 0) ? Math.floor(a[b][c][d][e].list19_count / allcount * 100).toFixed(2) : 0;
													var abcde3 = (a[b][c][d][e].list19_count > 0) ? Math.floor(100 - a[b][c][d][e].list19_count / allcount * 100).toFixed(2) : 0;
													var abcde4 = (a[b][c][d][e].list20_count) ? a[b][c][d][e].list20_count : 0;
													var abcde5 = Math.floor(allcount / 10000 * 100);
										
													console.log($('[item="'+ a[b][c][d][e].label+'"][source="'+a[b][c][d].label +'"]').length);
													
													if ($('[item="'+ a[b][c][d][e].label +'"][source="'+ a[b].label+a[b][c].label + a[b][c][d].label +'"]').length == 0) {
														$('.tr2[item="'+ a[b][c][d].label +'"][source="'+ a[b].label+a[b][c].label +'"]').after('<tr class="tr3 hddn" item="3" source="'+ a[b].label+a[b][c].label + a[b][c][d].label +'">\
																<td><i source="'+ a[b][c][d][e].label +'">-</i></td>\
																<td class="lb">'+ a[b][c][d][e].label +'</td>\
																<td><b>10000</b></td>\
																<td class="listAll"><b>'+allcount+'</b></td>\
																<td><b>'+ abcde1 +'</b></td>\
																<td><b>'+ abcde2 +'%</b></td>\
																<td><b>'+ abcde3 +'%</b></td>\
																<td><b>'+ abcde4 +'</b></td>\
																<td><b>'+ abcde5 +'%</b></td>\
																<td><b>0</b></td>\
															</tr>')
													}
												}
											}
										}
									}
								}
							}
						}
					}
				}
					
				//свернуть/развернуть
				$('.tr0 i[source],.tr1 i[source],.tr2 i[source]').click(function() {
					var s = $(this).attr('source')
					var i = $(this).attr('item')
					//var el = $(this + tr);
					console.log(s +'-'+i)
					if ($('#charts tr[source="'+ s +'"]').hasClass('hddn')) {
						$('#charts tr[source="'+ s +'"]').removeClass('hddn')
						$(this).css('transform','rotate(45deg)')
					} else {
						$('#charts tr[source^="'+ s +'"]').addClass('hddn')
						$(this).css('transform','rotate(0deg)')
					}
				})
					
			} else {
				$("#chart6").append('<tr role="row">\
					<td colspan="9" align="center" style="padding: 100px;">Нет данных</td>\
				</tr>\</div>');
			}
			apanel.analyticsutm.thead()
		},
		thead: function() {
			$('#chart6').append('<thead style="font-size: 12px">\
				<tr role="row">\
					<th style="text-align: center;width: 40px; text-align: center;"></th>\
					<th style="vertical-align: middle; width: 280px">UTM</th>\
					<th style="vertical-align: middle; width: 66px;">Переходы</th>\
					<th style="text-align: center;color: #3e3e3e;background: #dcdcdc;">Заказы</th>\
					<th style="text-align: center;color: #3e3e3e;background: #f28485;">Подтверждено</th>\
					<th style="text-align: center;color: #3e3e3e;background: #f2bebe;">Апрув 1</th>\
					<th style="text-align: center;color: #3e3e3e;background: #F2DEDE;">Апрув 2</th>\
					<th style="text-align: center;color: #3e3e3e;background: #FAF2CC;">Выкуплено</th>\
					<th style="text-align: center;color: #3e3e3e;background: #DFF0D8;">CR</th>\
					<th style="text-align: center;color: #3e3e3e;background: #bcf0b8;">Конверт</th>\
				</tr>\
			</thead>')				
		},
		select:   function() {
			//статистика по конверсиям
			var json = {func:'CStat', domain:JSCat.domain, token:JSCat.token};
			json["action"] = "statconversion";
			json["req"] = "utmstat";
			$.post("/json/", json, function(a) {
				// if (typeof a !== 'object') a = JSON.parse(a)
// 				return a
				console.log(JSON.parse(a));
				apanel.analyticsutm.table(JSON.parse(a));
			});
		}
	},
	analyticsmy: {
		start:   function() {
			console.log('analyticsmy')
			apanel.analyticsall.start()
		}
	},
	analyticsall: {
		start:   function() {
			$('#tabs').show()
			$( '#charts').empty().append('<div class="charts"><table id="chart6" border="0" style="width: 100%;"></table></div>')
			var a = apanel.analyticsall.query()
			
// 			apanel.analyticsall.table(a)
		},
		thead: function() {
			$('#chart6').append('<thead style="font-size: 12px">\
				<tr role="row">\
					<th rowspan="2" style="vertical-align: middle; width: 80px" colspan="1" >Дата</th>\
					<th rowspan="2" style="vertical-align: middle; width: 66px;" colspan="1">Переходы</th>\
					<th colspan="3" style="text-align: center;color: #3e3e3e;background: #dcdcdc;" rowspan="1">Всего</th>\
					<th colspan="2" style="text-align: center;color: #3e3e3e;background: #f28485;" rowspan="1">Возврат</th>\
					<th colspan="2" style="text-align: center;color: #3e3e3e;background: #f2bebe;" rowspan="1">Ошибка/Спам/Дубль</th>\
					<th colspan="2" style="text-align: center;color: #3e3e3e;background: #F2DEDE;" rowspan="1">Отменен</th>\
					<th colspan="3" style="text-align: center;color: #3e3e3e;background: #FAF2CC;" rowspan="1">Обработка</th>\
					<th colspan="3" style="text-align: center;color: #3e3e3e;background: #DFF0D8;" rowspan="1">Принят</th>\
					<th colspan="3" style="text-align: center;color: #3e3e3e;background: #bcf0b8;" rowspan="1">Оплачен</th>\
				</tr>\
				<tr role="row">\
					<th rowspan="1" colspan="1">Заказов</th>\
					<th rowspan="1" colspan="1">CR</th>\
					<th rowspan="1" colspan="1">Конверт</th>\
					<th rowspan="1" colspan="1">Заказов</th>\
					<th rowspan="1" colspan="1" style="width: 25px;">%</th>\
					<th rowspan="1" colspan="1">Заказов</th>\
					<th rowspan="1" colspan="1" style="width: 25px;">%</th>\
					<th rowspan="1" colspan="1">Заказов</th>\
					<th rowspan="1" colspan="1" style="width: 25px;">%</th>\
					<th rowspan="1" colspan="1">Заказов</th>\
					<th rowspan="1" colspan="1" style="width: 25px;">%</th>\
					<th rowspan="1" colspan="1">Конверт</th>\
					<th rowspan="1" colspan="1">Заказов</th>\
					<th rowspan="1" colspan="1" style="width: 25px;">%</th>\
					<th rowspan="1" colspan="1">Конверт</th>\
					<th rowspan="1" colspan="1">Заказов</th>\
					<th rowspan="1" colspan="1" style="width: 25px;">%</th>\
					<th rowspan="1" colspan="1">Конверт</th>\
				</tr>\
			</thead>');
		},
		table: function(a) {
			$( '#chart6').empty()
			
			apanel.analyticsall.thead()
			if (a) {
			
				for (var b in a) {
					if (a[b].count != '0') $("#chart6").append('<tr role="row">\
						<td style="width: 80px;">'+ a[b].day +'</td>\
						<td style="width: 66px;">-</td>\
						<td style="width: 54px;">'+ a[b].allcount +'</td>\
						<td style="width: 38px;">-</td>\
						<td style="width: 56px;">-</td>\
						<td style="width: 55px;">'+ a[b].back +'</td>\
						<td style="width: 17px;">'+ apanel.analyticsall.percent( a[b].back,a[b].allcount)  +'</td>\
						<td style="width: 77px;">'+ a[b].errors +'</td>\
						<td style="width: 47px;">'+ apanel.analyticsall.percent(a[b].errors,a[b].allcount) +'</td>\
						<td style="width: 55px;">'+ a[b].cancelled +'</td>\
						<td style="width: 17px;">'+ apanel.analyticsall.percent(a[b].cancelled,a[b].allcount)  +'</td>\
						<td style="width: 55px;">'+ a[b].treatment +'</td>\
						<td style="width: 17px;">'+ apanel.analyticsall.percent(a[b].treatment,a[b].allcount) +'</td>\
						<td style="width: 56px;">-</td>\
						<td style="width: 55px;">'+ (a[b].accepted + a[b].sent) +'</td>\
						<td style="width: 17px;">'+ apanel.analyticsall.percent((a[b].accepted + a[b].sent),a[b].allcount) +'</td>\
						<td style="width: 56px;">-</td>\
						<td style="width: 56px;">'+ a[b].paid +'</td>\
						<td style="width: 17px;">'+ apanel.analyticsall.percent( a[b].paid,a[b].allcount) +'</td>\
						<td style="width: 58px;">-</td>\
					</tr>\</div>');
				}
			} else {
				$("#chart6").append('<tr role="row">\
					<td colspan="20" align="center" style="padding: 100px;">Нет данных</td>\
				</tr>\</div>');
			}
			apanel.analyticsall.thead()
		},
		query: function() {
			//статистика по конверсиям
			var json = {func:'CStat', domain:JSCat.domain, token:JSCat.token};
			json["action"] = "statconversion";
			json["req"] = "sconv";
			$.post("/json/", json, function(a) {
				
				if (typeof a !== 'object') a = JSON.parse(a)
				apanel.analyticsall.table(a);
// 				console.log(a);
// 				return a;
			});
		},
		percent: function(count,all) {
			//процент
			if (all == 0) return '0%';
			else return (count/all*100).toFixed(0)+'%';
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
	quarterConvert: function(q) {
		return [
			parseInt(q[0]) + parseInt(q[1]) + parseInt(q[2]),
			parseInt(q[3]) + parseInt(q[4]) + parseInt(q[5]), 
			parseInt(q[6]) + parseInt(q[7]) + parseInt(q[8]), 
			parseInt(q[9]) + parseInt(q[10]) + parseInt(q[11])
		];
	},
	graphics: function(radios, chart, yeardata, quarterdata, monthdata) {
		//console.log(chart)
		$('.'+ chart +' label').removeClass('active');
		$('[name="'+ chart +'"][radios="'+ radios +'"]').parent().addClass('active');
		if (radios == 'mounth') {
			/////график обычный
			$( '#'+ chart +' div' ).empty().append('<canvas id="'+ chart +'a" height="70%"></canvas>');
			var options =  {
				scales: {
					yAxes: [{
						id: 'A'
					}]
				}
			}		
			var ctx = document.getElementById(chart +'a');
			new Chart(ctx, {type: "line",data:monthdata, options:options});

		} else if (radios == 'year') {		
			//график горизонтальный
			$( '#'+ chart +' div' ).empty().append('<canvas id="'+ chart +'b" height="70%"></canvas>');
			var options =  {
				scales: {
					yAxes: [{
						id: 'A'
					}]
				}
			}		
			var ctx = document.getElementById(chart +'b');
			new Chart(ctx, {type: "horizontalBar",data:yeardata, options:options});
				
		} else if (radios == 'quarter') {		
			//график вертикальный		
			$( '#'+ chart +' div' ).empty().append('<canvas id="'+ chart +'c" height="70%"></canvas>');
			var options =  {
				scales: {
					yAxes: [{
						id: 'A'
					}]
				}
			}		
			var ctx = document.getElementById(chart +'c');
			new Chart(ctx, {type: "bar",data:quarterdata, options:options});
		}	
	},
	objects: function(radios, chart) {
		var scale = {'q': [],'m': [],'d': []};
		var param = {'q': [],'q2': [],'m': [],'m2': [],'d': [],'d2': []};
		scale['q'] = ['1 квартал', '2 квартал', '3 квартал', '4 квартал'];
		scale['m'] = ["Январь", "Февраль", "Март", "Апрель", "Май", "Июнь", "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь"];
						
		switch (chart) {
			case 'objects1':
				var json = {func:apanel.cfg.url.querystat,domain:JSCat.domain,token:JSCat.token};
				json.action = 'objects';
				$.post("/json/", json, function(result) {
					if ( typeof result !== 'object' ) result = JSON.parse(result)
					//months
					param['d'] = result.days;
					for (var key in result.year) {
						scale['m'][key-1] = scale['m'][key-1] +' '+ result.year[key].y;
						param['m'].push(result.year[key].domain);
					}
					var yeardata = {
						labels: scale['m'],
						datasets: [{
							label: "Новые объекты",
							yAxisID: 'A',
							backgroundColor: "rgba(63, 118, 172, 1)",
							borderColor: "rgba(63, 118, 172, 1)",
							borderWidth: 1,
							data: param['m']
						}]
					}
					
					//quarter
					for (var key in result.year) {
						if (key == 1 || key == 4 || key == 7 || key == 10) {
							var k = key-1;
							if (k != 0) k = k/3;
							scale['q'][k] = scale['q'][k] +' '+ result.year[key].y;
						}
						param['q'].push(result.year[key].domain);
					}
					param['q'] = apanel.quarterConvert(param['q']);
						
					var quarterdata = {
						labels: scale['q'],
						datasets: [{
							label: "Новые объекты",
							yAxisID: 'A',
							backgroundColor: "rgba(63, 118, 172, 1)",
							data: param['q']
						}]
					}
					
					//month
					var today = new Date();
					var day = new Array();
					for (i = 0; i < param['d'].length; i++) {
							(today.getMonth()) < 10 ? day[i] = today.getDate() + '.' + '0' + (today.getMonth() ) : day[i] = today.getDate() + '.' + (today.getMonth());
							today.setDate(today.getDate() + 1);
						}
					today.setMonth(today.getMonth() - 1);
			
					var monthdata = {
							labels: day,
							datasets: [{
								label: "Новые объекты",
								yAxisID: 'A',
								backgroundColor: "rgba(63, 118, 172, 0)",
								borderColor: "rgba(63, 118, 172, 1)",
								data: param['d']
							}]
						}
					//отрисовка графики			
					apanel.graphics(radios, chart, yeardata, quarterdata, monthdata);
				});
			break;
			case 'objects2':
				var json = {func:apanel.cfg.url.querystat,domain:JSCat.domain,token:JSCat.token};
				json.action = 'objects';
				$.post("/json/", json, function(result) {
					if ( typeof result !== 'object' ) result = JSON.parse(result)
					//months
					param['d'] = result.status1;
					param['d2'] = result.status2;
					for (var key in result.year) {
						scale['m'][key-1] = scale['m'][key-1] +' '+ result.year[key].y;
						param['m'].push(result.year[key].status1);
						param['m2'].push(result.year[key].status2);
					}
					var yeardata = {
						labels: scale['m'],
						datasets: [{
							label: "В архиве",
							yAxisID: 'A',
							backgroundColor: "rgba(255, 99, 132, 1)",
							borderColor: "rgba(255, 99, 132, 1)",
							borderWidth: 1,
							data: param['m2']
						},{
							label: "На сайте",
							yAxisID: 'A',
							backgroundColor: "rgba(63, 118, 172, 1)",
							borderColor: "rgba(63, 118, 172, 1)",
							borderWidth: 1,
							data: param['m']
						}]
					}

					//quarter
					for (var key in result.year) {
						if (key == 1 || key == 4 || key == 7 || key == 10) {
							var k = key-1;
							if (k != 0) k = k/3;
							scale['q'][k] = scale['q'][k] +' '+ result.year[key].y;
						}
						param['q'].push(result.year[key].status1);
						param['q2'].push(result.year[key].status2);
					}
					param['q'] = apanel.quarterConvert(param['q']);
					param['q2'] = apanel.quarterConvert(param['q2']);
					
					var quarterdata = {
						labels: scale['q'],
						datasets: [{
							label: "В архиве",
							yAxisID: 'A',
							backgroundColor: "rgba(255, 99, 132, 1)",
							data: param['q2']
						},{
							label: "На сайте",
							yAxisID: 'A',
							backgroundColor: "rgba(63, 118, 172, 1)",
							data: param['q']
						}]
					}
					
					//month
					var today = new Date();
					var day = new Array();
					for (i = 0; i < param['d'].length; i++) {
						(today.getMonth()) < 10 ? day[i] = today.getDate() + '.' + '0' + (today.getMonth() ) : day[i] = today.getDate() + '.' + (today.getMonth());
						today.setDate(today.getDate() + 1);
					}
					today.setMonth(today.getMonth() - 1);
				
					var monthdata = {
						labels: day,
						datasets: [{
							label: "В архиве",
							yAxisID: 'A',
							backgroundColor: "rgba(255, 99, 132, 0)",
							borderColor: "rgba(255, 99, 132, 1)",
							data: param['d2']
						},{
							label: "На сайте",
							yAxisID: 'A',
							backgroundColor: "rgba(63, 118, 172, 0)",
							borderColor: "rgba(63, 118, 172, 1)",
							data: param['d']
						}]
					}
					//отрисовка графики			
					apanel.graphics(radios, chart, yeardata, quarterdata, monthdata);	
				});
			break;
			case 'objects3':
				var json = {func:apanel.cfg.url.querystat,domain:JSCat.domain,token:JSCat.token};
				json.action = 'toCategory';
				$.post("/json/", json, function(result) {
					if ( typeof result !== 'object' ) result = JSON.parse(result)
					var lists = {
						1	:'Обработка',
						2	:'НДЗ-Робот Дозвон',
						3	:'ОКК',
						4	:'Отменен',
						5	:'Отправлен по РФ',
						6	:'Спам/ошибки/Консультация',
						7	:'Оплачен',
						8	:'Перевод',
						9	:'Возврат',
						10	:'Дубль',
						11	:'Переданы на склад',
						12	:'Пришло на почту сегодня',
						13	:'День 1',
						14	:'День 2',
						15	:'День 3',
						16	:'День 4',
						17	:'День 5',
						18	:'День 6',
						19	:'День 7',
						20	:'День 8',
						21	:'День 9',
						22	:'День 10',
						23	:'День 11',
						24	:'День 12',
						25	:'День 13',
						26	:'День 14',
						27	:'День 15',
						28	:'День >15',
						29	:'НДЗ-Звонит Робот',
						30	:'Думает/набрать позже',
						31	:'Подтвержден [2 прозвон]',
						32	:'Фрод',
						33	:'Подтверждена отправка',
						34	:'Жалобы на конкурентов',
						35	:'Завести трек',
						36	:'День 4 [Дозвон]',
						37	:'День 5 [Дозвон]',
						38	:'День 6 [Дозвон]',
						39	:'День 7 [Дозвон]',
						40	:'День 8 [Дозвон]',
						41	:'День 9 [Дозвон]',
						42	:'День 10 [Дозвон]',
						43	:'День 11 [Дозвон]',
						44	:'День 12 [Дозвон]',
						45	:'День 13 [Дозвон]',
						46	:'День 14 [Дозвон]',
						47	:'День 15 [Дозвон]',
						48	:'День >15 [Дозвон]',
						49	:'Уехали на почту',
						50	:'Промежуточный'
					}
					var montData = [];
					for (list in result) {
						param[list] = result[list];
						montData.push({
							label: lists[list],
							yAxisID: 'A',
							backgroundColor: "rgba(255, 99, 132, 0)",
							borderColor: getRandomColor(),
							data: param[list]
						});
					}
					var yeardata = {}
					var quarterdata = {}

					//month
					var today = new Date();
					var day = new Array();
					for (i = 0; i < 30; i++){
						(today.getMonth()) < 10 ? day[i] = today.getDate() + '.' + '0' + (today.getMonth() ) : day[i] = today.getDate() + '.' + (today.getMonth());
						today.setDate(today.getDate() + 1);
					}
					today.setMonth(today.getMonth() - 1);
			
					var monthdata = {
						labels: day,
						datasets: montData
					}
					//отрисовка графики			
					apanel.graphics(radios, chart, yeardata, quarterdata, monthdata);
				});
			break;
			case 'objects4':	
				var json = {func:apanel.cfg.url.querystat,domain:JSCat.domain,token:JSCat.token};
				json.action = 'objects';
				$.post("/json/", json, function(result) {
					if ( typeof result !== 'object' ) result = JSON.parse(result)
					//months
					param['d'] = result.days;
					param['d2'] = result.base;
					for (var key in result.year) {
						scale['m'][key-1] = scale['m'][key-1] +' '+ result.year[key].y;
						param['m'].push(result.year[key].domain);
						param['m2'].push(result.year[key].base);
					}
					var yeardata = {
						labels: scale['m'],
						datasets: [{
							label: "API",
							yAxisID: 'A',
							backgroundColor: "rgba(255, 99, 132, 1)",
							borderColor: "rgba(255, 99, 132, 1)",
							borderWidth: 1,
							data: param['m2']
						},{
							label: "Всего",
							yAxisID: 'A',
							backgroundColor: "rgba(63, 118, 172, 1)",
							borderColor: "rgba(63, 118, 172, 1)",
							borderWidth: 1,
							data: param['m']
						}]
					}
						
					//quarter
					for (var key in result.year) {
						if (key == 1 || key == 4 || key == 7 || key == 10) {
							var k = key-1;
							if (k != 0) k = k/3;
							scale['q'][k] = scale['q'][k] +' '+ result.year[key].y;
						}
						param['q'].push(result.year[key].domain);
						param['q2'].push(result.year[key].base);
					}
					param['q'] = apanel.quarterConvert(param['q']);
					param['q2'] = apanel.quarterConvert(param['q2']);
						
					var quarterdata = {
						labels: scale['q'],
						datasets: [{
							label: "API",
							yAxisID: 'A',
							backgroundColor: "rgba(255, 99, 132, 1)",
							data: param['q2']
						},{
							label: "Всего",
							yAxisID: 'A',
							backgroundColor: "rgba(63, 118, 172, 1)",
							data: param['q']
						}]
					}
					//month
					var today = new Date();
					var day = new Array();
					for (i = 0; i < param['d'].length; i++){
						(today.getMonth()) < 10 ? day[i] = today.getDate() + '.' + '0' + (today.getMonth() ) : day[i] = today.getDate() + '.' + (today.getMonth());
						today.setDate(today.getDate() + 1);
					}
					today.setMonth(today.getMonth() - 1);
		
					var monthdata = {
						labels: day,
						datasets: [{
							label: "API",
							yAxisID: 'A',
							backgroundColor: "rgba(255, 99, 132, 0)",
							borderColor: "rgba(255, 99, 132, 1)",
							data: param['d2']
						},{
							label: "Всего",
							yAxisID: 'A',
							backgroundColor: "rgba(63, 118, 172, 0)",
							borderColor: "rgba(63, 118, 172, 1)",
							data: param['d']
						}]
					}
					//отрисовка графики			
					apanel.graphics(radios, chart, yeardata, quarterdata, monthdata);
				});
			break;		
		}
	}
}

$(function() {
	apanel = new apanel();
	apanel.builder()
});





</script>

