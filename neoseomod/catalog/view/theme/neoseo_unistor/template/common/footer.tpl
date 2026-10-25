<!--<footer>
<?php if( $sections[1] || $sections[2] ) { ?>
    <div class="row footer-top">
        <div class="container">
            <div class="col-sm-6 text-left"><?php echo $sections[1]; ?></div>
            <div class="col-sm-6 text-right"><?php echo $sections[2]; ?></div>
        </div>
    </div>
    <?php } ?>
    <div class="footer-middle">
        <div class="container">
            <?php foreach( range(1,3) as $column_id ) { ?>
            <div class="footer-list-info col-md-<?php echo $column_id == 1 ? 3 : 3; ?> col-sm-<?php echo $column_id == 1 ? 6 : 6; ?> col-xs-<?php echo $column_id == 1 ? 12 : 12; ?>">
                <h5><?php echo $columns[$column_id]['name']; ?> <i class="fa fa-angle-down" aria-hidden="true"></i></h5>
                <?php if( $columns[$column_id]['type'] == "1" ) { ?>
                <ul class="list-unstyled">
                    <?php foreach ($columns[$column_id]['items'] as $item) { ?>
                    <li><a href="<?php echo $item['href']; ?>"><i class="fa fa-caret-right"></i><?php echo $item['name'] ?></a>
                    <?php } ?>
                </ul>
                <?php } else { ?>
                <div class="eshop-info"><?php echo $columns[$column_id]['items']; ?></div>
            <?php } ?>
            </div>
            <?php } ?>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="subscribe-footer">
                <h5><?php echo $text_subscribe_title; ?></h5>
                <div class="subscribe-par"><?php echo $text_subscribe_par; ?></div>
                <div class="input-group">
                    <input type="text" id="subscribefooter" name="subscribe" placeholder="<?php echo $entry_email; ?>">
                    <button type="submit" onclick="processSubscribe('footer')" class="btn submit-btn">
                        <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
            <h5 class="payment-title"><?php echo $text_payments_title; ?></h5>
            <?php echo $sections[5]; ?>
        </div>
    </div>
    </div>
    <?php if( $sections[3] || $sections[4] ) { ?>
    <div class="row footer-bottom">
        <div class="container">
            <div class="col-xs-12">
                <div class="row">
                    <div class="col-sm-6 text-left"><?php echo $sections[3]; ?></div>
                    <div class="col-sm-6 text-right"><?php echo $sections[4]; ?></div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
</footer>-->

<footer id="footer">
  
  
<div class="footer-center " id="pavo-footer-center">
  <div class="container">
    <div class="wrap-fcenter">
    <div class="row">

              <!--<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
          <div class="box contact-us">
            <div class="box-heading"><span>Contact Us</span></div>
              <div class="box-content">
              <div class="description">                     <div class="pull-left image-contact hidden-xs"><img alt="" src="image/data/image-footer.png"></div>                     <p>Mauris in erat justo nullam ac sit amet a augue. Sed non neque elit Sed ut imperdiet nisi. Proin per inceptos himenaeos. Mauris in erat justo</p>                    </div>                      <ul class="list">                       <li><span class="iconbox"><i class="fa fa-map-marker">&nbsp;</i></span><span>Proin gravida nibh vel velit auctor aliquet aene</span></li>                       <li><span class="iconbox"><i class="fa fa-mobile-phone">&nbsp;</i></span><span>Phone: +01 888 (000) 1234</span></li>                        <li><span class="iconbox"><i class="fa fa-envelope-o">&nbsp;</i></span><span>Email: pav_golfsine@gmail.com</span></li>                      </ul>            </div>
          </div>
        </div> -->       
            <div class="col-xs-12 col-sm-9 col-md-9">
        <?php foreach( range(1,3) as $column_id ) { ?>
            <div class="footer-list-info col-md-<?php echo $column_id == 1 ? 3 : 3; ?> col-sm-<?php echo $column_id == 1 ? 6 : 6; ?> col-xs-<?php echo $column_id == 1 ? 12 : 12; ?>">
                <h5><?php echo $columns[$column_id]['name']; ?> <i class="fa fa-angle-down" aria-hidden="true"></i></h5>
                <?php if( $columns[$column_id]['type'] == "1" ) { ?>
                <ul class="list-unstyled">
                    <?php foreach ($columns[$column_id]['items'] as $item) { ?>
                    <li><a href="<?php echo $item['href']; ?>"><i class="fa fa-caret-right"></i><?php echo $item['name'] ?></a>
                    <?php } ?>
                </ul>
                <?php } else { ?>
                <div class="eshop-info"><?php echo $columns[$column_id]['items']; ?></div>
            <?php } ?>
            </div>
            <?php } ?>
      </div>
        
      <!--<div class="col-xs-12 col-sm-6 col-md-2 col-lg-2">
        <div class="box">
        <div class="box-heading"><span>Extras</span></div>
        <div class="box-content">
          <ul class="list">
            <li><a href="http://demopavothemes.com/pav_golfsine/index.php?route=product/manufacturer">Brands</a></li>
            <li><a href="http://demopavothemes.com/pav_golfsine/index.php?route=account/voucher">Gift Certificates</a></li>
            <li><a href="http://demopavothemes.com/pav_golfsine/index.php?route=affiliate/account">Affiliates</a></li>
            <li><a href="http://demopavothemes.com/pav_golfsine/index.php?route=product/special">Specials</a></li>
            <li><a href="http://demopavothemes.com/pav_golfsine/index.php?route=account/return/add">Returns</a></li>
            <li><a href="http://demopavothemes.com/pav_golfsine/index.php?route=account/account">My Account</a></li>
            <li><a href="http://demopavothemes.com/pav_golfsine/index.php?route=account/order">Order History</a></li>
          </ul>
        </div>
        </div>
      </div>
      

        <div class="col-xs-12 col-sm-6 col-md-2 col-lg-2">
            <div class="container">
                <div class="col-xs-12">
                    <div class="row">
                        <div class="col-sm-6 text-left"><?php echo $sections[3]; ?></div>
                        <div class="col-sm-6 text-right"><?php echo $sections[4]; ?></div>
                    </div>
                </div>
            </div>
        </div>   -->     
      
      <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
            <div class="subscribe-footer">
                <h5><?php echo $text_subscribe_title; ?></h5>
                <div class="subscribe-par"><?php echo $text_subscribe_par; ?></div>
                <div class="input-group">
                    <input type="text" id="subscribefooter" name="subscribe" placeholder="<?php echo $entry_email; ?>">
                    <button type="submit" onclick="processSubscribe('footer')" class="btn submit-btn">
                        <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
            <h5 class="payment-title"><?php echo $text_payments_title; ?></h5>
            <?php echo $sections[5]; ?>
    </div>      
      </div>
      <div class="row">
        <div class="column col-xs-12 col-sm-12 col-md-12 col-lg-12">
                      <div class="widget_banner_footer algin-center">
              <p><img class="img-responsive" src="image/catalog/demo/userfull-link.png" alt=""></p>            </div>
                  </div>
      </div>
    </div>
    </div>
  </div>

  <!--<p id="back-top" style="display: block;"> <a href="#top"><i class="fa fa-caret-up"></i></a> </p>-->
<div id="powered">
  <div class="container">
      <div class="copyright pull-left">
                  <!--Разработано компанией <a href="https://neoseo.com.ua/">NeoSeo</a><br>--> © 2018 Indianshop. Все права защищены. <!--Дизайн от <a href="http://aliveliyev.com" title="pavothemes - opencart themes clubs">Студии Али Велиева</a>-->
      </div>
      
              <div class="paypal pull-right">
          <p><img src="image/catalog/paypal.png" alt=""></p>        </div>
        </div>
</div>
</footer>

<script>
<?php if( "1" == $neoseo_unistor_hover_image ) { ?>
    function hoverableImages(){
       $(".hoverable")
            .mouseover(function() {
                if($(this).data("over")){
                    $(this).attr("src", $(this).data("over"));
                }
            })
            .mouseout(function() {
                if($(this).data("out")){
                    $(this).attr("src", $(this).data("out"));
                }
            });
    }
    $(window).load(function(){
        hoverableImages();
    });
<?php } ?>


$('.footer-middle h5').click(function(){
    if( $(this).css('cursor')!='pointer' ) return;
    $(this).toggleClass('active')
            .next('ul').slideToggle(200);
});

$(window).resize(function(){
    if($('.footer-middle h5:first').css('cursor')!='pointer' ) {
        $('.footer-middle h5').removeClass('active').next('ul').css('display','block');
    } else {
        $('.footer-middle h5').removeClass('active').next('ul').slideUp(200);
    }
});
</script>
<?php if ($neoseo_smart_search_status) { ?>
<!-- NeoSeo Ajax Search - begin -->
<script>
    $('<?php echo $neoseo_smart_search_selector; ?>:not(#input-search)')
            .after('<div id="search_main" style="display:none"></div>')
            .keyup(function () {
                if ($('#stiky_box').hasClass('active')) {
                    $('<?php echo $neoseo_smart_search_selector; ?>').val($(this).val())
                } else {
                    $('#stiky_box <?php echo $neoseo_smart_search_selector; ?>').val($(this).val())
                }
                var language = "";
                if( window.current_language ) {
                    language = window.current_language;
                }
                var filter_category = $('.category-list-title').attr('data-categoryid');
                if (filter_category) {
                    var filter_category_id = '&filter_category='+filter_category+'&sub_category=true';
                } else {
                    var filter_category_id = '';
                }
                $.ajax({
                    url: language + 'index.php?route=module/neoseo_smart_search',
                    type: 'get',
                    dataType: 'json',
                    data: 'filter_name=' + encodeURIComponent($(this).val())+filter_category_id,
                    success: function (data) {
                        if (data['content']) {
                            $('#search_main, #stiky_box #search_main').html(data['content']);
                            $('#search_main, #stiky_box #search_main').show();
                        } else {
                            $('#search_main, #stiky_box #search_main').hide();
                        }
                    }
                });
            });
</script>
<!-- NeoSeo Ajax Search - end -->
<?php } ?>

</body></html>

