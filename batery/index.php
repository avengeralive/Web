<!DOCTYPE html>
<?
	$data = json_decode(file_get_contents('adapter.json'), true);
?>
<html>
	<head>
		<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
		<style>
			.row { width: 100%; }
			div { display: block; float: left; box-sizing: border-box; }
		</style>
		<script type="text/javascript">
			$(function(){
				$('.regra').on('click', function(){
					$('.bateryach').css('background', '#fff');
					//for (i = 0; i < <? echo $data['questions']; ?>; i++) {
						i = <? echo $data['questions']; ?> - 1;
						p=0;
						setInterval(function(){
							
							for (j = 0; j< <? echo $data['teams']; ?>; j++) {
								$($($('.bateryblock')[<? echo $data['teams']; ?> + j]).children('.bateryblock_in').children('.baterybitem')[i]).children('.bateryach').css('background', $($('.bateryblock')[j]).children('.bateryach2').css('background'));
							}
							i--;
							if (i<-1 && i>= -21) {
								if (p%2==0) {
									for (j = 0; j< <? echo $data['teams']; ?>; j++) {
										$($('.bateryblock')[<? echo $data['teams']; ?> + j]).children('.bateryblock_in').children('.baterybitem').children('.bateryach').css('background', '#fff');
									}
								}
								else {
									for (j = 0; j< <? echo $data['teams']; ?>; j++) {
										$($('.bateryblock')[<? echo $data['teams']; ?> + j]).children('.bateryblock_in').children('.baterybitem').children('.bateryach').css('background', $($('.bateryblock')[j]).children('.bateryach2').css('background'));
									}
								}
								p++;
							}
						}, 500);
					//}
				});
			});
		</script>
	</head>
	<body style="background: #efefef;">
		<div class="bigbattery" style="width: 90%; background: #bef67a; padding: 10px; border: 1px solid #ccc; box-shadow: 0px 0px 10px 2px #ffffa6;">
		<?
			for ($j = 0; $j < $data['teams']; $j++) {
		?>
		<div class="bateryblock" style="width: calc(100% / <? echo $data['teams']; ?>); padding: 10px;">
			<div class="bateryach2" style="width: 60%; height: 20px; border: 1px solid #000; margin: 0 auto; float: none; background: <? echo $data['colors'][$j]; ?>; box-shadow: 0px 0px 10px 2px #ffffa6;">		
			</div>
		</div>
		<?
			}
		?>
		<?
			for ($j = 0; $j < $data['teams']; $j++) {
		?>
			<div class="bateryblock" style="width: calc(100% / <? echo $data['teams']; ?>); padding: 10px;">
				<div class="bateryblock_in" style="width: 100%; box-shadow: 0px 0px 10px 2px #ffffa6;">
				<?
					for ($i = 0; $i < $data['questions']; $i++) {
				?>
					<div class="baterybitem" style="width: 100%; padding: 10px;">
						<div class="bateryach" style="width: 100%; height: 50px; border-radius: 10px; border: 1px solid #000; <? if ($data['questions'] - $data['results'][$j] <= $i) { ?>background: <? echo $data['colors'][$j]; ?>;<? } else { ?>background: #fff;<? } ?>">
							
						</div>
					</div>
				<?
					}
				?>
				</div>
			</div>
		<?
			}
		?>
	</div>
			<div class="batteryheader" style="width: 10%; padding: 5px; min-height: <? echo ($data['questions']) * 70 + 40 ?>px;">
				<div class="heding=" style="width: 50%; margin-left: 5%; box-shadow: 0px 0px 10px 2px #ffffa6; border: 1px solid #fff; background: #bef67a; height: <? echo ($data['questions'] - 4) * 70 ?>px; margin-top: 180px;">
					
				</div>
			</div>
			<button class="regra">Зарядить</button>
	</body>
</html>