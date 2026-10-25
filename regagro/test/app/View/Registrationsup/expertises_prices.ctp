<?php 
$file = 'Сводные данные.doc';
header("Content-Description: File Transfer");
header('Content-Disposition: attachment; filename="' . $file . '"');
header('Content-Type: application/vnd.ms-word');
header('Content-Transfer-Encoding: binary');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Expires: 0');

$body = file_get_contents(APP.'/docTemplates/expertises_prices/body.xml');
$top = file_get_contents(APP.'/docTemplates/expertises_prices/top.xml');
$bottom = file_get_contents(APP.'/docTemplates/expertises_prices/bottom.xml');
$table = file_get_contents(APP.'/docTemplates/expertises_prices/table.xml');

$production_type_row = file_get_contents(APP.'docTemplates/expertises_prices/production_type_row.xml');
$production_type_total_row = file_get_contents(APP.'docTemplates/expertises_prices/production_type_total_row.xml');
$production_row = file_get_contents(APP.'docTemplates/expertises_prices/production_row.xml');
$total_row = file_get_contents(APP.'docTemplates/expertises_prices/total_row.xml');

$top = str_replace('${date_from}',  date_format(date_create($date_from),'d.m.Y'), $top);
$top = str_replace('${date_to}',  date_format(date_create($date_to),'d.m.Y')	, $top);
$top = str_replace('${org_type}', $org_type, $top);
$top = str_replace('${org_name}', $org_name, $top);
$top = str_replace('${institution_name}', isset($institution_name)?$institution_name:'', $top);
$bottom = str_replace('${signer_job}', $signer_job, $bottom);
$bottom = str_replace('${signer_name}', $signer_name, $bottom);

$iteration = '';
$currow = '';
$prev_production_type = '';
$total = 0;
$count = 0;
$production_type_total = 0;
$production_type_count = 0;
foreach ($data as $index => $row) {
	if ($prev_production_type!=$row['ProductionType']['name']) {
		$currow = $production_type_row;
		if ($prev_production_type!='')
		{
			$currow = $production_type_total_row . $currow;
			$currow = str_replace('${production_type_total}', $this->Number->format($production_type_total,array(
																							'places' => 2,
																							'before' => '',
																							'escape' => false,
																							'decimals' => ',',
																							'thousands' => ''
																						)), $currow);
			$currow = str_replace('${production_type_count}', $production_type_count, $currow);
		}
		$production_type_total = 0;
		$production_type_count = 0;
	} else {
		$currow = $production_row;
	}
	$production_type_total += $row['Expertise']['price'];
	$production_type_count += $row['Expertise']['count'];
	$count += $row['Expertise']['count'];
	$total += $row['Expertise']['price'];
	$currow = str_replace('${production_type_name}', $row['ProductionType']['name'], $currow);
	$currow = str_replace('${production_name}', $row['Production']['name'], $currow);
	$currow = str_replace('${measure_name}', $row['Production']['measure'], $currow);
	$currow = str_replace('${expertise_count}', $row['Expertise']['count'], $currow);
	$currow = str_replace('${expertise_price}', $this->Number->format($row['Expertise']['price'],array(
																							'places' => 2,
																							'before' => '',
																							'escape' => false,
																							'decimals' => ',',
																							'thousands' => ''
																						)), $currow);
	if($index==count($data)-1)
	{
		$currow .= $production_type_total_row;
		$currow = str_replace('${production_type_total}', $this->Number->format($production_type_total,array(
																							'places' => 2,
																							'before' => '',
																							'escape' => false,
																							'decimals' => ',',
																							'thousands' => ''
																						)), $currow);
		$currow = str_replace('${production_type_count}', $production_type_count, $currow);
	}	
	
	$iteration.= $currow;
	$prev_production_type = $row['ProductionType']['name'];
}

$total_row = str_replace('${count}',$count ,$total_row);
$total_row = str_replace('${total}',$this->Number->format($total,array(
																	'places' => 2,
																	'before' => '',
																	'escape' => false,
																	'decimals' => ',',
																	'thousands' => ''
																)),$total_row);
$iteration = $iteration . $total_row;

$table = str_replace('${iteration}',$iteration,$table);

echo str_replace('${body}', $top.$table.$bottom, $body);
//pr($data);
?>