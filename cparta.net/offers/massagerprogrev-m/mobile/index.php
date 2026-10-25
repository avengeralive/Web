<?php 
   $offer = 18;
   include_once $_SERVER['DOCUMENT_ROOT'].'/../includes/landingsData/index2.php';
?> 
<!DOCTYPE html>
<html lang="ru-RU">
<head>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script>

window.app = {
    timestamp: parseInt((new Date()).getTime() / 1000),
    jq: jQuery,
    formAction: window.location.href,
    leadToken: '5e089329108112.56984831',
    offers: {"13450":{"link":"","price":"99","price2":"198","id":13450,"currency":{"code":"BYR","name":"Br"},"product_sku":"","delivery_price":"","discount":"","country":{"code":"BY","name":"\u0411\u0435\u043b\u0430\u0440\u0443\u0441\u044c"},"prepaid_info_html":""},"13457":{"link":"","price":"2990","price2":"5980","id":13457,"currency":{"code":"RUB","name":"\u0440\u0443\u0431"},"product_sku":"","delivery_price":"","discount":"","country":{"code":"RU","name":"\u0420\u043e\u0441\u0441\u0438\u044f"},"prepaid_info_html":""}},
    currentOffer: {"link":"","price":"2990","price2":"5980","id":13457,"currency":{"code":"RUB","name":"\u0440\u0443\u0431"},"product_sku":"","delivery_price":"","discount":"","country":{"code":"RU","name":"\u0420\u043e\u0441\u0441\u0438\u044f"},"prepaid_info_html":""},
    allowedCountries: ["BY","RU"],
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

</script>

	<meta charset="UTF-8">
	<meta name="viewport" content="width=480">
	<title>Массажер для шеи и спины</title>
	<meta name="description" content="Массажер для шеи">
    <link rel="stylesheet" href="7w0buxl3.css" > 
<link rel="shortcut icon" href="favicon.ico"type="image/x-icon">
 
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
  
</div>
<script src=" https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<div class="main_wrapper">
		<header class="offer_section offer3">
			<h1 class="main_title">Массажер для шеи и спины с прогревом&nbsp;</h1>
			<div class="info_block">
				<p class="subtitle">профессиональный массажист у вас дома!</p>
				<div class="discount"><b>-50% скидка</b></div>
				<img src="4qch0s0x.jpg"  alt="">
			</div>
			<div class="price_block">
				<div class="price_item old">
					<div class="text">Обычная цена:</div>
					<div class="value"><x-oldprice>5980</x-oldprice> <x-currency>руб</x-currency></div>
				</div>
				<div class="price_item new">
					<div class="text">Цена сегодня:</div>
					<div class="value"><x-newprice><?php echo $price['real_price']; ?></x-newprice></div>
				</div>
			</div>
			<div class="benefits_block clearfix">
				<div class="benefit_item">
					<img src="g0o3bekf.jpg"  alt="">
					<p><span style="font-size:11.0pt;line-height:107%;
font-family:'Calibri',sans-serif;mso-ascii-theme-font:minor-latin;mso-fareast-font-family:
Calibri;mso-fareast-theme-font:minor-latin;mso-hansi-theme-font:minor-latin;
mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:minor-bidi;
mso-ansi-language:RU;mso-fareast-language:EN-US;mso-bidi-language:AR-SA">Две пары массажных роликов.</span></p>
				</div>
				<div class="benefit_item">
					<img src="jjs1srge.jpg"  alt="">
					<p>Функция теплового прогревания.</p>
				</div>
				<div class="benefit_item">
					<img src="ndky84dd.jpg"  alt="">
					<p><span style="font-size:11.0pt;line-height:107%;
font-family:'Calibri',sans-serif;mso-ascii-theme-font:minor-latin;mso-fareast-font-family:
Calibri;mso-fareast-theme-font:minor-latin;mso-hansi-theme-font:minor-latin;
mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:minor-bidi;
mso-ansi-language:RU;mso-fareast-language:EN-US;mso-bidi-language:AR-SA">Ручные ремни для увеличения массажной нагрузки.</span></p>
				</div>
				<h2 class="title"><span>Забудь о забитых&nbsp;</span><br>мышцах шеи</h2>
				<img class="image" src="5nme56kz.jpg"  alt="">
				<img class="image" src="9hebj7gx.jpg"  alt="">
				<img class="image" src="abj_0id8.jpg"  alt="">
			</div>
			<div class="timer_block clearfix">
				<p>Предложение действует:</p>
				<div class="timer clearfix">
					<div class="timer_item">
						<div class="count hours"><span>0</span><span>1</span></div>
						<div class="text">часов</div>
					</div>
					<div class="timer_item">
						<div class="count minutes"><span>4</span><span>2</span></div>
						<div class="text">минут</div>
					</div>
					<div class="timer_item">
						<div class="count seconds"><span>2</span><span>2</span></div>
						<div class="text">секунд</div>
					</div>
				</div>
			</div>
			<a href="#order_form" class="button">Оформить заказ</a>
			<div class="products_count">Осталось <b>9</b>&nbsp;массажеров по акции</div>
		</header>
        <div class="benefits_list7">
            <div class="benefit_item clearfix">
				<img src="dwbi4u-7.jpg"  alt="">
				<div class="text_block">
					<h4>Шиацу массаж</h4>
					<p><span style="font-size:11.0pt;line-height:107%;
font-family:'Calibri',sans-serif;mso-ascii-theme-font:minor-latin;mso-fareast-font-family:
Calibri;mso-fareast-theme-font:minor-latin;mso-hansi-theme-font:minor-latin;
mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:minor-bidi;
mso-ansi-language:RU;mso-fareast-language:EN-US;mso-bidi-language:AR-SA">Снимает мышечное напряжение, разминая и расслабляя тело, ускоряя кровоток и избавляя от неприятных ощущений.</span></p>
				</div>
			</div>
			<div class="benefit_item clearfix">
				<img src="9hebj7gx-2.jpg"  alt="">
				<div class="text_block">
					<h4>прогревание</h4>
					<p>Инфракрасное прогревание способствует расслаблению, снимает усталость, понижает давление и усиливает эффективность массажа.&nbsp;</p>
				</div>
			</div>
			<div class="benefit_item clearfix">
				<img src="abj_0id8-2.jpg"  alt="">
				<div class="text_block">
					<h4>Расслабление&nbsp;</h4>
					<p>Снижает боли и отеки в зоне спины и позвоночника. Способствует восстановлению нормализации жизненного тонуса мышц.</p>
				</div>
			</div>
		</div>
		<section class="description_section">
			<h2 class="title"><span></span>&nbsp;Массаж в любое время</h2>
			<img class="image" src="mq1yld6h.jpg"  alt="">
			<p>Массаж - отличная профилактика множества заболеваний позвоночника, позволяющая , кроме того, избавиться от накопившейся усталости.</p>
<p>Массажные ролики имитируют действия рук массажиста, даря вам незабываемые ощущения.Усиливает кровообращение и лимфоток. Снимает головную боль и боль в шее!</p>
		</section>
		<div class="video_block">
            <iframe width="100%" height="100%" src="https://www.youtube.com/embed/mMOak4kr66U" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
		</div>
		<section class="description_section">
			<h2 class="title"><span>Массажер для шеи</span><br></h2>
			<img class="image" src="hvzje8xj.jpg"  alt="">
			<a href="#order_form" class="button">Оформить заказ</a>
		</section>
		<section class="characteristics_section">
			<h2 class="title"><span>Характеристики</span><br>Массажера</h2>
			<ul class="characteristics__list"> 
				<li><b>Размеры:</b>41мм/50мм/17мм</li>
				<li><b>Вес:</b>1,240г</li> 
			</ul>
		</section>
                <div class="video_block">
                    <iframe width="100%" height="100%" src="https://www.youtube.com/embed/e7QtB4InrUQ" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
		</div>
		<section class="reviews2_section gray_theme">
			<h2 class="title">Отзывы <span>покупателей</span></h2>
			<div class="reviews_list owl-carousel">
				<div class="review_item">
					<img class="photo" src="lzpg9q3x.jpg"  alt="">
					<p> Реальный массирующий массажер. Да-да, именно массирует, как большими руками здорового дяди. Именно такой и должен быть массажер - мощный, ощутимый, и эффективный. Массажер очень мощный, действительно получаешь пользу и удовольствие после каждой процедуры. Массирует практически все участки тела. Шею, ноги, попу, поясницу, позвоночник, живот, руки, в общем, куда захотите, туда и прикладываете его. В рабочем состоянии он еще и оригинально светится, в темноте это выглядит достаточно впечатляюще. И что больше всего мне понравилось, он практически не шумит, можно смело релаксировать без посторонних раздражающих шумов. </p>
					<div class="author_block clearfix">
						<img src="s-8d-no0.jpg"  alt="">
						<div class="author_info">
							<div class="name">Вероника&nbsp;</div>
							<div class="text">34 года</div>
						</div>
					</div>
				</div>
				<div class="review_item">
					<img class="photo" src="roln5dwv.png"  alt="">
					<p>Это третий массажёр) Думаю, что он не последний) Ещё куча родственников имеется))). Сама пользуюсь регулярно. Раньше были "забиты" мышщы шейно-грудного отдела и постоянно болела голова (из-за хондроза!!!) сейчас намного лучше стало и голова меньше стала болеть) По товару нареканий нет. Беру только в этом магазине. Продавец надёжный. Магазин рекомендую)</p>
					<div class="author_block clearfix">
						<img src="mw-8ezv2.jpg"  alt="">
						<div class="author_info">
							<div class="name">Светлана Фомина</div>
							<div class="text">31 год</div>
						</div>
					</div>
				</div>
				<div class="review_item">
					<img class="photo" src="u9qk9qtt.png"  alt="">
					<p>Если не орден то медаль изобретателю за эту штуку дать надо бы. КЛАСС. Моя спина говорит - спасибо. Огромное. Посмотрим конечно сколько это чудо проработает, но аппарат покупки стоит. Однозначно!!! Рекомендую и массажер и продавца.</p>
					<div class="author_block clearfix">
						<img src="pe35var1.jpg"  alt="">
						<div class="author_info">
							<div class="name">Ольга Клименко</div>
							<div class="text">30 лет</div>
						</div>
					</div>
				</div>
			</div>
		</section>
        <section class="tlt">
            <h2 class="title"><span>Как сделать</span> заказ?</h2>
        </section>
		<div class="order_steps1">
			<div class="step_item">
				<div class="step_wrapper">
					<img src="xb36g0d4.png"  alt="">
					<h4>Заявка</h4>
					<p>Заполните форму на сайте</p>
				</div>
			</div>
			<div class="step_item">
				<div class="step_wrapper">
					<img src="1vv3xb-2.png"  alt="">
					<h4>Звонок</h4>
					<p>Наш менеджер перезвонит для уточнения деталей</p>
				</div>
			</div>
			<div class="step_item">
				<div class="step_wrapper">
					<img src="4qzbbnw1.png"  alt="">
					<h4>Отправка</h4>
					<p>Доставка курьером на следуюший день<br>.</p>
				</div>
			</div>
			<div class="step_item">
				<div class="step_wrapper">
					<img src="7kr_g0s0.png"  alt="">
					<h4>Получение</h4>
					<p>Оплачиваете при получении  </p>
				</div>
			</div>
		</div>
		<section class="offer_section offer3 order">
			<h1 class="main_title">Массажер для шеи и спины с прогревом</h1>
			<div class="info_block">
				<p class="subtitle">профессиональный массажист у вас дома!</p>
				<div class="discount"><b>-50% скидка</b></div>
				<img src="4qch0s0x.jpg"  alt="">
			</div>
			<div class="price_block clearfix">
				<div class="price_item old">
					<div class="text">Обычная цена:</div>
					<div class="value"><x-oldprice>5980</x-oldprice> <x-currency>руб</x-currency></div>
				</div>
				<div class="price_item new">
					<div class="text">Цена сегодня:</div>
					<div class="value"><x-newprice><?php echo $price['real_price']; ?></x-newprice></div>
				</div>
			</div>
			<div class="benefits_block clearfix">
				<div class="benefit_item">
					<img src="g0o3bekf.jpg"  alt="">
					<p>Две пары массажных роликов</p>
				</div>
				<div class="benefit_item">
					<img src="jjs1srge.jpg"  alt="">
					<p>Функция теплового прогревания</p>
				</div>
				<div class="benefit_item">
					<img src="ndky84dd.jpg"  alt="">
					<p>Ручные ремни для увеличения массажной нагрузки</p>
				</div>
			</div>
			<div class="timer_block clearfix">
				<p>Предложение действует:</p>
				<div class="timer clearfix">
					<div class="timer_item">
						<div class="count hours"><span>0</span><span>1</span></div>
						<div class="text">часов</div>
					</div>
					<div class="timer_item">
						<div class="count minutes"><span>4</span><span>2</span></div>
						<div class="text">минут</div>
					</div>
					<div class="timer_item">
						<div class="count seconds"><span>2</span><span>2</span></div>
						<div class="text">секунд</div>
					</div>
				</div>
			</div>
			<form id="order_form" action="./_success_/" method="post" name="order-form">      
				<input class="field" name="name" required  placeholder="Введите Ваше Ф.И.О."  type="text">
				<input class="field" name="phone" required  placeholder="Введите Ваш телефон"  type="tel">
				<button class="button">Оформить заказ</button>
				<input type='hidden' name='referer' value="<?php echo isset($_GET['referer']) ? $_GET['referer'] : $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] ;?>">
<input type="hidden" name="subid1"  value="<?php echo isset($_GET['subid1']) ? $_GET['subid1'] : '' ;?>" />
<input type="hidden" name="subid2"  value="<?php echo isset($_GET['subid2']) ? $_GET['subid2'] : '' ;?>" />
<input type="hidden" name="subid3"  value="<?php echo isset($_GET['subid3']) ? $_GET['subid3'] : '' ;?>" />
<input type="hidden" name="subid4"  value="<?php echo isset($_GET['subid4']) ? $_GET['subid4'] : '' ;?>" />  
<input type="hidden" name="subid5"  value="<?php echo isset($_GET['subid5']) ? $_GET['subid5'] : '' ;?>" />
			</form>
			<div class="products_count">Осталось <b>9</b>&nbsp;массажеров по акции</div>
		</section>
		<footer class="footer_section">
		  <div style="text-align: center;margin: 10px auto;display: block;font-size: 14px;line-height: 26px;">
<p>ОБЩЕСТВО С ОГРАНИЧЕННОЙ ОТВЕТСТВЕННОСТЬЮ "ТОРГОВЫЙ ДОМ" ИНН 7720743411 ОГРН	1127746152973</p>
<p>г. Москва, проезд Перова Поля 2-Й, д. 5</p> 

  
              <p class="tlight-link">

      </p>
    
    
            <p class="conf-link doclinks">

      </p>
      


    
</div>  
		</footer>
	</div>
<script src=" https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="sf3w_uec.js" ></script>
<script src="v75hk0ku.js" ></script>
<script src="oojgjhzb.js" ></script>

<style>
.form-control{background: rgb(221, 221, 221) none repeat scroll 0% 0%; display: block; margin: 0px auto 20px; padding: 0px 20px 0px 62px; width: 370px; height: 72px; border: medium none; border-radius: 5px; font-family: "Montserrat",sans-serif; font-weight: 400; font-size: 16px; color: rgb(119, 119, 119); }
</style>
</body>

</html>