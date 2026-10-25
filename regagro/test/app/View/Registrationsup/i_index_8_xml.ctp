<?php 
$file = 'Аналитический отчет 8.doc';
header("Content-Description: File Transfer");
header('Content-Disposition: attachment; filename="' . $file . '"');
header('Content-Type: application/vnd.ms-word');
header('Content-Transfer-Encoding: binary');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Expires: 0');

define("PERCENT_DECIMALS", 0); //количество знаков полсде запятой для процентов

$body = file_get_contents(APP.'/docTemplates/indexi/body.xml');
$top = file_get_contents(APP.'/docTemplates/indexi/top.xml');
$bottom = file_get_contents(APP.'/docTemplates/indexi/bottom.xml');
$page_break = file_get_contents(APP.'/docTemplates/indexi/page_break.xml');

$top = str_replace('${date_from}', date_format(date_create($date_from),'d.m.Y'), $top);
$top = str_replace('${date_to}', date_format(date_create($date_to),'d.m.Y'), $top);
$top = str_replace('${institution_name}', $institution_name, $top);
$top = str_replace('${org_type}', $org_type, $top);
$top = str_replace('${org_name}', $org_name, $top);
$top = str_replace('${title_line_1}','СРАВНИТЕЛЬНЫЕ ДАННЫЕ',$top);
$top = str_replace('${title_line_2}','ПО КОЛИЧЕСТВУ СНЯТОЙ С РЕАЛИЗАЦИИ ПРОДУКЦИИ СОТРУДНИКАМИ ЛАБОРАТОРИИ',$top);
$bottom = str_replace('${signer_job}', $signer_job, $bottom);
$bottom = str_replace('${signer_name}', $signer_name, $bottom);

$table = file_get_contents(APP.'/docTemplates/indexi/i8/table.xml');
	
$report_production_row = file_get_contents(APP.'/docTemplates/indexi/i8/report_production_row.xml');	
$report_production_total_row = file_get_contents(APP.'/docTemplates/indexi/i8/report_production_total_row.xml');
$production_type_row = file_get_contents(APP.'/docTemplates/indexi/i8/production_type_row.xml');	
$production_type_total_row = file_get_contents(APP.'/docTemplates/indexi/i8/production_type_total_row.xml');
$user_row = file_get_contents(APP.'/docTemplates/indexi/i8/user_row.xml');

$iteration = '';

$prev_report_production = '';
$prev_production_type = '';
$prev_user = '';

$report_production_total = 0;
$report_production_ban_total = 0;
$production_type_total = 0;
$production_type_ban_total = 0;
$total = 0;
$ban_total = 0;

foreach ($data as $index => $row)
{
	if ($prev_report_production != $row['ReportProduction']['name'])
	{
		$currow = $report_production_row;
		if($prev_report_production != '') 
		{
			$currow = $production_type_total_row . $report_production_total_row . $currow;
			$currow = str_replace('${report_production_total}', number_format($report_production_total,2), $currow);
			$currow = str_replace('${report_production_ban_total}', number_format($report_production_ban_total,2), $currow);
			$currow = str_replace('${report_production_percent_total}', number_format(($report_production_ban_total*100)/$report_production_total, PERCENT_DECIMALS), $currow);
			$currow = str_replace('${production_type_total}', number_format($production_type_total,2), $currow);
			$currow = str_replace('${production_type_ban_total}', number_format($production_type_ban_total,2), $currow);
			$currow = str_replace('${production_type_percent_total}', number_format(($production_type_ban_total*100)/$production_type_total, PERCENT_DECIMALS), $currow);
		}
		$report_production_total = 0;
		$report_production_ban_total = 0;
		$production_type_total = 0;
		$production_type_ban_total = 0;
	} else {
		if($prev_production_type != $row['ProductionType']['name'])
		{
			$currow = $production_type_row;
			$currow = $production_type_total_row . $currow;
			$currow = str_replace('${production_type_total}', number_format($production_type_total,2), $currow);
			$currow = str_replace('${production_type_ban_total}', number_format($production_type_ban_total,2), $currow);
			$currow = str_replace('${production_type_percent_total}', number_format(($production_type_ban_total*100)/$production_type_total, PERCENT_DECIMALS), $currow);
			$production_type_total = 0;
			$production_type_ban_total = 0;
		} else {
			if ($prev_user!=$row['User']['displayname'])
			{
				$currow = $user_row;
			}
		}
	}
	$report_production_total += (float)$row['Expertise']['weight'];
	$report_production_ban_total += (float)$row['Ban']['weight'];
	$production_type_total += (float)$row['Expertise']['weight'];
	$production_type_ban_total += (float)$row['Ban']['weight'];
	$total += (float)$row['Expertise']['weight'];
	$ban_total += (float)$row['Ban']['weight'];
	$currow = str_replace('${report_production_name}', $row['ReportProduction']['name'], $currow);
	$currow = str_replace('${production_type_name}', $row['ProductionType']['name'], $currow);
	$currow = str_replace('${user_displayname}', $row['User']['displayname'], $currow);
	$currow = str_replace('${weight}', number_format($row['Expertise']['weight'],2), $currow);
	$currow = str_replace('${ban_weight}', number_format($row['Ban']['weight'],2), $currow);
	$currow = str_replace('${percent}', number_format(($row['Ban']['weight']*100)/$row['Expertise']['weight'],PERCENT_DECIMALS), $currow);
	
	if($index==count($data)-1)
	{
		$currow .= $production_type_total_row . $report_production_total_row;
		$currow = str_replace('${report_production_total}', number_format($report_production_total,2), $currow);
		$currow = str_replace('${report_production_ban_total}', number_format($report_production_ban_total,2), $currow);
		$currow = str_replace('${report_production_percent_total}', number_format(($report_production_ban_total*100)/$report_production_total,PERCENT_DECIMALS), $currow);
		$currow = str_replace('${production_type_total}', number_format($production_type_total,2), $currow);
		$currow = str_replace('${production_type_ban_total}', number_format($production_type_ban_total,2), $currow);
		$currow = str_replace('${production_type_percent_total}', number_format(($production_type_ban_total*100)/$production_type_total, PERCENT_DECIMALS), $currow);
	}
	
	$iteration.= $currow;
	$prev_report_production = $row['ReportProduction']['name'];
	$prev_production_type = $row['ProductionType']['name'];
	$prev_user = $row['User']['displayname'];
}
			
$table = str_replace('${total}',number_format($total,2),$table);
$table = str_replace('${ban_total}',number_format($ban_total,2),$table);
$table = str_replace('${percent_total}',number_format($total>0?($ban_total*100)/$total:0,PERCENT_DECIMALS),$table);
$table = str_replace('${iteration}', $iteration, $table);

echo str_replace('${body}', $top
								.$table
							.$bottom, $body);
?>