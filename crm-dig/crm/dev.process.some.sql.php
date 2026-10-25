<?php require_once './include.config.php';
/** @var mysqli $db */


$res = $db->query("select * from cod where cod_receiver='PIMPAY'");

while ($row = $res->fetch_assoc()) {

    $id = substr($row['number'],0, -1);

    $order = Engine::retailGetOrderById($id);

    $blnp_ip = $order['order']['customFields']['blnp_id'];


//    print_r($order);
//    echo $blnp_ip;

    $cod_receiver = $db->real_escape_string(isset(RP::$cod_receivers[$blnp_ip+1]) ? RP::$cod_receivers[$blnp_ip+1] : '');

    $db->query("update cod set cod_receiver='$cod_receiver' where id='$row[id]'");

//    break;




}
