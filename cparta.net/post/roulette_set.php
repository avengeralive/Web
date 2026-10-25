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
$r_set = Roulette_Settings::getById(1);

$get = new Request($_GET);
$data = [];
$error = false;
$files = [];
$imagePath = '../templates/default/img/roulette/';
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
		list($width, $height) = getimagesize( $filename );
                
                if( move_uploaded_file($filename, $imagePath . basename($file['name']) ) ){
                    $files[] = realpath( $imagePath . $file['name'] );
                    $filename = basename($file['name']);
                }
                else{
                    $error = true;
                }
                
                $type = $get->t;
                $r_set->update([
                    $type => $filename,
                ]);
                
                switch ($type){
                    case 'sprite':
                        $then = 'sprite_img';
                        break;
                    case 'priz_1_img':
                        $then = 'priz_1';
                        break;
                    case 'priz_2_img':
                        $then = 'priz_2';
                        break;
                    case 'priz_3_img':
                        $then = 'priz_3';
                        break;
                    case 'priz_4_img':
                        $then = 'priz_4';
                        break;
                    case 'priz_5_img':
                        $then = 'priz_5';
                        break;
                    case 'priz_6_img':
                        $then = 'priz_6';
                        break;
                }
                
                
		$response = array(
                    "then" => $then,
                    "img" => './templates/default/img/roulette/'.$filename
		);
            }

        }
        $data = $error ? array('error' => 'Ошибка загрузки файлов.') : $response;
        print json_encode($data);