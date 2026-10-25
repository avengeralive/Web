<?php
$pass = 'JHHUIYG&$yfjgf54765rJKHGkkijhg';
$CONNECT = mysqli_connect("10.8.0.1","root",$pass,"crm") or die("Не удалось подключиться");
$ids = $_POST['ids'];
$param = $_POST['param'];
$list = $_POST['list'];


mysqli_query($CONNECT, "UPDATE list".$list." SET `dop11` = '1' WHERE `id` = '$ids'") or die("Не удаслось обновить");

$file = '../pdfAlert.txt';
if($param == 1){
    $log = date('Y-m-d H:i:s').' - Посылка Онлайн         - '.$ids;
}elseif($param == 2){
    $log = date('Y-m-d H:i:s').' - Посылка нестандартная  - '.$ids;
}

if (!file_exists($file)) {
    $fp = fopen($file, "w"); 
    fwrite($fp, $log);
    fclose($fp);
    echo '1';
}else {
    $fh = fopen($file, "a+");
    $success = fwrite($fh, $log.PHP_EOL);
    fclose($fh);
    echo '2';
}
?>