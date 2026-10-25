<?php
if($_SESSION["user_type"]==1)
{
//-show--------------------------------------------------------------------------
if(empty($mode[0]) && empty($action))
{
 $sql='select id_user,login,name,mail,type from '.$pr.'user order by type, login';
 $users=mysql_query($sql);
 $users_count=mysql_num_rows($users);
 
 echo '<div class="addwork"><h1>Пользователи</h1><p><a class="button" href="'.$base_url.'user/action-add/">Добавить пользователя</a></p></div>';

 echo '<table class="list"><tr><th>Имя</th><th>Редактировать</th><th>Деактивировать</th><th>Удалить</th></tr>';
 
 for($i=0;$i<$users_count;$i++)
 {
  			$type=mysql_result($users,$i,4);
  			if($type>9) $str=$utype[$type/10].' - не активен';
  			else $str=$utype[$type];
			  
			echo '<tr><td><a href="'.$base_url.'user/'.mysql_result($users,$i,0).'/action-profile/">'.mysql_result($users,$i,1).'</a><span> ['.$str.']</span></td>';
		    echo '<td><a href="'.$base_url.'user/'.mysql_result($users,$i,0).'/action-profile/"><img src="'.$base_url.'files/i-edit.gif" alt="Редактировать"/></a></td>';
		    if($type>9) echo '<td><a href="'.$base_url.'user/'.mysql_result($users,$i,0).'/action-activate/"><img src="'.$base_url.'files/i-activate.gif" alt="Активировать"/></a></td>';
		    else echo '<td><a href="'.$base_url.'user/'.mysql_result($users,$i,0).'/action-deactivate/"><img src="'.$base_url.'files/i-deactivate.gif" alt="Деактивировать"/></a></td>';
		    echo '<td><a href="'.$base_url.'user/'.mysql_result($users,$i,0).'/action-delete/"><img src="'.$base_url.'files/i-delete.gif" alt="Удалить"/></a></td>';
 }
 echo '</table>';
}
//-profile-----------------------------------------------------------------------
if($action[1]=="profile")
{
		if(!empty($finish))
		{
		 if(!empty($loginf) && !empty($name))
		 {
		  $sql='select count(*) from '.$pr.'user where login="'.$loginf.'" anf id_user<>'.$mode[0]; 
		  $user_count=mysql_query($sql);
		  $user_count=mysql_result($user_count,0,0);
		  if(empty($user_count))
		  {	
			  $sql='update '.$pr.'user set login="'.$loginf.'",name="'.$name.'",mail="'.$loginf.'",type='.$access;
			  
			  if(!empty($pass1) && $pass1==$pass2) $sql.=',pass=password("'.$pass1.'")';
			  $sql.=' where id_user='.$mode[0];		
			  mysql_query($sql);
		  
		  
		  echo "<h2>Пользователь отредактирован</h2>";
		  echo '<META HTTP-EQUIV="Refresh" CONTENT="2; URL='.$base_url.'user/">';
		  }
		   else
		   {
		    echo "<h3>Такой email уже существует!</h3>";		
		    $path=$base_url."user/".$mode[0]."/action-profile/finish/";	
		    include($inc_path."output/user_form.php");
		   }
	  
		 }	
		 else
		 {	
		  echo "<h3>Заполните поля!</h3>";	
		  $path=$base_url."user/".$mode[0]."/action-profile/finish/";	
		  include($inc_path."output/user_form.php");
		 }
		}
		else 
		{
			$sql='select login,name,mail,type from '.$pr.'user where id_user='.$mode[0];
 			$users=mysql_query($sql);
 			$loginf=mysql_result($users,0,0);
 			$name=mysql_result($users,0,1);
 			$type=mysql_result($users,0,3);
 			$check[$type]=" checked";
			
			$path=$base_url."user/".$mode[0]."/action-profile/finish/";
		    include($inc_path."output/user_form.php"); 
		}
}
//-delete------------------------------------------------------------------------
if($action[1]=="delete")
{
	if(!empty($mode[0]))
	{
	   if(!empty($finish))
		{
		  	$sql='delete from '.$pr.'user where id_user='.$mode[0];
			mysql_query($sql);
			  
		  echo "<h2>Пользователь успешно удалён</h2>";
		  echo '<META HTTP-EQUIV="Refresh" CONTENT="2; URL='.$base_url.'user/">';		 		
		}	
		else
		{
	     $sql='select login from '.$pr.'user where id_user='.$mode[0];
	     $user=mysql_query($sql);
	     
	     $login=mysql_result($user,0,0);
		 
		 if(!empty($login))
        	     echo '<p><a href="'.$base_url.'user/'.$mode[0].'/action-delete/finish/">Действительно хотите удалить пользователя '.$login.'?</a></p>';
         else
         {
		   echo "<h2>Пользователь не найден</h2>";
		  echo '<META HTTP-EQUIV="Refresh" CONTENT="2; URL='.$base_url.'user/">';		
		 }	
		}		
	}	
}
//-activate------------------------------------------------------------------------
if($action[1]=="activate")
{
	if(!empty($mode[0]))
	{
	   if(!empty($finish))
		{
		  	 $sql='select type from '.$pr.'user where id_user='.$mode[0];
	     $user=mysql_query($sql);
	     $type=mysql_result($user,0,0);
			  
			  if($type>9) {
			  $sql='update '.$pr.'user set type='.($type/10).' where id_user='.$mode[0];
			mysql_query($sql);}
			  
		  
		  echo "<h2>Пользователь успешно активирован</h2>";
		  echo '<META HTTP-EQUIV="Refresh" CONTENT="2; URL='.$base_url.'user/">';		 		
		}	
		else
		{
	     $sql='select login from '.$pr.'user where id_user='.$mode[0];
	     $user=mysql_query($sql);
	     
	     $login=mysql_result($user,0,0);
		 
		 if(!empty($login))
        	     echo '<p><a href="'.$base_url.'user/'.$mode[0].'/action-activate/finish/">Действительно хотите активировать пользователя '.$login.'?</a></p>';
         else
         {
		   echo "<h2>Пользователь не найден</h2>";
		  echo '<META HTTP-EQUIV="Refresh" CONTENT="2; URL='.$base_url.'user/">';		
		 }	
		}		
	}	
}
//-deactivate------------------------------------------------------------------------
if($action[1]=="deactivate")
{
	if(!empty($mode[0]))
	{
	   if(!empty($finish))
		{
		  	$sql='select type from '.$pr.'user where id_user='.$mode[0];
		 $user=mysql_query($sql);
	     $type=mysql_result($user,0,0);
			  
			  if($type<9) {
			  $sql='update '.$pr.'user set type='.($type*10).' where id_user='.$mode[0];
			mysql_query($sql);}
			  
		  
		  echo "<h2>Пользователь успешно деактивирован</h2>";	
		  echo '<META HTTP-EQUIV="Refresh" CONTENT="2; URL='.$base_url.'user/">';	 		
		}	
		else
		{
	     $sql='select login from '.$pr.'user where id_user='.$mode[0];
	     $user=mysql_query($sql);
	     
	     $login=mysql_result($user,0,0);
		 
		 if(!empty($login))
        	     echo '<p><a href="'.$base_url.'user/'.$mode[0].'/action-deactivate/finish/">Действительно хотите деактивировать пользователя '.$login.'?</a></p>';
         else
         {
		   echo "<h2>Пользователь не найден</h2>";
		  echo '<META HTTP-EQUIV="Refresh" CONTENT="2; URL='.$base_url.'user/">';		
		 }	
		}		
	}	
}
//-add---------------------------------------------------------------------------
if($action[1]=="add")
{
		if(!empty($finish))
		{
	     if(!empty($loginf) && !empty($name) && !empty($pass1) && !empty($pass2))
		 {
		  if($pass1==$pass2) 
		  {	
		  $sql='select count(*) from '.$pr.'user where login="'.$loginf.'";'; 
		  $user_count=mysql_query($sql);
		  $user_count=mysql_result($user_count,0,0);
		  if(empty($user_count))
		  {	
		  	$sql='select max(id_user) from '.$pr.'user;'; 
		    $user_count=mysql_query($sql);
		    $user_count=mysql_result($user_count,0,0);
		    $user_count++;
		    
		  $sql='INSERT INTO '.$pr.'user set id_user='.$user_count.',login="'.$loginf.'",pass=password("'.$pass1.'"),name="'.$name.'",mail="'.$loginf.'",type='.$access;
		  mysql_query($sql);
		  
		  echo "<h2>Пользователь добавлен</h2>";
		  echo '<META HTTP-EQUIV="Refresh" CONTENT="2; URL='.$base_url.'user/">';
		  }
		   else
		   {
		    echo "<h3>Такой email уже существует!</h3>";		
		    $path=$base_url."user/action-add/finish/";	
		    include($inc_path."output/user_form.php");
		   }
		  }
		  else 
		  {
		  	echo "<h3>Введённые пароли не совпадают!</h3>";
		   	
		   $path=$base_url."user/action-add/finish/";	
		    include($inc_path."output/user_form.php");	
		  }
		 }	
		 else
		 {	
		  echo "<h3>Заполните поля!</h3>";	
		  $path=$base_url."user/action-add/finish/";	
		  include($inc_path."output/user_form.php");
		 }
		}
		else 
		{
			$path=$base_url."user/action-add/finish/";	
		    include($inc_path."output/user_form.php"); 
		}
}
//-------------------------------------------------------------------------------
}
?> 