<?php

require_once( DIR_SYSTEM . "/engine/neoseo_model.php");

class ModelModuleNeoSeoUnistor extends NeoSeoModel
{

	public function __construct($registry)
	{
		parent::__construct($registry);
		$this->_moduleName = "";
		$this->_moduleSysName = "neoseo_unistor";
		$this->_logFile = $this->_moduleSysName . ".log";
		$this->debug = $this->config->get($this->_moduleSysName . "_debug") == 1;


		$this->load->model('localisation/language');
		$languages = $this->model_localisation_language->getLanguages();
		$work_time = array();
		$delivery = array();
		$guarantee = array();
		$logo = array();
		$top_banner_image = array();
		$top_banner_link = array();
		$footer_sections = array();
		$footer_column_names = array();
		$footer_column_texts = array();
		$recent_search = array();
		$contact_section_names = array();
		$contact_section_texts = array();
		$general_sharing_code = array();
		foreach ($languages as $language) {
			$general_sharing_code[$language['language_id']] = '
				<div id="share" class="share-top"></div>
				<script>
					$("#share").jsSocials({
						showLabel: true,
						shareIn: "popup",
						shares: ["twitter", "facebook", "googleplus"]
					});
				</script>
			';
			$work_time[$language['language_id']] = 'Пн-Пт: с 9.00 - 19.00, Сб: с 9.00 - 15.00, Вс: выходной';
			$delivery[$language['language_id']] = '<h4><span style="font-size:16px;"><a href="/informatsiya-o-dostavke">Способы доставки:</a></span></h4>
													<ul>
														<li>Самовывоз</li>
														<li>Доставка курьером</li>
														<li><img alt="" src="https://silkworm.com.ua/image/catalog/demo/manufacturers/novaposhta.png" style="width: 28px; height: 28px;" />&nbsp;Нова Пошта</li>
														<li>Доставка Укрпочтой</li>
														<li>Автолюкс</li>
														<li>ИнТайм&nbsp;</li>
													</ul>';

			$payment[$language['language_id']] = '<h4><span style="font-size:16px;"><a href="/informatsiya-o-dostavke">Способы оплаты:</a></span></h4>
													<ul>
														<li>Наличными (только для Киева)</li>
														<li><img alt="" src="https://silkworm.com.ua/image/catalog/demo/manufacturers/privat_bank.jpg" style="width: 26px; height: 26px;" />&nbsp;ПриватБанк</li>
														<li>Наложенный платеж&nbsp;(при получении)</li>
														<li>Оплата банковской картой Visa, Mastercard</li>
														<li>Оплата картой Visa, Mastercard - LiqPay</li>
													</ul>';

			$guarantee[$language['language_id']] = '<p><span style="font-size:16px;"><label for="neoseo_unistor_guarantee">Информация о гарантиях:</label></span></p>
													<ul>
														<li><strong>12 месяцев</strong> официальной гарантии от производителя</li>
														<li>обмен / возврат товара в течение 14 дней</li>
													</ul>';

			$logo[$language['language_id']] = "catalog/" . $this->_moduleSysName . "/neoseo.png";
			$top_banner_image[$language['language_id']] = '';
			$top_banner_link[$language['language_id']] = '';
			$recent_search[$language['language_id']] = '';

			$footer_sections[1][$language['language_id']] = '';
			$footer_sections[2][$language['language_id']] = '';
			$footer_sections[3][$language['language_id']] = '© 2018 SEO-Магазин от NeoSeo <br> Создание Интернет–магазина, раскрутка и продвижение сайта с ❤ в NeoSeo';
			$footer_sections[4][$language['language_id']] = '
 <div class="socials">      
                <a href="#" class="vk"><i class="fa fa-vk" aria-hidden="true"></i></a>
                <a href="#" class="fk"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                <a href="#" class="yt"><i class="fa fa-youtube-square" aria-hidden="true"></i></a>
                <a href="#" class="tw"><i class="fa fa-twitter" aria-hidden="true"></i></a>
 </div>			
			';
			$footer_sections[5][$language['language_id']] = '
<div class="payments">
	<a href="#" class="visa"></a>
	<a href="#" class="master"></a>
	<a href="#" class="webmoney"></a>
	<a href="#" class="cash"></a>
	<a href="#" class="qiwi"></a>
</div>			
			';

			$footer_column_names[1][$language['language_id']] = 'О компании';
			$footer_column_texts[1][$language['language_id']] = 'Украина, <br>
				г. Львов ул. Кульпарковская, 93 <br>
				+38 067 28 55 238, +38 067 670 76 47, <br>
				+38 050 345 85 65, +38 063 71 707 63 <br>
				г. Киев, ул. Срибнокильская 8а, <br>
				+38 044 39 03 001 <br>
				info@neoseo.com.ua';

			$footer_column_names[2][$language['language_id']] = 'Информация';
			$footer_column_names[3][$language['language_id']] = 'Поддержка';
			$footer_column_names[4][$language['language_id']] = 'Дополнительно';
			$footer_column_names[5][$language['language_id']] = 'Личный кабинет';

			$contact_section_names[0][$language['language_id']] = 'Адрес';
			$contact_section_names[1][$language['language_id']] = 'Телефоны';
			$contact_section_names[2][$language['language_id']] = '';
			$contact_section_names[3][$language['language_id']] = '';

			$contact_section_texts[0][$language['language_id']] = '<b>Магазин 1</b><br>адрес....<br><br><b>Магазин 2</b><br>адрес....';
			$contact_section_texts[1][$language['language_id']] = '<b>Время работы:</b> Понедельник-Пятница с 9-00 до 19-00<br>Телефон 1<br>Телефон 2<br>Телефон 3';
			$contact_section_texts[2][$language['language_id']] = '';
			$contact_section_texts[3][$language['language_id']] = '';

		}

		$footer_column_types = array(
			1 => 0,
			2 => 1,
			3 => 1,
			4 => 1,
			5 => 1
		);

		$footer_column_menu = array(
			2 => 3,
			3 => 4,
			4 => 5,
			5 => 6
		);

		$colors = array(
			7 => array(
				'font_color' => '3c763d',
				'background_color' => 'dff0d8',
				'border_color' => 'd6e9c6',
			),
			5 => array(
				'font_color' => 'a94442',
				'background_color' => 'f2dede',
				'border_color' => 'ebccd1',
			),
			'default' => array(
				'font_color' => 'ef8400',
				'background_color' => 'dff0d8',
				'border_color' => 'd6e9c6',
			),
		);
		$this->load->model('localisation/stock_status');
		foreach ($this->model_localisation_stock_status->getStockStatuses() as $status) {
			$color_statuses[$status['stock_status_id']] = isset($colors[$status['stock_status_id']]) ? $colors[$status['stock_status_id']] : $colors['default'];
		}

		$this->params = array(
			"debug" => 0,

			// Параметры - Основные
			"logo" => $logo,
			"general_style" => 0,
			"general_background_color" => '#f5f5f5',
			"general_background_image" => '',
			"general_sharing_code" => $general_sharing_code,
			"personal_css" => '',

			// Параметры - Модули
			'module_title_color' => '#000000',
			'module_background_color' => '#ffffff',
			'module_border_color' => '#eeeeee',
			'text_color' => '#595959',
			'title_color' => '#000000',


			// Параметры - Кнопки
			'button_color' => '#ef532b',
			'button_color_text' => '#ffffff',
			'button_color_hover' => '#f57b5d',
			'button_color_text_hover' => '#ffffff',
			'product_thumb_icon_color' => '#ef532b',

			// Параметры - Кнопка "наверх"
			'go_top_background' => '#ef532b',
			'go_top_color' => '#ffffff',
			'go_top_background_hover' => '#a32d11',
			'go_top_color_hover' => '#ffffff',

			// Параметры - Пагинация
			'pagination_background' => '#ffffff',
			'pagination_color' => '#f57b5d',
			'pagination_background_hover' => '#f57b5d',
			'pagination_color_hover' => '#ffffff',
			'pagination_background_active' => '#ef532b',
			'pagination_color_active' => '#ffffff',

			// Параметры - Ссылки
			'link_color' => '#3366ff',
			'link_hover_color' => '#3366ff',

			// Параметры - Табы
			'tab_color' => '#ffffff',
			'tab_text_color' => '#2a77b9',
			'tab_color_hover' => '#2a77b9',
			'tab_text_color_hover' => '#ffffff',
			'tab_color_active' => '#f57b5d',
			'tab_text_color_active' => '#ffffff',


			// Шапка - Липкое меню
			"sticky_menu" => 1,
			"sticky_menu_type" => 0,
			"sticky_menu_items" => 1,
			'sticky_menu_color' => '#000000',
			'sticky_menu_background' => '#ffffff',
			"sticky_menu_image" => '',
			'sticky_menu_icon_color' => '#000000',

			// Шапка - верхний банер
			"top_banner" => 1,
			"top_banner_height" => 52,
			"top_banner_image" => $top_banner_image,
			'top_banner_link' => $top_banner_link,
			'top_banner_background' => '#fff',

			// Шапка - верхнее меню
			"top_menu_items" => 1,
			"top_menu_background" => '#404040',
			"top_menu_color" => '#f7f6f6',
			"top_menu_hover_color" => '#ef532b',
			"top_menu_border_color" => '#41c957',
			'top_menu_height' => 50,
			'top_menu_font_size' => 14,

			// Шапка - верхнее меню - Блок валют
			'currency_bg' => '#000000',
			'currency_color' => '#fff',
			'currency_bg_hover' => '#ef532b',
			'currency_color_hover' => '#ffffff',
			'currency_active_bg' => '#ef532b',
			'currency_active_color' => '#ffffff',
			'currency_active_bg_hover' => '#ffffff',
			'currency_active_color_hover' => '#ffffff',

			// Шапка - верхнее меню - Блок языков
			'language_active_bg' => '#c97c7c',


			// Шапка - Контент
			'top_header_height' => 175,

			"header_background_color" => "#ffffff",
			"header_background_image" => '',
			"header_icon_color" => '#ef532b',

			"phone1" => "<i class='ns-kyivstar'></i> +38 067 670 76 47",
			"phone2" => "<i class='ns-vodafone'></i> +38 050 345 85 65",
			"phone3" => "<i class='ns-lifecell'></i> +38 063 71 707 63",
			"work_time" => $work_time,
			'header_recent_search' => $recent_search,

			// Шапка - Основное меню
			"menu_main_items" => 2,
			"menu_main_type" => 0,
			"menu_main_icon_position" => 'right',
			"menu_main_height" => 52,
			'menu_border_color' => '#ef532b',

			'menu_main_bg_color' => '#ef532b',
			"menu_main_text_color" => '#ffffff',
			'menu_main_bg_hover_color' => '#ef532b',
			"menu_main_text_hover_color" => '#ffffff',
			'menu_main_bg_active_color' => '#ffffff',
			"menu_main_text_active_color" => '#ffffff',
			"menu_main_font_family" => 'Open Sans,Helvetica,sans-serif',
			"menu_main_font_size" => 15,
			"menu_main_icon_height" => 34,

			'menu_sub_bg_color' => '#fff',
			'menu_sub_text_color' => '#000000',
			'menu_sub_bg_hover_color' => '#fff',
			'menu_sub_text_hover_color' => '#ef532b',
			'menu_sub_bg_active_color' => '#fff',
			'menu_sub_text_active_color' => '#ef532b',
			"menu_sub_font_size" => 14,
			"menu_sub_icon_height" => 14,
			'menu_sub_font_family' => 'Open Sans,Helvetica,sans-serif',

			// Подвал
			"footer_sections" => $footer_sections,
			"footer_column_names" => $footer_column_names,
			"footer_column_texts" => $footer_column_texts,
			"footer_column_menu" => $footer_column_menu,
			"footer_column_types" => $footer_column_types,

			// Подвал - Верхняя часть
			"footer_top_background" => '#404040',
			"footer_top_color" => '#ffffff',
			'footer_top_link_hover_color' => '#ffffff',

			// Подвал - Нижняя часть
			"footer_bottom_background" => '#404040',
			"footer_bottom_color" => '#fff',
			"footer_bottom_link_hover_color" => '#fff600',

			// Контакты - Секции
			"contact_sections_status" => 1,
			"contact_section_names" => $contact_section_names,
			"contact_section_texts" => $contact_section_texts,

			// Контакты - Карта
			"contact_map" => 1,
			"contact_google_api_key" => 'AIzaSyBdnZTnJ70b1xTDwLlCP6A1i3wSjdF1wz8',
			"contact_latitude" => '49.823041',
			"contact_longitude" => '23.989231',

			// Контакты - Форма связи
			"contact_form_status" => 1,

			// Категории
			"category_view_type" => 'grid',
			"category_description_position" => 0,
			"column_count" => 3,
			'subcategories_show' => 1,
			'subcategories_image_height' => 80,
			'subcategories_image_width' => 80,
			'product_short_description_length' => 40,

			'product_attributes_status' => 1,
			'product_selected_attributes' => array(),
			'product_selected_attributes_custom_divider' => ', ',
			'product_show_manufacturer' => 1,
			'product_show_model' => 1,
			'product_show_sku' => 0,
			'product_show_weight' => 1,

			// Товар
			"prev_next_status" => 1,
			"prev_next_link_status" => 1,
			"hover_image" => 1,
			'product_zoom' => 1,
			"attributes_title" => array(),
			"colors_status" => $color_statuses,
			"delivery" => $delivery,
			"payment" => $payment,
			"guarantee" => $guarantee,

		);

	}

	public function install()
	{
		// Значения параметров по умолчанию
		$this->initParams($this->params);
	}

	public function uninstall()
	{
		
	}

	public function upgrade()
	{
		// Добавляем недостающие новые параметры
		$this->initParams($this->params);
	}

}
