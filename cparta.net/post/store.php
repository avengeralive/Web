<?php
include dirname(__FILE__) . '/../includes/config.php';
include dirname(__FILE__) . '/../includes/auth/index.php';

if(isset($_POST['delgift'])){
    $user = User::getById($user_id);
    if($user->tip != 70) {
        exit;
    }
    $post = new Request($_POST);
    $gift = Store::getById($post->delgift);
    $gift->delete();
    echo 'ok';
    exit;
}

if (!isset($user_id)){	
    exit;
}
$user = User::getById($user_id);

if(!$user || $user->tip < 60){
    exit;
}

$get = new Request($_GET);
$data = [];
$error = false;
$files = [];
$imagePath = '../templates/default/img/store/';
$allowedExts = array("image/jpeg","image/png");

	if(!is_writable($imagePath)){
		$response = Array(
			"status" => 'error',
			"message" => 'Не получается загрузить картинку.'
		);
		print json_encode($response);
		return;
	}
        
        foreach( $_FILES as $file ){
            
            if ( in_array($file["type"], $allowedExts)){
                $filename = $file["tmp_name"];
		list($width, $height) = getimagesize( $filename );
                
                if( move_uploaded_file($filename, $imagePath . basename($file['name']) ) ){
                    $files[] = realpath( $imagePath . $file['name'] );
                    $filename = basename($file['name']);
                }
                else{
                    $error = true;
                }               
                
		$response = array(
                    "img" => './templates/default/img/store/'.$filename,
                    "img_val" => $filename
		);
            }

        }
        $data = $error ? array('error' => 'Ошибка загрузки файлов.') : $response;
        print json_encode($data);