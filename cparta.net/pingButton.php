<?php
include dirname(__FILE__) . '/includes/config.php';

$file = dirname(__FILE__) . '/_statuses';
$count = file_get_contents($file);

$zm = new Zakaz_Manager( DB::getInstance());
$zm->where(false, 'id in ('.$_REQUEST['id'].')', Entity_Manager::WHERE_RAW);
//$zm->where('id', $_REQUEST['id'], '=');
$list = $zm->get();
//var_dump($list);

foreach($list as $zakaz){
	//var_dump($zakaz);
	$offer = Offer::getById($zakaz->offer_id);
	$offer->pingOtherCpa($zakaz);
	//$sql = "select * from offers_owner where approve_ok>0 and offer_id=" . $this->id;
    //$stmt = DB::getInstance()->query($sql);
   // $x = $stmt->fetchObject();
	//var_dump($offer);
	//$settings = $offer->id;
    //$zakaz->pingAgain($settings);
    //Offer::
}
if (count(explode(',', $_REQUEST['id'])) == 1) header('Location: https://cparta.net/zakaz.php?ob='.$_REQUEST['id']);
else header('Location: https://cparta.net/zakaz.php');