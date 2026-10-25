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

if(!empty($fsub))
{
		if(!empty($mail) && filter_var($mail, FILTER_VALIDATE_EMAIL))
		{
    		$sql='select id_m from r_mail where mail="'.addslashes($mail).'"';
            $tmp=mysql_query($sql);
            $tmp=mysql_result($tmp,0,0);
         
            if(empty($tmp))
            {
                $sql='insert into r_mail values(NULL,"'.addslashes($mail).'",0)';
                mysql_query($sql);
                
                $id_mail=mysql_insert_id();                
                
                $q='<div class="control-title h2" style="text-align:center;"><br /><br /><br />Вам отправлено письмо для подтверждения участия в рассылке!</div>';
                
                $subject="Подтверждение участия в рассылке АПИК ";
                
                $code=md5($id_mail.'apic-ras');
                $text=$approve_text.'<br /><p><a href="http://www.apic.ru/user/action-approve_email-'.$mail.'-'.$code.'/">Подтвердить участие в рассылке</a></p><br /><p><a href="http://www.apic.ru/user/action-unsubscribe-'.$mail.'-'.$code.'/">Отказаться от рассылки</a></p></body></html>';
               
                email($mail, $subject, "", $text, $from_mail, $from_name, '');
            }
            else
            {
                unset($fsub);
                $errmsg='E-mail уже зарегистрирован';                
            } 
		}
		else
		{
            unset($fsub);
			$errmsg="Заполните поле";
		}

}

if(empty($fsub))
{

if(!empty($errmsg)) $title='<div class="control-title" style="color:red;">'.$errmsg.'</div>';
else $title='<div class="control-title">Подписка на рассылку</div>';
$q.='<fieldset><input name="fsub" type="hidden" value="1" />
								<div class="wrap">
									<div class="control-title h2">'.$title.'</div>
									<div class="control-description">Подпишитесь на рассылку АПИК и с периодичностью 1 раз в 2 недели мы будем присылать Вам:
 <ul>
 <li>Информацию о выходе журнала «Мир Климата» со ссылками на все статьи;</li> 
 <li>Информацию и ссылки на материалы новых курсов Учебного центра АПИК;</li>
 <li>Результаты маркетинговых исследований;</li>
 <li>Новости компаний-членов АПИК;</li>
 <li>Приглашения и информацию о выставке «Мир Климата».</li>
 </ul></div>
									<div class="form-frame">
										<label class="input-holder">
											<input type="email" name="mail" value="'.$mail.'" placeholder="Почта">
										</label>
										<div class="btn-holder">
											<span class="btn blue-btn" onclick="doLoad_ras_page(document.getElementById(\'qfp\'))"><span class="ico"><img src="/images/ico03.png" width="16" height="11" alt="image description"></span>Подписаться на рассылку</span>
										</div>
									</div>
								</div>
							</fieldset>';
}

$GLOBALS['_RESULT'] = $q;
?>