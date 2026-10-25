<?
if ($_POST['username'] == 'admin' && $_POST['password'] == 'q1aw2se3d') {
	$teams = scandir('./games/'.$_POST['game'].'/teams');
	$questions = count(scandir('./games/'.$_POST['game'].'/questions')) - 2;
?>
<link href="https://fonts.googleapis.com/css?family=M+PLUS+Rounded+1c:400,700,900" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="./style.css">
<?
}
?>
<form>
<table>
<? foreach ($teams as $team) { if ($team != '.' && $team != '..') {
?>
	<tr>
		<td><input type="text" value="<? echo $team; ?>" disabled></td>
		<? for ($i = 1; $i <= $questions; $i++ ) {  ?>
		<td><input type="text" name="team[<? echo $team; ?>][<? echo $i; ?>]" placeholder="<? echo $i; ?>" style="width: 50px; padding: 0; text-align: center;"></td>
		<? } ?>
	</tr>
<?
} } ?>

</table>
<button type="submit">СОХРАНИТЬ</button>
</form>