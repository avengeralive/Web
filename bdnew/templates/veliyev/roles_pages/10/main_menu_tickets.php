<?php
$found_ticket='0';

if ($user_tip == '10' || $user_tip == '40' ) {
    $s = $mysqli->query("SELECT id FROM tickets WHERE (`komu`='$user_id'  OR `ot_kogo`='$user_id') and `status_new`='1'");
    $found_ticket = $s->num_rows;
}

?>

