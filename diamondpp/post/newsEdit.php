<?php
@session_start();

include dirname(__FILE__) . '/../includes/config.php';
include dirname(__FILE__) . '/../includes/auth/index.php';

if (!isset($user_id)){
    Header ('Location: /');	
    exit;
}

$user = User::getById($user_id);

if(!$user || $user->tip < 60){
    Header ('Location: /');	
    exit;
}

$get = new Request($_GET);
$data = [];
$error = false;
$files = [];
$imagePath = '../tmp/news/';
$allowedExts = array("image/jpeg","image/png");
//$temp = explode(".", $_FILES["avatar"]["name"]);


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
                
                $f_name = md5(time() . basename($file['name'])) . '.png';
                
		list($width, $height) = getimagesize( $filename );
                
                if( move_uploaded_file($filename, $imagePath . $f_name ) ){
                    $filename = $f_name;
                }
                else{
                    $error = true;
                }        
                
		$response = array(
                    "img" => $filename
		);
            }

        }
        $data = $error ? array('error' => 'Ошибка загрузки файлов.') : $response;
        print json_encode($data);