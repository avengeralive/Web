<?php
namespace lib;

$QQ = "SELECT * FROM list19 WHERE `status` = '5' AND `pendingOrders` != ''";
$con = JBase::Query($QQ);
$cnt = 1;

echo '
<table class="requesttable" searcher="" cellpadding="10" cellspacing="0" border="0" style="width:100%">
<thead id="table_content" style=""><tr class="table_content">
    <th label="ids" style="max-width:15px;"><span></span></th>
	<th label="ids" style="min-width:60px;"><span>ID</span></th>
    <th label="russianpostTrack" style="min-width:100px;"><span>Трэк номер</span></th>
	<th label="post_status" style="min-width:100px;"><span>Статус Почты</span></th>
    <th label="Date" style="max-width:100px;"><span>Дата статуса</span></th>
    <th label="shippedAt" style="min-width:100px;"><span>Дата отправки</span></th>
</tr></thead>
<tbody style="">';
while ($res = $con->fetch_assoc()) {
    list($status,$time) = explode(",",$res['pendingOrders']);

    $date = date('d.m.Y',$time);
    $shippedAt = date('d.m.Y',$res['shippedAt']);
    echo '<tr class="request">
    <td style="height:70px;">'.$cnt.'</td>
       <td style="height:70px;">№'.$res['id'].'</td>
       <td style="height:70px;">'.$res['russianpostTrack'].'</td>
       <td style="height:70px;">'.$status.'</td>
       <td style="height:70px;">'.$date.'</td>
       <td style="height:70px;">'.$shippedAt.'</td>
       </tr>';

    // echo $cnt.') '.$Keys.'<br>';
    $cnt++;
}
echo '</tbody>
</table>';
?>