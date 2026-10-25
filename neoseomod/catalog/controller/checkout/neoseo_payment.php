<?php

require_once( DIR_SYSTEM . "/engine/neoseo_controller.php");

class ControllerCheckoutNeoSeoPayment extends NeoSeoController
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

		$this->load->model('account/address');
		$this->load->model('localisation/country');
		$this->load->model('localisation/zone');

		if (isset($this->session->data['guest']['payment']))
			$payment_address = $this->session->data['guest']['payment'];
		else
			$payment_address = array();

		$dependency_type = $this->config->get($this->_moduleSysName . "_dependency_type");
		if (!empty($payment_address) || $dependency_type == "shipping_for_payment") {
			// Totals
			$total_data = array();
			$total = 0;
			$taxes = $this->cart->getTaxes();

			$this->load->model('extension/extension');

			$sort_order = array();

			$results = $this->model_extension_extension->getExtensions('total');

			foreach ($results as $key => $value) {
				$sort_order[$key] = $this->config->get($value['code'] . '_sort_order');
			}

			array_multisort($sort_order, SORT_ASC, $results);

			foreach ($results as $result) {
				if ($this->config->get($result['code'] . '_status')) {
					$this->load->model('total/' . $result['code']);

					$this->{'model_total_' . $result['code']}->getTotal($total_data, $total, $taxes);
				}
			}

			$this->debug("Опрашиваем методы оплаты с суммой $total и следующим адресом: " . print_r($payment_address, true));

			// Payment Methods
			$method_data = array();

			$this->load->model('extension/extension');
			//$this->log("оплата1: " . $this->_moduleSysName);

			$results = $this->model_extension_extension->getExtensions('payment');
			$dependency_type = $this->config->get($this->_moduleSysName . "_dependency_type");
			$payment_for_shipping = $this->config->get($this->_moduleSysName . "_payment_for_shipping");
			//$this->log("Список методов оплаты " . print_r($payment_for_shipping, true));

			//$this->log("сессия: " . print_r($this->session->data, true));
			$activeShippingMethod = isset($this->session->data['shipping_method']) ? $this->session->data['shipping_method']['code'] : -1;
			$activeShippingFirstMethod = explode('.', $activeShippingMethod);
			$activeShippingFirstMethod = $activeShippingFirstMethod[0];

			foreach ($results as $result) {
				if ($this->config->get($result['code'] . '_status')) {
					try {
						$begin = microtime(true);

						$this->load->model('payment/' . $result['code']);

						$method = $this->{'model_payment_' . $result['code']}->getMethod($payment_address, $total);

						if ($method) {
							if (!isset($method['quote'])) {
								if ($dependency_type != "payment_for_shipping" || isset($payment_for_shipping[$activeShippingMethod][$result['code']])) {
									$method_data[$result['code']] = $method;
								} else if ($dependency_type != "payment_for_shipping" || isset($payment_for_shipping[$activeShippingFirstMethod][$result['code']])) {
									$method_data[$result['code']] = $method;
								} else {
									$this->debug("Метод оплаты '" . $result['code'] . "'  отключен для метода доставки " . $activeShippingMethod . " и " . $activeShippingFirstMethod);
								}
							} else {
								foreach ($method['quote'] as &$method) {
									if ($dependency_type != "payment_for_shipping" || isset($payment_for_shipping[$activeShippingMethod][$method['code']])) {
										$method_data[$method['code']] = $method;
									} else if ($dependency_type != "payment_for_shipping" || isset($payment_for_shipping[$activeShippingFirstMethod][$result['code']])) {
										
									} else {
										$this->debug("Метод оплаты '" . $method['code'] . "'  отключен для метода доставки " . $activeShippingMethod . " и " . $activeShippingFirstMethod);
									}
								}
							}
							$this->debug("Метод оплат " . 'model_payment_' . $result['code'] . " вернул " . print_r($method, true));
						} else {
							$this->debug("Метод оплаты " . 'model_payment_' . $result['code'] . " не вернул ничего");
						}

						$total_secs = round(microtime(true) - $begin, 4) * 1000;
						$this->debug("Опрос метода оплаты " . 'model_payment_' . $result['code'] . " отнял $total_secs ms");
					} catch (Exception $e) {
						$this->log("Не удалось получить данные по модулю оплаты " . $result['code'] . " из-за ошибки: " . $e->getMessage());
					}
				}
			}

			$sort_order = array();
			//$this->debug("Методы доставки до сортировки: " . print_r($method_data,true) );

			foreach ($method_data as $key => $value) {
				$sort_order[$key] = $value['sort_order'];
			}

			array_multisort($sort_order, SORT_ASC, $method_data);

			$this->session->data['payment_methods'] = $method_data;
			//$this->debug("Методы доставки: " . print_r($this->session->data['payment_methods'],true) );
			//$this->log( "payment methods: " . print_r($method_data,true));
		}

		$data['text_payment_method'] = $this->language->get('text_payment_method');
		$data['text_comments'] = $this->language->get('text_comments');

		if (empty($this->session->data['payment_methods'])) {
			if (isset($this->session->data['guest']['payment']['city']) && $this->session->data['guest']['payment']['city']) {
				$data['error_warning'] = sprintf($this->language->get('error_no_payment'), $this->url->link('information/contact'));
			} else {
				$data['error_warning'] = $this->language->get('error_shipping');
			}
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->session->data['payment_methods'])) {
			$data['payment_methods'] = $this->session->data['payment_methods'];
		} else {
			$data['payment_methods'] = array();
		}

		if (isset($this->session->data['payment_method']['code'])) {
			$data['code'] = $this->session->data['payment_method']['code'];
		} else {
			$data['code'] = '';
		}

		// All variables
		$data = $this->initConfigParams(array(
			$this->_moduleSysName . '_debug',
			$this->_moduleSysName . '_payment_logo',
			$this->_moduleSysName . '_payment_control',
			$this->_moduleSysName . '_compact',
		    ), $data);

		$this->debug("оплата2: " . $this->_moduleSysName);
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/checkout/neoseo_payment.tpl')) {
			$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/checkout/neoseo_payment.tpl', $data));
		} else {
			$this->response->setOutput($this->load->view('default/template/checkout/neoseo_payment.tpl', $data));
		}
	}

	public function set()
	{
		$this->load->model('account/address');
		$this->load->model('localisation/country');
		$this->load->model('localisation/zone');

		$this->session->data['guest']['payment']['postcode'] = isset($this->request->post['postcode']) ? $this->request->post['postcode'] : '';

		$json = array();
		if (isset($this->request->post['payment_method'])) {
			$this->debug("Установить метод оплаты: {$this->request->post['payment_method']}");
		} else {
			$this->debug("Метод оплаты не установлен");
		}
		$this->debug("Текущие методы оплаты: " . print_r($this->session->data['payment_methods'], true));
		if (isset($this->request->post['payment_method']) && isset($this->session->data['payment_methods'])) {
			$this->session->data['payment_method'] = $this->session->data['payment_methods'][$this->request->post['payment_method']];

			if (!isset($this->session->data['payment_method']['description'])) {
				$this->session->data['payment_method']['description'] = "";
			}
			if ($this->session->data['payment_method']['description']) {
				$json['payment'] = str_replace("<label>", "", str_replace("</label>", "", $this->session->data['payment_method']['description']));
			}
		}

		if (isset($this->session->data['payment_method'])) {
			$paymentMethod = $this->session->data['payment_method']['code'];
			$paymentMethods = explode('.', $paymentMethod);
			$paymentFirstMethod = $paymentMethods[0];

			$fields = $this->config->get($this->_moduleSysName . '_payment_fields');

			if (isset($fields[$paymentMethod])) {
				$sourceFields = $fields[$paymentMethod];
				$this->debug("Рендерим дополнительные поля для оплаты $paymentMethod: " . print_r($sourceFields, true));
			} else if (isset($fields[$paymentFirstMethod])) {
				$sourceFields = $fields[$paymentFirstMethod];
				$this->debug("Рендерим дополнительные поля для оплаты $paymentFirstMethod: " . print_r($sourceFields, true));
			} else {
				$sourceFields = array();
				$this->debug("Дополнительные поля оплаты не найдены ни для $paymentMethod ни для $paymentFirstMethod");
			}

			if (count($sourceFields) > 0) {
				$fields = array();
				foreach ($sourceFields as $field) {
					$fieldName = $field['name'];
					if (isset($this->session->data['guest']['payment'][$fieldName])) {
						$fieldValue = $this->session->data['guest']['payment'][$fieldName];
						$this->debug("Инициализируем поле $fieldName значением сессии $fieldValue", true);
						$field['value'] = $fieldValue;
					}
					$fields[] = $field;
				}
				$data['fields'] = $fields;
				$data['language_id'] = $this->config->get("config_language_id");
				if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/checkout/neoseo_fields.tpl')) {
					$json['fields'] = $this->load->view($this->config->get('config_template') . '/template/checkout/neoseo_fields.tpl', $data);
				} else {
					$json['fields'] = $this->load->view('default/template/checkout/neoseo_fields.tpl', $data);
				}
			}
		}

		$this->outputJson($json);
	}

	public function validate()
	{
		$data = $this->language->load('checkout/' . $this->_moduleSysName);
		$this->load->model('account/address');
		$this->load->model('localisation/country');
		$this->load->model('localisation/zone');

		if ($this->customer->isLogged() && isset($this->session->data['payment_address_id'])) {
			$payment_address = $this->model_account_address->getAddress($this->session->data['payment_address_id']);
		} elseif (isset($this->session->data['guest']['payment'])) {
			$payment_address = $this->session->data['guest']['payment'];
		} else {
			$payment_address = array();
		}


		if (!empty($payment_address)) {
			// Totals
			$total_data = array();
			$total = 0;
			$taxes = $this->cart->getTaxes();

			$this->load->model('extension/extension');

			$sort_order = array();

			$results = $this->model_extension_extension->getExtensions('total');

			foreach ($results as $key => $value) {
				$sort_order[$key] = $this->config->get($value['code'] . '_sort_order');
			}

			array_multisort($sort_order, SORT_ASC, $results);

			foreach ($results as $result) {
				if ($this->config->get($result['code'] . '_status')) {
					$this->load->model('total/' . $result['code']);

					$this->{'model_total_' . $result['code']}->getTotal($total_data, $total, $taxes);
				}
			}

			// Payment Methods
			$method_data = array();

			$this->load->model('extension/extension');

			$results = $this->model_extension_extension->getExtensions('payment');

			foreach ($results as $result) {
				if ($this->config->get($result['code'] . '_status')) {
					$this->load->model('payment/' . $result['code']);

					$method = $this->{'model_payment_' . $result['code']}->getMethod($payment_address, $total);

					if ($method) {
						if (!isset($method['quote'])) {
							$method_data[$result['code']] = $method;
						} else {
							foreach ($method['quote'] as &$method) {
								$method_data[$method['code']] = $method;
							}
						}
					}
				}
			}

			$sort_order = array();

			foreach ($method_data as $key => $value) {
				$sort_order[$key] = $value['sort_order'];
			}

			array_multisort($sort_order, SORT_ASC, $method_data);

			$this->session->data['payment_methods'] = $method_data;
		}

		$json = array();

		$payment_address = $this->session->data['guest']['payment'];

		// Payment address not set
		if (empty($payment_address)) {
			$json['redirect'] = $this->url->link($this->_moduleSysName . '/checkout', '', 'SSL');
		}


		if (!$json) {
			if (!isset($this->request->post['payment_method'])) {
				$json['error']['warning'] = $this->language->get('error_payment');
			} else {
				if (!isset($this->session->data['payment_methods'][$this->request->post['payment_method']])) {
					$json['error']['warning'] = $this->language->get('error_payment');
				}
			}

			if (!$json) {
				$this->session->data['payment_method'] = $this->session->data['payment_methods'][$this->request->post['payment_method']];

				if (isset($this->request->post['comment'])) {
					$this->session->data['comment'] = strip_tags($this->request->post['comment']);
				}
			}
		}

		if (!$json) {
			// Проверяем чтобы все обязательные поля были заполнены
			$fields = $this->config->get($this->_moduleSysName . '_payment_fields');
			$payment_method = $this->session->data['payment_method']['code'];
			$this->debug("Оплата: валидируем значения дополнительных полей для метода оплаты $payment_method");
			if (isset($fields[$payment_method])) {
				$data['fields'] = $fields[$payment_method];
				foreach ($data['fields'] as $field) {
					if ($field['display'] && $field['required']) {
						$fieldName = $field['name'];
						$value = trim($this->request->post[$fieldName]);
						if (utf8_strlen($value) < 1) {
							$this->debug("Оплата: Не указано значение для обязательного поля '$fieldName'");
							$json['error']['payment_fields'][$fieldName] = $this->language->get('error_required');
						}
					}
				}
			} else {
				if (!isset($fields))
					$this->debug("Оплата: дополнительные поля не найдены");
				else
					$this->debug("Оплата: дополнительные поля для $payment_method не найдены, есть только для " . implode(",", array_keys($fields)));
			}
		}

		if (!$json) {
			// Устанавливаем занчения полей
			$fields = $this->config->get($this->_moduleSysName . '_payment_fields');
			$payment_method = $this->session->data['payment_method']['code'];
			$this->debug("Оплата: устанавливаем значения дополнительных полей для метода оплаты $payment_method");
			if (isset($fields[$payment_method])) {
				$data['fields'] = $fields[$payment_method];
				foreach ($data['fields'] as $field) {
					$fieldName = $field['name'];
					if (!isset($this->request->post[$fieldName])) {
						$this->debug("Оплата: Поле '$fieldName' не указано в запросе");
						continue;
					}
					$fieldValue = $this->request->post[$fieldName];
					$this->debug("Оплата: Устанавливаем значение '$fieldName'='$fieldValue''");
					$this->session->data['guest'][$fieldName] = $fieldValue;
					$this->session->data['guest']['payment'][$fieldName] = $fieldValue;
					$this->session->data['guest']['shipping'][$fieldName] = $fieldValue;
				}
			} else {
				if (!isset($fields))
					$this->debug("Оплата: дополнительные поля не найдены");
				else
					$this->debug("Оплата: дополнительные поля для $payment_method не найдены, есть только для " . implode(",", array_keys($fields)));
			}
		}

		$this->outputJson($json);
	}

}

?>