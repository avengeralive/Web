<?php
if($_SESSION["user_type"]==1 || $_SESSION["user_type"]==2)
{
echo "<h2>Список адресатов</h2>";

echo '<form action="'.$path.'" method="post" enctype="multipart/form-data" class="formtable profile" name="ae_form"><table>'."\n";

echo '<tr><td class="name">';
echo 'Название</td><td class="value">';
echo '<input name="name" id="x" type="text" value="'.stripslashes($name).'" />';
echo '</td></tr>';

echo '<tr><td class="name">';
echo 'Список адресов</td><td class="value">';
echo '<textarea name="list" id="txt">'.$list.'</textarea>';
echo '</td></tr>';

$sql='select id_user,name from '.$pr.'user where id_user>1 and id_user<>'.addslashes($_SESSION["user_id"]);
$user=mysql_query($sql);
$user_count=mysql_num_rows($user); 

if($user_count>0)
{
    echo '<tr><td class="name">';
    echo 'Разрешно использовать</td><td class="value">';
    for($i=0;$i<$user_count;$i++)
	{
	    $sql='select id_user from '.$pr.'user_list where id_list='.addslashes($mode[0]).' and id_user='.mysql_result($user,$i,0);
        $temp=mysql_query($sql);
        $temp=mysql_result($temp,0,0);
        
        if($temp==mysql_result($user,$i,0)) $check=" checked";
        else unset($check);
        
	    if($i>0) echo '<br />';
        echo '<input type="checkbox" name="access['.$i.']" value="'.mysql_result($user,$i,0).'" '.$check.'>'.mysql_result($user,$i,1).' '."\n";
	}
    echo '</td></tr>';
}

echo '</table><p><input type="submit" name="submit" value="Подтвердить" class="submit" /></p>';

echo '</form>'; 
}



?>