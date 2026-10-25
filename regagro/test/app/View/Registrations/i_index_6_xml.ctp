<?php 
//pr($data);

$file = 'Аналитический отчет 6.doc';
header("Content-Description: File Transfer");
header('Content-Disposition: attachment; filename="' . $file . '"');
header('Content-Type: application/vnd.ms-word');
header('Content-Transfer-Encoding: binary');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Expires: 0');

define("PERCENT_DECIMALS", 0);

$body = file_get_contents(APP.'/docTemplates/indexi/i6/body.xml');
$top = file_get_contents(APP.'/docTemplates/indexi/top.xml');
$bottom = file_get_contents(APP.'/docTemplates/indexi/bottom.xml');
$page_break = file_get_contents(APP.'/docTemplates/indexi/page_break.xml');

$top = str_replace('${date_from}', date_format(date_create($date_from),'d.m.Y'), $top);
$top = str_replace('${date_to}', date_format(date_create($date_to),'d.m.Y'), $top);
$top = str_replace('${institution_name}', $institution_name, $top);
$top = str_replace('${org_type}', $org_type, $top);
$top = str_replace('${org_name}', $org_name, $top);
$top = str_replace('${title_line_1}','СРАВНИТЕЛЬНЫЕ ДАННЫЕ',$top);
$top = str_replace('${title_line_2}','ПО РЕЗУЛЬТАТАМ ПРОВЕДЕНИЯ ЭКСПЕРТИЗЫ СОТРУДНИКАМИ ЛАБОРАТОРИИ',$top);
$bottom = str_replace('${signer_job}', $signer_job, $bottom);
$bottom = str_replace('${signer_name}', $signer_name, $bottom);

$table = file_get_contents(APP.'/docTemplates/indexi/i6/table.xml');
	
$detection_type_row = file_get_contents(APP.'/docTemplates/indexi/i6/detection_type_row.xml');	
$report_production_row = file_get_contents(APP.'/docTemplates/indexi/i6/report_production_row.xml');	
$report_production_total_row = file_get_contents(APP.'/docTemplates/indexi/i6/report_production_total_row.xml');
$production_type_row = file_get_contents(APP.'/docTemplates/indexi/i6/production_type_row.xml');
$production_type_total_row = file_get_contents(APP.'/docTemplates/indexi/i6/production_type_total_row.xml');
$user_row = file_get_contents(APP.'/docTemplates/indexi/i6/user_row.xml');

$iteration = '';

$prev_detection_type = '';
$prev_report_production = '';
$prev_production_type = '';
$prev_user = '';

$report_production_total = 0;
$production_type_total = 0;
$total = 0;

foreach ($data as $index => $row)
{
	if ($prev_detection_type!=$row['DetectionType']['name'])
	{
		$currow = $detection_type_row;
		if ($prev_detection_type!='')
		{
			$currow = $production_type_total_row . $report_production_total_row . $currow;
			$currow = str_replace('${report_production_total}', $report_production_total, $currow);
			$currow = str_replace('${report_production_percent_total}', number_format($report_production_total/$data[$index-1]['Expertise']['count_sum']*100,PERCENT_DECIMALS), $currow);
			$currow = str_replace('${production_type_total}', $production_type_total, $currow);
			$currow = str_replace('${production_type_percent_total}', number_format($production_type_total/$data[$index-1]['Expertise']['count_sum']*100,PERCENT_DECIMALS), $currow);
		}
		$report_production_total = 0;
		$production_type_total = 0;
 	} else {
		if ($prev_report_production != $row['ReportProduction']['name'])
		{
			$currow = $report_production_row;
			$currow = $production_type_total_row . $report_production_total_row . $currow;
			$currow = str_replace('${report_production_total}', $report_production_total, $currow);
			$currow = str_replace('${report_production_percent_total}', number_format($report_production_total/$row['Expertise']['count_sum']*100,PERCENT_DECIMALS), $currow);
			$currow = str_replace('${production_type_total}', $production_type_total, $currow);
			$currow = str_replace('${production_type_percent_total}', number_format($production_type_total/$row['Expertise']['count_sum']*100,PERCENT_DECIMALS), $currow);
			$report_production_total = 0;
			$production_type_total = 0;
		} else {
			if($prev_production_type != $row['ProductionType']['name'])
			{
				$currow = $production_type_row;
				$currow = $production_type_total_row . $currow;
				$currow = str_replace('${production_type_total}', $production_type_total, $currow);
				$currow = str_replace('${production_type_percent_total}', number_format($production_type_total/$row['Expertise']['count_sum']*100,PERCENT_DECIMALS), $currow);
				$production_type_total = 0;
			} else {
				if ($prev_user!=$row['User']['displayname'])
				{
					$currow = $user_row;
				}
			}
		}
	}
	$report_production_total += $row['Expertise']['count'];
	$production_type_total += $row['Expertise']['count'];
	$total += $row['Expertise']['count'];

	$currow = str_replace('${detection_type_name}', $row['DetectionType']['name'], $currow);
	$currow = str_replace('${report_production_name}', $row['ReportProduction']['name'], $currow);
	$currow = str_replace('${production_type_name}', $row['ProductionType']['name'], $currow);
	$currow = str_replace('${user_displayname}', $row['User']['displayname'], $currow);
	$currow = str_replace('${expertise_count}', $row['Expertise']['count'], $currow);
	$currow = str_replace('${expertise_count_sum}', $row['Expertise']['count_sum'], $currow);
	$currow = str_replace('${percent}', number_format($row['Expertise']['count']/$row['Expertise']['count_sum']*100,PERCENT_DECIMALS), $currow);
	
	if($index==count($data)-1)
	{
		$currow .= $production_type_total_row . $report_production_total_row;
		$currow = str_replace('${report_production_total}', $report_production_total, $currow);
		$currow = str_replace('${report_production_percent_total}', number_format($report_production_total/$row['Expertise']['count_sum']*100,PERCENT_DECIMALS), $currow);
		$currow = str_replace('${production_type_total}', $production_type_total, $currow);
		$currow = str_replace('${production_type_percent_total}', number_format($production_type_total/$row['Expertise']['count_sum']*100,PERCENT_DECIMALS), $currow);
	}
	
	$iteration.= $currow;
	$prev_detection_type = $row['DetectionType']['name'];
	$prev_report_production = $row['ReportProduction']['name'];
	$prev_production_type = $row['ProductionType']['name'];
	$prev_user = $row['User']['displayname'];
}
			
//$table = str_replace('${total}',$total,$table);
$table = str_replace('${iteration}', $iteration, $table);

echo str_replace('${body}', $top
								.$table
							.$bottom, $body);
?>