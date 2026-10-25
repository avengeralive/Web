<!DOCTYPE html>
<!--[if IE]><![endif]-->
<!--[if IE 8 ]>
<html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>" class="ie8"><![endif]-->
<!--[if IE 9 ]>
<html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>" class="ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>">
<!--<![endif]-->
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $title;
    if (isset($_GET['page'])) {
      echo " - " . ((int)$_GET['page']) . " " . $text_page;
    } ?></title>
  <?php if (false) { ?>
    <base href="<?php echo $base; ?>"/>
  <?php } else {
    ?>
    <base href="/"/>
    <?php
  } ?>
  <?php if ($description) { ?>
    <meta name="description" content="<?php echo $description;
    if (isset($_GET['page'])) {
      echo " - " . ((int)$_GET['page']) . " " . $text_page;
    } ?>"/>
  <?php } ?>
  <?php if ($keywords) { ?>
    <meta name="keywords" content="<?php echo $keywords; ?>"/>
  <?php } ?>
  <meta property="og:title" content="<?php echo $title;
  if (isset($_GET['page'])) {
    echo " - " . ((int)$_GET['page']) . " " . $text_page;
  } ?>"/>
  <meta property="og:type" content="website"/>
  <meta property="og:url" content="<?php echo $og_url; ?>"/>
  <?php if ($og_image) { ?>
    <meta property="og:image" content="<?php echo $og_image; ?>"/>
  <?php } else { ?>
    <meta property="og:image" content="<?php echo $logo; ?>"/>
  <?php } ?>
  <meta property="og:site_name" content="<?php echo $name; ?>"/>

  <!-- CSS -->
  <link href="https://fonts.googleapis.com/css?family=PT+Sans:400,400i,700,700i&amp;subset=cyrillic" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i&amp;subset=cyrillic"
        rel="stylesheet"/>
  <link href="catalog/view/javascript/bootstrap/css/bootstrap.css" rel="stylesheet" media="screen"/>
  <link href="catalog/view/javascript/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
  <link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/stylesheet.css">
  <link rel="stylesheet" type="text/css" href="catalog/view/javascript/jquery/colorbox/colorbox.css"/>
  <link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/coolfilter.css">
  <link rel="stylesheet" type="text/css"
        href="catalog/view/javascript/jquery/ui/themes/ui-lightness/jquery-ui-1.8.16.custom.css"/>
  <link rel="stylesheet" type="text/css" href="catalog/view/javascript/jquery/jquery.bxslider.css">
  <link rel="stylesheet" type="text/css" href="catalog/view/javascript/jquery/magnific/magnific-popup.css">
  <link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/geoip.css">
  <link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/subscribe.css">
  <!-- /CSS -->

  <!-- FCSS -->
  <?php foreach ($styles as $style) { ?>
    <link href="<?php echo $style['href']; ?>" type="text/css" rel="<?php echo $style['rel']; ?>"
          media="<?php echo $style['media']; ?>"/>
  <?php } ?>
  <!-- /FCSS -->

  <!-- FLINKS -->
  <?php foreach ($links as $link) { ?>
    <link href="<?php echo $link['href']; ?>" rel="<?php echo $link['rel']; ?>"/>
  <?php } ?>
  <!-- /FLINKS -->

  <!-- JS -->
  <script src="catalog/view/javascript/jquery/jquery-2.1.1.min.js"></script>
  <script src="catalog/view/javascript/jquery/jquery-migrate-1.2.1.min.js"></script>
  <script src="catalog/view/javascript/jquery/jquery.bxslider.min.js"></script>
  <script src="catalog/view/javascript/jquery/jquery.total-storage.min.js"></script>
  <script src="catalog/view/javascript/jquery/jquery.geoip-module.js"></script>
  <script src="catalog/view/javascript/jquery/ui/jquery-ui.js"></script>
  <script src="catalog/view/javascript/jquery/colorbox/jquery.colorbox.js"></script>
  <script src="catalog/view/javascript/jquery/magnific/jquery.magnific-popup.min.js"></script>
  <script src="catalog/view/javascript/bootstrap/js/bootstrap.min.js"></script>
  <script src="catalog/view/javascript/jquery.cookies.js"></script>
  <script src="catalog/view/javascript/common.js"></script>
  <script src="catalog/view/javascript/subscribe.js"></script>
  <!-- /JS -->

  <!-- FJS -->
  <?php foreach ($scripts as $script) { ?>
    <script src="<?php echo $script; ?>" type="text/javascript"></script>
  <?php } ?>
  <!-- /FJS -->

  <?php if (isset($stores)) { ?>
    <script type="text/javascript"><!--
      $(document).ready(function () {
        <?php foreach ($stores as $store) { ?>
        $('body').prepend('<iframe src="<?php echo $store; ?>" style="display: none;"></iframe>');
        <?php } ?>
      });
      //--></script>
  <?php } ?>
  <?php //echo $google_analytics; ?>
    <!-- Facebook Pixel Code --> <script> !function(f,b,e,v,n,t,s) {if(f.fbq)return;n=f.fbq=function(){n.callMethod? n.callMethod.apply(n,arguments):n.queue.push(arguments)}; if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0'; n.queue=[];t=b.createElement(e);t.async=!0; t.src=v;s=b.getElementsByTagName(e)[0]; s.parentNode.insertBefore(t,s)}(window, document,'script', 'https://connect.facebook.net/en_US/fbevents.js'); fbq('init', '1951928501787965'); fbq('track', 'PageView'); </script> <noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=1951928501787965&ev=PageView&noscript=1" /></noscript> <!-- End Facebook Pixel Code -->
    <script type="text/javascript">(window.Image ? (new Image()) : document.createElement('img')).src = 'https://vk.com/rtrg?p=VK-RTRG-235900-cW2pk';</script>
</head>

  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-116154442-1"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'UA-116154442-1');
  </script>

<body class="<?php echo $class; ?>">
  <script src="//script.marquiz.ru/v1.js" type="application/javascript"></script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<link href="https://fonts.googleapis.com/css?family=Oswald:400,700" rel="stylesheet">
<script>
document.addEventListener("DOMContentLoaded", function() {
Marquiz.init({ id: '5b2a15fc4f07ad00427ac891' });
});
$(function(){
  setTimeout(function() {
    $(".marquiz__container__holder").css('display', 'flex');;
    $(".marquiz__container").show();
  }, 30000);
  $(".marquiz__button").on('click', function(){
    $(".marquiz__container__holder").css('display', 'none');;
    $(".marquiz__container").hide();
  });
});
</script>
<!-- Marquiz script end -->

<div class="marquiz__container__holder">
<div class="marquiz__container">
  <div style="width: 50%;">
  <h3 style="color: #00a2e6; text-align: right; text-transform: uppercase; font-family: 'Oswald', sans-serif; font-size: 18px;">Пройдите тест и<br>выберете ваш корпоративный<br>подарок</h3>
<a class="marquiz__button marquiz__button_blicked marquiz__button_rounded
marquiz__button_shadow" href="#popup:marquiz_5b2a15fc4f07ad00427ac891" data-fixed-side=""
data-alpha-color="rgba(61, 59, 238, 0.5)" data-color="#3d3bee" data-text-color="#ffffff">Выбрать корпоративный подарок</a>
  </div>
</div>
</div>

<style>
  .marquiz__container__holder {
    position: absolute;
      width: 100%;
      height: 100vh;
      display: flex;
      background: rgba(0,0,0,.8);
      top: 0;
      left: 0;
      justify-content: center;
      flex-direction: column;
      display: none;
      z-index: 1000;
  }
  .marquiz__container {
    background: url('./bg.png');
    background-size: cover;
      width: 640px;
      height: 450px;
      margin: 0 auto;
      padding: 150px 50px;
      box-shadow: 2px 2px 2px #000;
      display: none;
  }
  .marquiz__button {
      color: #00a2e6 !important;
      background: none !important;
      border: 3px solid #00a2e6 !important;
      font-size: 11px !important;
      border-radius: 0px !important;
      box-shadow: 0 0 1px 2px #00a2e6 !important;
      text-transform: uppercase !important;
      padding: 15px !important;
      float: right;
  }
  .marquiz__button:hover {
      color: #00a2e6 !important;
  }
</style>
<div class="minicartfixed closeee">
  <div class="wrapminicartfixed"><a id="openminicart" onclick="openclosemini()">На расчет</a>
    <?php echo $minicart; ?>
  </div>
</div>
<!-- Roistat -->
<script>
  (function (w, d, s, h, id) {
    w.roistatProjectId = id;
    w.roistatHost = h;
    var p = d.location.protocol == "https:" ? "https://" : "http://";
    var u = /^.*roistat_visit=[^;]+(.*)?$/.test(d.cookie) ? "/dist/module.js" : "/api/site/1.0/" + id + "/init";
    var js = d.createElement(s);
    js.async = 1;
    js.src = p + h + u;
    var js2 = d.getElementsByTagName(s)[0];
    js2.parentNode.insertBefore(js, js2);
  })(window, document, 'script', 'cloud.roistat.com', '37a636f32e9a3cdb0af2513ffdd0c44d');
</script>
<!-- /Roistat -->
<!-- Yandex.Metrika counter -->
<script>
  (function (d, w, c) {
    (w[c] = w[c] || []).push(function () {
      try {
        w.yaCounter45065366 = new Ya.Metrika({
          id: 45065366,
          clickmap: true,
          trackLinks: true,
          accurateTrackBounce: true,
          webvisor: true
        });
      } catch (e) {
      }
    });

    var n = d.getElementsByTagName("script")[0],
      s = d.createElement("script"),
      f = function () {
        n.parentNode.insertBefore(s, n);
      };
    s.type = "text/javascript";
    s.async = true;
    s.src = "https://mc.yandex.ru/metrika/watch.js";

    if (w.opera == "[object Opera]") {
      d.addEventListener("DOMContentLoaded", f, false);
    } else {
      f();
    }
  })(document, window, "yandex_metrika_callbacks");
</script>
<noscript>
  <div><img src="https://mc.yandex.ru/watch/45065366" style="position:absolute; left:-9999px;" alt="яндекс"/></div>
</noscript>
<!-- /Yandex.Metrika counter -->
<script>
    (function(w, d, u, i, o, s, p) {
        if (d.getElementById(i)) { return; } w['MangoObject'] = o; 
        w[o] = w[o] || function() { (w[o].q = w[o].q || []).push(arguments) }; w[o].u = u; w[o].t = 1 * new Date();
        s = d.createElement('script'); s.async = 1; s.id = i; s.src = u;
        p = d.getElementsByTagName('script')[0]; p.parentNode.insertBefore(s, p);
    }(window, document, '//widgets.mango-office.ru/widgets/mango.js', 'mango-js', 'mgo'));
    mgo({calltracking: {id: 12812, elements: [{"selector":".mgo-number-12812"}]}});
</script>
<!-- BEGIN JIVOSITE CODE {literal} -->
<script>
  (function () {
    var widget_id = 'czYds6g6Fk';
    var d = document;
    var w = window;

    function l() {
      var s = document.createElement('script');
      s.type = 'text/javascript';
      s.async = true;
      s.src = '//code.jivosite.com/script/widget/' + widget_id;
      var ss = document.getElementsByTagName('script')[0];
      ss.parentNode.insertBefore(s, ss);
    }

    if (d.readyState == 'complete') {
      l();
    } else {
      if (w.attachEvent) {
        w.attachEvent('onload', l);
      } else {
        w.addEventListener('load', l, false);
      }
    }
  })();</script>
<!-- {/literal} END JIVOSITE CODE -->
<!-- BEGIN JIVOSITE INTEGRATION WITH ROISTAT -->
<script>
  (function (w, d, s, h) {
    var p = d.location.protocol == "https:" ? "https://" : "http://";
    var u = "/static/marketplace/JivoSite/script.js";
    var js = d.createElement(s);
    js.async = 1;
    js.src = p + h + u;
    var js2 = d.getElementsByTagName(s)[0];
    js2.parentNode.insertBefore(js, js2);
  })(window, document, 'script', 'cloud.roistat.com');
</script>
<!-- END JIVOSITE INTEGRATION WITH ROISTAT -->
<script> (function(w, d, u, i, o, s, p) { if (d.getElementById(i)) { return; } w['MangoObject'] = o; w[o] = w[o] || function() { (w[o].q = w[o].q || []).push(arguments) }; w[o].u = u; w[o].t = 1 * new Date(); s = d.createElement('script'); s.async = 1; s.id = i; s.src = u; p = d.getElementsByTagName('script')[0]; p.parentNode.insertBefore(s, p); }(window, document, '//widgets.mango-office.ru/widgets/mango.js', 'mango-js', 'mgo')); mgo({calltracking: {id: 12529, elements: [{"selector":".mgo-number-12529"}]}}); </script>
<div style="display:none;"><?php // echo $geoip; ?></div>

<div class="container-fluid hidden-sm hidden-xs" style="padding: 0 !important;display: none;">
  <ul class="bxslider">
    <li><a href="/cases">
        <div
          style="background: url('catalog/view/theme/default/image/banners/case.png') center top no-repeat;height:200px;width:100%;"></div>
      </a></li>
    <li><a href="/futbolki/futbolki-polo">
        <div
          style="background: url('catalog/view/theme/default/image/banners/polo.png') center top no-repeat;height:200px;width:100%;"></div>
      </a></li>
    <li><a href="/elektronika/elektronika-zaryadniki">
        <div
          style="background: url('catalog/view/theme/default/image/banners/power-bank.png') center top no-repeat;height:200px;width:100%;"></div>
      </a></li>
  </ul>
</div>
<script>
  $('.bxslider').bxSlider({
    touchEnabled: false,
    auto: true,
    mode: 'fade',
  });
</script>
<div class="container-fluid wrapheader">
  <div class="row">
    <div class="container toplink">
      <div class="row hidden">
        <div class="col-lg-100 col-md-50 col-sm-50 col-xs-100 help">
          <div class='text-center'>
		   <a href="/order">Как заказать</a>
           <a href="/pay">Как оплатить</a>
           <a href="/supply">Условия поставок</a>
           <a href="/tecnical">Технические требования</a>
           <a href="/delivery">Доставка продукции</a>
           <a href="/how-search">Как работает поиск</a>
           <a href="/faq">Вопрос - ответ</a>
           <a class="compare-link" href="index.php?route=product/compare">Сравнить товары</a>
		  </div>
		</div>
        
		<!--<div class="col-lg-12 col-md-25 col-sm-50 col-xs-50"
             style="padding-top: 5px; padding-bottom: 5px; text-align: right; font-size: 14px;">
            <a class="mgo-number-12529" href="tel:+78124261978" style="font-size: 14px;">8 (812) 426-19-78</a>
          <!--<a href="mailto:<?php //echo $this->config->get("config_email");?>"  style="font-size:14px;"><?php //echo $this->config->get("config_email");?></a></span>-->
        <!--</div> -->
      </div>
    </div>
    <div class="container-fluid header-middle">
      <div class="container">
        <div class="col-lg-24 col-sm-22 col-md-22 col-xs-100 text-center" id="logo">
          <div class="row">
            <?php if ($logo) { ?>
              <a href="<?php echo $home; ?>"><img src="<?php echo $logo; ?>" title="<?php echo $name; ?>"
                                                  alt="<?php echo $name; ?>"/></a>
            <?php } ?>
          </div>
        </div>
        <div class="col-lg-56 col-sm-50 col-md-60 col-xs-100">
          <div class="row">
		   <div class='col-lg-35 col-xs-100'>
		    <div class='col-lg-100 col-xs-100 phone-link text-center mgo-number-12529'>8(812) 426-19-78</div>
			<div class='col-lg-100 col-xs-100 phone-link text-center mgo-number-12812'>8(495) 150-29-78</div>
		   </div>
		   <div class='col-lg-65 col-xs-100'>
		    <div class='col-lg-100 address-link text-left'>
			<a href='https://yandex.ru/maps/2/saint-petersburg/?ll=30.331382%2C59.975590&z=16&mode=search&ol=geo&ouri=ymapsbm1%3A%2F%2Fgeo%3Fll%3D30.331%252C59.976%26spn%3D0.001%252C0.001%26text%3D%25D0%25A0%25D0%25BE%25D1%2581%25D1%2581%25D0%25B8%25D1%258F%252C%2520%25D0%25A1%25D0%25B0%25D0%25BD%25D0%25BA%25D1%2582-%25D0%259F%25D0%25B5%25D1%2582%25D0%25B5%25D1%2580%25D0%25B1%25D1%2583%25D1%2580%25D0%25B3%252C%2520%25D0%2591%25D0%25BE%25D0%25BB%25D1%258C%25D1%2588%25D0%25BE%25D0%25B9%2520%25D0%25A1%25D0%25B0%25D0%25BC%25D0%25BF%25D1%2581%25D0%25BE%25D0%25BD%25D0%25B8%25D0%25B5%25D0%25B2%25D1%2581%25D0%25BA%25D0%25B8%25D0%25B9%2520%25D0%25BF%25D1%2580%25D0%25BE%25D1%2581%25D0%25BF%25D0%25B5%25D0%25BA%25D1%2582%252C%252064%25D0%2595%2520' target='_blank'>г. Санкт-Петербург, Выборгская набережная, 49</a></div>
			<div class='col-lg-100 email-link text-left'>info@tkgifts.ru</div>
		   </div>
		  </div>
		  
		  <!--<div class="row">
            <div class="search-wrap">
              <input type="text" name="search" placeholder="<?php //echo $text_search; ?>"
                     value="<?php //echo $search; ?>" class="s-s"/>
              <input type="text" name="quantity" placeholder="остаток" value="" class="q-s"/>
              <input type="text" name="min" placeholder="цена от" value="" class="min-s"/>
              <input type="text" name="max" placeholder="цена до" value="" class="max-s"/>
              <div class="button-search"></div>
            </div>
            <div id="wrapautosearch" class="">
              <div class="autosearch">
              </div>
            </div>
          </div>-->
        </div>
        <div class="col-lg-20 col-sm-28 col-md-18 col-xs-16 text-center" id="cart-mod">
          <?php echo $cart; ?>
        </div>
      </div>
    </div>
    <div class="container-fluid header-menu">
      <div class="container">
        <div class="row">
          <ul>
            <li><a href="/">ГЛАВНАЯ</a></li>
            <li><a id='catalog' href="/catalog">КАТАЛОГ</a></li>
            <li><a id='nazakaz' href="/na-zakaz">НА ЗАКАЗ</a></li>
            <li><a id='portfolio' href="/portfolio">ПОРТФОЛИО</a></li>
			<li><a id='company' href="/company">О КОМПАНИИ</a></li>
          </ul>
        </div>
      </div>
    </div>

    <?php
    if ($_SERVER['REQUEST_URI'] == "/" or strripos($_SERVER['REQUEST_URI'], "common/home")) {?>
	
	<div class='container'><div class="row vsearch">
		<div class='col-sm-100'>
		<div style='margin:0 auto;width: 75%;margin-top: 30px'>
		<div class="col-sm-85 col-xs-100">
          <input type="text" name="search" value="" placeholder="Ключевые слова" id="input-search" class="form-control">
        </div>
		<div class="col-sm-15 vbutton col-xs-100" style='margin-left:-20px'>
		  <input type="button" value="Поиск" id="button-search" onclick='location.href="index.php?route=product/search&search="+$("#input-search").val()' class="btn btn-primary">
        </div>
		</div>
	</div>	
	</div>	
	<br><br>	
</div>
<script language='javascript'>
 $('#input-search').on('keypress', function(e){
  if(e.which == 13){
   $('#button-search').trigger('click');
  }
 });
</script>

	
	
    <?  echo '<div class="container-fluid header-bottom">
	<div class="container">
		<div class="row">
			<ul>
				<li>
					<a class="header-bottom-item" href="/cases" >
						<img class="header-bottom-item-card-img" src="/image/data/header-bottom/covers_for_phones.jpg" alt="Alt">
						<div class="header-bottom-item-content">
							<img class="header-bottom-item-text-img" src="/image/data/new.png" alt="icon"/>
							<span>Чехлы для смартфонов</span>
						</div>

					</a>
				</li>
				<li>
					<a class="header-bottom-item" href="http://www.t-k.bz/map" target="_blank">
						<img class="header-bottom-item-card-img" src="/image/data/header-bottom/scratch_card.jpg" alt="Alt">
						<div class="header-bottom-item-content">
							<img class="header-bottom-item-text-img" src="/image/data/balls.png" alt="icon"/>
							<span>Скретч-карта мира</span>
						</div>
					</a>
				</li>
				<li>
					<a class="header-bottom-item" href="http://shirtcase.ru" target="_blank">
						<img class="header-bottom-item-card-img" src="/image/data/header-bottom/covers_for_shirts.jpg" alt="Alt">
						<div class="header-bottom-item-content">
							<img class="header-bottom-item-text-img" src="/image/data/cubok.png" alt="icon"/>
							<span>Чехол для рубашки</span>
						</div>
					</a>
				</li>
			</ul>
		</div>
	</div>
</div>';
    }
    ?>
  </div>
</div>
<div id="container" class="container">