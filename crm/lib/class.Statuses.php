<?php 
namespace lib;

use PhpMyAdmin\SqlParser\Utils\Query;

/**
* class.Mustage.php 
*
*Класс - библиотека с функциями для работы с шаблонизатором 
*подгружается через автоподгрузку классов
*
*
**/

class Statuses {

	function get($status = null, $id = null) {

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
	
	//тяжело
	public static function Get_All_Count() {
		$res = [];
		$Result = JBase::Get_Data('list8', ['id', 'statusgroup'], ['status' => '1']);
		if ($Result) while( $g = $Result->fetch_assoc() ) {
			$res[$g['id']] = $g['statusgroup'];
		}
		if (!empty($res)) foreach ($res as $key => $value) {
			self::Update_Data('list8', ['count' => self::Get_Count('list'. $value, $key)], ['id' => $key]);
		}
		return $res;
	}

// Бот берет заказы из обработки со статусом 777 и перекладывает в подтвержденные

	function From_Processing_To_Confirmation() {
		$Result = JBase::Get_Data('list17', '*', ['status' => '777']);
		while ($Value = $Result->fetch_assoc()) {
			$QQ = "INSERT INTO `list18` (`id`, `domain`, `id_user`, `premium`, `page`, `status`, `time`, `timeupdate`, `lastUpdate`, `price`, `total`, `agree_terms`, `agree_personal`, `geo`, `name`, `goods_names`, `domain2`, `approvedAt`, `shippedAt`, `canceledAt`, `buyoutAt`, `refundedAt`, `comment`, `log_robot`, `all`, `time_call`, `attempts`, `liveinform`, `russianpostTrack`, `russianpostStatus`, `count`, `postIndex`, `region`, `city`, `address`, `house`, `flat`, `phone`, `email`, `category`, `lastSms`, `smsStatus`, `lastVoiceSms`, `lastVoiceStatus`, `liveinformId`, `size`, `completely`, `weight`, `tag`, `source`, `ip`, `referrer`, `expend`, `externalId`, `webmasterId`, `dop1`, `dop2`, `dop3`, `dop4`, `dop5`, `dop6`, `dop7`, `dop8`, `dop9`, `dop10`, `timezone`, `allBuyPrice`, `developerPrice`, `utm_source`, `utm_medium`, `utm_campaign`, `utm_term`, `utm_content`, `operator`, `sms_template`, `scriptManager`, `statustime`, `lvproject`, `lvid`, `robot`, `timeSpent`, `callmodeRecallAt`, `currentSms`) VALUES ($Value[id],'$Value[domain]',$Value[id_user],$Value[premium],'$Value[page]',31,$Value[time],$Value[timeupdate],$Value[lastUpdate],$Value[price],$Value[total],$Value[agree_terms],$Value[agree_personal],'$Value[geo]','$Value[name]','$Value[goods_names]','$Value[domain2]','$Value[approvedAt]','$Value[shippedAt]','$Value[canceledAt]','$Value[buyoutAt]','$Value[refundedAt]','$Value[comment]','$Value[log_robot]','$Value[all]','$Value[time_call]','$Value[attempts]','$Value[liveinform]','$Value[russianpostTrack]','$Value[russianpostStatus]','$Value[count]','$Value[postIndex]','$Value[region]','$Value[city]','$Value[address]','$Value[house]','$Value[flat]','$Value[phone]','$Value[email]','$Value[category]','$Value[lastSms]','$Value[smsStatus]','$Value[lastVoiceSms]','$Value[lastVoiceStatus]','$Value[liveinformId]','$Value[size]','$Value[completely]','$Value[weight]','$Value[tag]','$Value[source]','$Value[ip]','$Value[referrer]','$Value[expend]','$Value[externalId]','$Value[webmasterId]','$Value[dop1]','$Value[dop2]','$Value[dop3]','$Value[dop4]','$Value[dop5]','$Value[dop6]','$Value[dop7]','$Value[dop8]','$Value[dop9]','$Value[dop10]','$Value[timezone]','$Value[allBuyPrice]','$Value[developerPrice]','$Value[utm_source]','$Value[utm_medium]','$Value[utm_campaign]','$Value[utm_term]','$Value[utm_content]',$Value[operator],$Value[sms_template],'$Value[scriptManager]',$Value[statustime],'$Value[lvproject]',$Value[lvid],'$Value[robot]','$Value[timeSpent]','$Value[callmodeRecallAt]','$Value[currentSms]')";
			$db_good = JBase::Query($QQ);
			if($db_good){
				$QQ2 = "DELETE FROM `list17` WHERE `id` = $Value[id]";
				JBase::Query($QQ2);
			}
		}
	}
		
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
	
	
	
// 	
// 	UPDATE customers 
// SET 
//     salesRepEmployeeNumber = (SELECT 
//             employeeNumber
//         FROM
//             employees
//         WHERE
//             jobtitle = 'Sales Rep'
//         ORDER BY RAND()
//         LIMIT 1)
// WHERE
//     salesRepEmployeeNumber IS NULL;
//     

   
	//Перемещать заказ в другой статус по истечению заданного периода
	//запускается 1 раз в час
	function listChangeTime() {
	
		//status
		$st = [];
		$Result1 = JBase::Get_Data('list8', '*', ['status' => '1']);
		if ($Result1) while( $s = $Result1->fetch_assoc() ) {
			$st[$s['id']] = $s;
		}
		
		foreach ([17,18,19,20] as $list) {
			$Result3 = JBase::Query("SELECT id, status, ((UNIX_TIMESTAMP(now()) - statustime) / 60 / 60) as statustime FROM list$list where statustime > 0");
			if ($Result3) while( $p = $Result3->fetch_assoc() ) {
				if(!empty($st[$p['status']]['statusToChange']) && $st[$p['status']]['statusToChange'] != 0) {
					if ((int)$p['statustime'] > (int)$st[$p['status']]['hoursToChange'] && $st[$p['status']]['statusToChange'] > 0) {
						JBase::statusChange($list, (array)$p['id'], $st[$p['status']]['statusToChange']);
					}
				}
			}
		}
	} 
    
	//Отправка sms при попадании в статус
	function listChangeSms($status = null, $id = null) {
		
		if (!$id) return false;
		if (!$status) return false;

		//status
		$st = [];
		$Result1 = JBase::Get_Data('list8', '*', ['id' => $status]);
		if ($Result1) {
			while( $s = $Result1->fetch_assoc() ) {
				$st[$s['id']] = $s;
			}
			
			//id
			$res = [];
			$Result2 = JBase::Get_Data('list'. $st[$status]['statusgroup'], '*', ['id' => $id]);
			if ($Result2) {
				while( $r = $Result2->fetch_assoc() ) {
					$res[$r['id']] = $r;
				}
				
				//Автоматически отправлять SMS при попадании заказа в этот статус
				if ($st[$status]['alwaysSendAutoSms'] > 0 && $st[$status]['smsTemplateID'] > 0) 
					SMS::sendSMS($st[$status]['statusgroup'], $id, $st[$status]['smsTemplateID']);
			}
		}
	}

	//Возврат
// 	function list15($status = null, $id = null) {
// 
// 		$item = [];
// 		$Result = JBase::Get_Data('list15', '*', ['id' => (int)$status]);
// 	}
	//Отменен
// 	function list16($status = null, $id = null) {
// 
// 		$item = [];
// 		$Result = JBase::Get_Data('list16', '*', ['id' => (int)$status]);
// 	}
	//Обработка
// 	function list17($status = null, $id = null) {
// 
// 		$item = [];
// 		$Result = JBase::Get_Data('list17', '*', ['id' => (int)$status]);
// 	}
	//Принят
// 	function list18($status = null, $id = null) {
// 
// 		$item = [];
// 		$Result = JBase::Get_Data('list18', '*', ['id' => (int)$status]);
// 	}
	//Отправлен
// 	function list19($status = null, $id = null) {
// 
// 		$item = [];
// 		$Result = JBase::Get_Data('list19', '*', ['id' => (int)$status]);
// 	}
	//Оплачен
// 	function list20($status = null, $id = null) {
// 
// 		//Автоматически отправлять SMS при попадании заказа в этот статус
// 		//Перемещать заказ в другой статус по истечению заданного периода
// 		//Перемещать заказ в другой статус по статусу почты России
// 		//Действия со складом
// 		//Режим прозвона
// 		
// 		$item = [];
// 		$Result = JBase::Get_Data('list20', '*', ['id' => (int)$status]);
// 	}
		
}
