<?php
include dirname(__FILE__) . '/includes/config.php';

$CronController = CronController::sendMailing();
$CronController = CronController::checkEvents();
