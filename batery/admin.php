<?
if (isset($_POST['submit'])) {
	$data = json_decode(file_get_contents('adapter.json'), true);
	$data['teams'] = $_POST['teams'];
	$data['questions'] = $_POST['questions'];
	$data['results'] = $_POST['results'];
	$data['colors'] = $_POST['colors'];
	$json = json_encode($data);
	file_put_contents('adapter.json', $json);
}
$data = json_decode(file_get_contents('adapter.json'), true);
?>
<!DOCTYPE html>
<html>
	<head>
		<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
		<link rel="stylesheet" media="screen" type="text/css" href="./colorpicker/css/colorpicker.css" />
		<script type="text/javascript" src="./colorpicker/js/colorpicker.js"></script>
		<script type="text/javascript">
			$(function(){
				$('.cpk').ColorPicker();
			});
		</script>
		<style>
			.row { width: 100%; }
			div { display: block; float: left; box-sizing: border-box; }
		</style>
	</head>
	<body>
		
		<form action="./admin.php" method="post">
			<p>
				Количество команд
				<input type="text" name="teams" value="<? echo $data['teams']; ?>">
			</p>
			<p>
				Количество вопросов
				<input type="text" name="questions" value="<? echo $data['questions']; ?>">
			</p>
			<p><input type="submit" name="submit" value="Сохранить"></p>
			<p><? for ($i = 0; $i <= $data['questions']; $i++) {  ?><span class="ran" style="font-weight: bold;  margin-right: <? echo (400 - ($data['questions']*11) - ($data['questions'] - 1) * 7)/$data['questions']; ?>px; margin-left: 7px;"><? echo $i; ?></span><? } ?></p>
		<?
			for ($j = 0; $j < $data['teams']; $j++) {
		?>
			<p><input type="range" name="results[]" min="0" max="<? echo $data['questions']; ?>" value="<? echo $data['results'][$j]; ?>" list="tickmarks<? echo $j; ?>" style="width: 400px;" />
				<datalist id="tickmarks<? echo $j; ?>">
					<? for ($i = 0; $i <= $data['questions']; $i++) {  ?>
						<option value="<? echo $i; ?>" label="<? echo $i; ?>">
					<? } ?>
				</datalist>
			<input type="text" class="cpk" name="colors[]" value="<? echo $data['colors'][$j]; ?>"></p>
		<?
			}
		?>
		<p><input type="submit" name="submit" value="Сохранить"></p>
		</form>
	</body>
</html>