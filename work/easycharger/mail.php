<?
if ($_POST['type'] == 1) {
	$message = '<table>
<tr>
<td>Фото листовки сторона 1</td>
<td>'.$_POST['bg1'].'</td>
</tr>
<tr>
<td>Фото листовки сторона 2</td>
<td>'.$_POST['bg2'].'</td>
</tr>
<tr>
<td>Бренд сторона 1</td>
<td>'.$_POST['brand1'].'</td>
</tr>
<tr>
<td>Бренд сторона 2</td>
<td>'.$_POST['brand2'].'</td>
</tr>
<tr>
<td>Цвет корпуса</td>
<td>'.$_POST['corpus'].'</td>
</tr>
<tr>
<td>Цвет кружков</td>
<td>'.$_POST['circles'].'</td>
</tr>
<tr>
<td>Цвет подсветки</td>
<td>'.$_POST['led'].'</td>
</tr>
<tr>
<td>Шнурки</td>
<td>'.$_POST['cables'].'</td>
</tr>
<tr>
<td>Имя</td>
<td>'.$_POST['name'].'</td>
</tr>
<tr>
<td>Почта</td>
<td>'.$_POST['email'].'</td>
</tr>
<tr>
<td>Телефон</td>
<td>'.$_POST['phone'].'</td>
</tr>
</table>';
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
mail('office@aliveliyev.com', 'Дизайн от '.$_POST['email'], $message, $headers); 
} else {
	$message = '<table>
<tr>
<td>Количество устройств</td>
<td>'.$_POST['devices'].'</td>
</tr>
<tr>
<td>Количество кабелей</td>
<td>'.$_POST['cables'].'</td>
</tr>
<tr>
<td>Количество антиивандальных тросов</td>
<td>'.$_POST['troses'].'</td>
</tr>
<tr>
<td>Количество платформ</td>
<td>'.$_POST['platform'].'</td>
</tr>
<tr>
<td>Цена</td>
<td>'.$_POST['price'].'</td>
</tr>
<tr>
<td>Имя</td>
<td>'.$_POST['name'].'</td>
</tr>
<tr>
<td>Почта</td>
<td>'.$_POST['email'].'</td>
</tr>
<tr>
<td>Телефон</td>
<td>'.$_POST['phone'].'</td>
</tr>
</table>';
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
mail('office@aliveliyev.com', 'Заказ от '.$_POST['email'], $message, $headers); 
}