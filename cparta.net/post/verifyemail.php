<?php
@session_start();

include dirname(__FILE__) . '/../includes/config.php';
include dirname(__FILE__) . '/../includes/auth/index.php';

if (!isset($user_id)){
    Header ('Location: /');	
    exit;
}

$user = User::getById($user_id);

if(!$user){
    if (isset($_GET['user_authhash'])) {
        $user = User::getByApiKey($_GET['user_authhash']);
        if($user){
            $user->update([
                'email_check' => 1        
            ]);
            Header ('Location: /cabinet.php');	
            exit();
        }
        else {
            Header ('Location: /');	
            exit();
        }
    }
    else {
        Header ('Location: /');	
        exit();
    }
}

if (isset($_GET['user_authhash'])) {
    $user->update([
        'email_check' => 1        
    ]);
    Header ('Location: /cabinet.php');	
    exit();
}

if (isset($_REQUEST['mode'])) {
    $mail_subj = 'Подтверждение адреса электронной почты';
	$mail_body = 'Здравствуйте!<br /><br />Для подтверждения почты пройдите по <a href="https://cparta.net/post/verifyemail.php?user_authhash='.$user_apikey.'">этой ссылке</a>';			
    $from_email = "info@cparta.net";
	$mail_headers = '';
	$mail_headers .= "MIME-Version: 1.0\r\n";
	$mail_headers .= "Content-type: text/html; charset=utf-8\r\n";
	$mail_headers .= "From: $from_email\r\n";
	//$mail_headers .= "Reply-To: $from_email\r\n";
	//$mail_headers .= "Return-Path: $from_email\r\n";
	$mail_headers .= "X-Mailer: PHP/".phpversion();
    $res = mail($user_email, $mail_subj, $mail_body, $mail_headers);
    //var_dump($res);
    Header ('Location: /cabinet.php');	
    exit();
}