<?php
$inc_path=$_SERVER['DOCUMENT_ROOT']."/";
include($inc_path."config/head.php");
include($inc_path."lib/func.php");
include($inc_path."lib/anketa_config.php");
include($inc_path."lib/JsHttpRequest.php");
$JsHttpRequest =& new JsHttpRequest("utf-8");

$from_name='Apic.ru';
$from_mail='subscribe@apic.ru';

$fsub=htmlspecialchars(stripslashes($_POST["fsub"]));
$flag=1;
for($i=0;$i<$field_count;$i++)
{
    $f=0;
    $count=0;
    foreach($field_val[$i] as $valf)
    {
        $vname="val".$i."-".$f;
        $val[$i][$f]=$_POST[$vname];
        if(!empty($val[$i][$f])) $count++;
        $f++;
    }
    if($count==0 && $field_must[$i]==1) $flag=0;
}

if(!empty($fsub))
{
		if($flag)
		{
		    $subject="АНКЕТА: потребность в юридических услугах apic.ru";
            
			$htext='<html><head><title>АНКЕТА: потребность в юридических услугах apic.ru</title>
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
          
            //$utext='<h2>Спасибо за Ваш вопрос! Мы постараемся ответить на него как можно скорее!</h2><h2><h3>Ваши данные:</h3>';
            
            $text='<TABLE WIDTH="80%"  BORDER="0" CELLSPACING="0" CELLPADDING="0">';
            
            for($i=0;$i<$field_count;$i++)
            {
                $f=0;
                $count=0;
                $text.='<TR VALIGN="TOP"><TD WIDTH="30%" CLASS="DOT2"><B>'.$field_name[$i].'</B></TD><TD WIDTH="70%" CLASS="DOT2">';
                foreach($field_val[$i] as $valf)
                {
                    if(!empty($val[$i][$f]))
                    {
                        if(empty($valf))
                        {   
                            switch($field_type[$i][$f])
                            {
                                case 'check' : if($count>0) $text.="<br />"; $text.=$valf;  break;
                                case 'text'  : if($count>0) $text.="<br />"; $text.=nl2br($val[$i][$f]);  break;
                                case 'input' : if($count>0) $text.="<br />"; $text.=$val[$i][$f];  break;
                            }
                        }
                        else
                        {
                            switch($field_type[$i][$f])
                            {
                                case 'check' : if($count>0) $text.="<br />"; $text.=$valf; break;
                                case 'text'  : if($count>0) $text.="<br />"; $text.=$valf.'-'.nl2br($val[$i][$f]); break;
                                case 'input' : if($count>0) $text.="<br />"; $text.=$val[$i][$f].'-'.$valf; break;
                            }
                        }
                        $count++;
                    }
                    $f++;
                }
                $text.='</TD></TR><TR><TD>&nbsp;</TD></TR>';
            }
            
			$text.='</TABLE></BODY></HTML>';

			$msg = $htext.$text;
            
            //$email[]="pkaplin@apic.ru";
            //$email[]="dlk@apic.ru";
            //$email[]="info@content-pravo.ru";
            //$email[]="lighty@lighty.ru";
			$email[]="wser@ya.ru";
			$email[]="climatexpo@apic.ru";
			

			foreach($email as $to)
		 	{
			//	$q.=$to;
                email($to, $subject, "", $msg, $from_mail, $from_name, '');
		 	}	
            
            //mail($mail, $subject, $umsg, $headers);
			
            $q='<h2 style="text-align:center;">Ваша анкета отправлена, спасибо!</h2>';
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
$q.='<form method="post" enctype="multipart/form-data" id="qfp" class="custom-form" style="max-width: 100%;margin-bottom: 100px;"><fieldset>';
$q.='<input name="fsub" type="hidden" value="1" /><table>';

for($i=0;$i<$field_count;$i++)
{
    $q.='<tr><td colspan=2>'.$field_name[$i].'</td></tr>';
    $f=0;
    foreach($field_val[$i] as $valf)
    {
        $check="";
        if(empty($valf))
        {
            switch($field_type[$i][$f])
            {
                case 'check' : if($val[$i][$f]==1) $check=" checked"; $q.='<tr><td colspan=2><label class="checkbox-holder"><input class="checkbox" type="checkbox" name="val'.$i.'-'.$f.'"'.$check.' value="1" /></label></td></tr>'; break;
                case 'text'  : $q.='<tr><td colspan=2><label class="textarea-holder"><textarea cols="30" rows="5" name="val'.$i.'-'.$f.'">'.$val[$i][$f].'</textarea></label></td></tr>'; break;
                case 'input' : $q.='<tr><td colspan=2><label class="input-holder"><input name="val'.$i.'-'.$f.'" value="'.$val[$i][$f].'" type="text" /></label></td></tr>'; break;
            }
        } 
        else
        {
            switch($field_type[$i][$f])
            {
                case 'check' : if($val[$i][$f]==1) $check=" checked"; $q.='<tr><td colspan=2><label class="checkbox-holder"><input class="checkbox" type="checkbox" name="val'.$i.'-'.$f.'"'.$check.' value="1" /><span class="checkbox-label">'.$valf.'</span></label></td></tr>'; break;
                case 'text'  : $q.='<tr><td colspan=2><label class="textarea-holder"><textarea cols="30" rows="5" name="val'.$i.'-'.$f.'" placeholder="'.$valf.'">'.$val[$i][$f].'</textarea></label></td></tr>'; break;
                case 'input' : if($i==7) $q.='<tr><td colspan=2>'.$valf.'<br /><label class="input-holder"><input name="val'.$i.'-'.$f.'" value="'.$val[$i][$f].'" type="text" /></label></td></tr>'; 
                               else $q.='<tr><td colspan=2><label class="input-holder"><input name="val'.$i.'-'.$f.'" value="'.$val[$i][$f].'" type="text" placeholder="'.$valf.'" /></label></td></tr>'; 
                               break;
            }
        }
        $f++;  
    }
    $q.='<tr><td colspan=2>&nbsp;</td></tr>';
}



$q.='</table>';
$q.='<span class="btn blue-btn" onclick="doLoad(document.getElementById(\'qfp\'))">Отправить анкету</span>';
$q.='</fieldset></form>';
}

$GLOBALS['_RESULT'] = $q;
?>