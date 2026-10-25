<?php
if($_SESSION["user_type"]==1)
{
echo "<h2>Данные типа объектов</h2>";

echo '<form action="'.$path.'" method="post" enctype="multipart/form-data" name="ae_form">'."\n";

echo '<div class="it">';
echo '<label for="x">Название элемента</label><br />';
echo '<input class="w450" name="name" id="name" type="text" value="'.stripslashes($name).'" />';
echo '</div>';

echo '<div class="it">';
echo '<label for="x">Строковый идентификатор элемента</label><br />';
echo '<input class="w450" name="sid" id="sid" type="text" value="'.stripslashes($sid).'"  onclick="translateStr()" />';
echo '</div>';

echo '<div class="it">';
if(!empty($type)) echo '<input class="ck" name="type" id="x" type="checkbox" value="1" checked /><label for="x">Комментарий</label>';
else echo '<input class="ck" name="type" id="x" type="checkbox" value="1" /><label for="x">Комментарий</label>';
echo '</div>';

echo '<input type="submit" name="submit" value="Подтвердить" class="submit" />';

echo '</form>'; 
}
?>