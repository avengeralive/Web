<?php

# Ищем кто сливает заказы и записываем в лог файл
#

use lib\Debugging;

$ratUser = $_POST['userId'];
$ratUserName = $_POST['userName'];

$file = '../rat_log.txt';
$log = date('Y-m-d H:i:s').' - '.$ratUser.' - '.$ratUserName.' - '.$_POST['param'] . ' '.$_POST['btn'];

if ( is_writeable($file) ) :
    $fh = fopen($file, "a+");
    $success = fwrite($fh, $log.PHP_EOL);
    fclose($fh);
else:
    print "Could not open Sfilename for writing";
endif;


?>