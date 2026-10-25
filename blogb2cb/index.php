<?php
$LastModified_unix = time(); // время последнего изменения страницы
$LastModified = gmdate("D, d M Y H:i:s \G\M\T", $LastModified_unix);
$IfModifiedSince = false;
if (isset($_ENV['HTTP_IF_MODIFIED_SINCE']))
    $IfModifiedSince = strtotime(substr($_ENV['HTTP_IF_MODIFIED_SINCE'], 5));  
if (isset($_SERVER['HTTP_IF_MODIFIED_SINCE']))
    $IfModifiedSince = strtotime(substr($_SERVER['HTTP_IF_MODIFIED_SINCE'], 5));
if ($IfModifiedSince && $IfModifiedSince >= $LastModified_unix) {
    header($_SERVER['SERVER_PROTOCOL'] . ' 304 Not Modified');
    exit;
}
header('Last-Modified: '. $LastModified);
?>
<?php
defined('_JEXEC') or die;
$doc = JFactory::getDocument();
//unset($doc->base);

/*$doc->addStyleSheet(JUri::base() . 'templates/' . $doc->template . '/css/slicknav.css');
$doc->addStyleSheet(JUri::base() . 'templates/' . $doc->template . '/css/style.css');
//$doc->addStyleSheet(JUri::base() . 'templates/' . $doc->template . '/css/responsive.css');
$doc->addStyleSheet(JUri::base() . 'templates/' . $doc->template . '/css/mobile.css');
$doc->addStyleSheet(JUri::base() . 'templates/' . $doc->template . '/css/responsive-tables.css');

$doc->addScript(JUri::base() . 'templates/' . $doc->template . '/js/swfobject.js');
$doc->addScript(JUri::base() . 'templates/' . $doc->template . '/js/jquery.slicknav.min.js');
$doc->addScript(JUri::base() . 'templates/' . $doc->template . '/js/calc.js');
$doc->addScript(JUri::base() . 'templates/' . $doc->template . '/js/scripts.js');
$doc->addScript(JUri::base() . 'templates/' . $doc->template . '/js/slideout.js');*/
//$doc->addStyleSheet(JUri::base() . 'templates/' . $doc->template . '/css/css.css');
?>
<?php echo '<?'; ?>xml version="1.0" encoding="<?php echo $this->_charset ?>"?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">

<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">


<meta name="google-site-verification" content="KMVmcj5a-TockmRpZScrmBRTA0h_xCyUrozRky-bmzA" />
<meta name="verify-v1" content="+tiEKSo0rdeNn6qjbu6QVmd4uJLWUaNAWUnQNCzLM1A=" />
<meta name="yandex-verification" content="9784cc1a54609371" />
<meta name="mailru-domain" content="6CADxBxlsnZ1O4xL" />

<jdoc:include type="head" />
<script type="text/javascript">
<!--if (swfobject.hasFlashPlayerVersion("8.0.0")) {var fn = function() {var att = {data: "<?php echo $this->baseurl ?>/templates/beez_20/header.swf",width: "1000",height: "469"};var par = {menu: "true",quality: "high",wmode: "opaque"};var id = "replaceMe";var myObject = swfobject.createSWF(att, par, id);};swfobject.addDomLoadEvent(fn);}-->
</script>
	
<link href="/templates/clear_j3/css/style.css" rel="stylesheet" type="text/css">
<link href="/templates/clear_j3/css/mobile.css" rel="stylesheet" type="text/css" media="all">
	<link href="/templates/clear_j3/css/slicknav.css" rel="stylesheet" type="text/css" media="all">	
	<link href="/templates/clear_j3/css/responsive-tables.css" rel="stylesheet" type="text/css" media="all">
  <link href="/templates/clear_j3/css/css.css" rel="stylesheet" type="text/css" media="all">

<?php
//<style> 
// html,body{margin:0;padding:0;width:100%;height:100%;}#page{position:relative;min-height:100%;}* html #page{height:100%;}a,img{outline:none;}*{margin:0px;padding:0px;}body{font-family:tahoma, arial, helvetica, sans-serif;color:#000000;font-size:14px;}img{border:0;}a{text-decoration:underline;color:#3b3b3b;}a:hover{text-decoration:none;}nav.menu{display:none;}.slideout-menu{position:fixed;left:0;top:0;bottom:0;right:0;z-index:1;width:256px;overflow-y:auto;-webkit-overflow-scrolling:touch;display:none;background:#e7dbcf;}nav.menu ul{margin:0;}nav.menu li{list-style:none;}nav.menu a{display:block;text-decoration:none;color:#000;font-size:16px;padding:10px;font-weight:bold;}nav.menu .nav.menu + .nav.menu li:last-child a{border-radius:3px;margin:0 10px;padding:10px 0;display:block;text-align:center;font-weight:bold;-webkit-box-shadow:none;box-shadow:none;color:#fff;background:#fe6f00;background:-webkit-linear-gradient(top, #fe6f00, #e54400);background:-o-linear-gradient(top, #fe6f00, #e54400);background:-moz-linear-gradient(top, #fe6f00, #e54400);background:linear-gradient(top, #fe6f00, #e54400);border:1px solid #ff7800;text-shadow:0 2px 1px #a33400;margin-bottom:15px;}nav.menu .active a{text-decoration:underline;}nav.menu li ul a{padding-left:40px;font-size:21px;}nav.menu li ul ul a{padding-left:60px;font-size:18px;}nav.menu .cols{padding:20px 10px 0;}nav.menu .cols a{display:block;vertical-align:middle;text-decoration:none;height:24px;line-height:24px;font-size:16px;color:#c2b499;background:#46331e;border:1px dotted #684721;box-shadow:inset 0px 0px 6px 3px #1e1002;-webkit-border-radius:3px;-moz-border-radius:3px;border-radius:3px;margin-bottom:10px;text-align:center;}nav.menu .cols .call:nth-child(2) a{font-weight:bold;-webkit-box-shadow:none;box-shadow:none;color:#fff;background:#f20000;background:#fe6f00;background:-webkit-linear-gradient(top, #fe6f00, #e54400);background:-o-linear-gradient(top, #fe6f00, #e54400);background:-moz-linear-gradient(top, #fe6f00, #e54400);background:linear-gradient(top, #fe6f00, #e54400);border:1px solid #ff7800;text-shadow:0 2px 1px #a33400;}.panel-header{width:100%;height:78px;z-index:3;background:url(/templates/clear_j3/img/top.jpg) repeat-x left center;-webkit-box-shadow:0px 0px 5px 0px rgba(0, 0, 0, 0.75);-moz-box-shadow:0px 0px 5px 0px rgba(0, 0, 0, 0.75);box-shadow:0px 0px 5px 0px rgba(0, 0, 0, 0.75);display:none;position:fixed;backface-visibility:hidden;}.panel-header .info{float:right;height:78px;text-align:right;margin-right:15px;}.panel-header .phone{height:39px;line-height:42px;}.panel-header .phone a{color:#ff000f;font-weight:bold;font-size:22px;}.panel-header .email{height:39px;line-height:36px;}.panel-header .email a{color:#00462B;font-weight:bold;font-size:22px;}.btn-hamburger{border:none;outline:none;background:transparent;float:left;}main.panel{background:#fff;}.slideout-panel{position:relative;z-index:2;}#page{padding-top:80px;}.top{position:fixed;top:0;left:0;width:100%;z-index:200;background:url(/templates/clear_j3/img/top.jpg) repeat-x left center;-webkit-box-shadow:0px 0px 5px 0px rgba(0, 0, 0, 0.75);-moz-box-shadow:0px 0px 5px 0px rgba(0, 0, 0, 0.75);box-shadow:0px 0px 5px 0px rgba(0, 0, 0, 0.75);height:64px;}.clear:after{content:'';display:table;clear:both;}.wrap{width:1000px;margin-right:auto;margin-left:auto;position:relative;}.top .logo{float:left;width:33.3333%;font-family:"Comic Sans MS", cursive;height:64px;line-height:64px;font-size:0;}.top .logo a{background: url(/templates/clear_j3/img/menutop.jpg) no-repeat center center;display:inline-block;vertical-align:middle;text-decoration:none;height:42px;line-height:42px;font-size:24px;color:#eed096;padding:0 20px;/*background:#633400;*/border:1px dotted #684721;box-shadow:inset 0px 0px 6px 3px #1e1002;-webkit-border-radius:5px;-moz-border-radius:5px;border-radius:5px;}.top .logo a:hover{color:#eed096;}.top .info{float:left;width:66.6666%;}.top .cols{width:50%;font-size:0;}.top .cols:nth-child(1){float:left;text-align:center;}.top .cols:nth-child(2){float:right;text-align:right;}.top .phone{height:32px;line-height:32px;}.top .phone a{color:#ff000f;font-weight:bold;font-size:22px;}.top .email{height:32px;line-height:32px;}.top .email a{color:#00462B;font-weight:bold;font-size:22px;}.top .order{height:32px;line-height:34px;}.top .order a{display:inline-block;vertical-align:middle;text-decoration:none;height:24px;line-height:24px;font-size:16px;color:#c2b499;padding:0 20px;background:#46331e;border:1px dotted #684721;box-shadow:inset 0px 0px 6px 3px #1e1002;-webkit-border-radius:3px;-moz-border-radius:3px;border-radius:3px;}.top .order a:hover{color:#a99876;}.top .call{height:32px;line-height:30px;}.top .call a{display:inline-block;vertical-align:middle;text-decoration:none;height:28px;line-height:24px;font-size:16px;color:#c2b499;background:#633400;border:1px dotted #684721;box-shadow:inset 0px 0px 6px 3px #1e1002;-webkit-border-radius:3px;-moz-border-radius:3px;border-radius:3px;width:162px;text-align:center;-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;}.menutop{text-align:center;font-size:0;}.menutop ul{background:url(/templates/clear_j3/img/menutop.jpg) no-repeat center center;height:68px;line-height:68px;margin:0 0 16px !important;-webkit-box-shadow:0px 5px 5px 0px rgba(0, 0, 0, 0.55);-moz-box-shadow:0px 5px 5px 0px rgba(0, 0, 0, 0.55);box-shadow:0px 5px 5px 0px rgba(0, 0, 0, 0.55);}.menutop li{display:inline-block;}.menutop li+li{margin-left:8px;}.menutop a{opacity: 1;font-size:15px !important;display:inline-block;vertical-align:middle;text-decoration:none;height:34px;line-height:34px;color:#46331e !important;padding:0 7px;background:url(/templates/clear_j3/img/top.jpg) repeat-x left center;border:1px dotted #684721;-webkit-border-radius:3px;-moz-border-radius:3px;border-radius:3px;text-decoration:none !important;}.menutop a:hover,.menutop .active a{color:#a99876 !important;-webkit-box-shadow:none;box-shadow:none;}#slider{margin-bottom:30px;}#slider .block-menu{float:right;width:280px;height:300px;padding:30px 10px 30px 30px;background:url(/templates/clear_j3/img/slidermenu.jpg) no-repeat center center;-webkit-background-size:cover;background-size:cover;-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;-webkit-box-shadow:2px 5px 5px 0px rgba(0, 0, 0, 0.55);-moz-box-shadow:2px 5px 5px 0px rgba(0, 0, 0, 0.55);box-shadow:2px 5px 5px 0px rgba(0, 0, 0, 0.55);}#slider .block-menu li+li{margin-top:8px;}#slider .block-menu a{font-size:13px;font-weight:bold;}#slider .block-menu li:last-child{list-style:none !important;margin-top:15px;}#slider .block-menu li:last-child a{padding:5px 15px;font-weight:bold;-webkit-box-shadow:none;box-shadow:none; text-shadow: 0 2px 1px #a33400; background: url(/templates/clear_j3/img/menutop.jpg) no-repeat center center; color: #eed096; text-shadow:0 2px 1px #a33400;border-radius:3px;}#slider .block-menu .active a{text-decoration:underline;}#slider .block-slider{float:left;width:700px;height:300px;-webkit-box-shadow:2px 5px 5px 0px rgba(0, 0, 0, 0.55);-moz-box-shadow:2px 5px 5px 0px rgba(0, 0, 0, 0.55);box-shadow:2px 5px 5px 0px rgba(0, 0, 0, 0.55);}
// @media (max-width: 767px) {.panel-header {display: block;}.wrap {width: auto;padding: 0 15px;}.top {display: none;}.menutop {display: none;}#slider {display: none;}.footerbg {width: auto;display: none;}#bottom .module .list .item {width: 100% !important;margin-right: 0 !important;margin-bottom: 30px;}.block-view {width: 100% !important;margin-right: 0 !important;margin-bottom: 30px;}.block-view+.block-view {margin-left: 0;}.main_images_wrapper tr {display: block;width: 100%;}.main_images_wrapper tr:after {clear: both;float: none;display: table;}.main_images_wrapper td {width: 50% !important;display: block;float: left;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;}.main_images_wrapper td:nth-child(2n) {float: right;}.item-page img {max-width: 100%;height: auto !important;}.item-page table {position: relative;}.item-page table td {position: relative;}.item-page .pinned table td,.item-page .scrollable table td{height: 55px !important;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;}.block-view {height: auto;padding: 15px;}.middle{ width:100% !important;}.addmenu{width: 100% !important;}}
//</style>
?> 

</head>

<body id="body">

<nav id="menu" class="menu">
<div class="cols">
<jdoc:include type="modules" name="info2" />
</div>
<jdoc:include type="modules" name="mainmenu" />
<jdoc:include type="modules" name="slider-menu" />
</nav>

<header class="panel-header fixed-header">
<button class="btn-hamburger js-slideout-toggle"><span class="c-hamburger"><span></span></span></button>
<a href="/" style="display: block; float: left; width: 50px; height: 50px; font-size: 50px; margin-left: 20px;">&#8962;</a>
<div class="info">
  <div class="phone"><a href="tel:+79264534722">+7 (926) 453-47-22</a></div>
  <div class="email"><a href="mailto:4534722@mail.ru">4534722@mail.ru</a></div>
<jdoc:include type="modules" name="info1" />
</div>
</header>
<div class="mobilemenudiv">
<jdoc:include type="modules" name="mainmenu" />
</div>
<main id="panel" class="panel">

<div id="page">
<div class="top">
<div class="wrap clear">
<div class="logo"><a href="<?php echo $this->baseurl ?>">doma-bitovki.ru</a>
<div class="logo_text">Производство<br />бытовок и блок-контейнеров</div>
</div>
<div class="info">
<div class="cols">
<jdoc:include type="modules" name="info1" />
</div>
<div class="cols">
<jdoc:include type="modules" name="info2" />
</div>
</div>
</div>
</div>

<?php if ($this->countModules('mainmenu')) { ?>
<div class="menutop">
<div class="wrap"><jdoc:include type="modules" name="mainmenu" /></div>
</div>
<?php } ?>

<div id="slider">
<div class="wrap clear">
<div class="block-slider">
<div class="jmslideshow">
<div class="jmslide-item" style="position: absolute; top: 0px; left: 0px; z-index: 99; opacity: 1;">
<a href="/"> <img title="/media/mod_jmslideshow/100x65_slide_002.jpg" class="jmslide-img" src="/media/mod_jmslideshow/700x300_fill_slide_002.jpg" style="width: 700px;"></a>
<div class="slideshow-content" style="width:500px; top:30px;left:30px">
<h3>Хорошее качество по доступным ценам!</h3>
</div>
</div>
</div>
</div>
<div class="block-menu">
<jdoc:include type="modules" name="slider-menu" />
</div>
</div>
</div>

<?php if ($this->countModules('top')) { ?>
<div id="top">
<div class="wrap">
<jdoc:include type="modules" name="top" style="rounded" />
</div>
</div>
<?php } 
$app = JFactory::getApplication();
$menu = $app->getMenu();?>

<div id="content">
<div class="wrap clear">
<div class="middle" style="<?

if ($menu->getActive() == $menu->getDefault()) {
?> width: 700px; display:inline-block;<? } ?>">
<?php if ($this->countModules('breadcrumb')) { ?>
<jdoc:include type="modules" name="breadcrumb" />
<?php } ?>
<? 
/*
if ($menu->getActive() == $menu->getDefault()) {
?>

<div class="addmenu onlymobile" style=" <?php /*   float: right;
    width: 280px;
    padding: 30px 10px 30px 30px;
    background: url(/templates/clear_j3/img/slidermenu.jpg) no-repeat center center;
    -webkit-background-size: cover;
    background-size: cover;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
    -webkit-box-shadow: 2px 5px 5px 0px rgba(0, 0, 0, 0.55);
    -moz-box-shadow: 2px 5px 5px 0px rgba(0, 0, 0, 0.55);
    box-shadow: 2px 5px 5px 0px rgba(0, 0, 0, 0.55);*//*?>">
<jdoc:include type="modules" name="seo-pages-menu" />
</div>
<? }*/ ?>
<jdoc:include type="message" />
<jdoc:include type="component" />

<script type="text/javascript">(function() {
  if (window.pluso)if (typeof window.pluso.start == "function") return;
  if (window.ifpluso==undefined) { window.ifpluso = 1;
    var d = document, s = d.createElement('script'), g = 'getElementsByTagName';
    s.type = 'text/javascript'; s.charset='UTF-8'; s.async = true;
    s.src = ('https:' == window.location.protocol ? 'https' : 'http')  + '://share.pluso.ru/pluso-like.js';
    var h=d[g]('body')[0];
    h.appendChild(s);
  }})();</script>
<div class="pluso" data-background="#ebebeb" data-options="medium,square,line,horizontal,counter,theme=04" data-services="vkontakte,facebook,google,print"></div>

</div>
<?
if ($menu->getActive() == $menu->getDefault()) {
?>
<div class="right-block">
  <div class="addmenu news-block">
    <jdoc:include type="modules" name="news-block" />
  </div>
   <div class="addmenu call-block">
    <jdoc:include type="modules" name="promotions-block" />
  </div>
  <div class="addmenu call-block">
    <jdoc:include type="modules" name="call-block" />
  </div>
  
  <div class="addmenu" style="   <?php /*  float: right;
      width: 280px;
      padding: 30px 10px 30px 30px;
      background: url(/templates/clear_j3/img/slidermenu.jpg) no-repeat center center;
      -webkit-background-size: cover;
      background-size: cover;
      -webkit-box-sizing: border-box;
      -moz-box-sizing: border-box;
      box-sizing: border-box;
      -webkit-box-shadow: 2px 5px 5px 0px rgba(0, 0, 0, 0.55);
      -moz-box-shadow: 2px 5px 5px 0px rgba(0, 0, 0, 0.55);
      box-shadow: 2px 5px 5px 0px rgba(0, 0, 0, 0.55);*/?>">
  <jdoc:include type="modules" name="seo-pages-menu" />
  </div>
</div>
<? } ?>
</div>
</div>

<?php if ($this->countModules('bottom')) { ?>
<div id="bottom">
<div class="wrap">
<jdoc:include type="modules" name="bottom" style="rounded" />
</div>
</div>
<?php } ?>
</div>

<div class="footerbg">
<div class="footerinner">
<?php if ($this->countModules('bottom-menu')) { ?>
<div class="bottom-menu">
<jdoc:include type="modules" name="bottom-menu" style="rounded" />
</div>
<?php } ?>

<div class="footer-center">
<div class="footer-left"><jdoc:include type="modules" name="footer-left" style="rounded" /></div>
<div class="footer-right"><jdoc:include type="modules" name="footer-right" style="rounded" /></div>
</div>

<?php if ($this->countModules('footer')) { ?>
<div class="footer">
<?php if (!isset($_SERVER['HTTP_USER_AGENT']) || stripos($_SERVER['HTTP_USER_AGENT'], 'Speed Insights') === false): ?>
<jdoc:include type="modules" name="footer" style="rounded" />
<?php endif; ?>
</div>
<?php } ?>
</div>
</div>
</main>

<div id="scrollup"><a href="#body">&#9650;</a></div>
</body>
	<script src="/templates/clear_j3/js/swfobject.js" type="text/javascript"></script>
	<script src="/templates/clear_j3/js/jquery.slicknav.min.js" type="text/javascript"></script>
	<script src="/templates/clear_j3/js/calc.js" type="text/javascript"></script>
	<script src="/templates/clear_j3/js/scripts.js" type="text/javascript"></script>
	<script src="/templates/clear_j3/js/slideout.js" type="text/javascript"></script>
<script>

var slideout = new Slideout({
'panel': document.getElementById('panel'),
'menu': document.getElementById('menu'),
'touch': false
});
document.querySelector('button').addEventListener('click', function() {
slideout.toggle();
});

var fixed = document.querySelector('.fixed-header');

slideout.on('translate', function(translated) {
fixed.style.transform = 'translateX(' + translated + 'px)';
});

slideout.on('beforeopen', function() {
fixed.style.transition = 'transform 300ms ease';
fixed.style.transform = 'translateX(256px)';
});

slideout.on('beforeclose', function() {
fixed.style.transition = 'transform 300ms ease';
fixed.style.transform = 'translateX(0px)';
});

slideout.on('open', function() {
fixed.style.transition = '';
});

slideout.on('close', function() {
fixed.style.transition = '';
});
</script>
<script src="<?php echo JUri::base() . 'templates/' . $doc->template . '/js/responsive-tables.js'; ?>"></script>
<style>
  @media (max-width: 767px) {
    .block-view+.block-view {
        margin-left: 0px !important;
    }
}
</style>
 
</html>