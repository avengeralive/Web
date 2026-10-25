<?php 
   $offer = 71;
   include_once $_SERVER['DOCUMENT_ROOT'].'/../includes/landingsData/index2.php';
?> 
<!DOCTYPE html>
<html lang="ru">
<head>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>


    <!-- Содержимое HEAD индексного файла -->
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title></title>
    <meta name="description" content="">
    <link rel="shortcut icon" href="favicon.ico"type="image/x-icon">
    <link rel="stylesheet" href="css/reset.css">
 
    <link rel="stylesheet" href="css/slick.css">
	<link rel="stylesheet" href="css/settings.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="http://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">    <!-- Содержимое, помещаемое в HEAD -->


</head>
<body>



<section class="offer">
    <div class="wrap">
        <img src="img/ph1.png" alt="" class="imgblock">
        <div class="box">
            <h1>Портативный ПК Intel Compute Stick</h1>
            <h2><span>Компьютер всегда с собой, где бы вы не находились</span></h2>
            <div class="sale">-50%</div>
        </div>
    </div>
</section>

<section class="promo top">
    <div class="wrap">
        <div class="price">
            <div class="old-cost">
                <span>Обычная цена:</span>
                <p><b><x-oldprice>2980</x-oldprice></b><i><x-currency>руб</x-currency></i></p>
            </div>
            <div class="new-cost">
                <span>Цена сегодня:</span>
                <p><x-newprice><?php echo $price['real_price']; ?></x-newprice></p>
            </div>
        </div>
        <div class="timer_block">
            <p>Акция закончится через:</p>
            <div class="timer clearfix">
                <div class="timer_item">
                    <div class="count hours"></div>
                </div>
                <div class="timer_item">
                    <div class="count minutes"></div>
                </div>
                <div class="timer_item">
                    <div class="count seconds"></div>
                </div>
            </div>
        </div>
        <a href="#order" class="button-m">Оформить заказ</a>
        <div class="bottom_info">
            <div class="last_day">*последний день акции</div>
            <div class="stock">*осталось <b>4</b> штук со скидкой</div>
        </div>
    </div>
</section>

<section class="about">
    <div class="wrap">
        <h4>Компьютер размером с шоколадку! </h4>
        <p>
            Миниатюрный Intel Compute Stick совмещает мощь персонального компьютера с Windows и сверхмалогабаритный корпус. Он работает на базе процессора Intel® Atom™ и позволяет превратить любой телевизор, монитор или проектор в полноценный компьютер для работы и развлечений.
        </p>
    </div>
</section>

<section class="b1">
    <div class="wrap">
        <h2 class="title">Особенности Intel Compute Stick</h2>
        <div class="row">
            <div class="col-md-3">
                <div class="row">
                    <div class="col-12 text-center">
                        <img src="img/photo2.jpg" alt="" class="mb-2">
                        <p class="subt">Без компромиссов</p>
                        <p>Ультракомпактный, Compute Stick, удивляет не только эстетикой, но и высокой производительностью</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="row">
                    <div class="col-12 text-center">
                        <img src="img/photo3.jpg" alt="" class="mb-2">
                        <p class="subt">«Карманный» компьютер</p>
                        <p>Предоставляет все возможности для работы и развлечений, так как может стать полноценной заменой ноутбука во время путешествия</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="row">
                    <div class="col-12 text-center">
                        <img src="img/photo4.jpg" alt="" class="mb-2">
                        <p class="subt">Стильный дизайн</p>
                        <p>Compute Stick размещен в элегантном тонком корпусе, отличающегося плавными линиями и матовым покрытием</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="row">
                    <div class="col-12 text-center">
                        <img src="img/photo5.jpg" alt="" class="mb-2">
                        <p class="subt">Возможности полноценного ПК</p>
                        <p>Compute Stick оснащен процессором Intel Atom, обеспечивающим высокую отзывчивость и графику в формате Full HD</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="plus">
    <div class="wrap">
        <ul>
            <li>превосходное <span>качество</span></li>
            <li>доставка от <span>3 до 10 дней!</span></li>
            <li>оплата при <span>получении</span></li>
            <li>гарантия <span>качества</span></li>
        </ul>
    </div>
</section>

<section class="b3">
    <div class="wrap">
        <h3>Intel Compute Stick: крошечный персональный компьютер</h3>
        <div class="text">
            <p>
                Времена, когда даже самый простой компьютер занимал половину стола, позади. Современные технологии позволяют отказаться от громоздких системных блоков, которые жутко шумят и собирают пыль, и использовать новый стандарт – HDMI-донгл, небольшое устройство, помещающееся в ладонь.
            </p>
            <p>
                Подключите его к монитору или телевизору и вуаля – перед вами – полноценный персональный компьютер.
            </p>
            <img src="img/photo7.jpg" alt="">
        </div>
    </div>
</section>

<section class="benefits_section">
    <div class="wrap">
        <h2 class="title">Множество вариантов использования</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="row">
                    <div class="col-12">
                        <div class="col-12 text-center cl">
                        <img src="img/photo8.jpg" alt="" class="mb-2">
                        <p class="subt">Повседневные задачи</p>
                        <p class="pad">с является доступным по цене и компактным устройством, которое поможет вам в решении повседневных задач. Он может выполнять роль обычного ПК для веб-серфинга, работы с электронной почтой, редактирования документов и т.д.</p>
                    </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="row">
                    <div class="col-12">
                        <div class="col-12 text-center cl">
                        <img src="img/photo9.jpg" alt="" class="mb-2">
                        <p class="subt">Домашний кинотеатр</p>
                        <p>После установки совместимого приложения функция Intel HyStream позволяет транслировать видео с мобильных устройств на большой экран телевизора. Мобильное устройство также можно настроить как пульт дистанционного управления для Compute Stick.</p>
                    </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="row">
                    <div class="col-12">
                        <div class="col-12 text-center cl">
                        <img src="img/photo10.jpg" alt="" class="mb-2">
                        <p class="subt">Smart TV</p>
                        <p>Compute Stick превращает любой телевизор или монитор в инновационный Smart TV на базе Windows. Он способен работать с интернетом, воспроизводить потоковые телепрограммы и фильмы, выступать удобным средством для общения в социальных сетях.</p>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="row">
                    <div class="col-12">
                        <div class="col-12 text-center cl">
                        <img src="img/photo11.jpg" alt="" class="mb-2">
                        <p class="subt">Презентации</p>
                        <p class="pad">Compute Stick можно подключить к любому проектору, оборудованному HDMI-входом, с целью проведения презентаций или просмотра фильмов.</p>
                    </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="row">
                    <div class="col-12">
                        <div class="col-12 text-center cl">
                        <img src="img/photo12.jpg" alt="" class="mb-2">
                        <p class="subt">Образование</p>
                        <p>Compute Stick является недорогим устройством, не требующим больших затрат на эксплуатацию, поэтому он идеально подходит для школ и образовательных учреждений.</p>
                    </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="row">
                    <div class="col-12">
                        <div class="col-12 text-center cl">
                        <img src="img/photo13.jpg" alt="" class="mb-2">
                        <p class="subt">Рабочее место</p>
                        <p class="pad">Compute Stick может служить в качестве основы кассового терминала в магазинах розничной торговли, сетях быстрого питания и ресторанах.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="promo">
        <div class="wrap">
            <div class="price">
                <div class="old-cost">
                    <span>Обычная цена:</span>
                    <p><b><x-oldprice>2980</x-oldprice></b><i><x-currency>руб</x-currency></i></p>
                </div>
                <div class="new-cost">
                    <span>Цена сегодня:</span>
                    <p><x-newprice><?php echo $price['real_price']; ?></x-newprice></p>
                </div>
            </div>
            <div class="timer_block">
                <p>Акция закончится через:</p>
                <div class="timer clearfix">
                    <div class="timer_item">
                        <div class="count hours"></div>
                    </div>
                    <div class="timer_item">
                        <div class="count minutes"></div>
                    </div>
                    <div class="timer_item">
                        <div class="count seconds"></div>
                    </div>
                </div>
            </div>
            <a href="#order" class="button-m">Оформить заказ</a>
        </div>
    </div>
</section>

<section class="comparison_section">
    <div class="wrap">
        <h2 class="title">Техническая спецификация</h2>
        <table class="compare-table">
              <tr>
                <td class="text-center">Модель</td>
                <td class="text-center compare-table__value compare-table__value--good">Intel Compute Stick STK2m3W64CC</td>
              </tr>
              <tr>
                <td class="text-center">Материал</td>
                <td class="text-center compare-table__value compare-table__value--good">Пластик</td>
              </tr>
              <tr>
                <td class="text-center">Операционная система</td>
                <td class="text-center compare-table__value compare-table__value--good">Windows 10 Home</td>
              </tr>
              <tr>
                <td class="text-center">Процессор</td>
                <td class="text-center compare-table__value compare-table__value--good">Intel Core m3-6Y30 Processor (4M Cache, up to 2,20Ghz), Intel HD Graphics 515</td>
              </tr>
              <tr>
                <td class="text-center">Оперативная память</td>
                <td class="text-center compare-table__value compare-table__value--good">LPDDR3 4 Гб</td>
              </tr>
              <tr>
                <td class="text-center">Встроенная память</td>
                <td class="text-center compare-table__value compare-table__value--good">EMMC 64 ГБ</td>
              </tr>
              <tr>
                <td class="text-center">Слот под MicroSD</td>
                <td class="text-center compare-table__value compare-table__value--good">До 128 ГБ</td>
              </tr>
              <tr>
                <td class="text-center">Встроенный модуль Bluetooth 4.0</td>
                <td class="text-center compare-table__value compare-table__value--good"></td>
              </tr>
              <tr>
                <td class="text-center">Wi-Fi Подключение </td>
                <td class="text-center compare-table__value compare-table__value--good">Есть</td>
              </tr>
              <tr>
                <td class="text-center">Bluetooth </td>
                <td class="text-center compare-table__value compare-table__value--good">4.0</td>
              </tr>
              <tr>
                <td class="text-center">Форматы видео</td>
                <td class="text-center compare-table__value compare-table__value--good">HD MPEG1/2/4, H.264, H.265, HD AVC/VC-1, RM/RMVB</td>
              </tr>
              <tr>
                <td class="text-center">Форматы аудио</td>
                <td class="text-center compare-table__value compare-table__value--good">MP3, WMA, AAC, WAV, TrueHD, DTS, DTS HD, FLACAP</td>
              </tr>
              <tr>
                <td class="text-center">Форматы изображения</td>
                <td class="text-center compare-table__value compare-table__value--good">JPEG, BMP, GIF, PNG, TIFF и т. д.</td>
              </tr>
              <tr>
                <td class="text-center">Вывод графической системы HDMI</td>
                <td class="text-center compare-table__value compare-table__value--good">1.4b</td>
              </tr>
              <tr>
                <td class="text-center">Кол-во портов</td>
                <td class="text-center compare-table__value compare-table__value--good">USB 1 xUSB 2,0; 1 xUSB 3,0</td>
              </tr>
            </table>
    </div>
</section>

<section class="reviews">
    <div class="wrap">
        <h2 class="title">Отзывы наших покупателей</h2>
        <div class="slider">
            <div class="item">
                <div class="bg">
                    <div class="pic">
                        <img src="img/photo14.jpg" alt="">
                    </div>
                    <div class="info">
                        <img src="img/reviews_avatar1.jpg" alt="">
                        <h4>Анна Лесникова</h4>
                        <p>40 лет</p>
                    </div>
                    <div class="text">
                        <p>
                            Есть у меня неттоп Zotac, который подключён к телевизору для фильмов\мультиков и тп. Там стоит старенький Atom и тот же ютуб не тянул от слова совсем. Брала данный стик именно для просмотра онлайн фильмов\ютубов и пр. Работает идеально. Не тормозит. За свои деньги - идеальное решение, а если учесть, что только винда отдельно под 9 тыщ стоит, которая тут уже есть. Определенно рекомендую к покупке.
                        </p>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="bg">
                    <div class="pic">
                        <img src="img/photo15.jpg" alt="">
                    </div>
                    <div class="info">
                        <img src="img/reviews_avatar2.jpg" alt="">
                        <h4>Борис Шилов</h4>
                        <p>36 лет</p>
                    </div>
                    <div class="text">
                        <p>
                            Скептически относился к устройству, пока не пришлось экстренно помогать другу покупать для ребенка подарок. Нужно было сиюминутно приобрести компактное устройство за минимальные деньги, в помощь к учебе! И вот один вариант данный "Свисток", хотя были нэттопы немного дороже. Медийные вещи идут на ура, все запросы по серфингу интернета, офисных приложений перекрыты с лихвой. Как подарок-идеально!
                        </p>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="bg">
                    <div class="pic">
                        <img src="img/photo16.jpg" alt="">
                    </div>
                    <div class="info">
                        <img src="img/reviews_avatar3.jpg" alt="">
                        <h4>Владимир Козырев</h4>
                        <p>53 года</p>
                    </div>
                    <div class="text">
                        <p>
                            Бесшумный, миниатюрный и при всем при этом в достаточной степени производительный для выполнения главной задачи при подключении к большому экрану - скачай что угодно откуда угодно и при этом не раздражай шумом, видом и кучей проводов. Запустил браузер, тот же TNT-Online - и я уже смотрю очередную серию любимого сериала. При этом все так шустренько открывается. Невероятный аппарат)
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="preview_photo">
            <ul class="clearfix">
                <li><img src="img/photo18.jpg" alt="" class="img-fluid"></li>
                <li><img src="img/photo17.jpg" alt="" class="img-fluid"></li>
                <li><img src="img/photo19.jpg" alt="" class="img-fluid"></li>
                <li><img src="img/photo20.jpg" alt="" class="img-fluid"></li>
            </ul>
        </div>
    </div>
</section>

<section class="order_steps_section">
    <div class="wrap">
        <h2 class="title">Как сделать заказ?</h2>
        <div class="steps_list clearfix">
            <div class="step_item">
                <div class="image_block">
                    <img src="img/order_steps__step1_image.jpg" alt="Parazex">
                    <div class="number">01</div>
                </div>
                <p>Заполните форму для заказа товара</p>
            </div>
            <div class="step_item">
                <div class="image_block">
                    <img src="img/order_steps__step2_image.jpg" alt="Parazex">
                    <div class="number">02</div>
                </div>
                <p>Оператор уточнит у вас детали заказа и мы отправим его</p>
            </div>
            <div class="step_item">
                <div class="image_block">
                    <img src="img/order_steps__step3_image.jpg" alt="Parazex">
                    <div class="number">03</div>
                </div>
                <p>Через 1-10 дней вы получите товар и оплатите его при получении</p>
            </div>
        </div>
    </div>
</section>

<section class="offer bottom">
    <div class="wrap">
        <img src="img/ph1.png" alt="" class="imgblock1">
        <div class="box">
            <h1>Портативный ПК Intel Compute Stick</h1>
            <h2><span>Компьютер всегда с собой, где бы вы не находились</span></h2>
            <div class="sale">-50%</div>
        </div>
        <div class="order_form" id="order">
            <div class="sale_text">Закажите сегодня <b>со скидкой 50%</b></div>
            <div class="price">
                <div class="old-cost">
                    <span>Обычная цена:</span>
                    <p><b><x-oldprice>2980</x-oldprice></b><i><x-currency>руб</x-currency></i></p>
                </div>
                <div class="new-cost">
                    <span>Цена сегодня:</span>
                    <p><x-newprice><?php echo $price['real_price']; ?></x-newprice></p>
                </div>
            </div>
            <div class="last_day">*последний день акции</div>
            <form class="m1-form" action="./_success_/" method="post">
                <input type='hidden' name='referer' value="<?php echo isset($_GET['referer']) ? $_GET['referer'] : $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] ;?>">
<input type="hidden" name="subid1"  value="<?php echo isset($_GET['subid1']) ? $_GET['subid1'] : '' ;?>" />
<input type="hidden" name="subid2"  value="<?php echo isset($_GET['subid2']) ? $_GET['subid2'] : '' ;?>" />
<input type="hidden" name="subid3"  value="<?php echo isset($_GET['subid3']) ? $_GET['subid3'] : '' ;?>" />
<input type="hidden" name="subid4"  value="<?php echo isset($_GET['subid4']) ? $_GET['subid4'] : '' ;?>" />  
<input type="hidden" name="subid5"  value="<?php echo isset($_GET['subid5']) ? $_GET['subid5'] : '' ;?>" />

   
                    <div><input class="field" type="text" name="name" placeholder="Введите ваше имя" required></div>
                <div><input class="field" type="tel" name="phone" placeholder="Введите ваш телефон" required></div>
                <div>
                    <button class="button-m">Оформить заказ</button>
                </div>
                <div class="stock">*осталось <b>4</b> штук со скидкой</div>
</form>
        </div>
    </div>
</section>
<div><center>
<p>ООО «РЕГИОН ГРУПП»</p>
<p>119034, г. Москва, проезд Соймоновский, д. 7, стр. 1, пом. П, ком. 20</p>
<p>ОГРН: 1197746188474 ИНН: 7704482681</p>
</center></div>

<script src=" https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="js/slick.min.js"></script>
    <script src="js/init.js"></script>

<link rel="stylesheet" href="yved/style.css" type="text/css" />

    </body>
</html>