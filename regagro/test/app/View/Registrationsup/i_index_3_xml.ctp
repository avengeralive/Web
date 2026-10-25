<?php 
$file = 'Аналитический отчет 3.doc';
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
$top = str_replace('${title_line_2}','О СНЯТОЙ С РЕАЛИЗАЦИИ ПРОДУКЦИИ',$top);
$bottom = str_replace('${signer_job}', $signer_job, $bottom);
$bottom = str_replace('${signer_name}', $signer_name, $bottom);

function drawTable($headerText, $data) {
	$table = file_get_contents(APP.'/docTemplates/indexi/i3/table.xml');
	$header = file_get_contents(APP.'/docTemplates/indexi/header.xml');
		
	$report_production_row = file_get_contents(APP.'/docTemplates/indexi/i3/report_production_row.xml');
	$report_production_total_row = file_get_contents(APP.'/docTemplates/indexi/i3/report_production_total_row.xml');
	$report_production_eggs_total_row = file_get_contents(APP.'/docTemplates/indexi/i3/report_production_eggs_total_row.xml');
	$production_type_row = file_get_contents(APP.'/docTemplates/indexi/i3/production_type_row.xml');
	$production_type_total_row = file_get_contents(APP.'/docTemplates/indexi/i3/production_type_total_row.xml');
	$use_order_row = file_get_contents(APP.'/docTemplates/indexi/i3/use_order_row.xml');
	$use_order_total_row = file_get_contents(APP.'/docTemplates/indexi/i3/use_order_total_row.xml');
	$ban_reason_row = file_get_contents(APP.'/docTemplates/indexi/i3/ban_reason_row.xml');
	$ban_reason_total_row = file_get_contents(APP.'/docTemplates/indexi/i3/ban_reason_total_row.xml');
	$report_ban_type_row = file_get_contents(APP.'/docTemplates/indexi/i3/report_ban_type_row.xml');	
	
	$header = str_replace('${header}', $headerText, $header);
	$iteration = '';
	$prev_report_production  = '';
	$prev_production_type    = '';
	$prev_use_order          = '';
	$prev_ban_reason         = '';
	$prev_report_ban_type    = '';
	$ban_reason_total 		 = 0;
	$use_order_total  		 = 0;
	$production_type_total   = 0;
	$report_production_total = 0;
	$report_production_eggs_total = 0;
	$total                   = 0;

	foreach ($data as $index => $row)
	{
		if ($prev_report_production!=$row['ReportProduction']['name'])
		{
			$currow = $report_production_row;
			if ($prev_report_production!='')
			{
				$currow = $ban_reason_total_row . $use_order_total_row . $production_type_total_row . $report_production_total_row . $report_production_eggs_total_row . $currow;
				// if ($report_production_total>0) {
				// 	$temprow .= $report_production_total_row;
				// }
				// if ($report_production_eggs_total>0) {
				// 	$temprow .= $report_production_eggs_total_row;
				// }
				// $currow = $temprow . $currow;
				$currow = str_replace('${report_production_total}', number_format($report_production_total,2), $currow);
				$currow = str_replace('${report_production_eggs_total}', number_format($report_production_eggs_total,2), $currow);
				$currow = str_replace('${production_type_total}', number_format($production_type_total,2), $currow);
				$currow = str_replace('${use_order_total}', number_format($use_order_total,2), $currow);
				$currow = str_replace('${ban_reason_total}', number_format($ban_reason_total,2), $currow);
			}
			$report_production_total = 0;
			$report_production_eggs_total = 0;
			$production_type_total = 0;
			$use_order_total = 0;
			$ban_reason_total = 0;
		} else {
			if ($prev_production_type != $row['ProductionType']['name']) 
			{
				$currow = $production_type_row;
				$currow = $ban_reason_total_row . $use_order_total_row . $production_type_total_row . $currow;
				$currow = str_replace('${production_type_total}', number_format($production_type_total,2), $currow);
				$currow = str_replace('${use_order_total}', number_format($use_order_total,2), $currow);
				$currow = str_replace('${ban_reason_total}', number_format($ban_reason_total,2), $currow);
				$production_type_total = 0;
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
						if ($prev_report_ban_type!=$row['ReportBanType']['name'])
						{
							$currow = $report_ban_type_row;
						}
					}
				}
			}
		}
		if (strpos($row['ProductionType']['name'], 'Яйцо')===false){
			$report_production_total += (float)$row[0]['weight'];
		} else {
			$report_production_eggs_total += (float)$row[0]['weight'];	
		}
		$production_type_total += (float)$row[0]['weight'];
		$use_order_total += (float)$row[0]['weight'];
		$ban_reason_total += (float)$row[0]['weight'];
		$total += (float)$row[0]['weight'];
		$currow = str_replace('${report_production_name}', $row['ReportProduction']['name'], $currow);
		$currow = str_replace('${production_type_name}', $row['ProductionType']['name'], $currow);
		$currow = str_replace('${use_order_name}', $row['Ban']['use_order'], $currow);
		$currow = str_replace('${ban_reason_name}', $row['BanReason']['name'], $currow);
		$currow = str_replace('${report_ban_type_name}', $row['ReportBanType']['name'], $currow);
		$currow = str_replace('${weight}', number_format($row[0]['weight'],2), $currow);
		
		if($index==count($data)-1)
		{
			$currow .= $ban_reason_total_row . $use_order_total_row . $production_type_total_row . $report_production_total_row . $report_production_eggs_total_row;
			// if ($report_production_total>0) {
			// 	$currow .= $report_production_total_row;
			// }
			// if ($report_production_eggs_total>0) {
			// 	$currow .= $report_production_eggs_total_row;
			// }
			$currow = str_replace('${report_production_total}', number_format($report_production_total,2), $currow);
			$currow = str_replace('${report_production_eggs_total}', number_format($report_production_eggs_total,2), $currow);
			$currow = str_replace('${production_type_total}', number_format($production_type_total,2), $currow);
			$currow = str_replace('${use_order_total}' , number_format($use_order_total, 2), $currow);
			$currow = str_replace('${ban_reason_total}', number_format($ban_reason_total,2), $currow);
		}
		
		$iteration.= $currow;
		$prev_report_production = $row['ReportProduction']['name'];
		$prev_production_type = $row['ProductionType']['name'];
		$prev_use_order = $row['Ban']['use_order'];
		$prev_ban_reason = $row['BanReason']['name'];
		$prev_report_ban_type = $row['ReportBanType']['name'];
	}
				
	$table = str_replace('${total}',$total,$table);
	$table = str_replace('${iteration}', $iteration, $table);
	return $header.$table;
}
$domesticTable = drawTable('1. Продукция отечественного производства', $domestic_data);
$foreignTable = drawTable('2. Продукция импортного производства', $foreign_data);
echo str_replace('${body}', $top
								.$domesticTable
								.$page_break
								.$foreignTable
							.$bottom, $body);
?>