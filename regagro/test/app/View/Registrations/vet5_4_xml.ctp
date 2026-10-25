<?php
$file = 'Приложение 4 5-вет.doc';
header("Content-Description: File Transfer");
header('Content-Disposition: attachment; filename="' . $file . '"');
header('Content-Type: application/vnd.ms-word');
header('Content-Transfer-Encoding: binary');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Expires: 0');

$body = file_get_contents(APP.'/docTemplates/vet5/body.xml');
$addendum_top = file_get_contents(APP.'/docTemplates/vet5/addendum_top.xml');
$addendum_bottom = file_get_contents(APP.'/docTemplates/vet5/addendum_bottom.xml');
$title = file_get_contents(APP.'/docTemplates/vet5/addendum4/title.xml');
$table = file_get_contents(APP.'/docTemplates/vet5/addendum4/table.xml');
$bottom = file_get_contents(APP.'/docTemplates/vet5/addendum4/bottom.xml');

$production_row = file_get_contents(APP.'/docTemplates/vet5/addendum4/production_row.xml');
$production_total_row = file_get_contents(APP.'/docTemplates/vet5/addendum4/production_total_row.xml');
$use_order_row = file_get_contents(APP.'/docTemplates/vet5/addendum4/use_order_row.xml');
$use_order_total_row = file_get_contents(APP.'/docTemplates/vet5/addendum4/use_order_total_row.xml');
$ban_reason_row = file_get_contents(APP.'/docTemplates/vet5/addendum4/ban_reason_row.xml');
$ban_reason_total_row = file_get_contents(APP.'/docTemplates/vet5/addendum4/ban_reason_total_row.xml');
$ban_type_row = file_get_contents(APP.'/docTemplates/vet5/addendum4/ban_type_row.xml');

$addendum_top = str_replace('${addendum_num}', '4', $addendum_top);
$addendum_top = str_replace('${date_from}',  $date_from, $addendum_top);
$addendum_top = str_replace('${date_to}',  $date_to, $addendum_top);
$addendum_top = str_replace('${org_type}', $org_type, $addendum_top);
$addendum_top = str_replace('${org_name}', $org_name, $addendum_top);
$addendum_bottom = str_replace('${signer_job}', $signer_job, $addendum_bottom);
$addendum_bottom = str_replace('${signer_name}', $signer_name, $addendum_bottom);

$iteration = '';

$prev_report_production = '';
$prev_use_order   = '';
$prev_ban_reason  = '';
$prev_ban_type    = '';
$ban_reason_total = 0;
$use_order_total  = 0;
$production_total = 0;
$total = 0;
foreach ($data as $index => $row)
{
	if ($prev_report_production!=$row['ReportProduction']['name'])
	{
		$currow = $production_row;
		if ($prev_report_production!='')
		{
			$currow = $ban_reason_total_row . $use_order_total_row . $production_total_row . $currow;
			$currow = str_replace('${production_total}', number_format($production_total,2), $currow);
			$currow = str_replace('${use_order_total}', number_format($use_order_total,2), $currow);
			$currow = str_replace('${ban_reason_total}', number_format($ban_reason_total,2), $currow);
		}
		$production_total = 0;
		$use_order_total = 0;
		$ban_reason_total = 0;
	} else {
		if ($prev_use_order != $row['Ban']['use_order'])
		{
			$currow = $use_order_row;
			$currow = $ban_reason_total_row . $use_order_total_row . $currow;
			$currow = str_replace('${use_order_total}', number_format($use_order_total,2), $currow);
			$currow = str_replace('${ban_reason_total}', number_format($ban_reason_total,2), $currow);
			$use_order_total = 0;
			$ban_reason_total = 0;
		} else {
			if ($prev_ban_reason!=$row['BanReason']['name'])
			{
				$currow = $ban_reason_row;
				$currow = $ban_reason_total_row . $currow;
				$currow = str_replace('${ban_reason_total}', number_format($ban_reason_total,2), $currow);
				$ban_reason_total = 0;
			} else {
				if ($prev_ban_type!=$row['ReportBanType']['name'])
				{
					$currow = $ban_type_row;
				}
			}
		}
	}

	$production_total += (float)$row[0]['weight'];
	$use_order_total += (float)$row[0]['weight'];
	$ban_reason_total += (float)$row[0]['weight'];
	$total += (float)$row[0]['weight'];
	$currow = str_replace('${report_production_name}', $row['ReportProduction']['name'], $currow);
	$currow = str_replace('${use_order_name}', $row['Ban']['use_order'], $currow);
	$currow = str_replace('${ban_reason}', $row['BanReason']['name'], $currow);
	$currow = str_replace('${report_ban_type}', $row['ReportBanType']['name'], $currow);
	$currow = str_replace('${ban_weight}', number_format($row[0]['weight'],2), $currow);

	if($index==count($data)-1)
	{
		$currow .= $ban_reason_total_row . $use_order_total_row . $production_total_row;
		$currow = str_replace('${production_total}', number_format($production_total,2), $currow);
		$currow = str_replace('${use_order_total}' , number_format($use_order_total, 2), $currow);
		$currow = str_replace('${ban_reason_total}', number_format($ban_reason_total,2), $currow);
	}

	$iteration.= $currow;
	$prev_report_production = $row['ReportProduction']['name'];
	$prev_use_order = $row['Ban']['use_order'];
	$prev_ban_reason = $row['BanReason']['name'];
	$prev_ban_type = $row['ReportBanType']['name'];
}

$table = str_replace('${total}',$total,$table);
$table = str_replace('${iteration}', $iteration, $table);

echo str_replace('${body}', $addendum_top.$title.$table.$addendum_bottom, $body);

?>
