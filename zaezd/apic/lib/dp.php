<?php
$inc_path=$_SERVER['DOCUMENT_ROOT']."/";
include($inc_path."lib/head.php");

$sql='select * from match_dp_request';
$tmp=mysql_query($sql);
$tmp_rows=mysql_num_rows($tmp);

echo '<h1>Список заявок на участие в Деловой программе</h1>';

echo '<table border=1>';

  echo '<tr>';
  echo '<th>Код Заявки</th>';
  echo '<th>Дни</th>';
  echo '<th>Город</th>';
  echo '<th>Название компании</th>';
  echo '<th>Ф.И.О.</th>';  
  echo '<th>Должность</th>';
  echo '<th>Электронная почта</th>';
  echo '<th>Телефон</th>';
  echo '</tr>';

for($i=0;$i<$tmp_rows;$i++)
{
  echo '<tr>';
  echo '<td>'.mysql_result($tmp,$i,0).'</td>';
  echo '<td>'.nl2br(mysql_result($tmp,$i,7)).'</td>';
  echo '<td>'.mysql_result($tmp,$i,1).'</td>';
  echo '<td>'.mysql_result($tmp,$i,2).'</td>';
  echo '<td>'.mysql_result($tmp,$i,3).'</td>';
  echo '<td>'.mysql_result($tmp,$i,4).'</td>';
  echo '<td>'.mysql_result($tmp,$i,5).'</td>';
  echo '<td>'.mysql_result($tmp,$i,6).'</td>';
  echo '</tr>';
}
echo '</table>';
?>