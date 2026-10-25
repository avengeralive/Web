<?php
$docPath=$small_font?'/docTemplates/daily_registrations/smallfont':'/docTemplates/daily_registrations';
$body = file_get_contents(APP.$docPath.'/body.xml');
$regtbl = file_get_contents(APP.$docPath.'/regtbl.xml');
$exrow = file_get_contents(APP.$docPath.'/exrow.xml');
$researchrow = file_get_contents(APP.$docPath.'/researchrow.xml');
$banrow = file_get_contents(APP.$docPath.'/banrow.xml');
$prodtype = file_get_contents(APP.$docPath.'/prodtype.xml');	
$modbantbl = file_get_contents(APP.$docPath.'/modbantbl.xml');	
$modbanrow = file_get_contents(APP.$docPath.'/modbanrow.xml');	
// pr($modified_bans);

header("Content-Description: File Transfer");
header('Content-Disposition: attachment; filename="' . $date . '.doc"');
header('Content-Type: application/vnd.ms-word');
header('Content-Transfer-Encoding: binary');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Expires: 0');
$LINE_BREAK='<w:p></w:p>';

$curbanrow='';
if (count($modified_bans)!=0)
{
	foreach ($modified_bans as $ban)
	{
		$curbanrow.=$modbanrow;
		$curbanrow=str_replace('${registration_code}',$ban['Registration']['code'],$curbanrow);
		$curbanrow=str_replace('${registration_date}',date_format(date_create($ban['Registration']['date']),'d.m.Y'),$curbanrow);
		$curbanrow=str_replace('${production_name}',$ban['Production']['name'],$curbanrow);
		$curbanrow=str_replace('${ban_type_name}',$ban['BanType']['name'],$curbanrow);
		$curbanrow=str_replace('${ban_weight}',$ban['Ban']['weight'],$curbanrow);
		$curbanrow=str_replace('${ban_reason_name}',$ban['BanReason']['name'],$curbanrow);
		$curbanrow=str_replace('${use_order_name}',$ban['Ban']['use_order'],$curbanrow);
		$curbanrow=str_replace('${ban_note}',$ban['Ban']['note'],$curbanrow);
	}
	$modbantbl = str_replace('${modbanrow}',$curbanrow,$modbantbl);
	$body = str_replace('${modbantbl}',$modbantbl,$body);
}

$body = str_replace('${lab_name}',$registrations[0]['Lab']['name'],$body);
$body = str_replace('${institution_name}',$registrations[0]['Lab']['Institution']['name'],$body);
$body = str_replace('${registration_date}',date_format(date_create($registrations[0]['Registration']['date']),'d.m.Y'),$body);
$curregtbl='';
$curtype = '';
if (count($registrations)!=0)
{
	$curtype = $registrations[0]['ProductionType']['name'];
	$curregtbl.= str_replace('${production_type}',$curtype,$prodtype).$LINE_BREAK;
}
foreach ($registrations as $reg)
{
	if($reg['ProductionType']['name']!=$curtype)
	{	
		$curregtbl.= str_replace('${production_type}',$reg['ProductionType']['name'],$prodtype);
		$curtype = $reg['ProductionType']['name'];
	}
	$curregtbl.= $regtbl;
	$curregtbl = str_replace('${registration_code}',$reg['Registration']['code'],$curregtbl);
	$curregtbl = str_replace('${registration_date}',date_format(date_create($reg['Registration']['date']),'d.m.Y'),$curregtbl);
	$curregtbl = str_replace('${user_name}',$reg['User']['displayname'],$curregtbl);
	$curregtbl = str_replace('${registration_owner}',$reg['Registration']['owner'],$curregtbl);
	$curregtbl = str_replace('${registration_doc_form}',$reg['Registration']['doc_form'],$curregtbl);
	$curregtbl = str_replace('${registration_doc_num}',$reg['Registration']['doc_num'],$curregtbl);
	$curregtbl = str_replace('${registration_doc_date}',date_format(date_create($reg['Registration']['doc_date']),'d.m.Y'),$curregtbl);
	$curregtbl = str_replace('${region_name}',$reg['Region']['name'],$curregtbl);
	$curregtbl = str_replace('${district_name}',$reg['District']['name'],$curregtbl);
	$curregtbl = str_replace('${registration_locality}',$reg['Registration']['locality'],$curregtbl);
	$curregtbl = str_replace('${transport_condition}',$reg['Registration']['transport_condition'],$curregtbl);
	$curregtbl = $curregtbl;
	$curexrow='';
	foreach ($reg['Expertise'] as $ex)
	{	
		$curexrow.=$exrow;
		$curexrow=str_replace('${expertise_num}',$ex['num'],$curexrow);
		$curexrow=str_replace('${production_name}',$ex['Production']['name'],$curexrow);
		$curexrow=str_replace('${expertise_count}',$ex['count'],$curexrow);
		$curexrow=str_replace('${measure_name}',$ex['Production']['measure'],$curexrow);
		$curexrow=str_replace('${expertise_viscera}',$ex['viscera']?"Да":"Нет",$curexrow);
		$curexrow=str_replace('${expertise_total_weight}',$ex['domestic_weight']+$ex['foreign_weight'],$curexrow);
		$curexrow=str_replace('${detection_name}',isset($ex['Detection'][0])?$ex['Detection'][0]['name']:"",$curexrow);//???
		$curexrow=str_replace('${expertise_samples_count}',$ex['samples_count'],$curexrow);
		$curexrow=str_replace('${expertise_conclusion_number}',$ex['conclusion_number'],$curexrow);
		$curexrow=str_replace('${expertise_conclusion_date}',date_format(date_create($ex['conclusion_date']),'d.m.Y'),$curexrow);
		$curexrow=str_replace('${conclusion_name}',isset($ex['conclusion'])?$ex['conclusion']:"",$curexrow);
		$curexrow=str_replace('${expertise_conclusion_weight}',$ex['conclusion_weight'],$curexrow);
		$curexrow=str_replace('${expertise_note}',$ex['note'],$curexrow);
		$curexrow=str_replace('${expertise_price}',"ПУ: ".($ex['price']?$ex['price']:"0")."/"."ГЗ: ".($ex['state_price']?$ex['state_price']:0),$curexrow);
		$curexrow=str_replace('${thermal_state}',$ex['thermal_state'],$curexrow);
		$curexrow=str_replace('${expertise_check_number}',$ex['check_number'],$curexrow);
	}
	$curregtbl=str_replace('${exrow}',$curexrow,$curregtbl);
	
	$curresrow='';
	foreach ($reg['Research'] as $res)
	{	
		$curresrow.=$researchrow;
		$curresrow=str_replace('${production_name}',$res['Production']['name'],$curresrow);
		$curresrow=str_replace('${research_type_name}',$res['ResearchType']['name'],$curresrow);
		$curresrow=str_replace('${research_count}',$res['count'],$curresrow);
		$curresrow=str_replace('${research_result_name}',$res['research_result'],$curresrow);
		$curresrow=str_replace('${research_confirmed}',$res['confirmed']?"Да":"Нет",$curresrow);
		$curresrow=str_replace('${research_indicators}',$res['indicators'],$curresrow);
	}
	$curregtbl=str_replace('${researchrow}',$curresrow,$curregtbl);
	
	$curbanrow='';
	foreach ($reg['Ban'] as $ban)
	{	
		$curbanrow.=$banrow;
		$curbanrow=str_replace('${production_name}',$ban['Production']['name'],$curbanrow);
		$curbanrow=str_replace('${ban_type_name}',$ban['BanType']['name'],$curbanrow);
		$curbanrow=str_replace('${ban_weight}',$ban['weight'],$curbanrow);
		$curbanrow=str_replace('${ban_reason_name}',$ban['BanReason']['name'],$curbanrow);
		$curbanrow=str_replace('${use_order_name}',$ban['use_order'],$curbanrow);
		$curbanrow=str_replace('${ban_note}',$ban['note'],$curbanrow);
	}
	$curregtbl=str_replace('${banrow}',$curbanrow,$curregtbl);
	
}
echo str_replace('${regtbl}',$curregtbl,$body);

?>