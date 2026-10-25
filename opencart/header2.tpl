<!DOCTYPE html>
<!--[if IE]><![endif]-->
<!--[if IE 8 ]><html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>" class="ie8"><![endif]-->
<!--[if IE 9 ]><html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>" class="ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>">
<!--<![endif]-->
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title><?php echo $title; if (isset($_GET['page'])) { echo " - ". ((int) $_GET['page'])." ".$text_page;} ?></title>
<base href="<?php echo $base; ?>" />
<?php if ($description) { ?>
<meta name="description" content="<?php echo $description; if (isset($_GET['page'])) { echo " - ". ((int) $_GET['page'])." ".$text_page;} ?>" />
<?php } ?>
<?php if ($keywords) { ?>
<meta name="keywords" content= "<?php echo $keywords; ?>" />
<?php } ?>
<meta property="og:title" content="<?php echo $title; if (isset($_GET['page'])) { echo " - ". ((int) $_GET['page'])." ".$text_page;} ?>" />
<meta property="og:type" content="website" />
<meta property="og:url" content="<?php echo $og_url; ?>" />
<?php if ($og_image) { ?>
<meta property="og:image" content="<?php echo $og_image; ?>" />
<?php } else { ?>
<meta property="og:image" content="<?php echo $logo; ?>" />
<?php } ?>
<meta property="og:site_name" content="<?php echo $name; ?>" />

<!-- CSS -->
<link href="https://fonts.googleapis.com/css?family=PT+Sans:400,400i,700,700i&amp;subset=cyrillic" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i&amp;subset=cyrillic" rel="stylesheet"/>
<link href="catalog/view/javascript/bootstrap/css/bootstrap.css" rel="stylesheet" media="screen" />
<link href="catalog/view/javascript/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/stylesheet.css">
<link rel="stylesheet" type="text/css" href="catalog/view/javascript/jquery/colorbox/colorbox.css" />
<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/coolfilter.css">
<link rel="stylesheet" type="text/css" href="catalog/view/javascript/jquery/ui/themes/ui-lightness/jquery-ui-1.8.16.custom.css" />
<link rel="stylesheet" type="text/css" href="catalog/view/javascript/jquery/jquery.bxslider.css">
<link rel="stylesheet" type="text/css" href="catalog/view/javascript/jquery/magnific/magnific-popup.css">
<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/geoip.css">
<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/subscribe.css">
<!-- /CSS -->

<!-- FCSS -->
<?php foreach ($styles as $style) { ?>
<link href="<?php echo $style['href']; ?>" type="text/css" rel="<?php echo $style['rel']; ?>" media="<?php echo $style['media']; ?>" />
<?php } ?>
<!-- /FCSS -->

<!-- FLINKS -->
<?php foreach ($links as $link) { ?>
<link href="<?php echo $link['href']; ?>" rel="<?php echo $link['rel']; ?>" />
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
$(document).ready(function() {
<?php foreach ($stores as $store) { ?>
$('body').prepend('<iframe src="<?php echo $store; ?>" style="display: none;"></iframe>');
<?php } ?>
});
//--></script>
<?php } ?>
<?php //echo $google_analytics; ?>
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
<div class="minicartfixed closeee">
	<div class="wrapminicartfixed"><a id="openminicart" onclick="openclosemini()">На расчет</a>
	<?php echo $minicart;?>
	</div>
</div>
<!-- Roistat -->
<script>
(function(w, d, s, h, id) {
    w.roistatProjectId = id; w.roistatHost = h;
    var p = d.location.protocol == "https:" ? "https://" : "http://";
    var u = /^.*roistat_visit=[^;]+(.*)?$/.test(d.cookie) ? "/dist/module.js" : "/api/site/1.0/"+id+"/init";
    var js = d.createElement(s); js.async = 1; js.src = p+h+u; var js2 = d.getElementsByTagName(s)[0]; js2.parentNode.insertBefore(js, js2);
})(window, document, 'script', 'cloud.roistat.com', '37a636f32e9a3cdb0af2513ffdd0c44d');
</script>
<!-- /Roistat -->
<!-- Yandex.Metrika counter -->
<script>
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter45065366 = new Ya.Metrika({
                    id:45065366,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true,
                    webvisor:true
                });
            } catch(e) { }
        });
 
        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src = "https://mc.yandex.ru/metrika/watch.js";
 
        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/45065366" style="position:absolute; left:-9999px;" alt="яндекс" /></div></noscript>
<!-- /Yandex.Metrika counter -->
<!-- BEGIN JIVOSITE CODE {literal} -->
<script>
(function(){ var widget_id = 'czYds6g6Fk';var d=document;var w=window;function l(){
var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = '//code.jivosite.com/script/widget/'+widget_id; var ss = document.getElementsByTagName('script')[0]; ss.parentNode.insertBefore(s, ss);}if(d.readyState=='complete'){l();}else{if(w.attachEvent){w.attachEvent('onload',l);}else{w.addEventListener('load',l,false);}}})();</script>
<!-- {/literal} END JIVOSITE CODE -->
<!-- BEGIN JIVOSITE INTEGRATION WITH ROISTAT -->
<script>
(function(w, d, s, h) {
    var p = d.location.protocol == "https:" ? "https://" : "http://";
    var u = "/static/marketplace/JivoSite/script.js";
    var js = d.createElement(s); js.async = 1; js.src = p+h+u; var js2 = d.getElementsByTagName(s)[0]; js2.parentNode.insertBefore(js, js2);
    })(window, document, 'script', 'cloud.roistat.com');
</script>
<!-- END JIVOSITE INTEGRATION WITH ROISTAT -->
<div style="display:none;"><?php // echo $geoip; ?></div>

<div class="container-fluid hidden-sm hidden-xs" style="padding: 0 !important;">
	<ul class="bxslider">
	  <li><a href="http://www.t-k.bz/"><div style="background: url('catalog/view/theme/default/image/banners/case.png') center top no-repeat;height:200px;width:100%;"></div></a></li>
	  <li><a href="/futbolki/futbolki-polo"><div style="background: url('catalog/view/theme/default/image/banners/polo.png') center top no-repeat;height:200px;width:100%;"></div></a></li>
	  <li><a href="/elektronika/elektronika-zaryadniki"><div style="background: url('catalog/view/theme/default/image/banners/power-bank.png') center top no-repeat;height:200px;width:100%;"></div></a></li>
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
			<div class="row">
				<div class="col-lg-74 col-md-50 col-sm-50 col-xs-100 help">
					<a href="/order">Как заказать</a>
					<a href="/pay">Как оплатить</a>
					<a href="/supply">Условия поставок</a>
					<a href="/tecnical">Технические требования</a>
					<a href="/delivery">Доставка продукции</a>
					<a href="/how-search">Как работает поиск</a>
					<a href="/faq">Вопрос - ответ</a>
				</div>
				<div class="col-lg-14 col-md-25 col-sm-50 col-xs-50 compare-link">
					<a href="index.php?route=product/compare">Сравнить товары</a>
				</div>
				<div class="col-lg-12 col-md-25 col-sm-50 col-xs-50" style="padding-top: 5px; padding-bottom: 5px; text-align: right; font-size: 14px;">
					<a href="tel:88124261978<?php //echo $this->config->get("config_telephone");?>" style="font-size:14px;" id="<?php echo "ipgeo";//echo $geoip; ?>">8 (812) 426-19-78<?php //echo $this->config->get("config_telephone");?></a>
					<!--<a href="mailto:<?php //echo $this->config->get("config_email");?>"  style="font-size:14px;"><?php //echo $this->config->get("config_email");?></a></span>-->
				</div>
			</div>
		</div>
		<div class="container-fluid header-middle">
			<div class="container">
				<div class="col-lg-22 col-sm-22 col-md-22 col-xs-100" id="logo">
					<div class="row">
						<?php if ($logo) { ?>
							<a href="<?php echo $home; ?>"><img src="<?php echo $logo; ?>" title="<?php echo $name; ?>" alt="<?php echo $name; ?>" /></a>
						<?php } ?>
					</div>
				</div>
					<div class="col-lg-62 col-sm-50 col-md-60 col-xs-100" id="search">
						<div class="row">
							<div class="search-wrap">
								<input type="text" name="search" placeholder="<?php //echo $text_search; ?>" value="<?php //echo $search; ?>" class="s-s"/>
								<input type="text" name="quantity" placeholder="остаток" value="" class="q-s"/>
								<input type="text" name="min" placeholder="цена от" value="" class="min-s"/>
								<input type="text" name="max" placeholder="цена до" value="" class="max-s"/>
								<div class="button-search"></div>					
							</div>
							<div id="wrapautosearch" class="">
								<div class="autosearch">
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-16 col-sm-28 col-md-18 col-xs-16" id="cart-mod">
						<?php echo $cart; ?>
					</div>
			</div>
		</div>
		<div class="container-fluid header-menu">
			<div class="container">
				<div class="row">
					<ul>
						<li><a href="/company">О КОМПАНИИ</a></li>
						<li id="catalog-link-m"><a href="https://tkgifts.ru/<?php /*http://true-profit.ru/index.php?route=product/category&path=0*/?>" id="cat-link-menu">В НАЛИЧИИ</a>
							<?php if ($categories) { ?>
								<div class="popup-catalog" style="top: 200px;">
									<ul>
										<?php foreach ($categories as $category) { ?>
											<li>
												<div>
													<span class="main-category">
														<a href="<?php echo $category['href']; ?>"><img src="<?php echo $category['image']; ?>" alt="<?php echo $category['name']; ?>"/><?php echo $category['name']; ?></a>
													</span>
													<?php if ($category['children']) { ?>
														<?php foreach ($category['children'] as $child) { ?>
															<span>
																<a href="<?php echo $child['href']; ?>"><?php echo $child['name']; ?></a>
															</span>
														<?php } ?>
													<?php } ?>
												</div>
											</li>
										<?php } ?>
									</ul>
									<div class="exit-btn" onclick="$('body').css('overflow', 'auto');$('#catalog-link-m').removeClass('open');"></div>
								</div>
							<?php } ?>
						</li>
						<li><a href="/discounts">СКИДКИ</a></li>
						<li><a href="/portfolio">ПОРТФОЛИО</a></li>
						<li><a href="/contacts">КОНТАКТЫ</a></li>
					</ul>
				</div>
			</div>
		</div>

		<?php 
		if ($_SERVER['REQUEST_URI'] == "/" or strripos($_SERVER['REQUEST_URI'], "common/home")){
			echo '<div class="container-fluid header-bottom">
	<div class="container">
		<div class="row">
			<ul>
				<li>
					<a class="header-bottom-item" href="http://www.t-k.bz" target="_blank">
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