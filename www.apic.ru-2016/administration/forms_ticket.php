<?
set_time_limit(0);
require_once('../_settings/settings.php');
require_once(CLASSES_BASE.'class_ice_error_handler.php');
require_once(CLASSES_BASE.'class_ice_templates.php');
require_once(CLASSES_BASE.'class_ice_mysql.php');
require_once(CLASSES_BASE.'class_ice_cache.php');
require_once(CLASSES_BASE.'class_permission_manager.php');
require_once(CLASSES_BASE.'admin_icms.php');

$rights = array(
    'view'=>106,
    'edit'=>106
    );

$bgcolors = array(
    "0" => "#ffffff",
    "1" => "#f0f0f0",
    "2" => "#ffdddd",
	"3" => "#ddddff",
	"4" => "#ccccff",
	"5" => "#ffffcc"
	);

$m = new ice_mysql();

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
	global  $bgcolors, $m, $memberlogtypes;

	$ft =  $m->selectOneRow("SELECT count(*) as ticket_total FROM apic_db.clex_request ", '','',array());
	$ticket_total = $ft['ticket_total'];

	$f =  $m->selectManyRows("SELECT dt as created, count(*) as ticket_count FROM apic_db.clex_request group by created order by created DESC", '','',array());
	
		$t = new ice_templates();
		$t->set_file("page", DOCUMENT_TEMPLATES_ADMIN_INDEX."forms_ticket/index.html" );
		$t->set_var('HTTPS_BASE_ADMIN',  HTTPS_BASE_ADMIN);
		$t->set_var('HTTPS_BASE_ADMIN_IMAGES',  HTTPS_BASE_ADMIN_IMAGES);
		$t->set_var('ERROR',    htmlspecialchars($error) );

		$t->set_var('ticket_total', $ticket_total );


		$t->set_block('page', 'BLOCK.GLOBAL', 'BLOCK_GLOBAL');
		$t->set_var('BLOCK_GLOBAL', '');
	$tt = $ticket_total;
	while(list($kk,$vv)=each($f)) {
		while(list($kkk,$vvv)=each($vv)) {
			$t->set_var('id', $kk);
			$t->set_var($kkk, htmlspecialchars($vvv) );
			};
			$t->set_var('ticket_data',  $tt);
			$t->set_var('ticket_percent',  number_format( 100*$vv['ticket_count']/$ticket_total, 2,',','') );
			$t->set_var('ticket_data_percent',  number_format( 100*$tt/$ticket_total, 2,',','') );
			$tt = $tt - $vv['ticket_count'] ;
			$t->parse('BLOCK_GLOBAL', 'BLOCK.GLOBAL', true);
			};
		$t->parse("page","page");
		return $t->get("page");
}














function get_download(){
	ini_set('include_path', CLASSES_BASE.'PEAR/');
	require_once(CLASSES_BASE.'PEAR/Spreadsheet/Excel/Writer.php');
	$workbook = new Spreadsheet_Excel_Writer();
	prepare_xls($workbook);
	// sending HTTP headers
	$workbook->send('xls-'.date("Ymd-His").'.xls');
	$workbook->close();
	}

	
	
	
	
	
function get_download_csv(){
	header('content-type: text/csv');
	global $m;
	$tree =  $m->selectManyRows("SELECT * FROM apic_db.clex_request order by id DESC", '','',array());

//	alid($tree);
	$names = array(
'id',
'ФИО',
 'Компания',
 'Индекс',
 'Страна',
'Город',
'Адрес',
'Телефон',
 'Факс',
 'email',
 'Сайт',
 'Цель',
 'Как',
 'Должность',
 '',
 'hash',
'Дата',
	);
	
$out = fopen('php://output', 'w');
    header( 'Content-Type: text/csv' );
            header( 'Content-Disposition: attachment;filename=csv-'.date("Ymd-His").'.csv');
fputcsv($out, $names,";");

				

	while(list($k,$v)=each($tree) ){
		fputcsv($out, $v,";");
	};
fclose($out);
	}


	
	
	
	
	
function get_download_html(){
	global $m;
	$tree =  $m->selectManyRows("SELECT * FROM apic_db.clex_request order by id DESC ", '','',array());

//	alid($tree);
	$names = array(
'id',
'ФИО',
 'Компания',
 'Индекс',
 'Страна',
'Город',
'Адрес',
'Телефон',
 'Факс',
 'email',
 'Сайт',
 'Цель',
 'Как',
 'Должность',
 '',
 'hash',
'Дата',
	);
	

	echo "<link href=/bootstrap/css/bootstrap.min.css rel=stylesheet media=screen>";			
	echo "<table class='table table-striped' >\r\n<tr>";
	while(list($k,$v)=each($names) ){
	echo "<td>$v</td>";
	};
	echo "</tr>\r\n";

	while(list($k,$v)=each($tree) ){
	echo "<tr>";
		while(list($kk,$vv)=each($v) ){
		echo "<td>$vv</td>";
		};
	echo "</tr>\r\n";
	};
	echo "</table>\r\n";
	}
	
	
	
	
	
	
	
	
	
function prepare_xls($workbook){
	global $m;
	$tree =  $m->selectManyRows("SELECT * FROM apic_db.clex_request order by id DESC", '','',array());

//	alid($tree);
	//	id	name	company	idx	country	city	adr	phone	fax	mail	site	target	how	pos	field	hash	dt
	
	$worksheet =& $workbook->addWorksheet(		substr($name,0,30)		);
	$format_txt =& $workbook->addFormat(array('Size' => 11));
	$i=0;
				$worksheet->writeString($i, 0, 'id',$format_txt);
				$worksheet->writeString($i, 1, 'Дата',$format_txt);
				$worksheet->writeString($i, 2, 'ФИО',$format_txt);
				$worksheet->writeString($i, 3, 'Компания',$format_txt);
				$worksheet->writeString($i, 4, 'idx',$format_txt);
				$worksheet->writeString($i, 5, 'Страна',$format_txt);
				$worksheet->writeString($i, 6, 'Город',$format_txt);
				$worksheet->writeString($i, 7, 'Адрес',$format_txt);
				$worksheet->writeString($i, 8, 'Телефон',$format_txt);
				$worksheet->writeString($i, 9, 'Факс',$format_txt);
				$worksheet->writeString($i, 10, 'email',$format_txt);
				$worksheet->writeString($i, 11, 'Сайт',$format_txt);
				$worksheet->writeString($i, 12, 'Цель',$format_txt);
				$worksheet->writeString($i, 13, 'Как',$format_txt);
				$worksheet->writeString($i, 14, 'Должность',$format_txt);
				//$worksheet->writeString($i, 15, 'filed',$format_txt);
				$worksheet->writeString($i, 15, 'hash',$format_txt);


	while(list($k,$v)=each($tree) ){
	//alid($v);
		$i++;
				$worksheet->writeString($i, 0, $v['id'],$format_txt);
				$worksheet->writeString($i, 1, $v['dt'],$format_txt);
				$worksheet->writeString($i, 2, $v['name'],$format_txt);
				$worksheet->writeString($i, 3, $v['company'],$format_txt);
				$worksheet->writeString($i, 4, $v['idx'],$format_txt);
				$worksheet->writeString($i, 5, $v['country'],$format_txt);
				$worksheet->writeString($i, 6, $v['city'],$format_txt);
				$worksheet->writeString($i, 7, $v['adr'],$format_txt);
				$worksheet->writeString($i, 8, $v['phone'],$format_txt);
				$worksheet->writeString($i, 9, $v['fax'],$format_txt);
				$worksheet->writeString($i, 10, $v['mail'],$format_txt);
				$worksheet->writeString($i, 11, $v['site'],$format_txt);
				$worksheet->writeString($i, 12, $v['target'],$format_txt);
				$worksheet->writeString($i, 13, $v['how'],$format_txt);
				$worksheet->writeString($i, 14, $v['pos'],$format_txt);
				//$worksheet->writeString($i, 15, $v['filed'],$format_txt);
				$worksheet->writeString($i, 15, $v['hash'],$format_txt);
		};
	}



?>