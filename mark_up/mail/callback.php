<?php

session_start();

header("Content-type: application/json; charset=utf-8");

require 'amocrm.php';
require_once 'PHPMailer/class.smtp.php';
require_once 'PHPMailer/class.phpmailer.php';

$field_data = $_POST;
$client_id = isset($_COOKIE['_ym_uid']) ? $_COOKIE['_ym_uid'] : 0;
$attachment = !empty($_FILES['upload']) ? $_FILES['upload'] : null;

if (empty($field_data['name']) || strlen($field_data['name']) < 5) {
    echo json_encode(array(
        'result' => false,
        'msg' => 'Поле "Как к вам обращаться" должно быть заполнено и содержать не менее 5 символов'
    ));
    die;
}

if (empty($field_data['comment']) || strlen($field_data['comment']) < 10) {
    echo json_encode(array(
        'result' => false,
        'msg' => 'Поле "Комментарий к заказчику" должно быть заполнено и содержать не менее 10 символов'
    ));
    die;
}

if (!filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL)) {
    echo json_encode(array(
        'result' => false,
        'msg' => 'Поле "Введите ваш email адрес" должно быть корректным email адресом'
    ));
    die;
}

$amo = new Amo();
$id = $amo->createLead();
if ($id != 0) {
    $amo->addCallback(
        $id, 
        $client_id,    
        $field_data['platform'], 
        $field_data['project_stage'], 
        $field_data['field_company'],
        $field_data['budget'],
        $field_data['name'], 
        $field_data['email'],
        $field_data['comment'],
        $field_data['post']    
    );
    
    $amo->addNote($id, $field_data['comment']);
}

/** Подгружаем шаблон письма */
ob_start();

include_once 'templates/callback.php';

$content = ob_get_contents();

ob_end_clean();


/**
 * todo: cross versions
 * Инициализация библиотеки для отправки письма на почту
 */

$to = 'order@infoshell.ru';
//$to = 'web-mastack@yandex.ru';
$subject = 'Заказ обратного звонка';

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

/** Если есть вложения, то прикрепляем к письму */
if ($_FILES['attachment']['size'] > 0) {
    $file_name = basename($_FILES['attachment']['name']);
    move_uploaded_file($_FILES["attachment"]["tmp_name"], "temp/" . $file_name);
    $email->AddAttachment("temp/" . $file_name, $file_name);
}

/** Отправляем письмо на почту */
if ($email->send()) {
    echo json_encode(array('result' => true, 'msg' => 'Заявка успешно отправлена'));
} else {
    http_response_code(500);
    echo json_encode(array('result' => false, 'msg' => 'Неудалось отправить заявку'));
}

