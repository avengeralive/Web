<?php
if($_SESSION["user_type"]==1 || $_SESSION["user_type"]==2)
{
//---show---------------------
if(empty($mode[0]) && empty($action))
{
	$sql='select * from '.$pr.'ras where id_u='.$_SESSION["user_id"].' order by id_r desc';
	$ras=mysql_query($sql);
	$ras_count=mysql_num_rows($ras);
	
	echo '<div class="addwork"><h1>Рассылки</h1><p><a class="button" href="'.$base_url.'/action-add/">Добавить рассылку</a></p></div>';

	echo '<table>';
	echo '<tr>';
	echo '<th>';
	echo 'Дата/Тема';
	echo '</th>';
	echo '<th>';
	echo 'Статус';
	echo '</th>';
	echo '<th>';
	echo 'Действия';
	echo '</th>';
	echo '</tr>';
	
	
	for($i=0;$i<$ras_count;$i++)
	{
		echo '<tr>';
	    echo '<td class="name">';
	    echo '<a href="'.$base_url.'/'.mysql_result($ras,$i,0).'/action-edit/">'.mysql_result($ras,$i,3).'<br />'.mysql_result($ras,$i,2).'</a>';
	    echo '</td>';
	    echo '<td class="name">';
	    if(mysql_result($ras,$i,7)==1) echo 'Режим - Тестовая отправка<br />';
	    if(mysql_result($ras,$i,5)==0)
	     echo 'Не активна';
	    if(mysql_result($ras,$i,5)==1)
	     echo 'Отправляется';
	    if(mysql_result($ras,$i,5)==2)
	     echo 'Отправлена адресатам'; 
	    echo '</td>';
	    echo '<td class="name">';
	    if(mysql_result($ras,$i,7)==1) echo '<a href="'.$base_url.mysql_result($ras,$i,0).'/action-test-0/">Отправить всем</a><br /><br />';
	    else echo '<a href="'.$base_url.mysql_result($ras,$i,0).'/action-test-1/">Тестовая отправка</a><br /><br />';
		echo '<a href="'.$base_url.mysql_result($ras,$i,0).'/action-edit/">Редактировать</a><br />';
        echo '<a href="'.$base_url.mysql_result($ras,$i,0).'/action-single/">Загрузить/удалить файлы</a><br /><br />';
	    if(mysql_result($ras,$i,5)==0) echo '<a href="'.$base_url.mysql_result($ras,$i,0).'/action-start/">Начать рассылку</a><br /><br />';
	    if(mysql_result($ras,$i,5)==1) echo '<a href="'.$base_url.mysql_result($ras,$i,0).'/action-stop/">Остановить рассылку</a><br /><br />';
	    if(mysql_result($ras,$i,5)==2) echo '<a href="'.$base_url.mysql_result($ras,$i,0).'/action-start/">Перезапустить рассылку</a><br /><br />';
	    echo '<a href="'.$base_url.mysql_result($ras,$i,0).'/action-delete/">Удалить</a>';
	    echo '</td>';
	    echo '</tr>';
	}
	echo '</table>';
    echo '<META HTTP-EQUIV="Refresh" CONTENT="120; URL='.$base_url.'">';
}
//---single---------------------
if($action[1]=="single")
{
 $sql='select dt,subj,id_r from '.$pr.'ras where id_r='.addslashes($mode[0]).' and id_u='.addslashes($_SESSION["user_id"]).';';
 $ras=mysql_query($sql);
 $id_r=mysql_result($ras,0,2);
 
 if($action[2]=="addimage")
 {
 	$file="image";
	include($inc_path."output/upload.php");
    include($inc_path."service/func.php");
	
	if(!empty($fname) && !empty($hname))
	{
	    $attach=uploadAttachment($fname,$hname);
        
		$sql='select max(id_i) from '.$pr.'image';
		$id_i=mysql_query($sql);
		$id_i=mysql_result($id_i,0,0);
		$id_i++;
		
		$sql='insert into '.$pr.'image values('.$id_r.','.$id_i.',"'.$fname.'","'.$hname.'","'.$attach['attachId'].'",UNIX_TIMESTAMP(NOW()),'.$isimg.')';
		mysql_query($sql);
		
		chmod($fname,0644);
	}
 }	
 if($action[2]=="delimg")
 {
 	$sql='select file from '.$pr.'image where id_i='.$action[3].' and id_r='.$id_r;
	$fname=mysql_query($sql);
	$fname=mysql_result($fname,0,0);
	
	if(!empty($fname))
	{
		$sql='delete from '.$pr.'image where id_i='.$action[3].' and id_r='.$id_r;
		mysql_query($sql);
		
		unlink($fname);
	}
 }	
 
 echo '<h2 class="f">'.mysql_result($ras,0,0).'-'.mysql_result($ras,0,1).'</h2>';

$path=$base_url.$id_r."/action-single-addimage/finish/"; 
echo '<form action="'.$path.'" method="post" class="formtable profile" enctype="multipart/form-data" name="form1"><table>'."\n";
echo '<tr><td class="name">Файл для загрузки</td>';
echo '<td class="value"><input name="image" type="file" id="image"></td></tr></table>'."\n";
echo '</table><p><input type="submit" name="submit" value="Подтвердить" class="submit" /></p>';
echo '</form>'; 
 
    $sql='select * from '.$pr.'image where id_r='.$id_r;
	$img=mysql_query($sql);
	$img_count=mysql_num_rows($img);
	
	
	echo '<h2 class="f">Файлы</h2>';
	echo '<table>';
	echo '<tr>';
	echo '<th>';
	echo 'Название';
	echo '</th>';
	echo '<th>';
	echo 'Действия';
	echo '</th>';
	echo '</tr>';
	
	
	for($i=0;$i<$img_count;$i++)
	{
		echo '<tr>';
	    echo '<td class="name">';
	    echo mysql_result($img,$i,3);
	    echo '</td>';
	    echo '<td class="name">';
	    echo '<a href="'.$base_url.$id_r.'/action-single-delimg-'.mysql_result($img,$i,1).'/">Удалить</a>';
	    echo '</td>';
	    echo '</tr>';
	}
	echo '</table>';
    
    echo '<h2 class="f"><a href="/nr/">Вернуться в главное меню</a></h2>';
	
}
//-add-----------------------------
if($action[1]=="add")
{
	if(!empty($finish))
	{
	   $sql='select id_list from '.$pr.'list where id_list='.addslashes($list).' and (id_user='.addslashes($_SESSION["user_id"]).' or id_list in (select id_list from '.$pr.'user_list where id_user='.addslashes($_SESSION["user_id"]).'));';
       $list=mysql_query($sql);
       $list=mysql_result($list,0,0);
       
	   if(!empty($subj) && !empty($text) && !empty($list))
       {
		$sql='INSERT INTO '.$pr.'ras set id_u='.addslashes($_SESSION["user_id"]).',subj="'.addslashes($subj).'",dt=NOW(),text="'.addslashes($text).'",type=0,count=0,test=1,rlist='.$list;
		mysql_query($sql);
        
		echo '<h2 class="f">Рассылка успешно добавлена!</h2>';	 
        echo '<META HTTP-EQUIV="Refresh" CONTENT="2; URL=/nr/">';
       }
       else
       {
        echo "<h2>Заполните поля!</h2>";
	    $path=$base_url."action-add/finish/";
	    include($inc_path."output/ras_form.php"); 
       } 
	}
	else
	{
	 $path=$base_url."action-add/finish/";
	 include($inc_path."output/ras_form.php");
	}
}
//-edit-----------------------------
if($action[1]=="edit")
{
	if(!empty($finish))
	{
	   $sql='select id_list from '.$pr.'list where id_list='.addslashes($list).' and (id_user='.addslashes($_SESSION["user_id"]).' or id_list in (select id_list from '.$pr.'user_list where id_user='.addslashes($_SESSION["user_id"]).'));';
       $list=mysql_query($sql);
       $list=mysql_result($list,0,0);
       
	   if(!empty($subj) && !empty($text) && !empty($list))
       {
		$sql='update '.$pr.'ras set subj="'.addslashes($subj).'",text="'.addslashes($text).'",rlist='.$list.' where id_r='.addslashes($mode[0]).' and id_u='.addslashes($_SESSION["user_id"]).';';
		mysql_query($sql);
		
		echo '<h2 class="f">Рассылка успешно отреадктирована!</h2>';	 
        echo '<META HTTP-EQUIV="Refresh" CONTENT="2; URL=/nr/">';
       }
       else
       {
        echo "<h2>Заполните поля!</h2>";
	    $path=$base_url."action-add/finish/";
	    include($inc_path."output/ras_form.php"); 
       } 
	}
	else
	{
	 $sql='select rlist,subj,text from '.$pr.'ras where id_r='.addslashes($mode[0]).' and id_u='.addslashes($_SESSION["user_id"]).';';
	 $text=mysql_query($sql);
     $list=mysql_result($text,0,0);
     $subj=mysql_result($text,0,1);
	 $text=mysql_result($text,0,2);
	 
     $path=$base_url.$mode[0]."/action-edit/finish/";
	 include($inc_path."output/ras_form.php");
	}
}
//-start-----------------------------
if($action[1]=="start")
{
		$sql='update '.$pr.'ras set type=1,count=0 where id_r='.addslashes($mode[0]).' and id_u='.addslashes($_SESSION["user_id"]).';';
		mysql_query($sql);
		
		if(mysql_affected_rows()==1) include($inc_path."service/generate.php");
		
		echo '<h2 class="f">Рассылка успешно запущена</h2>';
        echo '<META HTTP-EQUIV="Refresh" CONTENT="2; URL=/nr/">';
}
//-stop-----------------------------
if($action[1]=="stop")
{
		$sql='update '.$pr.'ras set type=0 where id_r='.addslashes($mode[0]).' and id_u='.addslashes($_SESSION["user_id"]).';';
		mysql_query($sql);
		
		echo '<h2 class="f">Рассылка успешно остановлена</h2>';
          echo '<META HTTP-EQUIV="Refresh" CONTENT="2; URL=/nr/">';
}
//-stop-----------------------------
if($action[1]=="test")
{
		$sql='update '.$pr.'ras set test='.$action[2].' where id_r='.addslashes($mode[0]).' and id_u='.addslashes($_SESSION["user_id"]).';';
		mysql_query($sql);

		echo '<h2 class="f">Режим рассылки изменён</h2>';
          echo '<META HTTP-EQUIV="Refresh" CONTENT="2; URL=/nr/">';
}
//-delete-------------------------------------------------------------------
if($action[1]=="delete")
{
	if(!empty($mode[0]))
	{
	   if(!empty($finish))
		{
    
		  $sql='delete from '.$pr.'ras where id_r='.addslashes($mode[0]).' and id_u='.addslashes($_SESSION["user_id"]).';';
		  mysql_query($sql);
	         
   		  echo '<h2 class="f">Рассылка успешно удалена</h2>';
          echo '<META HTTP-EQUIV="Refresh" CONTENT="2; URL=/nr/">';		
		}	
		else
		{
	     $sql='select dt,subj from '.$pr.'ras where id_r='.addslashes($mode[0]).' and id_u='.addslashes($_SESSION["user_id"]).';';
	     $dt=mysql_query($sql);
         $subj=mysql_result($dt,0,1);
	     $dt=mysql_result($dt,0,0);
		 
		 if(!empty($dt))
        	     echo '<p><a href="'.$base_url.$mode[0].'/action-delete/finish/">Действительно хотите удалить рассылку от '.$dt.' c темой '.$subj.'?</a></p>';
		}		
	}	
}
//------
}
?>