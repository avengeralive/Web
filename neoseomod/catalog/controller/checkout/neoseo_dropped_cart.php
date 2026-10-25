<?php

require_once( DIR_SYSTEM . "/engine/neoseo_controller.php");

class ControllerCheckoutNeoSeoDroppedCart extends NeoSeoController
{

	public function __construct($registry)
	{
		parent::__construct($registry);
		$this->_moduleName = "";
		$this->_moduleSysName = "neoseo_checkout";
		$this->_logFile = $this->_moduleSysName . ".log";
		$this->debug = $this->config->get($this->_moduleSysName . "_debug");
	}

	public function restore($data = null)
	{
		if ($this->request->get['token']) {
			$this->load->model('checkout/neoseo_dropped_cart');
			$this->model_checkout_neoseo_dropped_cart->load($this->request->get['token']);
			$products = $this->cart->getProducts();
			$this->model_checkout_neoseo_dropped_cart->setProducts($products, false);
			$this->model_checkout_neoseo_dropped_cart->updateCart(true);
			$this->response->redirect($this->url->link('checkout/cart', '', 'SSL'));
		}
	}

	public function sync($data = null)
	{
		//$this->log('sync');
		if (isset($this->session->data['dropped_cart_update_process']) && $this->session->data['dropped_cart_update_process'])
			return;
		$this->load->model('checkout/neoseo_dropped_cart');
		if (!$this->model_checkout_neoseo_dropped_cart->getEmail())
			return false;

		$products = $this->cart->getProducts();

		if (sizeof($data)) {
			$this->model_checkout_neoseo_dropped_cart->setProducts($products);
			$this->model_checkout_neoseo_dropped_cart->updateCart();
		} else {
			$this->model_checkout_neoseo_dropped_cart->clear();
		}
	}

	public function merge($data = null)
	{
		//$this->log('merge');
		if (isset($this->session->data['dropped_cart_update_process']) && $this->session->data['dropped_cart_update_process'])
			return;
		$this->load->model('checkout/neoseo_dropped_cart');
		$products = $this->cart->getProducts();
		$this->model_checkout_neoseo_dropped_cart->setProducts($products, false);
		$this->model_checkout_neoseo_dropped_cart->updateCart();
	}

	public function clear($data = null)
	{
		//$this->log('clear');
		$this->load->model('checkout/neoseo_dropped_cart');
		$this->model_checkout_neoseo_dropped_cart->clear();
	}

}
