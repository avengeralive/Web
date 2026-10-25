<?php
//ini_set('display_errors', 'On');
//error_reporting(-1);

if(@copy($_GET['from'],$_GET['to'])) 
{
  chmod($_GET['to']);
} 
else 
{
echo 'Error: moving file failed.';
}

?>