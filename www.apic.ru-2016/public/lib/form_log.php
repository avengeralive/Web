<?php
$inc_path=$_SERVER['DOCUMENT_ROOT']."/";
include($inc_path."config/head.php");
include($inc_path."lib/func.php");
include($inc_path."lib/JsHttpRequest.php");
$JsHttpRequest =& new JsHttpRequest("utf-8");

$from_name='Apic.ru';
$from_mail='subscribe@apic.ru';

$fsub=stripslashes($_POST["fsub"]);
$name=stripslashes($_POST["name"]);
$company=stripslashes($_POST["company"]);
$phone=stripslashes($_POST["phone"]);
$mail=stripslashes($_POST["mail"]);
$quest=stripslashes($_POST["quest"]);

if(!empty($fsub))
{
		if(!empty($name) && !empty($company) && !empty($phone) && !empty($mail) && !empty($quest))
		{
			/*
			$sql='insert into apic_log values (NULL,"'.addslashes($name).'","'.addslashes($company).'","'.addslashes($phone).'","'.addslashes($mail).'","'.addslashes($quest).'")';
			mysql_query($sql);
            $id_tick=mysql_insert_id();
			*/
            $id_tick=100*rand();
         
            $tid_tick=$id_tick;
            $id_tick+=100000;
            
			$htext='<html><head><title>Вопрос логистической службе apic.ru</title>
            <meta http-equiv=content-Type content="text/html; charset=utf-8">
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
          
            $utext='<h2>Спасибо за Ваш вопрос! Мы постараемся ответить на него как можно скорее!</h2><h2><h3>Ваши данные:</h3>';
			$text='<TABLE WIDTH="80%"  BORDER="0" CELLSPACING="0" CELLPADDING="0">
              <TR VALIGN="TOP">
				<TD WIDTH="30%" CLASS="DOT2"><B>Код вопроса</B></TD>
				<TD WIDTH="70%" CLASS="DOT2">'.$id_tick.'</TD>
			  </TR>
			  <TR VALIGN="TOP">
				<TD WIDTH="30%" CLASS="DOT2"><B>Ф.И.О.</B></TD>
				<TD WIDTH="70%" CLASS="DOT2">'.$name.'</TD>
			  </TR>
              <TR VALIGN="TOP">
				<TD CLASS="DOT2"><B>Название компании</B></TD>
				<TD CLASS="DOT2">'.$company.'</TD>
			  </TR> 
               <TR VALIGN="TOP">
				<TD WIDTH="30%" CLASS="DOT2"><B>Телефон</B></TD>
				<TD WIDTH="70%" CLASS="DOT2">'.$phone.'</TD>
			  </TR>
			  <TR VALIGN="TOP">
				<TD CLASS="DOT2"><B>Электронная почта</B></TD>
				<TD CLASS="DOT2"><A HREF="mailto:'.$mail.'" CLASS="LE">'.($mail).'</A></TD>
			  </TR>
               <TR VALIGN="TOP">
				<TD WIDTH="30%" CLASS="DOT2"><B>Вопрос</B></TD>
				<TD WIDTH="70%" CLASS="DOT2">'.nl2br($quest).'</TD>
			  </TR>
			</TABLE>
			</BODY>
			</HTML>';

			$msg = $htext.$text;
			
			$umsg = $htext.$utext.$text;
            
            $subject="Вопрос логистической службе сайта apic.ru";
						
            /*$email[]="pkaplin@apic.ru";
            $email[]="dlk@apic.ru";
            $email[]="info@content-pravo.ru";*/
            //$email[]="lighty@lighty.ru";
			$email[]="wser@ya.ru";
			$email[]="climatexpo@apic.ru";

			
			foreach($email as $to)
		 	{
                email($to, $subject, "", $msg, $from_mail, $from_name, '');
		 	}	
            email($mail, $subject, "", $umsg, $from_mail, $from_name, '');

            	$q='<h2 style="text-align:center;"><br />Ваш вопрос логистической службе успешно отправлен!</h2>';
		}
		else
		{
            unset($fsub);
			$errmsg="Не заполнены обязательные поля";
		}

}

if(empty($fsub))
{
if(!empty($errmsg)) $q.='<h2 style="color:red;">'.$errmsg.'</h2>';
$q.='<form method="post" enctype="multipart/form-data" id="qfp" class="custom-form" style="max-width: 480px;">
				<fieldset>
                    <input name="fsub" type="hidden" value="1" />
					<p>
						<label class="input-holder">
							<input name="name" value="'.$name.'" type="text" placeholder="ФИО" />
						</label>
					</p>
					<p>
						<label class="input-holder">
							<input name="company" value="'.$company.'" type="text" placeholder="Компания" />
						</label>
					</p>
                    <p>
						<label class="input-holder">
							<input name="phone" value="'.$phone.'" placeholder="Телефон">
						</label>
					</p>
					<p>
						<label class="input-holder">
							<input type="email" name="mail" value="'.$mail.'" placeholder="Почта">
						</label>
					</p>
					<p>
						<label class="textarea-holder">
							<textarea cols="30" rows="5" name="quest" placeholder="Вопрос">'.$quest.'</textarea>
						</label>
					</p>
                    <span class="btn blue-btn" onclick="doLoad(document.getElementById(\'qfp\'))">Отправить вопрос</span>
				</fieldset>
			</form>';
}

$GLOBALS['_RESULT'] = $q;
?>