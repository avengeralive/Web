<?php
if($_SESSION["user_type"]==1)
{
echo "<h2>Профиль пользователя</h2>";

echo '<form action="'.$path.'" method="post" enctype="multipart/form-data" name="ae_form">'."\n";

echo '<div class="it">';
echo '<label for="x">Логин</label><br />';
echo '<input class="w450" name="loginf" id="x" type="text" value="'.stripslashes($loginf).'" />';
echo '</div>';

echo '<div class="it">';
echo '<label for="x">Пароль</label><br />';
echo '<input class="w450" name="pass1" id="x" type="password" value="" />';
echo '</div>';

echo '<div class="it">';
echo '<label for="x">Подтверждение пароля</label><br />';
echo '<input class="w450" name="pass2" id="x" type="password" value="" />';
echo '</div>';


echo '<div class="it">';
echo '<label for="x">Имя пользователя</label><br />';
echo '<input class="w450" name="name" id="x" type="text" value="'.stripslashes($name).'" />';
echo '</div>';

echo '<div class="it">';
echo '<label for="x">E-mail</label><br />';
echo '<input class="w450" name="mail" id="x" type="text" value="'.stripslashes($mail).'" />';
echo '</div>';


echo '<div class="it">';
for($i=1;$i<count($utype)+1;$i++)
    echo '<input type="radio" name="access" value="'.$i.'" '.$check[$i].'>'.$utype[$i].'<br />'."\n";
echo '</div>';

$sql='select id_part,name from '.$pr.'part where id_part order by id_part';
$temp=mysql_query($sql);
$temp_count=mysql_num_rows($temp);

if($action[1]=="profile")
{
	$sql='select id_part from '.$pr.'user_part where id_user='.$mode[0];
	$us=mysql_query($sql);
	$us_count=mysql_num_rows($us);
	
	for($i=0;$i<$us_count;$i++)
	 $ptc[mysql_result($us,$i,0)]="checked ";
}
	
echo '<div class="it">';

for($i=0;$i<$temp_count;$i++)
 echo '<input class="ck" name="pt['.$i.']" id="x" type="checkbox" value="'.mysql_result($temp,$i,0).'" '.$ptc[mysql_result($temp,$i,0)].'/><label for="x">'.mysql_result($temp,$i,1).'</label>';

echo '</div>';

echo '<input type="submit" name="submit" value="Подтвердить" class="submit" />';

echo '</form>'; 
}



?>