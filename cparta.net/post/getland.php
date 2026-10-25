<?php
@session_start();

ini_set("log_errors", 1);
ini_set("error_log", "/var/www/www-root/data/wwwlog/ERROR.log");

include dirname(__FILE__) . '/../includes/config.php';
include dirname(__FILE__) . '/../includes/auth/index.php';

if (!isset($user_id)){
    Header ('Location: /');	
    exit;
}

$user = User::getById($user_id);

if(!$user){
    Header ('Location: /');	
    exit;
}

$post = new Request($_POST);

if(isset($post->getGeo)){
    $land_id = $post->land;
    $landings = Landings::getById($post->land);
    $offer_id = $landings->offer_id;
    
    $offer = Offer::getById($offer_id);
    
    $offer_geo=explode('|', trim($offer->geo));
    $offer_country_iso_arr = explode(':', $offer_geo[0]);
    $options = '';
    
    if (count($offer_country_iso_arr) > 0) { 
        $i = 0;
        $max = count($offer_country_iso_arr);
        $iter = 0;
        
        foreach ($offer_country_iso_arr as $key => $val) {
            $iter++;

            $sql_geo = "SELECT name_ru,currency FROM sxgeo_country WHERE `iso`='$val'";
            $result_geo = $mysqli->query($sql_geo);
            if (mysqli_num_rows($result_geo) > 0) {
                $res_geo = mysqli_fetch_array($result_geo);
                $geo_country_name = htmlentities($res_geo['name_ru']);
            } else {
                $geo_country_name = $loc['offers.php']['t09'];
            }

            $options .= '<option value="'.$val.'">'.$geo_country_name.'</option>';

            $i++;
         }

    }

    $response = array(
        "status" => 'success',
        "options" => $options,
        "offer" => $offer_id,
        "landing" => $land_id,
    );
    print json_encode($response);
    

}
if(isset($post->getLand)){
    include '../includes/Zip/index.php';
    $landings = Landings::getById($post->land);

    
    $apikey = $user->apikey;
    $stream_id = $post->stream;
    
    $offer_id = $post->offer;
    $geo = $post->geo;
    
    $offer = Offer::getById($offer_id);
    
    $offer_geo=explode('|', trim($offer->geo));
    $offer_country_iso_arr = explode(':', $offer_geo[0]);
    
    $price_arr=explode('|', trim($offer->cena));
    $short_country = $geo;
    $geo_offer = explode('|', trim($offer->geo));
    $offer_country_iso_arr = explode(':', $geo_offer[0]);
    if(!empty($short_country)){
            if(!empty($offer_country_iso_arr)){  
                    $checkCountry = array_search($short_country, $offer_country_iso_arr);
                    if($checkCountry !== false){										
                            $price['real_price']=$price_arr[$checkCountry];	
                            $price['old_price']=$price_arr[$checkCountry]*2;
                            $currency_arr = getCurrency($offer_country_iso_arr[$checkCountry]);		
                            $name_country = $currency_arr['name_country'];
                            $currency = $currency_arr['currency'];
                    }else{
                            $price['real_price']=$price_arr[0];	
                            $price['old_price']=$price_arr[0]*2;					
                            $currency_arr = getCurrency($offer_country_iso_arr[0]);	
                            $name_country = $currency_arr['name_country'];
                            $currency = $currency_arr['currency'];
                    }
            }else{
                    $price['real_price']=$price_arr[0];	
                    $price['old_price']=$price_arr[0]*2;					
                    $currency_arr = getCurrency($offer_country_iso_arr[0]);	
                    $name_country = $currency_arr['name_country'];
                    $currency = $currency_arr['currency'];
            }
    }else{
            $price['real_price']=$price_arr[0];	
            $price['old_price']=$price_arr[0]*2;					
            $currency_arr = getCurrency($offer_country_iso_arr[0]);	
            $name_country = $currency_arr['name_country'];
            $currency = $currency_arr['currency'];
    }

    $landing = $landings->url;
    $arch_url = explode('/', $landing);  // cparta.online/AlfaMan/AlfaManV1
    $arch_url = array_filter($arch_url); 
    $arch_url = array_values($arch_url);
    $arch_url = array_slice($arch_url,2);


    $url = '';
    foreach($arch_url as $url_item){
            $url .= $url_item .'/';
    }

    $p = dirname(__FILE__) . '/../offers/' . $url;
    $new_dir = dirname(__FILE__) . '/../tmp/dland/' . $landings->id . '_' . time();
    
    copy_folder($p, $new_dir, $upd = true, $force = true);

    if(file_exists($new_dir . '/index.html')){
        unlink($new_dir . '/index.html');
    }

    //$index_home = file_get_contents($new_dir . '/index.php');

    $index_home = file_get_contents($new_dir . '/index.php');

    $marker=stripos($index_home, "<!doctype");
    $str = substr($index_home, $marker);

	$add = 
	"
	<?php
            \$price = [
                    'old_price'=> '".$price['old_price']." ".$currency."', 
                    'real_price'=> '".$price['real_price']." ".$currency."', 
                    'currency'=> '".$currency."',
                    'only_old_price'=> ".$price['old_price'].",
                    'only_real_price'=> ".$price['real_price']."
            ];
            \$name = 'clientname';
	?>
	";
	
	$final = $add.$str;

	$handler = fopen($new_dir . '/index.php', "w");
	fwrite($handler, $final);
	fclose($handler);

    
    $tempalte = file_get_contents(dirname(__FILE__) . '/../tmp/dland/templateApi.php');
    
    $tempalte = str_replace('{apikey}', $apikey, $tempalte);
    $tempalte = str_replace('{streamid}', $stream_id, $tempalte);
    
    $final = $tempalte;
    
	$handler = fopen($new_dir . '/_success_/index.php', "w");
	fwrite($handler, $final);
	fclose($handler);
        

    if (file_exists(dirname(__FILE__) . '/../tmp/dland/' . $landings->id .'-'. $user->id .'-'. $stream_id .'.zip')) {
        $file = 'https://cparta.net/tmp/dland/' . $landings->id .'-'. $user->id .'-'. $stream_id .'.zip';
        if (ob_get_level()) {
            ob_end_clean();
        }
        //rmdir($new_dir);
        echo $file;
        exit;
    }else{
        zip($new_dir, dirname(__FILE__) . '/../tmp/dland/' . $landings->id .'-'. $user->id .'-'. $stream_id .'.zip');
        $file = 'https://cparta.net/tmp/dland/' . $landings->id .'-'. $user->id .'-'. $stream_id .'.zip';
        if (ob_get_level()) {
            ob_end_clean();
        }
        //rmdir($new_dir);
        echo $file;
        exit;
    }
}
 exit;
 
 function copy_folder($d1, $d2, $upd = true, $force = true) { 
    if ( is_dir( $d1 ) ) { 
        $d2 = mkdir_safe( $d2, $force ); 
        if (!$d2) {fs_log("!!fail $d2"); return;} 
        $d = dir( $d1 ); 
        while ( false !== ( $entry = $d->read() ) ) { 
            if ( $entry != '.' && $entry != '..' )  
                copy_folder( "$d1/$entry", "$d2/$entry", $upd, $force ); 
        } 
        $d->close(); 
    } 
    else { 
        $ok = copy_safe( $d1, $d2, $upd ); 
        $ok = ($ok) ? "ok-- " : " -- "; 
        fs_log("{$ok}$d1");  
    } 
} //function copy_folder 

function mkdir_safe( $dir, $force ) { 
    if (file_exists($dir)) { 
        if (is_dir($dir)) return $dir; 
        else if (!$force) return false; 
        unlink($dir); 
    } 
    return (mkdir($dir, 0777, true)) ? $dir : false; 
} //function mkdir_safe 

function copy_safe ($f1, $f2, $upd) { 
    $time1 = filemtime($f1); 
    if (file_exists($f2)) { 
        $time2 = filemtime($f2); 
        if ($time2 >= $time1 && $upd) return false; 
    } 
    $ok = copy($f1, $f2); 
    if ($ok) touch($f2, $time1); 
    return $ok; 
} //function copy_safe  

function fs_log($str) { 
    $log = fopen("./fs_log.txt", "a"); 
    $time = date("Y-m-d H:i:s"); 
    fwrite($log, "$str ($time)\n"); 
    fclose($log); 
} 

	function getCurrency ($short_country){
	
		$db = DB::getInstance();
		$sql = "select name_ru,currency from sxgeo_country where iso='$short_country'";
		$row = $db->query($sql)->fetch(PDO::FETCH_LAZY);
		if ($row) 
			{
			$ret_arr = array('name_country' => $row['name_ru'], 'currency' => $row['currency']);
			}
		else
			{
			$ret_arr = array('name_country' => 'Россия', 'currency' => 'Руб1.');	
			}
		return $ret_arr;		
		
	}