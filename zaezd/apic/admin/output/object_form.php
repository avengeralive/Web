<?php
if($_SESSION["user_type"]==1 || ($_SESSION["user_type"]==2 && $site->current_object->permit>0)  || ($_SESSION["user_type"]==3 && $action[1]=="child_add" && $site->current_object->permit>0))
{
echo '<form action="'.$path.'" method="post" enctype="multipart/form-data" name="ae_form">'."\n";

$site->current_part->get_rubric();
if($action[1]=="edit") 
{
	$site->current_object->get_rubrics();
	$e_rub=$site->current_object->rubric;
}
else
{
    $site->get_files($site->current_part->id,$site->type_sid[$action[2]],0);
	$file=$site->files;
	$file_count=$site->files_count;
}
if($site->current_part->rubric_count>0)
{
	echo '<div id="cbab">';
//	echo '<div>';
	echo '<h2>Рубрики</h2>';
    echo '<div id="firstpane" class="menu_list">';
	for($i=0;$i<$site->current_part->rubric_count;$i++)
	{
		$id_r=$site->current_part->rubric_index[$i];
		$rubric=$site->current_part->rubric[$id_r];
		if(($action[1]=="edit" && count($rub)==0 && in_array($id_r,$e_rub["id"])) || in_array($id_r,$rub)) $check=" checked";
		else $check="";
		
		echo '<span class="menu_head"><input class="ck" name="rub[]" id="x'.$rubric->id_r.'" type="checkbox" value="'.$id_r.'"'.$check.' />'.$rubric->name.'</span><div class="menu_body">';
		
		$count=0;
		subrubric($rubric,$count);
        echo '</div>';
	}
	echo '</div>';
//    echo '</div>';
	echo '<div class="cbabbot">&nbsp;</div>';
	echo '</div><!--cbab-->';
}

echo '<div id="cbaa"><h2>Данные объекта</h2>';

echo '<div class="it">';
echo '<label for="x">Название объекта<span> [обязательное]</span></label><br />';
echo '<input class="w450" name="field_val[0]" id="name" type="text" value="'.htmlspecialchars(stripslashes($field_val[0])).'" />';
echo '</div>';

echo '<div class="it">';
echo '<label for="x">Строковый идентификатор объекта<span> [обязательное]</span></label><br />';
echo '<input class="w450" name="sid" id="sid" type="text" value="'.$sid.'"  onclick="translateStr()" />';
echo '</div>';

echo '<div class="it">';
echo '<label for="x">Дата публикации<span> [не обязательное]</span></label><br />';
echo '<input class="w450" name="date_add" id="date_add" type="text" value="'.$date_add.'" />';
echo '</div>';

echo "<script>$('#date_add').datetimepicker({lang:'ru'});</script>";

if($action[1]=="child_add")
{
$fields_count=$site->get_fields_count($site->type_sid[$action[2]]);
$fields=$site->get_fields($site->type_sid[$action[2]]);
$types=$site->get_related_types($site->type_sid[$action[2]]);
}
else
{
$fields_count=$site->get_fields_count($site->current_object->id_type);
$fields=$site->get_fields($site->current_object->id_type);
$types=$site->get_related_types($site->current_object->id_type);
}

$hflag=0;

for($i=1;$i<$fields_count;$i++)
{
if($fields["fidx"][$i]>100 && !$hflag)
{
    $hflag=1;
    echo '<div class="it" id="uncut-special_fields"><a href="javascript:uncut(\'special_fields\')">+ Показать дополнительные поля</a>';
    echo '</div>';
    echo '<div id="cut-special_fields" style="display:none;">';
    echo '<div class="it"><a href="javascript:cut(\'special_fields\')">- Скрыть дополнительные поля</a>';
    echo '</div>';    
}    
    
if($fields["empty"][$i]==0) $empty='<span> [обязательное]</span>';	
else $empty='';	
	
echo '<div class="it">';
echo '<label for="x">'.$fields["name"][$i].$empty.'</label><br />';
if($fields["type"][$i]>0 && $fields["type"][$i]<3)
	echo '<input class="w450" name="field_val['.$i.']" id="x" type="text" value="'.htmlspecialchars($field_val[$i]).'" />';
if($fields["type"][$i]==3)
	echo '<textarea id="x" name="field_val['.$i.']" cols="72" rows="11">'.htmlspecialchars($field_val[$i]).'</textarea>';
if($fields["type"][$i]==4)
	echo '<input class="w450" name="field_val['.$i.']" id="x" type="text" value="'.htmlspecialchars($field_val[$i]).'" onClick="displayDatePicker(\'start\',event);" />';

echo '</div>';
}

if(!$hflag)
{
echo '<div class="it" id="uncut-special_fields"><a href="javascript:uncut(\'special_fields\')">+ Показать дополнительные поля</a>';
echo '</div>';
echo '<div id="cut-special_fields" style="display:none;">';
echo '<div class="it"><a href="javascript:cut(\'special_fields\')">- Скрыть дополнительные поля</a>';
echo '</div>';
}

echo '<div class="it">';
echo '<label for="x">Не включать в связки объектов</label><br />';
echo '<input class="ck" name="nonrelated" id="x" type="checkbox" value="1"'.$nonrel_check.' />';
echo '</div>';

if($action[1]=="child_add" && empty($list)) $list=$site->current_object->child_count;

echo '<div class="it">';
echo '<label for="x">Количество дочерних объектов на странице</label><br />';
echo '<input class="w450" name="list" id="x" type="text" value="'.$list.'" />';
echo '</div>';

echo '<div class="it">';
echo '<label for="x">Meta title</label><br />';
echo '<input class="w450" name="title" id="x" type="text" value="'.$title.'" />';
echo '</div>';

echo '<div class="it">';
echo '<label for="x">Meta description</label><br />';
echo '<textarea id="x" name="description" cols="72" rows="3">'.htmlspecialchars(stripslashes($description)).'</textarea>';
echo '</div>';

echo '<div class="it">';
echo '<label for="x">Meta keywords</label><br />';
if($conf_keyw_array==1)
{
echo '<table>';
     $sql='select id_key,word from '.$pr.'keyword order by word';
	 $keyw=mysql_query($sql);
	 $keyw_count=mysql_num_rows($keyw);
     
     $key_check_array=explode(", ",$keywords);
     
     for($k=0;$k<$keyw_count;$k++)
     {
        if($k%8==0) echo '<tr>';

            $key=mysql_result($keyw,$k,1);

            
            if(in_array($key,$key_check_array)) 
            {
             $checked=" checked";
             $keywords=str_replace($key,"");
             $keywords=str_replace(", ,",",");   
            }
            else unset($checked);
            
            echo '<td>';
            echo '<input class="ck" name="keyword_arr['.mysql_result($keyw,$k,0).']" id="x" type="checkbox" value="'.$key.'"'.$checked.' /><label for="x">'.$key.'&nbsp;</label>';
            echo '</td>';

        if($k>0 && (($k-7)%8==0 || $k==($keyw_count-1))) echo '</tr>';
     }
     
echo '</table>';
}
echo '<textarea id="x" name="keywords" cols="72" rows="3">'.$keywords.'</textarea>';
echo '</div>';
echo '</div>';

if(count($types["id_type"])>0)
{
    $atc=0;
    if(count($v_obj_type)>0)
    {
        unset($tq);
        foreach($v_obj_type as $idx => $id_type)
        {
            if(empty($v_fields_count[$id_type])) $v_fields_count[$id_type]=$site->get_fields_count($id_type);
            if(empty($v_fields[$id_type])) $v_fields[$id_type]=$site->get_fields($id_type);
            
            unset($q,$fflag);
            
            $q.='<h3>'.$site->type[$id_type]["name"].' '.($idx+1).'</h3>';
            
            if($v_obj_id[$idx]>-1)
            {
                $q.='<div class="it">';
                if($v_del[$idx]) $q.='<input class="ck" name="v_del['.$atc.']" id="x" type="checkbox" checked /><label for="x">Удалить '.$site->type[$id_type]["name"].'</label>';
                else $q.='<input class="ck" name="v_del['.$atc.']" id="x" type="checkbox" /><label for="x">Удалить '.$site->type[$id_type]["name"].'</label>';
                $q.='</div>';
            }

            $q.='<input class="w450" name="v_obj_type['.$atc.']" type="hidden" value="'.$id_type.'" />';
            $q.='<input class="w450" name="v_obj_id['.$atc.']" type="hidden" value="'.$v_obj_id[$idx].'" />';
            
            if($v_fields[$id_type]["empty"][0]==0)
            {
                $q.='<div class="it">';
                $q.='<label for="x">Название объекта<span> [обязательное]</span></label><br />';
                $q.='<input class="w450" name="v_field_val['.$atc.'][0]" id="name_'.$atc.'" type="text" value="'.htmlspecialchars($v_field_val[$idx][0]).'" />';
                $q.='</div>';
                if($v_field_val[$idx][0]) $fflag=1;
            }
            
            for($i=1;$i<$v_fields_count[$id_type];$i++)
            {
            if($v_fields[$id_type]["empty"][$i]==0) $empty='<span> [обязательное]</span>';	
            else $empty='';	
            	
            $q.='<div class="it">';
            $q.='<label for="x">'.$v_fields[$id_type]["name"][$i].$empty.'</label><br />';
            if($v_fields[$id_type]["type"][$i]>0 && $v_fields[$id_type]["type"][$i]<3)
            	$q.='<input class="w450" name="v_field_val['.$atc.']['.$i.']" id="x" type="text" value="'.htmlspecialchars($v_field_val[$idx][$i]).'" />';
            if($v_fields[$id_type]["type"][$i]==3)
            	$q.='<textarea id="x" name="v_field_val['.$atc.']['.$i.']" cols="72" rows="11">'.htmlspecialchars($v_field_val[$idx][$i]).'</textarea>';
            if($v_fields[$id_type]["type"][$i]==4)
            	$q.='<input class="w450" name="v_field_val['.$atc.']['.$i.']" id="x" type="text" value="'.htmlspecialchars($v_field_val[$idx][$i]).'" onClick="displayDatePicker(\'start\',event);" />';
            
            $q.='</div>';
            
            if($v_field_val[$idx][$i]) $fflag=1;
            }
            $q.='<hr />';
            
            if($fflag || $v_obj_id[$idx]>-1) {$tq.=$q;$atc++;}
        }
    }
    elseif($action[1]=="edit")
    {
        $atc=0;
        for($v=0;$v<count($types["id_type"]);$v++)
        {
            $obj=$site->current_object;
            $obj->get_child("special",$types["id_type"][$v],"all");
            
            for($i=0;$i<$obj->childs_count;$i++)
        	{
        		$id_type=$obj->childs_index[$i][0];
        		$id=$obj->childs_index[$i][1];
        		$obj1=$obj->childs[$id_type][$id];
                $obj1->get_content();
                
                unset($q,$fflag);
                
                $q.='<h3>'.$site->type[$id_type]["name"].' '.($atc+1).'</h3>';
                
                $q.='<div class="it">';
                $q.='<input class="ck" name="v_del['.$atc.']" id="x" type="checkbox" /><label for="x">Удалить '.$site->type[$id_type]["name"].'</label>';
                $q.='<input class="w450" name="v_obj_type['.$atc.']" type="hidden" value="'.$id_type.'" />';
                $q.='<input class="w450" name="v_obj_id['.$atc.']" type="hidden" value="'.$id.'" />';
                $q.='</div>';
                
                if($obj1->field["empty"][0]==0)
                {
                    $q.='<div class="it">';
                    $q.='<label for="x">Название объекта<span> [обязательное]</span></label><br />';
                    $q.='<input class="w450" name="v_field_val['.$atc.'][0]" id="name_'.$atc.'" type="text" value="'.htmlspecialchars($obj1->field["val"][0]).'" />';
                    $q.='</div>';
                    if($obj1->field["val"][0]) $fflag=1;
                }
                
                for($j=1;$j<$obj1->field_count;$j++)
                {
                if($obj1->field["empty"][$j]==0) $empty='<span> [обязательное]</span>';	
                else $empty='';	
                	
                $q.='<div class="it">';
                $q.='<label for="x">'.$obj1->field["name"][$j].$empty.'</label><br />';
                if($obj1->field["type"][$j]>0 && $obj1->field["type"][$j]<3)
                	$q.='<input class="w450" name="v_field_val['.$atc.']['.$j.']" id="x" type="text" value="'.htmlspecialchars($obj1->field["val"][$j]).'" />';
                if($obj1->field["type"][$j]==3)
                	$q.='<textarea id="x" name="v_field_val['.$atc.']['.$j.']" cols="72" rows="11">'.htmlspecialchars($obj1->field["val"][$j]).'</textarea>';
                if($obj1->field["type"][$j]==4)
                	$q.='<input class="w450" name="v_field_val['.$atc.']['.$j.']" id="x" type="text" value="'.htmlspecialchars($obj1->field["val"][$j]).'" onClick="displayDatePicker(\'start\',event);" />';
                
                $q.='</div>';
                }
                $q.='<hr />';
                
                $atc++;
                $tq.=$q;
        	}
        }    
    }
    
    echo '<hr /><script>var ajax_type_count='.$atc.';</script>';
    echo '<div id="inner_objects">';
    echo $tq;    
    echo '</div>';
    
    for($v=0;$v<count($types["id_type"]);$v++)
    {
        echo '<div class="it"><a href="javascript:add_related('.$types["id_type"][$v].')">+ Добавить '.$types["name"][$v].'</a>';
        echo '</div>';
    }
}

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

//echo '<div class="it" id="uncut-special_fields"><a href="javascript:uncut(\'special_fields\')">+ Показать дополнительные поля</a>';
//echo '</div>';

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
				echo '<img src="'.$file[$i]["preview"].'" height="140" alt="" />';
				echo '<h4><a href="'.$file[$i]["path"].'">'.$file[$i]["name"].'</a> <span>['.$file[$i]["size"].' kB]</span></h4>';
				echo '<p>Тэг изображения: <span class="tag">!'.$file[$i]["path"].' (<span>'.$file[$i]["alt"].'</span>)!</span></p>';
				echo '<p>Превью: <a href="'.$file[$i]["preview"].'"><strong>'.$file[$i]["name"].'</strong></a></p>';
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
				echo '<label for="x">Ширина, px:</label><input class="w30" name="width['.$file[$i]["id"].']" id="x" type="text">&nbsp;&nbsp;';
				echo '<label for="x">Высота, px:</label><input class="w30" name="height['.$file[$i]["id"].']" id="x" type="text">';
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

echo '</form></div><!--cbaa-->'; 
}

function subrubric($rubric,$count)
{
	global $e_rub;
    global $rub;
	global $action;
	
	$count++;
	$rubric->get_rubric();
		
		for($j=0;$j<$rubric->rubric_count;$j++)
		{
			$id_r1=$rubric->rubric_index[$j];
			$rubric1=$rubric->rubric[$id_r1];
			if(($action[1]=="edit" && count($rub)==0 && in_array($id_r1,$e_rub["id"])) || in_array($id_r1,$rub)) $check=" checked";
			else $check="";
		
			echo '<input class="ck l'.$count.'" name="rub[]" id="x'.$rubric1->id_r.'" type="checkbox" value="'.$id_r1.'"'.$check.' /><label for="x'.$rubric1->id_r.'">'.$rubric1->name.'</label><br />';
			subrubric($rubric1,$count);
		}	
}
?>