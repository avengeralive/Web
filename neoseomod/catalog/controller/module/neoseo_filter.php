<?php

require_once( DIR_SYSTEM . "/engine/neoseo_controller.php");

class ControllerModuleNeoSeoFilter extends NeoSeoController
{

	public function __construct($registry)
	{
		parent::__construct($registry);
		$this->_moduleSysName = "neoseo_filter";
		$this->_logFile = $this->_moduleSysName . ".log";
		$this->debug = $this->config->get($this->_moduleSysName . "_debug");
	}

	public function index($setting) {

		$data = $this->load->language('module/neoseo_filter');
		$this->load->model('module/neoseo_filter');

		$data['cancel_all'] = $this->model_module_neoseo_filter->getUrl(array(), 0, 0, true);
		$data['symbol_left'] = $this->currency->getSymbolLeft();
		$data['symbol_right'] = $this->currency->getSymbolRight();

		$use_manufacturer = isset($setting['manufacturer']) && $setting['manufacturer'];

		$language_id = $this->config->get('config_language_id');
		if(isset($setting['title'][$language_id])) {
			$data['heading_title'] = $setting['title'][$language_id];
		}

		$category_id = 0;
		$filter_data = array();
		if (isset($this->request->get['path'])) {
			$parts = explode('_', (string)$this->request->get['path']);
			$category_id = end($parts);
			$filter_data['filter_category'] = $category_id;
		}

		$options = $this->model_module_neoseo_filter->getOptions($filter_data,$use_manufacturer,$setting);
		//$this->log("options: " . print_r($options,true));
		//echo "<pre>";
		//var_dump($options);
		//echo "</pre>";
		//exit;

		$category_prices = $this->model_module_neoseo_filter->getCategoryPrices($category_id);
		$data['min_price'] = floor($category_prices['min_price'] * $this->currency->getValue());
		$data['max_price'] = ceil($category_prices['max_price'] * $this->currency->getValue());
		$selected_options = $this->model_module_neoseo_filter->getSelectedOptions($options);
		if( isset($selected_options['p'])) {
			$keys = array_keys($selected_options['p']);
			$prices = explode("-",$keys[0]);
			unset($selected_options['p']);
			$data['price_begin'] = max($prices[0],(int)$data['min_price']);
			$data['price_end'] = min($prices[1],(int)$data['max_price']);
		} else {
			$data['price_begin'] = (int)$data['min_price'];
			$data['price_end'] = (int)$data['max_price'];
		}

		$data['selected_options_values_count'] = 0;
		$selected_option_values = array();
		foreach( $selected_options as $selected_option_id => $selected_option_value_ids ) {
			foreach( $selected_option_value_ids as $selected_option_value_id => $tmp ) {
				$selected_option_values[] = $selected_option_value_id;
				$options[$selected_option_id]['selected'] = 1;
				$options[$selected_option_id]['values'][$selected_option_value_id]['selected'] = 1;
				$data['selected_options_values_count'] = $data['selected_options_values_count'] + 1;
			}
		}


		// В кеше должно быть сохранено итоговое значение по всем опциям, чтобы не делать 100 запросов к базе, а ограничиться одним
		$value_id_to_quantity = $this->model_module_neoseo_filter->getOptionValueQuantity($options, $selected_options, $selected_option_values, $category_id);
		$current_quantity = $value_id_to_quantity[0];
		//var_dump($value_id_to_quantity);
		//var_dump($current_quantity);exit;
		//var_dump(null);

		$total_quantity = 0;
		foreach( $options as $option ) {
			foreach( $option['values'] as $option_value ) {
				if( isset($value_id_to_quantity[(int)$option_value['option_value_id']]) ) {
					$url = $value_id_to_quantity[(int)$option_value['option_value_id']]['u'];
				} else {
					$selected = $options[$option['option_id']]['values'][$option_value['option_value_id']]['selected'];
					$url = $this->model_module_neoseo_filter->getUrl($selected_options, $option['option_id'], $option_value['option_value_id'], $selected);
				}
				$options[$option['option_id']]['values'][$option_value['option_value_id']]['url'] = $url;

				if( in_array((int)$option_value['option_value_id'], $selected_option_values) ) {
					// тут традиционно не вычисляем ничего
					$quantity = 0;
				} else {
					$quantity = isset($value_id_to_quantity[(int)$option_value['option_value_id']]) ? $value_id_to_quantity[(int)$option_value['option_value_id']]['q'] : 0;
					//var_dump($selected_option_value_ids_plus_one);
					unset($selected_option_value_ids_plus_one);
					if( $options[$option['option_id']]['selected'] ) {
						$quantity -= $current_quantity;
						if( $quantity > 0 ) {
							$quantity = "+" . $quantity;
						}
					}
				}

				if( $quantity > 0 ) {
					$options[$option['option_id']]['quantity'] += $quantity;
					$total_quantity += $quantity;
				}
				$options[$option['option_id']]['values'][$option_value['option_value_id']]['count'] = $quantity;
			}
		}
		//var_dump($options);
		//exit;

		$data['options'] = $options;
		$data['selected_options_count'] = count($selected_options);

		$data['url_for_price'] = $this->model_module_neoseo_filter->getUrl($selected_options, "p", "PRICE_FROM-PRICE_TO", false);

		if( $total_quantity == 0 && $data['min_price'] == $data['max_price'] && !$selected_option_values) {
			return '';
		}

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/neoseo_filter.tpl')) {
			return $this->load->view($this->config->get('config_template') . '/template/module/neoseo_filter.tpl', $data);
		} else {
			return $this->load->view('default/template/module/neoseo_filter.tpl', $data);
		}
	}

}

