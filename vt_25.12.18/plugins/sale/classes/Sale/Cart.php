<?php
namespace Sale;

class Cart {
	
	use \Cetera\DbConnection;
	
	private $id = 0;
	private static $current = null;
	
	private $_totalSum = null;
	private $_totalDiscountSum = null;
	
	private function __construct($id)
	{
		$this->id = $id;
	}
	
	/*
	* возвращает корзину текущего пользователя
	*/	
	public static function get()
	{
        if (null === self::$current)
		{
			$a = \Cetera\Application::getInstance();
			$user = $a->getUser();
			$data = null;
			$data2 = self::getDbConnection()->fetchAssoc('SELECT * FROM sale_carts WHERE user_id = 0 and uid = ?', array( $a->getUid() ));
			if ($user) {
				$data = self::getDbConnection()->fetchAssoc('SELECT * FROM sale_carts WHERE user_id = ?', array($user->id));
				if ($data) {
					if ($data2) {
						$old = new self($data['id']);
						$new = new self($data2['id']);
						if ($new->getProductsCount() > 0 ) {
							$old->delete();
							$data = $data2;
							self::getDbConnection()->update('sale_carts', array(
								'user_id' => $user->id
							), array(
								'id' => $data['id']
							));	
						}
						else {
							$new->delete();
						}
					}
				}
				else {
					$data = $data2;
				}
			}
			else {
				$data = $data2;
			}
			
			if (!$data)
			{
				self::getDbConnection()->insert('sale_carts', array(
					'date'    => new \DateTime(),
					'user_id' => $user?$user->id:0,
					'uid'     => $a->getUid(),
				),array('datetime') );
				$cid = self::getDbConnection()->lastInsertId();
			}
			else 
			{
				$cid = $data['id'];
			}
			self::$current = new self($cid);
            
        }
		return self::$current;
	}
	
	public function getId()
	{
		return $this->id;
	}
	
	public function setProductOption( $cart_id, $option_name, $option_value)
	{
		$data = $this->getDbConnection()->fetchAssoc('SELECT * FROM sale_cart_products WHERE cart_id=? and id=?', array($this->id, $cart_id));
		if ($data) {
			if (!$data['options']) {
				$data['options'] = array();
			}
			else {
				$data['options'] = unserialize($data['options']);
			}
			foreach($data['options'] as $id => $o) {
				if ($o['name'] == $option_name) {
					if ($option_value === null) {
						unset($data['options'][$id]);
					}
					else {
						$data['options'][$id]['value'] = $option_value;
					}					
					break;
				}
			}
			
			$this->getDbConnection()->update('sale_cart_products', array('options' => serialize($data['options'])), array('id' => $data['id']));
		}
		return $this;
	}		
	
	/*
	* добавить продукт в корзину или изменить количество
	* $quantity = 0 - удалить из корзины
	*/
	public function setProduct( $product, $quantity = 1, $offer = null, $options = null, $cart_id = null )
	{
		$t = \Cetera\Application::getInstance()->getTranslator();
		
		if ($cart_id) {
			$data = $this->getDbConnection()->fetchAssoc('SELECT * FROM sale_cart_products WHERE cart_id=? and id=?', array($this->id, $cart_id));
			$product = $data['product_id'];
			$offer = $data['offer_id'];
			$where = array(
				'id' => $cart_id,
				'cart_id' => $this->id,
			);
		}
		else {
			$where = null;
		}
		
		if ( $product instanceOf Product ) {
			$pid = $product->id;
		}
		else {
			$pid = (int)$product;
			$product = \Sale\Product::getById($pid);
		}
		
		if (!$pid) throw new \Exception( $t->_('Не указан продукт') );
		
		if ( $product->hasOffers() ) {
			
			if ( $offer instanceOf Offer ) {
				$oid = $offer->id;
			}
			else {
				$oid = (int)$offer;
				if ($oid) $offer = \Sale\Offer::getById($oid);
			}			
			
			if (!$oid) throw new \Exception( $t->_('Не указано торговое предложение') );
			
		}
		else {
			$oid = 0;
		}
		
		if (!$where) {
			$where = array(
				'cart_id'    => $this->id,
				'product_id' => $pid,
				'offer_id'   => $oid,
			);
		}
		
		
		if ($quantity < 1)
		{
			$this->getDbConnection()->delete('sale_cart_products', $where);			
		}
		else
		{		
			if (!$product->canBuy((int)$quantity)) {
				throw new \Exception( $t->_('Отсутствует указанное количество') );
			}
			
			try
			{
				if ($cart_id) throw new \Exception('update');
				
				$data = array(
					'cart_id'    => $this->id,
					'product_id' => $pid,
					'offer_id'   => $oid,
					'quantity'   => (int)$quantity,
                                        'options'    => '',
				);
				if (is_array($options)) {
					$data['options'] = serialize($options);
				}
				$this->getDbConnection()->insert('sale_cart_products', $data);				
			}
			catch (\Exception $e)
			{		
				$data = array(
					'quantity'   => (int)$quantity,
				);
				if (is_array($options)) {
					$data['options'] = serialize($options);
				}				
				$this->getDbConnection()->update('sale_cart_products', $data, $where);					
			}
		}
		return $offer?$offer:$product;
	}
	
/*
	* добавить продукт в корзину
	*/
	public function addProduct( $product, $quantity = 1, $offer = null, $options = null )
	{
		if ((int)$quantity < 1) return $this;

		$t = \Cetera\Application::getInstance()->getTranslator();		
		
		if ( $product instanceOf Product ) {
			$pid = $product->id;
		}
		else {
			$pid = (int)$product;
			$product = \Sale\Product::getById($pid);
		}
		
		if (!$pid) throw new \Exception( $t->_('Не указан продукт') );
		
		if ( $product->hasOffers() ) {
			
			if ( $offer instanceOf Offer ) {
				$oid = $offer->id;
			}
			else {
				$oid = (int)$offer;
				if ($oid) $offer = \Sale\Offer::getById($oid);
			}			
			
			if (!$oid) throw new \Exception( $t->_('Не указано торговое предложение') );
			
		}
		else {
			$oid = 0;
		}
		
	    $data = self::getDbConnection()->fetchArray('SELECT quantity FROM sale_cart_products WHERE cart_id = ? and product_id=? and offer_id=?', array( $this->id, $pid, $oid ));
		if ($data) {
			$quantity = $data[0] + $quantity;				
		}
		$this->setProduct( $pid, $quantity, $offer, $options );
		return $this;
	}	

	public function checkProduct( $product, $offer = null, $options = null )
	{
		
		$t = \Cetera\Application::getInstance()->getTranslator();		
		
		if ( $product instanceOf Product ) {
			$pid = $product->id;
		}
		else {
			$pid = (int)$product;
			$product = \Sale\Product::getById($pid);
		}
		
		if (!$pid) throw new \Exception( $t->_('Не указан продукт') );
		
		if ( $product->hasOffers() ) {
			
			if ( $offer instanceOf Offer ) {
				$oid = $offer->id;
			}
			else {
				$oid = (int)$offer;
				if ($oid) $offer = \Sale\Offer::getById($oid);
			}			
			
			if (!$oid) throw new \Exception( $t->_('Не указано торговое предложение') );
			
		}
		else {
			$oid = 0;
		}
		
	    $data = self::getDbConnection()->fetchArray('SELECT quantity FROM sale_cart_products WHERE cart_id = ? and product_id=? and offer_id=?', array( $this->id, $pid, $oid ));
		if ($data) {
			return true;				
		}
		else return false;
	}	
	
	/*
	* получить продукты в корзине
	*/	
	public function getProducts()
	{
		$data = self::getDbConnection()->fetchAll('SELECT * FROM sale_cart_products WHERE cart_id = ?', array( $this->id ));
		$products = array();
		$this->_totalSum = 0;
		foreach ($data as $value)
		{
			$q = $value['quantity'];
			
			$prod = Product::getById( $value['product_id'] );
						
			if ($value['offer_id']) {
				$offer = Offer::getById( $value['offer_id'] );
				$price = $offer;
			}	
			else {
				$offer = null;
				$price = $prod;
			}
			
			$products[] = array(
				'product'    => $prod,
				'offer'      => $offer,
				'price'      => $price->discountPrice,
				'displayPrice' => $price->displayDiscountPrice,
				'quantity'   => $q,
				'sum'        => $q * $price->discountPrice,
				'displaySum' => Product::formatPrice($q * $price->discountPrice),
				'id'         => $value['id'],
				'name'       => $prod->name,
				'options'    => $value['options']?unserialize($value['options']):null,
			);
			$this->_totalSum += $q * $price->discountPrice;
		}
		return $products;
	}
	
	public function getProductsCount()
	{
		$data = self::getDbConnection()->fetchArray('SELECT SUM(A.quantity) FROM sale_cart_products A INNER JOIN sale_products B ON (A.product_id = B.id) WHERE A.cart_id = ?', array( $this->id ));
		return (int)$data[0];
	}	
	
	public function getTotal($display = false)
	{
		if ($this->_totalSum === null) {
			$this->getProducts();
		}
		if ($display) return \Sale\Product::formatPrice( $this->_totalSum );
		return $this->_totalSum;
	}	
	
	public function getDiscountTotal($display = false)
	{
		if ($this->_totalDiscountSum === null)
		{
			$this->_totalDiscountSum = 0;
			foreach ($this->getProducts() as $p) {
				$this->_totalDiscountSum += $p['product']->getDiscount() * $p['quantity'];
			}
		}
		if ($display) return \Sale\Product::formatPrice( $this->_totalDiscountSum );
		return $this->_totalDiscountSum;
	}	

	public function getDisplayTotal()
	{
		return \Sale\Product::formatPrice( $this->getTotal() );
	}
	
	public function clear()
	{
		$this->getDbConnection()->delete('sale_cart_products', array(
			'cart_id' => $this->id,
		));	
		return $this;
	}
	
	public function delete()
	{
		$this->clear();
		$this->getDbConnection()->delete('sale_carts', array(
			'id' => $this->id,
		));	
		unset($this);
	}	
	
}