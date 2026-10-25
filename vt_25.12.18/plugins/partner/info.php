<?php
include_once('common_bo.php');

$cid = $application->getVar('id');
$partner = \Partner\Partner::getById($cid);

echo json_encode(array(
	'id'           => $partner->id,
	'partner_link' => 'http://fastsite.ru/?partner='.$partner->id,
	'balance'      => $partner->getBalance(),
	'transactions' => $partner->getTransactions(),
));