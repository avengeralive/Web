<?php
    $r_set = Roulette_Settings::getById(1);
?>

<style>
.roulette ul li div.r {
    width: 150px;
    height:150px;
    overflow: hidden;
    background: url('./templates/<?php echo $template; ?>/img/roulette/<?php echo $r_set->sprite; ?>') no-repeat;
    background-position: 0 0; 
}

.roulette ul li div.img-h {
    width: 150px;
    height:150px;
    overflow: hidden;
    background: url('./templates/<?php echo $template; ?>/img/roulette/<?php echo $r_set->sprite; ?>') no-repeat;
    animation: 0.6s linear infinite moveBG;
    -webkit-animation: 0.6s linear infinite moveBG;
}
</style>    

<div class="row main mt-50 mb-50">

    <div class="col-12 mb-10 text-center"><p class="pageTitle mb-25">ЛИД-РУЛЕТКА</p></div>

    <div class="col-12 mb-30">

        <div class="roulette">
            <div class="d-flex justify-content-center">
                <ul class="d-flex justify-content-center">
                    <li>
                        <div class="img-h">
                            <div class="r"></div>
                        </div>
                    </li>
                    <li>
                        <div class="img-h">
                            <div class="r"></div>
                        </div>
                    </li>
                    <li>
                        <div class="img-h">
                            <div class="r"></div>
                        </div>
                    </li>
                </ul>
                <div class="trigger-box">
                    <div class="trigger"></div>
                </div>
            </div>
        </div>
        
        <div id="priz-block" class="alert alert-success text-center mt-20" role="alert" style="display: none;">
            Вы выиграли! &nbsp;&nbsp;&nbsp; <a href="./roulette.php">Забрать</a>
        </div>
        
        <?php
        $user = User::getById($user_id);
        if($user->roulette_keys > 0){
        ?>
            <p class="r_keys">У Вас <span id="r_key"><?=$user->roulette_keys; ?></span> ключей от лид-рулетки</p>
        <?php
        }else{
        ?>
            <p class="r_keys text-danger">У Вас нет ключей от лид-рулетки</p>
        <?php
        }
        ?>
        

            
            
            
    </div>
    
    
    
    <div class="col-12 mt-50">
        <div class="row">
            <div class="col-12 mb-10 text-center">
                <p class="pageTitle mb-25">Топ горячих призов</p>  
            </div>
            
            <div class="col text-center">
                <img src="./templates/<?php echo $template; ?>/img/roulette/<?php echo $r_set->priz_1_img; ?>" class="img-fluid">
                <p><?php echo $r_set->priz_1_name; ?></p>
            </div>
            <div class="col text-center">
                <img src="./templates/<?php echo $template; ?>/img/roulette/<?php echo $r_set->priz_2_img; ?>" class="img-fluid">
                <p><?php echo $r_set->priz_2_name; ?></p>
            </div>
            <div class="col text-center">
                <img src="./templates/<?php echo $template; ?>/img/roulette/<?php echo $r_set->priz_3_img; ?>" class="img-fluid">
                <p><?php echo $r_set->priz_3_name; ?></p>
            </div>
            <div class="col text-center">
                <img src="./templates/<?php echo $template; ?>/img/roulette/<?php echo $r_set->priz_4_img; ?>" class="img-fluid">
                <p><?php echo $r_set->priz_4_name; ?></p>
            </div>
        </div>
        <div class="row">
            <div class="col text-center">
                <img src="./templates/<?php echo $template; ?>/img/roulette/<?php echo $r_set->priz_5_img; ?>" class="img-fluid">
                <p><?php echo $r_set->priz_5_name; ?></p>
            </div>
            <div class="col text-center">
                <img src="./templates/<?php echo $template; ?>/img/roulette/<?php echo $r_set->priz_6_img; ?>" class="img-fluid">
                <p><?php echo $r_set->priz_6_name; ?></p>
            </div>
            </div>
        </div>
    </div>

    <div class="col-12 mt-50 mb-50">

        <div class="row justify-content-center">
          <div class="col-6 text-center">
            <p class="pageTitle mb-25">Правила игры</p>  
            <p>
                За каждые <?php echo $r_set->keysforlead; ?> подтвержденных лидов в нашей системе Вы будете получать один ключ.<br>
                Крутите беспроигрышную рулетку и выигрывайте сногсшибательные призы!
            </p>
          </div>
        </div>

    </div>
    
    
<script type="text/javascript" src="./templates/<?php echo $template; ?>/js/roulette.js"></script>