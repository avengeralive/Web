<?php 
$file = 'Аналитический отчет 5.doc';
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
$top = str_replace('${title_line_2}','О КОЛИЧЕСТВЕ НАПРАВЛЕННЫХ ПРОБ НА ИССЛЕДОВАНИЯ',$top);
$bottom = str_replace('${signer_job}', $signer_job, $bottom);
$bottom = str_replace('${signer_name}', $signer_name, $bottom);

$table = file_get_contents(APP.'/docTemplates/indexi/i5/table.xml');
$sample_purpose_row = file_get_contents(APP.'/docTemplates/indexi/i5/sample_purpose_row.xml');
$sample_purpose_total_row = file_get_contents(APP.'/docTemplates/indexi/i5/sample_purpose_total_row.xml');
$production_type_row = file_get_contents(APP.'/docTemplates/indexi/i5/production_type_row.xml');
$production_type_total_row = file_get_contents(APP.'/docTemplates/indexi/i5/production_type_total_row.xml');
$sample_act_row = file_get_contents(APP.'/docTemplates/indexi/i5/sample_act_row.xml');

$iteration = '';
$prev_sample_purpose     = '';
$prev_production_type    = '';
$prev_sample_act         = '';
$sample_purpose_total = 0;
$production_type_total = 0;
$total = 0;
foreach ($data as $index => $row)
{
	if(empty($row['SamplePurpose']['name'])) {
		$row['SamplePurpose']['name'] = 'не указано';
	}

	if ($prev_sample_purpose!=$row['SamplePurpose']['name'])
	{
		$currow = $sample_purpose_row;
		if ($prev_sample_purpose!='')
		{
			$currow = $production_type_total_row . $sample_purpose_total_row . $currow;
			$currow = str_replace('${sample_purpose_total}', $sample_purpose_total, $currow);
			$currow = str_replace('${production_type_total}', $production_type_total, $currow);
		}
		$sample_purpose_total = 0;
		$production_type_total = 0;
	} else {
		if($prev_production_type != $row['ProductionType']['name']) 
		{
			$currow = $production_type_row;
			$currow = $production_type_total_row . $currow;
			$currow = str_replace('${production_type_total}', $production_type_total, $currow);
			$production_type_total = 0;
		} else {
			if($prev_sample_act != $row['Sample']['act_code']) 
			{
				$currow = $sample_act_row;
			}
		}
	}

	$sample_purpose_total += (int)$row['Sample']['count'];
	$production_type_total += (int)$row['Sample']['count'];
	$total += (int)$row['Sample']['count'];

	$currow = str_replace('${sample_purpose_name}', $row['SamplePurpose']['name'], $currow);
	$currow = str_replace('${production_type_name}', $row['ProductionType']['name'], $currow);
	$currow = str_replace('${sample_act_date}', date_format(date_create($row['Registration']['date']),'d.m.Y'), $currow);
	$currow = str_replace('${sample_act_code}', $row['Sample']['act_code'], $currow);
	$currow = str_replace('${production_name}', $row['Production']['name'], $currow);
	$currow = str_replace('${registration_owner}', $row['Registration']['owner'], $currow);
	$currow = str_replace('${sample_count}', $row['Sample']['count'], $currow);

	if($index==count($data)-1)
	{
		$currow .= $production_type_total_row . $sample_purpose_total_row;
		$currow = str_replace('${sample_purpose_total}', $sample_purpose_total, $currow);
		$currow = str_replace('${production_type_total}', $production_type_total, $currow);
	}

	$iteration .= $currow;
	$prev_sample_purpose     = $row['SamplePurpose']['name'];
	$prev_production_type    = $row['ProductionType']['name'];
	$prev_sample_act         = $row['Sample']['act_code'];
}
			
$table = str_replace('${total}',$total,$table);
$table = str_replace('${iteration}', $iteration, $table);

echo str_replace('${body}', $top
								.$table
							.$bottom, $body);
?>