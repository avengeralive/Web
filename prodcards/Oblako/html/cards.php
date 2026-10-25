<?php
require "functions.php";
header('Content-Type: text/html;charset=utf-8');
?>
<form action="" method="post">
<?php

$mysqli = get_db();

if (mysqli_connect_errno()) {
    printf("Подключение к серверу MySQL невозможно. Код ошибки: %s\n", mysqli_connect_error());
    exit;
}

// Добавление номера карты в базу
if (!empty($_POST['number'])) {
    $number = $_POST['number'];
    $active = 1;
    if (is_valid_card_number($number)) {
        $stmt = $mysqli->prepare('INSERT INTO cards VALUES(?, ?)');
        $stmt->bind_param('ss', $number, $active);
        if ($stmt->execute()) {
            echo 'Номер карты добавлен';
        } else {
            echo 'Ошибка при добавлении карты в базу!';
        }
    } else {
        echo 'Номер карты некорректен!';
    }
}

// активация/деактивация карты
if (!empty($_POST['activate']) || !empty($_POST['deactivate'])) {
	if (!empty($_POST['activate'])) {
	    $number = $_POST['activate'];
	    $active = 1;
	} else {
	    $number = $_POST['deactivate'];
	    $active = 0;
	}
    $stmt = $mysqli->prepare('UPDATE cards SET active = ? WHERE number = ?');
    $stmt->bind_param('ss', $active, $number);
    if ($stmt->execute()) {
        echo 'Состояние карты добавлено';
    } else {
        echo 'Ошибка при обновлении состояния карты';
    }
}

// Вывод карточек
if ($result = $mysqli->query('SELECT number, active FROM cards')) {

    print("<table border>");
    print("<tr><th>Номер</th><th>Активна</th></tr>");

    /* Выбираем результаты запроса: */
    while( $row = $result->fetch_assoc() ){
    	print('<tr>');
        printf('<tr><td>%s</td><td>%s</td>', $row['number'], $row['active'] ? 'да' : 'нет');
        if ($row['active']) {
        	printf('<td><button type="submit" name="deactivate" value="%s">Деактивировать</button></td>', $row['number']);
        } else {
        	printf('<td><button type="submit" name="activate" value="%s">Активировать</button></td>', $row['number']);
        }
    	print('</tr>');
    }

    /* Освобождаем память */
    $result->close();
    print("</table>");
}

/* Закрываем соединение */
$mysqli->close();
?>
	<fieldset>
		<legend>Добавить карту</legend>
		<input type="text" name="number" minlength="16" maxlength="16" size="16" />
		<input type="submit" value="Добавить" />
	</fieldset>
</form>