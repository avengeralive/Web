<?php
if($_SESSION["user_type"]==1)
{
//-show--------------------------------------------------------------------------
if(empty($mode[0]) && empty($action))
{
 $sql='select id_key,word,sid from '.$pr.'keyword order by word';
 $keywords=mysql_query($sql);
 $keywords_count=mysql_num_rows($keywords);
 
 echo '<h1>Управление темами</h1>';
 
 echo '<p><a href="/admin/temy/action-add/">Добавить тему</a></p>';
 
 for($i=0;$i<$keywords_count;$i++)
 {
			echo '<div class="it"><h4>'.mysql_result($keywords,$i,1).'</h4>';
			$str='<ul>';
		    $str.='<li><a href="/admin/temy/'.mysql_result($keywords,$i,2).'/action-edit/">Редактировать</a>|</li>';
		    $str.='<li class="ar"><a href="/admin/temy/'.mysql_result($keywords,$i,2).'/action-delete/">Удалить</a></li>';
		    $str.='</ul>';
		    echo $str;
			echo '</div>';
 }
 
}
//-edit-----------------------------------------------------------------------
if($action[1]=="edit")
{
	$keyword=$site->current_keyword;
	
	if(!empty($finish))
	{
		if(!empty($word) && !empty($sid))
		{
            $cnt=preg_match_all("/([a-z0-9_]{1})/",$sid,$reg);
   			if($cnt==mb_strlen($sid))
   			{
				$fields["word"]=$word;
				$fields["sid"]=$sid;
				$fields["txt"]=$txt;
				$fields["title"]=$title;
				$fields["description"]=$description;
				$fields["keywords"]=$keywords;

				if($site->edit_keyword($fields))
				{
					echo "<h2>Тема успешно отредактирована</h2>";
	   		        if(empty($path)) $path='/admin/temy/';
			        echo '<META HTTP-EQUIV="Refresh" CONTENT="2; URL='.$path.'">';
				}
				else
				{
					echo "<h3>Тема с таким названием или строковым идентификатором уже добавлена!</h3>";
					$path=$keyword->get_path("/admin").'action-edit/finish/';
				    include($inc_path."/admin/output/keyword_form.php");
				}
            }
			else
		    {
			 echo "<h3>Использованы недопустимые символы в Строковом идентификаторе! Используйте латинские буквы в нижнем регистре, цифры и символы подчёркивания.</h3>";
		     $path=$keyword->get_path("/admin").'action-edit/finish/';
             include($inc_path."/admin/output/keyword_form.php");
		    }
		}
		else
		{
			echo "<h3>Заполните поля Название и Строковый идентификатор!</h3>";
			$path=$keyword->get_path("/admin").'action-edit/finish/';
		    include($inc_path."/admin/output/keyword_form.php");		
		}	
	}
	else
	{
		$keyword->get_meta();
		$word=$keyword->word;
		$sid=$keyword->sid;
		$txt=$keyword->get_text();
		$title=$keyword->title;
		$description=$keyword->description;
		$keywords=$keyword->keyword;
		
		$path=$keyword->get_path("/admin").'action-edit/finish/';
		include($inc_path."/admin/output/keyword_form.php");	
	}
}
//-delete------------------------------------------------------------------------
if($action[1]=="delete")
{
   $keyword=$site->current_keyword;	
   if(!empty($finish))
	{
	  $site->keyword_delete($keyword->id_key);
	  	
	  echo "<h2>Тема успешно удалена</h2>";
	  $path="/admin/temy/";
	  echo '<META HTTP-EQUIV="Refresh" CONTENT="2; URL='.$path.'">';
	  
	}	
	else
	{
    	     echo '<p><a href="'.$keyword->get_path("/admin").'action-delete/finish/">Действительно хотите удалить тему '.$keyword->word.'?</a></p>';
	}	
}
//-add---------------------------------------------------------------------------
if($action[1]=="add")
{
	if(!empty($finish))
	{
		if(!empty($word) && !empty($sid))
		{
            $cnt=preg_match_all("/([a-z0-9_]{1})/",$sid,$reg);
   			if($cnt==mb_strlen($sid))
   			{
				$fields["word"]=$word;
				$fields["sid"]=$sid;
				$fields["txt"]=$txt;
				$fields["title"]=$title;
				$fields["description"]=$description;
				$fields["keywords"]=$keywords;

				if($site->new_keyword($fields))
				{
					echo "<h2>Тема успешно добавлена</h2>";
					$path=$_SESSION["return"];
	   		        if(empty($path)) $path="/admin/temy/";
			        echo '<META HTTP-EQUIV="Refresh" CONTENT="2; URL='.$path.'">';
				}
				else
				{
					echo "<h3>Тема с таким названием или строковым идентификатором уже добавлена!</h3>";
					$path='/admin/temy/action-add/finish/';
				    include($inc_path."/admin/output/keyword_form.php");
				}
            }
			else
		    {
			 echo "<h3>Использованы недопустимые символы в Строковом идентификаторе! Используйте латинские буквы в нижнем регистре, цифры и символы подчёркивания.</h3>";
		     $path='/admin/temy/action-add/finish/';
             include($inc_path."/admin/output/keyword_form.php");
		    }
		}
		else
		{
			echo "<h3>Заполните поля Название и Строковый идентификатор!</h3>";
			$path='/admin/temy/action-add/finish/';
            include($inc_path."/admin/output/keyword_form.php");		
		}	
	}
	else
	{
		$path='/admin/temy/action-add/finish/';
        include($inc_path."/admin/output/keyword_form.php");
	}
}
//-------------------------------------------------------------------------------
}
?> 