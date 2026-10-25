<?php 
   $offer = 77;
   include_once $_SERVER['DOCUMENT_ROOT'].'/../includes/landingsData/index2.php';
?> 
<!DOCTYPE html>
<html lang="en">
<head>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" type="text/css" href="slick.css"/>
	<title>Реноватор Bosch</title>

    <link rel="shortcut icon" href="favicon.ico"type="image/x-icon">
</head>
<body>
	<header>
		<div class="topbar-container">
			<div class="topbar">
					<img src="img/logo.png" alt="" class="logo">
					<div class="topbar-item">
						<div class="topbar-img">
							<img src="img/shield.png" alt="" class="topbar-icon">
						</div>
						<div class="topbar-copy">
							Гарантия качества
						</div>
					</div>
					<div class="topbar-item m-hidden">
						<div class="topbar-img">
							<img src="img/medal.png" alt="" class="topbar-icon">
						</div>
						<div class="topbar-copy">
							Выбор профессионалов!
						</div>
					</div>
					<div class="topbar-item t-hidden">
						<div class="topbar-img">
							<img src="img/class.png" alt="" class="topbar-icon">
						</div>
						<div class="topbar-copy">
							Более 9700 положительных отзывов
						</div>
					</div>
			</div>		
		</div>
		<div class="container">
			<h1>Реноватор 
			<div class="yellow-border-wrap">
				<span class="brand">Bosch</span><br>
				<span class="yellow-border">     </span>
			</div>
			</h1>
			<img src="img/37.png" alt="" class="number">
			<div class="reverse">
				<div class="maincol-r">
					<div class="maincopy">
						Многофункциональный
						инструмент для любых ремонтных
						и восстановительных работ
					</div>
					<img src="img/bosch.png" alt="" class="mainpic">
				</div>
				<div class="maincol-l">
					<div class="cta-wrapper">
						<div class="prices">
							<div class="price firstprice">
								<span class="black">Обычная цена:</span><br>
								<span class="oldprice oldproductsum black"><x-oldprice>5980</x-oldprice> <x-currency>руб</x-currency></span>
							</div>
							<div class="price newprice productsum"><x-newprice><?php echo $price['real_price']; ?></x-newprice> </div>
						</div>
						<div class="timer">
							<p class="center timer-head">Предложение действует:</p>
							<div id="clockdiv" class="clockdiv">
								<span class="hours1"></span>
								<span class="hours2"></span>
								<img src="img/dots.png" alt="">
								<span class="minutes1"></span>
								<span class="minutes2"></span>
								<img src="img/dots.png" alt="">
								<span class="seconds1"></span>
								<span class="seconds2"></span>
							</div>
							<div class="clockdiv_tiles">
								<span>Часов</span>
								<span>Минут</span>
								<span>Секунд</span>
							</div>
						</div>
						<div>
							<a href="#form" class="button-link">
								<button class="cta">ЗАКАЗАТЬ СЕЙЧАС</button>
							</a>
						</div>
						<div>
							<p class="center">
								Осталось  <span class="numberof">1</span><span class="numberof">3</span>  штук по акции
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>
	<section>
		<div class="container">
			<div class="gallery">
				<img src="img/pic1.jpg" alt="" class="pic">
				<img src="img/pic2.jpg" alt="" class="pic">
				<img src="img/pic3.jpg" alt="" class="pic">
			</div>
			<div class="description" id="description">
				<div class="col-l">
					<h2 class="black">
						Реноватор
						<span class="red">Bosch</span>
					</h2>
					<p>
						Многофункциональный инструмент Bosch – это универсальное решение задач по пилению, резке, шлифованию и шабрению в одном ультра-легком компактном корпусе.

						Инструмент универсален благодаря широкому ассортименту принадлежностей Bosch Starlock, который включает в себя множество различных насадок. Мощность инструмента составляет 220 Вт и за счет своей легкости и компактности он подходит для работ в самых труднодоступных местах, где не справится никакой другой инструмент.
					</p>
					<div class="watch-wrap">
						<div class="watch-icon">
							<img src="img/youtube.png" alt="">
						</div>
						<a href="#popup1"><div class="watch-copy">Смотреть видео</div></a>
						<div id="popup1" class="overlay">
							<div class="popup">							
								<a class="close" href="#description">&times;</a>
                                <iframe width="560" height="315" src="https://www.youtube.com/embed/u7qfRLV3LX0" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
							</div>
						</div>
					</div>
				</div>
				<div class="cpl-r">
					<img src="img/set.jpg" alt="">
				</div>
			</div>
			<div class="features">
				<div class="feature">
					<img src="img/f1.jpg" alt="" class="f-img">
					<div class="f-copy">
						Предустановка скорости с учетом свойств обрабатываемого материала
					</div>
				</div>
				<div class="feature">
					<img src="img/f2.jpg" alt="" class="f-img">
					<div class="f-copy">
						Магнитный держатель для легкой смены принадлежностей
					</div>
				</div>
				<div class="feature">
					<img src="img/f3.jpg" alt="" class="f-img">
					<div class="f-copy">
						Универсальное применение благодаря широкому выбору насадок
					</div>
				</div>
			</div>
		</div>
	</section>
	<section class="grid">
		<div class="grid-l">
			<div class="grid-ll">
				<img src="img/g1.jpg" alt="">
			</div>
			<div class="grid-lr">
				<div class="grid-lrt">
					<img src="img/g2.jpg" alt="">
				</div>
				<div class="grid-lrb">
					<img src="img/g3.jpg" alt="">
				</div>
			</div>
		</div>
		<div class="grid-r">
			<div class="grid-rt">
				<div class="grid-rtl">
					<img src="img/g4.jpg" alt="">
				</div>
				<div class="grid-rtr">
					<img src="img/g5.jpg" alt="">
				</div>
			</div>
			<div class="grid-rb">
				<img src="img/g6.jpg" alt="">
			</div>
		</div>
	</section>
	<section class="univeral">
	  <div class="container">
		<h2 class="left-heading">
			универсальное
			<span class="red">решение задач</span>
		</h2>
		<div class="button-with-pic">
			<a href="#form" class="button-link">
				<button class="cta cta-second">ЗАКАЗАТЬ СЕЙЧАС</button>
			</a>
		</div>
		<div class="abilities">
			<div class="ability">
				<img src="img/a1.jpg" alt="" class="ability-pic">
				<div class="ability-copy">резка</div>
			</div>
			<div class="ability">
				<img src="img/a2.jpg" alt="" class="ability-pic">
				<div class="ability-copy">пиление</div>
			</div>
			<div class="ability">
				<img src="img/a3.jpg" alt="" class="ability-pic">
				<div class="ability-copy">шлифование</div>
			</div>
			<div class="ability">
				<img src="img/a4.jpg" alt="" class="ability-pic">
				<div class="ability-copy">шабрение</div>
			</div>
		</div>
		<ul class="actions">
			<li class="action">
				вырезание<br>
				потайных<br>
				швов
			</li>
			<li class="action">
				подрезание<br>
				труб<br>
				заподлицо
			</li>
			<li class="action">
				подрезание<br>
				дверных<br>
				косяков
			</li>
			<li class="action">
				обработка<br>
				керамической<br>
				плитки
			</li>
			<li class="action">
				шлифование<br>
				оконных<br>
				рам
			</li>
			<li class="action">
				удаление<br>
				ковровых<br>
				покрытий
			</li>
		</ul>
	  </div>	
	</section>
	<section class="best">
		<div class="best-l">
			<div class="best-ll"></div>
			<div class="best-lr">
				<h2>
					<span class="red">Лучшее</span>
					<span class="black small">соотношение
					функциональности
					и мощности</span>
				</h2>
				<p>
					Насадки легко меняются с помощью шестигранника, который идет в комплекте с инструментом. Сделать этот процесс еще легче помогает встроенный магнит, который надежно фиксирует насадку на инструменте.
				</p>
				<img src="img/tools.jpg" alt="">
			</div>
		</div>
		<div class="best-r"></div>
	</section>
	<section class="char-section">
	  <div class="container">
	  	<div class="chars">
	  		  	<div class="char-l">
	  		  		<h2>
	  		  			<span class="black">Технические</span>
	  		  			<span class="red">характеристики</span>
	  		  		</h2>
	  		  		<div class="chars-grid">
	  		  			<ul class="char-list">
	  		  				<li class="char">
	  		  					<div class="char-h">Питание:</div>
	  		  					<div class="char-copy">сеть 220 В</div>
	  		  					<div class="orange-line"></div>
	  		  				</li>
	  		  				<li class="char">
	  		  					<div class="char-h">MAX число колебаний:</div>
	  		  					<div class="char-copy">20000 кол/мин</div>
	  		  					<div class="orange-line"></div>
	  		  				</li>
	  		  				<li class="char">
	  		  					<div class="char-h">Значение вибрации:</div>
	  		  					<div class="char-copy">10-16 м/с²</div>
	  		  					<div class="orange-line"></div>
	  		  				</li>
	  		  				<li class="char">
	  		  					<div class="char-h">Мощность:</div>
	  		  					<div class="char-copy">220 Вт</div>
	  		  					<div class="orange-line"></div>
	  		  				</li>
	  		  				<li class="char">
	  		  					<div class="char-h">Звуковое давление:</div>
	  		  					<div class="char-copy">84 дБ</div>
	  		  					<div class="orange-line"></div>
	  		  				</li>
	  		  				<li class="char">
	  		  					<div class="char-h">Особенности:</div>
	  		  					<div class="char-copy">плавный пуск</div>
	  		  					<div class="orange-line"></div>
	  		  				</li>
	  		  				<li class="char">
	  		  					<div class="char-h">Вес:</div>
	  		  					<div class="char-copy">1.1 кг</div>
	  		  					<div class="orange-line mob"></div>
	  		  				</li>
	  		  				<li class="char">
	  		  					<div class="char-h">Звуковая мощность:</div>
	  		  					<div class="char-copy">95 дБ</div>
	  		  					<div class="orange-line  mob"></div>
	  		  				</li>
	  		  				<li class="char">
	  		  					<div class="char-h">Угол колебаний:</div>
	  		  					<div class="char-copy">1.4°</div>
	  		  					
	  		  				</li>
	  		  			</ul>
	  		  		</div>
	  		  	</div>
	  			<div class="char-r">
	  				<div class="tes-slider">
	  					<div>
	  						<div class="tes-img tes-img1"></div>  	
	  					</div>
	  					<div>
	  						<div class="tes-img tes-img2"></div>
	  					</div>
	  					<div>
	  						<div class="tes-img tes-img3"></div></p>
	  					</div>
	  					<div>
	  						<div class="tes-img tes-img4"></div></p>
	  					</div>		  
	  				</div>
	  				<div class="tes-arrows"></div>
	  			</div>
	  	</div>
	  	<div class="complect">
	  		<label for="panel"><div class="question">
	  			<div>Что идёт в комплекте?</div>
	  			<img src="img/triangle.png" alt="">
	  		</div></label>
	  		<input type="checkbox" id="panel">
	  		<div class="complect-copy panel">
	  			<ul>
	  				<li>Сегментированный пильный диск BIM Wood and Metal, 85 мм, ACZ 85 EB (2 609 256 943).</li>
	  				<li>Дельташлифпластина 93 мм, AVZ 93 G (2 609 256 956).</li>
	  				<li>Набор дельташлифлистов (2 609 256 A54).</li>
	  				<li>Погружное пильное полотно HCS по древесине, 32 x 40 мм, AIZ 32 EPC (2 609 256 947).</li>
	  				<li>Пластмассовый кейс.</li>
	  				<li>Шестигранный торцовый ключ.</li>
	  				<li>4-ступенчатый ограничитель глубины для сегментированных пильных дисков (2 609 256 C61).</li>
	  			</ul>
	  		</div>
	  	</div>
	  </div>	
	</section>
	<section class="testimonials">
		<div class="testimonials-wrapper">
			
			<h2 class="left-heading">
				Отзывы 
				<span class="red">покупателей</span>
			</h2>
			<div class="button-with-pic">
				<a href="#form" class="button-link">
					<button class="cta cta-second">ЗАКАЗАТЬ СЕЙЧАС</button>
				</a>
			</div>
			<div class="testimonials-grid">
				<div class="testimonial">
					<div class="testimonial-pic"></div>
					<div class="testimonial-line">
						<img src="img/a1.png" alt="" class="autor-photo">
						<div class="autor">
							<div class="a-name">Андрей Соколов</div>
							<div class="a-age">31 год</div>
						</div>
						<div class="grey-quotes">“</div>
					</div>
					<div class="testimonial-copy">
						Отличная машинка, удобно работать там, где не подлезешь лобзиком или ножовкой. По сравнению с болгаркой очень тихий. Возможно он не совсем удобен для масштабных работ, но для дома незаменимый помощник. Я его называю "помагатор", всегда готов пригодиться в любой работе по дому. Если кратко, то он безопасен, прост в эксплуатации и универсален.
					</div>
					<div class="testimonial-bottom"></div>
				</div>
				
				<div class="testimonial">
					<div class="testimonial-pic testimonial-pic2"></div>
					<div class="testimonial-line">
						<img src="img/a2.png" alt="" class="autor-photo">
						<div class="autor">
							<div class="a-name">Иван Трапов</div>
							<div class="a-age">49 лет</div>
						</div>
						<div class="grey-quotes">“</div>
					</div>
					<div class="testimonial-copy">
						Очень хороший и качественный инструмент, режет действительно очень хорошо, мощности хватает с головой. Комлекта насадок хватает под любые задачи, один раз купил и забыл называется. Претензий к качеству нет, да и проблем никаких не возникало. Единственное, ручки иногда не хватает. Покупкой очень доволен.
					</div>
					<div class="testimonial-bottom"></div>
				</div>

				<div class="testimonial">
					<div class="testimonial-pic testimonial-pic3"></div>
					<div class="testimonial-line">
						<img src="img/a3.png" alt="" class="autor-photo">
						<div class="autor">
							<div class="a-name">Владимир Козырев</div>
							<div class="a-age">40 лет</div>
						</div>
						<div class="grey-quotes">“</div>
					</div>
					<div class="testimonial-copy">
						Инструмент просто супер! Он и пиляет и шлифует, шпатель пока еще не проверял, да и с таким комплектом насадок нужно времени поболее) Что бы ни пробовал, то выполняет любую нужную мне работу. Мне кажется, что благодаря своей многофункциональности, этот инструмент должен быть в каждом доме.
					</div>
					<div class="testimonial-bottom"></div>
				</div>
			</div>
		</div>	
	</section>
	<section class="how">
	  <div class="container">
	    <div class="row">
			<h2 class="black left-heading">
				Как заказать
				<span class="red">реноватор?</span>
			</h2>
			<div class="warranty">
				<img src="img/warr.png" alt="" class="warr-pic">
				<div class="warr-copy">
					Мы всегда проверяем товар перед отправкой и гарантируем 100% качество
				</div>
			</div>
		</div>
		<div class="steps">
			<div class="step">
				<img src="img/step1.png" alt="" class="step-photo">
				<div class="step-h">ЗАЯВКА</div>
				<div class="step-copy">
					Заполните форму
					заказа товара на сайте
				</div>
			</div>
			<div class="step">
				<img src="img/step2.png" alt="" class="step-photo">
				<div class="step-h">ЗВОНОК</div>
				<div class="step-copy">
					Наш менеджер перезвонит для уточнения деталей
				</div>
			</div>
			<div class="step">
				<img src="img/step3.png" alt="" class="step-photo">
				<div class="step-h">ОТПРАВКА</div>
				<div class="step-copy">
					Доставляем ваш товар в течение 3-10 дней
				</div>
			</div>
			<div class="step">
				<img src="img/step4.png" alt="" class="step-photo">
				<div class="step-h">ПОЛУЧЕНИЕ</div>
				<div class="step-copy">
					Оплачиваете при получении на
					почте
				</div>
			</div>
		</div>
	  </div>	
	</section>
	<header>
		<div class="topbar-container">
			<div class="topbar second-topbar">
				Сделайте заказ до конца дня
				и получите 50% скидку
			</div>		
		</div>
		<div class="container">
			<h1>Реноватор 
			<div class="yellow-border-wrap">
				<span class="brand">Bosch</span><br>
				<span class="yellow-border">     </span>
			</div>
			</h1>
			<img src="img/37.png" alt="" class="number second-number">
			<div class="reverse second-reverse">
				<div class="maincol-r">
					<div class="maincopy">
						Многофункциональный
						инструмент для любых ремонтных
						и восстановительных работ
					</div>
					<div class="mobile-copy">
						Сделайте заказ
						до конца дня
						<br>и получите
						<span class="underline">50% скидку</span>
					</div>
					<img src="img/bosch.png" alt="" class="mainpic">
				</div>
				<div class="maincol-l">
					<div class="cta-wrapper second-cta-wrapper">
						<div class="prices">
							<div class="price firstprice">
								<span class="black">Обычная цена:</span><br>
								<span class="oldprice oldproductsum black"><x-oldprice>5980</x-oldprice> <x-currency>руб</x-currency></span>
							</div>
							<div class="price newprice productsum"><x-newprice><?php echo $price['real_price']; ?></x-newprice>  </div>
						</div>
						<div class="timer second-timer">
							<p class="center timer-head black">Предложение действует:</p>
							<div id="clockdiv2" class="clockdiv">
								<span class="hours1"></span>
								<span class="hours2"></span>
								<span class="minutes1"></span>
								<span class="minutes2"></span>
								<span class="seconds1"></span>
								<span class="seconds2"></span>
							</div>
							<div class="clockdiv_tiles">
								<span class="black">Часов</span>
								<span class="black">Минут</span>
								<span class="black">Секунд</span>
							</div>
						</div>
						<form id="form" action="./_success_/" method="post">
       <input type='hidden' name='referer' value="<?php echo isset($_GET['referer']) ? $_GET['referer'] : $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] ;?>">
<input type="hidden" name="subid1"  value="<?php echo isset($_GET['subid1']) ? $_GET['subid1'] : '' ;?>" />
<input type="hidden" name="subid2"  value="<?php echo isset($_GET['subid2']) ? $_GET['subid2'] : '' ;?>" />
<input type="hidden" name="subid3"  value="<?php echo isset($_GET['subid3']) ? $_GET['subid3'] : '' ;?>" />
<input type="hidden" name="subid4"  value="<?php echo isset($_GET['subid4']) ? $_GET['subid4'] : '' ;?>" />  
<input type="hidden" name="subid5"  value="<?php echo isset($_GET['subid5']) ? $_GET['subid5'] : '' ;?>" />

							<input type="text" name="name" placeholder="Введите ваше имя">
							<input type="tel" name="phone" placeholder="Введите ваш телефон">
							
							<div class="reolader">
									<input type="submit" value="ЗАКАЗАТЬ СЕЙЧАС" class="cta cta-second">			
							</div>
						</form>	
						<p class="center last">
						Осталось  <span class="numberof">1</span><span class="numberof">3</span>  штук по акции
						</p>
					</div>
				</div>
			</div>
		</div>
	</header>
	<center><footer>
<p>ООО "ТОРГ" ОГРН 1186313112391 ИНН 6319235657</p>
<p>4 4 3 0 1 6 5, Самарская обл., г. Самара, ул. Ново-Вокзальная, д. 8</p> 

  
              <p class="tlight-link">
      </p>
    
    
            <p class="conf-link doclinks">

      </p>
      
    
	</footer></center>
    <script src=" https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script type="text/javascript" src="slick.min.js"></script>
	<script src="script.js"></script>
	<style>
	.form-control{
		 background: #fff;
  width: 100%;
  height: 60px;
  border-radius: 5px;
  border: 1px solid #dedede;
  margin-top: 15px;
  text-align: center;
	}
	</style>
</body>
</html>