<? session_start();
var_dump($_SESSION);
$_SESSION["test"] = "test";
var_dump($_SESSION);
?>