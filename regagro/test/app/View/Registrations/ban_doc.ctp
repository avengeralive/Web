<?php 
use PhpOffice\PhpWord\Autoloader;
use PhpOffice\PhpWord\Settings;
use PhpOffice\PhpWord\IOFactory;

error_reporting(E_ALL);
define('CLI', (PHP_SAPI == 'cli') ? true : false);
define('EOL', CLI ? PHP_EOL : '<br />');
define('SCRIPT_FILENAME', basename($_SERVER['SCRIPT_FILENAME'], '.php'));
define('IS_INDEX', SCRIPT_FILENAME == 'index');

require_once '../vendor/PhpWord/Autoloader.php';
Autoloader::register();
Settings::loadConfig();

// Set writers
$writers = array('Word2007' => 'docx', 'ODText' => 'odt', 'RTF' => 'rtf', 'HTML' => 'html', 'PDF' => 'pdf');
try{
$phpWord = new \PhpOffice\PhpWord\PhpWord();
$document = $phpWord->loadTemplate(APP.'/docTemplates/ban.docx');
$document->setValue('today', date('d.m.Y'));
$document->setValue('lab_name', $registration['Lab']['name']);
$document->setValue('expertise_conclusion_date', date_format(date_create($registration['Expertise']['conclusion_date']),'d.m.Y'));
$document->setValue('registration_code', $registration['Registration']['code']);
$document->setValue('job_name', isset($registration['User']['job'])?$registration['User']['job']:'');
$document->setValue('user_displayname', $registration['User']['displayname']);
$document->setValue('registration_doc_form', $registration['Registration']['doc_form']);
$document->setValue('registration_doc_date', date_format(date_create($registration['Registration']['doc_date']),'d.m.Y'));
$document->setValue('registration_doc_num', $registration['Registration']['doc_num']);
$document->setValue('registration_owner', $registration['Registration']['owner']);

//$bans = $registration['Ban'];
$document->cloneRow('production_name', count($bans));
for ($i=0;$i<count($bans);$i++)
{	
	$document->setValue('production_name#'.($i+1), $bans[$i]['Production']['name']);
	$document->setValue('ban_type_name#'.($i+1), $bans[$i]['BanType']['name']);
	$document->setValue('ban_weight#'.($i+1), $bans[$i]['Ban']['weight']);
	$document->setValue('ban_reason_name#'.($i+1), $bans[$i]['BanReason']['name']);
	$document->setValue('use_order_name#'.($i+1), $bans[$i]['Ban']['use_order']);
	$document->setValue('ban_rules_item#'.($i+1), $bans[$i]['Ban']['rules_item']);
	$document->setValue('ban_note#'.($i+1), $bans[$i]['Ban']['note']);
}


$file = 'Акт выбраковки.docx';
$document->saveAs($file);
header("Content-Description: File Transfer");
header('Content-Disposition: attachment; filename="' . $file . '"');
header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
header('Content-Transfer-Encoding: binary');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Expires: 0');
readfile($file);
unlink($file);
//$xmlWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
//$xmlWriter->save("php://output");
} catch (Exception $e)
{
	echo 'Выброшено исключение: ',  $e->getMessage(), "\n";
}
?>