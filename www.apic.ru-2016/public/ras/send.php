<?php
$inc_path="/home/web/apic.ru/www/apic.ru/www/";
$stop=1;
$send_count=10;
require("head.php");
require("func.php");

$eol="\n";

$sql='select count,dt,id_r,test from r_ras where type=1 order by id_r asc limit 0,1';
$dt=mysql_query($sql);
$count=mysql_result($dt,0,0);
$id_r=mysql_result($dt,0,2);
$test=mysql_result($dt,0,3);
$dt=mysql_result($dt,0,1);

if(!empty($dt))
{
$from_name="Кузин Д. Л.";
$from="dlk@apic.ru";
$subject='Руководителям фирм-членов АПИК. О проведении выставки "МИР КЛИМАТА-2015" в " КРОКУС ЭКСПО". Повторная рассылка.';
//$subject='Руководителям фирм-членов АПИК. Очередное Общее собрание членов АПИК состоится 12 марта 2014г.';

$f_name=$inc_path."tmp_ras/index.html";

$handle=fopen($f_name, 'r'); 
$contents=fread($handle, filesize($f_name)); 
fclose($handle); 
$contents=mb_convert_encoding($contents, "UTF-8", "Windows-1251");

    $sql='select id_att from r_image where id_r='.$id_r;
	$img=mysql_query($sql);
	$img_count=mysql_num_rows($img);
	
for($i=0;$i<$img_count;$i++)
{
    $att_files[$i]=mysql_result($img,$i,0);
}
	
if($test==1) $sql='select mail,id_m from r_mail where type=2 limit '.$count.','.$send_count;
else $sql='select mail,id_m from r_mail where type=1  limit '.$count.','.$send_count;
//if($test==1) $sql='select mail,hash from clex_request where id=1 limit '.$count.','.$send_count;
//else $sql='select mail,hash from clex_request limit '.$count.','.$send_count;
$res=mysql_query($sql);
$res_count=mysql_num_rows($res);

for($i=0;$i<$res_count;$i++)
{
	/*$code=mysql_result($res,$i,0);
	$code=md5($code);
	$uid=mysql_result($res,$i,1);
	$text='<br /><p><a href="http://www.apic.ru/ras/uns.php?uid='.$uid.'&code='.$code.'">Отказаться от рассылки</a></p></body></html>';
    
	$msg1 = $b_contents.$text.$eol.$eol;

    $fmsg =$msg.$msg1.$msg0;*/
 
	email(mysql_result($res,$i,0), $subject, "", $contents, $from, $from_name, implode(';',$att_files));  	 
}

if($res_count<$send_count)
{
 $sql='update r_ras set type=2,test=1 where id_r='.$id_r;
 mysql_query($sql);	
}
else
{
	$sql='update r_ras set count=count+'.$send_count.' where id_r='.$id_r;
 mysql_query($sql);	
}

}
?>
