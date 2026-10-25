<?
require_once(CLASSES_BASE.'model_icms_folder.php');
class model_icms_folder_company extends model_icms_folder{

var $name_profil = 'ѕрофиль';
var $name_contact = ' онтактные данные';
var $name_novelty = 'Ќовинки';
var $name_news = 'Ќовости';


function get_object_by_id($id) {
	$o_base =  $this->get_object_base($id); 
	$o_param = $this->get_document_params($id);
	$o_nav =   $this->get_document_navigation($o_base['object']['parent_id'],$o_base['object']['name']);
//	$o_menu = $this->down_level_menu(	$this->_get_menu_tree($o_base['object'])	);
//	$o_menu = 	$this->_get_menu_tree($o_base['object'])	;
	
	$this->_get_object_seo(&$o_base);
	
	$o_b1 =    $this->get_object_base(ID_BANNERS_ALL_LEFT); 
	$o_b2 =    $this->get_object_base(ID_BANNERS_ALL_TOP); 
	$o_b3 =    $this->get_object_base(ID_BANNERS_ALL_BOTTOM); 
	$o_b4 =    $this->get_object_base(ID_BANNERS_INDEX_MIDDLE); 
	$o_b5 =    $this->get_object_base(ID_BANNERS_NAV_LEFT); 
	$o_b6 =    $this->get_object_base(ID_BANNERS_CNT_BOTTOM); 

//alid($o_base['object']['params']['firm_id']['pvalue']);
	$o_membernews =  $this->get_object_anons_for_company_news(	'/members/news/%/' ,$o_base['object']['params']['firm_id']['pvalue'],4,0,'DESC',false);
//alid($o_membernews);
	
	
	$news_ids = $this->get_id_and_type_for_url(		$o_base['object']['url'].'news/'	);
	$o_news =  isset($news_ids['object']['id'])?$this->get_object_anons(	$news_ids['object']['id']	,2,0,'DESC',false):array('childs'=>array());
	
	$nov_ids = $this->get_id_and_type_for_url(		$o_base['object']['url'].'novelty/'	);
	$nov_news =  isset($nov_ids['object']['id'])?$this->get_object_anons(	$nov_ids['object']['id'] ,3,0,'DESC',false):array('childs'=>array());

	$o_object =  $this->get_object_anons_for_company_news(	'/members/object/action-%-'.$o_base['object']['params']['firm_id']['pvalue'].'/' ,$o_base['object']['params']['firm_id']['pvalue'],400,0,'DESC',false);
	//alid($o_object);



	$o_menu = array();
	$o_menu[0]=array (
	        'id' => $o_base['object']['id'],
            'type' => '',
            'name' => $o_base['object']['name'],
            'url' => $o_base['object']['url'],
            'statushidden' =>'active' ,
            'parent_id' => 0,
            'ordering' => 0,
            'level' => 1
			);
	$o_menu[1]=array (
	        'id' => $o_base['object']['id'],
            'type' => '',
//            'name' => 'ѕрофиль',
            'name' => $this->name_profil,
            'url' => $o_base['object']['url'].'#profile',
            'statushidden' =>'active' ,
            'parent_id' => 0,
            'ordering' => 0,
            'level' => 2
			);
	$o_menu[2]=array (
	        'id' => '',
            'type' => '',
//            'name' => ' онтактные данные',
            'name' => $this->name_contact,
            'url' => $o_base['object']['url'].'#contact',
            'statushidden' =>'active' ,
            'parent_id' => 0,
            'ordering' => 0,
            'level' => 2
			);
	if (isset($o_news['childs']) && (sizeof($o_news['childs'])>0)){
		$o_menu[]=array (
				'id' => '',
				'type' => '',
//				'name' => 'Ќовинки',
            'name' => $this->name_news,
				'url' => $o_base['object']['url'].'news/',
				'statushidden' =>'active' ,
				'parent_id' => 0,
				'ordering' => 0,
				'level' => 2
				);
			};
	if (isset($nov_news['childs']) && (sizeof($nov_news['childs'])>0)){
		$o_menu[]=array (
				'id' => '',
				'type' => '',
//				'name' => 'Ќовости',
            'name' => $this->name_novelty,
				'url' => $o_base['object']['url'].'novelty/',
				'statushidden' =>'active' ,
				'parent_id' => 0,
				'ordering' => 0,
				'level' => 2
				);
			};
	
//alid($o_menu);
	
	$o_brands=array();
	//alid($o_param['params']);
	//let's get brands
	reset($o_param['params']);
	while (list($k, $v)=each($o_param['params'])) {
		if (preg_match('/^brand_assoc_(.*)$/',$k, $m) && ($v['pvalue']=='1')){
			$o_b =  $this->get_object_base($m[1]); 
			$o_b['visdate'] =  '';
			$o_p = $this->get_document_params($m[1]);

			$o_f = $o_b['object'];
			$o_f['params'] = $o_p['params'];
			//$o_brands[$m[1]] = $o_f;
			$o_brands[	$o_f['name']	] = $o_f;
			};
		};
	//alid($o_brands);
	ksort($o_brands);
//	alid($o_brands);

	$my_brands=array();
	while (list($k, $v)=each($o_brands)) {
		$my_brands[$v['id']]=$k;
		};
//	alid($my_brands);



	
	
	// статистика. возьмем 2уровневый анонс категории, и оставим в нем только параметры брендов которые есть у этой фирмы. 
	// это и будет простынка брендов в категори¤х которыми занимаетс¤ эта фирма.
	$o_cats_stats =  $this->get_object_two_level_anonses(ID_CATALOG, 10000, 0, 'DESC', '"folder_catalog"'); 	
	//alid($o_cats_stats);
	reset($o_cats_stats['childs']);
	while (list($k, $v)=each($o_cats_stats['childs'])) {
	//	echo "<h1>".$v['name']."</h1><br>";
		unset(	$o_cats_stats['childs'][$k]['params']	);
		while (list($kk, $vv)=each($v['childs'])) {
	//		echo $vv['name']." <br/>";
		//	alid($vv['params']);
			$my_c_brands = array();
			while (list($kkk, $vvv)=each($vv['params'])) {
	//			alid($vvv);
					if (
						preg_match('/^b_c_a_(.*)$/',$vvv['pname'], $m1) 
						&&
					    isset($my_brands[$m1[1]]) && 
						($vvv['pvalue']=='1')
						){
						//alid($m1[1]);
	//					echo "FOUND ===>".$my_brands[	$m1[1]	]."<br />";
						// так как это активна¤ прив¤зка то подставим название бренда в значение.
						$o_cats_stats['childs'][$k]['childs'][$kk]['params'][$kkk]['pvalue'] = $my_brands[	$m1[1]	];
						$my_c_brands[] = $my_brands[	$m1[1]	];
						}
					else {
	//					echo "NOT ===>";
						unset(	$o_cats_stats['childs'][$k]['childs'][$kk]['params'][$kkk]	);
						};
				};
			if (0==sizeof($o_cats_stats['childs'][$k]['childs'][$kk]['params']) ){ 
				// нет брендов в категории 2 уровн¤ => отключаем
				unset(	$o_cats_stats['childs'][$k]['childs'][$kk]	);
				}
			else {
				// создадим "анонс" из названий брендов
				sort($my_c_brands);
				$o_cats_stats['childs'][$k]['childs'][$kk]['fullname'] = implode(", ",$my_c_brands);
				};
				
			};
			
		if (0==sizeof($o_cats_stats['childs'][$k]['childs']) ){ 
			// нет брендов в категории 1 уровн¤ => отключаем
			unset(	$o_cats_stats['childs'][$k]	);
			};			
			
		};
	//alid($o_cats_stats);
 
	$removed = array();    
	$removed["ВК ТЕХНО"]["Кондиционеры"]["Кондиционеры полупромышленные (кассетные, потолочные, канальные, колонные)"]["Carrier"]=1;
//	$removed["ВК ТЕХНО"]["Кондиционеры"]["Кондиционеры полупромышленные (кассетные, потолочные, канальные, колонные)"]["Lessar"]=1;
	$removed["ВК ТЕХНО"]["Кондиционеры"]["Кондиционеры бытовые (настенные, оконные, мобильные моноблоки)"]["Carrier"]=1;
//	$removed["ВК ТЕХНО"]["Кондиционеры"]["Кондиционеры бытовые (настенные, оконные, мобильные моноблоки)"]["Lessar"]=1;
	$removed["ВК ТЕХНО"]["Вентиляция и вентиляторы"]["Вентиляционные установки"]["Carrier"]=1;
	$removed["ВК ТЕХНО"]["Вентиляция и вентиляторы"]["Вентиляционные установки"]["Climaveneta"]=1;
	$removed["ВК ТЕХНО"]["Вентиляция и вентиляторы"]["Вентиляционные установки"]["Lessar"]=1;
	$removed["ВК ТЕХНО"]["Вентиляция и вентиляторы"]["Вентиляционные установки"]["Mitsubishi Electric"]=1;
	$removed["ВК ТЕХНО"]["Вентиляция и вентиляторы"]["Вентиляторные агрегаты"]["Lessar"]=1;
	$removed["ВК ТЕХНО"]["Вентиляция и вентиляторы"]["Вентиляторы"]["Lessar"]=1;
	$removed["ВК ТЕХНО"]["Центральное кондиционирование"]["Компрессорно-конденсаторные агрегаты"]["Carrier"]=1;
	$removed["ВК ТЕХНО"]["Центральное кондиционирование"]["Компрессорно-конденсаторные агрегаты"]["Mitsubishi Electric"]=1;
	$removed["ВК ТЕХНО"]["Центральное кондиционирование"]["Приточные установки"]["Carrier"]=1;
	$removed["ВК ТЕХНО"]["Центральное кондиционирование"]["Приточные установки"]["Lessar"]=1;
	$removed["ВК ТЕХНО"]["Центральное кондиционирование"]["Приточные установки"]["Mitsubishi Electric"]=1;
	$removed["ВК ТЕХНО"]["Центральное кондиционирование"]["Прецизионные кондиционеры"]["Carrier"]=1;
	$removed["ВК ТЕХНО"]["Центральное кондиционирование"]["Прецизионные кондиционеры"]["Lessar"]=1;
	$removed["ВК ТЕХНО"]["Центральное кондиционирование"]["Прецизионные кондиционеры"]["Mitsubishi Electric"]=1;
	$removed["ВК ТЕХНО"]["Центральное кондиционирование"]["Чиллеры"]["AUX"]=1;
	$removed["ВК ТЕХНО"]["Центральное кондиционирование"]["Чиллеры"]["Carrier"]=1;
	$removed["ВК ТЕХНО"]["Центральное кондиционирование"]["Чиллеры"]["Lessar"]=1;
	$removed["ВК ТЕХНО"]["Центральное кондиционирование"]["Чиллеры"]["Mitsubishi Electric"]=1;
	$removed["ВК ТЕХНО"]["Центральное кондиционирование"]["Фанкойлы"]["AUX"]=1;
//	$removed["ВК ТЕХНО"]["Центральное кондиционирование"]["Фанкойлы"]["Climaveneta"]=1;
	$removed["ВК ТЕХНО"]["Центральное кондиционирование"]["Фанкойлы"]["Mitsubishi Electric"]=1;
//	$removed["ВК ТЕХНО"]["Центральное кондиционирование"]["Мультизональные сплит-системы"]["AUX"]=1;
	$removed["ВК ТЕХНО"]["Центральное кондиционирование"]["Мультизональные сплит-системы"]["Carrier"]=1;
//	$removed["ВК ТЕХНО"]["Центральное кондиционирование"]["Мультизональные сплит-системы"]["Fujitsu"]=1;
	$removed["ВК ТЕХНО"]["Центральное кондиционирование"]["Мультизональные сплит-системы"]["Lessar"]=1;
	
	$removed["ВК ТЕХНО"]["Увлажнение, ионизация и очистка воздуха"]["Осушители"]["Mitsubishi Electric"]=1;
	$removed["ВК ТЕХНО"]["Увлажнение, ионизация и очистка воздуха"]["Увлажнители воздуха бытовые"]["Mitsubishi Electric"]=1;
	$removed["ВК ТЕХНО"]["Увлажнение, ионизация и очистка воздуха"]["Воздухоочистители"]["Mitsubishi Electric"]=1;
	$removed["ВК ТЕХНО"]["Расходные материалы и инструмент"]["Компрессоры"]["Mitsubishi Electric"]=1;
		
		
	$removed["БРИЗ-Климатические системы"]["Кондиционеры"]["Кондиционеры полупромышленные (кассетные, потолочные, канальные, колонные)"]["LG"]=1;

	$removed["БРИЗ-Климатические системы"]["Вентиляция и вентиляторы"]["Шумоглушители для вентиляции"]["Диафлекс"]=1;
	$removed["БРИЗ-Климатические системы"]["Вентиляция и вентиляторы"]["Вентиляционные решетки и диффузоры"]["Диафлекс"]=1;
	$removed["БРИЗ-Климатические системы"]["Обогреватели"]["Тепловые завесы"]["Mitsubishi Electric"]=1;
	$removed["БРИЗ-Климатические системы"]["Обогреватели"]["Тепловые завесы"]["ROYAL Clima"]=1;
	$removed["БРИЗ-Климатические системы"]["Обогреватели"]["Тепловентиляторы бытовые"]["De Longhi"]=1;
	$removed["БРИЗ-Климатические системы"]["Обогреватели"]["Конвекторы"]["De Longhi"]=1;
	$removed["БРИЗ-Климатические системы"]["Обогреватели"]["Инфракрасные нагреватели"]["De Longhi"]=1;
	$removed["БРИЗ-Климатические системы"]["Центральное кондиционирование"]["Компрессорно-конденсаторные агрегаты"]["Mitsubishi Electric"]=1;
	$removed["БРИЗ-Климатические системы"]["Центральное кондиционирование"]["Прецизионные кондиционеры"]["De Longhi"]=1;
	$removed["БРИЗ-Климатические системы"]["Центральное кондиционирование"]["Прецизионные кондиционеры"]["Mitsubishi Electric"]=1;
	$removed["БРИЗ-Климатические системы"]["Центральное кондиционирование"]["Чиллеры"]["Mitsubishi Electric"]=1;
	$removed["БРИЗ-Климатические системы"]["Центральное кондиционирование"]["Фанкойлы"]["De Longhi"]=1;
	$removed["БРИЗ-Климатические системы"]["Центральное кондиционирование"]["Фанкойлы"]["Mitsubishi Electric"]=1;
	$removed["БРИЗ-Климатические системы"]["Центральное кондиционирование"]["Мультизональные сплит-системы"]["ROYAL Clima"]=1;
	$removed["БРИЗ-Климатические системы"]["Увлажнение, ионизация и очистка воздуха"]["Осушители"]["ROYAL Clima"]=1;
	$removed["БРИЗ-Климатические системы"]["Увлажнение, ионизация и очистка воздуха"]["Осушители"]["Mitsubishi Electric"]=1;
	$removed["БРИЗ-Климатические системы"]["Увлажнение, ионизация и очистка воздуха"]["Увлажнители воздуха бытовые"]["HygroMatik"]=1;
	$removed["БРИЗ-Климатические системы"]["Увлажнение, ионизация и очистка воздуха"]["Увлажнители воздуха бытовые"]["Mitsubishi Electric"]=1;
	$removed["БРИЗ-Климатические системы"]["Увлажнение, ионизация и очистка воздуха"]["Воздухоочистители"]["De Longhi"]=1;
	$removed["БРИЗ-Климатические системы"]["Расходные материалы и инструмент"]["Компрессоры"]["Mitsubishi Electric"]=1;
	$removed["БРИЗ-Климатические системы"]["Отопление и водоснабжение"]["Радиаторы водяного отопления"]["De Longhi"]=1;
	$removed["БРИЗ-Климатические системы"]["Отопление и водоснабжение"]["Полотенцесушители"]["De Longhi"]=1;
	$removed["БРИЗ-Климатические системы"]["Отопление и водоснабжение"]["Водонагреватели"]["Mitsubishi Electric"]=1;
		
		
	$removed["ПРОФКОНД"]["Увлажнение, ионизация и очистка воздуха"]["Воздухоочистители"]["Mitsubishi Heavy Industries"]=1;
		
	$removed["ПРОФКОНД"]["Расходные материалы и инструмент"]["Компрессоры"]["Mitsubishi Heavy Industries"]=1;

	$removed["ПРОФКОНД"]["Центральное кондиционирование"]["Чиллеры"]["Mitsubishi Heavy Industries"]=1;
	$removed["ПРОФКОНД"]["Центральное кондиционирование"]["Фанкойлы"]["Mitsubishi Heavy Industries"]=1;


	$removed["ПРОФКОНД"]["Центральное кондиционирование"]["Мультизональные сплит-системы"]["Mitsubishi Heavy Industries"]=1;
	$removed["ПРОФКОНД"]["Центральное кондиционирование"]["Мультизональные сплит-системы"]["MDV"]=1;

	
	$removed["Благовест-С+"]["Кондиционеры"]["Кондиционеры полупромышленные (кассетные, потолочные, канальные, колонные)"]["McQuay"]=1;
	$removed["Благовест-С+"]["Кондиционеры"]["Кондиционеры бытовые (настенные, оконные, мобильные моноблоки)"]["McQuay"]=1;

	$removed["Благовест-С+"]["Обогреватели"]["Тепловые завесы"]["S&P"]=1;
	$removed["Благовест-С+"]["Обогреватели"]["Тепловентиляторы бытовые"]["S&P"]=1;
	$removed["Благовест-С+"]["Обогреватели"]["Конвекторы"]["S&P"]=1;
	$removed["Благовест-С+"]["Обогреватели"]["Обогреватели галогеновые, карбоновые"]["S&P"]=1;
	$removed["Благовест-С+"]["Обогреватели"]["Тепловые пушки"]["S&P"]=1;
	$removed["Благовест-С+"]["Обогреватели"]["Инфракрасные нагреватели"]["S&P"]=1;
 
	$removed["Благовест-С+"]["Расходные материалы и инструмент"]["Компрессоры"]["McQuay"]=1;
	$removed["Благовест-С+"]["Расходные материалы и инструмент"]["Метизы (расходные материалы)"]["DEC"]=1;
	$removed["Благовест-С+"]["Расходные материалы и инструмент"]["Изоляция"]["DEC"]=1;
	$removed["Благовест-С+"]["Расходные материалы и инструмент"]["Герметики"]["DEC"]=1;
 
 
	$removed["Благовест-С+"]["Отопление и водоснабжение"]["Полотенцесушители"]["PAX"]=1;
 
 
	$removed["Благовест-С+"]["Центральное кондиционирование"]["Прецизионные кондиционеры"]["McQuay"]=1;
	$removed["Благовест-С+"]["Центральное кондиционирование"]["Чиллеры"]["McQuay"]=1;
	$removed["Благовест-С+"]["Центральное кондиционирование"]["Фанкойлы"]["McQuay"]=1;
	$removed["Благовест-С+"]["Центральное кондиционирование"]["Фанкойлы"]["S&P"]=1;
	$removed["Благовест-С+"]["Центральное кондиционирование"]["Мультизональные сплит-системы"]["McQuay"]=1;
	$removed["Благовест-С+"]["Центральное кондиционирование"]["Приточные установки"]["McQuay"]=1;
	$removed["Благовест-С+"]["Вентиляция и вентиляторы"]["Воздуховоды"]["ТД Анкор"]=1;
	$removed["Благовест-С+"]["Вентиляция и вентиляторы"]["Вентиляционные установки"]["McQuay"]=1;
	$removed["Благовест-С+"]["Вентиляция и вентиляторы"]["Вентиляторы"]["Благовест"]=1;
 
 
	$o_cats_stats = $this->remove_hacked_unpleased_brands($o_cats_stats,$removed[$o_base['object']['name']]);

//	alid($o_cats_stats);
	
	$o_news =  $this->get_object_anons_for_raw_like_by_vidate(	'/about/apic-news/%/' ,3,0,'DESC',false);

	
    $return = Array(
        'status'=>true,
		'cat_stats'=>$o_cats_stats['childs'],
        'b1'=>$o_b1['object'],
        'b2'=>$o_b2['object'],
        'b3'=>$o_b3['object'],
        'b4'=>$o_b4['object'],
        'b5'=>$o_b5['object'],
        'b6'=>$o_b6['object'],

        'brands'=>$o_brands,
    //    'news'=>$o_news['childs'],
        'membernews'=>$o_membernews['childs'],
		'objects'=>$o_object['childs'],
        'nov'=>$nov_news['childs'],
        'news'=>$o_news['childs'],

        'object'=>$o_base['object'],
		'menu'=>$o_menu,
		'navigation'=>$o_nav['navigation'],
		'params'=>$o_param['params']
        );
	return $return;
	}


function remove_hacked_unpleased_brands($o_cats_stats,$removed){
//	alid($o_cats_stats);
	reset($o_cats_stats['childs']);
	while (list($k, $v)=each($o_cats_stats['childs'])) {
		unset(	$o_cats_stats['childs'][$k]['params']	);
		while (list($kk, $vv)=each($v['childs'])) {
			$my_c_brands = array();
			while (list($kkk, $vvv)=each($vv['params'])) {
					if (
					    isset($removed[	$o_cats_stats['childs'][$k]['name']	][	$o_cats_stats['childs'][$k]['childs'][$kk]['name']	][		$o_cats_stats['childs'][$k]['childs'][$kk]['params'][$kkk]['pvalue']	])
						){
							
							unset(	$o_cats_stats['childs'][$k]['childs'][$kk]['params'][$kkk]	);
							//echo "FOUND!!!".$kkk." <br />";
							}
						else {
						$my_c_brands[] = $vvv['pvalue'];							
						}

				};
			if (0==sizeof($o_cats_stats['childs'][$k]['childs'][$kk]['params']) ){ 
				// нет брендов в категории 2 уровн¤ => отключаем
				unset(	$o_cats_stats['childs'][$k]['childs'][$kk]	);
				}
			else {
				// создадим "анонс" из названий брендов
				sort($my_c_brands);
				$o_cats_stats['childs'][$k]['childs'][$kk]['fullname'] = implode(", ",$my_c_brands);
				};
				
			};
			
		if (0==sizeof($o_cats_stats['childs'][$k]['childs']) ){ 
			// нет брендов в категории 1 уровн¤ => отключаем
			unset(	$o_cats_stats['childs'][$k]	);
			};			
			
		};	
	
	return $o_cats_stats;
	}
	
}
?>