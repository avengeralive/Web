                <div class="user-menu ">

                    <div class="row justify-content-end align-items-center h-100 main">
                        <div class="col-auto balances mr-25">
                          <img src="./templates/<?= $template; ?>/img/deposit.png"> <?php echo $loc['in_header_top_menu']['t17']; ?> <a class="" href="./finances.php"><?php echo number_format($user_balance, 0, ',', ' '); ?></a> <i class="fa fa-rub" aria-hidden="true"></i>
                        </div>
                        <div class="col-auto balances mr-35">
                          <img src="./templates/<?= $template; ?>/img/passage-of-time.png"> <?php echo $loc['in_header_top_menu']['t15']; ?> <a class="" href="./finances.php"><?php echo number_format($user_hold, 0, ',', ' '); ?></a> <i class="fa fa-rub" aria-hidden="true"></i>
                        </div>
                        <div class="col-auto">

                            <div class="row align-items-center">
                                <div class="col-auto p-0">
                                    <img class="avatar" src="./tmp/avatars/<?=$user_ava; ?>">
                                </div>
                                <div class="col-auto ">
                                    <p class="mb-0">ID: <?=$user_id; ?></p>
                                    <p class="mb-0 SFD-m">
                                        <?php
                                        if(isset($user_login) && $user_login != ''){
                                            echo $user_login;
                                        }else{
                                            echo $user_email;
                                        }
                                        ?>
                                    </p>
                                </div>
                            </div>

                        </div>
                    </div>
                    
                </div>

