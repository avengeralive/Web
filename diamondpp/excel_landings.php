<?php

$CONNECT = mysqli_connect('localhost','root','5JTLc75A5JTLc75A','cpa') or die('Не удалось подключиться к базе');
$data = '<table border="1"><thead><tr><td><b>ID</b></td><td><b>Название</b></td><td><b>URL</b></td><td><b>Оффер</b></td><td><b>Статус оффера</b></td></tr></thead>';
$date = '123';
$cnt = 0;
$offers = mysqli_query($CONNECT,"SELECT * FROM landings ORDER BY `id` DESC");
while ($res = mysqli_fetch_assoc($offers)) {
    $sql_viewoffer = "SELECT id,name,active FROM offers WHERE `id`='".$res['offer_id']."'";
    $result_viewoffer = mysqli_query($CONNECT,$sql_viewoffer);
    if (mysqli_num_rows($result_viewoffer) > 0) {
        $res_viewoffer = mysqli_fetch_array($result_viewoffer);
        $id_of = htmlentities($res_viewoffer['id']);
        $name_of = htmlentities($res_viewoffer['name']);
        $active_of = htmlentities($res_viewoffer['active']);
    } else {
        $name_of = 'Нет';
        $active_of = 'Нет';
    }
    $data .= "<tr>";
    $data .= "<td>".$res['id']."</td>";
    $data .= "<td>".$res['name']."</td>";
    $data .= "<td>".$res['url']."</td>";
    $data .= "<td>".$name_of."</td>";
    $data .= "<td>".$active_of."</td>";
    $data .= "</tr>";
}
$data .= "</table>";
header( "Content-Type: application/vnd.ms-excel" );
header( "Content-disposition: attachment; filename=export.".$date.".xls" );
echo $data;
?>