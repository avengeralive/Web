<?php 
use PhpOffice\PhpWord\Autoloader;
use PhpOffice\PhpWord\Settings;
use PhpOffice\PhpWord\IOFactory;

error_reporting(E_ALL);
define('CLI', (PHP_SAPI == 'cli') ? true : false);
define('EOL', CLI ? PHP_EOL : '<br />');
define('SCRIPT_FILENAME', basename($_SERVER['SCRIPT_FILENAME'], '.php'));
define('IS_INDEX', SCRIPT_FILENAME == 'index');

require_once __DIR__ . '../../../Vendor/PhpWord/Autoloader.php';
Autoloader::register();
Settings::loadConfig();

// Set writers
$writers = array('Word2007' => 'docx', 'ODText' => 'odt', 'RTF' => 'rtf', 'HTML' => 'html', 'PDF' => 'pdf');

$phpWord = new \PhpOffice\PhpWord\PhpWord();
$document = $phpWord->loadTemplate(APP.'/docTemplates/daily_registrations.docx');
//$document->cloneBlock('registration_iterator', 1);
$document->cloneBlock('production_type_block', 3);
//$document->deleteBlock('type_block');
//$document->cloneRow('registration_code_1', 3);
// $file = 'Журнал учета.docx';
// $document->saveAs($file);
// header("Content-Description: File Transfer");
// header('Content-Disposition: attachment; filename="' . $file . '"');
// header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
// header('Content-Transfer-Encoding: binary');
// header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
// header('Expires: 0');
// readfile($file);
// unlink($file);

?>