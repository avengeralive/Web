<?php
require_once( DIR_SYSTEM . "/engine/neoseo_controller.php");

class ControllerModuleNeoSeoEmailNotify extends NeoSeoController {
	private $error = array();

	public function __construct($registry) {
		parent::__construct($registry);
		$this->_moduleSysName = 'neoseo_email_notify';
		$this->_logFile = $this->_moduleSysName.'.log';
		$this->debug = $this->config->get($this->_moduleSysName.'_debug') == 1;
	}

	public function index() {
		$this->checkLicense();
		$this->upgrade();

		$data = $this->language->load('module/' . $this->_moduleSysName);

		$this->document->setTitle($this->language->get('heading_title_raw'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting($this->_moduleSysName, $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			if (isset($_GET["close"])) {
				$this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
			} else {
				$this->response->redirect($this->url->link('module/' . $this->_moduleSysName, 'token=' . $this->session->data['token'], 'SSL'));
			}
		}

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];
			unset($this->session->data['success']);
		}

		$data = $this->initBreadcrumbs(array(
			array("extension/module", "text_module"),
			array('module/' . $this->_moduleSysName, "heading_title_raw")
		), $data);

		$data = $this->initButtons($data);

		// Шаблоны
		$pattern = rtrim(realpath(DIR_SYSTEM . "/../"), "/") . "/emails/*.html";
		$templates = array();
		foreach (glob($pattern) as $path) {
			$template = basename($path, ".html");
			$templates[] = $template;
		}
		$data['email_templates'] = $templates;

		$this->load->model('module/' . $this->_moduleSysName);

		$this->load->model('localisation/language');
		$data['languages'] = $this->model_localisation_language->getLanguages();

		// Статусы
		$this->load->model('localisation/order_status');


		// Инициализируем структуру, чтобы были данные по всем языкам
		$orderStatuses = $this->model_localisation_order_status->getOrderStatuses();
		foreach ($orderStatuses as $id => $status) {
			$data[$this->_moduleSysName . '_templates'][$status["order_status_id"]]["name"] = $status["name"];
			if ($id == 1) {
				$data[$this->_moduleSysName . '_templates'][$status["order_status_id"]]["status"] = 1;
			} else {
				$data[$this->_moduleSysName . '_templates'][$status["order_status_id"]]["status"] = 0;
			}
			$data[$this->_moduleSysName . '_templates'][$status["order_status_id"]][0]["subject"] = "";
			foreach ($this->model_localisation_language->getLanguages() as $language) {
				$data[$this->_moduleSysName . '_templates'][$status["order_status_id"]][$language['language_id']]["subject"] = "";
			}
			$data[$this->_moduleSysName . '_templates'][$status["order_status_id"]][0]["filename"] = "";
			foreach ($this->model_localisation_language->getLanguages() as $language) {
				$data[$this->_moduleSysName . '_templates'][$status["order_status_id"]][$language['language_id']]["filename"] = "";
			}
		}

		// А теперь восстанавливаем сохраненные данные
		$savedTemplates = $this->config->get($this->_moduleSysName . "_templates");
		if (!$savedTemplates) {
			$savedTemplates = $this->model_neoseo_email_notify->defaultTemplates;
		}

		foreach ($savedTemplates as $id => $template) {
			if (isset($data[$this->_moduleSysName . '_templates'][$id])) {
				$data[$this->_moduleSysName . '_templates'][$id][0]["status"] = $template[0]["status"];
				foreach ($this->model_localisation_language->getLanguages() as $language) {
					if (isset($template[$language['language_id']]["status"])) {
						$data[$this->_moduleSysName . '_templates'][$id][$language['language_id']]["status"] = $template[$language['language_id']]["status"];
					}
				}

				$data[$this->_moduleSysName . '_templates'][$id][0]["subject"] = $template[0]["subject"];
				foreach ($this->model_localisation_language->getLanguages() as $language) {
					if (isset($template[$language['language_id']]["subject"])) {
						$data[$this->_moduleSysName . '_templates'][$id][$language['language_id']]["subject"] = $template[$language['language_id']]["subject"];
					}
				}

				$data[$this->_moduleSysName . '_templates'][$id][0]["filename"] = $template[0]["filename"];
				foreach ($this->model_localisation_language->getLanguages() as $language) {
					if (isset($template[$language['language_id']]["filename"])) {
						$data[$this->_moduleSysName . '_templates'][$id][$language['language_id']]["filename"] = $template[$language['language_id']]["filename"];
					}
				}
			}
		}

		ksort($data[$this->_moduleSysName . '_templates']);

		$data = $this->initParamsList(array(
			"status",
			"debug",
			"recipients",
		), $data);

		$data['fields'] = $this->getFields();


		$languages = array();
		foreach ($this->model_localisation_language->getLanguages() as $language) {
			$languages[$language['language_id']] = $language['name'];
		}

		$data['params'] = $data;
		$data['token'] = $this->session->data['token'];
		$data["logs"] = $this->getLogs();

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('module/' . $this->_moduleSysName . '.tpl', $data));
	}

	protected function getFields() {
		$result = array();
		$keys = array();

		$keys[] = 'product:start';
		$keys[] = 'product_url';
		$keys[] = 'product_id';
		$keys[] = 'product_image';
		$keys[] = 'product_name';
		$keys[] = 'product_model';
		$keys[] = 'product_quantity';
		$keys[] = 'product_price';
		$keys[] = 'product_price_gross';
		$keys[] = 'product_attribute';
		$keys[] = 'product_option';
		$keys[] = 'product_sku';
		$keys[] = 'product_upc';
		$keys[] = 'product_tax';
		$keys[] = 'product_total';
		$keys[] = 'product_total_gross';
		$keys[] = 'product:stop';

		$keys[] = 'voucher:start';
		$keys[] = 'voucher_description';
		$keys[] = 'voucher_amount';
		$keys[] = 'voucher:stop';

		$keys[] = 'tax:start';
		$keys[] = 'tax_title';
		$keys[] = 'tax_value';
		$keys[] = 'tax:stop';

		$keys[] = 'total:start';
		$keys[] = 'total_title';
		$keys[] = 'total_value';
		$keys[] = 'total:stop';

		$keys[] = 'firstname';
		$keys[] = 'lastname';
		$keys[] = 'order_date';
		$keys[] = 'order_id';
		$keys[] = 'date';
		$keys[] = 'payment';
		$keys[] = 'shipment';
		$keys[] = 'total';
		$keys[] = 'invoice_number';
		$keys[] = 'order_href';
		$keys[] = 'store_url';
		$keys[] = 'status_name';
		$keys[] = 'store_name';
		$keys[] = 'ip';
		$keys[] = 'comment';
		$keys[] = 'sub_total';
		$keys[] = 'shipping_cost';
		$keys[] = 'client_comment';
		$keys[] = 'email';
		$keys[] = 'telephone';
		$keys[] = 'logo_url';
		$keys[] = 'shipping_country';
		$keys[] = 'shipping_zone';
		$keys[] = 'shipping_city';
		$keys[] = 'shipping_postcode';
		$keys[] = 'shipping_address_1';
		$keys[] = 'shipping_address_2';
		$keys[] = 'first_referrer';
		$keys[] = 'last_referrer';

		foreach ($keys as $key) {
			$result[$key] = $this->language->get("field_desc_" . $key);
		}

		// Инициализируем дополнительными полями
		$simple_tables = array(
			"order_simple_fields" => array(
				"short" => "osf",
				"prefix" => "simple_order",
				"join" => " LEFT JOIN `" . DB_PREFIX . "order_simple_fields` AS osf ON o.order_id = osf.order_id "
			),
			/* "address_simple_fields" => array(
			  "table_short" => "asf",
			  "field_prefix" => "simple_address"
			  ),
			  "customer_simple_fields" => array(
			  "table_short" => "csf",
			  "field_prefix" => "simple_customer"
			  ), */
		);

		foreach ($simple_tables as $table_name => $table_data) {
			$field_prefix = $table_data['prefix'];

			$query = $this->db->query("SHOW TABLES LIKE '" . DB_PREFIX . "$table_name'");
			if (!$query->num_rows) {
				continue;
			}

			$query = $this->db->query("SHOW COLUMNS FROM `" . DB_PREFIX . "$table_name`");
			if ($query->num_rows > 1) {
				array_shift($query->rows);
			}
			foreach ($query->rows as $row) {
				$field_name = $field_prefix . "_" . strtolower($row['Field']);
				$result[$field_name] = "Поле модуля simple";
			}
		}

		return $result;
	}

	private function validate() {
		if (!$this->user->hasPermission('modify', 'module/' . $this->_moduleSysName)) {
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