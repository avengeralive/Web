<div class="row cabinet main mt-50 mb-50">

    <div class="col-12 mb-10"><p class="pageTitle mb-25"><?php echo $loc['news.php']['t02']; ?></p></div>

    
<?php 
// Обработка ситуации, когда новость вызвана на редактирование
// Handle the situation, when the news due to editing
if (isset($_GET['edit']) && $_GET['edit']!='')
	{
	$news_id=htmlentities($_GET['edit']);
	// Если новость действительно есть в базе, то выводим ее на редактирование
	// If the news really is in the database, then displays it on the edit
	$sql_news= "SELECT id,DATE_FORMAT(date, '%d.%m.%Y / %H:%i:%s') as date,user_tip,news_zagolovok,news,image,public_news FROM news WHERE `id`='$news_id'";		
	$result_news = $mysqli->query($sql_news);
	if (mysqli_num_rows($result_news)>0) 
		{
		$res_news=mysqli_fetch_array($result_news);
		$news_user_tip=htmlentities($res_news['user_tip']);
		$news_date=htmlentities($res_news['date']);
		$news_zagolovok=htmlentities($res_news['news_zagolovok']);
		$news=html_entity_decode($res_news['news']);
                $image_news=html_entity_decode($res_news['image']);
		$public_news=htmlentities($res_news['public_news']);
                $offer_news=htmlentities($res_news['offer_id']);
		// Выводим форму добавления новостей
		// Display the form of adding news
        ?>       
	<div class="col-10 mb-50">
        <div class="card" style="min-height: auto;">
        <div class="card-body">
		<?php
		// Выводим форму добавления новостей
		// Display the form of adding news
		include './templates/'.$template.'/blocks/edit_news_form.php';
		?>
	</div>
	</div>
        </div>
        <?php        
		}
	}
else
	{
	?>
		<?php
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
                    global $vyvesti,$offer_vivod;
                    return '?' . http_build_query( $parameters ).'&vyvesti='.$vyvesti.'&offer_vivod='.$offer_vivod;
		}		
		?>
	
	<div class="col-10 mb-50">
        <div class="card" style="min-height: auto;">
        <div class="card-body">
		<?php
		// Выводим форму добавления новостей
		// Display the form of adding news
		include './templates/'.$template.'/blocks/add_news_form.php';
		?>
	</div>
	</div>
        </div>

	
	<div class="col-12 mb-10">
            <div class="card" style="min-height: auto;">
            <div class="card-body">
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" id="vivod_news" method="get">
		<b><?php echo $loc['news.php']['t03']; ?>&nbsp;</b>
		<select name="vyvesti" onchange="this.form.submit();">
			<?php
			// Вывести только те роли, которые активны на данный момент
			// Display only those roles that are active at the moment
			$sql_rolespisok = "SELECT * FROM users_roles_tpl WHERE `active`='1'";		
			$result_rolespisok = $mysqli->query($sql_rolespisok);
			if (mysqli_num_rows($result_rolespisok)>0) 
				{
				while($res_rolespisok=mysqli_fetch_array($result_rolespisok)) 
					{
					$role_tip=htmlentities($res_rolespisok['tip']);
					$role_title=htmlentities($res_rolespisok['title']);
					?>
					<option value="<?php echo $role_tip; ?>" <?php if (!isset($vyvesti) || $vyvesti=='') {$vyvesti=$user_tip;} if ($role_tip==$vyvesti) {echo 'selected="selected"';} ?>><?php echo $role_title; ?></option>
					<?php
					}
				}
			?>
			<option value="all" <?php if (!isset($vyvesti) || $vyvesti=='') {$vyvesti=$user_tip;} if ($vyvesti=='all') {echo 'selected="selected"';} ?>><?php echo $loc['news.php']['t04']; ?></option>
		</select>
                <br><br>
                <b>Оффер:&nbsp;</b>
                <select name="offer_vivod" onchange="this.form.submit();">
                    <option <?php if (!isset($offer_vivod) || $offer_vivod==0){echo 'selected="selected"';} ?> value="0">Все</option>
                <?php
                $list = array();
                $db = DB::getInstance();                                        
                $sql = "select id,name from offers";
                $stmt = $db->prepare($sql);
                $stmt->execute();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                    <option <?php if ($offer_vivod!=0 && $offer_vivod == $row['id']){echo 'selected="selected"';} ?> value="<?=$row['id'];?>"><?=$row['name'];?></option>
                <?php
                }

                ?>
                </select>      
                
		</form>
        </div>
        </div>        
	</div>
	
	<div class="col-12 mb-10">
		<?php
		// Вывод количества страниц
		// Display the number of pages
		pagination($result,10,11);
		?>
	</div>
	
	
		<?php
		if (isset($offset) && isset($show_pages))
			{
			if (!isset($vyvesti) || $vyvesti=='') {$vyvesti=$user_tip;}
			if ($vyvesti=='all'){  
                            if($offer_vivod == 0){
                            $sql = "SELECT DATE_FORMAT(date, '%d.%m.%Y / %H:%i:%s') as date,news_zagolovok,news,id,user_tip,public_news,offer_id FROM news ORDER BY `id` DESC LIMIT $offset, $show_pages";
                            }else{
                            $sql = "SELECT DATE_FORMAT(date, '%d.%m.%Y / %H:%i:%s') as date,news_zagolovok,news,id,user_tip,public_news,offer_id FROM news WHERE `offer_id`='$offer_vivod' ORDER BY `id` DESC LIMIT $offset, $show_pages";                                
                            }
                            
                        }else{
                            if($offer_vivod == 0){
                            $sql = "SELECT DATE_FORMAT(date, '%d.%m.%Y / %H:%i:%s') as date,news_zagolovok,news,id,public_news,offer_id  FROM news WHERE `user_tip`='$vyvesti' ORDER BY `id` DESC LIMIT $offset, $show_pages";     
                            }else{
                            $sql = "SELECT DATE_FORMAT(date, '%d.%m.%Y / %H:%i:%s') as date,news_zagolovok,news,id,public_news,offer_id  FROM news WHERE `user_tip`='$vyvesti' AND `offer_id`='$offer_vivod' ORDER BY `id` DESC LIMIT $offset, $show_pages";                                     
                            }                            
                        }
			$result = $mysqli->query($sql);
			if (mysqli_num_rows($result)>0) 
				{
				while($res=mysqli_fetch_array($result)) 
					{
					?>
					<div style="height: 20px;"></div>
					<?php
					// Определяем текстовое название роли
					// Define a text title role
					if (!isset($vyvesti) || $vyvesti=='') {$vyvesti=$user_tip;}
					if ($vyvesti=='all') 
						{
						$uznat_rol=htmlentities($res['user_tip']);
						$sql_textrole = "SELECT title FROM users_roles_tpl WHERE `tip`='$uznat_rol'";		
						}
					else
						{
						$sql_textrole = "SELECT title FROM users_roles_tpl WHERE `tip`='$vyvesti'";		
						}
					$result_textrole = $mysqli->query($sql_textrole);
					$res_textrole=mysqli_fetch_array($result_textrole);
					$role_title=htmlentities($res_textrole['title']);
					$news_id=htmlentities($res['id']);
					$news_date=htmlentities($res['date']);
					$news_zagolovok=htmlentities($res['news_zagolovok']);
					$news=html_entity_decode($res['news']);
					$public_news=htmlentities($res['public_news']);
                                        $offer_id = $res['offer_id'];
                                        if($offer_id != 0){
                                            $sql_name_offer = "SELECT name FROM offers WHERE `id`='$offer_id'";
                                            $result_name_offer = $mysqli->query($sql_name_offer);
                                            $res_name_offer=mysqli_fetch_array($result_name_offer);
                                            $offer = $res_name_offer['name'];
                                        }else{
                                            $offer = 'Все';
                                        }
					?>
                                        <div class="col-12 mb-10">
                                        <div class="card" style="min-height: auto;">
                                        <div class="card-body">
                                        
					<table class="newsone_table">
						<tr>
							<td>
								<?php 
								echo $news_date;
								if ($public_news=='1')
									{
									echo '&nbsp; <font style="background: yellow;">'.$loc['news.php']['t05'].'</font>';
									}
								echo '&nbsp;&nbsp;<b>'.$loc['news.php']['t06'].'</b>&nbsp;'.$role_title;
                                                                echo '&nbsp;&nbsp;&nbsp;<b>Оффер:</b> '.$offer;
								echo '<br /><b>'.html_entity_decode($news_zagolovok, ENT_QUOTES, 'utf-8').'</b>'; 
								?>
							</td>
						</tr>
						<tr>
							<td style="padding-top: 8px;">
								<?php echo html_entity_decode($news, ENT_QUOTES, 'utf-8'); ?>
								<div align="right"><a href="./news.php?edit=<?php echo $news_id; ?>"><?php echo $loc['news.php']['t07']; ?></a> | <a href="./news.php?del=<?php echo $news_id; ?>" onclick="if (!confirm('<?php echo $loc['news.php']['t08']; ?>'))return false;"><?php echo $loc['news.php']['t09']; ?></a></div>
							</td>
						</tr>
					</table>
                                        </div>
                                        </div>   
                                        </div>    
					<?php
					}
				}
			}
		?>
	
		
	<div class="col-12 mb-10">
		<?php
		// Вывод количества страниц
		// Display the number of pages
		pagination($pagination_fetched_row,10,11);
		?>
	</div>
	
	
	<?php
	}
?>

</div>