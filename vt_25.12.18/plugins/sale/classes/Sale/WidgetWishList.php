<?php
namespace Sale;

class WidgetWishList extends \Cetera\Widget\Templateable
{

    protected $_params = array(
		'template'         => 'default.twig',
    ); 
	
	protected function init()
	{
	    $this->application->addScript('/plugins/sale/js/locale.php?locale='.$this->application->getLocale());
		$this->application->addScript('/plugins/sale/js/common.js');				
	}		
	
	/**
	 * Список товаров для показа
	 */ 	
    public function getChildren()
    {
		$wishList = WishList::get();
		return $wishList->getProducts();
    } 	
	
}