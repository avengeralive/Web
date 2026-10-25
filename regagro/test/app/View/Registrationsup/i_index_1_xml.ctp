<?php 
$file = 'Аналитический отчет 1.doc';
header("Content-Description: File Transfer");
header('Content-Disposition: attachment; filename="' . $file . '"');
header('Content-Type: application/vnd.ms-word');
header('Content-Transfer-Encoding: binary');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Expires: 0');

$body = file_get_contents(APP.'/docTemplates/indexi/body.xml');
$top = file_get_contents(APP.'/docTemplates/indexi/top.xml');
$bottom = file_get_contents(APP.'/docTemplates/indexi/bottom.xml');
$table = file_get_contents(APP.'/docTemplates/indexi/i1/table.xml');

$detection_row = file_get_contents(APP.'/docTemplates/indexi/i1/detection_row.xml');
$report_detection_row = file_get_contents(APP.'/docTemplates/indexi/i1/report_detection_row.xml');
$report_detection_total_row = file_get_contents(APP.'/docTemplates/indexi/i1/report_detection_total_row.xml');
$production_type_row = file_get_contents(APP.'/docTemplates/indexi/i1/production_type_row.xml');
$production_type_total_row = file_get_contents(APP.'/docTemplates/indexi/i1/production_type_total_row.xml');
$report_production_row = file_get_contents(APP.'/docTemplates/indexi/i1/report_production_row.xml');
$report_production_total_row = file_get_contents(APP.'/docTemplates/indexi/i1/report_production_total_row.xml');

$top = str_replace('${date_from}', date_format(date_create($date_from),'d.m.Y'), $top);
$top = str_replace('${date_to}', date_format(date_create($date_to),'d.m.Y'), $top);
$top = str_replace('${institution_name}', $institution_name, $top);
$top = str_replace('${org_type}', $org_type, $top);
$top = str_replace('${org_name}', $org_name, $top);
$top = str_replace('${title_line_1}','ИНФОРМАЦИЯ',$top);
$top = str_replace('${title_line_2}','О ВЫЯВЛЕННЫХ БОЛЕЗНЯХ И НЕСООТВЕТСТВИЯХ ТРЕБОВАНИЯМ КАЧЕСТВА И БЕЗОПАСНОСТИ',$top);
$bottom = str_replace('${signer_job}', $signer_job, $bottom);
$bottom = str_replace('${signer_name}', $signer_name, $bottom);

$iteration = '';

$prev_report_production = '';
$prev_production_type = '';
$prev_report_detection = '';
$prev_detection = '';
$report_detection_total = 0;
$production_type_total = 0;
$report_production_total = 0;
$total = 0;
foreach ($data as $index => $row)
{
	if ($prev_report_production!=$row['ReportProduction']['name'])
	{
		$currow = $report_production_row;
		if ($prev_report_production!='')
		{
			$currow = $report_detection_total_row . $production_type_total_row . $report_production_total_row . $currow;
			$currow = str_replace('${report_production_total}', $report_production_total, $currow);
			$currow = str_replace('${production_type_total}', $production_type_total, $currow);
			$currow = str_replace('${report_detection_total}', $report_detection_total, $currow);
		}
		$report_detection_total = 0;
		$production_type_total = 0;
		$report_production_total = 0;
	} else {
		if ($prev_production_type != $row['ProductionType']['name'])
		{
			$currow = $production_type_row;
			$currow	= $report_detection_total_row . $production_type_total_row . $currow;
			$currow = str_replace('${production_type_total}', $production_type_total, $currow);
			$currow = str_replace('${report_detection_total}', $report_detection_total, $currow);
			$report_detection_total = 0;
			$production_type_total = 0;
		} else {
			if ($prev_report_detection != $row['ReportDetection']['name'])
			{
				$currow = $report_detection_row;
				$currow = $report_detection_total_row . $currow;
				$currow = str_replace('${report_detection_total}', $report_detection_total, $currow);
				$report_detection_total = 0;
			} else {
				if ($prev_detection != $row['Detection']['name'])
				{
					$currow = $detection_row;
				}
			}
		}
	}
	$report_detection_total += (int)$row[0]['count'];
	$production_type_total += (int)$row[0]['count'];
	$report_production_total += (int)$row[0]['count'];
	$total += (int)$row[0]['count'];
	
	$currow = str_replace('${report_production_name}', $row['ReportProduction']['name'], $currow);
	$currow = str_replace('${production_type_name}', $row['ProductionType']['name'], $currow);
	$currow = str_replace('${report_detection_name}', $row['ReportDetection']['name'], $currow);
	$currow = str_replace('${detection_name}', $row['Detection']['name'], $currow);
	$currow = str_replace('${expertise_count}', $row[0]['count'], $currow);
	
	if($index==count($data)-1)
	{
		$currow .= $report_detection_total_row . $production_type_total_row . $report_production_total_row;
		$currow = str_replace('${report_production_total}', $report_production_total, $currow);
		$currow = str_replace('${production_type_total}', $production_type_total, $currow);
		$currow = str_replace('${report_detection_total}', $report_detection_total, $currow);
	}	
	
	$iteration.= $currow;
	$prev_report_production = $row['ReportProduction']['name'];
	$prev_production_type = $row['ProductionType']['name'];
	$prev_report_detection = $row['ReportDetection']['name'];
	$prev_detection = $row['Detection']['name'];
}

$table = str_replace('${total}',$total,$table);
$table = str_replace('${iteration}',$iteration,$table);

echo str_replace('${body}', $top.$table.$bottom, $body);
?>