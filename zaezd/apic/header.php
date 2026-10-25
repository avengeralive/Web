<?php
require("config/head.php");
require($inc_path."config/config.php");

include($inc_path."service/start.php");

include($inc_path."service/navy.php");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="target-densitydpi=device-dpi, width=device-width, user-scalable=yes" />
	<title><?php echo $meta["title"]; ?></title>
    <meta name="description" content="<?php echo $meta["description"]; ?>" />
    <meta name="keywords" content="<?php echo $meta["keywords"]; ?>" />

	<link rel="stylesheet" href="/css/all.css?1" type="text/css" />
	<script type="text/javascript" src="/js/jquery-1.10.2.min.js"></script>
	<script type="text/javascript" src="/js/formstone.js"></script>
	<script type="text/javascript" src="/js/jquery.bxslider.js"></script>
	<script type="text/javascript" src="/js/jquery.easing-1.3.min.js"></script>
	<script type="text/javascript" src="/js/sly.min.js"></script>
	<script type="text/javascript" src="/js/icheck.min.js"></script>
	<script type="text/javascript" src="/js/jquery.main.js"></script>
	<!--[if lte IE 8]><script type="text/javascript" src="/js/ie.js"></script><![endif]-->
    <script type="text/javascript" src="/lib/JsHttpRequest.js"></script>
<?php
if($site->current_part->sid=="en") echo '<script type="text/javascript" src="/lib/form_en.js"></script>';
else echo '<script type="text/javascript" src="/lib/form.js"></script>';
?>      



<script type="text/javascript">(window.Image ? (new Image()) : document.createElement('img')).src = location.protocol + '//vk.com/rtrg?r=lcQuFnKFy3NQyZ9MJ9cwfRBG6YVQZ4w/6wY9EpZ68Cg90wC5ZPccBXwAaK7HYnpQ73MpHObLAJ3STELZCZTD*ZpbTE8cJ9FaF2j/mKnUKsTy2U3PgqaIid4lxWySnriNfszKaxFDoeJrQRIGjMkhJKr43DQYtl52jiohjkM0x30-';</script>





<!-- Facebook Pixel Code -->
<script>
!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
document,'script','https://connect.facebook.net/en_US/fbevents.js');

fbq('init', '311730569181040');
fbq('track', "PageView");</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=311730569181040&ev=PageView&noscript=1"
/></noscript>
<!-- End Facebook Pixel Code -->



</head>