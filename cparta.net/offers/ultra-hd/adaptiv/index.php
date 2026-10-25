<?php 
   $offer = 48;
   include_once $_SERVER['DOCUMENT_ROOT'].'/../includes/landingsData/index2.php';
?> 
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>ULTRA HD 4K</title>
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700&amp;subset=cyrillic,cyrillic-ext" rel="stylesheet">
</head>

<body>
    <div id="menu">
        <div class="content">
            <div class="links1">
                <a href="#">главная</a>
                <a href="#character">характеристики</a>
                <a href="#feedback">отзывы</a>
                <a href="#delivery">доставка</a>
                <a href="#delivery">гарантии</a>
                <a href="#galery" class="invis">галерея</a>
                <a href="#video" class="invis">видео</a>
            </div>
            <a href="#commer">
                <button class="green1">заказать звонок</button>
            </a>
        </div>
    </div>
    <section id="header">
        <div class="header-block">
            СУПЕР КАЧЕСТВО СЪЕМКИ, ПОТРЯСАЮЩИЙ СТЕРЕОЗВУК, ФАНТАСТИЧЕСКАЯ СТАБИЛИЗАЦИЯ!
        </div>
        <div id="block1" class="content">
            <h1>Экшн Камера ULTRA HD 4K</h1>
            <div class="cam1"></div>
            <div class="ring">-55%</div>
            <p class="conc">Ведущий конкурент <span style="color:#01D5ED;">GOPRO HERO</span>, не уступающий
                <br> по своей мощности и функционалу. Инновационная
                <br> Экшн Камера ULTRA HD 4K</p>
            <div class="p_price">
                <div class="p_old">
                    <p>Обычная цена:<span>6644р</span></p>
                </div>
                <div class="p_new">
                    <p>Цена сегодня:<span><?php echo $price['real_price']; ?></span></p>
                </div>
            </div>
            <div class="forms">
                <form action="./_success_/" method="post">
                    <input type='hidden' name='referer' value="<?php echo isset($_GET['referer']) ? $_GET['referer'] : $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] ;?>">
<input type="hidden" name="subid1"  value="<?php echo isset($_GET['subid1']) ? $_GET['subid1'] : '' ;?>" />
<input type="hidden" name="subid2"  value="<?php echo isset($_GET['subid2']) ? $_GET['subid2'] : '' ;?>" />
<input type="hidden" name="subid3"  value="<?php echo isset($_GET['subid3']) ? $_GET['subid3'] : '' ;?>" />
<input type="hidden" name="subid4"  value="<?php echo isset($_GET['subid4']) ? $_GET['subid4'] : '' ;?>" />  
<input type="hidden" name="subid5"  value="<?php echo isset($_GET['subid5']) ? $_GET['subid5'] : '' ;?>" />
                    <p class="ostav">Оставь заявку
                        <br> и получи подробную
                        <br> консультацию специалиста</p>
                    <input type="text" class="form1" name="name" placeholder="Ваше Имя" required>
                    <!-- <select class="form1 country_select" name="country" id="country"><option value='BY'>Беларусь</option><option value='KZ' selected="selected">Казахстан</option><option value='RU'>Россия</option> </select> -->
                    <input type="text" class="form1" name="phone" placeholder="Ваш телефон" required>
                    <button class="green1" type="submit">ЗАКАЗАТЬ ЗВОНОК</button>
                </form>
                <div class="counter">
                  
                   <script src="//megatimer.ru/get/eda42191856ba92420bea9ba7daaffbe.js"></script>
                  
                </div>
            </div>
        </div>
    </section>
    <div class="clear"></div>
    <section id="video">
        <div id="block2" class="content">
            <h2 class="black">Видеообзор</h2>
            <div class="clear"></div>
            <video width="480" controls poster="img/video-preview.png" >
                <source src="rolik.m4v">
                Ваш браузер не воспроисходит видео.
            </video>
        </div>
    </section>
    <section id="character">
        <div id="block3" class="content">
            <h2 class="white">
               ХАРАКТЕРИСТИКИ ЭКШН КАМЕРЫ ULTRA HD 4K 
            </h2>
            <div class="imagesx"><img src="img/blok3camera.png" alt=""><!-- <img src="img/char-3.png" alt="">--></div> 
            <p style="    text-align: center;
            color: white;
            margin: 165px 0 10px;">ULTRA HD 4K</p>
            <table cellspacing="0px;">
                <!-- <tr>
                    <td class="first"></td>
                    <td class="first white">ULTRA HD 4K</td>
                </tr> -->
                <tr>
                    <td class="wit bold">Материал</td>
                    <td class="wit">пластик, металл
                    </td>
                </tr>
                <tr>
                    <td class="blu bold">Матрица</td>
                    <td class="blu">CMOS 1/3, Aptina AR0330</td>
                </tr>
                <tr>
                    <td class="wit bold">Аккумулятор</td>
                    <td class="wit">900 мАh</td>
                </tr>
                <tr>
                    <td class="blu bold">Экран</td>
                    <td class="blu">LCD 2.0 LTPS</td>
                </tr>
                <tr>
                    <td class="wit bold">Разрешение видео</td>
                    <td class="wit">4K = 3840 x 2160, 1080P = 1920 x 1080, 720P=1280 x 720, VGA=640 x 480</td>
                </tr>
                <tr>
                    <td class="blu bold">Формат изображения</td>
                    <td class="blu">JPEG, JPG</td>
                </tr>
                <tr>
                    <td class="wit bold">Микрофон</td>
                    <td class="wit">встроенный</td>
                </tr>
                <tr>
                    <td class="blu bold">Время съемки</td>
                    <td class="blu">75 минут 15 кадров/с 1080P</td>
                </tr>
                <tr>
                    <td class="wit bold">Память</td>
                    <td class="wit">micro SD не более 32 Гб</td>
                </tr>
                <tr>
                    <td class="blu bold">Размер упаковки</td>
                    <td class="blu">27 x 16 x 6 см</td>
                </tr>
                <tr>
                    <td class="wit bold">Вес упаковки</td>
                    <td class="wit">335 гр</td>
                </tr>
                <tr>
                    <td class="blu bold" style="border-top: 1px solid #999; padding-left: 0"><b><span style="display: inline-block; padding-left: 40px;"></span>КОМПЛЕКТАЦИЯ</b></td>
                    <td class="blu" style="border-top: 1px solid #999; padding-left: 0;"><p style="margin: 10px 0;"><span style="padding-left: 40px;"></span>Камера</p>
                        <p style="padding: 10px 0 10px; background-color: #D9D9DA;"><span style="padding-left: 40px;"></span>Герметичный бокс</p>
                        <p style="padding: 10px 0 10px;"><span style="padding-left: 40px;"></span>Пластиковая рамка</p>
                        <p style="padding: 10px 0 10px; background-color: #D9D9DA;"><span style="padding-left: 40px;"></span>Клип</p>
                        <p style="padding: 10px 0 10px;"><span style="padding-left: 40px;"></span>Ремешки для крепления камеры 4 шт.</p>
                        <p style="padding: 10px 0 10px; background-color: #D9D9DA;"><span style="padding-left: 40px;"></span>USB кабель</p>
                        <p style="padding: 10px 0 10px;"><span style="padding-left: 40px;"</span>Аксессуары для установки 3 шт.</p>
                        <p style="padding: 10px 0 10px; background-color: #D9D9DA;"><span style="padding-left: 40px;"</span>Инструкция на английском языке</td>
                </tr>
                <!-- <tr>
                    <td class="last white bold">Стоимость</td>
                    <td class="last newprice1 bold"><b class="price_land_s1">21990</b> <b class="price_land_curr">тнг.</b></td>
                </tr> -->
            </table>
            <div class="p_price">
                <div class="p_old">
                    <p>Обычная цена:<span>6644р</span></p>
                </div>
                <div class="p_new">
                    <p>Цена сегодня:<span><?php echo $price['real_price']; ?></span></p>
                </div>
            </div>
            <div class="counter">
               <script src="//megatimer.ru/get/eda42191856ba92420bea9ba7daaffbe.js"></script>
            </div>
            <a href="#commer">
                <button class="green1">заказать по акции</button>
            </a>
        </div>
    </section>
    <section id="feedback">
        <div id="block4" class="content">
            <h2>Отзывы наших покупателей</h2>
            <div class="otzyv">
                <div class="ava linki"></div>
                <div class="textfeed">
                    <p class="nameof">Андрей Васюков, 35 лет, г. Волгоград</p>
                    <p class="feed">Не так давно я стал прыгать с парашютом. Нужно было купить хорошую камеру, так как у всех были в группе. И надо было снимать для себя, чтобы потом смотреть и анализировать. Я купил камеру ULTRA HD 4K и не пожалел. Качество фото и видео на высоте. И она не только на шлем может крепиться, я так же как регистратор использую в машине. Доволен и за такие деньги это недорого.
                    </p>
                </div>
            </div>
            <div class="otzyv">
                <div class="ava linki2"></div>
                <div class="textfeed">
                    <p class="nameof">Максим Проворов, 19 лет, г. Омск</p>
                    <p class="feed">Я катаюсь на велосипеде. Скатываясь с холма, не заметил кочку и перелетел через руль. При падении сломалась моя старая камера. Покупал ее 3 года назад. Пришлось новую искать. Попал на этот сайт. Почитал и посмотрел - решил купить. Получил неделю назад. Камера показала на 5 баллов себя. Не глючит и отличное крепление.
                    </p>
                </div>
            </div>
            <div class="otzyv">
                <div class="ava linki3"></div>
                <div class="textfeed">
                    <p class="nameof">Иван Кондрашов, 25 лет, г. Екатеринбург</p>
                    <p class="feed">Моя брендовая камера сломалась. Покупать такую же не хотелось, дорого. Нашел этот магазин с предложением. За 2690 я купил, это нормальная цена. Причем камера очень похожа на GoPro. Оказалась и в пользовании одинаковой. По качеству съемки не уступила дорогой. А это самое главное. Я кстати занимаюсь дайвингом.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <section id="galery">
        <div id="block5" class="content">
            <h2 class="white">галерея</h2>
            <div class="imagest">
                <a data-fancybox="gallery" href="img/gallery/gallery1.jpg"><img src="img/gallery/gallery1.jpg"></a>
                <a data-fancybox="gallery" href="img/gallery/gallery2.jpg"><img src="img/gallery/gallery2.jpg"></a>
                <a data-fancybox="gallery" href="img/gallery/gallery3.jpg"><img src="img/gallery/gallery3.jpg"></a>
                <a data-fancybox="gallery" href="img/gallery/gallery4.jpg"><img src="img/gallery/gallery4.jpg"></a>
                <a data-fancybox="gallery" href="img/gallery/gallery5.jpg"><img src="img/gallery/gallery5.jpg"></a>
                <a data-fancybox="gallery" href="img/gallery/gallery6.jpg"><img src="img/gallery/gallery6.jpg"></a>
                <a data-fancybox="gallery" href="img/gallery/gallery7.jpg"><img src="img/gallery/gallery7.jpg"></a>
                <a data-fancybox="gallery" href="img/gallery/gallery8.jpg"><img src="img/gallery/gallery8.jpg"></a>
                <a data-fancybox="gallery" href="img/gallery/gallery9.jpg"><img src="img/gallery/gallery9.jpg"></a>
                <a data-fancybox="gallery" href="img/gallery/gallery10.jpg"><img src="img/gallery/gallery10.jpg"></a>
                <a data-fancybox="gallery" href="img/gallery/gallery11.jpg"><img src="img/gallery/gallery11.jpg"></a>
                <a data-fancybox="gallery" href="img/gallery/gallery12.jpg"><img src="img/gallery/gallery12.jpg"></a>
            </div>
        </div>
    </section>
    <section class="map">
        <img src="img/russian-map.jpg" alt="">
        <!-- <p>Более 1500 клиентов в России уже пользуются экшн камерой ULTRA HD 4K!</p> -->
    </section>
    <section id="reasons">
        <div id="block6" class="content">
            <h2 class="black">10 причин, почему Экшн камера ULTRA HD 4K тебе просто НЕОБХОДИМА</h2>
            <!-- <div class="image6"></div> -->
            <div class="listing">
                <div class="row tleft">
                    <img src="img/steps/1.jpg" alt="">
                    <p class="first">Преодоление препятствий, борьба против стихии, азарт - все это запечатлит экшн камера ULTRA HD 4K и ты всегда сможешь в полной мере насладиться своими достижениями!</p>
                </div>
                <div class="row tright">
                    <img src="img/steps/2.jpg" alt="">
                    <p class="second">Отрабатывай приемы и анализируй, стремись делать то, что не сумеют сделать другие и запечатли результат с помощью ULTRA HD 4K камеры. Тогда ни у кого не останется вопросов - ты лучший!</p>
                </div>
                <div class="row tleft">
                    <img src="img/steps/3.jpg" alt="">
                    <p class="third">Экшн камера сохранит для тебя яркие воспоминания о красоте природы тех мест, где удалось побывать, напомнит о чувстве скорости и приливе адреналина в тот момент, когда ты шел на риск.</p>
                </div>
                <div class="row tright">
                    <img src="img/steps/4.jpg" alt="">
                    <p class="fourth">Стремишься начать зарабатывать на своем хобби и жить в свое удовольствие? ULTRA HD 4K тебе в этом поможет.</p>
                </div>
                <div class="row tleft">
                    <img src="img/steps/5.jpg" alt="">
                    <p class="fifth">Желаешь доказать себе и всему миру что ты лучше других, можешь больше других и то, что ты самый сумасшедший человек, для которого нет предела и ограничений? - ты номер один! С экшн камерой ULTRA HD 4K это возможно!</p>
                </div>
                <div class="row tright">
                    <img src="img/steps/6.jpg" alt="">
                    <p class="sixth">Хочешь получать эстетическое удовольствие от просмотра своих фишек и производить впечатление на девушек своими крутыми трюками? Запиши все на экшн камеру! И пусть сверстники  завидуют, ведь у тебя есть - ULTRA HD 4K!</p>
                </div>
                <div class="row tleft">
                    <img src="img/steps/7.jpg" alt="">
                    <p class="seventh">Мечтаешь набрать большое количество подписчиков и получить всеобщее признание? - забирай ULTRA HD 4K и действуй!</p>
                </div>
                <div class="row tright">
                    <img src="img/steps/8.jpg" alt="">
                    <p class="eigth">Хочешь хранить память о лучших моментах жизни: как твой ребенок сделал первые шаги, впервые начал кататься на велосипеде или начал плавать самостоятельно? Правильно, лови момент! - Бери экшн камеру ULTRA HD 4K!</p>
                </div>
                <div class="row tleft">
                    <img src="img/steps/9.JPG" alt="">
                    <p class="ninth">Ты занимаешься дайвингом и хочешь снимать яркие классные ролики про жизнь подводного мира для себя или зарабатывать на этом деньги? ULTRA HD 4K - лучший выбор!</p>
                </div>
                <div class="row tright">
                    <img src="img/steps/10.jpg" alt="">
                    <p class="tenth">Хочешь показать, что ты не такой как все и не можешь жить в тесной клетке как другие? Ты свободная птица и полеты в небе - твоя жизнь! - Снимай все на ULTRA HD 4K!</p>
                </div>
            </div>
            <div class="p_price">
                <div class="p_old">
                    <p>Обычная цена:<span>6644р</span></p>
                </div>
                <div class="p_new">
                    <p>Цена сегодня:<span><?php echo $price['real_price']; ?></span></p>
                </div>
            </div>
            <div class="counter">
                <script src="//megatimer.ru/get/eda42191856ba92420bea9ba7daaffbe.js"></script>  
            </div>
            <a href="#forma2">
                <button class="green1">заказать по акции</button>
            </a>
        </div>
    </section>
    <section id="how">
        <div id="block7" class="content">
            <h2 class="black">КАК СДЕЛАТЬ ЗАКАЗ В НАШЕМ МАГАЗИНЕ, ОФОРМИТЬ ДОСТАВКУ И ПОЛУЧИТЬ ТОВАР</h2>
            <div class="pack">
                <div class="stack">
                    <img src="img/compose.png" alt="">
                    <p>Оставьте заявку на нашем сайте</p>
                </div>
                <div class="stack">
                    <img src="img/phone-1.png" alt="">
                    <p>Вам позвонит наш менеджер, чтобы уточнить детали заказа</p>
                </div>
                <div class="stack">
                    <img src="img/truck.png" alt="">
                    <p>Мы отправляем заказ к Вам</p>
                </div>
                <div class="stack">
                    <img src="img/check.png" alt="">
                    <p>Вы получаете посылку и проверяете целостность товара</p>
                </div>
                <div class="stack">
                    <img src="img/payment.png" alt="">
                    <p>Если Вас все устраивает, оплачиваете заказ и забираете товар</p>
                </div>
            </div>
        </div>
    </section>
    <section id="delivery">
        <div id="block8" class="content">
            <h2 class="black">Доставка и оплата</h2>
            <div class="claster">
                <img src="img/post.png" style="max-width: 200px;" alt="">
                <p><b>Доставка Почтой</b>
                    <br>Мы доверяем Вам и не требуем предоплаты. Мы уважаем Ваше время и, поэтому, все заказы отправляем только бандеролями 1 класса. Вы можете забрать и оплатить свой заказ на почте в любое удобное для Вас время. Посылка дойдет до Вас быстро и без единой царапины. Чтобы ускорить прибытие Вашего заказа, мы отправляем бандероли два раза в день, включая выходные дни. Доставка почтой осуществляется в течение 3-10 рабочих дней. Возможна доставка курьером на дом.</p>
            </div>
            <div class="claster">
                <img src="img/money.png" alt="" class="img22">
                <p><b>Оплата заказа наложенным платежом</b>
                    <br>Оплата осуществляется в почтовом отделении при получении заказа. Получить заказ можно в почтовом отделении, адрес которого был указан Вами при оформлении заказа. Когда посылка прибудет в почтовое отделение, на Ваше мобильное устройство придет уведомление, в котором будет указан код заказа. Для получения посылки на почте обязательно возьмите с собой паспорт и назовите код заказа. Просим Вас своевременно получить заказ.</p>
            </div>
            <div class="claster" id="garar">
                <img style="    margin-top: 48px;" src="img/garanty.png" alt="">
                <p><b>Гарантии</b>
                    <br>Мы Вас не обманим! Мы стремимся быть лучшими и заботимся о том, чтобы наша репутация всегда была на высоком уровне. Мнение клиентов о качестве наших товаров и услуг - самая главная оценка для нас! Мы всегда проверяем товар перед отправкой и гарантируем 100% качество. Мы уверены в надёжности своего товара и даём 1 год гарантии! В случае, если Вам попался заводской брак, просто сделаем обмен на новый товар. Мы соблюдаем закон: "О защите прав потребителей и дистанционной торговле". Если в течение 14 дней после получения посылки, Вы, по какой-либо причине, решили вернуть товар (не подошел цвет, размер и т.д.), Вам достаточно лишь связаться с нашими менеджерами и мы, без лишних вопросов, примем товар обратно! Будьте бдительны и остерегайтесь дешевых подделок!</p>
            </div>
        </div>
    </section>
    <section id="commer">
        <div id="block9" class="content">
            <h2 class="white">успейте сделать заказ по специальной цене!</h2>
            <div class="row">
                <div class="left">
                    <div class="disk">-55%</div>
                    <img src="img/lastform.jpg" alt="">
                </div>
                <div class="right">
                    <div class="forma2" id="forma2">
                        <form action="./_success_/" method="post">
                            <input type='hidden' name='referer' value="<?php echo isset($_GET['referer']) ? $_GET['referer'] : $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] ;?>">
<input type="hidden" name="subid1"  value="<?php echo isset($_GET['subid1']) ? $_GET['subid1'] : '' ;?>" />
<input type="hidden" name="subid2"  value="<?php echo isset($_GET['subid2']) ? $_GET['subid2'] : '' ;?>" />
<input type="hidden" name="subid3"  value="<?php echo isset($_GET['subid3']) ? $_GET['subid3'] : '' ;?>" />
<input type="hidden" name="subid4"  value="<?php echo isset($_GET['subid4']) ? $_GET['subid4'] : '' ;?>" />  
<input type="hidden" name="subid5"  value="<?php echo isset($_GET['subid5']) ? $_GET['subid5'] : '' ;?>" />
                            <div class="p_price">
                                <div class="p_old">
                                    <p>Обычная цена:<span>6644р</span></p>
                                </div>
                                <div class="p_new">
                                    <p>Цена сегодня:<span><?php echo $price['real_price']; ?></span></p>
                                </div>
                            </div>
                            <p class="p93 white">количество товара ограничено!</p>
                            <div class="counter2">
                             <script src="//megatimer.ru/get/eda42191856ba92420bea9ba7daaffbe.js"></script> 
                            </div>
                            <input type="text" placeholder="Ваше Имя" name="name" required>
                            <!-- <select class="form1 country_select" name="country" id="country"><option value='BY'>Беларусь</option><option value='KZ' selected="selected">Казахстан</option><option value='RU'>Россия</option> </select> -->
                            <input type="text" placeholder="Ваш Телефон" name="phone" required>
                            <button class="green1" type="submit">ЗАКАЗАТЬ ЗВОНОК</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="footer">
        <div id="block10" class="content">
<center>
    <p><rekv>ИП МАЛЬЦЕВА А.Н.<br>
            ОГРНИП 316547600128210    <br>
            ИНН 550202556893<br>
            г. Симферополь, Кечкеметская ул. д. 190</rekv> </p>

</center>
        </div>
    </section>



    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

    
   
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
    <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
       <!-- Yandex.Metrika counter -->


</body>
</html>
