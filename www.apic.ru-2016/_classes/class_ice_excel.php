<?
require_once CLASSES_BASE.'/phpexcelreader/reader.php';

class ice_excel{

function read_file($file, $map, $first_line=1, $remove_empty_lines=false){
	$data = new Spreadsheet_Excel_Reader();
	$data->setOutputEncoding('CP1251');
	$data->read($file);
	$result = array();
//alid($data->boundsheets);
	// пройдем по всем найденным "страницам"
	$c=0;
	reset($data->boundsheets);

	 while(list($index,$sheet)=each($data->boundsheets)) {
		$num_rows = $data->sheets[	$index	]['numRows'];
//		echo $index.'=>'.$num_rows.' name='.$data->sheets[	$index	]['name']."\r\n";
/*
	 while(list($k,$v)=each(	$data->sheets[	$index	]	)) {
	 	echo "$k =>$v \r\n";
	 	};
		exit();
*/

		$num_cols = sizeof($map);
		for ($i = $first_line; $i <= $num_rows; $i++) {
		 	$c++;
			$result[$c]=array();
			for ($j = 1; $j <= $num_cols; $j++) {
				$result[$c][	$map[$j]	]='';
				if (isset($data->sheets[	$index	]['cells'][$i][$j])){
					$result[$c][	$map[$j]	]=$data->sheets[	$index	]['cells'][$i][$j];
					};
				};
			};
		};
/*
	// очистим пустые
		if ($remove_empty_lines){
			reset($result);
			for ($i = $first_line; $i <= $num_rows; $i++) {
				$delete = true;
				while(list($k,$v)=each($result[$i])) {
					if (strlen($v)>0){
						$delete = false;
						};
					};
				if ($delete) {
					unset($result[$i]);
					};
				};
			};
*/

	return $result;
	}


}
?>
