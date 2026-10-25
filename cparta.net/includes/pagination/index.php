<?php

// Функция пагинации
// Pagination feature
function pagination($result, $items_per_page, $max_pages) {
    global $offset, $show_pages, $pagination_fetched_row, $pages_count;

    $row = $pagination_fetched_row;
    if (!$row) {
        $row = mysqli_fetch_assoc($result);
        $pagination_fetched_row = $row;
    }
    $rows_max = $row['count'];


    // Текущая страница и смещение
    // Current Page and offset
    $this_page = ( isset($_GET['page']) && !empty($_GET['page']) ) ? filter_var($_GET['page'], FILTER_SANITIZE_NUMBER_INT) : 1;

    // Общее количество страниц
    // Total number of pages
    $pages_count = ceil($rows_max / $items_per_page);
    if ($pages_count == 0) {
        return false;
    }

    $mid_pages = floor($max_pages / 2);
    $start_page = max(1, min($this_page - $mid_pages, $pages_count));
    $end_page = max(1, min($this_page + $mid_pages, $pages_count));

    if ($this_page <= $mid_pages) {
        $end_page += max(0, $mid_pages - $this_page + 1);
    }

    if ($this_page >= $pages_count - $mid_pages) {
        $start_page += min(0, $pages_count - $this_page - $mid_pages);
    }

    if ($pages_count < $max_pages) {
        $start_page = 1;
        $end_page = max(1, $pages_count);
    }
    
    if ($pages_count > 3) {
    ?>    
        <div id="pagination-before-after"><a class="left" href="<?php echo build_pagination_url($this_page - 1); ?>"></a></div>
    <?php    
    }

    if ($pages_count != 1) {
        if($this_page >= 3){
            echo '<div id="pagination"><a class="navigation-page" href="'. build_pagination_url(1) .'">1</a></div>';
            echo '<div id="pagination"> ... </div>';
            for ($r = $start_page; $r <= $end_page; $r++) {
                if($r < ($this_page-1)){
                    continue;
                }               
                if($r > ($this_page+1) && $this_page < ($end_page - 1)){
                    echo '<div id="pagination"> ... </div>';
                    echo '<div id="pagination"><a class="navigation-page" href="'. build_pagination_url($end_page) .'">'.$end_page.'</a></div>';
                    break;
                }
                ?><div id="pagination"><?php
                if ($r != $this_page) {

                    ?><a class="navigation-page" href="<?php echo build_pagination_url($r); ?>"><?php echo $r; ?></a><?php
                } else {
                    ?><span class="act"><?php echo $r; ?></span><?php
                }
                ?></div><?php
            }             
        }elseif($this_page < 3){
            for ($r = 1; $r <= $end_page; $r++) {            
                if($r > 3){
                    echo '<div id="pagination"> ... </div>';
                    echo '<div id="pagination"><a class="navigation-page" href="'. build_pagination_url($end_page) .'">'.$end_page.'</a></div>';
                    break;
                }
                ?><div id="pagination"><?php
                if ($r != $this_page) {

                    ?><a class="navigation-page" href="<?php echo build_pagination_url($r); ?>"><?php echo $r; ?></a><?php
                } else {
                    ?><span class="act"><?php echo $r; ?></span><?php
                }
                ?></div><?php
            }            
        }
        
    }

    if ($pages_count > 3) {
    ?>    
        <div id="pagination-before-after"><a class="right" href="<?php echo build_pagination_url($this_page + 1); ?>"></a></div>
    <?php    
    }
    ?>  
        
<!--        
        <div id="pagination-before-after"><a class="navigation-page" href="<?php echo build_pagination_url($pages_count); ?>">&gt;</a></div>
-->        
            <?php

        // Ставим нужные глобальные переменные
        // Put the desired global variables
        $show_pages = $items_per_page;
        $offset = ( $show_pages * $this_page ) - $show_pages;

        return false;
    }
    ?>