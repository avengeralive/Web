<?php

header('Location: https://www.apic.ru/contact/ras/');
exit();


//exit('<a href="/">www.apic.ru</a>');

//require_once('init.php');
$is_index = false;
$title = "Подписка на рассылку АПИК";
?>
<?php /* ?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
</head>
<?php */ ?>
<?php
 //require_once ("header.php");
 require_once ("head.php");
?>
     <h1>Подписка на рассылку Ассоциации предприятий индустрии климата</h1>
      <table width="96%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td background="<?= $siteRoot ?>/images/background_dots_horizontal.gif"><img src="<?= $siteRoot ?>/images/tp.gif" alt="" width="1" height="1" border="0"></td>
        </tr>
      </table>
<p>Уважаемые господа!</p>

<p>Здесь Вы можете подписаться на новостную рассылку АПИК. С периодичностью 1 раз в 2 недели мы будем присылать Вам:</p>

<ul>
<li>Информацию о выходе журнала «Мир Климата» со ссылками на все статьи;</li> 
<li>Информацию и  ссылки на материалы новых курсов Учебного центра АПИК;</li>
<li>Результаты маркетинговых исследований;</li>
<li>Новости компаний-членов АПИК;</li>
<li>Приглашения и информацию о выставке «Мир Климата»;</li>
</ul>

<?php
if(!empty($mail))
{
 include("head.php");
 
 $sql='select id_m from r_mail where mail="'.$mail.'"';
 $tmp=mysql_query($sql);
 $tmp=mysql_result($tmp,0,0);
 
 if(!empty($tmp)) echo '<br /><h2>Такой адрес уже есть в базе</h2>';
 else
 {
	    $sql='select max(id_m) from r_mail';
		$id=mysql_query($sql);
		$id=mysql_result($id,0,0);
		$id++;
		
		$sql='insert into r_mail values('.$id.',"'.$mail.'",0)';
		mysql_query($sql);
		
		
		echo "<br /><h2>Адрес успешно добавлен! Вам отправлено письмо для подтверждения участия в рассылке!</h2>";
		
		$eol="\n";

$from="Рассылка АПИК <subscribe@apic.ru>";
$subject="Подтверждение участия в рассылке АПИК ".$dt;

$inc_path="/home/u42313/apic.ru/www/";

$f_name=$inc_path."tmp_ras/approve.html";

$handle=fopen($f_name, 'r'); 
$b_contents=fread($handle, filesize($f_name)); 
fclose($handle); 

$headers .= 'From: Рассылка АПИК <subscribe@apic.ru>'.$eol; 
$headers .= 'Reply-To: Рассылка АПИК <subscribe@apic.ru>'.$eol; 
$headers .= 'Return-Path: Рассылка АПИК <subscribe@apic.ru>'.$eol;
$headers .= "Message-ID: <".time()." TheSystem@".$_SERVER['SERVER_NAME'].">".$eol; 
$headers .= "X-Mailer: PHP v".phpversion().$eol;          

$mime_boundary=md5(time()); 
$headers .= 'MIME-Version: 1.0'.$eol; 
$headers .= "Content-Type: multipart/related; boundary=\"".$mime_boundary."\"".$eol; 
$msg = ""; 

$msg .= "--".$mime_boundary.$eol; 
$msg .= "Content-Type: text/html; charset=windows-1251; name=\"apic.html\"".$eol; 
$msg .= "Content-Transfer-Encoding: 8bit".$eol; 
$msg .= "Content-Disposition: attachment; filename=\"apic.html\"".$eol.$eol;


ini_set(sendmail_from,'subscribe@apic.ru');  


	$code=$mail;
	$code=md5($code);
	$uid=$id;
	$text='<br /><p><a href="http://www.apic.ru/ras/index.php?uid='.$uid.'&code='.$code.'">Подтвердить участие в рассылке</a></p><br /><p><a href="http://www.apic.ru/ras/uns.php?uid='.$uid.'&code='.$code.'">Отказаться от рассылки</a></p></body></html>';
    	
	$msg1 = $b_contents.$text.$eol.$eol;
    $msg1 .= "--".$mime_boundary."--".$eol.$eol;
    
    $fmsg =$msg.$msg1;
 
	mail($mail, $subject, $fmsg, $headers);  	 
 
ini_restore(sendmail_from); 	
	
	
	$mail="";
	$uid="";
	$code="";		 
} 
}

if(!empty($uid))
{
 $sql='select mail from r_mail where id_m='.$uid;
$mail=mysql_query($sql);
$mail=mysql_result($mail,0,0);

$t_mail=$mail;
$mail=md5($mail);

if($mail==$code)
{
		$sql='update r_mail set type=1 where id_m='.$uid;
		mysqL_query($sql);
		
		echo "<br /><h2>Адрес ".$t_mail." был успешно добавлен в рассылку</h2>";
		
}
$mail="";	
}


?>

<br /><p>
<form action="http://www.apic.ru/ras/" method="post" enctype="multipart/form-data" name="form1">
Введите E-mail
<input class="tabin" name="mail" type="text" id="mail" width="100" value="<?php echo $mail; ?>">
<input type="submit" name="Submit" value="Подтвердить">
</form> 
</p>

	 
	
	 
	 
      <p>&nbsp;</p>
      <p>
          <?php
require_once ("footer.php");
?>
            </p>
