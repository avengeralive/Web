
<h1><?php echo $loc['users.php']['t01']; ?></h1>

<p>
	<?php if (isset($xtext) && $xtext!='') { ?><p><?php echo $xtext; ?></p><? } ?>
</p>

<?php
$usersManager = new Users_Manager(DB::getInstance());
$getRequest = new Request($_GET);

function build_pagination_url($page = 1) {
    $parameters = array(
        'hold' => ( isset($_GET['hold']) ) ? $_GET['hold'] : '',
        'usertip' => ( isset($_GET['usertip']) ) ? $_GET['usertip'] : '',
        'balance' => ( isset($_GET['balance']) ) ? $_GET['balance'] : '',
        'ip' => ( isset($_GET['ip']) ) ? $_GET['ip'] : '',
        'date_activity' => ( isset($_GET['date_activity']) ) ? $_GET['date_activity'] : '',
        'page' => $page
    );
    return '?' . http_build_query($parameters);
} 

    $perPage = 100;
    if (isset($getRequest->usertip) && is_numeric($getRequest->usertip) && $getRequest->usertip > 0) {
        $usersManager->where('tip', $getRequest->usertip);
    }     
    if (isset($_GET['submit_search']) && isset($_GET['search_zapros']) && isset($_GET['search_type']) && $_GET['search_zapros']!='' && $_GET['search_type']!=''){
        
        $search_zapros= htmlentities($_GET['search_zapros']);
        if (isset($_GET['search_type']) && $_GET['search_type'] !='') {
            $search_type= htmlentities($_GET['search_type']);            
        } else {$search_type='email';}        
        if ($search_type!=''){                          

            $usersManager->where($search_type, $search_zapros);
                
        }
    }
    
    if (isset($_GET['edit']) && $_GET['edit']!=''){
        $id_edit=htmlentities($_GET['edit']);
        $usersManager->where('id', $id_edit);
    }        

    if (isset($getRequest->page) && $getRequest->page > 0) {
        $usersManager->offset($perPage * (intval($getRequest->page) - 1 ));
    }
    $usersManager->limit($perPage);
    
    if (isset($getRequest->id)) {
        $type_sorts = htmlentities($getRequest->id);
        $usersManager->sortBy('id', $type_sorts);
    } 
    if (isset($getRequest->hold)) {
        $type_sorts = htmlentities($getRequest->hold);
        $usersManager->sortBy('hold', $type_sorts);
    }  
    if (isset($getRequest->balance)) {
        $type_sorts = htmlentities($getRequest->balance);
        $usersManager->sortBy('balance', $type_sorts);
    } 
    if (isset($getRequest->tip)) {
        $type_sorts = htmlentities($getRequest->tip);
        $usersManager->sortBy('tip', $type_sorts);
    } 
    if (isset($getRequest->dostup)) {
        $type_sorts = htmlentities($getRequest->dostup);
        $usersManager->sortBy('dostup', $type_sorts);
    } 
    if (isset($getRequest->ip)) {
        $type_sorts = htmlentities($getRequest->ip);
        $usersManager->sortBy('ip', $type_sorts);
    } 
    if (isset($getRequest->hosts)) {
        $type_sorts = htmlentities($getRequest->hosts);
        $usersManager->sortBy('hosts', $type_sorts);
    } 
    if (isset($getRequest->lids)) {
        $type_sorts = htmlentities($getRequest->lids);
        $usersManager->sortBy('orders', $type_sorts);
    }     
    if (isset($getRequest->date_activity)) {
        $type_sorts = htmlentities($getRequest->date_activity);
        $usersManager->sortBy('date_activity', $type_sorts);
    } 
    $result = $usersManager->getUsersAdmin();
    $pagination_fetched_row = array('count' => $usersManager->getTotal());  

if (isset($_GET['edit']) && $_GET['edit']!=''){

	if (is_array($result) && count($result) > 0){
            foreach ($result as $res) {

		$cur_id=htmlentities($res['id']);
		$cur_name=htmlentities($res['name']);
		$cur_email=htmlentities($res['email']);
		$cur_phone=htmlentities($res['phone']);
		$cur_skype=htmlentities($res['skype']);
		$cur_icq=htmlentities($res['icq']);		
		$cur_active=htmlentities($res['active']);
		$type_rekl=htmlentities($res['type_rekl']);
		$cur_ip=htmlentities($res['ip']);
		$cur_date_activity=htmlentities($res['date_activity']);
		$cur_hold=htmlentities($res['hold']);
		$cur_balance=htmlentities($res['balance']);
		$cur_tip_acc=htmlentities($res['tip']);
		$cur_uroven_dostupa=htmlentities($res['uroven_dostupa']);
		$cur_wmr=htmlentities($res['wmr']);
		$message_b=htmlentities($res['message_b']);
		
		// Определяем дату и время регистрации пользователя
		// Determine the date and time the user logs
		$sql_registration_date = "SELECT date FROM users_log WHERE `id_user`='$cur_id' ORDER BY `id` ASC LIMIT 1";
		$result_registration_date = $mysqli->query($sql_registration_date);
		if (mysqli_num_rows($result_registration_date) > 0) 
			{
			$res_registration_date=mysqli_fetch_array($result_registration_date);
			$cur_registration_date=date('d.m.Y / H:m:s', $cur_registration_date = strtotime(htmlentities($res_registration_date['date'])));
			}
		else
			{
			$cur_registration_date='Нет данных';
			}
		?>
		<p>
			<b><?php echo $loc['users.php']['t02']; ?></b>&nbsp;<?php echo $cur_email; ?> <a target="_blank" href="./tickets.php?komu=<?php echo $cur_id; ?>"><span class="send_ticket"></span></a>, <b>Статус:</b>  
			<?php
			if ($cur_active=='0') {?><font style="background: yellow; color: black;">&nbsp;<?php echo $loc['users.php']['t03']; ?>&nbsp;</font><?}
			if ($cur_active=='1') {?><font style="background: green; color: white;">&nbsp;<?php echo $loc['users.php']['t04']; ?>&nbsp;</font><?}
			if ($cur_active=='5') {?><font style="background: red; color: white;">&nbsp;<?php echo $loc['users.php']['t05']; ?>&nbsp;</font><?}			
			?>
		</p>
		
		<p>
			<form name="edit_user" method="post" action="./users.php?<?php echo @$_SERVER['QUERY_STRING']; ?>">		
				<table>
					<tr height="60">
						<td style="width: 250px;">
							<b><?php echo $loc['users.php']['t06']; ?></b><br />
							<input type="text" name="email" value="<?php echo $cur_email; ?>">
						</td>
						<td>
							<b><?php echo $loc['users.php']['t07']; ?></b><br />
							<input type="text" name="wmr" value="<?php echo $cur_wmr; ?>">
						</td>
                                                <td rowspan="5"><textarea name="comment" style="width:300px;height: 245px;margin-left: 50px;"><?php if($res['comment'] == ''){echo 'Заметки о пользователе';}else{ echo $res['comment']; } ?></textarea></td>
					</tr>
					<tr height="60">
						<td>
							<b><?php echo $loc['users.php']['t08']; ?></b><br />
							<input type="text" name="name" value="<?php echo $cur_name; ?>">
						</td>
						<td>
							<b><?php echo $loc['users.php']['t53']; ?></b><br />
							<?php echo $cur_ip;	?>
							<input type="hidden" name="ip" value="<?php echo $cur_ip; ?>">
						</td>				
					</tr>
					<tr height="60">
						<td>
							<b><?php echo $loc['users.php']['t09']; ?></b><br />
							<input type="text" name="phone" value="<?php echo $cur_phone; ?>">
						</td>
						<td>
							<b><?php echo $loc['users.php']['t10']; ?></b><br />
							<input type="text" name="hold" value="<?php echo $cur_hold; ?>">
						</td>			
					</tr>
					<tr height="60">
						<td>
							<b><?php echo $loc['users.php']['t11']; ?></b><br />
							<input type="text" name="skype" value="<?php echo $cur_skype; ?>">
						</td>
						<td>
							<b><?php echo $loc['users.php']['t12']; ?></b><br />
							<input type="text" name="balance" value="<?php echo $cur_balance; ?>">
						</td>				
					</tr>
					<tr height="60">
						<td>
							<b><?php echo $loc['users.php']['t13']; ?></b><br />
							<input type="text" name="icq" value="<?php echo $cur_icq; ?>" readonly onfocus="this.removeAttribute('readonly');">
						</td>
						<td>
							<b><?php echo $loc['users.php']['t14']; ?></b><br />
							<?php 
							echo date('d.m.Y / H:m:s', $cur_date_activity = strtotime($cur_date_activity));
							?>
						</td>				
					</tr>			
					<tr height="60">
						<td>
							<b><?php echo $loc['users.php']['t15']; ?></b><br />
							<input type="password" name="password" value="" readonly onfocus="this.removeAttribute('readonly');">
						</td>
						<td>
							<b><?php echo $loc['users.php']['t16']; ?></b><br />
							<?php 
							echo $cur_registration_date;
							?>
						</td>			
					</tr>			
				</table>
				<p>
					<b><?php echo $loc['users.php']['t17']; ?></b>&nbsp;
					<select name="active">
						<option value="0"<?php if ($cur_active=='0') {?>selected="selected"<?} ?>><?php echo $loc['users.php']['t18']; ?></option>
						<option value="1"<?php if ($cur_active=='1') {?>selected="selected"<?} ?>><?php echo $loc['users.php']['t04']; ?></option>			
						<option value="5"<?php if ($cur_active=='5') {?>selected="selected"<?} ?>><?php echo $loc['users.php']['t05']; ?></option>
					</select>
				</p>
				<p>
					<b><?php echo $loc['users.php']['t19']; ?></b>&nbsp;
					<select name="tip">
						<?php
						$sql_uroven = "SELECT tip,title FROM users_roles_tpl WHERE active='1'";
						$result_uroven = $mysqli->query($sql_uroven);
						if (mysqli_num_rows($result_uroven) > 0) 
							{
							while($res_uroven=mysqli_fetch_array($result_uroven)) 
								{ 
								?>
								<option value="<?php echo htmlentities($res_uroven['tip']); ?>"<?php if ($cur_tip_acc==$res_uroven['tip']) {?>selected="selected"<?} ?>><?php echo htmlentities($res_uroven['title']); ?></option>
								<?php
								}
							}
						?>
					</select>
				</p>
				<p>
					<b><?php echo $loc['users.php']['t20']; ?></b>&nbsp;
					<?php
					if ($cur_tip_acc=='10' || $cur_tip_acc=='40')
						{
						?>
						<select name="uroven_dostupa">
							<?php
							$sql_ur_v = "SELECT tip_account, uroven_dostupa, opisanie FROM uroven_tpl WHERE `uroven_dostupa`='$cur_uroven_dostupa' AND `tip_account`='$cur_tip_acc'";
							$result_ur_v = $mysqli->query($sql_ur_v);
							$res_ur_v=mysqli_fetch_array($result_ur_v);
							?>
							<option value="<?php echo htmlentities($res_ur_v['uroven_dostupa']); ?>" selected="selected"><?php echo htmlentities($res_ur_v['opisanie']); ?></option>
							<?php
							// Запоминаем текущий уровень пользователя
							// Stores the current user level
							$selected_uroven=$res_ur_v['uroven_dostupa'];
							$sql_ur_v = "SELECT tip_account, uroven_dostupa, opisanie FROM uroven_tpl WHERE `tip_account`='$cur_tip_acc'";
							$result_ur_v = $mysqli->query($sql_ur_v);
							if (mysqli_num_rows($result_ur_v) > 0) 
								{
								while($res_ur_v=mysqli_fetch_array($result_ur_v)) 
									{
									if ($res_ur_v['uroven_dostupa']!=$selected_uroven)
										{
										?>
										<option value="<?php echo htmlentities($res_ur_v['uroven_dostupa']); ?>"><?php echo htmlentities($res_ur_v['opisanie']); ?></option>
										<?php
										}
									}
								}
							?>
						</select>
						<?php
						}
					else
						{
						?>
						<input type="hidden" name="uroven_dostupa" value="<?php echo $cur_uroven_dostupa; ?>">
						<?php echo $loc['users.php']['t21']; ?>
						<?php
						}
					?>
				</p>
				
				<p>
					<?php
					if ($cur_tip_acc=='40')
						{
						?>
						<b><?php echo $loc['users.php']['t56']; ?></b>&nbsp;
						<select name="status_rekl">
							
							<option value="0" <?php if($type_rekl == 0){echo 'selected="selected"';} ?>><?php echo $loc['users.php']['t57']; ?></option>
							<option value="1" <?php if($type_rekl == 1){echo 'selected="selected"';} ?>><?php echo $loc['users.php']['t58']; ?></option>
										
						</select>
						<br><br>
						<b><?php echo $loc['users.php']['t59']; ?></b>&nbsp;
						<input type="text" name="message_b" style="width:100px;text-align:center;" value="<?php echo $message_b; ?>"> руб.
						<br><br>
						<?php echo $loc['users.php']['t60']; ?> &nbsp; <input name="send_to_admin" type="checkbox" <?php if ($send_to_admin==1) {echo 'checked=checked';} ?>>
						<?php
						}
					?>
				</p>				
				
				<p>
					<input type="button" name="return" value="<?php echo $loc['users.php']['t22']; ?>" onclick="document.location.href='users.php'">
					<input type="submit" name="submit_user" value="<?php echo $loc['users.php']['t23']; ?>" onclick="if (!confirm('<?php echo $loc['users.php']['t24']; ?>'))return false;"><br /><br />
					<input name="id" type="hidden" value="<?php echo htmlentities($id_edit); ?>">
				</p>
			</form>
		</p>
		<?
            }
        }else{
            echo $loc['users.php']['t25'];
	}
}else{
	?>
	<p>
		<form name="user_poisk" class="report" method="get" action="./users.php?<?php echo @$_SERVER['QUERY_STRING']?>">
			<p>
				<b><?php echo $loc['users.php']['t26']; ?>&nbsp;</b>
				<select name="search_type">
					<option class="options" value="email" <? if (isset($_GET['search_type']) && $_GET['search_type']=='email') {echo 'selected="selected"';} ?>><?php echo $loc['users.php']['t29']; ?></option>
                                        <option class="options" value="id" <? if (isset($_GET['search_type']) && $_GET['search_type']=='id') {echo 'selected="selected"';} ?>><?php echo $loc['users.php']['t61']; ?></option>
				</select>
			</p>
			<p>
				<b><?php echo $loc['users.php']['t27']; ?>&nbsp;</b>
				<input type="text" name="search_zapros" class="search_pole" value="<? if (isset($_GET['search_zapros'])) {echo $_GET['search_zapros'];} ?>" maxlength="100" />
			</p>
                       
			<p>
				<b>&nbsp;</b><input name="submit_search" value="<?php echo $loc['button']['t02']; ?>" class="others_button_vyvesti" type="submit">
			</p>
		</form>
	</p>
<style>
    a.type{
        margin-left: 20px;
    }
    a.type.active{
        color: #2d5ea3;

        border-bottom-style: solid;
        border-bottom-color: #2d5ea3;
    }
</style>        
        <div style="margin:30px 0;">              
            <p>
                <b><?php echo $loc['users.php']['t19']; ?>&nbsp;</b>
                <a class="type <?php if (isset($getRequest->userstip) && $getRequest->userstip == 0) echo "active"; ?> navigation-page" href="<?php echo build_pagination_url(1); ?>&usertip=0"><?php echo $loc['offers.php']['filter_field_type_all']; ?></a>                 
                <a class="type <?php if (isset($getRequest->userstip) && $getRequest->userstip == 10) echo "active"; ?> navigation-page" href="<?php echo build_pagination_url(1); ?>&usertip=10">Вебмастер</a>
                <a class="type <?php if (isset($getRequest->userstip) && $getRequest->userstip == 40) echo "active"; ?> navigation-page" href="<?php echo build_pagination_url(1); ?>&usertip=40">Рекламодатель</a>
                <a class="type <?php if (isset($getRequest->userstip) && $getRequest->userstip == 60) echo "active"; ?> navigation-page" href="<?php echo build_pagination_url(1); ?>&usertip=60">Менеджер</a>
                <a class="type <?php if (isset($getRequest->userstip) && $getRequest->userstip == 70) echo "active"; ?> navigation-page" href="<?php echo build_pagination_url(1); ?>&usertip=70">Администратор</a>
                <a class="type <?php if (isset($getRequest->userstip) && $getRequest->userstip == 80) echo "active"; ?> navigation-page" href="<?php echo build_pagination_url(1); ?>&usertip=80">Оператор тех.поддержки</a>
            </p>                
        </div>         
	<?php
	if (isset($_GET['submit_search']) && isset($_GET['search_zapros']) && isset($_GET['search_type']) && $_GET['search_zapros']!='' && $_GET['search_type']!='')
		{
		?>
		<table class="stats_table" width="100%">
			<tr class="table_zagolovki">
				<td colspan="11"><?php echo $loc['users.php']['t28']; ?></td>
			</tr>
			<tr class="table_zagolovki">
				<td><?php echo $loc['users.php']['t30']; ?></td>	
				<td><?php echo $loc['users.php']['t31']; ?></td>
				<td><?php echo $loc['users.php']['t32']; ?></td>
				<td><?php echo $loc['users.php']['t33']; ?></td>
                                <td><?php echo $loc['users.php']['t63']; ?></td>
                                <td><?php echo $loc['users.php']['t64']; ?></td>
				<td><?php echo $loc['users.php']['t34']; ?></td>			
				<td><?php echo $loc['users.php']['t35']; ?></td>		
				<td><?php echo $loc['users.php']['t36']; ?></td>
				<td><?php echo $loc['users.php']['t37']; ?></td>		
				<td><?php echo $loc['users.php']['t38']; ?></td>				
			</tr>
			<?
			$cvet=0;
			if (is_array($result) && count($result) > 0){ 
				
				foreach ($result as $res) { 
					
					$cur_id=htmlentities($res['id']);
					$cur_email=htmlentities($res['email']);
					$cur_hold=htmlentities($res['hold']);
					$cur_balance=htmlentities($res['balance']);	
					$cur_tip_acc=htmlentities($res['tip']);
					$cur_uroven_dostupa=htmlentities($res['uroven_dostupa']);
					$cur_ip=htmlentities($res['ip']);
					$cur_date_activity=htmlentities($res['date_activity']);
                                        $cur_hosts=htmlentities($res['hosts']);
                                        $cur_lids=htmlentities($res['orders']); 
					?> 
					<tr class="<?php if ( $cvet & 1 ) {echo 'col2';} else {echo '';} $cvet++; ?>">
						<td><?php echo $cur_id; ?></td>
						<td><?php echo $cur_email; ?></td>
						<td><?php echo $cur_hold; ?></td>
						<td><?php echo $cur_balance; ?></td>
                                                <td>
                                                        <nobr>
                                                                <?php 
                                                                echo $cur_hosts;									
                                                                ?>
                                                        </nobr>
                                                </td>
                                                <td>
                                                        <nobr>
                                                                <?php 
                                                                echo $cur_lids;									
                                                                ?>
                                                        </nobr>
                                                </td>                                                 
						<td>
							<?php
							$sql_uroven = "SELECT title FROM users_roles_tpl WHERE `tip`='$cur_tip_acc'";
							$result_uroven = $mysqli->query($sql_uroven);
							$res_uroven=mysqli_fetch_array($result_uroven);
							echo htmlentities($res_uroven['title']);
							?>
						</td>			
						<td>
							<?php
							$sql_ur_v = "SELECT tip_account, uroven_dostupa, opisanie FROM uroven_tpl WHERE `uroven_dostupa`='$cur_uroven_dostupa' AND `tip_account`='$cur_tip_acc'";
							$result_ur_v = $mysqli->query($sql_ur_v);
							$res_ur_v=mysqli_fetch_array($result_ur_v);
							if ($res_ur_v['opisanie']!='')
								{echo htmlentities($res_ur_v['opisanie']);}
							else
								{echo $loc['users.php']['t21'];}
							?>
						</td>
						<td>
							<?php echo $cur_ip;	?>
						</td>			
						<td>
							<?php echo $cur_date_activity; ?>
						</td>
                                                
						<td><a href="users.php?edit=<?php echo $cur_id; ?>"><?php echo $loc['users.php']['t65']; ?></a>&nbsp;|&nbsp;<a href="stats.php?webmaster=<?php echo $cur_id; ?>"><?php echo $loc['users.php']['t66']; ?></a>&nbsp;|&nbsp;<a target="_blank" href="./tickets.php?komu=<?php echo $cur_id; ?>"><span class="send_ticket"></span></a></td>
					</tr>
					<?php
				}
                        }
			?>  
		</table>
		<?php
		}
	else
		{  
		?>
		<p>
			<?php
			// Вывод количества страниц
			// Display the number of pages
			pagination($result,$perPage,11);
			?>
		</p>
		<p>
			<table class="stats_table" width="100%">
				<tr class="table_zagolovki">
					<td colspan="11"><?php echo $loc['users.php']['t40']; ?>&nbsp;[<a href="./adduser.php" class="normal_link"><?php echo $loc['users.php']['t41']; ?></a>]</td>
				</tr>
				<tr class="table_zagolovki">
					<td><nobr><a href="users.php<?php echo build_pagination_url(); ?>&&id=<?php if (isset($_GET['id']) && $_GET['id']=='desc') {echo "asc";} else {echo "desc";} ?>"><?php echo $loc['users.php']['t30']; ?></a></nobr></td>	
					<td><nobr><?php echo $loc['users.php']['t31']; ?></nobr></td>
					<td><nobr><a href="users.php<?php echo build_pagination_url(); ?>&hold=<?php if (isset($_GET['hold']) && $_GET['hold']=='desc') {echo "asc";} else {echo "desc";} ?>"><?php echo $loc['users.php']['t32']; ?></a></nobr></td>
					<td><nobr><a href="users.php<?php echo build_pagination_url(); ?>&balance=<?php if (isset($_GET['balance']) && $_GET['balance']=='desc') {echo "asc";} else {echo "desc";} ?>"><?php echo $loc['users.php']['t33']; ?></a></nobr></td>
                        
                                        <td><nobr><a href="users.php<?php echo build_pagination_url(); ?>&hosts=<?php if (isset($_GET['hosts']) && $_GET['hosts']=='desc') {echo "asc";} else {echo "desc";} ?>"><?php echo $loc['users.php']['t63']; ?></a></nobr></td>
                                        <td><nobr><a href="users.php<?php echo build_pagination_url(); ?>&lids=<?php if (isset($_GET['lids']) && $_GET['lids']=='desc') {echo "asc";} else {echo "desc";} ?>"><?php echo $loc['users.php']['t64']; ?></a></nobr></td>

					<td><nobr><a href="users.php<?php echo build_pagination_url(); ?>&tip=<?php if (isset($_GET['tip']) && $_GET['tip']=='desc') {echo "asc";} else {echo "desc";} ?>"><?php echo $loc['users.php']['t34']; ?></a></nobr></td>			
					<td><nobr><a href="users.php<?php echo build_pagination_url(); ?>&dostup=<?php if (isset($_GET['dostup']) && $_GET['dostup']=='desc') {echo "asc";} else {echo "desc";} ?>"><?php echo $loc['users.php']['t67']; ?></a></nobr></td>		
					<td><nobr><a href="users.php<?php echo build_pagination_url(); ?>&ip=<?php if (isset($_GET['ip']) && $_GET['ip']=='desc') {echo "asc";} else {echo "desc";} ?>"><?php echo $loc['users.php']['t36']; ?></a></nobr></td>
					<td><nobr><a href="users.php<?php echo build_pagination_url(); ?>&date_activity=<?php if (isset($_GET['date_activity']) && $_GET['date_activity']=='desc') {echo "asc";} else {echo "desc";} ?>"><?php echo $loc['users.php']['t37']; ?></a></nobr></td>		
					<td><nobr><?php echo $loc['users.php']['t38']; ?></nobr></td>		
				</tr>
				<?

                                
				$cvet=0;
				if (is_array($result) && count($result) > 0) {
					
					foreach ($result as $res) {
						 
						$cur_id=htmlentities($res['id']);
						$cur_email=htmlentities($res['email']);
						$cur_active=htmlentities($res['active']);
						$cur_hold=htmlentities($res['hold']);
						$cur_balance=htmlentities($res['balance']);                                              
						$cur_tip_acc=htmlentities($res['tip']);
						$cur_uroven_dostupa=htmlentities($res['uroven_dostupa']);
						$cur_ip=htmlentities($res['ip']);
						$cur_date_activity=htmlentities($res['date_activity']);
                                                
                                                
                                                
                                                $cur_hosts=htmlentities($res['hosts']);
                                                $cur_lids=htmlentities($res['orders']);                                                
						?> 
						<tr class="<?php if ( $cvet & 1 ) {echo 'col2';} else {echo '';} $cvet++; ?>">
							<td style="<?php
								if ($cur_active=='0') {?>background: yellow; color: black;<?}
								if ($cur_active=='1') {?>background: green; color: white;<?}
								if ($cur_active=='5') {?>background: red; color: white;<?} 
								?>"><nobr><?php echo $cur_id; ?></nobr>
							</td>
							<td><nobr><?php echo $cur_email; ?></nobr></td>
							<td>
								<nobr>
									<?php 
									if ($cur_tip_acc=='70')
										{echo $loc['users.php']['t21'];}
									else
										{echo $cur_hold;}
									?>
								</nobr>
							</td>
							<td>
								<nobr>
									<?php 
									if ($cur_tip_acc=='70')
										{echo $loc['users.php']['t21'];}
									else
										{echo $cur_balance;}									
									?>
								</nobr>
							</td>
							<td>
								<nobr>
									<?php 
									echo $cur_hosts;									
									?>
								</nobr>
							</td>
							<td>
								<nobr>
									<?php 
									echo $cur_lids;									
									?>
								</nobr>
							</td>                                                        
							<td>
								<nobr>
									<?php
									$sql_uroven = "SELECT title FROM users_roles_tpl WHERE `tip`='$cur_tip_acc'";
									$result_uroven = $mysqli->query($sql_uroven);
									$res_uroven=mysqli_fetch_array($result_uroven);
                                                                        
                                                                        $arr_title_old = array("Вебмастер", "Рекламодатель", "Менеджер сети", "Администратор сети", "Колл-центр рекламодателя", "Менеджер рекламодателя", "Колл-центр сети", "Оператор тех.поддержки");
									$arr_title_new = array("Вебм","Рекл","Мен","Адм","Колл","Мен","Колл","ТП");
                                                                        $new_title_tip = str_replace($arr_title_old, $arr_title_new, $res_uroven['title']);
                                                                        echo $new_title_tip;
									?>
								</nobr>
							</td>			
							<td>
								<nobr>
									<?php
									$sql_ur_v = "SELECT tip_account, uroven_dostupa, opisanie FROM uroven_tpl WHERE `uroven_dostupa`='$cur_uroven_dostupa' AND `tip_account`='$cur_tip_acc'";
									$result_ur_v = $mysqli->query($sql_ur_v);
									$res_ur_v=mysqli_fetch_array($result_ur_v);
									if ($res_ur_v['opisanie']!='')
										{
                                                                                $arr_level_old = array("Начальный", "Продвинутый");
                                                                                $arr_level_new = array("Нач","Продв");
                                                                                $new_level = str_replace($arr_level_old, $arr_level_new, $res_ur_v['opisanie']);
                                                                                echo $new_level;
                                                                                }
									else
										{echo '-';}
									?>
								</nobr>
							</td>			
							<td><nobr><?php echo $cur_ip; ?></nobr></td>			
							<td><nobr><?php echo date('d.m.Y / H:m:s', $cur_date_activity = strtotime($cur_date_activity)); ?></nobr></td>
							<td><nobr><a href="users.php?edit=<?php echo $cur_id; ?>"><?php echo $loc['users.php']['t65']; ?></a>&nbsp;|&nbsp;<a href="stats.php?webmaster=<?php echo $cur_id; ?>"><?php echo $loc['users.php']['t66']; ?></a>&nbsp;|&nbsp;<a target="_blank" href="./tickets.php?komu=<?php echo $cur_id; ?>"><span class="send_ticket"></span></a></nobr></td>
						</tr>
						<?php
						}
					}
				?>  
			</table>
		</p>
		<p>
			<?php
			// Вывод количества страниц
			// Display the number of pages
			pagination($pagination_fetched_row,100,11);
			?>
		</p>
		<p>
			&nbsp;
		</p>
		<p>
			&nbsp;
		</p>		
		<?php
		}
	}
?>
