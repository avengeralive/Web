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
                <!-- <div class="col-sm-6">
                    <div class="well box-shadow box-corner">
                        <h2><?php echo $text_new_customer; ?></h2>
                        <p><strong><?php echo $text_register; ?></strong></p>
                        <p><?php echo $text_register_account; ?></p>

                    </div>
                </div> -->
            <div class="login-block box-shadow box-corner">
                <?php if ($success) { ?>
                <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?></div>
                <?php } ?>
                <?php if ($error_warning) { ?>
                <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?></div>
                <?php } ?>


                <div class="row-colored login-title">
                    <h1><i class="fa fa-sign-in" aria-hidden="true"></i> <?php echo $text_i_am_returning_customer; ?></h1>

                    

                </div>
                <div class="login-content">
                    <!-- NeoSeo Social Auth - begin -->
                    <?php if($neoseo_social_auth_status){ ?>
                        <?php if (isset($social_error)) { echo $social_error; } ?>
                        <div class="socialLogin">
                            <span><?php echo $text_enter_social ?></span><!--<p><strong><?php echo $social_auth_title; ?></strong></p>-->
                            <script src="https://ulogin.ru/js/ulogin.js"></script>
                            <div id="uLogin"  data-ulogin="display=panel;theme=flat;fields=first_name,last_name,email,phone,city,country;mobilebuttons=0;sort=<?php echo $social_auth_sort; ?>;providers=<?php echo $social_networks;?>;hidden=;redirect_uri=<?php echo $domain; ?>"></div>
                        </div>
                    <?php } ?>
                    <!-- NeoSeo Social Auth - end -->


                    <!-- <p><strong><?php echo $text_i_am_returning_customer; ?></strong></p> -->
                    <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
                        <?php if ($redirect) { ?>
                        <input type="hidden" name="redirect" value="<?php echo $redirect; ?>"/>
                        <?php } ?>
                        <div class="row row-login">
                            <div class="form-group col-xs-12 col-sm-4 col-mail">
                                <input type="text" name="email" value="<?php echo $email; ?>" placeholder="<?php echo $entry_email; ?>" id="input-email" class="form-control"/>
                            </div>
                            <div class="form-group col-xs-12 col-sm-4 col-psw">
                                <input type="password" name="password" value="<?php echo $password; ?>" placeholder="<?php echo $entry_password; ?>" id="input-password" class="form-control"/>
                            </div>
                            <div class="form-group login-forgot col-xs-12 col-sm-4 ">
                                <a href="<?php echo $forgotten; ?>" class="login-forgot"><?php echo $text_forgotten; ?></a>  <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                            </div>
                            <div class=" login-btns col-sm-4 block-flex">
                                <div class="block-flex-col">
                                    <div class="checkbox">
                                        <input class="checkbox" id="chck1" type="checkbox" >
                                        <label class="remember" for="chck1"><?php echo $text_remember_me ?></label>
                                    </div>
                                    <a href="<?php echo $register; ?>" class="btn btn-primary btn-reg"><?php echo $text_register ?></a>
                                </div>
                                <input type="submit" value="<?php echo $button_login; ?>" class="btn btn-primary btn-login"/>

                            </div>
                        </div>
                        
                        <div class="row">

                        </div>
                    </form>
                </div>


            </div>
            <?php echo $content_bottom; ?>
        </div>
        <?php echo $column_right; ?>
    </div>
</div>
<?php echo $footer; ?>
