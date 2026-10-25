<div id="content_" itemscope itemtype="http://schema.org/Article" class="blog-content">

    <div class="entry-meta">
                                        <span class="entry-date published">
                                        <i class="fa fa-calendar"></i> 15.01.2017
                                        </span>
                                        <span class="entry-author">
                                        <i class="fa fa-user"></i>
                                        <a href="https://demo.neoseo.com.ua/index.php?route=neoseo_blog/neoseo_blog_author&amp;author_id=1">neoseo</a>
                                        </span>
                                        </span><span class="entry-views">
                                        <i class="fa fa-eye"></i> Просмотров: 65
                                        <a href="https://demo.neoseo.com.ua/sovety-expertov-po-vyboru-laminata#comments"></a>
                                        </span>
                                        <span class="entry-comments-link">
                                        <i class="fa fa-comment-o"></i> Комментариев: 5
                                        </span>
    </div>

    <h2><?php echo $heading_title; ?></h2>
    <div class="row">
        <div class="aticle-body clearfix">
            <?php if ($thumb) { ?>
            <div class="image article-image text-center- pull-right">
                <a href="<?php echo $image; ?>" title="<?php echo $heading_title; ?>"><img src="<?php echo $thumb; ?>" class="img-thumbnail" title="<?php echo $heading_title; ?>" alt="<?php echo $heading_title; ?>"/></a>
            </div>
            <?php } ?>

            <div class="article-description">
                <?php echo $description; ?>
            </div>

            <?php if ($images) { ?>
            <?php if (!empty($gallery_heading)) { ?>
            <h3><?php echo $gallery_heading; ?></h3>
            <?php } ?>
            <div class="popup-gallery">
                <?php foreach ($images as $img) { ?>
                <a href="<?php echo $img['image']; ?>"><img src="<?php echo $img['thumb']; ?>" alt="" class="img-thumbnail"></a>
                <?php } ?>
            </div>
            <?php } ?>
        </div>
    </div>
</div>
<script type="text/javascript"><!--
    $(document).ready(function () {
        $('.article-image a').magnificPopup({
            type: 'image',
            callbacks: {
                resize: changeImgSize,
                imageLoadComplete: changeImgSize,
                change: changeImgSize
            }
        });
        $('.popup-gallery').magnificPopup({
            delegate: 'a',
            type: 'image',
            tLoading: 'Loading image #%curr%...',
            mainClass: 'mfp-img-mobile',
            gallery: {
                enabled: true,
                navigateByImgClick: true
            },
            image: {
                tError: '<a href="%url%">The image #%curr%</a> could not be loaded.'
            },
            callbacks: {
                resize: changeImgSize,
                imageLoadComplete: changeImgSize,
                change: changeImgSize
            }
        });
    });
    function changeImgSize() {
        var img = this.content.find('img');
        img.css('max-height', window.innerHeight);
        img.css('width', 'auto');
        img.css('max-width', 'auto');
    }
    //--></script>