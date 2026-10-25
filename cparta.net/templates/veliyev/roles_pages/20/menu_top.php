                <div class="user-menu ">

                    <div class="row justify-content-end align-items-center h-100 main">
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

