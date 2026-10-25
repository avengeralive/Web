<?php
include '../../vendor/autoload.php';

$providerFrom = new \Leadrock\Providers\File('leads_log.txt');
$providerTo = new \Leadrock\Providers\Leadrock('1278g3', 'so4ircshboiuerbvs');

$providerTo->restoreFromOtherProvider($providerFrom);