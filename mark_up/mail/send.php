<?php
session_start();
	if(isset($_POST['name'])){$name=$_POST['name'];}else{$name="";}
	if(isset($_POST['email'])){$email=$_POST['email'];}else{$email="";}
	if(isset($_POST['phone'])){$phone=$_POST['phone'];}else{$phone="";}
    if(isset($_POST['time'])){$time=$_POST['time'];}else{$time="";}
	if(isset($_POST['vacancy_name'])){$vacancy_name=$_POST['vacancy_name'];}else{$vacancy_name="";}
    if(isset($_POST['type'])){$type=$_POST['type'];}else{$type="";}
	if(isset($_POST['message'])){$message=$_POST['message'];}else{$message="";}
    if(isset($_POST['ymparam'])){$ymparam=$_POST['ymparam'];}else{$ymparam="";}

 if ( isset($_SESSION['smo_utm_source']) ) {
 	$utmSource = $_SESSION['smo_utm_source'];
 }	else {
 	$utmSource = "";
 }

 if ( isset($_SESSION['smo_utm_medium']) ) {
 	$utmMedium = $_SESSION['smo_utm_medium'];
 }	else {
 	$utmMedium = "";
 }

 if ( isset($_SESSION['smo_utm_campaign']) ) {
 	$utmCampaign = $_SESSION['smo_utm_campaign'];
 }	else {
 	$utmCampaign = "";
 }

 if ( isset($_SESSION['smo_utm_content']) ) {
 	$utmContent = $_SESSION['smo_utm_content'];
 }	else {
 	$utmContent = "";
 }

 if ( isset($_SESSION['smo_utm_term']) ) {
 	$utmTerm = $_SESSION['smo_utm_term'];
 }	else {
 	$utmTerm = "";
 }

	require 'PHPMailer/PHPMailerAutoload.php';
	//require 'amocrm.php';
	

	
if ($email != '' ||  $phone != '') {
	/*
	$title="Заказать звонок";
    if($type == 1) $title   = 'Заказ звонка';
    if($type == 3) $title = 'Резюме: ' . $vacancy_name;
	*/
	$email1=$email;
	$comments=$message;	
	include($_SERVER['DOCUMENT_ROOT'].'/amocrm/amocrm_api.php');
	
	
/*
    $amo = new Amo();
    $id = $amo->createLead();

    if ($id != 0) {

        $amo->addContact($id, $name, $phone, $email);

        if ($message != '') {
            $amo->addNote($id, $message);
        }

    }
*/




}

	$htmlBody="
	<table>
		<tr>
			<td>Имя:</td>
			<td>".$name."</td>
		</tr>";

    if($email) $htmlBody .= "<tr>
			<td>Email:</td>
			<td>".$email."</td>
		</tr>";

    if($phone) $htmlBody .= "<tr>
			<td>Телефон или e-mail:</td>
			<td>".$phone."</td>
		</tr>";

    if($vacancy_name) $htmlBody .= "<tr>
			<td>Название вакансии:</td>
			<td>".$vacancy_name."</td>
		</tr>";

    if($time) $htmlBody .="<tr>
			<td>Время для звонка:</td>
			<td>".$time."</td>
		</tr>";

    $htmlBody .= "<tr>
			<td>Сообщение:</td>
			<td>".$message."</td>
		</tr>";

 if ($utmSource) {
    	$htmlBody .= "<br><tr><td>Клиент переходил по рекламному объявлению.</td></tr>";

    	    if ($utmSource) $htmlBody .= "<tr>
			<td>Источник кампании:</td>
			<td>".$utmSource."</td>
		</tr>";

   	    if ($utmMedium) $htmlBody .= "<tr>
			<td>Тип трафика:</td>
			<td>".$utmMedium."</td>
		</tr>";

   	    if ($utmCampaign) $htmlBody .= "<tr>
			<td>Название кампании:</td>
			<td>".$utmCampaign."</td>
		</tr>";

   	    if ($utmContent) $htmlBody .= "<tr>
			<td>Идентификатор объявления:</td>
			<td>".$utmContent."</td>
		</tr>";

   	    if ($utmTerm) $htmlBody .= "<tr>
			<td>Ключевое слово:</td>
			<td>".$utmTerm."</td>
		</tr>";
    }

$htmlBody .= "</table>";

    $pos = strripos($_SERVER['HTTP_REFERER'], "?");
    $pos1 = strripos($_SERVER['HTTP_REFERER'], "resault=1");

    $ref = $_SERVER['HTTP_REFERER'];

    if($pos === false){$pre="?";}else{$pre="&";}
    if($pos1 === false){
        //http://new.infoshell.ru/project/malysharij?mailsuccess=1&ymparam=CALL_US_TOPALL_US_TOPCALL_US_TOPefault

        if(preg_match('/ymparam=([^&]+)/imsu', $ref))
        {
            $ref = preg_replace('/ymparam=([^&]+)/imsu', 'ymparam='.$ymparam, $ref);
            $link = $ref;

        }else{
            $link = $ref . "" . $pre . "mailsuccess=1&ymparam=$ymparam";
        }

    }else{$link=$_SERVER['HTTP_REFERER'];}

	$email = new PHPMailer();
	$email->CharSet = 'UTF-8';
	$email->From      = 'job@infoshell.mobi';
	
	$email->Mailer = 'smtp';
	$email->Host = 'smtp.yandex.ru';
	$email->Port = 465;
	$email->SMTPSecure = 'ssl';
	$email->SMTPAuth = true;
	$email->Username = 'job@infoshell.mobi';
	$email->Password = 'dZ67CBLh';
		
	$email->FromName  = 'infoshell.ru';
	$email->Subject   = 'Заявка';
    if($type == 1) $email->Subject   = 'Заказ звонка';

    if($type == 3) $email->Subject   = 'Резюме: ' . $vacancy_name .' ['. time() . rand(0,9999) .']';
	$email->Body = $htmlBody;
	$email->isHTML(true);
	if($type == 3) {
		$email->AddAddress('job@infoshell.ru'); //!!!!!
	}else
    if(preg_match('/startup/imsuU', $link))
        $email->AddAddress('startup@infoshell.ru');
	else
        $email->AddAddress('order@infoshell.ru');
	
	
	//$email->AddAddress( 'maddocs@yandex.ru' );

	if ($_FILES['upload_file']['size'] > 0) {
		$file_name=basename($_FILES['upload_file']['name']);
		move_uploaded_file($_FILES["upload_file"]["tmp_name"], "temp/" .$file_name);
		$email->AddAttachment( "temp/".$file_name , $file_name );
	}
	
if ( !empty($_POST['name']) ) {
	$email->Send();
}
		
	if (isset($file_name)&&file_exists("temp/".$file_name)) {
		unlink("temp/".$file_name);
	}
	


	header("Location: ".$link);	
?>