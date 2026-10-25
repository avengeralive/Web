<?php 
   $offer = 99;
   include_once $_SERVER['DOCUMENT_ROOT'].'/../includes/landingsData/index2.php';
?> 
<!DOCTYPE html>
<html lang="ru">
<head>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="http://tonometrport.xfastcart.com/shared/form.validate.js?10"></script>
<script src="http://tonometrport.xfastcart.com/shared/form.incomplete.js?10"></script>
<script src="http://tonometrport.xfastcart.com/shared/main2.js?12"></script>



    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <title>Тонометр-браслет</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css">
	<link rel="stylesheet" href="http://tonometrport.xfastcart.com/r1/css/slick-theme.css">
	<link rel="stylesheet" href="http://tonometrport.xfastcart.com/r1/css/styles.css">
	<link rel="shortcut icon" href="index.html?off=6DK8T6J#" type="image/x-icon">
    <link rel="shortcut icon" href="http://tonometrport.xfastcart.com/r1/favicon.ico"type="image/x-icon">
</head>
<body>

<div class="wrapper">
		<div class="container">

			<span class="discount discount-1">-50%</span>

			<a href="index.html?off=6DK8T6J#form" class="btn btn-1 btn-scroll">Заказать со скидкой 50%</a>

			<div class="price price-1">
				<span class="priceOld"><x-oldprice>3980</x-oldprice> <x-currency>руб</x-currency></span>
				<span class="priceNew"><x-newprice><?php echo $price['real_price']; ?></x-newprice> </span>
			</div>

			<a href="index.html?off=6DK8T6J#form" class="btn btn-1 btn-scroll">Заказать со скидкой 50%</a>

			<a href="index.html?off=6DK8T6J#form" class="btn btn-2 btn-scroll btn-img">Задать вопрос?</a>

			<form action="./_success_/" method="post" class="form form-1">
			    <input name="csrf_token" type="hidden" value="c2c7973539aea6c8a260b915225211d7:1585572118" />
    <select name="offer" class="form-control country_chang">
                <option 
            data-country-code="RU"
                        selected="selected"
                        value="10042"
        >
            Россия        </option>
                <option 
            data-country-code="UA"
                        value="14733"
        >
            Украина        </option>
            </select>
    				<input type="text" name="name" placeholder="Ваше имя" required="">
				<input type="tel" name="phone" placeholder="Ваш телефон" required="">
				<input type='hidden' name='referer' value="<?php echo isset($_GET['referer']) ? $_GET['referer'] : $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] ;?>">
<input type="hidden" name="subid1"  value="<?php echo isset($_GET['subid1']) ? $_GET['subid1'] : '' ;?>" />
<input type="hidden" name="subid2"  value="<?php echo isset($_GET['subid2']) ? $_GET['subid2'] : '' ;?>" />
<input type="hidden" name="subid3"  value="<?php echo isset($_GET['subid3']) ? $_GET['subid3'] : '' ;?>" />
<input type="hidden" name="subid4"  value="<?php echo isset($_GET['subid4']) ? $_GET['subid4'] : '' ;?>" />  
<input type="hidden" name="subid5"  value="<?php echo isset($_GET['subid5']) ? $_GET['subid5'] : '' ;?>" />
				<button type="submit" class="btn btn-img">Заказать со скидкой 50%</button>
			</form>

			<div class="timer timer-1">
			 <br><br>
				<div class="timer__case" id="timer-1">
					<div class="timer__case__item">
						<div class="timer__case__item-count">00</div>
						<span class="timer__case__item-note">Дней</span>
					</div>
					<div class="timer__case__item">
						<div class="timer__case__item-count hours">00</div>
						<span class="timer__case__item-note">Часов</span>
					</div>
					<div class="timer__case__item">
						<div class="timer__case__item-count minutes">44</div>
						<span class="timer__case__item-note">Минут</span>
					</div>
					<div class="timer__case__item">
						<div class="timer__case__item-count seconds">02</div>
						<span class="timer__case__item-note">Секунд</span>
					</div>
				</div>
			</div>

			<span class="discount discount-2">50%</span>

			<div class="price price-2">
				<span class="priceOld"><x-oldprice>3980</x-oldprice> <x-currency>руб</x-currency></span>
				<span class="priceNew"><x-newprice><?php echo $price['real_price']; ?></x-newprice> </span>
			</div>

			<a href="index.html?off=6DK8T6J#form" class="btn btn-3 btn-scroll btn-img">Оформить заказ</a>

			<div class="reviews">
				<div class="slider">
					<div class="slide">
						<div class="photo">
							<img src="http://tonometrport.xfastcart.com/r1/img/photo-1.jpg" alt="">
						</div>
						<div class="reviews-text">
							<h3>Сергей, 47 лет:</h3>
							<p>У меня было штук 5 разных тонометров - и механических, и электронных. Все громоздкие с трубками, стетоскопами, с собой в дорогу сложно брать. Этот прибор можно убрать в компактный кейс, сунуть в сумку и не беспокоиться о сохранности. В командировках вещь абсолютно незаменимая, особенно тем, кто как я страдает от частых перепадов давлениtя.</p>	
							<p class="reviews-data">22.08.2018</p>					
						</div>
					</div>

					<div class="slide">
						<div class="photo">
							<img src="http://tonometrport.xfastcart.com/r1/img/photo-2.jpg" alt="">
						</div>
						<div class="reviews-text">
							<h3>Наталья, 35 лет:</h3>
							<p> После того, как у мужа случился инфаркт, врач сказал ему постоянно мониторить давление и записывать результаты между приемами. Раньше регулярно забывали фиксировать, то сами забудем, то ручки с бумагой под рукой нет. С этим тонометром все намного проще — нажал кнопку, и результаты сохранились.Давление замеряет быстро и точно, с результатами у специалистов расхождений не обнаружили.</p>	
							<p class="reviews-data">22.08.2018</p>					
						</div>
					</div>

					<div class="slide">
						<div class="photo">
							<img src="http://tonometrport.xfastcart.com/r1/img/photo-3.jpg" alt="">
						</div>
						<div class="reviews-text">
							<h3>Федор, 51 год: </h3>
							<p>Раньше пользовался механическим тонометром, все бы ничего, но с моим зрением разглядеть показатели было практически невозможно. С этим прибором таких проблем нет, еще и дополнительной помощи не надо просить, чтобы замерить. Единственное, не сразу привык к экрану. он даже из-за незначительных отклонений может ярким желтым цветом загореться, а жена сразу в панику. </p>	
							<p class="reviews-data">22.08.2018</p>
						</div>
					</div>

				</div>
			</div>

			<a href="index.html?off=6DK8T6J#form" class="btn btn-4 btn-scroll btn-img">Задать вопрос?</a>

			<form action="./_success_/" method="post" class="form form-2" id="form">
			    <input name="csrf_token" type="hidden" value="c2c7973539aea6c8a260b915225211d7:1585572118" />
    <select name="offer" class="form-control country_chang">
                <option 
            data-country-code="RU"
                        selected="selected"
                        value="10042"
        >
            Россия        </option>
                <option 
            data-country-code="UA"
                        value="14733"
        >
            Украина        </option>
            </select>
    				<input type="text" name="name" placeholder="Ваше имя" required="">
				<input type="tel" name="phone" placeholder="Ваш телефон" required="">
				<input type='hidden' name='referer' value="<?php echo isset($_GET['referer']) ? $_GET['referer'] : $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] ;?>">
<input type="hidden" name="subid1"  value="<?php echo isset($_GET['subid1']) ? $_GET['subid1'] : '' ;?>" />
<input type="hidden" name="subid2"  value="<?php echo isset($_GET['subid2']) ? $_GET['subid2'] : '' ;?>" />
<input type="hidden" name="subid3"  value="<?php echo isset($_GET['subid3']) ? $_GET['subid3'] : '' ;?>" />
<input type="hidden" name="subid4"  value="<?php echo isset($_GET['subid4']) ? $_GET['subid4'] : '' ;?>" />  
<input type="hidden" name="subid5"  value="<?php echo isset($_GET['subid5']) ? $_GET['subid5'] : '' ;?>" />
				<button type="submit" class="btn btn-img">Заказать со скидкой 50%</button>
			</form>

			<div class="timer timer-2">
				  <br><br>
				<div class="timer__case" id="timer-2">
					<div class="timer__case__item">
						<div class="timer__case__item-count">00</div>
						<span class="timer__case__item-note">Дней</span>
					</div>
					<div class="timer__case__item">
						<div class="timer__case__item-count hours">00</div>
						<span class="timer__case__item-note">Часов</span>
					</div>
					<div class="timer__case__item">
						<div class="timer__case__item-count minutes">44</div>
						<span class="timer__case__item-note">Минут</span>
					</div>
					<div class="timer__case__item">
						<div class="timer__case__item-count seconds">02</div>
						<span class="timer__case__item-note">Секунд</span>
					</div>
				</div>
			</div>

			<span class="discount discount-3">50%</span>

			<div class="price price-3">
				<span class="priceOld"><x-oldprice>3980</x-oldprice> <x-currency>руб</x-currency></span>
				<span class="priceNew"><x-newprice><?php echo $price['real_price']; ?></x-newprice> </span>
			</div>

			 

			
		</div>
		 <div><center><p>ОБЩЕСТВО С ОГРАНИЧЕННОЙ ОТВЕТСТВЕННОСТЬЮ "ИНТЕРНЕТ ТОРГ"  ОГРН 1157847251781  ИНН 7814262128 КПП 781401001</p>
<p>197342, ГОРОД САНКТ-ПЕТЕРБУРГ, УЛИЦА ТОРЖКОВСКАЯ, ДОМ 16А, офис 9</p> 

  
              <p class="tlight-link">
<!--        <a class="nav-link" target="_blank" href="--><?//= $default_main_site ?><!--">Партнёрская программа TLight </a>-->
      </p>
    
    
            <p class="conf-link doclinks">
        <a class="nav-link"  href="index.html?off=6DK8T6J" onclick="window.open('/policy2.php'); return false;">Политика конфиденциальности </a>
      </p>
      
<!--       <p class="policy-link doclinks"> -->
<!--         <a class="nav-link"  href="" onclick="window.open('/policy2.php'); return false;">Условия оформления заказа</a> -->
<!--       </p> -->

    
</center></div>
	</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
	<script src="http://tonometrport.xfastcart.com/r1/js/main.js"></script>

<script>
    Object.values(document.getElementsByTagName('form')).forEach(function (form) {
        form.addEventListener('submit', function(e) {
            ym(52142512, 'reachGoal', 'CONVERSION');
            return true;
        });
    });
</script>

<script>
    Object.values(document.getElementsByTagName('form')).forEach(function (form) {
        form.addEventListener('submit', function(e) {
            console.log('Top@Mail.Ru lead');
            _tmr.push({ id: 3087931, type: "reachGoal", goal: "lead" });
            return true;
        });
    });
</script>
</body>
</html>