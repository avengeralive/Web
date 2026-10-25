<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/../utilities/bootstrap.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/../modules/detectclient/detector.php';

class LandingsData extends Detector{
    	
	public $price = array();	

	public function __construct(){
		$this->detect();
	}		
	public function getPrice ($offer_id){
				

        $db = DB::getInstance();
        $sql = "select * from offers where id='$offer_id'";
        $row = $db->query($sql)->fetch(PDO::FETCH_LAZY);
		$price_arr=explode('|', trim($row['cena']));
		$short_country = $this->getCountryCode();	
		$geo_offer = explode('|', trim($row['geo']));
		$offer_country_iso_arr = explode(':', $geo_offer[0]);		
		if(!empty($short_country)){
			if(!empty($offer_country_iso_arr)){  
				$checkCountry = array_search($short_country, $offer_country_iso_arr);
				if($checkCountry !== false){										
					$price['real_price']=$price_arr[$checkCountry];	
					$price['old_price']=$price_arr[$checkCountry]*2;
                                        
                                        $price['old_price_53']= round(($price_arr[$checkCountry]*100/47) / 50) *50;
                                        
                                        // x=90*100/75=9000/75=120
                                        
					$currency_arr = $this->getCurrency($offer_country_iso_arr[$checkCountry]);		
					$name_country = $currency_arr['name_country'];
					$currency = $currency_arr['currency'];
				}else{
					$price['real_price']=$price_arr[0];	
					$price['old_price']=$price_arr[0]*2;	
                                        $price['old_price_53']= round(($price_arr[0]*100/47) / 50) *50;
					$currency_arr = $this->getCurrency($offer_country_iso_arr[0]);	
					$name_country = $currency_arr['name_country'];
					$currency = $currency_arr['currency'];
				}
			}else{
				$price['real_price']=$price_arr[0];	
				$price['old_price']=$price_arr[0]*2;
                                $price['old_price_53']= round(($price_arr[0]*100/47) / 50) *50;
				$currency_arr = $this->getCurrency($offer_country_iso_arr[0]);	
				$name_country = $currency_arr['name_country'];
				$currency = $currency_arr['currency'];
			}
		}else{
			$price['real_price']=$price_arr[0];	
			$price['old_price']=$price_arr[0]*2;	
                        $price['old_price_53']= round(($price_arr[0]*100/47) / 50) *50;
			$currency_arr = $this->getCurrency($offer_country_iso_arr[0]);	
			$name_country = $currency_arr['name_country'];
			$currency = $currency_arr['currency'];
		}
                
                $currency_r = stristr($currency, 'уб', true);
                $currency_r = mb_strtolower($currency_r);
                
		$price = array(
			'old_price'=>$price['old_price'].' '.$currency, 
			'real_price'=> $price['real_price'].' '.$currency, 
			'old_price_r'=>$price['old_price'].' '.$currency_r, 
			'real_price_r'=> $price['real_price'].' '.$currency_r, 
			'currency'=> $currency,
                        'currency_r'=> $currency_r,
                        'old_price_53'=>$price['old_price_53'],
			'only_old_price'=>$price['old_price'],
			'only_real_price'=>$price['real_price']
		);		
		return $price;
		
	}
	
	public function getCountryCode(){
		
		$short_country=$this->get('country_code');
//var_dump($short_country);exit;
		return $short_country;
		
	}

	public function getCurrency ($short_country){
	
		$db = DB::getInstance();
		$sql = "select name_ru,currency from sxgeo_country where iso='$short_country'";
		$row = $db->query($sql)->fetch(PDO::FETCH_LAZY);
		if ($row) 
			{
			$ret_arr = array('name_country' => $row['name_ru'], 'currency' => $row['currency']);
			}
		else
			{
			$ret_arr = array('name_country' => 'Россия', 'currency' => 'Руб.');	
			}
		return $ret_arr;		
		
	}
	
	function getMetrika ($stream){
		
		$stream = $this->get_stream($stream, 'metrika');
		if(!empty($stream)){
			
			$str = 
			'
<!-- Yandex.Metrika counter -->
<script type="text/javascript">
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter'.$stream.' = new Ya.Metrika({
                    id:'.$stream.',
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true,
                    webvisor:true
                });
            } catch(e) { }
        });

        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src = "https://mc.yandex.ru/metrika/watch.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/'.$stream.'" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->			
			';
			
			return $str;
		}
				
	}
	
	function getGoogle ($stream){
		
		$stream = $this->get_stream($stream, 'GoogleAnalytics');
		if(!empty($stream)){
			
			$str = 
			'
				<!-- Global site tag (gtag.js) - Google Analytics -->
				<script async src="https://www.googletagmanager.com/gtag/js?id='.$stream.'"></script>
				<script>
				  window.dataLayer = window.dataLayer || [];
				  function gtag(){dataLayer.push(arguments);}
				  gtag("js", new Date());

				  gtag("config", "'.$stream.'");
				</script>				
			';
			
			return $str;
		}
				
	}
	
	function get_mail_id ($stream){
		
		$stream = $this->get_stream($stream, 'mail');
		if(!empty($stream)){
			
			$str = 
			'
				<!-- Rating@Mail.ru counter --> 
				<script type="text/javascript"> 
				var _tmr = _tmr || []; 
				_tmr.push({id: "'.$stream.'", type: "pageView", start: (new Date()).getTime()}); 
				(function (d, w) { 
				var ts = d.createElement("script"); ts.type = "text/javascript"; ts.async = true; 
				ts.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//top-fwz1.mail.ru/js/code.js"; 
				var f = function () {var s = d.getElementsByTagName("script")[0]; s.parentNode.insertBefore(ts, s);}; 
				if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); } 
				})(document, window); 
				</script>
				<!-- //Rating@Mail.ru counter --> 
			';
			
			return $str;
		}
				
	}	
	function vk ($stream){
		
		$stream = $this->get_stream($stream, 'vk');
		if(!empty($stream)){
			
			$str = 
			"
				<script type='text/javascript'>(window.Image ? (new Image()) : document.createElement(\'img\')).src = location.protocol + '//vk.com/rtrg?r=".$stream."';</script>
			";
			
			return $str;
		}
				
	}	
	function facebook ($stream){
		
		$stream = $this->get_stream($stream, 'facebook');
		if(!empty($stream)){
			
			$str = 
			'
				<script>(function() { 
				var _fbq = window._fbq || (window._fbq = []); 
				if (!_fbq.loaded) { 
				var fbds = document.createElement(\'script\'); 
				fbds.async = true; 
				fbds.src = \'//connect.facebook.net/en_US/fbds.js\'; 
				var s = document.getElementsByTagName(\'script\')[0]; 
				s.parentNode.insertBefore(fbds, s); 
				_fbq.loaded = true; 
				} 
				_fbq.push([\'addPixelId\', \''.$stream.'\']); 
				})(); 
				window._fbq = window._fbq || []; 
				window._fbq.push([\'track\', \'PixelInitialized\', {}]); 
				</script> 
				<noscript><img height="1" width="1" alt="" style="display:none" src="https://www.facebook.com/tr?id='.$stream.'&amp;ev=PixelInitialized" /></noscript> 
			';
			
			return $str;
		}
				
	}	
	function directadvert ($stream){
		
		$stream = $this->get_stream($stream, 'directadvert');
		if(!empty($stream)){
			
			$str = 
			'
				<img src="//code.directadvert.ru/track/'.$stream.'.gif" width="1" height="1" />
			';
			
			return $str;
		}
				
	}	
	function get_users_online_top ($stream){
		$stream = $this->get_stream($stream, 'pl_in_head');
		return $stream;
	}	
	function get_count_orders_right ($stream){
		$stream = $this->get_stream($stream, 'pl_order');
		return $stream;
	}	
	function get_delivery ($stream){
		$stream = $this->get_stream($stream, 'pl_dost');
		return $stream;
	}	
	function get_users_online_left ($stream){
		$stream = $this->get_stream($stream, 'pl_us_online');
		return $stream;
	}	
	function get_price_right ($stream){
		$stream = $this->get_stream($stream, 'pl_freez_price');
		return $stream;
	}
	function comebacker ($stream){
		$stream = $this->get_stream($stream, 'comeback');
		return $stream;
	}
	
	function postCreatOrder ($stream, $order){
		$postback_url = html_entity_decode($this->get_stream($stream, 'postback_url'));
		$postback_add = $this->get_stream($stream, 'postback_add');
		
		if(!empty($postback_url) && $postback_add == 1){	
			
			$db = DB::getInstance();
			$sql = "select * from zakaz WHERE `id`='$order' LIMIT 1";
			$row = $db->query($sql)->fetch(PDO::FETCH_LAZY);
			$offerid=htmlentities($row['offer_id']);			
			$profit=htmlentities($row['comission']);
			$ip=htmlentities($row['ip']);	
			$subid1=htmlentities($row['subid1']);
			$subid2=htmlentities($row['subid2']);
			$subid3=htmlentities($row['subid3']);

			$sql = "select name from offers WHERE `id`='$offerid' LIMIT 1";
			$row = $db->query($sql)->fetch(PDO::FETCH_LAZY);
			$offer_name=htmlentities($row['name']);				
			
			$search = array("{status}","{stream_id}","{lead_time}","{ip}","{profit}","{offer_id}","{offer_name}","{subid1}", "{subid2}", "{subid3}");
			$changes   = array('waiting', $stream, date('d.m.Y H:i:s') , $ip, $profit, $offerid, $offer_name, $subid1, $subid2, $subid3);					
			$url_new = str_replace($search, $changes, $postback_url);	
			$url_new = str_replace(' ','+',$url_new);
			$this->postCurlData($url_new);
			
		}
	}		
	
	
	function get_stream ($stream, $args){
		
		$db = DB::getInstance();
		$sql = "select {$args} from streams where id='$stream' LIMIT 1";
		$row = $db->query($sql)->fetch(PDO::FETCH_LAZY);
		
		return $row[$args];
		
	}	
	
	function postCurlData($url)
	{
		$curl = curl_init();
		curl_setopt($curl,CURLOPT_URL,$url);
		curl_setopt($curl, CURLOPT_TIMEOUT, 30);
		//curl_setopt($curl, CURLOPT_POST, 1);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		//curl_setopt($curl, CURLOPT_POSTFIELDS, $requestQuery);
		$result = curl_exec($curl);
		curl_close($curl);
		//$result =json_decode($result, true);	
	}	
}
?>
