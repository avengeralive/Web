<?php

// тут под лидтрейд надо бы сделать уневерсально.


include dirname(__FILE__) . '/../includes/config.php';

$get = new Request($_GET);

$api_key = '631c39fd15bbe020e35a762267078a03';

$arHash = [ 
    $get->sub1,
    $get->sub2,
    $api_key
];

$sign_hash = strtoupper(md5(implode(":", $arHash)));

if($get->hash != $sign_hash){
    die('hash');
}

$status = $get->status;
$click_id = $get->sale_id;
$payment = $get->payment;
$user_id = $get->sub1;
$client_id = $get->sub2;

if($status == 'lead'){
    
    $log = Client_Log::getById($client_id);
    if (!$log) {
        exit("z");
    }
    // достаем офер из лога
    $offer = Offer::getById($log->offer_id);

    // преобразовываем лог в клиента
    $client = $log->castToClient();

    // определяем продавца по оферу и клиенту
    $seller = Seller::getByOffer($offer, $client);

    // формируем заказ
    $zakaz = new Zakaz;
    $zakaz->owner_id = $seller->id;
    //$zakaz->kolvo = max(1, intval($post->kolvo));
    //$zakaz->artikul = $post->artikul;
    //$zakaz->comments = $post->comments;
    $zakaz->user_id = $log->user_id;
    $zakaz->landing_id = $log->landing_id;
    $zakaz->prelanding_id = $log->prelanding_id;

    $zakaz->subid1 = $log->subid1;
    $zakaz->subid2 = $log->subid2;
    $zakaz->subid3 = $log->subid3;
    $zakaz->subid4 = $log->subid4;
    $zakaz->subid5 = $log->subid5;
    $zakaz->stream = $log->stream;

    $zakaz->comission = $payment;
    $zakaz->pinger_type = 'Offer_Pinger_LeadTrade';
    $zakaz->pinger_value = $click_id;
    
/*
    $client->name = $post->name;
    $client->phone = $post->phone;
    $client->email = $post->email;
    $client->address = $post->address;
*/
    $api = new Api;
    try {
        $zakaz = $api->createOrder($client, $offer, $zakaz);
        //echo $zakaz->id;
    } catch (Exception $e) {
        //echo $e->getMessage();
        exit;
    }
    exit;
    
}elseif($status == 'approve'){
    

    
}elseif($status == 'cancel'){
    
    
    
}else{
    die();
}