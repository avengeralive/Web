<?php namespace lib;
	if (!in_array('admin', $RoleUser) && !in_array('admin', $RoleGroup)) die();	
?>


<div id="top">
	<h1>Аналитика
		<i class="radios little" style="float: right;">
			<label class="active"><input type="radio" name="radios" radios="general">Основные</label>
			<label><input type="radio" name="radios" radios="sales">Сделки</label>
		</i>
		<i>Статистика и воронка продаж</i>
   </h1>
</div>

<div id="charts"></div>

<script>

	function statistic() {
		//последние 10 зарегистрированных
		var json = {func:'CStat', domain:JSCat.domain, token:JSCat.token};
		json["action"] 		= "call_ten_registr";
		$.post("/json/", json, function(a){
			if (typeof a !== 'object') a = JSON.parse(a);
			$('#chart5').append('<h3>Последние зарегистрированные</h3>');
			for (var b in a) {
				var randomColor = "#" + Math.random().toString(16).slice(2, 8);
					$("#chart5").append('<div><span><u style="background:' + randomColor + '"></u>' + a[b].username + '</span><span>' + a[b].name + '</span>\
										<span>' + timeConverter(a[b].registerDate) + '</span></div>');
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
				time = timeConverter(time);
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
		//узнаем размер папки на сервере
		var json = {func:'CStat', domain:JSCat.domain, token:JSCat.token};
		json["action"] 		= "what_size";
		$.post("/json/", json, function(a){
			if (typeof a !== 'object') a = JSON.parse(a);
			var k = 8000;
			$("#chart2").append('<canvas id="myChart2" style="height:80px; width:720px"></canvas>')
			var cty = document.getElementById("myChart2").getContext('2d');
			var myChart = new Chart(cty, {
				type: 'horizontalBar',
				data: {
					datasets: [{
						label: 'Памяти занято ('+a[1]+')',
		   				data: [(a[0]/k)*100],	
		   				backgroundColor: [
		   					'rgb(63, 118, 172)'
		   				], 
		   				borderColor : [
		   					'rgb(63, 118, 172)'
		   				],	 					
		   				borderWidth: 10
					}]
				},
				options: {
				 	tooltips:{
				 		enabled: false
				 	},
				 	layout: {
		   				 padding: {
							right: 20
						}
					},
					title: {
						display: true,
		   			 	text: 'Статистика использования дискового пространства, %. Памяти занято '+a[0]+' '+a[1],
		   			 	fontSize: 16,
		   			 	fontColor: 'rgb(58, 58, 58)' 
					},
					legend: {
						display: false
					},
					scales: {
						xAxes: [{
							display: true,
							ticks: {
								beginAtZero:true,
								max: 100
							}
						}]
					}
				}
			});
		});
		//статистика каталогов
		var json = {func:'CStat', domain:JSCat.domain, token:JSCat.token};
		json["action"] 		= "catalogue_stat";
		$.post("/json/", json, function(a){
			if (typeof a !== 'object') a = JSON.parse(a);
			$('#chart6').append('<h3>Статистика заказов</h3>');
			$('#chart6').append('<div><span>ID</span><b>Название</b>\
										<span>Всего</span>\
										<span>В работе</span>\
										<span>Неактивных</span>\
										<span>Последний</span></div>');
			for (var b in a) {
				(a[b].today == 0)?(a[b].today = ""):(a[b].today = '<i style ="color: green;" > + ' + a[b].today + '</i>');
				if (!a[b].last) a[b].last = '-';
				var randomColor = "#" + Math.random().toString(16).slice(2, 8);
				if (a[b].count != '0')
					$("#chart6").append('<div><u style="background:' + randomColor + '"></u>\
											<span>' + a[b].id + '</span>\
											<b>' + a[b].title + '</b>\
											<span>' + a[b].count + '</span>\
											<span>' + a[b].active + '</span>\
											<span>' + a[b].moder + '</span>\
											<span>' + a[b].last + a[b].today + ' </span></div>');
			}
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
		$('.radios [name]').change(function() {
			$('.little label').removeClass('active').find('[radios]:checked').parent().addClass('active');
			var radios = $(this).attr('radios');
			if ($('[radios="general"]:checked').length) {
				$( '#charts').empty().append('<div class="charts">\
					<div id="chart3"></div>\
					<div id="chart4" class="chart"></div>\
					<div id="chart5" class="chart"></div>\
					<div id="chart2"></div>\
					<div id="chart6"></div></div>');
				statistic();
			}
			var time = {'year':'Год','quarter':'Квартал','mounth':'Месяц'}

			if ($('[radios="sales"]:checked').length) {
				$( '#charts' ).empty().append('<div class="chart"><div id="objects1"><h3>По сделкам'+ radiosgen(time, 'objects1') +'</h3><div></div></div></div>');
				$( '#charts' ).append('<div class="chart"><div id="objects2"><h3>По статусам'+ radiosgen(time, 'objects2') +'</h3><div></div></div></div>');
				$( '#charts' ).append('<div class="chart"><div id="objects4"><h3>По источникам'+ radiosgen(time, 'objects4') +'</h3><div></div></div></div>');
				$( '#charts' ).append('<div class="chart"><div id="objects3"><h3>По товарам<span class="objects3 little"><label><input type="radio" name="objects3" radios="mounth">Месяц</label></span></h3><div></div></div></div>');
				$( '.chart h3 + div' ).append( '<p>Выберите период для отображения статистики</p>' );
				$('.little label').removeClass('active').find('[radios]:checked').parent().addClass('active');				
				$('.chart .little [name]').each(function() {
					var chart = $(this).parent().parent().parent().parent().attr('id');
					var radios = $(this).attr('radios');
					$(this).unbind().change(objects.bind(this, radios, chart));
				});
			}
		});
		$('.radios [radios="general"]').click();
		return false;
	}
	function objects(radios, chart) {
				
				var scale = {'q': [],'m': [],'d': []};
				var param = {'q': [],'q2': [],'m': [],'m2': [],'d': [],'d2': []};
				scale['q'] = ['1 квартал', '2 квартал', '3 квартал', '4 квартал'];
				scale['m'] = ["Январь", "Февраль", "Март", "Апрель", "Май", "Июнь", "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь"];
						
				switch (chart) {
					case 'objects1':
					
					
					var json = {};
		json.func = 'CStat';
		json.action = 'objects';
		json.domain = JSCat.domain;
		json.token = JSCat.token;
		$.ajax({
			url: '/json/',
			type: 'GET',
			dataType: 'json',
			data: json,
			success: function(result) {
		
		
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
						param['q'] = quarterConvert(param['q']);
						
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
						graphics(radios, chart, yeardata, quarterdata, monthdata);
			}
		});
		
					break;
					case 'objects2':
					
					
					
					var json = {};
		json.func = 'CStat';
		json.action = 'objects';
		json.domain = JSCat.domain;
		json.token = JSCat.token;
		$.ajax({
			url: '/json/',
			type: 'GET',
			dataType: 'json',
			data: json,
			success: function(result) {
		
		
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
						param['q'] = quarterConvert(param['q']);
						param['q2'] = quarterConvert(param['q2']);
						
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
						graphics(radios, chart, yeardata, quarterdata, monthdata);
					
			}
		});
		
					break;
					case 'objects3':
					
					
					
					
					var json = {};
		json.func = 'CStat';
		json.action = 'toCategory';
		json.domain = JSCat.domain;
		json.token = JSCat.token;
		$.ajax({
			url: '/json/',
			type: 'GET',
			dataType: 'json',
			data: json,
			success: function(result) {
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
						graphics(radios, chart, yeardata, quarterdata, monthdata);

			}
		});
		
					break;
					case 'objects4':
					
					
					
					var json = {};
		json.func = 'CStat';
		json.action = 'objects';
		json.domain = JSCat.domain;
		json.token = JSCat.token;
		$.ajax({
			url: '/json/',
			type: 'GET',
			dataType: 'json',
			data: json,
			success: function(result) {
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
						param['q'] = quarterConvert(param['q']);
						param['q2'] = quarterConvert(param['q2']);
						
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
						graphics(radios, chart, yeardata, quarterdata, monthdata);
						
			}
		});
		
					break;
				
				}

	}
	
	function graphics(radios, chart, yeardata, quarterdata, monthdata) {
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
	}
	function quarterConvert(q) {
		return [
			parseInt(q[0]) + parseInt(q[1]) + parseInt(q[2]),
			parseInt(q[3]) + parseInt(q[4]) + parseInt(q[5]), 
			parseInt(q[6]) + parseInt(q[7]) + parseInt(q[8]), 
			parseInt(q[9]) + parseInt(q[10]) + parseInt(q[11])
		];
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

