<?
error_reporting(E_ALL);
$json = json_decode(file_get_contents('data.json'), true);

$cur = strtotime(date("Y-m-d H:i:s"));
$past = strtotime($json["date"]);
if ($cur - $past > 360) {
	$p = rand(0, 1);
	if ($p <= 0.2) {
		$x = rand(0, 2);
		$json["investors"] += $x;
		if ($x != 0) {
			$json["sum"] += 1 / (rand(100, 100000));
		}
		$json["date"] = date("Y-m-d H:i:s");
		$json["gives"] += ((1 / rand(100, 100000)) / 4);
	}
		
}
if ($cur - $past > 10) {
	$p = rand(0, 1);
	if ($p <= 0.5) $json["user"] += rand(0, 3);
	if ($p > 0.5) $json["user"] -= max($json["user"] - 1 - rand(0, 3), 0);
}
file_put_contents('data.json', json_encode($json));	
echo json_encode($json);
?>