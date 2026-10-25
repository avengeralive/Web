<?php
include_once('../_incl_data/__config.php');
define('GAME',true);
include_once('../_incl_data/class/__db_connect.php');
include_once('../_incl_data/class/__user.php');
if($u->info['admin']!=1){
	die();
}
	//Нагрузка
	$la = sys_getloadavg();
	$la_now = round(($la[0]*100)/8);

	if ($la_now < 30) {
		$la_now = '<font color=green>'.$la_now.'%</font>';
	} elseif ($la_now < 50) {
		$la_now = '<font color=orange>'.$la_now.'%</font>';
	} else {
		$la_now = '<font color=red>'.$la_now.'%</font>';
	}
	echo 'Время: '.date('H:i:s').' / CPU: '.$la_now;
	//echo ' / LA: '.round($la[0],2).' : '.round($la[1],2).' : '.round($la[2],2);
	
	$sp = mysql_fetch_array(mysql_query('SELECT COUNT(`id`) FROM `users` WHERE `online` > ('.time().'-600) AND `inUser` = "0" AND `no_ip` != "trupojor" AND `login` NOT LIKE "%(%" AND `banned` = 0 AND `bot_id` = 0 AND `pass` != "saintlucia" LIMIT 1'));
    $sp2 = mysql_fetch_array(mysql_query('SELECT COUNT(`id`) FROM `users` WHERE `online` > ('.time().'-600) AND `inUser` = "0" AND `no_ip` != "trupojor" AND `login` NOT LIKE "%(%" AND `banned` = 0 AND `bot_id` = 0 AND `pass` = "saintlucia" LIMIT 1'));

	$online = $sp[0];
    $la[0]=$la[0]/8;
	$la[1]=$la[1]/8;
	$la[2]=$la[2]/8;
	if($online == 0 ) $online = 1;

	//Место на диске
	$df = disk_free_space($c['doc_root']);
	function formatSize( $bytes )
	{
		$types = array( 'Б', 'КБ', 'МБ', 'ГБ', 'ТБ' );
		for( $i = 0; $bytes >= 1024 && $i < ( count( $types ) -1 ); $bytes /= 1024, $i++ );
		return( round( $bytes ) . " " . $types[$i] );
	}
	function ramMemory(){
	    exec("free -m", $output);
	    $output[1] = str_replace("Mem:", "", $output[1]);
	    $output[1] = (string)trim($output[1]);
	    $mem = explode(" ", $output[1]);
	    $mem = array_filter($mem);
	    $mem = array_merge($mem);
	    return $mem;
	}
	$mem = ramMemory();
    $cache = '<font color='.(($mem[4] > $mem[0]*0.5) ? 'red' : 'green').'>'.formatSize($mem[4]*1024*1024).'</font>';
    $free = '<font color='.(($mem[2] < $mem[0]*0.25) ?  'red' : 'green').'>'.formatSize($mem[2]*1024*1024).'</font>';

	echo' / Онлайн: <b style="color:#ff0000;">'.$online.'</b> / Ботов: <b style="color:#ff0000;">'.$sp2[0].'</b> / USI: '.round(($la[2]*100/$online),1).'% / FreeSpace: '.formatSize($df).' / RAM: '.formatSize($mem[0]*1024*1024).', Used: '.formatSize($mem[1]*1024*1024).', Shared: '.formatSize($mem[3]*1024*1024).', Cache: '.$cache.', Free: '.$free;