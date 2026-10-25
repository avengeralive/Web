<?php
$s1 = file_get_contents("php://input");
file_put_contents(__DIR__ . '/bot/test.txt', $s1."\n", FILE_APPEND );
?>