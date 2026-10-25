<?php
mb_internal_encoding("UTF-8");

include($inc_path."kernel/part.php");
include($inc_path."kernel/keyword.php");

class engine
{
 var $pr; 
 
 var $params;

 var $part;
 var $part_count;
 var $part_index;
 var $part_sid;
 
 var $type;
 var $type_count;
 var $type_index;
 var $type_sid;

 var $current;
 var $current_object;
 var $current_part;
 var $current_rubric;
 var $current_keyword;
 var $current_path;
 
 var $open;
 var $open_count;
 
 var $start;
 var $child_count;
 
 var $user_type;
 var $user_id;
 
 var $files_count;
 var $files;
 
 var $max;
 
 var $navy_bar;
 
 var $status;
 
 var $ts;
//---------------------------------------------------------------------------------------------------
function engine($params)
{
//---get vars-------------------------------
 	global $pr;

 	global $mode;
 	global $action;
 	global $page;

	$this->pr=$pr;
 	$this->user_type=$_SESSION["user_type"];
 	$this->user_id=$_SESSION["user_id"];
 	
 	$this->params=$params;
 	
 	if(!empty($page[1])) $this->start=$page[1];
 	else $this->start=0;
 	
 	$this->open_count=count($mode);
 	
 	$this->status=1;
 	
 	if(empty($this->pr)) {$this->status=0;return 0;}
 	
//---types-------------------- 	
$sql='select id_type,name,sid,type from '.$this->pr.'type order by id_type';
$temp=mysql_query($sql);
$this->type_count=mysql_num_rows($temp);

for($i=0;$i<$this->type_count;$i++)
{
	$this->type_index[$i]=mysql_result($temp,$i,0);
	$this->type_sid[mysql_result($temp,$i,2)]=mysql_result($temp,$i,0);
	$this->type[mysql_result($temp,$i,0)]["name"]=stripslashes(mysql_result($temp,$i,1));
	$this->type[mysql_result($temp,$i,0)]["sid"]=mysql_result($temp,$i,2);
	$this->type[mysql_result($temp,$i,0)]["type"]=mysql_result($temp,$i,3);
}
//---find current object-------------------- 	
if(empty($this->params["mode"]))
{
if($this->open_count==1)
{
	$sql='select id_part,name,sid,list,active,idx from '.$this->pr.'part where idx=0 and sid="'.$mode[0].'";';
	$temp=mysql_query($sql);
	if(mysql_result($temp,0,0)>0)
	{
		$this->current["part"]["id"]=mysql_result($temp,0,0);
		$this->current["part"]["name"]=stripslashes(mysql_result($temp,0,1));
		$this->current["part"]["sid"]=mysql_result($temp,0,2);
		if(!empty($this->params["list"])) $this->current["part"]["list"]=$this->params["list"];
        else $this->current["part"]["list"]=mysql_result($temp,0,3);	
		$this->current["part"]["active"]=mysql_result($temp,0,4);
		$this->current["part"]["main"]=mysql_result($temp,0,5);
	  	$this->child_count=$this->current["part"]["list"];
	  	
	  	if($this->current["part"]["main"])
		{$this->current_path="/"; $this->ts=0;}
		else {$this->current_path="/".$this->current["part"]["sid"].'/'; $this->ts=1;}
	  	
		$this->create_current_part();
		return 1;
	}	
}	
	
if(!empty($mode[$this->open_count-1]))
{
	$sql='select id_part,id_type,id,sid,list,active,ptype,pid from '.$this->pr.'object where sid="'.$mode[$this->open_count-1].'";';
	$temp=mysql_query($sql);
	$this->current["part"]["id"]=mysql_result($temp,0,0);
	$this->current["object"]["type"]=mysql_result($temp,0,1);	
    $this->current["object"]["id"]=mysql_result($temp,0,2);
    $this->current["object"]["sid"]=mysql_result($temp,0,3);
    if(!empty($this->params["list"])) $this->current["object"]["list"]=$this->params["list"];
    else $this->current["object"]["list"]=mysql_result($temp,0,4);
    $this->current["object"]["active"]=mysql_result($temp,0,5);	
    $this->current["object"]["ptype"]=mysql_result($temp,0,6);
    $this->current["object"]["pid"]=mysql_result($temp,0,7);
    
    if(($this->type[$this->current["object"]["type"]]["type"]==1 && empty($this->params["action"]) && $this->params["remove"]!="admin") || ($this->open_count==1 && $this->current["object"]["pid"]>0)) {$this->status=0;return 0;}
    
    $this->child_count=$this->current["object"]["list"];
    
    if($this->current["part"]["id"] && ($this->current["object"]["active"] || $this->permit($this->current["part"]["id"])))
    {
		if(!empty($this->current["object"]["list"])) $this->child_count=$this->current["object"]["list"];
		
		$sql='select val from '.$this->pr.'values_str where id_part='.$this->current["part"]["id"].' and id_type='.$this->current["object"]["type"].' and id='.$this->current["object"]["id"].' and id_fld=1;';
		$temp=mysql_query($sql);
		$this->current["object"]["name"]=stripslashes(mysql_result($temp,0,0));
		
		if($this->permit($this->current["part"]["id"])>0) $sql='select id_part,name,sid,list,active,idx from '.$this->pr.'part where id_part='.$this->current["part"]["id"];
		else $sql='select id_part,name,sid,list,active,idx from '.$this->pr.'part where active!=0 and id_part='.$this->current["part"]["id"];
		$temp=mysql_query($sql);
		$this->current["part"]["id"]=mysql_result($temp,0,0);
		$this->current["part"]["name"]=stripslashes(mysql_result($temp,0,1));
		$this->current["part"]["sid"]=mysql_result($temp,0,2);
		if(!empty($this->params["list"])) $this->current["part"]["list"]=$this->params["list"];
        else $this->current["part"]["list"]=mysql_result($temp,0,3);
		$this->current["part"]["active"]=mysql_result($temp,0,4);
		$this->current["part"]["main"]=mysql_result($temp,0,5);
		
		if(empty($this->child_count)) $this->child_count=$this->current["part"]["list"];
		
		$object_params["mode"]=$this->params["mode"];
		$object_params["id_part"]=$this->current["part"]["id"];
		$object_params["id_type"]=$this->current["object"]["type"];
		$object_params["id"]=$this->current["object"]["id"];
		$object_params["name"]=$this->current["object"]["name"];
		$object_params["sid"]=$this->current["object"]["sid"];
		$object_params["active"]=$this->current["object"]["active"];
		if(!empty($this->params["list"])) $object_params["child_count"]=$this->params["list"];
        else $object_params["child_count"]=$this->child_count;
		$object_params["start"]=$this->start;
	    	
	    $object_params["sort"]=$this->params["sort"];
	
		$this->current_object=new object($object_params,$this->permit($this->current["part"]["id"]));	
		
		if(!$this->current["part"]["main"] && $this->current["part"]["sid"]!=$mode[0]) 
			{$this->status=0;return 0;}
		
		
	}
	else {$this->status=0;return 0;}
//---open objects----------------------------------	
	if($this->current["part"]["main"]) 
	{$this->current_path="/"; $this->ts=0;}
	else {$this->current_path="/".$this->current["part"]["sid"].'/'; $this->ts=1;}
	
	$temp_type=$this->current["object"]["type"];
 	$temp_id=$this->current["object"]["id"];
 	$temp_sid=$this->current["object"]["sid"];
 	$temp_name=$this->current["object"]["name"];
 	
 	$this->open[$this->open_count-1]["type"]=$temp_type;
	$this->open[$this->open_count-1]["id"]=$temp_id;	
	$this->open[$this->open_count-1]["sid"]=$temp_sid;
	$this->open[$this->open_count-1]["name"]=$temp_name;
 	
	 	for($i=$this->open_count-2;$i>=$this->ts;$i--)
	 	{
	 	 $sql='select ptype, pid from '.$this->pr.'object where id_part='.$this->current["part"]["id"].' and id_type='.$temp_type.' and id='.$temp_id;	
	 	 $temp=mysql_query($sql);
	     $temp_type=mysql_result($temp,0,0);
	     $temp_id=mysql_result($temp,0,1);
	     
		 $sql='select sid,active,pid from '.$this->pr.'object where id_part='.$this->current["part"]["id"].' and id_type='.$temp_type.' and id='.$temp_id;
	 	 $temp=mysql_query($sql);
	     $temp_sid=mysql_result($temp,0,0);
	     $temp_active=mysql_result($temp,0,1);
	     $temp_pid=mysql_result($temp,0,2);
	     
		 if($temp_sid!=$mode[$i] || ($temp_active==0 && !$this->permit($this->current["part"]["id"])) || ($i==0 && $temp_pid>0))
	     {$this->status=0;return 0;} 
	     	     
	     $sql='select val from '.$this->pr.'values_str where id_part='.$this->current["part"]["id"].' and id_type='.$temp_type.' and id='.$temp_id.' and id_fld=1;';
		 $temp=mysql_query($sql);
		 $temp_name=mysql_result($temp,0,0);
		 
		 $this->open[$i]["type"]=$temp_type;
	 	 $this->open[$i]["id"]=$temp_id;	
	 	 $this->open[$i]["sid"]=$temp_sid;
	 	 $this->open[$i]["name"]=stripslashes($temp_name);
	 	}

	for($i=$this->ts;$i<$this->open_count;$i++)
 	 $this->current_path.=$this->open[$i]["sid"].'/';

	if(empty($this->child_count)) $this->child_count=$this->current["part"]["list"];
	
	if(!empty($this->current_object)) $this->current_object->path=$this->current_path;
}	
else
{
	$sql='select id_part,name,sid,list,active,idx from '.$this->pr.'part where idx=1;';
	$temp=mysql_query($sql);
	$this->current["part"]["id"]=mysql_result($temp,0,0);
	$this->current["part"]["name"]=stripslashes(mysql_result($temp,0,1));
	$this->current["part"]["sid"]=mysql_result($temp,0,2);
	if(!empty($this->params["list"])) $this->current["part"]["list"]=$this->params["list"];
    else $this->current["part"]["list"]=mysql_result($temp,0,3);	
	$this->current["part"]["active"]=mysql_result($temp,0,4);
	$this->current["part"]["main"]=mysql_result($temp,0,5);
	
	$this->child_count=$this->current["part"]["list"];
	
	if(!$this->current["part"]["active"] && !$this->permit($this->current["part"]["id"]))
	{$this->status=0;return 0;}
}
$this->create_current_part();
return 1;
}
//---rubric-----------------------------------
if($this->params["mode"]=="rubric")
{
	if(!empty($mode[$this->open_count-1]))
	{
		$sql='select id_part,id_r,parent,name,sid,list from '.$this->pr.'rubric where sid="'.$mode[$this->open_count-1].'";';
		$temp=mysql_query($sql);
		$this->current["part"]["id"]=mysql_result($temp,0,0);
		
		if($this->current["part"]["id"]>0)
		{
				$this->current["rubric"]["id"]=mysql_result($temp,0,1);
				$this->current["rubric"]["parent"]=mysql_result($temp,0,2);
				$this->current["rubric"]["name"]=stripslashes(mysql_result($temp,0,3));
				$this->current["rubric"]["sid"]=mysql_result($temp,0,4);
				if(!empty($this->params["list"])) $this->current["rubric"]["list"]=$this->params["list"];
                else $this->current["rubric"]["list"]=mysql_result($temp,0,5);
				
				if(!empty($this->current["rubric"]["list"])) $this->child_count=$this->current["rubric"]["list"];
				
				$sql='select id_part,name,sid,list,active,idx from '.$this->pr.'part where id_part='.$this->current["part"]["id"];
				if($this->permit($this->current["part"]["id"])==0) $sql.=' and active=1';
				$temp=mysql_query($sql);
				$this->current["part"]["id"]=mysql_result($temp,0,0);
				$this->current["part"]["name"]=stripslashes(mysql_result($temp,0,1));
				$this->current["part"]["sid"]=mysql_result($temp,0,2);
				if(!empty($this->params["list"])) $this->current["part"]["list"]=$this->params["list"];
                else $this->current["part"]["list"]=mysql_result($temp,0,3);
				$this->current["part"]["active"]=mysql_result($temp,0,4);
				$this->current["part"]["main"]=mysql_result($temp,0,5);
				
				if(!$this->current["part"]["main"] && $this->current["part"]["sid"]!=$mode[0]) 
					{$this->status=0;return 0;}
					
				$rubric_params["mode"]=$this->params["mode"];
				$rubric_params["id_part"]=$this->current["part"]["id"];
				$rubric_params["id_r"]=$this->current["rubric"]["id"];
				$rubric_params["name"]=$this->current["rubric"]["name"];
				$rubric_params["sid"]=$this->current["rubric"]["sid"];
				$rubric_params["parent"]=$this->current["rubric"]["parent"];
				if(!empty($this->params["list"])) $rubric_params["child_count"]=$this->params["list"];
                else $rubric_params["child_count"]=$this->child_count;
				$rubric_params["start"]=$this->start;
				
				$rubric_params["sort"]=$this->params["sort"];
				
				$this->current_rubric=new rubric($rubric_params,$this->permit($this->current["part"]["id"]));	
//--open-rubrics---------------------------------------------------------------------					
				if($this->current["part"]["main"]) 
					{$this->current_path="/"; $this->ts=0;}
				else {$this->current_path="/".$this->current["part"]["sid"].'/'; $this->ts=1;}
				
				for($i=$this->ts;$i<$this->open_count;$i++)
				{
					 $sql='select id_r,parent,name,sid,list from '.$this->pr.'rubric where sid="'.$mode[$i].'"';
				 	 $temp=mysql_query($sql);
				     
				     if(mysql_result($temp,0,0)>0)
				     {
				     	 if(empty($this->current["rubric"]["list"]) && mysql_result($temp,0,4)>0) $this->child_count=mysql_result($temp,0,4);
					 	 $this->open[$i-$this->ts]["id"]=mysql_result($temp,0,0);	
					 	 $this->open[$i-$this->ts]["sid"]=mysql_result($temp,0,3);
					 	 $this->open[$i-$this->ts]["name"]=stripslashes(mysql_result($temp,0,2));
					 	 
					 	 $this->current_path.=$this->open[$i-$this->ts]["sid"].'/';
				 	 }
				 	 else {$this->status=0;return 0;}
				}
				if(empty($this->child_count)) $this->child_count=$this->current["part"]["list"];				
				
				$this->current_rubric->path=$this->current_path;	

		}
		else if($this->open_count==1)
		{
			$sql='select id_part,name,sid,list,active,idx from '.$this->pr.'part where sid="'.$mode[0].'"';
			$temp=mysql_query($sql);
			$this->current["part"]["id"]=mysql_result($temp,0,0);
			$this->current["part"]["name"]=stripslashes(mysql_result($temp,0,1));
			$this->current["part"]["sid"]=mysql_result($temp,0,2);
			if(!empty($this->params["list"])) $this->current["part"]["list"]=$this->params["list"];
            else $this->current["part"]["list"]=mysql_result($temp,0,3);
			$this->current["part"]["active"]=mysql_result($temp,0,4);
			$this->current["part"]["main"]=mysql_result($temp,0,5);
			
			$this->child_count=$this->current["part"]["list"];	
			
			if(empty($this->current["part"]["id"]) || ($this->current["part"]["active"]==0 && !$this->permit($this->current["part"]["id"])))
				{$this->status=0;return 0;}	
		}
		else {$this->status=0;return 0;}
	}
	else
	{
		$sql='select id_part,name,sid,list,active,idx from '.$this->pr.'part where idx=1;';
		$temp=mysql_query($sql);
		$this->current["part"]["id"]=mysql_result($temp,0,0);
		$this->current["part"]["name"]=stripslashes(mysql_result($temp,0,1));
		$this->current["part"]["sid"]=mysql_result($temp,0,2);
		if(!empty($this->params["list"])) $this->current["part"]["list"]=$this->params["list"];
        else $this->current["part"]["list"]=mysql_result($temp,0,3);	
		$this->current["part"]["active"]=mysql_result($temp,0,4);
		$this->current["part"]["main"]=mysql_result($temp,0,5);
		
		$this->child_count=$this->current["part"]["list"];	
	}
	$this->create_current_part();
	
	return 1;
}
//---keyword-----------------------------------
if($this->params["mode"]=="temy")
{
    if($this->open_count<3)
    {
        if($this->open_count==2)
		{
            $sql='select id_part,name,sid,list,active,idx from '.$this->pr.'part where sid="'.$mode[0].'"';
			$temp=mysql_query($sql);
			$this->current["part"]["id"]=mysql_result($temp,0,0);
			$this->current["part"]["name"]=stripslashes(mysql_result($temp,0,1));
			$this->current["part"]["sid"]=mysql_result($temp,0,2);
			if(!empty($this->params["list"])) $this->current["part"]["list"]=$this->params["list"];
            else $this->current["part"]["list"]=mysql_result($temp,0,3);
			$this->current["part"]["active"]=mysql_result($temp,0,4);
			$this->current["part"]["main"]=mysql_result($temp,0,5);

			$this->child_count=$this->current["part"]["list"];

			if(empty($this->current["part"]["id"]) || ($this->current["part"]["active"]==0 && !$this->permit($this->current["part"]["id"])))
				{$this->status=0;return 0;}

            $sql='select id_key,word,sid from '.$this->pr.'keyword where sid="'.$mode[1].'";';
			$temp=mysql_query($sql);
			$this->current["keyword"]["id"]=mysql_result($temp,0,0);
			$this->current["keyword"]["word"]=stripslashes(mysql_result($temp,0,1));
			$this->current["keyword"]["list"]=$this->current["part"]["list"];
            $this->current["keyword"]["sid"]=mysql_result($temp,0,2);
			
			if($this->current["keyword"]["id"]>0)
                $this->create_current_keyword();
		}
		else if($this->open_count==1)
		{
	        $sql='select id_key,word,sid from '.$this->pr.'keyword where sid="'.$mode[0].'";';
			$temp=mysql_query($sql);
			$this->current["keyword"]["id"]=mysql_result($temp,0,0);
			$this->current["keyword"]["word"]=stripslashes(mysql_result($temp,0,1));
			$this->current["keyword"]["list"]=$this->current["part"]["list"];
            $this->current["keyword"]["sid"]=mysql_result($temp,0,2);

			if($this->current["keyword"]["id"]>0)
			{
	            $sql='select id_part,name,sid,list,active,idx from '.$this->pr.'part where idx=1';
				if($this->permit($this->current["part"]["id"])==0) $sql.=' and active=1';
				$temp=mysql_query($sql);
				$this->current["part"]["id"]=mysql_result($temp,0,0);
				$this->current["part"]["name"]=stripslashes(mysql_result($temp,0,1));
				$this->current["part"]["sid"]=mysql_result($temp,0,2);
				if(!empty($this->params["list"])) $this->current["part"]["list"]=$this->params["list"];
                else $this->current["part"]["list"]=mysql_result($temp,0,3);
				$this->current["part"]["active"]=mysql_result($temp,0,4);
				$this->current["part"]["main"]=mysql_result($temp,0,5);
				
				if(empty($this->current["part"]["id"])) {$this->status=0;return 0;}

	            $this->create_current_keyword();
			}
			else
            {
                $sql='select id_part,name,sid,list,active,idx from '.$this->pr.'part where sid="'.$mode[0].'"';
				$temp=mysql_query($sql);
				$this->current["part"]["id"]=mysql_result($temp,0,0);
				$this->current["part"]["name"]=stripslashes(mysql_result($temp,0,1));
				$this->current["part"]["sid"]=mysql_result($temp,0,2);
				if(!empty($this->params["list"])) $this->current["part"]["list"]=$this->params["list"];
                else $this->current["part"]["list"]=mysql_result($temp,0,3);
				$this->current["part"]["active"]=mysql_result($temp,0,4);
				$this->current["part"]["main"]=mysql_result($temp,0,5);

				$this->child_count=$this->current["part"]["list"];

				if(empty($this->current["part"]["id"]) || ($this->current["part"]["active"]==0 && !$this->permit($this->current["part"]["id"])))
					{$this->status=0;return 0;}
            }
		}
		else if($this->open_count==0)
		{
            	$sql='select id_part,name,sid,list,active,idx from '.$this->pr.'part where idx=1';
				if($this->permit($this->current["part"]["id"])==0) $sql.=' and active=1';
				$temp=mysql_query($sql);
				$this->current["part"]["id"]=mysql_result($temp,0,0);
				$this->current["part"]["name"]=stripslashes(mysql_result($temp,0,1));
				$this->current["part"]["sid"]=mysql_result($temp,0,2);
				if(!empty($this->params["list"])) $this->current["part"]["list"]=$this->params["list"];
                else $this->current["part"]["list"]=mysql_result($temp,0,3);
				$this->current["part"]["active"]=mysql_result($temp,0,4);
				$this->current["part"]["main"]=mysql_result($temp,0,5);

				if(empty($this->current["part"]["id"])) {$this->status=0;return 0;}
		}
		else {$this->status=0;return 0;}

        $this->create_current_part();
		return 1;
    }
}
//---other------------------------------------
if(!empty($this->params["mode"]))
{
	if(empty($this->params["part"])) $sql='select id_part,name,sid,list,active,idx from '.$this->pr.'part where idx=1';
	else $sql='select id_part,name,sid,list,active,idx from '.$this->pr.'part where id_part='.$this->params["part"];
	$temp=mysql_query($sql);
	$this->current["part"]["id"]=mysql_result($temp,0,0);
	$this->current["part"]["name"]=stripslashes(mysql_result($temp,0,1));
	$this->current["part"]["sid"]=mysql_result($temp,0,2);
	if(!empty($this->params["list"])) $this->current["part"]["list"]=$this->params["list"];
    else $this->current["part"]["list"]=mysql_result($temp,0,3);	
	$this->current["part"]["active"]=mysql_result($temp,0,4);
	$this->current["part"]["main"]=mysql_result($temp,0,5);
	
	if(empty($this->current["part"]["id"])) {$this->status=0;return 0;}
	
	if($this->permit($this->current["part"]["id"])==0 && !$this->current["part"]["active"]) 
		{$this->status=0;return 0;}
	
	$this->child_count=$this->current["part"]["list"];

	$this->create_current_part();
	
	return 1;
}
//---end-----------------------------------------------
$this->status=0;return 0;
}
//---------------------------------------------------------------------------------------------------
function type($mod)
{
	if(empty($mod)) return $this->type[$this->current_object->id_type]["sid"];
    elseif($mod=="name") return $this->type[$this->current_object->id_type]["name"];
    else return $this->type[$mod]["name"];
}
//---------------------------------------------------------------------------------------------------
function permit($id_part)
{
 	if($this->user_type==1) return 1;
	
	if($this->user_type==2 && empty($id_part)) return 2;
	
	if($this->user_type==2 && !empty($id_part))
	{
		$sql='select id_user from '.$this->pr.'user_part where id_part='.$id_part.' and id_user='.$this->user_id;
		$temp=mysql_query($sql);
		if($this->user_id==mysql_result($temp,0,0)) return 2;
	}
	
	if($this->user_type==3 && !empty($id_part))
	{
		$sql='select id_user from '.$this->pr.'user_part where id_part='.$id_part.' and id_user='.$this->user_id;
		$temp=mysql_query($sql);
		if($this->user_id>0 && $this->user_id==mysql_result($temp,0,0)) return 3;
	}
	
	return 0;
}
//---------------------------------------------------------------------------------------------------
function create_current_part()
{
$part_params["mode"]=$this->params["mode"];
$part_params["id"]=$this->current["part"]["id"];
$part_params["name"]=$this->current["part"]["name"];
$part_params["sid"]=$this->current["part"]["sid"];
$part_params["active"]=$this->current["part"]["active"];
$part_params["main"]=$this->current["part"]["main"];
$part_params["child_count"]=$this->child_count;
$part_params["start"]=$this->start;

$part_params["sort"]=$this->params["sort"];

if(!empty($part_params["id"])) $this->current_part=new part($part_params, $this->permit($this->current["part"]["id"]));
}
//---------------------------------------------------------------------------------------------------
function create_current_keyword()
{
$key_params["id"]=$this->current["keyword"]["id"];
$key_params["word"]=$this->current["keyword"]["word"];
$key_params["child_count"]=$this->current["part"]["list"];
$key_params["id_part"]=$this->current["part"]["id"];
$key_params["sid"]=$this->current["keyword"]["sid"];

if(!empty($key_params["id"])) $this->current_keyword=new keyword($key_params, $this->permit($this->current["part"]["id"]));

$this->child_count=$this->current["part"]["list"];
}
//---------------------------------------------------------------------------------------------------
function navy($tags,$aclass,$div,$url)
{
//---standart---------------------
if(empty($this->params["mode"]) || $this->params["mode"]=="rubric")
{
  $path=$url.'/';
  	
  if(!$this->current["part"]["main"]) $path.=$this->current["part"]["sid"].'/';
  
  if(($this->open_count-$this->ts)==0)
   $str=$tags["current"]["open"].'<a '.$aclass["current"].' href="'.$path.'" itemprop="url"><span itemprop="title">'.$this->current["part"]["name"].'</span></a>'.$tags["current"]["close"];
  else 
   $str=$tags["common"]["open"].'<a '.$aclass["common"].' href="'.$path.'" itemprop="url"><span itemprop="title">'.$this->current["part"]["name"].'</span></a>'.' '.$div.' '.$tags["common"]["close"];
  
  if($this->params["mode"]=="rubric") $path.='rubric/';
  
  
 for($i=$this->ts;$i<$this->open_count;$i++)
 {
  if($this->type[$this->open[$i]["type"]]["type"]==0)
  {
	  $path.=$this->open[$i]["sid"].'/';

	  if($i==$this->open_count-1)
	   $str.=$tags["current"]["open"].'<a '.$aclass["current"].' href="'.$path.'" itemprop="url"><span itemprop="title">'.$this->open[$i]["name"].'</span></a>'.$tags["current"]["close"];
	  else
	   $str.=$tags["common"]["open"].'<a '.$aclass["common"].' href="'.$path.'" itemprop="url"><span itemprop="title">'.$this->open[$i]["name"].'</span></a>'.' '.$div.' '.$tags["common"]["close"];
   }
 }
 return $str;
}
//---keyword--------------------------
if($this->params["mode"]=="temy")
{
 $path=$url.'/';
 
 if(!$this->current["part"]["main"]) $path.=$this->current["part"]["sid"].'/';
 
 $str=$tags["common"]["open"].'<a '.$aclass["common"].' href="'.$path.'" itemprop="url"><span itemprop="title">'.$this->current["part"]["name"].'</span></a>'.$tags["common"]["close"];
   
 $str.=' '.$div.' ';
   
 $path.='temy/';
   
 if(empty($this->current_keyword))
   $str.=$tags["current"]["open"].'<a '.$aclass["current"].' href="'.$path.'" itemprop="url"><span itemprop="title">Темы</span></a>'.$tags["current"]["close"];
 else
   $str.=$tags["common"]["open"].'<a '.$aclass["common"].' href="'.$path.'" itemprop="url"><span itemprop="title">Темы</span></a>'.$tags["common"]["close"];

 if(!empty($this->current_keyword))
 {
  $path=$path.$this->current_keyword->sid.'/';
  $str.=' '.$div.' ';
   $str.=$tags["current"]["open"].'<a '.$aclass["current"].' href="'.$path.'" itemprop="url"><span itemprop="title">'.$this->current_keyword->word.'</span></a>'.$tags["current"]["close"];
  }

 return $str;
}
//---other--------------------- 
  $str=$tags["common"]["open"].'<a '.$aclass["common"].' href="/" itemprop="url"><span itemprop="title">'.$this->current["part"]["name"].'</span></a>'.$tags["common"]["close"]; 	
  
  return $str;
}
//---------------------------------------------------------------------------------------------------
function get_meta($div)
{
//---standart--------------------------
if(empty($this->params["mode"]) && !empty($this->current_part))
{
 if(empty($this->current["object"]["id"])) $this->current["object"]["id"]=0;
 if(empty($this->current["object"]["type"])) $this->current["object"]["type"]=0;
 
 $sql='select title,description from '.$this->pr.'meta where id_part='.$this->current["part"]["id"].' and id_type='.$this->current["object"]["type"].' and id='.$this->current["object"]["id"];
 $temp=mysql_query($sql);
 $meta["title"]=mysql_result($temp,0,0);
 $meta["description"]=mysql_result($temp,0,1);
 
 $sql='select '.$this->pr.'keyword.word from '.$this->pr.'keyword inner join '.$this->pr.'object_keyword on '.$this->pr.'keyword.id_key='.$this->pr.'object_keyword.id_key where '.$this->pr.'object_keyword.id_part='.$this->current["part"]["id"].' and '.$this->pr.'object_keyword.id_type='.$this->current["object"]["type"].' and '.$this->pr.'object_keyword.id='.$this->current["object"]["id"];
 $temp=mysql_query($sql);
 $temp_rows=mysql_num_rows($temp);
 
 if($temp_rows>0)
 {
  $meta["keywords"]=mysql_result($temp,0,0);
 
  for($i=1;$i<$temp_rows;$i++)
   $meta["keywords"].=', '.mysql_result($temp,$i,0);
  
 }
 
 if(!empty($meta["title"]) || empty($div)) {$meta["title_own"]=1;return $meta;}  	
	
 if($this->params["title"]["type"]=="short")
 {
	$meta["title"]=$this->open[$this->open_count-$this->ts-1]["name"].$this->params["title"]["postfix"];
 }
 else
 {
	 $str=$this->current["part"]["name"];

	 for($i=$this->ts;$i<$this->open_count;$i++)
	 {
	    if($this->type[$this->open[$i]["type"]]["type"]==0)
	  	{
	  		$str=' '.$div.' '.$str;

	  		$str=$this->open[$i]["name"].$str;
		}
	 }

	 $meta["title"]=$str;
 }
 return $meta;  	
}
//---rubric--------------------------
if($this->params["mode"]=="rubric")
{
 $sql='select title,description,keywords from '.$this->pr.'rubric where id_part='.$this->current["part"]["id"].' and id_r='.$this->current["rubric"]["id"];
 $temp=mysql_query($sql);
 $meta["title"]=mysql_result($temp,0,0);
 $meta["description"]=mysql_result($temp,0,1);	
 $meta["keywords"]=mysql_result($temp,0,2);
 
 if(!empty($meta["title"]) || empty($div)) {$meta["title_own"]=1;return $meta;}
 
 $str=$this->current["part"]["name"];
 
 for($i=0;$i<$this->open_count-$this->ts;$i++)
 {
  $str=' '.$div.' '.$str;
  	
  $str=$this->open[$i]["name"].$str;
 } 
 
 $meta["title"]=$str;
 
 return $meta;  	
}
//---keyword--------------------------
if($this->params["mode"]=="temy")
{
 $sql='select title,description,keywords from '.$this->pr.'keyword where id_key='.$this->current["keyword"]["id"];
 $temp=mysql_query($sql);
 $meta["title"]=mysql_result($temp,0,0);
 $meta["description"]=mysql_result($temp,0,1);	
 $meta["keywords"]=mysql_result($temp,0,2);  
 
 if(!empty($meta["title"]) || empty($div)) {$meta["title_own"]=1;return $meta;} 
    
 $str=$this->current["part"]["name"];

 $str1=$str.' '.$div.' Темы ';
 $str='Темы'.$div.' '.$str;
 

 if(!empty($this->current_keyword))
 {
    $str=$this->current_keyword->word.' '.$div.' '.$str;
    $str1.=' '.$div.' '.$this->current_keyword->word;
    $meta["keywords"]=$this->current_keyword->word;
 }
 else $meta["keywords"]='Темы';

 $meta["title"]=$str;
 $meta["description"]=$str1;

 return $meta;
}
//---error---------------------------
if($this->params["mode"]=="error")
{
    $meta["title"]="Ошибка 404";
    
    return $meta;
}
//---other--------------------------
 $str=$this->current["part"]["name"];
 $meta["title"]=$str;
 return $meta;
 
}

//---------------------------------------------------------------------------------------------------
function get_parts()
{
	if($this->part_count>0) return;
	
	if($this->permit(0)>0) $sql='select id_part,name,sid,active,idx from '.$this->pr.'part order by idx desc, id_part';
	else $sql='select id_part,name,sid,active,idx from '.$this->pr.'part where active=1 order by idx desc, id_part';
	$temp=mysql_query($sql);
	$this->part_count=mysql_num_rows($temp);
	
	for($i=0;$i<$this->part_count;$i++)
	{
		$this->part_index[$i]=mysql_result($temp,$i,0);
		$this->part_sid[mysql_result($temp,$i,2)]=mysql_result($temp,$i,0);
		
		$part_params["mode"]=$this->params["mode"];
		$part_params["id"]=mysql_result($temp,$i,0);
		$part_params["name"]=mysql_result($temp,$i,1);
		$part_params["sid"]=mysql_result($temp,$i,2);
		$part_params["active"]=mysql_result($temp,$i,3);
		$part_params["child_count"]=$this->child_count;
		$part_params["start"]=$this->start;
		$part_params["main"]=mysql_result($temp,$i,4);
		
		$this->part[mysql_result($temp,$i,0)]=new part($part_params, $this->permit(mysql_result($temp,$i,0)));
	}	
}
//---------------------------------------------------------------------------------------------------
function new_part($fields)
{
	global $last;
	
	for($i=count($last)-1;$i>=0;$i--)
	{
	 if(substr($fields["sid"],0,strlen($last[$i]))==$last[$i]) return 0;
	}
	
	if(!$this->check_sid($fields["sid"])) return 0;
	
	$id_part=$this->new_part_id();
	
	if($fields["idx"]==1)
	{
		$sql='update '.$this->pr.'part set idx=0';
		mysql_query($sql);
	}
	else $fields["idx"]=0;
	
	if(empty($fields["list"])) $fields["list"]=0; 
	
	$sql='insert into '.$this->pr.'part set id_part='.$id_part.',name="'.addslashes($fields["name"]).'",sid="'.addslashes($fields["sid"]).'",txt="'.addslashes($fields["txt"]).'",list='.addslashes($fields["list"]).',active=1,idx='.addslashes($fields["idx"]);
	if(@mysql_query($sql)) 
	{
		$sql='insert into '.$this->pr.'meta set id_part='.$id_part.',id_type=0,id=0,title="'.addslashes($fields["title"]).'",description="'.addslashes($fields["description"]).'"';
		mysql_query($sql);
		
		$this->keywords_add($id_part,0,0,$fields["keywords"]);
		
		return 1;
	}	
	else return 0;
}
//---------------------------------------------------------------------------------------------------
function new_object($fields,$tp,$rub,$parg)
{
	global $last;
    if(empty($this->user_id) && !empty($fields["id_user"])) $this->user_id=$fields["id_user"];

	for($i=count($last)-1;$i>=0;$i--)
	{
	 if(substr($fields["sid"],0,strlen($last[$i]))==$last[$i]) return 0;
	}

	if(!$this->check_sid($fields["sid"]) && empty($parg["force_sid"])) return 0;
    else
    {
        $tmp_sid=$fields["sid"];
        $mod=1;
        while(!$this->check_sid($fields["sid"]))
        {
            $fields["sid"]=$tmp_sid.'_'.$mod;
            $mod++;
        }
    }

	$id_object=$this->new_object_id($tp);

	if(!empty($parg["id"]) && !empty($parg["type"]))
    {
        $parent=$parg["id"];
		$ptype=$parg["type"];
    }
	else if(!empty($this->current_object))
    {
		$parent=$this->current_object->id;
		$ptype=$this->current_object->id_type;
	}
	else
	{
		$parent=0;
		$ptype=0;
	}
    
    if($parg["active"]==2)
	{
        $active=2;
	}
	elseif($parg["active"]==1)
	{
        $active=1;
	}
	elseif($this->permit($this->current_part->id))
	{
		$active=1;
	}
	else 
    {
        $active=0;
    }
    
    if(empty($this->user_id)) $this->user_id=0;

	if(!isset($fields["list"])) $fields["list"]=100;
	
	if(!empty($fields["date_add"])) $dt_str=',tadd="'.addslashes($fields["date_add"]).'",tmodify=NOW()';
	else $dt_str=',tadd=NOW(),tmodify=NOW()';
    
    if(!empty($fields["nonrelated"])) $nr_str=',nonrelated='.addslashes($fields["nonrelated"]);
    else $nr_str=',nonrelated=0';
    
    if(!empty($fields["idx"])) $idx_str=',idx='.addslashes($fields["idx"]);
    else $idx_str=',idx=100';

	$sql='insert into '.$this->pr.'object set id_part='.$this->current_part->id.',id_type='.$tp.',id='.$id_object.',id_user='.$this->user_id.',pid='.$parent.',ptype='.$ptype.',sid="'.addslashes($fields["sid"]).'",active='.$active.',list='.$fields["list"].$idx_str.$dt_str.$nr_str;
    //echo $sql."<br />";
	if(@mysql_query($sql))
	{
		$this->fields_add($this->current_part->id,$tp,$id_object,$fields);

		$this->rubrics_add($this->current_part->id,$tp,$id_object,$rub);

		$sql='insert into '.$this->pr.'meta set id_part='.$this->current_part->id.',id_type='.$tp.',id='.$id_object.',title="'.addslashes($fields["title"]).'",description="'.addslashes($fields["description"]).'"';
		mysql_query($sql);

		$this->keywords_add($this->current_part->id,$tp,$id_object,$fields["keywords"]);

		return $id_object;
	}
	else return 0;
}
//---------------------------------------------------------------------------------------------------
function edit_object($fields,$rub)
{
	global $last;
	
	for($i=count($last)-1;$i>=0;$i--)
	{
	 if(substr($fields["sid"],0,strlen($last[$i]))==$last[$i]) return 0;
	}
	
	if(!$this->check_sid($fields["sid"],$this->current_object->sid)) return 0;
	
	$old_path=$this->current_object->get_path();
	
	if(!empty($fields["date_add"])) $dt_str=',tadd="'.addslashes($fields["date_add"]).'",tmodify=NOW()';
	else $dt_str=',tmodify=NOW()';
    
    if(!empty($fields["nonrelated"])) $nr_str=',nonrelated='.addslashes($fields["nonrelated"]);
    else $nr_str=',nonrelated=0';
    
    if(!empty($fields["idx"])) $idx_str=',idx='.addslashes($fields["idx"]);
    
    if(!isset($fields["list"])) $fields["list"]=100;
    
		
	if($this->permit($this->current["part"]["id"])>0 && $this->permit($this->current["part"]["id"])<3) $sql='update '.$this->pr.'object set sid="'.addslashes($fields["sid"]).'",list='.addslashes($fields["list"]).$dt_str.$nr_str.$idx_str.' where id_part='.$this->current_part->id.' and id_type='.$this->current_object->id_type.' and id='.$this->current_object->id;
	else $sql='update '.$this->pr.'object set sid="'.addslashes($fields["sid"]).'",list='.addslashes($fields["list"]).$dt_str.$nr_str.$idx_str.' where id_part='.$this->current_part->id.' and id_type='.$this->current_object->id_type.' and id='.$this->current_object->id;
    //echo $sql.'<br />';
	

	if(@mysql_query($sql)) 
	{
        $this->current_object->path="";

		$new_path=$this->current_object->get_path();

		$sql='update '.$this->pr.'values_str set val="'.addslashes($new_path).'" where val="'.addslashes($old_path).'"';
		mysql_query($sql);

		$this->fields_flush($this->current_part->id,$this->current_object->id_type,$this->current_object->id);
			
		$this->fields_add($this->current_part->id,$this->current_object->id_type,$this->current_object->id,$fields);
		
        if($rub!=-1 && $fields["mod"]!="fields_only")
        {
		  $this->rubrics_flush($this->current_part->id,$this->current_object->id_type,$this->current_object->id);
			
		  $this->rubrics_add($this->current_part->id,$this->current_object->id_type,$this->current_object->id,$rub);
        }
		
        if($fields["mod"]!="fields_only")
        {
		  $sql='update '.$this->pr.'meta set title="'.addslashes($fields["title"]).'",description="'.addslashes($fields["description"]).'" where id_part='.$this->current_part->id.' and id_type='.$this->current_object->id_type.' and id='.$this->current_object->id;
		  mysql_query($sql);
		
		  $this->keywords_flush($this->current_part->id,$this->current_object->id_type,$this->current_object->id);
		
		  $this->keywords_add($this->current_part->id,$this->current_object->id_type,$this->current_object->id,$fields["keywords"]);
        }
		
		return 1;
	}	
	else return 0;
}
//---------------------------------------------------------------------------------------------------
function move_object($psid)
{
	if($psid==$this->current_part->sid)
	{
		$tid=0;
		$tid_type=0;	
	}
	else
	{
		$sql='select id_type,id from '.$this->pr.'object where sid="'.$psid.'" and id_part='.$this->current_part->id;
		$tid=mysql_query($sql);
		$tid_type=mysql_result($tid,0,0);
		$tid=mysql_result($tid,0,1);
		
		if(empty($tid)) return 0;
	}
	
	$old_path=$this->current_object->get_path();
	
	$sql='update '.$this->pr.'object set ptype='.$tid_type.',pid='.$tid.' where id_part='.$this->current_part->id.' and id_type='.$this->current_object->id_type.' and id='.$this->current_object->id;
	$tid=mysql_query($sql);
	
	$this->current_object->path="";
	
	$new_path=$this->current_object->get_path();
	
	$sql='update '.$this->pr.'values_str set val="'.$new_path.'" where where val="'.$old_path.'"';
	mysql_query($sql);
	
	return 1;
}
//---------------------------------------------------------------------------------------------------
function cross_object($cross)
{
	$id_part=$this->current_object->id_part;
	$id_type=$this->current_object->id_type;
	$id=$this->current_object->id;
	
	$sql='delete from '.$this->pr.'object_cross where id_part='.$id_part.' and id_type='.$id_type.' and id='.$id;
	mysql_query($sql);
	$sql='delete from '.$this->pr.'object_cross where c_id_part='.$id_part.' and c_id_type='.$id_type.' and c_id='.$id;
	mysql_query($sql);
	
	foreach($cross as $val)
	{
        list($c_id_type,$c_id)=explode("-",$val);
        $sql='insert into '.$this->pr.'object_cross values('.$id_part.','.$id_type.','.$id.','.$id_part.','.$c_id_type.','.$c_id.')';
        mysql_query($sql);
        $sql='insert into '.$this->pr.'object_cross values('.$id_part.','.$c_id_type.','.$c_id.','.$id_part.','.$id_type.','.$id.')';
        mysql_query($sql);
	}

	return 1;
}
//---------------------------------------------------------------------------------------------------
function new_rubric($fields)
{
	global $last;
	
	for($i=count($last)-1;$i>=0;$i--)
	{
	 if(substr($fields["sid"],0,strlen($last[$i]))==$last[$i]) return 0;
	}
	
	$id_part=$this->current["part"]["id"];
	$parent=$this->current["rubric"]["id"];
	if(empty($parent)) $parent=0;
	if(empty($fields["list"])) $fields["list"]=0;
	
	if(!$this->check_sid($fields["sid"])) return 0;
	
	$id_r=$this->new_rubric_id();
	
	
	$sql='insert into '.$this->pr.'rubric set id_part='.$id_part.',id_r='.$id_r.',parent='.$parent.',name="'.addslashes($fields["name"]).'",sid="'.addslashes($fields["sid"]).'",txt="'.addslashes($fields["txt"]).'",list='.addslashes($fields["list"]).',title="'.addslashes($fields["title"]).'",description="'.addslashes($fields["description"]).'",keywords="'.addslashes($fields["keywords"]).'",idx=100';
	if(@mysql_query($sql)) return 1;
	else return 0;
}
//---------------------------------------------------------------------------------------------------
function new_keyword($fields)
{
	global $last;
	
	for($i=count($last)-1;$i>=0;$i--)
	{
	 if(substr($fields["sid"],0,strlen($last[$i]))==$last[$i]) return 0;
	}
	
	if(!$this->check_sid($fields["sid"])) return 0;
	
	$id_key=$this->new_keyword_id();
	
	$sql='insert into '.$this->pr.'keyword set id_key='.$id_key.',word="'.addslashes($fields["word"]).'",sid="'.$fields["sid"].'",txt="'.addslashes($fields["txt"]).'",title="'.addslashes($fields["title"]).'",description="'.addslashes($fields["description"]).'",keywords="'.addslashes($fields["keywords"]).'"';
	if(@mysql_query($sql)) return 1;
	else return 0;
}
//---------------------------------------------------------------------------------------------------
function edit_part($fields)
{
	global $last;
	
	for($i=count($last)-1;$i>=0;$i--)
	{
	 if(substr($fields["sid"],0,strlen($last[$i]))==$last[$i]) return 0;
	}
    
    $id_part=$this->current["part"]["id"];
	
	if(!$this->check_sid($fields["sid"],$this->current["part"]["sid"])) return 0;
	
	if($fields["idx"]==1)
	{
		$sql='update '.$this->pr.'part set idx=0 where id_part<>'.$id_part;
		mysql_query($sql);
	}
	else $fields["idx"]=0;
	
	$sql='update '.$this->pr.'part set name="'.addslashes($fields["name"]).'",sid="'.addslashes($fields["sid"]).'",txt="'.addslashes($fields["txt"]).'",list='.$fields["list"].',idx='.$fields["idx"].' where id_part='.$id_part;
	if(@mysql_query($sql)) 
	{
		$sql='update '.$this->pr.'meta set title="'.addslashes($fields["title"]).'",description="'.addslashes($fields["description"]).'" where id_part='.$id_part.' and id_type=0 and id=0';
		mysql_query($sql);
		
		$this->keywords_flush($id_part,0,0);
		$this->keywords_add($id_part,0,0,$fields["keywords"]);
		
		return 1;
	}	
	else return 0;
}
//---------------------------------------------------------------------------------------------------
function edit_rubric($fields)
{
	global $last;
	
	for($i=count($last)-1;$i>=0;$i--)
	{
	 if(substr($fields["sid"],0,strlen($last[$i]))==$last[$i]) return 0;
	}
	
	$id_r=$this->current["rubric"]["id"];
	
    if(!$this->check_sid($fields["sid"],$this->current["rubric"]["sid"])) return 0;
	
	if(!empty($temp)) return 0;
	
	$id_part=$this->current["part"]["id"];
	
	$sql='update '.$this->pr.'rubric set name="'.addslashes($fields["name"]).'",sid="'.addslashes($fields["sid"]).'",txt="'.addslashes($fields["txt"]).'",list='.addslashes($fields["list"]).',title="'.addslashes($fields["title"]).'",description="'.addslashes($fields["description"]).'",keywords="'.addslashes($fields["keywords"]).'" where id_part='.$id_part.' and id_r='.$id_r;
	if(@mysql_query($sql)) return 1;
	else return 0;
}
//---------------------------------------------------------------------------------------------------
function edit_keyword($fields)
{
	global $last;
	
	for($i=count($last)-1;$i>=0;$i--)
	{
	 if(substr($fields["sid"],0,strlen($last[$i]))==$last[$i]) return 0;
	}
	
	$id_key=$this->current["keyword"]["id"];
	
    if(!$this->check_sid($fields["sid"],$this->current["keyword"]["sid"])) return 0;
	
	if(!empty($temp)) return 0;
	
	$sql='update '.$this->pr.'keyword set word="'.addslashes($fields["word"]).'",sid="'.addslashes($fields["sid"]).'",txt="'.addslashes($fields["txt"]).'",title="'.addslashes($fields["title"]).'",description="'.addslashes($fields["description"]).'",keywords="'.addslashes($fields["keywords"]).'" where id_key='.$id_key;
	if(@mysql_query($sql)) return 1;
	else return 0;
}
//---------------------------------------------------------------------------------------------------
function new_part_id()
{
	$sql='select max(id_part) from '.$this->pr.'part';
	$temp=mysql_query($sql);
	$temp=mysql_result($temp,0,0);
	
	$temp++;
	
	return $temp;
}
//---------------------------------------------------------------------------------------------------
function new_rubric_id()
{
	$sql='select max(id_r) from '.$this->pr.'rubric';
	$temp=mysql_query($sql);
	$temp=mysql_result($temp,0,0);
	
	$temp++;
	
	return $temp;
}
//---------------------------------------------------------------------------------------------------
function new_keyword_id()
{
	$sql='select max(id_key) from '.$this->pr.'keyword';
	$temp=mysql_query($sql);
	$temp=mysql_result($temp,0,0);
	
	$temp++;
	
	return $temp;
}
//---------------------------------------------------------------------------------------------------
function new_file_id()
{
	$sql='select max(id_file) from '.$this->pr.'file';
	$temp=mysql_query($sql);
	$temp=mysql_result($temp,0,0);
	
	$temp++;
	
	return $temp;
}
//---------------------------------------------------------------------------------------------------
function new_object_id($id_type)
{
	$sql='select max(id) from '.$this->pr.'object where id_type='.$id_type;
	$temp=mysql_query($sql);
	$temp=mysql_result($temp,0,0);
	
	$temp++;
	
	return $temp;
}
//---------------------------------------------------------------------------------------------------
function part_activate($id_part)
{
	$sql='update '.$this->pr.'object set active=1 where id_part='.$id_part;
	mysql_query($sql);
	
	$sql='update '.$this->pr.'part set active=1 where id_part='.$id_part;
	if(@mysql_query($sql)) return 1;
	else return 0;
}
//---------------------------------------------------------------------------------------------------
function part_deactivate($id_part)
{
	$sql='update '.$this->pr.'object set active=0 where id_part='.$id_part;
	mysql_query($sql);
	
	$sql='update '.$this->pr.'part set active=0 where id_part='.$id_part;
	if(@mysql_query($sql)) return 1;
	else return 0;
}
//---------------------------------------------------------------------------------------------------
function object_activate($id_type, $id, $no_inc, $a_type)
{
	if(empty($id_type))
	{
        $id_type=$this->current_object->id_type;
        $id=$this->current_object->id;
	}
	
    if(empty($no_inc))
    {
    	$sql='select id_type,id from '.$this->pr.'object where id_part='.$this->current_part->id.' and ptype='.$id_type.' and pid='.$id;
        if(!empty($a_type)) $sql.=' and id_type='.$a_type;
    	$tmp=mysql_query($sql);
    	$tmp_rows=mysql_num_rows($tmp);
    	
    	for($i=0;$i<$tmp_rows;$i++)
    	{
    		$tid_type=mysql_result($tmp,$i,0);
    		$tid=mysql_result($tmp,$i,1);
    
    		if(!$this->object_activate($tid_type, $tid)) return 0;
    	}
    }
	
	$sql='update '.$this->pr.'object set active=1 where id_part='.$this->current_part->id.' and id_type='.$id_type.' and id='.$id;
	if(@mysql_query($sql)) return 1;
	else return 0;
}
//---------------------------------------------------------------------------------------------------
function object_deactivate($id_type, $id)
{
	if(empty($id_type))
	{
        $id_type=$this->current_object->id_type;
        $id=$this->current_object->id;
	}

	$sql='select id_type,id from '.$this->pr.'object where id_part='.$this->current_part->id.' and ptype='.$id_type.' and pid='.$id;
	$tmp=mysql_query($sql);
	$tmp_rows=mysql_num_rows($tmp);

	for($i=0;$i<$tmp_rows;$i++)
	{
		$tid_type=mysql_result($tmp,$i,0);
		$tid=mysql_result($tmp,$i,1);

		if(!$this->object_deactivate($tid_type, $tid)) return 0;
	}
	
	$sql='update '.$this->pr.'object set active=0 where id_part='.$this->current_part->id.' and id_type='.$id_type.' and id='.$id;
	if(@mysql_query($sql)) return 1;
	else return 0;
}
//---------------------------------------------------------------------------------------------------
function object_archive($id_type, $id)
{
	if(empty($id_type))
	{
        $id_type=$this->current_object->id_type;
        $id=$this->current_object->id;
	}
	
	$sql='select id_type,id from '.$this->pr.'object where id_part='.$this->current_part->id.' and ptype='.$id_type.' and pid='.$id;
	$tmp=mysql_query($sql);
	$tmp_rows=mysql_num_rows($tmp);
	
	for($i=0;$i<$tmp_rows;$i++)
	{
		$tid_type=mysql_result($tmp,$i,0);
		$tid=mysql_result($tmp,$i,1);

		if(!$this->object_archive($tid_type, $tid)) return 0;
	}
	
	$sql='update '.$this->pr.'object set active=2 where id_part='.$this->current_part->id.' and id_type='.$id_type.' and id='.$id;
	if(@mysql_query($sql)) return 1;
	else return 0;
}
//---------------------------------------------------------------------------------------------------
function object_delete($id_type,$id)
{
	if(empty($id_type))
	{
		$id_type=$this->current_object->id_type;
		$id=$this->current_object->id;	
	}
	
	$sql='select id_type,id from '.$this->pr.'object where id_part='.$this->current_part->id.' and ptype='.$id_type.' and pid='.$id;
	$temp=mysql_query($sql);
	$temp_rows=mysql_num_rows($temp);
	for($i=0;$i<$temp_rows;$i++)
	  $this->object_delete(mysql_result($temp,$i,0),mysql_result($temp,$i,1));

	
	$sql='select id_file from '.$this->pr.'file where id_part='.$this->current_part->id.' and id_type='.$id_type.' and id='.$id;
	$temp=mysql_query($sql);
	$temp_rows=mysql_num_rows($temp);
	
	for($i=0;$i<$temp_rows;$i++)
	{
		 $id_file=mysql_result($temp,$i,0);
		 $this->file_delete(mysql_result($temp,$i,0));
	}
	
	$sql='delete from '.$this->pr.'object where id_part='.$this->current_part->id.' and id_type='.$id_type.' and id='.$id;
	mysql_query($sql);
	
	$sql='delete from '.$this->pr.'object_rubric where id_part='.$this->current_part->id.' and id_type='.$id_type.' and id='.$id;
	mysql_query($sql);
	
	$sql='delete from '.$this->pr.'meta where id_part='.$this->current_part->id.' and id_type='.$id_type.' and id='.$id;
	mysql_query($sql);
	
	$sql='delete from '.$this->pr.'values_digit where id_part='.$this->current_part->id.' and id_type='.$id_type.' and id='.$id;
	mysql_query($sql);
	
	$sql='delete from '.$this->pr.'values_str where id_part='.$this->current_part->id.' and id_type='.$id_type.' and id='.$id;
	mysql_query($sql);
	
	$sql='delete from '.$this->pr.'values_text where id_part='.$this->current_part->id.' and id_type='.$id_type.' and id='.$id;
	mysql_query($sql);
	
	$sql='delete from '.$this->pr.'values_date where id_part='.$this->current_part->id.' and id_type='.$id_type.' and id='.$id;
	mysql_query($sql);
	
	$sql='delete from '.$this->pr.'object_keyword where id_part='.$this->current_part->id.' and id_type='.$id_type.' and id='.$id;
	mysql_query($sql);

	$sql='delete from '.$this->pr.'object_cross where id_part='.$this->current_part->id.' and id_type='.$id_type.' and id='.$id;
	mysql_query($sql);
	
	$sql='delete from '.$this->pr.'object_cross where c_id_part='.$this->current_part->id.' and c_id_type='.$id_type.' and c_id='.$id;
	mysql_query($sql);
}
//---------------------------------------------------------------------------------------------------
function part_delete($id_part)
{
	$sql='select id_file from '.$this->pr.'file where id_part='.$id_part;
	$temp=mysql_query($sql);
	$temp_rows=mysql_num_rows($temp);
	
	for($i=0;$i<$temp_rows;$i++)
	{
		 $id_file=mysql_result($temp,$i,0);
		 $this->file_delete(mysql_result($temp,$i,0));
	}
	
	$sql='delete from '.$this->pr.'user_part where id_part='.$id_part;
	mysql_query($sql);
	
	$sql='delete from '.$this->pr.'part where id_part='.$id_part;
	mysql_query($sql);
	
	$sql='delete from '.$this->pr.'part_type where id_part='.$id_part;
	mysql_query($sql);
	
	$sql='delete from '.$this->pr.'object where id_part='.$id_part;
	mysql_query($sql);
	
	$sql='delete from '.$this->pr.'rubric where id_part='.$id_part;
	mysql_query($sql);
	
	$sql='delete from '.$this->pr.'object_rubric where id_part='.$id_part;
	mysql_query($sql);
	
	$sql='delete from '.$this->pr.'meta where id_part='.$id_part;
	mysql_query($sql);
	
	$sql='delete from '.$this->pr.'values_digit where id_part='.$id_part;
	mysql_query($sql);
	
	$sql='delete from '.$this->pr.'values_str where id_part='.$id_part;
	mysql_query($sql);
	
	$sql='delete from '.$this->pr.'values_text where id_part='.$id_part;
	mysql_query($sql);
	
	$sql='delete from '.$this->pr.'values_date where id_part='.$id_part;
	mysql_query($sql);
	
	$sql='delete from '.$this->pr.'object_keyword where id_part='.$id_part;
	mysql_query($sql);

	$sql='delete from '.$this->pr.'object_cross where id_part='.$id_part;
	mysql_query($sql);

	$sql='delete from '.$this->pr.'object_cross where c_id_part='.$id_part;
	mysql_query($sql);

}
//---------------------------------------------------------------------------------------------------
function rubric_delete($id_part,$id_r)
{
	$sql='select id_r from '.$this->pr.'rubric where id_part='.$id_part.' and parent='.$id_r;
	$temp=mysql_query($sql);
	$temp_rows=mysql_num_rows($temp);
	for($i=0;$i<$temp_rows;$i++)
	 $this->rubric_delete($id_part,mysql_result($temp,$i,0));
	
	
	$sql='delete from '.$this->pr.'rubric where id_part='.$id_part.' and id_r='.$id_r;
	mysql_query($sql);
	
	$sql='delete from '.$this->pr.'object_rubric where id_part='.$id_part.' and id_r='.$id_r;
	mysql_query($sql);
}
//---------------------------------------------------------------------------------------------------
function keyword_delete($id_key)
{
	$sql='delete from '.$this->pr.'keyword where id_key='.$id_key;
	mysql_query($sql);
	
	$sql='delete from '.$this->pr.'object_keyword where id_key='.$id_key;
	mysql_query($sql);
}
//---------------------------------------------------------------------------------------------------
function keywords_add($id_part,$id_type,$id,$str)
{
	$num=0;

	$str=trim($str);
	
	while(strpos($str,",")!==false)
	{
	  $part[$num]=substr($str,0,strpos($str,","));
		$part[$num]=trim($part[$num]);
	  $str=substr($str,strpos($str,",")+1);
		$num++;
	}
	
	$part[$num]=trim($str);
	$num++;
	
	
	for($i=0;$i<$num;$i++)
	{
	    if(!empty($part[$i]))
	   	{
			$sql='SELECT id_key FROM '.$this->pr.'keyword WHERE word="'.addslashes($part[$i]).'"';
		    $id_key=mysql_query($sql);
		    $id_key=mysql_result($id_key, 0, 0);
		 
		    if($id_key>0) 
		    {
		     $sql='INSERT INTO '.$this->pr.'object_keyword set id_part='.$id_part.',id_type='.$id_type.',id='.$id.',id_key='.$id_key;
		     mysql_query($sql);
		    }
		   else
		   {
		     $id_key=$this->new_keyword_id();
             
             $iter=0;
             do
             {
                if(!empty($iter)) $sid=$this->translateStr($part[$i]).'_'.$iter;
                else $sid=$this->translateStr($part[$i]);
                
                $iter++;
             }while(!$this->check_sid($sid));
		  
		     $sql='INSERT INTO '.$this->pr.'keyword set id_key='.$id_key.', word="'.addslashes($part[$i]).'", sid="'.$sid.'"';
		     mysql_query($sql);
		     
		     $sql='INSERT INTO '.$this->pr.'object_keyword set id_part='.$id_part.',id_type='.$id_type.',id='.$id.',id_key='.$id_key;
		     mysql_query($sql); 
		    
		   }
	   }
	}
}
//---------------------------------------------------------------------------------------------------
function keywords_flush($id_part,$id_type,$id)
{
     $sql='delete from '.$this->pr.'object_keyword where id_part='.$id_part.' and id_type='.$id_type.' and id='.$id;
     mysql_query($sql);
}
//---------------------------------------------------------------------------------------------------
function rubrics_flush($id_part,$id_type,$id,$rub)
{
     if(count($rub)>0)
     {
        foreach($rub as $val)
        {
            $sql='delete from '.$this->pr.'object_rubric where id_part='.$id_part.' and id_type='.$id_type.' and id='.$id.' and id_r='.$val;
            mysql_query($sql);
        }
     }
     else
     {
        $sql='delete from '.$this->pr.'object_rubric where id_part='.$id_part.' and id_type='.$id_type.' and id='.$id;
        mysql_query($sql);
     }
}
//---------------------------------------------------------------------------------------------------
function fields_flush($id_part,$id_type,$id)
{
     	$sql='delete from '.$this->pr.'values_digit where id_part='.$this->current_part->id.' and id_type='.$this->current_object->id_type.' and id='.$this->current_object->id;
		mysql_query($sql);
		$sql='delete from '.$this->pr.'values_str where id_part='.$this->current_part->id.' and id_type='.$this->current_object->id_type.' and id='.$this->current_object->id;
		mysql_query($sql);
		$sql='delete from '.$this->pr.'values_text where id_part='.$this->current_part->id.' and id_type='.$this->current_object->id_type.' and id='.$this->current_object->id;
		mysql_query($sql);
		$sql='delete from '.$this->pr.'values_date where id_part='.$this->current_part->id.' and id_type='.$this->current_object->id_type.' and id='.$this->current_object->id;
		mysql_query($sql);
}
//---------------------------------------------------------------------------------------------------
function get_files($id_part,$id_type,$id)
{
	if(empty($id_part))
	{
		$id_part=$this->new_part_id();
		$id_type=0;
		$id=0;		
	}
	else
 	 if(empty($id)) $id=$this->new_object_id($id_type);
	
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
//---------------------------------------------------------------------------------------------------
function file_delete($id_file)
{
	global $inc_path;
	
	$sql='select path,preview from '.$this->pr.'file where id_file='.$id_file;
	$temp=mysql_query($sql);
	$path=mysql_result($temp,0,0);
	$preview=mysql_result($temp,0,1);
	
	if(!empty($path))
	{
		$sql='delete from '.$this->pr.'file where id_file='.$id_file;
		mysql_query($sql);
		
		$path=substr($path,1);
		$preview=substr($preview,1);
		unlink($inc_path.$path);
		unlink($inc_path.$preview);
		
		return 1;
	}
	else return 0;
}
//---------------------------------------------------------------------------------------------------
function file_upload($file,$alt,$auto_preview,$id_part,$id_type,$id)
{
	global $inc_path;

	if(empty($id_part))
	{
		$id_part=$this->new_part_id();
		$id_type=0;
		$id=0;		
	}
	if(!empty($id_part) && !empty($id_type) && empty($id)) $id=$this->new_object_id($id_type);
	
	$id_file=$this->new_file_id();
	
	$valid_types =  array("gif","jpg", "png", "jpeg", "pdf", "zip", "doc", "xls", "ppt", "rar","swf","docx","xlsx","pptx");
	$not_img =   array("pdf", "zip", "doc", "xls", "ppt", "rar","swf","docx","xlsx","pptx");

	$path=$inc_path."upload/files/";
	$preview=$inc_path."upload/preview/";
	
	$bpath="/upload/files/";
	$bpreview="/upload/preview/";
	
	if (isset($file)) 
	{	 	
	  if (is_uploaded_file($file['tmp_name'])) 
	  {
	    $filename = strtolower(substr($file['name'],0,strrpos($file['name'], ".")));
	    
	    $dir=substr($filename,0,1)."/";
	    
	    $ext = substr($file['name'], 1 + strrpos($file['name'], "."));
		$ext=strtolower($ext);
	    if (!in_array($ext, $valid_types)) return 0;
		else 
		{
		  if (!in_array($ext, $not_img)) $type=0;
		  else $type=1;	
	      $modifer="";
	      $mod="";
	      while(file_exists(($path.$dir.$filename.$mod.$modifer.".".$ext)))
	      {
	       if($modifer=="") $modifer=1;
	       else $modifer++;
	       $mod="_";
	      }
		 
		  if(!empty($modifer)) $modifer="_".$modifer;	 
	      if (@move_uploaded_file($file['tmp_name'],($path.$dir.$filename.$modifer.".".$ext))) 
		   	  $finname=$filename.$modifer.".".$ext;
		   else return 0;
		   
		   $size=intval($file['size']/1024);
	    } 
	  }
	  
	  if(!empty($auto_preview) && $type==0)
	  {
		   global $conf_preview;
		   
		   list($width, $height) = getimagesize($path.$dir.$filename.$modifer.".".$ext);
 	       
 	       if($conf_preview["cut"]==1)
 	       {
			if($width>$height) $percent=$conf_preview["size"]/$width;
           	else $percent=$conf_preview["size"]/$height;
 		   	$newwidth = intval($width * $percent);
           	$newheight =intval($height * $percent);
 
           	$thumb = imagecreatetruecolor($newwidth, $newheight);
           	$source = imagecreatefromjpeg($path.$dir.$filename.$modifer.".".$ext); 
           	imagecopyresampled($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
		   }
 	       elseif(!empty($conf_preview["height"]))
           {
            $percent=$conf_preview["height"]/$height;
 		    $newwidth = intval($width * $percent);
            $newheight =intval($height * $percent);
 
            $thumb = imagecreatetruecolor($newwidth, $newheight);
            $source = imagecreatefromjpeg($path.$dir.$filename.$modifer.".".$ext); 
            imagecopyresampled($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
           }
           elseif(!empty($conf_preview["width"]))
           {
            $percent=$conf_preview["width"]/$width;
 		    $newwidth = intval($width * $percent);
            $newheight =intval($height * $percent);
 
            $thumb = imagecreatetruecolor($newwidth, $newheight);
            $source = imagecreatefromjpeg($path.$dir.$filename.$modifer.".".$ext); 
            imagecopyresampled($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
           }
           elseif($conf_preview["type"]=="small")
           {
            if($height>$width) $percent=$conf_preview["size"]/$width;
            else $percent=$conf_preview["size"]/$height;
            
 		    $newwidth = intval($width * $percent);
            $newheight =intval($height * $percent);
 
            $thumb = imagecreatetruecolor($newwidth, $newheight);
            $source = imagecreatefromjpeg($path.$dir.$filename.$modifer.".".$ext); 
            imagecopyresampled($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
           }
           else
 	       {
           if($width>$height) $percent=$conf_preview["size"]/$width;
           else $percent=$conf_preview["size"]/$height;
 		   $newwidth = intval($width * $percent);
           $newheight =intval($height * $percent);
 
           $thumb = imagecreatetruecolor($newwidth, $newheight);
           $source = imagecreatefromjpeg($path.$dir.$filename.$modifer.".".$ext); 
           imagecopyresampled($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
           }
           imagejpeg($thumb,$preview.$dir.$filename.$modifer.".".$ext);
     }
     
     $sql='INSERT INTO '.$this->pr.'file set id_part='.$id_part.',id_type='.$id_type.',id='.$id.',id_file='.$id_file.',path="'.addslashes($bpath.$dir.$filename.$modifer.".".$ext).'",filename="'.addslashes($finname).'",type='.addslashes($type).',ext="'.addslashes($ext).'",alt="'.addslashes($alt).'",size='.addslashes($size);
     if(!empty($auto_preview) && $type==0) $sql.=',preview="'.addslashes($bpreview.$dir.$filename.$modifer.".".$ext).'"';
	 if(!@mysql_query($sql)) return 0;
	 else 
	 {
	 	chmod($path.$dir.$filename.$modifer.".".$ext,0644);
	 	if(!empty($auto_preview) && $type==0) chmod($preview.$dir.$filename.$modifer.".".$ext,0644);
		return 1;
	 }
	}
	else return 0;
}
//---------------------------------------------------------------------------------------------------
function file_db_add($id_type, $id, $path, $finname)
{
    $id_part=$this->current_part->id;
    $id_file=$this->new_file_id();
 
     $sql='INSERT INTO '.$this->pr.'file set id_part='.$id_part.',id_type='.$id_type.',id='.$id.',id_file='.$id_file.',path="'.addslashes($path).'",filename="'.addslashes($finname).'",type=0,ext="jpg",alt="",size=0';
	 if(!@mysql_query($sql)) return 0;
     else return $id_file;    
}
//---------------------------------------------------------------------------------------------------
function file_preview($id_file,$newwidth,$newheight)
{
	global $inc_path;

    if(!empty($newwidth) || !empty($newheight))
	  {
		$preview=$inc_path."upload/preview/";
  	    $bpreview="/upload/preview/";
	
	$sql='select filename from '.$this->pr.'file where id_file='.$id_file;
	$temp=mysql_query($sql);
	$temp=mysql_result($temp,0,0);
    
    if(!empty($temp))
    {
	$dir=substr($temp,0,1)."/";
	
	$file=$inc_path.'upload/files/'.$dir.$temp;
			
			list($width, $height) = getimagesize($file);
			
			if(empty($newwidth))
			{
				$percent=$newheight/$height;
           		$newwidth =intval($width * $percent);
			}
			if(empty($newheight))
			{
				$percent=$newwidth/$width;
           		$newheight =intval($height * $percent);
			}
	  
           $thumb = imagecreatetruecolor($newwidth, $newheight);
           $source = imagecreatefromjpeg($file); 
           imagecopyresampled($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
           imagejpeg($thumb,$preview.$dir.$temp);
     
     
     $sql='update '.$this->pr.'file set preview="'.addslashes($bpreview.$dir.$temp).'" where id_file='.$id_file;
	 if(!@mysql_query($sql)) return 0;
	 else 
	 {
	 	chmod($preview.$dir.$temp,0644);
		return 1;
	 }
     }
     else return 0;
}
return 0;
}
//---------------------------------------------------------------------------------------------------
function fields_add($id_part,$id_type,$id,$fields)
{
	$fields_count=$this->get_fields_count($id_type);
    $field=$this->get_fields($id_type);
    
    for($i=0;$i<$fields_count;$i++)
    {
	  if(!empty($fields[$i]) || is_numeric($fields[$i]))
	  {
	  switch($field["type"][$i])
      {
       case 1 : $sql='insert into '.$this->pr.'values_digit set val='.mysql_real_escape_string($fields[$i]);
                break;	
       case 2 : $sql='insert into '.$this->pr.'values_str set val="'.mysql_real_escape_string($fields[$i]).'"';
                break;	
       case 3 : $sql='insert into '.$this->pr.'values_text set val="'.mysql_real_escape_string($fields[$i]).'"';
                break;	
       case 4 : $sql='insert into '.$this->pr.'values_date set val="'.mysql_real_escape_string($fields[$i]).'"';
                break;	
      }
      
      $sql=$sql.',id_part='.$id_part.',id_type='.$id_type.',id_fld='.$field["id"][$i].',id='.$id;
      mysql_query($sql);
      }
	}
}
//---------------------------------------------------------------------------------------------------
function fields_check($id_part,$id_type,$id,$fields)
{
	$fields_count=$this->get_fields_count($id_type);
    $field=$this->get_fields($id_type);
    
    for($i=0;$i<$fields_count;$i++)
     if(empty($fields[$i]) && $field["empty"][$i]==0) return 0;
    
    return 1;
}
//---------------------------------------------------------------------------------------------------
function fields_inner_check($id_type,$fields)
{
	$fields_count=$this->get_fields_count($id_type);
    $field=$this->get_fields($id_type);
    
    $cflag=0;
    $fflag=1;
    for($i=0;$i<$fields_count;$i++)
     if(empty($fields[$i]) && $field["empty"][$i]==0) $cflag=1;
     elseif(!empty($fields[$i])) $fflag=0;
    
    if($fflag) return -1;
    elseif($cflag) return 0;
    else return 1;
}
//---------------------------------------------------------------------------------------------------
function rubrics_add($id_part,$id_type,$id,$rub)
{
	foreach($rub as $value)
	{
		$sql='insert into '.$this->pr.'object_rubric set id_part='.$id_part.',id_type='.$id_type.',id_r='.$value.',id='.$id;
      	mysql_query($sql);

	}
}
//---------------------------------------------------------------------------------------------------
function arrange($idxs,$rsort)
{
$part=$this->current_part;
if(empty($this->current_object))
	$parent=$this->current_part;
else
	$parent=$this->current_object;

if(count($rsort)>0 && !empty($this->current_object)) $parent->get_child_intersect("sort",0,"all",0,$rsort);
else $parent->get_child("special",0,"all");

for($i=0;$i<$parent->childs_count;$i++)
 if(isset($idxs[$i])) $this->set_index($part->id,$parent->childs_index[$i][0],$parent->childs_index[$i][1],$idxs[$i]);
}
//---------------------------------------------------------------------------------------------------
function set_index($id_part,$id_type,$id,$idx)
{
if(empty($idx)) $idx=0;

		$sql='update '.$this->pr.'object set idx='.$idx.' where id_part='.$id_part.' and id_type='.$id_type.' and id='.$id;
		  mysql_query($sql);

}
//---------------------------------------------------------------------------------------------------
function arrange_rubric($idxs)
{
$part=$this->current_part;
if(empty($this->current_rubric))
	$parent=$this->current_part;
else
	$parent=$this->current_rubric;

$parent->get_rubric();

for($i=0;$i<$parent->rubric_count;$i++)
 $this->set_index_rubric($part->id,$parent->rubric_index[$i],$idxs[$i]);
}
//---------------------------------------------------------------------------------------------------
function set_index_rubric($id_part,$id_r,$idx)
{
if(empty($idx)) $idx=0;

		$sql='update '.$this->pr.'rubric set idx='.$idx.' where id_part='.$id_part.' and id_r='.$id_r;
		  mysql_query($sql);

}
//---------------------------------------------------------------------------------------------------
function get_related_types($tp)
{
     $sql='select '.$this->pr.'type_type.id_type,'.$this->pr.'type.name from '.$this->pr.'type_type inner join '.$this->pr.'type using(id_type) where '.$this->pr.'type_type.id_type_r='.$tp;
     $temp=mysql_query($sql);
     $type_count=mysql_num_rows($temp);

	  for($i=0;$i<$type_count;$i++)
	  {	
	  $types["id_type"][$i]=mysql_result($temp,$i,0);
      $types["name"][$i]=mysql_result($temp,$i,1);
      }

	return $types;
}
//---------------------------------------------------------------------------------------------------
function get_fields($tp)
{
	if(!empty($this->current_object) && $this->current_object->id_type==$tp)
	{
		$this->current_object->get_content();
		$fields["name"]=$this->current_object->field["name"];
		$fields["type"]=$this->current_object->field["type"];
		$fields["empty"]=$this->current_object->field["empty"];
		$fields["id"]=$this->current_object->field["id"];
        $fields["idx"]=$this->current_object->field["idx"];
        $fields["fidx"]=$this->current_object->field["fidx"];
	}
	else
	{
		$sql='select id_fld,name,type,empty,idx from '.$this->pr.'field where id_type='.$tp.' order by idx,id_fld';
     $temp=mysql_query($sql);
     $field_count=mysql_num_rows($temp);

	  for($i=0;$i<$field_count;$i++)
	  {	
      $fields["name"][$i]=mysql_result($temp,$i,1);
      $fields["type"][$i]=mysql_result($temp,$i,2);
      $fields["empty"][$i]=mysql_result($temp,$i,3);
      $fields["id"][$i]=mysql_result($temp,$i,0);
      $fields["idx"][mysql_result($temp,$i,0)]=$i;
      $fields["fidx"][$i]=mysql_result($temp,$i,4);
      }
	}
	return $fields;
}
//---------------------------------------------------------------------------------------------------
function get_fields_count($tp)
{
	if(!empty($this->current_object) && $this->current_object->id_type==$this->type_sid[$tp])
	{
		$this->current_object->get_content();
		$count=$this->current_object->field_count;
	}
	else
	{
		$sql='select count(*) from '.$this->pr.'field where id_type='.$tp.' order by id_fld';
     $temp=mysql_query($sql);
     $count=mysql_result($temp,0,0);
	}
	return $count;
}
//---------------------------------------------------------------------------------------------------
function navy_bar($tags,$aclass,$params,$url,$max)
{
	 if(empty($max)) $max=$this->get_max($params["id_type"],$params["max_type"]);
	 $child_count=$this->child_count;
	 if(empty($child_count)) return;
	 
	 if(!empty($url)) $path=$url;
     
	if(empty($this->params["mode"]))
	{
		
		if(!empty($this->current_object)) $path.=$this->current_object->get_path();
		if(empty($path) && !empty($this->current_part)) $path.=$this->current_part->get_path();
		
	}
	else if($this->params["mode"]=="rubric")
	{
	 	if(!empty($this->current_rubric)) $path=$this->current_rubric->get_path();
	}
	else if($this->params["mode"]=="keyword")
	{
	 	if(!empty($this->current_keyword)) $path=$this->current_keyword->get_path();
	}
	else 
	{
		$path=$url;
		$max=$params["max"];	
		if(!empty($params["count"])) $child_count=$params["count"];
	}	
    
	if(count($this->params["sort"])>0 && $this->params["sort"][1]!="unrubric")
	{
	    $path.=implode('-',$this->params["sort"]).'/';
	}
	

   $ob_count=intval($max/$child_count);
   $diff=$max/$child_count-$ob_count;
   if($diff>0) $ob_count++;
   $string="";
   
   if($this->start<5) 
   {
    $first=0;
    $last=9;
   }
   else 
   { 
   	$first=$this->start-5;
    $last=$this->start+4;
   }

   if($ob_count<$this->start+5)
   {
    $last=$ob_count-1;
    $first=$last-9;
   }
   
   if($ob_count-1<$last)
    $last=$ob_count-1;
     
   if($first<0) $first=0;
   

   if($ob_count>1)
   {
   	   $string=$tags["main"]["open"];	 
   	   if($first>0) 
	   {
		if($first>1) $string=$string.$tags["common"]["open"].'<a '.$aclass["common"].'href="'.$path.'"><<</a>'.$tags["common"]["close"]." ";
		$string=$string.$tags["common"]["open"].'<a '.$aclass["common"].'href="'.$path.'page-'.($first-1).'/"><</a>'.$tags["common"]["close"]." ";
	   }
   	
    for($i=$first;$i<=$last;$i++)
    {
      if($this->start==$i) $string=$string.$tags["current"]["open"].($i+1).$tags["current"]["close"]." ";
      else 
      {
      	 if($i==0) $string=$string.$tags["common"]["open"].'<a '.$aclass["common"].'href="'.$path.'">'.($i+1).'</a>'.$tags["common"]["close"]." ";
      	 else $string=$string.$tags["common"]["open"].'<a '.$aclass["common"].'href="'.$path.'page-'.$i.'/">'.($i+1).'</a>'.$tags["common"]["close"]." ";
      }
    }	
    if($last<$ob_count-1) $string=$string.$tags["common"]["open"].'<a '.$aclass["common"].'href="'.$path.'page-'.($last+1).'/">></a>'.$tags["common"]["close"]." ";
    if($last<$ob_count-2) $string=$string.$tags["common"]["open"].'<a '.$aclass["common"].'href="'.$path.'page-'.($ob_count-1).'/">>></a>'.$tags["common"]["close"];
    
	$string=$string.$tags["main"]["close"];
   }
   
   $this->navy_bar=$string;
}
//---------------------------------------------------------------------------------------------------
function get_max($id_type, $max_type)
{
if(empty($max_type))
{    
	if(!empty($this->max) && !$this->params["ignore_max"]) return $this->max;
	
	switch($this->params["mode"])
	{
		case "rubric" : if(!empty($this->current_rubric) && !empty($this->current_part) && $this->params["sort"][1]!="rubric")
						{
							if($this->current_part->permit>0) $sql='select count(*) from '.$this->pr.'object_rubric  where id_part='.$this->current_part->id.' and id_r='.$this->current_rubric->id_r;
							else  $sql='select count(*) from '.$this->pr.'object_rubric inner join '.$this->pr.'object on '.$this->pr.'object.id_part='.$this->pr.'object_rubric.id_part and '.$this->pr.'object.id_type='.$this->pr.'object_rubric.id_type and '.$this->pr.'object.id='.$this->pr.'object_rubric.id where '.$this->pr.'object_rubric.id_part='.$this->current_part->id.' and '.$this->pr.'object_rubric.id_r='.$this->current_rubric->id_r.' and '.$this->pr.'object.active=1';
							if($id_type>0) $sql.=' and '.$this->pr.'object.id_type='.$id_type;
							$this->max=mysql_query($sql);
							$this->max=mysql_result($this->max,0,0);	
						}
                        elseif($this->params["sort"][1]=="rubric")
						{
						    $t_rub=$this->get_rubric_by_sid($this->params["sort"][2]);  
							if($this->current_part->permit>0) $sql='select count(*) from '.$this->pr.'object as o inner join '.$this->pr.'object_rubric as or1 on o.id_part=or1.id_part and o.id_type=or1.id_type and o.id=or1.id inner join '.$this->pr.'object_rubric as or2 on o.id_part=or2.id_part and o.id_type=or2.id_type and o.id=or2.id where or1.id_part='.$this->current_part->id.' and or1.id_r='.$this->current_rubric->id_r.' and or2.id_r='.$t_rub->id_r;
		else $sql='select count(*) from '.$this->pr.'object as o inner join '.$this->pr.'object_rubric as or1 on o.id_part=or1.id_part and o.id_type=or1.id_type and o.id=or1.id inner join '.$this->pr.'object_rubric as or2 on o.id_part=or2.id_part and o.id_type=or2.id_type and o.id=or2.id where o.tadd<=NOW() and o.active=1 and or1.id_part='.$this->current_part->id.' and or1.id_r='.$this->current_rubric->id_r.' and or2.id_r='.$t_rub->id_r; 
							if($id_type>0) $sql.=' and o.id_type='.$id_type;
							$this->max=mysql_query($sql);
							$this->max=mysql_result($this->max,0,0);	
						}
                        elseif($this->params["sort"][1]=="unrubric")
						{
						    $t_rub=$this->get_rubric_by_sid($this->params["sort"][2]);  
							if($this->current_part->permit>0) $sql='select count(*) from '.$this->pr.'object as o where o.id_part='.$this->current_part->id.' and (o.id_type, o.id) not in (select id_type,id from '.$this->pr.'object_rubric where id_r='.$t_rub->id_r.')';
		else $sql='select count(*) from '.$this->pr.'object as o where o.tadd<=NOW() and o.active=1 and o.id_part='.$this->current_part->id.' and (o.id_type, o.id) not in (select id_type,id from '.$this->pr.'object_rubric where id_r='.$t_rub->id_r.')'; 
							if($id_type>0) $sql.=' and o.id_type='.$id_type;
							$this->max=mysql_query($sql);
							$this->max=mysql_result($this->max,0,0);	
						}
						break;
        case "keyword" : if(!empty($this->current_keyword))
						{
							if($this->current_part->permit>0) $sql='select count(*) from '.$this->pr.'object_keyword  where id_part='.$this->current_part->id.' and id_key='.$this->current_keyword->id_key;
							else  $sql='select count(*) from '.$this->pr.'object_keyword inner join '.$this->pr.'object on '.$this->pr.'object.id_part='.$this->pr.'object_keyword.id_part and '.$this->pr.'object.id_type='.$this->pr.'object_keyword.id_type and '.$this->pr.'object.id='.$this->pr.'object_keyword.id where '.$this->pr.'object_keyword.id_part='.$this->current_part->id.' and '.$this->pr.'object_keyword.id_key='.$this->current_keyword->id_key.' and '.$this->pr.'object.active=1';
							if($id_type>0) $sql.=' and '.$this->pr.'object.type='.$id_type;
							//echo $sql;
							$this->max=mysql_query($sql);
							$this->max=mysql_result($this->max,0,0);
						}
						break;
        case "related" : if(!empty($this->current_object))
						{
							if($this->current_part->permit>0) $sql='select count(*) from '.$this->pr.'object_cross  where id_part='.$this->current_object->id_part.' and id_type='.$this->current_object->id_type.' and id='.$this->current_object->id;
							else  $sql='select count(*) from '.$this->pr.'object_cross inner join '.$this->pr.'object on '.$this->pr.'object.id_part='.$this->pr.'object_cross.c_id_part and '.$this->pr.'object.id_type='.$this->pr.'object_cross.c_id_type and '.$this->pr.'object.id='.$this->pr.'object_cross.c_id where'.$this->pr.'object_cross.id_part='.$this->current_object->part.' and '.$this->pr.'object_cross.id_type='.$this->current_object->id_type.' and '.$this->pr.'object_cross.id='.$this->current_object->id.' and '.$this->pr.'object.active=1';
							if($id_type>0) $sql.=' and '.$this->pr.'object.type='.$id_type;
							//echo $sql;
							$this->max=mysql_query($sql);
							$this->max=mysql_result($this->max,0,0);
						}
						break;
		default : if(!empty($this->current_part))
						{
							 if(!empty($this->current_object))
							 {
								$parent=$this->current_object->id;
								$ptype=$this->current_object->id_type;
								
							}
							else
							{
								$parent=0;
								$ptype=0;
							}
                            
                            if($this->params["sort"][1]=="rubric")
                            {
                            unset($t_id_r);
                            for($i=2;$i<count($this->params["sort"]);$i++)
                            {
                                $trub=$this->get_rubric_by_sid($this->params["sort"][$i]);
                                $t_id_r[]=$trub->id_r;
                            }    
                                
                                
                            $sql='select distinct o.id_type, o.id, o.sid, o.active from '.$this->pr.'object as o';
                            if(count($t_id_r)>0)
                            {
                                $code=1;
                                foreach($t_id_r as $val)
                                {
                                    $sql.=' inner join '.$this->pr.'object_rubric as or'.$code.' on o.id_part=or'.$code.'.id_part and o.id_type=or'.$code.'.id_type and o.id=or'.$code.'.id';
                                    $code++;
                                }
                            }
                    		
                    	
                    		$sql.=' where';
                            
                            if($this->permit>0) $sql.=' o.ptype='.$ptype.' and o.pid='.$parent;
                            else $sql.=' o.tadd<=NOW() and o.active=1 and o.ptype='.$ptype.' and o.pid='.$parent;
                            
                            if(count($t_id_r)>0)
                            {
                                $code=1;
                                foreach($t_id_r as $val)
                                {
                                    $sql.=' and or'.$code.'.id_r='.$val;
                                    $code++;
                                }
                            }
                    	$temp=mysql_query($sql);
                    	$this->max=mysql_num_rows($temp);
						}
                        else
                        {	
							$sql='select count(*) from '.$this->pr.'object where id_part='.$this->current_part->id.' and pid='.$parent.' and ptype='.$ptype;
							if($this->current_part->permit==0) $sql.=' and active=1';
							if($id_type>0) $sql.=' and id_type='.$id_type;
							$this->max=mysql_query($sql);
							$this->max=mysql_result($this->max,0,0);
                        }	
						}
						break;
		break;
	}
}
elseif($max_type=="related")
{
        $sql='select count(*) from '.$this->pr.'object inner join '.$this->pr.'object_cross on '.$this->pr.'object.id_part='.$this->pr.'object_cross.c_id_part and '.$this->pr.'object.id_type='.$this->pr.'object_cross.c_id_type and '.$this->pr.'object.id='.$this->pr.'object_cross.c_id where '.$this->pr.'object_cross.id_part='.$this->current_object->id_part.' and '.$this->pr.'object_cross.id_type='.$this->current_object->id_type.' and '.$this->pr.'object_cross.id='.$this->current_object->id;
		if($this->current_part->permit==0) $sql.=' and '.$this->pr.'object.active=1';
		if($id_type>0) $sql.=' and '.$this->pr.'object.id_type='.$id_type;
        $this->max=mysql_query($sql);
		$this->max=mysql_result($this->max,0,0);

}
elseif($max_type=="subchild")
{
    if(!empty($this->current_object))
    {
        $sql='select count(*) from '.$this->pr.'object as m1 inner join '.$this->pr.'object as m2 on m1.id_part=m2.id_part and m1.ptype=m2.id_type and m1.pid=m2.id where m1.id_part='.$this->current_part->id.' and m2.ptype='.$this->current_object->id_type.' and m2.pid='.$this->current_object->id;
    	if($this->current_part->permit==0) $sql.='  and m1.tadd<=NOW() and m1.active=1';
    	if($id_type>0) $sql.=' and id_type='.$id_type;
    	//echo $sql;
    	$this->max=mysql_query($sql);
    	$this->max=mysql_result($this->max,0,0);
    }
}
	
	return $this->max;
}
//---------------------------------------------------------------------------------------------------
function import($fields,$rub,$tp,$parg)
{
    if($fields["action"]=="update")
    {
        $sql='select id from '.$this->pr.'object where sid="'.$fields["sid"].'"';
        //echo $sql."<br />";
        $temp=mysql_query($sql);
        $id=mysql_result($temp,0,0);
        //echo $id."<br />";;
        $tmp_object=$this->current_object;
        
        $object_params["id_part"]=$this->current_part->id;
		$object_params["id_type"]=$tp;
		$object_params["id"]=$id;
        $object_params["sid"]=$fields["sid"];

		$this->current_object=new object($object_params,0);
        
        /*$this->current_object->get_content();
        
        foreach($this->current_object->field["val"] as $key=>$val)
            if(empty($fields[$key])) $fields[$key]=$val; */
        
        $this->edit_object($fields,$rub);
        
        $this->current_object=$tmp_object;
    }
    else $id=$this->new_object($fields,$tp,$rub,$parg);
    
    if(!empty($fields["archive"])) $this->object_archive($tp, $id);
    else $this->object_activate($tp, $id);
    
    return $id;
}
//---------------------------------------------------------------------------------------------------
function import_data($fields,$tp)
{
    if(!empty($fields["sid"]))
    {
        $sql='select id from '.$this->pr.'object where sid="'.$fields["sid"].'"';
        $temp=mysql_query($sql);
        $id=mysql_result($temp,0,0);
    }
    elseif(!empty($fields["id"])) 
    {
        $id=$fields["id"];   
        $sql='select sid from '.$this->pr.'object where id="'.$fields["id"].'" and id_type='.$tp;
        $temp=mysql_query($sql);
        $sid=mysql_result($temp,0,0);
        $fields["sid"]=$sid;
    }
    ob_start();
    echo 'processing...<br />';
    if(!empty($id))
    {
        $tmp_object=$this->current_object;
        
        $object_params["id_part"]=$this->current_part->id;
		$object_params["id_type"]=$tp;
		$object_params["id"]=$id;

		$this->current_object=new object($object_params,0);
        $this->current_object->get_content();
		$field_val=$this->current_object->field["val"];
        
        $fields=$fields+$field_val;
        
        //print_r($fields);
        
        $fields["mod"]="fields_only";
        $rub=-1;
        $this->edit_object($fields,$rub);
        
        $this->current_object=$tmp_object;
    }
    ob_end_flush();
}
//---------------------------------------------------------------------------------------------------
function is_crossing($obj,$cobj)
{
 if(empty($cobj)) $cobj=$this->current_object;
 
 $sql='select count(*) from '.$this->pr.'object_cross where c_id_part='.$cobj->id_part.' and c_id_type='.$cobj->id_type.' and c_id='.$cobj->id.' and id_part='.$obj->id_part.' and id_type='.$obj->id_type.' and id='.$obj->id;
 $temp=mysql_query($sql);
 $count= mysql_result($temp,0,0);

 if($count==1) return 1;
 else return 0;
}
//---------------------------------------------------------------------------------------------------
function get_rubric_by_sid($sid)
{
    $sql='select id_part, id_r, parent, name from '.$this->pr.'rubric where sid="'.addslashes($sid).'"';
    $temp=mysql_query($sql);
    $id_part=mysql_result($temp,0,0);
    $id_r=mysql_result($temp,0,1);
    $parent=mysql_result($temp,0,2);
    $name=mysql_result($temp,0,3);
    
    $rubric_params["id_part"]=$id_part;
	$rubric_params["id_r"]=$id_r;
	$rubric_params["sid"]=$sid;
    $rubric_params["parent"]=$parent;
    $rubric_params["name"]=$name;
	
	$r=new rubric($rubric_params,0);
    
    return $r;
}
//---------------------------------------------------------------------------------------------------
function get_object_by_sid($sid)
{
    $sql='select id_part, id_type, id from '.$this->pr.'object where sid="'.addslashes($sid).'"';
    $temp=mysql_query($sql);
    $id_part=mysql_result($temp,0,0);
    $id_type=mysql_result($temp,0,1);
    $id=mysql_result($temp,0,2);
    
    if(empty($id)) return 0;
    
    $object_params["id_part"]=$id_part;
	$object_params["id_type"]=$id_type;
	$object_params["id"]=$id;
	$object_params["active"]=1;

    $obj=new object($object_params,$this->permit($id_part));
    
    return $obj;
}
//---------------------------------------------------------------------------------------------------
function get_rubric_by_name($name)
{
    $sql='select id_part, id_r, parent,sid from '.$this->pr.'rubric where name="'.addslashes($name).'"';
    $temp=mysql_query($sql);
    $id_part=mysql_result($temp,0,0);
    $id_r=mysql_result($temp,0,1);
    $parent=mysql_result($temp,0,2);
    $sid=mysql_result($temp,0,3);
    
    $rubric_params["id_part"]=$id_part;
	$rubric_params["id_r"]=$id_r;
	$rubric_params["sid"]=$sid;
    $rubric_params["parent"]=$parent;
    $rubric_params["name"]=$name;
	
	$r=new rubric($rubric_params,0);
    
    return $r;
}
//---------------------------------------------------------------------------------------------------
function check_sid($new_sid,$old_sid)
{
    if(!empty($old_sid) && $new_sid==$old_sid) return 1;
    
    $sql='select id_part from '.$this->pr.'object where sid="'.addslashes($new_sid).'"';
	$temp=mysql_query($sql);
	$temp=mysql_result($temp,0,0);

	if(!empty($temp)) return 0;

	$sql='select id_part from '.$this->pr.'part where sid="'.addslashes($new_sid).'"';
	$temp=mysql_query($sql);
	$temp=mysql_result($temp,0,0);

	if(!empty($temp)) return 0;

	$sql='select id_r from '.$this->pr.'rubric where sid="'.addslashes($new_sid).'"';
	$temp=mysql_query($sql);
	$temp=mysql_result($temp,0,0);

	if(!empty($temp)) return 0;
    
    $sql='select id_key from '.$this->pr.'keyword where sid="'.addslashes($new_sid).'"';
	$temp=mysql_query($sql);
	$temp=mysql_result($temp,0,0);

	if(!empty($temp)) return 0;
    
    return 1;
}
//---------------------------------------------------------------------------------------------------
function translateStr($name) 
{
  $name=mb_strtolower($name);  
  $mr[1]="а";
  $me[1]="a";
  $mr[2]="б";
  $me[2]="b";
  $mr[3]="в";
  $me[3]="v";
  $mr[4]="г";
  $me[4]="g";
  $mr[5]="д";
  $me[5]="d";
  $mr[6]="е";
  $me[6]="e";
  $mr[7]="ё";
  $me[7]="e";
  $mr[8]="ж";
  $me[8]="zh";
  $mr[9]="з";
  $me[9]="z";
  $mr[10]="и";
  $me[10]="i";
  $mr[11]="й";
  $me[11]="i";
  $mr[12]="к";
  $me[12]="k";
  $mr[13]="л";
  $me[13]="l";
  $mr[14]="м";
  $me[14]="m";
  $mr[15]="н";
  $me[15]="n";
  $mr[16]="о";
  $me[16]="o";
  $mr[17]="п";
  $me[17]="p";
  $mr[18]="р";
  $me[18]="r";
  $mr[19]="с";
  $me[19]="s";
  $mr[20]="т";
  $me[20]="t";
  $mr[21]="у";
  $me[21]="u";
  $mr[22]="ф";
  $me[22]="f";
  $mr[23]="х";
  $me[23]="h";
  $mr[24]="ц";
  $me[24]="c";
  $mr[25]="ч";
  $me[25]="ch";
  $mr[26]="ш";
  $me[26]="sh";
  $mr[27]="щ";
  $me[27]="shh";
  $mr[28]="ъ";
  $me[28]="";
  $mr[29]="ы";
  $me[29]="i";
  $mr[30]="ь";
  $me[30]="";
  $mr[31]="э";
  $me[31]="eh";
  $mr[32]="ю";
  $me[32]="ju";
  $mr[33]="я";
  $me[33]="ja";
  $mr[34]=" ";
  $me[34]="_";
  $mr[35]=".";
  $me[35]="";
  $mr[36]=",";
  $me[36]="";
  $mr[37]="-";
  $me[37]="_";
  $mr[38]="#";
  $me[38]="";
  $mr[39]="%";
  $me[39]="";
  $mr[40]="$";
  $me[40]="";
  $mr[41]="'";
  $me[41]="";
  $mr[42]="\"";
  $me[42]="";
  $mr[43]=":";
  $me[43]="";
  $mr[44]=";";
  $me[44]="";
  $mr[45]="@";
  $me[45]="";
  $mr[46]="^";
  $me[46]="";
  $mr[47]="*";
  $me[47]="";
  $mr[48]="+";
  $me[48]="";
  $mr[49]="=";
  $me[49]="";
  $mr[50]="&";
  $me[50]="";
  $mr[51]="<";
  $me[51]="";
  $mr[52]=">";
  $me[52]="";
  $mr[53]="?";
  $me[53]="";
  $mr[54]="!";
  $me[54]="";
  $mr[55]="/";
  $me[55]="";
  $mr[56]="\\";
  $me[56]="";
  $mr[57]="~";
  $me[57]="";
  $mr[58]="№";
  $me[58]="";
  $mr[59]="(";
  $me[59]="";
  $mr[60]=")";
  $me[60]="";
  $mr[61]="{";
  $me[61]="";
  $mr[62]="}";
  $me[62]="";
  $mr[63]="[";
  $me[63]="";
  $mr[64]="]";
  $me[64]="";
  $mr[65]="|";
  $me[65]="";
  $mr[66]="«";
  $me[66]="";
  $mr[67]="»";
  $me[67]="";
  $mr[68]="…";
  $me[68]="";
  $mr[69]="—";
  $me[69]="";
  $mr[70]="™";
  $me[70]="";
  $mr[71]="’";
  $me[71]="";
  
  return str_replace('__','_',str_replace('___','_',str_replace($mr,$me,$name)));  
}
//---------------------------------------------------------------------------------------------------  
}
//--additional functions---------------------------
function hideEmail($email,$name) {
   if(empty($name)) $name=$email;
   $str = "document.write('<a href=\"mailto:$email\">".$name."</a>')";
   $res = '';
   for ($i = 0; $i < mb_strlen($str); $i++) {
        $res .= '%u'.unibin2hex(mb_substr($str, $i, 1));
   }
   return "<script language='JavaScript'>eval(unescape('$res'))</script>";
 }
//---------
function make_name($text,$len)
{

 $res="";

 if(mb_strlen($text)<=$len) return $text;

 $tmp=mb_substr($text,0,$len+50);

 $tok = strtok($tmp, " \n\t");

 do
 {
	if(!empty($res)) $res.=" ".$tok;
	else $res=$tok;
    $tok = strtok(" \n\t");
 }
 while(mb_strlen($res.$tok)<$len-1);

 return $res;
}
//---------------------------------
function unibin2hex($u) {
     $k = mb_convert_encoding($u, 'UCS-2LE', 'UTF-8');
     $k1 = bin2hex(substr($k, 0, 1));
     $k2 = bin2hex(substr($k, 1, 1));
     return $k2.$k1;
 }
//---------------------------------
/*function GetRealIp()
{
 if (!empty($_SERVER['HTTP_CLIENT_IP'])) 
 {
   $ip=$_SERVER['HTTP_CLIENT_IP'];
 }
 elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
 {
  $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
 }
 else
 {
   $ip=$_SERVER['REMOTE_ADDR'];
 }
 return $ip;
}*/
?>