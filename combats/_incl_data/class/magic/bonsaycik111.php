<?
if(!defined('GAME'))
{
	die();
}
session_start();
$user=$u->info;
$timer = time()+24*60*60;

$is_eff=mysql_fetch_array(mysql_query("SELECT id,timeUse FROM eff_users where id_eff='477' and `delete` =0 and uid='".$u->info['id']."'"));
if($is_eff[0]==0){
    if(mysql_query("UPDATE `users` SET `money`=`money`+'0' where `id`='".$user['id']."'") and
        mysql_query('INSERT INTO `eff_users` (
				`id_eff`,`uid`,`name`,`data`,`overType`,`timeUse`
			) VALUES (
				"477","'.$user['id'].'","Бонсайчик","add_exp=5","101","'.time().'"
			)'));
    {
        $err = " успешно использована Бонсайчик Вы получили чек!";
    }

	
	
	$sp0 = mysql_query('SELECT `items_id` FROM `items_main_data` WHERE `data` LIKE "%unik=%"');
$rnd0 = array();
while($pl0 = mysql_fetch_array($sp0)) {
	$rnd0[count($rnd0)] = $pl0['items_id'];
}

$rnd0['itm1'] = $rnd0[rand(0,count($rnd0))];
//$rnd0['itm2'] = $rnd0[rand(0,count($rnd0))];
$rnd0['itm3'] = $rnd0[rand(0,count($rnd0))];
$rnd0['itm1'] = mysql_fetch_array(mysql_query('SELECT `id`,`name` FROM `items_main` WHERE `id` = "'.mysql_real_escape_string($rnd0['itm1']).'" LIMIT 1'));
//$rnd0['itm2'] = mysql_fetch_array(mysql_query('SELECT `id`,`name` FROM `items_main` WHERE `id` = "'.mysql_real_escape_string($rnd0['itm2']).'" LIMIT 1'));

$u->addItem($rnd0['itm1']['id'],$u->info['id'],'|srok=1209600|sudba='.$u->info['login']);
//$u->addItem($rnd0['itm2']['id'],$u->info['id'],'|srok=1209600|sudba='.$u->info['login']);

if(rand(0,7) == 2) {
	$rnd0['itm3'] = mysql_fetch_array(mysql_query('SELECT `id`,`name` FROM `items_main` WHERE `id` = "'.mysql_real_escape_string($rnd0['itm3']).'" LIMIT 1'));
}else{
	$u->addItem($rnd0['itm3']['id'],$u->info['id'],'|srok=1209600|sudba='.$u->info['login']);
}

$u->error = 'Вы успешно открыли &quot;'.$itm['name'].'&quot;...';

unset($rnd0,$sp0,$pl0);
	
	
	
	
	
}
elseif($is_eff[0]>0){
    $wait_sec=$is_eff['timeUse'];
    $new_t=time();
    $left_time=$wait_sec-$new_t;
    $left_min=floor($left_time/86400);
    $left_sec=floor(($left_time-$left_min*86400)/60);
    if($left_min==1){$time_h="час";}
    if($left_min>1 and $left_min<5){$time_h="часа";}
    if($left_min>4){$time_h="часов";}
    $time_left=$left_min." ".$time_h." ".$left_sec." мин";

    $err="Вы уже получали благословение окончания текущего Благословления";
}

?>