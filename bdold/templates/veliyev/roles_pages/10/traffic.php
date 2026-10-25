
<h1><?php echo $loc['traffic.php']['t01']; ?></h1>

<?php
// Если не переданы переменные (критерий поиска и поисковый запрос), то делать вывод по умолчанию
// If the variable (the search criteria and search query) is not transferred, then do the default conclusion
if (!isset($_GET['search_type']) && !isset($_GET['search_zapros']))	
	{
	$default_view="1";
	$result = $mysqli->query( "SELECT COUNT(id) AS count FROM `clients_log` WHERE `user_id`='$user_id'" );
	} 
else 
	{
	$default_view="0"; 
	$search_type=htmlentities($_GET['search_type']); 
	$search_zapros=htmlentities($_GET['search_zapros']);
	if ($search_type=='3')
		{
		$result = $mysqli->query( "SELECT COUNT(id) AS count FROM `clients_log` WHERE `ip` = '$search_zapros' AND `user_id`='$user_id'" );
		}		
	elseif ($search_type=='4')
		{
		$sql33 = "SELECT id FROM offers WHERE `name` LIKE '%$search_zapros%'";
		$q33 = $mysqli -> query($sql33);
		$res33=mysqli_fetch_array($q33);			
		$search_zapros=htmlentities($res33['id']);
		$result = $mysqli->query("SELECT COUNT(id) AS count FROM `clients_log` WHERE `offer_id` = '$search_zapros' AND `user_id`='$user_id'");
		}		
	elseif ($search_type=='0')
		{
		$result = $mysqli->query("SELECT COUNT(id) AS count FROM `clients_log` WHERE `user_id`='$user_id'");
		}
	}
?>

<p>
	<form name="user_poisk" class="report" method="get" action="./traffic.php">
		<p>
			<b><?php echo $loc['traffic.php']['t02']; ?>&nbsp;</b>
			<select name="search_type">
				<option class="options" value="0" <?php if (isset($_GET['search_type']) && $_GET['search_type']=='0') {echo 'selected="selected"';} ?>><?php echo $loc['traffic.php']['t04']; ?></option>
				<option class="options" value="3" <?php if (isset($_GET['search_type']) && $_GET['search_type']=='3') {echo 'selected="selected"';} ?>><?php echo $loc['traffic.php']['t05']; ?></option>
				<option class="options" value="4" <?php if (isset($_GET['search_type']) && $_GET['search_type']=='4') {echo 'selected="selected"';} ?>><?php echo $loc['traffic.php']['t06']; ?></option>
			</select>
		</p>
		<p>
			<b><?php echo $loc['traffic.php']['t03']; ?>&nbsp;</b>
			<input type="text" name="search_zapros" class="search_pole" value="<? if (isset($_GET['search_zapros'])) {echo htmlentities($_GET['search_zapros']);} ?>" maxlength="100" />
		</p>
		<p>
			<b>&nbsp;</b><input type="hidden" name="add"><input name="submit_search" value="<?php echo $loc['button']['t02']; ?>" class="others_button_vyvesti" type="submit">
		</p>
		<input type="hidden" name="traf_info">
	</form>
</p>

<p>
	<?php
	function build_pagination_url( $page ) 
		{
		$parameters = array
			(
			'traf_info' => '',
			'search_type' => ( isset($_GET['search_type']) ) ? $_GET['search_type'] : '0',
			'search_zapros' => ( isset($_GET['search_zapros'] ) ) ? $_GET['search_zapros'] : '',
			'page' => $page
			);
		return '?' . http_build_query( $parameters );
		}
	// Вывод количества страниц
	// Display the number of pages
	pagination($result,100,11);
	?>
</p>

<div class="horizontal_scroll">
<p>
	<table class="stats_table" style="width: 100%;">
		<tr class="table_zagolovki">
			<td colspan="20"><?php echo $loc['traffic.php']['t07']; ?></td>
		</tr>
		<tr class="row_title">
			<td><b><nobr><?php echo $loc['traffic.php']['t08']; ?></nobr></b></td>
			<td><b><nobr><?php echo $loc['traffic.php']['t09']; ?></nobr></b></td>
			<td><b><nobr><?php echo $loc['traffic.php']['t10']; ?></nobr></b></td>
			<td><b><nobr><?php echo $loc['traffic.php']['t11']; ?></nobr></b></td>
			<td><b><nobr><?php echo $loc['traffic.php']['t12']; ?></nobr></b></td>
			<td><b><nobr><?php echo $loc['traffic.php']['t13']; ?></nobr></b></td>
			<td><b><nobr><?php echo $loc['traffic.php']['t14']; ?></nobr></b></td>					
			<td><b><nobr><?php echo $loc['traffic.php']['t15']; ?></nobr></b></td>
			<td><b><nobr><?php echo $loc['traffic.php']['t16']; ?></nobr></b></td>			
			<td><b><nobr><?php echo $loc['traffic.php']['t17']; ?></nobr></b></td>
			<td><b><nobr><?php echo $loc['traffic.php']['t18']; ?></nobr></b></td>
			<td><b><nobr><?php echo $loc['traffic.php']['t19']; ?></nobr></b></td>			
			<td><b><nobr><?php echo $loc['traffic.php']['t20']; ?></nobr></b></td>
			<td><b><nobr><?php echo $loc['traffic.php']['t21']; ?></nobr></b></td>
			<td><b><nobr><?php echo $loc['traffic.php']['t22']; ?></nobr></b></td>
			<td><b><nobr><?php echo $loc['traffic.php']['t23']; ?></nobr></b></td>
			<td><b><nobr><?php echo $loc['traffic.php']['t24']; ?></nobr></b></td>
		</tr>
		<?php 
		if ($default_view=="1")
			{
			if (isset($offset) && isset($show_pages))
				{
				$sql = "SELECT * FROM clients_log WHERE `user_id`='$user_id' ORDER BY `id` DESC LIMIT $offset, $show_pages";
				}
			else
				{
				$sql = "SELECT * FROM clients_log WHERE `user_id`='$user_id' ORDER BY `id` DESC";
				}
			}
		else
			{
			if ($search_type=='3')
				{
				if (isset($offset) && isset($show_pages))
					{
					$sql = "SELECT * FROM clients_log WHERE `ip` = '$search_zapros' AND `user_id`='$user_id' ORDER BY `id` DESC LIMIT $offset, $show_pages";
					}
				else
					{
					$sql = "SELECT * FROM clients_log WHERE `ip` = '$search_zapros' AND ``user_id`='$user_id' ORDER BY `id` DESC";
					}
				}		
			elseif ($search_type=='4')
				{
				if (isset($offset) && isset($show_pages))
					{
					$sql = "SELECT * FROM clients_log WHERE `offer_id` = '$search_zapros' AND `user_id`='$user_id' ORDER BY `id` DESC LIMIT $offset, $show_pages";
					}
				else
					{
					$sql = "SELECT * FROM clients_log WHERE `offer_id` = '$search_zapros' AND `user_id`='$user_id' ORDER BY `id` DESC";
					}
				}			
			else
				{
				if (isset($offset) && isset($show_pages))
					{
					$sql = "SELECT * FROM clients_log WHERE `user_id`='$user_id' ORDER BY `id` DESC LIMIT $offset, $show_pages";
					}
					else
					{
					$sql = "SELECT * FROM clients_log WHERE `user_id`='$user_id' ORDER BY `id` DESC";
					}
				}
			}
			$q = $mysqli -> query($sql);
			$cvet=0;	
			if (mysqli_num_rows($q)>0)
				{
				$kolvo_strok=mysqli_num_rows($q);
				while($res=mysqli_fetch_array($q)) 
					{ 
					// Определяем текстовое название оффера
					// Define a text name offer
					$offer_id=htmlentities($res['offer_id']);
					$sql2 = "SELECT name FROM offers WHERE `id`='$offer_id'";
					$q2 = $mysqli -> query($sql2);
					$res2=mysqli_fetch_array($q2);
					
					// Определяем текстовое название лендинга
					// Define a text name landing
					$landing_id=htmlentities($res['landing_id']);
					$sql3 = "SELECT name FROM landings WHERE `id`='$landing_id'";
					$q3 = $mysqli -> query($sql3);
					$res3=mysqli_fetch_array($q3);					
					?>
					<tr class="<?php if ( $cvet & 1 ) {echo 'col2';} else {echo '';} $cvet++; ?>">
						<td>
							<nobr><?php $qdata = strtotime( $res['date'] ); echo date( 'd.m.Y / H:i', $qdata ); ?></nobr>
						</td>
						<td>
							<nobr><?php if ($res2['name']!='') {?><a href="./offers.php?offer=<?php echo $offer_id; ?>" target="_blank"><?php echo html_entity_decode(htmlentities($res2['name']), ENT_QUOTES, 'utf-8'); ?></a><?php } else {?><font style="background: yellow; color: black;"><?php echo $loc['traffic.php']['t25']; ?></font><?php } ?></nobr>
						</td>
						<td>
							<nobr><?php if ($res3['name']!='') {?><?php echo html_entity_decode(htmlentities($res3['name']), ENT_QUOTES, 'utf-8'); ?><?php } else {?><font style="background: yellow; color: black;"><?php echo $loc['traffic.php']['t26']; ?></font><?php } ?></nobr>
						</td>
						<td>
							<nobr><?php echo htmlentities($res['country']); ?></nobr>
						</td>
						<td>
							<nobr><?php echo htmlentities($res['region']); ?></nobr>
						</td>
						<td>
							<nobr><?php echo htmlentities($res['town']); ?></nobr>
						</td>
						<td>
							<nobr><?php echo htmlentities($res['ip']); ?></nobr>
						</td>						
						<td>
							<nobr><?php echo htmlentities($res['browser_name']); ?></nobr>
						</td>
						<td>
							<nobr><?php echo htmlentities($res['browser_version']); ?></nobr>
						</td>						
						<td>
							<nobr><a href="<?php echo htmlentities($res['referer']); ?>" target="_blank" title="<?php echo htmlentities($res['referer']); ?>"><?php echo mb_substr(htmlentities($res['referer']), 0, 40, 'UTF-8'); ?></a></nobr>
						</td>
						<td>
							<nobr><a href="./user_tds.php?id=<?php echo htmlentities($res['id']); ?>&link=<?php echo htmlentities($res['code']); ?>"><?php echo $loc['traffic.php']['t27']; ?></a></nobr>
						</td>
						<td>
							<nobr><?php echo htmlentities($res['useragent']); ?></nobr>
						</td>						
						<td>
							<nobr><?php echo htmlentities($res['platform']); ?></nobr>
						</td>						
						<td>
							<nobr><?php if (htmlentities($res['mobile'])=='1') {echo $loc['traffic.php']['t28'];} elseif (htmlentities($res['mobile'])=='0') {echo $loc['traffic.php']['t29'];} ?></nobr>
						</td>												
						<td>
							<nobr><?php echo htmlentities($res['subid1']); ?></nobr>
						</td>																		
						<td>
							<nobr><?php echo htmlentities($res['subid2']); ?></nobr>
						</td>																		
						<td>
							<nobr><?php echo htmlentities($res['subid3']); ?></nobr>
						</td>																								
					</tr>
					<?php
					}
				}	
			?>
		<tr>
			<td colspan="20">&nbsp;</td>
		</tr>
		<tr class="tablica1" style="background: #cccccc;">
			<td colspan="20" style="text-align: left;"><b><?php echo $loc['traffic.php']['t30']; ?>&nbsp;
			<?php if (isset($kolvo_strok) && $kolvo_strok>0) {echo $kolvo_strok;} else {echo "0";} ?>&nbsp;<?php echo $loc['traffic.php']['t31']; ?></b>
			</td>
		</tr>  
	</table>
</p>
</div>

<p>
	<?php
	// Вывод количества страниц
	// Display the number of pages
	pagination($pagination_fetched_row,100,11);
	?>
</p>

<br /><br />



