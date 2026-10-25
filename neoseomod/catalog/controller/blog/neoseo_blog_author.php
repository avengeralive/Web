<?php
require_once(DIR_SYSTEM.'/engine/neoseo_controller.php');

class ControllerBlogNeoSeoBlogAuthor extends NeoSeoController {
	public function __construct($registry) {
		parent::__construct($registry);
		$this->_moduleSysName = 'neoseo_blog';
		$this->_logFile = $this->_moduleSysName . '.log';
		$this->debug = $this->config->get($this->_moduleSysName . '_status') == 1;
	}

	public function index() {
		$data = $this->language->load('blog/neoseo_blog_author');

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

		// jsSocials
		$this->document->addStyle('catalog/view/theme/'.$this->config->get('config_template').'/stylesheet/jssocials.css');
		$this->document->addScript('catalog/view/theme/'.$this->config->get('config_template').'/javascript/jssocials.js');
		// ---------

		// Readmore.js
		$this->document->addScript('catalog/view/theme/'.$this->config->get('config_template').'/javascript/readmore.js');
		// -----------

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

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);


		if (isset($this->request->get['author_id'])) {
			$author_id = $this->request->get['author_id'];
		} else {
			$author_id = 0;
		}

		$author_info = $this->model_blog_neoseo_blog_author->getAuthor($author_id);

		if ($author_info) {
			$data['breadcrumbs'][] = array(
				'text' => $author_info['name'],
				'href' => $this->url->link('blog/neoseo_blog_author', 'author_id=' . $author_id, 'SSL'),
			);

			if ($author_info['meta_title']) {
				$this->document->setTitle($author_info['meta_title']);
			} else {
				$this->document->setTitle($author_info['name']);
			}

			$this->document->setDescription($author_info['meta_description']);
			$this->document->setKeywords($author_info['meta_keyword']);

			$data['heading_title'] = $author_info['name'];

			$width = $this->config->get('neoseo_blog_image_author_block_width');
			$height = $this->config->get('neoseo_blog_image_author_block_height');

			if ($author_info['image']) {
				$data['thumb'] = $this->model_tool_image->resize($author_info['image'], $width, $height);
			} else {
				$data['thumb'] = '';
			}

			$data['description'] = html_entity_decode($author_info['description'], ENT_QUOTES, 'UTF-8');

			$url = '';

			if (isset($this->request->get['author_id'])) {
				$url .= '&author_id=' . $this->request->get['author_id'];
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

			$data['articles'] = array();

			$filter_data = array(
				'filter_author_id' => $author_id,
				'sort' => $sort,
				'order' => $order,
				'start' => ($page - 1) * $limit,
				'limit' => $limit
			);
			$data['desc_position'] = $this->config->get('neoseo_unistor_cat_desc_position');
			$article_total = $this->model_blog_neoseo_blog_article->getTotalArticles($filter_data);

			$results = $this->model_blog_neoseo_blog_article->getArticles($filter_data);

			foreach ($results as $result) {
				$width = $this->config->get('neoseo_blog_image_article_list_width');
				$height = $this->config->get('neoseo_blog_image_article_list_height');

				if ($result['image']) {
					$image = $this->model_tool_image->resize($result['image'], $width, $height);
				} else {
					$image = $this->model_tool_image->resize('placeholder.png', $width, $height);
				}

				if (!empty($result['teaser'])) {
					$description = strip_tags(html_entity_decode($result['teaser']));
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
					'rating' => $rating,
					'name' => $result['name'],
					'description' => $description,
					'date_modified' => $result['date_modified'],
					'viewed' => $viewed,
					'total_comments' => $total_comments,
					'category' => $category,
					'author' => $author,
					'href' => $this->url->link('blog/neoseo_blog_article', $url . '&article_id=' . $result['article_id'])
				);
			}

			$url = '';

			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}

			$data['sorts'] = array();

			$data['sorts'][] = array(
				'text' => $this->language->get('text_date_modified_desc'),
				'value' => 'ba.date_modified-DESC',
				'href' => $this->url->link('blog/neoseo_blog_author', $url . '&author_id=' . $author_id . '&sort=ba.date_modified&order=DESC')
			);

			$data['sorts'][] = array(
				'text' => $this->language->get('text_name_asc'),
				'value' => 'bad.name-ASC',
				'href' => $this->url->link('blog/neoseo_blog_author', $url . '&author_id=' . $author_id . '&sort=bad.name&order=ASC')
			);

			$data['sorts'][] = array(
				'text' => $this->language->get('text_name_desc'),
				'value' => 'bad.name-DESC',
				'href' => $this->url->link('blog/neoseo_blog_author', $url . '&author_id=' . $author_id . '&sort=bad.name&order=DESC')
			);

			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			$data['limits'] = array();

			$limits = array(10, 25, 50);

			foreach ($limits as $value) {
				$data['limits'][] = array(
					'text' => $value,
					'value' => $value,
					'href' => $this->url->link('blog/neoseo_blog_author', $url . '&author_id=' . $author_id . '&limit=' . $value)
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
			$pagination->url = $this->url->link('blog/neoseo_blog_author', $url . '&author_id=' . $author_id . '&page={page}');

			$data['pagination'] = $pagination->render();

			$data['results'] = sprintf($this->language->get('text_pagination'), ($article_total) ? (($page - 1) * $limit) + 1 : 0, ((($page - 1) * $limit) > ($article_total - $limit)) ? $article_total : ((($page - 1) * $limit) + $limit), $article_total, ceil($article_total / $limit));

			// http://googlewebmastercentral.blogspot.com/2011/09/pagination-with-relnext-and-relprev.html
			if ($page == 1) {
				$this->document->addLink($this->url->link('blog/neoseo_blog_author', 'author_id=' . $author_id, 'SSL'), 'canonical');
			} elseif ($page == 2) {
				$this->document->addLink($this->url->link('blog/neoseo_blog_author', 'author_id=' . $author_id, 'SSL'), 'prev');
			} else {
				$this->document->addLink($this->url->link('blog/neoseo_blog_author', 'author_id=' . $author_id . '&page=' . ($page - 1), 'SSL'), 'prev');
			}

			if ($limit && ceil($article_total / $limit) > $page) {
				$this->document->addLink($this->url->link('blog/neoseo_blog_author', 'author_id=' . $author_id . '&page=' . ($page + 1), 'SSL'), 'next');
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
			
			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/blog/neoseo_blog_author.tpl')) {
				$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/blog/neoseo_blog_author.tpl', $data));
			} else {
				$this->response->setOutput($this->load->view('default/template/blog/neoseo_blog_author.tpl', $data));
			}
		} else {
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

			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}

			$text_error = $this->language->get('text_author_error');

			$this->document->setTitle($text_error);

			$data['heading_title'] = $text_error;

			$data['text_error'] = $text_error;

			$data['button_continue'] = $this->language->get('button_continue');
			$data['text_author'] = $this->language->get('text_author');

			$data['continue'] = $this->url->link('common/home');

			$this->response->addHeader($this->request->server['SERVER_PROTOCOL'] . ' 404 Not Found');

			$data['column_left'] = $this->load->controller('common/column_left');
			$data['column_right'] = $this->load->controller('common/column_right');
			$data['content_top'] = $this->load->controller('common/content_top');
			$data['content_bottom'] = $this->load->controller('common/content_bottom');
			$data['footer'] = $this->load->controller('common/footer');
			$data['header'] = $this->load->controller('common/header');

			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/error/not_found.tpl')) {
				$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/error/not_found.tpl', $data));
			} else {
				$this->response->setOutput($this->load->view('default/template/error/not_found.tpl', $data));
			}
		}
	}

}
