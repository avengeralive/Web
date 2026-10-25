<?php
namespace Sale\PaymentGateway;

abstract class GatewayAbstract  {
	
	use \Cetera\DbConnection;
	
	public $params;
	protected $t = NULL;
	public $order;	
	
	public function __construct($params, $order)
	{
		$this->params = $params;
		$this->order = $order;	
		$this->t = \Cetera\Application::getInstance()->getTranslator();
	}
	
	abstract public static function getInfo();	
	
	abstract public function pay( $return = '' );
	
	public function checkIfTransactionHasAlreadyBeenProcessed($txn_id)
	{
		$data = self::getDbConnection()->fetchArray('SELECT COUNT(*) FROM sale_payment_transactions WHERE transaction_id=? and gateway=?',array($txn_id,get_class($this)));
		return $data[0]>0;
	}
	
	public function saveTransaction($txn_id, $data)
	{
		self::getDbConnection()->insert('sale_payment_transactions',array(
			'date'             => new \DateTime(),		
			'order_id'         => $this->order->id,
			'transaction_id'   => $txn_id,
			'gateway'          => get_class($this),
			'data'             => serialize($data)
		), array('datetime'));
	}	
	
}