<?php
namespace Sale;

class WidgetOrder extends \Cetera\Widget\Templateable
{

	private $order = null;

    protected $_params = array(
		'cart_url' => '/cart/',
		'catalog_url'  => false,
		'template'     => 'default.twig',
    ); 
	
	protected function init()
	{	
	        $this->application->addScript('/plugins/sale/js/locale.php?locale='.$this->application->getLocale());
		$this->application->addScript('/plugins/sale/js/common.js');
		$this->application->addScript('/plugins/sale/js/jquery-ui.min.js');
		$this->application->addCSS('/plugins/sale/js/jquery-ui.min.css');
		
		if (!$this->widgetTitle) $this->widgetTitle = '<div class="row column"><h1>'.$this->t->_('Оформить заказ').'</h1></div>';
			
		if (isset($this->application->getSession()->saleOrderCreated))
		{
			$this->order = \Sale\Order::getById( $this->application->getSession()->saleOrderCreated );
			//unset( $this->application->getSession()->saleOrderCreated );
			return;
		}
			
		if (!$this->getCart()->getProductsCount())
		{
			$this->setParam('cart_is_empty', 1);
			return;
		}
		
		if (isset($_POST) && count($_POST))
		{
			$order = $this->getOrder();
			$order->setParams($_POST);
			
			$user = $this->application->getUser();
			if (!$user) {
				$user = \Cetera\User::getByEmail( $order->getEmail() );
			}
			if (!$user) {
				$pass = \Cetera\User::generatePassword();
				$user = \Cetera\User::create();
				$user->setFields(array(
					'login'    => $order->getLogin(),
					'name'     => $order->getName(),
					'email'    => $order->getEmail(),
					'phone'    => $order->getPhone(),
					'password' => $pass,
				));
				$user->save();
				$this->application->getAuth()->authenticate(new \Cetera\UserAuthAdapter( array(
					'login' => $order->getEmail(),
					'pass'  => $pass,
				) )); 
			}
			
			$order->setUser($user)
			      ->save();
				  
			$this->getCart()->clear();
			$this->application->getSession()->saleOrderCreated = $this->getOrder()->getId();
			header('Location: '.$_SERVER['REQUEST_URI']);
			die();
		}		
		
	}

	public function getCart()
	{
		return \Sale\Cart::get();
	}
	
	public function getOrder()
	{
		if (!$this->order)
		{
			$this->order = \Sale\Order::make( $this->getCart() );				
		}
		return $this->order;
	}
	
	public function getProps($person_id)
	{
		$props = \Sale\Order::getAvailableProps($person_id);
		$user = $this->application->getUser();
		if ($user) {
			
			$last_props = array();
			$data = self::getDbConnection()->fetchAll('SELECT * FROM `sale_order_props_value` WHERE order_id IN (SELECT id FROM `sale_orders` WHERE user_id='.$user->id.') ORDER BY order_id');
			foreach ($data as $d) {
				$last_props[$d['order_props_id']] = $d['value'];
			}
			
			foreach ($props as $key => $value) {
				
				if (isset($last_props[$value['id']])) {
					$props[$key]['default_value'] = $last_props[$value['id']];
				}
				
				if ($value['is_email'] && $user->email) $props[$key]['default_value'] = $user->email;
				if ($value['is_login'] && $user->name) $props[$key]['default_value'] = $user->name;
				if ($value['is_phone'] && $user->phone) $props[$key]['default_value'] = $user->phone;
			}
		}
		return $props;
	}
}