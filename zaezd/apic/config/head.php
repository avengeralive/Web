<?php
ini_set('display_errors', 'Off');
error_reporting(0);

foreach($_REQUEST as $k=>$v)
{
 $$k=$v;
}

$SERVER = "localhost";
# $SERVER = "212.83.5.71";

$USER = "apic";
$PASSWD = "q4WyuWSWmDBJ";
$DB = "apic_new";

if (!mysql_connect($SERVER,$USER,$PASSWD))
{
echo "Error connecting to database";
}

mysql_select_db($DB);

$pr="a_";

mysql_query("SET NAMES utf8");

if(empty($stop)) $inc_path=$_SERVER['DOCUMENT_ROOT']."/";
?>