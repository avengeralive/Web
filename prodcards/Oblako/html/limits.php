<?php
require "functions.php";
header('Content-Type: text/html;charset=utf-8');
$mysqli = get_db();

if (mysqli_connect_errno()) {
    printf("Подключение к серверу MySQL невозможно. Код ошибки: %s\n", mysqli_connect_error());
    exit;
}

?>
<h3>Лимиты</h3>
<?php


// Добавление номера карты в базу
if (!empty($_POST['row'])) {
    $row = $_POST['row'];
    $stmt = $mysqli->prepare('INSERT INTO limits (card_number, limit_id, quantity, active) VALUES(?, ?, ?, ?)');
    $stmt->bind_param('sidi', $row['card_number'], $row['limit_id'], $row['quantity'], $row['active']);
    if ($stmt->execute()) {
        echo 'Запись добавлена';
    } else {
        echo 'Ошибка при добавлении записи в базу!';
    }
}

// Вывод карточек
if ($result = $mysqli->query('SELECT * FROM limits')) { ?>
    <table border>
        <tr>
            <th>Номер карты</th>
            <th>ID типа лимита</th>
            <th>Кол-во</th>
            <th>Активность</th>
        </tr>
    <?php 
    /* Выбираем результаты запроса: */
    while( $row = $result->fetch_assoc() ){ ?>
    	<tr>
            <td><?= $row['card_number'] ?></td>
            <td><?= $row['limit_id'] ?></td>
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
            <input type="text" name="row[card_number]" value="5084500002859228" /> Название
        </div>
        <div>
            <input type="text" name="row[limit_id]" value="1" /> ID типа лимита
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