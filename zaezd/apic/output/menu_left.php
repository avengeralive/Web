<aside id="sidebar">
						<div class="side-block">
							<ul class="side-menu">
								<li class="hasdrop active"><a href="#">Кондиционеры</a>
									<ul class="submenu">
										<li><a href="#">Кондиционеры бытовые (настенные, оконные, мобильные, моноблоки)</a></li>
										<li><a href="#">Кондиционеры полупромышленные (кассетные, потолочные, канальные, колонные)</a></li>
									</ul>
								</li>
								<li><a href="#">Вентиляция и вентиляторы</a></li>
								<li><a href="#">Обогреватели</a></li>
								<li><a href="#">Центральное кондиционирование</a></li>
								<li><a href="#">Увлажнение, ионизация и очистка воздуха</a></li>
								<li><a href="#">Расходные материалы</a></li>
								<li><a href="#">Отопление и водоснабжение</a></li>
							</ul>
						</div>
						<div class="side-block">
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
						</div>
						<div class="side-ads">
							<a href="#"><img src="images/ads03.png" width="300" height="300" alt="image description"></a>
						</div>
						<div class="side-block">
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
						</div>
					</aside>
                    
<?php
/*	$part=$site->current_part;
	
	$obj=$part;
	
	$obj->get_path();
	$obj->get_child("special",0,"all");
		
	if($obj->childs_count>0)
	{
		for($j=0;$j<$obj->childs_count;$j++)
		{
			$id_type=$obj->childs_index[$j][0];
			$id=$obj->childs_index[$j][1];
			$obj1=$obj->childs[$id_type][$id];
            
            if($obj1->idx>99) continue;
            
            if($obj1->sid!="news" && $obj1->sid!="events" && $obj1->sid!="news_en" && $obj1->sid!="events_en") $obj1->get_child("special",0,"all");
            
            if($obj1->childs_count>0)
        	{
        	   if($part->sid=="eng" && $site->open[1]["sid"]==$obj1->sid) $class=' class="open"';
               elseif($part->sid=="main" && $site->open[0]["sid"]==$obj1->sid) $class=' class="open"';
               else unset($class);
               
        	   echo '<li'.$class.'><a class="title" href="'.$obj1->get_path().'">'.$obj1->name.'</a>';
        	   echo '<div class="drop"><ul>';
        		for($k=0;$k<$obj1->childs_count;$k++)
        		{
        			$id_type=$obj1->childs_index[$k][0];
        			$id=$obj1->childs_index[$k][1];
        			$obj2=$obj1->childs[$id_type][$id];
                          
                    $obj2->get_child("special",0,"all");
                    if($obj2->childs_count>0)
                	{
                	   if($part->sid=="eng" && $site->open[2]["sid"]==$obj1->sid) $class=' class="open"';
                       elseif($part->sid=="main" && $site->open[1]["sid"]==$obj1->sid) $class=' class="open"';
                       else unset($class);
                	   echo '<li'.$class.'><a class="title" href="'.$obj2->get_path().'">'.$obj2->name.'</a>';
                	   echo '<div class="drop"><ul>';
                		for($l=0;$l<$obj2->childs_count;$l++)
                		{
                			$id_type=$obj2->childs_index[$l][0];
                			$id=$obj2->childs_index[$l][1];
                			$obj3=$obj2->childs[$id_type][$id];
                                  
                            echo '<li><a href="'.$obj3->get_path().'">'.$obj3->name.'</a>';
                            echo '</li>';
                		}
                        echo '</ul></div>';        		
                	}
                    else echo '<li><a href="'.$obj2->get_path().'">'.$obj2->name.'</a>';
                    echo '</li>';
        		}
                echo '</ul></div>';        		
        	}
            else echo '<li><a href="'.$obj1->get_path().'">'.$obj1->name.'</a>';
            
            echo '</li>';
		}
		
	}*/
?>