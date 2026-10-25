<!DOCTYPE html>
<!-- /*
Template Name: Страница "VR v.1.0"
*/ -->
<!--[if lt IE 7]><html lang="ru" class="lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if IE 7]><html lang="ru" class="lt-ie9 lt-ie8"><![endif]-->
<!--[if IE 8]><html lang="ru" class="lt-ie9"><![endif]-->
<!--[if gt IE 8]><!-->
<html lang="ru">
<!--<![endif]-->
<head>
<meta charset="utf-8">
    <meta charset="utf-8" />
    <title>Разработка виртуальной VR и дополненной реальности AR на заказ</title>
<?php
if(is_page()) {
    if(get_post_meta($post->ID, "meta-description", true) !='' ) {
        echo '<meta name="description" content="' . get_post_meta($post->ID, "meta-description", true) . '" />';
        echo "\n";
    }
    if(get_post_meta($post->ID, "meta-keywords", true) !='' ) {
        echo '<meta name="keywords" content="' . get_post_meta($post->ID, "meta-keywords", true) . '" />';
        echo "\n";
    }
}
?>
<noindex>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimal-ui">
    <meta name="format-detection" content="telephone=no">
    <meta name="format-detection" content="address=no">
    <meta name="copyright" content="">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <link rel="shortcut icon" href="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/favicon.png" />
    <link rel="stylesheet" href="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/libs/font-awesome-4.2.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/libs/fancybox/jquery.fancybox.css" />
    <link rel="stylesheet" href="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/libs/owl-carousel/owl.carousel.css" />
    <link rel="stylesheet" href="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/libs/countdown/jquery.countdown.css" />
    <link rel="stylesheet" href="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/css/fonts.css" />
    <link rel="stylesheet" href="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/css/main.css" />
    <link rel="stylesheet" href="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/css/main2.css" />
    <link rel="stylesheet" href="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/css/media.css" />
    <link href="https://infoshell.ru/wp-content/themes/mark_up/css1/formCorrections.css" rel="stylesheet">
    <link href="https://infoshell.ru/wp-content/themes/mark_up/css1/main.css?1439406648325" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900&amp;subset=latin,cyrillic" rel="stylesheet">
    <link href="https://infoshell.ru/wp-content/themes/mark_up/css1/main.css?1439406648325" rel="stylesheet">
    <link rel="stylesheet" href="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/css/corporate.css">
    <style>
        section div.container-960 div.tables div.cell.text-cell h3 {
            text-align: left;
        }
        div.work-stage-image img.left-image {
            top: 10px;
        }
        .d-flex {
            display: flex;
        }
        .d-flex>div {
            flex: 1;
        }

        .logo-header-ios {
            background-image: url(/wp-content/uploads/2017/07/logo.svg);
            background-size: cover;
        }
        .logo-header-ios>img {
            opacity: 0;
        }

        .contacts-ios .btn-call-me {
            border: solid 2px #edb933;
            color: #edb933;
            background-image: url(https://infoshell.ru/wp-content/uploads/2018/01/ic-call.svg);
        }
        .contacts-ios .tel {
            color: #fff;
        }



        .d-flex img {
            max-width: 100%;
        }

        .mb-24 {
            margin-bottom: 24px!important;
        }

        #vr-with-mobile {
            background-image: url(/wp-content/uploads/2018/01/bg-blur-04.jpg);
            background-size: cover;
        }
        #vr-with-mobile .d-flex>div {
            flex: 1 auto;
        }

        section.tech-stack {
            min-height: auto;
        }
        section.tech-stack div.the-stack {
            padding-top: 0;
        }
        #developed-projects {
            background-color: #f9c747;
        }
        #our-services {
            background-color: rgba(249, 199, 71, .1);
        }
        #our-services h2 {
            text-transform: initial;
            margin-bottom: 24px;
            font-size: 24px;
        }
        .head-container .title-corporate {
            margin-top: 0;
        }
        .header-ios {
            display: flex;
            align-items: center;
            min-height: 100vh;
            background-image: url(https://infoshell.ru/wp-content/uploads/2017/12/img-header-vr.jpg);
        }
        .header-ios .nav-ios {
            top: 0;
        }
        .head-container .title-corporate h1 {
            font-size: 32px;
            margin-top: 28px;
            margin-bottom: 28px;
        }
        section.tasks-we-solve {
            min-height: initial;
        }
        section.tasks-we-solve div.tasks {
            padding-top: 0;
        }
        .work-stages {
            margin-bottom: 0;
        }
        ol.work-stages>li.work-stage:last-child {
            padding-bottom: 0;
        }

        section.tasks-we-solve div.tasks .subtitle {
            color: #aaa;
        }

        section h2 {
            font-size: 36px;
            line-height: 1.2!important;
            margin-bottom: 24px!important;
        }
        .body-ios h3 {
            margin-bottom: 16px;
        }
        .list-of-brands {
            margin-top: 32px;
            margin-bottom: 32px;
        }
        .body-ios h3.text-left {
            text-align: left;
        }
        #tech-systems .btn {
            border: solid 2px #282828;
        }

        .fullsize {
            position: absolute;
            left: 0;
            right: 0;
            top: 0;
            bottom: 0;
            width: 100%;
            height: 100vh;
            overflow: hidden;
        }
        .with-dashed-border-top {
            border-top: none;
        }

        #tech-systems img {
            max-width: 100%;
        }

        .bg-slider-1 {
            background-image: url(https://infoshell.ru/wp-content/uploads/2018/01/bg_slider_1.jpg);
        }
        
        .external-link {
            position: relative;
            display: block;
            color: #fff;
        }
        .external-link img {
            transition: all .4s ease;
        }
        .external-link:hover img {
            filter: brightness(60%);
        }
        .external-link:before {
            content: attr(data-title);
            display: block;
            position: absolute;
            width: 48px;
            height: 48px;
            background-image: url(https://infoshell.ru/wp-content/uploads/2018/01/ic-view-more.svg);
            background-repeat: no-repeat;
            padding-top: 60px;
            margin: auto;
            z-index: 1;
            left: 0;
            right: 0;
            top: 0;
            bottom: 0;
            opacity: 0;
            transition: opacity .4s ease;
        }
        .external-link:hover:before {
            opacity: 1;
        }

        @media (max-width: 767px) {
            .head-container .title-corporate h1 {
                font-size: 24px;
            }
            section h2 {
                font-size: 24px!important;
            }
            .d-flex {
                flex-direction: column;
            }
            
            .work-stage, .work-stage-last{
                display: flex;
                flex-direction: column;
            }
            div.work-stage-image img.left-image {
                position: relative;
                margin-bottom: 24px;
            }
            .work-stage-content, .work-stage-image {
                display: block;
                text-align: center;
                width: initial;
            }
            .work-stage-content {
                padding-left: 0;
            }
        }
    </style>
    <script src="https://infoshell.ru/wp-content/themes/mark_up/js/library.js"></script>
</noindex>
    <!-- Facebook Pixel Code -->
        <script>
        !function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
        n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
        n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
        t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
        document,'script','//connect.facebook.net/en_US/fbevents.js');

        fbq('init', '975313775862135');
        fbq('track', "PageView");</script>
        <noscript><img height="1" width="1" style="display:none"
        src="https://www.facebook.com/tr?id=975313775862135&ev=PageView&noscript=1"
        /></noscript>
    <!-- End Facebook Pixel Code -->

    <script src="https://infoshell.ru/wp-content/themes/mark_up/js1/ajaxForms.js?v=1.4"></script>
</head>
<body class="body-ios">
    <header class="header-ios">
        <div class="fullsize">
            <video autoplay loop>
              <source src="https://infoshell.ru/wp-content/uploads/2018/01/AVRPlatformHeroBack6-2.mp4" type="video/mp4">
            Your browser does not support the video tag.
            </video>
        </div>
        <div class="nav-ios">
            <div class="container-960">
                <a href="/" class="logo-header-ios"><img src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/img/header-logo.png" alt="Инфошелл"></a>
                <button class="button-main-mnu"></button>
                <nav>
                    <ul>
                        <li><a href="/portfolio/" class="active">Портфолио</a></li>
                        <li><a href="/services/">Услуги</a></li>
                        <li><a href="/company/">Компания</a></li>
                        <li><a href="/contact/">Контакты</a></li>
                    </ul>
                </nav>
                <div class="contacts-ios clearfix">
                    <div class="tel">Мск: +7 (495) 215 51 82 <br>СПб: +7 (812) 242 80 58</div>
                    <a id="ZAKAZ_ZVONKA" href="#" onclick="clik_show()" data-toggle="modal" data-target="#modal-1" class="btn-call-me"><span>Заказать<br> звонок</span></a>
                </div>
                <a href="/services/" class="all-services"> <i class="fa fa-long-arrow-left"></i> Все услуги</a>
            </div>      
        </div>
        
        <div class="head-container">
            <div class="title-corporate text-center">
                <img src="/wp-content/uploads/2017/12/logo-vr.svg" alt="">
                <h1 class="h2">РАЗРАБОТКА ПРИЛОЖЕНИЙ И ИГР С ТЕХНОЛОГИЕЙ <br>ВИРТУАЛЬНОЙ И ДОПОЛНЕННОЙ РЕАЛЬНОСТИ</h1>
                <div class="request-button">
                    <a href="" data-toggle="modal" data-target="#modal-2" class="btn corporate-btn btn-yellow">оставить заявку</a>
                </div>
            </div>
        </div>
    </header>
    <div id="modal-1" class="modal in" style="display: none; padding-right: 0px;">
        <div class="modal-content">
            <div class="modal-header-icon">
                <div class="icon Phone_call_modal"></div>
            </div>
            <div class="modal-header-text">Оставьте свой номер телефона, <br>и мы вам обязательно перезвоним!</div>
            <div data-goals="callback_service,all_callbacks,all_goals" id="emailForm" class="question-form contactForm">
                <div class="control-group">
                    <input type="text" name="name" placeholder="Ваше имя.." class="inputbox full">
                </div>
                <!-- /control-group-->
                <div class="control-group">
                    <input type="text" name="phone" placeholder="Ваш телефон..*" class="inputbox full">
                </div>
                <!-- /control-group-->
                <div class="control-group">
                    <input type="text" name="email" placeholder="Ваш e-mail.." class="inputbox full">
                </div>
                <!-- /control-group-->
                <div class="control-group text-center">
                    <span class="btn btn-yellow contactFormSubmit">Отправить</span>
                </div>
                <!-- /control-group-->
            </div>
            <!-- /form-->
            <div class="modal-close"><a href="" data-dismiss="modal"><span>×</span>Закрыть</a></div>
        </div>
    </div>
    <section id="our-services" class="text-black text-center">
        <div class="container">
            <h2 class="noBorderTop">Студия InfoShell оказывает услуги по разработке виртуальной реальности на заказ</h2>
            <p>Тренажеры и симуляторы, аттракционы,  инновационные маркетинговые инструменты, игры - мы проконсультируем и подберем подходящее программное решение именно для решения ваших задач. В проектах наших клиентов мы используем самые передовые технологии.</p>
        </div>      
    </section>

<section class="tasks-we-solve">
    <div class="container tasks">
        <h2>Сферы применения технологии <br>виртуальной реальности</h2>
        <div class="subtitle">Мы создаем решения с учетом специфики вашей отрасли</div>
        <div class="work-process">
            <ol class="work-stages">
                <li class="work-stage">
                    <div class="work-stage-image">
                        <img class="left-image" src="/wp-content/uploads/2017/12/ic-task-05.svg">
                    </div>
                    <div class="work-stage-content">
                        <span class="work-stage-head">Образование</span>
                        <span class="work-stage-solution-text">Технологии дополненной и виртуальной реальности по-особенному воздействует на мышление человека. Они улучшают восприятие информации и повышают скорость обучения.</span>
                    </div>
                </li>


                <li class="work-stage">
                    <div class="work-stage-image">
                        <img class="left-image" src="/wp-content/uploads/2017/12/ic-task-06.svg">
                    </div>
                    <div class="work-stage-content">
                        <span class="work-stage-head">Энергетика</span>
                        <span class="work-stage-solution-text">Тренажеры с технологией дополненной и виртуальной реальности (AR/VR) лучше развивают навыки, увеличивают объем запоминаемой информации, формируют знание через экспериментальный опыт. Такие системы позволяют проводить интерактивное обучение рабочих на реалистичном симуляторе для отработки критических процедур.</span>
                    </div>
                </li>

                <li class="work-stage">
                    <div class="work-stage-image">
                        <img class="left-image" src="/wp-content/uploads/2017/12/ic-task-07.svg">
                    </div>
                    <div class="work-stage-content">
                        <span class="work-stage-head">Медицина и биотехнологии</span>
                        <span class="work-stage-solution-text">Медицинские AR и VR приложения обеспечивают потрясающую визуализацию анатомического строения тела человека, что делает их незаменимыми в студенческой практике. </span>
                    </div>
                </li>

                <li class="work-stage">
                    <div class="work-stage-image">
                        <img class="left-image" src="/wp-content/uploads/2017/12/ic-task-08.svg">
                    </div>
                    <div class="work-stage-content">
                        <span class="work-stage-head">Промышленность</span>
                        <span class="work-stage-solution-text">VR-симулятор облегчает процесс взаимодействия рабочих с оборудованием. Это повышает безопасность и производительность на предприятии.</span>
                    </div>
                </li>

                <li class="work-stage">
                    <div class="work-stage-image">
                        <img class="left-image" src="/wp-content/uploads/2017/12/ic-task-09.svg">
                    </div>
                    <div class="work-stage-content">
                        <span class="work-stage-head">БЕЗОПАСНОСТЬ</span>
                        <span class="work-stage-solution-text">Для надлежащей подготовки к чрезвычайной ситуации требуется создать обстановку, максимально приближенную к реальности. Традиционное обучение сложно организовать, так как это ресурсоемкий и затратный процесс. Технологии дополненной и виртуальной реальности (AR/VR) сокращают бюджет обучающих мероприятий и максимально погружают участников в моделируемую ситуацию.</span>
                    </div>
                </li>

                <li class="work-stage">
                    <div class="work-stage-image">
                        <img class="left-image" src="/wp-content/uploads/2017/12/ic-task-10.svg">
                    </div>
                    <div class="work-stage-content">
                        <span class="work-stage-head">Медиа и Развлечения</span>
                        <span class="work-stage-solution-text">VR приложения с игровыми механиками и тематическими инсталляциями на 27% повышают вовлеченность зрителя. Разработка VR приложений – отличный способ «оживить» контент, вызвать бурю эмоций, вовлечь потенциального потребителя во взаимодействие с брендом.</span>
                    </div>
                </li>
            </ol>
        </div>
    </div>
</section>
<section id="tech-systems">
    <div class="container">
        <div class="text-center">
            <h2>Системы с которыми работаем</h2>
            <div class="subtitle"><strong>Шлем дополненной AR / виртуальной реальности VR</strong></div>
            <div class="list-of-brands">
                <img src="/wp-content/uploads/2017/12/ic-logo-product-01.jpg" alt="">
                <img src="/wp-content/uploads/2017/12/ic-logo-product-02.png" alt="">
                <img src="/wp-content/uploads/2017/12/ic-logo-product-03.png" alt="">
                <img src="/wp-content/uploads/2017/12/ic-logo-product-04.png" alt="">
            </div>
        </div>
        <div class="d-flex">
            <div>
                <h3 class="text-left">Oculus Rift и HTC Vive</h3>
                <p>Передовые решения отображения Oculus Rift и HTC Vive в сочетании с их точной системой отслеживания и низкой задержкой передачи видеоконтента позволяют создать ощущение реального присутствия.</p>
                <div class="text-right"><img src="/wp-content/uploads/2018/01/rift-1.png" alt=""></div>
            </div>
            <div class="text-right">
                <img src="/wp-content/uploads/2018/01/oculus.png" alt="">
                <img src="/wp-content/uploads/2018/01/rift-2.png" alt="">
            </div>
        </div>
        <div class="text-center">
            <h3>Microsoft HoloLens, Epson Moverio</h3>
            <div>Очки Microsoft HoloLens, Epson Moverio, Meta позволяют создавать смешанную <br>реальность за счет накладывания виртуальных объектов на существующие.</div>
            <img src="/wp-content/uploads/2018/01/microsoft-holo-lens-1.png" alt="">
            <div class="d-flex">
                <div><img src="/wp-content/uploads/2018/01/microsoft-holo-lens-2.png" alt=""></div>
                <div class="text-right"><img src="/wp-content/uploads/2018/01/microsoft-holo-len-3.png" alt=""></div>
            </div>
        </div>
        <div class="request-button">
            <a href="" data-toggle="modal" data-target="#modal-2" class="btn corporate-btn">оставить заявку</a>
        </div>
    </div>
</section>
<section id="vr-with-mobile">
    <div class="container d-flex text-center">
        <div class="title-header">
            <h3>Дополненная реальность через <br>мобильный телефон</h3>
            <p class="mb-24">Мобильное устройство накладывают соответствующие данные в виде интерактивных 3D- и 2D-моделей с привязкой к определенным меткам или гео-позиции. Теперь вы можете взаимодействовать с окружающей вас средой совершенно по-новому посредством мобильного телефона.</p>
            <img src="/wp-content/uploads/2017/12/ic-3-d.svg" alt="">
        </div>
        <div style="min-width: 80px;"></div>
        <div class="title-header">
            <h3>Интерактивное <br>зеркало</h3>
            <p class="mb-24">Интерактивное зеркало на основе технологии дополненной реальности идеально подходит для мест с высокой посещаемостью и  привлечет внимание многих за счет: спортивной игры с зеркалом, виртуальной примерочной и других вариантов взаимодействия с интерактивным зеркалом. </p>
            <img src="/wp-content/uploads/2017/12/ic-mirror.svg" alt="">
        </div>
    </div>
</section>
<section class="tech-stack">
    <div class="container the-stack">
        <h2>Наш технологический стек</h2>
        <div class="techlist">
            <img class="iconTech" src="https://infoshell.ru/wp-content/uploads/2017/12/ic-teh-25.png">
            <img class="iconTech" src="https://infoshell.ru/wp-content/uploads/2017/12/ic-teh-26.png">
            <img class="iconTech" src="https://infoshell.ru/wp-content/uploads/2017/12/ic-teh-27.png">
            <img class="iconTech" src="https://infoshell.ru/wp-content/uploads/2017/12/ic-teh-28.png">
            <img class="iconTech" src="https://infoshell.ru/wp-content/uploads/2017/12/ic-teh-29.png">
            <img class="iconTech" src="https://infoshell.ru/wp-content/uploads/2017/12/ic-teh-30.png">
            <img class="iconTech" src="https://infoshell.ru/wp-content/uploads/2017/12/ic-teh-31.png">
            <img class="iconTech" src="https://infoshell.ru/wp-content/uploads/2017/12/ic-teh-32.png">
            <img class="iconTech" src="https://infoshell.ru/wp-content/uploads/2017/12/ic-teh-33.png">
            <img class="iconTech" src="https://infoshell.ru/wp-content/uploads/2017/12/ic-teh-34.png">
            <img class="iconTech" src="https://infoshell.ru/wp-content/uploads/2017/12/ic-teh-35.png">
        </div>
    </div>
</section>
<section id="developed-projects">
    <div class="container text-center">
        <h2>РАЗРАБОТАННЫЕ ПРОЕКТЫ</h2>
        <p class="mb-24">Студия InfoShell оказывает услуги по разработке приложений <br>виртуальной и дополненной реальности (VR и AR) под ключ.</p>

        <div class="d-flex">
            <div style="padding-right:12px;">
                <a target="_blank" href="https://infoshell.ru/portfolio/program/city-history/" class="external-link" data-title="City History"><img src="https://infoshell.ru/wp-content/uploads/2018/01/city_history1.png" alt="" class="mb-24"></a>
                <img src="https://infoshell.ru/wp-content/uploads/2018/01/ic-vr-min.svg" alt="" class="mb-24">
                <h3>City History</h3>
                <p>AR проект об истории Санкт-Петербурга для туристов и жителей города.</p>
            </div>
            <div style="padding-left:12px;">
                <a target="_blank" href="#" class="external-link" data-title="Orbland"><img src="https://infoshell.ru/wp-content/uploads/2018/01/orbland1.png" alt="" class="mb-24"></a>
                <img src="https://infoshell.ru/wp-content/uploads/2018/01/ic-vr-min.svg" alt="" class="mb-24">
                <h3>Orbland</h3>
                <p>Первая игра на VR с новейшей системой PvP, космическим мультиплеером и реалистичной графикой с возможностью развития персонажа.</p>
            </div>
        </div>
    </div>
</section>
<section class="section-block bg-slider-1">
    <div class="container">
        <h3 class="section-header-dark">СРОКИ И ЦЕНА РАЗРАБОТКИ ДОПОЛНЕННОЙ И ВИРТУАЛЬНОЙ РЕАЛЬНОСТИ</h3>
        <p class="section-text-dark mb-24">Стоимость vr разработки рассчитывается индивидуально. Расскажите нам про проект в любой удобной форме, и мы оперативно вышлем коммерческое предложение. </p>
    </div>
    <!-- /container-->
    <div class="container">
        <div class="question-face"><img alt="сотрудник infoshell" src="https://infoshell.ru/wp-content/themes/mark_up/img1/faces/kirill-popov.png"  width="160" height="160">
            <div> <b>Кирилл Попов</b><br><span>Руководитель отдела по работе с клиентами</span></div>
        </div>
        <!-- /question-face-->
        <div data-goals="project_estimate_main,all_project_price_check,all_goals" id="callForm" class="question-form contactForm">
            <input type="hidden" value="EXPERT_OCENKA" name="ymparam">
            <div class="control-group">
                <div class="col-item-3">
                    <input type="text" name="name" placeholder="Ваше имя.." class="inputbox full">
                </div>
                <div class="col-item-3">
                    <input type="text" name="phone" placeholder="Ваш телефон..*" class="inputbox full">
                </div>
                <div class="col-item-3">
                    <input type="text" name="email" placeholder="Ваш e-mail.." class="inputbox full">
                </div>
            </div>
            <!-- /control-group-->
            <div class="control-group">
                <textarea rows="10" name="message" placeholder="Опишите, пожалуйста, проект.." class="inputbox full clear"></textarea>
                </div>
            <!-- /control-group-->
            <div class="control-group">
                <div class="attachment">
                    <div class="attach-container">
                        <div class="attach-file">
                            <div class="icon Attach"></div><span class="attach-file-name">Добавить файл</span>
                        </div>
                        <!-- /attach-file-dummy-->
                        <input type="file" class="attach-file-input" name="upload_file">
                        <!-- /hidden file input-->
                    </div>
                    <!-- /attach-container--><a href="" class="attach-reset">&times;</a>
                </div>
                <!-- /attachment-->
                <div class="submit-btn">
                    <span class="btn btn-black contactFormSubmit">Узнать стоимость</span>
                </div>
            </div>
            <!-- /control-group-->
        </div>
        <!-- /form-->
    </div>
    <!-- /container-->
</section>
<section class="section-block container-mobile-full with-dashed-border-top">
    <h3 class="section-header-dark">С нами работают</h3>
    <div class="companies-list">
        <!-- / ! JADE DONT PRETTIFY INLINE HTML ELEMENTS, SORRY--><a href="/portfolio/program/audio_tour_azbo/" class="company"><img alt="создание приложения путеводитель по городам" src="<?php echo get_template_directory_uri(); ?>/img/companies-color/azbo.png" img alt="приложения путеводитель" class="hidden"><img alt="создание приложения AUDIO TOUR AZBO" src="<?php echo get_template_directory_uri(); ?>/img/companies/azbo.png" class="visible"></a>
        <!-- /a.company--><a href="/portfolio/program/zenit/" class="company"><img alt="приложения ФК ЗЕНИТ" src="<?php echo get_template_directory_uri(); ?>/img/companies-color/zenit.png" class="hidden"><img alt="создание приложения для футбольного клуба зенит" src="<?php echo get_template_directory_uri(); ?>/img/companies/zenit.png" class="visible"></a>
        <!-- /a.company--><a href="/portfolio/program/record/" class="company"><img alt="приложение РАДИО" src="<?php echo get_template_directory_uri(); ?>/img/companies-color/record.png" class="hidden"><img alt="создание приложения РАДИО RECORD" src="<?php echo get_template_directory_uri(); ?>/img/companies/record.png" class="visible"></a>
        <!-- /a.company--><a href="/portfolio/game/pazlinki-2/" class="company"><img alt="мобильные приложения для детей" src="<?php echo get_template_directory_uri(); ?>/img/companies-color/step.png" class="hidden"><img alt="создание приложения пазлинки" src="<?php echo get_template_directory_uri(); ?>/img/companies/step.png" class="visible"></a>
        <!-- /a.company--><a href="/portfolio/program/permenergo-2/" class="company"><img alt="мобильное приложение для клиентов компании" src="<?php echo get_template_directory_uri(); ?>/img/companies-color/permenergo.png" class="hidden"><img alt="создание приложения пермэнерго" src="<?php echo get_template_directory_uri(); ?>/img/companies/permenergo.png" class="visible"></a>
        <!-- /a.company--><a class="company"><img alt="приложения анд проджект" src="<?php echo get_template_directory_uri(); ?>/img/companies-color/and.png" class="hidden"><img alt="создание приложения анд проджект" src="<?php echo get_template_directory_uri(); ?>/img/companies/and.png" class="visible"></a>
        <!-- /a.company--><a href="/portfolio/program/lokomotiv/" class="company"><img alt="мобильное приложение для футбольных болельщиков" src="<?php echo get_template_directory_uri(); ?>/img/companies-color/loko.png" class="hidden"><img alt="создание приложения для фк локомотив" src="<?php echo get_template_directory_uri(); ?>/img/companies/loko.png" class="visible"></a>
        <!-- /a.company--><a href="/portfolio/program/mgu/" class="company"><img alt="приложения для факультета психологии" src="<?php echo get_template_directory_uri(); ?>/img/companies-color/mgu.png" class="hidden"><img alt="создание приложения для мгу" src="<?php echo get_template_directory_uri(); ?>/img/companies/mgu.png" class="visible"></a>
        <!-- /a.company--><a class="company"><img alt="мобильные приложения для транспортной компании" src="<?php echo get_template_directory_uri(); ?>/img/companies-color/pek.png" class="hidden"><img alt="создание приложения для службы доставки ПЭК" src="<?php echo get_template_directory_uri(); ?>/img/companies/pek.png" class="visible"></a>
        <!-- /a.company--><a class="company"><img alt="приложение для love radio" src="<?php echo get_template_directory_uri(); ?>/img/companies-color/loveradio.png" class="hidden"><img alt="создание приложения радио LOVE" src="<?php echo get_template_directory_uri(); ?>/img/companies/loveradio.png" class="visible"></a>
        <!-- /a.company--><a href="/portfolio/game/captain_morgan/" class="company"><img alt="мобильное приложение CAPTAIN MORGAN" src="<?php echo get_template_directory_uri(); ?>/img/companies-color/captainmorgan.png" class="hidden"><img alt="создание промо приложения для вечеринки" src="<?php echo get_template_directory_uri(); ?>/img/companies/captainmorgan.png" class="visible"></a>
        <!-- /a.company--><a href="/portfolio/game/philipmorris/" class="company"><img alt="мобильные приложения philip morris" src="<?php echo get_template_directory_uri(); ?>/img/companies-color/pm.png" class="hidden"><img alt="создание приложения для промо-акции компании" src="<?php echo get_template_directory_uri(); ?>/img/companies/pm.png" class="visible"></a>
        <!-- /a.company--><a href="/portfolio/program/faberlic-3/" class="company"><img alt="приложения faberlic" src="<?php echo get_template_directory_uri(); ?>/img/companies-color/faberlic.png" class="hidden"><img alt="создание приложения для бренда фаберлик" src="<?php echo get_template_directory_uri(); ?>/img/companies/faberlic.png" class="visible"></a>
        <!-- /a.company--><a href="/portfolio/web/art_design_vk/" class="company"><img alt="мобильное приложение арт и дизайн" src="<?php echo get_template_directory_uri(); ?>/img/companies-color/artdesign.png" class="hidden"><img alt="создание приложения открытки для vk" src="<?php echo get_template_directory_uri(); ?>/img/companies/artdesign.png" class="visible"></a>
        <!-- /a.company--><a href="/portfolio/program/prilozhenie-gejmifikacija-dlja-otdela/" class="company"><img alt="приложения для бизнеса" src="<?php echo get_template_directory_uri(); ?>/img/companies/fantasy_logo.png" class="hidden"><img alt="создание приложения для отдела продаж" src="<?php echo get_template_directory_uri(); ?>/img/companies/fantasy_logo_gray.png" class="visible"></a>
        <!-- /a.company--><a href="/portfolio/program/crm-sistema-freshoffice/" class="company"><img alt="мобильные приложения freshoffice" src="<?php echo get_template_directory_uri(); ?>/img/companies/freshoffice_logo.png" width="210" class="hidden"><img alt="создание приложения для CRM-системы" src="<?php echo get_template_directory_uri(); ?>/img/companies/freshoffice_logo_gray.png" width="210" class="visible"></a>
        <!-- /a.company--><a href="/portfolio/program/v-lounge-ot-kompanii-insignia/" class="company"><img alt="мобильное приложение v-lounge" src="<?php echo get_template_directory_uri(); ?>/img/companies/insignia.png" class="hidden"><img alt="создание приложения для компании insignia" src="<?php echo get_template_directory_uri(); ?>/img/companies/insignia_gray.png" class="visible"></a>
        <!-- /a.company-->
    </div>
    <!-- /companies-list-->
</section>
<footer class="footer-ios">
    <div class="container-960">
        <div class="left-f-ios">
            <div class="f-ios-logo">
                <a href="https://infoshell.ru"><img src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/img/logo-footer.png" height="45" width="45" alt="infoshell"></a>
            </div>
            <a href="https://infoshell.ru/files/InfoShell.pdf" class="preza-f-ios">
                Скачать презентацию
            </a>
        </div>
        <div class="right-f-ios">
            <div>+7 (495) 215-51-82 (Мск)</div>
            <div>+7 (812) 242-80-58 (СПб)</div>
            <a id="ZAKAZ_ZVONKA_BOTTOM" href="#" class="b-okno" ><i class="fa fa-phone"></i> Заказать звонок</a>
        </div>
    </div>
</footer>

<div id="modal-2" class="modal">
        <div class="modal-content">
            <div class="modal-header-text">Вы можете оставить онлайн-заявку, <br>и мы вам обязательно ответим!</div>
            <div data-goals="project_estimate_main,all_project_price_check,all_goals" id="callForm" class="question-form contactForm">
                <div class="control-group">
                    <input type="text" placeholder="Ваше имя.." name="name" class="inputbox full">
                </div>
                <!-- /control-group-->
                <div class="control-group">
                    <input type="text" placeholder="Ваш телефон..*" name="phone" class="inputbox full">
                </div>
                <!-- /control-group-->
                <div class="control-group">
                    <input type="text" placeholder="Ваш e-mail.." name="email" class="inputbox full">
                </div>
                <!-- /control-group-->
                <div class="control-group">
                    <textarea rows="10" name="message" placeholder="Опишите, пожалуйста, проект.." class="inputbox full clear"></textarea>
                </div>
                <!-- /control-group-->
                <div class="control-group">
                    <div class="attachment__white">
                        <div class="attach-container">
                            <div class="attach-file">
                                <div class="icon Attach_white"></div><span class="attach-file-name">Добавить файл</span>
                            </div>
                            <!-- /attach-file-dummy-->
                            <input type="file" class="attach-file-input" name="upload_file">
                            <!-- /hidden file input-->
                        </div>
                        <!-- /attach-container--><a href="" class="attach-reset">&times;</a>
                    </div>
                    <!-- /attachment-->
                </div>
                <!-- /control-group-->
                <div class="control-group text-center">
                    <span class="btn btn-yellow contactFormSubmit">Отправить</span>
                </div>
                <!-- /control-group-->
            </div>
            <!-- /form-->
            <div class="modal-close"><a href="" data-dismiss="modal"><span>&times;</span>Закрыть</a></div>
        </div>
    </div>
    <!--[if lt IE 9]>
    <script src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/libs/html5shiv/es5-shim.min.js"></script>
    <script src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/libs/html5shiv/html5shiv.min.js"></script>
    <script src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/libs/html5shiv/html5shiv-printshiv.min.js"></script>
    <script src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/libs/respond/respond.min.js"></script>
    <![endif]-->
<script src="https://infoshell.ru/wp-content/themes/mark_up/js/main.js"></script>
<script src="https://infoshell.ru/wp-content/themes/mark_up/js1/main.js"></script>
        <script>
            $(document).ready(function(){
                $(".testimonials").owlCarousel({
                    margin:15,
                    autoHeight:true,
                    dots: false,
                    nav: true,
                    navText: [],
                    responsive : {
                        320 : {
                            items: 1,
                            stagePadding: 50,
                            nav: false
                        },
                        766 : {
                            items: 2,
                            nav: false
                        },
                        1000 : {
                            items: 3
                        }
                    }
                });
                $(".showcase").owlCarousel({
                    items: 1,
                    loop: true
                });
                $(".portfolio-preview").owlCarousel({
                    items: 1,
                    nav: true,
                    navText: [],
                    autoHeight: true,
                    dotsContainer: '.custom-owl-dots',
                    responsive : {
                        320 : {
                            stagePadding: 25,
                            nav: false
                        },
                        766 : {
                            nav: false
                        },
                        985 : {
                            nav: true
                        }
                    }
                });
            });
            
        </script>
    <script src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/libs/jquery/jquery-1.11.1.min.js"></script>
    <script src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/libs/jquery-mousewheel/jquery.mousewheel.min.js"></script>
    <script src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/libs/fancybox/jquery.fancybox.pack.js"></script>
    <script src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/libs/waypoints/waypoints-1.6.2.min.js"></script>
    <script src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/libs/scrollto/jquery.scrollTo.min.js"></script>
    <script src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/libs/owl-carousel/owl.carousel.min.js"></script>
    <script src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/libs/countdown/jquery.plugin.js"></script>
    <script src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/libs/countdown/jquery.countdown.min.js"></script>
    <script src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/libs/countdown/jquery.countdown-ru.js"></script>
    <script src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/libs/landing-nav/navigation.js"></script>
    <script src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/js/swiper.jquery.min.js"></script>
    <script src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/js/common.js"></script>
    <script>
            var swiper = new Swiper('.swiper-container', {
            pagination: '.swiper-pagination',
            width:  297,
            loop: true,
            paginationClickable: true,
            spaceBetween: 20
            });
    </script>
    
 <!-- Yandex.Metrika counter -->
<script type="text/javascript">
(function (d, w, c) {
    (w[c] = w[c] || []).push(function() {
        try {
            w.yaCounter934261 = new Ya.Metrika({id:934261,
                    webvisor:true,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true});
        } catch(e) { }
    });

    var n = d.getElementsByTagName("script")[0],
        s = d.createElement("script"),
        f = function () { n.parentNode.insertBefore(s, n); };
    s.type = "text/javascript";
    s.async = true;
    s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

    if (w.opera == "[object Opera]") {
        d.addEventListener("DOMContentLoaded", f, false);
    } else { f(); }
})(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="//mc.yandex.ru/watch/934261" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23922742-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-23922742-1');
</script>

<!-- Google Universal Analytics -->
    <div class="modal-backdrop in" onclick="clik_hide()" style="display:none" ></div>
<link rel="stylesheet" href="https://cdn.callbackkiller.com/widget/cbk.css">
<script type="text/javascript" src="https://cdn.callbackkiller.com/widget/cbk.js?cbk_code=16793" charset="UTF-8" async></script>
</body>
</html>