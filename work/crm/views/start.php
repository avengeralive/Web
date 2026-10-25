<!DOCTYPE html>
<html lang="ru">
	<head>
		<title>Личный кабинет</title>
		<meta name=viewport content="width=device-width, initial-scale=1">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link rel="icon" href="/cdn/lib/0.png"  type="image/x-icon">
		<link rel="stylesheet" href="/css/crm.css">
		<link rel="stylesheet" href="/css/bootstrap.css">
		<link rel="stylesheet" href="/css/bootstrap-theme.css">
		<script type="application/javascript">const JSCat = Object.freeze(<?=json_encode($JSCat)?>);</script>
		<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="crossorigin="anonymous"></script>
		<script type="text/javascript" src="/js/general.js?v2"></script>
		<script type="text/javascript" src="/js/lib.crm.js?v6"></script>
		<script type="text/javascript" src="/js/bootstrap.min.js"></script>
		<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js" integrity="sha256-eGE6blurk5sHj+rmkfsGYeKyZx3M4bG+ZlFyA7Kns7E=" crossorigin="anonymous"></script>
		<?php if ($uri == 'calendar') { echo '<script src="/js/moment.js"></script>
		<script src="/js/fullcalendar.js"></script>
		<script src="/js/ru.js"></script>'; } ?>
		<script type="text/javascript" src="/js/jssip-3.3.6.min.js"></script>
<!-- 
		<script>
			var socket = new JsSIP.WebSocketInterface('wss://217.174.178.108');
			var configuration = {
			  sockets  : [ socket ],
			  uri      : 'sip:0780100001003@217.174.178.108',
			  password : 'JMb6ffxl9Z'
			};
			var coolPhone = new JsSIP.UA(configuration);
			coolPhone.start();
		</script>
 -->
	</head>

	<body page="<?=$uri?>">
		<div class="navbar navbar-default navbar-fixed-top" role="navigation">
			<div class="container" style="width: 100vw;">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="#">CRM</a>
				</div>
				<div class="navbar-collapse collapse">
					<ul class="nav navbar-nav">
						<li><a href="/partner">Заказы</a></li>
						<li roles="admin tech"><a href="/operators">Операторы</a></li>
<!-- 
						<li class="dropdown">
						  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Операторы <b class="caret"></b></a>
						  <ul class="dropdown-menu">
						    <li><a href="/operators">Список операторов</a></li>
<!~~ 
						    <li><a href="/operatorinvite">Пригласить операторов</a></li>
						    <li class="divider"></li>
						    <li class="divider"></li>
 ~~>
						    <li><a href="/operatorsettings">Настройки для операторов</a></li>
						    <li><a href="/operatorscripts">Скрипты для операторов</a></li>
						  </ul>
						</li>
 -->
						<li roles="admin tech" class="dropdown">
						  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Статистика <b class="caret"></b></a>
						  <ul class="dropdown-menu">
						    <li><a href="/statconversion">Конверсии</a></li>
						    <li><a href="/statoperators">По операторам</a></li>
						    <li><a href="/statbuyout">По выкупаемости</a></li>
						    <li><a href="/statgeo">По географии</a></li>
						  </ul>
						</li>
						<li roles="admin tech"><a href="/goods">Товары</a></li>
						<li roles="admin tech" class="dropdown">
						  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Настройки <b class="caret"></b></a>
						  <ul class="dropdown-menu">
								<li><a href="/configcommon">Общие</a></li>
<!-- 
								<li class="divider"></li>
 -->
								<li><a href="/statuses">Статусы</a></li>
<!-- 
								<li><a href="/configcrm">Настройки CRM</a></li>
 -->
<!-- 
								<li class="divider"></li>
 -->
<!-- 
								<li><a href="/configupsell">Форма уточнения заказа/апсела</a></li>

								<li class="divider"></li>
								<li><a href="/dadata">Сервис «DaData.ru»</a></li>
								<li><a href="/antispam">Антиспам</a></li>
								<li><a href="/api">API</a></li>
 -->

								<li><a href="/fields">Конструктор полей</a></li>
								<li><a href="/configdiscount">Управление скидками</a></li>
								<li class="divider"></li>
								<li><a href="/configcrm">Массовая загрузка заказов из Excel-файла</a></li>
								<li class="divider"></li>
								<li><a href="/russianpost">Почта России</a></li>
								<li><a href="/russianpostapi">Онлайн-сервис «Отправка»</a></li>
								<li><a href="/russianpostblanks">Персональные бланки</a></li>
<!-- 
								<li><a href="/postback">Postback</a></li>
 -->
								<li><a href="/api">API</a></li>
							</li>
						</li>
					</ul>
				</li>
						<li class="dropdown" roles="admin tech">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">Робот <b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><a href="/pbxtemplate">Шаблоны для робота</a></li>
								<li><a href="/pbxrules">Правила Робо-прозвона</a></li>
								<li class="divider"></li>
								<li><a href="/pbxcrm">Запланированные звонки робота</a></li>
								<li><a href="/pbxhistory">История звонков робота</a></li>
								<li class="divider"></li>
								<li><a href="/smstemplate">Шаблоны SMS</a></li>
								<li><a href="/smshistory">История SMS</a></li>
								<li class="divider"></li>
								<li><a href="/pbx">Телефония</a></li>
								<li><a href="/pbxcalls">История звонков</a></li>
<!-- 
								<li><a href="/pbxqueue">Предиктивный набор</a></li>
								<li><a href="/smsauto">Авто-уведомления</a></li>
								<li><a href="/pbxinbound">Входящие вызовы</a></li>
								<li><a href="/pbxback">Callback</a></li>
								<li><a href="/smsproviders">Провайдеры</a></li>
 -->

							</ul>
						</li>
					</ul>
					<ul roles="admin" class="nav navbar-nav navbar-right">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">Админ <b class="caret"></b></a>
							<ul class="dropdown-menu">
<!-- 
								<li><a href="/">Проект</a></li>
 -->
								<li><a href="/crm">Модерация</a></li>
								<li><a href="/catalogue">Справочники</a></li>
<!-- 
								<li><a href="/leads">Клиенты и сделки</a></li>
 -->
								<li><a href="/analytics">Статистика Проекта</a></li>
<!-- 
								<li><a href="/settings">Настройки Проекта</a></li>
 -->
<!-- 
								<li><a href="/template">Шаблон Проекта</a></li>
 -->
<!-- 
								<li><a href="/modules">Модули Проекта</a></li>
 -->
								<li class="divider"></li>
<!-- 
								<li><a href="/calendar">Календарь</a></li>
 -->
								<li><a href="/roles">Пользователи и роли</a></li>
								<li><a href="/files">Диспетчер файлов</a></li>
								<li class="divider"></li>
								<li><a href="/?logout">Выход</a></li>
							</ul>
						</li>
			    	</ul>
				</div>
			</div>
    	</div>
		<div class="container" style="margin-top: 60px;width: 100vw;" id="cabinet">
			<?php include_once('./views/'. $uri .'.php');?>
		</div>
<!-- 
		<script type="text/javascript" src="/js/crm.js?v4"></script>
 -->
		<!--script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/gcal.min.js"></script-->
		<script type="text/javascript" src="/js/codemirror.js"></script>
		<script type="text/javascript" src="/js/photobox.js"></script>
<!-- 
		<?php if ($uri == 'write') { echo '<script type="text/javascript" src="/js/dante.js"></script>'; } ?>
 -->

<!-- 
	<link href="https://cdn.jsdelivr.net/npm/suggestions-jquery@19.4.2/dist/css/suggestions.min.css" rel="stylesheet" />
	<script src="https://cdn.jsdelivr.net/npm/suggestions-jquery@19.4.2/dist/js/jquery.suggestions.min.js"></script>
 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js"></script>

		<script>
			setTimeout(() => {
			
// $('#selectGoods').selectize({
//     plugins: ['remove_button'],
//     persist: false,
//     create: false,
//     render: {
//         item: function(data, escape) {
//             return '<div>"' + escape(data.text) + '"</div>';
//         }
//     },
//     onDelete: function(values) {
//         return confirm(values.length > 1 ? values.length + ' элементов будут удалены, продолжить?' : '"' + values[0] + '" будет удален, продолжить?');
//     }
// });
				
// 				$("#email, .email").suggestions({
// 					token: "ea3d023b4de3ee8ac57dc680ada661883e64e9d2",
// 					type: "EMAIL",
// 					onSelect: function(suggestion) {
// 						console.log(suggestion);
// 					}
// 				});
			}, 2000)
		</script>
		<?php if ($uri == 'write') { echo '<link rel="stylesheet" href="/css/dante.css">'; } ?>
		<?php if ($uri == 'analytics') { echo '<script type="text/javascript" src="/js/chart.js"></script>'; } ?>
		<?php if ($uri == 'settings') { echo '<script type="text/javascript" src="/js/colorpicker.js"></script>'; } ?>
</body>
</html>
