<?php
include dirname(__FILE__) . '/includes/config.php';

$db = DB::getInstance();

$settings = Settings::getById(1);
$settings->update([
    'date_check' => date('Y-m-d в H:i:s', time() ),
]);
//$checker->add(new Frod_Criteria_Cr($db, 3));
//$checker->run();

$zm = new Zakaz_Manager($db);
$zm->where('checker', 0);
$zm->where('status', [5,0], Entity_Manager::WHERE_NOT_IN);
$zm->sortBy('id', 'asc');
$zm->limit(500);
$list = $zm->get();

foreach($list as $zakaz){
    $checker = new Frod_Checker();
    $check_PastedOrOnline = $checker->check_PastedOrOnline( $zakaz, $settings->online_lid , $settings->pasted_lid );
    $check_WebIP = $checker->check_WebIP($zakaz, $settings->web_ip);
    $check_SameIP = $checker->check_SameIP($zakaz, $settings->same_ip);
    $check_NoRerrer = $checker->check_NoRerrer($zakaz, $settings->no_referer);
    $check_HR = $checker->check_HR($zakaz, $settings->phone_dost);
    $check_PhoneGeo = $checker->check_PhoneGeo($zakaz, $settings->phone_geo);
    $check_Blacklist = $checker->check_Blacklist($zakaz, $settings->blacklist);
    
    if($check_PastedOrOnline !== true || $check_WebIP !== true || $check_SameIP !== true || $check_HR !== true || $check_PhoneGeo !== true){
        $f = new Frod_Blacklist();
        $f->ip = $zakaz->ip;
        $f->phone = $zakaz->phone;
        $f->create();
        
        $zakaz->update([
            'checker' => 1,
        ]);

    }
    break;
}

$u = new Users_Manager($db);
$u->where('tip', 10);
$u->where('active', [5,0], Entity_Manager::WHERE_NOT_IN);
$u->sortBy('id', 'asc');
$u->limit(-1);
$list = $u->get();

foreach($list as $user){
    $checker = new Frod_Checker();
    //$check_WebmoneyBL = $checker->check_WebmoneyBL($zakaz, 2);
    //$check_SkypeContacts = $checker->check_SkypeContacts($zakaz, 2);
    $check_Payments = $checker->check_Payments($user);
    $check_FrodUser = $checker->check_FrodUser($user, $check_Payments);
}