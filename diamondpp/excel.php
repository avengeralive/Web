<?php
$CONNECT = mysqli_connect('localhost','root','5JTLc75A5JTLc75A','cpa') or die('Не удалось подключиться к базе');
$data = '<table border="1"><thead><tr><td><b>ID</b></td><td><b>Name</b></td><td><b>Webmaster</b></td><td><b>Гео</b></td><td><b>Цена</b></td><td><b>Комиссия</b></td><td><b>Комиссия CPA</b></td><td><b>Рекл</b></td></tr></thead>';
$date = '123';
$cnt = 0;
$offers = mysqli_query($CONNECT,"SELECT * FROM `offers` WHERE 1");
while ($res = mysqli_fetch_assoc($offers)) {
    $cnt++;
    $data .= "<tr>";
    $data .= "<td>".$res['id']."</td>";
    $data .= "<td>".$res['name']."</td>";
    $data .= "<td>";
    $users = mysqli_query($CONNECT,"SELECT * FROM `offers_visible` WHERE `offer_id` = $res[id]");
    while($res_u = mysqli_fetch_assoc($users)){
        $data .= $res_u['user_id'].",";
    }
    $data .= "</td>";
    $data .= "<td>".$res['geo']."</td>";
    $data .= "<td>".$res['cena']."</td>";
    $data .= "<td>".$res['comission']."</td>";
    $data .= "<td>".$res['comission_cpa']."</td>";
    $user = mysqli_query($CONNECT,"SELECT * FROM `users` WHERE id = ".$res['owner_id']);
    $u = mysqli_fetch_assoc($user);
    $data .= "<td>".$u['email'].' ('.$u['balance'].")</td>";
    $data .= "</tr>";
}
$data .= "</table>";
header( "Content-Type: application/vnd.ms-excel" );
header( "Content-disposition: attachment; filename=export.".$date.".xls" );
echo $data;
?>