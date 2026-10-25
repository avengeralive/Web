<?php
class rubric
{
  var $pr;
  
  var $id_part;
  var $id_r;
  var $sid;
  var $name;
  var $text;
  var $path;
  
  var $parent;
  
  var $params;
  
  var $rubric_count;
  var $rubric_index;
  var $rubric;
  
  var $childs_count;
  var $childs;
  var $childs_index;
	
  var $child_count;
  var $start;
  
  var $permit;
  
  var $title;
  var $description;
  var $keyword;

  var $idx;
	
//----------------------------------------------------------------------------------------------------------------
function rubric($params,$permit)
{
//---get vars-------------------------------
 	global $pr;

 	global $mode;

    $this->pr=$pr;

	$this->id_part=$params["id_part"];
	$this->id_r=$params["id_r"];
	$this->name=$params["name"];
	$this->sid=$params["sid"];
	$this->parent=$params["parent"];
	$this->path=$params["path"];
	$this->permit=$permit;
	
	$this->child_count=$params["child_count"];
	
	$this->start=$params["start"];
	
	$this->params=$params;
    
    if(empty($this->sid) || empty($this->name) || empty($this->idx))
    {
       $sql='select sid,name,idx from '.$this->pr.'rubric where id_part='.$this->id_part.' and id_r='.$this->id_r;
	   $t=mysql_query($sql);
	   $this->sid=mysql_result($t,0,0);   
       $this->name=stripslashes(mysql_result($t,0,1));
       $this->idx=mysql_result($t,0,2);
    }
    
}
//--------------------------------------------------------------------------------------------
function get_path($pref)
{
	if(empty($this->path))
	{
		$this->path='/';
		$tid=$this->id_r;
		
		do
		{
			$sql='select sid,parent from '.$this->pr.'rubric where id_part='.$this->id_part.' and id_r='.$tid;
			$t=mysql_query($sql);
			$tsid=mysql_result($t,0,0);
			$tid=mysql_result($t,0,1);
			
			if(!empty($tsid)) $this->path='/'.$tsid.$this->path;				
			
		}while($tid>0);
		
		$sql='select sid,idx from '.$this->pr.'part where id_part='.$this->id_part;
		$t=mysql_query($sql);
		$tsid=mysql_result($t,0,0);
		$tidx=mysql_result($t,0,1);
		
		if($tidx==0 && !empty($tsid)) $this->path='/'.$tsid.$this->path;
	}
	if(strpos($this->path,"/rubric/")!==false) return $pref.$this->path;
	else return $pref.'/rubric'.$this->path;
}
//--------------------------------------------------------------------------------------------------------
function get_child($mod,$type,$count,$field)
{
	if($mod=="normal")
	{
		if($this->permit>0) $sql='select '.$this->pr.'object.id_type, '.$this->pr.'object.id, '.$this->pr.'object.sid, '.$this->pr.'object.active from '.$this->pr.'object inner join '.$this->pr.'object_rubric on '.$this->pr.'object.id_part='.$this->pr.'object_rubric.id_part and '.$this->pr.'object.id_type='.$this->pr.'object_rubric.id_type and '.$this->pr.'object.id='.$this->pr.'object_rubric.id where '.$this->pr.'object_rubric.id_part='.$this->id_part.' and '.$this->pr.'object_rubric.id_r='.$this->id_r;
		else $sql='select '.$this->pr.'object.id_type, '.$this->pr.'object.id, '.$this->pr.'object.sid, '.$this->pr.'object.active from '.$this->pr.'object inner join '.$this->pr.'object_rubric on '.$this->pr.'object.id_part='.$this->pr.'object_rubric.id_part and '.$this->pr.'object.id_type='.$this->pr.'object_rubric.id_type and '.$this->pr.'object.id='.$this->pr.'object_rubric.id where '.$this->pr.'object.tadd<=NOW() and '.$this->pr.'object.active=1 and  '.$this->pr.'object_rubric.id_part='.$this->id_part.' and '.$this->pr.'object_rubric.id_r='.$this->id_r;
		if(!empty($type)) $sql.=' and '.$this->pr.'object.id_type='.$type;	
		$sql.=' order by '.$this->pr.'object.idx,'.$this->pr.'object.tadd desc limit '.($this->start*$this->child_count).','.$this->child_count;
	}
//-----------------------
	if($mod=="special")
	{
		if($this->permit>0) $sql='select '.$this->pr.'object.id_type, '.$this->pr.'object.id, '.$this->pr.'object.sid, '.$this->pr.'object.active from '.$this->pr.'object inner join '.$this->pr.'object_rubric on '.$this->pr.'object.id_part='.$this->pr.'object_rubric.id_part and '.$this->pr.'object.id_type='.$this->pr.'object_rubric.id_type and '.$this->pr.'object.id='.$this->pr.'object_rubric.id where '.$this->pr.'object_rubric.id_part='.$this->id_part.' and '.$this->pr.'object_rubric.id_r='.$this->id_r;
		else $sql='select '.$this->pr.'object.id_type, '.$this->pr.'object.id, '.$this->pr.'object.sid, '.$this->pr.'object.active from '.$this->pr.'object inner join '.$this->pr.'object_rubric on '.$this->pr.'object.id_part='.$this->pr.'object_rubric.id_part and '.$this->pr.'object.id_type='.$this->pr.'object_rubric.id_type and '.$this->pr.'object.id='.$this->pr.'object_rubric.id where '.$this->pr.'object.tadd<=NOW() and '.$this->pr.'object.active=1 and  '.$this->pr.'object_rubric.id_part='.$this->id_part.' and '.$this->pr.'object_rubric.id_r='.$this->id_r;
		
		if(!empty($type)) $sql.=' and '.$this->pr.'object.id_type='.$type;
		 		
		$sql.=' order by '.$this->pr.'object.idx,'.$this->pr.'object.tadd desc';
		
		if($count!="all")		
		{
		 if(empty($count)) $sql.=' limit '.($this->start*$this->child_count).','.$this->child_count;
		 else $sql.=' limit '.($this->start*$count).','.$count;
		}
		
	}
//-----------------------	
if($mod=="sort")
	{
		$sql='select '.$this->pr.'object.id_type, '.$this->pr.'object.id, '.$this->pr.'object.sid, '.$this->pr.'object.active from '.$this->pr.'object inner join '.$this->pr.'object_rubric on '.$this->pr.'object.id_part='.$this->pr.'object_rubric.id_part and '.$this->pr.'object.id_type='.$this->pr.'object_rubric.id_type and '.$this->pr.'object.id='.$this->pr.'object_rubric.id';
		
	
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
		
		if($this->permit>0) $sql.=' '.$this->pr.'object_rubric.id_part='.$this->id_part.' and '.$this->pr.'object_rubric.id_r='.$this->id_r;
		else $sql.=' '.$this->pr.'object.tadd<=NOW() and '.$this->pr.'object.active=1 and '.$this->pr.'object_rubric.id_part='.$this->id_part.' and '.$this->pr.'object_rubric.id_r='.$this->id_r;
		
		if(!empty($type)) $sql.=' and '.$this->pr.'object.id_type='.$type;
		 		
		if($this->params["sort"]==1 && $this->params["stype"]>0 && $this->params["sfld"]>0) $sql.=' order by '.$table.'.val';
		else $sql.=' order by '.$this->pr.'object.idx,'.$this->pr.'object.tadd';
		
		if($this->params["sdesc"]==1) $sql.=' desc';
		
		if(empty($count)) $sql.=' limit '.($this->start*$this->child_count).','.$this->child_count;
		if(!empty($count) && $count!="all") $sql.=' limit '.($this->start*$count).','.$count;	
		
	
	}
//-----------------------
	if($mod=="parent")
	{
		if($this->permit>0) $sql='select '.$this->pr.'object.id_type, '.$this->pr.'object.id, '.$this->pr.'object.sid, '.$this->pr.'object.active from '.$this->pr.'object inner join '.$this->pr.'object_rubric on '.$this->pr.'object.id_part='.$this->pr.'object_rubric.id_part and '.$this->pr.'object.id_type='.$this->pr.'object_rubric.id_type and '.$this->pr.'object.id='.$this->pr.'object_rubric.id where '.$this->pr.'object_rubric.id_part='.$this->id_part.' and '.$this->pr.'object_rubric.id_r='.$this->id_r;
		else $sql='select '.$this->pr.'object.id_type, '.$this->pr.'object.id, '.$this->pr.'object.sid, '.$this->pr.'object.active from '.$this->pr.'object inner join '.$this->pr.'object_rubric on '.$this->pr.'object.id_part='.$this->pr.'object_rubric.id_part and '.$this->pr.'object.id_type='.$this->pr.'object_rubric.id_type and '.$this->pr.'object.id='.$this->pr.'object_rubric.id where '.$this->pr.'object.tadd<=NOW() and '.$this->pr.'object.active=1 and  '.$this->pr.'object_rubric.id_part='.$this->id_part.' and '.$this->pr.'object_rubric.id_r='.$this->id_r;
		
		if(!empty($type)) $sql.=' and '.$this->pr.'object.ptype='.$type.' and '.$this->pr.'object.pid='.$field;
		 		
		$sql.=' order by '.$this->pr.'object.idx, '.$this->pr.'object.tadd';
		
		if($count!="all")		
		{
		 if(empty($count)) $sql.=' limit '.($this->start*$this->child_count).','.$this->child_count;
		 else $sql.=' limit '.($this->start*$count).','.$count;
		}
		
	}
//-----------------------    
    if($mod=="rubric")
	{
        if($this->permit>0) $sql='select o.id_type, o.id, o.sid, o.idx, o.active from '.$this->pr.'object as o inner join '.$this->pr.'object_rubric as or1 using(id_part,id_type,id) inner join '.$this->pr.'object_rubric as or2 using(id_part,id_type,id) inner join '.$this->pr.'rubric as r on r.id_r=or2.id_r where or1.id_part='.$this->id_part.' and or1.id_r='.$this->id_r.' and r.sid="'.$this->params["sort"][2].'" order by o.idx asc, o.tadd desc';
		else $sql='select o.id_type, o.id, o.sid, o.idx, o.active from '.$this->pr.'object as o inner join '.$this->pr.'object_rubric as or1 using(id_part,id_type,id) inner join '.$this->pr.'object_rubric as or2 using(id_part,id_type,id) inner join '.$this->pr.'rubric as r on r.id_r=or2.id_r where o.active=1 and or1.id_part='.$this->id_part.' and or1.id_r='.$this->id_r.' and r.sid="'.$this->params["sort"][2].'" order by o.idx asc, o.tadd desc';
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
		$object_params["active"]=mysql_result($temp,$i,3);
		$object_params["child_count"]=$this->child_count;
		$object_params["start"]=$this->start;
		
		$object_params["sort"]=$this->params["sort"];
		
		$this->childs[mysql_result($temp,$i,0)][mysql_result($temp,$i,1)]=new object($object_params,$this->permit);
		
		$this->childs_index[$i][0]=mysql_result($temp,$i,0);
		$this->childs_index[$i][1]=mysql_result($temp,$i,1);			
	}	
}
//---------------------------------------------------------------------------------------------------
function get_child_intersect($mod,$type,$count,$field,$t_id_r,$calc_count)
{
        $mod=explode(' ',$mod);
    
		$child_sql='select distinct o.id_type, o.id, o.sid, o.active ';
        $count_sql='select count(*) ';
         
        $sql='from '.$this->pr.'object as o inner join '.$this->pr.'object_rubric as orm on o.id_part=orm.id_part and o.id_type=orm.id_type and o.id=orm.id ';
        
        if(count($t_id_r)>0)
        {
            $code=1;
            foreach($t_id_r as $tr)
            {
                    if(count($tr)>0) $sql.=' inner join '.$this->pr.'object_rubric as or'.$code.' on o.id_part=or'.$code.'.id_part and o.id_type=or'.$code.'.id_type and o.id=or'.$code.'.id';
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
        
        $sql.=' orm.id_part='.$this->id_part.' and orm.id_r='.$this->id_r;
        
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
                        $sql.=' and v'.($code+1).'.id_fld='.$val["max"];
                        
                        $sql.=' and ((v'.$code.'.val>='.$val["gt"].' and v'.$code.'.val<='.$val["lt"].') or (v'.($code+1).'.val>='.$val["gt"].' and v'.($code+1).'.val<='.$val["lt"].') or (v'.$code.'.val<'.$val["gt"].' and v'.($code+1).'.val>'.$val["lt"].'))';
                        $code++;
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
        //return $count_sql;
        //echo '<!--'.$count_sql.'-->';
    }	
	
    if(empty($calc_count) || $calc_count<2)
    {
    //echo '<!--'.$this->permit.$count.$sql.'-->';
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
	$sql='select min(val),max(val) from '.$this->pr.'object as o inner join '.$this->pr.'object_rubric as orm on o.id_part=orm.id_part and o.id_type=orm.id_type and o.id=orm.id';
    
	$sql.=' inner join '.$this->pr.'values_digit as v on v.id_part=o.id_part and v.id_type=o.id_type and v.id=o.id where v.id_fld='.$b_field.' and';
    if($this->permit==0) $sql.=' o.tadd<=NOW() and o.active=1 and';
    
    $sql.=' orm.id_part='.$this->id_part.' and orm.id_r='.$this->id_r;
    
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
    if($bnd["max"]<$bnd["min"]) $bnd["max"]=$bnd["min"]+1;
    
    if($mod=="min") return $bnd["min"];
    elseif($mod=="max") return $bnd["max"];
    else return $bnd;
}
//---------------------------------------------------------------------------------------------------
function get_child_rubrics($mode,$create,$pt)
{
 if($mode=="normal")
 {
    $sql='select distinct r.id_r, r.name, r.sid, r.parent from '.$this->pr.'rubric as r inner join '.$this->pr.'object_rubric as r1 using(id_r) inner join '.$this->pr.'object_rubric as r2  ON r1.id_part = r2.id_part AND r1.id_type = r2.id_type AND r1.id = r2.id where r2.id_r='.$this->id_r;
 }
 if(isset($pt)) $sql.=' and r.parent='.$pt;
 $sql.=' order by r.name';
 //echo $sql;
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
		$rubric_params["name"]=stripslashes(mysql_result($temp,$i,1));
		$rubric_params["sid"]=mysql_result($temp,$i,2);
        $rubric_params["parent"]=mysql_result($temp,$i,3);
		$rubric_params["child_count"]=$this->child_count;
		$rubric_params["start"]=$this->start;
		
		$rubric_params["sort"]=$this->params["sort"];

		$this->rubric[mysql_result($temp,$i,0)]=new rubric($rubric_params,$this->permit);
		$this->rubric_index[$i]=mysql_result($temp,$i,0);
  	 }
  	 else
  	 {
        $this->rubric["id"][$i]=mysql_result($temp,$i,0);
  	 	$this->rubric["name"][$i]=stripslashes(mysql_result($temp,$i,1));
  	 	$this->rubric["sid"][$i]=mysql_result($temp,$i,2);
        $this->rubric["parent"][$i]=mysql_result($temp,$i,3);
  	 	$this->rubric["idx"][$this->rubric["id"][$i]]=$i;
  	 }
  }
  
 }
}
//--------------------------------------------------------------------------------------------
function get_text()
{
	if(!empty($this->text)) return $this->text;
	
	$sql='select txt from '.$this->pr.'rubric where id_part='.$this->id_part.' and id_r='.$this->id_r;
	$temp=mysql_query($sql);
	$this->text=mysql_result($temp,0,0);
	
	return stripslashes($this->text);
}
//--------------------------------------------------------------------------------------------
function get_rubric()
{
	$sql='select id_r,name,sid from '.$this->pr.'rubric where id_part='.$this->id_part.' and parent='.$this->id_r.' order by idx';
	$temp=mysql_query($sql);
	$this->rubric_count=mysql_num_rows($temp);
	
	for($i=0;$i<$this->rubric_count;$i++)
	{
		$rubric_params["mode"]=$this->params["mode"];
		$rubric_params["id_part"]=$this->id_part;
		$rubric_params["id_r"]=mysql_result($temp,$i,0);
		$rubric_params["name"]=stripslashes(mysql_result($temp,$i,1));
		$rubric_params["sid"]=mysql_result($temp,$i,2);
		$rubric_params["child_count"]=$this->child_count;
		$rubric_params["start"]=$this->start;
		$rubric_params["parent"]=$this->id_r;
		$rubric_params["path"]=$this->get_path().$rubric_params["sid"].'/';
		
		$rubric_params["sort"]=$this->params["sort"];
		
		$this->rubric[mysql_result($temp,$i,0)]=new rubric($rubric_params,$this->permit);
		$this->rubric_index[$i]=mysql_result($temp,$i,0);
	}
}
//--------------------------------------------------------------------------------------------
function get_rubric_intersect($id_intersect,$create)
{
    $sql='select distinct r.id_r,r.name,r.sid from '.$this->pr.'rubric as r inner join '.$this->pr.'object_rubric as or1 on r.id_part=or1.id_part and r.id_r=or1.id_r inner join '.$this->pr.'object_rubric as or2 on or1.id_part=or2.id_part and or1.id_type=or2.id_type and or1.id=or2.id';
    if($this->permit==0) $sql.=' inner join '.$this->pr.'object as o on or1.id_part=o.id_part and or1.id_type=o.id_type and or1.id=o.id'; 
    $sql.=' where or2.id_part='.$this->id_part.' and or2.id_r='.$this->id_r.' and r.parent='.$id_intersect;
    if($this->permit==0) $sql.=' and o.tadd<=NOW() and o.active=1';
    //echo '<!--'.$sql.'-->';
	$temp=mysql_query($sql);
	$this->rubric_count=mysql_num_rows($temp);
	
	for($i=0;$i<$this->rubric_count;$i++)
	{
	   if($create)
       {
		$rubric_params["mode"]=$this->params["mode"];
		$rubric_params["id_part"]=$this->id_part;
		$rubric_params["id_r"]=mysql_result($temp,$i,0);
		$rubric_params["name"]=stripslashes(mysql_result($temp,$i,1));
		$rubric_params["sid"]=mysql_result($temp,$i,2);
		$rubric_params["child_count"]=$this->child_count;
		$rubric_params["start"]=$this->start;
		$rubric_params["parent"]=$this->id_r;
		$rubric_params["path"]=$this->get_path().$rubric_params["sid"].'/';
		
		$rubric_params["sort"]=$this->params["sort"];
		
		$this->rubric[mysql_result($temp,$i,0)]=new rubric($rubric_params,$this->permit);
		$this->rubric_index[$i]=mysql_result($temp,$i,0);
       }
       else
       {
        $this->rubric["id"][$i]=mysql_result($temp,$i,0);
  	 	$this->rubric["name"][$i]=stripslashes(mysql_result($temp,$i,1));
  	 	$this->rubric["sid"][$i]=mysql_result($temp,$i,2);
  	 	$this->rubric["idx"][$this->rubric["id"][$i]]=$i;
       }
        
	}
}
//--------------------------------------------------------------------------------------------
function actions($url)
{
	if($this->permit==1)
	{
		$str='<ul>';
		$str.='<li><a href="'.$this->get_path($url).'action-edit/">Редактировать</a>|</li>';
        $str.='<li><a href="'.$this->get_path($url).'action-arrange/">Упорядочить подрубрики</a>|</li>';
		$str.='<li class="ar"><a href="'.$this->get_path($url).'action-delete/">Удалить</a></li>';
		$str.='</ul>';
		
		return $str;	
	}
	else return;
}
//---------------------------------------------------------------------------------------------------
function get_meta()
{
 $sql='select title,description,keywords from '.$this->pr.'rubric where id_part='.$this->id_part.' and id_r='.$this->id_r;
 $temp=mysql_query($sql);
 $this->title=mysql_result($temp,0,0);
 $this->description=mysql_result($temp,0,1);
 $this->keyword=mysql_result($temp,0,2);
}
//---------------------------------------------------------------------------------------------------
function get_idx()
{
 if(!empty($this->idx)) return $this->idx;
 
 $sql='select idx from '.$this->pr.'rubric where id_part='.$this->id_part.' and id_r='.$this->id_r;
 $temp=mysql_query($sql);

 $this->idx=mysql_result($temp,0,0);
 return $this->idx;
}
//---------------------------------------------------------------------------------------------------
function get_name()
{
 if(!empty($this->name)) return $this->name;
 
 $sql='select name from '.$this->pr.'rubric where id_part='.$this->id_part.' and id_r='.$this->id_r;
 $temp=mysql_query($sql);

 $this->name=stripslashes(mysql_result($temp,0,0));
 return $this->name;
}
//---------------------------------------------------------------------------------------------------
function get_sid()
{
 if(!empty($this->sid)) return $this->sid;
 
 $sql='select sid from '.$this->pr.'rubric where id_part='.$this->id_part.' and id_r='.$this->id_r;
 $temp=mysql_query($sql);

 $this->sid=mysql_result($temp,0,0);
 return $this->sid;
}
//-----------------------------------------------------------------------------------------------------
};
?>