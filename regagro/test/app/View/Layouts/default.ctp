<?php
$user = $this->Session->read('Auth.User');
?>
<!DOCTYPE html>
<html lang="ru">
	<head>
		<meta charset="utf-8">
		<title>
			ЛВСЭ - <?php echo $title_for_layout; ?>
		</title>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="stylesheet" href="/css/bootstrap.min.css">
		<link rel="stylesheet" href="/css/selectize.css">
		<link rel="stylesheet" href="/css/selectize.bootstrap3.css">
		<link rel="stylesheet" href="/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css">		
		
		<?php if(!empty($user)) { 
			echo '<link rel="stylesheet" href="/css/regagronew.css?v1">';
		} else {
			echo '<link rel="stylesheet" href="/css/regagro.css?v1">';
		} ?>

		<script src="/js/jq1_10_2_bs3_2_0.js"></script>
		<script src="/js/selectize.min.js"></script>
		<script src="/js/moment.min.js"></script>
		<script src="/js/moment.ru.js"></script>
		<script src="/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
		<script src="/js/jquery.tablesorter.min.js"></script>
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	   <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	   <!--[if lt IE 9]>
	      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	   <![endif]-->
		<?php
			echo $this->fetch('meta');
			echo $this->fetch('css');
		?>
	</head>

	<body>
		<?php if(!empty($user)) { 
			echo '<div class="start">
				<ul id="gn-menu" class="gn-menu-main">
					<li class="gn-trigger">
						<a class="gn-icon gn-icon-menu"><span>Меню</span></a>
						<nav class="gn-menu-wrapper">
							<div class="gn-scroller">
								<ul class="gn-menu">
									<li><a href="/registrations"><img alt src="/img/journal.svg">Журнал</a></li>
									<li><a href="/registrations/reports"><img alt src="/img/reports.svg">Отчеты</a></li>
									<li><a href="/plans"><img alt src="/img/plans.svg">План</a></li>';
            					if (AuthComponent::user('role') == 'Администратор') echo '
									<li><a href="/registrationsup"><img alt src="/img/journal.svg"><span>Убойные пункты (Журнал)</span></a></li>
									<li><a href="/users"><img alt src="/img/users.svg"><span>Пользователи</span></a></li>
									<li>
										<a href="/pages/lists"><img alt src="/img/lists.svg">Справочники</a>
										<ul class="gn-submenu">
											<li><a href="/regions"><img alt src="/img/info.svg">Регионы/районы</a></li>
											<li><a href="/organs"><img alt src="/img/info.svg">Органы управления ветеринарии</a></li>
											<li><a href="/institutions"><img alt src="/img/info.svg">Учреждения ветеринарии</a></li>
											<li><a href="/labs"><img alt src="/img/info.svg">Лаборатории ЛВСЭ</a></li>
											<li><a href="/up"><img alt src="/img/info.svg">Убойные пункты</a></li>
											<li><a href="/vetlabs"><img alt src="/img/info.svg">Ветеринарные лаборатории</a></li>
											<li><a href="/production_types"><img alt src="/img/info.svg">Виды продукции</a></li>
											<li><a href="/productions"><img alt src="/img/info.svg">Продукция</a></li>
											<li><a href="/report_productions"><img alt src="/img/info.svg">Продукция (отчет)</a></li>
											<li><a href="/ban_reasons"><img alt src="/img/info.svg">Причины обезвреживания (снятия с реализации)</a></li>
											<li><a href="/report_ban_reasons"><img alt src="/img/info.svg">Причины обезвреживания (отчет)</a></li>
											<li><a href="/ban_types"><img alt src="/img/info.svg">Снято с реализации</a></li>
											<li><a href="/report_ban_types"><img alt src="/img/info.svg">Снято с реализации (отчет)</a></li>
											<li><a href="/sample_purposes"><img alt src="/img/info.svg">Цель отбора проб</a></li>
											<li><a href="/detections"><img alt src="/img/info.svg">Выявления</a></li>
											<li><a href="/report_detections"><img alt src="/img/info.svg">Выявления (отчет)</a></li>
											<li><a href="/detection_types"><img alt src="/img/info.svg">Виды выявлений</a></li>
											<li><a href="/research_types"><img alt src="/img/info.svg">Исследования</a></li>
											<li><a href="/report_researches"><img alt src="/img/info.svg">Исследования (отчет)</a></li>
										</ul>
									</li>';
									echo '
								</ul>
							</div>
						</nav>
					</li>
					<li class="selecttwo" style="display:none">';
						/*if (count($user['labs']) > 1 && AuthComponent::user('role') == 'Администратор') {
							echo $this->Form->create('User', [
								'url'=>'/app/changeLab',
								'type'=>'get',
								'inputDefaults' => [
									'div' => 'form-group',
									'wrapInput' => false,
									'class' => 'form-control cities',
									'label' => false
								],
			   	         'class' => 'form-inline'
							]);
							echo $this->Form->input('lab_id', ['options'=>$user['labs'],'default' => $user['lab_id']]);
							echo $this->Form->submit('Сменить', array(
								'div' => 'form-group',
								'class' => 'btn btn-default'
							));
							echo $this->Form->end();
						} else {
							echo '<a href="/"><img alt src="/img/logo.svg"><strong>Лаборатория ветсанэкспертизы (ЛВСЭ)<b>'. $user['labs'][$user['lab_id']] .'</b></strong></a>';

						}*/
						echo '
					</li>
					<li><a class="login">'.$user['displayname'].' ['.$user['role'].']</a></li>
					<li>'.$this->Html->link('ВЫХОД', array(
								'controller' => 'users',
								'action' => 'logout')).'
					</li>
				</ul>
			</div>
			<div class="container" style="margin-top: 60px;">
				<section id="alerts">';
					echo $this->Session->flash('success');
					echo $this->Session->flash('info'); 
					echo $this->Session->flash('warning'); 
					echo $this->Session->flash('danger'); 
					echo '
				</section>
				<div class="row crumbs">
				<div class="crumb">';
					echo $this->Html->getCrumbs(' » ', 'Главная');
					echo '
				</div>
				</div>';
					echo $this->fetch('content'); //content
					echo '
			</div>
			<script src="/js/gnmenu.js"></script>
			<script>new gnMenu( document.getElementById( "gn-menu" ) )</script>';
			echo $this->fetch('script');
			if (class_exists('JsHelper') && method_exists($this->Js, 'writeBuffer')) echo $this->Js->writeBuffer();
      } else {
      	echo '<header class="wrap">
				<div class="row user-info">
					<div class="login">
						'.$this->Html->link('Вход в систему', array(
						'controller' => 'users',
						'action' => 'login'
						)).'
					</div>
				</div>
				<div class="header-middle">
					<hr class="header-line">
					<div class="wrap">
						<div class="col-sm-3" style="z-index:1;">
							<a class="header-logo" href="/">
								<img src="/img/regagro/logo.png" alt="">
							</a>
						</div>
						<div class="col-sm-9" style="z-index:100;">
							<h2 class="txt">';
								echo $this->Html->link('НАЦИОНАЛЬНАЯ СИСТЕМА УЧЕТА И РЕГИСТРАЦИИ ЖИВОТНЫХ', array(
									'controller' => 'pages',
									'action' => 'home'
								)); 
								echo '
							</h2>
							<div class="wrap">
								<div class="small-menu row">';	
									if (isset($userActions)) {
										foreach ($userActions as $a) {
											echo '<div class="col-sm-3">'.$this->Html->link($a['title'], $a['url'], ['class'=>'btn btn-block btn-primary']).'</div>';
										}
									}
									echo '
								</div>
							</div>
						</div>
					</div>
				</div>
			</header>
			<div>
				<section id="alerts">';
					echo $this->Session->flash('success');
					echo $this->Session->flash('info'); 
					echo $this->Session->flash('warning'); 
					echo $this->Session->flash('danger'); 
					echo '
				</section>';
					echo $this->fetch('content'); //content
					echo '
			</div>';
			echo $this->fetch('script');
			if (class_exists('JsHelper') && method_exists($this->Js, 'writeBuffer')) echo $this->Js->writeBuffer();
	} ?>
</body>
</html>
