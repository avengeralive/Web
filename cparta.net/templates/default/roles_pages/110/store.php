<?php 
    if (isset($_GET['xtext']) && $_GET['xtext']=='1') {$error_message = 'Сохранено!';$error_type = 'success';} 
    if (isset($_GET['xtext']) && $_GET['xtext']=='2') {$error_message = 'Ошибка!';$error_type = 'error';} 

    $req_gift_count = Store_Request::getCount();
?>

<div class="row main mt-50 mb-50">

    <div class="col-12">
        
        <nav class="nav nav-pills flex-column flex-sm-row">
           <a class="flex-sm-fill text-sm-center nav-link active" href="./store.php">Список призов</a>
           <a class="flex-sm-fill text-sm-center nav-link" href="./reqgifts.php">Заказы призов <?php if($req_gift_count > 0) { ?>&nbsp;&nbsp;&nbsp; <span class="badge badge-pill badge-danger"><?=$req_gift_count; ?></span><?php } ?></a>
       </nav>
        
        <div class="tab-content mt-30" id="nav-tabContent">
            
            <div class="tab-pane show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">

                <table class="table text-center">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Название</th>
                        <th scope="col">Изображение</th>
                        <th scope="col">Цена</th>
                        <th scope="col">Кол-во</th>
                        <th scope="col">Статус</th>
                        <th scope="col"></th>
                      </tr>
                    </thead>
                    <tbody>          
<?php
        $Store = Store::getAll();
        foreach ($Store as $gift) {
            /*
            if($gift->status == 0){
                $status = '<span class="text-danger">Выкл</span>';
                $btn = '<i class="fa fa-play"  title="Включить" style="color:green"></i>';
            }else{
                $status = '<span class="text-success">Вкл</span>';
                $btn = '<i class="fa fa-stop"  title="Выключить" style="color:#fb5858"></i>';
            }
             * 
             */
?>
                    <form action="" method="post">    
                    <input type="hidden" name="gift_id" value="<?=$gift->id; ?>">  
                      <tr>
                        <td width="30px" class="align-middle"><?=$gift->id; ?></td>
                        <td class="align-middle"><input style="width: 90%" type="text" name="name" value="<?=$gift->name; ?>"></td>
                        <td width="75px" class="align-middle">
                        <div class="gift-input">
                          <input type="hidden" name="gift_img" class="gift_img" value="<?=$gift->image; ?>">  
                          <input type="file" class="custom-file-input giftImg" accept="image/*">
                          <img width="50px" src="./templates/<?= $template; ?>/img/store/<?=$gift->image; ?>">
                        </div>
                        </td>
                        <td width="100px" class="align-middle"><input class="text-center" style="width: 100%" type="text" name="price" value="<?=$gift->price; ?>"></td>
                        <td width="100px" class="align-middle"><input class="text-center" style="width: 100%" type="text" name="count" value="<?=$gift->count; ?>"></td>
                        <td width="100px" class="align-middle">
                            <select name="status">
                                <option <?php if($gift->status == 0){echo 'selected';} ?> value="0">Выкл</option>
                                <option <?php if($gift->status == 1){echo 'selected';} ?> value="1">Вкл</option>
                            </select>
                        
                        </td>
                        <td width="75px" class="align-middle">
                            <button style="border: none;background: none;cursor: pointer;" type="submit"><i style="color:#686868"  title="Сохранить" class="fa fa-save"></i></button>
                         </form> 
                        &nbsp;&nbsp; <a href="#" class="delGift" data-id="<?=$gift->id; ?>"><i style="color:#686868"  title="Удалить" class="fa fa-trash"></i></a>
                        </td>
                      </tr>
                    
<?php            
            }
?>
                    <tr>
                        <td colspan="7">
                            <button class="btn button" data-toggle="modal" data-target="#gift-add-form" type="button">Добавить</button>
                        </td>
                    </tr>
                    
                    
                    
                    </tbody>
                </table>
        
                
                
                
            </div>

        </div>
        
    </div>
    
</div>
<script type="text/javascript">
    $(document).ready(function(){

        $(".changeStatus").on("click",function(){
            var gift = $(this).attr('data-id');
            var $this = $(this);
            $.ajax({
                url: './post/store.php',
                type: 'POST',
                data: 'gift=' + gift + '&mode=1',
                success: function (response) {
                    data = jQuery.parseJSON(response);
                    new Noty({
                      text: data.message,
                      type: 'info',
                      theme: 'nest',
                      timeout: 3000,
                      closeWith: ['click', 'button'],
                      layout: 'topRight'
                    }).show();
                    
                    $this.html(data.button);
                }
            });
        });
        
        $(".gift-input img").on("click",function(){
            $(this).prev('.giftImg').trigger('click');
        });
        
        $(".delGift").on("click",function(){
            var giftid = $(this).attr('data-id');
            var $this = $(this);
            $.ajax({
                url: './post/store.php',
                type: 'POST',
                data: 'delgift=' + giftid,
                success: function () {
                    window.location = './store.php?xtext=1';
                }
            });
        });
        
        $('.giftImg').on('change', function() {
            var files  = $(this).prop("files");
            var data = new FormData();
            var img = $(this).next('img');
            var img_input = $(this).prev('.gift_img');
             $.each( files, function( key, value ){
                 data.append( key, value );
             });

             // Отправляем запрос

             $.ajax({
                url: './post/store.php',
                type: 'POST',
                data: data,
                cache: false,
                dataType: 'json',
                processData: false, // Не обрабатываем файлы (Don't process the files)
                contentType: false, // Так jQuery скажет серверу что это строковой запрос
                success: function( respond, textStatus, jqXHR ){
                    img.attr('src', respond.img);
                    img_input.val(respond.img_val);
                }

            });
        });
        
    });
</script>

<!-- Modal -->
<div class="modal fade" id="gift-add-form" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title">Добавить приз</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        
        <form action="" enctype="multipart/form-data" method="post" style="margin: 20px auto;">
            <input type="hidden" name="addgift" value="1">  
            <div class="modal-body">
                
                <div class="form-group">
                    <div class="custom-file">
                      <input type="file" name="image" class="custom-file-input" id="customFile">
                      <label class="custom-file-label" for="customFile">Выбрать картинку</label>
                    </div>
                </div>
                
                <div class="form-group mt-30">
                  <label for="Input-name">Название</label>
                  <input type="text" class="form-control" id="Input-name" name="name"  placeholder="Название">
                </div>
                
                <div class="form-group">
                  <label for="Input-price">Цена в коинах</label>
                  <input type="text" class="form-control" id="Input-price" name="price"  placeholder="Цена в коинах">
                </div>
                
                <div class="form-group">
                  <label for="Input-count">Количество</label>
                  <input type="text" class="form-control" id="Input-count" name="count"  placeholder="Количество">
                </div>
                


            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Добавить</button>
            </div>
        </form>
        
    </div>
  </div>
</div>
