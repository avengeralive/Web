    <div class="container">

            <?php include './templates/'.$template.'/blocks/menu-top-home.php'; ?>

		<div class="row page-home ">
                    <div class="col-4 contact-info d-flex align-items-center">
                        <div class="" style="height: 450px;">

                            <h2 class="mb-70"><?php echo $loc['contacts.php']['t01']; ?></h2>
                            
                            <?php
                            if (isset($settings_address) && $settings_address!=''){
                                echo '<p><i class="fa fa-map-marker" aria-hidden="true"></i> '.$settings_address.'</p>';
                            }
                            ?>
                            
                            <?php
                            if (isset($settings_phone) && $settings_phone!=''){
                                echo '<p><i class="fa fa-phone" aria-hidden="true"></i> '.$settings_phone.'</p>';
                            }
                            ?>
                            
                            <?php
                            if (isset($settings_email) && $settings_email!=''){
                                echo '<p><i class="fa fa-envelope" aria-hidden="true"></i> '.$settings_email.'</p>';
                            }
                            ?>
                            
                            <br>
                            
                            <?php
                            if (isset($settings_icq) && $settings_icq!=''){
                                echo '<p><img src="./templates/'. $template .'/img/icq.png"> '.$settings_icq.'</p>';
                            }
                            ?>
                            
                            <?php
                            if (isset($settings_skype) && $settings_skype!=''){
                                echo '<p><img src="./templates/'. $template .'/img/skype.png"> '.$settings_skype.'</p>';
                            }
                            ?>
                            
                            <br>
                            
                            <p class="mt-30 ml-10">TERA HOLDING Corp.</p>

                            <p class="ml-10">SEYCHELLES</p>

                        </div>    
                    </div>
                    
                    <div class="col p-0">
                        <div id="map">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2247.772128876754!2d37.59401063035307!3d55.710332567803604!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x46b54b659ae8f027%3A0x4b9724398f499019!2z0J7RgNC00LbQvtC90LjQutC40LTQt9C1INGD0LsuLCA4LCDQnNC-0YHQutCy0LAsIDExNTQxOQ!5e0!3m2!1sru!2sru!4v1530882325916" width="100%" height="600px" frameborder="0" style="border:0" allowfullscreen></iframe>
                        </div>
                    </div>
                    
		</div>
        

    </div>

    <!-- BEGIN FOOTER -->
        <?php include './templates/'.$template.'/blocks/footer.php'; ?>
    <!-- END FOOTER -->
