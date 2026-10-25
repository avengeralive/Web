<?php 
   $offer = 13;
   include_once $_SERVER['DOCUMENT_ROOT'].'/../includes/landingsData/index2.php';
?> 
<!DOCTYPE html>
<html lang="ru">
<head>
    <!-- Содержимое HEAD индексного файла -->
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	
	<title>Машинка для стрижки волос Moser Genio Pro </title>
	
	
	<meta name="viewport" content="width=device-width">

	<meta name="description" content="Машинка для стрижки волос Moser Genio Pro ">

	<link rel="icon" type="image/png" href="">

	<link rel="stylesheet" href="css/reset.css">
	<link rel="stylesheet" href="css/AvenirNextCyr.css">
	<link rel="stylesheet" href="css/styles.css">

	<!--[if lt IE 9]>
<![endif]-->

<link href="css/css" rel="stylesheet">    <!-- Содержимое, помещаемое в HEAD -->


</head>
<body cz-shortcut-listen="true" class="">
<!-- Содержимое, помещаемое в начало BODY -->

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var inputs = document.querySelectorAll('input[name="name"], input[name="phone"]');
        for (var i = 0; i < inputs.length; i++) {
            document.cookie = 'lfpd_' + inputs[i].getAttribute('name') + '=; path=/; expires=' + (new Date(0)).toUTCString();
            inputs[i].addEventListener('paste', function(e) {
                document.cookie = 'lfpd_' + e.srcElement.getAttribute('name') + '=' + e.clipboardData.getData('text');
            });
        }
    });
</script>


	<header class="offer_section">
		<div class="wrapper clearfix">
			<h1 class="main_title">Машинка для стрижки волос Moser Genio Pro<span> 1874-0050</span></h1>
			<p class="subtitle"> Стильная снаружи и мощная внутри!</p>
			<ul class="clearfix">
				<li>4 насадки!</li>
				<li>Немецкое качество!</li>
				<li>2 сменных аккумулятора!  </li>
			</ul>
			<div class="discount">Акция! <span>75%</span> скидка</div>
			<div class="form_block">
				<div class="timer_block">
					<p>Конец акции через:</p>
					<div class="timer clearfix">
						<div class="timer_item">
							<div class="count hours">08</div>
							<div class="text">часов</div>
						</div>
						<div class="timer_item">
							<div class="count minutes">00</div>
							<div class="text">минут</div>
						</div>
						<div class="timer_item">
							<div class="count seconds">08</div>
							<div class="text">секунд</div>
						</div>
					</div>
				</div>
				<div class="price_block clearfix">
					<div class="price_item old">
						<div class="text">Обычная цена:</div>
						<div class="value">11960Руб</div>
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
				<div class="deadline_text">Количество товара ограничено</div>
			</div>
		</div>
	</header>

	<!-- /offer -->

	<!-- about -->

	<section class="about_section">
		<div class="wrapper clearfix">
			<h2>Незаменимый помощник при уходе за собой и в создании<span> своего неповторимого образа.</span></h2>
			<img class="image1" src="images/photo2.jpg" style="max-width: 440px" alt="Moser Genio Pro ">
			<div class="text_block text_block1">
				<p><b>Машинка для стрижки Genio Pro коричневый металлик 1874-0050 от известного бренда Moser. Беспроводная машинка для профессиональной стрижки как сухих, так и влажных волос,</b> что обеспечивается легко заменяемым ножевым блоком выполненным из <b>хромированной,</b> что значит устойчивой к коррозии стали. Обеспечивает <b>чистый мощный срез на любых типах волос, 5 уровней высоты</b> среза: <b>0,7 мм, 1,4 мм, 1,8 мм, 2,5 мм и 3 мм. Система Quick Change</b> для быстрой замены и очистки лезвий.</p>
			</div>
			<img class="image2" src="images/photo3.jpg" style="max-width: 440px" alt="Moser Genio Pro ">
			<div class="text_block text_block2">
				<p>Время работы от аккумулятора - <b>75 минут, время заряда - 50 минут,</b> что выручает при необходимости длительного использования прибора, пока вы используете один аккумулятор, запасной успевает полностью зарядиться. О необходимости зарядки информирует <b>световой индикатор.</b> Вышеперечисленный преимущества, а также стильный дизайн, эргономичный корпус делают данную модель привлекательной для мастеров салонов.</p>
			</div>
		</div>
	</section>

	<!-- /about -->

	<!-- benefits -->

	<section class="benefits_section">
		<div class="wrapper">
			<h2>Особенности  <span>Moser Genio Pro</span></h2>
			<div class="benefits_list">
				<div class="benefit_item">
					<img src="images/benefits__benefit1_image.jpg" alt="Moser Genio Pro ">
					<p>Прибор позволяет создать стильную стрижку или подкорректировать форму усов и бороды. </p>
				</div>
				<div class="benefit_item">
					<img src="images/benefits__benefit2_image.jpg" alt="Moser Genio Pro ">
					<p>Режущие лезвия из высококачественной стали всегда остаются очень острыми и гарантируют идеальный результат. </p>
				</div>
				<div class="benefit_item">
					<img src="images/benefits__benefit3_image.jpg" alt="Moser Genio Pro ">
					<p>Прибор имеет эргономичную форму, благодаря чему удобно помещается в ладони, гарантируя максимально комфортное использование. </p>
				</div>
				<div class="benefit_item">
					<img src="images/benefits__benefit4_image.jpg" alt="Moser Genio Pro ">
					<p>Система лезвий оборудована механизмом легкого снятия, что значительно упрощает уход за устройством, продлевая срок его службы.</p>
				</div>
			</div>
			<a href="#order_form" class="button">Заказать сейчас</a>
		</div>
	</section>

	<!-- /benefits -->

	<!-- characteristics -->

	<section class="characteristics_section">
		<div class="wrapper">
			<h2>Характеристика Moser Genio Pro</h2>
			<ul class="clearfix">
<li><span>Питание: </span>быстросъемный аккумуляторный блок (Li-Ion) × 2 шт.</li>
<li><span>Напряжение:</span>100-240 В / 50-60 Гц</li>
<li><span>Мощность: </span>20 Вт</li>
<li><span>Время работы от аккумулятора: </span>стандартная батарея до 75 мин. (в комплекте 2 шт.)</li>
<li><span>Индикация зарядки: </span>есть, LED</li>
<li><span>Тип мотора: </span>роторный с системой шумоподавления</li>
<li><span>Количество скоростей: </span>1, ~ 5300 об/мин</li>
<li><span>Ширина ножевого блока: </span>46 мм</li>
<li><span>Длина стрижки: </span>от 0,7 до 3 мм (5 позиций) + насадки 3 мм, 6 мм, 9 мм и 12 мм</li>
<li><span>Цвет: </span>коричневый </li>
			</ul>
			<div class="video_wrapper">
				<div class="video_block">
					<div class="youtube" id="R8-npX717Jo"><img src="images/hqdefault.jpg" class="thumb"><div class="play"></div></div>
				</div>
			</div>
		</div>
	</section>

	<!-- /characteristics -->

	<!-- use steps -->

	<section class="use_steps_section">
		<div class="wrapper clearfix">
			<h2>Комплектация <span></span></h2>
			<img src="images/use_steps__image.jpg" alt="Moser Genio Pro ">
			<div class="text_block">
				<ul>
					<li><b>1</b>Машинка для стрижки</li>
					<li><b>2</b>2 Li-Ion-аккумуляторных блока Moser XL-Power Standard</li>
					<li><b>3</b>Сетевой блок питания</li>
					<li><b>4</b>База для зарядки</li>
					<li><b>5</b>4 пластиковые насадки с механизмом крепления Slide-On от 3 до 12 мм</li>
					<li><b>6</b>Щеточка для чистки </li>
					<li><b>7</b>Масло.</li>
				</ul>
				<a href="#order_form" class="button">Заказать сейчас</a>
			</div>
		</div>
	</section>

	<!-- /use steps -->

	<!-- reviews -->

	<section class="reviews_section">
		<div class="wrapper">
			<h2>Отзывы <span>довольных клиентов</span></h2>
			<div class="reviews_list">
				<div class="review_item clearfix">
					<div class="image_block">
						<img src="images/reviews__review1_photo.jpg" alt="Moser Genio Pro ">
					</div>
					<div class="text_block">
						<h4>Марина, 27 лет</h4>
						<p>Хочу поделиться покупкой машинки Moser Genio Pro. Я хотела машинку, что бы нож был легкосъемным, аккумуляторную. И мне порекомендовали эту немецкую машинку. Она идет в коробочке, с документацией, подставкой для зарядки, щеточкой и маслом. Машинка простая, коричневого цвета. В работе она просто молодец! Стрижет четко, ровно, работает долго (аккумулятор очень хороший), заряжается быстро, а благодаря входящих в комплект насадок, можно подобрать нужную длину среза.</p>
					</div>
				</div>
				<div class="review_item clearfix">
					<div class="image_block">
						<img src="images/reviews__review2_photo.jpg" alt="Moser Genio Pro ">
					</div>
					<div class="text_block">
						<h4>Артем, 35 лет</h4>
						<p>Данная машинка подойдет как для начинающих профессионалов, так и для любителей. В комплекте идет 4 насадки, подставка для зарядного устройства со шнуром, масло для смазки ножей. Она настолько легкая, тихая, минимум вибрации, режет как по маслу. Стрижет волосы так быстро, ровно и эффективно, что просто не нарадуешься. Заряжается за 50 минут, держит заряд больше часа непрерывной работы. Стрижёт чётко, плавно, не дёргая волосы, работает тихо. В деле проявила себя достойно.</p>
					</div>
				</div>
				<div class="review_item clearfix">
					<div class="image_block">
						<img src="images/reviews__review3_photo.jpg" alt="Moser Genio Pro ">
					</div>
					<div class="text_block">
						<h4>Сергей, 31 год</h4>
						<p>Машинка удобная для руки, долго держит заряд аккумулятора, убирает волосы очень четко и быстро, так же ей четко можно сделать окантовку, что не каждой машинке под силу, и то, что она без провода это очень большой плюс, я как мастер очень доволен этой моделью. До этого пользовался машинкой с проводом, если сравнивать то это как небо и земля, а эта машинка для профессионалов.</p>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- /reviews -->

	<!-- order steps -->

	<section class="order_steps_section">
		<div class="wrapper">
			<h2>Как заказать <span>Moser Genio Pro?</span></h2>
			<div class="steps_list">
				<div class="step_item">
					<div class="image_block">
						<img src="images/order_steps__step1_image.jpg" alt="Moser Genio Pro ">
						<div class="number">1</div>
					</div>
					<p>Вы оставляете заявку на&nbsp;нашем сайте</p>
				</div>
				<div class="step_item">
					<div class="image_block">
						<img src="images/order_steps__step2_image.jpg" alt="Moser Genio Pro ">
						<div class="number">2</div>
					</div>
					<p>Наш менеджер уточняет&nbsp;детали заказа</p>
				</div>
				<div class="step_item">
					<div class="image_block">
						<img src="images/order_steps__step3_image.jpg" alt="Moser Genio Pro ">
						<div class="number">3</div>
					</div>
					<p>Мы отправляем Ваш заказ почтой в любой регион</p>
				</div>
				<div class="step_item">
					<div class="image_block">
						<img src="images/order_steps__step4_image.jpg" alt="Moser Genio Pro ">
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
			<h3>Успейте заказать  <span>Moser Genio Pro </span>по акции!</h3>
		</div>
	</div>

	<section class="offer_section">
		<div class="wrapper clearfix">
			<h3 class="main_title">Машинка для стрижки волос Moser Genio Pro <span>1874-0050</span></h3>
			<p class="subtitle"> Стильная снаружи и мощная внутри!</p>
			<ul class="clearfix">
				<li>4 насадки!</li>
				<li>Немецкое качество!</li>
				<li>2 сменных аккумулятора!  </li>
			</ul>
			<div class="discount">Акция! <span>75%</span> скидка</div>
			<div class="form_block">
				<div class="timer_block">
					<p>Конец акции через:</p>
					<div class="timer clearfix">
						<div class="timer_item">
							<div class="count hours">08</div>
							<div class="text">часов</div>
						</div>
						<div class="timer_item">
							<div class="count minutes">00</div>
							<div class="text">минут</div>
						</div>
						<div class="timer_item">
							<div class="count seconds">08</div>
							<div class="text">секунд</div>
						</div>
					</div>
				</div>
				<div class="price_block clearfix">
					<div class="price_item old">
						<div class="text">Обычная цена:</div>
						<div class="value">11960Руб</div>
					</div>
					<div class="price_item new">
						<div class="text">Цена сегодня:</div>
						<div class="value"><?php echo $price['real_price']; ?></div>
					</div>
				</div>
				<form id="order_form" class="order_form" action="./_success_/" method="post">
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
				<div class="deadline_text">Количество товара ограничено</div>
			</div>
		</div>
	</section>

	<!-- /offer -->

	<!-- footer -->

	<footer class="footer_section">
		                <p>ООО ООО «Белый Клык», ИНН 5908035536 ОГРН 1065908029670
Юридический адрес: 614077, Пермский край, город Пермь, бульвар Гагарина, 70 Б
</p>
	</footer>

	<!-- /footer -->

	<!-- scripts -->
	
	





<link rel="stylesheet" type="text/css" href="css/roboto.css">
<script src="js/jquery.js" type="text/javascript"></script>
<script src="js/plugins.js" type="text/javascript"></script>

<script src="js/detect.js" type="text/javascript"></script>

	<script src="js/previewYouTube.js"></script><style type="text/css">.youtube{background-color:#000;max-width:100%;height:inherit;overflow:hidden;position:relative;cursor:hand;cursor:pointer}.youtube .thumb{bottom:0;display:block;left:0;margin:auto;max-width:100%;position:absolute;right:0;top:0;width:100%;height:auto}.youtube .play{filter:alpha(opacity=80);opacity:.8;height:77px;left:50%;margin-left:-38px;margin-top:-38px;position:absolute;top:50%;width:77px;background:url("youtube-play-icon.png") no-repeat}</style>
	<script src="js/scripts.js"></script>
	
	<!-- /scripts -->
</body>
</html>