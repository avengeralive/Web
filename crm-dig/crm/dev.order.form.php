<?php require_once './include.config.php';

require_once(SITE_ROOT.'/vendors/tcpdf/tcpdf.php');
require_once(SITE_ROOT.'/vendors/tcpdf/tcpdf_barcodes_2d.php');
require_once(SITE_ROOT.'/vendors/tcpdf/include/barcodes/datamatrix.php');

class DatamatrixBase256 extends Datamatrix {

// -----------------------------------------------------------------------------
    /**
     * Get high level encoding using the Base256 encoding mode
     * @param $data (string) data to encode
     * @return array of codewords
     * @protected
     */
    protected function getHighLevelEncoding($data) {
        $enc =  ENC_BASE256; // set encoding mode BASE256; //
        $pos = 0; // current position
        $cw = array(); // array of codewords to be returned
        $cw_num = 0; // number of data codewords
        $data_lenght = strlen($data); // number of chars

        $cw[] = $this->getSwitchEncodingCodeword($enc);
        ++$cw_num;

        // initialize temporary array with 0 lenght
        $temp_cw = array();
        $field_lenght = 0;

        while (($pos < $data_lenght) AND ($field_lenght <= 1555)) {
            // 2. Otherwise, process the next character in Base 256 encodation.
            $chr = ord($data[$pos]);
            ++$pos;
            $temp_cw[] = $chr;
            ++$field_lenght;
        }

        // set field lenght
        if ($field_lenght <= 249) {
            $cw[] = $this->get255StateCodeword($field_lenght, ($cw_num + 1));
            ++$cw_num;
        } else {
            $cw[] = intval($this->get255StateCodeword((floor($field_lenght / 250) + 249), ($cw_num + 1)));
            $cw[] = $this->get255StateCodeword(($field_lenght % 250), ($cw_num + 2));
            $cw_num += 2;
        }
        if (!empty($temp_cw)) {
            // add B256 field
            foreach ($temp_cw as $p => $cht) {
                $cw[] = $this->get255StateCodeword($cht,($cw_num + $p + 1));
            }
        }

        return $cw;
    }

} // end DataMatrixBase256 class

class TCPDF2DDatamatrixBarcode extends TCPDF2DBarcode{

    public function __construct($code) {
        $this->setBarcode($code);
    }

    public function setBarcode($code, $type = 'DATAMATRIX') {
        if($type !== 'DATAMATRIX') {
            return parent::setBarcode($code, $type);
        }

        $qrcode = new DatamatrixBase256($code);
        $this->barcode_array = $qrcode->getBarcodeArray();
        $this->barcode_array['code'] = $code;
    }
} // end of class

// create new PDF document
$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8');
//$pdf = new Tcpdf('mm');

// set document information
$pdf->SetCreator('RussianPost');
$pdf->SetAuthor('AvaMed');
$pdf->SetTitle('ORDER');
//$pdf->SetSubject('TCPDF Tutorial');
//$pdf->SetKeywords('TCPDF, PDF, example, test, guide');
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// set default header data
//$pdf->setHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 005', PDF_HEADER_STRING);

// set auto page breaks
$pdf->SetAutoPageBreak(false);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
//if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
//    require_once(dirname(__FILE__).'/lang/eng.php');
//    $pdf->setLanguageArray($l);
//}

// ---------------------------------------------------------

// set font
$pdf->SetFont('dejavusans', '', 10);

// add a page
$pdf->AddPage();

// set cell padding
$pdf->setCellPaddings(1, 1, 1, 1);

// set cell margins
$pdf->setCellMargins(1, 1, 1, 1);

// MultiCell($w, $h, $txt, $border=0, $align='J', $fill=0, $ln=1, $x='', $y='', $reseth=true, $stretch=0, $ishtml=false, $autopadding=true, $maxh=0)

//$pdf->MultiCell(55, 5, '[LEFT] ', 1, 'L', 1, 0, '', '', true);

//$pdf->Image('./priem.jpg', 5, 5, 15, 30, '', '');
$pdf->Image('./priem.jpg', 15, 5, 20, '', '', '');

$pdf->SetFont('dejavusans', '', 10); $pdf->Text(60, 39, "ПОЧТОВЫЙ ПЕРЕВОД на 100 руб. 00 коп. ");
$pdf->Rect(165, 40, 40, 6, 'F', [], [200]);
$pdf->Rect(167, 41.5, 3, 3); $pdf->Line(167, 41.5, 170, 44.5);  $pdf->Line(167, 44.5, 170, 41.5);
$pdf->SetFont('dejavusans', '', 8); $pdf->Text(170, 39.5, 'Наложенный платеж');
$pdf->Rect(60, 46, 145, 5, 'F', [], [200]);
$pdf->SetFont('dejavusans', '', 10);
$pdf->MultiCell(145, 5, 'Сто рублей 00 копеек Сто рублей 00 копеек Сто рублей 00 копеек)', 0, 'L', false, 1, 60, 44);

$pdf->SetFont('dejavusans', 'B', 10);
$pdf->Rect(175, 85, 5, 5); $pdf->Text(174.5, 83.5, '1');
$pdf->Rect(180, 85, 5, 5); $pdf->Text(179.5, 83.5, '1');
$pdf->Rect(185, 85, 5, 5); $pdf->Text(184.5, 83.5, '1');
$pdf->Rect(190, 85, 5, 5); $pdf->Text(189.5, 83.5, '0');
$pdf->Rect(195, 85, 5, 5); $pdf->Text(194.5, 83.5, '2');
$pdf->Rect(200, 85, 5, 5); $pdf->Text(199.5, 83.5, '4');

$pdf->SetFont('dejavusans', '', 4);
$pdf->Text(100, 54.8, '(полное или краткое наименование корпоративного клиента)');
$pdf->Text(100, 60.8, '(индекс объекта почтовой связи, федеральный/региональный клиент, наименование корпоративного клиента)');
$pdf->Text(100, 72.9, '(Фамилия, Имя, а также Отчество (если иное не вытекает из закона или национального обычая) полностью)');
$pdf->Text(100, 82.9, '(адрес места нахождения/пребывания)');

$pdf->SetFont('dejavusans', '', 8);
$pdf->Text(60, 51, 'Кому:');
$pdf->Text(60, 57, 'Куда:');
$pdf->Text(60, 63, 'Сообщение или идентификатор перевода:');
$pdf->Text(60, 69, 'От кого:');
$pdf->Text(60, 74, 'Адрес');
$pdf->Text(60, 77, 'отпра-');
$pdf->Text(60, 80, 'вителя:');

$pdf->Line(75, 57, 205, 57);
$pdf->Line(75, 63, 205, 63);
$pdf->Line(130, 69, 205, 69);
$pdf->Line(75, 75, 205, 75);
$pdf->Line(75, 85, 205, 85);

$pdf->SetFont('dejavusans', '', 10);
$pdf->MultiCell(130, 8, 'ООО "ПИМ (Почта)"', 0, 'L', false, 1, 75, 51);
$pdf->MultiCell(130, 8, '125955 Федеральный клиент ООО "ПИМ (Почта)"', 0, 'L', false, 1, 75, 57);
$pdf->MultiCell(130, 8, '12345678901234', 0, 'L', false, 1, 130, 63);
$pdf->MultiCell(130, 8, 'Худайбердина Шудпан Умуттыковна', 0, 'L', false, 1, 75, 69);
$pdf->MultiCell(130, 8, 'Худайбердина Шудпан Умуттыковна Иванов Иван Ивановичивнчив', 0, 'L', false, 1, 75, 74);

$pdf->SetLineStyle(['width' => 0.6, 'dash' => 0]);
$pdf->Rect(60, 40, 145, 50);
$pdf->SetLineStyle(['width' => 0.1, 'dash' => 0]);


$style = [];
$pdf->Rect(60, 93, 145, 31, '', []);

$pdf->SetFont('dejavusans', '', 8);
$pdf->Text(60, 92, 'Адрес регистрации отправителя:');
$pdf->Line(60, 98, 205, 98); // address
$pdf->Line(60, 103, 205, 103); // address second
$pdf->Line(175, 98, 175, 103); // Index
$pdf->Line(180, 98, 180, 103); //
$pdf->Line(185, 98, 185, 103); //
$pdf->Line(190, 98, 190, 103); //
$pdf->Line(195, 98, 195, 103); //
$pdf->Line(200, 98, 200, 103); //

$pdf->Line(60, 113, 205, 113); // issuer
$pdf->Line(60, 118, 205, 118); // code
for($k=1; $k<=12; $k++) $pdf->Line(205-$k*3, 113, 205-$k*3, 118);

$pdf->Text(60, 103, 'Предъявлен'); $pdf->Line(81, 108, 106, 108);
$pdf->Text(105, 103, 'Серия'); $pdf->Line(116, 108, 131, 108);
$pdf->Text(130, 103, '№'); $pdf->Line(135, 108, 156, 108);
$pdf->Text(155, 103, 'выдан'); $pdf->Line(167, 108, 205, 108);

$pdf->Text(60, 118, 'Гражданство:'); $pdf->Line(83, 123, 116, 123);
$pdf->Text(120, 118, 'Дата рождения:'); $pdf->Line(147, 123, 185, 123);


$pdf->Rect(10, 124, 195, 9);
$pdf->SetFont('dejavusans', '', 4);
$pdf->Text(195, 5, 'ф.112ЭК');
$pdf->Text(60, 89, 'Обведенное тонкой линией заполняется отправителем перевода');
$pdf->Text(70, 96, '(адрес места жительства/регистрации, заполняется при несовпадении с адресом отправителя, а также до востребования или на а/я)');
$pdf->Text(185, 101, '(индекс)');
$pdf->Text(70, 106, '(наименование документа, удостоверяющего личность)');
$pdf->Text(80, 111, '(наименование учреждения, выдавшего документ)');
$pdf->Text(80, 116, '(код подразделения если имеется)');
$pdf->Text(163, 112, 'ИНН');
$pdf->Text(153, 114, '(при его наличии)');
$pdf->MultiCell(130, 10, 'Являетесь ли Вы должностным лицом публичных международных организаций или лицом, замещающим (занимающим) государственные должности Российской Федерации, должности членов Совета директоров Центрального банка Российской Федерации, должности федеральной государственной службы, назначение на которые и освобождение от которых осуществляются Президентом Российской Федерации или Правительством Российской Федерации, должности в Центральном банке Российской Федерации, государственных корпорациях и иных организациях, созданных Российской Федерацией на основании Федеральных законов, включенных в перечни должностей, определяемые Президентом Российской Федерации', 0, 'L', false, 1, 10, 122);
$pdf->MultiCell(190, 5, 'Согласен(на) на направление информации о новых сервисах и услугах, оказываемых в отделениях почтовой связи на указанный выше мною номер моб. телефона отправителя. Подтверждаю, что данный номер является моим номером моб. телефона, выделенным мне оператором сотовой связи.', 0, 'L', false, 1, 15, 131);
$pdf->MultiCell(120, 10, 'В целях осуществления данного почтового перевода подтверждаю свое согласие:
- на обработку как автоматизированным, так и неавтоматизированным способом указанных на бланке персональных данных;
- на передачу информации о номере почтового перевода, о событии (о перечислении почтового перевода на счет получателя, о дате и месте совершения события).
Также подтверждаю своё согласие на передачу номера почтового перевода и событий третьему лицу в целях передачи SMS-сообщений по сетям связи.', 0, 'L', false, 1, 10, 136);
$pdf->Text(183, 143, '(подпись оператора)');

$pdf->StartTransform();
$pdf->Rotate(90, 140, -63);
$pdf->Text(0, 0, 'Исправления не допускаются');
$pdf->StopTransform();

$pdf->StartTransform();
$pdf->Rotate(90, 165, -38);
$pdf->Text(0, 0, 'Исправления не допускаются');
$pdf->StopTransform();

$pdf->StartTransform();
$pdf->Rotate(90, 71, 15);
$pdf->Text(0, 0, 'Обведенное жирной линией заполняется клиентом');
$pdf->StopTransform();

$pdf->Rect(12, 134, 2, 2);

$pdf->SetFont('dejavusans', '', 8);
$pdf->Text(140, 124.5, 'Подпись');
$pdf->Rect(185, 127, 2, 2); $pdf->Text(186, 124.5, 'Да');
$pdf->Rect(195, 127, 2, 2); $pdf->Text(196, 124.5, 'Нет');
$pdf->Text(130, 136, 'Подпись');
$pdf->Text(130, 140, 'отправителя');

$pdf->Rect(10, 133, 195, 4);
$pdf->Rect(10, 137, 170, 10);

$data = '!!77!!!3!1!1709.00!3!0!140012!Московская область!ул.Советская, корп.1, д.5, кв.54, г.Люберцы!Иванов Иван Иванович!!!!!!!!!106000!Москва!!ООО «Реструктуризация»!!9898!044579195!40702810500000077501!30103810600000000490!ЗАО«Банк» г.Москва!10203971045828!!!!1';
$data = iconv('UTF-8', 'Windows-1251', $data);
//$pdf->write2DBarcode($data, 'DATAMATRIX', 150, 5, 33, 33);
$barcode_obj = new TCPDF2DDatamatrixBarcode($data);
$png = $barcode_obj->getBarcodePngData(2, 2, array(0,0,0));
$pdf->Image('@' . $png, 150, 5, 40, 40, 'PNG', '', 'T', true, 300);


$pdf->write1DBarcode('026352', 'I25', 15, 40, 30, 15, '', ['border' => false, 'stretch' => true, 'text' => true], 'N');

$pdf->Line(5, 150, 205, 150);


if (true) {

    $pdf->StartTransform();
$pdf->Translate(0, -5);
//    $pdf->Translate(0, -100);

    $pdf->write1DBarcode('12345678901234', 'I25', 5, 163, 55, 20, '', ['border' => false, 'stretch' => true], 'N');
//$pdf->MultiCell(160, 10, '123456 78 90123 4', 0, 'C', false, 0, -40, 175);
    $pdf->Text(15, 180, '123456 78 90123 4');

//$pdf->Image('./rp.jpg', 5, 20, 20, 10);
    $pdf->Image('./rp.png', 5, 190, 30, 15, '', '');

    $pdf->SetFont('dejavusans', 'B', 12);
    $pdf->Text(40, 190, "002");

    $pdf->SetFont('dejavusans', 'B', 20);
    $pdf->Text(70, 160, "ПОСЫЛКА ОНЛАЙН");

    $pdf->Rect(110, 172, 2, 2);
    $pdf->SetFont('dejavusans', '', 6);
    $pdf->Text(111, 170, 'С объявленной ценностью');
    $pdf->Rect(110, 177, 2, 2);
    $pdf->SetFont('dejavusans', '', 6);
    $pdf->Text(111, 175, 'С наложенным платежом');
    $pdf->Rect(110, 182, 2, 2);
    $pdf->SetFont('dejavusans', '', 6);
    $pdf->Text(111, 180, 'С проверкой комплектности');

    $pdf->setAlpha(0.1);
    $pdf->Rect(120, 187, 41, 5);
    $pdf->SetFont('dejavusans', '', 7);
    $pdf->Text(124, 186, 'Возврату не подлежит');
    $pdf->setAlpha(1.0);

    $pdf->Rect(175, 165, 30, 28);
//$pdf->Rect();
    $pdf->SetFont('dejavusans', '', 6);
    $pdf->Text(177, 160, 'ф.7-п. версия 06.2016');
    $pdf->Text(180, 163, 'ПОЧТА РОССИИ');
    $pdf->Text(180, 166, 'Марушкинское');
    $pdf->Text(180, 169, '27.09.2020');
    $pdf->Text(180, 172, '102961');

    $pdf->Text(188, 186, 'Оттиск КПШ');
    $pdf->Text(181, 188, 'ОПС места приёма');

    $pdf->SetFont('dejavusans', 'B', 15);
    $pdf->Text(5, 205, 'Отправитель');
    $pdf->SetFont('dejavusans', 'B', 10);
    $pdf->Text(5, 211, 'От кого');
    $pdf->SetFont('dejavusans', '', 10);
    $pdf->MultiCell(95, 10, 'ООО "ПИОНЕР" (ЕСПП 026352)', 0, 'L', false, 1, 5, 217);
    $pdf->SetFont('dejavusans', 'B', 10);
    $pdf->Text(5, 227, 'Откуда');
    $pdf->SetFont('dejavusans', '', 10);
    $pdf->MultiCell(95, 10, 'Шарапово,д.1,Марушкинское,Москва', 0, 'L', false, 1, 5, 233);

    $pdf->SetFont('dejavusans', '', 6);
    $pdf->Text(70, 243, 'ИНДЕКС ОТПРАВИТЕЛЯ');
    $pdf->SetFont('dejavusans', 'B', 15);
    $pdf->Rect(40, 248, 10, 10); $pdf->Text(41, 248, '1');
    $pdf->Rect(50, 248, 10, 10); $pdf->Text(51, 248, '0');
    $pdf->Rect(60, 248, 10, 10); $pdf->Text(61, 248, '2');
    $pdf->Rect(70, 248, 10, 10); $pdf->Text(71, 248, '9');
    $pdf->Rect(80, 248, 10, 10); $pdf->Text(81, 248, '6');
    $pdf->Rect(90, 248, 10, 10); $pdf->Text(91, 248, '1');

    $pdf->SetFont('dejavusans', '', 6);
    $pdf->Text(5, 247, 'Телефон для извещения');
    $pdf->SetFont('dejavusans', '', 8);
    $pdf->Text(5, 250, '');
    $pdf->Rect(7, 256, 2, 2);
    $pdf->SetFont('dejavusans', '', 6);
    $pdf->Text(8, 254, 'C SMS-уведомлением');

    $pdf->Rect(5, 260, 95, 18);
    $pdf->SetFont('dejavusans', 'B', 7);
    $pdf->Text(5, 259, 'Запрещенных к пересылке вложений нет.');
    $pdf->SetFont('dejavusans', 'B', 7);
    $pdf->Text(5, 262, 'В случае объективной невозможности пересылки воздушным');
    $pdf->SetFont('dejavusans', 'B', 7);
    $pdf->Text(5, 265, 'транспортом:');
    $pdf->Rect(7, 271, 2, 2);
    $pdf->SetFont('dejavusans', '', 6);
    $pdf->Text(8, 269, 'Вернуть по обратному адресу');
    $pdf->Rect(7, 274, 2, 2);
    $pdf->Line(7, 274, 9, 276);
    $pdf->Line(7, 276, 9, 274);
    $pdf->SetFont('dejavusans', '', 6);
    $pdf->Text(8, 272, 'Направить наземным транспортом');
    $pdf->SetFont('dejavusans', '', 7);
    $pdf->Text(50, 269, 'ООО "ПИОНЕР" (ЕСПП 026352)');
    $pdf->Line(50, 274, 98, 274);
    $pdf->SetFont('dejavusans', '', 5);
    $pdf->Text(62, 272, '(подпись отправителя)');


    $pdf->Rect(5, 280, 95, 15);
    $pdf->SetFont('dejavusans', 'B', 7);
    $pdf->Text(5, 279, 'Заполняется оператором, особые отметки');
    $pdf->Rect(7, 285, 2, 2);
    $pdf->SetFont('dejavusans', '', 6);
    $pdf->Text(8, 283, 'Посылка Стандарт');
    $pdf->Rect(7, 288, 2, 2);
    $pdf->SetFont('dejavusans', '', 6);
    $pdf->Text(8, 286, 'Посылка Экспресс');
    $pdf->Rect(7, 291, 2, 2);
    $pdf->SetFont('dejavusans', '', 6);
    $pdf->Text(8, 289, 'Посылка Курьер');
    $pdf->Rect(45, 285, 2, 2);
    $pdf->SetFont('dejavusans', '', 6);
    $pdf->Text(46, 283, 'Нестандартная');
    $pdf->Rect(45, 288, 2, 2);
    $pdf->SetFont('dejavusans', '', 6);
    $pdf->Text(46, 286, 'Нестандартная негабаритная');


    $pdf->Rect(110, 195, 95, 8, 'F', [], [200]);
    $pdf->SetFont('dejavusans', '', 8);
    $pdf->MultiCell(95, 8, '100,00 (Сто рублей 00 копеек) 100,00 (Сто рублей 00 копеек) 100,00 (Сто рублей 00 копеек)', 0, 'L', false, 1, 110, 193);
    $pdf->SetFont('dejavusans', '', 5);
    $pdf->Text(125, 199, '(сумма объявленной ценности цифрами и прописью, руб.)');

    $pdf->Rect(110, 205, 95, 8, 'F', [], [200]);
    $pdf->SetFont('dejavusans', '', 8);
    $pdf->MultiCell(95, 8, '100,00 (Сто рублей 00 копеек) 100,00 (Сто рублей 00 копеек) 100,00 (Сто рублей 00 копеек)', 0, 'L', false, 1, 110, 203);
    $pdf->SetFont('dejavusans', '', 5);
    $pdf->Text(125, 209, '(сумма наложенного платежа цифрами и прописью, руб. коп.)');

    $pdf->SetFont('dejavusans', 'B', 15);
    $pdf->Text(110, 213, 'Адресат');
    $pdf->SetFont('dejavusans', 'B', 10);
    $pdf->Text(110, 219, 'Кому');
    $pdf->SetFont('dejavusans', '', 10);
    $pdf->MultiCell(95, 10, 'Худайбердина Шудпан Умуттыковна Иванов Иван Ивановичивнчив', 0, 'L', false, 1, 110, 225);
    $pdf->SetFont('dejavusans', 'B', 10);
    $pdf->Text(110, 235, 'Куда');
    $pdf->SetFont('dejavusans', '', 10);
    $pdf->MultiCell(95, 25, 'Худайбердина Шудпан Умуттыковна Иванов Иван Ивановичивнчив', 0, 'L', false, 1, 110, 241);

    $pdf->SetFont('dejavusans', '', 6);
    $pdf->Text(175, 268, 'ИНДЕКС ПОЛУЧАТЕЛЯ');
    $pdf->SetFont('dejavusans', 'B', 15);
    $pdf->Rect(145, 273, 10, 10); $pdf->Text(146, 273, '1');
    $pdf->Rect(155, 273, 10, 10); $pdf->Text(156, 273, '1');
    $pdf->Rect(165, 273, 10, 10); $pdf->Text(166, 273, '1');
    $pdf->Rect(175, 273, 10, 10); $pdf->Text(176, 273, '0');
    $pdf->Rect(185, 273, 10, 10); $pdf->Text(186, 273, '2');
    $pdf->Rect(195, 273, 10, 10); $pdf->Text(196, 273, '4');

    $pdf->SetFont('dejavusans', '', 6);
    $pdf->Text(110, 272, 'Телефон для извещения');
    $pdf->SetFont('dejavusans', '', 8);
    $pdf->Text(110, 275, '74951234567');
    $pdf->Rect(112, 281, 2, 2);
    $pdf->SetFont('dejavusans', '', 6);
    $pdf->Text(113, 279, 'C SMS-уведомлением');

    $pdf->Rect(110, 285, 95, 10);
    $pdf->SetFont('dejavusans', '', 7);
    $pdf->Text(110, 287, 'Вес');
    $pdf->Text(116, 287, '1 кг 0 гр');
    $pdf->Line(118, 292, 140, 292);
    $pdf->SetFont('dejavusans', '', 7);
    $pdf->Text(140, 287, 'Плата');
    $pdf->Text(150, 287, '114 руб 50 коп');
    $pdf->Line(152, 292, 175, 292);
    $pdf->Line(177, 292, 203, 292);
    $pdf->SetFont('dejavusans', '', 5);
    $pdf->Text(179, 290, '(подпись оператора)');

    $pdf->StopTransform();

}

//Close and output PDF document
$pdf->Output('order.pdf', 'I'); exit;
