<div class="row main mt-50 mb-50">

    <link href="./templates/<?php echo $template; ?>/css/chat.css" rel="stylesheet">
    
    

    <?php
    
    include_once './includes/errors.php';
    
    if (isset($_GET['xtext']) && $_GET['xtext'] == '1') {
        $error_message = $loc['tickets.php']['t02'];$error_type = 'success';
    }
    if (isset($_GET['xtext']) && $_GET['xtext'] == '2') {
        $error_message = $loc['tickets.php']['t03'];$error_type = 'error';
    }
    if (isset($_GET['xtext']) && $_GET['xtext'] == '3') {
        $error_message = $loc['tickets.php']['t04'];$error_type = 'error';
    }
    if (isset($_GET['xtext']) && $_GET['xtext'] == '4') {
        $error_message = $loc['tickets.php']['t05'];$error_type = 'success';
    }
    if (isset($_GET['xtext']) && $_GET['xtext'] == '5') {
        $error_message = $loc['tickets.php']['t06'];$error_type = 'success';
    }
    if (isset($_GET['xtext']) && $_GET['xtext'] == '6') {
        $error_message = $loc['tickets.php']['t07'];$error_type = 'error';
    }
    if (isset($_GET['xtext']) && $_GET['xtext'] == '7') {
        $error_message = $loc['tickets.php']['t08'];$error_type = 'success';
    }
    if (isset($_GET['xtext']) && $_GET['xtext'] == '8') {
        $error_message = $loc['tickets.php']['t09'];$error_type = 'error';
    }

// Подготавливаем часть MySQL-запроса в зависимости от того пользователь является админом или нет
// Prepare part of the MySQL-query, depending on whether the user is an administrator or not
if ($user_tip != '70') {
    $uid = "`ot_kogo`='$user_id' AND";
} else {
    $uid = '';
}
?>

<?php
// Если был вызван для просмотра выбранный тикет, то открываем его
// If there was summoned to view the selected ticket, then open it
if (isset($_GET['ticket']) && $_GET['ticket'] != '') {
    $ticket_id = htmlentities($_GET['ticket']);

    // Получаем данные тикета
    // Get the ticket data
    $sql_tickets = "SELECT * FROM tickets WHERE (`komu`='all' AND `id`='$ticket_id') OR (`komu`='$user_id' AND `id`='$ticket_id') OR (" . $uid . " `id`='$ticket_id')";
    $result_tickets = $mysqli->query($sql_tickets);
    
?>

    
 <?php   
    if (mysqli_num_rows($result_tickets) > 0) {
        while ($res_tickets = mysqli_fetch_array($result_tickets)) {

                $ticket_id = htmlentities($res_tickets['id']);
                $ticket_theme = htmlentities($res_tickets['theme']);
                $ticket_text = htmlentities($res_tickets['text']);
                $ticket_ot_kogo = htmlentities($res_tickets['ot_kogo']);
                $ticket_status = htmlentities($res_tickets['status']);
                $ticket_date = htmlentities($res_tickets['date']);
                $ticket_komu = htmlentities($res_tickets['komu']);
                

                // Получаем данные об пользователе отправившем тикет
                // Get the user to send data on the ticket
                $sql_user_data = "SELECT login,email,tip,avatar FROM users WHERE `id`='$ticket_ot_kogo'";
                $result_user_data = $mysqli->query($sql_user_data);
                $res_user_data = mysqli_fetch_array($result_user_data);
                $user_data_login = htmlentities($res_user_data['login']);
                $user_data_email = htmlentities($res_user_data['email']);
                $user_data_tip = htmlentities($res_user_data['tip']);
                $user_data_ava = htmlentities($res_user_data['avatar']);

                // Определяем буквенное название роли пользователя
                // Determine the literal name of the user role
                $sql_uroven = "SELECT title FROM users_roles_tpl WHERE `tip`='$user_data_tip'";
                $result_uroven = $mysqli->query($sql_uroven);
                $res_uroven = mysqli_fetch_array($result_uroven);
                $user_tip_ticket_reply = htmlentities($res_uroven['title']);
                ?> 

<div class="col-12 mb-10"><p class="pageTitle mb-25"><?php echo $ticket_theme; ?></p></div>

<div class="col-12 mb-10 chat">
    
		<div class="messages">
                    <ul>
                        <li class="sent">
                            <img src="./tmp/avatars/<?=$user_data_ava; ?>" alt="" />
                            <p>
                                <b><?=$user_data_login; ?></b>:<br><?php echo html_entity_decode($ticket_text, ENT_QUOTES, 'utf-8'); ?>
                                <br>
                                <small><?php echo date('d.m.Y / H:i:s', strtotime($ticket_date)); ?></small>
                            </p>
                        </li>

            <?php
        }
        // Получаем данные ответов на тикет (если они есть)
        // Get the response data on the ticket (if any)
        $sql_ticket_reply = "SELECT * FROM tickets_reply WHERE `ticket_id`='$ticket_id' ORDER BY `id` asc";
        $result_ticket_reply = $mysqli->query($sql_ticket_reply);
        if (mysqli_num_rows($result_ticket_reply) > 0) {

            while ($res_ticket_reply = mysqli_fetch_array($result_ticket_reply)) {
                $ticket_reply_date = htmlentities($res_ticket_reply['date']);
                $ticket_reply_ot_kogo = htmlentities($res_ticket_reply['ot_kogo']);
                $ticket_reply_text = htmlentities($res_ticket_reply['text']);

                // Получаем данные об пользователе отправившем тикет
                // Get the user to send data on the ticket
                $sql_user_data = "SELECT login,email,tip,avatar FROM users WHERE `id`='$ticket_reply_ot_kogo'";
                $result_user_data = $mysqli->query($sql_user_data);
                $res_user_data = mysqli_fetch_array($result_user_data);
                $user_login_ticket_reply = htmlentities($res_user_data['login']);
                $user_email_ticket_reply = htmlentities($res_user_data['email']);
                $user_tip_id_ticket_reply = htmlentities($res_user_data['tip']);
                $user_ava_ticket_reply = htmlentities($res_user_data['avatar']);

                // Определяем буквенное название роли пользователя
                // Determine the literal name of the user role
                $sql_uroven = "SELECT title FROM users_roles_tpl WHERE `tip`='$user_tip_id_ticket_reply'";
                $result_uroven = $mysqli->query($sql_uroven);
                $res_uroven = mysqli_fetch_array($result_uroven);
                $user_tip_ticket_reply = htmlentities($res_uroven['title']);
                

                    $is_admin = false;
                    if ($user_tip_id_ticket_reply == '70' && $user_tip == '70' || ($user_tip_id_ticket_reply != '70' && $user_tip == '70')) {
                        $is_admin = true;
                        $cl = 'replies';
                    } else {
                        if ($ticket_reply_ot_kogo == $user_id) {
                            $cl = 'sent';
                            
                        } else {
                            $cl = 'replies';
                            $is_admin = true;

                        }
                    }

                ?>
                        
                        <li class="<?=$cl; ?>">
                            <img src="./tmp/avatars/<?=$user_ava_ticket_reply; ?>" alt="" />
                            <p>
                                <b><?=$user_login_ticket_reply; ?></b>:<br><?php echo html_entity_decode($ticket_reply_text, ENT_QUOTES, 'utf-8'); ?>
                                <br>
                                <small><?php echo date('d.m.Y / H:i:s', strtotime($ticket_reply_date)); ?></small>
                            </p>
                        </li>

                <?php
            }
        }
        ?>
                    </ul>
		</div>
        <?php
        if ($ticket_komu != 'all') {

            include ('./templates/' . $template . '/checkform/jquery.proverka.ticket_reply.form.php');
        ?>
        <div class="message-input">
            <form name="form_ticket_reply" method="post">
                <input type="hidden" name="ticket_id" value="<?php echo $ticket_id; ?>">
                <div class="wrap">
                <input type="text" name="text" required maxlength="500" placeholder="<?php echo $loc['tickets.php']['t23']; ?>" />
                <button class="submit" name="form_ticket_reply_submit"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                </div>
            </form>
        </div>
</div>
	
            <?php
        }
    }
}
// Если НЕ был вызван для просмотра выбранный тикет, выводим общий список тикетов
// If not, was called to view the selected ticket, we derive a general list of tickets
else {
    ?>
<div class="col-12 mb-10"><p class="pageTitle mb-25"><?php echo $loc['tickets.php']['t01']; ?></p></div>

<div class="col-12 mb-10">
        <?php
        if ($user_tip == '70' && isset($_GET['komu']) && $_GET['komu'] != '') {
            ?>

            <?php
            include ('./templates/' . $template . '/checkform/jquery.proverka.tickets.form.php');
            ?>

        <form name="form_tickets" method="post">
            <p>
                <b><?php echo $loc['tickets.php']['t25']; ?></b><br />
                <input type="text" name="theme" value="" class="input_theme_support" maxlength="80" required >
            </p>
            <p>
                <b><?php echo $loc['tickets.php']['t26']; ?></b><br />
                <script>
                    function limitText(limitField, limitCount, limitNum)
                    {
                        if (limitField.value.length > limitNum)
                        {
                            limitField.value = limitField.value.substring(0, limitNum);
                        } else
                        {
                            limitCount.value = limitNum - limitField.value.length;
                        }
                    }
                </script>
                <textarea name="text" class="textarea_theme_support" maxlength="500" onKeyDown="limitText(this, this.form.count, 500);"  onKeyUp="limitText(this, this.form.count, 500);" required ></textarea>
            </p>
            <p>
                <b><?php echo $loc['tickets.php']['t27']; ?></b><br />
                <select name="komu" class="select_theme_support">
                    <?php
                    if (isset($_GET['komu']) && $_GET['komu'] != '') {
                        $komu = htmlentities($_GET['komu']);
                        // Получаем данные об пользователе отправившем тикет
                        // Get the user to send data on the ticket
                        $sql_user_data = "SELECT email FROM users WHERE `id`='$komu'";
                        $result_user_data = $mysqli->query($sql_user_data);
                        $res_user_data = mysqli_fetch_array($result_user_data);
                        $user_data_email = htmlentities($res_user_data['email']);
                        ?>
                        <option value="<?php echo $komu; ?>"><?php echo $user_data_email; ?></option>
                        <?php
                    }
                    ?>
                </select>
            </p>
            <p>
                <input type="submit" name="form_tickets_submit" value="<?php echo $loc['button']['t04']; ?>" class="others_button_sendmessage"><span class="count_theme_support"><input readonly type="text" name="count" size="3" value="500">&nbsp;<?php echo $loc['tickets.php']['t24']; ?></span>
            </p>
        </form>
        <?php
    } elseif ($user_tip != '70' && isset($_GET['new'])) {
        ?>

        <?php
        include ('./templates/' . $template . '/checkform/jquery.proverka.tickets.form.php');
        ?>			

        <form name="form_tickets" style="width: 300px;" method="post">
            
            <div class="form-group">
              <label for="theme"><?php echo $loc['tickets.php']['t25']; ?></label>
              <input type="text" class="form-control" name="theme" id="theme" value="<?php if(isset($_GET['levelup'])){echo 'Повышение уровня вебмастера';} ?>" maxlength="80" required >
            </div>
            
                <script>
                    function limitText(limitField, limitCount, limitNum)
                    {
                        if (limitField.value.length > limitNum)
                        {
                            limitField.value = limitField.value.substring(0, limitNum);
                        } else
                        {
                            limitCount.value = limitNum - limitField.value.length;
                        }
                    }
                </script>
           
            <div class="form-group">
                <label for="theme"><?php echo $loc['tickets.php']['t26']; ?></label>
                <textarea name="text" class="form-control" maxlength="500" onKeyDown="limitText(this, this.form.count, 500);"  onKeyUp="limitText(this, this.form.count, 500);" required ><?php if(isset($_GET['levelup'])){echo 'Здравствуйте, прошу вас повысить мой уровень вебмастера до продвинутый';} ?></textarea>
            </div>
                <p>
                <span class="count_theme_support"><input readonly type="text" name="count" size="3" value="500">&nbsp;<?php echo $loc['tickets.php']['t24']; ?></span>
                </p>
            <p>
                <b><?php echo $loc['tickets.php']['t27']; ?></b>&nbsp;<?php echo $loc['tickets.php']['t28']; ?>
            </p>
            
            <div class="form-group">
              <input type="submit" name="form_tickets_submit" value="<?php echo $loc['button']['t04']; ?>" class="btn button">
              
            </div>

        </form>
        <?php
        
    }
    if (!isset($_GET['new'])) {
        // Вывод в зависимости от того, вызываются открытые или закрытые тикеты
        // Display depending on whether open or closed are called tickets
        if (isset($_GET['closed'])) {
            echo '<a  href="./tickets.php"><button class="btn button">' . $loc['tickets.php']['t30'] . '</button></a>';
            if ($user_tip != '70') {
                echo '<a style="margin-left:50px;" class="ticketsType" href="./tickets.php?new"><button class="btn button">' . $loc['tickets.php']['t33'] . '</button></a>';
            }    
            echo '<p class="postTitle" style="margin-top:50px;"><span>'. $loc['tickets.php']['t29'] .'</span></p>';           
            $cur_status = '0';
        } else {
            echo '<a  href="./tickets.php?closed"><button class="btn button">' . $loc['tickets.php']['t32'] . '</button></a>';
            if ($user_tip != '70') {
                echo '<a style="margin-left:50px;" href="./tickets.php?new"><button class="btn button">' . $loc['tickets.php']['t33'] . '</button></a>';
            }            
            echo '<p class="postTitle" style="margin-top:50px;"><span>'. $loc['tickets.php']['t31'] .'</span></p>';           
            $cur_status = '1';
        }
        
        $result = $mysqli->query("SELECT COUNT(id) AS count FROM `tickets` WHERE (`komu`='all' AND `status`='$cur_status') OR (`komu`='$user_id' AND `status`='$cur_status') OR (" . $uid . " `status`='$cur_status')");

        function build_pagination_url($page) {
            $parameters = array('page' => $page);
            return '?' . http_build_query($parameters);
        }

        // Вывод количества страниц
        // Display the number of pages
        pagination($result, 20, 11);
        ?>	

    <table class="table " width="100%">
        <tr class="tableHead">
            <th>#</td>
            <th><?php echo $loc['tickets.php']['t11']; ?></th>
            <th><?php echo $loc['tickets.php']['t12']; ?></th>
            <th><?php echo $loc['tickets.php']['t13']; ?></th>
            <th><?php echo $loc['tickets.php']['t14']; ?></th>
        </tr>
        <?php
        // Получаем данные тикета
        // Get the ticket data
        if (isset($offset) && isset($show_pages)) {
            $sql_tickets = "SELECT * FROM tickets WHERE (`komu`='all' AND `status`='$cur_status') OR (`komu`='$user_id' AND `status`='$cur_status') OR (" . $uid . " `status`='$cur_status') ORDER BY `id` DESC LIMIT $offset, $show_pages";
        } else {
            $sql_tickets = "SELECT * FROM tickets WHERE (`komu`='all' AND `status`='$cur_status') OR (`komu`='$user_id' AND `status`='$cur_status') OR (" . $uid . " `status`='$cur_status') ORDER BY `id` DESC";
        }
        $result_tickets = $mysqli->query($sql_tickets);
        if (mysqli_num_rows($result_tickets) > 0) {
            while ($res_tickets = mysqli_fetch_array($result_tickets)) {
                $ticket_id = htmlentities($res_tickets['id']);
                $ticket_theme = htmlentities($res_tickets['theme']);
                $ticket_ot_kogo = htmlentities($res_tickets['ot_kogo']);
                $ticket_komu = htmlentities($res_tickets['komu']);
                $ticket_status = htmlentities($res_tickets['status']);

                // Получаем данные об пользователе отправившем тикет
                // Get the user to send data on the ticket
                $sql_user_data = "SELECT email,tip FROM users WHERE `id`='$ticket_ot_kogo'";
                $result_user_data = $mysqli->query($sql_user_data);

                $res_user_data = mysqli_fetch_array($result_user_data);
                $user_email = htmlentities($res_user_data['email']);
                $user_tip_id_ticket_reply = htmlentities($res_user_data['tip']);

                // Определяем буквенное название роли пользователя
                // Determine the literal name of the user role
                $sql_uroven = "SELECT title FROM users_roles_tpl WHERE `tip`='$user_tip_id_ticket_reply'";
                $result_uroven = $mysqli->query($sql_uroven);
                $res_uroven = mysqli_fetch_array($result_uroven);
                $user_tip_ticket_reply = htmlentities($res_uroven['title']);
                ?> 
                <tr style="<?php
            if ($user_tip == '70' && $ticket_ot_kogo != $user_id) {
                // Получаем данные ответов на тикет (если они есть)
                // Get the response data on the ticket (if any)
                $sql_ticket_reply = "SELECT * FROM tickets_reply WHERE `ticket_id`='$ticket_id' ORDER BY `id` DESC";
                $result_ticket_reply = $mysqli->query($sql_ticket_reply);
                if (mysqli_num_rows($result_ticket_reply) > 0) {
                    $res_ticket_reply = mysqli_fetch_array($result_ticket_reply);
                    $ticket_reply_ot_kogo = htmlentities($res_ticket_reply['ot_kogo']);
                    if ($ticket_reply_ot_kogo != $user_id) {
                        if (!isset($_GET['closed'])) {
                            echo 'background: #abbdd7;';
                        }
                    }
                } else {
                    if (!isset($_GET['closed'])) {
                        echo 'background: #abbdd7;';
                    }
                }
            } elseif ($user_tip == '70' && $ticket_komu != $user_id) {
                // Получаем данные ответов на тикет (если они есть)
                // Get the response data on the ticket (if any)
                $sql_ticket_reply = "SELECT * FROM tickets_reply WHERE `ticket_id`='$ticket_id' ORDER BY `id` DESC";
                $result_ticket_reply = $mysqli->query($sql_ticket_reply);
                if (mysqli_num_rows($result_ticket_reply) > 0) {
                    $res_ticket_reply = mysqli_fetch_array($result_ticket_reply);
                    $ticket_reply_ot_kogo = htmlentities($res_ticket_reply['ot_kogo']);
                    if ($ticket_reply_ot_kogo != $user_id) {
                        if (!isset($_GET['closed'])) {
                            echo 'background: #abbdd7;';
                        }
                    }
                }
            } elseif ($user_tip != '70' && $ticket_ot_kogo == $user_id) {
                // Получаем данные ответов на тикет (если они есть)
                // Get the response data on the ticket (if any)
                $sql_ticket_reply = "SELECT * FROM tickets_reply WHERE `ticket_id`='$ticket_id' ORDER BY `id` DESC";
                $result_ticket_reply = $mysqli->query($sql_ticket_reply);
                if (mysqli_num_rows($result_ticket_reply) > 0) {
                    $res_ticket_reply = mysqli_fetch_array($result_ticket_reply);
                    $ticket_reply_ot_kogo = htmlentities($res_ticket_reply['ot_kogo']);
                    if ($ticket_reply_ot_kogo != $user_id) {
                        if (!isset($_GET['closed'])) {
                            echo 'background: #abbdd7;';
                        }
                    }
                }
            } elseif ($user_tip != '70' && $ticket_komu == $user_id) {
                // Получаем данные ответов на тикет (если они есть)
                // Get the response data on the ticket (if any)
                $sql_ticket_reply = "SELECT * FROM tickets_reply WHERE `ticket_id`='$ticket_id' ORDER BY `id` DESC";
                $result_ticket_reply = $mysqli->query($sql_ticket_reply);
                if (mysqli_num_rows($result_ticket_reply) > 0) {
                    $res_ticket_reply = mysqli_fetch_array($result_ticket_reply);
                    $ticket_reply_ot_kogo = htmlentities($res_ticket_reply['ot_kogo']);
                    if ($ticket_reply_ot_kogo != $user_id) {
                        if (!isset($_GET['closed'])) {
                            echo 'background: #abbdd7;';
                        }
                    }
                } else {
                    if (!isset($_GET['closed'])) {
                        echo 'background: #abbdd7;';
                    }
                }
            }
                ?>">
                    <td><?php echo $ticket_id; ?></td>
                    <td style="text-align: left; line-height: 19px; padding: 10px;"><a href="./tickets.php?ticket=<?php echo $ticket_id; ?>"><?php echo html_entity_decode($ticket_theme, ENT_QUOTES, 'utf-8'); ?></a></td>
                    <td style="line-height: 19px;">
                        <?php
                        if ($user_tip_id_ticket_reply == '70' && $user_tip == '70' || ($user_tip_id_ticket_reply != '70' && $user_tip == '70')) {
                            echo '<b>' . $user_tip_ticket_reply . '</b>';
                            echo '<br /><a target="_blank" href="./users.php?edit=' . $ticket_ot_kogo . '">' . $user_email . '</a>';
                        } else {
                            if ($ticket_ot_kogo == $user_id) {
                                echo '<b>' . $loc['tickets.php']['t15'] . '</b>';
                            } else {
                                echo '<b>' . $user_tip_ticket_reply . '</b>';
                            }
                        }
                        ?>
                    </td>
                    <?php
                    if ($ticket_status == '1') {
                        echo '<td style="color: green;font-weight:bold;">' . $loc['tickets.php']['t16'] . '</td>';
                    } elseif ($ticket_status == '0') {
                        echo '<td style="color: red;font-weight:bold;">' . $loc['tickets.php']['t34'] . '</td>';
                    }
                    ?>
                    <td>
                        <?php
                        // Вывод в зависимости от того, вызываются открытые или закрытые тикеты
                        // Display depending on whether open or closed are called tickets
                        if ($ticket_status == '0') {
                            ?>
                            <a href="./tickets.php?open=<?php echo $ticket_id; ?>" onclick="if (!confirm('<?php echo $loc['tickets.php']['t17']; ?>'))
                                                        return false;"><?php echo $loc['tickets.php']['t18']; ?></a>
                               <?php
                           } elseif ($ticket_status == '1') {
                               ?>
                            <a href="./tickets.php?close=<?php echo $ticket_id; ?>" onclick="if (!confirm('<?php echo $loc['tickets.php']['t19']; ?>'))
                                                        return false;"><?php echo $loc['tickets.php']['t20']; ?></a>
                               <?php
                           }
                           ?>
                    </td>
                </tr>
                <?php
            }
            
        }
        // Вывод количества страниц
        // Display the number of pages
        pagination($result, 20, 11);
    
        ?>  
    </table>


    <?php
    }
}
?>

</div>
