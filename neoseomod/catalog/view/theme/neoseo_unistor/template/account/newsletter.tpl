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
        <div id="content" class="<?php echo $class; ?>"><?php echo $content_top; ?>
            <h1><?php echo $heading_title; ?></h1>
            <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
                <fieldset>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?php echo $entry_newsletter; ?></label>
                        <div class="col-sm-10">
                            <?php if ($newsletter) { ?>
								<div class="radio radio-primary radio-inline">
                                	<input type="radio" id="news-1" name="newsletter" value="1" checked="checked"/>
									<label for="news-1"><?php echo $text_yes; ?></label>
								</div>
								<div class="radio radio-primary radio-inline">
                                	<input id="news-2" type="radio" name="newsletter" value="0"/>
									<label for="news-2"><?php echo $text_no; ?></label>
								</div>
                            <?php } else { ?>
								<div class="radio radio-primary radio-inline">
									<input id="news-1" type="radio" name="newsletter" value="1"/>
									<label for="news-1"><?php echo $text_yes; ?> </label>
								</div>
								<div class="radio radio-primary radio-inline">
									<input id="news-2" type="radio" name="newsletter" value="0" checked="checked"/>
									<label for="news-2"><?php echo $text_no; ?></label>
								</div>
                            <?php } ?>
                        </div>
                    </div>
                </fieldset>
                <div class="buttons clearfix">
                    <div class="pull-right">
                        <input type="submit" value="<?php echo $button_update; ?>" class="btn btn-primary"/>
                    </div>
                </div>
            </form>
            <?php echo $content_bottom; ?>
        </div>
        <?php echo $column_right; ?>
    </div>
</div>
<?php echo $footer; ?>