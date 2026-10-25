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
			(SELECT COUNT(*) FROM `my_users` WHERE `usertype` = '1'  AND  `domain` = '".DOMAIN."') AS one,
			(SELECT COUNT(*) FROM `my_users` WHERE `usertype` = '2'  AND  `domain` = '".DOMAIN."') AS two,
			(SELECT COUNT(*) FROM `my_users` WHERE `usertype` = '3'  AND  `domain` = '".DOMAIN."') AS three,
			(SELECT COUNT(*) FROM `my_users` WHERE `usertype` = '4'  AND  `domain` = '".DOMAIN."') AS four,
			(SELECT COUNT(*) FROM `my_users` WHERE `usertype` = '6'  AND  `domain` = '".DOMAIN."') AS six,
			(SELECT COUNT(*) FROM `my_users` WHERE `usertype` = '7'  AND  `domain` = '".DOMAIN."') AS seven,
			(SELECT COUNT(*) FROM `my_users` WHERE `usertype` = '8'  AND  `domain` = '".DOMAIN."') AS eight,
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
	function statistic(){
	
		$list = $_POST['list'];
		$status = $_POST['status'];
		
		switch ($_POST['req']){
			case 'addcords':
					$q = "INSERT INTO `russianpostoffice` (`address`, `pindex`, `coords`) VALUES ('".$_POST['address']."', '".$_POST['postIndex']."', '".$_POST['coords']."');";
					$Result = JBase::Query($q);
					if ($Result) return true;
					
			break;
			case 'geo':
				$items = [];
				if ($list == 'all'){
						$q = "SELECT count(*) as count, postIndex FROM (  select * from list14 AS obr UNION ALL select * from list14 AS errors UNION ALL select * from list15 AS back UNION ALL select * from list16 AS cancelled UNION ALL select * from list18 AS accepted UNION ALL select * from list19 AS sent UNION ALL select * from list20 AS paid) as T  WHERE postIndex != '' GROUP BY postIndex";
				}
				else{
				$q = "SELECT count(*) as count, postIndex FROM `list".$list."` WHERE postIndex != '' && status = ".$status." GROUP BY postIndex";
				}
				$Result = JBase::Query($q);
				if (!empty($Result)){
				
					while ($item = $Result->fetch_assoc()){
						$items[] = $item;
					}
				}
				
				$res = [];
				foreach( $items as $a){	
					 $a['coords'] = '0';
					$q = "SELECT coords FROM `russianpostoffice` WHERE pindex = ".$a['postIndex']." ";
					$Result = JBase::Query($q);
					if (!empty($Result)){
						while ($item = $Result->fetch_array()){
							$a['coords'] = $item[0];
						}
					} 
					array_push($res, $a);
				}
				return $res;
			break;
		
		
		}
	}
	function statconversion(){
		switch ($_POST['req']){
			case 'sconv':
				$req = [];
				$Day = strtotime(date("Y-m-d"));
				$day = strtotime(date("Y-m-d"));
				$oneday = 86400;
				$req['errors'] = 'list14';
				$req['back'] = 'list15';
				$req['cancelled'] = 'list16';
				$req['treatment'] = 'list17';
				$req['accepted'] = 'list18';
				$req['sent'] = 'list19';
				$req['paid'] = 'list20';
				$res = [];
				$result = [];
				foreach( $req as $key => $value ){	
					$q = "SELECT count(*) as count ,time as time FROM ".$value."  group by time";
					$Result = JBase::Query($q);
					if (!empty($Result)){
					$items = [];
						while ($item = $Result->fetch_assoc()){
							$items[] = $item;
						}
					}
					$res[$key] = $items;
					
					
				}
				foreach( $res as $key => $value ){
			
						
						$day  = $Day;
							for ($i = 1;$i<31;$i++){
							$count = 0;
								foreach ($value as $val){
								if (((int)$val['time'] > (int)$day)&&((int)$val['time'] < (int)($day+$oneday))) {
									$count = $count + $val['count'];
								}
								
							}
							
							$result[$i][$key] = $count;
							$result[$i]['allcount'] = $result[$i]['allcount'] + $count;
							$day = $day - $oneday;
							
						}
				}
				for ($i = 1;$i<31;$i++){
					$result[$i]['day'] = gmdate("Y-m-d", $Day );
					$Day = $Day - $oneday;
					
				}
				
				return $result;
				
				
				 
			break;
			case 'utmstat':
				$q = "select id,status,utm_source,utm_medium,utm_campaign,utm_term,utm_content from ( select * from list14 AS errors UNION ALL select * from list15 AS back UNION ALL select * from list16 AS cancelled UNION ALL select * from list18 AS accepted UNION ALL select * from list19 AS sent UNION ALL select * from list20 AS paid) as T ORDER BY utm_source";
					$Result = JBase::Query($q);
					if (!empty($Result)){
					$items = [];
						while ($item = $Result->fetch_assoc()){
							$items[] = $item;
						}
				return self::creat_tree(['utm_source','utm_medium','utm_campaign','utm_term','utm_content'],$items);
				}
			break;
			}
	}
	function creat_tree($mass,$obj){
		$branch=[];
		$el=[];
		$items = [];
		$q = "SELECT id, statusgroup FROM list8";
		$Result = JBase::Query($q);
					if (!empty($Result)){
					

						while ($item = $Result->fetch_assoc()){
							
								$items[$item['id']] = $item['statusgroup'];
					}
		}
					
					
					
		foreach( $obj as  $key => $value ){
		
		if ($value != null) {
			$branch[$key]='';
		for ($i=0;$i<count($mass);$i++){	
			if ($value[$mass[$i]]=='') $value[$mass[$i]] = $mass[$i].'_not_specified';
			if ($i == count($mass)-1){
				$branch[$key] .=  $value[$mass[$i]].'>list'.$items[$value['status']];
				
			}
			else
				{
				$branch[$key] .=  $value[$mass[$i]].'>';
				
				}
				

			
			}	
			}
		}
		$count = array_count_values($branch);
// 		return '12';
		$branch =[];
	
		foreach( $count as  $key => $value ){
		
			$arr = explode('>',$key);	
			$tmp = $arr;
			array_pop($tmp);
			if ($tmp[0] != ''){
			
			$branch[$tmp[0]]['label'] = $tmp[0];
			$branch[$tmp[0]][$tmp[1]]['label'] = $tmp[1];
			$branch[$tmp[0]][$tmp[1]][$tmp[2]]['label'] = $tmp[2];
			$branch[$tmp[0]][$tmp[1]][$tmp[2]][$tmp[3]]['label'] = $tmp[3];

			$branch[$tmp[0]][$arr[count($arr)-1].'_count'] += $value;
			$branch[$tmp[0]][$tmp[1]][$arr[count($arr)-1].'_count'] += $value;
			$branch[$tmp[0]][$tmp[1]][$tmp[2]][$arr[count($arr)-1].'_count'] += $value;
			$branch[$tmp[0]][$tmp[1]][$tmp[2]][$tmp[3]][$arr[count($arr)-1].'_count'] += $value;

			}
			
			
		}
		return $branch;
	}
	function creat_treeu($mass,$obj){
	
		$branch=[];
		$el=[];
		$items = [];
		$k = 0;
		$q = "SELECT id , statusgroup FROM list8";
		$Result = JBase::Query($q);
					if (!empty($Result)){
					

						while ($item = $Result->fetch_assoc()){
							
								$items[$item['id']] = $item['statusgroup'];
					}
		}
					
					
		$z=0;
		foreach( $obj as  $key => $value ){
			$branch[$k]='';
		for ($i=0;$i<count($mass);$i++){	
			if (strripos($mass[$i], '|')) {
				$tmp = explode('|',$mass[$i]);
				$data = json_decode($value[$tmp[0]],true);
				if ($data != null){
				
				foreach ($data as $val){
					$z++;
					if ($val[$tmp[1]]=='') $val[$tmp[1]] = $tmp[1].'_not_specified';
					if ($val[$tmp[2]]=='') $val[$tmp[2]] = $tmp[2].'_not_specified';
						if ($i == count($mass)-1){
						$branch[$k] .=  $val[$tmp[1]].'>list'.$items[$value['status']];
				
						}
						else{
						if (!isset($branch[$k])) $branch[$k] = '';
						$branch[$k] .=  $val[$tmp[1]].'>';
						$branch[$k] .=  $val[$tmp[2]].'>';
						}
				$k++;
				}
			}
			}	
			else {
				for ($h = 0;$h < $z;$h++){
				if ($value[$mass[$i]]=='') $value[$mass[$i]] = $mass[$i].'_not_specified';
				if ($i == count($mass)-1){
					$branch[$k-$z+$h] .=  $value[$mass[$i]].'>list'.$items[$value['status']];
				
				}
				else
					{
					$branch[$k-$z+$h] .=  $value[$mass[$i]].'>';
					
					}
				}
				$z=0;
			 	}
			}	
		}
		$count = array_count_values($branch);
		
		$branch =[];
	
		foreach( $count as  $key => $value ){
			$arr = explode('>',$key);	
			$tmp = $arr;
			$tmp[2] = str_replace('http://','',$tmp[2]);
			if ($tmp[0] != ''){
			
			array_pop($tmp);
			
			if (!isset($branch[$tmp[0]]['label'])) $branch[$tmp[0]]['label'] = '';
			if (!isset($branch[$tmp[0]][$tmp[1]]['label'])) $branch[$tmp[0]][$tmp[1]]['label'] = '';
			if (!isset($branch[$tmp[0]][$tmp[1]][$tmp[2]]['label'])) $branch[$tmp[0]][$tmp[1]][$tmp[2]]['label'] = '';
			
			$branch[$tmp[0]]['label'] = $tmp[0];
			$branch[$tmp[0]][$tmp[1]]['label'] = $tmp[1];
			$branch[$tmp[0]][$tmp[1]][$tmp[2]]['label'] = $tmp[2];
		
		
// 			return $key;
			if (!isset($branch[$tmp[0]][$arr[count($arr)-1].'_count'])) $branch[$tmp[0]][$arr[count($arr)-1].'_count'] = 0;
			if (!isset($branch[$tmp[0]][$tmp[1]][$arr[count($arr)-1].'_count'])) $branch[$tmp[0]][$tmp[1]][$arr[count($arr)-1].'_count'] = 0;
			if (!isset($branch[$tmp[0]][$tmp[1]][$tmp[2]][$arr[count($arr)-1].'_count'])) $branch[$tmp[0]][$tmp[1]][$tmp[2]][$arr[count($arr)-1].'_count'] = 0;
			
			$branch[$tmp[0]][$arr[count($arr)-1].'_count'] += $value;
			$branch[$tmp[0]][$tmp[1]][$arr[count($arr)-1].'_count'] += $value;
			$branch[$tmp[0]][$tmp[1]][$tmp[2]][$arr[count($arr)-1].'_count'] += $value;
			
			}
			
		}
		return $branch;
	}
	function statusers(){
		$q = '';
		$lvproject =$_POST['proj'];
		$qwer='';
		$min_id = 0;
		$max_id = 100000000;
		
		if (isset($_POST['in'])){ 
			$max_id = (int)$_POST['out'];
			$min_id  = (int)$_POST['in'];
			$qwer .= "AND `id` >= ".$min_id." AND `id` <= ".$max_id;
		}
		switch ($_POST['r_type']){
			case 'd':
				$period = $_POST['period'];
				$day = strtotime(date("Y-m-d"));
				$oneday = 86400;
				$period = $period*$oneday;
				
				$q = "select id,goods_names,webmasterId, referrer ,status FROM ( select * from list15 AS back WHERE `lvproject` = '".$lvproject."' ".$qwer." AND timeupdate BETWEEN ".($day - $period)." AND ".$day." UNION ALL select * from list18 AS accepted  WHERE `lvproject` = '".$lvproject."' ".$qwer."  AND timeupdate BETWEEN ".($day - $period)." AND ".$day." UNION ALL select * from list19 AS sent  WHERE `lvproject` = '".$lvproject."' ".$qwer."  AND timeupdate BETWEEN ".($day - $period)." AND ".$day." UNION ALL  select * from list20 AS paid  WHERE `lvproject` = '".$lvproject."' ".$qwer."  AND timeupdate BETWEEN ".($day - $period)." AND ".$day.") as T WHERE timeupdate BETWEEN ".($day - $period)." AND ".$day."  ORDER BY goods_names";
			break;
			
			case 'w':
				$period = $_POST['period'];
				$week_number = ((date("W") - 1 - $period) < 0 ? 52 + (date("W") - 1 - $period) : (date("W") - 1 - $period)) ;
				$year = date("Y");
				$first_day = strtotime(date('Y-m-d', $week_number * 7 * 86400 + strtotime('1/1/' . $year) - date('w', strtotime('1/1/' . $year)) * 86400 + 86400));
				$last_day = strtotime(date('Y-m-d', ($week_number + 1) * 7 * 86400 + strtotime('1/1/' . $year) - date('w', strtotime('1/1/' . $year)) * 86400));
				
				$q = "select id,goods_names,webmasterId, referrer ,status FROM ( select * from list15 AS back WHERE `lvproject` = '".$lvproject."' ".$qwer." AND timeupdate BETWEEN ".($first_day)." AND ".$last_day." UNION ALL select * from list18 AS accepted WHERE `lvproject` = '".$lvproject."' ".$qwer."  AND timeupdate BETWEEN ".($first_day)." AND ".$last_day." UNION ALL select * from list19 AS sent WHERE `lvproject` = '".$lvproject."' ".$qwer."  AND timeupdate BETWEEN ".($first_day)." AND ".$last_day." UNION ALL  select * from list20 AS paid WHERE `lvproject` = '".$lvproject."' ".$qwer."  AND timeupdate BETWEEN ".($first_day)." AND ".$last_day.") as T WHERE timeupdate BETWEEN ".($first_day)." AND ".$last_day."  ORDER BY goods_names";
				 
			break;
		
		}

// 		return $q;
					$Result = JBase::Query($q);
					if (!empty($Result)){
					$items = [];
						while ($item = $Result->fetch_assoc()){
							$items[] = $item;
						}
					foreach( $items as $value ){	
						$value['goods_names'] = json_decode($value['goods_names'] );
						
					}
				return self::creat_treeu(['goods_names|categoryID|goodID','referrer'],$items);
				
				}	
					
					
		
	}
}

