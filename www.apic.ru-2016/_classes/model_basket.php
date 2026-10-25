<?
class model_basket{

public $order_id = 0;
private $city_id = 0;

private $avail_map = array(
		'0'=>'zakaz',
		'1'=>'no',
		'2'=>'yes',
		''=>'unknown'
		);
private $avail_default = 'unknown';

function model_basket($m, $city_id=0){
	$this->m = &$m;
	$this->city_id = $city_id;
	}







/*
Список городов в которые есть доставка
*/
function _get_active_citys_list(){
	$q2 = "
	SELECT
		*
	FROM
		".MYSQL_DB.".region_city
	WHERE
		francise_id > 0 
	AND 
		status = 'active'
	AND
		id < 99999
	ORDER BY
		name ASC
		";
	$o2 = $this->m->selectManyRowsByID( $q2, 'id', __FILE__, __LINE__, Array(
		));
	return array(
		'status'=>true,
		'list'=>$o2
		);
	}










function add_item_to_basket($session_id, $item_id, $q){
	// сначала попробуем обновить
	$q1 = "
	UPDATE
		".MYSQL_DB.".basket
	SET
		quantity = quantity+#q#
	WHERE
		session_id = '#session_id#'
	AND
		item_id = '#item_id#'
	AND 
		status = 'active'
		";
	$q2 = "
	INSERT
		".MYSQL_DB.".basket
	SET
		session_id = '#session_id#',
		city_id = #city_id#,
		item_id = '#item_id#',
		quantity = #q#,
		status = 'active',
		created = NOW(),
		updated = NOW()
		";

    $o1 = $this->m->query($q1, __FILE__, __LINE__, Array(
		'session_id'=>$session_id,
		'q'=>$q,
		'item_id'=>$item_id
		));
	if (!($this->m->rows)) {
	    $o2 = $this->m->query($q2, __FILE__, __LINE__, Array(
			'session_id'=>$session_id,
			'city_id'=>$this->city_id,
			'q'=>$q,
			'item_id'=>$item_id
			));
		};

	return array(
		'status'=>true
		);
	}



function remove_from_basket($session_id, $item_id){
	$q2 = "
	UPDATE
		".MYSQL_DB.".basket
	SET
		status = 'blocked'
	WHERE
		session_id = '#session_id#'
	AND
		item_id = '#item_id#'
		";

	$o2 = $this->m->query($q2, __FILE__, __LINE__, Array(
		'session_id'=>$session_id,
		'item_id'=>$item_id
		));

	return array(
		'status'=>true
		);
	}



function update_quantity_in_basket($session_id, $item_id, $quantity){
	$q2 = "
	UPDATE
		".MYSQL_DB.".basket
	SET
		quantity = '#quantity#'
	WHERE
		session_id = '#session_id#'
	AND
		item_id = '#item_id#'
	AND 
		status = 'active'
		";

	$o2 = $this->m->query($q2, __FILE__, __LINE__, Array(
		'session_id'=>$session_id,
		'item_id'=>$item_id,
		'quantity'=>$quantity
		));

	return array(
		'status'=>true
		);
	}



function add_order($session_id, $fio, $email, $phone, $address, $company, $file,
	$o_basket=array(), // тот самый массив что нам отдает ->get_basket($session_id)
	 $order_type = 'unknown'
	){

	// запишем что он о себе написал
	$q1="
	INSERT
		".MYSQL_DB.".order_info
	SET
		session_id = '#session_id#',
		order_type = '#order_type#',
		city_id = #city_id#,		
		fio = '#fio#', 
		email = '#email#', 
		phone = '#phone#', 
		address = '#address#',
		company = '#company#',
		file = '#file#',
		created = NOW(),
		updated = NOW()
	";

	// перенесем его корзину в архив покупок
	$q2="
	INSERT
		".MYSQL_DB.".order_basket
	SET
		session_id = '#session_id#',
		city_id = #city_id#,
		order_id = '#order_id#', 
		item_id = '#item_id#',
		quantity = #quantity#,
		avail = '#avail#',
		last_price_ru = #last_price_ru#,
		created = NOW(),
		updated = NOW()
	";

	// закроем его сессию (очистим все что у него в корзине)
	$q3="
	UPDATE
		".MYSQL_DB.".basket
	SET
		status = 'buyed'
	WHERE
		session_id = '#session_id#'
	AND
		status = 'active'
		";

	$o1 = $this->m->query($q1, __FILE__, __LINE__, Array(
		'session_id'=>$session_id,
		'order_type'=>$order_type,
		'city_id'=>$this->city_id,
		'fio'=>$fio,
		'email'=>$email,
		'phone'=>$phone,
		'address'=>$address,
		'company'=>$company,
		'file'=>$file
		));

	$order_id = $this->m->insert_id;
	$this->order_id = $order_id;

	while (list($k, $v)=each($o_basket['basket'])) {
		$o2 = $this->m->query($q2, __FILE__, __LINE__, Array(
			'order_id'=>$order_id,
			'city_id'=>$this->city_id,
			'session_id'=>$v['session_id'],
			'item_id'=>$v['item_id'],
			'quantity'=>$v['quantity'],
			'avail'=>isset($this->avail_map[$v['avail']])?$this->avail_map[$v['avail']]:$this->avail_default,
			'last_price_ru'=>$v['last_price_ru']
			));
		};

	$o3 = $this->m->query($q3, __FILE__, __LINE__, Array(
		'session_id'=>$session_id
		));

	return array(
		'status'=>true
		);
	}




function get_basket($session_id){
	$q = "
	SELECT
	 	  basket.*,
          docs.fullname as name,
          docs.anons,
          tree.url,
          tree.type,
          tree.type,

          parentree.type as parent_type,
          parentree.name as parent_name,
          parentree.url as parent_url,
          p33.pvalue as parent_image,

          p1.pvalue as price,
          p1.pvalue as specprice,
          p2.pvalue as money_id,
          p3.pvalue as image,
          (p1.pvalue * money.currency) as price_ru,
          (p1.pvalue * money.currency) as specprice_ru,
		  IFNULL(p4.pvalue,'')  as avail,
		  'disabled' as discount7
	FROM
		".MYSQL_DB.".basket

    LEFT JOIN 
        ".MYSQL_DB.".tree
      ON
        basket.item_id = tree.id

    LEFT JOIN 
        ".MYSQL_DB.".tree as parentree
      ON
        tree.parent_id = parentree.id

	LEFT JOIN 
        ".MYSQL_DB.".docs
      ON
        basket.item_id = docs.id

    LEFT JOIN 
        ".MYSQL_DB.".params as p1
        ON
        p1.doc_id = basket.item_id
    AND
        p1.pname = 'price'

    LEFT JOIN 
        ".MYSQL_DB.".params as p4
        ON
        p4.doc_id = basket.item_id
    AND
        p4.pname = 'yandexmarket'


	LEFT JOIN 
        ".MYSQL_DB.".params as p2
        ON
        p2.doc_id = basket.item_id
    AND
        p2.pname = 'currency'

	LEFT JOIN 
        ".MYSQL_DB.".params as p3
        ON
        p3.doc_id = basket.item_id
    AND
        p3.pname = 'image'

	LEFT JOIN 
        ".MYSQL_DB.".params as p33
        ON
        p33.doc_id = tree.parent_id
    AND
        p33.pname = 'image'


	LEFT JOIN
		".MYSQL_DB.".money
	ON 
		p2.pvalue  = money.id

	WHERE
		basket.session_id = '#session_id#'
	AND
		basket.status = 'active'
	ORDER BY
		basket.created
	";

    $o1 = $this->m->selectManyRows($q, __FILE__, __LINE__, Array(
		'session_id'=>$session_id
		));


//    ali_debug('','','',$o1);

    if ($this->m->error ) {
//        $this->m->rollback(__FILE__, __LINE__);
        return Array('status'=>false);
        };

	$item_count = 0;
	$summ_money_rur = 0;
	$o = array();
	$i=1;
	while (list($k, $v)=each($o1)) {
		$o[$i] = $v;
		$item_count += $v['quantity'];

		$o[$i]['price_ru']= number_format($v['price_ru'],2,'.','');
		$o[$i]['last_price_ru']= number_format($v['price_ru'],2,'.','');
		$summ_money_rur += (($v['quantity'])*($o[$i]['last_price_ru']));   // нужно писать в рублях!

		$i++;
		};
//alid($o);
//exit();
	return array(
		'status'=>true,
		'basket' => $o,
		'item_count'=>$item_count,
		'summ_money_rur'=>number_format($summ_money_rur, 2, '.', '')
		);
	}












/* 
Получить список заказов, которые делал человек на сайте
*/
function get_order_info_by_userid( $user_id ) {
	$q = "
		SELECT 
			*
		FROM
			".MYSQL_DB.".order_info
		WHERE
			user_id = #user_id#
		";

	$q2 = "
		SELECT 
			*
		FROM
			".MYSQL_DB.".order_basket
		LEFT JOIN
			".MYSQL_DB.".tree
		ON
			order_basket.item_id = tree.id
		WHERE
			order_id = #order_id#
		";

	$q3 = "
		SELECT 
			*
		FROM
			".MYSQL_DB.".params
		WHERE
			doc_id = #doc_id#
		";

    $o = $this->m->selectManyRows($q, __FILE__, __LINE__, Array(
			'user_id'=>$user_id
			));

	foreach($o as $k => $v) {
	    $o2 = $this->m->selectManyRows($q2, __FILE__, __LINE__, Array(
				'order_id'=>$v['id']
				));
		$o[$k]['items'] = $o2;

		foreach($o2 as $k2 => $v2) {
		    $o3 = $this->m->selectManyRowsByID($q3, 'pname', __FILE__, __LINE__, Array(
					'doc_id'=>0+$v2['id']
					));
			$o[$k]['items'][$k2]['params'] = $o3;
		}
	}

	if ($this->m->error ) {
		return Array('status'=>false);
	}

	return array(
		'status'=>true,
		'list' => $o
	);
}










	}
?>