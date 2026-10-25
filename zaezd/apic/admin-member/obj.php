<?php
//--------------------------------------------------------------------------------------------------------------------------
if($smode=="add")
{
 $title="Добавить данные раздела";
 include("oform.php");	
}
//--------------------------------------------------------------------------------------------------------------------------
if($smode=="add_f")
{
  $name=$_POST["name"];
  if(!empty($name))
  {
  	 $sql = "select count(*) from apic_sobj where name='".addslashes($name).'"';
  	 $tmp=mysql_query($sql);
     
    if(mysql_result($tmp,0,0)>0)
    {
     $title="Добавить данные раздела. Использованно повторяющееся!";
     $smode="add";
     include("oform.php");
    }
    else 
    {
     $sql="select max(id_so) from apic_sobj";
     $tmp=mysql_query($sql);
     $tmp=mysql_result($tmp,0,0);
     $tmp++;
 	
  
    $sql='insert into apic_sobj values('.$tmp.',"'.addslashes($name).'")';
    mysql_query($sql);
    
    	$smode="show";	
    }
  }
  else 
  {
  	$title="Добавить данные раздела. Проверьте поля!";
  	$smode="add";
    include("oform.php");	
  }	
  
  
}
//--------------------------------------------------------------------------------------------------------------------------
if($smode=="edit")
{
 $sql = "select name from apic_sobj where id_so=".$id_so;
 $tmp=mysql_query($sql);
 
 $name=mysql_result($tmp,0,0);
 
 $title="Редактировать данные раздела";
 include("oform.php");	
}
//--------------------------------------------------------------------------------------------------------------------------
if($smode=="edit_f")
{
  $name=$_POST["name"];
  
  if(!empty($name))
  {
  	 $sql = "select count(*) from apic_sobj where name='".addslashes($name)." and id_so<>".$id_so;
  	 $tmp=mysql_query($sql);
     
    if(mysql_result($tmp,0,0)>0)
    {
     $title="Редактировать данные раздела. Использованно повторяющееся имя!";
     $smode="edit";
     include("oform.php");
    }
    else 
    {
      
     $sql='update apic_sobj set name="'.addslashes($name).'" where id_so='.$id_so;
     mysql_query($sql);
    
    	$smode="show";	
    }
  }
  else 
  {
  	$title="Редактировать данные раздела. Проверьте поля!";
  	$smode="edit";
    include("oform.php");	
  }	
  
  
}
//--------------------------------------------------------------------------------------------------------------------------
if($smode=="delete")
{
  if(!empty($_GET["id_so"])) 
  {
 	$_SESSION["id_so"]=$_GET["id_so"];
 	$id_so=$_GET["id_so"];
  }
  else $id_so=$_SESSION["id_so"];
  
 
  if($_SESSION["allowdels"]=="yes")
  {
   $sql = "delete from apic_sobj where id_so=".$id_so;
   mysql_query($sql);
   $sql = "delete from apic_obj where id_so=".$id_so;
   mysql_query($sql);
   $smode="show";
   $_SESSION["allowdels"]="no";	
  }
  else 
  {
  	 $sql = "select name from apic_sobj where id_so=".$id_so;
  	 $tmp=mysql_query($sql);
  	 $tmp=mysql_result($tmp,0,0);
  	 
  	 
  	 $_SESSION["allowdels"]="yes";	
  	 
  	 echo '<H1>Внимание! при нажатии на ссылку раздел будет ПОЛНОСТЬЮ удален из базы сайта apic.ru!</H1>';
  	 echo '<a href="/admin-member/'.$folder.'index.php?mode=obj&smode=delete&id_so='.$id_so.'">Удалить раздел '.$tmp.'</a>';  	 
  }
  
}
//--------------------------------------------------------------------------------------------------------------------------
if($smode=="show")
{
 session_unset();	

 if(!empty($_GET["id_so"])) $id_so=$_GET["id_so"];
 
 $sql="select id_so,name from apic_sobj order by id_so";
 $tmp=mysql_query($sql);
 $tmp_rows=mysql_num_rows($tmp);

  echo '<tr>'."\n";
  echo '<th  colspan="2">'."\n";	
  echo '<br><a href="/admin-member/'.$folder.'index.php?mode=obj&smode=add">Добавить раздел</a>';
  echo '</th>'."\n";
  echo '</tr>'."\n";

 
 for($i=0;$i<$tmp_rows;$i++)
 {
 	echo '<tr>'."\n";
 	echo '<td>'."\n";
  echo mysql_result($tmp,$i,1);
  echo '</td><td>'."\n";
  echo '<a href="/admin-member/'.$folder.'index.php?mode=obj&smode=edit&id_so='.mysql_result($tmp,$i,0).'">Редактировать раздел</a>';
  echo '<br /><a href="/admin-member/'.$folder.'index.php?mode=obj&smode=delete&id_so='.mysql_result($tmp,$i,0).'">Удалить раздел</a>';
  echo '</td>'."\n";
  echo '</tr>'."\n";  
 } 

}

?>