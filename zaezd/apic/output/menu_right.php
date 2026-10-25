<aside id="sidebar">
<?php
    $skip=array('news','apic-news');    

	$part=$site->current_part;
    
    if($part->sid=="en")
    {
		$object_params["id_part"]=$part->id;
		$object_params["id_type"]=$site->open[1]["type"];
		$object_params["id"]=$site->open[1]["id"];
		$object_params["active"]=1;
    }
    else
    {
        $object_params["id_part"]=$part->id;
		$object_params["id_type"]=$site->open[0]["type"];
		$object_params["id"]=$site->open[0]["id"];
		$object_params["active"]=1;
    }

	$obj=new object($object_params,1);
	$obj->get_child("special",0,"all");
		
	if($obj->childs_count>0)
	{
	   echo '<div class="side-block"><ul class="side-menu">';
		for($j=0;$j<$obj->childs_count;$j++)
		{
			$id_type=$obj->childs_index[$j][0];
			$id=$obj->childs_index[$j][1];
			$obj1=$obj->childs[$id_type][$id];
            
            if($obj1->idx>100) continue;
            
            if(!in_array($obj1->sid,$skip)) $obj1->get_child("special",0,"all");
            
            if($obj1->childs_count>0)
        	{
        	   if($part->sid=="en" && $site->open[2]["sid"]==$obj1->sid) $class=' class="hasdrop active"';
               elseif($part->sid=="main" && $site->open[1]["sid"]==$obj1->sid) $class=' class="hasdrop active"';
               else unset($class);
               
        	   echo '<li'.$class.'><a href="'.$obj1->get_path().'">'.$obj1->name.'</a>';
        	   echo '<ul class="submenu">';
        		for($k=0;$k<$obj1->childs_count;$k++)
        		{
        			$id_type=$obj1->childs_index[$k][0];
        			$id=$obj1->childs_index[$k][1];
        			$obj2=$obj1->childs[$id_type][$id];
                          
                    if($part->sid=="en" && $site->open[3]["sid"]==$obj2->sid) $class=' class="active"';
                    elseif($part->sid=="main" && $site->open[2]["sid"]==$obj2->sid) $class=' class="active"';
                    else unset($class);
                    
                    echo '<li'.$class.'><a href="'.$obj2->get_path().'">'.$obj2->name.'</a></li>';
        		}
                echo '</ul>';        		
        	}
            elseif(($part->sid=="en" && $site->open[2]["sid"]==$obj1->sid) || ($part->sid=="main" && $site->open[1]["sid"]==$obj1->sid)) echo '<li class="hasdrop"><a href="'.$obj1->get_path().'">'.$obj1->name.'</a>';
            else echo '<li><a href="'.$obj1->get_path().'">'.$obj1->name.'</a>';
            
            echo '</li>';
		}
        echo '</ul></div>';
		
	}
?>
                            
					<!--	<div class="side-block">
							<ul class="side-menu">
								<li class="hasdrop"><a href="#">АПИК для кдиматических компаний</a>
									<ul class="submenu">
										<li><a href="#">Кондиционеры бытовые (настенные, оконные, мобильные, моноблоки)</a></li>
										<li><a href="#">Кондиционеры полупромышленные (кассетные, потолочные, канальные, колонные)</a></li>
									</ul>
								</li>
								<li><a href="#">Обучение сотрудников</a></li>
								<li><a href="#">Заявка на выставку Мир Климата 2016</a></li>
								<li><a href="#">Проверка заявленных технических возможностей</a></li>
								<li><a href="#">Сертификация оборудования</a></li>
								<li><a href="#">Консалтинг АПИК импортозамещение это так</a></li>
							</ul>
						</div> -->
<?php
if($part->sid=="en") include($inc_path."banners/config/en_right.php");
else include($inc_path."banners/config/ru_right.php");
?>                         
					<!--	<div class="side-block">
							<ul class="side-menu">
								<li class="hasdrop"><a href="#">Маркетинговые и рекламные возможности АПИК</a>
									<ul class="submenu">
										<li><a href="#">Кондиционеры бытовые (настенные, оконные, мобильные, моноблоки)</a></li>
										<li><a href="#">Кондиционеры полупромышленные (кассетные, потолочные, канальные, колонные)</a></li>
									</ul>
								</li>
								<li><a href="#">Интернет реклама на климатических ресурсах</a></li>
								<li><a href="#">Реклама на выставке Мир Климата</a></li>
								<li><a href="#">Реклама в рассылке АПИК</a></li>
							</ul>
						</div> -->
					</aside>