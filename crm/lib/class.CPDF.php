<?php
namespace lib;

/**
 * class.CPDF.php
 *
 * Класс - библиотека для работы с PDF
 * подгружается через автоподгрузку классов
 *
 * История:	2019.07.19 - файл создан
 *
 **/


require_once('./vendor/autoload.php');
use setasign\Fpdi\Tcpdf\Fpdi;

class CPDF extends Fpdi {
	
	private $barcode_style;
	private $fieldsForm1;
	private $fieldsForm2_1;
	private $fieldsForm2_2;
	private $fieldsForm2_3;

	
	public function Init($ids = null, $list = null, $proj = null, $account = null) {
		
		$Simple	 							= '';					//Простое
		$Ordered 							= '';					//Заказное
		$Ordinary 							= '';					//Обыкновенное
		$With_declared_value 			= '';					//С объявленной ценностью
		$Cash_on_delivery 				= '';					//наложенным платежом
				
		$empty 								= '';					//пустое значение
		$weight 								= '';					//масса
		$realylongtest 					= '';
		$longtest 							= '';
		$shorttest 							= '';
		$barcode 							= '000000000000000000';
		$indextest							= '';
		$phonetest 							= '';
		$inntest 							= '';
		$ifptest 							= '';
		$cortest 							= '';
		$orgntest 							= '';
		$messagetest 						= '';
		$checktest 							= '';
		$Form2RecipientAddress1			= '';
		$Form2RecipientAddress2			= '';
		$Form2RecipientAddress3			= '';		
		
// 		$ids = 1008281;
// 		$list = 19;
		
		//данные заказа
		$userPost = [];
		$res = JBase::Get_Data('list'. (int)$list, '*', ['id' => (int)$ids[0]]);
		while ($param = $res->fetch_assoc()) $userPost = $param; //данные по заказу
		$userPost['weight'] = 0;
		foreach (json_decode($userPost['goods_names'],true) as $goods_names) {
			$res = JBase::Get_Data('list22', '*', ['id' => $goods_names['id']]);
			$param = $res->fetch_assoc();
			$userPost['weight'] += $param['weight'];
		}
		//Шаблон онлайн-сервиса Отправка
		$list11 = []; 
		$res = JBase::Get_Data('list11', '*', ['accountTemplate' => (int)$proj, 'account' => (int)$account, 'status' => '1']); //аккаунт почты россии
		//$res = JBase::Get_Data('list11', '*', ['accountTemplate' => (int)$proj, 'account' => (int)$account, 'status' => '1']); //аккаунт почты россии
		while ($param = $res->fetch_assoc()) $list11 = $param; //данные по заказу
//var_dump($proj); exit();
		switch ($list11['sender_mailCtg']) {
			case 'SIMPLE': //Простое
				$Simple = 'x';
			break;
			case 'ORDERED'://Заказное
				$Ordered = 'x';
			break;
			case 'ORDINARY'://Обыкновенное
				$Ordinary = 'x';
			break;
			case 'WITH_DECLARED_VALUE'://С объявленной ценностью
				$With_declared_value = 'x';
			break;
			case 'WITH_DECLARED_VALUE_AND_CASH_ON_DELIVERY'://С объявленной ценностью и наложенным платежом
				$With_declared_value = 'x';
				$Cash_on_delivery = 'x';
			break;
		}
			
		$this->setPrintHeader(false);
		$this->setPrintFooter(false);
		
		//price
		$price 									= (!empty($userPost['total'])) ? explode(".", (float)$userPost['total']) : ['0000','00'];
		$SummInWords 							= self::SummInWords((float)$userPost['total'], true);
		$SummInWords 							= mb_strtoupper(mb_substr($SummInWords, 0, 1, 'UTF-8'), 'UTF-8') . mb_substr($SummInWords, 1, null, 'UTF-8'); //Сумма прописью
		$SummPriceInWords 					= $price[0] .' руб '. ((isset($price[1])) ?: '00') .' коп. ('. $SummInWords .')';//Сумма прописью
		$Form1Rub 								= $price[0];
		// $Form1Cent 								= ($price[1]) ?: '00';
		$Form1Cent 								= (isset($price[1])) ? $price[1] : '00';
		
		//phone
		// $phone 									= (!empty($userPost['phone'])) ? substr($userPost['phone'], -10) : '78005553535';
		$phone = '';
		$postIndex 								= ($userPost['postIndex']) ?: '000000';
		$weight								= $userPost['weight']; //пока не актуально

		$dop4 = $userPost['weight'];
		
		//адрес клиента
		$flat = ($userPost['flat']) ? 'кв '. $userPost['flat'] : '';
		//$UserAddress = (!empty($userPost['page'])) ? $userPost['page'] : $userPost['address'] .' '. $userPost['house'] .' '. $flat .', '. $userPost['city'] .', '. $userPost['region']; //временно		
		$UserAddress = (!empty($userPost['address'])) ? $userPost['address'] .' '. $userPost['house'] .' '. $flat .', '. $userPost['city'] .', '. $userPost['region'] .', '. $phone : 'Адрес не указан'; //временно		
		
		$UA = explode(",", $UserAddress);
		$UserAddress1 = (isset($UA[0])) ? $UA[0] : '';
		$UserAddress2 = (isset($UA[1])) ? $UA[1] . ((isset($UA[2])) ? ', '. $UA[2] : '') : '';
		$UserAddress3 = $phone;
		$Form2Recipient1 = (isset($userPost['name'])) ? $userPost['name'] : 'ФИО не указано';
		
		//от кого отправка
		$Form2SenderIndex = $list11['sender_postOfficeIndex'];
		$Form2SenderName1 = $list11['name'];
		$Form2SenderName2 = '';
		$Form2SenderAddress1 = (explode(",", $list11['senderAddress'])[0]) ?: '';
		// $Form2SenderAddress2 = (explode(",", $list11['senderAddress'])[1]) ?: '';
		$Form2SenderAddress2 = (isset(explode(",", $list11['senderAddress'])[1])) ? explode(",", $list11['senderAddress'])[1] : '' ;
		$Form2SenderAddress3 = (isset(explode(",", $list11['senderAddress'])[2])) ? explode(",", $list11['senderAddress'])[2] : '' ;
		// $Form2SenderAddress3 = (explode(",", $list11['senderAddress'])[2]) ? explode(",", $list11['senderAddress'])[2] : '';
		
		//barcodes
		$list11['barcodes'] 					= [
			'I25' 								=> $list11['fk_code'],
			'C128' 								=> $userPost['russianpostTrack'],
			'C256' 								=> $userPost['russianpostTrack'].$userPost['russianpostTrack']
			//DATAMATRIX
		];
		$this->barcode_style 				= [
			'cellfitalign'  					=> '',
			'stretchtext'  					=> 1,
			'fontsize'  						=> 8,
			'fitwidth'  						=> true,
			'hpadding'  						=> 0,
			'vpadding'  						=> 0,
			'position'  						=> '',
			'stretch'  							=> false,
			'fgcolor'  							=> [0,0,0],
			'bgcolor'  							=> [255,255,255],
			'border'  							=> false,
			//'width'  							=> 0.5,
			'align'  							=> 'C',
			'text'  								=> true,
			'font'  								=> 'dejavusans'
		];
		$this->barcode_style2 				= [
			'cellfitalign'  					=> '',
			//'stretchtext'  					=> 4,
			'fontsize'  						=> 8,
			'fitwidth'  						=> true,
			'hpadding'  						=> 'auto',
			'vpadding'  						=> false,
			'position'  						=> '',
			'stretch'  							=> false,
			'fgcolor'  							=> [0,0,0],
			'bgcolor'  							=> [255,255,255],
			'border'  							=> false,
			'align'  							=> 'C',//'N',
			'text'  								=> false
			//'font'  								=> 'helvetica'
		];
		$this->barcode_style3 				= [
			'cellfitalign'  					=> '',
			'stretchtext'  					=> 1,
			'fontsize'  						=> 14,
			'fitwidth'  						=> false,
			'hpadding'  						=> 'auto',
			'vpadding'  						=> false,
			'position'  						=> '',
			'stretch'  							=> true,
			'fgcolor'  							=> [0,0,0],
			'bgcolor'  							=> [255,255,255],
			'border'  							=> false,
			'align'  							=> 'L',
			'text'  								=> true,
			'font'  								=> 'helvetica'
		];

		/*$this->barcode_style3 = array(
		    'position' => '',
		    'align' => 'L',
		    'stretch' => false,
		    'fitwidth' => true,
		    'cellfitalign' => '',
		    'border' => false,
		    'hpadding' => 'auto',
		    'vpadding' => 'auto',
		    'fgcolor' => array(0,0,0),
		    'bgcolor' => false, //array(255,255,255),
		    'text' => true,
		    'font' => 'helvetica',
		    'fontsize' => 8,
		    'stretchtext' => 4
		);*/
		
		//Почта России Форма 112 - левая часть бланка
		$this->fieldsForm1 = [
			'Form1BarcodeNumber1'			=> ($list11['barcodes']['I25']) ?: $barcode,														//Номер штрих-кода 1D
			'Form1BarcodeNumber2'			=> ($list11['barcodes']['C256']) ?: $userPost['russianpostTrack'].$userPost['russianpostTrack'],													//Номер штрих-кода 2D
			'Form1WithNotification'			=> (!empty($list11['receiver_phone'])) ? "X" : $checktest,															//С уведомлением
			'Form1CashOnDelivery'			=> "X",																																		//Наложенный платеж
			
			'Form1ClientInfo'					=> ($list11['fk_infozone']) ?: $messagetest,																						//зона информации для клиента
			'Form1Rub'							=> $Form1Rub,																																//Рубли
			'Form1Cent'							=> $Form1Cent,																																//Копейки
			'Form1SummInWords'				=> $SummInWords,																															//Сумма прописью
			
			'Form1SenderPhone'				=> $list11['receiver_phone'],																																	//Телефон отправителя
			'datamatrix_sender'				=> ($list11['datamatrix_sender']) ?: '',																						//Кому
			'Form1ToWhere1'					=> $list11['datamatrix_postIdnex'] .' '. $list11['receiver_to'],																						//Куда(1)
			'Form1ToWhere2'					=> '',																																		//Куда(2)
			'Form1Message1'					=> (isset($userPost['russianpostTrack'])) ? chunk_split($userPost['russianpostTrack'], 1, ' ') : '', 			//Сообщение(1) - идентификатор перевода
			'Form1Message2'					=> '',																																		//Сообщение(2)
			
			'Form1FromWhom'					=> $Form2Recipient1,																														//От кого - Имя клиента
			'Form1SenderAddress1'			=> $UserAddress1,																					//Адрес отправителя(1)
			'Form1SenderAddress2'			=> $UserAddress2,																					//Адрес отправителя(2)
			'Form1SenderIndex'				=> (isset($userPost['postIndex'])) ? $userPost['postIndex'] : $indextest,												//Индекс отправителя
			
			//вторая часть формы
			'Form1SenderRegAddress1'		=> $empty,																									//Адрес регистрации отправителя(1)
			'Form1SenderRegAddress2'		=> $empty,																									//Адрес регистрации отправителя(2)
			'Form1SenderRegIndex'			=> $empty,																									//Индекс регистрации отправитля
			'Form1SenderDoc'					=> $empty,																									//Тип документа отправителя
			'Form1SenderDocSerial'			=> $empty,																									//Серия документа
			'Form1SenderDocNumber'			=> $empty,																									//Номер документа
			'Form1SenderDocGiven'			=> $empty,																									//Дата выдачи документа
			'Form1SenderDocPlace1'			=> $empty,																									//Где выдан документ(1)
			'Form1SenderDocPlace2'			=> $empty,																									//Где выдан документ(2)
			'Form1SenderDocCode'				=> $empty,																									//Код подразделения
			'Form1SenderINN'					=> $empty,																									//ИНН отправителя
			'Form1SenderSitizenship'		=> $empty,																									//Гражданство отправителя
			'Form1SenderBirth'				=> $empty,																									//Дата рождения отправителя
			'Form1MigrationSerial'			=> $empty,																									//Серия миграционной карты
			'Form1MigrationNumber'			=> $empty,																									//Номер миграционной карты
			'Form1MigrationGiven'			=> $empty,																									//Дата выдачи миграционной карты
			'Form1MigrationFrom'				=> $empty,																									//Срок пребывания с
			'Form1MigrationTo'				=> $empty,																									//Срок пребывания по
			'Form1OfficialYes'				=> $checktest,																								//Являетесь ли вы должностным лицом(да)
			'Form1OfficialNo'					=> $checktest,																								//Являетесь ли вы должностным лицом(нет)
			'Form1Consent'						=> $checktest																								//Согласие на оповещения
		];

		//>>>>>>>>>>>>>>>>>>>> ONLINE
		
		$this->fieldsForm2_1 = [
			'barcode_RP'						=> ($list11['barcodes']['C128']) ?: '000000 00 00000 0',																		//штрих-код ШПИ
			'Form2Standart'					=> isset($userPost['Form2Standart']) ? "X" : $empty,																			//Стандартная посылка
			'Form2Simple'						=> isset($userPost['Form2Simple']) ? "X" : $empty,																				//Обыкновенная
			'Form2Insured'						=> $With_declared_value,																												//С объявленной ценностью
			'Form2CashOnDelivery'			=> $Cash_on_delivery,																													//С наложенным платежом
			'Form2Sender1'						=> $Form2SenderName1,																													//От кого(1)
			'Form2Sender2'						=> $Form2SenderName2,																													//От кого(2)
			'Form2SenderAddress1'			=> $Form2SenderAddress1,																												//Адрес отправителя(1)
			'Form2SenderAddress2'			=> $Form2SenderAddress2,																												//Адрес отправителя(2)
			'Form2SenderAddress3'			=> $Form2SenderAddress3,																												//Адрес отправителя(3)
			'Form2SenderPhone'				=> isset($userPost['Form2SenderPhone']) ? $userPost['Form2SenderPhone'] : $phonetest,								//Телефон отправителя
			'Form2SenderIndex'				=> $Form2SenderIndex,																													//Индекс отправителя
			'Form2CashReciever'				=> isset($userPost['Form2CashReciever']) ? $userPost['Form2CashReciever'] : $phonetest,							//Реквизиты получателя наложенного платежа
			'Form2CashRecieverName1'		=> isset($userPost['Form2CashRecieverName1']) ? $userPost['Form2CashRecieverName1'] : $messagetest,			//Наименование получателя(1)
			'Form2CashRecieverName2'		=> isset($userPost['Form2CashRecieverName2']) ? $userPost['Form2CashRecieverName2'] : $messagetest,			//Наименование получателя(2)
			'Form2IFP'							=> isset($userPost['Form2IFP']) ? $userPost['Form2IFP'] : $ifptest,														//ИФП\ИРП
			'Form2PayInCash'					=> (isset($companyPost['details_cash']) && !empty($companyPost['details_cash'])) ? "X" : '',						//Выплатить наличными
			'Form2INN'							=> isset($userPost['Form2INN']) ? $userPost['Form2INN'] : $inntest,														//ИНН
			'Form2CorrAccount'				=> isset($userPost['Form2CorrAccount']) ? $userPost['Form2CorrAccount'] : $cortest,									//Кор\счет
			'Form2BankName1'					=> isset($userPost['Form2BankName1']) ? $userPost['Form2BankName1'] : $messagetest,									//Наименование банка(1)
			'Form2BankName2'					=> isset($userPost['Form2BankName2']) ? $userPost['Form2BankName2'] : $messagetest,									//Наименование банка(2)
			'Form2CheckAccount'				=> isset($userPost['Form2CheckAccount']) ? $userPost['Form2CheckAccount'] : $cortest,								//Рас\счет
			'Form2BIK'							=> isset($userPost['Form2BIK']) ? $userPost['Form2BIK'] : $ifptest,														//БИК
			'Form2OGRN'							=> isset($userPost['Form2OGRN']) ? $userPost['Form2OGRN'] : $orgntest,													//ОГРН
			'Form2BankAddress1'				=> isset($userPost['Form2BankAddress1']) ? $userPost['Form2BankAddress1'] : $messagetest,							//Адрес банка(1)
			'Form2BankAddress2'				=> isset($userPost['Form2BankAddress2']) ? $userPost['Form2BankAddress2'] : $messagetest,							//Адрес банка(2)
			'Form2BankAddress3'				=> isset($userPost['Form2BankAddress3']) ? $userPost['Form2BankAddress3'] : $messagetest,							//Адрес банка(3)
			'Form2BankIndex'					=> isset($userPost['Form2BankIndex']) ? $userPost['Form2BankIndex'] : $indextest,									//Индекс банка
			
			//вторая часть
			'Form2SummInsured'				=> $SummPriceInWords,																													//Сумма объявленной ценности
			'Form2SummCashOnDelivery'		=> $SummPriceInWords,																													//Сумма наложенного платежа
			'Form2Recipient1'					=> $Form2Recipient1,																														//Кому(1)
			'Form2Recipient2'					=> '',																														//Кому(2)
			'Form2RecipientAddress1'		=> $UserAddress1,																															//Куда(1)
			'Form2RecipientAddress2'		=> $UserAddress2,																															//Куда(2)
			'Form2RecipientAddress3'		=> $UserAddress3,																															//Куда(3)
			'Form2RecipientIndex'			=> $postIndex,			 																													//Индекс получателя
			'Form2Weight'						=> ($list11['weight'] == 1) ? $weight.' г.' : '',																																	//Вес
			'Form2Price'						=> ($list11['weight'] == 1 && $list11['getTariff'] != '0') ? $userPost['tarif'].' р.' : '',																																		//Плата
			'Form2Comment'						=> isset($userPost['size']) ? $userPost['size'] : ''			 																//Комментарий внизу бланка
			
		];
		//echo $list11['getTariff'];
		//echo ($list11['getTariff'] != 0) ? $userPost[$list11['getTariff']] : 'sik'; 
		//exit();
		$cheackDate = self::cheackDate();
		//>>>>>>>>>>>>>>>>>>>>Обычная+наложка фк
		$this->fieldsForm2_2 = [
			'Form2Parcel'						=> "X",																					//Посылка
			'Form2Banderol'					=> $checktest,																			//Бандероль
			'Form2Insured'						=> $With_declared_value,															//С объявленной ценностью
			'Form2CashOnDelivery'			=> $Cash_on_delivery,																//С наложенным платежом
			'Form2WithInventory'				=> $checktest,																			//С описью
			'Form2SimpleNotification'		=> $checktest,																			//С простым уведомлением
			'Form2OrderedNotification'		=> $checktest,																			//С заказным уведомлением
			'Form2PostOffice'					=> isset($userPost['Form2PostOffice']) ? $userPost['Form2PostOffice'] : $indextest,				//Почтомат №
			'Form2SizeS'						=> $checktest,																			//Габариты S
			'Form2SizeM'						=> $checktest,																			//Габариты M
			'Form2SizeL'						=> $checktest,																			//Габариты L
			
			'Form2Sender'						=> $Form2SenderName1,																													//От кого
			'Form2SenderAddress1'			=> $Form2SenderAddress1,																												//Адрес отправителя(1)
			'Form2SenderAddress2'			=> $Form2SenderAddress2,																												//Адрес отправителя(2)
			'Form2SenderAddress3'			=> $Form2SenderAddress3,																												//Адрес отправителя(3)

			// 'OPS'									=> ($list11['f1575630203n'] == 1 && !empty($list11['ops'])) ? 'ПОЧТА РОССИИ' ."\n". $list11['ops'] ."\n". date('d.m.Y', strtotime('+'. (int)($list11['system_dateDelivery']-1) .' day')) ."\n". $list11['f1575630176n'] : '',	//"Новомосковский АО, поселение Марушинское\n07.11.2019\n109440"																											//Оттиск КПШ: ОПС места приема
			'OPS'									=> ($list11['f1575630203n'] == 1 && !empty($list11['ops'])) ? 'ПОЧТА РОССИИ' ."\n". $list11['ops'] ."\n". $cheackDate ."\n". $list11['f1575630176n'] : '',	//"Новомосковский АО, поселение Марушинское\n07.11.2019\n109440"																											//Оттиск КПШ: ОПС места приема

			'Form2SenderPhone'				=> isset($userPost['Form2SenderPhone']) ? $userPost['Form2SenderPhone'] : $phonetest,				//Телефон отправителя
			'Form2SenderIndex'				=> $Form2SenderIndex,																													//Индекс отправителя
			'Form2SenderNotification'		=> isset($userPost['Form2SenderNotification']) ? "X" : $checktest,							//Согласие на уведомление о вручении
			'Form2RecipientPhone'			=> substr($phone, -10),		//Телефон получателя
			'Form2RecipientIndex'			=> $postIndex,			 																//Индекс получателя
			'Form2RecipientNotification'	=> isset($userPost['Form2RecipientNotification']) ? "X" : $checktest,							//Согласие на уведомление о поступлении в отделение
			'Form2ReturnToAdress'			=> isset($userPost['Form2ReturnToAdress']) ? "X" : $checktest,								//Вернуть по обратному адресу
			'Form2GroundTransport'			=> isset($userPost['Form2GroundTransport']) ? "X" : $checktest,									//Направить наземным транспортом
			'Form2Heavy'						=> isset($userPost['Form2Heavy']) ? "X" : $checktest,											//Тяжеловесная
			'Form2Simple'						=> isset($userPost['Form2Simple']) ? "X" : $checktest,										//Простая
			'Form2Large'						=> isset($userPost['Form2Large']) ? "X" : $checktest,											//Крупногабаритная
			'Form2Registered'					=> isset($userPost['Form2Registered']) ? "X" : $checktest,									//Заказная
			'Form2Standart'					=> isset($userPost['Form2Standart']) ? "X" : $checktest,										//Стандартная
			'Form2NonStandart'				=> isset($userPost['Form2NonStandart']) ? "X" : $checktest,										//Нестандартная
			'Form2Regular'						=> isset($userPost['Form2Regular']) ? "X" : $checktest,											//Обыкновенная
			
			'Form2SummInsured'				=> $SummPriceInWords,																//Сумма объявленной ценности
			'Form2SummCashOnDelivery'		=> $SummPriceInWords, 																//Сумма наложенного платежа
			'Form2Recipient'					=> $Form2Recipient1,																	//Кому
			'Form2RecipientAddress1'		=> $UserAddress1,														//Куда(1)
			'Form2RecipientAddress2'		=> $UserAddress2,														//Куда(2)
			'Form2RecipientAddress3'		=> $UserAddress3,														//Куда(3)
			'Form2Weight'						=> ($list11['weight'] == 1) ? $weight.' г.' : '',																				//Вес
			'Form2Price'						=> ($list11['weight'] == 1 && $list11['getTariff'] != '0') ? $userPost['tarif'].' р.' : '',																					//Плата
			'Form2Comment'						=> isset($userPost['size']) ? $userPost['size'] : ''			 																//Комментарий внизу бланка
		];

		$this->fieldsForm2_3 = [
			'Form2Simple'						=> $Ordinary,																																						//Обыкновенная
			'Form2Registered'					=> $Ordered,																																						//Заказная
			'Form2WithNotification'			=> isset($userPost['Form2SimpleNotification']) ? "X" : $checktest,								//С простым уведомлением
			'Form2WithInventory'				=> isset($userPost['Form2WithInventory']) ? "X" : $checktest,									//С описью
			'Form2Insured'						=> '',																																		//С объявленной ценностью
			'Form2CashOnDelivery'			=> $Cash_on_delivery,																																			//С наложенным платежом
			'Form2Sender1'						=> isset($userPost['Form2Sender1']) ? $userPost['Form2Sender1'] : $longtest,						//От кого(1)
			'Form2Sender2'						=> isset($userPost['Form2Sender2']) ? $userPost['Form2Sender2'] : $longtest,						//От кого(2)
			'Form2SenderAddress1'			=> $Form2SenderAddress1,															//Адрес отправителя(1)
			'Form2SenderAddress2'			=> $Form2SenderAddress2,															//Адрес отправителя(2)
			'Form2SenderAddress3'			=> $Form2SenderAddress3,															//Адрес отправителя(3)
			'Form2SenderIndex'				=> isset($userPost['Form2SenderIndex']) ? $userPost['Form2SenderIndex'] : $indextest,				//Индекс отправителя
			//'Form2Index'					=> isset($userPost['Form2Index']) ? $userPost['Form2Index'] : 0,							//Индекс
			'Form2SummInsured'				=> $SummPriceInWords,																//Сумма объявленной ценности
			'Form2SummCashOnDelivery'		=> $SummPriceInWords,																//Сумма наложенного платежа
			'Form2IndexZip'					=> $userPost['postIndex'],						//Индекс zip
			'Form2Recipient1'					=> $Form2Recipient1,																	//Кому(1)
			'Form2Recipient2'					=> '',																	//Кому(2)
			'Form2RecipientAddress1'		=> $UserAddress1,														//Куда(1)
			'Form2RecipientAddress2'		=> $UserAddress2,														//Куда(2)
			'Form2RecipientAddress3'		=> $UserAddress3,														//Куда(3)
			'Form2Weight'						=> ($list11['weight'] == 1) ? $weight.' г.' : '',																					//Вес
			'Form2Price'						=> ($list11['weight'] == 1 && $list11['getTariff'] != '0') ? $userPost['tarif'].' р.' : '',																						//Плата
			'Form2RecipientIndex'			=> $postIndex,			 																//Индекс получателя
			'Form2Comment'						=> isset($userPost['size']) ? $userPost['size'] : ''			 																//Комментарий внизу бланка
		];
		
		//Cтатус, в который переместится заказ после экспорта в почту россии
		//JBase::statusChange($list, (int)$ids[0], $list11['status_exported']);
	}

    /**
     * Функция заполнения формы 112ЭФ
     *
     * @return mixed    pdf
     * @uses            tcpdf lib
     * @uses            fpdi lib
     * @throws          Exception
     */
	private function FillForm1() {
		
		/* FPDF - Левый бланк 112ЭФ
		
			//шрифты
				courier : Courier
				courierB : Courier Bold
				courierBI : Courier Bold Italic
				courierI : Courier Italic
				helvetica : Helvetica
				helveticaB : Helvetica Bold
				helveticaBI : Helvetica Bold Italic
				helveticaI : Helvetica Italic
				symbol : Symbol
				times : Times New Roman
				timesB : Times New Roman Bold
				timesBI : Times New Roman Bold Italic
				timesI : Times New Roman Italic
				zapfdingbats : Zapf Dingbats
	
			//html
				$html = '<span style="background-color:yellow;color:blue;">&nbsp;PAGE 1&nbsp;</span>';
				$this->writeHTML($html, true, false, true, false, '');
	
			//изображение
				$png = (new TCPDF2DDatamatrixBarcode($dataMatrixValue))->getBarcodePngData(40, 40);
				$this->Image('@' . $png, 130, 3, 40, 40, 'PNG', '', 'T', true, 300);
	
			//другой шрифт
				require_once('./vendor/tecnickcom/tcpdf/tcpdf.php');
				$this->zipcode = TCPDF_FONTS::addTTFfont('./fonts/ZIPcodeRegular.ttf');
				$this->AddFont($this->zipcode);
				use the font
				$fontname = TCPDF_FONTS::addTTFfont('./fonts/ZIPcodeRegular.ttf', 'TrueTypeUnicode', '', 96);
				$this->SetFont($fontname, '', 14, '', false);
	
			//EAN 8
				$pdf->Cell(0, 0, 'EAN 8', 0, 1);
				$pdf->write1DBarcode('1234567', 'EAN8', '', '', '', 18, 0.4, $style, 'N');//I25
		
		*/
		
		//'Form1BarcodeNumber1'
		$this->write1DBarcode($this->fieldsForm1['Form1BarcodeNumber1'], 'I25', 12, 57, 35, 16, 0.4, $this->barcode_style, 'N');

		//'Form1BarcodeNumber2'
		$this->write2DBarcode($this->fieldsForm1['Form1BarcodeNumber2'], 'DATAMATRIX', 109, 11, 27.5, 27.5, $this->barcode_style2, 'N');


		$this->SetFont('dejavusans', '', 8, '', true);
		//'Form1ClientInfo
		$this->MultiCell(35, 71, $this->fieldsForm1['Form1ClientInfo'], 0, 'C', 0, 0, 3, 73, true, 0, false, true, 71, 'M', true);

		//'Form1Rub'
		$this->SetXY(75,50.5);
		$this->Cell(11,0, $this->fieldsForm1['Form1Rub'], 0, 0, 'L', 0, '', 1);

		//'Form1Cent'
		$this->SetXY(89.5,50.5);
		$this->Cell(6,0, $this->fieldsForm1['Form1Cent'], 0, 0, 'L', 0, '', 1);

		//'Form1CashOnDelivery'
		$this->SetXY(103,50);
		$this->Rect(103,50, 4,4, 'DF', '', array(255, 255, 255)); //квадратик
		$this->Cell(4,4, $this->fieldsForm1['Form1CashOnDelivery'], 1, 0, 'L', 0, '', 1);

		//'Form1SummInWords'
		$this->SetFont('dejavusans', '', 7, '', true);
		$this->SetXY(44,55);
		$this->Cell(97,0, $this->fieldsForm1['Form1SummInWords'], 0, 0, 'C', 0, '', 1);

		$this->SetFont('dejavusans', '', 8, '', true);
		//'Form1WithNotification'
		$this->SetXY(44,60.3);
		$this->Rect(44.2,60.5, 3,4.6, 'DF', '', false); //квадратик
		$this->Cell(0,0, $this->fieldsForm1['Form1WithNotification'], 0, 0, 'L', 0, '', 1);

		//'Form1SenderPhone'
		$this->SetXY(111.45,60.4);
		$this->Cell(30, 0, $this->fieldsForm1['Form1SenderPhone'], 0, 0, 'C', 0, '', 4);

		//'datamatrix_sender'//Кому
		$this->SetXY(51,66);
		$this->Cell(91,0, $this->fieldsForm1['datamatrix_sender'], 0, 0, 'L', 0, '', 1);

		//'Form1ToWhere1'//Куда(1)
		$this->SetXY(51,71);
		$this->Cell(91,0, $this->fieldsForm1['Form1ToWhere1'], 0, 0, 'L', 0, '', 1);

		//'Form1ToWhere2'//Куда(2)
		$this->SetXY(44,75);
		$this->Cell(97,0, $this->fieldsForm1['Form1ToWhere2'], 0, 0, 'L', 0, '', 1);

		//'Form1Message1'Сообщение(1) - идентификатор перевода
		$this->SetFont('dejavusans', '', 8, '', true);
		$this->SetXY(44,82);
		$this->Cell(98,0, $this->fieldsForm1['Form1Message1'], 0, 0, 'L', 0, '', 0);

		$this->SetFont('dejavusans', '', 8, '', true);
		//'Form1Message2'Сообщение(2)
		$this->SetXY(43.5,88);
		$this->Cell(98,0, $this->fieldsForm1['Form1Message2'], 0, 0, 'С', 0, '', 4);

		//'Form1FromWhom'//От кого - Имя клиента
		$this->SetXY(54,92);
		$this->Cell(87,0, $this->fieldsForm1['Form1FromWhom'], 0, 0, 'L', 0, '', 1);

		//'Form1SenderAddress1'//Адрес отправителя(1)
		$this->SetXY(68,97);
		$this->Cell(73,0, $this->fieldsForm1['Form1SenderAddress1'], 0, 0, 'L', 0, '', 1);

		//'Form1SenderAddress2'//Адрес отправителя(2)
		$this->SetXY(44,101);
		$this->Cell(82,0, $this->fieldsForm1['Form1SenderAddress2'], 0, 0, 'L', 0, '', 1);

		$this->SetFont('dejavusans', '', 10, '', true);
		//'Form1SenderIndex'
		$this->SetXY(125,100);
		$this->Cell(17, 0, $this->fieldsForm1['Form1SenderIndex'], 0, 0, 'C', 0, '', 4);

		$this->SetFont('dejavusans', '', 8, '', true);
		//'Form1SenderRegAddress1'
		$this->SetXY(66,109);
		$this->Cell(75,0, $this->fieldsForm1['Form1SenderRegAddress1'], 0, 0, 'L', 0, '', 1);

		//'Form1SenderRegAddress2'
		$this->SetXY(44,114);
		$this->Cell(66,0, $this->fieldsForm1['Form1SenderRegAddress2'], 0, 0, 'L', 0, '', 1);

		//'Form1SenderRegIndex'
		$this->SetXY(125,114.2);
		$this->Cell(16.7, 0, $this->fieldsForm1['Form1SenderRegIndex'], 0, 0, 'C', 0, '', 4);

		//'Form1SenderDoc'
		$this->SetXY(57,119);
		$this->Cell(21.5,0, $this->fieldsForm1['Form1SenderDoc'], 0, 0, 'N', 0, '', 1);

		//'Form1SenderDocSerial'
		$this->SetXY(86,119);
		$this->Cell(10,0, $this->fieldsForm1['Form1SenderDocSerial'], 0, 0, 'L', 0, '', 1);

		//'Form1SenderDocNumber'
		$this->SetXY(99,119);
		$this->Cell(16.7,0, $this->fieldsForm1['Form1SenderDocNumber'], 0, 0, 'L', 0, '', 1);

		//'Form1SenderDocGiven'
		$this->SetXY(121,119);
		$this->Cell(20.7,0, $this->fieldsForm1['Form1SenderDocGiven'], 0, 0, 'L', 0, '', 1);

		//'Form1SenderDocPlace1'
		$this->SetXY(44,124);
		$this->Cell(97,0, $this->fieldsForm1['Form1SenderDocPlace1'], 0, 0, 'L', 0, '', 1);

		//'Form1SenderDocPlace2'
		$this->SetXY(44,129);
		$this->Cell(34,0, $this->fieldsForm1['Form1SenderDocPlace2'], 0, 0, 'L', 0, '', 1);

		//'Form1SenderDocCode'
		$this->SetXY(78,129);
		$this->Cell(26,0, $this->fieldsForm1['Form1SenderDocCode'], 0, 0, 'L', 0, '', 1);

		$this->SetFont('dejavusans', '', 8, '', true);
		//'Form1SenderINN'
		$this->SetXY(114.1,129.3);
		$this->Cell(27.7, 0, $this->fieldsForm1['Form1SenderINN'], 0, 0, 'C', 0, '', 4);
		$this->SetFont('dejavusans', '', 11, '', true);

		//'Form1SenderSitizenship'
		$this->SetXY(60,134);
		$this->Cell(42,0, $this->fieldsForm1['Form1SenderSitizenship'], 0, 0, 'L', 0, '', 1);

		//'Form1SenderBirth'
		$this->SetXY(119,134);
		$this->Cell(23,0, $this->fieldsForm1['Form1SenderBirth'], 0, 0, 'L', 0, '', 1);

		//'Form1MigrationSerial'
		$this->SetXY(78,140);
		$this->Cell(10.5,0, $this->fieldsForm1['Form1MigrationSerial'], 0, 0, 'L', 0, '', 1);

		//'Form1MigrationNumber'
		$this->SetXY(91,140);
		$this->Cell(16,0, $this->fieldsForm1['Form1MigrationNumber'], 0, 0, 'L', 0, '', 1);

		//'Form1MigrationGiven'
		$this->SetXY(114,140);
		$this->Cell(20.5,0, $this->fieldsForm1['Form1MigrationGiven'], 0, 0, 'L', 0, '', 1);

		//'Form1MigrationFrom'
		$this->SetXY(67,144);
		$this->Cell(20.5,0, $this->fieldsForm1['Form1MigrationFrom'], 0, 0, 'L', 0, '', 1);

		//'Form1MigrationTo'
		$this->SetXY(91,144);
		$this->Cell(20.5,0, $this->fieldsForm1['Form1MigrationTo'], 0, 0, 'L', 0, '', 1);

		//'Form1OfficialYes'
		$this->SetXY(119.5,149);
		$this->Cell(0,0, $this->fieldsForm1['Form1OfficialYes'], 0, 0, 'L', 0, '', 1);

		//'Form1OfficialNo'
		$this->SetXY(129.5,149);
		$this->Cell(0,0, $this->fieldsForm1['Form1OfficialNo'], 0, 0, 'L', 0, '', 1);

		//'Form1Consent'
		$this->SetXY(3,159);
		$this->Cell(0,0, $this->fieldsForm1['Form1Consent'], 0, 0, 'L', 0, '', 1);
	}
	
    /**
     * Функция заполнения формы 112ЭФ
     *
     * @return mixed    pdf
     * @uses            tcpdf lib
     * @uses            fpdi lib
     * @throws          Exception
     */
	private function FillForm1_1() {
		
		//'Form1BarcodeNumber1'
		$this->write1DBarcode($this->fieldsForm1['Form1BarcodeNumber1'], 'I25', 13, 60.5, 35, 16, 0.4, $this->barcode_style, 'N');

		//'Form1BarcodeNumber2'
		$this->write2DBarcode($this->fieldsForm1['Form1BarcodeNumber2'], 'DATAMATRIX', 110, 14.5, 27.5, 27.5, $this->barcode_style2, 'N');


		$this->SetFont('dejavusans', '', 8, '', true);
		//'Form1ClientInfo
		$this->MultiCell(35, 71, $this->fieldsForm1['Form1ClientInfo'], 0, 'C', 0, 0, 3, 73, true, 0, false, true, 71, 'M', true);

		//'Form1Rub'
		//$this->SetXY(75,50.5);
		$this->SetXY(76,54);
		$this->Cell(11,0, $this->fieldsForm1['Form1Rub'], 0, 0, 'L', 0, '', 1);

		//'Form1Cent'
		$this->SetXY(90.5,54);
		$this->Cell(6,0, $this->fieldsForm1['Form1Cent'], 0, 0, 'L', 0, '', 1);

		//'Form1CashOnDelivery'
		$this->SetXY(104,53.5);
		$this->Rect(104,53.5, 4,4, 'DF', '', array(255, 255, 255)); //квадратик
		$this->Cell(4,4, $this->fieldsForm1['Form1CashOnDelivery'], 1, 0, 'L', 0, '', 1);

		//'Form1SummInWords'
		$this->SetFont('dejavusans', '', 7, '', true);
		$this->SetXY(45,58.5);
		$this->Cell(97,0, $this->fieldsForm1['Form1SummInWords'], 0, 0, 'C', 0, '', 1);

		$this->SetFont('dejavusans', '', 8, '', true);
		//'Form1WithNotification'
		$this->SetXY(45,63.8);
		$this->Rect(45.2,63.7, 3,4.6, 'DF', '', false); //квадратик
		$this->Cell(0,0, $this->fieldsForm1['Form1WithNotification'], 0, 0, 'L', 0, '', 1);

		//'Form1SenderPhone'
		$this->SetXY(112.45,63.9);
		$this->Cell(30, 0, $this->fieldsForm1['Form1SenderPhone'], 0, 0, 'C', 0, '', 4);

		//'datamatrix_sender'//Кому
		$this->SetXY(52,69);
		$this->Cell(91,0, $this->fieldsForm1['datamatrix_sender'], 0, 0, 'L', 0, '', 1);

		//'Form1ToWhere1'//Куда(1)
		$this->SetXY(52,74);
		$this->Cell(91,0, $this->fieldsForm1['Form1ToWhere1'], 0, 0, 'L', 0, '', 1);

		//'Form1ToWhere2'//Куда(2)
		$this->SetXY(45,78.5);
		$this->Cell(97,0, $this->fieldsForm1['Form1ToWhere2'], 0, 0, 'L', 0, '', 1);

		//'Form1Message1'Сообщение(1) - идентификатор перевода
		$this->SetFont('dejavusans', '', 8, '', true);
		$this->SetXY(45,85.5);
		$this->Cell(98,0, $this->fieldsForm1['Form1Message1'], 0, 0, 'L', 0, '', 0);

		$this->SetFont('dejavusans', '', 8, '', true);
		//'Form1Message2'Сообщение(2)
		$this->SetXY(44.5,91.5);
		$this->Cell(98,0, $this->fieldsForm1['Form1Message2'], 0, 0, 'С', 0, '', 4);

		//'Form1FromWhom'//От кого - Имя клиента
		$this->SetXY(55,95.5);
		$this->Cell(87,0, $this->fieldsForm1['Form1FromWhom'], 0, 0, 'L', 0, '', 1);

		//'Form1SenderAddress1'//Адрес отправителя(1)
		$this->SetXY(69,100.2);
		$this->Cell(73,0, $this->fieldsForm1['Form1SenderAddress1'], 0, 0, 'L', 0, '', 1);

		//'Form1SenderAddress2'//Адрес отправителя(2)
		$this->SetXY(45,104.4);
		$this->Cell(82,0, $this->fieldsForm1['Form1SenderAddress2'], 0, 0, 'L', 0, '', 1);

		$this->SetFont('dejavusans', '', 10, '', true);
		//'Form1SenderIndex'
		$this->SetXY(126,103.5);
		$this->Cell(17, 0, $this->fieldsForm1['Form1SenderIndex'], 0, 0, 'N', 0, '', 4);

		$this->SetFont('dejavusans', '', 8, '', true);
		//'Form1SenderRegAddress1'
		$this->SetXY(67,112.5);
		$this->Cell(75,0, $this->fieldsForm1['Form1SenderRegAddress1'], 0, 0, 'L', 0, '', 1);

		//'Form1SenderRegAddress2'
		$this->SetXY(45,117.5);
		$this->Cell(66,0, $this->fieldsForm1['Form1SenderRegAddress2'], 0, 0, 'L', 0, '', 1);

		//'Form1SenderRegIndex'
		$this->SetXY(126,117.7);
		$this->Cell(16.7, 0, $this->fieldsForm1['Form1SenderRegIndex'], 0, 0, 'C', 0, '', 4);

		//'Form1SenderDoc'
		$this->SetXY(58,122.5);
		$this->Cell(21.5,0, $this->fieldsForm1['Form1SenderDoc'], 0, 0, 'N', 0, '', 1);

		//'Form1SenderDocSerial'
		$this->SetXY(87,122.5);
		$this->Cell(10,0, $this->fieldsForm1['Form1SenderDocSerial'], 0, 0, 'L', 0, '', 1);

		//'Form1SenderDocNumber'
		$this->SetXY(100,122.5);
		$this->Cell(16.7,0, $this->fieldsForm1['Form1SenderDocNumber'], 0, 0, 'L', 0, '', 1);

		//'Form1SenderDocGiven'
		$this->SetXY(122,122.5);
		$this->Cell(20.7,0, $this->fieldsForm1['Form1SenderDocGiven'], 0, 0, 'L', 0, '', 1);

		//'Form1SenderDocPlace1'
		$this->SetXY(45,127.5);
		$this->Cell(97,0, $this->fieldsForm1['Form1SenderDocPlace1'], 0, 0, 'L', 0, '', 1);

		//'Form1SenderDocPlace2'
		$this->SetXY(45,132.5);
		$this->Cell(34,0, $this->fieldsForm1['Form1SenderDocPlace2'], 0, 0, 'L', 0, '', 1);

		//'Form1SenderDocCode'
		$this->SetXY(79,132.5);
		$this->Cell(26,0, $this->fieldsForm1['Form1SenderDocCode'], 0, 0, 'L', 0, '', 1);

		$this->SetFont('dejavusans', '', 8, '', true);
		//'Form1SenderINN'
		$this->SetXY(115.1,132.8);
		$this->Cell(27.7, 0, $this->fieldsForm1['Form1SenderINN'], 0, 0, 'C', 0, '', 4);
		$this->SetFont('dejavusans', '', 11, '', true);

		//'Form1SenderSitizenship'
		$this->SetXY(61,137.5);
		$this->Cell(42,0, $this->fieldsForm1['Form1SenderSitizenship'], 0, 0, 'L', 0, '', 1);

		//'Form1SenderBirth'
		$this->SetXY(120,137.5);
		$this->Cell(23,0, $this->fieldsForm1['Form1SenderBirth'], 0, 0, 'L', 0, '', 1);

		//'Form1MigrationSerial'
		$this->SetXY(79,143.5);
		$this->Cell(10.5,0, $this->fieldsForm1['Form1MigrationSerial'], 0, 0, 'L', 0, '', 1);

		//'Form1MigrationNumber'
		$this->SetXY(92,143.5);
		$this->Cell(16,0, $this->fieldsForm1['Form1MigrationNumber'], 0, 0, 'L', 0, '', 1);

		//'Form1MigrationGiven'
		$this->SetXY(115,143.5);
		$this->Cell(20.5,0, $this->fieldsForm1['Form1MigrationGiven'], 0, 0, 'L', 0, '', 1);

		//'Form1MigrationFrom'
		$this->SetXY(68,147.5);
		$this->Cell(20.5,0, $this->fieldsForm1['Form1MigrationFrom'], 0, 0, 'L', 0, '', 1);

		//'Form1MigrationTo'
		$this->SetXY(92,147.5);
		$this->Cell(20.5,0, $this->fieldsForm1['Form1MigrationTo'], 0, 0, 'L', 0, '', 1);

		//'Form1OfficialYes'
		$this->SetXY(120.5,152.5);
		$this->Cell(0,0, $this->fieldsForm1['Form1OfficialYes'], 0, 0, 'L', 0, '', 1);

		//'Form1OfficialNo'
		$this->SetXY(130.5,152.5);
		$this->Cell(0,0, $this->fieldsForm1['Form1OfficialNo'], 0, 0, 'L', 0, '', 1);

		//'Form1Consent'
		$this->SetXY(4,162.5);
		$this->Cell(0,0, $this->fieldsForm1['Form1Consent'], 0, 0, 'L', 0, '', 1);
		
		//комментарий на склад
		$this->SetFont('dejavusans', '', 8, '', true);
		$this->SetXY(10, 185);
		$this->Cell(120, 0, $this->fieldsForm2_2['Form2Comment'], 0, 0, 'N', 0, '', 1);
	}
	
    /**
     * Функция заполнения формы Посылка Онлайн
     *
     * @return mixed    pdf
     * @uses            tcpdf lib
     * @uses            fpdi lib
     * @throws          Exception
     */
	private function FillForm2_1() {
		$this->SetFont('dejavusans', '', 6, '', true);
	
		$this->SetXY(155, 18);
		$this->Cell(0, 0, 'ПОЧТА РОССИИ', 0, 0, 'N', 0, '', 1);
		$this->write1DBarcode($this->fieldsForm2_1['barcode_RP'], 'C128',  153, 20.5, 52, 16, 0.4, $this->barcode_style3, 'N');
		
		$this->SetFont('dejavusans', '', 11, '', true);
		//'Form2Standard'
		$this->SetXY(208.4, 24.8);
		$this->Cell(0,0, $this->fieldsForm2_1['Form2Standart'], 0, 0, 'N', 0, '', 1);

		//'Form2Simple'
		$this->SetXY(228.7, 24.7);
		$this->Cell(0,0, $this->fieldsForm2_1['Form2Simple'], 0, 0, 'N', 0, '', 1);

		//'Form2Insured'
		$this->SetXY(228.7, 28.5);
		$this->Cell(0,0, $this->fieldsForm2_1['Form2Insured'], 0, 0, 'N', 0, '', 1);

		//'Form2CashOnDelivery'
		$this->SetXY(228.7, 34);
		$this->Cell(0,0, $this->fieldsForm2_1['Form2CashOnDelivery'], 0, 0, 'N', 0, '', 1);

		$this->SetFont('dejavusans', '', 8, '', true);
		//'Form2Sender1'
		$this->SetXY(165, 34);
		$this->Cell(49,0, $this->fieldsForm2_1['Form2Sender1'], 0, 0, 'N', 0, '', 1);

		//'Form2Sender2'
		$this->SetXY(153, 38.5);
		$this->Cell(60,0, $this->fieldsForm2_1['Form2Sender2'], 0, 0, 'N', 0, '', 1);

		//'Form2SenderAddress1'
		$this->SetXY(165.5, 45.8);
		$this->Cell(47,0, $this->fieldsForm2_1['Form2SenderAddress1'], 0, 0, 'N', 0, '', 1);

		//'Form2SenderAddress2'
		$this->SetXY(153, 50.3);
		$this->Cell(60,0, $this->fieldsForm2_1['Form2SenderAddress2'], 0, 0, 'N', 0, '', 1);

		//'Form2SenderAddress3'
		$this->SetXY(153, 56);
		$this->Cell(60,0, $this->fieldsForm2_1['Form2SenderAddress3'], 0, 0, 'N', 0, '', 1);

		$this->SetFont('dejavusans', '', 11, '', true);
		//'Form2SenderIndex'
		$this->SetXY(183.5, 61.5);
		$this->Cell(30,0, $this->fieldsForm2_1['Form2SenderIndex'], 0, 0, 'C', 0, '', 4);

		$this->SetFont('dejavusans', '', 8, '', true);
		//'Form2SummInsured'
		$this->SetXY(215, 48);
		$this->Cell(77,0, $this->fieldsForm2_1['Form2SummInsured'], 0, 0, 'C', 0, '', 1);

		//'Form2SummCashOnDelivery'
		$this->SetXY(215, 54);
		$this->Cell(77,0, $this->fieldsForm2_1['Form2SummCashOnDelivery'], 0, 0, 'N', 0, '', 1);

		//'Form2Recipient1'
		$this->SetXY(228, 61);
		$this->Cell(64,0, $this->fieldsForm2_1['Form2Recipient1'], 0, 0, 'N', 0, '', 1);

		//'Form2Recipient2'
		$this->SetXY(220, 67);
		$this->Cell(72,0, $this->fieldsForm2_1['Form2Recipient2'], 0, 0, 'N', 0, '', 1);

		//'Form2RecipientAddress1'
		$this->SetXY(228, 74);
		$this->Cell(64,0, $this->fieldsForm2_1['Form2RecipientAddress1'], 0, 0, 'N', 0, '', 1);

		//'Form2RecipientAddress2'
		$this->SetXY(220, 79);
		$this->Cell(72,0, $this->fieldsForm2_1['Form2RecipientAddress2'], 0, 0, 'N', 0, '', 1);

		//'Form2RecipientAddress3'
		$this->SetXY(220, 85);
		$this->Cell(42,0, $this->fieldsForm2_1['Form2RecipientAddress3'], 0, 0, 'N', 0, '', 1);

		$this->SetFont('dejavusans', '', 11, '', true);
		//'Form2RecipientIndex'
		$this->SetXY(262, 84);
		$this->Cell(30,0, $this->fieldsForm2_1['Form2RecipientIndex'], 0, 0, 'C', 0, '', 4);

		$this->SetFont('dejavusans', '', 8, '', true);
		//'Form2Weight'
		$this->SetXY(223, 112);
		$this->Cell(10,0, $this->fieldsForm2_1['Form2Weight'], 0, 0, 'C', 0, '', 1);

		//'Form2Price'
		$this->SetXY(244, 112);
		$this->Cell(11,0, $this->fieldsForm2_1['Form2Price'], 0, 0, 'N', 0, '', 1);

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
		
		//комментарий на склад
		$this->SetXY(155, 155);
		$this->Cell(0, 0, $this->fieldsForm2_1['Form2Comment'], 0, 0, 'N', 0, '', 1);
		
	}
	
    /**
     * Функция заполнения формы  Посылка нестандартная
     *
     * @return mixed    pdf
     * @uses            tcpdf lib
     * @uses            fpdi lib
     * @throws          Exception
     */
	private function FillForm2_2() {
		$this->SetFont('dejavusans', '', 6, '', true);
	
		$this->SetXY(152, 15.5);
		$this->Cell(0, 0, 'ПОЧТА РОССИИ', 0, 0, 'N', 0, '', 0);
		$this->write1DBarcode($this->fieldsForm2_1['barcode_RP'], 'C128',  150, 18, 52, 14, 0.4, $this->barcode_style3, 'N');
		
		$this->SetFont('dejavusans', '', 11, '', true);
		//'Form2Parcel'
		$this->SetXY(204.5, 18);
		$this->Cell(0,0, $this->fieldsForm2_2['Form2Parcel'], 0, 0, 'N', 0, '', 1);

		//'Form2Banderol'
		$this->SetXY(204, 23.2);
		$this->Cell(0,0, $this->fieldsForm2_2['Form2Banderol'], 0, 0, 'N', 0, '', 1);

		$this->SetFont('dejavusans', '', 8, '', true);
		//'Form2Insured'
		$this->SetXY(239, 17.5);
		$this->Cell(0,0, $this->fieldsForm2_2['Form2Insured'], 0, 0, 'N', 0, '', 1);

		//'Form2CashOnDelivery'
		$this->SetXY(239, 20);
		$this->Cell(0,0, $this->fieldsForm2_2['Form2CashOnDelivery'], 0, 0, 'N', 0, '', 1);

		//'Form2WithInventory'
		$this->SetXY(238.4, 23);
		$this->Cell(0,0, $this->fieldsForm2_2['Form2WithInventory'], 0, 0, 'N', 0, '', 1);

		//'Form2SimpleNotification'
		$this->SetXY(238.4, 26);
		$this->Cell(0,0, $this->fieldsForm2_2['Form2SimpleNotification'], 0, 0, 'N', 0, '', 1);

		//'Form2OrderedNotification'
		$this->SetXY(238.4, 28.2);
		$this->Cell(0,0, $this->fieldsForm2_2['Form2OrderedNotification'], 0, 0, 'N', 0, '', 1);

		$this->SetFont('dejavusans', '', 8, '', true);
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
		$this->SetXY(157, 49);
		$this->Cell(64,0, $this->fieldsForm2_2['Form2Sender'], 0, 0, 'N', 0, '', 1);

		//'Form2SenderAddress1'
		$this->SetXY(152, 62.8);
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
		$this->SetXY(199, 77.7);
		$this->Cell(23,0, $this->fieldsForm2_2['Form2SenderIndex'], 0, 0, 'C', 0, '', 4);

		//'Form2SummInsured'
		$this->SetXY(223, 45.6);
		$this->Cell(69,0, $this->fieldsForm2_2['Form2SummInsured'], 0, 0, 'N', 0, '', 1);

		//'Form2SummCashOnDelivery'
		$this->SetXY(223, 55.2);
		$this->Cell(69,0, $this->fieldsForm2_2['Form2SummCashOnDelivery'], 0, 0, 'N', 0, '', 1);

		//'Form2Recipient'
		$this->SetXY(228, 71.3);
		$this->Cell(64,0, $this->fieldsForm2_2['Form2Recipient'], 0, 0, 'N', 0, '', 1);

		//'Form2RecipientAddress1'
		$this->SetXY(223, 84);
		$this->Cell(69,0, $this->fieldsForm2_2['Form2RecipientAddress1'], 0, 0, 'N', 0, '', 1);

		//'Form2RecipientAddress2'
		$this->SetXY(223, 88.2);
		$this->Cell(69,0, $this->fieldsForm2_2['Form2RecipientAddress2'], 0, 0, 'N', 0, '', 1);

		//'Form2RecipientAddress3'
		$this->SetXY(223, 92.5);
		$this->Cell(69,0, $this->fieldsForm2_2['Form2RecipientAddress3'], 0, 0, 'N', 0, '', 1);

		//'Form2RecipientPhone'
		$this->SetXY(227.7, 100);
		$this->Cell(38,0, $this->fieldsForm2_2['Form2RecipientPhone'], 0, 0, 'C', 0, '', 4);

		//'Form2RecipientIndex'
		$this->SetXY(269.7, 100);
		$this->Cell(23,0, $this->fieldsForm2_2['Form2RecipientIndex'], 0, 0, 'C', 0, '', 4);

		//'Form2Weight'
		$this->SetXY(231, 108.3);
		$this->Cell(13,0, $this->fieldsForm2_1['Form2Weight'], 0, 0, 'C', 0, '', 1);

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
		//комментарий на склад
		$this->SetXY(155, 155);
		$this->Cell(0, 0, $this->fieldsForm2_1['Form2Comment'], 0, 0, 'N', 0, '', 1);
	}
		
    /**
     * Функция заполнения формы Обычная+наложка фк
     *
     * @return mixed    pdf
     * @uses            tcpdf lib
     * @uses            fpdi lib
     * @throws          Exception
     */
	private function FillForm2_3() {
	
		$this->SetFont('dejavusans', '', 6, '', true);
	
		$this->SetXY(155, 9);
		$this->Cell(0, 0, 'ПОЧТА РОССИИ', 0, 0, 'N', 0, '', 1);
		$this->barcode_style3['label'] = substr($this->fieldsForm2_1['barcode_RP'], 0, 6).'  '.substr($this->fieldsForm2_1['barcode_RP'], 6, 2).'  '.substr($this->fieldsForm2_1['barcode_RP'], 8, 5). '  '.substr($this->fieldsForm2_1['barcode_RP'], -1);
		$this->write1DBarcode($this->fieldsForm2_1['barcode_RP'], 'I25',  154, 11.5, 78, 20, 0.54, $this->barcode_style3, 'N');
		
		$this->SetFont('dejavusans', '', 11, '', true);

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
		$this->SetXY(229, 18.5);
		$this->Cell(0,0, $this->fieldsForm2_3['Form2CashOnDelivery'], 0, 0, 'N', 0, '', 1);

		$this->SetFont('dejavusans', '', 8, '', true);
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
		$this->SetFont('dejavusans', '', 11, '', true);

		//'Form2SenderIndex'
		$this->SetXY(183.5, 61.5);
		$this->Cell(29,0, $this->fieldsForm2_3['Form2SenderIndex'], 0, 0, 'C', 0, '', 4);
		$this->SetFont('dejavusans', '', 8, '', true);

		//'Form2SummInsured'
		$this->SetXY(215, 38);
		$this->Cell(77,0, $this->fieldsForm2_3['Form2SummInsured'], 0, 0, 'N', 0, '', 1);

		//'Form2SummCashOnDelivery'
		$this->SetXY(215, 47);
		$this->Cell(77,0, $this->fieldsForm2_3['Form2SummCashOnDelivery'], 0, 0, 'N', 0, '', 1);

		//'Form2Recipient1'
		$this->SetXY(228, 58);
		$this->Cell(64,0, $this->fieldsForm2_3['Form2Recipient1'], 0, 0, 'N', 0, '', 1);

		//'Form2Recipient2'
		$this->SetXY(220, 63);
		$this->Cell(72,0, $this->fieldsForm2_3['Form2Recipient2'], 0, 0, 'N', 0, '', 1);

		//'Form2RecipientAddress1'
		$this->SetXY(228, 71);
		$this->Cell(64,0, $this->fieldsForm2_3['Form2RecipientAddress1'], 0, 0, 'N', 0, '', 1);

		//'Form2RecipientAddress2'
		$this->SetXY(220, 76);
		$this->Cell(72,0, $this->fieldsForm2_3['Form2RecipientAddress2'], 0, 0, 'N', 0, '', 1);

		//'Form2RecipientAddress3'
		$this->SetXY(220, 81.5);
		$this->Cell(42,0, $this->fieldsForm2_3['Form2RecipientAddress3'], 0, 0, 'N', 0, '', 1);
		$this->SetFont('dejavusans', '', 11, '', true);

		//'Form2RecipientIndex'
		$this->SetXY(262, 81.5);
		$this->Cell(29,0, $this->fieldsForm2_3['Form2RecipientIndex'], 0, 0, 'C', 0, '', 4);

		//'Form2Weight'
		$this->SetXY(161, 69);
		$this->Cell(25,0, $this->fieldsForm2_3['Form2Weight'], 0, 0, 'C', 0, '', 1);

		//'Form2Price'
		$this->SetXY(161, 73.8);
		$this->Cell(25,0, $this->fieldsForm2_3['Form2Price'], 0, 0, 'N', 0, '', 1);

		$this->SetFont('zipcode', '', 45, '', true);
		//'Form1ClientInfo
		$this->SetXY(162.7, 87.7);
		$this->Cell(54,0, (string)$this->fieldsForm2_3['Form2IndexZip'], 0, 0, 'N', 0, '', 4);
		
		//комментарий на склад
		$this->SetXY(155, 155);
		$this->Cell(0, 0, $this->fieldsForm2_1['Form2Comment'], 0, 0, 'N', 0, '', 1);
	}
		
    /**
     * Функция заполнения формы Обычная+наложка фк
     *
     * @return mixed    pdf
     * @uses            tcpdf lib
     * @uses            fpdi lib
     * @throws          Exception
     */
	private function FillForm2_4() {
	
		$this->SetFont('dejavusans', '', 7, '', true);
		
		$this->Rotate(90, 240, 95);
		$this->SetXY(131, 10);
		$this->Cell(28, 0, 'ПОЧТА РОССИИ', 0, 0, 'R', 0, '', 1);
		$this->barcode_style3['label'] = substr($this->fieldsForm2_1['barcode_RP'], 0, 6).'  '.substr($this->fieldsForm2_1['barcode_RP'], 6, 2).'  '.substr($this->fieldsForm2_1['barcode_RP'], 8, 5). '  '.substr($this->fieldsForm2_1['barcode_RP'], -1);
		$this->write1DBarcode($this->fieldsForm2_1['barcode_RP'], 'I25',  132, 13, 78, 20, 0.54, $this->barcode_style3, 'L');

		//$this->write1DBarcode("800876 44 08385 5", 'I25',  134, 13, 52, 20, 0.4, $this->barcode_style3, 'C');
		
		$this->SetFont('dejavusans', '', 8, '', true);
		$this->SetXY(296, 14);
		//$this->MultiCell(28, 0, "Новомосковский АО, поселение Марушинское\n07.11.2019\n109440", 1, 'R');
		$this->MultiCell(28, 0, $this->fieldsForm2_2['OPS'], 1, 'R');
		
		$this->SetFont('dejavusans', '', 11, '', true);
		//'Form2Standard'
		$this->SetXY(208.4, 24.8);
		$this->Cell(0,0, $this->fieldsForm2_1['Form2Standart'], 0, 0, 'N', 0, '', 1);

		//'Form2Simple'
		$this->SetXY(237.5, 24.7);
		$this->Cell(0,0, $this->fieldsForm2_1['Form2Simple'], 0, 0, 'N', 0, '', 1);

		//'Form2Insured'
		$this->SetXY(237.5, 26.5);
		$this->Cell(0,0, $this->fieldsForm2_1['Form2Insured'], 0, 0, 'N', 0, '', 1);

		//'Form2CashOnDelivery'
		$this->SetXY(237.5, 33.5);
		$this->Cell(0,0, $this->fieldsForm2_1['Form2CashOnDelivery'], 0, 0, 'N', 0, '', 1);

		$this->SetFont('dejavusans', '', 10, '', true);
		//'Form2Sender1'
		$this->SetXY(155, 32.5);
		$this->Cell(60,0, $this->fieldsForm2_1['Form2Sender1'], 0, 0, 'N', 0, '', 1);

		//'Form2Sender2'
		$this->SetXY(135, 40);
		$this->Cell(80,0, $this->fieldsForm2_1['Form2Sender2'], 0, 0, 'N', 0, '', 1);

		//'Form2SenderAddress1'
		$this->SetXY(155, 49);
		$this->Cell(60,0, $this->fieldsForm2_1['Form2SenderAddress1'], 0, 0, 'N', 0, '', 1);

		//'Form2SenderAddress2'
		$this->SetXY(135, 56.5);
		$this->Cell(80,0, $this->fieldsForm2_1['Form2SenderAddress2'], 0, 0, 'N', 0, '', 1);

		//'Form2SenderAddress3'
		$this->SetXY(135, 64.5);
		$this->Cell(80,0, $this->fieldsForm2_1['Form2SenderAddress3'], 0, 0, 'N', 0, '', 1);

		$this->SetFont('dejavusans', '', 13, '', true);
		//'Form2SenderIndex'
		$this->SetXY(177, 71);
		$this->Cell(38,0, $this->fieldsForm2_1['Form2SenderIndex'], 0, 0, 'C', 0, '', 4);

		$this->SetFont('dejavusans', '', 10, '', true);
		//'Form2SummInsured'
		$this->SetXY(220, 51);
		$this->Cell(103,0, $this->fieldsForm2_1['Form2SummInsured'], 0, 0, 'C', 0, '', 1);

		//'Form2SummCashOnDelivery'
		$this->SetXY(220, 60);
		$this->Cell(103,0, $this->fieldsForm2_1['Form2SummCashOnDelivery'], 0, 0, 'N', 0, '', 1);

		//'Form2Recipient1'
		$this->SetXY(237, 69);
		$this->Cell(82,0, $this->fieldsForm2_1['Form2Recipient1'], 0, 0, 'N', 0, '', 1);

		//'Form2Recipient2'
		$this->SetXY(225, 77);
		$this->Cell(98,0, $this->fieldsForm2_1['Form2Recipient2'], 0, 0, 'N', 0, '', 1);

		//'Form2RecipientAddress1'
		$this->SetXY(237, 87);
		$this->Cell(82,0, $this->fieldsForm2_1['Form2RecipientAddress1'], 0, 0, 'N', 0, '', 1);

		//'Form2RecipientAddress2'
		$this->SetXY(225, 94);
		$this->Cell(97,0, $this->fieldsForm2_1['Form2RecipientAddress2'], 0, 0, 'N', 0, '', 1);

		//'Form2RecipientAddress3'
		$this->SetXY(225, 102);
		$this->Cell(57,0, $this->fieldsForm2_1['Form2RecipientAddress3'], 0, 0, 'N', 0, '', 1);

		$this->SetFont('dejavusans', '', 13, '', true);
		//'Form2RecipientIndex'
		$this->SetXY(283, 102);
		$this->Cell(40,0, $this->fieldsForm2_1['Form2RecipientIndex'], 0, 0, 'N', 0, '', 4);

		$this->SetFont('dejavusans', '', 10, '', true);
		//'Form2Weight'
		$this->SetXY(222, 139);
		$this->Cell(28,0, $this->fieldsForm2_1['Form2Weight'], 0, 0, 'C', 0, '', 1);

		//'Form2Price'
		$this->SetXY(250, 139);
		$this->Cell(29,0, $this->fieldsForm2_1['Form2Price'], 0, 0, 'C', 0, '', 1);

		//'Form2SenderPhone'
		$this->SetXY(184, 67);
		$this->Cell(36,0, $this->fieldsForm2_1['Form2SenderPhone'], 0, 0, 'N', 0, '', 1);

		//'Form2CashReciever'
		$this->SetXY(203, 69);
		$this->Cell(48,0, $this->fieldsForm2_1['Form2CashReciever'], 0, 0, 'N', 0, '', 1);

		//'Form2CashRecieverName1'
		$this->SetXY(191, 72);
		$this->Cell(60,0, $this->fieldsForm2_1['Form2CashRecieverName1'], 0, 0, 'N', 0, '', 1);

		//'Form2CashRecieverName2'
		$this->SetXY(173, 74.8);
		$this->Cell(78,0, $this->fieldsForm2_1['Form2CashRecieverName2'], 0, 0, 'N', 0, '', 1);

		//'Form2IFP'
		$this->SetXY(179.2, 78.7);
		$this->Cell(43,0, $this->fieldsForm2_1['Form2IFP'], 0, 0, 'C', 0, '', 4);

		//'Form2PayInCash'
		$this->SetXY(213.3, 80.2);
		$this->Cell(0,0, $this->fieldsForm2_1['Form2PayInCash'], 0, 0, 'N', 0, '', 1);

		//'Form2INN'
		$this->SetXY(179.2, 82.7);
		$this->Cell(50,0, $this->fieldsForm2_1['Form2INN'], 0, 0, 'C', 0, '', 4);

		//'Form2CorrAccount'
		$this->SetXY(179.2, 86.6);
		$this->Cell(71,0, $this->fieldsForm2_1['Form2CorrAccount'], 0, 0, 'C', 0, '', 4);

		//'Form2BankName1'
		$this->SetXY(187, 89.5);
		$this->Cell(63,0, $this->fieldsForm2_1['Form2BankName1'], 0, 0, 'N', 0, '', 1);

		//'Form2BankName2'
		$this->SetXY(172, 92.2);
		$this->Cell(78,0, $this->fieldsForm2_1['Form2BankName2'], 0, 0, 'N', 0, '', 1);

		//'Form2CheckAccount'
		$this->SetXY(179.2, 96.1);
		$this->Cell(71,0, $this->fieldsForm2_1['Form2CheckAccount'], 0, 0, 'C', 0, '', 4);

		//'Form2BIK'
		$this->SetXY(179.2, 100.2);
		$this->Cell(96,0, $this->fieldsForm2_1['Form2BIK'], 0, 0, 'C', 0, '', 4);

		//'Form2OGRN'
		$this->SetXY(179.2, 104.6);
		$this->Cell(58.5,0, $this->fieldsForm2_1['Form2OGRN'], 0, 0, 'C', 0, '', 4);

		//'Form2BankAddress1'
		$this->SetXY(179, 107);
		$this->Cell(72,0, $this->fieldsForm2_1['Form2BankAddress1'], 0, 0, 'N', 0, '', 1);

		//'Form2BankAddress2'
		$this->SetXY(172, 110);
		$this->Cell(79,0, $this->fieldsForm2_1['Form2BankAddress2'], 0, 0, 'N', 0, '', 1);

		//'Form2BankAddress3'
		$this->SetXY(172, 113);
		$this->Cell(63,0, $this->fieldsForm2_1['Form2BankAddress3'], 0, 0, 'N', 0, '', 1);

		//'Form2BankIndex'
		$this->SetXY(216, 112.8);
		$this->Cell(35.5,0, $this->fieldsForm2_1['Form2BankIndex'], 0, 0, 'C', 0, '', 4);
		

	}
    
    /**
     * Функция заполнения формы Обычная+наложка фк
     *
     * @return mixed    pdf
     * @uses            tcpdf lib
     * @uses            fpdi lib
     * @throws          Exception
     */
	private function FillForm2_5() {
	

		$this->SetFont('dejavusans', '', 7, '', true);
		
		$this->Rotate(90, 240, 95);
		$this->SetXY(123, 10);
		$this->Cell(28, 0, 'ПОЧТА РОССИИ', 0, 0, 'R', 0, '', 1);
		$this->barcode_style3['label'] = substr($this->fieldsForm2_1['barcode_RP'], 0, 6).'  '.substr($this->fieldsForm2_1['barcode_RP'], 6, 2).'  '.substr($this->fieldsForm2_1['barcode_RP'], 8, 5). '  '.substr($this->fieldsForm2_1['barcode_RP'], -1);
		$this->write1DBarcode($this->fieldsForm2_1['barcode_RP'], 'I25',  126, 10, 78, 20, 0.54, $this->barcode_style3, 'C');
// 		$this->SetXY(31, 13);
// 		$this->Cell(31, 0, 'ПОЧТА РОССИИ', 0, 0, 'R', 0, '', 1);
// 		$this->write1DBarcode($this->fieldsForm2_1['barcode_RP'], 'C128',  150, 18, 52, 12, 0.4, $this->barcode_style3, 'N');
		
		$this->SetFont('dejavusans', '', 8, '', true);
		$this->SetXY(312, 13);
		//$this->MultiCell(31, 0, "Новомосковский АО, поселение Марушинское\n07.11.2019\n109440", 1, 'R');
		$this->MultiCell(31, 0, $this->fieldsForm2_2['OPS'], 1, 'R');
		
		$this->SetFont('dejavusans', '', 12, '', true);
		//'Form2Parcel'
		$this->SetXY(205, 10.5);
		$this->Cell(0,0, $this->fieldsForm2_2['Form2Parcel'], 0, 0, 'N', 0, '', 1);

		//'Form2Banderol'
		$this->SetXY(204, 23.2);
		$this->Cell(0,0, $this->fieldsForm2_2['Form2Banderol'], 0, 0, 'N', 0, '', 1);

		$this->SetFont('dejavusans', '', 8, '', true);
		//'Form2Insured'
		$this->SetXY(254, 10);
		$this->Cell(0,0, $this->fieldsForm2_2['Form2Insured'], 0, 0, 'N', 0, '', 1);

		//'Form2CashOnDelivery'
		$this->SetXY(254, 13.5);
		$this->Cell(0,0, $this->fieldsForm2_2['Form2CashOnDelivery'], 0, 0, 'N', 0, '', 1);

		//'Form2WithInventory'
		$this->SetXY(238.4, 15);
		$this->Cell(0,0, $this->fieldsForm2_2['Form2WithInventory'], 0, 0, 'N', 0, '', 1);

		//'Form2SimpleNotification'
		$this->SetXY(238.4, 18);
		$this->Cell(0,0, $this->fieldsForm2_2['Form2SimpleNotification'], 0, 0, 'N', 0, '', 1);

		//'Form2OrderedNotification'
		$this->SetXY(238.4, 21);
		$this->Cell(0,0, $this->fieldsForm2_2['Form2OrderedNotification'], 0, 0, 'N', 0, '', 1);

		$this->SetFont('dejavusans', '', 12, '', true);
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
		$this->SetXY(148, 52);
		$this->Cell(79,0, $this->fieldsForm2_2['Form2Sender'], 0, 0, 'N', 0, '', 1);//+

		//'Form2SenderAddress1'
		$this->SetXY(130, 73);
		$this->Cell(85,0, $this->fieldsForm2_2['Form2SenderAddress1'], 0, 0, 'N', 0, '', 1);

		//'Form2SenderAddress2'
		$this->SetXY(130, 79);
		$this->Cell(85,0, $this->fieldsForm2_2['Form2SenderAddress2'], 0, 0, 'N', 0, '', 1);

		//'Form2SenderAddress3'
		$this->SetXY(130, 85);
		$this->Cell(85,0, $this->fieldsForm2_2['Form2SenderAddress3'], 0, 0, 'N', 0, '', 1);

		//'Form2SenderPhone'
		$this->SetXY(157, 77);
		$this->Cell(39,0, $this->fieldsForm2_2['Form2SenderPhone'], 0, 0, 'С', 0, '', 4);

		//'Form2SenderIndex'
		$this->SetXY(197, 94);
		$this->Cell(31,0, $this->fieldsForm2_2['Form2SenderIndex'], 0, 0, 'C', 0, '', 4);

		//'Form2SummInsured'
		$this->SetXY(231, 50);
		$this->Cell(98,0, $this->fieldsForm2_2['Form2SummInsured'], 0, 0, 'N', 0, '', 1);//+

		//'Form2SummCashOnDelivery'
		$this->SetXY(231, 62);
		$this->Cell(98,0, $this->fieldsForm2_2['Form2SummCashOnDelivery'], 0, 0, 'N', 0, '', 1);//+

		//'Form2Recipient'
		$this->SetXY(243, 84);
		$this->Cell(85,0, $this->fieldsForm2_2['Form2Recipient'], 0, 0, 'N', 0, '', 1);//+

		//'Form2RecipientAddress1'
		$this->SetXY(231, 104);
		$this->Cell(98,0, $this->fieldsForm2_2['Form2RecipientAddress1'], 0, 0, 'N', 0, '', 1);//+

		//'Form2RecipientAddress2'
		$this->SetXY(231, 110);
		$this->Cell(98,0, $this->fieldsForm2_2['Form2RecipientAddress2'], 0, 0, 'N', 0, '', 1);//+

		//'Form2RecipientAddress3'
		$this->SetXY(231, 116);
		$this->Cell(98,0, $this->fieldsForm2_2['Form2RecipientAddress3'], 0, 0, 'N', 0, '', 1);//+

		//'Form2RecipientPhone'
		$this->SetXY(238, 126);
		$this->Cell(53,0, $this->fieldsForm2_2['Form2RecipientPhone'], 0, 0, 'C', 0, '', 4);//+

		//'Form2RecipientIndex'
		$this->SetXY(315, 126);
		$this->Cell(32,0, $this->fieldsForm2_2['Form2RecipientIndex'], 0, 0, 'N', 0, '', 4);//+

		//'Form2Weight'
		$this->SetXY(245, 138.3);
		$this->Cell(13,0, $this->fieldsForm2_1['Form2Weight'], 0, 0, 'C', 0, '', 1);//+

		//'Form2Price'
		$this->SetXY(282, 138.3);
		$this->Cell(13,0, $this->fieldsForm2_2['Form2Price'], 0, 0, 'C', 0, '', 1);//+


		$this->SetFont('dejavusans', '', 8, '', true);
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
		//комментарий на склад
		$this->SetXY(155, 155);
		$this->Cell(0, 0, $this->fieldsForm2_1['Form2Comment'], 0, 0, 'N', 0, '', 1);

	}
	
    /**
     * Функция генерации формы Посылка Онлайн
     *
     * @param string    $outputType - тип pdf, возвращаемый функцией
     *   I - вывод в браузер
     *   D - принудительная загрузка файла с диалогом "Сохранить"
     *   F - локальное (на сервере) сохранение файла
     *   S - вовзрат в качестве строки
     * @param string    $filename - название файла для сохранения
     * @return mixed    pdf
     * @uses            tcpdf lib
     * @uses            fpdi lib
     * @throws          Exception
     */
	public function PDF1($ids = null, $list = null, $proj = null, $account = null) {
	 
		$this->Init($ids, $list, $proj, $account);
		$this->AddPage('L');
		$this->setSourceFile($_SERVER["DOCUMENT_ROOT"].'/pdf/templates/PDF4.pdf');
		$tplId = $this->importPage(1);
		$this->useTemplate($tplId, 0, 0);

		$this->FillForm1();
		$this->FillForm2_1();

		$filename = $_SERVER["DOCUMENT_ROOT"] .'/pdf/exit/1Form.pdf';
		while (true) {
			$filelink = '/pdf/exit/'. md5('1Form' . microtime()) .'.pdf';
			$filename = $_SERVER["DOCUMENT_ROOT"] . $filelink;
			if (!file_exists($filename)) break;
		}
		ob_start();
		$this->Output('1Form.pdf', 'I');
		$pdfBase64 = ob_get_contents();
		ob_end_clean();
		$this->Output($filename, 'F');
		echo '//'. DOMAIN . $filelink;
	
	}

    /**
     * Функция генерации формы  Посылка нестандартная
     *
     * @param string    $outputType - тип pdf, возвращаемый функцией
     *   I - вывод в браузер
     *   D - принудительная загрузка файла с диалогом "Сохранить"
     *   F - локальное (на сервере) сохранение файла
     *   S - вовзрат в качестве строки
     * @param string    $filename - название файла для сохранения
     * @return mixed    pdf
     * @uses            tcpdf lib
     * @uses            fpdi lib
     * @throws          Exception
     */
	public function PDF2($ids = null, $list = null, $proj = null, $account = null) {

		$this->Init($ids, $list, $proj, $account);
		$this->AddPage('L');
		$this->setSourceFile($_SERVER["DOCUMENT_ROOT"].'/pdf/templates/PDF2.pdf');
		$tplId = $this->importPage(1);
		$this->useTemplate($tplId, 0, 0);

		$this->FillForm1();
		$this->FillForm2_2();

		$filename = $_SERVER["DOCUMENT_ROOT"] .'/pdf/exit/2Form.pdf';
		while (true) {
			$filelink = '/pdf/exit/'. md5('2Form' . microtime()) .'.pdf';
			$filename = $_SERVER["DOCUMENT_ROOT"] . $filelink;
			if (!file_exists($filename)) break;
		}
		ob_start();
		$this->Output('2Form.pdf', 'I');
		$pdfBase64 = ob_get_contents();
		ob_end_clean();
		$this->Output($filename, 'F');
		echo '//'. DOMAIN . $filelink;
	
	}
	
    /**
     * Функция генерации формы Обычная+наложка фк
     *
     * @param string    $outputType - тип pdf, возвращаемый функцией
     *   I - вывод в браузер
     *   D - принудительная загрузка файла с диалогом "Сохранить"
     *   F - локальное (на сервере) сохранение файла
     *   S - вовзрат в качестве строки
     * @param string    $filename - название файла для сохранения
     * @return mixed    pdf
     * @uses            tcpdf lib
     * @uses            fpdi lib
     * @throws          Exception
     */
	public function PDF3($ids = null, $list = null, $proj = null, $account = null) {

		$this->Init($ids, $list, $proj, $account);
		$this->AddPage('L');
		$this->setSourceFile($_SERVER["DOCUMENT_ROOT"].'/pdf/templates/PDF3.pdf');
		$tplId = $this->importPage(1);
		$this->useTemplate($tplId, 0, 0);

		$this->FillForm1();
		$this->FillForm2_3();

		$filename = $_SERVER["DOCUMENT_ROOT"] .'/pdf/exit/3Form.pdf';
		while (true) {
			$filelink = '/pdf/exit/'. md5('3Form' . microtime()) .'.pdf';
			$filename = $_SERVER["DOCUMENT_ROOT"] . $filelink;
			if (!file_exists($filename)) break;
		}

		ob_start();
		$this->Output('3Form.pdf', 'I');
		$pdfBase64 = ob_get_contents();
		ob_end_clean();
		$this->Output($filename, 'F');
		
		echo '//'. DOMAIN . $filelink;
	
	}
	
    /**
     * Функция генерации формы Обычная+наложка фк
     *
     * @param string    $outputType - тип pdf, возвращаемый функцией
     *   I - вывод в браузер
     *   D - принудительная загрузка файла с диалогом "Сохранить"
     *   F - локальное (на сервере) сохранение файла
     *   S - вовзрат в качестве строки
     * @param string    $filename - название файла для сохранения
     * @return mixed    pdf
     * @uses            tcpdf lib
     * @uses            fpdi lib
     * @throws          Exception
     */
	public function PDF4($ids = null, $list = null, $proj = null, $account = null) {

		$this->Init($ids, $list, $proj, $account);
		$this->AddPage('L');
		$this->setSourceFile($_SERVER["DOCUMENT_ROOT"].'/pdf/templates/PDF4.pdf');
		$tplId = $this->importPage(1);
		$this->useTemplate($tplId, 0, 0);

		$this->FillForm1_1();
		$this->FillForm2_4();

		$filename = $_SERVER["DOCUMENT_ROOT"] .'/pdf/exit/4Form.pdf';
		while (true) {
			$filelink = '/pdf/exit/'. md5('4Form' . microtime()) .'.pdf';
			$filename = $_SERVER["DOCUMENT_ROOT"] . $filelink;
			if (!file_exists($filename)) break;
		}

		ob_start();
		$this->Output('4Form.pdf', 'I');
		$pdfBase64 = ob_get_contents();
		ob_end_clean();
		$this->Output($filename, 'F');
		
		echo '//'. DOMAIN . $filelink;
	
	}
    
    /**
     * Функция генерации формы Обычная+наложка фк
     *
     * @param string    $outputType - тип pdf, возвращаемый функцией
     *   I - вывод в браузер
     *   D - принудительная загрузка файла с диалогом "Сохранить"
     *   F - локальное (на сервере) сохранение файла
     *   S - вовзрат в качестве строки
     * @param string    $filename - название файла для сохранения
     * @return mixed    pdf
     * @uses            tcpdf lib
     * @uses            fpdi lib
     * @throws          Exception
     */
	public function PDF5($ids = null, $list = null, $proj = null, $account = null) {

		$this->Init($ids, $list, $proj, $account);
		$this->AddPage('L');
		$this->setSourceFile($_SERVER["DOCUMENT_ROOT"].'/pdf/templates/PDF5.pdf');
		$tplId = $this->importPage(1);
		$this->useTemplate($tplId, 0, 0);

		$this->FillForm1_1();
		$this->FillForm2_5();

		$filename = $_SERVER["DOCUMENT_ROOT"] .'/pdf/exit/5Form.pdf';
		while (true) {
			$filelink = '/pdf/exit/'. md5('5Form' . microtime()) .'.pdf';
			$filename = $_SERVER["DOCUMENT_ROOT"] . $filelink;
			if (!file_exists($filename)) break;
		}

		ob_start();
		$this->Output('5Form.pdf', 'I');
		$pdfBase64 = ob_get_contents();
		ob_end_clean();
		$this->Output($filename, 'F');
		
		echo '//'. DOMAIN . $filelink;
	
	}

	public function PDF6($ids = null, $list = null, $proj = null, $account = null) {

		$this->Init($ids, $list, $proj, $account);
		$this->AddPage('L');
		$this->setSourceFile($_SERVER["DOCUMENT_ROOT"].'/pdf/templates/PDF6.pdf');
		$tplId = $this->importPage(1);
		$this->useTemplate($tplId, 0, 0);

		$this->FillForm1_1();
		$this->FillForm2_4();

		$filename = $_SERVER["DOCUMENT_ROOT"] .'/pdf/exit/6Form.pdf';
		while (true) {
			$filelink = '/pdf/exit/'. md5('6Form' . microtime()) .'.pdf';
			$filename = $_SERVER["DOCUMENT_ROOT"] . $filelink;
			if (!file_exists($filename)) break;
		}

		ob_start();
		$this->Output('6Form.pdf', 'I');
		$pdfBase64 = ob_get_contents();
		ob_end_clean();
		$this->Output($filename, 'F');
		
		echo '//'. DOMAIN . $filelink;
	
	}

	
		
    /**
     * Функция генерации форм Посылка Онлайн, Обычная+наложка фк, Посылка нестандартная 
     * несколько заявок в одном документе
     *
     * @param string    $outputType - тип pdf, возвращаемый функцией
     *   I - вывод в браузер
     *   D - принудительная загрузка файла с диалогом "Сохранить"
     *   F - локальное (на сервере) сохранение файла
     *   S - вовзрат в качестве строки
     * @param string    $filename - название файла для сохранения
     * @return mixed    pdf
     * @uses            tcpdf lib
     * @uses            fpdi lib
     * @throws          Exception
     */
	function PDFAll($ids = null, $list = null, $proj = null, $account = null) {
		$pr = 3;
		if ($proj == '1') $pr = 4;
		if ($proj == '2') $pr = 5;
		
		foreach ($ids as $id) {
			$this->Init([$id], $list, $proj, $account);
			$this->AddPage('L');
			$this->setSourceFile($_SERVER["DOCUMENT_ROOT"] .'/pdf/templates/PDF'. $pr .'.pdf');
			$tplId = $this->importPage(1);
			$this->useTemplate($tplId, 0, 0);
			$this->FillForm1_1();
			$func = 'FillForm2_'. $pr;
			$this->$func();
		}

		$filename = $_SERVER["DOCUMENT_ROOT"] .'/pdf/exit/AllForm.pdf';
		while (true) {
			$filelink = '/pdf/exit/'. md5('AllForm' . microtime()) .'.pdf';
			$filename = $_SERVER["DOCUMENT_ROOT"] . $filelink;
			if (!file_exists($filename)) break;
		}

		ob_start();
		$this->Output('AllForm.pdf', 'I');
		$pdfBase64 = ob_get_contents();
		ob_end_clean();
		$this->Output($filename, 'F');
		echo '//'. DOMAIN . $filelink;
	
	}	
    
    /**
     * Склоняем словоформу
     * @param mixed $n
     * @param mixed $f1
     * @param mixed $f2
     * @param mixed $f5
     * @return mixed
     */
	protected function morph($n, $f1, $f2, $f5) {
        $n = abs(intval($n)) % 100;
        if ($n>10 && $n<20) {
            return $f5;
        }
        $n = $n % 10;
        if ($n>1 && $n<5) {
            return $f2;
        }
        if ($n==1) {
            return $f1;
        }
        return $f5;
	}
    
	/**
	 * Возвращает сумму прописью
    * @uses morph(...)
   */
	protected function SummInWords($num, $kopeykiFlag = true) {
        $nul='ноль';
        $ten=array(
            array('','один','два','три','четыре','пять','шесть','семь', 'восемь','девять'),
            array('','одна','две','три','четыре','пять','шесть','семь', 'восемь','девять'),
        );
        $a20=array('десять','одиннадцать','двенадцать','тринадцать','четырнадцать' ,'пятнадцать','шестнадцать','семнадцать','восемнадцать','девятнадцать');
        $tens=array(2=>'двадцать','тридцать','сорок','пятьдесят','шестьдесят','семьдесят' ,'восемьдесят','девяносто');
        $hundred=array('','сто','двести','триста','четыреста','пятьсот','шестьсот', 'семьсот','восемьсот','девятьсот');
        $unit=array( // Units
            array('коп.' ,'коп.' ,'коп.',    1),
            array('руб'   ,'руб'   ,'руб'    ,0),
            //array('рубль'   ,'рубля'   ,'рублей'    ,0),
            array('тысяча'  ,'тысячи'  ,'тысяч'     ,1),
            array('миллион' ,'миллиона','миллионов' ,0),
            array('миллиард','милиарда','миллиардов',0),
        );
        //
        list($rub,$kop) = explode('.', sprintf("%015.2f", floatval($num)));
        $out = array();
        if (intval($rub)>0) {
            foreach (str_split($rub, 3) as $uk => $v) { // by 3 symbols
                if (!intval($v)) {
                    continue;
                }
                $uk = sizeof($unit)-$uk-1; // unit key
                $gender = $unit[$uk][3];
                list($i1,$i2,$i3) = array_map('intval', str_split($v, 1));
                // mega-logic
                $out[] = $hundred[$i1]; # 1xx-9xx
                if ($i2>1) {
                    $out[]= $tens[$i2].' '.$ten[$gender][$i3]; # 20-99
                } else {
                    $out[]= $i2>0 ? $a20[$i3] : $ten[$gender][$i3]; # 10-19 | 1-9
                }
                // units without rub & kop
                if ($uk>1) {
                    $out[]= $this->morph($v, $unit[$uk][0], $unit[$uk][1], $unit[$uk][2]);
                }
            } //foreach
        } else {
            $out[] = $nul;
        }
        $out[] = $this->morph(intval($rub), $unit[1][0], $unit[1][1], $unit[1][2]); // rub
        if ($kopeykiFlag) {
            $out[] = $kop.' '.$this->morph($kop, $unit[0][0], $unit[0][1], $unit[0][2]); // kop
        }
        return trim(preg_replace('/ {2,}/', ' ', join(' ', $out)));
	}

	function cheackDate(){
		$hour = date("H:i");
    	if($hour > '09:00'){
			return date("d.m.Y",strtotime("+1 days"));
    	}else{
			return date("d.m.Y");
		}
	}

}

?>