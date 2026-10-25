<?php
class keyword
{
  var $pr;
  
  var $id_part;
  var $id_key;
  var $word;
  var $sid;
  var $path;

  var $params;

  var $child_count;
  var $childs_count;
  var $childs;
  var $childs_index;
  
  var $title;
  var $description;
  var $keyword;  

  var $permit;
//----------------------------------------------------------------------------------------------------------------
function keyword($params,$permit)
{
//---get vars-------------------------------
 	global $pr;

 	global $mode;

    $this->pr=$pr;

	$this->id_part=$params["id_part"];
	$this->id_key=$params["id"];
	$this->word=$params["word"];
    $this->sid=$params["sid"];
	$this->permit=$permit;
	$this->child_count=$params["child_count"];

	$this->params=$params;
}
//--------------------------------------------------------------------------------------------
function get_path($pref)
{
	if(empty($this->path))
	{
		$this->path=$this->sid.'/';

  		$sql='select sid,idx from '.$this->pr.'part where id_part='.$this->id_part;
		$t=mysql_query($sql);
		$tsid=mysql_result($t,0,0);
		$tidx=mysql_result($t,0,1);
		
		if($tidx==0 && !empty($tsid)) $this->path='/'.$tsid.$this->path;
	}
	if(strpos($this->path,"/temy/")!==false) return $pref.$this->path;
	else return $pref.'/temy/'.$this->path;
}
//--------------------------------------------------------------------------------------------------------
function get_child($mod,$type,$count,$field)
{
	if($mod=="normal")
	{
		if($this->permit>0) $sql='select '.$this->pr.'object.id_type, '.$this->pr.'object.id, '.$this->pr.'object.sid, '.$this->pr.'object.active from '.$this->pr.'object inner join '.$this->pr.'object_keyword on '.$this->pr.'object.id_part='.$this->pr.'object_keyword.id_part and '.$this->pr.'object.id_type='.$this->pr.'object_keyword.id_type and '.$this->pr.'object.id='.$this->pr.'object_keyword.id where '.$this->pr.'object_keyword.id_part='.$this->id_part.' and '.$this->pr.'object_keyword.id_key='.$this->id_key;
		else $sql='select '.$this->pr.'object.id_type, '.$this->pr.'object.id, '.$this->pr.'object.sid, '.$this->pr.'object.active from '.$this->pr.'object inner join '.$this->pr.'object_keyword on '.$this->pr.'object.id_part='.$this->pr.'object_keyword.id_part and '.$this->pr.'object.id_type='.$this->pr.'object_keyword.id_type and '.$this->pr.'object.id='.$this->pr.'object_keyword.id where '.$this->pr.'object.tadd<=NOW() and '.$this->pr.'object.active=1 and  '.$this->pr.'object_keyword.id_part='.$this->id_part.' and '.$this->pr.'object_keyword.id_key='.$this->id_key;
		if(!empty($type)) $sql.=' and '.$this->pr.'object.id_type='.$type;	
		$sql.=' order by '.$this->pr.'object.idx asc, '.$this->pr.'object.tadd desc';
		if(!empty($this->child_count)) $sql.=' limit '.($this->start*$this->child_count).','.$this->child_count;
	}
//-----------------------
	if($mod=="special")
	{
		if($this->permit>0) $sql='select '.$this->pr.'object.id_type, '.$this->pr.'object.id, '.$this->pr.'object.sid, '.$this->pr.'object.active from '.$this->pr.'object inner join '.$this->pr.'object_keyword on '.$this->pr.'object.id_part='.$this->pr.'object_keyword.id_part and '.$this->pr.'object.id_type='.$this->pr.'object_keyword.id_type and '.$this->pr.'object.id='.$this->pr.'object_keyword.id where '.$this->pr.'object_keyword.id_part='.$this->id_part.' and '.$this->pr.'object_keyword.id_key='.$this->id_key;
		else $sql='select '.$this->pr.'object.id_type, '.$this->pr.'object.id, '.$this->pr.'object.sid, '.$this->pr.'object.active from '.$this->pr.'object inner join '.$this->pr.'object_keyword on '.$this->pr.'object.id_part='.$this->pr.'object_keyword.id_part and '.$this->pr.'object.id_type='.$this->pr.'object_keyword.id_type and '.$this->pr.'object.id='.$this->pr.'object_keyword.id where '.$this->pr.'object.tadd<=NOW() and '.$this->pr.'object.active=1 and  '.$this->pr.'object_keyword.id_part='.$this->id_part.' and '.$this->pr.'object_keyword.id_key='.$this->id_key;
		
		if(!empty($type)) $sql.=' and '.$this->pr.'object.id_type='.$type;
		 		
		$sql.=' order by '.$this->pr.'object.idx asc, '.$this->pr.'object.tadd desc';
		
		if($count!="all" && !empty($this->child_count))
		{
		 if(empty($count)) $sql.=' limit '.($this->start*$this->child_count).','.$this->child_count;
		 else $sql.=' limit '.($this->start*$count).','.$count;
		}
		
	}
//-----------------------	
if($mod=="sort")
	{
		$sql='select '.$this->pr.'object.id_type, '.$this->pr.'object.id, '.$this->pr.'object.sid, '.$this->pr.'object.active from '.$this->pr.'object inner join '.$this->pr.'object_keyword on '.$this->pr.'object.id_part='.$this->pr.'object_keyword.id_part and '.$this->pr.'object.id_type='.$this->pr.'object_keyword.id_type and '.$this->pr.'object.id='.$this->pr.'object_keyword.id';
		
	
		if($this->params["sort"]==1 && $this->params["stype"]>0 && $this->params["sfld"]>0)
		{
			switch($this->params["stype"])
		    {
		       case 1 : $sql.=' left join '.$this->pr.'values_digit on '.$this->pr.'values_digit.id_part='.$this->pr.'object.id_part and '.$this->pr.'values_digit.id_type='.$this->pr.'object.id_type and '.$this->pr.'values_digit.id='.$this->pr.'object.id where '.$this->pr.'values_digit.id_fld='.$this->params["sfld"].' and';
		       			$table=$this->pr.'values_digit';
		                break;	
		       case 2 : $sql.=' left join '.$this->pr.'values_str on '.$this->pr.'values_str.id_part='.$this->pr.'object.id_part and '.$this->pr.'values_str.id_type='.$this->pr.'object.id_type and '.$this->pr.'values_str.id='.$this->pr.'object.id where '.$this->pr.'values_str.id_fld='.$this->params["sfld"].' and';
			   			$table=$this->pr.'values_str';	
		                break;	
		       case 3 : $sql.=' left join '.$this->pr.'values_text on '.$this->pr.'values_text.id_part='.$this->pr.'object.id_part and '.$this->pr.'values_text.id_type='.$this->pr.'object.id_type and '.$this->pr.'values_text.id='.$this->pr.'object.id where '.$this->pr.'values_text.id_fld='.$this->params["sfld"].' and';
			   			$table=$this->pr.'values_text';	
		                break;	
		       case 4 : $sql.=' left join '.$this->pr.'values_date on '.$this->pr.'values_date.id_part='.$this->pr.'object.id_part and '.$this->pr.'values_date.id_type='.$this->pr.'object.id_type and '.$this->pr.'values_date.id='.$this->pr.'object.id where '.$this->pr.'values_date.id_fld='.$this->params["sfld"].' and';	
		                $table=$this->pr.'values_date';
						break;	
		    }
		}
		else $sql.=' where';	
		
		if($this->permit>0) $sql.=' '.$this->pr.'object_keyword.id_part='.$this->id_part.' and '.$this->pr.'object_keyword.id_key='.$this->id_key;
		else $sql.=' '.$this->pr.'object.tadd<=NOW() and '.$this->pr.'object.active=1 and '.$this->pr.'object_keyword.id_part='.$this->id_part.' and '.$this->pr.'object_keyword.id_key='.$this->id_key;
		
		if(!empty($type)) $sql.=' and '.$this->pr.'object.id_type='.$type;
		 		
		if($this->params["sort"]==1 && $this->params["stype"]>0 && $this->params["sfld"]>0) $sql.=' order by '.$table.'.val';
		else $sql.=' order by '.$this->pr.'object.tadd';
		
		if($this->params["sdesc"]==1) $sql.=' desc';
		
		if(empty($count)) $sql.=' limit '.($this->start*$this->child_count).','.$this->child_count;
		if(!empty($count) && $count!="all") $sql.=' limit '.($this->start*$count).','.$count;	
		
	
	}
//-----------------------
	if($mod=="parent")
	{
		if($this->permit>0) $sql='select '.$this->pr.'object.id_type, '.$this->pr.'object.id, '.$this->pr.'object.sid, '.$this->pr.'object.active from '.$this->pr.'object inner join '.$this->pr.'object_keyword on '.$this->pr.'object.id_part='.$this->pr.'object_keyword.id_part and '.$this->pr.'object.id_type='.$this->pr.'object_keyword.id_type and '.$this->pr.'object.id='.$this->pr.'object_keyword.id where '.$this->pr.'object_keyword.id_part='.$this->id_part.' and '.$this->pr.'object_keyword.id_key='.$this->id_key;
		else $sql='select '.$this->pr.'object.id_type, '.$this->pr.'object.id, '.$this->pr.'object.sid, '.$this->pr.'object.active from '.$this->pr.'object inner join '.$this->pr.'object_keyword on '.$this->pr.'object.id_part='.$this->pr.'object_keyword.id_part and '.$this->pr.'object.id_type='.$this->pr.'object_keyword.id_type and '.$this->pr.'object.id='.$this->pr.'object_keyword.id where '.$this->pr.'object.tadd<=NOW() and '.$this->pr.'object.active=1 and  '.$this->pr.'object_keyword.id_part='.$this->id_part.' and '.$this->pr.'object_keyword.id_key='.$this->id_key;
		
		if(!empty($type)) $sql.=' and '.$this->pr.'object.ptype='.$type.' and '.$this->pr.'object.pid='.$field;
		 		
		$sql.=' order by '.$this->pr.'object.idx';
		
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
		$sql='select val from '.$this->pr.'values_str where id_part='.$this->id_part.' and id_type='.mysql_result($temp,$i,0).' and id='.mysql_result($temp,$i,1).' and id_fld=1';
	    $nm=mysql_query($sql);
	    $nm=mysql_result($nm,0,0);
		
		
		$object_params["mode"]=$this->params["mode"];
		$object_params["id_part"]=$this->id_part;
		$object_params["id_type"]=mysql_result($temp,$i,0);
		$object_params["id"]=mysql_result($temp,$i,1);
		$object_params["name"]=$nm;
		$object_params["sid"]=mysql_result($temp,$i,2);
		$object_params["active"]=mysql_result($temp,$i,3);
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
	
	$sql='select txt from '.$this->pr.'keyword where id_key='.$this->id_key;
	$temp=mysql_query($sql);
	$this->text=mysql_result($temp,0,0);
	
	return $this->text;
}
//---------------------------------------------------------------------------------------------------
function get_meta()
{
 $sql='select title,description,keywords from '.$this->pr.'keyword where id_key='.$this->id_key;
 $temp=mysql_query($sql);
 $this->title=mysql_result($temp,0,0);
 $this->description=mysql_result($temp,0,1);
 $this->keyword=mysql_result($temp,0,2);
}
//--------------------------------------------------------------------------------------------
};
?>