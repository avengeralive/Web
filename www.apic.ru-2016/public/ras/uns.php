<html><head><title>Рассылка АПИК</title>
<meta http-equiv=content-Type content="text/html; charset=windows-1251">
</head>
<body>


<?php
require("head.php");

$sql='select mail from nr_mail where mail="'.addslashes($_GET["mail"]).'"';
$t_mail=mysql_query($sql);
$t_mail=mysql_result($t_mail,0,0);

$t_code=md5($t_mail.'1567apic');

if($_GET["mail"]==$t_mail && $_GET["code"]==$t_code)
{
	if($action=="fin")
	{
		$sql='update nr_mail set type=-1 where mail="'.addslashes($t_mail).'"';
		mysqL_query($sql);
		
		echo "<h2>Адрес ".$t_mail." был успешно удалён из рассылки АПИК</h2>";
        echo '<META HTTP-EQUIV="Refresh" CONTENT="5; URL=http://www.apic.ru/">';
	}
	else
	{
		echo '<h2><a href="uns.php?mail='.$_GET["mail"].'&code='.$_GET["code"].'&action=fin">Действительно хотите удалить адрес '.$t_mail.' из рассылки АПИК?</h2>';
	} 
}
else echo "<h2>Адрес ".$t_mail." не найден в рассылке АПИК</h2>"; 


?>
</body>
</html>