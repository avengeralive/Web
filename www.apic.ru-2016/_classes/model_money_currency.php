<?
class model_money_currency  {

function model_money_currency($m){
	$this->m = &$m;
	}


function get_all() {
	$q = "
	SELECT 
		*
	FROM
		".MYSQL_DB.".money
		";
    $o = $this->m->selectManyRowsByID( $q, 'id', __FILE__, __LINE__, Array(
		));
    if ($this->m->error ) {
        return Array('status'=>false);
        };
	return array(
		'status'=>true,
		'curr' => $o
		);
	}


function get_all_curr() {
	$q = "
	SELECT 
		*
	FROM
		".MYSQL_DB.".money
		";
    $o = $this->m->selectManyRowsByID($q, 'id', __FILE__, __LINE__, Array(
		));
    if ($this->m->error ) {
        return Array('status'=>false);
        };
	return array(
		'status'=>true,
		'curr' => $o
		);
	}


function update_currency($id, $currency ){
	$q = "
	UPDATE
		".MYSQL_DB.".money
	SET
		currency = '#currency#',
		updated = NOW()
	WHERE
		id = '#id#'
		";

    $o = $this->m->query($q,  __FILE__, __LINE__, Array(
		'id'=>$id,
		'currency'=>$currency
		));

    if ($this->m->error ) {
//        $this->m->rollback(__FILE__, __LINE__);
        return Array('status'=>false);
        };
	}



/**
*   Из админки
*/
public function update_currency_type_hands($id, $type, $percent_cbrf,$currency_hand){

	// парсер ест кавычки, поэтому так странно обновляем =)
	$currency = ($type=='hand')?"'".$currency_hand."'": ' currency_cbrf+currency_cbrf*percent_cbrf/100 ';
	$q = "
	UPDATE
		".MYSQL_DB.".money
	SET
		type = '#type#',
		percent_cbrf = '#percent_cbrf#',
		currency_hand = '#currency_hand#',
		currency = ".$currency.",
		updated = NOW()
	WHERE
		id = #id#
		";
    $o = $this->m->query($q,  __FILE__, __LINE__, Array(
		'id'=>$id,
		'type'=>$type,
		'percent_cbrf'=>$percent_cbrf,
		'currency_hand'=>$currency_hand,
		'currency'=>$currency
		));
    if ($this->m->error ) {
//        $this->m->rollback(__FILE__, __LINE__);
        return Array('status'=>false);
        };
	}



/**
*   При обновлении курса валют
*/
public function update_currency_cbrf($id, $currency_cbrf){

	$c = $this->get_all();
	$type = $c['curr'][$id]['type'];
//	alid($type);

	// парсер ест кавычки, поэтому так странно обновляем =)
	$currency = ($type=='hand')?"currency+0": ' currency_cbrf+currency_cbrf*percent_cbrf/100 ';

	$q = "
	UPDATE
		".MYSQL_DB.".money
	SET
		currency_cbrf = '#currency_cbrf#',
		updated_cbrf  = NOW(),
		updated = NOW(),
		currency = ".$currency."
	WHERE
		id = #id#
		";
    $o = $this->m->query($q,  __FILE__, __LINE__, Array(
		'id'=>$id,
		'currency_cbrf'=>$currency_cbrf
		));
    if ($this->m->error ) {
//        $this->m->rollback(__FILE__, __LINE__);
        return Array('status'=>false);
        };
}


	}
?>