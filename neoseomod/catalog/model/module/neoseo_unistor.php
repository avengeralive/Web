<?php

require_once( DIR_SYSTEM . "/engine/neoseo_model.php");

class ModelModuleNeoSeoUnistor extends NeoSeoModel
{

	public function __construct($registry)
	{
		parent::__construct($registry);
		$this->_moduleSysName = "neoseo_unistor";
		$this->_logFile = $this->_moduleSysName . ".log";
		$this->debug = $this->config->get($this->_moduleSysName . "_debug") == 1;
	}

	public function getRemarketing()
	{

		$result = array(
			'conversion' => $this->config->get("neoseo_unistor_ga_remarketing"),
			'ecomm_prodid' => '',
			'ecomm_totalvalue' => '0',
			'ecomm_pagetype' => 'other'
		);

		if (!$result['conversion']) {
			return $result;
		}

		if (!isset($this->request->get['route']) || $this->request->get['route'] == "common/home") {
			$result['ecomm_pagetype'] = "home";
		} else if ($this->request->get['route'] == "product/product") {
			$product_id = $this->request->get['product_id'];
			$query = $this->db->query("SELECT price FROM " . DB_PREFIX . "product WHERE product_id = '" . (int) $product_id . "'");
			$price = 0;
			if ($query->num_rows > 0) {
				$price = $query->row['price'];
			}
			$result['ecomm_prodid'] = $product_id;
			$result['ecomm_totalvalue'] = $price;
			$result['ecomm_pagetype'] = "product";
		} else if ($this->request->get['route'] == "product/category") {
			$result['ecomm_pagetype'] = "category";
		} else if ($this->request->get['route'] == "product/search") {
			$result['ecomm_pagetype'] = "searchresults";
		} else if ($this->request->get['route'] == "checkout/checkout") {
			$products = $this->cart->getProducts();
			if (count($products) > 1) {
				$product_ids = array();
				$product_prices = array();
				foreach ($products as $product) {
					$product_ids[] = $product['product_id'];
					$product_prices[] = $product['total'];
				}
				$result['ecomm_prodid'] = $product_ids;
				$result['ecomm_totalvalue'] = $product_prices;
			} else {
				$result['ecomm_prodid'] = $products[0]['product_id'];
				$result['ecomm_totalvalue'] = $products[0]['total'];
			}
			$result['ecomm_pagetype'] = "purchase";
		}


		return $result;
	}

	function check_identity($identity)
	{

		$sql = "SHOW COLUMNS FROM `" . DB_PREFIX . "customer` LIKE 'identity';";
		$query = $this->db->query($sql);
		if (!$query->num_rows) {
			$this->db->query("ALTER TABLE `" . DB_PREFIX . "customer`  ADD `identity` VARCHAR(255) NULL");
		}

		$sql = "
			SELECT customer_id
			  FROM " . DB_PREFIX . "customer
			 WHERE identity = '" . $this->db->escape($identity) . "'";
		$query = $this->db->query($sql);

		if ($query->num_rows) {
			return $query->row['customer_id'];
		} else {
			return false;
		}
	}

	public function add_customer($data)
	{
		$this->db->query("INSERT INTO " . DB_PREFIX . "customer (identity, firstname, lastname, email, telephone, fax, newsletter, customer_group_id, password, status, date_added) VALUES ('" . $this->db->escape($data['identity']) . "', '" . $this->db->escape($data['firstname']) . "', '" . $this->db->escape($data['lastname']) . "', '" . $this->db->escape($data['email']) . "', '', '', '0', '" . (int) $data['customer_group_id'] . "', '" . $this->db->escape(md5($data['password'])) . "', '1', NOW())");

		return $this->db->getLastId(); // customer_id
	}

	public function registerCustomer($params)
	{
		$regularData = array(
			"firstname" => "",
			"lastname" => "",
			"email" => "",
			"telephone" => "",
			"fax" => "",
			"password" => '',
			"newsletter" => isset($params['newsletter']) ? 1 : 0,
			"customer_group_id" => (int) $params['type'],
			"company" => "",
			"company_id" => "",
			"tax_id" => "",
			"address_1" => "----",
			"address_2" => "",
			"city" => "--",
			"postcode" => "",
			"country_id" => $this->config->get('config_country_id'),
			"zone_id" => $this->config->get('config_zone_id'),
		);

		$customData = array(
			"type" => (int) $params['type']
		);


		// Заполняем поля данными
		$fields = $this->config->get('neoseo_checkout_customer_fields');
		$type = $customData['type'];
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

	public function login($customer_id)
	{
		$customer_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer WHERE customer_id = '" . (int) $customer_id . "' AND status = '1'");


		if ($customer_query->num_rows) {
			$this->session->data['customer_id'] = $customer_query->row['customer_id'];

			if (($customer_query->row['cart']) && (is_string($customer_query->row['cart']))) {
				$cart = unserialize($customer_query->row['cart']);

				foreach ($cart as $key => $value) {
					if (!array_key_exists($key, $this->session->data['cart'])) {
						$this->session->data['cart'][$key] = $value;
					} else {
						$this->session->data['cart'][$key] += $value;
					}
				}
			}

			$this->customer_id = $customer_query->row['customer_id'];
			$this->firstname = $customer_query->row['firstname'];
			$this->lastname = $customer_query->row['lastname'];
			$this->email = $customer_query->row['email'];
			$this->telephone = $customer_query->row['telephone'];
			$this->fax = $customer_query->row['fax'];
			$this->newsletter = $customer_query->row['newsletter'];
			$this->customer_group_id = $customer_query->row['customer_group_id'];
			$this->address_id = $customer_query->row['address_id'];

			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function generate_password($number)
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

	public function generateMenuStyle($categories)
	{
		$style = '';
		foreach ($categories as $category) {
			if ($category['children']) {
				if (($category['icon'] != '')) {
					$style .= ("li.menu-item-" . $category['pid'] . " > .dropdown-menu {top: 57px;} a.menu-item-" . $category['pid'] . " { padding-bottom: 8px; }");
				}

				if (($category['bg_color'] != '') || ($category['font_color'] != '') || ($category['max_width'] != '')) {
					$style .= '.menu-item-' . $category['pid'] . ' { ' .
					    ($category['bg_color'] ? ' background-color: ' . $category['bg_color'] . ' !important ;' : '') . ' ' .
					    ($category['font_color'] ? ' color: ' . $category['font_color'] . ' !important ;' : '') .
					    ($category['max_width'] ? ' max-width: ' . $category['max_width'] . 'px ;' : '') . ' }';
				}


				if (($category['hover_bg_color'] != '') || ($category['hover_font_color'] != '')) {
					$style .= '.menu-item-' . $category['pid'] . ':hover { ' .
					    ($category['hover_bg_color'] ? ' background-color: ' . $category['hover_bg_color'] . ' !important ;' : '' ) . ' ' .
					    ($category['hover_font_color'] ? ' color: ' . $category['hover_font_color'] . ' !important ;' : '' ) . '  }';
				}


				foreach ($category['children'] as $child) {
					if (($child['bg_color'] != '') || ($child['font_color'] != '') || ($child['max_width'] != '')) {
						$style .= '.menu-item-' . $child['pid'] . ' { ' .
						    ($child['bg_color'] ? ' background-color: ' . $child['bg_color'] . ' !important ;' : '') . ' ' .
						    ($child['font_color'] ? ' color: ' . $child['font_color'] . ' !important ;' : '') . ' ' .
						    ($child['max_width'] ? ' max-width: ' . $child['max_width'] . 'px ;' : '') . '}';
					}
					if (($child['bg_color'] != '') || ($child['font_color'] != '')) {
						$style .= '.menu-item-' . $child['pid'] . ':hover { ' .
						    ($child['hover_bg_color'] ? ' background-color: ' . $child['hover_bg_color'] . ' !important ;' : '' ) . ' ' .
						    ($child['hover_font_color'] ? ' color: ' . $child['hover_font_color'] . ' !important ;' : '' ) . '  }';
					}

					foreach ($child['children'] as $subchild) {
						if (($subchild['bg_color'] != '') || ($subchild['font_color'] != '') || ($subchild['max_width'] != '')) {
							$style .= '.menu-item-' . $subchild['pid'] . ' { ' .
							    ($subchild['bg_color'] ? ' background-color: ' . $subchild['bg_color'] . ' !important ;' : '' ) . ' ' .
							    ($subchild['font_color'] ? ' color: ' . $subchild['font_color'] . ' !important ;' : '' ) . ' ' .
							    ($subchild['max_width'] ? ' max-width: ' . $subchild['max_width'] . 'px ;' : '' ) . '}';
						}
						if (($subchild['bg_color'] != '') || ($subchild['font_color'] != '')) {
							$style .= '.menu-item-' . $subchild['pid'] . ':hover { ' .
							    ($subchild['hover_bg_color'] ? ' background-color: ' . $subchild['hover_bg_color'] . ' !important ;' : '' ) . ' ' .
							    ($subchild['hover_font_color'] ? ' color: ' . $subchild['hover_font_color'] . ' !important ;' : '' ) . ' cursor: pointer;}';
						}

						foreach ($subchild['children'] as $subchildren) {
							if (($subchildren['bg_color'] != '') || ($subchildren['font_color'] != '') || ($subchildren['max_width'] != '')) {
								$style .= '.menu-item-' . $subchildren['pid'] . ' { ' .
								    ($subchildren['bg_color'] ? ' background-color: ' . $subchildren['bg_color'] . ' !important ;' : '' ) . ' ' .
								    ($subchildren['font_color'] ? ' color: ' . $subchildren['font_color'] . ' !important ;' : '' ) . ' ' .
								    ($subchildren['max_width'] ? ' max-width: ' . $subchildren['max_width'] . 'px ;' : '' ) . '}';
							}
							if (($subchildren['bg_color'] != '') || ($subchildren['font_color'] != '')) {
								$style .= '.menu-item-' . $subchildren['pid'] . ':hover { ' .
								    ($subchildren['hover_bg_color'] ? ' background-color: ' . $subchildren['hover_bg_color'] . ' !important ;' : '' ) . ' ' .
								    ($subchildren['hover_font_color'] ? ' color: ' . $subchildren['hover_font_color'] . ' !important ;' : '' ) . ' cursor: pointer; }';
							}
						}
					}
				}
			} else {
				if (($category['icon'] != '')) {

					$style .= ("li.menu-item-" . $category['pid'] . " > .dropdown-menu {top: 57px;} a.menu-item-" . $category['pid'] . " { padding-bottom: 8px; }");
				}
				if (($category['bg_color'] != '') || ($category['font_color'] != '') || ($category['max_width'] != '')) {
					$style .= '.menu-item-' . $category['pid'] . ' { ' .
					    ($category['bg_color'] ? ' background-color: ' . $category['bg_color'] . ' !important ;' : '' ) . ' ' .
					    ($category['font_color'] ? ' color: ' . $category['font_color'] . ' !important ;' : '' ) . ' ' .
					    ($category['max_width'] ? ' max-width: ' . $category['max_width'] . 'px ;' : '' ) . '}';
				}
				if (($category['bg_color'] != '') || ($category['font_color'] != '')) {
					$style .= '.menu-item-' . $category['pid'] . ':hover { ' .
					    ($category['hover_bg_color'] ? ' background-color: ' . $category['hover_bg_color'] . ' !important ;' : '' ) . ' ' .
					    ($category['hover_font_color'] ? ' color: ' . $category['hover_font_color'] . ' !important ;' : '' ) . '  }';
				}
			}
		}

		return $style;
	}

	public function processHeaderData($data)
	{
		$data['text_watched'] = $this->language->get("text_watched");
		$data['text_compare'] = $this->language->get("text_compare");
		$data['text_wishlist'] = $this->language->get("text_wishlist");
		$data['text_compare_menu'] = $this->language->get("text_compare_menu");
		$data['text_wishlist_menu'] = $this->language->get("text_wishlist_menu");
		$data['text_callback'] = $this->language->get("text_callback");
		$data['text_information'] = $this->language->get("text_information");
		$data['text_work_hours'] = $this->language->get("text_work_hours");
		$data['text_category'] = $this->language->get("text_category");
		$data['text_menu_name'] = $this->language->get("text_menu_name");


		$url = $this->config->get('config_secure') ? $this->config->get('config_ssl') : $this->config->get('config_url');
		if ($this->config->get("neoseo_unistor_background")) {
			$data['background_image'] = $url . "image/" . $this->config->get("neoseo_unistor_background");
		}
		$data['watched'] = $this->url->link("account/neoseo_watched");
		$data['compare'] = $this->url->link("product/compare");
		if ($this->config->get('neoseo_account_status')) {
			$data['account'] = $this->url->link('account/neoseo_account', '', 'SSL');
			$data['register'] = $this->url->link('account/neoseo_register', '', 'SSL');
			$data['login'] = $this->url->link("account/neoseo_login");
			$data['order'] = $this->url->link('account/neoseo_order', '', 'SSL');
			$data['logout'] = $this->url->link('account/neoseo_logout', '', 'SSL');
		}
		if ($this->customer->isLogged()) {
			$this->load->model('account/wishlist');
			$data['unistor_wishlist_total'] = $this->model_account_wishlist->getTotalWishlist();
		} else {
			$data['unistor_wishlist_total'] = 0; //isset($this->session->data['wishlist']) ? count($this->session->data['wishlist']) : 0;
		}
		$data['unistor_compare_total'] = isset($this->session->data['compare']) ? count($this->session->data['compare']) : 0;
		$data['unistor_cart_total'] = $this->cart->countProducts();

		$this->load->model("module/neoseo_unistor");

		if ($this->config->get('neoseo_menu_status')) {
			$this->load->model("module/neoseo_menu");
			$data['top_menu_items'] = $this->model_module_neoseo_menu->getMenu(0, $this->config->get("neoseo_unistor_top_menu_items"));
			$data['sticky_menu_items'] = $this->model_module_neoseo_menu->getMenu(0, $this->config->get("neoseo_unistor_sticky_menu_items"));
			$data['categories'] = $this->model_module_neoseo_menu->getMenu(0, $this->config->get("neoseo_unistor_menu_main_items"));
			$data['categories_style'] = $this->generateMenuStyle($data['categories']);
		} else {
			$data['top_menu_items'] = $this->standardHeaderMenu();
			$data['sticky_menu_items'] = array();
			$data['categories'] = $this->standardMainMenu();
			$data['categories_style'] = '';
		}


		$data['top_banner'] = $this->config->get("neoseo_unistor_top_banner");
		$data['menu_main_type'] = $this->config->get("neoseo_unistor_menu_main_type");
		$data['tracking'] = $this->config->get("neoseo_unistor_tracking");
		$data['locations'] = $this->config->get("neoseo_unistor_locations");
		$data['top_banner_background'] = $this->config->get("neoseo_unistor_top_banner_background");
		$data['top_banner_height'] = $this->config->get("neoseo_unistor_top_banner_height");
		$data['icon_position'] = $this->config->get("neoseo_unistor_menu_main_icon_position");
		$data['sticky_menu'] = $this->config->get("neoseo_unistor_sticky_menu");
		$data['sticky_menu_type'] = $this->config->get("neoseo_unistor_sticky_menu_type");

		$data['top_banner_link'] = '';
		$top_banner_link = $this->config->get("neoseo_unistor_top_banner_link");
		if (isset($top_banner_link[$this->config->get("config_language_id")])) {
			$data['top_banner_link'] = $top_banner_link[$this->config->get("config_language_id")];
		}

		$data['phone1'] = $this->config->get("neoseo_unistor_phone1");
		$data['phone2'] = $this->config->get("neoseo_unistor_phone2");
		$data['phone3'] = $this->config->get("neoseo_unistor_phone3");
		$data['phone1_text'] = "";

		$phone1_text = $this->config->get("neoseo_unistor_phone1_text");
		if (isset($phone1_text[$this->config->get("config_language_id")])) {
			$data['phone1_text'] = $phone1_text[$this->config->get("config_language_id")];
		}
		$data['phone2_text'] = "";
		$phone2_text = $this->config->get("neoseo_unistor_phone2_text");
		if (isset($phone2_text[$this->config->get("config_language_id")])) {
			$data['phone2_text'] = $phone2_text[$this->config->get("config_language_id")];
		}
		$data['phone3_text'] = "";
		$phone3_text = $this->config->get("neoseo_unistor_phone3_text");
		if (isset($phone3_text[$this->config->get("config_language_id")])) {
			$data['phone3_text'] = $phone3_text[$this->config->get("config_language_id")];
		}
		$data['phone_main_text'] = "";
		$phone_main_text = $this->config->get("neoseo_unistor_phone_main_text");
		if (isset($phone_main_text[$this->config->get("config_language_id")])) {
			$data['phone_main_text'] = $phone_main_text[$this->config->get("config_language_id")];
		}

		$work_time = $this->config->get("neoseo_unistor_work_time");
		$data['work_time'] = '';
		if (isset($work_time[$this->config->get("config_language_id")])) {
			$data['work_time'] = $work_time[$this->config->get("config_language_id")];
		}

        $recent_search = $this->config->get("neoseo_unistor_header_recent_search");

		$data['recent_search'] = array();
        if (isset($recent_search[$this->config->get("config_language_id")])) {
            $data_recent_search = explode(",", $recent_search[$this->config->get("config_language_id")]);
            foreach ($data_recent_search as $result) {
                $data['recent_search'][] = ltrim(rtrim($result));
            }
        }

		if ($this->config->get('neoseo_unistor_menu_width') == "1") {
			$data['menu_class'] = "menu_container_width";
		} else {
			$data['menu_class'] = "menu_full_width";
		}

		if (isset($this->request->server['HTTPS']) && (($this->request->server['HTTPS'] == 'on') || ($this->request->server['HTTPS'] == '1'))) {
			$server = $this->config->get('config_ssl');
		} else {
			$server = $this->config->get('config_url');
		}

		$unistor_logo = $this->config->get('neoseo_unistor_logo');
		$language_id = $this->config->get('config_language_id');
		if ($unistor_logo && isset($unistor_logo[$language_id])) {
			$unistor_logo_file = $unistor_logo[$language_id];
		} else {
			$unistor_logo_file = '';
		}
		if (is_file(DIR_IMAGE . $unistor_logo_file)) {
			$data['unistor_logo'] = $server . 'image/' . $unistor_logo_file;
		} else {
			$data['unistor_logo'] = '';
		}
		$unistor_top_banner_image = $this->config->get('neoseo_unistor_top_banner_image');

		if ($unistor_top_banner_image && isset($unistor_top_banner_image[$language_id])) {
			$unistor_banner_file = $unistor_top_banner_image[$language_id];
		} else {
			$unistor_banner_file = '';
		}
		if (is_file(DIR_IMAGE . $unistor_banner_file)) {
			$data['unistor_banner'] = $server . 'image/' . $unistor_banner_file;
		} else {
			$data['unistor_banner'] = '';
		}

		$data['neoseo_unistor_column_count'] = $this->config->get('neoseo_unistor_column_count');

		$directory = DIR_APPLICATION . 'view/theme/neoseo_unistor/stylesheet/stylesheet-*.css';
		$files = glob($directory);
		if ($files) {
			$data['main_stylesheet'] = basename($files[0]);
		} else {
			$data['main_stylesheet'] = '';
		}
		return $data;
	}

	public function processFooterData($data)
	{
		if ($this->config->get('neoseo_menu_status')) {
			$this->load->model("module/neoseo_menu");
		}

		$this->document->addScript('catalog/view/theme/neoseo_unistor/javascript/jssocials.js');
		$this->document->addScript('catalog/view/javascript/neoseo_subscribe.js');

		$data['remarketing'] = $this->getRemarketing();

		$data['neoseo_unistor_hover_image'] = $this->config->get($this->_moduleSysName . '_hover_image');
		$data['button_subscribe'] = $this->language->get("button_subscribe");
		$data['text_subscribe_title'] = $this->language->get("text_subscribe_title");
		$data['text_payments_title'] = $this->language->get("text_payments_title");
		$data['text_subscribe_par'] = $this->language->get("text_subscribe_par");
		$data['entry_email'] = $this->language->get("entry_email");

		$language_id = $this->config->get("config_language_id");

		$data['sections'] = array();
		$sections = $this->config->get($this->_moduleSysName . '_footer_sections');
		foreach (range(1, 5) as $section_id) {
			$text = isset($sections[$section_id][$language_id]) ? $sections[$section_id][$language_id] : '';
			$data['sections'][$section_id] = html_entity_decode($text);
		}

		$data['columns'] = array();
		$column_types = $this->config->get($this->_moduleSysName . '_footer_column_types');
		$column_texts = $this->config->get($this->_moduleSysName . '_footer_column_texts');
		$column_names = $this->config->get($this->_moduleSysName . '_footer_column_names');
		$footer_menu = $this->config->get($this->_moduleSysName . '_footer_column_menu');

		foreach (range(1, 3) as $column_id) {
			$column = array();

			$column['type'] = $column_types[$column_id];
			$column['name'] = isset($column_names[$column_id][$language_id]) ? $column_names[$column_id][$language_id] : '';

			if ($column['type'] == 0) {
				$text = isset($column_texts[$column_id][$language_id]) ? $column_texts[$column_id][$language_id] : '';
				$column['items'] = html_entity_decode($text);
			} elseif ($this->config->get('neoseo_menu_status')) {
				$column['items'] = $this->model_module_neoseo_menu->getMenu(0, $footer_menu[$column_id]);
			} else {
				$column['items'] = array();
			}

			$data['columns'][$column_id] = $column;
		}

		return $data;
	}

	protected function standardHeaderMenu()
	{
		$this->load->model('catalog/information');

		$data = array();

		$items = $this->model_catalog_information->getInformations();
		foreach ($items as $item) {
			if ($item['bottom']) {
				$data[] = array(
					'name' => $item['title'],
					'children' => array(),
					'column' => 1,
					'href' => $this->url->link('catalog/information', 'information_id=' . (int)$item['information_id']),
					'style' => '',
					'icon_position' => '',
					'icon' => '',
					'class' => '',
					'params' => '',
					'menu_params' => '',
					'pid' => $item['information_id'],
				);
			}
		}
		return $data;
	}

	protected function standardMainMenu()
	{

		$this->load->model('catalog/category');
		$this->load->model('catalog/product');

		$data = array();

		$categories = $this->model_catalog_category->getCategories(0);

		foreach ($categories as $category) {
			if ($category['top']) {
				$children_data = array();
				$children = $this->model_catalog_category->getCategories($category['category_id']);
				foreach ($children as $child) {
					$filter_data = array(
						'filter_category_id' => $child['category_id'],
						'filter_sub_category' => true
					);
					$children_data[] = array(
						'name' => $child['name'] . ($this->config->get('config_product_count') ? ' (' . $this->model_catalog_product->getTotalProducts($filter_data) . ')' : ''),
						'href' => $this->url->link('product/category', 'path=' . $category['category_id'] . '_' . $child['category_id']),
						'children' => array(),
						'style' => '',
						'icon_position' => '',
						'icon' => '',
						'class' => '',
						'params' => '',
						'menu_params' => '',
						'pid' => $category['category_id'],
					);
				}
				$data[] = array(
					'name' => $category['name'],
					'children' => $children_data,
					'column' => $category['column'] ? $category['column'] : 1,
					'href' => $this->url->link('product/category', 'path=' . $category['category_id']),
					'style' => '',
					'icon_position' => '',
					'icon' => '',
					'class' => '',
					'params' => '',
					'menu_params' => 'mega gorizontal-menu',
					'pid' => $category['category_id'],
				);
			}
		}
		return $data;
	}

	public function processContactData($data)
	{
		$language_id = $this->config->get('config_language_id');

		$data['section_status'] = $this->config->get($this->_moduleSysName . '_contact_sections_status');
		$data['sections'] = array();

		$sections = $this->config->get($this->_moduleSysName . '_contact_section_texts');
		$titles = $this->config->get($this->_moduleSysName . '_contact_section_names');
		foreach (range(1, 4) as $section_id) {
			$data['sections'][$section_id] = array(
				'title' => isset($titles[$section_id][$language_id]) ? html_entity_decode($titles[$section_id][$language_id]) : '',
				'txt' => isset($sections[$section_id][$language_id]) ? html_entity_decode($sections[$section_id][$language_id]) : '',
			);
		}

		$data['map'] = $this->config->get($this->_moduleSysName . '_contact_map');
		$data['latitude'] = $this->config->get($this->_moduleSysName . '_contact_latitude');
		$data['longitude'] = $this->config->get($this->_moduleSysName . '_contact_longitude');
		$data['google_api_key'] = $this->config->get($this->_moduleSysName . '_contact_google_api_key');
		$data['store_name'] = $this->config->get('config_name');

		$data['form_status'] = $this->config->get($this->_moduleSysName . '_contact_form_status');

		return $data;
	}

	public function getMenuStatus($menu_id)
	{
		$sql = "
			SELECT status
			  FROM " . DB_PREFIX . "neoseo_menu
			 WHERE menu_id = '" . (int) $menu_id . "' ";

		$query = $this->db->query($sql);

		if ($query->num_rows) {
			return $query->row['status'];
		} else {
			return false;
		}
	}

	public function processProductData($data, $product_info)
	{
        $data['text_characteristics_title'] = $this->language->get('text_characteristics_title');
        $data['text_product_action'] = $this->language->get('text_product_action');
        $data['text_follow_price'] = $this->language->get('text_follow_price');
        $data['text_all_characteristics'] = $this->language->get('text_all_characteristics');
        $data['text_see_all'] = $this->language->get('text_see_all');
        $data['text_collapse_all'] = $this->language->get('text_collapse_all');
        $data['text_more'] = $this->language->get('text_more');
        $data['text_reviews_quantity'] = $this->language->get('text_reviews_quantity');
        $data['text_give_feedback'] = $this->language->get('text_give_feedback');
        $data['text_see_all_reviews'] = $this->language->get('text_see_all_reviews');
        $data['text_comment_answer'] = $this->language->get('text_comment_answer');
        $data['text_all_reviews'] = $this->language->get('text_all_reviews');
        $data['text_shipping'] = $this->language->get('text_shipping');
        $data['text_payment'] = $this->language->get('text_payment');
        $data['text_guarantee'] = $this->language->get('text_guarantee');


		$data['text_wishlist'] = $this->language->get('text_wishlist');
		$data['text_compare'] = $this->language->get('text_compare');
		$data['hover_type'] = $this->config->get('neoseo_unistor_product_hover_type');
		$data['selected_attributes_show'] = $this->config->get('neoseo_unistor_product_selected_attributes_show');
		$data['divider'] = $this->config->get('neoseo_unistor_product_selected_attributes_custom_divider');
		$data['hover_attributes'] = $this->config->get('neoseo_unistor_product_hover_attributes');
		$data['zoom'] = $this->config->get('neoseo_unistor_product_zoom');

		$data['button_write'] = $this->language->get("button_write");
		$data['neoseo_quick_order_status'] = $this->config->get('neoseo_quick_order_status') || $this->config->get('soforp_quickorder_status');
		$urlStatus = $this->config->get("neoseo_unistor_prev_next_status");
		$linkStatus = $this->config->get("neoseo_unistor_prev_next_link_status");

		if ($urlStatus || $linkStatus) {
			$rsNext = $this->model_catalog_product->getNextProduct($product_info['product_id'], isset($category_id) ? $category_id : 0);
			$data['next_text'] = $this->language->get('next_text');
			$data['next_url'] = '';
			if ($rsNext) {
				if ($urlStatus) {
					$data['next_url'] = $this->url->link('product/product', 'product_id=' . $rsNext);
				}
				if ($linkStatus) {
					$this->document->addLink($data['next_url'], "next");
				}
			}

			$rsPrev = $this->model_catalog_product->getPrevProduct($product_info['product_id'], isset($category_id) ? $category_id : 0);
			$data['prev_text'] = $this->language->get('prev_text');
			$data['prev_url'] = '';
			if ($rsPrev) {
				if ($urlStatus) {
					$data['prev_url'] = $this->url->link('product/product', 'product_id=' . $rsPrev);
				}
				if ($linkStatus) {
					$this->document->addLink($data['prev_url'], "prev");
				}
			}
		}

		$data['product_to_email'] = $this->config->get("neoseo_product_to_email_status") == 1;

		$shipping_info = $this->config->get("neoseo_unistor_delivery");
		if ($shipping_info && isset($shipping_info[$this->config->get("config_language_id")])) {
			$data['shipping_info'] = html_entity_decode($shipping_info[$this->config->get("config_language_id")]);
		} else {
			$data['shipping_info'] = '';
		}

		$payment_info = $this->config->get("neoseo_unistor_payment");
		if ($payment_info && isset($payment_info[$this->config->get("config_language_id")])) {
			$data['payment_info'] = html_entity_decode($payment_info[$this->config->get("config_language_id")]);
		} else {
			$data['payment_info'] = '';
		}

		$guarantee_info = $this->config->get("neoseo_unistor_guarantee");
		if ($guarantee_info && isset($guarantee_info[$this->config->get("config_language_id")])) {
			$data['guarantee_info'] = html_entity_decode($guarantee_info[$this->config->get("config_language_id")]);
		} else {
			$data['guarantee_info'] = '';
		}

		$data['text_price'] = $this->language->get('text_price');
		if ($product_info['date_special'] && $product_info['date_special'] != "0000-00-00") {
			$data['date_special'] = strtotime($product_info['date_special']) - strtotime('now');
		} else {
			$data['date_special'] = '';
		}

		if ($product_info['quantity'] <= 0) {
			$data['stock_status_id'] = $product_info['stock_status_id'];
			$data['stock_status'] = $product_info['stock_status'];
		} else {
			$data['stock_status_id'] = 0;
			$data['stock_status'] = $this->language->get('text_instock');
		}

		$data['name'] = $product_info['name'];
		$data['md_availability'] = $product_info['status'];
		$data['md_review_count'] = $product_info['reviews'];
		$data['md_currency'] = $this->currency->getCode();

        $this->load->model('catalog/review');

        $data['text_no_reviews'] = $this->language->get('text_no_reviews');

        if (isset($this->request->get['page'])) {
            $page = $this->request->get['page'];
        } else {
            $page = 1;
        }
        $data['page'] = $page;
        $review_total = $this->model_catalog_review->getTotalReviewsByProductId($this->request->get['product_id']);

        $results = $this->model_catalog_review->getReviewsByProductId($this->request->get['product_id'], ($page - 1) * 5, 5);
        $data['reviews'] = array();

        foreach ($results as $result) {
            $data['reviews'][] = array(
                'author' => $result['author'],
                'text' => nl2br($result['text']),
                'rating' => (int) $result['rating'],
                'date_added' => date($this->language->get('date_format_short'), strtotime($result['date_added']))
            );
        }

        $short_reviews = $this->model_catalog_review->getReviewsByProductId($this->request->get['product_id'], 0, 2);

        $pagination = new Pagination();
        $pagination->total = $review_total;
        $pagination->page = $page;
        $pagination->limit = 5;
        if (isset($this->request->get['path'])) {
            $pagination->url = $this->url->link('product/product', 'path=' . $this->request->get['path'] . '&product_id=' . $this->request->get['product_id'] . '&page={page}');
        } else {
            $pagination->url = $this->url->link('product/product', 'product_id=' . $this->request->get['product_id'] . '&page={page}');
        }

        $data['pagination'] = $pagination->render();

        $data['results'] = sprintf($this->language->get('text_pagination'), ($review_total) ? (($page - 1) * 5) + 1 : 0, ((($page - 1) * 5) > ($review_total - 5)) ? $review_total : ((($page - 1) * 5) + 5), $review_total, ceil($review_total / 5));

        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/product/review.tpl')) {
            $data['static_reviews'] = $this->load->view($this->config->get('config_template') . '/template/product/review.tpl', $data);
        } else {
            $data['static_reviews'] = $this->load->view('default/template/product/review.tpl', $data);
        }

        $data['reviews'] = array();
        $data['pagination'] = '';
        $data['short_reviews_status'] = $short_reviews;

        foreach ($short_reviews as $result) {
            $data['reviews'][] = array(
                'author' => $result['author'],
                'text' => nl2br($result['text']),
                'rating' => (int) $result['rating'],
                'date_added' => date($this->language->get('date_format_short'), strtotime($result['date_added']))
            );
        }

        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/product/review.tpl')) {
            $data['short_reviews'] = $this->load->view($this->config->get('config_template') . '/template/product/review.tpl', $data);
        } else {
            $data['short_reviews'] = $this->load->view('default/template/product/review.tpl', $data);
        }

        return $data;
	}

	public function processSearchData($data = array())
	{

		$cache_key = $this->_moduleSysName . '_search_categories_' . $this->config->get('config_language_id');
        $data['menu_main_type'] = $this->config->get("neoseo_unistor_menu_main_type");
		$data['categories'] = $this->cache->get($cache_key);
		$this->load->language('module/neoseo_unistor');
		$data['text_category'] = $this->language->get("text_category");
		$data['text_all_categories'] = $this->language->get("text_all_categories");
		$data['button_search'] = $this->language->get("button_search");
		if (!$data['categories']) {

			$data['categories'] = array();
			$this->load->model('catalog/category');

			$categories = $this->model_catalog_category->getCategories(0);


			foreach ($categories as $category) {
				if ($category['top']) {
					$data['categories'][] = array(
						'category_id' => $category['category_id'],
						'name' => $category['name'],
					);
				}
			}

			$this->cache->set($cache_key, $data['categories']);
		}

		return $data;
	}

}
