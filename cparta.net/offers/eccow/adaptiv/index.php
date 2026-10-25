<?php 
   $offer = 4;
   include_once $_SERVER['DOCUMENT_ROOT'].'/../includes/landingsData/index2.php';
   $name = "name";
?> 

<!DOCTYPE html>
<html lang="ru">
 
<head>
  <meta charset="UTF-8"><link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" type="text/css" href="/css/form.min.css?lvcss=201907091022" />
<script type="text/javascript">
/*<![CDATA[*/
document.write('<scr'+'ipt type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js">'+'</scr'+'ipt>');
document.write('<scr'+'ipt type="text/javascript">lvjq1 = jQu'+'ery.noConflict(true);</scr'+'ipt>');
/*]]>*/
</script>
<script type="text/javascript" src="/js/jquery.maskedinput.js"></script>
<script type="text/javascript" src="/js/jquery.yiiactiveform.js"></script>
<script type="text/javascript" src="/js/formHelper.min.js?lvjs=201907310940"></script>
<title>ЕССО SN Z</title>
<link rel="stylesheet" href="css/libs.css">
<link rel="stylesheet" href="css/index.css">
  

</head>
<body><script type="text/javascript">
/*<![CDATA[*/
lvjq1(document).ready(function () {lvjq1(".lv-form-timezone").val(new Date().getTimezoneOffset());});
/*]]>*/
</script>



  <section class="header">
    <div class="container">
      <div class="logo"><img src="images/logo.png" class="img-fluid" alt=""></div>
      <h1 class="header__header-title-1 header-title-1">женские кроссовки
        из <span>натуральной кожи</span></h1>
        <div class="header__img">
          <div class="sale"><img src="images/sale60.png" class="img-fluid" alt=""></div>
          <div class="boots"><img src="images/boots.png" class="img-fluid" alt=""></div>
        </div>
        <div class="price">
          <div class="old-price">7990 руб</div>
          <div class="current-price"><?php echo $price['real_price']; ?></div>
        </div>
        <div class="header__timer-box timer-box">
          <div class="timer-box__title">Успейте заказать оригинальные
          ECCO кроссовки по лучшей цене</div>
          <div class="timer"></div>
        </div>
        <a href="#" class="header__btn btn btn_order page-scroll" data-scroll-id="#demo-right"><span>заказать по скидке</span></a>
      </div>
    </section>

    <section class="plus">
      <div class="container">
        <figure>
          <div class="img"><img src="images/p1.png" class="img-fluid" alt=""></div>
          <figcaption>Натуральная кожа</figcaption>
        </figure>
        <figure>
          <div class="img"><img src="images/p2.png" class="img-fluid" alt=""></div>
          <figcaption>Гарантия качества</figcaption>
        </figure>
        <figure>
          <div class="img"><img src="images/p3.png" class="img-fluid" alt=""></div>
          <figcaption>Быстрая доставка</figcaption>
        </figure>
      </div>
    </section>
    <div class="shoes">
      <div class="container">
        <h3 class="shoes__header-title-3 header-title-3 header-title-3_white"><span>Женские кроссовки ECCO</span> – главная модель этого лета! Стиль и комфорт от мирового производителя элитной обуви</h3>
        <div class="shoes__middle">
          <div class="shoes__center">
            <div class="img"><img src="images/shoes.png" class="img-fluid" alt=""></div>
            <figure>
              <div><img src="images/s1.png" class="img-fluid"></div>
              <figcaption>Кроссовки из <span>натуральной телячьей кожи</span> идеально облегают ноги благодаря особенности принимать форму стопы</figcaption>
            </figure>
            <figure>
              <div><img src="images/s2.png" class="img-fluid"></div>
              <figcaption>Текстильная подкладка <span>абсорбирует влагу</span> и создает максимальные условия для внутреннего комфорта</figcaption>
            </figure>
            <figure>
              <div><img src="images/s3.png" class="img-fluid"></div>
              <figcaption>Швы выполнены ровно и аккуратно, упругий носок обладает хорошими <span>эластичными свойствами</span></figcaption>
            </figure>
            <figure>
              <div><img src="images/s4.png" class="img-fluid"></div>
              <figcaption>Благодаря своей прочности и <span>стойкости к изнашиванию</span> кожаная обувь отличается отменной долговечностью</figcaption>
            </figure>
            <figure>
              <div><img src="images/s5.png" class="img-fluid"></div>
              <figcaption>Модельеры ECCO особое внимание уделяют дизайну. Обувь <span>повседневного стиля</span> прекрасно сочетается с любым образом</figcaption>
            </figure>
            <figure>
              <div><img src="images/s6.png" class="img-fluid"></div>
              <figcaption>Легкая и прочная подошва из полиуретана обладает превосходной <span>гибкостью и амортизацией</span>, уменьшая нагрузку на мышцы и суставы</figcaption>
            </figure>
          </div>
        </div>
      </div>
    </div>

    <div class="banner">
      <div class="container">
        <div class="flex">
          <div class="banner-img">
            <img src="images/k1.png" alt="">
          </div>
          <div class="banner-text">
            <h6>Део-спрей для обуви Ессо</h6>
            <p>Део-спрей  освежит вашу обувь и уничтожает все вредоносные бактерии подарив ей легкий аромат. </p>
            <div class="b-price flex">
              <div class="b-old">1900 руб</div>
              <div class="b-new"><?php echo $price['real_price']; ?></div>
            </div>
            <div class="btn-wrap">
              <a href="#sprey">Заказать</a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="about">
      <div class="about-wrap">
        <div class="container">
          <div class="info">
            <div class="img"><img src="images/about-one2.jpg" class="img-fluid" alt=""></div>
            <div class="info-wrap">
              <div class="header-title-3">Акция <span>только 3 дня !!!</span></div>
              <!-- <div class="logo"><img src="http://discount.ecco-x.ru/files/f/fb-2/discount.ecco-x.ru/files/img/logo_black.png" class="img-fluid" alt=""></div> -->
              <p>При покупке женской пары действует<br> дополнительная <span>скидка</span><br> на детскую обувь!</p>  
              <p>Детские кеды всего за <?php echo $price['real_price']; ?></p>
              <div class="price price_pink">
                <div class="old-price">5450 руб</div>
                <div class="current-price"><?php echo $price['real_price']; ?></div>
              </div>
              <a href="#" class="about__btn btn btn_order page-scroll" data-scroll-id="#demo-right"><span>оформить заказ</span></a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <section class="video">
      <div class="container">
        <iframe width="560" height="315" src="https://www.youtube.com/embed/B45PzNrLfiE?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
      </div>
    </section>

    <div class="advantage">
      <div class="container">
        <h3 class="advantage__header-title-3 header-title-3">Почему нужно выбирать нас:</h3>
        <div class="items">
          <figure>
            <div class="img"><img src="images/a1.png" class="img-fluid" alt=""></div>
            <figcaption>Стильная и комфортная обувь по лучшим ценам</figcaption>
          </figure>
          <figure>
            <div class="img"><img src="images/a2.png" class="img-fluid" alt=""></div>
            <figcaption>Только натуральные материалы</figcaption>
          </figure>
          <figure>
            <div class="img"><img src="images/a3.png" class="img-fluid" alt=""></div>
            <figcaption>Бренд с мировым именем</figcaption>
          </figure>
        </div>
      </div>
    </div>

    <section class="spec">
      <div class="spec-wrap">
        <div class="container">
          <div class="info">
            <div class="info-wrap">
              <h3 class="spec__header-title-3 header-title-3">Характеристики</h3>
              <ul>
                <li><span>Сезон:</span> <span>Весна-Лето 2020</span></li> 
                <li><span>Вид товара:</span> <span>Кроссовки</span></li>
                <li><span>Каблук:</span> <span>Ниже 30 мм</span></li> 
                <li><span>Верх:</span> <span>Натуральная телячья кожа</span></li>
                <li><span>Материал подкладки:</span> <span>Натуральная замша,текстиль</span></li>
                <li><span>Материал подошвы:</span> <span>Полиуретан</span></li>
                <li><span>Страна:</span> <span>Словакия</span></li>
                <li><span>Стиль:</span> <span>Ежедневный (casual)</span></li>
                <li><span>Бренд:</span> <span>ECCO</span></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="demo demo-women">
      <div class="left">
        <h3 class="header-title-3">Mobile text</h3>
        <div class="slider">
          <div class="big owl-carousel">
            <div class="img">
              <a href="images/01_b.jpg" data-fancybox><img src="images/01_b.jpg" class="img-fluid" alt="" data-hash="b1"></a>
            </div>
            <div class="img">
              <a href="images/02_b.jpg" data-fancybox><img src="images/02_b.jpg" class="img-fluid" alt="" data-hash="b2"></a>
            </div>
            <div class="img">
              <a href="images/03_b.jpg" data-fancybox><img src="images/02_b.jpg" class="img-fluid" alt="" data-hash="b3"></a>
            </div>
            <div class="img">
              <a href="images/04_b.jpg" data-fancybox><img src="images/04_b.jpg" class="img-fluid" alt="" data-hash="b4"></a>
            </div>
            <div class="img">
              <a href="images/05_b.jpg" data-fancybox><img src="images/05_b.jpg" class="img-fluid" alt="" data-hash="b5"></a>
            </div>
            <div class="img">
              <a href="images/06_b.jpg" data-fancybox><img src="images/06_b.jpg" class="img-fluid" alt="" data-hash="b6"></a>
            </div>
            <div class="img">
              <a href="images/01_r.jpg" data-fancybox><img src="images/01_r.jpg" class="img-fluid" alt="" data-hash="r1"></a>
            </div>
            <div class="img">
              <a href="images/02_r.jpg" data-fancybox><img src="images/02_r.jpg" class="img-fluid" alt="" data-hash="r2"></a>
            </div>
            <div class="img">
              <a href="images/03_r.jpg" data-fancybox><img src="images/03_r.jpg" class="img-fluid" alt="" data-hash="r3"></a>
            </div>
            <div class="img">
              <a href="images/04_r.jpg" data-fancybox><img src="images/04_r.jpg" class="img-fluid" alt="" data-hash="r4"></a>
            </div>
            <div class="img">
              <a href="images/05_r.jpg" data-fancybox><img src="images/05_r.jpg" class="img-fluid" alt="" data-hash="r5"></a>
            </div>
            <div class="img">
              <a href="images/06_r.jpg" data-fancybox><img src="images/06_r.jpg" class="img-fluid" alt="" data-hash="r6"></a>
            </div>
          </div>
          <div class="small">
            <div class="b">
              <a href="#b1" class="img img1"><img src="images/01_b.jpg" class="img-fluid" alt=""></a>
              <a href="#b2" class="img img2"><img src="images/02_b.jpg" class="img-fluid" alt=""></a>
              <a href="#b3" class="img img3"><img src="images/03_b.jpg" class="img-fluid" alt=""></a>
              <a href="#b4" class="img img4"><img src="images/04_b.jpg" class="img-fluid" alt=""></a>
              <a href="#b5" class="img img5"><img src="images/05_b.jpg" class="img-fluid" alt=""></a>
              <a href="#b6" class="img img6"><img src="images/06_b.jpg" class="img-fluid" alt=""></a>
            </div>
            <div class="r">
              <a href="#r1" class="img img7"><img src="images/01_r.jpg" class="img-fluid" alt=""></a>
              <a href="#r2" class="img img8"><img src="images/02_r.jpg" class="img-fluid" alt=""></a>
              <a href="#r3" class="img img9"><img src="images/03_r.jpg" class="img-fluid" alt=""></a>
              <a href="#r4" class="img img10"><img src="images/04_r.jpg" class="img-fluid" alt=""></a>
              <a href="#r5" class="img img11"><img src="images/05_r.jpg" class="img-fluid" alt=""></a>
              <a href="#r6" class="img img12"><img src="images/06_r.jpg" class="img-fluid" alt=""></a>
            </div>
          </div>
        </div>
      </div>
      <div class="right" id="demo-right">
        <div class="form">
          <h3 class="header-title-3">Женские кроcсовки ECCO</h3>
          <div class="price price_pink">
            <div class="old-price">7990 руб</div>
            <div class="current-price">3490 руб</div>
          </div>
          <div class="timer-box">
            <div class="timer-box__title">До конца акции осталось:</div>
            <div class="timer"></div>
          </div>
          
		<form action="./_success_/" method="post"  class="order-form form clearfix lv2-form lv2-form2 lv2-form-validation-by-alert" id="lv-formLanding2">    
            
            
<input type='hidden' name='referer' value="<?php echo isset($_GET['referer']) ? $_GET['referer'] : $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] ;?>">
<input type="hidden" name="subid1"  value="<?php echo isset($_GET['subid1']) ? $_GET['subid1'] : '' ;?>" />
<input type="hidden" name="subid2"  value="<?php echo isset($_GET['subid2']) ? $_GET['subid2'] : '' ;?>" />
<input type="hidden" name="subid3"  value="<?php echo isset($_GET['subid3']) ? $_GET['subid3'] : '' ;?>" />
<input type="hidden" name="subid4"  value="<?php echo isset($_GET['subid4']) ? $_GET['subid4'] : '' ;?>" />  
<input type="hidden" name="subid5"  value="<?php echo isset($_GET['subid5']) ? $_GET['subid5'] : '' ;?>" />

   <div class="form-group">
              <label class="control-label">Выберите цвет:</label>
              <ul class="select-emul select-color">
                <li class="select-menu">
                  <div class="active">
                    <span class="white"></span> Белый
                  </div>
                  <ul class="items">
                    <li onclick="document.getElementById('comment1').value = 'Цвет: Белый';"><span class="white"></span> Белый</li>
                    <li onclick="document.getElementById('comment1').value = 'Цвет: Розовый';"><span class="pink"></span> Розовый</li>
                  </ul>
                </li>
              </ul>
            </div>
            <div class="form-group">
              <label class="control-label">Размер:</label>
              <ul class="select-emul sizess">
                <li class="select-menu"><div class="active">Выберите размер</div>
                  <ul class="items">
                    <li onclick="document.getElementById('razm1').value = 'Размер: 36';">36(23.5 см)</li>
                    <li onclick="document.getElementById('razm1').value = 'Размер: 37';">37(24 см)</li>
                    <li onclick="document.getElementById('razm1').value = 'Размер: 38';">38(24.5 см)</li>
                    <li onclick="document.getElementById('razm1').value = 'Размер: 39';">39(25 см)</li>
                    <li onclick="document.getElementById('razm1').value = 'Размер: 40';">40(25.5 см)</li>
                  </ul>
                </li>
              </ul>
            </div>
   
    <div class="row text-left form-group">
            <div class="medium-8 large-6 medium-centered column">
               <div class="lead-form__input field control-label form-group"> 
        
        <input id="name_first" type="text" name="<?php echo $name; ?>" class="input form-control form_field_text_input form-input txt-m" placeholder="Введите Ваше имя" id="lv-formLanding2-fio" required />
        </div>
        <div class="lead-form__input field">          

          <input type="text" id="phone" name="phone"  class="field form-control input textField form_field_text_input form_phone form-input txt-m" placeholder="Введите Ваш телефон" id="lv-formLanding2-phone" required />
            <div name="phone"  style="color: red" inputID="lv-formLanding2-phone" id="lv-formLanding2-phone_em_" class=" lv2-form-error" >
            </div>

        </div>
 

            </div>
        </div>
   <button type="submit" class="dynamic-form-button-3 lead-form__button button-m">Отправить заявку1</button>
                    

</form> 

         </div>
       </div>
     </section>

     <!-- дезик -->
     <section class="demo dezik demo_kid" id="sprey">

      <div class="left">
        <h3 class="header-title-3">Mobile text</h3>
        <div class="slider">
          <div class="big owl-carousel">
            <div class="img">
              <a href="images/1.jpg" data-fancybox><img src="images/1.jpg" class="img-fluid" alt="" data-hash="b1-7556"></a>
            </div>
            <div class="img">
              <a href="images/2.jpg" data-fancybox><img src="images/2.jpg" class="img-fluid" alt="" data-hash="b2-7556"></a>
            </div>
          </div>
          <div class="small">
            <div class="b">
              <a href="#b1-7556" class="img img1"><img src="images/1.jpg" class="img-fluid" alt=""></a>
              <a href="#b2-7556" class="img img2"><img src="images/2.jpg" class="img-fluid" alt=""></a>
            </div>
          </div>
          <div class="descr">
            Део-спрей  освежит вашу обувь, подарив ей легкий, почти неощутимый аромат лаванды. В состав входит: липоаминокислоты, эфирные масла лавандина, натуральная минеральная соль (Potassium Alum). Применять на внутреннюю поверхность обуви. НЕ оставляет следов на любых материалах обуви. 
          </div>
        </div>
      </div>
      <div class="right" id="demo-right">
        <div class="form">
          <h3 class="header-title-3" data-iid="um_ecco_woman_bouileine_ecco_kids">Bouileine Shoe Spray</h3>
          <div class="price price_pink">
            <div class="old-price">3950 руб</div>
            <div class="current-price"><?php echo $price['real_price']; ?></div>
          </div>
          <div class="timer-box">
            <div class="timer-box__title">До конца акции осталось:</div>
            <div class="timer"></div>
          </div>
          <ul class="list">
            <li><div>Время применения:</div> <div>универсальное</div></li>
            <li><div>Тип обуви:</div> <div>все типы</div></li>
            <li><div>Пол:</div> <div>унисекс</div></li>
            <li><div>Класс:</div> <div>люкс</div></li>
            <li><div>Страна-производитель:</div> <div>Монако</div></li>
          </ul>
      
		
<form action="./_success_/" method="post"  class="order-form form clearfix lv2-form lv2-form2 lv2-form-validation-by-alert" id="lv-formLanding2">    
             
<input type='hidden' name='referer' value="<?php echo isset($_GET['referer']) ? $_GET['referer'] : $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] ;?>">
<input type="hidden" name="subid1"  value="<?php echo isset($_GET['subid1']) ? $_GET['subid1'] : '' ;?>" />
<input type="hidden" name="subid2"  value="<?php echo isset($_GET['subid2']) ? $_GET['subid2'] : '' ;?>" />
<input type="hidden" name="subid3"  value="<?php echo isset($_GET['subid3']) ? $_GET['subid3'] : '' ;?>" />
<input type="hidden" name="subid4"  value="<?php echo isset($_GET['subid4']) ? $_GET['subid4'] : '' ;?>" />  
<input type="hidden" name="subid5"  value="<?php echo isset($_GET['subid5']) ? $_GET['subid5'] : '' ;?>" />
   
    <div class="row text-left form-group">
            <div class="medium-8 large-6 medium-centered column">
               <div class="lead-form__input field control-label form-group"> 
        
        <input id="name_first" type="text" name="<?php echo $name; ?>" class="input form-control form_field_text_input form-input txt-m" placeholder="Введите Ваше имя" id="lv-formLanding2-fio" required />
        </div>
        <div class="lead-form__input field">          

          <input type="text" id="phone" name="phone"  class="field form-control input textField form_field_text_input form_phone form-input txt-m" placeholder="Введите Ваш телефон" id="lv-formLanding2-phone" required />
            <div name="phone"  style="color: red" inputID="lv-formLanding2-phone" id="lv-formLanding2-phone_em_" class=" lv2-form-error" >
            </div>

        </div>
 

            </div>
        </div>
   <button type="submit" class="dynamic-form-button-3 lead-form__button button-m">Отправить заявку</button>
                    

</form>

         </div>
       </div>
     </section>


     <!-- ортопеические -->
     <h3 class="ort-title">Только сегодня детская ортопедическая обувь по выгодным ценам!</h3>
     <section class="demo demo7556 demo_reverse demo_kid">

      <div class="left">
        <h3 class="header-title-3">Mobile text</h3>
        <div class="slider">
          <div class="big owl-carousel">
            <div class="img">
              <a href="images/ort/1.jpg" data-fancybox><img src="images/ort/1.jpg" class="img-fluid" alt="" data-hash="b1-7556"></a>
            </div>
            <div class="img">
              <a href="images/ort/2.jpg" data-fancybox><img src="images/ort/2.jpg" class="img-fluid" alt="" data-hash="b2-7556"></a>
            </div>
            <div class="img">
              <a href="images/ort/3.jpg" data-fancybox><img src="images/ort/3.jpg" class="img-fluid" alt="" data-hash="b3-7556"></a>
            </div>
            <div class="img">
              <a href="images/ort/4.jpg" data-fancybox><img src="images/ort/4.jpg" class="img-fluid" alt="" data-hash="b4-7556"></a>
            </div>
            <div class="img">
              <a href="images/ort/5.jpg" data-fancybox><img src="images/ort/5.jpg" class="img-fluid" alt="" data-hash="b4-7556"></a>
            </div>
            <div class="img">
              <a href="images/ort/6.jpg" data-fancybox><img src="images/ort/6.jpg" class="img-fluid" alt="" data-hash="b4-7556"></a>
            </div>
          </div>
          <div class="small">
            <div class="b">
              <a href="#b1-7556" class="img img1"><img src="images/ort/1.jpg" class="img-fluid" alt=""></a>
              <a href="#b2-7556" class="img img2"><img src="images/ort/2.jpg" class="img-fluid" alt=""></a>
              <a href="#b3-7556" class="img img3"><img src="images/ort/3.jpg" class="img-fluid" alt=""></a>
              <a href="#b4-7556" class="img img4"><img src="images/ort/4.jpg" class="img-fluid" alt=""></a>
              <a href="#b4-7556" class="img img4"><img src="images/ort/5.jpg" class="img-fluid" alt=""></a>
              <a href="#b4-7556" class="img img4"><img src="images/ort/6.jpg" class="img-fluid" alt=""></a>
            </div>
          </div>
        </div>
      </div>
      <div class="right" id="demo-right">
        <div class="form">
          <h3 class="header-title-3" data-iid="um_ecco_woman_7554">Кеды CAT-ACTIV (7554)</h3>
          <div class="price price_pink">
            <div class="old-price">5450 руб</div>
            <div class="current-price"><?php echo $price['real_price']; ?></div>
          </div>
          <div class="timer-box">
            <div class="timer-box__title">До конца акции осталось:</div>
            <div class="timer"></div>
          </div>
          <ul class="list">
            <li><div>Модель:</div> <div>Lake Up Sneaker</div></li>
            <li><div>Вид товара:</div> <div>Кеды</div></li>
            <li><div>Верх:</div> <div>натуральная замша</div></li>
            <li><div>Подкладка:</div> <div>натуральная кожа</div></li>
            <li><div>Подошва:</div> <div>TPR</div></li>
            <li><div>Пол:</div> <div>Для мальчиков</div></li>
            <li><div>Страна:</div> <div>Чехия</div></li>
            <li><div>Стиль:</div> <div>Повседневный</div></li>
          </ul>
         <form action="./_success_/" method="post"  class="order-form form clearfix lv2-form lv2-form2 lv2-form-validation-by-alert" id="lv-formLanding2">    
             
<input type='hidden' name='referer' value="<?php echo isset($_GET['referer']) ? $_GET['referer'] : $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] ;?>">
<input type="hidden" name="subid1"  value="<?php echo isset($_GET['subid1']) ? $_GET['subid1'] : '' ;?>" />
<input type="hidden" name="subid2"  value="<?php echo isset($_GET['subid2']) ? $_GET['subid2'] : '' ;?>" />
<input type="hidden" name="subid3"  value="<?php echo isset($_GET['subid3']) ? $_GET['subid3'] : '' ;?>" />
<input type="hidden" name="subid4"  value="<?php echo isset($_GET['subid4']) ? $_GET['subid4'] : '' ;?>" />  
<input type="hidden" name="subid5"  value="<?php echo isset($_GET['subid5']) ? $_GET['subid5'] : '' ;?>" />
   
    <div class="row text-left form-group">
            <div class="medium-8 large-6 medium-centered column">
               <div class="lead-form__input field control-label form-group"> 
        
        <input id="name_first" type="text" name="<?php echo $name; ?>" class="input form-control form_field_text_input form-input txt-m" placeholder="Введите Ваше имя" id="lv-formLanding2-fio" required />
        </div>
        <div class="lead-form__input field">          

          <input type="text" id="phone" name="phone"  class="field form-control input textField form_field_text_input form_phone form-input txt-m" placeholder="Введите Ваш телефон" id="lv-formLanding2-phone" required />
            <div name="phone"  style="color: red" inputID="lv-formLanding2-phone" id="lv-formLanding2-phone_em_" class=" lv2-form-error" >
            </div>

        </div>
 

            </div>
        </div>
   <button type="submit" class="dynamic-form-button-3 lead-form__button button-m">Отправить заявку</button>
                    

</form>
         </div>
       </div>
     </section>

     <section class="demo demo7556 demo_reverse demo_kid">
      <div class="left">
        <h3 class="header-title-3">Mobile text</h3>
        <div class="slider">
          <div class="big owl-carousel">
            <div class="img">
              <a href="images/7556/1.jpg" data-fancybox><img src="images/7556/1.jpg" class="img-fluid" alt="" data-hash="b1-7556"></a>
            </div>
            <div class="img">
              <a href="images/7556/2.jpg" data-fancybox><img src="images/7556/2.jpg" class="img-fluid" alt="" data-hash="b2-7556"></a>
            </div>
            <div class="img">
              <a href="images/7556/3.jpg" data-fancybox><img src="images/7556/3.jpg" class="img-fluid" alt="" data-hash="b3-7556"></a>
            </div>
            <div class="img">
              <a href="images/7556/4.jpg" data-fancybox><img src="images/7556/4.jpg" class="img-fluid" alt="" data-hash="b4-7556"></a>
            </div>
          </div>
          <div class="small">
            <div class="b">
              <a href="#b1-7556" class="img img1"><img src="images/7556/1.jpg" class="img-fluid" alt=""></a>
              <a href="#b2-7556" class="img img2"><img src="images/7556/2.jpg" class="img-fluid" alt=""></a>
              <a href="#b3-7556" class="img img3"><img src="images/7556/3.jpg" class="img-fluid" alt=""></a>
              <a href="#b4-7556" class="img img4"><img src="images/7556/4.jpg" class="img-fluid" alt=""></a>
            </div>
          </div>
        </div>
      </div>
      <div class="right" id="demo-right">
        <div class="form">
          <h3 class="header-title-3" data-iid="um_ecco_woman_7556">Детские кеды (7556)</h3>
          <div class="price price_pink">
            <div class="old-price">5450 руб</div>
            <div class="current-price"><?php echo $price['real_price']; ?></div>
          </div>
          <div class="timer-box">
            <div class="timer-box__title">До конца акции осталось:</div>
            <div class="timer"></div>
          </div>
          <ul class="list">
            <li><div>Сезон:</div> <div>Весна-лето 2020</div></li>
            <li><div>Верх:</div> <div>Натуральная замша</div></li>
            <li><div>Материал подкладки:</div> <div>Натуральная кожа</div></li>
            <li><div>Материал подошвы:</div> <div>TPR</div></li>
            <li><div>Стиль:</div> <div>Ежедневный (casual)</div></li>
            <li><div>Пол:</div> <div>Унисекс</div></li>
          </ul>
          <form action="./_success_/" method="post"  class="order-form form clearfix lv2-form lv2-form2 lv2-form-validation-by-alert" id="lv-formLanding2">    
             
<input type='hidden' name='referer' value="<?php echo isset($_GET['referer']) ? $_GET['referer'] : $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] ;?>">
<input type="hidden" name="subid1"  value="<?php echo isset($_GET['subid1']) ? $_GET['subid1'] : '' ;?>" />
<input type="hidden" name="subid2"  value="<?php echo isset($_GET['subid2']) ? $_GET['subid2'] : '' ;?>" />
<input type="hidden" name="subid3"  value="<?php echo isset($_GET['subid3']) ? $_GET['subid3'] : '' ;?>" />
<input type="hidden" name="subid4"  value="<?php echo isset($_GET['subid4']) ? $_GET['subid4'] : '' ;?>" />  
<input type="hidden" name="subid5"  value="<?php echo isset($_GET['subid5']) ? $_GET['subid5'] : '' ;?>" />
   
    <div class="row text-left form-group">
            <div class="medium-8 large-6 medium-centered column">
               <div class="lead-form__input field control-label form-group"> 
        
        <input id="name_first" type="text" name="<?php echo $name; ?>" class="input form-control form_field_text_input form-input txt-m" placeholder="Введите Ваше имя" id="lv-formLanding2-fio" required />
        </div>
        <div class="lead-form__input field">          

          <input type="text" id="phone" name="phone"  class="field form-control input textField form_field_text_input form_phone form-input txt-m" placeholder="Введите Ваш телефон" id="lv-formLanding2-phone" required />
            <div name="phone"  style="color: red" inputID="lv-formLanding2-phone" id="lv-formLanding2-phone_em_" class=" lv2-form-error" >
            </div>

        </div>
 

            </div>
        </div>
   <button type="submit" class="dynamic-form-button-3 lead-form__button button-m">Отправить заявку</button>
                    

</form>
        </div>
      </div>
    </section>

    <section class="demo demo7555 demo_kid">
      <div class="left">
        <h3 class="header-title-3">Mobile text</h3>
        <div class="slider">
          <div class="big owl-carousel">
            <div class="img">
              <a href="images/7555/1.jpg" data-fancybox><img src="images/7555/1.jpg" class="img-fluid" alt="" data-hash="b1-7555"></a>
            </div>
            <div class="img">
              <a href="images/7555/2.jpg" data-fancybox><img src="images/7555/2.jpg" class="img-fluid" alt="" data-hash="b2-7555"></a>
            </div>
            <div class="img">
              <a href="images/7555/3.jpg" data-fancybox><img src="images/7555/3.jpg" class="img-fluid" alt="" data-hash="b3-7555"></a>
            </div>
            <div class="img">
              <a href="images/7555/4.jpg" data-fancybox><img src="images/7555/4.jpg" class="img-fluid" alt="" data-hash="b4-7555"></a>
            </div>
          </div>
          <div class="small">
            <div class="b">
              <a href="#b1-7555" class="img img1"><img src="images/7555/1.jpg" class="img-fluid" alt=""></a>
              <a href="#b2-7555" class="img img2"><img src="images/7555/2.jpg" class="img-fluid" alt=""></a>
              <a href="#b3-7555" class="img img3"><img src="images/7555/3.jpg" class="img-fluid" alt=""></a>
              <a href="#b4-7555" class="img img4"><img src="images/7555/4.jpg" class="img-fluid" alt=""></a>
            </div>
          </div>
        </div>
      </div>
      <div class="right" id="demo-right">
        <div class="form">
          <h3 class="header-title-3" data-iid="um_ecco_woman_7555">Детские кеды (7555)</h3>
          <div class="price price_pink">
            <div class="old-price">5450 руб</div>
            <div class="current-price"><?php echo $price['real_price']; ?></div>
          </div>
          <div class="timer-box">
            <div class="timer-box__title">До конца акции осталось:</div>
            <div class="timer"></div>
          </div>
          <ul class="list">
            <li><div>Сезон:</div> <div>Весна-лето 2020</div></li>
            <li><div>Верх:</div> <div>Натуральная замша</div></li>
            <li><div>Материал подкладки:</div> <div>Натуральная кожа</div></li>
            <li><div>Материал подошвы:</div> <div>TPR</div></li>
            <li><div>Стиль:</div> <div>Ежедневный (casual)</div></li>
            <li><div>Пол:</div> <div>Унисекс</div></li>
          </ul>
          <form action="./_success_/" method="post"  class="order-form form clearfix lv2-form lv2-form2 lv2-form-validation-by-alert" id="lv-formLanding2">    
             
<input type='hidden' name='referer' value="<?php echo isset($_GET['referer']) ? $_GET['referer'] : $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] ;?>">
<input type="hidden" name="subid1"  value="<?php echo isset($_GET['subid1']) ? $_GET['subid1'] : '' ;?>" />
<input type="hidden" name="subid2"  value="<?php echo isset($_GET['subid2']) ? $_GET['subid2'] : '' ;?>" />
<input type="hidden" name="subid3"  value="<?php echo isset($_GET['subid3']) ? $_GET['subid3'] : '' ;?>" />
<input type="hidden" name="subid4"  value="<?php echo isset($_GET['subid4']) ? $_GET['subid4'] : '' ;?>" />  
<input type="hidden" name="subid5"  value="<?php echo isset($_GET['subid5']) ? $_GET['subid5'] : '' ;?>" />
   
    <div class="row text-left form-group">
            <div class="medium-8 large-6 medium-centered column">
               <div class="lead-form__input field control-label form-group"> 
        
        <input id="name_first" type="text" name="<?php echo $name; ?>" class="input form-control form_field_text_input form-input txt-m" placeholder="Введите Ваше имя" id="lv-formLanding2-fio" required />
        </div>
        <div class="lead-form__input field">          

          <input type="text" id="phone" name="phone"  class="field form-control input textField form_field_text_input form_phone form-input txt-m" placeholder="Введите Ваш телефон" id="lv-formLanding2-phone" required />
            <div name="phone"  style="color: red" inputID="lv-formLanding2-phone" id="lv-formLanding2-phone_em_" class=" lv2-form-error" >
            </div>

        </div>
 

            </div>
        </div>
   <button type="submit" class="dynamic-form-button-3 lead-form__button button-m">Отправить заявку</button>
 
</form>
         </div>
       </div>
     </section>

     <section class="demo demo7557 demo_reverse demo_kid">
      <div class="left">
        <h3 class="header-title-3">Mobile text</h3>
        <div class="slider">
          <div class="big owl-carousel">
            <div class="img">
              <a href="images/7557/1.jpg" data-fancybox><img src="images/7557/1.jpg" class="img-fluid" alt="" data-hash="b1-7557"></a>
            </div>
            <div class="img">
              <a href="images/7557/2.jpg" data-fancybox><img src="images/7557/2.jpg" class="img-fluid" alt="" data-hash="b2-7557"></a>
            </div>
            <div class="img">
              <a href="images/7557/3.jpg" data-fancybox><img src="images/7557/3.jpg" class="img-fluid" alt="" data-hash="b3-7557"></a>
            </div>
            <div class="img">
              <a href="images/7557/4.jpg" data-fancybox><img src="images/7557/4.jpg" class="img-fluid" alt="" data-hash="b4-7557"></a>
            </div>
          </div>
          <div class="small">
            <div class="b">
              <a href="#b1-7557" class="img img1"><img src="images/7557/1.jpg" class="img-fluid" alt=""></a>
              <a href="#b2-7557" class="img img2"><img src="images/7557/2.jpg" class="img-fluid" alt=""></a>
              <a href="#b3-7557" class="img img3"><img src="images/7557/3.jpg" class="img-fluid" alt=""></a>
              <a href="#b4-7557" class="img img4"><img src="images/7557/4.jpg" class="img-fluid" alt=""></a>
            </div>
          </div>
        </div>
      </div>
      <div class="right" id="demo-right">
        <div class="form">
          <h3 class="header-title-3" data-iid="um_ecco_woman_7557">Детские кеды (7557)</h3>
          <div class="price price_pink">
            <div class="old-price">5450 руб</div>
            <div class="current-price"><?php echo $price['real_price']; ?></div>
          </div>
          <div class="timer-box">
            <div class="timer-box__title">До конца акции осталось:</div>
            <div class="timer"></div>
          </div>
          <ul class="list">
            <li><div>Сезон:</div> <div>Весна-лето 2020</div></li>
            <li><div>Верх:</div> <div>Натуральная замша</div></li>
            <li><div>Материал подкладки:</div> <div>Натуральная кожа</div></li>
            <li><div>Материал подошвы:</div> <div>TPR</div></li>
            <li><div>Стиль:</div> <div>Ежедневный (casual)</div></li>
            <li><div>Пол:</div> <div>Унисекс</div></li>
          </ul>
          <form action="./_success_/" method="post"  class="order-form form clearfix lv2-form lv2-form2 lv2-form-validation-by-alert" id="lv-formLanding2">    
             
<input type='hidden' name='referer' value="<?php echo isset($_GET['referer']) ? $_GET['referer'] : $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] ;?>">
<input type="hidden" name="subid1"  value="<?php echo isset($_GET['subid1']) ? $_GET['subid1'] : '' ;?>" />
<input type="hidden" name="subid2"  value="<?php echo isset($_GET['subid2']) ? $_GET['subid2'] : '' ;?>" />
<input type="hidden" name="subid3"  value="<?php echo isset($_GET['subid3']) ? $_GET['subid3'] : '' ;?>" />
<input type="hidden" name="subid4"  value="<?php echo isset($_GET['subid4']) ? $_GET['subid4'] : '' ;?>" />  
<input type="hidden" name="subid5"  value="<?php echo isset($_GET['subid5']) ? $_GET['subid5'] : '' ;?>" />
   
    <div class="row text-left form-group">
            <div class="medium-8 large-6 medium-centered column">
               <div class="lead-form__input field control-label form-group"> 
        
        <input id="name_first" type="text" name="<?php echo $name; ?>" class="input form-control form_field_text_input form-input txt-m" placeholder="Введите Ваше имя" id="lv-formLanding2-fio" required />
        </div>
        <div class="lead-form__input field">          

          <input type="text" id="phone" name="phone"  class="field form-control input textField form_field_text_input form_phone form-input txt-m" placeholder="Введите Ваш телефон" id="lv-formLanding2-phone" required />
            <div name="phone"  style="color: red" inputID="lv-formLanding2-phone" id="lv-formLanding2-phone_em_" class=" lv2-form-error" >
            </div>

        </div>
 

            </div>
        </div>
   <button type="submit" class="dynamic-form-button-3 lead-form__button button-m">Отправить заявку</button>
                    

</form>
         </div>
       </div>
     </section>

     <section class="gallery">
      <div class="container">
        <h3 class="gallery__header-title-3 header-title-3">Галерея</h3>
        <div class="imgs slider-nav">
          <div class="item">
            <a href="images/gallery/1.jpg" data-fancybox><div class="img img-1"><img src="images/gallery/1.jpg" class="img-fluid" alt=""></div></a>
          </div>
          <div class="item">
            <a href="images/gallery/2.jpg" data-fancybox><div class="img img-2"><img src="images/gallery/2.jpg" class="img-fluid" alt=""></div></a>
            <a href="images/gallery/3.jpg" data-fancybox><div class="img img-3"><img src="images/gallery/3.jpg" class="img-fluid" alt=""></div></a>
          </div>
          <div class="item">
            <a href="images/gallery/4.jpg" data-fancybox><div class="img img-4"><img src="images/gallery/4.jpg" class="img-fluid" alt=""></div></a>
            <a href="images/gallery/6.jpg" data-fancybox><div class="img img-6"><img src="images/gallery/6.jpg" class="img-fluid" alt=""></div></a>
          </div>
          <div class="item">
            <a href="images/gallery/5.jpg" data-fancybox><div class="img img-5"><img src="images/gallery/5.jpg" class="img-fluid" alt=""></div></a>
          </div>
        </div>
      </div>
    </section>

    <section class="delivery">
      <div class="container">
        <h3 class="header-title-3">Оплата и доставка</h3>
        <div class="items">
          <figure>
            <div class="img"><img src="images/di1.png" class="img-fluid"></div>
            <figcaption>Вы оставляете<br>
            заявку на сайте</figcaption>
          </figure>
          <figure>
            <div class="img"><img src="images/di2.png" class="img-fluid"></div>
            <figcaption>Мы связываемся с Вами
            для подтверждения заказа</figcaption>
          </figure>
          <figure>
            <div class="img"><img src="images/di3.png" class="img-fluid"></div>
            <figcaption>Отправляем ваш заказ
            в кротчайшие сроки</figcaption>
          </figure>
          <figure>
            <div class="img"><img src="images/di4.png" class="img-fluid"></div>
            <figcaption>Никаких предоплат! 
            Оплата осуществляется по факту получения заказа</figcaption>
          </figure>
        </div>
      </div>
    </section>

    <section class="reviews">
      <div class="container">
        <h3 class="reviews__header-title-3 header-title-3">Отзывы наших покупателей</h3>
        <div class="slider">
          <div class="slider-wrap owl-carousel slider-nav">
            <div class="slide">
              <div class="slide__img"><img src="images/comment1.jpg" class="img-fluid" alt=""></div>
              <div class="slide__author">Екатерина</div>
              <p class="slide__comment">Вчера забрала обувь и очень довольна качеством вашей продукции. Купить кожаные стильные кроссовки по такой цене – настоящая удача! У англичан имеется поговорка: "Мы не настолько богатые, чтобы покупать дешевые вещи". Абсолютно в точку, именно по этой причине я выбираю только бренд Экко, потому что компания не одно десятилетие делает обувь для людей, которые вынуждены большую часть своего времени проводить на ногах.</p>
            </div>
            <div class="slide">
              <div class="slide__img"><img src="images/comment2.jpg" class="img-fluid" alt=""></div>
              <div class="slide__author">Анна</div>
              <p class="slide__comment">У меня до этого были кроссовки экко, которые мне прослужили 4 года.  И муж любит обуваться в вашем фирменном магазине, но в последнее время цены так кусаются, что ищем более удобные варианты в интернете. Скидка просто космическая, очень обрадовалась когда необходимый размер оказался в наличии. По красоте и удобству смело поставлю самый высокий балл, а по износостойкости смогу судить лишь со временем.</p>
            </div>
            <div class="slide">
              <div class="slide__img"><img src="images/comment3.jpg" class="img-fluid" alt=""></div>
              <div class="slide__author">Юлия</div>
              <p class="slide__comment">Добрый день! Хочу сказать, что мониторинг в интернете весьма полезное занятие. Можно найти брендовую вещь по привлекательной стоимости. Кроссовочки то что нужно для весны и летом они должны справиться с перепадом температуры. Все-таки натуральная кожа не зря считается самой лучшей, многие ее свойства просто волшебны. А обувь мне очень понравилась и доставили очень быстро, благодарю Вас!</p>
            </div>
            <div class="slide">
              <div class="slide__img"><img src="images/comment4.jpg" class="img-fluid" alt=""></div>
              <div class="slide__author">Диана</div>
              <p class="slide__comment">Все на высшем уровне, от сервиса до самой обуви. Решилась на покупку благодаря безопасному способу оплаты, сначала я увидела обувь и только потом ее оплатила. При примерке была приятно удивлена ее удобством, даже расхаживать не пришлось. Рекомендую!</p>
            </div>
            <div class="slide">
              <div class="slide__img"><img src="images/comment5.jpg" class="img-fluid" alt=""></div>
              <div class="slide__author">Александра</div>
              <p class="slide__comment">Девчонки, этот бренд просто завоевал мое сердце, как раньше я не обратила на них внимание. На пикнике, прогулках и даже на работе кроссовки от экко меня уже успели выручить. Даже ухаживать за кроссовками вполне легко – они не привередливые. Теперь буду следить за новыми моделями и акциями.</p>
            </div>
            <div class="slide">
              <div class="slide__img"><img src="images/comment6.jpg" class="img-fluid" alt=""></div>
              <div class="slide__author">Яна</div>
              <p class="slide__comment">Настолько понравилась модель белого цвета, что только что поспешила сделать еще один заказ. Ваш менеджер был очень учтив и подкован, доставили всего за 2 дня. Также весомым преимуществом является отсутствие предоплаты. Неописуемо удобная обувь, сразу понятно что сделана на совесть из хороших материалов.</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="bottom">
      <div class="container">
        <div class="logo"><img src="images/logo.png" class="img-fluid" alt=""></div>
        <div class="header__header-title-1 header-title-1">ЛУЧШЕЕ ПРЕДЛОЖЕНИЕ ЛЕТА
          <span>КОЖАНЫЕ КРОССОВКИ ECCO</span></div>
          <div class="bottom__img">
            <div class="sale"><img src="images/sale60.png" class="img-fluid" alt=""></div>
            <div class="boots"><img src="images/footer-boots.png" class="img-fluid" alt=""></div>
          </div>
          <div class="bottom-box">
            <div class="bottom__timer-box timer-box">
              <div class="timer-box__title">Успейте купить оригинальные
              ECCO кросовки по суперцене</div>
              <div class="timer"></div>
            </div>
            <div class="price">
              <div class="old-price">7990 руб</div>
              <div class="current-price"><?php echo $price['real_price']; ?></div>
            </div>
            <a href="#" class="bottom__btn btn btn_order page-scroll" data-scroll-id="#demo-right"><span>заказать по скидке</span></a>
          </div>
        </div>
        <footer class="footer" >
          <div class="container">
		
            <div style="padding-top: 10px;text-align: center;margin: 0 auto;">  ИНН:773392664023 Устюжанин Виталий Дмитриевич  <br> Все права защищены. Copyright 2020 <br> <a href="#" class="privacy-policy" data-remodal-target="privacy-policy" style="padding-top: 10px;">Политика конфиденциальности</a>
            </div>  
             
          </div>
        </footer>
      </section>





      <div class="privacy-policy" data-remodal-id="privacy-policy">
        <button data-remodal-action="close" class="remodal-close"></button>
        <div class="privacy-policy__content">
          <p>Наш интернет-магазин уважительно относится к правам клиента. Соблюдается строгая конфиденциальность при оформлении заказа. Сведения надёжно сохраняются и защищены от передачи.</p>
          <p>Согласием на обработку данных клиента исключительно с целью оказания услуг является размещение заказа на сайте.</p>          
          <p>К персональным данным относится личная информация о клиенте: домашний адрес; имя, фамилия, отчество; сведения о рождении; имущественное, семейное положение; личные контакты (телефон, электронная почта) и прочие сведения, которые перечислены в Законе «О персональных данных».</p>
          <p>Клиент вправе отказаться от обработки персональных данных. Нами в данном случае гарантируется удаление с сайта всех персональных данных в трёхдневный срок в рабочее время. Подобный отказ клиент может оформить простым электронным письмом на адрес, указанный на странице нашего сайта.</p>
        </div>
      </div>

       <script src="js/jquery-2.1.3.min.js"></script>
       <script src="js/libs.js"></script>
       <script src="js/common.js"></script>

       <script  src="js/cookie.js"  type="text/javascript"></script>
       <script  src="js/device.js"  type="text/javascript"></script>
       <script  src="js/formsender.js"  type="text/javascript"></script>
       <script  src="js/getfiles.js"  type="text/javascript"></script>

     <script type="text/javascript">
/*<![CDATA[*/
lvjq1(function($) {
lvjq1("#lv-formLanding1-phone").mask("+7(999)999-99-99",{'placeholder':'*'});
lvjq1('#lv-formLanding1').yiiactiveform({'validateOnSubmit':true,'afterValidate':function(form, data, hasError){return window.leadvertex.form.validation(form, data, hasError);},'attributes':[{'id':'FormLanding_phone','inputID':'lv-formLanding1-phone','errorID':'lv-formLanding1-phone_em_','model':'FormLanding','name':'phone','enableAjaxValidation':false,'clientValidation':function(value, messages, attribute) {

if(lvjq1.trim(value)!='') {
	
if(value.length>25) {
	messages.push("Phone \u0441\u043b\u0438\u0448\u043a\u043e\u043c \u0434\u043b\u0438\u043d\u043d\u044b\u0439 (\u041c\u0430\u043a\u0441\u0438\u043c\u0443\u043c: 25 \u0441\u0438\u043c\u0432.).");
}

}


if(lvjq1.trim(value)!='' && !value.match(/^\+7\([0-9][0-9][0-9]\)[0-9][0-9][0-9]\-[0-9][0-9]\-[0-9][0-9]$/)) {
	messages.push("\u041f\u043e\u043b\u0435 \u00ab\u0422\u0435\u043b\u0435\u0444\u043e\u043d\u00bb \u0437\u0430\u043f\u043e\u043b\u043d\u0435\u043d\u043e \u043d\u0435\u0432\u0435\u0440\u043d\u043e");
}


if(lvjq1.trim(value)=='') {
	messages.push("\u041f\u043e\u043b\u0435 \u00ab\u0422\u0435\u043b\u0435\u0444\u043e\u043d\u00bb \u0437\u0430\u043f\u043e\u043b\u043d\u0435\u043d\u043e \u043d\u0435\u0432\u0435\u0440\u043d\u043e");
}

}}],'errorCss':'error'});
lvjq1("#phone").mask("+7(999)999-99-99",{'placeholder':'*'});
lvjq1('#lv-formLanding2').yiiactiveform({'validateOnSubmit':true,'afterValidate':function(form, data, hasError){return window.leadvertex.form.validation(form, data, hasError);},'attributes':[{'id':'FormLanding_phone','inputID':'phone','errorID':'phone_em_','model':'FormLanding','name':'phone','enableAjaxValidation':false,'clientValidation':function(value, messages, attribute) {

if(lvjq1.trim(value)!='') {
	
if(value.length>25) {
	messages.push("Phone \u0441\u043b\u0438\u0448\u043a\u043e\u043c \u0434\u043b\u0438\u043d\u043d\u044b\u0439 (\u041c\u0430\u043a\u0441\u0438\u043c\u0443\u043c: 25 \u0441\u0438\u043c\u0432.).");
}

}


if(lvjq1.trim(value)!='' && !value.match(/^\+7\([0-9][0-9][0-9]\)[0-9][0-9][0-9]\-[0-9][0-9]\-[0-9][0-9]$/)) {
	messages.push("\u041f\u043e\u043b\u0435 \u00ab\u0422\u0435\u043b\u0435\u0444\u043e\u043d\u00bb \u0437\u0430\u043f\u043e\u043b\u043d\u0435\u043d\u043e \u043d\u0435\u0432\u0435\u0440\u043d\u043e");
}


if(lvjq1.trim(value)=='') {
	messages.push("\u041f\u043e\u043b\u0435 \u00ab\u0422\u0435\u043b\u0435\u0444\u043e\u043d\u00bb \u0437\u0430\u043f\u043e\u043b\u043d\u0435\u043d\u043e \u043d\u0435\u0432\u0435\u0440\u043d\u043e");
}

}}],'errorCss':'error'});
lvjq1('#lv-formLanding3').yiiactiveform({'validateOnSubmit':true,'afterValidate':function(form, data, hasError){return window.leadvertex.form.validation(form, data, hasError);},'attributes':[{'id':'FormLanding_phone','inputID':'phone','errorID':'phone_em_','model':'FormLanding','name':'phone','enableAjaxValidation':false,'clientValidation':function(value, messages, attribute) {

if(lvjq1.trim(value)!='') {
	
if(value.length>25) {
	messages.push("Phone \u0441\u043b\u0438\u0448\u043a\u043e\u043c \u0434\u043b\u0438\u043d\u043d\u044b\u0439 (\u041c\u0430\u043a\u0441\u0438\u043c\u0443\u043c: 25 \u0441\u0438\u043c\u0432.).");
}

}


if(lvjq1.trim(value)!='' && !value.match(/^\+7\([0-9][0-9][0-9]\)[0-9][0-9][0-9]\-[0-9][0-9]\-[0-9][0-9]$/)) {
	messages.push("\u041f\u043e\u043b\u0435 \u00ab\u0422\u0435\u043b\u0435\u0444\u043e\u043d\u00bb \u0437\u0430\u043f\u043e\u043b\u043d\u0435\u043d\u043e \u043d\u0435\u0432\u0435\u0440\u043d\u043e");
}


if(lvjq1.trim(value)=='') {
	messages.push("\u041f\u043e\u043b\u0435 \u00ab\u0422\u0435\u043b\u0435\u0444\u043e\u043d\u00bb \u0437\u0430\u043f\u043e\u043b\u043d\u0435\u043d\u043e \u043d\u0435\u0432\u0435\u0440\u043d\u043e");
}

}}],'errorCss':'error'});
lvjq1('#lv-formLanding4').yiiactiveform({'validateOnSubmit':true,'afterValidate':function(form, data, hasError){return window.leadvertex.form.validation(form, data, hasError);},'attributes':[{'id':'FormLanding_phone','inputID':'phone','errorID':'phone_em_','model':'FormLanding','name':'phone','enableAjaxValidation':false,'clientValidation':function(value, messages, attribute) {

if(lvjq1.trim(value)!='') {
	
if(value.length>25) {
	messages.push("Phone \u0441\u043b\u0438\u0448\u043a\u043e\u043c \u0434\u043b\u0438\u043d\u043d\u044b\u0439 (\u041c\u0430\u043a\u0441\u0438\u043c\u0443\u043c: 25 \u0441\u0438\u043c\u0432.).");
}

}


if(lvjq1.trim(value)!='' && !value.match(/^\+7\([0-9][0-9][0-9]\)[0-9][0-9][0-9]\-[0-9][0-9]\-[0-9][0-9]$/)) {
	messages.push("\u041f\u043e\u043b\u0435 \u00ab\u0422\u0435\u043b\u0435\u0444\u043e\u043d\u00bb \u0437\u0430\u043f\u043e\u043b\u043d\u0435\u043d\u043e \u043d\u0435\u0432\u0435\u0440\u043d\u043e");
}


if(lvjq1.trim(value)=='') {
	messages.push("\u041f\u043e\u043b\u0435 \u00ab\u0422\u0435\u043b\u0435\u0444\u043e\u043d\u00bb \u0437\u0430\u043f\u043e\u043b\u043d\u0435\u043d\u043e \u043d\u0435\u0432\u0435\u0440\u043d\u043e");
}

}}],'errorCss':'error'});
lvjq1('#lv-formLanding5').yiiactiveform({'validateOnSubmit':true,'afterValidate':function(form, data, hasError){return window.leadvertex.form.validation(form, data, hasError);},'attributes':[{'id':'FormLanding_phone','inputID':'phone','errorID':'phone_em_','model':'FormLanding','name':'phone','enableAjaxValidation':false,'clientValidation':function(value, messages, attribute) {

if(lvjq1.trim(value)!='') {
	
if(value.length>25) {
	messages.push("Phone \u0441\u043b\u0438\u0448\u043a\u043e\u043c \u0434\u043b\u0438\u043d\u043d\u044b\u0439 (\u041c\u0430\u043a\u0441\u0438\u043c\u0443\u043c: 25 \u0441\u0438\u043c\u0432.).");
}

}


if(lvjq1.trim(value)!='' && !value.match(/^\+7\([0-9][0-9][0-9]\)[0-9][0-9][0-9]\-[0-9][0-9]\-[0-9][0-9]$/)) {
	messages.push("\u041f\u043e\u043b\u0435 \u00ab\u0422\u0435\u043b\u0435\u0444\u043e\u043d\u00bb \u0437\u0430\u043f\u043e\u043b\u043d\u0435\u043d\u043e \u043d\u0435\u0432\u0435\u0440\u043d\u043e");
}


if(lvjq1.trim(value)=='') {
	messages.push("\u041f\u043e\u043b\u0435 \u00ab\u0422\u0435\u043b\u0435\u0444\u043e\u043d\u00bb \u0437\u0430\u043f\u043e\u043b\u043d\u0435\u043d\u043e \u043d\u0435\u0432\u0435\u0440\u043d\u043e");
}

}}],'errorCss':'error'});
lvjq1('#lv-formLanding6').yiiactiveform({'validateOnSubmit':true,'afterValidate':function(form, data, hasError){return window.leadvertex.form.validation(form, data, hasError);},'attributes':[{'id':'FormLanding_phone','inputID':'phone','errorID':'phone_em_','model':'FormLanding','name':'phone','enableAjaxValidation':false,'clientValidation':function(value, messages, attribute) {

if(lvjq1.trim(value)!='') {
	
if(value.length>25) {
	messages.push("Phone \u0441\u043b\u0438\u0448\u043a\u043e\u043c \u0434\u043b\u0438\u043d\u043d\u044b\u0439 (\u041c\u0430\u043a\u0441\u0438\u043c\u0443\u043c: 25 \u0441\u0438\u043c\u0432.).");
}

}


if(lvjq1.trim(value)!='' && !value.match(/^\+7\([0-9][0-9][0-9]\)[0-9][0-9][0-9]\-[0-9][0-9]\-[0-9][0-9]$/)) {
	messages.push("\u041f\u043e\u043b\u0435 \u00ab\u0422\u0435\u043b\u0435\u0444\u043e\u043d\u00bb \u0437\u0430\u043f\u043e\u043b\u043d\u0435\u043d\u043e \u043d\u0435\u0432\u0435\u0440\u043d\u043e");
}


if(lvjq1.trim(value)=='') {
	messages.push("\u041f\u043e\u043b\u0435 \u00ab\u0422\u0435\u043b\u0435\u0444\u043e\u043d\u00bb \u0437\u0430\u043f\u043e\u043b\u043d\u0435\u043d\u043e \u043d\u0435\u0432\u0435\u0440\u043d\u043e");
}

}}],'errorCss':'error'});
});
/*]]>*/
</script>
</body>
 
</html>
