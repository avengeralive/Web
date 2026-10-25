<?php
include dirname(__FILE__) . '/includes/config.php';
$zm = new Users_Manager(DB::getInstance());
$zm->where('tip', 40);
$zm->where('type_rekl', 0);
$zm->where('api_owner_status', 1);
$zm->limit(-1);
$list = $zm->get();
foreach($list as $owners){  
    $owner_id = $owners->id;
    $owner = User::getById($owner_id);
    $balance = $owner->balance;   
    if($balance > 700){
        $owner->update([
            'api_owner_status' => 0
        ]);    
        
        $zm = new Zakaz_Manager( DB::getInstance());
        $zm->where('pinger_type', '');
        $zm->where('status', 1);
        $zm->where('owner_id', $owner_id);
        $zm->limit(-1);
        $list = $zm->get();
        foreach($list as $zakaz){
            $o = Offer::getById($zakaz->offer_id);
            $o->pingOtherCpa($zakaz);                               
        } 
        
    }

}