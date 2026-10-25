<?
class model_orders {

function model_orders($m, $mydb){
	$this->m = &$m;
	$this->MYDB = &$mydb;
}


function update_order_status($order_id, $status, $comment, $user_id){
	$q1="
		REPLACE
			".$this->MYDB.".order_status
		SET
		        id_order = #id_order#,
                        status = '#status#',
                        comment = '#comment#',
                        updated = NOW(),
                        user_updated = #user_id#
	";

	$o1 = $this->m->query($q1, __FILE__, __LINE__, Array(
	        'id_order' => $order_id,
	        'status' => $status,
	        'comment' => $comment,
	        'user_id' => $user_id
		));

	if ($this->m->error ) { return Array('status'=>false); };

	return array(
		'status'=>true,
		'calendar' => $o1
		);
}









function get_calendar(){
	$q1="
	SELECT
		distinct(left(created, 7)) as mmm,
		count(id) as count,
		count(distinct session_id) as count_session
	FROM  
		".$this->MYDB.".order_info
	GROUP BY mmm
	ORDER BY mmm DESC
	";

    $o1 = $this->m->selectManyRows($q1, __FILE__, __LINE__, Array(
		));
    if ($this->m->error ) {
        return Array('status'=>false);
        };
	return array(
		'status'=>true,
		'calendar' => $o1
		); 
	}


function get_bydate_orders($mmm){
	$q1 = "
	SELECT
	 	 *
	FROM
		".$this->MYDB.".order_info
	WHERE
		left(created,7) = '#mmm#'
	ORDER BY
		created DESC
	";

	$q2 = "
	SELECT
	 	 order_basket.*,
		 tree.url,
		 CONCAT(docs.fullname, ' ', IFNULL(p3.pvalue,'') ) as item_name,
		 docs.fullname as item_name_old
	FROM
		".$this->MYDB.".order_basket as order_basket
	LEFT JOIN
		tree
	ON 
		order_basket.item_id = tree.id
	LEFT JOIN
		docs
	ON 
		order_basket.item_id = docs.id

    LEFT JOIN 
        ".$this->MYDB.".params as p3
        ON
        p3.doc_id = order_basket.item_id
    AND
        p3.pname = 'article'

	WHERE
		order_id = '#order_id#'
	";

	$q3 = "
	SELECT
	 	 *
	FROM
		".$this->MYDB.".order_status
	WHERE
		id_order = #order_id#
	";

    $o1 = $this->m->selectManyRows($q1, __FILE__, __LINE__, Array(
		'mmm'=>$mmm
		));
    if ($this->m->error ) {
        return Array('status'=>false);
        };

	$o2=array();
	$i = 0;
	while (list($k, $v)=each($o1)) {
		$o_b = $this->m->selectManyRows($q2, __FILE__, __LINE__, Array(
		'order_id'=>$v['id']
		));
		$o_s = $this->m->selectManyRows($q3, __FILE__, __LINE__, Array(
		'order_id'=>$v['id']
		));
	    if ($this->m->error ) {
	        return Array('status'=>false);
	        };
		$o2[$i]['info'] = $v;
		$o2[$i]['basket'] = $o_b;
		$o2[$i]['status'] = $o_s;
		$i++;
		};

	return array(
		'status'=>true,
		'orders' => $o2
		);
	}



function get_last_orders($limit=20){
	$q1 = "

	SELECT
	 	 *
	FROM
		".$this->MYDB.".order_info
	ORDER BY
		id
		desc
	
	LIMIT
		#limit#
	";

	$q2 = "
	SELECT
	 	 order_basket.*,
		 tree.url,
		 docs.fullname as item_name
	FROM
		".$this->MYDB.".order_basket as order_basket
	LEFT JOIN
		tree
	ON 
		order_basket.item_id = tree.id
	LEFT JOIN
		docs
	ON 
		order_basket.item_id = docs.id
	WHERE
		order_id = '#order_id#'
	";

	$q3 = "
	SELECT
	 	 *
	FROM
		".$this->MYDB.".order_status
	WHERE
		id_order = #order_id#
	";

    $o1 = $this->m->selectManyRows($q1, __FILE__, __LINE__, Array(
		'limit'=>$limit
		));
    if ($this->m->error ) {
        return Array('status'=>false);
        };

	$o2=array();
	$i = 0;
	while (list($k, $v)=each($o1)) {
		$o_b = $this->m->selectManyRows($q2, __FILE__, __LINE__, Array(
		'order_id'=>$v['id']
		));
		$o_s = $this->m->selectManyRows($q3, __FILE__, __LINE__, Array(
		'order_id'=>$v['id']
		));

	    if ($this->m->error ) {
	        return Array('status'=>false);
	        };
		$o2[$i]['info'] = $v;
		$o2[$i]['basket'] = $o_b;
		$o2[$i]['status'] = $o_s;
		$i++;
		};

	return array(
		'status'=>true,
		'orders' => $o2
		);
	}




function get_orders_like($txt){
	$q1 = "
	SELECT
	 	 *
	FROM
		".$this->MYDB.".order_info
	WHERE
		CONCAT(fio,email,phone,address,company)
		LIKE '%#txt#%'
	ORDER BY
		created DESC
	";
	$q2 = "
	SELECT
	 	 order_basket.*,
		 tree.url,
		 docs.fullname as item_name
	FROM
		".$this->MYDB.".order_basket as order_basket
	LEFT JOIN
		tree
	ON 
		order_basket.item_id = tree.id
	LEFT JOIN
		docs
	ON 
		order_basket.item_id = docs.id
	WHERE
		order_id = '#order_id#'
	";

	$q3 = "
	SELECT
	 	 *
	FROM
		".$this->MYDB.".order_status
	WHERE
		id_order = #order_id#
	";

    $o1 = $this->m->selectManyRows($q1, __FILE__, __LINE__, Array(
		'txt'=>$txt
		));
    if ($this->m->error ) {
        return Array('status'=>false);
        };

	$o2=array();
	$i = 0;
	while (list($k, $v)=each($o1)) {
		$o_b = $this->m->selectManyRows($q2, __FILE__, __LINE__, Array(
		'order_id'=>$v['id']
		));
		$o_s = $this->m->selectManyRows($q3, __FILE__, __LINE__, Array(
		'order_id'=>$v['id']
		));

	    if ($this->m->error ) {
	        return Array('status'=>false);
	        };
		$o2[$i]['info'] = $v;
		$o2[$i]['basket'] = $o_b;
		$o2[$i]['status'] = $o_s;
		$i++;
		};

	return array(
		'status'=>true,
		'orders' => $o2
		);
	}



	}
?>
