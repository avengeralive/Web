<?php

require_once( DIR_SYSTEM . "/engine/neoseo_controller.php");

class ControllerCheckoutNeoSeoCart extends NeoSeoController
{

	public function __construct($registry)
	{
		parent::__construct($registry);
		$this->_moduleName = "";
		$this->_moduleSysName = "neoseo_checkout";
		$this->_logFile = $this->_moduleSysName . ".log";
		$this->debug = $this->config->get($this->_moduleSysName . "_debug");
	}

	public function index()
	{

		$data = $this->language->load('checkout/' . $this->_moduleSysName);

		if (isset($this->request->get['remove'])) {
			$this->cart->remove($this->request->get['remove']);

			unset($this->session->data['vouchers'][$this->request->get['remove']]);
		}

		$data['voucher_status'] = $this->config->get('voucher_status');
		$data['coupon_status'] = $this->config->get('coupon_status');
		$data['reward_status'] = $this->config->get('reward_status');

		// Totals
		$this->load->model('extension/extension');

		$total_data = array();
		$total = 0;
		$taxes = $this->cart->getTaxes();

		// Display prices
		if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
			$sort_order = array();

			$results = $this->model_extension_extension->getExtensions('total');

			foreach ($results as $key => $value) {
				$sort_order[$key] = $this->config->get($value['code'] . '_sort_order');
			}

			array_multisort($sort_order, SORT_ASC, $results);

			foreach ($results as $result) {
				if ($this->config->get($result['code'] . '_status')) {
					$this->load->model('total/' . $result['code']);

					$this->{'model_total_' . $result['code']}->getTotal($total_data, $total, $taxes);
				}

				$sort_order = array();

				foreach ($total_data as $key => $value) {
					$sort_order[$key] = $value['sort_order'];
				}

				array_multisort($sort_order, SORT_ASC, $total_data);
			}
		}

		$data['totals'] = array();

		foreach ($total_data as $total) {
			$data['totals'][] = array(
				'title' => $total['title'],
				'text' => $this->currency->format($total['value'])
			);
		}

		$this->load->model('tool/image');

		$data['products'] = array();

		foreach ($this->cart->getProducts() as $product) {
			if ($product['image']) {
				$image = $this->model_tool_image->resize($product['image'], $this->config->get('config_image_cart_width'), $this->config->get('config_image_cart_height'));
			} else {
				$image = $this->model_tool_image->resize('placeholder.png', $this->config->get('config_image_cart_width'), $this->config->get('config_image_cart_height'));
			}

			$option_data = array();

			foreach ($product['option'] as $option) {
				if ($option['type'] != 'file') {
					$value = $option['value'];
				} else {
					$filename = $this->encryption->decrypt($option['value']);

					$value = utf8_substr($filename, 0, utf8_strrpos($filename, '.'));
				}

				$option_data[] = array(
					'name' => $option['name'],
					'value' => (utf8_strlen($value) > 20 ? utf8_substr($value, 0, 20) . '..' : $value),
					'type' => $option['type']
				);
			}

			// Display prices
			if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
				$price = $this->currency->format($this->tax->calculate($product['price'], $product['tax_class_id'], $this->config->get('config_tax')));
			} else {
				$price = false;
			}

			// Display prices
			if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
				$total = $this->currency->format($this->tax->calculate($product['price'], $product['tax_class_id'], $this->config->get('config_tax')) * $product['quantity']);
			} else {
				$total = false;
			}

			$data['products'][] = array(
				'key' => $product['cart_id'],
				'thumb' => $image,
				'name' => $product['name'],
				'model' => $product['model'],
				'option' => $option_data,
				'quantity' => $product['quantity'],
				'price' => $price,
				'total' => $total,
				'href' => $this->url->link('product/product', 'product_id=' . $product['product_id'])
			);
		}

		// Gift Voucher
		$data['vouchers'] = array();

		if (!empty($this->session->data['vouchers'])) {
			foreach ($this->session->data['vouchers'] as $key => $voucher) {
				$data['vouchers'][] = array(
					'key' => $key,
					'description' => $voucher['description'],
					'amount' => $this->currency->format($voucher['amount'])
				);
			}
		}

		$points_total = 0;
		foreach ($this->cart->getProducts() as $product) {
			if ($product['points']) {
				$points_total += $product['points'];
			}
		}

		if ($points_total && $this->customer->isLogged() && (int) $this->customer->getRewardPoints() > 0) {
			$data['reward'] = true;
			$data['entry_reward'] = sprintf($this->language->get('entry_reward'), $points_total, (int) $this->customer->getRewardPoints());
		} else {
			$data['reward'] = false;
		}

		$data['cart'] = $this->url->link('checkout/cart', '', 'SSL');

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/checkout/neoseo_cart.tpl')) {
			$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/checkout/neoseo_cart.tpl', $data));
		} else {
			$this->response->setOutput($this->load->view('default/template/checkout/neoseo_cart.tpl', $data));
		}
	}

	public function getTotals($json)
	{
		$data = $this->language->load('checkout/' . $this->_moduleSysName);

		// Totals
		$this->load->model('extension/extension');

		$total_data = array();
		$total = 0;
		$taxes = $this->cart->getTaxes();

		// Display prices
		if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
			$sort_order = array();

			$results = $this->model_extension_extension->getExtensions('total');

			foreach ($results as $key => $value) {
				$sort_order[$key] = $this->config->get($value['code'] . '_sort_order');
			}

			array_multisort($sort_order, SORT_ASC, $results);

			foreach ($results as $result) {
				if ($this->config->get($result['code'] . '_status')) {
					$this->load->model('total/' . $result['code']);

					$this->{'model_total_' . $result['code']}->getTotal($total_data, $total, $taxes);
				}

				$sort_order = array();

				foreach ($total_data as $key => $value) {
					$sort_order[$key] = $value['sort_order'];
				}

				array_multisort($sort_order, SORT_ASC, $total_data);
			}
		}

		//$json['total'] = sprintf($this->language->get('text_items'), $this->cart->countProducts() + (isset($this->session->data['vouchers']) ? count($this->session->data['vouchers']) : 0), $this->currency->format($total));
		$json['total'] = sprintf($this->language->get('text_cart_items'), $this->currency->format($total));
		$json['total_items'] = $this->cart->countProducts();

		return $json;
	}

	public function update()
	{
		$json = array();

		if (!empty($this->request->post['quantity'])) {
			foreach ($this->request->post['quantity'] as $key => $value) {
				$this->cart->update($key, $value);
			}

			unset($this->session->data['reward']);
		}

		if (isset($this->request->post['remove'])) {
			$this->cart->remove($this->request->post['remove']);

			unset($this->session->data['vouchers'][$this->request->post['remove']]);
			unset($this->session->data['reward']);
		}

		if (!$this->cart->hasProducts()) {
			$json['redirect'] = $this->url->link('checkout/cart');
		}

		// Validate min amount
		$data['min_amount'] = $this->config->get($this->_moduleSysName . "_min_amount");
		$data['subtotal'] = $this->cart->getSubTotal();
		if ($data['min_amount'] > 0 && $data['min_amount'] > $data['subtotal']) {
			$json['redirect'] = $this->url->link('checkout/cart');
		}

		$json = $this->getTotals($json);

		$this->outputJson($json);
	}

	public function validateCoupon()
	{
		$this->language->load('checkout/' . $this->_moduleSysName);
		$this->load->model('total/coupon');

		$json = array();

		if (!isset($this->request->post['coupon']) || empty($this->request->post['coupon'])) {
			$this->request->post['coupon'] = '';
			$this->session->data['coupon'] = '';
		}

		$coupon_info = $this->model_total_coupon->getCoupon($this->request->post['coupon']);

		if (!$coupon_info) {
			$json['error']['warning'] = $this->language->get('error_coupon');
		}

		if (!$json) {
			$this->session->data['coupon'] = $this->request->post['coupon'];

			$json['success'] = $this->language->get('text_coupon');
		}

		$this->response->setOutput(json_encode($json));
	}

	public function validateVoucher()
	{
		$this->language->load('checkout/' . $this->_moduleSysName);
		$this->load->model('total/voucher');

		$json = array();

		if (!isset($this->request->post['voucher']) || empty($this->request->post['voucher'])) {
			$this->request->post['voucher'] = '';
			$this->session->data['voucher'] = '';
		}

		$voucher_info = $this->model_total_voucher->getVoucher($this->request->post['voucher']);

		if (!$voucher_info) {
			$json['error']['warning'] = $this->language->get('error_voucher');
		}

		if (!$json) {
			$this->session->data['voucher'] = $this->request->post['voucher'];

			$json['success'] = $this->language->get('text_coupon');
		}

		$this->response->setOutput(json_encode($json));
	}

	public function validateReward()
	{
		$this->language->load('checkout/' . $this->_moduleSysName);

		$points = $this->customer->getRewardPoints();

		$points_total = 0;

		foreach ($this->cart->getProducts() as $product) {
			if ($product['points']) {
				$points_total += $product['points'];
			}
		}

		$json = array();

		if (empty($this->request->post['reward'])) {
			$json['error']['warning'] = $this->language->get('error_reward');
		}

		if ($this->request->post['reward'] > $points) {
			$json['error']['warning'] = sprintf($this->language->get('error_points'), $this->request->post['reward']);
		}

		/* if ($this->request->post['reward'] > $points_total) {
		  $json['error']['warning'] = sprintf($this->language->get('error_maximum'), $points_total);
		  } */

		if (!$json) {
			$this->session->data['reward'] = abs($this->request->post['reward']);

			$json['success'] = $this->language->get('text_reward');
		}

		$this->response->setOutput(json_encode($json));
	}

}

?>