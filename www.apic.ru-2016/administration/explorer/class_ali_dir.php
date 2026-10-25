<?

class AliDir{


function AliDir($name, $parent, &$oparent, $fcount=0, $fsize=0){
	$this->name = $name;
	$this->oparent = &$oparent;
	$this->parent = $parent;
	$this->fcount=0;
	$this->fsize=0;
	$this->child = array();
	$this->scan();
	}


function update($fcount, $fsize){
	$this->fcount += $fcount;
	$this->fsize += $fsize;
	if (is_object($this->oparent) ) {
		$this->oparent->update($fcount, $fsize);
		};
	}


function graph(){
	$name= preg_replace(
		"/(\/+)/",
		"/",
		"/".$this->parent.$this->name."/"
		);

	if (sizeof($this->child)>0) {
		$t = new ali_templates("get_tree_child.html");
		$child = "";
		while (list(,$o) = each ($this->child)) {
			$child .= $o->graph();
			};
		return $t->parse(
			array('PME_WWW', 'name', 'uname', 'size', 'count', 'child'),
			array(PME_WWW, $name, urlencode($name), number_format($this->fsize), $this->fcount, $child)
			);
		}
	else {
		$t = new ali_templates("get_tree_nochild.html");
		return $t->parse(
			array('PME_WWW', 'name', 'uname', 'size', 'count'),
			array(PME_WWW, $name, urlencode($name), number_format($this->fsize), $this->fcount)
			);
		};
	}


function scan(){
	$d =  PME_FOLDER_ROOT . $this->parent."/".$this->name ."/";

	$dd = scandir($d);
$r=array();
		$cc=0;
		$ss=0;
while(list($k,$file)=each($dd)){
 if ($file != "." && $file != "..") { 
		if (is_dir($d . $file)) {
				$this->child[] = new AliDir($file, $this->parent."/".$this->name."/", $this, 0,0 );
			}
		else {
				$cc +=1;
				$ss +=filesize($d . $file);
			};

	}
	}
		$this->update($cc, $ss);
		sort($this->child);

	/*
	if ($f = opendir($d)) {
		$cc=0;
		$ss=0;
		while($file = readdir($f)) {
	    if ($file != "." && $file != "..") { 
			if (is_dir($d . $file)) {
				$this->child[] = new AliDir($file, $this->parent."/".$this->name."/", $this, 0,0 );
				}
			else {
				$cc +=1;
				$ss +=filesize($d . $file);
				};
			};
		};
		closedir($f);
		$this->update($cc, $ss);
		sort($this->child);
		};
	*/
		
	}
	

}


?>
