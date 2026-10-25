
                                <section class="no-border comments-start">
                                    <div class="comments-holder clearfix">
                                        <h3><? echo get_comments_number() ?> комментариев</h3>
                                        <ul class="commentlist clearfix">
                                            <?php
                                                wp_list_comments( array(
                                                    'style'       => 'ul',
                                                    'short_ping'  => true,
                                                    'avatar_size' => 42,
                                                ) );
                                            ?>
                                        </ul>
                                        <div class="comment-form-holder clearfix">
                                            <div id="respond" class="comment-respond">
                                                <h3 id="reply-title" class="comment-reply-title">Оставить комментарий</h3>            
                                                <form action="/wp-comments-post.php" method="post" id="comment-form" class="comment-form" novalidate="">
                                                    <p class="comment-notes">Ваш адрес эленктронной почты не будет опубликован.</p>
                                                    <input type="text" id="author" name="author" placeholder="Имя" value="" aria-required="true">
                                                    <input id="email" name="email" type="text" placeholder="E-mail" value="" aria-required="true">
                                                    <textarea placeholder="Комментарий" id="comment" rows="9" name="comment" aria-required="true"></textarea>
                                                    <p class="form-submit"><input name="submit" type="submit" id="submit" class="submit" value="Опубликовать →"> <input type="hidden" name="comment_post_ID" value="<? echo get_the_ID(); ?>" id="comment_post_ID">
<input type="hidden" name="comment_parent" id="comment_parent" value="0">
</p>            </form>
            </div>
        </div>


    </section>