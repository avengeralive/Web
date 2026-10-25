<?php

require_once( DIR_SYSTEM . "/engine/neoseo_model.php");

class ModelAccountNeoSeoCustomer extends NeoSeoModel
{

	public function __construct($registry)
	{
		parent::__construct($registry);
		$this->_moduleSysName = "neoseo_account";
		$this->_logFile = $this->_moduleSysName . ".log";
		$this->debug = $this->config->get($this->_moduleSysName . "_debug") == 1;
	}

	public function getCustomerData($customer_id)
	{
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer WHERE customer_id = '" . (int) $customer_id . "'");

		return $query->row;
	}

	public function updateCustomerData($data)
	{
		$customer_id = $this->customer->getId();
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

	public function updateCustomerAddress($data)
	{
		$this->load->model("account/address");
		$address = $this->model_account_address->getAddress($this->customer->getAddressId());

		$hasChanged = false;
		foreach ($data as $fieldName => $fieldValue) {
			if (in_array($fieldName, array("company", "company_id", "tax_id"))) {
				$address[$fieldName] = $fieldValue;
				$hasChanged = true;
			}
		}

		if ($hasChanged) {
			$this->model_account_address->editAddress($this->customer->getAddressId(), $address);
		}
	}

	public function registerCustomer($params, $address = array())
	{
		$regularData = array(
			"firstname" => $params['firstname'],
			"lastname" => $params['lastname'],
			"email" => $params['email'],
			"telephone" => $params['telephone'],
			"fax" => "",
			"password" => $params['password'],
			"newsletter" => isset($params['newsletter']) ? 1 : 0,
			"customer_group_id" => (int) $params['type'],
			"company" => "",
			"company_id" => "",
			"tax_id" => "",
			"country_id" => $this->config->get('config_country_id'),
			"zone_id" => $this->config->get('config_zone_id'),
			"postcode" => "",
			"city" => "----",
			"address_1" => "----",
			"address_2" => "",
		);

		$customData = array(
			"type" => (int) $params['type']
		);


		// Заполняем поля данными
		$fields = $this->config->get($this->_moduleSysName . '_customer_fields');

		if (empty($fields)) {
			$fields = array();
		}

		$type = $customData['type'];

		if (count($fields)){
			foreach ($fields[$type] as $field) {
				$fieldName = $field['name'];
				if (in_array($field['name'], array("register", "comment", "password2", "newsletter")))
					continue;
				$fieldValue = isset($params[$fieldName]) ? $params[$fieldName] : "";
				if (isset($regularData[$fieldName])) {
					$regularData[$fieldName] = $fieldValue;
				} else {
					$customData[$fieldName] = $fieldValue;
				}
			}
		}

		foreach ($regularData as $key => $data) {
			if (isset($address[$key]) && !in_array($key, array("newsletter"))) {
				$regularData[$key] = $address[$key];
			}
		}

		$this->debug("Данные для регистрации " . print_r($params, true));
		$this->debug("Данные, которые пойдут в оригинальные поля " . print_r($regularData, true));
		$this->debug("Данные, которые пойдут в дополнительные поля " . print_r($customData, true));

		$this->load->model("account/customer");
		$this->model_account_customer->addCustomer($regularData);

		$customer = $this->model_account_customer->getCustomerByEmail($regularData['email']);
		foreach ($customData as $fieldName => $fieldValue) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "customer_scfield SET
				customer_id = '" . (int) $customer['customer_id'] . "',
				`name` = '" . $this->db->escape($fieldName) . "',
				`value` = '" . $this->db->escape($fieldValue) . "'");
		}
	}

}
