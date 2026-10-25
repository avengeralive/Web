<?php
if((!empty($site->current_object) && $site->current_object->permit>0) || (($action[1]=="child_add" || $action[1]=="arrange") && $site->current_part->permit>0))
{
//-----show-inner-------------------------------------
if(empty($action))
{
$part=$site->current_part;
$obj=$site->current_object;

echo '<h1>'.$part->name.'</h1>';

if(in_array($site->open[0]["sid"],$catalog_view) && (empty($catalog_type) || $catalog_type==$obj->id_type))
{
    $site->current_part->get_rubric();
    if($site->current_part->rubric_count>0)
    {
        if($site->params["sort"][1]=="rubric")
        {
            unset($rsort,$usort);
            for($i=2;$i<count($site->params["sort"]);$i++)
            {
                $trub=$site->get_rubric_by_sid($site->params["sort"][$i]);
                $rsort[0][]=$trub->id_r;
                $usort[]=$trub->sid;
            }
            $turl=implode('-',$usort);
            if(!empty($turl)) $turl=$obj->get_path("/admin").'sort-rubric-'.$turl.'-';
        }
        if(empty($turl)) $turl=$obj->get_path("/admin").'sort-rubric-';
    }    
}
	
echo '<div class="it"><h4><a href="'.$obj->get_path("/admin").'">'.$obj->name.'</a> <span>['.$site->type[$obj->id_type]["name"].']{'.$part->id.':'.$obj->id_type.':'.$obj->id.'} (<a href="'.$obj->get_path().'" target="_blank">просмотреть</a>)</span></h4>';
if($site->params["sort"][1]=="rubric" && count($usort)>0) echo str_replace("action-arrange/",'sort-rubric-'.implode('-',$usort).'/action-arrange/',$obj->actions("/admin"));
else echo $obj->actions("/admin");
echo '</div>';

if(in_array($site->open[0]["sid"],$catalog_view) && (empty($catalog_type) || $catalog_type==$obj->id_type))
{
    echo '<h2><a href="'.$obj->get_path("/admin").'action-import/">Загрузить товары из файла</a></h2>';
    if($site->params["sort"][1]=="rubric" && count($usort)>0) echo '<a href="'.$obj->get_path("/admin").'sort-rubric-'.implode('-',$usort).'/action-export/">Выгрузить товары в файл</a>';
    else echo '<a href="'.$obj->get_path("/admin").'action-export/">Выгрузить товары в файл</a>';
    
        
    if($site->current_part->rubric_count>0)
    {
    	echo '<div class="prodlist auto"><ul>';

    	for($i=0;$i<$site->current_part->rubric_count;$i++)
    	{
    		$id_r=$site->current_part->rubric_index[$i];
    		$prubric=$site->current_part->rubric[$id_r];
            
            $rubric_opts.='<option value="'.$id_r.'">'.$prubric->name.'</option>';
            
            echo '<li>';
            if(in_array($id_r,$rsort[0])) 
            {
                $tusort=$usort;
                $diff[0]=$prubric->sid;
                $tusort=array_diff($tusort,$diff);
                
                $tturl=implode('-',$tusort);
                if(!empty($tturl)) $tturl=$obj->get_path("/admin").'sort-rubric-'.$tturl.'/';
                else $tturl=$obj->get_path("/admin");
                
                echo '<a class="S" href="'.$tturl.'">'.$prubric->name.'</a>';
            }
            else echo '<a href="'.$turl.$prubric->sid.'/">'.$prubric->name.'</a>';
            
            $prubric->get_rubric();
            //if($prubric->rubric_count>0) echo '<br />';
            for($j=0;$j<$prubric->rubric_count;$j++)
        	{
        	   //if($j>0 && $j%4==0) echo '<br />';
               //elseif($j>0) echo ' ';
               if($j>0 && $j%10==0) echo '</li><li>';
               echo '<br />';
               
        		$id_r=$prubric->rubric_index[$j];
        		$rubric=$prubric->rubric[$id_r];
                
                $rubric_opts.='<option value="'.$id_r.'"> &nbsp; '.$rubric->name.'</option>';
                
                if(in_array($id_r,$rsort[0])) 
                {
                    $tusort=$usort;
                    $diff[0]=$rubric->sid;
                    $tusort=array_diff($tusort,$diff);
                    
                    $tturl=implode('-',$tusort);
                    if(!empty($tturl)) $tturl=$obj->get_path("/admin").'sort-rubric-'.$tturl.'/';
                    else $tturl=$obj->get_path("/admin");
                    
                    echo '<a class="S" href="'.$tturl.'">'.$rubric->name.'</a>';
                }
                else echo '<a href="'.$turl.$rubric->sid.'/">'.$rubric->name.'</a>';
                
                $rubric->get_rubric();
                for($k=0;$k<$rubric->rubric_count;$k++)
        	    {
        	       $id_r=$rubric->rubric_index[$k];
        		   $rubric1=$rubric->rubric[$id_r];  
                   $rubric_opts.='<option value="'.$id_r.'"> &nbsp; &nbsp; '.$rubric1->name.'</option>'; 
     	        }
        	}
            
            
            echo '</li>';

    	}
    	echo '</ul></div>';
    }
    
    //echo $site->navy_bar;
    
    
    if($site->params["sort"][1]=="rubric") $path=$obj->get_path("/admin").'sort-rubric-'.implode('-',$usort).'/';
    else $path=$obj->get_path("/admin");
    
    $obj->get_child_intersect(0,0,0,0,$rsort,1);
    $site->navy_bar($tags,$aclass,0,"/admin",$obj->total_count);
    
    echo $site->navy_bar;
    
    echo '<form id="filter_form" action="'.$path.'action-group-" method="post">';
    echo '<div class="prodlist auto"><ul><li class="chb"><input type="checkbox" class="group" onclick="cfunc(this);" /></li>';
    echo $obj->actions("/admin","group");
    echo '<li class="flt"><select name="srubric_id">'.$rubric_opts.'</select> <input class="sbmt" type="button" onclick="sfunc(\'rubric\');" value="Добавить рубрику"/> <input class="sbmt" type="button" onclick="sfunc(\'unrubric\');" value="Удалить рубрику"/></li>';
    echo '</ul></div>';
    
    echo '<div class="prodlist">';
    //echo '<ol><li></li><li>Сортировка: <span>А-Я</span><a href="#">Я-А</a></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li></ol>';
    
    

	for($i=0;$i<$obj->childs_count;$i++)
	{
		$id_type=$obj->childs_index[$i][0];
		$id=$obj->childs_index[$i][1];
		$obj1=$obj->childs[$id_type][$id];
        
        if($i%2==1 && $obj1->active==1) $class=" class=\"odd\"";
        elseif($i%2==1 && $obj1->active!=1) $class=" class=\"odd off\"";
        elseif($obj1->active!=1) $class=" class=\"off\"";
        else unset($class);
        
        echo '<ul'.$class.'>';
        echo '<li class="chb"><input type="checkbox" class="group" name="obj_arr['.$i.']" value="'.$id_type.'-'.$id.'" /></li>';
        echo '<li><a href="'.$obj1->get_path("/admin").'">'.$obj1->name.'</a> <span>['.$site->type[$id_type]["name"].']{'.$part->id.':'.$id_type.':'.$id.'} (<a href="'.$obj1->get_path().'" target="_blank">просмотреть</a>)</span></li>';
        if($site->params["sort"][1]=="rubric" && count($usort)>0) echo str_replace("action-cross/",'sort-rubric-'.implode('-',$usort).'/action-cross/',$obj1->actions("/admin","subgroup"));
        else echo $obj1->actions("/admin","subgroup");
        echo '</ul>';
	}
    
    echo '</div>';
    echo '<div class="prodlist auto"><ul><li class="chb"><input type="checkbox" class="group" onclick="cfunc(this);" /></li>';
    echo $obj->actions("/admin","group");
    echo '</ul></div>';
    echo '</form>';
    
    
    echo $site->navy_bar;
    
    $_SESSION["return"]=$path;
}    
else
{   
    echo $site->navy_bar;
    
	$obj->get_child("normal",0,0);

	for($i=0;$i<$obj->childs_count;$i++)
	{
		$id_type=$obj->childs_index[$i][0];
		$id=$obj->childs_index[$i][1];
		$obj1=$obj->childs[$id_type][$id];
		
		echo '<div class="it m10 dea"><h4><a href="'.$obj1->get_path("/admin").'">'.$obj1->name.'</a> <span>['.$site->type[$id_type]["name"].']{'.$part->id.':'.$id_type.':'.$id.'} (<a href="'.$obj1->get_path().'" target="_blank">просмотреть</a>)</span></h4>';
		echo $obj1->actions("/admin");
		echo '</div>';
	}
	
	echo $site->navy_bar;
    
    $_SESSION["return"]=$obj->get_path("/admin");
}

if(!empty($obj->start)) $_SESSION["return"].="page-".$obj->start.'/';
}
//-----group-------------------------------------
if($action[1]=="group")
{
    $obj_arr=$_POST["obj_arr"];
    $rub[0]=$_POST["srubric_id"];
    
    foreach($obj_arr as $o)
    {
        list($id_type,$id)=explode('-',$o);
        if(!empty($id_type) && !empty($id))
        {
            switch($action[2])
            {
                case 'activate' : $site->object_activate($id_type,$id); break;
                case 'deactivate' : $site->object_deactivate($id_type,$id); break;
                case 'archive' : $site->object_archive($id_type,$id); break;
                case 'delete' : $site->object_delete($id_type,$id); break;
                case 'rubric' : $site->rubrics_add($site->current_part->id,$id_type,$id,$rub); break;
                case 'unrubric' : $site->rubrics_flush($site->current_part->id,$id_type,$id,$rub); break;
            }
        }
    }
  echo "<h2>Действие выполнено</h2>";
  $path=$_SESSION["return"];
  if(empty($path)) $path="/admin/";
  echo '<META HTTP-EQUIV="Refresh" CONTENT="2; URL='.$path.'">';
}
//-----add-------------------------------------
if($action[1]=="child_add")
{
	if(!empty($finish) && empty($file_delete) && empty($upload) && empty($make_preview))
	{
	    $cflag=1;
        if(count($v_obj_type)>0)
        {
            foreach($v_obj_type as $idx => $id_type)
            {
                $act[$idx]=$site->fields_inner_check($id_type,$v_field_val[$idx]);
                if($act[$idx]==0) {$cflag=0;break;}
            }
        }
       
		if($site->fields_check($site->current_part->id,$site->type_sid[$action[2]],0,$field_val) && !empty($sid) && $cflag)
		{
            $cnt=preg_match_all("/([a-z0-9_-]{1})/",$sid,$reg);
   			if($cnt==mb_strlen($sid))
   			{
   			    if(!empty($keyword_arr)) $keywords.=", ".implode(", ",$keyword_arr);
                
   			    $list=$_POST["list"];
				if(empty($list)) $list=0;
				$field_val["sid"]=$sid;
				$field_val["date_add"]=$date_add;
				$field_val["list"]=$list;
				$field_val["title"]=$title;
				$field_val["description"]=$description;
				$field_val["keywords"]=$keywords;
                $field_val["nonrelated"]=$nonrelated;
                
                $id=$site->new_object($field_val,$site->type_sid[$action[2]],$rub);

				if($id)
				{
				    if(count($v_obj_type)>0)
                    {
                        $parg["type"]=$site->type_sid[$action[2]];
                        $parg["id"]=$id;
                        $parg["force_sid"]=1;
                        foreach($v_obj_type as $idx => $id_type)
                        {
                            if($act[$idx]==1) 
                            {
                                if(empty($v_fields_count[$id_type])) $v_fields_count[$id_type]=$site->get_fields_count($id_type);
                                if(empty($v_fields[$id_type])) $v_fields[$id_type]=$site->get_fields($id_type);
                                
                                if($v_fields[$id_type]["empty"][0]==1)
                                {
                                    for($i=1;$i<$v_fields_count[$id_type];$i++)
                                    {
                                        if($v_field_val[$idx][$i] && $v_fields[$id_type]["type"][$i]==2) 
                                        {
                                            if($v_field_val[$idx][0]) $v_field_val[$idx][0].=', ';
                                            $v_field_val[$idx][0].=$v_field_val[$idx][$i];
                                        }
                                    }
                                }
                                $v_field_val[$idx]["sid"]=$field_val["sid"];
                                $v_field_val[$idx]["date_add"]=$field_val["date_add"];
                                $v_field_val[$idx]["list"]=$field_val["list"];
                                $v_field_val[$idx]["nonrelated"]=1;
                                $site->new_object($v_field_val[$idx],$id_type,0,$parg);       
                            }
                        }
                    }
					echo "<h2>Объект добавлен!</h2>";
					$path=$_SESSION["return"];
	    			echo '<META HTTP-EQUIV="Refresh" CONTENT="2; URL='.$path.'">';
				}
				else
				{
					echo "<h3>Объект с таким названием или строковым идентификатором уже добавлен!</h3>";
					if(empty($site->current_object)) $path=$site->current_part->get_path("/admin").'action-child_add-'.$action[2].'/finish/';
					else $path=$site->current_object->get_path("/admin").'action-child_add-'.$action[2].'/finish/';
				    include($inc_path."admin/output/object_form.php");
				}
			}
			else
		    {
			 echo "<h3>Использованы недопустимые символы в Строковом идентификаторе! Используйте латинские буквы в нижнем регистре, цифры и символы подчёркивания.</h3>";
		     if(empty($site->current_object)) $path=$site->current_part->get_path("/admin").'action-child_add-'.$action[2].'/finish/';
			 else $path=$site->current_object->get_path("/admin").'action-child_add-'.$action[2].'/finish/';
			 include($inc_path."admin/output/object_form.php");
		    }
		}
		else
		{
			echo "<h3>Заполните обязательные поля!</h3>";
			if(empty($site->current_object)) $path=$site->current_part->get_path("/admin").'action-child_add-'.$action[2].'/finish/';
			else $path=$site->current_object->get_path("/admin").'action-child_add-'.$action[2].'/finish/';
			include($inc_path."admin/output/object_form.php");
		}	
	}
	else
	{
		if(!empty($upload))
		{	
			$file="image";
			if(empty($auto_preview)) $auto_preview=0;
			if(empty($alt)) $alt=" ";
			
            
            if(!empty($upload))
            {
                foreach($_FILES[$file]["name"] as $key => $val)
                {
                   $file_up["name"]=$val;
                   $file_up["tmp_name"]=$_FILES[$file]["tmp_name"][$key];
                   $file_up["size"]=$_FILES[$file]["size"][$key];
                    
    	           if(!$site->file_upload($file_up,$alt,$auto_preview,$site->current["part"]["id"],$site->type_sid[$action[2]],0)) echo "<h3>Ошибка загрузки файла ".$val."</h3>";
                }    
            }
		}
		elseif(!empty($file_delete))
		{
			if(!$site->file_delete($file_delete)) echo "<h3>Ошибка удаления файла</h3>";
		}
		elseif(!empty($make_preview))
		{
			if(!$site->file_preview($make_preview,$width[$make_preview],$height[$make_preview])) echo "<h3>Превью не создано</h3>";
		}
        elseif(!empty($keyword_arr)) $keywords.=", ".implode(", ",$keyword_arr);
        
        if(!empty($_POST["list"])) $list=$_POST["list"];
        
        $site->get_files($site->current["part"]["id"],$site->type_sid[$action[2]]);
		$file=$site->files;
		$file_count=$site->files_count;
		
		if(empty($site->current_object)) $path=$site->current_part->get_path("/admin").'action-child_add-'.$action[2].'/finish/';
		else $path=$site->current_object->get_path("/admin").'action-child_add-'.$action[2].'/finish/';
		include($inc_path."admin/output/object_form.php");
	}
}
//-----edit-------------------------------------
if($action[1]=="edit")
{
	if(!empty($finish) && empty($file_delete) && empty($upload) && empty($make_preview))
	{
	    $cflag=1;
        if(count($v_obj_type)>0)
        {
            foreach($v_obj_type as $idx => $id_type)
            {
                if($v_del[$idx]) continue;
                $act[$idx]=$site->fields_inner_check($id_type,$v_field_val[$idx]);
                if($act[$idx]==0) {$cflag=0;break;}
            }
        }
        
		if($site->fields_check($site->current_part->id,$site->current_object->id_type,$site->current_object->id,$field_val) && !empty($sid) && $cflag)
		{
            $cnt=preg_match_all("/([a-z0-9_-]{1})/",$sid,$reg);
   			if($cnt==mb_strlen($sid))
   			{
				$list=$_POST["list"];
				if(empty($list)) $list=0;
                
                if(!empty($keyword_arr)) $keywords.=", ".implode(", ",$keyword_arr);

				$field_val["sid"]=$sid;
				$field_val["date_add"]=$date_add;
				$field_val["list"]=$list;
				$field_val["title"]=$title;
				$field_val["description"]=$description;
				$field_val["keywords"]=$keywords;
                $field_val["nonrelated"]=$nonrelated;


				if($site->edit_object($field_val,$rub))
				{
				    if(count($v_obj_type)>0)
                    {
                        $parg["type"]=$site->current_object->id_type;
                        $parg["id"]=$site->current_object->id;
                        $parg["force_sid"]=1;
                        $tmp_object=$site->current_object;
                        foreach($v_obj_type as $idx => $id_type)
                        {
                            if($v_del[$idx])
                                $site->object_delete($id_type,$v_obj_id[$idx]);
                            
                            if($act[$idx]==1) 
                            {
                                if(empty($v_fields_count[$id_type])) $v_fields_count[$id_type]=$site->get_fields_count($id_type);
                                if(empty($v_fields[$id_type])) $v_fields[$id_type]=$site->get_fields($id_type);
                                
                                if($v_fields[$id_type]["empty"][0]==1)
                                {
                                    for($i=1;$i<$v_fields_count[$id_type];$i++)
                                    {
                                        if($v_field_val[$idx][$i] && $v_fields[$id_type]["type"][$i]==2) 
                                        {
                                            if($v_field_val[$idx][0]) $v_field_val[$idx][0].=', ';
                                            $v_field_val[$idx][0].=$v_field_val[$idx][$i];
                                        }
                                    }
                                }
                                if($v_obj_id[$idx]==-1) $v_field_val[$idx]["sid"]=$field_val["sid"];
                                $v_field_val[$idx]["date_add"]=$field_val["date_add"];
                                $v_field_val[$idx]["list"]=$field_val["list"];
                                $v_field_val[$idx]["nonrelated"]=1;
                                if($v_obj_id[$idx]==-1) $site->new_object($v_field_val[$idx],$id_type,0,$parg);
                                else
                                {
                                    $object_params["id_part"]=$site->current_part->id;
                            		$object_params["id_type"]=$id_type;
                            		$object_params["id"]=$v_obj_id[$idx];
                            
                            		$site->current_object=new object($object_params,0);
                                    $v_field_val[$idx]["sid"]=$site->current_object->sid;
                                    $site->edit_object($v_field_val[$idx],0);
                                }       
                            }
                        }
                        $site->current_object=$tmp_object;
                    }
					echo "<h2>Объект отредактирован!</h2>";
					$path=$_SESSION["return"];
	   		        echo '<META HTTP-EQUIV="Refresh" CONTENT="2; URL='.$path.'">';
				}
				else
				{
					echo "<h3>Объект с таким строковым идентификатором уже добавлен!</h3>";
					$path=$site->current_object->get_path("/admin").'action-edit/finish/';
				    include($inc_path."/admin/output/object_form.php");
				}
			}
            else
		    {
			 echo "<h3>Использованы недопустимые символы в Строковом идентификаторе! Используйте латинские буквы в нижнем регистре, цифры и символы подчёркивания.</h3>";
		     $path=$site->current_object->get_path("/admin").'action-edit/finish/';
             include($inc_path."/admin/output/object_form.php");
		    }
		}
		else
		{
			echo "<h3>Заполните обязательные поля!</h3>";
			$path=$site->current_object->get_path("/admin").'action-edit/finish/';
		    include($inc_path."/admin/output/object_form.php");			
		}	
	}
	else
	{
		$file="image";
		if(empty($auto_preview)) $auto_preview=0;
		if(empty($alt)) $alt=" ";
		if(!empty($upload))
        {
            foreach($_FILES[$file]["name"] as $key => $val)
            {
               $file_up["name"]=$val;
               $file_up["tmp_name"]=$_FILES[$file]["tmp_name"][$key];
               $file_up["size"]=$_FILES[$file]["size"][$key];
                
	           if(!$site->file_upload($file_up,$alt,$auto_preview,$site->current["part"]["id"],$site->current["object"]["type"],$site->current["object"]["id"])) echo "<h3>Ошибка загрузки файла ".$val."</h3>";
            }    
        }    
		if(!empty($file_delete))
			if(!$site->file_delete($file_delete)) echo "<h3>Ошибка удаления файла</h3>";
		if(!empty($make_preview))
			if(!$site->file_preview($make_preview,$width[$make_preview],$height[$make_preview])) echo "<h3>Превью не создано</h3>";
		if(empty($file_delete) && empty($upload) && empty($make_preview))
		{
			$site->current_object->get_meta();
			$site->current_object->get_content();
			$site->current_object->get_date();
            $site->current_object->get_rel();
			$field_val=$site->current_object->field["val"];
			$list=$site->current_object->child_count;
			$date_add=$site->current_object->date_add;
			$sid=$site->current_object->sid;
			$title=$site->current_object->title;
			$description=$site->current_object->description;
			$keywords=$site->current_object->keyword;
            $nonrelated=$site->current_object->nonrelated;	
            if($nonrelated) $nonrel_check=" checked";		
		}
        elseif(!empty($keyword_arr)) $keywords.=", ".implode(", ",$keyword_arr);
		
		$site->current_object->get_files();
		$file=$site->current_object->files;
		$file_count=$site->current_object->files_count;
		
		$path=$site->current_object->get_path("/admin").'action-edit/finish/';
		include($inc_path."/admin/output/object_form.php");	
	}
}
//-activate-----------------------------------------------------------------------
if(!empty($mode[0]) && $action[1]=="activate")
{
	   if(!empty($finish))
		{
		  $site->object_activate();
		  	
   		  echo "<h2>Объект успешно активирован</h2>";
   		  $path=$_SESSION["return"];
   		  if(empty($path)) $path="/admin/";
		  echo '<META HTTP-EQUIV="Refresh" CONTENT="2; URL='.$path.'">';
		  
		}	
		else
		{
        	     echo '<p><a href="'.$site->current_object->get_path("/admin").'action-activate/finish/">Действительно хотите активировать объект '.$site->current["object"]["name"].'?</a></p>';
		}		
}
//-deactivate-----------------------------------------------------------------------
if(!empty($mode[0]) && $action[1]=="deactivate")
{
	   if(!empty($finish))
		{
		  $site->object_deactivate();
		  	
   		  echo "<h2>Объект успешно деактивирован</h2>";
   		  $path=$_SESSION["return"];
   		  if(empty($path)) $path="/admin/";
		  echo '<META HTTP-EQUIV="Refresh" CONTENT="2; URL='.$path.'">';
		  
		}	
		else
		{
        	     echo '<p><a href="'.$site->current_object->get_path("/admin").'action-deactivate/finish/">Действительно хотите деактивировать объект '.$site->current["object"]["name"].'?</a></p>';
		}		
}
//-archive-----------------------------------------------------------------------
if(!empty($mode[0]) && $action[1]=="archive")
{
	   if(!empty($finish))
		{
		  $site->object_archive();
		  	
   		  echo "<h2>Объект успешно перенесен в архив</h2>";
   		  $path=$_SESSION["return"];
   		  if(empty($path)) $path="/admin/";
		  echo '<META HTTP-EQUIV="Refresh" CONTENT="2; URL='.$path.'">';
		  
		}	
		else
		{
        	     echo '<p><a href="'.$site->current_object->get_path("/admin").'action-archive/finish/">Действительно хотите переместить в архив объект '.$site->current["object"]["name"].'?</a></p>';
		}		
}
//-unarchive-----------------------------------------------------------------------
if(!empty($mode[0]) && $action[1]=="unarchive")
{
	   if(!empty($finish))
		{
		  $site->object_activate();
		  	
   		  echo "<h2>Объект успешно перенесен из архива</h2>";
   		  $path=$_SESSION["return"];
   		  if(empty($path)) $path="/admin/";
		  echo '<META HTTP-EQUIV="Refresh" CONTENT="2; URL='.$path.'">';
		  
		}	
		else
		{
        	     echo '<p><a href="'.$site->current_object->get_path("/admin").'action-unarchive/finish/">Действительно хотите вернуть из архива объект '.$site->current["object"]["name"].'?</a></p>';
		}		
}
//-delete-----------------------------------------------------------------------
if(!empty($mode[0]) && $action[1]=="delete")
{
	   if(!empty($finish))
		{
		  $site->object_delete();
		  	
   		  echo "<h2>Объект успешно удалён</h2>";
   		  $path=$_SESSION["return"];
   		  if(empty($path)) $path=$site->current_part->get_path("/admin");
		  echo '<META HTTP-EQUIV="Refresh" CONTENT="2; URL='.$path.'">';
		  
		}	
		else
		{
        	     echo '<p><a href="'.$site->current_object->get_path("/admin").'action-delete/finish/">Действительно хотите удалить объект '.$site->current["object"]["name"].'?</a></p>';
		}		
}
//-arrange-----------------------------------------------------------------------
if($action[1]=="arrange")
{
    if($site->params["sort"][1]=="rubric")
                {
                    unset($rsort,$usort);   
                    for($i=2;$i<count($site->params["sort"]);$i++)
                    {
                        $trub=$site->get_rubric_by_sid($site->params["sort"][$i]);
                        $rsort[0][]=$trub->id_r;
                        $usort[]=$trub->sid;
                    }
                }
    
	   if(!empty($finish))
		{
		  $site->arrange($idxs,$rsort);
		  	
   		  echo "<h2>Объекты успешно упорядочены</h2>";
   		  if(empty($site->current_object)) $path=$site->current_part->get_path("/admin"); 
          elseif($site->params["sort"][1]=="rubric") $path=$site->current_object->get_path("/admin").'sort-rubric-'.implode('-',$usort).'/';
          else $path=$site->current_object->get_path("/admin");
		  echo '<META HTTP-EQUIV="Refresh" CONTENT="2; URL='.$path.'">';
		}	
		else
		{
		      
          
        	    if(empty($site->current_object)) $path=$site->current_part->get_path("/admin").'action-arrange/finish/';
				elseif($site->params["sort"][1]=="rubric") $path=$site->current_object->get_path("/admin").'sort-rubric-'.implode('-',$usort).'/action-arrange/finish/';
                else $path=$site->current_object->get_path("/admin").'action-arrange/finish/';
				
				 echo '<form action="'.$path.'" method="post" enctype="multipart/form-data" name="ae_form">'."\n";
				 echo '<div id="cbaa"><h2>Дочерние объекты</h2>';

				$part=$site->current_part;
				if(empty($site->current_object))
					$parent=$site->current_part;
				else
					$parent=$site->current_object;
                
                if(count($rsort)>0) $parent->get_child_intersect("sort",0,"all",0,$rsort);
				else $parent->get_child("special",0,"all");
				
				for($i=0;$i<$parent->childs_count;$i++)
				{
					$id_type=$parent->childs_index[$i][0];
					$id=$parent->childs_index[$i][1];
					$obj1=$parent->childs[$id_type][$id];
					
					echo '<div class="it">';
					echo '<label for="x">'.$obj1->name.'</label><br />';
					echo '<input class="w450" name="idxs['.$i.']" id="x" type="text" value="'.$obj1->get_idx().'" />';
					echo '</div>';
				}
				echo '<input type="submit" name="submit" value="Подтвердить" class="submit" />';

				echo '</form></div><!--cbaa-->'; 
		}		
}
//-move-----------------------------------------------------------------------
if(!empty($site->current_object) && $action[1]=="move")
{
	   if(!empty($finish))
		{
		  if(empty($action[2]))
		  {
			$action[2]=0;
			$action[3]=0;	
		  }
		  $site->move_object($action[2]);
		  
   		  echo "<h2>Объект успешно перемещён</h2>";
   		  $site->current_object->path="";
   		  $path=$site->current_object->get_path("/admin");
   		  echo '<META HTTP-EQUIV="Refresh" CONTENT="2; URL='.$path.'">';
		  
		}	
		else
		{
        	    echo '<h1>'.$site->current_object->name.'</h1>';
				
				$path=$site->current_object->get_path("/admin");
				
				 echo '<div id="cbaa"><h2>Выберите место перемещения</h2>';

				$part=$site->current_part;
				
				echo '<ul><li><a href="'.$path.'action-move-'.$part->sid.'/finish/">'.$part->name.'</a>';
				
				tree($part,$site->current_object,$path,$site->type);
				
				echo '</li></ul>';
				echo '</div><!--cbaa-->'; 
		}		
}
//-cross-----------------------------------------------------------------------
if(!empty($site->current_object) && $action[1]=="cross")
{
    if($site->params["sort"][1]=="rubric")
    {
        unset($rsort,$usort);   
        for($i=2;$i<count($site->params["sort"]);$i++)
        {
            $trub=$site->get_rubric_by_sid($site->params["sort"][$i]);
            $rsort[0][]=$trub->id_r;
            $usort[]=$trub->sid;
        }
        $site->current_object->get_parent();
        
        $object_params["id_part"]=$site->current_object->id_part;
        $object_params["id_type"]=$site->current_object->ptype;
        $object_params["id"]=$site->current_object->pid;
        $object_params["active"]=1;
        
        $parent=new object($object_params,$site->permit($object_params["id_part"]));
    }
    
	   if(!empty($finish))
		{
		  $site->cross_object($cross);

   		  echo "<h2>Объекты связаны</h2>";
   		  $site->current_object->path="";
   		  $path=$_SESSION["return"];
          if($site->params["sort"][1]=="rubric") $path=$parent->get_path("/admin");
   		  elseif(empty($path)) $path=$site->current_object->get_path("/admin");
   		  echo '<META HTTP-EQUIV="Refresh" CONTENT="2; URL='.$path.'">';

		}
		else
		{
		  
        	    echo '<h1>'.$site->current_object->name.'</h1>';

				$path=$site->current_object->get_path("/admin");

				 echo '<div id="cbaa"><h2>Выберите объекты</h2>';
				 echo '<form action="'.$path.'action-cross/finish/" method="post" enctype="multipart/form-data" name="ae_form">'."\n";
                
				$part=$site->current_part;

				echo '<ul>';

				if($site->params["sort"][1]!="rubric") tree_a($part,$site->current_object,$path,$site->type,$site);
                else
                {
                    if(count($rsort)>0) $parent->get_child_intersect("sort",0,"all",0,$rsort);
    				else $parent->get_child("special",0,"all");
    				
    				for($i=0;$i<$parent->childs_count;$i++)
    				{
    					$id_type=$parent->childs_index[$i][0];
    					$id=$parent->childs_index[$i][1];
    					$obj1=$parent->childs[$id_type][$id];
                        
                        if($site->current_object->id_type==$id_type && $site->current_object->id==$id) continue;
    					
    					if($site->is_crossing($obj1)) $check=" checked";
    				    else $check="";
    				    echo '<li><input class="ck" name="cross[]" id="x" type="checkbox" value="'.$id_type.'-'.$id.'"'.$check.' /><label for="x">'.$obj1->name.'</label></a>';
    				}
                }
                
                
				echo '</ul>';
				echo '<input type="submit" name="submit" value="Подтвердить" class="submit" />';
				echo '</form></div><!--cbaa-->';
		}
}
//-import-----------------------------------------------------------------------
if(!empty($site->current_object) && $action[1]=="import")
{
       echo '<h1>'.$site->current_object->name.'</h1>';
       $path=$site->current_object->get_path("/admin");
       $spath=$images_tmp_upload;
       $upath=$inc_path."upload/files/";
       $bpath="/upload/files/";
       $csv_path=substr(session_save_path(),strpos(session_save_path(),"/"))."/ls_cms_import.csv";
       
	   if(!empty($_FILES["file"]) && empty($finish))
       {
        $str=file_get_contents($_FILES["file"]["tmp_name"]);
        $str=mb_convert_encoding($str, "UTF-8", "cp1251");
        
        $handle=fopen($csv_path, 'w'); 
        fwrite($handle, $str); 
        fclose($handle); 
        
        require_once($inc_path.'admin/service/ycsvParser.class.php');
		$ycsv = new ycsvParser($csv_path,false);
        
        if($record = $ycsv->getRecord()) {
			$array[] = $ycsv->parseRecord($record);
			}		

        $ycsv->close();
        
        if(count($array)>1) $r_count=1;
        else $r_count=count($array);
        
        $c_count=count($array[0]);
        
        echo '<form action="'.$path.'action-import/finish/" method="post" enctype="multipart/form-data" name="ae_form"><input id="tp" name="tp" type="hidden" value="'.$_POST["tp"].'" />'."\n";
        echo '<table>';
        
        echo '<tr>';
        
        $fields_tmp=$site->get_fields($_POST["tp"]);
        $import_fields['rubric1']='Категории';
        $import_fields['sid']='Артикул';
        
        for($j=0;$j<count($fields_tmp["name"]);$j++)
        {
            $import_fields[$j]=$fields_tmp["name"][$j];
        }     
        
        $import_fields['idx']='Порядок';  
        $import_fields['title']='Мета-тайтл';
        $import_fields['keywords']='Мета-ключевые слова';
        $import_fields['description']='Мета-описание';
        $import_fields['action']='Действие';
        $import_fields['archive']='Архивный';
        $import_fields['rubric2']='Категории 2';
        $import_fields['rubric3']='Категории 3';
        
        if(!empty($spath))
        {
            for($j=0;$j<10;$j++)
            {
                $import_fields['img'.$j]='Фото '.$j;
            }
        }
        
        for($j=0;$j<$c_count;$j++)
        {
            unset($select);
            $count=0;
            $select.='<select name="fld['.$j.']">';
            $select.='<option value="-1">Выбрать</option>';
            foreach($import_fields as $key => $value)
            {
                if($count==$j) $select.='<option value="'.$key.'" selected>'.$value.'</option>';
                else $select.='<option value="'.$key.'">'.$value.'</option>';
                $count++;
            }
            $select.='</select>';
            
            
            echo '<td>'.$select.'</td>';
        }
        echo '</tr>';
        
        for($i=0;$i<$r_count;$i++)
        {
            $tmp_row=$array[$i];
            echo '<tr>';
            for($j=0;$j<$c_count;$j++)
            {
                if(mb_strlen($tmp_row[$j])>100) echo '<td>'.mb_substr($tmp_row[$j],0,100).'...</td>';
                else echo '<td>'.$tmp_row[$j].'</td>';
            }    
            echo '</tr>';
        }
        
        echo '</table>';
        echo '<input type="submit" name="submit" value="Подтвердить" class="submit" />';
        echo '</form></div><!--cbaa-->'; 
       }
       elseif(!empty($finish))
       {
          $tp=$_POST["tp"];
		  require_once($inc_path.'admin/service/ycsvParser.class.php');
		  $ycsv = new ycsvParser($csv_path,false);
          
          while ($record = $ycsv->getRecord()) {
			$array[] = $ycsv->parseRecord($record);
			}		

            $ycsv->close();
            
            $r_count=count($array);
            $c_count=count($array[0]);
            
          foreach($array as $row)
          {
            $fields["list"]=100;
            
            for($i=0;$i<$c_count;$i++)
            {
                $fields[$fld[$i]]=$row[$i];
            }
            
            if(empty($fields[0])) continue;
            
            if(!empty($fields['rubric1']) || !empty($fields['rubric2']) || !empty($fields['rubric3'])) 
            {
                $fields['rubric']=$fields['rubric1'].','.$fields['rubric2'].','.$fields['rubric3'];
                $tmp_rub=explode(",",$fields['rubric']);
                foreach($tmp_rub as $rval)
                {
                    $rval=trim($rval);
                    if(empty($rval)) continue;
                    $trub=$site->get_rubric_by_name($rval);
                    if(!empty($trub->id_r)) $rub[]=$trub->id_r;
                }
            }
            if(empty($fields["sid"])) $fields["sid"]=translateStr($fields[0]);
            
            $parg["force_sid"]=1;
            $id=$site->import($fields,$rub,$tp,$parg);
            if(!empty($spath))
            {
                for($j=0;$j<10;$j++)
                {
                    if(!empty($fields['img'.$j]))
                    {
                        $t_fields['img'.$j]=$fields['img'.$j];
                        $fields['img'.$j]=strtolower($fields['img'.$j]);
                        $dir=substr($fields['img'.$j],0,1)."/";
                        copy($spath.$t_fields['img'.$j],$upath.$dir.$fields['img'.$j]);
                        $fields['img'.$j]=$bpath.$dir.$fields['img'.$j];
                        chmod($upath.$dir.$fields['img'.$j],0644);
                        $id_file=$site->file_db_add($tp,$id,$fields['img'.$j],str_replace($bpath.$dir,'',$fields['img'.$j]));
                        
                        list($width, $height) = getimagesize($upath.$dir.$fields['img'.$j]);
                        if(!empty($conf_preview["height"])) {$height=$conf_preview["height"];$width=0;}
                        elseif(!empty($conf_preview["width"])) {$width=$conf_preview["width"];$height=0;}
                        elseif($width>$height) {$width=$conf_preview["size"];$height=0;}
                        else {$height=$conf_preview["size"];$width=0;}
                        
                        $site->file_preview($id_file,$width,$height);
                    }                    
                }
            }
            unset($fields,$rub);
          }

   		  echo "<h2>Объекты импортированы</h2>";
   		  $site->current_object->path="";
   		  $path=$_SESSION["return"];
   		  if(empty($path)) $path=$site->current_object->get_path("/admin");
   		  echo '<META HTTP-EQUIV="Refresh" CONTENT="2; URL='.$path.'">';
		}
		else
		{
				echo '<div id="cbaa"><h2>Выберите тип объектов и файл для импорта</h2>';
				echo '<form action="'.$path.'action-import/" method="post" enctype="multipart/form-data" name="ae_form">'."\n";
                
                echo '<div class="it">';
                echo '<label for="x">Тип объекта</label><br /><select name="tp">';
                for($i=0;$i<$site->type_count;$i++)
                {
                	$j=$site->type_index[$i];
                    echo '<option value="'.$j.'">'.$site->type[$j]["name"].'</option>';
                }
                echo '</select><br />';
                echo '</div>';
                 
                echo '<div class="it">';
                echo '<label for="x">Загрузить файл</label><br />';
                echo '<input type="file" name="file" class="w300"><br />';
                echo '</div>';

				echo '<input type="submit" name="submit" value="Подтвердить" class="submit" />';
				echo '</form></div><!--cbaa-->';
		}
}
//----------------------------------------------	
}

function tree($obj,$ex,$path,$type)
{
	$obj->get_child("special",0,"all");
	
	if($obj->childs_count>0)
	{
		echo '<ul>';
		
		for($i=0;$i<$obj->childs_count;$i++)
		{
			$id_type=$obj->childs_index[$i][0];
			$id=$obj->childs_index[$i][1];
			$obj1=$obj->childs[$id_type][$id];
			
			if($id_type==$ex->id_type && $id==$ex->id) continue;
			
			echo '<li><a href="'.$path.'action-move-'.$obj1->sid.'/finish/">'.$obj1->name.'</a>';
			tree($obj1,$ex,$path,$type);
			echo '</li>';
		}
		
		echo '</ul>';
	}
}
//----------------------------------------------
function tree_a($obj,$ex,$path,$type,$site)
{
    $obj->get_child("special",0,"all");

	if($obj->childs_count>0)
	{
		echo '<ul>';

		for($i=0;$i<$obj->childs_count;$i++)
		{
			$id_type=$obj->childs_index[$i][0];
			$id=$obj->childs_index[$i][1];
			$obj1=$obj->childs[$id_type][$id];
            
            $obj1->get_rel();
            
            if(empty($obj1->nonrelated))
            {
    			if($id_type==$ex->id_type && $id==$ex->id) echo '<li>'.$obj1->name.'</a>';
    			else
    			{
    				if($site->is_crossing($obj1)) $check=" checked";
    				else $check="";
    				echo '<li><input class="ck" name="cross[]" id="x" type="checkbox" value="'.$id_type.'-'.$id.'"'.$check.' /><label for="x">'.$obj1->name.'</label></a>';
    			}
    			tree_a($obj1,$ex,$path,$type,$site);
    			echo '</li>';
            }
		}

		echo '</ul>';
	}
}
//----------------------------------------------
function r_deep($id_r)
{
    global $pr;
    global $t_arr;
    
    $sql='select id_r from '.$pr.'rubric where parent='.$id_r;
    $tmp=mysql_query($sql);
    $temp_rows=mysql_num_rows($tmp);
    
    for($i=0;$i<$temp_rows;$i++)
    {
        $t_id_r=mysql_result($tmp,$i,0);
        $t_arr[]=$t_id_r;
        r_deep($t_id_r);
    }    
}
//----------------------------------------------
function translateStr($name) 
{
  $name=mb_strtolower($name);  
  $mr[1]="а";
  $me[1]="a";
  $mr[2]="б";
  $me[2]="b";
  $mr[3]="в";
  $me[3]="v";
  $mr[4]="г";
  $me[4]="g";
  $mr[5]="д";
  $me[5]="d";
  $mr[6]="е";
  $me[6]="e";
  $mr[7]="ё";
  $me[7]="e";
  $mr[8]="ж";
  $me[8]="zh";
  $mr[9]="з";
  $me[9]="z";
  $mr[10]="и";
  $me[10]="i";
  $mr[11]="й";
  $me[11]="i";
  $mr[12]="к";
  $me[12]="k";
  $mr[13]="л";
  $me[13]="l";
  $mr[14]="м";
  $me[14]="m";
  $mr[15]="н";
  $me[15]="n";
  $mr[16]="о";
  $me[16]="o";
  $mr[17]="п";
  $me[17]="p";
  $mr[18]="р";
  $me[18]="r";
  $mr[19]="с";
  $me[19]="s";
  $mr[20]="т";
  $me[20]="t";
  $mr[21]="у";
  $me[21]="u";
  $mr[22]="ф";
  $me[22]="f";
  $mr[23]="х";
  $me[23]="h";
  $mr[24]="ц";
  $me[24]="c";
  $mr[25]="ч";
  $me[25]="ch";
  $mr[26]="ш";
  $me[26]="sh";
  $mr[27]="щ";
  $me[27]="shh";
  $mr[28]="ъ";
  $me[28]="";
  $mr[29]="ы";
  $me[29]="i";
  $mr[30]="ь";
  $me[30]="";
  $mr[31]="э";
  $me[31]="eh";
  $mr[32]="ю";
  $me[32]="ju";
  $mr[33]="я";
  $me[33]="ja";
  $mr[34]=" ";
  $me[34]="-";
  $mr[35]=".";
  $me[35]="";
  $mr[36]=",";
  $me[36]="";
  $mr[37]="_";
  $me[37]="-";
  $mr[38]="#";
  $me[38]="";
  $mr[39]="%";
  $me[39]="";
  $mr[40]="$";
  $me[40]="";
  $mr[41]="'";
  $me[41]="";
  $mr[42]="\"";
  $me[42]="";
  $mr[43]=":";
  $me[43]="";
  $mr[44]=";";
  $me[44]="";
  $mr[45]="@";
  $me[45]="";
  $mr[46]="^";
  $me[46]="";
  $mr[47]="*";
  $me[47]="";
  $mr[48]="+";
  $me[48]="";
  $mr[49]="=";
  $me[49]="";
  $mr[50]="&";
  $me[50]="";
  $mr[51]="<";
  $me[51]="";
  $mr[52]=">";
  $me[52]="";
  $mr[53]="?";
  $me[53]="";
  $mr[54]="!";
  $me[54]="";
  $mr[55]="/";
  $me[55]="";
  $mr[56]="\\";
  $me[56]="";
  $mr[57]="~";
  $me[57]="";
  $mr[58]="№";
  $me[58]="";
  $mr[59]="(";
  $me[59]="";
  $mr[60]=")";
  $me[60]="";
  $mr[61]="{";
  $me[61]="";
  $mr[62]="}";
  $me[62]="";
  $mr[63]="[";
  $me[63]="";
  $mr[64]="]";
  $me[64]="";
  $mr[65]="|";
  $me[65]="";
  
  return str_replace("--","-",str_replace("--","-",str_replace($mr,$me,$name)));  
}
?>