<?php 
namespace lib;

if (!defined('VOCU_FWK')) die(); // не работает без нашего фреймверка

/**
* class.Yandex.php
*
*Класс - генератор фидов realty.yandex.ru
*подгружается через автоподгрузку классов
*
* История:  2018.05.11 - файл создан
*
**/


class Yandex {
    
    public function get_markers() {
    	
		$markers = [];
		$list = (int)$_POST['list'];		
		$Result = JBase::Get_Data('list'. $list, ['id', 'yandexfield', 'price', 'galleryfield'], ['status' => '1']);
		if($Result) {
			while ($numrow = $Result->fetch_row()) {
				$str 		= $numrow[3];
				$img 		= current(json_decode($str, true))['img'];
				$million 	= $numrow[2];
				$ycoradr 	= json_decode($numrow[1])->{'ycoradr'};
				if($ycoradr){
					$marker 										= &$markers['features'][];
					$marker['type']									= 'Feature';
					$marker['id']			    					= (int)$numrow[0];
					$crds 											= explode(',', $ycoradr->{'coords'});
					$marker['geometry']['coordinates'] 				= [(float)$crds[0], (float)$crds[1]];
					$marker['properties']['balloonContent'] 		= '<div class="yandexpopup"><img src="/cdn/'.DOMAIN.'/card/' . $list . '/' . $img . '" alt=""><span>' . $ycoradr->{'address'} . '</span><i><u>₽</u>' . number_format($million, 0, '', ' ') . '</i><a target="_blank" href="/card?'.$list.'-'.(int)$numrow[0].'">Подробнее</a></div>';
					$marker['geometry']['type'] 					= "Point";
					//$marker['price']			    				= $numrow['price'];
					//$marker['properties']['balloonContentHeader']	= $numrow[3];
					$marker['properties']['balloonContentHeader']	= 'Объект ' . $list . '-' . $numrow[0];
					$marker['photo']								= $img;
				}
			}
			if($markers)
				$markers["type"] = "FeatureCollection";
			return $markers;
		}
	}

	function createfeed( $data ) {
		//$data = [user, domain]
		
		$dir = ($data[0] == 'all') ? '/ay' : '/uy';
		$user = ($data[0] == 'all') ? '' : "AND `id_user` = '". $data[0] ."'";
		$domain = $data[1];

		$time = new \DateTime('NOW');
		$rss = new \SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><realty-feed xmlns="http://webmaster.yandex.ru/schemas/feed/realty/2010-06"><generation-date>'.$time->format(\DateTime::ATOM).'</generation-date></realty-feed>');
		
		//запрашиваем актуальные каталоги
		$categorycian = JBase::Get_Field_Value_From_Domain_Name('templates', 'categoryyandex', $domain);
		$category = explode('_', $categorycian);
		foreach ( $category as $list ) {
			self::rss( $list, $rss, $domain, $user );
		}
		$rss->asXML('/var/www/realt/cdn/xml'. $dir .'/'. md5('yandex'. $data[0] . $domain) .'.xml');	
	}
	
    function rss( $list, $rss, $domain, $user ) {
        $results = JBase::Query("SELECT * FROM `list". $list ."` WHERE `domain` = '". $domain ."' ". $user ." AND `status` = '1' AND `yandex` = '1'");	
        
        if( $results ) { 
		    while( $row = $results->fetch_object() ) {
	    
                $item 				= $rss->addChild('offer');
                //$payedadv	 		= $item->addAttribute('manually-added', '1');
                //$manually	 		= $item->addAttribute('manually-added', '1');
                $internalid 		= $item->addAttribute('internal-id', $row->id);
                $description 		= html_entity_decode($row->Description, ENT_XML1);
                $description 		= $item->addChild('description', str_replace('&', ' ', $description));
                
                if (isset($row->CadastralNumber)) $cadastralnumber 	= $item->addChild('cadastral-number', $row->CadastralNumber);
                $creationdate 		= $item->addChild('creation-date', date(DATE_ATOM, $row->time));
                $lastupdatedate 	= $item->addChild('last-update-date', date(DATE_ATOM, $row->timeupdate));
                $url				= $item->addChild('url', 'https://' . $domain . '/card?' . $list . '-' . $row->id);
                
                
		        if ($row->yandexraise == '1') $vas = $item->addChild('vas', 'raise');
		        if ($row->yandexpremium == '1') $vas = $item->addChild('vas', 'premium');
		        if ($row->yandexpromotion == '1') $vas = $item->addChild('vas', 'promotion');

                //Информация о продавце или арендодателе
                $salesagent 		= $item->addChild('sales-agent');
                $Agency 			= $salesagent->addChild('category', 'agency');
                $Agencyurl 			= $salesagent->addChild('url', 'https://' . $row->domain);
                $FirstName 			= $salesagent->addChild('name', $row->FirstName);
                $Number 			= $salesagent->addChild('phone', str_replace('-', '',str_replace(' ', '', $row->CountryCode . $row->Number)));

                //Информация об условиях сделки
                $price 				= $item->addChild('price');
                $Pricevalue 		= $price->addChild('value', $row->price);
                $Currency 			= $price->addChild('currency', 'RUR'); //рублей(всегда)

                //адрес
                $yandexfield 		= json_decode( $row->yandexfield, true );
                if( $yandexfield !== false ) {
                    $location 			= $item->addChild('location');
                    if ( isset($yandexfield['kinds']) ) {
                        if ( isset($yandexfield['kinds']['country'])) 	$country 			=  		$location->addChild('country', $yandexfield['kinds']['country']);
                        if ( isset($yandexfield['kinds']['province'])) 	$region 			=  		$location->addChild('region', $yandexfield['kinds']['province']);
                        if ( isset($yandexfield['kinds']['locality'])) 	$localityname 		=  		$location->addChild('locality-name', $yandexfield['kinds']['locality']);
                        if ( isset($yandexfield['ycoradr']['raion'])) 	$sublocalityname 	=  		$location->addChild('sub-locality-name', $yandexfield['ycoradr']['raion']);

                        $district = (isset( $yandexfield['kinds']['area'] ) ? $yandexfield['kinds']['area'] : '');
                        if ( $district != '' ) $location->addChild('district', $district);

                        $street = (isset( $yandexfield['kinds']['street'] ) ? $yandexfield['kinds']['street'] : '');
                        $house = (isset( $yandexfield['kinds']['house'] ) ? $yandexfield['kinds']['house'] : '');
                        if ( $street != '' ) $location->addChild('address', $street. ', ' .$house);

                    }

                    list( $lat, $lng ) 	= explode( ',', $yandexfield['ycoradr']['coords'] );
                    $latitude 			= $location->addChild('latitude', floatval( $lat ));
                    $longitude 			= $location->addChild('longitude', floatval( $lng ));

                    if ( isset($yandexfield['metro']['metroName']) && isset($yandexfield['metro']['distance']) ) {
                        $metro 				= $location->addChild('metro');
                        $name 				= $metro->addChild('name', $yandexfield['metro']['metroName']);
                        $distance 			= preg_replace('/[^0-9]/', '', $yandexfield['metro']['distance']);
                        $timeontransport 	= $metro->addChild('time-on-transport',  ceil((int)$distance / 400) );
                        $timeonfoot 		= $metro->addChild('time-on-foot', ceil((int)$distance / 100) );
                    }
                }

                //площадь 
                switch( $list ) {    
                    case '1': //продажа квартир
                    case '2': //продажа комнат
                    case '3': //продажа загородной
                    case '9': //аренда квартир
                    case '11': //аренда комнат
                    case '12': //аренда загородной	
                    case '8': //продажа новостроек	
                        if (isset($row->TotalArea)) $area = $item->addChild('area');
                        if (isset($row->TotalArea)) $unitarea = $area->addChild('unit', 'кв. м');
                        if (isset($row->TotalArea)) $TotalArea = $area->addChild('value', $row->TotalArea);	

                        if (isset($row->LivingArea)) $livingspace = $item->addChild('living-space');
                        if (isset($row->LivingArea)) $unitliving = $livingspace->addChild('unit', 'кв. м');
                        if (isset($row->LivingArea)) $LivingArea = $livingspace->addChild('value', $row->LivingArea);

                        if (isset($row->KitchenArea)) $kitchenspace = $item->addChild('kitchen-space');
                        if (isset($row->KitchenArea)) $unitkitchen = $kitchenspace->addChild('unit', 'кв. м');
                        if (isset($row->KitchenArea)) $KitchenArea = $kitchenspace->addChild('value', $row->KitchenArea);
                        break;
                    case '4': //продажа участков
                        if ($row->Area) $area 				= $item->addChild('lot-area');
                        if ($row->Area) $unitarea			= $area->addChild('unit', 'сотка');	
                        if ($row->Area) $TotalArea 			= $area->addChild('value', $row->Area);
                        if ($row->LandStatus == 'individualHousingConstruction') $lottype = $item->addChild('lot-type', 'ИЖС');
                        if ($row->LandStatus == 'gardening') $lottype = $item->addChild('lot-type', 'садоводство');
                        break;
                    case '10': //продажа коммерческой земли	
                    case '13': //аренда коммерческой земли	
                        if (isset($row->TotalArea)) $area 				= $item->addChild('lot-area');
                        if (isset($row->TotalArea)) $unitarea			= $area->addChild('unit', 'сотка');	
                        if (isset($row->TotalArea)) $TotalArea 		= $area->addChild('value', $row->TotalArea);
                        break;
                    case '5': //продажа гаражей
                    case '6': //продажа коммерческой
                    case '14': //аренда гаражей	
                    case '15': //аренда коммерческой	
                        if (isset($row->TotalArea)) $area 				= $item->addChild('area');
                        if (isset($row->TotalArea)) $unitarea			= $area->addChild('unit', 'кв. м');	
                        if (isset($row->TotalArea)) $TotalArea 		= $area->addChild('value', $row->TotalArea);	
                        break;
                }

                //категории
                if ( $list == '3' || $list == '6' || $list == '12' || $list == '15' )
                switch( $row->Category ) {
                    case 'houseSale': //Дом/Дача
                    case 'houseRent': //Дом/Дача
                        if ($row->Area > 0) {
                            $Category 	= 'дом с участком';
                        } else { $Category 	= 'дом'; }
                        break;
                    case 'cottageSale': //Коттедж
                    case 'cottageRent': //Коттедж
                        $Category 	= 'коттедж';	
                        break;
                    case 'townhouseSale': //Таунхаус
                    case 'townhouseRent': //Таунхаус
                        $Category 	= 'таунхаус';	
                        break;	
                    case 'buildingSale': //Здание
                    case 'buildingRent': //Здание
                    case 'businessSale': //Готовый бизнес
                    case 'businessRent': //Готовый бизнес
                        $Category 	= 'business';	
                        break;
                    case 'shoppingAreaSale': //Торговая площадь
                    case 'shoppingAreaRent': //Торговая площадь
                        $Category 	= 'retail';	
                        break;
                    case 'warehouseSale': //Склад
                    case 'warehouseRent': //Склад
                        $Category 	= 'warehouse';	
                        break;
                    case 'industrySale': //Производство
                    case 'industryRent': //Производство
                        $Category 	= 'manufacturing';	
                        break;
                    case 'officeSale': //Офис
                    case 'officeRent': //Офис
                        $Category 	= 'office';	
                        break;
                    case 'freeAppointmentObjectSale': //Помещение свободного назначения
                    case 'freeAppointmentObjectRent': //Помещение свободного назначения
                        $Category 	= 'free purpose';	
                        break;	
                }	

                //тип гаража    
                if ( $list == '5' || $list == '14' )      
                switch( $row->GarageType ) {
                    case 'box': //бокс
                        $garagetype 	= 'box';	
                        break;
                    case 'garage': //гараж
                        $garagetype 	= 'garage';	
                        break;
                    case 'parkingPlace': //машиноместо
                        $garagetype 	= 'parking place';	
                        break;	
                }	

                //ремонт коммерческая  
                if ( $list == '6' || $list == '15' )      
                switch( $row->ConditionType ) {
                    case 'office': //Офисная отделка
                        $ConditionType 	= 'с отделкой';	
                        break;
                    case 'typical': //Типовой
                        $ConditionType 	= 'хороший';	
                        break;
                    case 'design': //Дизайнерский
                        $ConditionType 	= 'дизайнерский';	
                        break;
                    case 'finishing': //Под чистовую отделку
                        $ConditionType 	= 'черновая отделка';	
                        break;
                    case 'majorRepairsRequired': //Требуется капитальный ремонт
                        $ConditionType 	= 'требует ремонта';	
                        break;
                    case 'cosmeticRepairsRequired': //Требуется косметический ремонт
                        $ConditionType 	= 'частичный ремонт';	
                        break;
                }	

                //ремонт жилая 
                if (isset($row->RepairType)) $Repair = $row->RepairType;
                switch( $Repair ) {
                    case 'cosmetic': //с отделкой
                        $RepairType = 'с отделкой';	
                        break;
                    case 'euro': //евро
                        $RepairType = 'евро';	
                        break;
                    case 'design': //дизайнерский
                        $RepairType = 'дизайнерский';
                        break;
                    case 'no': //требует ремонта
                        $RepairType = 'требует ремонта';	
                        break;	
                }

                //основные	        
                switch( $list ) {    
                    case '1': //продажа квартир
                        $type 				= $item->addChild('type', 'продажа');	
                        $propertytype 		= $item->addChild('property-type', 'жилая');
                        $category 			= $item->addChild('category', 'квартира');
                        $IsApartments 		= $item->addChild('apartments', $row->IsApartments);
                        $FloorsCount 		= $item->addChild('floors-total', $row->FloorsCount);
                        $FloorNumber 		= $item->addChild('floor', $row->FloorNumber);
                        $dealstatus 		= $item->addChild('deal-status', 'прямая продажа');
                        $renovation			= $item->addChild('renovation', $RepairType);

                        if ( intval($row->FlatRoomsCount) < 7 ) $FlatRoomsCount	= $item->addChild('rooms', $row->FlatRoomsCount);	//Если не студия
                        if ( intval($row->FlatRoomsCount) == 7 ) $openplan		= $item->addChild('open-plan', '1');				//Свободная планировка
                        if ( intval($row->FlatRoomsCount) == 9 ) $studio 		= $item->addChild('studio', '1');					//Если студия

                        if ( $row->WindowsViewType == 'yard' ) $WindowsViewType		= $item->addChild('window-view', 'во двор');
                        if ( $row->WindowsViewType == 'street' ) $WindowsViewType	= $item->addChild('window-view', 'на улицу');
                        if ( $row->HasPhone != '' )  $HasPhone = $item->addChild('phone', $row->HasPhone);

                        //о доме
                        $JKName				= $item->addChild('building-name', $row->Name);
                        if ( $row->BuildYear ) $builtyear = $item->addChild('built-year', $row->BuildYear);

    //  	        		if ( $row->Quarter == 'first' ) $readyquarter	= $item->addChild('ready-quarter', '1');
    //  	        		if ( $row->Quarter == 'second' ) $readyquarter	= $item->addChild('ready-quarter', '2');
    //  	        		if ( $row->Quarter == 'third' ) $readyquarter	= $item->addChild('ready-quarter', '3');
    //  	        		if ( $row->Quarter == 'fourth' ) $readyquarter	= $item->addChild('ready-quarter', '4');

                        if ( $row->MaterialType == 'brick' ) $buildingtype		= $item->addChild('building-type', 'кирпичный');
                        if ( $row->MaterialType == 'monolith' ) $buildingtype	= $item->addChild('building-type', 'монолит');
                        if ( $row->MaterialType == 'panel' ) $buildingtype		= $item->addChild('building-type', 'панельный');

                        //$buildingsection	= $item->addChild('building-section', $row->House);
                        if ( $row->CeilingHeight ) $ceilingheight = $item->addChild('ceiling-height', $row->CeilingHeight);	

                        $Mortgage		 	= $item->addChild('mortgage', $row->MortgageAllowed);	//ипотека


                        break;
                    case '2': //продажа комнат
                        $type 				= $item->addChild('type', 'продажа');	
                        $propertytype 		= $item->addChild('property-type', 'жилая');
                        $category 			= $item->addChild('category', 'комната');
                        $roomspace 			= $item->addChild('room-space');
                        $unitroom			= $roomspace->addChild('unit', 'кв. м');
                        $RoomArea 			= $roomspace->addChild('value', $row->RoomArea);
                        $FloorsCount 		= $item->addChild('floors-total', $row->FloorsCount);
                        $FloorNumber 		= $item->addChild('floor', $row->FloorNumber);
                        $dealstatus 		= $item->addChild('deal-status', 'прямая продажа');
                        $renovation			= $item->addChild('renovation', $RepairType);
                        $RoomsForSaleCount 	= $item->addChild('rooms-offered', $row->RoomsForSaleCount);

                        if ( $row->RoomType == 'combined' ) $roomstype = $item->addChild('rooms-type', 'смежные');
                        if ( $row->RoomType == 'separate' ) $roomstype = $item->addChild('rooms-type', 'раздельные');
                        if ( $row->HasPhone != '' )  $HasPhone = $item->addChild('phone', $row->HasPhone);

                        //о доме
                        $JKName				= $item->addChild('building-name', $row->Name);
                        if ( $row->BuildYear ) $builtyear = $item->addChild('built-year', $row->BuildYear);

    //  	        		if ( $row->Quarter == 'first' ) $readyquarter	= $item->addChild('ready-quarter', '1');
    //  	        		if ( $row->Quarter == 'second' ) $readyquarter	= $item->addChild('ready-quarter', '2');
    //  	        		if ( $row->Quarter == 'third' ) $readyquarter	= $item->addChild('ready-quarter', '3');
    //  	        		if ( $row->Quarter == 'fourth' ) $readyquarter	= $item->addChild('ready-quarter', '4');

                        if ( $row->MaterialType == 'brick' ) $buildingtype		= $item->addChild('building-type', 'кирпичный');
                        if ( $row->MaterialType == 'monolith' ) $buildingtype	= $item->addChild('building-type', 'монолит');
                        if ( $row->MaterialType == 'panel' ) $buildingtype		= $item->addChild('building-type', 'панельный');

                        //$buildingsection	= $item->addChild('building-section', $row->House);
                        if ( $row->CeilingHeight ) $ceilingheight = $item->addChild('ceiling-height', $row->CeilingHeight);	

                        $Mortgage		 	= $item->addChild('mortgage', $row->MortgageAllowed);	//ипотека

                        break;
                    case '3': //продажа загородной
                        $type 				= $item->addChild('type', 'продажа');	
                        $propertytype 		= $item->addChild('property-type', 'жилая');
                        $Category 			= $item->addChild('category', $Category);
                        $dealstatus 		= $item->addChild('deal-status', 'прямая продажа');
                        if ( $row->HasPhone != '' )  $HasPhone = $item->addChild('phone', $row->HasPhone);	
                        
                        if (isset($row->Area) && $row->Area > 0) $area 				= $item->addChild('lot-area');
                        if (isset($row->Area) && $row->Area > 0) $TotalArea 		= $area->addChild('value', $row->Area);
                        if (isset($row->Area) && $row->Area > 0) $unitarea			= $area->addChild('unit', 'сотка');	

                        $Mortgage		 	= $item->addChild('mortgage', $row->MortgageAllowed);	//ипотека
                        break;
                    case '4': //продажа участков
                        $type 				= $item->addChild('type', 'продажа');
                        $propertytype 		= $item->addChild('property-type', 'жилая');
                        $category 			= $item->addChild('category', 'участок');
                        $dealstatus 		= $item->addChild('deal-status', 'прямая продажа');	
                        break;
                    case '5': //продажа гаражей
                        $type 				= $item->addChild('type', 'продажа');
                        $propertytype 		= $item->addChild('property-type', 'жилая');
                        $category 			= $item->addChild('category', 'гараж');	
                        $garagetype 		= $item->addChild('garage-type', $garagetype);	
                        $dealstatus 		= $item->addChild('deal-status', 'прямая продажа');
                        $garagename 		= $item->addChild('garage-name', $row->Name);
                        $security	 		= $item->addChild('security', $row->HasSecurity);

                        if ( $row->GarageStatus == 'cooperative' ) $ownershiptype 	= $item->addChild('ownership-type', 'cooperative');
                        if ( $row->GarageStatus == 'ownership' ) $ownershiptype 	= $item->addChild('ownership-type', 'private');
                        if ( $row->GarageStatus == 'byProxy' ) $ownershiptype 		= $item->addChild('ownership-type', 'by proxy');
                        if ( $row->Type != 'roof' ) $parkingtype 					= $item->addChild('parking-type', $row->Type);

                        $heatingsupply	 	= $item->addChild('heating-supply', $row->HasHeating);
                        $firealarm	 		= $item->addChild('fire-alarm', $row->HasExtinguishingSystem);
                        $electricitysupply	= $item->addChild('electricity-supply', $row->HasElectricity);
                        $watersupply	 	= $item->addChild('water-supply', $row->HasWater);
                        $automaticgates	 	= $item->addChild('automatic-gates', $row->HasAutomaticGates);
                        $inspectionpit	 	= $item->addChild('inspection-pit', $row->HasInspectionPit);
                        $cctv	 			= $item->addChild('cctv', $row->HasVideoSurveillance);
                        $cellar	 			= $item->addChild('cellar', $row->HasBasement);
                        $carwash	 		= $item->addChild('car-wash', $row->HasCarWash);
                        $accesscontrol	 	= $item->addChild('access-control-system', $row->HasEntryByPass);
                        $autorepair		 	= $item->addChild('auto-repair', $row->HasCarService);
                        break;
                    case '6': //продажа коммерческой
                        $type 				= $item->addChild('type', 'продажа');
                        $category 			= $item->addChild('category', 'коммерческая');
                        $commercialtype 	= $item->addChild('commercial-type', $Category );
                        if ( $row->FloorsCount ) $FloorsCount 		= $item->addChild('floors-total', $row->FloorsCount);
                        $FloorNumber 		= $item->addChild('floor', $row->FloorNumber);
                        $renovation			= $item->addChild('renovation', $ConditionType);
                        $JKName				= $item->addChild('building-name', $row->Name);	
                        if ( $row->FurniturePresence ) $FurniturePresence 	= $item->addChild('room-furniture', $row->FurniturePresence);	

                        if ( $row->ExtinguishingSystemType &&  $row->ExtinguishingSystemType != 'no' ) $Power 	= $item->addChild('fire-alarm', '1');
                        if ( $row->ConditioningType &&  $row->ConditioningType != 'no' ) $Power 				= $item->addChild('air-conditioner', '1');
                        if ( $row->VentilationType &&  $row->VentilationType != 'no' ) $Power 					= $item->addChild('ventilation', '1');
                        if ( $row->HeatingType &&  $row->HeatingType != 'no' ) $Power 							= $item->addChild('heating-supply', '1');

                        if ( $row->ClassType == 'a' ) $ClassType 		= $item->addChild('office-class', 'A');
                        if ( $row->ClassType == 'aPlus' ) $ClassType 	= $item->addChild('office-class', 'A+');
                        if ( $row->ClassType == 'b' ) $ClassType 		= $item->addChild('office-class', 'B');
                        if ( $row->ClassType == 'bPlus' ) $ClassType 	= $item->addChild('office-class', 'B+');
                        if ( $row->ClassType == 'c' ) $ClassType 		= $item->addChild('office-class', 'C');


                        if ( $row->CeilingHeight ) $CeilingHeight = $item->addChild('ceiling-height', $row->CeilingHeight);
                        if ( $row->AccessType == 'passSystem' ) $CeilingHeight = $item->addChild('access-control-system', '1');

                        if ( $row->Parking && $row->PlacesCount ) {
                            $Parking 		= $item->addChild('parking', '1');
                            $PlacesCount 	= $item->addChild('parking-places', $row->PlacesCount);
                            if ( $row->PriceMonthly != '' ) $PriceMonthly 	= $item->addChild('parking-place-price', $row->PriceMonthly);
                        }

                        if ( $row->Power ) $Power = $item->addChild('electric-capacity', $row->Power);
                        $eatingfacilities 	= $item->addChild('eating-facilities', $row->HasCanteen); //столовая
                        break;
                    case '8': //продажа новостроек	
                        $type 				= $item->addChild('type', 'продажа');	
                        $propertytype 		= $item->addChild('property-type', 'жилая');
                        $category 			= $item->addChild('category', 'квартира');
                        $newflat 			= $item->addChild('new-flat', '1');	
                        $IsApartments 		= $item->addChild('apartments', $row->IsApartments);
                        $FloorsCount 		= $item->addChild('floors-total', $row->FloorsCount);
                        $FloorNumber 		= $item->addChild('floor', $row->FloorNumber);
                        $dealstatus 		= $item->addChild('deal-status', 'первичная продажа');
                        $renovation			= $item->addChild('renovation', $RepairType);	

                        $Mortgage		 	= $item->addChild('mortgage', $row->MortgageAllowed);	//ипотека

                        if ( $row->WindowsViewType == 'yard' ) $WindowsViewType		= $item->addChild('window-view', 'во двор');
                        if ( $row->WindowsViewType == 'street' ) $WindowsViewType	= $item->addChild('window-view', 'на улицу');

                        if ( intval($row->FlatRoomsCount) < 7 ) $FlatRoomsCount	= $item->addChild('rooms', $row->FlatRoomsCount);	//Если не студия
                        if ( intval($row->FlatRoomsCount) == 7 ) $openplan		= $item->addChild('open-plan', '1');	//Свободная планировка
                        if ( intval($row->FlatRoomsCount) == 9 ) $studio 		= $item->addChild('studio', '1');				//Если студия

                        //о доме
                        $JKName				= $item->addChild('building-name', $row->Name);
                        //$yandexbuildingid	= $item->addChild('yandex-building-id', '');	//не настроен поиск в базе при добавлении объекта
                        if ( $row->IsComplete == '1' ) $buildingstate	= $item->addChild('building-state', 'hand-over');
                        if ( $row->IsComplete != '1' ) $buildingstate	= $item->addChild('building-state', 'unfinished');
                        if ( $row->Year ) $builtyear = $item->addChild('built-year', $row->Year);

                        if ( $row->Quarter == 'first' ) $readyquarter	= $item->addChild('ready-quarter', '1');
                        if ( $row->Quarter == 'second' ) $readyquarter	= $item->addChild('ready-quarter', '2');
                        if ( $row->Quarter == 'third' ) $readyquarter	= $item->addChild('ready-quarter', '3');
                        if ( $row->Quarter == 'fourth' ) $readyquarter	= $item->addChild('ready-quarter', '4');

                        if ( $row->MaterialType == 'brick' ) $buildingtype		= $item->addChild('building-type', 'кирпичный');
                        if ( $row->MaterialType == 'monolith' ) $buildingtype	= $item->addChild('building-type', 'монолит');
                        if ( $row->MaterialType == 'panel' ) $buildingtype		= $item->addChild('building-type', 'панельный');

                        $buildingseries		= $item->addChild('building-series', $row->Series);
                        $buildingsection	= $item->addChild('building-section', $row->House);
                        if ( $row->CeilingHeight ) $ceilingheight = $item->addChild('ceiling-height', $row->CeilingHeight);
                        if ( $row->HasGarbageChute ) $rubbishchute = $item->addChild('rubbish-chute', $row->HasGarbageChute);

                        if ( $row->PassengerLiftsCount || $row->CargoLiftsCount ) $lift = $item->addChild('lift', '1');
                        if ( $row->Parking ) $parking = $item->addChild('parking', '1');
                        break;
                    case '10': //продажа коммерческой земли	
                        $type 				= $item->addChild('type', 'продажа');
                        $category 			= $item->addChild('category', 'коммерческая');
                        $commercialtype 	= $item->addChild('commercial-type', 'land');	

                        if ( $row->DrivewayType &&  $row->DrivewayType != 'no' ) $DrivewayType = $item->addChild('truck-entrance', '1');
                        if ( $row->Electricity &&  $row->Electricity != 'no' ) $DrivewayType = $item->addChild('electricity-supply', '1');
                        if ( $row->Drainage &&  $row->Drainage != 'no' ) $DrivewayType = $item->addChild('sewerage-supply', '1');
                        if ( $row->Water &&  $row->Water != 'no' ) $DrivewayType = $item->addChild('water-supply', '1');
                        if ( $row->Gas &&  $row->Gas != 'no' ) $DrivewayType = $item->addChild('gas-supply', '1');
                        break;
                    case '9': //аренда квартир
                        $type 				= $item->addChild('type', 'аренда');
                        $propertytype 		= $item->addChild('property-type', 'жилая');
                        $category 			= $item->addChild('category', 'квартира');
                        $IsApartments 		= $item->addChild('apartments', $row->IsApartments);
                        $FloorsCount 		= $item->addChild('floors-total', $row->FloorsCount);
                        $FloorNumber 		= $item->addChild('floor', $row->FloorNumber);
                        $period 			= $price->addChild('period', 'месяц');	
                        $AgentFee 			= $item->addChild('agent-fee', $row->AgentFee);	
                        $IncludedInPrice 	= $item->addChild('utilities-included', $row->IncludedInPrice);

                        if ( intval($row->Deposit) > 0 ) $rentpledge = $item->addChild('rent-pledge', 1);	
                        if ( intval($row->PrepayMonths) > 0 ) $PrepayMonths = $item->addChild('prepayment', '100');	//100% максимум
                        if ( intval($row->RoomsCount) < 7 ) $FlatRoomsCount	= $item->addChild('rooms', $row->FlatRoomsCount);	//Если не студия
                        if ( intval($row->FlatRoomsCount) == 7 ) $openplan	= $item->addChild('open-plan', '1');	//Свободная планировка
                        if ( intval($row->FlatRoomsCount) == 9 ) $studio = $item->addChild('studio', '1');				//Если студия

                        if ( $row->WindowsViewType == 'yard' ) $WindowsViewType	= $item->addChild('window-view', 'во двор');
                        if ( $row->WindowsViewType == 'street' ) $WindowsViewType	= $item->addChild('window-view', 'на улицу');
                        if ( $row->HasPhone != '' )  $HasPhone = $item->addChild('phone', $row->HasPhone);

                        //о доме
                        $JKName				= $item->addChild('building-name', $row->Name);
                        if ( $row->BuildYear ) $builtyear = $item->addChild('built-year', $row->BuildYear);

    //  	        		if ( $row->Quarter == 'first' ) $readyquarter	= $item->addChild('ready-quarter', '1');
    //  	        		if ( $row->Quarter == 'second' ) $readyquarter	= $item->addChild('ready-quarter', '2');
    //  	        		if ( $row->Quarter == 'third' ) $readyquarter	= $item->addChild('ready-quarter', '3');
    //  	        		if ( $row->Quarter == 'fourth' ) $readyquarter	= $item->addChild('ready-quarter', '4');

                        if ( $row->MaterialType == 'brick' ) $buildingtype	= $item->addChild('building-type', 'кирпичный');
                        if ( $row->MaterialType == 'monolith' ) $buildingtype	= $item->addChild('building-type', 'монолит');
                        if ( $row->MaterialType == 'panel' ) $buildingtype	= $item->addChild('building-type', 'панельный');

                        //$buildingsection	= $item->addChild('building-section', $row->House);
                        if ( $row->CeilingHeight ) $ceilingheight = $item->addChild('ceiling-height', $row->CeilingHeight);
                        break;
                    case '11': //аренда комнат
                        $type 				= $item->addChild('type', 'аренда');
                        $propertytype 		= $item->addChild('property-type', 'жилая');
                        $category 			= $item->addChild('category', 'комната');
                        $roomspace 			= $item->addChild('room-space');
                        $unitroom			= $roomspace->addChild('unit', 'кв. м');
                        $RoomArea 			= $roomspace->addChild('value', $row->RoomArea);
                        $FloorsCount 		= $item->addChild('floors-total', $row->FloorsCount);
                        $FloorNumber 		= $item->addChild('floor', $row->FloorNumber);
                        $period 			= $price->addChild('period', 'месяц');
                        $AgentFee 			= $item->addChild('agent-fee', $row->AgentFee);	
                        $IncludedInPrice 	= $item->addChild('utilities-included', $row->IncludedInPrice);	
                        $RoomsForSaleCount 	= $item->addChild('rooms-offered', $row->RoomsForSaleCount);
                        $RoomsCount 		= $item->addChild('rooms', $row->RoomsCount);	

                        if ( $row->RoomType == 'combined' ) $roomstype = $item->addChild('rooms-type', 'смежные');
                        if ( $row->RoomType == 'separate' ) $roomstype = $item->addChild('rooms-type', 'раздельные');

                        if ( intval($row->Deposit) > 0 ) $rentpledge = $item->addChild('rent-pledge', 1);	
                        if ( intval($row->PrepayMonths) > 0 ) $PrepayMonths = $item->addChild('prepayment', '100');	//100% максимум

                        if ( $row->WindowsViewType == 'yard' ) $WindowsViewType	= $item->addChild('window-view', 'во двор');
                        if ( $row->WindowsViewType == 'street' ) $WindowsViewType	= $item->addChild('window-view', 'на улицу');

                        if ( $row->HasPhone != '' )  $HasPhone = $item->addChild('phone', $row->HasPhone);

                        //о доме
                        $JKName				= $item->addChild('building-name', $row->Name);
                        if ( $row->BuildYear ) $builtyear = $item->addChild('built-year', $row->BuildYear);

    //  	        		if ( $row->Quarter == 'first' ) $readyquarter	= $item->addChild('ready-quarter', '1');
    //  	        		if ( $row->Quarter == 'second' ) $readyquarter	= $item->addChild('ready-quarter', '2');
    //  	        		if ( $row->Quarter == 'third' ) $readyquarter	= $item->addChild('ready-quarter', '3');
    //  	        		if ( $row->Quarter == 'fourth' ) $readyquarter	= $item->addChild('ready-quarter', '4');

                        if ( $row->MaterialType == 'brick' ) $buildingtype	= $item->addChild('building-type', 'кирпичный');
                        if ( $row->MaterialType == 'monolith' ) $buildingtype	= $item->addChild('building-type', 'монолит');
                        if ( $row->MaterialType == 'panel' ) $buildingtype	= $item->addChild('building-type', 'панельный');

                        //$buildingsection	= $item->addChild('building-section', $row->House);
                        if ( $row->CeilingHeight ) $ceilingheight = $item->addChild('ceiling-height', $row->CeilingHeight);	
                        break;
                    case '12': //аренда загородной	
                        $type 				= $item->addChild('type', 'аренда');
                        $propertytype 		= $item->addChild('property-type', 'жилая');
                        $Category 			= $item->addChild('category', $Category);
                        $period 			= $price->addChild('period', 'месяц');	
                        $AgentFee 			= $item->addChild('agent-fee', $row->AgentFee);	
                        $IncludedInPrice 	= $item->addChild('utilities-included', $row->IncludedInPrice);	
                        
                        if (isset($row->Area) && $row->Area > 0) $area 				= $item->addChild('lot-area');
                        if (isset($row->Area) && $row->Area > 0) $TotalArea 		= $area->addChild('value', $row->Area);
                        if (isset($row->Area) && $row->Area > 0) $unitarea			= $area->addChild('unit', 'сотка');	

                        if ( intval($row->Deposit) > 0 ) $rentpledge = $item->addChild('rent-pledge', 1);	
                        if ( intval($row->PrepayMonths) > 0 ) $PrepayMonths = $item->addChild('prepayment', '100');	//100% максимум
                        if ( $row->HasPhone != '' )  $HasPhone = $item->addChild('phone', $row->HasPhone);
                        break;
                    case '13': //аренда коммерческой земли
                        $type 				= $item->addChild('type', 'аренда');
                        $category 			= $item->addChild('category', 'коммерческая');
                        $commercialtype 	= $item->addChild('commercial-type', 'land');
                        $period 			= $price->addChild('period', 'месяц');	

                        if ( intval($row->PrepayMonths) > 0 ) $PrepayMonths = $item->addChild('prepayment', '100');	//100% максимум
                        if ( $row->utilityCharges == '1' ) $IncludedInPrice = $item->addChild('utilities-included', $row->utilityCharges);	//коммунальные платежи

                        if ( $row->DrivewayType &&  $row->DrivewayType != 'no' ) $DrivewayType = $item->addChild('truck-entrance', '1');
                        if ( $row->Electricity &&  $row->Electricity != 'no' ) $DrivewayType = $item->addChild('electricity-supply', '1');
                        if ( $row->Drainage &&  $row->Drainage != 'no' ) $DrivewayType = $item->addChild('sewerage-supply', '1');
                        if ( $row->Water &&  $row->Water != 'no' ) $DrivewayType = $item->addChild('water-supply', '1');
                        if ( $row->Gas &&  $row->Gas != 'no' ) $DrivewayType = $item->addChild('gas-supply', '1');
                        break;
                    case '14': //аренда гаражей	
                        $type 				= $item->addChild('type', 'аренда');
                        $propertytype 		= $item->addChild('property-type', 'жилая');
                        $category 			= $item->addChild('category', 'гараж');	
                        $garagetype 		= $item->addChild('garage-type', $garagetype);
                        $period 			= $price->addChild('period', 'месяц');	

                        if ( intval($row->PrepayMonths) > 0 ) $PrepayMonths = $item->addChild('prepayment', '100');	//100% максимум
                        if ( $row->utilityCharges == '1' ) $IncludedInPrice = $item->addChild('utilities-included', $row->utilityCharges);	//коммунальные платежи
                        break;
                    case '15': //аренда коммерческой
                        $type 				= $item->addChild('type', 'аренда');
                        $category 			= $item->addChild('category', 'коммерческая');
                        $commercialtype 	= $item->addChild('commercial-type', $Category );
                        if ( $row->FloorsCount ) $FloorsCount = $item->addChild('floors-total', $row->FloorsCount);	
                        $FloorNumber 		= $item->addChild('floor', $row->FloorNumber);
                        $period 			= $price->addChild('period', 'месяц');	
                        $dealstatus 		= $item->addChild('deal-status', 'direct rent');	//прямая аренда
                        $JKName				= $item->addChild('building-name', $row->Name);

                        if ( intval($row->SecurityDeposit) > 0 ) $rentpledge = $item->addChild('rent-pledge', 1);	
                        if ( intval($row->PrepayMonths) > 0 ) $PrepayMonths = $item->addChild('prepayment', '100');	//100% максимум
                        if ( $row->utilityCharges == '1' ) $IncludedInPrice = $item->addChild('utilities-included', $row->utilityCharges);	//коммунальные платежи
                        $renovation			= $item->addChild('renovation', $ConditionType);

                        if ( $row->ConditioningType &&  $row->ConditioningType != 'no' ) $Power = $item->addChild('air-conditioner', '1');
                        if ( $row->VentilationType &&  $row->VentilationType != 'no' ) $Power = $item->addChild('ventilation', '1');
                        if ( $row->ExtinguishingSystemType &&  $row->ExtinguishingSystemType != 'no' ) $Power = $item->addChild('fire-alarm', '1');
                        if ( $row->HeatingType &&  $row->HeatingType != 'no' ) $Power = $item->addChild('heating-supply', '1');

                        if ( $row->ClassType == 'a' ) $ClassType = $item->addChild('office-class', 'A');
                        if ( $row->ClassType == 'aPlus' ) $ClassType = $item->addChild('office-class', 'A+');
                        if ( $row->ClassType == 'b' ) $ClassType = $item->addChild('office-class', 'B');
                        if ( $row->ClassType == 'bPlus' ) $ClassType = $item->addChild('office-class', 'B+');
                        if ( $row->ClassType == 'c' ) $ClassType = $item->addChild('office-class', 'C');

                        if ( $row->CeilingHeight ) $CeilingHeight = $item->addChild('ceiling-height', $row->CeilingHeight);
                        if ( $row->AccessType == 'passSystem' ) $CeilingHeight = $item->addChild('access-control-system', '1');

                        if ( $row->Parking && $row->PlacesCount ) {
                            $Parking 		= $item->addChild('parking', '1');
                            $PlacesCount 	= $item->addChild('parking-places', $row->PlacesCount);
                            if ( $row->PriceMonthly != '' ) $PriceMonthly 	= $item->addChild('parking-place-price', $row->PriceMonthly);
                        }

                        if ( $row->Power ) $Power = $item->addChild('electric-capacity', $row->Power);
                        $eatingfacilities 	= $item->addChild('eating-facilities', $row->HasCanteen); //столовая
                        break;
                }

                //Фотографии
                $galleryfield 		= json_decode( $row->galleryfield, true );
                if( $galleryfield !== false ) {
                    foreach( $galleryfield as $key => $value ) {
                        $FullUrl 			= $item->addChild('image', 'https://' . $domain . '/cdn/' . $domain . '/card/' . $list . DS . $value['img']);
                    }
                }		
            }
			$results->free();
		}
	}
}
 

