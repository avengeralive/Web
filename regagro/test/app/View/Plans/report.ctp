<?php
require __DIR__ . '../../../vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="report.xlsx"');
header('Cache-Control: max-age=0');

$inputFileName = APP.'/docTemplates/plans_fact.xlsx';

$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileName);

$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');

$rowsCount = count($data['rows']);
$startRowIdx = 8;
$totalsIdx = $startRowIdx + $rowsCount;

$sheet = $spreadsheet->getActiveSheet();

if($rowsCount > 1) {
    $sheet->insertNewRowBefore(9, $rowsCount - 1);
}

$rowIdx = $startRowIdx;
$expCountTotal = 0;
$planCountTotal = 0;
$expPriceTotal = 0;
$planPriceTotal = 0;

foreach ($data['rows'] as $row)
{
    $sheet->setCellValue("A$rowIdx", $row['ProductionType']['name']);
    $sheet->setCellValue("B$rowIdx", $row['Plan']['count']);
    $sheet->setCellValue("C$rowIdx", $row['Expertise']['count']);
    $sheet->setCellValue("D$rowIdx", $row['Plan']['count_prc']);
    $sheet->setCellValue("E$rowIdx", $row['Plan']['price']);
    $sheet->setCellValue("F$rowIdx", $row['Expertise']['price']);
    $sheet->setCellValue("G$rowIdx", $row['Plan']['price_prc']);
    $sheet->setCellValue("H$rowIdx", $row['Plan']['nds_price']);
    $sheet->setCellValue("I$rowIdx", $row['Expertise']['nds_price']);
    $sheet->setCellValue("J$rowIdx", $row['Plan']['nds_price_prc']);
    $rowIdx++;

    $expCountTotal += $row['Expertise']['count'];
    $planCountTotal += $row['Plan']['count'];
    $expPriceTotal += $row['Expertise']['price'];
    $planPriceTotal += $row['Plan']['price'];
}

$planPriceTotalWithNds = ($planPriceTotal * 100) / 118;
$expPriceTotalWithNds = ($expPriceTotal * 100) / 118;

$sheet->setCellValue("B$totalsIdx", $planCountTotal);
$sheet->setCellValue("C$totalsIdx", $expCountTotal);
$sheet->setCellValue("D$totalsIdx", $planCountTotal == 0 ? '' : ($expCountTotal / $planCountTotal) * 100);
$sheet->setCellValue("E$totalsIdx", $planPriceTotal);
$sheet->setCellValue("F$totalsIdx", $expPriceTotal);
$sheet->setCellValue("G$totalsIdx", $planPriceTotal == 0 ? '' : ($expPriceTotal / $planPriceTotal) * 100);
$sheet->setCellValue("H$totalsIdx", $planPriceTotalWithNds);
$sheet->setCellValue("I$totalsIdx", $expPriceTotalWithNds);
$sheet->setCellValue("J$totalsIdx", $planPriceTotalWithNds == 0 ? '' : ($expPriceTotalWithNds / $planPriceTotalWithNds) * 100);

$sheet->setCellValue("A1", $data['organ']);
$sheet->setCellValue("A2", $data['institution']);
$sheet->setCellValue("A3", $data['lab']);
$sheet->setCellValue("F4", \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($data['from']));
$sheet->setCellValue("H4", \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($data['to']));

$writer->save('php://output');

$spreadsheet->disconnectWorksheets();
unset($spreadsheet);
?>
