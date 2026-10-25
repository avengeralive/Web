<?php require_once 'include.config.php';
/** @var mysqli $db */

const LOGGING = true;

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
//            return parent::setBarcode($code, $type);
            parent::setBarcode($code, $type);
        }

        $qrcode = new DatamatrixBase256($code);
        $this->barcode_array = $qrcode->getBarcodeArray();
        $this->barcode_array['code'] = $code;
    }
} // end of class

/**
 *
 * Точка входа для интеграции Почты России с RetailCRM для печати бланка заказа
 *
 */

$date = date('Y-m-d H:i:s');
$request = print_r($_REQUEST, true);

$print = json_decode($_REQUEST['print'], true);

$id = $print['deliveryIds'][0][0];

// Получаем данные по заказу
$prev = $db->query("select * from rp_orders where delivery_id='$id' limit 1")->fetch_assoc();
$account = $db->query("select * from rp_accounts where id='$prev[rp_account_id]'")->fetch_assoc();
$espp = json_decode($account['data'], true);

if (LOGGING) file_put_contents('rp.print.log', "$date - ".RP::json_print($print)."\n\n", FILE_APPEND);

// Получаем данные из Почты запросом по номеру заказа
$order = RP::getOrder($id, $espp['auth'], $espp['user']);
if (LOGGING) file_put_contents('rp.print.log', "$date - ".RP::json_print($order)."\n\n", FILE_APPEND);

// Если по номеру заказа не получилось получить данные (например, отправление уже в партии),
// то пробуем получить по ШПИ
if (empty($order['barcode'])) {
    $order = RP::getOrderByBarcode($prev['barcode'], $espp['auth'], $espp['user'])[0];
    if (LOGGING) file_put_contents('rp.print.log', "$date BY BARCODE - ".RP::json_print($order)."\n\n", FILE_APPEND);
}

// Если же не получилось и по ШПИ, то пробуем взять данные из поля в базе
if (empty($order['barcode'])) {
    $data = strval($prev['post_data']);
    $order = json_decode($data, true);
    if (LOGGING) file_put_contents('rp.print.log', "$date FROM BASE - ".RP::json_print($order)."\n\n", FILE_APPEND);
}

// Данные отсутствуют везде - выдадим 404 ошибку, что бланк не найден
if (empty($order['barcode'])) {
    header('HTTP/1.0 404 Not found');
    echo 'Данные для печати бланка не найдены';
    exit;
}

// Здесь мы точно имеем валидные данные для печати бланка, независимо каким методом они получены
// Сохраним их в базу для возможной печати в будущем
$data = $db->real_escape_string(json_encode($order, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
$db->query("update rp_orders set post_data='$data' where delivery_id='$id'");


$date_shipment = $prev['date_shipment'];

// Подготавливаем данные для печати бланка
$barcode = $order['barcode'];
$index_from = $order['postoffice-code'];
$index_to = $order['index-to'];
$mail_type = empty(RP::$tariffs[$order['mail-type']]) ? $order['mail-type'] : RP::$tariffs[$order['mail-type']];
$no_return = in_array('NO_RETURN', $order['postmarks']);
$delivery = ($order['total-rate-wo-vat'] + $order['total-vat']); $delivery_rub = floor($delivery/100); $delivery_cop = $delivery%100;
$cod = $order['payment']; $cod_rub = floor($cod / 100); $cod_cop = $cod % 100;
$ins = $order['insr-value']; $ins_rub = floor($ins / 100); $ins_cop = $ins % 100;
$mass = $order['mass']; $mass_kg = floor($mass / 1000); $mass_g = $mass % 1000;
$order_num = $order['order-num'];
$recipient = $order['recipient-name'];
$processing = empty($espp['processing']) ? '125955' : $espp['processing'];

// Массив с элементами адреса, для последующей склейки их в одну строку
$address = [];
//if (!empty($order['index_to'])) $address[] = $order['index-to'];
if (!empty($order['street-to'])) $address[] = $order['street-to'];
if (!empty($order['vladenie-to'])) $address[] = 'владение '.$order['vladenie-to'];
$house = empty($order['house-to']) ? '' : 'д. '.$order['house-to'];
if (!empty($order['letter-to'])) $house = $house.$order['letter-to'];
if (!empty($order['slash-to'])) $house = $house.'/'.$order['slash-to'];
if ($house) $address[] = $house;
if (!empty($order['building-to'])) $address[] = 'стр. '.$order['building-to'];
if (!empty($order['corpus-to'])) $address[] = 'корп. '.$order['corpus-to'];
if (!empty($order['office-to'])) $address[] = 'оф. '.$order['office-to'];
if (!empty($order['room-to'])) $address[] = 'к. '.$order['room-to'];
if (!empty($order['place-to'])) $address[] = $order['place-to'];
if (!empty($order['area-to'])) $address[] = $order['area-to'];

// Адрес без региона, для кодирования в датаматрице (по требованиям Почты в датаматрице регион должен указываться отдельно)
$address_to_no_region = implode(',', array_filter($address));
if (!empty($order['region-to'])) $region = $order['region-to']; else $region = '';
if (!empty($order['region-to'])) $address[] = $order['region-to'];

// Полный адрес одной строкой, с регионом и всеми остальными элементами
$address_to = implode(',' , array_filter($address));

// create new PDF document
$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8');
//$pdf = new Tcpdf('mm');

// set document information
$pdf->SetCreator('RussianPost');
//$pdf->SetAuthor('AvaMed');
$pdf->SetTitle("$id");
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->SetAutoPageBreak(false);
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
$pdf->SetFont('dejavusans', '', 10);
$pdf->AddPage();
$pdf->setCellPaddings(1, 1, 1, 1);
$pdf->setCellMargins(1, 1, 1, 1);

// Бланк наложенного платежа
if (true) {

    $pdf->StartTransform();
        $pdf->Translate(0, 140);

    $pdf->Image('./priem.jpg', 15, 5, 20, '', '', '');

    $pdf->Rect(40, 5, 105, 38);

//    $data = "!!77!!!3!1!$cod_rub.$cod_cop!3!0!$index_to!$region!$address_to_no_region!$recipient!!!!!!!!!125955!!!ООО \"ПИМ (Почта)\"!!026352!044525593!40702810701850001553!30101810200000000593!АО \"АЛЬФА-БАНК\"!10209752265164!0!0!0!1";
    $data = "!!77!!!3!1!$cod_rub.$cod_cop!3!0!$index_to!$region!$address_to_no_region!$recipient!!!!!!!!!$processing!!!$espp[client]!!$espp[espp]!$espp[bik]!$espp[acc]!$espp[kor]!$espp[bank]!$barcode!0!0!0!1";
    if (LOGGING) file_put_contents('rp.print.log', "  datamatrix - $data\n", FILE_APPEND);

    $data = iconv('UTF-8', 'Windows-1251', $data);
//    $pdf->write2DBarcode($data, 'DATAMATRIX', 150, 5, 38, 38);
    $barcode_obj = new TCPDF2DDatamatrixBarcode($data);
    $png = $barcode_obj->getBarcodePngData(2, 2, [0,0,0]);
    $pdf->Image('@' . $png, 150, 5, 38, 38, 'PNG', '', 'T', true, 300);

    $pdf->StopTransform();
    $pdf->StartTransform();
    $pdf->Translate(0, 145);

    $pdf->SetFont('dejavusans', '', 10); $pdf->Text(60, 39, "ПОЧТОВЫЙ ПЕРЕВОД на $cod_rub руб. $cod_cop коп. ");
    $pdf->Rect(165, 40, 40, 6, 'F', [], [200]);
    $pdf->Rect(167, 41.5, 3, 3); $pdf->Line(167, 41.5, 170, 44.5);  $pdf->Line(167, 44.5, 170, 41.5);
    $pdf->SetFont('dejavusans', '', 8); $pdf->Text(170, 39.5, 'Наложенный платеж');
    $pdf->Rect(60, 46, 145, 5, 'F', [], [200]);
    $pdf->SetFont('dejavusans', '', 10);
    $pdf->MultiCell(145, 5, RP::sum2words($cod / 100), 0, 'L', false, 1, 60, 44);

    $pdf->SetFont('dejavusans', 'B', 10);
    $pdf->Rect(175, 85, 5, 5); $pdf->Text(174.5, 83.5, substr($index_to, 0, 1));
    $pdf->Rect(180, 85, 5, 5); $pdf->Text(179.5, 83.5, substr($index_to, 1, 1));
    $pdf->Rect(185, 85, 5, 5); $pdf->Text(184.5, 83.5, substr($index_to, 2, 1));
    $pdf->Rect(190, 85, 5, 5); $pdf->Text(189.5, 83.5, substr($index_to, 3, 1));
    $pdf->Rect(195, 85, 5, 5); $pdf->Text(194.5, 83.5, substr($index_to, 4, 1));
    $pdf->Rect(200, 85, 5, 5); $pdf->Text(199.5, 83.5, substr($index_to, 5, 1));

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
    $pdf->MultiCell(130, 8, "$espp[client]", 0, 'L', false, 1, 75, 51);
    $pdf->MultiCell(130, 8, "$processing Федеральный клиент $espp[client]", 0, 'L', false, 1, 75, 57);
    $pdf->MultiCell(130, 8, $barcode, 0, 'L', false, 1, 130, 63);
    $pdf->MultiCell(130, 8, $recipient, 0, 'L', false, 1, 75, 69);
    $pdf->MultiCell(130, 8, $address_to, 0, 'L', false, 1, 75, 74);

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
    $pdf->SetFont('dejavusans', '', 6);
    $pdf->Text(190, 5, 'ф. 112 ЭК');
    $pdf->SetFont('dejavusans', '', 4);
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

    $pdf->write1DBarcode("$espp[espp]", 'I25', 15, 40, 30, 15, '', ['border' => false, 'stretch' => true, 'text' => true], 'N');

    $pdf->Line(183, 145, 203, 145);
    $pdf->StopTransform();

}

// Черта между бланками
$pdf->Line(5, 140, 205, 140);

// Извещение
if (true) {

    $pdf->StartTransform();
    $pdf->Translate(0, -160);

    $pdf->write1DBarcode($barcode, 'I25', 5, 163, 55, 20, '', ['border' => false, 'stretch' => true], 'N');
    $pdf->Text(15, 180, substr($barcode,0,6).' '.substr($barcode,6,2).' '.substr($barcode,8,5).' '.substr($barcode,13,1));

    $pdf->Image('./rp.png', 5, 185, '', 10, '', '');

    $pdf->SetFont('dejavusans', 'B', 12);
    $pdf->Text(30, 185, $order_num);

    $pdf->SetFont('dejavusans', 'B', 20);
    $pdf->Text(70, 160, $mail_type);

    $pdf->Rect(110, 172, 2, 2); if ($ins > 0) { $pdf->Line(110, 172, 112, 174); $pdf->Line(110, 174, 112, 172); }
    $pdf->SetFont('dejavusans', '', 6);
    $pdf->Text(111, 170, 'С объявленной ценностью');
    $pdf->Rect(110, 177, 2, 2); if ($cod > 0) { $pdf->Line(110, 177, 112, 179); $pdf->Line(110, 179, 112, 177); }
    $pdf->SetFont('dejavusans', '', 6);
    $pdf->Text(111, 175, 'С наложенным платежом');
    $pdf->Rect(110, 182, 2, 2);
    $pdf->SetFont('dejavusans', '', 6);
    $pdf->Text(111, 180, 'С проверкой комплектности');

    // Вывод надписи о невозвратности, если таковой признак установлен в заказе
    if ($no_return) {
        if ($account['noReturnSign'] == 1) {
            $pdf->setAlpha(0.4);
//            $pdf->Rect(120, 187, 34, 4.5);
//            $pdf->Rect(120, 187, 41, 5);
            $pdf->Rect(120, 187, 37, 5);
            $pdf->SetFont('dejavusans', '', 6);
            $pdf->Text(124, 186, 'Возврату не подлежит');
            $pdf->setAlpha(1.0);
        }
        else {
            $pdf->setAlpha(0.07);
            $pdf->Rect(120, 187, 30, 4);
            $pdf->SetFont('dejavusans', '', 4);
            $pdf->Text(124, 186, 'Возврату не подлежит');
            $pdf->setAlpha(1.0);
        }
    }

    $pdf->Rect(175, 165, 30, 28);
    $pdf->SetFont('dejavusans', '', 6);
    $pdf->Text(177, 160, 'ф.7-п. версия 06.2016');
    $pdf->Text(180, 163, 'ПОЧТА РОССИИ');
//    $pdf->Text(180, 166, 'Марушкинское');
    $pdf->Text(180, 169, $date_shipment);
    $pdf->Text(180, 172, $index_from);

    $pdf->Text(188, 186, 'Оттиск КПШ');
    $pdf->Text(181, 188, 'ОПС места приёма');

    $pdf->SetFont('dejavusans', 'B', 10);
    $pdf->Text(5, 193, 'Отправитель');
    $pdf->SetFont('dejavusans', 'B', 8);
    $pdf->Text(5, 198, 'От кого:');
    $pdf->SetFont('dejavusans', '', 8);
//    $pdf->MultiCell(80, 10, "$espp[sender] (ЕСПП $espp[espp])", 0, 'L', false, 1, 20, 198);
    $pdf->MultiCell(80, 10, "$espp[sender]", 0, 'L', false, 1, 20, 198);
    $pdf->SetFont('dejavusans', 'B', 8);
    $pdf->Text(5, 202, 'Адрес:');
    $pdf->SetFont('dejavusans', '', 8);
    $pdf->MultiCell(80, 10, !empty($espp['from']) ? $espp['from'] : 'Шарапово,д.1,Марушкинское,Москва', 0, 'L', false, 1, 20, 202);

    $pdf->Rect(5, 220, 95, 38);
    $pdf->SetFont('dejavusans', 'B', 7);
    $pdf->Text(5, 220, 'Реквизиты получателя наложенного платежа');
    $pdf->Text(38, 224, "$espp[client]");
    $pdf->Text(24, 227.5, "$espp[espp]");
    $pdf->SetFont('dejavusans', '', 6);
    $pdf->Text(5, 224, 'Наименование получателя:');
    $pdf->Text(5, 228, 'Код ФК в ЕСПП:');
    $pdf->Text(5, 232, 'ИНН:');
    $pdf->Text(5, 236, 'Кор/счет:');
    $pdf->Text(5, 240, 'Наименование банка:');
    $pdf->Text(5, 244, 'Расч/счет:');
    $pdf->Text(5, 248, 'ОГРН:');
    $pdf->Text(45, 248, 'БИК:');
    $pdf->Text(5, 252, 'Адрес:');

    /*
    $pdf->SetFont('dejavusans', '', 6);
    $pdf->Text(5, 247, 'Телефон для извещения');
    $pdf->SetFont('dejavusans', '', 8);
    $pdf->Text(5, 250, '');
    $pdf->Rect(7, 256, 2, 2);
    $pdf->SetFont('dejavusans', '', 6);
    $pdf->Text(8, 254, 'C SMS-уведомлением');
    */

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
//    $pdf->Text(50, 269, "$espp[sender] (ЕСПП $espp[espp])");
    $pdf->Text(50, 269, "$espp[sender]");
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
    if ($order['mail-type'] == 'POSTAL_PARCEL') {
        $pdf->Line(45, 285, 47, 287);
        $pdf->Line(45, 287, 47, 285);
    }

    $pdf->Rect(45, 288, 2, 2);
    $pdf->SetFont('dejavusans', '', 6);
    $pdf->Text(46, 286, 'Нестандартная негабаритная');


    $pdf->Rect(110, 195, 95, 8, 'F', [], [200]);
    $pdf->SetFont('dejavusans', '', 8);
    $pdf->MultiCell(95, 8, $ins_rub.'руб '.$ins_cop.'коп ('.RP::sum2words($ins / 100).')', 0, 'L', false, 1, 110, 193);
    $pdf->SetFont('dejavusans', '', 5);
    $pdf->Text(125, 199, '(сумма объявленной ценности цифрами и прописью, руб.)');

    $pdf->Rect(110, 205, 95, 8, 'F', [], [200]);
    $pdf->SetFont('dejavusans', '', 8);
    $pdf->MultiCell(95, 8, $cod_rub.'руб '.$cod_cop.' коп ('.RP::sum2words($cod / 100).')', 0, 'L', false, 1, 110, 203);
    $pdf->SetFont('dejavusans', '', 5);
    $pdf->Text(125, 209, '(сумма наложенного платежа цифрами и прописью, руб. коп.)');

    $pdf->SetFont('dejavusans', 'B', 15);
    $pdf->Text(110, 213, 'Адресат');
    $pdf->SetFont('dejavusans', 'B', 10);
    $pdf->Text(110, 219, 'Кому');
    $pdf->SetFont('dejavusans', '', 10);
    $pdf->MultiCell(95, 10, $recipient, 0, 'L', false, 1, 110, 225);
    $pdf->SetFont('dejavusans', 'B', 10);
    $pdf->Text(110, 235, 'Куда');
    $pdf->SetFont('dejavusans', '', 10);
    $pdf->MultiCell(95, 25, $address_to, 0, 'L', false, 1, 110, 241);

    $pdf->SetFont('dejavusans', '', 6);
    $pdf->Text(175, 268, 'ИНДЕКС ПОЛУЧАТЕЛЯ');
    $pdf->SetFont('dejavusans', 'B', 15);
    $pdf->Rect(145, 273, 10, 10); $pdf->Text(146, 273, substr($index_to, 0, 1));
    $pdf->Rect(155, 273, 10, 10); $pdf->Text(156, 273, substr($index_to, 1, 1));
    $pdf->Rect(165, 273, 10, 10); $pdf->Text(166, 273, substr($index_to, 2, 1));
    $pdf->Rect(175, 273, 10, 10); $pdf->Text(176, 273, substr($index_to, 3, 1));
    $pdf->Rect(185, 273, 10, 10); $pdf->Text(186, 273, substr($index_to, 4, 1));
    $pdf->Rect(195, 273, 10, 10); $pdf->Text(196, 273, substr($index_to, 5, 1));

    $pdf->SetFont('dejavusans', '', 6);
    $pdf->Text(110, 272, 'Телефон для извещения');
    $pdf->SetFont('dejavusans', '', 8);
    $pdf->Text(110, 275, empty($order['phone']) ? '' : $order['phone']);
    $pdf->Rect(112, 281, 2, 2);
    $pdf->SetFont('dejavusans', '', 6);
    $pdf->Text(113, 279, 'C SMS-уведомлением');

    $pdf->Rect(110, 285, 95, 10);
    $pdf->SetFont('dejavusans', '', 7);
    $pdf->Text(110, 287, 'Вес');
    $pdf->Text(116, 287, "$mass_kg кг $mass_g гр");
    $pdf->Line(118, 292, 140, 292);
    $pdf->SetFont('dejavusans', '', 7);
    $pdf->Text(140, 287, 'Плата');
    $pdf->Text(150, 287, "$delivery_rub руб $delivery_cop коп");
    $pdf->Line(152, 292, 175, 292);
    $pdf->Line(177, 292, 203, 292);
    $pdf->SetFont('dejavusans', '', 5);
    $pdf->Text(179, 290, '(подпись оператора)');

    $pdf->SetFont('dejavusans', '', 6);
    $pdf->Text(80, 294, 'Бланк ф.112ЭК находится под адресным ярлыком');

    $pdf->StopTransform();

}

// Send headers
header('Content-Description: File Transfer');
header('Content-Disposition: attachment; filename="' . $id . '.pdf"');
header('Content-Type: application/pdf');
header('Content-Transfer-Encoding: binary');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Expires: 0');

//Close and output PDF document
$pdf->Output("order$id.pdf", 'I'); exit;
