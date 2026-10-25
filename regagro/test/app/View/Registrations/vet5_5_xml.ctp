<?php 
$file = 'Приложение 5 5-вет.doc';
header("Content-Description: File Transfer");
header('Content-Disposition: attachment; filename="' . $file . '"');
header('Content-Type: application/vnd.ms-word');
header('Content-Transfer-Encoding: binary');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Expires: 0');

$body = file_get_contents(APP.'/docTemplates/vet5/body.xml');
$addendum_top = file_get_contents(APP.'/docTemplates/vet5/addendum_top.xml');
$addendum_bottom = file_get_contents(APP.'/docTemplates/vet5/addendum_bottom.xml');
$title = file_get_contents(APP.'/docTemplates/vet5/addendum5/title.xml');
$table = file_get_contents(APP.'/docTemplates/vet5/addendum5/table.xml');

$report_production_row = file_get_contents(APP.'/docTemplates/vet5/addendum5/report_production_row.xml');
$report_production_total_row = file_get_contents(APP.'/docTemplates/vet5/addendum5/report_production_total_row.xml');
$production_row = file_get_contents(APP.'/docTemplates/vet5/addendum5/production_row.xml');

$addendum_top = str_replace('${addendum_num}', '5', $addendum_top);
$addendum_top = str_replace('${date_from}',  $date_from, $addendum_top);
$addendum_top = str_replace('${date_to}',  $date_to, $addendum_top);
$addendum_top = str_replace('${org_type}', $org_type, $addendum_top);
$addendum_top = str_replace('${org_name}', $org_name, $addendum_top);
$addendum_bottom = str_replace('${signer_job}', $signer_job, $addendum_bottom);
$addendum_bottom = str_replace('${signer_name}', $signer_name, $addendum_bottom);

$iteration = '';

$prev_report_production = '';
$prev_production = '';
$production_total = 0;
$total = 0;
foreach ($data as $index => $row)
{
	if ($prev_report_production!=$row[0]['production_name'])
	{
		$currow = $report_production_row;
		if ($prev_report_production!='')
		{
			$currow = $report_production_total_row . $currow;
			$currow = str_replace('${production_total}', $production_total, $currow);
		}
		$production_total = 0;
	} else {
		if ($prev_production != $row['Production']['name'])
		{
			$currow = $production_row;
		} 
	}
	$production_total += (int)$row[0]['count'];
	$total += (int)$row[0]['count'];
	$currow = str_replace('${report_production_name}', $row[0]['production_name'], $currow);
	$currow = str_replace('${production_name}', $row['Production']['name'], $currow);
	$currow = str_replace('${expertise_count}', $row[0]['count'], $currow);
	
	if($index==count($data)-1)
	{
		$currow .= $report_production_total_row;
		$currow = str_replace('${production_total}', $production_total, $currow);
	}	
	
	$iteration.= $currow;
	$prev_report_production = $row[0]['production_name'];
	$prev_production = $row['Production']['name'];
}

//$table = str_replace('${total}',$total,$table);
$table = str_replace('${iteration}',$iteration,$table);

echo str_replace('${body}', $addendum_top.$title.$table.$addendum_bottom, $body);
?>