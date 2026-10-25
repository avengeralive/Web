<?

require_once('../_settings/settings.php');
require_once(CLASSES_BASE.'class_ice_error_handler.php');
require_once(CLASSES_BASE.'class_ice_templates.php');
require_once(CLASSES_BASE.'class_ice_mysql.php');
require_once(CLASSES_BASE.'class_ice_cache.php');
require_once(CLASSES_BASE.'class_permission_manager.php');
require_once(CLASSES_BASE.'model_money_currency.php');
require_once(CLASSES_BASE.'admin_icms.php');


$currency_names = array(
	'0'=>'unset',
	'1'=>'usd',
	'2'=>'euro',
	'3'=>'rur',
	'4'=>'frank'
	);

$rights = array(
    'view'=>57,
    'edit'=>57
    );

$bgcolors = array(
    "0" => "#ffffff",
    "1" => "#f0f0f0",
    "2" => "#ffdddd",
	"3" => "#ddddff",
	"4" => "#ccccff"
	);

//$m = new ice_mysql();
//$m_money = new model_money_currency($m, MYSQL_DB);
//$cmsadm = new cms_admin(&$m, MYSQL_DB.'.tree', MYSQL_DB.'.docs',MYSQL_DB.'.params', DOCUMENT_TEMPLATES_ADMIN);
$m = new ice_mysql();
$cmsadm = new admin_icms(&$m);
//$m_money = new model_money_currency($m, MYSQL_DB);


$pm = new permission_manager($m, MYSQL_DB);
if (!$pm->checkLogged()){
	// добавить в лог что кто то логинилс€...
	exit();
	};
$status_permission = $pm->check_rights($rights['view']);
if (!$status_permission['status']) {
	$pm->show_permission_denied();
	exit();
	};

if (isset($HTTP_POST_VARS['ID'])) {
	$ID = $HTTP_POST_VARS['ID'];
	$V = $HTTP_POST_VARS;
	}
elseif (isset($HTTP_GET_VARS['ID'])) {
	$ID = $HTTP_GET_VARS['ID'];
	$V = $HTTP_GET_VARS;
	}
else {
	$ID = 'index';
	$V = $HTTP_GET_VARS;
	};

//$model_curr = new model_money_currency(&$m);

$html = "";
if ( function_exists($ID) ) {

// cache purge before 
	if ( defined('XCACHE_ENABLED') && (true==XCACHE_ENABLED)){
		xcache_unset_by_prefix('icms_');
		};

	$html = call_user_func($ID);

// cache purge after
	if ( defined('XCACHE_ENABLED') && (true==XCACHE_ENABLED)){
		xcache_unset_by_prefix('icms_');
		};

	}
else {
	ali_debug('','','',$HTTP_GET_VARS);
	ali_debug('','','',$HTTP_POST_VARS);
	echo "ќбработчик дл€ $ID не существует.";
	exit();
	};

ice_cache::no_cache($html, true);
exit();


//========================================================================================================//




function index($error = '') {
		global $m, $pm, $V, $bgcolors, $currency_names, $cmsadm;
		$cbgcolor = 0;

		$obj = $cmsadm->get_object_childs(ID_CATALOG);
		$obj0=array();
		while(list($k,$v)=each($obj['childs'])) {
			$obj1 = $cmsadm->get_object_childs($v['id']);
			$obj0[$v['id']]=$v;
			$obj0[$v['id']]['childs']=$obj1['childs'];
			};

//		$obj = get_object_childs(   $V['document_id']  );
//		$document_id =   $V['document_id']  ;
//		$items = get_childs_array($obj['childs']);
// alid($obj0 );
		$t = new ice_templates();
		$t->set_file("page", DOCUMENT_TEMPLATES_ADMIN_INDEX."edit_url/index.html" );
		$t->set_var('HTTPS_BASE_ADMIN',  HTTPS_BASE_ADMIN);
		$t->set_var('HTTPS_BASE_ADMIN_IMAGES',  HTTPS_BASE_ADMIN_IMAGES);
		$t->set_var('ERROR',  $error);

		$t->set_block('page', 'BLOCK.GLOBAL', 'BLOCK_GLOBAL');
//		$t->set_block('BLOCK.GLOBAL', 'BLOCK.CATALOG', 'BLOCK_CATALOG');
//		$t->set_block('BLOCK.GLOBAL', 'BLOCK.LIST', 'BLOCK_LIST');
//		$t->set_block('BLOCK.LIST', 'BLOCK.MONEY', 'BLOCK_MONEY');

		$t->set_var('BLOCK_GLOBAL', '');
//		$t->set_var('BLOCK_CATALOG', '');
//		$t->set_var('BLOCK_LIST', '');
//		$t->set_var('BLOCK_MONEY', '');
//		$t->set_var('document_id', $document_id);

//while(list($k,$v)=each($obj['childs'])) {

while(list($kk,$vv)=each($obj0)) {

                			    $cbgcolor = intval(!($cbgcolor));
                                $t->set_var('bgcolor', $bgcolors[3]);
                				$t->set_var('id',  $vv['id']);
                				$t->set_var('name',  $vv['fullname']);
//                				$t->set_var('url',  $cmsadm->get_cms_url($v['type'], $v['url']) );
                				$t->set_var('url',  $cmsadm->get_cms_url($vv['type'], $vv['url']) );
                        $t->parse('BLOCK_GLOBAL', 'BLOCK.GLOBAL', true);

	while(list($k,$v)=each($vv['childs'])) {
                			    $cbgcolor = intval(!($cbgcolor));
                                $t->set_var('bgcolor', $bgcolors[$cbgcolor]);
                				$t->set_var('id',  $v['id']);
                				$t->set_var('name',  $v['fullname']);
                				$t->set_var('url',  $cmsadm->get_cms_url($v['type'], $v['url']) );
                        $t->parse('BLOCK_GLOBAL', 'BLOCK.GLOBAL', true);
                }
           }
/*
*/



//		$pm->_set_write_disabled(&$t);
		$t->parse("page","page");

		return $t->get("page");
}










function show_edit_value($error = '') {
        return show_edit_price($error);
        }


function show_edit_price($error = '') {
		global $m, $pm, $V, $bgcolors, $currency_names, $cmsadm, $m_money;
		$cbgcolor = 0;
		$obj = $cmsadm->get_tree(   $V['document_id'],1,1000  );

		$t = new ice_templates();
		$t->set_file("page", DOCUMENT_TEMPLATES_ADMIN_INDEX."edit_url/edit.html" );
		$t->set_var('HTTPS_BASE_ADMIN',  HTTPS_BASE_ADMIN);
		$t->set_var('HTTPS_BASE_ADMIN_IMAGES',  HTTPS_BASE_ADMIN_IMAGES);
		$t->set_var('ERROR',  $error);
		$t->set_block('page', 'BLOCK.GLOBAL', 'BLOCK_GLOBAL');
		$t->set_block('BLOCK.GLOBAL', 'BLOCK.CATALOG', 'BLOCK_CATALOG');
		$t->set_block('BLOCK.GLOBAL', 'BLOCK.LIST', 'BLOCK_LIST');
		$t->set_block('BLOCK.LIST', 'BLOCK.MONEY', 'BLOCK_MONEY');
		$t->set_var('BLOCK_GLOBAL', '');
		$t->set_var('BLOCK_CATALOG', '');
		$t->set_var('BLOCK_LIST', '');
		$t->set_var('document_id', $V['document_id']);
		while(list(,$v)=each($obj['catalog'])) {
			$v['url'] = trim($v['url']);
 			if (!(preg_match("/^[\-\_\/\*\~a-zA-Z0-9]{1,}$/iu",$v['url'],$mch))){
			
				$v['url'] = str_replace('[','',$v['url']);
				$v['url'] = str_replace(']','',$v['url']);
				$v['url'] = str_replace('=','',$v['url']);
				$v['url'] = str_replace('+','-',$v['url']);
				$v['url'] = str_replace('?','-',$v['url']);
				$v['url'] = str_replace('\\','-',$v['url']);
				$v['url'] = str_replace('Е','-',$v['url']);
				$v['url'] = str_replace(':','-',$v['url']);
				$v['url'] = str_replace(';','-',$v['url']);
				$v['url'] = str_replace('&','-',$v['url']);
				$v['url'] = str_replace('#','-',$v['url']);
				
		        $t->set_var('BLOCK_CATALOG', '');
        		$t->set_var('BLOCK_LIST', '');
	                        if($v['type'] == TYPE_ITEMCARD) {
                			    $cbgcolor = intval(!($cbgcolor));
                				$t->set_var('id',  $v['id']);
                				$t->set_var('name',  $v['name']);
                				$t->set_var('url',  $v['url'] );
                                $t->set_var('bgcolor', $bgcolors[$cbgcolor]);
                                $t->parse('BLOCK_LIST', 'BLOCK.LIST', false);
    	                        }
	                        else {
                				$t->set_var('id',  $v['id']);
								$t->set_var('name',    $v['name']);
								$t->set_var('url',    $v['url']);
				                $t->set_var('bgcolor', $bgcolors[3]);
                                $t->parse('BLOCK_CATALOG', 'BLOCK.CATALOG', false);
    	                    };

              $t->parse('BLOCK_GLOBAL', 'BLOCK.GLOBAL', true);
            };
        };

//		$pm->_set_write_disabled(&$t);
		$t->parse("page","page");

		return $t->get("page");
}



function update_values() {
        return update_prices();
        }



function update_prices() {
		global $m, $V, $currency_names, $cmsadm;
        foreach($V as $k => $v) {
                if(preg_match("/^url_([0-9]*)/", $k, $money)) {
                        $id  = $money[1];
						$url = $v;
                        $ret = $cmsadm->update_url($id, $url);
                        if(!$ret['status']) {
                                return index('ќшибка при обновлении url: ID = '.$id);
                        }
                }
			};

        return show_edit_price('÷ены обновлены');
}



?>