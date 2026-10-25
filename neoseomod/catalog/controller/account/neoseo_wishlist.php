<?php

require_once( DIR_SYSTEM . "/engine/neoseo_controller.php");

class ControllerAccountNeoSeoWishList extends NeoSeoController
{

	public function __construct($registry)
	{
		parent::__construct($registry);
		$this->_moduleSysName = "neoseo_account";
		$this->_logFile = $this->_moduleSysName . ".log";
		$this->debug = $this->config->get($this->_moduleSysName . "_debug");
	}

	public function index()
	{
		if (!$this->customer->isLogged()) {
			$this->session->data['redirect'] = $this->url->link('account/neoseo_wishlist', '', 'SSL');

			$this->response->redirect($this->url->link('account/neoseo_login', '', 'SSL'));
		}

		$data = $this->load->language('account/neoseo_wishlist');

		$this->load->model('account/neoseo_wishlist');

		$this->load->model('catalog/product');

		$this->load->model('tool/image');

		if (isset($this->request->get['remove'])) {
			// Remove Wishlist
			$this->model_account_wishlist->deleteWishlist($this->request->get['remove']);

			$this->session->data['success'] = $this->language->get('text_remove');

			$this->response->redirect($this->url->link('account/neoseo_wishlist'));
		}

		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'p.sort_order';
		}

		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'ASC';
		}

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		if (isset($this->request->get['limit'])) {
			$limit = (int) $this->request->get['limit'];
		} else {
			$limit = $this->config->get('config_product_limit');
		}

		$data['cat_view_type'] = $this->config->get('neoseo_unistor_cat_view_type');

		$this->document->setTitle($this->language->get('heading_title'));

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_account'),
			'href' => $this->url->link('account/neoseo_account', '', 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('account/neoseo_wishlist')
		);


		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

		$colors_status = $this->config->get('neoseo_unistor_colors_status');
		$data['neoseo_quick_order_status'] = $this->config->get('neoseo_quick_order_status') || $this->config->get('soforp_quickorder_status');
		$data['text_one_click_buy'] = $this->language->get('text_one_click_buy');
		$data['md_currency'] = $this->currency->getCode();
		$data['products'] = array();

		$filter_data = array(
			'sort' => $sort,
			'order' => $order,
			'start' => ($page - 1) * $limit,
			'limit' => $limit
		);
		$data['divider'] = html_entity_decode($this->config->get('neoseo_unistor_product_selected_attributes_custom_divider'));

		$data['text_tax'] = $this->language->get('text_tax');

		/* Neoseo Product Options PRO - begin */
		$data['product_list_status'] = $this->config->get('neoseo_product_options_pro_product_list_status');
		/* Neoseo Product Options PRO - end */

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

		$product_total = $this->model_account_neoseo_wishlist->getTotalWishlist();
		$products = $this->model_account_neoseo_wishlist->getWishlist($filter_data);

		foreach ($products as $result) {
			$product_info = $this->model_catalog_product->getProduct($result['product_id']);

			if ($product_info) {

				if ($product_info['quantity'] > 0) {
					$stock_status_color = $colors_status[0]['font_color'];
				} elseif (isset($colors_status[$product_info['stock_status_id']])) {
					$stock_status_color = $colors_status[$product_info['stock_status_id']]['font_color'];
				} else {
					$stock_status_color = '#8c8c8c';
				}

				if ($product_info['image']) {
					$image = $this->model_tool_image->resize($product_info['image'], $this->config->get('config_image_product_width'), $this->config->get('config_image_product_height'));
				} else {
					$image = $this->model_tool_image->resize('placeholder.png', $this->config->get('config_image_product_width'), $this->config->get('config_image_product_height'));
				}

				$product_images = $this->model_catalog_product->getProductImages($result['product_id']);
				if (isset($product_images[0]) and isset($product_images[0]['image'])) {
					$product_image = $this->model_tool_image->resize($product_images[0]['image'], $this->config->get('config_image_product_width'), $this->config->get('config_image_product_height'));
				} else {
					$product_image = false;
				}

				$images = array();
				foreach ($this->model_catalog_product->getProductImages($result['product_id']) as $value) {
					$images[] = $this->model_tool_image->resize($value['image'], $this->config->get('config_image_product_width'), $this->config->get('config_image_product_height'));
				}

				$description_length = $this->config->get('neoseo_unistor_product_short_desription_length');
				if (!$description_length) {
					$description_length = 300;
				}
				if ($product_info['quantity'] <= 0) {
					$stock = $product_info['stock_status'];
				} elseif ($this->config->get('config_stock_display')) {
					$stock = $product_info['quantity'];
				} else {
					$stock = $this->language->get('text_instock');
				}

				if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
					$price = $this->currency->format($this->tax->calculate($product_info['price'], $product_info['tax_class_id'], $this->config->get('config_tax')));
				} else {
					$price = false;
				}

				if ((float) $product_info['special']) {
					$special = $this->currency->format($this->tax->calculate($product_info['special'], $product_info['tax_class_id'], $this->config->get('config_tax')));
				} else {
					$special = false;
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
					if ($this->config->get('neoseo_unistor_product_show_sku') && $result['sku']) {
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
					$product_selected_attributes = $this->config->get('neoseo_unistor_product_selected_attributes');

					if ($attribute_groups && $product_selected_attributes) {
						foreach ($attribute_groups as $attribute_group) {
							foreach ($attribute_group['attribute'] as $attribute) {
								if (in_array($attribute['attribute_id'], $product_selected_attributes)) {
									$additional_attributes[] = array(
										'name' => $attribute['name'] . ":",
										'text' => $attribute['text']
									);
								}
							}
						}
					}
				} else {
					$additional_attributes = array();
				}
				/* Neoseo Product Options PRO - begin */
				$options = array();
				if ($this->config->get('neoseo_product_options_pro_status') && $data['product_list_status'] == 1) {
					foreach ($this->model_catalog_product->getProductOptions($result['product_id']) as $option) {
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
				/* Neoseo Product Options PRO - end */

				/* NeoSeo Notify When Available - begin */
				$snwa_status = false;
				$snwa_requested = false;
				if ($result['quantity'] <= 0 && $notify_when_available_status && in_array($result['stock_status_id'], $notify_when_available_stock_statuses)) {
					$snwa_status = true;
					if (isset($snwa_email)) {
						$snwa_request = $this->model_module_neoseo_notify_when_available->getRequest($snwa_email, $result['product_id']);
						$snwa_requested = ($snwa_request && $snwa_request['status'] );
					}
				}
				/* NeoSeo Notify When Available - end */

				$data['products'][] = array(
					'product_id' => $product_info['product_id'],
					/* Neoseo Product Options PRO - begin */
					'options' => $options,
					/* NeoSeo Product Labels - begin */
					/* NeoSeo Product Labels - begin */
					'labels' => $this->model_module_neoseo_product_labels ? $this->model_module_neoseo_product_labels->getLabel($result) : false,
					/* NeoSeo Product Labels - end */
					'thumb' => $image,
					'thumb1' => $product_image,
					'stock_status' => ($result['quantity'] <= 0) ? $result['stock_status'] : $this->language->get('text_instock'),
					'stock_status_id' => ($result['quantity'] <= 0) ? (int) $result['stock_status_id'] : 0,
					'stock_status_color' => $stock_status_color,
					'md_availability' => $result['status'],
					'md_review_count' => $result['reviews'],
					'minimum' => $result['minimum'],
					/* akcenter - begin */
					'sku' => isset($product_info['sku']) ? $product_info['sku'] : '',
					'images' => $images,
					'sticker' => isset($product_info['sticker']) ? $product_info['sticker'] : '',
					'video' => isset($product_info['video']) ? $product_info['video'] : '',
					'date_added' => $product_info['date_added'],
					'short_description' => utf8_substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, $description_length) . '..',
					/* akcenter - end */
					'name' => $product_info['name'],
					'description' => utf8_substr(strip_tags(html_entity_decode($product_info['description'], ENT_QUOTES, 'UTF-8')), 0, 80) . '..',
					'model' => $product_info['model'],
					'stock' => $stock,
					'price' => $price,
					'special' => $special,
					'tax' => $tax,
					'rating' => $rating,
					'additional_attributes' => $additional_attributes,
					'total_attributes' => count($additional_attributes),
					/* NeoSeo Notify When Available - begin */
					'snwa_status' => $snwa_status,
					'snwa_requested' => $snwa_requested,
					/* NeoSeo Notify When Available - end */
					'href' => $this->url->link('product/product', 'product_id=' . $product_info['product_id']),
					'remove' => $this->url->link('account/wishlist', 'remove=' . $product_info['product_id'])
				);
			} else {
				$this->model_account_wishlist->deleteWishlist($result['product_id']);
			}
		}

		$url = '';

		if (isset($this->request->get['limit'])) {
			$url .= '&limit=' . $this->request->get['limit'];
		}

		$data['sorts'] = array();

		$data['sorts'][] = array(
			'text' => $this->language->get('text_default'),
			'value' => 'p.sort_order-ASC',
			'href' => $this->url->link('account/neoseo_wishlist', 'sort=p.sort_order&order=ASC' . $url)
		);

		$data['sorts'][] = array(
			'text' => $this->language->get('text_name_asc'),
			'value' => 'pd.name-ASC',
			'href' => $this->url->link('account/neoseo_wishlist', 'sort=pd.name&order=ASC' . $url)
		);

		$data['sorts'][] = array(
			'text' => $this->language->get('text_name_desc'),
			'value' => 'pd.name-DESC',
			'href' => $this->url->link('account/neoseo_wishlist', 'sort=pd.name&order=DESC' . $url)
		);

		$data['sorts'][] = array(
			'text' => $this->language->get('text_price_asc'),
			'value' => 'p.price-ASC',
			'href' => $this->url->link('account/neoseo_wishlist', 'sort=p.price&order=ASC' . $url)
		);

		$data['sorts'][] = array(
			'text' => $this->language->get('text_price_desc'),
			'value' => 'p.price-DESC',
			'href' => $this->url->link('account/neoseo_wishlist', 'sort=p.price&order=DESC' . $url)
		);

		if ($this->config->get('config_review_status')) {
			$data['sorts'][] = array(
				'text' => $this->language->get('text_rating_desc'),
				'value' => 'rating-DESC',
				'href' => $this->url->link('account/neoseo_wishlist', 'sort=rating&order=DESC' . $url)
			);

			$data['sorts'][] = array(
				'text' => $this->language->get('text_rating_asc'),
				'value' => 'rating-ASC',
				'href' => $this->url->link('account/neoseo_wishlist', 'sort=rating&order=ASC' . $url)
			);
		}

		$data['sorts'][] = array(
			'text' => $this->language->get('text_model_asc'),
			'value' => 'p.model-ASC',
			'href' => $this->url->link('account/neoseo_wishlist', 'sort=p.model&order=ASC' . $url)
		);

		$data['sorts'][] = array(
			'text' => $this->language->get('text_model_desc'),
			'value' => 'p.model-DESC',
			'href' => $this->url->link('account/neoseo_wishlist', 'sort=p.model&order=DESC' . $url)
		);

		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$data['limits'] = array();

		$limits = array_unique(array($this->config->get('config_product_limit'), 25, 50, 75, 100));

		sort($limits);

		foreach ($limits as $value) {
			$data['limits'][] = array(
				'text' => $value,
				'value' => $value,
				'href' => $this->url->link('account/neoseo_wishlist', $url . '&limit=' . $value)
			);
		}

		$data['sort'] = $sort;
		$data['order'] = $order;
		$data['limit'] = $limit;

		$pagination = new Pagination();
		$pagination->total = $product_total;
		$pagination->page = $page;
		$pagination->limit = $limit;
		$pagination->url = $this->url->link('account/neoseo_wishlist', $url . '&page={page}');

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($product_total) ? (($page - 1) * $limit) + 1 : 0, ((($page - 1) * $limit) > ($product_total - $limit)) ? $product_total : ((($page - 1) * $limit) + $limit), $product_total, ceil($product_total / $limit));

		$data['continue'] = $this->url->link('account/neoseo_account', '', 'SSL');

		$this->registry->set('data', $data);
		$data['registry'] = $this->registry;

		$data['button_table'] = $this->language->get('button_table');

		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/account/neoseo_wishlist.tpl')) {
			$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/account/neoseo_wishlist.tpl', $data));
		} else {
			$this->response->setOutput($this->load->view('default/template/account/neoseo_wishlist.tpl', $data));
		}
	}

	public function add()
	{
		$this->load->language('account/neoseo_wishlist');

		$json = array();

		if (isset($this->request->post['product_id'])) {
			$product_id = $this->request->post['product_id'];
		} else {
			$product_id = 0;
		}

		$this->load->model('catalog/product');

		$product_info = $this->model_catalog_product->getProduct($product_id);

		if ($product_info) {
			if ($this->customer->isLogged()) {
				// Edit customers cart
				$this->load->model('account/neoseo_wishlist');

				$this->model_account_wishlist->addWishlist($this->request->post['product_id']);

				$json['success'] = sprintf($this->language->get('text_success'), $this->url->link('product/product', 'product_id=' . (int) $this->request->post['product_id']), $product_info['name'], $this->url->link('account/wishlist'));

				$json['total'] = sprintf($this->language->get('text_wishlist'), $this->model_account_wishlist->getTotalWishlist());
			} else {
				if (!isset($this->session->data['wishlist'])) {
					$this->session->data['wishlist'] = array();
				}

				$this->session->data['wishlist'][] = $this->request->post['product_id'];

				$this->session->data['wishlist'] = array_unique($this->session->data['wishlist']);

				$json['success'] = sprintf($this->language->get('text_login'), $this->url->link('account/neoseo_login', '', 'SSL'), $this->url->link('account/register', '', 'SSL'), $this->url->link('product/product', 'product_id=' . (int) $this->request->post['product_id']), $product_info['name'], $this->url->link('account/wishlist'));

				$json['total'] = sprintf($this->language->get('text_wishlist'), (isset($this->session->data['wishlist']) ? count($this->session->data['wishlist']) : 0));
			}
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

}
