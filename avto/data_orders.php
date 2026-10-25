<?php
include('common_bo.php');

if ($_GET['action'] == 'get_status_list')
{
	echo json_encode(array(
		'rows'    => \Sale\Order::getStatuses()
	));	
	die();
}
elseif ($_GET['action'] == 'get_pay_status_list')
{
	echo json_encode(array(
		'rows'    => \Sale\Order::getPayStatuses()
	));	
	die();
}
elseif ($_GET['action'] == 'update') {
	$d = json_decode(file_get_contents("php://input"), true);
	
	$order = \Sale\Order::getById( $d['id'] );
	$order->setParams( $d );
	$order->save();
	$orders = \Sale\Order::enum()->where('id='.$d['id']);
}
elseif ($_GET['action'] == 'delete') {
	$d = json_decode(file_get_contents("php://input"), true);
	
	$order = \Sale\Order::getById( $d['id'] );
	$order->delete();
	die();
}
else {
	$orders = \Sale\Order::enum()->setItemCountPerPage( $_GET['limit'] )->setCurrentPageNumber( $_GET['page'] );
}

if (isset($_GET['sort'])) {
	$orders->orderBy($_GET['sort'],$_GET['dir']);
}
$data = array();

foreach ($orders as $o)
	$data[] = array(
		'id'         => $o->id,
		'date'       => $o->date,
		'total'      => $o->getTotal(),
		'user_id'    => $o->user_id,
		'status_text'=> $o->getStatusText(),
		'paid_text'  => $o->getPayText(),
		'status'     => $o->status,
		'paid'       => $o->paid,		
		'products'   => $o->getProducts(),
		'props'      => array_values($o->getProps()),
		'buyer'      => $o->getName().' ('.$o->getEmail().')',
		'payment_id' => $o->getPaymentId(),
		'payment_data' => $o->getPaymentData(),
		'delivery_id' => $o->getDeliveryId(),
		'delivery_data' => $o->getDeliveryData(),
		'delivery_cost' => $o->getDeliveryCost(),
		'delivery_note' => $o->getDeliveryNote(),
		'products_cost' => $o->getProductsCost(),
	);

echo json_encode(array(
    'success' => true,
	'total'   => $orders->getCountAll(),
    'rows'    => $data
));