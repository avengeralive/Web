<?php
include($inc_path."kernel/object.php");
include($inc_path."kernel/rubric.php");

class part
{
 var $pr;
    
 var $id;
 var $name;
 var $text;
 var $sid;
 var $permit;
 var $active;
 var $path;
 var $main;
    
 var $childs_count;
 var $childs;
 var $childs_index;
  
 var $start;
 var $child_count;
 
 var $params;
 
 var $rubric_count;
 var $rubric_index;
 var $rubric;
 
 var $type;
 var $type_count;
 
 var $title;
 var $description;
 var $keyword;

 var $files_count;
 var $files;
 
//--------------------------------------------------------------------------------------------
function part($params, $permit)
{
//---get vars-------------------------------
 	global $pr;

    $this->pr=$pr;

	$this->id=$params["id"];
	$this->name=$params["name"];
	$this->sid=$params["sid"];
	$this->active=$params["active"];
	$this->main=$params["main"];
	$this->permit=$permit;
	
	$this->child_count=$params["child_count"];
	
	$this->start=$params["start"];
	
	
	$this->params=$params;
	
}
//--------------------------------------------------------------------------------------------
function get_path($pref)
{
	if(empty($this->path))
	{
		if($this->main==1) $this->path='/';
		else $this->path='/'.$this->sid.'/';
	}
	
	return $pref.$this->path;
}
//--------------------------------------------------------------------------------------------
function get_child($mod,$type,$count,$field)
{
	if($mod=="normal")
	{
		if($this->permit>0) $sql='select id_type, id, sid,idx,active from '.$this->pr.'object where id_part='.$this->id.' and ptype=0 and pid=0 order by idx asc, tadd desc limit '.($this->start*$this->child_count).','.$this->child_count;
		else $sql='select id_type, id, sid,idx,active from '.$this->pr.'object where active=1 and id_part='.$this->id.' and ptype=0 and pid=0 order by idx asc, tadd desc limit '.($this->start*$this->child_count).','.$this->child_count;
	}
//-----------------------
	if($mod=="special")
	{
		if($this->permit>0) $sql='select id_type, id, sid,idx,active from '.$this->pr.'object where id_part='.$this->id.' and ptype=0 and pid=0';
		else $sql='select id_type, id, sid,idx,active from '.$this->pr.'object where active=1 and id_part='.$this->id.' and ptype=0 and pid=0';
		
		if(!empty($type)) $sql.=' and id_type='.$type;
		 		
		$sql.=' order by idx asc, tadd desc';
		
		if($count!="all")		
		{
		 if(empty($count)) $sql.=' limit '.($this->start*$this->child_count).','.$this->child_count;
		 else $sql.=' limit '.($this->start*$count).','.$count;
		}
		
	}
//-----------------------	
	//echo $sql;
	$temp=mysql_query($sql);
	$this->childs_count=mysql_num_rows($temp);


	for($i=0;$i<$this->childs_count;$i++)
	{
		$sql='select val from '.$this->pr.'values_str where id_part='.$this->id.' and id_type='.mysql_result($temp,$i,0).' and id='.mysql_result($temp,$i,1).' and id_fld=1';
	    $nm=mysql_query($sql);
	    $nm=mysql_result($nm,0,0);
		
		
		$object_params["mode"]=$this->params["mode"];
		$object_params["id_part"]=$this->id;
		$object_params["id_type"]=mysql_result($temp,$i,0);
		$object_params["id"]=mysql_result($temp,$i,1);
		$object_params["name"]=$nm;
		$object_params["sid"]=mysql_result($temp,$i,2);
		$object_params["path"]=$this->get_path().$object_params["sid"].'/';
        $object_params["idx"]=mysql_result($temp,$i,3);
		$object_params["active"]=mysql_result($temp,$i,4);
		$object_params["child_count"]=$this->child_count;
		$object_params["start"]=$this->start;
		
		$object_params["sort"]=$this->params["sort"];
		
		$this->childs[mysql_result($temp,$i,0)][mysql_result($temp,$i,1)]=new object($object_params,$this->permit);
		
		$this->childs_index[$i][0]=mysql_result($temp,$i,0);
		$this->childs_index[$i][1]=mysql_result($temp,$i,1);
			
	}	
}
//--------------------------------------------------------------------------------------------
function get_text()
{
	if(!empty($this->text)) return $this->text;
	
	$sql='select txt from '.$this->pr.'part where id_part='.$this->id;
	$temp=mysql_query($sql);
	$this->text=mysql_result($temp,0,0);
	
	return stripslashes($this->text);
}
//--------------------------------------------------------------------------------------------
function get_rubric()
{
	if($this->rubric_count>0) return;
	
	$sql='select id_r,name,sid from '.$this->pr.'rubric where id_part='.$this->id.' and parent=0 order by idx';
	$temp=mysql_query($sql);
	$this->rubric_count=mysql_num_rows($temp);
	
	for($i=0;$i<$this->rubric_count;$i++)
	{
		$rubric_params["mode"]=$this->params["mode"];
		$rubric_params["id_part"]=$this->id;
		$rubric_params["id_r"]=mysql_result($temp,$i,0);
		$rubric_params["name"]=mysql_result($temp,$i,1);
		$rubric_params["sid"]=mysql_result($temp,$i,2);
		$rubric_params["child_count"]=$this->child_count;
		$rubric_params["start"]=$this->start;
		$rubric_params["path"]=$this->get_path().$rubric_params["sid"].'/';
		
		$rubric_params["sort"]=$this->params["sort"];
		
		$this->rubric[mysql_result($temp,$i,0)]=new rubric($rubric_params,$this->permit);
		$this->rubric_index[$i]=mysql_result($temp,$i,0);
	}
}
//--------------------------------------------------------------------------------------------
function get_type()
{
	if($this->type_count>0) return;
	
	$sql='select id_type from '.$this->pr.'part_type where id_part='.$this->id.' order by id_type';
	$temp=mysql_query($sql);
	$this->type_count=mysql_num_rows($temp);
	
	for($i=0;$i<$this->type_count;$i++)
		$this->type[$i]=mysql_result($temp,$i,0);

}
//--------------------------------------------------------------------------------------------
function actions($url)
{
	if($this->permit==1)
	{
		$str='<ul>';
		$str.='<li><a href="'.$this->get_path($url).'action-arrange/">Упорядочить дочерние объекты</a>|</li>';
		$str.='<li><a href="'.$this->get_path($url).'action-edit/">Редактировать</a>|</li>';
		if($this->active) $str.='<li class="ap"><a href="'.$this->get_path($url).'action-deactivate/">Деактивировать</a>|</li>';
		else $str.='<li class="ag"><a href="'.$this->get_path($url).'action-activate/">Активировать</a>|</li>';
		$str.='<li class="ar"><a href="'.$this->get_path($url).'action-delete/">Удалить</a></li>';
		$str.='</ul>';
		
		return $str;	
	}
	else return;
}
//---------------------------------------------------------------------------------------------------
function get_meta()
{
 $sql='select title,description from '.$this->pr.'meta where id_part='.$this->id.' and id_type=0 and id=0';
 $temp=mysql_query($sql);
 $this->title=mysql_result($temp,0,0);
 $this->description=mysql_result($temp,0,1);
 
 $sql='select '.$this->pr.'keyword.word from '.$this->pr.'keyword inner join '.$this->pr.'object_keyword on '.$this->pr.'keyword.id_key='.$this->pr.'object_keyword.id_key where '.$this->pr.'object_keyword.id_part='.$this->id.' and '.$this->pr.'object_keyword.id_type=0 and '.$this->pr.'object_keyword.id=0';
 $temp=mysql_query($sql);
 $temp_rows=mysql_num_rows($temp);
 
 if($temp_rows>0)
 {
  $this->keyword=mysql_result($temp,0,0);
 
  for($i=1;$i<$temp_rows;$i++)
   $this->keyword.=', '.mysql_result($temp,$i,0);
  
 }
}
//---------------------------------------------------------------------------------------------------
function get_files()
{
	$id_part=$this->id;
	$id_type=0;
	$id=0;
	
	$sql='select id_file,path,preview,filename,type,ext,alt,size from '.$this->pr.'file where id_part='.$id_part.' and id_type='.$id_type.' and id='.$id.' order by type asc, id_file asc';
	$temp=mysql_query($sql);
	$this->files_count=mysql_num_rows($temp);
	
	for($i=0;$i<$this->files_count;$i++)
	{
		$this->files[$i]["id"]=mysql_result($temp,$i,0);
		$this->files[$i]["path"]=mysql_result($temp,$i,1);
		$this->files[$i]["preview"]=mysql_result($temp,$i,2);
		$this->files[$i]["name"]=mysql_result($temp,$i,3);
		$this->files[$i]["type"]=mysql_result($temp,$i,4);
		$this->files[$i]["ext"]=mysql_result($temp,$i,5);
		$this->files[$i]["alt"]=mysql_result($temp,$i,6);
		$this->files[$i]["size"]=mysql_result($temp,$i,7);
	}
}
//--------------------------------------------------------------------------------------------    
};
?>