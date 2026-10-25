<?php 
$file = 'Аналитический отчет 10.doc';
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
$top = str_replace('${title_line_2}','о количестве и результатах направленных на исследования проб',$top);
$bottom = str_replace('${signer_job}', $signer_job, $bottom);
$bottom = str_replace('${signer_name}', $signer_name, $bottom);

function drawTable($headerText, $data, $showOrderInfo = true) {
	$table = file_get_contents(APP.'/docTemplates/indexi/i10/table.xml');
	$header = file_get_contents(APP.'/docTemplates/indexi/header.xml');
	
	$lab_row = file_get_contents(APP.'/docTemplates/indexi/i10/lab_row.xml');	
	$lab_total_row = file_get_contents(APP.'/docTemplates/indexi/i10/lab_total_row.xml');
	$production_type_row = file_get_contents(APP.'/docTemplates/indexi/i10/production_type_row.xml');	
	$production_type_total_row = file_get_contents(APP.'/docTemplates/indexi/i10/production_type_total_row.xml');
	$production_row = file_get_contents(APP.'/docTemplates/indexi/i10/production_row.xml');
	$production_total_row = file_get_contents(APP.'/docTemplates/indexi/i10/production_total_row.xml');
	$doc_row = file_get_contents(APP.'/docTemplates/indexi/i10/doc_row.xml');

	$header = str_replace('${header}', $headerText, $header);
	$iteration = '';

	$prev_lab = '';
	$prev_production_type = '';
	$prev_production = '';
	$prev_doc = '';

	$lab_total = $lab_positives_total = 0;
	$production_type_total = $production_type_positives_total = 0;
	$production_total = $production_positives_total = 0;
	//$total = $total_positives = 0;

	foreach ($data as $index => $row)
	{
		$cur_lab = $row['Vetlab']['name'];
		$cur_production_type = $row['ProductionType']['name'];
		$cur_production = $row['Production']['name'];
		$cur_doc = $row['SamplePurpose']['name'];
		if($showOrderInfo)
		{
			$cur_doc .= ', '.$row['Organ']['order_type'].' '.$row['Organ']['order_num'].' от '. date_format(date_create($row['Organ']['order_date']),'d.m.Y');
		}
		if ($prev_lab != $cur_lab)
		{
			$currow = $lab_row;
			if($prev_lab != '') 
			{
				$currow = $production_total_row . $production_type_total_row . $lab_total_row . $currow;
				$currow = str_replace('${lab_total}', $lab_total, $currow);
				$currow = str_replace('${lab_positives_total}', $lab_positives_total, $currow);
				$currow = str_replace('${production_type_total}', $production_type_total, $currow);
				$currow = str_replace('${production_type_positives_total}', $production_type_positives_total, $currow);
				$currow = str_replace('${production_total}', $production_total, $currow);
				$currow = str_replace('${production_positives_total}', $production_positives_total, $currow);
			}
			$lab_total = $lab_positives_total = 0;
			$production_type_total = $production_type_positives_total = 0;
			$production_total = $production_positives_total = 0;
		} else {
			if($prev_production_type != $cur_production_type)
			{
				$currow = $production_type_row;
				$currow = $production_total_row . $production_type_total_row . $currow;
				$currow = str_replace('${production_type_total}', $production_type_total, $currow);
				$currow = str_replace('${production_type_positives_total}', $production_type_positives_total, $currow);
				$currow = str_replace('${production_total}', $production_total, $currow);
				$currow = str_replace('${production_positives_total}', $production_positives_total, $currow);
				$production_type_total = $production_type_positives_total = 0;
				$production_total = $production_positives_total = 0;
			} else {
				if($prev_production != $cur_production)
				{
					$currow = $production_row;
					$currow = $production_total_row . $currow;
					$currow = str_replace('${production_total}', $production_total, $currow);
					$currow = str_replace('${production_positives_total}', $production_positives_total, $currow);
					$production_total = $production_positives_total = 0;
				} else {
					if ($prev_doc != $cur_doc)
					{
						$currow = $doc_row;
					}
				}
			}
		}
		$lab_total += $row['Sample']['count'];
		$lab_positives_total += $row['Sample']['positives'];
		$production_type_total += $row['Sample']['count'];
		$production_type_positives_total += $row['Sample']['positives'];
		$production_total += $row['Sample']['count'];
		$production_positives_total += $row['Sample']['positives'];
		//$total += $row['Sample']['count'];
		//$total_positives += $row['Sample']['positives'];

		$currow = str_replace('${lab_name}', $cur_lab, $currow);
		$currow = str_replace('${production_type_name}', $cur_production_type, $currow);
		$currow = str_replace('${production_name}', $cur_production, $currow);		
		$currow = str_replace('${doc}', $cur_doc, $currow);		
		$currow = str_replace('${sample_count}', $row['Sample']['count'], $currow);		
		$currow = str_replace('${sample_positives}', $row['Sample']['positives'], $currow);
		
		if($index==count($data)-1)
		{
			$currow .= $production_total_row . $production_type_total_row . $lab_total_row;
			$currow = str_replace('${lab_total}', $lab_total, $currow);
			$currow = str_replace('${lab_positives_total}', $lab_positives_total, $currow);
			$currow = str_replace('${production_type_total}', $production_type_total, $currow);
			$currow = str_replace('${production_type_positives_total}', $production_type_positives_total, $currow);
			$currow = str_replace('${production_total}', $production_total, $currow);
			$currow = str_replace('${production_positives_total}', $production_positives_total, $currow);
		}
		
		$iteration.= $currow;
		$prev_lab = $cur_lab;
		$prev_production_type = $cur_production_type;
		$prev_production = $cur_production;		
		$prev_doc = $cur_doc;
	}

	//$table = str_replace('${total}', $total, $table);
	//$table = str_replace('${total_positives}', $total_positives, $table);
	$table = str_replace('${iteration}', $iteration, $table);
	return $header.$table;
}
$plannedTable = drawTable('1. Плановые исследования (госзадание)', $planned_data);
$extraTable = drawTable('2. Исследования по показаниям', $extra_data, false);
echo str_replace('${body}', $top
								.$plannedTable
								.$page_break
								.$extraTable
 							.$bottom, $body);
?>