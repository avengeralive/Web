<?
require_once(CLASSES_BASE.'model_icms_proto.php');
require_once(CLASSES_BASE.'model_sphinx_search.php');


class model_icms_form_ticket extends model_icms_proto{


function get_object_by_id($id) {
	global $V, $_REQUEST, $SPHINX_INDEXES, $SPHINX_GROUPS;
//	alid($V['action']);
//  alid($_POST);

	if (isset($V['action'])){
		// просмотр билета по ссылке из письма
		};

	$o_base =    $this->get_object_base($id);
	$o_param = $this->get_document_params($id);
	$o_menu = $this->down_level_menu(	$this->_get_menu_tree($o_base['object'])	);
	$o_nav =   $this->get_document_navigation($o_base['object']['id'],$o_base['object']['name']);

	$is_request=false;
	$request=array();
	if (isset($_POST['ticketid'])){
		$is_request=true;
		$request=$_POST;
		};
	
	$this->_get_object_seo(&$o_base);
	$o_b1 =    $this->get_object_base(ID_BANNERS_ALL_LEFT); 
	$o_b2 =    $this->get_object_base(ID_BANNERS_ALL_TOP); 
	$o_b3 =    $this->get_object_base(ID_BANNERS_ALL_BOTTOM); 
	$o_b4 =    $this->get_object_base(ID_BANNERS_INDEX_MIDDLE); 
	$o_b5 =    $this->get_object_base(ID_BANNERS_NAV_LEFT); 
	$o_b6 =    $this->get_object_base(ID_BANNERS_CNT_BOTTOM); 
	
    return Array(
        'status'=>true,
		'is_request'=>$is_request,
		'request'=>$request,
        'object'=>$o_base['object'],
        'b1'=>$o_b1['object'],
        'b2'=>$o_b2['object'],
        'b3'=>$o_b3['object'],
        'b4'=>$o_b4['object'],
        'b5'=>$o_b5['object'],
        'b6'=>$o_b6['object'],
		'navigation'=>$o_nav['navigation'],
		'menu'=>$o_menu,
		'params'=>$o_param['params'],
        );
	}




	
	
	
	
	
	
	
function check_and_send(){

$inc_path=$_SERVER['DOCUMENT_ROOT']."/";
//include($inc_path."config/head.php");
//include($inc_path."lib/JsHttpRequest.php");
//$JsHttpRequest =& new JsHttpRequest("windows-1251");

$from_mail='Climatexpo <request@climatexpo.ru>';

$fsub=$_POST["fsub"];

$name=stripslashes($_POST["name"]);
$company=stripslashes($_POST["company"]);
$city=stripslashes($_POST["city"]);
$idx=stripslashes($_POST["idx"]);
$adr=stripslashes($_POST["adr"]);
$phone=stripslashes($_POST["phone"]);
$fax=stripslashes($_POST["fax"]);
$mail=stripslashes($_POST["mail"]);
$site=stripslashes($_POST["site"]);
$country=stripslashes($_POST["country"]);
$country_1=stripslashes($_POST["country_1"]);
$country_2=stripslashes($_POST["country_2"]);
$target=stripslashes($_POST["target"]);
$field=stripslashes($_POST["field"]);
$field_1=stripslashes($_POST["field_1"]);
$pos=stripslashes($_POST["pos"]);
$pos_1=stripslashes($_POST["pos_1"]);
$how=stripslashes($_POST["how"]);
$how_1=stripslashes($_POST["how_1"]);
$how_2=stripslashes($_POST["how_2"]);

$country_str[]="Россия, Центральный регион";
$country_str[]="Россия, Южный регион";
$country_str[]="Россия, Северо-Западный регион";
$country_str[]="Россия, Поволжье";
$country_str[]="Россия, Сибирь и Дальний Восток";
$country_str[]="Россия, Урал";

$target_str[]="Профессиональный интерес";
$target_str[]="Личный интерес";

$field_str[]="Производитель оборудования и систем";
$field_str[]="Производитель комплектующих,инструмента,аксессуаров";
$field_str[]="Дистрибьюторы, дилеры / компании по оптовым продажам оборудования";
$field_str[]="Компания по розничным продажам / установке оборудования";
$field_str[]="Инжиниринговая компания";
$field_str[]="Инвестор,управляющая недвижимостью кампания";
$field_str[]="Строительная/проектная/архитектурная/дизайнерская/ремонтная компания";
$field_str[]="Организация,закупающая оборудование для собственного оснащения";
$field_str[]="Образование,обучение";
$field_str[]="СМИ";
$field_str[]="Частное лицо";

$how_str[]="Был на прошедшей выставке";
$how_str[]="Приглашение по почте России";
$how_str[]="Интернет, электронная рассылка";
$how_str[]="От партнеров/друзей";

$pos_str[]="руководитель/директор";
$pos_str[]="руководитель направления, топ-менеджер"; 
$pos_str[]="технический директор";
$pos_str[]="менеджер"; 
$pos_str[]="научный специалист";
$pos_str[]="монтажник";
$pos_str[]="инженер-проектировщик"; 
$pos_str[]="преподаватель/студент";
$pos_str[]="не работаю";
 
 
if(!empty($fsub))
{
    if(isset($country) && $country==intval($country)) $qcountry=$country_str[$country];
    if(!empty($country_1)) $qcountry=$country_1;
    if(!empty($country_2)) $qcountry=$country_2;
    if(isset($target) && $target==intval($target)) $qtarget=$target_str[$target];
    if(!empty($target_1)) $qtarget=$target_1;
    if(isset($field) && $field==intval($field)) $qfield=$field_str[$field];
    if(!empty($field_1)) $qfield=$field_1;
    if(isset($how) && $how==intval($how)) $qhow=$how_str[$how];
    if(!empty($how_1)) $qhow=$how_1;
    if(!empty($how_2)) $qhow=$how_2;
    if(isset($pos) && $pos==intval($pos)) $qpos=$pos_str[$pos];
    if(!empty($pos_1)) $qpos=$pos_1;
    
		if(!empty($name) && !empty($company) && !empty($qcountry) && !empty($city) && !empty($idx) && !empty($adr) && !empty($phone) && !empty($mail) && !empty($qtarget) && !empty($qfield) && !empty($qhow) && !empty($qpos))
		{
			$sql='insert into apic_db.clex_request values (NULL,"'.addslashes($name).'","'.addslashes($company).'","'.addslashes($idx).'","'.addslashes($qcountry).'","'.addslashes($city).'","'.addslashes($adr).'","'.addslashes($phone).'","'.addslashes($fax).'","'.addslashes($mail).'","'.addslashes($site).'","'.addslashes($qtarget).'","'.addslashes($qhow).'","'.addslashes($qpos).'","'.addslashes($qfield).'","",NOW())';
			mysql_query($sql);
            
            $id_tick=mysql_insert_id();
            $hash=md5($id_tick+159);
            $tid_tick=$id_tick;
            $id_tick+=100000;
            
            $sql='update apic_db.clex_request set hash="'.$hash.'" where id='.$tid_tick;
            mysql_query($sql);

			$datestr=date("(H:i) d.m.Y");
            $eol="\n";

			$subject="Заявка на бесплатный билет с сайта climatexpo.ru";

			$headers = 'From: '.$from_mail.$eol;
        	$headers .= 'Reply-To: '.$from_mail.$eol;
        	$headers .= 'Return-Path: '.$from_mail.$eol;
			$headers .= "Message-ID: <".time()." TheSystem@".$_SERVER['SERVER_NAME'].">".$eol;
			$headers .= "X-Mailer: PHP v".phpversion().$eol;

			$mime_boundary=md5(time());
			$headers .= 'MIME-Version: 1.0'.$eol;
			$headers .= "Content-Type: multipart/related; boundary=\"".$mime_boundary."\"".$eol.$eol;

			$htext='<html><head><title>Заявка на бесплатный билет с сайта climatexpo.ru</title>
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
            $utext='<h2>Спасибо за регистрацию на выставке "Мир Климата - 2014"!</h2><h2><a target="_blank" href="http://www.climatexpo.ru/ticket/'.$hash.'/">Ваш личный электронный билет</a></h2><h3>Ваши данные:</h3>';
			$text='<TABLE WIDTH="80%"  BORDER="0" CELLSPACING="0" CELLPADDING="0">
              <TR VALIGN="TOP">
				<TD WIDTH="30%" CLASS="DOT2"><B>Код билета</B></TD>
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
				<TD WIDTH="30%" CLASS="DOT2"><B>Индекс</B></TD>
				<TD WIDTH="70%" CLASS="DOT2">'.$idx.'</TD>
			  </TR>
               <TR VALIGN="TOP">
				<TD WIDTH="30%" CLASS="DOT2"><B>Страна</B></TD>
				<TD WIDTH="70%" CLASS="DOT2">'.$qcountry.'</TD>
			  </TR>
			  <TR VALIGN="TOP">
				<TD CLASS="DOT2"><B>Город</B></TD>
				<TD CLASS="DOT2">'.$city.'</TD>
			  </TR>
			  <TR VALIGN="TOP">
				<TD WIDTH="30%" CLASS="DOT2"><B>Адрес</B></TD>
				<TD WIDTH="70%" CLASS="DOT2">'.$adr.'</TD>
			  </TR>
			  <TR VALIGN="TOP">
				<TD WIDTH="30%" CLASS="DOT2"><B>Телефон</B></TD>
				<TD WIDTH="70%" CLASS="DOT2">'.$phone.'</TD>
			  </TR>
              <TR VALIGN="TOP">
				<TD WIDTH="30%" CLASS="DOT2"><B>Факс</B></TD>
				<TD WIDTH="70%" CLASS="DOT2">'.$fax.'</TD>
			  </TR>
			  <TR VALIGN="TOP">
				<TD CLASS="DOT2"><B>Электронная почта</B></TD>
				<TD CLASS="DOT2"><A HREF="mailto:'.$mail.'" CLASS="LE">'.($mail).'</A></TD>
			  </TR>
              <TR VALIGN="TOP">
				<TD WIDTH="30%" CLASS="DOT2"><B>Сайт</B></TD>
				<TD WIDTH="70%" CLASS="DOT2">'.$site.'</TD>
			  </TR>
			  <TR VALIGN="TOP">
				<TD WIDTH="30%" CLASS="DOT2"><B>Цели посещения выставки</B></TD>
				<TD WIDTH="70%" CLASS="DOT2">'.$qtarget.'</TD>
			  </TR>
              <TR VALIGN="TOP">
				<TD WIDTH="30%" CLASS="DOT2"><B>Откуда Вы узнали о выставке</B></TD>
				<TD WIDTH="70%" CLASS="DOT2">'.$qhow.'</TD>
			  </TR>
              <TR VALIGN="TOP">
				<TD WIDTH="30%" CLASS="DOT2"><B>Должность</B></TD>
				<TD WIDTH="70%" CLASS="DOT2">'.$qpos.'</TD>
			  </TR>
              <TR VALIGN="TOP">
				<TD WIDTH="30%" CLASS="DOT2"><B>Сфера деятельности</B></TD>
				<TD WIDTH="70%" CLASS="DOT2">'.$qfield.'</TD>
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


            $email[]="wser@ya.ru";
            $email[]="pkaplin@apic.ru";
            $email[]="climat@euroexpo.ru";
            $email[]="orekhov@euroexpo.ru";
			//$email[]="lighty@lighty.ru";
            //$email[]="anton_light@tut.by";
			

			foreach($email as $to)
		 	{
			//	$q.=$to;
                mail($to, $subject, $msg, $headers);
		 	}	
            
            mail($mail, $subject, $umsg, $headers);
			
            ini_restore(sendmail_from);


            	$msg = '<p><strong>Ваша заявка отправлена, спасибо!</strong></p>';
                $msg.='<h2><a target="_blank" href="http://www.climatexpo.ru/ticket/'.$hash.'/">Ваш личный электронный билет</a></h2>';
               

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
if(isset($country) && $country==intval($country)) $ccheck[$country]=" checked";
if(isset($target) && $target==intval($target)) $tcheck[$target]=" checked";
if(isset($how) && $how==intval($how)) $hcheck[$how]=" checked";
if(isset($field) && $field==intval($field)) $fcheck[$field]=" checked";
if(isset($pos) && $pos==intval($pos)) $pcheck[$pos]=" checked";

if(!empty($errmsg)) $q.='<p style="color:red;">'.$errmsg.'</p>';
$q.='<form method="post" enctype="multipart/form-data" id="qf">';
$q.='<input name="fsub" type="hidden" value="1" /><table style="width: 580px;">';

$q.='<tr><td class="nt50" style="width: 220px;">Ф.И.О.<span class="ast"> * </span></td><td style="width: 360px;">';
$q.='<input id="i1" name="name" class="ina" value="'.$name.'" type="text" /></td></tr>';

$q.='<tr><td class="nt50">Название компании<span class="ast"> * </span></td><td>';
$q.='<input id="i3" name="company" class="ina" value="'.$company.'" type="text" /></td></tr>';

$q.='<tr><td class="nt50">Индекс<span class="ast"> * </span></td><td>';
$q.='<input id="i1" name="idx" class="ina" value="'.$idx.'" type="text" /></td></tr>';

$q.='<tr><td class="nt50">Страна<span class="ast"> * </span></td><td>';
for($i=0;$i<count($country_str);$i++)
	$q.='<input type="radio" id="rem" name="country" value="'.$i.'" '.$ccheck[$i].'>'.$country_str[$i].'<br />'."\n";
$q.='Ближнее зарубежье, страна<br />';
$q.='<input id="i4" name="country_1" class="ina" value="'.$country_1.'" type="text" /><br />';
$q.='Дальнее Зарубежье, страна<br />';
$q.='<input id="i4" name="country_2" class="ina" value="'.$country_2.'" type="text" />';
$q.='</td></tr>';

$q.='<tr><td class="nt50">Город<span class="ast"> * </span></td><td>';
$q.='<input id="i4" name="city" class="ina" value="'.$city.'" type="text" /></td></tr>';
$q.='<tr><td class="nt50">Адрес<span class="ast"> * </span></td><td>';
$q.='<input id="i1" name="adr" class="ina" value="'.$adr.'" type="text" /></td></tr>';
$q.='<tr><td class="nt50">Телефон<span class="ast"> * </span></td><td>';
$q.='<input id="i1" name="phone" class="ina" value="'.$phone.'" type="text" /></td></tr>';
$q.='<tr><td class="nt50">Факс</td><td>';
$q.='<input id="i1" name="fax" class="ina" value="'.$fax.'" type="text" /></td></tr>';
$q.='<tr><td class="nt50">E-mail<span class="ast"> * </span></td><td>';
$q.='<input id="i1" name="mail" class="ina" value="'.$mail.'" type="text" /></td></tr>';
$q.='<tr><td class="nt50">Сайт</td><td>';
$q.='<input id="i1" name="site" class="ina" value="'.$site.'" type="text" /></td></tr>';

$q.='<tr><td class="nt50">Цели посещения выставки<span class="ast"> * </span></td><td>';
for($i=0;$i<count($target_str);$i++)
	$q.='<input type="radio" id="rem" name="target" value="'.$i.'" '.$tcheck[$i].'>'.$target_str[$i].'<br />'."\n";
$q.="</td></tr>"; 

$q.='<tr><td class="nt50">Откуда Вы узнали о выставке?<span class="ast"> * </span></td><td>';
for($i=0;$i<count($how_str);$i++)
	$q.='<input type="radio" id="rem" name="how" value="'.$i.'" '.$hcheck[$i].'>'.$how_str[$i].'<br />'."\n";
$q.='Журнал/Газета<br />';
$q.='<input id="i4" name="how_1" class="ina" value="'.$how_1.'" type="text" /><br />';
$q.='Другое<br />';
$q.='<input id="i4" name="how_2" class="ina" value="'.$how_2.'" type="text" />';
$q.="</td></tr>"; 
    
$q.='<tr><td class="nt50">Пожалуйста, укажите Вашу должность<span class="ast"> * </span></td><td>';
for($i=0;$i<count($pos_str);$i++)
	$q.='<input type="radio" id="rem" name="pos" value="'.$i.'" '.$pcheck[$i].'>'.$pos_str[$i].'<br />'."\n";
$q.='Другое<br />';
$q.='<input id="i4" name="pos_1" class="ina" value="'.$pos_1.'" type="text" />';    
$q.="</td></tr>";    
    
$q.='<tr><td class="nt50">Пожалуйста, укажите сферу деятельности вашей компании<span class="ast"> * </span></td><td>';
for($i=0;$i<count($field_str);$i++)
	$q.='<input type="radio" id="rem" name="field" value="'.$i.'" '.$fcheck[$i].'>'.$field_str[$i].'<br />'."\n";
$q.='Другое<br />';
$q.='<input id="i4" name="field_1" class="ina" value="'.$field_1.'" type="text" />';    
$q.="</td></tr>";

$q.='</table>';
$q.='<div><input class="but" value="Отправить" type="button" onclick="doLoad(document.getElementById(\'qf\',0))" /></div>';
$q.='</form>';


}

$GLOBALS['_RESULT'] = $q;
	}	
	
	
}
?>
