<main>
    <div class="row grow">
        <div class="col-md-7">
            <h1>Офферы</h1>
        </div>
        <? include './templates/' . $template . '/roles_pages/' . $user_tip . '/menu_top.php'; ?>
    </div>
    <?php
    if (isset($_GET['offer']) && ($_GET['offer']!='')){
        include './templates/'.$template.'/blocks/offers_10_view.php';
    }elseif (isset($_GET['my'])){
        //echo '<div class="col-12 mb-10"><p class="pageTitle mb-25">'.$loc['offers.php']['r26'].'</p></div>';
        include './templates/'.$template.'/blocks/offers_my.php';
    }else{
        //echo '<div class="col-12 mb-10"><p class="pageTitle mb-25">'.$loc['offers.php']['t01'].'</p></div>';
        include './templates/'.$template.'/blocks/offers_10_spisok.php';
    }
    ?>
</main>
