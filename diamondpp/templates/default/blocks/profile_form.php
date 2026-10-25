<div class="col-12 mb-25">

<?php
if ($user_active == '0') {
    
    
    ?>

    <form name="profile_activation_form" class="" method="post">
        <p style="color: red;"><b><?php echo $loc['profile.php']['t04']; ?></b><br /><?php echo $loc['profile.php']['t05']; ?></p>	
        
        <div class="row mt-20">
            <div class="form-group col-4">
              <label for="activation_code"><?php echo $loc['profile.php']['t06']; ?></label>
              <input type="text" name="activation_code" class="form-control" id="activation_code"  placeholder="<?php echo $loc['profile.php']['t07']; ?>">
            </div>
        </div>
        
        <div class="row mb-20">
            <div class="form-group col-4">
              <button name="profile_activation_submit" type="submit" class="btn button"><?php echo $loc['button']['t03']; ?></button>
            </div>
        </div>
        
        <p>
            <?php echo $loc['profile.php']['t39'] . '&nbsp;<a href="./profile.php?re_activate=' . $user_id . '">' . $loc['profile.php']['t40'] . '</a>&nbsp;' . $loc['profile.php']['t41']; ?>
        </p>
        
    </form>

    <?php
}elseif ($user_active == '2') {
?> 
    <p style="color: red;">
        <b>
            Ваш аккаунт на проверке, по указанным при регистрации данным с Вами свяжется наш менеджер для активации аккаунта.<br><br>
            Если Вы ошиблись при указании контактных данных, напишите в тех.поддержку:<br>
            Skype: <a href="skype:<?=$settings_skype; ?>?add"><?=$settings_skype; ?></a><br>
            Telegram: <a href="https://t.me/<?=$settings_telegram; ?>" target="_blank">@<?=$settings_telegram; ?></a> или <a href="https://t.me/alex_mosss" target="_blank">@alex_mosss</a><br>
            E-mail: <a href="mailto:<?=$settings_email; ?>"><?=$settings_email; ?></a><br> 
        </b></p>
<?php  
} else {
       
    $user = User::getById($user_id);
    ?>
  <style>
    .label {
      cursor: pointer;
    }

    .progress {
      display: none;
      margin-bottom: 1rem;
    }

    .img-container img {
      max-width: 100%;
    }
  </style>
<link href="./modules/imagecrop/cropper/css/cropper.css" rel="stylesheet">
    <div class="row">
        
        <div class="col-6 mb-20">
            <div class="card" style="height: 320px;">
                <div class="card-body">
                    <p class="postTitle mb-20">Изменить Аватар:</p>
                    <div class="row align-items-center mt-30">                     
                        
                        <div class="col-auto">   
                            <img id="avatar" class="avatar" src="./tmp/avatars/<?=$user_ava; ?>">
                        </div>
                        <div class="col-7 ">   

                                <div class="input-group">
                                    <div class="custom-file">
                                      <input type="file" class="custom-file-input" name="image" accept="image/*" id="input">
                                      <label class="custom-file-label" for="input">Загрузите изображение</label>
                                    </div>
                                </div>

                        </div>
                    </div>                        
                </div>
            </div>
        </div>

        <div class="col-6 mb-30">
            <div class="card">
                <div class="card-body">
                    <form name="profile_changepassword_form" class="" method="post">
                        <p class="postTitle mb-20">Изменить пароль:</p>

                        <div class="form-group">
                          <input type="password" class="form-control" name="old_password"  placeholder="Старый пароль">
                        </div>

                        <div class="form-group">
                          <input type="password" class="form-control" name="profile_password_1"  placeholder="Новый пароль">
                        </div>

                        <div class="form-group">
                          <input type="password" class="form-control" name="profile_password_2"  placeholder="Повторите пароль">
                        </div>
                        
                        <div class="form-group">
                          <button type="submit" class="btn button" name="profile_changepassword_submit">Сохранить пароль</button>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>

        <div class="col-12 mb-30">
            <div class="card">
                <div class="card-body">
                    <form name="profile_changepassword_form" class="" method="post">
                        <div class="row">
                            <div class="col-6 ">   
                                <p class="postTitle mb-20">Личная информация:</p>

                                <div class="form-group">
                                  <label for="name">Имя:</label>
                                  <input type="text" class="form-control" name="profile_name" id="name" value="<?php echo $user_name; ?>">
                                </div>

                                <div class="form-group">
                                  <label for="login">Логин в BlackDollar:</label>
                                  <input type="text" class="form-control" name="profile_login" id="login" value="<?php echo $user_login; ?>">
                                </div>

                                <div class="form-group">
                                    
                                    <?php
                                    if($phone_check == 0){
                                    ?>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" readonly="" name="profile_phone" id="phone" value="<?php echo $user_phone; ?>">
                                        <div class="input-group-append">
                                          <button class="btn button" type="button" id="sms-verify">Подтвердить</button>
                                        </div>
                                    </div>
                                    <?php
                                    }else{
                                    ?>
                                    <label for="phone">Телефон:</label>
                                    <input type="text" class="form-control" readonly="" name="profile_phone" id="phone" value="<?php echo $user_phone; ?>">
                                    <?php
                                    }
                                    ?>
                                    

                                  
                                </div>

                                <div class="form-group">
                                  <label for="Email">Email:</label>
                                  <input type="text" class="form-control" readonly="" id="Email" value="<?php echo $user_email; ?>">
                                </div>
                            </div>    

                            <div class="col-6 ">   
                                <p class="postTitle mb-20"><br></p>
                                
                                <div class="form-group">
                                  <label for="skype">Skype:</label>
                                  <input type="text" class="form-control" name="profile_skype" id="skype" value="<?php echo $user_skype; ?>">
                                </div>

                                <div class="form-group">
                                  <label for="API">API Key:</label>
                                  <input type="text" class="form-control" readonly id="API" value="<?php echo $user_apikey; ?>">
                                  <small id="" class="form-text text-muted"><a style="color:#0085ba;" href="http://api.avaleads.pro/apidoc/" target=_blank> Документация</a></small>
                                </div>
                            </div>   
                        
                        </div>    
                        
                        <div class="form-group">
                          <button type="submit" class="btn button" name="profile_rekvizit_submit">Сохранить</button>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>

        
        
    </div>    

    <?php
    //include ('./templates/' . $template . '/checkform/jquery.proverka.profile-password.form.php');
    ?>

    <p>

    </p>
    <style>
        form.events tbody td{
            padding: 10px;
            border-bottom: 1px solid #ccc;
        }
    </style>
    <form name="profile_rekvizit_form" class="profile_rekvizit_form events mt-30" method="post">
        <input type="hidden" name="action" value="save_events">
        <p class="postTitle"><span>Настройка уведомлений</span></p>
        <BR>
        <?php
            if($user->telegram=='' || $user->telegram==0){
                echo 'Для подключения уведомлений через Telegram добавьте <a href="https://telegram.me/BDCPA_bot" target=_blank>нашего бота в контакты!</a>';
            }
        ?>
        
        </br>
        <table style="width: 800px;margin-top:50px;" class="table">
            <tr height="30">
                <th width="400"><span class="openSansBold">Событие</th>               
                <th class="text-center" width="200"><span class="openSansBold">По почте</span></th>
                <th class="text-center" width="200"><span class="openSansBold">В Telegram</span></th>
                <th class="text-center" width="200"><span class="openSansBold">PUSH уведомления</span></th>
            </tr>
            <tbody>
                <?php
                $push = 0;
                foreach (Events::$_desc as $k => $t) {
                    if(($k & $user->events_push) == $k){$push = 1;}
                    echo "<tr><Td>$t</td>"
                    . "<td align=center><input name=events_email[{$k}] type=checkbox " . (( ($k & $user->events_email) == $k) ? 'checked' : '') . " ></td>"
                    . "<td align=center><input name=events_telegram[{$k}] type=checkbox " . (( ($k & $user->events_telegram) == $k) ? 'checked' : '') . " ></td>"
                    . "<td align=center><input name=events_push[{$k}] type=checkbox " . (( ($k & $user->events_push) == $k) ? 'checked' : '') . " ></td>"
                    . "</tr>";
                }
                ?>
            </tbody>
            <tr height="60px">
                <td colspan="3"></td>
                <td>
                    <input name="profile_rekvizit_submit1" type="submit" class="btn button" value="<?php echo $loc['button']['t01']; ?>" >
                </td>
            </tr>
        </table>
    </form>
    <?php
    if($push == 1){
    ?>
    <script>
        subscribe();  
    </script>
    <?php    
    }
    
    
}
?>
</div>

                <div class="modal fade" id="modal-sms" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Подтверждение номера телефона</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                          
                          <p class="text-center">На Ваш номер отправлено смс с кодом,<br>введите полученный код в форму ниже</p>
                        <div class="form-group" style="width:150px;margin:20px auto;">
                          <input type="text" class="form-control" name="sms-check" id="sms-check" value="">
                        </div>
                        
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                        <button type="button" class="btn btn-primary" id="smscodecheck">Подтвердить</button>
                      </div>
                    </div>
                  </div>
                </div>

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
