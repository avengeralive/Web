<?php
error_reporting(-1);
ini_set('display_errors', 'On');
set_error_handler("var_dump");
var_dump(mail('office@veliyev.ru', 'My Subject', '1234'));