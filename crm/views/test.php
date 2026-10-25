<?php //namespace lib;
	$e = (!empty($_POST)) ? $_POST : $_GET;
	echo json_encode($e, JSON_UNESCAPED_UNICODE);	
	//echo $e;	
?>

