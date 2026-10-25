function crm(params) {
	$.extend(this.options, params);
}

crm.prototype = {
    build: '1.0',
    cfg: {
        url: {
            querypanel: 		'CPanel',
            queryuser:	 		'CUser'
        },
        selectors:	{
        	crm:			'crm',
        	crmtop:			'crmtop',
        	crmtwo:			'crmtwo',
        	
        	objects:		'objects',
        	clients:		'clients',
        	calendar:		'calendar',
        	document:		'document',
        	account:		'account',
        	
        	cats:			'cats',
        	users:			'users',
        	ads:			'ads',
        	add:			'add',
        	updateall:		'updateall',
        	
        	name_user:		'name_user',
        	phone_user:		'phone_user',
        	email_user:		'email_user',
        	photo_user:		'photo_user',
        	change_data:	'change_data',
        	login_user:		'login_user',
        	pass_old:		'pass_old',
        	pass_new:		'pass_new',
        	pass_new2:		'pass_new2',
        	change_log:		'change_log',
        	passnow:		'passnow',
        	del_user:		'del_user',
        	delete_ava:		'cl', 
        	
        	addcalend:		'addcalend',
        	namecalend:		'namecalend',
        	desccalend:		'desccalend',
        	linkcalend:		'linkcalend',       	

        	
        	close:			'.close'
		}
    },
	getinfo:   function() {
		//подгружаем скрипты календаря
		$( document.head ).append( '<link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css" rel="stylesheet">' );
		$( document.head ).append( '<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js" integrity="sha256-eGE6blurk5sHj+rmkfsGYeKyZx3M4bG+ZlFyA7Kns7E=" crossorigin="anonymous"></script>' );
		$( document.head ).append( '<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>' );
		$( document.head ).append( '<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js"></script>' );
		//$( document.head ).append( '<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/gcal.min.js"></script>' );
		
		//получаем категории недвижки и строим основные разделы
		var crmhead = '<div searcher class="crmhead">';
			crmhead += 	'<a crm="' + crm.cfg.selectors.objects + '">Объекты</a>';
			crmhead += 	'<a crm="' + crm.cfg.selectors.clients + '">Клиенты</a>';
			crmhead += 	'<a crm="' + crm.cfg.selectors.calendar + '">Календарь</a>';
			crmhead += 	'<a crm="' + crm.cfg.selectors.document + '">Документы</a>';
			crmhead += 	'<a crm="' + crm.cfg.selectors.account + '">Аккаунт</a>';
			crmhead += '</div>';
		$('#' + crm.cfg.selectors.crm ).empty().append(crmhead);
		//Объекты
		$( '[crm="' + crm.cfg.selectors.objects + '"]' ).click(function() {
			$( '.crmhead [crm]' ).removeClass('selected');
			$( '[crm="objects"]' ).addClass('selected');
			crm.objects();
		});
		//Клиенты
		$( '[crm="' + crm.cfg.selectors.clients + '"]' ).click(function() {
			$( '.crmhead [crm]' ).removeClass('selected');
			$( '[crm="clients"]' ).addClass('selected');
			crm.clients();
		});
		//Календарь
		$( '[crm="' + crm.cfg.selectors.calendar + '"]' ).click(function() {
			$( '.crmhead [crm]' ).removeClass('selected');
			$( '[crm="calendar"]' ).addClass('selected');
			//crmheadchange.bind(this);
			crm.calendar();
		});
		//Документы
		$( '[crm="' + crm.cfg.selectors.document + '"]' ).click(function() {
			$( '.crmhead [crm]' ).removeClass('selected');
			$( '[crm="document"]' ).addClass('selected');
			//crmheadchange.bind(this);
			//crm.document();
			alert('Скоро здесь появится генерация документов для каждого клиента с возможностью печати. Так же, в ближайшее время мы внедрим базу собственников по городам.<br/><br/>\
					Помогите нам стать лучше, подписывайтесь на нас ВКонтакте и расскажите, какой функционал хотели бы видеть ещё.\
					<a href="https://vk.com/otys_engine" target="_blank" style="color: #3858d8;">https://vk.com/otys_engine</a>')
		});
		//Аккаунт
		$( '[crm="' + crm.cfg.selectors.account + '"]' ).click(function() {
			$( '.crmhead [crm]' ).removeClass('selected');
			$( '[crm="account"]' ).addClass('selected');
			//crmheadchange.bind(this);
			crm.account();
		});
	},
	objects:   function() {	
		if (JSCat.category != null) {
			$('#crm > div:not(.crmhead)').remove();
			$('.' + crm.cfg.selectors.crmtop ).remove();
			var crmtop = '<div class="crmtop">';
				crmtop += 	'<select crm="' + crm.cfg.selectors.cats + '"><optgroup label="Продажа"></optgroup><optgroup label="Аренда"></optgroup></select>';
				crmtop += 	'<select crm="' + crm.cfg.selectors.users + '"><option users="0">Мои объявления</option></select>';
				crmtop += 	'<select crm="' + crm.cfg.selectors.ads + '"><option ads="all">Все объявления</option><option ads="status1">Опубликованные</option><option ads="status3">Неопубликованные</option><option ads="color">Выделенные цветом</option><option ads="premium">Премиум</option><option ads="status2">Архив</option></select>';
				crmtop += 	'<button crm="' + crm.cfg.selectors.add + '">Добавить объявление</button>';
				crmtop += 	'<button crm="' + crm.cfg.selectors.updateall + '">Обновить все</button>';
				crmtop += '</div>';
			$( '.crmhead' ).after( crmtop );
			//категории объявлений для запроса
			localStorage.ads = $( '[crm="' + crm.cfg.selectors.ads + '"] option:selected' ).attr('ads');
			//запрос категорий		
			var category = JSCat.category.split('_');
        	var json = {func:crm.cfg.url.querypanel, domain:JSCat.domain, token:JSCat.token};
				json["action"] 		= "get_category";
				$.post("/json/", json, function(catalogue) {
					if ( typeof catalogue !== 'object' ) catalogue = JSON.parse(catalogue);
					for (var prop in catalogue) {
						if ($.inArray(prop, category) != '-1') { //ебать я хакер
							if ( prop == '1' || prop == '2' || prop == '3' || prop == '4' || prop == '5' || prop == '6' || prop == '7' || prop == '8' || prop == '10' ) 
								$('optgroup[label="Продажа"]').append('<option cats="' + prop + '">' + catalogue[prop] + '</option>');
							if ( prop == '9' || prop == '11' || prop == '12' || prop == '13' || prop == '14' || prop == '15' || prop == '16' ) 
								$('optgroup[label="Аренда"]').append('<option cats="' + prop + '">' + catalogue[prop] + '</option>');
						}
					}
					//категории недвижимости для запроса
					localStorage.cats = $( '[crm="' + crm.cfg.selectors.cats + '"] option:first' ).attr('cats');
				});
				//запрос пользователей
				if (JSCat.userType == '1') {
					$('[crm="' + crm.cfg.selectors.users + '"]').append('<option users="all">Все пользователи</option>');
	        		var json = {func:crm.cfg.url.querypanel, domain:JSCat.domain, token:JSCat.token};
					json["action"] 		= "get_users";
					$.post("/json/", json, function(catalogue) {
						if (typeof catalogue !== 'object' ) catalogue = JSON.parse(catalogue);
						for (var prop in catalogue) {
							if (prop != JSCat.user && catalogue[prop] != '00') {
								var name; if (catalogue[prop] == '') {
									name = 'Без имени';
								} else name = catalogue[prop];
								$('[crm="' + crm.cfg.selectors.users + '"]').append('<option users="' + prop + '">' + name + ' (' + prop + ')</option>');
							}
						}
						//пользователи для запроса
						localStorage.users = $( '[crm="' + crm.cfg.selectors.users + '"] option:selected' ).attr('users');
					});
				}	
				//пользователи change
				$( '[crm="' + crm.cfg.selectors.users + '"]' ).change(function() {
					$( '[crm="' + crm.cfg.selectors.users + '"] option:selected' ).each(function() {
						localStorage.users = $( this ).attr( 'users' );
						crm.ads();
					});
				});
				//категории недвижимости change
				$( '[crm="' + crm.cfg.selectors.cats + '"]' ).change(function() {
					$( '[crm="' + crm.cfg.selectors.cats + '"] option:selected' ).each(function() {
						localStorage.cats = $( this ).attr( 'cats' );
						crm.ads();
					});
				});
				//категории объявлений change
				$( '[crm="' + crm.cfg.selectors.ads + '"]' ).change(function() {
					$( '[crm="' + crm.cfg.selectors.ads + '"] option:selected' ).each(function() {
						localStorage.ads = $( this ).attr( 'ads' );
						crm.ads();
					});
				});	
				//добавление объявлений
				$( '[crm="' + crm.cfg.selectors.add + '"]' ).click(function() {
					location.href = '/add';
				});	
				//Все объявления обновлены и подняты в поиске
				$( '[crm="' + crm.cfg.selectors.updateall + '"]' ).click(function() {
					var json = {func:'CPanel', domain:JSCat.domain, token:JSCat.token};
					json["action"] = "crmupdateall";
					$.post("/json/", json, function(a) {
						if (a == 'true') alert('Все объявления обновлены и подняты в поиске');
							else alert('Поднятие всех объявлений доступно один раз в сутки');
					});
					return false;
				});	
				
				crm.ads();		
				return false;
    		} else {
    		alert('Категории не указаны. Обратитесь к администратору');
    	}
		return false;
	},
	ads:   function() {
		if (JSCat.category != null) {
			$('.' + crm.cfg.selectors.crmtwo ).remove();
			$('#search_content, .call[user][list], [crm="hide"], [paginator]' ).remove();
			var userr = localStorage.ads;
			if ( userr != 'status3' && userr != 'status1' && userr != 'status2' && userr != 'color' && userr != 'premium' ) userr = localStorage.users;
			var crmtwo = '<div class="crmtwo"><input data-sorter="text" crm="search" placeholder="Поиск по тексту" />';
				crmtwo += '<select crm data-sorter="price"><option data-sort="new" selected="selected">Новые</option><option data-sort="bot">Дешевле</option><option data-sort="top">Дороже</option></select>';
        		crmtwo += '<span>Площадь</span><span>Дополнительно</span></div>';
				//crmtwo += '<span hide id="search_content" list="'+ localStorage.cats +'"></span><i class="ii" crm="hide">Параметры поиска</i>';
				crmtwo += '<div searcher class="call" user="'+ userr +'" list="'+ localStorage.cats +'" pagination="true" count="12" template="6"></div><div paginator></div>';
			$('.crmtop' ).after(crmtwo);
			//Параметры поиска
			$('[crm="hide"]').each(function(){
				var item = $(this);
				item.click(function(){
					item.toggleClass('ii');
					if (item.hasClass('ii')) {
						$('#search_content').attr('hide','');
    				} else $('#search_content').removeAttr('hide');
				});
			});
		}
	},
	account:   function() {
		if (JSCat.userType != '5') {
			$('#crm > div:not(.crmhead)').remove();
			var json = {func:crm.cfg.url.queryuser, domain:JSCat.domain, token:JSCat.token};
			json["action"] = "load_my";
			json["id"] = JSCat.user;
			$.post("/json/", json, function(result) {
				if (typeof result !== 'object' ) result = JSON.parse(result);
				
				//avatar					
				(result.avatar == 'nophoto.png' || result.avatar == '' || result.avatar == null)?
				(result.avatar = 'https://'+ JSCat.domain +'/cdn/lib/nophoto.png'):
				(result.avatar = JSCat.cdn +'/avatar/'+ result.avatar);
				
				$( '#' + crm.cfg.selectors.crm ).append('<div id="personal_data"><h4>Персональные данные</h4><span class="label">Имя</span>\
					<input id="'+ crm.cfg.selectors.name_user +'" type="text" value="'+ result.name +'"><span class="label">Телефон</span>\
					<input id="'+ crm.cfg.selectors.phone_user +'" type="text" value="'+ result.phone +'"><span class="label">Email</span>\
					<input id="'+ crm.cfg.selectors.email_user +'" type="text" value="'+ result.email +'"><span class="label">Аватар</span>\
					<span style="position:relative"><img id="'+ crm.cfg.selectors.photo_user +'" src="'+ result.avatar +'"><u class="'+ crm.cfg.selectors.delete_ava +'">×</u></span>\
					<button id="'+ crm.cfg.selectors.change_data +'">Сохранить</button></div>');
				
				$( '#' + crm.cfg.selectors.crm ).append('<div id="change_login"><h4>Изменение учетных данных</h4><span class="label">Логин</span>\
					<input id="'+ crm.cfg.selectors.login_user +'" type="text" value="'+ result.username +'">\
					<p>Чтобы пароль был надежен, он должен состоять минимум из 6 символов. Используйте прописные и строчные буквы, а также цифры и символы</p>\
					<span class="label">Старый пароль</span><input id="'+ crm.cfg.selectors.pass_old +'" type="password">\
					<span class="label">Новый пароль</span><input id="'+ crm.cfg.selectors.pass_new +'" type="password">\
					<span class="label">Новый пароль еще раз</span><input id="'+ crm.cfg.selectors.pass_new2 +'" type="password">\
					<button id="'+ crm.cfg.selectors.change_log +'">Сохранить</button>\
					<a href="/?logout">Выйти</a><a href="/?logout&logoutAll">Выйти со всех устройств</a></div>');
					
				$( '#' + crm.cfg.selectors.crm ).append('<div id="delete_user"><h4>Удаление учетной записи</h4>\
					<p>После удаления учетной записи все ваши объявления будут удалены. Если вы регулярно пользуетесь сайтом, удаление учетной записи не рекомендуется</p>\
					<span class="label">Текущий пароль</span><input type="password" id="'+ crm.cfg.selectors.passnow +'">\
					<button id="'+ crm.cfg.selectors.del_user +'">Удалить учетную запись</button></div>');
					
				//$('#balance').html(JSCat.balance);
				$( '#' + crm.cfg.selectors.change_data ).click(function() {
					var json = {func:crm.cfg.url.queryuser, domain:JSCat.domain, token:JSCat.token};
					json["action"] 	= "save_users_param";
					json["id"] 		= JSCat.user;
					json["email"] 	= $( '#' + crm.cfg.selectors.email_user ).val();
					json["phone"] 	= $( '#' + crm.cfg.selectors.phone_user ).val();
					json["name"] 	= $( '#' + crm.cfg.selectors.name_user ).val();
					$.post("/json/", json, function(result) {
						if (typeof result !== 'object' ) result = JSON.parse(result);
						if (result == 'phone') alert("Данный телефон уже занят");
						if (result == 'email') alert("Данный email уже занят");
					});
				});
				$( '#' + crm.cfg.selectors.change_log ).click(function() {
					if ($( '#' + crm.cfg.selectors.pass_new ).val() == $( '#' + crm.cfg.selectors.pass_new2 ).val()){
						var json = {func:crm.cfg.url.queryuser, domain:JSCat.domain, token:JSCat.token};
						json["action"] 		= "save_logindata_cabinet";
						json["id"] 			= JSCat.user;
						json["password"] 	= $( '#' + crm.cfg.selectors.pass_new ).val();
						json["username"] 	= $( '#' + crm.cfg.selectors.login_user ).val();
						json["oldpassword"] = $( '#' + crm.cfg.selectors.pass_old ).val();
						$.post("/json/", json, function(result) {
							if (result == 'phone') alert("Данный телефон уже занят");
							if (result == 'email') alert("Данный email уже занят");
						});
					} else alert("Новые пароли не совпадают");
				});
				$( '#' + crm.cfg.selectors.del_user ).click(function() {
					confirm({
						text:   "Данное действие необратимо, вы точно уверены что хотите удалить свою учетную запись? ",
						ok: function (){
							var json = {func:crm.cfg.url.queryuser, domain:JSCat.domain, token:JSCat.token};
							json["action"] 	= "delete_me";
							json["id"] 		= JSCat.user;
							json["password"] 	= $( '#' + crm.cfg.selectors.passnow ).val();
							$.post("/json/", json, function(result) {
								if (result == 'phone') {
									alert("Учетная запись удалена");
									setTimeout(function(){
										window.location= "/?logout"
									}, 1e3);
								} else alert("Неверный пароль");
							});
						}
					});
				});
				
				$( '#' + crm.cfg.selectors.phone_user ).mask("+7 (999) 999-99-99");
				$( '#' + crm.cfg.selectors.photo_user ).click(function() {
					lib("image", {content:"#page"});
				});
				
				$( '.' + crm.cfg.selectors.delete_ava ).click(function() {
					var json = {func:crm.cfg.url.queryuser, domain:JSCat.domain, token:JSCat.token};
					json["action"] = "del_avatar";
					json["id"] = JSCat.user;
					$.post("/json/", json, function(result) {
						if (result) $('#photo_user').attr('src','https://' + JSCat.domain + '/cdn/lib/nophoto.png');
					});
				});
				
				
			});
		}
	},
	clients:   function() {
		$('#crm > div:not(.crmhead)').remove();
		var crmtwo = '<div class="crmtwo"><input crm="search" placeholder="Поиск по тексту" /><span>Параметры</span></div>';
			//crmtwo += '<span hide id="search_content" list="'+ localStorage.cats +'"></span><i class="ii" crm="hide">Параметры поиска</i>';
			crmtwo += '<div class="call" user="all" list="17" pagination="true" count="20" template="6"></div><div paginator></div>';
		$( '.crmhead' ).after( crmtwo );
		
	},
	calendar:   function() {
		$('#crm > div:not(.crmhead)').remove();
		
		//подгружаем локаль календаря
		$.when(
			$.getScript( 'https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/locale/ru.js' ),
			$.Deferred(function( deferred ) {
				$( deferred.resolve );
			})
		).done(function() {
			
			var calend = '<div id="external-events">';
				calend += 	'<div class="fc-event ui-draggable ui-draggable-handle red">Новая встреча</div>';
				calend += 	'<div class="fc-event ui-draggable ui-draggable-handle green">Новый объект</div>';
				calend += 	'<div class="fc-event ui-draggable ui-draggable-handle blue">Новый клиент</div>';
				calend += '</div>';
				calend += '<div id="calendar"></div>';
			$( '.crmhead' ).after( calend );
			
			//запрашиваем события юзера из бд
        	var json = {func:crm.cfg.url.querypanel, domain:JSCat.domain, token:JSCat.token, user:JSCat.user};
				json["action"] 		= "get_calendar";
			$.post("/json/", json, function(result) {
			if ( typeof result !== 'object' ) result = JSON.parse(result);
			if ( result )
				for (var i=0; i < result.length; i++) {
				 	for (var a in result[i]) {
						if (a == 'start') result[i].start = new Date(result[i].start * 1000).toISOString();
					}
				}
				
				//инициализируем типы событий
				$('#external-events .fc-event').each(function() {
					$(this).data('event', {
						title: $.trim($(this).text()),
						stick: true
					});
					$(this).draggable({
						zIndex: 999,
						revert: true, 
						revertDuration: 0
					});
				});
				
				//инициализируем события календаря
				$('#calendar').fullCalendar({
					header: {
						center: 'title',
						left: 'prev,next, today',
						right: 'month,agendaWeek,agendaDay,listWeek'
					},
					timezone: 'local',
					eventResourceEditable: true,
					buttonIcons: true,
					eventLimit: true,
					navLinks: true,
					editable: true,
					droppable: true,
					drop: function(date, jsEvent, ui, resourceId) {
						//console.log(jsEvent)
        				//новый объект в базу
        				var timer = Date.parse(date.format()) / 1000;
						var json = {func:crm.cfg.url.querypanel, domain:JSCat.domain, token:JSCat.token, user:JSCat.user};
							json["action"] 	= "new_calendar";
							json["start"] 	= timer;
							json["title"] 	= jsEvent.target.innerText;
						$.post("/json/", json, function(result) {
							crm.calendar();
						});
      				},
					eventDrop: function(event, delta, revertFunc) {
					console.log(event)
						//меняем день при перетаскивании
 						var timer = Date.parse(event.start.format()) / 1000;
						var json = {func:crm.cfg.url.querypanel, domain:JSCat.domain, token:JSCat.token, user:JSCat.user};
							json["action"] 	= "update_calendar";
							json["title"] 	= event.title;
							json["link"] 	= event.link;
							json["description"] = event.description;
							json["start"] 	= timer;
							json["id"] 		= event.id;
						$.post("/json/", json, function(result) {
							crm.calendar();
						});
					},
					eventClick: function(calEvent, jsEvent, view) {
						//инициализируем клики по событиям
 						var timer = Date.parse(calEvent.start.format()) / 1000;
						var timeobj = util.timeObject(timer);

						var addfrm = '<alert id="alert">';
							addfrm += '<div class="calendalert"><p>'+ calEvent.title +'</p>';
							addfrm += '<div><span>'+ timeobj.date +'</span><b>'+ timeobj.month +'</b><select hours><option value="0">00</option>';
							addfrm += '<option value="1">01</option><option value="2">02</option><option value="3">03</option><option value="4">04</option><option value="5">05</option><option value="6">06</option>';
							addfrm += '<option value="7">07</option><option value="8">08</option><option value="9">09</option><option value="10">10</option><option value="11">11</option><option value="12">12</option>';
							addfrm += '<option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option>';
							addfrm += '<option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option></select>&nbsp;:&nbsp;';
							addfrm += '<select minutes><option value="0">00</option><option value="10">10</option><option value="20">20</option><option value="30">30</option><option value="40">40</option><option value="50">50</option></select></div>';
							addfrm += '<div><input id="'+ crm.cfg.selectors.namecalend +'" value="'+ calEvent.title +'" placeholder="Название" type="text" />';
							addfrm += '<textarea id="'+ crm.cfg.selectors.desccalend +'" placeholder="Описание">'+ calEvent.description +'</textarea>';
							addfrm += '<input id="'+ crm.cfg.selectors.linkcalend +'" value="'+ calEvent.link +'" placeholder="Ссылка" type="text" />';
							addfrm += '<button id="'+ crm.cfg.selectors.addcalend +'">Сохранить</button></div><div></alert>';
						$( document.body ).append( addfrm );
						
						$( 'select[hours] option[value="'+ timeobj.hours +'"]' ).attr( 'selected','selected' );
						$( 'select[minutes] option[value="'+ timeobj.minutes +'"]' ).attr( 'selected','selected' );
						
						$('#' + crm.cfg.selectors.addcalend ).click(function(){
							var hr = $( 'select[hours] option:selected' ).val();
							var min = $( 'select[minutes] option:selected' ).val();
							var timer = timeobj.date +' '+ timeobj.emonth +' '+ timeobj.year +' '+ hr +':'+ min;
								timer = Date.parse(timer)  / 1000;
	
							var json = {func:crm.cfg.url.querypanel, domain:JSCat.domain, token:JSCat.token, user:JSCat.user};
								json["action"] 		= "update_calendar";
								json["start"] 		= timer;
								json["id"] 			= calEvent.id;
								json["title"] 		= $('#' + crm.cfg.selectors.namecalend).val();
								json["link"] 		= $('#' + crm.cfg.selectors.linkcalend).val();
								json["description"] = $('#' + crm.cfg.selectors.desccalend).val();
								//json["allday"] 		= "";
							$.post("/json/", json, function(result) {
								$( document.body ).find( '#alert' ).remove();
								crm.calendar();
							});
						});
					},
					events: result
				});	
			});
		});
	}
}

$(function() {
	crm = new crm();
	crm.getinfo();
});
