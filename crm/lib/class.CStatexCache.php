<?php
namespace lib;

trait CStatexCache{
	var $query_name;
	/**
	* Сохраняет массив с результатом в кеш
	* @param $query - название запроса, который кешируем
	* @param $arrResult - массив с её результатами
	*/
	function save($query_name, $arrResult)	{

		$q = "DELETE FROM `statex_cache`
		WHERE ((`query_name` = '{$query_name}'));";
		$res = JBase::Query($q);

		//сообщения не должны кешироваться
		if (isset($arrResult["message"])) {
			unset($arrResult["message"]);
		}

		$safeJson = JBase::$mysqli_pool->real_escape_string(json_encode($arrResult,  JSON_UNESCAPED_UNICODE));
		// $safeJson =  preg_replace('~[\x00\x0A\x0D\x1A\x22\x27\x5C]~u', '\\\$0', $json);
		$q = "INSERT INTO `statex_cache` (`query_name`, `result`)
		VALUES ('$query_name', '$safeJson');";
		$res = JBase::Query($q);

		$sResult = ($res) ? 'ok' : 'something wrong: '.JBase::$mysqli_pool->error.'<br> query was: <br>'.$q;
		return $sResult;
	}

	/**
	 * Загружает кешированный запрос
	 * Если его нет, возвращает false
	 *
	 * @param $query_name - название запроса, который возьмем из кеша
	 */
	function load($query_name){
		$q = "SELECT `result` FROM `statex_cache`
		WHERE ((`query_name` = '{$query_name}'));";
		$res = JBase::Query($q);

		if (!empty($res)){
			$row = $res->fetch_assoc();
			if (is_array($row) && count($row) > 0) {
				return json_decode($row['result'], true);
			}
		}

		return false;
	}

	/**
	 * Проверяет, есть ли кеш такого запроса.
	 * Если есть, возвращает его дату
	 */
	function exists($query_name){
		$q = "SELECT `last_time` FROM `statex_cache`
		WHERE ((`query_name` = '{$query_name}'));";
		$res = JBase::Query($q);

		if (!empty($res)){
			$row = $res->fetch_assoc();
			if (is_array($row) && count($row) > 0) {
				return $row['last_time'];
			}
		}

		return false;
	}

	/**
	 * Удаляет кеш (выбранного запроса или весь)
	 * @param $query_name - (необязательно) название запроса, который надо удалить из кеша
	 */
	function clear($query_name){
		if ($query_name == "%*%") {
			$q = "TRUNCATE `statex_cache`;";
		} else {
			$q = "DELETE FROM `statex_cache`	WHERE `query_name` LIKE '{$query_name}';";
		}
		$res = JBase::Query($q);
		return $res;
	}
}
?>