<?php      
$uu = $a->getUnparsedUrl();

if ($t->config->section_template) {
	$tpl = str_replace($t->getUrl().'/design/','',$t->config->section_template);
} else {
	$tpl = 'page_section.twig';
}

$list_where = null;
if ($_GET['date'])
{
	$list_where = 'DATE_FORMAT(dat,"%Y-%m-%e")="'.addslashes($_GET['date']).'"';
}

$twig->display($tpl, array(
	'list_where' => $list_where
));