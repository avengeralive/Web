<?php

define('GAME',true);

include('_incl_data/__config.php');
include('_incl_data/class/__db_connect.php');
include('_incl_data/class/__user.php');


if( $u->info['admin'] == 1 && $u->info['id'] != 2 ) {
	header('location: /index.php');
}

	

	//Редактор предметов
?>
<!DOCTYPE html>
<html xmlns="https://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
<title>Добавить предмет</title>
<style>
/* DivTable.com */
.divTable{
	display: table;
	width: 100%;
}
.divTableRow {
	display: table-row;
}
.divTableHeading {
	background-color: #EEE;
	display: table-header-group;
}
.divTableCell, .divTableHead {
	display: table-cell;
	padding: 3px 10px;
}
.divTableHeading {
	background-color: #EEE;
	display: table-header-group;
	font-weight: bold;
}
.divTableFoot {
	background-color: #EEE;
	display: table-footer-group;
	font-weight: bold;
}
.divTableBody {
	display: table-row-group;
}
</style>
</head>

<body>
<div class="divTable">
<div class="divTableBody">
<div class="divTableRow" style="width:100%">
<div class="divTableCell"style="width:50%"><legend><b>Физ. Класса:</b> </legend> </br>
<fieldset>
          <legend><b>ID вещи, Название, Картинка, Комплект вещи:</b> </legend><table> <tr> <td><input style="width: 50px;height: 15px;" placeholder="ID"></td><td><input style="width: 120px;height: 15px;"placeholder="Название вещи"></td><td><input type="file" id="imgFile"></td> <td>Комплект</td><td><select name="img_load1type">
      	  <option value="0">Без комплекта</option>
		  <option value="0">Комплект 1</option>
		  <option value="1">Комплект 2</option>
		  <option value="2">Комплект 3</option>
		  <option value="3">Комплект 4</option>
   	    </select></td></tr></table></fieldset>
<div class="divTableRow" style="width:100%">
<div class="divTableCell" style="width:50%">
<fieldset>
          <legend><b>Дает статы:</b> </legend>
<table>
<tr>
<td>Сила:</td><td><input style="width: 30px;height: 15px;"></td><td>Ловкость:</td><td><input style="width: 30px;height: 15px;"></td>
</tr>
<tr>
<td>Интуиция:</td><td><input style="width: 30px;height: 15px;"></td><td>Выносливость:</td><td><input style="width: 30px;height: 15px;"></td>
</tr>
<tr>
<td>Духовность:</td><td><input style="width: 30px;height: 15px;"></td><td>Воля:</td><td><input style="width: 30px;height: 15px;"></td>
</tr>
</table>
</fieldset> 
</div>

<div class="divTableCell" style="width:50%">
<fieldset>
          <legend><b>Дает владения оружием:</b> </legend>
<table>
<tr>
<td>Мечами:</td><td><input style="width: 30px;height: 15px;"></td><td>Дубинами:</td><td><input style="width: 30px;height: 15px;"></td>
</tr>
<tr>
<td>Ножами:</td><td><input style="width: 30px;height: 15px;"></td><td>Топорами:</td><td><input style="width: 30px;height: 15px;"></td>
</tr>
</table>
</fieldset>

</div>
</div>
</div>
<div class="divTableCell"style="width:50%"><legend><b>Маг. Класса:</b> </legend></br>
<fieldset>
          <legend><b>ID вещи, Название, Картинка, Комплект вещи:</b> </legend><table> <tr> <td><input style="width: 50px;height: 15px;" placeholder="ID"></td><td><input style="width: 120px;height: 15px;"placeholder="Название вещи"></td><td><input type="file" id="imgFile"></td> <td>Комплект</td><td><select name="img_load1type">
      	  <option value="0">Без комплекта</option>
		  <option value="0">Комплект 1</option>
		  <option value="1">Комплект 2</option>
		  <option value="2">Комплект 3</option>
		  <option value="3">Комплект 4</option>
   	    </select></td></tr></table></fieldset>
<div class="divTableRow" style="width:100%">
<div class="divTableCell" style="width:50%">
<fieldset>
          <legend><b>Дает статы:</b> </legend>
<table>
<td>Интеллект:</td><td><input style="width: 30px;height: 15px;"></td><td>Мудрость:</td><td><input style="width: 30px;height: 15px;"></td>
</tr>
<tr>
<td>Духовность:</td><td><input style="width: 30px;height: 15px;"></td><td>Воля:</td><td><input style="width: 30px;height: 15px;"></td>
</tr>
</table>
</fieldset> 
</div>
<div class="divTableCell" style="width:50%">
<fieldset>
          <legend><b>Дает владения магией:</b> </legend>
<table>
<tr>
<td>Огня:</td><td><input style="width: 30px;height: 15px;"></td><td>Воздуха:</td><td><input style="width: 30px;height: 15px;"></td>
</tr>
<tr>
<td>Воды:</td><td><input style="width: 30px;height: 15px;"></td><td>Земли:</td><td><input style="width: 30px;height: 15px;"></td>
</tr>
<tr>
<td>Серая:</td><td><input style="width: 30px;height: 15px;"></td><td>Темная:</td><td><input style="width: 30px;height: 15px;"></td>
</tr>
<tr>
<td>Светлая:</td><td><input style="width: 30px;height: 15px;"></td><td>Посохами:</td><td><input style="width: 30px;height: 15px;"></td>
</tr>
</table>
</fieldset>
</div>
</div>
</div>
</div>
</div>
</body>
</html>