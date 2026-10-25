<?php
include 'db.php';

if (isset($_GET['id'])) {
	$sql = 'SELECT * FROM games WHERE id = :id';
	$stmt = $pdo->prepare($sql);
	$stmt->execute(array(":id" => strtolower($_GET['id'])));
	$rows = $stmt->fetchAll();
	$pos = json_decode($rows[0]['results'], true);
	$win = $rows[0]["win"];
	if (isset($_GET["next"])) {
		$pos[0] = $pos[0] + rand(10,100);
		$pos[1] = $pos[1] + rand(10,100);
		$pos[2] = $pos[2] + rand(10,100);
		$pos[3] = $pos[3] + rand(10,100);
		$pos[4] = $pos[4] + rand(10,100);
		if ($pos[0] > 635) $win = 1;
		if ($pos[1] > 635 && $pos[1] >= $pos[0]) $win = 2;
		if ($pos[2] > 635 && $pos[2] >= $pos[1] && $pos[2] >= $pos[0]) $win = 3;
		if ($pos[3] > 635 && $pos[3] >= $pos[2] && $pos[3] >= $pos[1] && $pos[3] >= $pos[0]) $win = 4;
		if ($pos[4] > 635 && $pos[4] >= $pos[3] && $pos[4] >= $pos[2] && $pos[4] >= $pos[1] && $pos[4] >= $pos[0] ) $win = 5;
		$sql = 'UPDATE games SET results = :results, win = :win WHERE id = :id';
		$stmt = $pdo->prepare($sql);
		$stmt->execute(array(":id"=> $_GET["id"], ":win"=>$win, ":results" => json_encode($pos)));
	}
}
else {
	$pos = array();
	$pos[0] = 0;
	$pos[1] = 0;
	$pos[2] = 0;
	$pos[3] = 0;
	$pos[4] = 0;
	$sql = 'INSERT INTO games(results) VALUES (:results)';
	$stmt = $pdo->prepare($sql);
	$stmt->execute(array(":results" => json_encode($pos)));
	header('Location: index.php?id='.$pdo->lastInsertId());
}
?>
<!DOCTYPE html>
<html>
	<head>
	</head>
	<body>
		<div style="width: 600px; display: block; height: 500px; margin: 0 auto; border-left: 5px solid #000; border-right: 5px solid #f00; position: relative;">
			<div style="position: absolute; top: 50px; left: <? echo $pos[0] - 35; ?>px; width: 30px; height: 30px; display: block; background: #4285f4;"></div>
			<div style="position: absolute; top: 150px; left: <? echo $pos[1] - 35; ?>px; width: 30px; height: 30px; display: block; background: #34a853;"></div>
			<div style="position: absolute; top: 250px; left: <? echo $pos[2] - 35; ?>px; width: 30px; height: 30px; display: block; background: #fbbc05;"></div>
			<div style="position: absolute; top: 350px; left: <? echo $pos[3] - 35; ?>px; width: 30px; height: 30px; display: block; background: #ea4335;"></div>
			<div style="position: absolute; top: 450px; left: <? echo $pos[4] - 35; ?>px; width: 30px; height: 30px; display: block; background: #f65314;"></div>
		</div>
		<? if ($win == 0) { ?><a href="./index.php?id=<? echo $_GET["id"]; ?>&next=1">Вперед</a><? } else { ?><a href="./index.php">Начать заново</a>
<p>Победил игрок номер <? echo $win; ?></p>
		<? } ?>

		<?
			$sql = 'SELECT COUNT(*) as cnt FROM games';
			$stmt = $pdo->prepare($sql);
			$stmt->execute();
			$rows = $stmt->fetchAll();
			$cnt = $rows[0]["cnt"];

			$sql = 'SELECT COUNT(*) as cnt FROM games WHERE win = 1';
			$stmt = $pdo->prepare($sql);
			$stmt->execute();
			$rows = $stmt->fetchAll();
			$w1 = $rows[0]["cnt"];

			$sql = 'SELECT COUNT(*) as cnt FROM games WHERE win = 2';
			$stmt = $pdo->prepare($sql);
			$stmt->execute();
			$rows = $stmt->fetchAll();
			$w2 = $rows[0]["cnt"];

			$sql = 'SELECT COUNT(*) as cnt FROM games WHERE win = 3';
			$stmt = $pdo->prepare($sql);
			$stmt->execute();
			$rows = $stmt->fetchAll();
			$w3 = $rows[0]["cnt"];

			$sql = 'SELECT COUNT(*) as cnt FROM games WHERE win = 4';
			$stmt = $pdo->prepare($sql);
			$stmt->execute();
			$rows = $stmt->fetchAll();
			$w4 = $rows[0]["cnt"];

			$sql = 'SELECT COUNT(*) as cnt FROM games WHERE win = 5';
			$stmt = $pdo->prepare($sql);
			$stmt->execute();
			$rows = $stmt->fetchAll();
			$w5 = $rows[0]["cnt"];

		?>
		<ul>
			<li>Всего игр: <? echo $cnt; ?></li>
			<li>Побед 1: <? echo $w1; ?> (<? echo $w1*100/$cnt; ?>%)</li>
			<li>Побед 2: <? echo $w2; ?> (<? echo $w2*100/$cnt; ?>%)</li>
			<li>Побед 3: <? echo $w3; ?> (<? echo $w3*100/$cnt; ?>%)</li>
			<li>Побед 4: <? echo $w4; ?> (<? echo $w4*100/$cnt; ?>%)</li>
			<li>Побед 5: <? echo $w5; ?> (<? echo $w5*100/$cnt; ?>%)</li>
		</ul>
	</body>
</html>