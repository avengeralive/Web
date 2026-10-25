<?php
if($_SESSION["user_type"]==1)
{
echo "<h2>Данные поля</h2>";

echo '<form action="'.$path.'" method="post" enctype="multipart/form-data" name="ae_form">'."\n";

echo '<div class="it">';
echo '<label for="x">Название поля</label><br />';
echo '<input class="w450" name="nm" id="x" type="text" value="'.stripslashes($nm).'" />';
echo '</div>';

echo '<div class="it">';
echo '<label for="x">Тип поля</label><br />';
echo '<select name="type" class="w">
    <option '.$select[0].' value="0">Заголовок</option>
	<option '.$select[1].' value="1">Число</option>
	<option '.$select[2].' value="2">Строка</option>
	<option '.$select[3].' value="3">Текст</option>
	<option '.$select[4].' value="4">Дата</option>
</select>
';
echo '</div>';

echo '<div class="it">';
if(!empty($empty)) echo '<input class="ck" name="empty" id="x" type="checkbox" value="1" checked /><label for="x">Не обязательное поле</label>';
else echo '<input class="ck" name="empty" id="x" type="checkbox" value="1" /><label for="x">Не обязательное поле</label>';
echo '</div>';

echo '<input type="submit" name="submit" value="Подтвердить" class="submit" />';

echo '</form>'; 
}
?>