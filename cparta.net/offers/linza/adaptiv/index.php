<?php 
   $offer = 24;
   include_once $_SERVER['DOCUMENT_ROOT'].'/../includes/landingsData/index2.php';
?> 
<!DOCTYPE html>
<html lang="ru">
<head>
  
    <!-- Содержимое HEAD индексного файла -->
   <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css\form.min.css?lvcss=201810261218">
<script type="text/javascript">
/*<![CDATA[*/
document.write('<scr'+'ipt type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js">'+'</scr'+'ipt>');
document.write('<scr'+'ipt type="text/javascript">lvjq1 = jQu'+'ery.noConflict(true);</scr'+'ipt>');
/*]]>*/
</script>

<title>LINZA — Умный видеорегистратор с поддержкой 4G</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="files\f\fb\linza-dvr.ru\files\index_files\bootstrap.css">
    <link href="files\f\fb\linza-dvr.ru\files\index_files\slick.css" rel="stylesheet">
    <link href="files\f\fb\linza-dvr.ru\files\index_files\slick-theme.css" rel="stylesheet">
    <link rel="stylesheet" href="files\f\fb\linza-dvr.ru\files\index_files\style.css">
    <link rel="stylesheet" href="files\f\fb\linza-dvr.ru\files\index_files\media.css">


    <script src="files\f\fb\linza-dvr.ru\files\index_files\timer.js"></script>
    <script src="files\f\fb\linza-dvr.ru\files\index_files\timer.min.js"></script>
    <link href="files\f\fb\linza-dvr.ru\files\index_files\css.css" rel="stylesheet" type="text/css">    <!-- Содержимое, помещаемое в HEAD -->
    <!-- newLandings -->


</head>
<body>

 
    <section class="sect1">
        
        <div class="container cont2_sect1">
            <div class="row">
                <div class="col-md-6  col-sm-6 pos_rel">
                    <p class="text1">LINZA — Умный видеорегистратор с поддержкой 4G </p>
                    <p class="text2">Знает все о вашем автомобиле и легко управляем со смартфона и веб-приложения </p>
                    <ul class="myclass" style="color:white; font-size: 130%; margin: 10px 0px;">
                        <li>Видео FullHD 1920х1080</li>
                        <li>Wi-Fi модуль</li>
                        <li>Голосовой помощник</li>
                        <li>150° угол обзора</li>
                        <li>Управление с телефона</li>
                        <li>Поддержка 4G </li>
                        <li>GPS и ГЛОНАСС</li>
                    </ul>
                    <div class="block_akciya">Скидка<br><span>-83 %</span></div>
                    <div class="block_price">
                        <p class="new_price al-cost"><?php echo $price['real_price']; ?> </p>
                        <p class="old_price al-cost-promo"> 17580 Руб</p>
                    </div>

                    <div class="block_form">
                        <p class="t1_form">АКЦИЯ ТОЛЬКО СЕГОДНЯ:</p>
                        <script src="//megatimer.ru/get/5331c1ae45ba981a61b9aa602a5665f1.js"></script>
                        
						<form class="form1 al-form form clearfix lv2-form lv2-form1" id="lv-formLanding1" action="./_success_/" method="post">
<input type='hidden' name='referer' value="<?php echo isset($_GET['referer']) ? $_GET['referer'] : $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] ;?>">
<input type="hidden" name="subid1"  value="<?php echo isset($_GET['subid1']) ? $_GET['subid1'] : '' ;?>" />
<input type="hidden" name="subid2"  value="<?php echo isset($_GET['subid2']) ? $_GET['subid2'] : '' ;?>" />
<input type="hidden" name="subid3"  value="<?php echo isset($_GET['subid3']) ? $_GET['subid3'] : '' ;?>" />
<input type="hidden" name="subid4"  value="<?php echo isset($_GET['subid4']) ? $_GET['subid4'] : '' ;?>" />  
<input type="hidden" name="subid5"  value="<?php echo isset($_GET['subid5']) ? $_GET['subid5'] : '' ;?>" />

                            <div class="row">
                                <div class="col-md-12">
                                    <input style="background: #fff;height: 50px;" class="input form-control form_field_text_input form-input txt-m" placeholder="Введите Ваше имя" id="lv-formLanding1-fio" name="name" type="text" maxlength="255" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <input style="background: #fff;height: 50px;" class="form-control input textField form_field_text_input form_phone form-input txt-m" placeholder="Введите Ваш телефон" id="lv-formLanding1-phone" name="phone" type="text" maxlength="25" required>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 but_box">
                                    <button type="submit" class="btn btn-danger ">
                                        УСПЕЙТЕ ЗАКАЗАТЬ
                                    </button>
                                </div>
                            </div> 
</form>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6">
                  
                </div>
            </div>
        </div>
    </section>

    <style>
        .thumb-wrap {
            position: relative;
            padding-bottom: 56.25%;
            /* задаёт высоту контейнера для 16:9 (если 4:3 — поставьте 75%) */
            padding-top: 30px;
            height: 0;
            overflow: hidden;
        }

        .thumb-wrap iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        .sound__wrappe {}

        .sound__block {
            display: flex;
            justify-content: space-between;
        }

        .vid {
            width: 47%;
            margin-bottom: 30px;
        }

        @media only screen and (max-width:720px) {
            .sound__block {
                width: 100%;
                flex-wrap: wrap;
            }

            .sound__wrappe {
                flex-wrap: wrap;
            }

            .vid {
                width: 100%;

            }
        }
    </style>
    <section class="sect2" id="video">
        <div class="container">
            <div class="sound__wrappe">
                <div class="">
                    <h2 style="text-align: center;">LINZA - видеорегистратор с голосовым помощником</h2>
                    <p> Linza мгновенно превращает ваш автомобиль в «умный»! Ваши повседневные поездки становятся более
                        безопасными, а рутинные задачи превращаются в увлекательные занятия.</p>
                    <p>Камера с высоким разрешением и большим углом обзора записывает все ваши маршруты. Вы можете быть
                        уверены, что ни один важный момент не будет упущен, а надежно сохранится в облаке.</p>

                </div>
                <div class="sound__block">
                    <div class="vid">
                        <div class="thumb-wrap">
                            <iframe width="560" height="315" src="https://www.youtube.com/embed/uXeXWLYOAgE" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
                        </div>

                    </div>
                    <div class="vid">
                        <div class="thumb-wrap">
                            <iframe width="560" height="315" src="https://www.youtube.com/embed/I2QwTKSs3Yg" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </section>
    <img src="files\f\fb\linza-dvr.ru\files\images\photo2.jpeg" alt="">
    <style>
        .design__item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .design__img {
            width: 47%;
        }

        .design__text {
            width: 47%;
        }

        .design__text h3 {
            font-weight: 900;
            font-size: 130%;
            margin-bottom: 10px;
        }

        .design__text p {

            font-size: 110%;
            margin-bottom: 10px;
        }

        .design__second {
            padding-left: 30px;
        }

        .sect3 {
            background: #e5e5e5;
            padding-bottom: 100px;
            height: auto;
        }

        @media only screen and (max-width:720px) {
            .design__item {

                padding: 10px;
                flex-wrap: wrap;
            }

            .design__img {
                width: 100%;
            }

            .design__text {
                width: 100%;
            }

            .design__second .design__img {
                order: -1;
            }
        }
    </style>
    <section class="sect3" id="vid" style="">
        <div class="container">
            <h2 style="text-align: center; margin-bottom: 30px;">Дополните дизайн вашего автомобиля вместе с Linza</h2>
        </div>

        <div class="design__item">
            <div class="design__img">
                <img src="files\f\fb\linza-dvr.ru\files\images\photo3.jpeg" alt="">
            </div>
            <div class="design__text">
                <h3> БЕЗОПАСНОСТЬ И ИНФОРМИРОВАННОСТЬ</h3>
                <p> В режиме парковки Linza может отслеживать движение автомобиля и отправлять уведомление об
                    эвакуации или ударе.</p>
                <p> В режиме парковки Linza может отслеживать движение автомобиля и отправлять уведомление об
                    эвакуации или ударе.</p>



            </div>
        </div>

        <div class="design__item design__second">
            <div class="design__text ">
                <h3>
                    ИНТЕЛЛЕКТУАЛЬНОЕ И ЛЕГКОЕ ПОДКЛЮЧЕНИЕ
                </h3>
                <p> Linza — это персональный мобильный Wi-Fi роутер, который всегда в вашем автомобиле. Мы поддержали
                    несколько беспроводных протоколов, включая 4G LTE, Bluetooth Low Energy (BLE) и Wi-Fi, чтобы
                    радикально упростить и ускорить взаимодействие с вашей камерой и предоставить доступ к вашим
                    фотографиям и видео.
                </p>
                <h3>
                    OBD
                </h3>
                <p> Проводите самостоятельную диагностику автомобиля с помощью дополнительного OBD адаптера, который
                    подключается к вашей Linza через Bluetooth. Данные диагностики автомобиля и все параметры поездки
                    отображаются через приложение на вашем смартфоне в режиме реального времени.
                </p>
            </div>
            <div class="design__img">
                <img src="files\f\fb\linza-dvr.ru\files\images\photo4.jpeg" alt="">
            </div>
        </div>

        <div class="design__item">
            <div class="design__img">
                <img src="files\f\fb\linza-dvr.ru\files\images\photo5.jpeg" alt="">
            </div>
            <div class="design__text">
                <h3> ОБЛАЧНОЕ ХРАНИЛИЩЕ</h3>
                <p>
                    Все отмеченные фотографии и видеоролики немедленно отправляются в облако Linza через сеть 4G LTE и
                    доступны вам с любого устройства и в любое время.

                </p>
                <h3> ПУБЛИЧНАЯ КАРТА</h3>
                <p>
                    Вы можете добавлять свои фотографии и видео в общедоступную публичную карту Linza, чтобы делиться
                    важными новостями со всеми. Пробки на дорогах, дорожные происшествия и даже забавные истории в
                    вашем городе - все это будет доступно на бесплатной публичной карте Linza по всему миру.
                </p>
            </div>
        </div>


    </section>



    <section class="sect4" style="background: url('files/f/fb/linza-dvr.ru/files/images/bg3.jpeg') no-repeat center / cover ;  ">
        <div class="container">



            <h2> НЕ ПРОПУСКАЙТЕ ВАЖНЫЕ МОМЕНТЫ</h2>
            <p style="max-width: 600px;"> Сохраняйте фотографии и отмечайте видео одним нажатием кнопки Bluetooth, не
                отвлекаясь от дороги. Копка подключается к вашей через приложение и позволяет осуществлять
                беспрепятственный контроль во время вождения. Прикрепите ее к приборной панели рядом с рулем и
                наслаждайтесь дорогой.

                <br> Теперь вы можете в реальном времени сообщать об актуальных событиях, сохранять важные моменты и
                даже автоматически делиться ими в социальных сетях или на публичной карте Linza.

            </p>

        </div>

        
    </section>


    <section style=" margin-top: 30px; ">
        <div class="container">



            <h2 style="text-align: center;"> Надежное хранение видео и фото</h2>
            <p style="text-align: center;"> Linza™ не только ведет запись на внешнюю microSD-карту, но и моментально
                отправляет данные в защищенное облачное хранилище. Вы будете иметь к ним доступ из любой точки мира при
                условии подключения к сети Интернет.


            </p>
        </div>
        <div class="design__item">
            <div class="design__img">
                <img src="files\f\fb\linza-dvr.ru\files\images\photo6.png" alt="">
            </div>
            <div class="design__text " style="padding-left: 30px;">



                <h3>
                    Уведомления о событиях
                </h3>
                <p> Благодаря встроенному гироскопу и акселерометру камера чувствует внешние воздействия на машину.
                    Linza незамедлительно отправит пользователю push-уведомление о подозрительных активностях с
                    автомобилем, а также сохранит видеоролик в облачное хранилище.
                </p>



            </div>

        </div>

        <div class="design__item design__second">





            <div class="design__text">
                <h3> История поездок</h3>
                <p>
                    Linza запоминает ваш маршрут и скорость езды. Вы можете точно узнать, когда и на каком отрезке
                    пути
                    возникла неисправность или опасная ситуация.


                </p>




            </div>
            <div class="design__img">
                <img src="files\f\fb\linza-dvr.ru\files\images\photo7.png" alt="">
            </div>

        </div>
        <div class="design__item ">
            <div class="design__img">
                <img src="files\f\fb\linza-dvr.ru\files\images\photo8.png" alt="">
            </div>
            <div class="design__text" style="padding-left: 30px;">
                <h3> Публичная карта</h3>
                <p>
                    На публичной карте можно узнать о ДТП, пробке, и других происшествиях, таким образом
                    заблаговременно выбрать безопасный маршрут и сэкономить время и деньги.

                </p>
            </div>



        </div>

        
    </section>













    <style>
        .char__wrapper {
            display: flex;
        }

        .char__item {
            width: 33%;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        .char__1 {
            font-size: 130%;
            margin-bottom: 10px;
            font-weight: 600;
            text-align: center;
        }

        @media only screen and (max-width:720px) {
            .char__item {
                width: 100%;
            }

            .char__wrapper {
                flex-wrap: wrap;
            }
        }
    </style>
    <section>
        <div class="wrapper">
            <h2 style="text-align: center;">Технические характеристики</h2>

            <div class="char__wrapper">
                <div class="char__item">
                    <div class="char__1"> Съемка при слабом освещении</div>
                    <div class="char__1"> Функция 3G/4G роутера</div>
                    <div class="char__1">Встроенная память 16 Гигабайт</div>
                    <div class="char__1"> Bluetooth</div>
                    <div class="char__1"> Слот для micro-SIM карты</div>







                </div>
                <div class="char__item">
                    <img src="files\f\fb\linza-dvr.ru\files\images\photo9.jpeg" alt="  ">
                </div>
                <div class="char__item">
                    <div class="char__1"> Шумоподавляющий микрофон</div>
                    <div class="char__1"> Крепление с присоской</div>
                    <div class="char__1"> Full HD съемка30 кадров/сек.</div>
                    <div class="char__1"> Встроенный гироскоп и акселерометр</div>
                    <div class="char__1"> MicroSD-карта в комплекте</div>






                </div>
            </div>
        </div>
    </section>

    <section>
        <img src="files\f\fb\linza-dvr.ru\files\images\photo10.jpeg" alt="">
    </section>

    <section class="sect6" id="otz">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
               
                    <p class="t1_sect2">Отзывы тех, кто уже пользуется регистратором Linza</p>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="trusted-slider">
                        <div class="slides ">

                            <div class="block_otz ">
                                <img class="otz_img" src="files\f\fb\linza-dvr.ru\files\index_files\otz1.png" alt="Реплика Huawei P20 Pro" title="Реплика Huawei P20 Pro">
                                <div class="media-body">
                                    <p class="name_otz">Иван Быков</p>
                                </div>
                                <div class="clearfix"></div>
                                <p class="text_otz">Получил на днях долгожданный видеорегистратор! Без сомнения один из
                                    лучших, которые я видел и пользовался. Тут и великолепное качество съемки и что
                                    самое главное, так это голосовое управление. Очень классная штука! Раньше подобным
                                    не пользовался, так что это в новинку.
                                    Так же порадовало управление со смартфона, порой очень сильно выручает. Так что
                                    всем, кто хотел приобрести себе видеорегистратор, советую Linza!
                                </p>
                            </div>
                            <div class="block_otz ">
                                <img class="otz_img" src="files\f\fb\linza-dvr.ru\files\index_files\otz2.png" alt="Реплика Huawei P20 Pro" title="Реплика Huawei P20 Pro">
                                <div class="media-body">
                                    <p class="name_otz">Михаил Вороткин</p>
                                </div>
                                <div class="clearfix"></div>
                                <p class="text_otz">Давно приглядывался к этому видеорегистратору. Внешний вид,
                                    характеристики – все было на высшем уровне, вот только останавливало то, что
                                    заказывать через интернет было боязно. Через какое-то время увидел этот регистратор
                                    у знакомого в машине. Соответственно, тот и посоветовал мне Ваш сайт. Мало того,
                                    что заказ дошел очень быстро, так ещё и все как в описание было. Прекрасный
                                    регистратор за свои деньги! </p>
                            </div>
                            <div class="block_otz ">
                                <img class="otz_img" src="files\f\fb\linza-dvr.ru\files\index_files\otz3.png" alt="Реплика Huawei P20 Pro" title="Реплика Huawei P20 Pro">
                                <div class="media-body">
                                    <p class="name_otz">Андрей Золотухин</p>
                                </div>
                                <div class="clearfix"></div>
                                <p class="text_otz">Около двух месяцев назад получил регистратор в подарок от жены.
                                    Сначала чот руки не доходили поставить, соответственно около двух недель он лежал в
                                    коробке. Потом все-таки достал, поставил, подключил напрямую к электрике своей
                                    машины - все гуд. Самое главное, что мне нравится: даже на скорости over 170
                                    картинка не превращается в размытое пятно. Так за качество можно не переживать, все
                                    супер! </p>
                            </div>
                            <div class="block_otz ">
                                <img class="otz_img" src="files\f\fb\linza-dvr.ru\files\index_files\otz4.png" alt="Реплика Huawei P20 Pro" title="Реплика Huawei P20 Pro">
                                <div class="media-body">
                                    <p class="name_otz">Андрей Золотухин</p>
                                </div>
                                <div class="clearfix"></div>
                                <p class="text_otz">Около двух месяцев назад получил регистратор в подарок от жены.
                                    Сначала чот руки не доходили поставить, соответственно около двух недель он лежал в
                                    коробке. Потом все-таки достал, поставил, подключил напрямую к электрике своей
                                    машины - все гуд. Самое главное, что мне нравится: даже на скорости over 170
                                    картинка не превращается в размытое пятно. Так за качество можно не переживать, все
                                    супер! </p>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="sect7">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <p class="t1_dost">ДОСТАВКА ПО  <span>РОССИИ</span></p>
                    <img class="figure" src="files\f\fb\linza-dvr.ru\files\index_files\figure.png" alt="Реплика Huawei P20 Pro" title="Реплика Huawei P20 Pro">

                    <p class="t3_dost"><img src="files\f\fb\linza-dvr.ru\files\index_files\ic1_dost.png" alt="Реплика Huawei P20 Pro" title="Реплика Huawei P20 Pro">
                        ДОСТАВКА ПОЧТОЙ ОТ 3 ДО 7 РАБОЧИХ ДНЕЙ</p>
                    <p class="t3_dost"><img src="files\f\fb\linza-dvr.ru\files\index_files\ic2_dost.png" alt="Реплика Huawei P20 Pro" title="Реплика Huawei P20 Pro">
                        Вы оплачиваете заказ при получении на почте</p>
                </div>
                <div class="col-md-6 col-sm-6">
                    <div class="block_dost">
                        <img src="files\f\fb\linza-dvr.ru\files\index_files\pr.jpeg" alt="Реплика Huawei P20 Pro" title="Реплика Huawei P20 Pro"><br>

                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </section>

    <section class="sect1">

        <div class="container cont2_sect1">
            <div class="row">
                <div class="col-md-6  col-sm-6 pos_rel">
                    <p class="text1">LINZA — Умный видеорегистратор с поддержкой 4G </p>
                    <p class="text2">Знает все о вашем автомобиле и легко управляем со смартфона и веб-приложения </p>
                    <ul class="myclass" style="color:white; font-size: 130%; margin: 10px 0px;">
                        <li>Видео FullHD 1920х1080</li>
                        <li>Wi-Fi модуль</li>
                        <li>Голосовой помощник</li>
                        <li>150° угол обзора</li>
                        <li>Управление с телефона</li>
                        <li>Поддержка 4G </li>
                        <li>GPS и ГЛОНАСС</li>
                    </ul>
                    <div class="block_akciya">Скидка<br><span>-83 %</span></div>
                    <div class="block_price">
                        <p class="new_price al-cost"><?php echo $price['real_price']; ?></p>
                        <p class="old_price al-cost-promo"> 17580 Руб</p>
                    </div>

                    <div class="block_form">
                        <p class="t1_form">АКЦИЯ ТОЛЬКО СЕГОДНЯ:</p>
                       <script src="//megatimer.ru/get/5331c1ae45ba981a61b9aa602a5665f1.js"></script>
                        						<form class="form1 al-form form clearfix lv2-form lv2-form2 " id="lv-formLanding2" action="./_success_/" method="post">
<input type='hidden' name='referer' value="<?php echo isset($_GET['referer']) ? $_GET['referer'] : $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] ;?>">
<input type="hidden" name="subid1"  value="<?php echo isset($_GET['subid1']) ? $_GET['subid1'] : '' ;?>" />
<input type="hidden" name="subid2"  value="<?php echo isset($_GET['subid2']) ? $_GET['subid2'] : '' ;?>" />
<input type="hidden" name="subid3"  value="<?php echo isset($_GET['subid3']) ? $_GET['subid3'] : '' ;?>" />
<input type="hidden" name="subid4"  value="<?php echo isset($_GET['subid4']) ? $_GET['subid4'] : '' ;?>" />  
<input type="hidden" name="subid5"  value="<?php echo isset($_GET['subid5']) ? $_GET['subid5'] : '' ;?>" />

                            <div class="row">
                                <div class="col-md-12">
                                    <input style="background: #fff;height: 50px;" class="input form-control form_field_text_input form-input txt-m" placeholder="Введите Ваше имя" id="lv-formLanding2-fio" name="name" type="text" maxlength="255" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <input style="background: #fff;height: 50px;" class="form-control input textField form_field_text_input form_phone form-input txt-m" placeholder="Введите Ваш телефон" id="lv-formLanding2-phone" name="phone" type="text" maxlength="25" required>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 but_box">
                                    <button type="submit" class="btn btn-danger ">
                                        УСПЕЙТЕ ЗАКАЗАТЬ
                                    </button>
                                </div>
                            </div> 
</form>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6">
                </div>
            </div>
        </div>
    </section>

    <footer>
        <div class="container">
            <div class="row">
                <div style="margin:15px 0; text-align:center;">
                    ООО «Трейдонлайн», ОГРН: 5177723581498, ИНН: 654987218, г. Москва, ул. Медынская, 9
 <br>

                    <br>
                    <a style="color:inherit;" target="_blank" href="politika.pdf">Политика
                        конфиденциальности</a>
                 
                </div>
            </div>
        </div>
    </footer>







 
    <script src="files\f\fb\linza-dvr.ru\files\index_files\jquery.js" type="text/javascript"></script>


 
    <script src="files\f\fb\linza-dvr.ru\files\index_files\slick.js"></script>

    <script>
        function change_visibility(block_4_close, block_4_open) {
            $(document).ready(function () {
                $('#' + block_4_close).css('display', 'none');
                $('#' + block_4_open).css('display', '');
                return false;
            });
        }
    </script>
    <script>
        var $page = $('html, body');
        $('a[href*="#"]').click(function () {
            $page.animate({
                scrollTop: $($.attr(this, 'href')).offset().top
            }, 600);
            return false;
        });
    </script>

  
</body>
</html>
