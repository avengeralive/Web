<?php
foreach($_REQUEST as $k=>$v)
{
 $$k=$v;
}

$SERVER = "localhost";
//$USER = "apic";
//$PASSWD = "q4WyuWSWmDBJ";
$DB = "apic_new";


$USER = "root";
$PASSWD = "";

if (!mysql_connect($SERVER,$USER,$PASSWD))
{
echo "Error connecting to database";
}


mysql_select_db($DB);

$folder="new/";
$pr="apic_";
?>