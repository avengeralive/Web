<?php 
use PhpOffice\PhpWord\Autoloader;
use PhpOffice\PhpWord\Settings;
use PhpOffice\PhpWord\IOFactory;

error_reporting(E_ALL);
define('CLI', (PHP_SAPI == 'cli') ? true : false);
define('EOL', CLI ? PHP_EOL : '<br />');
define('SCRIPT_FILENAME', basename($_SERVER['SCRIPT_FILENAME'], '.php'));
define('IS_INDEX', SCRIPT_FILENAME == 'index');

//var_dump(getcwd());
require_once '../vendor/PhpWord/Autoloader.php';
Autoloader::register();
Settings::loadConfig();

// Set writers
$writers = array('Word2007' => 'docx', 'ODText' => 'odt', 'RTF' => 'rtf', 'HTML' => 'html', 'PDF' => 'pdf');

$phpWord = new \PhpOffice\PhpWord\PhpWord();
$document = $phpWord->loadTemplate('/var/www/lvse/app/docTemplates/vet5_1.docx');
$document->setValue('org_type', $org_type);
$document->setValue('org_name', $org_name);
$document->setValue('date_from', $date_from);
$document->setValue('date_to', $date_to);
$document->setValue('signer_job', $signer_job);
$document->setValue('signer_name', $signer_name);

$document->cloneRow('animals_production_name', count($other_animals));
$animals_sum = 0;
for ($i=0;$i<count($other_animals);$i++)
{	
	$document->setValue('animals_production_name#'.($i+1), $other_animals[$i]['Production']['name']);
	$document->setValue('animals_count#'.($i+1), $other_animals[$i][0]['count']);
	$animals_sum+=$other_animals[$i][0]['count'];
}
$document->setValue('animals_sum', $animals_sum);

$document->cloneRow('birds_production_name', count($other_birds));
$birds_sum = 0;
for ($i=0;$i<count($other_birds);$i++)
{	
	$document->setValue('birds_production_name#'.($i+1), $other_birds[$i]['Production']['name']);
	$document->setValue('birds_count#'.($i+1), $other_birds[$i][0]['count']);
	$birds_sum+=$other_birds[$i][0]['count'];
}
$document->setValue('birds_sum', $birds_sum);

//pr($other_animals);
//pr($other_birds);


$file = 'Приложение 1 5-вет.docx';
$document->saveAs($file);
header("Content-Description: File Transfer");
header('Content-Disposition: attachment; filename="' . $file . '"');
header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
header('Content-Transfer-Encoding: binary');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Expires: 0');
readfile($file);
unlink($file);

?>