<?php

class ModelNeoseoBlogNeoseoBlogAuthor extends Model
{

	public function getAuthor($author_id)
	{

		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "blog_author` ba LEFT JOIN `" . DB_PREFIX . "blog_author_description` bad ON(ba.author_id=bad.author_id) WHERE ba.author_id='" . (int) $author_id . "' AND ba.status=1 AND bad.language_id='" . $this->config->get('config_language_id') . "'");

		return $query->row;
	}

}
