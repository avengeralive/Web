<?
$msg = 'Имя: '.$_POST['name']."\n".'Телефон: ' .$_POST['phone'] ."\n".'Адрес: ' .$_POST['address']."\n".'Email: ' .$_POST['email'];
mail('m-koneva@mail.ru', $_POST['tp'], $msg);
echo true;
?>
