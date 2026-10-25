                <div class="user-menu ">

                    <div class="row justify-content-end align-items-center h-100 main">
                        <div class="col-auto balances mr-25">
                            <?php
                            $req = $mysqli->query("SELECT track_webmasters FROM `users` WHERE `id`='$_SESSION[id]'");
                            $res = mysqli_fetch_assoc($req);
                            $tarck_webmasters = explode(",", $res['track_webmasters']);
                            $money = 0;
                            unset($req,$res);
                            foreach ($tarck_webmasters as $value) {
                                $req = $mysqli->query("SELECT balance FROM `users` WHERE `id`='$value'");
                                $res = mysqli_fetch_assoc($req);
                                $money += $res['balance'];
                            }
                            unset($req,$res);
                            ?>
                          <img style="margin-bottom: 8px;" src="./templates/<?= $template; ?>/img/deposit.png"> Баланс команды <a class="" href="#"><?php  echo $money; ?></a> <i class="fa fa-rub" aria-hidden="true"></i>
                        </div>
                        <div class="col-auto">

                            <div class="row align-items-center">
                                <div class="col-auto p-0">
                                    <img class="avatar" src="./tmp/avatars/<?=$user_ava; ?>">
                                </div>
                                <div class="col-auto ">
                                    <p class="mb-0"><b><?php echo htmlentities($user_tip_title); ?></b></p>
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

