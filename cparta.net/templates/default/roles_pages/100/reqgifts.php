<?php 
    if(isset($_POST['send'])){
        $user = User::getById($user_id);
        if($user->tip != 70) {
            exit;
        }
        $post = new Request($_POST);
        $gift = Store_Request::getById($post->send);
        $gift->update([
            'status' => 1
        ]);
        header('Location: ./reqgifts.php?xtext=1');
    }


    if(isset($_POST['del'])){
        $user = User::getById($user_id);
        if($user->tip != 70) {
            exit;
        }
        $post = new Request($_POST);
        $gift = Store_Request::getById($post->del);    
        $store = Store::getById($gift->id);
        $u = User::getById($gift->user_id);
        
        $new_coins = $u->coins + $store->price;
        $new_count = $store->count + 1;
        $u->update([
            'coins' => $new_coins,
        ]);

        $store->update([
            'count' => $new_count,
            'status' => 1
        ]);

        $gift->update([
            'status' => 2
        ]);
        header('Location: ./reqgifts.php?xtext=1');
    }
    
    if (isset($_GET['xtext']) && $_GET['xtext']=='1') {$error_message = 'Сохранено!';$error_type = 'success';} 
    if (isset($_GET['xtext']) && $_GET['xtext']=='2') {$error_message = 'Ошибка!';$error_type = 'error';} 

    $req_gift_count = Store_Request::getCount();
    
    
?>

<div class="row main mt-50 mb-50">

    <div class="col-12">
        
        <nav class="nav nav-pills flex-column flex-sm-row">
           <a class="flex-sm-fill text-sm-center nav-link" href="./store.php">Список призов</a>
           <a class="flex-sm-fill text-sm-center nav-link active" href="./reqgifts.php">Заказы призов <?php if($req_gift_count > 0) { ?>&nbsp;&nbsp;&nbsp; <span class="badge badge-pill badge-danger"><?=$req_gift_count; ?></span><?php } ?></a>
       </nav>
        
        <div class="tab-content mt-30" id="nav-tabContent">
            
            <div class="tab-pane show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">

                <table class="table text-center">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Юзер ID</th>
                        <th scope="col">E-mail</th>
                        <th scope="col">Telega/Skype</th>
                        <th scope="col">Телефон</th>
                        <th scope="col">Приз</th>
                        <th scope="col">Стоимость</th>
                        <th scope="col">Статус</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                      </tr>
                    </thead>
                    <tbody>          
<?php
        $gifts = Store_Request::getAll('status asc');
        foreach ($gifts as $gift) {
            $u = User::getById($gift->user_id);
            if($gift->status == 1){
                $status = '<span class="text-success text-bold">Отправлен</span>';
            }elseif($gift->status == 2){
                $status = '<span class="text-bold">Отменен</span>';
            }else{
                $status = '<span class="text-warning text-bold">Ожидает</span>';
            }
            $g = Store::getById($gift->id);
            $contact = $u->telegram_login == '' ? $u->telegram_login : $u->skype;

?>
                    <tr>
                        <td width="30px" class="align-middle"><?=$gift->id; ?></td>
                        <td class="align-middle"><?=$u->id; ?></td>
                        <td class="align-middle"><?=$u->email; ?></td>
                        <td class="align-middle"><?=$contact; ?></td>
                        <td class="align-middle"><?=$u->phone; ?></td>
                        <td class="align-middle"><?=$g->name; ?></td>
                        <td class="align-middle"><?=$g->price; ?></td>
                        <td class="align-middle"><?=$status; ?></td>
                          
                        <td width="75px" class="align-middle">
                            <?php
                            if($gift->status == 0){
                            ?>
                            <form action="" method="post"> 
                                <input type="hidden" name="send" value="<?=$gift->id; ?>">
                                <button class="btn button " type="submit">Отправлен</button>
                            </form> 
                            <?php 
                            }
                            ?>
                        </td>
                        <td width="75px" class="align-middle">
                            <?php
                            if($gift->status == 0){
                            ?>
                            <form action="" method="post"> 
                                <input type="hidden" name="del" value="<?=$gift->id; ?>">
                                <button class="btn button btn-danger" type="submit">Отказать</button>
                            </form> 
                            <?php 
                            }
                            ?>
                        </td>
                    </tr>
                    
<?php            
            }
?>                    
                    
                    </tbody>
                </table>
        
                
                
                
            </div>

        </div>
        
    </div>
    
</div>