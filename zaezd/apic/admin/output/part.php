<?php
if(($_SESSION["user_type"]==1 || $_SESSION["user_type"]==2) && $site->current_part->permit>0)
{
//-----show-------------------------------------
/*if(empty($mode[0]) && empty($action))
{
	echo '<h1>Части сайта</h1>';
	
	$site->get_parts();

	for($i=0;$i<$site->part_count;$i++)
	{
		$part=$site->part[$site->part_index[$i]];
			
		
		echo '<div class="it"><h4><a href="/admin/'.$part->sid.'/">'.$part->name.'</a></h4>';
		echo $part->actions("/admin/");
		echo '</div>';
	}
	
	$_SESSION["return"]="/admin/";
}*/
//-----show-inner-------------------------------------
if(empty($action))
{
	$part=$site->current_part;
	
	echo '<div class="it"><h4><a href="'.$part->get_path("/admin").'">'.$part->name.'</a></h4>';
	echo $part->actions("/admin");
	echo '</div>';
	
	$part->get_child("normal",0,0);
	
	echo $site->navy_bar;

	for($i=0;$i<$part->childs_count;$i++)
	{
		$id_type=$part->childs_index[$i][0];
		$id=$part->childs_index[$i][1];
		$obj=$part->childs[$id_type][$id];
		
		$path=$obj->get_path("/admin");			
		echo '<div class="it m10 dea"><h4><a href="'.$path.'">'.$obj->name.'</a> <span>['.$site->type[$id_type]["name"].']{'.$part->id.':'.$id_type.':'.$id.'} (<a href="'.$obj->get_path().'" target="_blank">просмотреть</a>)</span></h4>';
		echo $obj->actions("/admin");
		echo '</div>';
	}
	
	echo $site->navy_bar;
	
	$_SESSION["return"]=$part->get_path("/admin");
}
//-----add-------------------------------------
if($action[1]=="part_add")
{
	if(!empty($finish) && empty($file_delete) && empty($upload) && empty($make_preview))
	{
		if(!empty($name) && !empty($sid))
		{
            $cnt=preg_match_all("/([a-z0-9_]{1})/",$sid,$reg);
   			if($cnt==mb_strlen($sid))
   			{
   			    $list=$_POST["list"];
				if(empty($list)) $list=0;
				$fields["name"]=$name;
				$fields["sid"]=$sid;
				$fields["txt"]=$txt;
				$fields["list"]=$list;
				$fields["title"]=$title;
				$fields["description"]=$description;
				$fields["keywords"]=$keywords;
				if(!empty($idx)) $fields["idx"]=1;

				if($site->new_part($fields))
				{
					echo "<h2>Часть добавлена!</h2>";
	    			echo '<META HTTP-EQUIV="Refresh" CONTENT="2; URL=/admin/">';
				}
				else
				{
					echo "<h3>Часть с таким названием или строковым идентификатором уже добавлена!</h3>";
					$path="/admin/action-part_add/finish/";
				    include($inc_path."/admin/output/part_form.php");
				}
            }
            else
		    {
			 echo "<h3>Использованы недопустимые символы в Строковом идентификаторе! Используйте латинские буквы в нижнем регистре, цифры и символы подчёркивания.</h3>";
		     $path="/admin/action-part_add/finish/";
             include($inc_path."/admin/output/part_form.php");
		    }
		}
		else
		{
			echo "<h3>Заполните поля Название и Строковый идентификатор!</h3>";
			$path="/admin/action-part_add/finish/";
		    include($inc_path."/admin/output/part_form.php");		
		}	
	}
	else
	{
		if(!empty($upload))
		{	
			$file="image";
			if(empty($auto_preview)) $auto_preview=0;
			if(empty($alt)) $alt=" ";
			
            foreach($_FILES[$file]["name"] as $key => $val)
            {
               $file_up["name"]=$val;
               $file_up["tmp_name"]=$_FILES[$file]["tmp_name"][$key];
               $file_up["size"]=$_FILES[$file]["size"][$key];
                
	           if(!$site->file_upload($_FILES[$file],$alt,$auto_preview,$site->current["part"]["id"],0,0)) echo "<h3>Ошибка загрузки файла ".$val."</h3>";
            } 
                        
			$site->get_files(0,0,0);
			$file=$site->files;
			$file_count=$site->files_count;
		}
		if(!empty($file_delete))
		{
			if(!$site->file_delete($file_delete)) echo "<h3>Ошибка удаления файла</h3>";
			$site->get_files(0,0,0);
			$file=$site->files;
			$file_count=$site->files_count;
		}
		if(!empty($make_preview))
		{
			if(!$site->file_preview($make_preview,$width,$height)) echo "<h3>Превью не создано</h3>";
			$site->get_files(0,0,0);
			$file=$site->files;
			$file_count=$site->files_count;
		}
		
		$path="/admin/action-part_add/finish/";
		include($inc_path."/admin/output/part_form.php");	
	}
}
//-----edit-------------------------------------
if($action[1]=="edit")
{
	if(!empty($finish) && empty($file_delete) && empty($upload) && empty($make_preview))
	{
		if(!empty($name) && !empty($sid))
		{
            $cnt=preg_match_all("/([a-z0-9_]{1})/",$sid,$reg);
   			if($cnt==mb_strlen($sid))
   			{
   			    $list=$_POST["list"];
				if(empty($list)) $list=0;
                $fields["name"]=$name;
				$fields["sid"]=$sid;
				$fields["txt"]=$txt;
				$fields["list"]=$list;
				$fields["title"]=$title;
				$fields["description"]=$description;
				$fields["keywords"]=$keywords;
				if(!empty($idx)) $fields["idx"]=1;

				if($site->edit_part($fields))
				{
					echo "<h2>Часть отредактирована!</h2>";
					$path=$_SESSION["return"];
	   		        if(empty($path)) $path="/admin/";
			        echo '<META HTTP-EQUIV="Refresh" CONTENT="2; URL='.$path.'">';
				}
				else
				{
					echo "<h3>Часть с таким названием или строковым идентификатором уже добавлена!</h3>";
					$path=$site->current_part->get_path("/admin")."action-edit/finish/";
				    include($inc_path."/admin/output/part_form.php");
				}
            }
			else
		    {
			 echo "<h3>Использованы недопустимые символы в Строковом идентификаторе! Используйте латинские буквы в нижнем регистре, цифры и символы подчёркивания.</h3>";
		     $path=$site->current_part->get_path("/admin")."action-edit/finish/";
    		 include($inc_path."/admin/output/part_form.php");
		    }
		}
		else
		{
			echo "<h3>Заполните поля Название и Строковый идентификатор!</h3>";
			$path=$site->current_part->get_path("/admin")."action-edit/finish/";
		    include($inc_path."/admin/output/part_form.php");			
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
                
	           if(!$site->file_upload($file_up,$alt,$auto_preview,$site->current["part"]["id"],0,0)) echo "<h3>Ошибка загрузки файла ".$val."</h3>";
            }    
        }
		if(!empty($file_delete))
			if(!$site->file_delete($file_delete)) echo "<h3>Ошибка удаления файла</h3>";
		if(!empty($make_preview))
			if(!$site->file_preview($make_preview,$width,$height)) echo "<h3>Превью не создано</h3>";
		if(empty($file_delete) && empty($upload) && empty($make_preview))
		{
			$site->current_part->get_meta();
			$txt=$site->current_part->get_text();
			$name=$site->current_part->name;
			$list=$site->current_part->child_count;
			$sid=$site->current_part->sid;
			$idx=$site->current["part"]["main"];
			$title=$site->current_part->title;
			$description=$site->current_part->description;
			$keywords=$site->current_part->keyword;
			
		}
		
		$site->current_part->get_files();
		$file=$site->current_part->files;
		$file_count=$site->current_part->files_count;
		
		$path=$site->current_part->get_path("/admin")."action-edit/finish/";
		include($inc_path."/admin/output/part_form.php");	
	}
}
//-activate-----------------------------------------------------------------------
if($action[1]=="activate")
{
	   if(!empty($finish))
		{
		  $site->part_activate($site->current["part"]["id"]);
		  	
   		  echo "<h2>Часть успешно активирована</h2>";
   		  $path=$_SESSION["return"];
   		  if(empty($path)) $path="/admin/";
		  echo '<META HTTP-EQUIV="Refresh" CONTENT="2; URL='.$path.'">';
		  
		}	
		else
		{
        	     echo '<p><a href="'.$site->current_part->get_path("/admin").'action-activate/finish/">Действительно хотите активировать часть '.$site->current["part"]["name"].'?</a></p>';
		}		
}
//-deactivate-----------------------------------------------------------------------
if($action[1]=="deactivate")
{
	   if(!empty($finish))
		{
		  $site->part_deactivate($site->current["part"]["id"]);
		  	
   		  echo "<h2>Часть успешно деактивирована</h2>";
   		  $path=$_SESSION["return"];
   		  if(empty($path)) $path="/admin/";
		  echo '<META HTTP-EQUIV="Refresh" CONTENT="2; URL='.$path.'">';
		  
		}	
		else
		{
        	     echo '<p><a href="'.$site->current_part->get_path("/admin").'action-deactivate/finish/">Действительно хотите деактивировать часть '.$site->current["part"]["name"].'?</a></p>';
		}		
}
//-delete-----------------------------------------------------------------------
if($action[1]=="delete")
{
	   if(!empty($finish))
		{
		  $site->part_delete($site->current["part"]["id"]);
		  	
   		  echo "<h2>Часть успешно удалена</h2>";
   		  $path="/admin/";
		  echo '<META HTTP-EQUIV="Refresh" CONTENT="2; URL='.$path.'">';
		  
		}	
		else
		{
        	     echo '<p><a href="'.$site->current_part->get_path("/admin").'action-delete/finish/">Действительно хотите удалить часть '.$site->current["part"]["name"].'?</a></p>';
		}		
}
//----------------------------------------------	
}
?>