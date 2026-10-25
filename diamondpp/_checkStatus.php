<?php
$bootstrap = true;
/*ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL & ~E_NOTICE);*/
// ini_set('error_reporting', E_ALL);
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);

function telegram($text){
    if(is_array($text)) $text = implode(",",$text);
    $token = "696735574:AAEpKD9CaGW8Op45ezmFkslDSd9VIhT3WGc";
    $chat_id = "-323189907";

    $sendToTelegram = fopen("https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&parse_mode=html&text={$text}","r");
    return $sendToTelegram;
}
//telegram('!!!');

include dirname(__FILE__) . '/includes/config.php';
$db = $mysqli;
$data = [
    'db_config' => [
        'name' => 'cpa',
        'host' => 'localhost',
        'user' => 'root',
        'pass' => '5JTLc75A5JTLc75A',
    ]
];
spl_autoload_register(function ($class_name) {
    if(strripos($class_name,"_")) {
        $class_name = explode("_",$class_name);
    }
    // echo $class_name.PHP_EOL;
    if(is_array($class_name) && $class_name[0] == 'Offer' && file_exists(dirname(__FILE__).'/utilities/src/Offer/Pinger/'.$class_name[2].'.php')){
        include_once dirname(__FILE__).'/utilities/src/Offer/Pinger/'.$class_name[2].'.php';
    }elseif(!is_array($class_name) && file_exists(dirname(__FILE__).'/utilities/src/'.$class_name.'.php')){
        include_once dirname(__FILE__).'/utilities/src/'.$class_name.'.php';
    }elseif(is_array($class_name) && $class_name[0] == 'Providers' && file_exists(dirname(__FILE__).'/utilities/src/Providers/'.$class_name[1].'.php')){
        include_once dirname(__FILE__).'/utilities/src/Providers/'.$class_name[1].'.php';
    }
});

Registry::set('di', $data);

$QQ = "SELECT * FROM `zakaz` WHERE `pinger_type` != '' AND `status` = 1";
$zakazTable = $mysqli->query($QQ);
echo mysqli_num_rows($zakazTable).PHP_EOL;
// echo dirname(__FILE__);
include_once dirname(__FILE__).'/utilities/src/Entity.php';
include_once dirname(__FILE__).'/utilities/src/Zakaz.php';
include_once dirname(__FILE__).'/utilities/src/Offer/Pinger.php';

$zakaz = new Zakaz();
while($res = $zakazTable->fetch_assoc()){
    echo $res['id'].PHP_EOL;
    //telegram($res['id']);
    $zakaz->id                  = $res['id'];
    $zakaz->user_id             = $res['user_id'];
    $zakaz->pinger_type         = $res['pinger_type'];
    $zakaz->pinger_value        = $res['pinger_value'];
    $zakaz->externalId          = $res['externalId'];
    $zakaz->offer_id            = $res['offer_id'];
    $zakaz->owner_id            = $res['owner_id'];
    $zakaz->name                = $res['name'];
    $zakaz->phone               = $res['phone'];
    $zakaz->artikul             = $res['artikul'];
    $zakaz->ip                  = $res['ip'];
    $zakaz->country             = $res['country'];
    $zakaz->region              = $res['region'];
    $zakaz->town                = $res['town'];
    $zakaz->referer             = $res['referer'];
    $zakaz->externalWebmaster   = $res['externalWebmaster'];
    $zakaz->externalWebmaster2  = $res['externalWebmaster2'];
    $zakaz->check();
}

