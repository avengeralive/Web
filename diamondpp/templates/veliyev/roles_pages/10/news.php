<main>
<?php 
if (isset($_GET['id'])) { 
    $result = $mysqli->query( "SELECT * FROM `news` WHERE `id`=".$_GET['id'] );    
    $res=mysqli_fetch_array($result);
    ?>
<div class="row grow">
        <div class="col-md-7">
            <h1><?php echo $res['news_zagolovok']; ?></h1>
        </div>
        <?php include './templates/' . $template . '/roles_pages/' . $user_tip . '/menu_top.php'; ?>
    </div>

    
    <div class="row grow">
        <div class="col-xl-12">
            
    <img src="./tmp/news/<?php echo $res['image']; ?>" style="width: 300px; float: left; margin-right: 15px;">
    <?php echo html_entity_decode($res['news'], ENT_QUOTES, 'utf-8'); ?>
    
</div>
</div>
<?php }
else { ?>
<div class="row grow">
        <div class="col-md-7">
            <h1><?php echo $loc['news.php']['t02']; ?></h1>
        </div>
        <?php include './templates/' . $template . '/roles_pages/' . $user_tip . '/menu_top.php'; ?>
    </div>

    
    <div class="row grow">
        <div class="col-xl-12">
            
    
    <?php
    // Подгружаем вывод новостей
    // Loads the output of the news
    include ('./templates/'.$template.'/blocks/news_output.php');
    ?>
    
</div>
</div>
<?php } ?>
    
</main>