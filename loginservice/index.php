<?
session_start();
if (!isset($_SESSION['user'])) {
?>
Привет, гость <a href="login.php">Вход</a> / <a href="register.php">Регистрация</a>
<?
}
else {
?>
	Привет, <? echo $_SESSION['user']['login']; ?> <a href="logout.php">Выход</a>
<?
}
?>
<ul>
	<li><a href="page1.php">Страница для всех</a></li>
	<li><a href="page2.php">Страница для админа</a></li>
	<li><a href="page3.php">Страница для пользователей</a></li>
</ul>