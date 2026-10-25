<?php
ini_set('display_errors', 'Off');
error_reporting(0);

foreach($_REQUEST as $k=>$v)
{
 $$k=$v;
}

$SERVER = "localhost";
$USER = "root";
$PASSWD = "";
$DB = "apic2016";

if (!mysql_connect($SERVER,$USER,$PASSWD))
{
echo "Error connecting to database";
}

mysql_select_db($DB);

$pr="a_";

mysql_query("SET NAMES utf8");

if(empty($stop)) $inc_path=$_SERVER['DOCUMENT_ROOT']."/";
?>