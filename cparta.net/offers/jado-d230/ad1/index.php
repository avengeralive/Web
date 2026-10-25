<?php 
   $offer = 370;
   include_once $_SERVER['DOCUMENT_ROOT'].'/../includes/landingsData/index2.php';
?> 
<!DOCTYPE html>
<html lang="ru">
<head>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

<script>


window.app = {
    timestamp: parseInt((new Date()).getTime() / 1000),
    jq: jQuery,
    formAction: window.location.href,
    leadToken: '5db7614a478da8.39366414',
    offers: {"12176":{"country":{"code":"RU","name":"\u0420\u043e\u0441\u0441\u0438\u044f"},"currency":{"code":"RUB","name":"\u0440\u0443\u0431"},"discount":"60%","prepaid_info_html":"","product_sku":"","link":"","price2":"7450","price":"2990","delivery_price":"","id":12176}},
    currentOffer: {"country":{"code":"RU","name":"\u0420\u043e\u0441\u0441\u0438\u044f"},"currency":{"code":"RUB","name":"\u0440\u0443\u0431"},"discount":"60%","prepaid_info_html":"","product_sku":"","link":"","price2":"7450","price":"2990","delivery_price":"","id":12176},
    allowedCountries: ["RU"],
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


</script><script src="/shared/form.validate.js?10"></script>
<script src="/shared/form.incomplete.js?10"></script>
<script src="/shared/main2.js?12"></script>



    <!-- Содержимое HEAD индексного файла -->
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистратор JADO D230</title>
    <meta name="keywords" content="">
    <!-- <meta name="description" content=""> -->
    <link rel="shortcut icon" href="assets/img/favicon.ico" type="image/x-icon">
    <link rel="icon" href="assets/img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/reset.css" type="text/css">
    <link rel="stylesheet" href="assets/css/GothamPro.css" type="text/css">
    <link rel="stylesheet" href="assets/css/slick.css" type="text/css">
    <link rel="stylesheet" href="assets/css/settings.css" type="text/css">
    <link rel="stylesheet" href="assets/css/main.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="assets/css/roboto.css">    <!-- Содержимое, помещаемое в HEAD -->


</head>
<body>
<!-- Содержимое, помещаемое в начало BODY -->


<section class="head-block">
    <div class="wrap">
        <div class="main-title">
            <!-- <span>Нанопокрытие</span> -->
            <h1>Регистратор <span>JADO D230</span></h1>
            <div class="sub-main-title"><span>универсальное зеркало с двумя камерами</span> и парковочным ассистентом</div>
        </div>
        <div class="main-sale">
            <div>
                Акция!
                <strong>60%</strong>
                скидка
            </div>
        </div>
        <div class="cost-cont clearfix">
            <div class="old-cost">
                Обычная цена:
                <strong><x-oldprice>7450</x-oldprice><x-currency>руб</x-currency></strong>
            </div>
            <div class="new-cost">
                <strong><x-newprice><?php echo $price['real_price']; ?></x-newprice></strong>
            </div>
            <a class="button-m" href="#buy">Сделать заказ</a>
        </div>
    </div>
</section>

<section class="sup-block">
    <div class="wrap">
        <ul class="list-type-v2 list-sup">
          <li>
                <div class="list-cont">
                    <p>Сенсорный дисплей 10"<br>Выносная камера (парктроник)</p>
                </div>
            </li>
            <li>
                <div class="list-cont">
                    <p>Угол обзора 160 градусов<br>Видео FullHD 1920х1080P</p>
                </div>
            </li>
            <li>
                <div class="list-cont">
                    <p>G-сенсор (датчик удара)<br>Радар-детектор</p>
                </div>
            </li>
            <li>
                <div class="list-cont">
                    <p>Технология WDR<br>LDWS контроль полос</p>
                </div>
            </li>
        </ul>
    </div>
</section>

<section class="about-block">
    <div class="wrap">
        <h2 class="lvl-title-v1">Регистратор <strong class="col-1">JADO D230</strong></h2>
        <div class="container-text">
            <p>Регистратор JADO D230 оборудовано двумя камерами и парковочным ассистентом. Модель считается универсальным, удобным и «умным» помощником за счет практичного крепления двух камер и комфортного в использовании LCD-дисплея (9,35 дюймов). Важно, что изображения с камер выводятся здесь в режиме реального времени, то есть гаджет вполне заменяет стандартное зеркало заднего вида и обеспечивает еще больше возможностей. Экран для демонстрации картинки занимает практически весь «полезный объем» передней панели.</p>
        </div>
        <div class="video-frame">
            <div class="video-cont">
                <iframe width="100%" height="315" src="https://www.youtube.com/embed/DQ1toSq-z7s?rel=0&amp;showinfo=0" frameborder="0" allow="encrypted-media" allowfullscreen=""></iframe>
            </div>
        </div>
    </div>
</section>

<section class="demo-block">
    <div class="wrap">
        <ul class="list-type-v2 list-sup">
           <li>
                <img class="list-img" src="assets/img/sup-1.png" alt="">
                <div class="list-cont">
                    <p>Гибкость настроек позволяет включать и выключать отдельные точки GPS</p>
                </div>
            </li>
            <li>
                <img class="list-img" src="assets/img/sup-2.png" alt="">
                <div class="list-cont">
                    <p>JADO D230 переходит в режим «парктороник» при заглушенном двигателе</p>
                </div>
            </li>
            <li>
                <img class="list-img" src="assets/img/sup-3.png" alt="">
                <div class="list-cont">
                    <p>На яркий экран регистратора выводится полная информация о дорожной ситуации</p>
                </div>
            </li>
            <li>
                <img class="list-img" src="assets/img/sup-4.png" alt="">
                <div class="list-cont">
                    <p>Сенсорное управление позволит максимально удобно управлять регистратором</p>
                </div>
            </li>
        </ul>
        <h2 class="lvl-title-v1">Особенности регистратора<strong class="col-1"> JADO D230</strong></h2>
        <div class="wrap-ops">
            <div class="op">
                <img src="assets/img/op1.png" alt="">
                <h3>100% отсутствие ложных срабатываний</h3>
                <p>Отличительной особенностью модели является использование передового радар-детектора с сигнатурной технологией детектирования. JADO D230 содержит все существующие камеры и радары, установленные на дорогах, что обеспечивает невероятно точное определение угроз, а также максимально эффективно устраняет ложные срабатывания.</p>
            </div>
            <div class="op">
                <img src="assets/img/op2.png" alt="">
                <h3>Высокое качество съемки</h3>
                <p>Регистратор JADO D230 оснащен высокочувствительной матрицей, а также объективом с 6-ю стеклянными линзами. Эта техническая база позволяет видеорегистратору снимать видео с высочайшим FULL HD разрешением при 30 кадрах в секунду и получать максимально качественную картинку и в дневное, и в ночное время.</p>
            </div>
            <div class="op">
                <img src="assets/img/op3.png" alt="">
                <h3>LDWS контроль полос движения</h3>
                <p>Система контроля полосы движения – это технология, предупреждающая о том, что возможен скорый сход с полосы движения автомобиля. В первую очередь технология контроля позволяет держаться выбранного участка дороги, исключая возможность несанкционированного съезда с пути. Видеорегистратор способен уменьшать количество аварий.</p>
            </div>
            <div class="op">
                <img src="assets/img/op4.png" alt="">
                <h3>GPS-приемник</h3>
                <p>Наличие встроенного GPS приемника в видеорегистраторе JADO D230, накладывает на видео штамп даты, времени и скорости, а также позволяет непрерывно записывать информацию о местоположении, скорости и высоте над уровнем моря, а также предупреждать о приближении к камерам контроля скорости.</p>
            </div>
            <div class="op">
                <img src="assets/img/op5.png" alt="">
                <h3>Датчик удара</h3>
                <p>При срабатывании датчика удара, видеорегистратор мгновенно начинает запись нестираемого видео для последующего анализа события и помещает его в нестираемый буфер памяти. Встроенный G-сенсор с регулировкой чувствительности фиксирует столкновение, резкое торможение или ускорение.</p>
            </div>
            <div class="op">
                <img src="assets/img/op6.png" alt="">
                <h3>Широкий угол обзора</h3>
                <p>Благодаря широкоугольному объективу из 7 линз и углом обзора 160 градусов, регистратор охватывает все 5 полос дорожного полотна, при этом не искажая картинку, что позволяет заснять все происходящее снаружи автомобиля до мельчайших подробностей. Видеорегистратор зафиксирует действительно все, что происходит на дороге.</p>
            </div>
            <div class="op">
                <img src="assets/img/op7.png" alt="">
                <h3>Качество WDR</h3>
                <p>Технология позволяет JADO D230 записывать информативное видео неизменно высокого качества, даже в условиях резких перепадов освещенности. Благодаря WDR съёмка ведётся с разным временем экспозиции, после чего участки с тёмным и светлым изображением интегрируются в единую четкую картинку.</p>
            </div>
            <div class="op">
                <img src="assets/img/op8.png" alt="">
                <h3>Беспроводные возможности</h3>
                <p>Встроенный Wi-Fi модуль позволяет осуществлять удаленную настройку, просмотр и загрузку видео с видеорегистратора JADO D230 на планшет или смартфон с помощью специальной программы для Android и iOS (доступна для бесплатного скачивания и установки в Google Play и Apple Store).</p>
            </div>
        </div>
    </div>
</section>

<section class="expert-block">
    <div class="wrap">
        <h2 class="lvl-title-v1"><strong class="col-1">Технические характеристики</strong></h2>
        <table cellspacing="0" cellpadding="15" width="100%" height="130">
            <tbody>
                <tr>
                    <td>Процессор</td>
                    <td>Ambarella A7LA70</td>
                </tr>
                <tr>
                    <td>Матрица</td>
                    <td>OmniVision OV2710</td>
                </tr>
                <tr>
                    <td>Камера</td>
                    <td>5Мп, угол обзора 160°</td>
                </tr>
                <tr>
                    <td>Монитор</td>
                    <td>LCD 10" - автоматическое отключение</td>
                </tr>
                <tr>
                    <td>Количество каналов видео</td>
                    <td>Два</td>
                </tr>
                <tr>
                    <td>Количество каналов аудио</td>
                    <td>один, синхронное наложение на оба видео</td>
                </tr>
                <tr>
                    <td>Разрешение записи передней камеры</td>
                    <td>1920X1080p 30 к/с</td>
                </tr>
                <tr>
                    <td>Разрешение записи задней камеры</td>
                    <td>1280X720p 30 к/с</td>
                </tr>
                <tr>
                    <td>Сжатие, кодек</td>
                    <td>H.264</td>
                </tr>
                <tr>
                    <td>Формат видеофайла</td>
                    <td>МР4</td>
                </tr>
                <tr>
                    <td>Карта памяти</td>
                    <td>Micro SD, класс не ниже 6-го, до 64Гб</td>
                </tr>
                <tr>
                    <td>G sersor</td>
                    <td>есть</td>
                </tr>
                <tr>
                    <td>USB</td>
                    <td>micro USB</td>
                </tr>
                <tr>
                    <td>Динамик</td>
                    <td>есть, регулировка громкости через меню</td>
                </tr>
                <tr>
                    <td>Циклическая запись</td>
                    <td>режимы - 2мин, 3мин, 5 мин</td>
                </tr>
                <tr>
                    <td>Автоматическое включение</td>
                    <td>есть, при подаче питания</td>
                </tr>
                <tr>
                    <td>Автоматическое выключение</td>
                    <td>есть, при отключении питания</td>
                </tr>
                <tr>
                    <td>Наложение информации на кадр</td>
                    <td>дата, время, координаты, скорость и т.п.</td>
                </tr>
                <tr>
                    <td>Защита файлов от перезаписи</td>
                    <td>есть, кнопкой или с G-сенсором</td>
                </tr>
                <tr>
                    <td>Язык меню</td>
                    <td>русский, английский</td>
                </tr>
                <tr>
                    <td>Аккумуляторная батарея</td>
                    <td>450мА</td>
                </tr>
            </tbody>
        </table>
    </div>
</section>

<section class="use-block">
    <div class="wrap">
        <h2 class="lvl-title-v1"><strong class="col-1">Комплектация</strong></h2>
        <ul class="list-type-v3 list-use">
            <li>
                <span class="list-img">1</span>
                <div class="list-cont">
                    <p>ЗЕРКАЛО - ВИДЕОРЕГИСТРАТОР  FULL HD 1080</p>
                </div>
            </li>
            <li>
                <span class="list-img">2</span>
                <div class="list-cont">
                    <p>ДОПОЛНИТЕЛЬНАЯ КАМЕРА ЗАДНЕГО ВИДА</p>
                </div>
            </li>
            <li>
                <span class="list-img">3</span>
                <div class="list-cont">
                    <p>СОЕДИНИТЕЛЬНЫЕ ПРОВОДА, 6М.</p>
                </div>
            </li>
            <li>
                <span class="list-img">4</span>
                <div class="list-cont">
                    <p>АВТОМОБИЛЬНЫЙ АДАПТЕР 12В</p>
                </div>
            </li>
            <li>
                <span class="list-img">5</span>
                <div class="list-cont">
                    <p>КОМПЛЕКТ КРЕПЛЕНИЙ (ПОДХОДИТ ДЛЯ ВСЕХ АВТО)</p>
                </div>
            </li>
            <li>
                <span class="list-img">6</span>
                <div class="list-cont">
                    <p>USB КАБЕЛЬ</p>
                </div>
            </li>
            <li>
                <span class="list-img">7</span>
                <div class="list-cont">
                    <p>ИНСТРУКЦИЯ НА РУССКОМ ЯЗЫКЕ</p>
                </div>
            </li>
        </ul>
    </div>
</section>

<section class="review-block">
    <div class="wrap">
        <h2 class="title">Отзывы покупателей</h2>
        <div class="container clearfix">
            <div class="rev-item clearfix">
                <img class="rev-img" src="assets/img/rev-1.png" alt="">
                <div class="rev-cont">
                    <img class="rev-img-s" src="assets/img/rev-1-m.jpg" alt="">
                    <h4>Андрей Соколов <small>43 года</small></h4>
                    <p>Друзья рекомендовали купить видеорегистратор, занялся поиском подходящей модели. Остановился на JADO D230, потому что 2 камеры и хорошая картинка экрана в зеркале. Цена порадовала, поэтому решение принял очень быстро о покупке.</p>
                </div>
            </div>
            <div class="rev-item clearfix">
                <img class="rev-img" src="assets/img/rev-2.png" alt="">
                <div class="rev-cont">
                    <img class="rev-img-s" src="assets/img/rev-2-m.jpg" alt="">
                    <h4>Борис Шилов <small>34 года</small></h4>
                    <p>Я за рулём уже больше 20 лет, поменял уже несколько машин. Когда увидел такое предложение - заинтересовался, потому что не раз были моменты недопонимания гаишниками. Действительно хорошая штука – видеорегистратор с двумя камерами 3 в 1, появилось некое чувство защищённости от автоподстав и т. п. на дорогах.</p>
                </div>
            </div>
            <div class="rev-item clearfix">
                <img class="rev-img" src="assets/img/rev-3.png" alt="">
                <div class="rev-cont">
                    <img class="rev-img-s" src="assets/img/rev-3-m.jpg" alt="">
                    <h4>Владимир Козырев <small>30 лет</small></h4>
                    <p>Для меня важно было получить хороший обзор заднего вида, и чтобы регистратор вписывался в салон автомобиля. Живу в большом городе, за руль сел не так давно и были постоянные проблемы с парковкой и в пробках. И во итоге заказал видеозеркало, доставили в течение 3 дней.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="deliv-block">
    <div class="wrap">
        <h2 class="lvl-title-v1">Как сделать <strong class="col-1">Заказ?</strong></h2>
        <ul class="list-type-v3 list-deliv">
            <li>
                <img class="list-img" src="assets/img/del-1.png" alt="">
                <div class="list-cont">
                    <h4>Доставка</h4>
                    <p>Почтой, бандеролями 1-го класса в течение 3-7 рабочих дней</p>
                </div>
            </li>
            <li>
                <img class="list-img" src="assets/img/del-2.png" alt="">
                <div class="list-cont">
                    <h4>Оплата</h4>
                    <p>Оплата заказа осуществляется по факту получения товара на руки</p>
                </div>
            </li>
            <li>
                <img class="list-img" src="assets/img/del-3.png" alt="">
                <div class="list-cont">
                    <h4>Гарантии</h4>
                    <p>Мы всегда проверяем товар перед отправкой и гарантируем 100% качество</p>
                </div>
            </li>
        </ul>
    </div>
</section>

<section class="order-block">
    <div class="wrap clearfix">
        <div class="main-title">
            
            <h1>Регистратор <span>JADO D230</span></h1>
            <div class="sub-main-title"><span>универсальное зеркало с двумя камерами</span> и парковочным ассистентом</div>
        </div>
        <div class="main-reminder clearfix"><span>30</span> регистраторов осталось по специальной цене</div>
        <div class="main-sale">
            <div>
                Акция!
                <strong>60%</strong>
                скидка
            </div>
        </div>
        <div class="main-form" id="buy">
            <div class="main-timer">
                <h4>Акция закончится через:</h4>
                <div class="timer-box-v1"><div class="timer-num"><span>1</span><span>2</span><small>часов</small></div><div class="timer-num"><span>2</span><span>4</span><small>минут</small></div><div class="timer-num"><span>1</span><span>4</span><small>секунд</small></div></div>
            </div>
            <div class="cost-cont clearfix">
                <div class="old-cost">
                    Обычная цена:
                    <strong><x-oldprice>7450</x-oldprice><x-currency>руб</x-currency></strong>
                </div>
                <div class="new-cost">
                    <strong><x-newprice><?php echo $price['real_price']; ?></x-newprice></strong>
                </div>
            </div>
			  
			  <form class="m1-form-site" action="./_success_/" method="post">
			  	    <input type='hidden' name='referer' value="<?php echo isset($_GET['referer']) ? $_GET['referer'] : $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] ;?>">
<input type="hidden" name="subid1"  value="<?php echo isset($_GET['subid1']) ? $_GET['subid1'] : '' ;?>" />
<input type="hidden" name="subid2"  value="<?php echo isset($_GET['subid2']) ? $_GET['subid2'] : '' ;?>" />
<input type="hidden" name="subid3"  value="<?php echo isset($_GET['subid3']) ? $_GET['subid3'] : '' ;?>" />
<input type="hidden" name="subid4"  value="<?php echo isset($_GET['subid4']) ? $_GET['subid4'] : '' ;?>" />  
<input type="hidden" name="subid5"  value="<?php echo isset($_GET['subid5']) ? $_GET['subid5'] : '' ;?>" />

                    <div><input type="text" name="name" placeholder="Введите ваше имя" required></div>
                <div><input type="tel" name="phone" placeholder="Введите телефон" required></div>
                <div><button class="button-m">Заказать сейчас</button></div>
                            </form>
			
        </div>
    </div>
</section>

<section class="copyright">
    <p>ИНН 7723834427 КПП 772501001 ОГРН 1127746289032 ООО "Прайд"</p>
<p>115470, Москва, набережная Нагатинская, ДОМ 46</p> 

  
              <p class="tlight-link">
<!--        <a class="nav-link" target="_blank" href="--><?//= $default_main_site ?><!--">Партнёрская программа TLight </a>-->
      </p>
    
    
            <p class="conf-link doclinks">

      </p>
      
<!--       <p class="policy-link doclinks"> -->
<!--         <a class="nav-link"  href="" onclick="window.open('http://xshopgood.com/policy2.php'); return false;">Условия оформления заказа</a> -->
<!--       </p> -->

    
</section>

<script src="assets/js/jquery.js" type="text/javascript"></script>
<script src="assets/js/slick.min.js" type="text/javascript"></script>
<script src="assets/js/init.js" type="text/javascript"></script>

<link rel="stylesheet" href="yved/style.css" type="text/css" />
<link href="comeback/ComebackerAlert.css" rel="stylesheet" type="text/css" />
    <script src="comeback/ComebackerAlert.js" type="text/javascript"></script>




<!-- Содержимое, помещаемое в конец BODY -->

<style>.form-control {
    display: block;
    outline: 0;
    border: 0;
    width: 100%;
    height: 60px;
    margin: 0 auto;
    background: #fff;
    text-align: center;
    font-size: 17px;
    font-family: "Gotham Pro", Helvetica, Arial, sans-serif;
    font-weight: 400;  
    border: 1px solid #dedede;
    border-radius: 4px;
}</style>

<script>    
    var mainNow = 0;    
    var productPrice = 2990;
    var productPriceOld = 7450;
    var productPricePromo = 5220;
    var productCurrency = 'руб';
    var client_city = 'Rostov-on-Don';
    
    function check_bottom_margin(){
        
        var margin_bottom = 0;
        
        if ($('.plugin-quick-order').length || $('#promocode-block').length) {            
            margin_bottom = 80;            
        }  
        
        if ($('.plugin-delivery-notify').length) {            
            $('.plugin-delivery-notify').css('bottom', margin_bottom);
            margin_bottom = 180;
        } 
        
        if ($('.plugin-visitors-online-notify').length) {            
            $('.plugin-visitors-online-notify').css('bottom', margin_bottom);
            margin_bottom = 180;
        } 
    }
</script>

<style>
    #recall-btn {display: none;}
    .recall-animation {
        width: 90px;
        height: 90px;        
        text-align: center;
        position: fixed;
        margin: 0;
        padding: 10px;
        border-radius: 100%;
        border: solid 5px #fff;
        animation: play 2s ease infinite;
        -webkit-backface-visibility: hidden;
        -moz-backface-visibility: hidden;
        -ms-backface-visibility: hidden;
        backface-visibility: hidden;
        background-color: #fff;
        z-index: 99999;
        right: 1%;
        bottom: 100px;    
        -webkit-box-sizing: unset;
        -moz-box-sizing: unset;
        box-sizing: unset;           
    }
    .recall-animation img {
        width: 90px;
        height: 90px;
        border-radius: 100%;
        background-color: rgb(255, 162, 53);
        /*position: absolute;*/
        /*left: 10px;
        top: 10px;*/
        cursor: pointer;
        
    }
    @keyframes play {
        0% {transform: scale(1);}
        15% {box-shadow: 0 0 0 5px rgba(255, 162, 53, 0.4);}
        25% {box-shadow: 0 0 0 10px rgba(255, 162, 53, 0.4), 0 0 0 20px rgba(255, 162, 53, 0.2);}
        25% {box-shadow: 0 0 0 15px rgba(255, 162, 53, 0.4), 0 0 0 30px rgba(255, 162, 53, 0.2);}
    }
</style>

<script>
    $(function () {

        $("body").append('<div id="recall-btn"></div>');

        var callObj = '<div class="recall-animation"><img src="/shared/plugins/icons/phone-white.png" alt="Перезвонить" /></div>'
        $('#recall-btn').html(callObj);


        $('#recall-btn').click(function () {
            var form_selector = $("#recall-form");
            PopupModal.modalShow(form_selector);            
            clearTimeout(PopupModal.timerId);
            $("#overlay-popup-recall").show();
            $("input[name=from_recall_button]", form_selector).val(1);
        });

        setTimeout(function () {
            $("#recall-btn").show();
        }, 10000);

        $(function () {


            $(document).on("click", ".recallmodal", function (event) {                
                if (event.target != this) {
                    return false;
                } else {
                    PopupModal.modalHide($(this).closest(".recallmodal"));                    
                }
            }).on("click", ".close-recall", function (event) {
                if (event.target != this) {
                    return false;
                } else {
                    PopupModal.modalHide($(this).closest(".recallmodal"));
                    PopupModal.panelQuickOrderShow();
                }
            }).on("keydown", function (key) {
                if (key.keyCode == 27) {
                    PopupModal.modalHide($(".recallmodal:visible:last"));
                }
            }).on("click", ".recallmodal > *", function (event) {
                event.stopPropagation();
                return true;
            });
        });
    });
</script>
</body>
</html>