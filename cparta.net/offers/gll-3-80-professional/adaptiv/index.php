<?php 
   $offer = 61;
   include_once $_SERVER['DOCUMENT_ROOT'].'/../includes/landingsData/index2.php';
?> 
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>Нивелир</title>
    <link rel="icon" type="image/png" href="files/favicon-48e-arb.png">
    <link rel="stylesheet" href="files/reset-21c-arb.css">
    <link rel="stylesheet" href="files/settings-e2d-arb.css">
    <link rel="stylesheet" href="files/slick-9b4-arb.css">
    <link rel="stylesheet" href="files/style-040-arb.css">
    <link rel="stylesheet" type="text/css" href="files/roboto-06f-arb.css">




</head>

<body>




    <section class="header-three">
        <div class="wrap">
            <div class="title-cont clearfix">
                <h1>Лазерный нивелир</h1>
                <h2>GLL 3-80 Professional</h2>
            </div>
            <div class="sale2">акция! <p>-53%</p> скидка</div>
            <ul class="header-one_plus">
                <li>Высокая точность измерения</li>
                <li>Хорошо видимый лазерный луч</li>
                <li>Быстрое нивелирование в диапазоне 360°</li>
            </ul>
            <div class="formbox shadow">
                <div class="price clearfix">
                    <div class="cost_sale">
                        <div class="sale">-53%</div>
                        <div class="old-cost"><span>4290</span><small>р</small></div>
                    </div>
                    <div class="new-cost">
                        <span>Цена сегодня:</span>
                        <p><?php echo $price['real_price']; ?></p>
                    </div>
                </div>
                <form class="formOrder orderformcdn" action="./_success_/" method="post">
                    <input type='hidden' name='referer' value="<?php echo isset($_GET['referer']) ? $_GET['referer'] : $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] ;?>">
<input type="hidden" name="subid1"  value="<?php echo isset($_GET['subid1']) ? $_GET['subid1'] : '' ;?>" />
<input type="hidden" name="subid2"  value="<?php echo isset($_GET['subid2']) ? $_GET['subid2'] : '' ;?>" />
<input type="hidden" name="subid3"  value="<?php echo isset($_GET['subid3']) ? $_GET['subid3'] : '' ;?>" />
<input type="hidden" name="subid4"  value="<?php echo isset($_GET['subid4']) ? $_GET['subid4'] : '' ;?>" />  
<input type="hidden" name="subid5"  value="<?php echo isset($_GET['subid5']) ? $_GET['subid5'] : '' ;?>" />

                    <input class="field" name="name" required type="text" placeholder="Введите ваше имя" value="">
                    <input class="field" name="phone" required type="tel" placeholder="Введите ваш телефон" value="">
                    <div class="reolader"><button class="button-m mm_button" >Оформить заказ</button>
                        <div class="ajax_loader_block"><img class="ajax_loader" src="img/ajax-loader.gif" alt="Идет отправка данных"> <span class="ajax_loader">Идет отправка данных</span></div>
                    </div>

                </form>
                <div class="products_count">Осталось товара по акции:<b>13 шт.</b></div>
            </div>
        </div>
    </section>
    <section class="s2">
        <div class="wrap nopad">
            <h2 class="title">Особенности нивелира Bosch<br><span>GLL 3-80 Professional</span></h2>
            <ul class="plus2 list col2">
                <li>
                    <div class="list-left"><img src="files/photo1-949-arb.png" alt></div>
                    <div class="list-right">
                        <h3>Комфортная эксплуатация</h3>
                        <p>Нескользящее покрытие корпуса Bosch GLL 3-80 Professional обеспечивает комфортную
                            эксплуатацию инструмента</p>
                    </div>
                </li>
                <li>
                    <div class="list-left"><img src="files/photo2-b0d-arb.png" alt></div>
                    <div class="list-right">
                        <h3>Универсальность</h3>
                        <p>Лучи 3 x 360° обеспечивают одновременное выравнивание по горизонтали и вертикали, повышая
                            эффективность работы</p>
                    </div>
                </li>
            </ul>
        </div>
    </section>
    <section class="s3" style="background: url('files/bg2-81c-arb.jpg') no-repeat center / cover">
        <div class="wrap nopad">
            <ul class="list col4">
                <li>
                    <img src="files/photo3-dca-arb.png" alt>
                    <h3>Высокая визуальная четкость обеспечивается мощными диодами</h3>
                </li>
                <li>
                    <img src="files/photo4-88a-arb.png" alt>
                    <h3>Режимы работы, которые можно переключать в любой момент</h3>
                </li>
                <li>
                    <img src="files/photo5-37d-arb.png" alt>
                    <h3>Компактные габариты и малый вес - для удобства работы с прибором</h3>
                </li>
                <li>
                    <img src="files/photo6-78d-arb.png" alt>
                    <h3>Интуитивно-понятный пользовательский интерфейс упрощает работу</h3>
                </li>
            </ul>
        </div>
    </section>
    <section class="s4 about2" style="background: url('files/s4_bg-1b9-arb.jpg') no-repeat center / cover">
        <div class="wrap nopad">
            <h2 class="title">Лазерный нивелир <span>GLL 3-80 Professional</span> – лучший помощник при ремонте!</h2>
            <div class="two-col">
                <div class="two-col_left">
                    <div class="video-container shadow">
                        <iframe width="560" height="315" src="https://www.youtube.com/embed/JqUfqqUzCnM" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                </div>
                <div class="two-col_right">
                    <ul>
                        <li>Лазерный нивелир Bosch GLL 3-80 Professional проецирует одну горизонтальную и две
                            вертикальные плоскости в диапазоне 360°.</li>
                        <li>При совместном использовании с приемником дальность действия увеличивается до 120 метров
                            (диаметр).</li>
                        <li>Возможность блокировки маятника обеспечивает безопасную транспортировку прибора. Степень
                            защиты корпуса от пыли и водяных брызг - IP54.</li>
                    </ul>
                </div>
            </div>
            <style>
                .feature__wrap {
                    margin-top: 70px;
                    display: flex;
                    justify-content: space-around;
                    flex-wrap: wrap;
                    text-align: center;
                }

                .feature__item {
                    display: flex;
                    flex-direction: column;
                    text-align: center;
                    width: 300px;
                    margin-bottom: 30px;
                }

                .feature__item img {
                    width: 300px;
                    display: block;
                    margin: 0 auto;
                }

                .feature__item p {
                    color: black;
                }
            </style>
            <div class="feature__wrap">
                <div class="feature__item">
                    <p><b>Дальность действия 30 м</b><br>Нивелир подходит для больших помещений и для работы на улице
                    </p>
                    <p><b>Работа в любую погоду</b><br>Диапазон рабочей температуры – от -10 до +40 °С</p>
                    <p><b>Функция блокировки маятника</b><br>Надежная транспортировка прибора</p>
                </div>
                <div class="feature__item">
                    <img src="files/photo8-5f8-arb.jpg">
                </div>
                <div class="feature__item">
                    <p><b>Два типа крепления</b><br>Совместимость со штативами с резьбой 1/4 и 5/8</p>
                    <p><b>Степень защиты IP54</b><br>Возможность работы в контакте с пылью и влагой</p>
                    <p><b>Универсальный тип питания</b><br>Подходят пальчиковые батарейки или литиево-ионный аккумулятор
                    </p>
                </div>
            </div>
            <a href="#order_form" class="button-m">Заказать сейчас</a>
        </div>
    </section>
    <section class="gallery_block">
        <div class="panorama-viewport" style="width: 100%; overflow: hidden; margin-left: 0px; text-align: left;">
            <div class="panorama-container" style="width: 3840px; height: 326px; overflow: hidden; margin-left: -834.112px;">
                <div class="panorama-viewport" style="width: 100%; overflow: hidden; margin-left: 0px; text-align: left;">
                    <div class="panorama-container" style="width: 3840px; height: 326px; overflow: hidden; margin-left: -1234.56px;"><img src="files/photo10-ff0-arb.jpg" class="panorama" alt style="margin: 0px; padding: 0px; border: none; user-select: none;" width="1920" height="326"><img src="files/photo10-ff0-arb.jpg" class="panorama" alt style="margin: 0px; padding: 0px; border: none; user-select: none;" width="1920" height="326"></div>
                </div>
            </div>
        </div>
    </section>
    <section class="s5">
        <div class="wrap nopad">
            <h2 class="title">Характеристики <span>устройства</span></h2>
            <div class="two-col">
                <div class="two-col_right">
                    <div class="wrap-slider-chars">
                        <div class="slider-chars">
                            <img src="./files/1-b60-arb.jpg" alt>
                            <img src="./files/2-60b-arb.jpg" alt>
                            <img src="./files/3-334-arb.jpg" alt>
                            <img src="./files/4-972-arb.jpg" alt>
                        </div>
                    </div>
                </div>
                <div class="two-col_left">
                    <ul>
                        <li><b>Класс защиты:</b> IP 54</li>
                        <li><b>Рабочий диапазон температур, С:</b> -10...+40</li>
                        <li><b>Точность, мм/м:</b> 0.20</li>
                        <li><b>Диапазон работы, м:</b> 30</li>
                        <li><b>Диапазон работы с детектором, м:</b> 120</li>
                        <li><b>Лазерный излучатель, нм:</b> Линия: 630-650</li>
                        <li><b>Температура хранения, град.:</b> -20...+70</li>
                        <li><b>Угол самовыравнивания, °:</b> 4</li>
                        <li><b>Класс лазера:</b> 2</li>
                        <li><b>Время нивелирования, с:</b> 4</li>
                        <li><b>Резьба штатива, дюйм:</b> 1/4, 5/8</li>
                        <li><b>Проекция:</b> 3 линии 360°</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <section class="s8" style="background: url('files/bg4-e6d-arb.jpg') no-repeat center / cover">
        <div class="wrap nopad">
            <h2 class="title">Отзывы наших <span>покупателей</span></h2>
            <div class="reviews-4  ">
                <div>
                    <div class="rev shadow">
                        <img src="./files/photo12-d94-arb.jpg" alt>

                        <h3>
                            Алексей М. | 35 лет
                        </h3>
                        <p class="just">Некоторые пузырьковые уровни стоят дороже, линия достаточно тонкая и яркая,
                            проверка по отвесу показала идеальную настройку луча. Чем проще прибор, тем надежнее.
                            Навесить полки, карнизы, выставить мебель, холодильник, стиралку, В сумерках вполне реально
                            нанести разметку для забора и уклоны дренажа.</p>
                    </div>
                </div>
                <div>
                    <div class="rev shadow">
                        <img src="./files/photo14-ad3-arb.jpg" alt>
                        <h3>
                            Максим А. | 37 лет
                        </h3>
                        <p class="just">Нормальный уровень! В соответствии цены и качества - как раз то, что и хотелось.
                            Если обращаться бережно, работает отменно. Понравилось в нём, то, что он маленький, всего
                            две батарейки и светит за себя. Вертикаль, горизонталь, и диагональ с зафиксированным
                            маятником. Управляется одной кнопкой.</p>
                    </div>
                </div>
                <div>
                    <div class="rev shadow">
                        <img src="./files/photo13-a4b-arb.jpg" alt>
                        <h3>
                            Андрей П. | 31 год
                        </h3>
                        <p class="just">Цена и качество прежде всего! Компактный размер, питается от батареек АА, что
                            большой плюс, так как у товарища уровень на АКБ и она вздулась. Имеется крепление для
                            штатива. Короче - отличный уровень для бытовых целей, ремонта дома и т.д. Конечно, поля 10
                            га по нему не выровнять, но зато батарейки в комплекте идут)</p>
                    </div>
                </div>
            </div>
            <a href="#order_form" class="button-m">Заказать сейчас</a>
        </div>
    </section>
    <section class="s9">
        <div class="wrap nopad">
            <h2 class="title">Доставка и <span>оплата</span></h2>
            <div class="two-col">
                <div class="two-col_right">
                    <img src="files/photo15-a1b-arb.png" alt>
                </div>
                <div class="two-col_left">
                    <ul class="order">
                        <li class="clearfix">
                            <img src="files/order_1-ba8-arb.png" alt>
                            <p>Доставка почтой в течение 3-7 рабочих дней по всей России</p>
                        </li>
                        <li class="clearfix">
                            <img src="files/order_2-8a0-arb.png" alt>
                            <p>Оплата заказов осуществляется по факту получения товара</p>
                        </li>
                        <li class="clearfix">
                            <img src="files/order_3-765-arb.png" alt>
                            <p>Мы всегда проверяем товар перед отправкой и гарантируем 100% качество</p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <section class="header-three">
        <div class="wrap">
            <div class="title-cont clearfix">
                <h1>Лазерный нивелир </h1>
                <h2>GLL 3-80 Professional</h2>
            </div>
            <div class="sale2">акция! <p>-53%</p> скидка</div>
            <ul class="header-one_plus">
                <li>Высокая точность измерения</li>
                <li>Хорошо видимый лазерный луч</li>
                <li>Быстрое нивелирование в диапазоне 360°</li>
            </ul>
            <div class="formbox shadow">
                <div class="price clearfix">
                    <div class="cost_sale">
                        <div class="sale">-53%</div>
                        <div class="old-cost"><span>4290</span><small>р</small></div>
                    </div>
                    <div class="new-cost">
                        <span>Цена сегодня:</span>
                        <p><?php echo $price['real_price']; ?></p>
                    </div>
                </div>
                <form id="order_form" class="formOrder orderformcdn" action="./_success_/" method="post">
                    <input type='hidden' name='referer' value="<?php echo isset($_GET['referer']) ? $_GET['referer'] : $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] ;?>">
<input type="hidden" name="subid1"  value="<?php echo isset($_GET['subid1']) ? $_GET['subid1'] : '' ;?>" />
<input type="hidden" name="subid2"  value="<?php echo isset($_GET['subid2']) ? $_GET['subid2'] : '' ;?>" />
<input type="hidden" name="subid3"  value="<?php echo isset($_GET['subid3']) ? $_GET['subid3'] : '' ;?>" />
<input type="hidden" name="subid4"  value="<?php echo isset($_GET['subid4']) ? $_GET['subid4'] : '' ;?>" />  
<input type="hidden" name="subid5"  value="<?php echo isset($_GET['subid5']) ? $_GET['subid5'] : '' ;?>" />

                    <input class="field" name="name" required type="text" placeholder="Введите ваше имя" value="">
                    <input class="field" name="phone" required type="tel" placeholder="Введите ваш телефон" value="">
                    <div class="reolader"><button class="button-m mm_button" >Оформить заказ</button>
                        <div class="ajax_loader_block"><img class="ajax_loader" src="img/ajax-loader.gif" alt="Идет отправка данных"> <span class="ajax_loader">Идет отправка данных</span></div>
                    </div>
                </form>
                <div class="products_count">Осталось товара по акции:<b>13 шт.</b></div>
            </div>

        </div>
    </section>
    <footer class="copyright">
        <div class="wrap">
	<p style="text-align: center; margin-bottom: 15px;">ООО ВИТЛ, г. Москва, ул. Бестужевых д.14а, ИНН 4823018240, ОГРН 1024840833005</p>
            <p style="text-align: center"></p>
            <p style="text-align: center">
                <a href="politika.html" target="_blank">Политика конфиденциальности</a><br>
                <a href="user.html" target="_blank">Пользовательское соглашение</a>
            </p>
        </div>
    </footer>
    <script src="files/jquery_002-012-arb.js" type="text/javascript"></script>
    <script src="files/slick-0af-arb.js"></script>
    <script src="files/jquery-938-arb.js"></script>
    <script src="files/main-1b7-arb.js"></script>

</body>

</html>
