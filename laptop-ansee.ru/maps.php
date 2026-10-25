<!DOCTYPE html>
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta name="description" content="Выбор района обслуживания по карте метрополитена"/>
<meta name="keywords" content="Выбор района обслуживания по карте метрополитена"/>
<title>Выбор района обслуживания по карте метрополитена</title>
<link rel="stylesheet" type="text/css" href="http://laptop-ansee.ru/css/bootstrap.css" media="all"/>
<link rel="stylesheet" type="text/css" href="http://laptop-ansee.ru/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="http://laptop-ansee.ru/css/styles.css" media="all"/>
<link rel="stylesheet" type="text/css" href="http://laptop-ansee.ru/feedback/css/jquery.arcticmodal.css">
<link rel="stylesheet" type="text/css" href="http://laptop-ansee.ru/feedback/css/jquery.jgrowl.css">
<link rel="stylesheet" type="text/css" href="http://laptop-ansee.ru/css/spoiler.css">
<link rel="stylesheet" type="text/css" href="http://laptop-ansee.ru/css/style-only-map-page.css" />
<link rel="stylesheet" type="text/css" href="http://laptop-ansee.ru/jqtransformplugin/jqtransform.css" />
<link rel="stylesheet" type="text/css" href="http://laptop-ansee.ru/formValidator/validationEngine.jquery.css" />
<link rel="stylesheet" type="text/css" href="http://laptop-ansee.ru/demo.css" />
<!--[if lt IE 8]>
<link rel="stylesheet" type="text/css" href="http://laptop-ansee.ru/css/styles-ie.css" media="all" />
<![endif]-->
<link href="http://laptop-ansee.ru/img/icon.ico" rel="icon">
<!-- Yandex.Metrika counter -->
<script type="text/javascript" src="http://laptop-ansee.ru/js/jquery.js"></script>
<script type="text/javascript" src="http://laptop-ansee.ru/js/spoiler.js"></script>
<script type="text/javascript" src="http://laptop-ansee.ru/js/global.js"></script>
<script type="text/javascript" src="http://laptop-ansee.ru/feedback/js/feedback.js"></script>
<script type="text/javascript" src="http://laptop-ansee.ru/feedback/js/jquery.arcticmodal.js"></script>
<script type="text/javascript" src="http://laptop-ansee.ru/feedback/js/jquery.jgrowl.js"></script>
<script type="text/javascript" src="http://laptop-ansee.ru/js/superfish.js"></script>
<script type="text/javascript" src="http://laptop-ansee.ru/js/scripts.js"></script>
<script type="text/javascript" src="http://laptop-ansee.ru/js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="http://laptop-ansee.ru/js/jquery.maskedinput.js"></script>
<script type="text/javascript" src="http://laptop-ansee.ru/js/js.js"></script>
<script type="text/javascript" src="http://laptop-ansee.ru/jqtransformplugin/jquery.jqtransform.js"></script>
<script type="text/javascript" src="http://laptop-ansee.ru/formValidator/jquery.validationEngine.js"></script>

<script type="text/javascript" src="http://laptop-ansee.ru/script.js"></script>
<script type="text/javascript" src="http://www.vk.com/js/api/openapi.js"></script>
<!-- /Yandex.Metrika counter -->
<meta name="yandex-verification" content="6dbc69965b842091" /></head>


﻿<!-- // Формы в модальных окнах <body onkeypress="return catchControlKeys(event)">-->
<body>
<div class="wrapper">
<div class="container">
<div class="shadow"></div>
<div class="swipe-left"></div>
<div class="swipe" style="height: 430px; left: -237px;">
<div class="swipe-menu">
<a href="http://laptop-ansee.ru" title="Home" class="home-link">Домашняя</a>
<ul class="links">
<li class="first"><a href="http://laptop-ansee.ru/company.php" title="О компании">О компании</a></li>
<li><a href="http://laptop-ansee.ru/kontakti.php" title="Контакты">Контакты</a></li>
<li class="top-car"><a href="http://laptop-ansee.ru/prise.php" title="Наши цены">Наши цены</a></li>
<li><a href="http://laptop-ansee.ru/blog.php" title="Блог" class="top-link-checkout">Блог</a></li>
<li class=" last"><a href="http://laptop-ansee.ru/shema.php" title="Схема работы" class="top-link-checkou">Схема работы</a></li>
</ul>
</div>
</div>
<div class="top-icon-menu">
<div class="swipe-control"><i class="icon-reorder"></i></div>
<div class="top-search"><i class="icon-search"></i></div>
<span class="clear"></span>
</div>

<div class="header">
<div class="logotip"><a href="http://laptop-ansee.ru" title="Gadget online" class="logo"><img src="http://laptop-ansee.ru/img/logo.png" alt="http://laptop-ansee.ru" title="http://laptop-ansee.ru"></a></div>
<div class="titleHeader">
<div class="re"><p>Компьютерный сервис</p></div>
<div class="te"><p>8 (499) 350-44-61</p></div>
</div>
<div class="iconHeader">
<div class="one"><i title="Phone" class="fa fa-phone"></i><span class="modal_btn" style="cursor:pointer">Обратный звонок</span></div>
<div class="two"><i title="Work Time" class="fa fa-clock-o"></i>9:00 - 22:00</div>
<div class="three"><i title="Email" class="fa fa-envelope-o"></i>
compprofimaster@yahoo.com

</div>
</div>
<div class="f-right">
  <form method="POST" action="http://laptop-ansee.ru/search.php" id="search_mini_form">
    <div class="form-search">
      <label for="search">Поиск:</label>
      <input id="search" type="text" name="search" value="Введите фразу" onFocus="if(this.value=='Введите фразу')this.value='';" onBlur="if(this.value=='')this.value='Введите фразу';" class="input-text">
      <button type="submit" title="Поиск" class="button"><span><span>Поиск</span></span></button>
      <div id="search_autocomplete" class="search-autocomplete"></div>
    </div>
  </form>
</div>
<div class="form_mod">
<!-- Формы в модальных окнах -->
    <div class="box-modal" id="small-modal">
        <div class="modal-close arcticmodal-close">x</div>
        <div class="modal-content-box">
            <div>Обратный звонок</div>
            <form method="get" name="form-1">
                <div class="input-prepend">
                    <span class="add-on"><i class="icon-user"></i></span>
                    <input class="input-medium focused" name="name" type="text" placeholder="Ваше имя">
                </div>
                <div class="input-prepend">
                    <span class="add-on"><i class="icon-book"></i></span>
                    <input class="input-medium focused" name="tell" type="text" placeholder="Ваш телефон">
                </div>
                <input class="feedback btn btn-block btn-success" name="send" type="button" value="Отправить" onclick="yaCounter20101486.reachGoal('ZAYAVKA'); return true;">
            </form>
        </div>
    </div>
<!-- // Формы в модальных окнах -->
</div>

<div class="quick-access">
<a href="http://laptop-ansee.ru" title="" class="home-link-access"></a>
<ul class="links">
<li class="first"><a href="http://laptop-ansee.ru/company.php" title="О компании">О компании</a></li>

<!--<li><a href="http://laptop-ansee.ru/shema.php" title="Схема работы" class="top-link-checkou">Схема работы</a></li>-->
<li><a href="http://laptop-ansee.ru/blog.php" title="Блог" class="top-link-checkout">Блог</a></li>
<li class="last"><a href="http://laptop-ansee.ru/prise.php" title="Наши цены">Наши цены</a></li>
<li><a href="http://laptop-ansee.ru/kontakti.php" title="Контакты">Контакты</a></li>
</ul>
</div>
</div>
</div>
<div class="main-container col2-left-layout">
<div class="container">
<div class="row">
<div class="col-xs-121">
<div class="sf-menu-block">
    <div id="menu-icon" class="menu-icon-style">Услуги</div>
    <ul class="sf-menu-phone item">
      <li class="level-top parent"><a href="http://laptop-ansee.ru/komputernay-pomosh-na-domu.php" rel="nofollow"><span>Компьютер</span></a>
        <ul class="level0">
          <li class="level1"><a href="http://laptop-ansee.ru/ustanovka-windows.php" rel="nofollow"><span>Установка windows</span></a></li>
          <li class="level1"><a href="http://laptop-ansee.ru/" rel="nofollow"><span>Установка драйверов</span></a></li>
          <li class="level1"><a href="http://laptop-ansee.ru/" rel="nofollow"><span>Ремонт системного блока</span></a></li>
          <li class="level1"><a href="http://laptop-ansee.ru/" rel="nofollow"><span>Чистка системного блока</span></a></li>
          <li class="level1"><a href="http://laptop-ansee.ru/" rel="nofollow"><span>Установка программ</span></a></li>
          <li class="level1"><a href="http://laptop-ansee.ru/udalenie-virusov.php" rel="nofollow"><span>Удаление вирусов</span></a></li>
          <li class="level1"><a href="http://laptop-ansee.ru/vosstanovlenie-dannih-s-zhestkogo-diska.php" rel="nofollow"><span>Восстановление данных</span></a></li>
        </ul>
      </li>
      <li class="level-top parent"><a href="http://laptop-ansee.ru/remont-noutbukov.php" rel="nofollow"><span>Ноутбук</span></a>
        <ul class="level0">
          <li class="level1"><a href="http://laptop-ansee.ru/ustanovka-windows-xp.php" rel="nofollow"><span>Windows</span></a></li>
          <li class="level1"><a href="http://laptop-ansee.ru/zamena-matrici-noutbuka.php" rel="nofollow"><span>Замена матрицы</span></a></li>
          <li class="level1"><a href="http://laptop-ansee.ru/chistka-noutbuka.php" rel="nofollow"><span>Чистка ноутбука</span></a></li>
          <li class="level1"><a href="http://laptop-ansee.ru/zamena-ekrana-noutbuka.php" rel="nofollow"><span>Замена экрана</span></a></li>
          <li class="level1"><a href="http://laptop-ansee.ru/srochnij-remont-noutbukov.php" rel="nofollow"><span>Срочный ремонт ноутбуков</span></a></li>
          <li class="level1"><a href="http://laptop-ansee.ru/vosstanovlenie-dannih-s-fleshki.php" rel="nofollow"><span>Восстановление данных с флешки</span></a></li>
          <li class="level1"><a href="http://laptop-ansee.ru/udalit-banner.php" rel="nofollow"><span>Удаление баннеров</span></a></li>
        </ul>
      </li>
      <li class="level-top parent"><a href="http://laptop-ansee.ru/remont-apple.php" rel="nofollow"><span>Apple</span></a>
        <ul class="level0">
          <li><a href="http://laptop-ansee.ru/mac-os.php" rel="nofollow">Mac OS</a></li>
          <li><a href="http://laptop-ansee.ru/remont-imac.php" rel="nofollow">ремонт iMac</a></li>
          <li><a href="http://laptop-ansee.ru/remont-macbook.php" rel="nofollow">ремонт MacBook</a></li>
          <li><a href="http://laptop-ansee.ru/remont-ipad.php" rel="nofollow">ремонт iPad</a></li>
          <li><a href="http://laptop-ansee.ru/vosstanovlenie-failov.php" rel="nofollow">восстановление файлов</a></li>
        </ul>
      </li>
      <li class="level-top parent"><a href="http://laptop-ansee.ru/nastroika-seti.php" rel="nofollow"><span>Сети</span></a>
        <ul class="level0">
          <li><a href="http://laptop-ansee.ru/nastroika-lokalnoi-seti.php" rel="nofollow">локальная сеть</a></li>
          <li><a href="http://laptop-ansee.ru/nastroika-wi-fi.php" rel="nofollow">настройка wi-fi</a></li>
          <li><a href="http://laptop-ansee.ru/nastroika-routera.php" rel="nofollow">настройка оборудования</a></li>
          <li><a href="http://laptop-ansee.ru/podkluchenie-k-internetu.php" rel="nofollow">подключение к интернету</a></li>
        </ul>
      </li>
      <li class="level-top parent"><a href="http://laptop-ansee.ru/remont-planshetov.php" rel="nofollow"><span>Планшеты</span></a>
        <ul class="level0">
          <li class="level1"><a href="http://laptop-ansee.ru/remont-planshetov-acer.php" rel="nofollow"><span>Acer</span></a></li>
          <li class="level1"><a href="http://laptop-ansee.ru/remont-planshetov-asus.php" rel="nofollow"><span>Asus</span></a></li>
          <li class="level1"><a href="http://laptop-ansee.ru/remont-planshetov-samsung.php" rel="nofollow"><span>Samsung</span></a></li>
          <li class="level1"><a href="http://laptop-ansee.ru/remont-ipad.php" rel="nofollow"><span>iPad</span></a></li>
          <li class="level1"><a href="http://laptop-ansee.ru/remont-planshetov-DELL.php" rel="nofollow"><span>Dell</span></a></li>
          <li class="level1"><a href="http://laptop-ansee.ru/remont-planshetov-EXPLAY.php" rel="nofollow"><span>Explay</span></a></li>
          <li class="level1"><a href="http://laptop-ansee.ru/remont-planshetov-FUJITSU.php" rel="nofollow"><span>Fujitsu</span></a></li>
          <li class="level1"><a href="http://laptop-ansee.ru/remont-planshetov-HP.php" rel="nofollow"><span>HP</span></a></li>
          <li class="level1"><a href="http://laptop-ansee.ru/remont-planshetov-LENOVO.php" rel="nofollow"><span>Lenovo</span></a></li>
          <li class="level1"><a href="http://laptop-ansee.ru/remont-planshetov-HTC.php" rel="nofollow"><span>HTC</span></a></li>
          <li class="level1"><a href="http://laptop-ansee.ru/remont-planshetov-LG.php" rel="nofollow"><span>LG</span></a></li>
          <li class="level1"><a href="http://laptop-ansee.ru/remont-planshetov-TOSHIBA.php" rel="nofollow"><span>Toshiba</span></a></li>
          <li class="level1"><a href="http://laptop-ansee.ru/remont-planshetov-VIEWSONIC.php" rel="nofollow"><span>Viewsonic</span></a></li>
        </ul>
      </li>
      <li class="level-top parent"><a href="http://laptop-ansee.ru/obsluzhivanie-komputerov.php" rel="nofollow"><span>Организациям</span></a>
        <ul class="level0">
          <li><a href="http://laptop-ansee.ru/abonentskoe-obsluzhivanie-komputerov.php" rel="nofollow">абонентское обслуживание</a></li>
          <li><a href="http://laptop-ansee.ru/remont-printerov.php" rel="nofollow">принтеры</a></li>
          <li><a href="http://laptop-ansee.ru/" rel="nofollow">оргтехника</a></li>
          <li><a href="http://laptop-ansee.ru/obsluzhivanie-serverov.php" rel="nofollow">обслуживание серверов</a></li>
        </ul>
      </li>
    </ul>
</div>
</div>
<div class="col-main col-xs-12 col-sm-9">
<div class="padding-s">
<div class="std">
<!-- Yandex.Metrika counter -->
<script src="http://laptop-ansee.ru/js/camera.js"> </script>
<script>
        jQuery(function(){
            jQuery('#camera_wrap').camera({
                alignmen: 'topCenter',
                height: '40.43%',
                minHeight: '100px',
                loader : false,
                navigation: true,
                fx: 'simpleFade',
                navigationHover:false,       
                thumbnails: false,
                playPause: false,
                pagination:false,
            });
        });
        </script>
        <!-- /Yandex.Metrika counter -->
</div><div class="breadcrumbs"><a href="http://laptop-ansee.ru/index.php">Главная</a><strong>Выбор района обслуживания по карте метрополитена</strong></div><h1></h1>﻿<div class="content">
<div class="metromap">
  <div style="padding: 1px 0 0 4px;"><img src="http://laptop-ansee.ru/images/metro-moscow.jpg" alt="" />
    <div class="aviamotornoj"><a class="aviamotornoj" href="http://laptop-ansee.ru/remont-noutbukov-aviamotornay.php"> <span>Авиамоторная</span></a> </div>
    <div class="avtozavodskoj"><a class="avtozavodskoj" href="http://laptop-ansee.ru/remont-noutbukov-avtozavodskay.php"> <span>Автозаводская</span></a> </div>
    <div class="akademicheskoj"><a class="akademicheskoj" href="http://laptop-ansee.ru/komputernay-pomosh-akademicheskay.php"> <span>Академическая</span></a> </div>
    <div class="aleksandrovskom"><a class="aleksandrovskom"><span>Александровский сад</span></a></div>
    <div class="alekseevskoj"><a class="alekseevskoj" href="http://laptop-ansee.ru/remont-komputerov-alekseevskay.php"> <span>Алексеевская</span></a> </div>
    <div class="altufevo"><a class="altufevo" href="http://laptop-ansee.ru/remont-komputerov-altufevo.php"> <span>Алтуфьево</span></a> </div>
    <div class="annino"><a class="annino" href="http://laptop-ansee.ru/komputernay-pomosh-anino.php"> <span>Аннино</span></a> </div>
    <div class="arbatskoj"><a class="arbatskoj" href="http://laptop-ansee.ru/remont-noutbukov-arbatskay.php"> <span>Арбатская</span></a> </div>
    <div class="aeroport"><a class="aeroport" href="http://laptop-ansee.ru/remont-noutbukov-aeroport.php"> <span>Аэропорт</span></a> </div>
    <div class="babushkinskaya"><a class="babushkinskaya" href="http://laptop-ansee.ru/remont-noutbukov-babushkinskay.php"> <span>Бабушкинская</span></a> </div>
    <div class="bagrationovskoj"><a class="bagrationovskoj"><span>Багратионовская</span></a> </div>
    <div class="barrikadnoj"><a class="barrikadnoj"><span>Баррикадная</span></a> </div>
    <div class="baumanskoj"><a class="baumanskoj" href="http://laptop-ansee.ru/remont-noutbukov-baumanskay.php"> <span>Бауманская</span></a> </div>
    <div class="begovoj"><a class="begovoj"><span>Беговая</span></a> </div>
    <div class="belorusskaya"><a class="belorusskaya" href="http://laptop-ansee.ru/remont-komputerov-belorusskay.php"> <span>Белорусская</span></a> </div>
    <div class="belyaevo"><a class="belyaevo" href="http://laptop-ansee.ru/remont-noutbukov-belayevo.php"> <span>Беляево</span></a> </div>
    <div class="bibirevo"><a class="bibirevo" href="http://laptop-ansee.ru/komputernay-pomosh-bibirevo.php"> <span>Бибирево</span></a> </div>
    <div class="lenina"><a class="lenina"><span>Библиотека им. Ленина</span></a></div>
    <div class="borisovo"><a class="borisovo"><span>Борисово</span></a></div>
    <div class="borovitckaya"><a class="borovitckaya"><span>Боровицкая</span></a></div>
    <div class="botanicheskij_sad"><a class="botanicheskij_sad"><span>Ботанический сад</span></a></div>
    <div class="bratislavskoj"><a class="bratislavskoj" href="http://laptop-ansee.ru/remont-komputerov-bratislavskay.php"> <span>Братиславская</span></a> </div>
    <div class="ushakova"><a class="ushakova"><span>Бульвар адмирала Ушакова</span></a></div>
    <div class="donskogo"><a class="donskogo"><span>Бульвар Дмитрия Донского</span></a> </div>
    <div class="buninskoj_allee"><a class="buninskoj_allee"><span>Бунинская аллея</span></a></div>
    <div class="varshavskoj"><a class="varshavskoj"><span>Варшавская</span></a> </div>
    <div class="vdnh"><a class="vdnh" href="http://laptop-ansee.ru/remont-komputerov-vdnh.php"> <span>ВДНХ</span></a> </div>
    <div class="vladykino"><a class="vladykino"><span>Владыкино</span></a></div>
    <div class="vodnyj_stadion"><a class="vodnyj_stadion" href="http://laptop-ansee.ru/komputernaya-pomosh-vodni-stadion.php"> <span>Водный Стадион</span></a> </div>
    <div class="vojkovskoj"><a class="vojkovskoj" href="http://laptop-ansee.ru/remont-noutbukov-voikovskay.php"> <span>Войковская</span></a> </div>
    <div class="volgogradskij_prospekt"><a class="volgogradskij_prospekt"> <span>Волгоградский проспект</span></a> </div>
    <div class="volzhskoj"><a class="volzhskoj"><span>Волжская</span></a></div>
    <div class="volokolamskoj"><a class="volokolamskoj"><span>Волоколамская</span></a></div>
    <div class="vorobevy_gory"><a class="vorobevy_gory"><span>Воробьевы горы</span></a></div>
    <div class="vystavochnoj"><a class="vystavochnoj"><span>Выставочная</span></a></div>
    <div class="vystavochnyj_tcentr"><a class="vystavochnyj_tcentr"><span>Выставочный центр</span></a> </div>
    <div class="vyhino"><a class="vyhino" href="http://laptop-ansee.ru/komputernay-pomosh-vihino.php"> <span>Выхино</span></a> </div>
    <div class="dinamo"><a class="dinamo"><span>Динамо</span></a></div>
    <div class="dmitrovskoj"><a class="dmitrovskoj" href="http://laptop-ansee.ru/komputernaya-pomosh-dmitrovskaya.php"> <span>Дмитровская</span></a> </div>
    <div class="dobryninskoj"><a class="dobryninskoj" href="http://laptop-ansee.ru/remont-noutbukov-domodedovskay.php"> <span>Добрынинская</span></a> </div>
    <div class="domodedovo"><a class="domodedovo" href="http://laptop-ansee.ru/remont-noutbukov-domodedovskay.php"> <span>Домодедовская</span></a> </div>
    <div class="dostoevskoj"><a class="dostoevskoj"><span>Достоевская</span></a></div>
    <div class="dubrovke"><a class="dubrovke"><span>Дубровка</span></a></div>
    <div class="zyablikovo"><a class="zyablikovo"><span>Зябликово</span></a></div>
    <div class="izmajlovo"><a class="izmajlovo" href="http://laptop-ansee.ru/komputernay-pomosh-izmailovskay.php"> <span>Измайловская</span></a> </div>
    <div class="kaluzhskaya"><a class="kaluzhskaya" href="http://laptop-ansee.ru/remont-noutbukov-kaluzhskay.php"> <span>Калужская</span></a> </div>
    <div class="kantemirovskaya"><a class="kantemirovskaya" href="http://laptop-ansee.ru/remont-noutbukov-kantemirovskay.php"> <span>Кантемировская</span></a> </div>
    <div class="kahovskaya"><a class="kahovskaya"> <span>Каховская</span></a> </div>
    <div class="kashirskaya"><a class="kashirskaya" href="http://laptop-ansee.ru/remont-noutbukov-kashirskay.php"> <span>Каширская</span></a> </div>
    <div class="kievskaya"><a class="kievskaya"> <span>Киевская</span></a> </div>
    <div class="kitaj-gorod"><a class="kitaj-gorod"> <span>Китай-город</span></a> </div>
    <div class="kozhuhovskaya"><a class="kozhuhovskaya" href="http://laptop-ansee.ru/remont-noutbukov-kozhuhovskay.php"> <span>Кожуховская</span></a> </div>
    <div class="kolomenskaya"><a class="kolomenskaya" href="http://laptop-ansee.ru/komputernay-pomosh-kolomenskay.php"> <span>Коломенская</span></a> </div>
    <div class="komsomolskaya"><a class="komsomolskaya"> <span>Комсомольская</span></a> </div>
    <div class="konkovo"><a class="konkovo" href="http://laptop-ansee.ru/remont-noutbukov-konkovo.php"> <span>Коньково</span></a> </div>
    <div class="krasnogvardejskaya"><a class="krasnogvardejskaya" href="http://laptop-ansee.ru/remont-komputerov-krasnogvardeiskay.php"> <span>Красногвардейская</span></a> </div>
    <div class="krasnopresnenskaya"><a class="krasnopresnenskaya"> <span>Краснопресненская</span></a> </div>
    <div class="krasnoselskaya"><a class="krasnoselskaya"> <span>Красносельская</span></a> </div>
    <div class="krasnye_vorota"><a class="krasnye_vorota"> <span>Красные Ворота</span></a> </div>
    <div class="krestyanskaya_zastava"><a class="krestyanskaya_zastava"> <span>Крестьянская застава</span></a> </div>
    <div class="kropotkinskaya"><a class="kropotkinskaya"> <span>Кропоткинская</span></a> </div>
    <div class="krylatskoe"><a class="krylatskoe" href="http://laptop-ansee.ru/remont-noutbukov-krilatskoe.php"> <span>Крылатское</span></a> </div>
    <div class="kuznetckij_most"><a class="kuznetckij_most"> <span>Кузнецкий мост</span></a> </div>
    <div class="kuzminki"><a class="kuzminki" href="http://laptop-ansee.ru/remont-noutbukov-kuzminki.php"> <span>Кузьминки</span></a> </div>
    <div class="kuntcevskaya"><a class="kuntcevskaya"> <span>Кунцевская</span></a> </div>
    <div class="kurskaya"><a class="kurskaya" href="http://laptop-ansee.ru/komputernay-pomosh-kurskay.php"> <span>Курская</span></a> </div>
    <div class="kutuzovskaya"><a class="kutuzovskaya"> <span>Кутузовская</span></a> </div>
    <div class="leninskij_prospekt"><a class="leninskij_prospekt" href="http://laptop-ansee.ru/remont-komputerov-leninskij-prospekt.php"> <span>Ленинский Проспект</span></a> </div>
    <div class="lubyanke"><a class="lubyanke"> <span>Лубянка</span></a> </div>
    <div class="lyublino"><a class="lyublino" href="http://laptop-ansee.ru/remont-noutbukov-lublino.php"> <span>Люблино</span></a> </div>
    <div class="marksistkoj"><a class="marksistkoj"> <span>Марксистская</span></a> </div>
    <div class="marina_rosha"><a class="marina_rosha"> <span>Марьина Роща</span></a> </div>
    <div class="marino"><a class="marino" href="http://laptop-ansee.ru/remont-noutbukov-marino.php"> <span>Марьино</span></a> </div>
    <div class="mayakovskoj"><a class="mayakovskoj"> <span>Маяковская</span></a> </div>
    <div class="medvedkovo"><a class="medvedkovo" href="http://laptop-ansee.ru/remont-komputerov-medvedkovo.php"> <span>Медведково</span></a> </div>
    <div class="mezhdunarodnaya"><a class="mezhdunarodnaya"> <span>Международная</span></a> </div>
    <div class="mendeleevskaya"><a class="mendeleevskaya"> <span>Менделеевская</span></a> </div>
    <div class="mitino"><a class="mitino" href="http://laptop-ansee.ru/remont-komputerov-mitino.php"> <span>Митино</span></a> </div>
    <div class="molodezhnaya"><a class="molodezhnaya" href="http://laptop-ansee.ru/remont-komputerov-molodezhnay.php"> <span>Молодежная</span></a> </div>
    <div class="myakinino"><a class="myakinino"> <span>Мякинино</span></a> </div>
    <div class="nagatinskaya"><a class="nagatinskaya"> <span>Нагатинская</span></a> </div>
    <div class="nagornaya"><a class="nagornaya"> <span>Нагорная</span></a> </div>
    <div class="nahimovskij_prospekt"><a class="nahimovskij_prospekt"> <span>Нахимовский проспект</span></a> </div>
    <div class="novogireevo"><a class="novogireevo" href="http://laptop-ansee.ru/remont-noutbukov-novogireevo.php"> <span>Новогиреево</span></a> </div>
    <div class="novokosino"><a class="novokosino" href="http://laptop-ansee.ru/remont-komputerov-novokosini.php"> <span>Новокосино</span></a> </div>
    <div class="novokuznetckaya"><a class="novokuznetckaya"> <span>Новокузнецкая</span></a> </div>
    <div class="novoslobodskaya"><a class="novoslobodskaya"> <span>Новослободская</span></a> </div>
    <div class="novoyasenevskaya"><a class="novoyasenevskaya"> <span>Новоясеневская</span></a> </div>
    <div class="novye_cheryomushki"><a class="novye_cheryomushki"> <span>Новые Черёмушки</span></a> </div>
    <div class="oktyabrskaya"><a class="oktyabrskaya" href="http://laptop-ansee.ru/komputernay-pomosh-oktaybrskay.php"> <span>Октябрьская</span></a> </div>
    <div class="oktyabyrskoe_pole"><a class="oktyabyrskoe_pole" href="http://laptop-ansee.ru/remont-noutbukov-oktaybrskoe-pole.php"> <span>Октябрьское Поле</span></a> </div>
    <div class="orehovo"><a class="orehovo" href="http://laptop-ansee.ru/remont-komputerov-orehovo.php"> <span>Орехово</span></a> </div>
    <div class="otradnoe"><a class="otradnoe" href="http://laptop-ansee.ru/komputernay-pomosh-otradnoe.php"> <span>Отрадное</span></a> </div>
    <div class="ohotnyj_ryad"><a class="ohotnyj_ryad" href="http://laptop-ansee.ru/remont-noutbukov-ohotnij.php"> <span>Охотный ряд</span></a> </div>
    <div class="paveletckaya"><a class="paveletckaya" href="http://laptop-ansee.ru/remont-noutbukov-paveleckay.php"> <span>Павелецкая</span></a> </div>
    <div class="park_kultury"><a class="park_kultury"> <span>Парк культуры</span></a> </div>
    <div class="park_pobedy"><a class="park_pobedy"> <span>Парк Победы</span></a> </div>
    <div class="partizanskaya"><a class="partizanskaya"> <span>Партизанская</span></a> </div>
    <div class="pervomajskaya"><a class="pervomajskaya" href="http://laptop-ansee.ru/remont-komputerov-pervomaiskaya.php"> <span>Первомайская</span></a> </div>
    <div class="perovo"><a class="perovo" href="http://laptop-ansee.ru/remont-komputerov-perovo.php"> <span>Перово</span></a> </div>
    <div class="petrovsko-razumovskaya"><a class="petrovsko-razumovskaya"> <span>Петровско-Разумовская</span></a> </div>
    <div class="pechatniki"><a class="pechatniki" href="http://laptop-ansee.ru/remont-noutbukov-pechatniki.php"> <span>Печатники</span></a> </div>
    <div class="pionerskaya"><a class="pionerskaya"> <span>Пионерская</span></a> </div>
    <div class="planernaya"><a class="planernaya" href="http://laptop-ansee.ru/komputernay-pomosh-planernay.php"> <span>Планерная</span></a> </div>
    <div class="ploshad_ilicha"><a class="ploshad_ilicha"> <span>Площадь Ильича</span></a> </div>
    <div class="ploshad_revolyutcii"><a class="ploshad_revolyutcii"> <span>Площадь Революции</span></a> </div>
    <div class="polezhaevskaya"><a class="polezhaevskaya" href="http://laptop-ansee.ru/remont-noutbukov-polezhaevskay.php"> <span>Полежаевская</span></a> </div>
    <div class="polyanka"><a class="polyanka"> <span>Полянка</span></a> </div>
    <div class="prazhskaya"><a class="prazhskaya" href="http://laptop-ansee.ru/remont-noutbukov-prazhskay.php"> <span>Пражская</span></a> </div>
    <div class="preobrazhenskaya_ploshad"><a class="preobrazhenskaya_ploshad"> <span>Преображенская площадь</span></a> </div>
    <div class="proletarskaya"><a class="proletarskaya" href="http://laptop-ansee.ru/remont-komputerov-proletarskay.php"> <span>Пролетарская</span></a> </div>
    <div class="prospekt_vernadskogo"><a class="prospekt_vernadskogo"> <span>Проспект Вернадского</span></a> </div>
    <div class="prospekt_mira"><a class="prospekt_mira" href="http://laptop-ansee.ru/remont-noutbukov-prospect-mira.php"> <span>Проспект Мира</span></a> </div>
    <div class="profsoyuznaya"><a class="profsoyuznaya" href="http://laptop-ansee.ru/remont-noutbukov-profsouznay.php"> <span>Профсоюзная</span></a> </div>
    <div class="pushkinskaya"><a class="pushkinskaya"> <span>Пушкинская</span></a> </div>
    <div class="rechnoj_vokzal"><a class="rechnoj_vokzal" href="http://laptop-ansee.ru/remont-noutbukov-rechnoi-bokzal.php"> <span>Речной Вокзал</span></a> </div>
    <div class="rizhskaya"><a class="rizhskaya"> <span>Рижская</span></a> </div>
    <div class="rimskaya"><a class="rimskaya"> <span>Римская</span></a> </div>
    <div class="ryazanskij_prospekt"><a class="ryazanskij_prospekt" href="http://laptop-ansee.ru/remont-noutbukov-rayzanskii-prospekt.php"> <span>Рязанский проспект</span></a> </div>
    <div class="savelovskaya"><a class="savelovskaya" href="http://laptop-ansee.ru/remont-komputerov-savelovskay.php"> <span>Савеловская</span></a> </div>
    <div class="sviblovo"><a class="sviblovo" href="http://laptop-ansee.ru/remont-komputerov-sviblovo.php"> <span>Свиблово</span></a> </div>
    <div class="sevastopolskaya"><a class="sevastopolskaya"> <span>Севастопольская</span></a> </div>
    <div class="semenovskaya"><a class="semenovskaya" href="http://laptop-ansee.ru/remont-noutbukov-semenovskay.php"> <span>Семеновская</span></a> </div>
    <div class="serpuhovskaya"><a class="serpuhovskaya"> <span>Серпуховская</span></a> </div>
    <div class="slavyanskij_bulvar"><a class="slavyanskij_bulvar"> <span>Славянский бульвар</span></a> </div>
    <div class="smolenskaya"><a class="smolenskaya"> <span>Смоленская</span></a> </div>
    <div class="sokol"><a class="sokol" href="http://laptop-ansee.ru/remont-noutbukov-sokol.php"> <span>Сокол</span></a> </div>
    <div class="sokolniki"><a class="sokolniki" href="http://laptop-ansee.ru/remont-noutbukov-sokolniki.php"> <span>Сокольники</span></a> </div>
    <div class="sportivnaya"><a class="sportivnaya"> <span>Спортивная</span></a> </div>
    <div class="sretenskij_bulvar"><a class="sretenskij_bulvar"> <span>Сретенский Бульвар</span></a> </div>
    <div class="strogino"><a class="strogino" href="http://laptop-ansee.ru/remont-noutbukov-strogino.php"> <span>Строгино</span></a> </div>
    <div class="studencheskaya"><a class="studencheskaya"> <span>Студенческая</span></a> </div>
    <div class="suharevskoj"><a class="suharevskoj"> <span>Сухаревская</span></a> </div>
    <div class="shodnenskoj"><a class="shodnenskoj" href="http://laptop-ansee.ru/komputernay-pomosh-shodnenskay.php"> <span>Сходненская</span></a> </div>
    <div class="stantcii_m"><a class="stantcii_m" href="http://laptop-ansee.ru/remont-noutbukov-taganskay.php"> <span>Таганская</span></a> </div>
    <div class="tverskoj"><a class="tverskoj" href="http://laptop-ansee.ru/remont-noutbukov-chehovskay.php"> <span>Тверская</span></a> </div>
    <div class="teatralnoj"><a class="teatralnoj"> <span>Театральная</span></a> </div>
    <div class="tekstilshiki"><a class="tekstilshiki" href="http://laptop-ansee.ru/remont-noutbukov-tekstilshiki.php"> <span>Текстильщики</span></a> </div>
    <div class="teplyj_stan"><a class="teplyj_stan" href="http://laptop-ansee.ru/remont-komputerov-teplij-stan.php"> <span>Теплый Стан</span></a> </div>
    <div class="timiryazevskoj"><a class="timiryazevskoj" href="http://laptop-ansee.ru/remont-komputerov-timiryazevskay.php"> <span>Тимирязевская</span></a> </div>
    <div class="tretyakovskoj"><a class="tretyakovskoj" href="http://laptop-ansee.ru/remont-noutbukov-tretaykovskay.php"> <span>Третьяковская</span></a> </div>
    <div class="trubnoj"><a class="trubnoj"> <span>Трубная</span></a> </div>
    <div class="ulskoj"><a class="ulskoj" href="http://laptop-ansee.ru/remont-noutbukov-tulskay.php"> <span>Тульская</span></a> </div>
    <div class="turgenevskoj"><a class="turgenevskoj" href="http://laptop-ansee.ru/remont-noutbukov-turgenevskay.php"> <span>Тургеневская</span></a> </div>
    <div class="tushinskoj"><a class="tushinskoj" href="http://laptop-ansee.ru/komputernaya-pomosh-tyshino.php"> <span>Тушинская</span></a> </div>
    <div class="goda"><a class="goda"> <span>Улица 1905 года</span></a> </div>
    <div class="yangelya"><a class="yangelya"> <span>Улица Академика Янгеля</span></a> </div>
    <div class="gorchakova"><a class="gorchakova"> <span>Улица Горчакова</span></a> </div>
    <div class="podbelskogo"><a class="podbelskogo"> <span>Улица Подбельского</span></a> </div>
    <div class="skobelevskoj"><a class="skobelevskoj"> <span>Улица Скобелевская</span></a> </div>
    <div class="starokachalovskoj"><a class="starokachalovskoj"> <span>Улица Старокачаловская</span></a> </div>
    <div class="universitete"><a class="universitete" href="http://laptop-ansee.ru/komputernay-pomosh-universitet.php"> <span>Университет</span></a> </div>
    <div class="parke"><a class="parke"> <span>Филевский Парк</span></a> </div>
    <div class="filyah"><a class="filyah"> <span>Фили</span></a> </div>
    <div class="frunzenskoj"><a class="frunzenskoj" href="http://laptop-ansee.ru/remont-noutbukov-frunzenskay.php"> <span>Фрунзенская</span></a> </div>
    <div class="tcaritcyno"><a class="tcaritcyno" href="http://laptop-ansee.ru/remont-noutbukov-caricino.php"> <span>Царицыно</span></a> </div>
    <div class="tcvetnom_bulvare"><a class="tcvetnom_bulvare"> <span>Цветной бульвар</span></a> </div>
    <div class="cherkizovskoj"><a class="cherkizovskoj"> <span>Черкизовская</span></a> </div>
    <div class="chertanovskoj"><a class="chertanovskoj" href="http://laptop-ansee.ru/komputernay-pomosh-chertanovskay.php"> <span>Чертановская</span></a> </div>
    <div class="chehovskoj"><a class="chehovskoj" href="http://laptop-ansee.ru/remont-noutbukov-chehovskay.php"> <span>Чеховская</span></a> </div>
    <div class="chistyh_prudah"><a class="chistyh_prudah"> <span>Чистые пруды</span></a> </div>
    <div class="chkalovskoj"><a class="chkalovskoj"> <span>Чкаловская</span></a> </div>
    <div class="shabolovskoj"><a class="shabolovskoj" href="http://laptop-ansee.ru/remont-noutbukov-shabolovskaya.php"> <span>Шаболовская</span></a> </div>
    <div class="shipilovskoj"><a class="shipilovskoj"> <span>Шипиловская</span></a> </div>
    <div class="shosse_entuziastov"><a class="shosse_entuziastov"> <span>Шоссе Энтузиастов</span></a> </div>
    <div class="shelkovskaya"><a class="shelkovskaya" href="http://laptop-ansee.ru/komputernay-pomosh-shelkovskay.php"> <span>Щелковская</span></a> </div>
    <div class="shukinskaya"><a class="shukinskaya" href="http://laptop-ansee.ru/remont-komputerov-shukinskay.php"> <span>Щукинская</span></a> </div>
    <div class="elektrozavodskaya"><a class="elektrozavodskaya"> <span>Электрозаводская</span></a> </div>
    <div class="yugo-zapadnaya"><a class="yugo-zapadnaya" href="http://laptop-ansee.ru/komputernaya-pomosh-ygo-zapadnaya.php"> <span>Юго-Западная</span></a> </div>
    <div class="yuzhnaya"><a class="yuzhnaya" href="http://laptop-ansee.ru/remont-noutbukov-uzhnay.php"> <span>Южная</span></a> </div>
    <div class="yasenevo"><a class="yasenevo" href="http://laptop-ansee.ru/remont-komputerov-yasenevo.php"> <span>Ясенево</span></a> </div>
  </div>
</div>
﻿</div>
</div>
</div><!--noindex-->
<div class="col-left sidebar col-xs-12 col-sm-3">
  <div class="nav-container block">
    <div class="menu-icon-style">Услуги</div>
    <ul class="sf-menu-phone item">
      <li class="level-top parent"><a href="http://laptop-ansee.ru/komputernay-pomosh-na-domu.php" rel="nofollow"><span>Компьютер</span></a>
        <ul class="level0">
          <li class="level1"><a href="http://laptop-ansee.ru/ustanovka-windows-xp.php" rel="nofollow"><span>Установка windows XP</span></a></li>
          <li class="level1"><a href="http://laptop-ansee.ru/ustanovka-windows-7.php" rel="nofollow"><span>Установка windows 7</span></a></li>
          <li class="level1"><a href="http://laptop-ansee.ru/chistka-kompyutera.php" rel="nofollow"><span>Чистка компьютера</span></a></li>
          <li class="level1"><a href="http://laptop-ansee.ru/remont-materinskih-plat.php" rel="nofollow"><span>Ремонт материнской платы</span></a></li>
          <li class="level1"><a href="http://laptop-ansee.ru/ustanovka-programm-na-komputer.php" rel="nofollow"><span>Установка программ</span></a></li>
          <li class="level1"><a href="http://laptop-ansee.ru/udalenie-virusov-s-komputera.php" rel="nofollow"><span>Удаление вирусов</span></a></li>
          <li class="level1"><a href="http://laptop-ansee.ru/sborka-komputera.php" rel="nofollow"><span>Сборка компьютера на заказ</span></a></li>
          <li class="level1"><a href="http://laptop-ansee.ru/vosstanovlenie-dannih-s-zhestkogo-diska.php" rel="nofollow"><span>Восстановление данных</span></a></li>
        </ul>
      </li>
      <li class="level-top parent"><a href="http://laptop-ansee.ru/remont-noutbukov.php" rel="nofollow"><span>Ноутбук</span></a>
        <ul class="level0">
        <li class="level1"><a href="http://laptop-ansee.ru/ustanovka-windows.php" rel="nofollow"><span>Установка windows</span></a></li>
          <li class="level1"><a href="http://laptop-ansee.ru/zamena-matrici-noutbuka.php" rel="nofollow"><span>Замена матрицы</span></a></li>
          <li class="level1"><a href="http://laptop-ansee.ru/chistka-noutbuka.php" rel="nofollow"><span>Чистка от пыли</span></a></li>
          <li class="level1"><a href="http://laptop-ansee.ru/zamena-ekrana-noutbuka.php" rel="nofollow"><span>Замена экрана</span></a></li>
          <li class="level1"><a href="http://laptop-ansee.ru/srochnij-remont-noutbukov.php" rel="nofollow"><span>Срочный ремонт ноутбуков</span></a></li>
          <li class="level1"><a href="http://laptop-ansee.ru/vosstanovlenie-dannih-s-fleshki.php" rel="nofollow"><span>Восстановление данных с флешки</span></a></li>
          <li class="level1"><a href="http://laptop-ansee.ru/udalit-banner.php" rel="nofollow"><span>Удаление баннеров</span></a></li>
        </ul>
      </li>
      <li class="level-top parent"><a href="http://laptop-ansee.ru/remont-apple.php" rel="nofollow"><span>Apple</span></a>
        <ul class="level0">
          <li><a href="http://laptop-ansee.ru/mac-os.php" rel="nofollow">Mac OS</a></li>
          <li><a href="http://laptop-ansee.ru/remont-imac.php" rel="nofollow">ремонт iMac</a></li>
          <li><a href="http://laptop-ansee.ru/remont-macbook.php" rel="nofollow">ремонт MacBook</a></li>
          <li><a href="http://laptop-ansee.ru/remont-ipad.php" rel="nofollow">ремонт iPad</a></li>
          <li><a href="http://laptop-ansee.ru/vosstanovlenie-failov.php" rel="nofollow">восстановление файлов</a></li>
          <li class="level1"><a href="http://laptop-ansee.ru/udalenie-virusov.php" rel="nofollow"><span>Удаление вирусов и смс баннеров</span></a></li>
        </ul>
      </li>
      <li class="level-top parent"><a href="http://laptop-ansee.ru/nastroika-seti.php" rel="nofollow"><span>Сети</span></a>
        <ul class="level0">
          <li><a href="http://laptop-ansee.ru/nastroika-lokalnoi-seti.php" rel="nofollow">локальная сеть</a></li>
          <li><a href="http://laptop-ansee.ru/nastroika-wi-fi.php" rel="nofollow">настройка wi-fi</a></li>
          <li><a href="http://laptop-ansee.ru/nastroika-routera.php" rel="nofollow">настройка оборудования</a></li>
          <li><a href="http://laptop-ansee.ru/podkluchenie-k-internetu.php" rel="nofollow">подключение к интернету</a></li>
          <li><a href="http://laptop-ansee.ru/nastroika-cisco.php" rel="nofollow">Настройка cisco</a></li>
          <li><a href="http://laptop-ansee.ru/vosstanovlenie-dannih.php" rel="nofollow">восстановление данных</a></li>
        </ul>
      </li>
      <li class="level-top parent"><a href="http://laptop-ansee.ru/remont-planshetov.php" rel="nofollow"><span>Планшеты</span></a>
        <ul class="level0">
          <li class="level1"><a href="http://laptop-ansee.ru/remont-planshetov-acer.php" rel="nofollow"><span>Acer</span></a></li>
          <li class="level1"><a href="http://laptop-ansee.ru/remont-planshetov-asus.php" rel="nofollow"><span>Asus</span></a></li>
          <li class="level1"><a href="http://laptop-ansee.ru/remont-planshetov-samsung.php" rel="nofollow"><span>Samsung</span></a></li>
          <li class="level1"><a href="http://laptop-ansee.ru/remont-ipad.php" rel="nofollow"><span>iPad</span></a></li>
          <li class="level1"><a href="http://laptop-ansee.ru/remont-planshetov-DELL.php" rel="nofollow"><span>Dell</span></a></li>
          <li class="level1"><a href="http://laptop-ansee.ru/remont-planshetov-EXPLAY.php" rel="nofollow"><span>Explay</span></a></li>
          <li class="level1"><a href="http://laptop-ansee.ru/remont-planshetov-FUJITSU.php" rel="nofollow"><span>Fujitsu</span></a></li>
          <li class="level1"><a href="http://laptop-ansee.ru/remont-planshetov-HP.php" rel="nofollow"><span>HP</span></a></li>
          <li class="level1"><a href="http://laptop-ansee.ru/remont-planshetov-LENOVO.php" rel="nofollow"><span>Lenovo</span></a></li>
          <li class="level1"><a href="http://laptop-ansee.ru/remont-planshetov-HTC.php" rel="nofollow"><span>HTC</span></a></li>
          <li class="level1"><a href="http://laptop-ansee.ru/remont-planshetov-LG.php" rel="nofollow"><span>LG</span></a></li>
          <li class="level1"><a href="http://laptop-ansee.ru/remont-planshetov-TOSHIBA.php" rel="nofollow"><span>Toshiba</span></a></li>
          <li class="level1"><a href="http://laptop-ansee.ru/remont-planshetov-VIEWSONIC.php" rel="nofollow"><span>Viewsonic</span></a></li>
        </ul>
      </li>
      <li class="level-top parent"><a href="http://laptop-ansee.ru/obsluzhivanie-komputerov.php" rel="nofollow"><span>Организациям</span></a>
        <ul class="level0">
          <li><a href="http://laptop-ansee.ru/abonentskoe-obsluzhivanie-komputerov.php" rel="nofollow">абонентское обслуживание</a></li>
          <li><a href="http://laptop-ansee.ru/remont-printerov.php" rel="nofollow">принтеры</a></li>
          <li><a href="http://laptop-ansee.ru/" rel="nofollow">оргтехника</a></li>
          <li><a href="http://laptop-ansee.ru/obsluzhivanie-serverov.php" rel="nofollow">обслуживание серверов</a></li>
        </ul>
      </li>
    </ul>
  </div>
   <div class="block block-list block-manufacturer">
    <div class='block-title'><strong><span>База знаний</span></strong></div>
    <div class='block-content'>
      <ul>
        <li class='item'><a href="http://laptop-ansee.ru/blog/tipovye-neipravnosti.php" rel="nofollow">Типовые неисправности</a></li>
        <li class='item'><a href="http://laptop-ansee.ru/blog/sovety-po-vyboru.php" rel="nofollow">Советы по выбору техники</a></li>
        <li class='item'><a href="http://laptop-ansee.ru/blog/ekspluatatsiya-i-profilaktika.php" rel="nofollow">Эксплуатация и профилактика</a></li>
        <li class='item'><a href="http://laptop-ansee.ru/blog/dlya-novichkov.php" rel="nofollow">Для новичков</a></li>
        <li class='item'><a href="http://laptop-ansee.ru/blog/interesnye-novosti-iz-mira-IT.php" rel="nofollow">Интересные новости из мира IT</a></li>
        <li class='item'><a href="http://laptop-ansee.ru/blog/virusy-i-bezopasnost.php" rel="nofollow">Вирусы и безопасность</a></li>
        <li class='item'><a href="http://laptop-ansee.ru/blog/ustroystvo-kompyutera.php" rel="nofollow">Устройство компьютера</a></li>
              </ul>
    </div>
  </div>
  <div class="block block-tags">
    <div class="block-title"> <strong><span>Популярные проблемы</span></strong> </div>
    <div class="block-content">
      <ul>
        <li class='item'><a href="http://laptop-ansee.ru/post/shumit-kompyuter-ili-stal-silno-shumet-ispravlyaem.php" rel="nofollow">Шумит компьютер или стал шуметь. Исправляем</a></li>
        <li class='item'><a href="http://laptop-ansee.ru/post/kompyuter-sam-perezagruzhaetsya.php" rel="nofollow">Компьютер сам перезагружается</a></li>
        <li class='item'><a href="http://laptop-ansee.ru/post/dostup-v-set-zablokirovan-saytom-mvd--kak-vozobnovit-rabotu.php" rel="nofollow">Доступ сеть заблокирован сайтом МВД. Как возобновить работу?</a></li>
        <li class='item'><a href="http://laptop-ansee.ru/post/pochemu-monitor-ne-vklyuchaetsya.php" rel="nofollow">Почему монитор не включается?</a></li>
        <li class='item'><a href="http://laptop-ansee.ru/post/dostoinstva-i-nedostatki-ultrabukov.php" rel="nofollow">Достоинства и недостатки ультрабуков</a></li>
              </ul>
    </div>
  </div>
  <div class="block block-list block-manufacturer">
    <div class='block-title'><strong><span>Районы обслуживания Москвы</span></strong></div>
    <div class='block-content'>
      <ul>
        <li class='item'><a href="http://laptop-ansee.ru/severo-vostok.php" rel="nofollow">СВАО</a></li>
        <li class='item'><a href="http://laptop-ansee.ru/vostok.php" rel="nofollow">ВАО</a></li>
        <li class='item'><a href="http://laptop-ansee.ru/ugo-vostok.php" rel="nofollow">ЮВАО</a></li>
        <li class='item'><a href="http://laptop-ansee.ru/ug.php" rel="nofollow">ЮАО</a></li>
        <li class='item'><a href="http://laptop-ansee.ru/ugo-zapad.php" rel="nofollow">ЮЗАО</a></li>
        <li class='item'><a href="http://laptop-ansee.ru/zapad.php" rel="nofollow">ЗАО</a></li>
        <li class='item'><a href="http://laptop-ansee.ru/severo-zapad.php" rel="nofollow">СЗАО</a></li>
        <li class='item'><a href="http://laptop-ansee.ru/sever.php" rel="nofollow">САО</a></li>
        <li class='item'><a href="http://laptop-ansee.ru/centr.php" rel="nofollow">ЦАО</a></li>
      </ul>
    </div>
  </div>
  <div class="block block-tags">
    <div class="block-title"> <strong><span>Подмосковье</span></strong> </div>
    <div class="block-content">
      <ul class="tags-list">
        <li><a href="http://laptop-ansee.ru/remont-komputerov-mitishi.php" rel="nofollow" style="font-size:121.66666666667%;">Мытищи</a></li>
        <li><a href="http://laptop-ansee.ru/remont-komputerov-korolev.php" rel="nofollow" style="font-size:110%;">Королев</a></li>
        <li><a href="http://laptop-ansee.ru/komputernaya-pomosh-golianovo.php" rel="nofollow" style="font-size:75%;">Гольяново</a></li>
        <li><a href="http://laptop-ansee.ru/remont-komputerov-reutov.php" rel="nofollow" style="font-size:110%;">Реутов</a></li>
        <li><a href="http://laptop-ansee.ru/komputernaya-pomosh-zheleznodorozhni.php" rel="nofollow" style="font-size:98.333333333333%;">Железнодорожный</a></li>
        <li><a href="http://laptop-ansee.ru/komputernaya-pomosh-balashiha.php" rel="nofollow" style="font-size:133.33333333333%;">Балашиха</a></li>
        <li><a href="http://laptop-ansee.ru/komputernaya-pomosh-zhylebino.php" rel="nofollow" style="font-size:121.66666666667%;">Жулебино</a></li>
        <li><a href="http://laptop-ansee.ru/remont-noutbukov-luberci.php" rel="nofollow" style="font-size:110%;">Люберцы</a></li>
         <li><a href="http://laptop-ansee.ru/remont-noutbukov-solncevo.php" rel="nofollow" style="font-size:100%;">Солнцево</a></li>
        <li><a href="http://laptop-ansee.ru/komputernaya-pomosh-domodedovo.php" rel="nofollow" style="font-size:121.66666666667%;">Домодедово</a></li>
        <li><a href="http://laptop-ansee.ru/komputernaya-pomosh-chertanovo.php" rel="nofollow" style="font-size:110%;">Чертаново</a></li>
        <li><a href="http://laptop-ansee.ru/komputernaya-pomosh-vidnoe.php" rel="nofollow" style="font-size:98.333333333333%;">Видное</a></li>
        <li><a href="http://laptop-ansee.ru/remont-komputerov-butobo.php" rel="nofollow" style="font-size:98.333333333333%;">Бутово</a></li>
        <li><a href="http://laptop-ansee.ru/komputernaya-pomosh-peredelkino.php" rel="nofollow" style="font-size:110%;">Переделкино</a></li>
        <li><a href="http://laptop-ansee.ru/komputernaya-pomosh-kurkino.php" rel="nofollow" style="font-size:121.66666666667%;">Куркино</a></li>
        <li><a href="http://laptop-ansee.ru/komputernaya-pomosh-novoperedelkino.php" rel="nofollow" style="font-size:133.33333333333%;">Новопеределкино</a></li>
        <li><a href="http://laptop-ansee.ru/komputernaya-pomosh-odincovo.php" rel="nofollow" style="font-size:121.66666666667%;">Одинцово</a></li>
        <li><a href="http://laptop-ansee.ru/komputernaya-pomosh-tyshino.php" rel="nofollow" style="font-size:145%;">Тушино</a></li>
        <li><a href="http://laptop-ansee.ru/komputernaya-pomosh-himki.php" rel="nofollow" style="font-size:110%;">Химки</a></li>
        <li><a href="http://laptop-ansee.ru/remont-komputerov-krasnogorsk.php" rel="nofollow" style="font-size:133.33333333333%;">Красногорск</a></li>
        <li><a href="http://laptop-ansee.ru/komputernaya-pomosh-lobnya.php" rel="nofollow" style="font-size:121.66666666667%;">Лобня</a></li>
        <li><a href="http://laptop-ansee.ru/remont-komputerov-zelenograd.php" rel="nofollow" style="font-size:145%;">Зеленоград</a></li>
        <li><a href="http://laptop-ansee.ru/remont-noutbukov-brateevo.php" rel="nofollow" style="font-size:100%;">Братеево</a></li>
        <li><a href="http://laptop-ansee.ru/kompyuternaya-pomosch-v-pushkino.php" rel="nofollow" style="font-size:121.66666666667%;">Пушкино</a></li>
        <li><a href="http://laptop-ansee.ru/remont-noutbukov-v-elektrougli.php" rel="nofollow" style="font-size:133.33333333333%;">Электроугли</a></li>
        <li><a href="http://laptop-ansee.ru/remont-kompyuterov-v-chekhove.php" rel="nofollow" style="font-size:121.66666666667%;">Чехов</a></li>
        <li><a href="http://laptop-ansee.ru/remont-kompyuterov-v-troitske-.php" rel="nofollow" style="font-size:145%;">Троицк</a></li>
        <li><a href="http://laptop-ansee.ru/remont-kompyuterov-v-vatutinkakh.php" rel="nofollow" style="font-size:110%;">Ватутинки</a></li>
        <li><a href="http://laptop-ansee.ru/remont-kompyuterov-v-tolstopaltsevo.php" rel="nofollow" style="font-size:133.33333333333%;">Толстопальцево</a></li>
        <li><a href="http://laptop-ansee.ru/remont-kompyuterov-v-kokoshino.php" rel="nofollow" style="font-size:121.66666666667%;">Кокошино</a></li>
        <li><a href="http://laptop-ansee.ru/remont-kompyuterov-v-krekshino.php" rel="nofollow" style="font-size:145%;">Крекшино</a></li>
        <li><a href="http://laptop-ansee.ru/remont-kompyuterov-v-yakovlevskom.php" rel="nofollow" style="font-size:100%;">Яковлевское</a></li>
        <li><a href="http://laptop-ansee.ru/remont-kompyuterov-v-zvenigorode.php" rel="nofollow" style="font-size:121.66666666667%;">Звенигород</a></li>
        <li><a href="http://laptop-ansee.ru/remont-noutbukov-v-golitsyno.php" rel="nofollow" style="font-size:110%;">Голицыно</a></li>
        <li><a href="http://laptop-ansee.ru/remont-kompyuterov-v-kubinke.php" rel="nofollow" style="font-size:75%;">Кубинка</a></li>
        <li><a href="http://laptop-ansee.ru/remont-kompyuterov-v-tuchkovo.php" rel="nofollow" style="font-size:110%;">Тучково</a></li>
        <li><a href="http://laptop-ansee.ru/srochnyy-remont-noutbukov-v-dedovske.php" rel="nofollow" style="font-size:98.333333333333%;">Дедовск</a></li>
        <li><a href="http://laptop-ansee.ru/kompyuternaya-pomosch-v-nakhabino.php" rel="nofollow" style="font-size:133.33333333333%;">Нахабино</a></li>
        <li><a href="http://laptop-ansee.ru/remont-noutbukov-v-aprelevke.php" rel="nofollow" style="font-size:121.66666666667%;">Апрелевка</a></li>
        <li><a href="http://laptop-ansee.ru/srochnyy-remont-noutbukov-v-selyatino.php" rel="nofollow" style="font-size:110%;">Селятино</a></li>
        <li><a href="http://laptop-ansee.ru/kompyuternaya-pomosch-v-naro-fominske.php" rel="nofollow" style="font-size:100%;">Наро-Фоминск</a></li>
        <li><a href="http://laptop-ansee.ru/remont-kompyuterov-v-alabino.php" rel="nofollow" style="font-size:121.66666666667%;">Алабино</a></li>
        <li><a href="http://laptop-ansee.ru/remont-kompyuterov-v-kotelnikakh.php" rel="nofollow" style="font-size:110%;">Котельники</a></li>
        <li><a href="http://laptop-ansee.ru/remont-noutbukov-v-dzerzhinskom.php" rel="nofollow" style="font-size:98.333333333333%;">Дзержинский</a></li>
        <li><a href="http://laptop-ansee.ru/remont-kompyuterov-v-ramenskom.php" rel="nofollow" style="font-size:98.333333333333%;">Раменское</a></li>
        <li><a href="http://laptop-ansee.ru/remont-kompyuterov-v-zhukovskom.php" rel="nofollow" style="font-size:110%;"> Жуковский</a></li>
        <li><a href="http://laptop-ansee.ru/remont-kompyuterov-v-lytarkino.php" rel="nofollow" style="font-size:110%;">Лытаркино</a></li>
        <li><a href="http://laptop-ansee.ru/remont-kompyuterov-v-schelkovo.php" rel="nofollow" style="font-size:98.333333333333%;">Щелково</a></li>
        <li><a href="http://laptop-ansee.ru/remont-kompyuterov-v-scherbinke-.php" rel="nofollow" style="font-size:98.333333333333%;">Щербинка</a></li>
        <li><a href="http://laptop-ansee.ru/remont-kompyuterov-v-ivanteevke.php" rel="nofollow" style="font-size:110%;">Ивантеевка</a></li>
        <li><a href="http://laptop-ansee.ru/remont-kompyuterov-v--solnechnogorske.php" rel="nofollow" style="font-size:121.66666666667%;">Солнечногорск</a></li>
        <li><a href="http://laptop-ansee.ru/remont-kompyuterov-v-pavshinskoy-poyme.php" rel="nofollow" style="font-size:133.33333333333%;">Павшинская Пойма</a></li>
        <li><a href="http://laptop-ansee.ru/remont-kompyuterov-v-povarovo.php" rel="nofollow" style="font-size:121.66666666667%;">Поварово</a></li>
      </ul>
    </div>
  </div>
  <a class="banner_sidebar" href="http://laptop-ansee.ru/maps.php"> <img src="http://laptop-ansee.ru/img/33314.png" alt="карта метро" title="карта метро" class="map_znak" /></a></div><!--/noindex-->
</div>
</div>
</div><div class="footer-container">
  <div class="container">
    <div class="footer">
      <p id="back-top"><a href="#top"><span></span></a> </p>
      <div class="footer-cols-wrapper">
        <div class="footer-col">
          <h4>Для клиентов</h4>
          <div class="footer-col-content">
            <ul>
              <li><a href="http://laptop-ansee.ru/maps.php">Карта метро</a></li>
              <li><a href="http://laptop-ansee.ru/otzyvy.php">Наши отзывы</a></li>
               <li><a href="http://laptop-ansee.ru//kontakti.php>Контакты</a></li>
              <li><a href="http://laptop-ansee.ru/chastye-voprosy.php">Частые вопросы</a></li>
              <li><a href="http://laptop-ansee.ru/shema.php">Как заказать услугу</a></li>
            </ul>
          </div>
        </div>
        <div class="footer-col">
          <h4>Для партнеров</h4>
          <div class="footer-col-content">
            <ul>
              <li><a href="http://laptop-ansee.ru/">Сотрудничество</a></li>
              <li><a href="http://laptop-ansee.ru/company.php">О компании</a></li>
              <li><a href="http://laptop-ansee.ru/otzyvy.php">Наши отзывы</a></li>
              <li><a href="http://laptop-ansee.ru/master-po-remontu-kompyuterov.php">Наши вакансии</a></li>
            </ul>
          </div>
        </div>
        <div class="footer-col">
          <h4>Контактные данные</h4>
          <div class="footer-col-content">
            <ul>
              <li>8 (499) 350-44-61</li>
              <li>Время работы: 9:00 - 22:00</li>
              <li>Email: compprofimaster@yahoo.com 
			</li>
              <li>Москва, Краснопресненская набережная, д.12</li>
            </ul>
          </div>
        </div>
        <div class="footer-col">
          <div class="block block-subscribe">
            <div class="block-title"> <strong><span>Поиск</span></strong> </div>
            <form method="POST" action="http://laptop-ansee.ru/search.php" id="newsletter-validate-detail">
              <div class="block-content">
                <div class="input-box">
                  <input id="search2" type="text" name="search" title="Sign up for our newsletter" value="Введите фразу" onFocus="if(this.value=='Введите фразу')this.value='';" onBlur="if(this.value=='')this.value='Введите фразу';" class="input-text required-entry validate-email">
                </div>
                <div class="actions">
                  <button type="submit" title="Поиск" class="button"><span><span>Поиск!</span></span></button>
                </div>
              </div>
            </form>
          </div>
          <div class="share">
	<ul>
		<li>
		 <!-- Yandex.Metrika counter -->
<script type="text/javascript" >
   (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
   m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
   (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

   ym(52222741, "init", {
        id:52222741,
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true
   });
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/52222741" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
<!--LiveInternet counter--><script type="text/javascript">
document.write("<a href='//www.liveinternet.ru/click' "+
"target=_blank><img src='//counter.yadro.ru/hit?t52.11;r"+
escape(document.referrer)+((typeof(screen)=="undefined")?"":
";s"+screen.width+"*"+screen.height+"*"+(screen.colorDepth?
screen.colorDepth:screen.pixelDepth))+";u"+escape(document.URL)+
";h"+escape(document.title.substring(0,150))+";"+Math.random()+
"' alt='' title='LiveInternet: показано число просмотров и"+
" посетителей за 24 часа' "+
"border='0' width='88' height='31'><\/a>")
</script><!--/LiveInternet-->

</body>
</html>		</li>
	</ul>
</div>
        </div>
      </div>
      <address>
      &copy; Компания <a href="http://www.laptop-ansee.su">laptop-ansee.ru</a>. Мы всегда поможем.
      </address>
    </div>
  </div>
</div>
</div>