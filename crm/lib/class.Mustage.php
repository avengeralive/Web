<?php 
namespace lib;

/**
* class.Mustage.php 
*
*Класс - библиотека с функциями для работы с шаблонизатором 
*подгружается через автоподгрузку классов
*
*
**/

class Mustage {
	
	function get($min = null, $str) {
		
		//if (!$str) 
			//$str = 'api_id:5sBrM9tE-P3HnxTBU-sm8NMlOO-86pM5flY contact:{{phone}}
			//	id:{{id}} domain:fun lvKey:123458765678910';

		//массив значений
		$max = [
			'id' 													=> '1',  												//возвращает номер заказа пользователя
			'status'  											=> $min['status'],   								//текущий статус заказа
			'date'   											=> $min['date'],    									//дата заказа в формате: 15.05.2019
			'time'   											=> $min['time'],    									//время заказа в формате: 17:47
			'datetime'   										=> $min['datetime'],    							//дата и время в формате: 2019-05-15 17:47:10
			'lastUpdate'    									=> $min['lastUpdate'],    							//статус изменен в формате: 2019-05-15 17:47:10
			'lastModify'     									=> $min['lastModify'],     						//последние изменение в формате: 2019-05-15 17:47:10
			'approvedAt'     									=> $min['approvedAt'],     						//дата и время апрува в формате: 2019-05-15 17:47:10, либо NULL, если не указана дата
			'shippedAt'     									=> $min['shippedAt'],    							//дата и время отправки в формате: 2019-05-15 17:47:10, либо NULL, если не указана дата
			'canceledAt'     									=> $min['canceledAt'],     						//дата и время отмены в формате: 2019-05-15 17:47:10, либо NULL, если не указана дата
			'buyoutAt'     									=> $min['buyoutAt'],     							//дата и время выкупа в формате: 2019-05-15 17:47:10, либо NULL, если не указана дата
			'refundedAt'     									=> $min['refundedAt'],     						//дата и время возврата в формате: 2019-05-15 17:47:10, либо NULL, если не указана дата
			'price'     										=> $min['price'],     								//цена товара
			'total'     										=> $min['total'],     								//сумма заказа
			'goods'     										=> $min['goods'],     								//данные о товарах в заказе в JSON
			'russianpostTrack'     							=> $min['russianpostTrack'],     				//номер отправления Почты России
			'russianpostTrackingIndex'      				=> $min['russianpostTrackingIndex'],     		//индекс почтового отделения последнего статуса отслеживания
			'russianpostOfficeAddress'      				=> $min['russianpostOfficeAddress'],     		//адрес почтового отделения
			'russianpostOfficePhone'      				=> $min['russianpostOfficePhone'],     		//телефон почтового отделения
			'russianpostWorkTimeToday'      				=> $min['russianpostWorkTimeToday'],     		//режим работы почтового отделения сегодня
			'russianpostWorkTimeTomorrow'      			=> $min['russianpostWorkTimeTomorrow'],     	//режим работы почтового отделения завтра
			'domain'      							     		=> $min['domain'],     								//домен, на котором пользователь совершил заказ
			'utm_source'       							   => $min['utm_source'],     						//метка utm_source
			'utm_medium'        							   => $min['utm_medium'],     						//метка utm_medium
			'utm_campaign'        						   => $min['utm_campaign'],     						//метка utm_campaign
			'utm_content'        						   => $min['utm_content'],     						//метка utm_content
			'utm_term'        							   => $min['utm_term'],     							//метка utm_term
			'translit'        							   => $min['translit'],     							//переводит сообщение на транслит (только для текстовых SMS)
			'fio'        							   		=> $min['name'],     								//возвращает значение поля ФИО
			'postIndex'        							   => $min['postIndex'], 
			'region'        							   	=> $min['region'], 
			'city'        							   		=> $min['city'], 
			'address'        							   	=> $min['address'], 
			'phone'        							   	=> $min['phone'], 
			'quantity'        							   => $min['quantity'], 
			'comment'        							   	=> $min['comment'] 
		];

		$str = str_replace("\t", "\r\n", $str); //принимает разделитель tab 
		$str = str_replace(" ", "\r\n", $str); //принимает разделитель пробел 
		$str = preg_split("/\r\n|\r|\n/", $str); //принимает разделитель перенос строки 

		$new = [];
		foreach ($str as $key) {
			$key = explode(":", $key);
			if (!empty($key[1])) {
				if (substr($key[1], -2) == '}}') {
					$key[1] = str_replace( '{{', '', $key[1] );
					$key[1] = str_replace( '}}', '', $key[1] );
					$key[1] = $max[$key[1]];
				}
				$new[$key[0]] = $key[1];
			}
		}
		
		return $new;
	}

	function getData($min = null) {
		
		//if (!$str) 
			//$str = 'api_id:5sBrM9tE-P3HnxTBU-sm8NMlOO-86pM5flY contact:{{phone}}
			//	id:{{id}} domain:fun lvKey:123458765678910';

		//массив значений
		$max = [
			'id' 													=> '1',  												//возвращает номер заказа пользователя
			'status'  											=> $min['status'],   								//текущий статус заказа
			'date'   											=> isset($min['date'])?$min['date']:null,    									//дата заказа в формате: 15.05.2019
			'time'   											=> $min['time'],    									//время заказа в формате: 17:47
			'datetime'   										=> isset($min['datetime'])?$min['datetime']:null,    							//дата и время в формате: 2019-05-15 17:47:10
			'lastUpdate'    									=> $min['lastUpdate'],    							//статус изменен в формате: 2019-05-15 17:47:10
			'lastModify'     									=> isset($min['lastModify'])?$min['lastModify']:null,     						//последние изменение в формате: 2019-05-15 17:47:10
			'approvedAt'     									=> $min['approvedAt'],     						//дата и время апрува в формате: 2019-05-15 17:47:10, либо NULL, если не указана дата
			'shippedAt'     									=> $min['shippedAt'],    							//дата и время отправки в формате: 2019-05-15 17:47:10, либо NULL, если не указана дата
			'canceledAt'     									=> $min['canceledAt'],     						//дата и время отмены в формате: 2019-05-15 17:47:10, либо NULL, если не указана дата
			'buyoutAt'     									=> $min['buyoutAt'],     							//дата и время выкупа в формате: 2019-05-15 17:47:10, либо NULL, если не указана дата
			'refundedAt'     									=> $min['refundedAt'],     						//дата и время возврата в формате: 2019-05-15 17:47:10, либо NULL, если не указана дата
			'price'     										=> $min['price'],     								//цена товара
			'total'     										=> $min['total'],     								//сумма заказа
			'goods'     										=> isset($min['goods'])?$min['goods']:null,     								//данные о товарах в заказе в JSON
			'russianpostTrack'     							=> $min['russianpostTrack'],     				//номер отправления Почты России
			'russianpostTrackingIndex'      				=> isset($min['russianpostTrackingIndex'])?$min['russianpostTrackingIndex']:null,     		//индекс почтового отделения последнего статуса отслеживания
			'russianpostOfficeAddress'      				=> isset($min['russianpostOfficeAddress'])?$min['russianpostOfficeAddress']:null,     		//адрес почтового отделения
			'russianpostOfficePhone'      				=> isset($min['russianpostOfficePhone'])?$min['russianpostOfficePhone']:null,     		//телефон почтового отделения
			'russianpostWorkTimeToday'      				=> isset($min['russianpostWorkTimeToday'])?$min['russianpostWorkTimeToday']:null,     		//режим работы почтового отделения сегодня
			'russianpostWorkTimeTomorrow'      			=> isset($min['russianpostWorkTimeTomorrow'])?$min['russianpostWorkTimeTomorrow']:null,     	//режим работы почтового отделения завтра
			'domain'      							     		=> $min['domain'],     								//домен, на котором пользователь совершил заказ
			'utm_source'       							   => $min['utm_source'],     						//метка utm_source
			'utm_medium'        							   => $min['utm_medium'],     						//метка utm_medium
			'utm_campaign'        						   => $min['utm_campaign'],     						//метка utm_campaign
			'utm_content'        						   => $min['utm_content'],     						//метка utm_content
			'utm_term'        							   => $min['utm_term'],     							//метка utm_term
			'translit'        							   => isset($min['translit'])?$min['translit']:null,     							//переводит сообщение на транслит (только для текстовых SMS)
			'fio'        							   		=> $min['name'],     								//возвращает значение поля ФИО
			'postIndex'        							   => $min['postIndex'], 
			'region'        							   	=> $min['region'], 
			'city'        							   		=> $min['city'], 
			'address'        							   	=> $min['address'], 
			'phone'        							   	=> $min['phone'], 
			'quantity'        							   => isset($min['quantity'])?$min['quantity']:null, 
			'comment'        							   	=> $min['comment'] 
		];
		
		return $max;
	}
	
    
	function statuses($status = null, $id = null) {
		$item = [];
		$Result = JBase::Get_Data('list8', '*', ['id' => (int)$status]);			
		if (!empty($Result) && (int)$status != 0 && (int)$id != 0) {
			while ($items = $Result->fetch_assoc()) 
				$item = $items;	
		
// 				$item['statusgroup'];						//list_id
// 				$item['hideDataFromWebmaster'];			//Скрывать данные заказа от веб-мастера звездочками в этом статусе
// 				$item['hoursToChange'];						//Через
// 				$item['statusToChange'];					//изменить статус на
// 				$item['alwaysSendAutoSms'];				//Всегда отсылать авто SMS
// 				$item['smsTemplateID'];						//Автоматически отправлять текстовое SMS при попадании заказа в этот статус*
// 				$item['voiceSmsTemplateID'];				//Автоматически отправлять голосовое SMS при попадании заказа в этот статус

// 				$item['ifRpStatus1'];						//Если
// 				$item['ifRpStatus2'];						//Если
// 				$item['ifRpStatus3'];						//Если
// 				$item['ifRpStatus4'];						//Если
// 				$item['thenRpStatus1'];						//то изменить статус на
// 				$item['thenRpStatus2'];						//то изменить статус на
// 				$item['thenRpStatus3'];						//то изменить статус на
// 				$item['thenRpStatus4'];						//то изменить статус на
// 				$item['goodsQuantity'];						//Действия с количеством товара
// 				$item['callmodeGroup'];						//Режим прозвона

// 				$item['sortByLastStatusChange'];			//Сортировка
// 				$item['container'];							//Контейнер
			
			//>>>>>>>>>>>>>>>>>>>>>>>>> Если-то
			$ifTo = array_filter([
				$item['ifRpStatus1'] => $item['thenRpStatus1'],
				$item['ifRpStatus2'] => $item['thenRpStatus2'],
				$item['ifRpStatus3'] => $item['thenRpStatus3'],
				$item['ifRpStatus4'] => $item['thenRpStatus4']
			]);
			
			$RpStatus = 0;
			if (!empty($ifTo)) {
				//узнаем статус посылки у почты россии
				$RpStatus = RussianPosts::start($id);
				foreach ($ifTo as $key => $value) {
					if ($key == $RpStatus) switch ($RpStatus) {
						case 1:	//Прибыло в место вручения, Неудачная попытка вручения, Передано почтальону, Хранение - До востребования
							JBase::statusChange((int)$item['statusgroup'], $id, (int)$value);
						break;
						case 2:	//Возврат
							JBase::statusChange((int)$item['statusgroup'], $id, (int)$value);
						break;
						case 3:	//Вручение адресату, Адресату с контролем ответа, Адресату почтальоном, Адресату курьером
							JBase::statusChange((int)$item['statusgroup'], $id, (int)$value);
						break;
						case 4:	//Вручение отправителю
							JBase::statusChange((int)$item['statusgroup'], $id, (int)$value);
						break;
						case 5:	//TEST
							
						break;
						
					}
				}
			}
			
			//>>>>>>>>>>>>>>>>>>>>>>>>> SMS
			
			
			
			
			switch ($status) {
				case 1:	//Обработка
					//liveinform запрос на проверку на возвраты
// 					$res = json_decode(self::sendPost($url, [
// 						'api_id' 			=> $api_id,
// 						'liveinform_id' 	=> (int)$post['liveinform_id'] //332633005
// 					]), true);
				break;
				case 2:	//НДЗ-Звонит Робот
					
				break;
				case 33:	//Завести трек - ///////выгрузка в почту с массой 1г
					
				break;
				case 5:	//Отправлен по РФ - ///liveinform - получение liveinform_id
					$res = json_decode(self::sendPost($url, [
						'api_id' 			=> $api_id,
						'liveinform_id' 	=> (int)$post['liveinform_id'], //332633005
						'phone' 				=> $post['phone'], //Телефон клиента в международном формате
						'tracking' 			=> $post['tracking'], //Трек-номер заказа
						'order_id' 			=> $post['order_id'], //Номер заказа внутри вашего магазина
						'email' 				=> $post['email'],
						'firstname' 		=> $post['firstname'],
						'lastname' 			=> $post['lastname'],
						'tags' 				=> $post['tags'],
						'additional1' 		=> $post['additional1'],
						'additional2' 		=> $post['additional2'],
						'additional3' 		=> $post['additional3'],
						//'index' 				=> $post['index'], //Индекс получателя (необходимо только для Белпочты)
						'price' 				=> $post['price'],
						'comment' 			=> $post['comment'] //Примечание к заказу
					]), true);
				break;
				case 3:	//ОКК
				case 4:	//Отменен
				case 6:	//Спам/ошибки/Консультация
				case 7:	//Оплачен
				case 8:	//Дубль
				case 9:	//Возврат
				case 10:	//Переданы на склад
				case 28:	//Думает/набрать позже
				case 30:	//Фрод
				case 32:	//Жалобы на конкурентов
				case 73:	//Оплачен [Забран]
				case 74:	//Оплачен [Потерян]
				case 75:	//Оплачен [Претензия]
				case 54:	//Запасной
				case 48:	//Промежуточный
				break;
				
				case 12:	//День 1
				case 13:	//День 2
				case 14:	//День 3
				case 15:	//День 4
				case 16:	//День 5
				case 17:	//День 6
				case 18:	//День 7
				case 19:	//День 8
				case 20:	//День 9
				case 21:	//День 10
				case 22:	//День 11
				case 23:	//День 12
				case 24:	//День 13
				case 25:	//День 14
				case 26:	//День 15
				case 27:	//День >15
				break;
				case 58:	//Оплачен 1 день
				case 59:	//Оплачен 2 день
				case 60:	//Оплачен 3 день
				case 61:	//Оплачен 4 день
				case 62:	//Оплачен 5 день
				case 63:	//Оплачен 6 день
				case 64:	//Оплачен 7 день
				case 65:	//Оплачен 8 день
				case 66:	//Оплачен 9 день
				case 67:	//Оплачен 10 день
				case 68:	//Оплачен 11 день
				case 69:	//Оплачен 12 день
				case 70:	//Оплачен 13 день
				case 71:	//Оплачен 14 день
				case 72:	//Оплачен 15 день
				break;
				case 34:	//День 4 [Дозвон]
				case 35:	//День 5 [Дозвон]
				case 36:	//День 6 [Дозвон]
				case 37:	//День 7 [Дозвон]
				case 38:	//День 8 [Дозвон]
				case 39:	//День 9 [Дозвон]
				case 40:	//День 10 [Дозвон]
				case 41:	//День 11 [Дозвон]
				case 42:	//День 12 [Дозвон]
				case 43:	//День 13 [Дозвон]
				case 44:	//День 14 [Дозвон]
				case 45:	//День 15 [Дозвон]
				case 46:	//День >15 [Дозвон]
					//
				break;
				case 29:	//Подтвержден [2 прозвон]
				case 31:	//Подтверждена отправка
				case 47:	//Уехали на почту
				case 49:	//Подтверждена отправка {Онлайн}
				case 50:	//Переданы на склад {Онлайн}п
				case 51:	//Уехали на почту {Онлайн}п
				case 52:	//Переданы на склад {Онлайн}w
				case 53:	//Уехали на почту {Онлайн}w
				case 11:	//Пришло на почту сегодня
				break;
				case 55:	//Распечатать накладные {Н}
				case 56:	//Распечатать накладные {Онлайн}
				case 57:	//Завести в почту {Онлайн} - 
				break;
			}
		}
	}
}
