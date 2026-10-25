<?php

class ControllerNeoseoBlogNeoseoBlogComment extends Controller
{

	private $error = array();

	public function index()
	{
		$this->language->load('neoseo_blog/neoseo_blog_comment');

		$this->document->setTitle($this->language->get('heading_title_raw'));

		$this->load->model('neoseo_blog/neoseo_blog_comment');

		$this->getList();
	}

	public function insert()
	{
		$this->language->load('neoseo_blog/neoseo_blog_comment');

		$this->document->setTitle($this->language->get('heading_title_raw'));

		$this->load->model('neoseo_blog/neoseo_blog_comment');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && ($this->validateForm())) {
			$this->model_neoseo_blog_neoseo_blog_comment->addArticleComment($this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			$this->response->redirect($this->url->link('neoseo_blog/neoseo_blog_comment', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}

	public function update()
	{
		$this->language->load('neoseo_blog/neoseo_blog_comment');

		$this->document->setTitle($this->language->get('heading_title_raw'));

		$this->load->model('neoseo_blog/neoseo_blog_comment');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && ($this->validateForm())) {
			$this->model_neoseo_blog_neoseo_blog_comment->editArticleComment($this->request->get['comment_id'], $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			$this->response->redirect($this->url->link('neoseo_blog/neoseo_blog_comment', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}

	public function delete()
	{
		$this->language->load('neoseo_blog/neoseo_blog_comment');

		$this->document->setTitle($this->language->get('heading_title_raw'));

		$this->load->model('neoseo_blog/neoseo_blog_comment');

		if (isset($this->request->post['selected']) && $this->validateDelete()) {

			foreach ($this->request->post['selected'] as $comment_id) {
				$this->model_neoseo_blog_neoseo_blog_comment->deleteArticleComment($comment_id);
			}

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			$this->response->redirect($this->url->link('neoseo_blog/neoseo_blog_comment', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}
		$this->getList();
	}

	public function getList()
	{

		$data = $this->language->load('neoseo_blog/neoseo_blog_comment');

		if (isset($this->request->get['filter_article'])) {
			$filter_article = $this->request->get['filter_article'];
		} else {
			$filter_article = null;
		}

		if (isset($this->request->get['filter_author'])) {
			$filter_author = $this->request->get['filter_author'];
		} else {
			$filter_author = null;
		}

		if (isset($this->request->get['filter_status'])) {
			$filter_status = $this->request->get['filter_status'];
		} else {
			$filter_status = null;
		}

		if (isset($this->request->get['filter_date_added'])) {
			$filter_date_added = $this->request->get['filter_date_added'];
		} else {
			$filter_date_added = null;
		}
		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}
		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'bc.date_added';
		}
		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'DESC';
		}

		if (isset($this->request->post['selected'])) {
			$data['selected'] = (array) $this->request->post['selected'];
		} else {
			$data['selected'] = array();
		}

		$url = '';

		if (isset($this->request->get['filter_article'])) {
			$url .= '&filter_article=' . urlencode(html_entity_decode($this->request->get['filter_article'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_author'])) {
			$url .= '&filter_author=' . urlencode(html_entity_decode($this->request->get['filter_author'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_date_added'])) {
			$url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
		}

		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => false
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title_raw'),
			'href' => $this->url->link('neoseo_blog/neoseo_blog_comment', 'token=' . $this->session->data['token'] . $url, 'SSL'),
			'separator' => ' :: '
		);

		$data['insert'] = $this->url->link('neoseo_blog/neoseo_blog_comment/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$data['delete'] = $this->url->link('neoseo_blog/neoseo_blog_comment/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');

		$data['comments'] = array();

		$filter_data = array(
			'filter_article' => $filter_article,
			'filter_author' => $filter_author,
			'filter_date_added' => $filter_date_added,
			'filter_status' => $filter_status,
			'sort' => $sort,
			'order' => $order,
			'comment_reply_id' => 0,
			'start' => ($page - 1) * $this->config->get('config_limit_admin'),
			'limit' => $this->config->get('config_limit_admin')
		);

		$comment_total = $this->model_neoseo_blog_neoseo_blog_comment->getTotalArticleComment($filter_data);

		$results = $this->model_neoseo_blog_neoseo_blog_comment->getArticleComments($filter_data);

		foreach ($results as $result) {
			$data['comments'][] = array(
				'comment_id' => $result['comment_id'],
				'article_id' => $result['article_id'],
				'name' => $result['article_name'],
				'author_name' => $result['author'],
				'status' => ($result['status'] ? $this->language->get('text_enabled') : $this->language->get('text_disabled')),
				'date_added' => date($this->language->get('date_format_short'), strtotime($result['date_added'])),
				'selected' => isset($this->request->post['selected']) && in_array($result['comment_id'], $this->request->post['selected']),
				'edit' => $this->url->link('neoseo_blog/neoseo_blog_comment/update', 'token=' . $this->session->data['token'] . '&comment_id=' . $result['comment_id'] . $url, 'SSL')
			);
		}

		$data['token'] = $this->session->data['token'];

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

		$url = '';

		if (isset($this->request->get['filter_article'])) {
			$url .= '&filter_article=' . urlencode(html_entity_decode($this->request->get['filter_article'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_author'])) {
			$url .= '&filter_author=' . urlencode(html_entity_decode($this->request->get['filter_author'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_date_added'])) {
			$url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
		}

		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
		}

		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['sort_article_name'] = $this->url->link('neoseo_blog/neoseo_blog_comment', 'token=' . $this->session->data['token'] . '&sort=bad.name' . $url, 'SSL');
		$data['sort_author_name'] = $this->url->link('neoseo_blog/neoseo_blog_comment', 'token=' . $this->session->data['token'] . '&sort=bc.name' . $url, 'SSL');
		$data['sort_status'] = $this->url->link('neoseo_blog/neoseo_blog_comment', 'token=' . $this->session->data['token'] . '&sort=bc.status' . $url, 'SSL');
		$data['sort_date_added'] = $this->url->link('neoseo_blog/neoseo_blog_comment', 'token=' . $this->session->data['token'] . '&sort=bc.date_added' . $url, 'SSL');

		$url = '';

		if (isset($this->request->get['filter_article'])) {
			$url .= '&filter_article=' . urlencode(html_entity_decode($this->request->get['filter_article'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_author'])) {
			$url .= '&filter_author=' . urlencode(html_entity_decode($this->request->get['filter_author'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_date_added'])) {
			$url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
		}

		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$pagination = new Pagination();
		$pagination->total = $comment_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_limit_admin');
		$pagination->text = $this->language->get('text_pagination');
		$pagination->url = $this->url->link('neoseo_blog/neoseo_blog_comment', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($comment_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($comment_total - $this->config->get('config_limit_admin'))) ? $comment_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $comment_total, ceil($comment_total / $this->config->get('config_limit_admin')));

		$data['filter_article'] = $filter_article;
		$data['filter_author'] = $filter_author;
		$data['filter_date_added'] = $filter_date_added;
		$data['filter_status'] = $filter_status;

		$data['sort'] = $sort;
		$data['order'] = $order;

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('neoseo_blog/neoseo_blog_comment_list.tpl', $data));
	}

	public function getForm()
	{

		$data = $this->language->load('neoseo_blog/neoseo_blog_comment');

		$data['text_form'] = isset($this->request->get['comment_id']) ? $this->language->get('text_edit') : $this->language->get('text_add');

		$data['token'] = $this->session->data['token'];
		$data['ckeditor'] = $this->config->get('config_editor_default');
		if ($this->config->get('config_editor_default')) {
			$this->document->addScript('view/javascript/ckeditor/ckeditor.js');
			$this->document->addScript('view/javascript/ckeditor/ckeditor_init.js');
		}

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['article_name'])) {
			$data['error_article_name'] = $this->error['article_name'];
		} else {
			$data['error_article_name'] = '';
		}

		if (isset($this->error['author'])) {
			$data['error_author'] = $this->error['author'];
		} else {
			$data['error_author'] = '';
		}

		if (isset($this->error['comment'])) {
			$data['error_comment'] = $this->error['comment'];
		} else {
			$data['error_comment'] = '';
		}

		if (isset($this->error['rating'])) {
			$data['error_rating'] = $this->error['rating'];
		} else {
			$data['error_rating'] = '';
		}

		if (isset($this->error['reply_author'])) {
			$data['error_reply_author'] = $this->error['reply_author'];
		} else {
			$data['error_reply_author'] = array();
		}

		if (isset($this->error['reply_comment'])) {
			$data['error_reply_comment'] = $this->error['reply_comment'];
		} else {
			$data['error_reply_comment'] = array();
		}

		$url = '';

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}
		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}
		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title_raw'),
			'href' => $this->url->link('neoseo_blog/neoseo_blog_comment', 'token=' . $this->session->data['token'] . $url, 'SSL'),
		);

		if (!isset($this->request->get['comment_id'])) {
			$data['action'] = $this->url->link('neoseo_blog/neoseo_blog_comment/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
		} else {
			$data['action'] = $this->url->link('neoseo_blog/neoseo_blog_comment/update', 'token=' . $this->session->data['token'] . '&comment_id=' . $this->request->get['comment_id'] . $url, 'SSL');
		}

		$data['cancel'] = $this->url->link('neoseo_blog/neoseo_blog_comment', 'token=' . $this->session->data['token'] . $url, 'SSL');

		if ((isset($this->request->get['comment_id'])) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$comment_info = $this->model_neoseo_blog_neoseo_blog_comment->getArticleComment($this->request->get['comment_id']);
		}

		if (isset($this->request->post['article_name'])) {
			$data['article_name'] = $this->request->post['article_name'];
		} elseif (isset($comment_info)) {
			$data['article_name'] = $comment_info['article_name'];
		} else {
			$data['article_name'] = '';
		}

		if (isset($this->request->post['article_id'])) {
			$data['article_id'] = $this->request->post['article_id'];
		} elseif (isset($comment_info)) {
			$data['article_id'] = $comment_info['article_id'];
		} else {
			$data['article_id'] = '';
		}

		if (isset($this->request->post['author_name'])) {
			$data['author_name'] = $this->request->post['author_name'];
		} elseif (isset($comment_info)) {
			$data['author_name'] = $comment_info['author'];
		} else {
			$data['author_name'] = '';
		}

		if (isset($this->request->post['rating'])) {
			$data['rating'] = $this->request->post['rating'];
		} elseif (isset($comment_info)) {
			$data['rating'] = $comment_info['rating'];
		} else {
			$data['rating'] = 1;
		}

		if (isset($this->request->post['status'])) {
			$data['status'] = $this->request->post['status'];
		} elseif (isset($comment_info)) {
			$data['status'] = $comment_info['status'];
		} else {
			$data['status'] = 1;
		}

		if (isset($this->request->post['comment'])) {
			$data['comment'] = $this->request->post['comment'];
		} elseif (isset($comment_info)) {
			$data['comment'] = $comment_info['comment'];
		} else {
			$data['comment'] = '';
		}

		if (isset($this->request->post['comment_reply'])) {
			$data['comment_reply'] = $this->request->post['comment_reply'];
		} elseif (isset($this->request->get['comment_id'])) {
			$data['comment_reply'] = $this->model_neoseo_blog_neoseo_blog_comment->getCommentReply($this->request->get['comment_id']);
		} else {
			$data['comment_reply'] = array();
		}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('neoseo_blog/neoseo_blog_comment_form.tpl', $data));
	}

	public function validateForm()
	{

		if (!$this->user->hasPermission('modify', 'neoseo_blog/neoseo_blog_comment')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if (utf8_strlen($this->request->post['author_name']) < 3 || utf8_strlen($this->request->post['author_name']) > 64) {
			$this->error['author'] = $this->language->get('error_author');
		}

		if ($this->request->post['article_name'] == '') {
			$this->error['article_name'] = $this->language->get('error_article_name');
		} else {
			$found = $this->model_neoseo_blog_neoseo_blog_comment->checkArticleTitle($this->request->post['article_name']);

			if (!$found) {
				$this->error['article_name'] = $this->language->get('error_article_not_found');
			}
		}

		if (utf8_strlen($this->request->post['comment']) < 3) {
			$this->error['comment'] = $this->language->get('error_comment');
		}

		if (isset($this->request->post['comment_reply'])) {
			foreach ($this->request->post['comment_reply'] as $key => $value) {
				if (utf8_strlen($value['author']) < 3 || utf8_strlen($value['author']) > 64) {
					$this->error['reply_author'][$key] = $this->language->get('error_author');
				}

				if (utf8_strlen($value['comment']) < 3) {
					$this->error['reply_comment'][$key] = $this->language->get('error_comment');
				}
			}
		}

		if ($this->error && !isset($this->error['warning'])) {
			$this->error['warning'] = $this->language->get('error_warning');
		}

		return !$this->error;
	}

	private function validateDelete()
	{
		if (!$this->user->hasPermission('modify', 'neoseo_blog/neoseo_blog_comment')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}

}
