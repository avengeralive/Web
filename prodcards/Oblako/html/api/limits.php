<?php
require '../functions.php';
$mysqli = get_db();

$result = $mysqli->query('SELECT * FROM ltypes WHERE active = 1');

// первые 16 бит - число строк
// v = unsigned short
echo pack('v', $result->num_rows);

while($row = $result->fetch_assoc()){
    // a = NUL-padded string
    echo pack('Va255a16a16', $row['id'], $row['name'], $row['measure'], $row['quantity']);
}
