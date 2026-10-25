<?php
	class ImagePreview
	{	
		public static function createPreview($image_url, $width, $height, $images_dir = null, $png = null, $noPath = false)
		{
			// realpath(); // ???
			if(!$images_dir) $images_dir = dirname($image_url)."/";

			$path_parts = pathinfo($image_url);
			$fn = $images_dir.$width."x".$height."x_crop_".(($png)?('_wm4_'):('')).$path_parts['basename'];

                        //if(file_exists($fn)) { unlink ($fn); }

			if(!file_exists($fn))
			{	
				if(file_exists($image_url) && is_file($image_url))
				{
					$type = exif_imagetype($image_url);
					if($type === false || !in_array($type, array(1, 2, 3))) return null;

					$size = null;
					try{
						$size = getimagesize($image_url);
					}catch (Exception $e)
					{

					}

					if ($size != false)
					{
						$w = 0;
						$h = 0;
						$ox = 0;
						$oy = 0;
						if(($size[0]/$size[1]) > ($width/$height))
						{
							$h = $size[1];
							$w = (int)($size[1] * $width / $height);
							$ox = (int)(($size[0] - $w)/2);
						}else
						{
							$w = $size[0];
							$h = (int)($size[0] * $height / $width);
							$oy = (int)(($size[1] - $h)/2);
						}
						$quality = 90;


						$source = null;
						
						switch($type) //$path_parts['extension'])
						{
							case 1:	$source = imagecreatefromgif($image_url);
							break;
							case 3: $source = imagecreatefrompng($image_url);
							break;
						//	case 6: $source = imagecreatefromwbmp($image_url);
						//	break;
							case 2: $source = imagecreatefromjpeg($image_url);
							break;
						}
							
						if($source == null) return $image_url;
						$target = imagecreatetruecolor($width, $height);
						imagecopyresampled(	$target,$source, 0,0,$ox,$oy,$width,	$height,$w,	$h);

						if($png && file_exists($png))
						{
                                                    //var_dump($png);
							$pngsize = getimagesize($png);
							$png = imagecreatefrompng($png);
							imagecopyresampled(	$target, $png, 0,0, 0,0, $width, $height, $pngsize[0],	$pngsize[1]);
						}

						imagejpeg($target, $fn, $quality);
						imagedestroy($target);
						imagedestroy($source);
						//return $fn;
					}
				}else return "empty.jpg";
			}
			if($noPath)
			{
				$path_parts = pathinfo($fn);
				$fn = $path_parts['basename'];
			}
			return $fn;
		}

        public static function createPreview2($image_url, $width, $height, $images_dir = null)
		{
			// realpath(); // ???
			if(!$images_dir) $images_dir = dirname($image_url);
			
			$path_parts = pathinfo($image_url);
			$fn = $images_dir.DIRECTORY_SEPARATOR.$width."x".$height."x_nocrop_".$path_parts['basename'];

			if(!file_exists($fn))
			{	
				if(file_exists($image_url))
				{
					$type = exif_imagetype($image_url);
					if($type === false  || !in_array($type, array(1, 2, 3))) return null;

					$size = null;
					try{
						$size = getimagesize($image_url);
					}catch (Exception $e)
					{
						
					}

					if ($size != false)
					{
						$w = $size[0];
						$h = $size[1];

						$w2 = 0;
						$h2 = 0;

						$ox = 0;
						$oy = 0;
						if(($w/$h) < ($width/$height))
						{
							$h2 = $height;
							$w2 = ($w/$h) * $h2;
							$ox = ($width - $w2) / 2;

						}else
						{
							$w2 = $width;
							$h2 = ($h/$w) * $w2;
							$oy = ($height - $h2) / 2;
						}
						$quality = 90;


						$source = null;
						switch($type) //$path_parts['extension'])
						{
							case 1:	$source = imagecreatefromgif($image_url);
							break;
							case 3: $source = imagecreatefrompng($image_url);
							break;
//							case 6: $source = imagecreatefromwbmp($image_url);
//							break;
							case 2: $source = imagecreatefromjpeg($image_url);
							break;
						}
							
						if($source == null) return $image_url;
						$target = imagecreatetruecolor($width, $height);
						$white = imagecolorallocate($target, 255, 255, 255); 
						imagealphablending($target, true); 
						imagefilledrectangle($target, 0, 0, $width-1, $height-1, $white); 

						imagecopyresampled($target, $source, $ox, $oy, 0, 0, $w2, $h2, $w, $h);
						
						imagejpeg($target, $fn, $quality);
						imagedestroy($target);
						imagedestroy($source);
						return $fn;
					}
				}return "empty.jpg";
			}else return $fn;
		}


        public static function createPreview3($image_url, $width, $height, $images_dir = null, $png = null)
		{
			// realpath(); // ???
			if(!$images_dir) $images_dir = dirname($image_url);
			
			$path_parts = pathinfo($image_url);
			$fn = $images_dir.$width."x___x_crop_".(($png)?('_png_'):('')).$path_parts['basename'];

			if(!file_exists($fn))
			{	
				if(file_exists($image_url) && is_file($image_url))
				{
					$type = exif_imagetype($image_url);
					if($type === false || !in_array($type, array(1, 2, 3))) return null;

					$size = null;
					try{
						$size = getimagesize($image_url);
					}catch (Exception $e)
					{

					}

					if ($size != false)
					{
						$w = 0;
						$h = 0;
						$ox = 0;
						$oy = 0;
					/*	if(($size[0]/$size[1]) > ($width/$height))
						{
							$h = $size[1];
							$w = (int)($size[1] * $width / $height);
							$ox = (int)(($size[0] - $w)/2);
						}else
						{ */
							$w = $size[0];
							$h = $size[1];
							$height = (int)(($h/$w) * $width);
							$oy = (int)(($size[1] - $h)/2);

					//	}
						$quality = 90;


						$source = null;
						
						switch($type) //$path_parts['extension'])
						{
							case 1:	$source = imagecreatefromgif($image_url);
							break;
							case 3: $source = imagecreatefrompng($image_url);
							break;
						//	case 6: $source = imagecreatefromwbmp($image_url);
						//	break;
							case 2: $source = imagecreatefromjpeg($image_url);
							break;
						}
							
						if($source == null) return $image_url;
						$target = imagecreatetruecolor($width, $height);
						imagecopyresampled(	$target,$source, 0,0,$ox,$oy,$width,	$height,$w,	$h);

						if($png && file_exists($png))
						{
							$pngsize = getimagesize($png);
							$png = imagecreatefrompng($png);
							imagecopyresampled(	$target, $png, 0,0, 0,0, $width, $height, $pngsize[0],	$pngsize[1]);
						}

						imagejpeg($target, $fn, $quality);
						imagedestroy($target);
						imagedestroy($source);
						return $fn;
					}
				}return "empty.jpg";
			}else return $fn;
		}					
	}
?>
