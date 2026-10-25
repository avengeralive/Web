<?php
require_once(DIR_SYSTEM.'/engine/neoseo_controller.php');

class ControllerModuleNeoSeoBlogComment extends NeoSeoController
{
	public function __construct($registry) {
		parent::__construct($registry);
		$this->_moduleSysName = 'neoseo_blog';
		$this->_logFile = $this->_moduleSysName . '.log';
		$this->debug = $this->config->get($this->_moduleSysName . '_status') == 1;
	}

	public function index($setting)
	{

		$data = $this->language->load('module/neoseo_blog_comment');

		$this->load->model('blog/neoseo_blog_article');
		$this->load->model('blog/neoseo_blog_comment');
		$this->load->model('blog/neoseo_blog_category');

		$data['articles'] = array();

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
		if (!file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/stylesheet/neoseo_blog.scss')) {
			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/stylesheet/neoseo_blog.css')) {
				$this->document->addStyle('catalog/view/theme/' . $this->config->get('config_template') . '/stylesheet/neoseo_blog.css');
			} else {
				$this->document->addStyle('catalog/view/theme/default/stylesheet/neoseo_blog.css');
			}
		}

		if (empty($setting['limit'])) {
			$setting['limit'] = 4;
		}

		if (!empty($setting['title'][$this->config->get('config_language_id')])) {
			$data['heading_title'] = $setting['title'][$this->config->get('config_language_id')];
		} else {
			$data['heading_title'] = '';
		}

		$filter_data = array(
			'start' => 0,
			'limit' => $setting['limit']
		);
		if (isset($setting['blog_category_id'])) {
			$filter_data['filter_category_id'] = $setting['blog_category_id'];
		}


		if (!empty($setting['type'])) {
			if ($setting['type'] == 'popular') {
				$filter_data['sort'] = 'ba.date_added'; // todo: тут какой-то рейтинг надо
				$filter_data['order'] = 'DESC';
			}
			if ($setting['type'] == 'latest') {
				$filter_data['sort'] = 'ba.date_added';
				$filter_data['order'] = 'DESC';
			}
		}

		$results = $this->model_blog_neoseo_blog_comment->getComments($filter_data);

		foreach ($results as $result) {

			$article = $this->model_blog_neoseo_blog_article->getArticle($result['article_id']);
			if (!$article)
				continue;


			$description = strip_tags(html_entity_decode($result['comment'], ENT_QUOTES, 'UTF-8'));
			if (strlen($description) > 60) {
				$description = utf8_substr($description, 0, 60) . '..';
			}

			$data['comments'][] = array(
				'comment_id' => $result['comment_id'],
				'thumb' => $image,
				'description' => $description,
				'date_modified' => $result['date_modified'],
				'href' => $this->url->link('blog/neoseo_blog_article', 'article_id=' . $result['article_id'])
			);
		}

		if (empty($data['comments']))
			return '';

		$template = $setting['template'];
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/' . $template)) {
			return $this->load->view($this->config->get('config_template') . '/template/module/' . $template, $data);
		} else {
			return $this->load->view('default/template/module/' . $template, $data);
		}
	}

}
