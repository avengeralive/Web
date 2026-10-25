<?php

$offer = 75;
$api_key = '428fd42847';


		$arHash = array(
				$offer,
				$api_key);	
		$sign_hash = strtoupper(md5(implode(":", $arHash)));
		echo $offer.' - '.$sign_hash.'<br>';

?>