<?

require_once('../_settings/settings.php');
require_once(CLASSES_BASE.'class_ice_error_handler.php');
require_once(CLASSES_BASE.'class_ice_templates.php');
require_once(CLASSES_BASE.'class_ice_mysql.php');
require_once(CLASSES_BASE.'class_ice_cache.php');
require_once(CLASSES_BASE.'class_permission_manager.php');
require_once(CLASSES_BASE.'model_money_currency.php');
require_once(CLASSES_BASE.'admin_icms.php');
require_once(CLASSES_BASE.'class_ice_excel.php');



$currency_names = array(
	'0'=>'unset',
	'1'=>'usd',
	'2'=>'euro',
	'3'=>'rur',
	'4'=>'frank'
	);
$currency_names_back = array(
	'unset'=>0,
	'usd'=>1,
	'euro'=>2,
	'rur'=>3,
	'frank'=>4
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
	"4" => "#ccccff",
	"5" => "#ffffcc"
	);

//$m = new ice_mysql();
//$m_money = new model_money_currency($m, MYSQL_DB);
//$cmsadm = new cms_admin(&$m, MYSQL_DB.'.tree', MYSQL_DB.'.docs',MYSQL_DB.'.params', DOCUMENT_TEMPLATES_ADMIN);
$m = new ice_mysql();
$cmsadm = new admin_icms(&$m);
$m_money = new model_money_currency($m, MYSQL_DB);


$pm = new permission_manager($m, MYSQL_DB);
if (!$pm->checkLogged()){
	// добавить в лог что кто то логинился...
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
	echo "Обработчик для $ID не существует.";
	exit();
	};

ice_cache::no_cache($html, true);
exit();


//========================================================================================================//




function index($error = '') {
		global $m, $pm, $V, $bgcolors, $currency_names, $cmsadm;
		$cbgcolor = 0;

//		$obj = $cmsadm->get_tree(ID_CATALOG);
		$obj = $cmsadm->get_tree_only(ID_CATALOG, 1,3, "'payor_folder_catalog','payor_folder_catalog_2','payor_folder_catalog_1'");
//alid($obj);
		$t = new ice_templates();
		$t->set_file("page", DOCUMENT_TEMPLATES_ADMIN_INDEX."edit_names/index.html" );
		$t->set_var('HTTPS_BASE_ADMIN',  HTTPS_BASE_ADMIN);
		$t->set_var('HTTPS_BASE_ADMIN_IMAGES',  HTTPS_BASE_ADMIN_IMAGES);
//		$t->set_var('ERROR',   isset($V['error'])? htmlspecialchars($V['error']):'' );
		$t->set_var('ERROR',    htmlspecialchars($error) );

		$t->set_block('page', 'BLOCK.GLOBAL', 'BLOCK_GLOBAL');
		$t->set_block('BLOCK.GLOBAL', 'BLOCK.PRICE', 'BLOCK_PRICE');

		$t->set_var('BLOCK_GLOBAL', '');

while(list($kk,$vv)=each($obj['catalog'])) {
								$distr = getdistr($vv['url']);
                				$t->set_var('stat',  (0+$distr['cc']));
								echo " <!-- ".$vv['url']." ---> \r\n"; flush();

                			    $cbgcolor = intval(!($cbgcolor));
								if ($vv['status']!='active'){
	                                $t->set_var('bgcolor', $bgcolors[	5	]);
									}
								elseif ($vv['currentlevel']==1){
	                                $t->set_var('bgcolor', $bgcolors[	4	]);
									}
								elseif($vv['currentlevel']==2){
	                                $t->set_var('bgcolor', $bgcolors[	3	]);
									}
								else {
	                                $t->set_var('bgcolor', $bgcolors[	$cbgcolor	]);
									};
                				$t->set_var('id',  $vv['id']);
                				$t->set_var('name',  $vv['name']);
                				$t->set_var('url',  $cmsadm->get_cms_url($vv['type'], $vv['url']) );

								$maxdistr = 5000;
								$j=0;
								$t->set_var('BLOCK_PRICE', '');
								for($i=0;$i<=$distr['cc'];$i=$i+$maxdistr){
	                				$t->set_var('PRICE.id',  1+$j);
	                				$t->set_var('PRICE.offset',  $i);
		                        	$t->parse('BLOCK_PRICE', 'BLOCK.PRICE', true);
									$j++;
									};

                        $t->parse('BLOCK_GLOBAL', 'BLOCK.GLOBAL', true);
						};

 //          }

//		$pm->_set_write_disabled(&$t);
		$t->parse("page","page");
		return $t->get("page");
}


function getdistr($url){
	global $m;
	//установленные
	$q = 
	"select  count(*) as cc from tree  where tree.type = 'payor_folder_catalog_item_card' and tree.url like '#url#%' ";

    $o = $m->selectOneRow($q, __FILE__, __LINE__, Array(
//		'mp'=>$mp
		'url'=>$url
		));
//	alid($o);
	return $o;
	}











function importxls(){
global $m, $adm,$cmsadm, $HTTP_POST_FILES;


// залить
//alid($HTTP_POST_FILES);
if (is_uploaded_file($HTTP_POST_FILES['file']['tmp_name'])) {
$fname = 'imported-excel.'.date('Ymd-His').md5(rand()).'.xls';
$s = upload_file(
				$HTTP_POST_FILES ['file']['tmp_name'],
				ROOT_UPLOADS,
				$fname
				);
			if (!$s) {
				return index('Ошибка: Не загружен файл с названиями (check rights for directory)');
//				echo "error when upload file. check rights for directory.";
//				exit();
				};
			}
else {
	return index('Ошибка: Не загружен файл с названиями.');
	};


// обработать
$ie = new ice_excel();
$result = $ie->read_file(ROOT_UPLOADS.$fname,
	array(
	1=>'id',
	2=>'image',
	3=>'article',
	4=>'name',
	5=>'fullname',
	6=>'seo_title',
	),
	2,
	true
	);

if (!(sizeof($result)>0)){
	return index('Ошибка: Файл не распознан.');
	};


//alid($result);
$error = array();
// проверим формат полученных значений
while(list($k,$v)=each($result)){
	if (
		preg_match('/^[0-9]{1,}$/', $v['id'])
		){
		//строчка
		}
//	else {
//		$error[] = $k;
//		};
	$result[$k]['article'] = trim($v['article']);
	};
//alid($result);
//exit();

if (sizeof($error)>0){
	return index('Ошибка: Файл не распознан в строках '.implode(', ',$error) );
	};

//старые значения
$ids =  array();
reset($result);
while(list($k,$v)=each($result)){
	if (isset($v['id']) && (strlen($v['id'])>0) ){
		$ids[] = $v['id'];
		};
	};

//alid($result);
dumptable($result);
}






function upload_file($tmp_name, $dir, $name){
	if (is_writeable($dir)) {
		$res = move_uploaded_file($tmp_name, $dir.$name);
		if (file_exists($dir."/".$name)) {
			return true;
			};
		};
	return false;
	}






function processimportfromform(){
		global $m, $V, $currency_names, $cmsadm;
//ali_debug('','','',$V);
        $document_id = $V['document_id'];
        foreach($V as $k => $v) {
                if(preg_match("/^name_([0-9]*)$/", $k, $money)) {
                        $id = $money[1];
						$name = $v;
						$fullname = $V['fullname_'.$id];
						$title = $V['seo_title_'.$id];
                        $ret = $cmsadm->raw_update_document_names($id, $name, $fullname,  $title);
                        if(!$ret['status']) {
                                return index('Ошибка при обновлении названий: ID = '.$id);
                        }
                }



                if(preg_match("/^article_([0-9]*)$/", $k, $art)) {
                        $id = $art[1];
                        $ret = $cmsadm->update($id, 'article', $v);
                        if(!$ret['status']) {
                                return index('Ошибка при обновлении артикля: ID = '.$id);
                        }
				}

                if(preg_match("/^image_([0-9]*)$/", $k, $art)) {
                        $id = $art[1];
                        $ret = $cmsadm->update($id, 'image', $v);
                        if(!$ret['status']) {
                                return index('Ошибка при обновлении изображения: ID = '.$id);
                        }
                }




        }

        return index('Названия обновлены');
	}







function dumptable($result,$cv){
	global $currency_names, $currency_names_back;
//alid($cv);
		$t = new ice_templates();
		$t->set_file("page", DOCUMENT_TEMPLATES_ADMIN_INDEX."edit_names/change_confirm.html" );
		$t->set_var('HTTPS_BASE_ADMIN',  HTTPS_BASE_ADMIN);
		$t->set_var('HTTPS_BASE_ADMIN_IMAGES',  HTTPS_BASE_ADMIN_IMAGES);
		$t->parse("page","page");
		echo $t->get("page");


echo '<table border=1 width=100%><tr><td>номер товара</td>><td>изображение</td><td>превью</td><td>артикль</td><td>название товара</td><td>полное название</td><td>title</td></tr>';
while(list($k,$v)=each($result)){
	if (strlen($v['id'])>0){
		// товара

//		$oldprice = $cp[	$v['id']	]['pvalue'];
//		$oldcurr = $currency_names [$cc[	$v['id']	]['pvalue']];
//		$changed = (   ($oldprice!=$v['price']) || ($oldcurr!=$v['currency']) || ($oldarticle!=$v['article']) )?'изменено':'&nbsp;';
//		$changed = (   ($oldarticle!=$v['article']) )?'изменено':'&nbsp;';
//		echo "===$oldarticle===".$v['article']."=== $changed<br><br>";
//		$changedbg = (   ($oldprice!=$v['price']) || $oldcurr!=$v['currency']  || ($oldarticle!=$v['article']) )?'#ccffcc':'#ffffff';
//		echo "<tr style='background-color: $changedbg'><td>$changed</td><td>".$v['id'].  "<td>".$v['article']."</td></td><td>".$v['name']."</td><td>$oldprice</td><td>$oldcurr</td><td>".$v['price']."</td><td>".$v['currency']."</td></tr>\r\n";

		$image = get_catalog_image($v['image']);

		echo "<tr><td>".$v['id'].  "</td><td>".$v['image']."</td><td><img src='$image'></td><td>".$v['article']."</td></td><td>".$v['name']."</td><td>".$v['fullname']."</td><td>".$v['seo_title']."</td></tr>\r\n";

			echo "<input type=hidden name=image_".$v['id']." value='".htmlspecialchars($v['image'])."'>\r\n";
			echo "<input type=hidden name=article_".$v['id']." value='".htmlspecialchars($v['article'])."'>\r\n";
			echo "<input type=hidden name=name_".$v['id']." value='".htmlspecialchars($v['name'])."'>\r\n";
			echo "<input type=hidden name=fullname_".$v['id']." value='".htmlspecialchars($v['fullname'])."'>\r\n";
			echo "<input type=hidden name=seo_title_".$v['id']." value='".htmlspecialchars($v['seo_title'])."'>\r\n";
		}; 
	};
echo '</table></form>';
exit();
}





function show_download_xls(){
	global $m, $pm, $V, $bgcolors, $currency_names, $cmsadm, $m_money;
    $o_money = $m_money->get_all();
	$id = $_GET['document_id'];
	$offset = $_GET['offset'];
	return get_names_for_level($id, 'edit-'.$id, $offset);
	}



function get_names_for_level($id, $name, $offset){
	ini_set('include_path', CLASSES_BASE.'PEAR/');
	require_once(CLASSES_BASE.'PEAR/Spreadsheet/Excel/Writer.php');
	$workbook = new Spreadsheet_Excel_Writer();
	prepare_xls($workbook, $id, $name, $offset);
	// sending HTTP headers
	$workbook->send('payor-names-for-edit-'.$id.'-'.date("Ymd-His").'.xls');
	$workbook->close();
	}



function prepare_xls($workbook, $id, $name, $offset){
	global $cmsadm,$currency_names;
//	$tree = $cmsadm->get_tree($id, 1,100);
	$tree = $cmsadm->get_tree_offset_names($id,5000,$offset);

//	alid($tree);
//exit();

	$worksheet =& $workbook->addWorksheet(		substr($name,0,30)		);

//	$worksheet->setColumn(0,0,80);
	$worksheet->setColumn(0,2,20);
	$worksheet->setColumn(3,4,70);
	$worksheet->setColumn(5,6,20);
	$format_header =& $workbook->addFormat();

	// our green (overwriting color on index 12)
	$workbook->setCustomColor(12, 221, 228, 230);
	$format_header =& $workbook->addFormat();
	$format_header->setFgColor(12);
//	$format_header->setBold();

	$format_txt =& $workbook->addFormat(array('Size' => 11));
	$format_n =& $workbook->addFormat(array('Size' => 11));
	$format_n->setNumFormat('0.00');

//	alid($o_money);

	$worksheet->writeString(0, 0, 'id',$format_header);
	$worksheet->writeString(0, 1, 'image',$format_header);
	$worksheet->writeString(0, 2, 'article',$format_header);
	$worksheet->writeString(0, 3, 'name',$format_header);
	$worksheet->writeString(0, 4, 'full name',$format_header);
	$worksheet->writeString(0, 5, 'title',$format_header);
	$i=1;
	while(list($k,$v)=each($tree['catalog'])){
		$i++;
		// только активные
		if ($v['status']=='active'){
				$worksheet->writeString($i, 0, $v['id'],$format_header);
				$worksheet->writeString($i, 1, (isset($v['params']['image']['pvalue'])?$v['params']['image']['pvalue']:''),$format_txt);
				$worksheet->writeString($i, 2, (isset($v['params']['article']['pvalue'])?$v['params']['article']['pvalue']:''),$format_txt);
				$worksheet->writeString($i, 3, $v['name'],$format_txt);
				$worksheet->writeString($i, 4, $v['fullname'],$format_txt);
				$worksheet->writeString($i, 5, $v['seo_title'],$format_txt);
				};
		};
	}


function get_catalog_image($value){
	return (file_exists(
		ROOT_PUBLIC_IMAGES_CATALOG.$value
		) && is_file(ROOT_PUBLIC_IMAGES_CATALOG.$value))
		?
		HTTP_BASE.'/ii/catalog/'.rawurlencode($value)
		:
		'';
	}
?>