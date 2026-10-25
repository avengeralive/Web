<div class="row main mt-50 mb-50">

    

    <?php
    if (isset($_GET['offer']) && ($_GET['offer']!='')){
        include './templates/'.$template.'/blocks/offers_10_view.php';
    }elseif (isset($_GET['my'])){
        echo '<div class="col-12 mb-10"><p class="pageTitle mb-25">'.$loc['offers.php']['r26'].'</p></div>';
        include './templates/'.$template.'/blocks/offers_my.php';
    }else{
        echo '<div class="col-12 mb-10"><p class="pageTitle mb-25">'.$loc['offers.php']['t01'].'</p></div>';
        include './templates/'.$template.'/blocks/offers_10_spisok.php';
    }
    ?>

    
</div>