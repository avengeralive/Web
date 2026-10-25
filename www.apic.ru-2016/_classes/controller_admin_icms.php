<?
require_once(CLASSES_BASE.'admin_icms.php');
class admin_icms{
function admin_icms($m) {
		$this->m = &$m;
//MYSQL_DB.'.tree', MYSQL_DB.'.docs',MYSQL_DB.'.params', DOCUMENT_TEMPLATES_ADMIN
        }

function run(){
	global $HTTP_POST_VARS, $HTTP_GET_VARS;

	if (isset($HTTP_POST_VARS["ID"])) {
	    $ID = $HTTP_POST_VARS["ID"];
		$V = $HTTP_POST_VARS;
	    }
	elseif (isset($HTTP_GET_VARS["ID"])) {
	    $ID = $HTTP_GET_VARS["ID"];      
		$V = $HTTP_GET_VARS;
	    }
	else {
		$ID = "show_index";
		$V['currentid']=0;
		$V['currentlevel']=0;
		$V['maxlevel']=3;
		};
	$html = "";
	if ($ID == "show_index") {
		$html = $this->show_tree('index.html');
		}
	elseif ( method_exists($this, $ID) ) {
		$html = call_user_func(array(&$an,$ID));
		};
	ice_cache::no_cache($html, true);
	exit();
	}




}
?>