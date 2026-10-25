<?php
require("../config/head.php");
require($inc_path."config/config.php");

session_name($session_name);
session_start();

echo "ok";
?>