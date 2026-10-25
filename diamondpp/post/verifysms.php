<?php
@session_start();

include dirname(__FILE__) . '/../includes/config.php';
include dirname(__FILE__) . '/../includes/auth/index.php';

if (!isset($user_id)){
    Header ('Location: /');	
    exit;
}

$user = User::getById($user_id);

if(!$user){
    Header ('Location: /');	
    exit;
}

$post = new Request($_POST);

if(isset($post->mode) && $post->mode == 1){

    $sends = $_SESSION['sendsms'];

    if($sends != 0 && $sends >= time()){
        $response = array(
            "status" => 'error',
            "message" => 'Смс было отправлено, новый код можно запросить раз в 10 минут.',
        );
        print json_encode($response);
        exit;
    }

    $phone = $user->phone;
    $code = gen_code(6);

    $_SESSION['sendsms'] = time() + 600;
    $_SESSION['sms_code'] = $code;

    $sql_settings = "SELECT smslogin,smspassword,smsapikey FROM settings";
    $result_settings = $mysqli->query($sql_settings);
    $res_settings=mysqli_fetch_array($result_settings);
    $settings_smslogin=htmlentities($res_settings['smslogin']);
    $settings_smspassword=htmlentities($res_settings['smspassword']);
    $settings_smsapikey=htmlentities($res_settings['smsapikey']);

    $sms_text = 'Код: ' . $code;
    sendsms($phone,$sms_text,$settings_smslogin,$settings_smspassword,$settings_smsapikey);
    
    $response = array(
        "status" => 'success',
        "message" => 'Смс с кодом отправлено.',
    );
    print json_encode($response);
    
}elseif (isset($post->mode) && $post->mode == 2) {
    
    if($post->code === $_SESSION['sms_code']){
        
        $user->update([
            'phone_check' => 1        
        ]); 
        $_SESSION['sendsms'] = time() - 3600;
        $response = array(
            "status" => 'success',
            "message" => 'Телефон успешно подтвержден!',
        );
    }else{
        $response = array(
            "status" => 'error',
            "message" => 'Неверный код!',
        );
    }
    print json_encode($response);
    
}elseif (isset($post->mode) && $post->mode == 4) {

    if($post->code === $_SESSION['sms_code']){
        
        $purse = $post->purse;
        $paysys = $post->paysys;
        
        switch($paysys){
            case 1: 
                $pay_system = 'yandex';
                break;
            case 2: 
                $pay_system = 'wmr';
                break;
            case 3: 
                $pay_system = 'cards';
                break;
            default:
                exit();
                break;
        }
        
        $ps = new Paysys();
        $ps->setUser($user_id);
        $user_paysys = $ps->getUserPaysys(); 
        
        if($user_paysys && count($user_paysys) > 0){
            $ps = Paysys::getById($user_paysys->id);
            $ps->update([
                $pay_system => $purse        
            ]);
        }else{
            $ps = new Paysys();
            $ps->user_id = $user_id;
            $ps->$pay_system = $purse;
            $ps->create();
        }
        
        $_SESSION['sendsms'] = time() - 3600;
        $response = array(
            "status" => 'success',
            "message" => 'Кошелек успешно сохранен!',
        );
    }else{
        $response = array(
            "status" => 'error',
            "message" => 'Неверный код!',
        );
    }
    print json_encode($response);
    
}else{
    Header ('Location: /');	
    exit;
}

function gen_code($number)
	{
	$arr = array('A','B','C','D','E','F',
                 'G','H','I','J','K','L',
                 'M','N','O','P','R','S',
                 'T','U','V','X','Y','Z',
                 '1','2','3','4','5','6',
                 '7','8','9','0');
    $passx = "";
    for($i = 0; $i < $number; $i++)
		{
		// Вычисляем случайный индекс массива
		// Compute a random array index
		$index = rand(0, count($arr) - 1);
		$passx .= $arr[$index];
		}
    return $passx;
}


function sendsms($phone,$sms_text,$settings_smslogin,$settings_smspassword,$settings_smsapikey){    
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
    "to"		=>	$phone,
    "text"		=>	$sms_text
    ));
    $body = curl_exec($ch);
    curl_close($ch);
}