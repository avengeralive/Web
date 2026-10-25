<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

include dirname(__FILE__) . '/includes/config.php';
include dirname(__FILE__) . '/includes/antiinject/index.php';

$sql = "SELECT * FROM antifrod_config WHERE `id` = '1' LIMIT 1";
$result = $mysqli->query($sql);
$antifrod_config=mysqli_fetch_array($result);

$phone = $antifrod_config['phone'];
$conf_lids_ip = $antifrod_config['lids_ip_1'];
$conf_lids_referer = $antifrod_config['lids_referer_1'];
$conf_lids_buys = $antifrod_config['lids_buys_1'];
$conf_lids_ip2 = $antifrod_config['lids_ip_2'];
$conf_lids_referer2 = $antifrod_config['lids_referer_2'];
$conf_lids_buys2 = $antifrod_config['lids_buys_2'];

$all_users_arr = array();
$sql = "SELECT `id` FROM users WHERE `antifrod` = '0' AND `active` = '1' AND `tip` = '10'";
$result = $mysqli->query($sql);
while($res=mysqli_fetch_array($result)){
	$all_users_arr[] = $res['id'];
}
$users_str = implode(',',$all_users_arr);
$arr_users = array();
$sql = "SELECT `user_id` FROM zakaz WHERE `status` IN (2,3) AND `user_id` IN (".$users_str.") GROUP BY `user_id` HAVING COUNT(id)>0";
$result = $mysqli->query($sql);
if(mysqli_num_rows($result) == 0){exit('Нет для проверки');}
while($res=mysqli_fetch_array($result)){
	$arr_users[] = $res['user_id'];
}

$type_1_arr = array();
$sql = "SELECT `id` FROM offers WHERE `type_offer` = '1'";
$result = $mysqli->query($sql);
while($res=mysqli_fetch_array($result)){
	$type_1_arr[] = $res['id'];
}
$type_2_arr = array();
$sql = "SELECT `id` FROM offers WHERE `type_offer` = '2'";
$result = $mysqli->query($sql);
while($res=mysqli_fetch_array($result)){
	$type_2_arr[] = $res['id'];
}
$type_3_arr = array();
$sql = "SELECT `id` FROM offers WHERE `type_offer` = '3'";
$result = $mysqli->query($sql);
while($res=mysqli_fetch_array($result)){
	$type_3_arr[] = $res['id'];
}

$type_1 = implode(',',$type_1_arr);
$type_2 = implode(',',$type_2_arr);
$type_3 = implode(',',$type_3_arr);

$count = count($arr_users);
//$str_users = implode(',',$arr_users);
$cnt = 0;
for($i=0;$count>$i;$i++){

	$user = $arr_users[$i];

	$sql = "SELECT COUNT(id) FROM zakaz WHERE `user_id` = '$user' AND status IN (2,3) AND offer_id IN (".$type_1.")";
	$result = $mysqli->query($sql);
	$res=mysqli_fetch_array($result);
	$count_zakaz=$res['COUNT(id)'];

	$sql = "SELECT COUNT(id) FROM zakaz WHERE `user_id` = '$user' AND status IN (2,3) AND offer_id IN (".$type_3.")";
	$result = $mysqli->query($sql);
	$res=mysqli_fetch_array($result);
	$count_zakaz2=$res['COUNT(id)'];


	$sql = "SELECT COUNT(*) AS `ip_same` FROM zakaz  WHERE `ip` IN (SELECT `ip` FROM zakaz WHERE `user_id` = '$user' AND status IN (2,3) GROUP BY `ip` HAVING COUNT(id)>1) AND `user_id` = '$user' AND status IN (2,3) AND offer_id IN (".$type_1.")";
	$result = $mysqli->query($sql);
	$res=mysqli_fetch_array($result);
	$count_ip_same=$res['ip_same'];

	$sql = "SELECT COUNT(*) AS `ip_same` FROM zakaz  WHERE `ip` IN (SELECT `ip` FROM zakaz WHERE `user_id` = '$user' AND status IN (2,3) GROUP BY `ip` HAVING COUNT(id)>1) AND `user_id` = '$user' AND status IN (2,3) AND offer_id IN (".$type_3.")";
	$result = $mysqli->query($sql);
	$res=mysqli_fetch_array($result);
	$count_ip_same2=$res['ip_same'];



	//if($count_ip_same != 0 && $count_zakaz != 0){$proc_ip_same = round(($count_ip_same*100)/$count_zakaz, 2);}else{$proc_ip_same = 0;}
	if($count_ip_same >= $conf_lids_ip2){antifrod_detect($user);$t2='ip1';$cnt++;continue;}
	if($count_ip_same2 >= $conf_lids_ip){antifrod_detect($user);$t2='ip2';$cnt++;continue;}

	$sql = "SELECT COUNT(id) FROM zakaz WHERE `user_id` = '$user' AND `referer` = '' AND status IN (2,3) AND offer_id IN (".$type_1.")";
	$result = $mysqli->query($sql);
	$res=mysqli_fetch_array($result);
	$count_not_referer=$res['COUNT(id)'];

	$sql = "SELECT COUNT(id) FROM zakaz WHERE `user_id` = '$user' AND `referer` = '' AND status IN (2,3) AND offer_id IN (".$type_3.")";
	$result = $mysqli->query($sql);
	$res=mysqli_fetch_array($result);
	$count_not_referer2=$res['COUNT(id)'];


	if($count_not_referer != 0 && $count_zakaz != 0){$proc_not_referer = round(($count_not_referer*100)/$count_zakaz, 2);}else{$proc_not_referer = 0;}
	if($proc_not_referer >= $conf_lids_referer2){antifrod_detect($user);$t2='referer1';$cnt++;continue;}

	if($count_not_referer2 != 0 && $count_zakaz2 != 0){$proc_not_referer2 = round(($count_not_referer2*100)/$count_zakaz2, 2);}else{$proc_not_referer2 = 0;}
	if($proc_not_referer2 >= $conf_lids_referer){antifrod_detect($user);$t2='referer2';$cnt++;continue;}

/*
	$sql = "SELECT COUNT(id) FROM zakaz WHERE `user_id` = '$user' AND `status` IN (2,3) AND addstatus = '4' AND offer_id IN (".$type_1.")";
	$result = $mysqli->query($sql);
	$res=mysqli_fetch_array($result);
	$count_buys_lids=$res['COUNT(id)'];
*/
	$sql = "SELECT COUNT(id) FROM zakaz WHERE `user_id` = '$user' AND `status` IN (2,3) AND addstatus = '4' AND offer_id IN (".$type_3.")";
	$result = $mysqli->query($sql);
	$res=mysqli_fetch_array($result);
	$count_buys_lids2=$res['COUNT(id)'];
/*
	if($count_buys_lids != 0 && $count_zakaz != 0){$proc_buys_lids = round(($count_buys_lids*100)/$count_zakaz, 2);}else{$proc_buys_lids = 0;}
	if($proc_buys_lids > $conf_lids_buys2){antifrod_detect($user);$cnt++;$t3='выкуп1';continue;}
*/
	if($count_buys_lids2 != 0 && $count_zakaz != 0){$proc_buys_lids2 = round(($count_buys_lids2*100)/$count_zakaz, 2);}else{$proc_buys_lids2 = 0;}
	if($proc_buys_lids2 > $conf_lids_buys){antifrod_detect($user);$cnt++;$t3='выкуп1';continue;}

	$sql = "SELECT COUNT(id) FROM zakaz WHERE `user_id` = '$user' AND `status` IN (2,3) AND addstatus IN (2,0,1) AND offer_id IN (".$type_1.")";
	$result = $mysqli->query($sql);
	$res=mysqli_fetch_array($result);
	$count_wait_lids=$res['COUNT(id)'];
	if($count_wait_lids != 0 && $count_zakaz != 0){$proc_wait_lidss = round(($count_wait_lids*100)/$count_zakaz, 2);}else{$proc_wait_lidss = 0;}
	if($proc_wait_lidss > $conf_lids_buys2){antifrod_detect($user);$cnt++;$t3='выкуп2';continue;}
}
echo 'проверено '. ($i+1) .'пользователей, заблокировано '.$cnt.'пользователей ';

function antifrod_detect($user)
{
	global $mysqli;

	$phone1 = '+79612950952,+79166216674';

	$sql = "UPDATE users SET `antifrod` = '1' WHERE `antifrod` = '0' AND `id` = '$user' LIMIT 1";
	$mysqli->query($sql);

	$sql_settings = "SELECT smslogin,smspassword,smsapikey FROM settings";
	$result_settings = $mysqli->query($sql_settings);
	$res_settings=mysqli_fetch_array($result_settings);
	$settings_smslogin=htmlentities($res_settings['smslogin']);
	$settings_smspassword=htmlentities($res_settings['smspassword']);
	$settings_smsapikey=htmlentities($res_settings['smsapikey']);


	$sms_text = 'Подозрение на фрод ID вебмастера '.$user;
	// Отправка СМС
	// Send SMS
	$ch = curl_init("http://sms.ru/auth/get_token");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_TIMEOUT, 30);
	$token = curl_exec($ch);
	curl_close($ch);

	$ch = curl_init("http://sms.ru/sms/send");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_TIMEOUT, 30);
	curl_setopt($ch, CURLOPT_POSTFIELDS, array(
	"login"		=>	$settings_smslogin,
	"sha512"	=>	hash("sha512",$settings_smspassword.$token.$settings_smsapikey),
	"token"		=>	$token,
	"to"		=>	$phone1,
	"text"		=>	$sms_text
	));
	$body = curl_exec($ch);
	curl_close($ch);

}
//echo $str_users;
