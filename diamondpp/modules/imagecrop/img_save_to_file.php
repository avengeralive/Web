<?php

session_start();

// Подключаем файл конфигурации
// Connect configuration file
include '../../includes/config.php';

// Подключаем файл с аутентификацией
// Connect to the authenticated file
include '../../includes/auth/index.php';

if (!isset($user_id) && $user_id!='70')
	{
	Header ('Location: /');	
	exit;
	}

/*
*	!!! THIS IS JUST AN EXAMPLE !!!, PLEASE USE ImageMagick or some other quality image processing libraries
*/

$offer_id=$_SESSION['offer_id'];

    $imagePath = '../../tmp/';

	$allowedExts = array("image/jpeg","image/png");
	$temp = explode(".", $_FILES["avatar"]["name"]);
	//$extension = end($temp);
	
	//Check write Access to Directory

	if(!is_writable($imagePath)){
		$response = Array(
			"status" => 'error',
			"message" => 'Не получается загрузить картинку. Каталог защищен от записи.'
		);
		print json_encode($response);
		return;
	}
	
	if ( in_array($_FILES["avatar"]["type"], $allowedExts))
	  {
	  if ($_FILES["avatar"]["error"] > 0)
		{
			 $response = array(
				"status" => 'error',
				"message" => 'ERROR Return Code: '. $_FILES["avatar"]["error"],
			);			
		}
	  else
		{
	    $filename = $_FILES["avatar"]["tmp_name"];
		list($width, $height) = getimagesize( $filename );
		move_uploaded_file($filename,  $imagePath . 'offer'.$offer_id.'.png');
		
		$imgUrl = $imagePath.'offer'.$offer_id.'.png';
		
		$response = array(
		"status" => 'success',
		"url" => $imgUrl,
		"width" => $width,
		"height" => $height
		);

		
		
		
		
		}
	  }
	else
	  {
	   $response = array(
			"status" => 'error',
			"message" => 'Ошибка загрузки. Возможно либо превышен лимит размера файла, либо это не картинка.',
		);
	  }
	  
	  print json_encode($response);

?>
