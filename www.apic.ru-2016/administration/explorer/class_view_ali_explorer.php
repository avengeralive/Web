<?
class view_ali_explorer{

function view_ali_explorer(){
	}

function get_directory($d, $directory, $dn, $order='name', $reverse=1, $template='get_directory.html'){

	$d = $this->sort_directory($d, $order, $reverse);

	$t = new ali_templates('get_directory.html');
	$t1 = new ali_templates('get_directory_row.html');
	$html = "";
	$count=0;
	$summ_size=0;
	while (list($k, $v) = each ($d)) {
		$count++;
		$summ_size +=$v['size'];
		//$bgcolor = "#ffffff";
		$bgcolor = "";
		$attr = '';
		$editdisabled="";
		$viewdisabled="";
		$godisabled="";
		if (!$v['pread']) {
			$attr .= "VO";
			$viewdisabled = "disabled";
			$editdisabled = "disabled";
			$godisabled = "disabled";
			};
		if (!$v['pwrite']) {
			$attr .= "RO";
//			$bgcolor = "#ffeeee";
			$bgcolor = "error";
			$editdisabled = "disabled";
			};
		if ($v['is_dir']) {
			$v['size'] = "";
			$viewdisabled = "disabled";
			$editdisabled = "disabled";
			};

			
			if (!(preg_match(PME_DISABLED_EXTENSIONS, $v['name']))){
						
		$html .= $t1->parse(
			array('SCRIPT_NAME', 'PME_WWW','dir', 'urlname', 'name', 'ico', 'size', 'modified', 'attr', 'bgcolor', 'order', 'reverse', 'viewdisabled', 'editdisabled', 'godisabled'),
			array(
				$_SERVER['SCRIPT_NAME'],
				PME_WWW,
				$directory, 
				urlencode($v['name']), 
				$v['name'], 
				$this->get_icon($v['name'], $v), 
				$v['size'], 
				date("d.m.Y\&\\n\b\s\p\;H:i:s" , $v['modified']), 
				$attr,
				$bgcolor,
				$order,
				$reverse,
				$viewdisabled,
				$editdisabled,
				$godisabled
				)
			);

				};


			};

	$navigation = $this->get_navigation($dn, $order, $reverse);

	if (is_writeable(PME_FOLDER_ROOT.$directory)) {
		$write_disabled="";
//		$write_color="#FFFFFF";
		$write_color="";
		}
	else {
		$write_disabled="disabled";
//		$write_color="#ffeeee";
		$write_color="error";
		};

	// сортировка
	$navn = array('name1', 'name-1', 'size1', 'size-1', 'modified1', 'modified-1');
	$navv = array('', '', '', '', '', '');
	while (list($k, $v) = each ($navn)) {
		if ($v == $order.$reverse) {
			$navv[$k] = '1';
			};
		};

	return 
		$t->parse (
			array_merge(
				array('plugins','SCRIPT_NAME','PME_WWW', 'html', 'navigation', 'directory','count', 'summ_size', 'write_disabled', 'write_color', 'order', 'reverse'),
				$navn
				),
			array_merge(
				array($this->get_plugins(),$_SERVER['SCRIPT_NAME'], PME_WWW, $html, $navigation, $directory, $count, intval($summ_size/1024),$write_disabled, $write_color, $order,$reverse),
				$navv
				)
			 );
	}



static function get_plugins(){
	$mm = ali_explorer::get_plugins();
	$plugins = "";
	while (list(,$v) = each ($mm)) {
		$plugins .= "<option value=\"plugin::$v\">Plugin::$v\n";
		};
	return $plugins;
	}


static function get_navigation($dn, $order='', $reverse=''){
	$navigation = "<li><a href='".$_SERVER['SCRIPT_NAME']."?ID=get&order=$order&reverse=$reverse&dir='>index</a><span class=divider>/</span></li>";
	$pp = "";
	while (list($k, $v) = each ($dn)) {
		if (strlen($v)>0) {
			$navigation .= "<li><a href='".$_SERVER['SCRIPT_NAME']."?ID=get&order=$order&reverse=$reverse&dir=$pp".urlencode($v)."'>$v</a><span class=divider>/</span></li>";
			$pp .= $v."/";
			};
		};
	return $navigation;
	}


function sort_directory($d, $orderby='name', $reverse=1){
	$GLOBALS['orderby'] = $orderby;
	$GLOBALS['reverse'] = $reverse;

	function cmp($a, $b) {
		if ($GLOBALS['orderby']=='size') {
			return $GLOBALS['reverse'] * (($a[$GLOBALS['orderby']]>$b[$GLOBALS['orderby']]) ? -1 : 1 );
			}
		else {
		    return $GLOBALS['reverse'] * strcmp($a[$GLOBALS['orderby']],$b[$GLOBALS['orderby']]);
			};
		}

	if (PME_FOLDERS_ALWAYS_FIRST) {
		// папки первыми.. юзабилити
		reset($d);
		$dd = array();
		$df = array();
		while (list($k, $v) = each ($d)) {
			if ($v['is_dir']) {
				$dd[] = $d[$k];
				}
			else {
				$df[] = $d[$k];
				};
			};
		usort($dd, "cmp");
		usort($df, "cmp");
		return array_merge ($dd, $df);
		}
	else {
		reset($d);
		usort($d, "cmp");
		return $d;
		};
	}


function get_icon($file, $f){
	if ($f['is_dir']){
		return "_folder.gif";
		};
	if (preg_match( "/^(.*)\.([A-Za-z]{1,8})$/", $file, $m) ) {
		if (file_exists(PME_FOLDER_ICO . $m[2] . ".gif")) {
			return $m[2] . ".gif";
			}
		};
	return "_default.gif";
	}


function get_edit($c, $dir, $file, $dn){
	$t = new ali_templates('edit_file.html');
	return $t->parse(
		array('SCRIPT_NAME', 'PME_WWW', 'content', 'directory', 'file', 'navigation'),
		array($_SERVER['SCRIPT_NAME'], PME_WWW, htmlspecialchars($c), $dir, $file, $this->get_navigation($dn))
		);
	}





function get_search($d, $directory, $dn, $q){

	$t = new ali_templates('search.html');
	$t1 = new ali_templates('search_row.html');
	$html = "";
	$count=0;
	$summ_size=0;
	while (list($k, $v) = each ($d)) {
		$count++;
		$summ_size +=$v['size'];
		$bgcolor = "#ffffff";
		$attr = '';
		$editdisabled="";
		$viewdisabled="";
		$godisabled="";
		if (!$v['pread']) {
			$attr .= "VO";
			$viewdisabled = "disabled";
			$editdisabled = "disabled";
			$godisabled = "disabled";
			};
		if (!$v['pwrite']) {
			$attr .= "RO";
//			$bgcolor = "#ffeeee";
			$bgcolor = "error";

			$editdisabled = "disabled";
			};
		if ($v['is_dir']) {
			$v['size'] = "";
			$viewdisabled = "disabled";
			$editdisabled = "disabled";
			};
		$html .= $t1->parse(
			array('SCRIPT_NAME', 'PME_WWW', 'urlname', 'name', 'ico', 'size', 'modified', 'attr', 'bgcolor', 'viewdisabled', 'editdisabled', 'godisabled'),
			array(
				$_SERVER['SCRIPT_NAME'],
				PME_WWW,
				urlencode($v['name']), 
				$v['name'], 
				$this->get_icon($v['name'], $v), 
				$v['size'], 
				date("d.m.Y\&\\n\b\s\p\;H:i:s" , $v['modified']), 
				$attr,
				$bgcolor,
				$viewdisabled,
				$editdisabled,
				$godisabled
				)
			);
		};

	$navigation = $this->get_navigation($dn);

	if (is_writeable(PME_FOLDER_ROOT.$directory)) {
		$write_disabled="";
		$write_color="#FFFFFF";
		}
	else {
		$write_disabled="disabled";
//		$write_color="#ffeeee";
		$write_color = "error";
		
		};

	return 
		$t->parse (
				array('plugins','q', 'SCRIPT_NAME','PME_WWW', 'html', 'navigation', 'directory','count', 'summ_size', 'write_disabled', 'write_color'),
				array($this->get_plugins(),htmlspecialchars($q), $_SERVER['SCRIPT_NAME'], PME_WWW, $html, $navigation, $directory, $count, intval($summ_size/1024),$write_disabled, $write_color)
			 );
	}




}

?>