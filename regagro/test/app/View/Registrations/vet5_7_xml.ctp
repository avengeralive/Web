<?php 
$file = 'Приложение 7 5-вет.doc';
header("Content-Description: File Transfer");
header('Content-Disposition: attachment; filename="' . $file . '"');
header('Content-Type: application/vnd.ms-word');
header('Content-Transfer-Encoding: binary');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Expires: 0');

$body = file_get_contents(APP.'/docTemplates/vet5/body.xml');
$addendum_top = file_get_contents(APP.'/docTemplates/vet5/addendum_top.xml');
$addendum_bottom = file_get_contents(APP.'/docTemplates/vet5/addendum_bottom.xml');
$title = file_get_contents(APP.'/docTemplates/vet5/addendum7/title.xml');
$table = file_get_contents(APP.'/docTemplates/vet5/addendum7/table.xml');

$production_row = file_get_contents(APP.'/docTemplates/vet5/addendum3/production_row.xml');
$production_total_row = file_get_contents(APP.'/docTemplates/vet5/addendum3/production_total_row.xml');
$report_detection_row = file_get_contents(APP.'/docTemplates/vet5/addendum3/report_detection_row.xml');
$detection_row = file_get_contents(APP.'/docTemplates/vet5/addendum3/detection_row.xml');
$detection_total_row = file_get_contents(APP.'/docTemplates/vet5/addendum3/detection_total_row.xml');

$addendum_top = str_replace('${addendum_num}', '7', $addendum_top);
$addendum_top = str_replace('${date_from}',  $date_from, $addendum_top);
$addendum_top = str_replace('${date_to}',  $date_to, $addendum_top);
$addendum_top = str_replace('${org_type}', $org_type, $addendum_top);
$addendum_top = str_replace('${org_name}', $org_name, $addendum_top);
$addendum_bottom = str_replace('${signer_job}', $signer_job, $addendum_bottom);
$addendum_bottom = str_replace('${signer_name}', $signer_name, $addendum_bottom);

$iteration = '';

$prev_report_production = '';
$prev_report_detection = '';
$prev_detection = '';
$detection_total = 0;
$production_total = 0;
$total = 0;
foreach ($data as $index => $row)
{
	if ($prev_report_production!=$row[0]['production_name'])
	{
		$currow = $production_row;
		if ($prev_report_production!='')
		{
			$currow = $detection_total_row . $production_total_row . $currow;
			$currow = str_replace('${production_total}', $production_total, $currow);
			$currow = str_replace('${report_detection_total}', $detection_total, $currow);
		}
		$production_total = 0;
		$detection_total = 0;
	} else {
		if ($prev_report_detection != $row['ReportDetection']['name'])
		{
			$currow = $report_detection_row;
			$currow = $detection_total_row . $currow;
			$currow = str_replace('${report_detection_total}', $detection_total, $currow);
			$detection_total = 0;
		} else {
			if ($prev_detection != $row['Detection']['name'])
			{
				$currow = $detection_row;
			}
		}
	}
	$detection_total += (int)$row[0]['count'];
	$production_total += (int)$row[0]['count'];
	$total += (int)$row[0]['count'];
	$currow = str_replace('${report_production_name}', $row[0]['production_name'], $currow);
	$currow = str_replace('${report_detection_name}', $row['ReportDetection']['name'], $currow);
	$currow = str_replace('${detection_name}', $row['Detection']['name'], $currow);
	$currow = str_replace('${expertise_count}', $row[0]['count'], $currow);
	
	if($index==count($data)-1)
	{
		$currow .= $detection_total_row . $production_total_row;
		$currow = str_replace('${production_total}', $production_total, $currow);
		$currow = str_replace('${report_detection_total}', $detection_total, $currow);
	}	
	
	$iteration.= $currow;
	$prev_report_production = $row[0]['production_name'];
	$prev_report_detection = $row['ReportDetection']['name'];
	$prev_detection = $row['Detection']['name'];
}

$table = str_replace('${total}',$total,$table);
$table = str_replace('${iteration}',$iteration,$table);

echo str_replace('${body}', $addendum_top.$title.$table.$addendum_bottom, $body);
?>