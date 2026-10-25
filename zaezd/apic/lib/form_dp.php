<?php
$inc_path=$_SERVER['DOCUMENT_ROOT']."/";
include($inc_path."lib/head.php");
include($inc_path."lib/JsHttpRequest.php");
$JsHttpRequest =& new JsHttpRequest("windows-1251");

$from_mail='Climatexpo <request@climatexpo.ru>';

$day[0]=stripslashes($_POST["day0"]);
$day[1]=stripslashes($_POST["day1"]);
$day[2]=stripslashes($_POST["day2"]);
$day[3]=stripslashes($_POST["day3"]);
$day[4]=stripslashes($_POST["day4"]);
$day[5]=stripslashes($_POST["day5"]);
$day[6]=stripslashes($_POST["day6"]);
$day[7]=stripslashes($_POST["day7"]);
$day[8]=stripslashes($_POST["day8"]);
$day[9]=stripslashes($_POST["day9"]);
$day[10]=stripslashes($_POST["day10"]);
$day[11]=stripslashes($_POST["day11"]);
$day[12]=stripslashes($_POST["day12"]);
$day[13]=stripslashes($_POST["day13"]);
$day[14]=stripslashes($_POST["day14"]);
$day[15]=stripslashes($_POST["day15"]);
$day[16]=stripslashes($_POST["day16"]);
/*$day[17]=stripslashes($_POST["day17"]);*/
$city=stripslashes($_POST["city"]);
$company=stripslashes($_POST["company"]);
$name=stripslashes($_POST["name"]);
$position=stripslashes($_POST["position"]);
$phone=stripslashes($_POST["phone"]);
$mail=stripslashes($_POST["mail"]);

$days_str[]="1-й день Конгресса «ЭНЕРГОЭФФЕКТИВНОСТЬ. XXI ВЕК. Инженерные методы снижения энергопотребления зданий»";
$days_str[]="Пленарное заседание";
$days_str[]="Официальное открытие VI Международного конгресса. Выступление председателя оргкомитета.";
$days_str[]="Панельная дискуссия: «Повышение Энергоэффективности объектов недвижимости в России»";
$days_str[]="Общественное обсуждение Стандартов в области водоснабжения и канализации";
$days_str[]="Обсуждение редакций документов: «Требования по составу и содержанию энергетического паспорта проекта жилого и общественного здания», «Разработка Методики расчета жизненного цикла жилого здания с учетом стоимости совокупных затрат»";
$days_str[]="Круглый стол:  «Способы снижения энергопотребления системами отопления, вентиляции и кондиционирования воздуха»";
$days_str[]="2-й день Конгресса «ЭНЕРГОЭФФЕКТИВНОСТЬ. XXI ВЕК. Инженерные методы снижения энергопотребления зданий»";
$days_str[]="Заседание Комитетов НОП, НОСТРОЙ";
$days_str[]="Общественное обсуждение профессионального стандарта «Монтажник систем вентиляции и кондиционирования воздуха»";
$days_str[]="Общественное обсуждение профессионального стандарта «Монтажник оборудования котельных»";
$days_str[]="3-й день Конгресса «ЭНЕРГОЭФФЕКТИВНОСТЬ. XXI ВЕК. Инженерные методы снижения энергопотребления зданий»";
$days_str[]="СЕКЦИЯ: «Перспективы развития рынка HVAC&R в 2014г.»";
$days_str[]="СЕКЦИЯ: «Энергоэффективные решения от производителей систем ОВК»";
$days_str[]="Проект «Верификация»: Методика оценочного расчета тепловых параметров применительно к различным типам климатического оборудования";
$days_str[]="Представление участниками выставки нового оборудования и технических решений";
$days_str[]="Все 3 дня";

$days_inner=array(0,1,2,3,4,5,6,0,8,9,10,0,12,13,14,0,0);


if(!empty($fsub))
{

		if(!empty($name) && !empty($company) && !empty($city) && !empty($mail) && (!empty($day[0]) || !empty($day[1]) || !empty($day[2]) || !empty($day[3]) || !empty($day[4]) || !empty($day[5]) || !empty($day[6]) || !empty($day[7]) || !empty($day[8]) || !empty($day[9]) || !empty($day[10]) || !empty($day[11]) || !empty($day[12]) || !empty($day[13]) || !empty($day[14]) || !empty($day[15]) || !empty($day[16])))
		{
		    for($i=0;$i<count($days_str);$i++)
            {
                if(!empty($day[$i])) $days.=$days_str[$i]."\n";    
            }
            
			$sql='insert into match_dp_request values (NULL,"'.addslashes($city).'","'.addslashes($company).'","'.addslashes($name).'","'.addslashes($position).'","'.addslashes($mail).'","'.addslashes($phone).'","'.addslashes($days).'")';
			mysql_query($sql);
            
            $id_tick=mysql_insert_id();

			$datestr=date("(H:i) d.m.Y");
            $eol="\n";

			$subject="Заявка на участие в Деловой программе выставки с сайта climatexpo.ru";

			$headers = 'From: '.$from_mail.$eol;
        	$headers .= 'Reply-To: '.$from_mail.$eol;
        	$headers .= 'Return-Path: '.$from_mail.$eol;
			$headers .= "Message-ID: <".time()." TheSystem@".$_SERVER['SERVER_NAME'].">".$eol;
			$headers .= "X-Mailer: PHP v".phpversion().$eol;

			$mime_boundary=md5(time());
			$headers .= 'MIME-Version: 1.0'.$eol;
			$headers .= "Content-Type: multipart/related; boundary=\"".$mime_boundary."\"".$eol.$eol;

			$htext='<html><head><title>Заявка на участие в Деловой программе выставки с сайта climatexpo.ru</title>
            <meta http-equiv=content-Type content="text/html; charset=windows-1251">
            <style type="text/css"><!--
            * {
            margin: 5px;
            padding: 0;
            border: 0;
            font: 12px "Tahoma";
            }
            p, div {
            color: #000;
            }
            p{
            margin: 7px 0px 7px 0;
            padding: 7px 0px 7px 0;
            text-align: justify;
            }
            p a, ul a, table a {
            color: #00529c;
            text-decoration: underline;
            }
            p a:hover, ul li a:hover, table a:hover {
            text-decoration: none;
            }
            ul {
            margin: 0px 0px 0px 40px;
            list-style-type: square;
            }
            h1 {
            font: bold 16px "Tahoma";
            color: #00529c;
            margin: 15px 0 15px 0;
            }
            h2 {
            font: bold 14px "Tahoma";
            color: #00529c;
            margin: 15px 0 15px 0;
            }
            h2 a {
            color: #00529c;
            text-decoration: underline;
            }
            h2 a:hover {
            color: #00529c;
            text-decoration: none;
            }
            h3 {
            font: bold 12px "Tahoma";
            color: #00529c;
            margin: 10px 0 5px 0;
            }
            hr {
            width: 97%;
            height: 1px;
            background: #fff;
            border-bottom: 1px solid #000;
            margin: 7px auto 7px auto;
            }
            img {
            margin: 0px 0px 0px 0px;
            padding:  10px 40px 0px 10px;
            }
            //--></style></head><body>';
            $utext='<h2>Вы успешно зарегистрированы для участия в Деловой Программе климатической выставки «Мир Климата - 2013», которая пройдет с 11 по 14 марта 2013г.</h2><h3>Ваши данные:</h3>';
			$text='<TABLE WIDTH="80%"  BORDER="0" CELLSPACING="0" CELLPADDING="0">
              <TR VALIGN="TOP">
				<TD WIDTH="30%" CLASS="DOT2"><B>Код заявки</B></TD>
				<TD WIDTH="70%" CLASS="DOT2">'.$id_tick.'</TD>
			  </TR>
               <TR VALIGN="TOP">
				<TD CLASS="DOT2"><B>Дни</B></TD>
				<TD CLASS="DOT2">'.nl2br($days).'</TD>
			  </TR>
			  <TR VALIGN="TOP">
				<TD CLASS="DOT2"><B>Город</B></TD>
				<TD CLASS="DOT2">'.$city.'</TD>
			  </TR>
              <TR VALIGN="TOP">
				<TD CLASS="DOT2"><B>Название компании</B></TD>
				<TD CLASS="DOT2">'.$company.'</TD>
			  </TR> 
              <TR VALIGN="TOP">
				<TD WIDTH="30%" CLASS="DOT2"><B>Ф.И.О.</B></TD>
				<TD WIDTH="70%" CLASS="DOT2">'.$name.'</TD>
			  </TR>
               <TR VALIGN="TOP">
				<TD WIDTH="30%" CLASS="DOT2"><B>Должность</B></TD>
				<TD WIDTH="70%" CLASS="DOT2">'.$position.'</TD>
			  </TR>
			  <TR VALIGN="TOP">
				<TD CLASS="DOT2"><B>Электронная почта</B></TD>
				<TD CLASS="DOT2"><A HREF="mailto:'.$mail.'" CLASS="LE">'.($mail).'</A></TD>
			  </TR>
              <TR VALIGN="TOP">
				<TD WIDTH="30%" CLASS="DOT2"><B>Телефон</B></TD>
				<TD WIDTH="70%" CLASS="DOT2">'.$phone.'</TD>
			  </TR>
			</TABLE>
			</BODY>
			</HTML>';

			$msg  = "--".$mime_boundary.$eol;
			$msg .= "Content-Type: text/html; charset=windows-1251;".$eol;
			$msg .= "Content-Transfer-Encoding: 8bit".$eol;
			$msg .= "Content-Disposition: inline;".$eol.$eol;
			$msg .= $htext.$text.$eol.$eol;
			$msg .= "--".$mime_boundary."--".$eol.$eol;
            
            $umsg  = "--".$mime_boundary.$eol;
			$umsg .= "Content-Type: text/html; charset=windows-1251;".$eol;
			$umsg .= "Content-Transfer-Encoding: 8bit".$eol;
			$umsg .= "Content-Disposition: inline;".$eol.$eol;
			$umsg .= $htext.$utext.$text.$eol.$eol;
			$umsg .= "--".$mime_boundary."--".$eol.$eol;

			ini_set(sendmail_from,'request@climatexpo.ru');

			//$email=iconv('UTF-8', 'cp1251', $email);
			//$subject=iconv('UTF-8', 'cp1251', $subject);
			$subject = "=?windows-1251?B?".base64_encode($subject)."?=";
			//$msg=iconv('UTF-8', 'cp1251', $msg);
			//$headers=iconv('UTF-8', 'cp1251', $headers);

            //$email[]="pkaplin@apic.ru";
            //$email[]="mk@apic.ru";
            //$email[]="lighty@lighty.ru";
			$email[]="wser@ya.ru";
			$email[]="climatexpo@apic.ru";

            //$email[]="ekaterinak@avoknw.ru";
            //if(!empty($day[8]) || !empty($day[9])) $email[]="avk@unido-russia.ru";
            //if(empty($day[8]) || count($day)>1) $email[]="ekaterinag@avoknw.ru";
 //$email[]="avk@apic.ru";
 //$email[]="climat@euroexpo.ru";
           //$email[]="orekhov@euroexpo.ru";
            //$email[]="anton_light@tut.by";

			foreach($email as $to)
		 	{
			//	$q.=$to;
                mail($to, $subject, $msg, $headers);
		 	}	
            
            mail($mail, $subject, $umsg, $headers);
			
            ini_restore(sendmail_from);



            	$msg = '<p><strong>Вы зарегистрировались как участник Деловой программы выставки "Мир Климата 2013". Для Вашего удобства, ближе к началу мероприятия на указанный Вами E-mail будет выслано подробное расписание Деловой программы.</strong></p>';
               

			$q.=$msg;
			//unset($fphone,$fmail,$fname,$fmore,$furl);
			//$q.='<META HTTP-EQUIV="Refresh" CONTENT="10;">';
		}
		else
		{
            unset($fsub);
			$errmsg="Не заполнены обязательные поля";
		}

}

if(empty($fsub))
{
if(!empty($errmsg)) $q.='<p style="color:red;">'.$errmsg.'</p>';
$q.='<form method="post" enctype="multipart/form-data" id="qf" class="order-form">';
$q.='<input name="fsub" type="hidden" value="1" />';

$q.='<p><strong>Выбор дня деловой программы:<span class="ast"> * </span></strong></p><div class="row">';
for($i=0;$i<count($days_str);$i++)
{
 if($day[$i]==1) $check=" checked";
 else $check="";  
 if(!empty($days_inner[$i])) $q.="&nbsp;&nbsp;&nbsp;";
 elseif($i==0) $q.='<strong>';
 else  $q.='<br /><strong>';
 $q.='<input id="ref" type="checkbox" name="day'.$i.'" value="1"'.$check.' />'.$days_str[$i].'<br />';
 if(empty($days_inner[$i])) $q.="</strong><br />";
}
$q.='</div>';

$q.='<div class="row"><label for="x">Город<span class="ast"> * </span></label>';
$q.='<input id="i1" name="city" value="'.$city.'" type="text" /></div>';

$q.='<div class="row"><label for="x">Название компании<span class="ast">&nbsp;*&nbsp;</span></label>';
$q.='<input id="i1" name="company" class="ina" value="'.$company.'" type="text" /></div>';

$q.='<div class="row"><label for="x">Ф.И.О.<span class="ast"> * </span></label>';
$q.='<input id="i1" name="name" class="ina" value="'.$name.'" type="text" /></div>';

$q.='<div class="row"><label for="x">Должность</label>';
$q.='<input id="i1" name="position" class="ina" value="'.$position.'" type="text" /></div>';

$q.='<div class="row"><label for="x">E-Mail<span class="ast"> * </span></label>';
$q.='<input id="i1" name="mail" class="ina" value="'.$mail.'" type="text" /></div>';

$q.='<div class="row"><label for="x">Контактный телефон</label>';
$q.='<input id="i1" name="phone" class="ina" value="'.$phone.'" type="text" /></div>';


$q.='<div><input class="button" value="Отправить" type="button" onclick="doLoad(document.getElementById(\'qf\',0))" /></div>';
$q.='</form>';


}

$GLOBALS['_RESULT'] = $q;
?>