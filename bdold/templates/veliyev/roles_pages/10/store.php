<?php 
if (isset($_GET['xtext']) && $_GET['xtext']=='1') {$error_message = 'Заявка принята, с Вами свяжется менеджер для уточнения деталей.';$error_type = 'success';} 
if (isset($_GET['xtext']) && $_GET['xtext']=='2') {$error_message = 'Недостаточно Yes-coin!';$error_type = 'error';} 
?>

<script type="text/javascript">
    $(document).ready(function(){
        $(".change_coins").on("click",function(){
            var userCoins = parseInt($('#userCoins').attr('data-sum'));
            var nameGift = $(this).attr('data-name');
            var priceGift = parseInt($(this).attr('data-price'));
            var idGift = $(this).attr('data-id');
            
            if(userCoins >= priceGift){
                $('#idGift').val(idGift);
                $('#nameGift').html(nameGift);
                $('#priceGift').html(priceGift);
                $('#gift-purchase-form').modal('show');
            }
        });
    });
</script>
<div class="row main mt-50 mb-50">	

    <div class="col-12">
        <div class="card" style="    min-height: auto;">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-auto mr-auto">
                        <a href="" style="color: #31C6B2;font-weight: bold;">Что такое Yes-coin</a> <a style="color: #31C6B2;font-weight: bold; padding-left:15px;" href="">Правила участия</a>
                    </div>
                    <div class="col-auto">
                        <p style="color: #31C6B2;font-weight: bold;  margin-bottom: auto;  font-size: 20px;"><img width="30px" src="./templates/<?= $template; ?>/img/coin2.png">  <span id="userCoins" data-sum="<?php echo $user_coins; ?>"><?php echo number_format($user_coins, 0, ',', ' '); ?></span> </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-12 mt-30">
        
        <div class="row gifts">
            
<?php
    $Store = Store::getAll();
        foreach ($Store as $gift) {
            $disabled='';
            if($gift->price > $user_coins){
                $disabled = 'disabled="disabled"';
            }
?>
            <div class="col-3">
                <div class="product" style="background: url('./templates/<?= $template; ?>/img/store/<?=$gift->image; ?>') no-repeat center center;    background-size: 100%;">
                    <div class="content">
			<div class="cost">
                            <span><?php echo number_format($gift->price, 0, ',', ' '); ?></span>
                            <img width="30px" src="./templates/<?= $template; ?>/img/coin2.png">
			</div>
			<div class="product_name">
                            <span><?=$gift->name; ?></span>
			</div>
			<button <?=$disabled; ?> class="change_coins md-trigger"  data-name="<?=$gift->name; ?>" data-price="<?=$gift->price; ?>" data-id="<?=$gift->id; ?>" data-modal="gift-purchase-form">Обменять</button>
                        
                    </div>
                </div>
            </div>
<?php            
        }
?>
            
        </div>        
        
    </div>
    
</div>

<!-- Modal -->
<div class="modal fade" id="gift-purchase-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title">Обмен Yes-coin</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        
        <form action="" method="post" style="margin: 20px auto; width: 350px;">
            <input type="hidden" name="idGift" value="" id="idGift">  
            <div class="modal-body">
                <table class="table table-borderless">
                    <tr>
                        <td>Подарок</td>
                        <td><span id="nameGift" style="color: #31C6B2;font-weight: bold;"></span></td>
                    </tr>
                    <tr>
                        <td>Стоимость</td>
                        <td><span id="priceGift" style="color: #31C6B2;font-weight: bold;">0</span> &nbsp; <img style="margin-top: -2px;" width="20px" src="./templates/<?= $template; ?>/img/coin.png"></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                        <div class="form-group">
                          <label for="addres">Адрес доставки</label>
                          <textarea  class="form-control" id="addres" name="addres"></textarea>
                        </div>
                        </td>
                    </tr>
                </table>


            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Обменять</button>
            </div>
        </form>
        
    </div>
  </div>
</div>
