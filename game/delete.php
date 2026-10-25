<?
for ($i = 1; $i<=15; $i++) {
$y = scandir('./games/01/questions/'.$i.'/answers');
foreach ($y as $x) {
	if ($x != '.' && $x != '..') {
		unlink('./games/01/questions/'.$i.'/answers/'.$x);
		unlink('./games/01/questions/'.$i.'/times/'.$x);
	}
}
}
?>