<?php
//лог ошибок php
include('/home/admin/web/'.$_SERVER['HTTP_HOST'].'/public_html/_incl_data/__config.php');
$ADMIN = 1;

if(isset($_GET['go']) && $_GET['go']=='clear')
{
    $fp = fopen($c['doc_root']."/php-error.log", "r+");
	ftruncate($fp, 0);
	fclose($fp);
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Лог ошибок PHP</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE8" />
<meta http-equiv=Cache-Control Content=no-cache>
<meta http-equiv=PRAGMA content=NO-CACHE>
<meta http-equiv=Expires Content=0>
<link href="/css/common.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="/js/jquery.1.11.js"></script>
<body style="padding-top:0px; margin-top:7px; height:100%; background-color:#dedede;">
<p align=center><b style="color:#000;">Лог ошибок PHP:</b> &nbsp;
<input onClick="location.href='error_logs.php';" type="button" value="Обновить">
 &nbsp; &nbsp; &nbsp;<input onClick="location.href='error_logs.php?go=clear';" type="button" value="Очистить лог">
</p><br>

<form action="error_logs.php" method=post>
<p align=center>
<b style="color:#000;">Фильтр: </b>
<input name="log_filter" value="<?=$_POST['log_filter'];?>" type=text size=50>
<input type=submit value=Отправить>
</p>
</form>

<div style="width: 90%; border: 1px solid grey; padding: 5px; margin: 20px auto; height: 500px; overflow: scroll; color: #000;">
<?php
$log = file_get_contents($c['doc_root'].'/php-error.log');
$log = str_replace(' Europe/Moscow', '', $log);
$log = htmlspecialchars($log);
$i = 1;

if(isset($_POST['log_filter'])) $_POST['log_filter'] = trim($_POST['log_filter']);
$arr = explode("\n", $log);
$log = '';

foreach($arr as $line)
{
    $line = trim($line);
	if($line)
	{
		if(isset($_POST['log_filter']) && $_POST['log_filter'] && substr_count($line, $_POST['log_filter']))
		{
			$log .= '<span style="min-width: 20px; padding: 0 3px; display: inline-block; background: #FFFFCA;">'.$i.'</span>';
			$log .= str_replace($_POST['log_filter'],'<span style="color: red;">'.$_POST['log_filter'].'</span>', $line).'<br>';
	        $i++;
		}
		elseif(!isset($_POST['log_filter']) || !$_POST['log_filter'])
		{
	        $log .= '<span style="min-width: 20px; padding: 0 3px; display: inline-block; background: #FFFFCA;">'.$i.'</span>';
			$log .= $line.'<br>';
	        $i++;
		}
	}
}

echo nl2br($log);
?>
</div>
<p align="center" style="color:#000;">Переход на: <? echo ($c['test_server'] ? '<a href="https://'.$c['host_work'].'/adminion/mod/error_logs.php">Рабочий</a>' : '<a href="https://primebktest.testcombats.ru/adminion/mod/error_logs.php">Тестовый</a>'); ?></p>
</body>
</html>