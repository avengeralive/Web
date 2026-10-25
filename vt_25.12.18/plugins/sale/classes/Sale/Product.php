<?php
namespace Sale;

class Product extends Buyable
{
	const TABLE = 'sale_products';
	
	private static $discountData = null;
	
	private $discount = null;
	private $offers = null;

	public function isInWishlist()
	{
		$product = $this->id;
		$wish = \Sale\WishList::get();
		return $wish->checkProduct($product);
	}
		
	public function getDiscount()
	{
		if ($this->discount === null) {

			if (self::$discountData === null) {
				self::$discountData = self::getDbConnection()->fetchAll('SELECT * FROM sale_discount WHERE active=1 ORDER BY priority');
				foreach (self::$discountData as $key => $value) {
					self::$discountData[$key]['conditions'] = json_decode($value['conditions'], true);
				}
			}
			
			$this->discount = 0;
					
			foreach (self::$discountData as $discount) {
							
				if (!$this->checkCondition($discount['conditions'])) continue;

				switch ($discount['value_type']) {
					case 0:
						$value = $discount['value'] * $this->getPrice()/100;
						break;
					case 1:
						$value = $discount['value'];
						break;
					case 2:
						$value = $this->getPrice() - $discount['value_type'];
						break;
					default: 
						$value = 0;
				}
				
				if ($discount['max_discount'] && $value > $discount['max_discount']) $value = $discount['max_discount'];
				
				$this->discount = $this->discount + $value;
				
				if ($discount['last_discount']) break;			
			}
			$this->discount = round($this->discount, $this->getPriceDecimals());
			
		}
		return $this->discount;
	}
		
	private function checkCondition($conditions)
	{
		$fields = $this->getFieldsDef();
	
		foreach ($conditions['conditions'] as $condition) {
			
			$match = false;
						
			try {	

				if (!isset($fields[$condition['field']])) throw new \Exception('Field "'.$condition['field'].'" does not exist');
			
				$field = $fields[$condition['field']];
				$field_value = $this->getDynamicField($condition['field']);
				
				if ($condition['field'] == 'idcat') {
					if ($condition['condition'] == 'eq') {
						$match = $field_value == $condition['value'];
					}	
					elseif ($condition['condition'] == 'neq') {
						$match = $field_value != $condition['value'];
					}
					elseif ($condition['condition'] == 'like') {
						$match = $this->catalog->getPath()->has($condition['value']);
					}
					elseif ($condition['condition'] == 'not_like') {
						$match = !$this->catalog->getPath()->has($condition['value']);
					}	
				}
				else {
					switch ($field['type']) {
						
						case FIELD_LINK:
						case FIELD_MATERIAL:
						case FIELD_FORM:
							if ($condition['condition'] == 'eq') {
								$match = $field_value->id == $condition['value'];
							}
							elseif ($condition['condition'] == 'neq') {
								$match = $field_value->id != $condition['value'];
							}
							break;
							
						case FIELD_INTEGER:
						case FIELD_DOUBLE:
						case FIELD_BOOLEAN:
							if ($condition['condition'] == 'eq') {
								$match = $field_value == $condition['value'];
							}	
							elseif ($condition['condition'] == 'neq') {
								$match = $field_value != $condition['value'];
							}
							elseif ($condition['condition'] == 'gt') {
								$match = $field_value >= $condition['value'];
							}
							elseif ($condition['condition'] == 'lt') {
								$match = $field_value < $condition['value'];
							}
							break;
							
						case FIELD_TEXT:
						case FIELD_LONGTEXT:
						case FIELD_FILE:
						case FIELD_DATETIME:
						case FIELD_ENUM:
						case FIELD_HUGETEXT:
							if ($condition['condition'] == 'eq') {
								$match = $field_value == $condition['value'];
							}	
							elseif ($condition['condition'] == 'neq') {
								$match = $field_value != $condition['value'];
							}
							elseif ($condition['condition'] == 'like') {
								$match = mb_substr_count ( mb_strtolower($field_value) , mb_strtolower($condition['value']) ) > 0;
							}
							elseif ($condition['condition'] == 'not_like') {
								$match = mb_substr_count ( mb_strtolower($field_value) , mb_strtolower($condition['value']) ) == 0;
							}					
							break;						
						
					}
				}
			}
			catch (\Exception $e) {
				if (\Cetera\Application::getInstance()->isDebugMode()) throw $e;
			}
			
			if ($match &&  $conditions['logic'] == 'or' && $conditions['logic2'] == 0 ) return true;
			if (!$match && $conditions['logic'] == 'or' && $conditions['logic2'] == 1 ) return true;
			if (!$match && $conditions['logic'] == 'and' && $conditions['logic2'] == 0 ) return false;
			if ($match &&  $conditions['logic'] == 'and' && $conditions['logic2'] == 1 ) return false;
		}
		if ($conditions['logic'] == 'and') return true;
		if ($conditions['logic'] == 'or') return false;
		return true;
	}
		
	public function hasOffers()
	{
		return $this->getOffers()->getCountAll() > 0;
	}		

	public function getOffers()
	{
		if ($this->offers === null) {
			$this->offers = Offer::getObjectDefinition()->getMaterials()->where('product='.(int)$this->id);
		}
		return $this->offers;
	}
	
	public function getFullPrice()
	{
		// если есть торговые предложение, то отдаем цену первого торгового предложения
		if ($this->hasOffers()) {
			$value = $this->getOffers()->current()->getFullPrice();
		}
		else {
			$value = round($this->getDynamicField('price'), $this->getPriceDecimals());
		}
		return $value;
	}	
}