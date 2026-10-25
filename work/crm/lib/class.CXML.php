<?php 
namespace lib;
ini_set('max_execution_time', 3000);

if (!defined('VOCU_FWK')) die(); //не работает без нашего фреймверка

/**
* class.CXML.php
*
*Класс - библиотека с функциями для ответов ajax для работы с XML загрузкой фидов
*подгружается через автоподгрузку классов
*
* История:  2016.12.12 - файл создан
*
**/

class CXML {

	//общий фид
	function compare() {	
		$value = ($_POST['status'] == 'true') ? '1' : '0';
		JBase::Update_Data('templates', ['compare_feeds' => $value], '');
		self::feed_new([USERID, DOMAIN]);
		return true;
	}
	//cнять премиум услуги
	function premium() {	
	
		if ($_POST['status'] == 'true') {			
			//Количество категорий
			$catcount = explode('_', JBase::Get_Field_Value_From_Domain('templates', 'category'));
			
			//Общий фид
			$compare = JBase::Get_Field_Value_From_Domain('templates', 'compare_feeds');
			$where = ($compare == '0') ? ['domain' => DOMAIN, 'id_user' => USERID] : ['domain' => DOMAIN];
			
			//Обнуляем премиум услуги
			$fields = [
				'avitoVIP' => 0,
				'avitoPushUp' => 0,
				'avitoPremium' => 0,
				'avitoHighlight' => 0,
				'avitoTurboSale' => 0,
				'avitoQuickSale' => 0,
				'cianhighlight' => 0,
				'cianpremium' => 0,
				'ciantop3' => 0,
				'yandexraise' => 0,
				'yandexpremium' => 0,
				'yandexpromotion' => 0
			];
			foreach ($catcount as $list) {
				JBase::Update_Data('list'. $list, $fields, $where);
			}
			self::feed_new([USERID, DOMAIN]);
			return true;
		}	
	}
	
	//запрос всех доступных площадок для выгрузки
	function get_feed_boards($user) {	
		
		//запрос Разделить фид
		$compare_feeds = JBase::Get_Field_Value_From_Domain('templates', 'compare_feeds');
		if ($compare_feeds == '1') {
			$n1link = 'https://'. DOMAIN .'/cdn/xml/an/'. md5('n1all' . DOMAIN) .'.xml';
			$cianlink = 'https://'. DOMAIN .'/cdn/xml/ac/'. md5('cianall' . DOMAIN) .'.xml';
			$avitolink = 'https://'. DOMAIN .'/cdn/xml/aa/'. md5('avitoall' . DOMAIN) .'.xml';
			$yandexlink = 'https://'. DOMAIN .'/cdn/xml/ay/'. md5('yandexall' . DOMAIN) .'.xml';
			$domclicklink = 'http://xml.otys.ru/xml/ad/'. md5('domclickall' . DOMAIN) .'.xml';
		}
		if ($compare_feeds == '0') {
			$n1link = 'https://'. DOMAIN .'/cdn/xml/un/'. md5('n1' . DOMAIN) .'.xml';
			$cianlink = 'https://'. DOMAIN .'/cdn/xml/uc/'. md5('cian' . $user . DOMAIN) .'.xml';
			$avitolink = 'https://'. DOMAIN .'/cdn/xml/ua/'. md5('avito' . $user . DOMAIN) .'.xml';
			$yandexlink = 'https://'. DOMAIN .'/cdn/xml/uy/'. md5('yandex' . $user . DOMAIN) .'.xml';
			$domclicklink = 'http://xml.otys.ru/xml/ud/'. md5('domclick' . $user . DOMAIN) .'.xml';
		}
		
		//запрос всех доступных площадок для выгрузки
		$Result = JBase::Get_Full_Table('feed_boards');
		if (!empty($Result)) {
			$items = [];
			while ($item = $Result->fetch_assoc()) {
				if ($item['link_board'] == 'http://n1.ru') $item['feedlink'] = $n1link;
				if ($item['link_board'] == 'http://avito.ru') $item['feedlink'] = $avitolink;
				if ($item['link_board'] == 'http://www.cian.ru') $item['feedlink'] = $cianlink;
				if ($item['link_board'] == 'http://realty.yandex.ru') $item['feedlink'] = $yandexlink;
				if ($item['link_board'] == 'http://realty.domclick.ru') $item['feedlink'] = $domclicklink;
				$items[] = $item;
			}
			return $items;
		}		
	}
	
	//статистика выгрузки
	function feedstat($user) {
		
		$Result = [];
		
		//Общий фид
		$compare = JBase::Get_Field_Value_From_Domain('templates', 'compare_feeds');
		
		//Количество категорий
		$catcount = explode('_', JBase::Get_Field_Value_From_Domain('templates', 'category'));
		$Result['count'] = count($catcount);
		
		//Общее количество объявлений
		//Объявлений в фиде	N1:	Cian:	Avito:	Yandex:	Domclick:
		//Из них платных	N1:	Cian:	Avito:	Yandex:	Domclick:
		$fields = [
			'avito',
			'avitoVIP',
			'avitoPushUp', 
			'avitoPremium',
			'avitoHighlight', 
			'avitoTurboSale', 
			'avitoQuickSale',	 
			'cian',
			'cianhighlight', 
			'cianpremium',
			'ciantop3',
			'yandex',
			'yandexraise',	 
			'yandexpremium',	 
			'yandexpromotion', 
			'domclick',
			'n1'
		];
		foreach ($catcount as $list) {
			$Result['fields'][$list] = self::feed_count($list, $fields, $compare, $user);
		}
		
		$Result['compare'] = $compare;
		return $Result;
	}
	
	//Счет выгрузки
	function feed_count($list, $fields, $compare, $user) {
		
		$items = [];
		$list = (int)$list;
		$select = 'SELECT ';

		foreach ($fields as $field) {
			$where = ($compare == '0') ? "`status` = '1' AND `id_user` = '". $user ."'" : "`status` = '1'";
			$select .= "(SELECT COUNT('". $field ."') FROM list". $list ." where ". $where ." AND `". $field ."` = '1' AND `domain` = '". DOMAIN ."') as ". $field .",";
		}
		//$select .= "(SELECT COUNT('". $field ."') FROM list". $list ." where `status` = '1' AND `". $field ."` = '1' AND `domain` = '". DOMAIN ."') as ". $field ."";
		$select .= "(SELECT COUNT('id') FROM list". $list ." where ". $where ." AND `domain` = '". DOMAIN ."') as total";
		$Result = JBase::Query($select);

		if (!empty($Result)) {
			while ($item = $Result->fetch_assoc()){
				$items = $item;
			}		
		}
		return $items;
	}
	//создаем задачу для обновления фида
	function feed_new($param) {
//		 $item = JBase::Get_Id('feed_new', ['user' => $param[0]]);
//	 	if ( (int)$item === 0 ) 
//	 		JBase::Set_Data('feed_new', ['user','domain'], $param);
		self::feed_gen($param);
	}
	//генерация фида для каждого пользователя
	function feed_gen($data) {
		if ($data) {
			if (JBase::Get_Field_Value_From_Domain('templates', 'compare_feeds') == '1') $data[0] = 'all';
			
			Cian::createfeed($data);
			Avito::createfeed($data);
			Yandex::createfeed($data);
			Domclick::createfeed($data);
			N1::createfeed($data);
		}
	}
   
   //xml импорт
	function setXML() {
	
		$url = file_get_contents($_POST['url']);
		
		if ($url && userType(CUser::user(TOKEN)) == '1') {
    		$xml = simplexml_load_string($url);

			if (false === $xml) {
			    return 'Ошибка в XML фиде';
			}

    		//удаляем пустые значения
			foreach( $xml->xml->xpath('/child::*//*[not(*) and not(text()[normalize-space()])]') as $emptyElement ) {
			    unset( $emptyElement[0] );
			}
			$json = json_encode($xml, JSON_UNESCAPED_UNICODE);
			$array = json_decode($json, TRUE);
			
			if (count($array['object']) == '0') {
			    return 'Пустой фид или неверный формат';
			}
			
			//ограничиваем количество объектов в фиде
			if (count($array['object']) > 1000) array_splice($array['object'], 1000);
			
			//зачищаем папки
			//$folders = ['1','2','3','4','5','6','8','9','10','11','12','13','14','15'];
        	//$sftp = new LocalConnection();
        	//foreach ($folders as $folder) {
        	//	$sftp->removeDir(DOMAIN . '/card/' . $folder);
        	//}

			$array['object'] = array_map(function($value) {
    		
				$exit = [];
			
				$lAll = 0;
				$l1 = 0;
				$l2 = 0;
				$l3 = 0;
				$l4 = 0;
				$l5 = 0;
				$l6 = 0;
				$l8 = 0;
				$l9 = 0;
				$l10 = 0;
				$l11 = 0;
				$l12 = 0;
				$l13 = 0;
				$l14 = 0;
				$l15 = 0;
				
				$CAT = $value['Category'];
				
				if (in_array($CAT, ['houseSale','cottageSale','townhouseSale'])) $CAT = 'homeSale';
				elseif (in_array($CAT, ['houseRent','cottageRent','townhouseRent'])) $CAT = 'homeRent';
				
				elseif (in_array($CAT, ['buildingSale','officeSale','businessSale','industrySale','freeAppointmentObjectSale','warehouseSale','shoppingAreaSale'])) $CAT = 'commercialSale';
				elseif (in_array($CAT, ['buildingRent','officeRent','businessRent','industryRent','freeAppointmentObjectRent','warehouseRent','shoppingAreaRent'])) $CAT = 'commercialRent';
				
				switch ($CAT) {
					case 'flatSale':
						$list = '1';
						$arr['Вторичка продажа (1)'] = '';
					break;
					case 'roomSale':
						$list = '2';
						$arr['Комнаты продажа (2)'] = '';
					break;
					case 'homeSale':
						$list = '3';
						$arr['Загородная продажа (3)'] = '';
					break;
					case 'landSale':
						$list = '4';
						$arr['Земельные участки продажа (4)'] = '';
					break;
					case 'garageSale':
						$list = '5';
						$arr['Гаражи, паркинги продажа (5)'] = '';
					break;
					case 'commercialSale':
						$list = '6';
						$arr['Коммерческая продажа (6)'] = '';
					break;
					case 'newBuildingFlatSale':
						$list = '8';
						$arr['Новостройки продажа (8)'] = '';
					break;
					case 'flatRent':
						$list = '9';
						$arr['Вторичка аренда (9)'] = '';
					break;
					case 'commercialLandSale':
						$list = '10';
						$arr['Коммерческая земля продажа (10)'] = '';
					break;
					case 'roomRent':
						$list = '11';
						$arr['Комнаты аренда (11)'] = '';
					break;
					case 'homeRent':
						$list = '12';
						$arr['Загородная аренда (12)'] = '';
					break;
					case 'commercialLandRent':
						$list = '13';
						$arr['Коммерческая земля аренда (13)'] = '';
					break;
					case 'garageRent':
						$list = '14';
						$arr['Гаражи, паркинги аренда (14)'] = '';
					break;
					case 'commercialRent':
						$list = '15';
						$arr['Коммерческая аренда (15)'] = '';
					break;
				}
				
				//адрес
				$yandexfield = [];
				$parse = explode(',', $value['Address']);
				
				if ($parse[0] == 'Россия') unset($parse[0]);
				if (count($parse) == '3') {
					$home = array_pop($parse);
					$street = array_pop($parse);
					$locality = array_pop($parse);
				} elseif (count($parse) == '4') {
					$home = array_pop($parse);
					$street = array_pop($parse);
					$province = array_shift($parse);
					$locality = array_shift($parse);
				} elseif (count($parse) > '4') {
					$home = array_pop($parse);
					$street = array_pop($parse);
					$province = array_shift($parse);
					$locality = array_shift($parse);
					$raion = array_shift($parse);
				} 
								
				$yandexfield['kinds']['country'] 			= 'Россия';
				$yandexfield['kinds']['province'] 			= $province;
				$yandexfield['kinds']['locality'] 			= $locality;
 				$yandexfield['ycoradr']['raion'] 			= $raion;
				$yandexfield['kinds']['street'] 			= $street .', '. $home;
 				$yandexfield['ycoradr']['address'] 			= $value['Address'];
 				$yandexfield['ycoradr']['coords'] 			= $value['Coordinates']['Lat'] .','. $value['Coordinates']['Lng'];
				
				if ( isset($value['Undergrounds']['UndergroundInfoSchema']['Id']) ) {
					$yandexfield['metro']['branch'] 		= '15';
					$yandexfield['metro']['metroName'] 		= JBase::Get_Field_Value_From_Id_Nodomain('metro', (int)$value['Undergrounds']['UndergroundInfoSchema']['Id'], 'name');
					$yandexfield['metro']['distance'] 		= (isset($value['Undergrounds']['UndergroundInfoSchema']['Time'])) ? ceil((int)$value['Undergrounds']['UndergroundInfoSchema']['Time'] * 400) . 'м' : '';	                  	
					$yandexfield['metro']['station'] 		= $value['Undergrounds']['UndergroundInfoSchema']['Id'];
				}
					
				//очищаем массив от пустых значений
				$yandex = array_map('array_filter', $yandexfield);
				$yandex = array_filter($yandex);
											
				$yandexfield = json_encode($yandex, JSON_UNESCAPED_UNICODE);
							
    			return [        			
        			'arr'	 							=> $arr,
        			'list'	 							=> $list,

        			'AccessType'						=> $value['Building']['AccessType'],
        			'AgentFee'							=> ($value['BargainTerms']['AgentFee']) ?: '0',
        			'AllRoomsArea'						=> $value['AllRoomsArea'],
        			'Area'								=> $value['Land']['Area'],
        			'avito'								=> 'error',
        			'avitoHighlight'					=> 'error',
        			'avitoPremium'						=> 'error',
        			'avitoPushUp'						=> 'error',
        			'avitoQuickSale'					=> 'error',
        			'avitoTurboSale'					=> 'error',
        			'avitoVIP'							=> 'error',
        			'BalconiesCount'					=> $value['BalconiesCount'],
        			'BedroomsCount'						=> $value['BedroomsCount'],
        			'BuildTotalArea'					=> $value['Building']['TotalArea'],
        			'BuildYear'							=> $value['Building']['BuildYear'],
        			'BusinessShoppingCenter'			=> $value['BusinessShoppingCenter']['Id'],
        			'CadastralNumber'					=> $value['CadastralNumber'],
        			'canParts'							=> 'error',
        			'CargoLiftsCount'					=> $value['Building']['CargoLiftsCount'],
        			'Category'							=> $value['Category'] ?: 'error',
        			'CeilingHeight'						=> $value['Building']['CeilingHeight'],
        			'ChildrenAllowed'					=> ($value['ChildrenAllowed'] == 'true') ? 1 : 0,
        			'cian'								=> 'error',
        			'cianhighlight'						=> 'error',
        			'cianpremium'						=> 'error',
        			'ciantop3'							=> 'error',
        			'ClassType'							=> $value['Building']['ClassType'],
        			'ClientFee'							=> ($value['BargainTerms']['ClientFee']) ?: '0',
        			'CombinedWcsCount'					=> $value['CombinedWcsCount'],
        			'ConditioningType'					=> $value['Building']['ConditioningType'],
        			'ConditionType'						=> $value['ConditionType'],
        			'Country'							=> 'error',
        			'CountryCode'						=> $value['Phones']['PhoneSchema'][0]['CountryCode'],
        			'Decoration'						=> $value['Decoration'],
        			'Deposit'							=> ($value['BargainTerms']['Deposit']) ?: '0',
        			'Description'						=> $value['Description'],
        			'Developer'							=> $value['Building']['Developer'],
        			'District'							=> 'error',
        			'domain'							=> DOMAIN,
        			'domclick'							=> 'error',
        			'Drainage'							=> $value['Drainage']['LocationType'],
        			'DrivewayType'						=> $value['DrivewayType'],
        			'Electricity'						=> $value['Electricity']['LocationType'],
        			'EstateType'						=> $value['EstateType'],
        			'ExtinguishingSystemType'			=> $value['Building']['ExtinguishingSystemType'],
        			'FirstName'							=> $value['SubAgent']['FirstName'],
        			'FlatRoomsCount'					=> ($value['FlatRoomsCount'] == '9') ? 'Студия' : $value['FlatRoomsCount'],
        			'FloorNumber'						=> $value['FloorNumber'],
        			'FloorsCount'						=> $value['Building']['FloorsCount'],
        			'FurniturePresence'					=> $value['FurniturePresence'],
        			'galleryfield'						=> self::getGallery($list, $value['Photos']['PhotoSchema']),
        			'GarageStatus'						=> $value['Garage']['Status'],
        			'GarageType'						=> $value['Garage']['Type'],
        			'Gas'								=> $value['Gas']['LocationType'],
        			'geo'								=> 'error',
        			'HasAtm'							=> ($value['HasAtm'] == 'true') ? 1 : 0,
        			'HasAutomaticGates'					=> ($value['HasAutomaticGates'] == 'true') ? 1 : 0,
        			'HasBankDepartment'					=> ($value['HasBankDepartment'] == 'true') ? 1 : 0,
        			'HasBasement'						=> ($value['HasBasement'] == 'true') ? 1 : 0,
        			'HasBathhouse'						=> ($value['HasBathhouse'] == 'true') ? 1 : 0,
        			'HasBathtub'						=> ($value['HasBathtub'] == 'true') ? 1 : 0,
        			'HasBeautyShop'						=> ($value['HasBeautyShop'] == 'true') ? 1 : 0,
        			'HasBuffet'							=> ($value['HasBuffet'] == 'true') ? 1 : 0,
        			'HasCanteen'						=> ($value['HasCanteen'] == 'true') ? 1 : 0,
        			'HasCarService'						=> ($value['HasCarService'] == 'true') ? 1 : 0,
        			'HasCarWash'						=> ($value['HasCarWash'] == 'true') ? 1 : 0,
        			'HasCentralReception'				=> ($value['HasCentralReception'] == 'true') ? 1 : 0,
        			'HasCinema'							=> ($value['HasCinema'] == 'true') ? 1 : 0,
        			'HasClothesStudio'					=> ($value['HasClothesStudio'] == 'true') ? 1 : 0,
        			'HasConditioner'					=> ($value['HasConditioner'] == 'true') ? 1 : 0,
        			'HasConferenceRoom'					=> ($value['HasConferenceRoom'] == 'true') ? 1 : 0,
        			'HasDishwasher'						=> ($value['HasDishwasher'] == 'true') ? 1 : 0,
        			'HasDrainage'						=> ($value['HasDrainage'] == 'true') ? 1 : 0,
        			'HasElectricity'					=> ($value['HasElectricity'] == 'true') ? 1 : 0,
        			'HasEncumbrances'					=> ($value['HasEncumbrances'] == 'true') ? 1 : 0,
        			'HasEntryByPass'					=> ($value['HasEntryByPass'] == 'true') ? 1 : 0,
        			'HasExhibitionAndWarehouseComplex'	=> ($value['HasExhibitionAndWarehouseComplex'] == 'true') ? 1 : 0,
        			'HasExtinguishingSystem'			=> ($value['HasExtinguishingSystem'] == 'true') ? 1 : 0,
        			'HasFitnessCentre'					=> ($value['HasFitnessCentre'] == 'true') ? 1 : 0,
        			'HasFridge'							=> ($value['HasFridge'] == 'true') ? 1 : 0,
        			'HasFurniture'						=> ($value['HasFurniture'] == 'true') ? 1 : 0,
        			'HasGarage'							=> ($value['HasGarage'] == 'true') ? 1 : 0,
        			'HasGarbageChute'					=> ($value['Building']['HasGarbageChute'] == 'true') ? 1 : 0,
        			'HasGas'							=> ($value['HasGas'] == 'true') ? 1 : 0,
        			'HasGracePeriod'					=> ($value['HasGracePeriod'] == 'true') ? 1 : 0,
        			'HasHeating'						=> ($value['HasHeating'] == 'true') ? 1 : 0,
        			'HasHotel'							=> ($value['HasHotel'] == 'true') ? 1 : 0,
        			'HasHourSecurity'					=> ($value['HasHourSecurity'] == 'true') ? 1 : 0,
        			'HasInspectionPit'					=> ($value['HasInspectionPit'] == 'true') ? 1 : 0,
        			'HasInternet'						=> ($value['HasInternet'] == 'true') ? 1 : 0,
        			'HasInvestmentProject'				=> ($value['HasInvestmentProject'] == 'true') ? 1 : 0,
        			'HasKitchenFurniture'				=> ($value['HasKitchenFurniture'] == 'true') ? 1 : 0,
        			'HasLight'							=> ($value['HasLight'] == 'true') ? 1 : 0,
        			'HasMedicalCenter'					=> ($value['HasMedicalCenter'] == 'true') ? 1 : 0,
        			'HasMinimarket'						=> ($value['HasMinimarket'] == 'true') ? 1 : 0,
        			'HasNotaryOffice'					=> ($value['HasNotaryOffice'] == 'true') ? 1 : 0,
        			'HasPark'							=> ($value['HasPark'] == 'true') ? 1 : 0,
        			'HasPharmacy'						=> ($value['HasPharmacy'] == 'true') ? 1 : 0,
        			'HasPhone'							=> ($value['HasPhone'] == 'true') ? 1 : 0,
        			'HasPool'							=> ($value['HasPool'] == 'true') ? 1 : 0,
        			'HasRamp'							=> ($value['HasRamp'] == 'true') ? 1 : 0,
        			'HasRestaurant'						=> ($value['HasRestaurant'] == 'true') ? 1 : 0,
        			'HasSecurity'						=> ($value['HasSecurity'] == 'true') ? 1 : 0,
        			'HasShoppingArea'					=> ($value['HasPhone'] == 'true') ? 1 : 0,
        			'HasShower'							=> ($value['HasShoppingArea'] == 'true') ? 1 : 0,
        			'HasStudio'							=> ($value['HasStudio'] == 'true') ? 1 : 0,
        			'HasSupermarket'					=> ($value['HasSupermarket'] == 'true') ? 1 : 0,
        			'HasTire'							=> ($value['HasTire'] == 'true') ? 1 : 0,
        			'HasTv'								=> ($value['HasTv'] == 'true') ? 1 : 0,
        			'HasVideoSurveillance'				=> ($value['HasVideoSurveillance'] == 'true') ? 1 : 0,
        			'HasWarehouse'						=> ($value['HasWarehouse'] == 'true') ? 1 : 0,
        			'HasWasher'							=> ($value['HasWasher'] == 'true') ? 1 : 0,
        			'HasWater'							=> ($value['HasWater'] == 'true') ? 1 : 0,
        			'HeatingType'						=> $value['Building']['HeatingType'],
        			'House'								=> $value['JKSchema']['House']['Name'],
        			'idcian'							=> 'error',
        			'idyandex'							=> 'error',
        			'id_user'							=> USERID,
        			'IncludedInPrice'					=> ($value['BargainTerms']['UtilitiesTerms']['IncludedInPrice'] == 'true') ? 1 : 0,
        			'IsApartments'						=> ($value['IsApartments'] == 'true') ? 1 : 0,
        			'IsComplete'						=> ($value['Building']['Deadline']['IsComplete'] == 'true') ? 1 : 0,
        			'IsLegalAddressProvided'			=> $value['IsLegalAddressProvided'],
        			'IsOccupied'						=> $value['IsOccupied'],
        			'IsPenthouse'						=> ($value['IsPenthouse'] == 'true') ? 1 : 0,
        			'KitchenArea'						=> $value['KitchenArea'],
        			'LandStatus'						=> ($value['Land']['Status']) ?: 'farm',
        			'LandType'							=> 'error',
        			'Layout'							=> $value['Layout'],
        			'leaseAssignment'					=> 'error',
        			'LeaseTermType'						=> ($value['BargainTerms']['LeaseTermType']) ?: 'longTerm',
        			'LeaseType'							=> $value['BargainTerms']['LeaseType'],
        			'LivingArea'						=> $value['LivingArea'],
        			'LoggiasCount'						=> $value['LoggiasCount'],
        			'ManagementCompany'					=> $value['Building']['ManagementCompany'],
        			'MaterialType'						=> $value['Building']['MaterialType'],
        			'MinArea'							=> $value['MinArea'],
        			'MinLeaseTerm'						=> $value['BargainTerms']['MinLeaseTerm'],
        			'MortgageAllowed'					=> ($value['BargainTerms']['MortgageAllowed'] == 'true') ? 1 : 0,
        			'Name'								=> $value['Building']['Name'],
        			'name'								=> $value['Title'],
        			//'Number'							=> preg_replace('~.*(\d{3})[^\d]*(\d{3})[^\d]*(\d{2})[^\d]*(\d{2}).*~', '$1 $2-$3-$4', $value['Phones']['PhoneSchema'][0]['Number']),
        			'Number'							=> $value['Phones']['PhoneSchema']['Number'],
        			'operationalCosts'					=> 'error',
        			'page'								=> 'error',
        			'Parking'							=> $value['Building']['Parking']['Type'],
        			'PassengerLiftsCount'				=> $value['Building']['PassengerLiftsCount'],
        			'PaymentPeriod'						=> ($value['BargainTerms']['PaymentPeriod']) ?: 'monthly',
        			'PaymentType'						=> ($value['BargainTerms']['AgentBonus']['PaymentType']) ?: '0',
        			'PermittedUseType'					=> $value['PermittedUseType'],
        			'PetsAllowed'						=> ($value['PetsAllowed'] == 'true') ? 1 : 0,
        			'PlacesCount'						=> $value['Building']['Parking']['PlacesCount'],
        			'Power'								=> $value['Electricity']['Power'],
        			'premium'							=> 'error',
        			'PrepayMonths'						=> ($value['BargainTerms']['PrepayMonths']) ?: '1',
        			'price'								=> $value['BargainTerms']['Price'],
        			'PriceMonthly'						=> $value['Building']['Parking']['PriceMonthly'],
        			'ProjectDeclarationUrl'				=> $value['ProjectDeclarationUrl'],
        			'Quarter'							=> $value['Building']['Deadline']['Quarter'],
        			'RepairType'						=> $value['RepairType'],
        			'RoomArea'							=> $value['RoomArea'],
        			'RoomsCount'						=> $value['RoomsCount'],
        			'RoomsForSaleCount'					=> $value['RoomsForSaleCount'],
        			'RoomType'							=> $value['RoomType'],
        			'SaleType'							=> ($value['BargainTerms']['SaleType']) ?: 'free',
        			'SecurityDeposit'					=> $value['BargainTerms']['SecurityDeposit'],
        			'SeparateWcsCount'					=> $value['SeparateWcsCount'],
        			'Series'							=> $value['Building']['Series'],
        			'SettlementName'					=> $value['SettlementName'],
        			'status'							=> 1,
        			'StatusType'						=> $value['Building']['StatusType'],
        			'TaxNumber'							=> $value['TaxNumber'],
        			'TenantsType'						=> $value['BargainTerms']['TenantsType'],
        			'time'								=> time(),
        			'timeupdate'						=> time(),
        			'TotalArea'							=> $value['TotalArea'],
        			'Type'								=> $value['Building']['Type'] ?: $value['Building']['Parking']['Type'],
        			'Url'								=> $value['Videos']['VideoSchema'][0]['Url'],
        			'utilityCharges'					=> 'error',
        			'VatType'							=> $value['BargainTerms']['VatType'],
        			'VentilationType'					=> $value['Building']['VentilationType'],
        			'Water'								=> $value['Water']['LocationType'],
        			'WaterPipesCount'					=> $value['WaterPipesCount'],
        			'WcLocationType'					=> $value['WcLocationType'],
        			'WindowsViewType'					=> $value['WindowsViewType'],
        			'yandexfield'						=> $yandexfield,
        			'yandex'							=> 'error',
        			'yandexpremium'						=> 'error',
        			'yandexpromotion'					=> 'error',
        			'yandexraise'						=> 'error',
        			'Year'								=> $value['Building']['Deadline']['Year']
    			];
			}, $array['object']);
				        	
        	foreach ($array['object'] as $innerRow => $value) {
				
				//запрашиваем колонки нужной таблицы
				$name_field = [];
				$Result = JBase::Get_Nodomain('list_field', 'name_field', ['table_field' => 'list'.$array['object'][$innerRow]['list']]);
				if (!empty($Result)) {
					while( $items = $Result->fetch_assoc() ) {
						$name_field[$items['name_field']] = $items;
					}
					unset($name_field['id']);
					$name_field['domain'] = DOMAIN;
        		} 
        		
        		//счетчики
        		$lAll++; 
        		$arrs[$innerRow] = $array['object'][$innerRow]['arr'];
        		unset($array['object'][$innerRow]['arr']);
        		
        		
        		//return $array['object'][$innerRow]['galleryfield']; ///////tmp
        		
        		//удаляем list	
				$list = $array['object'][$innerRow]['list'];
				unset($array['object'][$innerRow]['list']);
				
				//перебираем на совпадение в обоих массивах
				foreach (array_keys($name_field) as $key) {
					$name_field[$key] = $array['object'][$innerRow][$key];
					if ($name_field[$key] == 'error') unset($name_field[$key]);
				}
				
				$arrayNew = array_filter($name_field, 'strlen');
				
				//записываем в бд
				$columns = '`' . implode("`, `",array_keys($arrayNew)) . '`';
				$values  = "'" . implode("', '", array_values($arrayNew)) . "'";
				JBase::Query("INSERT INTO `list$list` ($columns) VALUES ($values)");
        	}


			foreach ($arrs as $key => $subArray) {
				foreach ($subArray as $id => $value) {
					$cou['result'][$key] = $id;
				}
			}
			
 			$cou['counts'] = array_count_values($cou['result']);
			$cou['counts']['Всего импортировано'] = $lAll;
			
			//удаляем result
			unset($cou['result']);
						
			return $cou;
		} else {
    		return 'Не удалось открыть файл или недостаточно прав';
		}
	}
	
	//xml импорт - изображения
	function getGallery($list, $image) {	
		$BaseValue = [];
		for($i = 0; $i < count($image); $i++) {
			//$path_parts = self::addPhoto($image[$i]['FullUrl'], $list);
			$path_parts = CDN::curl(['data' => $image[$i]['FullUrl'], 'type' => 'link'])
			$BaseValue[$path_parts['filename']]['img'] = $path_parts['basename'];
		}
		$galleryfield = json_encode($BaseValue);
		return $galleryfield;			
	}
	
   //xml импорт - добавление изображений
// 	function addPhoto($imgurl, $list) {
// 		//загружаем и инициализируем интерфейсы
// 		include_once  $_SERVER["DOCUMENT_ROOT"].'/lib.php';
// 		load_interface( 'settings' );
// 		$dbsettings = &$GLOBALS['cotfw.settings'];
// 		$sftp = new LocalConnection();
// 
// 		$data_url = base64_encode(file_get_contents($imgurl));
// 		$img = null;
// 		$img_name = null;
// 
// 		if (!empty($data_url)) {				
// 			$data = base64_decode($data_url);
// 			$img = tempnam(sys_get_temp_dir(), 'php');
// 				
// 			if(is_writable($img)) {
// 				file_put_contents($img, $data);
// 				$img_name = 'dataurl.jpg';
// 			} else {
// 				$img = null;
// 			}
// 
// 			if ($img && is_readable($img)) {        		
// 				$error = false;
// 
// 				try {
// 					$max_size = 960;
// 					$imagick = new \Imagick($img);
// 
// 					if ($imagick->getImageWidth() > $max_size || $imagick->getImageHeight() > $max_size) {
// 						$imagick->scaleImage($max_size, $max_size, true);
// 					}
// 
// 					$imagick->setImageBackgroundColor('#ffffff');
// 					$imagick = $imagick->flattenImages();
// 					$imagick->setImageFormat('jpg');
// 					$imagick->setImageCompressionQuality(95);
// 					$imagick->writeImage($img);
// 					$imagick->clear();
// 					$imagick->destroy();
// 					
// 				} catch(\ImagickException $e) {
// 					$error = true;
// 				}
// 
// 				if(!$error) {
// 					return CDN::curl(['data' => $_FILES['img']['tmp_name'], 'type' => 'link']); 
// 					$destination_path = DOMAIN .'/card/'. $list . DS . $img_name;
// 					//$destination_path = self::dynamic_path();
// 										
// 					//!!!!!!!!!нужно сделать проверку на доступность файла
// 					$watermark 	= ($dbsettings->val( 'watermark' )) ?: false;
// 					if ( $watermark ) {
// 						$image = imagecreatefromjpeg($img);
// 						$logoImage = imagecreatefrompng($watermark);
// 						$imageWidth = imagesx($image);
// 						$imageHeight = imagesy($image);
// 						$logoWidth = imagesx($logoImage);
// 						$logoHeight = imagesy($logoImage);
// 
// 						imagecopy(
// 							$image,
// 							$logoImage,
// 							$imageWidth-$logoWidth, 
// 							$imageHeight-$logoHeight,
// 							0, 0,
// 							$logoWidth, $logoHeight
// 						);
// 
// 						//делаем фиктивное имя якобы загруженного файла
// 						imagejpeg($image, 'imgandwatermark.jpeg');
// 						return $sftp->SendFile('imgandwatermark.jpeg', $destination_path, ['jpg','jpeg','png','JPG','JPEG','PNG']);
// 					} else {
// 						return $sftp->SendFile($img, $destination_path, ['jpg','jpeg','png','JPG','JPEG','PNG']);
// 					}
// 				} else return $error;
// 			} else return 'no is_readable';
// 		} else return 'no file_get_contents';
// 	}
	
	//xml импорт - dynamic_path
// 	function dynamic_path() {
// 		$fullPath = round(microtime(true) * 1000);
// 		$dirPath = substr($fullPath, 2, -5);
// 		//1000 файлов в секунду, 10000 файлов в папке
// 		$fileName = substr($fullPath, -5);
// 		//2 = 100 папок в папке
// 		//3 = 1000 папок в папке
// 		$dir = implode('/', str_split($dirPath, 2));
// 		return '5'. $dir .'/'. $fileName;
// 	}
}
