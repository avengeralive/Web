<?php

require_once( DIR_SYSTEM . "/engine/neoseo_controller.php");

class ControllerCatalogNeoSeoFilterPages extends NeoSeoController
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

		$this->load->model('catalog/' . $this->_moduleSysName . "_pages");
		$this->load->model('catalog/category');

		$this->getList();
	}

	public function processFilterOption($data)
	{
		$this->load->model('catalog/neoseo_filter');
		// Нужно выделить все $option_ и записать их в одно значение options
		$result = array();
		$options = array();

		foreach ($data as $key => $value) {
			if (strpos($key, 'option_') === 0) {
				$option_id = str_replace('option_', '', $key);
				$options[] = $option_id . ModelCatalogNeoseoFilter::OPTION_VALUE_SEP . implode(ModelCatalogNeoseoFilter::VALUES_SEP, $value);
				continue;
			}
			$result[$key] = $value;
		}
		if ($options) {
			$options_str = implode(ModelCatalogNeoseoFilter::OPTIONS_SEP, $options);

			// А теперь надо отсортировать согласно sort_order
			$options = $this->model_catalog_neoseo_filter->explodeFilterParam($options_str);
			$options_str = $this->model_catalog_neoseo_filter->buildFilterParam($options);
			$result['options'] = $options_str;
		} else {
			$result['options'] = '';
		}
		return $result;
	}

	public function add()
	{
		$data = $this->language->load('catalog/' . $this->_moduleSysName . "_pages");

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/' . $this->_moduleSysName . "_pages");

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$data = $this->processFilterOption($this->request->post);
			$this->model_catalog_neoseo_filter_pages->addPage($data);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			if (isset($this->request->get['filter_h1'])) {
				$url .= '&filter_h1=' . urlencode(html_entity_decode($this->request->get['filter_h1'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_status'])) {
				$url .= '&filter_status=' . urlencode(html_entity_decode($this->request->get['filter_status'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_keyword'])) {
				$url .= '&filter_keyword=' . urlencode(html_entity_decode($this->request->get['filter_keyword'], ENT_QUOTES, 'UTF-8'));
			}

			$this->response->redirect($this->url->link('catalog/' . $this->_moduleSysName . "_pages", 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}

	public function edit()
	{
		$data = $this->language->load('catalog/' . $this->_moduleSysName . "_pages");

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/' . $this->_moduleSysName . "_pages");

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$data = $this->processFilterOption($this->request->post);
			$this->model_catalog_neoseo_filter_pages->editPage($this->request->get['page_id'], $data);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			if (isset($this->request->get['filter_h1'])) {
				$url .= '&filter_h1=' . urlencode(html_entity_decode($this->request->get['filter_h1'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_status'])) {
				$url .= '&filter_status=' . urlencode(html_entity_decode($this->request->get['filter_status'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_keyword'])) {
				$url .= '&filter_keyword=' . urlencode(html_entity_decode($this->request->get['filter_keyword'], ENT_QUOTES, 'UTF-8'));
			}

			$this->response->redirect($this->url->link('catalog/' . $this->_moduleSysName . "_pages", 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}

	public function deletePages()
	{
		$this->language->load('catalog/' . $this->_moduleSysName . "_pages");

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/' . $this->_moduleSysName . "_pages");

		$pages = array();
		if (isset($this->request->post['selected'])) {
			foreach ($this->request->post['selected'] as $page_id) {
				$pages[] = $page_id;
			}
		} else if (isset($this->request->get['page_id'])) {
			$pages[] = (int) $this->request->get['page_id'];
		}

		if ($pages && $this->validateDeletePages()) {
			foreach ($pages as $page_id) {
				$this->model_catalog_neoseo_filter_pages->deletePage($page_id);
			}

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			if (isset($this->request->get['filter_h1'])) {
				$url .= '&filter_h1=' . urlencode(html_entity_decode($this->request->get['filter_h1'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_status'])) {
				$url .= '&filter_status=' . urlencode(html_entity_decode($this->request->get['filter_status'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_keyword'])) {
				$url .= '&filter_keyword=' . urlencode(html_entity_decode($this->request->get['filter_keyword'], ENT_QUOTES, 'UTF-8'));
			}

			$this->response->redirect($this->url->link('catalog/' . $this->_moduleSysName . "_pages", 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getList();
	}

	protected function getList()
	{
		$data = $this->language->load('catalog/' . $this->_moduleSysName . "_pages");

		$this->document->setTitle($this->language->get('heading_title'));

		if (isset($this->request->get['filter_h1'])) {
			$filter_h1 = $this->request->get['filter_h1'];
		} else {
			$filter_h1 = null;
		}

		if (isset($this->request->get['filter_status'])) {
			$filter_status = $this->request->get['filter_status'];
		} else {
			$filter_status = null;
		}

		if (isset($this->request->get['filter_keyword'])) {
			$filter_keyword = $this->request->get['filter_keyword'];
		} else {
			$filter_keyword = null;
		}

		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'fpd.h1';
		}

		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'ASC';
		}

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		$url = '';

		if (isset($this->request->get['filter_h1'])) {
			$url .= '&filter_h1=' . urlencode(html_entity_decode($this->request->get['filter_h1'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . urlencode(html_entity_decode($this->request->get['filter_status'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_keyword'])) {
			$url .= '&filter_keyword=' . urlencode(html_entity_decode($this->request->get['filter_keyword'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('catalog/' . $this->_moduleSysName . "_pages", 'token=' . $this->session->data['token'] . $url, 'SSL')
		);

		$data['add'] = $this->url->link('catalog/' . $this->_moduleSysName . "_pages/add", 'token=' . $this->session->data['token'] . $url, 'SSL');
		$data['delete'] = $this->url->link('catalog/' . $this->_moduleSysName . "_pages/deletePages", 'token=' . $this->session->data['token'] . $url, 'SSL');

		$data['pages'] = array();

		$filter_data = array(
			'filter_h1' => $filter_h1,
			'filter_status' => $filter_status,
			'filter_keyword' => $filter_keyword,
			'sort' => $sort,
			'order' => $order,
			'start' => ($page - 1) * $this->config->get('config_limit_admin'),
			'limit' => $this->config->get('config_limit_admin')
		);

		$pages_total = $this->model_catalog_neoseo_filter_pages->getTotalFilterPages($filter_data);

		$this->load->model('catalog/neoseo_filter');

		// Categories
		$this->load->model('catalog/category');
		$categories = array();
		$categories_filter_data = array(
			'sort' => 'name',
			'order' => 'ASC'
		);
		foreach ($this->model_catalog_category->getCategories($categories_filter_data) as $row) {
			$categories[$row['category_id']] = $row['name'];
		}


		$pages = $this->model_catalog_neoseo_filter_pages->getFilterPages($filter_data);

		foreach ($pages as $value) {
			if (!$value['page_keyword']) {
				$value['keyword'] = $value['old_keyword'];
			}

			$data['pages'][] = array(
				'page_id' => $value['page_id'],
				'h1' => $value['h1'],
				'category' => ( isset($categories[$value['category_id']]) ? $categories[$value['category_id']] : "-"),
				'options' => $this->model_catalog_neoseo_filter->getFilterNames($value['options']),
				'keyword' => $value['keyword'],
				'status' => $value['status'] ? $this->language->get('text_enabled') : $this->language->get('text_disabled'),
				'edit' => $this->url->link('catalog/' . $this->_moduleSysName . "_pages/edit", 'token=' . $this->session->data['token'] . '&page_id=' . $value['page_id'] . $url, 'SSL'),
				'delete' => $this->url->link('catalog/' . $this->_moduleSysName . "_pages/deletePages", 'token=' . $this->session->data['token'] . '&page_id=' . $value['page_id'] . $url, 'SSL'),
				'href' => HTTP_CATALOG . 'index.php?route=product/category&path=' . $value['category_id'] . '&nsf=' . $value['options'],
			);
		}

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

		if (isset($this->request->post['selected'])) {
			$data['selected'] = (array) $this->request->post['selected'];
		} else {
			$data['selected'] = array();
		}

		$url = '';

		if (isset($this->request->get['filter_h1'])) {
			$url .= '&filter_h1=' . urlencode(html_entity_decode($this->request->get['filter_h1'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . urlencode(html_entity_decode($this->request->get['filter_status'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_keyword'])) {
			$url .= '&filter_keyword=' . urlencode(html_entity_decode($this->request->get['filter_keyword'], ENT_QUOTES, 'UTF-8'));
		}

		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['sort_h1'] = $this->url->link('catalog/' . $this->_moduleSysName . "_pages", 'token=' . $this->session->data['token'] . '&sort=fpd.h1' . $url, 'SSL');
		$data['sort_status'] = $this->url->link('catalog/' . $this->_moduleSysName . "_pages", 'token=' . $this->session->data['token'] . '&sort=fp.status' . $url, 'SSL');

		$url = '';

		if (isset($this->request->get['filter_h1'])) {
			$url .= '&filter_h1=' . urlencode(html_entity_decode($this->request->get['filter_h1'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . urlencode(html_entity_decode($this->request->get['filter_status'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_keyword'])) {
			$url .= '&filter_keyword=' . urlencode(html_entity_decode($this->request->get['filter_keyword'], ENT_QUOTES, 'UTF-8'));
		}
		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$pagination = new Pagination();
		$pagination->total = $pages_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_limit_admin');
		$pagination->keyword = $this->url->link('catalog/' . $this->_moduleSysName . "_pages", 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');
		$pagination->url = $this->url->link('catalog/' . $this->_moduleSysName . "_pages", 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($pages_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($pages_total - $this->config->get('config_limit_admin'))) ? $pages_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $pages_total, ceil($pages_total / $this->config->get('config_limit_admin')));

		$data['filter_h1'] = $filter_h1;
		$data['filter_status'] = $filter_status;
		$data['filter_keyword'] = $filter_keyword;

		$data['sort'] = $sort;
		$data['order'] = $order;

		$data['language_id'] = $this->config->get('config_language_id');

		$data['token'] = $this->session->data['token'];

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('catalog/' . $this->_moduleSysName . "_pages_list.tpl", $data));
	}

	protected function getForm()
	{
		$this->load->model('catalog/category');
		$this->load->model('tool/image');

		$data = $this->language->load('catalog/' . $this->_moduleSysName . "_pages");

		$this->document->addScript('view/javascript/bootstrap-colorpicker/js/bootstrap-colorpicker.js');
		$this->document->addStyle('view/javascript/bootstrap-colorpicker/css/bootstrap-colorpicker.css');

		$this->document->addScript('view/javascript/bootstrap-multiselect/js/bootstrap-multiselect.js');
		$this->document->addStyle('view/javascript/bootstrap-multiselect/css/bootstrap-multiselect.css');

		//CKEditor
		if ($this->config->get('config_editor_default')) {
			$this->document->addScript('view/javascript/ckeditor/ckeditor.js');
			$this->document->addScript('view/javascript/ckeditor/ckeditor_init.js');
		}
		$data['ckeditor'] = $this->config->get('config_editor_default');

		$data['text_form'] = !isset($this->request->get['page_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		if (isset($this->request->get['filter_h1'])) {
			$url .= '&filter_h1=' . urlencode(html_entity_decode($this->request->get['filter_h1'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . urlencode(html_entity_decode($this->request->get['filter_status'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_keyword'])) {
			$url .= '&filter_keyword=' . urlencode(html_entity_decode($this->request->get['filter_keyword'], ENT_QUOTES, 'UTF-8'));
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('catalog/' . $this->_moduleSysName . "_pages", 'token=' . $this->session->data['token'] . $url, 'SSL')
		);

		if (!isset($this->request->get['page_id'])) {
			$data['action'] = $this->url->link('catalog/' . $this->_moduleSysName . "_pages/add", 'token=' . $this->session->data['token'] . $url, 'SSL');

			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('text_add'),
				'href' => $this->url->link('catalog/' . $this->_moduleSysName . "_pages/add", 'token=' . $this->session->data['token'] . $url, 'SSL')
			);
		} else {
			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('text_edit'),
				'href' => $this->url->link('catalog/' . $this->_moduleSysName . "_pages/edit", 'token=' . $this->session->data['token'] . '&page_id=' . $this->request->get['page_id'] . $url, 'SSL')
			);

			$data['action'] = $this->url->link('catalog/' . $this->_moduleSysName . "_pages/edit", 'token=' . $this->session->data['token'] . '&page_id=' . $this->request->get['page_id'] . $url, 'SSL');
		}

		$data['cancel'] = $this->url->link('catalog/' . $this->_moduleSysName . "_pages", 'token=' . $this->session->data['token'] . $url, 'SSL');
		$data['category_options'] = $this->url->link('catalog/' . $this->_moduleSysName . '_pages/category_options', 'token=' . $this->session->data['token'] . $url, 'SSL');

		$this->load->model('localisation/language');

		$data['languages'] = $this->model_localisation_language->getLanguages();


		$data['token'] = $this->session->data['token'];

		if (isset($this->request->get['page_id'])) {
			$page_info = $this->model_catalog_neoseo_filter_pages->getPage($this->request->get['page_id']);

			$data['page_id'] = $page_info['page_id'];
			$data['category_id'] = isset($this->request->post['category_id']) ? $this->request->post['category_id'] : $page_info['category_id'];
			$data['status'] = isset($this->request->post['status']) ? $this->request->post['status'] : $page_info['status'];
			// $data['keyword'] = isset($this->request->post['keyword']) && $this->request->post['keyword'] !== '' ? $this->request->post['keyword'] : $page_info['keyword'];
			$data['options'] = isset($this->request->post['options']) && $this->request->post['options'] !== '' ? $this->request->post['options'] : $page_info['options'];

			foreach ($data['languages'] as $language) {
				$data['title'][$language['language_id']] = isset($this->request->post['title'][$language['language_id']]) ? $this->request->post['title'][$language['language_id']] : $page_info['title'][$language['language_id']];
				$data['keyword'][$language['language_id']] = isset($this->request->post['keyword'][$language['language_id']]) && $this->request->post['keyword'][$language['language_id']] !== '' ? $this->request->post['keyword'][$language['language_id']] : $page_info['keyword'][$language['language_id']];
				$data['description'][$language['language_id']] = isset($this->request->post['description'][$language['language_id']]) ? $this->request->post['description'][$language['language_id']] : $page_info['description'][$language['language_id']];
				$data['h1'][$language['language_id']] = isset($this->request->post['h1'][$language['language_id']]) ? $this->request->post['h1'][$language['language_id']] : $page_info['h1'][$language['language_id']];
				$data['meta_keywords'][$language['language_id']] = isset($this->request->post['meta_keywords'][$language['language_id']]) ? $this->request->post['meta_keywords'][$language['language_id']] : $page_info['meta_keywords'][$language['language_id']];
				$data['meta_description'][$language['language_id']] = isset($this->request->post['meta_description'][$language['language_id']]) ? $this->request->post['meta_description'][$language['language_id']] : $page_info['meta_description'][$language['language_id']];
			}
		} else {
			$data['status'] = isset($this->request->post['status']) ? $this->request->post['status'] : 0;
			//$data['keyword'] = isset($this->request->post['keyword']) ? $this->request->post['keyword'] : '';
			$data['options'] = isset($this->request->post['options']) && $this->request->post['options'] !== '' ? $this->request->post['options'] : '';
			$data['category_id'] = 0;

			foreach ($data['languages'] as $language) {
				$data['title'][$language['language_id']] = isset($this->request->post['title'][$language['language_id']]) ? $this->request->post['title'][$language['language_id']] : '';
				$data['keyword'][$language['language_id']] = isset($this->request->post['keyword'][$language['language_id']]) ? $this->request->post['keyword'][$language['language_id']] : '';
				$data['description'][$language['language_id']] = isset($this->request->post['description'][$language['language_id']]) ? $this->request->post['description'][$language['language_id']] : '';
				$data['h1'][$language['language_id']] = isset($this->request->post['h1'][$language['language_id']]) ? $this->request->post['h1'][$language['language_id']] : '';
				$data['meta_keywords'][$language['language_id']] = isset($this->request->post['meta_keywords'][$language['language_id']]) ? $this->request->post['meta_keywords'][$language['language_id']] : '';
				$data['meta_description'][$language['language_id']] = isset($this->request->post['meta_description'][$language['language_id']]) ? $this->request->post['meta_description'][$language['language_id']] : '';
			}
		}

		$data['language_id'] = $this->config->get('config_language_id');


		// Categories
		$this->load->model('catalog/category');
		$categories = array();
		$categories_filter_data = array(
			'sort' => 'name',
			'order' => 'ASC'
		);
		foreach ($this->model_catalog_category->getCategories($categories_filter_data) as $row) {
			$categories[$row['category_id']] = $row['name'];
		}
		$data['categories'] = $categories;


		$data['params'] = $data;

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('catalog/' . $this->_moduleSysName . "_pages_form.tpl", $data));
	}

	public function category_options()
	{
		// Отличие от category_options внутри neoseo_filter заключается в том, что тут есть еще и производитель

		if (!isset($this->request->get['category_id'])) {
			return '';
		}
		$category_id = (int) $this->request->get['category_id'];

		$this->load->model('catalog/' . $this->_moduleSysName);

		$data = $this->language->load('catalog/' . $this->_moduleSysName . '_pages');

		$selected_options_raw = $this->request->get['options'];
		$selected_options = $this->model_catalog_neoseo_filter->explodeFilterParam($selected_options_raw);

		$data['options'] = array();

		$manufacturers = $this->model_catalog_neoseo_filter->getManufacturersOptions($category_id);
		if ($manufacturers) {
			$values = array();
			foreach ($manufacturers as $manufacturer_id => $manufacturer_name) {
				$values[-$manufacturer_id] = array(
					"name" => $manufacturer_name,
					"selected" => isset($selected_options['m']) && in_array(-$manufacturer_id, $selected_options['m']),
				);
			}

			$data['options'][] = array(
				'option_id' => 'm',
				'name' => $this->language->get('text_manufacturer'),
				'values' => $values,
			);
		}

		$filter_data = array(
			'filter_status' => 1,
			'filter_category' => $category_id,
		);

		$options = $this->model_catalog_neoseo_filter->getFilterOptions($filter_data);
		foreach ($options as $option) {

			$values = array();
			foreach ($this->model_catalog_neoseo_filter->getOptionValues($option['option_id']) as $option_value) {
				$values[$option_value['option_value_id']] = array(
					"name" => $option_value['name'],
					"selected" => isset($selected_options[$option['option_id']]) && in_array($option_value['option_value_id'], $selected_options[$option['option_id']]),
				);
			}
			$data['options'][] = array(
				'option_id' => $option['option_id'],
				'name' => $option['name'],
				'values' => $values,
			);
		}

		$this->response->setOutput($this->load->view('catalog/neoseo_filter_options.tpl', $data));
	}

	protected function validateForm()
	{
		if (!$this->user->hasPermission('modify', 'catalog/' . $this->_moduleSysName . "_pages")) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		foreach ($this->request->post['title'] as $name) {
			if ((utf8_strlen($name) < 3) || (utf8_strlen($name) > 160)) {
				$this->error['warning'] = $this->language->get('error_name');
			}
		}

		if ($this->request->post['keyword']) {
			foreach ($this->request->post['keyword'] as $keyword)
				$keyword = trim($keyword);
			if ($keyword !== '' && $page_id = $this->model_catalog_neoseo_filter_pages->getPageByKeyword($keyword)) {
				if ((isset($this->request->get['page_id']) && $page_id != $this->request->get['page_id']) || !isset($this->request->get['page_id'])) {
					$this->error['warning'] = $this->language->get('error_isset_keyword');
				}
			}
		}

		return !$this->error;
	}

	protected function validateDeletePages()
	{
		if (!$this->user->hasPermission('modify', 'catalog/' . $this->_moduleSysName . "_pages")) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}

	public function autocomplete()
	{
		$json = array();

		if (isset($this->request->get['filter_h1']) || isset($this->request->get['filter_keyword'])) {
			$this->load->model('catalog/' . $this->_moduleSysName . "_pages");

			if (isset($this->request->get['filter_h1'])) {
				$filter_h1 = $this->request->get['filter_h1'];
			} else {
				$filter_h1 = '';
			}

			if (isset($this->request->get['filter_keyword'])) {
				$filter_keyword = $this->request->get['filter_keyword'];
			} else {
				$filter_keyword = '';
			}

			$filter_data = array(
				'filter_h1' => $filter_h1,
				'filter_keyword' => $filter_keyword,
				'start' => 0,
				'limit' => 10
			);

			$pages = $this->model_catalog_neoseo_filter_pages->getFilterPages($filter_data);

			foreach ($pages as $page) {
				$json[] = array(
					'page_id' => $page['page_id'],
					'keyword' => strip_tags(html_entity_decode($page['keyword'], ENT_QUOTES, 'UTF-8')),
					'h1' => strip_tags(html_entity_decode($page['h1'], ENT_QUOTES, 'UTF-8'))
				);
			}
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function getKeyword()
	{
		$json = array();

		if (isset($this->request->get['keyword'])) {
			$keyword = trim($this->request->get['keyword']);
			$this->load->model('catalog/' . $this->_moduleSysName . "_pages");
			$json['keyword'] = $this->model_catalog_neoseo_filter_pages->translate($keyword);
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

}
