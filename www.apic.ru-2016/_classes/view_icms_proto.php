<?
require_once(CLASSES_BASE.'class_ice_templates.php');

class view_icms_proto extends view_icms{
var $template = 'proto';


function _view_matomo_stat($t, $o){
	$t->set_block("page", "BLOCK.HAVESTAT", "BLOCK_HAVESTAT");
	$t->set_var("BLOCK_HAVESTAT", "");
	if (preg_match(MATOMO_URL_REGEXP,$o['object']['url'] )){
		$t->set_var("PAGE.clean_url", $o['object']['url'] );
		$t->set_var("PAGE.clean_md5", md5(MATOMO_SECRET.$o['object']['url']) );
		$t->parse("BLOCK_HAVESTAT", "BLOCK.HAVESTAT", true);		
		};
	}

function get_html($o) {
//	alid($o);
	$t = new ice_templates();
	$t->set_file("page", CMS_TEMPLATES_SHARED.$this->template.'.html' );
	$t->set_var("HTTP_BASE", HTTP_BASE );

	$this->_view_standart_seo($t, $o);
	
	// документ
	$t->set_var("PAGE.name", $o['object']['fullname'] );
	$t->set_var("PAGE.document", $o['object']['document'] );
    $this->_view_customed_anonces(&$t, &$o, 'childs', 'ANONS');
	// верхн€€ навигаци€
	$this->_view_standart_top_navigation(&$t, &$o,'NAVIGATION');
	// меню
	$this->_view_standart_left_menu(&$t, &$o);
	
	$this->_view_css_parts(&$t, &$o);
	
	$t->parse("page","page");
	return $t->get("page");
	}


	
function _view_standart_top_banner($t, $o, $NAME='TOPBANNER', $banner='topbanner'){
	$t->set_block("page", "BLOCK.".$NAME, "BLOCK_".$NAME);
	$t->set_var("BLOCK_".$NAME, "");
	while (list($k, $v) = each($o[$banner])) {
		if (isset($v['params']['action_'.$banner]['pvalue'])  && (strlen($v['params']['action_'.$banner]['pvalue'])>10)  ) {
			$t->set_var($NAME.".html", $v['params']['action_'.$banner]['pvalue']);
			$t->parse("BLOCK_".$NAME, "BLOCK.".$NAME, true);
			return 1;
			};
		};
	}

	
	
	
function _view_standart_seo($t, $o){	
	// SEO
	$t->set_var("PAGE.seo_description", htmlspecialchars($o['object']['seo_description']) );
	$t->set_var("PAGE.seo_keywords",    htmlspecialchars($o['object']['seo_keywords']) );
	$t->set_var("PAGE.title", htmlspecialchars($o['object']['seo_title']).(defined('CMS_VARS_TITLE_POSTFIX')?' '.CMS_VARS_TITLE_POSTFIX:'') );
	}
function _view_standart_eng_seo($t, $o){	
	// SEO
	$t->set_var("PAGE.seo_description", htmlspecialchars($o['object']['seo_description']) );
	$t->set_var("PAGE.seo_keywords",    htmlspecialchars($o['object']['seo_keywords']) );
	$t->set_var("PAGE.title", htmlspecialchars($o['object']['seo_title']).(defined('CMS_VARS_TITLE_POSTFIX_ENGLISH')?' '.CMS_VARS_TITLE_POSTFIX_ENGLISH:'') );
	}
	
function _view_standart_parts($t){	

	while(list($k,$v)=each($GLOBALS['CONST'])){
		$t->set_var("CONST.".$k, $v );
		};
	$t->set_var("PAGE.modified", date('Ymd-His-l',filemtime(LAST_MODIFIED)));
	
	$user_defined_constants=get_defined_constants(true);
	while (list($k, $v) = each($user_defined_constants['user'])) {
		if (preg_match('/^(HTTP|LOCATION)/', $k)){
			$t->set_var($k, $v);
			};
		};
	}
	

function json_fix_cyr($var)
{
   if (is_array($var)) {
       $new = array();
       foreach ($var as $k => $v) {
           $new[$this->json_fix_cyr($k)] = $this->json_fix_cyr($v);
       }
       $var = $new;
   } elseif (is_object($var)) {
       $vars = get_object_vars($var);
       foreach ($vars as $m => $v) {
           $var->$m = $this->json_fix_cyr($v);
       }
   } elseif (is_string($var)) {
       $var = iconv('cp1251', 'utf-8', $var);
   }
   return $var;
}
	


function _view_css_parts($t, $o){
	$e = explode('/', $o['object']['url']);
	$e[0]='root';
	unset($e[count($e)-1]);
//alid($e);
	while(list($k,$v)=each($e)){
//		if (preg_match('/^[0-9]{1,}$/',$v)){
			$e[$k] = '_page_'.$v;
//			};
		};
	$ee = trim(implode($e,' '));
	$t->set_var("PAGE.css_parts", $ee);
	}


function _view_standart_top_navigation($t, $o, $NAME='NAVIGATION'){
	$t->set_block("page", "BLOCK.".$NAME, "BLOCK_".$NAME);
	$t->set_var("BLOCK_".$NAME, "");
	//unset($o['navigation'][0]);
	while (list($k, $v) = each($o['navigation'])) {
		if ($v['statushidden'] === 'active' ) {
			$t->set_var($NAME.".name", $v['name']);
			$t->set_var($NAME.".url", $this->get_cms_url('', $v['url']) );  // kluge fix (link can't be parent)
			$t->parse("BLOCK_".$NAME, "BLOCK.".$NAME, true);
			};
		};
	}


function _view_standart_left_menu($t, $o){
	$t->set_block("page", "BLOCK.MENU", "BLOCK_MENU");
	$t->set_var("BLOCK_MENU", "");
	$first = true;
	while (list($k, $v) = each($o['menu'])) {
		if ($v['statushidden'] === 'active' ) {
			$t->set_var("MENU.active", '');
			if ($v['id'] === $o['object']['id'] ) {
				$t->set_var("MENU.active", CMS_VARS_CSS_LEFTMENUACTIVE);
				};
			if ($v['id'] === $o['object']['parent_id'] ) {
				$t->set_var("MENU.active", CMS_VARS_CSS_LEFTMENUACTIVE);
				};
			$t->set_var("MENU.first", ($first)?'first':''  );
			$first = false;
			$t->set_var("MENU.level", $v['level']);
			$t->set_var("MENU.name",  $v['name']);
			$t->set_var("MENU.url",   $this->get_cms_url($v['type'], $v['url']) );
			$t->parse("BLOCK_MENU",   "BLOCK.MENU", true);
			};
		};
	}



	
	
	
	
/*
”меет отрисовывать дерево любого уровн€ вложенности с коректным открытием/закрытием <UL><UL><LI></UL></UL>.
@param  $t  экземпл€р темплейта
@param  $o  массив с данными ( дерево списком, правильный пор€док должна была отдать model )
@param  $tree_magick_name где в массиве с данными искать дерево
@return ничего, измен€ет $t
ѕример шаблона 
					<ul id="Sitemap">
					<!-- BEGIN BLOCK.ALL -->
					<!-- BEGIN BLOCK.BUL -->
					<ul>
					<!-- END BLOCK.BUL -->
					<!-- BEGIN BLOCK.EUL -->
					</ul>
					<!-- END BLOCK.EUL -->
					<!-- BEGIN BLOCK.LI --><li class="level{{LI.currentlevel}}"><span><a href="{{LI.url}}">{{LI.name}}</a></span></li>
					<!-- END BLOCK.LI -->
					<!-- END BLOCK.ALL --></ul>
*/
function _view_tree_menu($t, $o, $tree_magick_name='menu') {

	$t->set_block("page", "BLOCK.ALL", "BLOCK_ALL");
	$t->set_var("BLOCK_ALL", "");
	$t->set_block("BLOCK.ALL", "BLOCK.BUL", "BLOCK_BUL");
	$t->set_var("BLOCK_BUL", "");
	$t->set_block("BLOCK.ALL", "BLOCK.LI", "BLOCK_LI");
	$t->set_var("BLOCK_LI", "");
	$t->set_block("BLOCK.ALL", "BLOCK.EUL", "BLOCK_EUL");
	$t->set_var("BLOCK_EUL", "");
//alid($o[$tree_magick_name]);
//	$level = -1;
	$level = 1;
	if ((isset($o[$tree_magick_name])) && (is_array($o[$tree_magick_name])) && (sizeof($o[$tree_magick_name])>0)) {
		reset(	$o[$tree_magick_name]	);
		while (list($k, $v) = each($o[$tree_magick_name])) {
			if ($v['statushidden']=='active'){
				$t->set_var("BLOCK_BUL", "");
				$t->set_var("BLOCK_EUL", "");

				// увеличилось
				if ($v['level'] > $level) {
//					echo "+";
					$level = $v['level'];
					$t->set_var("LI.currentlevel",   $v['level'] );
					$t->parse("BLOCK_BUL",   "BLOCK.BUL", false);
					};

				// уменьшилось
				if ($v['level'] < $level) {
					for ($i=($level-$v['level']); $i>1; $i--) {
//						echo "-";
						$t->set_var("BLOCK_BUL", "");
						$t->set_var("BLOCK_LI", "");
						$t->set_var("BLOCK_EUL", "");
						$t->set_var("LI.currentlevel",   $v['level'] );
						$t->parse("BLOCK_EUL",   "BLOCK.EUL", false);
						$t->parse("BLOCK_ALL",   "BLOCK.ALL", true);
						};
//					echo "~";
					$t->parse("BLOCK_EUL",   "BLOCK.EUL", false);
					$level = $v['level'];
					};

			$t->set_var("LI.name",   $v['name'] );
			$t->set_var("LI.url",   $v['url'] );
			$t->set_var("LI.currentlevel",   $v['level'] );
			$t->set_var("LI.active", '');
			if ($v['id'] === $o['object']['id'] ) {
				$t->set_var("LI.active", CMS_VARS_CSS_LEFTMENUACTIVE);
				};
			if ($v['id'] === $o['object']['parent_id'] ) {
				$t->set_var("LI.active", CMS_VARS_CSS_LEFTMENUACTIVE);
				};

				$t->parse("BLOCK_LI",   "BLOCK.LI", false);

//				echo "".$v['level']." ";
				$t->parse("BLOCK_ALL",   "BLOCK.ALL", true);
				};
			};

		// данные кончились, но есть незакрытые уровни -> закроем.
		if ($level > 0 ) {
			for ($i=$level; $i>=0; $i--) {
//				echo "=";
				$t->set_var("BLOCK_BUL", "");
				$t->set_var("BLOCK_LI", "");
				$t->set_var("BLOCK_EUL", "");
				$t->parse("BLOCK_EUL",   "BLOCK.EUL", false);
				$t->parse("BLOCK_ALL",   "BLOCK.ALL", true);
				};
			};

		};
	}


		
	
	
	
	
	
	
// какой то странный формат
function _guess_day($date){
	return substr($date,-2);
	}
// какой то странный формат
function _guess_month($date){
	return $this->_month_name(substr($date,-5, 2));
	}

//25.03.2013	
function _guess_day_created($date){
	return substr($date,0,2);
	}
//25.03.2013
function _guess_month_created($date){
	return $this->_month_name(substr($date,3, 2));
	}
function _guess_month_created_full($date){
	return $this->_month_name_full(substr($date,3, 2));
	}
function _guess_year_created($date){
	return substr($date,-4, 4);
	}

/*	
// используетс€ в новост€х 
function _month_name($month) {
	switch ($month) {
		case '': return '';
		case 1: return '€нвар€';
		case 2: return 'феврал€';
		case 3: return 'марта';
		case 4: return 'апрел€';
		case 5: return 'ма€';
		case 6: return 'июн€';
		case 7: return 'июл€';
		case 8: return 'августа';
		case 9: return 'сент€бр€';
		case 01: return '€нвар€';
		case 02: return 'феврал€';
		case 03: return 'марта';
		case 04: return 'апрел€';
		case 05: return 'ма€';
		case 06: return 'июн€';
		case 07: return 'июл€';
		case 08: return 'августа';
		case 09: return 'сент€бр€';
		case 10: return 'окт€бр€';
		case 11: return 'но€бр€';
		case 12: return 'декабр€';
	}
}
*/

function _month_name_full($month) {
	switch ($month) {
		case '': return '';
		case 1: return '€нвар€';
		case 2: return 'феврал€';
		case 3: return 'марта';
		case 4: return 'апрел€';
		case 5: return 'ма€';
		case 6: return 'июн€';
		case 7: return 'июл€';
		case 8: return 'августа';
		case 9: return 'сент€бр€';
		case 01: return '€нвавр€';
		case 02: return 'февврал€';
		case 03: return 'марта';
		case 04: return 'апрел€';
		case 05: return 'ма€';
		case 06: return 'июн€';
		case 07: return 'июл€';
		case 08: return 'августа';
		case 09: return 'сент€бр€';
		case 10: return 'окт€бр€';
		case 11: return 'но€бр€';
		case 12: return 'декабр€';
	}
}


function _month_name($month) {
	switch ($month) {
		case '': return '';
		case 1: return '€нв';
		case 2: return 'фев';
		case 3: return 'мрт';
		case 4: return 'апр';
		case 5: return 'май';
		case 6: return 'июн';
		case 7: return 'июл';
		case 8: return 'авг';
		case 9: return 'сен';
		case 01: return '€нв';
		case 02: return 'фев';
		case 03: return 'мрт';
		case 04: return 'апр';
		case 05: return 'май';
		case 06: return 'июн';
		case 07: return 'июл';
		case 08: return 'авг';
		case 09: return 'сен';
		case 10: return 'окт';
		case 11: return 'нбр';
		case 12: return 'дек';
	}
}

//c параметрами
function _view_customed_anonces($t, $o, $arrayname, $NAME, $force_head = false){
	$t->set_block("page", "BLOCK.HAVE$NAME", "BLOCK_HAVE$NAME");
	$t->set_var("BLOCK_HAVE$NAME", "");
	$t->set_block("BLOCK.HAVE$NAME", "BLOCK.$NAME", "BLOCK_$NAME");
	$t->set_var("BLOCK_$NAME", "");
	if (is_array($o[$arrayname]) && (sizeof($o[$arrayname])>0) ) {
	//	alid($o[$arrayname]);
		while (list($k, $v) = each($o[$arrayname])) {
				$t->set_var("$NAME.date", $v['visdate']);
				// используетс€ в новост€х. и все 
				if ($v['visdate']!=''){
					list($day, $month) = explode('.', $v['visdate']);
					}
				else {
					$day='';
					$month='';
					};
				$t->set_var("$NAME.date2", "<b>$day</b>". $this->_month_name($month));

				$t->set_var("$NAME.id", $v['id']);
				$t->set_var("$NAME.name", $v['name']);
 				$t->set_var("$NAME.fullname", $v['fullname']);

				$t->set_var("$NAME.anons", $v['anons']);
				$t->set_var("$NAME.url", $this->get_cms_url($v['type'], $v['url']) );
				$t->set_var("$NAME.updated", $v['updated']);
				if (isset($v['params'])){
					while (list($kk, $vv) = each($v['params'])) {
//						echo "$NAME.$kk";
						$t->set_var("$NAME.$kk", $vv['pvalue']);
						};
					};
				$t->parse("BLOCK_$NAME", "BLOCK.$NAME", true);
			};
		$t->parse("BLOCK_HAVE$NAME", "BLOCK.HAVE$NAME", false);
		}
	elseif ($force_head==true){
		$t->parse("BLOCK_HAVE$NAME", "BLOCK.HAVE$NAME", false);
		};
	}



// c параметрами и ценами
function _view_customed_anonces_catalog($t, $o, $arrayname, $NAME){
	$t->set_block("page", "BLOCK.HAVE$NAME", "BLOCK_HAVE$NAME");
	$t->set_var("BLOCK_HAVE$NAME", "");
	$t->set_block("BLOCK.HAVE$NAME", "BLOCK.$NAME", "BLOCK_$NAME");
	$t->set_var("BLOCK_$NAME", "");
	if (is_array($o[$arrayname]) && (sizeof($o[$arrayname])>0) ) {
//		alid($o[$arrayname]);
		while (list($k, $v) = each($o[$arrayname])) {
				$t->set_var("$NAME.date", $v['visdate']);
				$t->set_var("$NAME.id", $v['id']);
				$t->set_var("$NAME.name", $v['name']);
				$t->set_var("$NAME.fullname", $v['fullname']);
				$t->set_var("$NAME.anons", $v['anons']);
				$t->set_var("$NAME.url", $this->get_cms_url($v['type'], $v['url']) );
				$t->set_var("$NAME.updated", $v['updated']);
				$t->set_var("$NAME.price", $v['params']['price']['pvalue'] );
				$t->set_var("$NAME.id", $v['id'] );
				if (isset($v['params'])){
					while (list($kk, $vv) = each($v['params'])) {
//						echo "$NAME.$kk";
						$t->set_var("$NAME.$kk", $vv['pvalue']);
						};
					};
				$t->set_var("$NAME.image", 
					(
						isset($v['params']['image']['pvalue']) && 
						(strlen($v['params']['image']['pvalue'])>0) 
						)
						? 
//						'/ii/catalog/'.urlencode($v['params']['image']['pvalue']) : '/ii/catalog/0.gif' );
						$v['params']['image']['pvalue'] : '/c/catalog/0.gif' );
				$price_rur = ($v['params']['price']['pvalue']>0)?
						number_format(
						($v['params']['price']['pvalue'] * $o['money'][			$v['params']['currency']['pvalue']		]['currency']),
						0, '.', '').' руб.'
				:
				//'÷ена по запросу';
				'';

				$price_css = (	$v['params']['price']['pvalue']	>0)?'':'price-on-request';
				$t->set_var("$NAME.price_css", $price_css );

				$t->set_var("$NAME.price_rur", $price_rur );
				$t->parse("BLOCK_$NAME", "BLOCK.$NAME", true);
			};
		$t->parse("BLOCK_HAVE$NAME", "BLOCK.HAVE$NAME", false);
		};
	}



//c параметрами
function _view_2level_anonses($t, $o, $count, $arrname, $NAME){
	//alid($o[$arrname]);
	$t->set_block("page", "BLOCK.HAVE"."$NAME", "BLOCK_HAVE"."$NAME");
	$t->set_var("BLOCK_HAVE"."$NAME", "");
	$t->set_block("BLOCK.HAVE"."$NAME", "BLOCK."."$NAME"."ROW", "BLOCK_"."$NAME"."ROW");
	$t->set_var("BLOCK_"."$NAME"."ROW", "");
	$t->set_block("BLOCK."."$NAME"."ROW", "BLOCK."."$NAME"."TD", "BLOCK_"."$NAME"."TD");
	$t->set_var("BLOCK_"."$NAME"."TD", "");

	$t->set_block("BLOCK."."$NAME"."TD", "BLOCK".".$NAME"."2", "BLOCK_"."$NAME"."2");
	$t->set_var("BLOCK_"."$NAME"."2", "");

	$t->set_block("BLOCK."."$NAME"."ROW", "BLOCK."."$NAME"."TDEMPTY", "BLOCK_"."$NAME"."TDEMPTY");
	$t->set_var("BLOCK_"."$NAME"."TDEMPTY", "");

	if (is_array($o[	$arrname	]) && (sizeof($o[	$arrname	])>0) ) {
		$i=0;
		reset($o[$arrname]);
		while (list($k, $v) = each($o[	$arrname	])) {
			//echo $i;
			$i++;
			$t->set_var("$NAME.i", $i);
			$t->set_var("$NAME.name",   $v['name'] );
 			$t->set_var("$NAME.fullname",   $v['fullname'] );

			$t->set_var("$NAME.anons", $v['anons']);
			$t->set_var("$NAME.url", $this->get_cms_url('', $v['url']) );


				if (isset($v['params'])){
					while (list($kk, $vv) = each($v['params'])) {
//						echo "$NAME.$kk";
						$t->set_var("$NAME.$kk", $vv['pvalue']);
						};
					};


			// 2 уровень 
			$t->set_var("BLOCK_"."$NAME"."2", '');
			if (is_array($v['childs']) && (sizeof($v['childs'])>0) ) {
				while (list($kk, $vv) = each($v['childs'])) {
					//echo "*";
					if ($vv['statushidden'] == 'active') {
						$t->set_var("$NAME"."2.name",  $vv['name'] );

						$t->set_var("$NAME"."2.fullname",  $vv['fullname'] );

						$t->set_var("$NAME"."2.url", $this->get_cms_url('', $vv['url']) );

					if (isset($vv['params'])){
					while (list($kkk, $vvv) = each($vv['params'])) {
//						echo "$NAME.$kk";
						$t->set_var("$NAME".".2".$kk, $vvv['pvalue']);
						};
					};


						$t->parse("BLOCK_"."$NAME"."2", "BLOCK.$NAME"."2", true);
						};
					};
				};

			$t->parse("BLOCK_"."$NAME"."TD", "BLOCK."."$NAME"."TD", true);
			if ($i==$count) {
				$i=0;
				$t->parse("BLOCK_"."$NAME"."ROW", "BLOCK."."$NAME"."ROW", true);
				$t->set_var("BLOCK_$NAME"."TD", "");
				};
			};
		if (($i!=0) && ($i!=$count)){
			for($ii=$i; $ii<$count; $ii++) {
				$t->parse("BLOCK_"."$NAME"."TDEMPTY", "BLOCK."."$NAME"."TDEMPTY", true);
				};
			$t->parse("BLOCK_"."$NAME"."ROW", "BLOCK."."$NAME"."ROW", true);
			};
		$t->parse("BLOCK_HAVE"."$NAME", "BLOCK.HAVE"."$NAME", false);
		};
	}


}
?>
