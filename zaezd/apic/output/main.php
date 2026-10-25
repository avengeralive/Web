<?php
//-------------------------------------------------------
if($site->open[0]["sid"]=="questions")
{
    echo '<h1>Вопросы исполнительному директору</h1>';
    
    echo ' <script type="text/javascript" language="JavaScript">var id_form=5;window.onload=doLoad(\'\');</script>
    <div class="container" id="output">
    </div>';
    
    $start=$page[1];
    if(empty($start)) $start=0;
    
    $sql='select count(*) from gb_messages where list=1';
    $count=mysql_query($sql);
    $count=mysql_result($count,0,0);
    
    $ob_count=intval($count/10);
    $diff=$count/10-$ob_count;
    $string="<p>";
    $path="/questions/";
    
    if($start<5) 
    {
        $first=0;
        $last=8;
    }
    else 
    { 
        $first=$start-5;
        $last=$start+3;
    }
    
    if($ob_count<$start+5)
    {
        $last=$ob_count-1;
        $first=$last-9;
    }
    
    if($first<0) $first=0;
    if($ob_count<$last) $last=$ob_count-1;
    
    if($diff>0) $last++;
    
    if($first>0) $string.='<li><a href="'.$path.'page-'.($first-1).'/"><<</a></li>';
      
    if($ob_count>0)
    {
    for($i=$first;$i<=$last;$i++)
    {
    
          $text=$i+1;
          
        if($start==$i) $string=$string.'<li class="current">'.$text."</li>";
      else 
      {
      	 if($i==0) $string=$string.'<li><a href="'.$path.'">'.$text.'</a>'."</li>";
      	 else $string=$string.'<li><a href="'.$path.'page-'.$i.'/">'.$text.'</a>'."</li>";
      }
    }	
    if($last<$ob_count-1) $string=$string.'<li><a href="'.$path.'page-'.($last+1).'/">>></a></li>';
    }
    $string='<ul class="pagination">'.$string."</ul>";
    
    echo $string;
    
    $sql='select name,city,message,answer,time from gb_messages where list=1 order by id desc limit '.($start*10).',10';
    $m=mysql_query($sql);
    $m_count=mysql_num_rows($m);
    
    echo '<div class="distribution"><ul class="distribution-list">';
    
    for($i=0;$i<$m_count;$i++)
    {
        $name=mysql_result($m,$i,0);
        $city=mysql_result($m,$i,1);
        $mess=mysql_result($m,$i,2);
        $answ=mysql_result($m,$i,3);
        $time=mysql_result($m,$i,4);
        
        if(!empty($city)) $city=', '.$city;
        
        echo '<li class="style1"><strong>'.$name.$city.'</strong> <em>'.date("Y-m-d",$time).'</em>
              <div class="description">'.$mess.'</div></li>';
        
        if(!empty($answ)) echo '<li class="style2">
              <div class="description">'.$answ.'</div></li>';  
              
         if($i!=$m_count-1) echo '<li>&nbsp;</li>';            
    }
    echo '</ul></div>';
    
    echo $string;   
    
    $stop=1; 
}
//-------------------------------------------------------
if($site->type()=="article" && ($site->current_object->sid=="apic-news" || $site->current_object->sid=="news"))
{
$site->current_object->get_content();
$text=$site->current_object->field["val"][1];

if($action[1]=="firm" && !empty($action[2]))
{
    $sql='select * from firms where cexp_only=0 and id='.addslashes($action[2]);
    $firm=mysql_query($sql);
    $id_firm=mysql_result($firm,0,0);
    
    if(empty($id_firm))
    {
        echo '<h1>Фирма не найдена</h1>';
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
        								<li><a href="/members/action-'.$id_firm.'/#about">О компании</a></li>
        								<li><a href="/members/action-'.$id_firm.'-equipment/">Оборудование</a></li>
        								<li><a href="/members/action-'.$id_firm.'-object/">Объекты</a></li>
        								<li><a href="/members/news/action-firm-'.$id_firm.'/">Новости</a></li>
        								<li><a href="/members/action-'.$id_firm.'/#contacts">Контакты</a></li>
        							</ul>
        						</div>';
    
        echo '<h1>Новости компании '.$name.'</h1>';
        
        $site->current_object->params["search"][6]["fld"]=6;
        $site->current_object->params["search"][6]["gt"]=$action[2]-1;
        $site->current_object->params["search"][6]["lt"]=$action[2]+1;
        
        $site->current_object->get_child_intersect("special",0,"all");
    }
}
else
{
echo '<h1>'.$site->current_object->name.'</h1>';	
echo $textile->TextileThis($text);    
$site->current_object->get_child("normal",0,0);
echo $site->navy_bar;
}

echo '<ul class="marketing-list">';

for($j=0;$j<$site->current_object->childs_count;$j++)
{
	$id_type=$site->current_object->childs_index[$j][0];
	$id=$site->current_object->childs_index[$j][1];
	$obj1=$site->current_object->childs[$id_type][$id];
	

	$obj1->get_content();
	
	$obj1->get_date("text");
	$text=$obj1->field["val"][1];
    $pic=$obj1->field["val"][3];
    if(empty($pic)) $pic="/images/apic_logo_small.png";
    
	echo '<li><div class="visual"><img src="'.$pic.'" width="67" alt="'.strip_tags($obj1->name).'"></div><div class="frame">
          <h2><a href="'.$obj1->get_path().'">'.$obj1->name.'</a></h2>';
    echo '<span class="date-news"><time datetime="01-01">'.$obj1->date_add.'</time></span><div class="description">';          
    if(!empty($text)) echo $textile->TextileThis($text);
    echo '</li>';
}

echo '</ul>';

if($action[1]!="firm" || empty($action[2])) echo $site->navy_bar;

$stop=1;
}
//-------------------------------------------------------
if($site->type()=="article" && ($site->open[0]["sid"]=="news" || $site->open[0]["sid"]=="apic-news") && !$stop)
{
$obj=$site->current_object;
$obj->get_content();
$obj->get_date("text");
$text=$obj->field["val"][2];

echo '<h1>'.$obj->name.'</h1>';	
echo '<span class="date-news">'.$obj->date_add.'</span></div>';
echo $textile->TextileThis($text);	

$stop=1;
}
//-------------------------------------------------------
if($site->type()=="article" && $site->current_object->sid=="object" && $action[1]!="object" && $action[1]!="map" && !$stop)
{
$site->current_object->get_content();
$text=$site->current_object->field["val"][2];

if(!empty($action[1])) $id_so=$action[1];

$sql='select id_so, name from apic_sobj order by name';
$temp=mysql_query($sql);
$temp_rows=mysql_num_rows($temp);
$options="";
$t_name="";

for($i=0;$i<$temp_rows;$i++)
{
    if(!empty($id_so) && ($id_so==mysql_result($temp,$i,0)))
    {
        	$selected=" selected";
        	$t_name=mysql_result($temp,$i,1);
    }
    else $selected="";
    $options.='<option value="'.mysql_result($temp,$i,0).'"'.$selected.'>'.mysql_result($temp,$i,1).'</option>';
}
if($id_so=="all") $t_name="Все объекты";

if(!empty($t_name)) $t_name='- '.$t_name;

if(!strpos($text,'<h1>')) echo '<h1>'.$site->current_object->name.' '.$t_name.'</h1>';

echo '<h3>Поиск компании по типу выполненного объекта (вентиляция, кондиционирование, отопление): </h3>            
        
        <form action="/members/object/" class="content-form" method="post">
							<fieldset>
								<div class="form-frame">
									<div class="col col01">
										<div class="form-row">
											<label class="control-label">Тип здания</label>
											<div class="input-block">
												<select name="id_so" id="id_so"> 
                                                    <option value="">Выбрать</option> 
                                                        '.$options.'                                                                 
                                                    </select>
											</div>
										</div>
                                      </div>
                                      <div class="col col02">
										<div class="form-row">
                                            <a href="/members/object/action-all/">Все объекты</a><br /><a href="/members/object/action-map/">Карта поиска объектов</a>
										</div>
									</div>  
									<div class="btn-holder">
										<button class="btn red-btn"><span class="icon"><img src="/images/srch-ico.png" width="11" height="11" alt="image description"></span>Подобрать</button>
									</div>
								</div>
							</fieldset>
						</form>';

if(empty($id_so)) echo $textile->TextileThis($text);

if(!empty($id_so))
{
    if($id_so!="all") $sql='select distinct apic_obj.id_f,firms.name from apic_obj inner join firms on apic_obj.id_f=firms.id where firms.cexp_only=0 and apic_obj.id_so='.addslashes($id_so).' group by firms.name';
    else $sql='select distinct apic_obj.id_f,firms.name from apic_obj inner join firms on apic_obj.id_f=firms.id where firms.cexp_only=0 group by firms.name';
    $firms=mysql_query($sql);
    $firms_count=mysql_num_rows($firms);
}
if(!empty($id_so) && $firms_count>0)
{
    echo '<ul class="object-list">';
    for($i=0;$i<$firms_count;$i++)
    {
        $sql='select name, postal_address, phone1, pcode1, email, web,logo from firms where id='.mysql_result($firms,$i,0);
        $temp=mysql_query($sql);
        
        $name=mysql_result($temp,0,0);
        $logo=mysql_result($temp,0,6);
        
        echo '<li>';
        if(!empty($logo)) echo '<div class="visual"><img src="/images/flogos/'.$logo.'" width="186" alt="'.$name.'"></div>';
		echo '<div class="frame">
			<div class="holder">
				<div class="text-block">
					<div class="name"><a href="/members/action-'.mysql_result($firms,$i,0).'/">'.$name.'</a></div>
					<div class="text"><p>';
					echo mysql_result($temp,0,1)."<br />";
                    $phone=mysql_result($temp,0,2);
                    $pcod=mysql_result($temp,0,3);
                    if(!empty($phone) && !empty($pcod)) echo "(".$pcod.")".$phone."<br />";
                    $email=mysql_result($temp,0,4);
                    if(!empty($email))
                    {
                    	 hideEmail($email,'class');
                    	 echo "<br>";
                    }
                    $web=mysql_result($temp,0,5);
                    $web = preg_match("/http:\/\//",$web)  ? $web : 'http://'.$web;
                    if(!empty($web)) echo '<a href="'.$web.'" target="_blank">'.$web.'</a>';	
					echo '</p></div>
				</div>
			</div>
			<ul class="link-tools">
				<li><a href="/members/action-'.mysql_result($firms,$i,0).'/">Подробнее о компании</a></li>
				<li><a href="/members/action-'.mysql_result($firms,$i,0).'-equipment/">Полная карточка товаров</a></li>
			</ul>
		</div></li><li>';
        echo '<table><tr class="bbs03"><td><strong>Название объекта</strong></td>';
        echo '<td><strong>Описание</strong></td>';
        echo '<td><strong>Адрес</strong>     </td>';
        echo '</tr>';	
        
        if($id_so!="all") $sql='select id_o, name, addr, short from apic_obj where id_f='.mysql_result($firms,$i,0).' and id_so='.addslashes($id_so).' order by name';
        else $sql='select id_o, name, addr, short,id_so from apic_obj where id_f='.mysql_result($firms,$i,0).' order by name';
        $temp=mysql_query($sql);
        $temp_rows=mysql_num_rows($temp);
        
        for($j=0;$j<$temp_rows;$j++)
        {
         if($id_so!="all") echo '<tr class="bbs03"><td><a href="/members/object/action-object-'.mysql_result($temp,$j,0).'-'.$id_so.'-'.mysql_result($firms,$i,0).'/">'.mysql_result($temp,$j,1).'</a></td>';
         else echo '<tr class="bbs03"><td><a href="/members/object/action-object-'.mysql_result($temp,$j,0).'-'.mysql_result($temp,$j,4).'-'.mysql_result($firms,$i,0).'/">'.mysql_result($temp,$j,1).'</a></td>';
         echo '<td>'.mysql_result($temp,$j,3).'</td>';
         echo '<td>'.mysql_result($temp,$j,2).'</td></tr>';                 		
        }
        echo '</table>'; 
	echo '</li>';                 	
    }  
    echo '</ul>';
}

$stop=1;
}
//-------------------------------------------------------
if($site->type()=="article" && $site->current_object->sid=="object" && $action[1]=="map" && !$stop)
{
echo '<h1>Карта поиска объектов членов АПИК</h1>';

$sql='select id_so, name from apic_sobj order by name';
$temp=mysql_query($sql);
$temp_rows=mysql_num_rows($temp);

for($i=0;$i<$temp_rows;$i++)
{
echo '<h2><a href="/members/object/action-'.mysql_result($temp,$i,0).'/">'.mysql_result($temp,$i,1).'</a></h2>';

$sql='select id_f, id_o, name from apic_obj where id_so='.mysql_result($temp,$i,0);
$tmp=mysql_query($sql);
$tmp_rows=mysql_num_rows($tmp);

if($tmp_rows>0)
{
 echo '<ul>';
 for($j=0;$j<$tmp_rows;$j++)
 	echo '<li><a href="/members/object/action-object-'.mysql_result($tmp,$j,1).'-'.mysql_result($temp,$i,0).'-'.mysql_result($tmp,$j,0).'/">'.mysql_result($tmp,$j,2).'</a></li>';
 echo '</ul>'; 
}
}

$stop=1;
}
//-------------------------------------------------------
if($site->type()=="article" && $site->current_object->sid=="object" && $action[1]=="object" && !empty($action[2]) && !empty($action[3]) && !empty($action[4]) && !$stop)
{
$id_o=$action[2];
$id_so=$action[3];    
$id_f=$action[4];
    
$sql='select name from apic_sobj where id_so='.addslashes($id_so);
$temp=mysql_query($sql);
$sect_name=mysql_result($temp,0,0);

$sql='select name, logo from firms where id='.addslashes($id_f);
$temp=mysql_query($sql);
$firm_name=mysql_result($temp,0,0);
$firm_logo=mysql_result($temp,0,1);

$sql='select * from apic_obj where id_so='.addslashes($id_so).' and id_f='.addslashes($id_f).' and id_o='.addslashes($id_o);
$temp=mysql_query($sql);	 

$name=mysql_result($temp,0,3);
$addr=mysql_result($temp,0,4);
$short=mysql_result($temp,0,5);
$special=mysql_result($temp,0,6);
$basic=mysql_result($temp,0,7);
$schema=mysql_result($temp,0,8);
$expert=mysql_result($temp,0,9);
$img1=mysql_result($temp,0,10);
$img2=mysql_result($temp,0,11);
$img3=mysql_result($temp,0,12);
$img4=mysql_result($temp,0,13);
$img5=mysql_result($temp,0,14);
$additional=mysql_result($temp,0,15);


$title="Объекты членов  АПИК";
if(!empty($sect_name)) $title.='<br />'.$sect_name;
if(!empty($name)) $title.='<br />'.$name;

echo '<h1>'.$title.'</h1>';

echo '<p><h3>Тип объекта:</h3><a href="/members/object/action-'.$id_so.'/" target="_blank">'.$sect_name. '</a></p>
<p><h3>Компания:</h3><strong>'.$firm_name.'</strong>';
if(!empty($firm_logo)) echo '<br /><img src="/images/flogos/'.$firm_logo.'" /></p>';
if(!empty($name)) echo '<p><h3>Название объекта:</h3>'.$name.'</p>';
if(!empty($adr)) echo '<p><h3>Адрес объекта:</h3>'.$addr.'</p>';
if(!empty($short)) echo '<p><h3>Выполненная задача - кратко:</h3>'.$short.'</p>';

if(!empty($special)) echo '<p><h3>Особенности объекта:</h3>'.$special.'</p>';

if(!empty($img1) || !empty($img2) || !empty($img3) || !empty($img4) || !empty($img5)) 
{
echo '<h3>Фото объекта и установленного оборудования:</h3>';
if(!empty($img1)) echo '<img src="/object/images/'.$img1.'" /><br /><br />';
if(!empty($img2)) echo '<img src="/object/images/'.$img2.'" /><br /><br />';
if(!empty($img3)) echo '<img src="/object/images/'.$img3.'" /><br /><br />';
if(!empty($img4)) echo '<img src="/object/images/'.$img4.'" /><br /><br />';
if(!empty($img5)) echo '<img src="/object/images/'.$img5.'" /><br /><br />';
}


if(!empty($basic)) echo '<p><h3>Основные показатели объекта:</h3>'.$basic.' </p>';
if(!empty($schema))  echo '<p><h3>Принципиальная схема:</h3><a href="/object/images/'.$schema.'" target="_blank"><img src="/object/images_small/'.$schema.'" /></a></p>';
if(!empty($expert))  echo '<p><h3>Экспертное заключение или отзывы об объекте:</h3>'.$expert.'</p>';

$stop=1;
}
//-------------------------------------------------------
if($site->type()=="article" && $site->current_object->sid=="members" && empty($action[1]) && !$stop)
{
$site->current_object->get_content();
$text=$site->current_object->field["val"][2];

if(!strpos($text,'<h1>')) echo '<h1>'.$site->current_object->name.'</h1>';
echo $textile->TextileThis($text);

$sql='select id,name from firms where cexp_only=0 order by name';
$firms=mysql_query($sql);
$firms_count=mysql_num_rows($firms);

echo '<table>';
for($i=0;$i<$firms_count;$i++)
{
    echo '<tr>';
    
    $id_firm=mysql_result($firms,$i,0);
    $name=mysql_result($firms,$i,1);
    
    echo '<td><a href="/members/action-'.$id_firm.'/"><img src="/images/bul_4.gif" alt="Подробнее о компании '.$name.'" /></td><td><a href="/members/action-'.$id_firm.'/">'.$name.'</a></td>';
    
    echo '</tr>';    
}          
echo '</table>';

$stop=1;
}
//-------------------------------------------------------
if($site->type()=="article" && $site->current_object->sid=="members" && !empty($action[1]) && !$stop)
{
$sql='select * from firms where cexp_only=0 and id='.addslashes($action[1]);
$firm=mysql_query($sql);
$id_firm=mysql_result($firm,0,0);

if(empty($id_firm))
{
    echo '<h1>Фирма не найдена</h1>';
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
    								<li><a href="/members/action-'.$id_firm.'/#about">О компании</a></li>
    								<li><a href="/members/action-'.$id_firm.'-equipment/">Оборудование</a></li>
    								<li><a href="/members/action-'.$id_firm.'-object/">Объекты</a></li>
    								<li><a href="/members/news/action-firm-'.$id_firm.'/">Новости</a></li>
    								<li><a href="/members/action-'.$id_firm.'/#contacts">Контакты</a></li>
    							</ul>
    						</div>';
    
    if($action[2]=="equipment")
    {
        echo '<h1>'.$name.'. Полная карточка товаров</h1>';
        
        $sql="select id_s,name from apic_section where parent=0 order by id_s";
        $tmp=mysql_query($sql);
        $tmp_rows=mysql_num_rows($tmp);
        
        $count=0;
        $max=0;
        
        for($i=0;$i<$tmp_rows;$i++)
        {
         $sum=0;	
        	
         $sql="select id_s,name from apic_section where parent=".mysql_result($tmp,$i,0)." order by id_s";
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
    elseif($action[2]=="object")
    {
        echo '<h1>'.$name.'. Объекты</h1>';
        
        echo '<table>';
        echo '<tr class="bbs03"><td><strong>Название объекта</strong></td>';
        echo '<td><strong>Описание</strong></td>';
        echo '<td><strong>Адрес</strong>     </td>';
        echo '</tr>';	
        
        $sql='select id_o, name, addr, short,id_so from apic_obj where id_f='.addslashes($id_firm).' order by name';
        $temp=mysql_query($sql);
        $temp_rows=mysql_num_rows($temp);
        
        for($j=0;$j<$temp_rows;$j++)
        {
         echo '<tr class="bbs03"><td><a href="/members/object/action-object-'.mysql_result($temp,$j,0).'-'.mysql_result($temp,$j,4).'-'.$id_firm.'/">'.mysql_result($temp,$j,1).'</a></td>';
         echo '<td>'.mysql_result($temp,$j,3).'</td>';
         echo '<td>'.mysql_result($temp,$j,2).'</td></tr>';                 		
        }
        echo '</table>'; 
        
    }
    else
    {
        echo '<h1 id="about">'.$name.'</h1>';
        
        if(!empty($equip))
        {
            echo '<h2>Оборудование</h2>';
            echo $textile->TextileThis($equip);
        }
        if(!empty($serv))
        {
            echo '<h2>Услуги</h2>';
            echo $textile->TextileThis($serv);
        }
        if(!empty($info))
        {
            echo '<h2>Дополнительная информация</h2>';
            echo $textile->TextileThis($info);
        }
        
        echo '<h2 id="contacts">'.$name.'. Контактная информация</h2>';
        
        if(!empty($adr)) echo '<p><strong>Адрес: </strong>'.$adr.'</p>';
        if(!empty($phone)) echo '<p><strong>Телефон: </strong>'.$phone.'</p>';
        if(!empty($phone2)) echo '<p><strong>Телефон: </strong>'.$phone2.'</p>';
        if(!empty($fax)) echo '<p><strong>Факс: </strong>'.$fax.'</p>';
        if(!empty($mail)) echo '<p><strong>E-mail: </strong><a href="mailto:'.$mail.'">'.$mail.'</a></p>';
        if(!empty($web)) echo '<p><strong>Сайт: </strong><noindex><a href="'.$web.'" target="_blank" rel="nofollow">'.$web.'</a></noindex></p>';
        
        if(!empty($deal))
        {
            echo '<h2>Дилеры</h2>';
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

if(strpos($text,'<h1>')===false) echo '<h1>'.$site->current_object->name.'</h1>';

/*if($site->current_object->sid=="buy")
{
    
}*/


echo $textile->TextileThis($text);

    if($site->current_object->sid!="buy" && $site->current_object->sid!="logistics" && $site->current_object->sid!="legalservice" && $site->current_object->sid!="geograph")
    {
        $site->current_object->get_child("normal",0,0);
        
        echo $site->navy_bar;
        
        

        for($j=0;$j<$site->current_object->childs_count;$j++)
        {
        	$id_type=$site->current_object->childs_index[$j][0];
        	$id=$site->current_object->childs_index[$j][1];
        	$obj1=$site->current_object->childs[$id_type][$id];
        	
        
        	$obj1->get_content();
        	
        	$obj1->get_date("text");
        	$text=$obj1->field["val"][1];
            $pic=$obj1->field["val"][3];
            //if(empty($pic)) $pic="/images/apic_logo_small.png";
            
            if(!empty($pic)) echo '<ul class="marketing-list"><li>';
        	
            if(!empty($pic)) echo '<div class="visual"><img src="'.$pic.'" width="67" alt="'.strip_tags($obj1->name).'"></div>';
            
            echo '<div class="frame">
                  <h2><a href="'.$obj1->get_path().'">'.$obj1->name.'</a></h2>';
            echo '<div class="description">';          
            if(!empty($text)) echo $textile->TextileThis($text);
            echo '</div>';
            if(!empty($pic)) echo '</li></ul>';
        }
        
        
        
        /*for($j=0;$j<$site->current_object->childs_count;$j++)
        {
        	$id_type=$site->current_object->childs_index[$j][0];
        	$id=$site->current_object->childs_index[$j][1];
        	$obj1=$site->current_object->childs[$id_type][$id];
        	
        
        	$obj1->get_content();
        	
        	$obj1->get_date();
        	
        	$text=$obj1->field["val"][1];
        	echo '<h2><a href="'.$obj1->get_path().'">'.$obj1->name.'</a></h2>';
        	if(!empty($text) && !empty($obj1->field["val"][2])) echo $textile->TextileThis($text.' <a href="'.$obj1->get_path().'">Подробнее</a>');
        	else echo $textile->TextileThis($text);
        }*/
        
        echo $site->navy_bar;
    }
    
    if($site->current_object->sid=="geograph")
    {
        $site->current_object->get_child("special",0,"all");
        
        echo '<ul>';

        for($j=0;$j<$site->current_object->childs_count;$j++)
        {
        	$id_type=$site->current_object->childs_index[$j][0];
        	$id=$site->current_object->childs_index[$j][1];
        	$obj1=$site->current_object->childs[$id_type][$id];
            
            echo '<li><a href="'.$obj1->get_path().'">'.$obj1->name.'</a></li>';
        }  
        echo '</ul>';  
    }
    
}
//-------------------------------------------------------
?>