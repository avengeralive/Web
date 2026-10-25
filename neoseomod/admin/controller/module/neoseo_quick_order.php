<?php

require_once( DIR_SYSTEM . "/engine/neoseo_controller.php");

class ControllerModuleNeoseoQuickOrder extends NeoSeoController
{

	private $error = array();

	public function __construct($registry)
	{
		parent::__construct($registry);
		$this->_moduleSysName = 'neoseo_quick_order';
		$this->_logFile = $this->_moduleSysName . '.log';
		$this->debug = $this->config->get($this->_moduleSysName . '_status') == 1;
	}

	public function index()
	{
		$this->checkLicense();

		$data = $this->language->load($this->_route . '/' . $this->_moduleSysName);

		$this->document->setTitle($this->language->get('heading_title_raw'));

		$this->load->model('setting/setting');
		$this->load->model('localisation/language');
		$this->load->model('localisation/order_status');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting($this->_moduleSysName, $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			if (isset($_GET['close'])) {
				$this->response->redirect($this->url->link('extension/' . $this->_route, 'token=' . $this->session->data['token'], 'SSL'));
			} else {
				$this->response->redirect($this->url->link($this->_route . '/' . $this->_moduleSysName, 'token=' . $this->session->data['token'], 'SSL'));
			}
		}

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else if (isset($this->session->data['error_warning'])) {
			$data['error_warning'] = $this->session->data['error_warning'];
			unset($this->session->data['error_warning']);
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];
			unset($this->session->data['success']);
		}

		$data = $this->initBreadcrumbs(array(
			array('extension/' . $this->_route, 'text_module'),
			array($this->_route . '/' . $this->_moduleSysName, 'heading_title_raw')
		    ), $data);


		$data = $this->initButtons($data);

		$data = $this->initParamsList(array(
			'status',
			'debug',
			'phone_mask',
			'order_status_id',
			'ecommerce',
			'image_width',
			'image_height',
			'text_complete',
			'shipping_method',
			'payment_method',
			'country_id',
			'status_product',
			'status_popup_cart',
			'status_cart',
			'status_popup_form',
			'product_template',
			'popup_cart_template',
			'cart_template',
			'popup_form_template',
			'city'
		    ), $data);

		$data['languages'] = $this->model_localisation_language->getLanguages();

		if (!$data[$this->_moduleSysName . '_text_complete']) {
			foreach ($data['languages'] as $language) {
				$data[$this->_moduleSysName . '_text_complete'][$language['language_id']] = '';
			}
		}

		$data['ckeditor'] = $this->config->get('config_editor_default');
		if ($this->config->get('config_editor_default')) {
			$this->document->addScript('view/javascript/ckeditor/ckeditor.js');
			$this->document->addScript('view/javascript/ckeditor/ckeditor_init.js');
		}

		$order_statuses = $this->model_localisation_order_status->getOrderStatuses();
		$statuses = array();
		foreach ($order_statuses as $order_status) {
			$statuses[$order_status['order_status_id']] = $order_status['name'];
		}
		$data['order_statuses'] = $statuses;

		$this->load->model('extension/extension');

		$data['shipping_methods'] = array();

		$shipping_methods = $this->model_extension_extension->getInstalled('shipping');
		foreach ($shipping_methods as $shipping_method) {
			$file = DIR_APPLICATION . 'controller/shipping/' . $shipping_method . '.php';

			if (!file_exists($file) || !$this->config->get($shipping_method . '_status')) {
				continue;
			}

			$this->load->language('shipping/' . $shipping_method);

			$data['shipping_methods'][$shipping_method] = $this->language->get('heading_title');
		}

		$data['templates'] = array();

		$template_files = glob(DIR_CATALOG . 'view/theme/' . $this->config->get('config_template') . '/template/module/' . $this->_moduleSysName . '_temp_*.tpl');
		if (count($template_files) == 0) {
			$template_files = glob(DIR_CATALOG . 'view/theme/default/template/module/' . $this->_moduleSysName . '_temp_*.tpl');
		}

		if ($template_files) {
			foreach ($template_files as $template_file) {
				$template_file_name = str_replace($this->_moduleSysName . "_temp_", "", basename($template_file, '.tpl'));
				$data['templates'][$template_file_name] = $this->language->get('text_template') . " - " . $template_file_name;
			}
		}

		$data['payment_methods'] = array();

		$payment_methods = $this->model_extension_extension->getInstalled('payment');
		foreach ($payment_methods as $payment_method) {
			$file = DIR_APPLICATION . 'controller/payment/' . $payment_method . '.php';

			if (!file_exists($file) || !$this->config->get($payment_method . '_status')) {
				continue;
			}

			$this->load->language('payment/' . $payment_method);

			$data['payment_methods'][$payment_method] = $this->language->get('heading_title');
		}

		$data['countries'] = array();

		$this->load->model('localisation/country');

		$countries = $this->model_localisation_country->getCountries();
		foreach ($countries as $country) {
			$data['countries'][$country['country_id']] = $country['name'];
		}

		$data['logs'] = $this->getLogs();

		$data['token'] = $this->session->data['token'];
		$data['params'] = $data;

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view($this->_route . '/' . $this->_moduleSysName . '.tpl', $data));
	}

	private function validate()
	{
		if (!$this->user->hasPermission('modify', $this->_route . '/' . $this->_moduleSysName)) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if (!$this->error) {
			return true;
		} else {
			return false;
		}
	}

}

?>