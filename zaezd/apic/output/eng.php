<?php
//-------------------------------------------------------
if($site->type()=="article" && $site->current_object->sid=="members_apic" && empty($action[1]) && !$stop)
{
$site->current_object->get_content();
$text=$site->current_object->field["val"][2];

if(!strpos($text,'<h1>')) echo '<h1>'.$site->current_object->name.'</h1>';
echo $textile->TextileThis($text);

$sql='select id,name from firms_en where cexp_only=0 order by name';
$firms=mysql_query($sql);
$firms_count=mysql_num_rows($firms);

echo '<table>';
for($i=0;$i<$firms_count;$i++)
{
    echo '<tr>';
    
    $id_firm=mysql_result($firms,$i,0);
    $name=mysql_result($firms,$i,1);
    
    echo '<td><a href="/en/members_apic/action-'.$id_firm.'/"><img src="/images/bul_4.gif" alt="Подробнее о компании '.$name.'" /></td><td><a href="/en/members_apic/action-'.$id_firm.'/">'.$name.'</a></td>';
    
    echo '</tr>';    
}          
echo '</table>';

$stop=1;
}
//-------------------------------------------------------
if($site->type()=="article" && $site->current_object->sid=="members_apic" && !empty($action[1]) && !$stop)
{
$sql='select * from firms_en where cexp_only=0 and id='.addslashes($action[1]);
$firm=mysql_query($sql);
$id_firm=mysql_result($firm,0,0);

if(empty($id_firm))
{
    echo '<h1>Firm not found</h1>';
}
else
{
    $name=mysql_result($firm,0,1);
            $logo=mysql_result($firm,0,2);
        $phone=mysql_result($firm,0,8);
        $pcode=mysql_result($firm,0,9);
        $phone=$pcode.' '.$phone;
        $web=mysql_result($firm,0,15);
        $web = preg_match("/http:\/\//",$web)  ? $web : 'http://'.$web;
        
        $equip=mysql_result($firm,0,3);
        $serv=mysql_result($firm,0,4);
        $info=mysql_result($firm,0,5);
        $deal=mysql_result($firm,0,6);
        
        $adr=mysql_result($firm,0,7);
        $phone2=mysql_result($firm,0,10);
        $pcode2=mysql_result($firm,0,11);
        $phone2=$pcode2.' '.$phone2;
        $fax=mysql_result($firm,0,12);
        $fcode=mysql_result($firm,0,13);
        $fax=$fcode.' '.$fax;
        $mail=mysql_result($firm,0,14);
        
        if(!empty($logo))
        {
        list($lw,$lh)=getimagesize($inc_path.'/images/flogos/'.$logo);
    
    $coefw=170/$lw;
    $coefh=120/$lh;
    if($coefw>=$coefh) $coef=$coefh;
    else $coef=$coefw;
    }    
        
        echo '<div class="item-info">
    							<div class="item-visual">
    								<img src="/images/img27.jpg" width="878" height="232" alt="">';
    								if(!empty($logo)) echo '<strong class="item-logo"><a href="'.$web.'" target="_blank"><img class="flogo" width="'.intval($lw*$coef).'" height="'.intval($lh*$coef).'" src="/images/flogos/'.$logo.'" alt="'.$name.'"></a></strong>';
        								echo '<div class="text-block">
    									<div class="name">'.$name.'</div>
    									<div class="phone">'.$phone.'</div>
    									<div class="links">
    										<!-- <a href="#">Скачать презентацию</a> -->
    										<a href="'.$web.'" target="_blank">'.$web.'</a>
    									</div>
    								</div>
    							</div>
    							<ul class="item-menu">
    								<li><a href="/en/members_apic/action-'.$id_firm.'/#about">About</a></li>
    								<li><a href="/en/members_apic/action-'.$id_firm.'-equipment/">Equipment</a></li>
    								<!-- <li><a href="/members/object/">Objects</a></li>
    								<li><a href="/members/news/action-firm-'.$id_firm.'/">News</a></li> -->
    								<li><a href="/en/members_apic/action-'.$id_firm.'/#contacts">Contacts</a></li>
    							</ul>
    						</div>';
    
    if($action[2]=="equipment")
    {
        echo '<h1>'.$name.'. Full list of products</h1>';
        
        $sql="select id_s,name_en from apic_section where parent=0 order by id_s";
        $tmp=mysql_query($sql);
        $tmp_rows=mysql_num_rows($tmp);
        
        $count=0;
        $max=0;
        
        for($i=0;$i<$tmp_rows;$i++)
        {
         $sum=0;	
        	
         $sql="select id_s,name_en from apic_section where parent=".mysql_result($tmp,$i,0)." order by id_s";
         $tmp1=mysql_query($sql);
         $tmp1_rows=mysql_num_rows($tmp1);	 
        	
          for($j=0;$j<$tmp1_rows;$j++)
          {
           $sql="select apic_brand.name from apic_brand,apic_sbf where apic_brand.id_b=apic_sbf.id_b and apic_sbf.id_f=".addslashes($id_firm)." and apic_sbf.id_s=".mysql_result($tmp1,$j,0)." order by apic_brand.name";
           $tmp2[$j]=mysql_query($sql);
           $tmp2_rows[$j]=mysql_num_rows($tmp2[$j]);	 
           $sum+=$tmp2_rows[$j];
           if($max<$tmp2_rows[$j]) $max=$tmp2_rows[$j];
          }
          
          if($sum>0)
          {
          	if($count==0) echo '<table>';
          	echo '<tr>';
          	echo '<th colspan="'.($max+1).'">';
          	echo mysql_result($tmp,$i,1);
          	echo '</th>';
          	echo '</tr>';
          	
          	for($j=0;$j<$tmp1_rows;$j++)
            {
             if($tmp2_rows[$j]>0)	
             {
             	echo '<tr>';
             	echo '<td>';
             	echo mysql_result($tmp1,$j,1);
             	echo '</td>';
             	for($k=0;$k<$tmp2_rows[$j];$k++)
             	{
             		echo '<td>';
             		echo mysql_result($tmp2[$j],$k,0);
             		echo '</td>';
             	}
             	for($k=$tmp2_rows[$j];$k<$max;$k++)
             	{
             		echo '<td>';
             		echo '&nbsp';
             		echo '</td>';
             	}
             	echo '</tr>';
             }
            }
            
            $count++;
          }
        }
        if($count>0) echo '</table>';
        
    }
    else
    {

        
        echo '<h1 id="about">'.$name.'</h1>';
        
        if(!empty($equip))
        {
            echo '<h2>Equipment</h2>';
            echo $textile->TextileThis($equip);
        }
        if(!empty($serv))
        {
            echo '<h2>Service</h2>';
            echo $textile->TextileThis($serv);
        }
        if(!empty($info))
        {
            echo '<h2>Additional info</h2>';
            echo $textile->TextileThis($info);
        }
        
        echo '<h2 id="contacts">'.$name.'. Contacts</h2>';
        
        if(!empty($adr)) echo '<p><strong>Address: </strong>'.$adr.'</p>';
        if(!empty($phone)) echo '<p><strong>Phone: </strong>'.$phone.'</p>';
        if(!empty($phone2)) echo '<p><strong>Phone: </strong>'.$phone2.'</p>';
        if(!empty($fax)) echo '<p><strong>Fax: </strong>'.$fax.'</p>';
        if(!empty($mail)) echo '<p><strong>E-mail: </strong><a href="mailto:'.$mail.'">'.$mail.'</a></p>';
        if(!empty($web)) echo '<p><strong>Web: </strong><noindex><a href="'.$web.'" target="_blank" rel="nofollow">'.$web.'</a></noindex></p>';
        
        if(!empty($deal))
        {
            echo '<h2>Dealers</h2>';
            echo $textile->TextileThis($deal);
        }
    }
}

$stop=1;
}
//-------------------------------------------------------
if($site->type()=="article" && !$stop)
{
$site->current_object->get_content();
$text=$site->current_object->field["val"][2];

echo '<h1>'.$site->current_object->name.'</h1>';
echo $textile->TextileThis($text);

$site->current_object->get_child("normal",0,0);

echo $site->navy_bar;

for($j=0;$j<$site->current_object->childs_count;$j++)
{
	$id_type=$site->current_object->childs_index[$j][0];
	$id=$site->current_object->childs_index[$j][1];
	$obj1=$site->current_object->childs[$id_type][$id];
	

	$obj1->get_content();
	
	$obj1->get_date();
	
	$text=$obj1->field["val"][1];
	echo '<h2><a href="'.$obj1->get_path().'">'.$obj1->name.'</a></h2>';
	if(!empty($text) && !empty($obj1->field["val"][2])) echo $textile->TextileThis($text.' <a href="'.$obj1->get_path().'">Read more</a>');
	else echo $textile->TextileThis($text);
}

echo $site->navy_bar;

}
//-------------------------------------------------------
?>