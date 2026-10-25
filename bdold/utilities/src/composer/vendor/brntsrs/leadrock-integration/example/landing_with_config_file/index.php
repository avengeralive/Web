<?php
include '../../vendor/autoload.php';

$config = new \Leadrock\Items\Config('config.php');
$integration = new \Leadrock\Integration($config);

include 'landing.html';

$integration->end();