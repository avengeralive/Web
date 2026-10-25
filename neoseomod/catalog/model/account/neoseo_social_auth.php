<?php

require_once( DIR_SYSTEM . "/engine/neoseo_model.php");

class ModelAccountNeoSeoSocialAuth extends NeoSeoModel
{

	public function __construct($registry)
	{
		parent::__construct($registry);
		$this->_moduleSysName = 'neoseo_account';
		$this->_logFile = $this->_moduleSysName . '.log';
		$this->debug = $this->config->get($this->_moduleSysName . '_debug') == 1;
	}

	public function checkIdentity($identity)
	{
		$query = $this->db->query("SELECT customer_id FROM " . DB_PREFIX . "customer WHERE identity = '" . $this->db->escape($identity) . "'");

		return $query->num_rows ? $query->row['customer_id'] : false;
	}

	public function addCustomer($data)
	{
		$this->db->query("INSERT INTO " . DB_PREFIX . "customer (identity, firstname, lastname, email, telephone, fax, newsletter, customer_group_id, password, status, date_added) VALUES ('" . $this->db->escape($data['identity']) . "', '" . $this->db->escape($data['firstname']) . "', '" . $this->db->escape($data['lastname']) . "', '" . $this->db->escape($data['email']) . "', '', '', '0', '" . (int) $data['customer_group_id'] . "', '" . $this->db->escape(md5($data['password'])) . "', '1', NOW())");

		$customer_id = $this->db->getLastId();

		$this->db->query("INSERT INTO " . DB_PREFIX . "address SET customer_id = '" . (int) $customer_id . "', firstname = '" . $this->db->escape($data['firstname']) . "', lastname = '" . $this->db->escape($data['lastname']) . "', address_1 = '" . $this->db->escape($data['address_1']) . "', city = '" . $this->db->escape($data['city']) . "', zone_id = '" . (int) $data['zone_id'] . "', country_id = '" . (int) $data['country_id'] . "'");

		$address_id = $this->db->getLastId();

		$this->db->query("UPDATE " . DB_PREFIX . "customer SET address_id = '" . (int) $address_id . "' WHERE customer_id = '" . (int) $customer_id . "'");

		return $customer_id;
	}

	public function login($customer_id)
	{
		$customer_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer WHERE customer_id = '" . (int) $customer_id . "' AND status = '1'");


		if ($customer_query->num_rows) {
			$this->session->data['customer_id'] = $customer_query->row['customer_id'];

			if ($customer_query->row['cart'] && is_string($customer_query->row['cart'])) {
				$cart = unserialize($customer_query->row['cart']);

				foreach ($cart as $key => $value) {
					if (!array_key_exists($key, $this->session->data['cart'])) {
						$this->session->data['cart'][$key] = $value;
					} else {
						$this->session->data['cart'][$key] += $value;
					}
				}
			}

			if ($customer_query->row['wishlist'] && is_string($customer_query->row['wishlist'])) {
				if (!isset($this->session->data['wishlist'])) {
					$this->session->data['wishlist'] = array();
				}

				$wishlist = unserialize($customer_query->row['wishlist']);

				foreach ($wishlist as $product_id) {
					if (!in_array($product_id, $this->session->data['wishlist'])) {
						$this->session->data['wishlist'][] = $product_id;
					}
				}
			}

			$this->db->query("UPDATE " . DB_PREFIX . "customer SET ip = '" . $this->db->escape($this->request->server['REMOTE_ADDR']) . "' WHERE customer_id = '" . (int) $customer_query->row['customer_id'] . "'");

			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function getCountryId($country)
	{
		$country_query = $this->db->query("SELECT country_id FROM " . DB_PREFIX . "country WHERE name LIKE '" . $this->db->escape($country) . "' LIMIT 1");
		return $country_query->row;
	}

	public function generatePassword($number)
	{
		$arr = array('a', 'b', 'c', 'd', 'e', 'f',
			'g', 'h', 'i', 'j', 'k', 'l',
			'm', 'n', 'o', 'p', 'r', 's',
			't', 'u', 'v', 'x', 'y', 'z',
			'A', 'B', 'C', 'D', 'E', 'F',
			'G', 'H', 'I', 'J', 'K', 'L',
			'M', 'N', 'O', 'P', 'R', 'S',
			'T', 'U', 'V', 'X', 'Y', 'Z',
			'1', '2', '3', '4', '5', '6',
			'7', '8', '9', '0');

		// Генерируем пароль
		$pass = "";
		for ($i = 0; $i < $number; $i++) {
			// Вычисляем случайный индекс массива
			$index = rand(0, count($arr) - 1);
			$pass .= $arr[$index];
		}

		return $pass;
	}

}

?>
