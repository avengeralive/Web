<?

class AliStat{

function AliStat($name){
	$this->name = $name;
	$this->scan();
	}


function update($ext, $size){
	$ext = strtolower($ext);
	if (!isset($GLOBALS['ext'][$ext])) {
		$GLOBALS['ext'][$ext] = array('count'=>0, 'size'=>0);
		};
	$GLOBALS['ext'][$ext]['count'] += 1;
	$GLOBALS['ext'][$ext]['size'] += $size;
	}

function scan(){
	$d =  PME_FOLDER_ROOT .$this->name ."/";
	if ($f = opendir($d)) {
		while($file = readdir($f)) {
	    if ($file != "." && $file != "..") { 
			if (is_dir($d . $file)) {
				new AliStat($this->name."/".$file);
				}
			else {
				if (preg_match("/(.*)\.(.*)/", $file, $mm)) {
					$this->update( $mm[2],  filesize($d . $file) );
					}
				else {
					// no extension ..
					$this->update( ' ',  filesize($d . $file) );
					};
				};
			};
		};
		closedir($f);
		};
	}

}


?>
