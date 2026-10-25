<?
$msg = 'Имя: '.$_POST['name']."\n".'Телефон: ' .$_POST['phone'] ."\n".'Email: ' .$_POST['email']."\n".'Информация: ' .$_POST['info'];
mail('m-koneva@mail.ru', $_POST['tp'], $msg);
echo true;
?>
