<?php 
namespace lib;

if (!defined('VOCU_FWK')) die(); // не работает без нашего фреймворка

#
# class.CMenuAdm.php 
#
# Класс - библиотека с функциями для работы меню админа 
# подгружается через автоподгрузку классов
#
# История:  2016.12.07 - файл создан
# 			2018.06.13 - рефакторинг в связи с изменением фронтенда
#

class CMenuAdm {
    //amenu
    function amenu() {
			switch($_POST['param']) {     
				case 'parents': //загрузка пунктов модуля меню для публикации модулей
        			$res = JBase::Get_Data('my_menu', '*', ['id_menu' => $_POST['parent']]);
        			while ($numrow = $res->fetch_assoc()) {
			    		$response[$numrow['id']]['id'] 			= $numrow['id']; 
			    		$response[$numrow['id']]['cpu'] 		= $numrow['cpu']; 
			    		$response[$numrow['id']]['title'] 		= $numrow['title']; 
			    		$response[$numrow['id']]['ordering'] 	= $numrow['ordering']; 
			    		$response[$numrow['id']]['id_parent'] 	= $numrow['id_parent']; 
			    		$response[$numrow['id']]['published'] 	= $numrow['published'];
			    	}
			    	//сортируем по ordering
			    	uasort($response, function($a, $b) {
    					return $a['ordering'] <=> $b['ordering'];
					});
	    			return $response;
            	break;      
				case 'list': //загрузка названий модулей меню для публикации модулей
      				$Result = JBase::Get_List('modules', 'name', 'mod_menu', 'ordering', 'domain_id');
        			while ($numrow = $Result->fetch_assoc()) {    
	    				if (empty($_GET['name']) || $_GET['name'] == $numrow['name'])
        			        $response[$numrow['domain_id']] = $numrow['title'];   
        			}
    				return $response;  
            	break;     
				case 'get': //получение объекта по id пункта меню
      				$res = JBase::Get_Data('my_menu', '*', ['id' => $_POST['item']]);
        			$param = $res->fetch_assoc();
            		return $param;
            	break;     
				case 'hash': //получение объекта по hash пункта меню
            		$table = 'mod_menu_'. $_POST['cssjs']; //css or js
    				$res = JBase::Get_Data($table, '*', ['hash' => $_POST['hash']]);
    				$param = $res->fetch_assoc();
    				$param['css'] = htmlspecialchars_decode($param['css'], ENT_QUOTES);

            		return $param;
            	break;      
				case 'seo': //seo настройки
            		$Value = [
            			'description' => $_POST["desc"], 
            			'keywords' => $_POST["keys"],
            			'caption' => $_POST["caption"],
            			'cpu' => $_POST["cpu"]  
            		];
            		JBase::Update_Data('my_menu', $Value, ['id' => (int)$_POST['item']]);
            		return true;
            	break;   
				case 'add': //добавить пункт
            		$Name  = [
            			'title',
            			'id_parent',
            			'id_menu',
            			'published',
            			'domain'
            		];
            		$Value = [
            			$_POST["name"],
            			(int)$_POST["item"],
            			(int)$_POST["menu"],
            			'1',
            			DOMAIN
            		];
            		JBase::Set_Data('my_menu', $Name, $Value);
            		return true;
            	break;   
				case 'del': //удалить пункт
            		JBase::Update_Data('my_menu', ['published' => '0'], ['id' => (int)$_POST['item']]);
            		return true;
            	break;   
				case 'allinmodule': //запрос всех пунктов текущего модуля
            		$Result = JBase::Get_Data('my_menu', ['id','title'], ['published' => '1', 'id_menu' => (int)$_POST['menu']]);
            		while ($numrow = $Result->fetch_assoc()) { 
						$param[$numrow['id']] = $numrow['title']; 
					}
					return $param;
            	break;   
				case 'innermenu': //смена модуля меню у пункта меню 
            		JBase::Update_Data('my_menu', ['id_menu' => (int)$_POST['menu'], 'id_parent' => '0'], ['id' => (int)$_POST['item']]);
            		return true;
            	break;  
				case 'inneritem': //смена parent у пункта меню
					$new = ((int)$_POST['new'] == (int)$_POST['item']) ? (int)$_POST['new'] : 0; //защита от id_parent сам в себя
            		JBase::Update_Data('my_menu', ['id_parent' => (int)$_POST['new']], ['id' => (int)$_POST['item']]);
            		return true;
            	break;   
				case 'onoff': //Вкл/Выкл пунктов меню
					if (isset($_POST['onoff'])) {
						JBase::Update_Data('my_menu', ['published' => (int)$_POST['onoff']], ['id' => (int)$_POST['id']]);
            			return true;
					} else {
            			$Result = JBase::Get_Data('my_menu', ['id','title','published'], ['id_menu' => (int)$_POST['id']], 'title');
        				while ($numrow = $Result->fetch_assoc()) { 
    			    	    $param[$numrow['id']]['title'] = $numrow['title']; 
    			    	    $param[$numrow['id']]['published'] = $numrow['published'];   
        				}
            			return $param;
            		}
            	break;
				case 'array': //получение имен скриптов по хешу
            		$table = 'mod_menu_'. $_POST['cssjs']; //css or js
            		$regexp = rtrim(implode('|', explode(',', $_POST['hashes'])), '|');
            		$Result = JBase::Get_Regexp($table, ['hash', 'name'], ['hash' => $regexp]);
        			while ($numrow = $Result->fetch_assoc()) { 
    			        $param[$numrow['hash']] = $numrow['name'];   
        			}
        			return $param;
            	break; 
				case 'hdel': //удаление привязанных css/js по хешу
					$table = 'mod_menu_'. $_POST['cssjs']; //css or js
            		$editor = $_POST['cssjs'] .'_editor'; //css or js
            		JBase::Delete_Hash($table, $_POST['hash']);	
 					
					//обновляем массив в пунктах меню
					$hasharr = JBase::Get_Field_Value_From_Id('my_menu', $_POST['id'], $editor);
					$arr = explode(',', $hasharr);
					if (($key = array_search($_POST['hash'], $arr)) !== false) {
						unset($arr[$key]);
					}
            		return JBase::Update_Data('my_menu', [$editor => implode(',', $arr)], ['id' => (int)$_POST['id']]);					
            	break;
				case 'hadd': //добавление css/js
					$table = 'mod_menu_'. $_POST['cssjs']; //css or js
            		$editor = $_POST['cssjs'] .'_editor'; //css or js
					
					//обновляем массив в пунктах меню
					$hasharr = JBase::Get_Field_Value_From_Id('my_menu', $_POST['id'], $editor);
					$hasharr = implode(',', array_unique(explode(',', $_POST["hash"] . ',' . $hasharr)));
            		JBase::Update_Data('my_menu', [$editor => $hasharr], ['id' => (int)$_POST['id']]);	
					
            		//добавляем новую запись в css/js
            		$Name  = [
            			'name',
            			'home',
            			'all',
            			'this',
            			'hash',
            			'domain'
            		];
            		$Value = [
            			$_POST['cssjs'],
            			'false',
            			'false',
            			'false',
            			$_POST["hash"],
            			DOMAIN
            		];
            		JBase::Set_Data($table, $Name, $Value);
            		
            		//вызываем новую запись
    				$res = JBase::Get_Data($table, '*', ['hash' => $_POST['hash']]);
    				$param = $res->fetch_assoc();
    				$param['css'] = htmlspecialchars_decode($param['css'], ENT_QUOTES);

            		return $param;
            	break; 
				case 'hsave': //сохранение изменений в css/js по хешу
					$table = 'mod_menu_'. $_POST['cssjs']; //css or js					
            		$Value = [
            			'home' => $_POST['home'],
            			'name' => $_POST['name'],
            			'this' => $_POST['this'],
            			'all' => $_POST['all'],
            			'css' => htmlspecialchars( $_POST['editor'], ENT_QUOTES )
            		];        
            		JBase::Update_Data($table, $Value, ['hash' => $_POST['hash']]);	
					
					//регенерация кеша
					CCSS::pagecssjs($_POST['cssjs'], $_POST['id']);
            		return true;
            	break;
				case 'savedialog': //сохранение изменений в главном диалоге
            		return JBase::Update_Data('my_menu', ['title' => $_POST['nameitem'], 'ordering' => $_POST['ordering']], ['id' => (int)$_POST['id']]);
            	break;
            }

    }
    // выпадающий cпиcок - привязка к пункту меню
    function mod_List_gen_all() {    
    	$Result = JBase::Get_Data('modules', ['id', 'title'], ['name' => 'mod_menu']);
        while ($numrow = $Result->fetch_assoc()) {
            $response[$numrow['id']]['title'] = $numrow['title'];
        }  
        return $response;
    }  
    //cохранение данных в контекстном меню
    function red_menu_p() {
        $parent = ($_POST['parent'] == 'top') ? $_POST['mod_id'] : $_POST['parent'];
    	$Value = [
            'title' => $_POST['title'],
            'id_parent' => $parent,
            'inner_menu' => $_POST['parent2'],
        ]; 
        return JBase::Update_Data('my_menu', $Value, ['id' => (int)$_POST['id']]);
    }
    //загрузка модуля меню
    public function parentl() {
    
		if (!empty($_POST['parent'])) {
			$Result = JBase::Get_List('my_menu', 'id_parent', $_POST['parent'], 'ordering');
			
			if ( $Result->num_rows <= 0 ) $Result2 = JBase::Get_List('my_menu', 'id', $_POST['parent'], 'ordering');
			else $Result2 = $Result;

			while ($numrow = $Result2->fetch_assoc()) {    
				if ($Result2->num_rows > 0) {
					$response[$numrow['id']]['id'] 			= $numrow['id'];
					$response[$numrow['id']]['title'] 		= $numrow['title'];
					$response[$numrow['id']]['ordering'] 	= $numrow['ordering'];
					$response[$numrow['id']]['parent'] 		= $numrow['id_parent'];
					$response[$numrow['id']]['inner_menu'] 	= $numrow['inner_menu'];
				}    
			} 
			return $response;   
		} 
    }
    
}
