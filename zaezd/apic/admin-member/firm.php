<?php
//--------------------------------------------------------------------------------------------------------------------------
if($smode=="add")
{
 
 $title="Добавить данные фирмы";
 $mod1="checked";
 include("fform.php");	
}
//--------------------------------------------------------------------------------------------------------------------------
if($smode=="add_f")
{
 $name=$_POST["name"];
 $logo=$_POST["logo"];
 $equip=$_POST["equip"];
 $serv=$_POST["serv"];
 $info=$_POST["info"];
 $dill=$_POST["dill"];
 $adr=$_POST["adr"];
 $phone1=$_POST["phone1"];
 $code1=$_POST["code1"];
 $phone2=$_POST["phone2"];
 $code2=$_POST["code2"];
 $phone3=$_POST["phone3"];
 $code3=$_POST["code3"];
 $mail=$_POST["mail"];
 $site=$_POST["site"];
 $cexp=$_POST["cexp"];
 $country=$_POST["country"];
 $city=$_POST["city"];
	
 if(!empty($name))	
 {
  $sql="select max(id) from firms";
  $tmp=mysql_query($sql);
  $tmp=mysql_result($tmp,0,0);
  $tmp++;
 	
 
  $name=str_replace('"','&quot;',$name);
  $equip=str_replace('"','&quot;',$equip);
  $serv=str_replace('"','&quot;',$serv);
  $info=str_replace('"','&quot;',$info);
  $dill=str_replace('"','&quot;',$dill);
  $adr=str_replace('"','&quot;',$adr);
  $meta=str_replace('"','&quot;',$meta);
  
  $sql='insert into firms values('.$tmp.',"'.addslashes($name).'","'.addslashes($logo).'","'.addslashes($equip).'","'.addslashes($serv).'","'.addslashes($info).'","'.addslashes($dill).'","'.addslashes($adr).'","'.addslashes($phone1).'","'.addslashes($code1).'","'.addslashes($phone2).'","'.addslashes($code2).'","'.addslashes($phone3).'","'.addslashes($code3).'","'.addslashes($mail).'","'.addslashes($site).'",0,'.addslashes($cexp).',0,"","'.addslashes($country).'","'.addslashes($city).'","")';
  mysql_query($sql);	
  
  $sql='insert into firms_en values('.$tmp.',"'.addslashes($name).'","'.addslashes($logo).'","'.addslashes($equip).'","'.addslashes($serv).'","'.addslashes($info).'","'.addslashes($dill).'","'.addslashes($adr).'","'.addslashes($phone1).'","'.addslashes($code1).'","'.addslashes($phone2).'","'.addslashes($code2).'","'.addslashes($phone3).'","'.addslashes($code3).'","'.addslashes($mail).'","'.addslashes($site).'",0,'.addslashes($cexp).',0,"","'.addslashes($country).'","'.addslashes($city).'")';
   mysql_query($sql);	
  
  $smode="show";	
 }
 else 
 {
  $title="Добавить данные фирмы. Введите название фирмы.";
  $smode="add";
  include("fform.php");
 }
}
//--------------------------------------------------------------------------------------------------------------------------
if($smode=="edit")
{
 $id_f=$_GET["id_f"];
 	
 $title="Редактировать данные фирмы";
 
 $sql="select * from firms where id=".$id_f;
 $tmp=mysql_query($sql);
 
 $name=mysql_result($tmp,0,1);
 $logo=mysql_result($tmp,0,2);
 $equip=mysql_result($tmp,0,3);
 $serv=mysql_result($tmp,0,4);
 $info=mysql_result($tmp,0,5);
 $dill=mysql_result($tmp,0,6);
 $adr=mysql_result($tmp,0,7);
 $phone1=mysql_result($tmp,0,8);
 $code1=mysql_result($tmp,0,9);
 $phone2=mysql_result($tmp,0,10);
 $code2=mysql_result($tmp,0,11);
 $phone3=mysql_result($tmp,0,12);
 $code3=mysql_result($tmp,0,13);
 $mail=mysql_result($tmp,0,14);
 $site=mysql_result($tmp,0,15);
 $cexp=mysql_result($tmp,0,17);
 $country=mysql_result($tmp,0,20);
 $city=mysql_result($tmp,0,21);

 
  $name=str_replace('"','&quot;',$name);
  $equip=str_replace('"','&quot;',$equip);
  $serv=str_replace('"','&quot;',$serv);
  $info=str_replace('"','&quot;',$info);
  $dill=str_replace('"','&quot;',$dill);
  $adr=str_replace('"','&quot;',$adr);
  $meta=str_replace('"','&quot;',$meta);

 
 $check[$cexp]=" checked";
 
 
 include("fform.php");		
}
//--------------------------------------------------------------------------------------------------------------------------
if($smode=="edit_en")
{
 $id_f=$_GET["id_f"];
 	
 $title="Редактировать данные фирмы (англ)";
 
 $sql="select * from firms_en where id=".$id_f;
 $tmp=mysql_query($sql);
 
 $name=mysql_result($tmp,0,1);
 $logo=mysql_result($tmp,0,2);
 $equip=mysql_result($tmp,0,3);
 $serv=mysql_result($tmp,0,4);
 $info=mysql_result($tmp,0,5);
 $dill=mysql_result($tmp,0,6);
 $adr=mysql_result($tmp,0,7);
 $phone1=mysql_result($tmp,0,8);
 $code1=mysql_result($tmp,0,9);
 $phone2=mysql_result($tmp,0,10);
 $code2=mysql_result($tmp,0,11);
 $phone3=mysql_result($tmp,0,12);
 $code3=mysql_result($tmp,0,13);
 $mail=mysql_result($tmp,0,14);
 $site=mysql_result($tmp,0,15);
 $cexp=mysql_result($tmp,0,17);
 $country=mysql_result($tmp,0,20);
 $city=mysql_result($tmp,0,21);

 
  $name=str_replace('"','&quot;',$name);
  $equip=str_replace('"','&quot;',$equip);
  $serv=str_replace('"','&quot;',$serv);
  $info=str_replace('"','&quot;',$info);
  $dill=str_replace('"','&quot;',$dill);
  $adr=str_replace('"','&quot;',$adr);
  $meta=str_replace('"','&quot;',$meta);

 
 $check[$cexp]=" checked";
 
 
 include("fform.php");		
}
//--------------------------------------------------------------------------------------------------------------------------
if($smode=="edit_f")
{
 $name=$_POST["name"];
 $logo=$_POST["logo"];
 $equip=$_POST["equip"];
 $serv=$_POST["serv"];
 $info=$_POST["info"];
 $dill=$_POST["dill"];
 $adr=$_POST["adr"];
 $phone1=$_POST["phone1"];
 $code1=$_POST["code1"];
 $phone2=$_POST["phone2"];
 $code2=$_POST["code2"];
 $phone3=$_POST["phone3"];
 $code3=$_POST["code3"];
 $mail=$_POST["mail"];
 $site=$_POST["site"];
 $cexp=$_POST["cexp"];
 $country=$_POST["country"];
 $city=$_POST["city"];
 
  $name=str_replace('"','&quot;',$name);
  $equip=str_replace('"','&quot;',$equip);
  $serv=str_replace('"','&quot;',$serv);
  $info=str_replace('"','&quot;',$info);
  $dill=str_replace('"','&quot;',$dill);
  $adr=str_replace('"','&quot;',$adr);
  $meta=str_replace('"','&quot;',$meta);

 
 $id_f=$_GET["id_f"];
 
 if(!empty($name))	
 {
  $sql = "UPDATE firms set name='".addslashes($name)."', logo='".addslashes($logo)."', equipment='".addslashes($equip)."', services='".addslashes($serv)."', additional_info='".addslashes($info)."', dilers='".addslashes($dill)."', postal_address='".addslashes($adr)."', phone1='".addslashes($phone1)."', pcode1='".addslashes($code1)."', phone2='".addslashes($phone2)."', pcode2='".addslashes($code2)."', fax='".addslashes($phone3)."', fcode='".addslashes($code3)."', email='".addslashes($mail)."', web='".addslashes($site)."', cexp_only=".addslashes($cexp).", country='".addslashes($country)."', city='".addslashes($city)."' where id=".$id_f;
  mysql_query($sql);
     
  $smode="show";	
 }
 else 
 {
  $title="Редактировать данные фирмы. Введите название фирмы.";
  $smode="edit";
  include("fform.php");
 }
}
//--------------------------------------------------------------------------------------------------------------------------
if($smode=="edit_en_f")
{
 $name=$_POST["name"];
 $logo=$_POST["logo"];
 $equip=$_POST["equip"];
 $serv=$_POST["serv"];
 $info=$_POST["info"];
 $dill=$_POST["dill"];
 $adr=$_POST["adr"];
 $phone1=$_POST["phone1"];
 $code1=$_POST["code1"];
 $phone2=$_POST["phone2"];
 $code2=$_POST["code2"];
 $phone3=$_POST["phone3"];
 $code3=$_POST["code3"];
 $mail=$_POST["mail"];
 $site=$_POST["site"];
 $cexp=$_POST["cexp"];
 $country=$_POST["country"];
 $city=$_POST["city"];
 
  $name=str_replace('"','&quot;',$name);
  $equip=str_replace('"','&quot;',$equip);
  $serv=str_replace('"','&quot;',$serv);
  $info=str_replace('"','&quot;',$info);
  $dill=str_replace('"','&quot;',$dill);
  $adr=str_replace('"','&quot;',$adr);
  $meta=str_replace('"','&quot;',$meta);

 
 $id_f=$_GET["id_f"];
 
 if(!empty($name))	
 {
  $sql = "UPDATE firms_en set name='".addslashes($name)."', logo='".addslashes($logo)."', equipment='".addslashes($equip)."', services='".addslashes($serv)."', additional_info='".addslashes($info)."', dilers='".addslashes($dill)."', postal_address='".addslashes($adr)."', phone1='".addslashes($phone1)."', pcode1='".addslashes($code1)."', phone2='".addslashes($phone2)."', pcode2='".addslashes($code2)."', fax='".addslashes($phone3)."', fcode='".addslashes($code3)."', email='".addslashes($mail)."', web='".addslashes($site)."', cexp_only=".addslashes($cexp).", country='".addslashes($country)."', city='".addslashes($city)."' where id=".$id_f;
  if(!@mysql_query($sql))
  {
  	$sql='insert into firms_en values('.$tmp.',"'.addslashes($name).'","'.addslashes($logo).'","'.addslashes($equip).'","'.addslashes($serv).'","'.addslashes($info).'","'.addslashes($dill).'","'.addslashes($adr).'","'.addslashes($phone1).'","'.addslashes($code1).'","'.addslashes($phone2).'","'.addslashes($code2).'","'.addslashes($phone3).'","'.addslashes($code3).'","'.addslashes($mail).'","'.addslashes($site).'",0,0,0,"","'.addslashes($country).'","'.addslashes($city).'")';
    mysql_query($sql);	 
  }	     
    
  $smode="show";	    
 }
 else 
 {
  $title="Редактировать данные фирмы. Введите название фирмы.";
  $smode="edit_en";
  include("fform.php");
 }
}
//--------------------------------------------------------------------------------------------------------------------------
if($smode=="edit_br")
{
 
 if(!empty($_GET["id_f"])) 
 {
 	$_SESSION["id_f"]=$_GET["id_f"];
 	$id_f=$_GET["id_f"];
 	
 	$_SESSION["sc"]=0;
 }
 else $id_f=$_SESSION["id_f"];
 
 if($ssmode=="ready")
 {
  $id_s=$_SESSION["id_s"]; 	
  $cur=0;
  $nm="scc[".$_SESSION["sc"]."]";
  $_SESSION[$nm]=$id_s;
  $_SESSION["sc"]++;
  
  
      	
  for($i=0;$i<$_SESSION["bcount"];$i++)
  {
   $nm1="br".$i;
   $br[$i]=$_POST[$nm1];
   if(!empty($br[$i])) 
   {
   	$nm='sect['.$id_s.']['.$cur.']';
   	$_SESSION[$nm]=$br[$i];
   	$cur++;
   }   	 	
  }
  $name="sect_c[".$id_s."]";
  $_SESSION[$name]=$cur;
 }
 else 
 {
  $sql="select id_s,id_b from apic_sbf where id_f=".$id_f." order by id_s,id_b";
  $tmp=mysql_query($sql);
  $tmp_rows=mysql_num_rows($tmp);	
  
  $ls=0;
  $count=0;
    
  for($i=0;$i<$tmp_rows;$i++)
  {
   if(mysql_result($tmp,$i,1)==-1)
   {
   	$name="sst[".mysql_result($tmp,$i,0)."]";
   	$_SESSION[$name]=1;
   	continue;
   }
   if($ls!=mysql_result($tmp,$i,0))
   {
   	if($ls!=0)
   	{
   	 $name="sect_c[".$ls."]";
     $_SESSION[$name]=$count;	
   	}
   	$count=0;
   	$ls=mysql_result($tmp,$i,0);
   }	
   $nm='sect['.$ls.']['.$count.']';	
   $_SESSION[$nm]=mysql_result($tmp,$i,1);	
   $count++;
  }
  if($count>0 && $ls>0) 
  {
  	$name="sect_c[".$ls."]";
    $_SESSION[$name]=$count;
  }
 }
 
 
 
 $sql="select id_s,name from apic_section where parent=0 order by id_s";
 $tmp=mysql_query($sql);
 $tmp_rows=mysql_num_rows($tmp);
 
 echo '<form action="/admin-member/'.$folder.'index.php?mode=firm&smode=edit_br_f&cnt='.$tmp_rows.'&id_f='.$id_f.'" method="post" enctype="multipart/form-data" name="form1">'."\n";
 
 for($i=0;$i<$tmp_rows;$i++)
 {
  $sql="select id_s,name from apic_section where parent=".mysql_result($tmp,$i,0)." order by id_s";
  $tmp1=mysql_query($sql);
  $tmp1_rows=mysql_num_rows($tmp1);	
  
  echo '<tr>'."\n";
  echo '<th  colspan="5">'."\n";	
  echo mysql_result($tmp,$i,1);
  if($tmp1_rows==0)	
  {
   $mod="";
   $name="sst[".mysql_result($tmp,$i,0)."]";
   if($_SESSION[$name]==1)	$mod="checked";
   $name="ss[".$i."]";
   $_SESSION[$name]=mysql_result($tmp,$i,0);
   //$name='bc['.mysql_result($tmp1,$i,0).']';	
   //echo '<br><a href="/admin-member/'.$folder.'index.php?mode=firm&smode=inc&id_s='.mysql_result($tmp,$i,0).'">Участвовать</a>';
   echo '<br>Участвовать в разделе <input type="checkbox" name="st'.$i.'" '.$mod.' value="'.mysql_result($tmp,$i,0).'">'."\n";
  }
  echo '</th>'."\n";
  echo '</tr>'."\n";
  
  for($j=0;$j<$tmp1_rows;$j++)
  {
  	echo '<tr>'."\n";
  	echo '<td>'."\n";
  	echo mysql_result($tmp1,$j,1);
  	echo '<br><a href="/admin-member/'.$folder.'index.php?mode=firm&smode=inc&id_s='.mysql_result($tmp1,$j,0).'">Изменить брэнды</a>';
  	echo '</td>'."\n";
  	$name='sect_c['.mysql_result($tmp1,$j,0).']';
  	$name=$_SESSION[$name];
  	  	
  	for($k=0;$k<$name;$k++)
  	{
  	 $nm='sect['.mysql_result($tmp1,$j,0).']['.$k.']';
  	 $nm=$_SESSION[$nm];
  	   	 
  	 $sql="select name from apic_brand where id_b=".$nm;
     $temp=mysql_query($sql);
  	 
  	 echo '<td>'."\n";	
  	 echo mysql_result($temp,0,0);
  	 echo '</td>'."\n";
  	}
    echo '</tr>'."\n";
  }
 	
 }
 
 echo '<tr>'."\n";
 echo '<td>'."\n";
 //echo '<a href="/admin-member/'.$folder.'index.php?mode=firm&smode=edit_br_f&id_f='.$id_f.'">Принять изменения</a>';
 echo '<input type="submit" name="Submit" value="Принять">'."\n";
 echo '</form>'; 
 echo '</td>'."\n";
 echo '<td>'."\n";
 echo '<a href="/admin-member/'.$folder.'index.php?mode=firm&smode=show">Назад</a>';
 echo '</td>'."\n";
 echo '</tr>'."\n";
	
}
//--------------------------------------------------------------------------------------------------------------------------
if($smode=="edit_br_f")
{
  $id_f=$_GET["id_f"];
  $cnt=$_GET["cnt"];
  
  for($i=0;$i<$cnt;$i++)
  {
  	$name="ss[".$i."]";
    $name=$_SESSION[$name];
  	$sql="delete from apic_sbf where id_s=".$name." and id_f=".$id_f;
    mysql_query($sql);
    
  	$name="st".$i;
  	$name=$_POST[$name];
  	if(!empty($name))
  	{
  	 $sql='insert into apic_sbf values('.$name.',-1,'.$id_f.')';
     mysql_query($sql);	
  	}
  }
 	
  for($i=0;$i<$_SESSION["sc"];$i++)
  {
   $nm="scc[".$i."]";
   $id_s=$_SESSION[$nm];	
  
   $sql="delete from apic_sbf where id_s=".$id_s." and id_f=".$id_f;
   mysql_query($sql);
  
  
   $name="sect_c[".$id_s."]";

   for($j=0;$j<$_SESSION[$name];$j++)
   {
    $nm='sect['.$id_s.']['.$j.']';
    $nm=$_SESSION[$nm];	
    $sql='insert into apic_sbf values('.$id_s.','.$nm.','.$id_f.')';
    mysql_query($sql);
   }
  }
 $smode="show";	
}
//--------------------------------------------------------------------------------------------------------------------------
if($smode=="addbrand")
{
 $name=$_POST["name"];
 $sid=$_POST["sid"];
	
 $title="Добавить данные брэнда";
 include("bform.php");	
}
//--------------------------------------------------------------------------------------------------------------------------
if($smode=="addbrand_f")
{
  $name=$_POST["name"];
  $sid=$_POST["sid"];
  
  if(!empty($sid) && !empty($name))
  {
  	 $sql = "select count(*) from apic_brand where sid='".addslashes($sid)."' or name='".addslashes($name)."'";
  	 $tmp=mysql_query($sql);
     
    if(mysql_result($tmp,0,0)>0)
    {
     $title="Добавить данные брэнда. Использованно повторяющееся имя или идентификатор!";
     $smode="addbrand";
     include("bform.php");
    }
    else 
    {
     $sql="select max(id_b) from apic_brand";
     $tmp=mysql_query($sql);
     $tmp=mysql_result($tmp,0,0);
     $tmp++;
 	
  
    $sql='insert into apic_brand values('.$tmp.',"'.addslashes($name).'","'.addslashes($sid).'",0)';
    mysql_query($sql);
    
    	$smode="inc";	
    }
  }
  else 
  {
  	$title="Добавить данные брэнда. Проверьте поля!";
  	$smode="addbrand";
    include("bform.php");	
  }	
  
  
}
//--------------------------------------------------------------------------------------------------------------------------
if($smode=="delete")
{
  if(!empty($_GET["id_f"])) 
  {
 	$_SESSION["id_f"]=$_GET["id_f"];
 	$id_f=$_GET["id_f"];
  }
  else $id_f=$_SESSION["id_f"];
  	
  if($_SESSION["allowdel"]=="yes")
  {
   $sql = "delete from firms where id=".$id_f;
   mysql_query($sql);
   $sql = "delete from firms_en where id=".$id_f;
   mysql_query($sql);
   $sql = "delete from apic_sbf where id_f=".$id_f;
   mysql_query($sql);
   $sql = "delete from apic_obj where id_f=".$id_f;
   mysql_query($sql);
   $smode="show";
   $_SESSION["allowdel"]="no";	
  }
  else 
  {
  	 $sql = "select name from firms where id=".$id_f;
  	 $tmp=mysql_query($sql);
  	 $tmp=mysql_result($tmp,0,0);
  	 
  	 
  	 $_SESSION["allowdel"]="yes";	
  	 
  	 echo '<H1>Внимание! при удалении фирмы она будет ПОЛНОСТЬЮ удалена из базы сайта apiс.ru!</H1>';
  	 echo '<a href="/admin-member/'.$folder.'index.php?mode=firm&smode=delete&id_f='.$id_f.'">Удалить фирму '.$tmp.'</a>';
  }
  
}
//--------------------------------------------------------------------------------------------------------------------------
if($smode=="inc")
{
 if(!empty($_GET["id_s"])) 
 {
 	$_SESSION["id_s"]=$_GET["id_s"];
 	$id_s=$_GET["id_s"];
 }
 else $id_s=$_SESSION["id_s"];
	
 echo '<form action="/admin-member/'.$folder.'index.php?mode=firm&smode=edit_br&ssmode=ready" method="post" enctype="multipart/form-data" name="form1">'."\n"; 
 echo '<tr>'."\n";
 
 $letter="&";
 $topen=0;
 
 $sql="select id_b,name from apic_brand order by name";
 $tmp=mysql_query($sql);
 $tmp_rows=mysql_num_rows($tmp);
 
 $_SESSION["bcount"]=$tmp_rows;
 
 for($i=0;$i<$tmp_rows;$i++)
 {
  if($letter!=substr(mysql_result($tmp,$i,1),0,1))	
  {
   if($topen==1) echo '</table></td>'."\n";	
   echo '<td valign="top"><table border="1">'."\n"; 
   $topen=1;
   $letter=substr(mysql_result($tmp,$i,1),0,1);
  }	
  
  $mod="";
  
  $name='sect_c['.$id_s.']';
  $name=$_SESSION[$name];
  
 
  for($j=0;$j<$name;$j++)
  {
  	$nm='sect['.$id_s.']['.$j.']';
  	$nm=$_SESSION[$nm];
    
    if($nm==mysql_result($tmp,$i,0))
    {
     $mod="checked";	
     break;
    }
  }
  
  echo '<tr>'."\n";
  echo '<td>'."\n";
  echo '<input type="checkbox" name="br'.$i.'" '.$mod.' value="'.mysql_result($tmp,$i,0).'">'."\n";
  echo '</td>'."\n";
  echo '<td>'."\n";
  echo mysql_result($tmp,$i,1);
  echo '</td>'."\n";
  echo '</tr>'."\n";
 }
 if($topen==1) echo '</table>'."\n";	
 
 
 echo '</tr>'."\n";
 
 echo '<tr>'."\n";
 echo '<td>'."\n";
 echo '<input type="submit" name="Submit" value="Принять">'."\n";
 echo '</td>'."\n";
 echo '</tr>'."\n";

 echo '</form>'; 
}
//--------------------------------------------------------------------------------------------------------------------------
if($smode=="add_obj_firm")
{
	$_SESSION["id_f"]=$_GET["id_f"];
  $id_f=$_GET["id_f"];
  $_SESSION["id_so"]=$_GET["id_so"];
  $id_so=$_GET["id_so"];
  
   $title="Добавить данные объекта";
   include("ooform.php");	
}
//--------------------------------------------------------------------------------------------------------------------------
if($smode=="add_obj_firm_f")
{
  $id_f=$_SESSION["id_f"];
  $id_so=$_SESSION["id_so"];
  
  if(!empty($name))
  {
  	 $sql = "select count(*) from apic_obj where name='".addslashes($name)."'";
  	 $tmp=mysql_query($sql);
     
    if(mysql_result($tmp,0,0)>0)
    {
     $title="Добавить данные объекта. Использованно повторяющееся имя!";
     $smode="add_obj_firm";
     include("ofform.php");
    }
    else 
    {
     $sql="select max(id_o) from apic_obj where id_f=".$id_f." and id_so=".$id_so;
     $tmp=mysql_query($sql);
     $tmp=mysql_result($tmp,0,0);
     $tmp++;
 	
  
    $sql='insert into apic_obj values('.$id_so.','.$id_f.','.$tmp.',"'.addslashes($name).'","'.addslashes($addr).'","'.addslashes($short).'","'.addslashes($special).'","'.addslashes($basic).'","'.addslashes($schema).'","'.addslashes($expert).'","'.addslashes($img1).'","'.addslashes($img2).'","'.addslashes($img3).'","'.addslashes($img4).'","'.addslashes($img5).'","'.addslashes($additional).'")';
    //echo $sql;
    mysql_query($sql);
    
    	$smode="edit_obj";	
     $_GET["id_f"]=$id_f;	
    }
  }
  else
  {
  	$title="Добавить данные объекта. Проверьте поля!";
  	$smode="add_obj_firm";
    include("ooform.php");	
  }
}
//--------------------------------------------------------------------------------------------------------------------------
if($smode=="move_obj")
{
	  $id_f=$_GET["id_f"];
  $id_o=$_GET["id_o"];
  $id_so=$_GET["id_so"];
  $new_id_so=$_GET["new_id_so"];
  
  if(!empty($new_id_so))
  {
     $sql="select max(id_o) from apic_obj where id_f=".$id_f." and id_so=".$new_id_so;
     $tmp=mysql_query($sql);
     $tmp=mysql_result($tmp,0,0);
     $tmp++;
 	
  
    $sql='update apic_obj set id_so='.$new_id_so.', id_o='.$tmp.' where id_f='.$id_f.' and id_so='.$id_so.' and id_o='.$id_o;
    mysql_query($sql);
    
    	$smode="edit_obj";	
     $_GET["id_f"]=$id_f;	
    }
  else
  {
  	$sql="select id_so,name from apic_sobj order by id_so";
 $tmp=mysql_query($sql);
 $tmp_rows=mysql_num_rows($tmp);
 echo '<tr>'."\n";
 	echo '<td>'."\n";
  echo '<strong>Выберите раздел</strong>';
  echo '</td>'."\n";
  echo '</tr>'."\n"; 
 for($i=0;$i<$tmp_rows;$i++)
 {
 	echo '<tr>'."\n";
 	echo '<td>'."\n";
  echo '<a href="/admin-member/'.$folder.'index.php?mode=firm&smode=move_obj&id_so='.$id_so.'&new_id_so='.mysql_result($tmp,$i,0).'&id_f='.$id_f.'&id_o='.$id_o.'">'.mysql_result($tmp,$i,1).'</a>';
  echo '</td>'."\n";
  echo '</tr>'."\n"; 
  }
}
}
//--------------------------------------------------------------------------------------------------------------------------
if($smode=="edit_obj_firm")
{
	$_SESSION["id_f"]=$_GET["id_f"];
  $id_f=$_GET["id_f"];
  $_SESSION["id_so"]=$_GET["id_so"];
  $id_so=$_GET["id_so"];
  $_SESSION["id_o"]=$_GET["id_o"];
  $id_o=$_GET["id_o"];
  
  $sql='select * from apic_obj where id_f='.$id_f.' and id_so='.$id_so.' and id_o='.$id_o;
  $tmp=mysql_query($sql);
  $name=mysql_result($tmp,0,3);
  $addr=mysql_result($tmp,0,4);
  $short=mysql_result($tmp,0,5);
  $special=mysql_result($tmp,0,6);
  $basic=mysql_result($tmp,0,7);
  $schema=mysql_result($tmp,0,8);
  $expert=mysql_result($tmp,0,9);
  $img1=mysql_result($tmp,0,10);
  $img2=mysql_result($tmp,0,11);
  $img3=mysql_result($tmp,0,12);
  $img4=mysql_result($tmp,0,13);
  $img5=mysql_result($tmp,0,14);
  $additional=mysql_result($tmp,0,15);
  
  $title="Редактировать данные объекта";
  include("ooform.php");	
}
//--------------------------------------------------------------------------------------------------------------------------
if($smode=="edit_obj_firm_f")
{
	$id_f=$_SESSION["id_f"];
  $id_so=$_SESSION["id_so"];
  $id_o=$_SESSION["id_o"];
  
  if(!empty($name))
  {
  	 $sql = "select count(*) from apic_obj where name='".addslashes($name)."' and id_o<>".$id_o;
  	 $tmp=mysql_query($sql);
     
    if(mysql_result($tmp,0,0)>0)
    {
     $title="Редактировать данные объекта. Использованно повторяющееся имя!";
     $smode="edit_obj_firm";
     include("ofform.php");
    }
    else 
    {
     $sql='update apic_obj set name="'.addslashes($name).'", addr="'.addslashes($addr).'", short="'.addslashes($short).'", special="'.addslashes($special).'", basic="'.addslashes($basic).'", `schema`="'.addslashes($schema).'", expert="'.addslashes($expert).'", img1="'.addslashes($img1).'", img2="'.addslashes($img2).'", img3="'.addslashes($img3).'", img4="'.addslashes($img4).'", img5="'.addslashes($img5).'",additional="'.addslashes($additional).'" where id_f='.$id_f.' and id_so='.$id_so.' and id_o='.$id_o;
     
     mysql_query($sql);
         
    	$smode="edit_obj";
    	$_GET["id_f"]=$id_f;	
    }
  }
  else
  {
  	$title="Редактировать данные объекта. Проверьте поля!";
  	$smode="edit_obj_firm";
    include("ooform.php");	
  }
}
//--------------------------------------------------------------------------------------------------------------------------
if($smode=="delete_obj")
{
	if(!empty($_GET["id_f"])) 
  {
 	$_SESSION["id_f"]=$_GET["id_f"];
 	$id_f=$_GET["id_f"];
  }
  else $id_f=$_SESSION["id_f"];
  
  if(!empty($_GET["id_so"])) 
  {
 	$_SESSION["id_so"]=$_GET["id_so"];
 	$id_so=$_GET["id_so"];
  }
  else $id_so=$_SESSION["id_so"];
  
  if(!empty($_GET["id_o"])) 
  {
 	$_SESSION["id_o"]=$_GET["id_o"];
 	$id_o=$_GET["id_o"];
  }
  else $id_o=$_SESSION["id_o"];
  	
  if($_SESSION["allowdel"]=="yes")
  {
   $sql = "delete from apic_obj where id_f=".$id_f." and id_so=".$id_so." and id_o=".$id_o;
   mysql_query($sql);
   $smode="edit_obj";
   $_GET["id_f"]=$id_f;
   $_SESSION["allowdel"]="no";	
  }
  else 
  {
  	 $sql = "select name from apic_obj where id_f=".$id_f." and id_so=".$id_so." and id_o=".$id_o;
  	 $tmp=mysql_query($sql);
  	 $tmp=mysql_result($tmp,0,0);
  	 
  	 
  	 $_SESSION["allowdel"]="yes";	
  	 
  	 echo '<H1>Внимание! при удалении объекта он будет ПОЛНОСТЬЮ удален из базы сайта apiс.ru!</H1>';
  	 echo '<a href="/admin-member/'.$folder.'index.php?mode=firm&smode=delete_obj&id_so='.$id_so.'&id_f='.$id_f.'&id_o='.$id_o.'">Удалить объект '.$tmp.'</a>';
  }
}
//--------------------------------------------------------------------------------------------------------------------------
if($smode=="edit_obj")
{
 $_SESSION["id_f"]=$_GET["id_f"];
 $id_f=$_GET["id_f"];
 
 $sql="select id_so,name from apic_sobj order by id_so";
 $tmp=mysql_query($sql);
 $tmp_rows=mysql_num_rows($tmp);
 
 for($i=0;$i<$tmp_rows;$i++)
 {
 	echo '<tr>'."\n";
 	echo '<th colspan="2">'."\n";
  echo mysql_result($tmp,$i,1);
  echo '<br />'."\n";
  echo '<a href="/admin-member/'.$folder.'index.php?mode=firm&smode=add_obj_firm&id_so='.mysql_result($tmp,$i,0).'&id_f='.$id_f.'">Добавить объект в раздел</a>';
  echo '</th>'."\n";
  echo '</tr>'."\n"; 
  
  $sql="select id_o, name from apic_obj where id_so=".mysql_result($tmp,$i,0)." and id_f=".$id_f." order by id_o";
  $temp=mysql_query($sql);
  $temp_rows=mysql_num_rows($temp);
  for($j=0;$j<$temp_rows;$j++)
  {
   echo '<tr>'."\n";
   echo '<td>'."\n";
   echo mysql_result($temp,$j,1);
   echo '</td><td>'."\n";
   echo '<a href="/admin-member/'.$folder.'index.php?mode=firm&smode=edit_obj_firm&id_so='.mysql_result($tmp,$i,0).'&id_f='.$id_f.'&id_o='.mysql_result($temp,$j,0).'">Редактировать объект</a>';
   echo '<br /><a href="/admin-member/'.$folder.'index.php?mode=firm&smode=move_obj&id_so='.mysql_result($tmp,$i,0).'&id_f='.$id_f.'&id_o='.mysql_result($temp,$j,0).'">Переместить объект</a>';
   echo '<br /><a href="/admin-member/'.$folder.'index.php?mode=firm&smode=delete_obj&id_so='.mysql_result($tmp,$i,0).'&id_f='.$id_f.'&id_o='.mysql_result($temp,$j,0).'">Удалить объект</a>';
   echo '</td>'."\n";
   echo '</tr>'."\n";  	
  }
 }
}
//--------------------------------------------------------------------------------------------------------------------------
if($smode=="show")
{
 session_unset();	
	
$sql="select id,name from firms order by cexp_only, name";
$tmp=mysql_query($sql);
$tmp_rows=mysql_num_rows($tmp);	


for($i=0;$i<$tmp_rows;$i++)
{ 
 echo '<tr>'."\n";
 echo '<td width="50%">'."\n";	
 echo mysql_result($tmp,$i,1);
 echo '</td>'."\n";
 echo '<td>'."\n";	
 echo '<a href="/admin-member/'.$folder.'index.php?mode=firm&smode=edit&id_f='.mysql_result($tmp,$i,0).'">Редактировать данные</a>';
  echo '</td>'."\n";
 echo '<td>'."\n";	
 echo '<a href="/admin-member/'.$folder.'index.php?mode=firm&smode=edit_en&id_f='.mysql_result($tmp,$i,0).'">Редактировать данные (англ)</a>';
  echo '</td>'."\n"; 
 echo '<td>'."\n";	
 echo '<a href="/admin-member/'.$folder.'index.php?mode=firm&smode=edit_br&id_f='.mysql_result($tmp,$i,0).'">Редактировать анкету</a><br>';
 echo '</td>'."\n";
 echo '<td>'."\n";	
 echo '<a href="/admin-member/'.$folder.'index.php?mode=firm&smode=edit_obj&id_f='.mysql_result($tmp,$i,0).'">Редактировать объекты</a><br>';
 echo '</td>'."\n";
 echo '<td>'."\n";	
 echo '<a href="/admin-member/'.$folder.'index.php?mode=firm&smode=delete&id_f='.mysql_result($tmp,$i,0).'">Удалить фирму</a>';
 echo '</td>'."\n";
 echo '</tr>'."\n";
}

}
?> 
