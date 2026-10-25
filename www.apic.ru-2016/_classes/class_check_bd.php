<?
/**
* ѕроверить что в Ѕƒ все сходитс€.
update tree set parent_id=33436543 where id=33436874;
update tree set parent_id=33471306 where id=33437047;
update tree set parent_id=33436543 where id=33471416;
*/
class check_bd {
private $m=NULL;
private $DB=NULL;
private $adm=NULL;
public  $ROOT_ID=1;
//запecкать лечение URL или нет
public $repair_url = TRUE;

// считаем что ошибок нет
private $errors = FALSE;

function __construct($m, $DB){
	$this->m = $m;
	$this->DB = $DB;
	$this->adm = new admin_icms(&$this->m);
	}


/**
* все обьекты из tree.
*/
public function main(){
	$t = $this->get_tree_list();
	$this->_log('Found ojects count='.count($t));
	while(list(,$o)=each($t)){
//		$this->_log('Found id='.$o['id']);
		$this->check_object($o['id']);
	//	echo $o['id']." ";
		};
	$this->_log('Finish');
	return $this->errors;
	}

/**
* перестроить заново URL обьекта исход€ из всех родительких URLPART   
*/
private function fix_object_url($id){
	$q = "select id, url, parent_id from ".$this->DB.".tree where id='#id#'";
	
	// запомним наш parent_id
	$o = $this->m->selectOneRow($q, NULL, NULL, Array('id'=>$id));
	$parent_id = $o['parent_id'];
	

	// соберем id парентов 
	$iid = $id;
	$u = array();
	$u[]=$iid;
	while (  ($iid != $this->ROOT_ID) && ($iid > 0 )	){
		// получить родительcкий id
		$o = $this->m->selectOneRow($q, NULL, NULL, Array('id'=>$iid));
	//	alid($o);
		$iid = $o['parent_id'];
		$u[]=$iid;
		};
//	var_dump($u);
	$u = array_reverse($u);
//	var_dump($u);

	// соберем urlpart парентов 
	$uu=array();
	$q1 = "select id, url, parent_id from ".$this->DB.".tree where id='#id#'";
	while ( list(,$v)=each($u)	){
		$o = $this->m->selectOneRow($q, NULL, NULL, Array('id'=>$v));
		$url=$this->get_url_part($o['url']);
		$uu[]=$url;
		};

	// из urlpart создадим 
	$new_url = implode('/', $uu).'/';
	$this->_l("$id=\t$ud  proposed_url=\t$new_url\r\n\r\n");
	$this->adm->change_url_and_parent_id ($id, NULL, $new_url, $parent_id);
	//exit();
	}	
	

	
	
private function get_tree_list(){
	$q = "select id from ".$this->DB.".tree order by id";
    $o = $this->m->selectManyRows($q, NULL, NULL, Array());
	return $o;
	}

/**
* дл€ каждого обьекта = проверка парента, проверка url, проверка включенности дерева ,проверка параметров 
*/
private function check_object($id){
//	$s1 = $this->check_object_parent($id);
	$s2 = $this->check_object_url($id);
//	$s3 = $this->check_object_params($id);
	$this->_log_object($id,$s1,$s2,$s3);
	
	if ($this->repair_url && ($s2==false) ){
		$this->fix_object_url($id);
		};
	}

/**
* ѕровер€ем что у каждого обьекта спрописанный parent  существует
*/ 
private function check_object_parent($id){
	if ($id == $this>ROOT_ID){
		return true;
		};
	$q = "select id from ".$this->DB.".tree where id in (select parent_id from ".$this->DB.".tree where id='#id#')";
    $o = $this->m->selectOneRow($q, NULL, NULL, Array('id'=>$id));
//	alid($o);
	return  ( isset($o['id']) && ($o['id']>0) );
	}



	
/**
*   ѕровер€ем что вычисленный URL родител€ по обрезанию строки €вл€етс€ действительно тем URL что прописан у парента 
*/ 
private function check_object_url($id){
	$q = "select url,parent_id from ".$this->DB.".tree where id='#id#'";
    $o = $this->m->selectOneRow($q, NULL, NULL, Array('id'=>$id));
    $o1 = $this->m->selectOneRow($q, NULL, NULL, Array('id'=>$o['parent_id']));
	$guess_parent_url = preg_replace('|([^/]*/)$|','',$o['url']);
	if ($guess_parent_url != $o1['url']){
		$this->_log("ID\t".$id." url=\t".$o['url']."\tguesst_parent_url=\t".$guess_parent_url ."\treal_parent_url=\t".$o1['url']);
		};
	return ($guess_parent_url == $o1['url']);
//	return true;
	}


/**
*    „то у каждого обьекта есть документ = запись в таблице docs
*/
private function check_object_params($id){
	$q = "select id from ".$this->DB.".docs where id='#id#' LIMIT 1";
    $o = $this->m->selectOneRow($q, NULL, NULL, Array('id'=>$id));
//	alid($o);
	return  ( isset($o['id']) && ($o['id']>0) );
	}

private function _set_errors(){
	$this->errors=TRUE;
	}

private function _l($message){
	echo $message." ";
	}

private function _log($message){
	echo $message."\r\n";
	}

private function _log_object($id,$s1,$s2,$s3){
	if ($s1!=TRUE || $s2!=TRUE || $s3!=TRUE){
		//$this->_log('Found error: id='.$id.' parent='.$s1.' url='.$s2.' docs='.$s3);
		};
	}

static function get_url_part($url){
	if ($url=='/') {
		return '';
		};
	$e = explode('/', $url);
	//ali_debug('','','',$e);
	// костыль дл€ битых url
	if ($e[sizeof($e)-1]=='') {
		unset(	$e[sizeof($e)-1]	);
		};
	return $e[sizeof($e)-1];
	}


}
?>
