<?
session_start();


if (isset($_POST['login']) && isset($_POST['password']))
{
	include('db.php');
	//$sql = 'SELECT * FROM users WHERE LOWER(login) = :login AND password = :password';
	//$stmt = $pdo->prepare($sql);
	//$stmt->execute(array(":login" => strtolower($_POST['login']), ":password" => md5($_POST["password"])));
	//$rows = $stmt->fetchAll();

	//if ($rows) {
		$_SESSION["user"] = "test";
		header("location: index.php");
	//}
}

if (!isset($_SESSION['user'])) {
?>
<form action="login.php" method="post">
	<p>Логин <input type="text" name="login"></p>
	<p>Пароль <input type="password" name="password"></p>
	<p><input type="submit" value="Войти"></p>
</form>
<?
}
?>