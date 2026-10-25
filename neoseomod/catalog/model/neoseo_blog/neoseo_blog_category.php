<?php

class ModelNeoseoBlogNeoseoBlogCategory extends Model
{

	public function getCategory($category_id)
	{

		$query = $this->db->query("SELECT DISTINCT * FROM `" . DB_PREFIX . "blog_category` bc LEFT JOIN `" . DB_PREFIX . "blog_category_description` bcd ON (bc.category_id = bcd.category_id) LEFT JOIN `" . DB_PREFIX . "blog_category_to_store` bcs ON (bc.category_id = bcs.category_id) WHERE bc.category_id = '" . (int) $category_id . "' AND bcd.language_id = '" . (int) $this->config->get('config_language_id') . "' AND bcs.store_id = '" . (int) $this->config->get('config_store_id') . "' AND bc.status = '1'");

		return $query->row;
	}

	public function getTotalCategories($parent_id = 0)
	{

		$query = $this->db->query("SELECT COUNT(DISTINCT(bc.category_id)) AS total FROM `" . DB_PREFIX . "blog_category` bc LEFT JOIN `" . DB_PREFIX . "blog_category_description` bcd ON(bc.category_id=bcd.category_id) LEFT JOIN `" . DB_PREFIX . "blog_category_to_store` bcs ON(bc.category_id=bcs.category_id) WHERE bc.parent_id='" . (int) $parent_id . "' AND bcd.language_id='" . (int) $this->config->get('config_language_id') . "' AND bcs.store_id='" . (int) $this->config->get('config_store_id') . "' AND bc.status=1 ORDER BY bc.sort_order, LCASE(bcd.name)");

		return $query->row['total'];
	}

	public function getCategories($parent_id = 0)
	{

		$categories = array();

		if ($this->config->get('blog_cache_results')) {
			$categories = $this->cache->get('blog.categories.' . (int) $this->config->get('config_language_id') . '.' . (int) $this->config->get('config_store_id') . '.' . (int) $parent_id);
		}

		if (!$categories) {
			$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "blog_category` bc LEFT JOIN `" . DB_PREFIX . "blog_category_description` bcd ON(bc.category_id=bcd.category_id) LEFT JOIN `" . DB_PREFIX . "blog_category_to_store` bcs ON(bc.category_id=bcs.category_id) WHERE bc.parent_id='" . (int) $parent_id . "' AND bcd.language_id='" . (int) $this->config->get('config_language_id') . "' AND bcs.store_id='" . (int) $this->config->get('config_store_id') . "' AND bc.status=1 ORDER BY bc.sort_order, LCASE(bcd.name)");

			$categories = $query->rows;
			if ($this->config->get('blog_cache_results')) {
				$this->cache->set('blog.categories.' . (int) $this->config->get('config_language_id') . '.' . (int) $this->config->get('config_store_id') . '.' . (int) $parent_id, $categories);
			}
		}

		return $categories ? $categories : array();
	}

	public function getParentIds($category_id)
	{

		$sql = "SELECT path_id FROM  `" . DB_PREFIX . "blog_category_path` WHERE category_id = " . (int) $category_id . " ORDER BY level ASC ";
		$query = $this->db->query($sql);
		if (!$query->num_rows)
			return array();

		$result = array();
		foreach ($query->rows as $row) {
			if ($row['path_id'] == $category_id) {
				continue;
			}
			$result[] = $row['path_id'];
		}

		return $result;
	}

	public function getCategoryLayoutId($category_id)
	{

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "blog_category_to_layout WHERE category_id = '" . (int) $category_id . "' AND store_id = '" . (int) $this->config->get('config_store_id') . "'");

		if ($query->num_rows) {
			return $query->row['layout_id'];
		} else {
			return 0;
		}
	}

}
