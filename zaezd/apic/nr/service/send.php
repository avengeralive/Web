<?php
set_time_limit(0);

$inc_path="/home/web/apic.ru/www/apic.ru/www/nr/";
require($inc_path."config/head.php");
require($inc_path."service/func.php");

$send_count=50;

$sql='select id_r,id_u,subj,text,count,test,rlist from '.$pr.'ras where type=1 order by id_r asc limit 0,1';
$dt=mysql_query($sql);
$id_r=mysql_result($dt,0,0);
$id_u=mysql_result($dt,0,1);
$subject=mysql_result($dt,0,2);
$txt=mysql_result($dt,0,3);
$count=mysql_result($dt,0,4);
$test=mysql_result($dt,0,5);
$rlist=mysql_result($dt,0,6);

if(!empty($id_r))
{
if($id_u!=1) 
{
$text_up='<html><head></head><body><img src="cid:apic_head.jpg">';
if($id_u==3) $text_up='<html><head></head><body><img src="cid:apic_head.jpg">';
else $text_up='<html><head></head><body>';
$text_down='</body></html>';
}
$eol="\n";    
    
$sql='select name,mail from '.$pr.'user where id_user='.$id_u; 
$temp=mysql_query($sql); 
  
    
$from_name=mysql_result($temp,0,0);
$from=mysql_result($temp,0,1);
$contents=$text_up.$text_head_ras.$txt.$text_down;

$sql='select id_att from '.$pr.'image where id_r='.$id_r;
$img=mysql_query($sql);
$img_count=mysql_num_rows($img);
	
for($i=0;$i<$img_count;$i++)
{
    $att_files[$i]=mysql_result($img,$i,0);
}
	
if($test==1) $sql='select mail from '.$pr.'user where id_user='.$id_u;
else $sql='select mail,id_m from '.$pr.'mail where type=1 and id_list='.$rlist.' limit '.$count.','.$send_count;
$res=mysql_query($sql);
$res_count=mysql_num_rows($res);

for($i=0;$i<$res_count;$i++)
{
    $mail_to=mysql_result($res,$i,0);
	$code=md5($mail_to.'1567apic');
	$u_text='http://www.apic.ru/ras/uns.php?mail='.$mail_to.'&code='.$code;
    
    $t_contents=str_replace('#unsubscribe',$u_text,$contents);
    
	/*$msg1 = $b_contents.$text.$eol.$eol;

    $fmsg =$msg.$msg1.$msg0;
    
    echo mysql_result($res,$i,0)."<br />";*/
 
	email($mail_to, $subject, "", $t_contents, $from, $from_name, implode(';',$att_files));  	 
}


//echo $res_count.'-'.$send_count;
if($res_count<$send_count)
{
 $sql='update '.$pr.'ras set type=2,test=1 where id_r='.$id_r;
 mysql_query($sql);	
}
else
{
	$sql='update '.$pr.'ras set count=count+'.$send_count.' where id_r='.$id_r;
 mysql_query($sql);	
}

}
?>
