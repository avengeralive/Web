<?php
namespace lib;

/**
 * class.CPDF.php
 *
 * Класс - библиотека для работы с PDF
 * подгружается через автоподгрузку классов
 *
 * История:  2019.07.19 - файл создан
 *
 **/


require_once('./vendor/autoload.php');
use setasign\Fpdi\Tcpdf\Fpdi;

class CPDF extends Fpdi {




//     private $fieldsForm1;
//     private $fieldsForm2_1;
//     private $fieldsForm2_2;
//     private $fieldsForm2_3;
private $barcode_style;
private $fieldsForm1;
private $fieldsForm2_1;
private $fieldsForm2_2;
private $fieldsForm2_3;

	
	static function Init() {

            $this->barcode_style = array(
            'position' => '',
            'align' => 'C',
            'stretch' => false,
            'fitwidth' => true,
            'cellfitalign' => '',
            'border' => false,
            'hpadding' => 0,
            'vpadding' => 0,
            'fgcolor' => array(0,0,0),
            'bgcolor' => false, //array(255,255,255),
            'text' => true,
            'font' => 'helvetica',
            'fontsize' => 8,
            'stretchtext' => 4
        );

   $this->fieldsForm1 = array(
            'Form1BarcodeNumber1'         => isset($_POST['Form1BarcodeNumber1']) ? $_POST['Form1BarcodeNumber1'] : $barcode,             //Номер штрих-кода 1D
            'Form1BarcodeNumber2'         => isset($_POST['Form1BarcodeNumber2']) ? $_POST['Form1BarcodeNumber2'] : $barcode,             //Номер штрих-кода 2D
            'Form1ClientInfo'                   => isset($_POST['Form1ClientInfo']) ? $_POST['Form1ClientInfo'] : $realylongtest,               //Имя
            'Form1Rub'                          => isset($_POST['Form1Rub']) ? $_POST['Form1Rub'] : $indextest,                                       //Рубли
            'Form1Cent'                         => isset($_POST['Form1Cent']) ? $_POST['Form1Cent'] : 12,                                         //Копейки
            'Form1CashOnDelivery'         => isset($_POST['Form1CashOnDelivery']) ? "X" : $checktest,                                       //Наложенный платеж
            'Form1SummInWords'                  => isset($_POST['Form1SummInWords']) ? $_POST['Form1SummInWords'] : $longtest,                      //Сумма прописью
            'Form1WithNotification'       => isset($_POST['Form1WithNotification']) ? "X" : $checktest,                                   //С уведомлением
            'Form1SenderPhone'                  => isset($_POST['Form1SenderPhone']) ? $_POST['Form1SenderPhone'] : $phonetest,                 //Телефон отправителя
            'Form1ToWhom'                       => isset($_POST['Form1ToWhom']) ? $_POST['Form1ToWhom'] : $longtest,                              //Кому
            'Form1ToWhere1'               => isset($_POST['Form1ToWhere1']) ? $_POST['Form1ToWhere1'] : $longtest,                            //Куда(1)
            'Form1ToWhere2'               => isset($_POST['Form1ToWhere2']) ? $_POST['Form1ToWhere2'] : $longtest,                        //Куда(2)
            'Form1Message1'               => isset($_POST['Form1ToMessage1']) ? $_POST['Form1ToMessage1'] : $messagetest,                 //Сообщение(1)
            'Form1Message2'               => isset($_POST['Form1ToMessage2']) ? $_POST['Form1ToMessage2'] : $messagetest,                 //Сообщение(2)
            'Form1FromWhom'               => isset($_POST['Form1FromWhom']) ? $_POST['Form1FromWhom'] : $longtest,                        //От кого
            'Form1SenderAddress1'         => isset($_POST['Form1SenderAddress1']) ? $_POST['Form1SenderAddress1'] : $longtest,            //Адрес отправителя(1)
            'Form1SenderAddress2'         => isset($_POST['Form1SenderAddress2']) ? $_POST['Form1SenderAddress2'] : $longtest,            //Адрес отправителя(2)
            'Form1SenderIndex'                  => isset($_POST['Form1SenderIndex']) ? $_POST['Form1SenderIndex'] : $indextest,                 //Индекс отправителя
            'Form1SenderRegAddress1'      => isset($_POST['Form1SenderRegAddress1']) ? $_POST['Form1SenderRegAddress1'] : $longtest,      //Адрес регистрации отправителя(1)
            'Form1SenderRegAddress2'      => isset($_POST['Form1SenderRegAddress2']) ? $_POST['Form1SenderRegAddress2'] : $longtest,      //Адрес регистрации отправителя(2)
            'Form1SenderRegIndex'         => isset($_POST['Form1SenderRegIndex']) ? $_POST['Form1SenderRegIndex'] : $indextest,           //Индекс регистрации отправитля
            'Form1SenderDoc'              => isset($_POST['Form1SenderDoc']) ? $_POST['Form1SenderDoc'] : $shorttest,                     //Тип документа отправителя
            'Form1SenderDocSerial'        => isset($_POST['Form1SenderDocSerial']) ? $_POST['Form1SenderDocSerial'] : $indextest,         //Серия документа
            'Form1SenderDocNumber'        => isset($_POST['Form1SenderDocNumber']) ? $_POST['Form1SenderDocNumber'] : $indextest,         //Номер документа
            'Form1SenderDocGiven'         => isset($_POST['Form1SenderDocGiven']) ? $_POST['Form1SenderDocGiven'] : $shorttest,           //Дата выдачи документа
            'Form1SenderDocPlace1'        => isset($_POST['Form1SenderDocPlace1']) ? $_POST['Form1SenderDocPlace1'] : $longtest,          //Где выдан документ(1)
            'Form1SenderDocPlace2'        => isset($_POST['Form1SenderDocPlace2']) ? $_POST['Form1SenderDocPlace2'] : $shorttest,         //Где выдан документ(2)
            'Form1SenderDocCode'          => isset($_POST['Form1SenderDocCode']) ? $_POST['Form1SenderDocCode'] : $shorttest,             //Код подразделения
            'Form1SenderINN'              => isset($_POST['Form1SenderINN']) ? $_POST['Form1SenderINN'] : $inntest,                       //ИНН отправителя
            'Form1SenderSitizenship'      => isset($_POST['Form1SenderSitizenship']) ? $_POST['Form1SenderSitizenship'] : $shorttest,     //Гражданство отправителя
            'Form1SenderBirth'                  => isset($_POST['Form1SenderBirth']) ? $_POST['Form1SenderBirth'] : $shorttest,                 //Дата рождения отправителя
            'Form1MigrationSerial'        => isset($_POST['Form1MigrationSerial']) ? $_POST['Form1MigrationSerial'] : $indextest,         //Серия миграционной карты
            'Form1MigrationNumber'        => isset($_POST['Form1MigrationNumber']) ? $_POST['Form1MigrationNumber'] : $indextest,         //Номер миграционной карты
            'Form1MigrationGiven'         => isset($_POST['Form1MigrationGiven']) ? $_POST['Form1MigrationGiven'] : $shorttest,           //Дата выдачи миграционной карты
            'Form1MigrationFrom'          => isset($_POST['Form1MigrationFrom']) ? $_POST['Form1MigrationFrom'] : $shorttest,             //Срок пребывания с
            'Form1MigrationTo'                  => isset($_POST['Form1MigrationTo']) ? $_POST['Form1MigrationTo'] : $shorttest,                 //Срок пребывания по
            'Form1OfficialYes'                  => isset($_POST['Form1OfficialYes']) ? "X" : $checktest,                                        //Являетесь ли вы должностным лицом(да)
            'Form1OfficialNo'                   => isset($_POST['Form1OfficialNo']) ? "X" : $checktest,                                         //Являетесь ли вы должностным лицом(нет)
            'Form1Consent'                      => isset($_POST['Form1Consent']) ? "X" : $checktest                                                   //Согласие на оповещения
        );
      $this->fieldsForm2_1 = array(
            'Form2Standart'               => isset($_POST['Form2Standart']) ? "X" : $checktest,                                           //Стандартная посылка
            'Form2Simple'                       => isset($_POST['Form2Simple']) ? "X" : $checktest,                                             //Обыкновенная
            'Form2Insured'                      => isset($_POST['Form2Insured']) ? "X" : $checktest,                                            //С объявленной ценностью
            'Form2CashOnDelivery'         => isset($_POST['Form2CashOnDelivery']) ? "X" : $checktest,                                     //С наложенным платежом
            'Form2Sender1'                      => isset($_POST['Form2Sender1']) ? $_POST['Form2Sender1'] : $longtest,                          //От кого(1)
            'Form2Sender2'                      => isset($_POST['Form2Sender2']) ? $_POST['Form2Sender2'] : $longtest,                          //От кого(2)
            'Form2SenderAddress1'         => isset($_POST['Form2SenderAddress1']) ? $_POST['Form2SenderAddress1'] : $longtest,            //Адрес отправителя(1)
            'Form2SenderAddress2'         => isset($_POST['Form2SenderAddress2']) ? $_POST['Form2SenderAddress2'] : $longtest,            //Адрес отправителя(2)
            'Form2SenderAddress3'         => isset($_POST['Form2SenderAddress3']) ? $_POST['Form2SenderAddress3'] : $longtest,            //Адрес отправителя(3)
            'Form2SenderPhone'                  => isset($_POST['Form2SenderPhone']) ? $_POST['Form2SenderPhone'] : $phonetest,                 //Телефон отправителя
            'Form2SenderIndex'                  => isset($_POST['Form2SenderIndex']) ? $_POST['Form2SenderIndex'] : $indextest,                 //Индекс отправителя
            'Form2CashReciever'           => isset($_POST['Form2CashReciever']) ? $_POST['Form2CashReciever'] : $phonetest,               //Реквизиты получателя наложенного платежа
            'Form2CashRecieverName1'      => isset($_POST['Form2CashRecieverName1']) ? $_POST['Form2CashRecieverName1'] : $messagetest,              //Наименование получателя(1)
            'Form2CashRecieverName2'      => isset($_POST['Form2CashRecieverName2']) ? $_POST['Form2CashRecieverName2'] : $messagetest,              //Наименование получателя(2)
            'Form2IFP'                          => isset($_POST['Form2IFP']) ? $_POST['Form2IFP'] : $ifptest,                                          //ИФП\ИРП
            'Form2PayInCash'              => isset($_POST['Form2PayInCash']) ? "X" : $checktest,                                          //Выплатить наличными
            'Form2INN'                          => isset($_POST['Form2INN']) ? $_POST['Form2INN'] : $inntest,                                          //ИНН
            'Form2CorrAccount'                  => isset($_POST['Form2CorrAccount']) ? $_POST['Form2CorrAccount'] : $cortest,                          //Кор\счет
            'Form2BankName1'              => isset($_POST['Form2BankName1']) ? $_POST['Form2BankName1'] : $messagetest,                              //Наименование банка(1)
            'Form2BankName2'              => isset($_POST['Form2BankName2']) ? $_POST['Form2BankName2'] : $messagetest,                              //Наименование банка(2)
            'Form2CheckAccount'           => isset($_POST['Form2CheckAccount']) ? $_POST['Form2CheckAccount'] : $cortest,                        //Рас\счет
            'Form2BIK'                          => isset($_POST['Form2BIK']) ? $_POST['Form2BIK'] : $ifptest,                                          //БИК
            'Form2OGRN'                         => isset($_POST['Form2OGRN']) ? $_POST['Form2OGRN'] : $orgntest,                                        //ОГРН
            'Form2BankAddress1'           => isset($_POST['Form2BankAddress1']) ? $_POST['Form2BankAddress1'] : $messagetest,                        //Адрес банка(1)
            'Form2BankAddress2'           => isset($_POST['Form2BankAddress2']) ? $_POST['Form2BankAddress2'] : $messagetest,                        //Адрес банка(2)
            'Form2BankAddress3'           => isset($_POST['Form2BankAddress3']) ? $_POST['Form2BankAddress3'] : $messagetest,                        //Адрес банка(3)
            'Form2BankIndex'              => isset($_POST['Form2BankIndex']) ? $_POST['Form2BankIndex'] : $indextest,                              //Индекс банка
            'Form2SummInsured'                  => isset($_POST['Form2SummInsured']) ? $_POST['Form2SummInsured'] : $longtest,                  //Сумма объявленной ценности
            'Form2SummCashOnDelivery'     => isset($_POST['Form2SummCashOnDelivery']) ? $_POST['Form2SummCashOnDelivery'] : $longtest,    //Сумма наложенного платежа
            'Form2Recipient1'                   => isset($_POST['Form2Recipient1']) ? $_POST['Form2Recipient1'] : $longtest,                    //Кому(1)
            'Form2Recipient2'                   => isset($_POST['Form2Recipient2']) ? $_POST['Form2Recipient2'] : $longtest,                    //Кому(2)
            'Form2RecipientAddress1'      => isset($_POST['Form2RecipientAddress1']) ? $_POST['Form2RecipientAddress1'] : $longtest,      //Адрес получателя(1)
            'Form2RecipientAddress2'      => isset($_POST['Form2RecipientAddress2']) ? $_POST['Form2RecipientAddress2'] : $longtest,      //Адрес получателя(2)
            'Form2RecipientAddress3'      => isset($_POST['Form2RecipientAddress3']) ? $_POST['Form2RecipientAddress3'] : $longtest,      //Адрес получателя(3)
            'Form2RecipientIndex'         => isset($_POST['Form2RecipientIndex']) ? $_POST['Form2RecipientIndex'] : $indextest,           //Индекс получателя
            'Form2Weight'                       => isset($_POST['Form2Weight']) ? $_POST['Form2Weight'] : $indextest,                           //Вес
            'Form2Price'                        => isset($_POST['Form2Price']) ? $_POST['Form2Price'] : $indextest                              //Плата
        );
      $this->fieldsForm2_2 = array(
            'Form2Parcel'               => isset($_POST['Form2Parcel']) ? "X" : $checktest,                                        //Посылка
            'Form2Banderol'             => isset($_POST['Form2Banderol']) ? "X" : $checktest,                                      //Бандероль
            'Form2Insured'              => isset($_POST['Form2Insured']) ? "X" : $checktest,                                       //С объявленной ценностью
            'Form2CashOnDelivery'       => isset($_POST['Form2CashOnDelivery']) ? "X" : $checktest,                                //С наложенным платежом
            'Form2WithInventory'        => isset($_POST['Form2WithInventory']) ? "X" : $checktest,                                 //С описью
            'Form2SimpleNotification'   => isset($_POST['Form2SimpleNotification']) ? "X" : $checktest,                            //С простым уведомлением
            'Form2OrderedNotification'  => isset($_POST['Form2OrderedNotification']) ? "X" : $checktest,                           //С заказным уведомлением
            'Form2PostOffice'           => isset($_POST['Form2PostOffice']) ? $_POST['Form2PostOffice'] : $indextest,                //Почтомат №
            'Form2SizeS'                => isset($_POST['Form2SizeS']) ? "X" : $checktest,                                         //Габариты S
            'Form2SizeM'                => isset($_POST['Form2SizeM']) ? "X" : $checktest,                                         //Габариты M
            'Form2SizeL'                => isset($_POST['Form2SizeL']) ? "X" : $checktest,                                         //Габариты L
            'Form2Sender'               => isset($_POST['Form2Sender']) ? $_POST['Form2Sender'] : $longtest,                        //От кого
            'Form2SenderAddress1'       => isset($_POST['Form2SenderAddress1']) ? $_POST['Form2SenderAddress1'] : $longtest,        //Откуда(1)
            'Form2SenderAddress2'       => isset($_POST['Form2SenderAddress2']) ? $_POST['Form2SenderAddress2'] : $longtest,        //Откуда(2)
            'Form2SenderAddress3'       => isset($_POST['Form2SenderAddress3']) ? $_POST['Form2SenderAddress3'] : $longtest,        //Откуда(3)
            'Form2SenderPhone'          => isset($_POST['Form2SenderPhone']) ? $_POST['Form2SenderPhone'] : $phonetest,              //Телефон отправителя
            'Form2SenderIndex'          => isset($_POST['Form2SenderIndex']) ? $_POST['Form2SenderIndex'] : $indextest,              //Индекс отправителя
            'Form2SenderNotification'   => isset($_POST['Form2SenderNotification']) ? "X" : $checktest,                            //Согласие на уведомление о вручении
            'Form2SummInsured'          => isset($_POST['Form2SummInsured']) ? $_POST['Form2SummInsured'] : $longtest,              //Сумма объявленной ценности
            'Form2SummCashOnDelivery'   => isset($_POST['Form2SummCashOnDelivery']) ? $_POST['Form2SummCashOnDelivery'] : $longtest,//Сумма наложенного платежа
            'Form2Recipient'            => isset($_POST['Form2Recipient']) ? $_POST['Form2Recipient'] : $longtest,                  //Кому
            'Form2RecipientAddress1'    => isset($_POST['Form2RecipientAddress1']) ? $_POST['Form2RecipientAddress1'] : $longtest,  //Куда(1)
            'Form2RecipientAddress2'    => isset($_POST['Form2RecipientAddress2']) ? $_POST['Form2RecipientAddress2'] : $longtest,  //Куда(2)
            'Form2RecipientAddress3'    => isset($_POST['Form2RecipientAddress3']) ? $_POST['Form2RecipientAddress3'] : $longtest,  //Куда(3)
            'Form2RecipientPhone'       => isset($_POST['Form2RecipientPhone']) ? $_POST['Form2RecipientPhone'] : $phonetest,        //Телефон получателя
            'Form2RecipientIndex'       => isset($_POST['Form2RecipientIndex']) ? $_POST['Form2RecipientIndex'] : $indextest,        //Индекс получателя
            'Form2RecipientNotification'=> isset($_POST['Form2RecipientNotification']) ? "X" : $checktest,                         //Согласие на уведомление о поступлении в отделение
            'Form2ReturnToAdress'       => isset($_POST['Form2ReturnToAdress']) ? "X" : $checktest,                                //Вернуть по обратному адресу
            'Form2GroundTransport'      => isset($_POST['Form2GroundTransport']) ? "X" : $checktest,                               //Направить наземным транспортом
            'Form2Heavy'                => isset($_POST['Form2Heavy']) ? "X" : $checktest,                                         //Тяжеловесная
            'Form2Simple'               => isset($_POST['Form2Simple']) ? "X" : $checktest,                                        //Простая
            'Form2Large'                => isset($_POST['Form2Large']) ? "X" : $checktest,                                         //Крупногабаритная
            'Form2Registered'           => isset($_POST['Form2Registered']) ? "X" : $checktest,                                    //Заказная
            'Form2Standart'             => isset($_POST['Form2Standart']) ? "X" : $checktest,                                      //Стандартная
            'Form2NonStandart'          => isset($_POST['Form2NonStandart']) ? "X" : $checktest,                                   //Нестандартная
            'Form2Regular'              => isset($_POST['Form2Regular']) ? "X" : $checktest,                                       //Обыкноваенная
            'Form2Weight'               => isset($_POST['Form2Weight']) ? $_POST['Form2Weight'] : $indextest,                        //Вес
            'Form2Price'                => isset($_POST['Form2Price']) ? $_POST['Form2Price'] : $indextest                           //Плата
        );
       $this->fieldsForm2_3 = array(
            'Form2Simple'                       => isset($_POST['Form2Simple']) ? "X" : $checktest,                                        //Обыкновенная
            'Form2Registered'           => isset($_POST['Form2Registered']) ? "X" : $checktest,                                    //Заказная
            'Form2WithNotification'     => isset($_POST['Form2SimpleNotification']) ? "X" : $checktest,                           //С простым уведомлением
            'Form2WithInventory'        => isset($_POST['Form2WithInventory']) ? "X" : $checktest,                                 //С описью
            'Form2Insured'                      => isset($_POST['Form2Insured']) ? "X" : $checktest,                                       //С объявленной ценностью
            'Form2CashOnDelivery'       => isset($_POST['Form2CashOnDelivery']) ? "X" : $checktest,                                //С наложенным платежом
            'Form2Sender1'                      => isset($_POST['Form2Sender1']) ? $_POST['Form2Sender1'] : $longtest,                      //От кого(1)
            'Form2Sender2'                      => isset($_POST['Form2Sender2']) ? $_POST['Form2Sender2'] : $longtest,                      //От кого(2)
            'Form2SenderAddress1'         => isset($_POST['Form2SenderAddress1']) ? $_POST['Form2SenderAddress1'] : $longtest,        //Адрес отправителя(1)
            'Form2SenderAddress2'         => isset($_POST['Form2SenderAddress2']) ? $_POST['Form2SenderAddress2'] : $longtest,        //Адрес отправителя(2)
            'Form2SenderAddress3'         => isset($_POST['Form2SenderAddress3']) ? $_POST['Form2SenderAddress3'] : $longtest,        //Адрес отправителя(3)
            'Form2SenderIndex'                  => isset($_POST['Form2SenderIndex']) ? $_POST['Form2SenderIndex'] : $indextest,              //Индекс отправителя
            'Form2Weight'                       => isset($_POST['Form2Weight']) ? $_POST['Form2Weight'] : $indextest,                        //Вес
            'Form2Price'                        => isset($_POST['Form2Price']) ? $_POST['Form2Price'] : $indextest,                          //Плата
            //'Form2Index'                  => isset($_POST['Form2Index']) ? $_POST['Form2Index'] : 0,                          //Индекс
            'Form2SummInsured'                  => isset($_POST['Form2SummInsured']) ? $_POST['Form2SummInsured'] : $longtest,              //Сумма объявленной ценности
            'Form2SummCashOnDelivery'     => isset($_POST['Form2SummCashOnDelivery']) ? $_POST['Form2SummCashOnDelivery'] : $longtest,//Сумма наложенного платежа
            'Form2Recipient1'                   => isset($_POST['Form2Recipient1']) ? $_POST['Form2Recipient1'] : $longtest,                //Кому(1)
            'Form2Recipient2'                   => isset($_POST['Form2Recipient2']) ? $_POST['Form2Recipient2'] : $longtest,                //Кому(2)
            'Form2RecipientAddress1'      => isset($_POST['Form2RecipientAddress1']) ? $_POST['Form2RecipientAddress1'] : $longtest,  //Адрес получателя(1)
            'Form2RecipientAddress2'      => isset($_POST['Form2RecipientAddress2']) ? $_POST['Form2RecipientAddress2'] : $longtest,  //Адрес получателя(2)
            'Form2RecipientAddress3'      => isset($_POST['Form2RecipientAddress3']) ? $_POST['Form2RecipientAddress3'] : $longtest,  //Адрес получателя(3)
            'Form2RecipientIndex'         => isset($_POST['Form2RecipientIndex']) ? $_POST['Form2RecipientIndex'] : $indextest,        //Индекс получателя
            'Form2IndexZip'             => isset($_POST['Form2IndexZip']) ? $_POST['Form2IndexZip'] : $indextest,                   //Индекс zip
        );  

        $this->setPrintHeader(false);
        $this->setPrintFooter(false);
        $this->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        $this->zipcode = TCPDF_FONTS::addTTFfont('./fonts/ZIPcodeRegular.ttf');
        $this->AddFont($this->zipcode);

        $realylongtest ='example пример example пример example пример example пример example пример example пример ';
        $longtest = 'example пример example пример ';
        $shorttest = 'example пример';
        $barcode = '10511825021110';
        $indextest = '123450';
        $phonetest = '1234567890';
        $inntest = '123456789012';
        $ifptest = '123456789';
        $cortest = '12345678901234567890';
        $orgntest = '123456789012345';
        $messagetest = 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa';
        $checktest = ' ';
    }

    private function FillForm1() {
    		//$Font = (new SynthesisInput())->setText($text);

        $this->SetFont('dejavusans', '', 11, '', true);
        //'Form1BarcodeNumber1'
        $this->write1DBarcode($this->fieldsForm1['Form1BarcodeNumber1'], 'I25', 5, 55, 32, 18, 0.4, $this->barcode_style, 'N');

        //'Form1BarcodeNumber2'
        $this->write2DBarcode($this->fieldsForm1['Form1BarcodeNumber2'], 'DATAMATRIX', 109, 11, 0, 28, $this->barcode_style, 'N');

        //'Form1ClientInfo
        $this->MultiCell(35, 71, $this->fieldsForm1['Form1ClientInfo'], 0, 'C', 0, 0, 3, 73, true, 0, false, true, 71, 'M', true);

        //'Form1Rub'
        $this->SetXY(75,49.5);
        $this->Cell(11,0, $this->fieldsForm1['Form1Rub'], 0, 0, 'N', 0, '', 1);

        //'Form1Cent'
        $this->SetXY(89,49.5);
        $this->Cell(6,0, $this->fieldsForm1['Form1Cent'], 0, 0, 'N', 0, '', 1);

        //'Form1CashOnDelivery'
        $this->SetXY(103,49.5);
        $this->Cell(0,0, $this->fieldsForm1['Form1CashOnDelivery'], 0, 0, 'N', 0, '', 1);

        //'Form1SummInWords'
        $this->SetXY(44,54);
        $this->Cell(97,0, $this->fieldsForm1['Form1SummInWords'], 0, 0, 'N', 0, '', 1);

        //'Form1WithNotification'
        $this->SetXY(44,60.3);
        $this->Cell(0,0, $this->fieldsForm1['Form1WithNotification'], 0, 0, 'N', 0, '', 1);

        //'Form1SenderPhone'
        $this->SetXY(111.45,60.4);
        $this->Cell(30, 0, $this->fieldsForm1['Form1SenderPhone'], 0, 0, 'C', 0, '', 4);

        //'Form1ToWhom'
        $this->SetXY(50,65);
        $this->Cell(91,0, $this->fieldsForm1['Form1ToWhom'], 0, 0, 'N', 0, '', 1);

        //'Form1ToWhere1'
        $this->SetXY(50,70);
        $this->Cell(91,0, $this->fieldsForm1['Form1ToWhere1'], 0, 0, 'N', 0, '', 1);

        //'Form1ToWhere2'
        $this->SetXY(44,75);
        $this->Cell(97,0, $this->fieldsForm1['Form1ToWhere2'], 0, 0, 'N', 0, '', 1);

        //'Form1Message1'
        $this->SetXY(43.5,82);
        $this->Cell(98,0, $this->fieldsForm1['Form1Message1'], 0, 0, 'С', 0, '', 4);

        //'Form1Message2'
        $this->SetXY(43.5,87);
        $this->Cell(98,0, $this->fieldsForm1['Form1Message2'], 0, 0, 'С', 0, '', 4);

        //'Form1FromWhom'
        $this->SetXY(54,91);
        $this->Cell(87,0, $this->fieldsForm1['Form1FromWhom'], 0, 0, 'N', 0, '', 1);

        //'Form1SenderAddress1'
        $this->SetXY(68,96);
        $this->Cell(73,0, $this->fieldsForm1['Form1SenderAddress1'], 0, 0, 'N', 0, '', 1);

        //'Form1SenderAddress2'
        $this->SetXY(44,100);
        $this->Cell(82,0, $this->fieldsForm1['Form1SenderAddress2'], 0, 0, 'N', 0, '', 1);

        //'Form1SenderIndex'
        $this->SetXY(125,100);
        $this->Cell(16.7, 0, $this->fieldsForm1['Form1SenderIndex'], 0, 0, 'C', 0, '', 4);

        //'Form1SenderRegAddress1'
        $this->SetXY(66,109);
        $this->Cell(75,0, $this->fieldsForm1['Form1SenderRegAddress1'], 0, 0, 'N', 0, '', 1);

        //'Form1SenderRegAddress2'
        $this->SetXY(44,114);
        $this->Cell(66,0, $this->fieldsForm1['Form1SenderRegAddress2'], 0, 0, 'N', 0, '', 1);

        //'Form1SenderRegIndex'
        $this->SetXY(125,114.2);
        $this->Cell(16.7, 0, $this->fieldsForm1['Form1SenderRegIndex'], 0, 0, 'C', 0, '', 4);

        //'Form1SenderDoc'
        $this->SetXY(57,119);
        $this->Cell(21.5,0, $this->fieldsForm1['Form1SenderDoc'], 0, 0, 'N', 0, '', 1);

        //'Form1SenderDocSerial'
        $this->SetXY(86,119);
        $this->Cell(10,0, $this->fieldsForm1['Form1SenderDocSerial'], 0, 0, 'N', 0, '', 1);

        //'Form1SenderDocNumber'
        $this->SetXY(99,119);
        $this->Cell(16.7,0, $this->fieldsForm1['Form1SenderDocNumber'], 0, 0, 'N', 0, '', 1);

        //'Form1SenderDocGiven'
        $this->SetXY(121,119);
        $this->Cell(20.7,0, $this->fieldsForm1['Form1SenderDocGiven'], 0, 0, 'N', 0, '', 1);

        //'Form1SenderDocPlace1'
        $this->SetXY(44,124);
        $this->Cell(97,0, $this->fieldsForm1['Form1SenderDocPlace1'], 0, 0, 'N', 0, '', 1);

        //'Form1SenderDocPlace2'
        $this->SetXY(44,129);
        $this->Cell(34,0, $this->fieldsForm1['Form1SenderDocPlace2'], 0, 0, 'N', 0, '', 1);

        //'Form1SenderDocCode'
        $this->SetXY(78,129);
        $this->Cell(26,0, $this->fieldsForm1['Form1SenderDocCode'], 0, 0, 'N', 0, '', 1);

        $this->SetFont('dejavusans', '', 8, '', true);
        //'Form1SenderINN'
        $this->SetXY(114.1,129.3);
        $this->Cell(27.7, 0, $this->fieldsForm1['Form1SenderINN'], 0, 0, 'C', 0, '', 4);
        $this->SetFont('dejavusans', '', 11, '', true);

        //'Form1SenderSitizenship'
        $this->SetXY(60,134);
        $this->Cell(42,0, $this->fieldsForm1['Form1SenderSitizenship'], 0, 0, 'N', 0, '', 1);

        //'Form1SenderBirth'
        $this->SetXY(119,134);
        $this->Cell(23,0, $this->fieldsForm1['Form1SenderBirth'], 0, 0, 'N', 0, '', 1);

        //'Form1MigrationSerial'
        $this->SetXY(78,140);
        $this->Cell(10.5,0, $this->fieldsForm1['Form1MigrationSerial'], 0, 0, 'N', 0, '', 1);

        //'Form1MigrationNumber'
        $this->SetXY(91,140);
        $this->Cell(16,0, $this->fieldsForm1['Form1MigrationNumber'], 0, 0, 'N', 0, '', 1);

        //'Form1MigrationGiven'
        $this->SetXY(114,140);
        $this->Cell(20.5,0, $this->fieldsForm1['Form1MigrationGiven'], 0, 0, 'N', 0, '', 1);

        //'Form1MigrationFrom'
        $this->SetXY(67,144);
        $this->Cell(20.5,0, $this->fieldsForm1['Form1MigrationFrom'], 0, 0, 'N', 0, '', 1);

        //'Form1MigrationTo'
        $this->SetXY(91,144);
        $this->Cell(20.5,0, $this->fieldsForm1['Form1MigrationTo'], 0, 0, 'N', 0, '', 1);

        //'Form1OfficialYes'
        $this->SetXY(119.5,149);
        $this->Cell(0,0, $this->fieldsForm1['Form1OfficialYes'], 0, 0, 'N', 0, '', 1);

        //'Form1OfficialNo'
        $this->SetXY(129.5,149);
        $this->Cell(0,0, $this->fieldsForm1['Form1OfficialNo'], 0, 0, 'N', 0, '', 1);

        //'Form1Consent'
        $this->SetXY(3,159);
        $this->Cell(0,0, $this->fieldsForm1['Form1Consent'], 0, 0, 'N', 0, '', 1);
    }

    private function FillForm2_1(){
        $this->SetFont('dejavusans', '', 8, '', true);
        //'Form2Standard'
        $this->SetXY(208.4, 24.8);
        $this->Cell(0,0, $this->fieldsForm2_1['Form2Standart'], 0, 0, 'N', 0, '', 1);

        //'Form2Simple'
        $this->SetXY(228.7, 24.7);
        $this->Cell(0,0, $this->fieldsForm2_1['Form2Simple'], 0, 0, 'N', 0, '', 1);

        //'Form2Insured'
        $this->SetXY(228.7, 29.5);
        $this->Cell(0,0, $this->fieldsForm2_1['Form2Insured'], 0, 0, 'N', 0, '', 1);

        //'Form2CashOnDelivery'
        $this->SetXY(228.7, 34.7);
        $this->Cell(0,0, $this->fieldsForm2_1['Form2CashOnDelivery'], 0, 0, 'N', 0, '', 1);

        $this->SetFont('dejavusans', '', 11, '', true);
        //'Form2Sender1'
        $this->SetXY(165, 33);
        $this->Cell(49,0, $this->fieldsForm2_1['Form2Sender1'], 0, 0, 'N', 0, '', 1);

        //'Form2Sender2'
        $this->SetXY(153, 38.5);
        $this->Cell(60,0, $this->fieldsForm2_1['Form2Sender2'], 0, 0, 'N', 0, '', 1);

        //'Form2SenderAddress1'
        $this->SetXY(165.5, 45);
        $this->Cell(47,0, $this->fieldsForm2_1['Form2SenderAddress1'], 0, 0, 'N', 0, '', 1);

        //'Form2SenderAddress2'
        $this->SetXY(153, 50.3);
        $this->Cell(60,0, $this->fieldsForm2_1['Form2SenderAddress2'], 0, 0, 'N', 0, '', 1);

        //'Form2SenderAddress3'
        $this->SetXY(153, 56);
        $this->Cell(60,0, $this->fieldsForm2_1['Form2SenderAddress3'], 0, 0, 'N', 0, '', 1);

        //'Form2SenderIndex'
        $this->SetXY(183.5, 61.5);
        $this->Cell(30,0, $this->fieldsForm2_1['Form2SenderIndex'], 0, 0, 'C', 0, '', 4);

        //'Form2SummInsured'
        $this->SetXY(215, 47);
        $this->Cell(77,0, $this->fieldsForm2_1['Form2SummInsured'], 0, 0, 'N', 0, '', 1);

        //'Form2SummCashOnDelivery'
        $this->SetXY(215, 54);
        $this->Cell(77,0, $this->fieldsForm2_1['Form2SummCashOnDelivery'], 0, 0, 'N', 0, '', 1);

        //'Form2Recipient1'
        $this->SetXY(228, 60);
        $this->Cell(64,0, $this->fieldsForm2_1['Form2Recipient1'], 0, 0, 'N', 0, '', 1);

        //'Form2Recipient2'
        $this->SetXY(220, 66);
        $this->Cell(72,0, $this->fieldsForm2_1['Form2Recipient2'], 0, 0, 'N', 0, '', 1);

        //'Form2RecipientAddress1'
        $this->SetXY(228, 73);
        $this->Cell(64,0, $this->fieldsForm2_1['Form2RecipientAddress1'], 0, 0, 'N', 0, '', 1);

        //'Form2RecipientAddress2'
        $this->SetXY(220, 78.5);
        $this->Cell(72,0, $this->fieldsForm2_1['Form2RecipientAddress2'], 0, 0, 'N', 0, '', 1);

        //'Form2RecipientAddress3'
        $this->SetXY(220, 84);
        $this->Cell(42,0, $this->fieldsForm2_1['Form2RecipientAddress3'], 0, 0, 'N', 0, '', 1);

        //'Form2RecipientIndex'
        $this->SetXY(262, 84);
        $this->Cell(30,0, $this->fieldsForm2_1['Form2RecipientIndex'], 0, 0, 'C', 0, '', 4);

        //'Form2Weight'
        $this->SetXY(223, 110.5);
        $this->Cell(11,0, $this->fieldsForm2_1['Form2Weight'], 0, 0, 'N', 0, '', 1);

        //'Form2Price'
        $this->SetXY(244, 110.5);
        $this->Cell(11,0, $this->fieldsForm2_1['Form2Price'], 0, 0, 'N', 0, '', 1);

        $this->SetFont('dejavusans', '', 8, '', true);
        //'Form2SenderPhone'
        $this->SetXY(166, 67);
        $this->Cell(18,0, $this->fieldsForm2_1['Form2SenderPhone'], 0, 0, 'N', 0, '', 1);

        //'Form2CashReciever'
        $this->SetXY(185, 69);
        $this->Cell(30,0, $this->fieldsForm2_1['Form2CashReciever'], 0, 0, 'N', 0, '', 1);

        //'Form2CashRecieverName1'
        $this->SetXY(173, 72);
        $this->Cell(42,0, $this->fieldsForm2_1['Form2CashRecieverName1'], 0, 0, 'N', 0, '', 1);

        //'Form2CashRecieverName2'
        $this->SetXY(155, 74.8);
        $this->Cell(60,0, $this->fieldsForm2_1['Form2CashRecieverName2'], 0, 0, 'N', 0, '', 1);

        //'Form2IFP'
        $this->SetXY(161.2, 78.7);
        $this->Cell(25,0, $this->fieldsForm2_1['Form2IFP'], 0, 0, 'C', 0, '', 4);

        //'Form2PayInCash'
        $this->SetXY(195.3, 80.2);
        $this->Cell(0,0, $this->fieldsForm2_1['Form2PayInCash'], 0, 0, 'N', 0, '', 1);

        //'Form2INN'
        $this->SetXY(161.2, 82.7);
        $this->Cell(32,0, $this->fieldsForm2_1['Form2INN'], 0, 0, 'C', 0, '', 4);

        //'Form2CorrAccount'
        $this->SetXY(161.2, 86.6);
        $this->Cell(53,0, $this->fieldsForm2_1['Form2CorrAccount'], 0, 0, 'C', 0, '', 4);

        //'Form2BankName1'
        $this->SetXY(169, 89.5);
        $this->Cell(45,0, $this->fieldsForm2_1['Form2BankName1'], 0, 0, 'N', 0, '', 1);

        //'Form2BankName2'
        $this->SetXY(154, 92.2);
        $this->Cell(60,0, $this->fieldsForm2_1['Form2BankName2'], 0, 0, 'N', 0, '', 1);

        //'Form2CheckAccount'
        $this->SetXY(161.2, 96.1);
        $this->Cell(53,0, $this->fieldsForm2_1['Form2CheckAccount'], 0, 0, 'C', 0, '', 4);

        //'Form2BIK'
        $this->SetXY(161.2, 100.2);
        $this->Cell(25,0, $this->fieldsForm2_1['Form2BIK'], 0, 0, 'C', 0, '', 4);

        //'Form2OGRN'
        $this->SetXY(161.2, 104.6);
        $this->Cell(40.5,0, $this->fieldsForm2_1['Form2OGRN'], 0, 0, 'C', 0, '', 4);

        //'Form2BankAddress1'
        $this->SetXY(161, 107);
        $this->Cell(54,0, $this->fieldsForm2_1['Form2BankAddress1'], 0, 0, 'N', 0, '', 1);

        //'Form2BankAddress2'
        $this->SetXY(154, 110);
        $this->Cell(61,0, $this->fieldsForm2_1['Form2BankAddress2'], 0, 0, 'N', 0, '', 1);

        //'Form2BankAddress3'
        $this->SetXY(154, 113);
        $this->Cell(45,0, $this->fieldsForm2_1['Form2BankAddress3'], 0, 0, 'N', 0, '', 1);

        //'Form2BankIndex'
        $this->SetXY(198, 112.8);
        $this->Cell(17.5,0, $this->fieldsForm2_1['Form2BankIndex'], 0, 0, 'C', 0, '', 4);
    }

    private function FillForm2_2(){
        $this->SetFont('dejavusans', '', 11, '', true);
        //'Form2Parcel'
        $this->SetXY(190, 18);
        $this->Cell(0,0, $this->fieldsForm2_2['Form2Parcel'], 0, 0, 'N', 0, '', 1);

        //'Form2Banderol'
        $this->SetXY(190, 23.7);
        $this->Cell(0,0, $this->fieldsForm2_2['Form2Banderol'], 0, 0, 'N', 0, '', 1);

        $this->SetFont('dejavusans', '', 7, '', true);
        //'Form2Insured'
        $this->SetXY(222.8, 18.2);
        $this->Cell(0,0, $this->fieldsForm2_2['Form2Insured'], 0, 0, 'N', 0, '', 1);

        //'Form2CashOnDelivery'
        $this->SetXY(222.8, 20.8);
        $this->Cell(0,0, $this->fieldsForm2_2['Form2CashOnDelivery'], 0, 0, 'N', 0, '', 1);

        //'Form2WithInventory'
        $this->SetXY(222.8, 23.4);
        $this->Cell(0,0, $this->fieldsForm2_2['Form2WithInventory'], 0, 0, 'N', 0, '', 1);

        //'Form2SimpleNotification'
        $this->SetXY(222.8, 26.1);
        $this->Cell(0,0, $this->fieldsForm2_2['Form2SimpleNotification'], 0, 0, 'N', 0, '', 1);

        //'Form2OrderedNotification'
        $this->SetXY(222.8, 28.8);
        $this->Cell(0,0, $this->fieldsForm2_2['Form2OrderedNotification'], 0, 0, 'N', 0, '', 1);

        $this->SetFont('dejavusans', '', 11, '', true);
        //'Form2PostOffice'
        $this->SetXY(234, 33.5);
        $this->Cell(23.3,0, $this->fieldsForm2_2['Form2PostOffice'], 0, 0, 'C', 0, '', 4);

        //'Form2SizeS'
        $this->SetXY(234.2, 37.3);
        $this->Cell(0,0, $this->fieldsForm2_2['Form2SizeS'], 0, 0, 'N', 0, '', 1);

        //'Form2SizeM'
        $this->SetXY(241.5, 37.3);
        $this->Cell(0,0, $this->fieldsForm2_2['Form2SizeM'], 0, 0, 'N', 0, '', 1);

        //'Form2SizeL'
        $this->SetXY(248.9, 37.3);
        $this->Cell(0,0, $this->fieldsForm2_2['Form2SizeL'], 0, 0, 'N', 0, '', 1);

        //'Form2Sender'
        $this->SetXY(157, 48.2);
        $this->Cell(64,0, $this->fieldsForm2_2['Form2Sender'], 0, 0, 'N', 0, '', 1);

        //'Form2SenderAddress1'
        $this->SetXY(152, 62);
        $this->Cell(69,0, $this->fieldsForm2_2['Form2SenderAddress1'], 0, 0, 'N', 0, '', 1);

        //'Form2SenderAddress2'
        $this->SetXY(152, 66.4);
        $this->Cell(69,0, $this->fieldsForm2_2['Form2SenderAddress2'], 0, 0, 'N', 0, '', 1);

        //'Form2SenderAddress3'
        $this->SetXY(152, 70.5);
        $this->Cell(69,0, $this->fieldsForm2_2['Form2SenderAddress3'], 0, 0, 'N', 0, '', 1);

        //'Form2SenderPhone'
        $this->SetXY(157, 77);
        $this->Cell(39,0, $this->fieldsForm2_2['Form2SenderPhone'], 0, 0, 'С', 0, '', 4);

        //'Form2SenderIndex'
        $this->SetXY(199, 77);
        $this->Cell(23.5,0, $this->fieldsForm2_2['Form2SenderIndex'], 0, 0, 'C', 0, '', 4);

        //'Form2SummInsured'
        $this->SetXY(223, 45.6);
        $this->Cell(69,0, $this->fieldsForm2_2['Form2SummInsured'], 0, 0, 'N', 0, '', 1);

        //'Form2SummCashOnDelivery'
        $this->SetXY(223, 55.2);
        $this->Cell(69,0, $this->fieldsForm2_2['Form2SummCashOnDelivery'], 0, 0, 'N', 0, '', 1);

        //'Form2Recipient'
        $this->SetXY(228, 70.8);
        $this->Cell(64,0, $this->fieldsForm2_2['Form2Recipient'], 0, 0, 'N', 0, '', 1);

        //'Form2RecipientAddress1'
        $this->SetXY(223, 83.8);
        $this->Cell(69,0, $this->fieldsForm2_2['Form2RecipientAddress1'], 0, 0, 'N', 0, '', 1);

        //'Form2RecipientAddress2'
        $this->SetXY(223, 88.2);
        $this->Cell(69,0, $this->fieldsForm2_2['Form2RecipientAddress2'], 0, 0, 'N', 0, '', 1);

        //'Form2RecipientAddress3'
        $this->SetXY(223, 92.5);
        $this->Cell(69,0, $this->fieldsForm2_2['Form2RecipientAddress3'], 0, 0, 'N', 0, '', 1);

        //'Form2RecipientPhone'
        $this->SetXY(227.7, 99.4);
        $this->Cell(39,0, $this->fieldsForm2_2['Form2RecipientPhone'], 0, 0, 'C', 0, '', 4);

        //'Form2RecipientIndex'
        $this->SetXY(269.7, 99.4);
        $this->Cell(23.5,0, $this->fieldsForm2_2['Form2RecipientIndex'], 0, 0, 'C', 0, '', 4);

        //'Form2Weight'
        $this->SetXY(231, 108.3);
        $this->Cell(13,0, $this->fieldsForm2_2['Form2Weight'], 0, 0, 'N', 0, '', 1);

        //'Form2Price'
        $this->SetXY(257, 108.3);
        $this->Cell(13,0, $this->fieldsForm2_2['Form2Price'], 0, 0, 'N', 0, '', 1);


        $this->SetFont('dejavusans', '', 7, '', true);
        //'Form2SenderNotification'
        $this->SetXY(154, 81.3);
        $this->Cell(0,0, $this->fieldsForm2_2['Form2SenderNotification'], 0, 0, 'N', 0, '', 1);

        //'Form2RecipientNotification'
        $this->SetXY(224.5, 103.7);
        $this->Cell(0,0, $this->fieldsForm2_2['Form2RecipientNotification'], 0, 0, 'N', 0, '', 1);

        //'Form2ReturnToAdress'
        $this->SetXY(153.7, 97);
        $this->Cell(0,0, $this->fieldsForm2_2['Form2ReturnToAdress'], 0, 0, 'N', 0, '', 1);

        //'Form2GroundTransport'
        $this->SetXY(153.7, 99.4);
        $this->Cell(0,0, $this->fieldsForm2_2['Form2GroundTransport'], 0, 0, 'N', 0, '', 1);

        //'Form2Heavy'
        $this->SetXY(153.7, 108.7);
        $this->Cell(0,0, $this->fieldsForm2_2['Form2Heavy'], 0, 0, 'N', 0, '', 1);

        //'Form2Simple'
        $this->SetXY(173.7, 108.7);
        $this->Cell(0,0, $this->fieldsForm2_2['Form2Simple'], 0, 0, 'N', 0, '', 1);

        //'Form2Large'
        $this->SetXY(153.7, 111.4);
        $this->Cell(0,0, $this->fieldsForm2_2['Form2Large'], 0, 0, 'N', 0, '', 1);

        //'Form2Registered'
        $this->SetXY(173.7, 111.4);
        $this->Cell(0,0, $this->fieldsForm2_2['Form2Registered'], 0, 0, 'N', 0, '', 1);

        //'Form2Standart'
        $this->SetXY(186.5, 108.7);
        $this->Cell(0,0, $this->fieldsForm2_2['Form2Standart'], 0, 0, 'N', 0, '', 1);

        //'Form2NonStandart'
        $this->SetXY(186.5, 111.4);
        $this->Cell(0,0, $this->fieldsForm2_2['Form2NonStandart'], 0, 0, 'N', 0, '', 1);

        //'Form2Regular'
        $this->SetXY(204, 108.7);
        $this->Cell(0,0, $this->fieldsForm2_2['Form2Regular'], 0, 0, 'N', 0, '', 1);
    }

    private function FillForm2_3(){
        $this->SetFont('dejavusans', '', 8, '', true);

        //'Form2Simple'
        $this->SetXY(209.6, 14.5);
        $this->Cell(0,0, $this->fieldsForm2_3['Form2Simple'], 0, 0, 'N', 0, '', 1);

        //'Form2Registered'
        $this->SetXY(209.6, 19.5);
        $this->Cell(0,0, $this->fieldsForm2_3['Form2Registered'], 0, 0, 'N', 0, '', 1);

        //'Form2WithNotification'
        $this->SetXY(209.6, 25.5);
        $this->Cell(0,0, $this->fieldsForm2_3['Form2WithNotification'], 0, 0, 'N', 0, '', 1);

        //'Form2WithInventory'
        $this->SetXY(209.6, 29.5);
        $this->Cell(0,0, $this->fieldsForm2_3['Form2WithInventory'], 0, 0, 'N', 0, '', 1);

        //'Form2Insured'
        $this->SetXY(229.3, 14.5);
        $this->Cell(0,0, $this->fieldsForm2_3['Form2Insured'], 0, 0, 'N', 0, '', 1);

        //'Form2CashOnDelivery'
        $this->SetXY(229.3, 19.5);
        $this->Cell(0,0, $this->fieldsForm2_3['Form2CashOnDelivery'], 0, 0, 'N', 0, '', 1);

        $this->SetFont('dejavusans', '', 11, '', true);
        //'Form2Sender1'
        $this->SetXY(165, 33);
        $this->Cell(49,0, $this->fieldsForm2_3['Form2Sender1'], 0, 0, 'N', 0, '', 1);

        //'Form2Sender2'
        $this->SetXY(153, 38.5);
        $this->Cell(60,0, $this->fieldsForm2_3['Form2Sender2'], 0, 0, 'N', 0, '', 1);

        //'Form2SenderAddress1'
        $this->SetXY(165.5, 45);
        $this->Cell(47,0, $this->fieldsForm2_3['Form2SenderAddress1'], 0, 0, 'N', 0, '', 1);

        //'Form2SenderAddress2'
        $this->SetXY(153, 50.3);
        $this->Cell(60,0, $this->fieldsForm2_3['Form2SenderAddress2'], 0, 0, 'N', 0, '', 1);

        //'Form2SenderAddress3'
        $this->SetXY(153, 56);
        $this->Cell(60,0, $this->fieldsForm2_3['Form2SenderAddress3'], 0, 0, 'N', 0, '', 1);

        //'Form2SenderIndex'
        $this->SetXY(183.5, 61.5);
        $this->Cell(29,0, $this->fieldsForm2_3['Form2SenderIndex'], 0, 0, 'C', 0, '', 4);

        //'Form2SummInsured'
        $this->SetXY(215, 38);
        $this->Cell(77,0, $this->fieldsForm2_3['Form2SummInsured'], 0, 0, 'N', 0, '', 1);

        //'Form2SummCashOnDelivery'
        $this->SetXY(215, 47);
        $this->Cell(77,0, $this->fieldsForm2_3['Form2SummCashOnDelivery'], 0, 0, 'N', 0, '', 1);

        //'Form2Recipient1'
        $this->SetXY(228, 57);
        $this->Cell(64,0, $this->fieldsForm2_3['Form2Recipient1'], 0, 0, 'N', 0, '', 1);

        //'Form2Recipient2'
        $this->SetXY(220, 63);
        $this->Cell(72,0, $this->fieldsForm2_3['Form2Recipient2'], 0, 0, 'N', 0, '', 1);

        //'Form2RecipientAddress1'
        $this->SetXY(228, 70.5);
        $this->Cell(64,0, $this->fieldsForm2_3['Form2RecipientAddress1'], 0, 0, 'N', 0, '', 1);

        //'Form2RecipientAddress2'
        $this->SetXY(220, 76);
        $this->Cell(72,0, $this->fieldsForm2_3['Form2RecipientAddress2'], 0, 0, 'N', 0, '', 1);

        //'Form2RecipientAddress3'
        $this->SetXY(220, 81.5);
        $this->Cell(42,0, $this->fieldsForm2_3['Form2RecipientAddress3'], 0, 0, 'N', 0, '', 1);

        //'Form2RecipientIndex'
        $this->SetXY(262, 81.5);
        $this->Cell(29,0, $this->fieldsForm2_3['Form2RecipientIndex'], 0, 0, 'C', 0, '', 4);

        //'Form2Weight'
        $this->SetXY(161, 69);
        $this->Cell(25,0, $this->fieldsForm2_3['Form2Weight'], 0, 0, 'N', 0, '', 1);

        //'Form2Price'
        $this->SetXY(165, 73.8);
        $this->Cell(25,0, $this->fieldsForm2_3['Form2Price'], 0, 0, 'N', 0, '', 1);

        $this->SetFont($this->zipcode,'',45);
        //'Form1ClientInfo
        $this->SetXY(162.5, 88);
        $this->Cell(54,0, $this->fieldsForm2_3['Form2IndexZip'], 0, 0, 'C', 0, '', 4);
    }

    public static function PDF1() {
        $this->AddPage();
        $this->setSourceFile($_SERVER["DOCUMENT_ROOT"].'/pdf/templates/PDF1.pdf');
        $tplId = $this->importPage(1);
        $this->useTemplate($tplId, 0, 0);

        $this->FillForm1();
        $this->FillForm2_1();

        $filename = $_SERVER["DOCUMENT_ROOT"] .'/pdf/exit/1Form.pdf';
        while (true) {
            $filename = $_SERVER["DOCUMENT_ROOT"] . '/pdf/exit/' . '1Form' . uniqid() . '.pdf';
            if (!file_exists($filename)) break;
        }
        ob_start();
        $this->Output('1Form.pdf', 'I');
        $pdfBase64 = ob_get_contents();
        ob_end_clean();
        echo base64_encode($pdfBase64);
        $this->Output($filename, 'F');
    }

    public static function PDF2() {
        $this->AddPage();
        $this->setSourceFile($_SERVER["DOCUMENT_ROOT"].'/pdf/templates/PDF2.pdf');
        $tplId = $this->importPage(1);
        $this->useTemplate($tplId, 0, 0);

        $this->FillForm1();
        $this->FillForm2_2();

        $filename = $_SERVER["DOCUMENT_ROOT"] .'/pdf/exit/2Form.pdf';
        while (true) {
            $filename = $_SERVER["DOCUMENT_ROOT"] . '/pdf/exit/' . '2Form' . uniqid() . '.pdf';
            if (!file_exists($filename)) break;
        }
        ob_start();
        $this->Output('2Form.pdf', 'I');
        $pdfBase64 = ob_get_contents();
        ob_end_clean();
        echo base64_encode($pdfBase64);
        $this->Output($filename, 'F');
    }

    public function PDF3() {
        $this->AddPage();
        $this->setSourceFile($_SERVER["DOCUMENT_ROOT"].'/pdf/templates/PDF3.pdf');
        $tplId = $this->importPage(1);
        $this->useTemplate($tplId, 0, 0);

        $this->FillForm1();
        $this->FillForm2_3();

        $filename = $_SERVER["DOCUMENT_ROOT"] .'/pdf/exit/3Form.pdf';
        while (true) {
            $filename = $_SERVER["DOCUMENT_ROOT"] . '/pdf/exit/' . '3Form' . uniqid() . '.pdf';
            if (!file_exists($filename)) break;
        }

        ob_start();
        $this->Output('3Form.pdf', 'I');
        $pdfBase64 = ob_get_contents();
        ob_end_clean();
        echo base64_encode($pdfBase64);
        $this->Output($filename, 'F');
    }
    
    function PDFAll() {
        $pdfNames = array('PDF1','PDF2','PDF3');
        foreach ($pdfNames as &$pdfName) {
            $this->AddPage();
            $this->setSourceFile($_SERVER["DOCUMENT_ROOT"].'/pdf/templates/'.$pdfName.'.pdf');
            $tplId = $this->importPage(1);
            $this->useTemplate($tplId, 0, 0);
            $this->FillForm1();
            $func = 'FillForm2_'.substr($pdfName, -1);
            $this->$func();
        }

        $filename = $_SERVER["DOCUMENT_ROOT"] .'/pdf/exit/AllForm.pdf';
        while (true) {
            $filename = $_SERVER["DOCUMENT_ROOT"] . '/pdf/exit/' . 'AllForm' . uniqid() . '.pdf';
            if (!file_exists($filename)) break;
        }

        ob_start();
        $this->Output('AllForm.pdf', 'I');
        $pdfBase64 = ob_get_contents();
        ob_end_clean();
        echo base64_encode($pdfBase64);
        $this->Output($filename, 'F');
    }
    
    
// 	function fieldsForm1() {
// 		return array(
//             'Form1BarcodeNumber' 		=> isset($_POST['Form1BarcodeNumber']) ? $_POST['Form1BarcodeNumber'] : 0,          //Номер штрих-кода
//             'Form1ClientInfo' 			=> isset($_POST['Form1ClientInfo']) ? $_POST['Form1ClientInfo'] : 0,       		    //Имя
//             'Form1Rub' 					=> isset($_POST['Form1Rub']) ? $_POST['Form1Rub'] : 0,            			        //Рубли
//             'Form1Cent' 				=> isset($_POST['Form1Cent']) ? $_POST['Form1Cent'] : 0,                	        //Копейки
//             'Form1CashOnDelivery' 		=> isset($_POST['Form1CashOnDelivery']) ? "X" : " ",    	                        //Наложенный платеж
//             'Form1SummInWords' 			=> isset($_POST['Form1SummInWords']) ? $_POST['Form1SummInWords'] : 0,        	    //Сумма прописью
//             'Form1WithNotification' 	=> isset($_POST['Form1WithNotification']) ? "X" : " ",                              //С уведомлением
//             'Form1SenderPhone' 			=> isset($_POST['Form1SenderPhone']) ? $_POST['Form1SenderPhone'] : 0,        	    //Телефон отправителя
//             'Form1ToWhom' 				=> isset($_POST['Form1ToWhom']) ? $_POST['Form1ToWhom'] : 0,        		        //Кому
//             'Form1ToWhere1' 			=> isset($_POST['Form1ToWhere1']) ? $_POST['Form1ToWhere1'] : 0,        		    //Куда(1)
//             'Form1ToWhere2' 			=> isset($_POST['Form1ToWhere2']) ? $_POST['Form1ToWhere2'] : 0,                    //Куда(2)
//             'Form1Message1' 			=> isset($_POST['Form1ToMessage1']) ? $_POST['Form1ToMessage1'] : 0,                //Сообщение(1)
//             'Form1Message2' 			=> isset($_POST['Form1ToMessage2']) ? $_POST['Form1ToMessage2'] : 0,                //Сообщение(2)
//             'Form1FromWhom' 			=> isset($_POST['Form1FromWhom']) ? $_POST['Form1FromWhom'] : 0,                    //От кого
//             'Form1SenderAddress1' 		=> isset($_POST['Form1SenderAddress1']) ? $_POST['Form1SenderAddress1'] : 0,        //Адрес отправителя(1)
//             'Form1SenderAddress2' 		=> isset($_POST['Form1SenderAddress2']) ? $_POST['Form1SenderAddress2'] : 0,        //Адрес отправителя(2)
//             'Form1SenderIndex' 			=> isset($_POST['Form1SenderIndex']) ? $_POST['Form1SenderIndex'] : 0,              //Индекс отправителя
//             'Form1SenderRegAddress1' 	=> isset($_POST['Form1SenderRegAddress1']) ? $_POST['Form1SenderRegAddress1'] : 0,  //Адрес регистрации отправителя(1)
//             'Form1SenderRegAddress2' 	=> isset($_POST['Form1SenderRegAddress2']) ? $_POST['Form1SenderRegAddress2'] : 0,  //Адрес регистрации отправителя(2)
//             'Form1SenderRegIndex' 		=> isset($_POST['Form1SenderRegIndex']) ? $_POST['Form1SenderRegIndex'] : 0,        //Индекс регистрации отправитля
//             'Form1SenderDoc' 			=> isset($_POST['Form1SenderDoc']) ? $_POST['Form1SenderDoc'] : 0,                  //Тип документа отправителя
//             'Form1SenderDocSerial' 		=> isset($_POST['Form1SenderDocSerial']) ? $_POST['Form1SenderDocSerial'] : 0,      //Серия документа
//             'Form1SenderDocNumber' 		=> isset($_POST['Form1SenderDocNumber']) ? $_POST['Form1SenderDocNumber'] : 0,      //Номер документа
//             'Form1SenderDocGiven' 		=> isset($_POST['Form1SenderDocGiven']) ? $_POST['Form1SenderDocGiven'] : 0,        //Дата выдачи документа
//             'Form1SenderDocPlace1' 		=> isset($_POST['Form1SenderDocPlace1']) ? $_POST['Form1SenderDocPlace1'] : 0,      //Где выдан документ(1)
//             'Form1SenderDocPlace2' 		=> isset($_POST['Form1SenderDocPlace2']) ? $_POST['Form1SenderDocPlace2'] : 0,      //Где выдан документ(2)
//             'Form1SenderDocCode' 		=> isset($_POST['Form1SenderDocCode']) ? $_POST['Form1SenderDocCode'] : 0,          //Код подразделения
//             'Form1SenderINN' 			=> isset($_POST['Form1SenderINN']) ? $_POST['Form1SenderINN'] : 0,                  //ИНН отправителя
//             'Form1SenderSitizenship' 	=> isset($_POST['Form1SenderSitizenship']) ? $_POST['Form1SenderSitizenship'] : 0,  //Гражданство отправителя
//             'Form1SenderBirth' 			=> isset($_POST['Form1SenderBirth']) ? $_POST['Form1SenderBirth'] : 0,              //Дата рождения отправителя
//             'Form1MigrationSerial' 		=> isset($_POST['Form1MigrationSerial']) ? $_POST['Form1MigrationSerial'] : 0,      //Серия миграционной карты
//             'Form1MigrationNumber' 		=> isset($_POST['Form1MigrationNumber']) ? $_POST['Form1MigrationNumber'] : 0,      //Номер миграционной карты
//             'Form1MigrationGiven' 		=> isset($_POST['Form1MigrationGiven']) ? $_POST['Form1MigrationGiven'] : 0,        //Дата выдачи миграционной карты
//             'Form1MigrationFrom' 		=> isset($_POST['Form1MigrationFrom']) ? $_POST['Form1MigrationFrom'] : 0,          //Срок пребывания с
//             'Form1MigrationTo' 			=> isset($_POST['Form1MigrationTo']) ? $_POST['Form1MigrationTo'] : 0,              //Срок пребывания по
//             'Form1OfficialYes' 			=> isset($_POST['Form1OfficialYes']) ? "X" : " ",                                   //Являетесь ли вы должностным лицом(да)
//             'Form1OfficialNo' 			=> isset($_POST['Form1OfficialNo']) ? "X" : " ",                                    //Являетесь ли вы должностным лицом(нет)
//             'Form1Consent' 				=> isset($_POST['Form1Consent']) ? "X" : " "                		                //Согласие на оповещения
// 		);
// 	}
// 	function fieldsForm2_1() {
// 		return array(
//             'Form2Standart' 			=> isset($_POST['Form2Standart']) ? "X" : " ",                                      //Стандартная посылка
//             'Form2Simple' 				=> isset($_POST['Form2Simple']) ? "X" : " ",                                        //Обыкновенная
//             'Form2Insured' 				=> isset($_POST['Form2Insured']) ? "X" : " ",                                       //С объявленной ценностью
//             'Form2CashOnDelivery' 		=> isset($_POST['Form2CashOnDelivery']) ? "X" : " ",                                //С наложенным платежом
//             'Form2Sender1' 				=> isset($_POST['Form2Sender1']) ? $_POST['Form2Sender1'] : 0,                      //От кого(1)
//             'Form2Sender2' 				=> isset($_POST['Form2Sender2']) ? $_POST['Form2Sender2'] : 0,                      //От кого(2)
//             'Form2SenderAddress1' 		=> isset($_POST['Form2SenderAddress1']) ? $_POST['Form2SenderAddress1'] : 0,        //Адрес отправителя(1)
//             'Form2SenderAddress2' 		=> isset($_POST['Form2SenderAddress2']) ? $_POST['Form2SenderAddress2'] : 0,        //Адрес отправителя(2)
//             'Form2SenderAddress3' 		=> isset($_POST['Form2SenderAddress3']) ? $_POST['Form2SenderAddress3'] : 0,        //Адрес отправителя(3)
//             'Form2SenderPhone' 			=> isset($_POST['Form2SenderPhone']) ? $_POST['Form2SenderPhone'] : 0,              //Телефон отправителя
//             'Form2SenderIndex' 			=> isset($_POST['Form2SenderIndex']) ? $_POST['Form2SenderIndex'] : 0,              //Индекс отправителя
//             'Form2CashReciever' 		=> isset($_POST['Form2CashReciever']) ? $_POST['Form2CashReciever'] : 0,            //Реквизиты получателя наложенного платежа
//             'Form2CashRecieverName1' 	=> isset($_POST['Form2CashRecieverName1']) ? $_POST['Form2CashRecieverName1'] : 0,  //Наименование получателя(1)
//             'Form2CashRecieverName2' 	=> isset($_POST['Form2CashRecieverName2']) ? $_POST['Form2CashRecieverName2'] : 0,  //Наименование получателя(2)
//             'Form2IFP' 					=> isset($_POST['Form2IFP']) ? $_POST['Form2IFP'] : 0,                              //ИФП\ИРП
//             'Form2PayInCash' 			=> isset($_POST['Form2PayInCash']) ? "X" : " ",                                     //Выплатить наличными
//             'Form2INN' 					=> isset($_POST['Form2INN']) ? $_POST['Form2INN'] : 0,                              //ИНН
//             'Form2CorrAccount' 			=> isset($_POST['Form2CorrAccount']) ? $_POST['Form2CorrAccount'] : 0,              //Кор\счет
//             'Form2BankName1' 			=> isset($_POST['Form2BankName1']) ? $_POST['Form2BankName1'] : 0,                  //Наименование банка(1)
//             'Form2BankName2' 			=> isset($_POST['Form2BankName2']) ? $_POST['Form2BankName2'] : 0,                  //Наименование банка(2)
//             'Form2CheckAccount' 		=> isset($_POST['Form2CheckAccount']) ? $_POST['Form2CheckAccount'] : 0,            //Рас\счет
//             'Form2BIK' 					=> isset($_POST['Form2BIK']) ? $_POST['Form2BIK'] : 0,                              //БИК
//             'Form2OGRN' 				=> isset($_POST['Form2OGRN']) ? $_POST['Form2OGRN'] : 0,                            //ОГРН
//             'Form2BankAddress1' 		=> isset($_POST['Form2BankAddress1']) ? $_POST['Form2BankAddress1'] : 0,            //Адрес банка(1)
//             'Form2BankAddress2' 		=> isset($_POST['Form2BankAddress2']) ? $_POST['Form2BankAddress2'] : 0,            //Адрес банка(2)
//             'Form2BankAddress3' 		=> isset($_POST['Form2BankAddress3']) ? $_POST['Form2BankAddress3'] : 0,            //Адрес банка(3)
//             'Form2BankIndex' 			=> isset($_POST['Form2BankIndex']) ? $_POST['Form2BankIndex'] : 0,                  //Индекс банка
//             'Form2SummInsured' 			=> isset($_POST['Form2SummInsured']) ? $_POST['Form2SummInsured'] : 0,              //Сумма объявленной ценности
//             'Form2SummCashOnDelivery' 	=> isset($_POST['Form2SummCashOnDelivery']) ? $_POST['Form2SummCashOnDelivery'] : 0,//Сумма наложенного платежа
//             'Form2Recipient1' 			=> isset($_POST['Form2Recipient1']) ? $_POST['Form2Recipient1'] : 0,                //Кому(1)
//             'Form2Recipient2' 			=> isset($_POST['Form2Recipient2']) ? $_POST['Form2Recipient2'] : 0,                //Кому(2)
//             'Form2RecipientAddress1' 	=> isset($_POST['Form2RecipientAddress1']) ? $_POST['Form2RecipientAddress1'] : 0,  //Адрес получателя(1)
//             'Form2RecipientAddress2' 	=> isset($_POST['Form2RecipientAddress2']) ? $_POST['Form2RecipientAddress2'] : 0,  //Адрес получателя(2)
//             'Form2RecipientAddress3' 	=> isset($_POST['Form2RecipientAddress3']) ? $_POST['Form2RecipientAddress3'] : 0,  //Адрес получателя(3)
//             'Form2RecipientIndex' 		=> isset($_POST['Form2RecipientIndex']) ? $_POST['Form2RecipientIndex'] : 0,        //Индекс получателя
//             'Form2Weight' 				=> isset($_POST['Form2Weight']) ? $_POST['Form2Weight'] : 0,                        //Вес
//             'Form2Price' 				=> isset($_POST['Form2Price']) ? $_POST['Form2Price'] : 0                           //Плата
// 		);
// 	}
// 	function fieldsForm2_2() {
// 		return array(
//  	      	'Form2Parcel'               => isset($_POST['Form2Parcel']) ? "X" : " ",                                        //Посылка
//  	      	'Form2Banderol'             => isset($_POST['Form2Banderol']) ? "X" : " ",                                      //Бандероль
//  	      	'Form2Insured'              => isset($_POST['Form2Insured']) ? "X" : " ",                                       //С объявленной ценностью
//  	      	'Form2CashOnDelivery'       => isset($_POST['Form2CashOnDelivery']) ? "X" : " ",                                //С наложенным платежом
//  	      	'Form2WithInventory'        => isset($_POST['Form2WithInventory']) ? "X" : " ",                                 //С описью
//  	      	'Form2SimpleNotification'   => isset($_POST['Form2SimpleNotification']) ? "X" : " ",                            //С простым уведомлением
//  	      	'Form2OrderedNotification'  => isset($_POST['Form2OrderedNotification']) ? "X" : " ",                           //С заказным уведомлением
//  	      	'Form2PostOffice'           => isset($_POST['Form2PostOffice']) ? $_POST['Form2PostOffice'] : 0,                //Почтомат №
//  	      	'Form2SizeS'                => isset($_POST['Form2SizeS']) ? "X" : " ",                                         //Габариты S
//  	      	'Form2SizeM'                => isset($_POST['Form2SizeM']) ? "X" : " ",                                         //Габариты M
//  	      	'Form2SizeL'                => isset($_POST['Form2SizeL']) ? "X" : " ",                                         //Габариты L
//  	      	'Form2Sender'               => isset($_POST['Form2Sender']) ? $_POST['Form2Sender'] : 0,                        //От кого
//  	      	'Form2SenderAddress1'       => isset($_POST['Form2SenderAddress1']) ? $_POST['Form2SenderAddress1'] : 0,        //Откуда(1)
//  	      	'Form2SenderAddress2'       => isset($_POST['Form2SenderAddress2']) ? $_POST['Form2SenderAddress2'] : 0,        //Откуда(2)
//  	      	'Form2SenderAddress3'       => isset($_POST['Form2SenderAddress3']) ? $_POST['Form2SenderAddress3'] : 0,        //Откуда(3)
//  	      	'Form2SenderPhone'          => isset($_POST['Form2SenderPhone']) ? $_POST['Form2SenderPhone'] : 0,              //Телефон отправителя
//  	      	'Form2SenderIndex'          => isset($_POST['Form2SenderIndex']) ? $_POST['Form2SenderIndex'] : 0,              //Индекс отправителя
//  	      	'Form2SenderNotification'   => isset($_POST['Form2SenderNotification']) ? "X" : " ",                            //Согласие на уведомление о вручении
//  	      	'Form2SummInsured'          => isset($_POST['Form2SummInsured']) ? $_POST['Form2SummInsured'] : 0,              //Сумма объявленной ценности
//  	      	'Form2SummCashOnDelivery'   => isset($_POST['Form2SummCashOnDelivery']) ? $_POST['Form2SummCashOnDelivery'] : 0,//Сумма наложенного платежа
//  	      	'Form2Recipient'            => isset($_POST['Form2Recipient']) ? $_POST['Form2Recipient'] : 0,                  //Кому
//  	      	'Form2RecipientAddress1'    => isset($_POST['Form2RecipientAddress1']) ? $_POST['Form2RecipientAddress1'] : 0,  //Куда(1)
//  	      	'Form2RecipientAddress2'    => isset($_POST['Form2RecipientAddress2']) ? $_POST['Form2RecipientAddress2'] : 0,  //Куда(2)
//  	      	'Form2RecipientAddress3'    => isset($_POST['Form2RecipientAddress3']) ? $_POST['Form2RecipientAddress3'] : 0,  //Куда(3)
//  	      	'Form2RecipientPhone'       => isset($_POST['Form2RecipientPhone']) ? $_POST['Form2RecipientPhone'] : 0,        //Телефон получателя
//  	      	'Form2RecipientIndex'       => isset($_POST['Form2RecipientIndex']) ? $_POST['Form2RecipientIndex'] : 0,        //Индекс получателя
//  	      	'Form2RecipientNotification'=> isset($_POST['Form2RecipientNotification']) ? "X" : " ",                         //Согласие на уведомление о поступлении в отделение
//  	      	'Form2ReturnToAdress'       => isset($_POST['Form2ReturnToAdress']) ? "X" : " ",                                //Вернуть по обратному адресу
//  	      	'Form2GroundTransport'      => isset($_POST['Form2GroundTransport']) ? "X" : " ",                               //Направить наземным транспортом
//  	      	'Form2Heavy'                => isset($_POST['Form2Heavy']) ? "X" : " ",                                         //Тяжеловесная
//  	      	'Form2Simple'               => isset($_POST['Form2Simple']) ? "X" : " ",                                        //Простая
//  	      	'Form2Large'                => isset($_POST['Form2Large']) ? "X" : " ",                                         //Крупногабаритная
//  	      	'Form2Registered'           => isset($_POST['Form2Registered']) ? "X" : " ",                                    //Заказная
//  	      	'Form2Standart'             => isset($_POST['Form2Standart']) ? "X" : " ",                                      //Стандартная
//  	      	'Form2NonStandart'          => isset($_POST['Form2NonStandart']) ? "X" : " ",                                   //Нестандартная
//  	      	'Form2Regular'              => isset($_POST['Form2Regular']) ? "X" : " ",                                       //Обыкноваенная
//  	      	'Form2Weight'               => isset($_POST['Form2Weight']) ? $_POST['Form2Weight'] : 0,                        //Вес
//  	      	'Form2Price'                => isset($_POST['Form2Price']) ? $_POST['Form2Price'] : 0                           //Плата
//  		  );
// 	}
// 	function fieldsForm2_3() {
// 		return array(
//             'Form2Simple'					=> isset($_POST['Form2Simple']) ? "X" : " ",                                        //Обыкновенная
//             'Form2Registered'				=> isset($_POST['Form2Registered']) ? "X" : " ",                                    //Заказная
//             'Form2WithNotification'		=> isset($_POST['Form2SimpleNotification']) ? "X" : " ",                           //С простым уведомлением
//             'Form2WithInventory'			=> isset($_POST['Form2WithInventory']) ? "X" : " ",                                 //С описью
//             'Form2Insured'					=> isset($_POST['Form2Insured']) ? "X" : " ",                                       //С объявленной ценностью
//             'Form2CashOnDelivery'		=> isset($_POST['Form2CashOnDelivery']) ? "X" : " ",                                //С наложенным платежом
//             'Form2Sender1'					=> isset($_POST['Form2Sender1']) ? $_POST['Form2Sender1'] : 0,                      //От кого(1)
//             'Form2Sender2'					=> isset($_POST['Form2Sender2']) ? $_POST['Form2Sender2'] : 0,                      //От кого(2)
//             'Form2SenderAddress1'		=> isset($_POST['Form2SenderAddress1']) ? $_POST['Form2SenderAddress1'] : 0,        //Адрес отправителя(1)
//             'Form2SenderAddress2'		=> isset($_POST['Form2SenderAddress2']) ? $_POST['Form2SenderAddress2'] : 0,        //Адрес отправителя(2)
//             'Form2SenderAddress3'		=> isset($_POST['Form2SenderAddress3']) ? $_POST['Form2SenderAddress3'] : 0,        //Адрес отправителя(3)
//             'Form2SenderIndex'			=> isset($_POST['Form2SenderIndex']) ? $_POST['Form2SenderIndex'] : 0,              //Индекс отправителя
//             'Form2Weight'					=> isset($_POST['Form2Weight']) ? $_POST['Form2Weight'] : 0,                        //Вес
//             'Form2Price'					=> isset($_POST['Form2Price']) ? $_POST['Form2Price'] : 0,                          //Плата
//             'Form2Index'					=> isset($_POST['Form2Index']) ? $_POST['Form2Index'] : 0,                          //Индекс
//             'Form2SummInsured'			=> isset($_POST['Form2SummInsured']) ? $_POST['Form2SummInsured'] : 0,              //Сумма объявленной ценности
//             'Form2SummCashOnDelivery'	=> isset($_POST['Form2SummCashOnDelivery']) ? $_POST['Form2SummCashOnDelivery'] : 0,//Сумма наложенного платежа
//             'Form2Recipient1'				=> isset($_POST['Form2Recipient1']) ? $_POST['Form2Recipient1'] : 0,                //Кому(1)
//             'Form2Recipient2'				=> isset($_POST['Form2Recipient2']) ? $_POST['Form2Recipient2'] : 0,                //Кому(2)
//             'Form2RecipientAddress1'	=> isset($_POST['Form2RecipientAddress1']) ? $_POST['Form2RecipientAddress1'] : 0,  //Адрес получателя(1)
//             'Form2RecipientAddress2'	=> isset($_POST['Form2RecipientAddress2']) ? $_POST['Form2RecipientAddress2'] : 0,  //Адрес получателя(2)
//             'Form2RecipientAddress3'	=> isset($_POST['Form2RecipientAddress3']) ? $_POST['Form2RecipientAddress3'] : 0,  //Адрес получателя(3)
//             'Form2RecipientIndex'		=> isset($_POST['Form2RecipientIndex']) ? $_POST['Form2RecipientIndex'] : 0,        //Индекс получателя
//  		  );
// 	}
// 
// 	//pdf1
//    function pdf1() {
// 
// 		//Загружаем нужный нам файл (в данном случае это первый пдф)
// 		$pdf = new FPDM($_SERVER["DOCUMENT_ROOT"].'/pdf/templates/number1Res.pdf');
// 		$pdf->useCheckboxParser = true;
// 
// 	 	//Заполняем поля первой половины
// 		$pdf->Load(self::fieldsForm1(), true);
// 		$pdf->Merge();
// 	
// 		//Заполняем поля второй половины
// 		$pdf->Load(self::fieldsForm2_1(), true);
// 		$pdf->Merge();
// 
// 		//Получаем готовый pdf
//         $filename = $_SERVER["DOCUMENT_ROOT"] .'/pdf/exit/1Form.pdf';
//         while (true) {
//             $filename = $_SERVER["DOCUMENT_ROOT"] . '/pdf/exit/' . '1Form' . uniqid() . '.pdf';
//             if (!file_exists($filename)) break;
//         }
// 		$pdf->Output('F', $filename);
//         //$pdf->Output('D');
//         echo 'Done';
//     }
// 
//     function pdf2() {
// 		//Загружаем нужный нам файл (в данном случае это второй пдф)
//  		$pdf = new FPDM($_SERVER["DOCUMENT_ROOT"].'/pdf/templates/number2Res.pdf');
//  		$pdf -> useCheckboxParser  =  true;
// 
//  		//Заполняем поля первой половины
// 		$pdf->Load(self::fieldsForm1(), true);
//  		$pdf->Merge();
// 
//  		//Заполняем поля второй половины
//  		$pdf->Load(self::fieldsForm2_2(), true);
//  		$pdf->Merge();
// 
//  		//Получаем готовый pdf
// 		$filename = $_SERVER["DOCUMENT_ROOT"] .'/pdf/exit/2Form.pdf';
// 		while (true) {
// 			$filename = $_SERVER["DOCUMENT_ROOT"] . '/pdf/exit/' . '2Form' . uniqid() . '.pdf';
// 			if (!file_exists($filename)) break;
// 		}
// 		$pdf->Output('F', $filename);
// 		echo 'Done';
// 	}
// 
// 	function pdf3() {
// 		//Загружаем нужный нам файл (в данном случае это третий пдф)
//  		$pdf = new FPDM($_SERVER["DOCUMENT_ROOT"].'/pdf/templates/number3Res.pdf');
//  		$pdf -> useCheckboxParser  =  true;
// 
//  		//Заполняем поля первой половины
// 		$pdf->Load(self::fieldsForm1(), true);
//  		$pdf->Merge();
// 
//  		//Заполняем поля второй половины
//  		$pdf->Load(self::fieldsForm2_3(), true);
//  		$pdf->Merge();
// 
//  		//Получаем готовый pdf
// 		$filename = $_SERVER["DOCUMENT_ROOT"] .'/pdf/exit/3Form.pdf';
// 		while (true) {
// 			$filename = $_SERVER["DOCUMENT_ROOT"] . '/pdf/exit/' . '3Form' . uniqid() . '.pdf';
// 			if (!file_exists($filename)) break;
// 		}
// 		$pdf->Output('F', $filename);
// 		echo 'Done';
//     }
}

?>