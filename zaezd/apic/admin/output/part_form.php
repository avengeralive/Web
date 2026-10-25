<?php
if($_SESSION["user_type"]==1)
{
echo "<h2>Данные части</h2>";

echo '<form action="'.$path.'" method="post" enctype="multipart/form-data" name="ae_form">'."\n";

echo '<div class="it">';
echo '<label for="x">Название части</label><br />';
echo '<input class="w450" name="name" id="name" type="text" value="'.htmlspecialchars(stripslashes($name)).'" onclick="translateStr()" />';
echo '</div>';

echo '<div class="it">';
echo '<label for="x">Строковый идентификатор части</label><br />';
echo '<input class="w450" name="sid" id="sid" type="text" value="'.htmlspecialchars(stripslashes($sid)).'" />';
echo '</div>';

echo '<div class="it">';
if(!empty($idx)) echo '<input class="ck" name="idx" id="x" type="checkbox" checked /><label for="x">Главная часть</label>';
else echo '<input class="ck" name="idx" id="x" type="checkbox" /><label for="x">Главная часть</label>';
echo '</div>';

echo '<div class="it">';
echo '<label for="x">Текст</label><br />';
echo '<textarea id="x" name="txt" cols="72" rows="11">'.htmlspecialchars(stripslashes($txt)).'</textarea>';
echo '</div>';

echo '<div class="it">';
echo '<label for="x">Количество дочерних объектов на странице</label><br />';
echo '<input class="w450" name="list" id="x" type="text" value="'.$list.'" />';
echo '</div>';

echo '<div class="it">';
echo '<label for="x">Meta title</label><br />';
echo '<input class="w450" name="title" id="x" type="text" value="'.htmlspecialchars(stripslashes($title)).'" />';
echo '</div>';

echo '<div class="it">';
echo '<label for="x">Meta description</label><br />';
echo '<textarea id="x" name="description" cols="72" rows="3">'.htmlspecialchars(stripslashes($description)).'</textarea>';
echo '</div>';

echo '<div class="it">';
echo '<label for="x">Meta keywords</label><br />';
echo '<textarea id="x" name="keywords" cols="72" rows="3">'.$keywords.'</textarea>';
echo '</div>';

echo '<hr />';
echo '<h2>Файл</h2>';

echo '<div class="it">';
echo '<label for="x">Загрузить файл</label><br />';
echo '<input type="file" name="image[]" multiple="multiple" class="w300"><br />';
echo '<label for="x">Альтернативный текст</label><br />';
echo '<input class="w450" name="alt" id="x" type="text"><br />';
if($conf_preview["cut"]==1) echo '<input class="ck" name="auto_preview" id="x" type="checkbox" /><label for="x">Создать превью - минимальная сторона '.$conf_preview["size"].'px</label><br />';
elseif(!empty($conf_preview["height"])) echo '<input class="ck" name="auto_preview" id="x" type="checkbox" /><label for="x">Создать превью - высота '.$conf_preview["height"].'px</label><br />';
elseif(!empty($conf_preview["width"])) echo '<input class="ck" name="auto_preview" id="x" type="checkbox" /><label for="x">Создать превью - ширина '.$conf_preview["width"].'px</label><br />';
elseif($conf_preview["type"]=="small") echo '<input class="ck" name="auto_preview" id="x" type="checkbox" /><label for="x">Создать превью - меньшая сторона '.$conf_preview["size"].'px</label><br />';
else echo '<input class="ck" name="auto_preview" id="x" type="checkbox" /><label for="x">Создать превью - максимальная сторона '.$conf_preview["size"].'px</label><br />';
echo '<input type="submit" name="upload" value="Загрузить файл" class="submit" />';
echo '</div>';

if($file_count>0)
{
	if($file[0]["type"]==0) echo '<h3>Загруженные изображения</h3>';
	
	for($i=0;$i<$file_count;$i++)
	{
		if(empty($upf) && $file[$i]["type"]==1)
		{
			 echo '<h3>Загруженные файлы</h3>';
			 $upf=1000;
		}
		
		echo '<div class="it">';
		if($file[$i]["type"]==0)
		{
			if(!empty($file[$i]["preview"]))
			{
				echo '<img src="'.$file[$i]["preview"].'" alt="" />';
				echo '<h4><a href="'.$file[$i]["path"].'">'.$file[$i]["name"].'</a> <span>['.$file[$i]["size"].' kB]</span></h4>';
				echo '<p>Тэг изображения: <span class="tag">!'.$file[$i]["path"].' (<span>'.$file[$i]["alt"].'</span>)!</span></p>';
				echo '<p>Превью: <a href="'.$file[$i]["path"].'"><strong>'.$file[$i]["name"].'</strong></a> ['.$file[$i]["size"].' kB]</p>';
				echo '<p>Тэг превью: <span class="tag">!'.$file[$i]["preview"].' (<span>'.$file[$i]["alt"].'</span>)!</span></p>';
				echo '<p>Ссылка с превью на изображение:<br /> <span class="tag">!'.$file[$i]["preview"].' (<span>'.$file[$i]["alt"].'</span>)!:'.$file[$i]["path"].'</span></p>';
                if($conf_lightbox) echo '<p>Ссылка для lightbox:<br /> <span class="tag">&lt;a href="'.$file[$i]["path"].'" rel="lightbox-foto" title="'.$file[$i]["alt"].'" alt="'.$file[$i]["alt"].'"&gt;&lt;img src="'.$file[$i]["preview"].'" title="'.$file[$i]["alt"].'" alt="'.$file[$i]["alt"].'" /&gt;&lt;/a&gt;</span></p>';
				echo '<input type="submit" name="file_delete" value="Удалить изображение" class="submit" onClick="this.value=\''.$file[$i]["id"].'\'" />';
			}
			else
			{
				echo '<img src="/admin/files/inopre.gif" alt="" />';
				echo '<h4><a href="'.$file[$i]["path"].'">'.$file[$i]["name"].'</a> <span>['.$file[$i]["size"].' kB]</span></h4>';
				echo '<p>Тэг изображения: <span class="tag">!'.$file[$i]["path"].' (<span>'.$file[$i]["alt"].'</span>)!</span></p>';
				echo '<p>Превью: <strong>Нет превью</strong></p>';
				echo '<label for="x">Ширина, px:</label><input class="w30" name="width" id="x" type="text">&nbsp;&nbsp;';
				echo '<label for="x">Высота, px:</label><input class="w30" name="height" id="x" type="text">';
				echo '<input type="submit" name="make_preview" value="Создать превью" class="submit" onClick="this.value=\''.$file[$i]["id"].'\'" /><br /> ';
				echo '<input type="submit" name="file_delete" value="Удалить изображение" class="submit" onClick="this.value=\''.$file[$i]["id"].'\'" />';
			}
		}
		if($file[$i]["type"]==1)
		{
			echo '<h4 class="f '.$file[$i]["ext"].'"><a href="'.$file[$i]["path"].'">'.$file[$i]["name"].'</a> <span>['.$file[$i]["size"].' kB]</span></h4>';
			echo '<p>Тэг файла: <span class="tag">"'.$file[$i]["name"].' (<span>'.$file[$i]["alt"].'</span>)":'.$file[$i]["path"].'</span></p>';
			echo '<input type="submit" name="file_delete" value="Удалить файл" class="submit" onClick="this.value=\''.$file[$i]["id"].'\'" />';	
		}
		echo '</div>';
	}
}


echo '<input type="submit" name="submit" value="Подтвердить" class="submit" />';

echo '</form>'; 
}
?>