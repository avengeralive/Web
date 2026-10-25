<?php
echo "<H2>".$title."</H2>";

echo '<form action="/admin-member/'.$folder.'index.php?mode=firm&smode='.$smode.'_f" method="post" enctype="multipart/form-data" name="form1">'."\n";

echo '<tr>'."\n";
echo '<td width="15%">'."\n";
echo "Название";
echo '</td>'."\n";
echo '<td>'."\n";
echo '<input name="name" type="text" id="name" width="100" value="'.$name.'">'."\n";
echo '</td>'."\n";
echo '</tr>'."\n";

echo '<tr>'."\n";
echo '<td width="15%">'."\n";
echo "Адрес";
echo '</td>'."\n";
echo '<td>'."\n";
echo '<input name="addr" type="text" id="addr" width="100" value="'.$addr.'">'."\n";
echo '</td>'."\n";
echo '</tr>'."\n";

echo '<tr>'."\n";
echo '<td>'."\n";
echo "Краткое описание";
echo '</td>'."\n";
echo '<td>'."\n";
echo '<textarea name="short" id="short" cols="40" rows="5">'.$short.'</textarea>'."\n";
echo '</td>'."\n";
echo '</tr>'."\n";

echo '<tr>'."\n";
echo '<td>'."\n";
echo "Особенности";
echo '</td>'."\n";
echo '<td>'."\n";
echo '<textarea name="special" id="special" cols="40" rows="5">'.$special.'</textarea>'."\n";
echo '</td>'."\n";
echo '</tr>'."\n";

echo '<tr>'."\n";
echo '<td>'."\n";
echo "Основные харакетристики проекта";
echo '</td>'."\n";
echo '<td>'."\n";
echo '<textarea name="basic" id="basic" cols="40" rows="5">'.$basic.'</textarea>'."\n";
echo '</td>'."\n";
echo '</tr>'."\n";

echo '<tr>'."\n";
echo '<td width="15%">'."\n";
echo "Схема";
echo '</td>'."\n";
echo '<td>'."\n";
echo '<input name="schema" type="text" id="schema" width="100" value="'.$schema.'">'."\n";
echo '</td>'."\n";
echo '</tr>'."\n";

echo '<tr>'."\n";
echo '<td>'."\n";
echo "Экспертное заключение";
echo '</td>'."\n";
echo '<td>'."\n";
echo '<textarea name="expert" id="expert" cols="40" rows="5">'.$expert.'</textarea>'."\n";
echo '</td>'."\n";
echo '</tr>'."\n";

echo '<tr>'."\n";
echo '<td width="15%">'."\n";
echo "Фото 1";
echo '</td>'."\n";
echo '<td>'."\n";
echo '<input name="img1" type="text" id="img1" width="100" value="'.$img1.'">'."\n";
echo '</td>'."\n";
echo '</tr>'."\n";

echo '<tr>'."\n";
echo '<td width="15%">'."\n";
echo "Фото 2";
echo '</td>'."\n";
echo '<td>'."\n";
echo '<input name="img2" type="text" id="img2" width="100" value="'.$img2.'">'."\n";
echo '</td>'."\n";
echo '</tr>'."\n";

echo '<tr>'."\n";
echo '<td width="15%">'."\n";
echo "Фото 3";
echo '</td>'."\n";
echo '<td>'."\n";
echo '<input name="img3" type="text" id="img3" width="100" value="'.$img3.'">'."\n";
echo '</td>'."\n";
echo '</tr>'."\n";

echo '<tr>'."\n";
echo '<td width="15%">'."\n";
echo "Фото 4";
echo '</td>'."\n";
echo '<td>'."\n";
echo '<input name="img4" type="text" id="img4" width="100" value="'.$img4.'">'."\n";
echo '</td>'."\n";
echo '</tr>'."\n";

echo '<tr>'."\n";
echo '<td width="15%">'."\n";
echo "Фото 5";
echo '</td>'."\n";
echo '<td>'."\n";
echo '<input name="img5" type="text" id="img5" width="100" value="'.$img5.'">'."\n";
echo '</td>'."\n";
echo '</tr>'."\n";

echo '<tr>'."\n";
echo '<td>'."\n";
echo "Дополнительная информация";
echo '</td>'."\n";
echo '<td>'."\n";
echo '<textarea name="additional" id="additional" cols="40" rows="5">'.$additional.'</textarea>'."\n";
echo '</td>'."\n";
echo '</tr>'."\n";

echo '<tr>'."\n";
echo '<td>'."\n";
echo '<input type="submit" name="Submit" value="Принять">'."\n";
echo '</td>'."\n";
echo '</tr>'."\n";

echo '</form>'; 
?>
