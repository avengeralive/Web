<?php
if($_SESSION["user_type"]==1)
{
echo "<h2>Данные рубрики</h2>";

echo '<form action="'.$path.'" method="post" enctype="multipart/form-data" name="ae_form">'."\n";

echo '<div class="it">';
echo '<label for="x">Название рубрики</label><br />';
echo '<input class="w450" name="name" id="name" type="text" value="'.htmlspecialchars(stripslashes($name)).'" />';
echo '</div>';

echo '<div class="it">';
echo '<label for="x">Строковый идентификатор рубрики</label><br />';
echo '<input class="w450" name="sid" id="sid" type="text" value="'.htmlspecialchars(stripslashes($sid)).'"   onclick="translateStr()" />';
echo '</div>';

echo '<div class="it">';
echo '<label for="x">Текст</label><br />';
echo '<textarea id="x" name="txt" cols="72" rows="11">'.htmlspecialchars(stripslashes($txt)).'</textarea>';
echo '</div>';

echo '<div class="it">';
echo '<label for="x">Количество дочерних объектов на странице</label><br />';
echo '<input class="w450" name="list" id="x" type="text" value="'.$list.'" />';
echo '</div>';

echo '<div class="it">';
echo '<label for="x">Meta title</label><br />';
echo '<input class="w450" name="title" id="x" type="text" value="'.htmlspecialchars(stripslashes($title)).'" />';
echo '</div>';

echo '<div class="it">';
echo '<label for="x">Meta description</label><br />';
echo '<textarea id="x" name="description" cols="72" rows="3">'.htmlspecialchars(stripslashes($description)).'</textarea>';
echo '</div>';

echo '<div class="it">';
echo '<label for="x">Meta keywords</label><br />';
echo '<textarea id="x" name="keywords" cols="72" rows="3">'.htmlspecialchars(stripslashes($keywords)).'</textarea>';
echo '</div>';

echo '<input type="submit" name="submit" value="Подтвердить" class="submit" />';

echo '</form>'; 
}
?>