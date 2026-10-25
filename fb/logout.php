<?php 

require "db.php";
unset($_SESSION);
session_destroy();
header('Location: lich.php');

?>