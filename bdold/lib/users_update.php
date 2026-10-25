<?php

function telegram($text){
    if(is_array($text)) $text = implode(",",$text);
    $token = "696735574:AAEpKD9CaGW8Op45ezmFkslDSd9VIhT3WGc";
    $chat_id = "-323189907";

    $sendToTelegram = fopen("https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&parse_mode=html&text={$text}","r");
    return $sendToTelegram;
}
// Блок с обновлением в базе данных пользователя
// Block the update in the user database
if (isset($_POST['submit_user']) && ($user_tip=='70' or $user_tip=='80' or $user_tip=='60' or $user_tip=='90'))
	{
	$id=htmlspecialchars(trim($_POST['id']));	
	if (isset($_POST['email'])) {$email=htmlspecialchars(trim($_POST['email']));} else {$email='';}
	
	// Проверка, нет ли уже другого пользователя с таким же email
	// Check to see if there is already another user with the same email
	$sql_user_check= "SELECT id,email, balance FROM users WHERE `email`='$email' AND `id`!='$id'";
	$result_user_check=$mysqli->query($sql_user_check);
	if (mysqli_num_rows($result_user_check) > 0) 
		{
		header('location:' . $_SERVER['PHP_SELF'] . '?edit=' .$id. '&xtext=2');
		exit;
		}
	$res_user_check=mysqli_fetch_array($result_user_check);	
	$oldBalance = $res_user_check['balance'];
	
    if (isset($_POST['name'])) {$name=htmlspecialchars(trim($_POST['name']));} else {$name='';}
    if(isset($_POST['track_webmasters'])){
        $track_webmasters = $_POST['track_webmasters'];
        if(is_array($track_webmasters)){
            $track_webmasters = implode(",",$track_webmasters);
        }
    }else {$track_webmasters = '';}
        if (isset($_POST['login'])) {$login=htmlspecialchars(trim($_POST['login']));} else {$login='';}
	if (isset($_POST['phone'])) {$phone=htmlspecialchars(trim($_POST['phone']));} else {$phone='';}
	if (isset($_POST['skype'])) {$skype=htmlspecialchars(trim($_POST['skype']));} else {$skype='';}
	if (isset($_POST['icq'])) {$icq=htmlspecialchars(trim($_POST['icq']));} else {$icq='';}
	if (isset($_POST['wmr'])) {$wmr=htmlspecialchars(trim($_POST['wmr']));} else {$wmr='';}
	if (isset($_POST['ip'])) {$ip=htmlspecialchars(trim($_POST['ip']));} else {$ip='';}
	if (isset($_POST['balance'])) {$balance=htmlspecialchars(trim($_POST['balance']));} else {$balance='';}
	if (isset($_POST['status_rekl'])) {$status_rekl=", type_rekl = '".htmlspecialchars(trim($_POST['status_rekl']))."'";} else {$status_rekl='';}
	if (isset($_POST['message_b'])) {$message_b=", message_b = '".htmlspecialchars(trim($_POST['message_b']))."'";} else {$message_b='';}
	if (isset($_POST['send_to_admin']) && $_POST['send_to_admin']=='on') {$send_to_admin='1';} else {$send_to_admin='0';}
        if (isset($_POST['hr_check']) && $_POST['hr_check']=='on') {$hr_check='1';} else {$hr_check='0';}
	if (isset($_POST['comment'])) {$comment=htmlspecialchars($_POST['comment']);} else {$comment='';}
        if (isset($_POST['hold_days'])) {$hold_days=htmlspecialchars($_POST['hold_days']);} else {$hold_days='';}
        if (isset($_POST['ref_program'])) {$ref_program=htmlspecialchars($_POST['ref_program']);} else {$ref_program='';}
        if (isset($_POST['offers_reward_all'])) {$offers_reward_all=htmlspecialchars($_POST['offers_reward_all']);} else {$offers_reward_all='';}
        if (isset($_POST['alias'])) {$alias=htmlspecialchars($_POST['alias']);} else {$alias='';}

        if (isset($_POST['forecast_send_email'])) {$forecast_send_email= htmlentities($_POST['forecast_send_email']);} else {$forecast_send_email='';}
        if (isset($_POST['forecast_send_admin']) && $_POST['forecast_send_admin']=='on') {$forecast_send_admin='1';} else {$forecast_send_admin='0';}
        
        if(isset($_POST['status_rekl']) && $_POST['status_rekl'] == 1){
            $balance_mess = ", balance_mess = '0', f_send_admin = '0'";
        }else{
            $balance_mess = "";
        }
        
	if($balance != $oldBalance){
		$toBase = ", `sendsms_balance` = '0'";
	}else{$toBase = '';}
	
	$active=htmlspecialchars(trim($_POST['active']));	
	$tip=htmlspecialchars(trim($_POST['tip']));	
	$uroven_dostupa=htmlspecialchars(trim($_POST['uroven_dostupa']));
	if (isset($_POST['password']) && $_POST['password']!='')
		{
		$password = md5(md5($_POST['password']));
		$request= "UPDATE `users` SET `login` = '$login', `alias`='$alias', `password`='$password',`email`='$email',`name`='$name',`phone`='$phone',`skype`='$skype',`icq`='$icq',`wmr`='$wmr',`balance`='$balance',`active`='$active',`ref_program`='$ref_program',`hold_days`='$hold_days',`tip`='$tip',`uroven_dostupa`='$uroven_dostupa',`comment`='$comment',`offers_reward_all`='$offers_reward_all',`send_to_admin`='$send_to_admin',`f_send_mail`='$forecast_send_email',`f_send_admin`='$forecast_send_admin', `hr_check` = '$hr_check' ".$balance_mess." ".$status_rekl." ".$message_b." ".$toBase.", `track_webmasters` = '$track_webmasters' WHERE `id`='$id'";
        }
		else
		{
		$request= "UPDATE `users` SET `login` = '$login', `alias`='$alias', `email`='$email',`name`='$name',`phone`='$phone',`skype`='$skype',`icq`='$icq',`wmr`='$wmr',`balance`='$balance',`active`='$active',`ref_program`='$ref_program',`hold_days`='$hold_days',`tip`='$tip',`uroven_dostupa`='$uroven_dostupa',`comment`='$comment',`offers_reward_all`='$offers_reward_all',`send_to_admin`='$send_to_admin',`f_send_mail`='$forecast_send_email',`f_send_admin`='$forecast_send_admin', `hr_check` = '$hr_check' ".$balance_mess." ".$status_rekl." ".$message_b." ".$toBase.", `track_webmasters` = '$track_webmasters' WHERE `id`='$id'";
        }
	$result=$mysqli->query($request);
	header('location:' . $_SERVER['PHP_SELF'] . '?edit=' .$id. '&xtext=1');
	exit;
	}
        
if (isset($_POST['comission_bonus_change']) && ($user_tip=='70' or $user_tip=='80' or $user_tip=='90')){
    $post = new Request($_POST);
    $offer_id = $post->offer;
    $bonus_country = $post->bonus_country;
    $comissions = $post->comission;
    
    if(count($bonus_country) == count($comissions)){
        
        $user = User::getById($post->user_id);
        
        
        if($user->offers_reward != ''){
            $str = '';    
            $personal_bonus = explode('|', trim($user->offers_reward));
            $offer_bonus = array();
            foreach ($personal_bonus as $key => $bonus) {
                if($bonus == ''){continue;}
                $offer_bonus[] = explode(':', trim($bonus));
            }  
            if($offer_bonus && is_array($offer_bonus)){
                foreach ($offer_bonus as $key => $bonus) {
                    if ($bonus[0] == $offer_id){continue;}
                    $str .= $bonus[0].':'.$bonus[1].'|';
                }                
            }

        }
        
        $str .= $offer_id.':';
        $count = count($bonus_country);
        for($i=0;$count>$i;$i++){
            $str .= $bonus_country[$i].'-'.$comissions[$i];
            if(($i+1)!=$count){$str .=',';}
        }
        $str .= '|';
        $user->update([
            'offers_reward' => $str
        ]);               
        header('location:' . $_SERVER['PHP_SELF'] . '?edit=' .$post->user_id. '&xtext=4');
        
    }else{
        header('location:' . $_SERVER['PHP_SELF'] . '?edit=' .$post->user_id. '&xtext=3');
    }    
}        
        
        

if (isset($_GET['xtext']) && $_GET['xtext']=='1') {$xtext='<font color=green><b>'.$loc['users.php']['t54'].'</b></font>';}
elseif (isset($_GET['xtext']) && $_GET['xtext']=='2') {$xtext='<font color=red><b>'.$loc['users.php']['t55'].'</b></font>';}
elseif (isset($_GET['xtext']) && $_GET['xtext']=='3') {$xtext='<font color=red><b>Ошибка при установке комиссии!</b></font>';}
elseif (isset($_GET['xtext']) && $_GET['xtext']=='4') {$xtext='<font color=green><b>Размер комиссии для пользователя сохранен!</b></font>';}
?>