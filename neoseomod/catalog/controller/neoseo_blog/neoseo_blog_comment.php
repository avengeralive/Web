<?php

class ControllerNeoseoBlogNeoseoBlogComment extends Controller
{

	public function index()
	{

		$data = $this->language->load('neoseo_blog/neoseo_blog_comment');

		$this->load->model('neoseo_blog/neoseo_blog_comment');
		if (!file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/stylesheet/neoseo_blog.scss')) {
			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/stylesheet/soforp_blog.css')) {
				$this->document->addStyle('catalog/view/theme/' . $this->config->get('config_template') . '/stylesheet/soforp_blog.css');
			} else {
				$this->document->addStyle('catalog/view/theme/default/stylesheet/soforp_blog.css');
			}
		}

		$limit = $this->config->get('blog_comment_limit');
		if (!$limit)
			$limit = 10;

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		if (isset($this->request->get['article_id'])) {
			$article_id = $this->request->get['article_id'];
		} else {
			$article_id = 0;
		}

		if (isset($this->request->get['comment_id'])) {
			$comment_id = $this->request->get['comment_id'];
		} else {
			$comment_id = 0;
		}

		$data['page'] = $page;

		$data['comments'] = array();

		$filter_data = array(
			'filter_article_id' => $article_id,
			'filter_comment_reply_id' => 0
		);

		$comment_total = $this->model_neoseo_blog_neoseo_blog_comment->getTotalComments($filter_data);

		$filter_data = array(
			'filter_article_id' => $article_id,
			'filter_comment_reply_id' => 0,
			'start' => ($page - 1) * $limit,
			'limit' => $limit
		);

		$results = $this->model_neoseo_blog_neoseo_blog_comment->getComments($filter_data);

		foreach ($results as $result) {

			$comment_replies = array();

			$filter_data = array(
				'filter_article_id' => $result['article_id'],
				'filter_comment_reply_id' => $result['comment_id'],
				'order' => "ASC"
			);

			$reply_results = $this->model_neoseo_blog_neoseo_blog_comment->getComments($filter_data);

			foreach ($reply_results as $comment) {
				$comment_replies[] = $comment;
			}

			$result['comment_reply'] = $comment_replies;

			$data['comments'][] = $result;
		}

		$pagination = new Pagination();
		$pagination->total = $comment_total;
		$pagination->page = $page;
		$pagination->limit = $limit;
		$pagination->text = $this->language->get('text_pagination');
		$pagination->url = $this->url->link('neoseo_blog/neoseo_blog_article', 'article_id=' . $article_id . '&page={page}');

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($comment_total) ? (($page - 1) * $limit) + 1 : 0, ((($page - 1) * $limit) > ($comment_total - $limit)) ? $comment_total : ((($page - 1) * $limit) + $limit), $comment_total, ceil($comment_total / $limit));

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/neoseo_blog/neoseo_blog_comment_list.tpl')) {
			return $this->load->view($this->config->get('config_template') . '/template/neoseo_blog/neoseo_blog_comment_list.tpl', $data);
		} else {
			return $this->load->view('default/template/neoseo_blog/neoseo_blog_comment_list.tpl', $data);
		}
	}

	public function write()
	{

		$this->load->model('neoseo_blog/neoseo_blog_comment');

		$data = $this->language->load('neoseo_blog/neoseo_blog_comment');

		$json = array();

		if ($this->request->server['REQUEST_METHOD'] == 'POST') {

			if ((utf8_strlen($this->request->post['name']) < 3) || (utf8_strlen($this->request->post['name']) > 25)) {
				$json['error'] = $this->language->get('error_name');
			}

			if ((utf8_strlen($this->request->post['text']) < 3)) {
				$json['error'] = $this->language->get('error_text');
			}

			// Captcha
			if ($this->config->get($this->config->get('config_captcha') . '_status') && in_array('review', (array) $this->config->get('config_captcha_page'))) {
				$captcha = $this->load->controller('captcha/' . $this->config->get('config_captcha') . '/validate');

				if ($captcha) {
					$json['error'] = $captcha;
				}
			}

			if (!isset($json['error'])) {

				$post_data = $this->request->post;

				$post_data['status'] = (int) $this->config->get('soforp_blog_comment_auto_approval');

				$this->model_neoseo_blog_neoseo_blog_comment->addComment($this->request->get['article_id'], $post_data);

				if ($this->config->get('soforp_blog_comment_auto_approval')) {
					$json['success'] = $this->language->get('text_success');
				} else {
					$json['success'] = $this->language->get('text_success_approval');
				}
			}
		}

		$this->response->setOutput(json_encode($json));
	}

}
