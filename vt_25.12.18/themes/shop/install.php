<?php
namespace Cetera;

$url = '/themes/shop';
if ($currentTheme) {
	$url = $currentTheme->getUrl();
}

$config = array(

	'language' => 'ru',

	'product_catalog' => 2,

	'logo'    => $url.'/images/logo.svg',
	'phone'   => '8 (800) 775-52-93',
	'email'   => 'welcome@fastsite.ru',
	'address' => '150040, город Ярославль, проспект Ленина, дом 25, офис 603',
	'css'     => '',
	'js'      => '',
	'layout_template'   => $url.'/design/layout.twig',
	'css_main'          => $url.'/css/style.css',
	'index_template'    => $url.'/design/page_index.twig',
	'section_template'  => $url.'/design/page_section.twig',
	'search_template'   => $url.'/design/page_search.twig',
	'news_template'     => $url.'/design/page_news.twig',
	'catalog_template'  => $url.'/design/page_catalog.twig',
	'order_template'    => $url.'/design/page_order.twig',
	'cart_template'     => $url.'/design/page_cart.twig',
	'left_column_template' => $url.'/design/block_left_column.twig',
);

foreach (Server::enum() as $s) {
	
	if ($currentTheme) $currentTheme->loadConfig( $s );

	if (!$currentTheme || !$currentTheme->config) 
	{
		$res = $config;
	}
	else
	{
		$current = get_object_vars($currentTheme->config);   
		$res = array_merge( $config, $current );
	}
		
	$currentTheme->setConfig( $res, $s );
	
}

// установить модуль торговля, если его нет
if (!Plugin::find('sale')) 
{
	if ($status) $status('<b>'.$translator->_('Установка плагина').' sale</b>', true);
	Plugin::install('sale', $status, $translator);
}

// установить модуль комментарии, если его нет
if (!Plugin::find('comments')) 
{
	if ($status) $status('<b>'.$translator->_('Установка плагина').' comments</b>', true);
	Plugin::install('comments', $status, $translator);
}