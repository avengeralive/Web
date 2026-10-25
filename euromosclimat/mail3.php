<?
$msg = 'Имя: '.$_POST['name']."\n".'Телефон: ' .$_POST['phone'] ."\n".'Удобное время: ' .$_POST['time'];
mail('m-koneva@mail.ru', $_POST['tp'], $msg);
echo true;
?>
