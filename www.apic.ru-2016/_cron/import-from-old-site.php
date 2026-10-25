<?
require_once('../_settings/settings.php');
require_once(CLASSES_BASE.'class_ice_error_handler.php');
require_once(CLASSES_BASE.'class_ice_mysql.php');
require_once(CLASSES_BASE.'admin_icms.php');
require_once(CLASSES_BASE.'class_ice_excel.php');
require_once(CLASSES_BASE.'textile.php');
$textile = new Textile;

define('TEXTILE', true);
//define('TEXTILE', false);
 
 
$m = new ice_mysql();
$imp = new imp();


// TODO!!!!!!
// вставить баннеры
// Подбор оборудования 
/// Подбор подрядчика
// прогнать текста через исправлятор разметки антона в html 



//-----------------------------------------------------------------------------------
// RUSSIAN MAIN PART 
//for($id_sect=1;$id_sect<=31;$id_sect++){
//$o1 = $m->gets('apic_new.a_object', array('active'=>1,'id_part'=>1, 'id_lvl'=>1, 'pid'=>0), 'id_sect', 'idx asc');
$o1 = $m->gets('apic_new.a_object', array('id_part'=>1, 'pid'=>'0'));
	while (list($k, $v)=each($o1)){
		$u1 =  '/'.$v['sid'].'/';
		myimport($u1,$v['sid'], '/', 1, $v,'folder');
		$o2 = $m->gets('apic_new.a_object', array('id_part'=>1, 'pid'=>$v['id']));
		while (list($kk, $vv)=each($o2)){
			$u2= '/'.$v['sid'].'/'.$vv['sid'].'/';
			myimport($u2,$vv['sid'],$u1,2,  $vv,'folder');
			$o3 = $m->gets('apic_new.a_object', array('id_part'=>1, 'pid'=>$vv['id']));
			while (list($kkk, $vvv)=each($o3)){
				$u3= '/'.$v['sid'].'/'.$vv['sid'].'/'.$vvv['sid'].'/';
				myimport($u3, $vvv['sid'],$u2,3, $vvv,'folder');
				$o4 = $m->gets('apic_new.a_object', array('id_part'=>1, 'pid'=>$vvv['id']));
				while (list($k4, $v4)=each($o4)){
						$u4= '/'.$v['sid'].'/'.$vv['sid'].'/'.$vvv['sid'].'/'.$v4['sid'].'/';
						myimport($u4,$v4['sid'],$u3, 4, $v4,'folder');
						$o5 = $m->gets('apic_new.a_object', array('id_part'=>1, 'pid'=>$v4['id']));
						while (list($k5, $v5)=each($o5)){
							$u5= '/'.$v['sid'].'/'.$vv['sid'].'/'.$vvv['sid'].'/'.$v4['sid'].'/'.$v5['sid'].'/';
							myimport($u5,$v5['sid'],$u4, 5,  $v5,'folder');
							};
					};
				};
			};
	};
//};




// ENGLISH MAIN PART 
//for($id_sect=1;$id_sect<=31;$id_sect++){
//$o1 = $m->gets('apic_new.a_object', array('active'=>1,'id_part'=>1, 'id_lvl'=>1, 'pid'=>0), 'id_sect', 'idx asc');
$o1 = $m->gets('apic_new.a_object', array('id_part'=>2, 'pid'=>'0'));
	while (list($k, $v)=each($o1)){
		$u1 =  '/en/'.$v['sid'].'/';
		myimport($u1,$v['sid'], '/en/', 1, $v,'folder_eng');
		$o2 = $m->gets('apic_new.a_object', array('id_part'=>2, 'pid'=>$v['id']));
		while (list($kk, $vv)=each($o2)){
			$u2= '/en/'.$v['sid'].'/'.$vv['sid'].'/';
			myimport($u2,$vv['sid'],$u1,2,  $vv,'folder_eng');
			$o3 = $m->gets('apic_new.a_object', array('id_part'=>2, 'pid'=>$vv['id']));
			while (list($kkk, $vvv)=each($o3)){
				$u3= '/en/'.$v['sid'].'/'.$vv['sid'].'/'.$vvv['sid'].'/';
				myimport($u3, $vvv['sid'],$u2,3, $vvv,'folder_eng');
				$o4 = $m->gets('apic_new.a_object', array('id_part'=>2, 'pid'=>$vvv['id']));
				while (list($k4, $v4)=each($o4)){
						$u4= '/en/'.$v['sid'].'/'.$vv['sid'].'/'.$vvv['sid'].'/'.$v4['sid'].'/';
						myimport($u4,$v4['sid'],$u3, 4, $v4,'folder_eng');
						$o5 = $m->gets('apic_new.a_object', array('id_part'=>2, 'pid'=>$v4['id']));
						while (list($k5, $v5)=each($o5)){
							$u5= '/en/'.$v['sid'].'/'.$vv['sid'].'/'.$vvv['sid'].'/'.$v4['sid'].'/'.$v5['sid'].'/';
							myimport($u5,$v5['sid'],$u4, 5,  $v5,'folder_eng');
							};
					};
				};
			};
	};
//};


//
////-----------------------------------------------------------------------------------
//// RUSSIAN MAIN PART 
////for($id_sect=1;$id_sect<=31;$id_sect++){
////$o1 = $m->gets('apic_new.a_object', array('active'=>1,'id_part'=>1, 'id_lvl'=>1, 'pid'=>0), 'id_sect', 'idx asc');
//$o1 = $m->gets('apic_new.a_object', array('active'=>1,'id_part'=>1, 'pid'=>'0'));
//	while (list($k, $v)=each($o1)){
//		$u1 =  '/'.$v['sid'].'/';
//		myimport($u1,$v['sid'], '/', 1, $v,'folder');
//		$o2 = $m->gets('apic_new.a_object', array('active'=>1,'id_part'=>1, 'pid'=>$v['id']));
//		while (list($kk, $vv)=each($o2)){
//			$u2= '/'.$v['sid'].'/'.$vv['sid'].'/';
//			myimport($u2,$vv['sid'],$u1,2,  $vv,'folder');
//			$o3 = $m->gets('apic_new.a_object', array('active'=>1,'id_part'=>1, 'pid'=>$vv['id']));
//			while (list($kkk, $vvv)=each($o3)){
//				$u3= '/'.$v['sid'].'/'.$vv['sid'].'/'.$vvv['sid'].'/';
//				myimport($u3, $vvv['sid'],$u2,3, $vvv,'folder');
//				$o4 = $m->gets('apic_new.a_object', array('active'=>1,'id_part'=>1, 'pid'=>$vvv['id']));
//				while (list($k4, $v4)=each($o4)){
//						$u4= '/'.$v['sid'].'/'.$vv['sid'].'/'.$vvv['sid'].'/'.$v4['sid'].'/';
//						myimport($u4,$v4['sid'],$u3, 4, $v4,'folder');
//						$o5 = $m->gets('apic_new.a_object', array('active'=>1,'id_part'=>1, 'pid'=>$v4['id']));
//						while (list($k5, $v5)=each($o5)){
//							$u5= '/'.$v['sid'].'/'.$vv['sid'].'/'.$vvv['sid'].'/'.$v4['sid'].'/'.$v5['sid'].'/';
//							myimport($u5,$v5['sid'],$u4, 5,  $v5,'folder');
//							};
//					};
//				};
//			};
//	};
////};
//// ГДЕ КУПИТЬ--текстовые страницы
//$o1 = $m->gets('apic_new.a_object', array('active'=>2,'id_part'=>1, 'pid'=>'0'));
//	while (list($k, $v)=each($o1)){
//		$u1 =  '/'.$v['sid'].'/';
//		myimport($u1,$v['sid'], '/', 1, $v,'folder');
//		$o2 = $m->gets('apic_new.a_object', array('active'=>2,'id_part'=>1, 'pid'=>$v['id']));
//		while (list($kk, $vv)=each($o2)){
//			$u2= '/'.$v['sid'].'/'.$vv['sid'].'/';
//			myimport($u2,$vv['sid'],$u1,2,  $vv,'folder');
//			$o3 = $m->gets('apic_new.a_object', array('active'=>2,'id_part'=>1, 'pid'=>$vv['id']));
//			while (list($kkk, $vvv)=each($o3)){
//				$u3= '/'.$v['sid'].'/'.$vv['sid'].'/'.$vvv['sid'].'/';
//				myimport($u3, $vvv['sid'],$u2,3, $vvv,'folder');
//				$o4 = $m->gets('apic_new.a_object', array('active'=>2,'id_part'=>1, 'pid'=>$vvv['id']));
//				while (list($k4, $v4)=each($o4)){
//						$u4= '/'.$v['sid'].'/'.$vv['sid'].'/'.$vvv['sid'].'/'.$v4['sid'].'/';
//						myimport($u4,$v4['sid'],$u3, 4, $v4,'folder');
//						$o5 = $m->gets('apic_new.a_object', array('active'=>2,'id_part'=>1, 'pid'=>$v4['id']));
//						while (list($k5, $v5)=each($o5)){
//							$u5= '/'.$v['sid'].'/'.$vv['sid'].'/'.$vvv['sid'].'/'.$v4['sid'].'/'.$v5['sid'].'/';
//							myimport($u5,$v5['sid'],$u4, 5,  $v5,'folder');
//							};
//					};
//				};
//			};
//	};


	
// ГДЕ КУПИТЬ--листинги предложений фирм участников 
$o1 = $m->gets('apic_new.apic_section', array('parent'=>'0'));
	while (list($k, $v)=each($o1)){
		$u1 =  '/buy/'.$v['sid'].'/';
		myimport_buy($u1,$v['sid'], '/buy/', 1, $v,'folder_catalog');
		$o2 = $m->gets('apic_new.apic_section', array('parent'=>$v['id_s']));
		while (list($kk, $vv)=each($o2)){
			$u2= '/buy/'.$v['sid'].'/'.$vv['sid'].'/';
			myimport_buy($u2,$vv['sid'],$u1,2,  $vv,'folder_catalog');
			$o3 = $m->gets('apic_new.apic_section', array('parent'=>$vv['id_s']));
			while (list($kkk, $vvv)=each($o3)){
				$u3= '/buy/'.$v['sid'].'/'.$vv['sid'].'/'.$vvv['sid'].'/';
				myimport_buy($u3, $vvv['sid'],$u2,3, $vvv,'folder_catalog');
				$o4 = $m->gets('apic_new.apic_section', array('parent'=>$vvv['id_s']));
				while (list($k4, $v4)=each($o4)){
						$u4= '/buy/'.$v['sid'].'/'.$vv['sid'].'/'.$vvv['sid'].'/'.$v4['sid'].'/';
						myimport_buy($u4,$v4['sid'],$u3, 4, $v4,'folder_catalog');
						$o5 = $m->gets('apic_new.apic_section', array('parent'=>$v4['id_s']));
						while (list($k5, $v5)=each($o5)){
							$u5= '/buy/'.$v['sid'].'/'.$vv['sid'].'/'.$vvv['sid'].'/'.$v4['sid'].'/'.$v5['sid'].'/';
							myimport_buy($u5,$v5['sid'],$u4, 5,  $v5,'folder_catalog');
							};
					};
				};
			};
	};



	
// карточки компаний 
$params_for_companys=array(
'logo',
'equipment',
'services',
'additional_info',
'dilers',
'postal_address',
'phone1',
'pcode1',
'phone2',
'pcode2',
'fax',
'fcode',	
'email',
'web',	
'country',
'city'
);
$obrands = $m->gets('apic_new.firms', array('cexp_only'=>'0'), 'id');
while (list($k, $v)=each(	$obrands	)){
		//$urlname = $imp->guess_url_by_url_name($v['web'],$v['name']);
		$urlname = 'action-'.$v['id'];
		$pp = array();
		reset($params_for_companys);
		while (list($kk, $vv)=each(	$params_for_companys	)){
			$pp[	$vv	] = $v[	$vv	];
			};
		$pp[	'firm_id'	] = $v['id'];
		unset($pp['id']);
		echo $v['id']." ".$v['name']."\r\n";
		// карточка компании
		$imp->guess_insert_id($urlname, '/members/', $v['name'], 'folder_company', '', '', $pp);
		};


// список всех брендов и "фейковые" карточки для них
//-------------------------------------------------------------------------------
// все бренды 
$obrands = $m->gets('apic_new.apic_brand', array('1'=>1), 'id');
while (list($k, $v)=each(	$obrands	)){
		// узнаем активен ли. для этого получим привязку этого бренда к фирме.
		$brandactive = $m->gets('apic_new.apic_sbf', array('id_b'=>$v['id_b']));
		//if(sizeof($brandactive)>0){
			$urlname = $imp->guess_url_by_url_name($v['sid'],$v['name']);
			$pp = array();
			$pp['brand_id'] = $v['id_b'];
			// карточка бренда
			$imp->guess_insert_id($urlname, '/brand/', $v['name'], 'folder_brand', '', '', $pp );
		//	};
		};










		
		

//--------------------------------------------------------------------------------
//  привязки брендов к компаниям 
$ee = array();
$obc = $m->gets('apic_new.apic_sbf', array('1'=>1));
while (list($k, $v)=each(	$obc	)){
	if ($v['id_b']>0){
//		$ofirm = $m->get('apic2016.params', array('pname'=>'firm_id', 'pvalue'=>$v['id_f']));
		$ofirm = $m->selectOneRow('select doc_id from apic2016.params where pname="firm_id" and pvalue="'.$v['id_f'].'" and doc_id in (select id from apic2016.tree where url like "/members/%/" and type="folder_company" ) ',NULL,NULL);
		
//		$obrand = $m->get('apic2016.params', array('pname'=>'brand_id', 'pvalue'=>$v['id_b']));
		$obrand = $m->selectOneRow('select doc_id from apic2016.params where pname="brand_id" and pvalue="'.$v['id_b'].'" and doc_id in (select id from apic2016.tree where url like "/brand/%/"  ) ',NULL,NULL);

		echo $v['id_b']." ".$v['id_f'];
		if (
			isset($ofirm['doc_id']) && 
			isset($obrand['doc_id'])
			){
			// это была привязка к ВКЛЮЧЕННЫМ данным.
			if (!isset($ee[	$v['id_b']	][	$v['id_f']	])){
				echo "found old frim=".$v['id_f']." new firm=".$ofirm['doc_id'].' for old brand='.$v['id_b'].' found new brand='.$obrand['doc_id']." \r\n";
				$imp->adm->add_document_param($ofirm['doc_id'], 'brand_assoc_'.$obrand['doc_id'], '1');
				$ee[	$v['id_b']	][	$v['id_f']	]=1;
				echo "NEW\r\n";
				}
			else {
				echo "============OLD=============\r\n";
				};
			};
		};
	};

	
	
//  а также привязки брендов к категориями
//  и также привязки компаний к категориями
$o600 = $m->selectManyRows('select * from apic_new.apic_sbf  ',NULL,NULL);
alid($o600);
//exit();
$is_brands=array();
$is_firms=array();
reset($o600);
while(list($k, $v)=each($o600)){
	//alid($v);
	$id=$v['id_s'];
	$brand=$v['id_b'];
	$firm=$v['id_f'];
	
	
	//=========================================
//	$ss = $m->gets('apic_db.clex_object', array('id_sect'=>'5', 'id'=>$id), 'id_sect');
//	$ss = $m->gets('apic_new.a_object', array('id'=>$id), 'id');
	$ss = $m->gets('apic_new.apic_section', array('id_s'=>$id), 'id_s');
	//alid($ss);
//	$brand_id = $m->get('apic2016.params', array('pname'=>'brand_id', 'pvalue'=>$brand));
	$brand_id = $m->selectOneRow('select doc_id from apic2016.params where pname="brand_id" and pvalue="'.$brand.'" and doc_id in (select id from apic2016.tree where url like "/brand/%/"  ) ',NULL,NULL);
	$bb = isset($brand_id['doc_id'])?$brand_id['doc_id']:'';
//	$firm_id = $m->get('apic2016.params', array('pname'=>'firm_id', 'pvalue'=>$firm));
	$firm_id = $m->selectOneRow('select doc_id from apic2016.params where pname="firm_id" and pvalue="'.$firm.'" and doc_id in (select id from apic2016.tree where url like "/members/%/" and type="folder_company" ) ',NULL,NULL);
	$ff = isset($firm_id['doc_id'])?$firm_id['doc_id']:'';
	while(list($kk, $vv)=each($ss)){
		$sid=$vv['sid'];
		$url = $m->selectOneRow('select * from apic2016.tree where url like "%'.$sid.'%" and url like "/buy/%" ',NULL,NULL);
		if (isset($url['url'])){
			echo "================id=$id brand=$brand firm=$firm sid=$sid brand_id=$bb firm_id=$ff url=".$url['url']."\r\n";
			
//			'brand_catalog_assoc'=>array(
//			'company_catalog_assoc'=>array(
			
		if  (
			($bb>0) &&
			(!isset($is_brands[ $url['id']	 ][$bb]))
			){
			$is_brands[ $url['id']	 ][$bb]=1;
			$imp->adm->add_document_param( $url['id'], 'b_c_a_'.$bb, '1');
			};
		if  (
			($ff>0) &&
			(!isset($is_firms[ $url['id']	 ][$ff]))
			){
			$is_firms[ $url['id']	 ][$ff]=1;
			$imp->adm->add_document_param( $url['id'], 'c_c_a_'.$ff, '1');
			};
			}
		else {
			echo "================id=$id brand=$brand firm=$firm sid=$sid brand_id=$bb firm_id=$ff NOT_FOUND_URL"."\r\n";
			};
		};
	};

		//=========================================






	
//exit();
	


		
	
//--------------------------------------------------------------

// импорт обычной страницы.
function myimport($url,$urlpart, $parent_url , $level, $v, $type='folder'){
		if ($url=='/members/') {
			return 1;
			};

		global $textile;
		global $m, $imp;
		
		echo "$url,$urlpart, $parent_url , $level\r\n";
		
		// возможно у нас есть номер фирмы которой принадлежит обьект. он лежит в apic_new.a_values_digit
		$j =  $m->get('apic_new.a_values_digit', array('id'=>$v['id']));
		$firm_id = isset($j['val'])?$j['val']:'';

		
		// название страницы
		$j =  $m->get('apic_new.a_values_str', array( 'id_fld'=>1, 'id'=>$v['id']));
		$name = isset($j['val'])?$j['val']:'';
	//	alid($j);
		

		// картинка страницы
		$j =  $m->get('apic_new.a_values_str', array( 'id_fld'=>5, 'id'=>$v['id']));
		$image = isset($j['val'])?$j['val']:'';
	//	alid($j);
		
		
		// анонс+основной контент страницы
		$jj =  $m->getss('apic_new.a_values_text', array(   'id'=>$v['id'], ), 'id_fld');
		$content =
				stripslashes(
					isset($jj[3]['val'])? $jj[3]['val'] : ''
				)
				;
		$anons =
				stripslashes(
					isset($jj[2]['val'])? $jj[2]['val'] : ''
				)
				;
			$content = TEXTILE?$textile->TextileThis(	$content	):$content;
			
			$anons =  TEXTILE?$textile->TextileThis(	$anons	):$anons;
			

//		echo "\r\n\r\n";
		//alid($jj);
		echo "url=$url\t\tname=$name \t\t content=content \r\n"; 
//		alid($v);
		$id = $imp->guess_insert_id($urlpart,$parent_url, $name, $type, $anons, $content, array('news_date'=>$v['tadd']));
		if($firm_id>0){
			$imp->adm->add_document_param($id, 'firm_id', $firm_id);
			};
		$imp->adm->add_document_param($id, 'image', $image);
		
		
//		$imp->adm->add_document_param($id, 'news_date', $v['tadd']);
		}	
	

	
	
// импорт обычной страницы.
function myimport_buy($url,$urlpart, $parent_url , $level, $v, $type='folder'){
		global $textile;

		echo "$url,$urlpart, $parent_url , $level\r\n";
		


		global $m, $imp;
		
		// название страницы
		$name  = $v['name'];

		
		// анонс+основной контент страницы
		$content = '';
		$anons = '';

//		echo "\r\n\r\n";
		//alid($jj);
		echo "url=$url\t\tname=$name \t\t content=content \r\n"; 
		$imp->guess_insert_id($urlpart,$parent_url, $name, $type, $anons, $content);
		/*
		
	//	if ($url=='/participants/help/specials/'){
		//	exit();
			//};
			
	*/
			
		}	
	
	

class imp{		
public $adm;		
public function __construct(){
	global $m;
	$this->m = $m;
	$this->adm = new admin_icms($this->m);
	$this->adm->DOCUMENT_TREE                  = MYSQL_DB.'.tree';                 // таблица
	$this->adm->DOCUMENT_DOCS                  = MYSQL_DB.'.docs';                 // таблица
	$this->adm->DOCUMENT_PARAMS                = MYSQL_DB.'.params';                 // таблица
	}

		
			
public function guess_insert_id($url, $parent_url, $name, $type, $anons, $description, $params=array()	, $visdate=''){
		global $textile;
	$parent_id = $this->guess_id($parent_url);
		$visdate = str_replace( '-', '.', $visdate );
		$visdate = str_replace( '_', '.', $visdate );
		$visdate = str_replace( '/', '.', $visdate );
	if (isset($params['news_date'])){
		$visdate = str_replace( '-', '.', $params['news_date'] );
		$visdate = str_replace( '-', '.', $visdate );
		$visdate = str_replace( '_', '.', $visdate );
		$visdate = str_replace( '/', '.', $visdate );
		$visdate = 
			substr($visdate,8,2).
			'.'.
			substr($visdate,5,2).
			'.'.
			substr($visdate,0,4);
		};
//	echo "\r\n\r\n".'==========news_date='.$params['news_date'].'=visdate='.$visdate."\r\n";
	
	echo "$url, $parent_url, $name, $type, description $parent_id";

        $description = TEXTILE?$textile->TextileThis(	$description	):$description;
		$anons =  TEXTILE?$textile->TextileThis(	$anons	):$anons;

	
	$obj = $this->adm->add_document     ($parent_id, $type, $name, $anons, $description, '','', 'active', 'active', $url, $visdate);
	$id = $obj['id'];
	
	while (list($k, $v)=each($params)){
		$this->adm->add_document_param($id, $k, $v);
		};
	
	echo '<!-- '.$id.' -->';
	return $id;
	}


public function guess_id($url){
	$q = 
	"
	select id from ".MYSQL_DB.".tree where url='#url#'
	";
	$o = $this->m->selectOneRow($q, __FILE__, __LINE__, 
        Array(
			'url'=>$url
            )
        );
	return isset($o['id'])?$o['id']:'NEW';
	}
		

public function guess_url_by_url_name($url, $name){
	$n = str_replace('http://','',$url);
	$n = str_replace('www.','',$n);
	$n = str_replace('/','',$n);
	$n = str_replace('.spb.ru','',$n);
	$n = str_replace('.com','',$n);
	$n = str_replace('.co','',$n);
	$n = str_replace('http:','',$n);
	$n = str_replace('.en.alibaba.com','',$n);
	$n = str_replace('.cn.alibaba.com','',$n);
	$n = str_replace(' ','',$n);
	$n = preg_replace('/(\.[a-z]{1,})$/','',$n);
	$n = strtolower($n);
	$n = $this->translit($n);
	if ($n==''){
		$n = $this->translit($name);
		};
//	echo "$url => $name => $n \r\n";
	return $n;
	}
		
		

		
		
		
		
		
		
 private function translit($string){
 		$string = trim(strip_tags($string));
        $rus = array(
			"/\,/", "/\./", "/а/", "/б/", "/в/",
			"/г/", "/_/", "/д/", "/е/", "/ё/", "/ж/", 
			"/з/", "/и/", "/й/", "/к/", "/л/", "/м/", 
			"/н/", "/о/", "/п/", "/р/", "/с/", "/т/", 
			"/у/", "/ф/", "/х/", "/ц/", "/ч/", "/ш/", 
			"/щ/", "/ы/", "/э/", "/ю/", "/я/", "/ь/", 
			"/ъ/", "/_/", "/ї/", "/є/", "/А/", "/Б/", 
			"/В/", "/Г/", "/_/", "/Д/", "/Е/", "/Ё/", 
			"/Ж/", "/З/", "/И/", "/Й/", "/К/", "/Л/", 
			"/М/", "/Н/", "/О/", "/П/", "/Р/", "/С/", 
			"/Т/", "/У/", "/Ф/", "/Х/", "/Ц/", "/Ч/", 
			"/Ш/", "/Щ/", "/Ы/", "/Э/", "/Ю/", "/Я/", 
			"/Ь/", "/Ъ/", "/_/", "/Ї/", "/Є/", "/[ #%<>\(\)\"\'\`\/]/");
        $lat = array(
			"", "", "a", "b", "v", 
			"g", "g", "d", "e", "e", "zh", "z", "i", 
			"j", "k", "l", "m", "n", "o", "p", "r", 
			"s", "t", "u", "f", "h", "c", "ch", "sh", 
			"sh", "y", "e", "yu", "ya", "", "", "i", 
			"i", "e",    "A", "B", "V", "G", "G", "D", 
			"E", "E", "ZH", "Z", "I", "J", "K", "L", 
			"M", "N", "O", "P", "R", "S", "T", "U", 
			"F", "H", "C", "CH", "SH", "SH", "Y", "E", 
			"YU", "YA", "", "", "I", "I", "E", '-');
        $e = trim(strtolower(preg_replace($rus, $lat, $string)));
		$pure_ascii = preg_replace( '/([\x00-\x2c]|[\x2e-\x2f]|[\x3a-\x40]|[\x5b-\x60]|[\x7b-\xff])/', '', $e );
		$pure_ascii3 = preg_replace( '/[\-]{2,}/', '-',$pure_ascii );
		return $pure_ascii3;
    }
		
		
		
		

		
public function translit_nolower($string){
 		$string = trim(strip_tags($string));
        $rus = array(
			"/\,/", "/\./", "/а/", "/б/", "/в/",
			"/г/", "/_/", "/д/", "/е/", "/ё/", "/ж/", 
			"/з/", "/и/", "/й/", "/к/", "/л/", "/м/", 
			"/н/", "/о/", "/п/", "/р/", "/с/", "/т/", 
			"/у/", "/ф/", "/х/", "/ц/", "/ч/", "/ш/", 
			"/щ/", "/ы/", "/э/", "/ю/", "/я/", "/ь/", 
			"/ъ/", "/_/", "/ї/", "/є/", "/А/", "/Б/", 
			"/В/", "/Г/", "/_/", "/Д/", "/Е/", "/Ё/", 
			"/Ж/", "/З/", "/И/", "/Й/", "/К/", "/Л/", 
			"/М/", "/Н/", "/О/", "/П/", "/Р/", "/С/", 
			"/Т/", "/У/", "/Ф/", "/Х/", "/Ц/", "/Ч/", 
			"/Ш/", "/Щ/", "/Ы/", "/Э/", "/Ю/", "/Я/", 
			"/Ь/", "/Ъ/", "/_/", "/Ї/", "/Є/", "/[ #%<>\(\)\"\'\`\/]/");
        $lat = array(
			"", "", "a", "b", "v", 
			"g", "g", "d", "e", "e", "zh", "z", "i", 
			"j", "k", "l", "m", "n", "o", "p", "r", 
			"s", "t", "u", "f", "h", "c", "ch", "sh", 
			"sh", "y", "e", "yu", "ya", "", "", "i", 
			"i", "e",    "A", "B", "V", "G", "G", "D", 
			"E", "E", "ZH", "Z", "I", "J", "K", "L", 
			"M", "N", "O", "P", "R", "S", "T", "U", 
			"F", "H", "C", "CH", "SH", "SH", "Y", "E", 
			"YU", "YA", "", "", "I", "I", "E", ' ');
        $e = trim(preg_replace($rus, $lat, $string));
		$pure_ascii = preg_replace( '/([\x00-\x2c]|[\x2e-\x2f]|[\x3a-\x40]|[\x5b-\x60]|[\x7b-\xff])/', ' ', $e );
		$pure_ascii3 = preg_replace( '/[\-]{2,}/', ' ',$pure_ascii );
		return $pure_ascii3;
    }
		
		
		
}		
?>