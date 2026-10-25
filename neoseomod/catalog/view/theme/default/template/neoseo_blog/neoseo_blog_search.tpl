<?php echo $header; ?>
<div class="container">
    <?php require_once(dirname(__FILE__) . '/../common/breadcrumbs.tpl'); ?>
    <div class="row"><?php echo $column_left; ?>
        <?php if ($column_left && $column_right) { ?>
        <?php $class = 'col-sm-6'; ?>
        <?php } elseif ($column_left || $column_right) { ?>
        <?php $class = 'col-sm-9'; ?>
        <?php } else { ?>
        <?php $class = 'col-sm-12'; ?>
        <?php } ?>
        <div id="content" itemscope itemtype="http://schema.org/Article" class="blog-content <?php echo $class; ?>"><?php echo $content_top; ?>
            <h1><?php echo $heading_title; ?></h1>
            <?php if (!empty($thumb) || !empty($description)) { ?>
            <div class="row">
                <?php if (!empty($thumb)) { ?>
                <div class="col-sm-2">
                    <img src="<?php echo $thumb; ?>" alt="<?php echo $heading_title; ?>" title="<?php echo $heading_title; ?>" class="img-thumbnail"/>
                </div>
                <?php }  ?>
                <?php if (!empty($description)) { ?>
                <div class="col-sm-10"><?php echo $description; ?></div>
                <?php } ?>
            </div>
            <hr>
            <?php } ?>

            <?php if (!empty($search_form)) { ?>
            <?php echo $search_form; ?>
            <?php } ?>

            <?php if ($articles) { ?>

            <br/>

						<div class="row paginator pagin-top">
                <div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
                <div class="col-sm-6 text-right"><?php echo $results; ?></div>
            </div>

            <div class="row producte">
                <?php foreach ($articles as $article) { ?>

                <div class="product-layout product-list col-xs-12">
                    <div class="product-thumb clearfix">
					<?php if($article['thumb']){ ?>
                        <div class="images">
                            <a href="<?php echo $article['href']; ?>"><img src="<?php echo $article['thumb']; ?>" alt="<?php echo $article['name']; ?>" title="<?php echo $article['name']; ?>" class="img-responsive"/></a>
                        </div>
					<?php } ?> 
                        <div>
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
                </div>
                <?php } ?>
            </div>
            <div class="row paginator">
                <div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
                <div class="col-sm-6 text-right"><?php echo $results; ?></div>
            </div>
            <?php } ?>
            <?php if (!$articles) { ?>
            <p><?php echo $text_empty; ?></p>
            <div class="buttons">
                <div class="pull-right">
                    <a href="<?php echo $continue; ?>" class="btn btn-primary"><?php echo $button_continue; ?></a></div>
            </div>
            <?php } ?>
            <?php echo $content_bottom; ?></div>
        <?php echo $column_right; ?></div>
</div>
<?php echo $footer; ?>
