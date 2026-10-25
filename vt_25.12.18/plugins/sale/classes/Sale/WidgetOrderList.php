<?php
namespace Sale;

class WidgetOrderList extends \Cetera\Widget\Templateable
{

    protected $_params = array(
		'order_detail_url' => '/personal/order?id={id}',
		'template'         => 'default.twig',
    ); 
	
	public function init()
	{
	        $this->application->addScript('/plugins/sale/js/locale.php?locale='.$this->application->getLocale());
		$this->application->addScript('/plugins/sale/js/common.js');		
	}	

	public function getOrders()
	{
		$user = $this->application->getUser();
		if (!$user) return null;
		return $user->getOrders();
	}
	
}