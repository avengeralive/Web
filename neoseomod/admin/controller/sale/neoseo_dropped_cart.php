<?php

require_once(DIR_SYSTEM . "/engine/neoseo_controller.php");

class ControllerSaleNeoSeoDroppedCart extends NeoseoController
{

	public function __construct($registry)
	{
		parent::__construct($registry);
		$this->_moduleSysName = 'neoseo_checkout';
		$this->_logFile = $this->_moduleSysName . ".log";
		$this->debug = $this->config->get($this->_moduleSysName . '_debug');
	}

	public function index()
	{
		$this->language->load('sale/neoseo_dropped_cart');
		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('sale/neoseo_dropped_cart');

		if (isset($this->request->get['filter_email'])) {
			$filter_email = $this->request->get['filter_email'];
		} else {
			$filter_email = null;
		}

		if (isset($this->request->get['filter_name'])) {
			$filter_name = $this->request->get['filter_name'];
		} else {
			$filter_name = null;
		}

		if (isset($this->request->get['filter_modified'])) {
			$filter_modified = $this->request->get['filter_modified'];
		} else {
			$filter_modified = null;
		}

		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'name';
		}

		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'ASC';
		}

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		$url = '';

		if (isset($this->request->get['filter_email'])) {
			$url .= '&filter_email=' . $this->request->get['filter_email'];
		}

		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . $this->request->get['filter_name'];
		}

		if (isset($this->request->get['filter_modified'])) {
			$url .= '&filter_modified=' . $this->request->get['filter_modified'];
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('sale/neoseo_dropped_cart', 'token=' . $this->session->data['token'] . $url, 'SSL')
		);

		$data['delete_url'] = $this->url->link('sale/neoseo_dropped_cart/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$data['notify_url'] = $this->url->link('sale/neoseo_dropped_cart/notify', 'token=' . $this->session->data['token'] . '&redirect_url=' . urlencode($this->url->link('sale/neoseo_dropped_cart', 'token=' . $this->session->data['token'] . $url, 'SSL')), 'SSL');

		$data['carts'] = array();

		$filter_data = array(
			'filter' => array(
				'name' => $filter_name,
				'email' => $filter_email,
				'modified' => $filter_modified
			),
			'sort' => $sort,
			'order' => $order,
			'start' => ($page - 1) * $this->config->get('config_limit_admin'),
			'limit' => $this->config->get('config_limit_admin')
		);

		$carts_total = $this->model_sale_neoseo_dropped_cart->getTotalCarts($filter_data);

		$data['carts'] = $this->model_sale_neoseo_dropped_cart->getCarts($filter_data);

		foreach ($data['carts'] as $k => $v) {
			$data['carts'][$k]['notify'] = $this->url->link('sale/neoseo_dropped_cart/notify', 'token=' . $this->session->data['token'] . '&dropped_cart_id=' . $v['dropped_cart_id'] . $url, 'SSL');
			$data['carts'][$k]['view'] = $this->url->link('sale/neoseo_dropped_cart/view', 'token=' . $this->session->data['token'] . '&dropped_cart_id=' . $v['dropped_cart_id'] . $url, 'SSL');
			$data['carts'][$k]['delete'] = $this->url->link('sale/neoseo_dropped_cart/delete', 'token=' . $this->session->data['token'] . '&dropped_cart_id=' . $v['dropped_cart_id'] . $url, 'SSL');
		}

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_loading'] = $this->language->get('text_loading');
		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['text_confirm'] = $this->language->get('text_confirm');

		$data['column_email'] = $this->language->get('column_email');
		$data['column_name'] = $this->language->get('column_name');
		$data['column_total'] = $this->language->get('column_total');
		$data['column_phone'] = $this->language->get('column_phone');
		$data['column_modified'] = $this->language->get('column_modified');
		$data['column_action'] = $this->language->get('column_action');
		$data['column_notification_count'] = $this->language->get('column_notification_count');

		$data['entry_email'] = $this->language->get('entry_email');
		$data['entry_name'] = $this->language->get('entry_name');
		$data['entry_phone'] = $this->language->get('entry_phone');
		$data['entry_total'] = $this->language->get('entry_total');
		$data['entry_modified'] = $this->language->get('entry_modified');
		$data['entry_notification_count'] = $this->language->get('entry_notification_count');

		$data['button_notify'] = $this->language->get('button_send_notification');
		$data['button_copy'] = $this->language->get('button_copy');
		$data['button_add'] = $this->language->get('button_add');
		$data['button_edit'] = $this->language->get('button_edit');
		$data['button_delete'] = $this->language->get('button_delete');
		$data['button_filter'] = $this->language->get('button_filter');
		$data['button_view'] = $this->language->get('button_view');

		$data['token'] = $this->session->data['token'];

		if (isset($this->session->data['errors'])) {
			$data['error_warning'] = '';

			foreach ($this->session->data['errors'] as $error) {

				if ($data['error_warning']) {
					$data['error_warning'] += '<br>';
				}

				$data['error_warning'] += $error;
			}

			unset($this->session->data['errors']);
		} elseif (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

		if (isset($this->request->post['selected'])) {
			$data['selected'] = (array) $this->request->post['selected'];
		} else {
			$data['selected'] = array();
		}

		$url = '';

		if (isset($this->request->get['filter_email'])) {
			$url .= '&filter_email=' . $this->request->get['filter_email'];
		}

		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . $this->request->get['filter_name'];
		}

		if (isset($this->request->get['filter_modified'])) {
			$url .= '&filter_modified=' . $this->request->get['filter_modified'];
		}

		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['sort_email'] = $this->url->link('sale/neoseo_dropped_cart', 'token=' . $this->session->data['token'] . '&sort=email' . $url, 'SSL');
		$data['sort_name'] = $this->url->link('sale/neoseo_dropped_cart', 'token=' . $this->session->data['token'] . '&sort=name' . $url, 'SSL');
		$data['sort_phone'] = $this->url->link('sale/neoseo_dropped_cart', 'token=' . $this->session->data['token'] . '&sort=phone' . $url, 'SSL');
		$data['sort_notification_count'] = $this->url->link('sale/neoseo_dropped_cart', 'token=' . $this->session->data['token'] . '&sort=notification_count' . $url, 'SSL');
		$data['sort_modified'] = $this->url->link('sale/neoseo_dropped_cart', 'token=' . $this->session->data['token'] . '&sort=modified' . $url, 'SSL');
		$data['sort_total'] = $this->url->link('sale/neoseo_dropped_cart', 'token=' . $this->session->data['token'] . '&sort=total' . $url, 'SSL');

		$url = '';

		if (isset($this->request->get['filter_email'])) {
			$url .= '&filter_email=' . $this->request->get['filter_email'];
		}

		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . $this->request->get['filter_name'];
		}

		if (isset($this->request->get['filter_modified'])) {
			$url .= '&filter_modified=' . $this->request->get['filter_modified'];
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$pagination = new Pagination();
		$pagination->total = $carts_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_limit_admin');
		$pagination->url = $this->url->link('sale/neoseo_dropped_cart', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($carts_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($carts_total - $this->config->get('config_limit_admin'))) ? $carts_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $carts_total, ceil($carts_total / $this->config->get('config_limit_admin')));

		$data['filter_email'] = $filter_email;
		$data['filter_name'] = $filter_name;
		$data['filter_modified'] = $filter_modified;

		$data['sort'] = $sort;
		$data['order'] = $order;

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
		$this->response->setOutput($this->load->view('sale/neoseo_dropped_cart_list.tpl', $data));
	}

	public function view()
	{
		$this->language->load('sale/neoseo_dropped_cart');
		$this->load->model('sale/neoseo_dropped_cart');
		$data = array();

		$data['cart'] = $this->model_sale_neoseo_dropped_cart->getCart($this->request->get['dropped_cart_id']);

		$data['products'] = $this->model_sale_neoseo_dropped_cart->getCartProducts($this->request->get['dropped_cart_id']);

		$data['total'] = 0;

		foreach ($data['products'] as $k => $v) {
			$data['products'][$k]['view'] = $this->url->link('catalog/product/edit', 'token=' . $this->session->data['token'] . '&product_id=' . $v['product_id'], 'SSL');
		}

		$data['heading_title'] = $this->language->get('heading_title_info');

		$data['column_email'] = $this->language->get('column_email');
		$data['column_name'] = $this->language->get('column_name');
		$data['column_total'] = $this->language->get('column_total');
		$data['column_subtotal'] = $this->language->get('column_subtotal');
		$data['column_phone'] = $this->language->get('column_phone');
		$data['column_quantity'] = $this->language->get('column_quantity');
		$data['column_options'] = $this->language->get('column_options');
		$data['column_price'] = $this->language->get('column_price');
		$data['column_modified'] = $this->language->get('column_modified');
		$data['column_action'] = $this->language->get('column_action');
		$data['column_notification_count'] = $this->language->get('column_notification_count');

		$data['entry_email'] = $this->language->get('entry_email');
		$data['entry_name'] = $this->language->get('entry_name');
		$data['entry_phone'] = $this->language->get('entry_phone');
		$data['entry_total'] = $this->language->get('entry_total');
		$data['entry_modified'] = $this->language->get('entry_modified');
		$data['entry_notification_count'] = $this->language->get('entry_notification_count');

		$data['button_cancel'] = $this->language->get('button_cancel');
		$data['button_send_notification'] = $this->language->get('button_send_notification');

		$data['button_send_notification_url'] = $this->url->link('sale/neoseo_dropped_cart/notify', 'token=' . $this->session->data['token'] . '&dropped_cart_id=' . $data['cart']['dropped_cart_id'], 'SSL');

		$data['token'] = $this->session->data['token'];

		$data['breadcrumbs'] = array(
			array(
				'text' => $this->language->get('heading_title'),
				'href' => $this->url->link('sale/neoseo_dropped_cart', 'token=' . $this->session->data['token'], 'SSL')
			),
			array(
				'text' => $this->language->get('heading_title_info'),
				'href' => $this->url->link('sale/neoseo_dropped_cart/view', 'token=' . $this->session->data['token'] . '&dropped_cart_id=' . $data['cart']['dropped_cart_id'], 'SSL')
			),
		);

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$data['return'] = $this->url->link('sale/neoseo_dropped_cart', 'token=' . $this->session->data['token'], 'SSL');
		$this->response->setOutput($this->load->view('sale/neoseo_dropped_cart_info.tpl', $data));
	}

	public function notify()
	{

		if (empty($this->request->get['dropped_cart_id']) && empty($this->request->post['selected'])) {
			return;
		}

		$this->language->load('sale/neoseo_dropped_cart');
		$this->load->model('sale/neoseo_dropped_cart');

		$errors = array();

		$cart_ids = array();

		if (isset($this->request->get['dropped_cart_id'])) {
			$cart_ids[] = $this->request->get['dropped_cart_id'];
		} else {
			$cart_ids = $this->request->post['selected'];
		}

		foreach ($cart_ids as $id) {
			$result = $this->model_sale_neoseo_dropped_cart->notify($id);
			//$this->log(print_r($result,true));
			if ($result['status'] == 'error') {
				$errors[] = $result['message'];
			}
		}

		if ($this->request->get['redirect_url']) {
			if ($errors) {
				$this->session->data['errors'] = $errors;
			}

			$url = str_replace('&amp;', '&', urldecode($this->request->get['redirect_url']));

			$this->response->redirect($url);
		}

		if ($errors) {
			$json = array(
				array(
					'result' => 'error',
					'messages' => $errors
				)
			);
		} else {
			$carts = array();

			$_carts = $this->model_sale_neoseo_dropped_cart->getCarts(array('filter' => array('dropped_cart_id' => $cid)));

			foreach ($_carts as $k => $v) {
				$carts[] = array(
					'id' => $v['dropped_cart_id'],
					'notified' => $v['notification_count'],
				);
			}

			$json = array(
				'result' => 'success',
				'message' => $this->language->get('email_send_successfully'),
				'carts' => $carts
			);
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function delete()
	{
		$cid = $this->request->get['dropped_cart_id'];
		if (!$cid)
			$cid = $this->request->post['selected'];

		if (!is_array($cid))
			$cid = array($cid);
		$this->db->query('DELETE FROM `' . DB_PREFIX . 'dropped_cart_product` WHERE `dropped_cart_id` IN (' . implode(',', $cid) . ')');
		$this->db->query('DELETE FROM `' . DB_PREFIX . 'dropped_cart` WHERE `dropped_cart_id` IN (' . implode(',', $cid) . ')');
		$this->response->redirect($this->url->link('sale/neoseo_dropped_cart', 'token=' . $this->session->data['token'], 'SSL'));
	}

}
