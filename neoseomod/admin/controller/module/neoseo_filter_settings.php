<?php

require_once( DIR_SYSTEM . "/engine/neoseo_controller.php");

class ControllerModuleNeoSeoFilterSettings extends NeoSeoController
{

	private $error = array();

	public function __construct($registry)
	{
		parent::__construct($registry);
		$this->_moduleSysName = "neoseo_filter";
		$this->_logFile = $this->_moduleSysName . ".log";
		$this->debug = $this->config->get($this->_moduleSysName . "_debug");
	}

	public function index()
	{

		$this->checkLicense();
		$this->upgrade();

		$data = $this->language->load('module/' . $this->_moduleSysName . '_settings');

		$this->document->setTitle($this->language->get('heading_title_raw'));

		$this->load->model('setting/setting');


		if (($this->request->server['REQUEST_METHOD'] == 'POST') && ($this->validate())) {

			$this->model_setting_setting->editSetting($this->_moduleSysName, $this->request->post);


			$this->session->data['success'] = $this->language->get('text_success');


			if (isset($this->request->get['close'])) {
				$this->response->redirect($this->url->link('extension/' . $this->_route, 'token=' . $this->session->data['token'], 'SSL'));
			} else {
				$this->response->redirect($this->url->link($this->_route .'/'. $this->_moduleSysName . '_settings', 'token=' . $this->session->data['token'], 'SSL'));
			}
		}




		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else if (isset($this->session->data['error_warning'])) {
			$data['error_warning'] = $this->session->data['error_warning'];
			unset($this->session->data['error_warning']);
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];
			unset($this->session->data['success']);
		}
		$data = $this->initBreadcrumbs(array(
			array("extension/module", "text_module"),
			array("module/" . $this->_moduleSysName.'_settings', "heading_title_raw")
		), $data);

		$data = $this->initButtons($data);
		$data['save'] = $this->url->link('module/' . $this->_moduleSysName . '_settings',  'token=' . $this->session->data['token'], 'SSL');
		$data['clear_cache'] = $this->url->link('module/' . $this->_moduleSysName . '_settings' . '/clear_cache', 'token=' . $this->session->data['token'], 'SSL');
		$data['save_and_close'] = $this->url->link('module/' . $this->_moduleSysName . '_settings', 'token=' . $this->session->data['token'] . "&close=1", 'SSL');
		$data['clear'] = $this->url->link('module/' . $this->_moduleSysName . '_settings' . '/clear', 'token=' . $this->session->data['token'], 'SSL');
		$data['copy_attributes'] = $this->url->link('module/' . $this->_moduleSysName . '_settings' . '/copy_attributes', 'token=' . $this->session->data['token'], 'SSL');
		$data['copy_options'] = $this->url->link('module/' . $this->_moduleSysName . '_settings' . '/copy_options', 'token=' . $this->session->data['token'], 'SSL');
		$data['clear_filter_options'] = $this->url->link('module/' . $this->_moduleSysName . '_settings' . '/clear_filter_options', 'token=' . $this->session->data['token'], 'SSL');

        $data['copy_from_ocfilter'] = $this->url->link('module/' . $this->_moduleSysName . '_settings' . '/copy_from_ocfilter', 'token=' . $this->session->data['token'], 'SSL');

		$this->load->model('localisation/language');
		$languages = array();
		foreach ($this->model_localisation_language->getLanguages() as $language) {
			$languages[$language['language_id']] = $language['name'];
		}
		$data['languages'] = $languages;
		$data['full_languages'] = $this->model_localisation_language->getLanguages();

		$defaultManUrl = array();
		foreach ($data['languages'] as $language_id => $name) {
			$defaultManUrl[$language_id] = $this->language->get('text_default_manufacturer_url');
		}

		$defaultPriceUrl = array();
		foreach ($data['languages'] as $language_id => $name) {
			$defaultPriceUrl[$language_id] = $this->language->get('text_default_price_url');
		}

		$data = $this->initParams(array(
			array($this->_moduleSysName . '_debug', 0),
			array($this->_moduleSysName . '_show_attributes', 0),
			array($this->_moduleSysName . '_use_cache', 1),
			array($this->_moduleSysName . '_attributes_group', 0),
			array($this->_moduleSysName . '_use_discount', 0),
			array($this->_moduleSysName . '_use_special', 0),
			array($this->_moduleSysName . '_manufacturer_url', $defaultManUrl),
			array($this->_moduleSysName . '_price_url', $defaultPriceUrl),
		), $data, $this->_moduleSysName);

		$data['attribute_groups'] = array();
		$this->load->model('catalog/attribute_group');
		$attribute_groups = $this->model_catalog_attribute_group->getAttributeGroups();

		if ($attribute_groups) {
			foreach ($attribute_groups as $attribute_group) {
				$data['attribute_groups'][$attribute_group['attribute_group_id']] = $attribute_group['name'];
			}
		}

		if ($this->config->get($this->_moduleSysName . '_debug')) {
			$data[$this->_moduleSysName . '_debug'] = 1;
		}

		$data['params'] = $data;
		$data['token'] = $this->session->data['token'];
		$data['logs'] = $this->getLogs();

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('module/' . $this->_moduleSysName . '_settings.tpl', $data));
	}

	public function clear_cache()
	{
		$this->language->load('module/' . $this->_moduleSysName);
		$this->db->query("DELETE FROM " . DB_PREFIX . "filter_cache");
		$this->db->query("DELETE FROM " . DB_PREFIX . "filter_category_cache");
		$this->db->query("DELETE FROM " . DB_PREFIX . "filter_module_cache");
		$this->session->data['success'] = $this->language->get('text_success_cache_clear');

		$this->response->redirect($this->url->link($this->_route . '/' . $this->_moduleSysName . '_settings', 'token=' . $this->session->data['token'] . '#tab-logs', 'SSL'));
	}

    public function copy_from_ocfilter()
    {
        $this->load->model('catalog/' . $this->_moduleSysName);
        $this->{'model_catalog_' . $this->_moduleSysName}->copyFromOcFilter();

        $this->response->redirect($this->url->link($this->_route . '/' . $this->_moduleSysName . '_settings', 'token=' . $this->session->data['token'] . '#tab-logs', 'SSL'));
    }

    public function copy_attributes()
	{
		$this->load->model('catalog/' . $this->_moduleSysName);
		$this->{'model_catalog_' . $this->_moduleSysName}->copyAttributes();

		$this->response->redirect($this->url->link($this->_route . '/' . $this->_moduleSysName . '_settings', 'token=' . $this->session->data['token'] . '#tab-logs', 'SSL'));
	}

	public function copy_options()
	{
		$this->load->model('catalog/' . $this->_moduleSysName);
		$this->{'model_catalog_' . $this->_moduleSysName}->copyOptions();

		$this->response->redirect($this->url->link($this->_route . '/' . $this->_moduleSysName . '_settings', 'token=' . $this->session->data['token'] . '#tab-logs', 'SSL'));
	}

	public function clear_filter_options()
	{
		$this->load->model('catalog/' . $this->_moduleSysName);
		$this->{'model_catalog_' . $this->_moduleSysName}->clearFilterOptions();

		$this->response->redirect($this->url->link($this->_route . '/' . $this->_moduleSysName . '_settings', 'token=' . $this->session->data['token'] . '#tab-logs', 'SSL'));
	}

	private function validate()
	{
		if (!$this->user->hasPermission('modify', 'module/' . $this->_moduleSysName)) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if (!$this->error) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function clear()
	{
		$this->language->load($this->_route . '/' . $this->_moduleSysName);

		if (is_file(DIR_LOGS . $this->_logFile)) {
			$f = fopen(DIR_LOGS . $this->_logFile, "w");
			fclose($f);
		}

		$this->session->data['success'] = $this->language->get('text_success_clear');

		$this->response->redirect($this->url->link('module/' . $this->_moduleSysName . '_settings', 'token=' . $this->session->data['token'].'#tab-logs', 'SSL'));
	}
}

?>
