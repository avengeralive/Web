<?php
if($_SESSION["user_type"]==1)
{
//-----show-------------------------------------
if(empty($site->current_rubric) && empty($action))
{
		$part=$site->current_part;
		
		echo '<h1>'.$part->name.'</h1>';
		echo '<p><a href="'.$part->get_path("/admin/rubric").'action-rubric_add/">Добавить рубрику</a> - <a href="'.$part->get_path("/admin/rubric").'action-arrange/">Упорядочить рубрики</a></p>';
		
		$part->get_rubric();
		
		for($j=0;$j<$part->rubric_count;$j++)
		{
			$rubric=$part->rubric[$part->rubric_index[$j]];
			echo '<div class="it"><h4><a href="'.$rubric->get_path("/admin").'">'.$rubric->name.'</a> <span>{'.$rubric->id_r.'} (<a href="'.$rubric->get_path().'" target="_blank">просмотреть</a>)</span></h4>';
			echo $rubric->actions("/admin");
			echo '</div>';
		}
		
		$_SESSION["return"]=$part->get_path("/admin/rubric");
}
//-----show-inner-------------------------------------
if(!empty($site->current_rubric) && empty($action))
{
	$part=$site->current_part;
	
	echo '<h1>'.$part->name.'</h1>';

	$rubric=$site->current_rubric;
		
	echo '<div class="it"><h4><a href="'.$rubric->get_path("/admin").'">'.$rubric->name.'</a><span>{'.$rubric->id_r.'} (<a href="'.$rubric->get_path().'" target="_blank">просмотреть</a>)</span></h4>';
	echo $rubric->actions("/admin");
	echo '<br /><ul><li><a href="'.$rubric->get_path("/admin").'action-rubric_add/">Добавить подрубрику</a></li></ul>';
	echo '</div>';
		
	$rubric->get_rubric();
	
	for($j=0;$j<$rubric->rubric_count;$j++)
	{
		$rubric1=$rubric->rubric[$rubric->rubric_index[$j]];
		echo '<div class="it m10 dea"><h4><a href="'.$rubric1->get_path("/admin").'">'.$rubric1->name.'</a> <span>{'.$rubric1->id_r.'} (<a href="'.$rubric1->get_path().'" target="_blank">просмотреть</a>)</span></h4>';
		echo $rubric1->actions("/admin");
		echo '</div>';
	}
	
	$_SESSION["return"]=$rubric->get_path("/admin");
}
//-----add-------------------------------------
if($action[1]=="rubric_add")
{
	$part=$site->current_part;
	$rubric=$site->current_rubric;
	
	if(!empty($finish))
	{
		if(!empty($name) && !empty($sid))
		{
            $cnt=preg_match_all("/([a-z0-9_]{1})/",$sid,$reg);
   			if($cnt==mb_strlen($sid))
   			{
   			    $list=$_POST["list"];
				if(empty($list)) $list=0;
				$fields["name"]=$_POST["name"];
				$fields["sid"]=$sid;
				$fields["txt"]=$txt;
				$fields["list"]=$list;
				$fields["title"]=$title;
				$fields["description"]=$description;
				$fields["keywords"]=$keywords;

				if($site->new_rubric($fields))
				{
					echo "<h2>Рубрика успешно добавлена</h2>";
					$path=$_SESSION["return"];
	   		        if(empty($path)) $path=$part->get_path("/admin/rubric");
			        echo '<META HTTP-EQUIV="Refresh" CONTENT="2; URL='.$path.'">';
				}
				else
				{
					echo "<h3>Рубрика с таким названием или строковым идентификатором уже добавлена!</h3>";
					if(!empty($rubric)) $path=$rubric->get_path("/admin").'action-rubric_add/finish/';
			    	else $path=$part->get_path("/admin/rubric").'action-rubric_add/finish/';
				    include($inc_path."/admin/output/rubric_form.php");
				}
            }
			else
		    {
			 echo "<h3>Использованы недопустимые символы в Строковом идентификаторе! Используйте латинские буквы в нижнем регистре, цифры и символы подчёркивания.</h3>";
		     if(!empty($rubric)) $path=$rubric->get_path("/admin").'action-rubric_add/finish/';
			 else $path=$part->get_path("/admin/rubric").'action-rubric_add/finish/';
			 include($inc_path."/admin/output/rubric_form.php");
		    }
		}
		else
		{
			echo "<h3>Заполните поля Название и Строковый идентификатор!</h3>";
			if(!empty($rubric)) $path=$rubric->get_path("/admin").'action-rubric_add/finish/';
		    else $path=$part->get_path("/admin/rubric").'action-rubric_add/finish/';
		    include($inc_path."/admin/output/rubric_form.php");		
		}	
	}
	else
	{
		if(!empty($rubric)) $path=$rubric->get_path("/admin").'action-rubric_add/finish/';
		else $path=$part->get_path("/admin/rubric").'action-rubric_add/finish/';
		include($inc_path."/admin/output/rubric_form.php");	
	}
}
//-----edit-------------------------------------
if(!empty($site->current_rubric) && $action[1]=="edit")
{
	$part=$site->current_part;
	$rubric=$site->current_rubric;
	
	if(!empty($finish))
	{
		if(!empty($name) && !empty($sid))
		{
            $cnt=preg_match_all("/([a-z0-9_]{1})/",$sid,$reg);
   			if($cnt==mb_strlen($sid))
   			{
				$list=$_POST["list"];
				if(empty($list)) $list=0;

				$fields["name"]=$_POST["name"];
				$fields["sid"]=$sid;
				$fields["txt"]=$txt;
				$fields["list"]=$list;
				$fields["title"]=$title;
				$fields["description"]=$description;
				$fields["keywords"]=$keywords;

				if($site->edit_rubric($fields))
				{
					echo "<h2>Рубрика успешно отредактирована</h2>";
					$path=$_SESSION["return"];
	   		        if(empty($path)) $path=$rubric->get_path("/admin").'action-edit/finish/';
			        echo '<META HTTP-EQUIV="Refresh" CONTENT="2; URL='.$path.'">';
				}
				else
				{
					echo "<h3>Рубрика с таким названием или строковым идентификатором уже добавлена!</h3>";
					$path=$rubric->get_path("/admin").'action-edit/finish/';
				    include($inc_path."/admin/output/rubric_form.php");
				}
            }
			else
		    {
			 echo "<h3>Использованы недопустимые символы в Строковом идентификаторе! Используйте латинские буквы в нижнем регистре, цифры и символы подчёркивания.</h3>";
		     $path=$rubric->get_path("/admin").'action-edit/finish/';
             include($inc_path."/admin/output/rubric_form.php");
		    }
		}
		else
		{
			echo "<h3>Заполните поля Название и Строковый идентификатор!</h3>";
			$path=$rubric->get_path("/admin").'action-edit/finish/';
		    include($inc_path."/admin/output/rubric_form.php");		
		}	
	}
	else
	{
		$site->current_rubric->get_meta();
		$name=$site->current_rubric->name;
		$sid=$site->current_rubric->sid;
		$txt=$site->current_rubric->get_text();
		$title=$site->current_rubric->title;
		$description=$site->current_rubric->description;
		$keywords=$site->current_rubric->keyword;
		$list=$site->current_rubric->child_count;
		
		$path=$rubric->get_path("/admin").'action-edit/finish/';
		include($inc_path."/admin/output/rubric_form.php");	
	}
}
//-delete-----------------------------------------------------------------------
if(!empty($site->current_rubric) && $action[1]=="delete")
{
	   $part=$site->current_part;
	   $rubric=$site->current_rubric;	
	   if(!empty($finish))
		{
		  $site->rubric_delete($site->current["part"]["id"],$site->current["rubric"]["id"]);
		  	
   		  echo "<h2>Рубрика успешно удалена</h2>";
   		  $path=$part->get_path("/admin/rubric");
		  echo '<META HTTP-EQUIV="Refresh" CONTENT="2; URL='.$path.'">';
		  
		}	
		else
		{
        	     echo '<p><a href="'.$rubric->get_path("/admin").'action-delete/finish/">Действительно хотите удалить рубрику '.$site->current["rubric"]["name"].'?</a></p>';
		}		
}
//-arrange-----------------------------------------------------------------------
if($action[1]=="arrange")
{
	   if(!empty($finish))
		{
		  $site->arrange_rubric($idxs);
		  	
   		  echo "<h2>Рубрики успешно упорядочены</h2>";
   		  $path=$_SESSION["return"];
   		  if(empty($path)) $path=$site->current_part->get_path("/admin/rubric");
		  echo '<META HTTP-EQUIV="Refresh" CONTENT="2; URL='.$path.'">';
		  
		}	
		else
		{
        	    if(empty($site->current_rubric)) $path=$site->current_part->get_path("/admin/rubric").'action-arrange/finish/';
				else $path=$site->current_rubric->get_path("/admin").'action-arrange/finish/';
				
				 echo '<form action="'.$path.'" method="post" enctype="multipart/form-data" name="ae_form">'."\n";
				 echo '<div id="cbaa"><h2>Дочерние рубрики</h2>';

				$part=$site->current_part;
				if(empty($site->current_rubric))
					$parent=$site->current_part;
				else
					$parent=$site->current_rubric;
				
				$parent->get_rubric();
				
				for($i=0;$i<$parent->rubric_count;$i++)
				{
					$id=$parent->rubric_index[$i];
					$obj1=$parent->rubric[$id];
					
					echo '<div class="it">';
					echo '<label for="x">'.$obj1->name.'</label><br />';
					echo '<input class="w450" name="idxs['.$i.']" id="x" type="text" value="'.$obj1->get_idx().'" />';
					echo '</div>';
				}
				echo '<input type="submit" name="submit" value="Подтвердить" class="submit" />';

				echo '</form></div><!--cbaa-->'; 
		}		
}
//----------------------------------------------	
}
?>