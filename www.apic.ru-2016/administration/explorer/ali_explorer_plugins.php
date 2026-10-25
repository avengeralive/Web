<?
class ali_explorer_plugins{

/**
*   просмотреть кучу картинок
*/
function view_images(&$V){
	header("Content-type: text/html");
	echo "<table border=1>";
	while (list($k, $file) = each ($V['file'])) {
		if (preg_match("/\.(gif|jpe?g|png)$/i", $file)) {
			$ss = @getimagesize(PME_FOLDER_ROOT.$file);
			if ($ss) {
				echo "<tr><td>$file</td><td>".filesize(PME_FOLDER_ROOT.$file)."</td><td><img src='?ID=view&file=$file'></td></tr>";
				};
			};
		};
	echo "</table>";
	exit();
	}


/**
*   перезаписать файлы из бэкапов
*/
function restore_backups(&$V){
	header("Content-type: text/plain");
	while (list($k, $file) = each ($V['file'])) {
	echo $file."\n";
		if (preg_match("/^(.*)\.[0-9]*\.backup$/", $file, $m)) {
			echo "$file is backup! new filename is $m[1] \n";
			echo "status=".(string)copy(PME_FOLDER_ROOT.$file, PME_FOLDER_ROOT.$m[1]) ."\n";
			};
		};
	exit();
	}


// статистика по использованию файлового пространства :-O
function folder_usage(&$V) {
		require('class_ali_stat.php');
		$GLOBALS['ext'] = array();
		echo "dir=".$V['dir'];
		$d = new AliStat($V['dir'] );
		reset($GLOBALS['ext']);
		echo "<table border=1>";
		while (list($k, $v) = each ($GLOBALS['ext'])) {
			echo "<tr><td>$k</td><td>".$v['count']."</td><td>".number_format($v['size'])."</td><td><a href=?ID=search&dir=".$V['dir']."&q=(.*)\.$k$>find files</a></td></tr>";
			};
		echo "</table>";
		exit();
	}

}
?>