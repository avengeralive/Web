<?php

require_once( DIR_SYSTEM . "/engine/neoseo_model.php");

class ModelCatalogNeoSeoFilter extends NeoSeoModel
{
	const OPTION_VALUE_SEP = ':';
	const VALUES_SEP = ',';
	const OPTIONS_SEP = ';';

	private $options_names = array();
	private $options_to_keywords = null;
	private $keywords_to_options = null;

	private $manufacturers_to_keywords = null;
	private $keywords_to_manufacturers = null;
	private $manufacturers_names = array();

	private $option_values_names = array();
	private $option_values_to_keywords = null;
	private $keywords_to_option_values = null;

	public function __construct($registry)
	{
		parent::__construct($registry);
		$this->_moduleSysName = "neoseo_filter";
		$this->_logFile = $this->_moduleSysName . ".log";
		$this->debug = $this->config->get($this->_moduleSysName . "_debug");

		$this->initOptionsData();
		$this->initOptionValuesData();
		$this->initManufacturersData();
	}

	private function initOptionsData()
	{
		$this->options_to_keywords = array();

		$sql = "SELECT fo.option_id, fo.sort_order, fod.keyword, fo.keyword as old_keyword, fod.name 
				  FROM `" . DB_PREFIX . "filter_option` fo
					   LEFT JOIN `" . DB_PREFIX . "filter_option_description` fod ON ( fo.option_id = fod.option_id AND fod.language_id = '" . (int) $this->config->get('config_language_id') . "')			                
				  ORDER BY sort_order";
		$query = $this->db->query($sql);
		foreach ($query->rows as $row) {

			$this->options_names[$row['option_id']] = $row['name'];

			if (!$row['keyword']) {
				if (!$row['old_keyword']) {
					continue;
				}else{
					$row['keyword'] = $row['old_keyword'];
				}
			}

			$this->options_to_keywords[$row['option_id']] = array(
				'keyword' => $row['keyword'],
				'sort_order' => $row['sort_order']
			);

		}

		$this->options_names['m'] = $this->language->get('text_manufacturer');

	}

	private function initOptionValuesData()
	{

		$this->option_values_to_keywords = array();

		$sql = "SELECT fov.option_value_id, fov.sort_order, fovd.keyword, fov.keyword as old_keyword, fovd.name 
		          FROM `" . DB_PREFIX . "filter_option_value` fov
					   LEFT JOIN `" . DB_PREFIX . "filter_option_value_description` fovd ON ( fov.option_value_id = fovd.option_value_id AND fovd.language_id = '" . (int) $this->config->get('config_language_id') . "')
		         ORDER BY sort_order";
		$query = $this->db->query($sql);

		foreach ($query->rows as $row) {

			$this->option_values_names[$row['option_value_id']] = $row['name'];

			if (!$row['keyword']) {
				if (!$row['old_keyword']) {
					continue;
				}else{
					$row['keyword'] = $row['old_keyword'];
				}
			}

			$this->keywords_to_option_values[$row['keyword']] = $row['option_value_id'];
			$this->option_values_to_keywords[$row['option_value_id']] = array(
				'keyword' => $row['keyword'],
				'sort_order' => $row['sort_order']
			);

		}

	}

	private function initManufacturersData()
	{
		$manufacturers_sort_orders = array();
		$this->manufacturers_names = array();
		$query = $this->db->query("SELECT manufacturer_id, `sort_order`, `name` FROM `" . DB_PREFIX . "manufacturer`");
		foreach ($query->rows as $row) {
			$manufacturers_sort_orders[(int)$row['manufacturer_id']] = (int)$row['sort_order'];
			$this->manufacturers_names[(int)$row['manufacturer_id']] = $row['name'];
		}

		$this->manufacturers_to_keywords = array();

		$query = $this->db->query("SELECT `query`, keyword FROM " . DB_PREFIX . "url_alias WHERE query like 'manufacturer_id=%'");
		foreach ($query->rows as $row) {
			$manufacturer_id = str_replace("manufacturer_id=", "", $row['query']);
			if (!isset($manufacturers_sort_orders[$manufacturer_id])) {
				continue;
			}

			$this->keywords_to_manufacturers[$row['keyword']] = $manufacturer_id;
			$this->manufacturers_to_keywords[$manufacturer_id] = array(
				'keyword' => $row['keyword'],
				'sort_order' => $manufacturers_sort_orders[$manufacturer_id]
			);
		}

	}

	public function clearCache(){
		$this->cache->delete("neoseo_filter_k2m");
		$this->cache->delete("neoseo_filter_k2o");
		$this->cache->delete("neoseo_filter_k2ov");
		$this->cache->delete("neoseo_filter_k2p");
		$this->cache->delete("neoseo_filter_m2k");
		$this->cache->delete("neoseo_filter_o2k");
		$this->cache->delete("neoseo_filter_ov2k");
		$this->cache->delete("neoseo_filter_p2k");
	}

	public function clearOptionCache($option_id){
		$this->load->model('localisation/language');
		foreach( $this->model_localisation_language->getLanguages() as $language ) {
			$this->cache->delete("neoseo_filter_ov_" . $language['language_id'] . "_" . $option_id);
		}
		$query = $this->db->query("SELECT `category_id` FROM " . DB_PREFIX . "category");
		foreach ($query->rows as $row) {
			foreach( $this->model_localisation_language->getLanguages() as $language ) {
				$this->cache->delete("neoseo_filter_oc_" . $language['language_id'] . "_" . $row['category_id']);
			}
		}
	}

	public function addOption($data)
	{
		/*if (!$data['option_keyword'] && isset($data['option_name'][$this->config->get('config_language_id')])) {
			$data['option_keyword'] = $this->translate($data['option_name'][$this->config->get('config_language_id')]);
		}*/

		$this->db->query("INSERT INTO " . DB_PREFIX . "filter_option SET "
			. "status = '" . (int)$data['option_status'] . "', "
			. "open = '" . (int)$data['option_open'] . "', "
			. "style = '" . $this->db->escape($data['option_style']) . "', "
			. "type = '" . $this->db->escape($data['option_type']) . "', "
			//. "keyword = '" . $this->db->escape($data['option_keyword']) . "',"
			. "sort_order = '" . (int)$data['option_sort_order'] . "'");

		$option_id = $this->db->getLastId();

		foreach ($data['option_name'] as $language_id => $name) {
			if(isset($data['option_keyword'][$language_id])){
				$option_keyword = $data['option_keyword'][$language_id];
				if (!$option_keyword && $name) {
					$option_keyword = $this->translate($name);
				}
			}

            $query = $this->db->query("SELECT option_id " . DB_PREFIX . "filter_option_description WHERE keyword = '". $this->db->escape($option_keyword) ."'");

            if ($query->row['option_id']){
                $option_keyword .= '_' . $option_id;
		    }

			$this->db->query("INSERT INTO " . DB_PREFIX . "filter_option_description SET option_id = '" . (int)$option_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($name) . "', keyword = '". $this->db->escape($option_keyword) ."' ");
		}

		if (isset($data['option_categories'])) {
			foreach ($data['option_categories'] as $category_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "filter_option_to_category SET option_id = '" . (int)$option_id . "', category_id = '" . (int)$category_id . "'");
			}
		}

		if (isset($data['option_values'])) {
			foreach ($data['option_values'] as $option_value) {

				/*if (!$option_value['keyword'] && isset($option_value['name'][$this->config->get('config_language_id')])) {
					$option_value['keyword'] = $this->translate($option_value['name'][$this->config->get('config_language_id')]);
				}*/

				$this->db->query("INSERT INTO " . DB_PREFIX . "filter_option_value SET"
					. " option_id = '" . (int)$option_id . "',"
					//. " keyword = '" . $this->db->escape($option_value['keyword']) . "',"
					. "sort_order = '" . (int)$option_value['sort_order'] . "',"
					. " color = '" . $this->db->escape($option_value['color']) . "',"
					. " image = '" . $this->db->escape($option_value['image']) . "',"
					. " position = '" . $this->db->escape($option_value['position']) . "'");

				$product_option_id = $this->db->getLastId();

				$option_value_keyword = '';
				foreach ($option_value['name'] as $language_id => $name) {
					if(isset($option_value['keyword'][$language_id]) && $option_value['keyword'][$language_id]){
						$option_value_keyword = $option_value['keyword'][$language_id];
						if (!$option_value_keyword && $name) {
							$option_value_keyword = $this->translate($name);
						}
					}
					$this->db->query("INSERT INTO " . DB_PREFIX . "filter_option_value_description SET option_id = '" . (int)$option_id . "', option_value_id = '" . (int)$product_option_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($name) . "' , keyword = '". $this->db->escape($option_value_keyword) ."'");
				}
			}
		}

		$this->clearCache();

		return $option_id;
	}

	public function editOption($option_id, $data)
	{
		if (!$data['option_keyword'] && isset($data['option_name'][$this->config->get('config_language_id')])) {
			$data['option_keyword'] = $this->translate($data['option_name'][$this->config->get('config_language_id')]);
		}

		$this->db->query("UPDATE " . DB_PREFIX . "filter_option SET "
			. "status = '" . (int)$data['option_status'] . "', "
			. "open = '" . (int)$data['option_open'] . "', "
			. "style = '" . $this->db->escape($data['option_style']) . "', "
			. "type = '" . $this->db->escape($data['option_type']) . "', "
			//. "keyword = '" . $this->db->escape($data['option_keyword']) . "',"
			. "sort_order = '" . (int)$data['option_sort_order'] . "'"
			. "WHERE option_id = '" . (int)$option_id . "'");

		$this->db->query("DELETE FROM " . DB_PREFIX . "filter_option_description WHERE option_id = '" . (int)$option_id . "'");

		foreach ($data['option_name'] as $language_id => $name) {
			if(isset($data['option_keyword'][$language_id])){
				$option_keyword = $data['option_keyword'][$language_id];
			}
			$this->db->query("INSERT INTO " . DB_PREFIX . "filter_option_description SET option_id = '" . (int)$option_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($name) . "' , keyword = '". $this->db->escape($option_keyword) ."' ");
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "filter_option_to_category WHERE option_id = '" . (int)$option_id . "'");

		if (isset($data['option_categories'])) {
			foreach ($data['option_categories'] as $category_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "filter_option_to_category SET option_id = '" . (int)$option_id . "', category_id = '" . (int)$category_id . "'");
			}
		}

		// Удаляем только те, которых уже нет
		$sql2 = "";
		if( $data['option_values'] ) {

			$option_value_ids = array();
			foreach ($data['option_values'] as $option_value) {
				if( isset($option_value['option_value_id']) ) {
					$option_value_ids[] = $option_value['option_value_id'];
				}
			}

			if( $option_value_ids ) {
				$sql2 = " AND not option_value_id IN (" . implode(",", $option_value_ids ) . ")";
			}
		}
		$sql = "DELETE FROM " . DB_PREFIX . "filter_option_value WHERE option_id = '" . (int)$option_id . "'" . $sql2;
		$this->db->query($sql);
		$this->db->query("DELETE FROM " . DB_PREFIX . "filter_option_value_description WHERE option_id = '" . (int)$option_id . "'" );

		if (isset($data['option_values'])) {
			foreach ($data['option_values'] as $option_value) {

				/*if (!$option_value['keyword'] && isset($option_value['name'][$this->config->get('config_language_id')])) {
					$option_value['keyword'] = $this->translate($option_value['name'][$this->config->get('config_language_id')]);
				}*/

				if( !isset($option_value['option_value_id']) ) {
					$this->db->query("INSERT INTO " . DB_PREFIX . "filter_option_value SET"
						. " option_id = '" . (int)$option_id . "',"
						//. " keyword = '" . $this->db->escape($option_value['keyword']) . "',"
						. " sort_order = '" . (int)$option_value['sort_order'] . "',"
						. " color = '" . $this->db->escape($option_value['color']) . "',"
						. " image = '" . $this->db->escape($option_value['image']) . "',"
						. " position = '" . $this->db->escape($option_value['position']) . "'");

					$option_value_id = $this->db->getLastId();

				} else {
					$this->db->query("UPDATE " . DB_PREFIX . "filter_option_value SET"
						. " option_id = '" . (int)$option_id . "',"
						. " keyword = '" . $this->db->escape($option_value['keyword']) . "',"
						. " sort_order = '" . (int)$option_value['sort_order'] . "',"
						. " color = '" . $this->db->escape($option_value['color']) . "',"
						. " image = '" . $this->db->escape($option_value['image']) . "',"
						. " position = '" . $this->db->escape($option_value['position']) . "'"
						. " WHERE option_value_id = '" . (int)$option_value['option_value_id'] . "'"
					);

					$option_value_id = $option_value['option_value_id'];
				}

				$option_value_keyword = '';
				foreach ($option_value['name'] as $language_id => $name) {
					if(isset($option_value['keyword'][$language_id]) && $option_value['keyword'][$language_id]){
						$option_value_keyword = $option_value['keyword'][$language_id];
						if (!$option_value_keyword && $name) {
							$option_value_keyword = $this->translate($name);
						}
					}
					$this->db->query("INSERT INTO " . DB_PREFIX . "filter_option_value_description SET option_id = '" . (int)$option_id . "', option_value_id = '" . (int)$option_value_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($name) . "' , keyword = '". $this->db->escape($option_value_keyword) ."' ");
				}

			}
		}
		$this->clearOptionCache($option_id);
		$this->clearCache();
	}

	public function deleteOption($option_id)
	{
		$this->db->query("DELETE FROM " . DB_PREFIX . "filter_option WHERE option_id = '" . (int)$option_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "filter_option_description WHERE option_id = '" . (int)$option_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "filter_option_value WHERE option_id = '" . (int)$option_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "filter_option_value_description WHERE option_id = '" . (int)$option_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "filter_option_to_category WHERE option_id = '" . (int)$option_id . "'");

		$this->clearOptionCache($option_id);
		$this->clearCache();
	}

	public function getOption($option_id)
	{
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "filter_option fo LEFT JOIN " . DB_PREFIX . "filter_option_description fod ON (fo.option_id = fod.option_id) WHERE fo.option_id = '" . (int)$option_id . "' AND fod.language_id = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->row;
	}

	public function getProductFilterOptions($product_id)
	{
		$sql = "SELECT option_id, option_value_id 
		          FROM " . DB_PREFIX . "filter_option_value_to_product 
		         WHERE product_id = '" . (int)$product_id . "'";

		$query = $this->db->query($sql);

		$options = array();
		foreach ($query->rows as $result) {
			if( !isset($options[$result['option_id']]) ) {
				$options[$result['option_id']] = array();
			}
			$options[$result['option_id']][] = $result['option_value_id'];
		}

		return $this->buildFilterParam($options);
	}

	public function getManufacturersOptions($category_id = 0){
		$sql  = "SELECT m.manufacturer_id, m.name ";
		$sql .= "  FROM `" . DB_PREFIX . "manufacturer` m ";
		if( $category_id > 0 ) {
			$sql .= " WHERE m.manufacturer_id IN ( SELECT p.manufacturer_id FROM `" . DB_PREFIX . "product` p INNER JOIN `" . DB_PREFIX . "product_to_category` p2c ON ( p.product_id = p2c.product_id AND p2c.category_id = '" . (int)$category_id . "' ) )";
		}
		$sql .= " ORDER BY m.name ASC ";
		$query = $this->db->query($sql);

		$result = array();
		foreach( $query->rows as $row ) {
			$result[$row['manufacturer_id']] = $row['name'];
		}

		return $result;
	}

	public function getFilterOptions($data = array())
	{
		$sql  = "SELECT fo.*, fod.name ";
		$sql .= "  FROM " . DB_PREFIX . "filter_option fo ";
		$sql .= "       LEFT JOIN " . DB_PREFIX . "filter_option_description fod ON (fo.option_id = fod.option_id) ";

		if (!empty($data['filter_category'])) {
			$sql .= " LEFT JOIN " . DB_PREFIX . "filter_option_to_category foc ON (fo.option_id = foc.option_id)";
		}

		$sql .= " WHERE fod.language_id = '" . (int)$this->config->get('config_language_id') . "'";

		if (!empty($data['filter_name'])) {
			$sql .= " AND fod.name LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
		}

		if (!empty($data['filter_keyword'])) {
			$sql .= " AND fod.keyword LIKE '" . $this->db->escape($data['filter_keyword']) . "'";
		}

		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
			$sql .= " AND fo.status='" . $this->db->escape($data['filter_status']) . "'";
		}

		if (!empty($data['filter_type'])) {
			$sql .= " AND fo.type LIKE '%" . $this->db->escape($data['filter_type']) . "%'";
		}

		if (!empty($data['filter_category'])) {
			$sql .= " AND foc.category_id = '" . (int)$data['filter_category'] . "'";
		}

		$sort_data = array(
			'fod.name',
			'fo.type',
			'fo.status',
			'fo.sort_order'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			if($data['sort'] == 'fo.sort_order') {
				$data['sort'] = "cast(" . $data['sort'] . " as unsigned)";
			}
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY fo.sort_order";
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

			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}

		$query = $this->db->query($sql);

		return $query->rows;
	}

	public function getOptionName($option_id)
	{
		$option_name = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "filter_option_description WHERE option_id = '" . (int)$option_id . "'");

		foreach ($query->rows as $result) {
			$option_name[$result['language_id']] = $result['name'];
		}

		return $option_name;
	}

	public function getOptionKeyword($option_id)
	{
		$option_keyword = array();

		$query = $this->db->query("SELECT fod.keyword, fo.keyword as old_keyword, fod.language_id FROM " . DB_PREFIX . "filter_option fo LEFT JOIN " . DB_PREFIX . "filter_option_description fod ON (fo.option_id = fod.option_id)  WHERE fo.option_id = '" . (int)$option_id . "'");

		foreach ($query->rows as $result) {
			if(!$result['keyword']){
				$option_keyword[$result['language_id']] = $result['old_keyword'];
			}else{
				$option_keyword[$result['language_id']] = $result['keyword'];
			}
		}

		return $option_keyword;
	}

	public function getTotalFilterOptions($data = array())
	{

		$sql = "SELECT COUNT(*) AS total FROM " . DB_PREFIX . "filter_option fo LEFT JOIN " . DB_PREFIX . "filter_option_description fod ON (fo.option_id = fod.option_id)";

		if (!empty($data['filter_category'])) {
			$sql .= " LEFT JOIN " . DB_PREFIX . "filter_option_to_category foc ON (fo.option_id = foc.option_id)";
			$sql .= " AND foc.category_id LIKE '%" . $this->db->escape($data['filter_category']) . "%'";
		}

		$sql .= " WHERE fod.language_id = '" . (int)$this->config->get('config_language_id') . "'";

		if (!empty($data['filter_name'])) {
			$sql .= " AND fod.name LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
		}

		if (!empty($data['filter_keyword'])) {
			$sql .= " AND fod.keyword LIKE '" . $this->db->escape($data['filter_keyword']) . "'";
		}

		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
			$sql .= " AND fo.status='" . $this->db->escape($data['filter_status']) . "'";
		}

		if (!empty($data['filter_type'])) {
			$sql .= " AND fo.type LIKE '%" . $this->db->escape($data['filter_type']) . "%'";
		}

		if (!empty($data['filter_category'])) {
			$sql .= " AND foc.category_id LIKE '%" . $this->db->escape($data['filter_category']) . "%'";
		}

		$sort_data = array(
			'fod.name',
			'fo.type',
			'fo.status',
			'fo.sort_order'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			if($data['sort'] == 'fo.sort_order') {
				$data['sort'] = "cast(" . $data['sort'] . " as unsigned)";
			}
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY fo.sort_order";
		}

		$query = $this->db->query($sql);

		return $query->row['total'];
	}

	public function getTotalProductsByOptionId($option_id)
	{
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "filter_option_value_to_product WHERE option_id = '" . (int)$option_id . "'");
		return $query->row['total'];
	}

	public function getOptionCategories($option_id)
	{
		$cateories = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "filter_option_to_category WHERE option_id = '" . (int)$option_id . "'");

		foreach ($query->rows as $result) {
			$cateories[] = $result['category_id'];
		}

		return $cateories;
	}

	public function getOptionValues($option_id)
	{
		$sql = "SELECT fov.option_value_id, fov.sort_order, fov.image, fov.position, fov.color, fovd.name, fovd.keyword, fov.keyword as old_keyword
				  FROM `" . DB_PREFIX . "filter_option_value` fov 
				       LEFT JOIN  `" . DB_PREFIX . "filter_option_value_description` fovd ON ( fov.option_value_id = fovd.option_value_id and fovd.language_id = '" . (int)$this->config->get('config_language_id') . "' ) 
				 WHERE fov.option_id = '" . (int)$option_id . "'
				 ORDER BY cast(fov.sort_order as unsigned) ASC";

		$query = $this->db->query($sql);
		if (!$query->num_rows) {
			return array();
		}
		$result = array();

		$count = 0;
		foreach ($query->rows as $row){
			$result[$count] = $row;
			if(!$row['keyword'] && $row['old_keyword']){
				$result[$count]['keyword'] = $row['old_keyword'];
			}
			$count++;
		}

		return $result;
	}

	public function getOptionValuesDescription($option_value_id, $language_id = false)
	{
		$option_values = array();

		$sql = "SELECT fovd.* FROM `" . DB_PREFIX . "filter_option_value` fov LEFT JOIN `" . DB_PREFIX . "filter_option_value_description` fovd ON (fov.option_value_id=fovd.option_value_id) WHERE fov.option_value_id = '" . (int)$option_value_id . "'";

		if ($language_id) {
			$sql .= " AND fovd.language_id = '" . (int)$language_id . "'";
		}

		$query = $this->db->query($sql);

		foreach ($query->rows as $result) {
			if ($language_id) {
				$option_values[$result['option_value_id']] = $result['name'];
			} else {
				$option_values[$result['language_id']] = $result['name'];
			}
		}

		return $option_values;
	}

	public function getOptionValuesKeyword($option_value_id, $language_id = false)
	{
		$option_values = array();

		$sql = "SELECT fovd.*,fov.keyword as old_keyword FROM `" . DB_PREFIX . "filter_option_value` fov LEFT JOIN `" . DB_PREFIX . "filter_option_value_description` fovd ON (fov.option_value_id=fovd.option_value_id) WHERE fov.option_value_id = '" . (int)$option_value_id . "'";

		if ($language_id) {
			$sql .= " AND fovd.language_id = '" . (int)$language_id . "'";
		}

		$query = $this->db->query($sql);

		$this->load->model('localisation/language');
		$languages = $this->model_localisation_language->getLanguages();

		foreach ($query->rows as $result) {
			if ($language_id) {
				$option_values[$result['option_value_id']] = $result['old_keyword'];
			} else {

				if(!$result['keyword'] && $result['old_keyword']){
					foreach ($languages as $language) {
						$option_values[$language['language_id']] = $result['old_keyword'];
					}
				}else{
					$option_values[$result['language_id']] = $result['keyword'];
				}
			}
		}

		return $option_values;
	}

	public function getOptionByKeyword($keyword)
	{
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "filter_option_description WHERE `keyword` = '" . $this->db->escape($keyword) . "' LIMIT 1");

		if(!$query->num_rows){
			$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "filter_option WHERE `keyword` = '" . $this->db->escape($keyword) . "' LIMIT 1");
		}

		return $query->num_rows ? $query->row['option_id'] : false;
	}

	public function getOptionByName($name)
	{
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "filter_option_description WHERE `name` = '" . $this->db->escape($name) . "' LIMIT 1");

		if(!$query->num_rows){
			$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "filter_option WHERE `keyword` = '" . $this->db->escape($name) . "' LIMIT 1");
		}

		return $query->num_rows ? $query->row['option_id'] : false;
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
			$filter_option = $this->db->query("SELECT option_id FROM " . DB_PREFIX . "filter_option_description WHERE keyword ='" . $this->db->escape($result) . "'");
			if (!$filter_option->num_rows) {
				$filter_option_value = $this->db->query("SELECT option_id FROM " . DB_PREFIX . "filter_option_value_description WHERE keyword ='" . $this->db->escape($result) . "'");
				if (!$filter_option_value->num_rows)
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

	public function explodeFilterParam($param)
	{

		// Мы всегда отсортируем опции и их значения согласно sort_order,
		// чтобы у нас не было миллиона дубликатов на пустом месте

		$options = array();
		$options_sorted = array();

		foreach (explode(self::OPTIONS_SEP, $param) as $filter_option) {
			// echo $filter_option . "<br>";
			$parts = explode(self::OPTION_VALUE_SEP, $filter_option);
			if (count($parts) != 2) {
				return "";
			}

			$option_id = $parts[0];
			if ($option_id != 'm' && !isset($this->options_to_keywords[$option_id])) {
				// echo "bad option_id: $option_id<br>";
				// var_dump($this->options);
				$this->log("warning: bad option_id: $option_id, full option list: " . print_r($this->options_to_keywords, true));
				//return "";
				continue;
			}

			$option_values = $parts[1];
			if ($option_id == 'p') {
				$options[$option_id] = $option_values;
				$options_sorted[$option_id] = $this->options_to_keywords[$option_id]['sort_order'];
				continue;
			}

			$option_values_sorted = array();
			foreach (explode(self::VALUES_SEP, $option_values) as $option_value_id) {
				if ($option_id == 'm') {
					if (!isset($this->manufacturers_to_keywords[-$option_value_id])) {
						//echo "bad manufacturer_id: $option_value_id<br>";
						$this->log("bad manufacturer_id: $option_value_id");
						continue;
					}
					$option_values_sorted[$option_value_id] = $this->manufacturers_to_keywords[-$option_value_id]['sort_order'];
					continue;
				}

				if (!isset($this->option_values_to_keywords[$option_value_id])) {
					//echo "bad option_value_id: $option_value_id<br>";
					$this->log("warning bad option_value_id: $option_value_id");
					//return "";
					continue;
				}
				$option_values_sorted[$option_value_id] = $this->option_values_to_keywords[$option_value_id]['sort_order'];
			}

			asort($option_values_sorted);
			$option_values = array_keys($option_values_sorted);

			$options[$option_id] = $option_values;
			$options_sorted[$option_id] = $this->options_to_keywords[$option_id]['sort_order'];
		}

		asort($options_sorted);
		foreach ($options as $option_id => $option_values) {
			$options_sorted[$option_id] = $option_values;
		}

		return $options_sorted;
	}

	public function buildFilterParam($options)
	{
		$nsf_path = '';
		foreach ($options as $option_id => $option_value_ids) {
			$values_path = implode(self::VALUES_SEP, $option_value_ids);
			if (!$values_path) {
				continue;
			}
			if ($nsf_path != '') {
				$nsf_path .= self::OPTIONS_SEP;
			}
			$nsf_path .= $option_id . self::OPTION_VALUE_SEP . $values_path;
		}

		return $nsf_path;
	}

	public function getFilterNames($param) {
		$options = $this->explodeFilterParam($param);

		$result = "";
		foreach($options as $option_id => $option_value_ids) {
			if( $result ) {
				$result .= self::OPTIONS_SEP . " " ;
			}

			$values = array();
			foreach ( $option_value_ids as $option_value_id ) {
				if( $option_value_id < 0 ) {
					$values[] = $this->manufacturers_names[-$option_value_id];
				} else {
					$values[] = $this->option_values_names[$option_value_id];
				}
			}


			$result .= $this->options_names[$option_id] . self::OPTION_VALUE_SEP . " " . implode(self::VALUES_SEP . " " , $values);
		}
		return $result;
	}



	public function copyAttributesFromProduct($product_id){

		$attributes = array();
		$sql = "SELECT attribute_id, language_id, text FROM `" . DB_PREFIX . "product_attribute` WHERE product_id = '" . (int)$product_id . "'";
		$query = $this->db->query($sql);
		foreach( $query->rows as $row ) {
			if( !isset($attributes[$row['attribute_id']]) ) {
				$attributes[$row['attribute_id']] = array();
			}

			$text = trim($row['text']);
			if( !$text ) {
				continue;
			}
			$attributes[$row['attribute_id']][$row['language_id']] = $text;
		}


		// Надо разбить атрибуты с + или , на составляющие
		$attributes2 = array();
		foreach( $attributes as $attribute_id => $attribute_data ) {
			foreach( $attribute_data as $language_id => $text ) {
				$texts_ = array();
				foreach( explode(",", str_replace(array("+",/*"-"*/),",",$text)) as $_text ) {
					$_text = trim($_text);
					if( !$_text ) {
						continue;
					}
					$texts_[$_text] = 1;
				}

				$i = 0;
				foreach ($texts_ as $text_ => $tmp) {
					$text_ = trim($text_);
					if (!$text_) {
						continue;
					}
					if( !isset($attributes2[$attribute_id . '_' . $i])) {
						$attributes2[$attribute_id . '_' . $i] = array(
							'attribute_id' => $attribute_id,
						);
					}
					$attributes2[$attribute_id . '_' . $i]["text"][$language_id] = $text_;
					$i++;
				}
			}
		}
		//$this->log("список атрибутов: " . print_r($attributes2,true));

		// Ищем опции, соответствующие атрибутам
		$filter_options = array();
		foreach( $attributes2 as $attribute_info ) {

			$attribute_id = $attribute_info['attribute_id'];
			$attribute_data = $attribute_info['text'];


			$attribute_names = array();
			$sql = "SELECT language_id, name FROM `" . DB_PREFIX . "attribute_description` WHERE attribute_id = '" . (int)$attribute_id . "'";
			$query = $this->db->query($sql);
			foreach( $query->rows as $row ) {
				$attribute_names[$row['language_id']]= $row['name'];
			}
			$filter_option_id = $this->getFilterOptionByNames($attribute_names);
			$filter_option_value_id = $this->getFilterOptionValueByNames($filter_option_id,$attribute_data);

			if( !isset($filter_options[$filter_option_id]) ) {
				$filter_options[$filter_option_id] = array();
			}
			$filter_options[$filter_option_id][] = $filter_option_value_id;
		}

		// Добавляем только недостающие
		foreach( $filter_options as $filter_option_id => $filter_option_value_ids ) {
			foreach ($filter_option_value_ids as $filter_option_value_id ) {
				$sql = "SELECT count(*) as cnt FROM `" . DB_PREFIX . "filter_option_value_to_product` WHERE product_id = '" . (int)$product_id . "' AND option_id = '" . (int)$filter_option_id . "' AND option_value_id = '" . (int)$filter_option_value_id . "'";
				$query = $this->db->query($sql);
				if( $query->row['cnt'] > 0 ) {
					// Такая опция уже есть, нефиг совать еще раз
					continue;
				}

				$sql = "INSERT INTO `" . DB_PREFIX . "filter_option_value_to_product` SET product_id = '" . (int)$product_id . "', option_id = '" . (int)$filter_option_id . "', option_value_id = '" . (int)$filter_option_value_id . "'";
				$this->db->query($sql);
			}
		}

	}


	public function copyAttributes()
	{
		$sql = "SELECT product_id FROM `" . DB_PREFIX . "product` ";
		$query = $this->db->query($sql);
		foreach( $query->rows as $row ) {
			$this->copyAttributesFromProduct($row['product_id']);
		}

		//$this->copyAttributesFromProduct(8132);

		$this->clearCache();
	}


	public function getFilterOptionByNames($names) {
		foreach( $names as $language_id => $name ) {
			$sql = "SELECT option_id FROM " . DB_PREFIX . "filter_option_description WHERE `name` = '" . $this->db->escape($name) . "' AND language_id = '" . (int)$language_id . "' LIMIT 1";
			$query = $this->db->query($sql);
			if( !$query->num_rows ) {
				$this->log("Опция с названием $name для языка $language_id не найдена");
				$this->log($sql);
				continue;
			}

			return (int)$query->row['option_id'];
		}

		$this->db->query("INSERT INTO " . DB_PREFIX . "filter_option SET "
			. "status = '1', "
			. "open = '1', "
			. "style = '', "
			. "type = 'checkbox', "
			. "sort_order = '0'");

		$option_id = $this->db->getLastId();

		foreach ($names as $language_id => $name) {
			$keyword = $this->translate($name);
			$this->db->query("INSERT INTO " . DB_PREFIX . "filter_option_description SET "
				. " option_id = '" . (int)$option_id . "', "
				. " language_id = '" . (int)$language_id . "', "
				. " name = '" . $this->db->escape($name) . "', "
				. " keyword = '". $this->db->escape($keyword) ."' ");
		}

		return $option_id;
	}

	public function getFilterOptionValueByNames($filter_option_id, $names) {
		foreach( $names as $language_id => $name ) {
			$sql = "SELECT option_value_id FROM " . DB_PREFIX . "filter_option_value_description WHERE option_id = " . (int)$filter_option_id . " AND `name` = '" . $this->db->escape($name) . "' AND language_id = '" . (int)$language_id . "' LIMIT 1";
			$query = $this->db->query($sql);
			if( !$query->num_rows ) {
				continue;
			}

			return (int)$query->row['option_value_id'];
		}

		$this->db->query("INSERT INTO " . DB_PREFIX . "filter_option_value SET "
			. "option_id = '" . (int)$filter_option_id . "', "
			. "sort_order = '0'");

		$filter_option_value_id = $this->db->getLastId();


		foreach ($names as $language_id => $name) {
			$keyword = $this->translate($name);
			$this->db->query("INSERT INTO " . DB_PREFIX . "filter_option_value_description SET "
				. " option_id = '" . (int)$filter_option_id . "', "
				. " option_value_id = '" . (int)$filter_option_value_id . "', "
				. " language_id = '" . (int)$language_id . "', "
				. " name = '" . $this->db->escape($name) . "', "
				. " keyword = '". $this->db->escape($keyword) ."' ");
		}

		return $filter_option_value_id;
	}


	public function getFilterOptionFromOption($option_id){
		$names = array();

		$sql = "SELECT language_id, name FROM `" . DB_PREFIX . "option_description` WHERE option_id = '" . (int)$option_id . "'";
		$query = $this->db->query($sql);
		foreach( $query->rows as $row ) {
			$names[$query->row['language_id']] = $row['name'];
		}

		return $this->getFilterOptionByNames($names);
	}

	public function getFilterOptionValueFromOptionValue($filter_option_id,$option_value_id){
		$names = array();

		$sql = "SELECT language_id, name FROM `" . DB_PREFIX . "option_value_description` WHERE option_value_id = '" . (int)$option_value_id . "'";
		$query = $this->db->query($sql);
		foreach( $query->rows as $row ) {
			$names[$query->row['language_id']] = $row['name'];
		}

		return $this->getFilterOptionValueByNames($filter_option_id,$names);
	}

	public function copyOptionsFromProduct($product_id){

		$options = array();

		$filter_option_values = array();

		$sql = "SELECT option_id, option_value_id FROM `" . DB_PREFIX . "product_option_value` WHERE product_id = '" . (int)$product_id . "'";
		$query = $this->db->query($sql);
		foreach( $query->rows as $row ) {
			$option_id = $row['option_id'];
			if( !isset($options[$option_id]) ) {
				$options[$option_id] = $this->getFilterOptionFromOption($option_id);
			}
			$filter_option_id = $options[$option_id];

			$option_value_id = $row['option_value_id'];
			$filter_option_value_id = $this->getFilterOptionValueFromOptionValue($filter_option_id,$option_value_id);

			if( !isset($filter_option_values[$filter_option_id])){
				$filter_option_values[$filter_option_id] = array();
			}
			$filter_option_values[$filter_option_id][] = $filter_option_value_id;
		}

		// Добавляем недостающие
		foreach( $filter_option_values as $filter_option_id => $filter_option_value_ids ) {
			foreach ($filter_option_value_ids as $filter_option_value_id ) {
				$sql = "SELECT count(*) as cnt FROM `" . DB_PREFIX . "filter_option_value_to_product` WHERE product_id = '" . (int)$product_id . "' AND option_id = '" . (int)$filter_option_id . "' AND option_value_id = '" . (int)$filter_option_value_id . "'";
				$query = $this->db->query($sql);
				if( $query->row['cnt'] > 0 ) {
					// Такая опция уже есть, нефиг совать еще раз
					continue;
				}

				$sql = "INSERT INTO `" . DB_PREFIX . "filter_option_value_to_product` SET product_id = '" . (int)$product_id . "', option_id = '" . (int)$filter_option_id . "', option_value_id = '" . (int)$filter_option_value_id . "'";
				$this->db->query($sql);
			}
		}


	}

	public function copyOptions()
	{
		$sql = "SELECT product_id FROM `" . DB_PREFIX . "product` ";
		$query = $this->db->query($sql);
		foreach( $query->rows as $row ) {
			$this->copyOptionsFromProduct($row['product_id']);
		}
		//$this->copyOptionsFromProduct(8132);

		$this->clearCache();
	}

	public function copyFromOcFilter(){
		//add check for ocfilter tables

		$sql = "SELECT * FROM `" . DB_PREFIX . "ocfilter_option` ";
		$query = $this->db->query($sql);

		$optionIdRelArray = [];
		$optionKeywordRelArray = [];
        $uniqueChunk = '';

		/* copy filter_option main table data */

		foreach( $query->rows as $row ) {

			$style = empty($row['color']) ? (empty($row['image']) ? '' : $row['image']) : $row['color'];

			$sql = "INSERT INTO `" . DB_PREFIX . "filter_option` SET type = '" . $row['type'] . "', status = '" . (int)$row['status'] . "', style = '" . $style . "', sort_order = '" . (int)$row['sort_order'] . "'";
			$this->db->query($sql);

			$new_option_id = $this->db->getLastId();

			$optionIdRelArray[ $row['option_id'] ] = $new_option_id;

            if (in_array($row['keyword'], $optionKeywordRelArray)){
                $uniqueChunk = '_' . $new_option_id;
            }

			$optionKeywordRelArray[ $row['option_id'] ] = $row['keyword'] . $uniqueChunk;
            $uniqueChunk = '';

		}

		/* copy option description and category relations */

		foreach($optionIdRelArray as $id => $data){
			$sql = "SELECT * FROM `" . DB_PREFIX . "ocfilter_option_description` WHERE option_id = '" . (int)$id . "' ";
			$query = $this->db->query($sql);

			foreach( $query->rows as $row ) {
				$sql = "INSERT INTO `" . DB_PREFIX . "filter_option_description` SET option_id = '" . (int)$data . "', language_id = '" . (int)$row['language_id'] . "', name = '" . $row['name'] . "', keyword = '" . $optionKeywordRelArray[$id] . "'";
				$this->db->query($sql);				
			}

			$sql = "SELECT * FROM `" . DB_PREFIX . "ocfilter_option_to_category` WHERE option_id = '" . (int)$id . "' ";
			$query = $this->db->query($sql);

			foreach( $query->rows as $row ) {
				$sql = "INSERT INTO `" . DB_PREFIX . "filter_option_to_category` SET option_id = '" . (int)$data . "', category_id = '" . (int)$row['category_id'] . "'";
				$this->db->query($sql);				
			}

		}

		/* copy option value main table data */

		$sql = "SELECT oov.* FROM `" . DB_PREFIX . "ocfilter_option` oo LEFT JOIN  `" . DB_PREFIX . "ocfilter_option_value` oov ON oo.option_id = oov.option_id ";
		$query = $this->db->query($sql);

		$optionValueIdRelArray = [];	
		$optionValueIdKeywordArray = [];

		foreach( $query->rows as $row ) {

			$sql = "INSERT INTO `" . DB_PREFIX . "filter_option_value` SET option_id = '" . (int)$optionIdRelArray[$row['option_id']] . "', color = '" . $row['color'] . "', image = '" . $row['image'] . "', sort_order = '" . (int)$row['sort_order'] . "'";
			$this->db->query($sql);

			$new_option_value_id = $this->db->getLastId();

			$optionValueIdRelArray[ $row['value_id'] ] = $new_option_value_id;
			$optionValueIdKeywordArray[ $row['value_id'] ] = $row['keyword'];

		}	

		/* copy option value description */

		foreach($optionValueIdRelArray as $id => $data){

			$sql = "SELECT * FROM `" . DB_PREFIX . "ocfilter_option_value_description` WHERE value_id = '" . (int)$id . "' ";

			$query = $this->db->query($sql);

			foreach( $query->rows as $row ) {
				$sql = "INSERT INTO `" . DB_PREFIX . "filter_option_value_description` SET option_value_id = '" . (int)$data . "', option_id = '" . (int)$optionIdRelArray[$row['option_id']] . "', language_id = '" . (int)$row['language_id'] . "', name = '" . $row['name'] . "', keyword = '" . $optionValueIdKeywordArray[$id] . "'";
				$this->db->query($sql);				
			}

		}

		/* copy product option value */

		$sql = "SELECT * FROM `" . DB_PREFIX . "ocfilter_option_value_to_product`";
		$query = $this->db->query($sql);	

		foreach( $query->rows as $row ) {
			$sql = "INSERT INTO `" . DB_PREFIX . "filter_option_value_to_product` SET option_value_id = '" . (int)$optionValueIdRelArray[$row['value_id']] . "', option_id = '" . (int)$optionIdRelArray[$row['option_id']] . "', product_id = '" . (int)$row['product_id'] . "'";
			$this->db->query($sql);				
		}	

	}

	public function clearFilterOptionsByProduct ($product_id){
		$sql = "DELETE FROM`" . DB_PREFIX . "filter_option_value_to_product` WHERE product_id = '" . (int)$product_id . "'";
		$this->db->query($sql);
	}

	public function clearFilterOptions(){
		$sql = "SELECT product_id FROM `" . DB_PREFIX . "product` ";
		$query = $this->db->query($sql);
		foreach( $query->rows as $row ) {
			$this->clearFilterOptionsByProduct($row['product_id']);
		}

		$this->clearCache();
	}

}