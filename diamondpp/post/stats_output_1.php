<?php

include '../includes/detectdomain/index.php';
include '../localizations/russian.php';

$visits_all = 0;
$hosts_all = 0;
$zakaz_ok_all = 0;
$zakaz_hold_all = 0;
$zakaz_wait_all = 0;
$zakaz_cancel_all = 0;
$zakaz_trash_all = 0;
$comission_ok_all = 0;
$comission_hold_all = 0;
$comission_wait_all = 0;
$comission_cancel_all = 0;
$comission_trash_all = 0;
$track_online_all = 0;
$cvet = 0;
$content = '';

$orderby = (isset($typeSort) AND $typeSort != '') ? htmlentities($typeSort) : 'dates';
$ascdesc = (isset($offset) AND $offset != '') ? htmlentities($offset) : 'DESC';

$sql = "SELECT * FROM statistics WHERE `userid` = '$user_id' ORDER BY `" . $orderby . "` " . $ascdesc;
//var_dump($sql);
$result = $mysqli->query($sql);
while ($res = mysqli_fetch_array($result)) {

    $dates = htmlentities($res['dates']);
    $visits = htmlentities($res['visits']);
    $hosts = htmlentities($res['hosts']);
    $zakaz_all_in_day = htmlentities($res['zakaz_all_in_day']);
    $comission_all_in_day = htmlentities($res['comission_all_in_day']);
    $zakaz_ok = htmlentities($res['zakaz_ok']);
    $zakaz_hold = htmlentities($res['zakaz_hold']);
    $zakaz_wait = htmlentities($res['zakaz_wait']);
    $zakaz_cancel = htmlentities($res['zakaz_cancel']);
    $zakaz_trash = htmlentities($res['zakaz_trash']);
    $comission_ok = htmlentities($res['comission_ok']);
    $comission_hold = htmlentities($res['comission_hold']);
    $comission_wait = htmlentities($res['comission_wait']);
    $comission_cancel = htmlentities($res['comission_cancel']);
    $comission_trash = htmlentities($res['comission_trash']);
    $cr = htmlentities($res['cr']);
    $epc = htmlentities($res['epc']);
    $approove = htmlentities($res['approove']);

    // Назначаем переменные для вывода сводных данных (итого)
    // Assign variables to display summary data (total)
    $visits_all+=$visits;
    $hosts_all+=$hosts;
    $zakaz_ok_all+=$zakaz_ok;
    $zakaz_hold_all+=$zakaz_hold;
    $zakaz_wait_all+=$zakaz_wait;
    $zakaz_cancel_all+=$zakaz_cancel;
    $zakaz_trash_all+=$zakaz_trash;
    $comission_ok_all+=$comission_ok;
    $comission_hold_all+=$comission_hold;
    $comission_wait_all+=$comission_wait;
    $comission_cancel_all+=$comission_cancel;
    $comission_trash_all+=$comission_trash;
    $track_online_all+=$res['track_online'];
    if ($cvet & 1) {
        $classTr = 'col2';
    } else {
        $classTr = '';
    } $cvet++;
    $content .= '
			<tr class="' . $classTr . ' statstr">
				<td>
                <nobr>
                ' . date("d.m.Y", $dates) . '
                </nobr>
                </td>
				<td><nobr>' . $visits . '</nobr></td>
				<td><nobr>' . $hosts . '</nobr></td>
				<td><nobr>' . $zakaz_wait . '</nobr></td>
				<td><nobr>' . $zakaz_all_in_day . '</nobr></td>
				<td><nobr>' . $zakaz_cancel . '</nobr></td>
				<td><nobr>' . $zakaz_trash . '</nobr></td>
				<td><nobr>' . sprintf("%.2f", $comission_wait) . '&nbsp;' . $loc["stats.php"]["t26"] . '&nbsp;</nobr></td>
				<td><nobr>' . sprintf("%.2f", $comission_all_in_day) . '&nbsp;' . $loc["stats.php"]["t26"] . '&nbsp;</nobr></td>
				<td><nobr>' . sprintf("%.2f", $comission_cancel) . '&nbsp;' . $loc["stats.php"]["t26"] . '&nbsp;</nobr></td>
				<td><nobr>' . sprintf("%.2f", $comission_trash) . '&nbsp;' . $loc["stats.php"]["t26"] . '&nbsp;</nobr></td>
				<td><nobr>' . $cr . '</nobr></td>
				<td><nobr>' . $epc . '</nobr></td>
				<td><nobr>' . $approove . '</nobr></td>
				<td><nobr>' . str_pad(round($res['track_online'] / 60), 2, '0', 0) . ':' . str_pad($res['track_online'] % 60, 2, '0', 0) . '</nobr></td>
			</tr>
			';
}









$cr_all = ($hosts_all != '0') ? round((($zakaz_ok_all + $zakaz_cancel_all + $zakaz_hold_all + $zakaz_wait_all + $zakaz_trash_all) / $hosts_all) * 100, 2) : 0;
$epc_all = ($hosts_all != '0') ? round(($comission_ok_all + $comission_hold_all) / $hosts_all, 2) : 0;

if ($hosts_all != '0') {
    $kolvo_zakaz_all = $zakaz_wait_all + $zakaz_hold_all + $zakaz_cancel_all + $zakaz_ok_all;
    if ($kolvo_zakaz_all != '0') {
        $approove_all = sprintf("%.2f", 100 / $kolvo_zakaz_all * ($zakaz_ok_all + $zakaz_hold_all));
    } else {
        $approove_all = '0';
    }
} else {
    $approove_all = '0';
}
$content .= '<tr class="statstr" height="10px"><td colspan="16"></td></tr>';

$zakaz_all_all = $zakaz_ok_all + $zakaz_hold_all;
$content .= '
		<tr style="background: #e1ecf5;" class="statstr">
			<td><nobr><b>' . $loc["stats.php"]["t27"] . '</b></nobr></td>
			<td style="width: 75px;"><nobr>' . $visits_all . '</nobr></td>
			<td style="width: 75px;"><nobr>' . $hosts_all . '</nobr></td>
			<td style="width: 75px;"><nobr>' . $zakaz_wait_all . '</nobr></td>
			<td style="width: 75px;"><nobr>' . $zakaz_all_all . '</nobr></td>
			<td style="width: 75px;"><nobr>' . $zakaz_cancel_all . '</nobr></td>
			<td style="width: 75px;"><nobr>' . $zakaz_trash_all . '</nobr></td>
			<td style="width: 100px;"><nobr>' . sprintf("%.2f", $comission_wait_all) . '&nbsp;' . $loc["stats.php"]["t26"] . '&nbsp;</nobr></td>
			<td style="width: 100px;"><nobr>' . sprintf("%.2f", $comission_ok_all + $comission_hold_all) . '&nbsp;' . $loc["stats.php"]["t26"] . '&nbsp;</nobr></td>
			<td style="width: 100px;"><nobr>' . sprintf("%.2f", $comission_cancel_all) . '&nbsp;' . $loc["stats.php"]["t26"] . '&nbsp;</nobr></td>
			<td style="width: 100px;"><nobr>' . sprintf("%.2f", $comission_trash_all) . '&nbsp;' . $loc["stats.php"]["t26"] . '&nbsp;</nobr></td>
                            
            <td><nobr>' . $cr_all . '</nobr></td>
            <td><nobr>' . $epc_all . '</nobr></td>
            <td><nobr>' . $approove_all . '</nobr></td>
                <td><nobr>' . str_pad(round($track_online_all / 60), 2, '0', 0) . ':' . str_pad($track_online_all % 60, 2, '0', 0) . '</nobr></td>
		</tr>
        ';

$array = array(
    "status" => "success",
    "content" => $content
);
echo json_encode($array);
exit;
