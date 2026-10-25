<?php
    $r_set = Roulette_Settings::getById(1);
    
    if(isset($_POST['keysforlead'])){
        $post = new Request($_POST);
        $keysforlead = $post->keysforlead;
        
        $name1 = $post->name1;
        $chance1 = $post->chance1;
        
        $name2 = $post->name2;
        $chance2 = $post->chance2;
        
        $name3 = $post->name3;
        $chance3 = $post->chance3;
        
        $name4 = $post->name4;
        $chance4 = $post->chance4;
        
        $name5 = $post->name5;
        $chance5 = $post->chance5;
        
        $name6 = $post->name6;
        $chance6 = $post->chance6;
        
        $r_set->update([
            'keysforlead' => $keysforlead,
            'priz_1_name' => $name1,
            'priz_1_chance' => $chance1,
            'priz_2_name' => $name2,
            'priz_2_chance' => $chance2,
            'priz_3_name' => $name3,
            'priz_3_chance' => $chance3,
            'priz_4_name' => $name4,
            'priz_4_chance' => $chance4,
            'priz_5_name' => $name5,
            'priz_5_chance' => $chance5,
            'priz_6_name' => $name6,
            'priz_6_chance' => $chance6,
        ]);
        
        $r_set = Roulette_Settings::getById(1);
    } 
    
?>
<div class="row main mt-50 mb-50">

    <div class="col-12 mb-10 text-center"><p class="pageTitle mb-25">ЛИД-РУЛЕТКА</p></div>
    
    <div class="col-12">
        
        <form name="profile_changepassword_form" class="" method="post">
            <div class="row mb-30">
                <div class="col-4 mb-30">
                    <div class="row">
                        <div class="col-12 mb-30">
                            <div class="card">
                                <div class="card-body">
                                    <p class="postTitle mb-20">Настройки:</p>
                                    <div class="form-group mb-30">
                                      <label for="keysforlead">Лидов за 1 ключ:</label>
                                      <input type="text" class="form-control" name="keysforlead" id="keysforlead" value="<?php echo $r_set->keysforlead; ?>">
                                    </div>
                                    <p class="postTitle mb-20">
                                        Спрайт с призами:
                                    </p>

                                    <div class="input-group">
                                        <div class="custom-file">
                                          <input type="file" class="custom-file-input" name="sprite" accept="image/*" id="sprite">
                                          <label class="custom-file-label" for="sprite">Загрузите изображение</label>
                                        </div>
                                    </div>

                                    <div class="form-group text-center mt-30">
                                        <img src="./templates/<?php echo $template; ?>/img/roulette/<?php echo $r_set->sprite; ?>" id="sprite_img" width="85px">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
                <div class="col-8 mb-30">
                    <div class="row">
                        <div class="col-4 mb-30">
                            <div class="card">
                                <div class="card-body">
                                    <p class="postTitle mb-20">Приз 1:</p>
                                    <div class="form-group">
                                      <label for="name1">Название:</label>
                                      <input type="text" class="form-control" name="name1" id="name1" value="<?php echo $r_set->priz_1_name; ?>">
                                    </div>
                                    <div class="form-group">
                                      <label for="chance1">Шанс выпадения:</label>
                                      <input type="text" class="form-control" name="chance1" id="chance1" value="<?php echo $r_set->priz_1_chance; ?>">
                                    </div>

                                    <div class="input-group mt-30">
                                        <div class="custom-file">
                                          <input type="file" class="custom-file-input" name="priz_1" accept="image/*" id="priz_1_img">
                                          <label class="custom-file-label" for="priz_1_img">Загрузите изображение</label>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group text-center mt-30">
                                        <img src="./templates/<?php echo $template; ?>/img/roulette/<?php echo $r_set->priz_1_img; ?>" id="priz_1" width="60px">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-4 mb-30">
                            <div class="card">
                                <div class="card-body">
                                    <p class="postTitle mb-20">Приз 2:</p>
                                    <div class="form-group">
                                      <label for="name2">Название:</label>
                                      <input type="text" class="form-control" name="name2" id="name2" value="<?php echo $r_set->priz_2_name; ?>">
                                    </div>
                                    <div class="form-group">
                                      <label for="chance2">Шанс выпадения:</label>
                                      <input type="text" class="form-control" name="chance2" id="chance2" value="<?php echo $r_set->priz_2_chance; ?>">
                                    </div>

                                    <div class="input-group mt-30">
                                        <div class="custom-file">
                                          <input type="file" class="custom-file-input" name="priz_2" accept="image/*" id="priz_2_img">
                                          <label class="custom-file-label" for="priz_2_img">Загрузите изображение</label>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group text-center mt-30">
                                        <img src="./templates/<?php echo $template; ?>/img/roulette/<?php echo $r_set->priz_2_img; ?>" id="priz_2" width="60px">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-4 mb-30">
                            <div class="card">
                                <div class="card-body">
                                    <p class="postTitle mb-20">Приз 3:</p>
                                    <div class="form-group">
                                      <label for="name3">Название:</label>
                                      <input type="text" class="form-control" name="name3" id="name3" value="<?php echo $r_set->priz_3_name; ?>">
                                    </div>
                                    <div class="form-group">
                                      <label for="chance3">Шанс выпадения:</label>
                                      <input type="text" class="form-control" name="chance3" id="chance3" value="<?php echo $r_set->priz_3_chance; ?>">
                                    </div>

                                    <div class="input-group mt-30">
                                        <div class="custom-file">
                                          <input type="file" class="custom-file-input" name="priz_3" accept="image/*" id="priz_3_img">
                                          <label class="custom-file-label" for="priz_3_img">Загрузите изображение</label>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group text-center mt-30">
                                        <img src="./templates/<?php echo $template; ?>/img/roulette/<?php echo $r_set->priz_3_img; ?>" id="priz_3" width="60px">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-4 mb-30">
                            <div class="card">
                                <div class="card-body">
                                    <p class="postTitle mb-20">Приз 4:</p>
                                    <div class="form-group">
                                      <label for="name4">Название:</label>
                                      <input type="text" class="form-control" name="name4" id="name4" value="<?php echo $r_set->priz_4_name; ?>">
                                    </div>
                                    <div class="form-group">
                                      <label for="chance4">Шанс выпадения:</label>
                                      <input type="text" class="form-control" name="chance4" id="chance4" value="<?php echo $r_set->priz_4_chance; ?>">
                                    </div>

                                    <div class="input-group mt-30">
                                        <div class="custom-file">
                                          <input type="file" class="custom-file-input" name="priz_4" accept="image/*" id="priz_4_img">
                                          <label class="custom-file-label" for="priz_4_img">Загрузите изображение</label>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group text-center mt-30">
                                        <img src="./templates/<?php echo $template; ?>/img/roulette/<?php echo $r_set->priz_4_img; ?>" id="priz_4" width="60px">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-4 mb-30">
                            <div class="card">
                                <div class="card-body">
                                    <p class="postTitle mb-20">Приз 5:</p>
                                    <div class="form-group">
                                      <label for="name5">Название:</label>
                                      <input type="text" class="form-control" name="name5" id="name5" value="<?php echo $r_set->priz_5_name; ?>">
                                    </div>
                                    <div class="form-group">
                                      <label for="chance5">Шанс выпадения:</label>
                                      <input type="text" class="form-control" name="chance5" id="chance5" value="<?php echo $r_set->priz_5_chance; ?>">
                                    </div>

                                    <div class="input-group mt-30">
                                        <div class="custom-file">
                                          <input type="file" class="custom-file-input" name="priz_5" accept="image/*" id="priz_5_img">
                                          <label class="custom-file-label" for="priz_5_img">Загрузите изображение</label>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group text-center mt-30">
                                        <img src="./templates/<?php echo $template; ?>/img/roulette/<?php echo $r_set->priz_5_img; ?>" id="priz_5" width="60px">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-4 mb-30">
                            <div class="card">
                                <div class="card-body">
                                    <p class="postTitle mb-20">Приз 6:</p>
                                    <div class="form-group">
                                      <label for="name6">Название:</label>
                                      <input type="text" class="form-control" name="name6" id="name6" value="<?php echo $r_set->priz_6_name; ?>">
                                    </div>
                                    <div class="form-group">
                                      <label for="chance6">Шанс выпадения:</label>
                                      <input type="text" class="form-control" name="chance6" id="chance6" value="<?php echo $r_set->priz_6_chance; ?>">
                                    </div>

                                    <div class="input-group mt-30">
                                        <div class="custom-file">
                                          <input type="file" class="custom-file-input" name="priz_6" accept="image/*" id="priz_6_img">
                                          <label class="custom-file-label" for="priz_6_img">Загрузите изображение</label>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group text-center mt-30">
                                        <img src="./templates/<?php echo $template; ?>/img/roulette/<?php echo $r_set->priz_6_img; ?>" id="priz_6" width="60px">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>    
                </div> 
                <div class="col-12 mb-30 mt-30">
                        <div class="form-group text-center">
                          <button type="submit" class="btn button" name="profile_rekvizit_submit">Сохранить</button>
                        </div>
                </div>
        </form>
        </div>
</div>
</div>
                        <script>

                            $(document).on('change', '.custom-file-input', function () {
                                    files = this.files;
                                    var type = $(this).attr('id');
                                    var data = new FormData();
                                    var then = $(this);
                                     $.each( files, function( key, value ){
                                         data.append( key, value );
                                     });

                                     // Отправляем запрос

                                     $.ajax({
                                        url: './post/roulette_set.php?t='+type,
                                        type: 'POST',
                                        data: data,
                                        cache: false,
                                        dataType: 'json',
                                        processData: false, // Не обрабатываем файлы (Don't process the files)
                                        contentType: false, // Так jQuery скажет серверу что это строковой запрос
                                        success: function( respond, textStatus, jqXHR ){
                                            $('#' + respond.then).attr('src', respond.img);
                                        }
                                    
                                    });
                            });

                        </script>