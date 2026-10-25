<?php
	class mysqliDebug extends Mysqli{
		public function query( $query , $p ){
			$s=microtime(1);
			$r=parent::query($query);
			$e=microtime(1)-$s;
	
			@file_put_contents(dirname(__FILE__).'/../logs/db', round($e, 4)."\t".$query.PHP_EOL, FILE_APPEND);
			return $r;
		}
	}