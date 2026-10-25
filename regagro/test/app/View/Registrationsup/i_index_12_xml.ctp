<?php 
$file = 'Аналитический отчет 12.doc';
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
$top = str_replace('${title_line_2}','О ПРОДУКЦИИ ПО РЕГИОНАМ-ПОСТАВЩИКАМ',$top);
$bottom = str_replace('${signer_job}', $signer_job, $bottom);
$bottom = str_replace('${signer_name}', $signer_name, $bottom);

function drawTable($data) {
	$table = file_get_contents(APP.'/docTemplates/indexi/i12/table.xml');
	
	$production_type_row = file_get_contents(APP.'/docTemplates/indexi/i12/production_type_row.xml');	
	$production_type_total_row = file_get_contents(APP.'/docTemplates/indexi/i12/production_type_total_row.xml');
	$report_production_row = file_get_contents(APP.'/docTemplates/indexi/i12/report_production_row.xml');
	$report_production_total_row = file_get_contents(APP.'/docTemplates/indexi/i12/report_production_total_row.xml');
	$region_row = file_get_contents(APP.'/docTemplates/indexi/i12/region_row.xml');
	$region_total_row = file_get_contents(APP.'/docTemplates/indexi/i12/region_total_row.xml');
	$district_row = file_get_contents(APP.'/docTemplates/indexi/i12/district_row.xml');

	$iteration = '';
	$prev_production_type = $prev_report_production = $prev_region = '';
	$production_type_count_total = $report_production_count_total = $region_count_total = 0;
	$production_type_weight_total = $report_production_weight_total = $region_weight_total = 0;

	foreach ($data as $index => $row)
	{
		$cur_production_type = $row['ProductionType']['name'];
		$cur_report_production = $row['ReportProduction']['name'];
		$cur_region = $row['Region']['name'];
		if ($prev_production_type != $cur_production_type)
		{
			$currow = $production_type_row;
			if($prev_production_type != '') 
			{
				$currow = $region_total_row . $report_production_total_row . $production_type_total_row . $currow;
				$currow = str_replace('${production_type_count_total}', $production_type_count_total, $currow);
				$currow = str_replace('${report_production_count_total}', $report_production_count_total, $currow);
				$currow = str_replace('${region_count_total}', $region_count_total, $currow);
				$currow = str_replace('${production_type_weight_total}', number_format($production_type_weight_total,2), $currow);
				$currow = str_replace('${report_production_weight_total}', number_format($report_production_weight_total,2), $currow);
				$currow = str_replace('${region_weight_total}', number_format($region_weight_total,2), $currow);
			}
			$production_type_count_total = $report_production_count_total = $region_count_total = 0;
			$production_type_weight_total = $report_production_weight_total = $region_weight_total = 0;
		} else {
			if($prev_report_production != $cur_report_production)
			{
				$currow = $report_production_row;
				$currow = $region_total_row . $report_production_total_row . $currow;
				$currow = str_replace('${report_production_count_total}', $report_production_count_total, $currow);
				$currow = str_replace('${region_count_total}', $region_count_total, $currow);
				$currow = str_replace('${report_production_weight_total}', number_format($report_production_weight_total,2), $currow);
				$currow = str_replace('${region_weight_total}', number_format($region_weight_total,2), $currow);	
				$report_production_count_total = $region_count_total = 0;
				$report_production_weight_total = $region_weight_total = 0;
			} else {
				if($prev_region != $cur_region)
				{
					$currow = $region_row;
					$currow = $region_total_row . $currow;
					$currow = str_replace('${region_count_total}', $region_count_total, $currow);
					$currow = str_replace('${region_weight_total}', number_format($region_weight_total,2), $currow);	
					$region_count_total = 0;
					$region_weight_total = 0;
				} else {
					$currow = $district_row;
				}
			}
		}
		$production_type_count_total += $row['Expertise']['count'];
		$report_production_count_total += $row['Expertise']['count'];
		$region_count_total += $row['Expertise']['count'];
		$production_type_weight_total += $row['Expertise']['weight'];
		$report_production_weight_total += $row['Expertise']['weight'];
		$region_weight_total += $row['Expertise']['weight'];

		$currow = str_replace('${production_type_name}', $cur_production_type, $currow);
		$currow = str_replace('${report_production_name}', $cur_report_production, $currow);		
		$currow = str_replace('${region_name}', $cur_region, $currow);		
		$currow = str_replace('${district_name}', $row['District']['name'], $currow);
		$currow = str_replace('${expertise_count}', $row['Expertise']['count'], $currow);
		$currow = str_replace('${expertise_weight}', number_format($row['Expertise']['weight'],2), $currow);
		
		if($index==count($data)-1)
		{
			$currow .= $region_total_row . $report_production_total_row . $production_type_total_row;
			$currow = str_replace('${production_type_count_total}', $production_type_count_total, $currow);
			$currow = str_replace('${report_production_count_total}', $report_production_count_total, $currow);
			$currow = str_replace('${region_count_total}', $region_count_total, $currow);
			$currow = str_replace('${production_type_weight_total}', number_format($production_type_weight_total,2), $currow);
			$currow = str_replace('${report_production_weight_total}', number_format($report_production_weight_total,2), $currow);
			$currow = str_replace('${region_weight_total}', number_format($region_weight_total,2), $currow);
		}
		
		$iteration.= $currow;
		$prev_production_type = $cur_production_type;
		$prev_report_production = $cur_report_production;
		$prev_region = $cur_region;
	}

	$table = str_replace('${iteration}', $iteration, $table);
	return $table;
}

echo str_replace('${body}', $top
								.drawTable($data)
 							.$bottom, $body);
?>


