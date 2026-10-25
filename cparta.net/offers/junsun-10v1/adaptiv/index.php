<?php 
   $offer = 265;
   include_once $_SERVER['DOCUMENT_ROOT'].'/../includes/landingsData/index2.php';
?> 
<!DOCTYPE html>
<html lang="ru">
<head>
    <!-- Содержимое HEAD индексного файла -->
<title>ЗЕРКАЛО ВИДЕОРЕГИСТРАТОР 10 В 1 JUNSUN</title>
	
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">

	<meta name="description" content="С автомобильным пылесосом DC 12V уборка в авто станет легкой и необременительной.">

	<link rel="icon" type="image/png" href="favicon.png">

	<link rel="stylesheet" href="land/css/reset.css">
	<link rel="stylesheet" href="land/fonts/AvenirNextCyr/AvenirNextCyr.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/dmhendricks/bootstrap-grid-css@4.1.3/dist/css/bootstrap-grid.min.css">
	<link rel="stylesheet" href="css/styles.css?12">


</head>
<body>
	<header class="offer_section">
		<div class="wrapper clearfix">
			<h1 class="main_title">ЗЕРКАЛО ВИДЕОРЕГИСТРАТОР 10 В 1 <span>Junsun</span></h1>
			<p class="subtitle">ваш главный помощник на дороге</p>
			<ul class="clearfix">
				<li>Видео 2304х1296 SUPER HD</li>
				<li>Угол обзора 170°</li>
				<li>Поддержка 4G и Wi-Fi</li>
				<li>Встроенный радар – детектор</li>
				<li>Выносная камера</li>
				<li>ОС Android 8.0</li>
			</ul>
			<div class="discount">Акция! <span>60%</span> скидка</div>
			<div class="form_block">
				<div class="timer_block">
					<p>Конец акции через:</p>
					<div class="timer clearfix">
						<div class="timer_item">
							<div class="count hours"></div>
							<div class="text">часов</div>
						</div>
						<div class="timer_item">
							<div class="count minutes"></div>
							<div class="text">минут</div>
						</div>
						<div class="timer_item">
							<div class="count seconds"></div>
							<div class="text">секунд</div>
						</div>
					</div>
				</div>
				<div class="price_block clearfix">
					<div class="price_item old">
						<div class="text">Обычная цена:</div>
						<div class="value">5980Руб</div>
					</div>
					<div class="price_item new">
						<div class="text">Цена сегодня:</div>
						<div class="value"><?php echo $price['real_price']; ?></div>
					</div>
				</div>
				<form class="order_form" action="./_success_/" method="post">
					<input type='hidden' name='referer' value="<?php echo isset($_GET['referer']) ? $_GET['referer'] : $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] ;?>">
<input type="hidden" name="subid1"  value="<?php echo isset($_GET['subid1']) ? $_GET['subid1'] : '' ;?>" />
<input type="hidden" name="subid2"  value="<?php echo isset($_GET['subid2']) ? $_GET['subid2'] : '' ;?>" />
<input type="hidden" name="subid3"  value="<?php echo isset($_GET['subid3']) ? $_GET['subid3'] : '' ;?>" />
<input type="hidden" name="subid4"  value="<?php echo isset($_GET['subid4']) ? $_GET['subid4'] : '' ;?>" />  
<input type="hidden" name="subid5"  value="<?php echo isset($_GET['subid5']) ? $_GET['subid5'] : '' ;?>" />
					<input class="field" type="text" name="name" placeholder="Введите Ваше имя" required>
					<input class="field" type="tel" name="phone" placeholder="Введите Ваш телефон" required>
					<button class="button">Заказать сейчас</button>

				</form>
				<div class="deadline_text">Количество видеорегистраторов ограничено</div>
			</div>
		</div>
	</header>

	<!-- /offer -->

	<!-- about -->

	<section class="about_section">
		<div class="wrapper clearfix">
			<h2>С Junsun ВЫ ЗАБУДЕТЕ <br><span>О ПРОБЛЕМАХ СО ШТРАФАМИ</span></h2>
			<img class="image1" src="images/about__image1.jpg" alt="DC 12V">
			<div class="text_block text_block1">
				<p>Среди всего разнообразия автогаджетов два самых популярных — это видеорегистратор и радар-детектор. Первый фиксирует дорожную обстановку на видео, чтобы в случае ДТП у вас на руках имелась доказательная база. Второй же — заранее предупреждает о приближении к системам контроля скорости, чтобы у вас было время притормозить и спастись от штрафа. </p>
				
				<p><b>Компания Junsun объединила эти два автогаджета в единое сигнатурное комбо-устройство. Видеорегистратор Junsun – это многофункциональное устройство, совмещающее в себе функции камеры, радар-детектора и GPS информатора.</b></p>

			</div>
			<img class="image2" src="images/about__image2.jpg" alt="DC 12V">
			<div class="text_block text_block2">
				<p>Продвинутая камера со CMOS-матрицей ведёт запись в SUPER HD -формате (2304х1296 пикселей) со скоростью 30 кадров в секунду. Широкий угол обзора равен 170 градусам, что даёт полный охват проезжей части и близлежащих обочин.</p>
				<p><b>Видеорегистратор Junsun – <span style="text-transform: lowercase;">УНИКАЛЬНЫЙ АВТОМОБИЛЬНЫЙ РЕГИСТРАТОР С МАКСИМАЛЬНЫМ НАБОРОМ ОПЦИЙ</span>.</b></p>
			</div>
		</div>
	</section>

	<!-- /about -->

	<!-- benefits -->

	<section class="benefits_section">
		<div class="wrapper">
			<h2>Преимущества <span>видеорегистратора Junsun</span></h2>
			<div class="benefits_list">
				<div class="benefit_item">
					<img src="images/photo4.jpg" alt="DC 12V">
					<p><b>МОДУЛЬ WI-FI</b><br>Позволяет подключать видеорегистратор к смартфону для удобного управления настройками и просмотра видео</p>
				</div>
				<div class="benefit_item">
					<img src="images/photo5.jpg" alt="DC 12V">
					<p><b>АВТОНОМНАЯ РАБОТА</b><br>Благодаря литий-ионному аккумулятору с емкостью 500 мАч, регистратор снимает без внешнего питания до 20 минут</p>
				</div>
				<div class="benefit_item">
					<img src="images/photo6.jpg" alt="DC 12V">
					<p><b>GPS/ГЛОНАСС МОДУЛЬ</b><br>Внешний GPS/ГЛОНАСС-модуль позволяет устройству отслеживать координаты и скорость движения автомобиля</p>
				</div>
				<div class="benefit_item">
					<img src="images/photo7.jpg" alt="DC 12V">
					<p><b>ФУНКЦИЯ DEWARP</b><br>Чтобы снизить искажение изображения из-за использования широкоугольного объектива, применяется технология DEWARP</p>
				</div>
			</div>
			<a href="#order_form" class="button">Заказать сейчас</a>
		</div>
	</section>

	<!-- /benefits -->

	<!-- characteristics -->

	<section class="characteristics_section" style="background: url(images/bg2.jpg);background-size: cover;background-position: center center;">
		<div class="wrapper">
			<h2 style="color: #000">Посмотрите, на что способен видеорегистратор </h2>
			<p style="text-align: center;color: white;margin-bottom: 40px;color: #000;font-weight: 700">Junsun обладает максимальными техническими свойствами и функциями на рынке. Устройство основано на новейшем мощном процессоре Novatek N96660, что обеспечивает высокую скорость работы без сбоев в записи видеоматериалов в формате SUPER HD.</p>
			<div class="video_wrapper">
				<div class="video_block">
			
					<iframe  height="315" src="https://www.youtube.com/embed/gGJcaK9wC-s" frameborder="0" ></iframe>
				</div>
			</div>
		</div>
	</section>

	<!-- /characteristics -->

	<!-- use steps -->

	<section class="benefits_section">
		<div class="wrapper">
			<h2>Особенности <span>видеорегистратора Junsun</span></h2>

			<div class="bootstrap-wrapper">
				<div class="row" style="justify-content: center;">
					<div class="col-md-6 col-sm-6" style="text-align:center;margin-top:2rem;">
						<div class="row">
							<div class="ch-1">
								<div class="col-12">
									<img src="images/photo8.png" alt="">
								</div>
								<div class="col-12">
									<p style="margin-top: 10px;">
										<b>
											Высокое качество съёмки
										</b><br>
										Видеорегистратор получил видеосенсор Sony IMX323 с разрешением SUPER HD (2304х1296). Такой детализации как раз хватает, чтобы захватить на видео мельчайшие подробности. 5-элементная линза выполнена из стекла, что также положительно сказывается на качестве записи.
									</p>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-6 col-sm-6" style="text-align:center;margin-top:2rem;">
						<div class="row">
							<div class="ch-1">
								<div class="col-12">
									<img src="images/photo9.png" alt="">
								</div>
								<div class="col-12">
									<p style="margin-top: 10px;">
										<b>
											Широкое поле обзора
										</b><br>
										Благодаря 170-градусной широкоугольной линзе, Junsun способен снимать видео в формате 16:9. Широкий угол позволяет зафиксировать больше событий на соседних полосах, давая исчерпывающие данные об окружающей обстановке.
									</p>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-6 col-sm-6" style="text-align:center;margin-top:2rem;">
						<div class="row">
							<div class="ch-1">
								<div class="col-12">
									<img src="images/photo10.png" alt="">
								</div>
								<div class="col-12">
									<p style="margin-top: 10px;">
										<b>
											РАДАР-ДЕТЕКТОР
										</b><br>
										Видеорегистратор Junsun оснащен радар-детектором нового поколения. Обновленное программное обеспечение и новые алгоритмы работы позволили увеличить эффективность обнаружения радаров и камер.
									</p>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-6 col-sm-6" style="text-align:center;margin-top:2rem;">
						<div class="row">
							<div class="ch-1">
								<div class="col-12">
									<img src="images/photo11.png" alt="">
								</div>
								<div class="col-12">
									<p style="margin-top: 10px;">
										<b>
											4G и Wi-Fi
										</b><br>
										Благодаря встроенному 4G и Wi-Fi модулю вы всегда можете оставаться на связи во время поездки, а также просматривать любимые фильмы. Подключитесь через Wi-Fi или SIM – карту и путешествуйте по просторам интернета на максимальных скоростях.
									</p>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-6 col-sm-6" style="text-align:center;margin-top:2rem;">
						<div class="row">
							<div class="ch-1">
								<div class="col-12">
									<img src="images/photo12.png" alt="">
								</div>
								<div class="col-12">
									<p style="margin-top: 10px;">
										<b>
											ОПЕРАЦИОННАЯ СИСТЕМА ANDROID
										</b><br>
										Junsun работает на операционной системе Android, что позволит вам устанавливать любые приложения из Google Play. Также вы сможете подключить устройство к аудиосистеме автомобиля по сети Bluetooth и просматривать любые видеоролики.
									</p>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-6 col-sm-6" style="text-align:center;margin-top:2rem;">
						<div class="row">
							<div class="ch-1">
								<div class="col-12">
									<img src="images/photo13.png" alt="">
								</div>
								<div class="col-12">
									<p style="margin-top: 10px;">
										<b>
											Датчик движения
										</b><br>
										Если в кадре происходит движение, включается автоматическая запись видео. Эта опция не только избавляет вас от необходимости включать регистратор перед тем, как тронуться, но и позволяет наблюдать за тем, что происходит вокруг вашей машины на парковке.
									</p>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-6 col-sm-6" style="text-align:center;margin-top:2rem;">
						<div class="row">
							<div class="ch-1">
								<div class="col-12">
									<img src="images/photo14.png" alt="">
								</div>
								<div class="col-12">
									<p style="margin-top: 10px;">
										<b>
											G-сенсор (датчик удара) 
										</b><br>
										Даже если случится лёгкий удар на парковке или какая-то резкая встряска, которая может быть при экстренном торможении, G-сенсор даёт видеорегистратору команду на сохранение особого ролика в специальной нестираемой области памяти.
									</p>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-6 col-sm-6" style="text-align:center;margin-top:2rem;">
						<div class="row">
							<div class="ch-1">
								<div class="col-12">
									<img src="images/photo15.png" alt="">
								</div>
								<div class="col-12">
									<p style="margin-top: 10px;">
										<b>
											КАМЕРА ЗАДНЕГО ВИДА
										</b><br>
										Дополнительная миниатюрная камера обладает углом обзора 150° и ведет фиксацию проезжей части позади автомобиля. Также вы сможете использовать данную камеру как парктроник, подключив ее к фонарям заднего хода. Вы сможете установить ее как внутри автомобиля, так и снаружи.
									</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="use_steps_section">
		<div class="wrapper clearfix">
			<h2><span>Комплектация и технические характеристики</span></h2>
			<img src="images/use_steps__image.jpg" alt="DC 12V">
			<div class="text_block">
				<ul>
					<li><b>1</b> Видеорегистратор Junsun</li>
					<li><b>2</b> Камера заднего вида</li>
					<li><b>3</b> GPS – модуль + кабели</li>
					<li><b>4</b> Автомобильное зарядное устройств</li>
					<li><b>5</b> Поворотный кранштейн</li>
					<li><b>6</b> Инструкция на русском языке</li>
				</ul>
				<a href="#order_form" class="button">Заказать сейчас</a>
			</div>
			<div style="clear: both;"></div>
			<table style="width: 100%;margin-top: 40px;margin-bottom: 40px;">

                <tbody>
                    

<tr><td>Разрешение видео</td><td style="text-align: right;text-shadow: 1px 1px 1px #000;">	Super HD 2304*1296 (30 к/с)</td></tr>
<tr><td>Угол обзора</td><td style="text-align: right;text-shadow: 1px 1px 1px #000;">	170° (выносная 150°)</td></tr>
<tr><td>Дисплей</td><td style="text-align: right;text-shadow: 1px 1px 1px #000;">	10 дюймов</td></tr>
<tr><td>Видеозапись (битрейт)</td><td style="text-align: right;text-shadow: 1px 1px 1px #000;">	MOV/H.264, WDR</td></tr>
<tr><td>Поддержка карт памяти</td><td style="text-align: right;text-shadow: 1px 1px 1px #000;">	MicroSD 8Гб - 64Гб (Class 10)</td></tr>
<tr><td>Интервал циклической записи, мин</td><td style="text-align: right;text-shadow: 1px 1px 1px #000;">	1/3/5</td></tr>
<tr><td>Встроенный GPS</td><td style="text-align: right;text-shadow: 1px 1px 1px #000;">	да</td></tr>
<tr><td>Встроенный микрофон/динамик	</td><td style="text-align: right;text-shadow: 1px 1px 1px #000;">Встроенный микрофон</td></tr>
<tr><td>Штамп дата/время</td><td style="text-align: right;text-shadow: 1px 1px 1px #000;">	Есть</td></tr>
<tr><td>Штамп гос.номера</td><td style="text-align: right;text-shadow: 1px 1px 1px #000;">	Есть</td></tr>
<tr><td>Штамп геолокации</td><td style="text-align: right;text-shadow: 1px 1px 1px #000;">	Есть</td></tr>
<tr><td>G-sensor	</td><td style="text-align: right;text-shadow: 1px 1px 1px #000;">Есть</td></tr>
<tr><td>Датчик движения	</td><td style="text-align: right;text-shadow: 1px 1px 1px #000;">Есть</td></tr>
<tr><td>Режим парковки	</td><td style="text-align: right;text-shadow: 1px 1px 1px #000;">Есть</td></tr>
<tr><td>Непрерывная запись	</td><td style="text-align: right;text-shadow: 1px 1px 1px #000;">Есть</td></tr>
<tr><td>Автовключение	</td><td style="text-align: right;text-shadow: 1px 1px 1px #000;">Есть</td></tr>
<tr><td>Температурный режим, С°</td><td style="text-align: right;text-shadow: 1px 1px 1px #000;">	эксплуатация: -10/+60; хранение: -20/+70</td></tr>
<tr><td>Входное напряжение ЗУ</td><td style="text-align: right;text-shadow: 1px 1px 1px #000;">	DC 12/24В</td></tr>
<tr><td>Входное напряжение прибора</td><td style="text-align: right;text-shadow: 1px 1px 1px #000;">	DC 5В/1A</td></tr>
<tr><td>Размеры</td><td style="text-align: right;text-shadow: 1px 1px 1px #000;">	240 x 130 x 120мм</td></tr>



                </tbody>

            </table>
		</div>
	</section>

	<!-- /use steps -->

	<!-- reviews -->

	<section class="reviews_section" style="background: url(images/bg3.jpg);background-size: cover;background-position: center center;">
		<div class="wrapper">
			<h2>Отзывы <span style="color: #000;">довольных клиентов</span></h2>
			<div class="reviews_list">
				<div class="review_item clearfix">
					<div class="image_block">
						<img src="images/photo17.jpg" alt="DC 12V">
					</div>
					<div class="text_block">
						<h4>Иван Володосов</h4>
						<p>
							Начну с радар-детектора. Очень хорошая чувствительность прибора, на другие машины, двери заправок и прочие источники не реагирует. Зато не пропускает ни одного радара. Оповещает в звуковом режиме четко и понятно, работает во всех диапазонах радаров. Ночью снимает неплохо - различимы не только номера на удалении, но и мелкие шильдики. Прибор работает круглосуточно в течение почти месяца - пока без претензий!
						</p>
					</div>
				</div>
				<div class="review_item clearfix">
					<div class="image_block">
						<img src="images/photo18.jpg" alt="DC 12V">
					</div>
					<div class="text_block">
						<h4>Дмитрий Фролов</h4>
						<p>Сначала искал для себя обычный видеорегистратор, но по рекламе наткнулся на комбо-устройство Junsun. Был заинтересован функциями 3в1, а точнее радаром-детектором в комплекте с GPS. С такой функцией я как водитель чувствую себя намного спокойней, так как часто езжу в командировки на своем авто. Ну и видеорегистратор, из-за которого я в принципе и искал себе устройство для записи –камера мощная и хорошо обрабатывает изображение.</p>
					</div>
				</div>
				<div class="review_item clearfix">
					<div class="image_block">
						<img src="images/photo19.jpg" alt="DC 12V">
					</div>
					<div class="text_block">
						<h4>Олег Тихонов</h4>
						<p>Часто езжу по работе по России и странам СНГ, и после хамства на дорогах решил приобрести видеорегистратор. По отзывам и обзорам выбрал этот. Достаточно добротное снимает видео в SUPER HD, номера автомобилей без проблем различаются. Так же порадовал Android. Когда становится скучно, отлично скрашивает время! Доп. функции в виде вай-фай и блютус так же испробовал, иногда сильно выручают. В общем и целом, очень доволен, советую!</p>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- /reviews -->

	<!-- order steps -->

	<section class="order_steps_section">
		<div class="wrapper">
			<h2>КАК ЗАКАЗАТЬ <span>видеорегистратор Junsun?</span></h2>
			<div class="steps_list">
				<div class="step_item">
					<div class="image_block">
						<img src="images/order_steps__step1_image.jpg" alt="DC 12V">
						<div class="number">1</div>
					</div>
					<p>Вы оставляете заявку на&nbsp;нашем сайте</p>
				</div>
				<div class="step_item">
					<div class="image_block">
						<img src="images/order_steps__step2_image.jpg" alt="DC 12V">
						<div class="number">2</div>
					</div>
					<p>Наш менеджер уточняет&nbsp;детали заказа</p>
				</div>
				<div class="step_item">
					<div class="image_block">
						<img src="images/order_steps__step3_image.jpg" alt="DC 12V">
						<div class="number">3</div>
					</div>
					<p>Мы отправляем Ваш заказ почтой в любой регион</p>
				</div>
				<div class="step_item">
					<div class="image_block">
						<img src="images/order_steps__step4_image.jpg" alt="DC 12V">
						<div class="number">4</div>
					</div>
					<p>Вы оплачиваете заказ при&nbsp;получении</p>
				</div>
			</div>
		</div>
	</section>

	<!-- /order steps -->

	<!-- offer -->

	<div class="offer_title_section">
		<div class="wrapper">
			<h3>УСПЕЙТЕ ЗАКАЗАТЬ <span>видеорегистратор</span> ПО АКЦИОННОЙ ЦЕНЕ!</h3>
		</div>
	</div>

	<section class="offer_section" id="order_form">
		<div class="wrapper clearfix">
			<h1 class="main_title">ЗЕРКАЛО ВИДЕОРЕГИСТРАТОР 10 В 1 <span>Junsun</span></h1>
			<p class="subtitle">ваш главный помощник на дороге</p>
			<ul class="clearfix">
				<li>Видео 2304х1296 SUPER HD</li>
				<li>Угол обзора 170°</li>
				<li>Поддержка 4G и Wi-Fi</li>
				<li>Встроенный радар – детектор</li>
				<li>Выносная камера</li>
				<li>ОС Android 8.0</li>
			</ul>
			<div class="discount">Акция! <span>60%</span> скидка</div>
			<div class="form_block">
				<div class="timer_block">
					<p>Конец акции через:</p>
					<div class="timer clearfix">
						<div class="timer_item">
							<div class="count hours"></div>
							<div class="text">часов</div>
						</div>
						<div class="timer_item">
							<div class="count minutes"></div>
							<div class="text">минут</div>
						</div>
						<div class="timer_item">
							<div class="count seconds"></div>
							<div class="text">секунд</div>
						</div>
					</div>
				</div>
				<div class="price_block clearfix">
					<div class="price_item old">
						<div class="text">Обычная цена:</div>
						<div class="value">5980Руб</div>
					</div>
					<div class="price_item new">
						<div class="text">Цена сегодня:</div>
						<div class="value"><?php echo $price['real_price']; ?></div>
					</div>
				</div>
				<form class="order_form" action="./_success_/" method="post">
					<input type='hidden' name='referer' value="<?php echo isset($_GET['referer']) ? $_GET['referer'] : $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] ;?>">
<input type="hidden" name="subid1"  value="<?php echo isset($_GET['subid1']) ? $_GET['subid1'] : '' ;?>" />
<input type="hidden" name="subid2"  value="<?php echo isset($_GET['subid2']) ? $_GET['subid2'] : '' ;?>" />
<input type="hidden" name="subid3"  value="<?php echo isset($_GET['subid3']) ? $_GET['subid3'] : '' ;?>" />
<input type="hidden" name="subid4"  value="<?php echo isset($_GET['subid4']) ? $_GET['subid4'] : '' ;?>" />  
<input type="hidden" name="subid5"  value="<?php echo isset($_GET['subid5']) ? $_GET['subid5'] : '' ;?>" />
					<input class="field" type="text" name="name" placeholder="Введите Ваше имя" required>
					<input class="field" type="tel" name="phone" placeholder="Введите Ваш телефон" required>
					<button class="button">Заказать сейчас</button>
				</form>
				<div class="deadline_text">Количество видеорегистраторов ограничено</div>
			</div>
		</div>
	</section>

	<!-- /offer -->
<div style="text-align:center;">
                <p>ООО ГРАФИН ИНН 7726501063 ОГРН 1037789083452
 г. Москва, ул. Фруктовая, д. 7
</p>
</div>



	<!-- scripts -->
	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

	<script src="js/scripts.js"></script>
</body>
</html>