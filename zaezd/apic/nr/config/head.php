<?php
foreach($_REQUEST as $k=>$v)
{
 $$k=$v;
}

$SERVER = "localhost";
$USER = "apic";
$PASSWD = "q4WyuWSWmDBJ";
$DB = "apic_new";

if (!mysql_connect($SERVER,$USER,$PASSWD))
{
echo "Error connecting to database";
}
mysql_select_db($DB);

mysql_query("SET NAMES utf8");

$base_url='/nr/';
$inc_path=$_SERVER['DOCUMENT_ROOT'].$base_url;

$pr="nr_";
?>