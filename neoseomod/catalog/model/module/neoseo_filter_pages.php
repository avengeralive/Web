<?php

require_once( DIR_SYSTEM . "/engine/neoseo_model.php");

class ModelModuleNeoSeoFilterPages extends NeoSeoModel
{

	public function __construct($registry)
	{
		parent::__construct($registry);
		$this->_moduleSysName = "neoseo_filter_pages";
		$this->_logFile = $this->_moduleSysName . ".log";
		$this->debug = $this->config->get($this->_moduleSysName . "_debug");
	}


	public function getPage($page_id)
	{
		$result = array();
		$sql = "SELECT *, fp.keyword ,fpd.keyword as page_keyword
	              FROM " . DB_PREFIX . "filter_page fp 
	                   LEFT JOIN " . DB_PREFIX . "filter_page_description fpd ON (fp.page_id = fpd.page_id AND fpd.language_id = '" . (int) $this->config->get('config_language_id') . "') 
	             WHERE fp.page_id = '" . (int) $page_id . "'";

		$query = $this->db->query($sql);

		if(!$query->num_rows) {
			return $result;
		}

		$row = $query->row;
//print_r($row['keyword']);
		if(!$row['page_keyword']){
			$row['page_keyword'] = $row['keyword'];
		}

		$result['page_id'] = $row['page_id'];
		$result['status'] = $row['status'];
		$result['category_id'] = $row['category_id'];
		$result['options'] = $row['options'];
		$result['keyword'] = $row['page_keyword'];

		$result['title'] = $row['title'];
		$result['description'] = $row['description'];
		$result['h1'] = $row['h1'];
		$result['meta_keywords'] = $row['meta_keywords'];
		$result['meta_description'] = $row['meta_description'];

		return $result;
	}



}
