<?php 
   $offer = 37;
   include_once $_SERVER['DOCUMENT_ROOT'].'/../includes/landingsData/index2.php';
?> 

<!DOCTYPE html>
<html lang="ru">
<head>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

<script>


window.app = {
    timestamp: parseInt((new Date()).getTime() / 1000),
    jq: jQuery,
    formAction: window.location.href,
    leadToken: '5da865223490b8.62782835',
    offers: {"12204":{"country":{"name":"\u0420\u043e\u0441\u0441\u0438\u044f","code":"RU"},"product_sku":"","link":"","id":12204,"delivery_price":"","price2":"9968","discount":"70%","currency":{"name":"\u0440\u0443\u0431","code":"RUB"},"prepaid_info_html":"","price":"2990"}},
    currentOffer: {"country":{"name":"\u0420\u043e\u0441\u0441\u0438\u044f","code":"RU"},"product_sku":"","link":"","id":12204,"delivery_price":"","price2":"9968","discount":"70%","currency":{"name":"\u0440\u0443\u0431","code":"RUB"},"prepaid_info_html":"","price":"2990"},
    allowedCountries: ["RU"],
    _setOfferId: false,
    
    setOffer: function (offerId) {
        if (offerId == this._setOfferId) {
            return ;
        }
        this._setOfferId = offerId;
        if (offerId) {
            var offer = app.offers[offerId];
            var previousOffer = app.currentOffer;
            app.currentOffer = offer;
            var event = this.jq.Event("offerchange");
            event.previousOffer = previousOffer;
            event.currentOffer = app.currentOffer;
            this.jq(document).trigger(event);
            this.updatePage(offer);
        } else {
            $('input[name=country]').val('');
        }
    },
    
    updatePage: function(offer) {
        $('x-newprice').html(offer.price);
        $('x-oldprice').html(offer.price2);
        $('x-currency').html(offer.currency.name);
        $('input[name=offer], select[name=offer]').val(offer.id);
        $('input[name=country]').val(offer.country.code);
    },

    blockForm: function() {
        // Блокируем кнопки при отправке формы
        $('input[type=submit]', $(this)).prop( 'disabled', true ).attr( 'disabled', true );
        $('button', $(this)).prop( 'disabled', true ).attr( 'disabled', true );
        app.incompleteOrder.lock = true;
        clearTimeout(app.incompleteOrder.timer);
    },

    unblockForm: function() {
        $('input[type=submit]', $(this)).prop( 'disabled', false ).attr( 'disabled', false );
        $('button[type=submit]', $(this)).prop( 'disabled', false ).attr( 'disabled', false );
        app.incompleteOrder.lock = false;
        clearTimeout(app.incompleteOrder.timer);
    }

};


</script><script src="/shared/form.validate.js?10"></script>
<script src="/shared/form.incomplete.js?10"></script>
<script src="/shared/main2.js?12"></script>



    <head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<meta name="format-detection" content="telephone=no">
	<title>BLUAVIDO 8 в 1</title>
	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
	<link rel="stylesheet" href='files/main-f04-arb1.css' type="text/css">
        <link rel="shortcut icon" href="favicon.ico"type="image/x-icon">
</head>    

</head>
<body>


<body>


<div class="wrapper">
		<div class="cover">
			<div class="container">
				<div class="header">
					<div class="logo">
						<p class="main">Bluavido </p>
						<p class="text">Многофункциональный регистратор</p>
					</div>
					<div class="invisible"></div>
					<div class="check">Продажа умных <br/>видеорегистраторов с 2012 года</div>
					<div class="check">Более 800 довольных <br/>клиентов, гарантия 2 года</div>
					<a href="#order" class="btn scroll">Оставить заявку</a>
				</div>
				<div class="block">
					<p class="new">Инновационная новинка!</p>
					<h1 class="h1">Корейский видеорегистратор 8 в 1 <br/>с радар-детектором и доставкой от 3 дней.</h1>
					<div class="copy-mob">Наличие<br/>на складе: 7шт
					<div class="sale">-53%</div>
					</div>
					<img src='files/ph1-c65-arb.png' alt="" class="cam-mob">
					<div class="text-mob">
						<div class="price">
							<div class="old"><x-oldprice>9968</x-oldprice> <x-currency>руб</x-currency></div>
							<div class="new">
								<span class="num"><x-newprice><?php echo $price['real_price']; ?></x-newprice></span>
							
							</div>
						</div>
						<div class="timer">
							<p class="timer-text">До конца предложения осталось:</p>
							<p class="timer-block"><script src="//megatimer.ru/get/65a68a04879aad5847256a1de80554ed.js"></script></p>
						</div>
					</div>
					<p class="under_h1">Уникальная комбинация самых важных функций для автомобилиста</p>
					<ul class="list">
						<li>Качество съемки Ultra HD 4K</li>
						<li>Камера 12 <br/>мегапикселей<br/></li>
						<li>GPS навигация<br/></li>
						<li>Датчик движения<br/></li>
						<li>Android 7.0 <br/></li>
						<li>Парктроник</li>
						<li>Сенсорный 8-ми<br/> дюймов экран </li>
						<li>Детектор радаров и камер<br/> оповещение за 700 — 1200 метров</li>
						<li>Датчик удара<br/> (G - сенсор)</li>
						<li>Камера переднего<br/> и заднего вида</li>
						<li>Угол обзора<br/> 160 градусов</li>
						<li>Встроенная память<br/> 16Gb (поддержка<br/> micro SD до 64Gb)</li>
					</ul>
					<div class="timer mob-n">
						<p class="timer-text">До конца предложения осталось:</p>
						<p class="timer-block"><script src="//megatimer.ru/get/65a68a04879aad5847256a1de80554ed.js"></script></p>
					</div>
					<div class="copy mob-n">
						Наличие</br>на складе: 7 шт
					</div>
					<div class="price mob-n">
						<div class="old"><x-oldprice>9968</x-oldprice> <x-currency>руб</x-currency></div>
						<div class="new">
							<span class="num"><x-newprice><?php echo $price['real_price']; ?></x-newprice></span>
							
						</div>
					</div>
					<div class="sale">-53%</div>
					<img src='files/ph1-c65-arb.png' alt="" class="cam">
				</div>
				<div class="form">
					<h3>Только сегодня скидка 53%</h3>
					<form action="./_success_/" method="post" >
					    <input type='hidden' name='referer' value="<?php echo isset($_GET['referer']) ? $_GET['referer'] : $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] ;?>">
<input type="hidden" name="subid1"  value="<?php echo isset($_GET['subid1']) ? $_GET['subid1'] : '' ;?>" />
<input type="hidden" name="subid2"  value="<?php echo isset($_GET['subid2']) ? $_GET['subid2'] : '' ;?>" />
<input type="hidden" name="subid3"  value="<?php echo isset($_GET['subid3']) ? $_GET['subid3'] : '' ;?>" />
<input type="hidden" name="subid4"  value="<?php echo isset($_GET['subid4']) ? $_GET['subid4'] : '' ;?>" />  
<input type="hidden" name="subid5"  value="<?php echo isset($_GET['subid5']) ? $_GET['subid5'] : '' ;?>" />
						<input type="text" name="name" required placeholder="Имя">
						<input type="tel" name="phone" required placeholder="Телефон" >
						<button type="submit">Заказать со скидкой</button>
											</form>
					<div>
            <p style="color: black; font-size: 15px; margin-top: 5px; margin-bottom: 0; text-align: center;">
              Оформите заказ с предоплатой и получите козырек от солнца в подарок
            </p>
            <p style="margin-bottom: 0; text-align: center">
              <img style="width: 87px; margin-top: -20px;" src='files/koz-ad5-arb.png'>
            </p>
          </div>
				</div>
			</div>
		</div>
		<div class="tech">
			<div class="container">
				<h2 class="heading">
					<span class="red">Все технологии</span><br/>
					в одном видеорегистраторе.
				</h2>
				<div class="item">
					<img src='files/ph2-76d-arb.jpg' alt="" class="cam">
					<div class="block">
						<div class="num">01</div>
						<h4>Ultra HD 4K съемка</h4>
						<p>Максимально качественное изображение поможет определить важные детали, такие как номерные знаки, действия водителей и дорожные знаки, которые помогут доказать вашу невиновность.</p>
						<a href="#order" class="scroll">Получить скидку 53%</a>
					</div>
				</div>
				<div class="item left">
					<div class="block">
						<div class="num">02</div>
						<h4>Максимально качественное изображение поможет определить важные детали, такие как номерные знаки, действия водителей и дорожные знаки, которые помогут доказать вашу невиновность.</h4>
						<p>Смотреть фильмы, играть в игры, заниматься «сёрфингом» в интернете или читать книги теперь стало на много комфортнее с ярким и качественным экраном. </p>
						<a href="#order" class="scroll">Получить скидку 53%</a>
					</div>
					<img src='files/ph3-fc4-arb.jpg' alt="" class="cam left">
				</div>
				<div class="item">
					<img src='files/ph4-49d-arb.jpg' alt="" class="cam">
					<div class="block">
						<div class="num">03</div>
						<h4>4G + Wi-Fi</h4>
						<p>Наслаждайтесь комфортным сверхскоростным «сёрфингом» в интернете, смотрите фильмы в высоком качестве, слушайте музыку онлайн и пользуйтесь комфортно навигацией.</p>
						<a href="#order" class="scroll">Получить скидку 53%</a>
					</div>
				</div>
				
				<div class="item left">
					<div class="block">
						<div class="num">04</div>
						<h4>Удаленное управление</h4>
						<p>Синхронизуйте регистратор с телефоном с помощью специального приложения и следите за своей машиной находясь в любой точке своего города. </p>
						<a href="#order" class="scroll">Получить скидку 53%</a>
					</div>
					<img src='files/ph5-eb4-arb.jpg' alt="" class="cam left">
				</div>
				<div class="item">
					<img src='files/ph6-be4-arb.jpg' alt="" class="cam">
					<div class="block">
						<div class="num">05</div>
						<h4>GPS трекер</h4>
						<p>Ваш путь в автомобиле будет записан и при желании, вы можете воспроизвести его в специальном приложение. </p>
						<a href="#order" class="scroll">Получить скидку 53%</a>
					</div>
				</div>
				<div class="item left">
					<div class="block">
						<div class="num">06</div>
						<h4>Функция ADAS (контроль полосы)</h4>
						<p>Контролируйте расстояние между вашей машиной и окружающими вас. Если вы сойдете с полосы, то регистратор предупредит вас определенным сигналом. </p>
						<a href="#order" class="scroll">Получить скидку 53%</a>
					</div>
					<img src='files/ph7-dbf-arb.jpg' alt="" class="cam left">
				</div>
				<div class="item">
					<img src='files/ph8-074-arb.jpg' alt="" class="cam">
					<div class="block">
						<div class="num">07</div>
						<h4>Одновременная запись с двух камер</h4>
						<p>При включение задней передачи камера переключается в режим парктроник, при этом не переставая записывать все, что происходит на впереди.</p>
						<a href="#order" class="scroll">Получить скидку 53%</a>
					</div>
				</div>
				<div class="item left">
					<div class="block">
						<div class="num">08</div>
						<h4>GPS навигация</h4>
						<p>Благодаря датчику GPS и чувствительной антенне, вы без проблем можете выбрать оптимальный маршрут, избежать пробки и найти любое здание максимально комфортно и быстро. </p>
						<a href="#order" class="scroll">Получить скидку 53%</a>
					</div>
					<img src='files/ph9-8eb-arb.jpg' alt="" class="cam left">
				</div>
				<div class="item">
					<img src='files/ph10-b68-arb.jpg' alt="" class="cam">
					<div class="block">
						<div class="num">09</div>
						<h4>Bluetooth Hands-free</h4>
						<p>Благодаря этой функции вы без проблем сможете совершать и принимать звонки непосредственно с самого регистратора и разговаривать через внешний динамик.</p>
						<a href="#order" class="scroll">Получить скидку 53%</a>
					</div>
				</div>
				<div class="item left">
					<div class="block">
						<div class="num">10</div>
						<h4>ОС Android 7.0</h4>
						<p>Встроенный магазин приложений предоставит вам доступ к миллионам приложений, доступных для загрузки прямо на регистратор. А 1Gb оперативной памяти и 16Gb встроенной позволят вам комфортно ими пользоваться.</p>
						<a href="#order" class="scroll">Получить скидку 53%</a>
					</div>
					<img src='files/ph11-d01-arb.jpg' alt="" class="cam left">
				</div>
				<div class="item">
					<img src='files/ph12-423-arb.jpg' alt="" class="cam">
					<div class="block">
						<div class="num">11</div>
						<h4>Встроенный радар детектор</h4>
						<p>Детектор всех современных радаров: стрелка, робот, кречет, кордон, криси др., оповещение за 1200 метров также предупреждает об устройствах, работающих «на удаление автомобиля».</p>
						<a href="#order" class="scroll">Получить скидку 53%</a>
					</div>
				</div>
				
			</div>
		</div>
		
		<div class="record">
			<div class="container">
				<h2 class="heading">
					<span class="red">Качественная запись</span><br/>
					видео 24 часа в сутки:
				</h2>
				<div class="block">
					<div class="item">
						<p>Детектор движения, автоматически <br/>
						включающий запись при наличии <br/>
						движения перед автомобилем.</p>
						<p>С помощью USB-кабеля можно <br/>
						просматривать видеозаписи<br/>
						на компьютере.</p>
					</div>
					<div class="item">
						<p>В режиме воспроизведения можно <br/>
						просмотреть записанное видео прямо <br/>
						на экране устройства.</p>
						<p> При включении зажигания <br/>
						автомобиля, устройство автоматически <br/>
						запускается, и начинается запись видео.</p>
					</div>
					<div class="item">
						<p>Меню целиком переведено <br/>
						на понятный русский язык.</p>
						<p> Поддерживается непрерывная <br/>циклическая видеозапись.</p>
					</div>
					<img src='files/ph13-e12-arb.png' alt="" class="cam">
				</div>
				<div class="block block-mob">
					<div class="item">
						<p>Детектор движения, автоматически 
						включающий запись при наличии 
						движения перед автомобилем.</p>
						<p>С помощью USB-кабеля можно 
						просматривать видеозаписи
						на компьютере.</p>
						<p>В режиме воспроизведения можно 
						просмотреть записанное видео прямо 
						на экране устройства.</p>
					</div>
					<div class="item">
						<p> При включении зажигания 
						автомобиля, устройство автоматически 
						запускается, и начинается запись видео.</p>					
						<p>Меню целиком переведено 
						на понятный русский язык.</p>
						<p> Поддерживается непрерывная циклическая видеозапись.</p>
					</div>
				</div>
			</div>
		</div>
		<div class="char">
			<div class="container">
				<h2 class="heading" style="color: white;">
						Характеристики
					</h2>
				<div class="row">
					
					
					<div class="text-block">
						<ul>
							<li><b>Матрица: </b>CMOS</li>
							<li><b>Запись видео: </b>60 кадров в секунду, Ultra HD</li>
							<li><b>Большой сенсорный экран</b></li>
							<li class="ulzag"><b>Технические особенности</b></li>
							<li><b>экран: </b>8" TFT-LCD экран с форматом изображения 16:9</li>
							<li class="ulzag"><b>Особенности видеосъемки </b></li>
							<li>Функция цифровой стабилизации изображения</li>
							<li>Запись видео с кодеком H.264</li>
							<li>Функция циклической записи видеороликов (без промежутков)</li>
							<li>Функция наложения на видео даты, времени</li>
							<li>Функция наложения на видео даты, времени</li>
							<li>Функция наложения на видео даты, времени</li>
							<li>Функция наложения на видео даты, времени</li>
							<li>Функция автоматической защиты файла по сигналу G-сенсора</li>
							<li class="ulzag"><b>Особенности оптики:</b></li>
							<li>Стеклянный объектив с матрицей NT99142 100w/OV2710+ISP(AW6131) 200W</li>
							<li>Диагональный угол обзора 160 гр и 140гр(камера заднего вида)</li>
							<li class="ulzag"><b>Особенности звука:</b></li>
							<li>Оснащен микрофоном для записи звука вокруг</li>
							<li>Оснащен встроенным динамиком для воспроизведения звука при просмотре</li>
							<li class="ulzag"><b>Особенности памяти: </b></li>
							<li>Поддерживает карты памяти MicroSD Class 10 и выше, ёмкостью до 64Гб</li>
							<li class="ulzag">Особенности фотографирования</li>
							<li>Фото в формате JPEG</li>
							<li>Размер фото 12Mpx</li>
							<li>Модуль Wi-fi и 4G </li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="complect">
			<div class="container">
				<div class="row">
					<div class="text-block">
						<h3>Комплектация</h3>
						<div class="cam-mob">
							<div class="swiper-container">
								<div class="swiper-wrapper">
									
									<div class="swiper-slide"><img src='files/2-7bb-arb.jpg'></div>
									<div class="swiper-slide"><img src='files/3-ccb-arb.jpg'></div>
									<div class="swiper-slide"><img src='files/4-63f-arb.jpg'></div>
									<div class="swiper-slide"><img src='files/1-c0f-arb.jpg'></div>
								</div>
								<!-- Add Arrows -->
								<div class="swiper-button-next"></div>
								<div class="swiper-button-prev"></div>
							</div>
						</div>
						<ol>
							<li>Видеорегистратор Bluavido</li>
							<li>Камера заднего вида</li>
							<li>Зарядное устройство</li>
							<li>GPS кабель</li>
							<li>Гарантийный талон</li>
							<li>Инструкция</li>
						</ol>
						<a href="#order" class="scroll">Получить скидку 53%</a>
					</div>
					<div class="img-block">
						<div class="swiper-container">
							<div class="swiper-wrapper">
								
								<div class="swiper-slide"><img src='files/2-7bb-arb.jpg'></div>
								<div class="swiper-slide"><img src='files/3-ccb-arb.jpg'></div>
								<div class="swiper-slide"><img src='files/4-63f-arb.jpg'></div>
								<div class="swiper-slide"><img src='files/1-c0f-arb.jpg'></div>
							</div>
							<!-- Add Arrows -->
							<div class="swiper-button-next"></div>
							<div class="swiper-button-prev"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="reviews">
			<div class="container">
				<h2 class="how-heading"><span>Отзывы</span> наших покупателей.</h2>
				<div class="row">
					<div class="block">
						<img src='files/rev_1-b67-arb.png' alt=""><br/>
						<img src='files/stars-b55-arb.png' alt="" class="stars">
						<p class="text">“Достойный гибрид, который даже на скорости в 100-110 километров умудряется записывать чёткую картинку. Я Вам скажу - мне совершенно не жалко потраченных денег. Особенно если учесть, что и о радарах это чудо способно предупредить. Нет, не просто способно - а регулярно и очень даже стабильно предупреждает.”</p>
						<p class="cite">Николай, г.Москва</p>
					</div>
					<div class="block">
						<img src='files/rev_2-9a7-arb.png' alt=""><br/>
						<img src='files/stars-b55-arb.png' alt="" class="stars">
						<p class="text">“Мне, как большому автолюбителю, этот видеорегистратор понравился на все сто. Обзавелся им около трех месяцев назад. В нем собраны довольно неплохие функции: большой угол обзора, высокое разрешение, отличное качество съемки. Перечислять можно очень долго. Если говорить за стоимость, то тут я считаю все на своих местах, не дорого. В общем, всем рекомендую данный видеорегистратор”</p>
						<p class="cite">Константин, г.Королёв</p>
					</div>
					<div class="block">
						<img src='files/rev_3-8a5-arb.png' alt=""><br/>
						<img src='files/stars-b55-arb.png' alt="" class="stars">
						<p class="text">“Своих денег регистратор однозначно стоит. Особенно, если вы любите погонять. Радар детектор обнаруживает осточертевшую стрелку, например, на расстоянии полтора километра (по прямой). А маломощные радары, с которыми любят прятаться в кустах - на километре. Это очень большое расстояние. По регистратору могу сказать только, что это лучшая оптическая система для регистраторов на сегодняшний день. Соответственно, запись в любое время суток будет шикарного качества.”</p>
						<p class="cite">Олег, г. Елец</p>
					</div>
				</div>
			</div>
		</div>
		<div class="how">
			<div class="container">
				<h2 class="how-heading">Как сделать заказ?</h2>
				<div class="row">
					<div class="block">
						<div class="img-block"><img src='files/how_1-ac7-arb.png' alt=""></div>
						<p>Оставьте заявку!</p>
						<a href="#order" class="scroll">Оставить заявку</a>
					</div>
					<div class="block">
						<div class="img-block"><img src='files/how_2-14d-arb.png' alt=""></div>
						<p>С Вами свяжется<br/>
						менеджер и уточнит<br/> детали.</p>
					</div>
					<div class="block">
						<div class="img-block"><img src='files/how_3-6b6-arb.png' alt=""></div>
						<p>Ваш заказ бережно <br/>упакуют и отправят.</p>
					</div>
					<div class="block">
						<div class="img-block"><img src='files/how_4-954-arb.png' alt=""></div>
						<p>Вы забираете и <br/>оплачиваете заказ.</p>
					</div>
				</div>
			</div>
		</div>
		<div class="shop">
			<div class="container">
				<h2 class="how-heading">Преимущества нашего магазина.</h2>
				<div class="row">
					<div class="block">
						<div class="img-block"><img src='files/shop_1-bc3-arb.png' alt=""></div>
						<p>Перед отправкой<br/> товары проходят <br/>проверку.</p>
					</div>
					<div class="block">
						<div class="img-block"><img src='files/shop_2-bf4-arb.png' alt=""></div>
						<p>Доставка по всей<br/> России<br/> от одного дня.</p>
					</div>
					<div class="block">
						<div class="img-block"><img src='files/shop_3-a7c-arb.png' alt=""></div>
						<p>Прием заказов <br/>круглосуточно.</p>
					</div>
					<div class="block">
						<div class="img-block"><img src='files/shop_4-8c7-arb.png' alt=""></div>
						<p>Гарантия возврата<br/> денег если товар<br/> не понравится.</p>
					</div>
					<div class="block">
						<div class="img-block"><img src='files/shop_5-7ae-arb.png' alt=""></div>
						<p>Оплата при<br/> получении <br/>товара.</p>
					</div>
				</div>
			</div>
		</div>
		<div class="bottom" style="padding-bottom: 0px;">
			<div class="container" id="order">
				<div class="row">
					<div class="form-block">
						<h3>Оставьте заявку<br/>и мы свяжемся с вами в ближайшее время</h3>
						<form action="./_success_/" method="post" >
						    <input type='hidden' name='referer' value="<?php echo isset($_GET['referer']) ? $_GET['referer'] : $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] ;?>">
<input type="hidden" name="subid1"  value="<?php echo isset($_GET['subid1']) ? $_GET['subid1'] : '' ;?>" />
<input type="hidden" name="subid2"  value="<?php echo isset($_GET['subid2']) ? $_GET['subid2'] : '' ;?>" />
<input type="hidden" name="subid3"  value="<?php echo isset($_GET['subid3']) ? $_GET['subid3'] : '' ;?>" />
<input type="hidden" name="subid4"  value="<?php echo isset($_GET['subid4']) ? $_GET['subid4'] : '' ;?>" />  
<input type="hidden" name="subid5"  value="<?php echo isset($_GET['subid5']) ? $_GET['subid5'] : '' ;?>" />

     
							<input type="text" name="name" required placeholder="Имя">
							<input type="tel" name="phone" required placeholder="Телефон" >
							<button type="submit">Заказать со скидкой</button>
														<div>
            <p style="color: black; font-size: 15px; margin-top: 5px; margin-bottom: 0; text-align: center;">
              Оформите заказ с предоплатой и получите козырек от солнца в подарок
            </p>
            <p style="margin-bottom: 0; text-align: center">
              <img style="width: 87px; margin-top: -20px;" src='files/koz-ad5-arb.png'>
            </p>
          </div>
          		</form>
						<div class="timer">
							<div class="timer-text">До конца предложения осталось</div>
							<div class="timer-block"><script src="//megatimer.ru/get/65a68a04879aad5847256a1de80554ed.js"></script></div>
						</div>
						<div class="after"></div>
					</div>
					<div class="text-block">
						<div class="mob-text">
							<span>Успей сделать заказ</span><br/>
							Предложение ограничено
						</div>
						<p class="new">Инновационная новинка!</p>
						<h1 class="h1">Корейский видеорегистратор<br> 8 в 1 с радар-детектором и доставкой от 3 дней.</h1>
						<p class="under_h1">Уникальная комбинация самых важных функций для автомобилиста</p>
						<ul class="list">
							<li>Качество съемки Ultra HD 4K</li>
							<li>Камера 12 <br/>мегапикселей<br/></li>
							<li>GPS навигация<br/></li>
							<li>Датчик движения<br/></li>
							<li>Android 7.0 <br/></li>
							<li>Парктроник</li>
							<li>Сенсорный 8-ми<br/> дюймов экран </li>
							<li>Детектор радаров и камер<br/> оповещение за 700 — 1200 метров</li>
							<li>Датчик удара<br/> (G - сенсор)</li>
							<li>Камера переднего<br/> и заднего вида</li>
							<li>Угол обзора<br/> 160 градусов</li>
							<li>Встроенная память<br/> 16Gb (поддержка<br/> micro SD до 64Gb)</li>
						</ul>
						<div class="price">
							<div class="old"><x-oldprice>9968</x-oldprice> <x-currency>руб</x-currency></div>
							<div class="new">
								<span class="num"><x-newprice><?php echo $price['real_price']; ?></x-newprice></span>
								
							</div>
						</div>
						<div class="copy">
							Наличие</br>на складе: 7 шт
						</div>
						<div class="sale">-53%</div>
					</div>
				</div>
			</div>
			<div style="margin-top: 60px; padding: 30px 10px; background: #F5F5F5; text-align: center; line-height: 15px; font-size: 12px; color: #000000;">
				<p><p>ООО "АГРОС ПЛЮС" ОГРН: 1197746571660 ИНН: 7720481854</p>
<p>111673, МОСКВА ГОРОД, УЛИЦА НОВОКОСИНСКАЯ, ДОМ 31, КОМ/ЭТ 5/1</p> 

  
				 
			</div>
		</div>
	</div>
	
	
	<script  src='files/jquery.min-9a8-arb.js' type="text/javascript"></script>
	<script  src='files/common-288-arb.js' type="text/javascript"></script>
	
	<link rel="stylesheet" href='files/swiper.min-204-arb.css'>
	<script  src='files/swiper.min-fcb-arb.js'></script>
	<script >
		var swiper = new Swiper('.swiper-container', {
		  navigation: {
			nextEl: '.swiper-button-next',
			prevEl: '.swiper-button-prev',
		  },
		});
	</script>

</body>

<style>
    .unprocessed-orders {
        text-align: center;
    }
    .unprocessed-orders .info-label {
        margin-top: 15px;
        display: block;
    }
    .unprocessed-orders .order-button {
        display: inline-block;
        vertical-align: top;
        padding: 15px 30px;
        border: 1px solid #74a3c7;
        text-align: center;
        color: #5087b2;
        font-size: 15px;
        line-height: 18px;
        border-radius: 30px;
        margin: 10px 5px;
    }
    .prepay-link-block {
        text-align: center;
        padding: 5px 5px 10px;
    }
    .prepay-link-block a {
        color: inherit;
        font-size: inherit;
    }
</style>
<style>
.form-control {
	width:100%;max-width:300px;margin:0 10px;height:75px;border-radius:40px;padding:0 32px;box-sizing:border-box;outline:none;border:none;font-weight:300;color:gray;font-style:italic;font-size:16px
}
</style>
 </body>
</html>