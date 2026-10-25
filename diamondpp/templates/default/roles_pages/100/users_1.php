<div class="row cabinet main mt-50 mb-50">

    <div class="col-12 mb-10"><p class="pageTitle mb-25"><?php echo $loc['users.php']['t01']; ?></p></div>

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
        'balance_all' => ( isset($_GET['balance_all']) ) ? $_GET['balance_all'] : '',
        'ip' => ( isset($_GET['ip']) ) ? $_GET['ip'] : '',
        'date_activity' => ( isset($_GET['date_activity']) ) ? $_GET['date_activity'] : '',
        'date_reg' => ( isset($_GET['date_reg']) ) ? $_GET['date_reg'] : '',
        'page' => $page
    );
    return '?' . http_build_query($parameters);
} 

    $perPage = 100;
    if (isset($getRequest->usertip) && is_numeric($getRequest->usertip) && $getRequest->usertip > 0) {
        $usersManager->where('tip', $getRequest->usertip);
    }  
    $byReg = "";
    if (isset($_GET['submit_search']) && isset($_GET['search_zapros']) && isset($_GET['search_type']) && $_GET['search_type']!=''){
        
        if($_GET['search_type'] != 'datereg'){
            $search_zapros= htmlentities($_GET['search_zapros']);
            if (isset($_GET['search_type']) && $_GET['search_type'] !='') {
                $search_type= htmlentities($_GET['search_type']);            
            }else{$search_type='email';}        
            if ($search_type!=''){                          

                $usersManager->where($search_type, $search_zapros);

            }
        }else{
            $byReg = " where date_registration between '". htmlentities($usersManager->dat1)." ".$DT."' AND '".htmlentities($usersManager->dat2)." ".$NT."'";
        }
    }
    
    $usersManager->byDate = " and date between '". htmlentities($usersManager->dat1)." ".$DT."' AND '".htmlentities($usersManager->dat2)." ".$NT."'";
    $usersManager->byReg = $byReg;
    
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
    if (isset($getRequest->balance_all)) {
        $type_sorts = htmlentities($getRequest->balance_all);
        $usersManager->sortBy('balance_all', $type_sorts);
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
    if (isset($getRequest->date_reg)) {
        $type_sorts = htmlentities($getRequest->date_reg);
        $usersManager->sortBy('date_registration', $type_sorts);
    } 
    
    $result = $usersManager->getUsersAdmin();
    $pagination_fetched_row = array('count' => $usersManager->getCountUsers());  

if (isset($_GET['edit']) && $_GET['edit']!=''){

	if (is_array($result) && count($result) > 0){
            foreach ($result as $res) {

		$cur_id=htmlentities($res['id']);
                $cur_login=htmlentities($res['login']);
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
                $cur_alias = htmlentities($res['alias']);
		$message_b=htmlentities($res['message_b']);
		$frod_check = $res['frod_check'];
                $hr_check = $res['hr_check'];
                $forecast_send_email = $res['f_send_mail'];
                $forecast_send_admin = $res['f_send_admin'];
                $send_to_admin = $res['send_to_admin'];
                
                        if (isset($_POST['send_to_admin']) && $_POST['send_to_admin']=='on') {$send_to_admin='1';} else {$send_to_admin='0';}
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
		<div class="col-12 mb-20">
                    <div class="card" style="min-height: auto;">
                    <div class="card-body">
			<b><?php echo $loc['users.php']['t02']; ?></b>&nbsp; <?php echo $cur_email; ?>  &nbsp;&nbsp;<a target="_blank" href="./tickets.php?komu=<?php echo $cur_id; ?>"><span class="send_ticket"></span></a>&nbsp;&nbsp;&nbsp; <b>Статус:</b>  
			
                       
                            
                        <?php
			if ($cur_active=='0') {
                        ?>
                        <font style="background: yellow; color: black;">&nbsp;<?php echo $loc['users.php']['t03']; ?>&nbsp;</font>
                        <?php
                        }
			if ($cur_active=='1') {
                        ?>
                        <font style="background: green; color: white;">&nbsp;<?php echo $loc['users.php']['t04']; ?>&nbsp;</font>
                        <?php
                        }
			if ($cur_active=='5') {
                        ?>
                        <font style="background: red; color: white;">&nbsp;<?php echo $loc['users.php']['t05']; ?>&nbsp;</font>
                        <?php
                        }		
                        echo "&nbsp; <b>ID:</b> $cur_id";
			?>
                        
                        <div class="form-group mt-20">
                            <b><?php echo $loc['users.php']['t53']; ?></b> <?php echo $cur_ip;	?>
                            
                        </div>

                        <div class="form-group">
                            <b><?php echo $loc['users.php']['t16']; ?></b>
                            <?php 
                            echo $cur_registration_date;
                            ?>
                        </div>  
                        
                        <div class="form-group">
                            <b><?php echo $loc['users.php']['t14']; ?></b>
                            <?php 
                            echo date('d.m.Y / H:m:s', $cur_date_activity = strtotime($cur_date_activity));
                            ?>
                        </div>
                  
                    </div>
                    </div>
                </div>
<div class="col-12 mb-20">
                    <div class="card" style="min-height: auto;">
                    <div class="card-body">
                <p style=""><b>Зарегистрирован по ютм меткам:</b></p>            

                <table class="table table-bordered text-center" width="100%">
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
                </div>
                        </div>
</div>
<div class="col-12 mb-20">
    <div class="card" style="min-height: auto;">
        <div class="card-body">
            <form name="edit_user" method="post" action="./users.php?<?php echo @$_SERVER['QUERY_STRING']; ?>">	
            <input type="hidden" name="ip" value="<?php echo $cur_ip; ?>">
            
            <div class="row">
                <div class="col-4">
                    <div class="form-group">
                      <label for="email"><?php echo $loc['users.php']['t06']; ?></label>
                      <input type="text" name="email" class="form-control" id="email" autocomplete=off value="<?php echo $cur_email; ?>">
                    </div>
                    <div class="form-group">
                      <label for="login">Логин в BD-CPA:</label>
                      <input type="text" class="form-control" name="login" id="login" value="<?php echo $cur_login; ?>">
                    </div>
                    <div class="form-group">
                      <label for="name"><?php echo $loc['users.php']['t08']; ?></label>
                      <input type="text" name="name" class="form-control" id="name" value="<?php echo $cur_name; ?>">
                    </div>
                    <div class="form-group">
                      <label for="phone"><?php echo $loc['users.php']['t09']; ?></label>
                      <input type="text" name="phone" class="form-control" id="phone" value="<?php echo $cur_phone; ?>">
                    </div>
                    <div class="form-group">
                      <label for="skype"><?php echo $loc['users.php']['t11']; ?></label>
                      <input type="text" name="skype" class="form-control" id="skype" value="<?php echo $cur_skype; ?>">
                    </div>
                    <div class="form-group">
                      <label for="telegram_login"><?php echo $loc['users.php']['t13']; ?></label>
                      <input type="text" name="telegram_login" class="form-control" id="icq" value="<?php echo $cur_icq; ?>">
                    </div>
                    <div class="form-group">
                      <label for="alias">Alias (псевдоним)</label>
                      <input type="text" name="alias" class="form-control" id="alias" value="<?php echo $cur_alias; ?>">
                    </div>
                    <div class="form-group">
                      <label for="password"><?php echo $loc['users.php']['t15']; ?></label>
                      <input type="text" name="password" class="form-control" id="password" value="" readonly onfocus="this.removeAttribute('readonly');">
                    </div>
                </div>  

                <div class="col-4">
                    <div class="form-group">
                      <label for="balance"><?php echo $loc['users.php']['t12']; ?></label>
                      <input type="text" name="balance" class="form-control" id="balance" value="<?php echo $cur_balance; ?>">
                    </div>
                    <div class="form-group">
                      <label for="hold"><?php echo $loc['users.php']['t10']; ?></label>
                      <input type="text" class="form-control" id="hold" value="<?php echo $cur_hold; ?>">
                    </div>
                    <div class="form-group">
                      <label for="hold_days"><?php echo $loc['users.php']['t68']; ?> (<?php echo $loc['users.php']['t69']; ?>):</label>
                      <input type="text" name="hold_days" class="form-control" id="hold_days" value="<?php $res['hold_days']; ?>">
                    </div>
                    <div class="form-group">
                      <label for="offers_reward_all"><?php echo $loc['users.php']['t71']; ?> (<?php echo $loc['users.php']['t72']; ?>):</label>
                      <input type="text" name="offers_reward_all" class="form-control" id="offers_reward_all" value="<?php $res['offers_reward_all']; ?>">
                    </div>
                    <?php if ($cur_tip_acc=='10'){ ?>  
                    <div class="form-group">
                        <label for="ref_program"><?php echo $loc['users.php']['t70']; ?>:</label>
                        <select name="ref_program" class="form-control">
                            <option value="0" <?php if($res['ref_program'] == 0){echo 'selected';} ?>>ВЫКЛ</option> 
                            <option value="1" <?php if($res['ref_program'] == 1){echo 'selected';} ?>>ВКЛ</option>  
                        </select>
                    </div>
                    <?php } ?>
                    <div class="form-group">
                        <label for="active"><?php echo $loc['users.php']['t17']; ?>:</label>
                        <select name="active" class="form-control">
                                <option value="0"<?php if ($cur_active=='0') {?>selected="selected"<?} ?>><?php echo $loc['users.php']['t18']; ?></option>
                                <option value="1"<?php if ($cur_active=='1') {?>selected="selected"<?} ?>><?php echo $loc['users.php']['t04']; ?></option>			
                                <option value="5"<?php if ($cur_active=='5') {?>selected="selected"<?} ?>><?php echo $loc['users.php']['t05']; ?></option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="tip"><?php echo $loc['users.php']['t19']; ?>:</label>
                        <select name="tip" class="form-control">
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
                    </div>
                    
                    <div class="form-group">
                    <?php if ($cur_tip_acc=='10' || $cur_tip_acc=='40') { ?>
                    
                        <label for="uroven_dostupa"><?php echo $loc['users.php']['t20']; ?>:</label>
                        <select name="uroven_dostupa" class="form-control">
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
                            <?php
                            }
                    ?>    
                    </div>
                                        
                                        
                </div> 
                
                <div class="col-4">
                    <div class="form-group mb-50">
                      <label for="comment">Заметки о пользователе:</label>
                      <textarea name="comment" class="form-control" id="comment" rows="7"><?php echo $res['comment'];  ?></textarea>
                    </div>
                    
                    <?php   if ($cur_tip_acc=='10'){ ?>  
                    <div class="form-group text-center">
                        <p><a style="cursor:pointer;" id="rewards_all_show"><b><?php echo $loc['users.php']['t73']; ?></p>
                                    

                            <?php if($cur_tip_acc == '10' && $cur_active!='0'){
                            $settings = Settings::getById(1);

                            $z = new Zakaz_Manager(DB::getInstance());
                            $z->where('user_id', $cur_id); 
                            $z->where('status', [1,2,3], Entity_Manager::WHERE_IN); 
                            $z->limit(-1);
                            $z->get();
                            $all_zakaz = $z->getTotal();           
                            ?>
                            <p>Заказы проверены <b style="font-size: 18px;color:green;"><?=$settings->date_check; ?></b></p>        
                            <p>Рейтинг доверия <b style="font-size: 18px;color:<?php if($res['rating'] >= $settings->percent_frod){echo 'green';}else{echo 'red';}; ?>;"><?=$res['rating']; ?></b></p>
                            <p>Всего лидов <b style="font-size: 18px;color:green;"><?=$all_zakaz; ?></b></p>
                            <p>Процент подозрительных <b style="font-size: 18px;color:<?php if($res['rating'] >= $settings->percent_frod){echo 'green';}else{echo 'red';}; ?>;"><?=(100 - $res['rating']); ?>%</b></p>
                            <?php
                            }
                            ?>
                    </div>      

                    <div class="custom-control custom-checkbox mt-50 text-center">
                      <input type="checkbox" name="checkingFrod" class="custom-control-input" id="checkingFrod" <?php if($frod_check == 1){echo 'checked';}?>>
                      <label class="custom-control-label" for="checkingFrod">
                          Проверен на фрод
                      </label>
                    </div>
                    
                    <div class="custom-control custom-checkbox text-center mt-15">
                      <input type="checkbox" name="hr_check" class="custom-control-input" id="hr_check"  <?php if($hr_check == 1){echo 'checked';}?>>
                      <label class="custom-control-label" for="hr_check">
                          Проверить лиды на доступность телефона
                      </label>
                    </div>                  
                    
                    <?php   } ?>  
                    
                    <?php   if ($cur_tip_acc=='40'){ ?>
                    
                    <div class="form-group">
                        <label for="status_rekl"><?php echo $loc['users.php']['t56']; ?></label>
                        <select name="status_rekl" class="form-control">

                                <option value="0" <?php if($type_rekl == 0){echo 'selected="selected"';} ?>><?php echo $loc['users.php']['t57']; ?></option>
                                <option value="1" <?php if($type_rekl == 1){echo 'selected="selected"';} ?>><?php echo $loc['users.php']['t58']; ?></option>

                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="message_b"><?php echo $loc['users.php']['t59']; ?></label>
                        <input type="text" name="message_b" id="message_b" class="form-control" value="<?php echo $message_b; ?>">
                    </div>

                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="send_to_admin" class="custom-control-input" id="send_to_admin" <?php if ($send_to_admin==1) {echo 'checked=checked';} ?>>
                      <label class="custom-control-label" for="send_to_admin">
                          <?php echo $loc['users.php']['t60']; ?>
                      </label>
                    </div>
                    
                    <p class="mt-50"><b>Прогноз бюджета:</b></p>
                    
                    <div class="form-group">
                        <label for="forecast_send_email">E-mail (через запятую):</label>
                        <textarea name="forecast_send_email" class="form-control"><?=$forecast_send_email; ?></textarea>
                    </div>
                    
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="forecast_send_admin" class="custom-control-input" id="forecast_send_email" <?php if($forecast_send_admin == 1){echo 'checked';}?>>
                      <label class="custom-control-label" for="forecast_send_email">
                          Отправлять если хватит менее чем на 3 дня
                      </label>
                    </div>
                                     
                    <?php   } ?>  
                    
                </div> 
                
            </div>   
            
            <input type="hidden" id="user_id" value="<?=$cur_id;?>">
            
            <?php   
            if ($cur_tip_acc=='10'){    
                $Paysys = new Paysys();
                $Paysys->setUser($id_edit);
                $user_paysys = $Paysys->getUserPaysys(); 
                if($user_paysys){
            ?>
                <div class="row">
                    <div class="col-4 text-center">
                    <?php
                    if($user_paysys->yandex != '' || $user_paysys->yandex != 0){
                        echo 'Yandex: '.$user_paysys->yandex; 
                    }else{
                    ?> 
                       Yandex не установлен 
                    <?php   
                    }
                    ?> 
                    </div>
                    <div class="col-4 text-center">
                    <?php
                    if($user_paysys->wmr != '' || $user_paysys->wmr != 0){
                        echo 'WMR: '.$user_paysys->wmr; 
                    }else{
                    ?> 
                       WMR не установлен 
                    <?php   
                    }
                    ?> 
                    </div>
                    <div class="col-4 text-center">
                    <?php
                    if($user_paysys->cards != '' || $user_paysys->cards != 0){
                        echo 'Карта: '.$user_paysys->cards; 
                    }else{
                    ?> 
                       Карта не установлена 
                    <?php   
                    }
                    ?> 
                    </div>
                </div>
            <?php   
                }
            } 
            ?> 
            
            <div class="row mt-50">
                <div class="col-12">
                    <div class="form-group">
                        <input type="button" name="return" class="btn button" value="<?php echo $loc['users.php']['t22']; ?>" onclick="document.location.href='users.php'">
                        <input type="submit" class="btn button" name="submit_user" value="<?php echo $loc['users.php']['t23']; ?>" onclick="if (!confirm('<?php echo $loc['users.php']['t24']; ?>'))return false;"><br /><br />
                        <input name="id" type="hidden" value="<?php echo htmlentities($id_edit); ?>">
                    </div>
                </div>
            </div>
            
            </form>
        </div>
    </div>
</div>    

	<script>

    $(document).on('change', '#checkingFrod', function () {
        var user = $('#user_id').val();
        $.ajax({
            url: './post/antifrod_check.php',
            type: 'POST',
            data: 'user='+user+'&check='+$(this).prop('checked')
        });
    })
	</script>                                


<div class="col-12 mb-10">      
                
                <table class="stats_table offers_list" style="margin-top:50px;display:none;width:1000px;">
                    <tr height="60" class="tableHead">
                        <td colspan="4">
                            <b>Отчисления по каждому офферу:</b>
                        </td>
                    </tr>

                    <tr height="60">
                        <td colspan="4">

                            <select id="offer_id_award" class="width-300 ">
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
</div>
<div class="col-12 mb-10">      
                    <?php
                    $user = new User;
                    $offers_list = $user->getByBonuses($cur_id); 
                    if(isset($offers_list) && is_array($offers_list)){
                    ?>    

                
                    <div id="js-ajax-content"></div>
                    <table class="stats_table offers_list" style="margin-top:50px;width:1000px;">   
                        <tr height="60" class="tableHead" >
                            <td style="border:none;" colspan="2" >
                                Оффер:
                            </td>
                            <td style="border:none;">Отчисления:</td>
                            <td style="border:none;">Дополнительно:</td>
                                 
                                
                            
                        </tr>                         
                    <?php  
                   
                    foreach($offers_list as $offers_arr){
                        $offer = Offer::getById($offers_arr[0]);
                        
                        $offer_comission = explode('|', trim($offer->comission)); 
                        $offer_tip_comission = explode('|', trim($offer->tip_comission));
                        $offer_geo = explode('|', trim($offer->geo));
                        $offer_country_iso_arr = explode(':', $offer_geo[0]);  
                        $dop_bonus = '';
                        $bonuses = '';
                        $bonuses[] = explode(',', trim($offers_arr[1]));
                        foreach($bonuses as $bonus){
                            foreach($bonus as $k=>$v){
                                $dop_bonus[] = explode('-', trim($v));
                            }
                        }              

                    ?>
                        <tr>
                            <td style="width: 120px;">
                                <a style="border: 0; text-decoration: none;" href="./offers.php?offer=<?=$offer->id; ?>"><img style="width:120px;margin: 10px;" src="./tmp/offer<?=$offer->id; ?>.jpg"></a>
                            </td>
                            <td>
                                <a href="./offers.php?offer=<?=$offer->id; ?>" target="_blank"><?=$offer->name; ?></a>
                            </td>
                            <td colspan="2">
                                <table style="width:80%;text-align:center;margin: 0 auto;">
                                <?php    
                                    if (isset($offer_comission)) {

                                        if (count($offer_tip_comission) > 0 && count($offer_tip_comission) == count($offer_comission)) {
                                            $i = 0;
                                            $iter = 0;
                                            foreach ($offer_country_iso_arr as $key => $val) {
                                                $iter++;
                                                if ($iter == 10) {
                                                    echo "<tr class=more{$offer->id} height=60><td style='border:none;margin-top:10px;' colspan=3><button class=\"others_button_vyvesti\" onclick=\"$('.more$offer->id').hide();$('.geo$offer->id').show();\" >Показать все</button></td></tr>";
                                                }
                                                echo '<tr class=geo' . $offer->id . ' height="25px" ' . (($iter >= 10) ? 'style="display:none"' : '') . '>';
                                                $sql_geo = "SELECT name_ru FROM sxgeo_country WHERE `iso`='$val'";
                                                $result_geo = $mysqli->query($sql_geo);
                                                if (mysqli_num_rows($result_geo) > 0) {
                                                    $res_geo = mysqli_fetch_array($result_geo);
                                                    $geo_country_name = htmlentities($res_geo['name_ru']);
                                                } else {
                                                    $geo_country_name = 'Без ограничений';
                                                }
                                                        $input_comission = 0;
                                                        foreach ($dop_bonus as $k=>$v){
                                                            if($v[0] == $val){
                                                                $input_comission = $v[1];  
                                                                break;
                                                            }   
                                                        }
                                                if (!empty($val)) {
                                                    echo '<td style="height: 20px;border:none;vertical-align:middle;padding:0;"><center><img style="display:block;" title="' . $geo_country_name . '" src=./modules/detectclient/SxGeo/img/' . strtolower($val) . '.png></center></td>';
                                                    if ($offer_tip_comission[$i] == 1) {
                                                        echo '<td style="height: auto;border:none;vertical-align:middle;padding:0;">' . ($offer_comission[$i]) . ' руб.';                                    
                                                        echo '</td>';
                                                        echo '<td style="float: right;height: auto;border:none;vertical-align:middle;padding:0;">'; 

                                                        echo '<input type="hidden" name="bonus_country[]" value="'.$val.'">';

                                                        echo '<input style="width: 65px;text-align:center;" type="text" name="comission[]" value="'.$input_comission.'">';
                                                        echo '</td>';
                                                    } elseif ($offer_tip_comission[$i] == 2) {
                                                        echo '<td style="height: auto;border:none;vertical-align:middle;padding:0;">' . ($offer_comission[$i]) . ' % </td>';
                                                    }
                                                } else {
                                                    if ($offer_tip_comission[$i] == 1) {
                                                        echo '<td style="height: auto;border:none;vertical-align:middle;padding:0;">' . ($offer_comission[$i]) . ' руб.</td>';
                                                        echo '<td style="float: right;height: auto;border:none;vertical-align:middle;padding:0;">'; 

                                                        echo '<input type="hidden" name="bonus_country[]" value="'.$val.'">';

                                                        echo '<input style="width: 65px;text-align:center;" type="text" name="comission[]" value="'.$input_comission.'">';
                                                        echo '</td>';                                                        
                                                    } elseif ($offer_tip_comission[$i] == 2) {
                                                        echo '<td style="height: auto;border:none;vertical-align:middle;padding:0;">';
                                                        echo ($offer_comission[$i]) . ' %</td>';
                                                    }
                                                }
                                                echo '</tr>';
                                                $i++;
                                            }
                                        }
                                    } else {
                                        echo '<tr><td style="height: auto;border:none;vertical-align:middle;padding:0;">-</td></tr>';
                                    }
                                    ?>
                                </table>
                            </td>
                        </tr>

                        <?php
                    }
                    }
                    ?>  
                      
                    </td>
                    </tr>
                     
                </table>
</div>
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
                
                
		<?php
            }
        }else{
            echo $loc['users.php']['t25'];
	}
}else{
	?>
        <div class="col-12 mb-10">
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
				<select name="search_type" class="width-200">
                                        <option <?php if (!$getRequest->search_type or $getRequest->search_type == 0) echo ' selected '; ?> value="0"><?php echo $loc['offers.php']['filter_field_category_select']; ?></option>
					<option class="options" value="email" <?php if (isset($getRequest->search_type) && $getRequest->search_type=='email') {echo 'selected="selected"';} ?>><?php echo $loc['users.php']['t29']; ?></option>
                                        <option class="options" value="id" <?php if (isset($getRequest->search_type) && $getRequest->search_type=='id') {echo 'selected="selected"';} ?>><?php echo $loc['users.php']['t61']; ?></option>
                                        <option class="options" value="datereg" <?php if (isset($getRequest->search_type) && $getRequest->search_type=='datereg') {echo 'selected="selected"';} ?>>По дате регистрации</option>
                                        <option class="options" value="utm_source" <?php if (isset($getRequest->search_type) && $getRequest->search_type=='utm_source') {echo 'selected="selected"';} ?>>Поиск по utm source</option>
                                        <option class="options" value="utm_medium" <?php if (isset($getRequest->search_type) && $getRequest->search_type=='utm_medium') {echo 'selected="selected"';} ?>>Поиск по utm medium</option>
                                        <option class="options" value="utm_campaign" <?php if (isset($getRequest->search_type) && $getRequest->search_type=='utm_campaign') {echo 'selected="selected"';} ?>>Поиск по utm campaign</option>
                                        <option class="options" value="utm_term" <?php if (isset($getRequest->search_type) && $getRequest->search_type=='utm_term') {echo 'selected="selected"';} ?>>Поиск по utm term</option>
                                        <option class="options" value="utm_content" <?php if (isset($getRequest->search_type) && $getRequest->search_type=='utm_content') {echo 'selected="selected"';} ?>>Поиск по utm content</option>
				</select>
                                &nbsp;&nbsp;&nbsp;&nbsp;
				<span>
					<b><?php echo $loc['stats.php']['t02']; ?>&nbsp;</b>
					<input type="text" name="date" id="datepicker" style="text-align: center; width: 200px;" readonly />
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
	</div>
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
        <div class="col-12 mb-10">             
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
<div class="col-12 mb-10">
		<table class="stats_table" width="100%">
			<tr class="tableHead">
				<td colspan="13"><?php echo $loc['users.php']['t28']; ?></td>
			</tr>
			<tr class="tableHead">
				<td><?php echo $loc['users.php']['t30']; ?></td>	
				<td><?php echo $loc['users.php']['t31']; ?></td>
				<td><?php echo $loc['users.php']['t32']; ?></td>
				<td><?php echo $loc['users.php']['t33']; ?></td>
                                <td>Итого</td>
                                <td><?php echo $loc['users.php']['t63']; ?></td>
                                <td><?php echo $loc['users.php']['t64']; ?></td>
				<td><?php echo $loc['users.php']['t34']; ?></td>			
				<td><?php echo $loc['users.php']['t35']; ?></td>		
				<td><?php echo $loc['users.php']['t36']; ?></td>
				<td><?php echo $loc['users.php']['t37']; ?></td>
                                <td>Дата регистрации</td>	
				<td><?php echo $loc['users.php']['t38']; ?></td>				
			</tr>
			<?php
			$cvet=0;
			if (is_array($result) && count($result) > 0){ 
				$settings = Settings::getById(1);
				foreach ($result as $res) { 
					
					$cur_id=htmlentities($res['id']);
					$cur_email=htmlentities($res['email']);
                                        $frod_check=htmlentities($res['frod_check']);
					$cur_hold=htmlentities($res['hold']);
					$cur_balance=htmlentities($res['balance']);	
					$cur_tip_acc=htmlentities($res['tip']);
					$cur_uroven_dostupa=htmlentities($res['uroven_dostupa']);
                                        $cur_balance_all=$cur_balance+$cur_hold;
					$cur_ip=htmlentities($res['ip']);
					$cur_date_activity=htmlentities($res['date_activity']);
                                        $cur_hosts=htmlentities($res['hosts']);
                                        $cur_lids=htmlentities($res['orders']); 
                                        $date_reg=htmlentities($res['date_registration']); 
                                        if($frod_check == 1){
                                            $check = '<img title="проверен на фрод ручная" src="./templates/default/img/yes.png" width="20px"> &nbsp&nbsp';
                                        }else{
                                            $check = '';
                                        }
                                        $frod = '';
                                        if($res['rating'] >= $settings->percent_frod){
                                            $frod = '<img title="авто проверка на фрод" src="./templates/default/img-new/xigoqqn5T.png" width="20px"> &nbsp&nbsp';
                                        }else{
                                            $frod = '<img title="авто проверка на фрод" src="./templates/default/img-new/al.png" width="20px"> &nbsp&nbsp';
                                        }
                                        
                                        
					?> 
					<tr class="<?php if ( $cvet & 1 ) {echo 'col2';} else {echo '';} $cvet++; ?>">
						<td><?php echo $cur_id; ?></td>
						<td><?php if($cur_tip_acc == 10 && $cur_active!='0'){ echo $frod.' ';echo $check;}  echo $cur_email; ?></td>
						<td><?php echo $cur_hold; ?></td>
						<td><?php echo $cur_balance; ?></td>
                                                <td><?php echo $cur_balance_all; ?></td>
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
						<td>
							<?php echo $date_reg; ?>
						</td>                                                
						<td>

<a href=/?al&id=<?php echo $cur_id;?>&hash=<?php echo md5($cur_id.'autologin123123');?>&adm=<?=$user_id?>>AL</a> |

<a href="users.php?edit=<?php echo $cur_id; ?>"><?php echo $loc['users.php']['t65']; ?></a>&nbsp;|&nbsp;<a href="stats.php?webmaster=<?php echo $cur_id; ?>"><?php echo $loc['users.php']['t66']; ?></a>&nbsp;|&nbsp;<a target="_blank" href="./tickets.php?komu=<?php echo $cur_id; ?>"><span class="send_ticket"></span></a></td>
					</tr>
					<?php
				}
                        }
			?>  
		</table>
</div>
		<?php
		}
	else
		{  
		?>
<div class="col-12 mb-10">
		<p id="pag">
			<?php
			// Вывод количества страниц
			// Display the number of pages
			pagination($pagination_fetched_row,100,11);
			?>
		</p>

			<table class="stats_table" width="100%">
				<tr class="tableHead">
					<td colspan="13"><?php echo $loc['users.php']['t40']; ?>&nbsp;[<a href="./adduser.php" class="normal_link"><?php echo $loc['users.php']['t41']; ?></a>]</td>
				</tr>
				<tr class="tableHead">
					<td><nobr><a href="users.php<?php echo build_pagination_url(); ?>&&id=<?php if (isset($_GET['id']) && $_GET['id']=='desc') {echo "asc";} else {echo "desc";} ?>"><?php echo $loc['users.php']['t30']; ?></a></nobr></td>	
					<td><nobr><?php echo $loc['users.php']['t31']; ?></nobr></td>
					<td><nobr><a href="users.php<?php echo build_pagination_url(); ?>&hold=<?php if (isset($_GET['hold']) && $_GET['hold']=='desc') {echo "asc";} else {echo "desc";} ?>"><?php echo $loc['users.php']['t32']; ?></a></nobr></td>
					<td><nobr><a href="users.php<?php echo build_pagination_url(); ?>&balance=<?php if (isset($_GET['balance']) && $_GET['balance']=='desc') {echo "asc";} else {echo "desc";} ?>"><?php echo $loc['users.php']['t33']; ?></a></nobr></td>
					<td><nobr><a href="users.php<?php echo build_pagination_url(); ?>&balance_all=<?php if (isset($_GET['balance_all']) && $_GET['balance_all']=='desc') {echo "asc";} else {echo "desc";} ?>">Итого</a></nobr></td>
                        
                                        <td><nobr><a href="users.php<?php echo build_pagination_url(); ?>&hosts=<?php if (isset($_GET['hosts']) && $_GET['hosts']=='desc') {echo "asc";} else {echo "desc";} ?>"><?php echo $loc['users.php']['t63']; ?></a></nobr></td>
                                        <td><nobr><a href="users.php<?php echo build_pagination_url(); ?>&lids=<?php if (isset($_GET['lids']) && $_GET['lids']=='desc') {echo "asc";} else {echo "desc";} ?>"><?php echo $loc['users.php']['t64']; ?></a></nobr></td>

					<td><nobr><a href="users.php<?php echo build_pagination_url(); ?>&tip=<?php if (isset($_GET['tip']) && $_GET['tip']=='desc') {echo "asc";} else {echo "desc";} ?>"><?php echo $loc['users.php']['t34']; ?></a></nobr></td>			
					<td><nobr><a href="users.php<?php echo build_pagination_url(); ?>&dostup=<?php if (isset($_GET['dostup']) && $_GET['dostup']=='desc') {echo "asc";} else {echo "desc";} ?>"><?php echo $loc['users.php']['t67']; ?></a></nobr></td>		
					<td><nobr><a href="users.php<?php echo build_pagination_url(); ?>&ip=<?php if (isset($_GET['ip']) && $_GET['ip']=='desc') {echo "asc";} else {echo "desc";} ?>"><?php echo $loc['users.php']['t36']; ?></a></nobr></td>
					<td><nobr><a href="users.php<?php echo build_pagination_url(); ?>&date_activity=<?php if (isset($_GET['date_activity']) && $_GET['date_activity']=='desc') {echo "asc";} else {echo "desc";} ?>"><?php echo $loc['users.php']['t37']; ?></a></nobr></td>		
					<td><nobr><a href="users.php<?php echo build_pagination_url(); ?>&date_reg=<?php if (isset($_GET['date_reg']) && $_GET['date_reg']=='desc') {echo "asc";} else {echo "desc";} ?>">Дата регистрации</a></nobr></td>		
                                        <td><nobr><?php echo $loc['users.php']['t38']; ?></nobr></td>		
				</tr>
				<?php

                                
				$cvet=0;
				if (is_array($result) && count($result) > 0) {
					$settings = Settings::getById(1);
					foreach ($result as $res) {
						 
						$cur_id=htmlentities($res['id']);
						$cur_email=htmlentities($res['email']);
						$cur_active=htmlentities($res['active']);
						$cur_hold=htmlentities($res['hold']);
						$cur_balance=htmlentities($res['balance']); 
                                                $cur_balance_all=$cur_balance+$cur_hold;
						$cur_tip_acc=htmlentities($res['tip']);
						$cur_uroven_dostupa=htmlentities($res['uroven_dostupa']);
						$cur_ip=htmlentities($res['ip']);
						$cur_date_activity=htmlentities($res['date_activity']);
                                                $date_reg=htmlentities($res['date_registration']);
                                                $frod_check=htmlentities($res['frod_check']);
                                                if($frod_check == 1){
                                                    $check = '<img title="Ручная проверка на фрод" src="./templates/default/img/yes.png" width="20px"> &nbsp&nbsp';
                                                }else{
                                                    $check = '';
                                                }                                                
                                                if($res['rating'] >= $settings->percent_frod){
                                                    $frod = '<img title="Авто проверка на фрод" src="./templates/default/img-new/xigoqqn5T.png" width="20px"> &nbsp&nbsp';
                                                }else{
                                                    $frod = '<img title="Авто проверка на фрод" src="./templates/default/img-new/al.png" width="20px"> &nbsp&nbsp';
                                                }                                                
                                                $cur_hosts=htmlentities($res['hosts']);
                                                $cur_lids=htmlentities($res['orders']);                                                
						?> 
						<tr class="<?php if ( $cvet & 1 ) {echo 'col2';} else {echo '';} $cvet++; ?>">
							<td style="<?php
                                                                    if ($cur_active=='0') { ?> background: yellow; color: black; <?php }
                                                                    if ($cur_active=='1') {?> background: green; color: white; <?php }
                                                                    if ($cur_active=='5') {?> background: red; color: white; <?php } 
                                                                    ?>"><nobr><?php echo $cur_id; ?></nobr>
							</td>
                                                        <td><nobr><?php if($cur_tip_acc == 10 && $cur_active!='0'){ echo $frod.' ';echo $check;}  echo $cur_email; ?></nobr></td>
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
									if ($cur_tip_acc=='70')
										{echo $loc['users.php']['t21'];}
									else
										{echo $cur_balance_all;}									
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
                                                        <td>
                                                                <?php echo date('d.m.Y / H:m:s', strtotime($date_reg)); ?>
                                                        </td>                         
							<td><nobr>
<a href=/?al&id=<?php echo $cur_id;?>&hash=<?php echo md5($cur_id.'autologin123123');?>&adm=<?=$user_id?>>AL</a> | 

<a href="users.php?edit=<?php echo $cur_id; ?>"><?php echo $loc['users.php']['t65']; ?></a>&nbsp;|&nbsp;<a href="stats.php?webmaster=<?php echo $cur_id; ?>"><?php echo $loc['users.php']['t66']; ?></a>&nbsp;|&nbsp;<a target="_blank" href="./tickets.php?komu=<?php echo $cur_id; ?>"><span class="send_ticket"></span></a></nobr></td>
						</tr>
						<?php
						}
					}
				?>  
			</table>

		<p>
			<?php
			// Вывод количества страниц
			// Display the number of pages
			pagination($pagination_fetched_row,100,11);
			?>
		</p>
</div>              
		<?php
		}
	}
?>
<script>
$(document).ready(function() {
    $("#rewards_all_show").on("click", function(e) {
        e.preventDefault();
        $('#js-ajax-content').css('margin-bottom','50px');
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
</div>