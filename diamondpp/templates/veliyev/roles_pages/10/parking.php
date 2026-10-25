<main>
    <div class="row grow">
        <div class="col-md-7">
            <h1>Инструменты</h1>
        </div>
        <?php include './templates/' . $template . '/roles_pages/' . $user_tip . '/menu_top.php'; ?>
    </div>

    <div class="row grow">
        
        <div class="col-md-12">
            <div class="col-md-12">
                <a class="btn-link active" style="padding-right: 15px;" href="./parking.php">Парковка доменов</a>
                <!--<a class="btn-link snd" style="padding-right: 15px;" href="./buydomain.php">Покупка домена</a>-->
                <a class="btn-link snd" style="padding-right: 15px;" href="./postback.php">Глобальный постбек</a>
           </div>
       </div>
        
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                <div class="row irow">
                    <div class="col-md-12 mt-30">

            <?php

            $db = DB::getInstance();
            if(isset($_POST['del']) && $_POST['del'] != 0){
                $domain_id = intval($_POST['del']);
                $sql = "select * from domains where user_id='$user_id' AND `id` = '$domain_id' LIMIT 1";
                $row = $db->query($sql)->fetch(PDO::FETCH_ASSOC);
                if($row){
                    $sql = "delete from domains where user_id='$user_id' AND `id` = '$domain_id' LIMIT 1";
                    $db->query($sql);
                    $error_message = $loc['parking.php']['t08'];$error_type = 'success';
                }
            }
            if(isset($_POST['domain']) && $_POST['domain'] != ''){
                $domain = htmlentities($_POST['domain']);
                $comment = htmlentities($_POST['comment']);
                $replace = array("http://","https://");  
                $domain = str_replace($replace, "", $domain);       
                $url_arr = parse_url('http://'.$domain);
                $domain = $url_arr['host'];    
                if (preg_match("~^(?:[a-z0-9](?:[-a-z0-9]*[a-z0-9])?\.)+[a-z](?:[-a-z0-9]*[a-z0-9])?\.?(?:$|/)~Di", $domain))
                {              
                    $sql = "select * from domains where `domain` = '$domain' LIMIT 1";
                    $domains_row = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
                    if(!$domains_row){
                        $sql = "insert into domains (`domain`,`active`,`comment`,`date_add`,`user_id`) values ('$domain','5','$comment','". time() ."','$user_id')";
                        $db->query($sql);
                        $error_message = $loc['parking.php']['t09'];$error_type = 'success';
                    }else{
                        $error_message = $loc['parking.php']['t10'];$error_type = 'error';
                    }
                }elseif (preg_match("~^(?:[а-я0-9](?:[-а-я0-9]*[а-я0-9])?\.)+[а-я](?:[-а-я0-9]*[а-я0-9])?\.?(?:$|/)~Diu", $domain)){ 
                    $sql = "select * from domains where `domain` = '$domain' LIMIT 1";
                    $domains_row = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
                    if(!$domains_row){
                        $sql = "insert into domains (`domain`,`active`,`comment`,`date_add`,`user_id`) values ('$domain','5','$comment','". time() ."','$user_id')";
                        $db->query($sql);
                        $error_message = $loc['parking.php']['t09'];$error_type = 'success';
                    }else{
                        $error_message = $loc['parking.php']['t10'];$error_type = 'error';
                    }
                }else{
                    $error_message = $loc['parking.php']['t12'];$error_type = 'error';
                }
            }

            include_once './includes/errors.php';



            $sql = "select * from domains where user_id='$user_id'";
            $domains_row = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
            if($domains_row){
            ?>    
            <table class="table table-bordered mb-30">
                <tr class="">
                    <th class="text-center"><?php echo $loc['parking.php']['t02']; ?></th>
                    <th><?php echo $loc['parking.php']['t03']; ?></th>
                    <th class="text-center"><?php echo $loc['parking.php']['t04']; ?></th>    
                    <th class="text-center"></th>
                </tr>      
            <?php

            foreach($domains_row as $row){


            ?>
                <tr>
                        <td class="text-center align-middle"><?=$row['domain']; ?></td>
                        <td class="align-middle"><?=$row['comment']; ?></td>
                        <td class="text-center align-middle"><?= date("d.m.Y H:i:s",$row['date_add']); ?></td>    
                        <td class="text-center align-middle">
                            <form action="" method="post">
                                <input type="hidden" name="del" value="<?=$row['id']; ?>" >
                                <button type="submit" style="border:none;    background: none;cursor:pointer;margin-top: -2px;">
                                <img  onclick="if (!confirm('<?php echo $loc['parking.php']['t07']; ?>')) return false;" src="./templates/<?php echo $template; ?>/img/no.png" width="20px">
                                </button>
                            </form>
                        </td>
                </tr>
            <?php    
            }
            ?>
            </table> 
            <?php
            }
            ?>
                    </div> 
                </div>    
                <div class="row irow">
                    <div class="col-md-12" style="padding-left: 0px;">
                        <div class="accordion accordiontools" id="accordionExample">
                            <div class="card">
                                <div class="card-header" id="headingOne">
                                    <h5 class="mb-0">
                                        <a data-toggle="collapse" data-target="#faq1" aria-expanded="false" aria-controls="faq1" class="collapsed">Как добавить домен? <i class="fa fa-chevron-down"></i><i class="fa fa-chevron-up"></i></a>
                                    </h5>
                                </div>
                                <div id="faq1" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <p>Для прикрепления домена, вам необходимо указать в настройках DNS наш IP адрес 217.12.201.50 в А-запись<br><br>
                                        Пример:
                                        <table class="text-center table-bordered mt-15 mb-25">
                                            <thead>
                                            <tr>
                                                <th>Имя</th>
                                                <th>Тип</th>
                                                <th>Данные</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>@</td>
                                                <td>A</td>
                                                <td>217.12.201.50</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        
                                        </p>
                                        <p>Далее пропишите адрес домена в форме ниже:</p>
                                        <hr>
                                        Внимание: Обновление DNS записей может занимать около 8ми часов
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <form action="" method="post" style="width: 100%;">
                            <div class="row irow">
                                <div class="col-md-4">
                                    <div class="form-group">
                                      <label for="domain"><?php echo $loc['parking.php']['t02']; ?></label>
                                      <input type="text" class="form-control" name="domain" id="domain">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                      <label for="comment"><?php echo $loc['parking.php']['t03']; ?></label>
                                      <input type="text" class="form-control" name="comment" id="comment">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <h3 class="empty"></h3>
                                    <div class="form-group mt-15">
                                      <button type="submit" class="btn button" name="profile_rekvizit_submit"><?php echo $loc['button']['t07']; ?></button>
                                    </div>  
                                </div>     
                            </div>     
                        </form>
                    </div>
                </div>
            </div>
        </div>   
    </div>
</main>