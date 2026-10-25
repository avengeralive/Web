<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);

foreach($_REQUEST as $k=>$v)
{
 $$k=$v;
}

# $SERVER = "localhost";
$SERVER = "212.83.5.71";

$USER = "apic";
$PASSWD = "q4WyuWSWmDBJ";
$DB = "apic_new";

if (!mysql_connect($SERVER,$USER,$PASSWD))
{
echo "Error connecting to database";
}
else 
{
echo 'connect!';
}

mysql_select_db($DB);

?>
