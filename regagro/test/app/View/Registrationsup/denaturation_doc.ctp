<?php 

$file = 'Акт денатурации.doc';
header("Content-Description: File Transfer");
header('Content-Disposition: attachment; filename="' . $file . '"');
header('Content-Type: application/vnd.ms-word');
header('Content-Transfer-Encoding: binary');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Expires: 0');

$body = file_get_contents(APP.'/docTemplates/denaturation/body.xml');
$top = file_get_contents(APP.'/docTemplates/denaturation/top.xml');
$table = file_get_contents(APP.'/docTemplates/denaturation/table.xml');
$bottom = file_get_contents(APP.'/docTemplates/denaturation/bottom.xml');

$production_type_row = file_get_contents(APP.'docTemplates/denaturation/production_type_row.xml');
$production_type_total_row = file_get_contents(APP.'docTemplates/denaturation/production_type_total_row.xml');
$expertise_row = file_get_contents(APP.'docTemplates/denaturation/expertise_row.xml');
$total_row = file_get_contents(APP.'docTemplates/denaturation/total_row.xml');

$top = str_replace('${registration_date}', date_format(date_create($date),'d.m.Y'), $top);
$top = str_replace('${institution_name}', $lab['Institution']['name'], $top);
$top = str_replace('${lab_name}', $user['Lab']['name'], $top);
$top = str_replace('${lab_market_name}', $user['Lab']['market_name'], $top);
$top = str_replace('${job_name}', isset($user['job'])?$user['job']:'', $top);
$top = str_replace('${user_displayname}', $user['displayname'], $top);
$top = str_replace('${denaturation_action}', $denaturation_action, $top);
$top = str_replace('${production_type}', $production_type, $top);
$bottom = str_replace('${job_name}', isset($user['job'])?$user['job']:'', $bottom);
$bottom = str_replace('${user_displayname}', $user['displayname'], $bottom);

$iteration = '';
$currow = '';
$prev_production_type = '';
$total_weight = 0;
$production_type_total = 0;

foreach ($expertises as $index => $row)
{	
	if ($prev_production_type!=$row['Production']['ProductionType']['name']) {
		$currow = $production_type_row;
		if ($prev_production_type!='')
		{
			$currow = $production_type_total_row . $currow;
			$currow = str_replace('${production_type_total}', $production_type_total, $currow);
		}
		$production_type_total = 0;
	} else {
		$currow = $expertise_row;
	}
	$production_type_total += $row['Expertise']['samples_weight'];
	$total_weight += $row['Expertise']['samples_weight'];
	$currow = str_replace('${production_type_name}', $row['Production']['ProductionType']['name'], $currow);
	$currow = str_replace('${expertise_num}', $row['Registration']['code'].'/'.$row['Expertise']['num'], $currow);
	$currow = str_replace('${production_name}', $row['Production']['name'], $currow);
	$currow = str_replace('${samples_weight}', $row['Expertise']['samples_weight'], $currow);
	
	if($index==count($expertises)-1)
	{
		$currow .= $production_type_total_row;
		$currow = str_replace('${production_type_total}', $production_type_total, $currow);
	}	
	
	$iteration.= $currow;
	$prev_production_type = $row['Production']['ProductionType']['name'];
}

$total_row = str_replace('${total_weight}',$total_weight,$total_row);
$iteration = $iteration . $total_row;

$table = str_replace('${iteration}',$iteration,$table);

$bottom = str_replace('${total_weight}',$total_weight, $bottom);

echo str_replace('${body}', $top.$table.$bottom, $body);

/*return;
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
$document = $phpWord->loadTemplate(APP.'/docTemplates/denaturation.docx');

$document->setValue('registration_date', date_format(date_create($date),'d.m.Y'));
$document->setValue('institution_name', $lab['Institution']['name']);
$document->setValue('lab_name', $user['Lab']['name']);
$document->setValue('lab_market_name', $user['Lab']['market_name']);
$document->setValue('job_name', isset($user['job'])?$user['job']:'');
$document->setValue('user_displayname', $user['displayname']);
$document->setValue('denaturation_action', $denaturation_action);
$document->setValue('production_type', $production_type);

$document->cloneRow('expertise_num', count($expertises));
$total_weight = 0;
for ($i=0;$i<count($expertises);$i++)
{	
	$document->setValue('expertise_num#'.($i+1), $expertises[$i]['Registration']['code'].'/'.$expertises[$i]['Expertise']['num']);
	$document->setValue('production_name#'.($i+1), $expertises[$i]['Production']['name']);
	$document->setValue('samples_weight#'.($i+1), $expertises[$i]['Expertise']['samples_weight']);
	$total_weight+=(float)$expertises[$i]['Expertise']['samples_weight'];
}
$document->setValue('total_weight', $total_weight);
//echo $document->documentXML;

$file = 'Акт денатурации.docx';
$document->saveAs($file);
header("Content-Description: File Transfer");
header('Content-Disposition: attachment; filename="' . $file . '"');
header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
header('Content-Transfer-Encoding: binary');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Expires: 0');
readfile($file);
unlink($file);*/
?>