<?php
//лог ошибок php
include('/home/admin/web/'.$_SERVER['HTTP_HOST'].'/public_html/_incl_data/__config.php');



if(isset($_GET['go']) && $_GET['go']=='clear')
{
    $fp = fopen($c['doc_root']."/crons/cron.log", "r+");
	ftruncate($fp, 0);
	fclose($fp);
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Лог крона</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE8" />
<meta http-equiv=Cache-Control Content=no-cache>
<meta http-equiv=PRAGMA content=NO-CACHE>
<meta http-equiv=Expires Content=0>
<link href="/css/common.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="/js/jquery.1.11.js"></script>
<body style="padding-top:0px; margin-top:7px; height:100%; background-color:#dedede;">
<p align=center><b style="color:#000;">Лог крона:</b> &nbsp;
<input onClick="location.href='cron_logs.php';" type="button" value="Обновить">
 &nbsp; &nbsp; &nbsp;<input onClick="location.href='cron_logs.php?go=clear';" type="button" value="Очистить лог">
</p><br>

<div style="width: 90%; border: 1px solid grey; padding: 5px; margin: 10px auto; height: 500px; overflow: scroll; color: #000;">
<?php echo nl2br(htmlspecialchars(file_get_contents($c['doc_root'].'/crons/cron.log')));?>
</div>
<p align="center" style="color:#000;">Переход на: <? echo ($c['test_server'] ? '<a href="https://'.$c['host_work'].'/adminion/mod/cron_logs.php">Рабочий</a>' : '<a href="https://'.$c['host_test'].'/adminion/mod/cron_logs.php">Тестовый</a>'); ?></p>
</body>
</html>