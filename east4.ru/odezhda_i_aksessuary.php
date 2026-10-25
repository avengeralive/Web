<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Одежда и Аксессуары</title>
 
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
  
    <h1 style="text-align: center;text-transform: uppercase;color: #808080;margin-bottom: -15px;"> Одежда и Аксессуары</h1> 
	
	
<ul id="offers">
 
		 
		<li class="the-offer">
			<a class="imga" href="/waterstopers"><img class="offer-image" src="cms/offer/pic90.jpg" alt="#"></a>
			<div class="offer-name">Water Stopers Защита обуви</div>
			<div class="offer-button"><a href="/waterstopers">Заказать сейчас</a></div>
			<div class="offer-info">
				<span class="likes">4764</span>
				<span class="order">3471</span>
				<span class="price ru">1190 руб</span>			</div>
		</li>
		
		 
		<li class="the-offer">
			<a class="imga" href="/capsule"><img class="offer-image" src="cms/offer/pic105.jpg" alt="#"></a>
			<div class="offer-name">Капсульный зонтик</div>
			<div class="offer-button"><a href="/capsule">Заказать сейчас</a></div>
			<div class="offer-info">
				<span class="likes">4764</span>
				<span class="order">3471</span>
				<span class="price ru">1890 руб</span>			</div>
		</li>
		
		 
		<li class="the-offer">
			<a class="imga" href="/double-shoe"><img class="offer-image" src="cms/offer/pic120.jpg" alt="#"></a>
			<div class="offer-name">Комплект Double Shoe Racks</div>
			<div class="offer-button"><a href="/double-shoe">Заказать сейчас</a></div>
			<div class="offer-info">
				<span class="likes">4764</span>
				<span class="order">3471</span>
				<span class="price ru">1990 руб</span>			</div>
		</li>
		
		 
		<li class="the-offer">
			<a class="imga" href="/travel-1"><img class="offer-image" src="cms/offer/pic81.jpg" alt="#"></a>
			<div class="offer-name">Набор для путешествий</div>
			<div class="offer-button"><a href="/travel-1">Заказать сейчас</a></div>
			<div class="offer-info">
				<span class="likes">4764</span>
				<span class="order">3471</span>
				<span class="price ru">1690 руб</span>			</div>
		</li>
		
		 
		<li class="the-offer">
			<a class="imga" href="/huggle-socks"><img class="offer-image" src="cms/offer/pic151.jpg" alt="#"></a>
			<div class="offer-name">Плюшевые Носки Huggle Slipper Socks</div>
			<div class="offer-button"><a href="/huggle-socks">Заказать сейчас</a></div>
			<div class="offer-info">
				<span class="likes">4764</span>
				<span class="order">3471</span>
				<span class="price ru">1490 руб</span>			</div>
		</li>
		
		 
		<li class="the-offer">
			<a class="imga" href="/silicone-shoes"><img class="offer-image" src="cms/offer/pic100.jpg" alt="#"></a>
			<div class="offer-name">Силиконовые чехлы для обуви silicone shoes</div>
			<div class="offer-button"><a href="/silicone-shoes">Заказать сейчас</a></div>
			<div class="offer-info">
				<span class="likes">4764</span>
				<span class="order">3471</span>
				<span class="price ru">1490 руб</span>			</div>
		</li>
		
		 
		<li class="the-offer">
			<a class="imga" href="/t-shirt"><img class="offer-image" src="cms/offer/pic103.jpg" alt="#"></a>
			<div class="offer-name">Система хранения для одежды</div>
			<div class="offer-button"><a href="/t-shirt">Заказать сейчас</a></div>
			<div class="offer-info">
				<span class="likes">4764</span>
				<span class="order">3471</span>
				<span class="price ru">1390 руб</span>			</div>
		</li>
		
		 
		<li class="the-offer">
			<a class="imga" href="/rack-organizer"><img class="offer-image" src="cms/offer/pic132.jpg" alt="#"></a>
			<div class="offer-name">Стойка-органайзер для обуви</div>
			<div class="offer-button"><a href="/rack-organizer">Заказать сейчас</a></div>
			<div class="offer-info">
				<span class="likes">4764</span>
				<span class="order">3471</span>
				<span class="price ru">1990 руб</span>			</div>
		</li>
		
		 
		<li class="the-offer">
			<a class="imga" href="/huggle-hoodie"><img class="offer-image" src="cms/offer/pic131.jpg" alt="#"></a>
			<div class="offer-name">Толстовка-плед с капюшоном Huggle Hoodie</div>
			<div class="offer-button"><a href="/huggle-hoodie">Заказать сейчас</a></div>
			<div class="offer-info">
				<span class="likes">4764</span>
				<span class="order">3471</span>
				<span class="price ru">2990 руб</span>			</div>
		</li>
		
		 
 
		
		
		
	</ul>
	
	 <div style="text-align: center;margin: 10px auto;display: block;font-size: 14px;line-height: 26px;">
MustHaveOffers - Интернет Магазин Популярных товаров.<br> 
ИНН 330640485495 ОГРНИП 315332600000462<br> 
"Официальный Дистрибьютор на территории РФ"<br> 
Для связи - <a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="432e372c3422312c35033a222d27263b6d3136">[email&#160;protected]</a><br> 
<a href="polit.html" target="_blank" style="cursor: pointer;color: initial;">Политика конфиденциальности</a><br> 
*На данном сайте действует <br> <a href="https://www.facebook.com/about/privacy/update"  target="_blank" style="cursor: pointer;color: initial;">'Политика использования данных Facebook'</a><br> 
ВСЕ ПРАВА ЗАЩИЩЕНЫ © <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script type="text/javascript">var mdate = new Date(); document.write(mdate.getFullYear());</script>
</div>	 
	 
</body>
</html>