<?
class ice_cache {

function ice_cache() {
        }

static function no_cache($text){
	header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
	header('Expires: Thu, 01 Jan 1970 00:00:01 GMT');
	header('Pragma: no-cache');
	$modified = gmdate ("D, d M Y H:i:s", time()) . " GMT";
	header('X-Last-Modified: '.$modified);
	header ("X-Content-Length: " . strlen($text) );
	echo $text;
	}


function full_echo($text, $use_headers = false, $time = 0 ) {
	if ( defined("CACHE_CLEAN_HTML") && (CACHE_CLEAN_HTML) ) {
		// внимание! в тексте не должно быть JS кода - иначе испоганим :)
		$text = preg_replace("/=\"([-_.\/#A-Za-z0-9]{1,})\"( )?/", "=\\1\\2", $text);   
		// убираем ненужные кавычки
		$text = preg_replace("/(\s+)/", ' ', $text);
		// лишние пробелы
		};

	if (!$use_headers) {
		echo $text;
		return;
		}
	else {
		// использовать кеширование на стороне клиента
		$check = getallheaders();
		$ctime = time();
		$modified = gmdate ("D, d M Y H:i:s", $time) . " GMT";
		$etag = "\"$time".crc32($text)."\"";
		if  ( 
			(isset($check["If-Modified-Since"]) && ( strtotime($check["If-Modified-Since"]) == $time)) ||
			(isset($check["If-None-Match"]) && ($check["If-None-Match"] == $etag)) 
			){
			// в кеше браузера уже есть этот документ
			// TODO: какой именно HTTP/1.?
			header ("HTTP/1.0 304 Not Modified");
			header ("Last-Modified: " . $modified); 
			header ("ETag: ".$etag);
			return;
			}
		elseif ( isset($check["If-Modified-Since"]) && ereg( "^".$modified. "(; .*)?", $check["If-Modified-Since"], $reg ) ) {
			// NETSCAPE 4.7 BUG FIX;
			header ("HTTP/1.0 304 Not Modified");
			header ("Last-Modified: " . $modified); 
			header ("ETag: ".$etag);
			return;
			}
		else {
			//в кеше браузера нет этого документа
			header ("Last-Modified: " . $modified); 
			//header ("Vary: ETag");
			header ("ETag: ".$etag);
			header ("Content-Length: " . strlen($text) );
			header ("Cache-Control: public"); 
			echo $text;
			};
		};
		return;
	}


function mysqltimestamp_to_unixtimestamp($d){
	preg_match("/([0-9]{4})([0-9]{2})([0-9]{2})([0-9]{2})([0-9]{2})([0-9]{2})/", $d, $m);
	$year=$m[1];
	$month=$m[2];
	$day=$m[3];
	$h=$m[4];
	$min=$m[5];
	$sec=$m[6];
	$ts = mktime ($h, $min, $sec, $month, $day, $year);
	return $ts;
	}

}
?>