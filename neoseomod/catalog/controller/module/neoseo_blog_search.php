<?php
require_once(DIR_SYSTEM.'/engine/neoseo_controller.php');

class ControllerModuleNeoSeoBlogSearch extends NeoSeoController
{
	public function __construct($registry) {
		parent::__construct($registry);
		$this->_moduleSysName = 'neoseo_blog';
		$this->_logFile = $this->_moduleSysName . '.log';
		$this->debug = $this->config->get($this->_moduleSysName . '_status') == 1;
	}

	public function index($setting)
	{

		$data = $this->language->load('module/neoseo_blog_search');

		if (!empty($setting['title'][$this->config->get('config_language_id')])) {
			$data['title'] = $setting['title'][$this->config->get('config_language_id')];
		} else {
			$data['title'] = '';
		}

		if (isset($this->request->get['blog_category_id'])) {
			$data['category_id'] = $this->request->get['blog_category_id'];
		} else {
			$data['category_id'] = 0;
		}

		$data['root_category_id'] = $setting['root_category_id'];
		if ($setting['root_category_id']) {
			$parents = $this->model_blog_neoseo_blog_category->getParentIds($data['category_id']);
			if ($setting['root_category_id'] != $data['category_id'] && !in_array($setting['root_category_id'], $parents)) {
				return '';
			}
		}

		if (isset($this->request->get['blog_search'])) {
			$data['blog_search'] = $this->request->get['blog_search'];
		} else {
			$data['blog_search'] = '';
		}

		$template = $setting['template'];
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/' . $template)) {
			return $this->load->view($this->config->get('config_template') . '/template/module/' . $template, $data);
		} else {
			return $this->load->view('default/template/module/' . $template, $data);
		}
	}

}
