<?
$x = scandir('./games/'.$_GET['game'].'/questions/'.$_GET['q'].'/answers');
$json = array();
foreach ($x as $key => $value) { if ($value != '.' && $value != '..') {
	$data["team"] = $value;
	$data["answer"] = file_get_contents('./games/'.$_GET['game'].'/questions/'.$_GET['q'].'/answers/'.$value);
	$data["time"] = file_get_contents('./games/'.$_GET['game'].'/questions/'.$_GET['q'].'/times/'.$value);

	$json[] = $data;
}
}
echo json_encode($json);
?>