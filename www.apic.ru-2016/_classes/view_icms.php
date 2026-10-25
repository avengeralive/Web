<?
class view_icms{

/* для link_static отдаем как есть, для всех остальных нет ... */
static function get_cms_url($type, $url, $force_http_base = false){
	if (  ($force_http_base) && (!preg_match('/^http/', $url, $mm))  ) {
		return HTTP_BASE.$url;
		};
	return (($type=='link_static') ?  $url : HTTP_BASE.$url );
	}

}
?>