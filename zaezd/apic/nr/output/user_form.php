<?php
if($_SESSION["user_type"]==1)
{
echo "<h2>Профиль пользователя</h2>";

echo '<form action="'.$path.'" method="post" enctype="multipart/form-data" class="formtable profile" name="ae_form"><table>'."\n";

echo '<tr><td class="name">';
echo 'Логин</td><td class="value">';
echo '<input name="loginf" id="x" type="text" value="'.stripslashes($loginf).'" />';
echo '</td></tr>';

echo '<tr><td class="name">';
echo 'Пароль</td><td class="value">';
echo '<input name="pass1" id="x" type="password" value="" />';
echo '</td></tr>';

echo '<tr><td class="name">';
echo 'Подтверждение пароля</td><td class="value">';
echo '<input name="pass2" id="x" type="password" value="" />';
echo '</td></tr>';

echo '<tr><td class="name">';
echo 'Имя пользователя</td><td class="value">';
echo '<input name="name" id="x" type="text" value="'.stripslashes($name).'" />';
echo '</td></tr>';

echo '<tr><td class="name">Права пользователя</td><td class="value">';
for($i=1;$i<count($utype)+1;$i++)
    echo '<input type="radio" name="access" value="'.$i.'" '.$check[$i].'>'.$utype[$i].' '."\n";
echo '</td></tr>';

echo '</table><p><input type="submit" name="submit" value="Подтвердить" class="submit" /></p>';

echo '</form>'; 
}



?>