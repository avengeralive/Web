    <?php  
    session_start();
    // Этот код добавляем на целевую страницу  
    if (isset($_SESSION['code']))  
        {  
        if (isset($_POST['name'])) {$name=htmlentities($_POST['name']);} else {$name='';} 
        if (isset($_POST['phone'])) {$phone=htmlentities($_POST['phone']);} else {$phone='';}
        if (isset($_POST['email'])) {$email=htmlentities($_POST['email']);} else {$email='';}
        if (isset($_POST['address'])) {$address=htmlentities($_POST['address']);} else {$address='';}
        if (isset($_POST['kolvo'])) {$kolvo=htmlentities($_POST['kolvo']);} else {$kolvo='';}
        if (isset($_POST['cena'])) {$cena=htmlentities($_POST['cena']);} else {$cena='';} 
        if (isset($_POST['artikul'])) {$artikul=htmlentities($_POST['artikul']);} else {$artikul='';}
        if (isset($_POST['referer'])) {$referer=htmlentities($_POST['referer']);} else {$referer='';}
        $url = 'http://cparta.online';  
        $data = array  
            (  
            'code' => htmlentities($_SESSION['code']),  
            'name' => $name,  
            'phone' => $phone,  
            'email' => $email, 
            'address' => $address, 
            'kolvo' => $kolvo, 
            'cena' => $cena, 
            'artikul' => $artikul,
            'referer' => $referer 
            );  
        $options = array ('http' => array ('header' => "Content-type: application/x-www-form-urlencoded\r\n", 'method'  => 'POST', 'content' => http_build_query($data)));  
        $context  = stream_context_create($options);  
        $result = file_get_contents($url, false, $context);  
		
		
        if ($result === FALSE) {echo 'Соединение неудачно.';}  
        unset ($_SESSION['code']);  
        }  
    ?> 

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en"><head>
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

	<?php
		// autoinject-start
		require_once('/var/www/www-root/data/www/cparta.net/offers/append-success.php');
		// autoinject-end
		?></body></html>