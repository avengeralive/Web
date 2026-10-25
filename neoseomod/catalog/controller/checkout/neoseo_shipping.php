<?php

require_once( DIR_SYSTEM . "/engine/neoseo_controller.php");

class ControllerCheckoutNeoSeoShipping extends NeoSeoController
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

		if (isset($this->session->data['guest']['shipping']['country_id'])) {
			$shipping_address = $this->session->data['guest']['shipping'];
			$data['country_id'] = $this->session->data['guest']['shipping']['country_id'];
			$data['zone_id'] = $this->session->data['guest']['shipping']['zone_id'];
			$data['city'] = $this->session->data['guest']['shipping']['city'];
		} else {
			if (isset($this->customer) && $this->customer->isLogged()) {
				$addresses = $this->model_account_address->getAddresses();
				if (sizeof($addresses) > 0) {
					$address = array_pop($addresses);
					$shipping_address['zone_id'] = $address['zone_id'];
					$shipping_address['city'] = $address['city'];
					$shipping_address['country_id'] = $address['country_id'];
					$shipping_address['postcode'] = $address['postcode'];
					$shipping_address['address_1'] = $address['address_1'];
					$shipping_address['address_2'] = $address['address_2'];
					$data['city'] = $address['city'];
				}
			} else {
				$shipping_address = array();
				$data['city'] = '';
			}
		}

		$this->log("Опрашиваем методы доставки со следующим адресом " . print_r($shipping_address, true));

		if (!empty($shipping_address)) {
			// Shipping Methods
			$quote_data = array();

			$this->load->model('extension/extension');

			$results = $this->model_extension_extension->getExtensions('shipping');
			$dependency_type = $this->config->get($this->_moduleSysName . "_dependency_type");
			$shipping_for_payment = $this->config->get($this->_moduleSysName . "_shipping_for_payment");
			$shipping_type = $this->config->get($this->_moduleSysName . "_shipping_type");
			$active_payment = isset($this->session->data['payment_method']) ? $this->session->data['payment_method']['code'] : -1;
			$this->log("active_payment:" . $active_payment);

			//if( strpos($active_payment,".") !== false ) {
			//    $active_payments = explode(".", $active_payment);
			//    $active_payment = $active_payments[0];
			//}

			$checked = array();

			foreach ($results as $result) {
				if (isset($checked[$result['code']])) {
					// доставка плюс по какой-то причине плодит дубликаты с одним и тем же кодом
					continue;
				}
				$checked[$result['code']] = 1;

				if ($this->config->get($result['code'] . '_status')) {

					$this->log("Опрашиваем метод доставки " . $result['code']);
					try {
						$begin = microtime(true);
						$this->load->model('shipping/' . $result['code']);
						$quote = $this->{'model_shipping_' . $result['code']}->getQuote($shipping_address);
						if ($quote) {
							$new_quote = array();
							foreach ($quote['quote'] as &$data) {
								$type = "pickpoint";
								$method_code = $data['code'];
								//if( strpos($method_code,".") !== false ) {
								//    $method_codes = explode(".",$method_code);
								//    $method_code = $method_codes[0];
								//}

								if (isset($shipping_type[$method_code]))
									$type = $shipping_type[$method_code];

								$data['type'] = $type;

								if ($dependency_type != "shipping_for_payment" || isset($shipping_for_payment[$active_payment][$method_code])) {
									$new_quote[] = $data;
									$this->debug("Нам подходит метод доставки $method_code");
								} else {
									$this->debug("Метод доставки $method_code отключен для метода оплаты " . $active_payment);
								}
							}
							if (count($new_quote) > 0) {
								$quote_data[$result['code']] = array(
									'title' => $quote['title'],
									'quote' => $new_quote,
									'sort_order' => $quote['sort_order'],
									'error' => $quote['error'],
								);
							} else {
								$this->debug("Метод доставки " . $result['code'] . " отключен для метода оплаты " . $active_payment);
							}
						} else {
							$this->debug("Метод доставки " . 'model_shipping_' . $result['code'] . " не вернул ничего");
						}
						$total_sec = round(microtime(true) - $begin, 4) * 1000;
						$this->debug("Опрос метода доставки " . 'model_shipping_' . $result['code'] . " отнял $total_sec ms");
					} catch (Exception $e) {
						$this->log("Не удалось получить данные по модулю доставки " . $result['code'] . " из-за ошибки: " . $e->getMessage());
					}
				}
			}

			$sort_order = array();

			foreach ($quote_data as $key => $value) {
				$sort_order[$key] = $value['sort_order'];
			}

			array_multisort($sort_order, SORT_ASC, $quote_data);

			$this->session->data['shipping_methods'] = $quote_data;
		}

		if (empty($this->session->data['shipping_methods']) && isset($this->session->data['guest']['shipping']['city'])) {
			$data['error_warning'] = sprintf($this->language->get('error_no_shipping'), $this->url->link('information/contact'));
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->session->data['shipping_methods'])) {
			$data['shipping_methods'] = $this->session->data['shipping_methods'];
		} else {
			$data['shipping_methods'] = array();
		}

		if (isset($this->session->data['shipping_method']['code'])) {
			$data['code'] = $this->session->data['shipping_method']['code'];
		} else {
			$data['code'] = '';
		}

		$data = $this->initConfigParams(array(
			$this->_moduleSysName . '_debug',
			$this->_moduleSysName . '_shipping_control',
			$this->_moduleSysName . '_use_shipping_type',
			$this->_moduleSysName . '_shipping_title',
			$this->_moduleSysName . '_compact',
		    ), $data);

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/checkout/neoseo_shipping.tpl')) {
			$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/checkout/neoseo_shipping.tpl', $data));
		} else {
			$this->response->setOutput($this->load->view('default/template/checkout/neoseo_shipping.tpl', $data));
		}
	}

	public function set()
	{
		$this->load->model('account/address');
		$this->load->model('localisation/country');
		$this->load->model('localisation/zone');

		$json = array();

		//$this->debug("session shipping_methods: " . print_r($this->session->data['shipping_methods'],true));
		if (isset($this->request->post['shipping_method']) && isset($this->session->data['shipping_methods'])) {
			$shipping = explode('.', $this->request->post['shipping_method']);

			$this->session->data['shipping_method'] = null;
			foreach ($this->session->data['shipping_methods'][$shipping[0]]['quote'] as $id => $shipping_method) {
				if ($shipping_method['code'] == $this->request->post['shipping_method']) {
					$this->session->data['shipping_method'] = $shipping_method;
					break;
				}
			}

			if (!isset($this->session->data['shipping_method']['description'])) {
				$this->session->data['shipping_method']['description'] = "";
			}
			if ($this->session->data['shipping_method']['description']) {
				$json['shipping'] = str_replace("<label>", "", str_replace("</label>", "", $this->session->data['shipping_method']['description']));
			}
		}


		if (isset($this->request->post['shipping_method']) && isset($this->session->data['shipping_methods'])) {
			$shipping = explode('.', $this->request->post['shipping_method']);
			$shipping_code = 'shipping/' . $shipping[0];
			//$action = new Action($shipping_code);
			//if (file_exists($action->getFile())) {
			//    $json['shipping'] = $this->getChild($shipping_code);
			//}
		}

		// Main hack for eDost and other



		if (isset($this->request->post['shipping_method']) && isset($this->session->data['shipping_methods'])) {
			$shippingMethod = $this->request->post['shipping_method'];
			$shippingFirstMethod = explode('.', $shippingMethod);
			$shippingFirstMethod = $shippingFirstMethod[0];
			$fields = $this->config->get($this->_moduleSysName . '_shipping_fields');

			if (isset($fields[$shippingMethod])) {
				$sourceFields = $fields[$shippingMethod];
				$this->debug("Рендерим дополнительные поля для доставки $shippingMethod: " . print_r($sourceFields, true));
			} else if (isset($fields[$shippingFirstMethod])) {
				$sourceFields = $fields[$shippingFirstMethod];
				$this->debug("Рендерим дополнительные поля для доставки $shippingFirstMethod: " . print_r($sourceFields, true));
			} else {
				$sourceFields = array();
				$this->debug("Дополнительные поля доставки не найдены ни для $shippingMethod ни для $shippingFirstMethod");
			}
			$address = array();
			if ($this->customer->isLogged()) {
				$this->load->model('account/address');
				$addresses = $this->model_account_address->getAddresses();
				if (sizeof($addresses) > 0) {
					$address = array_pop($addresses);
				}
			}
			if (count($sourceFields) > 0) {
				$fields = array();
				foreach ($sourceFields as $field) {
					$fieldName = $field['name'];
					if (isset($this->session->data['guest']['shipping'][$fieldName])) {
						$fieldValue = $this->session->data['guest']['shipping'][$fieldName];
						$this->debug("Инициализируем поле $fieldName значением сессии $fieldValue", true);
						$field['value'] = $fieldValue;
					}
					if (isset($field['value']) && strlen($field['value']) == 0 && isset($address[$fieldName])) {
						$field['value'] = $address[$fieldName];
					}
					if ($field['type'] == 'select') {
						// Надо выбрать из базы все записи, что соответствуют текущему региону, городу и методу доставки
						$this->load->model('localisation/neoseo_address');

						$addresses = $this->model_localisation_neoseo_address->getAddresses(
						    $this->session->data['guest']['shipping']['zone_id'], $this->session->data['guest']['shipping']['city'], $this->session->data['shipping_method']['code']
						);

						if (!$addresses) {
							// Возможно это другой язык, в таком случае пусть человек хотя бы текстом сам введет
							$field['type'] = 'input';
							$field['value'] = '';
						} else {
							$field['values'] = array("" => $this->language->get('text_select'));
							foreach ($addresses as $address) {
								$field['values'][$address['name']] = $address['name'];
							}
						}
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
		$this->language->load('checkout/' . $this->_moduleSysName);
		$this->load->model('account/address');

		$this->debug("Доставка: проверяем входные данные");

		/* if( !$this->cart->hasShipping() ) {
		  $this->debug("Доставка: доставка не требуется");
		  $this->session->data['guest']['payment']['city'] = '';
		  $this->session->data['guest']['shipping']['city'] = '';

		  $this->session->data['guest']['payment']['zone_id'] = 0;
		  $this->session->data['guest']['payment']['zone'] = "";
		  $this->session->data['guest']['payment']['zone_code'] = "";

		  $this->session->data['guest']['shipping']['zone_id'] = 0;
		  $this->session->data['guest']['shipping']['zone'] = "";
		  $this->session->data['guest']['shipping']['zone_code'] = "";

		  $this->session->data['guest']['payment']['country_id'] = 0;
		  $this->session->data['guest']['payment']['country'] = '';
		  $this->session->data['guest']['payment']['iso_code_2'] = '';
		  $this->session->data['guest']['payment']['iso_code_3'] = '';
		  $this->session->data['guest']['payment']['address_format'] = '';

		  $this->session->data['guest']['shipping']['country_id'] = 0;
		  $this->session->data['guest']['shipping']['country'] = '';
		  $this->session->data['guest']['shipping']['iso_code_2'] = '';
		  $this->session->data['guest']['shipping']['iso_code_3'] = '';
		  $this->session->data['guest']['shipping']['address_format'] = '';

		  $this->outputJson(array());
		  return;
		  } */

		if (isset($this->session->data['guest']['shipping'])) {
			$shipping_address = $this->session->data['guest']['shipping'];
		} else {
			$shipping_address = array();
		}

		if (!isset($this->session->data['shipping_methods'])) {
			// Shipping Methods
			$quote_data = array();

			$this->load->model('extension/extension');

			$results = $this->model_extension_extension->getExtensions('shipping');

			foreach ($results as $result) {
				if ($this->config->get($result['code'] . '_status')) {
					$this->load->model('shipping/' . $result['code']);

					try {
						$quote = $this->{'model_shipping_' . $result['code']}->getQuote($shipping_address);
						$this->debug("Доставка: Ответ модуля model_shipping_" . $result['code'] . " на адрес " . print_r($shipping_address, true) . " - " . print_r($quote, true));
					} catch (Exception $e) {
						$quote = false;
						$this->debug("Доставка: Не удалось получить данные по методу " . $result['code'] . " из-за ошибки: " . $e->getMessage());
					}

					if ($quote) {
						$quote_data[$result['code']] = array(
							'title' => $quote['title'],
							'quote' => $quote['quote'],
							'sort_order' => $quote['sort_order'],
							'error' => $quote['error']
						);
					}
				}
			}

			$sort_order = array();

			foreach ($quote_data as $key => $value) {
				$sort_order[$key] = $value['sort_order'];
			}

			array_multisort($sort_order, SORT_ASC, $quote_data);

			$this->session->data['shipping_methods'] = $quote_data;
		}

		$json = array();

		// Shipping address not set
		if (empty($shipping_address)) {
			$this->debug("Доставка: адрес доставки не обнаружен!");
			$json['redirect'] = $this->url->link($this->_moduleSysName . '/checkout', '', 'SSL');
		}


		if (!$json) {
			$this->debug("Доставка: проверяем метод доставки");
			if (!isset($this->request->post['shipping_method'])) {
				$this->debug("Доставка: метод доставки не обнаружен!");
				$json['error']['warning'] = $this->language->get('error_shipping');
			} else {
				$shipping = explode('.', $this->request->post['shipping_method']);
				if (!isset($shipping[1]) && !isset($this->session->data['shipping_methods'][$this->request->post['shipping_method']])) {
					$this->debug("Доставка: " . $this->language->get('error_shipping'));
					$json['error']['warning'] = $this->language->get('error_shipping');
				} else {
					$found = false;
					$methodQuote = 0;
					foreach ($this->session->data['shipping_methods'][$shipping[0]]['quote'] as $id => $shipping_method) {
						if ($shipping_method['code'] == $this->request->post['shipping_method']) {
							$this->session->data['shipping_method'] = $shipping_method;
							$found = true;
							$methodQuote = $id;
							break;
						}
					}
					if (!$found) {
						$this->debug("Доставка1: " . $this->language->get('error_shipping'));
						$json['error']['warning'] = $this->language->get('error_shipping');
					}
				}
			}

			if (!$json) {
				$shipping = explode('.', $this->request->post['shipping_method']);

				$this->session->data['shipping_method'] = $this->session->data['shipping_methods'][$shipping[0]]['quote'][$methodQuote];

				// Add additional validation here
			}
		}

		if (!$json) {
			// Проверяем чтобы все обязательные поля были заполнены

			$shipping = explode('.', $this->request->post['shipping_method']);
			$shipping_method = $shipping[0];
			$this->debug("Доставка: валидируем значения дополнительных полей для метода доставки $shipping_method");
			$fields = $this->config->get($this->_moduleSysName . '_shipping_fields');
			if ($fields && isset($fields[$shipping_method])) {
				$data['fields'] = $fields[$shipping_method];
				foreach ($data['fields'] as $field) {
					if ($field['display'] && $field['required']) {
						$fieldName = $field['name'];
						$value = trim($this->request->post[$fieldName]);
						if (utf8_strlen($value) < 1) {
							$this->debug("Доставка: Не указано значение для обязательного поля '$fieldName'");
							$json['error']['shipping_fields'][$fieldName] = $this->language->get('error_required');
						}
					}
				}
			} else {
				if (!isset($fields))
					$this->debug("Доставка: дополнительные поля не найдены");
				else
					$this->debug("Доставка: дополнительные поля для $shipping_method не найдены, есть только для " . implode(",", array_keys($fields)));
			}
		}

		// Спец случай - Регион обязательно должен быть указан
		if (!isset($this->session->data['guest']['shipping']['zone_id']) || !$this->session->data['guest']['shipping']['zone_id']) {
			$json['error']['shipping_fields']['zone_id'] = $this->language->get('error_required');
		}

		// Спец случай - Город обязательно должен быть указан
		if (!isset($this->session->data['guest']['shipping']['city']) || !$this->session->data['guest']['shipping']['city']) {
			$json['error']['shipping_fields']['city'] = $this->language->get('error_required');
		}

		if (!$json) {
			// Устанавливаем значения полей
			$fields = $this->config->get($this->_moduleSysName . '_shipping_fields');
			$shipping = explode('.', $this->request->post['shipping_method']);
			$shipping_method = $shipping[0];
			$this->debug("Доставка: устанавливаем значения дополнительных полей для метода доставки $shipping_method");
			if ($fields && isset($fields[$shipping_method])) {
				$data['fields'] = $fields[$shipping_method];
				foreach ($data['fields'] as $field) {
					$fieldName = $field['name'];
					if (!isset($this->request->post[$fieldName])) {
						$this->debug("Доставка: Поле '$fieldName' не указано в запросе");
						continue;
					}
					$fieldValue = $this->request->post[$fieldName];
					$this->debug("Доставка: Устанавливаем значение '$fieldName'='$fieldValue''");
					$this->session->data['guest'][$fieldName] = $fieldValue;
					$this->session->data['guest']['payment'][$fieldName] = $fieldValue;
					$this->session->data['guest']['shipping'][$fieldName] = $fieldValue;
				}
			} else {
				if (!isset($fields))
					$this->debug("Доставка: дополнительные поля не найдены");
				else
					$this->debug("Доставка: дополнительные поля для $shipping_method не найдены, есть только для " . implode(",", array_keys($fields)));
			}
		}

		$this->outputJson($json);
	}

}

?>
