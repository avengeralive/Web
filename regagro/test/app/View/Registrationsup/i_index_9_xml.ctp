<?php 
$file = 'Аналитический отчет 9.doc';
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
$top = str_replace('${title_line_2}','о количестве поступившей подконтрольной продукции',$top);
$bottom = str_replace('${signer_job}', $signer_job, $bottom);
$bottom = str_replace('${signer_name}', $signer_name, $bottom);

function drawTable($headerText, $data) {
	$table = file_get_contents(APP.'/docTemplates/indexi/i9/table.xml');
	$header = file_get_contents(APP.'/docTemplates/indexi/header.xml');
	
	$production_type_row = file_get_contents(APP.'/docTemplates/indexi/i9/production_type_row.xml');	
	$production_type_total_row = file_get_contents(APP.'/docTemplates/indexi/i9/production_type_total_row.xml');
	$production_row = file_get_contents(APP.'/docTemplates/indexi/i9/production_row.xml');
	$total_row = file_get_contents(APP.'/docTemplates/indexi/i9/total_row.xml');

	$header = str_replace('${header}', $headerText, $header);
	$iteration = '';

	$prev_production = '';
	$prev_production_type   = '';

	$production_type_total = 0;
	$total = 0;
	$total_eggs = 0;

	foreach ($data as $index => $row)
	{
		if ($prev_production_type != $row['ProductionType']['name'])
		{
			$currow = $production_type_row;
			if($prev_production_type != '') 
			{
				$currow = $production_type_total_row . $currow;
				$currow = str_replace('${production_type_total}', number_format($production_type_total,2), $currow);
			}
			$production_type_total = 0;
		} else {
			if($prev_production != $row['Production']['name'])
			{
				$currow = $production_row;
			}
		}
		$production_type_total += (float)$row['Expertise']['weight'];
		if (strpos($row['ProductionType']['name'], 'Яйцо')===false) {
			$total += (float)$row['Expertise']['weight'];
		} else {
			$total_eggs += (float)$row['Expertise']['weight'];
		}
		$currow = str_replace('${production_name}', $row['Production']['name'], $currow);
		$currow = str_replace('${production_type_name}', $row['ProductionType']['name'], $currow);
		$currow = str_replace('${weight}', number_format($row['Expertise']['weight'],2), $currow);
		
		if($index==count($data)-1)
		{
			$currow .= $production_type_total_row;
			$currow = str_replace('${production_type_total}', number_format($production_type_total,2), $currow);
		}
		
		$iteration.= $currow;
		$prev_production = $row['Production']['name'];
		$prev_production_type = $row['ProductionType']['name'];
	}
	
	//$table = str_replace('${total}', number_format($total,2),$table);
	$totals = str_replace('${units}', 'кг, л', $total_row);
	$totals = str_replace('${total}', number_format($total,2), $totals);
	$totals.= str_replace('${units}', 'шт', $total_row);
	$totals = str_replace('${total}', number_format($total_eggs,2), $totals);
	
	$iteration.=$totals;
	
	$table = str_replace('${iteration}', $iteration, $table);
	return $header.$table;
}

$domesticTable = drawTable('1. Продукция отечественного производства', $domestic_data);
$foreignTable = drawTable('2. Продукция импортного производства', $foreign_data);
echo str_replace('${body}', $top
								.$domesticTable
								.$foreignTable
							.$bottom, $body);
?>