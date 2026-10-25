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

$regru_conf = $di->regru;
$price_buy = $regru_conf['price_buy'];

    if($price_buy > $user->balance){
        $response = array(
            "status" => 'error',
            "message" => 'Недостаточно средств на балансе<br>Cтоимость домена '.$price_buy.' руб.',
        );
        print json_encode($response);
        exit;
    }

$regru = new RegRuApi();

if($post->mode == 'check'){
    $domain_name = $post->domain;
    
    
    
    if(preg_match("/\.info+/", $domain_name)){
        $domain_name = preg_replace("/\..+/", ".info", $domain_name);
    }else{
        $domain_name = preg_replace("/\..+/", ".ru", $domain_name);  
    }
    
    
    if (!preg_match("~^(?:[a-z0-9](?:[-a-z0-9]*[a-z0-9])?\.)+[a-z](?:[-a-z0-9]*[a-z0-9])?\.?(?:$|/)~Di", $domain_name))
    {
        $response = array(
            "status" => 'error',
            "message" => 'Ошибка',
        );
        print json_encode($response);
        exit;
    }
    
    $checkDomain = $regru->checkDomain($domain_name);
    
    if($checkDomain->answer->domains[0]->result == 'Available'){
        
        $html = 
        '
        <table class="domain-list-table table table-bordered text-center">
            <thead>
                <tr>
                    <th>Домен</th>
                    <th>Регистрация</th>
                    <th>Действие</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="align-middle">
                        '.$domain_name.'
                    </td>
                    <td class="align-middle"><strong>'.$price_buy.'</strong> руб/год</td>
                    <td class="align-middle">
                        <button class="btn form-domainbuy-button button" value="Купить домен" data-name="'.$domain_name.'" data-price="'.$price_buy.'">
                            Купить домен
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
        ';
        
        
        $response = array(
            "status" => 'success',
            "message" => $html,
        );
        print json_encode($response);
        exit;
    }else{
        $response = array(
            "status" => 'error',
            "message" => 'Домен занят!',
        );
        print json_encode($response);
        exit;
    }
    
}elseif($post->mode == 'buy'){
    $user_ip = $user->ip;
    $domain_name = $post->domain;
    $type = 1;
    
    if(preg_match("/\.info+/", $domain_name)){
        $domain_name = preg_replace("/\..+/", ".info", $domain_name);
        $type = 2;
    }else{
        $domain_name = preg_replace("/\..+/", ".ru", $domain_name);  
    }
    
    if (!preg_match("~^(?:[a-z0-9](?:[-a-z0-9]*[a-z0-9])?\.)+[a-z](?:[-a-z0-9]*[a-z0-9])?\.?(?:$|/)~Di", $domain_name))
    {
        $response = array(
            "status" => 'error',
            "message" => 'Ошибка',
        );
        print json_encode($response);
        exit;
    }
    
    $buyDomain = $regru->buyDomain($domain_name, $user_ip, $type);
    
    if($buyDomain->result == 'success'){
        $service_id = $buyDomain->answer->service_id;
        $buyDomain = $regru->addIp($service_id);
        
        $balance = $user->balance - $price_buy;
        $user->update([
            'balance' => $balance
        ]);
        
        $log_finances = new FinancesLog;
        $log_finances->user_id = $user_id;
        $log_finances->operation = 2;
        $log_finances->summ = $price_buy;
        $log_finances->description = 18;
        $log_finances->balance = $balance;
        $log_finances->status = 1;
        $log_finances->create();
        
        $sql = "insert into domains (`domain`,`active`,`comment`,`date_add`,`user_id`) values ('$domain_name','5','','". time() ."','$user_id')";
        DB::getInstance()->query($sql); 

        $response = array(
            "status" => 'success',
            "message" => 'Домен зарегистрирован!<br>Ожидайте обновления DNS записей',
        );
        print json_encode($response);
        exit;
    }else{
        $response = array(
            "status" => 'error',
            "message" => $buyDomain->error_text,
        );
        print json_encode($response);
        exit;
    }
    

}





