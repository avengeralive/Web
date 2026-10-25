<?php 
   $offer = 104;
   include_once $_SERVER['DOCUMENT_ROOT'].'/../includes/landingsData/index2.php';
?> 
<!DOCTYPE html>
<html>
<head>
<script src=" https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="js/jquery.countdown.js"></script>
<script src="js/timer.js"></script>
<script src="js/jquery.bxslider.min.js"></script>
<script src="js/scroolly.min.js"></script>
<script src="js/main.js"></script>
<meta charset="UTF-8">
<title>КАРОНАСТОП Травяной сбор для иммунитета</title>
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&amp;subset=cyrillic,cyrillic-ext,latin-ext" rel="stylesheet">
<meta name="viewport" content="initial-scale=1, maximum-scale=1, width=device-width" />
<link rel="shortcut icon" href="img/uniq-favicon.ico"type="image/x-icon">
<link rel="stylesheet" href="css/jquery.bxslider.css">
<link rel="stylesheet" href="css/main.css">
<link type="text/css" rel="stylesheet" href="css/visitors.css-1.css">
<script type="text/javascript" src="https://promo2020.ru/static/js/lt_landing_valid_form.js"></script>
<script type="text/javascript" src="https://promo2020.ru/static/js/lt_landing_script.js"></script>

<!-- LT code insertion -->
<!-- /LT code insertion -->
</head>
<body>
<div class="main-wrapp">
  <header id="block1" class="block">
    <div class="wrapper">
      <ul class="stamp-list">
        <li class="stamp-item"> <img src="img/uniq-stamp1.png">
          <p>Народный выбор</p>
        </li>
        <li class="stamp-item"> <img src="img/uniq-stamp3.png">
          <p>100% натурально</p>
        </li>
      </ul>
      <h2 class="title title-b1"><span class="text-red">КАРОНАСТОП</span></h2>
      <h3 class="subtitle subtitle-b1"> <span class="green-fon">Травяной сбор для иммунитета</span></h3>
      <div class="bl1-center"> <img src="img/uniq-prod-head.png" class="prod-header">
        <ul class="icon-green">
          <li><img src="img/uniq-icon-green2.png"></li>
        </ul>
      </div>
      <ul class="plus-prod">
        <li><span class="borderGreen">Поддерживает </span> иммунитет</li>
        <li><span class="borderGreen">В сборе собрано </span> 16 трав</li>
        <li><span class="borderGreen">Все растения </span> собраны в чистейших экологических местах</li>
      </ul>
      <div class="block-form" >
        <div class="green-fon before-form">
          <div class="" id="timer"></div>
        </div>
        <div class="price-block">
          <p class="price-title">Закажи сейчас</p>
          <p class="new-price"><span class="price_land_s3 real_price">
            <x-newprice class="productsum"><?php echo $price['real_price']; ?></x-newprice>
            </span></p>
          <p class="old-price"><span class="price_land_s4 old_price">
            <x-oldprice class="oldproductsum">1990</x-oldprice>
            </span></p>
        </div>
        <form action="./_success_/" method="post" class="form">
          <select name="country" class="countryselect form-control country_chang"><option selected value='RU'>Россия</option></select>
          <input name="name" value="" placeholder="Ваше имя" type="text">
          <input name="phone" value="" placeholder="Телефон" type="tel">
          <input type='hidden' name='referer' value="<?php echo isset($_GET['referer']) ? $_GET['referer'] : $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] ;?>">
<input type="hidden" name="subid1"  value="<?php echo isset($_GET['subid1']) ? $_GET['subid1'] : '' ;?>" />
<input type="hidden" name="subid2"  value="<?php echo isset($_GET['subid2']) ? $_GET['subid2'] : '' ;?>" />
<input type="hidden" name="subid3"  value="<?php echo isset($_GET['subid3']) ? $_GET['subid3'] : '' ;?>" />
<input type="hidden" name="subid4"  value="<?php echo isset($_GET['subid4']) ? $_GET['subid4'] : '' ;?>" />  
<input type="hidden" name="subid5"  value="<?php echo isset($_GET['subid5']) ? $_GET['subid5'] : '' ;?>" />
			<div class="reolader">
				<button type="submit" class="mm_button btn js_submit" onclick="checkFields(event, this);">Купить со скидкой</button>
				<div class="ajax_loader_block"><img class="ajax_loader" src="img/uniq-ajax-loader.gif" alt="Идет отправка данных"> <span class="ajax_loader">Идет отправка данных</span></div>
			</div>
			<input type="hidden" name="productsum" value="<?php echo $price['real_price']; ?> руб." />
			<input type="hidden" name="delivery" value="0 руб." />
			<input type="hidden" name="totalsum" value="<?php echo $price['real_price']; ?> руб." />
			<input type="hidden" name="user" value="1" />
			<input type="hidden" name="address" value="Уточнить у покупателя" />
        </form>
        <div class="cl"></div>
      </div>
      <img src="img/uniq-fruit.png" alt="" class="fruit"> <img src="img/uniq-girl-b1.png" alt="" class="girl-b1">
      <div class="cl"></div>
    </div>
  </header>
  <section id="block2" class="block">
    <div class="wrapper">
      <div class="block2-desc borderGreen-block">
        <h2 class="title title-b2">Что такое <span class="prod-color">КАРОНАСТОП</span>?</h2>
        <p>Богатая травяная наполненность травяного сбора делает его безопасным и экологически чистым, а не просто полезным.</p>
        <p>При ослабленном иммунитете, а также при профилактике инфекционных и вирусных заболеваний вы можете получить все целебные вещества натуральных природных продуктов из травяного сбора «КАРОНАСТОП». Из него готовится чай, который поможет поднять иммунитет и даже поможет справиться с вирусным и инфекционным заболеванием. </p>
        <p>На сегодняшний день огромным спросом пользуется травяной сбор «КАРОНАСТОП». Популярность обоснована прежде всего тем, что в сборе собрано 16 трав, благодаря чему средство способно оказывать помощь в поддержании иммунитета, широко при этом воздействуя на все внутренние органы. Известность о целебном воздействие напитка распространилась достаточно быстро, его эффективность была оценена многими людьми, которым он значительно улучшил качество жизни и оказал существенную помощь в поддержке иммунитета в период вирусных и инфекционных  заболеваний, а также в борьбе с различными заболеваниями.</p>
        <p>В составе присутствуют замечательные растения, суммирующий эффект взаимодействия которых и дает положительный результат. Травяной сбор «КАРОНАСТОП» нужно правильно заваривать, время настаивания не менее тридцати минут. Еще важно помнить, что ни один травяной сбор не даст никакого эффекта если выпить его два или три раза, так как все травы имеют накопительный эффект, и такие средства надо пить регулярно и курсами, каждый курс не менее месяца.</p>
        <p>В сбор входят шестнадцать трав. Самостоятельно такой напиток сделать достаточно сложно, просто потому, что в одном месте найти все травы сразу не представляется возможным. Все растения должны быть собраны в чистейших экологических местах. Но и, пожалуй, основным моментом, почему люди не рискуют делать такой сбор самостоятельно, о чем нередко нам пишут в отзывах – это незнание пропорций. Даже если все травы найдены, нужно знать сколько каждой травы добавить в напиток, чтобы получить от него максимум пользы для организма. Ведь растение это как таблетка, если соблюдать дозировку - оно поможет, если уменьшить количество – эффекта не будет, а вот если переборщить, то можно не только не помочь себе, а просто на просто навредить. </p>
      </div>
      <img src="img/uniq-girl-b2.png" alt="" class="girl-b2">
      <div class="cl"></div>
    </div>
  </section>
  <section id="block3" class="block">
    <div class="wrapper">
      <center>
        <h2 class="title title-b4-1">Состав</h2>
      </center>
      <br>
      <ul class="list3">
        <li class="list3-item"> <img src="img/sostav/uniq-1.jpg" class="list3-img">
          <p>Молодая крапива</p>
          <p style="font-size: 12px;">Снимает интоксикацию, выводит токсины, повышает гемоглобин и улучшает состав крови, делает процесс кроветворения быстрым, снимает воспаления. </p>
        </li>
        <li class="list3-item"> <img src="img/sostav/uniq-2.jpg" class="list3-img">
          <p>Чабрец</p>
          <p style="font-size: 12px;">Также останавливает воспалительные процессы, останавливает развитие вирусных клеток, их размножение и деление. </p>
        </li>
        <li class="list3-item"> <img src="img/sostav/uniq-3.jpg" class="list3-img">
          <p>Бессмертник</p>
          <p style="font-size: 12px;">Для пищеварения очень полезная трава: обладает желчегонным действием, снижает уровень холестерина, что является важным в процессе поддержки иммунитета. </p>
        </li>
        <li class="list3-item"> <img src="img/sostav/uniq-4.jpg" class="list3-img">
          <p>Шалфей</p>
          <p style="font-size: 12px;">Природный антибиотик содержащий хром, марганец, магний, цинк, никель и множество других микроэлементов. Укрепляет сосуды, улучшает работу сердечной мышцы, нормализует деятельность желудочно-кишечной системы. </p>
        </li>
        <li class="list3-item"> <img src="img/sostav/uniq-5.jpg" class="list3-img">
          <p>Крушина</p>
          <p style="font-size: 12px;">В сборе эта трава для поддержания работы щитовидной железы (в ней много йода), она влияет на синтез гормонов, помогает обновлению клеток плазмы крови, улучшает усвоение фосфора и кальция. </p>
        </li>
        <li class="list3-item"> <img src="img/sostav/uniq-6.jpg" class="list3-img">
          <p>Почки березы</p>
          <p style="font-size: 12px;">Для ослабленного организма в них есть почти всё: алюминий, марганец, никель, бор и др. Березовые почки в сборе «КАРОНАСТОП» повышают сопротивляемость организма инфекциям. </p>
        </li>
        <li class="list3-item"> <img src="img/sostav/uniq-7.jpg" class="list3-img">
          <p>Цветы липы</p>
          <p style="font-size: 12px;">Содержит медь, которая необходима при кроветворении, помогает выработке инсулина и гормонов гипофиза. Улучшает метаболизм на клеточном уровне.</p>
        </li>
        <li class="list3-item"> <img src="img/sostav/uniq-8.jpg" class="list3-img">
          <p>Пустырник</p>
          <p style="font-size: 12px;">Известный успокоитель нервных окончаний. Кроме того, что он имеет успокаивающее действие на центральную нервную систему, он снимает боль, снижает артериальное давление.</p>
        </li>
        <li class="list3-item"> <img src="img/sostav/uniq-9.jpg" class="list3-img">
          <p>Сушеница топяная</p>
          <p style="font-size: 12px;">Помощь почкам в восстановлении клеток и их построению, восстановлению компенсированному кровообращению, снижению давления.</p>
        </li>
        <li class="list3-item"> <img src="img/sostav/uniq-10.jpg" class="list3-img">
          <p>Толокнянка</p>
          <p style="font-size: 12px;">В ней много антиоксидантов, флавонидов и некоторых элементов противостоящих развитию мутаций, в т.ч. росту вирусных клеток. Мочегонное.</p>
        </li>
        <li class="list3-item"> <img src="img/sostav/uniq-11.jpg" class="list3-img">
          <p>Шиповник</p>
          <p style="font-size: 12px;">Много антиоксидантов и витамина С, которые повышают устойчивость организма перед инфекциями. В нем очень много микроэлементов, флавоноидов, кислот и витаминов. </p>
        </li>
        <li class="list3-item"> <img src="img/sostav/uniq-12.jpg" class="list3-img">
          <p>Череда</p>
          <p style="font-size: 12px;">Положительно влияет на процессы кроветворения, свертываемости крови. Стимулирует работу надпочечных желез.</p>
        </li>
        <li class="list3-item"> <img src="img/sostav/uniq-13.jpg" class="list3-img">
          <p>Тысячелистник</p>
          <p style="font-size: 12px;">Обладает сильным противовоспалительным свойством, восстанавливает работу многих систем организма, усиливает желчегонные процессы.</p>
        </li>
        <li class="list3-item"> <img src="img/sostav/uniq-14.jpg" class="list3-img">
          <p>Кошачья лапка</p>
          <p style="font-size: 12px;">Принимают при спазмах мускулатуры и сосудов. Как и многие травы в останавливает рост вредных микроорганизмов. Кошачья лапка-трава помогает работе сердца и ЖКТ.</p>
        </li>
        <li class="list3-item"> <img src="img/sostav/uniq-15.jpg" class="list3-img">
          <p>Полынь</p>
          <p style="font-size: 12px;">Она усиливает свойства бессмертника, обладает сильными противомикробными и противовоспалительными свойствами, работает и как обезболивающее. Полынь известна как желчегонное средство и помогает работе желудка.</p>
        </li>
        <li class="list3-item"> <img src="img/sostav/uniq-16.jpg" class="list3-img">
          <p>Ромашка</p>
          <p style="font-size: 12px;">Помогает устойчивости иммунитета, известна как успокоитель аллергических реакций,  содержит море полезных микроэлементов.</p>
        </li>
      </ul>
      <div class="cl"></div>
    </div>
  </section>
  <section id="block7" class="block">
    <div class="wrapper">
      <h2 class="title title-b7"><strong>Способ приготовления</strong> </h2>
      <div class="bl7-desc borderGreen-block">
        <ul class="list7">
          <li class="list7-item"> <img src="img/uniq-1.png">
            <p> <span class="borderGreen">&nbsp;<strong>1 чайную ложку </strong></span> добавить на стакан кипятка 250-300мл. </p>
          </li>
          <li class="list7-item"> <img src="img/uniq-2.png">
            <p><span class="borderGreen">&nbsp;<strong>Дать хорошо настояться </strong></span> не менее 20 минут, лучше полчаса. </p>
          </li>
          <li class="list7-item"> <img src="img/uniq-3.png">
            <p><span class="borderGreen">&nbsp;<strong>Употреблять </strong></span> 2-3 раза в день. Пить перед едой. </p>
          </li>
          <li class="list7-item"> <img src="img/uniq-4.png">
            <p><span class="borderGreen">&nbsp;<strong>Рекомендуемый курс </strong></span> применения - 3 месяца. </p>
          </li>
        </ul>
      </div>
    </div>
  </section>
  <section id="block9" class="block">
    <div class="wrapper">
      <h2 class="title title-b9">Успей заказать <span class="text-red">со&nbsp;скидкой&nbsp;<span class="price_land_s4">50%</span></span> </h2>
      <ul class="stamp-list">
        <li class="stamp-item"> <img src="img/uniq-stamp1.png">
          <p>Народный выбор</p>
        </li>
        <li class="stamp-item"> <img src="img/uniq-stamp3.png">
          <p>100% натурально</p>
        </li>
      </ul>
      <div class="bl9-center"> <img src="img/uniq-prod-head.png">
        <ul class="icon-green">
          <li><img src="img/uniq-icon-green2.png"></li>
        </ul>
        <div class="cl"></div>
      </div>
      <div class="block-form" id="order-form-top">
        <div class="green-fon before-form">
          <div class="" id="timer3"></div>
        </div>
        <div class="price-block">
          <p class="price-title">Закажи сейчас</p>
          <p class="new-price"><span class="price_land_s3 real_price">
            <x-newprice class="productsum"><?php echo $price['real_price']; ?></x-newprice>
            </span></p>
          <p class="old-price"><span class="price_land_s4 old_price">
            <x-oldprice class="oldproductsum">1990</x-oldprice>
            </span></p>
        </div>
        <form action="./_success_/" id="order-form-bottom2" method="post" class="form">
          <select name="country" class="countryselect form-control country_chang"><option selected value='RU'>Россия</option></select>
          <input name="name" value="" placeholder="Ваше имя" type="text">
          <input name="phone" value=""  placeholder="Телефон" type="tel">
          <input type='hidden' name='referer' value="<?php echo isset($_GET['referer']) ? $_GET['referer'] : $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] ;?>">
<input type="hidden" name="subid1"  value="<?php echo isset($_GET['subid1']) ? $_GET['subid1'] : '' ;?>" />
<input type="hidden" name="subid2"  value="<?php echo isset($_GET['subid2']) ? $_GET['subid2'] : '' ;?>" />
<input type="hidden" name="subid3"  value="<?php echo isset($_GET['subid3']) ? $_GET['subid3'] : '' ;?>" />
<input type="hidden" name="subid4"  value="<?php echo isset($_GET['subid4']) ? $_GET['subid4'] : '' ;?>" />  
<input type="hidden" name="subid5"  value="<?php echo isset($_GET['subid5']) ? $_GET['subid5'] : '' ;?>" />
			<div class="reolader">
				<button type="submit" class="mm_button btn js_submit" onclick="checkFields(event, this);">Купить со скидкой</button>
				<div class="ajax_loader_block"><img class="ajax_loader" src="img/uniq-ajax-loader.gif" alt="Идет отправка данных"> <span class="ajax_loader">Идет отправка данных</span></div>
			</div>
			<input type="hidden" name="productsum" value="<?php echo $price['real_price']; ?> руб." />
			<input type="hidden" name="delivery" value="0 руб." />
			<input type="hidden" name="totalsum" value="<?php echo $price['real_price']; ?> руб." />
			<input type="hidden" name="user" value="1" />
			<input type="hidden" name="address" value="Уточнить у покупателя" />
        </form>
        <div class="cl"></div>
      </div>
      <div class="cl"></div>
      <div class="delivery-block">
        <p>Не является лекарственным препаратом.</p>
      </div>
      <div class="cl"></div>
    </div>
  </section>
  <footer id="copyright" class="block">
    <div class="wrapper">
      <div class="copyright">
        <center>
		<p style="padding-bottom: 10px;">ООО "Универсал-Торг" ОГРН 1037821045855 ИНН 7810282250 199155 Санкт-Петербург, ул. Одоевского, 33а</p>
		<!--<p><img src="img/uniq-leadtrade.png"></p>-->
		<p style="padding-top: 10px;"><a href="politika.html" target="_blank">Политика конфиденциальности</a> <br><a href="agreement.html" target="_blank">Пользовательское соглашение</a></p>
        </center>
      </div>
    </div>
  </footer>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('a[href^="#"]').on('click',function (e) {
            e.preventDefault();

            var target = this.hash;
            var $target = $(target);

            $('html, body').stop().animate({
                'scrollTop': $target.offset().top
            }, 900, 'swing', function () {
                window.location.hash = target;
            });
        });
    });
</script>
</body>
</html>