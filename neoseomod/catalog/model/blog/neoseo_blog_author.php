<?php
require_once(DIR_SYSTEM.'/engine/neoseo_model.php');

class ModelBlogNeoSeoBlogAuthor extends NeoSeoModel
{
	public function __construct($registry) {
		parent::__construct($registry);
		$this->_moduleSysName = 'neoseo_blog';
		$this->_logFile = $this->_moduleSysName . '.log';
		$this->debug = $this->config->get($this->_moduleSysName . '_status') == 1;
	}

	public function getAuthor($author_id)
	{

		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "blog_author` ba LEFT JOIN `" . DB_PREFIX . "blog_author_description` bad ON(ba.author_id=bad.author_id) WHERE ba.author_id='" . (int) $author_id . "' AND ba.status=1 AND bad.language_id='" . $this->config->get('config_language_id') . "'");

		return $query->row;
	}

}
