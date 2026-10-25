<?php

# Поиск папок
function search_file($path, $search = 'index.php')
{
	$dir = opendir($path);

	while (($file = readdir($dir)) !== false)
	{
		if(is_file($path . '/' . $file) && $file != '.' && $file != '..' && $file != '_' && $file != '__')
		{
			if($file == $search)
			{
				if (is_writable($path.'/'.$file)) 
				{
				    echo update_file($path.'/'.$file);

				    $result = 'файл успешно найден!';
				} 
				else 
				{
				    $result = 'файл недоступен для записи!';
				}
			}
			else
			{
				$result = 'файла не найдено!';
			}

		}

	}

###################################
$fp = fopen("log_search_file.txt", "a+");
fwrite($fp, "[".$path."/".$file."] - ".$result."\r\n");
fclose($fp);  	
###################################

}


# Поиск файлов
function search_dir($path, $folder = '_success_')
{
	$dir = opendir($path);

	$file = '';
	while (($file = readdir($dir))  !== false)
	{
		if (is_dir($path.'/'.$file) && $file != '.' && $file != '..' && $file != '_' && $file != '__') 
		{
			if($file == $folder)
			{
				echo search_file($path.'/'.$file);
			}
			else
			{				
				echo search_dir($path . "/" . $file);
  			}

		}

	}

}


# Замена файлов
function update_file($pathfile)
{
	$file = file_get_contents($pathfile, true);

	$found = '';

	if (strpos($file, "</body>"))    { $found = '1'; $tag = '</body>';}
	elseif(strpos($file, "</html>")) { $found = '1'; $tag = '</html>';}
	elseif(strpos($file, "<body>"))  { $found = '1'; $tag = '<body>'; }
	elseif(strpos($file, "<head>"))  { $found = '1'; $tag = '<head>'; }
	elseif(strpos($file, "<html>"))  { $found = '1'; $tag = '<html>'; }
	else { $found = '0';}

	if($found == '1')
	{
		$include = "$tag
<?php
	if($id){	
			//id
		require dirname(__FILE__).'/../../../../utilities/bootstrap.php';
		$z = Zakaz::getById($id);
		if($z->stream>0){
			$stream = Stream::getById($z->stream);
			if( $stream->facebook!=''){	
					?>
<script>
!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
document,'script','//connect.facebook.net/en_US/fbevents.js');

fbq('init', '<?php echo $stream->facebook;?>');
fbq('track', 'PageView');

fbq('track', 'Purchase', { 
    content_type: 'product',
    content_ids: ['<?php echo $stream->offer_id;?>'],
    value: <?php echo $z->comission;?>,
    currency: 'RUB'
});
</script>

<noscript>
<img height=\"1\" width=\"1\" border=\"0\" alt=\"\" style=\"display:none\" src=\"https://www.facebook.com/tr?id=<?php echo $stream->facebook;?>&amp;ev=PageView\" />
<img height=\"1\" width=\"1\" border=\"0\" alt=\"\" style=\"display:none\" src=\"https://www.facebook.com/tr?id=<?php echo $stream->facebook;?>&amp;ev=Purchase&amp;cd[content_type]=product&amp;cd[content_ids]=<?php echo $stream->offer_id;?>&amp;cd[value]=<?php echo $z->comission;?>&amp;cd[currency]=RUB\" />
</noscript>


					<?php
			}
		}
	}
?>";

		if (strpos($file, $include))
		{ 
			//$file = str_replace($include, $tag, $file);	
			//$rec  = file_put_contents($pathfile, $file);
			echo $pathfile;
			if($rec > 0)
			{
				$result = 'файл успешно записан!';
				
			}
			else
			{
				$result = 'ошибка записи файла!';
			}
		}
		else
		{
			$result = 'файл уже изменен!';
		}		
	}
	else
	{
		$result = 'теги не найдены!';
	}

###################################
$fp = fopen("log_update_file.txt", "a+");
fwrite($fp, "[".$pathfile."] - ".$result."\r\n");
fclose($fp);  	
###################################

	return $result;	
}

#echo search_dir($folderName);


	$offers = 'offers';
	$dir 	= opendir($offers);

	while (($folder = readdir($dir))  !== false)
	{
		if (is_dir($offers) && $folder != '.' && $folder != '..' && $folder != '_' && $folder != '__' && $folder != '.htaccess' && $folder != 'append.php' && $folder != 'buy.php' && $folder != 'index.php' && $folder != 'index.php1' && $folder != 'jquery-1.12.4.js' && $folder != 'politika.pdf' && $folder != 'robots.txt' && $folder != 'tracker.php') 
		{
			echo search_dir($offers.'/'.$folder);
		}	
	}


?>