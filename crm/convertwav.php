<?php
$process = shell_exec("lame -b 128 -m j -h -V 1 -B 256 -F /var/www/crm/rec/3003166.wav /var/www/crm/rec/3003166.mp3");
var_dump($process);