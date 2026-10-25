<?
require_once(CLASSES_BASE.'view_icms_proto.php');

class view_icms_form_search extends view_icms_proto{
var $template = 'form_search';

function get_html($o) {
//alid($o);
	$t = new ice_templates();
	$t->set_file("page", CMS_TEMPLATES_SHARED.$this->template.'.html' );
	$t->set_var("HTTP_BASE", HTTP_BASE );
	$t->set_var("PAGE.url", HTTP_BASE.$o['object']['url'] );
	$t->set_var("PAGE.seo_description", htmlspecialchars($o['object']['seo_description']) );
	$t->set_var("PAGE.seo_keywords",    htmlspecialchars($o['object']['seo_keywords']) );
	$t->set_var("PAGE.title", 'Поиск '.htmlspecialchars(strip_tags($o['q'])) );
	$t->set_var("PAGE.name", $o['object']['fullname'] );
	$t->set_var("PAGE.document", $o['object']['document'] );
	$t->set_var("PAGE.q", htmlspecialchars(strip_tags($o['q'])) );
	$t->set_var("PAGE.total_results", $o['total_results'] );
	$this->_view_standart_top_navigation(&$t, &$o,'NAVIGATION');
//	$this->_view_standart_left_menu(&$t, &$o);
	$this->_view_css_parts(&$t, &$o);
    $this->_view_customed_search_anonces(&$t, &$o, 'search', 'RESULT');

	$this->_view_standart_parts(&$t);
	$this->_view_css_parts(&$t, &$o);


	$t->set_var("BANNERS_ALL_LEFT.document", $o['b1']['document'] );
	$t->set_var("BANNERS_ALL_TOP.document", $o['b2']['document'] );
	$t->set_var("BANNERS_ALL_BOTTOM.document", $o['b3']['document'] );
	$t->set_var("BANNERS_INDEX_MIDDLE.document", $o['b4']['document'] );
	$t->set_var("BANNERS_NAV_LEFT.document", $o['b5']['document'] );
	$t->set_var("BANNERS_CNT_BOTTOM.document", $o['b6']['document'] );

	$t->parse("page","page");
	return $t->get("page");
	}


function _view_customed_search_anonces($t, $o, $arrayname, $NAME) {
	//alid($o['search']);
	$t->set_block("page", "BLOCK.HAVE$NAME", "BLOCK_HAVE$NAME");
	$t->set_var("BLOCK_HAVE$NAME", "");
	$t->set_block("BLOCK.HAVE$NAME", "BLOCK.$NAME", "BLOCK_$NAME");

	$t->set_block("BLOCK.$NAME", "BLOCK.BUY$NAME", "BLOCK_BUY$NAME");
	$t->set_block("BLOCK.$NAME", "BLOCK.NOBUY$NAME", "BLOCK_NOBUY$NAME");
	$t->set_var("BLOCK_$NAME", "");
	$t->set_var("BLOCK_NOBUY$NAME", "");
	$t->set_var("BLOCK_BUY$NAME", "");

	$t->set_block("page", "BLOCK.NORESULTS", "BLOCK_NORESULTS");
	$t->set_var("BLOCK_NORESULTS", "");
	$t->set_block("page", "BLOCK.HAVEPAGES", "BLOCK_HAVEPAGES");
	$t->set_block("BLOCK.HAVEPAGES", "BLOCK.PAGES", "BLOCK_PAGES");
	$t->set_var("BLOCK_PAGES", "");
	$t->set_var("BLOCK_HAVEPAGES", "");

	if ( is_array($o[$arrayname]) && sizeof($o[$arrayname])>0 ) {
		while (list($k, $v) = each($o[$arrayname])) {
			$t->set_var("BLOCK_NOBUY$NAME", "");
			$t->set_var("BLOCK_BUY$NAME", "");

			$t->set_var("$NAME.sid", $v['sid']);

			//$t->set_var("$NAME.date", $v['visdate']);
			$t->set_var("$NAME.id", $v['descr']['id']);
			$t->set_var("$NAME.name", $v['descr']['name']);
			$t->set_var("$NAME.anons",  
					(strlen($v['descr']['anons'])>50)?
					(substr(strip_tags($v['descr']['anons']), 0, 300)) :
					(substr(strip_tags($v['descr']['document']), 0, 300)) 
					);
			$t->set_var("$NAME.weights_debug", $v['weight'].' '.$v['weights_debug']);

			$t->set_var("$NAME.url", $this->get_cms_url($v['descr']['type'], $v['descr']['url']) );
			//$t->set_var("$NAME.updated", $v['updated']);

			if (
				false
				) {
				//$t->set_var("$NAME.price", $v['params']['price']['pvalue']);
				$price_rur = '';
				if (
					isset($v['params']['price']) && isset($v['params']['price']['pvalue']) &&
					isset($v['params']['currency']) && isset($v['params']['currency']['pvalue']) &&
					isset($o['money']) &&
					isset($o['money'][ $v['params']['currency']['pvalue'] ]['currency'])
				) {
					$price_rur = number_format(
						($v['params']['price']['pvalue']    *    $o['money'][  $v['params']['currency']['pvalue']  ]['currency']),
						0, '.', ''
					);
				}
				$t->set_var("$NAME.price", $price_rur );
				$t->set_var("$NAME.image",    isset($v['params']['image']) && isset($v['params']['image']['pvalue'])  ?  $v['params']['image']['pvalue']  :  ''    );

				$t->parse("BLOCK_BUY$NAME", "BLOCK.BUY$NAME", true);
			} else {
				$t->parse("BLOCK_NOBUY$NAME", "BLOCK.NOBUY$NAME", true);
			}
			$t->parse("BLOCK_$NAME", "BLOCK.$NAME", true);
		}
		$t->parse("BLOCK_HAVE$NAME", "BLOCK.HAVE$NAME", false);


		// листалка
		$maxpages = ceil($o['total_results']/SPHINX_RESULTS_PER_PAGE);
		if ($maxpages>1) {
			$maxpages = min($maxpages, SPHINX_RESULTS_MAX_PAGES);
			for ($i=1;$i<=$maxpages;$i++){
				$t->set_var("PAGES.i", $i  );
				$t->set_var("PAGES.name", ($i-1)*SPHINX_RESULTS_PER_PAGE.'-'.min($i*SPHINX_RESULTS_PER_PAGE,$o['total_results'])  );
				$t->set_var("PAGES.url", SPHINX_DEFAULT_URL.'?q='.urlencode(htmlspecialchars($o['q'])).'&page='.$i);
				$t->set_var("PAGES.current", ($i==$o['page'] && !$o['showall'] )?'active':'' );
				$t->parse("BLOCK_PAGES", "BLOCK.PAGES", true);
			}
			$t->set_var("PAGES.urlall", SPHINX_DEFAULT_URL.'?q='.urlencode(htmlspecialchars($o['q'])).'&showall=1');
			$t->set_var("PAGES.allcurrent", $o['showall']?'active':''  );
			$t->parse("BLOCK_HAVEPAGES", "BLOCK.HAVEPAGES", true);
		}

	} else {
		// no results
		$t->parse("BLOCK_NORESULTS", "BLOCK.NORESULTS", true);
		//$t->parse("BLOCK_HAVEPAGES", "BLOCK.HAVEPAGES", true);
	}
}

}
?>
