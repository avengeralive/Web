<?php

require_once( DIR_SYSTEM . "/engine/neoseo_controller.php");

class ControllerAccountNeoSeoSocialAuth extends NeoSeoController
{

	public function __construct($registry)
	{
		parent::__construct($registry);
		$this->_moduleName = "";
		$this->_moduleSysName = "neoseo_account";
		$this->_logFile = $this->_moduleSysName . ".log";
		$this->debug = $this->config->get($this->_moduleSysName . "_debug") == 1;
	}

	public function index()
	{

		$s = file_get_contents('https://ulogin.ru/token.php?token=' . $_POST['token'] . '&host=' . $_SERVER['HTTP_HOST']);
		$result = json_decode($s, true);

		$domain = $this->config->get('config_use_ssl') ? HTTPS_SERVER : HTTP_SERVER;

		if (!isset($result['identity'])) {
			$this->log('Ошибка! Не удалось определить пользователя соц. сети.');
			$this->response->redirect($domain);
		}

		$this->load->model('account/neoseo_social_auth');

		$firstname = isset($result['first_name']) ? $result['first_name'] : '';
		$lastname = isset($result['last_name']) ? $result['last_name'] : '';
		$email = isset($result['email']) ? $result['email'] : '';
		$phone = isset($result['phone']) ? $result['phone'] : '';
		$country = isset($result['country']) ? $result['country'] : '';
		$city = isset($result['city']) ? $result['city'] : '';

		$check_id = $this->model_account_neoseo_social_auth->checkIdentity($result['identity']);

		if (!$check_id) {
			$this->load->model('account/customer');
			if ($this->model_account_customer->getTotalCustomersByEmail($email)) {
				$this->language->load('account/register');
				$this->session->data['error_social_auth'] = $this->language->get('error_exists');
				$this->response->redirect($this->url->link('account/login', '', 'SSL'));
			}

			$country = $this->model_account_neoseo_social_auth->getCountryId(trim($country));
			$country_id = $country ? $country['country_id'] : 0;

			$phone = str_replace("(", "", $phone);
			$phone = str_replace(")", "", $phone);
			$phone = str_replace("-", "", $phone);
			$data = array(
				'identity' => $result['identity'],
				'network' => $result['network'],
				'profile' => $result['profile'],
				'firstname' => $firstname,
				'lastname' => $lastname,
				'email' => $email,
				'telephone' => $phone,
				'fzx' => '',
				'customer_group_id' => $this->config->get('config_customer_group_id'),
				'password' => $this->model_account_neoseo_social_auth->generatePassword(10),
				'address_1' => $country . ", " . $city,
				'address_2' => '',
				'city' => $city,
				'zone_id' => 0,
				'postcode' => '',
				'country_id' => $country_id,
				'company' => '',
			);

			$customer_id = $this->model_account_neoseo_social_auth->addCustomer($data);

			$this->log('Добавлен новый покупатель ' . $firstname . ' ' . $lastname . ' c id #' . $customer_id);

			$this->model_account_neoseo_social_auth->login($customer_id);
		} else {
			$this->model_account_neoseo_social_auth->login($check_id);
		}

		$this->response->redirect($this->url->link('account/account', '', 'SSL'));
	}

}

?>
