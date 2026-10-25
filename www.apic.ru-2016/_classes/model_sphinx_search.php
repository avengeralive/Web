<?
require_once(CLASSES_BASE.'sphinx/sphinxapi.php');

class model_sphinx_search{

function __construct($SPHINX_INDEXES, $SPHINX_GROUPS){
	$this->SPHINX_INDEXES = $SPHINX_INDEXES;
	$this->SPHINX_GROUPS = $SPHINX_GROUPS;
	}

function search_multiple($query, $page, $showall){
	$cl = new SphinxClient();
	$cl->SetServer( SPHINX_HOST, SPHINX_PORT  );
	$cl->SetLimits ( 0, SPHINX_RESULTS_MAX_PAGES*SPHINX_RESULTS_PER_PAGE );
	reset($this->SPHINX_INDEXES);
	while(list($k,$v)=each($this->SPHINX_INDEXES)){
		$cl->SetMatchMode( constant($v['mode']) );
		$cl->AddQuery (  $query,  $v['name']);
		};
	$results = $cl->RunQueries ();

	$result_final = array();
	reset($this->SPHINX_INDEXES);
	while(list($k,$v)=each($this->SPHINX_INDEXES)){
		$result_final = $this->_add_some_ratings($results[$k], $result_final, $v['weight'], $v['debugname']);
		};
//	$total_results = sizeof($result_final);

//  echo @iconv('UTF-8', 'ISO-8859-1//TRANSLIT//IGNORE' , $query); 
//	echo $this->rus2lat($query, true);

	usort($result_final, '_cmp'	);
	$my_attrs_distribution = $this->get_attrs_distribution_from_result_array($result_final, $this->SPHINX_GROUPS );
	$my_result_page_matches = ($showall)
		?
		array_slice($result_final, 0, SPHINX_RESULTS_MAX_PAGES*SPHINX_RESULTS_PER_PAGE, TRUE )
		:
		array_slice($result_final, ($page-1)*SPHINX_RESULTS_PER_PAGE, SPHINX_RESULTS_PER_PAGE, TRUE );
	$my_result= array(
		'total_results'=>min(sizeof($result_final), SPHINX_RESULTS_MAX_PAGES*SPHINX_RESULTS_PER_PAGE),
		'matches'=>array(),
		'words'=>array()
		);
	$cc = ($page-1)*SPHINX_RESULTS_PER_PAGE;
	while(list($kk,$vv)=each($my_result_page_matches)  ){
		$cc++;
		$rat = '';
		while(list($kkk,$vvv)=each($vv['weight'])){
			$rat .= " $kkk:$vvv ";
			};
		$my_result['matches'][	$vv['doc']	]=array('sid'=>$cc, 'weight'=>$vv['rating'], 'weights_debug'=>$rat,'attrs'=>$vv['attrs']  );
		};
//	alid($my_result);
	return array('result'=>$my_result, 'groups'=>$my_attrs_distribution);
	}


function _do_search($cl, $query, $match, $index){
//	ali_debug('','','',"$query, $match, $index");
	$cl->SetMatchMode( $match );
	$result = $cl->Query( $query, $index );
	return $result;
	}



function _add_some_ratings($result1, $result_final, $factor, $fname){
	$i=0;
	$s = (  isset($result1['matches']) &&  (count($result1['matches'])>0)    )?count($result1['matches']):1;
	if (isset($result1['matches'])) {
		while(list($k,$v)=each($result1['matches'])  ){
			$weight =  $factor*($s - $i)/$s;
			$result_final[$k]['rating'] =  isset($result_final[$k]['rating'])? ( $result_final[$k]['rating']+$weight) : $weight;
			$result_final[$k]['doc']=$k;
			$result_final[$k]['weight'][$fname]= $weight;
			$result_final[$k]['attrs']= $v['attrs'];
			$i++;
			};
		};
	return $result_final;
	}


function get_attrs_distribution_from_result_array($result_final, $a_names){
	$distr = array();
		while(list($k,$v)=each($result_final)  ){
				while(list($kk,$vv)=each($v['attrs'])  ){
						if (in_array($kk, $a_names)){				
							$distr[$kk][$vv] = isset($distr[$kk][$vv])?$distr[$kk][$vv]+1:1;
							};
					};
			};
	while(list($k,$v)=each($distr)  ){
		arsort($distr[$k]);
		};
	return ($distr);
	}

}


// global space ... kluge!!! 
function _cmp($a, $b){
	$index='rating';
	return ($a[$index] > $b[$index]) ? -1 : 1;
	}

?>
