<?php
require_once(DIR_SYSTEM.'/engine/neoseo_controller.php');

class ControllerModuleNeoSeoBlogCategory extends NeoSeoController
{
	public function __construct($registry) {
		parent::__construct($registry);
		$this->_moduleSysName = 'neoseo_blog';
		$this->_logFile = $this->_moduleSysName . '.log';
		$this->debug = $this->config->get($this->_moduleSysName . '_status') == 1;
	}

	public function index($setting)
	{

		$data = $this->language->load('module/neoseo_blog_category');

		if (isset($setting['title'][$this->config->get('config_language_id')])) {
			$data['title'] = $setting['title'][$this->config->get('config_language_id')];
		} else {
			$data['title'] = '';
		}

		$this->load->model('blog/neoseo_blog_article');
		$this->load->model('blog/neoseo_blog_category');

		$data['blog_category_id'] = '';
		if (isset($this->request->get['blog_category_id'])) {
			$data['blog_category_id'] = $this->request->get['blog_category_id'];
		}

		if ($setting['root_category_id']) {
			$parents = $this->model_blog_neoseo_blog_category->getParentIds($data['blog_category_id']);
			if ($setting['root_category_id'] != $data['blog_category_id'] && !in_array($setting['root_category_id'], $parents)) {
				return '';
			}
		}

		$data['parent_id'] = '';
		$data['child_parent_id'] = '';

		$data['categories'] = array();

		$categories = $this->model_blog_neoseo_blog_category->getCategories($setting['root_category_id']);

		foreach ($categories as $category) {

			$children_data = array();

			$children = $this->model_blog_neoseo_blog_category->getCategories($category['category_id']);

			foreach ($children as $child) {

				if ($child['category_id'] == $data['blog_category_id']) {
					$data['parent_id'] = $child['parent_id'];
				}

				//Третий уровень вложенности
				$third_children_data = array();

				$third_children = $this->model_blog_neoseo_blog_category->getCategories($child['category_id']);
				foreach ($third_children as $third_child) {

					if ($third_child['category_id'] == $data['blog_category_id']) {
						$data['parent_id'] = $child['parent_id'];
						$data['child_parent_id'] = $child['category_id'];
					}

					$third_children_data[] = array(
						'category_id' => $third_child['category_id'],
						'name' => $third_child['name'],
						'href' => $this->url->link('blog/neoseo_blog_category', 'blog_category_id=' . $third_child['category_id'])
					);
				}

				$children_data[] = array(
					'category_id' => $child['category_id'],
					'name' => $child['name'],
					'parent_id' => $child['parent_id'],
					'children' => $third_children_data,
					'href' => $this->url->link('blog/neoseo_blog_category', 'blog_category_id=' . $child['category_id'])
				);
			}

			$data['categories'][] = array(
				'category_id' => $category['category_id'],
				'name' => $category['name'],
				'children' => $children_data,
				'href' => $this->url->link('blog/neoseo_blog_category', 'blog_category_id=' . $category['category_id'])
			);
		}

		if (empty($data['categories']))
			return '';

		$template = $setting['template'];
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/' . $template)) {
			return $this->load->view($this->config->get('config_template') . '/template/module/' . $template, $data);
		} else {
			return $this->load->view('default/template/module/' . $template, $data);
		}
	}

}
