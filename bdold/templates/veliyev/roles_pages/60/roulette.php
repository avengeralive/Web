<?php
    $r_set = Roulette_Settings::getById(1);
?>
<div class="row main mt-50 mb-50">

    <div class="col-12 mb-10 text-center"><p class="pageTitle mb-25">ЛИД-РУЛЕТКА</p></div>
    
    <div class="col-12">
        
        <form name="profile_changepassword_form" class="" method="post">
            <div class="row mb-30">

                <div class="col-4 mb-30">
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
                            
                            <div class="form-group text-center">
                                <img src="./templates/<?php echo $template; ?>/img/roulette/<?php echo $r_set->sprite; ?>" id="sprite_img" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>

                <script>
                    
                    $(document).on('change', '.', function () {
                        var code = $('#sms-check').val();
                        $.ajax({
                            url: './post/verifysms.php',
                            type: 'POST',
                            data: 'code=' + code + '&mode=2',
                            success: function (response) {
                                data = jQuery.parseJSON(response);
                                status = data.status;
                                if(status == 'error'){
                                    new Noty({
                                      text: data.message,
                                      type: 'error',
                                      theme: 'nest',
                                      timeout: 3000,
                                      closeWith: ['click', 'button'],
                                      layout: 'topRight'
                                    }).show();
                                }else{
                                    window.location = './profile.php?verifysms';
                                }
                            }
                        });
                    })
                    
                </script>
                
            </div>
                
            <div class="row">    

                <div class="col-4 mb-30">
                    <div class="card">
                        <div class="card-body">
                            <p class="postTitle mb-20">Приз 1:</p>
                            <div class="form-group">
                              <label for="keysforlead">Лидов за 1 ключ:</label>
                              <input type="text" class="form-control" name="keysforlead" id="keysforlead" value="<?php echo $r_set->keysforlead; ?>">
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-4 mb-30">
                    <div class="card">
                        <div class="card-body">
                            <p class="postTitle mb-20">Приз 2:</p>
                            <div class="form-group">
                              <label for="keysforlead">Лидов за 1 ключ:</label>
                              <input type="text" class="form-control" name="keysforlead" id="keysforlead" value="<?php echo $r_set->keysforlead; ?>">
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-4 mb-30">
                    <div class="card">
                        <div class="card-body">
                            <p class="postTitle mb-20">Приз 3:</p>
                            <div class="form-group">
                              <label for="keysforlead">Лидов за 1 ключ:</label>
                              <input type="text" class="form-control" name="keysforlead" id="keysforlead" value="<?php echo $r_set->keysforlead; ?>">
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-4 mb-30">
                    <div class="card">
                        <div class="card-body">
                            <p class="postTitle mb-20">Приз 4:</p>
                            <div class="form-group">
                              <label for="keysforlead">Лидов за 1 ключ:</label>
                              <input type="text" class="form-control" name="keysforlead" id="keysforlead" value="<?php echo $r_set->keysforlead; ?>">
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-4 mb-30">
                    <div class="card">
                        <div class="card-body">
                            <p class="postTitle mb-20">Приз 5:</p>
                            <div class="form-group">
                              <label for="keysforlead">Лидов за 1 ключ:</label>
                              <input type="text" class="form-control" name="keysforlead" id="keysforlead" value="<?php echo $r_set->keysforlead; ?>">
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-4 mb-30">
                    <div class="card">
                        <div class="card-body">
                            <p class="postTitle mb-20">Приз 6:</p>
                            <div class="form-group">
                              <label for="keysforlead">Лидов за 1 ключ:</label>
                              <input type="text" class="form-control" name="keysforlead" id="keysforlead" value="<?php echo $r_set->keysforlead; ?>">
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-12 mb-30 mt-30">
                        <div class="form-group text-center">
                          <button type="submit" class="btn button" name="profile_rekvizit_submit">Сохранить</button>
                        </div>
                </div>
                
            </div>    
        </form>
    </div>
</div>

