<?php
require_once(DIR_SYSTEM.'/engine/neoseo_controller.php');

class ControllerModuleNeoSeoBlogProducts extends NeoSeoController
{
	public function __construct($registry) {
		parent::__construct($registry);
		$this->_moduleSysName = 'neoseo_blog';
		$this->_logFile = $this->_moduleSysName . '.log';
		$this->debug = $this->config->get($this->_moduleSysName . '_status') == 1;
	}

	public function index($setting)
	{

		$data = $this->language->load('module/neoseo_blog_products');

		$this->load->model('blog/neoseo_blog_article');
		$this->load->model('blog/neoseo_blog_category');
		$this->load->model('tool/image');

		$data['article_id'] = '';
		if (isset($this->request->get['article_id'])) {
			$data['article_id'] = $this->request->get['article_id'];
		}



		if (!file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/stylesheet/neoseo_blog.scss')) {
			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/stylesheet/neoseo_blog.css')) {
				$this->document->addStyle('catalog/view/theme/' . $this->config->get('config_template') . '/stylesheet/neoseo_blog.css');
			} else {
				$this->document->addStyle('catalog/view/theme/default/stylesheet/neoseo_blog.css');
			}
		}

		if (empty($setting['limit'])) {
			$setting['limit'] = 4;
		}

		if (!empty($setting['title'][$this->config->get('config_language_id')])) {
			$data['heading_title'] = $setting['title'][$this->config->get('config_language_id')];
		} else {
			$data['heading_title'] = '';
		}

		if ($setting['type'] == 'column') {
			
		} elseif ($setting['type'] == 'Grid') {
			
		} else {
			
		}

		$filter_data = array(
			'start' => 0,
			'limit' => $setting['limit']
		);

		$data['neoseo_quick_order_status'] = $this->config->get('neoseo_quick_order_status') || $this->config->get('neoseo_quickorder_status');
		
		$data['text_one_click_buy'] = $this->language->get('text_one_click_buy');
		$data['divider'] = $this->config->get('neoseo_unistor_product_selected_attributes_custom_divider');

		/* NeoSeo Product Labels - begin */
		if ($this->config->get('neoseo_product_labels_status') == 1) {
			$this->load->model("module/neoseo_product_labels");
		}
		/* NeoSeo Product Labels - end */

		/* NeoSeo Notify When Available - begin */
		if ($this->config->get("neoseo_notify_when_available_status")) {
			$this->language->load("module/neoseo_notify_when_available");
			$this->load->model('module/neoseo_notify_when_available');
			$notify_when_available_status = $this->config->get("neoseo_notify_when_available_status");
			$notify_when_available_stock_statuses = $this->config->get("neoseo_notify_when_available_stock_statuses");
			$data['button_snwa_subscribe'] = $this->language->get('button_subscribe');
			$data['button_snwa_unsubscribe'] = $this->language->get('button_unsubscribe');
			if (isset($this->request->cookie['neoseo_notify_when_available_email'])) {
				$snwa_email = $this->request->cookie['neoseo_notify_when_available_email'];
			}
		}
		/* NeoSeo Notify When Available - end */

		$data['related_products'] = array();

		$results = $this->model_blog_neoseo_blog_article->getRelatedProductsFiltered($data['article_id'], $filter_data);

		foreach ($results as $result) {

			$this->load->model('catalog/product');

			$product_info = $this->model_catalog_product->getProduct($result['product_id']);
			$data['button_wishlist'] = $this->language->get('button_wishlist');
			$data['button_compare'] = $this->language->get('button_compare');
			$product_images = $this->model_catalog_product->getProductImages($result['product_id']);
			if (isset($product_images[0]) and isset($product_images[0]['image'])) {
				$product_image = $this->model_tool_image->resize($product_images[0]['image'], $setting['width'], $setting['height']);
			} else {
				$product_image = false;
			}

			if ($product_info['image']) {
				$image = $this->model_tool_image->resize($product_info['image'], $setting['width'], $setting['height']);
			} else {
				$image = $this->model_tool_image->resize('placeholder.png', $setting['width'], $setting['height']);
			}

			if (!$this->config->get('config_customer_price') && !$this->customer->isLogged()) {
				$price = $this->currency->format($this->tax->calculate($product_info['price'], $product_info['tax_class_id'], $this->config->get('config_tax')));
				$price_argo = $this->currency->format($this->tax->calculate($product_info['price'] - ($product_info['price'] / 100 * 20), $product_info['tax_class_id'], $this->config->get('config_tax')));
			} elseif ($this->customer->isLogged()) {
				$price = $this->currency->format($this->tax->calculate($product_info['price'] - ($product_info['price'] / 100 * 20), $product_info['tax_class_id'], $this->config->get('config_tax')));
				$price_argo = false;
			} else {
				$price = false;
				$price_argo = false;
			}
			$description_length = $this->config->get('neoseo_unistor_product_short_desription_length');
			if (!$description_length) {
				$description_length = 300;
			}

			if ((float) $product_info['special']) {
				$special = $this->currency->format($this->tax->calculate($product_info['special'], $product_info['tax_class_id'], $this->config->get('config_tax')));
				$price_argo = $this->currency->format($this->tax->calculate($product_info['special'] - ($product_info['special'] / 100 * 20), $product_info['tax_class_id'], $this->config->get('config_tax')));
			} else {
				$special = false;
			}

			if ($this->customer->isLogged()) {
				$reward = $product_info['reward'];
				$points = $product_info['points'];
			} else {
				$reward = false;
				$points = false;
			}

			if ($this->config->get('config_tax')) {
				$tax = $this->currency->format((float) $product_info['special'] ? $product_info['special'] : $product_info['price']);
			} else {
				$tax = false;
			}

			if ($this->config->get('config_review_status')) {
				$rating = (int) $product_info['rating'];
			} else {
				$rating = false;
			}
			if ($this->config->get('neoseo_unistor_product_attributes_status')) {
				$additional_attributes = array();
				if ($this->config->get('neoseo_unistor_product_show_manufacturer') && $result['manufacturer']) {
					$additional_attributes[] = array(
						'name' => $this->language->get('text_manufacturer'),
						'text' => $result['manufacturer']);
				}
				if ($this->config->get('neoseo_unistor_product_show_model') && $result['model']) {
					$additional_attributes[] = array(
						'name' => $this->language->get('text_model'),
						'text' => $result['model']);
				}
				if  ($this->config->get('neoseo_unistor_product_show_sku') && $result['sku']) {
					$additional_attributes[] = array(
						'name' => $this->language->get('text_sku'),
						'text' => $result['sku']);
				}
				if ($this->config->get('neoseo_unistor_product_show_weight') && $result['weight']) {
					$additional_attributes[] = array(
						'name' => $this->language->get('text_weight'),
						'text' => $result['weight']);
				}
				$attribute_groups = $this->model_catalog_product->getProductAttributes($result['product_id']);

				if ($attribute_groups) {
					foreach ($attribute_groups as $attribute_group) {
						foreach ($attribute_group['attribute'] as $attribute) {
							if (in_array($attribute['attribute_id'],$this->config->get('neoseo_unistor_product_selected_attributes'))) {
								$additional_attributes[] = array(
									'name' => $attribute['name'].":",
									'text' => $attribute['text']
								);
							}
						}
					}
				}
			} else {
				$additional_attributes = array();
			}
			/* NeoSeo Notify When Available - begin */
			$snwa_status = false;
			$snwa_requested = false;
			if ($product_info['quantity'] <= 0 && $notify_when_available_status && in_array($product_info['stock_status_id'], $notify_when_available_stock_statuses)) {
				$snwa_status = true;
				if (isset($snwa_email)) {
					$snwa_request = $this->model_module_neoseo_notify_when_available->getRequest($snwa_email, $product_info['product_id']);
					$snwa_requested = ($snwa_request && $snwa_request['status'] );
				}
			}
			/* NeoSeo Notify When Available - end */

			/* NeoSeo Product Options PRO - begin */
			$options = array();
			$data['product_list_status'] = $this->config->get('neoseo_product_options_pro_product_list_status');
			if ($this->config->get('neoseo_product_options_pro_status') && $data['product_list_status'] == 1) {
				foreach ($this->model_catalog_product->getProductOptions($product_info['product_id']) as $option) {
					$product_option_value_data = array();

					foreach ($option['product_option_value'] as $option_value) {
						if (!$option_value['subtract'] || isset($option_value['quantity'])) {

							$product_option_value_data[] = array(
								'product_option_value_id' => $option_value['product_option_value_id'],
								'option_value_id' => $option_value['option_value_id'],
								'name' => $option_value['name'],
								'image' => $this->model_tool_image->resize($option_value['image'], 50, 50),
								'price' => $price,
								'price_prefix' => $option_value['price_prefix']
							);
						}
					}

					$options[] = array(
						'product_option_id' => $option['product_option_id'],
						'product_option_value' => $product_option_value_data,
						'option_id' => $option['option_id'],
						'name' => $option['name'],
						'type' => $option['type'],
						'value' => $option['value'],
						'required' => $option['required']
					);
				}
			}
			/* NeoSeo Product Options PRO - end */

			$data['related_products'][] = array(
				/* NeoSeo Product Options PRO - begin */
				'options' => $options,
				/* NeoSeo Product Options PRO - end */
				/* NeoSeo Product Labels - begin */
				'labels' => $this->model_module_neoseo_product_labels ? $this->model_module_neoseo_product_labels->getLabel($product_info) : false,
				/* NeoSeo Product Labels - end */
				'product_id' => $product_info['product_id'],
				'thumb' => $image,
				'thumb1' => $product_image,
				'name' => $product_info['name'],
				'description' => utf8_substr(strip_tags(html_entity_decode($product_info['description'], ENT_QUOTES, 'UTF-8')), 0, $this->config->get('config_product_description_length')) . '..',
				'short_description' => utf8_substr(strip_tags(html_entity_decode($product_info['description'], ENT_QUOTES, 'UTF-8')), 0, $description_length) . '..',
				'price' => $price,
				'price_argo' => $price_argo,
				'special' => $special,
				'reward' => $reward,
				'points' => $points,
				'tax' => $tax,
				'minimum' => $product_info['minimum'] > 0 ? $product_info['minimum'] : 1,
				'rating' => $product_info['rating'],
				'additional_attributes' => $additional_attributes,
				'total_attributes' => count($additional_attributes),
				'stock_status_id' => ( $product_info['quantity'] > 0 ? 0 : $product_info['stock_status_id'] ),
				'stock_status' => $product_info['stock_status'],
				/* NeoSeo Notify When Available - begin */
				'snwa_status' => $snwa_status,
				'snwa_requested' => $snwa_requested,
				/* NeoSeo Notify When Available - end */
				'href' => $this->url->link('product/product', '&product_id=' . $product_info['product_id'])
			);
		}

		if (empty($data['related_products']))
			return '';

		$template = $setting['template'];
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/' . $template)) {
			return $this->load->view($this->config->get('config_template') . '/template/module/' . $template, $data);
		} else {
			return $this->load->view('default/template/module/' . $template, $data);
		}
	}

}
