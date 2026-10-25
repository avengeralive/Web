<?php
namespace Sale;

abstract class Buyable extends \Cetera\Material
{
	
	protected static $priceDecimals = null;
	
	public static function fetch($data)
	{
		return parent::fetch($data,  self::getObjectDefinition() );
	}
	
	public static function getById($id)
    {
		return parent::getById($id,  self::getObjectDefinition() );
    }	
	
	public static function getObjectDefinition()
	{
		return \Cetera\ObjectDefinition::findByAlias(static::TABLE);
	}
	
	abstract public function getDiscount();
	
	public function getCurrency()
	{
		return 'RUB';
	}	
	
	public function getPriceDecimals()	
	{
		if (self::$priceDecimals === null) {
			self::$priceDecimals = \Sale\Setup::configGet( 'price_decimals' );
			if (self::$priceDecimals === null) {
				self::$priceDecimals = 2;
			}
		}
		return self::$priceDecimals;
	}

	public function canBuy($quantity = 1)
	{
		if ( !\Sale\Setup::configGet( 'use_quantity' ) ) return true;
		if ($this->quantity >= $quantity) return true;
		return false;
	}	

	public function getDisplayPrice()
	{
		return static::formatPrice($this->price);
	}
	
	public function getDisplayDiscountPrice()
	{
		return static::formatPrice($this->getDiscountPrice());
	}

	public function getDisplayFullPrice()
	{
		return static::formatPrice($this->getFullPrice());
	}	
	
	public function getDisplayDiscount()
	{
		return static::formatPrice($this->getDiscount());
	}	
	
	public function getPrice()
	{
		return $this->getDiscountPrice();
	}

	public function getFullPrice()
	{
		return round($this->getDynamicField('price'), $this->getPriceDecimals());
	}	
	
	public function getDiscountPrice()
	{
		return $this->getFullPrice() - $this->getDiscount();
	}	

	public static function formatPrice($value)
	{
		$price = number_format($value,2,',','&nbsp;');
		$price = str_replace(',00','',$price);
		return $price.'&nbsp;руб.';
	}	
	
}