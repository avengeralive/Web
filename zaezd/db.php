<?
$host = 'sql439.your-server.de';
$db   = 'hostingdata';
$user = 'hostingdata';
$pass = 'gDdRtUh9Tf3eRBiz';
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