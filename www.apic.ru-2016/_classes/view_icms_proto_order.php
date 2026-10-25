<?php
require_once(CLASSES_BASE.'view_icms_proto.php');

class view_icms_proto_order extends view_icms_proto{
	var $template = 'proto_order';
	var $o;

	function get_html($o) {
		//alid($o);
		$this->o = $o['object'];
		switch ($o['ID']) {
			case "index":
				return $this->index();
				break;
			case "process_order":
				return $this->process_order();
				break;
			case "remove":
				return $this->remove();
				break;
			case "update":
				return $this->update();
				break;
			case "add":
				return $this->add();
				break;

			case "cookie_disabled":
			//echo "disabled";
				return $this->cookiedisabled();
				break;

			case "order_ok":
				return $this->order_ok();
				break;

			case "check_add":
				return $this->check_add();
				break;
			default:
				return $this->index();
				break;
			}
		}

	function cookiedisabled() {
		$t = new ice_templates();
		$t->set_file("page", TEMPLATES_ROOT .$this->template.".html");


		while (list($k, $v) = each($GLOBALS['CONST'])) {
			$t->set_var("CONST.{$k}", $v);
			}

		$t->set_block('page', 'BLOCK.NOCOOKIE',  'BLOCK_NOCOOKIE');
		$t->set_var('BLOCK_NOCOOKIE', '');
		$t->parse('BLOCK_NOCOOKIE', 'BLOCK.NOCOOKIE', true);

		$t->set_block('page', 'BLOCK.GOTORDER', 'BLOCK_GOTORDER');
		$t->set_var('BLOCK_GOTORDER', '');

		$t->set_block('page', 'BLOCK.HAVEBASKET', 'BLOCK_HAVEBASKET');
		$t->set_var('BLOCK_HAVEBASKET', '');

		$t->set_block('page', 'BLOCK.ORDERFORM', 'BLOCK_ORDERFORM');
		$t->set_var('BLOCK_ORDERFORM', '');

		$t->set_block('page', 'BLOCK.HAVENOBASKET', 'BLOCK_HAVENOBASKET');
		$t->set_var('BLOCK_HAVENOBASKET', '');

		$t->set_block('page', 'BLOCK.ERROR', 'BLOCK_ERROR');
		$t->set_var('BLOCK_ERROR', '');

		$t->set_var('HTTP_BASE', HTTP_BASE);
		$t->set_var('URL_ORDER', URL_ORDER);
		//$this->parse_basket($this->o['basket'], &$t);
		//$this->parse_order_form($order,$order_error,&$t);
      
		//$t->set_block('page', 'BLOCK.ERROR',         'BLOCK_ERROR');
		//$t->set_var('BLOCK_ERROR', '');
		//if (strlen($error)>0) {
			//$t->set_var('error', $error);
			//$t->parse('BLOCK_ERROR', 'BLOCK.ERROR', true);
			//};
		$t->set_var('PAGE.name', '');
		$t->set_var('PAGE.title', 'Оформление заказа');
		$t->parse("page","page");
		$html = $t->get("page");

		return $html;
	}

	function order_ok(){
		$t = new ice_templates();
		$t->set_file("page", TEMPLATES_ROOT.$this->template.".html");

		while(list($k,$v)=each($GLOBALS['CONST'])){
			$t->set_var("CONST.".$k, $v );
			};


		$t->set_block('page', 'BLOCK.NOCOOKIE',         'BLOCK_NOCOOKIE');
		$t->set_var('BLOCK_NOCOOKIE', '');

		$t->set_block('page', 'BLOCK.GOTORDER',         'BLOCK_GOTORDER');
		$t->set_var('BLOCK_GOTORDER', '');
		$t->parse('BLOCK_GOTORDER', 'BLOCK.GOTORDER', true);

		$t->set_block('page', 'BLOCK.HAVEBASKET',         'BLOCK_HAVEBASKET');
		$t->set_var('BLOCK_HAVEBASKET', '');
		$t->set_block('page', 'BLOCK.ORDERFORM',         'BLOCK_ORDERFORM');
		$t->set_var('BLOCK_ORDERFORM', '');
		$t->set_block('page', 'BLOCK.HAVENOBASKET',         'BLOCK_HAVENOBASKET');
		$t->set_var('BLOCK_HAVENOBASKET', '');
		$t->set_block('page', 'BLOCK.ERROR',         'BLOCK_ERROR');
		$t->set_var('BLOCK_ERROR', '');

		$t->set_var('HTTP_BASE', HTTP_BASE);
		$t->set_var('URL_ORDER', URL_ORDER);
		$t->set_var('PAGE.name', '');
		$t->set_var('PAGE.title', 'Заказ оформлен');
		$t->parse("page","page");
		$html =  $t->get("page");

		return $html;
	}






	function index($order=array(
				'fio'=>'',
				'email'=>'',
				'phone'=>'',
				'company'=>'',
				'address'=>'',
				'comment'=>''
				), 
			$order_error =	array(
				'fio_err'=>'',
				'email_err'=>'',
				'phone_err'=>'',
				'company_err'=>'',
				'address_err'=>'',
				'comment_err'=>''
				),
				$error=''
			){
		$t = new ice_templates();
		$t->set_file("page", TEMPLATES_ROOT.$this->template.".html");

		while(list($k,$v)=each($GLOBALS['CONST'])){
			$t->set_var("CONST.".$k, $v );
			};

		$t->set_block('page', 'BLOCK.NOCOOKIE',         'BLOCK_NOCOOKIE');
		$t->set_var('BLOCK_NOCOOKIE', '');
		$t->set_block('page', 'BLOCK.GOTORDER',         'BLOCK_GOTORDER');
		$t->set_var('BLOCK_GOTORDER', '');

		$t->set_var('HTTP_BASE', HTTP_BASE);
		$t->set_var('URL_ORDER', URL_ORDER);
		$this->parse_basket($this->o['basket'], &$t);
		if ((isset($this->o['basket']['item_count'])) &&  ($this->o['basket']['item_count']>0)){
			$this->parse_order_form($order,$order_error,&$t);
			}
		else {
			$t->set_block('page', 'BLOCK.ORDERFORM',         'BLOCK_ORDERFORM');
			$t->set_var('BLOCK_ORDERFORM', '');
			};

		$t->set_block('page', 'BLOCK.ERROR',         'BLOCK_ERROR');
		$t->set_var('BLOCK_ERROR', '');
		if (strlen($error)>0) {
			$t->set_var('error', $error);
			$t->parse('BLOCK_ERROR', 'BLOCK.ERROR', true);
			};
		$t->set_var('PAGE.name', 'Оформление заказа');
		$t->set_var('PAGE.title', 'Оформление заказа');
		$t->parse("page","page");
		$html =  $t->get("page");

		return $html;
		}


	function parse_order_form($d, $e, $t){
		reset($d);
		while (list($k, $v)=each($d)) {
			$t->set_var($k, trim(htmlspecialchars(strip_tags($v)) ));
			};
		reset($e);
		while (list($k, $v)=each($e)) {
			$t->set_var($k, $v );
			};
		}



	function parse_basket($d, $t){
	 //ali_debug('','','',$d);
		$t->set_block('page', 'BLOCK.HAVEBASKET',         'BLOCK_HAVEBASKET');
		$t->set_block('BLOCK.HAVEBASKET', 'BLOCK.BASKET',         'BLOCK_BASKET');
		$t->set_var('BLOCK_HAVEBASKET', '');
		$t->set_var('BLOCK_BASKET', '');
		if (	isset($d['basket']) && (sizeof($d['basket'])>0)		) {
			$greed = 1;
			reset($d['basket']);
			$pz = false;
			while (list($k, $v)=each($d['basket'])) {
				$greed = !$greed;
				$t->set_var('greed', intval($greed) );
				$t->set_var('name', $v['name']);
				$t->set_var('anons', ($v['type']=='folder_catalog_item_group')? $v['anons']:'' );
				$t->set_var('price', ($v['price_ru']>0)?number_format($v['price_ru'],0,'.',''):'По запросу' );
				$t->set_var('last_price', ($v['last_price_ru']>0)?number_format($v['last_price_ru'],0,'.',''):'По запросу' );
				$t->set_var('summ_rur',  ($v['last_price_ru']>0)? number_format( ($v['last_price_ru']*$v['quantity']),0,'.','')   :'По запросу');
	//			$t->set_var('last_price', number_format($v['last_price_ru'],0,'.','') );
	//			$t->set_var('summ_rur', number_format( ($v['last_price_ru']*$v['quantity']),0,'.','')   );
				$t->set_var('url', 
								($v['type']=='folder_catalog_item_card')?
								$v['url']:$v['parent_url'] );
								
				if ($v['type']=='folder_catalog_item_card') {
					$t->set_var('image', (strlen($v['image'])>0)?$v['image']:
							"data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
							);
					}
				else {
						$t->set_var('image', (strlen($v['parent_image'])>0)?$v['parent_image']:
							"data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
							);
						};
				$t->set_var('quantity', $v['quantity']);
				$t->set_var('item_id', $v['item_id']);
				if (!($v['last_price_ru']>0)) {
					$pz = true;
					};
				$t->parse('BLOCK_BASKET', 'BLOCK.BASKET', true);
				};
			$t->set_var('summ_money_rur', ($pz)?'По запросу':number_format($d['summ_money_rur'],0,'.','').' Руб.' );
			$t->parse('BLOCK_HAVEBASKET', 'BLOCK.HAVEBASKET', true);
		$t->set_block('page', 'BLOCK.HAVENOBASKET',         'BLOCK_HAVENOBASKET');
		$t->set_var('BLOCK_HAVENOBASKET', '');
		}
		else {
			// empty
			//$t->parse('BLOCK_HAVENOBASKET', 'BLOCK.HAVENOBASKET', true);
			 
			 //alid($this->o);
			 $this->_view_customed_anonces_catalog(&$t, $this->o, 'special', 'NOBASKET', 5);

			};
		}





	// заказ в процессе оформления - что то не дооформлено
	function process_order(){
	//	ali_debug('','','',$this->o);

		// отпарсим html
		$t = new ice_templates();
		$t->set_file("page", TEMPLATES_ROOT.$this->template.".html");

		while(list($k,$v)=each($GLOBALS['CONST'])){
			$t->set_var("CONST.".$k, $v );
			};

			
		$t->set_var('HTTP_BASE', HTTP_BASE);
		$t->set_var('URL_ORDER', URL_ORDER);

		$t->set_block('page', 'BLOCK.NOCOOKIE',         'BLOCK_NOCOOKIE');
		$t->set_var('BLOCK_NOCOOKIE', '');
		$t->set_block('page', 'BLOCK.GOTORDER',         'BLOCK_GOTORDER');
		$t->set_var('BLOCK_GOTORDER', '');
		$t->set_block('page', 'BLOCK.HAVEBASKET',         'BLOCK_HAVEBASKET');
		$t->set_var('BLOCK_HAVEBASKET', '');
		$t->set_block('page', 'BLOCK.ORDERFORM',         'BLOCK_ORDERFORM');
		$t->set_var('BLOCK_ORDERFORM', '');
		$t->parse('BLOCK_ORDERFORM', 'BLOCK.ORDERFORM', true);
		$t->set_block('page', 'BLOCK.NOBASKET',         'BLOCK_NOBASKET');
		$t->set_var('BLOCK_NOBASKET', '');
		$t->set_block('page', 'BLOCK.HAVENOBASKET',         'BLOCK_HAVENOBASKET');
		$t->set_var('BLOCK_HAVENOBASKET', '');
		$t->set_block('page', 'BLOCK.ERROR',         'BLOCK_ERROR');
		$t->set_var('BLOCK_ERROR', '');
		$t->set_var('error', '<ul>'.$this->o['errors'].'</ul>');
		$t->parse('BLOCK_NOCOOKIE', 'BLOCK.ERROR', true);

	//	$this->parse_basket($this->o['basket'], &$t);
		$this->parse_order_form($this->o['user'],array(),&$t);
	//	$t->set_var('error', $error);
	//	$t->set_var('total_summ_rur', $o_basket['summ_money_rur'] );
		$t->set_var('PAGE.name', 'Оформление заказа');
		$t->set_var('PAGE.title', 'Оформление заказа');
		$t->parse("page","page");
		$html =  $t->get("page");
		return $html;
		}


	// geruway: Вынес сюда этот метод из родительского и добавил новый параметр $per_line.
	// Он задаёт сколько элементов будет в одном ряду. Это нужно для обрыва строки.
	function _view_customed_anonces_catalog($t, $o, $arrayname, $NAME, $per_line = 0){

		$t->set_block("page", "BLOCK.HAVE$NAME", "BLOCK_HAVE$NAME");
		$t->set_var("BLOCK_HAVE$NAME", "");
		$t->set_block("BLOCK.HAVE$NAME", "BLOCK.$NAME", "BLOCK_$NAME");
		$t->set_var("BLOCK_$NAME", "");
		$t->set_block("BLOCK.$NAME", "BLOCK.{$NAME}_BR", "BLOCK_{$NAME}_BR");
		$t->set_var("BLOCK_{$NAME}_BR", "");

		if (is_array($o[$arrayname]) && (sizeof($o[$arrayname]) > 0) ) {
			//alid($o[$arrayname]);
			$i = 0;
			while (list($k, $v) = each($o[$arrayname])) {
				$t->set_var("BLOCK_{$NAME}_BR", "");

				$t->set_var("$NAME.date", $v['visdate']);
				$t->set_var("$NAME.id", $v['id']);
				$t->set_var("$NAME.name", $v['name']);
				$t->set_var("$NAME.fullname", $v['fullname']);
				$t->set_var("$NAME.anons", $v['anons']);
				$t->set_var("$NAME.url", $this->get_cms_url($v['type'], $v['url']) );
				$t->set_var("$NAME.updated", $v['updated']);
				$t->set_var("$NAME.price", $v['params']['price']['pvalue'] );
				$t->set_var("$NAME.id", $v['id'] );

				if (isset($v['params'])) {
					while (list($kk, $vv) = each($v['params'])) {
						//echo "$NAME.$kk";
						$t->set_var("$NAME.$kk", $vv['pvalue']);
					};
				};
				$t->set_var("$NAME.image", 
					(
						isset($v['params']['image']['pvalue']) && 
						(strlen($v['params']['image']['pvalue'])>0) 
					)
					? 
					//'/ii/catalog/'.urlencode($v['params']['image']['pvalue']) : '/ii/catalog/0.gif' );
					$v['params']['image']['pvalue'] : '/c/catalog/0.gif'
				);
				$price_rur =
					($v['params']['price']['pvalue'] > 0)
					?
					number_format(
						($v['params']['price']['pvalue'] * $o['money'][  $v['params']['currency']['pvalue']  ]['currency']),
						0, '.', ''
					)
					:
					'Цена по запросу';

				$price_css = ( $v['params']['price']['pvalue'] > 0 ) ? '' : 'price-on-request';
				$t->set_var("$NAME.price_css", $price_css );
				$t->set_var("$NAME.price_rur", $price_rur );

				$i++;
				if (
					$per_line &&
					$i % $per_line == 0 &&
					$i != count($o[$arrayname])
				) {
					$t->parse("BLOCK_{$NAME}_BR", "BLOCK.{$NAME}_BR", false);
				}

				$t->parse("BLOCK_$NAME", "BLOCK.$NAME", true);
			};
			$t->parse("BLOCK_HAVE$NAME", "BLOCK.HAVE$NAME", false);
		};
	}
}


?>