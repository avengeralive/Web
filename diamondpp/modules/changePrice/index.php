<?php
// Подключаем файл конфигурации
// Connect configuration file
include $_SERVER['DOCUMENT_ROOT'].'/../includes/config.php';	
// Защита от инжекта для передаваемых переменных
// Protection of Injection for the transmission of variables
include $_SERVER['DOCUMENT_ROOT'].'/../includes/antiinject/index.php';	


// Определяем ГЕО, IP и другие параметры посетителя
// Define GEO, IP and other settings visitor
include $_SERVER['DOCUMENT_ROOT'].'/../modules/detectclient/detector.php';
$country=$detector->get('country');
$short_country=$detector->get('country_code');
$region=$detector->get('region');

$code = $_SESSION['code'];
$sql_getdata = "SELECT offer_id FROM clients_log WHERE `code`='$code' LIMIT 1";
$result_getdata=$mysqli->query($sql_getdata);
$res_getdata=mysqli_fetch_array($result_getdata);
$offerid=htmlentities($res_getdata['offer_id']);	

$sql_getdataoffer = "SELECT * FROM offers WHERE `id`='$offerid'";
$result_getdataoffer=$mysqli->query($sql_getdataoffer);
$res_getdataoffer=mysqli_fetch_array($result_getdataoffer);
$price_arr=explode('|', trim($res_getdataoffer['cena']));

if(!empty($short_country)){
	
	$geo_offer = explode('|', trim($res_getdataoffer['geo']));
	$offer_country_iso_arr = explode(':', $geo_offer[0]);
	if(!empty($offer_country_iso_arr)){  
		$checkCountry = array_search($short_country, $offer_country_iso_arr);
		if($checkCountry !== false){										
			$price=$price_arr[$checkCountry];			
			$arr = getCurrency($mysqli,$offer_country_iso_arr[$checkCountry]);	
			$name_country = $arr['name_country'];
			$currency = $arr['currency'];
		}else{
			$price=1490;
			$name_country = 'Россия';
			$currency = 'Руб';			
		}
	}else{
		$arr = getCurrency($mysqli,$offer_country_iso_arr[$checkCountry]);	
		$name_country = $arr['name_country'];
		$currency = $arr['currency'];
	}
}else{
	$price=1490;
	$name_country = 'Россия';
	$currency = 'Руб';			
}		
	
function getCurrency ($mysqli,$short_country){
	$sql_geo = "SELECT name_ru,currency FROM sxgeo_country WHERE `iso`='$short_country'";
	$result_geo = $mysqli->query($sql_geo);
	if (mysqli_num_rows($result_geo) > 0) 
		{
		$res_geo=mysqli_fetch_array($result_geo);		
		$ret_arr = array('name_country' => $res_geo['name_ru'], 'currency' => $res_geo['currency']);
		}
	else
		{
		$ret_arr = array('name_country' => 'Россия', 'currency' => 'Руб.');	
		}
	return $ret_arr;		
}		
?>