<!DOCTYPE html>
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta name="description" content="Системы RISC и CISC "/>
<meta name="keywords" content="Системы RISC и CISC "/>
<title>Системы RISC и CISC</title>
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
</div><div class="breadcrumbs"><a href="http://laptop-ansee.ru/">Главная</a><a href="http://laptop-ansee.ru/blog/dlya-novichkov.php">Для новичков</a><strong>Системы RISC и CISC</strong></div>﻿<div class="content">
﻿<div class="socseti">
<script type="text/javascript" src="//yandex.st/share/share.js" charset="utf-8"></script>
<div class="yashare-auto-init" data-yashareL10n="ru" data-yashareQuickServices="yaru,vkontakte,facebook,twitter,odnoklassniki,moimir,gplus" data-yashareTheme="counter"></div> 
</div>
<p class='blog_title'>Системы RISC и CISC</p>
<p class='blog_date'>Автор: Таненбаум Э.С.</p>
<p class='blog_date1'>Дата: 2014-06-16</p>
<p class='blog_text'><h1>Системы RISC и CISC&nbsp;</h1>

<p>В конце 70-х годов проводилось много экспериментов с очень сложными командами, появление которых стало возможным благодаря интерпретации. Разработчики пытались уменьшить разрыв между тем, что компьютеры способны делать,&nbsp;и тем, что требуют языки высокого уровня. Едва ли кто-нибудь тогда думал&nbsp;о разработке более простых машин, так же как сейчас мало кто (к несчастью) занимается разработкой менее мощных операционных систем, сетей, редакторов&nbsp;и т. д.&nbsp;В компании IBM этой тенденции противостояла группа разработчиков во&nbsp;<br />
главе с Джоном Коком (John Соске); они попытались воплотить идеи Сеймура&nbsp;Крея, создав экспериментальный высокоэффективный мини-компьютер 801. Хотя компания IBM не занималась сбытом этой машины, а результаты эксперимента были опубликованы только через несколько лет [170], весть быстро разнеслась по свету, и другие производители тоже занялись разработкой подобных&nbsp;архитектур.&nbsp;</p>

<p style="text-align: center;"><img alt="системы risc и cisc" src="/upload/image/443152_html_m65c02619.png" style="margin: 5px; width: 650px; height: 317px;" title="системы risc и cisc" /></p>

<p><span style="line-height: 1.6;">В 1980 году группа разработчиков в университете Беркли во главе с Дэвидом&nbsp;Паттерсоном (David Patterson) и Карло Секвином (Carlo Sequin) начала разработку не ориентированных на интерпретацию процессоров VLSI [161, 164]. Для&nbsp;обозначения этого понятия они придумали термин RISC, а новый процессор&nbsp;назвали RISC I, вслед за которым вскоре был выпущен RISC II. Немного позже,&nbsp;в 1981 году, Джон Хеннеси (John Hennesy) в Стенфорде разработал и выпустил&nbsp;другую микросхему, которую он назвал MIPS [91]. Эти две микросхемы развились в коммерчески важные продукты SPARC и MIPS соответственно.&nbsp;Новые процессоры существенно отличались от коммерческих процессоров&nbsp;</span></p>

<p>того времени. Поскольку они были несовместимы с существующей продукцией,&nbsp;разработчики вправе были включать туда новые наборы команд, которые могли&nbsp;бы повысить общую производительность системы. Первоначально основное внимание уделялось простым командам, которые могли быстро выполняться. Однако вскоре разработчики осознали, что ключом к высокой производительности&nbsp;компьютера является разработка команд, которые можно быстро запускать. То&nbsp;есть не так важно, как долго выполняется та или иная команда, важнее то, сколько команд в секунду может быть запущено.&nbsp;В то время, когда разрабатывались эти простые процессоры, всеобщее внимание привлекало относительно небольшое количество команд (обычно около 50).&nbsp;Для сравнения: число команд в компьютерах VAX производства DEC и больших&nbsp;компьютерах производства IBM в то время составляло от 200 до 300. Компьютер&nbsp;RISC (Reduced Instruction Set Computer — компьютер с сокращенным набором&nbsp;команд) противопоставлялся системе CISC (Complex Instruction Set Computer — компьютер с полным набором команд). В качестве примера машины типа CISC можно привести компьютер VAX, который доминировал в то время&nbsp;в университетской среде. На сегодняшний день мало кто считает, что главное&nbsp;отличие RISC и CISC состоит в количестве команд, но названия сохраняются&nbsp;до сих пор.&nbsp;С этого момента началась грандиозная идеологическая война между сторонниками RISC и разработчиками VAX, Intel и мэйнфреймов IBM. По мнению&nbsp;первых, наилучший способ разработки компьютеров — включение туда небольшого количества простых команд, каждая из которых выполняется за один цикл&nbsp;тракта данных (см. рис. 2.2), то есть производит над парой регистров какую-либо&nbsp;арифметическую или логическую операцию (например, сложение или операцию&nbsp;логического И) и помещает результат обратно в регистр. В качестве аргумента&nbsp;они утверждали, что, даже если системе RISC приходится выполнять 4 или 5 команд вместо одной, которую выполняет CISC, RISC все равно выигрывает в скорости, так как RISC-команды выполняются в 10 раз быстрее (поскольку они не&nbsp;<br />
интерпретируются). Следует также отметить, что к этому времени быстродействие основной памяти приблизилось к быстродействию специальных командных&nbsp;ПЗУ, поэтому недостатки интерпретации были налицо, что еще более поднимало популярность компьютеров RISC.&nbsp;Учитывая преимущества RISC в плане производительности, можно было&nbsp;предположить, что на рынке такие компьютеры, как Alpha компании DEC, должны доминировать над компьютерами CISC (Pentium и т. д.).</p>

<p style="text-align: center;"><img alt="risc и cisk" src="/upload/image/cisc_risc.jpg" style="margin: 5px; width: 548px; height: 460px;" title="risc и cisk" /></p>

<p>Однако ничего подобного не произошло. Возникает вопрос: почему?&nbsp;<br />
Во-первых, компьютеры RISC несовместимы с другими моделями, а многие&nbsp;компании вложили миллиарды долларов в программное обеспечение для продукции Intel. Во-вторых, как ни странно, компания Intel сумела воплотить те же&nbsp;идеи в архитектуре CISC. Процессоры Intel, начиная с процессора 486, содержат&nbsp;RISC-ядро, которое выполняет самые простые (и обычно самые распространенные) команды за один цикл тракта данных, а по обычной технологии CISC интерпретируются более сложные команды. В результате обычные команды выполняются быстро, а более сложные и редкие — медленно. Хотя при таком&nbsp;«гибридном» подходе производительность ниже, чем в архитектуре RISC, новая&nbsp;архитектура CISC имеет ряд преимуществ, поскольку позволяет использовать&nbsp;старое программное обеспечение без изменений.&nbsp;</p>

<p><em>Источник </em></p>

<p><em>"Архитектура компьютера" 5 изд.&nbsp;<span style="line-height: 1.6;">Таненбаум Э.С.</span></em></p>

<p> </p>
</p>
<p class='view'>Просмотров: 2679</p><div class="facebook1"><div class="fb-like" data-href="http://laptop-ansee.ru/post/sistemy-RISC-i-CISC.php" data-width="0" data-layout="button_count" data-action="like" data-show-faces="true" data-share="false"></div></div>
<!-- Put this script tag to the <head> of your page -->
<script type="text/javascript">VK.init({apiId: 4427299, onlyWidgets: true});</script>
<!-- Put this div tag to the place, where the Like block will be -->
<div class="vk1"><div id="vk_like"></div>
</div>
<div class="twitter1"><a href="https://twitter.com/AnseeWebmaster" class="twitter-share-button" data-lang="ru">Tweet</a></div>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
 <!-- Поместите этот тег туда, где должна отображаться кнопка +1. -->
<div class="google1"><div class="g-plusone" data-annotation="inline" data-width="32" data-href="http://laptop-ansee.ru/post/sistemy-RISC-i-CISC.php"></div></div>
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
<div class="col-left sidebar col-xs-12 col-sm-3"><div class="nav-container block"><div class="menu-icon-style">Блог</div><ul class="sf-menu-phone item"><li class="leveles"><a href="http://laptop-ansee.ru/blog/tipovye-neipravnosti.php".php" rel="nofollow"><span>Типовые неиправности</span></a></li><li class="leveles"><a href="http://laptop-ansee.ru/blog/sovety-po-vyboru.php".php" rel="nofollow"><span>Cоветы по выбору техники</span></a></li><li class="leveles"><a href="http://laptop-ansee.ru/blog/ekspluatatsiya-i-profilaktika.php".php" rel="nofollow"><span>Эксплуатация и профилактика</span></a></li><li class="leveles"><a href="http://laptop-ansee.ru/blog/dlya-novichkov.php" class="active".php" class="active" rel="nofollow"><span>Для новичков</span></a></li><li class="leveles"><a href="http://laptop-ansee.ru/blog/interesnye-novosti-iz-mira-IT.php".php" rel="nofollow"><span>Интересные новости из мира IT</span></a></li><li class="leveles"><a href="http://laptop-ansee.ru/blog/virusy-i-bezopasnost.php".php" rel="nofollow"><span>Вирусы и безопасность</span></a></li><li class="leveles"><a href="http://laptop-ansee.ru/blog/ustroystvo-kompyutera.php".php" rel="nofollow"><span>Устройство компьютера</span></a></li></ul></div>
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