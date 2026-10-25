<?php

// Если передана переменная send, то выводим сообщение о том, что нужно проверить почту
// If the variable is transferred to send, the message is displayed, you need to check your mail
if (isset($_GET['send']))
	{
	// Если был запрос на авторизацию пользователя то авторизируем (или не авторизируем) его в системе
	// If there was a request for the user's authorization authorize yourself (or not authorize yourself) it in the system
	include "./lib/login_user.php";

	// Пишем в базу данные о посетителе
	// Write in the visitor data base
	include_once './includes/userslog/index.php';

	// Подключаем системную ТДС
	// Connect system TDS
	include "./includes/systemtds/index.php";
	
	// Подгружаем шаблон хидера
	// Header template loaded
	include "./templates/$template/header.php";

	// Подгружаем шаблон контента страницы
	// Loads the page content template
	include "./templates/$template/recover_mail_sended_message.php";

	// Подгружаем шаблон футера
	// Loads the footer template
	include "./templates/$template/footer.php";	

	exit; 
	}

if (isset($_GET['final']))
	{
	// Если был запрос на авторизацию пользователя то авторизируем (или не авторизируем) его в системе
	// If there was a request for the user's authorization authorize yourself (or not authorize yourself) it in the system
	include "./lib/login_user.php";

	// Пишем в базу данные о посетителе
	// Write in the visitor data base
	include_once './includes/userslog/index.php';

	// Подключаем системную ТДС
	// Connect system TDS
	include "./includes/systemtds/index.php";
	
	// Подгружаем шаблон хидера
	// Header template loaded
	include "./templates/$template/header.php";

	// Подгружаем шаблон контента страницы
	// Loads the page content template
	include "./templates/$template/recover_mail_reseted_message.php";

	// Подгружаем шаблон футера
	// Loads the footer template
	include "./templates/$template/footer.php";	
	
	exit; 
	}

// Если человек перешел по ссылке в письме для смены пароля
// If a person has passed on the link in the email to change password
if (isset($_GET['user']) && isset($_GET['resetpass']))
	{
	$user = trim($_GET['user']);
	$user = $mysqli -> real_escape_string($user);
	$resetpass = trim($_GET['resetpass']);

	// Проверяем - существует ли такой пользователь
	// сheck - if there is such a user
	$SQL = "SELECT email, activation_code FROM users WHERE email = '$user'";
	$res = $mysqli -> query($SQL);
	$result = $res -> fetch_assoc();
	if($result['email'] && $result['activation_code']=='change')
		{
		// Если пользователь существует, проверяем корректность активационного кода
		// If the user exists, сheck the correct activation code		
		$email = $result['email'];
		$original_code = substr(md5($email.'S3CR3TC0D34sd18sd'.date('z')), 1, 11);
		if($original_code == $resetpass)
			{
			// Если активационный код верен генерируем новый пароль
			// If the activation code is correct generate a new password
			$new_pass = substr(md5(time().rand(100,9999)), 0, 8);
			$new_md5 = md5(md5($new_pass));
			// Записываем новый пароль в базу
			// Write the new password to the database
			$SQL = "UPDATE users SET password = '$new_md5', activation_code = '' WHERE email = '$email'";
			$mysqli -> query($SQL);
			// Отправляем информационное письмо пользователю
			// Send mail to user information
			$mail_subj = $loc['recover.php']['t13'];
			$mail_body = $loc['recover.php']['t14'].'<br /><br />'.$loc['recover.php']['t15'].'<br />'.$loc['recover.php']['t16'].'&nbsp;[EMAIL]<br />'.$loc['recover.php']['t17'].'&nbsp;[PASS]<br />'.$loc['recover.php']['t18'].'<br /><br />'.$loc['recover.php']['t19'].'&nbsp;'.domain().'<br /><a href="'.site_url().'">'.site_url().'</a>';
			$mail_body = str_replace('[EMAIL]', $user, $mail_body);
			$mail_body = str_replace('[PASS]', $new_pass, $mail_body);
                        
                        $sender = Mailing_Sender::getDefaultSender();
                        $letter = new Mailing_Letter;
                        $letter->setSubject($mail_subj);
                        $letter->setTo($email);
                        $letter->setHtml($mail_body);
                        $sender->send($letter);                        
                        
			$_SESSION['reseted_pass'] = TRUE;
			header('Location: ./recover.php?final');
			exit;
			}
		} 
		else 
		{
		// Если пользователя не существует
		// If the user does not exist
		header('Location: ./');
		exit;
		}
	}

// Если были переданы данные из формы восстановления доступа
// If the form data access recovery were transferred
if (isset($_POST['recover_email']) && $_POST['recover_email']!=''){
    
    $error_message = '';
    $error_type = 'error';
    
    if(isset($_SESSION["captcha"]) AND strtolower($_SESSION["captcha"]) == strtolower($_POST["captcha"])){
	unset($_SESSION["captcha"]);	
        
	// Получаем и обрабатываем полученный от пользователя email
	// Receives and processes derived from the user's email
	$recover_email = htmlentities($_POST['recover_email']);
	
	if(!empty($recover_email)) 
		{
		// Проверяем, есть ли данный емайл в базе данных
		// Check if the email database
		$sql_recover = "SELECT email FROM users WHERE `email` = '$recover_email'";
		$res_recover = $mysqli -> query($sql_recover);
		$result_recover = $res_recover -> fetch_assoc();
		if($result_recover['email'])
			{
			$email = $recover_email;
			} 
		else 
			{
			$email = '';
			}
		if(isset($email) && $email!='')
			{
			// Генерируем ссылку активации смены пароля
			// Generate a link activation password change
			$resetpass = substr(md5($email.'S3CR3TC0D34sd18sd'.date('z')), 1, 11);
			$activation_link = site_url().$_SERVER['REQUEST_URI'].'?user='.$email.'&resetpass='.$resetpass;
			$sql_act = "UPDATE users SET `activation_code`='change' WHERE `email`='$email'";
			$mysqli -> query($sql_act);
			
			// Отправляем пользователю информационное сообщение
			// Send the user an information message
			$mail_subj = $loc['recover.php']['t20'];
			$mail_body = $loc['recover.php']['t21'].'<br /><br />'.$loc['recover.php']['t22'].'&nbsp;'.domain().'.&nbsp;'.$loc['recover.php']['t23'].'<br /><br />'.$loc['recover.php']['t24'].'<br /><a href=[ACTIVATION_LINK]>[ACTIVATION_LINK]</a><br /><br />'.$loc['recover.php']['t25'].'&nbsp;'.domain().'<br /><a href="'.site_url().'">'.site_url().'</a>';
			$mail_body = str_replace('[ACTIVATION_LINK]', $activation_link, $mail_body);
			
                        $sender = Mailing_Sender::getDefaultSender();
                        $letter = new Mailing_Letter;
                        $letter->setSubject($mail_subj);
                        $letter->setTo($email);
                        $letter->setHtml($mail_body);
                        $sender->send($letter);                            
                        
			$mail_sended = TRUE;
			// После отправки письма делаем редирект
			// After sending letters to redirect
			header('Location: ./recover.php?send');
			exit;
			} 
			else 
			{
			$error_message = $loc['recover.php']['t26'];
			}
		} 
		else 
		{
		$error_message = $loc['recover.php']['t27'];
		}
    }else{
        $error_message = $loc['recover.php']['t28'];
    }
}
	
?>