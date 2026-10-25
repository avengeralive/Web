<?php

require_once( DIR_SYSTEM . "/engine/neoseo_controller.php");

class ControllerCheckoutNeoSeoCustomer extends NeoSeoController
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

		$data['guest_checkout'] = ($this->config->get('config_guest_checkout') && !$this->config->get('config_customer_price') && !$this->cart->hasDownload());
		$data['shipping_required'] = true; //$this->cart->hasShipping();
		// All variables
		$data = $this->initConfigParams(array(
			$this->_moduleSysName . '_debug',
			$this->_moduleSysName . '_compact',
		    ), $data);

		$data['fields'] = $this->config->get($this->_moduleSysName . '_customer_fields');
		$data['logged'] = $this->customer->isLogged();
		// Если кастомер авторизован, то зачем заполнять поля заново?
		$customerData = array();
		if ($this->customer->isLogged()) {
			$this->load->model("checkout/" . $this->_moduleSysName);
			$this->load->model("account/address");
			$customerData = $this->model_checkout_neoseo_checkout->getCustomerData($this->customer->getId());
			$customerData['firstname'] = $this->customer->getFirstName();
			$customerData['lastname'] = $this->customer->getLastName();
			$customerData['email'] = $this->customer->getEmail();
			$customerData['telephone'] = $this->customer->getTelephone();
			$customerData['fax'] = $this->customer->getFax();
			$address = $this->model_account_address->getAddress($this->customer->getAddressId());
			if ($address) {
				$customerData['company'] = $address['company'];
				//$customerData['company_id'] = $address['company_id'];
				//$customerData['tax_id'] = $address['tax_id'];
			}
		}

		$this->load->model('account/customer_group');
		$items = $this->model_account_customer_group->getCustomerGroups();
		$displayed_customer_groups = $this->config->get('config_customer_group_display');
		if (!$displayed_customer_groups) {
			$displayed_customer_groups = array();
		}
		$customer_groups = array();
		foreach ($items as $item) {
			if (!in_array($item['customer_group_id'], $displayed_customer_groups)) {
				continue;
			}
			$customer_groups[$item['customer_group_id']] = $item['name'];
		}
		$data['customer_groups'] = $customer_groups;

		// Выводим поля по клиенту
		$fieldset = $this->config->get($this->_moduleSysName . '_customer_fields');
		$fieldshtml = array();
		foreach ($fieldset as $type => $fields) {
			if (!isset($customer_groups[$type])) {
				continue;
			}
			$fieldsRegister = array();

			foreach ($fields as $field) {
				$fieldName = $field['name'];

				// Если юзер авторизован, то флажки "зарегаться и получать новости" ему ни к чему
				if ($this->customer->isLogged() && in_array($fieldName, array("register", "newsletter", "password", "password2", 'discount')))
					continue;

				if (in_array($fieldName, array("password", "password2"))) {
					$field['required'] = 1;
				}

				if ("password" == $fieldName) {
					$field['type'] = "password";
				}

				if (isset($this->session->data['guest'][$fieldName])) {
					$field['value'] = $this->session->data['guest'][$fieldName];
				} else if (isset($this->session->data['guest']['payment'][$fieldName])) {
					$field['value'] = $this->session->data['guest']['payment'][$fieldName];
				} else if (isset($this->session->data['guest']['payment_' . $fieldName])) {
					$field['value'] = $this->session->data['guest']['payment_' . $fieldName];
				} else if (isset($this->session->data['guest']['shipping'][$fieldName])) {
					$field['value'] = $this->session->data['guest']['shipping'][$fieldName];
				} else if (isset($this->session->data['guest']['shipping_' . $fieldName])) {
					$field['value'] = $this->session->data['guest']['shipping_' . $fieldName];
				} else if ($this->customer->isLogged() && isset($customerData[$fieldName])) {
					$field['value'] = $customerData[$fieldName];
				} else {
					$field['value'] = $field['default'];
				}

				$fieldsRegister[] = $field;
			}
			$data['fields'] = $fieldsRegister;
			$data['delayScript'] = 1;
			$data['group'] = '_' . $type;
			$data['language_id'] = $this->config->get("config_language_id");

			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/checkout/neoseo_fields.tpl')) {
				$fieldshtml[$type] = $this->load->view($this->config->get('config_template') . '/template/checkout/neoseo_fields.tpl', $data);
			} else {
				$fieldshtml[$type] = $this->load->view('default/template/checkout/neoseo_fields.tpl', $data);
			}
		}

		$data['fieldset'] = $fieldshtml;



		if (isset($this->request->post['type'])) {
			$data['type_selected'] = $this->request->post['type'];
		} else if (isset($customerData['type'])) {
			$data['type_selected'] = $customerData['type'];
		} else {
			$data['type_selected'] = $this->config->get('config_customer_group_id');
		}

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/checkout/neoseo_customer.tpl')) {
			$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/checkout/neoseo_customer.tpl', $data));
		} else {
			$this->response->setOutput($this->load->view('default/template/checkout/neoseo_customer.tpl', $data));
		}
	}

	public function validate()
	{

		$data = $this->language->load('checkout/' . $this->_moduleSysName);

		$json = array();

		$this->debug("Данные для валидации по покупателю: " . print_r($this->request->post, true));
		// Это на тот случай если какой-то умник решил убрать фамилию или имя из полей для кастомера
		foreach (array('lastname', 'firstname') as $fieldName) {
			$this->session->data['guest'][$fieldName] = '';
			$this->session->data['guest']['payment'][$fieldName] = '';
			$this->session->data['guest']['shipping'][$fieldName] = '';
		}


		// Проверяем чтобы все обязательные поля были заполнены
		$type = (int) $this->request->post['type'];
		$this->session->data['guest']['type'] = $type;
		$fields = $this->config->get($this->_moduleSysName . '_customer_fields');
		$data['fields'] = $fields[$type];
		foreach ($data['fields'] as $field) {
			$fieldName = $field['name'];
			if ($field['display'] && $field['required'] && (!isset($this->request->post[$fieldName]) || utf8_strlen(trim($this->request->post[$fieldName])) < 1 )) {
				$json['error']['customer_fields'][$fieldName] = $this->language->get('error_required');
			} else if (isset($this->request->post[$fieldName])) {
				$this->session->data['guest'][$fieldName] = $this->request->post[$fieldName];
				$this->session->data['guest']['payment'][$fieldName] = $this->request->post[$fieldName];
				$this->session->data['guest']['shipping'][$fieldName] = $this->request->post[$fieldName];
			}
		}
		if (isset($this->request->post['comment'])) {
			$this->session->data['comment'] = strip_tags($this->request->post['comment']);
		}
		$this->session->data['account'] = 'guest';

		//Обработка файлов
		if (isset($this->request->files['files'])) {

			$this->debug("Файлы покупателя: " . print_r($this->request->files['files'], true));

			if (isset($this->session->data['guest']['files'])) {
				foreach ($this->session->data['guest']['files'] as $file) {
					unlink(DIR_CACHE . $file['name']);
				}
			}

			$files = array();
			foreach ($this->request->files['files'] as $key => $file_value) {
				foreach ($file_value as $index => $value) {
					$files[$index][$key] = $value;
				}
			}
			foreach ($files as $index => $file) {

				$filename = $this->translit(html_entity_decode($file['name'], ENT_QUOTES, 'UTF-8'));
				$new_name = $filename . '.' . token(32);
				move_uploaded_file($file['tmp_name'], DIR_CACHE . $new_name);

				$files[$index] = array(
					'name' => $new_name,
					'mask_name' => $filename,
					'type' => $file['type']
				);
			}
			$this->session->data['guest']['files'] = $files;
		} else {
			$this->session->data['guest']['files'] = array();
		}


		// Спец случай - мыло обязано быть указано в случае галочки с регистрацией
		// Спец случай - указано "зарегистрироваться" то нужно убедиться что такого покупателя еще нет в базе
		if (isset($this->request->post['register']) && $this->request->post['register']) {
			$this->load->model('account/customer');
			if (!isset($this->request->post['email']) || !$this->request->post['email']) {
				$json['error']['customer_fields']['email'] = $this->language->get('error_required');
			} elseif (!preg_match('/^[^\@]+@.*\.[a-z]{2,6}$/i', $this->request->post['email'])) {
				$json['error']['customer_fields']['email'] = $this->language->get('error_email');
			} elseif ($this->model_account_customer->getTotalCustomersByEmail($this->request->post['email'])) {
				$json['error']['customer_fields']['email'] = $this->language->get('error_exists');
			}
		} else {
			//Если email не обязательное при оформлении заказа, но все же введено
			if (isset($this->request->post['email']) && $this->request->post['email'] && !preg_match('/^[^\@]+@.*\.[a-z]{2,6}$/i', $this->request->post['email'])) {
				$json['error']['customer_fields']['email'] = $this->language->get('error_email');
			}
		}

		// Спец случай - пароль обязан быть указан в случае галочки с регистрацией
		if (isset($this->request->post['register']) && $this->request->post['register'] &&
		    (!isset($this->request->post['password']) || !$this->request->post['password'] )) {
			$json['error']['customer_fields']['password'] = $this->language->get('error_required');
		}

		// Спец случай - подтверждение пароля обязано быть указано в случае галочки с регистрацией
		if (isset($this->request->post['register']) && $this->request->post['register'] &&
		    (!isset($this->request->post['password2']) || !$this->request->post['password2'] )) {
			$json['error']['customer_fields']['password2'] = $this->language->get('error_required');
		}

		// Спец случай - если подтверждение пароля не совпадает с паролем в случае галочки с регистрацией
		if (isset($this->request->post['register']) && isset($this->request->post['password']) &&
		    isset($this->request->post['password2']) && $this->request->post['password'] != $this->request->post['password2']) {
			$json['error']['customer_fields']['password2'] = $this->language->get('error_confirm');
		}

		$this->event->trigger('post.customer.validate', $json);
		$this->outputJson($json);
	}

	private function translit($string)
	{
		$converter = array(
			'а' => 'a', 'б' => 'b', 'в' => 'v',
			'г' => 'g', 'д' => 'd', 'е' => 'e',
			'ё' => 'e', 'ж' => 'zh', 'з' => 'z',
			'и' => 'i', 'й' => 'y', 'к' => 'k',
			'л' => 'l', 'м' => 'm', 'н' => 'n',
			'о' => 'o', 'п' => 'p', 'р' => 'r',
			'с' => 's', 'т' => 't', 'у' => 'u',
			'ф' => 'f', 'х' => 'h', 'ц' => 'c',
			'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sch',
			'ь' => '\'', 'ы' => 'y', 'ъ' => '\'',
			'э' => 'e', 'ю' => 'yu', 'я' => 'ya',
			'А' => 'A', 'Б' => 'B', 'В' => 'V',
			'Г' => 'G', 'Д' => 'D', 'Е' => 'E',
			'Ё' => 'E', 'Ж' => 'Zh', 'З' => 'Z',
			'И' => 'I', 'Й' => 'Y', 'К' => 'K',
			'Л' => 'L', 'М' => 'M', 'Н' => 'N',
			'О' => 'O', 'П' => 'P', 'Р' => 'R',
			'С' => 'S', 'Т' => 'T', 'У' => 'U',
			'Ф' => 'F', 'Х' => 'H', 'Ц' => 'C',
			'Ч' => 'Ch', 'Ш' => 'Sh', 'Щ' => 'Sch',
			'Ь' => '\'', 'Ы' => 'Y', 'Ъ' => '\'',
			'Э' => 'E', 'Ю' => 'Yu', 'Я' => 'Ya',
		);
		return strtr($string, $converter);
	}

}

?>