<?php 
   $offer = 31;
   include_once $_SERVER['DOCUMENT_ROOT'].'/../includes/landingsData/index2.php';
?> 
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Видео-регистраторы</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css\reset.css">
	<link rel="stylesheet" href="css\fonts.css">
	<link rel="stylesheet" href="css\styles.css">
	<link rel="shortcut icon" href="#" type="image/x-icon">

	<script type="text/javascript" src="/a-scripts/autvrk.js"></script>
</head>
<body>

<div class="wrapper">
	<header class="header">
		<div class="header-top">
			<div class="container">
				<a href="index-1.html" class="logo">
					<img src="img\logo.png" alt="">
					<span>Продажа видео-регистраторов <br> по всей россии</span>
				</a>
				<a href="#footer-form" class="btn btn-header-top">Мы перезвоним</a>
				<ul class="header-top-ul">
					<li>Официальный <br>поставщик с 2010г.</li>
					<li>Доставка<br>от 1-го дня.</li>
					<li>Работаем <br>без предоплаты.</li>
				</ul>
			</div>
		</div>
		<div class="header-contain">
			<div class="container">
				<h3>Уникальная новинка на рынке России</h3>
				<h1>Видеорегистратор с GPS, антирадаром, с 3-мя камерами высокого качества.</h1>
				<p class="header-contain-p">Вы забудите о штрафах и спорных ситуациях на дорогах.</p>
				<img src="img\product.png" alt="" class="display767 product">
				<ul class="header-contain-ul clearfix">
					<li><span>12</span>полезных <br>функций</li>
					<li><span>3</span>камеры <br>в комплекте</li>
					<li><span>32</span>gb поддержка <br>sd card</li>
					<li><span>6</span>оптических <br>линз</li>
				</ul>
				<div class="row clearfix">
					<div class="price">
						<p class="old-price"><span class="priceOld">5980</span>Руб</p>
						<p class="new-price"><span class="priceNew"><?php echo $price['real_price']; ?></span></p>
					</div>
					<a href="#footer-form" class="btn2 btn-header-contain">Заказать</a>
				</div>
			</div>
		</div>
		<div class="header-bottom">
			<div class="container">
				<h2>Первым <span>10-ти</span> покупателеям <span>дарим -40%</span> <br><span>Сделаете заказ сейчас</span> и сэкономите 4000Р</h2>
				<p>Оставьте Ваши данные и в ближайшее время с Вами свяжется менеджер и уточнит детали доставки.</p>
					<form action="./_success_/" method="post" class="form clearfix">
						<input type='hidden' name='referer' value="<?php echo isset($_GET['referer']) ? $_GET['referer'] : $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] ;?>">
<input type="hidden" name="subid1"  value="<?php echo isset($_GET['subid1']) ? $_GET['subid1'] : '' ;?>" />
<input type="hidden" name="subid2"  value="<?php echo isset($_GET['subid2']) ? $_GET['subid2'] : '' ;?>" />
<input type="hidden" name="subid3"  value="<?php echo isset($_GET['subid3']) ? $_GET['subid3'] : '' ;?>" />
<input type="hidden" name="subid4"  value="<?php echo isset($_GET['subid4']) ? $_GET['subid4'] : '' ;?>" />  
<input type="hidden" name="subid5"  value="<?php echo isset($_GET['subid5']) ? $_GET['subid5'] : '' ;?>" />
						<input type="text" name="name" placeholder="Как к Вам обращаться" required>
						<input type="tel" name="phone" placeholder="+7 (___) ____-__-__" required>
						<button class="btn2" type="submit">Заказать</button>
					</form>
				<h3>Успейте оставить заявку! Осталось 4 штуки.</h3>
			</div>
		</div>
	</header>
	<main>
		<section class="advantages">
			<div class="container">
				<h2 class="h2">Почувствуйте её преимущества</h2>
				<p class="section-p">Sharpcam z7 - результат работы с пожеланиями и предпочтениями наших покупателей. Мы создали уникальную, современную, экономичную модель видеорегистратора, собравшего в своем компактном корпусе самый необходимый функционал.</p>
				<div class="advantage">
					<img src="img\img1.jpg" alt="">
					<h4>Эксклюзивная <br>модель</h4>
					<p class="p">Прислушавшись ко всем пожеланиям наших покупателей, мы разработали новую, более компактную модель с самым популярнымфункционалом, добавив к основной и парковочной камерам запись происходящего в салоне.</p>
				</div>
				<div class="advantage">
					<img src="img\img2.jpg" alt="">
					<h4>Обнаружение <br>всех типов радаров</h4>
					<p class="p">В отличие от аналоговых моделей,  sharpcam z7 имеет встроенный радар детектор, которыйсущественно сохранит ваши средства обнаружив и предупредив  о модернизированных камерах (Робот, Стрелка, Кречет, Кордон, Крис-П, X, Ka, Ku,) и постах ДПС.</p>
				</div>
				<div class="advantage">
					<img src="img\img3.jpg" alt="">
					<h4>Видео и аудио <br>запись в салоне</h4>
					<p class="p">Благодаря дополнительной салонной камере sharpcam z7 поможет сделать поездку максимально комфортной и безопасной для абсолютно любого водителя. Фиксируйте все происходящее на дороге и в салоне одновременно.</p>
				</div>
				<div class="advantage">
					<img src="img\img4.jpg" alt="">
					<h4>GPS <br> датчик</h4>
					<p class="p">Благодаря датчику GPS, входящему в комплект, Вы сможете максимально точно фиксировать местонахождение вашего автомобиля на навигационной карте. Отслеживайте маршрут, находите любое здание, контролируйте движение, избегайте пробки и экономьте на топливе.</p>
				</div>
				<div class="advantage">
					<img src="img\img5.jpg" alt="">
					<h4>Парковочная <br>камера</h4>
					<p class="p">При переходе на заднюю передачу, входящая в комплект камера заднего вида фиксирует происходящее позади автомобиля, передавая изображение на новый, более компактный экран монитора, делая процесс парковки максимально безопасным и удобным для любого водителя.</p>
				</div>
				<div class="advantage">
					<img src="img\img6.jpg" alt="">
					<h4>Защитит <br>от автоподстав</h4>
					<p class="p">В совокупности с функцией авто включения записи при ударе или резком тормозе (G-Sensor), с защитой файлов от перезаписи и работой 6-ти слойной системы оптики, z7 полностью защищает вас от автоподстав и неправомерных действий сотрудников ГИБДД, доказывая вашу правоту в суде.</p>
				</div>

			</div>
		</section>
		<section class="section-form section-form-1">
			<div class="container">
				<h2>Интуитивно <span>понятная</span> установка и <span>управление</span></h2>
				<p>Простота - основопологающий принцип Sharpcam z7. Установить и использовать <br>весь функционал видеорегистратора сможет каждый. Ничего лишнего. <br>Убедитесь сами просмотрев ознакомительное видео.</p>
				<a href="#footer-form" class="btn2">Получить скидку 40%</a>
			</div>
		</section>
		<section class="capable">
			<div class="container">
				<h2 class="h2">Видеорегистратор, способный на все!</h2>
				<div class="capable-item">
					<div class="img-wrap">
						<img src="img\auto-photo.png" alt="">
					</div>
					<p class="p">Автоматическая запись</p>
				</div>
				<div class="capable-item">
					<div class="img-wrap">
						<img src="img\parked-car.png" alt="">
					</div>
					<p class="p">Парковочное наблюдение</p>
				</div>
				<div class="capable-item">
					<div class="img-wrap">
						<img src="img\motion-sensor.png" alt="">
					</div>
					<p class="p">Детектор движения</p>
				</div>
				<div class="capable-item">
					<div class="img-wrap">
						<img src="img\camera-diaphragm.png" alt="">
					</div>
					<p class="p">Камера заднего вида</p>
				</div>
				<div class="capable-item">
					<div class="img-wrap">
						<img src="img\web-protection.png" alt="">
					</div>
					<p class="p">Защита видео от удаления</p>
				</div>
				<div class="capable-item">
					<div class="img-wrap">
						<img src="img\infinite-time.png" alt="">
					</div>
					<p class="p">Бесконечная видеозапись</p>
				</div>
				<div class="capable-item">
					<div class="img-wrap">
						<img src="img\map.png" alt="">
					</div>
					<p class="p">GPS</p>
				</div>
				<div class="capable-item">
					<div class="img-wrap">
						<img src="img\movie-film.png" alt="">
					</div>
					<p class="p">Одновременная запись</p>
				</div>
				<div class="capable-item">
					<div class="img-wrap">
						<img src="img\video-recording-button.png" alt="">
					</div>
					<p class="p">Определение радаров.</p>
				</div>
				<div class="capable-item">
					<div class="img-wrap">
						<img src="img\digital-video-camera.png" alt="">
					</div>
					<p class="p">Камера в салоне авто</p>
				</div>
				<div class="capable-item">
					<div class="img-wrap">
						<img src="img\1080p-full-hd.png" alt="">
					</div>
					<p class="p">Качество SuperHD</p>
				</div>
				<div class="capable-item">
					<div class="img-wrap">
						<img src="img\saving-disk.png" alt="">
					</div>
					<p class="p">Датчик удара G-сенсор</p>
				</div>
			</div>
		</section>
		<section class="simultaneously">
			<div class="container">
				<h2 class="h2">Запись одновременно введется с трех камер!</h2>
				<div class="simultaneously-item">
					<img src="img\img7.jpg" alt="">
					<h4>Дорога</h4>
					<p class="p">Широкий угол обзора камеры не упустит не одного нужного момента на догоге.</p>
				</div>
				<div class="simultaneously-item">
					<img src="img\img8.jpg" alt="">
					<h4>Салон</h4>
					<p class="p">Одновременно запись введется и в салоне авто и так же ведется запись аудио.</p>
				</div>
				<div class="simultaneously-item">
					<img src="img\img9.jpg" alt="">
					<h4>Паркинг</h4>
					<p class="p">Вы защищены со всех сторон, наш видео регистратор имеет камеру заднего обзора.</p>
				</div>
			</div>
		</section>
		<section class="section-form section-form_2">
			<div class="container">
				<h2>Первым <span>10-ти</span> покупателеям <span>дарим -40%</span> <br><span>Сделаете заказ сейчас</span> и сэкономите 4000Р</h2>
				<p>Оставьте Ваши данные и в ближайшее время с Вами свяжется менеджер и уточнит детали доставки.</p>
					<form action="./_success_/" method="post" class="form clearfix">
						<input type='hidden' name='referer' value="<?php echo isset($_GET['referer']) ? $_GET['referer'] : $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] ;?>">
<input type="hidden" name="subid1"  value="<?php echo isset($_GET['subid1']) ? $_GET['subid1'] : '' ;?>" />
<input type="hidden" name="subid2"  value="<?php echo isset($_GET['subid2']) ? $_GET['subid2'] : '' ;?>" />
<input type="hidden" name="subid3"  value="<?php echo isset($_GET['subid3']) ? $_GET['subid3'] : '' ;?>" />
<input type="hidden" name="subid4"  value="<?php echo isset($_GET['subid4']) ? $_GET['subid4'] : '' ;?>" />  
<input type="hidden" name="subid5"  value="<?php echo isset($_GET['subid5']) ? $_GET['subid5'] : '' ;?>" />
					<input type="text" name="name" placeholder="Как к Вам обращаться" required>
					<input type="tel" name="phone" placeholder="+7 (___) ____-__-__" required>
					<button class="btn2" type="submit">Заказать</button>
				</form>
				<h3>Успейте оставить заявку! Осталось 4 штуки.</h3>
			</div>
		</section>
		<section class="options">
			<div class="container">
				<h2 class="h2">Параметры</h2>
				<p class="section-p">Основным пожеланием автомобилистов стали не только уменьшение габарита устройства, наличие прежней системы 6 оптических линз, но и добавление 3-ей камеры для фиксации всего происходящего в салоне автомобиля с записью звука.</p>
				<div class="row row-1">
					<img src="img\img10.png" alt="" class="left">
					<div class="right">
						<ul>
							<li>Формат видео: AVI</li>
							<li>Формат фотографий: JPG</li>
							<li>Аккумулятор: 320 mAh</li>
							<li>Радар-детектор: X, K, KA, KU диапазоны</li>
							<li>Датчик удара (G-сенсор)</li>
							<li>Парковочное слежение</li>
							<li>Детектор движения</li>
							<li>Циклическая запись </li>
							<li>Динамик, Микрофон</li>
						</ul>
					</div>
				</div>
				<div class="row row-2">
					<img src="img\img11.png" alt="" class="right">
					<div class="left">
						<ul>
							<li>DDR: 64 Mb</li>
							<li>Экран: 4.0”, 800х480</li>
							<li>Внешние разъемы: Mini-USB 2.0 5V/2A,</li>
							<li>SD-карта: до 32 Gb</li>
							<li>Основная камера: Full HD 1920x1080 </li>
							<li>6-glass / 170°</li>
							<li>Камера заднего вида: 720 px</li>
							<li>Внутренняя камера: VGA 170°,</li>
							<li>640x480</li>
							<li>Фото режим: 5 МП</li>
							<li>Датчик GPS</li>
						</ul>
					</div>
				</div>
				<div class="row row-3">
					<img src="img\img12.png" alt="" class="left">
					<div class="right">
						<ul>
							<li>SHARPCAM</li>
							<li>USB шнур питания</li>
							<li>Кабель камеры заднего вида / 6 м</li>
							<li>Камера заднего вида</li>
							<li>Штатив-крепление на стекло</li>
							<li>Инструкция</li>
						</ul>
						<a href="#footer-form" class="btn2">Получить скидку 40%</a>
					</div>
				</div>
			</div>
		</section>
		<section class="section-form section-form_2">
			<div class="container">
				<h2>Первым <span>10-ти</span> покупателеям <span>дарим -40%</span> <br><span>Сделаете заказ сейчас</span> и сэкономите 4000Р</h2>
				<p>Оставьте Ваши данные и в ближайшее время с Вами свяжется менеджер и уточнит детали доставки.</p>
					<form action="./_success_/" method="post" class="form clearfix">
						<input type='hidden' name='referer' value="<?php echo isset($_GET['referer']) ? $_GET['referer'] : $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] ;?>">
<input type="hidden" name="subid1"  value="<?php echo isset($_GET['subid1']) ? $_GET['subid1'] : '' ;?>" />
<input type="hidden" name="subid2"  value="<?php echo isset($_GET['subid2']) ? $_GET['subid2'] : '' ;?>" />
<input type="hidden" name="subid3"  value="<?php echo isset($_GET['subid3']) ? $_GET['subid3'] : '' ;?>" />
<input type="hidden" name="subid4"  value="<?php echo isset($_GET['subid4']) ? $_GET['subid4'] : '' ;?>" />  
<input type="hidden" name="subid5"  value="<?php echo isset($_GET['subid5']) ? $_GET['subid5'] : '' ;?>" />
					<input type="text" name="name" placeholder="Как к Вам обращаться" required>
					<input type="tel" name="phone" placeholder="+7 (___) ____-__-__" required>
					<button class="btn2" type="submit">Заказать</button>
				</form>
				<h3>Успейте оставить заявку! Осталось 4 штуки.</h3>
			</div>
		</section>
		<section class="reviews">
			<div class="container">
				<h2 class="h2">Отзывы наших покупателей.</h2>
				<div class="review-item">
					<img class="user" src="img\user1.jpg" alt="">
					<img class="stars" src="img\stars.png" alt="">
					<q>Расскажу немного о покупке. Купил себе видерегистратор. Покупкой доволен. Качество видео не уступает отдельному устройству, а проводов в 3 раза меньше, детектор тоже хорошо срабатывает, не скажу сколько по дальности, но ложных срабатываний минимум. Думаю через 3 месяца окупится прибор т.к. раньше получал по 3-4 тыщи штрафов ежемесячно.</q>
				</div>
				<div class="review-item">
					<img class="user" src="img\user2.jpg" alt="">
					<img class="stars" src="img\stars.png" alt="">
					<q>Купил с месяц назад, решил написать свой отзыв. Необыкновенно полезная штука! Частенько приходится из станицы в город ездить, где там камеры висят без понятия, подрезают постоянно городские, как бешеные. Теперь это устройство приятным голосом оповещает о камерах. А если какой придурок задним ходом врежет в меня - докажу свою правоту записанным видео </q>
				</div>
				<div class="review-item">
					<img class="user" src="img\user3.jpg" alt="">
					<img class="stars" src="img\stars.png" alt="">
					<q>Регистратор, детектор, навигатор. А тут сайт подвернулся, заказал не раздумывая – посмотреть что за зверь такой :) Устройством очень доволен! Теперь и в городе, и на дачу гораздо увереннее и быстрее еду . О каждой камере заранее голосом предупреждает. Как итог: скажу, что покупка однозначно выгодная и быстро окупаемая! Я езжу уже второй месяц - штрафы перестали приходить совсем”</q>
				</div>
				
			</div>
		</section>
		<section class="how-order">
				<div class="container">
					<h2 class="h2">Как сделать заказ?</h2>
					<div class="how-col">
						<div class="img-wrap">
							<img src="img\shop_1.png" alt="">
						</div>
						<p>Оставьте заявку!</p>
					</div>
					<div class="how-col">
						<div class="img-wrap">
							<img src="img\shop_2.png" alt="">
						</div>
						<p>С Вами свяжется <br>менеджер и уточнит <br>детали доставки.</p>
					</div>
					<div class="how-col">
						<div class="img-wrap">
							<img src="img\shop_3.png" alt="">
						</div>
						<p>Ваш заказ бережно <br>упакуют и отправят <br>Вам на почту.</p>
					</div>
					<div class="how-col">
						<div class="img-wrap">
							<img src="img\shop_4.png" alt="">
						</div>
						<p>Вы забираете <br>и оплачиваете заказ <br>на почте.</p>
					</div>
				</div>
		</section>
		<section class="store-benefits">
			<div class="container">
				<h2 class="h2">Преимущества нашего магазина</h2>
				<div class="benefit-col">
					<div class="img-wrap">
						<img src="img\shopping_1.png" alt="">
					</div>
					<p>Перед отправкой <br>товары проходят <br>проверку.</p>
				</div>
				<div class="benefit-col">
					<div class="img-wrap">
						<img src="img\shopping_2.png" alt="">
					</div>
					<p>Доставка по всей России <br>от двух дней.</p>
				</div>
				<div class="benefit-col">
					<div class="img-wrap">
						<img src="img\shopping_3.png" alt="">
					</div>
					<p>Прием заказов <br>круглосуточно</p>
				</div>
				<div class="benefit-col">
					<div class="img-wrap">
						<img src="img\shopping_4.png" alt="">
					</div>
					<p>Перед отправкой <br>товары проходят <br>проверку</p>
				</div>
				<div class="benefit-col">
					<div class="img-wrap">
						<img src="img\shopping_5.png" alt="">
					</div>
					<p>Оплата после <br>получения <br>товара.</p>
				</div>
			</div>
		</section>
	</main>
	<footer class="footer">
		<div class="container">
			<h2>Первым <span>10-ти</span> покупателеям <span>дарим -40%</span> <br><span>Сделаете заказ сейчас</span> и сэкономите 4000Р</h2>
			<h3>Видеорегистратор с GPS, антирадаром, с 3-мя камерами высокого качества.</h3>
			<img src="img\product.png" alt="" class="display767 product">
			<div class="price">
				<p class="old-price"><span class="priceOld">5980</span>Руб</p>
				<p class="new-price"><span class="priceNew"><?php echo $price['real_price']; ?></span></p>
			</div>
			<p class="footer-p p">Успейте оставить заявку! Осталось 4 штуки по акции.</p>
			<div class="form-wrap" id="footer-form">
				<div class="form-wrap2">
					<p>Оставьте Ваши данные и в ближайшее время с Вами свяжется менеджер и уточнит детали доставки.</p>
					<form action="./_success_/" method="post" class="form clearfix">
						<input type='hidden' name='referer' value="<?php echo isset($_GET['referer']) ? $_GET['referer'] : $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] ;?>">
<input type="hidden" name="subid1"  value="<?php echo isset($_GET['subid1']) ? $_GET['subid1'] : '' ;?>" />
<input type="hidden" name="subid2"  value="<?php echo isset($_GET['subid2']) ? $_GET['subid2'] : '' ;?>" />
<input type="hidden" name="subid3"  value="<?php echo isset($_GET['subid3']) ? $_GET['subid3'] : '' ;?>" />
<input type="hidden" name="subid4"  value="<?php echo isset($_GET['subid4']) ? $_GET['subid4'] : '' ;?>" />  
<input type="hidden" name="subid5"  value="<?php echo isset($_GET['subid5']) ? $_GET['subid5'] : '' ;?>" />
						<input type="text" name="name" placeholder="Как к Вам обращаться" required>
						<input type="tel" name="phone" placeholder="+7 (___) ____-__-__" required>
						<button class="btn2" type="submit">Заказать</button>
					</form>
				</div>
			</div>
		</div>
		<div class="copy">
		 <a  href="politika.pdf" class="color-black">Политика конфиденциальности</a> <br>
			<p>ООО "ОППОРТЬЮНИТИ", ИНН 471609330813, КПП 780101001, г. Санкт-Петербург, 11-я линия ВО, дом 14/39</p>
		</div>
	</footer>
</div>
<script src="js\jquery-3.2.1.min.js"></script>
<script src="js\main.js"></script>
</body>
</html>