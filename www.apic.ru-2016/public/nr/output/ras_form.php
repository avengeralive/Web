<?php
if($_SESSION["user_type"]==1 || $_SESSION["user_type"]==2)
{
echo "<h2>Данные рассылки</h2>";

echo '<form action="'.$path.'" method="post" enctype="multipart/form-data" class="formtable profile" name="ae_form"><table>'."\n";

$sql='select id_list,name from '.$pr.'list where id_user='.addslashes($_SESSION["user_id"]).' or id_list in (select id_list from '.$pr.'user_list where id_user='.addslashes($_SESSION["user_id"]).') order by name';
$lists=mysql_query($sql);
$lists_count=mysql_num_rows($lists);

echo '<tr><td class="name">';
echo 'Список адресатов</td><td class="value">';
echo '<select id="s1" name="list">';
for($i=0;$i<$lists_count;$i++)
{
    $id_list=mysql_result($lists,$i,0);
    $name=mysql_result($lists,$i,1);
    
    if(empty($list)) $list=$id_list;
    if($list==$id_list) $sel=" selected";
    else unset($sel);
    
    echo '<option value="'.$id_list.'"'.$sel.'>'.$name.'</option>';
}
echo '</select></td></tr>';

echo '<tr><td class="name">';
echo 'Тема</td><td class="value">';
echo '<input name="subj" id="x" type="text" value="'.stripslashes($subj).'" />';
echo '</td></tr>';

echo '<tr><td class="name">';
echo 'Текст</td><td class="value">';
echo '<textarea name="text" id="txt">'.htmlspecialchars($text).'</textarea>';
echo '</td></tr>';

if($_SESSION["user_type"]==2) echo '<script language="Javascript" type="text/javascript"> CKEDITOR.replace( \'txt\' ); </script>'; 
 
$sql='select * from '.$pr.'image where id_r='.addslashes($mode[0]);
$img=mysql_query($sql);
$img_count=mysql_num_rows($img); 

if($img_count>0)
{
    echo '<tr><td class="name">';
    echo 'Прикреплены файлы</td><td class="value">';
    for($i=0;$i<$img_count;$i++)
	{
	    if($i>0) echo '<br />';
	    echo '<a target="_blank" href="/nr/upload/'.mysql_result($img,$i,3).'">'.mysql_result($img,$i,3).'</a>';
	}
    echo '</td></tr>';
}

echo '</table><p><input type="submit" name="submit" value="Подтвердить" class="submit" /></p>';

echo '</form>'; 
}



?>