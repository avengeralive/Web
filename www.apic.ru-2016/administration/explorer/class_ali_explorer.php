<?

error_reporting(E_ALL);

class ali_explorer{

function ali_explorer(){
	}

function get_directory($directory){
	$d =  PME_FOLDER_ROOT . $directory ."/";
	$d = str_replace('//','/',$d);
	$dd = scandir($d);
$r=array();
while(list($k,$file)=each($dd)){
 if ($file != "." && $file != "..") { 
		if (is_dir($d . $file)) {
			$size = '';
			}
		else {
			$size = filesize($d . $file);
			};
			
			
	    $r[] = array(
			'name'=>$file,
			'is_dir'=>is_dir($d . $file),
			'size'=>$size,
			'modified'=>filemtime($d . $file),
			'pread'=>is_readable($d . $file),
			'pwrite'=>is_writable($d . $file)
			);

	}
	}


/*
	if ($f = opendir($d)) {
		while($file = readdir($f)) {
 var_dump($file);
	    if ($file != "." && $file != "..") { 
		if (is_dir($d . $file)) {
			$size = '';
			}
		else {
			$size = filesize($d . $file);
			};
	    $r[] = array(
			'name'=>$file,
			'is_dir'=>is_dir($d . $file),
			'size'=>$size,
			'modified'=>filemtime($d . $file),
			'pread'=>is_readable($d . $file),
			'pwrite'=>is_writable($d . $file)
			);
			};
			};
		}
      else {
        echo "CANT OPEN DIR".$d;
	}
	closedir($f);
*/

	return $r;
	}



static function directory_to_navigation($directory){
	$dd = explode("/",$directory);
	return $dd;
	}

function get_file($file){
	$path_parts = pathinfo(PME_FOLDER_ROOT.$file);

	if (preg_match(PME_DISABLED_EXTENSIONS, $file)){
		echo "Opps.";
		exit();
		};
	
//	header("Pragma: no-cache");                                          // ie suxx
//	header("Cache-control: no-cache,max-age=0,must-revalidate");         // ie suxx
//	header("Content-Disposition: attachment,filename=".urlencode($path_parts["basename"]));  // ie suxx

	header("Content-Type: x-unknown-type");   // ONLY THIS FOR HTTPS+IE6 ?????????????????????????????????????????????????????????

			//	header("Content-Type: application/force-download; name=\"".urlencode($path_parts["basename"])."\"");  // SUXX
			//	header("Accept-Ranges: none");                                       // soon ..
			//	header("Last-Modified: ".gmdate("D, d M Y H:i:s", filemtime(PME_FOLDER_ROOT.$file))." GMT");
//	header("Content-Length: ".filesize(PME_FOLDER_ROOT.$file));
	$fp = fopen(PME_FOLDER_ROOT.$file, "rb");
	$out = fread($fp, filesize(PME_FOLDER_ROOT.$file));
	fclose($fp);
	echo $out;
	}


function get_zip($files){
	$name = time().".zip";
//	header("Pragma: no-cache");                                          // ie suxx
	header("Cache-control: no-cache,max-age=0,must-revalidate");         // ie suxx
	header("Content-Disposition: attachment,filename=\"".$name."\"");  // ie suxx
	header("Content-Type: x-unknown-type");
//	header("Content-Type: application/force-download; name=\"".$name."\"");
//	header("Accept-Ranges: none");                                       // soon ..
	$this->z = new zipfile();
	while (list(,$file) = each ($files)) {
		if ( !preg_match("/\.\.\//", $file)  && file_exists(PME_FOLDER_ROOT.$file) ) {

		if (!(preg_match(PME_DISABLED_EXTENSIONS, $file))){
				if (is_file(PME_FOLDER_ROOT.$file)) {
					$this->_add_file_to_zip($file);
					};
				if (is_dir(PME_FOLDER_ROOT.$file)) {
					$this->_add_dir_to_zip($file);
					};
				};
			};
		};
	echo $this->z->file();
	}


function _add_file_to_zip($file){
	if (preg_match(PME_DISABLED_EXTENSIONS, $file)){
		return;
		};
	$fp = fopen(PME_FOLDER_ROOT.$file, "rb");
	$out = fread($fp, filesize(PME_FOLDER_ROOT.$file));
	fclose($fp);
//	$path_parts = pathinfo(PME_FOLDER_ROOT.$file);
//	$this->z->add_file($out , $path_parts["basename"] );
	$this->z->add_file($out , $file , filemtime(PME_FOLDER_ROOT. $file));
	}

// рекурсивно пройдемся по директории..
function _add_dir_to_zip($dir){
	$this->z->add_dir($dir);
	if ($f = opendir(PME_FOLDER_ROOT.$dir)) {
		while($file = readdir($f)) {
			if ($file != "." && $file != "..") {
				if (is_file(PME_FOLDER_ROOT.$dir."/".$file)) {
					$this->_add_file_to_zip($dir."/".$file);
					};
				if (is_dir(PME_FOLDER_ROOT.$dir."/".$file)) {
					$this->_add_dir_to_zip($dir."/".$file);
					};
				};
			};
		};
	}


function delete_files($files){
	$s = array();
	while (list(,$file) = each ($files)) {
	if (preg_match(PME_DISABLED_EXTENSIONS, $file)){
		return;
		};
	if ( !preg_match("/\.\.\//", $file)  && file_exists(PME_FOLDER_ROOT.$file) ) {
			if (is_file(PME_FOLDER_ROOT.$file)) {
				$s[$file] = $this->_delete_file($file);
				};
			if (is_dir(PME_FOLDER_ROOT.$file)) {
				$this->_delete_folder($file);
				};
			};
		};
	return $s;
	}


function _delete_file($file){
	if (preg_match(PME_DISABLED_EXTENSIONS, $file)){
		return;
		};

	$s = false;
	if ( is_writeable(PME_FOLDER_ROOT . $file) ) {
		$res = unlink(PME_FOLDER_ROOT . $file);
		if (!file_exists(PME_FOLDER_ROOT . $file)) {
			$s = true;
			};
		};
	return $s;
	}

// рукурсивный проход
function _delete_folder($dir){

	if ($f = opendir(PME_FOLDER_ROOT.$dir)) {
		while($file = readdir($f)) {
			if ($file != "." && $file != "..") {


			if (is_file(PME_FOLDER_ROOT.$dir."/".$file)) {
				if (preg_match(PME_DISABLED_EXTENSIONS, $file)){
					return;
					};
					$this->_delete_file($dir."/".$file);
					};
				if (is_dir(PME_FOLDER_ROOT.$dir."/".$file)) {
					$this->_delete_folder($dir."/".$file);
					};
				};
			};
		closedir($f);
		};
	rmdir(PME_FOLDER_ROOT.$dir);
	}


function upload_file($tmp_name, $dir, $name){
	if (is_writeable(PME_FOLDER_ROOT.$dir)) {

			if (preg_match(PME_DISABLED_EXTENSIONS, $name)){
				return false;
				};


	$res = move_uploaded_file($tmp_name, PME_FOLDER_ROOT.$dir."/".$name);
		if (file_exists(PME_FOLDER_ROOT.$dir."/".$name)) {
			return true;
			};
		};
	return false;
	}

function create_folder($dir, $new) {
	if (!is_writeable(PME_FOLDER_ROOT.$dir)) {
		return false;
		};
	return mkdir(PME_FOLDER_ROOT.$dir."/".$new);
	}


function get($file){
	if (!( is_file(PME_FOLDER_ROOT.$file) && is_readable(PME_FOLDER_ROOT.$file)   )){
		return false;
		};
	$fp = fopen(PME_FOLDER_ROOT.$file, "rb");
	$out = fread($fp, filesize(PME_FOLDER_ROOT.$file));
	fclose($fp);
	return $out;
	}


function create($file, $content){
			if (preg_match(PME_DISABLED_EXTENSIONS, $file)){
				return;
				};

	$fp = fopen(PME_FOLDER_ROOT.$file, "wb");
	$out = fwrite($fp, $content);
	fclose($fp);
	}

function execute($s){
	eval($s);
	}


function find_file_by_regexp($dir, $regexp){
	return $this->_find_file_in_directory($dir, $regexp);
	}

function _find_file_in_directory($dir, $regexp){
	$s = array();
	if ($f = opendir(PME_FOLDER_ROOT.$dir)) {
		while($file = readdir($f)) {
			if ($file != "." && $file != "..") {
				if (
					(is_file(PME_FOLDER_ROOT.$dir."/".$file))  && 
					(preg_match("/".$regexp."/i", $file))
					) {

				if (preg_match(PME_DISABLED_EXTENSIONS, $file)){
					}
				else {
					$s[] = array(
						'name'=>$dir."/".$file,
						'is_dir'=>is_dir($dir ."/". $file),
						'size'=>filesize (PME_FOLDER_ROOT.$dir ."/". $file),
						'modified'=>filemtime(PME_FOLDER_ROOT.$dir ."/". $file),
						'pread'=>is_readable(PME_FOLDER_ROOT.$dir ."/". $file),
						'pwrite'=>is_writable(PME_FOLDER_ROOT.$dir ."/". $file)
						);
						};
					};
				if (is_dir(PME_FOLDER_ROOT.$dir."/".$file)) {
					$ss = $this->_find_file_in_directory($dir."/".$file, $regexp);
					$s = array_merge($s, $ss);
					};
				};
			};
		};
	return $s;
	}


static function get_plugins(){
	return get_class_methods('ali_explorer_plugins');
	}

}

?>