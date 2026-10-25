<?php

require_once( DIR_SYSTEM . "/engine/neoseo_model.php");

class ModelCatalogNeoSeoFilterPages extends NeoSeoModel
{

	public function __construct($registry)
	{
		parent::__construct($registry);
		$this->_moduleSysName = "neoseo_filter_pages";
		$this->_logFile = $this->_moduleSysName . ".log";
		$this->debug = $this->config->get($this->_moduleSysName . "_debug");
	}

	public function clearCache()
	{
		$this->cache->delete("neoseo_filter_k2m");
		$this->cache->delete("neoseo_filter_k2o");
		$this->cache->delete("neoseo_filter_k2ov");
		$this->cache->delete("neoseo_filter_k2p");
		$this->cache->delete("neoseo_filter_m2k");
		$this->cache->delete("neoseo_filter_o2k");
		$this->cache->delete("neoseo_filter_ov2k");
		$this->cache->delete("neoseo_filter_p2k");
	}

	public function addPage($data)
	{
		/* if (!$data['keyword'] && isset($data['title'][$this->config->get('config_language_id')])) {
		  $data['keyword'] = $this->translate($data['title'][$this->config->get('config_language_id')]);
		  } */

		$this->db->query("INSERT INTO " . DB_PREFIX . "filter_page SET "
		    . "status = '" . (int) $data['status'] . "', "
		    . "category_id = '" . (int) $data['category_id'] . "', "
		    //. "keyword = '" . $this->db->escape($data['keyword']) . "',"
		    . "options = '" . $this->db->escape($data['options']) . "'");

		$page_id = $this->db->getLastId();

		$page_keyword = '';
		foreach ($data['title'] as $language_id => $name) {
			if (isset($data['keyword'][$language_id])) {
				$page_keyword[$language_id] = $data['keyword'][$language_id];
				if (!$page_keyword[$language_id] && $name) {
					$page_keyword[$language_id] = $this->translate($name);
				}
			}

			$this->db->query("INSERT INTO " . DB_PREFIX . "filter_page_description SET "
			    . "page_id = '" . (int) $page_id . "', "
			    . "language_id = '" . (int) $language_id . "', "
			    . "title = '" . $this->db->escape(isset($data['title'][$language_id]) ? $data['title'][$language_id] : '') . "',"
			    . "keyword = '" . $this->db->escape(isset($page_keyword[$language_id]) ? $page_keyword[$language_id] : '') . "',"
			    . "description = '" . $this->db->escape(isset($data['description'][$language_id]) ? $data['description'][$language_id] : '') . "',"
			    . "h1 = '" . $this->db->escape(isset($data['h1'][$language_id]) ? $data['h1'][$language_id] : '') . "',"
			    . "meta_keywords = '" . $this->db->escape(isset($data['meta_keywords'][$language_id]) ? $data['meta_keywords'][$language_id] : '') . "',"
			    . "meta_description = '" . $this->db->escape(isset($data['meta_description'][$language_id]) ? $data['meta_description'][$language_id] : '') . "'");
		}

		$this->clearCache();

		return $page_id;
	}

	public function editPage($page_id, $data)
	{
		/* if (!$data['keyword'] && isset($data['title'][$this->config->get('config_language_id')])) {
		  $data['keyword'] = $this->translate($data['title'][$this->config->get('config_language_id')]);
		  } */

		$this->db->query("UPDATE " . DB_PREFIX . "filter_page SET "
		    . "status = '" . (int) $data['status'] . "', "
		    . "category_id = '" . (int) $data['category_id'] . "', "
		    //. "keyword = '" . $this->db->escape($data['keyword']) . "',"
		    . "options = '" . $this->db->escape($data['options']) . "'"
		    . "WHERE page_id = '" . (int) $page_id . "'");

		$this->db->query("DELETE FROM " . DB_PREFIX . "filter_page_description WHERE page_id = '" . (int) $page_id . "'");

		$page_keyword = '';
		foreach ($data['title'] as $language_id => $name) {
			if (isset($data['keyword'][$language_id])) {
				$page_keyword[$language_id] = $data['keyword'][$language_id];
				if (!$page_keyword[$language_id] && $name) {
					$page_keyword[$language_id] = $this->translate($name);
				}
			}
			$this->db->query("INSERT INTO " . DB_PREFIX . "filter_page_description SET "
			    . "page_id = '" . (int) $page_id . "', "
			    . "language_id = '" . (int) $language_id . "', "
			    . "title = '" . $this->db->escape(isset($data['title'][$language_id]) ? $data['title'][$language_id] : '') . "',"
			    . "keyword = '" . $this->db->escape(isset($page_keyword[$language_id]) ? $page_keyword[$language_id] : '') . "',"
			    . "description = '" . $this->db->escape(isset($data['description'][$language_id]) ? $data['description'][$language_id] : '') . "',"
			    . "h1 = '" . $this->db->escape(isset($data['h1'][$language_id]) ? $data['h1'][$language_id] : '') . "',"
			    . "meta_keywords = '" . $this->db->escape(isset($data['meta_keywords'][$language_id]) ? $data['meta_keywords'][$language_id] : '') . "',"
			    . "meta_description = '" . $this->db->escape(isset($data['meta_description'][$language_id]) ? $data['meta_description'][$language_id] : '') . "'");
		}

		$this->clearCache();
	}

	public function deletePage($page_id)
	{
		$this->db->query("DELETE FROM " . DB_PREFIX . "filter_page WHERE page_id = '" . (int) $page_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "filter_page_description WHERE page_id = '" . (int) $page_id . "'");

		$this->clearCache();
	}

	public function getPage($page_id)
	{
		$results = array();
		$query = $this->db->query("SELECT DISTINCT * ,fpd.keyword as page_keyword, fp.keyword FROM " . DB_PREFIX . "filter_page fp LEFT JOIN " . DB_PREFIX . "filter_page_description fpd ON (fp.page_id = fpd.page_id) WHERE fp.page_id = '" . (int) $page_id . "'");

		if ($query->rows) {
			$results['page_id'] = $query->row['page_id'];
			$results['status'] = $query->row['status'];
			$results['category_id'] = $query->row['category_id'];
			$results['options'] = $query->row['options'];
			//$results['keyword'] = $query->row['keyword'];

			foreach ($query->rows as $row) {
				if (!$row['page_keyword']) {
					$row['page_keyword'] = $query->row['keyword'];
				}
				$results['title'][$row['language_id']] = $row['title'];
				$results['keyword'][$row['language_id']] = $row['page_keyword'];
				$results['description'][$row['language_id']] = $row['description'];
				$results['h1'][$row['language_id']] = $row['h1'];
				$results['meta_keywords'][$row['language_id']] = $row['meta_keywords'];
				$results['meta_description'][$row['language_id']] = $row['meta_description'];
			}
		}

		return $results;
	}

	public function getFilterPages($data = array())
	{
		$sql = "SELECT fp.*, fpd.*, fpd.keyword as page_keyword, fp.keyword as old_keyword
		          FROM " . DB_PREFIX . "filter_page fp 
		               LEFT JOIN " . DB_PREFIX . "filter_page_description fpd ON ( fp.page_id = fpd.page_id AND fpd.language_id = '" . (int) $this->config->get('config_language_id') . "')		               		               
		               ";

		$sql .= " WHERE 1 ";

		if (!empty($data['filter_h1'])) {
			$sql .= " AND fpd.h1 LIKE '%" . $this->db->escape($data['filter_h1']) . "%'";
		}

		if (!empty($data['filter_keyword'])) {
			$sql .= " AND fpd.keyword LIKE '" . $this->db->escape($data['filter_keyword']) . "'";
		}

		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
			$sql .= " AND fp.status='" . $this->db->escape($data['filter_status']) . "'";
		}

		$sort_data = array(
			'fpd.h1',
			'fpd.keyword',
			'fp.status',
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY fpd.h1";
		}

		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC";
		} else {
			$sql .= " ASC";
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

	public function getPageName($page_id)
	{
		$option_name = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "filter_page_description WHERE page_id = '" . (int) $page_id . "'");

		foreach ($query->rows as $result) {
			$option_name[$result['language_id']] = $result['name'];
		}

		return $option_name;
	}

	public function getTotalFilterPages($data = array())
	{
		$sql = "SELECT COUNT(*) AS total FROM " . DB_PREFIX . "filter_page fp LEFT JOIN " . DB_PREFIX . "filter_page_description fpd ON fp.page_id = fpd.page_id ";

		$sql .= " WHERE fpd.language_id = '" . (int) $this->config->get('config_language_id') . "'";

		if (!empty($data['filter_h1'])) {
			$sql .= " AND fpd.h1 LIKE '%" . $this->db->escape($data['filter_h1']) . "%'";
		}

		if (!empty($data['filter_keyword'])) {
			$sql .= " AND fpd.keyword LIKE '" . $this->db->escape($data['filter_keyword']) . "'";
		}

		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
			$sql .= " AND fp.status='" . $this->db->escape($data['filter_status']) . "'";
		}

		$query = $this->db->query($sql);

		return $query->row['total'];
	}

	public function getPageByKeyword($keyword)
	{
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "filter_page_description WHERE `keyword` = '" . $this->db->escape($keyword) . "'");

		if (!$query->num_rows) {
			$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "filter_page WHERE `keyword` = '" . $this->db->escape($keyword) . "'");
		}

		return $query->num_rows ? $query->row['page_id'] : false;
	}

	public function translate($string)
	{
		$converter = array(
			'а' => 'a', 'б' => 'b', 'в' => 'v',
			'г' => 'g', 'д' => 'd', 'е' => 'e',
			'ё' => 'e', 'ж' => 'zh', 'з' => 'z',
			'и' => 'i', 'й' => 'y', 'к' => 'k',
			'л' => 'l', 'м' => 'm', 'н' => 'n',
			'о' => 'o', 'п' => 'p', 'р' => 'r',
			'с' => 's', 'т' => 't', 'у' => 'u',
			'ф' => 'f', 'х' => 'h', 'ц' => 'c',
			'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sch',
			'ь' => '', 'ы' => 'y', 'ъ' => '',
			'э' => 'e', 'ю' => 'yu', 'я' => 'ya',
			'А' => 'A', 'Б' => 'B', 'В' => 'V',
			'Г' => 'G', 'Д' => 'D', 'Е' => 'E',
			'Ё' => 'E', 'Ж' => 'Zh', 'З' => 'Z',
			'И' => 'I', 'Й' => 'Y', 'К' => 'K',
			'Л' => 'L', 'М' => 'M', 'Н' => 'N',
			'О' => 'O', 'П' => 'P', 'Р' => 'R',
			'С' => 'S', 'Т' => 'T', 'У' => 'U',
			'Ф' => 'F', 'Х' => 'H', 'Ц' => 'C',
			'Ч' => 'Ch', 'Ш' => 'Sh', 'Щ' => 'Sch',
			'Ь' => '', 'Ы' => 'Y', 'Ъ' => '',
			'Э' => 'E', 'Ю' => 'Yu', 'Я' => 'Ya',
		);

		$string = mb_strtolower($string, 'UTF-8');
		$string = preg_replace('![^a-zа-яёйъ0-9]+!isu', '-', $string);
		$string = $this->clear($string, '-');
		$string = strtr($string, $converter);
		$string = preg_replace('!\-{2,}!si', '-', $string);
		$string = $this->makeUnique($string);

		return $string;
	}

	private function makeUnique($keyword)
	{
		$counter = 0;
		$result = $keyword;
		while (true) {
			$filter_page = $this->db->query("SELECT page_id FROM " . DB_PREFIX . "filter_page_description WHERE keyword ='" . $this->db->escape($result) . "'");
			if (!$filter_page->num_rows) {
				$filter_page_value = $this->db->query("SELECT page_id FROM " . DB_PREFIX . "filter_page_description WHERE keyword ='" . $this->db->escape($result) . "'");
				if (!$filter_page_value->num_rows)
					break;
			}
			$result = $keyword . '-' . ++$counter;
		}
		return $result;
	}

	public function clear($string, $replace = '')
	{
		$string = htmlspecialchars_decode($string, ENT_QUOTES);

		$string = strip_tags(html_entity_decode($string, ENT_QUOTES, 'UTF-8'));

		if ($replace) {
			$string = preg_replace('!\\' . $replace . '{2,}!si', $replace, $string);

			$string = trim($string, $replace);
		} else {
			$string = trim($string);
		}

		return $string;
	}

}
