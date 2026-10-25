<?php
//--------------------------------------------------------------------------------------------------------------------------
if($smode=="add")
{
 $_SESSION["parent"]=$_GET["parent"];
 $parent=$_SESSION["parent"];
 
 $title="Добавить данные группы";
 include("sform.php");	
}
//--------------------------------------------------------------------------------------------------------------------------
if($smode=="add_f")
{
  $name=$_POST["name"];
  $name_en=$_POST["name_en"];
  $sid=$_POST["sid"];
  $parent=$_SESSION["parent"];
  if(empty($parent)) $parent=0;
  
  if(!empty($sid) && !empty($name))
  {
  	 $sql = "select count(*) from apic_section where parent=".$parent." and (sid='".addslashes($sid)."' or name='".addslashes($name)."')";
  	 $tmp=mysql_query($sql);
     
    if(mysql_result($tmp,0,0)>0)
    {
     $title="Добавить данные группы. Использованно повторяющееся имя или идентификатор!";
     $smode="add";
     include("sform.php");
    }
    else 
    {
     $sql="select max(id_s) from apic_section";
     $tmp=mysql_query($sql);
     $tmp=mysql_result($tmp,0,0);
     $tmp++;
 	
  
    $sql='insert into apic_section values('.$tmp.',"'.addslashes($name).'","'.addslashes($name_en).'","'.addslashes($sid).'",'.$parent.',0)';
    mysql_query($sql);
    
    	$smode="show";	
    }
  }
  else 
  {
  	$title="Добавить данные группы. Проверьте поля!";
  	$smode="add";
    include("sform.php");	
  }	
  
  
}
//--------------------------------------------------------------------------------------------------------------------------
if($smode=="edit")
{
 $_SESSION["parent"]=$_GET["parent"];
 $parent=$_SESSION["parent"];
 
 $sql = "select name,name_en,sid from apic_section where id_s=".$id_s;
 $tmp=mysql_query($sql);
 
 $name=mysql_result($tmp,0,0);
 $name_en=mysql_result($tmp,0,1);
 $sid=mysql_result($tmp,0,2);
 
 $title="Редактировать данные группы";
 include("sform.php");	
}
//--------------------------------------------------------------------------------------------------------------------------
if($smode=="edit_f")
{
  $name=$_POST["name"];
  $name_en=$_POST["name_en"];
  $sid=$_POST["sid"];
  $parent=$_SESSION["parent"];
  if(empty($parent)) $parent=0;
  
  if(!empty($sid) && !empty($name))
  {
  	 $sql = "select count(*) from apic_section where parent=".$parent." and (sid='".addslashes($sid)."' or name='".addslashes($name)."') and id_s<>".$id_s;
  	 $tmp=mysql_query($sql);
     
    if(mysql_result($tmp,0,0)>0)
    {
     $title="Редактировать данные группы. Использованно повторяющееся имя или идентификатор!";
     $smode="edit";
     include("sform.php");
    }
    else 
    {
      
     $sql='update apic_section set name="'.addslashes($name).'",name_en="'.addslashes($name_en).'",sid="'.addslashes($sid).'" where id_s='.$id_s;
     mysql_query($sql);
    
    	$smode="show";	
    }
  }
  else 
  {
  	$title="Редактировать данные группы. Проверьте поля!";
  	$smode="edit";
    include("sform.php");	
  }	
  
  
}
//--------------------------------------------------------------------------------------------------------------------------
if($smode=="delete")
{
  if(!empty($_GET["id_s"])) 
  {
 	$_SESSION["id_s"]=$_GET["id_s"];
 	$id_s=$_GET["id_s"];
  }
  else $id_s=$_SESSION["id_s"];
  
 
  if($_SESSION["allowdels"]=="yes")
  {
   $sql = "delete from apic_section where id_s=".$id_s;
   mysql_query($sql);
   $sql = "delete from apic_sbf where id_s=".$id_s;
   mysql_query($sql);
   $smode="show";
   $_SESSION["allowdels"]="no";	
  }
  else 
  {
  	 $sql = "select name from apic_section where id_s=".$id_s;
  	 $tmp=mysql_query($sql);
  	 $tmp=mysql_result($tmp,0,0);
  	 
  	 
  	 $_SESSION["allowdels"]="yes";	
  	 
  	 echo '<H1>Внимание! при нажатии на ссылку раздел будет ПОЛНОСТЬЮ удален из базы сайта apik.ru!</H1>';
  	 echo '<a href="/admin-member/'.$folder.'index.php?mode=sect&smode=delete&id_s='.$id_s.'">Удалить раздел '.$tmp.'</a>';  	 
  }
  
}
//--------------------------------------------------------------------------------------------------------------------------
if($smode=="move")
{

 if(!empty($_GET["id_s"])) $id_s=$_GET["id_s"];
 if(!empty($_GET["parent"])) $parent=$_GET["parent"];
 
 $sql='update apic_section set parent='.$parent.' where id_s='.$id_s;
 mysql_query($sql);
 
 $smode="show"; 
}
//--------------------------------------------------------------------------------------------------------------------------
if($smode=="show")
{
 session_unset();	

 if(!empty($_GET["id_s"])) $id_s=$_GET["id_s"];
 
 $sql="select id_s,name from apic_section where parent=0 order by id_s";
 $tmp=mysql_query($sql);
 $tmp_rows=mysql_num_rows($tmp);

 
 for($i=0;$i<$tmp_rows;$i++)
 {
  echo '<tr>'."\n";
  echo '<th  colspan="5">'."\n";	
  echo mysql_result($tmp,$i,1);
  
  if($ssmode!="select")	
  {
   $sql="select id_s,name from apic_section where parent=".mysql_result($tmp,$i,0)." order by id_s";
   $tmp1=mysql_query($sql);
   $tmp1_rows=mysql_num_rows($tmp1);	
  
   echo '<br><a href="/admin-member/'.$folder.'index.php?mode=sect&smode=add&parent='.mysql_result($tmp,$i,0).'">Добавить группу</a>';
   echo '<br><a href="/admin-member/'.$folder.'index.php?mode=sect&smode=edit&id_s='.mysql_result($tmp,$i,0).'">Редактировать группу</a>';
   if($tmp1_rows==0) echo '<br><a href="/admin-member/'.$folder.'index.php?mode=sect&smode=delete&id_s='.mysql_result($tmp,$i,0).'">Удалить группу</a>';
  } 
  else echo '<a href="/admin-member/'.$folder.'index.php?mode=sect&smode=move&id_s='.$id_s.'&parent='.mysql_result($tmp,$i,0).'">Перенести в данную группу</a>';
  echo '</th>'."\n";
  echo '</tr>'."\n";
  
  if($ssmode!="select")	
  {
   for($j=0;$j<$tmp1_rows;$j++)
   {
  	echo '<tr>'."\n";
  	echo '<td>'."\n";
  	echo mysql_result($tmp1,$j,1);
  	echo '<br><a href="/admin-member/'.$folder.'index.php?mode=sect&smode=edit&id_s='.mysql_result($tmp1,$j,0).'">Редактировать группу</a>';
  	echo '<br><a href="/admin-member/'.$folder.'index.php?mode=sect&smode=show&ssmode=select&id_s='.mysql_result($tmp1,$j,0).'">Переместить группу</a>';
  	echo '<br><a href="/admin-member/'.$folder.'index.php?mode=sect&smode=delete&id_s='.mysql_result($tmp1,$j,0).'">Удалить группу</a>';
  	echo '</td>'."\n";
  	echo '</tr>'."\n";
   }
  }
  
 } 

}

?>