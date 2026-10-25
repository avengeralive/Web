<?php

require_once( DIR_SYSTEM . "/engine/neoseo_controller.php");

class ControllerModuleNeoSeoAccount extends NeoSeoController
{

	public function __construct($registry)
	{
		parent::__construct($registry);
		$this->_moduleName = "";
		$this->_moduleSysName = "neoseo_account";
		$this->_logFile = $this->_moduleSysName . ".log";
		$this->debug = $this->config->get($this->_moduleSysName . "_debug");
	}

	public function index()
	{
		$data = $this->load->language('module/neoseo_account');

		$data['logged'] = $this->customer->isLogged();
		$data['register'] = $this->url->link('account/neoseo_register', '', 'SSL');
		$data['login'] = $this->url->link('account/neoseo_login', '', 'SSL');
		$data['logout'] = $this->url->link('account/neoseo_logout', '', 'SSL');
		$data['forgotten'] = $this->url->link('account/neoseo_forgotten', '', 'SSL');
		$data['account'] = $this->url->link('account/neoseo_account', '', 'SSL');
		$data['edit'] = $this->url->link('account/neoseo_edit', '', 'SSL');
		$data['address'] = $this->url->link('account/neoseo_address', '', 'SSL');
		$data['compare'] = $this->url->link('product/compare');
		$data['wishlist'] = $this->url->link('account/neoseo_wishlist');
		$data['order'] = $this->url->link('account/neoseo_order', '', 'SSL');

		if ($this->config->get('reward_status')) {
			$data['reward'] = $this->url->link('account/neoseo_reward', '', 'SSL');
		} else {
			$data['reward'] = '';
		}

		if (file_exists(DIR_APPLICATION . "controller/account/neoseo_watched.php")) {
			$data['watched'] = $this->url->link('account/neoseo_watched', '', 'SSL');
		} else {
			$data['watched'] = '';
		}

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/neoseo_account.tpl')) {
			return $this->load->view($this->config->get('config_template') . '/template/module/neoseo_account.tpl', $data);
		} else {
			return $this->load->view('default/template/module/neoseo_account.tpl', $data);
		}
	}

}
