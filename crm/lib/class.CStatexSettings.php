<?php
namespace lib;

use GPBMetadata\Google\Iam\V1\Options;

trait CStatexSettings {
	use CStatexUtils;
	var $options;

	function __construct() {
		$this->options = $this->getConfig();
  }


	// псевдоним для getOrInitConfig()
	/**
	 * Возвращает весь массив опций
	 *
	 * Если встретилась опция с волшебным именем settings
	 * её значение декодируется из JSON
	 * @param $groupKey optional выдавать только конфиг группы с этим ключом
	 */
	function getConfig($groupKey =''){
		$arrConfig = [];

		$q = "SELECT *
		FROM `statex_config` ".
		($groupKey == '' ? "" : "WHERE `group_key`='{$groupKey}' ").
		"ORDER BY IF(`group_name` <> '', 0, 1), `id`
		";


		$res = JBase::Query($q);
		while ($option = $res->fetch_assoc()) {
				if (/* is_array($option) && */ ($option['name'] == 'settings')) {
					$arrConfig[] = json_decode($option['value'], true);
				} else {
					$arrConfig[] = $option;
				//	$arrConfig = self::initConfig();
				}
		}

		return $arrConfig;
	}

	/**
	 * инициализация настроек значениями по умолчанию
	 *
	 */
	function initConfig(){
		$arrConfig = [];

		//закидываем в таблицу настроек, предварительно очищая её
		$q = "TRUNCATE TABLE `statex_config`;";
		JBase::Query($q);

		$arrConfig = array();

		$arrConfig['options'][] = array(
			'group_name' => 'Кеширование',
			'group_key' => 'cache',
			);

		$arrConfig['options'][] = array('name' => 'Кеширование включено',
									'key' => 'enable_caching',
									'value' => '1',
									'group_key' => 'cache',
		);

		$arrConfig['options'][] = array(
			'group_name' => 'Обновление данных',
			'group_key' => 'import',
			);

		$arrConfig['options'][] = array('name' => 'Импортировать данные не старше N месяцев',
									'key' => 'import_months',
									'value' => '2',
									'group_key' => 'import',
		);



		$arrConfig['options'][] = array(
			'group_name' => 'Калькулятор',
			'group_key' => 'calc',
			);

		$arrConfig['options'][] = array('name' => 'Цена закупа',
									'key' => 'buy_calc_price',
									'value' => '250',
									'group_key' => 'calc',
		);

		$arrConfig['options'][] = array('name' => 'Стоимость звонка',
		'key' => 'vals_price_call',
		'value' => '160',
		'group_key' => 'calc',
		);

		$arrConfig['options'][] = array('name' => 'Стоимость аутсорсинга',
		'key' => 'vals_price_outsourcing',
		'value' => '80',
		'group_key' => 'calc',
		);

		$arrConfig['options'][] = array('name' => 'Стоимость доставки',
		'key' => 'vals_price_delivery',
		'value' => '350',
		'group_key' => 'calc',
		);

/* 		$arrConfig['options'][] = array('name' => 'Цвета рейтинга (старые)',
									'key' => 'colors',
									'value' => '#ccc, #b95843, #ed5028, #edbf28, #cfe628, #68c53f, #8bae9c, #4bbfe4',
									'group_key' => 'calc',
								);

		$arrConfig['options'][] = array('name' => 'Коэффициент категорий',
			'key' => 'factors',
			'value' => '1487=0.159500,1488=0.168900,1546=0.183700,1548=0.169800,1550=0.169800,1551=0.169800,1552=0.169800,1563=0.169800,1565=0.169800,1587=0.169800,1706=0.169800,1911=0.169800,1912=0.169800,1913=0.169800,1929=0.169800,1930=0.169800,1931=0.169800,2060=0.169800,2068=0.169800,2351=0.169800,2352=0.169800,2353=0.169800,2525=0.169800,2643=0.169800,2644=0.169800',
			'group_key' => 'calc',
		); */

		$arrConfig['options'][] = array('name' => 'Коэффициент цены лида',
			'key' => 'lead_price_ratio',
			'value' => '1',
			'group_key' => 'calc',
		);

		$arrConfig['options'][] = array('name' => 'РКО + комиссии',
			'key' => 'rko_fee',
			'value' => '6.5',
			'group_key' => 'calc',
		);

		$arrConfig['options'][] = array(
			'group_name' => 'План/факт',
			'group_key' => 'planfact',
			);

		$arrPlanfactRates = ["0","0","0","0","0","0", "0",
		"22.31","24.00","14.00","10.00","6.26","5.00","3.69","4.00","2.25","2.00","2.00","1.17","0.81","0.77","0.75","0.38","0.20","0.22","0.10","0.09"];
		for ($i=1; $i<28; $i++){
			$arrConfig['options'][] = array('name' => "День {$i}",
			'key' => "plan_day{$i}",
			'value' => $arrPlanfactRates[$i-1],
			'group_key' => 'planfact',
		);
		}

		return self::addOptions($arrConfig);
	}


	/**
	 * Выдаёт нужный элемент конфига
	 */
	function loadConfigOption($optionConstant, $default_value = ""){
		$arrConfig = self::getConfig();

		// if (count($arrConfig) == 0)

		return $arrConfig[$optionConstant];
	}

	/**
	 * сохраняем настройку в базу
	 * */
	function addOption($jsonParams){
		$sName		= ($jsonParams['option']['name'])		? $jsonParams['option']['name']				: 'Настройка '.date("Y-M-d H:i:s");
		$sKey			= ($jsonParams['option']['key']) 		? $jsonParams['option']['key']				: 'key_'.date("Y-M-d H:i:s");
		$sGroupKey	= ($jsonParams['option']['group_key'])	? $jsonParams['option']['group_key']		: '';

		$q = "DELETE FROM `statex_config` WHERE `key`='{$sKey}' AND `group_key`='{$sGroupKey}')";
		$res = JBase::Query($q);

		$q = "INSERT INTO `statex_config` (`name`, `key`, `value`, `group_key`)
				VALUES( '{$sName}', '{$sKey}', '{$jsonParams['option']['value']}', '{$sGroupKey}' )
				";

		$res = JBase::Query($q);
		if (!$res) {
			return self::addError([], __FUNCTION__."()", $q, $jsonParams);
		}

		return self::getConfig();
	}

	function deleteOption($jsonParams){
		// $sKey		= ($jsonParams['option']['key']) ? $jsonParams['option']['key']		: '_none_';

		$q = "DELETE  FROM `statex_config`
				WHERE `id`='{$jsonParams['option']['key']}';
				";

		$res = JBase::Query($q);
		if (!$res) {
			return self::addError(self::getConfig(),__FUNCTION__."()", $q, $jsonParams);
		}
		return self::getConfig();
	}

 	// сохраняем массив настроек в базу
	function addOptions($jsonParams){
		$q = "TRUNCATE TABLE `statex_config`;";
		JBase::Query($q);

		$required = array('name','key', 'value', 'group_key', 'group_name');

		$q = "INSERT INTO `statex_config` (`".
		join('`,`', $required).
		"`)	VALUES ";

		$arrQ = array();

		foreach($jsonParams['options'] as $param) {
			// $sName	= ($param['name']) ? $param['name']		: 'Настройка '.date("Y-M-d H:i:s");
			// $sKey		= ($param['key']) ? $param['key']		: 'key_'.date("Y-M-d H:i:s");

			$sQuery = "";
			foreach($required as $req) {
				if (!isset($param[$req])) $param[$req] = '';
				$sQuery .= "'".$param[$req]."',";
			}
			$sQuery = substr($sQuery,0,-1);

			$arrQ[]	=	"( ".$sQuery." )";
		}

		$q = $q.join($arrQ, ",\n");

		$res = JBase::Query($q);

		$arrResult['0'] = ["Success"];
		$arrResult['1'] = $jsonParams;
		$arrResult['query'] = $q;
		return self::getConfig();
	}


	/**
	 * выдаёт нужный элемент конфига по ключу
	 * */
	function getOption($optionKey, $default_value =""){
		if (count($this->options) > 0) {
			for ($i=0; $i<count($this->options); $i++){
				if ($this->options[$i]['key'] == $optionKey) {
					return $this->options[$i]['value'];
				}
			}

		}

		return $default_value;
	}

	/**
	 * выдаёт нужный элемент конфига по ключу
	 * */
	function getGroup($groupKey){
		$arrRes = array();
		if (count($this->options) > 0) {
			for ($i=0; $i<count($this->options); $i++){
				if ($this->options[$i]['group_key'] == $groupKey && $this->options[$i]['group_name'] == "") {
					$arrRes[$this->options[$i]['key']] = $this->options[$i]['value'];
				}
			}
		}

		return $arrRes;
	}
	/**
	 * сохраняем группу настроек в базу
	 * */
	function addOptionGroup($jsonParams){
		$sName	= ($jsonParams['option']['name']) ? $jsonParams['option']['name']		: 'Группа '.date("Y-M-d H:i:s");
		$sKey		= ($jsonParams['option']['key']) ? $jsonParams['option']['key']		: 'key_'.date("Y-M-d H:i:s");



		$q = "INSERT INTO `statex_config` (`group_name`, `group_key`)
				VALUES( '{$sName}', '{$sKey}' )
				";

		$res = JBase::Query($q);

		if (!$res) {
			return self::addError(self::getConfig(),__FUNCTION__."()", $q, $jsonParams);
		}

		return self::getConfig();
		// return self::getConfig();
	}

}

?>