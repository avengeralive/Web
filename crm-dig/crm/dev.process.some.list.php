<?php require_once './include.config.php';
/** @var mysqli $db */


//echo "123"; exit;

$list = <<<txt
80081155741136   
80084455938398
80084955329115


txt;


$list = explode("\n", $list);

$f = fopen('list.csv', 'w');

foreach ($list as $line) {

    $line = trim($line);
    if (!$line) continue;

//    $order_id = substr($line, 0, strlen($line)-1);
    $order_id = $line;

    $order = $db->query("select * from rp_orders where barcode='$order_id'")->fetch_assoc();

    if (!$order) fputcsv($f, [$line], ';');
    else {
        $account_id = $order['rp_account_id'];
        $acc = $db->query("select * from rp_accounts where id='$account_id'")->fetch_assoc();
        $data = json_decode($acc['data'], true);
//        fputcsv($f, [$line, "=\"$order[barcode]\"", $data['sender'], $data['client'] ], ';');
//        fputcsv($f, [$line, RP::$cod_receivers[$order['cod_receiver']], $order['barcode'], $data['sender'], $data['client'] ], ';');
        fputcsv($f, [$order['barcode'], RP::$cod_receivers[$order['cod_receiver']], $data['sender'], $data['client'] ], ';');
    }

//    break;

}

fclose($f);

echo nl2br(file_get_contents('list.csv'));
