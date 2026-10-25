<?php 
   $offer = 8;
   include_once $_SERVER['DOCUMENT_ROOT'].'/../includes/landingsData/index2.php';
   $name = "name";
?> 
<!DOCTYPE html>
<html lang="ru">

<head>

	<meta charset="utf-8">

	<title>Ритонавир</title>
	<!-- <meta name="description" content="Startup HTML template OptimizedHTML 5"> -->

	<meta name="viewport" content="width=device-width">

	<link rel="icon" href="img/@1x/logo.png">
	<meta property="og:image" content="img/@1x/preview.jpg">

	
	<link rel="stylesheet" href="css/styles.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.0.0/magnific-popup.min.css">
</head>

<body>
	<a href="#inp-form" class="popup" style='display:block;'><img src="img/@2x/consult.png" class="img-responsive consult" alt="consult"></a>
	<div class="new-order">
		<img src="img/@2x/like.png" class="img-responsive" alt="like">
		<p><span>Тамара</span> из Новосибирска заказал(а) комплект</p>
	</div>
	<header>
		<div class="container">
			<div class="row">
				<div class="col-md-12 header">
					<div class="item">
						<img src="img/@2x/header-adv-1.png" alt="advantage" class="img-responsive">
						<p>Эффективный и безопасный препарат</p>
					</div>
					<div class="item">
						<img src="img/@2x/header-adv-2.png" alt="advantage" class="img-responsive">
						<p>100% состав натуральный</p>
					</div>
					<div class="item logo">
						<img src="img/@2x/logo.png" alt="advantage" class="img-responsive">
						<span>Mylan</span>
					</div>
					<div class="item">
						<img src="img/@2x/header-adv-3.png" alt="advantage" class="img-responsive">
						<p>365 дней гарантии на заявленный результат </p>
					</div>
					<div class="item">
						<img src="img/@2x/header-adv-4.png" alt="advantage" class="img-responsive">
						<p>Европейские стандарты производства</p>
					</div>
				</div>
			</div>
		</div>
	</header>
	<section class="section-1">
		<div class="container">
			<div class="row">
				<div class="col-md-8 ml-auto mr-auto">
					<h1>Защитите себя своих близких от Короновируса  2020 - nCoV</h1>
					<p>Устранит вирусное заболевание</p>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-6 col-lg-4">
					<ul>
						<li><img src="img/@2x/adv.png" class="img-responsive" alt="advantages">Остановит процесс Вирусного заболевания</li>
						<li><img src="img/@2x/adv.png" class="img-responsive" alt="advantages">100% Защита иммунитета на 365 дней</li>
						<li><img src="img/@2x/adv.png" class="img-responsive" alt="advantages">Не допустит заражению близких людей</li>
						<li><img src="img/@2x/adv.png" class="img-responsive" alt="advantages">В Домашних условиях выявления вируса</li>
						<li><img src="img/@2x/adv.png" class="img-responsive" alt="advantages">Тест для домашнего любимца на короновирус</li>
					</ul>
					<div class="approval">
						<img src="img/@2x/section-1-2.png" class="img-responsive" alt="approval">
						<p class="approv">Одобрение Минздрава</p>
					</div>
				</div>
				<div class="col-sm-6 col-lg-5">
					<img src="img/@2x/section-1-1.png" alt="medicaments" class="img-responsive">
				</div>
				<div class="col-sm-8 ml-auto mr-auto col-lg-3">
					<div class="form">

						<div style="display:flex; flex-wrap:wrap; justify-content:space-between;">
							<!-- <p class="title-form"><span>Заказать</span>Бритву</p> -->
							<!-- <p class="price">3490<img src="img/_src/rub-blue.svg" alt="rub"><span>6980<img src="img/_src/rub-blue.svg" alt="rub"></span></p> -->
						</div>
						
						<div class="timer timer-top">
							<!-- <p>Акция закончится через:</p> -->
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
						<!-- <p class="descr">Заполните форму, чтобы оформить заказ</p> -->
						<div class="descr">
							<div class="price-item">
								<p class="price-name">Старая цена</p>
								<p class="price-num">6000 <img src="img/_src/rub-black.svg" alt="rub"></p>
							</div>
							<div class="price-item">
								<p class="price-name">Новая цена</p>
								<p class="price-num active">2990 <img src="img/_src/rub-pink.svg" alt="rub"></p>
							</div>
						</div>
						<form action="./_success_/" method="post">
						    <div>
								<input type="text" name="country" placeholder="Россия" required>
							</div>
							<div>
								<input type="text" name="<?php echo $name; ?>" placeholder="Ваше имя" required>
							</div>
							<div>
								<input type="text" name="phone" placeholder="Ваш телефон" required>
							</div>
							<button type="submit">Заказать</button> 
							<input type='hidden' name='referer' value="<?php echo isset($_GET['referer']) ? $_GET['referer'] : $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] ;?>">
							<input type="hidden" name="subid1"  value="<?php echo isset($_GET['subid1']) ? $_GET['subid1'] : '' ;?>" />
							<input type="hidden" name="subid2"  value="<?php echo isset($_GET['subid2']) ? $_GET['subid2'] : '' ;?>" />
							<input type="hidden" name="subid3"  value="<?php echo isset($_GET['subid3']) ? $_GET['subid3'] : '' ;?>" />
							<input type="hidden" name="subid4"  value="<?php echo isset($_GET['subid4']) ? $_GET['subid4'] : '' ;?>" />  
							<input type="hidden" name="subid5"  value="<?php echo isset($_GET['subid5']) ? $_GET['subid5'] : '' ;?>" />
						</form>
					</div>
					<p class="bottom-descr-form"><span>*</span>Осталось <span>47</span> комплектов</p>
				</div>
			</div>
		</div>
		
		<img src="img/@2x/section-1-3-bg.png" class="img-responsive bg-section-1" alt="bg">
	</section>
	<section class="section-2">
		<div class="container">
			<div class="row">
				<div class="col-md-8 ml-auto mr-auto">
					<h1>Почему Ритонавир необходим.</h1>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<p class="descr">В результате сбалансированной формулы состава, Ритонавир обеспечивает 100% защиту ииммунитета. Останавливает вирусный процесс. Запускает процесс на восстановления организма в кратчайшие сроки .Также, воздействуя комплексно, убирает симптомы: </p>
				</div>
			</div>
			<div class="row d-flex  flex-wrap flex-lg-nowrap justify-content-center justify-content-lg-between">
				<div class="item">
					<img src="img/@2x/section-2-1.png" alt="symptoms" class="img-responsive">
					<span>Кашель</span></div>
				<div class="item">
					<img src="img/@2x/section-2-2.png" alt="symptoms" class="img-responsive">
					<span>Температура, головная боль</span></div>
				<div class="item">
					<img src="img/@2x/section-2-3.png" alt="symptoms" class="img-responsive">
					<span>Боли в горле</span></div>
				<div class="item">
					<img src="img/@2x/section-2-4.png" alt="symptoms" class="img-responsive">
					<span>Проблема с дыханием</span></div>
			</div>
		</div>
	</section>
	<section class="section-3">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h1>Что входит в комплект?</h1>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 d-flex flex-wrap flex-lg-nowrap">
					<div class="item">
						<img src="img/@2x/section-3-1.png" class="img-responsive" alt="kit">
						<p><span>Ритонавир</span> - Противовирусное средство, пептидный ингибитор ВИЧ-1 и ВИЧ-2 протеаз. Ферментное расщепление протеаз делает невозможным активацию белкового предшественника и приводит к синтезу незрелых ВИЧ частиц, неспособных инициировать дальнейшее развитие инфекции</p>
						<p><span>Дозирование</span> - Внутрь, во время еды, по 600 мг 2 раза в день. Для уменьшения побочных эффектов начальная доза — 300 мг 2 раза в день, затем ежедневно дозу увеличивают на 100 мг в каждый прием до достижения дозы 600 мг 2 раза в день. <span>Детям</span> — 400 мг/кв.м поверхности тела 2 раза в день; при плохой переносимости начальная доза — 250 мг/кв.м, с дальнейшим увеличением через каждые 2–3 дня на 50 мг/кв.м в каждый прием, пока не будет достигнута доза 400 мг/кв.м 2 раза в день.</p>
						<p></p>
					</div>
					<div class="item">
						<img src="img/@2x/section-3-2.png" class="img-responsive" alt="kit">
						<p><span>Защитная маска</span> - Маска Black Dust  против загрязнения воздуха, и его фильтрация, PM2.5 Имеет 5 слоев фильтр дизайн, в том числе микрофильтрации ткань и активированное углеродное волокно, и двойной дыхательный клапан дизайн, увеличение отработанных газов. Смываемая маска со сменными фильтрующими накладками и регулируемым, эластичным шнурком, проста в использовании. 5. Эргономичная маска плотно прилегает к силуэту лица и переносице для максимальной защиты. маска * 1 шт + прокладки фильтра * 2 шт. Время работы 29 Дней со сменными фильтрами</p>
					</div>
					<div class="item">
						<img src="img/@2x/section-3-3.png" class="img-responsive" alt="kit">
						<p><span>Витамин С</span> - На рынке с 1947 года высокая устойчивость мягкий и не обладающий высокой кислотностью продукт поддержка иммунной системы не содержит ГМО халяльный продукт без глютена, пшеницы и молочных продуктов вегетарианский продукт Отсутствие глютена сертифицировано кошерный продукт (парве) пищевая добавка, 100капсул</p>
						<p><span>Дозирование</span> - В качестве пищевой добавки для взрослых принимайте 1 (одну) капсулу в растительной оболочке два раза в день, желательно с едой или по указанию медицинского работника. 1табл - 1000мг</p>
					</div>
					<div class="item">
						<img src="img/@2x/section-3-4.png" class="img-responsive" alt="kit">
						<p><span>Антисептик</span> - Профилактический антибактериальный спрей. Содержит толнафтат, который используется при лечении грибковых заболеваний ногтей. Применяется для санитарной обработки рук мастера и клиента. Обьем 200 мл.</p>
						<p><span>Дозирование</span> - Тонко распылить дезинфектор на кожу рук и ногти, слегка втереть, дать подсохнуть.</p>
					</div>
					
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 d-flex flex-wrap flex-lg-nowrap">
					<div class="item">
						<img src="img/@2x/section-3-5.png" alt="kit" class="img-responsive">
						<p><span>Тест на грипп</span> - Грипп (известный как ОРВИ) представляет собой высококонтагиозную острую вирусную инфекцию дыхательных путей. Это инфекционное заболевание, которое легко передается через кашель или чихание с помощью распыленных капель, содержащих живой вирус. </p>
					</div>
					<div class="item">
						<img src="img/@2x/section-3-6.png" alt="kit" class="img-responsive">
						<p><span>Арбидол</span> - Таблетки: покрытые оболочкой от белого до белого с кремоватым оттенком цвета, двояковыпуклой формы, на поперечном разрезе видны 2 слоя.</p>
						<p><span>Дозирование</span> - Арбидол назначается внутрь, до приема пищи. Разовая дозы для взрослых и детей старше 12 лет - 200 мг (2 капс. по 100 мг или 4 капс. по 50 мг), для детей в возрасте от 6 до 12 лет - 100 мг, от 3 до 6 лет - 50 мг.</p>
						<p>Для неспецифической профилактики препарат прописывают в следующих случаях: При непосредственном контакте с больным гриппом и другими ОРВИ взрослым и детям старше 12 лет назначают в дозе 200 мг/сут. ; детям в возрасте от 6 до 12 лет – 100 мг/сут.; детям в возрасте от 3 до 6 лет – 50 мг/сут. принимают 1 раз/сут</p>
					</div>
					<div class="item">
						<img src="img/@2x/section-3-7.png" alt="kit" class="img-responsive">
						<p><span>Экспресс тест</span> - Устройство имеет исследуемое окно где находится невидимая Т тестовая зона и С контрольная зона. При внесении исследуемого образца в лунку для образца, жидкость будет двигаться в поперечном направлении на поверхности теста.</p>
						<p><span>Дозирование</span> - Освободите касету из пакета и положите горизонтально.
							На ватный палочку наберите фекалии или рвотной массу, или клоаки животного, так чтобы тампон был хорошо промоченный.
							Вставьте тампон в флакон с буфером для анализа. С помощью пипетки в окошко для образца капните 3 капли исследуемого образца.
							Учет результатов через 5-10 мин. Результат после прохождения 10 мин является не действительным. </p>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section class="section-4">
		<div class="container">
			<div class="row">
				<div class="col-md-8 ml-auto mr-auto">
					<h1>Защитите себя своих близких от Короновируса  2020 - nCoV</h1>
				</div>
			</div>
			<div class="row">
				<div class="col-md-10 ml-auto mr-auto">
					<p>Этот комплект должен быть у каждого человека , который думает о Здоровье и не хочет заболеть Коронавирусом</p>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6 col-lg-4">
					<ul>
						<li><img src="img/@2x/adv.png" class="img-responsive" alt="advantages">Остановит процесс Вирусного заболевания</li>
						<li><img src="img/@2x/adv.png" class="img-responsive" alt="advantages">100% Защита иммунитета на 365 дней</li>
						<li><img src="img/@2x/adv.png" class="img-responsive" alt="advantages">Не допустит заражению близких людей</li>
						<li><img src="img/@2x/adv.png" class="img-responsive" alt="advantages">В Домашних условиях выявления вируса</li>
						<li><img src="img/@2x/adv.png" class="img-responsive" alt="advantages">Тест для домашнего любимца на короновирус</li>
					</ul>
				</div>
				<div class="col-md-6 col-lg-5">
					<img src="img/@2x/section-1-1.png" alt="medicaments" class="img-responsive">
				</div>
				<div class="col-sm-8 ml-auto mr-auto col-lg-3">
					<div class="form">

						<div style="display:flex; flex-wrap:wrap; justify-content:space-between;">
							<!-- <p class="title-form"><span>Заказать</span>Бритву</p> -->
							<!-- <p class="price">3490<img src="img/_src/rub-blue.svg" alt="rub"><span>6980<img src="img/_src/rub-blue.svg" alt="rub"></span></p> -->
						</div>
						
						<div class="timer timer-top">
							<!-- <p>Акция закончится через:</p> -->
							<h2><span class="sub-message"></span></h2>
							<div class="clock">
								<div class="column">
									<div class="timer" id="hours"></div>
								</div>
								<div class="timer">:</div>
								<div class="column">
									<div class="timer" id="minutes"></div>
								</div>
								<div class="timer">:</div>
								<div class="column">
									<div class="timer" id="seconds"></div>
								</div>
							</div>
							<h2><span class="sub-message2"></span></h2>
						</div>
						<!-- <p class="descr">Заполните форму, чтобы оформить заказ</p> -->
						<div class="descr">
							<div class="price-item">
								<p class="price-name">Старая цена</p>
								<p class="price-num">6000 <img src="img/_src/rub-black.svg" alt="rub"></p>
							</div>
							<div class="price-item">
								<p class="price-name">Новая цена</p>
								<p class="price-num active">2990 <img src="img/_src/rub-pink.svg" alt="rub"></p>
							</div>
						</div>
						<form action="./_success_/" method="post">
							<div>
								<input type="text" name="country" placeholder="Россия" required>
							</div>
							<div>
								<input type="text" name="<?php echo $name; ?>" placeholder="Ваше имя" required>
							</div>
							<div>
								<input type="text" name="phone" placeholder="Ваш телефон" required>
							</div>
							<button type="submit">Заказать</button> 
							<input type='hidden' name='referer' value="<?php echo isset($_GET['referer']) ? $_GET['referer'] : $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] ;?>">
							<input type="hidden" name="subid1"  value="<?php echo isset($_GET['subid1']) ? $_GET['subid1'] : '' ;?>" />
							<input type="hidden" name="subid2"  value="<?php echo isset($_GET['subid2']) ? $_GET['subid2'] : '' ;?>" />
							<input type="hidden" name="subid3"  value="<?php echo isset($_GET['subid3']) ? $_GET['subid3'] : '' ;?>" />
							<input type="hidden" name="subid4"  value="<?php echo isset($_GET['subid4']) ? $_GET['subid4'] : '' ;?>" />  
							<input type="hidden" name="subid5"  value="<?php echo isset($_GET['subid5']) ? $_GET['subid5'] : '' ;?>" />
						</form>
					</div>
					<p class="bottom-descr-form"><span>*</span>Осталось <span>47</span> комплектов</p>
				</div>
			</div>
		</div>
	</section>
	<section class="section-5">
		<div class="container">
			<div class="row">
				<div class="col-md-8 ml-auto mr-auto">
					<h1>Ритонавир – первый в Мире  продукт излечивающий и останавливающий вирусный процесс 2020 - nCoV</h1>
				</div>
			</div>
			<div class="row">
				<div class="col-md-5">
					<img src="img/@2x/section-5-1.png" alt="medicine" class="img-responsive med">
				</div>
				<div class="col-md-6 offset-md-1">
					<p class="title">Описание</p>
					<p class="descr">Alltera – это комбинированный препарат, который оказывает противовирусное действие. Проявляет свою активность как блокатор ферментов короновируса. Ритонавир выступает как ингибитор аспартил-протеаз короновируса.</p>
					<div class="descr-block">
						<p class="title">Преимущества</p>
						<ul>
							<li><img src="img/@2x/adv-green.png" class="img-responsive" alt="advantages">Не развивается резистентность вируса к лекарственному средству</li>
							<li><img src="img/@2x/adv-green.png" class="img-responsive" alt="advantages">Низкая стоимость относительно Kaletra</li>
							<li><img src="img/@2x/adv-green.png" class="img-responsive" alt="advantages">Высокие показатели всасываемости</li>
							<li><img src="img/@2x/adv-green.png" class="img-responsive" alt="advantages">Повышенные концентрации в плазме крови дают длительный эффект</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section class="section-6">
		<div class="container">
			<div class="row">
				<div class="col-md-5 offset-md-1">
					<img src="img/@2x/section-6-1.png" alt="medicine" class="img-responsive">
				</div>
				<div class="col-md-5 offset-md-1">
					<p class="title">Мнение специалистов</p>
					<p class="descr">Комплексное лечение Ритонавира  – вне всяких сомнений на сегодняшний день самое прогрессивное средство для лечения вирусного заболевания -2020 nCoV </p>
					<p class="descr">В клетках превращается в моно- и трифосфат. Рибамидил−5'-монофосфат конкурентно ингибирует дегидрогеназу инозинмонофосфата и тормозит синтез вирусных ДНК и РНК</p>
					<p class="descr">Препарат оказывает общеукрепляющее, регеративное, противоспалительные процессы</p>
					<p class="descr"><span>Перорально</span> (в комбинации с интерфероном beta 1-b  усиливает процес ) 	</p>
				</div>
			</div>
		</div>
	</section>
	<section class="section-4">
		<div class="container">
			<div class="row">
				<div class="col-md-8 ml-auto mr-auto">
					<h1>Защитите себя своих близких от Короновируса  2020 - nCoV</h1>
				</div>
			</div>
			<div class="row">
				<div class="col-md-10 ml-auto mr-auto">
					<p>Этот комплект должен быть у каждого человека , который думает о Здоровье и не хочет заболеть Коронавирусом</p>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6 col-lg-4">
					<ul>
						<li><img src="img/@2x/adv.png" class="img-responsive" alt="advantages">Остановит процесс Вирусного заболевания</li>
						<li><img src="img/@2x/adv.png" class="img-responsive" alt="advantages">100% Защита иммунитета на 365 дней</li>
						<li><img src="img/@2x/adv.png" class="img-responsive" alt="advantages">Не допустит заражению близких людей</li>
						<li><img src="img/@2x/adv.png" class="img-responsive" alt="advantages">В Домашних условиях выявления вируса</li>
						<li><img src="img/@2x/adv.png" class="img-responsive" alt="advantages">Тест для домашнего любимца на короновирус</li>
					</ul>
				</div>
				<div class="col-md-6 col-lg-5">
					<img src="img/@2x/section-1-1.png" alt="medicaments" class="img-responsive">
				</div>
				<div class="col-sm-8 ml-auto mr-auto col-lg-3">
					<div class="form">

						<div style="display:flex; flex-wrap:wrap; justify-content:space-between;">
							<!-- <p class="title-form"><span>Заказать</span>Бритву</p> -->
							<!-- <p class="price">3490<img src="img/_src/rub-blue.svg" alt="rub"><span>6980<img src="img/_src/rub-blue.svg" alt="rub"></span></p> -->
						</div>
						
						<div class="timer timer-top">
							<!-- <p>Акция закончится через:</p> -->
							<h2><span class="sub-message"></span></h2>
							<div class="clock">
								<div class="column">
									<div class="timer" id="hours3"></div>
								</div>
								<div class="timer">:</div>
								<div class="column">
									<div class="timer" id="minutes3"></div>
								</div>
								<div class="timer">:</div>
								<div class="column">
									<div class="timer" id="seconds3"></div>
								</div>
							</div>
							<h2><span class="sub-message2"></span></h2>
						</div>
						<!-- <p class="descr">Заполните форму, чтобы оформить заказ</p> -->
						<div class="descr">
							<div class="price-item">
								<p class="price-name">Старая цена</p>
								<p class="price-num">6000 <img src="img/_src/rub-black.svg" alt="rub"></p>
							</div>
							<div class="price-item">
								<p class="price-name">Новая цена</p>
								<p class="price-num active">2990 <img src="img/_src/rub-pink.svg" alt="rub"></p>
							</div>
						</div>
						<form action="./_success_/" method="post">
							<div>
								<input type="text" name="country" placeholder="Россия" required>
							</div>
							<div>
								<input type="text" name="<?php echo $name; ?>" placeholder="Ваше имя" required>
							</div>
							<div>
								<input type="text" name="phone" placeholder="Ваш телефон" required>
							</div>
							<button type="submit">Заказать</button> 
							<input type='hidden' name='referer' value="<?php echo isset($_GET['referer']) ? $_GET['referer'] : $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] ;?>">
							<input type="hidden" name="subid1"  value="<?php echo isset($_GET['subid1']) ? $_GET['subid1'] : '' ;?>" />
							<input type="hidden" name="subid2"  value="<?php echo isset($_GET['subid2']) ? $_GET['subid2'] : '' ;?>" />
							<input type="hidden" name="subid3"  value="<?php echo isset($_GET['subid3']) ? $_GET['subid3'] : '' ;?>" />
							<input type="hidden" name="subid4"  value="<?php echo isset($_GET['subid4']) ? $_GET['subid4'] : '' ;?>" />  
							<input type="hidden" name="subid5"  value="<?php echo isset($_GET['subid5']) ? $_GET['subid5'] : '' ;?>" />
						</form>
					</div>
					<p class="bottom-descr-form"><span>*</span>Осталось <span>47</span> комплектов</p>
				</div>
			</div>
		</div>
	</section>
	<footer>
		<div class="container">
			<div class="row">
				<div class="col-md-3">
					<ul>
						<li>
							<img src="img/@2x/footer-adv-1.png" alt="adv-descr" class="img-responsive">
							<p class="adv-descr">Вы оставляете заявку на сайте с помощью формы заказа</p>
						</li>
						<li>
							<img src="img/@2x/footer-adv-2.png" alt="adv-descr" class="img-responsive">
							<p class="adv-descr">С Вами связывается специалист марки и отвечает на все Ваши вопросы, помогает оформить доставку</p>
						</li>
						<li>
							<img src="img/@2x/footer-adv-3.png" alt="adv-descr" class="img-responsive">
							<p class="adv-descr">Отправляем Ваш заказ почтовой или курьерской службой. Оплата — только при получении товара.</p>
						</li>
					</ul>
					<div class="approval">
						<img src="img/@2x/section-1-2.png" class="img-responsive" alt="approval">
						<p class="approv">Одобрение Минздрава</p>
					</div>
				</div>
				<div class="col-md-6">
					<img src="img/@2x/logo.png" alt="logo" class="img-responsive logo-img">
					<a href="docs/politika.pdf" download>Политика конфиденциальности Пользовательское соглашение</a>
					<p class="adr">ООО “НЭТЛАЙН” <br>129281 ГОРОД МОСКВА УЛИЦА ИЗУМРУДНАЯ ДОМ 13 КОРПУС 2 ЭТАЖ 1 ПОМ 1 КОМ 2 ОФ 4 ОГРН: 1187746101597 КПП: 771601001 ИНН: 7716890981</p>
				</div>
				<div class="col-md-3">
					<p class="work-time">В связи международной ситуацией в мире <span>работаем 24/7</span></p>
				</div>
			</div>
		</div>
	</footer>

	<div class="hidden mfp-hide" id="inp-form" style="">
		<p class="title">ПОНРАВИЛОСЬ ЭТО ПРЕДЛОЖЕНИЕ?</p>
		<p class="descr">Мы расскажем Вам все об этом товаре, предложим наилучшие условия и ознакомим с подходящими акционными предложениями!</p>
		<form action="./_success_/" method="post">
			<!-- <div>
				<input type="text" name="country" placeholder="Россия" required>
			</div> -->
			<div>
				<input type="text" name="<?php echo $name; ?>" placeholder="Ваше имя" required>
			</div>
			<div>
				<input type="text" name="phone" placeholder="Ваш телефон" required>
			</div>
			<button type="submit">Перезвонить мне</button> 
			<input type='hidden' name='referer' value="<?php echo isset($_GET['referer']) ? $_GET['referer'] : $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] ;?>">
			<input type="hidden" name="subid1"  value="<?php echo isset($_GET['subid1']) ? $_GET['subid1'] : '' ;?>" />
			<input type="hidden" name="subid2"  value="<?php echo isset($_GET['subid2']) ? $_GET['subid2'] : '' ;?>" />
			<input type="hidden" name="subid3"  value="<?php echo isset($_GET['subid3']) ? $_GET['subid3'] : '' ;?>" />
			<input type="hidden" name="subid4"  value="<?php echo isset($_GET['subid4']) ? $_GET['subid4'] : '' ;?>" />  
			<input type="hidden" name="subid5"  value="<?php echo isset($_GET['subid5']) ? $_GET['subid5'] : '' ;?>" />
		</form>
		<p class="recall"><img src="img/@2x/inp-form.png" alt="imp-form">Оператор перезвонит Вам через 15-30 минут</p>
	</div>
	

	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.13.0/moment.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.4/moment-timezone-with-data.js"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script> -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.0.0/jquery.magnific-popup.min.js"></script>
	<script src="js/scripts.min.js"></script>

</body>
</html>
