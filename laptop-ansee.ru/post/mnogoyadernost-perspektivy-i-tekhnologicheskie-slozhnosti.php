<!DOCTYPE html>
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta name="description" content="Многоядерность"/>
<meta name="keywords" content="Многоядерность"/>
<title>Многоядерность. Перспективы и технологические сложности.</title>
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
</div><div class="breadcrumbs"><a href="http://laptop-ansee.ru/">Главная</a><a href="http://laptop-ansee.ru/blog/dlya-novichkov.php">Для новичков</a><strong>Многоядерность. Перспективы и технологические сложности.</strong></div>﻿<div class="content">
﻿<div class="socseti">
<script type="text/javascript" src="//yandex.st/share/share.js" charset="utf-8"></script>
<div class="yashare-auto-init" data-yashareL10n="ru" data-yashareQuickServices="yaru,vkontakte,facebook,twitter,odnoklassniki,moimir,gplus" data-yashareTheme="counter"></div> 
</div>
<p class='blog_title'>Многоядерность. Перспективы и технологические сложности.</p>
<p class='blog_date'>Автор: administrator</p>
<p class='blog_date1'>Дата: 2013-04-28</p>
<p class='blog_text'><p> </p>

<p style="text-align:center"><strong><img alt="многоядерность" src="/upload/image/processeur_intel.png" style="height:463px; width:600px" title="многоядерность" /></strong></p>

<p><span style="font-size:18px"><span style="font-family:times new roman,times,serif">Развитие индустрии микропроцессоров до 2004 года происходило довольно линейно и прогнозируемо – вычислительная мощность увеличивалась наращиванием тактовой частоты. Концом этой тенденции послужило достижение предела максимально возможной частоты процессора при условии его стабильной работы, а также неприемлемость потребляемой мощности. Сейчас же актуальность в тенденции развития микропроцессоров сохраняет наращивание количества отдельных ядер на кристалле. Этим принципом руководствуются практически все всемирно известные производители процессорной техники. Первым рывком на данном этапе было представление первого восьмиядерного микропроцессора, разработанного компанией Sun Microsystems. Тогда другие разработчики только внедряли массовое производство «двуядерников».</span></span></p>

<p><span style="font-size:18px"><span style="font-family:times new roman,times,serif">На сегодняшний же день все баталии сосредоточены на продвижении четырех- и восьмиядерных чипов. В то же время компания AMD не уверена в целесообразности последующего увеличения количества ядер, направляя свою деятельность на создание ассиметричных микропроцессоров, включающих в себя большое число ядер, имеющих различное функциональное предназначение. Компания планирует массово внедрять гетерогенную многоядерность сразу после того, как только клонирование ядер на одном кристалле станет неэффективным.</span></span></p>

<p><span style="font-size:18px"><span style="font-family:times new roman,times,serif">Как стало очевидно, современные многоядерные системы показывают максимально возможную производительность только при условии соблюдения множества требований. К примеру, для достижения наибольшей эффективности работы процессора приложения должны быть многопоточными с заранее предусмотренным распараллеливанием выполняемых задач. При этом, согласно заявлению компании Intel, повышению эффективности функционирования многоядерных чипов препятствует достаточно слабый рост количества современного многопоточного программного обеспечения по сравнению с развитием микропроцессорного производства. Кроме того, программисты с большими затруднениями переходят с привычного всем однопоточного принципа программирования на написание распараллеливаемого кода.</span></span></p>

<p><span style="font-size:18px"><span style="font-family:times new roman,times,serif">Спор о вышеприведенных трудностях актуален уже достаточно давно, в результате чего возникла проблема сдерживания современной индустрии процессорной техники. На сегодня дефицит многопоточности процессоров тормозит развитие технологий больше, чем исчерпание свойств полупроводников.</span></span></p>

<p><span style="font-size:18px"><span style="font-family:times new roman,times,serif">В качестве перспективы дальнейшего развития, предложенной компанией ATI, можно рассматривать инициативу производителя относительно переноса хорошо распараллеливаемых задач на графические процессоры, а в итоге – частичной разгрузки ЦП. Первые попытки такого переноса уже производятся.</span></span></p>

<p><span style="font-size:18px"><span style="font-family:times new roman,times,serif">В то же время компания AMD стремится к внедрению иного подхода – разработки ускоренных процессоров (APU). Такие процессоры имеют блочную структуру строения, а каждый отдельный блок отвечает за исполнение своих задач, не будучи клоном соседнего чипа. Результатом первых попыток реализации такой идеи стал выпуск процессоров, имеющих встроенные контроллеры памяти. Сейчас массово появляются чипы, в которых процессорное ядро совмещают с графическим. Как прогнозируется, ускоренные процессоры APU, как и обычные многоядерники будут содержать несколько отдельных ядер, однако функциональность первых будет значительно выше, поскольку они смогут выполнять физические вычисления и обрабатывать графическую информацию. Кроме этого, важным направлением развития процессорной индустрии является достижение максимально возможной энергетической эффективности в расчете на исполнение одной инструкции.</span></span></p>

<p><span style="font-size:18px"><span style="font-family:times new roman,times,serif">Таким образом, в развитии процессорной техники на сегодняшний день создался некий затор, немного притормозив стремительные темпы наращивания эффективности продукции. Однако, как показывает практика, мировые производители направляют свою деятельность в русло разработки новых технологий, кардинально отличающихся от действующих ныне канонов. И вполне возможно, что уже через несколько лет мы увидим на рынке совершенно новые виды компьютерных чипов, способных удивить современного пользователя своей функциональностью.</span></span></p>
</p>
<p class='view'>Просмотров: 2653</p><div class="facebook1"><div class="fb-like" data-href="http://laptop-ansee.ru/post/mnogoyadernost-perspektivy-i-tekhnologicheskie-slozhnosti.php" data-width="0" data-layout="button_count" data-action="like" data-show-faces="true" data-share="false"></div></div>
<!-- Put this script tag to the <head> of your page -->
<script type="text/javascript">VK.init({apiId: 4427299, onlyWidgets: true});</script>
<!-- Put this div tag to the place, where the Like block will be -->
<div class="vk1"><div id="vk_like"></div>
</div>
<div class="twitter1"><a href="https://twitter.com/AnseeWebmaster" class="twitter-share-button" data-lang="ru">Tweet</a></div>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
 <!-- Поместите этот тег туда, где должна отображаться кнопка +1. -->
<div class="google1"><div class="g-plusone" data-annotation="inline" data-width="32" data-href="http://laptop-ansee.ru/post/mnogoyadernost-perspektivy-i-tekhnologicheskie-slozhnosti.php"></div></div>
<!-- Put this script tag to the <head> of your page -->

<script type="text/javascript">
  VK.init({apiId: 4427299, onlyWidgets: true});
</script>
<!-- Put this div tag to the place, where the Comments block will be -->
<div id="vk_comments"></div>
<script type="text/javascript">
VK.Widgets.Comments("vk_comments", {limit: 10, width: "520", attach: "*"});
</script>

</div>
</div>
</div><!--noindex-->
<div class="col-left sidebar col-xs-12 col-sm-3"><div class="nav-container block"><div class="menu-icon-style">Блог</div><ul class="sf-menu-phone item"><li class="leveles"><a href="http://laptop-ansee.ru/blog/tipovye-neipravnosti.php".php" rel="nofollow"><span>Типовые неиправности</span></a></li><li class="leveles"><a href="http://laptop-ansee.ru/blog/sovety-po-vyboru.php".php" rel="nofollow"><span>Cоветы по выбору техники</span></a></li><li class="leveles"><a href="http://laptop-ansee.ru/blog/ekspluatatsiya-i-profilaktika.php".php" rel="nofollow"><span>Эксплуатация и профилактика</span></a></li><li class="leveles"><a href="http://laptop-ansee.ru/blog/dlya-novichkov.php".php" rel="nofollow"><span>Для новичков</span></a></li><li class="leveles"><a href="http://laptop-ansee.ru/blog/interesnye-novosti-iz-mira-IT.php".php" rel="nofollow"><span>Интересные новости из мира IT</span></a></li><li class="leveles"><a href="http://laptop-ansee.ru/blog/virusy-i-bezopasnost.php".php" rel="nofollow"><span>Вирусы и безопасность</span></a></li><li class="leveles"><a href="http://laptop-ansee.ru/blog/ustroystvo-kompyutera.php" class="active".php" class="active" rel="nofollow"><span>Устройство компьютера</span></a></li></ul></div>
	 <div class="block block-list block-manufacturer">
    <div class="block-title"><strong><span>Популярные</span></strong></div>
    <div class="block-content">
      <ul><li class="item"><a href="http://laptop-ansee.ru/post/shumit-kompyuter-ili-stal-silno-shumet-ispravlyaem.php" rel="nofollow"><span>Шумит компьютер, или стал сильно шуметь. Исправляем!</span></a></li><li class="item"><a href="http://laptop-ansee.ru/post/kompyuter-sam-perezagruzhaetsya.php" rel="nofollow"><span>Компьютер сам перезагружается</span></a></li><li class="item"><a href="http://laptop-ansee.ru/post/dostup-v-set-zablokirovan-saytom-mvd--kak-vozobnovit-rabotu.php" rel="nofollow"><span>Доступ в сеть заблокирован сайтом МВД – как возобновить работу?</span></a></li><li class="item"><a href="http://laptop-ansee.ru/post/dostoinstva-i-nedostatki-ultrabukov.php" rel="nofollow"><span>Достоинства и недостатки ультрабуков</span></a></li><li class="item"><a href="http://laptop-ansee.ru/post/pochemu-monitor-ne-vklyuchaetsya.php" rel="nofollow"><span>Почему монитор не включается</span></a></li></ul>
    </div>
  </div></div></div></div></div>	 
	 
	<div class="footer-container">
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