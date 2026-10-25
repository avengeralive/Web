<?php

require_once( DIR_SYSTEM . "/engine/neoseo_controller.php");

class ControllerCatalogNeoSeoFilter extends NeoSeoController
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

		$this->load->model('catalog/' . $this->_moduleSysName);
		$this->load->model('catalog/category');

		$this->getList();
	}

	public function add()
	{
		$data = $this->language->load('catalog/' . $this->_moduleSysName);

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/' . $this->_moduleSysName);

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_catalog_neoseo_filter->addOption($this->request->post);

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

			if (isset($this->request->get['filter_option_category'])) {
				$url .= '&filter_option_category=' . urlencode(html_entity_decode($this->request->get['filter_option_category'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_option_type'])) {
				$url .= '&filter_option_type=' . urlencode(html_entity_decode($this->request->get['filter_option_type'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_option_name'])) {
				$url .= '&filter_option_name=' . urlencode(html_entity_decode($this->request->get['filter_option_name'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_option_status'])) {
				$url .= '&filter_option_status=' . urlencode(html_entity_decode($this->request->get['filter_option_status'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_option_keyword'])) {
				$url .= '&filter_option_keyword=' . urlencode(html_entity_decode($this->request->get['filter_option_keyword'], ENT_QUOTES, 'UTF-8'));
			}

			$this->response->redirect($this->url->link('catalog/' . $this->_moduleSysName, 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}

	public function edit()
	{
		$data = $this->language->load('catalog/' . $this->_moduleSysName);

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/' . $this->_moduleSysName);

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_catalog_neoseo_filter->editOption($this->request->get['option_id'], $this->request->post);

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

			if (isset($this->request->get['filter_option_category'])) {
				$url .= '&filter_option_category=' . urlencode(html_entity_decode($this->request->get['filter_option_category'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_option_type'])) {
				$url .= '&filter_option_type=' . urlencode(html_entity_decode($this->request->get['filter_option_type'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_option_name'])) {
				$url .= '&filter_option_name=' . urlencode(html_entity_decode($this->request->get['filter_option_name'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_option_status'])) {
				$url .= '&filter_option_status=' . urlencode(html_entity_decode($this->request->get['filter_option_status'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_option_keyword'])) {
				$url .= '&filter_option_keyword=' . urlencode(html_entity_decode($this->request->get['filter_option_keyword'], ENT_QUOTES, 'UTF-8'));
			}

			$this->response->redirect($this->url->link('catalog/' . $this->_moduleSysName, 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}

	public function deleteOptions()
	{
		$this->language->load('catalog/' . $this->_moduleSysName);

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/' . $this->_moduleSysName);

		if (isset($this->request->post['selected']) && $this->validateDeleteOptions()) {
			foreach ($this->request->post['selected'] as $option_id) {
				$this->model_catalog_neoseo_filter->deleteOption($option_id);
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

			if (isset($this->request->get['filter_option_category'])) {
				$url .= '&filter_option_category=' . urlencode(html_entity_decode($this->request->get['filter_option_category'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_option_type'])) {
				$url .= '&filter_option_type=' . urlencode(html_entity_decode($this->request->get['filter_option_type'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_option_name'])) {
				$url .= '&filter_option_name=' . urlencode(html_entity_decode($this->request->get['filter_option_name'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_option_status'])) {
				$url .= '&filter_option_status=' . urlencode(html_entity_decode($this->request->get['filter_option_status'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_option_keyword'])) {
				$url .= '&filter_option_keyword=' . urlencode(html_entity_decode($this->request->get['filter_option_keyword'], ENT_QUOTES, 'UTF-8'));
			}

			$this->response->redirect($this->url->link('catalog/' . $this->_moduleSysName, 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getList();
	}

	public function deleteOption()
	{
		$this->language->load('catalog/' . $this->_moduleSysName);

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/' . $this->_moduleSysName);

		if (isset($this->request->get['option_id']) && $this->validateDeleteOption()) {

			$this->model_catalog_neoseo_filter->deleteOption($this->request->get['option_id']);

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

			if (isset($this->request->get['filter_option_category'])) {
				$url .= '&filter_option_category=' . urlencode(html_entity_decode($this->request->get['filter_option_category'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_option_type'])) {
				$url .= '&filter_option_type=' . urlencode(html_entity_decode($this->request->get['filter_option_type'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_option_name'])) {
				$url .= '&filter_option_name=' . urlencode(html_entity_decode($this->request->get['filter_option_name'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_option_status'])) {
				$url .= '&filter_option_status=' . urlencode(html_entity_decode($this->request->get['filter_option_status'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_option_keyword'])) {
				$url .= '&filter_option_keyword=' . urlencode(html_entity_decode($this->request->get['filter_option_keyword'], ENT_QUOTES, 'UTF-8'));
			}

			$this->response->redirect($this->url->link('catalog/' . $this->_moduleSysName, 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getList();
	}

	protected function getList()
	{
		$data = $this->language->load('catalog/' . $this->_moduleSysName);

		$this->document->setTitle($this->language->get('heading_title'));

		if (isset($this->request->get['filter_option_name'])) {
			$filter_option_name = $this->request->get['filter_option_name'];
		} else {
			$filter_option_name = null;
		}

		if (isset($this->request->get['filter_option_status'])) {
			$filter_option_status = $this->request->get['filter_option_status'];
		} else {
			$filter_option_status = null;
		}

		if (isset($this->request->get['filter_option_category'])) {
			$filter_option_category = $this->request->get['filter_option_category'];
		} else {
			$filter_option_category = null;
		}

		if (isset($this->request->get['filter_option_keyword'])) {
			$filter_option_keyword = $this->request->get['filter_option_keyword'];
		} else {
			$filter_option_keyword = null;
		}

		if (isset($this->request->get['filter_option_type'])) {
			$filter_option_type = $this->request->get['filter_option_type'];
		} else {
			$filter_option_type = null;
		}

		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'fod.name';
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

		if (isset($this->request->get['filter_option_name'])) {
			$url .= '&filter_option_name=' . urlencode(html_entity_decode($this->request->get['filter_option_name'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_option_status'])) {
			$url .= '&filter_option_status=' . urlencode(html_entity_decode($this->request->get['filter_option_status'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_option_category'])) {
			$url .= '&filter_option_category=' . urlencode(html_entity_decode($this->request->get['filter_option_category'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_option_keyword'])) {
			$url .= '&filter_option_keyword=' . urlencode(html_entity_decode($this->request->get['filter_option_keyword'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_option_type'])) {
			$url .= '&filter_option_type=' . urlencode(html_entity_decode($this->request->get['filter_option_type'], ENT_QUOTES, 'UTF-8'));
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
			'href' => $this->url->link('catalog/' . $this->_moduleSysName, 'token=' . $this->session->data['token'] . $url, 'SSL')
		);

		$data['add'] = $this->url->link('catalog/' . $this->_moduleSysName . '/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$data['delete'] = $this->url->link('catalog/' . $this->_moduleSysName . '/deleteOptions', 'token=' . $this->session->data['token'] . $url, 'SSL');

		$data['options'] = array();



		$this->load->model('catalog/category');
		$filter_data = array(
			'sort' => 'name',
			'order' => 'ASC'
		);

		$data['categories'] = array();

		$categories = $this->model_catalog_category->getCategories($filter_data);

		foreach ($categories as $result) {
			$data['categories'][$result['category_id']] = array(
				'category_id' => $result['category_id'],
				'name' => $result['name'],
				'parent_id' => $result['parent_id'],
				'sort_order' => $result['sort_order'],
				'status' => $result['status'],
				'product_count' => $result['product_count']
			);
		}

		$filter_data = array(
			'filter_name' => $filter_option_name,
			'filter_status' => $filter_option_status,
			'filter_category' => $filter_option_category,
			'filter_keyword' => $filter_option_keyword,
			'filter_type' => $filter_option_type,
			'sort' => $sort,
			'order' => $order,
			'start' => ($page - 1) * $this->config->get('config_limit_admin'),
			'limit' => $this->config->get('config_limit_admin')
		);

		$options_total = $this->model_catalog_neoseo_filter->getTotalFilterOptions($filter_data);

		$options = $this->model_catalog_neoseo_filter->getFilterOptions($filter_data);

		foreach ($options as $option) {
			$categories = array();
			foreach ($this->model_catalog_neoseo_filter->getOptionCategories($option['option_id']) as $category_id) {
				if (!isset($data['categories'][$category_id])) {
					continue;
				}
				$categories[] = $data['categories'][$category_id]['name'];
			}
			$option_values = $this->model_catalog_neoseo_filter->getOptionValues($option['option_id']);

			$option_values_name = array();
			foreach ($option_values as $option_value) {
				$option_values_name[] = $option_value['name'];
			}

			$data['options'][] = array(
				'option_id' => $option['option_id'],
				'name' => $option['name'],
				'sort_order' => $option['sort_order'],
				'type' => $option['type'],
				'categories' => $categories,
				'option_values' => $option_values_name,
				'status' => $option['status'] ? $this->language->get('text_enabled') : $this->language->get('text_disabled'),
				'delete' => $this->url->link('catalog/' . $this->_moduleSysName . '/deleteOption', 'token=' . $this->session->data['token'] . '&option_id=' . $option['option_id'] . $url, 'SSL'),
				'edit' => $this->url->link('catalog/' . $this->_moduleSysName . '/edit', 'token=' . $this->session->data['token'] . '&option_id=' . $option['option_id'] . $url, 'SSL')
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

		if (isset($this->request->get['filter_option_name'])) {
			$url .= '&filter_option_name=' . urlencode(html_entity_decode($this->request->get['filter_option_name'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_option_status'])) {
			$url .= '&filter_option_status=' . urlencode(html_entity_decode($this->request->get['filter_option_status'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_option_category'])) {
			$url .= '&filter_option_category=' . urlencode(html_entity_decode($this->request->get['filter_option_category'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_option_keyword'])) {
			$url .= '&filter_option_keyword=' . urlencode(html_entity_decode($this->request->get['filter_option_keyword'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_option_type'])) {
			$url .= '&filter_option_type=' . urlencode(html_entity_decode($this->request->get['filter_option_type'], ENT_QUOTES, 'UTF-8'));
		}

		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['sort_option_name'] = $this->url->link('catalog/' . $this->_moduleSysName, 'token=' . $this->session->data['token'] . '&sort=fod.name' . $url, 'SSL');
		$data['sort_option_type'] = $this->url->link('catalog/' . $this->_moduleSysName, 'token=' . $this->session->data['token'] . '&sort=fo.type' . $url, 'SSL');
		$data['sort_option_order'] = $this->url->link('catalog/' . $this->_moduleSysName, 'token=' . $this->session->data['token'] . '&sort=fo.sort_order' . $url, 'SSL');
		$data['sort_option_status'] = $this->url->link('catalog/' . $this->_moduleSysName, 'token=' . $this->session->data['token'] . '&sort=fo.status' . $url, 'SSL');

		$url = '';

		if (isset($this->request->get['filter_option_name'])) {
			$url .= '&filter_option_name=' . urlencode(html_entity_decode($this->request->get['filter_option_name'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_option_status'])) {
			$url .= '&filter_option_status=' . urlencode(html_entity_decode($this->request->get['filter_option_status'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_option_category'])) {
			$url .= '&filter_option_category=' . urlencode(html_entity_decode($this->request->get['filter_option_category'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_option_keyword'])) {
			$url .= '&filter_option_keyword=' . urlencode(html_entity_decode($this->request->get['filter_option_keyword'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_option_type'])) {
			$url .= '&filter_option_type=' . urlencode(html_entity_decode($this->request->get['filter_option_type'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$pagination = new Pagination();
		$pagination->total = $options_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_limit_admin');
		$pagination->url = $this->url->link('catalog/' . $this->_moduleSysName, 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($options_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($options_total - $this->config->get('config_limit_admin'))) ? $options_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $options_total, ceil($options_total / $this->config->get('config_limit_admin')));

		$data['option_type'] = array(
			'grid' => $this->language->get('param_type_grid'),
			'checkbox' => $this->language->get('param_type_checkbox'),
			'radio' => $this->language->get('param_type_radio'),
		);

		$data['filter_option_name'] = $filter_option_name;
		$data['filter_option_status'] = $filter_option_status;
		$data['filter_option_category'] = $filter_option_category;
		$data['filter_option_keyword'] = $filter_option_keyword;
		$data['filter_option_type'] = $filter_option_type;

		$data['sort'] = $sort;
		$data['order'] = $order;

		$data['language_id'] = $this->config->get('config_language_id');

		$data['token'] = $this->session->data['token'];

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('catalog/' . $this->_moduleSysName . '_list.tpl', $data));
	}

	protected function getForm()
	{
		$this->load->model('catalog/category');
		$this->load->model('tool/image');

		$data = $this->language->load('catalog/' . $this->_moduleSysName);

		$this->document->addScript('view/javascript/bootstrap-colorpicker/js/bootstrap-colorpicker.js');
		$this->document->addStyle('view/javascript/bootstrap-colorpicker/css/bootstrap-colorpicker.css');

		$this->document->addScript('view/javascript/bootstrap-multiselect/js/bootstrap-multiselect.js');
		$this->document->addStyle('view/javascript/bootstrap-multiselect/css/bootstrap-multiselect.css');

		$data['text_form'] = !isset($this->request->get['file_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['warning_option_value_name'])) {
			$data['error_option_value_name'] = $this->error['warning_option_value_name'];
		} else {
			$data['error_option_value_name'] = '';
		}

		if (isset($this->error['warning_option_value_keyword'])) {
			$data['error_option_value_keyword'] = $this->error['warning_option_value_keyword'];
		} else {
			$data['error_option_value_keyword'] = '';
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

		if (isset($this->request->get['filter_option_category'])) {
			$url .= '&filter_option_category=' . urlencode(html_entity_decode($this->request->get['filter_option_category'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_option_type'])) {
			$url .= '&filter_option_type=' . urlencode(html_entity_decode($this->request->get['filter_option_type'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_option_name'])) {
			$url .= '&filter_option_name=' . urlencode(html_entity_decode($this->request->get['filter_option_name'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_option_status'])) {
			$url .= '&filter_option_status=' . urlencode(html_entity_decode($this->request->get['filter_option_status'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_option_keyword'])) {
			$url .= '&filter_option_keyword=' . urlencode(html_entity_decode($this->request->get['filter_option_keyword'], ENT_QUOTES, 'UTF-8'));
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('catalog/' . $this->_moduleSysName, 'token=' . $this->session->data['token'] . $url, 'SSL')
		);

		if (!isset($this->request->get['option_id'])) {
			$data['action'] = $this->url->link('catalog/' . $this->_moduleSysName . '/add', 'token=' . $this->session->data['token'] . $url, 'SSL');

			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('text_add'),
				'href' => $this->url->link('catalog/' . $this->_moduleSysName . '/add', 'token=' . $this->session->data['token'] . $url, 'SSL')
			);
		} else {
			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('text_edit'),
				'href' => $this->url->link('catalog/' . $this->_moduleSysName . '/edit', 'token=' . $this->session->data['token'] . '&option_id=' . $this->request->get['option_id'] . $url, 'SSL')
			);

			$data['action'] = $this->url->link('catalog/' . $this->_moduleSysName . '/edit', 'token=' . $this->session->data['token'] . '&option_id=' . $this->request->get['option_id'] . $url, 'SSL');
		}

		$data['cancel'] = $this->url->link('catalog/' . $this->_moduleSysName, 'token=' . $this->session->data['token'] . $url, 'SSL');

		$this->load->model('localisation/language');

		$data['languages'] = $this->model_localisation_language->getLanguages();


		$data['token'] = $this->session->data['token'];

		if (isset($this->request->get['option_id'])) {
			$option_info = $this->model_catalog_neoseo_filter->getOption($this->request->get['option_id']);
			$data['option_id'] = $option_info['option_id'];
			$data['option_status'] = isset($this->request->post['option_status']) ? $this->request->post['option_status'] : $option_info['status'];
			$data['option_open'] = isset($this->request->post['option_open']) ? $this->request->post['option_open'] : $option_info['open'];
			$data['option_style'] = isset($this->request->post['option_style']) ? $this->request->post['option_style'] : $option_info['style'];
			$data['option_type'] = isset($this->request->post['option_type']) ? $this->request->post['option_type'] : $option_info['type'];
			$data['option_keyword'] = $this->model_catalog_neoseo_filter->getOptionKeyword($this->request->get['option_id']);

			$data['option_sort_order'] = isset($this->request->post['option_sort_order']) ? $this->request->post['option_sort_order'] : $option_info['sort_order'];
			$data['option_name'] = $this->model_catalog_neoseo_filter->getOptionName($this->request->get['option_id']);
			$data['option_categories'] = $this->model_catalog_neoseo_filter->getOptionCategories($this->request->get['option_id']);

			if (!isset($this->request->post['option_values'])) {
				$option_values = $this->model_catalog_neoseo_filter->getOptionValues($this->request->get['option_id']);
				$data['option_values'] = array();

				foreach ($option_values as $option_value) {

					$data['option_values'][$option_value['option_value_id']] = $option_value;
					$data['option_values'][$option_value['option_value_id']]['name'] = $this->model_catalog_neoseo_filter->getOptionValuesDescription($option_value['option_value_id']);
					$data['option_values'][$option_value['option_value_id']]['keyword'] = $this->model_catalog_neoseo_filter->getOptionValuesKeyword($option_value['option_value_id']);
					$data['option_values'][$option_value['option_value_id']]['position'] = $option_value['position'];

					if (!empty($option_value['image']) && is_file(DIR_IMAGE . $option_value['image'])) {
						$data['option_values'][$option_value['option_value_id']]['thumb'] = $this->model_tool_image->resize($option_value['image'], 100, 100);
					} else {
						$data['option_values'][$option_value['option_value_id']]['thumb'] = $this->model_tool_image->resize('no_image.png', 100, 100);
					}
				}
			} else {
				$option_values = $this->request->post['option_values'];
				$data['option_values'] = array();

				foreach ($option_values as $option_value_id => $option_value) {

					$data['option_values'][$option_value_id] = $option_value;
					$data['option_values'][$option_value_id]['image'] = $option_value['image'];

					if (!empty($option_value['image']) && is_file(DIR_IMAGE . $option_value['image'])) {
						$data['option_values'][$option_value_id]['thumb'] = $this->model_tool_image->resize($option_value['image'], 100, 100);
					} else {
						$data['option_values'][$option_value_id]['thumb'] = $this->model_tool_image->resize('no_image.png', 100, 100);
					}
				}
			}
		} else {

			$data['option_status'] = isset($this->request->post['option_status']) ? $this->request->post['option_status'] : 0;
			$data['option_open'] = isset($this->request->post['option_open']) ? $this->request->post['option_open'] : 0;
			$data['option_style'] = isset($this->request->post['option_style']) ? $this->request->post['option_style'] : 'none';
			$data['option_keyword'] = isset($this->request->post['option_keyword']) ? $this->request->post['option_keyword'] : '';
			$data['option_type'] = isset($this->request->post['option_type']) ? $this->request->post['option_type'] : 'grid';
			$data['option_sort_order'] = isset($this->request->post['option_sort_order']) ? $this->request->post['option_sort_order'] : '';

			if (isset($this->request->post['option_name'])) {
				$data['option_name'] = $this->request->post['option_name'];
			} else {
				foreach ($data['languages'] as $language) {
					$data['option_name'][$language['language_id']] = '';
				}
			}

			if (isset($this->request->post['option_keyword'])) {
				$data['option_keyword'] = $this->request->post['option_keyword'];
			} else {
				foreach ($data['languages'] as $language) {
					$data['option_keyword'][$language['language_id']] = '';
				}
			}

			if (isset($this->request->post['option_categories'])) {
				$data['option_categories'] = $this->request->post['option_categories'];
			} else {
				$data['option_categories'] = array();
			}

			$data['option_values'] = isset($this->request->post['option_values']) ? $this->request->post['option_values'] : array();
		}

		$data['option_types'] = array(
			'grid' => $this->language->get('param_type_grid'),
			'checkbox' => $this->language->get('param_type_checkbox'),
			'radio' => $this->language->get('param_type_radio'),
		);

		$data['option_styles'] = array(
			'none' => $this->language->get('param_design_none'),
			'image' => $this->language->get('param_design_image'),
			'color' => $this->language->get('param_design_color'),
		);

		$data['option_position'] = array(
			'txt-bottom' => $this->language->get('param_position_bottom'),
			'txt-top' => $this->language->get('param_position_top'),
			'txt-right' => $this->language->get('param_position_right'),
			'txt-left' => $this->language->get('param_position_left'),
		);

		$data['language_id'] = $this->config->get('config_language_id');

		$filter_data = array(
			'sort' => 'name',
			'order' => 'ASC'
		);

		$data['categories'] = $this->model_catalog_category->getCategories($filter_data);
		$data['placeholder'] = $this->model_tool_image->resize('no_image.png', 100, 100);

		$data['params'] = $data;

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('catalog/' . $this->_moduleSysName . '_form.tpl', $data));
	}

	protected function validateForm()
	{
		if (!$this->user->hasPermission('modify', 'catalog/' . $this->_moduleSysName)) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		foreach ($this->request->post['option_name'] as $name) {
			if ((utf8_strlen($name) < 3) || (utf8_strlen($name) > 64)) {
				$this->error['warning'] = $this->language->get('error_option_name');
			}
		}

		if (isset($this->request->post['option_values'])) {
			foreach ($this->request->post['option_values'] as $key => $option_value) {
				foreach ($option_value['name'] as $language_id => $name) {
					if ($name)
						continue;
					$this->error['warning_option_value_name'][$key][$language_id] = $this->language->get('error_option_value_name');
				}
				if (!isset($option_value['keyword']) || !$option_value['keyword']) {
					$this->error['warning_option_value_keyword'][$key] = $this->language->get('error_option_value_keyword');
				}
			}
		}

		if ($this->request->post['option_keyword']) {
			foreach ($this->request->post['option_keyword'] as $id => $option_keyword)
				if ($option_id = $this->model_catalog_neoseo_filter->getOptionByKeyword($option_keyword)) {
					if ((isset($this->request->get['option_id']) && $option_id != $this->request->get['option_id']) || !isset($this->request->get['option_id'])) {
						$this->error['warning'] = $this->language->get('error_isset_keyword');
                        $this->request->post['option_keyword'][$id] = $option_keyword . '_' . rand(1, 100);
					}
				}
		}


		return !$this->error;
	}

	protected function validateDeleteOptions()
	{
		if (!$this->user->hasPermission('modify', 'catalog/' . $this->_moduleSysName)) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		$this->load->model('catalog/' . $this->_moduleSysName);

		foreach ($this->request->post['selected'] as $option_id) {
			$product_total = $this->model_catalog_neoseo_filter->getTotalProductsByOptionId($option_id);

			if ($product_total) {
				$this->error['warning'] = sprintf($this->language->get('error_product'), $product_total);
			}
		}

		return !$this->error;
	}

	protected function validateDeleteOption()
	{

		if (!$this->user->hasPermission('modify', 'catalog/' . $this->_moduleSysName)) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		$this->load->model('catalog/' . $this->_moduleSysName);
		$product_total = $this->model_catalog_neoseo_filter->getTotalProductsByOptionId($this->request->get['option_id']);

		if ($product_total) {
			$this->error['warning'] = sprintf($this->language->get('error_product'), $product_total);
		}

		return !$this->error;
	}

	public function autocomplete()
	{
		$json = array();

		if (isset($this->request->get['filter_option_name']) || isset($this->request->get['filter_option_keyword'])) {
			$this->load->model('catalog/' . $this->_moduleSysName);

			if (isset($this->request->get['filter_option_name'])) {
				$filter_option_name = $this->request->get['filter_option_name'];
			} else {
				$filter_option_name = '';
			}

			if (isset($this->request->get['filter_option_keyword'])) {
				$filter_option_keyword = $this->request->get['filter_option_keyword'];
			} else {
				$filter_option_keyword = '';
			}

			$filter_data = array(
				'filter_name' => $filter_option_name,
				'filter_keyword' => $filter_option_keyword,
				'start' => 0,
				'limit' => 10
			);

			$options = $this->model_catalog_neoseo_filter->getFilterOptions($filter_data);

			foreach ($options as $option) {
				$json[] = array(
					'option_id' => $option['option_id'],
					'keyword' => strip_tags(html_entity_decode($option['keyword'], ENT_QUOTES, 'UTF-8')),
					'name' => strip_tags(html_entity_decode($option['name'], ENT_QUOTES, 'UTF-8'))
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

			$this->load->model('catalog/' . $this->_moduleSysName);
			$json['keyword'] = $this->model_catalog_neoseo_filter->translate($this->request->get['keyword']);
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function category_options()
	{

		$data = array();
		if (isset($this->request->get['category_id'])) {
			$category_id = (int) $this->request->get['category_id'];
			$selected_options_raw = $this->request->get['options'];

			$this->load->model('catalog/neoseo_filter');
			$filter_data = array(
				'filter_status' => 1,
				'filter_category' => $category_id,
			);

			$options = $this->model_catalog_neoseo_filter->getFilterOptions($filter_data);
			$selected_options = $this->model_catalog_neoseo_filter->explodeFilterParam($selected_options_raw);
			$data['options'] = array();
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
		}


		$this->response->setOutput($this->load->view('catalog/neoseo_filter_options.tpl', $data));
	}

	public function product_options()
	{

		$data = array();
		if (isset($this->request->get['category_id'])) {
			$category_id = (int) $this->request->get['category_id'];
			$selected_options_raw = $this->request->get['options'];

			$this->load->model('catalog/neoseo_filter');
			$filter_data = array(
				'filter_status' => 1,
				'filter_category' => $category_id,
			);

			$options = $this->model_catalog_neoseo_filter->getFilterOptions($filter_data);
			$selected_options = $this->model_catalog_neoseo_filter->explodeFilterParam($selected_options_raw);
			$data['options'] = array();
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
		}


		$this->response->setOutput($this->load->view('catalog/neoseo_filter_product_options.tpl', $data));
	}

}
