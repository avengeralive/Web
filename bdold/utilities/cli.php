<?php

require dirname(__FILE__) . '/bootstrap.php';

if (!isset($argv[1])) {
    exit("Not supported" . $argv[1]);
}
if ($argv[1] == 'mailing') {
    $m = new CronController();
    $m->sendMailing();
}
if ($argv[1] == 'monsterlead') {
    $m = new ProvidersController();
    $m->checkMonster();
}
if ($argv[1] == 'trands') {
    $m = new TrandsController();
    $m->checkTrands();
}

if ($argv[1] == 'stat') {
    $s = new TrandsController();
    $s->stats();
}
if ($argv[1] == '30min') {
    $m = new TrandsController();
    $m->checkTrands();
    Offer::updateCrAndEpcForAll();
}
if ($argv[1] == 'events') {
    $m = new CronController();
    $m->checkEvents();
    
}