                <div class="user-menu ">

                    <div class="row justify-content-end align-items-center h-100 main">
                        <div class="col-auto balances mr-25">
                          <img src="./templates/<?= $template; ?>/img/deposit.png"> <?php echo $loc['in_header_top_menu']['t17']; ?> <a class="" href="#"><?php echo number_format($user_balance, 0, ',', ' '); ?></a> <i class="fa fa-rub" aria-hidden="true"></i>
                        </div>
                        <div class="col-auto balances mr-35">
                        <?php
                        $s = Seller::getById($user_id);
                        $forecast = $s->forecastBalance();
                        if($forecast['count'] >= 5 && $forecast['zakaz'] != 0){
                            $f_str = '<font color="green">'.$loc['in_header_top_menu']['t50'].'</font>';
                        }elseif($forecast['count'] < 5 && $forecast['zakaz'] != 0){
                            $f_str = '<a href="./finances.php"><font color="red">'.$loc['in_header_top_menu']['t51'].'</font></a>';
                        }elseif($forecast['zakaz'] == 0){
                            $f_str = $loc['in_header_top_menu']['t52'];
                        }
                        ?>
                        <div style="position:relative;display:inline;">
                        <?php echo $loc['in_header_top_menu']['t49']; ?>&nbsp; <?php echo $f_str; ?> 
                        <?php
                        if($forecast['zakaz'] != 0){
                        ?>
                        <div class="faq_rowcast">
                            Хватит на <?=$forecast['count']; ?> <?=$forecast['days_str']; ?>
                        </div>
                        <?php
                        }
                        ?>    
                        </div>
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

