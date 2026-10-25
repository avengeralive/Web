<?php
$twig->display('page_login.twig', array(
	'register' => isset($_POST['UserAuth'])?false:true
));