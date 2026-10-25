<?php
if ($user_active == '0') {
?>
    <form name="profile_activation_form" class="" method="post">
        <p style="color: red;"><b><?php echo $loc['profile.php']['t04']; ?></b><br /><?php echo $loc['profile.php']['t05']; ?></p>  
        
        <!-- <div class="row mt-20">
            <div class="form-group col-4">
              <label for="activation_code"><?php echo $loc['profile.php']['t06']; ?></label>
              <input type="text" name="activation_code" class="form-control" id="activation_code"  placeholder="<?php echo $loc['profile.php']['t07']; ?>">
            </div>
        </div> -->
        
        <!-- <div class="row mb-20">
            <div class="form-group col-4">
              <button name="profile_activation_submit" type="submit" class="btn button"><?php echo $loc['button']['t03']; ?></button>
            </div>
        </div> -->
        
        <p>
            <?php// echo $loc['profile.php']['t39'] . '&nbsp;<a href="./profile.php?re_activate=' . $user_id . '">' . $loc['profile.php']['t40'] . '</a>&nbsp;' . $loc['profile.php']['t41']; ?>
        </p>
        
    </form>
<?php } elseif ($user_active == '2') { ?> 
    <p style="color: red;">
        <b>
            Ваш аккаунт на проверке, по указанным при регистрации данным с Вами свяжется наш менеджер для активации аккаунта.<br><br>
            Если Вы ошиблись при указании контактных данных, напишите в тех.поддержку:<br>
            Skype: <a href="skype:<?=$settings_skype; ?>?add"><?=$settings_skype; ?></a><br>
            Telegram: <a href="https://t.me/<?=$settings_telegram; ?>" target="_blank">@<?=$settings_telegram; ?></a><br>
            E-mail: <a href="mailto:<?=$settings_email; ?>"><?=$settings_email; ?></a><br> 
        </b></p>
<?php } else {
    $user = User::getById($user_id);
?>
<div class="row grow">
    <div class="col-md-9">
        <div class="block personal">
            <div class="row irow">
                <div class="col-md-12 heading">
                    <h2>Личная информация</h2>
                </div>
                <div class="col-md-12 form_div">
                    <form name="profile_changepassword_form" class="" method="post">
                        <div class="row irow">
                            <div class="col-md-4">
                                <label for="profile_name">Имя</label>
                                <input type="text" class="form-control" name="profile_name" id="name" value="<?php echo $user_name; ?>">
                            </div>
                            <div class="col-md-4">
                                <label for="login">Логин в Cparta</label>
                                <input type="text" class="form-control" name="profile_login" id="login" value="<?php echo $user_login; ?>">
                            </div>
                            <div class="col-md-4">
                                <label for="Email">Email</label>
                                <input type="text" class="form-control" readonly="" id="Email" value="<?php echo $user_email; ?>">
                            </div>
                        </div>
                        <div class="row irow">
                            <div class="col-md-4">
                                <label for="skype">Skype</label>
                                <input type="text" class="form-control" name="profile_skype" id="skype" value="<?php echo $user_skype; ?>">
                            </div>
                            <div class="col-md-4">
                                <label for="API">Telegram</label>
                                <input type="text" class="form-control" name="telegram" id="telegram" value="<?php echo $telegram; ?>"></small>
                            </div>
                            <div class="col-md-4">
                                <label for="API">Telegram User ID</label>
                                <input type="text" class="form-control" name="telegram_user_id" id="telegram_user_id" value="<?php echo $telegram_user_id; ?>">
                                <small id="" class="form-text text-muted"><a href="http://tele.click/my_id_bot" target="_blank"> Получить User ID</a></small>
                            </div>
                            <div class="col-md-4">
                                <label for="API">API Key</label>
                                <input type="text" class="form-control" readonly="" id="API" value="<?php echo $user_apikey; ?>">
                                <small id="" class="form-text text-muted"><a href="http://api.cparta.net/apidoc/" target="_blank"> Документация</a></small>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn button" name="profile_rekvizit_submit">Сохранить</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-12 heading">
                    <h2>Изменение пароля</h2>
                </div>
                <div class="col-md-12 form_div">
                    <form name="profile_changepassword_form" class="" method="post">
                        <div class="row irow">
                            <div class="col-md-4">
                                <label for="old_password">Старый</label>
                                <input type="password" class="form-control" name="old_password" placeholder="Старый пароль">
                            </div>
                            <div class="col-md-4">
                                <label for="profile_password_1">Новый</label>
                                <input type="password" class="form-control" name="profile_password_1" placeholder="Новый пароль">
                            </div>
                            <div class="col-md-4">
                                <label for="profile_password_2">Повторите пароль</label>
                                <input type="password" class="form-control" name="profile_password_2" placeholder="Повторите пароль">
                            </div>
                        </div>
                        <div class="row irow">
                            <div class="col-md-4">
                                <button type="submit" class="btn button savepass" name="profile_changepassword_submit">Сохранить пароль</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="block notif">
            <div class="row irow">
                <div class="col-md-12 heading">
                    <h2>Настройка уведомлений <?php if($user->telegram=='' || $user->telegram==0){ ?><small>Для подключения уведомлений через Telegram добавьте <a href="http://tele.click/CpartaCPA_bot" target="_blank">нашего бота в контакты!</a><br> И добавтье свой User ID</small><? } ?></h2>
                </div>
                <div class="col-md-12 form_div">
                    <form name="profile_rekvizit_form" class="profile_rekvizit_form events mt-30" method="post">
                        <input type="hidden" name="action" value="save_events">
                        <table class="table">
                            <tr height="30">
                                <th><span>Событие</span></th>               
                                <!--<th><span>По почте</span></th>-->
                                <th><span>В Telegram</span></th>
                                <!--<th><span>PUSH уведомления</span></th>-->
                            </tr>
                            <?php
                            $push = 0;
                            foreach (Events::$_desc as $k => $t) {
                                if(($k & $user->events_push) == $k){$push = 1;}
                                 echo "<tr><td>$t</td>"
                                . "<!--<td><label class='checkbox_container'><input name=events_email[{$k}] type=checkbox " . (( ($k & $user->events_email) == $k) ? 'checked' : '') . " disabled='disabled'><span class='checkmark'></span></label></td>-->"
                                . "<td><label class='checkbox_container'><input name=events_telegram[{$k}] type=checkbox " . (( ($k & $user->events_telegram) == $k) ? 'checked' : '') . " ><span class='checkmark'></span></label></td>"
                                . "<!--<td><label class='checkbox_container'><input name=events_push[{$k}] type=checkbox " . (( ($k & $user->events_push) == $k) ? 'checked' : '') . " disabled='disabled'><span class='checkmark'></span></label></td>-->"
                                . "</tr>";
                            }
                            ?>
                        </table>
                        <input name="profile_rekvizit_submit1" type="submit" class="btn button" value="Сохранить">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="block personal">
            <div class="row irow">
                <div class="col-md-12">
                    <img id="avatar" class="avatar" src="./tmp/avatars/<?=$user_ava; ?>">
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="image" accept="image/*" id="input">
                            <label class="custom-file-label" for="input"></label>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 text-center">
                    <p><?=$user_name; ?></p>
                    <p><?=$user_email; ?></p>
                    <p>ID: <?=$user_id; ?>,<?=$user_login;?></p>
                </div>
            </div>
        </div>
        <link href="./modules/imagecrop/cropper/css/cropper.css" rel="stylesheet">
        <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">Обрезать изображение</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="img-container">
                            <img id="image" src="">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
                        <button type="button" class="btn btn-primary" id="crop">Сохранить</button>
                    </div>
                </div>
            </div>
        </div>
        <script src="./modules/imagecrop/cropper/js/cropper.js"></script>
        <script src="./modules/imagecrop/cropper/js/avatar.js"></script>
    </div>
</div>

<?php if($push == 1){ ?>
<script>
    subscribe();  
</script>
<?php } ?>
<? } ?>
    <?php

    // Проверяем, требуется ли выводить сервисные сообщения
    // Check if the display service messages required
    if (isset($errortext_profile) && $errortext_profile != '') {
        $error_type = 'error';
        $error_message =  $errortext_profile;
    } elseif (isset($_GET['success'])) {
        $error_type = 'success';
        $error_message =  $loc['profile.php']['t02'];
    } elseif (isset($_GET['successpasswd'])) {
        $error_type = 'success';
        $error_message =  $loc['profile.php']['t03'];
    } elseif (isset($_GET['reactivate'])) {
        $error_type = 'info';
        $error_message =  $loc['profile.php']['t42'];
    } elseif (isset($_GET['verifysms'])) {
        $error_type = 'success';
        $error_message =  'Телефон успешно подтвержден!';
    }  
    
    include_once './includes/errors.php';
    
    ?>
