<?php

class ModelNeoseoBlogNeoseoBlogComment extends Model
{

	public function addArticleComment($data)
	{

		$this->db->query("INSERT INTO `" . DB_PREFIX . "blog_comment` SET article_id='" . (int) $data['article_id'] . "', author='" . $this->db->escape($data['author_name']) . "', comment='" . $this->db->escape($data['comment']) . "', rating='" . (int) $data['rating'] . "', status='" . (int) $data['status'] . "', date_added=NOW(), date_modified=NOW()");

		$comment_id = $this->db->getLastId();

		if (isset($data['comment_reply'])) {
			foreach ($data['comment_reply'] as $reply) {
				$this->db->query("INSERT INTO `" . DB_PREFIX . "blog_comment` SET article_id='" . (int) $data['article_id'] . "', comment_reply_id='" . (int) $comment_id . "', author='" . $this->db->escape($reply['author']) . "', comment='" . $this->db->escape($reply['comment']) . "', status='" . (int) $reply['status'] . "', date_added=NOW(), date_modified=NOW()");
			}
		}
	}

	public function editArticleComment($comment_id, $data)
	{

		$this->db->query("UPDATE `" . DB_PREFIX . "blog_comment` SET article_id='" . (int) $data['article_id'] . "', author='" . $this->db->escape($data['author_name']) . "', comment='" . $this->db->escape($data['comment']) . "', rating='" . (int) $data['rating'] . "', status='" . (int) $data['status'] . "', date_modified=NOW() WHERE comment_id='" . (int) $comment_id . "'");

		$this->db->query("DELETE FROM `" . DB_PREFIX . "blog_comment` WHERE comment_reply_id='" . (int) $comment_id . "'");

		if (isset($data['comment_reply'])) {
			foreach ($data['comment_reply'] as $reply) {
				$this->db->query("INSERT INTO `" . DB_PREFIX . "blog_comment` SET article_id='" . (int) $data['article_id'] . "', comment_reply_id='" . (int) $comment_id . "', author='" . $this->db->escape($reply['author']) . "', comment='" . $this->db->escape($reply['comment']) . "', status='" . (int) $reply['status'] . "', date_added=NOW(), date_modified=NOW()");
			}
		}
	}

	public function deleteArticleComment($comment_id)
	{
		$this->db->query("DELETE FROM `" . DB_PREFIX . "blog_comment` WHERE comment_id='" . (int) $comment_id . "'");
		$this->db->query("DELETE FROM `" . DB_PREFIX . "blog_comment` WHERE comment_reply_id='" . (int) $comment_id . "'");
	}

	public function getArticleComment($comment_id)
	{
		$sql = $this->db->query("SELECT bc.*, bad.name AS article_name FROM `" . DB_PREFIX . "blog_comment` bc LEFT JOIN `" . DB_PREFIX . "blog_article_description` bad ON(bc.article_id=bad.article_id) WHERE bc.comment_id='" . (int) $comment_id . "' AND bad.language_id='" . (int) $this->config->get('config_language_id') . "'");

		return $sql->row;
	}

	public function getTotalArticleComment($data = array())
	{
		$sql = "SELECT COUNT(bc.comment_id) AS total FROM `" . DB_PREFIX . "blog_comment` bc LEFT JOIN `" . DB_PREFIX . "blog_article_description` bad ON(bc.article_id=bad.article_id) WHERE bc.comment_reply_id='" . $data['comment_reply_id'] . "' AND bad.language_id='" . (int) $this->config->get('config_language_id') . "'";

		if (isset($data['filter_article']) && !empty($data['filter_article'])) {
			$sql .= " AND bad.name LIKE '%" . $this->db->escape($data['filter_article']) . "%'";
		}

		if (isset($data['filter_author']) && !empty($data['filter_author'])) {
			$sql .= " AND bc.author LIKE '%" . $this->db->escape($data['filter_author']) . "%'";
		}

		if (isset($data['filter_status'])) {
			$sql .= " AND bc.status='" . (int) $data['filter_status'] . "'";
		}

		if (isset($data['filter_date_added']) && !empty($data['filter_date_added'])) {
			$sql .= " AND DATE(bc.date_added) = DATE('" . $this->db->escape($data['filter_date_added']) . "')";
		}

		$query = $this->db->query($sql);

		return $query->row['total'];
	}

	public function getArticleComments($data = array())
	{
		$sql = "SELECT bc.*, bad.name AS article_name FROM `" . DB_PREFIX . "blog_comment` bc LEFT JOIN `" . DB_PREFIX . "blog_article_description` bad ON(bc.article_id=bad.article_id) WHERE bc.comment_reply_id='" . $data['comment_reply_id'] . "' AND bad.language_id='" . (int) $this->config->get('config_language_id') . "'";

		if (isset($data['filter_article']) && !empty($data['filter_article'])) {
			$sql .= " AND bad.name LIKE '%" . $this->db->escape($data['filter_article']) . "%'";
		}

		if (isset($data['filter_author']) && !empty($data['filter_author'])) {
			$sql .= " AND bc.author LIKE '%" . $this->db->escape($data['filter_author']) . "%'";
		}

		if (isset($data['filter_status'])) {
			$sql .= " AND bc.status='" . (int) $data['filter_status'] . "'";
		}

		if (isset($data['filter_date_added']) && !empty($data['filter_date_added'])) {
			$sql .= " AND DATE(bc.date_added) = DATE('" . $this->db->escape($data['filter_date_added']) . "')";
		}

		$sort_data = array(
			'bad.name',
			'bc.author',
			'bc.status',
			'bc.date_added'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY bc.date_added";
		}

		if (isset($data['order']) && ($data['order'] == 'ASC')) {
			$sql .= " ASC";
		} else {
			$sql .= " DESC";
		}

		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}

			$sql .= " LIMIT " . (int) $data['start'] . "," . (int) $data['limit'];
		}

		$query = $this->db->query($sql);

		return $query->rows;
	}

	public function getCommentReply($comment_id)
	{
		$comment_reply = array();

		$sql = $this->db->query("SELECT bc.*, bad.name AS article_name FROM `" . DB_PREFIX . "blog_comment` bc LEFT JOIN `" . DB_PREFIX . "blog_article_description` bad ON(bc.article_id=bad.article_id) WHERE bc.comment_reply_id='" . (int) $comment_id . "' AND bad.language_id='" . (int) $this->config->get('config_language_id') . "'");

		foreach ($sql->rows as $result) {
			$comment_reply[] = array(
				'comment_id' => $result['comment_id'],
				'artile_name' => $result['article_name'],
				'author' => $result['author'],
				'comment' => $result['comment'],
				'status' => $result['status'],
			);
		}

		return $comment_reply;
	}

	public function checkArticleTitle($name)
	{
		$sql = $this->db->query("SELECT * FROM `" . DB_PREFIX . "blog_article_description` WHERE name='" . $this->db->escape($name) . "'");
		return $sql->num_rows;
	}

}
