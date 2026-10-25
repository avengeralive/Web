<div class="row main mt-50 mb-50">

    <div class="col-12 mb-10"><p class="pageTitle mb-25"><?php echo $loc['finances.php']['t01']; ?></p></div>

    
    
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
        
include_once './includes/errors.php';
?>
<div class="col-12">
        
        <div class="row">
            <div class="col-4">
                <div class="paysys_form yandex">
                    <img class="" src="./templates/<?php echo $template; ?>/img/yandex.png">

                        <form method="post" action="./finances.php?act=make_invoice">
                            <div class="form-group mt-15">
                              <input type="text" name="amount" class="form-control text-center" placeholder="Сумма" required>
                            </div>
                            <input type="hidden" name="paysys" value="yk">
                            <div class="form-group mt-25 text-center">
                                <input type="submit" name="submit_paybalance" value="Пополнить счет" class="button btn">
                            </div>
                        </form>
                </div>
            </div>
            <div class="col-4">
                <div class="paysys_form webmoney">
                    <img class="" src="./templates/<?php echo $template; ?>/img/webmoney.png">

                        <form method="post" action="./finances.php?act=make_invoice">
                            <div class="form-group mt-15">
                              <input type="text" name="amount" class="form-control text-center" placeholder="Сумма" required>
                            </div>
                            <input type="hidden" name="paysys" value="wm">
                            <div class="form-group mt-25 text-center">
                                <input type="submit" name="submit_paybalance" value="Пополнить счет" class="button btn">
                            </div>
                        </form> 
                </div>
            </div>
            <div class="col-4">
                <div class="paysys_form cards">
                    <img class="" src="./templates/<?php echo $template; ?>/img/cards.png">
                    
                        <form method="post" action="./finances.php?act=make_invoice">
                            <div class="form-group mt-15">
                              <input type="text" name="amount" class="form-control text-center" placeholder="Сумма" required>
                            </div>
                            <input type="hidden" name="paysys" value="wm">
                            <div class="form-group mt-25 text-center">
                                <input type="submit" name="submit_paybalance" value="Пополнить счет" class="button btn">
                            </div>
                        </form> 
                    
                </div>
            </div>
        </div>
			
</div>		

<?php
// Подгружаем вывод статистики по операциям связанных с балансом пользователя
// Loads the display of statistics on transactions related to the user's balance
include './templates/'.$template.'/blocks/finances_log.php';
?>
	
</div>	
		
<?php
include './templates/'.$template.'/in_footer.php';
exit;
?>
