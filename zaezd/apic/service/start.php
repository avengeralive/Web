<?php
	include($inc_path."kernel/engine.php");
	include($inc_path."kernel/Parser.php");
    include($inc_path."kernel/DataBag.php");
    include($inc_path."kernel/Tag.php");
	include($inc_path."kernel/global_mode.php");
	
	$str=$_SERVER['REQUEST_URI'];
	if($str=="/rss/") $str="/";
    if($str=="/en/search/") {$str="/en/";$global_mode1="search";}
	$str=strtolower($str);
    $list=$_COOKIE['lc'];
    
	
    preg_match('/^([^?]+)(\?.*?)?(#.*)?$/', $str, $matches);
  	$gp = (isset($matches[2])) ? $matches[2] : '';
   	$str=preg_replace('/^([^?]+)(\?.*?)?(#.*)?$/', '$1$3', $str);
	
	if(strpos($str,",") || strpos($str,"//")!==false)
	{
		$error=404;
	}


    if(empty($error))
    {
//    	if(substr($str,strlen($str)-1,1)!="/")
    	if(FALSE)
    	{
    		$www=substr($_SERVER['HTTP_HOST'],0,4);
    		if($www!="www.") $hst="www.".$_SERVER['HTTP_HOST'];
    		else $hst=$_SERVER['HTTP_HOST'];
    		$path="Location: http://".$hst.$str."/".$gp;
    		$str=$str."/";
    	}
    	
    	$www=substr($_SERVER['HTTP_HOST'],0,4);
//    	if($www!="www.")
    	if(FALSE)
    	{
    		$hst="www.".$_SERVER['HTTP_HOST'];
    		$path="Location: http://".$hst.$str.$gp;
    	}
    	
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
            if($gl_last[$global_mode]==1 && count($mode)>0)
            {
    			$error=404;
            }
    	}	
    	
        if(empty($error))
        {
        	$is=-1;
        	do
        	{
        		$flag=0;
        		for($i=count($last)-1;$i>=0;$i--)
        		{
        			if(substr($mode[count($mode)-1],0,strlen($last[$i]))==$last[$i])
        			{
        				if($is!=-1 && $is<=$i)
        				{
        					$error=404;
                            break;
        				}
        				$is=$i;
        				
        				$flag=1;
        				$val=array_pop($mode);
        	    		$vala=explode("-",$val);
        	    		$$vala[0]=$vala;
        	    		break;
        	    	}
        		}
                if(!empty($error)) break;
        	}while($flag);
        }
     }
     
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
    
	$site=new engine($params);
	
	if($site->status==0 && $global_mode!="login")
	{
	    $sql='select id_part,id_type,id from '.$pr.'values_str where val="'.addslashes($_SERVER['REQUEST_URI']).'"';
        //echo $sql;
		$temp=mysql_query($sql);
		$tid_part=mysql_result($temp,0,0);
        
        if(empty($tid_part) && substr($_SERVER['REQUEST_URI'],strlen($str)-1,1)!="/")
    	{
    		$sql='select id_part,id_type,id from '.$pr.'values_str where val="'.addslashes($_SERVER['REQUEST_URI']).'/"';
            //echo $sql;
    		$temp=mysql_query($sql);
    		$tid_part=mysql_result($temp,0,0);
    	}
        
        if(empty($tid_part) && strpos($_SERVER['REQUEST_URI'],'index.php'))
        {
            $qstr=substr($_SERVER['REQUEST_URI'],0,strpos($_SERVER['REQUEST_URI'],'index.php'));
            
            $sql='select id_part,id_type,id from '.$pr.'values_str where val="'.addslashes($qstr).'"';
            //echo $sql;
    		$temp=mysql_query($sql);
    		$tid_part=mysql_result($temp,0,0);
        }
        
        if(empty($tid_part) && strpos($_SERVER['REQUEST_URI'],'full.php'))
        {
            $qstr=substr($_SERVER['REQUEST_URI'],0,strpos($_SERVER['REQUEST_URI'],'full.php'));
            
            $sql='select id_part,id_type,id from '.$pr.'values_str where val="'.addslashes($qstr).'"';
            //echo $sql;
    		$temp=mysql_query($sql);
    		$tid_part=mysql_result($temp,0,0);
        }

	    if(!empty($tid_part))
		{
			$tid_type=mysql_result($temp,0,1);
			$tid=mysql_result($temp,0,2);

			$object_params["id_part"]=$tid_part;
			$object_params["id_type"]=$tid_type;
			$object_params["id"]=$tid;

			$obj=new object($object_params,0);
			$path=$obj->get_path();

			$www=substr($_SERVER['HTTP_HOST'],0,4);
			if($www!="www.") $hst="www.".$_SERVER['HTTP_HOST'];
			else $hst=$_SERVER['HTTP_HOST'];
//			$path="Location: http://".$hst.$path.$gp;
//			header("HTTP/1.1 301 Moved permanentely");
//			header("Status: 301 Moved permanentely");
//			header($path);
//	  		die();
		}


		header("HTTP/1.1 404 Not Found");
		header("Status: 404 Not Found");
		unset($mode);
        unset($site);
        $global_mode="error";
        
        $params["mode"]=$global_mode;
	    $params["sort"]=$sort;
	    $params["title"]=$conf_title;
	    $params["action"]=$action;
        $params["list"]=$list;
        
        
	    $site=new engine($params);
	}
    
	
	if(!empty($path) && $global_mode!="error")
	{
//        header("HTTP/1.1 301 Moved permanentely");
//		header("Status: 301 Moved permanentely");
//		header($path);
//  		die();
	}
	
	$textile = new Parser();

?>