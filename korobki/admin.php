<? 
if (isset($_POST['submit1'])) {
	$data = json_decode(file_get_contents('game.json'), true);
	$data['players'] = $_POST['players'];
	$data['box'] = $_POST['box'];
	$json = json_encode($data);
	file_put_contents('game.json', $json);
}
if (isset($_POST['submit2'])) {
	$data = json_decode(file_get_contents('game.json'), true);
	$data['teams'] = $_POST['teams'];
	$data['game'] = $_POST['game'];
	$data['boxes'] = $_POST['boxes'];
	$data['choise'] = $_POST['choise'];
	$data['colors'] = $_POST['colors'];
	$json = json_encode($data);
	file_put_contents('game.json', $json);
}
$data = json_decode(file_get_contents('game.json'), true); 
?>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<link rel="stylesheet" media="screen" type="text/css" href="./colorpicker/css/colorpicker.css" />
<script type="text/javascript" src="./colorpicker/js/colorpicker.js"></script>
<script type="text/javascript">
	$(function(){
		$('.cpk').ColorPicker({
			onSubmit: function(hsb, hex, rgb, el) {
				$(el).val(hex);
				$(el).css('background', '#' + hex);
				$(el).ColorPickerHide();
			}
		});
	});
</script>
<form action="admin.php" method="post">
<p>Количество игроков <input type="text" name="players" value="<? echo $data['players']; ?>"></p>
<p>Количество коробок <input type="text" name="box" value="<? echo $data['box']; ?>"></p>
<input type="submit" name="submit1" value="Сохранить">
</form>
<form action="admin.php" method="post">
<table style="width: 100%;">
	<tr>
		<td>Название<br>команды</td>
		<td>Номер<br>активной<br>коробки</td>
		<? for ($j = 1; $j <= $data['box']; $j++) { ?>
		<td><? echo $j; ?></td>
		<? } ?>
	</tr>
	<? for ($i = 0; $i < $data['players']; $i++) { ?>
	<tr>
		<td>
			<h3><input type="text" name="teams[<? echo $i; ?>]" value="<? echo $data['teams'][$i]; ?>"></h3>
		</td>
		<td>
			<select name="choise[<? echo $i; ?>]">
				<option value="-1">-</option>
				<? for ($j = 1; $j <= $data['box']; $j++) { ?>
				<option value="<? echo $j - 1; ?>" <? if ($data['choise'][$i] == $j - 1) { ?>selected<? } ?>><? echo $j; ?></option>
				<? } ?>
			</select>
		</td>
		<? for ($j =0 ; $j < $data['box']; $j++) { ?>
		<td>
			<table>
				<tr>
					<td>Баллы</td> 
					<td><input class="game" type="text" name="game[<? echo $i; ?>][<? echo $j; ?>]" value="<? echo $data['game'][$i][$j]; ?>"></td>
				</tr>
				<tr>
					<td>Готово</td>
					<td><input type="checkbox" name="boxes[<? echo $i; ?>][<? echo $j; ?>]" <? if ($data['boxes'][$i][$j]) echo 'checked'; ?>></td>
				</tr>
			</table>
		</td>
		<? } ?>
	</tr>
	<? } ?>
	<tr>
		<td colspan="2"></td>
		<? for ($j =0 ; $j < $data['box']; $j++) { ?>
		<td>
			<input style="width: 50px; background: #<? echo $data['colors'][$j]; ?>" name="colors[<? echo $j; ?>]" type="text" class="cpk" value="<? echo $data['colors'][$j]; ?>"></td>
		<? } ?>
	</tr>
</table>
<input type="submit" name="submit2" value="Сохранить">
</form>
<style>
	table { vertical-align: middle; text-align: center; }
	h3, p { margin: 0px; }
	.game { width: 30px; }
</style>