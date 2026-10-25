<?php 
   $offer = 20;
   include_once $_SERVER['DOCUMENT_ROOT'].'/../includes/landingsData/index2.php';
?> 
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>"CUTE"</title>
   <link rel="stylesheet" href="files/landings/1547-abercrombie/css/libs.css">
   <link rel="stylesheet" href="files/landings/1547-abercrombie/css/index.css">    

</head>
<body>


<!-- wrapper -->
<div class="wrapper">
   <!-- header -->
   <header class="header">
      <div class="container">
         <ul class="menu">
            <li class="menu__item"><a href="#" class="menu__link" data-smooth-scroll="#how-we-work">оплата и доставка</a></li>
            <li class="menu__item"><a href="#" class="menu__link" data-smooth-scroll="#reviews">отзывы</a></li>
         </ul>
         <div class="main">
            <h1 class="h1 title">
               <div>Утепленные женские костюмы <span>"CUTE"</span></div>
            </h1>
            <div class="subtitle">Женские костюмы и комбинезоны "CUTE" входят в ТОП 10 производителей одежды США. Не упусти шанс приобрести оригинальную одежду по лучшим ценам!</div>
            <div class="sale-box">
               <div class="sale-box--top">скидки до</div>
               <div class="sale-box--bottom">-50%</div>
            </div>
         </div>
         <div class="bg-box">
            <div class="price">
               <div class="circle"></div>
               <div class="price__old">4990 Руб</div>
               <div class="price__current"><?php echo $price['real_price']; ?></div>
            </div>
            <div class="bottom-box">
               <div class="watch-video">
                  <a href="#" class="btn btn_red" role="button" data-smooth-scroll="#products_patrik"><span>выбрать модель</span></a>
               </div>

            </div>
            <div class="bg"><img src="files/landings/1547-abercrombie/img/header-bg.png" class="img-fluid" alt=""></div>
         </div>
      </div>
      <div class="waves">
         <svg width="1400" height="300" class="wave wave-top" viewbox="0 0 1400 300" preserveaspectratio="none">
            <path d="M 2 110 C 498 26 737 90 1400 109 L 1400 300 L 0 300 z"></path>
         </svg>
         <svg width="1400" height="300" class="wave wave-bottom" viewbox="0 0 1400 300" preserveaspectratio="none">
            <path d="M 2 110 C 498 26 737 90 1400 109 L 1400 300 L 0 300 z"></path>
         </svg>
      </div>
   </header>
   <!-- /header -->
   <!-- advantages -->
   <section class="advantages">
      <div class="container">
         <h3 class="h3 title">ВОСПОЛЬЗУЙСЯ АКЦИЕЙ НА ТОПОВЫЕ ЖЕНСКИЕ МОДЕЛИ</h3>
         <div class="items">
            <div class="item item-1">
               <div class="item--top">
                  <div class="item--title">СОВРЕМЕННЫЕ <br>КАНОНЫ МОДЫ</div>
                  <div class="item--num"><img src="files/landings/1547-abercrombie/img/num-icon-01.png" class="img-fluid" alt=""></div>
               </div>
               <div class="item--bottom">Большое внимание уделено мелким деталям: застежкам, карманам, манжетам. Идеально ровные швы и линии в тандеме с многообразными цветовыми решениями позволили придать женским моделям грациозности.</div>
            </div>
            <div class="item item-2">
               <div class="item--top">
                  <div class="item--title">ОСЕНЬ / ВЕСНА: <br>В ЛЮБУЮ ПОГОДУ</div>
                  <div class="item--num"><img src="files/landings/1547-abercrombie/img/num-icon-02.png" class="img-fluid" alt=""></div>
               </div>
               <div class="item--bottom">Новая коллекция костюмов "CUTE" из натуральных дышащих материалов выполнена в главных трендовых цветах 2019 года. У нас представлены из натурального хлопка, который идеально подходит для одежды в теплый сезон.</div>
            </div>
            <div class="circles circles-1"><img src="files/landings/1547-abercrombie/img/a-circles-1.png" class="img-fluid" alt=""></div>
            <div class="item item-3">
               <div class="item--top">
                  <div class="item--title">С ЗАБОТОЙ <br>О КОМФОРТЕ</div>
                  <div class="item--num"><img src="files/landings/1547-abercrombie/img/num-icon-03.png" class="img-fluid" alt=""></div>
               </div>
               <div class="item--bottom">Конечно, дизайнеры не забыли и о качестве материалов, поэтому Утепленные женские костюмы получились максимально адаптированными к осеннему и весеннему климату. Производители успешно совместили удобство с красотой костюмов.</div>
            </div>
            <div class="item item-4">
               <div class="item--top">
                  <div class="item--title">РАЗНООБРАЗИЕ <br>ЖЕНСКОГО ОБРАЗА</div>
                  <div class="item--num"><img src="files/landings/1547-abercrombie/img/num-icon-04.png" class="img-fluid" alt=""></div>
               </div>
               <div class="item--bottom">Все представленные модели женских костюмов в первую очередь относятся не к одежде для спорта, а принадлежат к нише повседневной одежды</div>
            </div>
            <div class="circles circles-2"><img src="files/landings/1547-abercrombie/img/a-circles-2.png" class="img-fluid" alt=""></div>
         </div>
      </div>
   </section>
   <!-- /advantages -->
   <!-- video-section -->
   <section class="video-section" id="video-section">
      <div class="container">
         <div class="main">
            <h3 class="h3 title">СЕКРЕТ ВАШЕГО КОМФОРТА<br> и стиля</h3>
            <div class="video-box">
               <div class="video-box-wrap">
                  <div class="video-pic"><img src="files/landings/1547-abercrombie/img/video-pic.jpg" class="img-fluid" alt=""></div>
                  <div class="video-movie responsive-iframe" data-video-id="svDnr9AlRrM">
                     <div id="video-placeholder" class="video-target"></div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!-- /video-section -->
   <!-- gallery -->
   <div class="gallery">
      <div class="container">
         <div class="items">
            <a href="files/landings/1547-abercrombie/img/gallery/1.jpg" class="item fancybox" data-fancybox="gallery"><img src="files/landings/1547-abercrombie/img/gallery/1.jpg" class="img-fluid" alt=""></a>
            <a href="files/landings/1547-abercrombie/img/gallery/2.jpg" class="item fancybox" data-fancybox="gallery"><img src="files/landings/1547-abercrombie/img/gallery/2.jpg" class="img-fluid" alt=""></a>
            <a href="files/landings/1547-abercrombie/img/gallery/3.jpg" class="item fancybox" data-fancybox="gallery"><img src="files/landings/1547-abercrombie/img/gallery/3.jpg" class="img-fluid" alt=""></a>
            <a href="files/landings/1547-abercrombie/img/gallery/4.jpg" class="item fancybox" data-fancybox="gallery"><img src="files/landings/1547-abercrombie/img/gallery/4.jpg" class="img-fluid" alt=""></a>
            <a href="files/landings/1547-abercrombie/img/gallery/5.jpg" class="item fancybox" data-fancybox="gallery"><img src="files/landings/1547-abercrombie/img/gallery/5.jpg" class="img-fluid" alt=""></a>
            <a href="files/landings/1547-abercrombie/img/gallery/6.jpg" class="item fancybox" data-fancybox="gallery"><img src="files/landings/1547-abercrombie/img/gallery/6.jpg" class="img-fluid" alt=""></a>
            <a href="files/landings/1547-abercrombie/img/gallery/7.jpg" class="item fancybox" data-fancybox="gallery"><img src="files/landings/1547-abercrombie/img/gallery/7.jpg" class="img-fluid" alt=""></a>
            <a href="files/landings/1547-abercrombie/img/gallery/8.jpg" class="item fancybox" data-fancybox="gallery"><img src="files/landings/1547-abercrombie/img/gallery/8.jpg" class="img-fluid" alt=""></a>
         </div>
      </div>
   </div>
   <!-- /gallery -->
   <!-- have-time -->
   <div class="have-time">
      <div class="waves waves-top">
         <svg width="1400" height="100" class="wave-1" viewbox="0 0 1400 100" preserveaspectratio="none">
            <path d="M 0 50 C 410 143 836 60 1400 50 L 1400 0 L 0 0 z"></path>
         </svg>
         <svg width="1400" height="100" class="wave-2" viewbox="0 0 1400 100" preserveaspectratio="none">
            <path d="M 0 50 C 410 143 836 60 1400 50 L 1400 0 L 0 0 z"></path>
         </svg>
      </div>
      <div class="bg"></div>
      <div class="wrap">
         <div class="container">
            <div class="main">
               <div class="paragraphs">
                  <p>Приобретая женские костюмы «CUTE", девушки могут быть уверенными, что они прослужит не один год и долгое время будет сохранять первозданный вид. Лёгкая и приятная к телу ткань натурального коттона всегда пользуется большой популярностью благодаря полезным свойствам и красоте!</p><p>Меняй свою жизнь благодаря разнообразию гардероба с костюмами "CUTE" – уникальная гармония доступной цены и высокого качества.</p>
               </div>
               <div class="title">
                  <div>успейте сейчас! скидка до -50%</div>
               </div>
            </div>
         </div>
      </div>
      <div class="waves  waves-bottom">
         <svg width="1400" height="200" class="wave-1" viewbox="0 0 1400 200" preserveaspectratio="none">
            <path d="M 0 66 C 634 90 908 0 1400 65 L 1400 200 L 0 200 z"></path>
         </svg>
         <svg width="1400" height="200" class="wave-2" viewbox="0 0 1400 200" preserveaspectratio="none">
            <path d="M 0 66 C 634 90 908 0 1400 65 L 1400 200 L 0 200 z"></path>
         </svg>
      </div>
   </div>
   <!-- /have-time -->
   <!-- products -->
   <div class="products_patrik" id="products_patrik">
      <div class="container">
         <div class="wrap-ops">
            <div class="op">
               <div class="op1">
                  <img src="files/landings/1547-abercrombie/img/op1/1.jpg" alt="">
                  <img src="files/landings/1547-abercrombie/img/op1/2.jpg" alt="">
                  <img src="files/landings/1547-abercrombie/img/op1/3.jpg" alt="">
                  <img src="files/landings/1547-abercrombie/img/op1/4.jpg" alt="">
               </div>
               <h3>КОМБИНЕЗОН "CUTE" ШОКОЛАДНЫЙ</h3>
               <div class="price">
                  <div class="circle"></div>
                  <div class="price__old">4990 Руб</div>
                  <div class="price__current"><?php echo $price['real_price']; ?></div>
               </div>
               <a href="#" class="button-m btn btn_red" role="button" data-smooth-scroll="#patrik_bottom"><span>Заказать</span></a>
            </div>
            <div class="op">
               <div class="op2">
                  <img src="files/landings/1547-abercrombie/img/op2/1.jpg" alt="">
                  <img src="files/landings/1547-abercrombie/img/op2/2.jpg" alt="">
                  <img src="files/landings/1547-abercrombie/img/op2/3.jpg" alt="">
                  <img src="files/landings/1547-abercrombie/img/op2/4.jpg" alt="">
               </div>
               <h3>КОМБИНЕЗОН "CUTE" ОЛИВКОВЫЙ</h3>
               <div class="price">
                  <div class="circle"></div>
                  <div class="price__old">4990 Руб</div>
                  <div class="price__current"><?php echo $price['real_price']; ?></div>
               </div>
               <a href="#" class="button-m btn btn_red" role="button" data-smooth-scroll="#patrik_bottom"><span>Заказать</span></a>
            </div>
            <div class="op">
               <div class="op3">
                  <img src="files/landings/1547-abercrombie/img/op3/1.jpg" alt="">
                  <img src="files/landings/1547-abercrombie/img/op3/2.jpg" alt="">
                  <img src="files/landings/1547-abercrombie/img/op3/3.jpg" alt="">
                  <img src="files/landings/1547-abercrombie/img/op3/4.jpg" alt="">
               </div>
               <h3>КОМБИНЕЗОН "CUTE" СЕРЫЙ МЕЛАНЖ</h3>
               <div class="price">
                  <div class="circle"></div>
                  <div class="price__old">4990 Руб</div>
                  <div class="price__current"><?php echo $price['real_price']; ?></div>
               </div>
               <a href="#" class="button-m btn btn_red" role="button" data-smooth-scroll="#patrik_bottom"><span>Заказать</span></a>
            </div>
            <div class="op">
               <div class="op4">
                  <img src="files/landings/1547-abercrombie/img/op4/1.jpg" alt="">
                  <img src="files/landings/1547-abercrombie/img/op4/2.jpg" alt="">
                  <img src="files/landings/1547-abercrombie/img/op4/3.jpg" alt="">
                  <img src="files/landings/1547-abercrombie/img/op4/4.jpg" alt="">
               </div>
               <h3>КОМБИНЕЗОН "CUTE" ЧЕРНЫЙ</h3>
               <div class="price">
                  <div class="circle"></div>
                  <div class="price__old">4990 Руб</div>
                  <div class="price__current"><?php echo $price['real_price']; ?></div>
               </div>
               <a href="#" class="button-m btn btn_red" role="button" data-smooth-scroll="#patrik_bottom"><span>Заказать</span></a>
            </div>
            <div class="op">
               <div class="op5">
                  <img src="files/landings/1547-abercrombie/img/op5/1.jpg" alt="">
                  <img src="files/landings/1547-abercrombie/img/op5/2.jpg" alt="">
                  <img src="files/landings/1547-abercrombie/img/op5/3.jpg" alt="">
                  <img src="files/landings/1547-abercrombie/img/op5/4.jpg" alt="">
               </div>
               <h3>КОМБИНЕЗОН "CUTE" ПУДРОВЫЙ</h3>
               <div class="price">
                  <div class="circle"></div>
                  <div class="price__old">4990 Руб</div>
                  <div class="price__current"><?php echo $price['real_price']; ?></div>
               </div>
               <a href="#" class="button-m btn btn_red" role="button" data-smooth-scroll="#patrik_bottom"><span>Заказать</span></a>
            </div>
            <div class="op">
               <div class="op6">
                  <img src="files/landings/1547-abercrombie/img/op6/1.jpg" alt="">
                  <img src="files/landings/1547-abercrombie/img/op6/2.jpg" alt="">
                  <img src="files/landings/1547-abercrombie/img/op6/3.jpg" alt="">
                  <img src="files/landings/1547-abercrombie/img/op6/4.jpg" alt="">
               </div>
               <h3>КОСТЮМ "CUTE" КРАСНЫЙ</h3>
               <div class="price">
                  <div class="circle"></div>
                  <div class="price__old">4990 Руб</div>
                  <div class="price__current"><?php echo $price['real_price']; ?></div>
               </div>
               <a href="#" class="button-m btn btn_red" role="button" data-smooth-scroll="#patrik_bottom"><span>Заказать</span></a>
            </div>
            <div class="op">
               <div class="op7">
                  <img src="files/landings/1547-abercrombie/img/op7/1.jpg" alt="">
                  <img src="files/landings/1547-abercrombie/img/op7/2.jpg" alt="">
                  <img src="files/landings/1547-abercrombie/img/op7/3.jpg" alt="">
                  <img src="files/landings/1547-abercrombie/img/op7/4.jpg" alt="">
               </div>
               <h3>КОСТЮМ "CUTE" МЯТНЫЙ</h3>
               <div class="price">
                  <div class="circle"></div>
                  <div class="price__old">4990 Руб</div>
                  <div class="price__current"><?php echo $price['real_price']; ?></div>
               </div>
               <a href="#" class="button-m btn btn_red" role="button" data-smooth-scroll="#patrik_bottom"><span>Заказать</span></a>
            </div>
            <div class="op">
               <div class="op8">
                  <img src="files/landings/1547-abercrombie/img/op8/1.jpg" alt="">
                  <img src="files/landings/1547-abercrombie/img/op8/2.jpg" alt="">
                  <img src="files/landings/1547-abercrombie/img/op8/3.jpg" alt="">
                  <img src="files/landings/1547-abercrombie/img/op8/4.jpg" alt="">
               </div>
               <h3>КОСТЮМ "CUTE" РОЗОВЫЙ МЕЛАНЖ</h3>
               <div class="price">
                  <div class="circle"></div>
                  <div class="price__old">4990 Руб</div>
                  <div class="price__current"><?php echo $price['real_price']; ?></div>
               </div>
               <a href="#" class="button-m btn btn_red" role="button" data-smooth-scroll="#patrik_bottom"><span>Заказать</span></a>
            </div>
            <div class="op">
               <div class="op9">
                  <img src="files/landings/1547-abercrombie/img/op9/1.jpg" alt="">
                  <img src="files/landings/1547-abercrombie/img/op9/2.jpg" alt="">
                  <img src="files/landings/1547-abercrombie/img/op9/3.jpg" alt="">
                  <img src="files/landings/1547-abercrombie/img/op9/4.jpg" alt="">
               </div>
               <h3>КОМБИНЕЗОН "CUTE" ЛИМОННЫЙ</h3>
               <div class="price">
                  <div class="circle"></div>
                  <div class="price__old">4990 Руб</div>
                  <div class="price__current"><?php echo $price['real_price']; ?></div>
               </div>
               <a href="#" class="button-m btn btn_red" role="button" data-smooth-scroll="#patrik_bottom"><span>Заказать</span></a>
            </div>
         </div>
      </div>
   </div>
   <!-- /products -->
   <div class="more-advantages">
		<div class="container">
			<img style="width: 55%;margin:0 auto;" src="files/landings/1547-abercrombie/img/table.jpg" alt="">
		</div>
   </div>
   <!-- more-advantages -->
   <div class="more-advantages">
      <div class="container">
         <div class="main">
            <div class="items">
               <div class="item">
                  <div class="item--title">БРЕНДОВЫЕ КОСТЮМЫ</div>
                  <div class="item--subtitle">
                     Мы подобрали для вас наиболее удачные модели, заключившие в себе лучшие <span class="item--accent">характеристики одежды и современного дизайна.</span>
                  </div>
               </div>
               <div class="item">
                  <div class="item--title">УНИВЕРСАЛЬНЫЙ СТИЛЬ</div>
                  <div class="item--subtitle">
                     В продаже представлены комплекты, в которых <span class="item--accent">уместно посещать общественные места</span> и комфортно чувствовать себя в заведениях. 
                  </div>
               </div>
               <div class="item">
                  <div class="item--title">ПРЕМИАЛЬНЫЙ КОМФОРТ</div>
                  <div class="item--subtitle">
                     При производстве представленных моделей повышенное внимание было уделено <span class="item--accent">пошиву с учетом особенностей женской фигуры. </span>
                  </div>
               </div>
               <div class="item">
                  <div class="item--title">КАЧЕСТВЕННОЕ ОБСЛУЖИВАНИЕ</div>
                  <div class="item--subtitle">
                     Покупая у нас, Вы можете быть на 100% уверены в том, что вовремя получите <span class="item--accent">нужный товар</span> в надлежащем качестве!
                  </div>
               </div>
               <div class="item">
                  <div class="item--title">НАТУРАЛЬНЫЕ МАТЕРИАЛЫ</div>
                  <div class="item--subtitle">
                     За коттоновыми изделиями легко ухаживать, они приятны к телу, отличаются высокой гигроскопичностью и воздухопроницаемостью.
                  </div>
               </div>
            </div>
            <div class="bottom-box">
               <div class="sale">sale up to -50%</div>
               <div class="circle"><img src="files/landings/1547-abercrombie/img/a-circles-3.png" class="img-fluid" alt=""></div>
            </div>
         </div>
      </div>
   </div>
   <!-- /more-advantages -->
   <!-- why-we -->
   <div class="why-we">
      <div class="waves waves-top">
         <svg width="1400" height="250" class="wave wave-top" viewbox="0 0 1400 250" preserveaspectratio="none">
            <path d="M 1 154 C 597 244 957 143 1400 157 L 1400 0 L 0 0 z"></path>
         </svg>
         <svg width="1400" height="250" class="wave wave-bottom" viewbox="0 0 1400 250" preserveaspectratio="none">
            <path d="M 1 154 C 597 244 957 143 1400 157 L 1400 0 L 0 0 z"></path>
         </svg>
      </div>
      <div class="wrap">
         <div class="container">
            <div class="main">
               <h4 class="h4 title">ПОЧЕМУ СТОИТ ПОКУПАТЬ У НАС</h4>
               <div class="items">
                  <figure class="item">
                     <div class="item--img"><img src="files/landings/1547-abercrombie/img/ww-icon-1.png" class="img-fluid"></div>
                     <figcaption>
                        <div class="item--title">ПОПУЛЯРНЫЙ БРЕНД</div>
                        <div class="item--subtitle">Создатель бренда был заядлым любителем активного отдыха, каждая модель соответствует свободному духу автора.</div>
                     </figcaption>
                  </figure>
                  <figure class="item">
                     <div class="item--img"><img src="files/landings/1547-abercrombie/img/ww-icon-2.png" class="img-fluid"></div>
                     <figcaption>
                        <div class="item--title">ВЫСОКОЕ КАЧЕСТВО</div>
                        <div class="item--subtitle">Каждая модель выполнена из натурального хлопка, поэтому костюмы отличаются высокой лёгкостью, мягкостью и гипоаллергенностью.</div>
                     </figcaption>
                  </figure>
                  <figure class="item">
                     <div class="item--img"><img src="files/landings/1547-abercrombie/img/ww-icon-3.png" class="img-fluid"></div>
                     <figcaption>
                        <div class="item--title">НИЗКИЕ ЦЕНЫ</div>
                        <div class="item--subtitle">Прямая поставка от производителей и отсутствие магазинных накруток позволили вам получить Утепленные женские костюмы по доступной цене. </div>
                     </figcaption>
                  </figure>
                  <figure class="item">
                     <div class="item--img"><img src="files/landings/1547-abercrombie/img/ww-icon-4.png" class="img-fluid"></div>
                     <figcaption>
                        <div class="item--title">БЫСТРАЯ ДОСТАВКА</div>
                        <div class="item--subtitle">Доставка осуществляется в течение 3-7 дней с момента заказа.</div>
                     </figcaption>
                  </figure>
               </div>
            </div>
         </div>
      </div>
      <div class="waves waves-bottom">
         <svg width="1400" height="200" class="wave wave-top" viewbox="0 0 1400 200" preserveaspectratio="none">
            <path d="M 0 55 C 556 165 804 62 1400 56 L 1400 200 L 2 200 z"></path>
         </svg>
         <svg width="1400" height="200" class="wave wave-bottom" viewbox="0 0 1400 200" preserveaspectratio="none">
            <path d="M 0 55 C 556 165 804 62 1400 56 L 1400 200 L 2 200 z"></path>
         </svg>
      </div>
   </div>
   <!-- /why-we -->
   <!-- how-we-work -->
   <div class="how-we-work" id="how-we-work">
      <div class="container">
         <div class="main">
            <h4 class="h4 title">КАК СДЕЛАТЬ ЗАКАЗ НА НАШЕМ САЙТЕ</h4>
            <div class="items">
               <div class="item">
                  <div class="item--left">
                     <div class="item--mark">
                        <img src="files/landings/1547-abercrombie/img/hww-icon-1.png" class="img-fluid" alt="">
                        <div class="item--mark_big"><img src="files/landings/1547-abercrombie/img/hww-icon-1.png" class="img-fluid" alt=""></div>
                     </div>
                     <div class="item--title">Вы оставляете заявку на нашем сайте</div>
                  </div>
                  <div class="item--pic">
                     <img src="files/landings/1547-abercrombie/img/hww-pic-1.jpg" class="img-fluid" alt="">
                  </div>
               </div>
               <div class="item item_revers">
                  <div class="item--left">
                     <div class="item--mark">
                        <img src="files/landings/1547-abercrombie/img/hww-icon-2.png" class="img-fluid" alt="">
                        <div class="item--mark_big"><img src="files/landings/1547-abercrombie/img/hww-icon-2.png" class="img-fluid" alt=""></div>
                     </div>
                     <div class="item--title">оператор свяжется с вами для подтверждения</div>
                  </div>
                  <div class="item--pic">
                     <img src="files/landings/1547-abercrombie/img/hww-pic-2.jpg" class="img-fluid" alt="">
                  </div>
               </div>
               <div class="item">
                  <div class="item--left">
                     <div class="item--mark">
                        <img src="files/landings/1547-abercrombie/img/hww-icon-3.png" class="img-fluid" alt="">
                        <div class="item--mark_big"><img src="files/landings/1547-abercrombie/img/hww-icon-3.png" class="img-fluid" alt=""></div>
                     </div>
                     <div class="item--title">мы отправляем ваш заказ почтой</div>
                  </div>
                  <div class="item--pic">
                     <img src="files/landings/1547-abercrombie/img/hww-pic-3.jpg" class="img-fluid" alt="">
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- /how-we-work -->
   <!-- reviews -->
   <section class="reviews" id="reviews">
      <div class="container">
         <div class="main">
            <h4 class="h4 title">отзывы наших клиентов</h4>
            <div class="slider">
               <div class="item">
                  <div class="item--comment">
                     <p>Заказывала костюм "CUTE", пришел быстро и полностью соответствует картинке. Довольно теплый для весны, можно уже через месяц при потеплении носить. Для летних вечерних прогулок тоже супер – смело рекомендую !!!</p>
                  </div>
                  <div class="item--bottom">
                     <div class="item--arrow item--arrow_prev item--arrow_hidden"><img src="files/landings/1547-abercrombie/img/prev-arrow.png" class="img-fluid" alt=""></div>
                     <div class="item--img"><img src="files/landings/1547-abercrombie/img/r1.png" class="img-fluid" alt=""></div>
                     <div class="item--arrow item--arrow_next"><img src="files/landings/1547-abercrombie/img/next-arrow.png" class="img-fluid" alt=""></div>
                  </div>
               </div>
               <div class="item item_left">
                  <div class="item--comment">
                     <p>Костюм цвета нежной фуксии по качеству и стилю супер, резинка немного стягивает по талии, можно было перезаказать на размер больше, но не стала. По фигуре село здорово, а при 48-ом рисковать не хотела. Костюм смотрится явно дороже своей стоимости.</p>
                  </div>
                  <div class="item--bottom">
                     <div class="item--arrow item--arrow_next item--arrow_hidden"><img src="files/landings/1547-abercrombie/img/next-arrow.png" class="img-fluid" alt=""></div>
                     <div class="item--img"><img src="files/landings/1547-abercrombie/img/r2.png" class="img-fluid" alt=""></div>
                     <div class="item--arrow item--arrow_prev"><img src="files/landings/1547-abercrombie/img/prev-arrow.png" class="img-fluid" alt=""></div>
                  </div>
               </div>
               <div class="item">
                  <div class="item--comment">
                     <p>Дякую, костюм якісний і по ціні влаштовує. Можно носити навіть зараз. Також мені сподобалася швидкість доставки, в оговорену добу одяг вже чекав на пошті.</p>
                  </div>
                  <div class="item--bottom">
                     <div class="item--arrow item--arrow_prev item--arrow_hidden"><img src="files/landings/1547-abercrombie/img/prev-arrow.png" class="img-fluid" alt=""></div>
                     <div class="item--img"><img src="files/landings/1547-abercrombie/img/r3.png" class="img-fluid" alt=""></div>
                     <div class="item--arrow item--arrow_next"><img src="files/landings/1547-abercrombie/img/next-arrow.png" class="img-fluid" alt=""></div>
                  </div>
               </div>
               <div class="item item_left">
                  <div class="item--comment">
                     <p>Заказывала костюм голубого цвета – он мне показался более нежным, чем розовый. Костюмом более чем довольна. Спасибо за помощь в выборе размера, хорошее отношение (нормально упаковали, доставили в срок). Теперь буду отслеживать новинки этого бренда.</p>
                  </div>
                  <div class="item--bottom">
                     <div class="item--arrow item--arrow_next item--arrow_hidden"><img src="files/landings/1547-abercrombie/img/next-arrow.png" class="img-fluid" alt=""></div>
                     <div class="item--img"><img src="files/landings/1547-abercrombie/img/r4.png" class="img-fluid" alt=""></div>
                     <div class="item--arrow item--arrow_prev"><img src="files/landings/1547-abercrombie/img/prev-arrow.png" class="img-fluid" alt=""></div>
                  </div>
               </div>
               <div class="item">
                  <div class="item--comment">
                     <p>Цены действительно ниже чем в магазинах, но это связано скорее с отсутствием возможности примерки до заказа. Поэтому при заказе ваши сотрудники уделяют большое внимание выбору размера, у них получилось и костюм классный! Примеряла уже дома, костюм отлично сел. Спасибо!</p>
                  </div>
                  <div class="item--bottom">
                     <div class="item--arrow item--arrow_prev item--arrow_hidden"><img src="files/landings/1547-abercrombie/img/prev-arrow.png" class="img-fluid" alt=""></div>
                     <div class="item--img"><img src="files/landings/1547-abercrombie/img/r5.jpg" class="img-fluid" alt=""></div>
                     <div class="item--arrow item--arrow_next"><img src="files/landings/1547-abercrombie/img/next-arrow.png" class="img-fluid" alt=""></div>
                  </div>
               </div>
               <div class="item item_left">
                  <div class="item--comment">
                     <p>Вот уж точно костюм на каждый день. Покупала для удобства, чтоб выйти с подружками кофе попить или прогуляться. Все устроило, просто и со вкусом, благодарю !!!</p>
                  </div>
                  <div class="item--bottom">
                     <div class="item--arrow item--arrow_next item--arrow_hidden"><img src="files/landings/1547-abercrombie/img/next-arrow.png" class="img-fluid" alt=""></div>
                     <div class="item--img"><img src="files/landings/1547-abercrombie/img/r6.jpg" class="img-fluid" alt=""></div>
                     <div class="item--arrow item--arrow_prev"><img src="files/landings/1547-abercrombie/img/prev-arrow.png" class="img-fluid" alt=""></div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!-- /reviews -->
   <!-- 
      <div class="chat">
        <div class="container">
          <div class="items">
            <div class="item"><img src="files/landings/1547-abercrombie/img/chat-1.jpg" class="img-fluid" alt=""></div>
            <div class="item"><img src="files/landings/1547-abercrombie/img/chat-2.jpg" class="img-fluid" alt=""></div>
            <div class="item"><img src="files/landings/1547-abercrombie/img/chat-3.jpg" class="img-fluid" alt=""></div>
            <div class="item"><img src="files/landings/1547-abercrombie/img/chat-4.jpg" class="img-fluid" alt=""></div>
          </div>
        </div>
      </div>
      -->
   <!-- bottom-section -->
   <div class="bottom-section" id="patrik_bottom">
      <div class="waves">
         <svg width="1400" height="200" class="wave wave-top" viewbox="0 0 1400 200" preserveaspectratio="none">
            <path d="M 0 144 C 558 200 885 87 1400 142 L 1400 0 L 0 0 z"></path>
         </svg>
         <svg width="1400" height="200" class="wave wave-bottom" viewbox="0 0 1400 200" preserveaspectratio="none">
            <path d="M 0 144 C 558 200 885 87 1400 142 L 1400 0 L 0 0 z"></path>
         </svg>
      </div>
      <div class="wrap">
         <div class="top-box">
            <div class="container">
               <div class="title">ВЫБЕРИ СВОЙ ЖЕНСКИЙ КОСТЮМ ПО ВЫГОДНОЙ ЦЕНЕ!</div>
               <div class="subtitle">Разнообразьте свой гардероб модной одеждой по приятной цене. "CUTE" выгодно отличит Вас от других!</div>
               <div class="sale-off"><span>-50%<br>off</span></div>
               <div class="price">
                  <div class="price__old">4990 Руб</div>
                  <div class="price__current"><?php echo $price['real_price']; ?></div>
               </div>
               <div class="circles"><img src="files/landings/1547-abercrombie/img/bs-circles-1.png" class="img-fluid" alt=""></div>
               <div class="bottom">
                  <a href="#" class="btn btn_red" role="button" data-smooth-scroll="#products_patrik"><span>выбрать модель</span></a>
               </div>
               <div class="product__form">
                  <div class="order-box">
                     <form class="order-form" action="./_success_/" method="post">
                        <div class="form-group item-1">
                           <label for="name_first" class="control-label">Имя:</label>
                           <input type="text" class="form-control" name="name" id="name_first" required="" placeholder="Имя">
                        </div>
                        <div class="form-group item-2">
                           <label for="phone" class="control-label">Телефон:</label>
                           <input type="text" class="form-control" name="phone" id="phone" required="" placeholder="Телефон">
                        </div>
                        <div class="select-box" id="select">
                           <select class="select-elem">
                              <option selected="selected" value="костюм не выбран" class="" disabled="disabled">Выберите костюм</option>
                              <option value="color-1">КОМБИНЕЗОН "CUTE" ШОКОЛАДНЫЙ</option>
                              <option value="color-2">КОМБИНЕЗОН "CUTE" ОЛИВКОВЫЙ</option>
                              <option value="color-3">КОМБИНЕЗОН "CUTE" СЕРЫЙ МЕЛАНЖ</option>
                              <option value="color-4">КОМБИНЕЗОН "CUTE" ЧЕРНЫЙ</option>
                              <option value="color-5">КОМБИНЕЗОН "CUTE" ПУДРОВЫЙ</option>
                              <option value="color-6">КОСТЮМ "CUTE" КРАСНЫЙ</option>
                              <option value="color-7">КОСТЮМ "CUTE" МЯТНЫЙ</option>
                              <option value="color-8">КОСТЮМ "CUTE" РОЗОВЫЙ МЕЛАНЖ</option>
                              <option value="color-9">КОМБИНЕЗОН "CUTE" ЛИМОННЫЙ</option>
                           </select>
                        </div>
                        <div class="form-group item-3">
                           <button type="submit">Отправить заказ</button>
                        </div>
                        <input type='hidden' name='referer' value="<?php echo isset($_GET['referer']) ? $_GET['referer'] : $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] ;?>">
<input type="hidden" name="subid1"  value="<?php echo isset($_GET['subid1']) ? $_GET['subid1'] : '' ;?>" />
<input type="hidden" name="subid2"  value="<?php echo isset($_GET['subid2']) ? $_GET['subid2'] : '' ;?>" />
<input type="hidden" name="subid3"  value="<?php echo isset($_GET['subid3']) ? $_GET['subid3'] : '' ;?>" />
<input type="hidden" name="subid4"  value="<?php echo isset($_GET['subid4']) ? $_GET['subid4'] : '' ;?>" />  
<input type="hidden" name="subid5"  value="<?php echo isset($_GET['subid5']) ? $_GET['subid5'] : '' ;?>" />


                     </form>
                  </div>
               </div>
            </div>
         </div>
         <!-- footer -->
         <footer class="footer_section" style="padding: 20px 0;">
             <center>

             </center>
         </footer>
         <!-- /footer -->
      </div>
   </div>
   <!-- /bottom-section -->
</div>
<!-- /wrapper -->
<div id="umcb">
   <a title="Перезвонить Вам" href="#cb" modal="umcb-form">
      <div class="umcb-circle"></div>
      <div class="umcb-circle-fill"></div>
      <div class="umcb-img-circle"></div>
   </a>
</div>
<div id="umcb-form" class="modal">
   <div class="modal-block">
      <div class="icon-close"></div>
      <div class="title">Понравилось это предложение?</div>
      <div class="content">
         <div class="padding">
            <p>Мы расскажем Вам все об этом товаре, предложим наилучшие условия и ознакомим с подходящими акционными предложениями!
            </p>
            <form action="./_success_/" method="post" class="order-form">
               <div class="form-group">
                  <label for="name_first" class="control-label">Имя:</label>
                  <input type="text" class="form-control" name="name" id="name_first" required="">
               </div>
               <div class="form-group">
                  <label for="phone" class="control-label">Телефон:</label>
                  <input type="text" class="form-control" name="phone" id="phone" required="">
               </div>
               <div class="form-group">
                  <button type="submit">Отправить заказ</button>
               </div>
            <input type='hidden' name='referer' value="<?php echo isset($_GET['referer']) ? $_GET['referer'] : $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] ;?>">
<input type="hidden" name="subid1"  value="<?php echo isset($_GET['subid1']) ? $_GET['subid1'] : '' ;?>" />
<input type="hidden" name="subid2"  value="<?php echo isset($_GET['subid2']) ? $_GET['subid2'] : '' ;?>" />
<input type="hidden" name="subid3"  value="<?php echo isset($_GET['subid3']) ? $_GET['subid3'] : '' ;?>" />
<input type="hidden" name="subid4"  value="<?php echo isset($_GET['subid4']) ? $_GET['subid4'] : '' ;?>" />  
<input type="hidden" name="subid5"  value="<?php echo isset($_GET['subid5']) ? $_GET['subid5'] : '' ;?>" />


            </form>
            <p class="bold" style="text-align:center">Оператор перезвонит Вам через 15-30 минут</p>
         </div>
      </div>
   </div>
</div>

<script src="files/assets/general/js/jquery-3.3.1.min.js"></script>
<script src="files/landings/1547-abercrombie/js/libs.js"></script>
<script src="files/landings/1547-abercrombie/js/common.js"></script>
<link class="global" href="files/assets/general/css/custom-styles.css" type="text/css" rel="stylesheet">
<script class="global" src="files/assets/general/js/custom-functions.js" type="text/javascript"></script>
<script class="global" src="files/assets/general/js/scripts.js"></script>

</body>
</html>