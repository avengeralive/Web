<?php
// Защита от инжекта для передаваемых переменных
// Protection of Injection for the transmission of variables
include $_SERVER['DOCUMENT_ROOT'].'/../includes/antiinject/index.php';

// Функция отправки письма на почту
// Function of sending a letter to the post office
include $_SERVER['DOCUMENT_ROOT'].'/../includes/sendemail/index.php';

// Функция определения УРЛа и типа соединения (HTTP или HTTPS)
// Function definition of URL and the connection type (HTTP or HTTPS)
include $_SERVER['DOCUMENT_ROOT'].'/../includes/detecturl/index.php';
	
// Функция определения домена
// Function definition domain
include $_SERVER['DOCUMENT_ROOT'].'/../includes/detectdomain/index.php';
	
// Функция определения текущего имени файла
// Function to determine the current file name
include $_SERVER['DOCUMENT_ROOT'].'/../includes/detectfilename/index.php';

// Определяем ГЕО, IP и другие параметры посетителя
// Define GEO, IP and other settings visitor
include $_SERVER['DOCUMENT_ROOT'].'/../modules/detectclient/detector.php';
$country=$detector->get('country');
$short_country=$detector->get('country_code');
$region=$detector->get('region');
$town=$detector->get('city');
$ip=$detector->get('ip');
$browser_name=$detector->get('browser_name');
$browser_version=$detector->get('browser_ver');
$useragent=$detector->get('agent');
$platform=$detector->get('platform');
$referer=$detector->get('referer');
$mobile=$detector->get('mobile'); 

// Определяем SubID если таковые есть
// Determine if any SubID
$subid = array_values($_GET);
if (isset($subid[1])) {$subid1=htmlspecialchars($subid[1]);} else {$subid1='';}
if (isset($subid[2])) {$subid2=htmlspecialchars($subid[2]);} else {$subid2='';}
if (isset($subid[3])) {$subid3=htmlspecialchars($subid[3]);} else {$subid3='';}

// Проверка нужна ли переадресация или же нет (если правило не прописано в ТДС вебмастера)
// Check whether the forwarding is necessary or not (if the rule is not spelled out in the TDS webmaster)
$sovpadenie=1;

$sql_user_tds = "SELECT * FROM user_tds WHERE `user_id`='$userid'";
$result_user_tds = $mysqli->query($sql_user_tds);
if (mysqli_num_rows($result_user_tds) > 0) 
	{
	while ($res_user_tds=mysqli_fetch_array($result_user_tds)) 
		{
		if ($res_user_tds['offer_id']!=$offerid || $res_user_tds['offer_id']=='' || $res_user_tds['offer_id']=='0') {$sovpadenie=0;}
		if ($res_user_tds['landing_id']!=$landingid || $res_user_tds['landing_id']=='' || $res_user_tds['landing_id']=='0') {$sovpadenie=0;}
		if (($res_user_tds['referer']!=$referer) && ($res_user_tds['referer']!='')) {$sovpadenie=0;}
		if (($res_user_tds['ip']!=$ip) && ($res_user_tds['ip']!='')) {$sovpadenie=0;}
		if (($res_user_tds['platform']!=$platform) && ($res_user_tds['platform']!='All')) {$sovpadenie=0;}
		if (($res_user_tds['useragent']!=$useragent) && ($res_user_tds['useragent']!='')) {$sovpadenie=0;}
		if (($res_user_tds['country']!=$country) && ($res_user_tds['country']!='')) {$sovpadenie=0;}
		if ($res_user_tds['offer_dest_id']=='' || $res_user_tds['offer_dest_id']=='0') {$sovpadenie=0;}
		if ($res_user_tds['landing_dest_id']=='' || $res_user_tds['landing_dest_id']=='') {$sovpadenie=0;} else {$sovpadenie=$sovpadenie+1;}

		if ($sovpadenie==2) 
			{
			$offer_dest_id=htmlentities($res_user_tds['offer_dest_id']);
			$landing_dest_id=htmlentities($res_user_tds['landing_dest_id']);

			// Определяем домен который используется для лендингов
			// Determine the domain that is used for landing
			$sql_domain = "SELECT domain FROM domains WHERE `active`='1' ORDER BY `id` DESC";
			$result_domain = $mysqli->query($sql_domain);
			$res_domain=mysqli_fetch_array($result_domain);
			$domain=htmlentities($res_domain['domain']);	
	
			// Формируем партнерскую ссылку (формируем ее из ID пользователя, ID оффера и ID лендинга)
			// Form the affiliate link (forming it from the UserID ,ID offer and ID landing)
			$redirect_partnerlink='http://'.$domain.'/?p='.partnerstroka_encode($userid.'-'.$offer_dest_id.'-'.$landing_dest_id);
			if ($subid1!='') {$redirect_partnerlink.='&subid1='.$subid1;}
			if ($subid2!='') {$redirect_partnerlink.='&subid2='.$subid2;}
			if ($subid3!='') {$redirect_partnerlink.='&subid3='.$subid3;}
			Header ("Location: $redirect_partnerlink");
			exit;
			}
		$sovpadenie=0;
		}
	}

// Трафикбек если не подходит ГЕО или ОФФЕР отключен
// Check whether the forwarding is necessary or not (if the rule is not spelled out in the TDS webmaster)
$trafSend=1;

$sql = "SELECT * FROM traficbacks WHERE `user_id`='$userid' AND `offer_id`='$offerid' AND `status`='1' LIMIT 1";
$result = $mysqli->query($sql);
if (mysqli_num_rows($result) > 0) 
	{
	while ($res_user_trafback=mysqli_fetch_array($result)) 
		{
		if ($res_user_trafback['offer_id']!=$offerid) {$trafSend=0;}
		if ($res_user_trafback['url']=='' || $res_user_trafback['url']=='http://') {$trafSend=0;}

		if ($trafSend == 1) 
			{
			$url_redirects=html_entity_decode($res_user_trafback['url']);
           
            $sql_checkoffer = "SELECT geo FROM offers WHERE `id`='$offerid'";
            $result_checkoffer=$mysqli->query($sql_checkoffer);
            $res_checkoffer=mysqli_fetch_array($result_checkoffer);

		    $geo=$res_checkoffer['geo'];
			
		      // ПРОВЕРЯЕМ ПОДХОДИТ ЛИ ГЕО
			$offer_geo=explode('|', trim($geo));
			$offer_country_iso_arr = explode(':', $offer_geo[0]);
			$offer_region_id_arr = explode(':', $offer_geo[1]);
			
			//$geo_code = explode('|',$geo);
			//$geo_country_code = $geo_code[0];
			//$geo_region_code = $geo_code[1];
            $trafbackGo = 0;

                if(!empty($offer_country_iso_arr)){                    
					$checkCountry = array_search($short_country, $offer_country_iso_arr);
                    if(empty($checkCountry)){$trafbackGo = 1;}
					if(!empty($offer_region_id_arr)){
						$region_arr_id = $offer_region_id_arr[$checkCountry];
						if(!empty($region_arr_id)){
							$sql_region = "SELECT * FROM sxgeo_regions WHERE `id`='$region_arr_id' LIMIT 1";
							$result_region = $mysqli->query($sql_region);
							$res_region=mysqli_fetch_array($result_region);
							$geo_region = $res_region['name_ru'];
							if($geo_region != $region){$trafbackGo = 1;}
						}						
					}
					$file = '/var/www/www-root/data/www//people.txt';
					// Добавляем нового человека в файл
					$current = $checkCountry.':'.$short_country.' - '.$offer_country_iso_arr[0].'-'.$offer_country_iso_arr[1].'-'.$offer_country_iso_arr[2].'-'.$offer_country_iso_arr[3];
					// Пишем содержимое обратно в файл
					file_put_contents($file, $current);   					
                }            
                
                if($trafbackGo == 1 or $redirect == 1){    

                    //$phrase  = "http://kino-bum.ru/?utm1={subid1}&utm2={subid2}&utm3={subid3}";
                    $url_new = parse_url($url_redirects);
                    $url_new_scheme = $url_new['scheme'];
                    $url_new_host = $url_new['host'];
					$url_new_s = '';
                    if($url_new_scheme == ''){$url_new_s = 'http://';$url_new_r = 'http://'.$url_redirects;}else{$url_new_r = $url_redirects;}
                    //if($url_new_host != ''){$url_new_s .= $url_redirects;}else{$url_new_s .= $url_redirects;}
					$url_new_s .= $url_redirects;
                    
                    $searchUtm1   = '{subid1}';
                    $searchUtm2   = '{subid2}';
                    $searchUtm3   = '{subid3}';
                    $pos1 = strpos($url_redirects, $searchUtm1);
                    $pos2 = strpos($url_redirects, $searchUtm2);
                    $pos3 = strpos($url_redirects, $searchUtm3);

                    if($pos1 != true or $pos2 != true or $pos3 != true){
                       if($url_new_scheme == ''){$url_new_s = 'http://'.$url_redirects;}else{$url_new_s = $url_redirects;}
                    }              
                    
                    if ($subid1!='' or $subid2!='' or $subid3!=''){
                         
                        $searchUtm = array("{subid1}", "{subid2}", "{subid3}");
                        $changes   = array($subid1, $subid2, $subid3);

                        $url_new_r = str_replace($searchUtm, $changes, $url_new_r);
                         
                        Header ("Location: ".$url_new_r);
                        exit;
                    }else{
                        
                        $searchUtm = array("{subid1}", "{subid2}", "{subid3}");
                        $changes   = array("", "", "");

                        $url_new_s = str_replace($searchUtm, $changes, $url_new_s);                       
                        
                        Header ("Location: ".$url_new_s);
                        exit;
                    }

                }
            
			}
        
		$trafSend=0;
		}
    }
    elseif($redirect == 1)
    {

    Header('Location: http://'.$domain_vitrina);
    exit;               

    }

// Пишем в базу данные о посетителе
// Write in the visitor data base
include_once $_SERVER['DOCUMENT_ROOT'].'/../includes/clientslog/index.php';	
?>
