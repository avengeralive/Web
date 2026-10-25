<main>
    <div class="row grow">
        <div class="col-md-7">
            <h1>Инструменты</h1>
        </div>
        <?php include './templates/' . $template . '/roles_pages/' . $user_tip . '/menu_top.php'; ?>
    </div>

    <div class="row grow">
        
        <div class="col-md-12 mb30">
                <a class="btn-link snd" style="padding-right: 15px;" href="./parking.php">Парковка доменов</a>
                <!--<a class="btn-link snd" style="padding-right: 15px;" href="./buydomain.php">Покупка домена</a>-->
                <a class="btn-link active" style="padding-right: 15px;" href="./postback.php">Глобальный постбек</a>
        </div>

        <div class="col-md-6 mb30">

            <form action="" method="post" class="mt-50 postbackform" name="profile_changepassword_form">
        
        <div class="row">
            <div class="col-12 mb-30">
                <div class="card">
                    <div class="card-body">
                        <p class="postTitle mb30"><?php echo $loc['postback.php']['t15']; ?></p>
                        <div class="form-group">
                            <label class="checkbox_container" for="postback_add">
                                <input <?php if(isset($postback_row->send_add) && $postback_row->send_add == 1){echo 'checked';} ?> type="checkbox" name="postback_add" class="custom-control-input" id="postback_add">
                                <span class="checkmark"></span>
                                <span class="label_text"><?php echo $loc['streams.php']['t24']; ?></span>
                            </label>
                        </div>
                        <div class="form-group">
                            <label class="checkbox_container" for="postback_success">
                                <input <?php if(isset($postback_row->send_approve) && $postback_row->send_approve == 1){echo 'checked';} ?> type="checkbox" name="postback_success" class="custom-control-input" id="postback_success">
                                <span class="checkmark"></span>
                                <span class="label_text"><?php echo $loc['streams.php']['t25']; ?></span>
                            </label>
                        </div>
                        <div class="form-group">
                            <label class="checkbox_container" for="postback_cancel">
                                <input <?php if(isset($postback_row->send_cancel) && $postback_row->send_cancel == 1){echo 'checked';} ?> type="checkbox" name="postback_cancel" class="custom-control-input" id="postback_cancel">
                                <span class="checkmark"></span>
                                <span class="label_text"><?php echo $loc['streams.php']['t26']; ?></span>
                            </label>
                        </div>
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="type">Метод:</label>
                                <select name="type" class="form-control" id="type">
                                    <option value="1" <?php if(isset($postback_row->type_send) && $postback_row->type_send == 1){echo 'selected';} ?>>GET</option>
                                    <option value="2" <?php if(isset($postback_row->type_send) && $postback_row->type_send == 2){echo 'selected';} ?>>POST</option>
                                </select>
                            </div>
                            <div class="form-group col-12">
                                <label for="postback_url">URL:</label>
                                <input type="text" class="form-control" name="postback_url" id="postback_url" value="<?php if(isset($postback_row->url)){ echo $postback_row->url;} ?>">
                            </div>
                        </div>

                            <div class="form-group">
                              <button type="submit" class="btn button" name="profile_changepassword_submit">Сохранить</button>
                            </div>
                    </div>
                </div>
            </div>
        </div> 
    </form>

        </div>
        <div class="col-md-6 mb30">
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane show active" role="tabpanel" aria-labelledby="nav-home-tab">

<?php

if(isset($_POST['postback_url'])){
    $post = new Request($_POST);
    $postback = Postback::getByUserId($user_id);
    if ($postback && $postback->user_id == $user_id) {
        $up = [
            'send_add' => isset($post->postback_add) ? 1 : 0,
            'send_approve' => isset($post->postback_success) ? 1 : 0,
            'send_cancel' => isset($post->postback_cancel) ? 1 : 0,
            'url' => $post->postback_url,
            'type_send' => $post->type,
            'type' => 1
        ];
        $postback->update($up);
    }else{
        $create = new Postback();
        $create->user_id=$user_id;
        $create->send_add=isset($post->postback_add) ? 1 : 0;
        $create->send_approve=isset($post->postback_success) ? 1 : 0;
        $create->send_cancel=isset($post->postback_cancel) ? 1 : 0;
        $create->url=$post->postback_url;
        $create->type_send=$post->type;
        $create->type=1;
        $create->create(); 
    }    
}
$db = DB::getInstance();
$sql = "select * from postback where user_id='$user_id' LIMIT 1";
$postback_row = $db->query($sql)->fetchObject();
?>    
    
                    <div class="accordion accordiontools accordioninfo mt-50" id="accordionExample">
                        <div class="card">
                            <div class="card-header p0" style="padding-top: 0px;" id="headingOne">
                              <h5 class="mb-0">
                                <a class="btn-link collapsed" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                  <?php echo $loc['postback.php']['t02']; ?> <i class="fa fa-chevron-down"></i><i class="fa fa-chevron-up"></i>
                                </a>
                              </h5>
                            </div>
                            <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                                <div class="card-body">
                                    PostBack запрос будет отправлен на указанный адрес методом POST или GET.<br/>
                                    Для передачи параметров в запрос, Вы можете использовать макросы указанные ниже.
                                    <br/><br/>
                                    <b><?php echo $loc['postback.php']['t05']; ?></b>
                                    <br/>
                                    http://example.com/mystat.php?myprofit={profit}&subid={subid1}
                                    <br/>
                                    <?php echo $loc['postback.php']['t06']; ?>
                                    <br/><br/><b><?php echo $loc['postback.php']['t07']; ?>:</b><br/><br/>
                                    <table class="stats_table" style="width:100%;margin:10px auto;">
                                        <tr>
                                            <td><b>{id}</b></td>
                                            <td>ID лида</td>
                                        </tr>
                                        <tr>
                                            <td><b>{status}</b></td>
                                            <td><?php echo $loc['postback.php']['t08']; ?></td>
                                        </tr>
                                        <tr>
                                            <td><b>{stream_id}</b></td>
                                            <td><?php echo $loc['postback.php']['t09']; ?></td>
                                        </tr>
                                        <tr>
                                            <td><b>{lead_time}</b></td>
                                            <td><?php echo $loc['postback.php']['t10']; ?></td>
                                        </tr>
                                        <tr>
                                            <td><b>{ip}</b></td>
                                            <td><?php echo $loc['postback.php']['t11']; ?></td>
                                        </tr>											
                                        <tr>
                                            <td><b>{profit}</b></td>
                                            <td><?php echo $loc['postback.php']['t12']; ?></td>
                                        </tr>	
                                        <tr>
                                            <td><b>{offer_id}</b></td>
                                            <td><?php echo $loc['postback.php']['t13']; ?></td>
                                        </tr>	
                                        <tr>
                                            <td><b>{offer_name}</b></td>
                                            <td><?php echo $loc['postback.php']['t14']; ?></td>
                                        </tr>									
                                        <tr>
                                            <td><b>{subid1}</b></td>
                                            <td>SUB ID 1</td>
                                        </tr>
                                        <tr>
                                            <td><b>{subid2}</b></td>
                                            <td>SUB ID 2</td>
                                        </tr>
                                        <tr>
                                            <td><b>{subid3}</b></td>
                                            <td>SUB ID 3</td>
                                        </tr>
                                        <tr>
                                            <td><b>{subid4}</b></td>
                                            <td>SUB ID 4</td>
                                        </tr>
                                        <tr>
                                            <td><b>{subid5}</b></td>
                                            <td>SUB ID 5</td>
                                        </tr>  
                                        <tr>
                                            <td><b>{1v1}</b></td>
                                            <td>1v1 order_id</td>
                                        </tr> 										
                                    </table>	
                                </div>
                            </div>
                        </div>
                    </div>     
                </div>
            </div>
        </div>  
    </div>
</main>