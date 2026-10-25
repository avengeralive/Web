<?php
require_once( DIR_SYSTEM . "/engine/neoseo_controller.php");

class ControllerModuleNeoSeoBrandsAbc extends NeoSeoController {
	public function __construct($registry) {
		parent::__construct($registry);
		$this->_moduleSysName = "neoseo_brands_abc";
		$this->_logFile = $this->_moduleSysName . ".log";
		$this->debug = $this->config->get($this->_moduleSysName . "_debug");
	}
    
    public function index() {
        if (!file_exists('catalog/view/theme/' . $this->config->get('config_template') . '/stylesheet/'. $this->_moduleSysName .'.scss')) {
            $this->document->addStyle('catalog/view/theme/default/stylesheet/' . $this->_moduleSysName . '.css');
        }
		$data = $this->load->language('module/' . $this->_moduleSysName);
		
		$this->load->model('catalog/manufacturer');
		
		$results = $this->model_catalog_manufacturer->getManufacturers();
		
		if (!$results) {
			return;
		}

		foreach ($results as $result) {
			$name = $result['name'];

			if (is_numeric(utf8_substr($name, 0, 1))) {
				$key = '0 - 9';
			} else {
				$key = utf8_substr(utf8_strtoupper($name), 0, 1);
			}

			if (!isset($data['letters'][$key])) {
				$data['letters'][$key]['href'] = $this->url->link('product/manufacturer#' . $key);
			}

			$data['letters'][$key]['manufacturers'][] = array(
				'name' => $name,
				'href' => $this->url->link('product/manufacturer/info', 'manufacturer_id=' . $result['manufacturer_id'])
			);
		}

        if (!isset($this->request->get['route']) || (isset($this->request->get['route']) && $this->request->get['route'] == 'common/home')) {
            $data['is_home'] = true;
        } else {
            $data['is_home'] = false;
        }
        $data['menu_type'] = $this->config->get("neoseo_unistor_menu_type");

		$data['params'] = $data;
		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/' . $this->_moduleSysName . '.tpl')) {
			return $this->load->view($this->config->get('config_template') . '/template/module/' . $this->_moduleSysName . '.tpl', $data);
		} else {
			return $this->load->view('default/template/module/' . $this->_moduleSysName . '.tpl', $data);
		}
	}
}