<?php
$inc_path=$_SERVER['DOCUMENT_ROOT']."/";
include($inc_path."config/head.php");
include($inc_path."lib/func.php");
include($inc_path."lib/JsHttpRequest.php");
$JsHttpRequest =& new JsHttpRequest("utf-8");

$from_name='Apic.ru';
$from_mail='subscribe@apic.ru';

$fsub=stripslashes($_POST["fsub"]);
$mail=stripslashes($_POST["mail"]);
$name=stripslashes($_POST["name"]);
$company=stripslashes($_POST["company"]);
$txt=stripslashes($_POST["txt"]);

if(!empty($fsub))
{
		if(!empty($mail) && !empty($name) && !empty($txt) && filter_var($mail, FILTER_VALIDATE_EMAIL))
		{
    		/*$sql='select id_m from r_mail where mail="'.addslashes($mail).'"';
            $tmp=mysql_query($sql);
            $tmp=mysql_result($tmp,0,0);
         
                $sql='insert into r_mail values(NULL,"'.addslashes($mail).'",0)';
                mysql_query($sql);
                
                $id_mail=mysql_insert_id();*/                
                
                $q='<h2 style="text-align:center;">Ваш вопрос исполнительному директору успешно отправлен!</h2>';
                
                $subject="Вопрос исполнительному директору с сайта apic.ru";
                
                $text='<html><head></head><body>
                       <p><strong>ФИО: </strong>'.$name.'</p> 
                       <p><strong>Компания: </strong>'.$company.'</p>
                       <p><strong>E-mail: </strong>'.$mail.'</p>
                       <p><strong>Вопрос: </strong>'.$txt.'</p></body></html>';
               
              //  email('lighty@lighty.ru', $subject, "", $text, $from_mail, $from_name, '');
                email('wser@ya.ru', $subject, "", $text, $from_mail, $from_name, '');
                email('climatexpo@apic.ru', $subject, "", $text, $from_mail, $from_name, '');

		}
		else
		{
            unset($fsub);
			$errmsg="Заполните поля";
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
							<input type="email" name="mail" value="'.$mail.'" placeholder="Почта">
						</label>
					</p>
					<p>
						<label class="textarea-holder">
							<textarea cols="30" rows="5" name="txt" placeholder="Вопрос">'.$txt.'</textarea>
						</label>
					</p>
                    <span class="btn blue-btn" onclick="doLoad(document.getElementById(\'qfp\'))">Отправить вопрос</span>
				</fieldset>
			</form>';
}

$GLOBALS['_RESULT'] = $q;
?>