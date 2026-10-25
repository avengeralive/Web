<?php
header('Content-type: application/x-javascript; charset=UTF8'); 
$partner = (int)\Cetera\Application::getInstance()->getVar('id');
?>
document.addEventListener('DOMContentLoaded', function () {

	document.body.innerHTML = '<div class="fastsite-content-wrapper">' + document.body.innerHTML + '</div><div class="fastsite-banner"><a target="_blank" href="http://fastsite.ru/?partner=<?php echo $partner; ?>"><img src="/plugins/partner/banner.jpg" /></a></div>';
	
}); 