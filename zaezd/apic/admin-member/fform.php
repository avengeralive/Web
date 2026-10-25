<?php
echo "<H2>".$title."</H2>";

echo '<form action="/admin-member/'.$folder.'index.php?mode=firm&smode='.$smode.'_f&id_f='.$id_f.'" method="post" enctype="multipart/form-data" name="form1"><table>'."\n";

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
echo "Логотип";
echo '</td>'."\n";
echo '<td>'."\n";
echo '<input name="logo" type="text" id="logo" width="100" value="'.$logo.'">'."\n";
echo '</td>'."\n";
echo '</tr>'."\n";

echo '<tr>'."\n";
echo '<td>'."\n";
echo "Оборудование";
echo '</td>'."\n";
echo '<td>'."\n";
echo '<textarea name="equip" id="equip" cols="40" rows="5">'.$equip.'</textarea>'."\n";
echo '</td>'."\n";
echo '</tr>'."\n";

echo '<tr>'."\n";
echo '<td>'."\n";
echo "Услуги";
echo '</td>'."\n";
echo '<td>'."\n";
echo '<textarea name="serv" id="serv" cols="40" rows="5">'.$serv.'</textarea>'."\n";
echo '</td>'."\n";
echo '</tr>'."\n";

echo '<tr>'."\n";
echo '<td>'."\n";
echo "Дополнительная информация";
echo '</td>'."\n";
echo '<td>'."\n";
echo '<textarea name="info" id="info" cols="40" rows="5">'.$info.'</textarea>'."\n";
echo '</td>'."\n";
echo '</tr>'."\n";

echo '<tr>'."\n";
echo '<td>'."\n";
echo "Диллеры";
echo '</td>'."\n";
echo '<td>'."\n";
echo '<textarea name="dill" id="dill" cols="40" rows="5">'.$dill.'</textarea>'."\n";
echo '</td>'."\n";
echo '</tr>'."\n";

echo '<tr>'."\n";
echo '<td width="15%">'."\n";
echo "Адрес";
echo '</td>'."\n";
echo '<td>'."\n";
echo '<input name="adr" type="text" id="adr" width="100" value="'.$adr.'">'."\n";
echo '</td>'."\n";
echo '</tr>'."\n";

echo '<tr>'."\n";
echo '<td width="15%">'."\n";
echo "Телефон 1";
echo '</td>'."\n";
echo '<td>'."\n";
echo '<input name="phone1" type="text" id="phone1" width="100" value="'.$phone1.'">'."\n";
echo '</td>'."\n";
echo '</tr>'."\n";

echo '<tr>'."\n";
echo '<td width="15%">'."\n";
echo "Код 1";
echo '</td>'."\n";
echo '<td>'."\n";
echo '<input name="code1" type="text" id="code1" width="100" value="'.$code1.'">'."\n";
echo '</td>'."\n";
echo '</tr>'."\n";

echo '<tr>'."\n";
echo '<td width="15%">'."\n";
echo "Телефон 2";
echo '</td>'."\n";
echo '<td>'."\n";
echo '<input name="phone2" type="text" id="phone2" width="100" value="'.$phone2.'">'."\n";
echo '</td>'."\n";
echo '</tr>'."\n";

echo '<tr>'."\n";
echo '<td width="15%">'."\n";
echo "Код 2";
echo '</td>'."\n";
echo '<td>'."\n";
echo '<input name="code2" type="text" id="code2" width="100" value="'.$code2.'">'."\n";
echo '</td>'."\n";
echo '</tr>'."\n";

echo '<tr>'."\n";
echo '<td width="15%">'."\n";
echo "Факс";
echo '</td>'."\n";
echo '<td>'."\n";
echo '<input name="phone3" type="text" id="phone3" width="100" value="'.$phone3.'">'."\n";
echo '</td>'."\n";
echo '</tr>'."\n";

echo '<tr>'."\n";
echo '<td width="15%">'."\n";
echo "Код факса";
echo '</td>'."\n";
echo '<td>'."\n";
echo '<input name="code3" type="text" id="code3" width="100" value="'.$code3.'">'."\n";
echo '</td>'."\n";
echo '</tr>'."\n";

echo '<tr>'."\n";
echo '<td width="15%">'."\n";
echo "E-mail";
echo '</td>'."\n";
echo '<td>'."\n";
echo '<input name="mail" type="text" id="mail" width="100" value="'.$mail.'">'."\n";
echo '</td>'."\n";
echo '</tr>'."\n";

echo '<tr>'."\n";
echo '<td width="15%">'."\n";
echo "Адрес сайта";
echo '</td>'."\n";
echo '<td>'."\n";
echo '<input name="site" type="text" id="site" width="100" value="'.$site.'">'."\n";
echo '</td>'."\n";
echo '</tr>'."\n";

echo '<tr>'."\n";
echo '<td width="15%">'."\n";
echo "Страна";
echo '</td>'."\n";
echo '<td>'."\n";
echo '<input name="country" type="text" id="site" width="100" value="'.$country.'">'."\n";
echo '</td>'."\n";
echo '</tr>'."\n";

echo '<tr>'."\n";
echo '<td width="15%">'."\n";
echo "Город";
echo '</td>'."\n";
echo '<td>'."\n";
echo '<input name="city" type="text" id="site" width="100" value="'.$city.'">'."\n";
echo '</td>'."\n";
echo '</tr>'."\n";

echo '<tr>'."\n";
echo '<td width="15%">'."\n";
echo "Тип участника";
echo '</td>'."\n";
echo '<td>'."\n";
echo '<input type="radio" name="cexp" value="0" '.$check[0].'>Член АПИК<br />'."\n";
echo '<input type="radio" name="cexp" value="1" '.$check[1].'>Не член АПИК<br />'."\n";
echo '</td>'."\n";
echo '</tr>'."\n";

echo '<tr>'."\n";
echo '<td>'."\n";
echo '<input type="submit" name="Submit" value="Принять">'."\n";
echo '</td>'."\n";
echo '</tr>'."\n";

echo '</table></form>'; 
?>
