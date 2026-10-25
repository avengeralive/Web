<?php

require_once( DIR_SYSTEM . "/engine/neoseo_model.php");

class ModelModuleNeoSeoFilter extends NeoSeoModel
{
	const OPTION_VALUE_SEP = ':';
	const VALUES_SEP = ',';
	const OPTIONS_SEP = ';';

	private $options_names = array();
	private $options_to_keywords = null;
	private $keywords_to_options = null;

	private $manufacturers_names = array();
	private $manufacturers_to_keywords = null;
	private $keywords_to_manufacturers = null;

	private $option_values_names = array();
	private $option_values_to_keywords = null;
	private $keywords_to_option_values = null;

	private $option_values_to_options = null;

	private $pages_to_keywords = null;
	private $keywords_to_pages = null;

	public $category_prices = null;
	private $use_cache = false;

	public function __construct($registry)
	{
		parent::__construct($registry);
		$this->_moduleSysName = "neoseo_filter";
		$this->_logFile = $this->_moduleSysName . ".log";
		$this->debug = $this->config->get($this->_moduleSysName . "_debug");
		$this->use_cache = $this->config->get($this->_moduleSysName . "_use_cache");
		$this->use_discount = $this->config->get($this->_moduleSysName . "_use_discount");
		$this->use_special = $this->config->get($this->_moduleSysName . "_use_special");
		//$stack = debug_backtrace();
		//$dump = '';
		//foreach( $stack as $info ) {
		//	$dump .= "\n" . $info['file'] . "#" . $info['line'] . "\n" . $info['class'] . "::" . $info['function'] . "\n----";
		//}
		//$this->log("init \nВызвано из ". $dump . "\n");
		$this->initOptionsData();
		$this->initOptionValuesData();
		$this->initManufacturersData();
		$this->initPagesData();
	}

	private function initOptionsData(){

		$this->options_names = $this->cache->get('neoseo_filter_on_' . (int) $this->config->get('config_language_id'));
		$this->options_to_keywords = $this->cache->get('neoseo_filter_o2k_' . (int) $this->config->get('config_language_id'));
		$this->keywords_to_options = $this->cache->get('neoseo_filter_k2o_' . (int) $this->config->get('config_language_id'));

		if (!$this->options_to_keywords || !$this->keywords_to_options || !$this->options_names ) {

			$this->options_names = array();
			$this->options_to_keywords = array();
			$this->keywords_to_options = array();

			$sql = "SELECT fo.option_id, fo.sort_order, fod.keyword, fo.keyword as old_keyword, fod.name 
			          FROM `" . DB_PREFIX . "filter_option` fo
			               LEFT JOIN `" . DB_PREFIX . "filter_option_description` fod ON ( fo.option_id = fod.option_id AND fod.language_id = '" . (int) $this->config->get('config_language_id') . "') 
			         ORDER BY cast(fo.sort_order as unsigned) ASC";

			$query = $this->db->query($sql);
			foreach( $query->rows as $row ) {

				$this->options_names[$row['option_id']] = $row['name'];

				if( !$row['keyword'] ) {
					if( !$row['old_keyword'] ) {
						continue;
					}else{
						$row['keyword'] = $row['old_keyword'];
					}
				}
				$this->keywords_to_options[$row['keyword']] = $row['option_id'];
				$this->options_to_keywords[$row['option_id']] = array(
					'keyword' => $row['keyword'],
					'sort_order' => $row['sort_order']
				);
			}

			if($this->config->get('neoseo_filter_price_url')){
				$priceUrl = $this->config->get('neoseo_filter_price_url');
				$priceUrl = $priceUrl[$this->config->get('config_language_id')];
			}else{
				$priceUrl = 'price';
			}

			$this->keywords_to_options[$priceUrl] = 'p';
			$this->options_to_keywords['p'] = array(
				'keyword' => $priceUrl,
				'sort_order' => '999999',
			);


			if($this->config->get('neoseo_filter_manufacturer_url')){
				$manUrl = $this->config->get('neoseo_filter_manufacturer_url');
				$manUrl = $manUrl[$this->config->get('config_language_id')];
			}else{
				$manUrl = 'proizvoditel';
			}
			$this->keywords_to_options[$manUrl] = 'm';
			$this->options_to_keywords['m'] = array(
				'keyword' => $manUrl,
				'sort_order' => '-1',
			);

			$this->cache->set('neoseo_filter_on_' . (int) $this->config->get('config_language_id'), $this->options_names);
			$this->cache->set('neoseo_filter_o2k_' . (int) $this->config->get('config_language_id'), $this->options_to_keywords);
			$this->cache->set('neoseo_filter_k2o_' . (int) $this->config->get('config_language_id'), $this->keywords_to_options);
		}

	}

	private function initOptionValuesData(){

		$this->option_values_names = $this->cache->get('neoseo_filter_ovn_' . (int) $this->config->get('config_language_id'));
		$this->option_values_to_keywords = $this->cache->get('neoseo_filter_ov2k_' . (int) $this->config->get('config_language_id'));
		$this->keywords_to_option_values = $this->cache->get('neoseo_filter_k2ov_' . (int) $this->config->get('config_language_id'));

		if ( !$this->option_values_to_keywords || !$this->keywords_to_option_values || !$this->option_values_names) {

			$this->option_values_names = array();
			$this->option_values_to_keywords = array();
			$this->keywords_to_option_values = array();

			$sql = "SELECT fov.option_value_id, fov.sort_order, fovd.keyword, fov.keyword as old_keyword,  fovd.name 
			          FROM `" . DB_PREFIX . "filter_option_value` fov
			               LEFT JOIN `" . DB_PREFIX . "filter_option_value_description` fovd ON ( fov.option_value_id = fovd.option_value_id AND fovd.language_id = '" . (int) $this->config->get('config_language_id') . "')
			         ORDER BY cast(fov.sort_order as unsigned) ASC";
			$query = $this->db->query($sql);
			foreach( $query->rows as $row ) {

				$this->option_values_names[$row['option_value_id']] = $row['name'];

				if( !$row['keyword'] ) {
					if( !$row['old_keyword'] ) {
						continue;
					}else{
						$row['keyword'] = $row['old_keyword'];
					}
				}

				$this->keywords_to_option_values[ $row['keyword'] ] = $row['option_value_id'];
				$this->option_values_to_keywords[ $row['option_value_id'] ] = array(
					'keyword' => $row['keyword'],
					'sort_order' => $row['sort_order']
				);

			}

			$this->cache->set('neoseo_filter_ovn_' . (int) $this->config->get('config_language_id'), $this->option_values_names);
			$this->cache->set('neoseo_filter_ov2k_' . (int) $this->config->get('config_language_id'), $this->option_values_to_keywords);
			$this->cache->set('neoseo_filter_k2ov_' . (int) $this->config->get('config_language_id'), $this->keywords_to_option_values);
		}

		$this->option_values_to_options = $this->cache->get('neoseo_filter_ov2o');
		if( !$this->option_values_to_options ) {
			$this->option_values_to_options = array();

			$sql = "SELECT fov.option_id, fov.option_value_id 
			          FROM `" . DB_PREFIX . "filter_option_value` fov";
			$query = $this->db->query($sql);
			foreach( $query->rows as $row ) {

				$this->option_values_to_options[$row['option_value_id']] = $row['option_id'];

			}

			$this->cache->set('neoseo_filter_ov2o', $this->option_values_to_options);
		}

	}

	private function initManufacturersData(){

		$this->manufacturers_names = $this->cache->get('neoseo_filter_om_' . (int) $this->config->get('config_language_id'));
		if($this->config->get('neoseo_seo_multistore_status') ) {
			$this->manufacturers_to_keywords = $this->cache->get('neoseo_filter_m2k_' . (int) $this->config->get('config_language_id'));
		}else{
			$this->manufacturers_to_keywords = $this->cache->get('neoseo_filter_m2k');
		}
		$this->keywords_to_manufacturers = $this->cache->get('neoseo_filter_k2m_' . (int) $this->config->get('config_language_id'));

		if ( !$this->manufacturers_to_keywords || !$this->keywords_to_manufacturers || !$this->manufacturers_names ) {

			$this->manufacturers_names = array();

			$manufacturers_sort_orders = array();
			$sql = "SELECT m.manufacturer_id, m.`sort_order`, md.name 
			          FROM `" . DB_PREFIX . "manufacturer` m
			               LEFT JOIN `" . DB_PREFIX . "manufacturer_description` md ON ( m.manufacturer_id = md.manufacturer_id AND md.language_id = '" . (int) $this->config->get('config_language_id') . "')";
			$query = $this->db->query($sql);
			foreach( $query->rows as $row ) {
				$this->manufacturers_names[(int)$row['manufacturer_id']] = $row['name'];
				$manufacturers_sort_orders[(int)$row['manufacturer_id']] = (int)$row['sort_order'];
			}
			$this->cache->set('neoseo_filter_om_' . (int) $this->config->get('config_language_id'), $this->manufacturers_names);

			$this->manufacturers_to_keywords = array();
			$this->keywords_to_manufacturers = array();

			$manufacturer_sql_lang = '';
			$manufacturer_keyword_lang = array();
			if($this->config->get('neoseo_seo_multistore_status') ){
				$manufacturer_sql_lang = " AND language_id = '" . (int) $this->config->get('config_language_id') . "' ";
				$query_lang = $this->query("SELECT `query`, keyword, language_id FROM " . DB_PREFIX . "url_alias WHERE query like 'manufacturer_id=%' " . $manufacturer_sql_lang);
				foreach( $query_lang->rows as $row ) {
					$manufacturer_id = str_replace("manufacturer_id=","",$row['query']);
					$manufacturer_keyword_lang[$manufacturer_id] = $row['keyword'];
					if( !isset($manufacturers_sort_orders[$manufacturer_id]) ) {
						continue;
					}

					$this->keywords_to_manufacturers[$row['keyword']] = $manufacturer_id;
					$this->manufacturers_to_keywords[$manufacturer_id] = array(
						'keyword' => $row['keyword'],
						'sort_order' => $manufacturers_sort_orders[$manufacturer_id]
					);
				}
			}



			$query = $this->db->query("SELECT `query`, keyword FROM " . DB_PREFIX . "url_alias WHERE query like 'manufacturer_id=%' " );
			foreach( $query->rows as $row ) {
				$manufacturer_id = str_replace("manufacturer_id=","",$row['query']);

				if( !isset($manufacturers_sort_orders[$manufacturer_id]) ) {
					continue;
				}

				if(isset($manufacturer_keyword_lang[$manufacturer_id])){
					continue;
				}

				$this->keywords_to_manufacturers[$row['keyword']] = $manufacturer_id;
				$this->manufacturers_to_keywords[$manufacturer_id] = array(
					'keyword' => $row['keyword'],
					'sort_order' => $manufacturers_sort_orders[$manufacturer_id]
				);
			}

			$this->cache->set('neoseo_filter_m2k_' . (int) $this->config->get('config_language_id'), $this->manufacturers_to_keywords);
			$this->cache->set('neoseo_filter_k2m_' . (int) $this->config->get('config_language_id'), $this->keywords_to_manufacturers);
		}
//print_r($this->manufacturers_to_keywords);
	}

	private function initPagesData(){

		$this->pages_to_keywords = $this->cache->get('neoseo_filter_p2k'. (int) $this->config->get('config_language_id'));
		$this->keywords_to_pages = $this->cache->get('neoseo_filter_k2p'. (int) $this->config->get('config_language_id'));

		if ( !$this->pages_to_keywords || !$this->keywords_to_pages ) {

			$this->pages_to_keywords = array();
			$this->keywords_to_pages = array();

			$query = $this->db->query("SELECT fp.page_id, fp.category_id, fp.options, fpd.keyword, fp.keyword as old_keyword FROM " . DB_PREFIX . "filter_page fp LEFT JOIN " . DB_PREFIX . "filter_page_description fpd ON (fp.page_id = fpd.page_id AND fpd.language_id = '" . (int) $this->config->get('config_language_id') . "')");
			foreach( $query->rows as $row ) {
				if( !$row['keyword'] ) {
					if( !$row['old_keyword'] ) {
						continue;
					}else{
						$row['keyword'] = $row['old_keyword'];
					}
				}

				$this->keywords_to_pages[$row['keyword']] = array(
					'category_id' => $row['category_id'],
					'options' => $row['options'],
					'page_id' => $row['page_id'],
				);

				$this->pages_to_keywords[$row['options']][$row['category_id']] = $row['keyword'];
			}

			$this->cache->set('neoseo_filter_p2k'. (int) $this->config->get('config_language_id'), $this->pages_to_keywords);
			$this->cache->set('neoseo_filter_k2p'. (int) $this->config->get('config_language_id'), $this->keywords_to_pages);
		}

	}

	public function getCategoryPrices($category_id){
		if( $this->use_cache ) {
			// Кеш будет периодически сбрасываться, например при изменении товара
			$sql = "SELECT min_price, max_price FROM " . DB_PREFIX . "filter_category_cache WHERE category_id = " . (int)$category_id;
			$query = $this->query($sql);
			if ($query->num_rows) {
				return $query->row;
			}
		}

		$sql = "SELECT min(p.price) as min_price, max(p.price) as max_price 
					  FROM `" . DB_PREFIX . "product` p
						   INNER JOIN `" . DB_PREFIX . "product_to_category` p2c ON ( p2c.product_id = p.product_id AND p2c.category_id = '" . (int)$category_id. "')";
		$query = $this->query($sql);

		$min_price = floatval($query->row['min_price']);

		$max_price = floatval($query->row['max_price']);

		if ( $this->use_special ) {
			$sql = "SELECT min(p.price) as min_price, max(p.price) as max_price 
					  FROM `" . DB_PREFIX . "product_special` p
						   INNER JOIN `" . DB_PREFIX . "product_to_category` p2c ON ( p2c.product_id = p.product_id AND p2c.category_id = '" . (int)$category_id. "')";
			$query = $this->query($sql);

			$min_price_2 = floatval($query->row['min_price']);
			if( $min_price_2 < $min_price ) {
				$min_price = $min_price_2;
			}

			$max_price_2 = floatval($query->row['max_price']);
			if( $max_price_2 > $max_price ) {
				$max_price = $max_price_2;
			}
		}

		if( $this->use_cache ) {
			$sql = "INSERT INTO " . DB_PREFIX . "filter_category_cache SET category_id = '" . (int)$category_id . "', min_price = '" . floatval($min_price) . "', max_price = '" . floatval($max_price) . "'";
			$this->query($sql);
		}

		return array(
			"min_price" => $min_price,
			"max_price" => $max_price,
		);
	}

	public function getUrl( $selected_options, $option_id, $option_value_id, $selected ){

		//$this->log("getUrl('" . print_r($selected_options,true) . "', $option_id, $option_value_id,$selected)");
		$route = 'product/category';
		$parts = array();
		foreach( $this->request->get as $key => $value ) {
			if( $key == 'nsf' || $key == '_route_') {
				continue;
			}
			if( $key == 'route' ) {
				$route = $value;
				continue;
			}
			$parts[$key] = $value;
		}

		// Для начала клонируем массив
		$new_selected_options = array();
		foreach($selected_options as $selected_option_id => $selected_option_value_ids) {
			$new_selected_options[$selected_option_id] = array();
			foreach( $selected_option_value_ids as $selected_option_value_id => $tmp ) {
				$new_selected_options[$selected_option_id][$selected_option_value_id] = 1;
			}
		}

		if( $selected ) {
			// Опция выбрана, надо исключить ее
			if( isset($selected_options[$option_id]) && isset($selected_options[$option_id][$option_value_id]) ) {
				// Эта опция включена, отключаем ее
				unset($new_selected_options[$option_id][$option_value_id]);
				if( count($new_selected_options[$option_id]) == 0) {
					// Это было последнее значение опции, отключаем целиком
					unset($new_selected_options[$option_id]);
				}
			}
		} else {
			// Опция не выбрана, надо ее включить
			if( !isset($new_selected_options[$option_id]) ) {
				$new_selected_options[$option_id] = array();
			}
			$new_selected_options[$option_id][$option_value_id] = 1;
		}

		// Теперь приводим массив к обычному виду
		$new_selected_options2 = array();
		foreach( $new_selected_options as $option_id => $option_values) {
			$new_selected_options2[$option_id] = array_keys($option_values);
		}

		// Финальный аккорд
		$nsf_path = $this->buildFilterParam($new_selected_options2);
		if( $nsf_path ) {
			$parts['nsf'] = $nsf_path;
		}

		$query = urldecode(http_build_query($parts));
		$url = urldecode($this->url->link($route, $query));

		$url = $this->makeRelativeUrl($url);

		return $url;
	}


	private function makeRelativeUrl($url){
		// Убираем домен в начале ссылки, чтобы получить относительную ссылку
		// С относительными работать удобнее, в частности при копировании кеша
		// с одной демки на другую

		$this->load->model('setting/store');
		$stores = array();
		$stores[0] = array(
			"url" => rtrim(HTTP_CATALOG, "/") . "/");
		foreach ($this->model_setting_store->getStores() as $store) {
			$stores[$store['store_id']] = array(
				"url" => rtrim($store["url"], "/") . "/");
		}
		$domain = $stores[$this->config->get('config_store_id')]['url'];
		//$domain = HTTP_SERVER;

		$domain = str_replace("https://","",$domain);
		$domain = str_replace("http://","",$domain);
		$domain = trim($domain, "/");

		$url = str_replace("https://","",$url);
		$url = str_replace("http://","",$url);
		$url = str_replace($domain,"",$url);

		$url = str_replace($domain,"",$url);
		$url = ltrim($url,"/");
		$url = "/" . $url;

		return $url;
	}

	private function explodeFilterParam($param){

		// Мы всегда отсортируем опции и их значения согласно sort_order,
		// чтобы у нас не было миллиона дубликатов на пустом месте

		$options = array();
		$options_sorted = array();

		foreach( explode(self::OPTIONS_SEP, $param ) as $filter_option ) {
			// echo $filter_option . "<br>";
			$parts = explode(self::OPTION_VALUE_SEP,$filter_option);
			if( count($parts) != 2 ) {
				return array();
			}

			$option_id = $parts[0];
			if( !isset($this->options_to_keywords[$option_id])) {
				// echo "bad option_id: $option_id<br>";
				// var_dump($this->options);
				$this->log("bad option_id: $option_id, full option list: " . print_r($this->options,true));
				return array();
			}

			$option_values = $parts[1];
			if( $option_id == 'p' ) {
				$options[$option_id] = $option_values;
				$options_sorted[$option_id] = $this->options_to_keywords[$option_id]['sort_order'];
				continue;
			}

			$option_values_sorted = array();
			foreach( explode(self::VALUES_SEP, $option_values) as $option_value_id ){
				if ($option_id == 'm') {
					$manufacturer_id = -$option_value_id;
					if( !isset($this->manufacturers_to_keywords[$manufacturer_id])) {
						//echo "bad manufacturer_id: $option_value_id<br>";
						$this->log("bad manufacturer_id: $manufacturer_id");
						continue;
					}
					$option_values_sorted[$option_value_id] = $this->manufacturers_to_keywords[$manufacturer_id]['sort_order'];
					continue;
				}

				if( !isset($this->option_values_to_keywords[$option_value_id]) ) {
					//echo "bad option_value_id: $option_value_id<br>";
					$this->log("bad option_value_id: $option_value_id");
					return array();
				}
				$option_values_sorted[$option_value_id] = $this->option_values_to_keywords[$option_value_id]['sort_order'];
			}

			asort($option_values_sorted);
			$option_values = array_keys($option_values_sorted);

			$options[$option_id] = $option_values;
			$options_sorted[$option_id] = $this->options_to_keywords[$option_id]['sort_order'];
		}

		asort($options_sorted);
		foreach( $options as $option_id => $option_values ) {
			$options_sorted[$option_id] = $option_values;
		}

		return $options_sorted;
	}

	private function buildFilterParam($options){
		$nsf_path = '';
		foreach($options as $option_id => $option_value_ids ) {
			if( $option_id === 'p' ) {
				if( $nsf_path != '') {
					$nsf_path .= self::OPTIONS_SEP;
				}
				$nsf_path .= $option_id . self::OPTION_VALUE_SEP . $option_value_ids[0];
				// Это надо в конце
				continue;
			}
			$values_path = implode(self::VALUES_SEP, $option_value_ids);
			if( !$values_path ) {
				continue;
			}
			if( $nsf_path != '') {
				$nsf_path .= self::OPTIONS_SEP;
			}
			$nsf_path .= $option_id . self::OPTION_VALUE_SEP . $values_path;
		}

		return $nsf_path;
	}


	public function getFilterParamFromUrlParts(&$parts){

		$options = array();

		foreach ($parts as $key => $keyword) {

			if( isset( $this->keywords_to_pages[$keyword]) ) {
				// Если попалась посадочная страница, то тут
				// больше делать нечего
				unset($parts[$key]);
				return $this->keywords_to_pages[$keyword]['options'];
			}

			if (false === strpos($keyword, self::OPTION_VALUE_SEP)) {
				// Не фильтр
				continue;
			}


			$keyword_parts = explode(self::OPTION_VALUE_SEP, $keyword );
			if( count($keyword_parts) != 2 ) {
				// Возможно не фильтр, возможно кто-то по неопытности воткнул двоеточие в чпу
				// echo "bad filter keyword: $keyword<br>";
				$this->log("bad filter keyword: $keyword");
				continue;
			}

			$option_keyword = $keyword_parts[0];
			if( !isset($this->keywords_to_options[$option_keyword])) {
				// Возможно не фильтр, возможно кто-то по неопытности воткнул двоеточие в чпу
				//echo "bad option keyword: $keyword<br>";
				$this->log("bad option keyword: $keyword");
				continue;
			}


			$option_id = $this->keywords_to_options[$option_keyword];
			if( $option_id == 'p' ) {
				// Фильтр по цене
				$options[] = "$option_id:" . $keyword_parts[1];
				unset($parts[$key]);
				continue;
			}

			$values_keywords = $keyword_parts[1];
			$values = array();
			$failed = false;
			foreach(explode(",", $values_keywords) as $value_keyword) {
				if ($option_id == 'm') {
					if (!isset($this->keywords_to_manufacturers[$value_keyword])) {
						// Возможно не фильтр, возможно кто-то по неопытности воткнул двоеточие в чпу
						$this->log("bad option value keyword: $value_keyword");
						$failed = true;
						continue;
					}
					$values[] = -$this->keywords_to_manufacturers[$value_keyword];
					continue;
				}

				if (!isset($this->keywords_to_option_values[$value_keyword])) {
					// Возможно не фильтр, возможно кто-то по неопытности воткнул двоеточие и запятую в чпу
					//echo "bad option value keyword: $keyword<br>";
					$this->log("bad option value keyword: $value_keyword");
					$failed = true;
					continue;
				}

				$values[] = $this->keywords_to_option_values[$value_keyword];
			}

			if( $failed ) {
				// Возможно не фильтр, возможно кто-то по неопытности воткнул двоеточие в чпу
				continue;
			}

			$options[] = $option_id . self::OPTION_VALUE_SEP . implode(self::VALUES_SEP, $values);
			unset($parts[$key]);
		}

		return implode(self::OPTIONS_SEP, $options);
	}

	public function getSeoUrl($nsf, $category_id) {
		// У нас есть масса вариантов реализации seoUrl, но поскольку первыми нашими клиентами на фильтр
		// будут именно наши клиенты, у которых уже стоит ocFilter, то нужно произвести замену так,
		// чтобы не пришлось делать карты редиректов и проходить прочие муки ада.
		// Все должно быть максимально быстро и безболезенно. А потому берем ту же схему что и у ocfilter
		// /dlina-spinninga:ot-150-do-180/proizvoditel:abu-garcia,banax
		// Единственное исключение - посадочные страницы. Ранее они шли сразу после названия сайта, теперь
		// будут идти после чпу категории. Причина - меньше хаков на уровне чпу системы


		$options = $this->explodeFilterParam($nsf);

		// Надо проверить а нет ли случаем такой страницы
		$param = $this->buildFilterParam($options);
		if( isset($this->pages_to_keywords[$param]) && isset($this->pages_to_keywords[$param][$category_id])) {
			// Такой комбинации опций отвечает посадочная страница
			return 	$this->pages_to_keywords[$param][$category_id];
		}

		// Посадочной страницы нет, пробуем собрать все в чпу
		$seo_url = '';
		foreach( $options as $option_id => $option_values ) {
			$seo_url .= $this->options_to_keywords[$option_id]['keyword'];
			$seo_url .= self::OPTION_VALUE_SEP;
			if( $option_id == 'p' ) {
				$seo_url .= $option_values;
				continue;
			}

			$values = array();
			foreach( $option_values as $option_value_id ) {

				if ($option_id == 'm') {
					$manufacturer_id = -$option_value_id;
					$values[] = $this->manufacturers_to_keywords[$manufacturer_id]['keyword'];
					continue;
				}

				$values[] = $this->option_values_to_keywords[$option_value_id]['keyword'];
			}

			$seo_url .= implode(self::VALUES_SEP, $values);
			$seo_url .= "/";
		}

		return $seo_url;
	}

	public function getSelectedOptions($real_options){
		// Формат &nsf=12:12,12,12;12:12,12,12
		$selected_options = array();
		if (!isset($this->request->get['nsf'])) {
			return $selected_options;
		}

		$options = explode(self::OPTIONS_SEP, (string)$this->request->get['nsf']);
		foreach( $options as $option ) {
			$parts = explode(self::OPTION_VALUE_SEP, $option);
			if( count($parts) != 2 ) {
				continue;
			}
			if( $parts[0] === 'p') {
				$selected_options['p'][$parts[1]] = 1;
				continue;
			}

			$option_id = $parts[0];
			if( !isset($real_options[$option_id])) {
				// Такой опции уже нет
				continue;
			}

			$option_values_ids = explode(self::VALUES_SEP, $parts[1] );

			foreach( $option_values_ids as $option_value_id ) {
				if( !isset($real_options[$option_id]['values'][$option_value_id ])) {
					// Такого значения опции уже нет
					continue;
				}
				if( !isset($selected_options[$option_id]) ) {
					$selected_options[$option_id] = array();
				}
				$selected_options[$option_id][(int)$option_value_id] = 1;
			}
		}

		return $selected_options;
	}

	protected function getOptionValues($option_id) {

		// Идеальный вариант кеша - число закешированных значений не превысит
		// число опций, умноженное на количество языков в системе
		// Такой кеш легко сбрасывать в процессе редактирования опций,
		// потому что мы знаем какие варианты значений имеются
		$cache_key = "neoseo_filter_ov_" . (int)$this->config->get('config_language_id') . "_" . (int)$option_id;
		$option_values = $this->cache->get( $cache_key );
		if( !$option_values ) {
			$sql = "SELECT fov.option_value_id, fovd.keyword, fov.keyword as old_keyword, fov.color, fov.image, fov.position, fovd.name
					  FROM " . DB_PREFIX . "filter_option_value fov
						   LEFT JOIN " . DB_PREFIX . "filter_option_value_description fovd ON (fov.option_value_id = fovd.option_value_id)
					 WHERE fov.option_id = " . (int)$option_id .  "
					   AND fovd.language_id = '" . (int) $this->config->get('config_language_id') . "'
					 ORDER BY cast(fov.sort_order as unsigned) ASC		         
					";

			$query = $this->query($sql);

			$option_values = array();
			foreach( $query->rows as $option_value ) {
				if(!$option_value['keyword']){
					if($option_value['old_keyword']){
						$option_value['keyword'] = $option_value['old_keyword'];
					}
				}
				$option_value['selected'] = 0;
				$option_value['href'] = "";
				unset($option_value['old_keyword']);
				$option_values[$option_value['option_value_id']] = $option_value;
			}

			$this->cache->set( $cache_key, $option_values );
		}

		return $option_values;
	}

	public function getActiveOptionValues($category_id) {
		// При работе с брейном замечен один важный мать его нюанс
		// Заключается в том, что реально в брейне есть 20к опций на категорию
		// но к товарам привязано всего 2 сотни. Соответственно, чтобы не делать потом
		// вычисления для всех 20к опций, мы лучше сразу выберем активные и будем работать с ними
		$sql = "SELECT DISTINCT option_value_id 
		          FROM `" . DB_PREFIX . "filter_option_value_to_product` fov2p 
		               INNER JOIN `" . DB_PREFIX . "product_to_category` p2c 
		                  ON fov2p.product_id = p2c.product_id 
		         WHERE p2c.category_id = '" . (int)$category_id . "'
		         ORDER BY option_value_id ASC";
		$query = $this->query($sql);
		$ids = array();
		foreach( $query->rows as $row ) {
			$ids[$row['option_value_id']] = 1;
		}
		return $ids;
	}

	public function getOptions($data = array(),$use_manufacturer = false,$setting = array())
	{

		// Не самый оптимальный вариант кеша, потому что число закешированных значений будет
		// соответствовать числу категорий в системе, умноженное на количество языков в ней
		// Но все равно по крайней мере имеем линейную зависимость
		$category_id = 0;
		if (!empty($data['filter_category'])) {
			$category_id = (int)$data['filter_category'];
		}

		$cache_key = "neoseo_filter_oc_" . (int)$this->config->get('config_language_id') . "_" . (int)$category_id;
		$options = $this->cache->get( $cache_key );
		if( !$options ) {

			$options = array();

			if( $use_manufacturer ) {

				// Выбираем всех производителей по категории
				$category_manufacturer_ids = array();

				$sql = "SELECT DISTINCT manufacturer_id 
			              FROM " . DB_PREFIX . "product p 
			                   LEFT JOIN " . DB_PREFIX . "product_to_category p2c ON (p.product_id = p2c.product_id)
			              WHERE p2c.category_id = '" . (int)$category_id . "'
			              ORDER BY manufacturer_id ASC";
				$query = $this->query($sql);
				foreach( $query->rows as $row ) {
					$manufacturer_id = $row['manufacturer_id'];
					$category_manufacturer_ids[$manufacturer_id] = 1;
				}

				if(isset($setting['manufacturer_title'][(int)$this->config->get('config_language_id')])){
					$manufacturerTitle = $setting['manufacturer_title'][(int)$this->config->get('config_language_id')];
				}else{
					$manufacturerTitle = 'Производители';
				}

				// Добавляем опцию
				$option['option_id'] = 'm';
				$option['keyword'] = 'manufacturer'; // TODO: вынести в настройки
				$option['open'] = 1; // TODO: вынести в настройки
				$option['type'] = 'checkbox'; // TODO: вынести в настройки
				$option['style'] = 'none'; // TODO: вынести в настройки
				$option['name'] = $manufacturerTitle;
				$option['selected'] = 0;
				$option['quantity'] = 0;
				$option['values'] = array();

				foreach( $this->manufacturers_to_keywords as $manufacturer_id => $manufacturer_info ) {
					if( !isset($category_manufacturer_ids[$manufacturer_id]) ) {
						continue;
					}

					$option_value = array(
						'option_value_id' => -$manufacturer_id,
						'keyword' => $manufacturer_info['keyword'],
						'name' => $this->manufacturers_names[$manufacturer_id],
						'color' => '',
						'image' => '',
						'position' => 'txt-bottom',
						'selected' => 0,
						'href' => '',
					);

					$option['values'][-$manufacturer_id] = $option_value;
				}

				$options['m'] = $option;
			}

			$sql = "SELECT fo.option_id, fod.keyword, fo.keyword as old_keyword, fo.open, fo.type, fo.style, fod.name 
			          FROM " . DB_PREFIX . "filter_option fo 
			               LEFT JOIN " . DB_PREFIX . "filter_option_description fod ON (fo.option_id = fod.option_id)";

			if (!empty($data['filter_category'])) {
				$sql .= " LEFT JOIN " . DB_PREFIX . "filter_option_to_category foc ON (fo.option_id = foc.option_id)";
			}

			$sql .= " WHERE fod.language_id = '" . (int) $this->config->get('config_language_id') . "'";
			$sql .= " AND fo.status='1'";

			if (!empty($data['filter_category'])) {
				$sql .= " AND foc.category_id = '" . (int)$data['filter_category'] . "'";
			}

			$sql .= " ORDER BY cast(fo.sort_order as unsigned) ASC";

			$query = $this->query($sql);


			if ($category_id) {
				$white_list = $this->getActiveOptionValues($category_id);
			} else {
				$white_list = array();
			}


			foreach( $query->rows as $option ) {
				if(!$option['keyword']){
					if($option['old_keyword']){
						$option['keyword'] = $option['old_keyword'];
					}
				}
				$option['selected'] = 0;
				$option['quantity'] = 0;


				$option_values = $this->getOptionValues($option['option_id']);
				// Мы не можем этот код внести в getOptionValues,
				// потому что там глобальный кеш, а нас интересует в разрезе категории
				$category_option_values = array();
				foreach( $option_values as $option_value_id => $option_value ) {
					if ($white_list && !isset($white_list[$option_value_id])) {
						continue;
					}
					$category_option_values[$option_value_id] = $option_value;
				}

				$option['values'] = $category_option_values;
				$options[$option['option_id']] = $option;
			}


			$this->cache->set( $cache_key, $options );
		}


		return $options;
	}

	private function getOptionValuesJoins($option_value_ids) {
		$options = array();
		foreach( $option_value_ids as $option_value_id ) {
			if( !isset($this->option_values_to_options[$option_value_id])) {
				continue;
			}
			$option_id = $this->option_values_to_options[$option_value_id];
			if( !isset($options[$option_id])) {
				$options[$option_id] = [];
			}
			$options[$option_id][] = $option_value_id;
		}
		$sql = "";
		$i = 1;
		foreach( $options as $option_id => $_option_value_ids ) {
			$sql .= " INNER JOIN `" . DB_PREFIX . "filter_option_value_to_product` fovp_{$i} ON ( fovp_{$i}.product_id = p.product_id AND fovp_{$i}.option_value_id IN (" . implode(",", $_option_value_ids) . ") )";
			$i++;
		}
		return $sql;
	}

	public function getProductIds($option_value_ids, $category_id) {

		asort($option_value_ids);

		/*if( $this->use_cache ) {
			// Пробуем достать из кеша
			$sql = "SELECT products
					  FROM `" . DB_PREFIX . "filter_cache`
					 WHERE category_id = " . (int)$category_id . "
					   AND options = '|" . implode("|", $option_value_ids) . "|'
				";
			$query = $this->query($sql);
			if ($query->num_rows) {
				if ($query->row['products'] == "||") {
					return array();
				}
				return explode("|", trim($query->row['products'], "|"));
			}
		}*/

		// Придется вытаскивать из базы и уж потом писать в кеш
		$product_ids = array();

		$option_manufacturer_ids = array();
		$other_option_value_ids = array();
		if( $option_value_ids ) {
			foreach ($option_value_ids as $option_value_id) {
				if ($option_value_id > 0) {
					$other_option_value_ids[] = $option_value_id;
				} else {
					$option_manufacturer_ids[] = -$option_value_id;
				}
			}
		}

		$sql = "SELECT p.product_id 
				  FROM `" . DB_PREFIX . "product` p
					   INNER JOIN `" . DB_PREFIX . "product_to_category` p2c ON ( p.product_id = p2c.product_id AND p2c.category_id = '" . (int)$category_id . "')";
		if( $other_option_value_ids ) {
			$sql .= $this->getOptionValuesJoins($other_option_value_ids);
		}
		$sql .= " WHERE p.status = 1 ";
		if( $option_manufacturer_ids ) {
			$sql .= " AND p.manufacturer_id IN (" . implode(",", $option_manufacturer_ids) . ") ";
		}

		$query = $this->query($sql);
		//echo $sql; exit;

		foreach( $query->rows as $row ) {
			$product_ids[] = (int)$row['product_id'];
		}

		/*if( $this->use_cache ) {
			// В следующий раз у нас уже будут все необходимые данные
			$sql = "INSERT INTO `" . DB_PREFIX . "filter_cache` SET category_id = '" . (int)$category_id . "', options = '|" . implode("|", $option_value_ids) . "|', products  = '|" . implode("|", $product_ids) . "|', `quantity`='" . (int)count($product_ids) . "'";
			$this->query($sql);
		}*/

		return $product_ids;
	}


	public function getProductCount( $option_value_ids, $category_id ){
		// Функция немного отличается от getProductIds, потому что
		// 1) возвращает именно количество, а не массив ( небольшая оптимизация по скорости, что для фильтра критично )

		asort($option_value_ids);

		/*if( $this->use_cache ) {
			// Вначале попробуем вытянуть из кеша
			$sql = "SELECT quantity
						  FROM `" . DB_PREFIX . "filter_cache`
						 WHERE category_id = " . (int) $category_id . "
						   AND options = '|" . implode("|",$option_value_ids) . "|'
					";
			$query = $this->query($sql);
			if( $query->num_rows ) {
				return (int)$query->row['quantity'];
			}
		}*/

		// Таки придется вытаскивать из базы и уж потом писать в кеш
		$option_manufacturer_ids = array();
		$other_option_value_ids = array();
		$product_ids = array();

		if( $option_value_ids ) {
			foreach ($option_value_ids as $option_value_id) {
				if ($option_value_id > 0) {
					$other_option_value_ids[] = $option_value_id;
				} else {
					$option_manufacturer_ids[] = -$option_value_id;
				}
			}
		}

		$sql = "SELECT p.product_id 
			  FROM `" . DB_PREFIX . "product` p
				   INNER JOIN `" . DB_PREFIX . "product_to_category` p2c ON ( p.product_id = p2c.product_id AND p2c.category_id = '" . (int)$category_id . "')";
		if( $other_option_value_ids ) {
			$sql .= $this->getOptionValuesJoins($other_option_value_ids);
		}
		$sql .= " WHERE p.status = 1 ";
		if( $option_manufacturer_ids ) {
			$sql .= " AND p.manufacturer_id IN (" . implode(",", $option_manufacturer_ids) . ") ";
		}

		$query = $this->query($sql);
		//echo $sql . "<br>";

		foreach( $query->rows as $row ) {
			$product_ids[] = (int)$row['product_id'];
		}

		/*if( $this->use_cache ) {
			// В следующий раз у нас уже будут все необходимые данные
			$sql = "INSERT INTO `" . DB_PREFIX . "filter_cache` SET category_id = '" . (int)$category_id . "', options = '|" . implode("|", $option_value_ids) . "|', products  = '|" . implode("|", $product_ids) . "|', `quantity`='" . (int)count($product_ids) . "'";
			$this->query($sql);
		}*/

		$result = count($product_ids);
		unset($product_ids);

		return $result;
	}

	public function getOptionValueQuantity($options, $selected_options, $selected_option_value_ids, $category_id ) {
		//$this->log("getOptionValueQuantity() options: " . print_r($options,true));
		if( $this->use_cache ) {
			// Пробуем достать из кеша
			$sql = "SELECT quantity
					  FROM `" . DB_PREFIX . "filter_module_cache` 
					 WHERE category_id = " . (int)$category_id . " 
					   AND language_id = " . (int) $this->config->get('config_language_id') . "
					   AND selected = '|" . implode("|", $selected_option_value_ids) . "|'
				";
			$query = $this->query($sql);
			if ($query->num_rows) {
				return unserialize($query->row['quantity']);
			}
		}

		$result = [];

		// Отталкиваемся от этого значения
		$result[0] = $this->getProductCount($selected_option_value_ids, $category_id);
		foreach( $options as $option ) {
			foreach( $option['values'] as $option_value ) {
				$selected_option_value_ids_plus_one = array_values($selected_option_value_ids);
				$selected_option_value_ids_plus_one[] = (int)$option_value['option_value_id'];
				$quantity = $this->getProductCount($selected_option_value_ids_plus_one, $category_id);

				$selected = $options[$option['option_id']]['values'][$option_value['option_value_id']]['selected'];
				$result[(int)$option_value['option_value_id']] = [
					"q" => $quantity,
					"u" => $this->getUrl($selected_options, $option['option_id'], $option_value['option_value_id'], $selected),
				];
			}
		}

		//$this->log("getOptionValueQuantity() result: " . print_r($result,true));

		if( $this->use_cache ) {
			// В следующий раз у нас уже будут все необходимые данные
			$sql = "INSERT INTO `" . DB_PREFIX . "filter_module_cache` SET 
						category_id = '" . (int)$category_id . "', 
						selected = '|" . implode("|", $selected_option_value_ids) . "|', 
						quantity  = '" . $this->db->escape(serialize($result)) . "', 
						language_id = '" . (int) $this->config->get('config_language_id') . "'";
			$this->query($sql);
		}

		return $result;
	}

	public function getProductOptions($product_id) {

		$sql = "SELECT fod.name as option_name, fovd.name as option_value_name FROM `" . DB_PREFIX . "filter_option_value_to_product` fov2p
                            INNER JOIN `" . DB_PREFIX . "filter_option` fo ON ( fov2p.option_id = fo.option_id )
					        INNER JOIN `" . DB_PREFIX . "filter_option_description` fod ON ( fov2p.option_id = fod.option_id )
					        INNER JOIN `" . DB_PREFIX . "filter_option_value_description` fovd ON ( fov2p.option_value_id = fovd.option_value_id )  
					        WHERE fov2p.product_id = '" . (int)$product_id . "' AND fo.status = 1 AND fod.language_id = '" . (int) $this->config->get('config_language_id') . "' AND fovd.language_id = '" . (int) $this->config->get('config_language_id') . "'
			                ";
		$query = $this->query($sql);
		if( !$query->num_rows ) {
			return array();
		}
		else {
			return $query->rows;
		}
	}

	public function getProductOptionsGrouped($product_id) {

		$sql = "SELECT fod.name as option_name, GROUP_CONCAT(LTRIM(RTRIM(fovd.name)) SEPARATOR ', ')  as option_value_name FROM `" . DB_PREFIX . "filter_option_value_to_product` fov2p
                            INNER JOIN `" . DB_PREFIX . "filter_option` fo ON ( fov2p.option_id = fo.option_id )
					        INNER JOIN `" . DB_PREFIX . "filter_option_description` fod ON ( fov2p.option_id = fod.option_id )
					        INNER JOIN `" . DB_PREFIX . "filter_option_value_description` fovd ON ( fov2p.option_value_id = fovd.option_value_id )  
					        WHERE fov2p.product_id = '" . (int)$product_id . "' AND fo.status = 1 AND fod.language_id = '" . (int) $this->config->get('config_language_id') . "' AND fovd.language_id = '" . (int) $this->config->get('config_language_id') . "'
			                GROUP BY fod.name";
		$query = $this->query($sql);
		if( !$query->num_rows ) {
			return array();
		}
		else {
			return $query->rows;
		}
	}


	public function getProductIdsByFilter($nsf, $category_id = 0){

		$price = '';

		$selected_option_value_ids = array();
		$options = explode(self::OPTIONS_SEP, (string)$nsf);
		foreach( $options as $option ) {
			$parts = explode(self::OPTION_VALUE_SEP, $option);
			if( count($parts) != 2 ) {
				continue;
			}

			if( $parts[0] === 'p') {
				$price = $parts[1];
				continue;
			}

			$option_values_ids = explode(self::VALUES_SEP, $parts[1] );
			foreach( $option_values_ids as $option_value_id ) {
				$selected_option_value_ids[] = (int)$option_value_id;
			}
		}

		if( !$price && !$selected_option_value_ids ) {
			return array();
		}

		if( $selected_option_value_ids ) {
			$product_ids = $this->getProductIds($selected_option_value_ids, $category_id);
		} else {
			$product_ids = array();
		}

		if( $price ) {
			$price_parts = explode("-",$price);
			$price_begin = $price_parts[0];
			$price_end = isset($price_parts[1]) ? $price_parts[1] : $price_parts[0];

			// Коррекция по курсу
			$price_begin = floor($price_begin / $this->currency->getValue() );
			$price_end = ceil( $price_end / $this->currency->getValue() );

			// А теперь еще выберем продукты, которые соответствуют по цене и находятся в нужной категории
			$sql  = "SELECT DISTINCT p.product_id ";
			$sql .= "\nFROM `" . DB_PREFIX . "product` p ";
			$sql .= "\n     INNER JOIN `" . DB_PREFIX . "product_to_category` p2c ON ( p.product_id = p2c.product_id ) ";
			if ( $this->use_discount ) {
				$sql .= "
					LEFT JOIN `" . DB_PREFIX . "product_discount` pd ON ( 
						p.product_id = pd.product_id 
						AND pd.customer_group_id = '" . (int)$this->config->get('config_customer_group_id') . "'
						AND pd.product_id = p.product_id  
						AND pd.quantity > '0' 
						AND (
							(pd.date_start = '0000-00-00' OR pd.date_start < '" . $this->db->escape(date('Y-m-d')) . "') 
							AND 
							(pd.date_end = '0000-00-00' OR pd.date_end > '" . $this->db->escape(date('Y-m-d')) . "')
						)
					)\n";
			}

			if ( $this->use_special ) {
				$sql .= "
					LEFT JOIN `" . DB_PREFIX . "product_special` ps ON ( 
						p.product_id = ps.product_id 
						AND ps.customer_group_id = '" . (int)$this->config->get('config_customer_group_id') . "' 
						AND (
							(ps.date_start = '0000-00-00' OR ps.date_start < '" . $this->db->escape(date('Y-m-d')) . "') 
							AND 
							(ps.date_end = '0000-00-00' OR ps.date_end > '" . $this->db->escape(date('Y-m-d')) . "')
						) 
					)\n";
			}

			$sql .= "\nWHERE ";

			if ( $this->use_discount and $this->use_special ) {
				$sql .= "\n CASE WHEN ps.price THEN ( ps.price >= " . (int)$price_begin . " AND ps.price <= " . (int)$price_end . " ) WHEN pd.price THEN ( pd.price >= " . (int)$price_begin . " AND pd.price <= " . (int)$price_end . " ) ELSE ( p.price >= " . (int)$price_begin . " AND p.price <= " . (int)$price_end . " ) END ";
			} else if ( $this->use_special ) {
				$sql .= "\n CASE WHEN ps.price THEN ( ps.price >= " . (int)$price_begin . " AND ps.price <= " . (int)$price_end . " ) ELSE ( p.price >= " . (int)$price_begin . " AND p.price <= " . (int)$price_end . " ) END ";
			} else if ( $this->use_discount ) {
				$sql .= "\n CASE WHEN pd.price THEN ( pd.price >= " . (int)$price_begin . " AND pd.price <= " . (int)$price_end . " ) ELSE ( p.price >= " . (int)$price_begin . " AND p.price <= " . (int)$price_end . " ) END ";
			} else {
				$sql .= " ( p.price >= " . (int)$price_begin . " AND p.price <= " . (int)$price_end . " ) ";
			}


			if( $product_ids ) {
				$sql .= " AND p.product_id IN (" . implode(",",$product_ids) . ")";
			}


			$query = $this->query($sql);
			if( !$query->num_rows ) {
				return array();
			}

			$product_ids = array();
			foreach( $query->rows as $row ) {
				$product_ids[] = (int)$row['product_id'];
			}
		}

		return $product_ids;
	}

	private function getFilterUrlForCategory(){
		$url = '';

		//if (isset($this->request->get['filter'])) {
		//	$url .= '&filter=' . $this->request->get['filter'];
		//}

		//if (isset($this->request->get['sort'])) {
		//	$url .= '&sort=' . $this->request->get['sort'];
		//}

		/* NeoSeo Product Labels - begin */
		//if (isset($this->request->get['product_label_id'])) {
		//	$url .= '&product_label_id=' . $this->request->get['product_label_id'];
		//}
		/* NeoSeo Product Labels - end */

		//if (isset($this->request->get['order'])) {
		//	$url .= '&order=' . $this->request->get['order'];
		//}

		//if (isset($this->request->get['limit'])) {
		//	$url .= '&limit=' . $this->request->get['limit'];
		//}

		if (isset($this->request->get['nsf'])) {
			$url .= "&nsf=" . $this->request->get['nsf'];
		}

		return $this->url->link('product/category', 'path=' . $this->request->get['path'] . $url);
	}

	public function processMetaData($data, $param, $category_id){

		// Если это посадочная страница, то берем метаданные из нее
		if( isset($this->pages_to_keywords[$param]) && isset($this->pages_to_keywords[$param][$category_id])) {

			$keyword = $this->pages_to_keywords[$param][$category_id];
			$page_id = $this->keywords_to_pages[$keyword]['page_id'];

			// Такой комбинации опций отвечает посадочная страница
			$this->load->model('module/neoseo_filter_pages');
			$page = $this->model_module_neoseo_filter_pages->getPage($page_id);
			if( $page ) {
				$this->document->setTitle($page['title']);
				$this->document->setDescription($page['meta_description']);
				$this->document->setKeywords($page['meta_keywords']);

				// Добавляем хлебные крошки для посадочной
				$data['breadcrumbs'][] = array(
					'text' => $page['title'],
					'href' => $this->getFilterUrlForCategory(),
				);

				$data['heading_title'] = $page['h1'];
				$data['description'] = html_entity_decode($page['description'], ENT_QUOTES, 'UTF-8');
			}
			return $data;
		}

		// Это не посадочная
		$this->document->setNoindex(true);
		/*
                $filter_name = '';
                $options = $this->explodeFilterParam($param);
                foreach ($options as $option_id => $option_value_ids) {
                    if ($filter_name) {
                        $filter_name .= '; ';
                    }

                    // Add price
                    if ($option_id == 'p') {
                        $price_range = explode('-', array_shift($values));

                        if (isset($price_range[0]) && isset($price_range[1])) {
                            $filter_name .= 'от ' . $price_range[0] . ' до ' . $price_range[1] . $this->currency->getSymbolLeft() . $this->currency->getSymbolRight();
                        }

                        continue;
                    }

                    // Add manufacturers
                    if ($option_id == 'm') {
                        $values = array();
                        foreach ($option_value_ids as $option_value_id) {
                            if( !isset($this->manufacturers_names[$option_value_id])) {
                                continue;
                            }

                            $values[] = $this->manufacturers_names[$option_value_id];
                        }

                        $filter_name .= implode(", ", $values);
                        continue;
                    }

                    // Add other filters
                    $filter_name .= $this->options_names[$option_id] . ": ";
                    $values = array();
                    foreach ($option_value_ids as $option_value_id) {
                        if( !isset($this->option_values_names[$option_value_id])) {
                            continue;
                        }
                        $values[] = $this->option_values_names[$option_value_id];
                    }

                    $filter_name .= implode(", ", $values);
                }

                $data['heading_title'] = $data['heading_title'] . ". " . $filter_name;
        */

		return $data;
	}

	private function query($sql){
		//$this->log($sql);
		return $this->db->query($sql);
	}


}
