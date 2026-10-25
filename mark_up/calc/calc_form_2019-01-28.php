<?php
# die(var_dump($_POST));

$post=$_POST;
$err = 0;

if (!isset($post['calc_tel'], $post['calc_email'])) 
    $err = 'Введите Ваш Телефон и Email<br/>';
	# CAPTCHA reCaptcha();

/*if (!(isset($post['platform_android']) || isset($post['platform_apple']) || isset($post['platform_web'])))
    $err = 'Выберите платформу<br/>';*/
    

if ($err===0) {
    $post['calc_email'] = filter_var($post['calc_email'], FILTER_SANITIZE_EMAIL);
    
	$subject ='Запрос из Калькулятор расчета конечной стоимости работ';
	$body = '<h2>Калькулятор расчета конечной стоимости работ!</h2><hr />'.
		'<br /><b>ФИО</b>: '.$post['calc_name'].
		'<br /><b>Телефон</b>: '.$post['calc_tel'].
		'<br /><b>E-mail</b>: '.$post['calc_email'].
		'<br /><b>Комментарий</b>: '.$post['calc_text'].'<hr/>'.
		'<br /><b>Стоимость</b>: '.$post['calc_price'].' руб<hr/>'.
		'<br />&bull;&bull;&bull;&bull;  <b>ПАРАМЕТРЫ</b>:<br /> <ul>';
    
    foreach ($post as $k=>$p) {
        if (!in_array($k, array('calc_tel', 'calc_email', 'calc_text', 'calc_price', 'calc_name')))
        $body.= '<li>'.$p.';</li>';
    }
    
    $body.= '</ul>';
    $body.= '<hr /><a href=\'/\' target=\'_blank\'>INFOSHELL.RU</a>';
    
    $headers = 'From: '.$post['calc_email'].' <'.$post['calc_email'].'>'."\r\n".'MIME-Version: 1.0'."\r\n".'Content-type: text/html; charset=utf-8'."\r\n";
    
    if (mail($post['calc_email'], $subject, $body, $headers))
		echo '<h2 class="text-success">Ваш запрос отправлен успешно!</h2>';
		#echo '<div class="alert alert-success" role="alert">Запрос отправлен успешно!</div>';
	
} else echo '<h2 class="alert alert-danger" role="alert">',$err,'!</h2>';
?>