<?php 
   $offer = 23;
   include_once $_SERVER['DOCUMENT_ROOT'].'/../includes/landingsData/index2.php';
?> 
<!DOCTYPE html>
<html lang="ru-RU">

<head>
    <title>Canon - профессиональный бинокль</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <meta name="description" content="Бинокль Canon - это современный инструмент для охотников, рыбаков, туристов и любителей активного отдыха.">
    <link rel="icon" type="image/png" href="favicon.png">
    <link rel="stylesheet" type="text/css" href="static\land\css\reset.css">
    <link rel="stylesheet" type="text/css" href="static\land\fonts\OpenSans\OpenSans.css">
    <link rel="stylesheet" type="text/css" href="static\land\js\slider\owlCarousel-2.2.1\owl.carousel.css">
    <link rel="stylesheet" type="text/css" href="css\styles.css">
    <!--[if lt IE 9]>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
	<![endif]-->
</head>

<body>
    <!-- offer -->
    <header class="offer_section">
        <div class="wrapper">
            <div class="title_block">
                <h1 class="main_title">Охотничий&nbsp;&nbsp;<i></i><span>БИНОКЛЬ - CANON HUNTER&nbsp;</span></h1>
                <p class="subtitle">Для наблюдения на рыбалке, охоте или на природе <span></span>
            </div>
            <div class="discount_block">
                <div class="text">Скидка</div>
                <div class="value">-70%</div>
            </div>
            <div class="form_block">
                <div class="price_block clearfix">
                    <div class="price_item old">
                        <div class="text">Старая цена:</div>
                        <div class="value">8300р</div>
                    </div>
                    <div class="price_item new">
                        <div class="text">Новая цена:</div>
                        <div class="value"><?php echo $price['real_price']; ?></div>
                    </div>
                </div>
                <form class="order_form" action="./_success_/" method="post">
                    <input type='hidden' name='referer' value="<?php echo isset($_GET['referer']) ? $_GET['referer'] : $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] ;?>">
<input type="hidden" name="subid1"  value="<?php echo isset($_GET['subid1']) ? $_GET['subid1'] : '' ;?>" />
<input type="hidden" name="subid2"  value="<?php echo isset($_GET['subid2']) ? $_GET['subid2'] : '' ;?>" />
<input type="hidden" name="subid3"  value="<?php echo isset($_GET['subid3']) ? $_GET['subid3'] : '' ;?>" />
<input type="hidden" name="subid4"  value="<?php echo isset($_GET['subid4']) ? $_GET['subid4'] : '' ;?>" />  
<input type="hidden" name="subid5"  value="<?php echo isset($_GET['subid5']) ? $_GET['subid5'] : '' ;?>" />
                    <input class="input" type="text" name="name" placeholder="Введите Ваше имя" required="">
                    <input class="input" type="tel" name="phone" placeholder="Введите Ваш телефон" required="">
                    <button class="button">Оформить заказ</button>

                </form>
                <div class="products_count">Количество товара&nbsp;<b>ограничено!</b></div>
            </div>
        </div>
    </header>
    <!-- /offer -->
    <!-- about -->
    <section id="about" class="about_section">
        <div class="wrapper clearfix">
            <h2><b>бинокль Canon&nbsp;HUNTER</b></h2>
            <img src="images\about__image.jpg" alt="Canon 70x70">
            <div class="text_block">
                <p><b>Ищете мощный бинокль для самых разных целей? Тогда вы не будете разочарованы биноклем модели Canon Hunter, который может увеличивать объекты до 10 крат. Десять крат&nbsp;означает, что предмет удаленный на 1 километр вы сможете рассмотреть как с расстояния 100 метров (в&nbsp;10&nbsp;раз ближе). Существует заблуждение: чем больше увеличение, тем лучше. Но&nbsp;это&nbsp;не совсем так. С ростом увеличение во-первых, уменьшается угол обзора, а во-вторых, вам потребуется штатив, так как уже на 16 крат картинка будет заметно дрожать в руках.&nbsp;</b></p>
                <p>Таким образом, и охотнику, и рыболову, и любому человеку такой бинокль принесет пользу. Важным качеством является то, что бинокль можно применять и в условиях слабой освещенности, то есть даже в темном лесу вы сможете рассмотреть дикое животное или птицу. Для яркости и насыщенности цветов в бинокле установлена Porro-призма (Порро), а благодаря просветляющему покрытию оптики границы изображения будут четкими и незамутненными, в какой бы точке поля зрения ни находился объект. Блики и другие дефекты практически исключены. Ближайшая точка, на которой может сфокусироваться бинокль, может находиться на расстоянии 5 метров от наблюдателя. Центральная система фокусировки.</p>
                <ul>
                    <li>Увеличение - 10 крат</li>
                    <li>Диаметр объектива&nbsp; (апертура) - 50 мм</li>
                    <li>Влагозащищен, ударопрочный. Не скользит в руках</li>
                    <li>Диапазон рабочих температур от -40° до +50°С</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- /about -->
    <!-- benefits -->
    <div class="benefits_section">
        <div class="wrapper clearfix">
            <div class="benefit_item">
                <img src="images\benefits__benefit1_icon.png" alt="Canon 70x70">
                <h4>Большой диаметр объектива</h4>
                <p>Расширяет поле зрения и способствует повышению яркости изображения</p>
            </div>
            <div class="benefit_item">
                <img src="images\benefits__benefit2_icon.png" alt="Canon 70x70">
                <h4>Линзы со специальным покрытием</h4>
                <p>Многослойное просветляющее покрытием повышает яркость и резкость изображения</p>
            </div>
            <div class="benefit_item">
                <img src="images\benefits__benefit3_icon.png" alt="Canon 70x70">
                <h4>Ударопрочность и надежность</h4>
                <p>Резиновое покрытие обеспечивает защиту от ударов и надежный, удобный захват</p>
            </div>
        </div>
    </div>
    <!-- /benefits -->
    <!-- info -->
    <section class="info_section">
        <div class="wrapper">
            <h2>Биноколь, способный на многое <b>Особенности оптики Canon HUNTER</b></h2>
            <div class="info_list clearfix">
                <div class="info_item">
                    <p>Высокая степень увеличения</p>
                    <img src="images\info__info1_image.jpg" alt="Canon 70x70">
                </div>
                <div class="info_item">
                    <p>Картинка высокой четкости</p>
                    <img src="images\info__info2_image.jpg" alt="Canon 70x70">
                </div>
                <div class="info_item">
                    <p>Поверхность стекла отражает свет</p>
                    <img src="images\info__info3_image.jpg" alt="Canon 70x70">
                </div>
                <div class="info_item">
                    <img src="images\info__info4_image.png" alt="Canon 70x70">
                </div>
            </div>
            <a href="#order_form" class="button">Оформить заказ</a>
        </div>
    </section>
    <!-- /info -->
    <!-- characteristics -->
    <section class="characteristics_section">
        <div class="wrapper clearfix">
            <div class="characteristics_block">
                <h3>Характеристики:</h3>
                <ul class="clearfix">
                    <li><b>Производитель:</b> Canon</li>
                    <li><b>Крышки:</b>&nbsp;4 шт</li>
                    <li><b>Zoom:</b> фиксированный</li>
                    <li><b>Призма:</b> Porro</li>
                    <li><b>Корпус:</b> металлический</li>
                    <li><b>Стекло:</b>&nbsp;BK-7, синие</li>
                    <li><b>Кратности:</b>&nbsp;10 крат</li>
                    <li><b>Цвет:</b> черный</li>
                    <li><b>&nbsp;Габариты, мм:</b> 200x165x58</li>
                    <li><b>&nbsp;Комплектация:</b>&nbsp;Бинокль, чехол, ремешок, салфетки, 2 крышки объектива, 2 крышки окуляра</li>
                </ul>
            </div>
            <div class="slider owl-carousel">
                <img src="images\characteristics__slider__image1.jpg" alt="Canon 70x70">
                <img src="images\characteristics__slider__image2.jpg" alt="Canon 70x70">
                <img src="images\characteristics__slider__image3.jpg" alt="Canon 70x70">
            </div>
        </div>
    </section>
    <!-- /characteristics -->
    <!-- gift -->
    <section class="gift_section">
        <div class="wrapper">
            <h2>Аксессуар для настоящих мужчин <b>Часы Swiss Army в подарок!</b></h2>
            <div class="gift_block">
                <img src="images\gift__image.png" alt="Canon 70x70">
                <div class="characteristics_block">
                    <h3>Характеристики часов:</h3>
                    <ul class="clearfix d-flex flex-wrap ">
                        <li><b>Материал:</b> сталь</li>
                        <li><b>Питание:</b> батарея CR2106</li>
                        <li><b>Длина:</b> 230 мм</li>
                        <li><b>Ремешок:</b> нейлон</li>
                        <li><b>Ширина:</b> 20 мм</li>
                        <li><b>Механизм:</b> кварцевый</li>
                        <li><b>Цвет:</b> черный</li>
                        <li><b>Водонепроницаемость:</b>&nbsp; до 10 м</li>
                    </ul>
                    </div>
                </div>
            </div>
    </section>
    <!-- /gift -->
    <!-- reviews -->
    <section class="reviews_section">
        <div class="wrapper">
            <div class="title_wrapper">
                <h2>Мощный бинокль Canon hunter <b>Отзывы довольных покупателей</b></h2>
            </div>
            <div class="reviews_list slider owl-carousel">
                <div class="review_item">
                    <img class="photo" src="images\reviews__review1_photo.png" alt="Canon 70x70">
                    <div class="text_block">
                        <div class="author_block">
                            <img class="avatar" src="images\reviews__review1_avatar.jpg" alt="Canon 70x70">
                            <div class="name">Сергей, г. Чита</div>
                        </div>
                        <p>Большое спасибо Вам за отличную работу! Очень качественная оптика, полностью доволен, в руках не скользит,&nbsp; удобный, картинка четкая, без бликов. Удивлен, признаться не ожидал. Буду рекомендовать к приобретению. Отдельное спасибо за часы в подарок, порадовали, только я их потерял на охоте ))</p>
                    </div>
                </div>
                <div class="review_item">
                    <img class="photo" src="images\reviews__review2_photo.png" alt="Canon 70x70">
                    <div class="text_block">
                        <div class="author_block">
                            <img class="avatar" src="images\reviews__review2_avatar.jpg" alt="Canon 70x70">
                            <div class="name">Алексей, с. Борзя</div>
                        </div>
                        <p>Заказал CANON. Качество начиная от упаковки и заканчивая изделием на высоте. Упаковано очень надежно и добросовестно. Бинокль очень понравился, видимость на 5+, часы красиво смотрятся и удобно сидят на руке. Посылка пришла быстро. Спасибо магазину "Охота" за труд.</p>
                    </div>
                </div>
                <div class="review_item">
                    <img class="photo" src="images\reviews__review3_photo.png" alt="Canon 70x70">
                    <div class="text_block">
                        <div class="author_block">
                            <img class="avatar" src="images\reviews__review3_avatar.jpg" alt="Canon 70x70">
                            <div class="name">Валерий , г. Братск</div>
                        </div>
                        <p>Неделю назад сбылась моя детская мечта, получил свой бинокль. Что могу сказать, биноклем очень доволен, не ожидал, что будет такое четкое изображение, не желтит, в отличие от советских биноклей. В общем очень доволен, кто думает брать или нет, берите - не пожалеете! Плюс бонус замечательный подарок, спасибо!</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /reviews -->
    <!-- order info -->
    <section class="order_info_section">
        <div class="wrapper">
            <h2><b>Доставка и оплата</b></h2>
            <div class="info_list clearfix">
                <div class="info_item">
                    <div class="icon_block">
                        <img src="images\order_info__info1_icon.jpg" alt="Canon 70x70">
                    </div>
                    <div class="text_block">
                        <h4>Быстрая доставка</h4>
                        <p>Почтой или курьером в течение 3-12 рабочих дней. Стоимость доставки от 340 руб., в зависимости от региона</p>
                    </div>
                </div>
                <div class="info_item">
                    <div class="icon_block">
                        <img src="images\order_info__info2_icon.jpg" alt="Canon 70x70">
                    </div>
                    <div class="text_block">
                        <h4>Оплата при получении</h4>
                        <p>Мы не принимаем предоплат. Оплата производится только при получении заказа на руки.</p>
                    </div>
                </div>
                <div class="info_item">
                    <div class="icon_block">
                        <img src="images\order_info__info3_icon.jpg" alt="Canon 70x70">
                    </div>
                    <div class="text_block">
                        <h4>Гарантии</h4>
                        <p>Гарантия 12 месяцев. Вся продукция проходит проверку по качеству перед отправкой клиентам.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /order info -->
    <!-- offer -->
    <section id="order" class="offer_section">
        <div class="wrapper">
            <div class="title_block">
                <h3 class="main_title">ОХОТНИЧИЙ<i>&nbsp;</i><span>бинокль&nbsp;-&nbsp;CANON HUNTER&nbsp;<span class="present-pr">Часы SWISS ARMY В ПОДАРОК.</span></span></h3>
                <p class="subtitle">Для наблюдения на рыбалке, охоте или на природе <span></span></p>
            </div>
            <div class="discount_block">
                <div class="text">Скидка</div>
                <div class="value">-70%</div>
            </div>
            <div class="form_block">
                <div class="price_block clearfix">
                    <div class="price_item old">
                        <div class="text">Старая цена:</div>
                        <div class="value">8300р</div>
                    </div>
                    <div class="price_item new">
                        <div class="text">Новая цена:</div>
                        <div class="value"><?php echo $price['real_price']; ?></div>
                    </div>
                </div>
                <form id="order_form" class="order_form" action="./_success_/" method="post">
                    <input type='hidden' name='referer' value="<?php echo isset($_GET['referer']) ? $_GET['referer'] : $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] ;?>">
<input type="hidden" name="subid1"  value="<?php echo isset($_GET['subid1']) ? $_GET['subid1'] : '' ;?>" />
<input type="hidden" name="subid2"  value="<?php echo isset($_GET['subid2']) ? $_GET['subid2'] : '' ;?>" />
<input type="hidden" name="subid3"  value="<?php echo isset($_GET['subid3']) ? $_GET['subid3'] : '' ;?>" />
<input type="hidden" name="subid4"  value="<?php echo isset($_GET['subid4']) ? $_GET['subid4'] : '' ;?>" />  
<input type="hidden" name="subid5"  value="<?php echo isset($_GET['subid5']) ? $_GET['subid5'] : '' ;?>" />
                    <input class="input" type="text" name="name" placeholder="Введите Ваше имя" required="">
                    <input class="input" type="tel" name="phone" placeholder="Введите Ваш телефон" required="">
                    <button class="button">Оформить заказ</button>
                    
                </form>
                <div class="products_count">Количество товара&nbsp;<b>ограничено!</b></div>
            </div>
        </div>
    </section>
    <!-- /offer -->
    <!-- footer -->
    <footer class="footer_section">
        <p style="color:#fff;">Официальный представитель</p>
        <p style="color:#fff;">оптики в России ООО "ОХОТА"</p>
        <p style="color:#fff;">630114, г. Новосибирск, ул. Ватутина, д. 19</p>
        <p style="color:#fff;">ОГРН 1125476077836 ИНН 5405453872</p>
        <a target="_blank" href="politics.html">Политика конфиденциальности</a><br>
        </footer>
    <!-- /footer -->
    <!-- scripts -->
    <link rel="stylesheet" type="text/css" href="static\fonts\roboto.css">
    <script src="static\js\jquery.js" type="text/javascript"></script>
    <script src="static/js/plugins.js" type="text/javascript"></script>
    <script src="static\js\detect.js" type="text/javascript"></script>
    <link href="static/css/popup-m1-style.css.css" rel="stylesheet" type="text/css">
    <script src="static/js/popup-m1.js" type="text/javascript"></script>
    <script src="static\land\js\slider\owlCarousel-2.2.1\owl.carousel.js"></script>
    <script src="js\scripts.js"></script>
    <!-- /scripts -->
    <link href="lp-base.css" rel="stylesheet">
   
</body>
</html>
