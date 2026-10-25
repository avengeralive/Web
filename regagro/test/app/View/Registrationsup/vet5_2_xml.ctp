<?php 
$file = 'Приложение 2 5-вет.doc';
header("Content-Description: File Transfer");
header('Content-Disposition: attachment; filename="' . $file . '"');
header('Content-Type: application/vnd.ms-word');
header('Content-Transfer-Encoding: binary');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Expires: 0');

$body = file_get_contents(APP.'/docTemplates/vet5/body.xml');
$addendum_top = file_get_contents(APP.'/docTemplates/vet5/addendum_top.xml');
$addendum_bottom = file_get_contents(APP.'/docTemplates/vet5/addendum_bottom.xml');
$title = file_get_contents(APP.'/docTemplates/vet5/addendum2/title.xml');
$table = file_get_contents(APP.'/docTemplates/vet5/addendum6/table.xml');

$report_production_row = file_get_contents(APP.'/docTemplates/vet5/addendum6/report_production_row.xml');
$report_production_total_row = file_get_contents(APP.'/docTemplates/vet5/addendum6/report_production_total_row.xml');
$report_research_row = file_get_contents(APP.'/docTemplates/vet5/addendum6/report_research_row.xml');
$report_research_total_row = file_get_contents(APP.'/docTemplates/vet5/addendum6/report_research_total_row.xml');
$research_row = file_get_contents(APP.'/docTemplates/vet5/addendum6/research_row.xml');
$research_total_row = file_get_contents(APP.'/docTemplates/vet5/addendum6/research_total_row.xml');
$research_result_row = file_get_contents(APP.'/docTemplates/vet5/addendum6/research_result_row.xml');

$addendum_top = str_replace('${addendum_num}', '2', $addendum_top);
$addendum_top = str_replace('${date_from}',  $date_from, $addendum_top);
$addendum_top = str_replace('${date_to}',  $date_to, $addendum_top);
$addendum_top = str_replace('${org_type}', $org_type, $addendum_top);
$addendum_top = str_replace('${org_name}', $org_name, $addendum_top);
$addendum_bottom = str_replace('${signer_job}', $signer_job, $addendum_bottom);
$addendum_bottom = str_replace('${signer_name}', $signer_name, $addendum_bottom);

$iteration = '';

$prev_report_production = '';
$prev_report_research = '';
$prev_research = '';
$prev_research_result = '';
$report_production_total = 0;
$report_research_total = 0;
$research_total = 0;
//$total = 0;

foreach ($data as $index => $row)
{
	if ($prev_report_production!=$row['ReportProduction']['name'])
	{
		$currow = $report_production_row;
		if ($prev_report_production!='')
		{
			$currow = $research_total_row . $report_research_total_row . $report_production_total_row . $currow;
			$currow = str_replace('${report_production_total}', $report_production_total, $currow);
			$currow = str_replace('${report_research_total}', $report_research_total, $currow);
			$currow = str_replace('${research_total}', $research_total, $currow);
		}
		$report_production_total = 0;
		$report_research_total = 0;
		$research_total = 0;
	} else {
		if ($prev_report_research != $row['ReportResearch']['name'])
		{
			$currow = $report_research_row;
			$currow = $research_total_row . $report_research_total_row . $currow;
			$currow = str_replace('${report_research_total}', $report_research_total, $currow);
			$currow = str_replace('${research_total}', $research_total, $currow);
			$report_research_total = 0;
			$research_total = 0;
		} else {
			if ($prev_research != $row['ResearchType']['name'])
			{
				$currow = $research_row;
				$currow = $research_total_row . $currow;
				$currow = str_replace('${research_total}', $research_total, $currow);
				$research_total = 0;
			} else {
				if ($prev_research_result != $row['Research']['research_result'])
				{
					$currow = $research_result_row;
				}
			}
		}
	}
	$report_production_total += (int)$row['Research']['count'];
	$report_research_total += (int)$row['Research']['count'];
	$research_total += (int)$row['Research']['count'];
	//$total += (int)$row['Research']['count'];

	$currow = str_replace('${report_production_name}', $row['ReportProduction']['name'], $currow);
	$currow = str_replace('${report_research_name}', $row['ReportResearch']['name'], $currow);
	$currow = str_replace('${research_name}', $row['ResearchType']['name'], $currow);
	$currow = str_replace('${research_result_name}', $row['Research']['research_result'], $currow);
	$currow = str_replace('${research_count}', $row['Research']['count'], $currow);
	
	if($index==count($data)-1)
	{
		$currow .= $research_total_row . $report_research_total_row . $report_production_total_row;
		$currow = str_replace('${report_production_total}', $report_production_total, $currow);
		$currow = str_replace('${report_research_total}', $report_research_total, $currow);
		$currow = str_replace('${research_total}', $research_total, $currow);
	}	
	
	$iteration.= $currow;
	$prev_report_production = $row['ReportProduction']['name'];
	$prev_report_research   = $row['ReportResearch']['name'];
	$prev_research          = $row['ResearchType']['name'];
	$prev_research_result   = $row['Research']['research_result'];
}

//$table = str_replace('${total}',$total,$table);
$table = str_replace('${iteration}',$iteration,$table);

echo str_replace('${body}', $addendum_top.$title.$table.$addendum_bottom, $body);
//pr($data);
?>