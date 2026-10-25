<?php

require_once(DIR_SYSTEM . "/engine/neoseo_model.php");

class ModelSaleNeoSeoDroppedCart extends NeoSeoModel
{

	const TABLE_DROPPED_CART = 'dropped_cart';
	const TABLE_DROPPED_CART_PRODUCT = 'dropped_cart_product';

	private static $_columns = array();
	private static $filter_cache = array();

	public function __construct($registry)
	{
		parent::__construct($registry);
		$this->_moduleSysName = 'neoseo_checkout';
		$this->_logFile = $this->_moduleSysName . ".log";
		$this->debug = $this->config->get($this->_moduleSysName . '_debug');
	}

	public function getEmailTemplatePath()
	{
		return DIR_TEMPLATE . 'mail/' . $this->_moduleSysName . '/';
	}

	public function getDroppedCarts()
	{

		$dropped_carts = array();

		$query = $this->db->query('SELECT * FROM `' . DB_PREFIX . self::TABLE_DROPPED_CART . '` WHERE `modified` >= date_sub(now(), INTERVAL 24 HOUR) AND `notification_count`=0');

		if ($query->num_rows) {
			$dropped_carts = $query->rows;
		}

		return $dropped_carts;
	}

	private function getColumns($table)
	{
		if (!isset(self::$_columns[$table])) {
			self::$_columns[$table] = array();
			$query = $this->db->query('SHOW COLUMNS FROM `' . $table . '`');
			if ($query->num_rows) {
				foreach ($query->rows as $row) {
					$row['type'] = preg_replace('/[\W\d]+/', '', $row['Type']);
					self::$_columns[$table][$row['Field']] = $row;
				}
			}
		}
		return self::$_columns[$table];
	}

	private function getColumnNames($table)
	{
		return array_keys($this->getColumns($table));
	}

	private function getColumnType($table, $column)
	{
		$cols = $this->getColumns($table);

		return (isset($cols[$column]) && isset($cols[$column]['type'])) ? $cols[$column]['type'] : false;
	}

	public function getTotalCarts($data = array())
	{
		$sql = "SELECT COUNT(dropped_cart_id) AS total FROM `" . DB_PREFIX . self::TABLE_DROPPED_CART . "`";

		$_arr = $this->prepareFilterArray(DB_PREFIX . self::TABLE_DROPPED_CART, $data['filter'], '');

		if (!empty($_arr))
			$sql .= " WHERE " . implode(' AND ', $_arr);

		$query = $this->db->query($sql);

		if ($query->num_rows)
			return $query->row['total'];
	}

	public function getCart($id)
	{
		$query = $this->db->query("SELECT *, SUM(cp.quantity * cp.price) AS total FROM " . DB_PREFIX . self::TABLE_DROPPED_CART . " c LEFT JOIN " . DB_PREFIX . self::TABLE_DROPPED_CART_PRODUCT . " cp ON (cp.dropped_cart_id=c.dropped_cart_id) WHERE c.dropped_cart_id = '" . (int) $id . "'");

		return $query->row;
	}

	public function getCarts($data = array())
	{
		$sql = "SELECT c.*, SUM(cp.quantity*cp.price) AS total FROM `" . DB_PREFIX . self::TABLE_DROPPED_CART . "` c LEFT JOIN `" . DB_PREFIX . self::TABLE_DROPPED_CART_PRODUCT . "` cp ON (cp.dropped_cart_id=c.dropped_cart_id)";

		$sort_data = $this->getColumnNames(DB_PREFIX . self::TABLE_DROPPED_CART);

		$filtered_columns = array_reverse($this->getColumnNames(DB_PREFIX . self::TABLE_DROPPED_CART));

		foreach ($filtered_columns as $v)
			$filtered_columns[$v] = 'c.' . $v;

		$_arr = $this->prepareFilterArray(DB_PREFIX . self::TABLE_DROPPED_CART, $data['filter'], 'c');

		if (!empty($_arr))
			$sql .= " WHERE " . implode(' AND ', $_arr);

		$sql .= ' GROUP BY cp.dropped_cart_id';

		if (isset($data['sort']) && in_array($filtered_columns[$data['sort']], $sort_data)) {
			$sql .= " ORDER BY " . $filtered_columns[$data['sort']];
		} else {
			$sql .= " ORDER BY c.name";
		}

		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC";
		} else {
			$sql .= " ASC";
		}

		if (isset($data['start']) || isset($data['limit'])) {
			if (!isset($data['start']))
				$data['start'] = 0;
			if (!isset($data['limit']))
				$data['limit'] = 20;
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}

			$sql .= " LIMIT " . (int) $data['start'] . "," . (int) $data['limit'];
		}

		$query = $this->db->query($sql);

		return $query->rows;
	}

	public function getCartProducts($dropped_cart_id)
	{
		$query = $this->db->query('SELECT *, price*quantity AS subtotal FROM `' . DB_PREFIX . self::TABLE_DROPPED_CART_PRODUCT . '` WHERE dropped_cart_id=' . (int) $dropped_cart_id);

		return $query->rows;
	}

	private function prepareFilterArray($table, array $data = array(), $table_prefix)
	{
		$filtered_columns = array_flip($this->getColumnNames(DB_PREFIX . self::TABLE_DROPPED_CART));

		foreach ($filtered_columns as $k => $v)
			$filtered_columns[$k] = ($table_prefix ? $table_prefix . '.' : '') . $k;

		$columns = $this->getColumns(DB_PREFIX . self::TABLE_DROPPED_CART);

		$hash = $table . md5(json_encode($data));

		$array = array();

		foreach ($data as $k => $v) {
			if (isset($filtered_columns[$k])) {
				switch ($columns[$k]['type']) {
					case 'int':
						if (is_array($v)) {
							foreach ($v as $_k => $_v)
								$v[$_k] = (int) $_v;
							$array[] = $filtered_columns[$k] . ' IN(' . implode(',', $v) . ')';
						} else
							$array[] = $filtered_columns[$k] . '=' . (int) $v;
						break;
					case 'varchar':
					case 'text':
					case 'datetime':
					case 'date':
						$array[] = $filtered_columns[$k] . ' LIKE "%' . $this->db->escape($v) . '%"';
						break;
						break;
						break;
						break;
					case 'decimal':
						$array[] = $filtered_columns[$k] . '=' . preg_replace('/[^\d\.]/', '', $v);
						break;
					default:
						if (is_array($v)) {
							foreach ($v as $_k => $_v)
								$v[$_k] = $this->db->escape($_v);
							$array[] = $filtered_columns[$k] . ' IN("' . implode('","', $v) . '")';
						} else
							$array[] = $filtered_columns[$k] . '="' . $this->db->escape($v) . '"';
						break;
				}
			}
		}

		self::$filter_cache[$hash] = array();

		if ($data) {
			self::$filter_cache[$hash] = $array;
		}

		return self::$filter_cache[$hash];
	}

	public function markSent($id)
	{
		$this->db->query("UPDATE `" . DB_PREFIX . self::TABLE_DROPPED_CART . "` SET `notification_count`=`notification_count`+1, `modified`=NOW() WHERE dropped_cart_id='" . (int) $id . "'");
	}

	public function notify($cid)
	{
		$this->load->language('module/' . $this->_moduleSysName . '_dropped_cart');

		$response = array(
			'status' => 'error',
			'message' => ''
		);

		if (!is_numeric($cid)) {
			$response['message'] = $this->language->get('error_missing_cart_id');

			return $response;
		}

		$cart = $this->getCart($cid);

		if (!$cart) {
			$response['message'] = $this->language->get('error_cart_not_found');

			return $response;
		}

		$filename = $this->config->get($this->_moduleSysName . '_dropped_cart_template');

		if (!file_exists($filename)) {
			$response['message'] = sprintf($this->language->get('error_template_not_found'), $filename);

			return $response;
		}

		$email = $cart['email'];

		if (!$email) {
			$response['message'] = $this->language->get('error_empty_email');

			return $response;
		}

		$data['column_name'] = $this->language->get('column_name');
		$data['column_quantity'] = $this->language->get('column_quantity');
		$data['column_price'] = $this->language->get('column_price');

		$data['text_top'] = sprintf($this->language->get('text_top'), $cart['dropped_cart_id'], $cart['modified']);
		$data['text_total'] = $this->language->get('text_total');
		$data['text_bottom'] = $this->language->get('text_bottom');

		$data['logo'] = HTTP_CATALOG . 'image/' . $this->config->get('config_logo');

		$products_data = $this->getCartProducts($cid);

		$currency = isset($cart['currency_code']) ? $cart['currency_code'] : null;

		$data['products'] = array();

		$this->load->model('tool/image');

		$catalog_url = new Url(HTTP_CATALOG, $this->config->get('config_secure') ? HTTP_CATALOG : HTTPS_CATALOG);

		foreach ($products_data as $product) {
			$image = '';

			if (isset($product['image'])) {
				$image = $this->model_tool_image->resize(ltrim($product['image'], '/'), $this->config->get('config_image_cart_width'), $this->config->get('config_image_cart_height'));
			}

			$data['products'][] = array(
				'image' => $image,
				'name' => $product['name'],
				'model' => isset($product['model']) ? $product['model'] : '',
				'quantity' => $product['quantity'],
				'price' => $currency ? $this->currency->format($product['price'], $currency, $currency) : $product['price'],
				'option' => isset($product['options']) ? $product['options'] : '',
				'sku' => isset($product['sku']) ? $product['sku'] : '',
				'upc' => isset($product['upc']) ? $product['upc'] : '',
				'href' => !empty($product['href']) ? $product['href'] : $catalog_url->link('product/product', 'product_id=' . $product['product_id']),
				'total' => $currency ? $this->currency->format($product['subtotal'], $currency, $currency) : $product['subtotal'],
			);
		}

		$data['total'] = $cart['total'];

		$data['restore_url'] = $catalog_url->link('neoseo_checkout/dropped_cart/restore', 'token=' . $cart['token']);

		$html = $this->load->view('mail/' . $this->_moduleSysName . '/' . basename($filename), $data);

		$subject = $this->config->get($this->_moduleSysName . '_dropped_cart_email_subject');

		// Send out any gift voucher mails
		$this->load->model('tool/neoseo_mail');

		$mail = $this->model_tool_neoseo_mail;
		$mail->protocol = $this->config->get('config_mail_protocol');
		$mail->parameter = $this->config->get('config_mail_parameter');
		$mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
		$mail->smtp_username = $this->config->get('config_mail_smtp_username');
		$mail->smtp_password = $this->config->get('config_mail_smtp_password');
		$mail->smtp_port = $this->config->get('config_mail_smtp_port');
		$mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');

		$store_name = $this->config->get('config_langdata');

		$mail->setTo($email);
		$mail->setFrom($this->config->get('config_email'));
		$mail->setSender($store_name[key($store_name)]['name']);
		//$this->log($subject);
		$mail->setSubject($subject);

		$mail->setHTML($html);

		if ($email && $email != "empty@localhost") {
			$mail->send();
			$this->markSent($cid);
		}

		$response = array(
			'status' => 'ok',
			'email' => $email
		);

		return $response;
	}

}
