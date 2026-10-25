<?php

function smarty_modifier_domain( $url )
{
	$result = parse_url($url);
	return !empty($result['host']) ? $result['host'] : '';
}

?>
