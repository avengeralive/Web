<?php
require_once(DIR_SYSTEM.'/engine/neoseo_controller.php');

class ControllerBlogNeoSeoBlogSearch extends NeoSeoController {
	public function __construct($registry) {
		parent::__construct($registry);
		$this->_moduleSysName = 'neoseo_blog';
		$this->_logFile = $this->_moduleSysName . '.log';
		$this->debug = $this->config->get($this->_moduleSysName . '_status') == 1;
	}

	public function index() {
		$data = $this->language->load('blog/neoseo_blog_search');

		$this->load->model('blog/neoseo_blog_article');
		$this->load->model('blog/neoseo_blog_author');
		$this->load->model('blog/neoseo_blog_category');
		$this->load->model('blog/neoseo_blog_comment');

		$this->load->model('tool/image');
		if (!file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/stylesheet/neoseo_blog.scss')) {
			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/stylesheet/neoseo_blog.css')) {
				$this->document->addStyle('catalog/view/theme/' . $this->config->get('config_template') . '/stylesheet/neoseo_blog.css');
			} else {
				$this->document->addStyle('catalog/view/theme/default/stylesheet/neoseo_blog.css');
			}
		}


		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'ba.date_modified';
		}

		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'DESC';
		}

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		if (isset($this->request->get['limit'])) {
			$limit = (int) $this->request->get['limit'];
		} else {
			$limit = $this->config->get('blog_product_limit');
		}
		if (!$limit) {
			$limit = 15;
		}

		if (isset($this->request->get['blog_search'])) {
			$blog_search = $this->request->get['blog_search'];
		} else {
			$blog_search = '';
		}

		if (isset($this->request->get['blog_category_id'])) {
			$category_id = $this->request->get['blog_category_id'];
		} else {
			$category_id = 0;
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('blog/neoseo_blog_search')
		);


		if ($blog_search) {
			$this->document->setTitle($this->language->get('heading_title') . ' - ' . $blog_search);
			$data['heading_title'] = $this->language->get('heading_title') . ' - ' . $blog_search;
		} else {
			$this->document->setTitle($this->language->get('heading_title'));
			$data['heading_title'] = $this->language->get('heading_title');
		}

		$url = '';

		if (isset($this->request->get['blog_search'])) {
			$url .= '&blog_search=' . $this->request->get['blog_search'];
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		if (isset($this->request->get['limit'])) {
			$url .= '&limit=' . $this->request->get['limit'];
		}

		if (isset($this->request->get['blog_category_id'])) {
			$url .= '&blog_category_id=' . $this->request->get['blog_category_id'];
		}

		$data['categories'] = array();

		$categories_1 = $this->model_blog_neoseo_blog_category->getCategories(0);

		foreach ($categories_1 as $category_1) {
			$level_2_data = array();

			$categories_2 = $this->model_blog_neoseo_blog_category->getCategories($category_1['category_id']);

			foreach ($categories_2 as $category_2) {
				$level_3_data = array();

				$categories_3 = $this->model_blog_neoseo_blog_category->getCategories($category_2['category_id']);

				foreach ($categories_3 as $category_3) {
					$level_3_data[] = array(
						'category_id' => $category_3['category_id'],
						'name' => $category_3['name'],
					);
				}

				$level_2_data[] = array(
					'category_id' => $category_2['category_id'],
					'name' => $category_2['name'],
					'children' => $level_3_data
				);
			}

			$data['categories'][] = array(
				'category_id' => $category_1['category_id'],
				'name' => $category_1['name'],
				'children' => $level_2_data
			);
		}

		$data['articles'] = array();

		$filter_data = array(
			'filter_name' => $blog_search,
			'filter_category_id' => $category_id,
			'sort' => $sort,
			'order' => $order,
			'start' => ($page - 1) * $limit,
			'limit' => $limit
		);

		$article_total = $this->model_blog_neoseo_blog_article->getTotalArticles($filter_data);


		$data['form_data'] = array(
			'blog_search' => $blog_search,
			'article_total' => $article_total,
			'category_id' => $category_id
		);

		$results = $this->model_blog_neoseo_blog_article->getArticles($filter_data);

		foreach ($results as $result) {
			$width = $this->config->get('neoseo_blog_image_article_list_width');
			$height = $this->config->get('neoseo_blog_image_article_list_height');

			if ($result['image']) {
				$image = $this->model_tool_image->resize($result['image'], $width, $height);
			} else {
				$image = false;
			}

			if (!empty($result['teaser'])) {
				$description = html_entity_decode($result['teaser']);
			} else {
				$description = strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8'));
				if (strlen($description) > 300) {
					$description = utf8_substr($description, 0, 300) . '..';
				}
			}

			// if ($result['total_comments'] == 1) {
			// 	$total_comments = $result['total_comments'].$this->language->get('text_comment');
			// } elseif ($result['total_comments'] > 1) {
			// 	$total_comments = $result['total_comments'].$this->language->get('text_comments');
			// } else {
			// 	$total_comments = '';
			// }

			if ($result['total_comments'] > 0) {
				$total_comments = $result['total_comments'];
			} else {
				$total_comments = '';
			}

			$category = $this->model_blog_neoseo_blog_article->getMainCategory($result['article_id']);
			if ($category) {
				$category['href'] = $this->url->link('blog/neoseo_blog_category', 'blog_category_id=' . $category['category_id'], 'SSL');
			}

			$author = array(
				'author_id' => $result['author_id'],
				'name' => $result['author_name'],
				'href' => $this->url->link('blog/neoseo_blog_author', 'author_id=' . $result['author_id'], 'SSL'),
			);

			$viewed = $result['viewed'] ? $result['viewed'] : 0;
			$rating = $this->model_blog_neoseo_blog_article->getRating($result['article_id']);

			$data['articles'][] = array(
				'article_id' => $result['article_id'],
				'thumb' => $image,
				'name' => $result['name'],
				'description' => $description,
				'viewed' => $viewed,
				'date_modified' => $result['date_modified'],
				'total_comments' => $total_comments,
				'rating' => $rating,
				'category' => $category,
				'author' => $author,
				'href' => $this->url->link('blog/neoseo_blog_article', '&article_id=' . $result['article_id'])
			);
		}

		$url = '';

		if (isset($this->request->get['blog_search'])) {
			$url .= '&blog_search=' . urlencode(html_entity_decode($this->request->get['blog_search'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['limit'])) {
			$url .= '&limit=' . $this->request->get['limit'];
		}

		if (isset($this->request->get['blog_category_id'])) {
			$url .= '&blog_category_id=' . $this->request->get['blog_category_id'];
		}

		$data['sorts'] = array();

		$data['sorts'][] = array(
			'text' => $this->language->get('text_date_modified_desc'),
			'value' => 'ba.date_modified-DESC',
			'href' => $this->url->link('blog/neoseo_blog_search', $url . '&blog_search=' . $blog_search . '&sort=ba.date_modified&order=DESC')
		);

		$data['sorts'][] = array(
			'text' => $this->language->get('text_name_asc'),
			'value' => 'bad.name-ASC',
			'href' => $this->url->link('blog/neoseo_blog_search', $url . '&blog_search=' . $blog_search . '&sort=bad.name&order=ASC')
		);

		$data['sorts'][] = array(
			'text' => $this->language->get('text_name_desc'),
			'value' => 'bad.name-DESC',
			'href' => $this->url->link('blog/neoseo_blog_search', $url . '&blog_search=' . $blog_search . '&sort=bad.name&order=DESC')
		);

		$url = '';

		if (isset($this->request->get['blog_search'])) {
			$url .= '&blog_search=' . urlencode(html_entity_decode($this->request->get['blog_search'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		if (isset($this->request->get['blog_category_id'])) {
			$url .= '&blog_category_id=' . $this->request->get['blog_category_id'];
		}

		$data['limits'] = array();

		$limits = array(10, 25, 50);

		foreach ($limits as $value) {
			$data['limits'][] = array(
				'text' => $value,
				'value' => $value,
				'href' => $this->url->link('blog/neoseo_blog_search', 'blog_search=' . $blog_search . '&limit=' . $value)
			);
		}

		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		if (isset($this->request->get['limit'])) {
			$url .= '&limit=' . $this->request->get['limit'];
		}

		$pagination = new Pagination();
		$pagination->total = $article_total;
		$pagination->page = $page;
		$pagination->limit = $limit;
		$pagination->url = $this->url->link('blog/neoseo_blog_search', $url . '&blog_search=' . $blog_search . '&page={page}');

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($article_total) ? (($page - 1) * $limit) + 1 : 0, ((($page - 1) * $limit) > ($article_total - $limit)) ? $article_total : ((($page - 1) * $limit) + $limit), $article_total, ceil($article_total / $limit));

		// http://googlewebmastercentral.blogspot.com/2011/09/pagination-with-relnext-and-relprev.html
		if ($page == 1) {
			$this->document->addLink($this->url->link('blog/neoseo_blog_search', 'blog_search=' . $blog_search, 'SSL'), 'canonical');
		} elseif ($page == 2) {
			$this->document->addLink($this->url->link('blog/neoseo_blog_search', 'blog_search=' . $blog_search, 'SSL'), 'prev');
		} else {
			$this->document->addLink($this->url->link('blog/neoseo_blog_search', 'blog_search=' . $blog_search . '&page=' . ($page - 1), 'SSL'), 'prev');
		}

		if ($limit && ceil($article_total / $limit) > $page) {
			$this->document->addLink($this->url->link('blog/neoseo_blog_search', 'blog_search=' . $blog_search . '&page=' . ($page + 1), 'SSL'), 'next');
		}

		$data['sort'] = $sort;
		$data['order'] = $order;
		$data['limit'] = $limit;

		$data['continue'] = $this->url->link('common/home');

		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/blog/neoseo_blog_search.tpl')) {
			$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/blog/neoseo_blog_search.tpl', $data));
		} else {
			$this->response->setOutput($this->load->view('default/template/blog/neoseo_blog_search.tpl', $data));
		}
	}
}