<?php
require "functions.php";
header('Content-Type: text/html;charset=utf-8');
$mysqli = get_db();

if (mysqli_connect_errno()) {
	printf("Подключение к серверу MySQL невозможно. Код ошибки: %s\n", mysqli_connect_error());
	exit;
}

?>
<h3>Типы лимитов</h3>
<?php


// Добавление номера карты в базу
if (!empty($_POST['row'])) {
	$row = $_POST['row'];
	$active = 1;
	$stmt = $mysqli->prepare('INSERT INTO ltypes (name, measure, quantity, active) VALUES(?, ?, ?, ?)');
	$stmt->bind_param('ssdi', $row['name'], $row['measure'], $row['quantity'], $row['active']);
	if ($stmt->execute()) {
		echo 'Запись добавлена';
	} else {
		echo 'Ошибка при добавлении записи в базу!';
	}
}

// Вывод карточек
if ($result = $mysqli->query('SELECT * FROM ltypes')) { ?>
	<table border>
		<tr>
			<th>ID</th>
			<th>Наименование</th>
			<th>Ед. изм</th>
			<th>Кол-во</th>
			<th>Активность</th>
		</tr>
	<?php 
	/* Выбираем результаты запроса: */
	while( $row = $result->fetch_assoc() ){ ?>
		<tr>
			<td><?= $row['id'] ?></td>
			<td><?= $row['name'] ?></td>
			<td><?= $row['measure'] ?></td>
			<td><?= $row['quantity'] ?></td>
			<td>
				<?php if ($row['active'] == 0) print 'Неактивна' ?>
				<?php if ($row['active'] == 1) print 'Активна' ?>
			</td>
		</tr>
	<?php
	}
	/* Освобождаем память */
	$result->close();
	?>
	</table>
	<?php } ?>
	<form action="" method="post">
	<fieldset>
		<legend>Добавить запись</legend>
		<div>
			<input type="text" name="row[name]" value="Название" /> Название
		</div>
		<div>
			<input type="text" name="row[measure]" value="Кг." /> Ед. изм
		</div>
		<div>
			<input type="text" name="row[quantity]" value="100" /> Количество
		</div>
		<div>
			<label><input type="radio" name="row[active]" value="0" /> Неактивна</label>
			<label><input type="radio" name="row[active]" value="1" checked /> Активна</label>
		</div>
		<input type="submit" value="Добавить" />
	</fieldset>
	</form>
<?php
/* Закрываем соединение */
$mysqli->close();
?>