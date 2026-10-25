<?php 
   $offer = 275;
   include_once $_SERVER['DOCUMENT_ROOT'].'/../includes/landingsData/index2.php';
?> 
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=480">
    <title>Видеорегистратор Junsun </title>
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="stylesheet" href="css/GothamPro.css" type="text/css">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/settings.css">
    <link rel="stylesheet" href="css/slick.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<!-- after_qbici -->
<div class="wrap">
    <section class="b1">
        <h2>Видеорегистратор </h2>
        <h1>Junsun</h1>

        <div class="offer">
            <div class="sale"><span>53</span></div>
        </div>
    </section>
    <!-- michael-k90 -->
    <section class="b2">
        <ul class="plus">
            <li>Инновационный видеорегистратор с поддержкой 4G, выносной камерой заднего вида и разрешением съемки Full
                HD.
            </li>
        </ul>
        <div class="formbox">
            <div class="price clearfix">
                <div class="old-cost">
                    <span>обычная цена:</span>
                    <p><span>6360</span>
                        <small>Руб</small>
                    </p>
                </div>
                <div class="new-cost">
                    <span>цена по акции:</span>
                    <p><?php echo $price['real_price']; ?>
                    </p>
                </div>
            </div>
            <form class="m1-form" action="./_success_/" method="post">
                <input type='hidden' name='referer' value="<?php echo isset($_GET['referer']) ? $_GET['referer'] : $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] ;?>">
<input type="hidden" name="subid1"  value="<?php echo isset($_GET['subid1']) ? $_GET['subid1'] : '' ;?>" />
<input type="hidden" name="subid2"  value="<?php echo isset($_GET['subid2']) ? $_GET['subid2'] : '' ;?>" />
<input type="hidden" name="subid3"  value="<?php echo isset($_GET['subid3']) ? $_GET['subid3'] : '' ;?>" />
<input type="hidden" name="subid4"  value="<?php echo isset($_GET['subid4']) ? $_GET['subid4'] : '' ;?>" />  
<input type="hidden" name="subid5"  value="<?php echo isset($_GET['subid5']) ? $_GET['subid5'] : '' ;?>" />
                <input class="field" name="name" type="text" placeholder="Введите ваше имя" required>
                <input class="field" name="phone" type="tel" placeholder="Введите ваш телефон" required>
                <button class="button-m">Оформить заказ</button>
            </form>
            <div class="stock">Оформите заказ с предоплатой и получите акустические
                <span>Твитеры Pioneer в подарок</span></div>
        </div>
    </section>
    <!-- bizlife_inc -->
    <section class="b3">
        <h2 class="title"> <span>ВИДЕООБЗОР
</span></h2>
        <div class="video-container shadow">
            <div class="youtube" id="ABYrBlj7zqk"></div>
        </div>

    </section>
    <!-- owmen17 -->

    <!-- after_qbici -->
    <section class="b5 grad">
        <h2 class="title"> ОСОБЕННОСТИ ВИДЕОРЕГИСТРАТОРА <span>JUNSUN
</span></h2>
        <ul class="problem">
            <li>
                <img src="img/ph2.png" alt="">
                <p>Благодаря 4G интернету и встроенному Wi-Fi вы можете заниматься интернет серфингом где угодно, а так
                    же совершать звонки.</p>
            </li>
            <li>
                <img src="img/ph3.png" alt="">
                <p>10 дюймовый сенсорный экран обеспечивает идеальную картинку без каких либо задержек в
                    изображении.</p>
            </li>

            <li>
                <img src="img/ph5.png" alt="">
                <p>Цель системы ADAS — автоматизировать и повысить безопасность, предупреждая сидящего за рулем человека
                    о вероятной или возникшей проблеме, которую надо немедленно решить.</p>
            </li>
            <li>
                <img src="img/ph6.png" alt="">
                <p>Режим парктроник позволит в режиме реального времени следить за расстоянием между вашей машиной и
                    окружающими предметами.</p>
            </li>

            <li>
                <img src="img/ph7.png" alt="">
                <p>Записывайте видео в высоком качестве Full HD 1080P. Широкий диапазон позволяет камере снимать в
                    отличном качестве как днем, так и ночью.</p>
            </li>
            <li>
                <img src="img/ph4.png" alt="">
                <p>Проложите любой маршрут на навигаторе благодаря встроенному GPS модулю.</p>
            </li>
            <li>
                <img src="img/ph8.png" alt="">
                <p>G – сенсор будет регистрировать резкие торможение, удары или внезапные повороты. Благодаря ему, у вас
                    больше не будет спорных ситуаций на дороге.</p>
            </li>
            <li>
                <img src="img/ph9.png" alt="">
                <p>С помощью специального приложения на смартфоне, вы можете просматривать видео, свой маршрут за день и
                    т.п.</p>
            </li>

        </ul>
        <a href="#order_form" class="button-m">Заказать по акции</a>
    </section>
    <br><br><br>
    <img src="img/5.png" alt=""><br><br>

    <section class="b2">
        <h2 class="title col2">Гарантированная защита от штрафов <span>на 99%!</span></h2>
        <p>Каждый водитель желает знать где стоит радар. Junsun знает. Благодаря радар-детектору устройство безошибочно
            определяет не только камеры, но и все другие типы радаров ГИБДД в 99-ти случаях из ста.</p>
        <br>
        <ul class="plus">
            <li>Мобильные радары и треноги: Стрелка, Арена, Крис, Искра, Сокол, Беркут, Визир и другие.</li>
            <li>Безрадарные камеры контроля: Автодория, Автоураган, Кречет, Поток, Лира, Робот, Кордон, камеры контроля
                светофора, камеры стреляющие в спину.
            </li>
            <li>Оповещения за 600-1200 метров. Визуальные и голосовые на русском языке.</li>
            <li>Настраиваемая громкость оповещений, порог скорости и диапазон работы.</li>
            <li>Три режима работы радар-детектора: город, трасса и умный режим.</li>
        </ul>
    </section>


    <section class="b7">
        <h2 class="title col4"><span>ТЕХНИЧЕСКИЕ ХАРАКТЕРИСТИКИ</span></h2>
        <div><img width="100%" src="img/ph1.png" alt=""></div>

        <ul>
            <li><b>Бренд</b>: Junsun</li>
            <li><b>Разрешение камеры</b>: 1920x1080</li>
            <li><b>Поддрежка microSD</b>: до 32Gb</li>
            <li><b>GPS – модуль</b>: да</li>
            <li><b>Соотношение сторон экрана</b>: 16:9</li>
            <li><b>ADAS</b>: LDWS / FCWS/ FVMA</li>
            <li><b>Поддержка сим карты</b>: да (4G/3G/2G)</li>
            <li><b>Интерфейс</b>: Микро SD/TF,USB2.0</li>
            <li><b>Сенсорный экран</b>: Да</li>
            <li><b>Угол обзора</b>: 105°(выносная камера)-140°(основная камера)</li>
            <li><b>Кадров в секунду</b>: 25</li>
            <li><b>Формат видео</b>: MPEG-4</li>
            <li><b>RAM/ROM</b>: 1GB/16GB</li>
            <li><b>Особые характеристики</b>: Наблюдение в режиме реального времени, G – сенсор, светодиодный дисплей,
                встроенный GPS, циклическая запись, Wi-Fi, Bluetooth, выносная камера, микрофон, трансмитер.
            </li>
        </ul>
    </section>

    <!-- endzeit_____ -->
    <section class="b6 grad">
        <h2 class="title">КОМПЛЕКТАЦИЯ И ГАЛЕРЕЯ</h2>
        <div class="gallery">
            <div><img width="100%" src="img/1.jpeg" alt=""></div>
            <div><img width="100%" src="img/2.jpeg" alt=""></div>
            <div><img width="100%" src="img/3.jpeg" alt=""></div>
            <div><img width="100%" src="img/4.jpeg" alt=""></div>


        </div>
    </section>
    <section class="b7">
        <table class="table" cellpadding="0" cellspacing="0">
            <tr>
                <td>Видеорегистратор Junsun</td>

            </tr>
            <tr>
                <td>Автомобильное зарядное устройство</td>

            </tr>
            <tr>
                <td>Выносная камера</td>

            </tr>
            <tr>
                <td>Крепеж</td>

            </tr>
            <tr>
                <td>Инструкция</td>

            </tr>
            <tr>
                <td>GPS – модуль</td>

            </tr>


        </table>
    </section>

    <section class="b9">
        <h2 class="title">ОТЗЫВЫ НАШИХ <span>ПОКУПАТЕЛЕЙ </span></h2>
        <div class="reviews">
            <div class="rev r1">
                <div class="person clearfix">
                    <img src="img/r1.jpeg" alt="">
                    <h3>Андрей Васюков</h3>
                </div>
                <br> <br>
                <p>Не так давно купил себе машину. Нужно было присмотреть хороший видеорегистратор, так как опыта мало,
                    а дураков на дороге много. Так же обязательным критерием было наличие второй выносной камеры. В
                    итоге, купил себе видеорегистратор Junsun и не пожалел. Качество видео на высоте. Приятно удивило
                    то, что и ночью снимает тоже изумительно. Доволен, за такие деньги это великолепный регистратор.</p>
            </div>

            <div class="rev">
                <div class="person clearfix">
                    <img src="img/r2.jpeg" alt="">
                    <h3>Максим Проворов</h3>
                </div>
                <br> <br>
                <p>Недавно сломался регистратор. А без него я как без рук, ездить не привычно. Начал искать что-то
                    похожее. И тут наткнулся на ваш сайт. Для меня цена-качество это самый главный критерий, так что
                    почитав про видеорегистратор Junsun я решил заказать. Пришел быстро, решил сразу протестить.
                    Работает великолепно! Особенно понравилось наличие сим карты, очень удобная функция.</p>
            </div>

            <div class="rev">
                <div class="person clearfix">
                    <img src="img/r3.jpeg" alt="">
                    <h3>Иван Кондрашов</h3>
                </div>
                <br> <br>
                <p>Очень хотел регистратор в виде зеркала, так как по мне это очень удобно и места много не занимает.
                    После долгих поисков решился на видеорегистратор Junsun и не пожалел! Работает как часы, снимает
                    отлично, много разнообразных функций. В общем, берите — не пожалеете.</p>
            </div>
        </div>
    </section>


    <section class="b4 ">
        <h2 class="title col2">КАК СДЕЛАТЬ ЗАКАЗ <span> В НАШЕМ МАГАЗИНЕ</span></h2>
        <ul class="problem">
            <li>
                <img src="img/compose.png" alt="">
                <p>Вы оставляете заявку на нашем сайте</p>
            </li>
            <li>
                <img src="img/phone-1.png" alt="">
                <p>Наш менеджер свяжется с Вами и уточнит детали</p>
            </li>
            <li>
                <img src="img/truck.png" alt="">
                <p>Мы отправляем Ваш заказ в этот же день</p>
            </li>
            <li>
                <img src="img/check1.png" alt="">
                <p>Вы получаете Ваш заказ на Почте</p>
            </li>
        </ul>
    </section>

    <!-- endzeit_____ -->
    <section class="b6 grad">
        <h2 class="title"><span>ДОСТАВКА И ОПЛАТА</span></h2>
        <ul class="steps">
            <img src="img/ome.jpg" alt=""><br>
            <li><p><b>Доставка Почтой</b> <br> Мы Вам доверяем и не требуем предоплаты. Мы уважаем Ваше время, и поэтому
                    все заказы отправляем только бандеролями 1 класса. Вы можете забрать и оплатить свои заказ на почте
                    в любое удобное для Вас время. Посылка дойдет до Вас быстро и без единой царапинки. Чтобы ускорить
                    прибытие Вашего заказа, мы отправляем бандероли два раза в день, включая выходные дни.</p></li>
            <br>
            <img src="img/money.png" alt="">
            <li><p><b>Оплата заказа наложенным платежом
                    </b> <br> Оплата осуществляется в почтовом отделении при получении заказа. Получить заказ можно в
                    почтовом отделении, индекс которого был указан при оформлении заказа. Уведомление о доставке заказа
                    придет по вашему адресу. Для получения заказа на почте возьмите с собой паспорт. Просим Вас
                    своевременно получить пришедший заказ.</p></li> <br>
            <img src="img/garanty.png" alt="">
            <li><p><b>Гарантии</b> <br> Мы заботимся о своей репутации, довольные клиенты для нас - на первом месте! Мы соблюдаем закон "О защите прав потребителей". Если в течение 14 дней после получения покупки, Вы по какой-то причине решили вернуть деньги, Вам достаточно связаться с нашими менеджерами. Мы без лишних вопросов примем Ваш возврат!</p></li>
        </ul>


    </section>


    <section class="b1">
        <h2>Видеорегистратор </h2>
        <h1>Junsun</h1>
        <div class="offer">
            <div class="sale"><span>53</span></div>
        </div>
    </section>
    <!-- michael-k90 -->
    <section class="b2">

        <div class="formbox">
            <div class="price clearfix">
                <div class="old-cost">
                    <span>обычная цена:</span>
                    <p><span>6360</span>
                        <small>Руб</small>
                    </p>
                </div>
                <div class="new-cost">
                    <span>цена по акции:</span>
                    <p><?php echo $price['real_price']; ?>
                    </p>
                </div>
            </div>
            <form id="order_form" class="m1-form" action="./_success_/" method="post">
                <input type='hidden' name='referer' value="<?php echo isset($_GET['referer']) ? $_GET['referer'] : $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] ;?>">
<input type="hidden" name="subid1"  value="<?php echo isset($_GET['subid1']) ? $_GET['subid1'] : '' ;?>" />
<input type="hidden" name="subid2"  value="<?php echo isset($_GET['subid2']) ? $_GET['subid2'] : '' ;?>" />
<input type="hidden" name="subid3"  value="<?php echo isset($_GET['subid3']) ? $_GET['subid3'] : '' ;?>" />
<input type="hidden" name="subid4"  value="<?php echo isset($_GET['subid4']) ? $_GET['subid4'] : '' ;?>" />  
<input type="hidden" name="subid5"  value="<?php echo isset($_GET['subid5']) ? $_GET['subid5'] : '' ;?>" />
                <input class="field" name="name" type="text" placeholder="Введите ваше имя" required>
                <input class="field" name="phone" type="tel" placeholder="Введите ваш телефон" required>
                <button class="button-m">Оформить заказ</button>
            </form>
            <div class="stock">Количество товара по акции: <span>18 шт.</span></div>
        </div>
    </section>
    <!-- endzeit_____ -->
    <footer class="footer">
        <p>ООО «Трейдонлайн», ОГРН: 5177723581498, ИНН: 654987218, г. Москва, ул. Медынская, 9</p>
        <p style="text-align: center">

        </p>
    </footer>
</div>


<link rel="stylesheet" type="text/css" href="css/roboto.css">
<script src="js/jquery.js" type="text/javascript"></script>
<script src="js/plugins.js" type="text/javascript"></script>
<script src="js/slick.min.js"></script>
<script src="js/previewYouTube.js"></script>
<script src="js\main.js"></script>
<!-- endzeit_____ -->
</body>
</html>