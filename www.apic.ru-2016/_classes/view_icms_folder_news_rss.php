<?
require_once(CLASSES_BASE.'view_icms_folder.php');
class view_icms_folder_news_rss extends view_icms_folder{
var $template = 'folder_news_rss';

function get_html($o) {
	$t = new ice_templates();
	$t->set_file("page", CMS_TEMPLATES_SHARED.$this->template.'.html' );
	$t->set_var("HTTP_BASE", HTTP_BASE );
	$this->_view_rss_anonces(&$t, &$o);
	$t->parse("page","page");
	header('content-type: application/xml');
	return $t->get("page");
	}

function _view_rss_anonces($t, $o){
	$t->set_block("page", "BLOCK.HAVEANONSES", "BLOCK_HAVEANONSES");
	$t->set_var("BLOCK_HAVEANONSES", "");
	$t->set_block("BLOCK.HAVEANONSES", "BLOCK.ANONS", "BLOCK_ANONS");
	$t->set_var("BLOCK_ANONS", "");
	if (is_array($o['childs']) && (sizeof($o['childs'])>0) ) {
		while (list($k, $v) = each($o['childs'])) {
			$t->set_var("ANONS.name", str_replace('&', '&amp;', trim($v['name'])) );
		
			$t->set_var("ANONS.date", $v['created']);
			
			if (strlen($v['anons'])>10){
				$t->set_var("ANONS.anons", str_replace('&', '&amp;', htmlspecialchars(  strip_tags($v['anons']) ) ) );
				}
			else {
				$t->set_var("ANONS.anons", str_replace('&', '&amp;', htmlspecialchars(strip_tags($v['document']) ) ) );
				};
			$t->set_var("ANONS.url", $this->get_cms_url($v['type'], $v['url'], true) );
		//	$t->set_var("ANONS.updated", $this->_get_rss_datetime($v['created'])  );
			$t->parse("BLOCK_ANONS", "BLOCK.ANONS", true);
			};
		$t->parse("BLOCK_HAVEANONSES", "BLOCK.HAVEANONSES", false);
		};
	}

function _get_rss_datetime($d) {
	// Sun, 19 May 2002 15:21:36 GMT
	if (preg_match("/([0-9]{4})([0-9]{2})([0-9]{2})([0-9]{2})([0-9]{2})([0-9]{2})/", $d, $m)) {
		$year=$m[1];
		$month=$m[2];
		$day=$m[3];
		$h=$m[4];
		$min=$m[5];
		$sec=$m[6];
		$ts = mktime ($h, $min, $sec, $month, $day, $year);
		return gmdate("D, d M Y H:i:s", $ts)." GMT";
		}
	else {
		return '';
		};
	}

}
?>