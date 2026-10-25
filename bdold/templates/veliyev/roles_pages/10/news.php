<div class="row main mt-50 mb-50">
    
    <div class="col-12 mb-25">
        <p class="pageTitle"><span><?php echo $loc['news.php']['t02']; ?></span></p>
    </div>
    

    
    <?php
    // Подгружаем вывод новостей
    // Loads the output of the news
    include ('./templates/'.$template.'/blocks/news_output.php');
    ?>
    
    

    
</div>