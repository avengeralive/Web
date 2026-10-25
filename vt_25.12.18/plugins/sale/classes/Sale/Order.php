<?php
namespace Sale;

class Order {
	
	use \Cetera\DbConnection;
	
	// заказ сформирован
	const STATUS_CREATED    = 0;
	// заказ проверен менеджером
	const STATUS_CHECKED    = 1;
	// заказ в обработке
	const STATUS_PROCESSING = 2;
	// заказ готов к отправке, выдаче
	const STATUS_READY      = 3;
	// заказ готов к отправлен
	const STATUS_SENT       = 4;
	// заказ доставлен
	const STATUS_DONE       = 5;
	// заказ отменен
	const STATUS_CANCELLED  = 6;
	
	// ожидает оплаты
	const PAY_WAIT    = 0;
	// оплачен
	const PAY_PAID    = 1;
	// отменен
	const PAY_CANCEL  = 2;
	// деньги возвращены
	const PAY_REFUND  = 3;
	
	private $id = 0;
	
	private $delivery_id = 0;
	private $delivery_cost = null;
	private $delivery_note = null;
	private $delivery = null;
	
	private $payment_id = 0;
	private $payment_data = null;
	private $payment_gateway = null;
	
	private $user_id = 0;
	private $date = null;
	private $status = 0;
	private $paid   = 0;
	
	private $person_type_id = 1;
	
	private $props = null;
	private $products = null;
	private $cart_id = null;
	
	private static $person_types = null;
	private static $person_props = array();
	
	public $initialData = array();
	
	public function __construct( $cart = null, $data = null )
	{
		if ($cart)
		{
			$this->products = $cart->getProducts();
			$this->cart_id = $cart->getId();
		}
		
		if ($data)
		{
			$this->id = $data['id'];
			$this->user_id = $data['user_id'];
			$this->date = $data['date'];
			$this->delivery_id = $data['delivery_id'];
			$this->delivery_cost = $data['delivery_cost'];
			$this->delivery_note = $data['delivery_note'];
			$this->payment_id = $data['payment_id'];
			$this->status = $data['status'];
			$this->paid = $data['paid'];
			$this->person_type_id = $data['person_type_id'];
			$this->initialData = $data;
		}
	}
	
    public function __get($name)
    {
    
        $method = 'get' . ucfirst($name);
        if (method_exists($this, $method)) return $this->$method();
        
        if (property_exists($this, $name)) return $this->$name;
    
        throw new \LogicException("Property {$name} is not found");
    }	
	
	public static function enum()
	{
		return new Iterator\Order();
	}
	
	public static function t()
	{
		return \Cetera\Application::getInstance()->getTranslator();
	}	
	
	public static function make($cart)
	{
		if (!$cart->getProductsCount())
		{
			throw new \Exception( self::t()->_('Ваша корзина пуста!'));
		}
		return new self( $cart, null );
	}
	
	public static function getById($id)
	{
		$params = self::getDbConnection()->fetchAssoc('SELECT * FROM sale_orders WHERE id=?',array($id));
		if (!$params) throw new \Exception( sprintf( self::t()->_('Заказ №%s не найден') , $id) );
		return new self( null, $params );
	}	
	
	public  function getId()
	{
		return $this->id;
	}
	
	public static function getStatuses()	
	{
		$data = array();
		$d = [0,1,2,3,4,5,6];
		foreach ($d as $id) $data[] = array(
			'id'   => $id,
			'name' => self::getStatusTextStatic( $id )
		);
		return $data;
	}
	
	public static function getStatusTextStatic($value)
	{
		switch ($value)
		{
			case self::STATUS_CREATED:   return self::t()->_('заказ сформирован');
			case self::STATUS_CHECKED:   return self::t()->_('заказ проверен');
			case self::STATUS_PROCESSING:return self::t()->_('заказ в обработке');
			case self::STATUS_READY:     return self::t()->_('заказ готов к отправке, выдаче');
			case self::STATUS_SENT:      return self::t()->_('заказ отправлен');
			case self::STATUS_DONE:      return self::t()->_('заказ доставлен');
			case self::STATUS_CANCELLED: return self::t()->_('заказ отменен');
			
		}
	}	
	
	public function getStatusText()
	{
		return self::getStatusTextStatic($this->status);
	}	
	
	public static function getPayStatuses()	
	{
		$data = array();
		$d = [0,1,2,3];
		foreach ($d as $id) $data[] = array(
			'id'   => $id,
			'name' => self::getPayTextStatic( $id )
		);
		return $data;
	}

	public static function getPayTextStatic($value)
	{
		switch ($value)
		{
			case self::PAY_WAIT:   return self::t()->_('ожидает оплаты');
			case self::PAY_PAID:   return self::t()->_('оплачен');
			case self::PAY_CANCEL: return self::t()->_('отменен');
			case self::PAY_REFUND: return self::t()->_('деньги возвращены');
			
		}
	}	
	
	public function getPayText()
	{
		return self::getPayTextStatic($this->paid);
	}		
	
	public function getProducts()
	{
		if (!$this->products)
		{
			$data = self::getDbConnection()->fetchAll('SELECT * FROM sale_order_products WHERE order_id = ?',array($this->id));
			$products = array();
			foreach ($data as $value)
			{
				$q = $value['quantity'];
				$p = $value['price'];

				try {
					$prod = Product::fetch( $value['product_id'] );
				}
				catch (\Exception $e) {
					$prod = null;
				}
				
				try {
					if ( $value['offer_id'] ) {
						$offer = Offer::fetch( $value['offer_id'] );
					}
					else {
						$offer = null;
					}
				}
				catch (\Exception $e) {
					$offer = null;
				}				
				
				$products[] = array(
					'product'      => $prod,
					'offer'        => $offer,
					'price'        => $p,
					'displayPrice' => Product::formatPrice($p),
					'quantity'   => $q,
					'sum'        => $q * $p,
					'displaySum' => Product::formatPrice($q * $p),
					'id'         => $value['product_id'].'-'.$value['offer_id'],
					'name'       => $value['product_name'],
					'bo_url'     => /*$prod?$prod->getBoUrl( true ):*/$value['product_name'],
					'options'    => $value['options']?unserialize($value['options']):null,
				);
			}	
			$this->products = $products;
		}
		return $this->products;
	}
	
	public function getProductsTable()
	{
		$list = '<table><thead><tr><th>'.self::t()->_('Наименование').'</th><th>'.self::t()->_('Цена').'</th><th>'.self::t()->_('Кол-во').'</th><th>'.self::t()->_('Стоимость').'</th></tr></thead><tbody>';
		foreach ($this->getProducts() as $p)
		{
			$list .= '<tr><td>'.$p['name'].'</td><td>'.$p['price'].'</td><td>'.$p['quantity'].'</td><td>'.$p['sum'].'</td>';
		}			
		$list .= '</tbody></table>';
		return $list;
	}
	
	public function getProperty($name)
	{
		if ((int)$name) {
			return $this->props[$name];
		}
		else {
			$p = $this->getProps();
			return $p[$name]['value'];
		}
	}	
	
	public function setProperty($name, $value)
	{
		if ((int)$name) {
			$this->props[$name] = $value;
		}
		else {
			$p = $this->getProps();
			$this->props[ $p[$name]['id'] ] = $value;
		}
		return $this;
	}		
	
	public function setParams($params)
	{
		if (isset($params['person_type'])) {
			$this->setPersonType($params['person_type']);
			unset($params['person_type']);
		}		
		if (isset($params['delivery_method'])) {
			$this->setDelivery($params['delivery_method']);
			unset($params['delivery_method']);
		}
		if (isset($params['delivery_cost'])) {
			$this->delivery_cost = $params['delivery_cost'];
			unset($params['delivery_cost']);
		}		
		if (isset($params['payment_method'])) {
			$this->setPayment($params['payment_method']);
			unset($params['payment_method']);
		}
		if (isset($params['status']))
		{
			$this->setStatus($params['status']);
			unset($params['status']);
		}
		if (isset($params['paid']))
		{
			$this->setPaid($params['paid']);
			unset($params['paid']);
		}
		if (isset($params['props']))
		{
			$this->props = $params['props'];
			unset($params['props']);
		}			
		//foreach ($params as $name => $value) $this->params[$name] = $value;
			
		return $this;
	}
	
	public function getProps()
	{
		if ($this->props === null)
		{
			$data = self::getDbConnection()->fetchAll('SELECT * FROM sale_order_props_value WHERE order_id=?', array($this->id));
			$this->props = array();
			foreach ($data as $d)
			{
				$this->props[ (int)$d['order_props_id'] ] = $d['value'];
			}
		}
		$ret = $this->getAvailableProps( $this->person_type_id );
		foreach ($ret as $id => $r)
		{
			$ret[$id]['value'] = $this->props[ $r['id'] ];
		}
		return $ret;
	}	
	
	public function setStatus($value)
	{
		$this->status = (int)$value;
		return $this;
	}

	public function setPaid($value)
	{
		$this->paid = (int)$value;
		return $this;
	}	
	
	public function setPayment($payment)
	{
		$this->payment_id = (int)$payment;
		return $this;
	}
	
	public function getPaymentId()
	{
		return $this->payment_id;
	}	

	public function getPaymentData()
	{
		if (!$this->payment_data)
		{
			$this->payment_data = self::getDbConnection()->fetchAssoc('SELECT * FROM sale_payment WHERE id=?', array($this->payment_id));
		}
		return $this->payment_data;
	}

	public function getPaymentGateway()
	{
		if (!$this->payment_gateway) {
			$data = $this->getPaymentData();
			if (!$data) return false;
		
			$class = $data['gateway'];
			if ($class && Payment::isGatewayExists($class)) {
				$this->payment_gateway = new $class(json_decode($data['gateway_params'], true), $this);
			}				
		}
		return $this->payment_gateway;
	}	
	
	public function setDelivery($delivery)
	{
		$this->delivery_id = (int)$delivery;
		$this->delivery = null;
		return $this;
	}	
	
	public function getDeliveryId()
	{
		return $this->delivery_id;
	}

	public function getDelivery()
	{
		if (!$this->delivery)
		{
			$this->delivery = new Delivery( self::getDbConnection()->fetchAssoc('SELECT * FROM sale_delivery WHERE id=?', array($this->delivery_id)), $this );
		}
		return $this->delivery;
	}
	
	public function getDeliveryData()
	{
		return $this->getDelivery();
	}
	
	public function getDeliveryCost($display = false)
	{
		if (!$this->getDeliveryId()) return null;
		if ($this->delivery_cost === null) {
			$this->getDeliveryData();
			$this->delivery_cost = $this->delivery->getCost();
		}
		if ($display) return \Sale\Product::formatPrice( $this->delivery_cost );
		return $this->delivery_cost;
	}
	
	public function getDeliveryNote()
	{
		if ($this->delivery_note === null)
		{
			$this->getDeliveryData();
			$this->delivery_note = $this->delivery->getNote();
		}
		return $this->delivery_note;
	}	
	
	public function getTotal($display = false)
	{
		if ($display) return \Sale\Product::formatPrice( $this->getDeliveryCost() + $this->getProductsCost() );
		return $this->getDeliveryCost() + $this->getProductsCost();
	}
	
	public function getProductsCost($display = false)
	{
		$sum = 0;
		foreach( $this->getProducts() as $p )
		{
			$sum += $p['quantity'] * $p['price'];
		}
		if ($display) return \Sale\Product::formatPrice( $sum );
		return $sum;		
	}
	
	public function getPaymentMethods( $all = false )
	{
		if ($all)
		{
			$data = self::getDbConnection()->fetchAll('SELECT * FROM sale_payment where active=1 ORDER BY tag');
		}
		elseif($this->delivery_id && $this->person_type_id)
		{
			$data = self::getDbConnection()->fetchAll('
				SELECT B.* 
				FROM sale_payment B
					INNER JOIN sale_delivery_payment A ON (A.payment_id = B.id) 
					INNER JOIN sale_payment_person_type C ON (C.payment_id = B.id) 
				WHERE B.active=1 and A.delivery_id=? and C.person_type_id=? GROUP BY B.id ORDER BY B.tag', array($this->delivery_id, $this->person_type_id));
		}
		elseif($this->delivery_id)
		{
			$data = self::getDbConnection()->fetchAll('
				SELECT B.* 
				FROM sale_payment B
					INNER JOIN sale_delivery_payment A ON (A.payment_id = B.id)  
				WHERE B.active=1 and A.delivery_id=? GROUP BY B.id ORDER BY B.tag', array($this->delivery_id));
		}
		elseif($this->person_type_id)
		{
			$data = self::getDbConnection()->fetchAll('
				SELECT B.* 
				FROM sale_payment B
					INNER JOIN sale_payment_person_type C ON (C.payment_id = B.id) 
				WHERE B.active=1 and C.person_type_id=? GROUP BY B.id ORDER BY B.tag', array($this->person_type_id));
		}		
		return $data;		
	}
	
	public function getDeliveryMethods( $all = false )
	{
		if ($all)
		{		
			$data = self::getDbConnection()->fetchAll('SELECT * FROM sale_delivery where active=1 ORDER BY tag');
		}
		elseif ($this->payment_id && $this->person_type_id)
		{
			$data = self::getDbConnection()->fetchAll('
				SELECT A.*
				FROM sale_delivery A
					INNER JOIN sale_delivery_payment B ON (A.id = B.delivery_id) 
					INNER JOIN sale_payment_person_type C ON (B.payment_id = C.payment_id) 
				WHERE A.active=1 and B.payment_id=? and C.person_type_id=?
				GROUP BY A.id ORDER BY A.tag
			', array($this->payment_id, $this->person_type_id));
		}
		elseif ($this->payment_id)
		{
			$data = self::getDbConnection()->fetchAll('
				SELECT A.*
				FROM sale_delivery A
					INNER JOIN sale_delivery_payment B ON (A.id = B.delivery_id) 
				WHERE A.active=1 and B.payment_id=?
				GROUP BY A.id ORDER BY A.tag
			', array($this->payment_id));			
		}
		elseif ($this->person_type_id)
		{
			$data = self::getDbConnection()->fetchAll('
				SELECT A.*
				FROM sale_delivery A
					INNER JOIN sale_delivery_payment B ON (A.id = B.delivery_id) 
					INNER JOIN sale_payment_person_type C ON (B.payment_id = C.payment_id) 
				WHERE A.active=1 and C.person_type_id=?
				GROUP BY A.id ORDER BY A.tag
			', array($this->person_type_id));			
		}
		$methods = array();
		foreach($data as $d) $methods[] = new Delivery($d, $this);
		return $methods;
	}	
	
	public function setUser($user)
	{
		$this->user_id = $user->id;
		return $this;
	}
	
	public function getUser()
	{
		try {
			return \Cetera\User::getById($this->user_id);
		}
		catch (\Exception $e) {
			return false;
		}
	}	
	
	public function getEmail()
	{
		$this->getProps();
		foreach (self::getAvailableProps($this->person_type_id) as $p)
		{
			if ($p['is_email']) return $this->getProperty($p['id']);
		}
	}
	
	public function getPhone()
	{
		$this->getProps();
		foreach (self::getAvailableProps($this->person_type_id) as $p)
		{
			if ($p['is_phone']) return $this->getProperty($p['id']);
		}		
	}
	
	public function getLogin()
	{
		if ($this->getUser()) return $this->getUser()->login;
		$login = str_replace( ' ','_', $this->getName() );
		if (!$login) 
		{
			$login = 'user_'.(($this->cart_id)?$this->cart_id:time());
		}
		return $login;
	}
	
	public function getName()
	{
		$this->getProps();
		$res = array();
		foreach (self::getAvailableProps($this->person_type_id) as $p)
		{
			if ($p['is_login']) 
				if ($this->getProperty($p['id'])) 
					$res[] = $this->getProperty($p['id']);
		}
		return implode(' ', $res);
	}
	
	public function getDate()
	{
		return $this->date;
	}

	private function getMailEventParams()
	{
		return array(
			'sale'   => array(
				'email'   => \Sale\Setup::configGet('sale_email'),	
			),
			'order'  => $this,		
			'server' => \Cetera\Application::getInstance()->getServer(),
		);
	}	

	public function delete()
	{
		self::getDbConnection()->delete('sale_order_products', array('order_id' => $this->id));
		self::getDbConnection()->delete('sale_order_props_value', array('order_id' => $this->id));
		self::getDbConnection()->delete('sale_orders', array('id' => $this->id));			
	}		

	public function save()
	{
		if (!$this->user_id) throw new \Exception( self::t()->_('Не указан пользователь для заказа') );
		
		$data = array();
		
		$data['status'] = $this->status;
		$data['person_type_id'] = $this->person_type_id;
		$data['payment_id'] = $this->payment_id;
		$data['delivery_id'] = $this->delivery_id;
		$data['delivery_cost'] = $this->getDeliveryCost();
		$data['delivery_note'] = $this->getDeliveryNote();
		$data['user_id'] = $this->user_id;
		$data['paid'] = $this->paid;
		
		if (!$this->id)
		{
			self::getDbConnection()->insert('sale_orders', $data);
			$this->id = self::getDbConnection()->lastInsertId();
			self::getDbConnection()->update('sale_orders', array('date' => new \DateTime()), array('id' => $this->id), array('datetime'));	
			$this->date = date('Y-m-d');
			
			if ( \Sale\Setup::configGet( 'use_quantity' ) ) {
				foreach ($this->getProducts() as $p) {
					if (!$p['product']) continue;
					$p['product']->quantity = $p['product']->quantity - $p['quantity'];
					$p['product']->save();
				}
			}
			
			$user = \Cetera\User::getById($this->user_id);
				
			\Cetera\Mail\Event::trigger( 'SALE_NEW_ORDER', $this->getMailEventParams() );
			\Cetera\Event::trigger( 'SALE_NEW_ORDER', $this );
		}
		else
		{
			$this->getProducts();
			self::getDbConnection()->update('sale_orders', $data, array('id' => $this->id));
			self::getDbConnection()->delete('sale_order_products', array('order_id' => $this->id));
			if ($this->props !== null) {
				self::getDbConnection()->delete('sale_order_props_value', array('order_id' => $this->id));
			}
			
			if ($this->status == self::STATUS_CANCELLED && isset($this->initialData['status']) && $this->status != $this->initialData['status'] ) {
				\Cetera\Mail\Event::trigger( 'SALE_ORDER_CANCEL', $this->getMailEventParams() );
				\Cetera\Event::trigger( 'SALE_ORDER_CANCEL', $this );
			}	

			if ($this->status == self::STATUS_CHECKED && isset($this->initialData['status']) && $this->status != $this->initialData['status'] ) {
				\Cetera\Mail\Event::trigger( 'SALE_ORDER_CHECKED', $this->getMailEventParams() );
				\Cetera\Event::trigger( 'SALE_ORDER_CHECKED', $this );
			}			
		}
		self::getDbConnection()->update('sale_orders', array('date_update' => new \DateTime()), array('id' => $this->id), array('datetime'));	
		
		foreach ($this->getProducts() as $p)
		{
			$data = array(
				'order_id'     => $this->id,
				'product_id'   => $p['product']->id,
				'product_name' => $p['product']->name,
				'quantity'     => $p['quantity'],
				'price'        => $p['price'],
				'options'      => is_array($p['options'])?serialize($p['options']):'',
			);
			if ($p['offer']) {
				$data['offer_id'] = $p['offer']->id;
				$data['product_name'] .= ', '.$p['offer']->name;
			}
			self::getDbConnection()->insert('sale_order_products', $data);
		}
		
		if ($this->props !== null) {	
			foreach ($this->props as $id => $value) {
				if (is_array($value)) {
					$id = $value['id'];
					$value = $value['value'];
				}
				if ($value === null) continue;
				self::getDbConnection()->insert('sale_order_props_value', array(
					'order_id' => $this->id,
					'order_props_id' => $id,
					'value' => $value,
				));
			}
		}

		$this->initialData = $data;
	}
	
	public function setPersonType($id)
	{
		$this->person_type_id = (int)$id;
	}
	
	public function getPersonType()
	{
		return $this->person_type_id;
	}	
	
	public static function getPersonTypes()
	{
		if (self::$person_types === null)
			self::$person_types = self::getDbConnection()->fetchAll('SELECT * FROM sale_person_type WHERE active=1 ORDER BY sort');
		return self::$person_types;
	}
	
	public static function getAvailableProps($person_id)
	{
		$person_id = (int)$person_id;
		if (!isset(self::$person_props[$person_id]))
		{
			$data = self::getDbConnection()->fetchAll('
				SELECT A.*, B.name as group_name, B.id as group_id
				FROM sale_order_props A LEFT JOIN sale_order_props_group B ON (A.group_id = B.id)
				WHERE A.person_type_id='.$person_id.' and A.active>0 ORDER BY B.sort, A.sort
			');				
			self::$person_props[$person_id] = array();		
			foreach ($data as $d)
			{
				self::$person_props[$person_id][$d['alias']] = $d;
			}
		}
		return self::$person_props[$person_id];
	}	
	
	public function isCancelable()
	{
		return !in_array($this->status, array(self::STATUS_CANCELLED,self::STATUS_DONE,self::STATUS_SENT));
	}
	
	public function canBePaid()
	{
		
		$user = \Cetera\Application::getInstance()->getUser();
		// неавторизованный пользователь не может ничего оплачивать
		if (!$user) return false;
		
		// чужие заказы тоже нельзя оплачивать
		if ($this->user_id != $user->id) return false;
		
		// отмененные, выполненные заказы тоже нельзя оплачивать
		if (in_array($this->status, array(self::STATUS_CANCELLED,self::STATUS_DONE))) return false;
		
		// оплатить можно только неоплаченный заказ
		if ($this->paid != self::PAY_WAIT) return false;
		
		// без платежного шлюза нельзя оплачивать
		if (!$this->getPaymentGateway()) return false;
		
		return true;
	}	

	public function getPayUrl( $return = '' )
	{
		if (!$this->canBePaid()) return false;
		return '/plugins/sale/pay.php?order='.$this->id.'&return='.urlencode($return);
	}
	
	public function getCurrency()
	{
		return 'RUB';
	}	

	public function checkPaymentAmountAndCurrency($amount, $currency)
	{
		if ($this->getCurrency() != $currency) throw new \Exception( self::t()->_('Неправильная валюта платежа') );
		if ($this->getTotal() != $amount) throw new \Exception( self::t()->_('Неправильная сумма платежа') );
	}
	
	public function checkUser($user_id)
	{
		if ($this->user_id != (int)$user_id) throw new \Exception( self::t()->_('Плательщик отличается от пользователя заказа') );
	}

	public function paymentSuccess()
	{
		$this->setPaid(self::PAY_PAID)->save();
		\Cetera\Mail\Event::trigger( 'SALE_ORDER_PAID', $this->getMailEventParams() );
	}	
}