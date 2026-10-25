<main>
    <div class="row grow">
        <div class="col-md-7">
            <h1>Ваш профиль</h1>
        </div>
        <? include './templates/' . $template . '/roles_pages/' . $user_tip . '/menu_top.php'; ?>
    </div>
    <?php
    include ('./templates/'.$template.'/blocks/profile_form.php');
    ?>
</main>