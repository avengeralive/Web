<?
session_start();
ini_set('log_errors', 'On');
ini_set('error_log', 'php_errors.log');
if (isset($_POST['login']) && isset($_POST['password']))
{
	include('db.php');
	$sql = 'SELECT * FROM users WHERE LOWER(login) = :login';
	$stmt = $pdo->prepare($sql);
	$stmt->execute(array(":login" => strtolower($_POST['login'])));
	$rows = $stmt->fetchAll();

	if (!$rows) {
		if ($_POST['password'] == $_POST['confirm']) {
			$sql = 'INSERT INTO users(login, password, role) VALUES (:login, :password, :role)';
			$stmt = $pdo->prepare($sql);
			$stmt->execute(array(":login" => strtolower($_POST['login']), ":password" => md5($_POST["password"]), ":role" => $_POST['role']));

			$sql = 'SELECT * FROM users WHERE LOWER(login) = :login AND password = :password';
			$stmt = $pdo->prepare($sql);
			$stmt->execute(array(":login" => strtolower($_POST['login']), ":password" => md5($_POST["password"])));
			$rows2 = $stmt->fetchAll();

			$_SESSION["user"] = $rows2[0];
			header("location: index.php");
		}
		else {
			$error = "Повтор пароля не совпадает";
		}
	}
	else {
		$error = "Такой пользователь существует";
	}
}

if (!isset($_SESSION['user'])) {
?>
<form action="register.php" method="post">
	<p>Логин <input type="text" name="login"></p>
	<p>Пароль <input type="password" name="password"></p>
	<p>Подтвердите пароль <input type="password" name="confirm"></p>
	<p>Выберите роль
		<select name="role">
			<option value="admin">Админ</option>
			<option value="user">Пользователь</option>
		</select>
	</p>
	<p><input type="submit" value="Регистрация"></p>
	<p style="color: #f00;"><? echo $error; ?></p>
</form>
<?
}
?>