<?php
require("config/head.php");
require($inc_path."config/config.php");

ini_set('session.gc_maxlifetime', 7200);
ini_set('session.cookie_lifetime', 7200);

session_name($session_name);
session_start();

//print_r($_SESSION);
include($inc_path."service/start.php");
include($inc_path."service/login.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>Рассылка АПИК</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta http-equiv="content-language" content="ru-RU" />
<meta name="robots" content="noindex, nofollow" />
<link rel="stylesheet" type="text/css" href="/nr/files/style.css"/>
<script language="Javascript" src="/nr/files/ckeditor.js" type="text/javascript"></script>
</head>