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
if ($type==0)
{
	$path = APP.'/docTemplates/distributor.docx';
} else {
	$path = APP.'/docTemplates/distributor1.docx';
}
$document = $phpWord->loadTemplate($path);
$document->setValue('date', date('d.m.Y'));
//$document->setValue('time', date('H:i'));
$document->setValue('time', '');
$document->setValue('distribution_distributor', $name);
$document->setValue('registration_code', $registration['Registration']['code']);
$document->setValue('lab_name', $registration['Lab']['name']);
$document->setValue('job_name', isset($registration['User']['job'])?$registration['User']['job']:'');
$document->setValue('user_displayname', $registration['User']['displayname']);
$notes='';
$distributions = $registration['Distribution'];
$document->cloneRow('production_name', count($distributions));
for ($i=0;$i<count($distributions);$i++)
{	
	$document->setValue('production_name#'.($i+1), $distributions[$i]['Production']['name']);
	$document->setValue('distribution_count#'.($i+1), $distributions[$i]['count']);
	$document->setValue('distribution_weight#'.($i+1), $distributions[$i]['weight']);
	$document->setValue('distribution_places#'.($i+1), $distributions[$i]['places']);
	$notes.= $distributions[$i]['note'];
	if ($i!=count($distributions)-1)
	{
		$notes.=', ';
	}
}

$document->setValue('note', $notes);

$file = 'Заключение торгующему.docx';
$document->saveAs($file);
header("Content-Description: File Transfer");
header('Content-Disposition: attachment; filename="' . $file . '"');
header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
header('Content-Transfer-Encoding: binary');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Expires: 0');
readfile($file);
unlink($file);
// $xmlWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
// $xmlWriter->save("php://output");
} catch (Exception $e)
{
	echo 'Выброшено исключение: ',  $e->getMessage(), "\n";
}
?>