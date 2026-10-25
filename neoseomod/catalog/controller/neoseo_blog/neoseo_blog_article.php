<?php

class ControllerNeoseoBlogNeoseoBlogArticle extends Controller
{

	private $error = array();

	public function index()
	{
		$data = $this->load->language('neoseo_blog/neoseo_blog_article');

		$this->load->model('neoseo_blog/neoseo_blog_article');
		$this->load->model('neoseo_blog/neoseo_blog_author');
		$this->load->model('neoseo_blog/neoseo_blog_category');
		$this->load->model('neoseo_blog/neoseo_blog_comment');

		$this->load->model('tool/image');

		if (!file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/stylesheet/neoseo_blog.scss')) {
			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/stylesheet/soforp_blog.css')) {
				$this->document->addStyle('catalog/view/theme/' . $this->config->get('config_template') . '/stylesheet/soforp_blog.css');
			} else {
				$this->document->addStyle('catalog/view/theme/default/stylesheet/soforp_blog.css');
			}
		}

		$config_language = $this->config->get('blog_language');
		if (!empty($config_language[$this->config->get('config_language_id')])) {
			$config_language = $config_language[$this->config->get('config_language_id')];
		} else {
			$config_language = array();
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);


		if (isset($this->request->get['article_id'])) {
			$article_id = (int) $this->request->get['article_id'];
		} else {
			$article_id = 0;
		}

		$url = '';

		if (isset($this->request->get['blog_search'])) {
			$url .= '&blog_search=' . $this->request->get['blog_search'];
		}

		if (isset($this->request->get['blog_category_id'])) {
			$url .= '&blog_category_id=' . $this->request->get['blog_category_id'];
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

		if (isset($this->request->get['limit'])) {
			$url .= '&limit=' . $this->request->get['limit'];
		}
		$data['text_author'] = $this->language->get('text_author');
		$article_info = $this->model_neoseo_blog_neoseo_blog_article->getArticle($article_id);

		if ($article_info) {


			if ($article_info['meta_title']) {
				$this->document->setTitle($article_info['meta_title']);
			} else {
				$this->document->setTitle($article_info['name']);
			}

			$this->document->setDescription($article_info['meta_description']);
			$this->document->setKeywords($article_info['meta_keyword']);

			$this->document->addScript('catalog/view/javascript/jquery/magnific/jquery.magnific-popup.min.js');
			$this->document->addStyle('catalog/view/javascript/jquery/magnific/magnific-popup.css');

			$data['heading_title'] = $article_info['name'];

			$data['article_id'] = (int) $article_id;

			$data['description'] = html_entity_decode($article_info['description'], ENT_QUOTES, 'UTF-8');
			$data['date_modified'] = $article_info['date_modified'];
			$data['href'] = $this->url->link('neoseo_blog/neoseo_blog_article', $url . '&article_id=' . $article_id);

			$width = $this->config->get('soforp_blog_image_article_block_width');
			$height = $this->config->get('soforp_blog_image_article_block_height');

			if ($article_info['image']) {
				$data['thumb'] = $this->model_tool_image->resize($article_info['image'], $width, $height);
				$data['image'] = HTTP_SERVER . 'image/' . $article_info['image'];
			} else {
				$data['thumb'] = '';
				$data['image'] = '';
			}

			if (!empty($config_language['gallery_heading'])) {
				$data['gallery_heading'] = $config_language['gallery_heading'];
			}


			if ($article_info['total_comments'] == 1) {
				$data['total_comments'] = $article_info['total_comments'] . $this->language->get('text_comment');
			} elseif ($article_info['total_comments'] > 1) {
				$data['total_comments'] = $article_info['total_comments'] . $this->language->get('text_comments');
			} else {
				$data['total_comments'] = '';
			}

			$data['category'] = $this->model_neoseo_blog_neoseo_blog_article->getMainCategory($article_info['article_id']);
			if ($data['category']) {

				$parentIds = $this->model_neoseo_blog_neoseo_blog_category->getParentIds($data['category']['category_id']);
				foreach ($parentIds as $parent_id) {
					$parent = $this->model_neoseo_blog_neoseo_blog_category->getCategory($parent_id);
					$data['breadcrumbs'][] = array(
						'text' => $parent['name'],
						'href' => $this->url->link('neoseo_blog/neoseo_blog_category', $url . '&blog_category_id=' . $parent['category_id'])
					);
				}
				$data['breadcrumbs'][] = array(
					'text' => $data['category']['name'],
					'href' => $this->url->link('neoseo_blog/neoseo_blog_category', $url . '&blog_category_id=' . $data['category']['category_id'])
				);

				$data['category']['href'] = $this->url->link('neoseo_blog/neoseo_blog_category', $url . '&blog_category_id=' . $data['category']['category_id'], 'SSL');
			}

			if (isset($data['category']['category_id'])) {
				$category_info = $this->model_neoseo_blog_neoseo_blog_category->getCategory($data['category']['category_id']);
				$filter_data = array(
					'filter_category_id' => $data['category']['category_id'],
					'limit' => 30,
					'start' => 0,
				);
				$category_articles = $this->model_neoseo_blog_neoseo_blog_article->getArticles($filter_data);

				foreach ($category_articles as $article) {
					$data['category_articles'][] = array(
						'name' => $article['name'],
						'href' => $this->url->link('neoseo_blog/neoseo_blog_article', 'article_id=' . $article['article_id'])
					);
				}

				$data['more_category_articles'] = $this->url->link('neoseo_blog/neoseo_blog_category', $url . '&blog_category_id=' . $data['category']['category_id']);
			} else {
				$data['more_category_articles'] = '';
				$data['category_articles'] = array();
			}

			$data['breadcrumbs'][] = array(
				'text' => $article_info['name'],
				'href' => $this->url->link('neoseo_blog/neoseo_blog_article', 'article_id=' . $article_id, 'SSL'),
			);

			$data['author'] = array(
				'author_id' => $article_info['author_id'],
				'name' => $article_info['author_name'],
				'href' => $this->url->link('neoseo_blog/neoseo_blog_author', 'author_id=' . $article_info['author_id'], 'SSL'),
			);

			$viewed = $article_info['viewed'] ? $article_info['viewed'] : 0;

			$data['viewed'] = sprintf($this->language->get('text_viewed'), $viewed);

			$data['related_products_heading_title'] = $this->config->get('related_products_heading_title');

			if ($this->config->get('soforp_blog_image_product_block_width')) {
				$related_product_image_width = $this->config->get('soforp_blog_image_product_block_width');
			} else {
				$related_product_image_width = 200;
			}

			if ($this->config->get('soforp_blog_image_product_block_height')) {
				$related_product_image_height = $this->config->get('soforp_blog_image_product_block_height');
			} else {
				$related_product_image_height = 200;
			}

			$data['related_products'] = array();

			/* $results = $this->model_neoseo_blog_neoseo_blog_article->getRelatedProducts($article_id);

			  foreach ($results as $result) {

			  $this->load->model('catalog/product');

			  $product_info = $this->model_catalog_product->getProduct($result['product_id']);

			  $product_images = $this->model_catalog_product->getProductImages($result['product_id']);
			  if (isset($product_images[0]) and isset($product_images[0]['image'])) {
			  $product_image = $this->model_tool_image->resize($product_images[0]['image'], $this->config->get('config_image_product_width'), $this->config->get('config_image_product_height'));
			  } else {
			  $product_image = false;
			  }

			  if ($product_info['image']) {
			  $image = $this->model_tool_image->resize($product_info['image'], $this->config->get('config_image_product_width'), $this->config->get('config_image_product_height'));
			  } else {
			  $image = $this->model_tool_image->resize('placeholder.png', $this->config->get('config_image_product_width'), $this->config->get('config_image_product_height'));
			  }

			  if (!$this->config->get('config_customer_price') && !$this->customer->isLogged()) {
			  $price = $this->currency->format($this->tax->calculate($product_info['price'], $product_info['tax_class_id'], $this->config->get('config_tax')));
			  $price_argo = $this->currency->format($this->tax->calculate($product_info['price'] - ($product_info['price'] / 100 * 20), $product_info['tax_class_id'], $this->config->get('config_tax')));
			  } elseif ($this->customer->isLogged()) {
			  $price = $this->currency->format($this->tax->calculate($product_info['price'] - ($product_info['price'] / 100 * 20), $product_info['tax_class_id'], $this->config->get('config_tax')));
			  $price_argo = false;
			  } else {
			  $price = false;
			  $price_argo = false;
			  }

			  if ((float) $product_info['special']) {
			  $special = $this->currency->format($this->tax->calculate($product_info['special'], $product_info['tax_class_id'], $this->config->get('config_tax')));
			  $price_argo = $this->currency->format($this->tax->calculate($product_info['special'] - ($product_info['special'] / 100 * 20), $product_info['tax_class_id'], $this->config->get('config_tax')));
			  } else {
			  $special = false;
			  }

			  if ($this->customer->isLogged()) {
			  $reward = $product_info['reward'];
			  $points = $product_info['points'];
			  } else {
			  $reward = false;
			  $points = false;
			  }

			  if ($this->config->get('config_tax')) {
			  $tax = $this->currency->format((float) $product_info['special'] ? $product_info['special'] : $product_info['price']);
			  } else {
			  $tax = false;
			  }

			  if ($this->config->get('config_review_status')) {
			  $rating = (int) $product_info['rating'];
			  } else {
			  $rating = false;
			  }

			  $data['related_products'][] = array(
			  'product_id' => $product_info['product_id'],
			  'thumb' => $image,
			  'thumb1' => $product_image,
			  'name' => $product_info['name'],
			  'description' => utf8_substr(strip_tags(html_entity_decode($product_info['description'], ENT_QUOTES, 'UTF-8')), 0, $this->config->get('config_product_description_length')) . '..',
			  'price' => $price,
			  'price_argo' => $price_argo,
			  'special' => $special,
			  'reward' => $reward,
			  'points' => $points,
			  'tax' => $tax,
			  'minimum' => $product_info['minimum'] > 0 ? $product_info['minimum'] : 1,
			  'rating' => $product_info['rating'],
			  'stock_status_id' => ( $product_info['quantity'] > 0 ? 0 : $product_info['stock_status_id'] ),
			  'stock_status' => $product_info['stock_status'],
			  'href' => $this->url->link('product/product', '&product_id=' . $product_info['product_id'] . $url)
			  );
			  } */

			if ($this->config->get('soforp_blog_image_article_block_width')) {
				$related_article_image_width = $this->config->get('soforp_blog_image_article_block_width');
			} else {
				$related_article_image_width = 200;
			}

			if ($this->config->get('soforp_blog_image_article_block_height')) {
				$related_article_image_height = $this->config->get('soforp_blog_image_article_block_height');
			} else {
				$related_article_image_height = 200;
			}
			$data['related_articles_heading_title'] = $this->config->get('related_articles_heading_title');

			$results = $this->model_neoseo_blog_neoseo_blog_article->getRelatedArticles($article_id);
			$data['related_articles'] = array();
			foreach ($results as $result) {

				if ($result['image']) {
					$image = $this->model_tool_image->resize($result['image'], $related_article_image_width, $related_article_image_height);
				} else {
					$image = false;
				}
				$rating = $this->model_neoseo_blog_neoseo_blog_article->getRating($result['article_id']);
				if (!empty($result['teaser'])) {
					$description = strip_tags(html_entity_decode($result['teaser']));
				} else {
					$description = strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8'));
					if (strlen($description) > 300) {
						$description = utf8_substr($description, 0, 300) . '..';
					}
				}

				if ($result['total_comments'] == 1) {
					$total_comments = $result['total_comments'] . $this->language->get('text_comment');
				} elseif ($result['total_comments'] > 1) {
					$total_comments = $result['total_comments'] . $this->language->get('text_comments');
				} else {
					$total_comments = '';
				}

				$category = $this->model_neoseo_blog_neoseo_blog_article->getMainCategory($result['article_id']);
				if ($category) {
					$category['href'] = $this->url->link('neoseo_blog/neoseo_blog_category', 'blog_category_id=' . $category['category_id'], 'SSL');
				}

				$author = array(
					'author_id' => $result['author_id'],
					'name' => $result['author_name'],
					'href' => $this->url->link('neoseo_blog/neoseo_blog_author', 'author_id=' . $result['author_id'], 'SSL'),
				);

				$viewed = $result['viewed'] ? $result['viewed'] : 0;

				$data['related_articles'][] = array(
					'article_id' => $result['article_id'],
					'thumb' => $image,
					'name' => $result['name'],
					'rating' => $rating,
					'description' => $description,
					'date_modified' => $result['date_modified'],
					'viewed' => sprintf($this->language->get('text_viewed'), $viewed),
					'total_comments' => $total_comments,
					'category' => $category,
					'author' => $author,
					'href' => $this->url->link('neoseo_blog/neoseo_blog_article', $url . '&article_id=' . $result['article_id'])
				);
			}


			if ($article_info['allow_comment']) {
				$data['comments_block'] = $this->getCommentsBlock($article_id);
			}

			$data['href_login'] = $this->url->link('account/login');

			$this->model_neoseo_blog_neoseo_blog_article->updateViewed($article_id);

			$data['column_left'] = $this->load->controller('common/column_left');
			$data['column_right'] = $this->load->controller('common/column_right');
			$data['content_top'] = $this->load->controller('common/content_top');
			$data['content_bottom'] = $this->load->controller('common/content_bottom');
			$data['footer'] = $this->load->controller('common/footer');
			$data['header'] = $this->load->controller('common/header');

			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/neoseo_blog/neoseo_blog_article_info.tpl')) {
				$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/neoseo_blog/neoseo_blog_article_info.tpl', $data));
			} else {
				$this->response->setOutput($this->load->view('default/template/neoseo_blog/neoseo_blog_article_info.tpl', $data));
			}
		} else {
			$url = '';

			if (isset($this->request->get['author_id'])) {
				$url .= '&author_id=' . $this->request->get['author_id'];
			}

			if (isset($this->request->get['blog_search'])) {
				$url .= '&blog_search=' . $this->request->get['blog_search'];
			}

			if (isset($this->request->get['blog_category_id'])) {
				$url .= '&blog_category_id=' . $this->request->get['blog_category_id'];
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

			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}

			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('text_error'),
				'href' => $this->url->link('neoseo_blog/neoseo_blog_article', $url . '&article_id=' . $article_id)
			);

			$text_error = $this->language->get('text_article_error');

			$this->document->setTitle($text_error);

			$data['heading_title'] = $text_error;

			$data['text_error'] = $text_error;

			$data['button_continue'] = $this->language->get('button_continue');

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

	public function getCommentsBlock($article_id)
	{

		$data = $this->language->load('neoseo_blog/neoseo_blog_comment');

		$data['article_id'] = $article_id;
		$data['reviews'] = $this->load->controller('neoseo_blog/neoseo_blog_comment');

		$config_language = $this->config->get('blog_language');
		if (!empty($config_language[$this->config->get('config_language_id')]['comments_block_heading'])) {
			$data['heading_title'] = $config_language[$this->config->get('config_language_id')]['comments_block_heading'];
		}

		// Captcha
		if ($this->config->get($this->config->get('config_captcha') . '_status')) {
			$data['captcha'] = $this->load->controller('captcha/' . $this->config->get('config_captcha'), $this->error);
		} else {
			$data['captcha'] = '';
		}

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/neoseo_blog/neoseo_blog_comment_form.tpl')) {
			return $this->load->view($this->config->get('config_template') . '/template/neoseo_blog/neoseo_blog_comment_form.tpl', $data);
		} else {
			return $this->load->view('default/template/neoseo_blog/neoseo_blog_comment_form.tpl', $data);
		}
	}

}
