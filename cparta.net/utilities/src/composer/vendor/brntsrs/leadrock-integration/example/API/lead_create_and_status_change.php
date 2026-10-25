<?php
include '../../vendor/autoload.php';

$trackId = '10001.1234567890';

$lead = new \Leadrock\Items\Lead($trackId);
$lead->addProvider(
    new \Leadrock\Providers\Leadrock('1278g3', 'so4ircshboiuerbvs')
);
$lead->setParam('user_name', 'Han Solo');
$lead->setParam('other', 'on Millenium Falcon');
$lead->setParam('user_phone', '+1 555 0000000');
$lead->save();

$lead->changeStatus(Leadrock\Items\Lead::STATUS_APPROVED);
$lead->save();

$lead->changeStatus(Leadrock\Items\Lead::STATUS_REJECTED);
$lead->save();