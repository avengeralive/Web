<?php 
$file = 'Аналитический отчет 4.doc';
header("Content-Description: File Transfer");
header('Content-Disposition: attachment; filename="' . $file . '"');
header('Content-Type: application/vnd.ms-word');
header('Content-Transfer-Encoding: binary');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Expires: 0');

$body = file_get_contents(APP.'/docTemplates/indexi/body.xml');
$top = file_get_contents(APP.'/docTemplates/indexi/top.xml');
$bottom = file_get_contents(APP.'/docTemplates/indexi/bottom.xml');
$page_break = file_get_contents(APP.'/docTemplates/indexi/page_break.xml');

$top = str_replace('${date_from}', date_format(date_create($date_from),'d.m.Y'), $top);
$top = str_replace('${date_to}', date_format(date_create($date_to),'d.m.Y'), $top);
$top = str_replace('${institution_name}', $institution_name, $top);
$top = str_replace('${org_type}', $org_type, $top);
$top = str_replace('${org_name}', $org_name, $top);
$top = str_replace('${title_line_1}','ИНФОРМАЦИЯ',$top);
$top = str_replace('${title_line_2}','О РЕГИОНАХ-ПОСТАВЩИКАХ ПРОДУКЦИИ',$top);
$bottom = str_replace('${signer_job}', $signer_job, $bottom);
$bottom = str_replace('${signer_name}', $signer_name, $bottom);

$table = file_get_contents(APP.'/docTemplates/indexi/i4/table.xml');
	
$district_row = file_get_contents(APP.'/docTemplates/indexi/i4/district_row.xml');	
$district_total_row = file_get_contents(APP.'/docTemplates/indexi/i4/district_total_row.xml');	
$production_type_row = file_get_contents(APP.'/docTemplates/indexi/i4/production_type_row.xml');
$region_row = file_get_contents(APP.'/docTemplates/indexi/i4/region_row.xml');	
$region_total_row = file_get_contents(APP.'/docTemplates/indexi/i4/region_total_row.xml');	
$report_production_row = file_get_contents(APP.'/docTemplates/indexi/i4/report_production_row.xml');	
$report_production_total_row = file_get_contents(APP.'/docTemplates/indexi/i4/report_production_total_row.xml');	

$iteration = '';

$prev_region = '';
$prev_district = '';
$prev_production_type = '';
$prev_report_production = '';

$region_total = 0;
$district_total = 0;
$report_production_total = 0;

$total = 0;
foreach ($data as $index => $row)
{
	if ($prev_region!=$row['Region']['name'])
	{
		$currow = $region_row;
		if ($prev_region!='')
		{
			$currow = $report_production_total_row . $district_total_row . $region_total_row . $currow;
			$currow = str_replace('${region_total}', number_format($region_total,2), $currow);
			$currow = str_replace('${district_total}', number_format($district_total,2), $currow);
			$currow = str_replace('${report_production_total}', number_format($report_production_total,2), $currow);
		}
		$region_total = 0;
		$district_total = 0;
		$report_production_total = 0;
	} else {
		if ($prev_district != $row['District']['name'])
		{
			$currow = $district_row;
			$currow = $report_production_total_row . $district_total_row . $currow;
			$currow = str_replace('${district_total}', number_format($district_total,2), $currow);
			$currow = str_replace('${report_production_total}', number_format($report_production_total,2), $currow);
			$district_total = 0;
			$report_production_total = 0;
		} else {
			if ($prev_report_production!=$row['ReportProduction']['name'])
			{
				$currow = $report_production_row;
				$currow = $report_production_total_row . $currow;
				$currow = str_replace('${report_production_total}', number_format($report_production_total,2), $currow);
				$report_production_total = 0;
			} else {
				if ($prev_production_type!=$row['ProductionType']['name'])
				{
					$currow = $production_type_row;
				}
			}
		}
	}
	$region_total += (float)$row['Expertise']['weight'];
	$district_total += (float)$row['Expertise']['weight'];
	$report_production_total += (float)$row['Expertise']['weight'];
	$total += (float)$row['Expertise']['weight'];
	$currow = str_replace('${region_name}', $row['Region']['name'], $currow);
	$currow = str_replace('${district_name}', $row['District']['name'], $currow);
	$currow = str_replace('${production_type_name}', $row['ProductionType']['name'], $currow);
	$currow = str_replace('${report_production_name}', $row['ReportProduction']['name'], $currow);
	$currow = str_replace('${expertise_weight}', number_format($row['Expertise']['weight'],2), $currow);
	
	if($index==count($data)-1)
	{
		$currow .= $production_type_total_row . $district_total_row . $region_total_row;
		$currow = str_replace('${region_total}', number_format($region_total,2), $currow);
		$currow = str_replace('${district_total}', number_format($district_total,2), $currow);
		$currow = str_replace('${report_production_total}', number_format($report_production_total,2), $currow);
	}
	
	$iteration.= $currow;
	$prev_region = $row['Region']['name'];
	$prev_district = $row['District']['name'];
	$prev_production_type = $row['ProductionType']['name'];
	$prev_report_production = $row['ReportProduction']['name'];
}
			
//$table = str_replace('${total}',$total,$table);
$table = str_replace('${iteration}', $iteration, $table);

echo str_replace('${body}', $top
								.$table
							.$bottom, $body);
?>