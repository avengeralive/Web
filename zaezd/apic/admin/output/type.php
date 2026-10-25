<?php
if($_SESSION["user_type"]==1)
{
//-show--------------------------------------------------------------------------
if(empty($mode[0]) && empty($action))
{
 $sql='select id_type,name,sid from '.$pr.'type order by id_type';
 $type=mysql_query($sql);
 $type_count=mysql_num_rows($type);

 echo '<h1>Типы объектов</h1>';
 echo '<p><a href="/admin/type/action-add/">Добавить тип объекта</a></p>';
  	
 for($i=0;$i<$type_count;$i++)
 {
  			echo '<div class="it"><h4><a href="/admin/type/'.mysql_result($type,$i,2).'/">'.mysql_result($type,$i,1).'</a></h4>';
			$str='<ul>';
		    $str.='<li><a href="/admin/type/'.mysql_result($type,$i,2).'/action-edit/">Редактировать</a>|</li>';
            $str.='<li><a href="/admin/type/'.mysql_result($type,$i,2).'/action-arrange/">Упорядочить поля</a>|</li>';
		    $str.='<li><a href="/admin/type/'.mysql_result($type,$i,2).'/action-assign/">Связать с частями</a>|</li>';
            $str.='<li><a href="/admin/type/'.mysql_result($type,$i,2).'/action-type/">Связать с типами объектов</a>|</li>';
		    $str.='<li><a href="/admin/type/'.mysql_result($type,$i,2).'/action-deassign/">Убрать связь с частями</a>|</li>';
		    $str.='<li class="ar"><a href="/admin/type/'.mysql_result($type,$i,2).'/action-delete/">Удалить</a></li>';
		    $str.='</ul>';
		    echo $str;
			echo '</div>';
 }
 
 $_SESSION["return"]="/admin/type/";
   	
}
//-inner--------------------------------------------------------------------------
if(!empty($mode[0]) && empty($action))
{
 $sql='select id_type,name from '.$pr.'type where sid="'.$mode[0].'"';
 $id_type=mysql_query($sql);
 $name=mysql_result($id_type,0,1);
 $id_type=mysql_result($id_type,0,0);
 
 $types=array(0  => "заголовок",1  => "число",2  => "строка",3  => "текст",4  => "дата");
 $empty=array(0  => "обязательное",1  => "не обязательное");

 echo '<h1>Элемент - '.$name.'</h1>';
 echo '<p><a href="/admin/type/'.$mode[0].'/action-field_add/">Добавить поле</a> - <a href="/admin/type/'.$mode[0].'/action-arrange/">Упорядочить поля</a></p>';
 
 $sql='select id_fld,name,type,empty from '.$pr.'field where id_type='.$id_type.' order by idx,id_fld';
 $field=mysql_query($sql);
 $field_count=mysql_num_rows($field);
  	
 for($i=0;$i<$field_count;$i++)
 {
  			echo '<div class="it"><h4>'.mysql_result($field,$i,1).' <span>Тип поля: '.$types[mysql_result($field,$i,2)].' ['.$empty[mysql_result($field,$i,3)].']</span> {'.$i.' '.mysql_result($field,$i,0).'}</h4>';
			$str='<ul>';
		    $str.='<li><a href="/admin/type/'.$mode[0].'/action-field_edit-'.mysql_result($field,$i,0).'/">Редактировать</a></li>';
		    if(mysql_result($field,$i,0)>1) $str.='<li class="ar">|<a href="/admin/type/'.$mode[0].'/action-field_delete-'.mysql_result($field,$i,0).'/">Удалить</a></li>';
		    $str.='</ul>';
		    echo $str;
			echo '</div>';
 }
 
 $_SESSION["return"]="/admin/type/".$mode[0].'/';
}
//-add---------------------------------------------------------------------------
if($action[1]=="add")
{
 if(!empty($finish))
 {
  if(!empty($name) && !empty($sid))
  {
   $cnt=preg_match_all("/([a-z0-9_]{1})/",$sid,$reg);
   if($cnt==mb_strlen($sid))
   {
	   $sql='select count(*) from '.$pr.'type where name="'.$name.'" or sid="'.$sid.'";';
	   $type_count=mysql_query($sql);
	   $type_count=mysql_result($type_count,0,0);

	   if(empty($type_count))
	   {
	   	$sql='select max(id_type) from '.$pr.'type;';
		$type_count=mysql_query($sql);
		$type_count=mysql_result($type_count,0,0);
		$type_count++;

		if(!empty($type)) $type=1;
		else $type=0;

	    $sql='INSERT INTO '.$pr.'type set id_type='.$type_count.',name="'.$name.'",sid="'.$sid.'",type='.$type;
	    mysql_query($sql);
	    $sql='INSERT INTO '.$pr.'field set id_type='.$type_count.',id_fld=1,name="Название",type=2,empty=0,idx=0';
		mysql_query($sql);
		echo "<h2>Информация о типе объекта добавлена!</h2>";
	    echo '<META HTTP-EQUIV="Refresh" CONTENT="2; URL=/admin/type/">';
	   }
	   else
	   {
		echo "<h3>Тип объекта с таким Названием или Строковым идентификатором уже добавлен!</h3>";
	    $path="/admin/type/action-add/finish/";
	   include($inc_path."admin/ooutput/type_form.php");
	   }
   }
   else
   {
        echo "<h3>Использованы недопустимые символы в Строковом идентификаторе! Используйте латинские буквы в нижнем регистре, цифры и символы подчёркивания.</h3>";
	    $path="/admin/type/action-add/finish/";
	   include($inc_path."admin/ooutput/type_form.php");
   }
  }
  else
  {
   echo "<h3>Заполните поля Название и Строковый идентификатор!</h3>";	 	
   $path="/admin/type/action-add/finish/";
   include($inc_path."admin/ooutput/type_form.php");	
  }
 }	
 else
 {
  $path="/admin/type/action-add/finish/";
  include($inc_path."admin/output/type_form.php");	
 }
}
//-edit--------------------------------------------------------------------------
if(!empty($mode[0]) && $action[1]=="edit")
{
 $sql='select id_type from '.$pr.'type where sid="'.$mode[0].'"';
 $id_type=mysql_query($sql);
 $id_type=mysql_result($id_type,0,0);
 
 if(!empty($finish))
 {
  if(!empty($name) && !empty($sid))
  {
   $sql='select count(*) from '.$pr.'type where id_type<>'.$id_type.' and (name="'.$name.'" or sid="'.$sid.'");'; 
   $type_count=mysql_query($sql);
   $type_count=mysql_result($type_count,0,0);
   
   if(empty($type_count))
   {
   	if(!empty($type)) $type=1;
   	else $type=0;
	
    $sql='update '.$pr.'type set name="'.$name.'",sid="'.$sid.'",type='.$type.' where id_type='.$id_type;
    mysql_query($sql);	
	echo "<h2>Информация о типе объекта отредактирована!</h2>";	 
    $path=$_SESSION["return"];
   	if(empty($path)) $path="/admin/type/";
	echo '<META HTTP-EQUIV="Refresh" CONTENT="2; URL='.$path.'">';	
   }
   else
   {
	echo "<h3>Тип объекта с таким Названием или Строковым идентификатором уже добавлен!</h3>";	 	
    $path="/admin/type/".$mode[0]."/action-edit/finish/";
   include($inc_path."admin/output/type_form.php");	
   }
  }
  else
  {
   echo "<h3>Заполните поля Название и Строковый идентификатор!</h3>";	 	
   $path="/admin/type/".$mode[0]."/action-edit/finish/";
   include($inc_path."admin/output/type_form.php");	
  }
 }	
 else
 {
  $sql='select * from '.$pr.'type where sid="'.$mode[0].'"';
  $type=mysql_query($sql);
  $name=mysql_result($type,0,1);
  $sid=mysql_result($type,0,2);
  $type=mysql_result($type,0,3);
  
  $path="/admin/type/".$mode[0]."/action-edit/finish/";
  include($inc_path."admin/output/type_form.php");	
 }
}
//-delete------------------------------------------------------------------------
if(!empty($mode[0]) && $action[1]=="delete")
{
	   $sql='select id_type,name from '.$pr.'type where sid="'.$mode[0].'"';
	   $id_type=mysql_query($sql);
	   $name=mysql_result($id_type,0,1);
	   $id_type=mysql_result($id_type,0,0);
	   
	   if(!empty($finish))
		{
    
		  $sql='delete from '.$pr.'type where id_type='.$id_type;
		  mysql_query($sql);
		  $sql='delete from '.$pr.'part_type where id_type='.$id_type;
		  mysql_query($sql);
		  $sql='delete from '.$pr.'field where id_type='.$id_type;
		  mysql_query($sql);
		  $sql='delete from '.$pr.'object where id_type='.$id_type;
		  mysql_query($sql);
		  $sql='delete from '.$pr.'meta where id_type='.$id_type;
		  mysql_query($sql);
		  $sql='delete from '.$pr.'values_digit where id_type='.$id_type;
		  mysql_query($sql);
		  $sql='delete from '.$pr.'values_str where id_type='.$id_type;
		  mysql_query($sql);
		  $sql='delete from '.$pr.'values_text where id_type='.$id_type;
		  mysql_query($sql);
		  $sql='delete from '.$pr.'values_date where id_type='.$id_type;
		  mysql_query($sql);
		  $sql='delete from '.$pr.'object_keyword where id_type='.$id_type;
		  mysql_query($sql);
		  $sql='delete from '.$pr.'file where id_type='.$id_type;
		  mysql_query($sql);
		  $sql='delete from '.$pr.'object_rubric where id_type='.$id_type;
		  mysql_query($sql);

       
   		  echo "<h2>Тип объекта успешно удален</h2>";
		  echo '<META HTTP-EQUIV="Refresh" CONTENT="2; URL=/admin/type/">';
		  
		}	
		else
		{
     	     echo '<p><a href="/admin/type/'.$mode[0].'/action-delete/finish/">Действительно хотите удалить тип объекта '.$name.'?</a></p>';

		}		

}
//-assign--------------------------------------------------------------------------
if(!empty($mode[0]) && $action[1]=="assign")
{
 $sql='select id_type,name from '.$pr.'type where sid="'.$mode[0].'"';
 $id_type=mysql_query($sql);
 $name=mysql_result($id_type,0,1);
 $id_type=mysql_result($id_type,0,0);
 
 if(!empty($finish))
 {
  $sql='select id_part,name from '.$pr.'part where id_part not in (select id_part from '.$pr.'part_type where id_type='.$id_type.')';
  $temp=mysql_query($sql);
  $temp_rows=mysql_num_rows($temp);
  
  
  
   for($i=0;$i<$temp_rows;$i++)
   {
		if($pt[$i]==mysql_result($temp,$i,0))
		{
			$sql='insert into '.$pr.'part_type set id_part='.mysql_result($temp,$i,0).',id_type='.$id_type;
	        mysql_query($sql);
		}		
   }
   
    echo "<h2>Связи типа объекта ".$name." с частями добавлены</h2>";
	$path=$_SESSION["return"];
   	if(empty($path)) $path="/admin/type/";
	echo '<META HTTP-EQUIV="Refresh" CONTENT="2; URL='.$path.'">';	

 }
 else
 {
  $sql='select id_part,name from '.$pr.'part where id_part not in (select id_part from '.$pr.'part_type where id_type='.$id_type.')';
  $temp=mysql_query($sql);
  $temp_count=mysql_num_rows($temp);

    $path='/admin/type/'.$mode[0].'/action-assign/finish/';
  
  	echo "<h2>Связь типа объектов ".$name." с частями</h2>";

	echo '<form action="'.$path.'" method="post" enctype="multipart/form-data" name="ae_form">'."\n";
	
	echo '<div class="it">';
    for($i=0;$i<$temp_count;$i++)
		echo '<input class="ck" name="pt['.$i.']" id="x" type="checkbox" value="'.mysql_result($temp,$i,0).'" /><label for="x">'.mysql_result($temp,$i,1).'</label>';
	echo '</div>';
	
	echo '<input type="submit" name="submit" value="Подтвердить" class="submit" />';
	
	echo '</form>'; 	
 }
}
//-type--------------------------------------------------------------------------
if(!empty($mode[0]) && $action[1]=="type")
{
 $sql='select id_type,name from '.$pr.'type where sid="'.$mode[0].'"';
 $id_type=mysql_query($sql);
 $name=mysql_result($id_type,0,1);
 $id_type=mysql_result($id_type,0,0);
 
 if(!empty($finish))
 {
  $sql='select id_type,name from '.$pr.'type where id_type!='.$id_type;
  $temp=mysql_query($sql);
  $temp_rows=mysql_num_rows($temp);
  
  $sql='delete from '.$pr.'type_type where id_type='.$id_type;
  mysql_query($sql);
  
   for($i=0;$i<$temp_rows;$i++)
   {
		if($pt[$i]==mysql_result($temp,$i,0))
		{
			$sql='insert into '.$pr.'type_type set id_type='.$id_type.',id_type_r='.mysql_result($temp,$i,0);
	        mysql_query($sql);
		}		
   }
   
    echo "<h2>Связи типа объекта ".$name." с другими типами объектов добавлены</h2>";
	$path=$_SESSION["return"];
   	if(empty($path)) $path="/admin/type/";
	echo '<META HTTP-EQUIV="Refresh" CONTENT="2; URL='.$path.'">';	

 }
 else
 {
  $sql='select id_type,name from '.$pr.'type where id_type!='.$id_type;
  $temp=mysql_query($sql);
  $temp_count=mysql_num_rows($temp);

    $path='/admin/type/'.$mode[0].'/action-type/finish/';
  
  	echo "<h2>Связь типа объектов ".$name." с другими типами объектов</h2>";

	echo '<form action="'.$path.'" method="post" enctype="multipart/form-data" name="ae_form">'."\n";
	
	echo '<div class="it">';
    for($i=0;$i<$temp_count;$i++)
    {
        $sql='select id_type from '.$pr.'type_type where id_type='.$id_type.' and id_type_r='.mysql_result($temp,$i,0);
        $tmp=mysql_query($sql);
        $tmp=mysql_result($tmp,0,0);
        
        if($tmp==$id_type) $checked=" checked";
        else unset($checked);
        
		echo '<input class="ck" name="pt['.$i.']" id="x" type="checkbox" value="'.mysql_result($temp,$i,0).'" '.$checked.'/><label for="x">'.mysql_result($temp,$i,1).'</label><br />';
    }
	echo '</div>';
	
	echo '<input type="submit" name="submit" value="Подтвердить" class="submit" />';
	
	echo '</form>'; 	
 }
}
//-field_add--------------------------------------------------------------------------
if(!empty($mode[0]) && $action[1]=="field_add")
{
 $sql='select id_type,name from '.$pr.'type where sid="'.$mode[0].'"';
 $id_type=mysql_query($sql);
 $name=mysql_result($id_type,0,1);
 $id_type=mysql_result($id_type,0,0);
 
 echo '<h1>Тип объектов - '.$name.'</h1>';
 
 if(!empty($finish))
 {
  if(!empty($nm))
  {
   $sql='select count(*) from '.$pr.'field where id_type='.$id_type.' and name="'.$nm.'";';
   $type_count=mysql_query($sql);
   $type_count=mysql_result($type_count,0,0);
   
   if(empty($type_count))
   {
   	$sql='select max(id_fld) from '.$pr.'field where id_type='.$id_type; 
	$type_count=mysql_query($sql);
	$type_count=mysql_result($type_count,0,0);
	$type_count++;
	   
	if(empty($empty)) $empty=0;
   	else $empty=1;
	
    $sql='insert into '.$pr.'field set id_type='.$id_type.',id_fld='.$type_count.',name="'.$nm.'",type='.$type.',empty='.$empty.',idx=100';
    mysql_query($sql);	
	echo "<h2>Поле добавлено!</h2>";	 
    $path="/admin/type/".$mode[0]."/";
	echo '<META HTTP-EQUIV="Refresh" CONTENT="2; URL='.$path.'">';	
   }
   else
   {
	echo "<h3>Поле с таким Названием уже добавлено в текущий тип объектов!</h3>";	 	
    $path="/admin/type/".$mode[0]."/action-field_add/finish/";
    include($inc_path."admin/output/field_form.php");	
   }
  }
  else
  {
   echo "<h3>Заполните поле Название для текущего типа объектов!</h3>";	 	
   $path="/admin/type/".$mode[0]."/action-field_add/finish/";
  include($inc_path."admin/output/field_form.php");	
  }
 }	
 else
 {
  $select[2]="selected";
  $path="/admin/type/".$mode[0]."/action-field_add/finish/";
  include($inc_path."admin/output/field_form.php");	
 }
}
//-field_edit--------------------------------------------------------------------------
if(!empty($mode[0]) && $action[1]=="field_edit")
{
 $sql='select id_type,name from '.$pr.'type where sid="'.$mode[0].'"';
 $id_type=mysql_query($sql);
 $name=mysql_result($id_type,0,1);
 $id_type=mysql_result($id_type,0,0);
 
 echo '<h1>Тип объектов - '.$name.'</h1>';
 
 if(!empty($finish))
 {
  if(!empty($nm))
  {
   $sql='select count(*) from '.$pr.'field where id_type='.$id_type.' and id_fld<>'.$action[2].' and name="'.$nm.'" ;';
   $type_count=mysql_query($sql);
   $type_count=mysql_result($type_count,0,0);
   
   if(empty($type_count))
   {
	if(empty($empty)) $empty=0;
   	else $empty=1;
	
    $sql='update '.$pr.'field set name="'.$nm.'",type='.$type.',empty='.$empty.' where id_type='.$id_type.' and id_fld='.$action[2];
    mysql_query($sql);	
	echo "<h2>Поле отредактировано!</h2>";	 
    $path="/admin/type/".$mode[0]."/";
	echo '<META HTTP-EQUIV="Refresh" CONTENT="2; URL='.$path.'">';	
   }
   else
   {
	echo "<h3>Поле с таким Названием уже добавлено в текущий тип объектов!</h3>";	 	
    $path="/admin/type/".$mode[0]."/action-field_edit-".$action[2]."/finish/";
    include($inc_path."admin/output/field_form.php");	
   }
  }
  else
  {
   echo "<h3>Заполните поле Название для текущего типа объектов!</h3>";	 	
   $path="/admin/type/".$mode[0]."/action-field_edit-".$action[2]."/finish/";
  include($inc_path."admin/output/field_form.php");	
  }
 }	
 else
 {
  $sql='select * from '.$pr.'field where id_type='.$id_type.' and id_fld='.$action[2];
  $temp=mysql_query($sql);
  $nm=mysql_result($temp,0,2);
  $select[mysql_result($temp,0,3)]="selected";
  $empty=mysql_result($temp,0,4);
  
  $path="/admin/type/".$mode[0]."/action-field_edit-".$action[2]."/finish/";
  include($inc_path."admin/output/field_form.php");	
 }
}
//-delete------------------------------------------------------------------------
if(!empty($mode[0]) && $action[1]=="field_delete")
{
	   $sql='select id_type,name from '.$pr.'type where sid="'.$mode[0].'"';
	   $id_type=mysql_query($sql);
	   $name=mysql_result($id_type,0,1);
	   $id_type=mysql_result($id_type,0,0);
	   
	   $sql='select name from '.$pr.'field where id_type='.$id_type.' and id_fld='.$action[2];
	   $fname=mysql_query($sql);
	   $fname=mysql_result($fname,0,0);
	   	   
	   echo '<h1>Тип объектов - '.$name.'</h1>';
	   
	    
	   if(!empty($finish))
		{
  		  $sql='delete from '.$pr.'field where id_type='.$id_type.' and id_fld='.$action[2];
		  mysql_query($sql);
		  $sql='delete from '.$pr.'values_digit where id_type='.$id_type.' and id_fld='.$action[2];
		  mysql_query($sql);
		  $sql='delete from '.$pr.'values_str where id_type='.$id_type.' and id_fld='.$action[2];
		  mysql_query($sql);
		  $sql='delete from '.$pr.'values_text where id_type='.$id_type.' and id_fld='.$action[2];
		  mysql_query($sql);
		  $sql='delete from '.$pr.'values_date where id_type='.$id_type.' and id_fld='.$action[2];
		  mysql_query($sql);

       
   		  echo "<h2>Поле ".$fname." успешно удалено</h2>";
   		  $path="/admin/type/".$mode[0]."/";
		  echo '<META HTTP-EQUIV="Refresh" CONTENT="2; URL='.$path.'">';
		  
		}	
		else
		{
     	     echo '<p><a href="/admin/type/'.$mode[0].'/action-field_delete-'.$action[2].'/finish/">Действительно хотите удалить поле '.$fname.'?</a></p>';

		}		

}
//-arrange-----------------------------------------------------------------------
if($action[1]=="arrange")
{
     $sql='select id_type,name from '.$pr.'type where sid="'.$mode[0].'"';
     $id_type=mysql_query($sql);
     $name=mysql_result($id_type,0,1);
     $id_type=mysql_result($id_type,0,0);
     
     $types=array(0  => "заголовок",1  => "число",2  => "строка",3  => "текст",4  => "дата");
     $empty=array(0  => "обязательное",1  => "не обязательное");
                 
	   if(!empty($finish))
		{
		  $sql='select id_fld,name,idx from '.$pr.'field where id_type='.$id_type.' order by idx,id_fld';
             $field=mysql_query($sql);
             $field_count=mysql_num_rows($field);
              	
             for($i=0;$i<$field_count;$i++)
             {
                $sql='update '.$pr.'field set idx='.$idxs[$i].' where id_type='.$id_type.' and id_fld='.mysql_result($field,$i,0);
                mysql_query($sql);
             }
		  	
   		  echo "<h2>Поля успешно упорядочены</h2>";
   		  $path=$_SESSION["return"];
   		  if(empty($path)) $path='/admin/type/'.$mode[0].'/';
		  echo '<META HTTP-EQUIV="Refresh" CONTENT="2; URL='.$path.'">';
		  
		}	
		else
		{
                 echo '<h1>Тип объекта - '.$name.'</h1>';
                
                $path='/admin/type/'.$mode[0].'/action-arrange/finish/';
								
				 echo '<form action="'.$path.'" method="post" enctype="multipart/form-data" name="ae_form">'."\n";
				 echo '<div id="cbaa"><h2>Упорядочить поля</h2>';

                
                 $sql='select id_fld,name,idx from '.$pr.'field where id_type='.$id_type.' order by idx,id_fld';
                 $field=mysql_query($sql);
                 $field_count=mysql_num_rows($field);
                  	
                 for($i=0;$i<$field_count;$i++)
                 {
                    
                    echo '<div class="it">';
					echo '<label for="x">'.mysql_result($field,$i,1).'</label><br />';
					echo '<input class="w450" name="idxs['.$i.']" id="x" type="text" value="'.mysql_result($field,$i,2).'" />';
					echo '</div>';
                 }
                 
                 
				echo '<input type="submit" name="submit" value="Подтвердить" class="submit" />';

				echo '</form></div><!--cbaa-->';
                
                $_SESSION["return"]="/admin/type/".$mode[0].'/'; 
		}		
}
//------------------------------------------------------------------------------
}
?>
