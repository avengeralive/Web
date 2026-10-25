<?php
use PhpOffice\PhpWord\Autoloader;
use PhpOffice\PhpWord\Settings;
use PhpOffice\PhpWord\IOFactory;

$this->Doc->catchAll();

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

$samplePurposes = implode(', ', Hash::extract($sample['SamplePurpose'], '{n}.name'));

$document = $phpWord->loadTemplate(APP.'/docTemplates/sample_act.docx');
$document->setValue('registration_code', $registration['Registration']['code']);
$document->setValue('sample_code', $sample['Sample']['code']);
$document->setValue('registration_date', date_format(date_create($registration['Registration']['date']),'d.m.Y'));
$document->setValue('lab_name', $registration['Lab']['name']);
$document->setValue('institution_name', $institution['Institution']['name']);
$document->setValue('lab_market_name', $registration['Lab']['market_name']?$registration['Lab']['market_name']:'');
$document->setValue('lab_market_address', $registration['Lab']['market_address']?$registration['Lab']['market_address']:'');
$document->setValue('lab_phone', $registration['Lab']['phone']?$registration['Lab']['phone']:'');
$document->setValue('job_name', isset($registration['User']['job'])?$registration['User']['job']:'');
$document->setValue('user_displayname', $registration['User']['displayname']);
$document->setValue('registration_owner', $registration['Registration']['owner']);
$document->setValue('region_name', $registration['Region']['name']);
$document->setValue('district_name', $registration['District']['name']);
$document->setValue('registration_locality', $registration['Registration']['locality']);
$hasDocForm = $registration['Registration']['doc_form']!='не указано';
$document->setValue('registration_doc_date', $hasDocForm?date_format(date_create($registration['Registration']['doc_date']),'d.m.Y'):'');
$document->setValue('registration_doc_num', $hasDocForm?$registration['Registration']['doc_num']:'');
$document->setValue('registration_doc_form', $hasDocForm?$registration['Registration']['doc_form']:'н/у');
$document->setValue('production_name', $sample['Sample']['production']);
$document->setValue('sample_reason', $samplePurposes);
$document->setValue('sample_purpose_category', $sample['SamplePurpose'][0]['category']);
$document->setValue('sample_doc', $sample['Sample']['doc']);
$document->setValue('sample_control_sample', $sample['Sample']['control_sample']);
$document->setValue('sample_total_weight', $sample['Sample']['total_weight']);
$document->setValue('sample_count', $sample['Sample']['count']);
$document->setValue('sample_samples_weight', $sample['Sample']['samples_weight']);
$document->setValue('sample_mark', $sample['Sample']['mark']);
$document->setValue('sample_packages', $sample['Sample']['packages']);
$document->setValue('sample_gloves', $sample['Sample']['gloves']);
$document->setValue('sample_bottles', $sample['Sample']['bottles']);
$document->setValue('sample_containers', $sample['Sample']['containers']);
$document->setValue('sample_other', $sample['Sample']['other']);
$document->setValue('sample_auto', $sample['Sample']['auto']);
$document->setValue('sample_mark_number', $sample['Sample']['mark_number']);
if ($sample['SamplePurpose'][0]['category']!='Показания') {
	$document->setValue('organ_name', $institution['Organ']['name']);
	$document->setValue('sample_basis', $institution['Organ']['order_type'] . ', ' .
										date_format(date_create($institution['Organ']['order_date']),'d.m.Y'). ', ' .
										$institution['Organ']['order_num'] );
} else {
    $document->setValue('sample_basis', '');
	$document->setValue('organ_name', '');
}
$document->setValue('sample_date', date_format(date_create($sample['Sample']['created']),'d.m.Y'));
$document->setValue('sample_time', date_format(date_create($sample['Sample']['created']),'H:i'));
$document->setValue('receipt_date', date_format(date_create($sample['Sample']['receipt_date']),'d.m.Y'));

$file = 'Акт отбора проб.docx';
$tmpFile = $document->save();
$this->Doc->setHeaders($file);
readfile($tmpFile);
unlink($tmpFile);
?>
