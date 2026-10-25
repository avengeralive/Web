
<?php
include ('./templates/'.$template.'/checkform/jquery.proverka.add_news.form.php');
?>

    <script src="./templates/<?php echo $template; ?>/js/tinymce/tinymce.min.js"></script>

	<script>              
		tinymce.init({ 
			selector:'textarea',
			language: 'ru', 
			skin: 'custom',
			gecko_spellcheck: true,
			plugins: [
				'preview pagebreak textcolor advlist autolink hr lists link image charmap print preview anchor',
				'searchreplace visualblocks code fullscreen textcolor colorpicker',
				'insertdatetime media table contextmenu paste code'
			],
			toolbar: 'fontsizeselect insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | forecolor backcolor | bullist numlist outdent indent | link image | preview',
			fontsize_formats: '8px 10px 12px 14px 16px 18px 20px 22px 24px 26px 28px 30px 32px 34px 36px 38px 40px 50px 60px',
			font_formats: 'Arial=arial,helvetica,sans-serif;Courier New=courier new,courier,monospace;AkrutiKndPadmini=Akpdmi-n'
		});
                          
	</script>


	<form name="addnews_form" method="post" action="./news.php?<?php echo @$_SERVER['QUERY_STRING']?>">

            <div class="form-group">
              <label for="news_small"><?php echo $loc['news.php']['t12']; ?></label>
              <input type="text" name="news_small" class="form-control" maxlength="90" id="news_small" required placeholder="<?php echo $loc['news.php']['t12']; ?>">
            </div>
            
            <div class="form-group">
              <label for="news_full"><?php echo $loc['news.php']['t13']; ?></label>
              <textarea name="news_full" id="news_full" maxlength="900"></textarea>
            </div>
            
            <div class="row mb-50">
                <div class="col-6">
                    <div class="input-group">
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" name="image" accept="image/*" id="input">
                          <label class="custom-file-label" for="input">Загрузите изображение</label>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div id="imgNews"></div>
                    <input type="hidden" name="img_news" id="imgNewsInput" value="">
                </div>
            </div>

            
            <p>
                <b><?php echo $loc['news.php']['t19']; ?></b>
            </p>

                <div class="form-group ">
                    <label for="komu"><?php echo $loc['news.php']['t14']; ?></label>
                    <select id="komu" name="komu" class="form-control">
                    <?php
                    // Выводим только те роли, которые активны на данный момент
                    // Display only those roles that are active at the moment
                    $sql_rolespisok = "SELECT * FROM users_roles_tpl WHERE `active`='1' AND `id` IN (1,4)";		
                    $result_rolespisok = $mysqli->query($sql_rolespisok);
                    if (mysqli_num_rows($result_rolespisok)>0) 
                            {
                            while($res_rolespisok=mysqli_fetch_array($result_rolespisok)) 
                                    {
                                    $role_tip=htmlentities($res_rolespisok['tip']);
                                    $role_title=htmlentities($res_rolespisok['title']);
                                    ?>
                                    <option value="<?php echo $role_tip; ?>" <?php if ($role_tip==$user_tip) {echo 'selected="selected"';} ?>><?php echo $role_title; ?></option>
                                    <?php
                                    }
                            }
                    ?>
                    </select>
                </div>
                <div class="form-group ">
                    <label for="public_news"><?php echo $loc['news.php']['t15']; ?></label>
                    <select id="public_news" name="public_news" class="form-control" >
                            <option value="0" selected="selected"><?php echo $loc['news.php']['t16']; ?></option>
                            <option value="1" ><?php echo $loc['news.php']['t17']; ?></option>
                    </select>
                </div>

            
            <div class="form-group">
                <label for="offer">Новость для определенного оффера:</label>
                <select name="offer" id="offer" class="form-control">
                    <option value="0">Все</option>
                <?php
                $list = array();
                $db = DB::getInstance();                                        
                $sql = "select id,name from offers";
                $stmt = $db->prepare($sql);
                $stmt->execute();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
                }

                ?>
                </select>  
            </div>
            
            <div class="form-group">
                <input type="hidden" name="addnews" value="ok">
                <input type="submit" name="submit" value="<?php echo $loc['button']['t01']; ?>" class="btn button">
            </div>

	</form>
        
        <script>

            $(document).on('change', '.custom-file-input', function () {
                    files = this.files;
                    var then = $(this);
                    var data = new FormData();
                     $.each( files, function( key, value ){
                         data.append( key, value );
                     });
                     $.ajax({
                        url: './post/newsEdit.php',
                        type: 'POST',
                        data: data,
                        cache: false,
                        dataType: 'json',
                        processData: false, // Не обрабатываем файлы (Don't process the files)
                        contentType: false, // Так jQuery скажет серверу что это строковой запрос
                        success: function( respond, textStatus, jqXHR ){
                            $('#imgNews').html('<img src="./tmp/news/'+respond.img+'" class="img-fluid">');
                            $('#imgNewsInput').val(respond.img);
                        }

                    });
            });

        </script>