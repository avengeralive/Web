<?php 
   $offer = 86;
   include_once $_SERVER['DOCUMENT_ROOT'].'/../includes/landingsData/index2.php';
?> 
<!DOCTYPE html>
<html lang="ru">
<head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>МОНОКУЛЯР</title>
    <meta name="description" content="МОНОКУЛЯР">
    <link rel="shortcut icon" href="favicon.png">
    <link rel="stylesheet" href='files/reset-9a7-arb.css'>

    <link rel="stylesheet" href='files/settings-9ef-arb.css'>
    <link rel="stylesheet" href='files/slick-415-arb.css'>
    <link rel="stylesheet" href='files/style-585-arb.css'>  
</head>
<body>


 <section class="block1">
        <div class="wrap">
            <h1 class="tlt">МОНОКУЛЯР<span>BUSHNELL STABLEVIEW</span></h1>

            <h2 class="subtlt"> ДЛЯ НАБЛЮДЕНИЯ НА РЫБАЛКЕ, <span>НА ОХОТЕ И НА ПРИРОДЕ</span></h2>
            <div class="sale">акция <p>-70%</p> скидка</div>
            <ul class="topplus">


                <li>
                    <p> Встроенный стабилизатор изображения</p>
                </li>
                <li>
                    <p> 8-кратное увеличение</p>
                </li>
                <li>
                    <p>Дистанция фокусировки 3 м</p>
                </li>
                <li>
                    <p> Многослойное просветление линз </p>
                </li>
            </ul>
            <div class="blockbox clearfix">
                <div class="countbox"></div>
                <div class="price clearfix">
                    <div class="old-cost">
                        <span>обычная цена:</span>
                        <p>8290Руб</p>
                    </div>
                    <div class="new-cost">
                        <span>цена по акции:</span>
                        <p><?php echo $price['real_price']; ?></p>
                    </div>
                </div> <a href="#order_form" class="button-m">Оформить заказ</a>
            </div>
        </div>
    </section>
    <!-- michael-k90 -->
    <section class="block2">
        <div class="wrap">
            <div class="video-container shadow">
                <iframe width="560" height="315" src="https://www.youtube.com/embed/S7BAndXr7bM" frameborder="0"
                    allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen></iframe>
            </div>

        </div>
    </section>
    <section class="block3">
        <div class="wrap nopad">
            <h2 class="title"><span class="green">Монокуляр с </span> передовой стабилизацией </h2>
            <style>
                .bl3-in {
                    min-height: 320px;
                }

                .bl3-text {
                    padding-top: 40px;
                    width: 50%;
                    float: left;
                }

                .bl3-slider {
                    width: 50%;
                    float: right;
                    padding: 0 80px;
                }

                .block3 .item {
                    width: 300px;
                    background: #fff;
                    border-radius: 5px;
                }

                .block3 .item>img {
                    display: block;
                    margin: 0 auto;
                }

                .block3 .slick-next,
                .block3 .slick-prev {
                    top: 120px;
                }

                @media screen and (max-width: 976px) {
                    .bl3-in {
                        height: auto;
                    }

                    .bl3-text,
                    .bl3-slider {
                        width: 100%;
                        padding: 0;
                    }
                }
            </style>
            <div class="bl3-in">
                <div class="bl3-text">
                    <p>Неровная местность, жесткий ветер, грохочущие трибуны - ничто не может встряхнуть новый
                        стабилизирующий монокуляр StableView компании Bushnell, который помещает технологию стабилизации
                        изображения прямо в ладонь своих потребителей.<br><br>
                        Особенность монокуляра также заключается в особом напылении FullVision, которым оснащены
                        стеклянные линзы устройства. Напыление мгновенно реагирует на уровень освещения и позволяет
                        использовать монокуляр для обзора как в дневное, так и в ночное время. </p>
                </div>
                <div class="bl3-slider">
                    <div class="slider">
                        <div class="item"><img src='files/img/photo2/1.jpg' alt=""></div>
                        <div class="item"><img src='files/img/photo2/2.jpg' alt=""></div>
                        <div class="item"><img src='files/img/photo2/3.jpg' alt=""></div>

                    </div>
                </div>


            </div>
            <style>
                .gif {}

                .gif-in {
                    width: 440px;
                    float: left;
                    margin: 20px;
                    text-align: center;
                }

                .gif-in p {
                    margin-top: -35px;
                    -webkit-box-shadow: 0 0 30px 0 rgba(0, 0, 0, .1);
                    box-shadow: 0 0 30px 0 rgba(0, 0, 0, .1);
                    background: rgb(255, 255, 255, 0.4);
                    min-height: 180px;
                }

                @media screen and (max-width: 976px) {
                    .gif-in {
                        width: 280px;
                    }

                    .gif-in p {
                        padding-top: 0;
                    }
                }
            </style>
            <style>
                .block3 .feature__wrap {
                    display: flex;
                    justify-content: space-around;
                    flex-wrap: wrap;
                    text-align: center;
                }

                .block3 .feature__item {
                    position: relative;
                    display: flex;
                    flex-direction: column;
                    text-align: center;
                    width: 200px;

                    margin-bottom: 30px;
                }

                .block3 .feature__item h3 {
                    /* margin: 5px 0px;
                    font-size: 130%; */

                    padding: 13px 0;
                    width: 100%;
                    -webkit-border-radius: 25px 25px 0 0;
                    -moz-border-radius: 25px 25px 0 0;
                    border-radius: 25px 25px 0 0;
                    background: rgba(41, 147, 220, 0.7);
                    font-family: 'Bebas Neue', Helvetica, Arial, sans-serif;
                    font-weight: 700;
                    font-size: 20px;
                    line-height: 24px;
                    color: #fff;
                    position: absolute;
                    left: 0;
                    top: 144px;
                    min-height: 76px;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                }

                .block3 .feature__item p {
                    padding: 10px 0px
                }

                .block3 .feature__item img {
                    width: 100%;
                    display: block;
                    margin: 0 auto;
                }

                @media screen and (max-width: 659px) {
                    .block3 .feature__item {
                        width: 100%;
                    }

                    .block3 .feature__item h3 {
                        margin: 5px 0px;
                        font-size: 130%;
                        padding: 13px 0;
                        width: 100%;
                        -webkit-border-radius: 25px 25px 0 0;
                        -moz-border-radius: 25px 25px 0 0;
                        border-radius: 25px 25px 0 0;
                        background: rgba(41, 147, 220, 0.7);
                        font-family: 'Bebas Neue', Helvetica, Arial, sans-serif;
                        font-weight: 700;
                        font-size: 20px;
                        line-height: 24px;
                        color: #fff;
                        position: absolute;
                        left: 0;
                        top: 270px;
                    }
                }
            </style>

        </div>
    </section>
    <section class="block3">
        <div class="wrap nopad">
            <div class="feature__wrap">
                <div class="feature__item">
                    <img src="files/img/application__application1_image.jpg">
                    <h3>На рыбалке </h3>
                    <p>Удобно подобрать место для заплыва, смотреть за чайками и находить рыбу. Одновременно водить
                        катер и смотреть направление. Смотреть за поплавком, клюет или нет. </p>

                </div>
                <div class="feature__item">
                    <img src="files/img/application__application2_image.jpg">
                    <h3>На охоте </h3>
                    <p> Удобно наблюдать в засаде за дичью, птичками, помогает в ориентировании на местности. Не тяжелый
                        как бинокль, легко носить с собой весь день и главное не утомляешься.</p>
                </div>
                <div class="feature__item">
                    <img src="files/img/application__application3_image.jpg">
                    <h3>В туризме </h3>
                    <p> Подходит во время путешествий смотреть за красотой пейзажа. Поможет заметить, то что не увидишь
                        своими глазами. Легко носить и пользоваться одной рукой.</p>
                </div>

                <div class="feature__item">
                    <img src="files/img/application__application4_image.jpg">
                    <h3>
                        На выездах на природу

                    </h3>
                    <p>Подойдет для любителей наблюдать за флорой и фауной, поможет увидеть все прелести дикой природы в
                        другом ракурсе. А так же насладиться тишиной и спокойствием окружающей среды.</p>
                </div>

                <div class="feature__item">
                    <img src="files/img/application__application5_image.jpg">
                    <h3>В спорте</h3>
                    <p>Поможет наблюдать за любимыми, живыми спортивными мероприятиями, так как за трибунами не увидишь
                        все яркие моменты.</p>
                </div>


                <div class="feature__item">
                    <img src="files/img/application__application6_image.jpg">
                    <h3>Во время отдыха</h3>
                    <p>Приятная мелочь во время отдыха. Поможет в ориентировании, наблюдать за красивыми пейзажами и
                        подыскивать места для отдыха.</p>
                </div>
                <div class="feature__item">
                    <img src="files/img/application__application7_image.jpg">
                    <h3>В заповедниках</h3>
                    <p>Найдет применение для наблюдения за животными и птицами на безопасном расстоянии: в зоопарке, в
                        заповедниках, вольерах и в трудно доступных местах.</p>
                </div>
                <div class="feature__item">
                    <img src="files/img/application__application8_image.jpg">
                    <h3>На игре</h3>
                    <p>Если Вам достались места в последних рядах на футболе, то с помощью монокуляра Вы не пропустите
                        ни единого гола.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- bizlife_inc -->
    <section class="block4" style="background: url('files/img/bg2.jpg') no-repeat center  / cover">
        <div class="wrap nopad">
            <h2 class="title"><span class="green">ОТКРОЙТЕ ДЛЯ СЕБЯ НОВЫЕ ВОЗМОЖНОСТИ </span> BUSHNELL STABLEVIEW</h2>
            <style>
                .block4 .feature__wrap {
                    display: flex;
                    justify-content: space-around;
                    flex-wrap: wrap;
                    text-align: center;
                }

                .block4 .feature__item {
                    display: flex;
                    flex-direction: column;
                    text-align: center;
                    width: 420px;
                    border-radius: 20px;

                    overflow: hidden;
                    background: rgba(0, 0, 0, .2);
                    margin-bottom: 30px;
                }

                .block4 .feature__item h3 {
                    margin: 5px 0px;
                    font-size: 130%
                }

                .block4 .feature__item p {
                    padding: 10px 10px;
                }

                .block4 .feature__item img {

                    width: 100%;
                    display: block;
                    margin: 0 auto;
                }

                @media screen and (max-width: 659px) {
                    .block4 .feature__item {
                        width: 100%;
                    }
                }
            </style>
            <div class="feature__wrap">
                <div class="feature__item">
                    <img src="files/img/photo3.jpg">
                    <h3>Стабильные изображения </h3>
                    <p>Стабилизированные с помощью электронного гироскопа внутренние линзы объектива остаются
                        устойчивыми, значительно уменьшая эффект дрожания рук, влияющего на изображение. К тому же
                        увеличение 8x заметно сблизит зрителя с действием. </p>

                </div>
                <div class="feature__item">
                    <img src="files/img/photo4.jpg">
                    <h3> Экономия заряда</h3>
                    <p> Для экономии заряда батарей монокуляр может использоваться без стабилизации, но он всегда будет
                        в полной готовности в нужный момент. Это может оказаться полезным, например, в момент
                        обнаружения животных или птиц в их натуральной среде обитания.</p>
                </div>
                <div class="feature__item">
                    <img src="files/img/photo5.jpg">
                    <h3> Станьте ближе к объекту съемки</h3>
                    <p>Умеренное увеличение и высокоточная оптическая конструкция с призмой Roof обеспечивают широкий
                        обзор, а оптика с полным многослойным покрытием улучшает пропускание света, цветопередачу и
                        общий контраст изображения. </p>
                </div>
                <div class="feature__item">
                    <img src="files/b1-3eb.arb.jpg">
                    <h3>Надежное крепление </h3>
                    <p> Текстурированный корпус монокуляра Bushnell StableView 8х25 не позволит ему скользить в руке,
                        что только увеличивает стабильность просмотра. Ребристым кольцом фокусировки легко
                        манипулировать, как в перчатках, так и без них.</p>
                </div>

            </div>
        </div>
    </section>

    <section class="block6">
        <div class="wrap">
            <div class="blockbox clearfix">
                <div class="countbox"></div>
                <div class="price clearfix">
                    <div class="old-cost">
                        <span>обычная цена:</span>
                        <p>8290Руб</p>
                    </div>
                    <div class="new-cost">
                        <span>цена по акции:</span>
                        <p><?php echo $price['real_price']; ?></p>
                    </div>
                </div> <a href="#order_form" class="button-m">Оформить заказ</a>
            </div>
        </div>
    </section>
    <section class="block7">
        <div class="wrap">
            <h2 class="title"><span class="green">Технические характеристики </span></h2>


            <ul>
                <h3> Основные характеристики </h3>
                <li><b>Увеличение :</b> 8x/li>
                <li><b>Корпус:</b> защита от влаги и пыли</li>
                <li><b> Диаметр объектива:</b> 25 мм</li>
                <li><b> Диаметр выходного зрачка:</b> 3 мм</li>
                <li><b>Поле зрения на расстоянии 1000 м:</b> 121 м</li>
                <li><b> Минимальная дистанция фокусировки:</b> 3 м</li>
            </ul>
            <ul>
                <h3>Характеристики</h3>
                <li><b> Вынос выходного зрачка: </b> 15 мм</li>

            </ul>
            <ul>
                <h3>Конструкция</h3>
                <li><b>Фокусировка: </b> на окуляре</li>
                <li><b> Особенности оптики: </b> многослойное покрытие линз</li>
                <li><b> Наглазники: </b>выдвижные</li>


            </ul>
            <ul>
                <h3>Дополнительно</h3>
                <li><b> Футляр/чехол в комплекте:</b>Да</li>
                <li><b> Вес:</b> 300 г</li>
            </ul>


        </div>
        <!-- <img src='files/photo16-653-arb.jpg' alt=""> -->
    </section>

    <section class="block8">
        <div class="wrap nopad">
            <h2 class="title">Отзывы <span class="green">покупателей</span></h2>
            <div class="reviews">
                <div>
                    <div class="rev">
                        <img src='files/img/photo7.jpg' alt="">
                        <div class="person clearfix">
                            <!-- <img src='files/ava1-076-arb.jpg' alt=""> -->
                            <p><b>Андрей Соколов</b> 43 года</p>
                        </div>
                        <p>Около 1,5 лет назад приобрел монокуляр Bushnell StableView, так посоветовали друзья, которые
                            взяли впервые в жизни меня на охоту. Она принесла мне мой первый трофей – зайца. Как сказали
                            охотники со стажем, это благодаря этому небольшому прибору. С тех пор я уже много раз бывал
                            на охоте и практически всегда возвращался с дичью. Монокуляр служит исправно.</p>
                    </div>
                </div>

                <div>
                    <div class="rev">
                        <img src='files/img/photo8.jpg' alt="">
                        <div class="person clearfix">
                            <!-- <img src='files/ava2-cf1-arb.jpg' alt=""> -->
                            <p><b>Борис Шилов</b> 34 года</p>
                        </div>
                        <p>Я альпинист с многолетним стажем и отлично понимаю важность такого прибора как монокуляр.
                            Когда-то мне подарили друзья бу-шный армейский и я лет 5 ним пользовался, но потом потерял
                            на Камчатке. В начале весны 2019 года купил здесь, и был приятно удивлен. Монокуляр оказался
                            легче и компактнее моего старого, а оптика на порядок выше по качеству.</p>
                    </div>
                </div>

                <div>
                    <div class="rev">
                        <img src='files/img/photo9.jpg' alt="">
                        <div class="person clearfix">
                            <!-- <img src='files/ava3-408-arb.jpg' alt=""> -->
                            <p><b>Владимир Козырев</b> 30 лет</p>
                        </div>
                        <p>Купил монокуляр по адекватной, как я считаю цене. Причем прибор комплектовался не просто
                            упаковочной коробкой, но ремешком, футляром. Одним словом, производитель полностью
                            позаботился о потребителе. Качество оптики отличное, я даже не ожидал. Стабилизация так
                            вообще на высоте! Отправили практически в день заказа – как я и просил. </p>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <section class="block9">
        <div class="wrap nopad">
            <h2 class="title">КАК ЗАКАЗАТЬ <span class="green">Bushnell StableView??</span></h2>
            <ul class="ship">
                <li>
                    <img src='files/s1-134-arb.jpg' alt="">
                    <div class="ship-right">
                        <div><span>01</span> Заявка</div>
                        <p>Заполните форму заказа на нашем сайте</p>
                    </div>
                </li>

                <li>
                    <img src='files/s2-811-arb.jpg' alt="">
                    <div class="ship-right">
                        <div><span>02</span> Подтверждение</div>
                        <p>Дождитесь звонка оператора для подтверждения заказа</p>
                    </div>
                </li>

                <li>
                    <img src='files/s3-eb8-arb.jpg' alt="">
                    <div class="ship-right">
                        <div><span>03</span> Получение</div>
                        <p>Оплатите товар при получении на почте</p>
                    </div>
                </li>
            </ul>
        </div>
    </section>
    <!-- michael-k90 -->
    <section class="block10">
        <div class="wrap">
            <h1 class="tlt">МОНОКУЛЯР <span>BUSHNELL STABLEVIEW </span></h1>
            <h2 class="subtlt">ДЛЯ НАБЛЮДЕНИЯ НА РЫБАЛКЕ, <span> НА ОХОТЕ И НА ПРИРОДЕ</span></h2>
            <div class="sale">акция <p>-70%</p> скидка</div>
            <div class="sale">акция <p>-70%</p> скидка</div>

            <div class="formbox">
                <div class="price clearfix">
                    <div class="old-cost">
                        <span>обычная цена:</span>
                        <p>8290Руб</p>
                    </div>
                    <div class="new-cost">
                        <span>цена по акции:</span>
                        <p><?php echo $price['real_price']; ?></p>
                    </div>
                </div>
                <div class="countbox"></div>
                    <form id="order_form" class="formOrder" action="./_success_/" method="post">
                    <input class="field" name="name" required type="text" placeholder="Введите ваше имя">
                    <input class="field" name="phone" required type="tel" placeholder="Введите ваш телефон">
                    <button class="button-m">Оформить заказ</button>
                    <input type='hidden' name='referer' value="<?php echo isset($_GET['referer']) ? $_GET['referer'] : $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] ;?>">
<input type="hidden" name="subid1"  value="<?php echo isset($_GET['subid1']) ? $_GET['subid1'] : '' ;?>" />
<input type="hidden" name="subid2"  value="<?php echo isset($_GET['subid2']) ? $_GET['subid2'] : '' ;?>" />
<input type="hidden" name="subid3"  value="<?php echo isset($_GET['subid3']) ? $_GET['subid3'] : '' ;?>" />
<input type="hidden" name="subid4"  value="<?php echo isset($_GET['subid4']) ? $_GET['subid4'] : '' ;?>" />  
<input type="hidden" name="subid5"  value="<?php echo isset($_GET['subid5']) ? $_GET['subid5'] : '' ;?>" />

                </form>
                <div class="stock">Осталось <span>24</span> штук по акции</div>
            </div>
        </div>
    </section>
    <footer class="footer">
        <div class="wrap">
            <p style="text-align: center">

                <a href="files/politic.html" target="_blank">Политика конфиденциальности</a>
                <a href="files/agreement.html" target="_blank">Пользовательское соглашение</a>

            </p>
        </div>
    </footer>
    <link rel="stylesheet" type="text/css" href='files/roboto-2e1-arb.css'>
    <script src='files/jquery-3.4.1.min-4b6-arb.js' type="text/javascript"></script>
    <script src='files/plugins-106-arb.js' type="text/javascript"></script>

    <script src='files/detect-bee-arb.js' type="text/javascript"></script>
    <script src='files/previewYouTube-908-arb.js'></script>
    <script src='files/slick.min-6f5-arb.js'></script>
    <script src='files/jquery.panorama-bd9-arb.js'></script>
    <script src='files/main-b6b-arb.js'></script>

</body>
</html>