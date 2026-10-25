<?php
namespace Sale;

class WidgetCart extends \Cetera\Widget\Templateable
{

    protected $_params = array(
		'order_url' => '/order/',
		'catalog_url'   => false,
    ); 

	protected function init()
	{
		if (!$this->widgetTitle) $this->widgetTitle = '<div class="row column"><h1>'.$this->t->_('Корзина').'</h1></div>';
		
		if (isset($this->application->getSession()->saleOrderCreated))
		{
			unset( $this->application->getSession()->saleOrderCreated );
		}		
		if (!$this->widgetTitle) $this->widgetTitle = $this->t->_('Корзина');
		
		if (!$this->getCart()->getProductsCount())
		{
			$this->setParam('cart_is_empty', 1);
		}		
	}		

	public function getCart()
	{
		return \Sale\Cart::get();
	}
	
}