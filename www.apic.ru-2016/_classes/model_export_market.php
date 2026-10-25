<?php 
error_reporting(-1);
require_once(CLASSES_BASE.'class_ice_mysql.php');
require_once(CLASSES_BASE.'model_icms.php');
require_once(CLASSES_BASE.'model_icms_pomo_folder.php');

class model_export_market{

// поля отдаваемые в яндекс в заголовке xml файла 
const SITE_NAME				= 'ПОМО';
const COMPANY				= 'ПОМО';
//const SITE_URL 				= '';
const PLATFORM				= 'icms';
const PLATFORM_MAJOR_VERSION= '201209';
const AGENCY				= '';
const AGENCY_EMAIL			= 'info@pomo.ru';
// по умолчанию товары в этом статусе
const DEFAULT_AVAILABLE 	= '1';  // 0=под заказ, 2=в наличии, 1=не выгружать
const DEFAULT_BID			= '10'; // 10 центов = по умолчанию минимальная ставка клика в маркете

// внутренние переменные и константы класса
private $m;
private $model;
private $f					= NULL;
private $money				= NULL;
const ITEM_TYPE1 			= 'pomo_folder_catalog_item_card';   
const ITEM_TYPE2 			= 'pomo_folder_catalog_kraski_subcard';   
const CATALOG_TYPE 			= "'pomo_folder_catalog','pomo_folder_catalog_3','pomo_folder_catalog_2','pomo_folder_catalog_1','pomo_folder_catalog_uni','pomo_folder_catalog_kraski_card'";
const AVAIL_TYPE_OK 		= '2';
const AVAIL_TYPE_NO 		= '1';
const AVAIL_TYPE_ZAKAZ		= '0';
// пути к файлам
private $xml_file_tmp		= '';
private $xml_file			= '';
private $site_url			= '';

private $utm_source         = '';
private $utm_medium         = '';

private $o_actions         = '';
		
function __construct($site_url, $xml_file_tmp,$xml_file, $utm_source='',$utm_medium='' ){
	$this->site_url = $site_url;
	$this->xml_file_tmp = $xml_file_tmp;
	$this->xml_file = $xml_file;
	$this->utm_source = $utm_source;
	$this->utm_medium = $utm_medium;
	$this->m = new ice_mysql();
	$this->model = new model_icms_pomo_folder($this->m);
	$tmp = $this->model->get_object_anons(	ID_ACTIONS,100,0,'DESC', false);
	$this->o_actions =  $tmp['childs'][0];
//	alid(	$this->o_actions	);
//	exit();
	}

/**
*   Сделать всю работу.
*/
public function process(){
	$this->money = $this->model->get_money();
	$tree = $this->model->get_tree(ID_CATALOG, 1,100, self::CATALOG_TYPE);
//	echo sizeof($tree['catalog']);

	$this->f = fopen ($this->xml_file_tmp, "wb");
	if (!$this->f){
		exit('cant write tmp xml to='.$this->xml_file_tmp."\r\n");
		};
	$this->xml_header();
	$this->xml_catalog_header($tree);
	$this->xml_catalog_items($tree);
	$this->xml_footer();

	// закроем, закроем, закроем и переименуем
	fflush($this->f);
	fclose($this->f);
	unset($this->f);
	sleep(3);
	$st = rename($this->xml_file_tmp, $this->xml_file);
	if (!$st){
		exit('cant RENAME tmp='.$this->xml_file_tmp.' to='.$this->xml_file."\r\n");
		};
	return 1;
	}

/**
* Заголовок файла - о компании, урл, валюты
*/
private function xml_header(){
	$header = '<?xml version="1.0" encoding="windows-1251" ?>
<yml_catalog date="'.date('Y-m-d H:i').'"><shop>
<name>'.self::SITE_NAME.'</name>
<company>'.self::COMPANY.'</company>
<url>'.$this->site_url.'</url>
<platform>'.self::PLATFORM.'</platform>
<version>'.self::PLATFORM_MAJOR_VERSION.'</version>
<agency>'.self::AGENCY.'</agency>
<email>'.self::AGENCY_EMAIL.'</email>
<currencies>
<currency id="RUR" rate="1"/>
</currencies>
';
	fwrite($this->f,$header);
	}

/**
*   Оглавление каталога
*/
private function xml_catalog_header($tree){
	$header = '<categories><category id="'.ID_CATALOG.'">Каталог оборудования</category>'."\r\n";
	$footer = '</categories>'."\r\n";
	fwrite($this->f,$header);
	while(list($k,$v)=each($tree['catalog'])){
		if ($v['status']=='active'){
			$line = '<category id="'.$v['id'].'" parentId="'.$v['parent_id'].'">'.htmlspecialchars($v['name']).'</category>'."\r\n";
			fwrite($this->f,$line);
			};
		};
	fwrite($this->f,$footer);
	}


/**
*    Пройтись по всему дереву, найти товары и запустить генерацию оферов
*/
private function xml_catalog_items($tree){
	$header = '<offers>'."\r\n";
	$footer = '</offers>'."\r\n";
	fwrite($this->f,$header);
	while(list($k,$v)=each($tree['catalog'])){
		if ($v['status']=='active'){

			/*
			$found1 = 1;
			$found2 = 1;
			$offset=0;
			$step=1000;
			while( ($found1>0) || ($found2>0) ){
			*/
			$offset=0;
			$step=100000;

			
			// ITEM1
				$childs1 = $this->model->get_object_anons($v['id'],$step,$offset,'asc', '"'.self::ITEM_TYPE1.'"'  );
				$found1 = sizeof($childs1['childs']);
				//$offset=$offset+$step;
			//	echo $v['id'].'-'.$v['name']."offset=".$offset.' found1='.$found1."\r\n";
				while(list($kk,$vv)=each($childs1['childs'])){
					$this->xml_item(	$vv,$v['id']	);
					};
			
				
				// ITEM2
				$childs2 = $this->model->get_object_anons($v['id'],$step,$offset,'asc', '"'.self::ITEM_TYPE2.'"'  );
				//alid($childs);
				$found2 = sizeof($childs2['childs']);
				//$offset=$offset+$step;
				//echo $v['id'].'-'.$v['name']."offset=".$offset.' found2='.$found2."\r\n";
				while(list($kk,$vv)=each($childs2['childs'])){
					$this->xml_item(	$vv,$v['id']	);
					};

				/*
				};
				*/

			};
		};
	fwrite($this->f,$footer);
	}

/**
*   Записать один оффер
*/
private function xml_item(	$obj,$parent_id	){
	//alid($obj);
	//alid($this->money);
	//exit();

//	if ($obj['id']==33528633){
//		alid($obj);
//		};


	// параметра может и не быть, установим дефолтное значение
	$avail = isset($obj['params']['yandexmarket']['pvalue'])?$obj['params']['yandexmarket']['pvalue'] : self::DEFAULT_AVAILABLE;

	if ($avail==self::AVAIL_TYPE_NO){
		// не выгружаем
		return;
		};

	$bid = isset($obj['params']['yandexmarketprice']['pvalue'])?$obj['params']['yandexmarketprice']['pvalue']:self::DEFAULT_BID;

	if (isset($obj['params']['image']['pvalue']) && is_file(ROOT_PUBLIC_IMAGES_CATALOG.$obj['params']['image']['pvalue'])){
		$picture = $this->site_url.$obj['params']['image']['pvalue'];
		}
	elseif	(isset($obj['params']['brand_logo']['pvalue']) && is_file(ROOT_PUBLIC_IMAGES_BRANDS.$obj['params']['brand_logo']['pvalue'])){
		$picture = $this->site_url.($obj['params']['brand_logo']['pvalue']);
		}
	else {
		$picture = '';
		};

	$price = 
		(isset($obj['params']['price']['pvalue'])  &&  
		 isset($obj['params']['currency']['pvalue']) && 
		 isset($this->money['childs'][	$obj['params']['currency']['pvalue']	]['currency'])
		 )?
		$obj['params']['price']['pvalue'] * $this->money['childs'][	$obj['params']['currency']['pvalue']	]['currency']
		:'';

	$vendor = isset($obj['params']['brand_name']['pvalue'])?$obj['params']['brand_name']['pvalue']:'';

	$vendorcode = isset($obj['params']['article']['pvalue'])?$obj['params']['article']['pvalue']:'';

	//индивидуальная акция
	$sales_note = (isset($obj['params']['action_imarket']['pvalue']))?$obj['params']['action_imarket']['pvalue']:'';
	
	// акция на все товары
	$sales_note_all = (isset($this->o_actions['params']['action_allcatalog']['pvalue']) && 
		($this->o_actions['params']['action_allcatalog']['pvalue'] == '1')
		)?$this->o_actions['params']['action_to_market']['pvalue']:'';

	//echo 	$sales_note2."\r\n"; 
	$sales_note = ($sales_note!='')?$sales_note:$sales_note_all;
	
	if (	
		isset(	$obj['params']['action_id']['pvalue']	)  &&  
		($obj['params']['action_id']['pvalue'] > 0) 
		){
			$o_action = $this->model->get_object_base(	$obj['params']['action_id']['pvalue']	);

			if ( isset($o_action['object']['status']) && ($o_action['object']['status']=='active') ){
				//alid($o_action);
				$sales_note = (isset($o_action['object']['params']['action_to_market']['pvalue']))
					?
					$o_action['object']['params']['action_to_market']['pvalue']
					:
					$sales_note;
				};
			};

//	if ($sales_note!='') 
//		{
//		echo $obj['id']." => ".$sales_note."\r\n";
//		};


	$available= ($avail==self::AVAIL_TYPE_OK)?'true':'false';
//	echo $obj['id'].'='.$avail.' avalable='.$available."\r\n";

	if ($price>0){
/*
	$xml = "
<offer id=\"".$obj['id']."\" available=\"".$available."\" type=\"vendor.model\" bid=\"{$bid}\">
<url>".$this->site_url.htmlspecialchars($obj['url'])."</url>
<price>{$price}</price>
<currencyId>RUR</currencyId>
<categoryId>{$parent_id}</categoryId>
".
(($picture=='')?'':"<picture>".htmlspecialchars($picture)."</picture>")
.
"<vendor>".htmlspecialchars($vendor)."</vendor>
<vendorCode>".htmlspecialchars($vendorcode)."</vendorCode>
<model>".htmlspecialchars($obj['fullname'])."</model>
</offer>
";
*/

	$xml = "
<offer id=\"".$obj['id']."\" available=\"".$available."\"  bid=\"{$bid}\">
<url>".$this->site_url.htmlspecialchars($obj['url']).$this->addlink($obj['id'])."</url>
<price>{$price}</price>
<currencyId>RUR</currencyId>
<categoryId>{$parent_id}</categoryId>
".
(($picture=='')?'':"<picture>".htmlspecialchars($picture)."</picture>")
.
"<name>".htmlspecialchars($obj['fullname'])."</name>
<sales_notes>".$sales_note."</sales_notes>
</offer>
";





	fwrite($this->f,$xml);
	};
	}


/**
*   Закрыть xml закрывающими тегами
*/
private function xml_footer(){
	$header = '</shop></yml_catalog>';
	fwrite($this->f,$header);
	}


	
private function addlink($item_id){
		$o = 
			base64_encode($this->utm_source.";".$this->utm_medium.";".$item_id.";".$item_id);
		$g = 
			"&amp;utm_source=".$this->utm_source.
			"&amp;utm_medium=".$this->utm_medium.
			"&amp;utm_term=".$item_id.
			"&amp;utm_content=".$item_id.
			"&amp;utm_campaign=".$this->utm_medium;
		
		return "?_openstat=".$o.$g;
		}
	
}
?>