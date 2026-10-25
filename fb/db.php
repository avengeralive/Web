<?php
session_start();
require "libs/rb.php";
 R::setup('mysql:host=127.0.0.1;dbname=fb7915xs_552651',
        'fb7915xs_552651','&e07jlKp' ); 
//session_start();
	
$host = '127.0.0.1';
$db   = 'fb7915xs_552651';
$user = 'fb7915xs_552651';
$pass = '&e07jlKp';
$charset = 'utf8';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
$pdo = new PDO($dsn, $user, $pass, $opt);
$pdo->exec("SET NAMES utf8");

?>