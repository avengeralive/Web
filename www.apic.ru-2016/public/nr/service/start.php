<?php
	include($inc_path."service/global_mode.php");
	
	$str=$_SERVER['REQUEST_URI'];
	$str=strtolower($str);

 	$mode=explode("/",$str);
    	
	array_pop($mode);
	array_shift($mode);

	if(in_array($mode[0],$remove))
	{
        $params["remove"]=array_shift($mode);
	}	

	if(in_array($mode[0],$gl_mode))
	{
        $global_mode=array_shift($mode);
	}	
	
	do
	{
		$flag=0;
		for($i=count($last)-1;$i>=0;$i--)
		{
			if(substr($mode[count($mode)-1],0,strlen($last[$i]))==$last[$i])
			{
				$flag=1;
				$val=array_pop($mode);
	    		$vala=explode("-",$val);
	    		$$vala[0]=$vala;
	    		break;
	    	}
		}
	}while($flag);
     
     if($error || $global_mode=="error")
     {
        header("HTTP/1.1 404 Not Found");
        header("Status: 404 Not Found");
        unset($mode);
        $global_mode="error";
     }
	
	$params["mode"]=$global_mode;
	$params["sort"]=$sort;
	$params["title"]=$conf_title;
	$params["action"]=$action;
    $params["list"]=$list;
    
    if($global_mode=="job" && $action[1]=="edit" && empty($finish))
    {
        $from=$_SERVER["HTTP_REFERER"];
        $exp = mktime(0,0,0,1,1,2050);	
        setcookie("from",$from,$exp,'/',$_SERVER['HTTP_HOST']);
    }
?>