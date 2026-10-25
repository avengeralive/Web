<?
if (!is_dir('./games/'.$_GET['game'].'/teams/'.$_GET['team'])) {
	mkdir('./games/'.$_GET['game'].'/teams/'.$_GET['team'], 755);
	file_put_contents('./games/'.$_GET['game'].'/teams/'.$_GET['team'].'/.passwd', $_GET['password']);
	header('Location: ./answer.php?game='.$_GET['game'].'&question=1&team='.$_GET['team'].'&password='.$_GET['password']);
}
?>