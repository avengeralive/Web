<?php
if ($t->config->order_template) {
	$tpl = str_replace($t->getUrl().'/design/','',$t->config->order_template);
} else {
	$tpl = 'page_order.twig';
}   
$twig->display($tpl, array());    