<?php if (!empty($heading_title)) { ?>
<h3><?php echo $heading_title; ?></h3>
<?php } ?>
<div class="row article-block">
    <?php foreach ($articles as $article) { ?>
    <div class="product-layout col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <div class="product-thumb">

            <div class="image">
                <a href="<?php echo $article['href']; ?>"><img src="<?php echo $article['thumb']; ?>" alt="<?php echo $article['name']; ?>" title="<?php echo $article['name']; ?>" class="img-responsive"/></a>
            </div>

            <div class="caption">

                <?php if(!empty($blog_meta['date']) || !empty($blog_meta['author']) || !empty($blog_meta['comments']) || !empty($blog_meta['category'])) { ?>
                <div class="entry-meta">
                    <?php if(!empty($blog_meta['date'])) { ?>
                    <span class="entry-date published">
                        <i class="fa fa-calendar"></i>
                        <?php echo $article['date_modified']; ?>
                    </span>
                    <?php } ?>
                    <?php if(!empty($blog_meta['author'])) { ?>
                    <span class="entry-author">
                        <i class="fa fa-user"></i>
                        <a href="<?php echo $article['author']['href']; ?>"><?php echo $article['author']['name']; ?></a>
                    </span>
                    <?php } ?>
                    <?php if (!empty($blog_meta['comments']) && $article['total_comments']) { ?>
                    <span class="entry-comments-link">
                        <i class="fa fa-comment-o"></i>
                        <a href="<?php echo $article['href']; ?>#comments"><?php echo $article['total_comments']; ?></a>
                    </span>
                    <?php } ?>
                    <?php if (!empty($blog_meta['category']) && $article['category']) { ?>
                    <span class="entry-category-link"><i class="fa fa-folder-open-o"></i>
                        <a href="<?php echo $article['category']['href']; ?>" rel="category tag"><?php echo $article['category']['name']; ?></a>
                    </span>
                    <?php } ?>
                </div>
                <?php } ?>

                <h4><a href="<?php echo $article['href']; ?>"><?php echo $article['name']; ?></a></h4>

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

                <p><?php echo $article['description']; ?></p>
            </div>
        </div>
    </div>
    <?php } ?>
</div>
