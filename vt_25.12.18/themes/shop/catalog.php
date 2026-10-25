<?php
if ($t->config->catalog_template) {
	$tpl = str_replace($t->getUrl().'/design/','',$t->config->catalog_template);
} else {
	$tpl = 'page_catalog.twig';
}

$twig->display($tpl);