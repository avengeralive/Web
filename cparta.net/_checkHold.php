<?php
include dirname(__FILE__) . '/includes/config.php';
$zm = new Zakaz_Manager( DB::getInstance());
$zm->where('status', 2);
$zm->limit(-1);
$list = $zm->get();
foreach($list as $zakaz){   
    $offer = Offer::getById($zakaz->offer_id);
    $hold = $offer->hold;   
    $date_obrabotka = explode(' ', $zakaz->date_obrabotka);
    $date_obrabotka_date = explode('.', $date_obrabotka[0]);
    $date_obrabotka_time = explode(':', $date_obrabotka[1]);    
    $webmaster = User::getById($zakaz->user_id);   
    if($webmaster->hold_days != 0){
        $hold = $webmaster->hold_days;
    }
    $date_obrabotka =  mktime($date_obrabotka_time[0], $date_obrabotka_time[1], $date_obrabotka_time[2], $date_obrabotka_date[1], $date_obrabotka_date[0], $date_obrabotka_date[2]);
    $days_from_obrabotka = $date_obrabotka + ((3600*24)*$hold);     
    if($days_from_obrabotka >= time()){
        continue;
    }
    $comments = '';
    $zakaz->updateZakaz($zakaz->id, 3, $comments);
    echo $zakaz->id;
    echo '<br>';
}