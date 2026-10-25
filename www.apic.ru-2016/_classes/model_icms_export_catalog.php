<?php 
error_reporting(-1);
require_once(CLASSES_BASE.'class_ice_mysql.php');
require_once(CLASSES_BASE.'model_icms.php');
require_once(CLASSES_BASE.'model_icms_proto.php');

class model_export_catalog{

// поля отдаваемые в яндекс в заголовке xml файла 
const SITE_NAME				= '';
const COMPANY				= '';
const SITE_URL 				= '';
const PLATFORM				= 'icms';
const PLATFORM_MAJOR_VERSION= '201111';
const AGENCY				= '';
const AGENCY_EMAIL			= '';
// по умолчанию товары в этом статусе
const DEFAULT_AVAILABLE 	= '0';  // 0=под заказ, 2=в наличии, 1=не выгружать
const DEFAULT_BID			= '10'; // 10 центов = по умолчанию минимальная ставка клика в маркете

// внутренние переменные и константы класса
private $m;
private $model;
private $f					= NULL;
private $money				= NULL;
const ITEM_TYPE 			= "pomo_folder_catalog_item_card";
const CATALOG_TYPE 			= "'pomo_folder_catalog','pomo_folder_catalog_2','pomo_folder_catalog_1'";
const AVAIL_TYPE_OK 		= '2';
const AVAIL_TYPE_NO 		= '1';
const AVAIL_TYPE_ZAKAZ		= '0';
// пути к файлам
private $xml_file_tmp		= '';
private $xml_file			= '';


function __construct($xml_file_tmp,$xml_file){
	$this->xml_file_tmp = $xml_file_tmp;
	$this->xml_file = $xml_file;
	$this->m = new ice_mysql();
	$this->model = new model_icms_proto($this->m);
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
<url>'.self::SITE_URL.'</url>
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
//		if ($v['status']=='active'){
			$line = '<category id="'.$v['id'].'" parentId="'.$v['parent_id'].'"  status="'.$v['status'].'">'.htmlspecialchars($v['name']).'</category>'."\r\n";
			fwrite($this->f,$line);
//			};
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
//	echo '_'.$v['id'].'_ ';
//		if ($v['status']=='active'){
			$found = 1;
			$offset=0;
			$step=1000;
			while($found>0){
				$childs = $this->model->get_object_anons($v['id'],$step,$offset,'asc', '"'.self::ITEM_TYPE.'"', false );
				$found =   is_array($childs['childs'])?  sizeof($childs['childs']): 0;
//				var_dump(	$childs['childs']	);
//				echo $v['id'].'-'.$v['name']."offset=".$offset.' found='.$found."\r\n";
				while(list($kk,$vv)=each($childs['childs'])){
					$o_base = $this->model->get_object_base($vv['id']);
//					var_dump($o_base['object']['document']);
					$this->xml_item(	$vv,$v['id'],$o_base['object']['document']	);
					};
				$offset=$offset+$step;
				};

//			};
		};
	fwrite($this->f,$footer);
	}


/**
*   Записать один оффер
*/
private function xml_item(	$obj,$parent_id,$description	){
//	echo $obj['id'].' ';
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
		$picture = self::SITE_URL.'/ii/catalog/'.rawurlencode($obj['params']['image']['pvalue']);
		$md5 = md5_file(	ROOT_PUBLIC_IMAGES_CATALOG.$obj['params']['image']['pvalue']	);
		}
	elseif	(isset($obj['params']['brand_logo']['pvalue']) && is_file(ROOT_PUBLIC_IMAGES_BRANDS.$obj['params']['brand_logo']['pvalue'])){
		$picture = '';
		};

	$price = $obj['params']['price']['pvalue'] * $this->money['childs'][	$obj['params']['currency']['pvalue']	]['currency'];

	$vendor = isset($obj['params']['brand_name']['pvalue'])?$obj['params']['brand_name']['pvalue']:'';

	$vendorcode = isset($obj['params']['article']['pvalue'])?$obj['params']['article']['pvalue']:'';

	$available= ($avail==self::AVAIL_TYPE_OK)?'true':'false';
//	echo $obj['id'].'='.$avail.' avalable='.$available."\r\n";

//alid($obj);
//exit();

//	if ($price>0){
$xml_params = '';
	reset($obj['params']);
	while(list($kk,$vv)=each($obj['params'])){
//		var_dump($vv);
//		exit();
		$xml_params .= "<param name=\"".$vv['pname']."\">".htmlspecialchars($vv['pvalue'])."</param>\r\n";
		};


	$xml = "
<offer id=\"".$obj['id']."\" available=\"".$available."\" status=\"".$obj['status']."\">
<url>".self::SITE_URL.htmlspecialchars($obj['url'])."</url>
<price_rur>{$price}</price_rur>
<currencyId>RUR</currencyId>
<categoryId>{$parent_id}</categoryId>
<picture url=\"".self::SITE_URL.htmlspecialchars($picture)."\" md5=\"".$md5."\"></picture>
<vendor>".htmlspecialchars($vendor)."</vendor>
<vendorCode>".htmlspecialchars($vendorcode)."</vendorCode>
<model>".htmlspecialchars($obj['fullname'])."</model>
<params>"
.
$xml_params.
"</params>
<description>".htmlspecialchars($description)."</description>
</offer>
";

	fwrite($this->f,$xml);
//	};
	}


/**
*   Закрыть xml закрывающими тегами
*/
private function xml_footer(){
	$header = '</shop></yml_catalog>';
	fwrite($this->f,$header);
	}

}


?>
