<?
session_start();
if (!isset($_SESSION['user'])) {
?>
Привет, гость <a href="login.php">Вход</a> / <a href="register.php">Регистрация</a>
<ul>
	<li><a href="page1.php">Страница для всех</a></li>
	<li><a href="page2.php">Страница для админа</a></li>
	<li><a href="page3.php">Страница для пользователей</a></li>
</ul>
<?
}
?>
<? if ($_SESSION['user']['role'] == 'admin') { ?>
Эта страница сайта доступна только админу. Тут просто можно поменять текст.
<? } else { ?>
У вас нет права смотреть эту страницу.
<? } ?>