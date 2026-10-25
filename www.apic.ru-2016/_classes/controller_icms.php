<?
require_once(CLASSES_BASE.'class_ice_mysql.php');
require_once(CLASSES_BASE.'factory_model_icms.php');
require_once(CLASSES_BASE.'factory_view_icms.php');

class controller_icms {
public $m = NULL;

function controller_icms(){
	}

function run(){
	global $_GET, $V;
	$URL=$_GET['ID']; $V=$_GET;
// xcache
	if (defined('XCACHE_ENABLED') && (true==XCACHE_ENABLED)){
		$html = xcache_get('icms_html_'.$URL);
		if ($html){
			echo $html;
			exit();
			};
		};

//object
	$m = new ice_mysql();
	$this->m = &$m;
	$e = new factory_model_icms($m);
	$ids = $e->get_id_and_type_for_url($URL, true, false);
	if ( (isset($ids['object']['status'])) && ($ids['object']['status']=='disabled') ) {
		trigger_error("Object ".$ids['object']['id']." for url=".$URL." is disabled", E_USER_NOTICE);
		$this->say_error('403');
		};
	if ( !$ids['status'] ) {
		//trigger_error("Can't get object id&type for url=".$URL, E_USER_NOTICE);
		$this->try_redirect($URL);
		};
	$e = $e->get_me( $ids['object']['type'] );
	if ( !is_object($e) ) {
		trigger_error("Can't create model for type ".$ids['object']['type'].". Please check that ".CLASSES_BASE."model_icecms_".$ids['object']['type'].".php exists and have correct class.", E_USER_WARNING);
		$this->say_error('503');
		};
	$o = $e->get_object_by_id( $ids['object']['id'], $V );
	if ( !$o['status'] ) {
		trigger_error("Can't get object for id=".$ids['object']['id']." type=".$ids['object']['type']." in class ".get_class($e), E_USER_WARNING);
		$this->say_error('503');
		};
//view
	$v = new factory_view_icms();
	$v = $v->get_me( $ids['object']['type'] );
	if ( !is_object($v) ) {
		trigger_error("Can't create view for type ".$ids['object']['type'].". Please check that ".CLASSES_BASE."view_icecms_".$ids['object']['type'].".php exists and have correct class.", E_USER_WARNING);
		$this->say_error('503');
		};
	$html = $v->get_html( $o );
// xcache
	if (defined('XCACHE_ENABLED') && (true==XCACHE_ENABLED)){
		if (preg_match('/folder/', $ids['object']['type'])){
			xcache_set('icms_html_'.$URL, $html);
			};
		};
	echo $html;
	}


function get_me($classname, $type) {
	$factory = $classname.'_icecms_'.$type;
	if (file_exists(CLASSES_BASE.$factory.'.php')) {
		require_once(CLASSES_BASE.$factory.'.php');
		};
	if (class_exists( $factory )) {
		$o = new $factory($this->m);
		return $o;
		};
	return false;
	}




function try_redirect($URL){
	global $_GET, $V;
	
	// возможно у нас есть ТОЧНОЕ совпадение старого УРЛ на новый. тогда мы его заиспользуем.
	$o = $this->m->selectOneRow("
	SELECT 
		urlto,
		status
	FROM
		".MYSQL_DB.".redirect
	WHERE
		urlfrom = '#url#'
	ORDER BY
		id DESC
	LIMIT 1
	", '','',array('url'=>$URL));
	if (isset($o['urlto'])){
		if ($o['status']=='redirect'){
			header('X-Redirect-from: try_redirect()');
			header('Location: '.$o['urlto']);
			exit();
			}
		elseif($o['status']=='symlink'){
			$_GET['ID']=$o['urlto'];
			header('X-Redirect-from: try_redirect() '.urlencode($URL).' to '.$o['urlto']);
//			return $this->run();
			$this->run();
			exit();
			};
		};

	// попробуем то же самое но регекспом
	// отбираем те маски, которые подходят к нашему УРЛ.
	$o = $this->m->selectOneRow("
	SELECT 
		urlto,
		status
	FROM
		".MYSQL_DB.".redirect
	WHERE
	 '#url#' REGEXP(urlfrom) 
	ORDER BY
		id DESC
	LIMIT 1
	", '','',array('url'=>$URL));
	if (isset($o['urlto'])){
		if ($o['status']=='redirect'){
			header('X-Redirect-from: try_redirect()');
			header('Location: '.$o['urlto']);
			exit();
			}
		elseif($o['status']=='symlink'){
			$_GET['ID']=$o['urlto'];
			header('X-Redirect-from: try_redirect() '.urlencode($URL).' to '.$o['urlto']);
			//return $this->run();
			$this->run();
			exit();
			};
		};

	// не знаем такого урл совсем, скажем 403
	return $this->say_error('403');
	}




function say_error($type){

	// перекинем на какую то страницу редиректом. скорей всего на / 
	if (defined('CMS_VARS_404_REDIRECT') && (CMS_VARS_404_REDIRECT==true) && defined('CMS_VARS_404_REDIRECT_URL')) {
		header('Location: '.CMS_VARS_404_REDIRECT_URL);
		exit();
		};

	header ("HTTP/1.0 '".$type."' error");
	if (file_exists(CMS_VARS_404_TEMPLATE )) {
		readfile(CMS_VARS_404_TEMPLATE);
		}
	else {
		echo "<h1>".$type."</h1>";
		};
	exit();
	}

}
?>