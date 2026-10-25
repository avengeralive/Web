<?php     
if ($t->config->search_template)
{
	$search_tpl = str_replace($t->getUrl().'/design/','',$t->config->search_template);
}
else
{
	$search_tpl = 'page_search.twig';

}

$a->setPageProperty('title', 'Поиск &mdash; '.$a->getPageProperty('title') );

$twig->display($search_tpl,array(
	'products_type' => \Sale\Product::getObjectDefinition()->id
));