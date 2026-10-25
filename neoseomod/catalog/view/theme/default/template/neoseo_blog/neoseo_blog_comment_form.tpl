<?php if (!empty($heading_title)) { ?>
<h3><?php echo $heading_title; ?></h3>
<?php } ?>

<h2><?php echo $text_comments; ?></h2>

<div class="clearfix">
    <form class="form-horizontal <?php echo $captcha ? 'with-captcha' : ''; ?>" id="form-comment">
        <div id="comments"></div>
        <h2 id="comment_write">
            <?php echo $text_write; ?>
            <a href="#" id="reply-remove" class="hide small" onclick="return removeReply();">[<?php echo $text_cancel_reply; ?>]</a>
        </h2>
        <input type="hidden" value="0" id="reply-id" name="reply_id"/>
        <div class="form-group required">
            <div class="col-sm-12">
                <label class="control-label" for="input-name"><?php echo $entry_name; ?></label>
                <input type="text" name="name" value="" id="input-name" class="form-control"/>
            </div>
        </div>
        <div class="form-group required">
            <div class="col-sm-12">
                <label class="control-label" for="input-review"><?php echo $entry_comment; ?></label>
                <textarea name="text" rows="5" id="input-review" class="form-control"></textarea>
                <div class="help-block"><?php echo $text_note; ?></div>
            </div>
        </div>
        <div class="form-group required">
            <div class="col-sm-12 rating-fl">
                <label class="control-label zrate-label"><?php echo $entry_rating; ?></label>

                <div class="z_stars" id='zs_rate'>
                    <span></span><span></span><span></span><span></span><span></span>
                    <input type="hidden" name="rating" class='inp-rating' value="3"/>
                </div>

            </div>
        </div>
        <div class="col-sm-12 comment-captcha">
            <?php echo $captcha; ?>
        </div>
        <div style="margin-bottom:20px">
            <div class="buttons clearfix">
                <div class="text-left">
                    <button type="button" id="button-comment" data-loading-text="<?php echo $text_loading; ?>" class="btn btn-primary"><?php echo $button_submit; ?></button>
                </div>
            </div>
        </div>
    </form>
</div>

<script type="text/javascript">

    function removeReply() {
        $("#reply-id").val(0);
        $("#reply-remove").addClass('hide');

        return false;
    }

    function replyComment(comment_id) {

        $("#reply-id").val(comment_id);
        $("#reply-remove").removeClass('hide');

        $('html, body').animate({
            scrollTop: $("#comment_write").offset().top
        }, 500);

        return false;
    }

    $('#comments').delegate('.pagination a', 'click', function (e) {
        e.preventDefault();

        $('#comments').fadeOut('slow').load(this.href).fadeIn('slow');

        $('html, body').animate({
            scrollTop: $("#comments").offset().top
        }, 500);
    });

    $('#comments').load('index.php?route=neoseo_blog/neoseo_blog_comment&article_id=<?php echo $article_id; ?>');

    $('#button-comment').on('click', function () {
        $.ajax({
            url: 'index.php?route=neoseo_blog/neoseo_blog_comment/write&article_id=<?php echo $article_id; ?>',
            type: 'post',
            dataType: 'json',
            data: $("#form-comment").serialize(),
            beforeSend: function () {
                $('#button-review').button('loading');
            },
            complete: function () {
                $('#button-comment').button('reset');
            },
            success: function (json) {
                $('.alert-success, .alert-danger').remove();

                if (json['error']) {
                    $('#comments').after('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + '</div>');
                    $('.alert').delay(3000).fadeOut('slow');
                }

                if (json['success']) {
                    $('#comments').after('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['success'] + '</div>');
                    $('.alert').delay(3000).fadeOut('slow');

                    $('input[name=\'name\']').val('');
                    $('textarea[name=\'text\']').val('');

                    removeReply();

                    $('#comments').load('index.php?route=neoseo_blog/neoseo_blog_comment&article_id=<?php echo $article_id; ?>');
                }
            }
        });
    });

    // STARs
    $('.z_stars span').mouseenter(function(e) {
        var n = $(this).index();
        $(this).siblings('span').each(function(index, element) {
            if( $(this).index() < n ) $(this).addClass('active');
            else $(this).removeClass('active');
        });
    });
    $('.z_stars span').mouseleave(function(e) {
        var n = $(this).index();
        var p = $(this).parent('.z_stars');
        var s = p.data('value');
        if( s ) {
            if( n == s - 1 ) { $(this).addClass('active');}
            else {
                p.find('span').each(function(index, element) {
                    if( $(this).index() < s ) $(this).addClass('active');
                    else $(this).removeClass('active');
                });
            }
        } else {
            $(this).siblings('span').each(function(index, element) {
                $(this).removeClass('active');
            });
        }
    });
    $('.z_stars span').click(function(e) {
        var i = $(this).index();
        $(this).parent('.z_stars').data('value', i + 1);
        $(this).parent('.z_stars').find('input.inp-rating').val(i+1);
        $(this).addClass('active');
    });
    $('.z_stars').mouseleave(function(e) {
        var s = $(this).data('value');
        if(s){
            $(this).find('span').each(function(index, element) {
                if( $(this).index() < s ) $(this).addClass('active');
            });
        }
    });
    $('.z_stars').data('value',3);
    $('.z_stars .inp-rating').val(3);
    $('.z_stars span:lt(3)').addClass('active');
</script> 	