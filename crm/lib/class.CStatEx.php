<?php
namespace lib;
use \Datetime;
use \Exception;
use CSettings;
use lib\CStatexSettings;
use lib\CStatexCache;
require_once "vendor/telegram-bot/api/src/Client.php";
require_once "vendor/telegram-bot/api/src/BotApi.php";

if (!defined('VOCU_FWK')) die(); // не работает без нашего фреймверка

ini_set('error_prepend_string', "\r\n<br>");
ini_set('error_append_string', "\r\n<br>");
DEFINE('_STX_UPSELL_CATEGORY', '1563');
/**
 * class.CStat.php
 *
 * Библиотека с функциями для работы модуля статистики
 *
 * История: 04.01.2019 - файл создан
 *
**/


/**
 *
 * Таблица с данными продаж:
 *
 * CREATE TABLE `sales_parsed` (
   `id` int(11) NOT NULL COMMENT 'current index' AUTO_INCREMENT PRIMARY KEY,
   `status` varchar(255) NOT NULL COMMENT 'source table\'s (list18, list19,...) meaning',
   `name` varchar(255) NOT NULL COMMENT 'parsed item name',
   `sale_id` int(11) NOT NULL DEFAULT '0' COMMENT 'sale package id in source table',
   `good_id` int NOT NULL DEFAULT '0' COMMENT 'single item id',
   `category_id` int(11) NOT NULL DEFAULT '0' COMMENT 'category id from list22',
   `price` decimal(9,2) NOT NULL DEFAULT '0' COMMENT 'item price',
   `total_sum` decimal(9,2) NOT NULL DEFAULT '0.00' COMMENT 'average cheque in sale ',
   `quantity` int(11) NOT NULL DEFAULT '0' COMMENT 'quantity in package',
   `webmaster_id` int(11) NOT NULL DEFAULT '0' COMMENT 'seller\'s id',
   `last_update` int(11) NOT NULL DEFAULT '0' COMMENT 'last update time in source table',
   `is_upsell` int(11)  NOT NULL DEFAULT '0'  COMMENT '1 if it is an upsell, NULL if not',
   `lead_price` int(11) NOT NULL DEFAULT '0' COMMENT 'price of lead before 2nd call'
  ) ENGINE='InnoDB' COLLATE 'utf8_general_ci';
 *
 */

 /** Индекс по статусу продажи:
  *
  *  ALTER TABLE `sales_parsed`
  * ADD INDEX `status_idx` (`status`(16));
  *
  */

/**
*  Таблица настроек
*
CREATE TABLE `statex_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(255) NOT NULL,
  `value` text NOT NULL
) ENGINE='InnoDB' COLLATE 'utf8_general_ci';
*/

/**
 * таблица с кешем запросов
  CREATE TABLE `statex_cache` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `query_name` varchar(255) NOT NULL,
  `result` text NOT NULL,
  `last_time` timestamp NOT NULL
	) ENGINE='InnoDB' COLLATE 'utf8_general_ci';
* и индекс к ней
	ALTER TABLE `statex_cache`
	ADD INDEX `query_name` (`query_name`);
 */
class StatexSettings {
	use  CStatexSettings;
}

class CStatEx {
	use CStatexUtils;
	use CStatexSettings;
	use CStatexCache;
	use CStatexCsv;
	use CStatexBPrice;
	use CStatexLog;
	/**
	 * Очищает таблицу с кешем запросов
	 */
	function clearCache($sDateRange){
		CStatexCache::clear("%".$sDateRange."%");
	}

	function warmupCache($sDateRange = ""){
		$sResult = [];
		$bNoRange = ($sDateRange == "");
		//если дата не указана, берём последние два месяца
		$months =  $bNoRange ? 2 : 1;

		//сегодняшний месяц и на два месяца назад
		for($m = 0; $m < $months; $m++) {
			$sDateRange = $bNoRange ? date("Y-m", strtotime("-{$m} month")) : $sDateRange;

			//чистим кеш
			CStatexCache::clear("%".$sDateRange."%");

			$sResult[] = "Прогреваем кеш Категорий за $sDateRange";
			self::listCategories($sDateRange);

			$q = "SELECT
			`category_id`, all_categories.name as category_name
			FROM `sales_parsed`
			LEFT JOIN list21 as all_categories on category_id = all_categories.id
			WHERE ".self::getDateRangeQuery($sDateRange)."
			GROUP BY `category_id`
			";

			$res = JBase::Query($q);

			if (!empty($res)){
				while ($aSale = $res->fetch_assoc()){
					$nCategoryId = $aSale['category_id'];

					$jGoodParams = [];
					$jGoodParams['category_id'] = $nCategoryId;
					$jGoodParams['date_range'] = $sDateRange;

					$sResult[] = "+ Прогреваем кеш Товаров в Категории '{$aSale['category_name']}' (id:{$nCategoryId}) за $sDateRange";
					self::listGoods($jGoodParams);

					$q =  "SELECT
					`good_id`, `sales_parsed`.`name`, COUNT(`good_id`) as cnt
					FROM `sales_parsed`
					WHERE ".self::getDateRangeQuery($sDateRange)."
					AND `category_id` = $nCategoryId
					AND `sales_parsed`.`status` <> 'special'
					GROUP BY `good_id`
					";

					$res2 = JBase::Query($q);
					$once = true;
					if (!empty($res2)){
						while ($aSale = $res2->fetch_assoc()){
							if ($once) {
								$sResult[] = "++ Прогреваем кеш Продавцов ({$aSale['cnt']})";
								$once = false;
							}
							$jSellerParams = [];
							$jSellerParams['good_id'] = $aSale['good_id'];
							$jSellerParams['date_range'] = $sDateRange;


							self::listSellers($jSellerParams);
						}
					}
				}
			}
		}

		return join($sResult,"<br>");
	}


	function getRawRecordCount($sTable){

	}
	/**
	 * Парсит одну из таблиц, преобразуя JSON goods_names и несколько важных полей в ассоциативный массив
	 * для последующей вставки в sales_parsed
	 */
	function parseTable($sTable, $sDateQuery = "", $sessStart = false, $sessCount = false){
		//всё лишнее, чего не должно быть в списке товаров
		$aExcludedIds = [
								'33324', //доставка Почтой России
								'91033', //Бесплатная доставка
								'90942', //Гарантия
								'91035', //Бесплатная гарантия
								'9', 		//Непонятный пустой товар (видимо, тестовый?)
								'32968', //Доставка по РФ
								'63845', //Курьерская доставка+
								'96863', //Гарантия 0
							];

		$q = "SELECT goods.id FROM `list22` as goods
				where category = "._STX_UPSELL_CATEGORY."
		";
		$res = JBase::Query($q);
		$aUpsells = [];
		while ($row = $res->fetch_assoc()){
			$aUpsells[] = $row['id'];
		}

		// self::log("Upsells",$aUpsells);

		//проходим по всей таблице продаж и парсим то, что лежит в goods_names (т.е. корзину товаров),
		//раскладываем все товары по отдельным строкам массива rows[]
		//aSale - запись о продаже, aBasket - корзина в ней, aGood - товар в корзине
		$q = "SELECT id, goods_names, shippedAt, total, webmasterId
				from `$sTable`
				WHERE shippedAt <> 0
				{$sDateQuery}
				ORDER BY id
				";

		if ($sessStart !== false) {
			$q .= " LIMIT ".$sessStart;
			if ($sessCount !== false) $q .= " , ".$sessCount;
		}

		$res = JBase::Query($q);

		$aGoods 	= [];
		$nGoods	= 0;
		$nSales	= 0;
		$debugId	= 1340940; //!debug
		$nDebug 	= 0;

		if (!empty($res)){
			while ($aSale = $res->fetch_assoc()){
				if ($nDebug < 100) {
					self::log("Обрабабатываем", $aSale);
					$nDebug++;
				}

				$aBasket	=  json_decode($aSale['goods_names'], true);

				$curBasket	= []; //массив, в котором будем хранить все номера рядов с текущей продажей
				$hasComplects = false; //есть ли в корзине комплекты
				$hasNormal = false; //есть ли в корзине нормальные товары

				if (!is_array($aBasket)) {
					self::log("Ошибка обработки JSON корзины ($sTable -> ".$aSale['id'].")", $aSale['goods_names'], json_last_error());
					continue;
				}

				//разбираем продажу (sale) на отдельные товары (good)
				//в корзине может быть только один товар, остальное апселлы либо "комплекты", которые как товар не учитываются
				foreach ($aBasket as $key => $aGood) {
					if (isset($aGood['goodID'])) {
						$sSpecial = in_array($aGood['goodID'], $aExcludedIds, true) ? "1" : "0";
						$sUpsell =  "0";
						$sComplect =  "0";
						$sNormal = "0";


						// является ли товар апселом?
						$matches = [];


						$sUpsellRegex = "/(\[апсел\]|\[Апсел|\[АПСЕЛ\])/Uis";
						preg_match($sUpsellRegex, $aGood['name'], $matches);

						if (in_array($aGood['goodID'], $aUpsells, true) || count($matches) > 0) {
							$sUpsell =  "1";
						} else {
							// является ли товар комплектом?
							$matches = [];

							$sComplectRegex = "/(комплект|Комплект)/Uis";
							preg_match($sComplectRegex, $aGood['name'], $matches);
							$bComplect = (count($matches) > 0);
							if ($bComplect !== false) {
								$sComplect =  "1";
								$hasComplects = true;
							}
						}

						//является ли товар "специальным" - доставка и т.д.?
						if (!$sUpsell && !$sComplect && !$sSpecial && $aGood['quantity']>0) {
							$hasNormal = true;
							$sNormal = "1";
						}

						//обрезаем лишние пробелы
						$aGood['name'] = trim($aGood['name']);

						if ($debugId == $aSale['id']) {
							self::log("Товар", $aGood);
						}

						//проверяем был ли такой товар уже в этой корзине,
						$nSameGood = 0;
						foreach ($curBasket as $key => $nGood) {
							if ( $aGoods[$nGood]['good_id'] == $aGood['goodID']) {
								$nSameGood = $nGood;
								break;
							}
						}

						if ( $nSameGood > 0) {
							//на случай если в корзине один товар почему-то два раза
							// новый ряд не добавляем, просто увеличиваем количество
								$aGoods[$nSameGood]['quantity'] += $aGood['quantity'];
								if ($debugId == $aSale['id']) {
									self::log("Сработал sameGood");
								}
						} else {
							//создаем ряд в массиве
							$aGoods[$nGoods] = array(
								'sale_id'		=> $aSale['id'],
								'name' 			=> $aGood['name'],
								'good_id'		=> $aGood['goodID'],
								'price'			=> $aGood['price'],
								'quantity'		=> $aGood['quantity'],
								'webmaster_id'	=> $aSale['webmasterId'],
								'last_update'	=> $aSale['shippedAt'],// > 0) ? $aSale['shippedAt'] : $aSale['time'], //date("Y-M-d H:s", $aSale['shippedAt']) to display human readable date
								'is_upsell'		=> $sUpsell,
								'is_special'	=> $sSpecial,
								'is_complect'	=> $sComplect,
								'is_normal'		=> $sNormal,
							);

							if ($nDebug < 100) {
								self::log("Обработан как\n".self::dd($aGoods[$nGoods], false));
							}

							$curBasket[]	= $nGoods;
							$nGoods++;
						}
					}


				}


				$basketSum  = 0;

				//если в корзине и комплект, и товар, комплект удаляем из корзины,
				//а товару ставим количество 1
				if ($hasComplects && $hasNormal) {
					foreach ($curBasket as $key => $nGood) {
						if ( $aGoods[$nGood]['is_complect'] ) {

							unset($aGoods[$nGood]);
							unset($curBasket[$key]);

							$nGoods--;
						} else
						if ( $aGoods[$nGood]['is_normal'] && $aGoods[$nGood]['quantity'] == 0) {
							$aGoods[$nGood]['quantity'] = 1;
						}
					}
				}

				//считаем стоимость корзины
				// foreach ($curBasket as $key => $nGood) {
				// 	$basketSum += $aGoods[$nGood]['price']*$aGoods[$nGood]['quantity'];
				// }

				//! вместо подсчёта возьмём готовое из таблицы
				$basketSum = $aSale['total'];

				//всем товарам этой продажи проставить общий чек
				//если товар - апсел, вместо общего чека ставим стоимость апсела
				foreach ($curBasket as $key => $nGood) {
					if ( $aGoods[$nGood]['is_upsell'] ) {
						$aGoods[$nGood]['total_sum'] = $aGoods[$nGood]['price'];
					} else {
						$aGoods[$nGood]['total_sum'] = $basketSum;
					}
				}
				$nSales++;
			}

			//убираем все товары с quantity=0
			foreach ($aGoods as $nGood => $aGood) {
				if ( $aGoods[$nGood]['quantity'] == 0 ) {
					if ($nDebug < 100) {
						self::log("Удаляем с Q=0", $aGoods[$nGood]);
					}
					unset($aGoods[$nGood]);
					// unset($curBasket[$key]);
					$nGoods--;
				}
			}

		}

		if (!empty($aGoods)) {
			return $aGoods;
		} else {
			return "$nGoods рядов и $nSales продаж";//.$q;
		}
	}

	/**
	 * Подготоваливает данные из всех таблиц продаж
	 * и вставляет их в sales_parsed.
	 *
	 * ! sales_parsed очищается полнотью каждый раз при вызове этой функции
	 *
	 * TODO: в дальнейшем можно использовать LOAD DATA INFILE вместо INSERT INTO для оптимизации
	 */
	function prepare(){
		$arrRes = [];

		$settings = new StatexSettings;
		$settings->getConfig();
		$depth = $settings->getOption("import_months", -1);



		$arrTables = [
			//approved tables
			'list15' => 'returned',
			'list17' => 'processed',
			'list18' => 'accepted',
			'list19' => 'sent',
			'list20' => 'paid',

			//non-approved tables
			// 'list14' => 'trash',
			// 'list16' => 'canceled',
		];

		$sDateQuery = "";
		// очищаем таблицу sales_parsed
		if ($depth == -1) {
			$q = "TRUNCATE TABLE `sales_parsed`;";
		} else {
			$qDate = date("Y-m-01", strtotime('-'.$depth.' months'));
			$q = "DELETE FROM `sales_parsed`
			WHERE DATE(FROM_UNIXTIME(`last_update`)) >= '{$qDate}'";
			$sDateQuery = " AND DATE(FROM_UNIXTIME(`shippedAt`)) >= '{$qDate}'";
		}
		JBase::Query($q);

		// проходим по всем "аппрув" таблицам, парсим их и закидываем результаты в sales_parsed
		// потом
		foreach ($arrTables as $table => $status) {
			$aSales = self::parseTable($table, $sDateQuery);

			if (is_array($aSales)) {
				$nRows = count($aSales);
			} else {
				$nRows = 0;
			}

			if ( $nRows > 0 ) {
				$q = "INSERT INTO `sales_parsed` (`status`, `name`, `sale_id`, `good_id`, `price`, `total_sum`, `webmaster_id`, `quantity`, `last_update`, `is_upsell`)
				VALUES \n";

				// соединяем массив в SQL-запрос
				$i = 0;
				foreach ($aSales as $aSale) {
					$sStatus = ($aSale ['is_special'] == "1") ? "special" : $status;
					$sName = JBase::$mysqli_pool->real_escape_string($aSale['name']);

					$q .= "( '{$sStatus}', '{$sName}', '{$aSale['sale_id']}', '{$aSale['good_id']}', '{$aSale['price']}', '{$aSale['total_sum']}', '{$aSale['webmaster_id']}', '{$aSale['quantity']}', '{$aSale['last_update']}', '{$aSale['is_upsell']}')";
					$q .= ($i == $nRows-1) ? ";" : ",\n";
					$i++;
				}

				$res = JBase::Query($q);
				$sRes = ($res) ? "успешно" : "ошибка";
				$sErr = ($res) ? "нет" : JBase::$mysqli_pool->error."<br><br>Query:<br><pre>".$q."</pre>";
			} else {
				$sRes = "внимание".(is_array($aSales) ? "" : ": ".$aSales);
				$sErr = "в таблице нет подходящих записей";
				if ($depth != -1) {
					$sErr .= " за период с ".$qDate;
				}
			}

			//добавляем в таблицу ID категории
			//проставляем флаг is_upsell для всех товаров из категории "Апсел"
			//и ставим для них общий чек = цена товара
			//
			// на этом этапе апселлом считается товар, отмеченный как апсел на этапе парсинга,
			// товар, у которого категория _STX_UPSELL_CATEGORY или 1
			$q2 = "UPDATE sales_parsed
			INNER JOIN `list22` AS all_goods on sales_parsed.good_id = all_goods.id
			SET
			category_id = all_goods.category,
			is_upsell = IF(is_upsell = 1, 1, IF (all_goods.category = "._STX_UPSELL_CATEGORY.", 1, IF (all_goods.category = 1, 1, 0)) ),
			total_sum = IF(is_upsell = 1, sales_parsed.price, IF (all_goods.category = "._STX_UPSELL_CATEGORY.", sales_parsed.price, IF (all_goods.category = 1, sales_parsed.price, total_sum))),
			sales_parsed.lead_price = all_goods.`".self::getLeadField()."`
			";
			// ? можно было бы брать цену из таблицы товаров: sales_parsed.price = all_goods.price

			$res = JBase::Query($q2);

			$sRes .= ($res) ? ", без ошибок" : ", ошибка обновления:<br><pre>".$q2."</pre>";
			$sErr .= ($res) ? "" : ", <br>".JBase::$mysqli_pool->error;

			$arrRes[] = array($status, $nRows, $sRes, $sErr);
		}



		if ($depth == -1) {
			self::clearCache("*");
			$arrRes[] = array("кеш", "очищен весь кеш", "", "");
		} else {
			for ($i = 0; $i < $depth; $i++) {
				$qDate = date("Y-m", strtotime('-'.$i.' months'));
				self::clearCache("%{$qDate}%");
				$arrRes[] = array("кеш ", "очищен кеш за", $qDate, "");
			}
		}

		return $arrRes;
	}

/**
 * Выдаёт имя поля для цены лида, в зависимости от сервера, на кором выполняется
 */
	function getLeadField(){
		if ($_SERVER['SERVER_NAME'] == "seekingdancer.ru") {
			$sLeadField = "f1580394079n";
		} else {
			$sLeadField = "f1580430728n";
		}

		return "f1580430728n";
	}


/**  Вывод продавцов заданного товара в массив
 *
 *		Параметры передаются в JSON:
 *		@param jsonParams Данные в JSON
 *
 *		$sDateRange - год и месяц (2020-1, 2019-12, ..), для которых нужны данные
 *
 * 	$nGoodId - продавцов какого товара выводить
 */
function listSellers($jsonParams){
	$sDateRange 	= $jsonParams['date_range'];
	$nGoodId			= $jsonParams['good_id'];
	$skipCache		= $jsonParams['skip_cache'];
	$settings = new StatexSettings;
	$settings->getConfig();

	$lastBuyPrices = self::getLastBPrices($sDateRange);
	$defBuyPrice = $settings->getOption('buy_calc_price', 250);

	//пробуем взять результат из кеша и сразу вернуть, если получилось
	$cache_result = ($settings->getOption("enable_caching") == 1 && $skipCache == 0) ? CStatexCache::load('listSellers'.$sDateRange.'_'.$nGoodId) : false;
	if ($cache_result !== false) return $cache_result;

	$nWeeks			= self::getWeekCount($sDateRange);

	// считаем общее количество
	$nGoodId = intval($nGoodId);
	$goodsData = [];
	$q = "SELECT
	COUNT(`sales_parsed`.`good_id`) as total, good_id, webmaster_id, lead_price,
	`sales_parsed`.status, category_id, lead_price,
	AVG(`sales_parsed`.`total_sum`) as avg_cheque,
	AVG(`sales_parsed`.`lead_price`) as avg_lead_price,
	SUM(`sales_parsed`.`total_sum`) as sum_cheque,
	".self::getWeeksQuery($sDateRange)."
	FROM `sales_parsed`
	WHERE `good_id` = {$nGoodId}
	AND ".self::getDateRangeQuery($sDateRange)."
	AND `sales_parsed`.`status` <> 'special'
	GROUP BY good_id, webmaster_id, week_number, `sales_parsed`.status
	";

	$res = JBase::Query($q);
	$sMainQuery = $q;

	if (!$res) {
		$goodsData["message"][0] = "Error in query: ".$q;
		return $goodsData;
	}

	while ($item = $res->fetch_assoc()){
		$sToken = $item['webmaster_id']; //$item['good_id']."_".
		$sWmName = $item['webmaster_id'];//($item['webmaster_id'] > 0) ? $item['webmaster_name'] : "[неизвестный герой]";
		if (!isset($goodsData[$sToken])) {
			$goodsData[$sToken]['webmaster_name']	= $sWmName;
			$goodsData[$sToken]['webmaster_id']		= $item['webmaster_id'];
			$goodsData[$sToken]['good_id']			= $item['good_id'];
			$goodsData[$sToken]['total']				= $item['total'];
			$goodsData[$sToken]['sum_cheque']		= $item['sum_cheque'];
			$goodsData[$sToken]['avg_cheque']		= number_format($item['sum_cheque'] / $item['total'], 2, '.', '');
			$goodsData[$sToken]['total_paid']		= "0";
			$goodsData[$sToken]['ratio']				= "0";
			$goodsData[$sToken]['week_count']		= $nWeeks;
			$goodsData[$sToken]['lead_price']		= $item['avg_lead_price'];


			for ($week_number = 1; $week_number <= $nWeeks; $week_number++) {
				$goodsData[$sToken]['week_total'.$week_number] = 0;
				$goodsData[$sToken]['week_paid'.$week_number] = 0;
				$goodsData[$sToken]['week_color'.$week_number]	= "silver";
				$goodsData[$sToken]['week_lead'.$week_number]	= $item['avg_lead_price'];
				$goodsData[$sToken]['week_avg_cheque'.$week_number]	= $item['avg_cheque'];
			}

			$goodsData[$sToken]['week_total'.$item['week_number']]		= $item['total'];
			$goodsData[$sToken]['week_lead'.$item['week_number']]			= $item['avg_lead_price'];
			$goodsData[$sToken]['week_avg_cheque'.$item['week_number']]	= $item['avg_cheque'];

			if ($item['status'] == 'paid') {
				$goodsData[$sToken]['week_paid'.$item['week_number']]	= $item['total'];
				$goodsData[$sToken]['total_paid']							= $item['total'];
			}

			$goodsData[$sToken]['ratio'] = ($goodsData[$sToken]['total'] > 0) ?
													number_format($goodsData[$sToken]['total_paid'] / $goodsData[$sToken]['total'] * 100, 1, '.', '') :
													"0";

		 } else {
			$goodsData[$sToken]['total'] 										= $goodsData[$sToken]['total'] + $item['total'];
			$goodsData[$sToken]['week_total'.$item['week_number']]	= $goodsData[$sToken]['week_total'.$item['week_number']] + $item['total'];
			$goodsData[$sToken]['sum_cheque']								= $goodsData[$sToken]['sum_cheque'] + $item['sum_cheque'];
			$goodsData[$sToken]['avg_cheque']									= number_format($goodsData[$sToken]['sum_cheque'] / $goodsData[$sToken]['total'], 2, '.', '');;

			if ($item['status'] == 'paid') {
				$goodsData[$sToken]['week_paid'.$item['week_number']]	= $goodsData[$sToken]['week_paid'.$item['week_number']] + $item['total'];
				$goodsData[$sToken]['total_paid']							= $goodsData[$sToken]['total_paid'] + $goodsData[$sToken]['week_paid'.$item['week_number']];
				$goodsData[$sToken]['paid']									= $goodsData[$sToken]['total_paid'];
			}

			$goodsData[$sToken]['ratio'] = ($goodsData[$sToken]['total'] > 0) ?
													number_format($goodsData[$sToken]['total_paid'] / $goodsData[$sToken]['total'] * 100, 1, '.', '') :
													"0";
		}

		$goodsData[$sToken]['buy_price']		= self::getLastBPrice($item['category_id'], $lastBuyPrices, $defBuyPrice);
		$goodsData[$sToken]['profit'] 		= self::calcProfit($goodsData[$sToken]);
		$goodsData[$sToken]['pr_color'] 		= self::profitColor($goodsData[$sToken]['profit']);
	}

	//раскрашиваем по неделям
	foreach ($goodsData as $sToken => $dataRow) {
		for ($week_number = 1; $week_number <= $nWeeks; $week_number++) {
			$weekData['avg_cheque']		= round($goodsData[$sToken]['week_avg_cheque'.$week_number]);
			$weekData['total']			= $goodsData[$sToken]['week_total'.$week_number];
			$weekData['paid']				= $goodsData[$sToken]['week_paid'.$week_number];
			$weekData['lead_price']		= round($goodsData[$sToken]['week_lead'.$week_number]);
			$weekData['ratio']			= ($weekData['total']	 > 0) ? ($weekData['paid'] / $weekData['total'] * 100)	 : 0;

			$goodsData[$sToken]['buy_price']						= self::getLastBPrice($item['category_id'], $lastBuyPrices, $defBuyPrice);
			$goodsData[$sToken]['week_profit'.$week_number] = self::calcProfit($weekData);
			$goodsData[$sToken]['week_color'.$week_number] 	= ($weekData['total']	 > 0) ? self::profitColor($goodsData[$sToken]['week_profit'.$week_number]) : self::profitColor(false);

			$weekData['week_profit'] = $goodsData[$sToken]['week_profit'.$week_number];
			$weekData['week_color'] = $goodsData[$sToken]['week_color'.$week_number];
		}
	}

	usort($goodsData, function($a, $b){
		return ($a['profit'] < $b['profit']);
	});

	// $goodsData['message'][0] = "<pre>".$sMainQuery."</pre>";//"Средний чек по категории считается с учётом доставок/гарантий";

	//кешируем результат
	CStatexCache::save('listSellers'.$sDateRange.'_'.$nGoodId, $goodsData);

	return $goodsData;
}

 /**  Вывод товаров из заданной категории в массив
	*
	* 		Параметры передаются в JSON:
	*
	*	  	$nCategoryId - товары из какой категории выводить,
	* 		если 0 (по умолчанию) - выводит из всех категорий
	*
	* 		$sDateRange - год и месяц (2020-1, 2019-12, ..), для которых нужны данные
	* 		@param $jsonParams['category_id']
	*		@param $jsonParams['date_range'];
 */
	function listGoods($jsonParams){
		$nCategoryId	= intval($jsonParams['category_id']);
		$sDateRange 	= $jsonParams['date_range'];
		$skipCache		= isset($jsonParams['skip_cache']) ? $jsonParams['skip_cache'] : 0;
		$extraQuery		= isset($jsonParams['extra_query']) ? $jsonParams['extra_query'] : "";

		$nWeeks			= self::getWeekCount($sDateRange);

		// return $goodsData;
		$settings = new StatexSettings;
		$settings->getConfig();

		$lastBuyPrices = self::getLastBPrices($sDateRange);
		$defBuyPrice = $settings->getOption('buy_calc_price', 250);

		//пробуем взять результат из кеша и сразу вернуть, если получилось
		$cache_result = ($settings->getOption("enable_caching") == 1 && $skipCache == 0) ? CStatexCache::load('listGoods_'.$sDateRange.'_'.$nCategoryId) : false;
		if ($cache_result !== false) return $cache_result;

		// считаем общее количество
		$goodsData = [];
		$q = "SELECT
		`good_id`, `sales_parsed`.`name`, `category_id`,`sales_parsed`.status,
		price, lead_price, is_upsell,
		COUNT(`sales_parsed`.`good_id`) as total,
		SUM(`sales_parsed`.`total_sum`) as sum_cheque,
		AVG(`sales_parsed`.`total_sum`) as avg_cheque,
		".self::getWeeksQuery($sDateRange)."
		FROM `sales_parsed`
		WHERE ".self::getDateRangeQuery($sDateRange)."
		".(($nCategoryId > 0) ? "AND `category_id` = $nCategoryId" : "")."
		AND `sales_parsed`.`status` <> 'special'
		GROUP BY `good_id`, `status`, `week_number`
		{$extraQuery}
		";

		// AVG(`sales_parsed`.`lead_price`) as avg_lead_price,

		// self::log($q);

		$res = JBase::Query($q);

		if (!$res) {
			$goodsData["message"][0] = "Error in query: ".$q;
			return $goodsData;
		}

		while ($item = $res->fetch_assoc()){

			$sToken = $item['good_id'];

			if (!isset($goodsData[$sToken])) {
				$goodsData[$sToken]['id']					= $item['good_id'];
				$goodsData[$sToken]['name']				= $item['name'];
				$goodsData[$sToken]['category_id']		= $item['category_id'];
				$goodsData[$sToken]['total']				= $item['total'];
				$goodsData[$sToken]['price']				= $item['price'];
				$goodsData[$sToken]['sum_cheque']		= $item['sum_cheque'];
				$goodsData[$sToken]['avg_cheque']		= number_format($item['sum_cheque'] / $item['total'], 2, '.', '');
				$goodsData[$sToken]['total_paid']		= "0";
				$goodsData[$sToken]['ratio']				= "0";
				$goodsData[$sToken]['week_count']		= $item['week_count'];
				$goodsData[$sToken]['lead_price']		= $item['lead_price'];
				$goodsData[$sToken]['is_upsell']			= $item['is_upsell'];


				for ($week_number = 1; $week_number <= $nWeeks; $week_number++) {
					$goodsData[$sToken]['week_total'.$week_number] = 0;
					$goodsData[$sToken]['week_paid'.$week_number] = 0;
					$goodsData[$sToken]['week_color'.$week_number]	= "silver";
					$goodsData[$sToken]['week_avg_cheque'.$week_number]	= $item['avg_cheque'];
				}

				$goodsData[$sToken]['week_total'.$item['week_number']]		= $item['total'];
				$goodsData[$sToken]['week_avg_cheque'.$item['week_number']]	= $item['avg_cheque'];


				$goodsData[$sToken]['week_total'.$item['week_number']]	= $item['total'];

				if ($item['status'] == 'paid') {
					$goodsData[$sToken]['week_paid'.$item['week_number']]	= $item['total'];
					$goodsData[$sToken]['total_paid']							= $item['total'];
				}

				$goodsData[$sToken]['ratio'] = ($goodsData[$sToken]['total'] > 0) ?
														number_format($goodsData[$sToken]['total_paid'] / $goodsData[$sToken]['total'] * 100, 1, '.', '') :
														"0";

			} else{
				$goodsData[$sToken]['total'] 										= $goodsData[$sToken]['total'] + $item['total'];
				$goodsData[$sToken]['week_total'.$item['week_number']]	= $goodsData[$sToken]['week_total'.$item['week_number']] + $item['total'];
				$goodsData[$sToken]['sum_cheque']								= $goodsData[$sToken]['sum_cheque'] + $item['sum_cheque'];
				$goodsData[$sToken]['avg_cheque']								= number_format($goodsData[$sToken]['sum_cheque'] / $goodsData[$sToken]['total'], 2, '.', '');;

				if ($item['status'] == 'paid') {
					$goodsData[$sToken]['week_paid'.$item['week_number']]	= $goodsData[$sToken]['week_paid'.$item['week_number']] + $item['total'];
					$goodsData[$sToken]['total_paid']							= $goodsData[$sToken]['total_paid'] + $goodsData[$sToken]['week_paid'.$item['week_number']];
				}

				$goodsData[$sToken]['ratio'] = ($goodsData[$sToken]['total'] > 0) ?
														number_format($goodsData[$sToken]['total_paid'] / $goodsData[$sToken]['total'] * 100, 1, '.', '') :
														"0";
			}

			$goodsData[$sToken]['buy_price']		= self::getLastBPrice($item['category_id'], $lastBuyPrices, $defBuyPrice);
			$goodsData[$sToken]['profit'] 		= self::calcProfit($goodsData[$sToken]);
			$goodsData[$sToken]['pr_color'] 		= self::profitColor($goodsData[$sToken]['profit']);
		}

		//раскрашиваем по неделям
		foreach ($goodsData as $sToken => $dataRow) {
			for ($week_number = 1; $week_number <= $nWeeks; $week_number++) {
				$weekData['avg_cheque']		= round($goodsData[$sToken]['week_avg_cheque'.$week_number]);
				$weekData['total']			= $goodsData[$sToken]['week_total'.$week_number];
				$weekData['paid']				= $goodsData[$sToken]['week_paid'.$week_number];
				$weekData['lead_price']		= $goodsData[$sToken]['lead_price'];
				$weekData['ratio']			= ($weekData['total']	 > 0) ? ($weekData['paid'] / $weekData['total'] * 100)	 : 0;
				$weekData['buy_price'] 		= $goodsData[$sToken]['buy_price'];

				$goodsData[$sToken]['week_profit'.$week_number] 	= self::calcProfit($weekData);
				$goodsData[$sToken]['week_color'.$week_number] 	= ($weekData['total']	 > 0) ? self::profitColor($goodsData[$sToken]['week_profit'.$week_number]) : self::profitColor(false);

				$weekData['week_profit'] = $goodsData[$sToken]['week_profit'.$week_number];
				$weekData['week_color'] = $goodsData[$sToken]['week_color'.$week_number];
			}
		}

		usort($goodsData, function($a, $b){
			return ($a['profit'] < $b['profit']);
		});

		// ! debug
		//  $goodsData['message'][0] = "<pre>".$q."</pre>";
		// $goodsData[count($goodsData)]["name"] = $sDateQuery." ... ".$sDateWhere." ...  ".$sQ;

		//кешируем результат
		CStatexCache::save('listGoods_'.$sDateRange.'_'.$nCategoryId, $goodsData);
		return $goodsData;
	}


 /**
  * Вывод категорий в массив
  *
  * $sDateRange - год и месяц в формате Y-m, т.е. 2020-01
 */
	function listCategories($jsonParams){
		$skipCache		= $jsonParams['skip_cache'];
		$sDateRange 	= $jsonParams['date_range'];


		$settings = new StatexSettings;
		$settings->getConfig();
		$lastBuyPrices = self::getLastBPrices($sDateRange);
		$defBuyPrice = $settings->getOption('buy_calc_price', 250);

		$aExcludedIds = [
			'1563', //Апселы
			'1552', //Доставка
		];

		//пробуем взять результат из кеша и сразу вернуть, если получилось
		$cache_result = ($settings->getOption("enable_caching") == 1 && $skipCache == 0) ? CStatexCache::load('listCategories_'.$sDateRange) : false;
		if ($cache_result !== false) return $cache_result;

		$goodsData 				= [];
		$avgPrices 				= [];
		$totalForMonth 		= [];
		$totalPaidForMonth	= [];
		$totals_paid 			= [];
		$nWeeks					= self::getWeekCount($sDateRange);


		$q = "SELECT
		all_categories.name as category_name, is_upsell, category_id,
		IF (is_upsell, "._STX_UPSELL_CATEGORY.", `category_id`) as cat_id,
		COUNT( `sales_parsed`.`sale_id`) as total,
		SUM(`sales_parsed`.`price`) as price,
		AVG(`sales_parsed`.`total_sum`) as avg_cheque,
		AVG(`sales_parsed`.`lead_price`) as avg_lead_price,
		SUM(`sales_parsed`.`total_sum`) as total_cat_sum,
		SUM(IF (`sales_parsed`.`status` = 'paid', 1, 0)) as total_paid,
		".self::getWeeksQuery($sDateRange)."
		FROM `sales_parsed`
		LEFT JOIN list21 as all_categories on category_id = all_categories.id
		WHERE `sales_parsed`.`status` <> 'special'
		AND ".self::getDateRangeQuery($sDateRange)."
		GROUP BY `cat_id`, `week_number`
		"; //".(($nCategoryId == 0) ? "" : "AND `category_id` = $nCategoryId")."
		//

		$res = JBase::Query($q);

		// ! debug
		// $sMainQuery = $q;
		// $sDebug = "";
		// $goodsData['message'][0] = $q;
		// $goodsData[0]['category_name'] = $q;
		// return $goodsData;
		// $sDebug = "WEEKS:<br>";

		while ($item = $res->fetch_assoc()){
			$sToken = $item['cat_id'];

			if (in_array($sToken, $aExcludedIds, true)) continue;

			$sCatName = ($item['category_name'] == "") ? "(id:".$item['category_id'].")" : $item['category_name'];

			if (!isset($goodsData[$sToken])) {
				for ($week_number = 1; $week_number <= $nWeeks; $week_number++) {
					$goodsData[$sToken]['week_total'.$week_number]	= 0;
					$goodsData[$sToken]['week_paid'.$week_number]	= 0;
					$goodsData[$sToken]['week_color'.$week_number]	= "silver";
					$goodsData[$sToken]['week_lead'.$week_number]	= $item['avg_lead_price'];
					$goodsData[$sToken]['week_avg_cheque'.$week_number]	= $item['avg_cheque'];
				}

				$goodsData[$sToken]['id']					= $item['cat_id'];
				$goodsData[$sToken]['name']				= $sCatName;
				$goodsData[$sToken]['category_name']	= $sCatName;
				$goodsData[$sToken]['avg_cheque']		= number_format($item['avg_cheque'], 2, '.', '');
				$goodsData[$sToken]['total_paid']		= "0";
				$goodsData[$sToken]['ratio']				= "0";

				$goodsData[$sToken]['lead_price']		= $item['avg_lead_price'];
				$goodsData[$sToken]['buy_price']			= self::getLastBPrice($item['category_id'], $lastBuyPrices, $defBuyPrice);

				$goodsData[$sToken]['is_upsell']			= $item['is_upsell'];
				$goodsData[$sToken]['total_cat_sum']	= $item['total_cat_sum'];
			} else{
				$goodsData[$sToken]['week_total'.$item['week_number']] += $item['total'];
				$goodsData[$sToken]['total_cat_sum']	+= $item['total_cat_sum'];
			}

			$goodsData[$sToken]['week_total'.$item['week_number']]		= $item['total'];
			$goodsData[$sToken]['week_lead'.$item['week_number']]			= $item['avg_lead_price'];
			$goodsData[$sToken]['week_avg_cheque'.$item['week_number']]	= $item['avg_cheque'];
			$goodsData[$sToken]['week_count']		= $item['week_count'];

			// подсчитываем оплаченные
			if ($item['status'] = 'paid') {
				$goodsData[$sToken]['week_paid'.$item['week_number']] = $item['total_paid'];

				$totalPaidForMonth[$sToken] = (isset($totalPaidForMonth[$sToken]))  ? $totalPaidForMonth[$sToken] + $item['total_paid'] : $item['total_paid'];
				$goodsData[$sToken]['total_paid'] = $totalPaidForMonth[$sToken];
			}

			//суммируем в total разбитые по неделям количества апрувов
			$totalForMonth[$sToken] = (isset($totalForMonth[$sToken]))  ? $totalForMonth[$sToken] + $item['total'] : $item['total'];
			$goodsData[$sToken]['total'] = $totalForMonth[$sToken];
		}

		if (count($goodsData) == 0) {
			$goodsData = array();
			//выдаём названия категорий даже если продаж нет
				$sToken = 0;//$item['category_id'];
				$goodsData[$sToken] = array(
								'id'					=> 0,
								'name'				=> "нет продаж",
								'category_name'	=> "нет продаж",
								'total'				=> "0",
								'avg_cheque'		=> "0",
								'total_paid'		=> "0",
								'ratio'				=> "0",
								'lead_price'		=> 0,
				);
		} else {
			/**
			 * считаем средние значение. Доставка тоже учитывается
			 */

			$q2 = "SELECT
			 `category_id`, all_categories.name as category_name, is_upsell,
			 IF (is_upsell, "._STX_UPSELL_CATEGORY.", `category_id`) as cat_id,
			COUNT(`sales_parsed`.`sale_id`) as total,
			AVG(`sales_parsed`.`total_sum`) as avg_cheque,
			SUM(`sales_parsed`.`total_sum`) as total_cat_sum,
			SUM(`sales_parsed`.`total_sum`) / COUNT(DISTINCT `sales_parsed`.`sale_id`) as real_avg,
			SUM(IF (`sales_parsed`.`status` = 'paid', 1, 0)) as total_paid,
			SUM(IF (`sales_parsed`.`status` != 'special', 1, 0)) as total_nonspecial
			FROM `sales_parsed`
			LEFT JOIN list21 as all_categories on category_id = all_categories.id
			WHERE ".self::getDateRangeQuery($sDateRange)."
			GROUP BY `cat_id`
			"; //".(($nCategoryId == 0) ? "" : "AND `category_id` = $nCategoryId")."
			//AVG(`sales_parsed`.`price`) as avg_cheque,

			$res = JBase::Query($q2);
			$cnt_goods = 0;
			$cnt_specs = 0;
			while ($item = $res->fetch_assoc()){
				if ($item['total_nonspecial'] > 0 ) { //то есть это не только доставки
					$sToken = $item['category_id'];
					if (in_array($sToken, $aExcludedIds, true)) continue;

					$goodsData[$sToken]['avg_cheque']	= $item['real_avg'];
					$goodsData[$sToken]['ratio']		= ($item['total'] > 0) ?	$item['total_paid'] / $item['total'] * 100 : 0;


					//formatting for output
					$goodsData[$sToken]['avg_cheque']	= number_format($goodsData[$sToken]['avg_cheque'], 2, '.', '');
					$goodsData[$sToken]['ratio']		= ($goodsData[$sToken]['ratio'] > 0) ? number_format($goodsData[$sToken]['ratio'], 1, '.', '') : "0";
					$goodsData[$sToken]['buy_price']	= self::getLastBPrice($item['category_id'], $lastBuyPrices, $defBuyPrice);
					$goodsData[$sToken]['profit'] 	= self::calcProfit($goodsData[$sToken]);
					$goodsData[$sToken]['pr_color'] 	= self::profitColor($goodsData[$sToken]['profit']);
					$cnt_goods++;
				} else {
					$cnt_specs++;
				}
			}



			//перед выводом сортируем массив по ratio
			usort($goodsData, function($a, $b){
				return ($a['profit'] < $b['profit']);
			});

			//считаем итоговые суммы
			$goodsData['summary']['id'] = 'summary';
			$goodsData['summary']['category_name'] = 'ИГОГО: ';
			$goodsData['summary']['week_count'] = $nWeeks;
			$goodsData['summary']['total'] = 0;
			$goodsData['summary']['total_paid'] = 0;
			$goodsData['summary']['avg_cheque'] = 0;
			$goodsData['summary']['lead_price'] = 0;
			$goodsData['summary']['total_cat_sum'] = 0;

			for ($week_number = 1; $week_number <= $nWeeks; $week_number++) {
				$goodsData['summary']['week_total'.$week_number]		= 0;
				$goodsData['summary']['week_paid'.$week_number]			= 0;
				$goodsData['summary']['week_avg_cheque'.$week_number]	= 0;
				$goodsData['summary']['week_avg_count'.$week_number]	= 0;
				$goodsData['summary']['week_lead'.$week_number]	= 0;
			}

			$sTokens = "";
			$nUpsells = 0;
			// $goodsData['message'][0] = "";

			foreach($goodsData as $sToken => $dataRow) {
				if ($sToken !== 'summary') {
					if ($goodsData[$sToken]['is_upsell'] != 1) {
						$goodsData['summary']['total'] 									= $goodsData['summary']['total'] + $goodsData[$sToken]['total'];
						$goodsData['summary']['total_paid'] 							= $goodsData['summary']['total_paid'] + $goodsData[$sToken]['total_paid'];
						$goodsData['summary']['total_cat_sum'] 						= $goodsData['summary']['total_cat_sum'] + $goodsData[$sToken]['total_cat_sum'];
						$goodsData['summary']['lead_price'] 							= $goodsData['summary']['lead_price'] + $goodsData[$sToken]['lead_price'];


						for ($week_number = 1; $week_number <= $nWeeks; $week_number++) {
							$goodsData['summary']['week_total'.$week_number]		+= $goodsData[$sToken]['week_total'.$week_number];
							$goodsData['summary']['week_paid'.$week_number]			+= $goodsData[$sToken]['week_paid'.$week_number];
							$goodsData['summary']['week_avg_cheque'.$week_number]	+= $goodsData[$sToken]['week_avg_cheque'.$week_number];
							$goodsData['summary']['week_lead'.$week_number]			+= $goodsData[$sToken]['week_lead'.$week_number];
							$goodsData['summary']['week_avg_count'.$week_number]	++;
						}

					} else {
						$nUpsells++;
					}
				}
			}

			for ($week_number = 1; $week_number <= $nWeeks; $week_number++) {
				$goodsData['summary']['week_avg_cheque'.$week_number]	= ($goodsData['summary']['week_avg_count'.$week_number] > 0) ?
														$goodsData['summary']['week_avg_cheque'.$week_number] / $goodsData['summary']['week_avg_count'.$week_number] : 0;
				$goodsData['summary']['week_lead'.$week_number]	= ($goodsData['summary']['week_lead'.$week_number] > 0) ?
														$goodsData['summary']['week_lead'.$week_number] / $goodsData['summary']['week_lead'.$week_number] : 0;
			}


			$goodsData['summary']['avg_cheque'] = round($goodsData['summary']['total_cat_sum'] / $goodsData['summary']['total'] );
			$goodsData['summary']['lead_price'] = round($goodsData['summary']['lead_price'] / (count($goodsData)-1-$nUpsells));

			$goodsData['summary']['ratio'] = ($goodsData['summary']['total'] == 0) ? 0 : $goodsData['summary']['total_paid'] / $goodsData['summary']['total'] * 100;
			$goodsData['summary']['ratio'] = ($goodsData['summary']['ratio'] > 0) ? number_format($goodsData['summary']['ratio'], 1, '.', '') : "0";

			$goodsData['summary']['buy_price']	= $settings->getOption('buy_calc_price', 250);
			$goodsData['summary']['profit']	 	= self::calcProfit($goodsData['summary']);
			$goodsData['summary']['pr_color'] 	= self::profitColor($goodsData['summary']['profit']);

			//раскрашиваем недели
			foreach ($goodsData as $sToken => $dataRow) {
				for ($week_number = 1; $week_number <= $nWeeks; $week_number++) {
					$weekData['avg_cheque']		= round($goodsData[$sToken]['week_avg_cheque'.$week_number]);
					$weekData['total']			= $goodsData[$sToken]['week_total'.$week_number];
					$weekData['paid']				= $goodsData[$sToken]['week_paid'.$week_number];
					$weekData['lead_price']		= round($goodsData[$sToken]['week_lead'.$week_number]);
					$weekData['ratio']			= ($weekData['total']	 > 0) ? ($weekData['paid'] / $weekData['total'] * 100)	 : 0;
					$weekData['buy_price']		= $settings->getOption('buy_calc_price', 250);;

					$goodsData[$sToken]['week_profit'.$week_number] 	= self::calcProfit($weekData);
					$goodsData[$sToken]['week_color'.$week_number] 	= ($weekData['total']	 > 0) ? self::profitColor($goodsData[$sToken]['week_profit'.$week_number]) : self::profitColor(false);

					$weekData['week_profit'] = $goodsData[$sToken]['week_profit'.$week_number];
					$weekData['week_color'] = $goodsData[$sToken]['week_color'.$week_number];
				}
			}
		}

		// $sDebug = $goodsData['summary']['total_cat_sum'];
		// ! debug
		// if (isset($sMainQuery)) $goodsData['message'][0] = "<pre>".$sMainQuery."</pre>";
		// $goodsData['message'][0] = $sDebug;
		// $goodsData['message'][0] = self::dd($lastBuyPrices);//("enable_caching");

		//кешируем результат
		CStatexCache::save('listCategories_'.$sDateRange, $goodsData);

		return $goodsData;
	}

	/**
	 * Выдаёт продажи в категории по дням
	 *
	 * @param $jsonParams - $jsonParams['category_id'] и $jsonParams['date_range']
	 */
	function listCategoryByDay($jsonParams){
		$nCategoryId	= $jsonParams['category_id'];
		$sDateRange 	= $jsonParams['date_range'];
		$skipCache		= $jsonParams['skip_cache'];

		$settings = new StatexSettings;
		$settings->getConfig();

		$lastBuyPrices = self::getLastBPrices($sDateRange);
		$defBuyPrice = $settings->getOption('buy_calc_price', 250);



		//пробуем взять результат из кеша и сразу вернуть, если получилось
		// $cache_result = ($settings->getOption("enable_caching") == 1 && $skipCache == 0) ? CStatexCache::load('listCategoryByDay_'.$sDateRange.'_'.$nCategoryId) : false;
		// if ($cache_result !== false) return $cache_result;

		// $nCategoryId = intval($nCategoryId);
		$goodsData 				= [];
		$avgPrices 				= [];
		$totalForMonth 		= [];
		$totalPaidForMonth	= [];
		$totals_paid 			= [];

		$nDays					= date("t", strtotime($sDateRange));
		$planDayRates				= $settings->getGroup("planfact");

		$q = "SELECT
		DISTINCT `category_id`,
		IF (is_upsell, "._STX_UPSELL_CATEGORY.", `category_id`) as cat_id,
		COUNT(DISTINCT `sales_parsed`.`sale_id`) as total, is_upsell, `sales_parsed`.`quantity`,
		SUM(`sales_parsed`.`price`) as price,
		AVG(`sales_parsed`.`total_sum`) as avg_cheque,
		AVG(`sales_parsed`.`lead_price`) as avg_lead_price,
		SUM(`sales_parsed`.`total_sum`) as total_cat_sum,
		SUM(IF (`sales_parsed`.`status` = 'paid', 1, 0)) as total_paid,
		DAY(FROM_UNIXTIME(`last_update`)) as day_num
		FROM `sales_parsed`
		LEFT JOIN list21 as all_categories on category_id = all_categories.id
		WHERE `sales_parsed`.`status` <> 'special'
		AND is_upsell=0
		AND ".self::getDateRangeQuery($sDateRange);

		if ($nCategoryId > 0) {
			$q .= 	"
					AND `category_id`={$nCategoryId}
					GROUP BY `cat_id`, day_num
					";
		} else {
			$q .= 	"
			GROUP BY day_num
			";
		}
		// self::log($q);


		$res = JBase::Query($q);

		// ! debug
		$sMainQuery = $q;
		// $goodsData['message'][0] = $q;
		// $goodsData[0]['category_name'] = $q;
		// return $goodsData;

		while ($item = $res->fetch_assoc()){
			$sToken = $item['day_num'];

			$goodsData['max_days'] = $nDays;

			if (!isset($goodsData[$sToken])) {
				$goodsData[$sToken]['id']					= $item['category_id'];
				$goodsData[$sToken]['day_num']			= $item['day_num'];
				$goodsData[$sToken]['avg_cheque']		= number_format($item['avg_cheque'], 2, '.', '');
				$goodsData[$sToken]['total_paid']		= "0";
				$goodsData[$sToken]['ratio']				= "0";
				// $goodsData[$sToken]['quantity'] = $item['quantity'];

				$goodsData[$sToken]['lead_price']		= $item['avg_lead_price'];
				$goodsData[$sToken]['is_upsell']			= $item['is_upsell'];
				$goodsData[$sToken]['total_cat_sum']	= $item['total_cat_sum'];

			} else{
				$goodsData[$sToken]['total_cat_sum']	+= $item['total_cat_sum'];
			}

			//подсчитываем оплаченные
			if ($item['status'] = 'paid') {
				$totalPaidForMonth[$sToken] = (isset($totalPaidForMonth[$sToken]))  ? $totalPaidForMonth[$sToken] + $item['total_paid'] : $item['total_paid'];
				$goodsData[$sToken]['total_paid'] = $totalPaidForMonth[$sToken];
				$goodsData[$sToken]['paid'] = $goodsData[$sToken]['total_paid'];
			}

			//суммируем в total количества апрувов
			$totalForMonth[$sToken] = (isset($totalForMonth[$sToken]))  ? $totalForMonth[$sToken] + $item['total'] : $item['total'];
			$goodsData[$sToken]['total'] = $totalForMonth[$sToken];
			$goodsData[$sToken]['ratio']= ($goodsData[$sToken]['total']	 > 0) ? ($goodsData[$sToken]['paid'] / $goodsData[$sToken]['total'] * 100)	 : 0;

			$goodsData[$sToken]['buy_price']			= self::getLastBPrice($item['category_id'], $lastBuyPrices, $defBuyPrice);
			$goodsData[$sToken]['profit'] = self::calcProfit($goodsData[$sToken]);
			$goodsData[$sToken]['pr_color'] 	= self::profitColor($goodsData[$sToken]['profit']);
			// $goodsData[$sToken]['planfact'] 	= self::planFact($goodsData[$sToken]['profit']);

		}


		//считаем план-факт
		$percentDaily 	= 0.55;
		$now = time();//strtotime("2019-12-16");//time();

		$planSkipDays = 0;
		for ($l = 1; $l <= count($planDayRates); $l++) {
			if ($planDayRates["plan_day".$l] > 0) {
				$planSkipDays = $l;
				break;
			}
		}


		for ($day = 1; $day <= $nDays; $day++) {
			$check_date = strtotime($sDateRange."-".$day);
			$datediff = round(($now - $check_date) / (60 * 60 * 24));//разница между датами в днях

			$dayTotal	= (isset($goodsData[$day])) ? $goodsData[$day]['total'] : 0;
			$goodsData[$day]['pfdebug'] =  "";
			$goodsData[$day]['plan'] = 0;
			if (!isset($goodsData[$day]['paid'])) $goodsData[$day]['paid'] = 0;

			if ($datediff > $planSkipDays) {
				for ($k = $planSkipDays; $k <= min($datediff, count($planDayRates)); $k++) {
					$planRate = ($k > count($planDayRates)) ? 0 : $planDayRates["plan_day".$k];
					$goodsData[$day]['plan'] += $planRate/100*$percentDaily*$dayTotal;
					$goodsData[$day]['pfdebug'] .= "<br>"."$k - pr:&nbsp;".$planRate;
				}

				$goodsData[$day]['plan'] =  round($goodsData[$day]['plan']);
				$goodsData[$day]['planfact'] = ($goodsData[$day]['plan'] <=  $goodsData[$day]['paid']) ? "1" : "0";
				$goodsData[$day]['pfdebug'] .= "<br> dd:".$datediff;
			} else {
				$goodsData[$day]['planfact'] = "-";
			}
		}

		// ! debug
		// $goodsData['message'][1] = $sToken;
		// $goodsData['message'][0] = "<pre>".$sMainQuery."</pre>";

		//кешируем результат
		CStatexCache::save('listCategoryByDay_'.$sDateRange.'_'.$nCategoryId, $goodsData);
		return $goodsData;
	}

	/**
		 * Выдаёт продажи товара по дням
		 *
		 * @param $jsonParams['category_id']
		 * @param $jsonParams['good_id']
		 * @param $jsonParams['date_range']
		 */
		function listGoodsByDay($jsonParams){
			$nCategoryId	= intval($jsonParams['category_id']);

			$nGoodId			= intval($jsonParams['good_id']);

			$sDateRange 	= $jsonParams['date_range'];
			$skipCache		= $jsonParams['skip_cache'];

			$settings = new StatexSettings;
			$settings->getConfig();

			$lastBuyPrices = self::getLastBPrices($sDateRange);
			$defBuyPrice = $settings->getOption('buy_calc_price', 250);


			//пробуем взять результат из кеша и сразу вернуть, если получилось
			$cache_result = ($settings->getOption("enable_caching") == 1 && $skipCache == 0) ? CStatexCache::load('listGoodsByDay_'.$sDateRange.'_'.$nCategoryId) : false;
			if ($cache_result !== false) return $cache_result;

			// $nCategoryId = intval($nCategoryId);
			$goodsData 				= [];
			$avgPrices 				= [];
			$totalForMonth 		= [];
			$totalPaidForMonth	= [];
			$totals_paid 			= [];

			$nDays					= date("t", strtotime($sDateRange));
			$planDayRates				= $settings->getGroup("planfact");

			$q = "SELECT
			`good_id`, `sales_parsed`.`name`, `category_id`,`sales_parsed`.status,
			`sales_parsed`.price, lead_price,
			COUNT(`sales_parsed`.`good_id`) as total,
			SUM(`sales_parsed`.`total_sum`) as sum_cheque,
			AVG(`sales_parsed`.`total_sum`) as avg_cheque,
			AVG(`sales_parsed`.`lead_price`) as avg_lead_price,
			SUM(IF (`sales_parsed`.`status` = 'paid', 1, 0)) as total_paid,
			DAY(FROM_UNIXTIME(`last_update`)) as day_num
			FROM `sales_parsed`
			LEFT JOIN list21 as all_categories on category_id = all_categories.id
			WHERE `sales_parsed`.`status` <> 'special'
			AND ".self::getDateRangeQuery($sDateRange)."
			AND `good_id`={$nGoodId}
			GROUP BY `good_id`, day_num
			";

			$res = JBase::Query($q);

			if (empty($res) ) {
				return('Error loading data by day with '.$q);
			}

			// ! debug
			$sMainQuery = $q;
			// $goodsData['message'][0] = $q;
			// $goodsData[0]['category_name'] = $q;
			// return $goodsData;

			while ($item = $res->fetch_assoc()){
				$sToken = $item['day_num'];

				$goodsData['max_days'] = $nDays;

				if (!isset($goodsData[$sToken])) {
					$goodsData[$sToken]['id']					= $item['category_id'];
					$goodsData[$sToken]['day_num']			= $item['day_num'];
					$goodsData[$sToken]['avg_cheque']		= number_format($item['avg_cheque'], 2, '.', '');
					$goodsData[$sToken]['total_paid']		= "0";
					$goodsData[$sToken]['ratio']				= "0";

					$goodsData[$sToken]['lead_price']		= $item['avg_lead_price'];
				}

				//подсчитываем оплаченные
				if ($item['status'] = 'paid') {
					$totalPaidForMonth[$sToken] = (isset($totalPaidForMonth[$sToken]))  ? $totalPaidForMonth[$sToken] + $item['total_paid'] : $item['total_paid'];
					$goodsData[$sToken]['total_paid'] = $totalPaidForMonth[$sToken];
					$goodsData[$sToken]['paid'] = $goodsData[$sToken]['total_paid'];
				}

				//суммируем в total разбитые по неделям количества апрувов
				$totalForMonth[$sToken] = (isset($totalForMonth[$sToken]))  ? $totalForMonth[$sToken] + $item['total'] : $item['total'];
				$goodsData[$sToken]['total'] = $totalForMonth[$sToken];
				$goodsData[$sToken]['ratio']= ($goodsData[$sToken]['total']	 > 0) ? ($goodsData[$sToken]['paid'] / $goodsData[$sToken]['total'] * 100)	 : 0;

				$goodsData[$sToken]['buy_price']		= self::getLastBPrice($item['category_id'], $lastBuyPrices, $defBuyPrice);
				$goodsData[$sToken]['profit']			= self::calcProfit($goodsData[$sToken]);
				$goodsData[$sToken]['pr_color'] 		= self::profitColor($goodsData[$sToken]['profit']);

			}

			//считаем план-факт
			$percentDaily 	= 0.55;
			$now = time();//strtotime("2019-12-16");//time();

			$planSkipDays = 0;
			for ($l = 1; $l <= count($planDayRates); $l++) {
				if ($planDayRates["plan_day".$l] > 0) {
					$planSkipDays = $l;
					break;
				}
			}

			for ($day = 1; $day <= $nDays; $day++) {
				$check_date = strtotime($sDateRange."-".$day);
				$datediff = round(($now - $check_date) / (60 * 60 * 24));//разница между датами в днях

				$dayTotal	= (isset($goodsData[$day])) ? $goodsData[$day]['total'] : 0;
				$goodsData[$day]['pfdebug'] =  "";
				$goodsData[$day]['plan'] = 0;
				if (!isset($goodsData[$day]['paid'])) $goodsData[$day]['paid'] = 0;

				if ($datediff > $planSkipDays) {
					for ($k = $planSkipDays; $k <= min($datediff, count($planDayRates)); $k++) {
						$planRate = ($k > count($planDayRates)) ? 0 : $planDayRates["plan_day".$k];
						$goodsData[$day]['plan'] += $planRate/100*$percentDaily*$dayTotal;
						$goodsData[$day]['pfdebug'] .= "<br>"."$k - pr:&nbsp;".$planRate;
					}

					$goodsData[$day]['plan'] =  round($goodsData[$day]['plan']);
					$goodsData[$day]['planfact'] = ($goodsData[$day]['plan'] <=  $goodsData[$day]['paid']) ? "1" : "0";
					$goodsData[$day]['pfdebug'] .= "<br> dd:".$datediff;
				} else {
					$goodsData[$day]['planfact'] = "-";
				}
			}


			// ! debug
			// $goodsData['message'][0] = $sTokens;
			// $goodsData['message'][0] = "<pre>".$sMainQuery."</pre>";

			//кешируем результат
			CStatexCache::save('listCategoryByDay_'.$sDateRange.'_'.$nCategoryId, $goodsData);
			return $goodsData;
		}

	/**
		 * Выдаёт продажи веба по дням
		 *
		 * @param $jsonParams['good_id']
		 * @param $jsonParams['wm_id']
		 * @param $jsonParams['date_range']
		 */
		function listSellersByDay($jsonParams){
			$nGoodId			= intval($jsonParams['good_id']);
			$nWmId			= intval($jsonParams['wm_id']);
			$skipCache		= $jsonParams['skip_cache'];
			$sDateRange 	= $jsonParams['date_range'];

			$settings = new StatexSettings;
			$settings->getConfig();

			$lastBuyPrices = self::getLastBPrices($sDateRange);
			$defBuyPrice = $settings->getOption('buy_calc_price', 250);


			//пробуем взять результат из кеша и сразу вернуть, если получилось
			$cache_result = ($settings->getOption("enable_caching") == 1 && $skipCache == 0) ? CStatexCache::load('listSellersByDay_'.$sDateRange.'_'.$nGoodId.'_'.$nWmId) : false;
			if ($cache_result !== false) return $cache_result;

			// $nCategoryId = intval($nCategoryId);
			$goodsData 				= [];
			$avgPrices 				= [];
			$totalForMonth 		= [];
			$totalPaidForMonth	= [];
			$totals_paid 			= [];

			$nDays					= date("t", strtotime($sDateRange));
			$planDayRates				= $settings->getGroup("planfact");

			$q = "SELECT
			`good_id`, `sales_parsed`.`name`, `category_id`,`sales_parsed`.status,
			`sales_parsed`.price, lead_price, webmaster_id,
			COUNT(`sales_parsed`.`good_id`) as total,
			SUM(`sales_parsed`.`total_sum`) as sum_cheque,
			AVG(`sales_parsed`.`total_sum`) as avg_cheque,
			AVG(`sales_parsed`.`lead_price`) as avg_lead_price,
			SUM(IF (`sales_parsed`.`status` = 'paid', 1, 0)) as total_paid,
			DAY(FROM_UNIXTIME(`last_update`)) as day_num
			FROM `sales_parsed`
			WHERE `sales_parsed`.`status` <> 'special'
			AND ".self::getDateRangeQuery($sDateRange)."
			AND `good_id`={$nGoodId}
			AND `webmaster_id`={$nWmId}
			GROUP BY `good_id`, webmaster_id, day_num
			";

			$res = JBase::Query($q);

			if (empty($res) ) {
				return('Error loading data by day with '.$q);
			}

			// ! debug
			$sMainQuery = $q;
			// $goodsData['message'][0] = $q;
			// $goodsData[0]['category_name'] = $q;
			// return $goodsData;

			while ($item = $res->fetch_assoc()){
				$sToken = $item['day_num'];

				$goodsData['max_days'] = $nDays;

				if (!isset($goodsData[$sToken])) {
					$goodsData[$sToken]['id']					= $item['category_id'];
					$goodsData[$sToken]['day_num']			= $item['day_num'];
					$goodsData[$sToken]['avg_cheque']		= number_format($item['avg_cheque'], 2, '.', '');
					$goodsData[$sToken]['total_paid']		= "0";
					$goodsData[$sToken]['ratio']				= "0";

					$goodsData[$sToken]['lead_price']		= $item['avg_lead_price'];
				}

				//подсчитываем оплаченные
				if ($item['status'] = 'paid') {
					$totalPaidForMonth[$sToken] = (isset($totalPaidForMonth[$sToken]))  ? $totalPaidForMonth[$sToken] + $item['total_paid'] : $item['total_paid'];
					$goodsData[$sToken]['total_paid'] = $totalPaidForMonth[$sToken];
					$goodsData[$sToken]['paid'] = $goodsData[$sToken]['total_paid'];
				}

				//суммируем в total разбитые по неделям количества апрувов
				$totalForMonth[$sToken] = (isset($totalForMonth[$sToken]))  ? $totalForMonth[$sToken] + $item['total'] : $item['total'];
				$goodsData[$sToken]['total'] = $totalForMonth[$sToken];
				$goodsData[$sToken]['ratio']= ($goodsData[$sToken]['total']	 > 0) ? ($goodsData[$sToken]['paid'] / $goodsData[$sToken]['total'] * 100)	 : 0;

				$goodsData[$sToken]['buy_price']		= self::getLastBPrice($item['category_id'], $lastBuyPrices, $defBuyPrice);
				$goodsData[$sToken]['profit'] 		= self::calcProfit($goodsData[$sToken]);
				$goodsData[$sToken]['pr_color'] 		= self::profitColor($goodsData[$sToken]['profit']);

			}

			//считаем план-факт
			$percentDaily 	= 0.55;
			$now = time();//strtotime("2019-12-16");//time();

			$planSkipDays = 0;
			for ($l = 1; $l <= count($planDayRates); $l++) {
				if ($planDayRates["plan_day".$l] > 0) {
					$planSkipDays = $l;
					break;
				}
			}

			for ($day = 1; $day <= $nDays; $day++) {
				$check_date = strtotime($sDateRange."-".$day);
				$datediff = round(($now - $check_date) / (60 * 60 * 24));//разница между датами в днях

				$dayTotal	= (isset($goodsData[$day])) ? $goodsData[$day]['total'] : 0;
				$goodsData[$day]['pfdebug'] =  "";
				$goodsData[$day]['plan'] = 0;
				if (!isset($goodsData[$day]['paid'])) $goodsData[$day]['paid'] = 0;

				if ($datediff > $planSkipDays) {
					for ($k = $planSkipDays; $k <= min($datediff, count($planDayRates)); $k++) {
						$planRate = ($k > count($planDayRates)) ? 0 : $planDayRates["plan_day".$k];
						$goodsData[$day]['plan'] += $planRate/100*$percentDaily*$dayTotal;
						$goodsData[$day]['pfdebug'] .= "<br>"."$k - pr:&nbsp;".$planRate;
					}

					$goodsData[$day]['plan'] =  round($goodsData[$day]['plan']);
					$goodsData[$day]['planfact'] = ($goodsData[$day]['plan'] <=  $goodsData[$day]['paid']) ? "1" : "0";
					$goodsData[$day]['pfdebug'] .= "<br> dd:".$datediff;
				} else {
					$goodsData[$day]['planfact'] = "-";
				}
			}

			// ! debug
			// $goodsData['message'][0] = $sTokens;
			// $goodsData['message'][0] = "<pre>".$sMainQuery."</pre>";

			//кешируем результат
			CStatexCache::save('listSellersByDay_'.$sDateRange.'_'.$nGoodId.'_'.$nWmId, $goodsData);
			return $goodsData;
		}


		/**
	 * Считает прибыль одного товара
	 *
	 * @param $goodsData['avg_cheque'] средний чек
	 * @param $goodsData['total'] количество апрувов за весь период по этому товару
	 * @param $goodsData['lead_price'] Цена лида. Должно браться из поля товара goods.lead_price
	 * @param $goodsData['ratio'] Процент выкупа - подставляется из аналитики по товару за период (неделя/месяц)
	 * @param $goodsData['buy_price'] цена выкупа - своя для каждой категории и даты, берётся из модуля BPrice
	 */

	function calcProfit($goodsData) {
		$settings = new StatexSettings;
		$settings->getConfig();
		/**
		 * Цена продажи товара - Оставляется пустым
		*/
		$vals_price = 0;

		/**
		 * Цена доставки - фиксированное значение, равное 350
		 * Аутсорсинг - фиксированное значение, равное 80
		 * Стоимость кц - фиксированное значение, равное 160
		 */
		$vals_price_call = $settings->getOption('vals_price_call', 0);
		$vals_price_outsourcing = $settings->getOption('vals_price_outsourcing', 0);
		$vals_price_delivery = $settings->getOption('vals_price_delivery', 0);

		/**
		* Кол-во отправок - количество апрувов за весь период по этому товару (берется из срм)
		*/
		$vals_count_delivery = $goodsData['total'];

		$price_delivery = $vals_count_delivery*($vals_price_delivery + $vals_price_call + $vals_price_outsourcing);
		// $price_delivery = 350;

		/**
		 * Цена доставки для клиента - средний чек товара (берется из срм)
		 * */
		$vals_price_delivery_client = $goodsData['avg_cheque'];

		/**
		 * цена возврата неоплаченных посылок - Ставим 0
		*/
		$price_back = 0;

		/**
		* Цена лида. Должно браться из поля товара goods.lead_price
		*/
		$vals_price_lead = $goodsData['lead_price'] * $settings->getOption('lead_price_ratio', 1);

		/**
		* Цена закупа. Должно браться из поля товара list22.price <= поменяли на постоянную, которую берём из настроек
		*/
		$vals_price_nominal = $goodsData['buy_price'];//$settings->getOption('buy_calc_price', 250);

		/**
		* РКО + комиссии - фиксированное значение, равное 6,5%
		*/
		$vals_perc_fee = $settings->getOption('rko_fee', 6.5);

		/**
		* Процент выкупа - подставляется из аналитики по товару за период (неделя/месяц)
		*/
		$vals_perc_delivery = $goodsData['ratio'];

		// стоимость всех купленных лидов
		$price_leads_full = $vals_price_lead * $vals_count_delivery;


		// стоимость всех купленных товаров
		$price_nominal_full = $vals_count_delivery * $vals_price_nominal;
		// if (bIsUpsell) {
		// 	$price_nominal_full += $vals_count_delivery * $vals_price_nominal_upsell * $vals_perc_upsell / 100;
		// }

		// Валовый доход
		$price_income_full = $vals_count_delivery * ($vals_price + $vals_price_delivery_client) * $vals_perc_delivery /	100;
		// if (bIsUpsell) {
		// 	$price_income_full += $vals_count_delivery * $vals_price_upsell * $vals_perc_upsell / 100;
		// }
		// налоги
		$price_taxes_full = 0;

		if ($vals_perc_fee > 0) { // РКО+комиссии
			$price_taxes_full += $price_income_full * $vals_perc_fee / 100;
		}

		// расход
		$price_outcome_full = $price_delivery + $price_back + $price_leads_full + $price_nominal_full + $price_taxes_full;

		// прибыль
		$price_profit = $price_income_full - $price_outcome_full;

		// деньги в товаре
		$price_goods = $price_nominal_full * (1 - $vals_perc_delivery / 100);
		// if ($('#back:checked').val() != 1) {
		// 	$price_goods = 0;
		// }

		// Прибыль с учетом возвратов
		$price_profit_with_back = $price_profit + $price_goods;

		$price_profit_per_sale = 0;
		$price_profit_with_back_per_sale = 0;
		if ($vals_count_delivery > 0) {
			// Чистая прибыль на 1 отправку (без учета возвратов)
			$price_profit_per_sale = $price_profit / $vals_count_delivery;

			// Чистая прибыль на 1 отправку (с учетом возвратов)
			$price_profit_with_back_per_sale = $price_profit_with_back / $vals_count_delivery;
		}

		$roi_perc = 0;
		$roi_perc_with_back = 0;
		if ($price_outcome_full != 0) {
			// ROI без учета возвратов
			$roi_perc = $price_profit * 100 / $price_outcome_full;

			// Roi с учетом возвратов
			$roi_perc_with_back = $price_profit_with_back * 100 / $price_outcome_full;
		}


		// $price_income_full = round($price_income_full);

		//

		return number_format($price_profit_per_sale /100, 1, '.', '').//;//round($price_profit_per_sale/100);
		//  @self::dd( $goodsData['buy_price']).
			// "<br>\n".
				// "vals_price_nominal: ".round($vals_price_nominal)."<br>\n".
				// "price_delivery: ".round($price_delivery)."<br>\n".
				// "price_leads_full: ".round($price_leads_full)."<br>\n".
				// "price_nominal_full: ".round($price_nominal_full)."<br>\n".
				// "price_income_full: ".round($price_income_full)."<br>\n".
				// "price_outcome_full: ".round($price_outcome_full)."<br>\n".
				// "price_profit: ".round($price_profit)."<br>\n".
				// "price_profit_per_sale: ".round($price_profit_per_sale)."<br>\n".
				// "price_income_full == count_delivery: $vals_count_delivery * (price: $vals_price + price_delivery_client:$vals_price_delivery_client) * perc_delivery: $vals_perc_delivery /100".
				"";
	}
/**
 * Считает план/факт
 * @param int $total - общее число продаж на дату
 * @param int $fact - сколько продали по факту
 * @param int $day - день месяца
 * @param array $planRates - коэффициенты по дням, берутся из настроек
 *
 * @return string "+" или "-" (больше/равно плана или меньше)
 */
	function planFact($total, $fact, $day, $planRates){
		$res = "";
		if ($day > count($planRates)-1) $day = count($planRates)-1;

		$plan = $total * $planRates[$day];

		if ($fact >= $plan ) {
			$res = "+";
		} else {
			$res = "-";
		}

		return $res;
	}

/**
 * Выдаёт цвет по рассчитанному профиту
 * @param $profit - результат калькулятора или false для наихудшего цвета
 */
	function profitColor($profit) {
		$aColors = [
		//Оттенки Бурого красного
		// "#490515",
		// "#5a0515",
		"#600314",
		"#6a0d1a",
		"#740412",
		"#8a071a",
		"#91081d",
		"#9c0821",
		"#9d0520",
		"#a20822",
		"#ab0725",
		//Оттенки Красного
		"#b40629",
		"#bc042b",
		"#c40e2a",
		//Оттенки Оранжевого
		"#c43c20",
		"#c35700",
		"#c66900",
		//Оттенки Желтого
		"#ce8f00",
		"#d2a200",
		"#d6b400",
		"#dac600",
		//Оттенки Зеленого
		"#9ec113",
		"#86b918",
		//Оттенки Голубого
		"#51b387",
		"#03b6da",
		"#09a9d4",
		"#119ccd",
		"#178ec6",
		"#1d81be",
		"#2373b6",
		"#2764ad",
		"#2a57a5",
		];

		if ($profit === false) {
			return $aColors[0];
		}

		$profit = (float) $profit;
		$cIndex = round($profit*2) + 9;
		if ($cIndex < 0) $cIndex = 0;
		if ($cIndex >= count($aColors)) $cIndex = count($aColors)-1;

		return $aColors[$cIndex];
	}

	/**
	 * ----------------------------
	 *           ДАТЫ
	 * ----------------------------
	 */

	/**
	 * Возвращает часть для запроса временного интервала
	 * от 1-го до последнего числа данного года-месяца
	 *
	 * @param $sDateRange - дата, строка в формате "год-месяц": 2020-1, 2019-12, 2019-11 ..
	 * @param $fieldName - поле даты (timestamp), по которому ведётся поиск
	 */
	function getDateRangeQuery($sDateRange, $fieldName='last_update'){
		$sDateStart = date("Y-m-01", strtotime($sDateRange)); //первый день месяца
		$sDateEnd = date("Y-m-t", strtotime($sDateRange));//последний день месяца

		$sQueryPart = "DATE(FROM_UNIXTIME(`$fieldName`)) BETWEEN '{$sDateStart}' AND '{$sDateEnd}'";
		return $sQueryPart;
	}

	/**
	 * Возвращает количество недель в месяце
	 */
	function getWeekCount($monthdate) {
		//получаем первый понедельник месяца
		$dt = new DateTime('first Monday of '.$monthdate);
		// $firstMonday = $dt->format('Y-m-d');
		$dFirstMonday = $dt->format('d');

		//то, насколько надо сместить календарь назад, чтобы 1-е число
		//совпало с понедельником
		$startDelta = 7-$dFirstMonday+1;
		if ($startDelta == 7) $startDelta = 0;
		echo("startDelta: ".$startDelta."\n");

		//последний день месяца
      $dt = new DateTime('last day of '.$monthdate);
		// $lastDay = $dt->format('Y-m-d');
		$dLastDay = $dt->format('d');

		$daysLeft  = $dLastDay;
		$dayStart  = 1;
		$dayEnd    = 7-$startDelta;

		$nWeek = 1;
		while($daysLeft > 0) {
			//считаем следующую неделю
			$daysLeft   = $daysLeft - ($dayEnd - $dayStart) -1;
			$dayStart   = $dayEnd+1;
			$dayEnd     = $dayStart+6;
			if ($dayEnd > $dLastDay) $dayEnd = $dLastDay;
			$nWeek++;
		}

		return ($nWeek-1);
   }


	/**
	* Возвращает частичный запрос для разбиения вычисления номера недели в поле `week_number`,
	* количество недель в месяце в поле `week_count`
	* $monthdate = дата в формате "год-месяц": 2020-1, 2019-12, 2019-11 ..
	*
	*/
	function getWeeksQuery($monthdate, $dateField = 'last_update') {
		$arrWeeks = [];

		//получаем первый понедельник месяца
		$dt = new DateTime('first Monday of '.$monthdate);
		// $firstMonday = $dt->format('Y-m-d');
		$dFirstMonday = $dt->format('d');

		//то, насколько надо сместить календарь назад, чтобы 1-е число
		//совпало с понедельником
		$startDelta = 7-$dFirstMonday+1;
		if ($startDelta == 7) $startDelta = 0;
		echo("startDelta: ".$startDelta."\n");

		//последний день месяца
      $dt = new DateTime('last day of '.$monthdate);
		// $lastDay = $dt->format('Y-m-d');
		$dLastDay = $dt->format('d');

		$daysLeft  = $dLastDay;
		$dayStart  = 1;
		$dayEnd    = 7-$startDelta;

		$nWeek = 1;
		while($daysLeft > 0) {
			$arrWeeks[$nWeek] = 'WHEN (DATE(FROM_UNIXTIME(`'.$dateField.'`)) BETWEEN "'.($monthdate."-".$dayStart).'" AND "'.($monthdate."-".$dayEnd).'") THEN "'.$nWeek.'"'; //$monthdate.'-'.

			//считаем следующую неделю
			$daysLeft   = $daysLeft - ($dayEnd - $dayStart) -1;
			$dayStart   = $dayEnd+1;
			$dayEnd     = $dayStart+6;
			if ($dayEnd > $dLastDay) $dayEnd = $dLastDay;
			$nWeek++;
		}



		$sQuery = "CASE \n".join(" \n",$arrWeeks)."\n END as week_number,\n ".($nWeek-1)." as week_count ";

		return $sQuery;
	}

	/**
	 * Sends report to a private channel
	 *
	 * channel name @1v1_statex_update
	 * invite link is https://t.me/joinchat/AAAAAFkm5VMErPyqy1ciXQ
	 */
	function sendReport(){
		$token = '942550807:AAHp-TIZscXnFlH_UDnmXVS848dRL9-OU6s';
		$chat_id = "-1001495721299";
		$text = "";

		$sDateRange = date("Y-m", strtotime("first day of previous month"));

		$par = [
			"category_id" => "0",
			"date_range" => $sDateRange,
			"skip_cache" => 1,
			"extra_query" => " ORDER BY category_id, good_id"
		];


		$goods = self::listGoods($par);

		$arrMessages = [];
		$arrMessages[0] =
		"~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~\n
		<b>Товары с рейтингом &lt; 1: (__count__) за ".$sDateRange."</b>\n
		~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~\n";

		$cnt=0;
		$lastcat=0;
		foreach ($goods as $good) {

			if ($good['profit'] < 1 && $good['is_upsell'] == 0) {
				$text .= "<code>".$good['id']."\t".$good['name']."\t<b>".$good['profit']."</b></code>";
				$text .= "\n";
				$cnt++;
			}

			if ($cnt % 50 == 0) {
				$arrMessages[] = $text;
				$text = "";
			}

			if ($lastcat != $good['category_id']) {
				// $arrMessages[] = "<code> Категория ".$good['category_id']."</code>\n";
			}
			$lastcat = $good['category_id'];
		}

		$arrMessages[] = $text;
		$arrMessages[0] =  str_replace("__count__", $cnt, $arrMessages[0]);
		// $arrMessages[] = "------------- конец отчёта ---------------";



		// $text = "Товары с рейтингом &lt; 1:";
		// $text = self::dd($goods[0]['id'],false);

		$cnm = 0;
		foreach ($arrMessages as $message) {
			if ($message != "") {
				$text= rawurlencode($message);
				$sendToTelegram = file_get_contents("https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&parse_mode=HTML&text={$text}","r");
				usleep(500000);
				$cnm++;
			}
		}

		return "report sent ~\_(^.^)_/~ : ".$cnm." message(s)";
	}

}


