<?php
if($_SESSION["user_type"]==1 || $_SESSION["user_type"]==2)
{
//-show--------------------------------------------------------------------------
if(empty($mode[0]) && empty($action))
{
 $sql='select id_list,name from '.$pr.'list where id_user='.addslashes($_SESSION["user_id"]).' order by name';
 $lists=mysql_query($sql);
 $lists_count=mysql_num_rows($lists);
 
 echo '<div class="addwork"><h1>Списки адресатов</h1><p><a class="button" href="'.$base_url.'list/action-add/">Добавить список</a></p></div>';

 echo '<table class="list"><tr><th>Название</th><th>Редактировать</th><th>Удалить</th></tr>';
 
 for($i=0;$i<$lists_count;$i++)
 {
			echo '<tr><td><a href="'.$base_url.'list/'.mysql_result($lists,$i,0).'/action-edit/">'.mysql_result($lists,$i,1).'</a></td>';
		    echo '<td><a href="'.$base_url.'list/'.mysql_result($lists,$i,0).'/action-edit/"><img src="'.$base_url.'files/i-edit.gif" alt="Редактировать"/></a></td>';
		    echo '<td><a href="'.$base_url.'list/'.mysql_result($lists,$i,0).'/action-delete/"><img src="'.$base_url.'files/i-delete.gif" alt="Удалить"/></a></td>';
 }
 echo '</table>';
}
//-edit-----------------------------------------------------------------------
if($action[1]=="edit")
{
		if(!empty($finish))
		{
		 if(!empty($list) && !empty($name))
		 {
		  $sql='select id_list from '.$pr.'list where name="'.addslashes($name).'"'; 
		  $elist=mysql_query($sql);
		  $id_list=mysql_result($elist,0,0);
		  if($id_list==$mode[0])
		  {	
			  $sql='update '.$pr.'list set name="'.$name.'" where id_list='.$id_list;
			  mysql_query($sql);
              
              $sql='delete from '.$pr.'mail where type>-1 and id_list='.$id_list;
	          mysql_query($sql);
              
              $array = explode("\n",$list);
               
              foreach ($array as $value) 
              {
                  $value=trim($value);
                  $value=trim($value,"\xA0\xC2");
                  
                  if(!empty($value))
    	          {
                    $sql='select count(*) from '.$pr.'mail where mail="'.addslashes($value).'" and id_list='.addslashes($id_list).';'; 
                    $mail_count=mysql_query($sql);
                    $mail_count=mysql_result($mail_count,0,0);
                    
                    if(empty($mail_count))
                    {
                        $sql='INSERT INTO '.$pr.'mail set id_list='.addslashes($id_list).',mail="'.addslashes($value).'",type=1';
    		            mysql_query($sql);
                    } 
                  }
              }
              
              $sql='delete from '.$pr.'user_list where id_list='.addslashes($id_list);
	          mysql_query($sql);
              
              foreach ($access as $value) 
              {
                  $sql='insert into '.$pr.'user_list set id_user='.addslashes($value).', id_list='.addslashes($id_list);
        		  mysql_query($sql);  
              }
                            
		  
		  echo "<h2>Список отредактирован</h2>";
		  echo '<META HTTP-EQUIV="Refresh" CONTENT="2; URL='.$base_url.'list/">';
		  }
		   else
		   {
		    echo "<h3>Такой список уже существует!</h3>";		
		    $path=$base_url."list/".addslashes($mode[0])."/action-edit/finish/";	
		    include($inc_path."output/list_form.php");
		   }
	  
		 }	
		 else
		 {	
		  echo "<h3>Заполните поля!</h3>";	
		  $path=$base_url."list/".addslashes($mode[0])."/action-edit/finish/";	
		  include($inc_path."output/list_form.php");
		 }
		}
		else 
		{
			$sql='select id_list,name from '.$pr.'list where id_list='.addslashes($mode[0]).' and id_user='.addslashes($_SESSION["user_id"]).';';
 			$list=mysql_query($sql);
 			$id_list=mysql_result($list,0,0);
            $name=mysql_result($list,0,1);
            
            $sql='select mail from '.$pr.'mail where id_list='.$id_list.' and type>-1 order by mail';
            $mails=mysql_query($sql);
            $mail_count=mysql_num_rows($mails);
            
            unset($list);
            for($i=0;$i<$mail_count;$i++)
            {
                if($i>0) $list.="\n";
                $list.=mysql_result($mails,$i,0);
            }
			
			$path=$base_url."list/".$mode[0]."/action-edit/finish/";
		    include($inc_path."output/list_form.php"); 
		}
}
//-delete------------------------------------------------------------------------
if($action[1]=="delete")
{
	if(!empty($mode[0]))
	{
	   if(!empty($finish))
		{
		  	$sql='delete from '.$pr.'list where id_list='.addslashes($mode[0]).' and id_user='.addslashes($_SESSION["user_id"]).';';
			mysql_query($sql);
            $arows=mysql_affected_rows();
            
            if($arows>0)
            {
                $sql='delete from '.$pr.'mail where id_list='.$mode[0];
			    mysql_query($sql);
            }
			  
		  echo "<h2>Список успешно удалён</h2>";
		  echo '<META HTTP-EQUIV="Refresh" CONTENT="2; URL='.$base_url.'list/">';		 		
		}	
		else
		{
	     $sql='select name from '.$pr.'list where id_list='.addslashes($mode[0]).' and id_user='.addslashes($_SESSION["user_id"]).';';
	     $list=mysql_query($sql);
	     
	     $name=mysql_result($list,0,0);
		 
		 if(!empty($name))
        	     echo '<p><a href="'.$base_url.'list/'.addslashes($mode[0]).'/action-delete/finish/">Действительно хотите удалить список '.$name.'?</a></p>';
         else
         {
		   echo "<h2>Список не найден</h2>";
		  echo '<META HTTP-EQUIV="Refresh" CONTENT="2; URL='.$base_url.'list/">';		
		 }	
		}		
	}	
}
//-add---------------------------------------------------------------------------
if($action[1]=="add")
{
		if(!empty($finish))
		{
	     if(!empty($name) && !empty($list))
		 {
		  $sql='select count(*) from '.$pr.'list where name="'.addslashes($name).'" and id_user='.addslashes($_SESSION["user_id"]).';'; 
		  $list_count=mysql_query($sql);
		  $list_count=mysql_result($list_count,0,0);
		  if(empty($list_count))
		  {	
		  $sql='INSERT INTO '.$pr.'list set id_user='.addslashes($_SESSION["user_id"]).',name="'.addslashes($name).'"';
		  mysql_query($sql);
          $id_list=mysql_insert_id();
          
          $array = explode("\n",$list);
          
          foreach ($array as $value) 
          {
              $value=trim($value);
              $value=trim($value,"\xA0\xC2");
              
              if(!empty($value))
	          {
                $sql='select count(*) from '.$pr.'mail where mail="'.addslashes($value).'" and id_list='.addslashes($id_list).';'; 
                $mail_count=mysql_query($sql);
                $mail_count=mysql_result($mail_count,0,0);
                
                if(empty($mail_count))
                {
                    $sql='INSERT INTO '.$pr.'mail set id_list='.addslashes($id_list).',mail="'.addslashes($value).'",type=1';
		            mysql_query($sql);
                } 
              }
          }
          
          foreach ($access as $value) 
          {
              $sql='insert into '.$pr.'user_list set id_user='.addslashes($value).', id_list='.addslashes($id_list);
    		  mysql_query($sql);  
          }
		  
		  echo "<h2>Список добавлен</h2>";
		  echo '<META HTTP-EQUIV="Refresh" CONTENT="2; URL='.$base_url.'list/">';
		  }
		   else
		   {
		    echo "<h3>Такой список уже существует!</h3>";		
		    $path=$base_url."list/action-add/finish/";	
		    include($inc_path."output/list_form.php");
		   }
		 }	
		 else
		 {	
		  echo "<h3>Заполните поля!</h3>";	
		  $path=$base_url."list/action-add/finish/";	
		  include($inc_path."output/list_form.php");
		 }
		}
		else 
		{
			$path=$base_url."list/action-add/finish/";	
		    include($inc_path."output/list_form.php"); 
		}
}
//-------------------------------------------------------------------------------
}
?> 