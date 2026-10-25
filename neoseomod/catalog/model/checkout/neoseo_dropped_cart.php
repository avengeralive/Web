<?php

require_once(DIR_SYSTEM . "/engine/neoseo_model.php");

class ModelCheckoutNeoSeoDroppedCart extends NeoSeoModel
{

	const TABLE_DROPPED_CART = 'dropped_cart';
	const TABLE_DROPPED_CART_PRODUCTS = 'dropped_cart_product';

	private $customer_id = null;
	private $email = null;
	private $products = array();
	private $record = null;
	private $saved_ids = array();
	private $record_changed = array();

	public function __construct($registry)
	{
		parent::__construct($registry);
		$this->_moduleSysName = 'neoseo_checkout';
		$this->_logFile = $this->_moduleSysName . ".log";
		$this->debug = $this->config->get($this->_moduleSysName . '_debug');
	}

	public function save()
	{
		if ($this->record) {
			/* Update cart modification date */
			$this->db->query("UPDATE `" . DB_PREFIX . self::TABLE_DROPPED_CART . "` SET modified=NOW() WHERE `dropped_cart_id`=" . (int) $this->record['dropped_cart_id']);
		} else {
			$this->log('Create new dropped cart');
			/* Create new dropped cart */
			$this->record = array(
				'dropped_cart_id' => null,
				'customer_id' => $this->customer_id,
				'email' => $this->getEmail(),
				'token' => token(32)
			);

			$this->db->query("INSERT INTO `" . DB_PREFIX . self::TABLE_DROPPED_CART . "` (`dropped_cart_id`, `customer_id`, `email`, `modified`, `created`, `token`) VALUES " . "(null, " . (int) $this->record['customer_id'] . ", '" . $this->db->escape($this->record['email']) . "', NOW(), NOW(), '" . $this->record['token'] . "')");

			$this->record['dropped_cart_id'] = $this->db->getLastId();
		}

		if (empty($this->record))
			throw new ErrorException('Dropped cart saving error.');

		if (!$this->products) {
			/* Remove all cart products if our array is empty */
			$this->clear();
			return;
		}

		/* Remove all broken cart products that missing in our array */
		$this->db->query("DELETE FROM `" . DB_PREFIX . self::TABLE_DROPPED_CART_PRODUCTS . "` WHERE `dropped_cart_id` = " . (int) $this->record['dropped_cart_id'] . " AND `product_id` NOT IN(" . implode(',', array_keys($this->products)) . ")");

		if (count($this->saved_ids) <= 0) {
			$this->_saved_ids = array(0);
		}

		/* Get all new IDs */
		$new = array_diff(array_keys($this->products), $this->saved_ids);
		//$this->log(print_r($new,true));

		foreach ($new as $k => $id) {
			$this->products[$id]['price'] = preg_replace('/[^\d\.]/', '', $this->products[$id]['price']);

			$new[$k] = '(' . (int) $this->record['dropped_cart_id'] . ', ' . (int) $id . ', "' . $this->db->escape(json_encode($this->products[$id]['option'])) . '", ' . (int) $this->products[$id]['quantity'] .
			    ', "' . $this->db->escape($this->products[$id]['image']) . '", "' . $this->db->escape($this->products[$id]['href']) . '", "' . $this->db->escape($this->products[$id]['name']) . '", ' .
			    (int) $this->products[$id]['cart_id'] . ', ' . (float) $this->products[$id]['price'] . ')';
		}

		if (sizeof($new) > 0) {
			/* Insert new products */
			$sql = "INSERT INTO `" . DB_PREFIX . self::TABLE_DROPPED_CART_PRODUCTS . "` (`dropped_cart_id`, `product_id`, `option`, `quantity`, `image`, `href`, `name`, `cart_id`, `price`) VALUES " . implode(', ', $new);

			$this->db->query($sql);
		}

		/* Update existing products */
		foreach ($this->saved_ids as $id) {
			$this->db->query('UPDATE `' . DB_PREFIX . self::TABLE_DROPPED_CART_PRODUCTS . '` SET `option` = "' . $this->db->escape(json_encode($this->products[$id]['option'])) . '", `quantity`=' . (int) $this->products[$id]['quantity'] .
			    ' WHERE `dropped_cart_id`=' . (int) $this->record['dropped_cart_id'] . ' AND `product_id`=' . (int) $id);
		}
	}

	public function setProducts($data, $clean = true)
	{
		$this->readStoredCart(true);

		$ids = array();

		foreach ($data as $product) {
			$ids[] = $product['product_id'];
			if (!isset($this->products[$product['product_id']])) {
				$this->products[$product['product_id']] = array(
					'cart_id' => $product['cart_id'],
					'product_id' => $product['product_id'],
					'option' => $product['option'],
					'quantity' => $product['quantity'],
					'image' => $product['image'],
					'href' => isset($product['href']) ? $product['href'] : '',
					'name' => $product['name'],
					'special' => isset($product['special']) ? $product['special'] : 0,
					'price' => $product['price'],
				);
			} else {
				$this->products[$product['product_id']]['quantity'] = $product['quantity'];
			}
		}
		//$this->log(print_r($this->products,true));
		if ($clean) {
			$ids_to_remove = array_diff(array_keys($this->products), $ids);

			foreach ($ids_to_remove as $key) {
				unset($this->products[$key]);
				$search = array_search($key, $this->saved_ids);

				if (isset($this->saved_ids[$search]))
					unset($this->saved_ids[$search]);
			}
		}

		$this->save();
	}

	private function readStoredCart($force = false)
	{

		if ($this->record || !$force) {
			return;
		}
		$this->log('Load dropped cart if it exists');
		/* Load dropped cart if it exists */
		$query = $this->db->query('SELECT * FROM `' . DB_PREFIX . self::TABLE_DROPPED_CART . '` WHERE `email`="' . $this->db->escape($this->getEmail()) . '" LIMIT 1');

		if ($query->num_rows) {
			$this->record = array_pop($query->rows);

			/* Load dropped cart products */
			$query = $this->db->query('SELECT * FROM `' . DB_PREFIX . self::TABLE_DROPPED_CART_PRODUCTS . '` WHERE `dropped_cart_id`=' . (int) $this->record['dropped_cart_id']);

			foreach ($query->rows as $row) {
				$row['option'] = json_decode($row['option']);
				$this->products[$row['product_id']] = $row;
				$this->saved_ids[] = $row['product_id'];
			}
		}
	}

	public function updateCart($add_cart = false)
	{
		$this->readStoredCart(true);

		if ($this->customer->isLogged()) {
			$name = $this->customer->getFirstName();
			$name = $name . ' ' . $this->customer->getLastName();

			if (isset($this->record['phone'])) {
				if ($this->record['phone'] != $this->customer->getTelephone()) {
					$this->record['phone'] = $this->customer->getTelephone();
					$this->record_changed[] = 'phone';
				}
			}
			if (isset($this->record['name'])) {
				if ($this->record['name'] != $name) {
					$this->record['name'] = $name;
					$this->record_changed[] = 'name';
				}
			} else {
				$this->record['name'] = $name;
			}
		} else {
			if (isset($this->session->data['guest'])) {
				if (isset($this->session->data['guest']['telephone']) && strlen($this->session->data['guest']['telephone']) > 0) {
					if (isset($this->record['phone'])) {
						if ($this->record['phone'] != $this->session->data['guest']['telephone']) {
							$this->record['phone'] = $this->session->data['guest']['telephone'];
							$this->record_changed[] = 'phone';
						}
					}
				} else {
					$this->record['phone'] = '';
				}
				if (isset($this->record['name'])) {
					$name = $this->record['name'];
				}
				if (isset($this->session->data['guest']['firstname'])) {
					$name = $this->session->data['guest']['firstname'];
				}

				if (isset($this->session->data['guest']['lastname'])) {
					$name .= ' ' . $this->session->data['guest']['lastname'];
				}
				if (isset($name) && isset($this->record['name'])) {
					if ($name != $this->record['name']) {
						$this->record['name'] = $name;
						$this->record_changed[] = 'name';
					}
				} else {
					$name = 'noname';
					$this->record['name'] = $name;
				}
			}
		}

		if (sizeof($this->record_changed) > 0) {
			$arr = array();

			foreach ($this->record_changed as $col) {
				$arr[] = '`' . $col . '`="' . $this->db->escape($this->record[$col]) . '"';
			}
			if (!isset($this->record['dropped_cart_id'])) {
				$this->record['dropped_cart_id'] = $this->db->getLastId();
			}
			$this->db->query('UPDATE `' . DB_PREFIX . self::TABLE_DROPPED_CART . '` SET ' . implode(',', $arr) . ' WHERE `dropped_cart_id`=' . (int) $this->record['dropped_cart_id']);

			$this->record_changed = array();
		}

		if ($add_cart) {
			$this->session->data['dropped_cart_update_process'] = true;

			foreach ($this->products as $product) {
				$this->request->post = $product; // Блядь, что это за хуйня?!
				$this->load->controller('checkout/cart/add');
			}
			unset($this->session->data['dropped_cart_update_process']);
		}
	}

	public function clear()
	{
		$this->readStoredCart(true);


		//$this->log(print_r($this->record,true));
		if ($this->record) {
			$this->db->query('DELETE FROM `' . DB_PREFIX . self::TABLE_DROPPED_CART_PRODUCTS . '` WHERE `dropped_cart_id`=' . (int) $this->record['dropped_cart_id']);
			$this->db->query('DELETE FROM `' . DB_PREFIX . self::TABLE_DROPPED_CART . '` WHERE `dropped_cart_id`=' . (int) $this->record['dropped_cart_id']);
		}

		$this->products = array();
		$this->record = false;
	}

	public function getEmail()
	{
		if ($this->email === null) {
			$this->email = false; // Это, сука, гениально... Ему за количество строк платили?

			/* Check if it is guest with filled email */
			if (isset($this->session->data['guest']) && isset($this->session->data['guest']['email'])) {
				$this->email = $this->session->data['guest']['email'];
			} elseif (isset($this->session->data['customer_id'])) {
				/* If logged in as customer save id and email */
				$this->customer_id = $this->session->data['customer_id'];

				$this->load->model('account/customer');
				$customer = $this->model_account_customer->getCustomer($this->customer_id);

				$this->email = $customer['email'];
			}
		}

		return $this->email;
	}

	public function load($token)
	{
		/* Load dropped cart if it exists */
		$query = $this->db->query('SELECT * FROM `' . DB_PREFIX . self::TABLE_DROPPED_CART . '` WHERE `token`="' . $this->db->escape($token) . '" LIMIT 1');
		//$this->log(print_r($query,true));
		if ($query->num_rows) {
			$this->record = array_pop($query->rows);

			if ($this->record['customer_id'])
				$this->customer_id = $this->record['customer_id'];

			$this->email = $this->record['email'];

			if (!isset($this->session->data['guest']))
				$this->session->data['guest'] = array('email' => $this->email);

			/* Load dropped cart products */
			$query = $this->db->query('SELECT * FROM `' . DB_PREFIX . self::TABLE_DROPPED_CART_PRODUCTS . '` WHERE `dropped_cart_id`=' . (int) $this->record['dropped_cart_id']);

			foreach ($query->rows as $row) {
				$row['option'] = json_decode($row['option']);
				$this->products[$row['product_id']] = $row;
				$this->saved_ids[] = $row['product_id'];
			}
		}
	}

}
