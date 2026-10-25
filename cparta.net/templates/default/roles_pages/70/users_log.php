<div class="row cabinet main mt-50 mb-50">

    <div class="col-12 mb-10"><p class="pageTitle mb-25"><?php echo $loc['users_log.php']['t01']; ?></p></div>

<?php

// Проверяем, были ли переданы данные с формы
// Check if a form of the data transmitted
$my_stats='0';
$sql_zapros="SELECT COUNT(id) AS count FROM users_log";


	if (isset($_GET['email']) && $_GET['email']!='')
		{
		$cur_email=htmlentities($_GET['email']);
		$result_detectid = $mysqli->query( "SELECT id FROM users WHERE `email` LIKE '%$cur_email%'");
		$res_detectid=mysqli_fetch_array($result_detectid);
		$id_detectid=htmlentities($res_detectid['id']);
		if ($id_detectid=='') {$id_detectid='-1';}
		}
	if (isset($_GET['my_stats']) && $_GET['my_stats']=='0') 
		{
		$my_stats='0';
		$sql_zapros=$sql_zapros." WHERE `user_session`!='$user_session'";
		if (isset($id_detectid) && ((int)$id_detectid))
			{
			$sql_zapros=$sql_zapros." AND `id_user`='$id_detectid'";
			}
		}
	elseif (isset($_GET['my_stats']) && $_GET['my_stats']=='1') 
		{
		$my_stats='1';
		$sql_zapros=$sql_zapros;
		if (isset($id_detectid) && ((int)$id_detectid))
			{
			$sql_zapros=$sql_zapros." WHERE `id_user`='$id_detectid'";
			}
		}	
	else
		{
		$my_stats='0';
		$sql_zapros=$sql_zapros." WHERE `user_session`!='$user_session'";
		if (isset($id_detectid) && ((int)$id_detectid))
			{
			$sql_zapros=$sql_zapros." AND `id_user`='$id_detectid'";
			}		
		}
$sql_zapros .= ' AND date >= DATE_SUB(NOW(), INTERVAL 7 DAY)';
//var_dump($sql_zapros);
$result=$mysqli->query($sql_zapros);
?>
    <div class="col-12 mb-10">
    <?php
    // Выводим форму с фильтром
    // Display the form with a filter
    include ('./templates/'.$template.'/blocks/users_log_form.php');
    ?>
    </div>
<div class="col-12 mb-10">
<?php
// Подключаем пагинацию (отображение сверху над контентом)
// Connect the pagination (display on top of the content)
function build_pagination_url( $page ) 
	{
	$parameters = array
		(
		'my_stats' => ( isset($_GET['my_stats'] ) ) ? $_GET['my_stats'] : '0',
		'email' => ( isset($_GET['email'] ) ) ? $_GET['email'] : '',
		'page' => $page
		);
	return '?' . http_build_query( $parameters );
	}

// Вывод количества страниц
// Display the number of pages
pagination($result,100,11);
?>
</div>

<div class="col-12 mb-10 horizontal_scroll">

	<p>
		<table class="table table-bordered" width="100%">
			<tr class="table_zagolovki">
				<td><nobr><?php echo $loc['users_log.php']['t02']; ?></nobr></td>
				<td><nobr><?php echo $loc['users_log.php']['t03']; ?></nobr></td>
				<td><nobr><?php echo $loc['users_log.php']['t04']; ?></nobr></td>
				<td><nobr><?php echo $loc['users_log.php']['t05']; ?></nobr></td>
				<td><nobr><?php echo $loc['users_log.php']['t06']; ?></nobr></td>
				<td><nobr><?php echo $loc['users_log.php']['t07']; ?></nobr></td>
				<td><nobr><?php echo $loc['users_log.php']['t08']; ?></nobr></td>
				<td><nobr><?php echo $loc['users_log.php']['t09']; ?></nobr></td>
				<td><nobr><?php echo $loc['users_log.php']['t10']; ?></nobr></td>
				<td><nobr><?php echo $loc['users_log.php']['t11']; ?></nobr></td>
				<td><nobr><?php echo $loc['users_log.php']['t12']; ?></nobr></td>
				<td><nobr><?php echo $loc['users_log.php']['t13']; ?></nobr></td>
				<td><nobr><?php echo $loc['users_log.php']['t14']; ?></nobr></td>
				<td><nobr><?php echo $loc['users_log.php']['t15']; ?></nobr></td>
				<td><nobr><?php echo $loc['users_log.php']['t16']; ?></nobr></td>
				<td><nobr><?php echo $loc['users_log.php']['t17']; ?></nobr></td>
				<td><nobr><?php echo $loc['users_log.php']['t18']; ?></nobr></td>
				<td><nobr><?php echo $loc['users_log.php']['t19']; ?></nobr></td>
				<td><nobr><?php echo $loc['users_log.php']['t20']; ?></nobr></td>
			</tr>
			<?php
			$sql2_zapros="SELECT * FROM users_log";
			// Если мы НЕ хотим чтобы выводилась статистика текущего пользователя
			// If we do not want to display statistics of the current user
			if ($my_stats=='0') 
				{
				$sql2_zapros=$sql2_zapros." WHERE `user_session`!='$user_session'";
				if (isset($id_detectid) && ((int)$id_detectid))
					{
					$sql2_zapros=$sql2_zapros." AND `id_user`='$id_detectid'";
					}
				$sql2_zapros=$sql2_zapros." ORDER BY `id` DESC";
				if (isset($offset) && isset($show_pages))
					{
					$sql2_zapros=$sql2_zapros." LIMIT $offset, $show_pages";
					}
				}
			// Если мы хотим чтобы выводилась статистика текущего пользователя
			// If we want to display statistics of the current user
			elseif ($my_stats=='1') 
				{
				$sql2_zapros=$sql2_zapros;
				if (isset($id_detectid) && ((int)$id_detectid))
					{
					$sql2_zapros=$sql2_zapros." WHERE `id_user`='$id_detectid'";
					}		
				$sql2_zapros=$sql2_zapros." ORDER BY `id` DESC";		
				if (isset($offset) && isset($show_pages))
					{
					$sql2_zapros=$sql2_zapros." LIMIT $offset, $show_pages";
					}
				}
	
			$result2_zapros=$mysqli->query($sql2_zapros);
			
			if (mysqli_num_rows($result2_zapros) > 0) 
				{
				while ($res=mysqli_fetch_array($result2_zapros)) 
					{ 
					// Определяем e-mail пользователя
					// Define the e-mail user
					$id_user=htmlentities($res['id_user']);
					$result_info_user = $mysqli->query( "SELECT email FROM users WHERE `id`='$id_user'");
					$res_info_user=mysqli_fetch_array($result_info_user);
					$email_user=htmlentities($res_info_user['email']);
					if ($email_user=='0' || $email_user=='' && $id_user=='0') {$email_user='Не авторизован';}
					elseif ($email_user=='0' || $email_user=='' && $id_user!='0') {$email_user='Удален';}
	
					// Определяем название действия
					// Determine the name of the action
					$id_user_deystvie=htmlentities($res['deystvie']);
					$result_user_deystvie = $mysqli->query( "SELECT deystvie FROM users_deystvie_tpl WHERE `id`='$id_user_deystvie'");
					$res_user_deystvie=mysqli_fetch_array($result_user_deystvie);
					$user_deystvie=htmlentities($res_user_deystvie['deystvie']);
					if ($user_deystvie=='0' || $user_deystvie=='') {$user_deystvie='Не определено';}
					
					?>
					
					<tr>
						<td><nobr><?php echo htmlentities($res['id']); ?></nobr></td>
						<td><nobr><?php echo date('d.m.Y / H:i:s', strtotime(htmlentities($res['date']))); ?></nobr></td>
						<td><nobr><?php echo htmlentities($email_user); ?></nobr></td>
						<td><nobr><?php echo htmlentities($user_deystvie); ?></nobr></td>
						<td><nobr><a title="<?php echo htmlentities($res['page']); ?>" href="#" onclick="document.getElementById('stranica').value='<?php echo htmlentities($res['page']); ?>';"><?php if (strlen(htmlentities($res['page']))>100) {echo mb_substr(htmlentities($res['page']), 0, 100, 'UTF-8').'...';} else {echo htmlentities($res['page']);} ;?></a></nobr></td>
						<td><nobr><?php echo htmlentities($res['country']); ?></nobr></td>
						<td><nobr><?php echo htmlentities($res['region']); ?></nobr></td>
						<td><nobr><?php echo htmlentities($res['town']); ?></nobr></td>
						<td><nobr><?php echo htmlentities($res['ip']); ?></nobr></td>
						<td><nobr><?php echo htmlentities($res['browser_name']); ?></nobr></td>
						<td><nobr><?php echo htmlentities($res['browser_version']); ?></nobr></td>
						<td><nobr><a title="<?php echo htmlentities($res['referer']); ?>" href="<?php echo htmlentities($res['referer']); ?>" target="_blank"><?php if (strlen(htmlentities($res['referer']))>100) {echo mb_substr(htmlentities($res['referer']), 0, 100, 'UTF-8').'...';} else {echo htmlentities($res['referer']);} ;?></a></nobr></td>
						<td><nobr><a href="./system_tds.php?page=<?php echo htmlentities($res['page']); ?>&referer=<?php echo htmlentities($res['referer']); ?>&ip=<?php echo htmlentities($res['ip']); ?>&platform=<?php echo htmlentities($res['platform']); ?>&useragent=<?php echo htmlentities($res['useragent']); ?>&country=<?php echo htmlentities($res['country']); ?>"><?php echo $loc['users_log.php']['t21']; ?></a></nobr></td>					
						<td><nobr><?php echo htmlentities($res['useragent']); ?></nobr></td>
						<td><nobr><?php echo htmlentities($res['platform']); ?></nobr></td>
						<td><nobr><?php if (htmlentities($res['mobile'])=='1') {echo $loc['users_log.php']['t22'];} elseif (htmlentities($res['mobile'])=='0') {echo $loc['users_log.php']['t23'];} ?></nobr></td>
						<td><nobr><?php echo htmlentities($res['subid1']); ?></nobr></td>
						<td><nobr><?php echo htmlentities($res['subid2']); ?></nobr></td>
						<td><nobr><?php echo htmlentities($res['subid3']); ?></nobr></td>
					</tr>	
					
					<?php
					}
				}
			?>
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
</div>