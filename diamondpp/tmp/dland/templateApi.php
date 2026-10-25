    <?php  
    $apikey = '{apikey}';	// ТУТ ВСТАВЛЯЕМ СВОЙ АПИ КЛЮЧ ( https:///profile.php )
	$stream_id = '{streamid}'; // ТУТ ВСТАВЛЯЕМ ИД ПОТОКА ( https:///streams.php )
    
    if (isset($_POST['name']) || isset($_POST['phone'])){  
	
        $name=htmlentities($_POST['name']);
        $phone=htmlentities($_POST['phone']);
		$sub1=isset($_POST['subid1'])?$_POST['subid1']:'';
		$sub2=isset($_POST['subid2'])?$_POST['subid2']:'';
        $sub3=isset($_POST['subid3'])?$_POST['subid3']:'';
        $sub4=isset($_POST['subid4'])?$_POST['subid4']:'';
		$sub5=isset($_POST['subid5'])?$_POST['subid5']:'';
		$ip='';
        if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])) {
            $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
        }
        if (isset($_SERVER["HTTP_CLIENT_IP"])) {
            $ip = $_SERVER["HTTP_CLIENT_IP"];
        }
        if (isset($_SERVER["REMOTE_ADDR"])) {
            $ip = $_SERVER["REMOTE_ADDR"];
        }
        if (isset($_SERVER["HTTP_X_REAL_IP"])) {
            $ip = $_SERVER["HTTP_X_REAL_IP"];
        }
		
		
		if (isset($_POST['email'])) {$email=htmlentities($_POST['email']);} else {$email='';}

        $url = 'https://api.avaleads.pro/v1/order/';  
        $order = [
            'key' => $apikey,
			'stream' => $stream_id,
            'clientname' => $name,
            'phone' => $phone,
			'email' => $email,
            'ip' => $ip,
            'sub1' => $sub1, // subID1
            'sub2' => $sub2, // subID2
            'sub3' => $sub3,  // subID3
            'sub4' => $sub4, // subID4
            'sub5' => $sub5, // subID5
            'referer' => $referer
        ]; 
		
        $curl = curl_init();
		curl_setopt($curl, CURLOPT_HEADER,false);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $order);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		$responseBody = curl_exec($curl);

		/*
			ОТВЕТ:
			{
				 status: 200,
				 id: 3293   // ИД ЗАКАЗА В НАШЕЙ СИСТЕМЕ, НУЖЕН ЕСЛИ ВЫ СОБИРАЕТЕСЬ ЗАБИРАТЬ СТАТУСЫ ЗАКАЗОВ
			}
		*/
		
		curl_close($curl);
    }  
    ?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en"><head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=320">
    <meta name="MobileOptimized" content="width=320">
    <title>Спасибо! Ваш заказ принят!</title>
    <link href="http://fonts.googleapis.com/css?family=Roboto+Condensed&subset=latin,cyrillic" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Lobster&subset=latin,cyrillic" rel="stylesheet" type="text/css">
    <link media="all" rel="stylesheet" type="text/css" href="css\order-style.css">

</head>
<body>
<div id="wrapper">
    <div class="order-block">

        <div class="text-holder">
            <h2><span>Спасибо!</span> Ваш заказ принят!</h2>
            <p>Наш оператор свяжется с вами для подтверждения заказа. <br><br> Доставка осуществляется курьером или почтой. Оплата - при получении!</p>
        </div>

    </div>
</div>

</body>
</html>