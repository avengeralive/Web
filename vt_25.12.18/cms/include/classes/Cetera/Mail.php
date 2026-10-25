<?php
namespace Cetera; 

/**
 * Почта.
 * 
 * @package CeteraCMS
 */ 
class Mail {

	private static $events = array();
	
	public static function addEvent($id,$name)
	{
		if isset(self::$events[$id]) throw new \Exception('Почтовое событие "'.$id.'" уже зарегистрировано');
		self::$events[$id] = $name;
	}
	
	public static function triggerEvent($id,$name)
	{
	}		
    
}