<?
require_once(CLASSES_BASE.'model_icms_folder.php');
class model_icms_folder_catalog extends model_icms_folder{

function get_object_by_id($id) {


	$o_base =  $this->get_object_base($id); 
	$o_param = $this->get_document_params($id);
	$o_nav =   $this->get_document_navigation($o_base['object']['parent_id'],$o_base['object']['name']);
	$o_menu = $this->down_level_menu(	$this->_get_menu_tree($o_base['object']) );
	
	$this->_get_object_seo(&$o_base);
	
	$o_b1 =    $this->get_object_base(ID_BANNERS_ALL_LEFT); 
	$o_b2 =    $this->get_object_base(ID_BANNERS_ALL_TOP); 
	$o_b3 =    $this->get_object_base(ID_BANNERS_ALL_BOTTOM); 
	$o_b4 =    $this->get_object_base(ID_BANNERS_INDEX_MIDDLE); 
	$o_b5 =    $this->get_object_base(ID_BANNERS_NAV_LEFT); 
	$o_b6 =    $this->get_object_base(ID_BANNERS_CNT_BOTTOM); 

//	$o_anons =  $this->get_object_anons(	$id	,100,0,'ASC','"folder_catalog"');
	$o_anons =  $this->get_object_anons(	$id	,100,0,'ASC',false);



	$o_firms=array();


						reset($o_param['params']);
						while (list($k, $v)=each($o_param['params'])) {
							if (preg_match('/^c_c_a_(.*)$/',$k, $m) && ($v['pvalue']!='')){
								$o_b =  $this->get_object_base($m[1]); 
								if (isset($o_b['status']) && ($o_b['status']=='active')){
									$o_b['visdate'] =  '';
									$o_p = $this->get_document_params($m[1]);

									$o_f = $o_b['object'];
									$o_f['params'] = $o_p['params'];
									//$o_brands[$m[1]] = $o_f;
									$o_firms[	$o_f['name']	] = $o_f;
								};
								};
							};
					//	alid($o_firms);
						ksort($o_firms);
						
						/// дополним компании прив€занные к этому уровню компани€ми которые прив€заны к следующему уровню. нужно это сделать так как часто на 1 уровне нет прив€зок...
						reset($o_anons);
						while (list($k, $v)=each($o_anons['childs'])) {
							//echo "*";
							while (list($kk, $vv)=each($v['params'])) {
								//echo "!";
								if (preg_match('/^c_c_a_(.*)$/',$kk, $m) && ($vv['pvalue']!='')){
									//echo "+";
									$o_b =  $this->get_object_base($m[1]); 
									if (isset($o_b['status']) && ($o_b['status']=='active')){
										$o_b['visdate'] =  '';
										$o_p = $this->get_document_params($m[1]);
							
										$o_f = $o_b['object'];
										$o_f['params'] = $o_p['params'];
										//$o_brands[$m[1]] = $o_f;
										$o_firms[	$o_f['name']	] = $o_f;
									};
									};
								};
							};
						ksort($o_firms);


					//	alid( $_GET['action']);
					//	alid( $_GET['subID']);

					// если у нас есть фильтр  по бренду то сейчас самое врем€ их применить.
					if (isset($_GET['action'])){
						$my_brand_id = $_GET['action'];
						$o_my_brand =    $this->get_object_base($my_brand_id);
						//alid($o_my_brand['object']);
						if (!(preg_match('|^/brand/.*/|', $o_my_brand['object']['url']))){
							unset($my_brand_id);
							} else {
							$o_base['object']['fullname'] = $o_base['object']['fullname'].' '.$o_my_brand['object']['name'];
							}
						};
						

					// если у нас есть фильтр  по городу -  то сейчас самое врем€ его применить также. 
					if (isset($_GET['subID'])){
						$my_city_id = $_GET['subID'];
						$o_my_city =    $this->get_object_base($my_city_id);
						//alid($o_my_city['object']);
						if (!(preg_match('|^/members/geograph/.*/|', $o_my_city['object']['url']))){
							unset($my_city_id);
							} else {
							$o_base['object']['fullname'] = $o_base['object']['fullname'].' в городе '.$o_my_city['object']['name'];
							}
						};

					//	alid( $my_brand_id );
					//	alid(  $my_city_id );
					
				//	alid($o_firms);
				//	reset($o_firms);
				$o_firms_all = $o_firms;
				if ($my_brand_id > 0) {
					$found_filter_brand = 0;
					while (list($k, $v)=each($o_firms)) {
						if (
							isset($v['params']['brand_assoc_'.$my_brand_id]['pvalue']) && 
							($v['params']['brand_assoc_'.$my_brand_id]['pvalue']==1)
							)
								{
								$found_filter_brand++;
								}
							else {
							unset($o_firms[$k]);
							}
						};
					};
			//		alid($o_my_city);
						
				$o_firms_brand = $o_firms;
				
				if ($my_city_id > 0) {						
					reset($o_firms);
					$found_filter_city = 0;
					while (list($k, $v)=each($o_firms)) {
						if (
							isset($v['params']['mm_c_a_'.$my_city_id]['pvalue']) && 
							($v['params']['mm_c_a_'.$my_city_id]['pvalue']==1)
							)
								{
								$found_filter_city++;
								}
							else {
							unset($o_firms[$k]);
							}
						};
				};
				
				
		//		alid(  sizeof($o_firms_all));
		//		alid(  sizeof($o_firms_brand));
		//		alid(  sizeof($o_firms));
		//	alid($o_firms);
			
			
			if  ( (sizeof($o_firms)==0)  && sizeof($o_firms_brand)>0 ){
				$o_firms = $o_firms_brand;
				$o_base['object']['document'] = '<p>Ќе найдено в городе '.$o_my_city['object']['name'].'. ѕоказаны фирмы занимающиес€ брендом '.$o_my_brand['object']['name'].'</p>';				
				}
			elseif((  sizeof($o_firms)==0)  && sizeof($o_firms_brand)==0){
				$o_firms = $o_firms_all;
				$o_base['object']['document'] = '<p>Ќе найдено в городе '.$o_my_city['object']['name'].'. ѕоказаны фирмы занимающиес€ категорией оборудовани€ &laquo;'.$o_base['object']['name'].'&raquo;</p>';				
				};
			//	alid($found_filter_brand);
			//	alid($found_filter_city);
					
//	};
	
	

//alid(		$o_brands	);

	$o_membernews =  $this->get_object_anons_for_raw_like_by_vidate(	'/members/news/%/' ,4,0,'DESC',false);
	$o_news =  $this->get_object_anons_for_raw_like_by_vidate(	'/about/apic-news/%/' ,4,0,'DESC',false);


    $return = Array(
        'status'=>true,
		
		'header'=> 
			(isset($_POST["section_id"])?true:false),

        'b1'=>$o_b1['object'],
        'b2'=>$o_b2['object'],
        'b3'=>$o_b3['object'],
        'b4'=>$o_b4['object'],
        'b5'=>$o_b5['object'],
        'b6'=>$o_b6['object'],

        'membernews'=>$o_membernews['childs'],
        'news'=>$o_news['childs'],
		
  //      'brands'=>$o_brands,
        'company'=>$o_firms,
        'anons'=>$o_anons['childs'],

        'object'=>$o_base['object'],
		'menu'=>$o_menu,
		'navigation'=>$o_nav['navigation'],
		'params'=>$o_param['params']
        );
	return $return;
	}


	
	


//   function get_post_firms(){
//   	//phpinfo();
//   	
//   	/*
//   	$_POST["section_id"]='aircon';
//   	$_POST["group_id"]='home';
//   	$_POST["brand_id"]='ballu';
//   //	$_POST["brand_id"]='';
//   	$_POST["city_id"]='ћосква';
//   	*/
//   	//alid($_POST);
//   
//   	
//   	$section_id=$_POST["section_id"];
//   //if(empty($section_id)) $section_id=$mode[0]; 
//   if(empty($section_id)) $section_id=0;
//   
//   $group_id=$_POST["group_id"];
//   //if(empty($group_id)) $group_id=$mode[1];
//   if(empty($group_id)) $group_id=0;
//   
//   $brand_id=$_POST["brand_id"];
//   //if(empty($brand_id)) $brand_id=$mode[2];
//   if(empty($brand_id)) $brand_id=0;
//   
//   $city_id=$_POST["city_id"];
//   if(empty($city_id)) $city_id="";
//   
//   
//   // apic.ru\www\output\buy_proc.php 
//   
//   if(!empty($section_id)) 
//    {
//      $sql="select id_s,name from apic_new.apic_section where sid='#section_id#' "; 
//   //   $sname=mysql_query($sql);
//    //  $sid=mysql_result($sname,0,0);
//     // $navref=$navref.' &raquo; '.mysql_result($sname,0,1);
//    //  $sname=mysql_result($sname,0,1);
//      
//      $res = $this->m->selectOneRow($sql,NULL,NULL,array('section_id'=>$_POST["section_id"]));
//    //  echo "===";
//    //  alid($res);
//    //  echo "===";
//      $sid = $res['id_s'];
//    };
//    
//    if(!empty($group_id)) 
//    {
//      $sql="select id_s,name from apic_new.apic_section where sid='#group_id#'"; 
//      //$gname=mysql_query($sql); 
//      //$gid=mysql_result($gname,0,0);
//      //$navref=$navref.' &raquo; '.mysql_result($gname,0,1);
//      //$gname=mysql_result($gname,0,1);
//      $res = $this->m->selectOneRow($sql,NULL,NULL,array('group_id'=>$_POST["group_id"]));
//    //  echo "------";
//    //  alid($res);
//    //  echo "------";
//      $gid = $res['id_s'];
//      };
//   
//    if(!empty($brand_id)) 
//    {
//      $sql='select id_b,name from apic_new.apic_brand where sid="#brand_id#"'; 
//    //  $bname=mysql_query($sql);
//    //  $bid=mysql_result($bname,0,0);
//    //  $bname=mysql_result($bname,0,1);
//      $res = $this->m->selectOneRow($sql,NULL,NULL,array('brand_id'=>$_POST["brand_id"]));
//    //  alid($res);
//      $bid = $res['id_b'];
//    };
//   
//   	
//   /*
//           $sql='select distinct `firms`.* from apic_new.firms, apic_new.apic_sbf ';
//           $sql=$sql.' where `firms`.`id`=`apic_sbf`.`id_f` and `firms`.`cexp_only` = 0'; 
//           if(!empty($gid)) $sql=$sql.' and `apic_sbf`.`id_s`='.addslashes($gid);
//           elseif(!empty($sid)) $sql=$sql.' and `apic_sbf`.`id_s`='.addslashes($sid);
//           if(!empty($bid)) $sql=$sql.' and `apic_sbf`.`id_b`='.addslashes($bid);
//           if(!empty($city_id)) $sql=$sql.' and (`firms`.`city`="'.addslashes($city_id).'" or `firms`.`id` in (select id_firm from apic_new.firms_city_id where id_city in (select id from apic_new.firms_city where city="'.addslashes($city_id).'")))';
//           $sql=$sql.' order by `firms`.`name`;';
//           
//           echo $sql;
//   		$res = $this->m->selectManyRows($sql,NULL,NULL,array());
//   		alid($res);
//   */
//   
//   /*
//   	// работает но не учитывает что когда group_id == пустой то нужно тащить всех 
//           $sql='select distinct firms.id from apic_new.firms, apic_new.apic_sbf ';
//           $sql=$sql.' where `firms`.`id`=`apic_sbf`.`id_f` and `firms`.`cexp_only` = 0'; 
//           if(!empty($gid)) $sql=$sql.' and `apic_sbf`.`id_s`='.addslashes($gid);
//           elseif(!empty($sid)) $sql=$sql.' and `apic_sbf`.`id_s`='.addslashes($sid);
//           if(!empty($bid)) $sql=$sql.' and `apic_sbf`.`id_b`='.addslashes($bid);
//           if(!empty($city_id)) $sql=$sql.' and (`firms`.`city`="'.addslashes($city_id).'" or `firms`.`id` in (select id_firm from apic_new.firms_city_id where id_city in (select id from apic_new.firms_city where city="'.addslashes($city_id).'")))';
//           $sql=$sql.' order by `firms`.`name`;';
//   */	
//   
//           $sql='select distinct firms.id from apic_new.firms, apic_new.apic_sbf ';
//           $sql=$sql.' where `firms`.`id`=`apic_sbf`.`id_f` and `firms`.`cexp_only` = 0'; 
//           
//   		if(!empty($gid)) $sql=$sql.' and `apic_sbf`.`id_s`='.addslashes($gid);
//       //    elseif(!empty($sid)) $sql=$sql.' and `apic_sbf`.`id_s`='.addslashes($sid);
//   		
//   		if(empty($gid)) {
//   				$sql=$sql.' and `apic_sbf`.`id_s` in (select id_s from apic_new.apic_section where parent='.$sid.' or id_s = '.$sid.' ) ';
//   				};
//   
//           if(!empty($bid)) $sql=$sql.' and `apic_sbf`.`id_b`='.addslashes($bid);
//           if(!empty($city_id)) $sql=$sql.' and (`firms`.`city`="'.addslashes($city_id).'" or `firms`.`id` in (select id_firm from apic_new.firms_city_id where id_city in (select id from apic_new.firms_city where city="'.addslashes($city_id).'")))';
//           $sql=$sql.' order by `firms`.`name`;';		
//           
//       //    echo $sql;
//   		$res = $this->m->selectManyRowsByID($sql,'id',NULL,NULL,array());
//   	//	alid($res);
//   		$firm_ids = implode( "," , array_keys($res) );	
//   	//	alid($firm_ids);
//   		$res_firms = $this->get_object_anons_for_firms(	$firm_ids	);
//   	//	alid(	$res_firms	);
//   		
//   		
//   		return $res_firms['childs'];
//   		}

	
	
	
	
	
	
function get_object_anons_for_firms($firms, $limit = 1024, $offset = '0', $sort = 'ASC',$only_type='', $only_active=true) {
//	$tt = ((strlen($only_type)>0)?' AND tree.type in ('.$only_type.')':'');

	$ta = ($only_active==true)? " AND tree.status ='active' ":'';
//	echo $tt."<br>";
	$q1 = "
	SELECT
		tree.type,
		tree.visdate,
		tree.id,
		tree.parent_id,
		tree.created,
		tree.name,
		tree.url,
		tree.status,
		tree.statushidden,
		p1.pvalue as firm_id,
		doc.anons,
		doc.updated,
		doc.fullname
	FROM 
		".$this->TABLE_TREE." as tree
	LEFT JOIN
		".$this->TABLE_DOC." as doc
	ON 
		doc.id = tree.id
		
	LEFT JOIN
		params as p1
	ON 
		p1.doc_id = tree.id
	AND
		p1.pname = 'firm_id'

	WHERE 
		tree.type = 'folder_company' 
	AND
		p1.pvalue IN (#firms#) 
	"
	.$ta."
	ORDER BY 
#		tree.visdate #sort#
#		tree.ordering #sort#,
		 concat( substring(tree.visdate,7,4), substring(tree.visdate,4,2), substring(tree.visdate,1,2)  ) DESC
	LIMIT 
		#offset#, #limit#
	";
	$o1 = $this->m->selectManyRows($q1, __FILE__, __LINE__, 
		Array(
			'firms' => $firms,
			'limit' => $limit,
			'offset' => $offset,
			'sort' => $sort
		)
	);
	while (list($k, $v) = each($o1)) {
		$params = $this->get_document_params($v['id']);
		$o1[$k]['params'] = $params['params'];
	};
	reset($o1);
	return Array(
		'status'=>true,
		'childs'=>$o1
	);
}
	
	
	
	
	
	
	
	
	
	
	
	
}
?>