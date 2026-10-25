<?php
//-------------------------------------------------------
$object_params["id_part"]=1;
$object_params["id_type"]=1;
$object_params["id"]=42;
$object_params["active"]=1;
$obj=new object($object_params,1);

$obj->get_content();
$text_down=$obj->field["val"][2];

$section_id=$_POST["section_id"];
if(empty($section_id)) $section_id=$mode[0]; 
if(empty($section_id)) $section_id=0;

$group_id=$_POST["group_id"];
if(empty($group_id)) $group_id=$mode[1];
if(empty($group_id)) $group_id=0;

$brand_id=$_POST["brand_id"];
if(empty($brand_id)) $brand_id=$mode[2];
if(empty($brand_id)) $brand_id=0;

$city_id=$_POST["city_id"];
if(empty($city_id)) $city_id="";

if(!empty($section_id)) 
 {
   $sql='select `id_s`,`name` from `apic_section` where `sid`="'.addslashes($section_id).'"'; 
   $sname=mysql_query($sql);
      
   $sid=mysql_result($sname,0,0);
   $navref=$navref.' &raquo; '.mysql_result($sname,0,1);
   $sname=mysql_result($sname,0,1);
 }
 
 if(!empty($group_id)) 
 {
   $sql='select `id_s`,`name` from `apic_section` where `sid`="'.addslashes($group_id).'"'; 
   $gname=mysql_query($sql);
      
   $gid=mysql_result($gname,0,0);
   $navref=$navref.' &raquo; '.mysql_result($gname,0,1);
   $gname=mysql_result($gname,0,1);
 }

 if(!empty($brand_id)) 
 {
   $sql='select `id_b`,`name` from `apic_brand` where `sid`="'.addslashes($brand_id).'"'; 
   $bname=mysql_query($sql);
   $bid=mysql_result($bname,0,0);
   $bname=mysql_result($bname,0,1);
 }

echo '<script language=Javascript>
        <!--
        var sect = new Array();
        var group = new Array();
        
        var groupsList = new Array();
        var curGroupId = "'.$group_id.'";';

$sql="select id_s,sid from apic_section where parent=0 order by id_s";
$tmp=mysql_query($sql);
$tmp_rows=mysql_num_rows($tmp);

$cur=0;

for($i=0;$i<$tmp_rows;$i++)
{
 echo 'sect["'.mysql_result($tmp,$i,1).'"] = \''.mysql_result($tmp,$i,1).'\';';  	
	
 $sql="select id_s,name,sid from apic_section where parent=".addslashes(mysql_result($tmp,$i,0))." order by id_s";
 $tmp1=mysql_query($sql);
 $tmp1_rows=mysql_num_rows($tmp1);
  
 for($j=0;$j<$tmp1_rows;$j++)
 {
  echo 'group["'.mysql_result($tmp1,$j,2).'"] = \''.mysql_result($tmp1,$j,2).'\';';
  echo 'groupsList["'.$cur.'"] = new Array("'.mysql_result($tmp,$i,1).'","'.mysql_result($tmp1,$j,2).'",\''.mysql_result($tmp1,$j,1).'\');';  
  $cur++;
 }
}


echo 'var isDisabledSelect = true;

function showGroups(selectObj)
{
	isDisabledSelect = true;
	curSection = selectObj.options[selectObj.selectedIndex].value;
	 
	var spanObj = document.getElementById(\'sgroup\');	 
 
    var documentCont="";
		 
	var groupsLength = groupsList.length;
    
    documentCont += \'<option value="">Все</option>\';
	
	if(curSection)
	{		 
	   
		 for (i = 0; i < groupsLength; i++)
		 {		 	  
		 	  if(groupsList[i][0] == curSection)		 	  
		 	  {
		 	     documentCont += "<option value=" + groupsList[i][1] + (curGroupId == groupsList[i][1] ? " selected" : "") + ">" + groupsList[i][2];	 		 	  
		 	     isDisabledSelect = false;
		 	  }   
		 }		 
   }
 		 
   spanObj.innerHTML = documentCont;	 
   $("#sgroup").dropdown("update");
}

//-->
</script>';

if(empty($section_id) && empty($group_id) && empty($brand_id) && empty($city_id)) echo '<h1>'.$obj->name.'</h1>';
else 
{
echo '<h1>Где приобрести оборудование? ';
if(!empty($sname)) echo '<br />'.$sname;
if(!empty($gname)) echo '<br />'.$gname;
if(!empty($bname)) echo '<br />'.$bname;
if(!empty($city_id)) echo '<br />г. '.$city_id;
echo '</h1>';
}

if(empty($section_id) && empty($group_id) && empty($brand_id) && empty($city_id)) echo $textile->TextileThis($text_up);

$sf.='<form name="filter_form" action="/buy/" method="post" class="content-form">            
        <fieldset>
								<div class="form-frame">
									<div class="col col01">
										<div class="form-row">
											<label class="control-label">Оборудование</label>
											<div class="input-block">
                                            <select name="section_id" id="section_id" onChange="showGroups(this);"> 

                      <option value="">Выбрать</option> ';

$sql="select id_s,name,sid from apic_section where parent=0 order by id_s";
$tmp=mysql_query($sql);
$tmp_rows=mysql_num_rows($tmp);

for($i=0;$i<$tmp_rows;$i++)
{
 $tsect=mysql_result($tmp,$i,2);
 if(!strcmp($section_id,$tsect)) $sf.='<option selected value=\''.mysql_result($tmp,$i,2).'\'>'.mysql_result($tmp,$i,1).'</option>'; 
 else $sf.='<option value=\''.mysql_result($tmp,$i,2).'\'>'.mysql_result($tmp,$i,1).'</option>';
}  	


                    $sf.='</select>
                    
                    </div>
										</div>
										<div class="form-row">
											<div class="input-block">
                    
                    <select id="sgroup" name="group_id"> 

                      <option value="">Все</option> 

                    </select>

                                </div>
										</div>
									</div>
									<div class="col col02">
										<div class="form-row">
											<label class="control-label">Бренд</label>
											<div class="input-block">
                
                <select name="brand_id">
                      <option value="">Все</option>';
$sql="select id_b,name,sid from apic_brand order by name";
$tmp=mysql_query($sql);
$tmp_rows=mysql_num_rows($tmp);

for($i=0;$i<$tmp_rows;$i++)
{
 $tbrand=mysql_result($tmp,$i,2);
 if(!strcmp($brand_id,$tbrand)) $sf.='<option selected value=\''.mysql_result($tmp,$i,2).'\'>'.mysql_result($tmp,$i,1).'</option>'; 
 else $sf.='<option value=\''.mysql_result($tmp,$i,2).'\'>'.mysql_result($tmp,$i,1).'</option>';
}
                      
                  $sf.='</select>
                  
                  </div>
										</div>
										<div class="form-row">
											<label class="control-label">Город</label>
											<div class="input-block">
                  
                  <select name="city_id">
                      <option value="">Все</option>';
$sql="select distinct city from firms where cexp_only=0 UNION SELECT city FROM firms_city ORDER BY city";
$tmp=mysql_query($sql);
$tmp_rows=mysql_num_rows($tmp);

for($i=0;$i<$tmp_rows;$i++)
{
 $tcity=mysql_result($tmp,$i,0);
 if(!strcmp($city_id,$tcity)) $sf.='<option selected value=\''.mysql_result($tmp,$i,0).'\'>'.mysql_result($tmp,$i,0).'</option>'; 
 else $sf.='<option value=\''.mysql_result($tmp,$i,0).'\'>'.mysql_result($tmp,$i,0).'</option>';
}
 
                  $sf.='</select>
                  
                  </div>
										</div>
									</div>
									<div class="btn-holder">
										<button class="btn red-btn"><span class="icon"><img src="/images/srch-ico.png" width="11" height="11" alt="image description"></span>Подобрать</button>
									</div>
								</div>
							</fieldset>

            </form>                   
<script language=Javascript>           
  showGroups(document.filter_form.section_id);
</script>     ';
    
    if(empty($section_id) && empty($group_id) && empty($brand_id) && empty($city_id)) echo $textile->TextileThis(str_replace('<sform></sform>',$sf,$text_down));
    else
    {
        echo $sf;
         
        
        $sql='select distinct `firms`.* from `firms`,`apic_sbf`';
        $sql=$sql.' where `firms`.`id`=`apic_sbf`.`id_f` and `firms`.`cexp_only` = 0'; 
        if(!empty($gid)) $sql=$sql.' and `apic_sbf`.`id_s`='.addslashes($gid);
        elseif(!empty($sid)) $sql=$sql.' and `apic_sbf`.`id_s`='.addslashes($sid);
        if(!empty($bid)) $sql=$sql.' and `apic_sbf`.`id_b`='.addslashes($bid);
        if(!empty($city_id)) $sql=$sql.' and (`firms`.`city`="'.addslashes($city_id).'" or `firms`.`id` in (select id_firm from firms_city_id where id_city in (select id from firms_city where city="'.addslashes($city_id).'")))';
        $sql=$sql.' order by `firms`.`name`;';
        
        //echo $sql;
        
        $res=mysql_query($sql);
        $res_count=mysql_numrows($res);
        
          if(strcmp($section_id,"tree"))
          {
           if(empty($res_count)) echo "<strong>По Вашему запросу ничего не найдено.</strong>";
           else echo '<ul class="object-list">';
              
          for($i=0;$i<$res_count;$i++)
           {
            $name=mysql_result($res,$i,1);
            $logo=mysql_result($res,$i,2);
            
            echo '<li>';
            if(!empty($logo)) echo '<div class="visual"><img src="/images/flogos/'.$logo.'" width="186" alt="'.$name.'"></div>';
								echo '<div class="frame">
									<div class="holder">
										<div class="text-block">
											<div class="name"><a href="/members/action-'.mysql_result($res,$i,0).'/">'.$name.'</a></div>
											<div class="text"><p>';
											echo mysql_result($res,$i,7)."<br />";
                                            $phone=mysql_result($res,$i,8);
                                            $pcod=mysql_result($res,$i,9);
                                            if(!empty($phone) && !empty($pcod)) echo "(".$pcod.")".$phone."<br />";
                                            $email=mysql_result($res,$i,14);
                                            if(!empty($email))
                                            {
                                            	 hideEmail($email,'class');
                                            	 echo "<br>";
                                            }
                                            $web=mysql_result($res,$i,15);
                                            $web = preg_match("/http:\/\//",$web)  ? $web : 'http://'.$web;
                                            if(!empty($web)) echo '<a href="'.$web.'" target="_blank">'.$web.'</a>';	
											echo '</p></div>
										</div>
									</div>
									<ul class="link-tools">
										<li><a href="/members/action-'.mysql_result($res,$i,0).'/">Подробнее о компании</a></li>
										<li><a href="/members/action-'.mysql_result($res,$i,0).'-equipment/">Полная карточка товаров</a></li>
									</ul>
								</div>
							</li>';
           }
           if(!empty($res_count)) echo '</ul>';
          }
          else
          {
          	$sql='select `id_s`,`sid`,`name` from `apic_section` where parent=0'; 
            $sect=mysql_query($sql);
            $sect_count=mysql_num_rows($sect);
            
            echo "<ul>";
            for($i=0;$i<$sect_count;$i++)
            {
             $sql='select `id_s`,`sid`,`name` from `apic_section` where parent='.addslashes(mysql_result($sect,$i,0)); 
             $ssect=mysql_query($sql);
             $ssect_count=mysql_num_rows($ssect);
             
             if($ssect_count>0)
             {
              echo "<li>".mysql_result($sect,$i,2);	
              echo "<ul>";
              for($j=0;$j<$ssect_count;$j++)
              {
               echo "<li>".'<a href="/buy/'.mysql_result($sect,$i,1).'/'.mysql_result($ssect,$j,1).'/">'.mysql_result($ssect,$j,2).'</a>';		
               
               $sql='select distinct `apic_brand`.`sid`,`apic_brand`.`name` from `apic_sbf`,`apic_brand`,firms';
							 $sql=$sql.' where `apic_sbf`.id_f=firms.id and firms.cexp_member=1 and `apic_sbf`.`id_s`='.mysql_result($ssect,$j,0).' and `apic_sbf`.`id_b`=`apic_brand`.`id_b`'; 
							 $sql=$sql.' order by `apic_brand`.`name`;';
							 
							 $brand=mysql_query($sql);
							 $brand_count=mysql_num_rows($brand);
							 
							 if($brand_count>0)
							 {
							 	echo "<ul>";
                for($k=0;$k<$brand_count;$k++)
                {
                 echo "<li>".'<a href="/buy/'.mysql_result($sect,$i,1).'/'.mysql_result($ssect,$j,1).'/'.mysql_result($brand,$k,0).'/">'.mysql_result($brand,$k,1).'</a>'."</li>";			
                }	
                echo "</li></ul>";
							 }							 
              }
              echo "</li></ul>";
              
             }
             else
             {
             	echo "<li>".'<a href="/buy/'.mysql_result($sect,$i,1).'/">'.mysql_result($sect,$i,2).'</a>'."</li>";	
             }	
            
            }
            echo "</ul>";
          }
    }   
?>