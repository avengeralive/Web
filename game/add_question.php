<?
if ($_POST['username'] == 'admin' && $_POST['password'] == 'q1aw2se3d') {
?>
<link href="https://fonts.googleapis.com/css?family=M+PLUS+Rounded+1c:400,700,900" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="./style.css">
<a href="./add_question.php">Добавить вопрос</a>
<br>
<form action="./view.php" method="POST">
	<input type="hidden" name="game" value="<? echo $_POST['game']; ?>">
	<button type="submit">Просмотр игры</button>
</form>
<?
}
?>