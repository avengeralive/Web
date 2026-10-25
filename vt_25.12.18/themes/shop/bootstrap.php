<?php
ini_set('display_errors',1);

$a = Cetera\Application::getInstance();

// Сервер
$s = $a->getServer();

// Активный раздел
$c = $a->getCatalog();

// Tema
$t = $s->getTheme();

if ($t->config->language) {
	$a->setLocale($t->config->language);
}

$product_catalog = \Cetera\Catalog::getById( $t->config->product_catalog );

$title = ($s->meta_title)?$s->meta_title:$s->name;
$a->setPageProperty('title', $title);
$a->addHeadString('<meta property="og:title" content="'.$title.'"/>', 'og:title');

if ($c->pic)
{
	$a->addHeadString('<meta property="og:image" content="http://'.$_SERVER['SERVER_NAME'].$c->pic.'"/>', 'og:image');
}

$cat = $c;
while (!$a->getPageProperty('keywords') && !$cat->isRoot()) {
	$a->setPageProperty('keywords', $cat->meta_keywords);
    $cat = $cat->getParent();
}

$cat = $c;
while (!$a->getPageProperty('description') && !$cat->isRoot()) {
	$a->setPageProperty('description', $cat->meta_description);
    $cat = $cat->getParent();
}

$a->addScript($t->getUrl().'/js/lib.js');
$a->addScript($t->getUrl().'/js/app30081.js');
$a->addScript($t->getUrl().'/js/jquery.elevatezoom.js');
$a->addScript($t->getUrl().'/js/jquery.fancybox.pack.js');
if ($t->config->js) $a->addScript($t->config->js);

$a->addCSS($t->config->css_main?$t->config->css_main:$t->getUrl().'/css/style.css');
$a->addCSS('/themes/shop/css/jquery.fancybox.css');
if ($t->config->css) $a->addCSS($t->config->css);

$twig = $a->getTwig();

if ($t->config->layout_template) {
	$layout = str_replace($t->getUrl().'/design/','',$t->config->layout_template);
} else {
	$layout = 'layout.twig';
}

if ($t->config->personal_template) {
	$personal = str_replace($t->getUrl().'/design/','',$t->config->personal_template);
} else {
	$personal = 'page_personal.twig';
}

if ($t->config->left_column_template) {
	$left_column = str_replace($t->getUrl().'/design/','',$t->config->left_column_template);
} else {
	$left_column = 'block_left_column.twig';
}

if ($t->config->favicon)
{
	$a->addHeadString('<link rel="icon" href="'.$t->config->favicon.'" type="image/x-icon">');
	$a->addHeadString('<link rel="shortcut icon" href="'.$t->config->favicon.'" type="image/x-icon">	');
}

// Проверяем, доступен ли модуль Торговля
$pf = Cetera\Plugin::find('sale');
if ($pf) $pf = $pf->isEnabled();
if (!$pf) die('отсутствует модуль sale');

$twig->addGlobal('s',  $_SERVER);
$twig->addGlobal('server',  $s);
$twig->addGlobal('catalog', $c);
$twig->addGlobal('user', $a->getUser() );
$twig->addGlobal('cart', \Sale\Cart::get() );
$twig->addGlobal('config',  $t->config);
$twig->addGlobal('basePath', $t->getUrl().'/');
$twig->addGlobal('layout', $layout);
$twig->addGlobal('personal', $personal);
$twig->addGlobal('left_column', $left_column);
$twig->addGlobal('product_object_definition',  \Sale\Product::getObjectDefinition() );
$twig->addGlobal('product_catalog',  $product_catalog );

$a->registerWidget(array(
	'name'          => 'SaleWishlist.Line',
	'class'         => '\\SaleWishlist\\WidgetLine',
	'not_placeable' => true
));
$a->registerWidget(array(
	'name'          => 'VjcSearch',
	'class'         => '\\VjcSearch\\WidgetSearch',
	'not_placeable' => true
));
