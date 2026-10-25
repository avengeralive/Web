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
		
		return $max;
	}
    
	function set() {
		
	}
}
