<?
require ('adm_explorer_setting.php');
//require ('class-ali_error_handler.php');
require ('class_ali_explorer.php');
require ('class_view_ali_explorer.php');
require ('class_ali_dir.php');
require ('class_ali_templates.php');
require ('zip.php');
require ('ali_explorer_plugins.php');

define('PME_OK', 'OK');
define('PME_ERROR', 'ERROR');
define('PME_COLOR_OK','#99ff99');
define('PME_COLOR_ERROR','#ff99ff');
define('PME_FUNCTION_EXISTS', 'ф-ия существует');
define('PME_FUNCTION_UNKNOWN', 'ф-ия отключена');
define('PME_CONSTANT_EXISTS', 'константа существует');
define('PME_CONSTANT_UNKNOWN', 'константа не опредлена');

$need = Array(
	array(
		'type'=>'constant',
		'name'=>'PHP_VERSION'
		),
	array(
		'type'=>'constant',
		'name'=>'PHP_OS'
		),
	array(
		'type'=>'constant',
		'name'=>'PME_VERSION',
		'error'=>'Ошибка в настройках!'
		),
	array(
		'type'=>'constant',
		'name'=>'PME_WWW',
		'error'=>'Ошибка в настройках!'
		),
	array(
		'type'=>'constant',
		'name'=>'PME_FOLDER_ROOT',
		'error'=>'Ошибка в настройках!'
		),
	array(
		'type'=>'function',
		'name'=>'phpinfo',
		'error'=>'Не сможем посмотреть настройки :)'
		),
	array(
		'type'=>'function',
		'name'=>'is_uploaded_file',
		'error'=>'Недоступна заливка файлов на сервер.'
		),
	array(
		'type'=>'function',
		'name'=>'move_uploaded_file',
		'error'=>'Недоступна заливка файлов на сервер.'
		),
	array(
		'type'=>'function',
		'name'=>'posix_getuid',
		'error'=>'Модуль &quot;<a href=http://php.net/POSIX>POSIX</a>&quot; не подключен. Читайте мануал как подключить. Требуется для определения под каким пользователем запущен сервер.'
		),
	array(
		'type'=>'function',
		'name'=>'gzcompress',
		'error'=>'Модуль &quot;<a href=http://php.net/zlib>Zlib</a>&quot; не подключен. Читайте мануал как подключить. Возможность создать и скачать ZIP файл отключена.'
		),
	array(
		'type'=>'function',
		'name'=>'preg_match',
		'error'=>'Модуль &quot;<a href=http://php.net/pcre>PCRE</a>&quot; не подключен. Читайте мануал как подключить. Фунциональность PhpMyExplorer невозможна!'
		),
//	array(
//		'type'=>'function',
//		'name'=>'curl_exec',
//		'error'=>'Модуль &quot;<a href=http://php.net/curl>Curl</a>&quot; не подключен. Читайте мануал как подключить. (not used ..)'
//		),
	array(
		'type'=>'ini',
		'name'=>'magic_quotes_gpc',
		'ok'=>'^(false|0)?$',
		'error'=>'Включены &quot;сумасшедшие кавычки&quot;!'
		),
	array(
		'type'=>'ini',
		'name'=>'magic_quotes_runtime',
		'ok'=>'^(false|0)?$',
		'error'=>'Включены &quot;сумасшедшие кавычки&quot;!'
		),
	array(
		'type'=>'ini',
		'name'=>'magic_quotes_sybase',
		'ok'=>'^(false|0)?$',
		'error'=>'Включены &quot;сумасшедшие кавычки&quot;!'
		),
	array(
		'type'=>'ini',
		'name'=>'file_uploads',
		'ok'=>'^(true|1)$',
		'error'=>'Отключена закачка файлов на сервер!'
		),
	array(
		'type'=>'ini',
		'name'=>'disable_dunctions',
		'ok'=>'^$'
		),
	array(
		'type'=>'ini',
		'name'=>'safe_mode',
		'ok'=>'^(false|0)?$',
		'error'=>'ПХП запущен в safe-mode, проверьте список доступных фукций и наложенных ограничений.'
		),
	);

function check($v){
switch ($v['type']) {
	case "function":
		if (function_exists($v['name'])) {
			return array($v['type'], $v['name'], PME_FUNCTION_EXISTS, PME_COLOR_OK, PME_OK);
			}
		else {
			return array($v['type'], $v['name'], PME_FUNCTION_UNKNOWN, PME_COLOR_ERROR, isset($v['error'])? $v['error'] : PME_ERROR);
			};
		break;
	case "constant":
		if (defined($v['name'])) {
			return array($v['type'], $v['name'], constant($v['name']), PME_COLOR_OK, PME_OK);
			}
		else {
			return array($v['type'], $v['name'], PME_CONSTANT_UNKNOWN, PME_COLOR_ERROR, isset($v['error'])? $v['error'] : PME_ERROR);
			};
		break;
	case "ini":
		$vv = "".(string)ini_get($v['name']);
		if (eregi( $v['ok'], $vv, $yy)) {
			return array($v['type'], $v['name'], $vv, PME_COLOR_OK, PME_OK);
			}
		else {
			return array($v['type'], $v['name'], $vv, PME_COLOR_ERROR, isset($v['error'])? $v['error'] : PME_ERROR);
			};
		break;
	};
	return array($v['type'], $v['name'], PME_ERROR, PME_COLOR_ERROR, PME_ERROR);
	}


$html = "";
while (list(,$v) = each ($need)) {
	list($type, $name, $value, $color, $message) = check($v);
	$html .= "<tr><td>$type</td><td>$name</td><td>$value</td><td bgcolor=$color>$message</td></tr>\n";
	};


$html .= "<tr><td colspan=4 bgcolor=#FFFFFF>PME_Plugins</td></tr>\n";
$m = ali_explorer::get_plugins();
while (list(,$v) = each ($m)) {
	$html .= "<tr><td colspan=3>&nbsp;</td><td>$v</td></tr>\n";
	};


$t = new ali_templates('settings.html');
$html = $t->parse(array('PME_WWW', 'html'),array(PME_WWW, $html));
header("Content-length: ".strlen($html));
echo $html;
?>