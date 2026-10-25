<?
define('GAME',true);
include('_incl_data/__config.php');
include('_incl_data/class/__db_connect.php');
include('_incl_data/class/__user.php');

$r = '';
$b = '<table width="100%" cellpadding="0" cellspacing="0" border="0">
  <tbody>
    <tr valign="top">
      <td valign="bottom" nowrap="" title=""><input onClick="location=location;" style="padding:5px;" type="submit" name="analiz2" value="Обновить"></td>
    </tr>
  </tbody>
</table>';

$log_id = (isset($_GET['id']) ? intval($_GET['id']) : 1);


$log = mysql_fetch_array(mysql_query('SELECT `tid` FROM `ruine_logs` WHERE `tid` = "'.mysql_real_escape_string($log_id).'" ORDER BY `id` ASC LIMIT 1'));
//pr($log['id']);
if(!isset($log['tid'])) $r = '<br><br><center>Скорее всего Архивариус снова потерял пергамент с хрониками турниров ...</center>';
else {
		$sp = mysql_query('SELECT * FROM `ruine_logs` WHERE `tid` = "'.$log['tid'].'" ORDER BY `id` ASC');
		while( $pl = mysql_fetch_array($sp) )
		{
			$r .= '<br><span class="date">'.date('d.m.y H:i',$pl['time']).'</span> '.$pl['text'];
		}
	}
?>

<!DOCTYPE html>
<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
<title>Архив: Руины Старого Замка</title>
<script src="https://img.testcombats.ru/js/Lite/gameEngine.js" type="text/javascript"></script>
<link href="https://img.testcombats.ru/css/main.css" rel="stylesheet" type="text/css">
<style type="text/css">
h3 {text-align: center;}
.CSSteam	{ font-weight: bold; cursor:pointer; }
.CSSteam0	{ font-weight: bold; cursor:pointer; }
.CSSteam1	{ font-weight: bold; color: #6666CC; cursor:pointer; }
.CSSteam2	{ font-weight: bold; color: #B06A00; cursor:pointer; }
.CSSteam3 	{ font-weight: bold; color: #269088; cursor:pointer; }
.CSSteam4 	{ font-weight: bold; color: #A0AF20; cursor:pointer; }
.CSSteam5 	{ font-weight: bold; color: #0F79D3; cursor:pointer; }
.CSSteam6 	{ font-weight: bold; color: #D85E23; cursor:pointer; }
.CSSteam7 	{ font-weight: bold; color: #5C832F; cursor:pointer; }
.CSSteam8 	{ font-weight: bold; color: #842B61; cursor:pointer; }
.CSSteam9 	{ font-weight: bold; color: navy; cursor:pointer; }
.CSSvs 		{ font-weight: bold; }
</style>
</head>

<body bgcolor="#E2E0E0">
<H3>Руины Старого Замка. Отчет о турнире. &nbsp; <a href="https://www.testcombats.ru/">www.testcombats.ru</a></H3>
<? echo $r; ?>
</body>
</html>