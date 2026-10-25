<?php      
if ($t->config->news_template) {
	$tpl = str_replace($t->getUrl().'/design/','',$t->config->news_template);
} else {
	$tpl = 'page_news.twig';
}
       
$twig->display($tpl, array(
));        