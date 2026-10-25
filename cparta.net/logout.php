<?php

// Выход из системы
// Sign Out
session_start();
unset ($_SESSION['id']);
setcookie('auth_hash', '', -1);
setcookie('authhash', '', -1);
header ('Location: ./');
exit;

?>