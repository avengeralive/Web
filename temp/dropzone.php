<?php
$session_id = $_GET['session_id'];
//$verifyToken = md5('unique_salt' . $_POST['timestamp']);
if (!empty($_FILES)) 
{
	//var_dump($_FILES);
	$out = '';
//&& $_POST['token'] == $verifyToken) {	
	if (!is_dir(dirname(__FILE__).'/files/'.$session_id))
	{
		mkdir(dirname(__FILE__).'/files/'.$session_id, 0755);
	}
	$targetFolder = dirname(__FILE__).'/files/'.$session_id; // Relative to the root
	$targetPath = $targetFolder;
	
	//foreach ($_FILES['file']['tmp_name'] as $index => $value) {
		$tempFile = $_FILES['file']['tmp_name'];
		$stamp = imagecreatefrompng('watermark.png');
		$im = imagecreatefromjpeg($tempFile);
		$marge_right = 10;
		$marge_bottom = 10;
		$sx = imagesx($stamp);
		$sy = imagesy($stamp);
		imagecopy($im, $stamp, imagesx($im) - $sx - $marge_right, imagesy($im) - $sy - $marge_bottom, 0, 0, imagesx($stamp), imagesy($stamp));
		imagejpeg($im, $_FILES['file']['tmp_name']);
		imagedestroy($im);
		$targetFile = rtrim($targetPath,'/') . '/' . $_FILES['file']['name'];
		$thumbfile = rtrim($targetPath,'/') . '/thumb_' . $_FILES['file']['name'];
		$i=0;
		$name = $_FILES['file']['name'];
		while (file_exists($targetFile)) 
		{
			$_FILES['file']['name'] = $i . '_' . $name;
			$targetFile = rtrim($targetPath,'/') . '/' . $_FILES['file']['name'];
			$thumbfile = rtrim($targetPath,'/') . '/thumb_' . $_FILES['file']['name'];
			$i++;
		}
			// Validate the file type
		
		if (move_uploaded_file($tempFile, $targetFile)) {
			copy($targetFile, $thumbfile);
			resize($thumbfile, 400, 225);
			$out = $session_id.'/'.$_FILES['file']['name'];

			$ch = curl_init();
			$url = "http://developer.remart.az/remart/saveImage";
			curl_setopt($ch, CURLOPT_URL,$url);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, "material_title=".$_FILES['file']['name']."&material_path=".$out."&secret=seofest4df");
			curl_exec($ch);  
			curl_close($ch);

		} else {
			$out .= 'Invalid file type for the file: '.$_FILES['files']['name'][$index].'; ';
		}		
	//}
	//echo $out;
}

function resize($image, $w_o = false, $h_o = false) {
    if (($w_o < 0) || ($h_o < 0)) {
      //echo "INC";
      return false;
    }
    list($w_i, $h_i, $type) = getimagesize($image); // Получаем размеры и тип изображения (число)
	//var_dump(getimagesize($image));
    $types = array("", "gif", "jpeg", "png"); // Массив с типами изображений
    $ext = $types[$type]; // Зная "числовой" тип изображения, узнаём название типа
    if ($ext) {
      $func = 'imagecreatefrom'.$ext; // Получаем название функции, соответствующую типу, для создания изображения
      $img_i = $func($image); // Создаём дескриптор для работы с исходным изображением
    } else {
     // echo 'INc img'; // Выводим ошибку, если формат изображения недопустимый
      return false;
    }
    /* Если указать только 1 параметр, то второй подстроится пропорционально */
    if (!$h_o) $h_o = $w_o / ($w_i / $h_i);
    if (!$w_o) $w_o = $h_o / ($h_i / $w_i);
    $img_o = imagecreatetruecolor($w_o, $h_o); // Создаём дескриптор для выходного изображения
    imagecopyresampled($img_o, $img_i, 0, 0, 0, 0, $w_o, $h_o, $w_i, $h_i); // Переносим изображение из исходного в выходное, масштабируя его
    $func = 'image'.$ext; // Получаем функция для сохранения результата
    return $func($img_o, $image); // Сохраняем изображение в тот же файл, что и исходное, возвращая результат этой операции
}
  /* Вызываем функцию с целью уменьшить изображение до ширины в 100 пикселей, а высоту уменьшив пропорционально, чтобы не искажать изображение */
   // Вызываем функцию

?>