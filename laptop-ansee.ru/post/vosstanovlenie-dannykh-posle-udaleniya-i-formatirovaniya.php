<!DOCTYPE html>
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta name="description" content="Восстановление данных после удаления и форматирования/ Чего нельзя делать в случае удаления или форматирования данных "/>
<meta name="keywords" content="Восстановление данных после удаления Восстановление данных после удаления"/>
<title>Восстановление данных после удаления и форматирования</title>
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
</div><div class="breadcrumbs"><a href="http://laptop-ansee.ru/">Главная</a><a href="http://laptop-ansee.ru/blog/tipovye-neipravnosti.php">Типовые неиправности</a><strong>Восстановление данных после удаления и форматирования</strong></div>﻿<div class="content">
﻿<div class="socseti">
<script type="text/javascript" src="//yandex.st/share/share.js" charset="utf-8"></script>
<div class="yashare-auto-init" data-yashareL10n="ru" data-yashareQuickServices="yaru,vkontakte,facebook,twitter,odnoklassniki,moimir,gplus" data-yashareTheme="counter"></div> 
</div>
<p class='blog_title'>Восстановление данных после удаления и форматирования</p>
<p class='blog_date'>Автор: </p>
<p class='blog_date1'>Дата: 2014-06-04</p>
<p class='blog_text'><p><img alt="восстановление данных после фыорматирования" src="/upload/image/disk.png" style="margin: 4px; float: left; width: 350px; height: 217px;" title="восстановление данных после фыорматирования" />Для современного человека использование персонального компьютера стало необходимостью. Одни стараются создавать на нем практически все необходимые по работе документы, другие стараются заработать обработкой фотографий и видеофильмов. Но для любого крайне неприятной является потеря необходимой информации с носителей, что вполне может произойти как по причине неисправности устройства на котором происходит хранение данных, так и по неосторожности пользователя. Случаются ситуации, когда крайне полезная и важная информация, которая хранится едва ли не в единственном экземпляре, становится недоступной из-за удаления или форматирования.</p>

<h2>Чего нельзя делать в случае удаления или форматирования данных</h2>

<p>Если такая ситуация произошла не стоит сразу расстраиваться, вполне возможно, что данные можно восстановить. Но при этом необходимо четко понимать, что есть ряд действий и условий, которые сделают процесс восстановления практически невозможным. Поэтому для того, чтобы иметь шанс на восстановление информации необходимо:</p>

<ul>
	<li>не записывать на поврежденный или отформатированный носитель новую информацию чтобы не затереть удаленные данные;</li>
	<li>не подключать поврежденное хранилище данных к персональному компьютеру с&nbsp;включенной службой восстановления данных или резервного копирования;</li>
	<li>не пытаться восстановить информацию при помощи непроверенных программ.</li>
</ul>

<h2>Почему данные не со всех носителей информации восстанавливаются</h2>

<p>Для рядового пользователя нет особенной разницы в том как хранится информация, часто мы даже не вдаемся в подробности о том какой из вариантов файловой системы используется, и различаем только жесткий диск и флеш накопитель. Хотя и последнее скорее только по уровню мобильности и внешнему исполнению, но на самом деле устройства существенно различаются принципом хранения информации, а соответственно способы ее восстановления значительно отличаются.</p>

<ol>
	<li>
	<p>Классический жесткий диск – представляет собой механизм, в котором данные при помощи специальных электромагнитных головок записываются на металлизированные пластины. При таком способе записи нет необходимости в посекторном или побитном стирании информации и новые данные просто записываются поверх старых как в кассетных магнитофонах. При удалении информации с такого носителя на диске просто аннулируется запись о их наличии, но сами они никуда не исчезают. Соответственно при помощи специальных программ, которые выполнят полное сканирование диска, можно не особенно заморачиваясь восстановить всю полезную информацию.</p>
	</li>
	<li>
	<p>Более современное устройство для хранения данных – флеш накопитель. Информация на таком устройстве хранится на специальных микросхемах памяти, которые имеют несколько тысяч циклов перезаписи. Как и на жестких дисках информацию с флеш накопителя можно удалить несколькими способами:</p>
	</li>
</ol>

<ul>
	<li>произвести очистку оглавления, и при этом обнулиться только область памяти, хранящая таблицу размещения данных;</li>
	<li>полное форматирование диска – при таком способе очистки происходит побитовое обнуление данных и восстановить удаленную информацию будет просто невозможно.</li>
</ul>

<h2>Какие программы использовать для восстановления</h2>

<p>Recuva, пожалуй, на сегодня наиболее интересная программа для восстановления данных. Над ее созданием трудились те же люди, которые создавали CCleaner. Программа позволяет произвести восстановление удаленных с высоким процентом их целостности. Но недостатком программы стоит считать то, что она рассчитана на людей, которые прекрасно понимают, что именно необходимо делать. Среднестатистическому пользователю будет довольно проблематично разобраться со всеми настройками и нюансами работы с продуктом, несмотря на то, что при первом запуске будет предложено ее полностью настроить. Да, разработчики оснастили продукт великолепным аналитическим блоком, который еще при сканировании определяет насколько высока вероятность восстановления файлов, но если необходимость такого рода работы возникла впервые, то лучше выбрать другую программу.</p>

<p><img alt="r-stidio" src="/upload/image/vosst.jpg" style="margin-top: 4px; margin-bottom: 4px; float: left; width: 400px; height: 215px;" title="r-stidio" />R-Studio, продукт, который более дружелюбен к пользователю, нежели конкуренты. К сожалению, производители давно не обновляли алгоритмов восстановления данных поэтому если вы решили воспользоваться именно ей, то приготовьтесь к долгому ожиданию. Процент удачного восстановления информации достаточно высок практически для любого носителя. При помощи 6 версии R-Studio можно великолепно возвращать потерянные данные как с жестких дисков, так и с флеш накопителей. Меню, которое появляется при загрузке, позволяет выбрать как упрощенный способ восстановления данных, который наиболее подойдет для начинающих пользователей, так и более продвинутый, который позволит точно настроить все действия при работе с накопителем.</p>

<p>Undelete Plus – еще одна программа, которую хотелось бы порекомендовать людям, впервые столкнувшимся с проблемой потери данных. Настройки программы минимальны, однако, шанс восстановления данных довольно неплох. Программа позволяет практически полностью автоматизировать процесс сканирования и восстановления, и достаточно просто нажать на одну кнопку чтобы получить результат.</p>

<h2>Как действовать если диск отформатирован</h2>

<p>Итак, представим такую ситуацию, в которой необходимо восстановить удаленные файлы, удаленные в операционной системе Windows.</p>

<ol>
	<li>
	<p>Первым делом необходимо заглянуть в корзину, вполне возможно, носитель не отформатирован, а файлы просто удалены, тогда и восстановить их не составит труда.</p>
	</li>
	<li>
	<p>Если файлов нет и винчестер или флеш накопитель полностью очищены, то необходимо проверить носитель на программные ошибки. Для того можно использовать программы от Acroniks или Pragon.</p>
	</li>
	<li>
	<p>Если ошибок нет и файлы в корзине отсутствуют, то необходимо подготовить еще один носитель для сохранения восстановленных данных.</p>
	</li>
	<li>
	<p>Установить диск, на котором находились необходимые данные в компьютер на котором отсутствует или отключено антивирусное программное обеспечение, которое может помешать работе программ и начать восстановление.</p>
	</li>
</ol>

<p>Итак, если данные с диска «вдруг» пропали – не нервничать и не совершать необдуманных поступков, которые могут затруднить их восстановление. Действуйте последовательно и осторожно, и всю ценную информацию можно будет использовать.</p>
</p>
<p class='view'>Просмотров: 1267</p><div class="facebook1"><div class="fb-like" data-href="http://laptop-ansee.ru/post/vosstanovlenie-dannykh-posle-udaleniya-i-formatirovaniya.php" data-width="0" data-layout="button_count" data-action="like" data-show-faces="true" data-share="false"></div></div>
<!-- Put this script tag to the <head> of your page -->
<script type="text/javascript">VK.init({apiId: 4427299, onlyWidgets: true});</script>
<!-- Put this div tag to the place, where the Like block will be -->
<div class="vk1"><div id="vk_like"></div>
</div>
<div class="twitter1"><a href="https://twitter.com/AnseeWebmaster" class="twitter-share-button" data-lang="ru">Tweet</a></div>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
 <!-- Поместите этот тег туда, где должна отображаться кнопка +1. -->
<div class="google1"><div class="g-plusone" data-annotation="inline" data-width="32" data-href="http://laptop-ansee.ru/post/vosstanovlenie-dannykh-posle-udaleniya-i-formatirovaniya.php"></div></div>
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
<div class="col-left sidebar col-xs-12 col-sm-3"><div class="nav-container block"><div class="menu-icon-style">Блог</div><ul class="sf-menu-phone item"><li class="leveles"><a href="http://laptop-ansee.ru/blog/tipovye-neipravnosti.php" class="active".php" class="active" rel="nofollow"><span>Типовые неиправности</span></a></li><li class="leveles"><a href="http://laptop-ansee.ru/blog/sovety-po-vyboru.php".php" rel="nofollow"><span>Cоветы по выбору техники</span></a></li><li class="leveles"><a href="http://laptop-ansee.ru/blog/ekspluatatsiya-i-profilaktika.php".php" rel="nofollow"><span>Эксплуатация и профилактика</span></a></li><li class="leveles"><a href="http://laptop-ansee.ru/blog/dlya-novichkov.php".php" rel="nofollow"><span>Для новичков</span></a></li><li class="leveles"><a href="http://laptop-ansee.ru/blog/interesnye-novosti-iz-mira-IT.php".php" rel="nofollow"><span>Интересные новости из мира IT</span></a></li><li class="leveles"><a href="http://laptop-ansee.ru/blog/virusy-i-bezopasnost.php".php" rel="nofollow"><span>Вирусы и безопасность</span></a></li><li class="leveles"><a href="http://laptop-ansee.ru/blog/ustroystvo-kompyutera.php".php" rel="nofollow"><span>Устройство компьютера</span></a></li></ul></div>
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