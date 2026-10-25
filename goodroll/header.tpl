<!DOCTYPE html>
<html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo $title; if (isset($_GET['page'])) { echo " - ". ((int) $_GET['page'])." ".$text_page;} ?></title>
<base href="<?php echo $base; ?>" />
<?php if ($description) { ?>
<meta name="description" content="<?php echo $description; if (isset($_GET['page'])) { echo " - ". ((int) $_GET['page'])." ".$text_page;} ?>" />
<?php } ?>
<?php if ($keywords) { ?>
<meta name="keywords" content="<?php echo $keywords; ?>" />
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
<?php if ($icon) { ?>
<link href="<?php echo $icon; ?>" rel="icon" />
<?php } ?>
<?php foreach ($links as $link) { ?>
<link href="<?php echo $link['href']; ?>" rel="<?php echo $link['rel']; ?>" />
<?php } ?>
<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/stylesheet.css" />
<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/media.css" />
<link rel="stylesheet" type="text/css" href="catalog/view/javascript/jquery/colorbox/colorbox.css" />
<script type="text/javascript" src="catalog/view/javascript/jquery/jquery-1.7.1.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
 
$(window).scroll(function(){
if ($(this).scrollTop() > 100) {
$('.scrollup').fadeIn();
} else {
$('.scrollup').fadeOut();
}
});
 
$('.scrollup').click(function(){
$("html, body").animate({ scrollTop: 0 }, 600);
return false;
});
 
});
</script>
<script type="text/javascript" src="catalog/view/javascript/jquery/jquery.jcarousel.min.js"></script>
<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/carousel.css" />
<script type="text/javascript" src="catalog/view/javascript/jquery/ui/jquery-ui-1.8.16.custom.min.js"></script>
<link rel="stylesheet" type="text/css" href="catalog/view/javascript/jquery/ui/themes/ui-lightness/jquery-ui-1.8.16.custom.css" />
<script src="//yandex.st/jquery/cookie/1.0/jquery.cookie.min.js"></script>
<script type="text/javascript" src="catalog/view/javascript/viewportchecker.js"></script>
<script type="text/javascript" src="catalog/view/javascript/common.js"></script>
<script type="text/javascript" src="catalog/view/javascript/jquery/colorbox/jquery.colorbox-min.js"></script>
<script type="text/javascript" src="catalog/view/javascript/jquery.smooth-scroll.min.js"></script>
<script type="text/javascript" src="catalog/view/javascript/jquery.ba-bbq.js"></script>
<?php foreach ($styles as $style) { ?>
<link rel="<?php echo $style['rel']; ?>" type="text/css" href="<?php echo $style['href']; ?>" media="<?php echo $style['media']; ?>" />
<?php } ?>
<?php foreach ($scripts as $script) { ?>
<script type="text/javascript" src="<?php echo $script; ?>"></script>
<?php } ?>
<!--[if IE 7]> 
<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/ie7.css" />
<![endif]-->
  <script type="text/javascript">
$(document).ready(function() {
var url=document.location.href;
$.each($(".top_menu a"),function(){
if(this.href==url){$(this).addClass('active');};
});
$('.colorbox').colorbox({
		overlayClose: true,
		opacity: 0.5,
		slideshow:false,
		rel: "colorbox"
	});



var menus = $('#category_slider');

$('.link_menu').click(function() {
var scrl = menus.offset().top-70;
var scrlN = $(document).scrollTop()

  var inter = setInterval(function() {

      if(scrlN >= scrl) {
        clearInterval(inter);
      }
      console.log(scrlN + 10);
      $(document).scrollTop(scrlN = scrlN + 30)

  }, 10);

})

});
</script>
<!--[if lt IE 7]>
<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/ie6.css" />
<script type="text/javascript" src="catalog/view/javascript/DD_belatedPNG_0.0.8a-min.js"></script>
<script type="text/javascript">
DD_belatedPNG.fix('#logo img');
</script>
<![endif]-->
<?php if ($stores) { ?>
<script type="text/javascript"><!--
$(document).ready(function() {
<?php foreach ($stores as $store) { ?>
$('body').prepend('<iframe src="<?php echo $store; ?>" style="display: none;"></iframe>');
<?php } ?>
});
//--></script>
<?php } ?>
<?php echo $google_analytics; ?>
</head>
<body>
<div class="top_menu_bg"></div>
<div id="container">
<div id="header">
  <?php if ($logo) { ?>
  <div id="logo">
  <?php if ($home == $og_url) { ?>
  <img src="<?php echo $logo; ?>" title="<?php echo $name; ?>" alt="<?php echo $name; ?>" />
  <?php } else { ?>
  <a href="<?php echo $home; ?>"><img src="<?php echo $logo; ?>" title="<?php echo $name; ?>" alt="<?php echo $name; ?>" /></a>
  <?php } ?>
  <div class="phone"><span>+7 (968)</span> 500-09-88</div>
  </div>
  <?php } ?>
<div class="city">
	Ваш город
	<div class="choise-city">
	<p>Москва</p>
	<a href="https://goodrolls.ru/">Трехгорка</a>
	</div>
</div>
<?php echo $cart; ?>

  <div id="autorize">
  
  </div>

  <ul class="top_menu">
  <li><a href="<?php echo $home; ?>"><?php echo $text_home; ?></a></li>
  <li><a class="link_menu">Меню</a></li>
  <li><a href="index.php?route=record/blog&blog_id=2">Новости</a></li>
  <li><a href="index.php?route=information/information&information_id=9">Доставка</a></li>
  <li><a href="index.php?route=information/information&information_id=8">Контакты</a></li>
  </ul>
</div>
<div id="notification"></div>
<div id="mob_footer_menu">
  <ul>
    <li><a href="/" id="to_home"><img src="/image/home.svg"></a></li>
    <li><a href="javascript:void(0)" onclick="$('.top_menu').hide(); $('#category_slider').show();" id="to_menu"><img src="/image/menu.svg"></a></li>
    <li><a href="javascript:void(0)" id="to_telephone"><img src="/image/telephone.svg"></a></li>
  </ul>
</div>
