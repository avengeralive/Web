<?php

require_once( DIR_SYSTEM . "/engine/neoseo_model.php");

class ModelToolNeoSeoCheckout extends NeoSeoModel
{

	public function __construct($registry)
	{
		parent::__construct($registry);
		$this->_moduleName = "";
		$this->_moduleSysName = "neoseo_checkout";
		$this->_logFile = $this->_moduleSysName . ".log";
		$this->debug = $this->config->get($this->_moduleSysName . "_status") == 1;
	}

	public function getCustomerData($customer_id)
	{
		//$this->debug("Данные: " . print_r($this->request->post,true) );
		$customData = array(
			"type" => 0,
			"fields" => array()
		);

		$data = array();
		$query = $this->db->query("SELECT name, value FROM " . DB_PREFIX . "customer_scfield WHERE customer_id = '" . (int) $customer_id . "';");
		foreach ($query->rows as $row) {
			if ($row['name'] == "type") {
				$customData['type'] = (int) $row['value'];
			} else {
				$data[$row['name']] = $row['value'];
			}
		}

		//$customData['type'] = (int)$this->request->post['type'];
		foreach ($this->config->get($this->_moduleSysName . '_customer_fields') as $type => $fields) {

			if (!isset($customData['fields'][$type]))
				$customData['fields'][$type] = array();

			foreach ($fields as $field) {

				if ($field['field'] != 'custom')
					continue;

				if (in_array($field['name'], array('newsletter', 'password2', 'register')))
					continue;

				$fieldName = $field['name'];
				$field['value'] = $field['default'];
				if (isset($this->request->post[$fieldName])) {
					$field['value'] = $this->request->post[$fieldName];
				} else if (isset($data[$fieldName])) {
					$field['value'] = $data[$fieldName];
				}

				$customData['fields'][$type][$fieldName] = $field;
			}
		}

		$this->document->addScript('catalog/view/javascript/jquery/jquery.maskedinput.js');

		$this->load->model('customer/customer_group');
		$items = $this->model_customer_customer_group->getCustomerGroups(array('sort' => 'cg.sort_order'));
		$customer_groups = array();
		foreach ($items as $item) {
			$customer_groups[$item['customer_group_id']] = $item['name'];
		}
		$language_id = $this->config->get("config_language_id");

		ob_start();
		require_once('view/template/tool/' . $this->_moduleSysName . '_scfield_form.tpl');
		return ob_get_clean();
	}

	public function updateCustomerData($customer_id, $data)
	{
		$this->db->query("DELETE FROM " . DB_PREFIX . "customer_scfield WHERE customer_id = '" . (int) $customer_id . "'");
		$type = isset($data['type']) ? $data['type'] : 0;
		$fields = $this->config->get($this->_moduleSysName . '_customer_fields');
		foreach ($data as $fieldName => $fieldValue) {
			if ($fieldName != "type") {
				$found = false;
				foreach ($fields[$type] as $field) {
					if ($field['field'] != 'custom')
						continue;
					if ($field['name'] == $fieldName) {
						$found = true;
						break;
					}
				}
				if (!$found)
					continue;
			}
			$this->db->query("INSERT INTO " . DB_PREFIX . "customer_scfield SET
				customer_id = '" . (int) $customer_id . "',
				`name` = '" . $this->db->escape($fieldName) . "',
				`value` = '" . $this->db->escape($fieldValue) . "'");
		}
	}

	public function deleteCustomerData($customer_id)
	{
		$this->db->query("DELETE FROM " . DB_PREFIX . "customer_scfield WHERE customer_id = '" . (int) $customer_id . "'");
	}

	public function getOrderData($order_id)
	{
		//$this->debug("Данные: " . print_r($this->request->post,true) );
		$customData = array(
			"type" => 0,
			"fields" => array()
		);

		$data = array();
		$query = $this->db->query("SELECT name, value FROM " . DB_PREFIX . "order_scfield WHERE order_id = '" . (int) $order_id . "';");
		foreach ($query->rows as $row) {
			if ($row['name'] == "type") {
				$customData['type'] = $row['value'];
			} else {
				$data[$row['name']] = $row['value'];
			}
		}

		//$customData['type'] = (int)$this->request->post['type'];
		foreach ($this->config->get($this->_moduleSysName . '_customer_fields') as $type => $fields) {

			if (!isset($customData['fields'][$type]))
				$customData['fields'][$type] = array();

			foreach ($fields as $field) {

				if ($field['field'] != 'custom')
					continue;

				if (in_array($field['name'], array('newsletter', 'password2', 'register')))
					continue;

				$fieldName = $field['name'];
				$field['value'] = $field['default'];
				if (isset($this->request->post[$fieldName])) {
					$field['value'] = $this->request->post[$fieldName];
				} else if (isset($data[$fieldName])) {
					$field['value'] = $data[$fieldName];
				}

				$customData['fields'][$type][$fieldName] = $field;
			}
		}

		$this->document->addScript('catalog/view/javascript/jquery/jquery.maskedinput.js');

		$this->load->model('customer/customer_group');
		$items = $this->model_customer_customer_group->getCustomerGroups(array('sort' => 'cg.sort_order'));
		$customer_groups = array();
		foreach ($items as $item) {
			$customer_groups[$item['customer_group_id']] = $item['name'];
		}
		$language_id = $this->config->get("config_language_id");
		ob_start();
		require_once('view/template/tool/' . $this->_moduleSysName . '_scfield_form.tpl');
		return ob_get_clean();
	}

	public function viewOrderData($order_id)
	{
		$customData = array(
			'type' => array(
				"label" => 'Тип покупателя',
				'value' => '',
				'code' => 0
			)
		);

		$this->load->model('customer/customer_group');
		$items = $this->model_customer_customer_group->getCustomerGroups(array('sort' => 'cg.sort_order'));
		$customer_groups = array();
		foreach ($items as $item) {
			$customer_groups[$item['customer_group_id']] = $item['name'];
		}


		$query = $this->db->query("SELECT order_scfield_id, name, value FROM " . DB_PREFIX . "order_scfield WHERE order_id = '" . (int) $order_id . "';");
		foreach ($query->rows as $row) {
			if ($row['name'] == "type") {
				$customData['type']['code'] = $row['value'];
				$customData['type']['value'] = isset($customer_groups[$row['value']]) ? $customer_groups[$row['value']] : "Код " . $row['value'];
			} elseif ($row['name'] == "files") {
				$unserialized_value = unserialize($row['value']);
				$customData[$row['name'] + '_' + $row['order_scfield_id']] = array(
					'value' => '<a href="' . $this->url->link('sale/order/downloadFiles', 'token=' . $this->session->data['token'] . '&download_id=' . $row['order_scfield_id'] . '&order_id=' . $order_id, 'SSL') . '">' . $unserialized_value['mask_name'] . '</a>',
					'label' => $row['name']
				);
			} else {
				$customData[$row['name']] = array(
					'value' => $row['value'],
					'label' => $row['name']
				);
			}
		}

		if (!isset($customData['type'])) {
			return '';
		}

		$fields = $this->config->get($this->_moduleSysName . '_customer_fields');
		if (!isset($fields[$customData['type']['code']])) {
			return '';
		}

		foreach ($fields[$customData['type']['code']] as $field) {
			if (isset($customData[$field['name']])) {
				$customData[$field['name']]['label'] = $field['label'];
			}
		}
		$language_id = $this->config->get("config_language_id");

		ob_start();
		require_once('view/template/tool/' . $this->_moduleSysName . '_scfield_view.tpl');
		return ob_get_clean();
	}

	public function updateOrderData($order_id, $data)
	{
		$this->db->query("DELETE FROM " . DB_PREFIX . "order_scfield WHERE order_id = '" . (int) $order_id . "'");
		$type = isset($data['type']) ? $data['type'] : 0;
		$fields = $this->config->get($this->_moduleSysName . '_customer_fields');
		foreach ($data as $fieldName => $fieldValue) {
			if ($fieldName != "type") {
				$found = false;
				foreach ($fields[$type] as $field) {
					if ($field['field'] != 'custom')
						continue;
					if ($field['name'] == $fieldName) {
						$found = true;
						break;
					}
				}
				if (!$found)
					continue;
			}
			$this->db->query("INSERT INTO " . DB_PREFIX . "order_scfield SET
				`order_id` = '" . (int) $order_id . "',
				`name` = '" . $this->db->escape($fieldName) . "',
				`value` = '" . $this->db->escape($fieldValue) . "'");
		}
	}

	public function getFile($order_scfield_id)
	{
		$query = $this->db->query("SELECT name, value FROM " . DB_PREFIX . "order_scfield WHERE order_scfield_id = '" . (int) $order_scfield_id . "';");
		if (!$query->num_rows)
			return false;

		return unserialize($query->row['value']);
	}

	public function deleteOrderData($order_id)
	{
		$this->db->query("DELETE FROM " . DB_PREFIX . "order_scfield WHERE order_id = '" . (int) $order_id . "'");
	}

}

?>