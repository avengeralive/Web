<?php
namespace lib;

/*
 CREATE TABLE `statex_bprice` (
	`id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`category_id` int(11) NULL,
	`date` int(11) NULL,
	`price` int(11) NULL DEFAULT '0'
 ) ENGINE='InnoDB' COLLATE 'utf8_general_ci';
 (0.014 s)
  */

trait CStatexBPrice{

	/**
	 * Возвращает дефолтное значение, если для данной категории нет значения в переданном массиве
	 */
	function getLastBPrice($category_id, $arrPrices,  $default) {
		if (array_key_exists($category_id, $arrPrices)  ) {
			return $arrPrices[$category_id];
		} 

		return $default;
	}

   /**
	 * Выдаёт все цены для заданной категории в порядке времени в виде массива date=>price 
	 * 
	 * @param $cat_id - ID категории, если нужно получить данные только по ней
	 */	
	function getAllCategoryBPrices($cat_id){
		//loading last values for before date
		$q1 = "SELECT date as timestamp, bp1.`price`
		FROM `statex_bprice` bp1
		WHERE bp1.`category_id`='{$cat_id}'
		order by timestamp
		";//
		
		$res = JBase::Query($q1);

		// так как ои уже отсортированы по дате в запросе, можно просто по очереди присваивать 
		$arrLastPrices = [];
		if (!empty($res)){
			while ($row = $res->fetch_assoc()) {
				$arrLastPrices[$row['timestamp']] = $row['price'];
			}
		}	
		
		return $arrLastPrices;
	}

   /**
	 * Выдаёт последнюю цену для данного массива цен на заданную дату
	 * 
	 * @param $arrBPrices - массив date => price, в котором нужно искать
	 * @param $sDate - дата в виде строки "2020-03-01"
	 * @param $default - значение по умолчанию
	 */		
	function getCategoryBPriceForDate($arrBPrices, $sDate, $default){
		$ts = strtotime($sDate);
		$pr = $default;
		foreach ($arrBPrices as $date => $price) {
		    $pt = ($date);
		   //  echo($date." ". ($pt >= $ts ? ">=" : "<"). " ".$ts.": , $price\n");
		    
			if ($pt > $ts) {
				break;
			} else {
		
				$pr = $price;
			    
			}
		}

		return $pr;
	}

	/**
	 * Выдаёт средние цены на заданную дату
	 * 
	 * @param $sDateRange - дата, строка в формате "год-месяц": 2020-01
	 * @param $default - значение по умолчанию
	 * @param $cat_id - ID категории, если нужно получить данные только по ней
	 */	
	function getAvgBPrices($sDateRange, $default, $cat_id = ''){
		$tStart =  strtotime($sDateRange."-01"); //timestamp на первый день месяца
		$sDateEnd = date("Y-m-t", strtotime($sDateRange));//последний день месяца
		$sDatePart = "DATE(FROM_UNIXTIME(`date`)) < '{$sDateEnd}'";

		//loading last values for before date
		$q1 = "SELECT bp1.`category_id`, date as timestamp, DATE(FROM_UNIXTIME(bp1.`date`)), bp1.`price`
		FROM `statex_bprice` bp1
		WHERE {$sDatePart}
		".($cat_id == "" ? "" : " AND bp1.`category_id`='{$cat_id}'")."
		order by timestamp
		";//
		
		$res = JBase::Query($q1);

		// так как ои уже отсортированы по дате в запросе, можно просто по очереди присваивать 
		$arrAllPrices = [];
		if (!empty($res)){
			while ($row = $res->fetch_assoc()) {
				if ($row['timestamp'] < $tStart ) {
					//считаем значением по умолчанию на первое число месяца
					//так как они отсортированы по дате, последнее и будет правильным 
					$arrAllPrices[$row['category_id']][0] = $row['price'];
				} else {
					//раскладываем в массив по дням
					$arrAllPrices[$row['category_id']][date("d", $row['timestamp'])] = $row['price'];
				}
			}
		}	

		$nDays	= date("t", strtotime($sDateRange));

		$arrAvgPrices = [];
		foreach ($arrAllPrices as $cat => $arrPrices) {
			$total = 0;
			if (isset($arrPrices[0])) {
				$curprice = $arrPrices[0];
			} else {
				$curprice = $default;
			}

			for ($day = 1; $day <= $nDays; $day++) {
				if (isset($arrPrices[$day])) {
					$curprice = $arrPrices[$day];
				}
				$total += $curprice;			
			}
			
			$arrAvgPrices[$cat] = $total / $nDays; 
		}

		
		// if ($dbg  = '00') return "<pre>".$q1."</pre><br>".self::dd($arrAvgPrices);
		return $arrAvgPrices;
	}

/**
	 * Выдаёт  цены на предыдущий месяц от заданной дату
	 * 
	 * @param $sDateRange - дата, строка в формате "год-месяц": 2020-01
	 * @param $default - значение по умолчанию
	 * @param $cat_id - ID категории, если нужно получить данные только по ней
	 */	
	function getLastBPrices($sDateRange){
		//loading last values for before date
		$q1 = "SELECT category_id, price FROM statex_bprice
		WHERE DATE(FROM_UNIXTIME(`date`)) < '{$sDateRange}-01'
		order by `date`
		";//
		
		$res = JBase::Query($q1);
  
		$arrLastPrices = [];
		if (!empty($res)){
		  while ($row = $res->fetch_assoc()) {
			 $arrLastPrices[$row['category_id']] = $row['price'];
		  }
		}  
		
		return $arrLastPrices;
	 }

	/**
	* Выдаём список категорий
	* @param $sDateRange - дата, строка в формате "год-месяц": 2020-1, 2019-12,
	* @return массив пар id=>name
	*/
	function getBPriceCatList($sDateRange)	{
		$settings = new StatexSettings;
		$settings->getConfig();
		$defPrice = $settings->getOption('buy_calc_price', 250);		
		$arrLastPrices = self::getLastBPrices($sDateRange);

		//loading all categories
		$q = "SELECT cats.id, cats.name, DATE(FROM_UNIXTIME(bp.date)) as date, bp.price
		FROM list21 as cats
		LEFT JOIN `statex_bprice` as bp on bp.category_id = cats.id
		GROUP BY cats.id
		ORDER BY cats.name, bp.date
			"; 
		$res = JBase::Query($q);

		$arrResult = [];

		$arrResult[0]['id'] = '0';
		$arrResult[0]['name'] = '0';
		$arrResult[0]['bprice'][] = [$defPrice, '0'];


		if (!empty($res)){
			$cnt = 1;
			while ($row = $res->fetch_assoc()) {
					$arrResult[$cnt]['id'] = $row['id'];
					$arrResult[$cnt]['name'] = $row['name'];
					$cnt++;
			}
		}		

		//loading previous month and default values
		for ($k =1; $k<$cnt; $k++) {
			$arrResult[$k]['bprice'][] =  isset($arrLastPrices[ $arrResult[$k]['id']]) ? [ $arrLastPrices[ $arrResult[$k]['id']], '0' ] : [ $defPrice, '0' ];
		}		

		//loading existing values
		$q = "SELECT cats.id, cats.name, DATE(FROM_UNIXTIME(bp.date)) as date, bp.price
		FROM list21 as cats
		LEFT JOIN `statex_bprice` as bp on bp.category_id = cats.id
		WHERE ".self::getDateRangeQuery($sDateRange, 'date')."
		ORDER BY cats.name, bp.date
			"; 
		$res = JBase::Query($q);

		if (!empty($res)){
			while ($row = $res->fetch_assoc()) {
				for ($k =1; $k<$cnt; $k++) {
					if ($arrResult[$k]['id'] == $row['id']) {
						$arrResult[$k]['bprice'][] = [$row['price'], $row['date']];
					}
				}
			
			}
		}

		return $arrResult;
	}

	function setBPrice($jsonParams)	{
		$date				= strtotime($jsonParams['date']);
		$category_id	= intval($jsonParams['category_id']);
		$price			= intval($jsonParams['price']);


		$q = "DELETE FROM `statex_bprice`WHERE category_id='$category_id' AND date='$date'";
		$res = JBase::Query($q);		

		$q = "INSERT INTO  `statex_bprice` (category_id, date, price)
		VALUES
		('$category_id','$date', '$price');
			"; 
		$res = JBase::Query($q);

		return "'$category_id','$date', '$price'";

	}


}
?>