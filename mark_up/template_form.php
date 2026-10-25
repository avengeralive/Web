<div class="wrapper-overlay" style="display:none;"></div>
<div class="modal old-form" style="display:none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
        <div class="form-email-us" style="display:none;">
            <h3>Вы можете оставить онлайн - заявку, <br>и мы вам обязательно ответим!</h3>
            <div class="form-block">
                <div id="callForm" class="contactForm">
                    <input type="hidden" name="ymparam" value="default">
                    <div class="form-block-item">
                        <input type="text" name="name" class="form-control" required placeholder="Ваше имя..">
                    </div>
                    <div class="form-block-item">
                        <input type="text" name="phone" class="form-control" required placeholder="Ваш телефон..">
                    </div>
                    <div class="form-block-item">
                        <input type="text" name="email" class="form-control" required placeholder="Ваш email..">
                    </div>
                    <div class="form-block-item">
                        <textarea required placeholder="Сообщение.." name="message" class="form-control"></textarea>
                    </div>
                    <div class="text-center">
                        <div class="upload-file">
                            <span class="upload-file-txt"><i class="icon icon-upload"></i> Добавить файл</span>
                            <input type="file" name="upload_file" class="upload_file" fileSize="25000000">

                        </div>
                        <div class="remove-container"></div>
                    </div>
                    <div class="text-center btn-submit-block">
                        <span class="btn btn-yellow callFormSubmit contactFormSubmit">отправить</span>
                    </div>
                </div>
            </div>
            <p class="text-center">
                <a href="#" class="close-link"><i class="icon icon-close-grey"></i> Закрыть</a>
            </p>

        </div>
        <div class="form-call-us" style="display:none;">
            <i class="icon icon-phone-large"></i>
                <h3>Оставьте свой номер телефона, <br>
        и мы вам обязательно перезвоним!</h3>
                <div class="form-block">
                    <div id="emailForm" class="contactForm">
                        <input type="hidden" name="ymparam" value="default">
                        <input type="hidden" name="type" value="1">
                        <div class="form-block-item">
                            <input type="text" name="name" class="form-control" required placeholder="Ваше имя..">
                        </div>
                        <div class="form-block-item">
                            <input type="text" name="phone" class="form-control" placeholder="Ваш телефон.." required>
                        </div>
                        <div class="form-block-item">
                            <input type="text" name="email" class="form-control" placeholder="Ваш email.." required>
                        </div>
                        <div class="text-center btn-submit-block">
                            <span class="btn btn-yellow emailFormSubmit contactFormSubmit">отправить</span>
                        </div>
                    </div>
                </div>
                <p class="text-center">
                    <a href="#" class="close-link"><i class="icon icon-close-grey"></i> Закрыть</a>
                </p>
        </div>
        <div class="form-success" style="display:none;">
                <h3>Спасибо! <br> Мы свяжемся с Вами в ближайшее время.</h3>

        </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        jQuery.validator.addMethod("fileSize", function (val, element, param) {

            if(element.files.length == 0) return true;
            var size = element.files[0].size;

            if (size > parseInt(param))
            {
                return false;
            } else {
                return true;
            }

        }, "Файл дожен быть меньше чем 25МБ");

        $('#callForm').validate({
           /* submitHandler: function(form) {
                $(form).submit();
            }*/
        });

        $('#emailForm').validate({
        });

        $('.upload-file').find('[name=upload_file]').change(function(){
            var me = $(this);
            var el = document.createElement('a');
            var el2 = document.createElement('div');
            $('.remove-container').html('');

            $(el).html('Удалить');
            $(el2).html(me.val());


            $(el).click(function(){

                $('.remove-container').html('');
                me.val('');
                console.log('asd');
            });

            $('.remove-container').append(el2).append(el);

        });

       $('.callFormSubmit').click(function(){
           $('#callForm').submit();
           return false;
       });

        $('.emailFormSubmit').click(function(){
            $('#emailForm').submit();
            return false;
        });


	
	console.log('test');
        <? 	
	if(array_key_exists('mailsuccess', $_REQUEST) && $_REQUEST['mailsuccess'] == 1) { 
	?>		
            $('.form-success').show();
            $('.modal').show();
            $('.wrapper-overlay').show();
            setTimeout(function(){
                $('.form-success').fadeOut(1000);
                $('.modal').fadeOut(1000);
                $('.wrapper-overlay').fadeOut(1000);
            }, 1500)
        <?}?>
    });


</script>