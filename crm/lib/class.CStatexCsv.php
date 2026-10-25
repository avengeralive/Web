<?php
namespace lib;

trait CStatexCsv{
	/**
	* Выдаём список категорий, доступных на дату
	* @param $sDateRange - диапазон дат типа "2020-01"
	* @return массив пар id=>name
	*/
	function getCatList($sDateRange)	{

		$q = "SELECT
			`category_id` as id, all_categories.name as name
			FROM `sales_parsed`
			LEFT JOIN list21 as all_categories on category_id = all_categories.id
			WHERE ".self::getDateRangeQuery($sDateRange)."
			GROUP BY `category_id`
			";
		$res = JBase::Query($q);

		$arrResult = [];
		if (!empty($res)){
			while ($row = $res->fetch_assoc()) {
				$arrResult[$row['id']] = $row['name'];
			}
		}

		return $arrResult;
	}

	function quoteCsv($val){
		$val = str_replace(";", "\;", $val);
		$val = str_replace("\\", "\\\\", $val);
		$val = str_replace("\"", "\\\"", $val);
		$val = '"'.$val.'"';
		return $val;
	}

	/**
	 * Загружает кешированный запрос
	 * Если его нет, возвращает false
	 *
	 * @param $query_name - название запроса, который возьмем из кеша
	 */
	function getCsv($jsonParams){
		$sDateRange		= trim($jsonParams['date_range']);
		$day_start		= trim($jsonParams['day_start']);
		$day_end			= trim($jsonParams['day_end']);
		$category_ids	= trim($jsonParams['category_ids']);
		$show_upsell	= $jsonParams['show_upsell'];
		$show_summary	= $jsonParams['show_summary'];
		$show_onlysummary	= $jsonParams['show_onlysummary'];
		$show_statuses	= $jsonParams['show_statuses'];

		$qCategory	= (substr($category_ids, 0, 1) == '0') ? "" : " AND `category_id` IN ($category_ids) ";
		$qStatuses = " AND sp.status IN ('".join("','", explode(",",$show_statuses))."') ";
		if ($show_upsell == "1") {
			$qUpsell =  " ";
			$qUpsellField =  " , sp.is_upsell";
			$qUpsellTitle =  "upsell?;";
		} else {
			$qUpsell = " AND sp.is_upsell = 0 ";
			$qUpsellField = "";
			$qUpsellTitle =  "";
		}

		$q = "SET NAMES 'cp1251' COLLATE 'cp1251_general_ci'";
		$res = JBase::Query($q);

		$q = "SELECT
		sp.status, categories.id as cat_id, categories.name as category, sp.sale_id, sp.good_id, sp.name, sp.price, sp.total_sum as basket_total, sp.quantity, sp.webmaster_id as web,
		DATE_FORMAT(FROM_UNIXTIME(sp.last_update), '%Y-%m-%d %k:%i') as date, sp.lead_price $qUpsellField

		FROM `sales_parsed` as sp
		LEFT JOIN list21 as categories on category_id = categories.id
		WHERE DATE(FROM_UNIXTIME(last_update)) BETWEEN '$sDateRange-$day_start' AND '$sDateRange-$day_end'
		$qCategory
		$qStatuses
		$qUpsell
		order by status, categories.id, sale_id";

		$res = JBase::Query($q);

		$arrCatSummary = [];

		$cnt = 0;
		$sCSV = ($show_onlysummary) ? "" : "status;cat_id;category;sale_id;good_id;name;price;basket_total;quantity;web;date;lead;$qUpsellTitle;\n";
		if ($res && !empty($res)){
			while( $row = $res->fetch_assoc()) {

				if (isset($arrCatSummary[$row['category']]) && isset($arrCatSummary[$row['category']][$row['status']])) {
					$arrCatSummary[$row['category']][$row['status']]++;
				} else {
					$arrCatSummary[$row['category']][$row['status']] = 1;
				}

				if (!$show_onlysummary) {
					foreach ($row as $v) {
						$sCSV .= self::quoteCsv($v).";";
					}
					$sCSV .= "\n";
				}
				$cnt++;
			}

		}

		if ($show_summary) {
			$sCSV .= ($show_onlysummary) ? "" : ";;;;;;;;;;;;;\n";
			$sCSV .= "category;total;status;count;;;;;;;;;;\n";

			$megaTotal = 0;

			foreach ($arrCatSummary as $cat => $arrStat) {
				$subTotal = 0;
				foreach ($arrStat as $k=>$v) {
					$sCSV .= "$cat;;$k;$v;;;;;;;;;;\n";
					$megaTotal += $v;
					$subTotal += $v;
				}
				$sCSV .= "$cat;$subTotal;;;;;;;;;;;;\n";
			}

			$sCSV .= self::quoteCsv('>>>>').";$megaTotal;;;;;;;;;;;;\n";
		}


		// return self::dd($jsonParams)."<pre>$q</pre>"."<pre>$sCSV</pre>";
		// header('Content-Description: File Transfer');
		// header('Content-Type: application/octet-stream');
		// header('Content-Disposition: INLINE; filename=doma-bitovki.html');
		// header('Content-Transfer-Encoding: binary');
		// header('Expires: 0');
		// header('Cache-Control: must-revalidate');
		// header('Pragma: public');
		// header('Content-Length: ' . strlen($sCSV));
		$path = substr(__DIR__, 0, strrpos(__DIR__, "/"))."/csv";
		$filename = "export_".date("Y-m-d").".csv";
		$file = $path."/".$filename;

		// if (file_exists($file)) unlink($file);
		file_put_contents($file, $sCSV);
		// echo($sCSV);

		$arrResult = array(
			'count'=> $cnt,
			'url' => "/csv/".$filename,
		);
		return $arrResult;
	}

}
?>