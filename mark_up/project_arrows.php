<section style="height: 150px;">
    <div class='color-block-info grey-block'>
        <div class='container sm-gal bot90' style="top: -31px;">
            <div class="pr_nx">

                <?php

                $link = get_previous_post_link_pr();
                $pr = get_previous_post_link('%link', 'Next post in category', TRUE);

                if($link){?>
                    <span class="pr"><a href="<?=$link?>" rel="prev">Previous in category</a></span>
                <?php
                }else{?>
                    <?php
                    $categories = get_the_category();
                    if ( count( $categories ) ) {
                        $category = array_shift( $categories );
                        $cat_id = $category->cat_ID;
                        $args = array( 'category' => $cat_id, 'order' => 'DESC' );
                        $posts2 = get_posts( $args );

                        $link2 = $posts2[0]->guid;
                        echo '<span class="pr"><a href="'.$link2.'"></a></span>	';
                    }
                    ?>
                <?php
                }?>

                <?php
                $nx = get_next_post_link('%link', 'Next post in category', TRUE);
                if($nx!=null && !empty($nx)){?>
                    <span class="nx"><?php next_post_link('%link', 'Next post in category', TRUE); ?></span>
                <?php
                }else{?>
                    <?php
                    $categories = get_the_category();
                    if ( count( $categories ) ) {
                        $category = array_shift( $categories );
                        $cat_id = $category->cat_ID;

                        $args = array( 'category' => $cat_id, 'order' => 'ASC' );
                        $posts = get_posts( $args );

                        $link = $posts[0]->guid;
                        echo '<span class="nx"><a href="'.$link.'"></a></span>';
                    }
                    ?>
                <?php
                }?>



            </div>
        </div>
    </div>
</section>

