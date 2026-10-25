<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Товары Для Дома</title>
 
<link rel="stylesheet" href="cms/style.css" type="text/css" />
</head>
<body>
 
 
  <style> 
  .menu {
    text-align: center;padding: 8px 0;background: #ececec;
}

.menu__icon {
   display: none;
   width: 45px;
   height: 35px;
   position: relative;
   cursor: pointer;
}

.menu__icon span {
  display: block;
  position: absolute;
  height: 9px;
  width: 100%;
  background: #333333;
  border-radius: 9px;
  opacity: 1;
  left: 0;
  transform: rotate(0deg);
  transition: .25s ease-in-out;
}

.menu__icon span:nth-child(1) {
  top: 0px;
}

.menu__icon span:nth-child(2), .menu__icon span:nth-child(3) {
  top: 13px;
}

.menu__icon span:nth-child(4) {
  top: 26px;
 }

.menu__links-item {
    display: inline-block;
    color: #333333;
    font-family: Arial;
    font-size: 14px;
    line-height: 30px;
    padding: 0 10px;
    text-transform: uppercase;
    text-decoration: none;
}

.menu__links-item:hover {
    text-decoration: underline;
}

.menu.menu_state_open .menu__icon span:nth-child(1) {
  top: 18px;
  width: 0%;
  left: 50%;
}

.menu.menu_state_open .menu__icon span:nth-child(2) {
  transform: rotate(45deg);
}

.menu.menu_state_open  .menu__icon span:nth-child(3) {
  transform: rotate(-45deg);
}

.menu.menu_state_open  .menu__icon span:nth-child(4) {
  top: 18px;
  width: 0%;
  left: 50%;
}

.menu.menu_state_open .menu__links {
  display: block;  
}

@media screen and (max-width: 999px) {
  .menu {
    text-align: right;
padding-top: 10px;
padding-right: 15px;
}
  .menu__icon{
    display: inline-block;
  }
  
  .menu__links {
    position: fixed;
    display: none;
    top: 0;
    right: 0;
    left: 0;
    margin-top: 52px;
    background-color: rgba(0, 0, 0, 0.9);
    z-index: 1000;
    overflow: auto;
  }
  
  .menu__links-item {
    display: block;
    padding: 10px 0;
    text-align: center;
    color: #ffffff;
  }
}
  </style> 
  
<!-- partial:index.partial.html -->
<div class="menu">
    <div class="menu__icon">
      <span></span>
      <span></span>
      <span></span>
      <span></span>
    </div>
  
    <div class="menu__links">
        <a class="menu__links-item" href="../">Главная</a>
        <a class="menu__links-item" href="../tovary_dlya_doma.php">Товары Для Дома</a>
        <a class="menu__links-item" href="../detskie_tovary.php">Детские Товары</a>
        <a class="menu__links-item" href="../odezhda_i_aksessuary.php">Одежда и Аксессуары</a>
        <a class="menu__links-item" href="../podarki_i_razvlecheniya.php">Подарки и Развлечения</a>
        <a class="menu__links-item" href="../elektronika_i_gadzhety.php">Электроника и Гаджеты</a>
         
    </div>
</div>
<!-- partial -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script><script>(function($){
  $(function() {
    $('.menu__icon').on('click', function() {
      $(this).closest('.menu').toggleClass('menu_state_open');
    });
  });
})(jQuery);</script>  
  
  <div style="text-align: center;padding: 15px 0;background: #fff;font-size: 22px;box-shadow: 0 1px 3px rgba(0, 0, 0, .28);color: #0030ff;text-transform: uppercase;"><span style="font-weight: bold;color: #df003b;">MustHaveOffers</span>  - Магазин популярных товаров, которые не найти в магазинах.</div>
  
  <h1 style="text-align: center;text-transform: uppercase;color: #808080;margin-bottom: -15px;"> Товары Для Дома</h1> 
  
<ul id="offers">
 
		<li class="the-offer">
			<a class="imga" href="/shoe-racks"><img class="offer-image" src="cms/offer/pic41.jpg" alt="#"></a>
			<div class="offer-name">Double Shoe Racks - двойные подставки для обуви</div>
			<div class="offer-button"><a href="/m-double-shoe/">Заказать сейчас</a></div>
			<div class="offer-info">
				<span class="likes">4764</span>
				<span class="order">3471</span>
				<span class="price ru">1690 руб</span>			</div>
		</li>
		<li class="the-offer">
			<a class="imga" href="/flat-mop/"><img class="offer-image" src="cms/offer/pic77.jpg" alt="#"></a>
			<div class="offer-name">Flat Mop</div>
			<div class="offer-button"><a href="/flat-mop/">Заказать сейчас</a></div>
			<div class="offer-info">
				<span class="likes">4764</span>
				<span class="order">3471</span>
				<span class="price ru">2990 руб</span>			</div>
		</li>
		<li class="the-offer">
			<a class="imga" href="/hanger/"><img class="offer-image" src="cms/offer/pic82.jpg" alt="#"></a>
			<div class="offer-name">Free Space умное хранение вещей</div>
			<div class="offer-button"><a href="/hanger/">Заказать сейчас</a></div>
			<div class="offer-info">
				<span class="likes">4764</span>
				<span class="order">3471</span>
				<span class="price ru">1190 руб</span>			</div>
		</li>
		<li class="the-offer">
			<a class="imga" href="/magic-clean/"><img class="offer-image" src="cms/offer/pic4.jpg" alt="#"></a>
			<div class="offer-name">Magic-clean - швабра-лентяйка с уникальной системой отжима</div>
			<div class="offer-button"><a href="/magic-clean/">Заказать сейчас</a></div>
			<div class="offer-info">
				<span class="likes">4764</span>
				<span class="order">3471</span>
				<span class="price ru">1690 руб</span>			</div>
		</li>
		<li class="the-offer">
			<a class="imga" href="/egg-boil/"><img class="offer-image" src="cms/offer/pic149.jpg" alt="#"></a>
			<div class="offer-name">Silicone Egg Boil</div>
			<div class="offer-button"><a href="/egg-boil/">Заказать сейчас</a></div>
			<div class="offer-info">
				<span class="likes">4764</span>
				<span class="order">3471</span>
				<span class="price ru">990 руб</span>			</div>
		</li>
		<li class="the-offer">
			<a class="imga" href="/solar-light/"><img class="offer-image" src="cms/offer/pic45.jpg" alt="#"></a>
			<div class="offer-name">Smart Light - ультраяркий светильник с датчиком движения</div>
			<div class="offer-button"><a href="/solar-light/">Заказать сейчас</a></div>
			<div class="offer-info">
				<span class="likes">4764</span>
				<span class="order">3471</span>
				<span class="price ru">1190 руб</span>			</div>
		</li>
		<li class="the-offer">
			<a class="imga" href="/smart-light/"><img class="offer-image" src="cms/offer/pic83.jpg" alt="#"></a>
			<div class="offer-name">Smart Light - включи свет там, где его нет</div>
			<div class="offer-button"><a href="/smart-light/">Заказать сейчас</a></div>
			<div class="offer-info">
				<span class="likes">4764</span>
				<span class="order">3471</span>
				<span class="price ru">1990 руб</span>			</div>
		</li>
		<li class="the-offer">
			<a class="imga" href="/solar-light-1/"><img class="offer-image" src="cms/offer/pic91.jpg" alt="#"></a>
			<div class="offer-name">Solar Light Ландшафтный светильник на солнечной батарее</div>
			<div class="offer-button"><a href="/solar-light-1/">Заказать сейчас</a></div>
			<div class="offer-info">
				<span class="likes">4764</span>
				<span class="order">3471</span>
				<span class="price ru">690 руб</span>			</div>
		</li>
		<li class="the-offer">
			<a class="imga" href="/tooth/"><img class="offer-image" src="cms/offer/pic143.jpg" alt="#"></a>
			<div class="offer-name">Дозатор для зубной пасты</div>
			<div class="offer-button"><a href="/tooth/">Заказать сейчас</a></div>
			<div class="offer-info">
				<span class="likes">4764</span>
				<span class="order">3471</span>
				<span class="price ru">990 руб</span>			</div>
		</li>
		<li class="the-offer">
			<a class="imga" href="/senilar-2/"><img class="offer-image" src="cms/offer/pic89.jpg" alt="#"></a>
			<div class="offer-name">Набор силиконовых крышек SENILAR</div>
			<div class="offer-button"><a href="/senilar-2/">Заказать сейчас</a></div>
			<div class="offer-info">
				<span class="likes">4764</span>
				<span class="order">3471</span>
				<span class="price ru">1190 руб</span>			</div>
		</li>
		<li class="the-offer">
			<a class="imga" href="/organaizer-1/"><img class="offer-image" src="cms/offer/pic140.jpg" alt="#"></a>
			<div class="offer-name">Органайзер для кухни 4в1</div>
			<div class="offer-button"><a href="/organaizer-1/">Заказать сейчас</a></div>
			<div class="offer-info">
				<span class="likes">4764</span>
				<span class="order">3471</span>
				<span class="price ru">1990 руб</span>			</div>
		</li>
		<li class="the-offer">
			<a class="imga" href="/dispenser/"><img class="offer-image" src="cms/offer/pic155.jpg" alt="#"></a>
			<div class="offer-name">Сенсорный диспенсер Dispenser</div>
			<div class="offer-button"><a href="/dispenser/">Заказать сейчас</a></div>
			<div class="offer-info">
				<span class="likes">4764</span>
				<span class="order">3471</span>
				<span class="price ru">1990 руб</span>			</div>
		</li>
		<li class="the-offer">
			<a class="imga" href="/gibkoe-steklo/"><img class="offer-image" src="cms/offer/pic116.jpg" alt="#"></a>
			<div class="offer-name">Скатерть из гибкого стекла</div>
			<div class="offer-button"><a href="/gibkoe-steklo/">Заказать сейчас</a></div>
			<div class="offer-info">
				<span class="likes">4764</span>
				<span class="order">3471</span>
				<span class="price ru">1490 руб</span>			</div>
		</li>
		<li class="the-offer">
			<a class="imga" href="/lp-hanger/"><img class="offer-image" src="cms/offer/111.jpg" alt="#"></a>
			<div class="offer-name">Free Space умное хранение вещей</div>
			<div class="offer-button"><a href="/lp-hanger/">Заказать сейчас</a></div>
			<div class="offer-info">
				<span class="likes">4764</span>
				<span class="order">3471</span>
				<span class="price ru">1190 руб</span>			</div>
		</li>
		 
		<li class="the-offer">
			<a class="imga" href="/clevercutter/"><img class="offer-image" src="cms/offer/pic117.jpg" alt="#"></a>
			<div class="offer-name">Умный нож Clever Cutter</div>
			<div class="offer-button"><a href="/clevercutter/">Заказать сейчас</a></div>
			<div class="offer-info">
				<span class="likes">4764</span>
				<span class="order">3471</span>
				<span class="price ru">1490 руб</span>			</div>
		</li>
		<li class="the-offer">
			<a class="imga" href="/miracle-board/"><img class="offer-image" src="cms/offer/pic128.jpg" alt="#"></a>
			<div class="offer-name">ЧУДО-ДОСКА 3в1</div>
			<div class="offer-button"><a href="/miracle-board/">Заказать сейчас</a></div>
			<div class="offer-info">
				<span class="likes">4764</span>
				<span class="order">3471</span>
				<span class="price ru">1490 руб</span>			</div>
		</li>
		<li class="the-offer">
			<a class="imga" href="/tws/"><img class="offer-image" src="cms/offer/pic129.jpg" alt="#"></a>
			<div class="offer-name">Швабра Titan Twist Mop</div>
			<div class="offer-button"><a href="/tws">Заказать сейчас</a></div>
			<div class="offer-info">
				<span class="likes">4764</span>
				<span class="order">3471</span>
				<span class="price ru">1690 руб</span>			</div>
		</li>
	 
	</ul>
	
	 <div style="text-align: center;margin: 10px auto;display: block;font-size: 14px;line-height: 26px;">
MustHaveOffers - Интернет Магазин Популярных товаров.<br> 
ИНН 330640485495 ОГРНИП 315332600000462<br> 
"Официальный Дистрибьютор на территории РФ"<br> 
Для связи - <a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="a6cbd2c9d1c7d4c9d0e6dfc7c8c2c3de88d4d3">[email&#160;protected]</a><br> 
<a href="polit.html" target="_blank" style="cursor: pointer;color: initial;">Политика конфиденциальности</a><br> 
*На данном сайте действует <br> <a href="https://www.facebook.com/about/privacy/update"  target="_blank" style="cursor: pointer;color: initial;">'Политика использования данных Facebook'</a><br> 
ВСЕ ПРАВА ЗАЩИЩЕНЫ © <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script type="text/javascript">var mdate = new Date(); document.write(mdate.getFullYear());</script>
</div></body>
</html>