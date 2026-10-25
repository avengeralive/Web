<?php
define('START_COLUMN_3',2);
define('END_COLUMN_3',9);

define('START_COLUMN_4',2);
define('END_COLUMN_4',6);

function addValue($cell, $value, $type='Number')
{
	$cell->Data=$value;
	$cell->Data->addAttribute('xmlns:ss:Type',$type);
}
function fillRow($row,$arr,$headers, $start, $end)
{
	for ($col=$start;$col<=$end;$col++)
	{
		if (array_key_exists($headers[$col-$start],$arr))
		{
			addValue($row->Cell[$col],$arr[$headers[$col-$start]]);
		}
	}
}

$file = urlencode('5-ВЕТ.xls');
header("Content-Description: File Transfer");
header('Content-Disposition: attachment; filename="'.$file.'"');
header('Content-Type: application/vnd.ms-excel');
header('Content-Transfer-Encoding: binary');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Expires: 0');
$body = simplexml_load_file(APP.'docTemplates/5-vet.xls');
$body->registerXPathNamespace('main', 'urn:schemas-microsoft-com:office:spreadsheet');

//III
$titlesrow = $body->xpath('.//main:Row[@ID="3Titles"]');
$titlesrow = $titlesrow[0];
$titles = array();
for($col=START_COLUMN_3;$col<=END_COLUMN_3;$col++)
{
	array_push($titles,mb_strtolower((string)$titlesrow->Cell[$col]->Data));
}
//researches
$currow = $body->xpath('.//main:Row[@ID="meat_start"]');
$currow = $currow[0];
fillRow($currow,$totals3_1,$titles,START_COLUMN_3,END_COLUMN_3);
for ($row=0;$row<=4;$row++)
{
	$currow = $currow[0]->xpath('following-sibling::*[1]');
	$currow = $currow[0];
	if (array_key_exists(mb_strtolower((string)$currow->Cell[0]->Data),$data3_1))
	{
		fillRow($currow,$data3_1[mb_strtolower((string)$currow->Cell[0]->Data)],$titles,START_COLUMN_3,END_COLUMN_3);
	}
}
//researches total
$currow = $currow[0]->xpath('following-sibling::*[1]');
$currow = $currow[0];
fillRow($currow,$totals3_2,$titles,START_COLUMN_3,END_COLUMN_3);

//detections
$currow = $currow[0]->xpath('following-sibling::*[1]');
$currow = $currow[0];
fillRow($currow,$totals3_3,$titles,START_COLUMN_3,END_COLUMN_3);
for ($row=0;$row<=25;$row++)
{
	$currow = $currow[0]->xpath('following-sibling::*[1]');
	$currow = $currow[0];

	if (array_key_exists(mb_strtolower((string)$currow->Cell[0]->Data),$data3_3))
	{
		fillRow($currow,$data3_3[mb_strtolower((string)$currow->Cell[0]->Data)],$titles,START_COLUMN_3,END_COLUMN_3);
	}
}
//meat neutralization
$currow = $currow[0]->xpath('following-sibling::*[1]');
$currow = $currow[0];
fillRow($currow,$totals3_4,$titles,START_COLUMN_3,END_COLUMN_3);
for ($row=0;$row<=8;$row++)
{
	$currow = $currow[0]->xpath('following-sibling::*[1]');
	$currow = $currow[0];
	if (array_key_exists(mb_strtolower((string)$currow->Cell[0]->Data),$data3_4))
	{
		fillRow($currow,$data3_4[mb_strtolower((string)$currow->Cell[0]->Data)],$titles,START_COLUMN_3,END_COLUMN_3);
	}
}
//sub neutralization
$currow = $currow[0]->xpath('following-sibling::*[1]');
$currow = $currow[0];
fillRow($currow,$totals3_5,$titles,START_COLUMN_3,END_COLUMN_3);
for ($row=0;$row<=8;$row++)
{
	$currow = $currow[0]->xpath('following-sibling::*[1]');
	$currow = $currow[0];
	if (array_key_exists(mb_strtolower((string)$currow->Cell[0]->Data),$data3_5))
	{
		fillRow($currow,$data3_5[mb_strtolower((string)$currow->Cell[0]->Data)],$titles,START_COLUMN_3,END_COLUMN_3);
	}
}
//utilization
$currow = $currow[0]->xpath('following-sibling::*[1]');
$currow = $currow[0];
fillRow($currow,$totals3_6,$titles,START_COLUMN_3,END_COLUMN_3);
for ($row=0;$row<=7;$row++)
{
	$currow = $currow[0]->xpath('following-sibling::*[1]');
	$currow = $currow[0];
	if (array_key_exists(mb_strtolower((string)$currow->Cell[0]->Data),$data3_5))
	{
		fillRow($currow,$data3_6[mb_strtolower((string)$currow->Cell[0]->Data)],$titles,START_COLUMN_3,END_COLUMN_3);
	}
}
//destruction
$currow = $currow[0]->xpath('following-sibling::*[1]');
$currow = $currow[0];
fillRow($currow,$totals3_7,$titles,START_COLUMN_3,END_COLUMN_3);
for ($row=0;$row<=2;$row++)
{
	$currow = $currow[0]->xpath('following-sibling::*[1]');
	$currow = $currow[0];
	if (array_key_exists(mb_strtolower((string)$currow->Cell[0]->Data),$data3_7))
	{
		fillRow($currow,$data3_7[mb_strtolower((string)$currow->Cell[0]->Data)],$titles,START_COLUMN_3,END_COLUMN_3);
	}
}

//IV
$titlesrow = $body->xpath('.//main:Row[@ID="4Titles"]');
$titlesrow = $titlesrow[0];
$titles = array();
for($col=START_COLUMN_4;$col<=END_COLUMN_4;$col++)
{
	array_push($titles,mb_strtolower((string)$titlesrow->Cell[$col]->Data));
}

//expertises
$currow = $body->xpath('.//main:Row[@ID="prod_start"]');
$currow = $currow[0];
fillRow($currow,$totals4_1,$titles,START_COLUMN_4,END_COLUMN_4);
//researches
$currow = $currow[0]->xpath('following-sibling::*[1]');
$currow = $currow[0];
 fillRow($currow,$totals4_2,$titles,START_COLUMN_4,END_COLUMN_4);
//neutralization
$currow = $currow[0]->xpath('following-sibling::*[1]');
//$currow = $currow[0]->xpath('following-sibling::*[2]');
$currow = $currow[0];
fillRow($currow,$totals4_3,$titles,START_COLUMN_4,END_COLUMN_4);
//utilization
$currow = $currow[0]->xpath('following-sibling::*[1]');
$currow = $currow[0];
fillRow($currow,$totals4_4,$titles,START_COLUMN_4,END_COLUMN_4);
//destruction
$currow = $currow[0]->xpath('following-sibling::*[1]');
$currow = $currow[0];
fillRow($currow,$totals4_5,$titles,START_COLUMN_4,END_COLUMN_4);
//researches
$currow = $currow[0]->xpath('following-sibling::*[1]');
$currow = $currow[0];
for ($row=0;$row<=6;$row++)
{
	$currow = $currow[0]->xpath('following-sibling::*[1]');
	$currow = $currow[0];
	if (array_key_exists(mb_strtolower((string)$currow->Cell[0]->Data),$data4_6))
	{
		fillRow($currow,$data4_6[mb_strtolower((string)$currow->Cell[0]->Data)],$titles,START_COLUMN_4,END_COLUMN_4);
	}
}
echo $body->asXML();
?>
