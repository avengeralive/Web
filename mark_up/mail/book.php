<?php

session_start();

header("Content-type: application/json; charset=utf-8");

require 'amocrm.php';
require_once 'PHPMailer/class.smtp.php';
require_once 'PHPMailer/class.phpmailer.php';

$field_data = $_POST;

if (!filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL)) {
    echo json_encode(array('msg' => 'Не верный формат почтового ящика', 'result' => false));
    die;
}

$file_name = basename('upload/product_thinking.pdf');

if (!$file_name) {
    echo json_encode(array('msg' => 'Файл вложения не найден', 'result' => false));
    die;
}

$to = $field_data['email'];
$subject = 'Продуктовое мышление от Infoshell';
$content = "Здравствуйте! Как и обещали, отправляем вам книгу \"Продуктовое мышление\". Совершенствуйтесь и делайте крутой продукт! Удачи!" ;

$email = @new PHPMailer(true);
//$email->SMTPDebug = 1;
$email->Mailer = 'smtp';
        
$email->CharSet = 'UTF-8';
$email->From = 'job@infoshell.mobi';
$email->Host = 'smtp.yandex.ru';
$email->Port = 465;
$email->SMTPSecure = 'ssl';
$email->SMTPAuth = true;
$email->Username = 'job@infoshell.mobi';
$email->Password = 'Jj1111111';
$email->FromName = 'infoshell.ru';
$email->Subject = $subject;
$email->AddAddress($to);
$email->MsgHTML($content);
$email->AddAttachment("upload/" . $file_name, $file_name);

/** Отправляем письмо на почту */
if ($email->send()) {
    $amo = new Amo();
    $id = $amo->createLeadEx($to, 2099563, 30191650);
    
    if ($id) {
        $amo->addProductThinking($id, $to);
    }
    
    echo json_encode(array('result' => true));
} else {
    http_response_code(500);
    echo json_encode(array('result' => false, 'msg' => 'Не удалось отправить форму'));
}