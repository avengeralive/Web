<?php
/*$inc_path="/usr/local/www/clusternews.ru/htdocs/";
include($inc_path.'ras/template.php');*/
$text_up='<html><head></head><body>';
$text_down='</body></html>';

$sql='select `text` from '.$pr.'ras where type=1 and id_r='.addslashes($mode[0]).' and id_u='.addslashes($_SESSION["user_id"]).';';
//echo $sql;
$dt=mysql_query($sql);
$txt=mysql_result($dt,0,0);

$text=$text_up.$text_head_ras.$txt.$text_down;

//echo $text;

$handle=fopen($inc_path."tmp_ras/index.html", 'w'); 
fwrite($handle, $text); 
fclose($handle); 

if($_SESSION["user_id"]==3)
{
    include($inc_path."service/func.php");
    $fname='/home/web/apic.ru/www/apic.ru/www/nr/upload/apic_head.jpg';
    $hname='apic_head.jpg';
    $attach=uploadAttachment($fname,$hname);
        
	$sql='select max(id_i) from '.$pr.'image';
	$id_i=mysql_query($sql);
	$id_i=mysql_result($id_i,0,0);
	$id_i++;
	
	$sql='insert into '.$pr.'image values('.$mode[0].','.$id_i.',"'.$fname.'","'.$hname.'","'.$attach['attachId'].'",UNIX_TIMESTAMP(NOW()),1)';
	mysql_query($sql);
}
?>