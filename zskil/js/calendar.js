$.fn.calendar = function(events) { 
	//$(this).html("test");
	//console.log(method);
	var month_days = [31,28,31,30,31,30,31,31,30,31,30,31];
	var month = ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'];
	var yearStart = 2018;
	var yearEnd = (new Date()).getFullYear() + 2;
	var $calendar = '';
	var last = 0;
	var mon = '';
	var dateObj = new Date();
	var m = dateObj.getUTCMonth(); //months from 1-12
	var y = dateObj.getUTCFullYear();
	for (i in month) { if (i == m) cl = 'class="active"'; else cl = ''; mon += '<li ' + cl + ' data-mon="' + i + '">' + month[i] + '</li>'; }
	var yr = '';
	for (i = yearStart; i <= yearEnd; i++) { if (i == y) cl = 'class="active"'; else cl = ''; yr += '<li ' + cl + ' data-yr="' + i + '">' + i + '</li>'; }
	for (y = yearStart; y <= yearEnd; y++) {
		$year = '';
		for (m = 0; m < 12; m++) {
			var $month = '';
			if (m==1 && y % 4 == 0) {
				for (d=1; d<=29; d++) {
					var dt = new Date(y,m,d).getDay();
					if (dt == 0) dt = 7;
					dt = dt - 1;
					if (d==1) p = 'style="margin-left: calc(' + dt + ' * 100% / 7)"';
					else p = '';
					$day = d;
					if (typeof(events[returnDate(d,m+1,y)]) != 'undefined') {
						for (i in events[returnDate(d,m+1,y)]) {
							$day += '<div class="' + events[returnDate(d,m+1,y)][i] + '"></div>';
						}
					}
					$month += '<li ' + p + '><div class="bord">' + $day + '</div></li>';
				}
			}
			else {
				for (d=1; d<=month_days[m]; d++) {
					var dt = new Date(y,m,d).getDay();
					if (dt == 0) dt = 7;
					dt = dt - 1;
					if (d==1) p = 'style="margin-left: calc(' + dt + ' * 100% / 7)"';
					else p = '';
					$day = d;
					if (typeof(events[returnDate(d,m+1,y)]) != 'undefined') {
						for (i in events[returnDate(d,m+1,y)]) {
							$day += '<div class="' + events[returnDate(d,m+1,y)][i] + '"></div>';
						}
					}
					$month += '<li ' + p + '><div class="bord">' + $day + '</div></li>';
				}
			}
			$year += '<li><ul class="month month_' + m + '"><li>Пн</li><li>Вт</li><li>Ср</li><li>Чт</li><li>Пт</li><li>Сб</li><li>Вс</li>' + $month + '</ul></li>';
		}
		$calendar += '<ul class="years year_' + y + '"><li class="month_list_li"><span class="m_left fas fa-angle-left"></span><div class="month_list_div"><ul class="month_list">' + mon + '</ul></div><span class="m_right fas fa-angle-right"></span></li>' + $year + '</ul>';
	}
	$(this).html('<ul class="year_list">' + yr + '</ul>' + $calendar);
	var dateObj = new Date();
	var m = dateObj.getUTCMonth(); //months from 1-12
	var y = dateObj.getUTCFullYear();
	$('.year_' + y).show();
	$('.month_' + m).show();
	$('.year_' + y).addClass('active');
	$('.month_' + m).addClass('active');
}

$(document).on('click', '.m_left', function(){

});

$(document).on('click', '.m_right', function(){
	console.log($('.month_list').marginLeft);
});

$(document).on('click', '.month_list li', function(){
	$(".month").hide();
	$(".month").addClass('active');
	$(".month_" + $(this).attr('data-mon')).show();
	$('.month_' + $(this).attr('data-mon')).addClass('active');
	$(".month_list li").removeClass('active');
	$(this).addClass('active');
});

$(document).on('click', '.year_list li', function(){
	$(".years").hide();
	$(".years").addClass('active');
	$(".year_" + $(this).attr('data-yr')).show();
	$('.year_' + $(this).attr('data-yr')).addClass('active');
	$(".year_list li").removeClass('active');
	$(this).addClass('active');
});

function returnDate(d,m,y) {
	if (d <= 9) d = '0' + d;
	if (m <= 9) m = '0' + m;
	return d + '-' + m + '-' + y;
}