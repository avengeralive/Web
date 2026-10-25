<?php 
   $offer = 69;
   include_once $_SERVER['DOCUMENT_ROOT'].'/../includes/landingsData/index2.php';
?>
<!DOCTYPE html>
<html lang="ru">

<head>

	<meta charset="utf-8">

	<title>Dyson</title>
	<meta name="description" content="Dyson">

	<meta name="viewport" content="width=device-width">

	<link rel="icon" href="img/favicon.png">
	<meta property="og:image" content="img/@1x/logo.svg">
	
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.3.1/css/swiper.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.0.0/magnific-popup.min.css">
	<link rel="stylesheet" href="css/styles.min.css">

	<link rel="stylesheet" type="text/css" href="http://giis.co.in/jsfiles/jquery.countdown.css">

</head>

<body>

	<header style="position: sticky; top: 0; z-index: 1000;">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-2 col-md-1 d-none d-lg-block">
					<div class="logo">
						<img src="img/_src/logo.svg" class="img-responsive" alt="">
					</div>
				</div>
				<div class="col-sm-12 col-lg-8 col-xl-6"> <!--col-sm-10 col-md-7 col-xl-6 -->
					<nav class="navbar navbar-expand-lg navbar-dark sticky-top">
						<!-- <a class="navbar-brand" href="#">Navbar</a> -->
						<img src="img/_src/logo.svg" class="img-responsive navbar-brand d-lg-none d-sm-block" alt="">
						<!-- Toggler/collapsibe Button -->
						<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
							<span class="navbar-toggler-icon"></span>
						</button>
						<div class="collapse navbar-collapse" id="collapsibleNavbar">
							<ul class="menu navbar-nav">
								<li class="nav-item"><a href="#3-section" class="nav-link btn-menu-1" >Характеристика</a></li>
								<li class="nav-item"><a href="#8-section" class="nav-link btn-menu-2" >Преимущества</a></li>
								<li class="nav-item"><a href="#11-section" class="nav-link btn-menu-3" >Преимущества</a></li>
								<li class="nav-item"><a href="#9-section" class="nav-link btn-menu-4" >Советы по укладке</a></li>
							</ul>
						</div>
					</nav>
				</div>
				<div class="d-none d-lg-block col-md-2 offset-md-1 col-xl-1 offset-xl-4" style="padding-right: 0px;">
					<a href="#form_buy" class="btn">Заказать</a>
				</div>
			</div>
		</div>
	</header>
	<main>
		<section class="first-section">
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-4 col-md-6 offset-md-1">
						<h1>Dyson Supersonic</h1>
						<p>Лимитированная подарочная коллекция Фен Dyson Supersonic</p>
						<div class="form">
							<div style="display:flex; flex-wrap:wrap; justify-content:space-between;">
								<p class="title-form"><span>заказать</span>Фен</p>
								<p class="price"><?php echo $price['real_price']*1; ?><img src="img/_src/rub.svg" alt="rub"><span>6980<img src="img/_src/rub.svg" alt="rub"></span></p>
							</div>
							
							<div class="timer">
								<p>Акция закончится через:</p>
								
								<div class="clock">
									<!-- <div class="column days">
										<div class="timer" id="days"></div>
										<div class="text">DAYS</div>
									</div>
									<div class="timer days">:</div> -->
									<div class="column">
										<div class="timer" id="hours"></div>
										<!-- <div class="text">HOURS</div> -->
									</div>
									<div class="timer">:</div>
									<div class="column">
										<div class="timer" id="minutes"></div>
										<!-- <div class="text">MINUTES</div> -->
									</div>
									<div class="timer">:</div>
									<div class="column">
										<div class="timer" id="seconds"></div>
										<!-- <div class="text">SECONDS</div> -->
									</div>
								</div>
								<h2><span class="sub-message"></span></h2>
							</div>
							<p class="descr">Заполните форму, чтобы оформить заказ</p>
							<form action="./_success_/" method="post">
								<div>
									<input type="text" name="name" placeholder="Ваше имя" required>
								</div>
								<div>
									<input type="text" name="phone" placeholder="Ваш телефон" required>
								</div>
								<button type="submit">Оформить заказ</button> 
								<input type='hidden' name='referer' value="<?php echo isset($_GET['referer']) ? $_GET['referer'] : $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] ;?>">
								<input type="hidden" name="subid1"  value="<?php echo isset($_GET['subid1']) ? $_GET['subid1'] : '' ;?>" />
								<input type="hidden" name="subid2"  value="<?php echo isset($_GET['subid2']) ? $_GET['subid2'] : '' ;?>" />
								<input type="hidden" name="subid3"  value="<?php echo isset($_GET['subid3']) ? $_GET['subid3'] : '' ;?>" />
								<input type="hidden" name="subid4"  value="<?php echo isset($_GET['subid4']) ? $_GET['subid4'] : '' ;?>" />  
								<input type="hidden" name="subid5"  value="<?php echo isset($_GET['subid5']) ? $_GET['subid5'] : '' ;?>" />
								
							</form>
						</div>
					</div>
				</div>
			</div>
		</section>
		<section class="second-section">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-6 offset-md-1">
						<p class="title">Лимитированная подарочная коллекция Фен <span>Dyson Supersonic <sup>TM</sup></span>с набором фирменных расчесок</p>
						<p class="descr">В подарочный набор входит фен для волос Dyson Supersonic (фуксия) и две фирменные расчески: гребень с редкими зубцами, разработанный для комфортного расчесывания даже влажных волос, и большая массажная щетка, предназначенная для разглаживания волос во время высушивания.</p>
						<div class="row">
							<div class="col-md-5">
								<a href="#form_buy" class="btn order-btn">Заказать</a>
							</div>
						</div>
					</div>
					<div class="col-md-5 d-none d-md-block">
						<img src="img/_src/product-image-1.png" class="img-responsive" alt="product-image-1">
					</div>
				</div>
			</div>
		</section>
		<section class="third-section" id="3-section">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-3 offset-md-1">
						<p class="title">Большая массажная щетка <span>Dyson</span></p>
						<ul>
							<li class="descr">Большая рабочая поверхность для удобства расчесывания.</li>
							<li class="descr">Зубчики расположены на воздушной подушке обеспечивая деликатный контакт с кожей головы.</li>
							<li class="descr">Металлическая ручка цвета фуксии с нескользящей высококачественной отделкой.</li>
						</ul>
					</div>
					<div class="col-md-4 col-8 ml-auto mr-auto">
						<img src="img/_src/product-image-2.png" alt="product-image-2" class="img-responsive">
					</div>
					<div class="col-md-4">
						<p class="title">Гребень<span>Dyson</span> с редкими зубцами</p>
						<ul>
							<li class="descr">Широкая рукоять и расположение зубьев обеспечивают удобство в использовании.
							</li>
							<li class="descr">Разработан для долгосрочного ежедневного использования.</li>
							<li class="descr">Большие закругленные кончики зубьев позволяют равномерно распределять давление, что обеспечивает деликатный контакт с кожей головы.</li>
							<li class="descr">Широкие и гладкие зубья. Предназначены для легкого скольжения по влажным или сухим волосам, бережного расчесывания с минимальным трением.</li>
							<li class="descr">Степень гибкости зубьев была точно рассчитана для комфортного расчесывания волос.</li>
						</ul>
					</div>
				</div>
			</div>
		</section>
		<section class="fourth-section">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-6 ml-auto mr-auto">
						<h2 class="title">Выберите свой <span>Dyson Supersonic<sup>TM</sup></span></h2>
					</div>
				</div>
				<div class="row" style="padding-bottom: 20px; border-bottom: 1px solid #969696">
					<div class="col-md-2 ml-auto mr-auto d-flex flex-row justify-content-around">
						<div class="color-1"><img src="img/_src/color-1.png" class="img-responsive" alt="color-1"></div>
						<div class="color-2"><img src="img/_src/color-2.png" class="img-responsive" alt="color-2"></div>
						<div class="color-3"><img src="img/_src/color-3.png" class="img-responsive" alt="color-3"></div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-3 offset-md-1">
						<p class="title">С набором фирменных расчесок</p>
						<p class="price"><?php echo $price['real_price']*1; ?><img src="img/_src/rub.svg" alt="rub"></p>
						<a href="#form_buy" class="btn order-btn">Заказать</a>
					</div>
					<div class="col-md-2">
						<img src="img/@2x/choice/1-color/1-img.png" class="img-responsive item-color" id="el-0" style="margin: 40px auto 0" alt="">
						<p class="subdescr subdescr-top">Dyson Supersonic<sup>TM</sup> С набором фирменных расчесок</p>
					</div>
					<div class="col-md-6">
						<div class="container-fluid" style="padding: 0 20px;">
							<div class="row" style="margin-top: 40px">
								<div class="col-md-4">
									<div class="item" id="el-1">
										<div class="item-color-1-img-1" ></div>
										<p class="subdescr">Насадка для создания направленного потока</p>
									</div>
								</div>
								<div class="col-md-4">
									<div class="item" id="el-2">
										<div class="item-color-1-img-2" ></div>
										<p class="subdescr">Насадка-концентратор</p>
									</div>
								</div>
								<div class="col-md-4">
									<div class="item" id="el-3">
										<div class="item-color-1-img-3" ></div>
										<p class="subdescr">Диффузор</p>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-4">
									<div class="item" id="el-4">
										<div class="item-color-1-img-4" ></div>
										<p class="subdescr">Нескользящий коврик</p>
									</div>
								</div>
								<div class="col-md-4">
									<div class="item" id="el-5">
										<div class="item-color-1-img-5" ></div>
										<p class="subdescr">Петля для хранения</p>
									</div>
								</div>
								<div class="col-md-4">
									<div class="item" id="el-6">
										<div class="item-color-1-img-6" ></div>
										<p class="subdescr">Гребень с редкими зубцами</p>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-4">
									<div class="item" id="el-7">
										<div class="item-color-1-img-7" ></div>
										<p class="subdescr">Большая массажная щетка Dyson</p>
									</div>
								</div>
							</div>
						</div>
						
					</div>
				</div>
			</div>

			<div class="consult">
				<div class="container-fluid">
					<div class="row d-flex align-items-center">
						<div class="col-md-4 d-flex align-items-center">
							<h1>Заказать консультацию</h1>
						</div>
						<div class="col-md-8">
							<form action="./_success_/" method="post">
								<div>
									<input type="text" name="name" placeholder="Ваше имя" required>
								</div>
								<div>
									<input type="text" name="phone" placeholder="Ваш телефон" required>
								</div>
								<button type="submit">Консультация</button> 
								<input type='hidden' name='referer' value="<?php echo isset($_GET['referer']) ? $_GET['referer'] : $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] ;?>">
								<input type="hidden" name="subid1"  value="<?php echo isset($_GET['subid1']) ? $_GET['subid1'] : '' ;?>" />
								<input type="hidden" name="subid2"  value="<?php echo isset($_GET['subid2']) ? $_GET['subid2'] : '' ;?>" />
								<input type="hidden" name="subid3"  value="<?php echo isset($_GET['subid3']) ? $_GET['subid3'] : '' ;?>" />
								<input type="hidden" name="subid4"  value="<?php echo isset($_GET['subid4']) ? $_GET['subid4'] : '' ;?>" />  
								<input type="hidden" name="subid5"  value="<?php echo isset($_GET['subid5']) ? $_GET['subid5'] : '' ;?>" />
							</form>
						</div>
					</div>
				</div>
			</div>
		</section>
		<section class="fifth-section">
			<div class="continer-fluid">
				<div class="row">
					<div class="col-md-11 offset-md-1">
						<img src="img/_src/logo-5-section.svg" class="logo"alt="logo-5-section">
					</div>
					<div class="col-md-5 offset-md-1">
						<p>Быстрое высушивание волос. Без экстремальных температур. Разработан для различных типов волос</p>
					</div>
				</div>
			</div>
		</section>
		<section class="sixth-section">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-3 offset-md-1">
						<p class="title">Мощный и Быстрый</p>
					</div>
				</div>
				<div class="row">
					<div class="col-md-3 offset-md-1">
						<p class="descr">Компактный, легкий и быстрый. Двигатель с цифровым управлением Dyson V9 является сердцем наших технологий по уходу за волосами.13-лопастная крыльчатка его импеллера вращается со скоростью 110 000 оборотов в минуту, нагнетая в усилитель 13 литров воздуха в секунду.</p>
					</div>
				</div>
			</div>
		</section>
		<section class="seventh-section">
			<div class="container-fluid">
				<div class="row">
					<div class="col-sm-7 ml-auto mr-auto">
						<p class="title">Усовершенствован для различных типов волос</p>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-8 ml-auto mr-auto">
						<p class="descr">По результатам тестирований различных типов волос, проведенных в наших лабораториях, были разработаны новые насадки для различных типов волос. Поскольку мы постоянно улучшаем наши устройства, мы улучшили также диффузор и насадку-концентратор.</p>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-3 ml-auto">
						<img src="img/@2x/7-section/photo-7-1.png" class="img-responsive" alt="photo-7-1">
					</div>
					<div class="col-sm-3 ml-auto mr-auto">
						<img src="img/@2x/7-section/photo-7-2.png" class="img-responsive" alt="photo-7-2">
					</div>
					<div class="col-sm-3 mr-auto">
						<img src="img/@2x/7-section/photo-7-3.png" class="img-responsive" alt="photo-7-3">
					</div>
				</div>
			</div>
		</section>
		<section class="eighth-section" id="8-section">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-4 ml-auto mr-auto">
						<p class="title">Магнитные насадки</p>
					</div>
				</div>
				
				<div class="swiper-container thumbs">
					<div class="swiper-wrapper">
						<div class="swiper-slide">
							<p class="title">Насадка-концентратор</p>
							<p class="descr">Более широкий и зауженный профиль помогают создать высокоскоростной концентрированный поток воздуха, который идеально подходит для укладки и стайлинга. Благодаря концентрированному потоку воздуха вы можете формировать каждый локон в отдельности, не затрагивая другие пряди.</p>
							<img src="img/_src/magnet/magnet-img-1.png" class="img-responsive" alt="img_gallery">
						</div>
						<div class="swiper-slide">
							<p class="title">Диффузор</p>
							<p class="descr">Улучшенное рассеивание воздушного потока для создания более очерченных завитков и локонов. Удлиненные зубцы позволяют укладывать более крупные пряди, обеспечивая максимальный контроль за счет глубокого проникновения в волосы.</p>
							<img src="img/_src/magnet/magnet-img-2.png" class="img-responsive" alt="img_gallery">
						</div>
						<div class="swiper-slide">
							<p class="title">Насадка для бережного высушивания волос </p>
							<p class="descr">Быстрая и деликатная укладка для пользователей с тонкими волосами и чувствительной кожей головы.</p>
							<img src="img/_src/magnet/magnet-img-3.png" class="img-responsive" alt="img_gallery">
						</div>
						<div class="swiper-slide">
							<p class="title">Насадка для создания направленного потока воздуха</p>
							<p class="descr">Высушивает волосы с помощью равномерного и контролируемого воздуха, для придания волосам естественной гладкости</p>
							<img src="img/_src/magnet/magnet-img-4.png" class="img-responsive" alt="img_gallery">
						</div>
						<div class="swiper-slide">
							<p class="title">Насадка-гребень с широкими зубьями</p>
							<p class="descr">Разработана для кудрей и волнистых волос. Имеет широкие зубья, предназначенные для вытягивания волнистых волос в процессе высушивания или для создания объема и формы.</h6>
							<img src="img/_src/magnet/magnet-img-5.png" class="img-responsive" alt="img_gallery">
						</div>
					</div>
					<div class="swiper-button-next"></div>
					<div class="swiper-button-prev"></div>
					<div class="swiper-pagination"></div>
				</div>

			</div>
		</section>
		<section class="ninth-section" id="9-section">
			<div class="container-fluid">
				<div class="row">
					<div class="col-sm-4 ml-auto mr-auto">
						<p class="title">Советы по укладке</p>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-7 ml-auto mr-auto">
						<p class="descr">Посмотрите различные способы укладки с помощью магнитных насадок фена Dyson Supersonic<sup>TM</sup></p>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-5 offset-sm-1">
						<img src="img/@2x/9-section/photo-9-1.png" class="img-responsive" alt="photo-9-1">
						<p class="subtitle">Насадка-концентратор</p>
						<p class="subdescr">Для создания волн или распрямления волос. Насадка позволяет контролировать оба процесса.</p>
					</div>
					<div class="col-sm-5">
						<img src="img/@2x/9-section/photo-9-2.png" class="img-responsive" alt="photo-9-2">
						<p class="subtitle">Диффузор</p>
						<p class="subdescr">Для создания более очерченных локонов и придания им объема, подойдет для эффекта "движения" на прямых волосах.</p>
					</div>
				</div>

				<div class="row">
					<div class="col-sm-5 offset-sm-1">
						<img src="img/@2x/9-section/photo-9-3.png" class="img-responsive" alt="photo-9-3">
						<p class="subtitle">Насадка для бережного высушивания волос</p>
						<p class="subdescr">Для создания объема у корней. Рассеянный поток воздуха подойдет для придания текстуры по всей длине волос.</p>
					</div>
					<div class="col-sm-5">
						<img src="img/@2x/9-section/photo-9-4.png" class="img-responsive" alt="photo-9-4">
						<p class="subtitle">Насадка для создания направленного потока воздуха</p>
						<p class="subdescr">Для придания волосам гладкости и создания укладки с объемом у корней и закругленными кончиками.</p>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-5 offset-sm-1">
						<img src="img/@2x/9-section/photo-9-5.png" class="img-responsive" alt="photo-9-5">
						<p class="subtitle">Насадка-гребень с широкими зубьями</p>
						<p class="subdescr">Разработана для кудрей и волнистых волос. Предназначена для вытягивания волнистых волос в процессе высушивания или для создания объема и формы.
						</p>
					</div>
				</div>
			</div>
		</section>
		<section class="tenth-section">
			<div class="containder-fluid">
				<div class="row">
					<div class="col-md-8 ml-auto mr-auto">
						<p class="title top">Высокая температура может привести к потери блеска волос</p>
					</div>
					<div class="col-md-5 offset-md-1">
						<img src="img/@2x/10-section/photo-10-1.png" class="img-responsive" alt="photo-10-1">
						<p class="subtitle">Поврежденные волосы могут терять блеск</p>
						<p class="subdescr">Высокая температура может являться причиной появления небольших пор в структуре волоса. Такие поры могут рассеивать свет, что является причиной потери блеска волос и уменьшения их естественного сияния.</p>
					</div>
					<div class="col-md-5">
						<img src="img/@2x/10-section/photo-10-2.png" class="img-responsive" alt="photo-10-2">
						<p class="subtitle">Здоровые волосы отражают свет</p>
						<p class="subdescr">Система контроля температуры исходящего воздушного потока предотвращает повреждение волос из-за перегрева. Волос отражает большее количество света, благодаря чему сохраняется его естественный блеск.</p>
					</div>
				</div>
				<div class="row">
					<div class="col-md-5 offset-md-1">
						<p class="title">Система контроля температуры исходящего воздуха помогает сохранить блеск волос</p>
						<p class="descr">Температурный сенсор фена для волос Dyson Supersonic<sup>TM</sup> измеряет температуру исходящего воздушного потока более 40 раз в секунду и контролирует нагревательный элемент, что позволяет предотвратить повреждение волос из-за перегрева и сохранить их блеск.</p>
					</div>
					<div class="col-md-5">
						<img src="img/@2x/10-section/photo-10-3.png" style="
						padding-bottom: 10px;" class="img-responsive" alt="photo-10-3">
					</div>
				</div>
			</div>
		</section>
		<section class="eleventh-section" id="11-section">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-4 ml-auto mr-auto">
						<p class="title">Преимущества <span>Dyson</span></p>
					</div>
				</div>
				<div class="row">
					<div class="col-md-3 ml-auto">
						<img src="img/_src/advantages/adv-1.svg" class="img-responsive" alt="adv-1">
						<p class="subdescr">Соблюдение закона “О защите прав Потребителей”. В случае выявления заводского дефекта Вы вправе обменять товар на новый в течение 14 дней с момента получения заказа.</p>
					</div>
					<div class="col-md-3 ml-auto mr-auto">
						<img src="img/_src/advantages/adv-2.svg" class="img-responsive" alt="adv-2">
						<p class="subdescr">100% проверка товара перед отправкой</p>
					</div>
					<div class="col-md-3 mr-auto">
						<img src="img/_src/advantages/adv-3.svg" class="img-responsive" alt="adv-3">
						<p class="subdescr">Гарантия доставки. Все посылки отправляются наложным платежом. Это означает, что вы будете платить за посылку на почте при получении</p>
					</div>
				</div>
			</div>
		</section>
		<section class="twelfth-section" id="form_buy">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-5 offset-lg-1 d-none d-md-block">
						<img src="img/@2x/photo-12-1.png" class="img-responsive" alt="photo-12-1">
					</div>

					<div class="col-md-6 col-lg-5">
						<div class="form">
							<div style="display:flex; flex-wrap:wrap; justify-content:space-between;">
								<p class="title-form"><span>заказать</span>Фен</p>
								<p class="price"><?php echo $price['real_price']*1; ?><img src="img/_src/rub.svg" alt="rub"><span>6980<img src="img/_src/rub.svg" alt="rub"></span></p>
							</div>
							
							<div class="timer timer-top">
								<p>Акция закончится через:</p>
								<h2><span class="sub-message"></span></h2>
								<div class="clock">
									<div class="column">
										<div class="timer" id="hours2"></div>
									</div>
									<div class="timer">:</div>
									<div class="column">
										<div class="timer" id="minutes2"></div>
									</div>
									<div class="timer">:</div>
									<div class="column">
										<div class="timer" id="seconds2"></div>
									</div>
								</div>
								<h2><span class="sub-message2"></span></h2>
							</div>
							<p class="descr">Заполните форму, чтобы оформить заказ</p>
							<form action="./_success_/" method="post">
								<div>
									<input type="text" name="name" placeholder="Ваше имя" required>
								</div>
								<div>
									<input type="text" name="phone" placeholder="Ваш телефон" required>
								</div>
								<button type="submit">Оформить заказ</button> 
								<input type='hidden' name='referer' value="<?php echo isset($_GET['referer']) ? $_GET['referer'] : $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] ;?>">
								<input type="hidden" name="subid1"  value="<?php echo isset($_GET['subid1']) ? $_GET['subid1'] : '' ;?>" />
								<input type="hidden" name="subid2"  value="<?php echo isset($_GET['subid2']) ? $_GET['subid2'] : '' ;?>" />
								<input type="hidden" name="subid3"  value="<?php echo isset($_GET['subid3']) ? $_GET['subid3'] : '' ;?>" />
								<input type="hidden" name="subid4"  value="<?php echo isset($_GET['subid4']) ? $_GET['subid4'] : '' ;?>" />  
								<input type="hidden" name="subid5"  value="<?php echo isset($_GET['subid5']) ? $_GET['subid5'] : '' ;?>" />
							</form>
						</div>
					</div>
				</div>
			</div>
		</section>
		
	</main>

	<div id="timer"> </div>

	
	<footer>
		<p>ООО "Лайт-Торг" 344011, Ростовская область, город Ростов-на-Дону, Братский переулок, дом 91/229 ИНН 6165151637 ОГРН 1086165007004</p>
		<a href="docs/politika.pdf" download>политика конфиденциальности</a>
	</footer>

	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> -->
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.13.0/moment.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.4/moment-timezone-with-data.js"></script>



	<!-- <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script> -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://unpkg.com/page-scroll-to-id@1.5.9/jquery.malihu.PageScroll2id.js"></script>
	<!-- <script src="js/jquery.malihu.PageScroll2id.min.js"></script> -->

	<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.1.2/js/swiper.jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.0.0/jquery.magnific-popup.min.js"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

	<script src="js/scripts.min.js"></script>

</body>
</html>
