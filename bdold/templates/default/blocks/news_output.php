

	<?php
	$result = $mysqli->query( "SELECT COUNT(id) AS count FROM `news` WHERE `user_tip`='$user_tip'" );
                
        if (isset($_GET['vyvesti']) && $_GET['vyvesti']!=''){
                if ($_GET['vyvesti']=='all'){
                        $vyvesti="all";
                        $toBd = "";
                }else{
                        $vyvesti=htmlentities($_GET['vyvesti']);
                        $toBd = "`user_tip`='$vyvesti' and";
                }
                if($_GET['offer_vivod'] != 0){
                    $offer_vivod = intval($_GET['offer_vivod']);
                }else{
                    $offer_vivod = 0;
                }   
                $result = $mysqli->query( "SELECT COUNT(id) AS count FROM `news` WHERE $toBd offer_id = '$offer_vivod'" );
        }else{
                $vyvesti="all";
                $offer_vivod = 0;
                $result = $mysqli->query( "SELECT COUNT(id) AS count FROM `news`" );
        }
                
        function build_pagination_url( $page ){
		$parameters = array('page' => $page);
		return '?'.http_build_query($parameters);
        } 

        function monthToRU($month){
            $arr = array(
                'Jan' => 'Янв',
                'Feb' => 'Фев',
                'Mar' => 'Мар',
                'Apr' => 'Апр',
                'May' => 'Мая',
                'Jun' => 'Июн',
                'Jul' => 'Июл',
                'Aug' => 'Авг',
                'Sep' => 'Сен',
                'Oct' => 'Окт',
                'Nov' => 'Ноя',
                'Dec' => 'Дек'
            );
            return $arr[$month];
        }
        
        $show_pages = 5;
        $this_page = ( isset($_GET['page']) && !empty($_GET['page']) ) ? filter_var($_GET['page'], FILTER_SANITIZE_NUMBER_INT) : 1;
        
        $offset = ( $show_pages * $this_page ) - $show_pages;
        
        
	if (isset($offset) && isset($show_pages)){
		$sql = "SELECT UNIX_TIMESTAMP(date) as date,news_zagolovok,news,id,image FROM news WHERE `user_tip`='$user_tip' ORDER BY `id` DESC LIMIT $offset, $show_pages";
		$result = $mysqli->query($sql);
		if (mysqli_num_rows($result)>0) 
			{
			while($res=mysqli_fetch_array($result)) 
				{
				// Определяем текстовое название роли
				// Define a text title role
				$sql_textrole = "SELECT title FROM users_roles_tpl WHERE `tip`='$user_tip'";		
				$result_textrole = $mysqli->query($sql_textrole);
				$res_textrole=mysqli_fetch_array($result_textrole);
				$role_title=htmlentities($res_textrole['title']);
				$news_id=htmlentities($res['id']);
				$news_date=$res['date'];                               
				$news_zagolovok=htmlentities($res['news_zagolovok']);
				$news=html_entity_decode($res['news']);
                                
				?>
				<div class="col-12 mb-40 news-block">
                                    
                                    <?php
                                    if(isset($res['image']) && $res['image'] != ''){
                                        $image=$res['image'];
                                    ?>    
                                        <div class="row">

                                            <div class="col-auto">
                                                <img src="./tmp/news/<?=$image; ?>" class="img-fluid">
                                                
                                            </div>

                                            <div class="col">
                                                <p class="title-news"><?php echo html_entity_decode($news_zagolovok, ENT_QUOTES, 'utf-8'); ?></p>

                                                <p class="text-news">
                                                    <?php echo html_entity_decode($news, ENT_QUOTES, 'utf-8'); ?>
                                                </p>
                                            </div>
                                            
                                        </div>
                                        <p class="date-news">Дата публикации: <?php echo date('d.m.Y',$news_date); ?></p>
                                    <?php    
                                    }else{
                                    ?>
                                        <p class="title-news"><?php echo html_entity_decode($news_zagolovok, ENT_QUOTES, 'utf-8'); ?></p>

                                        <p class="text-news">
                                            <?php echo html_entity_decode($news, ENT_QUOTES, 'utf-8'); ?>
                                        </p>

                                        <p class="date-news">Дата публикации: <?php echo date('d.m.Y',$news_date); ?></p>
                                    <?php
                                    }
                                    ?>

				</div>
				<?php
				}
			} 
	}

	$result = $mysqli->query( "SELECT COUNT(id) AS count FROM `news` WHERE `user_tip`='$user_tip'" );

	?>


    <div class="col-12 mt-30 mb-20">
        <?php pagination($result,5,11); ?>
    </div>