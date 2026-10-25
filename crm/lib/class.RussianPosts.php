<?php 
namespace lib;

require_once('./vendor/autoload.php');
use LapayGroup\RussianPost\Providers\OtpravkaApi;
use LapayGroup\RussianPost\ParcelInfo;

/**
* class.RussianPosts.php 
*
*Класс - библиотека с функциями для работы с Почтой России 
*подгружается через автоподгрузку классов
*
*
**/



// SELECT `table_field`, `name_field`, 2002, `caption`
// FROM `list_field`
// WHERE `table_field` 
// REGEXP 'list10|list11|list23|list24|list25|list26|list27|list28|list29|list30|list31|list32'
// AND `name_field` != 'statuschange'
// AND `name_field` != 'timeupdate'
// AND `name_field` != 'geo'
// AND `name_field` != 'status'
// AND `name_field` != 'time'
// AND `name_field` != 'premium'
// AND `name_field` != 'id_user'
// AND `name_field` != 'domain'
// AND `name_field` != 'id'
// AND `name_field` != 'page'
// ORDER BY `table_field`
// LIMIT 1000



//авторизация

// $otpravkaAuth['token'] = 'otpravka_token';
// $otpravkaAuth['key']   = 'otpravka_key';
// 
// $trackingAuth['login'] = 'tracking_login';
// $trackingAuth['password'] = 'tracking_password';
// 
// $authParams['auth']['otpravka'] = $otpravkaAuth;
// $authParams['auth']['tracking'] = $trackingAuth;


// $authParams['auth']['otpravka']['token'] = $otpravka_token;
// $authParams['auth']['otpravka']['key'] = $otpravka_key;



// Заполнение формы наложенного платежа (Ф.112-ЭП)
// Заполнение адресного ярлыка (Ф.7-П)
// https://github.com/Cosmologist/RussianPost

//РОССИЯ ПОЧТОВЫЕ ИНДЕКСЫ
//http://www.ruspostindex.ru/index.html


// Форма 7 адресный ярлык. Отправление 1 класса;
// Форма 7 адресный ярлык. Бандероль;
// Форма 7 адресный ярлык. Посылка;
// Форма 112ЭП Наложенный платеж + почтовый перевод.
// http://blog-about.ru/blog/forma-7-i-forma-112-dlya-pochty-rossii/


class RussianPosts {
	
	private static $otpravka_token = 'd_5a0ku4ePpiqkIYGpR8a7ADnexscoGC';
	private static $otpravka_key = 'dHJleWRwbHl1c0BnbWFpbC5jb206NDEzNDM5NjEwRGtmcDhjcGp0UGVhY2VkYWJvbDE=';


//     function __construct() {
// 		$auth = JBase::Get_Data('list23', '*', ['status' => 1]);
// 		$auth_data = $auth->fetch_assoc();
// 		self::$otpravka_token = $auth_data['f1561714784n'];
// 		self::$otpravka_key = base64_encode($auth_data['name'].':'.$auth_data['f1561714768n']);
//     }

		
		
	//узнаем статус посылки у почты россии
	function getStatus($id = null) {
		//TEST
		//if ($id) {}
		return 5;
	}
	//Неблагонадёжный получатель
	//Актуально для отправлений с наложенным платежом. Определяет, является ли получатель благонадёжным, есть ли прецеденты невыкупа
	function untrustworthyRecipient() {

		$otpravkaApi = new OtpravkaApi(['auth' => ['otpravka' => [
			'token' => self::$otpravka_token,
			'key' => self::$otpravka_key
		]]]);
  
		$recepient = new \LapayGroup\RussianPost\Entity\Recipient();
		$recepient->setAddress('650905 ЯГУНОВСКИЙ, КЕМЕРОВСКАЯ ОБЛАСТЬ, УЛ БЕЛОЗЕРНАЯ, ДОМ 21,КВ 1');
		$recepient->setName('Иванов Петр Николаевич');
		$recepient->setPhone('79260112367');
		
		try {
			$res = $otpravkaApi->untrustworthyRecipient($recepient);
			/*
			Array
			(  
				[raw-address] => 650905 ЯГУНОВСКИЙ, КЕМЕРОВСКАЯ ОБЛАСТЬ, УЛ БЕЛОЗЕРНАЯ,ДОМ 21,КВ 1
				[raw-full-name] => Иванов Петр Николаевич
				[raw-telephone] => 79260112367
				[unreliability] => RELIABLE //НАДЕЖНЫЙ
			)
			*/
			return json_encode($res, JSON_UNESCAPED_UNICODE);
		}
      
		catch (\LapayGroup\RussianPost\Exceptions\RussianPostException $e) {
			// Обработка ошибочного ответа от API ПРФ
		}
      
		catch (\Exception $e) {
			// Обработка нештатной ситуации
		}
  
		// Обработка списка получателей
// 		$recepients[0] = $recepient;
// 		$recepients[1] = $recepient;
//   
// 		try {
// 			$res = $otpravkaApi->untrustworthyRecipients($recepients);
// 			/*
// 				Array (
// 					[0] => Array (
// 							[raw-address] => 650905 ЯГУНОВСКИЙ, КЕМЕРОВСКАЯ ОБЛАСТЬ, УЛ БЕЛОЗЕРНАЯ,ДОМ 21,КВ 1
// 							[raw-full-name] => Иванов Петр Николаевич
// 							[raw-telephone] => 79260112367
// 							[unreliability] => RELIABLE
// 					),
// 					[1] => Array (
// 							[raw-address] => 650905 ЯГУНОВСКИЙ, КЕМЕРåОВСКАЯ ОБЛАСТЬ, УЛ БЕЛОЗЕРНАЯ,ДОМ 21,КВ 1
// 							[raw-full-name] => Иванов Петр Николаевич
// 							[raw-telephone] => 79260112367
// 							[unreliability] => RELIABLE
// 					)
// 				)
// 			*/
// 		}
//             
// 		catch (\LapayGroup\RussianPost\Exceptions\RussianPostException $e) {
// 			// Обработка ошибочного ответа от API ПРФ
// 		}
//       
// 		catch (\Exception $e) {
// 			// Обработка нештатной ситуации
// 		}
	}
	
	//Отображает баланс расчетного счета. Возвращаемые значения указываются в копейках
	function getBalance() {
	
// 		use Symfony\Component\Yaml\Yaml;
// 		use LapayGroup\RussianPost\Providers\OtpravkaApi;
  
		try {
			$otpravkaApi = new OtpravkaApi(Yaml::parse(file_get_contents('path_to_config.yaml')));
      	$res = $otpravkaApi->getBalance();
      	
			/*
			Array
			(
				[balance] => 0
				[balance-date] => 2019-06-21
				[work-with-balance] => 1
			)
			*/
		}
              
		catch (\LapayGroup\RussianPost\Exceptions\RussianPostException $e) {
			// Обработка ошибочного ответа от API ПРФ
		}
      
		catch (\Exception $e) {
			// Обработка нештатной ситуации
		}
	}
	
	//Расчет сроков доставки по типам отправлений используя API доставки Почты России
	function getDeliveryPeriod() {
	
// 		use Symfony\Component\Yaml\Yaml;
// 		use LapayGroup\RussianPost\Providers\OtpravkaApi;
  
		try {
			$otpravkaApi = new OtpravkaApi(Yaml::parse(file_get_contents('path_to_config.yaml')));
      	$res = $otpravkaApi->getDeliveryPeriod(\LapayGroup\RussianPost\PostType::EMS, 115551, 115551);
      	
      	/*
      	 Array
      	 (
      	     [version] => 1.2.10.28
      	     [date] => 20190621
      	     [datefirst] => 20190411
      	     [posttype] => 7
      	     [posttypename] => EMS
      	     [from] => 115551
      	     [fromname] => МОСКВА 551
      	     [to] => 115551
      	     [toname] => МОСКВА 551
      	     [route] => 43-45000000-45000000
      	     [routename] => МОСКВА 551-МОСКВА 551
      	     [delivery] => Array
      	         (
      	             [min] => 1
      	             [max] => 1
      	         )	 
      	 )
      	 */
		}
              
		catch (\LapayGroup\RussianPost\Exceptions\RussianPostException $e) {
			// Обработка ошибочного ответа от API ПРФ
		}
      
		catch (\Exception $e) {
			// Обработка нештатной ситуации
		}
	}
	
	//Расчет стоимости пересылки
	function getTotalRate() {
		try {
      	$otpravkaApi = new OtpravkaApi(Yaml::parse(file_get_contents('path_to_config.yaml')));
      	
      	$parcelInfo = new ParcelInfo();
      	$parcelInfo->setIndexFrom($list[0]['operator-postcode']); // Индекс пункта сдачи из функции $OtpravkaApi->shippingPoints()
      	$parcelInfo->setIndexTo(644015);
      	$parcelInfo->setMailCategory('ORDINARY'); // https://otpravka.pochta.ru/specification#/enums-base-mail-category
      	$parcelInfo->setMailType('POSTAL_PARCEL'); // https://otpravka.pochta.ru/specification#/enums-base-mail-type
      	$parcelInfo->setWeight(1000);
      	$parcelInfo->setFragile(true);
    	
    	  $tariffInfo = $otpravkaApi->getDeliveryTariff($parcelInfo);
    	  echo $tariffInfo->getTotalRate()/100 . ' руб.';
    	  
    	  /*
    	   LapayGroup\RussianPost\TariffInfo Object
    	   (
    	       [totalRate:LapayGroup\RussianPost\TariffInfo:private] => 30658
    	       [totalNds:LapayGroup\RussianPost\TariffInfo:private] => 6132
    	       [aviaRate:LapayGroup\RussianPost\TariffInfo:private] => 0
    	       [aviaNds:LapayGroup\RussianPost\TariffInfo:private] => 0
    	       [deliveryMinDays:LapayGroup\RussianPost\TariffInfo:private] => 1
    	       [deliveryMaxDays:LapayGroup\RussianPost\TariffInfo:private] => 3
    	       [fragileRate:LapayGroup\RussianPost\TariffInfo:p rivate] => 7075
    	       [fragileNds:LapayGroup\RussianPost\TariffInfo:private] => 1415
    	       [groundRate:LapayGroup\RussianPost\TariffInfo:private] => 30658
    	       [groundNds:LapayGroup\RussianPost\TariffInfo:private] => 6132
    	       [insuranceRate:LapayGroup\RussianPost\TariffInfo:private] => 0
    	       [insuranceNds:LapayGroup\RussianPost\TariffInfo:private] => 0
    	       [noticeRate:LapayGroup\RussianPost\TariffInfo:private] => 0
    	       [noticeNds:LapayGroup\RussianPost\TariffInfo:private] => 0
    	       [oversizeRate:LapayGroup\RussianPost\TariffInfo:private] => 0
    	       [oversizeNds:LapayGroup\RussianPost\TariffInfo:private] => 0
    	   )
    	   */
		}
              
		catch (\LapayGroup\RussianPost\Exceptions\RussianPostException $e) {
			// Обработка ошибочного ответа от API ПРФ
		}
      
		catch (\Exception $e) {
			// Обработка нештатной ситуации
		}
	}
		
	//Расчет стоимости пересылки: Пример получения списка пунктов сдачи отправлений
	function shippingPoints() {

		$OtpravkaApi = new OtpravkaApi(Yaml::parse(file_get_contents('path_to_config.yaml')));
		$list = $OtpravkaApi->shippingPoints();

	}

	//Нормализация телефона
	function clearPhone() {
// 		use Symfony\Component\Yaml\Yaml;
  
		try {
      	$otpravkaApi = new OtpravkaApi(Yaml::parse(file_get_contents('path_to_config.yaml')));
      	
      	//список номеров телефлонов для нормализации.
      	$PhoneList = new \LapayGroup\RussianPost\PhoneList();
      	$PhoneList->add('9260120935');
      	$result = $otpravkaApi->clearPhone($PhoneList);
      	
      	/*
       	Array(
             [0] => Array
                 (
                     [id] => 0
                     [original-phone] => 9260120935
                     [phone-city-code] => 926
                     [phone-country-code] => 7
                     [phone-extension] =>
                     [phone-number] => 0120935
                     [quality-code] => GOOD
                 )
         
         )*/
         
  		}
              
		catch (\LapayGroup\RussianPost\Exceptions\RussianPostException $e) {
			// Обработка ошибочного ответа от API ПРФ
		}
      
		catch (\Exception $e) {
			// Обработка нештатной ситуации
		}
	}
	
	//Очищает, разделяет и помещает значения ФИО в соответствующие поля возвращаемого объекта. 
	//Параметр id (идентификатор записи) используется для установления соответствия переданных и полученных записей, 
	//так как порядок сортировки возвращаемых записей не гарантируется.
	function clearFio() {
// 		use Symfony\Component\Yaml\Yaml;
// 		use LapayGroup\RussianPost\Providers\OtpravkaApi;
  
		try {
      	$otpravkaApi = new OtpravkaApi(Yaml::parse(file_get_contents('path_to_config.yaml')));
      	
      	//список ФИО для нормализации
      	$fioList = new \LapayGroup\RussianPost\FioList();
      	$fioList->add('Иванов Петр игоревич');
      	$result = $otpravkaApi->clearFio($fioList);
      	
      	/*
      	 Array
      	 (
      	     [0] => Array
      	         (
      	             [id] => 0
      	             [middle-name] => Игоревич
      	             [name] => Петр
      	             [original-fio] => Иванов Петр игоревич
      	             [quality-code] => EDITED
      	             [surname] => Иванов
      	         )
      	 
      	 )
      	 */
  		}
              
		catch (\LapayGroup\RussianPost\Exceptions\RussianPostException $e) {
			// Обработка ошибочного ответа от API ПРФ
		}
      
		catch (\Exception $e) {
			// Обработка нештатной ситуации
		}
	}
	
	//Метод используется для получения информации о конкретном отправлении. 
	//Возвращает подробную информацию по всем операциям, совершенным над отправлением.
	function getOperationsByRpo() {

		//use Symfony\Component\Yaml\Yaml;
		//use LapayGroup\RussianPost\Providers\Tracking;
  
		$Tracking = new Tracking('single', Yaml::parse(file_get_contents('path_to_config.yaml')));
		$result = $Tracking->getOperationsByRpo('10944022440321');

	}
	
	//Метод позволяет получить информацию об операциях с наложенным платежом, 
	//который связан с конкретным почтовым отправлением.
	function getNpayInfo() {

		//use Symfony\Component\Yaml\Yaml;
		//use LapayGroup\RussianPost\Providers\Tracking;
  
		$Tracking = new Tracking('single', Yaml::parse(file_get_contents('path_to_config.yaml')));
		$result = $Tracking->getNpayInfo('10944022440321');

	}
	
	//онлайн сервис отправка 
	function russianPostParcel() {
		$ids = (is_array($_POST['ids'])) ? $_POST['ids'] : [];
		$list = (int)$_POST['list'];
		$param = $_POST['param'];
		$account = (int)$_POST['account'];
		switch ($param) {
			case 'api':
				return self::tocsv($list, $ids);
			break;
			case 'russianPostParcel':
				RusPostApi::russianPostParcel($list, $ids, $account); break;
			case 'russianPostOnlineParcel':
				RusPostApi::russianPostOnlineParcel($list, $ids, $account); break;
			case 'russianPostParcelToNewStatus':
				RusPostApi::russianPostParcelToNewStatus($list, $ids, $account); break;
			case 'russianPostOnlineParcelToNewStatus':
				RusPostApi::russianPostOnlineParcelToNewStatus($list, $ids, $account); break;
			case 'russianPostOnlineCourier':
				RusPostApi::russianPostOnlineCourier($list, $ids, $account); break;
			case 'russianPostOnlineCourierToNewStatus':
				RusPostApi::russianPostOnlineCourierToNewStatus($list, $ids, $account); break;
			break;
		}
	}

	//генерация пдф бланков
	function blanks() {
		$ids = (is_array($_POST['ids'])) ? $_POST['ids'] : [];
		$list = (int)$_POST['list'];
		$status = (int)$_POST['status'];
		$template = (in_array((int)$_POST['param'], [1,2,3,4,5,6])) ? (int)$_POST['param'] : 0;
		$account = (int)$_POST['account'];
		if ($list > 0) {
			if (count($ids) == 1 && $template > 0) {
				$cpdf = new CPDF();
				switch($template) {
					case 1://Посылка Онлайн
						//return $cpdf->PDF1($ids, $list, $template, $account);
						return $cpdf->PDF4($ids, $list, $template, $account);
					break;
					case 2://Посылка нестандартная
						//return $cpdf->PDF2($ids, $list, $template, $account);
						return $cpdf->PDF5($ids, $list, $template, $account);
					case 3://Обычная+наложка фк
						return $cpdf->PDF3($ids, $list, $template, $account);
					break;
					case 4://test
						return $cpdf->PDF1($ids, $list, $template, $account);
					break;
					case 5://test
						return $cpdf->PDF5($ids, $list, $template, $account);
					break;
					case 6://Курьер Онлайн
						return $cpdf->PDF6($ids, $list, $template, $account);
					break;
				}
			} elseif (count($ids) > 0 && $template > 0) {
				$cpdf = new CPDF();
				return $cpdf->PDFAll($ids, $list, $template, $account);
			} elseif ($template > 0 && $status > 0) {
				$data = JBase::Get_Data('list'. $list, ['id'], ['status' => $status]);
				$list_data = [];
				if (!empty($data)) {
					while( $s = $data->fetch_assoc() ) {
						$list_data[] = $s['id'];
					}
					$cpdf = new CPDF();
					return $cpdf->PDFAll($list_data, $list, $template, $account);
				} else return '23';
			}
		}
	}
	
	//Модуль Почта России
	function list10() {

// 			$list10['name'], //Название
// 			$list10['price'], //Цена
	}
	
	//Модуль Онлайн-сервиса Отправка
	function list11() {
	
// 			$list11['sender_country'], //Код страны
// 			$list11['sender_postOfficeIndex'], //Индекс места приема
// 			$list11['sender_mailCtg'], //Категория почтового отправления
// 			$list11['to_typeAddress'], //Тип адреса
// 			$list11['declaredValueFix'], //Фиксированная объявленная ценность
// 			$list11['isCourier'], //Отметка «Курьер»
// 			$list11['isFragile'], //Отметка «Осторожно/Хрупкое»
// 			$list11['isNoReturn'], //Отметка «Возврату не подлежит»
// 			$list11['system_dateDelivery'], //Дата сдачи в почтовое отделение
// 			$list11['isOrderNotice'], //Отметка «С заказным уведомлением»
// 			$list11['isSimpleNotice'], //Отметка «С простым уведомлением»
// 			$list11['notice_sms'], //Признак услуги SMS уведомления
// 			$list11['weight'], //Выводить вес со склада и считать тариф 
// 			$list11['weight_custom'], //Вес товара вручную в граммах
// 			$list11['dimension_height'], //Размеры: высота
// 			$list11['dimension_length'], //Размеры: длина
// 			$list11['dimension_width'], //Размеры: ширина
// 			$list11['getTariff'], //Получать тариф в доп. поле
// 			$list11['status_exported'], //Cтатус, в который переместится заказ после экспорта
// 			$list11['accountTemplateName'], //Название шаблона
// 			$list11['account'], //Аккаунт
// 			$list11['name'], //Название
// 			$list11['price'] //Цена
	}
	
	//Аккаунты Онлайн-сервиса Отправка
	function list23() {
	
// 			$list23['f1561714768n'], //Пароль
// 			$list23['f1561714784n'], //Токен авторизации
// 			$list23['name'], //Название
// 			$list23['price'] //Цена
	}
	
	//Почта России Форма 7А
	function list24() {
	
// 			$list24['from_name'], //Текст «От кого»
// 			$list24['from_city'], //Текст «Откуда»
// 			$list24['from_postIndex'], //Индекс места отправления
// 			$list24['type_letter'], //Тип: письмо 1-го класса
// 			$list24['type_banderol'], //Тип: бандероль 1-го класса
// 			$list24['type_posylka'], //Тип: посылка 1-го класса
// 			$list24['type_ob'], //Тип: с объявленной ценностью
// 			$list24['type_naloj'], //Тип: с наложенным платежом
// 			$list24['type_opis'], //Тип: с описью
// 			$list24['type_simplenotice'], //Тип: с простым уведомлением
// 			$list24['type_zakaznotice'], //Тип: с заказным уведомлением
// 			$list24['type_naloj_inside'], //Наложенный платеж внутри
// 			$list24['kpsh_print'], //Печатать КПШ
// 			$list24['kpsh_postIndex'], //Индекс на КПШ
// 			$list24['kpsh_city'], //Город ОПС
// 			$list24['kpsh_date'], //Выводить дату на КПШ
// 			$list24['notice_phone'], //Выводить номер телефона отправителя
// 			$list24['notice_phoneReciever'], //Выводить номер телефона получателя
// 			$list24['weight'], //Выводить вес со склада и считать тариф
// 			$list24['weight_product'], //Вес единицы товара в граммах
// 			$list24['weight_package'], //Вес упаковки в грамма
// 			$list24['weight_custom'], //Вес товара вручную в граммах
// 			$list24['air_notice_returnAddress'], //Вернуть по обратному адресу
// 			$list24['air_notice_landTransport'], //Направить наземным транспортом
// 			$list24['air_sign'], //Подпись отправителя
// 			$list24['name'], //Название
// 			$list24['price'] //Цена
	}
	
	//Почта России Форма 7Б
	function list25() {
	
// 			$list25['mod_type'], //Тип
// 			$list25['from_name'], //Текст «От кого»
// 			$list25['from_city'], //Текст «Откуда»
// 			$list25['from_postIndex'], //Текст «Индекс места отправления»
// 			$list25['notice_phoneSender'], //Введите номер телефона для уведомлений
// 			$list25['kpsh_city'], //Город ОПС
// 			$list25['kpsh_date'], //Выводить дату на КПШ
// 			$list25['type_opis'], //Тип: с описью
// 			$list25['type_prostaya'], //Тип: простая
// 			$list25['type_zakaznaya'], //Тип: заказная
// 			$list25['type_mailCtg2'], //Тип: с объявленной ценностью
// 			$list25['type_notice'], //С уведомлением
// 			$list25['type_mailCtg4'], //Тип: с объявленной ценностью и наложенным платежом
// 			$list25['type_naloj_inside'], //Наложенный платеж внутри
// 			$list25['kpsh_print'], //Печатать КПШ
// 			$list25['notice_phone'], //Выводить номер телефона отправителя
// 			$list25['notice_phoneReciever'], //Выводить номер телефона получателя
// 			$list25['weight'], //Выводить вес со склада и считать тариф
// 			$list25['name'], //Название
// 			$list25['price'] //Цена
	}
	
	//Почта России Форма 7П
	function list26() {
	
// 			$list26['mod_type'], //Тип
// 			$list26['from_name'], //Текст «От кого»
// 			$list26['from_city'], //Текст «Откуда»
// 			$list26['from_postIndex'], //Текст «Индекс места отправления»
// 			$list26['type_ob'], //Тип: с объявленной ценностью
// 			$list26['type_naloj'], //Тип: с наложенным платежом
// 			$list26['type_opis'], //Тип: с описью
// 			$list26['type_prostaya'], //Тип: с простым уведомлением
// 			$list26['type_zakaznaya'], //Тип: с заказным уведомлением
// 			$list26['type_naloj_inside'], //Наложенный платеж внутри
// 			$list26['kpsh_print'], //Печатать КПШ
// 			$list26['kpsh_city'], //Город ОПС
// 			$list26['kpsh_date'], //Выводить дату на КПШ
// 			$list26['notice_phoneSender'], //Введите номер телефона для уведомлений
// 			$list26['weight_product'], //Вес единицы товара в граммах
// 			$list26['weight_package'], //Вес упаковки в граммах
// 			$list26['weight_custom'], //Вес товара вручную в граммах
// 			$list26['air_sign'], //Подпись отправителя
// 			$list26['air_signOperator'], //Подпись оператора
// 			$list26['notice_phone'], //Выводить номер телефона отправителя
// 			$list26['notice_phoneReciever'], //Выводить номер телефона получателя
// 			$list26['weight'], //Выводить вес со склада и считать тариф
// 			$list26['price'], //Цена
// 			$list26['air_notice_returnAddress'], //Вернуть по обратному адресу
// 			$list26['air_notice_landTransport'], //Направить наземным транспортом
// 			$list26['specialNotes_heavy'], //Особые отметки: Тяжеловесная
// 			$list26['specialNotes_simple'], //Особые отметки: Простая
// 			$list26['specialNotes_standard'], //Особые отметки: Стандартная
// 			$list26['specialNotes_standardNegabitnaya'], //Особые отметки: Стандартная негабаритная
// 			$list26['specialNotes_common'], //Особые отметки: Обыкновенная
// 			$list26['specialNotes_bulky'], //Особые отметки: Крупногабаритная
// 			$list26['specialNotes_custom'], //Особые отметки: Заказная
// 			$list26['specialNotes_noStandard'], //Особые отметки: Нестандартная
// 			$list26['check_opis_fixedValueNDS'], //Фиксированная стоимость описи в вашем отделении (С НДС)
// 			$list26['details_ifp'], //ИФП/ИРП получателя платежа
// 			$list26['details_kor'], //Кор/счет получателя платежа
// 			$list26['details_inn'], //ИНН получателя платежа
// 			$list26['details_bankName'], //Наименование банка получателя платежа
// 			$list26['details_bik'], //БИК получателя платежа
// 			$list26['details_name'], //Наименование получателя платежа
// 			$list26['details_phone'], //Номер телефона получателя платежа
// 			$list26['details_ogrn'], //ОГРН получателя платежа
// 			$list26['details_ras'], //Рас/счет получателя платежа
// 			$list26['details_address'], //Адрес получателя платежа
// 			$list26['details_index'], //Индекс получателя платежа
// 			$list26['details_cash'] //Выплатить наличными деньгами
	}
	
	//Почта России Форма 112
	function list27() {
	
// 			$list27['datamatrix_raschet'], //Расчетный счет получателя
// 			$list27['datamatrix_korRaschet'], //Корреспондентский счет банка получателя
// 			$list27['datamatrix_bankName'], //Наименование банка получателя
// 			$list27['datamatrix_cod'], //ШПИ РПО с наложенным платежом
// 			$list27['datamatrix_use'], //Печатать двумерный матричный код
// 			$list27['name'], //Название
// 			$list27['price'], //Цена
// 			$list27['receiver_to'], //Адрес получателя перевода
// 			$list27['datamatrix_region'], //Регион получателя перевода
// 			$list27['fk_infozone'], //Зона информации клиента
// 			$list27['receiver_phone'], //Номер телефона получателя перевода
// 			$list27['fk_code'], //Код федерального клиента
// 			$list27['datamatrix_postIdnex'], //Почтовый индекс получателя перевода
// 			$list27['datamatrix_payType'], //Тип получателя перевода и форма оплаты
// 			$list27['datamatrix_senderPayType'], //Тип отправителя перевода
// 			$list27['datamatrix_inn'], //ИНН получателя
// 			$list27['datamatrix_bik'] //БИК банка получателя
	}
	
	//Почта России Форма 117
	function list28() {
	
// 			$list28['from_name'], //Текст «От кого»
// 			$list28['from_city'], //Текст «Откуда»
// 			$list28['from_postIndex'], //Текст «Индекс места отправления»
// 			$list28['fiz_document'], //Предъявлен документ
// 			$list28['fiz_document_seriya'], //Серия
// 			$list28['fiz_document_nomer'], //Номер
// 			$list28['fiz_document_vydan_date'], //выдан (дата)
// 			$list28['fiz_document_vydan_year'], //выдан (год)
// 			$list28['fiz_document_vydan_kem'], //выдан (кем)
// 			$list28['notice_phone'], //Выводить номер телефона отправителя
// 			$list28['notice_phoneReciever'], //Выводить номер телефона получателя
// 			$list28['name'], //Ф.И.О отправителя
// 			$list28['price'] //Цена
	}
	
	//Почта России Бланк отчета
	function list29() {
	
// 			$list29['price'], //Цена
// 			$list29['report_sender_mailType'], //Вид почтового отправления
// 			$list29['report_weight'], //Выводить вес со склада
// 			$list29['report_weight_product'], //Вес единицы товара в граммах
// 			$list29['report_weight_package'], //Вес упаковки в граммах
// 			$list29['report_weight_custom'], //Вес товара вручную в граммах
// 			$list29['name'] //Название
	}
	
	//Почта России Бланк заявления - указания
	function list30() {
	
// 			$list30['statement_mailCategory'], //Тип отправления
// 			$list30['statement_type_naloj'], //Наложенный платеж
// 			$list30['statement_type_ob'], //С объявленной ценностью
// 			$list30['statement_info_return'], //Отметка о возврате
// 			$list30['statement_info_correction'], //Отметка об изменении
// 			$list30['statement_info_extendedStorage'], //Отметка о продлении срока хранения
// 			$list30['statement_sender_name'], //Ф.И.О отправителя
// 			$list30['statement_sender_phone'], //Телефон отправителя
// 			$list30['statement_sender_postIndex'], //Индекс отправителя
// 			$list30['statement_sender_city'], //Город отправителя
// 			$list30['statement_sender_address'], //Адрес отправителя
// 			$list30['statement_sender_document_seriya'], //Паспорт: Серия
// 			$list30['statement_sender_document_nomer'], //Паспорт: Номер
// 			$list30['statement_sender_document_vydan_date'], //Паспорт: Выдан (дата)
// 			$list30['statement_sender_document_vydan_kem'], //Паспорт: Выдан (кем)
// 			$list30['statement_sender_document_code'] //Паспорт: код подразделения
	}
	
	//Почта России Список ф.103 (реестр ПО)
	function list31() {
	
// 			$list31['mod_type'], //Категория
// 			$list31['from_name'], //Текст «От кого»
// 			$list31['from_email'], //E-mail
// 			$list31['from_postIndex'], //Индекс места отправления
// 			$list31['type_prostaya'], //Простая
// 			$list31['type_zakaznaya'], //Заказная
// 			$list31['type_opis'], //C описью
// 			$list31['type_ob'], //C объявленной ценностью
// 			$list31['type_s_uved'], //C уведомлением
// 			$list31['type_ob_cennost_naloj'], //C объявленной ценностью и наложенным платежом
// 			$list31['from_receivePlace'], //Наименование и индекс места приема
// 			$list31['type_mailCtg'], //Категория почтового отправления
// 			$list31['sender_inn'], //ИНН
// 			$list31['sender_kpp'], //КПП
// 			$list31['sender_contract'], //Договор номер
// 			$list31['sender_transType'], //Способ пересылки почтовых отправления
// 			$list31['sender_date'], //Дата формирования отчета
// 			$list31['declaredValueFix'], //Фиксированная объявленная ценность
// 			$list31['weight_product'], //Вес единицы товара в граммах
// 			$list31['weight_package'], //Вес упаковки в граммах
// 			$list31['weight_custom'], //Вес товара вручную в граммах
// 			$list31['check_opis_region'], //Регион отправки, используется для расчета стоимости описи
// 			$list31['check_opis_fixedValue'], //Фиксированная стоимость описи в вашем отделении
// 			$list31['check_opis_fixedValueNDS'], //Фиксированная стоимость описи в вашем отделении (С НДС)
// 			$list31['notice_type'], //Тип уведомления
// 			$list31['sms_phone'], //Номер телефона для SMS-уведомлений
// 			$list31['comment_select'], //Выводить текст в столбец "Примечание"
// 			$list31['comment_text'], //Текст в столбец "Примечание"
// 			$list31['rtm_version'], //Версия РТМ
// 			$list31['list_number'], //Уникальный номер списка партионной почты в день сдачи списка
// 			$list31['weight'], //Выводить вес со склада и считать тариф
// 			$list31['check_opis'], //Проверка соответствия вложения описи ф.107
// 			$list31['sms_notice'], //Услуга SMS-уведомление
// 			$list31['sms_ofDelivery'], //SMS-уведомление о вручении РПО
// 			$list31['sms_ops'], //SMS-уведомление о поступлении РПО в адресное ОПС
// 			$list31['list_number_user'], //Печатать уникальный номер списка партионной почты в день сдачи списка
// 			$list31['headers'], //Печатать заголовок только на первой странице
// 			$list31['name'], //Название
// 			$list31['price'] //Цена
	}
	
	//Почта России Файлы *.txt и *.ini (для реестра ПО)
	function list32() {
	
// 			$list32['from_phone'], //Телефон отправителя
// 			$list32['from_typeAddress'], //Тип адреса
// 			$list32['from_POBox'], //Номер абонентского ящика
// 			$list32['from_postIndex'], //Индекс отправителя
// 			$list32['from_region'], //Регион отправителя
// 			$list32['from_area'], //Район отправителя
// 			$list32['from_city'], //Населенный пункт отправителя
// 			$list32['from_location'], //Внутригородской элемент
// 			$list32['from_street'], //Наименование улицы отправителя
// 			$list32['from_house'], //Номер здания
// 			$list32['from_houseLetter'], //Часть здания. Литера
// 			$list32['from_houseSlash'], //Часть здания. Дробь
// 			$list32['from_houseCorpus'], //Часть здания. Корпус
// 			$list32['from_houseBuilding'], //Часть здания. Строение
// 			$list32['from_hotel'], //Название гостиницы
// 			$list32['from_hotelRoom'], //Часть здания. Номер помещения
// 			$list32['sender_numContract'], //Номер контракта (договора)
// 			$list32['sender_inn'], //ИНН отправителя
// 			$list32['sender_kpp'], //КПП отправителя
// 			$list32['sender_indexOps'], //Индекс ОПС
// 			$list32['pay_type'], //Способ и форма оплаты услуг почтовой связи
// 			$list32['sender_category'], //Категория отправителя
// 			$list32['sender_mailType'], //Вид почтового отправления
// 			$list32['sender_mailCtg'], //Категория почтового отправления
// 			$list32['sender_directCtg'], //Классификация почтового отправления
// 			$list32['sender_transType'], //Способ пересылки почтовых отправления
// 			$list32['sender_postMark'], //Отметка отправления
// 			$list32['sender_mailRank'], //Разряд почтового отправления
// 			$list32['sender_notice_sms'], //SMS-уведомление
// 			$list32['check_opis_region'], //Регион отправки, используется для расчета стоимости описи
// 			$list32['weight_product'], //Вес единицы товара в граммах
// 			$list32['weight_package'], //Вес упаковки в граммах
// 			$list32['weight_custom'], //Вес товара вручную в граммах
// 			$list32['sender_date'], //Дата формирования отчета
// 			$list32['rtm_version'], //Версия РТМ
// 			$list32['list_number'], //Уникальный номер списка партионной почты в день сдачи списка
// 			$list32['registry_weight'], //Выводить вес со склада и считать тариф
// 			$list32['name'], //Название
// 			$list32['price'] //Цена
	}
}
