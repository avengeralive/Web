<?php if ($comments) { ?>
<?php foreach ($comments as $comment) { ?>
<div id="<?php echo $comment['comment_id']; ?>" class="comment" itemprop="comment" itemscope itemtype="http://schema.org/UserComments">
    <div class="comment-body">
        <div class="comment-left pull-left">
            <div class="comment-meta clearfix">
                <div class="comment-author" itemprop="creator"><b><?php echo $comment['author']; ?></b></div>
                <div class="comment-date" itemprop="commentTime"><?php echo $comment['date_added']; ?></div>
            </div>
            <div class="comment-rating">
                <?php for ($i = 1; $i <= 5; $i++) { ?>
                <?php if ($comment['rating'] < $i) { ?>
                <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>
                <?php } else { ?>
                <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span>
                <?php } ?>
                <?php } ?>
            </div>
        </div>
        <div class="comment-right pull-right">
            <div class="comment-content" itemprop="commentText"><?php echo $comment['comment']; ?></div>
            <div class="comment-reply">
                <a href="#" class="comment-reply-link btn btn-sm btn-default pull-left" onclick="return replyComment(<?php echo $comment['comment_id']; ?>);"><?php echo $text_reply_comment; ?></a>
            </div>
        </div>
    </div>
    <?php if ($comment['comment_reply']) { ?>
    <div class="comment-children">
        <?php foreach ($comment['comment_reply'] as $comment_reply) { ?>
        <div id="<?php echo $comment_reply['comment_id']; ?>" class="comment">
            <div class="comment-body">
                <div class="comment-left pull-left">
                    <div class="comment-meta clearfix">
                        <div class="comment-author"><b><?php echo $comment_reply['author']; ?></b></div>
                        <div class="comment-date"><?php echo $comment_reply['date_added']; ?></div>
                    </div>
                </div>
                <div class="comment-right pull-right">
                    <div class="comment-content"><?php echo $comment_reply['comment']; ?></div>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
    <?php } ?>
</div>
<?php } ?>
<br/>
<div class="row paginator">
    <div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
    <div class="col-sm-6 text-right"><?php echo $results; ?></div>
</div>

<?php } else { ?>
<h5><?php echo $text_no_comments; ?></h5>
<?php } ?>
