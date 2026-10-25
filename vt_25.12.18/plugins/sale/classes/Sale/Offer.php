<?php
namespace Sale;

/*
* Торговое предложение
*/
class Offer extends Buyable
{
	
	const TABLE = 'sale_offers';
	
	public function getDiscount()
	{
		if (!$this->product) {
			$value = 0;
		}
		else {
			$value = $this->product->getDiscount();
		}
		return $value;
	}
	
}