<?php 


$file = 'Аналитический отчет 11.doc';
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
$top = str_replace('${title_line_2}','О КОЛИЧЕСТВЕ ДЕНАТУРИРОВАННОЙ ПРОДУКЦИИ',$top);
$bottom = str_replace('${signer_job}', $signer_job, $bottom);
$bottom = str_replace('${signer_name}', $signer_name, $bottom);

function drawTable($data) {
	$table = file_get_contents(APP.'/docTemplates/indexi/i11/table.xml');
	
	$report_production_row = file_get_contents(APP.'/docTemplates/indexi/i11/report_production_row.xml');	
	$report_production_total_row = file_get_contents(APP.'/docTemplates/indexi/i11/report_production_total_row.xml');	
	$use_order_row = file_get_contents(APP.'/docTemplates/indexi/i11/use_order_row.xml');	
	$total_row = file_get_contents(APP.'/docTemplates/indexi/i11/total_row.xml');

	$iteration = '';
	$prev_report_production = '';
	$total = $report_production_total = 0;
	$eggs_total = $report_production_total = 0;
	$use_order_totals = array('Уничтожено'=>0, 'Утилизированно'=>0);
	$eggs_use_order_totals = array('Уничтожено'=>0, 'Утилизированно'=>0);
	foreach ($data as $index => $row)
	{
		$isMeat = in_array($row['ReportProduction']['name'], array('Другие виды животных','Другие виды птицы','Кролики, нутрии','Крупный рогатый скот, яки, буйволы','Куры','Овцы, козы','Рыба','Свиньи'));

		if (strpos($row['ReportProduction']['name'], 'Яйцо')===false){
			$use_order_totals[$isMeat?'Уничтожено':'Утилизированно'] += $row['Expertise']['weight'];
		} else {
			$eggs_use_order_totals[$isMeat?'Уничтожено':'Утилизированно'] += $row['Expertise']['weight'];
		}
		
		$cur_report_production = $row['ReportProduction']['name'];
		if ($prev_report_production != $cur_report_production)
		{
			$currow = $report_production_row;
			if($prev_report_production != '') 
			{
				$currow = $report_production_total_row . $currow;
				$currow = str_replace('${report_production_total}', number_format($report_production_total, 2), $currow);
			}
			$report_production_total = 0;
		} else {
			$currow = $use_order_row;
		}
		$report_production_total += $row['Expertise']['weight'];
		
		if (strpos($row['ReportProduction']['name'], 'Яйцо')===false){
			$total += $row['Expertise']['weight'];
		} else {
			$eggs_total += $row['Expertise']['weight'];
		}

		$currow = str_replace('${report_production_name}', $cur_report_production, $currow);
		$currow = str_replace('${use_order}', "Уничтожено", $currow);
		$currow = str_replace('${expertise_weight}', $isMeat?number_format($row['Expertise']['weight'], 2):0, $currow);
		
		$currow.=$use_order_row;
		$currow = str_replace('${use_order}', "Утилизированно", $currow);
		$currow = str_replace('${expertise_weight}', $isMeat?0:number_format($row['Expertise']['weight'], 2), $currow);

		if($index==count($data)-1)
		{
			$currow .= $report_production_total_row;
			$currow = str_replace('${report_production_total}', number_format($report_production_total,2), $currow);
		}
		
		$iteration.= $currow;
		$prev_report_production = $cur_report_production;
	}

	//kg and liters
	$totals_row = '';
	$first = true;
	foreach ($use_order_totals as $key => $value)
	{
		if($first) {
			$totals_row .= str_replace('${units}', 'кг, л' , $total_row);
		} else {
			$totals_row .= $use_order_row;
		}
		$totals_row = str_replace('${use_order}', $key, $totals_row);
		$totals_row = str_replace('${expertise_weight}', $value>0?number_format($value, 2):0, $totals_row);
		$first = false;
	}

	$totals_row .= str_replace('${report_production_total}', $value>0?number_format($total, 2):0, $report_production_total_row);
	$iteration .= $totals_row;
	
	//eggs
	$eggs_totals_row = '';
	$first = true;
	foreach ($eggs_use_order_totals as $key => $value)
	{
		if($first) {
			$eggs_totals_row .= str_replace('${units}', 'шт' , $total_row);
		} else {
			$eggs_totals_row .= $use_order_row;
		}
		$eggs_totals_row = str_replace('${use_order}', $key, $eggs_totals_row);
		$eggs_totals_row = str_replace('${expertise_weight}', $value>0?number_format($value, 2):0, $eggs_totals_row);
		$first = false;
	}

	$eggs_totals_row .= str_replace('${report_production_total}', $value>0?number_format($eggs_total, 2):0, $report_production_total_row);
	$iteration .= $eggs_totals_row;
	

	//$table = str_replace('${total}', $total, $table);
	$table = str_replace('${iteration}', $iteration, $table);

	return $table;
}

echo str_replace('${body}', $top
								.drawTable($data)
 							.$bottom, $body);
?>