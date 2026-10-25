<?php
namespace Sale;

class Compare {
	
	private $s;
	private static $current = null;
	
	public static function get()
	{
        if (null === self::$current) {
			self::$current = new self();            
        }
		return self::$current;
	}	
	
	private function __construct()
	{
		$this->s = \Cetera\Application::getInstance()->getSession();
	}
		
	/*
	* добавить продукт в список
	*/
	public function addProduct( $product )
	{	
		if ( $product instanceOf Product ) {
			$pid = $product->id;
		}
		else {
			$pid = (int)$product;
		}
		
		if (!$pid) throw new \Exception(  $this->t->_('Не указан продукт') );
		
	    if (!isset($this->s->saleCompareList)) {
			$this->s->saleCompareList = array();
		}
		$this->s->saleCompareList[$pid] = $pid;
		
		return $this;
	}	
	
	public function removeProduct( $product )
	{
		if ( $product instanceOf Product ) {
			$pid = $product->id;
		}
		else  {
			$pid = (int)$product;
		}
		
	    if (isset($this->s->saleCompareList[$pid])) {
			unset($this->s->saleCompareList[$pid]);
			if (!count($this->s->saleCompareList)) {
				unset($this->s->saleCompareList);
			}
		}	
		
		return $this;		
	}
	
	/*
	* получить продукты в списке
	*/	
	public function getProducts()
	{
		$products = array();
		if (isset($this->s->saleCompareList) && is_array($this->s->saleCompareList)) {
			foreach ($this->s->saleCompareList as $pid) {
				
				$products[] = Product::getById( $pid );
				
			}
		}		
		return $products;
	}
	
	public function getProductsCount()
	{
		if (!isset($this->s->saleCompareList)) {
			return 0;
		}
		else {
			return count($this->s->saleCompareList);
		}
	}
	
	public function clear()
	{
		unset($this->s->saleCompareList);
		return $this;
	}	
	
	public function isValuesDiffer($field)
	{
		$v = '** undefined **';
		foreach ( $this->getProducts() as $p ) {
			if ($v === '** undefined **') {
				$v = $this->fieldValue($p, $field);
				continue;
			}
			if ($v != $this->fieldValue($p, $field) ) {
				return true;
			}
		}
		return false;
	}
	
	public function fieldValue($product, $field)
	{
		$value = $product->{$field->name};
		
		if ($field instanceof \Cetera\ObjectFieldLink) {
			return $value->name;	
		}
		else {		
			return $value;
		}
	}		
	
}