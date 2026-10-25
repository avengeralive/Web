<?php
	function get_info_price($offer_id){
		include $_SERVER['DOCUMENT_ROOT'].'/offers/../includes/config.php';
		include $_SERVER['DOCUMENT_ROOT'].'/offers/../includes/antiinject/index.php';
		include $_SERVER['DOCUMENT_ROOT'].'/offers/../modules/detectclient/detector.php';
		$country=$detector->get('country');
		$short_country=$detector->get('country_code');
		$region=$detector->get('region');					
		$price = array();
		$offer = $offer_id;
		$sql_getdataoffer = "SELECT * FROM offers WHERE `id`='$offer'";
		$result_getdataoffer=$mysqli->query($sql_getdataoffer);
		$res_getdataoffer=mysqli_fetch_array($result_getdataoffer);
		$price_arr=explode('|', trim($res_getdataoffer['cena']));

		if(!empty($short_country)){
			
			$geo_offer = explode('|', trim($res_getdataoffer['geo']));
			$offer_country_iso_arr = explode(':', $geo_offer[0]);
			if(!empty($offer_country_iso_arr)){  
				$checkCountry = array_search($short_country, $offer_country_iso_arr);
				if($checkCountry !== false){										
					$price['real_price']=$price_arr[$checkCountry];	
					$price['old_price']=$price_arr[$checkCountry]*2;					
					$arr = getCurrency($offer_country_iso_arr[$checkCountry]);	
					$name_country = $arr['name_country'];
					$currency = $arr['currency'];
				}else{
					$price['real_price']=$price_arr[0];	
					$price['old_price']=$price_arr[0]*2;					
					$arr = getCurrency($offer_country_iso_arr[0]);	
					$name_country = $arr['name_country'];
					$currency = $arr['currency'];
				}
			}else{
				$arr = getCurrency($offer_country_iso_arr[$checkCountry]);	
				$name_country = $arr['name_country'];
				$currency = $arr['currency'];
			}
		}else{
			$price['real_price']=$price_arr[0];	
			$price['old_price']=$price_arr[0]*2;					
			$arr = getCurrency($offer_country_iso_arr[0]);	
			$name_country = $arr['name_country'];
			$currency = $arr['currency'];
		}	
		
		
		$price = array('old_price'=>$price['old_price'].' '.$currency, 'real_price'=> $price['real_price'].' '.$currency, 'currency'=> $currency,'only_old_price'=>$price['old_price'],'only_real_price'=>$price['real_price']);		
		return $price;
	}
	
	function getCurrency ($short_country){
		include $_SERVER['DOCUMENT_ROOT'].'/pffers/../includes/config.php';
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