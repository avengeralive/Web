<?php 
$file = urlencode('Аналитический отчет 14.doc');
header("Content-Description: File Transfer");
header('Content-Disposition: attachment; filename="' . $file . '"');
header('Content-Type: application/vnd.ms-word');
header('Content-Transfer-Encoding: binary');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Expires: 0');

$body = file_get_contents(APP.'/docTemplates/indexi/i14/body.xml');

$body = str_replace('${date_from}', date_format(date_create($date_from),'d.m.Y'), $body);
$body = str_replace('${date_to}', date_format(date_create($date_to),'d.m.Y'), $body);
$body = str_replace('${institution_name}', $institution_name, $body);
$body = str_replace('${org_type}', $org_type, $body);
$body = str_replace('${org_name}', $org_name, $body);
$body = str_replace('${signer_job}', $signer_job, $body);
$body = str_replace('${signer_name}', $signer_name, $body);

function drawTable($data) {

	$detection_type_name_row = file_get_contents(APP.'/docTemplates/indexi/i14/detection_type_name_row.xml');
    $detection_type_total_row = file_get_contents(APP.'/docTemplates/indexi/i14/detection_type_total_row.xml');
    
    $detection_name_row = file_get_contents(APP.'/docTemplates/indexi/i14/detection_name_row.xml');
    $detection_name_total_row = file_get_contents(APP.'/docTemplates/indexi/i14/detection_name_total_row.xml');
    
    $region_name_row = file_get_contents(APP.'/docTemplates/indexi/i14/region_name_row.xml');
    $region_total_row = file_get_contents(APP.'/docTemplates/indexi/i14/region_total_row.xml');
    
    $district_name_row = file_get_contents(APP.'/docTemplates/indexi/i14/district_name_row.xml');
    $district_total_row = file_get_contents(APP.'/docTemplates/indexi/i14/district_total_row.xml');
    
    $production_type_name_row = file_get_contents(APP.'/docTemplates/indexi/i14/production_type_name_row.xml');
    $production_type_total_row = file_get_contents(APP.'/docTemplates/indexi/i14/production_type_total_row.xml');
    
    $report_production_name_row = file_get_contents(APP.'/docTemplates/indexi/i14/report_production_name_row.xml');
    $report_production_total_row = file_get_contents(APP.'/docTemplates/indexi/i14/report_production_total_row.xml');
    
    $detection_count_row = file_get_contents(APP.'/docTemplates/indexi/i14/detection_count_row.xml');

	$iteration = '';
    
	$prev_detection_type = $prev_detection_name = $prev_region_name = $prev_district_name =
        $prev_report_production = $prev_production_type = '';
	$detection_type_total = $detection_total = $region_total = $district_total =
        $report_production_total = $production_type_total = 0;

	foreach ($data as $index => $row)
	{
		$cur_detection_type = $row['DetectionType']['name'];
		$cur_detection_name = $row['Detection']['name'];
        $cur_region_name = $row['Region']['name'];
        $cur_district_name = $row['District']['name'];
        $cur_report_production = $row['ReportProduction']['name'];
        $cur_production_type = $row['ProductionType']['name'];
		
		if ($prev_detection_type != $cur_detection_type)
		{
			$currow = $detection_type_name_row;
			if($prev_detection_type != '') 
			{
				$currow = $production_type_total_row . $report_production_total_row . $district_total_row . $region_total_row 
                          . $detection_name_total_row . $detection_type_total_row . $currow;
                $currow = str_replace('${production_type_total}', $production_type_total, $currow);
				$currow = str_replace('${report_production_total}', $report_production_total, $currow);
				$currow = str_replace('${district_total}', $district_total, $currow);
				$currow = str_replace('${region_total}', $region_total, $currow);
				$currow = str_replace('${detection_name_total}', $detection_total, $currow);
				$currow = str_replace('${detection_type_total}', $detection_type_total, $currow);
			}
			$detection_type_total = $detection_total = $region_total = $district_total =
                $report_production_total = $production_type_total = 0;
		} else {
			if($prev_detection_name != $cur_detection_name)
			{
				$currow = $detection_name_row;
				$currow = $production_type_total_row . $report_production_total_row . $district_total_row . $region_total_row 
                          . $detection_name_total_row . $currow;
				$currow = str_replace('${production_type_total}', $production_type_total, $currow);
				$currow = str_replace('${report_production_total}', $report_production_total, $currow);
				$currow = str_replace('${district_total}', $district_total, $currow);
				$currow = str_replace('${region_total}', $region_total, $currow);
				$currow = str_replace('${detection_name_total}', $detection_total, $currow);	
				$detection_total = $region_total = $district_total =
                    $report_production_total = $production_type_total = 0;
			} else {
                if($prev_region_name != $cur_region_name)
                {
                    $currow = $region_name_row;
                    $currow = $production_type_total_row . $report_production_total_row . $district_total_row . $region_total_row . $currow;
                    $currow = str_replace('${production_type_total}', $production_type_total, $currow);
                    $currow = str_replace('${report_production_total}', $report_production_total, $currow);
                    $currow = str_replace('${district_total}', $district_total, $currow);
                    $currow = str_replace('${region_total}', $region_total, $currow);
                    $region_total = $district_total = $report_production_total = $production_type_total = 0;
                } else {
                    if($prev_district_name != $cur_district_name)
                    {
                        $currow = $district_name_row;
                        $currow = $production_type_total_row . $report_production_total_row . $district_total_row . $currow;
                        $currow = str_replace('${production_type_total}', $production_type_total, $currow);
                        $currow = str_replace('${report_production_total}', $report_production_total, $currow);
                        $currow = str_replace('${district_total}', $district_total, $currow);
                        $district_total = $report_production_total = $production_type_total = 0;
                    } else {
                        if($prev_report_production != $cur_report_production) 
                        {
                            $currow = $report_production_name_row;
                            $currow = $production_type_total_row . $report_production_total_row . $currow;
                            $currow = str_replace('${production_type_total}', $production_type_total, $currow);
                            $currow = str_replace('${report_production_total}', $report_production_total, $currow);
                            $report_production_total = $production_type_total = 0;
                        } else {
                            if($prev_production_type != $cur_production_type)
                            {
                                $currow = $production_type_name_row;
                                $currow = $production_type_total_row . $currow;
                                $currow = str_replace('${production_type_total}', $production_type_total, $currow);
                                $production_type_total = 0;
                            } else {
                                $currow = $detection_count_row;
                            }
                        }
                    }
			    }
            }
		}
        
        $detection_count = $row['Detection']['count'];
		$detection_type_total += $detection_count;
        $detection_total += $detection_count;
        $region_total += $detection_count;
        $district_total += $detection_count;
        $report_production_total += $detection_count;
        $production_type_total += $detection_count;

		$currow = str_replace('${detection_type_name}', $cur_detection_type, $currow);
        $currow = str_replace('${detection_name}', $cur_detection_name, $currow);
        $currow = str_replace('${region_name}', $cur_region_name, $currow);
        $currow = str_replace('${district_name}', $cur_district_name, $currow);
        $currow = str_replace('${report_production_name}', $cur_report_production, $currow);
        $currow = str_replace('${production_type_name}', $cur_production_type, $currow);
        $currow = str_replace('${registration_doc_form}', $row['Registration']['doc_form'], $currow);
        $currow = str_replace('${registration_doc_num}', $row['Registration']['doc_num'], $currow);
        $currow = str_replace('${registration_doc_date}', $row['Registration']['doc_date'], $currow);
        $currow = str_replace('${registration_owner}', $row['Registration']['owner'], $currow);
        $currow = str_replace('${detection_count}', $detection_count, $currow);
        $currow = str_replace('${lab_name}', $row['Lab']['name'], $currow);
        $currow = str_replace('${registration_code}', $row['Registration']['code'], $currow);
		
		if($index==count($data)-1)
		{
            $currow .= $production_type_total_row . $report_production_total_row . $district_total_row . $region_total_row . $detection_name_total_row . $detection_type_total_row;
			$currow = str_replace('${production_type_total}', $production_type_total, $currow);
            $currow = str_replace('${report_production_total}', $report_production_total, $currow);
            $currow = str_replace('${district_total}', $district_total, $currow);
            $currow = str_replace('${region_total}', $region_total, $currow);
            $currow = str_replace('${detection_name_total}', $detection_total, $currow);
            $currow = str_replace('${detection_type_total}', $detection_type_total, $currow);
		}
		
		$iteration.= $currow;
        $prev_detection_type = $cur_detection_type;
        $prev_detection_name = $cur_detection_name;
        $prev_region_name = $cur_region_name;
        $prev_district_name = $cur_district_name;
        $prev_report_production = $cur_report_production;
        $prev_production_type = $cur_production_type;
	}

	return $iteration;
}

echo str_replace('${iteration}', drawTable($data), $body);
?>


