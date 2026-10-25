<?php 
namespace lib;

if (!defined('VOCU_FWK')) die(); // не работает без нашего фреймверка

/*
* class.CGalery.php
*
*Класс - библиотека с функциями для ответов ajax для работы с  альбомами галeреей и фото 
*подгружается через автоподгрузку классов
*
* История:  2016.12.12 - файл создан
*
*/

class CGalery {

	function album() {
		if ($_POST['param'][0] == 'new') return JBase::Set_Data('photoalbums', ['domain', 'name', 'published'], [DOMAIN, 'Новый альбом', '1']);
		else return JBase::Update_Data('photoalbums', ['name' => $_POST['param'][1]], ['id' => (int)$_POST['param'][0]]);
	}

	function gets() {
       	if (!isset($_POST['id'])) $Result = JBase::Get_Data('photoalbums', '*', ['published' => '1']);
       	else $Result = JBase::Get_Data('photo', '*', ['albums' => (int)$_POST['id'], 'published' => '1']);
		
		$items = [];
		if (!empty($Result))
			while ($item = $Result->fetch_assoc()) 
				$items[] = $item;
			return $items;
	}
	function ingallery() {
       	
       	if ($_POST['type'] == 'bglogo') 
       		$Result = JBase::Get_Nodomain('photo', '*', ['albums' => '1000000']);
       	elseif ($_POST['type'] == 'bg') 
       		$Result = JBase::Get_Nodomain('photo', '*', ['albums' => '2000000']);
      		
		$items = [];
		if (!empty($Result))
			while ($item = $Result->fetch_assoc()) 
				$items[] = $item;
			return $items;
	}
	
	
	
	
	
	
	
	
	
	function get_album() {
       	if ($_POST['list'] == 'album') $Result = JBase::Get_Data('photoalbums', '*', ['published' => '1']);
       	if ($_POST['list'] == 'img') $Result = JBase::Get_Data('photo', '*', ['albums' => (int)$_POST['id'], 'published' => '1']);
		$items = [];
		if (!empty($Result))
			while ($item = $Result->fetch_assoc()) 
				$items[] = $item;
			return $items;
	}
	
	function save_album() {
		if ($_POST['id'] == 'new') JBase::Set_Data('photoalbums', ['domain', 'name', 'published'], [DOMAIN, $_POST['name'], '1']);
		else JBase::Update_Data('photoalbums', ['name' => $_POST['name']], ['id' => (int)$_POST['id']]);
	}
			
	function remove_item() {
		return JBase::Update_Data($_POST['table'], ['published' => '0'], ['id' => (int)$_POST['id']]); //не удаляем, а снимаем с публикации
	}
	
	function load_img() {
		if ( !empty($_FILES) ) {		
			if ( is_uploaded_file( $_FILES['img']['tmp_name'] ) ) {         
				$sftp = new LocalConnection();
				$path_parts = $sftp->SendFile( $_FILES['img']['tmp_name'], DOMAIN .'/file/'. $_FILES['img']['name'] ); 
				//$path_parts = json_decode(CDN::curl(['data' => $_FILES['img']]), true); 
            		
        		$Name  = [
        		    'domain',
            		'name',
            		'albums',
            		'published'
        		];
        		$Value = [
            		DOMAIN,
            		$path_parts['basename'],
            		//$path_parts['result']['basename'],
            		$_POST['id'],
            		'1'
        		];    
        		JBase::Set_Data('photo', $Name, $Value);
        		return $path_parts['basename'];
        		//return $path_parts['result']['all'];
         }               
		}
	}
}