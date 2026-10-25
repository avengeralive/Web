<?php
//-approve---------------------------------------------------------------------------
if($action[1]=="unsubscribe" && !empty($action[2]) && !empty($action[3]))
{
echo '<h1>Отмена подписки</h1>';

$sql='select id_m from r_mail where type>-1 and mail="'.addslashes(urldecode($action[2])).'"';
$id_user=mysql_query($sql);
$id_user=mysql_result($id_user,0,0);

$code=md5($id_user.'apic-ras');

if($code==$action[3]) 
{
$sql='update r_mail set type=-1 where id_m='.addslashes($id_user);
mysql_query($sql);

echo '<h2>Адрес успешно удалён из рассылки!</h2>';
}
else echo '<h2>Произошла ошибка! Адрес не найден!</h2>';
}
//-approve---------------------------------------------------------------------------
if($action[1]=="approve_email" && !empty($action[2]) && !empty($action[3]))
{
echo '<h1>Активация подписки</h1>';

$sql='select id_m from r_mail where type=0 and mail="'.addslashes(urldecode($action[2])).'"';
$id_user=mysql_query($sql);
$id_user=mysql_result($id_user,0,0);

$code=md5($id_user.'apic-ras');

if($code==$action[3]) 
{
$sql='update r_mail set type=1 where type=0 and id_m='.addslashes($id_user);
mysql_query($sql);

echo '<h2>Адрес успешно подтверждён!</h2>';
}
else echo '<h2>Произошла ошибка! Скорее всего Вы уже активировали подписку!</h2>';
}
//---------------------------------------------------------------------------------
?>