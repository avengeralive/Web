<?php 
   $offer = 90;
   include_once $_SERVER['DOCUMENT_ROOT'].'/../includes/landingsData/index2.php';
   $sum = 2490;
   $dis = $sum - $price['real_price'];
   $percent = $dis / ($sum / 100);
   $percent = (int)$percent;
?> 

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>ЖИВОЙ ВОБЛЕР «GODZILLA FISH» | КОСИТ ХИЩНИКА ПО ВСЕЙ ТЕРРИТОРИИ РОССИИ</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="owl.carousel.min.js"></script>
<link rel="stylesheet" href="assets/owl.carousel.css">
<link rel="stylesheet" href="assets/owl.theme.default.css">
<link rel="stylesheet" href="assets/owl.theme.green.css">
<script src="count.js"></script>
<script src="main.js"></script>
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="media.css">
<link rel="stylesheet" href="settings.css">
<script type="text/javascript" src="https://promo2020.ru/static/js/lt_landing_valid_form.js"></script>
<script type="text/javascript" src="https://promo2020.ru/static/js/lt_landing_script.js"></script>
<!-- <script type="text/javascript">
  var nodiscount = 2580;
  var sum = <?php echo $price['real_price']; ?>;
  var discount = nodiscount - sum;
	$jsonData = {"RU":{"currency":" \u0440\u0443\u0431.","productsum":sum,"oldproductsum":nodiscount,"delivery":0,"totalsum":discount}}</script> -->

<!-- LT code insertion -->
<!-- /LT code insertion -->
</head>
<body>
<div class="header">
  <div class="container">
    <div class="row hide_flex hide_pc">
      <div class="col-md-4">
        <div class="flex header__item">
          <div class="header__img header__img1"></div>
          <span class="header__span">Новейшая разработка японских инженеров</span> </div>
      </div>
      <div class="col-md-4">
        <div class="flex header__item">
          <div class="header__img header__img3"></div>
          <span class="header__span">Клюет в любую погоду</span> </div>
      </div>
      <div class="col-md-4">
        <div class="flex header__item">
          <div class="header__img header__img2"></div>
          <span class="header__span">Несколько расцветок и размеров на выбор</span> </div>
      </div>
    </div>
    <div class="flex hide_mob">
      <div class="flex header__item header__item_mob">
        <div class="header__img header__img1"></div>
        <span class="header__span">Новейшая разработка японских инженеров</span> </div>
      <div class="flex header__item header__item_mob">
        <div class="header__img header__img2"></div>
        <span class="header__span">Несколько расцветок и размеров на выбор</span> </div>
    </div>
  </div>
</div>
<div class="block_1">
  <div class="container">
    <h1 class="tac ttu" style="font-family: 'RobotoSlab-Bold'; padding: 10px 0;">Живой воблер <span class="orange__underline">«Godzilla Fish»</span></h1>
    <div class="ma__"> <span class="yellow__block ttu">Косит хищника по всей территории России</span> </div>
    <div class="row">
      <div class="col-md-4">
        <div class="green__items green__items_pc">
          <div class="green__item">
            <div class="green__ic1"></div>
            <span class="green__text">Играет в точности как живая рыба</span> </div>
          <div class="green__item">
            <div class="green__ic2"></div>
            <span class="green__text">Подходит для любого хищника</span> </div>
          <div class="green__item">
            <div class="green__ic3"></div>
            <span class="green__text">Увеличивает улов минимум в 3 раза!</span> </div>
        </div>
        <div class="price__item price__item_pc">
          <div class="old__price"> <span class="old__price_text">Обычная цена:</span>
            <div class="old__price_cost oldproductsum"><?php echo $sum ?>.</div>
          </div>
          <div class="new__price">
            <div class="new__price_cost productsum"> <?php echo $price['real_price']; ?>р.</div>
          </div>
        </div>
        <a href="index.php#form_block" class="hide_pc">
        <div class="order__btn"> Заказать сейчас </div>
        </a>
        <p class="product__count hide_pc">Осталось <span>1</span><span>3</span> штук по акции</p>
      </div>
      <div class="col-md-8">
        <div class="fishes__main hide_pc">
          <div class="sale__item hide_pc">
            <div class="sale__count">-<?php echo $percent ?>%</div>
            <div class="sale__cost"><span class="sale__text">Ваша скидка:</span><span
				class="sale__price productsum"><?php echo $sum - (int)$price['real_price']; ?>.р</span></div>
          </div>
          <div class="blue_circle blue_circle1">
            <p class="blue_circle_t1">Нет плохой погоды</p>
            <p class="blue_circle_t2">Есть плохая одежда!</p>
          </div>
          <div class="blue_circle blue_circle2">
            <p class="blue_circle_t1">Нет плохой рыбалки</p>
            <p class="blue_circle_t2">Есть плохая приманка!</p>
          </div>
          <div class="fishes__img"></div>
        </div>
      </div>
      <div class="flex w100 hide_mob">
        <div class="fishes__img jcc"></div>
      </div>
      <div class="flex noaic w100 hide_mob">
        <div class="green__item2">
          <div class="green__ic1 green__ic"></div>
          <span class="green__text">Играет в точности как живая рыба</span> </div>
        <div class="green__item2">
          <div class="green__ic2 green__ic"></div>
          <span class="green__text">Подходит для любого хищника</span> </div>
        <div class="green__item2">
          <div class="green__ic3 green__ic"></div>
          <span class="green__text">Увеличивает улов минимум в 3 раза!</span> </div>
      </div>
    </div>
    <div class="photos__main">
      <div class="photo1"></div>
      <div class="photo2"></div>
      <div class="photo3"></div>
    </div>
  </div>
  <div class="light__form shadow__ hide_mob">
    <div class="banner__"></div>
    <div class="types_vobler">
      <div class="vobler vobler1">
        <div class="vobler1_img vobler_img"></div>
        <p>Воблер "Щука"</p>
      </div>
      <div class="vobler vobler2">
        <div class="vobler2_img vobler_img"></div>
        <p>Воблер "Плотва"</p>
      </div>
      <div class="vobler vobler3">
        <div class="vobler3_img vobler_img"></div>
        <p>Воблер "Универсальный"</p>
      </div>
    </div>
    <div class="timer">
      <p class="tac">Предложение действует:</p>
      <div class="countbox clearfix"></div>
    </div>
    <div class="price__item shadow__">
    <div class="old__price"> <span class="old__price_text">Обычная цена:</span>
      <div class="old__price_cost oldproductsum"><?php echo $sum ?>р.</div>
    </div>
   
      <div class="new__price">
        <div class="new__price_cost productsum"> <?php echo $price['real_price']; ?>.</div>
      </div>
     </div>
     <form id="form_block2" action="./_success_/" method="post" class="orderformcdn">
      <select name="country" class="countryselect input__form fwn tac"><option selected value='RU'>Россия</option></select>
      <input type="text" class="input__form fwn tac" name="name" value="" placeholder="Ваше имя">
      <input type="text" class="input__form fwn tac" name="phone" value="" placeholder="Ваше телефон">
      <input type='hidden' name='referer' value="<?php echo isset($_GET['referer']) ? $_GET['referer'] : $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] ;?>">
<input type="hidden" name="subid1"  value="<?php echo isset($_GET['subid1']) ? $_GET['subid1'] : '' ;?>" />
<input type="hidden" name="subid2"  value="<?php echo isset($_GET['subid2']) ? $_GET['subid2'] : '' ;?>" />
<input type="hidden" name="subid3"  value="<?php echo isset($_GET['subid3']) ? $_GET['subid3'] : '' ;?>" />
<input type="hidden" name="subid4"  value="<?php echo isset($_GET['subid4']) ? $_GET['subid4'] : '' ;?>" />  
<input type="hidden" name="subid5"  value="<?php echo isset($_GET['subid5']) ? $_GET['subid5'] : '' ;?>" />
      <div class="reolader" style="width: 100%;display: flex;justify-content: center;">
          <input type="submit" value="Заказать сейчас" class="mm_button order__btn" onclick="checkFields(event, this);">
          <div class="ajax_loader_block"><img class="ajax_loader" src="img/ajax-loader.gif" alt="Идет отправка данных"> <span class="ajax_loader">Идет отправка данных</span></div>
      </div>
    </form>
    <p class="product__count" style="color: #222;">Осталось <span style="color: #fff;">1</span><span style="color: #fff;">3</span> штук по акции</p>
  </div>
</div>
<div class="block_2">
  <div class="container">
    <h2 style="font-family: 'RobotoSlab-Bold';">Вам знакомы <span class="blue__">эти проблемы?</span></h2>
    <div class="curves__img"></div>
    <div class="block_2_items">
      <div class="row">
        <div class="col-md-6">
          <div class="block_2_item">
            <div class="block_2_item_img block_2_item_img1"></div>
            <div class="block_2_item_text">
              <div class="block_2_item_title"><span class="blue__">Рыба не клюет,</span> хотя вы
                знаете, что она тут есть</div>
              <div class="block_2_item_info"> На прошлые выходные друг тут поймал 10 кг щуки, а сегодня вообще глухо. Получается,
                зря тратил время, жег бензин чтобы доехать </div>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="block_2_item">
            <div class="block_2_item_img block_2_item_img2"></div>
            <div class="block_2_item_text">
              <div class="block_2_item_title">Клюет <span class="blue__">одна мелочь,</span> крупный хищник не идет</div>
              <div class="block_2_item_info"> Ну, разве это окунь? Кот и тот будет смеяться. А судя по всплеску, хорошая рыба тут есть </div>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="block_2_item">
            <div class="block_2_item_img block_2_item_img3"></div>
            <div class="block_2_item_text">
              <div class="block_2_item_title"><span class="blue__">Поменялась погода, изменился уровень воды </span> и клев закончился</div>
              <div class="block_2_item_info"> В 21 веке зависеть от капризов природы?! Уходить из-за того, что сбросили воду? Обидно! </div>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="block_2_item">
            <div class="block_2_item_img block_2_item_img4"></div>
            <div class="block_2_item_text">
              <div class="block_2_item_title"><span class="blue__">Не получаете удовольствия от рыбалки </span> из-за вялого клева</div>
              <div class="block_2_item_info"> Рыбалка – это отдых, азарт, удовольствие. А какой может быть адреналин от такого клева? Заснуть можно! </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="block_3">
  <div class="container">
    <div class="row" style="align-items: center;">
      <div class="col-md-5">
        <h2 style="text-align: left; font-family: 'RobotoSlab-Bold';">Живой воблер <span
		class="blue__">«Godzilla Fish»</span></h2>
        <div class="curves__img_left"></div>
        <div class="green__items">
          <div class="green__item">
            <div class="green__ic6"></div>
            <span class="green__text green__text2">Играет в точности как живая рыба</span> </div>
          <div class="green__item">
            <div class="green__ic5"></div>
            <span class="green__text green__text2">Подходит для любого хищника</span> </div>
          <div class="green__item">
            <div class="green__ic4"></div>
            <span class="green__text green__text2">Увеличивает улов минимум в 3 раза!</span> </div>
        </div>
      </div>
      <div class="col-md-7">
        <iframe class="shadow__ youtube__" width="560" height="315" src="https://www.youtube.com/embed/-bR3J_t9rQ4" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
      </div>
    </div>
  </div>
  <div class="block_3_photo">
    <div class="ma__">
      <div class="yellow__block yellow__block_2">Искусственный живец, который всегда под рукой</div>
    </div>
    <div class="long__photo"></div>
  </div>
  <div class="blue_field"></div>
</div>
<div class="block_4">
  <div class="container">
    <h1 class="tac" style="font-family: 'RobotoSlab-Bold';">Почему <span class="orange__underline dib">это
      работает?</span></h1>
    <div class="ma__ mt30"> <span class="yellow__block">Раненая рыба – излюбленная цель любой хищной рыбы!</span> </div>
    <div class="row" style="margin: 20px 0;">
      <div class="col-md-3">
        <div class="how__item">
          <div class="how_img1"></div>
          <p>Рыба ослаблена и не может быстро плыть</p>
        </div>
      </div>
      <div class="col-md-3">
        <div class="how__item">
          <div class="how_img2"></div>
          <p>Срабатывает инстинкт природы – в первую очередь съедаем слабых</p>
        </div>
      </div>
      <div class="col-md-3">
        <div class="how__item">
          <div class="how_img3"></div>
          <p>Инстинкт хищника срабатывает даже у вялой и сытой особи</p>
        </div>
      </div>
      <div class="col-md-3">
        <div class="how__item">
          <div class="how_img4"></div>
          <p>Меньше затрат энергии, чтобы ее поймать</p>
        </div>
      </div>
    </div>
    <a href="index.php#form_block">
    <div class="order__btn" style="margin: 0 auto;"> Заказать сейчас </div>
    </a>
    <p class="product__count mt30 hide_mob jcc_mob">Осталось <span>1</span><span>3</span> штук по акции</p>
  </div>
</div>
<div class="block_5">
  <div class="container">
    <div class="row" style="margin-top: 20px;">
      <div class="col-md-7">
        <h2 style="text-align: left; font-family: 'RobotoSlab-Bold';">Новейшая разработка <br>
          <span class="blue__">японских ученых</span></h2>
        <div class="curves__img_left"></div>
        <div class="df_text"> <span>Всего год назад приманка появилась в США, Канаде и Австралии.</span>
          <div class="yellow__block yellow__block3"> Сегодня она уже косит судака и щуку по всей России. </div>
          <p>В 2017 году в результате плодотворного взаимного сотрудничества группы специалистов из Центра
            изучения проблем окружающей среды, рыболовной деятельности и аквакультуры Японии под
            руководством доктора Хэгиро Ямамото, была разработана модель 8-сегментного туловища, на
            95,8% точно имитирующего раненую рыбу. Обнаруженный эффект приводит к резкому
            немотивированному повышению аппетита рыбы и тенденции к скучиванию.</p>
          <div class="check__block">
            <div class="check_img"></div>
            <span>Рыба в 58% случаев <b>бросается на приманку, даже если сытая</b></span> </div>
          <div class="check__block">
            <div class="check_img"></div>
            <span>Размер пойманной рыбы <b>увеличивается в 2,35 раза</b></span> </div>
          <div class="check__block">
            <div class="check_img"></div>
            <span>Приманка одинаково <b>привлекает любого хищника</b></span> </div>
        </div>
      </div>
      <div class="col-md-5">
        <div class="green__items hide_pc">
          <div class="green__item">
            <div class="green__ic7"></div>
            <span class="green__text green__text2">Привлекает рыбу в радиусе 30 метров!</span> </div>
          <div class="green__item">
            <div class="green__ic8"></div>
            <span class="green__text green__text2">Воблеры испытаны и протестированы в разных водоемах:
            реках, каналах, озерах, заливах, морях – и зимой и летом.</span> </div>
        </div>
        <div class="chemical__img"></div>
        <div class="green__items hide_mob">
          <div class="green__item">
            <div class="green__ic7"></div>
            <span class="green__text green__text2">Привлекает рыбу в радиусе 30 метров!</span> </div>
          <div class="green__item">
            <div class="green__ic8"></div>
            <span class="green__text green__text2">Воблеры испытаны и протестированы в разных водоемах:
            реках, каналах, озерах, заливах, морях – и зимой и летом.</span> </div>
        </div>
      </div>
    </div>
  </div>
  <div class="hide_pc">
    <div class="long__photo2"></div>
  </div>
  <div class="container">
    <div class="row nowrapmob">
      <div class="col-md-6 ovf_h_mob" style="padding: 0;">
        <div class="mob_photos_china_img china__img"></div>
        <div class="info_block">
          <div class="red_title hide_pc"> Обычные китайские приманки не дают результат, а только треплют нервы! </div>
          <div class="black_title hide_mob fwn">Обычные китайские приманки</div>
          <div class="bad_list">
            <div class="bad_item">
              <div class="red_mark"></div>
              <p>Не играют, 0 внимания хищника</p>
            </div>
            <div class="bad_item">
              <div class="red_mark"></div>
              <p>Тройник тупой, не зацепляет рыбу</p>
            </div>
            <div class="bad_item">
              <div class="red_mark"></div>
              <p>Стоят дорого, а клев не гарантируют</p>
            </div>
            <div class="bad_item">
              <div class="red_mark"></div>
              <p>Привередливы к погоде, нужно всегда с собой брать до 10 шт.</p>
            </div>
            <div class="china_img hide_mob"></div>
          </div>
          <div class="bad_img hide_pc"></div>
        </div>
      </div>
      <div class="col-md-6" style="padding: 0;">
        <div class="mob_photos_china_img nice_vobler_img"></div>
        <div class="info_block shadow__">
          <div class="green_title green_title_mob"> Живой воблер «Godzilla Fish» </div>
          <div class="white_list">
            <div class="check__block">
              <div class="check_img"></div>
              <span>Живая игра, рыба не в силах устоять</span> </div>
            <div class="check__block">
              <div class="check_img"></div>
              <span>Результат при любой погоде</span> </div>
            <div class="check__block">
              <div class="check_img"></div>
              <span>Острые японские тройники с химической заточкой</span> </div>
            <div class="check__block">
              <div class="check_img"></div>
              <span>Изготовлен из экологически чистого материала <b>без запаха</b></span> </div>
            <div class="check__block">
              <div class="check_img"></div>
              <span>3D реалистичные глаза</span> </div>
            <div class="check__block">
              <div class="check_img"></div>
              <span>Оптимальный вес 20 грамм - дальний заброс обеспечен</span> </div>
            <div class="check__block">
              <div class="check_img"></div>
              <span>Подходит для всех видов хищников – щука, судак, окунь, лосось, голавль и
              т.д.</span> </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="block_6">
  <div class="container">
    <div class="row">
      <div class="col-md-8">
        <div class="sale__item sale__item_mob hide_mob">
          <div class="sale__count">-<?php echo $percent ?>%</div>
          <div class="sale__cost"><span class="sale__text">Ваша скидка:</span><span
			class="sale__price productsum"><?php echo $sum - (int)$price['real_price']; ?>.</span></div>
        </div>
        <h3 class="fz42 fwn ttu"><span class="yellow_mob">Лимитированная партия</span><br>
          <span
		class="orange__underline fz80 posTitleUp">для России</span></h3>
        <div class="fish_img"></div>
      </div>
      <div class="col-md-4">
        <div class="magazine__block">
          <div class="magazine_img"></div>
                    <p>После публикации статьи 23.03.2020 в журнале "Охота и Рыбалка", <span class="yellow__block_3">наличие товара на складе сокращается!</span></p>
        </div>
        <div class="price__item hide_pc_flex" style="margin-top: 20px;">
          <div class="old__price"> <span class="old__price_text">Обычная цена:</span>
            <div class="old__price_cost oldproductsum"><?php echo $sum ?>р.</div>
          </div>
          <div class="new__price">
            <div class="new__price_cost productsum"> <?php echo $price['real_price']; ?>р.</div>
          </div>
        </div>
        <a href="index.php#form_block" class="hide_pc">
        <div class="order__btn"> Заказать сейчас </div>
        </a>
        <p class="product__count hide_pc">Осталось <span>1</span><span>3</span> штук по акции</p>
      </div>
      <div class="light__form shadow__ hide_mob mt30">
        <div class="timer">
          <p class="tac">Предложение действует:</p>
          <div class="countbox clearfix"></div>
        </div>
        <div class="price__item shadow__">
        <div class="old__price"> <span class="old__price_text">Обычная цена:</span>
          <div class="old__price_cost oldproductsum"><?php echo $sum ?>р.</div>
        </div>
        <form id="form_block2" action="./_success_/" method="post">
          <div class="new__price">
            <div class="new__price_cost productsum"> <?php echo $price['real_price']; ?>р.</div>
          </div>
          </div>
          <a href="index.php#form_block">
          <div class="order__btn"> Заказать сейчас </div>
          </a>
        </form>
        <p class="product__count" style="color: #222;">Осталось <span style="color: #fff;">1</span><span
		style="color: #fff;">3</span> штук по акции</p>
      </div>
    </div>
  </div>
</div>
<div class="block_7">
  <div class="container">
    <div class="row wrapmob">
      <div class="flex aic w100 wrapmob">
        <div class="col-md-6 col-sm-12">
          <h2 style="text-align: left; font-family: 'RobotoSlab-Bold';">Живой воблер <br>
            <span
			class="blue__">«Godzilla Fish»</span></h2>
          <div class="curves__img_left"></div>
          <p class="fwn yellow_mob_p">Гарантированный улов каждый день,<span class="yellow_mob_color"> который не стыдно показать жене!</span></p>
        </div>
        <div class="col-md-6">
          <div class="check__block fwn">
            <div class="check_img"></div>
            <span>3 воблера на выбор</span> </div>
          <div class="check__block fwn">
            <div class="check_img"></div>
            <span>Отличное качество покраски</span> </div>
          <div class="check__block fwn tal">
            <div class="check_img"></div>
            <span>Рекомендуем ловить твичингом:<br>
            три рывка, пауза, рывок, пауза. Щука не
            устоит!</span> </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-3 trophy_block">
        <div class="logo_img1 mg"></div>
        <p class="fwn tac tal">Призер весенней выставки "Охота и Рыболовство на Руси" 2019</p>
      </div>
      <div class="col-md-3 trophy_block">
        <div class="logo_img2 mg"></div>
        <p class="fwn tac tal">Призер выставки в США "Cincinnati Hunting & Fishing Show" 2018</p>
      </div>
      <div class="col-md-3 trophy_block">
        <div class="logo_img3 mg"></div>
        <p class="fwn tac tal">Победитель выставки "ISE San Mateo" в номинации "Лучший продукт года", 2018 год</p>
      </div>
      <div class="col-md-3 hide_pc">
        <div class="docs mg"></div>
      </div>
      <div class="col-md-3 hide_mob">
        <div class="docs_2 mg"></div>
      </div>
    </div>
  </div>
</div>
<div class="block_8">
  <div class="container">
    <div class="row aic jcsb jcc_mob">
      <div class="col-md-8">
        <h1 style="font-size: 48px; text-transform: unset; font-family: 'RobotoSlab-Bold';">Реальные
          отзывы<br>
          <span class="orange__underline">наших покупателей</span></h1>
      </div>
      <div class="col-md-4 hide_pc">
        <div class="reviews_img"></div>
      </div>
    </div>
    <div class="row review_blocks hide_pc_flex mt30">
      <div class="col-md-4">
        <div class="review_block shadow__">
          <div class="review_img review_img1"></div>
          <div class="review_name aic">
            <div class="review_photo review_photo1"></div>
            <div class="review_info"> <span>Алексей Соколов</span><br>
              <span class="fwn">31 год</span> </div>
          </div>
          <div class="review_text fwn">Рыбацкий стаж у меня небольшой 3 месяца – стал ходить, чтобы
            уважить тестя. Узнал о godzilla fish и решил попробовать. Деньги небольшие, зато появится
            шанс уделать тестя. Тот, увидев мою блесну начал отпускать очередную порцию своих колкостей…
            пока я через 20 минут не вытащил щуку на почти 5 кг! А через 15 минут еще одну – на три 3кг!
            В общем в тот день у меня был триумф!</div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="review_block shadow__">
          <div class="review_img review_img2"></div>
          <div class="review_name aic">
            <div class="review_photo review_photo2"></div>
            <div class="review_info"> <span>Иван Трапов</span><br>
              <span class="fwn">49</span> </div>
          </div>
          <div class="review_text fwn">У меня почти 20 лет рыбацкого стажа и я всегда считал, что главное
            – это опыт и умение. Но эта приманка перевернула все мои представления. С ней реально можно
            ловить любого хищника и в любую погоду. Благодаря этой приманке, я установил свой личный
            рекорд – 14 щук за одну рыбалку. Вот что значит свежий взгляд на рыбацкие снасти! Теперь то
            докуплю оставшиеся воблеры.</div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="review_block shadow__">
          <div class="review_img review_img3"></div>
          <div class="review_name aic">
            <div class="review_photo review_photo3"></div>
            <div class="review_info"> <span>Владимир Козырев</span><br>
              <span class="fwn">40 лет</span> </div>
          </div>
          <div class="review_text fwn">Впервые увидел у друга. Пошли с ним на рыбалку и он достал из
            своего рыбацкого ящика эти воблеры. Они дергаются, ну точно будто подранок. Да еще и
            вибрируют. Друг сказал, что так они имитируют звуки раненой рыбы. В тот раз он меня обставил
            – поймал раза в 4 больше рыбы. Та рыбалка стала для меня лучше рекламой этой приманки.
            Заказал вот и себе, теперь мы с ним на равных)</div>
        </div>
      </div>
    </div>
    <div class="hide_mob">
      <div class="owl-carousel mt30 ">
        <div class="review_block shadow__">
          <div class="review_img review_img1"></div>
          <div class="review_name aic">
            <div class="review_photo review_photo1"></div>
            <div class="review_info"> <span>Алексей Соколов</span><br>
              <span class="fwn">31 год</span> </div>
          </div>
          <div class="review_text fwn">Рыбацкий стаж у меня небольшой 3 месяца – стал ходить, чтобы уважить
            тестя. Узнал о godzilla fish и решил попробовать. Деньги небольшие, зато появится шанс уделать
            тестя. Тот, увидев мою блесну начал отпускать очередную порцию своих колкостей… пока я через 20
            минут не вытащил щуку на почти 5 кг! А через 15 минут еще одну – на три 3кг! В общем в тот день
            у меня был триумф!</div>
        </div>
        <div class="review_block shadow__">
          <div class="review_img review_img2"></div>
          <div class="review_name aic">
            <div class="review_photo review_photo2"></div>
            <div class="review_info"> <span>Иван Трапов</span><br>
              <span class="fwn">49</span> </div>
          </div>
          <div class="review_text fwn">У меня почти 20 лет рыбацкого стажа и я всегда считал, что главное –
            это опыт и умение. Но эта приманка перевернула все мои представления. С ней реально можно ловить
            любого хищника и в любую погоду. Благодаря этой приманке, я установил свой личный рекорд – 14
            щук за одну рыбалку. Вот что значит свежий взгляд на рыбацкие снасти! Теперь то докуплю
            оставшиеся воблеры.</div>
        </div>
        <div class="review_block shadow__">
          <div class="review_img review_img3"></div>
          <div class="review_name aic">
            <div class="review_photo review_photo3"></div>
            <div class="review_info"> <span>Владимир Козырев</span><br>
              <span class="fwn">40 лет</span> </div>
          </div>
          <div class="review_text fwn">Впервые увидел у друга. Пошли с ним на рыбалку и он достал из своего
            рыбацкого ящика эти воблеры. Они дергаются, ну точно будто подранок. Да еще и вибрируют. Друг
            сказал, что так они имитируют звуки раненой рыбы. В тот раз он меня обставил – поймал раза в 4
            больше рыбы. Та рыбалка стала для меня лучше рекламой этой приманки. Заказал вот и себе, теперь
            мы с ним на равных)</div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="block_9">
  <div class="container">
    <h2 style="text-align: left; font-family: 'RobotoSlab-Bold';" class="hide_mob__b">Как сделать <br>
      <span class="blue__">заказ?</span></h2>
    <div class="curves__img_left hide_mob__b"></div>
    <div class="row hide_pc">
      <div class="flex aic w100">
        <div class="col-md-7">
          <h2 style="text-align: left; font-family: 'RobotoSlab-Bold';">Как сделать <br>
            <span class="blue__">заказ?</span></h2>
          <div class="curves__img_left"></div>
        </div>
        <div class="col-md-5">
          <div class="garant_block shadow__ hide_pc">
            <div class="garant_icon"></div>
            <div class="garant_text fwn">Мы всегда проверяем товар перед отправкой и <span class="fwb">гарантируем 100% качество</span></div>
          </div>
        </div>
      </div>
    </div>
    <div class="steps_block">
      <div class="row">
        <div class="col-md-3">
          <div class="step_block">
            <div class="step_img">
              <div class="step_img1"></div>
              <div class="step_icon">
                <div class="step_icon1"></div>
                <div class="step_num">01</div>
              </div>
            </div>
            <div class="step_text">
              <div class="step_title">Заявка</div>
              <div class="step_desc fwn">Заполните форму заказа товара на сайте</div>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="step_block">
            <div class="step_img">
              <div class="step_img2"></div>
              <div class="step_icon">
                <div class="step_icon2"></div>
                <div class="step_num">02</div>
              </div>
            </div>
            <div class="step_text">
              <div class="step_title">Звонок</div>
              <div class="step_desc fwn">Наш менеджер перезвонит для уточнения деталей</div>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="step_block">
            <div class="step_img">
              <div class="step_img3"></div>
              <div class="step_icon">
                <div class="step_icon3"></div>
                <div class="step_num">03</div>
              </div>
            </div>
            <div class="step_text">
              <div class="step_title">Отправка</div>
              <div class="step_desc fwn">Доставляем ваш товар в течение 3-10 дней</div>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="step_block">
            <div class="step_img">
              <div class="step_img4"></div>
              <div class="step_icon">
                <div class="step_icon4"></div>
                <div class="step_num">04</div>
              </div>
            </div>
            <div class="step_text">
              <div class="step_title">Получение</div>
              <div class="step_desc fwn">Оплачиваете при получении на почте</div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="garant_block shadow__ hide_mob__b">
      <div class="garant_icon"></div>
      <div class="garant_text fwn">Мы всегда проверяем товар перед отправкой и <span
		class="fwb">гарантируем 100% качество</span></div>
    </div>
  </div>
</div>
<div class="orange_title_mob hide_mob">Закажите сегодня и получите <?php echo $percent ?>% скидку!</div>
<div class="block_10">
  <div class="container">
    <h1 class="tac" style="font-family: 'RobotoSlab-Bold';">Живой воблер <span class="orange__underline">«Godzilla Fish»</span></h1>
    <div class="ma__ mg" style="margin-bottom: 30px;"> <span class="yellow__block">Косит хищника по всей территории России</span> </div>
    <div class="hide_pc">
      <div class="row">
        <div class="col-md-7">
          <div class="fishes__main">
            <div class="sale__item">
              <div class="sale__count">-<?php echo $percent ?>%</div>
              <div class="sale__cost"><span class="sale__text">Ваша скидка:</span><span
					class="sale__price productsum"><?php echo $sum - (int)$price['real_price']; ?>.</span></div>
            </div>
            <div class="blue_circle blue_circle1">
              <p class="blue_circle_t1">Нет плохой погоды</p>
              <p class="blue_circle_t2">Есть плохая одежда!</p>
            </div>
            <div class="blue_circle blue_circle2">
              <p class="blue_circle_t1">Нет плохой рыбалки</p>
              <p class="blue_circle_t2">Есть плохая приманка!</p>
            </div>
            <div class="fishes__img"></div>
          </div>
        </div>
        <div class="col-md-5">
          <div class="light__form shadow__">
            <div class="price__item shadow__">
            <div class="old__price"> <span class="old__price_text">Обычная цена:</span>
              <div class="old__price_cost oldproductsum"><?php echo $sum ?>р.</div>
            </div>
              <div class="new__price">
                <div class="new__price_cost productsum"> <?php echo $price['real_price']; ?>р.</div>
              </div>
              </div>
            <form id="form_block4" action="./_success_/" method="post">
              <div class="timer">
                <p class="tac">Предложение действует:</p>
                <div class="countbox clearfix"></div>
              </div>
              <select name="country" class="countryselect input__form fwn tac"><option selected value='RU'>Россия</option></select>
			  <input type="text" class="input__form fwn tac" name="name" value="" placeholder="Ваше имя">
              <input type="text" class="input__form fwn tac" name="phone" value="" placeholder="Ваше телефон">
        <div class="reolader" style="width: 100%;display: flex;justify-content: center;">
            <input type="submit" value="Заказать" class="mm_button order__btn" onclick="checkFields(event, this);">
            <div class="ajax_loader_block"><img class="ajax_loader" src="img/ajax-loader.gif" alt="Идет отправка данных"> <span class="ajax_loader">Идет отправка данных</span></div>
        </div>
				<input type='hidden' name='referer' value="<?php echo isset($_GET['referer']) ? $_GET['referer'] : $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] ;?>">
<input type="hidden" name="subid1"  value="<?php echo isset($_GET['subid1']) ? $_GET['subid1'] : '' ;?>" />
<input type="hidden" name="subid2"  value="<?php echo isset($_GET['subid2']) ? $_GET['subid2'] : '' ;?>" />
<input type="hidden" name="subid3"  value="<?php echo isset($_GET['subid3']) ? $_GET['subid3'] : '' ;?>" />
<input type="hidden" name="subid4"  value="<?php echo isset($_GET['subid4']) ? $_GET['subid4'] : '' ;?>" />  
<input type="hidden" name="subid5"  value="<?php echo isset($_GET['subid5']) ? $_GET['subid5'] : '' ;?>" />
            </form>
            <p class="product__count" style="color: #222;">Осталось <span style="color: #fff;">1</span><span style="color: #fff;">3</span> штук по акции</p>
          </div>
        </div>
      </div>
    </div>
    <div class="flex w100 hide_mob">
      <div class="fishes__img jcc"></div>
    </div>
    <div class="flex noaic w100 hide_mob">
      <div class="green__item2">
        <div class="green__ic1 green__ic"></div>
        <span class="green__text">Играет в точности как живая рыба</span> </div>
      <div class="green__item2">
        <div class="green__ic2 green__ic"></div>
        <span class="green__text">Подходит для любого хищника</span> </div>
      <div class="green__item2">
        <div class="green__ic3 green__ic"></div>
        <span class="green__text">Увеличивает улов минимум в 3 раза!</span> </div>
    </div>
    <div class="sale__item sale__item_mob hide_mob">
      <div class="sale__count">-<?php echo $percent ?>%</div>
      <div class="sale__cost"><span class="sale__text">Ваша скидка:</span><span class="sale__price productsum"><?php echo $sum - (int)$price['real_price']; ?>.</span> </div>
    </div>
  </div>
  <div class="light__form shadow__ hide_mob mt30">
    <div class="banner__"></div>
    <div class="types_vobler">
      <div class="vobler vobler1">
        <div class="vobler1_img vobler_img"></div>
        <p>Воблер "Щука"</p>
      </div>
      <div class="vobler vobler2">
        <div class="vobler2_img vobler_img"></div>
        <p>Воблер "Плотва"</p>
      </div>
      <div class="vobler vobler3">
        <div class="vobler3_img vobler_img"></div>
        <p>Воблер "Универсальный"</p>
      </div>
    </div>
    <div class="timer">
      <p class="tac">Предложение действует:</p>
      <div class="countbox clearfix"></div>
    </div>
    <div class="price__item shadow__">
    <div class="old__price"> <span class="old__price_text">Обычная цена:</span>
      <div class="old__price_cost oldproductsum"><?php echo $sum ?>р.</div>
    </div>
    <form id="form_block3" action="./_success_/" method="post">
      <div class="new__price">
        <div class="new__price_cost productsum"> <?php echo $price['real_price']; ?>р.</div>
      </div>
      </div>
	  <select name="country" class="countryselect input__form fwn tac"><option selected value='RU'>Россия</option></select>
      <input type="text" class="input__form fwn tac" name="name" value="" placeholder="Ваше имя">
      <input type="text" class="input__form fwn tac" name="phone" value="" placeholder="Ваше телефон">
    <div class="reolader" style="width: 100%;display: flex;justify-content: center;">
          <input type="submit" value="Заказать" class="mm_button order__btn" onclick="checkFields(event, this);">
          <div class="ajax_loader_block"><img class="ajax_loader" src="img/ajax-loader.gif" alt="Идет отправка данных"> <span class="ajax_loader">Идет отправка данных</span></div>
      </div>
      <input type='hidden' name='referer' value="<?php echo isset($_GET['referer']) ? $_GET['referer'] : $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] ;?>">
<input type="hidden" name="subid1"  value="<?php echo isset($_GET['subid1']) ? $_GET['subid1'] : '' ;?>" />
<input type="hidden" name="subid2"  value="<?php echo isset($_GET['subid2']) ? $_GET['subid2'] : '' ;?>" />
<input type="hidden" name="subid3"  value="<?php echo isset($_GET['subid3']) ? $_GET['subid3'] : '' ;?>" />
<input type="hidden" name="subid4"  value="<?php echo isset($_GET['subid4']) ? $_GET['subid4'] : '' ;?>" />  
<input type="hidden" name="subid5"  value="<?php echo isset($_GET['subid5']) ? $_GET['subid5'] : '' ;?>" /> 
    </form>
    <p class="product__count" style="color: #222;">Осталось <span style="color: #fff;">1</span><span style="color: #fff;">3</span> штук по акции</p>
  </div>
</div>
<div id="form_block"></div>
<center>
	<p style="padding-bottom: 10px;color:#333;">ООО&nbsp;"Козлов&nbsp;и&nbsp;КО" ОГРН&nbsp;1075024003691 ИНН&nbsp;5024086937 143409, г.&nbsp;Красногорск,&nbsp;Успенская&nbsp;улица, дом&nbsp;11, к.&nbsp;164</p>
	<p><img src="img/leadtrade.png"></p>
	<p style="padding-top: 10px;"><a href="politika.html" target="_blank">Политика конфиденциальности</a> <br><a href="agreement.html" target="_blank">Пользовательское соглашение</a></p>
</center>
</div>
</body>
</html>