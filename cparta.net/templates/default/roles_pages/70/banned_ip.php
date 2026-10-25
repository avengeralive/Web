<?

if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    if (isset($_GET['id'])) {
        $sql = "DELETE FROM banned_ip WHERE id = ".$_GET['id'];
        $result = $mysqli->query($sql);
    }
}
if (isset($_GET['action']) && $_GET['action'] == 'ban') {
    if (isset($_GET['zakaz'])) {
        $sql = "SELECT name, phone, ip FROM zakaz WHERE id = ".$_GET['zakaz'];
        $result = $mysqli->query($sql);
        $result_view = mysqli_fetch_array($result);
        $sql = 'INSERT INTO banned_ip(`name`, `phone`, `ip`) VALUES ("'.$result_view['name'].'", "'.$result_view['phone'].'", "'.$result_view['ip'].'")';
        $result = $mysqli->query($sql);
    }
}

$sql_banned_ip = "SELECT * FROM banned_ip";
$result_banned_ip = $mysqli->query($sql_banned_ip);

?>
<div class="col-12 mb-30">        
	<table class="table table-bordered text-center">
		<tr class="tableHead" style="text-align: center;">
            <th>Имя</th>
            <th>Телефон</th>
            <th>IP</th>
            <th></th>
		</tr>
        <? while ($result_banned_ip_view = mysqli_fetch_array($result_banned_ip)) { ?>
        <tr>
            <td><?=$result_banned_ip_view['name'];?></td>
            <td><?=$result_banned_ip_view['phone'];?></td>
            <td><?=$result_banned_ip_view['ip'];?></td>
            <td><a href="/banned_ip.php?action=delete&id=<?=$result_banned_ip_view['id'];?>">Удалить</a></td>
        </tr>
        <? } ?>
	</table>     
</div>