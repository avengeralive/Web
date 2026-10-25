<?php
if ($t->config->cart_template) {
	$tpl = str_replace($t->getUrl().'/design/','',$t->config->cart_template);
} else {
	$tpl = 'page_cart.twig';
}

$twig->display($tpl, array(
));        