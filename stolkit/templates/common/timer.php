<div class="es13_bg">
         <div class="es13_bg__text">
            ЗАКАЖИТЕ ИЗДЕЛИЕ ПО НИЗКОЙ ЦЕНЕ
         </div>
         <div class="es13_bg__text2">
            РАСЧЕТ ПРОИЗВОДИТСЯ ИНДИВИДУАЛЬНО
         </div>
         <script src = "<? echo get_template_directory_uri(); ?>/js/jquery.countdown.js"></script>
         <script>
            $(function(){
                var note = $('#note'),
                        ts = new Date(2016, 07, 18),
                        newYear = true;
                if((new Date()) > ts){
                    // The new year is here! Count towards something else.
                    // Notice the *1000 at the end - time must be in milliseconds
                    ts = (new Date()).getTime() + 10*24*60*60*1000;
                    newYear = false;
                }
                $('#countdown_es13').countdown({
                    timestamp   : ts,
                    callback    : function(days, hours, minutes, seconds){
                    }
                });
            });
         </script>
         <div id="countdown_es13">
         </div>
         <div class="container">
            <form name="SIMPLE_FORM_3" action="/" method="POST" enctype="multipart/form-data"><input type="hidden" name="sessid" id="sessid_2" value="44cc1521ce37df86fa4cce6775bef15e" /><input type="hidden" name="WEB_FORM_ID" value="5" /><input type="hidden" name="lang" value="ru" />
            <form>
               <div class="es13_block">
                  <div class="es13_item es13_input form-group"><input type="text" class="phonemask" placeholder="Телефон" data-validation="required" id="form_text_9" data-field="phone" name="form_text_33" value="" size="0" /><input type="hidden" data-field="comagic" name="form_hidden_73" value="" /> </div>
                  <div class="es13_item es13_but_div"><button class="yellow-button" id="template_zafixtsenu_but">Зафиксировать цену на&nbsp;3&nbsp;дня</button> </div>
               </div>
               <input name="web_form_apply" value="Y" type="hidden" /> 
            </form>
            </form>
            <div class="prav-info white center">Оставляя свои контактные данные, вы подтверждаете свое совершеннолетие, соглашаетесь на обработку персональных данных в&nbsp;соответствии с
               <a href="#legal-info" data-toggle="modal" class="b-link" data-target="#legal-info">Правовой&nbsp;информацией</a>
            </div>
         </div>
      </div>