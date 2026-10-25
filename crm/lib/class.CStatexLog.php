<?php
namespace lib;

/*
CREATE TABLE `statex_log` (
  `id` int NULL AUTO_INCREMENT PRIMARY KEY,
  `timestamp` int(11) NOT NULL,
  `message` text NOT NULL,
  `user` varchar(255) NOT NULL AFTER `message`,
  `group` varchar(255) NOT NULL AFTER `user`;
) ENGINE='InnoDB' COLLATE 'utf8_general_ci';
*/

trait CStatexLog {
	/**
	* Записывает одно или несколько сообщений в лог
	* @param $sMessages - одна или несколько строк
	* @return результат запроса
	*/
	function log(...$sMessages)	{
		global $RoleGroup;
		global $RoleUser;

		$sMessage = "";
		foreach ($sMessages as $s) {
			if (is_array($s)) $s = self::dd($s, false)."\n";

			$sMessage .= $s."\n--------\n";
	  }

	   $sMessage = JBase::$mysqli_pool->real_escape_string($sMessage);

		$q = "INSERT INTO `statex_log` (`timestamp`, `message`, `user`, `group`)
		VALUES (UNIX_TIMESTAMP(), '{$sMessage}', '".
		(defined(USERID) ? USERID : $RoleUser).
		"', '{$RoleGroup}');
			";
		$res = JBase::Query($q);

		return "Logged ($res):".$sMessage;
	}


}
?>