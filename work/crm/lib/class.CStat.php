<?php 
namespace lib;
if (!defined('VOCU_FWK')) die(); // не работает без нашего фреймверка

/**
* class.CStat.php
*
* Библиотека с функциями для работы модуля e-mail рассылок
* подгружается через автоподгрузку классов
*
* История: 07.07.2017 - файл создан
*
**/


class CStat {
	
	//Счет объектов
	function week_count() {
		$time = time() - 604800; //1 week
		$Result = JBase::Query("SELECT 
			(SELECT COUNT(*) FROM `list1` WHERE `FlatRoomsCount` = '1'  AND  `domain` = '".DOMAIN."')AS one,
			(SELECT COUNT(*) FROM `list1` WHERE `FlatRoomsCount` = '2'  AND  `domain` = '".DOMAIN."')AS two,
			(SELECT COUNT(*) FROM `list1` WHERE `FlatRoomsCount` = '3'  AND  `domain` = '".DOMAIN."')AS three,
			(SELECT COUNT(*) FROM `list1` WHERE `FlatRoomsCount` = '4'  AND  `domain` = '".DOMAIN."')AS four,
			(SELECT COUNT(*) FROM `list1` WHERE `FlatRoomsCount` = '1'  AND `time` > '". $time ."' AND `domain` = '".DOMAIN."')AS oneweek,
			(SELECT COUNT(*) FROM `list1` WHERE `FlatRoomsCount` = '2'  AND `time` > '". $time ."' AND `domain` = '".DOMAIN."')AS twoweek,
			(SELECT COUNT(*) FROM `list1` WHERE `FlatRoomsCount` = '3'  AND `time` > '". $time ."' AND `domain` = '".DOMAIN."')AS threeweek,
			(SELECT COUNT(*) FROM `list1` WHERE `FlatRoomsCount` = '4'  AND `time` > '". $time ."' AND `domain` = '".DOMAIN."')AS fourweek");
		
		if (!empty($Result)){
			$items = [];
			while ($item = $Result->fetch_assoc()){
				$items = $item;
			}	
			return $items;	
		}
	}
	//количество пользователей по группам
	function call_count() {
		$Result = JBase::Query("SELECT	
			(SELECT COUNT(*) FROM `my_users` WHERE `usertype` = '1'  AND  `domain` = '".DOMAIN."') AS admin,
			(SELECT COUNT(*) FROM `my_users` WHERE `usertype` = '2'  AND  `domain` = '".DOMAIN."') AS user,
			(SELECT COUNT(*) FROM `my_users` WHERE `usertype` = '3'  AND  `domain` = '".DOMAIN."') AS company,
			(SELECT COUNT(*) FROM `my_users` WHERE `usertype` = '4'  AND  `domain` = '".DOMAIN."') AS moder,
			(SELECT COUNT(*) FROM `my_users` WHERE DAYOFYEAR(from_unixtime(`registerDate`)) = DAYOFYEAR(DATE(NOW()))  AND  `domain` = '".DOMAIN."' ) AS today");
			
		if (!empty($Result)) {
			$items = [];
			while ($item = $Result->fetch_assoc()){
				$items = $item;
			}	
			return $items;		
		}
	}
    //последних 10 авторизованных
	function call_ten_authorize() {
        $Result = JBase::Query( "SELECT my_users.id, 
        								my_users.name, 
        								my_users.username, 
        								session_users.time, 
        								session_users.user_id
        						 FROM `my_users`, `session_users` 
        						 WHERE my_users.id = session_users.user_id
        						 AND  my_users.domain = '".DOMAIN."'
        						 ORDER BY time DESC
        						 LIMIT 10");			
        if (!empty($Result)) {
			$items = [];
			while ($item = $Result->fetch_assoc()) 
				$items[] = $item;
			return $items;
		}
    }    
	//последних 10 зарегистрированных
	function call_ten_registr() {
        $Result = JBase::Query( "SELECT my_users.id, 
        								my_users.name, 
        								my_users.usertype, 
        								my_users.username, 
        								my_users.registerDate,
        								my_users_group.id,
        								my_users_group.name
        						 FROM `my_users`, `my_users_group`
        						 WHERE my_users.usertype = my_users_group.id
        						 AND  my_users.domain = '".DOMAIN."'
        						 ORDER BY my_users.id DESC
        						 LIMIT 10");
        						
        if (!empty($Result)) {
			$items = [];
			while ($item = $Result->fetch_assoc()) 
				$items[] = $item;
			return $items;
		}
    } 	
	//узнаем размер папки на сервере
	function what_size() {

    	//функция для просмотра всех подпапок и всех вложенных файлов
    	function dir_size($path) {
		    $fileSize = 0;
		    $dir = scandir($path);
			//var_dump($dir);
		    foreach($dir as $file) {
    	    if (($file!='.') && ($file!='..'))
    	        if(is_dir($path . '/' . $file))
    	            $fileSize += dir_size($path . '/' . $file);
    	        else
    	            $fileSize += filesize($path . '/' . $file);
    	    }
    		return $fileSize;
		}
	
	    //функция форматирует вывод размера
	    function format_size($size){
	         $metrics[0] = 'байт';
	         $metrics[1] = 'Кбайт';
	         $metrics[2] = 'Мбайт';
	         $metrics[3] = 'Гбайт';
	         $metrics[4] = 'Тбайт';
	         $metric = 0;         
	         while(floor($size/1024) > 0){
	             ++$metric;
	             $size /= 1024;
	         }  
	         $ret = [];   
	         $ret[0] =  round($size,1);
	         $ret[1] = isset($metrics[$metric])?$metrics[$metric]:'??';
	         //$ret =  round($size,1)." ".(isset($metrics[$metric])?$metrics[$metric]:'??');
	        return $ret;
	    }
	
		$path = JLoads::$DIRHOME. '/cdn/'.DOMAIN.''; // указываем полный путь до папки или файла 
		$size = dir_size($path); //заносим в переменную размер папки или файла
		$formSize = format_size($size); //форматируем вывод
		return $formSize;
	} 
	//статистика по каталогам	
    function catalogue_stat() {

		$count = [];
		$list_table = [];
		$Result = JBase::Query("SELECT `domain_id`, `title` FROM `list_table` WHERE `domain` = 'moscow' GROUP BY `id` ORDER BY `id`");
		while ($item = $Result->fetch_assoc()) 
			$list_table[] = $item;
			
		foreach($list_table as $key => $value) {
			$count[$value['domain_id']]['id'] = $value['domain_id'];
			$count[$value['domain_id']]['title'] = $value['title'];			


			$Result = JBase::Query("SELECT (SELECT COUNT(*) FROM `list". $value['domain_id'] ."`  WHERE  `domain` = '".DOMAIN."') AS count,
						(SELECT COUNT(*) FROM `list". $value['domain_id'] ."` WHERE `status` = '1' AND  `domain` = '".DOMAIN."' ) AS active,
						(SELECT COUNT(*) FROM `list". $value['domain_id'] ."` WHERE `status` = '2' AND  `domain` = '".DOMAIN."' ) AS moder,
						(SELECT DATE_FORMAT(from_unixtime(`time`),'%d.%m.%y') FROM `list". $value['domain_id'] ."` WHERE  `domain` = '".DOMAIN."' ORDER BY `time` DESC LIMIT 1) AS last,
						(SELECT COUNT(*) FROM `list". $value['domain_id'] ."` WHERE DATE_FORMAT(from_unixtime(`time`),'%d.%m.%y') = DATE_FORMAT(DATE(NOW()),'%d.%m.%y') AND  `domain` = '".DOMAIN."' ) AS today");
								   						
			if (!empty($Result)) {				
				while ($item = $Result->fetch_assoc()) {
					$count[$value['domain_id']]['count'] = $item['count'];			
					$count[$value['domain_id']]['active'] = $item['active'];			
					$count[$value['domain_id']]['moder'] = $item['moder'];			
					$count[$value['domain_id']]['last'] = $item['last'];			
					$count[$value['domain_id']]['today'] = $item['today'];	
				}
			}
		}		
   		return $count; 
    }	
	
	
	
	
	//Количество новых объектов - сделать на list1 - list16
	function objects() {
 		$response = [];
		$Result = JBase::Query("SELECT
  MONTH(d_yearmonth) as m,
  YEAR(d_yearmonth) AS y,
  MONTHNAME(d_yearmonth) AS n,
  base,
  status1,
  status2,
  domain,
  nodomain,
  percent
FROM (
  SELECT
    LAST_DAY(FROM_UNIXTIME(a.time)) as d_yearmonth,
    COUNT(a.page != '' AND a.domain = '". DOMAIN ."' OR NULL) AS base,
    COUNT(a.status = '1' AND a.domain = '". DOMAIN ."' OR NULL) AS status1,
    COUNT(a.status = '2' AND a.domain = '". DOMAIN ."' OR NULL) AS status2,
    COUNT(a.domain = '". DOMAIN ."' OR NULL) AS domain,
    COUNT(NULLIF(a.domain, '". DOMAIN ."'))  AS nodomain,
    round((COUNT(a.domain = '". DOMAIN ."' OR NULL)/COUNT(NULLIF(a.domain, '". DOMAIN ."')) * 100 ),2) AS percent
  FROM list1 AS a
  GROUP BY
    d_yearmonth
) AS s
ORDER BY
  y DESC,
  MONTH(d_yearmonth) DESC
LIMIT 12;");

		if (!empty($Result)) {
			while ($item = $Result->fetch_assoc()){
				$response['year'][$item['m']] = $item;
			}
		}
		
$Result2 = JBase::Query("SELECT count(*) as c,  
DATE_FORMAT(from_unixtime(list1.time), '%d') as d,

COUNT(list1.status = '1' AND list1.domain = '". DOMAIN ."' OR NULL) AS status1,
COUNT(list1.status = '2' AND list1.domain = '". DOMAIN ."' OR NULL) AS status2, 

COUNT(list1.page != '' AND list1.domain = '". DOMAIN ."' OR NULL) AS base,
COUNT(list1.domain = '". DOMAIN ."' OR NULL) AS domain

FROM  list1

where DATE_FORMAT(from_unixtime(list1.time), '%Y-%m') = date_format(DATE_SUB(curdate(), INTERVAL 1 month),'%Y-%m')
AND list1.domain='". DOMAIN ."' 

GROUP BY DAYOFYEAR(from_unixtime(list1.time)), Month(FROM_UNIXTIME(list1.time))
ORDER BY list1.time ASC");
  
		if (!empty($Result2)) {
			while ($item = $Result2->fetch_assoc()){
				$response['days'][(int)$item['d']] = $item['c'];
				$response['base'][(int)$item['d']] = $item['base'];
				$response['status1'][(int)$item['d']] = $item['status1'];
				$response['status2'][(int)$item['d']] = $item['status2'];
			}
		}
		
		$days = ['1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30'];
		$newdays = array_fill_keys($days, '0');
		
		$response['base'] = array_values(array_replace($newdays, $response['base']));
		$response['days'] = array_values(array_replace($newdays, $response['days']));
		$response['status1'] = array_values(array_replace($newdays, $response['status1']));
		$response['status2'] = array_values(array_replace($newdays, $response['status2']));
		//$combined = array_map(function($a, $b) { return (int)$a + (int)$b; }, $a1, $a2));
		
// 		$lists = ['1','2','3','4','5','6','7','8','9','10','11','12','13','14','15'];
// 		$items = [];
// 		foreach ($lists as $list) {
// 			$Result = JBase::Query("SELECT DATE_FORMAT(from_unixtime(list".$list.".time), '%d') as k, count(*) as value FROM list".$list."
// 				where DATE_FORMAT(from_unixtime(list".$list.".time), '%Y-%m') = date_format(DATE_SUB(curdate(), INTERVAL 1 month),'%Y-%m')
// 				AND list".$list.".domain='". DOMAIN ."' 
// 				GROUP BY DAYOFYEAR(from_unixtime(list".$list.".time)), Month(FROM_UNIXTIME(list".$list.".time))
// 				ORDER BY list".$list.".time ASC");
// 			
// 			if (!empty($Result)) {
// 				while ($item = $Result->fetch_assoc()){
// 					$items[$list][(int)$item['k']] = $item['value'];
// 				}	
// 			}
// 			
// 			$days = ['1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30'];
// 			$newdays = array_fill_keys($days, '0');
// 			$items[$list] = array_values(array_replace($newdays, $items[$list]));
// 			
// 		}
// 		$response['lists'] = $items;	
		
		
		
		return $response;
	}
	//Количество новых объектов - сделать на list1 - list16 копия
	function call1() {
 		$res1 = [];
 		$res2 = [];
 		$res3 = [];
 		$items = [];
 		$response = [];
		$Result = JBase::Query("SELECT `time` FROM list1 WHERE DAYOFYEAR(from_unixtime(`time`)) 
			BETWEEN (DAYOFYEAR(NOW()- INTERVAL 30 DAY)) AND DAYOFYEAR(DATE(NOW())) ORDER BY `time` ASC");
		if (!empty($Result)) {
			$day = date('z') - 30;
			while ($item = $Result->fetch_array()){
				$items['time'][] = $item['time'];
			}
 			$i = 0;
 			$last = 0;
 			$count = 0;
 			foreach($items['time'] as $a) {	
 				if (getdate($a)['yday'] == $day){
 					$count++;	
 					$last = getdate($a)['yday'];
 				} else {
 					if ($count != 0) {
 						$res1[$i] = $count;
 						$i++;
 					}			
 					if ($last == 0) {
 						$res1[$i] = 0;
						$i++;
					}
 					$last = getdate($a)['yday'];
 					if ($last == ++$day){ 
 						$count = 1;
 					} else {
 						while ($day !== $last) {	
 							if ($i > 31) break;
 							$day++; 	
 							$res1[$i] = 0;
							$i++;	
 						}	
 						$count = 1;
 					}	
 				}
 				if ($i > 31) break;
 			
 			}	
		}
		$response[1] = $res1;
		//$response[2] = $res2;
		//$response[3] = $res3;
		return $response;
	}
	
	//по категориям
	function toCategory() {
		$response = [];
		$lists = ['1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16'];
		$items = [];
		foreach ($lists as $list) {
			$Result = JBase::Query("SELECT DATE_FORMAT(from_unixtime(list".$list.".time), '%d') as k, count(*) as value FROM list".$list."
				where DATE_FORMAT(from_unixtime(list".$list.".time), '%Y-%m') = date_format(DATE_SUB(curdate(), INTERVAL 1 month),'%Y-%m')
				AND list".$list.".domain='". DOMAIN ."' 
				GROUP BY DAYOFYEAR(from_unixtime(list".$list.".time)), Month(FROM_UNIXTIME(list".$list.".time))
				ORDER BY list".$list.".time ASC");
			
			if (!empty($Result)) {
				while ($item = $Result->fetch_assoc()){
					$items[$list][(int)$item['k']] = $item['value'];
				}	
			}
			
			$days = ['1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30'];
			$newdays = array_fill_keys($days, '0');
			$tmp = array_values(array_replace($newdays, $items[$list]));
			
			if (!empty($tmp)) $items[$list] = $tmp;
		}	
		
		
		$response = $items;
		return json_encode($response);
	}
	
	
	
	
	//запрашиваем данные для построения графиков посещаемости
	function call_stat() {
		$Result = JBase::Query("	 									
									SELECT `registerDate` 
									FROM `my_users` 	
									WHERE DAYOFYEAR(from_unixtime(`registerDate`)) 
									BETWEEN (DAYOFYEAR(NOW()- INTERVAL 30 DAY))  
									AND DAYOFYEAR(DATE(NOW()))  
        						 	AND  `domain` = '".DOMAIN."' 
									ORDER BY `registerDate` ASC
									
								");
	    if (!empty($Result)){
			$items = [];
			while ($item = $Result->fetch_array()){
				$items[] = $item[0];
			}
			$day = date('z') - 30;
			$res = array();
 			$i = 0;
 			$a = ' ';
 			$count = 0;
 			$last = 0;
 			foreach( $items as $a){	
 				if (getdate($a)['yday'] == $day){
 						$count++;	
 						$last = getdate($a)['yday'];
 					}
 					else{
 						if ($count!= 0) {
 							$res[$i] = $count;
 							$i++;
 						}			
 						if ($last == 0) {
 							$res[$i] = 0;
							$i++; 	
							
 						}
 						$last = getdate($a)['yday'];
 						
 						if ($last == $day){ 
 							$count = 1;
 							$day++;
 						}
 						else{
 						
 							while ($day !== $last)
 							{	if ($i > 31) break;
 								$day++; 	
 								$res[$i] = 0;
								$i++;
								
 							}	
 						$count = 1;
 						}	
 						
 					}
 					if ($i > 31) break;
 				}
 				
				
			}	
		$res[$i] = $count;
		$Result->free_result(); 
		$Result = JBase::Query("	 									
									SELECT 		`time` 
									FROM `session_users` 	
									WHERE
									DAYOFYEAR(from_unixtime(`time`)) 
									BETWEEN (DAYOFYEAR(NOW()- INTERVAL 30 DAY))  
									AND DAYOFYEAR(DATE(NOW())) 
        						 	AND  `domain` = '".DOMAIN."' 
									ORDER BY `time` ASC
									
								");
		if (!empty($Result)){
				$items = [];
				$day = date('z') - 30;
				while ($item = $Result->fetch_array()){
					$items[] = $item[0];
				}
				$item = [];
				$item[0] = $res;
				$res = array();
 				$i = 0;
 				$a = ' ';
 				$count = 0;
 				$last = 0;
 				foreach( $items as $a){	
 					if (getdate($a)['yday'] == $day){
 						$count++;	
 						$last = getdate($a)['yday'];
 					}
 					else{
 						if ($count!= 0) {
 							$res[$i] = $count;
 							$i++;
 						}			
 						if ($last == 0) {
 							$res[$i] = 0;
							$i++; 	
							
 						}
 						$last = getdate($a)['yday'];
 						if ($last == ++$day){ 
 							$count = 1;
 						}
 						else{
 						
 							while ($day !== $last)
 							{	
 								if ($i > 31) break;
 								$day++; 	
 								$res[$i] = 0;
								$i++;
								
 							}	
 						$count = 1;
 						}	
 						
 					}
 					if ($i > 31) break;
 				}
				
			}	
				
		$res[$i] = $count;
		$item[1] = $res;
			
			
		return $item;
	}
	
}

