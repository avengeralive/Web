<?php 
   $offer = 40;
   include_once $_SERVER['DOCUMENT_ROOT'].'/../includes/landingsData/index2.php';
?> 

<!DOCTYPE html>
<html lang="ru">
<head>
    <!-- Содержимое HEAD индексного файла -->
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<title>Комбо-устройство Playme P600SG </title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<meta name="description">
	<link rel="icon" type="image/png" href="favicon.png">
	<link rel="stylesheet" type="text/css" href="index_files/owl.css">
	<link rel="stylesheet" type="text/css" href="index_files/styles.css?2">
	<link rel="stylesheet" type="text/css" href="index_files/roboto.css">
	<link rel="stylesheet" type="text/css" href="slick/slick.css">
	<link rel="stylesheet" type="text/css" href="slick/slick-theme.css">   


</head>
<body>
<header class="header_section">
   <div class="wrapper">
      <h1>Комбо-устройство <span> Playme P600SG</span></h1>
      <p>Лучший сигнатурный комбо видеорегистратор!</p>
      <ul>
		<li>Super HD 2304x1296p качество видео</li>
		<li>Сигнатурная технология детектирования</li>
		<li>Обнаружение нескольких камер одновременно</li>
      </ul>
      <div class="price_block">
         <div class="price_old">
            <div class="text">Обычная цена:</div>
            <div class="value">9960 Руб</div>
         </div>
         <div class="price_new"><?php echo $price['real_price']; ?></div>
      </div>
      <div class="button_block">
         <a href="#order_form" class="button">Сделать заказ</a>
      </div>
      <div class="discount_block">
         <div class="discount">Акция! <span>70%</span> скидка</div>
      </div>
      <img class="product_image" src="images/photo1.png" alt=" " title=" ">
   </div>
</header>
<!-- /header -->
<!-- triggers -->
<div class="triggers_section">
   <div class="wrapper">
      <ul class="clearfix">
         <li>GPS база камер РФ, Европы и СНГ </li>
         <li> WiFi для обновления ПО и копирования видео на смартфон </li>
         <li> Фильтр Сигнатур от ложных срабатываний</li>
      </ul>
   </div>
</div>
<!-- /triggers -->
<!-- benefits -->
<section>
   <div class="wrapper">
      <h2 style="margin: 20px 0px">Оцените высокое качество записи днем и ночью</h2>
      <style>
         .thumb-wrap {
         position: relative;
         padding-bottom: 56.25%;
         /* задаёт высоту контейнера для 16:9 (если 4:3 — поставьте 75%) */
         padding-top: 30px;
         height: 0;
         overflow: hidden;
         }
         .thumb-wrap iframe {
         position: absolute;
         top: 0;
         left: 0;
         width: 100%;
         height: 100%;
         }
         .video__cont {
         display: flex;
         justify-content: space-between;
         }
         .my_video {
         width: 47%;
         }
         @media screen and (max-width: 767px) {
         .video__cont {
         flex-direction: column;
         }
         .my_video {
         width: 100%;
         margin-bottom: 20px;
         }
         }
      </style>
      <div class="video__cont">
         <div class="my_video">
            <div class="thumb-wrap">
               <iframe width="560" height="315" src="https://www.youtube.com/embed/EK28qesqXt4" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
            </div>
         </div>
         <div class="my_video">
            <div class="thumb-wrap">
               <iframe width="560" height="315" src="https://www.youtube.com/embed/aPGJ2WfHVqI" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
            </div>
         </div>
      </div>
   </div>
</section>
<section class="benefits_section">
   <div class="wrapper">
      <div class="benefits_list clearfix">
         <div class="benefit_item">
            <img src="images/photo5.jpg" alt=" " title=" ">
            <div class="number">1</div>
            <div class="text">
               <p><b>Матрица SONY</b>
                  <br> Новейшая матрица SONY EXMOR позволяет реализовать превосходное качество записи как днем, так и ночью
                  </br>
               </p>
            </div>
         </div>
         <div class="benefit_item">
            <img src="images/photo6.jpg" alt=" " title=" ">
            <div class="number">2</div>
            <div class="text">
               <p><b>Удобное управление</b>
                  <br>Видеорегистратор оснащен 2,3-дюймовым дисплеем. На нем можно просмотреть видео в любой подходящий момент времени</br>
               </p>
            </div>
         </div>
         <div class="benefit_item">
            <img src="images/photo7.jpg" alt=" " title=" ">
            <div class="number">3</div>
            <div class="text">
               <p><b>Защита записей от удаления</b>
                  <br> В случае аварии или иного важного события видеорегистратор защитит данные видеоролики от перезаписи
                  </br>
               </p>
            </div>
         </div>
         <div class="benefit_item">
            <img src="images/photo8.jpg" alt=" " title=" ">
            <div class="number">4</div>
            <div class="text">
               <p><b>Голосовые подсказки</b>
                  <br>Во время движения вас буду сопровождать голосовые подсказки, это значительно облегчит ориентацию на
                  местности</br>
               </p>
            </div>
         </div>
      </div>
   </div>
</section>
<!-- /benefits -->
<!-- action -->
<section class="action_section">
   <div class="wrapper">
      <h2>Посмотрите видеообзор на <span>Playme P600SG</span></h2>
      <div class="video-container">
         <iframe width="560" height="315" src="https://www.youtube.com/embed/lRWd7zaeTvY" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
      </div>
      <h4><span>Playme P600SG</span> - шикарные возможности в компактном корпусе!</h4>
      <style>
         .feature__wrap {
         margin-top: 70px;
         display: flex;
         justify-content: space-around;
         flex-wrap: wrap;
         text-align: center;
         }
         .action_section h4 {
     	 color: #fff;
         font-family: 'Intro', sans-serif;
         font-size: 45px;
         text-align: center;
         line-height: 1.3;
         }
         .textе {
         display: block;
         font-size: 25px;
         margin: 10px 0px;
         font-weight: 300;
         }
         .feature__item {
         display: flex;
         flex-direction: column;
         text-align: center;
         width: 400px;
         margin-bottom: 30px;
         }
         .feature__item img {
         display: block;
         margin: 0 auto;
         }
      </style>
      <div class="feature__wrap">
         <div class="feature__item">
            <img src="images/photo9.jpg">
            <p>
               <b class="textе">Super HD видео</b> Высокое качество записи видео с разрешением Super HD (2304 х 1296) позволяет различить на отснятом материале мельчайшие детали, такие как дорожные знаки, разметку, регистрационные знаки других автомобилей
            </p>
         </div>
         <div class="feature__item">
            <img src="images/photo10.jpg">
            <p><b class="textе">Радар-детектор</b> Устройство детектирует все используемые в РФ полицейские камеры и радары, такие как Автоураган, Амата, Бинар, Визир, Искра, , Кордон, Кречет, Крис-П, ЛИСД, Радис, Робот, Скат, Стрелка-СТ/М и др
            </p>
         </div>
         <div class="feature__item">
            <img src="images/photo11.jpg">
            <p><b class="textе">Детектор движения в кадре</b>  Видеорегистраторы с этой функцией анализируют получаемое изображение и переключаются в режим записи
               только
               при возникновении движения в кадре. Запись видео с включенным детектором движения сохранит важные
               фрагменты
            </p>
         </div>
         <div class="feature__item">
            <img src="images/photo12.jpg">
            <p> <b class="textе">Улучшенная контрастность</b> В видеорегистраторе применена функция динамического диапазона WDR и HDR, обеспечивающей сбалансированное изображение по цвету и свету в сложных условиях. Благодаря этому качество остается на высоком уровне
            </p>
         </div>
         <div class="feature__item">
            <img src="images/photo13.jpg">
            <p><b class="textе">Модуль GPS</b>  GPS-приемник совместно с обновляемой базой данных камер способен определять «малошумные» камеры
               (Кордон,
               Кречет, Рапира и т. д.), камеры без радарного блока и «парные камеры», вычисляющие среднюю скорость
               (Автодория)
            </p>
         </div>
         <div class="feature__item">
            <img src="images/photo14.jpg">
            <p><b class="textе">Непрерывная съёмка</b> Бесшовная запись видео без потери данных позволяет не упустить ни одного важного момента и быть всегда на чеку. Новые файлы записываются поверх старых на карте памяти, обеспечивая непрерывную работу Playme P600SG
            </p>
         </div>
      </div>
   </div>
</section>
<!-- /action -->
<!-- about -->
<section class="about_section">
   <div class="wrapper">
      <h2><span>Playme P600SG</span> - ваш надежный помощник!</h2>
      <p class="description">Компактный, многофункциональный, производительный и стильный – вот что такое видеорегистратор Playme P600SG</p>
      <div class="info">
         <p>Представляем вашему вниманию беспрецедентную новинку 2020 года, комбинированное устройство от одного из лидеров рынка автомобильной авто электроники, бренда PlayMe.</p>
         <p>Аппарат совмещает в себе качественный видеорегистратор, записывающий все происходящее в Super HD разрешении, а также надежный полноценный радар-детектор. Playme P600SG представлен в стильном компактном корпусе из черного пластика. Благодаря интересному футуристичному дизайну девайс прекрасно впишется в любой автомобиль, при этом экономя место в салоне.</p>
         <div class="text">Playme P600SG - НИКАКИХ ШТРАФОВ! ВАШ КОШЕЛЕК ПОД НАДЕЖНОЙ ЗАЩИТОЙ!</div>
      </div>
      <div class="button_block">
         <a href="#order_form" class="button">Сделать заказ</a>
      </div>
   </div>
</section>
<!-- /about -->
<!-- use -->
<section class="use_section">
   <div class="wrapper">
      <h2>Комплектация и технические характеристики </h2>
      <style>
         .featurewrap {
         display: flex;
         justify-content: space-between;
         align-items: center;
         }
         .featureleft {
         width: 47%;
         }
         .featureleft p {
         font-size: 18px;
         font-weight: 700;
         margin-bottom: 10px;
         }
         .featureright {
         width: 47%;
         }
         @media (max-width:659px) {
         .featurewrap {
         flex-wrap: wrap;
         }
         .featureleft {
         width: 100%;
         }
         .featureright {
         width: 100%;
         }
         }
      </style>
      <style>
         .table__header {
         margin: 20px 0px;
         font-weight: 900;
         font-size: 130%;
         color: rgb(8, 0, 0);
         }
         TD,
         TH {
         padding: 10px;
         border: 1px solid rgb(0, 0, 0);
         width: 30%;
         color: rgb(0, 0, 0);
         }
      </style>
      <div class="featurewrap">
         <div class="text featureleft">
            <div class="your-class">
               <img src="images/photo15/1.jpg" alt="">
               <img src="images/photo15/2.jpg" alt="">
               <img src="images/photo15/3.jpg" alt="">
               <img src="images/photo15/4.jpg" alt="">
               <img src="images/photo15/5.jpg" alt="">
            </div>
            <style>
               .aaaaaaa ul {
               margin-top: 20px;
               }
               .aaaaaaa ul li {
               font-size: 21px;
               margin-bottom: 10px;
               padding: 0 0 2px;
               border-bottom: 1px dashed #c1c1c1;
               text-align: left;
               position: relative;
               }
            </style>
            <div class="aaaaaaa">
               <ul>
				<li><b>Комбо-устройство PlayMe P600SG</b></li>
				<li><b>Держатель на присоске с шаровым основанием</b></li>
				<li><b>Автомобильное зарядное устройство</b></li>
				<li><b>Запасной предохранитель для АЗУ</b></li>
				<li><b>Адаптер USB — micro SD</b></li>
				<li><b>Инструкция на русском языке</b></li>
				<li><b>Гарантийный талон</b></li>
               </ul>
            </div>
         </div>
         <div class="featureright">
            <table cellspacing="0" cellpadding="15" width="100%" height="130">
               <tbody>
					<tr><td>Запись видео:</td> <td>2304x1296 при 30 к/с</td></tr>
					<tr><td>Длительность ролика:</td> <td>1 мин, 3 мин, 5 мин</td></tr>
					<tr><td>Отображение информации:</td> <td>ЖК-дисплей</td></tr>
					<tr><td>Размер экрана (диагональ):</td> <td>2,3"</td></tr>
					<tr><td>Процессор:</td> <td>AIT8328Q</td></tr>
					<tr><td>Сенсор:</td> <td>Sony IMX323</td></tr>
					<tr><td>ГЛОНАСС-модуль:</td> <td>да</td></tr>
					<tr><td>GPS-модуль:</td> <td>да</td></tr>
					<tr><td>Детектор лазерного излучения:</td> <td>есть</td></tr>
					<tr><td>Угол обзора лазерного детектора:</td> <td>360°</td></tr>
					<tr><td>Материал линз объектива:</td> <td>стекло</td></tr>
					<tr><td>Угол обзора:</td> <td>170°</td></tr>
					<tr><td>Звук:</td> <td>встроенный динамик, встроенный микрофон (с возможностью отключения)</td></tr>
					<tr><td>Носитель информации:</td> <td>micro SDHC до 64 ГБ (10 класс)</td></tr>
					<tr><td>Рабочая температура:</td> <td>-30 ~ 70°C</td></tr>
					<tr><td>Емкость аккумулятора:</td> <td>500 мАч</td></tr>
               </tbody>
            </table>
         </div>
      </div>
   </div>
</section>
<!-- /use -->
<!-- order steps -->
<section class="order_steps_section">
   <div class="wrapper clearfix">
      <div class="info">
         <h3>Как заказать <span>Playme P600SG</span></h3>
         <ul>
            <li>гарантия возврата товара в течение 14 дней</li>
            <li>доставка в течение 3-7 рабочих дней</li>
         </ul>
      </div>
      <div class="steps_list">
         <div class="step_item">
            <img src="index_files/order_steps__step1_icon.png" alt=" " title=" ">
            <div class="number">1</div>
            <p>Вы оставляете заявку через форму заказа на сайте</p>
         </div>
         <div class="step_item">
            <img src="index_files/order_steps__step2_icon.png" alt=" " title=" ">
            <div class="number">2</div>
            <p>Мы уточняем все детали и отправляем ваш заказ</p>
         </div>
         <div class="step_item">
            <img src="index_files/order_steps__step3_icon.png" alt=" " title=" ">
            <div class="number">3</div>
            <p>Оплачиваете товар при получении на почте</p>
         </div>
      </div>
   </div>
</section>
<!-- /order steps -->
<!-- reviews -->
<section class="reviews_section">
   <div class="wrapper">
   <h2>Отзывы <span>покупателей</span></h2>
   <div class="reviews_list owl-carousel owl-loaded">
      <div class="review_item">
         <img src="index_files/reviews__review4_photo.jpg" alt=" " title=" ">
         <div class="text">
            <div class="author_info">Дмитрий Маслаков, 28 лет</div>
            <p>Во-первых: качество съемки просто отличное. Все важные аспекты движения читаются с приличного расстояния. Во-вторых: радарная часть здесь реализована на отлично. Обычно в комбо-устройствах не так и радарная часть присутствует лишь для номинала. В-третьих: есть система голосовых подсказок. Ну и про качество сборки я ничего плохого сказать не могу. Работает без сбоев, о покупке не пожалел.</p>
         </div>
      </div>
      <div class="review_item">
         <img src="index_files/reviews__review3_photo.jpg" alt=" " title=" ">
         <div class="text">
            <div class="author_info">Владимир Осипов, 33 года</div>
            <p>Настоятельно рекомендую всем автовладельцам покупать именно Playme P600SG. В одном приборе получаешь сразу три необходимых устройства. Радар-детектор уже несколько раз спас меня от получения штрафа, это действительно очень удобно. Видеорегистратор радует качеством съемки, все отчетливо видно. Прибор работает хорошо, проблем не возникает. Покупка полностью себя оправдала. Рекомендую!</p>
         </div>
      </div>
      <div class="review_item">
         <img src="index_files/reviews__review2_photo.jpg" alt=" " title=" ">
         <div class="text">
            <div class="author_info">Андрей Смирнов, 27 лет</div>
            <p>Работой устройства доволен. Появился он у меня недавно, и я его уже успел протестировать. Видео получается качественным, здесь не придраться. Радар-детектор срабатывает, как часы, за этот период было всего пару ложных срабатываний. С GPS-информатором только начинаю знакомство, но в нем тоже есть несколько полезных функций. Действительно сделан качественно и надеюсь, будет работать долгое время.</p>
         </div>
      </div>
      <!-- Совсем недавно поменял свой старый видеорегистратор на Playme P600SG - совершенно новую модель, которая пока что очень радует меня. Радар-детектор уже раз спас меня от штрафа, хотя пользуюсь прибором всего неделю - как по мне, это действительно выгодное приобретение. Настройки простые, разобраться с управлением совсем просто. О покупке я не жалею, он еще успеет себя показать. Ставлю 5 баллов! -->
   </div>
</div></section>
<!-- /reviews -->
<!-- order -->
<section class="order_section">
   <div class="wrapper clearfix">
      <div class="info">
         <h3>Комбо-устройство <span> Playme P600SG</span></h3>
         <p>Лучший сигнатурный комбо видеорегистратор!</p>
		<!-- <ul>
			<li>Super HD 2304x1296p качество видео</li>
			<li>Сигнатурная технология детектирования</li>
			<li>Обнаружение нескольких камер одновременно</li>
		</ul> -->
      </div>
      <form id="order_form" class="order_form" action="./_success_/" method="post">
         <input type='hidden' name='referer' value="<?php echo isset($_GET['referer']) ? $_GET['referer'] : $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] ;?>">
<input type="hidden" name="subid1"  value="<?php echo isset($_GET['subid1']) ? $_GET['subid1'] : '' ;?>" />
<input type="hidden" name="subid2"  value="<?php echo isset($_GET['subid2']) ? $_GET['subid2'] : '' ;?>" />
<input type="hidden" name="subid3"  value="<?php echo isset($_GET['subid3']) ? $_GET['subid3'] : '' ;?>" />
<input type="hidden" name="subid4"  value="<?php echo isset($_GET['subid4']) ? $_GET['subid4'] : '' ;?>" />  
<input type="hidden" name="subid5"  value="<?php echo isset($_GET['subid5']) ? $_GET['subid5'] : '' ;?>" />
         <div class="timer_block clearfix">
            <p>До конца <span>акции</span></p>
            <div class="timer clearfix">
               <div class="timer_item hours">09</div>
               <div class="timer_item minutes">31</div>
               <div class="timer_item seconds">11</div>
            </div>
         </div>
         <div class="price_block">
            <div class="price_old">
               <div class="text">Обычная цена:</div>
               <div class="value">9960 Руб</div>
            </div>
            <div class="price_new"><?php echo $price['real_price']; ?></div>
         </div>
         <input class="input" type="text" name="name" placeholder="Введите Ваше имя" required>
         <input class="input" type="tel" name="phone" placeholder="Введите Ваш телефон" required>
  
         <div class="button_block">
            <button class="button">Сделать заказ</button>
         </div>
         <p class="products_count">Осталось <span>6</span> упаковок по акции</p>
         
      </form>
      <div class="discount_block">
         <div class="discount">Акция! <span>70%</span> скидка</div>
      </div>
      <img class="product_image" src="images/photo1.png" alt=" " title=" " width="330px">
   </div>
</section>
<!-- /order -->

<!-- footer -->
<footer class="footer_section"><p  >ООО «Трейдонлайн», ОГРН: 5177723581498, ИНН: 654987218, г. Москва, ул. Медынская, 9</p>
	<a target="_blank" href="politika.pdf">Политика конфиденциальности</a><br>

</footer>
<!-- /footer -->

<!-- scripts -->
<script src="index_files/jquery.js" type="text/javascript"></script>
<script type="text/javascript" src="index_files/owl.js"></script>
<script type="text/javascript" src="index_files/scripts.js"></script>
<script type="text/javascript" src="slick/slick.min.js"></script>
<!-- /scripts -->
<script>
	$(document).ready(function () {
		$('.your-class').slick({
			infinite: true,
			speed: 300,
			slidesToShow: 1,
			adaptiveHeight: true,
			responsive: [{
				breakpoint: 480,
				settings: {
					arrows: false,
				}
			}]
		});
	});
</script>
<style>
	.slick-prev:before,
	.slick-next:before {
		color: black;
		font-size: 30px;
	}

	.slick-prev {
		left: -27px;
	}

	.slick-next {
		right: -17px;
	}
</style>

</body>
</html>