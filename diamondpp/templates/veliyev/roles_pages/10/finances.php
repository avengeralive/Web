<main>
    <div class="row grow">
        <div class="col-md-7">
            <h1><?php echo $loc['finances.php']['t01']; ?></h1>
        </div>
        <?php include './templates/' . $template . '/roles_pages/' . $user_tip . '/menu_top.php'; ?>
    </div>
<?php
    
// Если баланс был успешно пополнен, то выводим сообщение об этом
// If the balance has been successfully topped up, the message about this
if (isset($_GET['success']))
	{
        $error_type = 'success';
	$error_message =  $loc['finances.php']['t02'];
	}
// Если баланс НЕ был успешно пополнен, то выводим сообщение об этом
// If the balance has not been successfully topped up, the message about this
if (isset($_GET['fail']))
	{
        $error_type = 'error';
	$error_message =  $loc['finances.php']['t03'];
	}
        

        if (isset($_GET['xtext']) && $_GET['xtext']!='')
        {
        if ($_GET['xtext']=='1') {$error_type = 'error'; $error_message = 'Ошибка!';}
        if ($_GET['xtext']=='2') {$error_type = 'error'; $error_message = $loc['finances.php']['t13'].'&nbsp;'.$settings_min_vyvod.'&nbsp;'.$loc['finances.php']['t14'];}
        if ($_GET['xtext']=='3') {$error_type = 'error'; $error_message = $loc['finances.php']['t15'];}
        if ($_GET['xtext']=='4') {$error_type = 'error'; $error_message = $loc['finances.php']['t16'];}
        if ($_GET['xtext']=='5') {$error_type = 'success';$error_message = $loc['finances.php']['t17'];}
        }

        
        
        
        include_once './includes/errors.php';
        
        $Paysys = new Paysys();
        $Paysys->setUser($user_id);
        $user_paysys = $Paysys->getUserPaysys(); 
?>

    
    <div class="row grow">
        <div class="col-md-4">
            <div class="block paysys_form yandex">
                <div class="row irow">
                    <div class="col-md-12 p0 logobl">
                        <img class="" src="./img/ym.jpg">
                        <img class="cplog" src="./img/cparta.svg">
                    </div>
                    <?php
                    if($user_paysys && ($user_paysys->yandex != '' || $user_paysys->yandex != 0)){
                    ?>
                        <p class="text-center mb-0 mt-10"><b><?=$user_paysys->yandex; ?></b></p>

                        <?php
                        // Если сумма на балансе равна или больше минимальной суммы разрешенной для вывода, то выводим блок. Иначе сообщаем об ошибке.
                        // If the amount on the balance sheet is equal to or more than the minimum amount authorized for output, the output unit. Otherwise, we report an error.
                        if ($user_balance>=$settings_min_vyvod)
                                {
                                ?>
                                <form method="post" action="./finances.php?<?php echo @$_SERVER['QUERY_STRING']?>">
                                    <div class="form-group mt-15">
                                      <input type="text" name="sum_vyvod" class="form-control text-center" maxlength="6" value="<?php echo $user_balance; ?>" placeholder="Сумма на вывод">
                                    </div>
                                    <input type="hidden" name="vyvod" value="yandex">
                                    <div class="form-group mt-15 text-center">
                                        <input type="submit" name="submit" value="Заказать выплату" class="button btn">
                                    </div>
                                </form>
                                <?php
                                }
                        else
                                {
                                echo '<p class="text-center mt-30"><font style= color=red>'.$loc['finances.php']['t21'].'&nbsp;'.$settings_min_vyvod.'&nbsp;'.$loc['finances.php']['t06'].'&nbsp;</font></p>';
                                }
                        ?>
                    
                    <?php
                    }else{
                    ?>
                    <div class="col-sm-8 purse p0">
                        <input type="text" name="yandex_purse" class="form-control ym_inp" placeholder="410000000000000">
                    </div>
                    <div class="col-sm-4 p0">
                        <a class="btn btn-primary verify_paysys" data-paysys="1">Сохранить</a>
                    </div>
                    <div class="col-sm-12 p0 cdd">
                        <div class="form-group col code-input" style="display: none;">
                            <input style="padding: .375rem .75rem;" type="text" class="form-control text-center" placeholder="Код из СМС">
                        </div>
                    </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="block paysys_form webmoney">
                <div class="row irow">
                    <div class="col-md-12 p0 logobl">
                        <img class="" src="./img/wm.jpg">
                        <img class="cplog" src="./img/cparta.svg">
                    </div>
                    <?php
                    if($user_paysys && ($user_paysys->wmr != '' || $user_paysys->wmr != 0)){
                    ?>
                        <p class="text-center mb-0 mt-10"><b><?=$user_paysys->wmr; ?></b></p>

                        <?php
                        // Если сумма на балансе равна или больше минимальной суммы разрешенной для вывода, то выводим блок. Иначе сообщаем об ошибке.
                        // If the amount on the balance sheet is equal to or more than the minimum amount authorized for output, the output unit. Otherwise, we report an error.
                        if ($user_balance>=$settings_min_vyvod)
                                {
                                ?>
                                <form method="post" action="./finances.php?<?php echo @$_SERVER['QUERY_STRING']?>">
                                    <div class="form-group mt-15">
                                      <input type="text" name="sum_vyvod" class="form-control" maxlength="6" value="<?php echo $user_balance; ?>" placeholder="Сумма на вывод">
                                    </div>
                                    <input type="hidden" name="vyvod" value="wmr">
                                    <div class="form-group mt-15 text-center">
                                        <input type="submit" name="submit" value="Заказать выплату" class="button btn">
                                    </div>
                                </form>
                                <?php
                                }
                        else
                                {
                                echo '<p class="text-center mt-30"><font style= color=red>'.$loc['finances.php']['t21'].'&nbsp;'.$settings_min_vyvod.'&nbsp;'.$loc['finances.php']['t06'].'&nbsp;</font></p>';
                                }
                        ?>
                    
                    <?php
                    }else{
                    ?>
                    <div class="col-sm-8 purse p0">
                      <input type="text" name="yandex_purse" class="form-control wm_inp" placeholder="WMR">
                    </div>
                    <div class="col-sm-4 p0">
                        <a class="btn btn-primary verify_paysys" data-paysys="2">Сохранить</a>
                    </div>
                    <div class="col-sm-12 p0 cdd">
                        <div class="form-group col code-input" style="display: none;">
                            <input style="padding: .375rem .75rem;" type="text" class="form-control text-center" placeholder="Код из СМС">
                        </div>
                    </div>
                    <?php
                    }
                    ?>
                </div>  
            </div>
        </div>
        <div class="col-md-4">
            <div class="block paysys_form cards">
                <div class="row irow">
                    <div class="col-md-12 p0 logobl">
                        <img class="" src="./img/mastercard.jpg">
                        <img class="cplog" src="./img/cparta.svg"><br>
                        <img class="" src="./img/visa.jpg">
                    </div>
                
                    
                    <?php
                    if($user_paysys && ($user_paysys->cards != '' || $user_paysys->cards != 0)){
                    ?>
                        <p class="text-center mb-0 mt-10"><b><?=$user_paysys->cards; ?></b></p>

                        <?php
                        // Если сумма на балансе равна или больше минимальной суммы разрешенной для вывода, то выводим блок. Иначе сообщаем об ошибке.
                        // If the amount on the balance sheet is equal to or more than the minimum amount authorized for output, the output unit. Otherwise, we report an error.
                        if ($user_balance>=$settings_min_vyvod)
                                {
                                ?>
                                <form method="post" action="./finances.php?<?php echo @$_SERVER['QUERY_STRING']?>">
                                    <div class="form-group mt-15">
                                      <input type="text" name="sum_vyvod" class="form-control text-center" maxlength="6" value="<?php echo $user_balance; ?>" placeholder="Сумма на вывод">
                                    </div>
                                    <input type="hidden" name="vyvod" value="cards">
                                    <div class="form-group mt-15 text-center">
                                        <input type="submit" name="submit" value="Заказать выплату" class="button btn">
                                    </div>
                                </form>
                                <?php
                                }
                        else
                                {
                                echo '<p class="text-center mt-30"><font style= color=red>'.$loc['finances.php']['t21'].'&nbsp;'.$settings_min_vyvod.'&nbsp;'.$loc['finances.php']['t06'].'&nbsp;</font></p>';
                                }
                        ?>
                    
                    <?php
                    }else{
                    ?>
                    
                    <div class="col-sm-8 purse p0">
                        <input type="text" name="yandex_purse" class="form-control vm_inp" placeholder="0000 0000 0000 0000">
                    </div>
                    <div class="col-sm-4 p0">
                        <a class="btn btn-primary verify_paysys" data-paysys="3">Сохранить</a>
                    </div>
                    <div class="col-sm-12 p0 cdd">
                        <div class="form-group col code-input" style="display: none;">
                            <input style="padding: .375rem .75rem;" type="text" class="form-control text-center" placeholder="Код из СМС">
                        </div>
                    </div>
                    
                    <?php
                    }
                    ?>
                </div>    
            </div>
        </div>
    </div>

	

<?php
// Подгружаем вывод статистики по операциям связанных с балансом пользователя
// Loads the display of statistics on transactions related to the user's balance
include './templates/'.$template.'/blocks/finances_log.php';
?>

        
</main>
