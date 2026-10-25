<?php
var_dump($_SERVER['REMOTE_ADDR'].' '.$_SERVER['X_FORWARDED_FOR']);
file_put_contents ( './ips.txt', $_SERVER['REMOTE_ADDR'].' '.$_SERVER['X_FORWARDED_FOR'], FILE_APPEND );