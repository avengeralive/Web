<?php require_once 'include.config.php';

$query = "select * from orders where id<=331000";

$res = $db->query($query);

while ($row = $res->fetch_assoc()) {

    $phone = Engine::normalizePhone($row['phone']);

    if ((string)$phone !== (string)$row['phone']) {
        echo "$row[phone] -> $phone\n";
        $db->query("update orders set phone='$phone' where id='$row[id]'");
    }

}
