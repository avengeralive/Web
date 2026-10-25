<?php
class object
{
  var $pr;
  
  var $id_part;
  var $id_type;
  var $id;
  var $sid;
  var $name;
  var $active;
  var $idx;
  var $id_u;
  var $u_name;
  
  var $path;
  
  var $permit;
  
  var $ptype;
  var $pid;

  var $field_count;
  var $field;
	
  var $childs_count;
  var $childs;
  var $childs_index;
	
  var $child_count;
  var $total_count;
  var $start;

  var $files_count;
  var $img_count;
  var $files;
  
 var $title;
 var $description;
 var $keyword;
 
 var $rubric;
 var $rubric_count;
 
 var $date_add;
 var $date_modify;
 
 var $params;
 
 var $keywords;
 
 var $nonrelated;
//----------------------------------------------------------------------------------------------------------------
function object($params,$permit)
{
//---get vars-------------------------------
 	global $pr;

 	global $mode;

    $this->pr=$pr;

	$this->id_part=$params["id_part"];
    $this->id_type=$params["id_type"];
	$this->id=$params["id"];
    $this->idx=$params["idx"];
	$this->name=$params["name"];
	$this->sid=$params["sid"];
	$this->active=$params["active"];
	$this->path=$params["path"];
	$this->permit=$permit;

	$this->params=$params;
	
	
	$this->child_count=$params["child_count"];
	
	$this->start=$params["start"];
	
	if(empty($this->child_count) || empty($this->idx) || empty($this->sid))
	{
		$sql='select list,`idx`,sid,active from '.$pr.'object where id_part='.$this->id_part.' and id_type='.$this->id_type.' and id='.$this->id;
		$temp=mysql_query($sql);
		if(empty($params["child_count"])) $this->child_count=mysql_result($temp,0,0);
        $this->idx=mysql_result($temp,0,1);
        $this->sid=mysql_result($temp,0,2);
        $this->active=mysql_result($temp,0,3);
			
	}
	if(empty($this->name))
	{
		$sql='select val from '.$this->pr.'values_str where id_part='.$this->id_part.' and id_type='.$this->id_type.' and id='.$this->id.' and id_fld=1';
	    $nm=mysql_query($sql);
	    $nm=mysql_result($nm,0,0);
	    $this->name=stripslashes($nm);
	}
}
//--------------------------------------------------------------------------------------------
function get_parent($create)
{
			$sql='select ptype,pid from '.$this->pr.'object where id_part='.$this->id_part.' and id_type='.$this->id_type.' and id='.$this->id;
//			echo $sql;
			$t=mysql_query($sql);
			$this->ptype=mysql_result($t,0,0);
			$this->pid=mysql_result($t,0,1);
            
            if(empty($create)) return 1;
    
    $object_params["id_part"]=$this->id_part;
	$object_params["id_type"]=$this->ptype;
	$object_params["id"]=$this->pid;
	$object_params["active"]=1;

    $obj=new object($object_params,$this->permit);
    
    return $obj;
}
//--------------------------------------------------------------------------------------------
function get_rel()
{
			$sql='select nonrelated from '.$this->pr.'object where id_part='.$this->id_part.' and id_type='.$this->id_type.' and id='.$this->id;
//			echo $sql;
			$t=mysql_query($sql);
			$this->nonrelated=mysql_result($t,0,0);
			
return 1;
}
//--------------------------------------------------------------------------------------------
function get_path($pref)
{
//	echo $this->path;
	if(empty($this->path))
	{
		$this->path='/';
		$ttype=$this->id_type;
		$tid=$this->id;
		
		do
		{
			$sql='select sid,ptype,pid from '.$this->pr.'object where id_part='.$this->id_part.' and id_type='.$ttype.' and id='.$tid;
//			echo $sql;
			$t=mysql_query($sql);
			$tsid=mysql_result($t,0,0);
			$ttype=mysql_result($t,0,1);
			$tid=mysql_result($t,0,2);
			
			if(!empty($tsid)) $this->path='/'.$tsid.$this->path;				
			
		}while($tid>0);
		
		$sql='select sid,idx from '.$this->pr.'part where id_part='.$this->id_part;
		$t=mysql_query($sql);
		$tsid=mysql_result($t,0,0);
		$tidx=mysql_result($t,0,1);
		
		if($tidx==0 && !empty($tsid)) $this->path='/'.$tsid.$this->path;
	}
	return $pref.$this->path;
}
//------------------------------------------------------------------------------------------------------------
function get_child($mod,$type,$count,$field)
{
    //echo '<!--'.$mod.'-->';
	if($mod=="normal")
	{
		if($this->permit>0) $sql='select id_type, id, sid, idx, active from '.$this->pr.'object where id_part='.$this->id_part.' and ptype='.$this->id_type.' and pid='.$this->id.' order by idx asc, tadd desc limit '.($this->start*$this->child_count).','.$this->child_count;
		else $sql='select id_type, id, sid, idx from '.$this->pr.'object where tadd<=NOW() and active=1 and id_part='.$this->id_part.' and ptype='.$this->id_type.' and pid='.$this->id.' order by idx asc, tadd desc limit '.($this->start*$this->child_count).','.$this->child_count;
	}
//-----------------------
	if($mod=="special")
	{
		if($this->permit>0) $sql='select id_type, id, sid,idx, active from '.$this->pr.'object where id_part='.$this->id_part.' and ptype='.$this->id_type.' and pid='.$this->id;
		else $sql='select id_type, id, sid,idx from '.$this->pr.'object where tadd<=NOW() and active=1 and id_part='.$this->id_part.' and ptype='.$this->id_type.' and pid='.$this->id;
		
		if(!empty($type)) $sql.=' and id_type='.$type;
		 		
		$sql.=' order by idx asc, tadd desc';
		
		if($count!="all")		
		{
		 if(empty($count)) $sql.=' limit '.($this->start*$this->child_count).','.$this->child_count;
		 else $sql.=' limit 0,'.$count;
		}
		
	}
//-----------------------    
    if($mod=="subchild")
	{
		if($this->permit>0) $sql='select m1.id_type, m1.id, m1.sid,m1.idx, m1.active from '.$this->pr.'object as m1 inner join '.$this->pr.'object as m2 on m1.id_part=m2.id_part and m1.ptype=m2.id_type and m1.pid=m2.id where m1.id_part='.$this->id_part.' and m2.ptype='.$this->id_type.' and m2.pid='.$this->id;
		else $sql='select m1.id_type, m1.id, m1.sid,m1.idx, m1.active from '.$this->pr.'object as m1 inner join '.$this->pr.'object as m2 on m1.id_part=m2.id_part and m1.ptype=m2.id_type and m1.pid=m2.id where  m1.id_part='.$this->id_part.' and m1.tadd<=NOW() and m1.active=1 and m2.ptype='.$this->id_type.' and m2.pid='.$this->id;
          
		
		if(!empty($type)) $sql.=' and m1.id_type='.$type;
		 		
		$sql.=' order by m1.idx asc, m1.tadd desc';
		
		if(intval($count)==$count && $count!="all")		
		{
		 if(empty($count)) $sql.=' limit '.($this->start*$this->child_count).','.$this->child_count;
		 else $sql.=' limit '.($this->start*$count).','.$count;
		}
		
	}
//-----------------------
if($mod=="rubric")
	{
		if($this->permit>0) $sql='select '.$this->pr.'object.id_type, '.$this->pr.'object.id, '.$this->pr.'object.sid, '.$this->pr.'object.idx, '.$this->pr.'object.active from '.$this->pr.'object inner join '.$this->pr.'object_rubric  using(id_part,id_type,id) inner join '.$this->pr.'rubric using(id_r) where '.$this->pr.'object.id_part='.$this->id_part.' and '.$this->pr.'object.ptype='.$this->id_type.' and '.$this->pr.'object.pid='.$this->id.' and '.$this->pr.'rubric.sid="'.$this->params["sort"][2].'" order by '.$this->pr.'object.idx asc, '.$this->pr.'object.tadd desc';
		else $sql='select '.$this->pr.'object.id_type, '.$this->pr.'object.id, '.$this->pr.'object.sid, '.$this->pr.'object.idx, '.$this->pr.'object.active from '.$this->pr.'object inner join '.$this->pr.'object_rubric  using(id_part,id_type,id) inner join '.$this->pr.'rubric using(id_r) where '.$this->pr.'object.active=1 and '.$this->pr.'object.id_part='.$this->id_part.' and '.$this->pr.'object.ptype='.$this->id_type.' and '.$this->pr.'object.pid='.$this->id.' and '.$this->pr.'rubric.sid="'.$this->params["sort"][2].'" order by '.$this->pr.'object.idx asc, '.$this->pr.'object.tadd desc';
        
        if(strcasecmp($count,"all"))		
		{
		 if(empty($count)) $sql.=' limit '.($this->start*$this->child_count).','.$this->child_count;
		 else $sql.=' limit '.($this->start*$count).','.$count;
		}
	}
//-----------------------
if($mod=="rubric-sort")
	{
	   $sql='select o.id_type, o.id, o.sid, o.idx, o.active from '.$this->pr.'object as o inner join '.$this->pr.'object_rubric as or1 using(id_part,id_type,id) inner join '.$this->pr.'rubric as r using(id_r)';
       if($this->params["sort"]["type"]>0 && $this->params["sort"]["field"]>0)
		{
			switch($this->params["sort"]["type"])
		    {
		       case 1 : $table=$this->pr.'values_digit';
		                break;	
		       case 2 : $table=$this->pr.'values_str';	
		                break;	
		       case 3 : $table=$this->pr.'values_text';	
		                break;	
		       case 4 : $table=$this->pr.'values_date';
						break;	
		    }
            $sql.=' inner join '.$table.' as v ON o.id_part = v.id_part AND o.id_type = v.id_type AND o.id = v.id where v.id_fld='.$this->params["sort"]["field"].' and';
		}
		else $sql.=' where';
        
        $sql.=' o.id_part='.$this->id_part.' and o.ptype='.$this->id_type.' and o.pid='.$this->id.' and r.sid="'.$this->params["sort"][2].'"';
        if($this->permit<=0) $sql.=' and o.active=1 and o.tadd<=NOW()';
        
        $sql.=' order by';
        if($this->params["sort"]["type"]>0 && $this->params["sort"]["field"]>0)
        {
          $sql.=' v.val';
          if($this->params["sort"]["dir"]==1) $sql.=' desc,';
          else   $sql.=' asc,';
        } 
        $sql.=' o.idx asc, o.tadd desc';

	}    
//-----------------------
if($mod=="subchild-rubric")
	{
		if($this->permit>0) $sql='select '.$this->pr.'object.id_type, '.$this->pr.'object.id, '.$this->pr.'object.sid, '.$this->pr.'object.idx, '.$this->pr.'object.active from '.$this->pr.'object inner join '.$this->pr.'object_rubric  using(id_part,id_type,id) inner join '.$this->pr.'rubric using(id_r) where '.$this->pr.'object.id_part='.$this->id_part.' and '.$this->pr.'object.ptype='.$this->id_type.' and '.$this->pr.'object.pid in (select id from '.$this->pr.'object where id_part='.$this->id_part.' and pid='.$this->id.' and ptype='.$this->id_type.') and '.$this->pr.'rubric.sid="'.$this->params["sort"][2].'" order by '.$this->pr.'object.idx asc, '.$this->pr.'object.tadd desc';
		else $sql='select '.$this->pr.'object.id_type, '.$this->pr.'object.id, '.$this->pr.'object.sid, '.$this->pr.'object.idx, '.$this->pr.'object.active from '.$this->pr.'object inner join '.$this->pr.'object_rubric  using(id_part,id_type,id) inner join '.$this->pr.'rubric using(id_r) where '.$this->pr.'object.active=1 and '.$this->pr.'object.id_part='.$this->id_part.' and '.$this->pr.'object.ptype='.$this->id_type.' and '.$this->pr.'object.pid in (select id from '.$this->pr.'object where id_part='.$this->id_part.' and pid='.$this->id.' and ptype='.$this->id_type.') and '.$this->pr.'rubric.sid="'.$this->params["sort"][2].'" order by '.$this->pr.'object.idx asc, '.$this->pr.'object.tadd desc';
	}    
//-----------------------    
    if($mod=="subchild-sort")
	{
		$sql='select m1.id_type, m1.id, m1.sid,m1.idx, m1.active from '.$this->pr.'object as m1 inner join '.$this->pr.'object as m2 on m1.id_part=m2.id_part and m1.ptype=m2.id_type and m1.pid=m2.id';
	 
        if($this->params["sort"][0]==1 && $this->params["sort"][1]>0 && $this->params["sort"][2]>0)
		{
			switch($this->params["sort"][1])
		    {
		       case 1 : $sql.=' inner join '.$this->pr.'values_digit as m3';
		       			break;	
		       case 2 : $sql.=' inner join '.$this->pr.'values_str  as m3';
		                break;	
		       case 3 : $sql.=' inner join '.$this->pr.'values_text  as m3';
		                break;	
		       case 4 : $sql.=' inner join '.$this->pr.'values_date  as m3';	
    					break;	
		    }
            $sql.=' on m3.id_part=m1.id_part and m3.id_type=m1.id_type and m3.id=m1.id where m3.id_fld='.$this->params["sort"][2].' and';
		}
		else $sql.=' where';	
		
		if($this->permit>0) $sql.=' m1.id_part='.$this->id_part.' and m2.ptype='.$this->id_type.' and m2.pid='.$this->id;
		else $sql.=' m1.id_part='.$this->id_part.' and m1.tadd<=NOW() and m1.active=1 and m2.ptype='.$this->id_type.' and m2.pid='.$this->id;
		
		if(!empty($type)) $sql.=' and m1.id_type='.$type;
		 		
		if($this->params["sort"][0]==1 && $this->params["sort"][1]>0 && $this->params["sort"][2]>0 && empty($this->params["sort"][4])) $sql.=' order by m2.idx,m3.val';
        elseif ($this->params["sort"][0]==1 && $this->params["sort"][1]>0 && $this->params["sort"][2]>0 && $this->params["sort"][4]==1) $sql.=' order by m3.val';
		else $sql.=' order by m2.idx,m2.tadd';
		
		if($this->params["sort"][3]==1) $sql.=' desc';
		
		if(empty($count)) $sql.=' limit '.($this->start*$this->child_count).','.$this->child_count;
		if(!empty($count) && $count!="all") $sql.=' limit '.($this->start*$count).','.$count;
	}    
//-----------------------
	if($mod=="sort")
	{
		$sql='select '.$this->pr.'object.id_type, '.$this->pr.'object.id, '.$this->pr.'object.sid, '.$this->pr.'object.idx, '.$this->pr.'object.active from '.$this->pr.'object';
		
	
		if($this->params["sort"][0]==1 && $this->params["sort"][1]>0 && $this->params["sort"][2]>0)
		{
			switch($this->params["sort"][1])
		    {
		       case 1 : $sql.=' inner join '.$this->pr.'values_digit on '.$this->pr.'values_digit.id_part='.$this->pr.'object.id_part and '.$this->pr.'values_digit.id_type='.$this->pr.'object.id_type and '.$this->pr.'values_digit.id='.$this->pr.'object.id where '.$this->pr.'values_digit.id_fld='.$this->params["sort"][2].' and';
		       			$table=$this->pr.'values_digit';
		                break;	
		       case 2 : $sql.=' inner join '.$this->pr.'values_str on '.$this->pr.'values_str.id_part='.$this->pr.'object.id_part and '.$this->pr.'values_str.id_type='.$this->pr.'object.id_type and '.$this->pr.'values_str.id='.$this->pr.'object.id where '.$this->pr.'values_str.id_fld='.$this->params["sort"][2].' and';
			   			$table=$this->pr.'values_str';	
		                break;	
		       case 3 : $sql.=' inner join '.$this->pr.'values_text on '.$this->pr.'values_text.id_part='.$this->pr.'object.id_part and '.$this->pr.'values_text.id_type='.$this->pr.'object.id_type and '.$this->pr.'values_text.id='.$this->pr.'object.id where '.$this->pr.'values_text.id_fld='.$this->params["sort"][2].' and';
			   			$table=$this->pr.'values_text';	
		                break;	
		       case 4 : $sql.=' inner join '.$this->pr.'values_date on '.$this->pr.'values_date.id_part='.$this->pr.'object.id_part and '.$this->pr.'values_date.id_type='.$this->pr.'object.id_type and '.$this->pr.'values_date.id='.$this->pr.'object.id where '.$this->pr.'values_date.id_fld='.$this->params["sort"][2].' and';	
		                $table=$this->pr.'values_date';
						break;	
		    }
		}
		else $sql.=' where';	
		
		if($this->permit>0) $sql.=' '.$this->pr.'object.id_part='.$this->id_part.' and '.$this->pr.'object.ptype='.$this->id_type.' and '.$this->pr.'object.pid='.$this->id;
		else $sql.=' '.$this->pr.'object.tadd<=NOW() and '.$this->pr.'object.active=1 and '.$this->pr.'object.id_part='.$this->id_part.' and '.$this->pr.'object.ptype='.$this->id_type.' and '.$this->pr.'object.pid='.$this->id;
		
		if(!empty($type)) $sql.=' and '.$this->pr.'object.id_type='.$type;
		 		
		if($this->params["sort"][0]==1 && $this->params["sort"][1]>0 && $this->params["sort"][2]>0 && empty($this->params["sort"][4])) $sql.=' order by '.$this->pr.'object.idx,'.$table.'.val';
        elseif ($this->params["sort"][0]==1 && $this->params["sort"][1]>0 && $this->params["sort"][2]>0 && $this->params["sort"][4]==1) $sql.=' order by '.$table.'.val';
		else $sql.=' order by '.$this->pr.'object.idx,'.$this->pr.'object.tadd';
		
		if($this->params["sort"][3]==1) $sql.=' desc';
		
		if(empty($count)) $sql.=' limit '.($this->start*$this->child_count).','.$this->child_count;
		if(!empty($count) && $count!="all") $sql.=' limit '.($this->start*$count).','.$count;	
		

	
	}	
//-----------------------
    //echo '<!--'.$sql.'-->';	
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
		$object_params["name"]=stripslashes($nm);
		$object_params["sid"]=mysql_result($temp,$i,2);
		if($mod!="subchild" && $mod!="subchild-rubric") $object_params["path"]=$this->get_path().$object_params["sid"].'/';
        $object_params["idx"]=mysql_result($temp,$i,3);
		$object_params["active"]=mysql_result($temp,$i,4);
		$object_params["child_count"]=$this->child_count;
		$object_params["start"]=$this->start;
		
		$object_params["sort"]=$this->params["sort"];
		
		$this->childs[mysql_result($temp,$i,0)][mysql_result($temp,$i,1)]=new object($object_params,$this->permit);
		
		$this->childs_index[$i][0]=mysql_result($temp,$i,0);
		$this->childs_index[$i][1]=mysql_result($temp,$i,1);			
	}
    
    return $sql;	
}
//---------------------------------------------------------------------------------------------------
function get_child_intersect($mod,$type,$count,$field,$t_id_r,$calc_count)
{
        $mod=explode(' ',$mod);
    
		$child_sql='select distinct o.id_type, o.id, o.sid, o.active ';
        $count_sql='select count(*) ';
         
        $sql='from '.$this->pr.'object as o';
        
        if(in_array("subchild",$mod)) $sql.=' inner join '.$this->pr.'object as m2 on o.id_part=m2.id_part and o.ptype=m2.id_type and o.pid=m2.id';
        
        if(count($t_id_r)>0)
        {
            $code=1;
            foreach($t_id_r as $tr)
            {
                if(in_array("union",$mod))
                {
                    if(count($tr)>0) $sql.=' inner join '.$this->pr.'object_rubric as or'.$code.' on o.id_part=or'.$code.'.id_part and o.id_type=or'.$code.'.id_type and o.id=or'.$code.'.id';
                    $code++;
                }
                else
                {
                    foreach($tr as $ttr)
                    {
                        $sql.=' inner join '.$this->pr.'object_rubric as or'.$code.' on o.id_part=or'.$code.'.id_part and o.id_type=or'.$code.'.id_type and o.id=or'.$code.'.id';
                        $code++;
                    }
                }
            }
        }
        
        if(count($this->params["search"])>0)
        {
            $code=1;
            foreach($this->params["search"] as $val)
            {
                if($val["fld"]>0 && ($val["gt"]>0 || $val["lt"]>0)) 
                {
                    $sql.=' inner join '.$this->pr.'values_digit as v'.$code.' on v'.$code.'.id_part=o.id_part and v'.$code.'.id_type=o.id_type and v'.$code.'.id=o.id';
                    if($val["max"]>0) 
                    {
                        $code++;
                        $sql.=' inner join '.$this->pr.'values_digit as v'.$code.' on v'.$code.'.id_part=o.id_part and v'.$code.'.id_type=o.id_type and v'.$code.'.id=o.id';
                    }
                }
                $code++;
            }
        }
		
	
		if($this->params["sort"]==1 && $this->params["stype"]>0 && $this->params["sfld"]>0)
		{
			switch($this->params["stype"])
		    {
		       case 1 : $table=$this->pr.'values_digit';
		                break;	
		       case 2 : $table=$this->pr.'values_str';	
		                break;	
		       case 3 : $table=$this->pr.'values_text';	
		                break;	
		       case 4 : $table=$this->pr.'values_date';
						break;	
		    }
            $sql.=' inner join '.$table.' as v on v.id_part=o.id_part and v.id_type=o.id_type and v.id=o.id where v.id_fld='.$this->params["sfld"].' and';
		}
		else $sql.=' where';
        
        if($this->permit==0) $sql.=' o.tadd<=NOW() and o.active=1 and';
        
        
        if(in_array("subchild",$mod)) $sql.=' m2.ptype='.$this->id_type.' and m2.pid='.$this->id;
        else $sql.=' o.ptype='.$this->id_type.' and o.pid='.$this->id;
        
        if(count($t_id_r)>0)
        {
            $code=1;
            $sscode=1;
            foreach($t_id_r as $tr)
            {
                $scode=1;
                foreach($tr as $val)
                {
                    if(in_array("union",$mod))
                    {
                        if($scode==1) $sql.=' and (';
                        if($scode==1) $sql.='or'.$code.'.id_r='.$val;
                        else $sql.=' or or'.$code.'.id_r='.$val;    
                    }
                    else
                    {
                        if($val>0) $sql.=' and or'.$sscode.'.id_r='.$val;
                        else $sql.=' and (o.id_type, o.id) not in (select id_type,id from '.$this->pr.'object_rubric where id_r='.abs($val).')';
                    }
                    $scode++;
                    $sscode++;
                }
                if(in_array("union",$mod) && $scode>1) $sql.=')';
                $code++;                    
            }
        }
        
        if(count($this->params["search"])>0)
        {
            $code=1;
            foreach($this->params["search"] as $val)
            {
                if($val["fld"]>0 && ($val["gt"]>0 || $val["lt"]>0))
                {
                    $sql.=' and v'.$code.'.id_fld='.$val["fld"];
                    if($val["gt"]>0 && empty($val["max"])) $sql.=' and v'.$code.'.val>='.$val["gt"];
                    if($val["max"]>0)
                    {
                        $sql.=' and v'.$code.'.val<='.$val["gt"];
                        $code++;
                        $sql.=' and v'.$code.'.id_fld='.$val["max"];
                        $sql.=' and v'.$code.'.val>='.$val["lt"];
                    }
                    elseif($val["lt"]>0) $sql.=' and v'.$code.'.val<='.$val["lt"];
                }
                $code++;
            }
        }
		
		if(!empty($type)) $sql.=' and o.id_type='.$type;
        
        $count_sql.=$sql;
        
        $sql=$child_sql.$sql;
		 		
		if($this->params["sort"]==1 && $this->params["stype"]>0 && $this->params["sfld"]>0) $sql.=' order by v.val';
		else $sql.=' order by o.idx asc,o.tadd desc';
		
		if($this->params["sdesc"]==1) $sql.=' desc';
		
		if(empty($count)) $sql.=' limit '.($this->start*$this->child_count).','.$this->child_count;
		if(!empty($count) && $count!="all") $sql.=' limit '.($this->start*$count).','.$count;	
	
    //echo $calc_count;
    
    if($calc_count>0)
    {
        $temp=mysql_query($count_sql);
        $this->total_count=mysql_result($temp,0,0);
        
        //echo $count_sql;
    }	
	
    if(empty($calc_count) || $calc_count<2)
    {
    //echo '<!--'.$count_sql."\n".$sql.'-->';
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
		$object_params["name"]=stripslashes($nm);
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
}
//---------------------------------------------------------------------------------------------------
function get_filter_boundary($mod,$type,$count,$field,$t_id_r,$b_field, $skip_type)
{
	$sql='select min(val),max(val) from '.$this->pr.'object as o';
    
    if($mod=="subchild") $sql.=' inner join '.$this->pr.'object as m2 on o.id_part=m2.id_part and o.ptype=m2.id_type and o.pid=m2.id';
    
	$sql.=' inner join '.$this->pr.'values_digit as v on v.id_part=o.id_part and v.id_type=o.id_type and v.id=o.id where v.id_fld='.$b_field.' and';
    if($this->permit==0) $sql.=' o.tadd<=NOW() and o.active=1';
    
    if($mod=="subchild") $sql.=' and m2.ptype='.$this->id_type.' and m2.pid='.$this->id;
    else $sql.=' and o.ptype='.$this->id_type.' and o.pid='.$this->id;
    
	if(!empty($type)) $sql.=' and o.id_type='.$type;
    else 
    {
        foreach($skip_type as $val)
            $sql.=' and o.id_type<>'.$val;
    }
	
    //echo '<!--'.$sql.'-->';
    
    $temp=mysql_query($sql);
	$bnd["min"]=mysql_result($temp,0,0);
    $bnd["max"]=mysql_result($temp,0,1);
    
    if($bnd["min"]<1) $bnd["min"]=0;
    if($bnd["max"]<1) $bnd["max"]=0;
    
    if($mod=="min") return $bnd["min"];
    elseif($mod=="max") return $bnd["max"];
    else return $bnd;
}
//---------------------------------------------------------------------------------------------------
function get_child_rubrics($mode,$create,$pt)
{
 if($create==2) $sql='select distinct '.$this->pr.'object_rubric.id_r,'.$this->pr.'rubric.name,'.$this->pr.'rubric.sid,'.$this->pr.'rubric.parent, '.$this->pr.'object.id_type, '.$this->pr.'object.id, '.$this->pr.'object.sid';
 else $sql='select distinct '.$this->pr.'object_rubric.id_r,'.$this->pr.'rubric.name,'.$this->pr.'rubric.sid,'.$this->pr.'rubric.parent';      
 
 $sql.=' from '.$this->pr.'object_rubric inner join '.$this->pr.'object using(id_part,id_type,id) inner join '.$this->pr.'rubric using(id_r)';   
    
 if($mode=="subchild")
 {  
    if($this->permit>0) $sql.=' where '.$this->pr.'object.id_part='.$this->id_part.' and '.$this->pr.'object.ptype='.$this->id_type.' and '.$this->pr.'object.pid in (select id from '.$this->pr.'object where id_part='.$this->id_part.' and pid='.$this->id.' and ptype='.$this->id_type.')';
    else $sql.=' where '.$this->pr.'object.active=1 and '.$this->pr.'object.id_part='.$this->id_part.' and '.$this->pr.'object.ptype='.$this->id_type.' and '.$this->pr.'object.pid in (select id from '.$this->pr.'object where id_part='.$this->id_part.' and pid='.$this->id.' and ptype='.$this->id_type.')';
 }
 elseif($mode=="normal")
 {
    if($this->permit>0) $sql.=' where '.$this->pr.'object.id_part='.$this->id_part.' and '.$this->pr.'object.ptype='.$this->id_type.' and '.$this->pr.'object.pid='.$this->id;
    else $sql.=' where '.$this->pr.'object.active=1 and '.$this->pr.'object.id_part='.$this->id_part.' and '.$this->pr.'object.ptype='.$this->id_type.' and '.$this->pr.'object.pid='.$this->id;
 }
 if(isset($pt)) $sql.=' and '.$this->pr.'rubric.parent='.$pt;
 if($create=2) $sql.=' order by '.$this->pr.'object.id asc';
 else $sql.=' order by '.$this->pr.'rubric.name';
 //echo $sql;
 $temp=mysql_query($sql);
 $this->rubric_count=mysql_num_rows($temp);
 
 $temp_count=0;
 if($this->rubric_count>0)
 {
  for($i=0;$i<$this->rubric_count;$i++)
  {
     if($create)
  	 {
  	    if(in_array(mysql_result($temp,$i,0),$this->rubrics_index) || in_array(mysql_result($temp,$i,6),$tmp_sid)) continue; 
        $rubric_params["mode"]=$this->params["mode"];
		$rubric_params["id_part"]=$this->id_part;
		$rubric_params["id_r"]=mysql_result($temp,$i,0);
		$rubric_params["name"]=stripslashes(mysql_result($temp,$i,1));
		$rubric_params["sid"]=mysql_result($temp,$i,2);
        $rubric_params["parent"]=mysql_result($temp,$i,3);
		$rubric_params["child_count"]=$this->child_count;
		$rubric_params["start"]=$this->start;
		
		$rubric_params["sort"]=$this->params["sort"];

		$this->rubrics[mysql_result($temp,$i,0)]=new rubric($rubric_params,$this->permit);
		$this->rubrics_index[$temp_count]=mysql_result($temp,$i,0);
        
        if($create=2)
        {
            $tmp_sid[]=mysql_result($temp,$i,6);
            
            $sql='select val from '.$this->pr.'values_str where id_part='.$this->id_part.' and id_type='.mysql_result($temp,$i,4).' and id='.mysql_result($temp,$i,5).' and id_fld=1';
    	    $nm=mysql_query($sql);
    	    $nm=mysql_result($nm,0,0);		
    		
    		$object_params["mode"]=$this->params["mode"];
    		$object_params["id_part"]=$this->id_part;
    		$object_params["id_type"]=mysql_result($temp,$i,4);
    		$object_params["id"]=mysql_result($temp,$i,5);
    		$object_params["name"]=stripslashes($nm);
    		$object_params["sid"]=mysql_result($temp,$i,6);
    		
    		$this->rubrics_childs[mysql_result($temp,$i,4)][mysql_result($temp,$i,5)]=new object($object_params,$this->permit);
    		
    		$this->rubrics_childs_index[$temp_count][0]=mysql_result($temp,$i,4);
    		$this->rubrics_childs_index[$temp_count][1]=mysql_result($temp,$i,5);
        }
        $temp_count++;
  	 }
  	 else
  	 {
        $this->rubric["id"][$i]=mysql_result($temp,$i,0);
  	 	$this->rubric["name"][$i]=stripslashes(mysql_result($temp,$i,1));
  	 	$this->rubric["sid"][$i]=mysql_result($temp,$i,2);
  	 	$this->rubric["idx"][$this->rubric["id"][$i]]=$i;
  	 }
  }
  if(!empty($temp_count)) $this->rubric_count=$temp_count;
 }
}
//------------------------------------------------------------------------------------------------------------
function get_random_child($mod,$type,$count,$field,$rand_count)
{
    $this->get_parent();
	if($mod=="normal")
	{
		if($this->permit>0) $sql='select id_type, id, sid, idx, active from '.$this->pr.'object where id_part='.$this->id_part.' and ptype='.$this->ptype.' and pid='.$this->pid.' order by idx asc, tadd desc limit '.($this->start*$this->child_count).','.$this->child_count;
		else $sql='select id_type, id, sid, idx from '.$this->pr.'object where active=1 and id_part='.$this->id_part.' and ptype='.$this->ptype.' and pid='.$this->pid.' order by idx asc, tadd desc limit '.($this->start*$this->child_count).','.$this->child_count;
	}
//-----------------------
	if($mod=="special")
	{
		if($this->permit>0) $sql='select id_type, id, sid,idx, active from '.$this->pr.'object where id_part='.$this->id_part.' and ptype='.$this->ptype.' and pid='.$this->pid;
		else $sql='select id_type, id, sid,idx from '.$this->pr.'object where active=1 and id_part='.$this->id_part.' and ptype='.$this->ptype.' and pid='.$this->pid;
		
		if(!empty($type)) $sql.=' and id_type='.$type;
		 		
		$sql.=' order by idx asc, tadd desc';
		
		if($count!="all")		
		{
		 if(empty($count)) $sql.=' limit '.($this->start*$this->child_count).','.$this->child_count;
		 else $sql.=' limit '.($this->start*$count).','.$count;
		}
		
	}
//-----------------------
	if($mod=="sort")
	{
		$sql='select '.$this->pr.'object.id_type, '.$this->pr.'object.id, '.$this->pr.'object.sid, '.$this->pr.'object.idx, '.$this->pr.'object.active from '.$this->pr.'object';
		
	
		if($this->params["sort"][0]==1 && $this->params["sort"][1]>0 && $this->params["sort"][2]>0)
		{
			switch($this->params["sort"][1])
		    {
		       case 1 : $sql.=' inner join '.$this->pr.'values_digit on '.$this->pr.'values_digit.id_part='.$this->pr.'object.id_part and '.$this->pr.'values_digit.id_type='.$this->pr.'object.id_type and '.$this->pr.'values_digit.id='.$this->pr.'object.id where '.$this->pr.'values_digit.id_fld='.$this->params["sort"][2].' and';
		       			$table=$this->pr.'values_digit';
		                break;	
		       case 2 : $sql.=' inner join '.$this->pr.'values_str on '.$this->pr.'values_str.id_part='.$this->pr.'object.id_part and '.$this->pr.'values_str.id_type='.$this->pr.'object.id_type and '.$this->pr.'values_str.id='.$this->pr.'object.id where '.$this->pr.'values_str.id_fld='.$this->params["sort"][2].' and';
			   			$table=$this->pr.'values_str';	
		                break;	
		       case 3 : $sql.=' inner join '.$this->pr.'values_text on '.$this->pr.'values_text.id_part='.$this->pr.'object.id_part and '.$this->pr.'values_text.id_type='.$this->pr.'object.id_type and '.$this->pr.'values_text.id='.$this->pr.'object.id where '.$this->pr.'values_text.id_fld='.$this->params["sort"][2].' and';
			   			$table=$this->pr.'values_text';	
		                break;	
		       case 4 : $sql.=' inner join '.$this->pr.'values_date on '.$this->pr.'values_date.id_part='.$this->pr.'object.id_part and '.$this->pr.'values_date.id_type='.$this->pr.'object.id_type and '.$this->pr.'values_date.id='.$this->pr.'object.id where '.$this->pr.'values_date.id_fld='.$this->params["sort"][2].' and';	
		                $table=$this->pr.'values_date';
						break;	
		    }
		}
		else $sql.=' where';	
		
		if($this->permit>0) $sql.=' '.$this->pr.'object.id_part='.$this->id_part.' and '.$this->pr.'object.ptype='.$this->ptype.' and '.$this->pr.'object.pid='.$this->pid;
		else $sql.=' '.$this->pr.'object.active=1 and '.$this->pr.'object.id_part='.$this->id_part.' and '.$this->pr.'object.ptype='.$this->ptype.' and '.$this->pr.'object.pid='.$this->pid;
		
		if(!empty($type)) $sql.=' and '.$this->pr.'object.id_type='.$type;
		 		
		if($this->params["sort"][0]==1 && $this->params["sort"][1]>0 && $this->params["sort"][2]>0 && empty($this->params["sort"][4])) $sql.=' order by '.$this->pr.'object.idx,'.$table.'.val';
        elseif ($this->params["sort"][0]==1 && $this->params["sort"][1]>0 && $this->params["sort"][2]>0 && $this->params["sort"][4]==1) $sql.=' order by '.$table.'.val';
		else $sql.=' order by '.$this->pr.'object.idx,'.$this->pr.'object.tadd';
		
		if($this->params["sort"][3]==1) $sql.=' desc';
		
		if(empty($count)) $sql.=' limit '.($this->start*$this->child_count).','.$this->child_count;
		if(!empty($count) && $count!="all") $sql.=' limit '.($this->start*$count).','.$count;	
		

	
	}	
//-----------------------	
	$temp=mysql_query($sql);
	$this->childs_count=mysql_num_rows($temp);
    
    $temp_count=0;

	for($i=0;$i<$this->childs_count;$i++)
	{
	   if($this->id_type==mysql_result($temp,$i,0) && $this->id==mysql_result($temp,$i,1)) continue; 
       
	   $prob=intval(($rand_count-$temp_count)/($this->childs_count-$i)*100);
       
       if(rand(0,100)<=$prob)
       {
		$sql='select val from '.$this->pr.'values_str where id_part='.$this->id_part.' and id_type='.mysql_result($temp,$i,0).' and id='.mysql_result($temp,$i,1).' and id_fld=1';
	    $nm=mysql_query($sql);
	    $nm=mysql_result($nm,0,0);		
		
		$object_params["mode"]=$this->params["mode"];
		$object_params["id_part"]=$this->id_part;
		$object_params["id_type"]=mysql_result($temp,$i,0);
		$object_params["id"]=mysql_result($temp,$i,1);
		$object_params["name"]=stripslashes($nm);
		$object_params["sid"]=mysql_result($temp,$i,2);
		//$object_params["path"]=$this->get_path().$object_params["sid"].'/';
        $object_params["idx"]=mysql_result($temp,$i,3);
		$object_params["active"]=mysql_result($temp,$i,4);
		$object_params["child_count"]=$this->child_count;
		$object_params["start"]=$this->start;
		
		$object_params["sort"]=$this->params["sort"];
		
		$this->childs[mysql_result($temp,$i,0)][mysql_result($temp,$i,1)]=new object($object_params,$this->permit);
		
		$this->childs_index[$temp_count][0]=mysql_result($temp,$i,0);
		$this->childs_index[$temp_count][1]=mysql_result($temp,$i,1);
        
        $temp_count++;	
       }		
	}
    
    $this->childs_count=$temp_count;	
}
//------------------------------------------------------------------------------------------------------------
function get_related($mod,$type,$count,$field)
{
	if($mod=="normal")
	{
		$sql='select '.$this->pr.'object.id_type, '.$this->pr.'object.id, '.$this->pr.'object.sid,'.$this->pr.'object.idx,'.$this->pr.'object.active from '.$this->pr.'object inner join '.$this->pr.'object_cross on '.$this->pr.'object.id_part='.$this->pr.'object_cross.c_id_part and '.$this->pr.'object.id_type='.$this->pr.'object_cross.c_id_type and '.$this->pr.'object.id='.$this->pr.'object_cross.c_id where '.$this->pr.'object_cross.id_part='.$this->id_part.' and '.$this->pr.'object_cross.id_type='.$this->id_type.' and '.$this->pr.'object_cross.id='.$this->id;
		if(!$this->permit) $sql.=' and '.$this->pr.'object.active=1';
		$sql.=' order by '.$this->pr.'object.idx asc, tadd desc limit '.($this->start*$this->child_count).','.$this->child_count;
	}
//-----------------------
	if($mod=="special")
	{
		$sql='select '.$this->pr.'object.id_type, '.$this->pr.'object.id, '.$this->pr.'object.sid,'.$this->pr.'object.idx,'.$this->pr.'object.active from '.$this->pr.'object inner join '.$this->pr.'object_cross on '.$this->pr.'object.id_part='.$this->pr.'object_cross.c_id_part and '.$this->pr.'object.id_type='.$this->pr.'object_cross.c_id_type and '.$this->pr.'object.id='.$this->pr.'object_cross.c_id where '.$this->pr.'object_cross.id_part='.$this->id_part.' and '.$this->pr.'object_cross.id_type='.$this->id_type.' and '.$this->pr.'object_cross.id='.$this->id;
		if(!$this->permit) $sql.=' and '.$this->pr.'object.active=1';
		if(!empty($type)) $sql.=' and '.$this->pr.'object.id_type='.$type;
		$sql.=' order by '.$this->pr.'object.idx asc, tadd desc';

		if($count!="all")
		{
		 if(empty($count)) $sql.=' limit '.($this->start*$this->child_count).','.$this->child_count;
		 else $sql.=' limit '.($this->start*$count).','.$count;
		}

	}
//-----------------------
	if($mod=="sort")
	{
		$sql='select '.$this->pr.'object.id_type, '.$this->pr.'object.id, '.$this->pr.'object.sid,'.$this->pr.'object.idx,'.$this->pr.'object.active from '.$this->pr.'object inner join '.$this->pr.'object_cross on '.$this->pr.'object.id_part='.$this->pr.'object_cross.c_id_part and '.$this->pr.'object.id_type='.$this->pr.'object_cross.c_id_type and '.$this->pr.'object.id='.$this->pr.'object_cross.c_id';


		if($this->params["sort"][0]==1 && $this->params["sort"][1]>0 && $this->params["sort"][2]>0)
		{
			switch($this->params["sort"][1])
		    {
		       case 1 : $sql.=' inner join '.$this->pr.'values_digit on '.$this->pr.'values_digit.id_part='.$this->pr.'object.id_part and '.$this->pr.'values_digit.id_type='.$this->pr.'object.id_type and '.$this->pr.'values_digit.id='.$this->pr.'object.id where '.$this->pr.'values_digit.id_fld='.$this->params["sort"][2].' and';
		       			$table=$this->pr.'values_digit';
		                break;
		       case 2 : $sql.=' inner join '.$this->pr.'values_str on '.$this->pr.'values_str.id_part='.$this->pr.'object.id_part and '.$this->pr.'values_str.id_type='.$this->pr.'object.id_type and '.$this->pr.'values_str.id='.$this->pr.'object.id where '.$this->pr.'values_str.id_fld='.$this->params["sort"][2].' and';
			   			$table=$this->pr.'values_str';
		                break;
		       case 3 : $sql.=' inner join '.$this->pr.'values_text on '.$this->pr.'values_text.id_part='.$this->pr.'object.id_part and '.$this->pr.'values_text.id_type='.$this->pr.'object.id_type and '.$this->pr.'values_text.id='.$this->pr.'object.id where '.$this->pr.'values_text.id_fld='.$this->params["sort"][2].' and';
			   			$table=$this->pr.'values_text';
		                break;
		       case 4 : $sql.=' inner join '.$this->pr.'values_date on '.$this->pr.'values_date.id_part='.$this->pr.'object.id_part and '.$this->pr.'values_date.id_type='.$this->pr.'object.id_type and '.$this->pr.'values_date.id='.$this->pr.'object.id where '.$this->pr.'values_date.id_fld='.$this->params["sort"][2].' and';
		                $table=$this->pr.'values_date';
						break;
		    }
		}
		else $sql.=' where';
		
		$sql.=' '.$this->pr.'object_cross.id_part='.$this->id_part.' and '.$this->pr.'object_cross.id_type='.$this->id_type.' and '.$this->pr.'object_cross.id='.$this->id;
		if(!$this->permit) $sql.=' and '.$this->pr.'object.active=1';
		if(!empty($type)) $sql.=' and '.$this->pr.'object.id_type='.$type;

		if($this->params["sort"][0]==1 && $this->params["sort"][1]>0 && $this->params["sort"][2]>0) $sql.=' order by '.$table.'.val';
		else $sql.=' order by '.$this->pr.'object.tadd';

		if($this->params["sort"][3]==1) $sql.=' desc';

		if(empty($count)) $sql.=' limit '.($this->start*$this->child_count).','.$this->child_count;
		if(!empty($count) && $count!="all") $sql.=' limit '.($this->start*$count).','.$count;



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
		$object_params["name"]=stripslashes($nm);
		$object_params["sid"]=mysql_result($temp,$i,2);
		//$object_params["path"]=$this->get_path().$object_params["sid"].'/';
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
//------------------------------------------------------------------------------------------------------------
function get_prev_next($count,$prnx,$mod)
{
    $this->get_parent();
    $tmp_date=$this->get_date("",1);
    
    $sql='select id_type, id, sid, idx, active from '.$this->pr.'object where id_part='.$this->id_part.' and ptype='.$this->ptype.' and pid='.$this->pid;
    if(!$this->permit) $sql.=' and active=1';
    if(!$mod)
    {
        if($prnx) $sql.=' and idx>'.$this->idx.' order by idx asc';
        else $sql.=' and idx<'.$this->idx.' order by tadd desc';
    }
    else $sql.=' and not (id_type='.$this->id_type.' and id='.$this->id.') order by tadd desc';
    
    if($count!="all")		
    {
		 if(empty($count)) $sql.=' limit 0,'.$this->child_count;
		 else $sql.=' limit 0,'.$count;
	}
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
		$object_params["name"]=stripslashes($nm);
		$object_params["sid"]=mysql_result($temp,$i,2);
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
//----------------------------------------------------------------------------------------------------------------
function get_content()
{
	 if($this->field_count>0) return;
	 
	 $sql='select id_fld,name,type,empty,idx from '.$this->pr.'field where id_type='.$this->id_type.' order by idx,id_fld';	
     $temp=mysql_query($sql);
     $this->field_count=mysql_num_rows($temp);
  
     for($i=0;$i<$this->field_count;$i++) 	 
     {
      switch(mysql_result($temp,$i,2))
      {
       case 1 : $sql='select val from '.$this->pr.'values_digit';
                break;
       case 2 : $sql='select val from '.$this->pr.'values_str';
                break;
       case 3 : $sql='select val from '.$this->pr.'values_text';
                break;
       case 4 : $sql='select val from '.$this->pr.'values_date';
                break;
      }
      
      $sql=$sql.' where id_part='.$this->id_part.' and id_type='.$this->id_type.' and id_fld='.mysql_result($temp,$i,0).' and id='.$this->id;	
      //echo $sql;
      $temp1=mysql_query($sql);
      $this->field["val"][$i]=mysql_result($temp1,0,0);	
      $this->field["val"][$i]=$this->field["val"][$i];
      $this->field["name"][$i]=mysql_result($temp,$i,1);
      $this->field["type"][$i]=mysql_result($temp,$i,2);
      $this->field["empty"][$i]=mysql_result($temp,$i,3);
      $this->field["id"][$i]=mysql_result($temp,$i,0);
      $this->field["idx"][mysql_result($temp,$i,0)]=$i;
      $this->field["fidx"][$i]=mysql_result($temp,$i,4);
     }	
}
//---------------------------------------------------------------------------------------------------
function get_files()
{
	$id_part=$this->id_part;
	$id_type=$this->id_type;
	$id=$this->id;
	
	$sql='select id_file,path,preview,filename,type,ext,alt,size from '.$this->pr.'file where id_part='.$id_part.' and id_type='.$id_type.' and id='.$id.' order by type asc, id_file asc';
	$temp=mysql_query($sql);
	$this->files_count=mysql_num_rows($temp);
	$this->img_count=0;

	for($i=0;$i<$this->files_count;$i++)
	{
		$this->files[$i]["id"]=mysql_result($temp,$i,0);
		$this->files[$i]["path"]=mysql_result($temp,$i,1);
		$this->files[$i]["preview"]=mysql_result($temp,$i,2);
		$this->files[$i]["name"]=mysql_result($temp,$i,3);
		$this->files[$i]["type"]=mysql_result($temp,$i,4);
		$this->files[$i]["ext"]=mysql_result($temp,$i,5);
		$this->files[$i]["alt"]=stripslashes(mysql_result($temp,$i,6));
		$this->files[$i]["size"]=mysql_result($temp,$i,7);
		
		if(!$this->files[$i]["type"]) $this->img_count++;
	}
}
//--------------------------------------------------------------------------------------------
function actions($url,$type)
{
		if($this->permit>0)
		{
		  if($type=="group")
          {
            if($this->permit<3)
            {
                $str.='<li class="btn"><a onclick="sfunc(\'activate\');"><img src="/admin/files/i-activate.gif" alt="Активировать" title="Активировать"/></a></li>';
                $str.='<li class="btn"><a onclick="sfunc(\'archive\');"><img src="/admin/files/i-archive.gif" alt="В архив" title="В архив"/></a></li>';
                $str.='<li class="btn"><a onclick="sfunc(\'deactivate\');"><img src="/admin/files/i-deactivate.gif" alt="Деактивировать" title="Деактивировать"/></a></li>';
            }
            if($this->permit==1) $str.='<li class="btn"><a onclick="sfunc(\'delete\');"><img src="/admin/files/i-delete.gif" alt="Удалить" title="Удалить"/></a></li>';
            //$str.='<li class="flt"><input class="inpu" type="text" name="search" value="Поиск" onclick="checkDefault(this, \'Поиск\', 1, \'000\')" onblur="checkDefault(this, \'Поиск\', 0, \'999\')"/> <input class="sbmt" type="submit" value="Найти"/></li>';
            //$str.='<li class="flt"><select name="filter"><option value="0">Показывать все</option><option value="1">Только активные</option><option value="2">Только неактивные</option></select></li>';
		  }
          elseif($type=="subgroup")
          {
            if($this->permit<3)
            { 
                $str.='<li class="btn"><a href="'.$this->get_path($url).'action-arrange/"><img src="/admin/files/i-order.gif" alt="Упорядочить дочерние объекты" title="Упорядочить дочерние объекты"/></a></li>';
                $str.='<li class="btn"><a href="'.$this->get_path($url).'action-edit/"><img src="/admin/files/i-edit.gif" alt="Редактировать" title="Редактировать"/></a></li>';
                $str.='<li class="btn"><a href="'.$this->get_path($url).'action-move/"><img src="/admin/files/i-move.gif" alt="Переместить" title="Переместить"/></a></li>';
                $str.='<li class="btn"><a href="'.$this->get_path($url).'action-cross/"><img src="/admin/files/i-connect.gif" alt="Связать с объектами" title="Связать с объектами"/></a></li>';
            }
            if($this->active<2 && $this->permit<3) $str.='<li class="btn"><a href="'.$this->get_path($url).'action-archive/"><img src="/admin/files/i-archive.gif" alt="В архив" title="В архив"/></a></li>';
            if($this->active>0 && $this->permit<3) $str.='<li class="btn"><a href="'.$this->get_path($url).'action-deactivate/"><img src="/admin/files/i-deactivate.gif" alt="Деактивировать" title="Деактивировать"/></a></li>';
            if($this->active!=1 && $this->permit<3) $str.='<li class="btn"><a href="'.$this->get_path($url).'action-activate/"><img src="/admin/files/i-activate.gif" alt="Активировать" title="Активировать"/></a></li>';
            if($this->permit==1) $str.='<li class="btn"><a href="'.$this->get_path($url).'action-delete/"><img src="/admin/files/i-delete.gif" alt="Удалить" title="Удалить"/></a></li>';
          }
          else
          {
            $str='<ul class="admin">';
    		if($this->permit<3) $str.='<li><a href="'.$this->get_path($url).'action-arrange/">Упорядочить дочерние объекты</a>|</li>';
            //if($this->permit<3 && $this->sid=="zp") $str.='<li><a href="'.$this->get_path($url).'action-import/">Импорт объектов</a>|</li>';
            if($this->permit<3 && $this->sid=="tyres") $str.='<li><a href="'.$this->get_path($url).'action-import_data/">Импорт данных</a>|</li>';
    		if($this->permit<3) $str.='<li><a href="'.$this->get_path($url).'action-edit/">Редактировать</a>|</li>';
    		if($this->permit<3) $str.='<li><a href="'.$this->get_path($url).'action-move/">Переместить</a>|</li>';
    		if($this->permit<3) $str.='<li><a href="'.$this->get_path($url).'action-cross/">Связать с объектами</a>|</li>';
    		if($this->active>0 && $this->permit<3) $str.='<li class="ap"><a href="'.$this->get_path($url).'action-deactivate/">Деактивировать</a>|</li>';
            if($this->active<2 && $this->permit<3) $str.='<li class="ap"><a href="'.$this->get_path($url).'action-archive/">В архив</a>|</li>';
    		if($this->active!=1  && $this->permit<3) $str.='<li class="ag"><a href="'.$this->get_path($url).'action-activate/">Активировать</a>|</li>';
            if($this->active==2 && $this->permit<3) $str.='<li class="ag"><a href="'.$this->get_path($url).'action-unarchive/">Из архива</a>|</li>';
    		if($this->permit==1) $str.='<li class="ar"><a href="'.$this->get_path($url).'action-delete/">Удалить</a></li>';
    		$str.='</ul>';
          }
		return $str;
		}	
}
//---------------------------------------------------------------------------------------------------
function get_meta()
{
 $sql='select title,description from '.$this->pr.'meta where id_part='.$this->id_part.' and id_type='.$this->id_type.' and id='.$this->id;
 $temp=mysql_query($sql);
 $this->title=stripslashes(mysql_result($temp,0,0));
 $this->description=stripslashes(mysql_result($temp,0,1));
 
 $sql='select '.$this->pr.'keyword.word from '.$this->pr.'keyword inner join '.$this->pr.'object_keyword on '.$this->pr.'keyword.id_key='.$this->pr.'object_keyword.id_key where '.$this->pr.'object_keyword.id_part='.$this->id_part.' and '.$this->pr.'object_keyword.id_type='.$this->id_type.' and '.$this->pr.'object_keyword.id='.$this->id;
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
function get_rubrics($create,$pt)
{
 $sql='select '.$this->pr.'object_rubric.id_r,'.$this->pr.'rubric.name,'.$this->pr.'rubric.sid,'.$this->pr.'rubric.parent from '.$this->pr.'object_rubric inner join '.$this->pr.'rubric on '.$this->pr.'object_rubric.id_r='.$this->pr.'rubric.id_r where '.$this->pr.'object_rubric.id_part='.$this->id_part.' and '.$this->pr.'object_rubric.id_type='.$this->id_type.' and '.$this->pr.'object_rubric.id='.$this->id;
 if(isset($pt)) $sql.=" and ".$this->pr.'rubric.parent='.$pt;
  $sql.=" order by ".$this->pr.'rubric.idx,'.$this->pr.'rubric.id_r';
 $temp=mysql_query($sql);
 $this->rubric_count=mysql_num_rows($temp);
 
 if($this->rubric_count>0)
 {
  for($i=0;$i<$this->rubric_count;$i++)
  {
     if($create)
  	 {
        $rubric_params["mode"]=$this->params["mode"];
		$rubric_params["id_part"]=$this->id_part;
		$rubric_params["id_r"]=mysql_result($temp,$i,0);
		$rubric_params["name"]=mysql_result($temp,$i,1);
		$rubric_params["sid"]=mysql_result($temp,$i,2);
        $rubric_params["parent"]=mysql_result($temp,$i,3);
		$rubric_params["child_count"]=$this->child_count;
		$rubric_params["start"]=$this->start;
		
		$rubric_params["sort"]=$this->params["sort"];

		$this->rubrics[mysql_result($temp,$i,0)]=new rubric($rubric_params,$this->permit);
		$this->rubrics_index[$i]=mysql_result($temp,$i,0);
  	 }
  	 else
  	 {
        $this->rubric["id"][$i]=mysql_result($temp,$i,0);
  	 	$this->rubric["name"][$i]=mysql_result($temp,$i,1);
  	 	$this->rubric["sid"][$i]=mysql_result($temp,$i,2);
  	 	$this->rubric["idx"][$this->rubric["id"][$i]]=$i;
  	 }
  }
  
 }
}
//---------------------------------------------------------------------------------------------------
function get_date($format,$overide)
{
 if(!empty($this->date_add) && !$overide) return $this->date_add;
 
 $month_name[1]="Января";
 $month_name[2]="Февраля";
 $month_name[3]="Марта";
 $month_name[4]="Апреля";
 $month_name[5]="Мая";
 $month_name[6]="Июня";
 $month_name[7]="Июля";
 $month_name[8]="Августа";
 $month_name[9]="Сентября";
 $month_name[10]="Октября";
 $month_name[11]="Ноября";
 $month_name[12]="Декабря";
 
 $month_name_s[1]="янв";
 $month_name_s[2]="февр";
 $month_name_s[3]="март";
 $month_name_s[4]="апр";
 $month_name_s[5]="мая";
 $month_name_s[6]="июня";
 $month_name_s[7]="июля";
 $month_name_s[8]="авг";
 $month_name_s[9]="сент";
 $month_name_s[10]="окт";
 $month_name_s[11]="нояб";
 $month_name_s[12]="дек";

 $en_month_name[1]="January";
 $en_month_name[2]="February";
 $en_month_name[3]="March";
 $en_month_name[4]="April";
 $en_month_name[5]="May";
 $en_month_name[6]="June";
 $en_month_name[7]="July";
 $en_month_name[8]="August";
 $en_month_name[9]="September";
 $en_month_name[10]="October";
 $en_month_name[11]="November";
 $en_month_name[12]="December";


 if($format=="rss")
 {
 	$sql='select UNIX_TIMESTAMP(tadd),UNIX_TIMESTAMP(tmodify) from '.$this->pr.'object where id_part='.$this->id_part.' and id_type='.$this->id_type.' and id='.$this->id;
 	
 	$temp=mysql_query($sql);

 	$this->date_add=date("r", mysql_result($temp,0,0));
 	$this->date_modify=date("r", mysql_result($temp,0,1));
 }
 elseif($format=="unix")
 {
 	$sql='select UNIX_TIMESTAMP(tadd),UNIX_TIMESTAMP(tmodify) from '.$this->pr.'object where id_part='.$this->id_part.' and id_type='.$this->id_type.' and id='.$this->id;
 	
 	$temp=mysql_query($sql);

 	$this->date_add=mysql_result($temp,0,0);
 	$this->date_modify=mysql_result($temp,0,1);
 }
 else
 {
 	$sql='select tadd,tmodify from '.$this->pr.'object where id_part='.$this->id_part.' and id_type='.$this->id_type.' and id='.$this->id;
 	$temp=mysql_query($sql);

 	$this->date_add=mysql_result($temp,0,0);
 	$this->date_modify=mysql_result($temp,0,1);
 }
 
 if ($format=="text")
 {
	$this->date_add=substr($this->date_add,8,2).' '.$month_name[intval(substr($this->date_add,5,2))].' '.substr($this->date_add,0,4);
	$this->date_modify=substr($this->date_modify,8,2).' '.$month_name[intval(substr($this->date_modify,5,2))].' '.substr($this->date_modify,0,4);
 }
 elseif ($format=="text_short")
 {
	$this->date_add='<div class="day">'.substr($this->date_add,8,2).'</div><div class="month">'.$month_name_s[intval(substr($this->date_add,5,2))].'</div>';
	$this->date_modify=substr($this->date_modify,8,2).' '.$month_name_s[intval(substr($this->date_modify,5,2))];
 }
 elseif ($format=="text_en")
 {
	$this->date_add=$en_month_name[intval(substr($this->date_add,5,2))].' '.substr($this->date_add,8,2).', '.substr($this->date_add,0,4);
	$this->date_modify=$en_month_name[intval(substr($this->date_modify,5,2))].' '.substr($this->date_modify,8,2).', '.substr($this->date_modify,0,4);
 }
 elseif ($format=="date")
 {
 	$this->date_add=substr($this->date_add,0,10);
	$this->date_modify=substr($this->date_modify,0,10);
 }

 return $this->date_add;
}
//---------------------------------------------------------------------------------------------------
function get_idx()
{
 if(!empty($this->idx)) return $this->idx;
 
 $sql='select idx from '.$this->pr.'object where id_part='.$this->id_part.' and id_type='.$this->id_type.' and id='.$this->id;
 $temp=mysql_query($sql);

 $this->idx=mysql_result($temp,0,0);
 return $this->idx;
}
//---------------------------------------------------------------------------------------------------
function get_user()
{
 if(!empty($this->u_name)) return $this->u_name;

 $sql='select '.$this->pr.'object.id_user,'.$this->pr.'user.name,'.$this->pr.'user.type from '.$this->pr.'object inner join '.$this->pr.'user on '.$this->pr.'object.id_user='.$this->pr.'user.id_user where id_part='.$this->id_part.' and id_type='.$this->id_type.' and id='.$this->id;
 $temp=mysql_query($sql);

 $this->id_u=mysql_result($temp,0,0);
 $this->u_name=mysql_result($temp,0,1);
 $this->u_type=mysql_result($temp,0,2);
 
 return $this->u_name;
}
//---------------------------------------------------------------------------------------------------
function count_child($tp,$deep,$tptype,$tpid)
{
 $sql='select id_type,id from '.$this->pr.'object where id_part='.$this->id_part;
 if(!empty($tptype) && !empty($tpid)) $sql.=' and ptype='.$tptype.' and pid='.$tpid;
 else $sql.=' and ptype='.$this->id_type.' and pid='.$this->id;
 if(!$this->permit) $sql.=' and active=1';
 if(!empty($tp)) $sql.=' and id_type='.$tp;
 $temp=mysql_query($sql);
 $temp_rows=mysql_num_rows($temp);
 
 $res=0;
 $res+=$temp_rows;
 
 if($temp_rows>0 && $deep)
 {
	for($i=0;$i<$temp_rows;$i++)
	{
        $tptype=mysql_result($temp,$i,0);
        $tpid=mysql_result($temp,$i,1);
	    $res+=$this->count_child($tp,$deep,$tptype,$tpid);
	}
 }

 return $res;
}
//---------------------------------------------------------------------------------------------------
function get_keyword()
{
 if(!empty($this->keywords)) return $this->keywords;
 
 $sql='select '.$this->pr.'keyword.id_key,'.$this->pr.'keyword.word from '.$this->pr.'keyword inner join '.$this->pr.'object_keyword using(id_key) where '.$this->pr.'object_keyword.id_part='.$this->id_part.' and '.$this->pr.'object_keyword.id_type='.$this->id_type.' and '.$this->pr.'object_keyword.id='.$this->id;
 $temp=mysql_query($sql);
 $temp_rows=mysql_num_rows($temp);
 
 $this->keywords["count"][0]=$temp_rows;
 for($i=0;$i<$temp_rows;$i++)
 {
    $this->keywords["id"][$i]=mysql_result($temp,$i,0);
    $this->keywords["word"][$i]=mysql_result($temp,$i,1);
 }

 return $this->keywords;
}
//---------------------------------------------------------------------------------------------------
function get_prev()
{
 $this->get_parent();
 $tmp_date=$this->get_date();
 $sql='select id,sid from '.$this->pr.'object where id_part='.$this->id_part.' and id_type='.$this->id_type.' and active=1 and ptype='.$this->ptype.' and pid='.$this->pid.' and tadd<"'.$tmp_date.'" order by tadd desc limit 0,1';
 $temp=mysql_query($sql);

 		$object_params["mode"]=$this->params["mode"];
		$object_params["id_part"]=$this->id_part;
		$object_params["id_type"]=$this->id_type;
		$object_params["id"]=mysql_result($temp,$i,0);
		$object_params["sid"]=mysql_result($temp,$i,1);
		$object_params["active"]=1;

  if(!empty($object_params["id"])) $prev=new object($object_params,$this->permit);
  
  return $prev;
}
//---------------------------------------------------------------------------------------------------
function get_next()
{
 $this->get_parent();
 $tmp_date=$this->get_date();
 $sql='select id,sid from '.$this->pr.'object where id_part='.$this->id_part.' and id_type='.$this->id_type.' and active=1 and ptype='.$this->ptype.' and pid='.$this->pid.' and tadd>"'.$tmp_date.'" order by tadd desc limit 0,1';
 $temp=mysql_query($sql);

 		$object_params["mode"]=$this->params["mode"];
		$object_params["id_part"]=$this->id_part;
		$object_params["id_type"]=$this->id_type;
		$object_params["id"]=mysql_result($temp,$i,0);
		$object_params["sid"]=mysql_result($temp,$i,1);
		$object_params["active"]=1;

  if(!empty($object_params["id"])) $prev=new object($object_params,$this->permit);

  return $prev;
}
//---------------------------------------------------------------------------------------------------
function get_num()
{
 $this->get_parent();
 $tmp_date=$this->get_date();
 $sql='select count(*) from '.$this->pr.'object where id_part='.$this->id_part.' and id_type='.$this->id_type.' and active=1 and ptype='.$this->ptype.' and pid='.$this->pid.' and tadd<"'.$tmp_date.'"';
 $temp=mysql_query($sql);
 $count=mysql_result($temp,0,0);
 
 $count++;

  return $count;
}
//------------------------------------------------------------------------------------------------------------------
};
?>