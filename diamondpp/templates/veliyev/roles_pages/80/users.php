<script>
(function($) {
$(function() {

  $('#offer_id_award').styler({
    selectSearch: true,
    selectSearchLimit: 12,
    selectVisibleOptions: 20
  });
  $('[name="search_type"],[name="ref_program"],[name="active"],[name="tip"],[name="uroven_dostupa"]').styler({
  });
  
})
})(jQuery)

</script>
<p class="pageTitle"><span><?php echo $loc['users.php']['t01']; ?></span></p>

<p>
	<?php if (isset($xtext) && $xtext!='') { ?><p><?php echo $xtext; ?></p><?php } ?>
</p>
<script type="text/javascript" src="./templates/<?php echo $template; ?>/js/moment.min.js"></script>
<script src="./templates/<?php echo $template; ?>/js/range.js"></script>
<link rel="stylesheet" type="text/css" href="./templates/<?php echo $template; ?>/css/daterangepicker.css" />
<link rel="stylesheet" type="text/css" href="./templates/<?php echo $template; ?>/css/bootstrap.css" />

<?php
$usersManager = new Users_Manager(DB::getInstance());
$getRequest = new Request($_GET);
// Если указана дата, разбиваем строку
// If the date, split the string
if(isset($getRequest->date) and $getRequest->date != 0 and $getRequest->date != ''){
    $dd = explode(' - ', $getRequest->date);
    $_GET['date1'] = $dd[0];
    $_GET['date2'] = $dd[1];
}else{
    $dd = array(0=>date('d.m.Y', (time() - 60*60*24*6)),1=>date('d.m.Y', time()));
}
    
    $dat1 = $dd[0];
    $dat2 = $dd[1];
    $usersManager->dat1 = date( 'Y-m-d', strtotime( $dat1 ) );
    $usersManager->dat2 = date( 'Y-m-d', strtotime( $dat2 ) );    
    $usersManager->tdat1 = date( 'Ymd', strtotime( $dat1 ) );
    $usersManager->tdat2 = date( 'Ymd', strtotime( $dat2 ) ); 

function build_pagination_url($page = 1) {
    $parameters = array(
        'date' => ( isset($_GET['date']) ) ? $_GET['date'] : '',
        'search_type' => ( isset($_GET['search_type']) ) ? $_GET['search_type'] : '',
        'search_zapros' => ( isset($_GET['search_zapros']) ) ? $_GET['search_zapros'] : '',
        'submit_search' => ( isset($_GET['submit_search']) ) ? $_GET['submit_search'] : '',
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
    
    $usersManager->byDate = " and date between '". htmlentities($usersManager->dat1)." ".$DT."' AND '".htmlentities($usersManager->dat2)." ".$NT."'";
    
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
    $pagination_fetched_row = array('count' => $usersManager->getCountUsers());  

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
                        echo "&nbsp; ID: $cur_id";
			?>
		</p>
                
		<p><b>Зарегистрирован по ютм меткам:<b></p>


                    <table style="margin-bottom:50px;" class="stats_table" width="100%">
                        <tr class="tableHead">
                            <td>UTM source</td>
                            <td>UTM medium</td>
                            <td>UTM campaign</td>
                            <td>UTM term</td>
                            <td>UTM content</td>
                        </tr>
                        <tr>
                            <td><?=$res['utm_source']; ?></td>
                            <td><?=$res['utm_medium']; ?></td>
                            <td><?=$res['utm_campaign']; ?></td>
                            <td><?=$res['utm_term']; ?></td>
                            <td><?=$res['utm_content']; ?></td>
                        </tr>                        
                    </table>    
           
                            
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
							<?php echo $cur_hold; ?>
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
                                    <?php   if ($cur_tip_acc=='10'){ ?>    
					<tr height="100">
						<td>
							<b><?php echo $loc['users.php']['t68']; ?>:<br>(<?php echo $loc['users.php']['t69']; ?>)</b><br />
							<input type="text" name="hold_days" value="<?=$res['hold_days']; ?>">
						</td>
						<td>
							<b><?php echo $loc['users.php']['t70']; ?>:</b><br />
							<select name="ref_program">
                                                            <option value="0" <?php if($res['ref_program'] == 0){echo 'selected';} ?>>ВЫКЛ</option> 
                                                            <option value="1" <?php if($res['ref_program'] == 1){echo 'selected';} ?>>ВКЛ</option>  
                                                        </select>
						</td>			
					</tr>    
					<tr height="100">
						<td>
							<b><?php echo $loc['users.php']['t71']; ?>:<br>(<?php echo $loc['users.php']['t72']; ?>)</b><br />
							<input type="text" name="offers_reward_all" value="<?=$res['offers_reward_all']; ?>">
						</td>
						<td>
                                                    <br><a style="cursor:pointer;" id="rewards_all_show"><b><?php echo $loc['users.php']['t73']; ?></b></a>
						</td>			
					</tr>  
                                    <?php   } ?>    
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
					<tr height="60">
						<td>
                                                    <b><?php echo $loc['users.php']['t17']; ?></b>
						</td>
						<td>
                                                    <select name="active">
                                                            <option value="0"<?php if ($cur_active=='0') {?>selected="selected"<?} ?>><?php echo $loc['users.php']['t18']; ?></option>
                                                            <option value="1"<?php if ($cur_active=='1') {?>selected="selected"<?} ?>><?php echo $loc['users.php']['t04']; ?></option>			
                                                            <option value="5"<?php if ($cur_active=='5') {?>selected="selected"<?} ?>><?php echo $loc['users.php']['t05']; ?></option>
                                                    </select>
						</td>			
					</tr>   
					<tr height="60">
						<td>
                                                    <b><?php echo $loc['users.php']['t19']; ?></b>
						</td>
						<td>
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
						</td>			
					</tr>  
					<tr height="60">
						<td>
                                                    <b><?php echo $loc['users.php']['t20']; ?></b>
						</td>
						<td>
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
						</td>			
					</tr> 
                            <?php   if ($cur_tip_acc=='40'){ ?>
                                        <tr height="60">
                                                <td>
                                                    <b><?php echo $loc['users.php']['t56']; ?></b>
                                                </td>
                                                <td>
                                                    <select name="status_rekl">

                                                            <option value="0" <?php if($type_rekl == 0){echo 'selected="selected"';} ?>><?php echo $loc['users.php']['t57']; ?></option>
                                                            <option value="1" <?php if($type_rekl == 1){echo 'selected="selected"';} ?>><?php echo $loc['users.php']['t58']; ?></option>

                                                    </select>
                                                </td>			
                                        </tr>   
                                        <tr height="60">
                                            <td>
                                            <b><?php echo $loc['users.php']['t59']; ?></b>&nbsp;
                                             </td>
                                             <td> 
                                            <input type="text" name="message_b" style="width:100px;text-align:center;" value="<?php echo $message_b; ?>"> руб.
                                            </td>
                                        </tr>
                                        <tr height="60">
                                            <td colspan="2">
                                                <?php echo $loc['users.php']['t60']; ?> &nbsp; <input name="send_to_admin" type="checkbox" <?php if ($send_to_admin==1) {echo 'checked=checked';} ?>>
                                            </td>
                                        </tr>
                                        
                            <?php   } ?>                                        
				</table>
                                
				<p>
					<input type="button" name="return" value="<?php echo $loc['users.php']['t22']; ?>" onclick="document.location.href='users.php'">
					<input type="submit" name="submit_user" value="<?php echo $loc['users.php']['t23']; ?>" onclick="if (!confirm('<?php echo $loc['users.php']['t24']; ?>'))return false;"><br /><br />
					<input name="id" type="hidden" value="<?php echo htmlentities($id_edit); ?>">
				</p>
			</form>
		</p>
                
                
                <table class="stats_table offers_list" style="margin-top:50px;display:none;width:100%;">
                    <tr height="60" class="tableHead">
                        <td colspan="4">
                            <b>Отчисления по каждому офферу:</b>
                        </td>
                    </tr>
                    <tr height="60" class="tableHead">
                        <td colspan="4">

                            <select id="offer_id_award" style="text-align: left; width: 300px; height: 25px;">
                                <option value="0">Выбрать оффер</option>
                                <?php
                                $offers = new Offer;
                                $offers_arr = $offers->getByAdmin($user_id);   
                                if (is_array($offers_arr) && count($offers_arr) > 0) {
                                    foreach ($offers_arr as $offer){
                                       echo '<option value="'.$offer['id'].'" ';
                                        if ($getRequest->offer == $offer['id']) echo 'selected';
                                       echo '>'.html_entity_decode($offer['name'], ENT_QUOTES, 'utf-8').'</option>';
                                    }                                    
                                }
                                ?>                                 
                            </select>

                        </td>
                    </tr>  
                </table>
                
                <div id="js-ajax-content"></div>
                
                <script>
                    $('#offer_id_award').on('change', function () {
                        var offer = $(this).val();
                        
                        var json = JSON.stringify({
                            offer: offer
                        });                        
                        $.ajax({
                            type: "POST",
                            url: "./post/offer_awards.php",
                            data: "offer="+offer+"&user="+<?=$id_edit; ?>,
                            success: function(response){
                                data = jQuery.parseJSON(response);
                                status = data.status;
                                msg = data.message;      
                                if(status == 'success'){                                                   
                                    $('#js-ajax-content').html(msg); 
                                }else{                            
                                    alert(msg); 
                                }

                            }
                        });                        
                    })              
                </script>
                
                
		<?
            }
        }else{
            echo $loc['users.php']['t25'];
	}
}else{
	?>
	<p>
		<form name="user_poisk" class="report" method="get" action="?">
                            <?php
                            foreach ($_GET as $k => $v) {
                                if (in_array($k, array('search_type', 'date','search_zapros','submit_search'))) {
                                    continue;
                                }
                                echo "<input type=hidden name='" . htmlentities($k, ENT_QUOTES) . "' value='" . htmlentities($v, ENT_QUOTES) . "' />" . PHP_EOL;
                            }
                            ?>                     
			<p>
				<b><?php echo $loc['users.php']['t26']; ?>&nbsp;</b>
				<select name="search_type">
                                        <option <?php if (!$getRequest->search_type or $getRequest->search_type == 0) echo ' selected '; ?> value="0"><?php echo $loc['offers.php']['filter_field_category_select']; ?></option>
					<option class="options" value="email" <?php if (isset($getRequest->search_type) && $getRequest->search_type=='email') {echo 'selected="selected"';} ?>><?php echo $loc['users.php']['t29']; ?></option>
                                        <option class="options" value="id" <?php if (isset($getRequest->search_type) && $getRequest->search_type=='id') {echo 'selected="selected"';} ?>><?php echo $loc['users.php']['t61']; ?></option>
                                        <option class="options" value="utm_source" <?php if (isset($getRequest->search_type) && $getRequest->search_type=='utm_source') {echo 'selected="selected"';} ?>>Поиск по utm source</option>
                                        <option class="options" value="utm_medium" <?php if (isset($getRequest->search_type) && $getRequest->search_type=='utm_medium') {echo 'selected="selected"';} ?>>Поиск по utm medium</option>
                                        <option class="options" value="utm_campaign" <?php if (isset($getRequest->search_type) && $getRequest->search_type=='utm_campaign') {echo 'selected="selected"';} ?>>Поиск по utm campaign</option>
                                        <option class="options" value="utm_term" <?php if (isset($getRequest->search_type) && $getRequest->search_type=='utm_term') {echo 'selected="selected"';} ?>>Поиск по utm term</option>
                                        <option class="options" value="utm_content" <?php if (isset($getRequest->search_type) && $getRequest->search_type=='utm_content') {echo 'selected="selected"';} ?>>Поиск по utm content</option>
				</select>
                                &nbsp;&nbsp;&nbsp;&nbsp;
				<span>
					<b><?php echo $loc['stats.php']['t02']; ?>&nbsp;</b>
					<input type="text" name="date" id="datepicker" style="text-align: center; width: 169px; height: 18px;" readonly />
				</span>                                
			</p>
			<p>
				<b><?php echo $loc['users.php']['t27']; ?>&nbsp;</b>
				<input type="text" name="search_zapros" class="search_pole" value="<?php if (isset($_GET['search_zapros'])) {echo $_GET['search_zapros'];} ?>" maxlength="100" />
			</p>
                       
			<p>
				<b>&nbsp;</b><input name="submit_search" value="<?php echo $loc['button']['t02']; ?>" class="others_button_vyvesti" type="submit">
			</p>
		</form>
                <a style="text-align:center;margin:20px 0;" href="./users.php"><?php echo $loc['stats.php']['t08']; ?></a>
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
                <a class="type <?php if (isset($getRequest->usertip) && $getRequest->usertip == 0) echo "active"; ?> navigation-page" href="<?php echo build_pagination_url(1); ?>&usertip=0"><?php echo $loc['offers.php']['filter_field_type_all']; ?></a>                 
                <a class="type <?php if (isset($getRequest->usertip) && $getRequest->usertip == 10) echo "active"; ?> navigation-page" href="<?php echo build_pagination_url(1); ?>&usertip=10">Вебмастер</a>
                <a class="type <?php if (isset($getRequest->usertip) && $getRequest->usertip == 40) echo "active"; ?> navigation-page" href="<?php echo build_pagination_url(1); ?>&usertip=40">Рекламодатель</a>
                <a class="type <?php if (isset($getRequest->usertip) && $getRequest->usertip == 60) echo "active"; ?> navigation-page" href="<?php echo build_pagination_url(1); ?>&usertip=60">Менеджер</a>
                <a class="type <?php if (isset($getRequest->usertip) && $getRequest->usertip == 70) echo "active"; ?> navigation-page" href="<?php echo build_pagination_url(1); ?>&usertip=70">Администратор</a>
                <a class="type <?php if (isset($getRequest->usertip) && $getRequest->usertip == 80) echo "active"; ?> navigation-page" href="<?php echo build_pagination_url(1); ?>&usertip=80">Оператор тех.поддержки</a>
            </p>                
        </div>         
	<?php
	if (isset($_GET['submit_search']) && isset($_GET['search_zapros']) && isset($_GET['search_type']) && $_GET['search_zapros']!='' && $_GET['search_type']!='')
		{
		?>
		<table class="stats_table" width="100%">
			<tr class="tableHead">
				<td colspan="11"><?php echo $loc['users.php']['t28']; ?></td>
			</tr>
			<tr class="tableHead">
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
		<p id="pag">
			<?php
			// Вывод количества страниц
			// Display the number of pages
			pagination($pagination_fetched_row,100,11);
			?>
		</p>
		<p>
			<table class="stats_table" width="100%">
				<tr class="tableHead">
					<td colspan="11"><?php echo $loc['users.php']['t40']; ?>&nbsp;[<a href="./adduser.php" class="normal_link"><?php echo $loc['users.php']['t41']; ?></a>]</td>
				</tr>
				<tr class="tableHead">
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
<script>
$(document).ready(function() {
    $("#rewards_all_show").on("click", function(e) {
        e.preventDefault();
        $('#js-ajax-content').css('margin-bottom','450px');
        $('.offers_list').show();
        var elementClick = $('.offers_list');
        var destination = $(elementClick).offset().top;
        jQuery("html:not(:animated),body:not(:animated)").animate({
          scrollTop: destination
        }, 800);
        return false;        
    });   
});
</script>

<?php
include ('./templates/'.$template.'/checkform/datepicker_addscript_10.php');
?>
